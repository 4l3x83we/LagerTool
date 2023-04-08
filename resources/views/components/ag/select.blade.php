@php
$classSelect = [
    'formSelect' => 'block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray',
    'formMultiselect' => 'block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray'
]
[$classSelect ?? 'formSelect'];
@endphp

<select {{ $attributes->merge([
    'id' => $id,
    'class' => $classSelect
    ]) }}>
    <option value="null" disabled>{{ __('Please select') }}</option>
    {{ $slot }}
</select>
@error($id)
    <span class="text-xs text-red-600 dark:text-red-400">
        {{ $message }}
    </span>
@enderror
