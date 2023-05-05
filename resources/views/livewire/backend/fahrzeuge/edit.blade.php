<div>
    <x-ag.header-admin current-text="Vehicles">
        <x-slot:var>
            {!! Breadcrumbs::render("fahrzeugeEdit", $fahrzeug) !!}
        </x-slot:var>
        {{--<x-slot:headline>
        </x-slot:headline>--}}

        <div class="flex items-center justify-between pb-4">
            <span class="text-lg text-gray-500 md:text-xl dark:text-gray-400">Fahrzeug bearbeiten: {{ $fahrzeug->fullname() }}</span>
            <div>
                <x-ag.link link="{{ route('backend.fahrzeuge') }}" class="px-3 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-600 text-xs" icon-left="fa-rotate-left" text="{{ __('Back') }}"/>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-y-4 mb-4">

            <div class="px-4 py-3 bg-gray-50 rounded shadow-md dark:bg-gray-800">
                <form wire:submit.prevent="update">
                    <x-ag.input type="hidden" id="fahrzeug.selected_id" wire:model="selected_id" />
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
                        <!-- Linke spalte -->
                        <div class="grid grid-cols-1 gap-4 place-content-start">
                            @if($formStep == 1)
                                <x-ag.form.form-inline id="fahrzeug.id" text="int. Fz.-Nr." stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4" placeholder="Interne Fahrzeugnummer wird automatisch generiert." disabled/>
                                <div>
                                    <x-ag.heading heading="h5" textWidth="xl" text="Fahrzeugdaten" class="mb-4"/>
                                    <x-ag.form.form-inline id="fahrzeug.fz_kennzeichen" text="Kennzeichen (zu A)" stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-inline id="fahrzeug.fz_hsn" text="HSN (zu 2.1)" stern="true" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                        <x-ag.form.form-inline id="fahrzeug.fz_tsn" text="TSN (zu 2.2)" stern="true" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                    </div>
                                    <x-ag.form.form-inline id="fahrzeug.fz_hersteller" text="Hersteller (zu D.1)" stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4" disabled/>
                                    <x-ag.form.form-inline id="fahrzeug.fz_model" text="Modell (zu D.3)" stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4" disabled/>
                                    <x-ag.form.form-inline id="fahrzeug.fz_type" text="Type (zu D.2)" stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4" disabled/>
                                    <x-ag.form.form-inline id="fahrzeug.fz_fz_id_nr" text="Fz.-Ident.-Nr. (zu E)" stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-inline id="fahrzeug.fz_baujahr" text="Erstzulassung (zu B)" class-label="sm:basis-1/4" class-input="sm:basis-1/4" type="date">
                                        @if($fz_baujahr)
                                            <x-slot:formInlineSlot>
                                                <div class="ml-0 m-2 sm:m-2 text-sm inline-flex items-center sm:basis-2/4">
                                                    <div class="font-medium text-gray-900 dark:text-gray-300 whitespace-normal w-1/2">Alter</div>
                                                    <div class="w-1/2">{{ $age }}</div>
                                                </div>
                                            </x-slot:formInlineSlot>
                                        @endif
                                    </x-ag.form.form-inline>
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-inline id="fahrzeug.fz_hubraum" text="Hubraum (zu P.1)" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                        <x-ag.form.form-inline id="fahrzeug.fz_kw" text="kW (zu P.2)" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                    </div>
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-inline id="fahrzeug.fz_ps" text="PS" placeholder="PS werden berechnet aus kW" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" disabled />
                                        <x-ag.form.form-inline id="fahrzeug.fz_kilometerstand" text="Tachostand" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                    </div>
                                </div>
                                <div>
                                    <x-ag.heading heading="h5" textWidth="xl" text="Halter" class="mb-2"/>
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-inline id="kunde.kd_vorname" text="Vorname" stern="true" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" disabled/>
                                        <x-ag.form.form-inline id="kunde.kd_name" text="Name/Firma" stern="true" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" disabled/>
                                    </div>
                                    <x-ag.form.form-inline id="kunde.kd_strasse" text="Straße" stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4" disabled/>
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-inline id="kunde.kd_plz" text="PLZ" stern="true" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" disabled/>
                                        <x-ag.form.form-inline id="kunde.kd_ort" text="Ort" stern="true" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" disabled/>
                                    </div>
                                </div>
                            @endif
                            @if($formStep == 2)
                                <div>
                                    <x-ag.heading heading="h5" textWidth="xl" text="weitere Fahrzeugdaten" class="mb-2"/>
                                    <x-ag.form.form-select-inline id="fahrzeug.fz_farbe" text="Farbe" class-label="sm:basis-1/4" class-select="sm:basis-2/4" >
                                        @foreach(fahrzeugSpecs()['farbe'] as $farbe)
                                            <option value="{{ $farbe }}" {{ old('fahrzeug.fz_farbe') == $farbe ? 'selected' : '' }}>{{ $farbe }}</option>
                                        @endforeach
                                        <x-slot:inlineFlex>
                                            <div class="ml-0 m-2 sm:m-0 sm:ml-2 sm:basis-1/4">
                                                <x-ag.checkbox-inline id="fahrzeug.fz_farbe_hersteller" value="1" text="Metallic" />
                                            </div>
                                        </x-slot:inlineFlex>
                                    </x-ag.form.form-select-inline>
                                    <x-ag.form.form-inline id="fahrzeug.fz_hersteller_farbe" text="Herstellerfarbe (zu R)" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-inline id="fahrzeug.fz_farbcode" text="Farbcode" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-inline id="fahrzeug.fz_polsterart" text="Polsterart" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                        <x-ag.form.form-inline id="fahrzeug.fz_polsterfarbe" text="" placeholder="Polsterfarbe" class-label="xl:basis-0 sm:basis-1/4" class-input="xl:basis-full sm:basis-3/4" />
                                    </div>
                                    <x-ag.form.form-inline id="fahrzeug.fz_radiocode" text="Radiocode" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-inline id="fahrzeug.fz_schluesselnummer" text="Schlüsselnummer" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-inline id="fahrzeug.fz_sitzplaetze" text="Sitzplätze" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                        <x-ag.form.form-inline id="fahrzeug.fz_tueren" text="Türen" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                    </div>
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-inline id="fahrzeug.fz_schlafplaetze" text="Schlafplätze" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                        <x-ag.form.form-inline id="fahrzeug.fz_achsen" text="Achsen" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Linke spalte end -->
                        <!-- Rechte spalte -->
                        <div class="grid grid-cols-1 gap-4 mb-4 place-content-start">
                            @if($formStep == 1)
                                <div>
                                    <x-ag.heading heading="h5" textWidth="xl" text="weitere Daten" class="mb-2"/>
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-inline type="month" id="fz_hu" text="HU" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                        <div class="flex items-center">
                                            <div class="xl:basis-1/2 sm:basis-3/4 mr-4">
                                                <x-ag.buttonLink wire:click="add2Years()" type="button" icon-left="fa-plus" class="px-3 py-2 text-sm font-medium text-center text-white bg-cyan-700 rounded hover:bg-cyan-800 dark:bg-cyan-600 dark:hover:bg-cyan-700" text="2 Jahre"/>
                                            </div>
                                            <div class="xl:basis-1/2 sm:basis-3/4">
                                                <x-ag.buttonLink wire:click="add1Year()" type="button" icon-left="fa-plus" class="xl:basis-1/2 sm:basis-3/4 px-3 py-2 text-sm font-medium text-center text-white bg-sky-700 rounded hover:bg-sky-800 dark:bg-sky-600 dark:hover:bg-sky-700" text="1 Jahr"/>
                                            </div>
                                        </div>
                                    </div>
                                    <x-ag.form.form-inline id="fahrzeug.fz_reifen_1" text="Reifen (zu 15.1)" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-inline id="fahrzeug.fz_reifen_2" text="Reifen (zu 15.2)" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-select-inline id="fahrzeug.fz_rdks" text="RDKS" class-select="sm:basis-3/4" class-label="sm:basis-1/4" >
                                        @foreach(fahrzeugSpecs()['rdks'] as $rdks)
                                            <option value="{{ $rdks }}" {{ old('fahrzeug.fz_rdks') == $rdks ? 'selected' : '' }}>{{ $rdks }}</option>
                                        @endforeach
                                    </x-ag.form.form-select-inline>
                                    <x-ag.form.form-inline id="fahrzeug.fz_motorcode" text="Motorcode" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-select-inline id="fahrzeug.fz_treibstoff" text="Kraftstoff" class-select="sm:basis-3/4" class-label="sm:basis-1/4" >
                                        @foreach(fahrzeugSpecs()['kraftstoff'] as $kraftstoff)
                                            <option value="{{ $kraftstoff }}" {{ old('fahrzeug.fz_treibstoff') == $kraftstoff ? 'selected' : '' }}>{{ $kraftstoff }}</option>
                                        @endforeach
                                    </x-ag.form.form-select-inline>
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-select-inline id="fahrzeug.fz_kat" text="KAT" class-label="xl:basis-1/2 sm:basis-1/4" class-select="xl:basis-1/2 sm:basis-3/4" >
                                            @foreach(fahrzeugSpecs()['kat'] as $key => $kat)
                                                <option value="{{ $key }}" {{ old('fahrzeug.fz_kat') == $key ? 'selected' : '' }}>{{ $kat }}</option>
                                            @endforeach
                                        </x-ag.form.form-select-inline>
                                        <x-ag.form.form-select-inline id="fahrzeug.fz_plakette" text="Plakette" class-label="xl:basis-1/2 sm:basis-1/4" class-select="xl:basis-1/2 sm:basis-3/4" >
                                            @foreach(fahrzeugSpecs()['plakette'] as $plakette)
                                                <option value="{{ $plakette }}" {{ old('fahrzeug.fz_plakette') == $plakette ? 'selected' : '' }}>{{ $plakette }}</option>
                                            @endforeach
                                        </x-ag.form.form-select-inline>
                                    </div>
                                    <x-ag.form.form-select-inline id="fahrzeug.fz_emissionsklasse" text="Emissionsklasse" class-select="sm:basis-3/4" class-label="sm:basis-1/4" >
                                        @foreach($emissions as $emissionsklasse)
                                            <option value="{{ $emissionsklasse->id }}" {{ old('fahrzeug.fz_emissionsklasse') == $emissionsklasse->id ? 'selected' : '' }}>{{ $emissionsklasse->emissionsklasse }}</option>
                                        @endforeach
                                    </x-ag.form.form-select-inline>
                                    <x-ag.form.form-select-inline id="fahrzeug.fz_getriebeart" text="Getriebe" class-select="sm:basis-3/4" class-label="sm:basis-1/4" >
                                        @foreach(fahrzeugSpecs()['getriebe'] as $getriebe)
                                            <option value="{{ $getriebe }}" {{ old('fahrzeug.fz_getriebeart') == $getriebe ? 'selected' : '' }}>{{ $getriebe }}</option>
                                        @endforeach
                                    </x-ag.form.form-select-inline>
                                </div>
                                <div>
                                    <x-ag.heading heading="h5" textWidth="xl" text="Notiz" class="mb-2"/>
                                    <x-ag.textarea id="fahrzeug.fz_infos" text="" rows="10"><x-slot:content>{{ old('fz_infos') }}</x-slot:content></x-ag.textarea>
                                </div>
                            @endif
                            @if($formStep == 2)
                                <div>
                                    <x-ag.heading heading="h5" textWidth="xl" text="&nbsp;" class="hidden xl:block xl:mb-2"/>
                                    <div class="grid grid-cols-1 xl:gap-2 xl:grid-cols-2">
                                        <x-ag.form.form-inline id="fahrzeug.fz_gaenge" text="Gänge" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                        <x-ag.form.form-inline id="fahrzeug.fz_zylinder" text="Zylinder" class-label="xl:basis-1/2 sm:basis-1/4" class-input="xl:basis-1/2 sm:basis-3/4" />
                                    </div>
                                    <x-ag.form.form-inline id="fahrzeug.fz_leergewicht" text="Leergewicht" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-inline id="fahrzeug.fz_nutzgewicht" text="Nutzgewicht" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-inline id="fahrzeug.fz_gesamtgewicht" text="Gesamtgewicht" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-inline id="fahrzeug.fz_laenge" text="Länge" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-inline id="fahrzeug.fz_breite" text="Breite" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                    <x-ag.form.form-inline id="fahrzeug.fz_hoehe" text="Höhe" class-label="sm:basis-1/4" class-input="sm:basis-3/4" />
                                </div>
                            @endif
                        </div>
                        <!-- Rechte spalte end -->
                        <!-- ganze Zeile -->
                        <div class="grid grid-cols-1 xl:col-span-2 gap-4 place-content-start">
                            <div class="flex justify-between items-center" wire:loading.remove>
                                <div></div>
                                @if($formStep == 1)
                                    <div class="text-right">
                                        <x-ag.buttonLink wire:click="resetInput" type="button" icon-left="fa-eraser" class="mr-4" text="Clear"/>
                                        <x-ag.buttonLink wire:click="nextStep" type="button" icon-right="fa-right-long" class="mr-4" text="Next"/>
                                        <x-ag.buttonLink type="submit" icon-left="fa-save" text="Change" wire:ignore/>
                                    </div>
                                @endif
                                @if($formStep == 2)
                                    <div class="text-right">
                                        <x-ag.buttonLink wire:click="resetInput" type="button" icon-left="fa-eraser" class="mr-4" text="Clear"/>
                                        <x-ag.buttonLink wire:click="prevStep" type="button" icon-left="fa-left-long" class="mr-4" text="Prev"/>
                                        <x-ag.buttonLink type="submit" icon-left="fa-save" text="Change" wire:ignore/>
                                    </div>
                                @endif
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
                        <!-- ganze Zeile end -->
                    </div>
                </form>
            </div>

        </div>
    </x-ag.header-admin>
</div>

