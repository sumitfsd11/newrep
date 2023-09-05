@if(session()->has('survey'))
@php
    $survey = session('survey');
@endphp

      
      <div x-data="{ contents: {{ $survey }} }" x-init="localStorage.setItem('contents', JSON.stringify(contents))">
    </div>
   
 
@endif
<x-base-layout>
    <section x-data="handler( @if(session()->has('survey'))JSON.parse(localStorage.getItem('contents'))  @else {{ old('contents')}} @endif)" class="w-full px-6">


        <div class="flex flex-col gap-4 mt-6 ">

           
        </div>

  
<x-import/>

        <div x-data="{ contents: {{ old('contents')}} }" class="flex flex-col gap-4 w-full my-4" id="main-container" >

            <x-template-master />

        </div>
        <x-add-input x-data="{dd_idx: -1}" />
        <x-reorder x-on:click="reorder()" />
        <form x-on:submit.prevent="()=>{error=validate(); if (! error) $event.target.submit();}" class="form-control pt-4 gap-4" method="POST" action="{{ route('surveys.store') }}">
            @csrf
            <label>
                <input placeholder="Survey Name" name="name" type="text" class="input input-bordered w-full max-w-xs mr-2" >
                <span class="label-text">Survey Name</span>
            </label>
            @error('name')<p class="text-error">{{ $message }}</p>@enderror
            
            <label>
       
                <input name="description" placeholder="description"  type="text" class="input input-bordered w-full max-w-xs mr-2">
              

                <span class="label-text">Survey Description</span>
            </label>
            @error('description')<p class="text-error">{{ $message }}</p>@enderror

            <input x-bind:value="JSON.stringify(contents)" name="contents" type="hidden" class="input input-bordered w-full max-w-xs" >
            <input type="submit" class="btn w-36 btn-primary" >
            <p class="text-error" x-text="error ? error : ''"></p>
        </form>
       
    </section>
</x-base-layout>
