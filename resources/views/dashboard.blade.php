<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

<style>
#map {
    width: 600px;
    height: 600px;
}
.niced {
    background-color: lightcoral;
}
</style>

@php
    $id = Auth::user()->id;
@endphp

@section('content')<!-- コンテンツ -->

@if (session('message'))
    <p class="text-gray-800 dark:text-gray-200">{{ session('message') }}</p>
@endif

@php
$catImagesArray = [];
foreach($catImages as $item) {
    $catImagesArray[] = [
        'catimage' => $item,
    ];
};
@endphp

<section class="catimage_archive_section text-gray-800 dark:text-gray-200">
{{-- 画像アーカイブ --}}
@if ($catImagesArray)
@foreach (array_map(null, $catImagesArray, $nices) as [$catImage, $nice])
    <img src="{{ isset($catImage['catimage']->user->usericon_path) ? asset('storage/' . $catImage['catimage']->user->usericon_path) : asset('img/user_icon.png') }}" alt="投稿したユーザーアイコン" style='height:30px; width:30px; object-fit:cover; border-radius:100px'>
    <p>{{ $catImage['catimage']->user->name }}</p>
    <p>{{ $catImage['catimage']->id }}</p>
    <p>{{ $catImage['catimage']->title }}</p>
    <img src="{{ asset('storage/catimages/' . $catImage['catimage']->image_path) }}" alt="投稿したイメージ" style='height:100px'>
    <p>{!! nl2br(e($catImage['catimage']->text)) !!}</p>

    {{-- 投稿削除 --}}
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

    {{-- コメント --}}
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

<div id="map"></div>


<script>
    if (@json($catImagesArray).length) {
        var catImages = @json($catImagesArray);
    }
</script>

<script>
// いいね機能
$(function () {
    var like = $(".js-nice-toggle");
    var likePostId;

    like.on("click", function () {
        likePostId = $(this).data("postid");
        thisNice = $(this);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "{{ route('nice') }}",
            type: "POST",
            data: {
                id: likePostId,
            },
            dataType: "json",
        })
            .done(function (data) {
                thisNice.toggleClass("niced");

                if (data.niced) {
                    thisNice.children(".niceText").text("いいね削除");
                } else {
                    thisNice.children(".niceText").text("いいね");
                }
                thisNice.children(".badge").text(data.countNices);
            })
            .fail(function (data, xhr, err) {
                console.log("エラー");
                console.log(err);
                console.log(xhr);
            });

        return false;
    });
});
</script>

<script src="{{ asset('/js/script.js') }}"></script>
<script src="{{ asset('/js/googlemap.js') }}"></script>
<script async src="{{ config('services.google-map.apikey') }}"></script>

</section>
@endsection
