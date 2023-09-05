<div x-data="{toggle_help: false}" class="flex flex-col gap-4">
    <x-part-label />
    <label class="label">
        <span class="label-text">Format</span>
        <input placeholder="format" x-model="content.format" type="text" class="input input-bordered w-full max-w-xs ml-2" >
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
