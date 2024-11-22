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
                <div class="w-3/4 mx-auto">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Ajouter un nouveau partenaire</h2>
                    
                    <form method="POST" action="{{ route('partenaires.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-3 sm:grid-cols-2 sm:gap-6">
                            
                            <!-- Nom du partenaire -->
                            <div class="w-full">
                                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nom du partenaire de santé" required>
                                @error('nom')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type du partenaire -->
                            <div class="w-full">
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="" disabled selected>Sélectionnez le type de partenaire</option>
                                    <option value="hopital">Hôpital</option>
                                    <option value="clinique">Clinique</option>
                                    <option value="pharmacie">Pharmacie</option>

                                </select>
                                @error('type')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Adresse -->
                            <div class="w-full">
                                <label for="adresse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                                <input type="text" name="adresse" id="adresse" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez une adresse" required>
                                @error('adresse')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="geolocalisation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lien Google Maps</label>
                                <input type="url" name="geolocalisation" id="geolocalisation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez un lien Google Maps" required>
                                @error('geolocalisation')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>    

                            <!-- Téléphone -->
                            <div class="w-full">
                                <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                                <input type="number" name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Numéro de téléphone" required>
                                @error('telephone')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="w-full">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Email du partenaire" required>
                                @error('email')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Région -->
                            <div class="w-full">
                                <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Région</label>
                                <select name="region" id="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="" disabled selected>Sélectionnez une région</option>
                                </select>
                                @error('region')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Province -->
                            <div class="w-full">
                                <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                                <select name="province" id="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="" disabled selected>Choisissez d&apos;abord votre région</option>
                                </select>
                                @error('province')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Photo -->
                            <div class="w-full col-span-2">
                                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo</label>
                                <input 
                                    type="file" 
                                    name="photo" 
                                    id="photo" 
                                    accept="image/*" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @error('photo')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <div class="mt-4">
                                    <img 
                                        id="preview" 
                                        src="#" 
                                        alt="Prévisualisation de l'image" 
                                        class="hidden max-w-full h-auto border border-gray-300 rounded-lg">
                                </div>
                            </div>

                            <!-- Script pour gérer la prévisualisation -->
                            <script>
                                document.getElementById('photo').addEventListener('change', function (event) {
                                    const file = event.target.files[0]; // Obtenir le fichier sélectionné
                                    const preview = document.getElementById('preview'); // L'élément img pour prévisualisation
                                    
                                    if (file) {
                                        const reader = new FileReader(); // Créer un lecteur de fichier
                                        
                                        reader.onload = function (e) {
                                            preview.src = e.target.result; // Définir la source de l'image
                                            preview.classList.remove('hidden'); // Afficher l'image
                                        };
                                        
                                        reader.readAsDataURL(file); // Lire le fichier comme URL
                                    } else {
                                        preview.src = '#'; // Réinitialiser la source si aucun fichier sélectionné
                                        preview.classList.add('hidden'); // Cacher l'image
                                    }
                                });
                            </script>


                           
                            
            

                            <script>
                        
                        
                                document.addEventListener("DOMContentLoaded", function() {
                                    const regionSelect = document.getElementById("region");
                                    const provinceSelect = document.getElementById("province");
                                
                                    for (const region in regions) {
                                        const option = document.createElement("option");
                                        option.value = region;
                                        option.textContent = region;
                                        regionSelect.appendChild(option);
                                    }
                                
                                    regionSelect.addEventListener("change", function() {
                                        const selectedRegion = regionSelect.value;
                                
                                        provinceSelect.innerHTML = "";
                                        provinceSelect.disabled = false;
                                
                                        const defaultOption = document.createElement("option");
                                        defaultOption.value = "";
                                        defaultOption.disabled = true;
                                        defaultOption.selected = true;
                                        defaultOption.textContent = "Choisissez votre province";
                                        provinceSelect.appendChild(defaultOption);
                                
                                        regions[selectedRegion].provinces.forEach(province => {
                                            const option = document.createElement("option");
                                            option.value = province;
                                            option.textContent = province;
                                            provinceSelect.appendChild(option);
                                        });
                                    });
                                });
                                
                            </script>

            
                            
            
                        </div>
                        <div class="flex justify-end">
                            <x-primary-button type="submit" class="mt-5 ">
                                Ajouter partenaire
                            </x-primary-button>

                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </x-content-page>
    
</x-app-layout>
