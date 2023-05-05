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
    <x-ag.header-admin render="model" current-text="Settings Model">
        <x-slot:headline></x-slot:headline>
        @can(['create', 'update'])

        @if($updateMode)
            @can('update')
                @include('livewire.admin.settings.model.edit')
            @endcan
            <x-ag.hr class="my-4" />
        @else
            @can('create')
                @include('livewire.admin.settings.model.create')
            @endcan
            <x-ag.hr class="my-4" />
        @endif

        @endcan

        {{--@if(!$updateMode)
            <div class="grid grid-cols-1 gap-y-4 mb-4">
                <div id="accordion-collapse" data-accordion="collapse">
                    @foreach(sort_by_hersteller($amount) as $key => $value)
                        @foreach($value as $he)
                            @if($he->models_count > 0)
                                @if($he->hr_name === $key)
                                    <h2 id="accordion-collapse-heading-{{ str_replace([' ', '&'], '', $key) }}">
                                        <button type="button" class="flex items-center justify-between w-full py-2 px-5 font-medium text-left text-gray-500 border border-b-0 last:border-b dark:last:border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-{{ str_replace([' ', '&'], '', $key) }}" aria-expanded="false" aria-controls="accordion-collapse-body-{{ str_replace([' ', '&'], '', $key) }}">
                                            <span>{{ $key }} <x-ag.badge color="blue" text="{{ $he->models_count }}" class="ml-4"/> </span>
                                            <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </h2>
                                @endif
                                <div id="accordion-collapse-body-{{ str_replace([' ', '&'], '', $key) }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ str_replace([' ', '&'], '', $key) }}">
                                    <div class="py-2 px-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <x-ag.table>
                                            <x-slot:tbody>
                                                @foreach($he->models as $item)
                                                    <x-ag.tr>
                                                        <td class="px-4 py-2">{{ $item->md_name . ' (' .$item->id. ')' }}</td>
                                                        <td class="px-4 py-2">
                                                            <div class="flex justify-end items-center">
                                                                <x-ag.buttonLink wire:click="edit({{$item->id}})" class="text-blue-500 hover:text-blue-700 mr-8" icon="fa-pen" />
                                                                <x-ag.buttonLink wire:click="destroy({{$item->id}})" class="text-red-500 hover:text-red-700 mr-2" icon="fa-trash" />
                                                            </div>
                                                        </td>
                                                    </x-ag.tr>
                                                @endforeach
                                            </x-slot:tbody>
                                        </x-ag.table>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    <div class="border-t border-gray-200 dark:border-gray-700"></div>
                </div>
            </div>
        @endif--}}
    </x-ag.header-admin>
</div>
