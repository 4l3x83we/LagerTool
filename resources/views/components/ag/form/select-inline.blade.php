@php
    $classSelect = [
        'formSelect' => 'block w-full mt-1 text-xs rounded dark:text-gray-300 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray',
        'formMultiselect' => 'block w-full mt-1 text-xs rounded dark:text-gray-300 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray'
    ]
    [$classSelect ?? 'formSelect'];
@endphp

<select
    @error($id)
    {{ $attributes->merge(['id' => $id, 'class' => 'border-red-500 dark:border-red-600 ' . $classSelect, 'wire:model.lazy' => $id]) }}
    @else
        {{ $attributes->merge(['id' => $id, 'class' => 'dark:border-gray-600 ' .$classSelect, 'wire:model.lazy' => $id]) }}
        @enderror
        aria-label="{{ $id }}">
        {{--<option value="null" selected>
            @if(!$option)
                {{ __('Please select') }}
            @else
                {{ __($option) }}
           @endif
        </option>--}}
    {{ $slot }}
</select>
