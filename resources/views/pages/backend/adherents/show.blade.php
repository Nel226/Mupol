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

        <div class="md:p-6 p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg">
            <div class="flex flex-wrap items-center justify-end py-2 gap-2">
                <a href="{{ route('adherents.edit', $adherent->id) }}">
                    <button class="btn">{{ __('Modifier') }}</button>
                </a>
            </div>
            <div class="flex flex-col sm:flex-row p-2 gap-2">
                <!-- Image div -->

                <div class="sm:w-1/3 w-32 h-32 sm:h-48 mb-4 sm:mb-0 ">
                    <img src="{{ asset('storage/' . ($adherent->photo ?? 'default-photo.jpg')) }}" alt="Photo de {{ $adherent->nom }}"
                        class="w-full h-full object-cover rounded-full sm:rounded-none border-4 border-gray-200 shadow-md">
                </div>
                              
                <!-- Information div -->
                <div class="w-full sm:w-2/3 sm:ml-6 flex-1">
                    <h2 class="text-lg sm:text-2xl font-bold text-gray-800">{{ $adherent->nom }} {{ $adherent->prenom }}</h2>
                    <p class="text-sm sm:text-base text-gray-600 mt-1">Matricule : {{ $adherent->matricule }}</p>
                    <p class="text-sm sm:text-base text-gray-600">NIP : {{ $adherent->nip }}</p>
                    <p class="text-sm sm:text-base text-gray-600">CNIB : {{ $adherent->cnib }}</p>
            
                    <div class="mt-4">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Contact</h3>
                        <div class="space-y-2">
                            <p class="text-sm sm:text-base text-gray-600">Téléphone : {{ $adherent->telephone ?? 'Non renseigné' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Email : {{ $adherent->email ?? 'Non renseigné' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Adresse : {{ $adherent->adresse ?? 'Non renseignée' }}</p>
                        </div>
                    </div>
                    <hr class="my-4 border-t-2 border-blue-700">
            
                    <div class="mt-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Informations personnelles</h3>
                        <div class="space-y-2">
                            <p class="text-sm sm:text-base text-gray-600">Situation matrimoniale : {{ $adherent->situation_matrimoniale ?? 'Non renseignée' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Nom du père : {{ $adherent->nom_pere ?? 'Non renseigné' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Nom de la mère : {{ $adherent->nom_mere ?? 'Non renseigné' }}</p>
                        </div>
                    </div>
                    <hr class="my-4 border-t-2 border-blue-700">
            
                    <div class="mt-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Informations professionnelles</h3>
                        <div class="space-y-2">
                            <p class="text-sm sm:text-base text-gray-600">Grade : {{ $adherent->grade ?? 'Non renseigné' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Direction : {{ $adherent->direction ?? 'Non renseignée' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Service : {{ $adherent->service ?? 'Non renseigné' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Région : {{ $adherent->region ?? 'Non renseignée' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Province : {{ $adherent->province ?? 'Non renseignée' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Localité : {{ $adherent->localite ?? 'Non renseignée' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Date d'intégration : {{ $adherent->dateIntegration ? \Carbon\Carbon::parse($adherent->dateIntegration)->format('d/m/Y') : 'Non renseignée' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Date départ à la retraite : {{ $adherent->dateDepartARetraite ? \Carbon\Carbon::parse($adherent->dateDepartARetraite)->format('d/m/Y') : 'Non renseignée' }}</p>
                        </div>
                    </div>
                    <hr class="my-4 border-t-2 border-blue-700">
            
                    
                </div>
            </div>
            
        </div>
        
        
    </x-content-page-admin>
</x-app-layout>



