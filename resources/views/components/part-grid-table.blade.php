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
                    <span class="font-bold label-text" x-text="question.label"></span> 
                </label> 
            </td>
            <template x-for="(option, op_index) in item.options" :key="`${index}.${q_index}.${op_index}`">
                <td>
                <label class="label w-full flex justify-center cursor-pointer">
                    <input :name="item.name+question.name" :disabled="disabled||readonly" type="radio"
                        :value="option.value" x-model="contents[item.name][question.name]"
                        class="radio disabled:opacity-100 checked:bg-primary" />
                    <span x-show="0" class="label-text ml-2" x-text="option.option"></span> 
                </label>
                </td>
            </template>
        </tr>
    </template>
    </tbody>
</table>
