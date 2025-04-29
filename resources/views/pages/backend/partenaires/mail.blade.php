<x-app-layout>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
    @endif
    <x-top-navbar-admin />

    <div id="sidebar" class="fixed z-20 hidden w-64 h-screen bg-blue-800 border-none rounded-none lg:block">
        <x-sidebar id="logo-sidebar" />
    </div>

    <x-content-page-admin>
        <x-header>
            {{ $pageTitle }}
        </x-header>
        
        <div class="p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg md:p-6">
            @role('agentsaisie|controleur')
                <div class="mx-auto md:w-3/4">
                    
                </div>
            @endrole
        </div>
    </x-content-page-admin>
</x-app-layout>



