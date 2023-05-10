<x-ag.header-admin current-text="">
    <x-slot:var>
        {!! Breadcrumbs::render("artikelEdit", $artikel) !!}
    </x-slot:var>
    {{--<x-slot:headline>
    </x-slot:headline>--}}

    <div class="flex items-center justify-between pb-4">
        <span class="text-lg text-gray-500 md:text-xl dark:text-gray-400">Artikel bearbeiten: {{ $artikel->art_name }}</span>
        <div>
            <x-ag.link link="{{ route('backend.artikel') }}" class="px-3 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-600 text-xs" icon-left="fa-rotate-left" text="{{ __('Back') }}"/>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-y-4 mb-4">

        <div class="px-4 py-3 bg-gray-50 rounded shadow-md dark:bg-gray-800">
            <form wire:submit.prevent="update">
                <x-ag.input type="hidden" id="fahrzeug.selected_id" wire:model="selected_id" />
                <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
                    <!-- Linke spalte -->
                    <div class="grid grid-cols-1 gap-4 place-content-start">
                        @if($formStep === 1)
                            <div>
                                <x-ag.heading heading="h5" textWidth="xl" text="Artikeldaten" class="mb-4"/>
                                <x-ag.form.form-select-inline id="artikel.art_hersteller" text="Hersteller" stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4">
                                    @foreach($herstellers as $hersteller)
                                        <option value="{{ $hersteller->ha_name }}" {{ old('artikel.art_hersteller') == $hersteller->ha_name ? 'selected' : '' }}>{{ $hersteller->ha_name }}</option>
                                    @endforeach
                                </x-ag.form.form-select-inline>
                                <x-ag.form.form-inline id="artikel.art_nr" text="Artikelnummer" stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4"/>
                                <x-ag.form.form-inline id="artikel.art_name" text="Bezeichnung" stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4"/>
                                <x-ag.form.form-inline id="artikel.art_ean" text="EAN" class-label="sm:basis-1/4" class-input="sm:basis-3/4"/>
                                <x-ag.form.form-select-inline id="artikel.art_einheit" text="Einheit" class-label="sm:basis-1/4" class-input="sm:basis-3/4">
                                    @foreach($einheits as $einheit)
                                        <option value="{{ $einheit->eh_name }}" {{ old('artikel.art_einheit') == $einheit->eh_name ? 'selected' : '' }}>{{ $einheit->eh_name }}</option>
                                    @endforeach
                                </x-ag.form.form-select-inline>
                                <x-ag.form.form-select-inline id="warengruppe.id" text="Warengruppe" class-label="sm:basis-1/4" class-input="sm:basis-3/4">
                                    @foreach($warengruppes as $warengruppe)
                                        <option value="{{ $warengruppe->id }}" {{ old('warengruppe.id') == $warengruppe->id ? 'selected' : '' }}>{{ $warengruppe->wg_name }}</option>
                                    @endforeach
                                </x-ag.form.form-select-inline>
                            </div>
                            <div>
                                <x-ag.heading heading="h5" textWidth="xl" text="Preise" class="mb-4"/>
                                <x-ag.form.form-inline id="preises.pr_netto_ek" text="Netto EKP" class-label="sm:basis-1/4" class-input="sm:basis-3/4"/>
                                <x-ag.form.form-inline id="preises.pr_netto_vk" text="Netto VKP" class-label="sm:basis-1/4" class-input="sm:basis-3/4"/>
                                <x-ag.form.form-select-inline id="artikel.art_mwst" text="MwSt" class-label="sm:basis-1/4" class-input="sm:basis-3/4">
                                    @foreach($mwsts as $mwst)
                                        <option value="{{ $mwst->mw_wert }}" {{ old('artikel.art_mwst') == $mwst->mw_wert ? 'selected' : '' }}>{{ $mwst->mw_name }}</option>
                                    @endforeach
                                </x-ag.form.form-select-inline>
                                <x-ag.form.form-inline id="preises.pr_brutto_vk" text="Brutto VKP" class-label="sm:basis-1/4" class-input="sm:basis-3/4"/>
                            </div>
                        @endif
                        @if($formStep === 2)
                            <div>
                                <x-ag.heading heading="h5" textWidth="xl" text="Lagerbestand" class="mb-4"/>
                                <x-ag.form.form-inline id="lager.la_bestand" text="akt. Bestand" class-label="sm:basis-1/4" class-input="sm:basis-3/4">
                                    <x-slot:formInlineSlot>
                                        <x-ag.link link="" class="ml-4 px-3 py-2 mt-1 bg-gray-500 hover:bg-gray-600 dark:bg-gray-500 dark:hover:bg-gray-600 text-xs" text="Lagerbewegung"/>
                                    </x-slot:formInlineSlot>
                                </x-ag.form.form-inline>
                                {{--<x-ag.form.form-inline id="lager.la_reserviert" text="Reserviert" stern="true" class-label="sm:basis-1/4" class-input="sm:basis-3/4">
                                    <x-slot:formInlineSlot>
                                        <x-ag.link link="" class="ml-4 px-3 py-2 mt-1 bg-gray-500 hover:bg-gray-600 dark:bg-gray-500 dark:hover:bg-gray-600 text-xs" text="Aufträge"/>
                                    </x-slot:formInlineSlot>
                                </x-ag.form.form-inline>
                                <x-ag.form.form-inline id="lager.la_verfuegbar" text="Verfügbar" class-label="sm:basis-1/4" class-input="sm:basis-3/4"/>--}}
                                <x-ag.heading heading="h5" textWidth="xl" text="Lager" class="mb-4"/>
                                <div class="mb-2 inline-flex w-full">
                                    <div class="sm:basis-1/4 invisible sm:visible">&nbsp;</div>
                                    <div class="sm:basis-3/4"><x-ag.checkbox-inline id="lager.la_lagerfuehrung" text="Lagerführerung" value="1" /></div>
                                </div>
                                <x-ag.form.form-inline id="lager.la_lagerort" text="Lagerort" class-label="sm:basis-1/4" class-input="sm:basis-3/4"/>
                                <x-ag.form.form-inline id="lager.la_min" text="Min. Menge" class-label="sm:basis-1/4" class-input="sm:basis-3/4"/>
                                <x-ag.form.form-inline id="lager.la_max" text="Max. Menge" class-label="sm:basis-1/4" class-input="sm:basis-3/4"/>
                            </div>
                        @endif
                    </div>
                    <!-- Linke spalte end -->
                    <!-- Rechte spalte -->
                    <div class="grid grid-cols-1 gap-4 mb-4 place-content-start">
                        @if($formStep === 1)
                            <div>
                                <x-ag.heading heading="h5" textWidth="xl" text="Preisgruppe" class="mb-4"/>
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th class="p-1 w-1/4 text-center"></th>
                                            <th class="p-1 w-1/4 text-center">Verkaufspreis</th>
                                            <th class="p-1 w-1/4 text-center">Brutto VKP</th>
                                            <th class="p-1 w-1/4 text-center">Marge in %</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i = 1; $i <= 5; $i++)
                                            <tr>
                                                <td class="p-1 w-1/4">{{ 'Preisgruppe ' . $i }}</td>
                                                <td class="p-1 w-1/4">
                                                    <x-ag.form.input-inline id="preises.pr_prg_{{$i}}_netto_vk" text="Verkaufspreis netto" />
                                                </td>
                                                <td class="p-1 w-1/4">
                                                    <x-ag.form.input-inline id="preises.pr_prg_{{$i}}_brutto_vk" text="Verkaufspreis brutto" />
                                                </td>
                                                <td class="p-1 w-1/4">
                                                    <div class="mt-1 text-right">{{ marge($artikel->preises['pr_prg_'.$i.'_netto_vk'], $artikel->preises->pr_brutto_ek) }}</div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                                <x-ag.heading heading="h5" textWidth="xl" text="Notiz" class="mb-2"/>
                                <x-ag.textarea id="artikel.art_notiz" text="" content="{{ old('artikel.art_notiz') }}" rows="12" />
                                <x-ag.form.file id="images" wire:model="images" multiple />
                            </div>
                        @endif
                        @if($formStep === 2)
                            <div>
                                <x-ag.heading heading="h5" textWidth="xl" text="Beschreibung" class="mb-2"/>
                                <x-ag.textarea id="artikel.art_beschreibung" text="" content="{{ old('artikel.art_beschreibung') }}" rows="15" />
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
                                    <x-ag.buttonLink wire:click="nextStep" type="button" icon-right="fa-right-long" class="mr-4" text="Next"/>
                                    <x-ag.buttonLink type="submit" icon-left="fa-save" text="Change" wire:ignore/>
                                </div>
                            @endif
                            @if($formStep == 2)
                                <div class="text-right">
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
