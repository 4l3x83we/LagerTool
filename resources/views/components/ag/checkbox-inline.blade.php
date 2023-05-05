<div class='flex items-center'>
    <input type="checkbox" {{ $attributes->merge(['id' => $id, 'wire:model' => $id, 'value' => $id, 'class' => 'w-4 h-4 text-orange-600 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600']) }} />
    <label for="{{ $id }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{!! $text !!}</label>
</div>
