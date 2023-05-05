@php use Picqer\Barcode\BarcodeGeneratorHTML; @endphp
<x-ag.header-admin current-text="Artikel">
    <x-slot:var>
        {!! Breadcrumbs::render("artikelShow", $artikel) !!}
    </x-slot:var>

    <div class="flex items-center justify-between pb-4">
        <span class="text-lg text-gray-500 md:text-xl dark:text-gray-400"></span>
        <div>
            <x-ag.link link="{{ route('backend.artikel') }}" class="px-3 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-600 text-xs" icon-left="fa-rotate-left" text="{{ __('Back') }}"/>
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
                                <x-ag.heading heading="h2" class="leading-none" :text="$artikel->art_name"/>
                                <x-ag.badge color="gray-sm" class="mx-2.5" text="{!! 'Bestand: ' . $artikel->lagers->la_bestand !!}"/>
                            </div>
                        </div>
                        <div class="mb-2">
                            <x-ag.badge color="gray-border" text="{!! 'Artikelnummer: ' . $artikel->art_nr !!}"/>
                        </div>
                        @if($artikel->art_ean)
                            <div class="mb-2">
                                @php
                                    $generateBarcode = new BarcodeGeneratorHTML();
                                @endphp
                                {!! $generateBarcode->getBarcode($artikel->art_ean, $generateBarcode::TYPE_EAN_13) !!}
                                <span>{!! $artikel->art_ean !!}</span>
                            </div>
                        @endif
                    </div>

                    <ul>
                        <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Artikeldaten</li>
                        @if($artikel->art_hersteller)
                            <li class="mb-1 font-light">
                                <span class="mr-2">Hersteller:</span> {{ $artikel->art_hersteller }}
                            </li>
                        @endif
                        @if($artikel->art_nr)
                            <li class="mb-1 font-light">
                                <span class="mr-2">Artikelnummer:</span> {{ $artikel->art_nr }}
                            </li>
                        @endif
                        @if($artikel->art_name)
                            <li class="mb-1 font-light">
                                <span class="mr-2">Bezeichnung:</span> {{ $artikel->art_name }}
                            </li>
                        @endif
                        @if($artikel->art_ean)
                            <li class="mb-1 font-light">
                                <span class="mr-2">EAN:</span> {{ $artikel->art_ean }}
                            </li>
                        @endif
                        @if($artikel->art_einheit)
                            <li class="mb-1 font-light">
                                <span class="mr-2">Einheit:</span> {{ $artikel->art_einheit }}
                            </li>
                        @endif
                        @if($artikel->warengruppes)
                            <li class="mb-4 font-light">
                                <span class="mr-2">Warengruppe:</span>
                                @foreach($artikel->warengruppes as $warengruppe)
                                    @if($warengruppe->wg_parent_id)
                                        {{ '-- '. $warengruppe->wg_name }}
                                    @else
                                        {{ $warengruppe->wg_name }}
                                    @endif
                                @endforeach
                            </li>
                        @endif

                        <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">Preise</li>
                        @if($artikel->preises->pr_netto_ek)
                            <li class="mb-1 font-light">
                                <span class="mr-2">Netto EKP:</span> {{ $artikel->preises->nettoEk() }}
                            </li>
                        @endif
                        @if($artikel->preises->pr_netto_vk)
                            <li class="mb-1 font-light">
                                <span class="mr-2">Netto VKP:</span> {{ $artikel->preises->nettoVk() }}
                            </li>
                        @endif
                        @if($artikel->preises->pr_mwst)
                            <li class="mb-1 font-light">
                                <span class="mr-2">MwSt:</span> {{ mwst($artikel->preises->pr_brutto_vk, $artikel->art_mwst)['mwstB'] }}
                            </li>
                        @endif
                        @if($artikel->preises->pr_brutto_vk)
                            <li class="mb-4 font-light">
                                <span class="mr-2">Brutto VKP:</span> {{ $artikel->preises->bruttoVk() }}
                            </li>
                        @endif

                        @if($artikel->preises->pr_prg_1_brutto_vk or $artikel->preises->pr_prg_2_brutto_vk or $artikel->preises->pr_prg_3_brutto_vk or $artikel->preises->pr_prg_4_brutto_vk or $artikel->preises->pr_prg_5_brutto_vk and $artikel->preises->pr_netto_ek)
                        <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">Preisgruppen</li>
                        <div class="flex flex-row gap-4">
                            <li class="mb-1 font-light text-center w-[110px]"></li>
                            <li class="mb-1 font-light text-center w-[110px]">Verkaufspreis</li>
                            <li class="mb-1 font-light text-center w-[110px]">Brutto VKP</li>
                            <li class="mb-1 font-light text-center w-[110px]">Marge in %</li>
                        </div>
                            @if($artikel->preises->pr_prg_1_netto_vk)
                                <div class="flex flex-row gap-4">
                                    <li class="mb-1 font-light w-[110px]">Preisgruppe 1</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ numberFormat($artikel->preises->pr_prg_1_netto_vk) }}</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ numberFormat($artikel->preises->pr_prg_1_brutto_vk) }}</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ marge($artikel->preises->pr_prg_1_brutto_vk, $artikel->preises->pr_netto_ek) }}</li>
                                </div>
                            @endif
                            @if($artikel->preises->pr_prg_2_netto_vk)
                                <div class="flex flex-row gap-4">
                                    <li class="mb-1 font-light w-[110px]">Preisgruppe 2</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ numberFormat($artikel->preises->pr_prg_2_netto_vk) }}</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ numberFormat($artikel->preises->pr_prg_2_brutto_vk) }}</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ marge($artikel->preises->pr_prg_2_brutto_vk, $artikel->preises->pr_netto_ek) }}</li>
                                </div>
                            @endif
                            @if($artikel->preises->pr_prg_3_netto_vk)
                                <div class="flex flex-row gap-4">
                                    <li class="mb-1 font-light w-[110px]">Preisgruppe 3</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ numberFormat($artikel->preises->pr_prg_3_netto_vk) }}</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ numberFormat($artikel->preises->pr_prg_3_brutto_vk) }}</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ marge($artikel->preises->pr_prg_3_brutto_vk, $artikel->preises->pr_netto_ek) }}</li>
                                </div>
                            @endif
                            @if($artikel->preises->pr_prg_4_netto_vk)
                                <div class="flex flex-row gap-4">
                                    <li class="mb-1 font-light w-[110px]">Preisgruppe 4</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ numberFormat($artikel->preises->pr_prg_4_netto_vk) }}</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ numberFormat($artikel->preises->pr_prg_4_brutto_vk) }}</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ marge($artikel->preises->pr_prg_4_brutto_vk, $artikel->preises->pr_netto_ek) }}</li>
                                </div>
                            @endif
                            @if($artikel->preises->pr_prg_5_netto_vk)
                                <div class="flex flex-row gap-4">
                                    <li class="mb-1 font-light w-[110px]">Preisgruppe 5</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ numberFormat($artikel->preises->pr_prg_5_netto_vk) }}</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ numberFormat($artikel->preises->pr_prg_5_brutto_vk) }}</li>
                                    <li class="mb-1 font-light text-right w-[110px]">{{ marge($artikel->preises->pr_prg_5_brutto_vk, $artikel->preises->pr_netto_ek) }}</li>
                                </div>
                            @endif
                        @endif
                    </ul>
                </div>
                <!-- Left col end -->
                <!-- Right col -->
                <div>

                    <ul>
                        <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Bild des Artikels</li>
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
                        @if($artikel->lagers)
                            @if($artikel->lagers->la_bestand)
                                <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Lagerbestand</li>
                                <li class="mb-4 font-light">
                                    <span class="mr-2">akt. Bestand:</span> {{ $artikel->lagers->la_bestand }}
                                </li>
                            @endif
                            <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">Lager</li>
                            @if($artikel->lagers->la_lagerfuehrung)
                                <li class="mb-4 font-light">
                                    <span class="mr-2">Lagerführung:</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-flex text-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </li>
                            @endif
                            @if($artikel->lagers->la_lagerort)
                                <li class="mb-4 font-light">
                                    <span class="mr-2">Lagerort:</span> {{ $artikel->lagers->la_lagerort }}
                                </li>
                            @endif
                            @if($artikel->lagers->la_min)
                                <li class="mb-4 font-light">
                                    <span class="mr-2">Min. Menge:</span> {{ $artikel->lagers->la_min }}
                                </li>
                            @endif
                            @if($artikel->lagers->la_max)
                                <li class="mb-4 font-light">
                                    <span class="mr-2">Max. Menge:</span> {{ $artikel->lagers->la_max }}
                                </li>
                            @endif
                        @endif
                        @if($artikel->fahrzeugDatenHerstellers)
                            <li class="font-semibold text-gray-900 dark:text-white mb-2 leading-none">Passende Fahrzeuge</li>
                            @forelse($artikel->fahrzeugDatenHerstellers as $fdh)
                            <li class="mb-4 font-light text-xs">{{ $fdh->pf() }}</li>
                            @empty
                                <li class="mb-4 font-light">Keine Fahrzeuge zugeordnet</li>
                            @endforelse
                        @endif
                    </ul>

                </div>
                <!-- Right col end -->
                <!-- Full col -->
                <div class="xl:col-span-3">

                    @if($artikel->art_beschreibung or $artikel->art_notiz)
                        <ul>
                            @if($artikel->art_beschreibung)
                                <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">Beschreibung</li>
                                <li class="mb-1 font-light inline-flex items-center">{!! nl2br($artikel->art_beschreibung) !!}</li>
                            @endif

                            @if($artikel->art_notiz)
                                <li class="font-semibold text-gray-900 dark:text-white my-2 leading-none">Notiz</li>
                                <li class="mb-1 font-light inline-flex items-center">{!! nl2br($artikel->art_notiz) !!}</li>
                            @endif
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-ag.header-admin>
