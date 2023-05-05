<input {{ $attributes->merge(['id' => $id, 'class' => 'block w-full text-sm text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400']) }} type="file">
@error($id)
    <span class="text-xs text-red-600 dark:text-red-400">
        {{ $message }}
    </span>
@enderror
