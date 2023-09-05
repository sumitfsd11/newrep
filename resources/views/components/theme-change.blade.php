<div class="flex gap-2 items-center">
    @if($attributes->has('with-label'))
        <label class="label" for="theme">Theme</label>
    @endif
    <select id="theme" class="select select-secondary" data-choose-theme>
        <option selected value="cupcake">Default</option>
        <option value="light">Light</option>
        <option value="dark">Dark</option>
        <option value="emerald">Sacoda Light</option>
        <option value="business">Sacoda Dark</option>
    </select>
</div>