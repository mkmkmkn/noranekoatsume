<div class="usericon_input flex mb-4" x-data="userIconPreview()">
    <div class="mr-3 mb-4">
        <img id="preview"
            src="{{ isset(Auth::user()->usericon_path) ? asset('storage/' . Auth::user()->usericon_path) : asset('img/user_icon.png') }}"
            alt="" class="w-16 h-16 rounded-full object-cover border-none bg-gray-200">
    </div>
    <div class="flex items-center">
        <button x-on:click="document.getElementById('user_icon').click()" type="button"
            class="inline-flex items-center uppercase rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            アイコン変更
        </button>
        {{-- <input @change="showPreview(event)" type="file" name="usericon" id="user_icon" class="hidden"> --}}
        <input type="file" accept="image/*" onchange="handleImageUpload(event);" id="user_icon" class="hidden">
        <input type="file" name="usericon" id="user_icon_after" class="hidden">
        <div id="original-size"></div>
        <div id="compressed-size"></div>
        <p id="compressed-image"></p>
        <script>
            // function userIconPreview() {
            //     return {
            //         showPreview: (event) => {
            //             if (event.target.files.length > 0) {
            //                 var src = URL.createObjectURL(event.target.files[0]);
            //                 document.getElementById('preview').src = src;
            //             }
            //         }
            //     }
            // }

            const originalSize = document.getElementById('original-size');
            const compressedSize = document.getElementById('compressed-size');
            const compressedImage = document.getElementById('compressed-image');

            function handleImageUpload(event) {
                const imageFile = event.target.files[0];

                // reset content
                originalSize.textContent = '';
                compressedSize.textContent = '';
                compressedImage.innerHTML = '';

                const options = {
                    maxSizeMB: 1,
                    maxWidthOrHeight: 400
                }

                imageCompression(imageFile, options)
                    .then(function(compressedFile) {
                        const img = URL.createObjectURL(compressedFile);
                        // originalSize.textContent = `元画像のサイズ: ${(imageFile.size / 1024 / 1024).toFixed(2)} MB`;
                        // compressedSize.textContent = `圧縮した画像のサイズ: ${(compressedFile.size / 1024 / 1024).toFixed(2)} MB`;
                        // compressedImage.innerHTML +=
                        //     `<a href="${img}" target="_blank"><img src="${img}" width="400" alt=""></a>`

                        const inputImage = new File([compressedFile], 'cropped.jpeg', {
                            type: "image/jpeg"
                        });

                        const dt = new DataTransfer();
                        dt.items.add(inputImage);
                        document.querySelector('input[name="usericon"]').files = dt.files;

                        document.getElementById('preview').src = img;
                    })
                    .catch(function(error) {
                        console.log(error.message);
                    });
            }
        </script>

        {{-- browser-image-compression --}}
        <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.0/dist/browser-image-compression.js"></script>

    </div>
</div>
