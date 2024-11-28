<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- *************** Template partenaire ***************** -->
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
        <!-- ******************************** -->


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <!-- icofont CSS -->
        <link rel="stylesheet" href="{{ asset('css/icofont.css') }}">
        <!-- Slicknav -->
        <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">
        <!-- Datepicker CSS -->
        <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
        <!-- Medipro CSS -->
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style-partenaire.css') }}">
                
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        

        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <script src="{{ asset('js/regions.js') }}" defer></script>
        <script src="{{ asset('js/grades.js') }}" defer></script>
        {{--  <script src="{{ asset('js/signature_pad.umd.min.js') }}" defer></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- jquery Min JS -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <!-- jquery Migrate JS -->
        <script src="{{ asset('js/jquery-migrate-3.0.0.js') }}"></script>
        <!-- jquery Ui JS -->
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <!-- Easing JS -->
        <script src="{{ asset('js/easing.js') }}"></script>
        <!-- Color JS -->
        <script src="{{ asset('js/colors.js') }}"></script>
        <!-- Popper JS -->
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <!-- Bootstrap Datepicker JS -->
        <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
        <!-- Jquery Nav JS -->
        <script src="{{ asset('js/jquery.nav.js') }}"></script>
        <!-- Slicknav JS -->
        <script src="{{ asset('js/slicknav.min.js') }}"></script>
        <!-- ScrollUp JS -->
        <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
        <!-- Niceselect JS -->
        <script src="{{ asset('js/niceselect.js') }}"></script>
        <!-- Tilt Jquery JS -->
        <script src="{{ asset('js/tilt.jquery.min.js') }}"></script>
        <!-- Owl Carousel JS -->
        <script src="{{ asset('js/owl-carousel.js') }}"></script>
        <!-- Counterup JS -->
        <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
        <!-- Steller JS -->
        <script src="{{ asset('js/steller.js') }}"></script>
        <!-- Wow JS -->
        <script src="{{ asset('js/wow.min.js') }}"></script>
        <!-- Magnific Popup JS -->
        <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
        <!-- Waypoints JS -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
        <!-- Google Map API Key JS -->
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyDGqTyqoPIvYxhn_Sa7ZrK5bENUWhpCo0w"></script>
        <!-- Gmaps JS -->
        <script src="{{ asset('js/gmaps.min.js') }}"></script>
        <!-- Map Active JS -->
        <script src="{{ asset('js/map-active.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!-- Main JS -->
        <script src="{{ asset('js/main.js') }}"></script>
        
    </head>
    <style>
        .font-body{
            font-family:  'Times New Roman', serif !important
        }
    </style>
    <body class=" font-sans font-body text-gray-900 antialiased">
        
        <div style="margin: 0px !important;" class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white dark:bg-gray-900" >

            <div class="w-full   bg-white dark:bg-gray-800  overflow-y-auto ">

                {{ $slot }}
            </div>
        </div>

        @stack('scripts')
        @livewireScripts
    </body>
    <footer style="margin: 0px;">
        <x-footer/>

    </footer>
</html>
