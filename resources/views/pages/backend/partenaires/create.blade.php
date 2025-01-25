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
                <div class="md:w-3/4 mx-auto">
                    <h2 class="mb-4 text-sm md:text-lg lg:text-xl font-bold text-gray-900 dark:text-white">Ajouter un nouveau partenaire</h2>
                    
                    <form method="POST" action="{{ route('partenaires.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2  gap-3 md:gap-5">
                            <!-- Nom du partenaire -->
                            <div>
                                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nom du partenaire de santé" required>
                                @error('nom')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Type du partenaire -->
                            <div>
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="" disabled selected>Sélectionnez le type de partenaire</option>
                                    <option value="hopital">Hôpital</option>
                                    <option value="clinique">Clinique</option>
                                    <option value="pharmacie">Pharmacie</option>
                                    <option value="laboratoire">Laboratoire d&apos;analyses médicales</option>
                                    <option value="opticien">Opticien</option>
                                    <option value="dentaire">Cabinet dentaire</option>
                                    <option value="autre">Autre</option>

                                </select>
                                @error('type')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Adresse -->
                            <div>
                                <label for="adresse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                                <input type="text" name="adresse" id="adresse" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez une adresse" required>
                                @error('adresse')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Lien Google Maps -->
                            <div>
                                <label for="geolocalisation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lien Google Maps</label>
                                <input type="url" name="geolocalisation" id="geolocalisation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez un lien Google Maps" required>
                                @error('geolocalisation')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Téléphone -->
                            <div>
                                <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                                <input type="tel" name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Numéro de téléphone" required>
                                @error('telephone')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Email -->
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Email du partenaire" required>
                                @error('email')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Région -->
                            <div>
                                <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Région</label>
                                <select name="region" id="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="" disabled selected>Sélectionnez une région</option>
                                </select>
                                @error('region')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <!-- Province -->
                            <div>
                                <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                                <select name="province" id="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="" disabled selected>Choisissez d&apos;abord votre région</option>
                                </select>
                                @error('province')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
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
                            <!-- Photo -->
                            <div class="col-span-2">
                                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo</label>
                                <input type="file" name="photo" id="photo" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @error('photo')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <div class="mt-4">
                                    <img id="preview" src="#" alt="Prévisualisation de l'image" class="hidden max-w-full h-auto border border-gray-300 rounded-lg">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mt-4"> --}}
                            {{-- Affiche le reCAPTCHA --}}
                            {{-- {!! NoCaptcha::display() !!} --}}
                        {{-- </div> --}}
                        
                        {{-- Charge le script JavaScript de reCAPTCHA --}}
                        {{-- {!! NoCaptcha::renderJs() !!} --}}
                        
                        <div class="flex justify-end">
                            <button type="submit" class="btn mt-5 ">
                                Ajouter partenaire
                            </button>

                        </div>
                    </form>
                </div>
            @endrole
        </div>
    </x-content-page-admin>
</x-app-layout>



