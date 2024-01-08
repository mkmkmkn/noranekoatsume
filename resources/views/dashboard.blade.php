<!-- resources/views/dashboard.blade.php -->
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

    @php
        $catImagesArray = [];
        foreach ($catImages as $item) {
            $catImagesArray[] = [
                'catimage' => $item,
            ];
        }
    @endphp

    <section class="catimage_archive_section text-gray-800 dark:text-gray-200">
        {{-- 画像アーカイブ --}}
        <div class="container">
            <div class="catimage_archive_content">
                @if ($catImagesArray)
                    @foreach (array_map(null, $catImagesArray, $nices) as [$catImage, $nice])
                        <div
                            class="catimage_archive_item bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                            <div class="catimage_archive_item_name">
                                <div class="left">
                                    <img src="{{ isset($catImage['catimage']->user->usericon_path) ? asset('storage/' . $catImage['catimage']->user->usericon_path) : asset('img/user_icon.png') }}"
                                        alt="投稿したユーザーアイコン">
                                    <p>{{ $catImage['catimage']->user->name }}</p>
                                </div>
                                <div class="right">
                                    {{-- 投稿削除 --}}
                                    @if ($catImage['catimage']->user_id === $id)
                                        <form method="post"
                                            action="{{ route('catimage.destroy', ['id' => $catImage['catimage']->id]) }}">
                                            @csrf
                                            <button type="submit" class="f28 materialicon">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            {{-- <p>{{ $catImage['catimage']->id }}</p> --}}
                            <p class="catimage_archive_item_title">{{ $catImage['catimage']->title }}</p>
                            <p class="catimage_archive_item_comment">{!! nl2br(e($catImage['catimage']->text)) !!}</p>
                            <div class="catimage_archive_item_image">
                                <img src="{{ asset('storage/catimages/' . $catImage['catimage']->image_path) }}"
                                    alt="投稿したイメージ">
                            </div>
                            <div class="catimage_archive_item_likeComment">
                                {{-- いいね --}}
                                @if (!$nice)
                                    <a href="" class="js-nice-toggle btn btn-secondary btn-sm"
                                        data-postid="{{ $catImage['catimage']->id }}">
                                        <span class="niceText f24 lh1">♥</span>
                                        <span class="badge">
                                            {{ count($catImage['catimage']->nices) }}
                                        </span>
                                    </a>
                                @else
                                    <a href="" class="js-nice-toggle btn btn-secondary btn-sm niced"
                                        data-postid="{{ $catImage['catimage']->id }}">
                                        <span class="niceText">♥</span>
                                        <span class="badge">
                                            {{ count($catImage['catimage']->nices) }}
                                        </span>
                                    </a>
                                @endif
                                <p class="">コメント{{ count($catImage['catimage']->comments) }}件</p>
                            </div>
                            <div class="catimage_archive_item_comment">
                                {{-- コメント --}}
                                @if ($catImage['catimage']->comments)
                                    @foreach ($catImage['catimage']->comments as $comment)
                                        <div class="comment_item">
                                            <div class="comment_item_name">
                                                <img src="{{ isset($comment->user->usericon_path) ? asset('storage/' . $comment->user->usericon_path) : asset('img/user_icon.png') }}"
                                                    alt="投稿したユーザーアイコン">
                                                {{ $comment->user->name }}
                                            </div>
                                            <div class="comment_item_comment">
                                                {!! nl2br(e($comment->comment)) !!}
                                                {{-- {{ $comment->comment }} --}}
                                            </div>
                                            @if ($comment->user->id === $id)
                                                <div class="comment_item_delete">
                                                    <form method="post"
                                                        action="{{ route('comment.destroy', ['id' => $comment['id']]) }}">
                                                        @csrf
                                                        <button type="submit" class="f20 lh1 materialicon">Delete</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="catimage_archive_item_commentForm">
                                {{-- コメント投稿フォーム --}}
                                <div class="card mb-4">
                                    <form method="post" action="{{ route('comment.store') }}">
                                        @csrf
                                        <input type="hidden" name='catimage_id' value="{{ $catImage['catimage']->id }}">
                                        <div class="form-group">
                                            <textarea name="comment" class="form-control text-gray-900" id="comment" cols="" rows="1"
                                                placeholder="コメントを追加">{{ old('comment') }}</textarea>
                                        </div>
                                        <div class="form-group mt-4">
                                            <button class="submit_button">コメントする</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="catimage_archive_pagination">
                {{ $catImages->links() }}
            </div>
        </div>
    </section>

    <section class="catimage_map_section">
        <div id="map" class="map"></div>
    </section>

    <script>
        if (@json($catImagesArray).length) {
            var catImages = @json($catImagesArray);
        }
    </script>
    <script>
        // いいね機能
        $(function() {
            var like = $(".js-nice-toggle");
            var likePostId;

            like.on("click", function() {
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
                    .done(function(data) {
                        thisNice.toggleClass("niced");

                        // if (data.niced) {
                        //     thisNice.children(".niceText").text("いいね削除");
                        // } else {
                        //     thisNice.children(".niceText").text("いいね");
                        // }
                        thisNice.children(".badge").text(data.countNices);
                    })
                    .fail(function(data, xhr, err) {
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
@endsection
