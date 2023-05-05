<div class="flex items-center mr-4 h-11">
    <input type="radio" {{ $attributes->merge(['id' => $id, 'class' => 'w-4 h-4 text-orange-600 border-gray-300 focus:ring-2 focus:ring-orange-300 dark:focus:ring-orange-600 dark:focus:bg-orange-600 dark:bg-gray-700 dark:border-gray-600']) }} />
    <label for="{{ $id }}" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{!! $text !!}</label>
</div>
