<div class="form-control w-fit">
    <label class="label cursor-pointer">
        <input {{ $attributes->except('label') }}  type="checkbox" class="checkbox checkbox-primary" />
        <span class="ml-2 label-text">{{ $label }}</span> 
    </label>
</div>
