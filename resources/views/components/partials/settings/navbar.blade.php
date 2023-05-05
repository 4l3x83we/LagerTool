<li>
    <a href="{{ route('admin.settings.firma') }}" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent lg:p-0 {{ request()->is('einstellungen/firma*') ? 'text-white bg-blue-700 lg:text-blue-700 dark:text-white lg:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' }}">Firma</a>
</li>
<li>
    <a href="{{ route('admin.settings.steuern') }}" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent lg:p-0 {{ request()->is('einstellungen/steuern*') ? 'text-white bg-blue-700 lg:text-blue-700 dark:text-white lg:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' }}">Steuer</a>
</li>
<li>
    <a href="{{ route('admin.settings.hersteller-artikel') }}" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent lg:p-0 {{ request()->is('einstellungen/hersteller-artikel') ? 'text-white bg-blue-700 lg:text-blue-700 dark:text-white lg:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' }}">Hersteller Artikel</a>
</li>
<li>
    <a href="{{ route('admin.settings.einheiten') }}" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent lg:p-0 {{ request()->is('einstellungen/einheiten*') ? 'text-white bg-blue-700 lg:text-blue-700 dark:text-white lg:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' }}">Einheiten</a>
</li>
<li>
    <a href="{{ route('admin.settings.warengruppe') }}" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent lg:p-0 {{ request()->is('einstellungen/warengruppe*') ? 'text-white bg-blue-700 lg:text-blue-700 dark:text-white lg:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' }}">Warengruppe</a>
</li>
@role('superadmin')
    <li>
        <a href="{{ route('admin.settings.hersteller') }}" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent lg:p-0 {{ request()->is('einstellungen/hersteller') ? 'text-white bg-blue-700 lg:text-blue-700 dark:text-white lg:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' }}">Hersteller</a>
    </li>
    <li>
        <a href="{{ route('admin.settings.model') }}" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent lg:p-0 {{ request()->is('einstellungen/model*') ? 'text-white bg-blue-700 lg:text-blue-700 dark:text-white lg:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' }}">Model</a>
    </li>
    <li>
        <a href="{{ route('admin.settings.hsn') }}" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent lg:p-0 {{ request()->is('einstellungen/hsn*') ? 'text-white bg-blue-700 lg:text-blue-700 dark:text-white lg:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' }}">HSN</a>
    </li>
    <li>
        <a href="{{ route('admin.settings.fahrzeugdaten') }}" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent lg:p-0 {{ request()->is('einstellungen/fahrzeugdaten*') ? 'text-white bg-blue-700 lg:text-blue-700 dark:text-white lg:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' }}">Fahrzeugdaten</a>
    </li>
    <li>
        <a href="{{ route('admin.settings.emissionsklasse') }}" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent lg:p-0 {{ request()->is('einstellungen/emissionsklasse*') ? 'text-white bg-blue-700 lg:text-blue-700 dark:text-white lg:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' }}">Emissionsklasse</a>
    </li>
@endrole
