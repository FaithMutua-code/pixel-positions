@props(['tag','size'=>'base'])

@php
    $classes = "bg-white/10 hover:bg-white/25 rounded-xl font-bold transition duration-300";

    if($size === 'base'){
        $classes .= ' px-5 py-2 text-sm';
    } elseif($size === 'small'){
        $classes .= ' px-3 py-1 text-2xs';
    }
@endphp

<a href="/tag/{{ strtolower($tag->name )}}" class="{{ $classes }}">{{ $tag->name }}</a>