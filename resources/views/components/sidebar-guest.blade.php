<!-- Sidebar Area -->

<aside class="sidebar-sous py-8 w-64 bg-[#cccccc] text-gray-800 shadow-lg h-screen fixed inset-y-0 transform -translate-x-full md:translate-x-0 transition duration-300 ease-in-out z-40 left-0 top-16 sm:translate-x-0 bg-transparent">
    <div class="sidebar-inner p-4">
    
        <style>
            .sidebar-sous {
                top: 4rem; /* Adjust this value to the height of your header */
                z-index: 40;
            }

        </style>
        <!-- User Profile -->
        <div class="user-profile flex items-center mb-4 p-2 bg-[#4644D5] rounded-md">
            @if (Auth::guard('adherent')->check())
                <!-- Adherent profile -->
                <img src="{{ asset('storage/' . Auth::guard('adherent')->user()->photo) }}" alt="User Profile" class="h-12 w-12 rounded-full mr-3">
                <span class="font-semibold text-white">{{ Auth::guard('adherent')->user()->nom }}</span>
            @elseif (Auth::guard('partenaire')->check())
                <!-- Centre de santé (partenaire) profile -->
                <img src="{{ asset('storage/' . Auth::guard('partenaire')->user()->photo) }}" alt="Centre de santé Profile" class="h-12 w-12 rounded-full mr-3">
                <span class="font-semibold text-white">{{ Auth::guard('partenaire')->user()->nom }}</span>
            @else
                <!-- Default or guest profile -->
                <img src="{{ asset('storage/default-profile.jpg') }}" alt="Default Profile" class="h-12 w-12 rounded-full mr-3">
                <span class="font-semibold text-white">Utilisateur non connecté</span>
            @endif
        </div>

        <nav class="mt-4 font-semibold">
            @if (Auth::guard('adherent')->check())
            <ul class="space-y-2">
                <li>
                    <a href="/" class="flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md">
                        <i class="fa fa-user mr-3"></i>
                        <span>Mon Profil</span>
                    </a>
                </li>
                
                
                <li>
                    <a href="{{ route('adherents.prestations') }}" 
                        class="@if(Request::is('adherents/prestations*')) active @endif flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md transition-all duration-300">
                        <i class="fa fa-file mr-3"></i>
                        <span>Demande de remboursement</span>
                    </a>
                </li>
                <li>
                    <a href="{{  route('adherents.ayantsdroits') }}" class="@if(Request::is('adherents/ayantsdroits') || Request::is('adherents/ayantsdroits/*')) active @endif flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md">
                        <i class="fa fa-users mr-3"></i>
                        <span>Mes ayants droits</span>
                    </a>
                </li>
                <li>
                
                
                
                
            </ul>
            @endif
            @if (Auth::guard('partenaire')->check())
            <ul class="space-y-2">
                <li>
                    <a href="/" class="flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md">
                        <i class="fa fa-user mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('partenaires.prestations') }}" 
                    class="@if(Request::is('partenaire/prestations*')) active @endif flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md transition-all duration-300">
                    <i class="fa fa-list mr-3"></i>
                        <span>Prestations</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('restrictions.index') }}" 
                        class="@if(Request::is('restrictions/*')) active @endif flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md transition-all duration-300">
                        <i class="fa fa-warning mr-3"></i>
                        <span>Restrictions</span>
                    </a>
                </li>
               
                
               
                <li>
                    <form method="POST" action="{{ route('partenaire.logout') }}" class="flex items-center p-2 text-red-500 hover:bg-red-700 hover:text-white rounded-md">
                        @csrf
                        <button type="submit" class="w-full text-left">
                            <i class="fa  fa-sign-out mr-3"></i>

                            Déconnexion
                        </button>
                    </form>
                   
                </li>
            </ul>
            @endif

        </nav>
    </div>
</aside>
<!-- End Sidebar Area -->

<!-- Overlay for sidebar -->
<div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden"></div>

<script>
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('overlay');
    const dropdownButton = document.getElementById('dropdownButton');

    dropdownButton.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>
