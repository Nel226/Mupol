<x-app-layout>
    <x-sidebar/>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification-content');
                const closeBtn = document.getElementById('close-notification');
                
                notification.classList.remove('hidden');
                
                closeBtn.addEventListener('click', () => {
                    notification.classList.add('hidden');
                });
            });
        </script>
    @endif

    <x-content-page>
        @section('navigation-content')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" :pageTitle="$pageTitle"/>
        @endsection      

        <div class="flex-1 p-6">
            <x-header>
                {{$pageTitle}}
            </x-header>
            
            <div class="p-6 mx-auto mt-4 bg-white min-h-screen rounded-b-lg shadow-lg">

                <section class="bg-white dark:bg-gray-900">
                    <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">

                        <img class="w-full max-h-[400px] h-auto dark:hidden" src="{{ Storage::url($partenaire->photo) }}" alt="partenaire de santé image">
                        <img class="w-full max-h-[400px] h-auto hidden dark:block" src="{{ Storage::url($partenaire->photo) }}" alt="partenaire de santé image">

                        <div class="mt-4 md:mt-0">
                            <h2 class="mb-6 text-3xl font-extrabold text-gray-900 dark:text-white">Détails</h2>
                            <div class="card bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                                <div class="card-body">
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Type :</strong> {{ $partenaire->type }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Adresse :</strong> {{ $partenaire->adresse }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Téléphone :</strong> {{ $partenaire->telephone }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Email :</strong> {{ $partenaire->email }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Région :</strong> {{ $partenaire->region }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Province :</strong> {{ $partenaire->province }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Date d'affiliation :</strong> {{ $partenaire->date_affiliation }}</p>
                                </div>

                                <!-- Actions -->
                                <div class="flex justify-end gap-4 mt-4">
                                    <a href="{{ route('partenaires.index', $partenaire) }}" >
                                        Retour à la liste
                                    </a>

                                    <a href="{{ route('partenaires.edit', $partenaire) }}" >                                        
                                        Modifier
                                    </a>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('partenaires.destroy', $partenaire->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce partenaire de santé ?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button type="submit" class=" bg-red-600  hover:bg-red-700">
                                            Supprimer
                                        </x-primary-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            
        </div>
    </x-content-page>
    
</x-app-layout>
