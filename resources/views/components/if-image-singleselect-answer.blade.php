<template x-if="item.type=='image_singleselect'">
    <div class="form-control">
        <label :for="item.name" class="label justify-start gap-1">
            <span x-text="item.label" class="label-text"></span>
            <span class="font-bold text-error" x-show="item.required">*</span>
        </label>
        <div class="flex">
            <template x-for="(option, op_index) in item.options" :key="op_index">
                <label class="label w-fit cursor-pointer">
                    <input :name="item.name" :disabled="disabled||readonly" type="radio"
                        :value="option.value" x-model="contents[item.name]"
                        class="radio disabled:opacity-100 checked:bg-primary" x-show="0" />
                    <x-picture-view />
                    {{-- <span class="label-text ml-2" x-text="option.option"></span>  --}}
                </label>
            </template>
        </div>
    </div>
</template>
