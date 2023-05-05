<x-ag.header-admin current-text="Kunden">
    <x-slot:var>
        {!! Breadcrumbs::render("kundenEdit", $kunden) !!}
    </x-slot:var>

    <div class="flex items-center justify-between pb-4">
        <span class="text-lg text-gray-500 md:text-xl dark:text-gray-400">{{ $kunden->fullname() }}</span>
        <div>
            <x-ag.link link="{{ route('backend.kunden') }}" class="px-3 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-600 text-xs" icon-left="fa-rotate-left" text="{{ __('Back') }}"/>
        </div>
    </div>

    <div class="px-4 py-3 bg-gray-50 rounded shadow-md dark:bg-gray-800 mb-4">
        <form wire:submit.prevent="update">
            <input type="hidden" wire:model="selected_id">
            <div class="grid grid-cols-1 gap-4 mb-4 xl:grid-cols-2">
                <div id="AnschriftForm">
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2 place-content-start">
                        <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                            <x-ag.label for="kunden.kd_kundennummer" text="Kundennummer" stern="true" />
                            <x-ag.input type="text" id="kunden.kd_kundennummer" wire:model.lazy="kunden.kd_kundennummer" placeholder="Kundennummer wird automatisch generiert" value="{{ old('kunden.kd_kundennummer') }}" disabled/>
                        </div>
                        <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                            <x-ag.label class="hidden xl:block" text="&nbsp;" />
                            <div class="flex flex-row items-center justify-start">
                                <x-ag.radio type="radio" id="kunden.kd_kundentype_1" wire:model="kunden.kd_kundentype" text="Firma" value="0" />
                                <x-ag.radio type="radio" id="kunden.kd_kundentype_2" wire:model="kunden.kd_kundentype" text="Privatkunde" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-1 gap-4 xl:grid-cols-2 place-content-start">
                        <x-ag.heading heading="h5" textWidth="xl" text="Anschrift" class="col-span-2" />
                        <div class="col-span-2">
                            <x-ag.label for="kunden.kd_anrede" text="Anrede" stern="true" />
                            <x-ag.select id="kunden.kd_anrede" wire:model.lazy="kunden.kd_anrede">
                                @foreach(kundenSpecs()['anrede'] as $anrede)
                                    <option value="{{ old('kunden.kd_anrede', $anrede) }}">{{ $anrede }}</option>
                                @endforeach
                            </x-ag.select>
                        </div>
                        <div class="grid gap-4 col-span-2 grid-cols-2 place-content-start">
                            <div class="{{ ($kunden->kd_kundentype) ? '' : 'hidden' }}">
                                <x-ag.label for="kunden.kd_vorname" text="Vorname / Ansprechpartner" stern="true" />
                                <x-ag.input type="text" id="kunden.kd_vorname" wire:model.lazy="kunden.kd_vorname" placeholder="Vorname / Ansprechpartner" value="{{ old('kunden.kd_vorname') }}" />
                            </div>
                            <div class="{{ ($kunden->kd_kundentype) ? '' : 'col-span-2' }}">
                                <x-ag.label for="kunden.kd_name" text="Name / Firma" stern="true" />
                                <x-ag.input type="text" id="kunden.kd_name" wire:model.lazy="kunden.kd_name" placeholder="Name / Firma" value="{{ old('kunden.kd_name') }}" />
                            </div>
                        </div>
                        <div class="col-span-2">
                            <x-ag.label for="kunden.kd_zusatz" text="Zusatz" />
                            <x-ag.input type="text" id="kunden.kd_zusatz" wire:model.lazy="kunden.kd_zusatz" placeholder="Zusatz" value="{{ old('kunden.kd_zusatz') }}" />
                        </div>
                        <div class="col-span-2">
                            <x-ag.label for="kunden.kd_strasse" text="Straße" stern="true" />
                            <x-ag.input type="text" id="kunden.kd_strasse" wire:model.lazy="kunden.kd_strasse" placeholder="Straße" value="{{ old('kunden.kd_strasse') }}" />
                        </div>
                        <div class="grid grid-cols-2 gap-4 col-span-2">
                            <div>
                                <x-ag.label for="kunden.kd_plz" text="PLZ" stern="true" />
                                <x-ag.input type="number" id="kunden.kd_plz" wire:model.lazy="kunden.kd_plz" placeholder="PLZ" value="{{ old('kunden.kd_plz') }}" />
                            </div>
                            <div>
                                <x-ag.label for="kunden.kd_ort" text="Ort" stern="true" />
                                <x-ag.input type="text" id="kunden.kd_ort" wire:model.lazy="kunden.kd_ort" placeholder="Ort" value="{{ old('kunden.kd_ort') }}" />
                            </div>
                            <div class="col-span-2">
                                <x-ag.label for="kunden.kd_land" text="Land" stern="true" />
                                <x-ag.select id="kunden.kd_land" wire:model.lazy="kunden.kd_land">
                                    @foreach(countryCode() as $countryCode)
                                        <option value="{{ old('kunden.kd_land', $countryCode['code']) }}">{{ $countryCode['name'] }}</option>
                                    @endforeach
                                </x-ag.select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="KommunikationForm">
                    <x-ag.heading heading="h5" textWidth="xl" text="Kommunikation" class="col-span-2 whitespace-normal" />
                    <div class="grid gap-4 col-span-2 grid-cols-2 my-4 place-content-start">
                        <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                            <x-ag.label for="kunden.kd_telefon" text="Telefon" />
                            <x-ag.input type="tel" id="kunden.kd_telefon" wire:model.lazy.lazy="kunden.kd_telefon" placeholder="Telefon" value="{{ old('kunden.kd_telefon') }}" />
                        </div>
                        <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                            <x-ag.label for="kunden.kd_telefon_gesch" text="Telefon gesch." />
                            <x-ag.input type="tel" id="kunden.kd_telefon_gesch" wire:model.lazy.lazy="kunden.kd_telefon_gesch" placeholder="Telefon gesch." value="{{ old('kunden.kd_telefon_gesch') }}" />
                        </div>
                        <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                            <x-ag.label for="kunden.kd_fax" text="Fax" />
                            <x-ag.input type="tel" id="kunden.kd_fax" wire:model.lazy.lazy="kunden.kd_fax" placeholder="Fax" value="{{ old('kunden.kd_fax') }}" />
                        </div>
                        <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                            <x-ag.label for="kunden.kd_mobil" text="Mobil" />
                            <x-ag.input type="tel" id="kunden.kd_mobil" wire:model.lazy.lazy="kunden.kd_mobil" placeholder="Mobil" value="{{ old('kunden.kd_mobil') }}" />
                        </div>
                        <div class="col-span-2">
                            <x-ag.label for="kunden.kd_email" text="E-Mail" />
                            <x-ag.input type="email" id="kunden.kd_email" wire:model.lazy.lazy="kunden.kd_email" placeholder="E-Mail" value="{{ old('kunden.kd_email') }}" />
                        </div>
                        <div class="col-span-2">
                            <x-ag.label for="kunden.kd_webseite" text="Internetseite" />
                            <x-ag.input type="url" id="kunden.kd_webseite" wire:model.lazy.lazy="kunden.kd_webseite" placeholder="Internetseite" value="{{ old('kunden.kd_webseite') }}" />
                        </div>
                    </div>
                    <x-ag.heading heading="h5" textWidth="xl" text="Datenschutzrechtliche Einwilligungserklärung" class="col-span-2 whitespace-normal" />
                    <div class="grid gap-4 col-span-2 grid-cols-3 my-4 place-content-start">
                        <div>
                            <x-ag.label for="da_erteilt_am" text="Erteilt am"/>
                            <x-ag.input type="date" id="da_erteilt_am" wire:model.lazy="datenschutz.da_erteilt_am"/>
                        </div>
                        <div class="flex flex-row flex-wrap gap-4 col-span-2">
                            <x-ag.checkbox type="checkbox" id="datenschutz.da_briefe" text="Briefe" value="1"/>
                            <x-ag.checkbox type="checkbox" id="datenschutz.da_telefon" text="Telefon" value="1"/>
                            <x-ag.checkbox type="checkbox" id="datenschutz.da_fax" text="Fax" value="1"/>
                            <x-ag.checkbox type="checkbox" id="datenschutz.da_mobile" text="Mobil" value="1"/>
                            <x-ag.checkbox type="checkbox" id="datenschutz.da_sms" text="SMS" value="1"/>
                            <x-ag.checkbox type="checkbox" id="datenschutz.da_whatsapp" text="WhatsApp" value="1"/>
                            <x-ag.checkbox type="checkbox" id="datenschutz.da_email" text="E-Mail" value="1"/>
                            {{--                        <x-ag.checkbox type="checkbox" id="selectAll" text="Alle"/>--}}
                        </div>
                    </div>
                    <x-ag.heading heading="h5" textWidth="xl" text="Sonstiges" class="col-span-2 whitespace-normal" />
                    <div class="grid gap-4 col-span-2 grid-cols-2 mt-4 place-content-start">
                        <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                            <x-ag.label for="kunden.kd_geburtsdatum" text="Geburtsdatum"/>
                            <x-ag.input type="date" id="kunden.kd_geburtsdatum" wire:model.lazy="kunden.kd_geburtsdatum"/>
                        </div>
                        <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                            <x-ag.label for="kunden.kd_kunde_seit" text="Kunde seit"/>
                            <x-ag.input type="date" id="kunden.kd_kunde_seit" wire:model.lazy="kunden.kd_kunde_seit"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 mb-4">
                <x-ag.heading heading="h5" textWidth="xl" text="FIBU / Konditionen" class="col-span-2 whitespace-normal" />
                <div class="grid gap-4 col-span-2 grid-cols-2 mt-4 place-content-start">
                    <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                        <x-ag.label for="kunden.kd_rabatt_artikel" text="Rabatt auf Artikel in %"/>
                        <x-ag.input type="text" id="kunden.kd_rabatt_artikel" placeholder="Rabatt auf Artikel in %" wire:model.lazy="kunden.kd_rabatt_artikel" value="{{ old('kunden.kd_rabatt_artikel') }}"/>
                    </div>
                    <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                        <x-ag.label for="kunden.kd_rabatt_arbeit" text="Rabatt auf Arbeit in %"/>
                        <x-ag.input type="text" id="kunden.kd_rabatt_arbeit" placeholder="Rabatt auf Arbeit in %" wire:model.lazy="kunden.kd_rabatt_arbeit" value="{{ old('kunden.kd_rabatt_arbeit') }}"/>
                    </div>
                    <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                        <x-ag.label for="kunden.kd_zahlung" text="Zahlungsbedingungen"/>
                        <x-ag.select id="kunden.kd_zahlung" wire:model.lazy="kunden.kd_zahlung">
                            @foreach(kundenSpecs()['zahlungsbedingungen'] as $zahlungsbedingungen)
                                <option value="{{ old('kunden.kd_zahlung', $zahlungsbedingungen) }}">{{ $zahlungsbedingungen }}</option>
                            @endforeach
                        </x-ag.select>
                    </div>
                    <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                        <x-ag.label for="kunden.kd_preisgruppe" text="Preisgruppe"/>
                        <x-ag.select id="kunden.kd_preisgruppe" wire:model.lazy="kunden.kd_preisgruppe">
                            @foreach(kundenSpecs()['preisgruppe'] as $preisgruppe)
                                <option value="{{ old('kunden.kd_preisgruppe', $preisgruppe) }}">{{ $preisgruppe }}</option>
                            @endforeach
                        </x-ag.select>
                    </div>
                    <div class="xl:grid-cols-2 xl:col-span-1 col-span-2">
                        <x-ag.label for="kunden.kd_debitor_nr" text="Debitor-Nr."/>
                        <x-ag.input type="text" id="kunden.kd_debitor_nr" wire:model.lazy="kunden.kd_debitor_nr" placeholder="Debitor-Nr. wird auf KD generiert" disabled/>
                    </div>
                </div>
                <x-ag.heading heading="h5" textWidth="xl" text="Ausländischer Kunde" class="col-span-2 whitespace-normal" />
                <div class="grid gap-4 col-span-2 grid-cols-2 place-content-start">
                    <div class="flex justify-items-center h-16">
                        <x-ag.checkbox-inline type="checkbox" id="kunden.kd_ausl_kunde" value="1" text="Dieser Kunde bekommt eine Netto-Rechnung"/>
                    </div>
                    <div>
                        <x-ag.label for="kunden.kd_ust_id_nr" text="USt - Identifikationsnummer"/>
                        <x-ag.input type="text" id="kunden.kd_ust_id_nr" placeholder="USt - Identifikationsnummer" wire:model.lazy="kunden.kd_ust_id_nr" value="{{ old('kunden.kd_ust_id_nr') }}"/>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 mb-4">
                <x-ag.heading heading="h5" textWidth="xl" text="Anmerkung" class="col-span-2 whitespace-normal" />
                <x-ag.checkbox-inline type="checkbox" id="kunden.kd_anmerkungen_anzeigen" value="1" text="Anmerkungen bei neuen Vorgängen anzeigen"/>
                <div class="grid gap-4 col-span-2 grid-cols-2 mb-4 place-content-start">
                    <div class="col-span-2">
                        <x-ag.textarea id="kunden.kd_anmerkungen" label="hidden" text="">
                            <x-slot:content>
                                {!! old ('kunden.kd_anmerkungen') !!}
                            </x-slot:content>
                        </x-ag.textarea>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-y-4 mb-4">
                <div class="flex justify-end items-center">
                    <x-ag.buttonLink wire:loading.remove type="submit" icon-left="fa-save" text="Speichern"/>
                </div>
                <div wire:loading wire:target="update" class="flex justify-center items-center">
                    <div class="text-center">
                        <div role="status">
                            <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</x-ag.header-admin>
