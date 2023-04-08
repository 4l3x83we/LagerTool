@props(['heading', 'text', 'textWidth'])

@php
    $textWidth = [
        'lg' => 'text-lg font-bold dark:text-white',
        'xl' => 'text-xl font-bold dark:text-white',
        '2xl' => 'text-2xl font-bold dark:text-white',
        '3xl' => 'text-3xl font-bold dark:text-white',
        '4xl' => 'text-4xl font-bold dark:text-white',
    ][$textWidth ?? '2xl'];
@endphp

<{{$heading}} {{ $attributes->merge(['class' => $textWidth]) }}>{{ $text }}</{{ $heading }}>

