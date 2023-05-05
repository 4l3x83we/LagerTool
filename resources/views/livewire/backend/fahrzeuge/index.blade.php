@php use App\Models\Backend\Fahrzeuge\Fahrzeuges;use Carbon\Carbon; @endphp
<div>
    <x-ag.header-admin current-text="Vehicles" render="fahrzeuge">
        {{--<x-slot:headline>
        </x-slot:headline>--}}

        <div class="grid grid-cols-1 md:grid-cols-2 pb-4">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <x-ag.form.input-inline type="search" id="search" class="mt-2 md:mt-1" text="Suche" wire:model.debounce.500ms="search" placeholder="{{ __('Search...') }}" aria-label="Search"/>
                <x-ag.form.select-inline id="selectedHersteller" class="md:ml-2 mt-2 md:mt-1">
                    <option value="">Alle</option>
                    @foreach($fahrzeuges->hersteller as $fahrzeug)
                        <option value="{{ $fahrzeug->fz_hersteller }}">{{ $fahrzeug->fz_hersteller }}</option>
                    @endforeach
                </x-ag.form.select-inline>
            </div>
            <div class="text-right mt-2 md:mt-0">
                @can('create')
                    <x-ag.button wire:click="create()" icon-left="fa-plus" button-text="{{ __('Add New Vehicle') }}"/>
                @endcan
            </div>
        </div>

        <div class="grid grid-cols-1 gap-y-4 mb-4">
            <x-ag.table>
                <x-slot:thead>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="id" :direction="$sortDirection" text="Int. Fz.-Nr." wire:click="sortBy('id')"/>
                    </th>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="fz_kennzeichen" :direction="$sortDirection" text="Kennzeichen" wire:click="sortBy('fz_kennzeichen')"/>
                    </th>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="fz_fz_id_nr" :direction="$sortDirection" text="Fz. Ident.-Nr" wire:click="sortBy('fz_fz_id_nr')"/>
                    </th>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="fz_hsn" :direction="$sortDirection" text="HSN" wire:click="sortBy('fz_hsn')"/>
                    </th>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="fz_tsn" :direction="$sortDirection" text="TSN" wire:click="sortBy('fz_tsn')"/>
                    </th>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="fz_hersteller" :direction="$sortDirection" text="Marke" wire:click="sortBy('fz_hersteller')"/>
                    </th>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="fz_model" :direction="$sortDirection" text="Modell" wire:click="sortBy('fz_model')"/>
                    </th>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="fz_baujahr" :direction="$sortDirection" text="EZ" wire:click="sortBy('fz_baujahr')"/>
                    </th>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="fz_kilometerstand" :direction="$sortDirection" text="KM" wire:click="sortBy('fz_kilometerstand')"/>
                    </th>
                    <th scope="col" class="p-2">Kd.-Nr</th>
                    <th scope="col" class="p-2">Name</th>
                    <th scope="col" class="p-2"></th>
                </x-slot:thead>
                <x-slot:tbody>
                    @forelse($fahrzeuges as $fahrzeug)
                        <x-ag.tr>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->id }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->fz_kennzeichen }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->fz_fz_id_nr }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->fz_hsn }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->fz_tsn }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->fz_hersteller }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->fz_model . ' ' . $fahrzeug->fz_type }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->ez() }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->fz_kilometerstand }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->kunden->kd_kundennummer }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $fahrzeug->id }})">{{ $fahrzeug->kunden->fullname() }}</td>
                            <td class="p-2">
                                <div class="flex justify-between items-center">
                                    <x-ag.buttonLink wire:click="show({{ $fahrzeug->id }})" class="p-2 text-cyan-500 hover:text-cyan-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </x-ag.buttonLink>
                                    <x-ag.buttonLink wire:click="edit({{ $fahrzeug->id }})" class="p-2 text-blue-500 hover:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                    </x-ag.buttonLink>
                                    <x-ag.buttonLink wire:click="$emit('triggerDelete',{{ $fahrzeug->id }})" class="p-2 text-red-500 hover:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </x-ag.buttonLink>
                                </div>
                            </td>
                        </x-ag.tr>
                    @empty
                        <x-ag.tr>
                            <td colspan="12" class="p-2 text-center font-bold text-lg">
                                Es sind noch keine Fahrzeuge angelegt.
                            </td>
                        </x-ag.tr>
                    @endforelse
                </x-slot:tbody>
            </x-ag.table>
            {{ $fahrzeuges->links() }}
            @push('scripts')
                @include('livewire.delete')
            @endpush
        </div>

    </x-ag.header-admin>
</div>
