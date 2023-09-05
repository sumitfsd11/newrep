<template x-if="item.type=='checkbox'">
    <div class="form-control">
        <label :for="item.name" class="label justify-start gap-1">
            <span x-text="item.label" class="label-text"></span>
            <span class="font-bold text-error" x-show="item.required">*</span>
        </label>
        <div class="flex gap-8">
            <template x-for="(option, op_index) in item.options" :key="op_index">
                <label class="label cursor-pointer w-fit">
                    <input :disabled="disabled||readonly" type="checkbox" x-model="contents[item.name]"
                        :value="option.value" class="disabled:opacity-100 checkbox checked:bg-primary checkbox-primary" style="border-radius:5px;"/>
                    <span class="ml-1 label-text" x-text="option.option"></span> 
                </label>


            </template>
            
<div x-data="{ showOtherOption: false }" class="flex">
            <template x-if="item.other"  >

                <label class="label cursor-pointer w-fit"> 
                <input type="checkbox" :disabled="disabled||readonly"   x-init="showOtherOption = false" x-model="showOtherOption" 
                 x-on:click="showOtherOption = !showOtherOption" 
                 class="disabled:opacity-100 checkbox checked:bg-primary checkbox-primary" style="border-radius:5px;"/>
                 <span class="ml-1 label-text" >Other</span> 
                </label>

             
        
            </template>
            {{-- taking user input when other option field is selected --}}
            <input x-show="showOtherOption" type="text" placeholder="your option" 
            x-model="contents[item.name]"
            class="ml-2 w-full input max-w-xs border-b focus:border-primary"/>
        </div>


        </div>


        
    </div>
</template>
