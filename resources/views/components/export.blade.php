<div class="container">
    <div class="card bg-light mt-1">
        <div class="card-header">
         
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" x-data="id">
              
                <br>
                
                <a class="btn btn-warning"
                   href="{{ route('export') }}">
                          Export Survey
                  </a>
            </form>
        </div>
    </div>
</div>