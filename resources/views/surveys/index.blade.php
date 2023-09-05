<x-base-layout>
    <h2 class="text-3xl pt-8 text-center">
        Published Surveys
        <a href="{{ route('surveys.create') }}">
            <button class="btn btn-primary">Create New Survey</button>
        </a>
    </h2>
    <section class="my-8 flex flex-wrap gap-8 justify-center">
        @foreach ($surveys as $survey)
        <div class="card w-96 bg-base-100 shadow-xl image-full">
            <figure><img src="https://placewaifu.com/image/400/225" alt="Shoes" /></figure>
            <div class="card-body">
                <a href="{{ route('surveys.show', $survey->id) }}">
                    <h2 class="font-bold underline card-title">{{ $survey->name }}</h2>
                </a>
                <p>Are you ready to take this survey?</p>
                <p>Questions: {{ $survey->fields_count }}</p>
                <p>Responses: {{ $survey->answers->count() }}</p>
                <div class="card-actions justify-end">
                    <a href="{{ route('answers.create', ['id' => \App\Helpers\UrlHelper::urlSafeHashMake($survey->id)]) }}">
                        <button class="btn btn-primary">Answer Now</button>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </section>
</x-base-layout>
