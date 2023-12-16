{{-- 画像投稿フォーム --}}
<style>
    #formMap {
        width: 600px;
        height: 600px;
    }
</style>
<section class="catimage_upload_section text-gray-800 dark:text-gray-200">
    <form action="{{ route('catimage.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Title:</label>
        <input class="text-gray-900" type="text" name="title" value="{{old('title')}}" placeholder="画像タイトル" required>
        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*" required>
        <textarea class="form-control text-gray-900" rows="6" name="text" placeholder="画像のコメント">{{old('text')}}</textarea>
        <div id="formMap"></div>
        lat(緯度):<input class="text-gray-900" type="text" name="map_lat" id="lat" value="{{old('map_lat')}}" required>
        lng(経度):<input class="text-gray-900" type="text" name="map_lng" id="lng" value="{{old('map_lng')}}" required>
        <button type="submit">Upload Image</button>
    </form>
</section>
