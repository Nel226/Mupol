<x-guest-layout>
    <x-preloader/>

    
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
    <div id="app-layout" class="overflow-x-hidden flex">
        @include("components.navbar-guest-connected")
        <!-- app layout content -->
        <div 
            id="app-layout-content" 
            class="layout-guest min-h-screen w-full lg:pl-[5.625rem] transition-all duration-300 ease-out">
            
            @include("components.top-navbar-guest-connected")
            
            <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                <!-- title -->
                <h1 class="text-xl text-white">{{ $pageTitle }}</h1>
                
            </div>
            <div class="-mt-12 mx-6 mb-6 ">
                <div class="bg-gray-50 min-h-screen dark:bg-gray-800 rounded-lg shadow-lg p-2  mx-auto max-w-4xl">
                    <div class="mb-4 text-center">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Ajouter un ayant droit</h2>
                        
                    </div>
                    
                    <form action="{{ route('adherents.nouveau-ayantdroit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-2xl mx-auto p-4 bg-white shadow-md rounded-md">
                        @csrf
                        
                        <!-- Nom et Prénom -->
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div>
                                <label for="nom" class="block mb-1 text-sm font-medium text-gray-900">Nom</label>
                                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" 
                                class="bg-gray-50 border @error('nom') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" 
                                placeholder="Nom" required>
                                @error('nom')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="prenom" class="block mb-1 text-sm font-medium text-gray-900">Prénom</label>
                                <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" 
                                class="bg-gray-50 border @error('prenom') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" 
                                placeholder="Prénom" required>
                                @error('prenom')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Date de Naissance, Sexe, et Relation -->
                        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                            <div>
                                <label for="date_naissance" class="block mb-1 text-sm font-medium text-gray-900">Date de Naissance</label>
                                <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance') }}" 
                                class="bg-gray-50 border @error('date_naissance') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                                @error('date_naissance')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">Sexe</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="sexe" value="M" class="form-radio text-primary1" {{ old('sexe') == 'M' ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700">Masculin</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="sexe" value="F" class="form-radio text-primary1" {{ old('sexe') == 'F' ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700">Féminin</span>
                                    </label>
                                </div>
                                @error('sexe')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="relation" class="block mb-1 text-sm font-medium text-gray-900">Relation</label>
                                <select id="relation" name="relation" 
                                    class="bg-gray-50 border @error('relation') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                                    <option value="">-- Choisir --</option>
                                    <option value="Enfant" {{ old('relation') == 'Enfant' ? 'selected' : '' }}>Enfant</option>
                                    <option value="Conjoint" {{ old('relation') == 'Conjoint' ? 'selected' : '' }}>Conjoint(e)</option>
                                </select>
                                @error('relation')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Fichiers (Photo, Extrait, CNIB) -->
                        <div>
                            <label for="photo" class="block mb-1 text-sm font-medium text-gray-900">Photo</label>
                            <input type="file" name="photo" id="photo" accept="image/*" 
                            class="bg-gray-50 border @error('photo') border-red-500 @else border-gray-300 @enderror text-sm rounded-lg block w-full p-2.5">
                            @error('photo')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="extrait" class="block mb-1 text-sm font-medium text-gray-900">Extrait de naissance (PDF)</label>
                            <input type="file" name="extrait" id="extrait" accept="application/pdf" 
                            class="bg-gray-50 border @error('extrait') border-red-500 @else border-gray-300 @enderror text-sm rounded-lg block w-full p-2.5">
                            @error('extrait')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div id="cnib-field" style="display: none;">
                            <label for="cnib" class="block mb-1 text-sm font-medium text-gray-900">CNIB (PDF)</label>
                            <input type="file" name="cnib" id="cnib" accept="application/pdf" 
                            class="bg-gray-50 border @error('cnib') border-red-500 @else border-gray-300 @enderror text-sm rounded-lg block w-full p-2.5">
                            @error('cnib')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Bouton -->
                        <div class="text-center">
                            <button type="submit" 
                                class="btn bg-indigo-600  hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                                Ajouter ayant droit
                            </button>
                        </div>
                    </form>
                
                
                    <!-- JavaScript -->
                    <script>
                        const relationField = document.getElementById('relation');
                        const cnibField = document.getElementById('cnib-field');
                        
                        relationField.addEventListener('change', () => {
                            if (relationField.value === 'Conjoint' || relationField.value === 'Conjoint') {
                                cnibField.style.display = 'block';
                            } else {
                                cnibField.style.display = 'none';
                            }
                        });
                    </script>
                    
                </div>
                @include("components.footer-guest-connected")
        
            </div>

        </div>

    </div>
</x-guest-layout>


