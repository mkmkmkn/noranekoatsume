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

@if ($catImages)
@foreach (array_map(null, $catImages, $nices) as [$catImage, $nice])
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
        {{-- <a href="{{ route('nice', $catImage['id']) }}" class="btn btn-secondary btn-sm">
            いいね
            <!-- 「いいね」の数を表示 -->
            <span class="badge">
                {{ count($catImage['nices']) }}
            </span>
        </a> --}}
        <a href="" class="js-like-toggle btn btn-secondary btn-sm" data-postid="{{ $catImage['id'] }}">
            いいね
            <!-- 「いいね」の数を表示 -->
            <span class="badge">
                {{ count($catImage['nices']) }}
            </span>
        </a>
    @else
        <a href="{{ route('unnice', $catImage['id']) }}" class="btn btn-success btn-sm">
            いいね削除
            <!-- 「いいね」の数を表示 -->
            <span class="badge">
                {{ count($catImage['nices']) }}
            </span>
        </a>
    @endif
    <br>
@endforeach
@endif

<script>
$(function () {
    var like = $('.js-like-toggle');
    var likePostId;
        // console.log("ああああ");

    like.on('click', function () {
        // var $this = $(this);
        likePostId = $(this).data('postid');

        console.log(likePostId);
        // console.log("いいいい");
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('nice') }}",  //routeの記述
                type: 'POST', //受け取り方法の記述（GETもある）
                data: {
                    'id': likePostId //コントローラーに渡すパラメーター
                },
                dataType: "json",
                // data: likePostId,
        })

            // Ajaxリクエストが成功した場合
            .done(function (data) {
    //lovedクラスを追加
                $(this).toggleClass('loved'); 
                console.log(data.userId);

    //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
                // $this.next('.likesCount').html(data.postLikesCount); 

            })
            // Ajaxリクエストが失敗した場合
            .fail(function (data, xhr, err) {
    //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
    //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
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
</style>

<script>
var catImages = @json($catImages);

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