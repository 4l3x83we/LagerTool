<x-ag.header-admin current-text="Artikel" render="artikel">
    {{--<x-slot:headline>
    </x-slot:headline>--}}

    <div class="flex items-center justify-between pb-4">
        <div style="width: 320px;">
            <x-ag.input type="search" id="search" wire:model.debounce.500ms="search" placeholder="{{ __('Search...') }}" aria-label="Search"/>
        </div>
        @can('create')
            <div>
                <x-ag.button wire:click="create()" class="px-3 py-2 text-xs" icon-left="fa-plus" button-text="{{ __('Create new item') }}"/>
            </div>
        @endcan
    </div>

    <div class="grid grid-cols-1 gap-y-4 mb-4">
        <x-ag.table>
            <x-slot:thead>
                <th scope="col" class="p-2">
                    <x-ag.sortBy :field="$sortField" id="art_nr" :direction="$sortDirection" text="Artikelnr." wire:click="sortBy('art_nr')" />
                </th>
                <th scope="col" class="p-2">
                    <x-ag.sortBy :field="$sortField" id="art_name" :direction="$sortDirection" text="Bezeichnung" wire:click="sortBy('art_name')" />
                </th>
                <th scope="col" class="p-2">
                    <x-ag.sortBy :field="$sortField" id="art_ean" :direction="$sortDirection" text="EAN" wire:click="sortBy('art_ean')" />
                </th>
                <th scope="col" class="p-2">
                    <x-ag.sortBy :field="$sortField" id="lagers.la_bestand" :direction="$sortDirection" text="Bestand" wire:click="sortBy('lagers.la_bestand')" />
                </th>
                <th scope="col" class="p-2">
                    <x-ag.sortBy :field="$sortField" id="preises.pr_netto_ek" :direction="$sortDirection" text="Netto EK" wire:click="sortBy('preises.pr_netto_ek')" />
                </th>
                <th scope="col" class="p-2">
                    <x-ag.sortBy :field="$sortField" id="preises.pr_netto_vk" :direction="$sortDirection" text="Netto VK" wire:click="sortBy('preises.pr_netto_vk')" />
                </th>
                <th scope="col" class="p-2">
                    <x-ag.sortBy :field="$sortField" id="preises.pr_brutto_vk" :direction="$sortDirection" text="Brutto VK" wire:click="sortBy('preises.pr_brutto_vk')" />
                </th>
                <th scope="col" class="p-2 w-[120px]"></th>
            </x-slot:thead>
            <x-slot:tbody>
                @forelse($artikels as $artikel)
                    <x-ag.tr>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $artikel->id }})">{{ $artikel->art_nr }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $artikel->id }})">{{ $artikel->art_name }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $artikel->id }})">{{ $artikel->art_ean }}</td>
                        <td class="p-2 cursor-pointer w-[110px]" wire:click="show({{ $artikel->id }})">{{ $artikel->lagers->la_bestand }}</td>
                        <td class="p-2 cursor-pointer text-right w-[110px]" wire:click="show({{ $artikel->id }})">{{ $artikel->preises->nettoEK() }}</td>
                        <td class="p-2 cursor-pointer text-right w-[110px]" wire:click="show({{ $artikel->id }})">{{ $artikel->preises->nettoVK() }}</td>
                        <td class="p-2 cursor-pointer text-right w-[110px]" wire:click="show({{ $artikel->id }})">{{ $artikel->preises->bruttoVK() }}</td>
                        <td class="p-2">
                            <div class="flex justify-between items-center">
                                <x-ag.buttonLink wire:click="show({{ $artikel->id }})" class="p-2 text-cyan-500 hover:text-cyan-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </x-ag.buttonLink>
                                <x-ag.buttonLink wire:click="edit({{ $artikel->id }})" class="p-2 text-blue-500 hover:text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </x-ag.buttonLink>
                                <x-ag.buttonLink wire:click="$emit('triggerDelete',{{ $artikel->id }})" class="p-2 text-red-500 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </x-ag.buttonLink>
                            </div>
                        </td>
                    </x-ag.tr>
                @empty
                    <x-ag.tr>
                        <td colspan="8" class="p-2 text-center font-bold text-lg">
                            Es existieren noch keine Artikel
                        </td>
                    </x-ag.tr>
                @endforelse
            </x-slot:tbody>
        </x-ag.table>
        {{ $artikels->links() }}
        @push('scripts')
            @include('livewire.delete')
        @endpush
    </div>

</x-ag.header-admin>

