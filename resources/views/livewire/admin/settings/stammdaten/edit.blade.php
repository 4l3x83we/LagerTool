<div class="px-4 py-3 mb-8 bg-gray-50 rounded shadow-md dark:bg-gray-800">
    <div class="grid grid-cols-1 gap-y-4 mb-4">
        <form wire:submit.prevent="update">
        <input type="hidden" wire:model="selected_id">
        <div class="col-span-2 mb-4">
            <x-ag.heading heading="h4" textWidth="2xl" text="Firmenadresse" />
        </div>
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
            <div>
                <x-ag.label for="sd_firmenname" text="Firmenname" stern="true" />
                <x-ag.input type="text" id="sd_firmenname" wire:model="sd_firmenname" placeholder="Firmenname" />
            </div>
            <div>
                <x-ag.label for="sd_firmenzusatz" text="Firmenzusatz" />
                <x-ag.input type="text" id="sd_firmenzusatz" wire:model="sd_firmenzusatz" placeholder="Firmenzusatz" />
            </div>
            <div>
                <x-ag.label for="sd_absender" text="Inhaber" stern="true" />
                <x-ag.input type="text" id="sd_absender" wire:model="sd_absender" placeholder="Inhaber" />
            </div>
            <div>
                <x-ag.label for="sd_strasse" text="Straße" stern="true" />
                <x-ag.input type="text" id="sd_strasse" wire:model="sd_strasse" placeholder="Straße" />
            </div>
            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-2">
                    <x-ag.label for="sd_plz" text="PLZ" stern="true" />
                    <x-ag.input type="text" id="sd_plz" wire:model="sd_plz" placeholder="PLZ" />
                </div>
                <div class="col-span-3">
                    <x-ag.label for="sd_ort" text="Ort" stern="true" />
                    <x-ag.input type="text" id="sd_ort" wire:model="sd_ort" placeholder="Ort" />
                </div>
            </div>
            <div>
                <x-ag.label for="sd_laenderkuerzel" text="Land" stern="true" />
                <x-ag.select id="sd_laenderkuerzel" wire:model="sd_laenderkuerzel" class-select="formSelect">
                    @foreach($countryCodes as $countryCode)
                        <option value="{{ $countryCode['code'] }}">{{ $countryCode['name'] }}</option>
                    @endforeach
                </x-ag.select>
            </div>
            <div>
                <x-ag.label for="sd_telefon" text="Telefon" />
                <x-ag.input type="text" id="sd_telefon" wire:model="sd_telefon" placeholder="Telefon" />
            </div>
            <div>
                <x-ag.label for="sd_fax" text="Fax" />
                <x-ag.input type="text" id="sd_fax" wire:model="sd_fax" placeholder="Fax" />
            </div>
            <div>
                <x-ag.label for="sd_mobil" text="Mobil" />
                <x-ag.input type="text" id="sd_mobil" wire:model="sd_mobil" placeholder="Mobil" />
            </div>
            <div class="hidden lg:block"></div>
            <div>
                <x-ag.label for="sd_email" text="E-Mail Adresse" />
                <x-ag.input type="text" id="sd_email" wire:model="sd_email" placeholder="E-Mail Adresse" />
            </div>
            <div>
                <x-ag.label for="sd_webseite" text="Internetseite" />
                <x-ag.input type="text" id="sd_webseite" wire:model="sd_webseite" placeholder="Internetseite" />
            </div>
            <div>
                <x-ag.label for="sd_steuernummer" text="Steuernummer" />
                <x-ag.input type="text" id="sd_steuernummer" wire:model="sd_steuernummer" placeholder="Steuernummer" />
            </div>
            <div>
                <x-ag.label for="sd_ust_id" text="Ust-IdNr." />
                <x-ag.input type="text" id="sd_ust_id" wire:model="sd_ust_id" placeholder="Ust-IdNr." />
            </div>
        </div>
        <x-ag.hr class="my-4 col-span-2"/>
        <div class="col-span-2 mb-4">
            <x-ag.heading heading="h4" textWidth="2xl" text="Bankdaten" />
        </div>
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
            <div>
                <x-ag.label for="sd_kontoinhaber" text="Kontoinhaber" />
                <x-ag.input type="text" id="sd_kontoinhaber" wire:model="sd_kontoinhaber" placeholder="Kontoinhaber" />
            </div>
            <div>
                <x-ag.label for="sd_bankname" text="Bankname" />
                <x-ag.input type="text" id="sd_bankname" wire:model="sd_bankname" placeholder="Bankname" />
            </div>
            <div>
                <x-ag.label for="sd_iban" text="IBAN" />
                <x-ag.input type="text" id="sd_iban" wire:model="sd_iban" placeholder="IBAN" />
            </div>
            <div>
                <x-ag.label for="sd_bic" text="BIC" />
                <x-ag.input type="text" id="sd_bic" wire:model="sd_bic" placeholder="BIC" />
            </div>
        </div>
        <x-ag.hr class="my-4 col-span-2"/>
        <div class="col-span-2 mb-4">
            <x-ag.heading heading="h4" textWidth="2xl" text="Logo" />
        </div>
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
            <div class="inline-flex mb-2">
                <img src="https://via.placeholder.com/1024" alt="" class="object-cover object-center w-full h-auto" style="width: 300px; height: auto;">
            </div>
            <div class="col-span-2">
                <x-ag.label for="image" text="Logo" />
                <x-ag.input type="file" id="image" wire:model="image" placeholder="Logo" />
            </div>
        </div>
        <x-ag.hr class="my-4 col-span-2"/>
        <div class="flex justify-end items-center">
            <x-ag.button type="submit" icon-left="fa-save" button-text="Ändern" />
        </div>
        </form>
    </div>
</div>
