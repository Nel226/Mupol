<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/tabulator.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

        <link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/nav.css') }}">
        <link rel="stylesheet" href="{{ asset('css/btn.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <script src="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/js/pagedone.js"></script>

        <script src="{{ asset('js/cdn.min.js') }}" defer></script>
        <script src="{{ asset('js/regions.js') }}" defer></script>
        <script src="{{ asset('js/grades.js') }}" defer></script>

        <script src="{{ asset('../node_modules/pagedone/src/js/pagedone.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <script src="{{ asset('js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('js/vfs_fonts.js') }}"></script>

        
        <script src="{{ asset('js/papaparse.min.js') }}"></script>
        <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
        <script src="{{ asset('js/jspdf.plugin.autotable.min.js') }}"></script>
        
        <script src="{{ asset('js/tabulator.min.js') }}"></script>
        <script src="{{ asset('js/chart.umd.js') }}"></script>
        <script src="{{ asset('js/datatables.min.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script src="{{ asset('js/theme.js') }}" defer></script>

        
    </head>
    <body class="font-sans bg-blue-800   antialiased">
        <div class="min-h-screen bg-blue-800  dark:bg-gray-900">
            {{--  @include('layouts.navigation')  --}}

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="">
                {{ $slot }}
            </main>
        </div>
        @stack('scripts')
        @livewireScripts
    </body>
</html>
