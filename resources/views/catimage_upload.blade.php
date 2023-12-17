<!-- resources/views/catimage_upload.blade.php -->
@extends('layouts.app')

@php
    $id = Auth::user()->id;
@endphp

@section('content')<!-- コンテンツ -->

@if (session('message'))
    <p class="text-gray-800 dark:text-gray-200">{{ session('message') }}</p>
@endif

<div style='width: 600px; height: 400px'>
  <img id="target" src="{{ asset('img/user_icon.png') }}">
</div>

{{-- 画像投稿フォーム --}}
<!-- コンポーネントの呼び出し -->
<x-catimage-upload-form/>

<script src="{{ asset('/js/googlemap.js') }}"></script>
<script async src="{{ config('services.google-map.apikey') }}"></script>

{{-- cropper.js --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    let target = document.getElementById('target');
let cropper = new Cropper(target);
</script>
@endsection
