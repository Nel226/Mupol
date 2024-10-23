<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/tabulator.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/cdn.min.js') }}" defer></script>

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
        
    </head>
    <body class="font-sans bg-gradient-to-r from-[#4E46E3] to-blue-900  antialiased">
        <div class="min-h-screen  dark:bg-gray-900">
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
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
