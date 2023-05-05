@php
    $label = [
        'hidden' => 'hidden block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'visible' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
    ]
    [$label ?? 'visible'];
@endphp
<label {{ $attributes->merge(['for' => $id, 'class' => $label]) }}>{!! $text ?: '' !!}</label>
<textarea aria-label="{{ $id }}" {{ $attributes->merge(['id' => $id, 'wire:model.lazy' => $id, 'class' => 'block p-2.5 w-full text-xs text-gray-900 bg-gray-50 rounded border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>{!! $content ?: '' !!}</textarea>


