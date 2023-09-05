<section  x-data="handler({{ old('contents') ?? 0 }} || JSON.parse(localStorage.getItem('contents')))" class="w-full">
    <div class="flex flex-col gap-4 w-full my-4">
        <x-template-master  />
    </div>
    <x-add-input />
    <form x-on:submit.prevent="()=>{error=validate(); if (! error) $event.target.submit();}" class="form-control pt-4 gap-4" method="POST" action="{{ route('surveys.update', $survey->id) }}">
        @csrf
        @method('PATCH')
        <label>
            <input placeholder="Survey Name" value="{{ $survey->name }}" name="name" type="text" class="input input-bordered w-full max-w-xs mr-2" >
            <span class="label-text">Survey Name</span>
        </label>
        @error('name')<p class="text-error">{{ $message }}</p>@enderror
        <input x-bind:value="JSON.stringify(contents)" name="contents" type="hidden" >
        <input type="submit" class="btn w-36 btn-primary" >
        <p class="text-error" x-text="error ? error : ''"></p>
    </form>
</section>