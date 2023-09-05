<x-base-layout>
    <section class="flex flex-col gap-4" x-init="make_readonly" x-data="answer_data(@js($answer->survey->contents), @js($answer->contents))" class="w-full">
        <span class="text-xl mt-4 font-extrabold">{{ $answer->survey->name }}</span>
        <span class="text-xl font-bold">Showing Answer | ID: {{ $answer->id }}</span>
        <span class="font-bold text-error">* Required Field</span>
        <div class="tabs">
            <template x-for="(page, i) in pages.length" :key="i">
                <div x-on:click="current_page=tab;"
                    x-data="{tab: i}" class="tab tab-lg tab-lifted" :class="{'tab-active': current_page===tab}">
                    <p x-text="`Page ${i+1}`"></p>
                </div>
            </template>
        </div>
        <x-template-master-answer />
        <div>
            <button x-on:click="current_page=0" class="btn btn-primary">First</button>
            <button x-on:click="current_page=current_page-1" class="btn btn-primary" :disabled="current_page===0">Previous</button>
            <button x-on:click="current_page=current_page+1" class="btn btn-primary" :disabled="current_page===pages.length-1">Next</button>
            <button x-on:click="current_page=pages.length-1" class="btn btn-primary">Last</button>
        </div>
    </section>
</x-base-layout>
