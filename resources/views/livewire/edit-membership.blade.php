<div>
    <form wire:submit.prevent="saveChanges">

        <!-- Informations de base -->
        <fieldset class=" border rounded-lg p-3">
            <legend>Références de l&apos;adhérent</legend>
            <div class="grid grid-cols-1 gap-4 mb-6">
                <div class="w-full md:col-span-3 flex items-center space-x-4">
                    <div class="w-full">
                        <label for="matricule" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Matricule</label>
                        <input type="text" wire:model="matricule" id="matricule" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Entrez le matricule">
                        @error('matricule')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
        
                    <div class="w-full">
                        <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                        <input type="text" wire:model="nip" id="nip" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Entrez le NIP">
                        @error('nip')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>
    
    
                <div class="w-full md:col-span-3 flex items-center space-x-4">
                    <div class="w-full">
                        <label for="cnib" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N° CNIB</label>
                        <input type="text" wire:model="cnib" id="cnib" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Entrez le numéro de CNIB">
                        @error('cnib')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
    
                    <div class="w-full">
                        <label for="delivree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de délivrance</label>
                        <input type="date" wire:model="delivree" id="delivree" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        @error('delivree')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
    
                    <div class="w-full">
                        <label for="expire" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date d&apos;expiration</label>
                        <input type="date" wire:model="expire" id="expire" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        @error('expire')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>
    
                <div class="w-full md:col-span-3 flex items-center space-x-4">
                    <div class="w-full">
                        <label for="adresse_permanente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse Permanente</label>
                        <input type="text" wire:model="adresse_permanente" id="adresse_permanente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Entrez l'adresse permanente">
                        @error('adresse_permanente')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
    
                    <div class="w-full">
                        <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                        <input type="text" wire:model="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Entrez le numéro de téléphone">
                        @error('telephone')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
    
                    <div class="w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" wire:model="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Entrez l'email">
                        @error('email')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>
    
            </div>
        </fieldset>
        <fieldset class="border rounded-lg p-3">
            <legend>État civil</legend>
            <div class="grid grid-cols-1 gap-4 mb-6">
                <!-- Grille pour Nom(s), Prénom(s), et Genre -->
                <div class="w-full md:col-span-3 flex items-center space-x-4">
                    <!-- Nom(s) -->
                    <div class="w-full">
                        <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom(s)</label>
                        <input wire:model="nom" id="nom" type="text" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                            placeholder="Entrez le nom">
                        @error('nom')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
        
                    <!-- Prénom(s) -->
                    <div class="w-full">
                        <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom(s)</label>
                        <input wire:model="prenom" id="prenom" type="text" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                            placeholder="Entrez le prénom">
                        @error('prenom')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
        
                    <!-- Genre (Radio buttons) -->
                    <div class="w-full">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre</label>
                        <div class="flex items-center mb-4">
                            <input wire:model="genre" id="masculin" type="radio" value="Masculin" class="mr-2">
                            <label for="masculin" class="mr-6">Masculin</label>
        
                            <input wire:model="genre" id="feminin" type="radio" value="Féminin" class="mr-2">
                            <label for="feminin">Féminin</label>
                        </div>
                        @error('genre')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>
        
                <!-- Lieu de naissance (sous forme de grille) -->
                <fieldset class="border-2 md:col-span-3 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                    <legend class="block text-gray-700 text-sm font-bold mb-2">Lieu de naissance</legend>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Département -->
                        <div>
                            <label for="departement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Département</label>
                            <input wire:model="departement" id="departement" type="text" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                placeholder="Entrez le département">
                            @error('departement')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                        </div>
        
                        <!-- Ville / Village -->
                        <div>
                            <label for="ville" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ville / Village</label>
                            <input wire:model="ville" id="ville" type="text" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                placeholder="Entrez la ville ou le village">
                            @error('ville')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                        </div>
        
                        <!-- Pays (Si hors Burkina) -->
                        <div>
                            <label for="pays" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pays</label>
                            <input wire:model="pays" id="pays" type="text" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                placeholder="Entrez le pays">
                            @error('pays')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </fieldset>
        
                <!-- Grille pour Nom et Prénom(s) du père et de la mère -->
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nom et Prénom(s) du père -->
                    <div>
                        <label for="nom_pere" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom et Prénom(s) du père</label>
                        <input wire:model="nom_pere" id="nom_pere" type="text" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                            placeholder="Entrez le nom du père">
                        @error('nom_pere')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
        
                    <!-- Nom et Prénom(s) de la mère -->
                    <div>
                        <label for="nom_mere" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom et Prénom(s) de la mère</label>
                        <input wire:model="nom_mere" id="nom_mere" type="text" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                            placeholder="Entrez le nom de la mère">
                        @error('nom_mere')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="border rounded-lg p-3">
            <legend>Informations personnelles</legend>
            <div class="grid grid-cols-1 gap-4 mb-6">
                <!-- Grille pour Nom(s), Prénom(s), et Genre -->
                <div class="w-full md:col-span-2 flex items-center space-x-4">
                    <div class="col-span-1">
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="photo">Photo</label>
                        <div class="w-full justify-center border rounded-md p-1 border-gray-500">
                            @if ($photo)
                                <img src="{{ asset('storage/' . $photo) }}" alt="Preview" class="w-48 h-48 object-cover mx-auto rounded-full">
                            @else
                                <img src="{{ asset('images/user-90.png') }}" alt="Default profile photo" class="w-36 h-36 object-cover mx-auto rounded-full">
                            @endif
                        </div>
                        <input type="file" wire:model="photo" id="photo" accept="image/*" class="my-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 
                            file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 
                            file:text-blue-700 hover:file:bg-violet-100"/>
            
                        @error('photo') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Situation matrimoniale -->
                    <div class="w-full row-span-3">
                        <label class="block text-gray-700 text-sm font-bold mb-1">Situation matrimoniale</label>
                        <div class="flex flex-wrap gap-3 items-center mb-4">
                            <label class="inline-flex items-center mt-2">
                                <input type="radio" wire:model="situation_matrimoniale" value="Célibataire" class="form-radio text-indigo-600">
                                <span class="ml-2">Célibataire</span>
                            </label>
                            <label class="inline-flex items-center mt-2">
                                <input type="radio" wire:model="situation_matrimoniale" value="Marié(e)" class="form-radio text-indigo-600">
                                <span class="ml-2">Marié(e)</span>
                            </label>
                            <label class="inline-flex items-center mt-2">
                                <input type="radio" wire:model="situation_matrimoniale" value="Divorcé(e)" class="form-radio text-indigo-600">
                                <span class="ml-2">Divorcé(e)</span>
                            </label>
                            <label class="inline-flex items-center mt-2">
                                <input type="radio" wire:model="situation_matrimoniale" value="Veuf(ve)" class="form-radio text-indigo-600">
                                <span class="ml-2">Veuf(ve)</span>
                            </label>
                        </div>
                        @error('situation_matrimoniale')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                        <!-- Personne à prévenir en cas de besoin -->
                        <fieldset class=" border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                            <legend class="block text-gray-700 text-sm font-bold mb-2">Personne à prévenir en cas de besoin</legend>
                            <div class="">
                                <label class="block text-gray-700 text-sm font-bold mb-1"
                                    for="nom_prenom_personne_besoin">Nom et prénoms (s)</label>
                                <input wire:model="nom_prenom_personne_besoin" id="nom_prenom_personne_besoin" type="text"
                                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                                @error('nom_prenom_personne_besoin')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-2 mt-2">

                                <!-- Lieu de résidence -->
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="lieu_residence">Lieu de
                                        résidence</label>
                                    <input wire:model="lieu_residence" id="lieu_residence" type="text"
                                        class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                                    @error('lieu_residence')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <!-- Téléphone -->
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-1"
                                        for="telephone_personne_prevenir">Téléphone</label>
                                    <input wire:model="telephone_personne_prevenir" id="telephone_personne_prevenir"
                                        type="text"
                                        class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                                    @error('telephone')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                       
                    </div>
            
                    
    
                   
                </div>
        
                
        
                <!-- Grille pour Nom et Prénom(s) du père et de la mère -->
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nom et Prénom(s) du père -->
                    <div>
                        <label for="nom_pere" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom et Prénom(s) du père</label>
                        <input wire:model="nom_pere" id="nom_pere" type="text" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                            placeholder="Entrez le nom du père">
                        @error('nom_pere')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
        
                    <!-- Nom et Prénom(s) de la mère -->
                    <div>
                        <label for="nom_mere" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom et Prénom(s) de la mère</label>
                        <input wire:model="nom_mere" id="nom_mere" type="text" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                            placeholder="Entrez le nom de la mère">
                        @error('nom_mere')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="border-2 border-gray-300 shadow-sm p-2 mt-4 mb-3 rounded-md bg-gray-100">
            <legend class="block text-gray-700 text-sm font-bold mb-2">Informations personnelles</legend>
            
           
        </fieldset>
        
        
        <div class="w-full">
            <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
            <input type="text" wire:model="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Entrez le nom">
            @error('nom')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>

        <div class="w-full">
            <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
            <input type="text" wire:model="prenom" id="prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Entrez le prénom">
            @error('prenom')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>

        <!-- Photo -->
        <div class="w-full">
            <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo</label>
            <input type="file" wire:model="photo" id="photo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            @error('photo')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>

        <!-- Nombre d'ayants droits -->
        <div class="w-full">
            <label for="nombreAyantsDroits" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre d'Ayants Droits</label>
            <select wire:model="nombreAyantsDroits" id="nombreAyantsDroits" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
            @error('nombreAyantsDroits')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>
        <div class="flex items-center justify-end">
            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Sauvegarder</button>
        </div>
    </form>
</div>
