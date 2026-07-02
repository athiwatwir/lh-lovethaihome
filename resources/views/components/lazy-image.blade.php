@props([
    'src',
    'alt' => '',
    'eager' => false,
    'highPriority' => false,
])

@php
    $placeholder = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 3'%3E%3Crect fill='%23f3f4f6' width='4' height='3'/%3E%3C/svg%3E";
@endphp

<img
    @if ($eager)
        src="{{ $src }}"
    @else
        src="{{ $placeholder }}"
        data-lazy-src="{{ $src }}"
    @endif
    alt="{{ $alt }}"
    {{ $attributes->class(['bg-gray-100']) }}
    decoding="async"
    @if ($eager) loading="eager" @else loading="lazy" @endif
    @if ($highPriority) fetchpriority="high" @endif>
