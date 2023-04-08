@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="relative bg-white rounded shadow dark:bg-gray-700">
        <div class="flex items-start p-4 justify-between border-b border-gray-200 dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $title }}</h3>
        </div>

        <div class="px-4 py-2 text-sm text-gray-600 dark:text-gray-400">
            {{ $content }}
        </div>

        <div class="flex flex-row justify-end border-t border-gray-200 dark:border-gray-600 px-6 py-4 text-right">
            {{ $footer }}
        </div>
    </div>
</x-modal>
