@props(['stern' => false, 'text'])
<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-900 dark:text-gray-300 whitespace-normal']) }}>{!! $text !!}@if($stern) <span class="text-red-500">*</span>@endif</label>
