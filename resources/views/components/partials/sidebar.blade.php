<!-- Sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-gray-100 dark:bg-gray-800 lg:block flex-shrink-0">
    <x-partials.sidebar.menu />
</aside>
<!-- Mobile Sidebar -->
<!-- Backdrop -->
<div
    x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center lg:hidden"></div>
<aside
    class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-gray-100 dark:bg-gray-800 lg:hidden"
    x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20"
    @close="closeSideMenu"
    @keydown.esc="closeSideMenu">
    <x-partials.sidebar.menu />
</aside>
