
<div class="flex mb-4" x-data="userIconPreview()">
    <div class="mr-3">
        <img
            id="preview"
            src="{{ isset(Auth::user()->user_icon_path) ? asset('storage/' . Auth::user()->user_icon_path) : asset('img/user_icon.png') }}"
            alt=""
            class="w-16 h-16 rounded-full object-cover border-none bg-gray-200"
        >
    </div>
    <div class="flex items-center">
        <button
                x-on:click="document.getElementById('user_icon').click()"
                type="button"
                class="inline-flex items-center uppercase rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            SELECT A NEW PHOTO
        </button>
        <input @change="showPreview(event)" type="file" name="user_icon" id="user_icon" class="hidden">
        <script>
            function userIconPreview() { 
                return {
                    showPreview: (event) =>{
                        if(event.target.files.length > 0){
                            var src = URL.createObjectURL(event.target.files[0]);
                            document.getElementById('preview').src = src;
                        }
                    }
                }
            }
        </script>
    </div>
</div>