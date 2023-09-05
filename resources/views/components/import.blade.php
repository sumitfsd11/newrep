{{-- <div class="container">
    <div class="card bg-light mt-3">
        
        <div class="card-body">
            <form action="{{ route('import') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="file" name="file"
                       class="form-control">
                <br>
                <button class="btn btn-success">
                      Import Survey
                   </button>
               
            </form>
        </div>
    </div>
</div> --}}





<div x-data="{openModel: false}">


    <div x-data="{response:'' ,  submitForm: function(event) {
        fetch(event.target.action, {
            method: 'POST',
            body: new FormData(event.target),
        })
        .then(response => response.text())
        .then(data => {
            this.response = data; // Update the response
            console.log(data);
    openModel= false;
    upload_survey(JSON.parse(data));
    //upload_option(index,JSON.parse(data))
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }}" >
    
    
     <button x-on:click="openModel = ! openModel" x-model="openModel"
     class="btn btn-primary w-40">
     Upload Survey
     </button> 
    
    
     <div x-show="openModel" class="fixed z-20 left-0 top-0 w-full h-full overflow-auto bg-black bg-opacity-40 ">
        <div class="absolute bg-white m-20 p-8 border rounded-lg" style="left: 50%; transform: translateX(-50%);">
            <span class="absolute top-2 right-4 text-gray-600 cursor-pointer" x-on:click="openModel = ! openModel">&times;</span>
            <h2 class="mb-4">Upload Survey</h2>
    
            <form id="uploadForm" action="{{ route('import') }}" enctype="multipart/form-data" x-on:submit.prevent="submitForm">
                @csrf
                <label class="block mb-2" for="file">Choose File:</label>
                <input class="w-full py-2 px-3 border rounded" type="file"  name="file">
               
                <button class="mt-4 py-2 px-4 bg-blue-500 text-white rounded cursor-pointer" type="submit" >Upload</button>
            </form>
            
        </div>
    </div>
    
    
    </div>
    </div>

