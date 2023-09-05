<x-base-layout>
    <section x-data="{survey:@js($survey), answers:@js($survey->answers), pics:@js($pics)}">
        @foreach ($survey->contents as $content)
            @if($content->type == 'select' || $content->type == 'radio' || $content->type == 'likert' || $content->type == 'image_singleselect')
                @include('charts.radio-pie', ['index' => 0, 'content' => $content, 'answers' => $survey->answers->pluck('contents')->pluck($content->name)])
                @include('charts.radio-bar', ['index' => 1, 'content' => $content, 'answers' => $survey->answers->pluck('contents')->pluck($content->name)])
            @elseif($content->type == 'checkbox' || $content->type == 'image_multiselect')
                @include('charts.checkbox-bar', ['index' => 0, 'content' => $content, 'answers' => $survey->answers->pluck('contents')->pluck($content->name)])
            @elseif($content->type == 'date_picker' || $content->type == 'slider')
                @include('charts.date-line', ['index' => 0, 'content' => $content, 'answers' => $survey->answers->pluck('contents')->pluck($content->name)])
            @endif
        @endforeach
    </section>
</x-base-layout>
