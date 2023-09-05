<tbody>
    <template x-for="(logic, logic_index) in content.logics" :key="`${index}.${logic_index}`">
        <tr>
            <td x-text="logic_index+1">
                {{-- Index --}}
            </td>
            <td>
                <select x-model="logic.type" class="select select-bordered">
                    <option disabled selected value="">Pick Logic</option>
                    <option value="skip">Skip</option>
                    <option value="skip">add question</option>
                </select>
            </td>
            <td>If</td>
            <td>
                <select x-model="logic.name" class="select select-bordered">
                    <option disabled selected value="">Pick Question</option>
                    <template x-for="(question, q_index) in mcqs" :key="q_index">
                        <template x-if="question.name != content.name">
                            <option :value="question.name" x-text="question.label"></option>
                        </template>
                    </template>
                </select>
            </td>
            <td>Is</td>
            <td>
                <select x-model="logic.value" class="select select-bordered">
                    <option disabled selected value="">Pick Option</option>
                    <template x-for="(question, q_index) in mcqs.find(e => e.name == content.logics[logic_index]?.name)?.options" :key="`V${q_index}`">
                        <option :value="question.value" x-text="question.option"></option>
                    </template>
                </select>
            </td>
            <td>
                <x-remove x-on:click="remove_logic(index, logic_index)" />
            </td>
            {{-- Validate all logics are filled. Make sure edit is also working, make sure show anser is working properly. Apply the conditions of the logics in the actual survey, also sumbit answer validation switch  --}}
        </tr>
    </template>
</tbody>
