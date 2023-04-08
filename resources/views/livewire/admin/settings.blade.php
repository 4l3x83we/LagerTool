<div>
    <nav class="bg-gray-100 dark:bg-gray-700">
        <div class="w-full flex flex-wrap items-center justify-end mx-auto p-4">
            <button @click="toggleSettingsMenu" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-label="Menu">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="w-full">
                <ul class="hidden lg:flex justify-end items-center flex-row flex-wrap font-medium my-2 gap-2.5 mr-6 space-x-8 text-sm">
                    <x-partials.settings.navbar />
                </ul>
                <div class="w-full lg:hidden"
                     x-show="isSettingsMenuOpen"
                     x-transition:enter="transition ease-in-out duration-150"
                     x-transition:enter-start="opacity-0 transform -translate-y-20"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in-out duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0 transform -translate-y-20"
                     @close="closeSettingsMenu"
                     @keydown.esc="closeSettingsMenu">
                    <ul class="font-medium flex flex-col text-sm p-4 lg:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 lg:bg-white dark:bg-gray-800 lg:dark:bg-gray-900 dark:border-gray-700">
                        <x-partials.settings.navbar />
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <x-ag.header-admin current-page="Settings" current-text="Settings" current-route="admin.settings">
        <x-slot:headline></x-slot:headline>


        {{--<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="settings" data-tabs-toggle="#settingsContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t text-gray-500 dark:text-gray-400" id="firma-tab" data-tabs-target="#firma" type="button" role="tab" aria-controls="firma" aria-selected="false">Firma</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="mwst-tab" data-tabs-target="#mwst" type="button" role="tab" aria-controls="mwst" aria-selected="true">Steuer</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="herstellerArtikel-tab" data-tabs-target="#herstellerArtikel" type="button" role="tab" aria-controls="herstellerArtikel" aria-selected="false">Hersteller Artikel</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="einheiten-tab" data-tabs-target="#einheiten" type="button" role="tab" aria-controls="einheiten" aria-selected="false">Einheiten</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="warengruppe-tab" data-tabs-target="#warengruppe" type="button" role="tab" aria-controls="warengruppe" aria-selected="false">Warengruppe</button>
                </li>
                @hasrole('superadmin')
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-transparent rounded-t hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="hersteller-tab" data-tabs-target="#hersteller" type="button" role="tab" aria-controls="hersteller" aria-selected="false">Hersteller</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-transparent rounded-t hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="model-tab" data-tabs-target="#model" type="button" role="tab" aria-controls="model" aria-selected="false">Model</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-transparent rounded-t hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="fdh-tab" data-tabs-target="#fdh" type="button" role="tab" aria-controls="fdh" aria-selected="false">Fahrzeugdaten</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-transparent rounded-t hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="emissionsklasse-tab" data-tabs-target="#emissionsklasse" type="button" role="tab" aria-controls="emissionsklasse" aria-selected="false">Emissionsklasse</button>
                    </li>
                @endhasrole
            </ul>
        </div>--}}
        {{--<div id="settingsContent mb-8">
            <div class="hidden mb-8 rounded" id="firma" role="tabpanel" aria-labelledby="firma-tab">
--}}{{--                <livewire:admin.settings.stammdaten />--}}{{--
            </div>
            <div class="hidden mb-8 rounded" id="mwst" role="tabpanel" aria-labelledby="mwst-tab">
--}}{{--                <livewire:admin.settings.mw-st />--}}{{--
            </div>
            <div class="hidden mb-8 rounded" id="herstellerArtikel" role="tabpanel" aria-labelledby="herstellerArtikel-tab">
--}}{{--                <livewire:admin.settings.hersteller-artikel />--}}{{--
            </div>
            <div class="hidden mb-8 rounded" id="einheiten" role="tabpanel" aria-labelledby="einheiten-tab">
--}}{{--                <livewire:admin.settings.einheiten />--}}{{--
            </div>
            <div class="hidden mb-8 rounded" id="warengruppe" role="tabpanel" aria-labelledby="warengruppe-tab">
                @include('livewire.admin.settings.warengruppe')
            </div>
            @hasrole('superadmin')
                <div class="hidden mb-8 rounded" id="hersteller" role="tabpanel" aria-labelledby="hersteller-tab">
                    <livewire:admin.settings.hersteller />
                </div>
                <div class="hidden mb-8 rounded" id="model" role="tabpanel" aria-labelledby="model-tab">
--}}{{--                    <livewire:admin.settings.model />--}}{{--
                </div>
                <div class="hidden mb-8 rounded" id="fdh" role="tabpanel" aria-labelledby="fdh-tab">
--}}{{--                    <livewire:admin.settings.fahrzeug-daten-hersteller />--}}{{--
                </div>
                <div class="hidden mb-8 rounded" id="emissionsklasse" role="tabpanel" aria-labelledby="emissionsklasse-tab">
--}}{{--                    <livewire:admin.settings.emissionsklasse />--}}{{--
                </div>
            @endhasrole
        </div>--}}
    </x-ag.header-admin>
</div>
