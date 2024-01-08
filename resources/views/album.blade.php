<!-- resources/views/album.blade.php -->
@extends('layouts.app')

@php
    $id = Auth::user()->id;
@endphp

@section('content')<!-- コンテンツ -->

@if (session('message'))
<div class="container">
    <p class="text-gray-800 dark:text-gray-200">{{ session('message') }}</p>
</div>
@endif

@php
    $catImagesArray = [];
    foreach($catImages as $item) {
        $catImagesArray[] = [
            'catimage' => $item,
        ];
    };
@endphp

<section class="album_archive_section text-gray-800 dark:text-gray-200">
    <div class="container">
        <div class="album_archive_3column">
            {{-- 画像アーカイブ --}}
            @if ($catImagesArray)
            @foreach (array_map(null, $catImagesArray, $nices) as [$catImage, $nice])
                <div class="item">
                    <img src="{{ asset('storage/catimages/' . $catImage['catimage']->image_path) }}" alt="投稿したイメージ">
                </div>
            @endforeach
            @endif
        </div>
        <div class="album_archive_pagination">
            {{ $catImages->links() }}
        </div>
    </div>
</section>

{{-- <script>
    if (@json($catImagesArray).length) {
        var catImages = @json($catImagesArray);
    }
</script> --}}
<script src="{{ asset('/js/script.js') }}"></script>
{{-- <script src="{{ asset('/js/googlemap.js') }}"></script>
<script async src="{{ config('services.google-map.apikey') }}"></script> --}}

@endsection
