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
    <button type="submit">Upload Image</button>
</form>

@if(session('success'))
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

<br>
<br>
<br>
<br>
<br>

<style>
#map {
    width: 600px;
    height: 600px;
}
</style>
    <div id="map"></div>

    <script async src="{{ config('services.google-map.apikey') }}"></script>
<script>
let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");

  map = new Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });
}

initMap();
</script>
{{-- <div class="" onload="javascript:init();">
<p>Google Maps Point Marker</p>

<div id="map" style="margin-top: 10px; margin-bottom:15px;"></div>

緯度：<input type="text" id="lat" name="lat" value="" size="20">　経度：<input type="text" id="lng" name="lng" value="" size="20">

</div>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
var marker = null;
var lat = 35.729493379635535;
var lng = 139.71086479574538;
 
function init() {
  //初期化
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 18, center: {lat: lat, lng: lng}
  });
 
  document.getElementById('lat').value = lat;
  document.getElementById('lng').value = lng;
 
  //初期マーカー
  marker = new google.maps.Marker({
    map: map, position: new google.maps.LatLng(lat, lng),
  });
 
  //クリックイベント
  map.addListener('click', function(e) {
    clickMap(e.latLng, map);
  });
}
 
function clickMap(geo, map) {
  lat = geo.lat();
  lng = geo.lng();
 
  //小数点以下6桁に丸める場合
  //lat = Math.floor(lat * 1000000) / 1000000);
  //lng = Math.floor(lng * 1000000) / 1000000);
 
  document.getElementById('lat').value = lat;
  document.getElementById('lng').value = lng;
 
  //中心にスクロール
  map.panTo(geo);
 
  //マーカーの更新
  marker.setMap(null);
  marker = null;
  marker = new google.maps.Marker({
    map: map, position: geo 
  });
  
}
</script> --}}
 

<br>
<br>
<br>
<br>
<br>

@php
    // var_dump('<pre>');
    // var_dump($catImages);
    // var_dump('</pre>');

    var_dump('<pre>');
    var_dump($nices);
    var_dump('</pre>');

@endphp



</section>
@endsection