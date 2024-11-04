<!-- Header Area -->
<header class="header border-b {{ Auth::guard('adherent')->check() ? 'sidebar-open' : '' }}">
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="inner">
                <div class="row align-items-center">
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
                            <div class="relative">
                                <button class="flex items-center text-gray-700 focus:outline-none" id="dropdownButton" aria-haspopup="true" aria-expanded="false">
                                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 2c-5.52 0-10 2.686-10 4v2h20v-2c0-1.314-4.48-4-10-4z"/>
                                    </svg> <!-- Icône utilisateur -->
                                    <span>{{ Auth::guard('adherent')->user()->nom }} {{ Auth::guard('adherent')->user()->prenom }}</span>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden" id="dropdownMenu">
                                    <div class="py-1">
                                        <form id="logout-form" action="{{ route('adherent.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a href="#" class="block px-4 py-2 text-red-500 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
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