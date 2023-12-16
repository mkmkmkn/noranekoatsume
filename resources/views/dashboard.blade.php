<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@php
// $id = auth()->id();
$id = Auth::user()->id;
@endphp

@section('content')<!-- コンテンツ -->

@if (session('message'))
    <p class="text-gray-800 dark:text-gray-200">{{ session('message') }}</p>
@endif

{{-- 画像投稿フォーム --}}
<section class="create_section text-gray-800 dark:text-gray-200">
<form action="{{ route('catimage.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">Title:</label>
    <input class="text-gray-900" type="text" name="title" value="{{old('title')}}" placeholder="画像タイトル" required>
    <label for="image">Image:</label>
    <input type="file" name="image" accept="image/*" required>
    <textarea class="form-control text-gray-900" rows="6" name="text" placeholder="画像のコメント">{{old('text')}}</textarea>
    <div id="formMap"></div>
    lat(緯度):<input class="text-gray-900" type="text" name="map_lat" id="lat" value="{{old('map_lat')}}" required>
    lng(経度):<input class="text-gray-900" type="text" name="map_lng" id="lng" value="{{old('map_lng')}}" required>
    <button type="submit">Upload Image</button>
</form>

@php
$catImagesArray = [];
foreach($catImages as $item) {
    $catImagesArray[] = [
        // 'id' => $item->id,
        // 'title' => $item->title,
        // 'image_path' => $item->image_path,
        // 'text' => $item->text,
        // 'nices' => $item->nices,
        // 'user_id' => $item->user_id,
        // 'map_lat' => $item->map_lat,
        // 'map_lng' => $item->map_lng,
        // 'comments' => $item->comments,
        // 'name' => $item->name,
        'catimage' => $item,
    ];
};
@endphp

{{-- 画像一覧 --}}
@if ($catImagesArray)
@foreach (array_map(null, $catImagesArray, $nices) as [$catImage, $nice])
    <img src="{{ isset($catImage['catimage']->user->usericon_path) ? asset('storage/' . $catImage['catimage']->user->usericon_path) : asset('img/user_icon.png') }}" alt="投稿したユーザーアイコン" style='height:30px; width:30px; object-fit:cover; border-radius:100px'>
    <p>{{ $catImage['catimage']->user->name }}</p>
    <p>{{ $catImage['catimage']->id }}</p>
    <p>{{ $catImage['catimage']->title }}</p>
    <img src="{{ asset('storage/catimages/' . $catImage['catimage']->image_path) }}" alt="投稿したイメージ" style='height:100px'>
    <p>{!! nl2br(e($catImage['catimage']->text)) !!}</p>

    @if ($catImage['catimage']->user_id === $id)
        <form method="post" action="{{ route('catimage.destroy', ['id'=>$catImage['catimage']->id]) }}">
            @csrf
            <button type="submit">削除</button>
        </form>
    @endif

    {{-- いいね --}}
    @if(!$nice)
        <a href="" class="js-nice-toggle btn btn-secondary btn-sm" data-postid="{{ $catImage['catimage']->id }}">
            <span class="niceText">いいね</span>
            <span class="badge">
                {{ count($catImage['catimage']->nices) }}
            </span>
        </a>
    @else
        <a href="" class="js-nice-toggle btn btn-secondary btn-sm niced" data-postid="{{ $catImage['catimage']->id }}">
            <span class="niceText">いいね削除</span>
            <span class="badge">
                {{ count($catImage['catimage']->nices) }}
            </span>
        </a>
    @endif

    <br><br>コメント{{ count($catImage['catimage']->comments) }}件<br>
    @if ($catImage['catimage']->comments)
        @foreach ($catImage['catimage']->comments as $comment)
            <img src="{{ isset($comment->user->usericon_path) ? asset('storage/' . $comment->user->usericon_path) : asset('img/user_icon.png') }}" alt="投稿したユーザーアイコン" style='height:30px; width:30px; object-fit:cover; border-radius:100px'>
            {{ $comment->user->name }}
            {{ $comment->comment }}
            <br>
            @if ($comment->user->id === $id)
                <form method="post" action="{{ route('comment.destroy', ['id'=>$comment['id']]) }}">
                    @csrf
                    <button type="submit">削除</button>
                </form>
            @endif
            <br>
        @endforeach
    @endif
    
    <br><br>

    {{-- コメント投稿フォーム --}}
    <div class="card mb-4">
        <form method="post" action="{{route('comment.store')}}">
            @csrf
            <input type="hidden" name='catimage_id' value="{{$catImage['catimage']->id}}">
            <div class="form-group">
                <textarea name="comment" class="form-control text-gray-900" id="comment" cols="30" rows="5" placeholder="コメントを入力する">{{old('comment')}}</textarea>
            </div>
            <div class="form-group mt-4">
                <button class="btn btn-success float-right mb-3 mr-3">コメントする</button>
            </div>
        </form>
    </div>

@endforeach
@endif
    {{ $catImages->links() }}

<script>
$(function () {
    var like = $('.js-nice-toggle');
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
            thisNice.toggleClass('niced');

            if(data.niced) {
                thisNice.children('.niceText').text('いいね削除');
            } else {
                thisNice.children('.niceText').text('いいね');
            }
            thisNice.children('.badge').text(data.countNices);

        })
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

<style>
#map {
    width: 600px;
    height: 600px;
}
#formMap {
    width: 600px;
    height: 600px;
}
.niced {
    background-color: lightcoral;
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
        markerLatLng = {lat: Number(e['catimage']['map_lat']), lng: Number(e['catimage']['map_lng'])};
        console.log(markerLatLng);
        var marker = new google.maps.Marker({
            position: markerLatLng,
            map: map,
            title: e['catimage']['title']
        });
    });

    // クリックイベントを追加
    formMap.addListener('click', function(e) {
        getClickLatLng(e.latLng, formMap);
    });
}

// フォーム用マップ　位置情報取得用
function getClickLatLng(lat_lng, formMap) {

    // マーカーを全削除
    // var marker = new google.maps.Marker({
    //     position: lat_lng,
    //     map: formMap
    // });
    // marker.setMap(null);
    // marker.setVisible(false);
	// marker = null;

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
