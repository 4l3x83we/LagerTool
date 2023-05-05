@php use Carbon\Carbon; @endphp
<x-ag.header-admin current-text="Kunden">
    <x-slot:var>
        {!! Breadcrumbs::render("kundenShow", $kunde) !!}
    </x-slot:var>

    <div class="flex items-center justify-between pb-4">
        <span class="text-lg text-gray-500 md:text-xl dark:text-gray-400">{{ $kunde->fullname() }}</span>
        <div>
            <x-ag.link link="{{ route('backend.kunden') }}" class="px-3 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-600 text-xs" icon-left="fa-rotate-left" text="{{ __('Back') }}"/>
        </div>
    </div>

    <div class="px-4 py-3 bg-gray-50 rounded shadow-md dark:bg-gray-800 text-gray-500 dark:text-gray-400">

        <div class="py-5 mx-auto">
            <div class="grid xl:grid-cols-3 grid-cols-1 gap-4 px-4">
                <!-- Left col -->
                <div class="xl:col-span-2">
                    <div class="flex flex-col mb-4">
                        <div class="flex xl:items-center items-start flex-col xl:flex-row xl:justify-between mb-2">
                            <div class="inline-flex items-center mb-2">
                                <x-ag.heading heading="h2" class="leading-none" :text="$kunde->kd_anrede . ' ' . $kunde->fullname()"/>
                                <x-ag.badge color="gray-sm" class="mx-2.5" text="{!! $kunde->kundentype() !!}"/>
                            </div>
                            <x-ag.badge color="purple-border" class="xl:mx-2.5" text="{!! 'Kunde seit: ' . $kunde->getKundeSeitAttribute() . ' ' . Carbon::parse($kunde->kd_kunde_seit)->fromNow() !!}"/>
                        </div>
                        <div class="mb-2">
                            <x-ag.badge color="gray-border" text="{!! 'Kundenummer: ' . $kunde->kd_kundennummer !!}"/>
                        </div>
                        @if($kunde->kd_zusatz)
                            <div>
                                <x-ag.badge color="blue" text="{!! $kunde->kd_zusatz !!}"/>
                            </div>
                        @endif
                    </div>

                    <ul>
                        @if($kunde->kd_strasse and $kunde->kd_plz and $kunde->kd_ort)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Adresse</li>
                            <li class="mb-4 font-light">
                                {{ $kunde->kd_strasse }}<br>
                                @if($kunde->kd_land)
                                    {{ $kunde->kd_land . ' ' }}
                                @endif{{ $kunde->kd_plz . ' ' . $kunde->kd_ort }}
                            </li>
                        @endif
                        @if($kunde->kd_telefon or $kunde->kd_mobil)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Telefon</li>
                            <li class="mb-4 font-light">@if($kunde->kd_telefon and $kunde->kd_mobil)
                                    {{ $kunde->kd_telefon . ' / ' . $kunde->kd_mobil }}
                                @elseif($kunde->kd_telefon)
                                    {{ $kunde->kd_telefon }}
                                @else
                                    {{ $kunde->kd_mobile }}
                                @endif</li>
                        @endif
                        @if($kunde->kd_email)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">E-Mail Adresse
                            </li>
                            <li class="mb-4 font-light">{{ $kunde->kd_email }}</li>
                        @endif
                        @if($kunde->getBirthdayAttribute())
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Geburtsdatum</li>
                            <li class="mb-4 font-light inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z"/>
                                </svg>
                                {{ $kunde->getBirthdayAttribute() }}
                            </li>
                        @endif
                        @if($kunde->kd_anmerkungen)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Anmerkungen</li>
                            <li class="mb-4 font-light inline-flex items-center">{!! nl2br($kunde->kd_anmerkungen) !!}</li>
                        @endif

                        <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Fahrzeuge</li>
                        <li class="mb-4 font-light w-full">
                            <x-ag.table>
                                <x-slot:thead>
                                    <th scope="col" class="p-2">Kennzeichen</th>
                                    <th scope="col" class="p-2">HSN</th>
                                    <th scope="col" class="p-2">TSN</th>
                                    <th scope="col" class="p-2">Marke</th>
                                    <th scope="col" class="p-2">Modell</th>
                                    <th scope="col" class="p-2">KM</th>
                                    <th scope="col" class="p-2">HU</th>
                                    <th scope="col" class="p-2">Fz.-Ident-Nr.</th>
                                </x-slot:thead>
                                <x-slot:tbody>
                                    @forelse($fahrzeuges as $fahrzeug)
                                        <x-ag.tr>
                                            <td class="p-2 cursor-pointer" wire:click="showFahrzeug({{ $fahrzeug->id }})">{{ $fahrzeug->fz_kennzeichen }}</td>
                                            <td class="p-2 cursor-pointer" wire:click="showFahrzeug({{ $fahrzeug->id }})">{{ $fahrzeug->fz_hsn }}</td>
                                            <td class="p-2 cursor-pointer" wire:click="showFahrzeug({{ $fahrzeug->id }})">{{ $fahrzeug->fz_tsn }}</td>
                                            <td class="p-2 cursor-pointer" wire:click="showFahrzeug({{ $fahrzeug->id }})">{{ $fahrzeug->fz_hersteller }}</td>
                                            <td class="p-2 cursor-pointer" wire:click="showFahrzeug({{ $fahrzeug->id }})">{{ $fahrzeug->fz_model }}</td>
                                            <td class="p-2 cursor-pointer" wire:click="showFahrzeug({{ $fahrzeug->id }})">{{ $fahrzeug->fz_kilometerstand }}</td>
                                            <td class="p-2 cursor-pointer" wire:click="showFahrzeug({{ $fahrzeug->id }})">
                                                @if($fahrzeug->fz_hu <= date(now()))
                                                    {{ Carbon::parse($fahrzeug->fz_hu)->fromNow() . ' abgelaufen' }}
                                                @else
                                                    {{ Carbon::parse($fahrzeug->fz_hu)->toNow() }}
                                                @endif
                                            </td>
                                            <td class="p-2 cursor-pointer" wire:click="showFahrzeug({{ $fahrzeug->id }})">{{ $fahrzeug->fz_fz_id_nr }}</td>
                                        </x-ag.tr>
                                    @empty
                                        <x-ag.tr>
                                            <td class="px-4 py-2" colspan="8">Noch keine Fahrzeuge vorhanden.</td>
                                        </x-ag.tr>
                                    @endforelse
                                </x-slot:tbody>
                            </x-ag.table>
                        </li>
                        <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">Reifeneinlagerung</li>
                        <li class="mb-4 font-light w-full">
                            <x-ag.table>
                                <x-slot:thead>
                                    <th scope="col" class="p-2">Einlagerung-Nr.</th>
                                    <th scope="col" class="p-2">Einlagerung</th>
                                    <th scope="col" class="p-2">Auslagerung</th>
                                    <th scope="col" class="p-2">Lagerort</th>
                                    <th scope="col" class="p-2">Anzahl</th>
                                    <th scope="col" class="p-2">Reifentyp</th>
                                </x-slot:thead>
                                <x-slot:tbody>
                                    @forelse($reifens as $reifen)
                                        <x-ag.tr>
                                            <td class="p-2 cursor-pointer" wire:click="showReifeneinlagerung()">123</td>
                                            <td class="p-2 cursor-pointer" wire:click="showReifeneinlagerung()">456</td>
                                            <td class="p-2 cursor-pointer" wire:click="showReifeneinlagerung()">789</td>
                                            <td class="p-2 cursor-pointer" wire:click="showReifeneinlagerung()">123</td>
                                            <td class="p-2 cursor-pointer" wire:click="showReifeneinlagerung()">456</td>
                                            <td class="p-2 cursor-pointer" wire:click="showReifeneinlagerung()">789</td>
                                        </x-ag.tr>
                                    @empty
                                        <x-ag.tr>
                                            <td class="px-4 py-2 text-center font-bold" colspan="8">Noch keine Reifen
                                                Eingelagert von dem Kunden.
                                            </td>
                                        </x-ag.tr>
                                    @endforelse
                                </x-slot:tbody>
                            </x-ag.table>
                        </li>
                        <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">Dokumente</li>
                        <li class="mb-4 font-light w-full">
                            <x-ag.table>
                                <x-slot:tbody>
                                    @forelse($reifens as $reifen)
                                        <x-ag.tr>
                                            <td class="p-2 cursor-pointer" wire:click="showDokument()">123</td>
                                        </x-ag.tr>
                                    @empty
                                        <x-ag.tr>
                                            <td class="px-4 py-2 text-center font-bold" colspan="8">Es liegen noch keine
                                                Dokumente von dem Kunden vor.
                                            </td>
                                        </x-ag.tr>
                                    @endforelse
                                </x-slot:tbody>
                            </x-ag.table>
                        </li>
                    </ul>
                </div>
                <!-- Left col end -->
                <!-- Right col -->
                <div>
                    <ul>
                        @if($kunde->kd_telefon_gesch)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Telefon
                                Geschäftlich
                            </li>
                            <li class="mb-4 font-light">{{ $kunde->kd_telefon_gesch }}</li>
                        @endif
                        @if($kunde->kd_fax)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Telefon Fax</li>
                            <li class="mb-4 font-light">{{ $kunde->kd_fax }}</li>
                        @endif
                        @if($kunde->kd_webseite)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2">Webseite</li>
                            <li class="mb-4 font-light">
                                <a href="{{ $kunde->kd_webseite }}" target="_blank" class="inline-flex items-center p-2 rounded hover:bg-gray-100 text-gray-500 dark:text-white dark:hover:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                    </svg>
                                    {{ $kunde->kd_webseite }}
                                </a>
                            </li>
                        @endif
                        @if($kunde->kd_ust_id_nr)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2">USt-Identifikationsnummer</li>
                            <li class="mb-4 font-light">{{ $kunde->kd_ust_id_nr }}</li>
                        @endif
                        @if($kunde->kd_anmerkungen_anzeigen)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2">Anmerkungen bei neuen Vorgängen
                                anzeigen
                            </li>
                            <li class="mb-4 font-light">
                                @if($kunde->kd_anmerkungen_anzeigen)
                                    <x-ag.badge color="green-border" class="text-sm font-semibold inline-flex items-center !p-1.5 rounded-full">
                                        <x-slot:text>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                            </svg>
                                        </x-slot:text>
                                    </x-ag.badge>
                                @else
                                    <x-ag.badge color="red-border" class="text-sm font-semibold inline-flex items-center !p-1.5 rounded-full">
                                        <x-slot:text>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </x-slot:text>
                                    </x-ag.badge>
                                @endif
                            </li>
                        @endif
                        @if($kunde->kd_ausl_kunde)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2">Dieser Kunde bekommt eine
                                Netto-Rechnung
                            </li>
                            <li class="mb-4 font-light">
                                @if($kunde->kd_ausl_kunde)
                                    <x-ag.badge color="green-border" class="text-sm font-semibold inline-flex items-center !p-1.5 rounded-full">
                                        <x-slot:text>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                            </svg>
                                        </x-slot:text>
                                    </x-ag.badge>
                                @else
                                    <x-ag.badge color="red-border" class="text-sm font-semibold inline-flex items-center !p-1.5 rounded-full">
                                        <x-slot:text>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </x-slot:text>
                                    </x-ag.badge>
                                @endif
                            </li>
                        @endif
                        @hasanyrole('admin|superadmin')
                        @if($kunde->kd_rabatt_artikel > 0 or $kunde->kd_rabatt_arbeit > 0)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2">Rabatt</li>
                            <li class="mb-4 font-light">
                                @if($kunde->kd_rabatt_artikel > 0)
                                    <x-ag.badge color="green-border" class="mr-2.5" :text="$kunde->kd_rabatt_artikel . ' %'"/>
                                @endif
                                @if($kunde->kd_rabatt_arbeit > 0)
                                    <x-ag.badge color="red-border" :text="$kunde->kd_rabatt_arbeit . ' %'"/>
                                @endif
                            </li>
                        @endif
                        @if($kunde->kd_zahlung)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">
                                Zahlungsbedingungen
                            </li>
                            <li class="mb-4 font-light inline-flex items-center">
                                <x-ag.badge color="gray-border" :text="$kunde->kd_zahlung"/>
                            </li>
                        @endif
                        @if($kunde->kd_preisgruppe)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Preisgruppe</li>
                            <li class="mb-4 font-light inline-flex items-center">
                                <x-ag.badge color="yellow-border" :text="$kunde->kd_preisgruppe"/>
                            </li>
                        @endif
                        @if($kunde->kd_debitor_nr)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Debitorennummer
                            </li>
                            <li class="mb-4 font-light inline-flex items-center">{!! $kunde->kd_debitor_nr !!}</li>
                        @endif
                        @endhasanyrole
                        <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Datenschutzrechtliche
                            Einwilligungserklärung
                        </li>
                        <li class="mb-4 font-light inline-flex items-center">
                            <span class="font-bold pr-2">{{ $kunde->datenschutzerklaerungs->erteiltAm() ? $kunde->datenschutzerklaerungs->erteiltAm() : 'noch nicht erteilt ' }}</span>
                            <span class="font-bold pr-2 {{ ($kunde->datenschutzerklaerungs->da_briefe) ? 'text-green-500' : 'text-red-500' }}" title="Briefe"><em class="fa-solid fa-envelopes-bulk"></em></span>
                            <span class="font-bold pr-2 {{ ($kunde->datenschutzerklaerungs->da_telefon) ? 'text-green-500' : 'text-red-500' }}" title="Telefon"><em class="fa-solid fa-phone"></em></span>
                            <span class="font-bold pr-2 {{ ($kunde->datenschutzerklaerungs->da_fax) ? 'text-green-500' : 'text-red-500' }}" title="Fax"><em class="fa-solid fa-fax"></em></span>
                            <span class="font-bold pr-2 {{ ($kunde->datenschutzerklaerungs->da_mobile) ? 'text-green-500' : 'text-red-500' }}" title="Mobil"><em class="fa-solid fa-mobile-screen-button"></em></span>
                            <span class="font-bold pr-2 {{ ($kunde->datenschutzerklaerungs->da_sms) ? 'text-green-500' : 'text-red-500' }}" title="SMS"><em class="fa-solid fa-comment-sms"></em></span>
                            <span class="font-bold pr-2 {{ ($kunde->datenschutzerklaerungs->da_whatsapp) ? 'text-green-500' : 'text-red-500' }}" title="WhatsApp"><em class="fa-brands fa-whatsapp"></em></span>
                            <span class="font-bold pr-2 {{ ($kunde->datenschutzerklaerungs->da_email) ? 'text-green-500' : 'text-red-500' }}" title="E-Mail"><em class="fa-solid fa-envelope"></em></span>
                        </li>
                    </ul>
                </div>
                <!-- Right col end -->
                <!-- Full col -->
                <div class="xl:col-span-3">

                    <div class="flex flex-col mb-4">
                        <div class="flex xl:items-center items-start flex-col xl:flex-row xl:justify-between mb-2">
                            <div class="inline-flex items-center mb-2">
                                <x-ag.heading heading="h2" class="leading-none" text="Historie"/>
                                <x-ag.badge color="gray-sm" class="mx-2.5" text="{!! '0' !!}"/>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Full col end -->
            </div>
        </div>

    </div>
</x-ag.header-admin>
