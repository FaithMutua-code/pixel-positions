@props(['employer', 'width' => 90])

@php
    $logo = $employer->logo;
    if ($logo && ! str_starts_with($logo, 'http')) {
        $logo = asset('storage/' . ltrim($logo, '/')); 
    }
    $logo = $logo ?: asset('images/default-logo.svg');
@endphp

<img src="{{ $logo }}" width="{{ $width }}" class="rounded-sm" alt="profile">