<template x-if="item.type=='date'">
    <div x-data="{local_date:dayjs(contents[item.name]).isValid()?dayjs(contents[item.name]).format(item.format):'', toggle_help: false, is_valid: false}" class="form-control w-full max-w-xs">
        <label :for="item.name" class="label justify-start gap-1">
            <span x-text="item.label" class="label-text"></span>
            <span class="font-bold text-error" x-show="item.required">*</span>
        </label>
        <input x-model="contents[item.name]" type="hidden" />
        <input x-on:keyup="is_valid = dayjs(local_date, item.format, true).isValid();
            contents[item.name] = dayjs(local_date, item.format).format('YYYY-MM-DD')"
            :disabled="disabled" :readonly="readonly" x-model="local_date" type="text" :name="item.name" :id="item.name"
            class="input input-bordered w-full max-w-xs" />
        <label class="label justify-start gap-1">
            <span class="label-text-alt">Date Format Required:</span>
            <span x-text="item.format" class="font-bold label-text-alt"></span>
            <span x-show="local_date && !(readonly || disabled)" :class="is_valid?'text-success':'text-error'"  x-text="is_valid?'Valid Format':'Invalid Fomat'" class="self-end flex-grow text-right label-text-alt">Valid?</span>
        </label>
        <div class="form-control">
        <label class="label w-fit cursor-pointer">
            <input type="checkbox" class="toggle" x-model="toggle_help" />
            <span class="label-text ml-4">Toggle Help Table</span> 
        </label>
    </div>
        <table x-show="toggle_help" class="table">
            <thead>
                <tr>
                    <th>Input</th>
                    <th>Example</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                {{-- https://day.js.org/docs/en/parse/string-format#list-of-all-available-parsing-tokens --}}
                <tr><td><code>YY</code></td><td>01</td><td>Two-digit year</td></tr>
                <tr><td><code>YYYY</code></td><td>2001</td><td>Four-digit year</td></tr>
                <tr><td><code>M</code></td><td>1-12</td><td>Month, beginning at 1</td></tr>
                <tr><td><code>MM</code></td><td>01-12</td><td>Month, 2-digits</td></tr>
                <tr><td><code>MMM</code></td><td>Jan-Dec</td><td>The abbreviated month name</td></tr>
                <tr><td><code>MMMM</code></td><td>January-December</td><td>The full month name</td></tr>
                <tr><td><code>D</code></td><td>1-31</td><td>Day of month</td></tr>
                <tr><td><code>DD</code></td><td>01-31</td><td>Day of month, 2-digits</td></tr>
            </tbody>
        </table>
    </div>
</template>
