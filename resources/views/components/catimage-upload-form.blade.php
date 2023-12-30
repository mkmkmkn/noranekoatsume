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
        <input class="text-gray-900" type="text" name="title" value="{{ old('title') }}" placeholder="画像タイトル" required>
        @if ($errors->has('title'))
            <span>{{ $errors->first('title') }}</span>
        @endif

        <label>画像ファイル<input type="file" name="src-img" accept="image/*"></label>
        <div class="inputHidden">
            <label for="image">Image:</label>
            <input type="file" name="image" accept="image/*" required>
        </div>
        @if ($errors->has('image'))
            <span>{{ $errors->first('image') }}</span>
        @endif

        <textarea class="form-control text-gray-900" rows="6" name="text" placeholder="画像のコメント">{{ old('text') }}</textarea>
        @if ($errors->has('text'))
            <span>{{ $errors->first('text') }}</span>
        @endif

        <div id="formMap"></div>
        緯度:<input class="text-gray-900" type="text" name="map_lat" id="lat" value="{{ old('map_lat') }}" readonly required>
        経度:<input class="text-gray-900" type="text" name="map_lng" id="lng" value="{{ old('map_lng') }}" readonly required>
        @if ($errors->has('map_lat'))
            <span>{{ $errors->first('map_lat') }}</span>
        @endif

        <button type="submit" class="submit_button">投稿する</button>

        <div class="cropper_modal">
            <div class="cropper_modal_inner">
                <img id="cropper-tgt">
                <button type="button" id="btn-crop-action" class="submit_button">決定</button>
            </div>
        </div>

        <div class="cropper_preview">
            <img id="preview">
        </div>

        <script>
            document.querySelector('input[name="src-img"]').addEventListener('change', function(changeFileEvent) {

                var fReaderForURI = new FileReader();
                fReaderForURI.readAsDataURL(changeFileEvent.target.files[0]);

                fReaderForURI.onload = () => {
                    var imgEl = document.getElementById('cropper-tgt');
                    imgEl.src = String(fReaderForURI.result);

                    var options = {
                        viewMode: 1,
                        dragMode: 'move',
                        responsive: false
                    };

                    cropper = new Cropper(imgEl, options);
                    $(".cropper_modal").addClass("active");
                }
            });

            // 切り抜き画像をimgへ出力
            document.getElementById('btn-crop-action').addEventListener('click', function() {
                const croppedCanvas = cropper.getCroppedCanvas();
                document.getElementById('preview').src = croppedCanvas.toDataURL()
            });

            // 切り抜き画像をinputへ出力
            document.getElementById('btn-crop-action').addEventListener('click', function() {
                const croppedCanvas = cropper.getCroppedCanvas();

                croppedCanvas.toBlob(function(imgBlob) {
                    const croppedImgFile = new File([imgBlob], 'cropped.png', {
                        type: "image/png"
                    });
                    const dt = new DataTransfer();
                    dt.items.add(croppedImgFile);
                    document.querySelector('input[name="image"]').files = dt.files;
                });

                cropper.destroy();
                $(".cropper_modal").removeClass("active");
            });
        </script>

        {{-- cropper.js --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css"
            integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"
            integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </form>
</section>
