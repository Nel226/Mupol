<!-- Header Area -->
    <header class="header header-sous " >
        <style>
            .header-sous {
                z-index: 99999;
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
                    <h1 class="text-lg lg:text-xl font-bold text-primary1 uppercase tracking-tight">
                        Mutuelle de la Police
                    </h1>
                    <p class="text-xs lg:text-sm text-primary1">
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
        
        <div class="header-inner  w-full bg-primary1">
            <div class="container">
                <div class="inner">
                    <div class="row items-center justify-between">
                        <!-- Menu principal -->
                        <div class="col-lg-10 col-md-11 col-12">
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu flex flex-nowrap items-center  text-white text-sm">
                                        <li class="{{ request()->routeIs('accueil') ? 'active' : '' }}">
                                            <a href="{{ route('accueil') }}" class="hover:text-gray-300 px-2">Accueil</a>
                                        </li>
                                        <li class="{{ request()->routeIs('apropos') ? 'active' : '' }}">
                                            <a href="{{ route('apropos') }}" class="hover:text-gray-300 px-2">À Propos</a>
                                        </li>
                                        <li class="{{ request()->routeIs('services') ? 'active' : '' }}">
                                            <a href="{{ route('services') }}" class="hover:text-gray-300 px-2">Nos Services</a>
                                        </li>
                                        @if (!Auth::guard('partenaire')->check())
                                        <li class="{{ request()->routeIs('formulaire-adhesion') ? 'active' : '' }}">
                                            <a href="{{ route('formulaire-adhesion') }}" class="hover:text-gray-300 px-2">Adhérer</a>
                                        </li>
                                        @endif
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
                                        @if (Auth::guard('partenaire')->check())
                                            <li class="{{ request()->routeIs('partenaires.dashboard') ? 'active' : '' }}">
                                                <a href="{{ route('partenaires.dashboard') }}" class="hover:text-gray-300 px-2">Profil</a>
                                            </li>
                                            <li class="{{ request()->routeIs('partenaires.nouvelle-prestation') ? 'active' : '' }}">
                                                <a href="{{ route('partenaires.nouvelle-prestation') }}" class="hover:text-gray-300 px-2">Rechercher</a>
                                            </li>
                                            <li class="{{ request()->routeIs('partenaire.restrictions') ? 'active' : '' }}">
                                                <a href="{{ route('partenaire.restrictions') }}" class="hover:text-gray-300 px-2">Restrictions</a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    
                        <!-- Bouton Connexion/Déconnexion -->
                        <div class="col-lg-2 col-12 flex items-center justify-between">
                            <div class="get-quote">
                                @if (!Auth::guard('adherent')->check() && !Auth::guard('partenaire')->check())
                                    <a href="{{ route('user.login') }}">
                                        <button class="btn items-center !border !border-white">
                                            <i class="fa fa-unlock-alt mr-1"></i> Connexion
                                        </button>
                                    </a>
                                @else
                                    @if (Auth::guard('adherent')->check())
                                        <form action="{{ route('adherent.logout') }}" method="post" class="flex">
                                            @csrf
                                            <button class="btn items-center !border !border-white">
                                                <i class="fa  fa-lock mr-1"></i> Déconnexion
                                            </button>
                                        </form>
                                    @elseif (Auth::guard('partenaire')->check())
                                        <form action="{{ route('partenaire.logout') }}" method="post" class="flex">
                                            @csrf
                                            <button class="btn items-center !border !border-white">
                                                <i class="fa  fa-lock mr-1"></i> Déconnexion
                                            </button>
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