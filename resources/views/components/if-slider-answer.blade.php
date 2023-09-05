<template x-if="item.type=='slider'">
    <div class="form-control w-full max-w-xs">
        <div class="flex items-center gap-4">
            <div class="w-full shrink-0">
                <label :for="item.name" class="label justify-start gap-1">
                    <span x-text="item.label" class="label-text"></span>
                    <span class="font-bold text-error" x-show="item.required">*</span>
                </label>
                <input :min="item.min" :max="item.max" :step="item.step" :disabled="readonly||disabled" x-model="contents[item.name]" type="range" :name="item.name" :id="item.name"
                    class="w-full max-w-xs" />
                <div class="w-full flex justify-between text-xs px-2">
                    <span x-text="item.label_min"></span>
                    <span x-text="item.label_mid"></span>
                    <span x-text="item.label_max"></span>
                </div>
            </div>
            <span class="text-xl shrink-0" x-text="contents[item.name]"></span>
        </div>
    </div>
</template>
