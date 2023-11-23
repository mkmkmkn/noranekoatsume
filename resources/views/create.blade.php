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
    <input type="text" name="title" required>
    <label for="image">Image:</label>
    <input type="file" name="image" accept="image/*" required>
    <textarea class="form-control" rows="6" name="text"></textarea>
    <button type="submit">Upload Image</button>
</form>

{{-- @foreach ($imageFiles as $image)
    <img src="{{ asset(str_replace('public', 'storage', $image)) }}" alt="Cat Image" style='height:20px'>
@endforeach --}}

@if ($catImages)
@foreach ($catImages as $catImage)
    <p>{{ $catImage->id }}</p>
    <p>{{ $catImage->title }}</p>
    <img src="{{ asset('storage/catimages/' . $catImage->image_path) }}" alt="Cat Image" style='height:100px'>
    <p>{!! nl2br(e($catImage->text)) !!}</p>

    @if ($catImage->user_id === $id)
        <form method="post" action="{{ route('create.destroy', ['id'=>$catImage->id]) }}">
            @csrf
            <button type="submit">削除</button>
        </form>
    @endif

@php
    $catid = $catImage->id;
    var_dump('<pre>');
    var_dump($nice);
    var_dump('</pre>');

    $nicenum=$nice->('catimage_id', $catid)->count();
@endphp
			{{-- {{ $nice }} --}}
    
{{-- <span>
<img src="{{asset('img/nicebutton.png')}}" width="30px">
<!-- もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
@if($nice)
<!-- 「いいね」取消用ボタンを表示 -->
	<a href="{{ route('unnice', $post) }}" class="btn btn-success btn-sm">
		いいね
		<!-- 「いいね」の数を表示 -->
		<span class="badge">
			{{ $post->nices->count() }}
		</span>
	</a>
@else
<!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
	<a href="{{ route('nice', $post) }}" class="btn btn-secondary btn-sm">
		いいね
		<!-- 「いいね」の数を表示 -->
		<span class="badge">
			{{ $post->nices->count() }}
		</span>
	</a>
@endif
</span> --}}


@endforeach
@endif






</section>
@endsection