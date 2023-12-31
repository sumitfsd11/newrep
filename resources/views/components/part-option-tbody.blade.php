<tbody>
    <template x-for="(option, op_index) in content.options" :key="`${index}.${op_index}`">
        <tr>
            <td x-text="op_index+1">
                {{-- Index --}}
            </td>
            <td x-show="0">
                <input placeholder="value" readonly x-model="option.value" type="text" class="input input-bordered w-full max-w-xs" >
            </td>
            <td>
                <input placeholder="option" x-on:keyup="option.value=slugify(option.option)" x-model="option.option" type="text" class="input input-bordered w-full" >
            </td>
            <td>
                <x-remove x-on:click="remove_option(index, op_index)" />
            </td>
        </tr>
    </template>
</tbody>
