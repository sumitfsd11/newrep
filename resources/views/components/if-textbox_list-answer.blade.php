<template x-if="item.type=='textbox_list'">
    <div class="form-control">
        <label :for="item.name" class="label justify-start gap-1">
            <span x-text="item.label" class="label-text"></span>
            <span class="font-bold text-error" x-show="item.required">*</span>
        </label>
        <div class="flex gap-2 flex-col">
            <template x-for="(question, q_index) in item.questions" :key="`${index}.${q_index}`">
                <label class="label w-fit cursor-pointer">
                    <input :disabled="disabled" :readonly="readonly" x-model="contents[item.name][question.name]" type="text" :name="item.name" :id="item.name"
                        class="input input-bordered w-full max-w-xs" />
                    <span class="label-text ml-2" x-text="question.label"></span> 
                </label> 
            </template>
        </div>
    </div>
</template>
