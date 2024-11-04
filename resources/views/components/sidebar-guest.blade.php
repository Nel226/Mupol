<!-- Sidebar Area -->
<aside class="sidebar w-64 bg-[#4000FF] text-white h-screen fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-300 ease-in-out z-40">
    <div class="sidebar-inner p-4">
        <div class="logo flex items-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo de la Mutuelle" class="h-16 w-auto mr-2">
            <h3 class="font-bold text-base text-white">Mutuelle de la Police Nationale (MU-POL)</h3>
        </div>
        <nav class="mt-4">
            <ul class="space-y-2">
                <li>
                    <a href="/" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 0 1 8 8v2a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-2a8 8 0 0 1 8-8z"/></svg>
                        <span>Mon Profil</span>
                    </a>
                </li>
                <li>
                    <a href="" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 0 1 8 8v2a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-2a8 8 0 0 1 8-8z"/></svg>
                        <span>Nos Services</span>
                    </a>
                </li>
                <li>
                    <a href="" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 0 1 8 8v2a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-2a8 8 0 0 1 8-8z"/></svg>
                        <span>Ma Demande d'Adhésion</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adherent.logout') }}" class="flex items-center p-2 text-red-500 hover:bg-red-700 hover:text-white rounded-md">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 2c-5.52 0-10 2.686-10 4v2h20v-2c0-1.314-4.48-4-10-4z"/></svg>
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