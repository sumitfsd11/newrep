<div class="flex flex-col gap-4">
    <x-part-label />
    <label class="label">
        <span class="label-text">Min</span>
        <input x-on:keyup="set_names" placeholder="label" x-model="content.min" type="date" class="input input-bordered w-full max-w-xs ml-2" >
    </label>
    <label class="label">
        <span class="label-text">Max</span>
        <input x-on:keyup="set_names" placeholder="label" x-model="content.max" type="date" class="input input-bordered w-full max-w-xs ml-2" >
    </label>
</div>
