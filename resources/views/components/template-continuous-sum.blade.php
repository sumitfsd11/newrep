<div class="flex flex-col gap-4">
    <label>
        <span class="label-text">Label</span>
        <input placeholder="label" x-on:keyup="set_names" x-model="content.label" type="text" class="ml-2 input input-bordered w-full max-w-xs" >
    </label>
    <table class="table">
        <x-part-question-thead />
        <x-part-question-tbody />
    </table>
    <button x-on:click="add_question(index)"
        class="btn btn-primary w-32">
        Add Question
    </button>
</div>
