<x-app-layout>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
    @endif
    <x-top-navbar-admin />

    <div id="sidebar" class="lg:block z-20 hidden bg-blue-800 w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" />
    </div>

    <x-content-page-admin>
        <x-header>
            {{ $pageTitle }}
        </x-header>
        
        <div class="">
            @role('administrateur')
            <section class="">
                <div class=" mt-4 ">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <!-- Carte de profil -->
                        <a href="{{ route('profile.edit') }}" class="  block">
                            <div class="bg-white h-full rounded-lg shadow-md p-8">
                                <div class="flex items-center">
                                    <div class="bg-[#7F00FF] text-white p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white dark:text-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h14a2 2 0 002-2v-1a2 2 0 00-2-2H5a2 2 0 00-2 2v1a2 2 0 002 2zm7-7a4 4 0 10-4-4 4 4 0 004 4zM12 12a4 4 0 100-8 4 4 0 000 8z"/>
                                        </svg>                                      
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="text-base md:text-xl font-semibold">Profil</h2>
                                        <p class="mt-2 text-gray-600">Gérez vos informations personnelles</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Carte de User -->
                        <a href="{{ route('users.index') }}" class="block">
                            <div class="bg-white h-full rounded-lg shadow-md p-8">
                                <div class="flex items-center">
                                    <div class="bg-blue-500 text-white p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white dark:text-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7a3 3 0 00-3 3v3a3 3 0 003 3h8a3 3 0 003-3V10a3 3 0 00-3-3H8zM4 12a4 4 0 014-4h8a4 4 0 014 4M4 20h16M4 16h16M4 8h16"/>
                                        </svg>
                                        
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="text-xl md:text-base font-semibold">Utilisateurs</h2>
                                        <p class="mt-2 text-gray-600">Créez, mettez à jour ou supprimez les utilisateurs</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Carte de Roles -->
                        <a href="{{ route('roles.index') }}" class="block">
                            <div class="bg-white h-full rounded-lg shadow-md p-8">
                                <div class="flex items-center">
                                    <div class="bg-blue-700 text-white p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white dark:text-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7a4 4 0 014-4h2a4 4 0 014 4v4a4 4 0 01-4 4h-2a4 4 0 01-4-4V7zm0 10a4 4 0 00-4 4v1a1 1 0 001 1h14a1 1 0 001-1v-1a4 4 0 00-4-4M7 21v-1a1 1 0 011-1h8a1 1 0 011 1v1"/>
                                        </svg>
                                        
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="text-base md:text-xl font-semibold">Rôles</h2>
                                        <p class="mt-2 text-gray-600">Créez, mettez à jour ou supprimez les rôles utilisateur</p>
                                    </div>
                                </div>
                            </div>
                        </a>
        
                        <!-- Carte des paramètres généraux -->
                        <div class="bg-white h-full rounded-lg shadow-md p-8">
                            <div class="flex items-center">
                                <div class="bg-[#fffe4a70] text-white p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-base md:text-xl font-semibold">Général</h2>
                                    <p class="mt-2 text-gray-600">Paramètres généraux de l&apos;application</p>
                                </div>
                            </div>
                        </div>
    
                        {{-- <!-- Carte des Centres de santé -->
                        <a href="{{ route('partenaires.index') }}" class="block">
                            <div class="bg-white h-full rounded-lg shadow-md p-8">
                                <div class="flex items-center">
                                    <div class="bg-blue-500 text-white p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white dark:text-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7a3 3 0 00-3 3v3a3 3 0 003 3h8a3 3 0 003-3V10a3 3 0 00-3-3H8zM4 12a4 4 0 014-4h8a4 4 0 014 4M4 20h16M4 16h16M4 8h16"/>
                                        </svg>
                                        
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="text-xl font-semibold">Centres de santé</h2>
                                        <p class="mt-2 text-gray-600">Créez, mettez à jour ou supprimez les centres de santé</p>
                                    </div>
                                </div>
                            </div>
                        </a> --}}
    
                    </div>
                    
                </div>
            </section>
            @endrole
        </div>
    </x-content-page-admin>
</x-app-layout>



