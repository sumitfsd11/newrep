<template x-if="item.type=='checkbox_grid'">
    <div class="form-control">
        <label :for="item.name" class="label justify-start gap-1">
            <span x-text="item.label" class="label-text"></span>
            <span class="font-bold text-error" x-show="item.required">*</span>
        </label>
        <table class="">
            <thead class="text-center">
                <tr>
                    <th>Question</th>
                    <template x-for="(option, op_index) in item.options" :key="`${index}.${op_index}`">
                        <th x-text="option.option"></th>
                    </template>
                </tr>
            </thead>
            <tbody class="text-center">
            <template x-for="(question, q_index) in item.questions" :key="`${index}.${q_index}`">
                <tr>
                    <td>
                        <label class="label w-full flex justify-center cursor-pointer">
                            <span class="label-text font-bold" x-text="question.label"></span> 
                        </label> 
                    </td>
                    <template x-for="(option, op_index) in item.options" :key="`${index}.${q_index}.${op_index}`">
                    <td>
                        <label class="label w-full flex justify-center cursor-pointer">
                            <input :name="item.name+question.name" :disabled="disabled||readonly" type="checkbox"
                                :value="option.value" x-model="contents[item.name][question.name]"
                                class="checkbox checkbox-primary disabled:opacity-100 checked:bg-primary" />
                            <span x-show="0" class="label-text ml-2" x-text="option.option"></span> 

                        </label>
                    </td>
                    </template>
                </tr>
            </template>
        </table>
    </div>
</template>
