<div class="py-4 text-gray-500 dark:text-gray-400">
    <a href="#" class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200">{{ config('app.name', 'Laravel') }}</a>
    <ul class="mt-6">
        <li class="relative px-6 py-3">
            @if(Request::is('/'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg md:rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="#" class="inline-flex items-center w-full text-sm font-semibold {{ Request::is('/') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <em class="fa-solid fa-tachometer-alt w-5 h-5 inline-flex items-center justify-center"></em>
                <span class="ml-4">Dashboard</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            @if(Request::is('kunden*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg md:rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="#" class="inline-flex items-center w-full text-sm font-semibold {{ Request::is('kunden*') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <em class="fa-solid fa-users w-5 h-5 inline-flex items-center justify-center"></em>
                <span class="ml-4">Kunden</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            @if(Request::is('artikel*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg md:rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="#" class="inline-flex items-center w-full text-sm font-semibold {{ Request::is('artikel*') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <em class="fa-solid fa-sitemap w-5 h-5 inline-flex items-center justify-center"></em>
                <span class="ml-4">Artikel</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            @if(Request::is('fahrzeuge*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg md:rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="#" class="inline-flex items-center w-full text-sm font-semibold {{ Request::is('fahrzeuge*') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <em class="fa-solid fa-car w-5 h-5 inline-flex items-center justify-center"></em>
                <span class="ml-4">Fahrzeuge</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            @if(Request::is('lager*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg md:rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="#" class="inline-flex items-center w-full text-sm font-semibold {{ Request::is('lager*') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <em class="fa-solid fa-dolly w-5 h-5 inline-flex items-center justify-center"></em>
                <span class="ml-4">Lager</span>
            </a>
        </li>
        {{--<li class="relative px-6 py-3">
            @if(Request::is('user*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg md:rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('profile.show') }}" class="inline-flex items-center w-full text-sm font-semibold {{ Request::is('user*') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <em class="fa-solid fa-id-card w-5 h-5 inline-flex items-center justify-center"></em>
                <span class="ml-4">Benutzer Profil</span>
            </a>
        </li>--}}
        <li class="relative px-6 py-3">
            <div class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <span>Admin Bereich</span>
            </div>
        </li>
        <li class="relative px-6 py-3">
            @if(Request::is('benutzerverwaltung/users*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg md:rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('admin.users') }}" class="inline-flex items-center w-full text-sm font-semibold {{ Request::is('benutzerverwaltung/users*') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <em class="fa-solid fa-user w-5 h-5 inline-flex items-center justify-center"></em>
                <span class="ml-4">Benutzer verwalten</span>
            </a>
        </li>
        @role('superadmin')
        <li class="relative px-6 py-3">
            @if(Request::is('benutzerverwaltung/roles*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg md:rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('admin.roles') }}" class="inline-flex items-center w-full text-sm font-semibold {{ Request::is('benutzerverwaltung/roles*') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <em class="fa-solid fa-user-shield w-5 h-5 inline-flex items-center justify-center"></em>
                <span class="ml-4">Rollen</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            @if(Request::is('benutzerverwaltung/permission*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg md:rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('admin.permission') }}" class="inline-flex items-center w-full text-sm font-semibold {{ Request::is('benutzerverwaltung/permission*') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <em class="fa-solid fa-user-secret w-5 h-5 inline-flex items-center justify-center"></em>
                <span class="ml-4">Berechtigungen</span>
            </a>
        </li>
        @endrole
        <li class="relative px-6 py-3">
            @if(Request::is('einstellungen*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg md:rounded-br-lg" aria-hidden="true"></span>
            @endif
                <a href="{{ route('admin.settings.firma') }}" class="inline-flex items-center w-full text-sm font-semibold {{ Request::is('einstellungen*') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <em class="fa-solid fa-gear w-5 h-5 inline-flex items-center justify-center"></em>
                    <span class="ml-4">Einstellungen</span>
                </a>
            {{--<button class="inline-flex items-center justify-between w-full text-sm font-semibold {{ Request::is('einstellungen*') ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="toggleSettingsMenu" aria-haspopup="true">
                    <span class="inline-flex items-center">
                        <em class="fa-solid fa-gear w-5 h-5 inline-flex items-center justify-center"></em>
                        <span class="ml-4">{{ __('Settings') }}</span>
                    </span>
                <svg class="w-4 h-4"  aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"  clip-rule="evenodd"></path>
                </svg>
            </button>
            <template x-if="isSettingsMenuOpen">
                <ul
                    x-transition:enter="transition-all ease-in-out duration-300"
                    x-transition:enter-start="opacity-25 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-xl"
                    x-transition:leave="transition-all ease-in-out duration-300"
                    x-transition:leave-start="opacity-100 max-h-xl"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                    aria-label="submenu" >
                    <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                        <a class="w-full" href="pages/login.html">Login</a>
                    </li>
                </ul>
            </template>--}}
        </li>
    </ul>
</div>
