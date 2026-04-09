@props(['employer', 'width' => 90])

@php
    $logo = $employer?->logo;

    if ($logo && !str_starts_with($logo, 'http')) {
        $logo = asset('storage/' . ltrim($logo, '/'));
    }

    $logo = $logo ?: asset('images/default-logo.svg');
@endphp

<img 
    src="{{ $logo }}"
    {{ $attributes->merge(['class' => ' object-cover']) }} 
    style="width: {{ $width }}px; height: {{ $width }}px;"
    alt="employer logo"
/>