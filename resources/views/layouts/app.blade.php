<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keyword')">

        <title>@if(isset($title)) @yield('$title') | {{ config('app.name', 'Laravel') }} @else {{ config('app.name', 'Laravel') }} @endif</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{--        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />--}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.css" rel="stylesheet" />
        @livewireStyles

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/datepicker.min.js"></script>--}}

        <!-- Styles -->

        @livewireScripts
        <fc:scripts />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/toolbar.js"></script>
    </head>
    <body>
    <div class="flex h-screen bg-gray-200 dark:bg-gray-900 text-gray-500 dark:text-gray-400" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-partials.sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-partials.navigation />

            <main class="h-full overflow-y-auto">
                {{ $slot }}
            </main>

            <x-partials.footer />
        </div>
    </div>

    <script>
        const notyf = new Notyf({
            position: { x: 'right', y: 'top'}
        });
        Livewire.on('successAlert', alertMessage => {
            notyf.success(alertMessage);
        });
        Livewire.on('errorAlert', alertMessage => {
            notyf.error(alertMessage);
        });
    </script>
    @stack('js')
    @stack('scripts')
    </body>
</html>
