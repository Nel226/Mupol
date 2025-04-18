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
            
            <div class="p-6 mx-auto mt-4 bg-white min-h-screen rounded-b-lg shadow-lg ">
                <div class="w-3/4 mx-auto">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Ajouter une nouvelle estimation</h2>
                
                    <form method="POST" action="{{ route('estimations.store') }}" enctype="multipart/form-data">
                        @csrf
                        
<<<<<<< Updated upstream
                        

                        <div class="grid gap-3 sm:grid-cols-2 sm:gap-6">


=======

                        <div class="grid gap-3 sm:grid-cols-2 sm:gap-6">

>>>>>>> Stashed changes
                            <!-- Catégorie estimation -->
                            <div class="w-full">
                                <label for="categorie_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catégorie</label>
                                <select name="categorie_id" id="categorie_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach ($categories as $categorie)
                                        {{-- <option value="{{ $categorie->uuid  }}" data-children="{{ json_encode($categorie->children) }}">{{ $categorie->nom }}</option> --}}
                                        <option value="{{ $categorie->uuid }}" data-children="{{ json_encode($categorie->children) }}" {{ old('categorie_id') == $categorie->uuid ? 'selected' : '' }}>{{ $categorie->nom }}</option>

                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="w-full " id="sous-categorie-container" style="display: none;">
                                <label for="sous_categorie_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sous-catégorie</label>
                                <select name="sous_categorie_id" id="sous_categorie_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="">Sélectionnez une sous-catégorie</option>
                                </select>
                            </div>
                            
                            <!-- Description estimation -->
                            <div class="w-full col-span-2">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea name="description" id="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Description estimation" required></textarea>
                            </div>
                            
                            
                            
<<<<<<< Updated upstream
                            
                            
                            
=======
>>>>>>> Stashed changes
                            <script>
                                document.getElementById('categorie_id').addEventListener('change', function() {
                                    var selectedOption = this.options[this.selectedIndex];
                                    var children = JSON.parse(selectedOption.getAttribute('data-children'));
                                    var sousCategorieContainer = document.getElementById('sous-categorie-container');
                                    var sousCategorieSelect = document.getElementById('sous_categorie_id');
                            
                                    // Réinitialiser le select des sous-catégories
                                    sousCategorieSelect.innerHTML = '<option value="">Sélectionnez une sous-catégorie</option>';
                            
                                    if (children.length > 0) {
                                        sousCategorieContainer.style.display = 'block'; // Afficher le conteneur des sous-catégories
                                        children.forEach(function(child) {
                                            var option = document.createElement('option');
                                            option.value = child.uuid; // Assurez-vous que 'id' existe dans vos données enfants
                                            option.textContent = child.nom; // Assurez-vous que 'nom' existe dans vos données enfants
                                            sousCategorieSelect.appendChild(option);
                                        });
                                    } else {
                                        sousCategorieContainer.style.display = 'none'; // Cacher le conteneur si pas d'enfants
                                    }
                                });
                            </script>
                
                        </div>

                        <div class="grid gap-3 sm:grid-cols-3 sm:gap-6 mb-3">
                
                            <!-- Montant de estimation -->
                            <div class="w-full">
                                <label for="montant" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Montant</label>
                                <input type="number" name="montant" id="montant" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Montant de la estimation" required>
                            </div>

                            <!-- Periode estimation -->
                            <div class="w-full">
                                <label for="periode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Période</label>
                                <select name="periode" id="periode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="" disabled selected>Choisir un trimestre</option>
                                    <option value="T1">Trimestre 1</option>
                                    <option value="T2">Trimestre 2</option>
                                    <option value="T3">Trimestre 3</option>
                                    <option value="T4">Trimestre 4</option>
                                </select>
                            </div>

                            <!-- Année estimation -->
                            <div class="w-full">
                                <label for="annee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Année</label>
                                <input type="number" name="annee" id="annee" min="2020" max="2100" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            </div>
<<<<<<< Updated upstream

                            <!-- Description estimation -->
                            <div class="w-full col-span-3">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea name="description" id="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Description estimation" required></textarea>
                            </div>
                            
                        </div>

                        <div class="grid gap-3 sm:grid-cols-3 sm:gap-6 mb-3">
                
                            <!-- Montant de estimation -->
                            <div class="w-full">
                                <label for="montant" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Montant</label>
                                <input type="number" name="montant" id="montant" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Montant de la estimation" required>
                            </div>

                            <!-- Periode estimation -->
                            <div class="w-full">
                                <label for="periode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Période</label>
                                <select name="periode" id="periode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="" disabled selected>Choisir un trimestre</option>
                                    <option value="T1">Trimestre 1</option>
                                    <option value="T2">Trimestre 2</option>
                                    <option value="T3">Trimestre 3</option>
                                    <option value="T4">Trimestre 4</option>
                                </select>
                            </div>

                            <!-- Année estimation -->
                            <div class="w-full">
                                <label for="annee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Année</label>
                                <input type="number" name="annee" id="annee" min="2020" max="2100" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            </div>
=======
>>>>>>> Stashed changes
                        </div>
                
                        <button type="submit" class="mt-5 text-white bg-primary1 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Ajouter Estimation
                        </button>
                    </form>
                </div>
                
                        
            </div>
        </div>
    </x-content-page>
    
</x-app-layout>
