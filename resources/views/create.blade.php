<!-- resources/views/create.blade.php -->
@extends('layouts.app')


@php
// $id = auth()->id();
$id = Auth::user()->id;
@endphp

@section('content')<!-- コンテンツ -->
<section class="create_section text-gray-800 dark:text-gray-200">
<form action="{{ route('upload.catimage') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">Title:</label>
    <input class="text-gray-900" type="text" name="title" required>
    <label for="image">Image:</label>
    <input type="file" name="image" accept="image/*" required>
    <textarea class="form-control text-gray-900" rows="6" name="text"></textarea>
    <div id="formMap"></div>
    lat(緯度):<input class="text-gray-900" type="text" name="map_lat" id="lat" required>
    lng(経度):<input class="text-gray-900" type="text" name="map_lng" id="lng" required>
    <button type="submit">Upload Image</button>
</form>

@if (session('success'))
    {{ session('success') }}
@endif
{{-- @foreach ($imageFiles as $image)
    <img src="{{ asset(str_replace('public', 'storage', $image)) }}" alt="Cat Image" style='height:20px'>
@endforeach --}}

@php
$catImagesArray = [];
foreach($catImages as $item) {
    $catImagesArray[] = [
        'id' => $item->id,
        'title' => $item->title,
        'image_path' => $item->image_path,
        'text' => $item->text,
        'nices' => $item->nices,
        'user_id' => $item->user_id,
        'map_lat' => $item->map_lat,
        'map_lng' => $item->map_lng
    ];
};
@endphp

@if ($catImagesArray)
@foreach (array_map(null, $catImagesArray, $nices) as [$catImage, $nice])
    <p>{{ $catImage['id'] }}</p>
    <p>{{ $catImage['title'] }}</p>
    <img src="{{ asset('storage/catimages/' . $catImage['image_path']) }}" alt="Cat Image" style='height:100px'>
    <p>{!! nl2br(e($catImage['text'])) !!}</p>

    @if ($catImage['user_id'] === $id)
        <form method="post" action="{{ route('create.destroy', ['id'=>$catImage['id']]) }}">
            @csrf
            <button type="submit">削除</button>
        </form>
    @endif

    @if(!$nice)
        <a href="" class="js-like-toggle btn btn-secondary btn-sm" data-postid="{{ $catImage['id'] }}">
            <span class="niceText">いいね</span>
            <!-- 「いいね」の数を表示 -->
            <span class="badge">
                {{ count($catImage['nices']) }}
            </span>
        </a>
    @else
        <a href="" class="js-like-toggle btn btn-secondary btn-sm" data-postid="{{ $catImage['id'] }}">
            <span class="niceText">いいね削除</span>
            <!-- 「いいね」の数を表示 -->
            <span class="badge">
                {{ count($catImage['nices']) }}
            </span>
        </a>
    @endif
    <br>
@endforeach
@endif
    {{ $catImages->links() }}

<script>
$(function () {
    var like = $('.js-like-toggle');
    var likePostId;

    like.on('click', function () {
        likePostId = $(this).data('postid');
        thisNice = $(this);

        console.log(likePostId);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('nice') }}",
            type: 'POST',
            data: {
                'id': likePostId
            },
            dataType: "json",
        })
        .done(function (data) {
            // thisNice.toggleClass('loved'); 
            console.log(data.message);

            if(data.niced) {
                thisNice.children('.niceText').text('いいね削除');
            } else {
                thisNice.children('.niceText').text('いいね');
            }
            thisNice.children('.badge').text(data.countNices);
            //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
            // $this.next('.likesCount').html(data.postLikesCount); 

        })
        // Ajaxリクエストが失敗した場合
        .fail(function (data, xhr, err) {
            console.log('エラー');
            console.log(err);
            console.log(xhr);
        });
        
        return false;
    });
});
</script>

<div id="map"></div>
    
@php
    // var_dump('<pre>');
    // var_dump($catImages);
    // var_dump('</pre>');

    // var_dump('<pre>');
    // var_dump($nices);
    // var_dump('</pre>');
@endphp

<style>
#map {
    width: 600px;
    height: 600px;
}
#formMap {
    width: 600px;
    height: 600px;
}
.loved {
    background-color: white;
}
</style>

<script>
var catImages = @json($catImagesArray);

async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");
    const japan = { lat: 35.000000, lng: 135.300000 };

    map = new Map(document.getElementById("map"), {
    zoom: 4.8,
        center: japan,
    });
    formMap = new Map(document.getElementById("formMap"), {
        center: japan,
        zoom: 4.8,
    });

    // 画像の位置情報をマップに配置
    catImages.forEach(e => {
        markerLatLng = {lat: Number(e['map_lat']), lng: Number(e['map_lng'])};
        console.log(markerLatLng);
        var marker = new google.maps.Marker({
            position: markerLatLng,
            map: map,
            title: e['title']
        });
    });

    // クリックイベントを追加
    formMap.addListener('click', function(e) {
        getClickLatLng(e.latLng, formMap);
    });
}

// フォーム用マップ　位置情報取得用
function getClickLatLng(lat_lng, formMap) {
    // 座標を表示
    document.getElementById('lat').value = lat_lng.lat();
    document.getElementById('lng').value = lat_lng.lng();

    // マーカーを設置
    var marker = new google.maps.Marker({
        position: lat_lng,
        map: formMap
    });

    // 座標の中心をずらす
    // http://syncer.jp/google-maps-javascript-api-matome/map/method/panTo/
    formMap.panTo(lat_lng);
}

initMap();
</script>
<script async src="{{ config('services.google-map.apikey') }}"></script>

</section>
@endsection