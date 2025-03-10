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
                <a href="{{ route('ayantsdroits.edit', $ayantDroit->id) }}">
                    <button class="btn">{{ __('Modifier') }}</button>
                </a>
            </div>
            <div class="flex flex-col sm:flex-row p-2 gap-2">
                <div class="sm:w-1/3 w-32 h-32 sm:h-48 mb-4 sm:mb-0">
                    <img src="{{ asset('storage/' . ($ayantDroit->photo ?? 'default-photo.jpg')) }}" alt="Photo de {{ $ayantDroit->nom }}"
                        class="w-full h-full object-cover rounded-full sm:rounded-none border-4 border-gray-200 shadow-md">
                </div>
            
                <div class="w-full sm:w-2/3 sm:ml-6 flex-1">
                    <h2 class="text-lg sm:text-2xl font-bold text-gray-800">{{ $ayantDroit->nom }} {{ $ayantDroit->prenom }}</h2>
                    <p class="text-sm sm:text-base text-gray-600 mt-1">Relation : {{ $ayantDroit->relation }}</p>
                    <p class="text-sm sm:text-base text-gray-600">Sexe : {{ $ayantDroit->sexe }}</p>
                    <p class="text-sm sm:text-base text-gray-600">Code : {{ $ayantDroit->code }}</p>
            
                    <div class="mt-4">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Informations personnelles</h3>
                        <div class="space-y-2">
                            <p class="text-sm sm:text-base text-gray-600">Date de naissance : {{ $ayantDroit->date_naissance ? \Carbon\Carbon::parse($ayantDroit->date_naissance)->format('d/m/Y') : 'Non renseignée' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">CNIB : {{ $ayantDroit->cnib ?? 'Non renseignée' }}</p>
                            <p class="text-sm sm:text-base text-gray-600">Extrait : {{ $ayantDroit->extrait ? 'Disponible' : 'Non renseigné' }}</p>
                        </div>
                    </div>
                    <hr class="my-4 border-t-2 border-blue-700">
            

            
                    <div class="mt-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Adhérent associé</h3>
                        <p class="text-sm sm:text-base text-gray-600">Nom de l'adhérent : 
                            <a href="{{ route('adherents.show', ['adherent' => $ayantDroit->adherent_id] ) }}" class="text-primary1 underline">
                                {{ $ayantDroit->adherent->nom . '  ' . $ayantDroit->adherent->prenom ?? 'Adhérent introuvable' }}
                            </a>
                        </p>
                    </div>
                    <hr class="my-4 border-t-2 border-blue-700">

                </div>
            </div>
            
            
        </div>
        
        
    </x-content-page-admin>
</x-app-layout>



