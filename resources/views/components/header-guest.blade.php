<!-- Header Area -->
    <header class="header header-sous" >
        <style>
            .header-sous {
                z-index: 50;
                position: relative;
                /* Ajoutez des styles pour la barre de navigation */
            }
        </style>
        <!-- Topbar -->
        <div class="topbar bg-white py-2 shadow-md">
            <div class="container mx-auto flex flex-wrap items-center justify-between">
                
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="/">
                        <img src="{{ asset('images/logofinal.png') }}" alt="Logo de la Mutuelle" class="h-12 w-auto">
                    </a>
                </div>
                
                <!-- Title and Slogan -->
                <div class="flex-grow text-center">
                    <h1 class="text-lg lg:text-xl font-bold text-[#4000FF] uppercase tracking-tight">
                        Mutuelle de la Police
                    </h1>
                    <p class="text-xs lg:text-sm text-[#4000FF]">
                        Tous solidaires pour notre bien-être !
                    </p>
                </div>
                
                <!-- Secondary Logo or CTA -->
                <div class="flex items-center justify-end flex-shrink-0">
                    <a href="/">
                        <img src="{{ asset('images/police_logo.jpg') }}" alt="Logo de la Police" class="h-12 w-auto">
                    </a>
                </div>
                
            </div>
           
        </div>
        <!-- End Topbar -->
        
        <!-- Header Inner -->
        
        <div class=" w-full !bg-[#4000FF]">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        
                        <div class="col-lg-7 col-md-9 col-12">
                            
                            <!-- Main Menu -->
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu !text-white ">
                                        <li class="{{ request()->routeIs('accueil') ? 'active' : '' }}">
                                            <a href="{{ route('accueil') }}" >Accueil </a>
                                        </li>
                                        <li class="{{ request()->routeIs('en-construction') ? 'active' : '' }}">
                                            <a href="{{ route('en-construction') }}">À Propos</a>
                                        </li>
                                        <li class="{{ request()->routeIs('services') ? 'active' : '' }}">
                                            <a href="{{ route('services') }}">Nos Services</a>
                                        </li>
                                        <li class="{{ request()->routeIs('formulaire-adhesion') ? 'active' : '' }}">
                                            <a href="{{ route('formulaire-adhesion') }}">Adhérer maintenant</a>
                                        </li>
                                        <li class="{{ request()->routeIs('contacts') ? 'active' : '' }}">
                                            <a href="{{ route('contacts') }}">Nous contacter</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!--/ End Main Menu -->
                        </div>
                        
                        <div class="col-lg-5 flex items-center justify-end my-1 col-12">
                           
                            <div class="get-quote">

                                @if (!Auth::guard('adherent')->check())

                                    <a href="{{ route('adherent.login') }}">
                                        <x-primary-button class=" !bg-white !text-[#4000FF] " href="{{ route('adherent.login') }}">
                                            <i class=" fa fa-unlock-alt "></i>
                                            Connexion
                                        </x-primary-button>    
                                    </a>
                                    <div class="relative inline-block text-left">
                                        <x-primary-button class=" inline-flex items-center !text-gray-700 bg-white hover:bg-gray-50 " id="languageMenuButton" aria-expanded="true" aria-haspopup="true">
                                            <span class="mr-2">Langue</span>
                                            <svg class="-mr-1 ml-2 h-2 w-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                            </svg>
                                        </x-primary-button>
                                    
                                        <!-- Dropdown Menu -->
                                        <div class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="languageMenuButton" id="dropdownMenu">
                                            <div class="py-1" role="none">
                                                <!-- French Option -->
                                                <a href="?lang=fr" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                                    <img src="{{ asset('images/flags/france.png') }}" alt="Français" class="w-5 h-5 mr-2">
                                                    Français
                                                </a>
                                                <!-- English Option -->
                                                <a href="?lang=en" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                                    <img src="{{ asset('images/flags/united-states.png') }}" alt="English" class="w-5 h-5 mr-2">
                                                    English
                                                </a>
                                            </div>
                                        </div>
                                    </div>                            
                                @else
                                <form class="flex" action="{{ route('adherent.logout') }}" method="post">
                                    @csrf
                                    <x-primary-button class=" !bg-white !text-[#4000FF] " href="{{ route('adherent.login') }}">
                                        <i class=" fa fa-unlock-alt "></i>
                                        Déconnexion
                                    </x-primary-button>  
                                       
                                </form>
                                    
                                @endif
                              
                                
                                <script>
                                    // Toggle dropdown visibility
                                    document.getElementById('languageMenuButton').addEventListener('click', function() {
                                        const dropdownMenu = document.getElementById('dropdownMenu');
                                        dropdownMenu.classList.toggle('hidden');
                                    });
                                </script>
                                
                            </div>
                            <div class="">
                                <!-- Mobile Nav -->
                                <div class="mobile-nav"></div>
                                <!-- End Mobile Nav -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
<!-- End Header Area -->