<!-- resources/views/create.blade.php -->

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

    <form method="post" action="{{ route('create.destroy', ['id'=>$catImage->id]) }}">
        @csrf
        <button type="submit">削除</button>
    </form>
@endforeach
@endif