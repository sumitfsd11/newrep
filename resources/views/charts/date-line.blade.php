<div class="w-1/3" x-data="alpine_date_line()" x-init="make(@js($content->name.'-'.$index), @js($content), @js($answers))">
    <canvas id="{{ $content->name }}-{{ $index }}">
    </canvas>
</div>
