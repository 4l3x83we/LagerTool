<input type="{{ $type ?? 'text' }}" @error($id)
    {!! $attributes->merge(['id' => $id, 'wire:model.lazy' => $id, 'placeholder' => $text, 'class' => 'block w-full mt-1 text-xs rounded border-red-500 dark:border-red-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input']) !!}
@else
    {!! $attributes->merge(['id' => $id, 'wire:model.lazy' => $id, 'placeholder' => $text, 'class' => 'block w-full mt-1 text-xs rounded dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input']) !!}
@enderror>
