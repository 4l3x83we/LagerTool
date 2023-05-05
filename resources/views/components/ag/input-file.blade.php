<input {{ $attributes->merge(['id' => $id, 'class' => 'block w-full mt-1 p-0 text-sm rounded dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input']) }}>
@error($id)
<span class="text-xs text-red-600 dark:text-red-400">
        {{ $message }}
    </span>
@enderror
