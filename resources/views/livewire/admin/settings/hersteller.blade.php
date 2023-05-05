<div>
    <nav class="bg-gray-100 dark:bg-gray-700">
        <div class="w-full flex flex-wrap items-center justify-end mx-auto p-4">
            <button @click="toggleSettingsMenu" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-label="Menu">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="w-full">
                <ul class="hidden lg:flex justify-end items-center flex-row flex-wrap font-medium my-2 gap-2.5 mr-6 space-x-8 text-sm">
                    <x-partials.settings.navbar />
                </ul>
                <div class="w-full lg:hidden"
                     x-show="isSettingsMenuOpen"
                     x-transition:enter="transition ease-in-out duration-150"
                     x-transition:enter-start="opacity-0 transform -translate-y-20"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in-out duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0 transform -translate-y-20"
                     @close="closeSettingsMenu"
                     @keydown.esc="closeSettingsMenu">
                    <ul class="font-medium flex flex-col text-sm p-4 lg:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 lg:bg-white dark:bg-gray-800 lg:dark:bg-gray-900 dark:border-gray-700">
                        <x-partials.settings.navbar />
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <x-ag.header-admin current-text="Settings Manufacturer" render="hersteller">
        <x-slot:headline></x-slot:headline>
        @can(['create', 'update'])

            @if($updateMode)
                @can('update')
                    @include('livewire.admin.settings.hersteller.edit')
                @endcan
                <x-ag.hr class="my-4" />
            @else
                @can('create')
                    @include('livewire.admin.settings.hersteller.create')
                @endcan
                <x-ag.hr class="my-4" />
            @endif

        @endcan

        @if(!$updateMode)
        <div class="grid grid-cols-1 gap-y-4 mb-4">
            <x-ag.table>
                <x-slot:thead>
                    <tr>
                        <th class="px-6 py-2">Name</th>
                        <th class="px-6 py-2"></th>
                    </tr>
                </x-slot:thead>
                <x-slot:tbody>
                    @foreach($herstellers as $hersteller)
                        <x-ag.tr>
                            <td class="px-6 py-2">{{ $hersteller->hr_name }}</td>
                            <td class="px-6 py-2">
                                <div class="flex justify-end items-center">
                                    <x-ag.buttonLink wire:click="edit({{$hersteller->id}})" class="text-cyan-500 hover:text-cyan-700 mr-8" icon="fa-eye" />
                                    <x-ag.buttonLink wire:click="edit({{$hersteller->id}})" class="text-blue-500 hover:text-blue-700 mr-8" icon="fa-pen" />
                                    <x-ag.buttonLink wire:click="destroy({{$hersteller->id}})" class="text-red-500 hover:text-red-700 mr-2" icon="fa-trash" />
                                </div>
                            </td>
                        </x-ag.tr>
                    @endforeach
                </x-slot:tbody>
            </x-ag.table>
            <nav class="flex justify-end items-center" aria-label="Table Navigation">
                @if(count($herstellers) >= 15)
                    <x-ag.button wire:click="load" button-text="{{ __('Load more...') }}" />
                @endif
            </nav>
        </div>
        @endif
    </x-ag.header-admin>
</div>
