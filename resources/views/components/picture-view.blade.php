<div style="border-width:4px" class="p-2" :class="{ 'border-4 border-green-500' : _.includes(contents[item.name], option.value)}" x-data="{pictures: @js($pictures)}">

    <img x-show="option.option" class="h-32 border-gray-50 w-32"
    x-bind:src="'/storage/' + option.value" 
   x-bind:alt="option.option"  
       > 
</div>