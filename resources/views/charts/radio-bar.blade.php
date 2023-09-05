<div class="w-1/3" x-data="alpine_bar()" x-init="make(@js($content->name.'-'.$index), @js($content), @js($answers), pics)">
    <canvas id="{{ $content->name }}-{{ $index }}">
    </canvas>
</div>
