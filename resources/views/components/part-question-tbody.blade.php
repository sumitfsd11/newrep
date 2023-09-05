<tbody>
    <template x-for="(question, q_index) in content.questions" :key="`${index}.${q_index}`">
        <tr>
            <td x-text="q_index+1">
                {{-- Index --}}
            </td>
            <td x-show="0">
                <input placeholder="name" readonly x-model="question.name" type="text" class="input input-bordered w-full max-w-xs" >
            </td>
            <td>
                <input placeholder="label" x-on:keyup="question.name=slugify(question.label)" x-model="question.label" type="text" class="input input-bordered w-full" >
            </td>
            <td>
                <x-remove x-on:click="remove_question(index, q_index)" />
            </td>
        </tr>
    </template>
</tbody>