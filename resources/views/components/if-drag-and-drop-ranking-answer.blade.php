<template x-if="item.type=='drag_and_drop_ranking'">
    <div x-data="drag_and_drop_alpine" class="form-control">
        <label :for="item.name" class="label justify-start gap-1">
            <span x-text="item.label" class="label-text"></span>
            <span class="font-bold text-error" x-show="item.required">*</span>
        </label>
        <div class="flex">
            <div class="flex gap-8">
                <div x-show="contents[item.name].length !== item.options.length" class="bg-base-200 rounded-t-xl">
                    <h4 class="bg-base-300 rounded-t-xl text-center py-4 px-8">Options</h4>
                    <ul class="bg-base-100">
                        <template
                            x-for="(option, op_index) in item.options"
                            :key="`${index}.${op_index}-left`"
                        >
                            <li
                                {{-- x-show="dragged!==op_index && !contents[item.name].includes(option.value)" --}}
                                :class="!contents[item.name].includes(option.value) ? 'bg-accent hover:cursor-move' : 'bg-base-200 text-base-200 select-none'"
                                class="py-2 px-8"
                                :draggable="!contents[item.name].includes(option.value) ? 'true' : 'false'"
                                x-on:dragstart.self="dragstart(op_index, $event.target, index);$event.dataTransfer.effectAllowed='move';"
                                x-on:dragend.self="if (dragend($event)) { contents[item.name].push(option.value); }"
                                x-model="option.value"
                                x-text="option.option"
                            ></li>
                        </template>
                    </ul>
                </div>
                <div x-on:dragenter="dragenter(index)"
                    x-on:dragover="dragover(index)"
                    x-on:dragleave="dragleave(index)"
                    :class="{'bg-secondary': dragging && over==index }"
                    class="bg-base-200 rounded-t-xl">
                    <h4 class="bg-base-300 rounded-t-xl text-center py-4 px-8">
                        Ranked
                    </h4>
                    <ul
                        dropzone="move" class="bg-base-100">
                        <template
                            x-for="(option, op_index) in contents[item.name]"
                            :key="`${index}.${op_index}-right`"
                        >
                                <li
                                    class="bg-accent py-2 px-8"
                                    x-text="item.options.find((op) => op.value == option).option"
                                ></li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>

    {{-- <input :disabled="disabled||readonly" type="checkbox" x-model="contents[item.name]" --}}
                                {{-- :value="option.value" class="disabled:opacity-100 checkbox checkbox-primary" /> --}}
</template>

