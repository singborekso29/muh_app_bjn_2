@props([
    'href' => '#',
    'type' => 'primary',
    'icon' => '',
    'text' => '',
    'size' => '',
    'target' => '_self'
])

<a href="{{ $href }}"
   target="{{ $target }}"
   class="btn btn-{{ $type }} {{ $size }}">

    @if($icon)
        <i class="{{ $icon }} me-1"></i>
    @endif

    {{ $text }}
</a>