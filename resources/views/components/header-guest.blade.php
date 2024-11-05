<!-- Header Area -->
<header  class="header border-b  {{ Auth::guard('adherent')->check() ? 'sidebar-open' : '' }}">
    <!-- Header Inner -->
    <div class="header-inner !rounded-none ">
        <div class="container">
            <div class="inner">
                <div class="row align-items-center {{ Auth::guard('adherent')->check() ? 'bg-[#4644D5]' : '' }}">
                    @if (!Auth::guard('adherent')->check())
                    <div class="col-lg-5 col-md-3 col-12">
                        <!-- Start Logo -->
                        <div class="logo flex gap-2 items-center">
                            <a href="/"><img src="{{ asset('images/logo.png') }}" alt="Logo de la Mutuelle" class="h-16 w-auto"></a>
                            <h3 class="font-bold md:text-base lg:text-base">Mutuelle de la Police Nationale (MU-POL)</h3>
                        </div>
                        <!-- End Logo -->
                        <!-- Mobile Nav -->
                        <div class="mobile-nav"></div>
                        <!-- End Mobile Nav -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Main Menu -->
                        <div class="main-menu">
                            <nav class="navigation">
                                <ul class="nav menu">
                                    <li class="active"><a href="/">Accueil</a></li>
                                    <li><a href="#">Nos Services <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="">Santé</a></li>
                                            <li><a href="">Prévoyance</a></li>
                                            <li><a href="">Assistance</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">À propos <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="">Présentation</a></li>
                                            <li><a href="">Notre Équipe</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!--/ End Main Menu -->
                    </div>

                    @endif
                    <div class="col-lg-3 flex items-center justify-between col-12 ml-auto {{ Auth::guard('adherent')->check() ? 'order-last' : '' }}">
                        @if (Auth::guard('adherent')->check())
                            <!-- Adhérant connecté -->
                            <div class="relative m-2" @click.away="dropdownOpen = false" x-data="{ dropdownOpen: false }">
                                <div class="hidden sm:flex sm:items-center sm:ms-6">
                                    <button 
                                        @click="dropdownOpen = !dropdownOpen" 
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-gray-200 border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none"
                                        aria-haspopup="true" 
                                        aria-expanded="dropdownOpen"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                            <div class="max-w-xs truncate">
                                                {{ strtoupper(substr(Auth::guard('adherent')->user()->nom, 0, 1)) }}{{ strtoupper(substr(Auth::guard('adherent')->user()->prenom, 0, 1)) }}
                                            </div>
                                        </div>
                                    
                                        <div class="ms-1">
                                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                    <div x-show="dropdownOpen" x-transition class="absolute right-5 w-48 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700 z-50" role="menu" aria-orientation="vertical" tabindex="-1">
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">Profil</a>
                                        <form method="POST" action="{{ route('adherent.logout') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">
                                            @csrf
                                            <button type="submit" class="w-full text-left">Déconnexion</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            
                        @else
                            <!-- Adhérant non connecté -->
                            <div class="get-quote">
                                <a class="btn btn-primary" href="{{ route('formulaire-adhesion') }}">
                                    Adhérer maintenant
                                </a>
                            </div>
                            <div>
                                <a class="text-[#4B45DC]" href="{{ route('adherent.login') }}">
                                    Connexion
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    
                    <script>
                        // Script pour afficher/masquer le menu déroulant
                        const dropdownButton = document.getElementById('dropdownButton');
                        const dropdownMenu = document.getElementById('dropdownMenu');
                    
                        dropdownButton.addEventListener('click', () => {
                            dropdownMenu.classList.toggle('hidden');
                        });
                    
                        // Fermer le dropdown si l'utilisateur clique en dehors
                        window.addEventListener('click', (event) => {
                            if (!dropdownButton.contains(event.target)) {
                                dropdownMenu.classList.add('hidden');
                            }
                        });
                    </script>
                    
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!-- End Header Area -->
<style>
    .sidebar-open {
        margin-left: 250px; /* Ajustez cette valeur en fonction de la largeur de votre sidebar */
    }

</style>