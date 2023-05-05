@php use App\Models\Backend\Kunden\Kundens; @endphp
<div>
    <x-ag.header-admin current-text="Kunden" render="kunden">
        {{--<x-slot:headline>
        </x-slot:headline>--}}

        <div class="flex items-center justify-between pb-4">
            <div style="width: 320px;">
                <x-ag.input type="search" id="search" wire:model.debounce.500ms="search" placeholder="{{ __('Search...') }}" aria-label="Search"/>
            </div>
            @can('create')
                <div>
                    <x-ag.button wire:click="create()" class="px-3 py-2 text-xs" icon-left="fa-plus" button-text="{{ __('Add New Customers') }}"/>
                </div>
            @endcan
        </div>

        <div class="grid grid-cols-1 gap-y-4 mb-4">

                <x-ag.table>
                <x-slot:thead>
                    <th scope="col" class="p-2" style="width: 90px;">
                        <x-ag.sortBy :field="$sortField" id="kd_kundennummer" :direction="$sortDirection" text="Kd-Nr." wire:click="sortBy('kd_kundennummer')"/>
                    </th>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="kd_name" :direction="$sortDirection" text="Name/Firma" wire:click="sortBy('kd_name')"/>
                    </th>
                    <th scope="col" class="p-2">
                        <x-ag.sortBy :field="$sortField" id="kd_vorname" :direction="$sortDirection" text="Vorname" wire:click="sortBy('kd_vorname')"/>
                    </th>
                    <th scope="col" class="p-2">Straße</th>
                    <th scope="col" class="p-2">PLZ/Ort</th>
                    <th scope="col" class="p-2">Telefon/Mobil</th>
                    <th scope="col" class="p-2">E-Mail</th>
                    <th scope="col" class="p-2" style="width: 140px;"></th>
                </x-slot:thead>
                <x-slot:tbody>
                    @forelse($kundens as $kunden)
                        <x-ag.tr>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $kunden->id }})" style="width: 90px;">{{ $kunden->kd_kundennummer }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $kunden->id }})">{{ $kunden->kd_name }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $kunden->id }})">{{ $kunden->kd_vorname }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $kunden->id }})">{{ $kunden->kd_strasse }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $kunden->id }})">{{ $kunden->kd_plz . ' ' . $kunden->kd_ort }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $kunden->id }})">@if($kunden->kd_telefon and $kunden->kd_telefon)
                                    {{ $kunden->kd_telefon . ' / ' . $kunden->kd_mobil }}
                                @elseif($kunden->kd_telefon)
                                    {{ $kunden->kd_telefon }}
                                @else
                                    {{ $kunden->kd_mobil }}
                                @endif</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $kunden->id }})">{{ $kunden->kd_email }}</td>
                            <td class="p-2" style="width: 140px;">
                                <div class="flex justify-between items-center">
                                    <x-ag.buttonLink wire:click="show({{ $kunden->id }})" class="p-2 text-cyan-500 hover:text-cyan-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </x-ag.buttonLink>
                                    <x-ag.buttonLink wire:click="edit({{ $kunden->id }})" class="p-2 text-blue-500 hover:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                    </x-ag.buttonLink>
                                    <x-ag.buttonLink wire:click="$emit('triggerDelete',{{ $kunden->id }})" class="p-2 text-red-500 hover:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </x-ag.buttonLink>
                                </div>
                            </td>
                        </x-ag.tr>
                        {{--@if($kunden->datenschutzerklaerungs)
                            <x-ag.tr>
                                <td colspan="9" class="p-1 text-center">Datenschutzrechtliche Einwilligungserklärung
                                    <x-ag.table>
                                        <x-slot:tbody>
                                            <x-ag.tr>
                                                <td class="p-2" style="width: 200px;">Erteilt
                                                    am: {{ $kunden->datenschutzerklaerungs->erteiltAm() }}</td>
                                                <td class="p-2">
                                                    <div class="flex flex-row">
                                                        <span class="font-bold pr-2 {{ ($kunden->datenschutzerklaerungs->da_briefe) ? 'text-green-500' : 'text-red-500' }}" title="Briefe"><em class="fa-solid fa-envelopes-bulk"></em></span>
                                                        <span class="font-bold pr-2 {{ ($kunden->datenschutzerklaerungs->da_telefon) ? 'text-green-500' : 'text-red-500' }}" title="Telefon"><em class="fa-solid fa-phone"></em></span>
                                                        <span class="font-bold pr-2 {{ ($kunden->datenschutzerklaerungs->da_fax) ? 'text-green-500' : 'text-red-500' }}" title="Fax"><em class="fa-solid fa-fax"></em></span>
                                                        <span class="font-bold pr-2 {{ ($kunden->datenschutzerklaerungs->da_mobile) ? 'text-green-500' : 'text-red-500' }}" title="Mobil"><em class="fa-solid fa-mobile-screen-button"></em></span>
                                                        <span class="font-bold pr-2 {{ ($kunden->datenschutzerklaerungs->da_sms) ? 'text-green-500' : 'text-red-500' }}" title="SMS"><em class="fa-solid fa-comment-sms"></em></span>
                                                        <span class="font-bold pr-2 {{ ($kunden->datenschutzerklaerungs->da_whatsapp) ? 'text-green-500' : 'text-red-500' }}" title="WhatsApp"><em class="fa-brands fa-whatsapp"></em></span>
                                                        <span class="font-bold pr-2 {{ ($kunden->datenschutzerklaerungs->da_email) ? 'text-green-500' : 'text-red-500' }}" title="E-Mail"><em class="fa-solid fa-envelope"></em></span>
                                                    </div>
                                                </td>
                                            </x-ag.tr>
                                        </x-slot:tbody>
                                    </x-ag.table>
                                </td>
                            </x-ag.tr>
                        @endif--}}
                    @empty
                        <x-ag.tr>
                            <td colspan="9" class="p-2 text-center font-bold text-lg">
                                Es sind noch keine Kunden angelegt.
                            </td>
                        </x-ag.tr>
                    @endforelse
                </x-slot:tbody>
            </x-ag.table>
            {{ $kundens->links() }}
            @push('scripts')
                @include('livewire.delete')
            @endpush
        </div>
    </x-ag.header-admin>

</div>
