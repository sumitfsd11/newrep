<template x-if="item.type=='continuous_sum'">
    <div class="form-control">
        <label :for="item.name" class="label justify-start gap-1">
            <span x-text="item.label" class="label-text"></span>
            <span class="font-bold text-error" x-show="item.required">*</span>
        </label>
        <div class="flex gap-2 flex-col">
            <template x-for="(question, q_index) in item.questions" :key="`${index}.${q_index}`">
                <label class="label w-fit cursor-pointer">
                    <input x-on:keyup="contents[item.name][question.name]=make_numeric(contents[item.name][question.name])" :disabled="disabled" :readonly="readonly" x-model="contents[item.name][question.name]" type="text" :name="item.name" :id="item.name"
                        class="input input-bordered w-full max-w-xs" />
                    <span class="label-text ml-2" x-text="question.label"></span> 
                </label> 
            </template>
            <hr class="w-1/4 border-blue-500">
            <label class="label w-fit cursor-pointer">
                <input readonly :value="Object.values(contents[item.name]).reduce((a, b) => Number(a) + Number(b), 0)" type="text" :name="item.name" :id="item.name"
                    class="input input-bordered w-full max-w-xs" />
                <span class="label-text ml-2">Total</span> 
            </label> 
        </div>
    </div>
</template>
