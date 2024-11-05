<!-- Sidebar Area -->
<aside class="sidebar w-64 bg-white text-gray-800 shadow-lg h-screen fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-300 ease-in-out z-40">
    <div class="sidebar-inner p-4">
        <div class="logo flex items-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo de la Mutuelle" class="h-16 w-auto mr-2">
            <h3 class="font-bold text-sm text-gray-800">Mutuelle de la Police Nationale (MU-POL)</h3>
        </div>
        
        <!-- User Profile -->
        <div class="user-profile flex items-center mb-4 p-2 bg-[#4644D5] rounded-md">
            <img src="{{ asset('storage/' . Auth::guard('adherent')->user()->photo) }}" alt="User Profile" class="h-12 w-12 rounded-full mr-3">
            <span class="font-semibold text-white">{{ Auth::guard('adherent')->user()->nom }}</span>
        </div>
        
        <nav class="mt-4 font-semibold">
            <ul class="space-y-2">
                <li>
                    <a href="/" class="flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md">
                        <i class="fa fa-user mr-3"></i>
                        <span>Mon Profil</span>
                    </a>
                </li>
                <li>
                    <a href="" class="flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md">
                        <i class="fa fa-cogs mr-3"></i>
                        <span>Nos Services</span>
                    </a>
                </li>
                <li>
                    <a href="{{  route('adherents.prestations') }}" class="flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md">
                        <i class="fa fa-file mr-3"></i>
                        <span>Prestations</span>
                    </a>
                </li>
                <li>
                    <a href="" class="flex items-center p-2 text-gray-800 hover:bg-gray-700 hover:text-white rounded-md">
                        <i class="fa fa-file-text mr-3"></i>
                        <span>Ma Demande d'Adhésion</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adherent.logout') }}" class="flex items-center p-2 text-red-500 hover:bg-red-700 hover:text-white rounded-md">
                        <i class="fa fa-sign-out mr-3"></i>
                        <span>Déconnexion</span>
                    </a>
                </li>
            </ul>
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
