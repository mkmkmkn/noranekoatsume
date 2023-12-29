<!-- resources/views/catimage_upload.blade.php -->
@extends('layouts.app')

@php
    $id = Auth::user()->id;
@endphp

@section('content')
    <!-- コンテンツ -->

    @if (session('message'))
        <p class="text-gray-800 dark:text-gray-200">{{ session('message') }}</p>
    @endif

    {{-- 画像投稿フォーム --}}
    <!-- コンポーネントの呼び出し -->
    <x-catimage-upload-form />

    <script src="{{ asset('/js/googlemap.js') }}"></script>
    <script async src="{{ config('services.google-map.apikey') }}"></script>

@endsection
