@props(['stern' => false, 'text'])
<label {{ $attributes->merge(['class' => 'block text-sm text-gray-700 dark:text-gray-400']) }}>{{ $text }} @if($stern)<span class="text-red-500">*</span>@endif</label>
