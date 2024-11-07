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
        <div class="topbar">
            <div class="container">
                <div class="row items-center">
                    <div class="col-lg-3 col-md-3 col-12">
                        <!-- Start Logo -->
                        <div class="logo">
                            <a href="/"><img src="{{ asset('images/logofinal.png') }}" alt="Logo de la Mutuelle" class="h-16 w-auto"></a>
                        </div>
                        <!-- End Logo -->
                        <!-- Mobile Nav -->
                        <div class="mobile-nav"></div>
                        <!-- End Mobile Nav -->
                    </div>
                    <div class="col-lg-6 col-md-9 col-12">
                        <!-- Main Menu -->
                        <div class="main-menu">
                            <div class="text-center ">
                                <h1 class="text-xl uppercase  font-bold !text-[#4000FF]  tracking-tight  ">
                                    Mutuelle de la Police
                                </h1>
                                <p class="text-sm  tracking-tighter !text-[#4000FF]   ">
                                    Tous solidaires pour notre bien-être !
                                </p>
                            </div>                            
                        </div>
                        <!--/ End Main Menu -->
                    </div>
                    <div class="col-lg-3 col-12 flex justify-end">
                        <div class="get-quote">
                            <a href="/">
                                <img src="{{ asset('images/police_logo.jpg') }}" alt="Logo de la Police" class="h-16 w-auto">
                            </a>
                        </div>
                    </div>
                    
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
                                        <li class=" !bg-[#926FFB] !text-[#4000FF] "><a href="#" class="!text-white">Accueil <i class="icofont-rounded-down"></i></a>
                                        
                                        </li>
                                        <li><a href="#">À Propos </a>
                                            <ul class="dropdown">
                                                <li><a href="">Présentation</a></li>
                                                <li><a href="">Notre Équipe</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Nos Services </a></li>
                                        <li>                                
                                            <a class="btn btn-primary" href="{{ route('formulaire-adhesion') }}">
                                                Adhérer maintenant
                                            </a>  
                                        </li>
                                        
                                        <li><a href="contact.html">Nous contacter</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!--/ End Main Menu -->
                        </div>
                        <div class="col-lg-5 flex justify-end my-1 col-12">
                            <div class="get-quote">
                                <x-primary-button class=" !bg-white !text-[#4000FF] " href="{{ route('adherent.login') }}">
                                <a href="{{ route('adherent.login') }}">
                                        <i class=" fa fa-unlock-alt "></i>
                                        Connexion
                                    </a>
                                </x-primary-button>                                
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
                                
                                <script>
                                    // Toggle dropdown visibility
                                    document.getElementById('languageMenuButton').addEventListener('click', function() {
                                        const dropdownMenu = document.getElementById('dropdownMenu');
                                        dropdownMenu.classList.toggle('hidden');
                                    });
                                </script>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
<!-- End Header Area -->