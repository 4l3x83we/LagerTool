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
    <x-ag.header-admin current-text="Settings Company" render="firma">
        <x-slot:headline></x-slot:headline>
        @can(['create', 'update'])

            @if($updateMode)
                @can('update')
                    @include('livewire.admin.settings.stammdaten.edit')
                @endcan
            @elseif(count($stammdatens) !== 1)
                @can('create')
                    @include('livewire.admin.settings.stammdaten.create')
                @endcan
            @endif

        @endcan

        @if(!$updateMode)
            <div class="flex items-center justify-end mb-4">
            @can('update')
                <x-ag.buttonLink wire:click="edit({{$stammdaten->id}})" class="text-blue-500 hover:text-blue-700 mr-4" icon="fa-pen"/>
            @endcan
            @hasrole('superadmin')
                <x-ag.buttonLink wire:click="destroy({{$stammdaten->id}})" class="text-red-500 hover:text-red-700" icon="fa-trash"/>
            @endhasrole
            </div>

            @can('read')
                <div class="grid grid-cols-1 gap-y-4 mb-4">
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                        <div>
                            <x-ag.heading heading="h4" textWidth="2xl" class="mb-4" text="Firmenadresse" />
                            @if($stammdaten->sd_firmenname)
                                <div class="font-bold mb-2">Firmenname:
                                    <span class="font-normal">{{ $stammdaten->sd_firmenname }}</span>
                                </div>
                            @endif
                            @if($stammdaten->sd_firmenzusatz)
                                <div class="font-bold mb-2">Firmenzusatz:
                                    <span class="font-normal">{{ $stammdaten->sd_firmenzusatz }}</span>
                                </div>
                            @endif
                            @if($stammdaten->sd_absender)
                                <div class="font-bold mb-2">Inhaber:
                                    <span class="font-normal">{{ $stammdaten->sd_absender }}</span>
                                </div>
                            @endif
                            @if($stammdaten->sd_strasse)
                                <div class="font-bold mb-2">Straße:
                                    <span class="font-normal">{{ $stammdaten->sd_strasse }}</span>
                                </div>
                            @endif
                            @if($stammdaten->sd_plz and $stammdaten->sd_ort)
                                <div class="inline-flex justify-start items-center">
                                    <div class="pr-4 font-bold mb-2">
                                        PLZ:
                                        <span class="font-normal">{{ $stammdaten->sd_plz }}</span>
                                    </div>
                                    <div class="font-bold mb-2">Ort:
                                        <span class="font-normal">{{ $stammdaten->sd_ort }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($stammdaten->sd_laenderkuerzel)
                                <div class="font-bold mb-2">Länderkürzel:
                                    <span class="font-normal">{{ $stammdaten->sd_laenderkuerzel }}</span>
                                </div>
                            @endif
                            @if($stammdaten->sd_telefon)
                                <div class="font-bold mb-2">Telefon:
                                    <span class="font-normal">{{ $stammdaten->sd_telefon }}</span>
                                </div>
                            @endif
                            @if($stammdaten->sd_fax)
                                <div class="font-bold mb-2">Fax:
                                    <span class="font-normal">{{ $stammdaten->sd_fax }}</span>
                                </div>
                            @endif
                            @if($stammdaten->sd_webseite)
                                <div class="col-span-2 font-bold mb-2">Internetseite:
                                    <span class="font-normal">{{ $stammdaten->sd_webseite }}</span>
                                </div>
                            @endif
                            @if($stammdaten->sd_email)
                                <div class="col-span-2 font-bold mb-2">E-Mail Adresse:
                                    <span class="font-normal">{{ $stammdaten->sd_email }}</span>
                                </div>
                            @endif
                            @if($stammdaten->sd_steuernummer)
                                <div class="font-bold mb-2">Steuernummer:
                                    <span class="font-normal">{{ $stammdaten->sd_steuernummer }}</span>
                                </div>
                            @endif
                            @if($stammdaten->sd_ust_id)
                                <div class="font-bold mb-2">UST-IdNr.:
                                    <span class="font-normal">{{ $stammdaten->sd_ust_id }}</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <x-ag.heading heading="h4" textWidth="2xl" class="mb-4" text="Logo" />
                            <div class="text-gray-600 dark:text-gray-400">
                                <div class="flex justify-center items-center mb-4">
                                    <img src="https://via.placeholder.com/1024" alt="{{ $stammdaten->sd_firmenname }}" class="object-cover object-center w-full h-auto" style="width: 300px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($stammdaten->sd_kontoinhaber or $stammdaten->sd_bankname or $stammdaten->sd_iban or $stammdaten->sd_bic)
                        <div class="grid grid-cols-1 gap-2">
                            <div>
                            <x-ag.heading heading="h4" textWidth="2xl" class="mb-4" text="Bankdaten" />
                                @if($stammdaten->sd_kontoinhaber)
                                    <div class="col-span-2 font-bold mb-2">Kontoinhaber:
                                        <span class="font-normal">{{ $stammdaten->sd_kontoinhaber }}</span>
                                    </div>
                                @endif
                                @if($stammdaten->sd_bankname)
                                    <div class="col-span-2 font-bold mb-2">Bankname:
                                        <span class="font-normal">{{ $stammdaten->sd_bankname }}</span>
                                    </div>
                                @endif
                                @if($stammdaten->sd_iban)
                                    <div class="col-span-2 font-bold mb-2">IBAN:
                                        <span class="font-normal">{{ $stammdaten->sd_iban }}</span>
                                    </div>
                                @endif
                                @if($stammdaten->sd_bic)
                                    <div class="col-span-2 font-bold mb-2">BIC:
                                        <span class="font-normal">{{ $stammdaten->sd_bic }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endcan
        @endif
    </x-ag.header-admin>
</div>
