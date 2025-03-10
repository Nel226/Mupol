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
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier le partenaire de santé</h2>
                    
                    <form method="POST" action="{{ route('partenaires.update', $partenaire->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        
                        <div class="grid gap-3 sm:grid-cols-2 sm:gap-6">
                            

                            <!-- Nom du partenaire de santé -->
                            <div class="w-full">
                                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nom du partenaire de santé" value="{{ old('nom', $partenaire->nom) }}" required>
                                @error('nom')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type du partenaire de santé -->
                            <div class="w-full">
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="hopital" {{ old('type', $partenaire->type) == 'hopital' ? 'selected' : '' }}>Hôpital</option>
                                    <option value="clinique" {{ old('type', $partenaire->type) == 'clinique' ? 'selected' : '' }}>Clinique</option>
                                    <option value="pharmacie" {{ old('type', $partenaire->type) == 'pharmacie' ? 'selected' : '' }}>Pharmacie</option>

                                </select>
                                @error('type')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Adresse -->
                            <div class="w-full">
                                <label for="adresse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                                <input type="text" name="adresse" id="adresse" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Adresse" value="{{ old('adresse', $partenaire->adresse) }}" required>

                                @error('adresse')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div class="w-full">
                                <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                                <input type="text" name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Numéro de téléphone" value="{{ old('telephone', $partenaire->telephone) }}" required>
                                @error('telephone')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- Région -->
                            <div class="w-full">
                                <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Région</label>
                                <select name="region" id="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="{{ $partenaire->region }}" {{ old('region') == $partenaire->region ? 'selected' : '' }}>{{ $partenaire->region }}</option>
                                </select>
                                @error('region')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Province -->
                            <div class="w-full">
                                <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                                <select name="province" id="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="{{ $partenaire->province }}" {{ old('province') == $partenaire->province ? 'selected' : '' }}>{{ $partenaire->province }}</option>                                </select>
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
                            
                            
                        </div>
                        <div class="flex justify-end">
                            <x-primary-button type="submit" class="mt-5 ">
                                Valider
                            </x-primary-button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-content-page>
</x-app-layout>
