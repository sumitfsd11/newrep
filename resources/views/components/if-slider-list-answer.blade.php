<template x-if="item.type=='slider_list'">
    <div class="form-control">
        <label :for="item.name" class="label justify-start gap-1">
            <span x-text="item.label" class="label-text"></span>
            <span class="font-bold text-error" x-show="item.required">*</span>
        </label>
        <div class="flex gap-2 flex-col">
            <template x-for="(question, q_index) in item.questions" :key="`${index}.${q_index}`">
                <label class="label w-fit cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-full shrink-0">
                            <label :for="question.name" class="label justify-start gap-1">
                                <span x-text="question.label" class="label-text"></span>
                            </label>
                            <input :min="item.min" :max="item.max" :step="item.step" :disabled="readonly||disabled" x-model="contents[item.name][question.name]" type="range" :name="question.name" :id="question.name"
                                class="w-full max-w-xs" />
                            <div class="w-full flex justify-between text-xs px-2">
                                <span x-text="item.label_min"></span>
                                <span x-text="item.label_mid"></span>
                                <span x-text="item.label_max"></span>
                            </div>
                        </div>
                        <span class="text-xl shrink-0" x-text="contents[item.name][question.name]"></span>
                    </div>
                </label> 
            </template>
        </div>
    </div>
</template>
