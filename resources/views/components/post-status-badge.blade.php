@php
    $config = $config();
@endphp

<span
    class="{{ $position }} px-3 py-1 {{ $config['class'] }} text-white text-xs font-semibold rounded-full flex items-center gap-1">
    @if(isset($config['icon']))
        <span class="text-xs">{{ $config['icon'] }}</span>
    @endif
    {{ $config['text'] }}
</span>
