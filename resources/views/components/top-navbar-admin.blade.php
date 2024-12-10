<nav class="bg-white z-50 fixed w-full border-b border-gray-300 lg:hidden" x-data="{ open: false }">
    <div class="flex justify-between items-center px-9">
        <!-- Menu Hamburger -->
       
        <button id="menu-button" class="">
            <i class="fa fa-bars text-blue-900 text-lg"></i>
        </button>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var menuButton = document.getElementById('menu-button');
                var sidebar = document.getElementById('sidebar');
                var contentSidebar = document.getElementById('logo-sidebar');
                
                menuButton.addEventListener('click', function() {
                    sidebar.classList.toggle('hidden');
                    sidebar.classList.toggle('lg:block');
                    contentSidebar.classList.toggle('sm:translate-x-0');

                });
            });
        </script>

        <!-- Logo -->
        <div class="ml-1 p-1.5 flex items-center">
            <img class="h-8" src="{{ asset('images/logofinal.png') }}" alt="Logo">
            <h5 class="text-primary1 font-bold">{{ config('app.name') }}</h5>
        </div>

        <!-- User Profile Button -->
        <div class="space-x-4">
            <button @click="open = !open" class="">
                <i class="fa fa-user text-blue-900 text-lg"></i>
            </button>
        </div>

    
    </div>

    <!-- User Menu (Dropdown) -->
    <div x-show="open" x-transition class="absolute top-14 right-9 z-50 bg-white shadow-lg border-t border-gray-200 dark:border-gray-600 lg:hidden py-4 px-6">
        <div class="text-sm font-medium text-gray-800 dark:text-gray-200">
            {{ Auth::user()->name }}
        </div>
        <div class="text-xs font-medium text-gray-500">
            {{ Auth::user()->email }}
        </div>

        <!-- Settings and Logout -->
        <div class="mt-3 space-y-1">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-xs text-gray-700 dark:text-gray-300">Profil</a>
            <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-xs text-gray-700 dark:text-gray-300">
                @csrf
                <button type="submit">Déconnexion</button>
            </form>
        </div>
    </div>
</nav>
