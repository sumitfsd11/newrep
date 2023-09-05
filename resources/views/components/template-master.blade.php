

<template x-for="(content, index) in contents " :key="index">
 
    <div  class="flex flex-col gap-4">
        

        <div  x-on:click="tempStore()"
            class="card w-full bg-base-100 shadow-xl">
            <div x-on:dragstart.self="dragstart(index, $event.target);$event.dataTransfer.effectAllowed='move';"
                draggable="true"
                dropzone="move"
                x-on:dragenter="dragenter(index, $event.target)"
                x-on:dragleave="dragleave(index, $event.target)"
                x-on:dragover="dragover(index, $event.target)"
                x-on:dragend.prevent="dragend($event)"
                x-show="dragged !== index"
                class="px-4 py-2 hover:cursor-move bg-base-300 card-actions items-center justify-between">
                <h3 class="font-extrabold text-2xl text-secondary" x-text="`${index+1}. ${content.type.replace(/_/g, ' ').toUpperCase()}`"></h3>
                <div>
                    <template x-if="index>=0">
                        <x-copy x-on:click="copyClipboard(index)"/>
                    </template>
                    <template x-if="index>=0">  
                        <x-paste x-on:click="pasteClipboard(index)"/>
                        
                    </template>
                    
                    <template x-if="index!=0">
                        <x-up x-on:click="up(index)" />
                    </template>
                    <template x-if="index!= contents.length-1">
                        <x-down x-on:click="down(index)" />
                    </template>
                    <x-remove x-on:click="remove(index)" />

                 
                </div>
              
            </div>
            <div x-show="!dragging" class="card-body">
                <input placeholder="name" x-show="0" readonly x-model="content.name" type="text" class="input input-bordered w-full max-w-xs" >
                <template x-if="content.type=='text' || content.type=='description'">
                    <x-template-text />
                </template>
                <template x-if="content.type=='select'">
                    <x-template-select />
                </template>
                <template x-if="content.type=='checkbox'">
                    <x-template-checkbox />
                </template>
                <template x-if="content.type=='radio'">
                    <x-template-radio />
                </template>
                <template x-if="content.type=='likert'">
                    <x-template-likert />
                </template>
                <template x-if="content.type=='likert_grid'">
                    <x-template-likert-grid />
                </template>
                <template x-if="content.type=='date'">
                    <x-template-date />
                </template>
                <template x-if="content.type=='radio_grid'">
                    <x-template-radio-grid />
                </template>
                <template x-if="content.type=='drag_and_drop_ranking'">
                    <x-template-drag-and-drop-ranking />
                </template>
                <template x-if="content.type=='date_picker'">
                    <x-template-date-picker />
                </template>
                <template x-if="content.type=='checkbox_grid'">
                    <x-template-checkbox-grid />
                </template>
                <template x-if="content.type=='slider'">
                    <x-template-slider />
                </template>
                <template x-if="content.type=='textbox_list'">
                    <x-template-textbox_list />
                </template>
                <template x-if="content.type=='continuous_sum'">
                    <x-template-continuous-sum />
                </template>
                <template x-if="content.type=='image_multiselect'">
                    <x-template-image-multiselect />
                </template>
                <template x-if="content.type=='image_singleselect'">
                    <x-template-image-singleselect />
                </template>
                <template x-if="content.type=='slider_list'">
                    <x-template-slider-list />
                </template>
                <template x-if="content.type!='page_break'">
                    <div>
                        <div class="flex gap-8 items-center">

                            <x-checkbox x-data="{required: false}" x-init="required = false" x-on:click="required = !required" x-model="content.required" label="Required" />
<button x-on:click="add_logic(index)" class="btn btn-primary w-32">
    Add Logic
</button>
                        </div>
                        <x-logics class="mt-4" x-show="content.logics.length" />
                    </div>
                </template>
                <template x-if="content.type=='page_break'">
                    <p>
                        Following questions will be on next page
                    </p>
                </template>
            </div>
        </div>
    </div>
</template>
