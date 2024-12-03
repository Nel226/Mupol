<nav class="bg-white border-b border-gray-300 lg:hidden">
    <div class="flex justify-between items-center px-9">
        <!-- Ícono de Menú -->
        <button id="menu-button" class="lg:hidden">
            <i class="fa fa-bars text-blue-900 text-lg"></i>
        </button>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var menuButton = document.getElementById('menu-button');
                var sidebar = document.getElementById('sidebar');
        
                menuButton.addEventListener('click', function() {
                    sidebar.classList.toggle('hidden');
                    sidebar.classList.toggle('lg:block');
                });
            });
        </script>
        <!-- Logo -->
        <div class="ml-1 p-1.5 flex items-center">
            <img class="h-8" src="{{ asset('images/logofinal.png') }}" alt="Logo">

            <h5 class="text-primary1 font-bold">{{ config('app.name') }}</h5>

        </div>

        <!-- Ícono de Notificación y Perfil -->
        <div class="space-x-4">
            <button>
                <i class="fa fa-user text-blue-900 text-lg"></i>
            </button>
        </div>
    </div>
</nav>