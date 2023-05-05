@props(['step', 'steps', 'text', 'liStep', 'icon' => null])
@php
    $step = [
        'active' => 'flex items-center justify-center w-5 h-5 mr-2 text-xs border border-orange-600 rounded-full shrink-0 dark:border-orange-500',
        'inactive' => 'flex items-center justify-center w-5 h-5 mr-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400',
    ]
    [$step ?? 'inactive'];
    $liStep = [
        'active' => 'flex items-center text-orange-600 dark:text-orange-500',
        'inactive' => 'flex items-center'
    ]
    [$liStep ?? 'inactive']

@endphp
<li {{ $attributes->merge(['class' => $liStep]) }}>
    <span {{ $attributes->merge(['class' => $step]) }}>
        {{ $steps ?? '' }}
    </span>
    {{ $text ?? '' }}
    {!! $icon ? '<svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>' : '' !!}
</li>
