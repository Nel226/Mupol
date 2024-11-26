<!-- Header Area -->
    <header class="header header-sous" >
        <style>
            .header-sous {
                z-index: 50;
                position: relative;
                top: 0px;
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
                    <div class="row items-center justify-between">
                        <!-- Menu principal -->
                        <div class="col-lg-10 col-md-11 col-12">
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu flex flex-nowrap items-center gap-2 text-white text-sm">
                                        <li class="{{ request()->routeIs('accueil') ? 'active' : '' }}">
                                            <a href="{{ route('accueil') }}" class="hover:text-gray-300 px-2">Accueil</a>
                                        </li>
                                        <li class="{{ request()->routeIs('en-construction') ? 'active' : '' }}">
                                            <a href="{{ route('en-construction') }}" class="hover:text-gray-300 px-2">À Propos</a>
                                        </li>
                                        <li class="{{ request()->routeIs('services') ? 'active' : '' }}">
                                            <a href="{{ route('services') }}" class="hover:text-gray-300 px-2">Nos Services</a>
                                        </li>
                                        <li class="{{ request()->routeIs('formulaire-adhesion') ? 'active' : '' }}">
                                            <a href="{{ route('formulaire-adhesion') }}" class="hover:text-gray-300 px-2">Adhérer</a>
                                        </li>
                                        <li class="{{ request()->routeIs('contacts') ? 'active' : '' }}">
                                            <a href="{{ route('contacts') }}" class="hover:text-gray-300 px-2">Nous contacter</a>
                                        </li>
                                        @if (Auth::guard('adherent')->check())
                                            <li class="{{ request()->routeIs('adherents.dashboard') ? 'active' : '' }}">
                                                <a href="{{ route('adherents.dashboard') }}" class="hover:text-gray-300 px-2">Mon Profil</a>
                                            </li>
                                            <li class="{{ request()->routeIs('adherents.prestations') ? 'active' : '' }}">
                                                <a href="{{ route('adherents.prestations') }}" class="hover:text-gray-300 px-2">Remboursement</a>
                                            </li>
                                            <li class="{{ request()->routeIs('adherents.ayantsdroits') ? 'active' : '' }}">
                                                <a href="{{ route('adherents.ayantsdroits') }}" class="hover:text-gray-300 px-2">Ayants Droits</a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    
                        <!-- Bouton Connexion/Déconnexion -->
                        <div class="col-lg-2 col-12 flex justify-end">
                            <div class="get-quote">
                                @if (!Auth::guard('adherent')->check() && !Auth::guard('partenaire')->check())
                                    <a href="{{ route('adherent.login') }}">
                                        <x-primary-button class="!bg-white !text-[#4000FF] px-2 py-1 text-xs">
                                            <i class="fa fa-unlock-alt"></i> Connexion
                                        </x-primary-button>
                                    </a>
                                @else
                                    @if (Auth::guard('adherent')->check())
                                        <form action="{{ route('adherent.logout') }}" method="post" class="flex">
                                            @csrf
                                            <x-primary-button class="!bg-white !text-[#4000FF] px-2 py-1 text-xs">
                                                <i class="fa fa-unlock-alt"></i> Déconnexion
                                            </x-primary-button>
                                        </form>
                                    @elseif (Auth::guard('partenaire')->check())
                                        <form action="{{ route('partenaire.logout') }}" method="post" class="flex">
                                            @csrf
                                            <x-primary-button class="!bg-white !text-[#4000FF] px-2 py-1 text-xs">
                                                <i class="fa fa-unlock-alt"></i> Déconnexion
                                            </x-primary-button>
                                        </form>
                                    @endif
                                @endif
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