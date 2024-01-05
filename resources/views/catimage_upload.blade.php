<!-- resources/views/catimage_upload.blade.php -->
@extends('layouts.app')

@php
    $id = Auth::user()->id;
@endphp

@section('content')
    <!-- コンテンツ -->

    @if (session('message'))
        <div class="container">
            <p class="text-gray-800 dark:text-gray-200">{{ session('message') }}</p>
        </div>
    @endif

    <section class="title_section">
        <div class="container">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                {{ __('投稿を追加') }}
            </h2>
        </div>
    </section>

    {{-- 画像投稿フォーム --}}
    <!-- コンポーネントの呼び出し -->
    <x-catimage-upload-form />

    <script src="{{ asset('/js/googlemap.js') }}"></script>
    <script async src="{{ config('services.google-map.apikey') }}"></script>
@endsection
