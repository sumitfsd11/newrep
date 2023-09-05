<div class="flex gap-4 items-center" x-data="{openModel:false, image:'', images: @js($pictures)}">
    {{-- <select x-model="option.option"
        class="input input-bordered w-full"
        x-on:change="option.value=slugify(option.option)">

        <option value="" x-on:click="openModel = ! openModel" x-model="openModel">
            Select Picture
        </option>

        @foreach ($pictures as $picture)
            <option value="{{ $picture->id }}">
                {{ $picture->name }}
            </option>
        @endforeach 
    </select> --}}

    <div  x-data="{ 
        uploadPicture: function(event) {
            fetch(event.target.action, {
                method: 'POST',
                body: new FormData(event.target),
            })
            .then(response => response.text())
            .then(data => {
   picture=JSON.parse(data);
        option.option=slugify(picture.name) ;
        option.value=picture.path;
        openModel= false;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }">
    <button x-show="!option.option" x-on:click="openModel = ! openModel" x-model="openModel"
    class="btn btn-primary w-40">
    Select Picture
    </button> 
    {{-- <img x-show="option.option" class="h-32"
    src="{{ asset('storage/' . $picture->path) }}" --}}
    {{-- :src="_.find(images, {id: parseInt(option.option)})?.url"
        alt="_.find(images, {id: parseInt(option.option)})?.name" --}}
        {{-- > --}}


        <div x-show="openModel" class="fixed z-20 left-0 top-0 w-full h-full overflow-auto bg-black bg-opacity-40 ">
            <div class="absolute bg-white m-20 p-8 border rounded-lg" style="left: 50%; transform: translateX(-50%);">
                <span class="absolute top-2 right-4 text-gray-600 cursor-pointer" x-on:click="openModel = ! openModel">&times;</span>
                <h2 class="mb-4">Upload Picture</h2>
        
                <form id="uploadForm" action="{{ route('upload_picture') }}" enctype="multipart/form-data" x-on:submit.prevent="uploadPicture">
                    @csrf
                    <label class="block mb-2" for="file">Choose File:</label>
                    <input class="w-fit py-2 px-3 border rounded" type="file"  name="picture">
                   
                    <button class="mt-4 py-2 px-4 bg-blue-500 text-white rounded cursor-pointer" type="submit" >Upload</button>
                </form>
                
            </div>
        </div>
        
        <img x-show="option.option" class="h-32 border-gray-50 w-32"
        x-bind:src="'/storage/' + option.value" 
       x-bind:alt="option.option"    
        {{-- src="_.find(images, {id: parseInt(option.option)})?.url"
            alt="_.find(images, {id: parseInt(option.option)})?.name"  --}}
           > 


    </div>





        
</div>
