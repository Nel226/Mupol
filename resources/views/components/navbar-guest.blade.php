<!-- Navbar Area -->
<nav class="bg-primary1 shadow-md fixed w-full z-40 top-0 left-0">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        
        <!-- Logo et Profil Utilisateur -->
        <div class="flex items-center space-x-4">
            <a href="/" class="text-white font-bold text-xl">Mon Application</a>

            <!-- Profil Utilisateur -->
            <div class="user-profile flex items-center">
                @if (Auth::guard('adherent')->check())
                    <img src="{{ asset('storage/' . Auth::guard('adherent')->user()->photo) }}" alt="User Profile" class="h-10 w-10 rounded-full mr-3">
                    <span class="font-semibold text-white">{{ Auth::guard('adherent')->user()->nom }}</span>
                @elseif (Auth::guard('partenaire')->check())
                    <img src="{{ asset('storage/' . Auth::guard('partenaire')->user()->photo) }}" alt="Partenaire Profile" class="h-10 w-10 rounded-full mr-3">
                    <span class="font-semibold text-white">{{ Auth::guard('partenaire')->user()->nom }}</span>
                @else
                    <img src="{{ asset('storage/default-profile.jpg') }}" alt="Default Profile" class="h-10 w-10 rounded-full mr-3">
                    <span class="font-semibold text-white">Utilisateur non connecté</span>
                @endif
            </div>
        </div>

        <!-- Menu de navigation -->
        <div class="hidden md:flex space-x-6 text-white font-semibold">
            @if (Auth::guard('adherent')->check())
            <ul class="flex space-x-6">
                <li>
                    <a href="/" class="hover:bg-gray-700 p-2 rounded-md">Mon Profil</a>
                </li>
                <li>
                    <a href="#" class="hover:bg-gray-700 p-2 rounded-md">Nos Services</a>
                </li>
                <li>
                    <a href="{{ route('adherents.prestations') }}" class="hover:bg-gray-700 p-2 rounded-md">Demande de remboursement</a>
                </li>
                <li>
                    <a href="{{ route('adherents.ayantsdroits') }}" class="hover:bg-gray-700 p-2 rounded-md">Mes ayants droits</a>
                </li>
                <li>
                    <a href="#" class="hover:bg-gray-700 p-2 rounded-md">Ma Demande d&apos;Adhésion</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('adherent.logout') }}" class="flex items-center p-2 text-red-500 hover:bg-red-700 hover:text-white rounded-md">
                        @csrf
                        <button type="submit" class="w-full text-left">
                            <i class="fa  fa-sign-out mr-3"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
            @endif

            @if (Auth::guard('partenaire')->check())
            <ul class="flex space-x-6">
                <li>
                    <a href="/" class="hover:bg-gray-700 p-2 rounded-md">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('partenaires.prestations') }}" class="hover:bg-gray-700 p-2 rounded-md">Prestations</a>
                </li>
                <li>
                    <a href="{{ route('restrictions.index') }}" class="hover:bg-gray-700 p-2 rounded-md">Restrictions</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('partenaire.logout') }}" class="flex items-center p-2 text-red-500 hover:bg-red-700 hover:text-white rounded-md">
                        @csrf
                        <button type="submit" class="w-full text-left">
                            <i class="fa  fa-sign-out mr-3"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
            @endif
        </div>

        <!-- Hamburger Menu (pour petits écrans) -->
        <div class="md:hidden flex items-center">
            <button id="hamburger-btn" class="text-white">
                <i class="fa fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <!-- Menu mobile -->
    <div id="mobile-menu" class="md:hidden hidden bg-primary1 text-white">
        <ul class="space-y-4 py-4">
            @if (Auth::guard('adherent')->check())
            <li><a href="/" class="block p-4">Mon Profil</a></li>
            <li><a href="#" class="block p-4">Nos Services</a></li>
            <li><a href="{{ route('adherents.prestations') }}" class="block p-4">Demande de remboursement</a></li>
            <li><a href="{{ route('adherents.ayantsdroits') }}" class="block p-4">Mes ayants droits</a></li>
            <li><a href="#" class="block p-4">Ma Demande d&apos;Adhésion</a></li>
            <li>
                <form method="POST" action="{{ route('adherent.logout') }}" class="p-4">
                    @csrf
                    <button type="submit" class="w-full text-left text-red-500">Déconnexion</button>
                </form>
            </li>
            @endif

            @if (Auth::guard('partenaire')->check())
            <li><a href="/" class="block p-4">Dashboard</a></li>
            <li><a href="{{ route('partenaires.prestations') }}" class="block p-4">Prestations</a></li>
            <li><a href="{{ route('restrictions.index') }}" class="block p-4">Restrictions</a></li>
            <li>
                <form method="POST" action="{{ route('partenaire.logout') }}" class="p-4">
                    @csrf
                    <button type="submit" class="w-full text-left text-red-500">Déconnexion</button>
                </form>
            </li>
            @endif
        </ul>
    </div>
</nav>

<!-- Script pour activer le menu mobile -->
<script>
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    hamburgerBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
