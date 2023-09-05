<x-base-layout>
    <section class="flex flex-col gap-4 m-4" x-data="answer_data(@js($survey->contents))" class="w-full">
        <span class="text-xl text-center mt-4 font-extrabold uppercase">{{ $survey->name }}</span>

        <span class="text-xl mt-4 font-medium m-2 border px-20">{{ $survey->description}}</span>

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
        <form x-on:submit.prevent="()=>{const ret=validate_required(); if (! ret) $event.target.submit();}"
            class="form-control pt-4 gap-4" method="POST" action="{{ route('answers.store') }}">
            @csrf
            <input name="survey_id" type="hidden" value="{{ $survey->id }}">
            <input name="contents" type="hidden" x-bind:value="JSON.stringify(contents)">
            <input type="submit" class="btn w-36 btn-primary" >
        </form>
    </section>
</x-base-layout>