@props(['method' => 'GET'])

<form {{ $attributes->merge(['class' => 'max-w-2xl mx-auto space-y-6']) }}>
    @csrf

    @if (!in_array(strtoupper($method), ['GET', 'POST']))
        @method($method)
    @endif

    {{ $slot }}
</form>