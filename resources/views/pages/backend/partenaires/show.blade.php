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
            @role('agentsaisie|controleur')
            <section class="bg-white dark:bg-gray-900">
                <a  class="btn" href="{{ route('partenaires.index', $partenaire) }}" >
                    Retour 
                </a>
                <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">

                    <img class="w-full max-h-[400px] h-auto dark:hidden" src="{{ Storage::url($partenaire->photo) }}" alt="partenaire de santé image">
                    <img class="w-full max-h-[400px] h-auto hidden dark:block" src="{{ Storage::url($partenaire->photo) }}" alt="partenaire de santé image">

                    <div class="mt-4 md:mt-0">
                        <h2 class="mb-6 text-lg font-extrabold text-gray-900 dark:text-white">{{ $partenaire->nom }}</h2>
                        <div class="card bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                            <div class="card-body text-sm">
                                <p class=" font-semibold text-gray-700 dark:text-gray-300"><strong>Type :</strong> {{ $partenaire->type }}</p>
                                <p class=" font-semibold text-gray-700 dark:text-gray-300"><strong>Adresse :</strong> {{ $partenaire->adresse }}</p>
                                <p class=" font-semibold text-gray-700 dark:text-gray-300"><strong>Téléphone :</strong> {{ $partenaire->telephone }}</p>
                                <p class=" font-semibold text-gray-700 dark:text-gray-300"><strong>Email :</strong> {{ $partenaire->email }}</p>
                                <p class=" font-semibold text-gray-700 dark:text-gray-300"><strong>Région :</strong> {{ $partenaire->region }}</p>
                                <p class=" font-semibold text-gray-700 dark:text-gray-300"><strong>Province :</strong> {{ $partenaire->province }}</p>
                                <p class=" font-semibold text-gray-700 dark:text-gray-300"><strong>Créé le :</strong> {{ $partenaire->created_at }}</p>
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-between gap-4 mt-4">
                                

                                <a class="btn" href="{{ route('partenaires.edit', $partenaire) }}" >                                        
                                    Modifier
                                </a>

                                <!-- Bouton Supprimer -->
                                <form action="{{ route('partenaires.destroy', $partenaire->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce partenaire de santé ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" btn bg-red-600  hover:bg-red-700">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
            
                        </div>
                    </div>
                </div>
            </section>
            @endrole
        </div>
    </x-content-page-admin>
</x-app-layout>


