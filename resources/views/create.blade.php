<!-- resources/views/create.blade.php -->

<form action="{{ route('upload.catimage') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">Title:</label>
    <input type="text" name="title" required>
    <label for="image">Image:</label>
    <input type="file" name="image" accept="image/*" required>
    <button type="submit">Upload Image</button>
</form>

<!-- 例: cat/index.blade.php -->

@foreach ($imageFiles as $image)
    <img src="{{ asset(str_replace('public', 'storage', $image)) }}" alt="Cat Image">
    <form method="post" action="{{ route('destroy') }}">
        @csrf
        @method('delete')
        <button type="submit">削除</button>
    </form>
@endforeach