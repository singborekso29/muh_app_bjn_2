@props([
    'type' => 'secondary',
    'text' => '',
])

<span class="badge bg-{{ $type }}">
    {{ $text }}
</span>