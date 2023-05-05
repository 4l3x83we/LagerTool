<div>
    <x-ag.button wire:click="exportToCsv()" class="px-3 py-2 text-xs !bg-gray-700 !hover:bg-gray-800 !focus:ring-gray-300 !dark:bg-gray-600 !dark:hover:bg-gray-700 !dark:focus:ring-gray-800" icon-left="fa-file-csv" button-text="{{ __('CSV') }}"/>
    <x-ag.button wire:click="exportToXls()" class="px-3 py-2 text-xs !bg-gray-700 !hover:bg-gray-800 !focus:ring-gray-300 !dark:bg-gray-600 !dark:hover:bg-gray-700 !dark:focus:ring-gray-800" icon-left="fa-file-excel" button-text="{{ __('XLS') }}"/>
    <x-ag.button wire:click="exportToPdf()" class="px-3 py-2 text-xs !bg-gray-700 !hover:bg-gray-800 !focus:ring-gray-300 !dark:bg-gray-600 !dark:hover:bg-gray-700 !dark:focus:ring-gray-800" icon-left="fa-file-pdf" button-text="{{ __('PDF') }}"/>
</div>
