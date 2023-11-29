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
    <div id="map"></div>
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
        <a href="{{ route('nice', $catImage['id']) }}" class="btn btn-secondary btn-sm">
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
</style>

<script>
let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");

  map = new Map(document.getElementById("map"), {
    center: { lat: 7.292960033301938, lng: 80.63932507647996 },
    zoom: 16,
  });

  // クリックイベントを追加
  map.addListener('click', function(e) {
    getClickLatLng(e.latLng, map);
  });
}

function getClickLatLng(lat_lng, map) {

  // 座標を表示
  document.getElementById('lat').value = lat_lng.lat();
  document.getElementById('lng').value = lat_lng.lng();

  // マーカーを設置
  var marker = new google.maps.Marker({
    position: lat_lng,
    map: map
  });

  // 座標の中心をずらす
  // http://syncer.jp/google-maps-javascript-api-matome/map/method/panTo/
  map.panTo(lat_lng);
}

initMap();
</script>
<script async src="{{ config('services.google-map.apikey') }}"></script>

</section>
@endsection