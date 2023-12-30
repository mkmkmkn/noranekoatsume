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
        緯度:<input class="text-gray-900" type="text" name="map_lat" id="lat" value="{{ old('map_lat') }}"
            readonly required>
        経度:<input class="text-gray-900" type="text" name="map_lng" id="lng" value="{{ old('map_lng') }}"
            readonly required>
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

        {{-- browser-image-compression --}}
        <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.0/dist/browser-image-compression.js"></script>

        <div id="original-size"></div>
        <div id="compressed-size"></div>
        <p id="compressed-image"></p>



        <script>
            const originalSize = document.getElementById('original-size');
            const compressedSize = document.getElementById('compressed-size');
            const compressedImage = document.getElementById('compressed-image');

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
                    // const dt = new DataTransfer();
                    // dt.items.add(croppedImgFile);
                    // document.querySelector('input[name="image"]').files = dt.files;

                    console.log("changeeeeeee");
                    const imageFile = croppedImgFile;

                    // reset content
                    originalSize.textContent = '';
                    compressedSize.textContent = '';
                    compressedImage.innerHTML = '';

                    const options = {
                        maxSizeMB: 2,
                        maxWidthOrHeight: 1920
                    }

                    imageCompression(imageFile, options)
                        .then(function(compressedFile) {

                            console.log("changeeeeeee222222");
                            const img = URL.createObjectURL(compressedFile);
                            originalSize.textContent =
                                `元画像のサイズ: ${(imageFile.size / 1024 / 1024).toFixed(2)} MB`;
                            compressedSize.textContent =
                                `圧縮した画像のサイズ: ${(compressedFile.size / 1024 / 1024).toFixed(2)} MB`;
                            compressedImage.innerHTML += `
                        <a href="${img}" target="_blank">
                            <img src="${img}" width="400" alt="">
                        </a>
                    `
                            // document.querySelector('input[name="image"]').files = compressedFile;


                            const inputImage = new File([compressedFile], 'cropped.png', {
                                type: "image/png"
                            });





                            const dt = new DataTransfer();
                            dt.items.add(inputImage);
                            document.querySelector('input[name="image"]').files = dt.files;
                        })
                        .catch(function(error) {
                            console.log(error.message);
                        });
                });

                cropper.destroy();
                $(".cropper_modal").removeClass("active");
            });
        </script>
        {{-- <script>
            const originalSize = document.getElementById('original-size');
            const compressedSize = document.getElementById('compressed-size');
            const compressedImage = document.getElementById('compressed-image');


            document.querySelector('input[name="image"]').addEventListener('change', function(event) {
                console.log("changeeeeeee");
                const imageFile = event.target.files[0];

                // reset content
                originalSize.textContent = '';
                compressedSize.textContent = '';
                compressedImage.innerHTML = '';

                const options = {
                    maxSizeMB: 2,
                    maxWidthOrHeight: 1920
                }

                imageCompression(imageFile, options)
                    .then(function(compressedFile) {
                        const img = URL.createObjectURL(compressedFile);
                        originalSize.textContent = `元画像のサイズ: ${(imageFile.size / 1024 / 1024).toFixed(2)} MB`;
                        compressedSize.textContent =
                            `圧縮した画像のサイズ: ${(compressedFile.size / 1024 / 1024).toFixed(2)} MB`;
                        compressedImage.innerHTML += `
                        <a href="${img}" target="_blank">
                            <img src="${img}" width="400" alt="">
                        </a>
                    `
                    })
                    .catch(function(error) {
                        console.log(error.message);
                    });
            });
        </script> --}}

        {{-- cropper.js --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css"
            integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"
            integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </form>
</section>
