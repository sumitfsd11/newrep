<div class="flex flex-col gap-4">
    <x-part-label />
    <label class="label">
        <span class="label-text">Min Value</span>
    <input x-on:keyup="set_names" placeholder="min value" x-model="content.min" type="text" class="input input-bordered w-full max-w-xs ml-2" >
    </label>
    <label class="label">
        <span class="label-text">Max Value</span>
    <input x-on:keyup="set_names" placeholder="max value" x-model="content.max" type="text" class="input input-bordered w-full max-w-xs ml-2" >
    </label>
    <label class="label">
        <span class="label-text">Step Value</span>
    <input x-on:keyup="set_names" placeholder="step value" x-model="content.step" type="text" class="input input-bordered w-full max-w-xs ml-2" >
    </label>
    <label class="label">
        <span class="label-text">Default Value</span>
    <input x-on:keyup="set_names" placeholder="default value" x-model="content.default" type="text" class="input input-bordered w-full max-w-xs ml-2" >
    </label>
    <label class="label">
        <span class="label-text">Min Label</span>
    <input x-on:keyup="set_names" placeholder="minimum label" x-model="content.label_min" type="text" class="input input-bordered w-full max-w-xs ml-2" >
    </label>
    <label class="label">
        <span class="label-text">Mid Label</span>
    <input x-on:keyup="set_names" placeholder="middle label" x-model="content.label_mid" type="text" class="input input-bordered w-full max-w-xs ml-2" >
    </label>
    <label class="label">
        <span class="label-text">Max Label</span>
    <input x-on:keyup="set_names" placeholder="maximum label" x-model="content.label_max" type="text" class="input input-bordered w-full max-w-xs ml-2" >
    </label>
</div>
