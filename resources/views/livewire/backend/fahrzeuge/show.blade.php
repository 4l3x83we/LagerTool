@php use App\Models\Admin\Emissionsklasse;use App\Models\Backend\Fahrzeuge\Fahrzeuges;use Carbon\Carbon; @endphp
<x-ag.header-admin current-text="Vehicles">
    <x-slot:var>
        {!! Breadcrumbs::render("fahrzeugeShow", $fahrzeug) !!}
    </x-slot:var>

    <div class="flex items-center justify-between pb-4">
        <span class="text-lg text-gray-500 md:text-xl dark:text-gray-400">{{ $fahrzeug->fullname() . ' von: ' . $kunde->fullname() }}</span>
        <div>
            <x-ag.link link="{{ route('backend.fahrzeuge') }}" class="px-3 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-600 text-xs" icon-left="fa-rotate-left" text="{{ __('Back') }}"/>
        </div>
    </div>

    <div class="px-4 py-3 bg-gray-50 rounded shadow-md dark:bg-gray-800 text-gray-500 dark:text-gray-400 mb-4">

        <div class="py-5 mx-auto">
            <div class="grid xl:grid-cols-3 grid-cols-1 gap-4 px-4">
                <!-- Left col -->
                <div class="xl:col-span-2">
                    <div class="flex flex-col mb-4">
                        <div class="flex xl:items-center items-start flex-col xl:flex-row xl:justify-between mb-2">
                            <div class="inline-flex items-center mb-2">
                                <x-ag.heading heading="h2" class="leading-none" :text="$fahrzeug->fullname()"/>
                                <x-ag.badge color="gray-sm" class="mx-2.5" text="{!! 'Kilometerstand: ' . $fahrzeug->fz_kilometerstand !!}"/>
                            </div>
                            <x-ag.badge color="purple-border" class="xl:mx-2.5" text="{!! 'Baujahr: ' . $fahrzeug->ez() . ' / ' . Carbon::parse($fahrzeug->fz_baujahr)->age .' Jahre' !!}"/>
                        </div>
                        <div class="mb-2">
                            <x-ag.badge color="gray-border" text="{!! 'Fahrzeugnummer Intern: ' . $fahrzeug->id !!}"/>
                        </div>
                        <div class="mb-2">
                            <x-ag.badge color="blue-border" text="{!! 'Fahrzeugidentifikationsnummer: ' . $fahrzeug->fz_fz_id_nr !!}"/>
                        </div>
                    </div>

                    <ul>
                        <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Fahrzeugdaten</li>
                        @if($fahrzeug->fz_kennzeichen)
                            <li class="mb-2 font-light">
                                <span class="mr-2">Kennzeichen:</span>
                                <x-ag.badge color="white-border" text="{!! $fahrzeug->fz_kennzeichen !!}"/>
                            </li>
                        @endif
                        @if($fahrzeug->fz_hubraum and $fahrzeug->fz_kw and $fahrzeug->fz_ps)
                            <li class="mb-4 font-light">
                                <span class="mr-2">Hubraum:</span> {{ $fahrzeug->fz_hubraum. ' ccm³' }}
                                <span class="mx-2">PS:</span> {{ $fahrzeug->fz_ps }}
                                <span class="mx-2">kW:</span> {{ $fahrzeug->fz_kw }}
                            </li>
                        @endif
                        <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">weitere Daten</li>
                        @if($fahrzeug->fz_hu)
                            <li class="mb-2 font-light inline-flex items-center">
                                <span class="mr-2">HU:</span>
                                @if(Carbon::parse(now())->addYears($hu->diffInYears(now()))->format('y') == now()->format('y') - 3)
                                    <div class="bg-[#0075af] rounded p-1 px-2 leading-none text-white">{{ $fahrzeug->hu() }}</div>
                                @elseif(Carbon::parse(now())->addYears($hu->diffInYears(now()))->format('y') == now()->format('y') - 2)
                                    <div class="bg-[#D9C022] rounded p-1 px-2 leading-none text-black">{{ $fahrzeug->hu() }}</div>
                                @elseif(Carbon::parse(now())->addYears($hu->diffInYears(now()))->format('y') == now()->format('y') - 1)
                                    <div class="bg-[#8F4E35] rounded p-1 px-2 leading-none text-white">{{ $fahrzeug->hu() }}</div>
                                @elseif(Carbon::parse($hu)->format('y') == now()->format('y'))
                                    <div class="bg-[#E1A6AD] rounded p-1 px-2 leading-none text-black">{{ $fahrzeug->hu() }}</div>
                                @elseif(Carbon::parse(now())->addYears($hu->diffInYears(now()))->format('y') == now()->format('y') + 1)
                                    <div class="bg-[#48A43F] rounded p-1 px-2 leading-none text-white">{{ $fahrzeug->hu() }}</div>
                                @elseif(Carbon::parse(now())->addYears($hu->diffInYears(now()))->format('y') == now()->format('y') + 2)
                                    <div class="bg-[#DD7907] rounded p-1 px-2 leading-none text-black">{{ $fahrzeug->hu() }}</div>
                                @else
                                    {{ $fahrzeug->hu() . ' abgelaufen' }}
                                @endif
                            </li>
                        @endif
                        @if($fahrzeug->fz_reifen_1)
                            <li class="mb-2 font-light"><span class="mr-2">Reifen 1:</span> {{ $fahrzeug->fz_reifen_1 }}
                            </li>
                        @endif
                        @if($fahrzeug->fz_reifen_2)
                            <li class="mb-2 font-light"><span class="mr-2">Reifen 2:</span> {{ $fahrzeug->fz_reifen_2 }}
                            </li>
                        @endif
                        @if($fahrzeug->fz_rdks)
                            <li class="mb-2 font-light">
                                <span class="mr-2">RDKS:</span> {{ $fahrzeug->fz_rdks }}
                            </li>
                        @endif
                        @if($fahrzeug->fz_motorcode)
                            <li class="mb-2 font-light">
                                <span class="mr-2">Motorcode:</span> {{ $fahrzeug->fz_motorcode }}
                            </li>
                        @endif
                        @if($fahrzeug->fz_treibstoff)
                            <li class="mb-2 font-light">
                                <span class="mr-2">Kraftstoff:</span> {{ $fahrzeug->fz_treibstoff }}
                            </li>
                        @endif
                        @if($fahrzeug->fz_kat or $fahrzeug->fz_plakette or $fahrzeug->fz_emissionsklasse)
                            <li class="mb-2 font-light">
                                @if($fahrzeug->fz_kat)
                                    <span class="mr-2">Kat:</span> {!! fahrzeugSpecs()['kat'][$fahrzeug->fz_kat] !!}
                                @endif
                                @if($fahrzeug->fz_plakette)
                                    <span class="mx-2">Plakette:</span> {!! $fahrzeug->fz_plakette !!}
                                @endif
                                @if($fahrzeug->fz_emissionsklasse)
                                    <span class="mx-2">Emissionsklasse:</span> {!! Emissionsklasse::find($fahrzeug->fz_emissionsklasse)->emissionsklasse !!}
                                @endif
                            </li>
                        @endif
                        @if($fahrzeug->fz_getriebeart)
                            <li class="mb-2 font-light">
                                <span class="mr-2">Getriebe:</span> {{ $fahrzeug->fz_getriebeart }}
                            </li>
                        @endif
                    </ul>
                    <div class="grid xl:grid-cols-2 grid-cols-1 gap-x-4 gap-y-1">
                        <ul>
                            <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">weiters Fahrzeugdaten</li>
                            @if($fahrzeug->fz_farbe)
                                <li class="mb-2 font-light">
                                    <span class="mr-2">Farbe:</span> {!! $fahrzeug->fz_farbe !!} @if($fahrzeug->fz_farbe_hersteller) Metallic @endif
                                </li>
                            @endif
                            @if($fahrzeug->fz_hersteller_farbe or $fahrzeug->fz_farbcode)
                                <li class="mb-2 font-light">
                                    <span class="mr-2">Herstellerfarbe:</span> {!! $fahrzeug->fz_hersteller_farbe !!}
                                    @if($fahrzeug->fz_farbcode)<span class="mx-2">Farbcode:</span> {!! $fahrzeug->farbcode !!}@endif
                                </li>
                            @endif
                            @if($fahrzeug->fz_polsterart or $fahrzeug->fz_polsterfarbe)
                                <li class="mb-2 font-light">
                                    @if($fahrzeug->fz_polsterart)<span class="mr-2">Polsterart:</span> {!! $fahrzeug->fz_polsterart !!}@endif
                                    @if($fahrzeug->fz_polsterfarbe)<span class="mx-2">Polsterfarbe:</span> {!! $fahrzeug->polsterfarbe !!}@endif
                                </li>
                            @endif
                            @if($fahrzeug->fz_radiocode)
                                <li class="mb-2 font-light">
                                    <span class="mr-2">Radiocode:</span> {!! $fahrzeug->fz_radiocode !!}
                                </li>
                            @endif
                            @if($fahrzeug->fz_schluesselnummer)
                                <li class="mb-2 font-light">
                                    <span class="mr-2">Schlüsselnummer:</span> {!! $fahrzeug->fz_schluesselnummer !!}
                                </li>
                            @endif
                        </ul>
                        <ul>
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none hidden xl:block">&nbsp;</li>
                            @if($fahrzeug->fz_sitzplaetze or $fahrzeug->fz_tueren)
                                <li class="mb-2 font-light">
                                    <span class="mr-2">Sitzplätze:</span> @if($fahrzeug->fz_sitzplaetze){!! $fahrzeug->fz_sitzplaetze !!}@else - @endif
                                    <span class="mx-2">Türen:</span> @if($fahrzeug->fz_tueren){!! $fahrzeug->fz_tueren !!}@else - @endif
                                </li>
                            @endif
                            @if($fahrzeug->fz_schlafplaetze or $fahrzeug->fz_achsen)
                                <li class="mb-2 font-light">
                                    <span class="mr-2">Schlafplätze:</span> @if($fahrzeug->fz_schlafplaetze){!! $fahrzeug->fz_schlafplaetze !!}@else - @endif
                                    <span class="mx-2">Achsen:</span> @if($fahrzeug->fz_achsen){!! $fahrzeug->fz_achsen !!}@else - @endif
                                </li>
                            @endif
                            @if($fahrzeug->fz_gaenge or $fahrzeug->fz_zylinder)
                                <li class="mb-2 font-light">
                                    <span class="mr-2">Anzahl der Gänge:</span> @if($fahrzeug->fz_gaenge){!! $fahrzeug->fz_gaenge !!}@else - @endif
                                    <span class="mx-2">Zylinder:</span> @if($fahrzeug->fz_zylinder){!! $fahrzeug->fz_zylinder !!}@else - @endif
                                </li>
                            @endif
                            @if($fahrzeug->fz_leergewicht or $fahrzeug->fz_nutzgewicht or $fahrzeug->fz_gesamtgewicht)
                                <li class="mb-2 font-light">
                                    <span class="mr-2">Leer/Nutz/Ges.-gewicht:</span> {!! $fahrzeug->fz_leergewicht .' / ' . $fahrzeug->fz_nutzgewicht .' / ' . $fahrzeug->fz_gesamtgewicht !!}
                                </li>
                            @endif
                            @if($fahrzeug->fz_laenge or $fahrzeug->fz_breite or $fahrzeug->fz_hoehe)
                                <li class="mb-2 font-light">
                                    <span class="mr-2">Länge/Breite/Höhe:</span> {!! $fahrzeug->fz_laenge .' / ' . $fahrzeug->fz_breite .' / ' . $fahrzeug->fz_hoehe !!}
                                </li>
                            @endif
                        </ul>
                    </div>

                    @if($fahrzeug->fz_infos)
                        <ul>
                            <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">Notiz</li>
                            <li class="mb-4 font-light inline-flex items-center">{!! nl2br($fahrzeug->fz_infos) !!}</li>
                        </ul>
                    @endif

                    <ul>
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
                                            <td class="px-4 py-2 text-center font-bold" colspan="8">Noch keine Reifen Eingelagert von dem Kunden.</td>
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
                                            <td class="px-4 py-2 text-center font-bold" colspan="8">Noch keine Reifen Eingelagert von dem Kunden.</td>
                                        </x-ag.tr>
                                    @endforelse
                                </x-slot:tbody>
                            </x-ag.table>
                        </li>
                        <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">Fotos</li>
                        <li class="mb-4 font-light w-full">
                            <div class="grid grid-cols-2 xl:grid-cols-3 gap-4">
                                <div>
                                    <img class="h-auto max-w-full rounded" src="https://via.placeholder.com/1024" alt="">
                                </div>
                                <div>
                                    <img class="h-auto max-w-full rounded" src="https://via.placeholder.com/1024" alt="">
                                </div>
                                <div>
                                    <img class="h-auto max-w-full rounded" src="https://via.placeholder.com/1024" alt="">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Left col end -->
                <!-- Right col -->
                <div>
                    <ul>
                        <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">
                            <span>Halter</span>
                            <div class="flex justify-start flex-col xl:flex-row xl:justify-between xl:items-center items-start">
                                <x-ag.badge color="gray-sm" class="mt-2.5" text="{!! $kunde->kundentype() !!}"/>
                                <x-ag.badge color="gray-border" class="mt-2.5 xl:mt-0" text="{!! 'Kundenummer: ' . $kunde->kd_kundennummer !!}"/>
                            </div>
                        </li>
                        <li class="font-light">@if($kunde->anrede)
                                {{ $kunde->kd_anrede .' ' }}
                            @endif{{ $kunde->fullname() }}</li>
                        <li class="font-light">{{ $kunde->kd_strasse }}</li>
                        <li class="mb-4 font-light">{{ $kunde->kd_plz .' '. $kunde->kd_ort }}</li>
                        @if($kunde->kd_telefon or $kunde->kd_mobil)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Telefon</li>
                            <li class="mb-4 font-light">
                                @if($kunde->kd_telefon and $kunde->kd_mobil)
                                    {{ $kunde->kd_telefon . ' / ' . $kunde->kd_mobil }}
                                @elseif($kunde->kd_telefon)
                                    {{ $kunde->kd_telefon }}
                                @else
                                    {{ $kunde->kd_mobile }}
                                @endif
                            </li>
                        @endif
                        @if($kunde->kd_email)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">E-Mail Adresse
                            </li>
                            <li class="mb-4 font-light">{{ $kunde->kd_email }}</li>
                        @endif
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
