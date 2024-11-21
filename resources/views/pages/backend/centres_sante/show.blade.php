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

                        <img class="w-full max-h-[400px] h-auto dark:hidden" src="{{ Storage::url($centre->photo) }}" alt="Centre de santé image">
                        <img class="w-full max-h-[400px] h-auto hidden dark:block" src="{{ Storage::url($centre->photo) }}" alt="Centre de santé image">

                        <div class="mt-4 md:mt-0">
                            <h2 class="mb-6 text-3xl font-extrabold text-gray-900 dark:text-white">Détails</h2>
                            <div class="card bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                                <div class="card-body">
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Type :</strong> {{ $centre->type }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Adresse :</strong> {{ $centre->adresse }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Téléphone :</strong> {{ $centre->telephone }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Email :</strong> {{ $centre->email }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Région :</strong> {{ $centre->region }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Province :</strong> {{ $centre->province }}</p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><strong>Date d'affiliation :</strong> {{ $centre->date_affiliation }}</p>
                                </div>

                                <!-- Actions -->
                                <div class="flex justify-end gap-4 mt-4">
                                    <a href="{{ route('centres-sante.index') }}" class="btn btn-secondary text-white bg-gray-600 hover:bg-gray-700 rounded-lg py-2 px-4">
                                        Retour à la liste
                                    </a>
                                    <a href="{{ route('centres-sante.edit', $centre) }}" class="btn btn-primary text-white bg-blue-600 hover:bg-blue-700 rounded-lg py-2 px-4">
                                        Modifier
                                    </a>
                                    <form action="{{ route('centres-sante.destroy', $centre) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce centre ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-white bg-red-600 hover:bg-red-700 rounded-lg py-2 px-4">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <div class="flex space-x-4">
                    <a href="{{ route('centres-sante.edit', $centre) }}" >
                        <x-primary-button>
                            Modifier
                        </x-primary-button>
                    </a>
            
                    <!-- Bouton Supprimer -->
                    <form action="{{ route('centres-sante.destroy', $centre->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce centre de santé ?');">
                        @csrf
                        @method('DELETE')
                        <x-primary-button type="submit" class=" bg-red-600  hover:bg-red-700">
                            Supprimer
                        </x-primary-button>
                    </form>
                </div>
            </div>
            
        </div>
    </x-content-page>
    
</x-app-layout>
