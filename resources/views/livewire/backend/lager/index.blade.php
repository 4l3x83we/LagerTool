<x-ag.header-admin current-text="Lager" render="lager">
    {{--<x-slot:headline>
    </x-slot:headline>--}}

    <div class="flex items-center justify-between pb-4">
        <div style="width: 320px;">
            <x-ag.input type="search" id="search" wire:model.debounce.500ms="search" placeholder="{{ __('Search...') }}" aria-label="Search"/>
        </div>
        @can('create')
            <div>
                <x-ag.button wire:click="create()" class="px-3 py-2 text-xs" icon-left="fa-plus" button-text="{{ __('Create new item') }}"/>
                {{--<div class="inline-flex ml-1 items-center">
                    <x-ag.button wire:click="exportToCsv()" class="ml-1 px-3 py-2 text-xs !bg-gray-700 !hover:bg-gray-800 !focus:ring-gray-300 !dark:bg-gray-600 !dark:hover:bg-gray-700 !dark:focus:ring-gray-800" icon-left="fa-file-csv" button-text="{{ __('CSV') }}"/>
                    <x-ag.button wire:click="exportToXls()" class="ml-1 px-3 py-2 text-xs !bg-gray-700 !hover:bg-gray-800 !focus:ring-gray-300 !dark:bg-gray-600 !dark:hover:bg-gray-700 !dark:focus:ring-gray-800" icon-left="fa-file-excel" button-text="{{ __('XLS') }}"/>
                    <x-ag.button wire:click="exportToPdf()" class="ml-1 px-3 py-2 text-xs !bg-gray-700 !hover:bg-gray-800 !focus:ring-gray-300 !dark:bg-gray-600 !dark:hover:bg-gray-700 !dark:focus:ring-gray-800" icon-left="fa-file-pdf" button-text="{{ __('PDF') }}"/>
                </div>--}}
            </div>
        @endcan
    </div>

    <div class="grid grid-cols-1 gap-y-4 mb-4">
        <x-ag.table>
            <x-slot:thead>
{{--                <th scope="col" class="p-2"></th>--}}
                <th scope="col" class="p-2">Artikelnr.</th>
                <th scope="col" class="p-2">Bezeichnung</th>
                <th scope="col" class="p-2">
                    <x-ag.sortBy :field="$sortField" id="la_lagerort" :direction="$sortDirection" text="Lagerort" wire:click="sortBy('la_lagerort')" />
                </th>
                <th scope="col" class="p-2">
                    <x-ag.sortBy :field="$sortField" id="la_bestand" :direction="$sortDirection" text="Bestand" wire:click="sortBy('la_bestand')" />
                </th>
                <th scope="col" class="p-2 w-[120px]"></th>
            </x-slot:thead>
            <x-slot:tbody>
                @forelse($lagers as $lager)
                    <x-ag.tr>
                        {{--<td class="p-2 cursor-pointer">
                            <x-ag.checkbox-inline id="selected" wire:key="{{ $lager->id }}" value="{{ $lager->id }}" text="" />
                        </td>--}}
                        <td class="p-2 cursor-pointer" wire:click="show({{ $lager->id }})">{{ $lager->artikels->art_nr }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $lager->id }})">{{ $lager->artikels->art_name }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $lager->id }})">{{ $lager->la_lagerort }}</td>
                        <td class="p-2 cursor-pointer w-[110px]" wire:click="show({{ $lager->id }})">{{ $lager->la_bestand }}</td>
                        <td class="p-2">
                            <div class="flex justify-between items-center">
                                <x-ag.buttonLink wire:click="show({{ $lager->id }})" class="p-2 text-cyan-500 hover:text-cyan-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </x-ag.buttonLink>
                                <x-ag.buttonLink wire:click="edit({{ $lager->id }})" class="p-2 text-blue-500 hover:text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </x-ag.buttonLink>
                                <a href="{{ route('backend.lager.etikett', $lager->id) }}" target="_blank" class="inline-flex items-center font-medium duration-300 p-2 text-orange-500 hover:text-orange-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                    </svg>
                                </a>
                                {{--<x-ag.buttonLink wire:click="$emit('triggerDelete',{{ $lager->id }})" class="p-2 text-red-500 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </x-ag.buttonLink>--}}
                            </div>
                        </td>
                    </x-ag.tr>
                @empty
                    <x-ag.tr>
                        <td colspan="8" class="p-2 text-center font-bold text-lg">
                            Es existieren noch keine Lagerartikel
                        </td>
                    </x-ag.tr>
                @endforelse
            </x-slot:tbody>
        </x-ag.table>
        {{ $lagers->links() }}
        {{--@push('scripts')
            @include('livewire.delete')
        @endpush--}}
    </div>

</x-ag.header-admin>
