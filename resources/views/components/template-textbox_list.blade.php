<div class="flex flex-col gap-4">
    <x-part-label />
    <table class="table">
        <x-part-question-thead />
        <x-part-question-tbody />
    </table>
    <button x-on:click="add_question(index)"
        class="btn btn-primary w-32">
        Add Question
    </button>
</div>
