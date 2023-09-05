<x-base-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="flex flex-col gap-4" x-data="answer_data(@js($answer->survey->contents), @js($answer->contents))" class="w-full">
        <span class="text-xl mt-4 font-extrabold">{{ $answer->survey->name }}</span>
        <span class="font-bold text-error">* Required Field</span>
        <x-template-master-answer />
        <form class="form-control pt-4 gap-4" method="POST" action="{{ route('answers.update', $answer->id) }}">
            @csrf
            <input name="contents" type="hidden" x-bind:value="JSON.stringify(contents)">
            <input type="submit" class="btn w-36 btn-primary" >
        </form>
    </section>
</x-base-layout>
