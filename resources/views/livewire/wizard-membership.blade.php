<div class="w-[90%] md:w-5/6 lg:w-5/6 mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5 text-center">Formulaire d&apos;adhésion</h1>

    <!-- Stepper -->
    <div class="flex justify-between items-center mb-6">
        @for ($step = 1; $step <= $totalSteps; $step++)
            <div class="flex flex-col items-center flex-1"> <!-- Each step takes equal width -->
                <div class="relative flex items-center w-full">
                    <!-- Step Circle -->
                    <div
                        class="w-10 h-10 flex items-center justify-center {{ $currentStep >= $step ? 'bg-[#4000FF]' : 'bg-gray-300' }} rounded-full text-white z-10">
                        @if ($currentStep > $step)
                            <i class="fa fa-check"></i> <!-- Display check icon for completed steps -->
                        @else
                            {{ $step }} <!-- Show step number for incomplete steps -->
                        @endif
                    </div>

                    <!-- Connecting Line -->
                    @if ($step < $totalSteps)
                        <div class="flex-1 h-1 {{ $currentStep > $step ? 'bg-[#4000FF]' : 'bg-gray-300' }}"
                            style="height: 4px; margin-left: -1rem;"></div>
                    @endif
                </div>

                <!-- Step Label -->
                <div class="text-sm mt-2 text-center w-full"> <!-- Changed text-left to text-center -->
                    @if ($step == 1)
                        Références de l'adhérent
                    @elseif ($step == 2)
                        Etat civil
                    @elseif ($step == 3)
                        Informations personnelles
                    @elseif ($step == 4)
                        Formations professionnelles
                    @elseif ($step == 5)
                        Récapitulatif
                    @endif
                </div>
            </div>
        @endfor
    </div>

    <!-- Contenu des étapes -->
    <div class="bg-gray-200 shadow-md overflow-y-auto max-h-[500px] rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold mb-5 text-center">
            @if ($currentStep == 1)
                REFERENCES DE L'ADHERENT
            @endif
            @if ($currentStep == 2)
                ETAT CIVIL
            @endif
            @if ($currentStep == 3)
                INFORMATIONS PERSONNELLES
            @endif
            @if ($currentStep == 4)
                FORMATIONS PROFESSIONELLES
            @endif
            @if ($currentStep == 5)
                RECAPITULATIF
            @endif
        </h2>

        <!-- Étape 1 -->
        @if ($currentStep == 1)
            <div>
                <!-- Grille pour Matricule et NIP -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">

                    <!-- Matricule -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="matricule">Matricule</label>
                        <input wire:model="matricule" id="matricule" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('matricule')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- NIP -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="nip">NIP</label>
                        <input wire:model="nip" id="nip" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('nip')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <!-- Grille pour N° CNIB, Délivré le, et Expire le -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">

                    <!-- N° CNIB -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="cnib">N° CNIB</label>
                        <input wire:model="cnib" id="cnib" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('cnib')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Délivré le -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="delivree">Délivré le</label>
                        <input wire:model="delivree" id="delivree" type="date"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            wire:change="updateExpire">
                        @error('delivree')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Expire le -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="expire">Expire le</label>
                        <input wire:model="expire" id="expire" type="date"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            readonly>
                        @error('expire')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                


                <!-- Grille pour Adresse permanente et Téléphone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4 mt-2">

                    <!-- Adresse permanente -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="adresse_permanente">Adresse
                            permanente</label>
                        <input wire:model="adresse_permanente" id="adresse_permanente" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('adresse_permanente')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="telephone">Téléphone</label>
                        <input wire:model="telephone" id="telephone" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('telephone')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

            </div>
        @endif

        <!-- Étape 2 -->
        @if ($currentStep == 2)
            <div>
                <!-- Grille pour Nom(s), Prénom(s), et Genre -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                    <!-- Nom(s) -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="nom">Nom(s)</label>
                        <input wire:model="nom" id="nom" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('nom')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Prénom(s) -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="prenom">Prénom(s)</label>
                        <input wire:model="prenom" id="prenom" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('prenom')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Genre (Radio buttons) -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Genre</label>
                        <div class="flex items-center mb-4">
                            <input wire:model="genre" id="masculin" type="radio" value="Masculin" class="mr-2">
                            <label for="masculin" class="mr-6">Masculin</label>

                            <input wire:model="genre" id="feminin" type="radio" value="Féminin" class="mr-2">
                            <label for="feminin">Féminin</label>
                        </div>
                        @error('genre')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <!-- Lieu de naissance (sous forme de grille) -->
                <label class="block text-gray-700 text-sm font-bold mb-2">Lieu de naissance</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Département -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="departement">Département</label>
                        <input wire:model="departement" id="departement" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('departement')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Ville / Village -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="ville">Ville /
                            Village</label>
                        <input wire:model="ville" id="ville" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('ville')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Pays (Si hors Burkina) -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="pays">Pays (Si vous êtes
                            né(e) hors du Burkina)</label>
                        <input wire:model="pays" id="pays" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('pays')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Grille pour Nom et Prénom(s) du père et de la mère -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                    <!-- Nom et Prénom(s) du père -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_pere">Nom et Prénom(s) du
                            père</label>
                        <input wire:model="nom_pere" id="nom_pere" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('nom_pere')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nom et Prénom(s) de la mère -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_mere">Nom et Prénom(s) de
                            la mère</label>
                        <input wire:model="nom_mere" id="nom_mere" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('nom_mere')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

            </div>
        @endif

        <!-- Étape 3 -->
        @if ($currentStep == 3)
            <div>
                <!-- Situation matrimoniale -->
                <div class="mt-4 grid grid-cols-3 gap-4">
                    <div class=" col-span-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Situation matrimoniale</label>
                        <div class="flex flex-wrap gap-3 items-center">
                            <label class="inline-flex items-center mt-2">
                                <input type="radio" wire:model="situation_matrimoniale" value="Célibataire"
                                    class="form-radio text-indigo-600">
                                <span class="ml-2">Célibataire</span>
                            </label>
                            <label class="inline-flex items-center mt-2">
                                <input type="radio" wire:model="situation_matrimoniale" value="Marié(e)"
                                    class="form-radio text-indigo-600">
                                <span class="ml-2">Marié(e)</span>
                            </label>
                            <label class="inline-flex items-center mt-2">
                                <input type="radio" wire:model="situation_matrimoniale" value="Divorcé(e)"
                                    class="form-radio text-indigo-600">
                                <span class="ml-2">Divorcé(e)</span>
                            </label>
                            <label class="inline-flex items-center mt-2">
                                <input type="radio" wire:model="situation_matrimoniale" value="Veuf(ve)"
                                    class="form-radio text-indigo-600">
                                <span class="ml-2">Veuf(ve)</span>
                            </label>
                        </div>
                        @error('situation_matrimoniale')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror

                        <!-- Personne à prévenir en cas de besoin -->
                        <div class="mt-2">
                            <label class="block text-gray-700 text-sm font-bold mb-1"
                                for="nom_prenom_personne_besoin">Personne à prévenir en cas de besoin</label>
                            <input wire:model="nom_prenom_personne_besoin" id="nom_prenom_personne_besoin" type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ">
                            @error('nom_prenom_personne_besoin')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-2">

                            <!-- Lieu de résidence -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1" for="lieu_residence">Lieu de
                                    résidence</label>
                                <input wire:model="lieu_residence" id="lieu_residence" type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('telephone')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="col-span-1 ">
                        <div class="w-full justify-center border rounded-md p-1 border-gray-500 row-span-3">
                            <!-- Prévisualisation de l'image -->
                            @livewire('image-upload')
                        </div>
                        
                    </div>

                    <div class="overflow-x-auto ">
                        <label class="block text-gray-700 text-sm font-bold mb-1"
                            for="changeNombreAyantsDroits">Nombre d&apos;ayants-droits</label>
                        <select class="border rounded w-full py-1"
                            wire:click="changeNombreAyantsDroits($event.target.value)">
                            <option value="" selected>Choisissez un nombre</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>

                    </div>
                        <div class="col-span-3">
                            @if ($nombreAyantsDroits > 0)
                            <!-- Affiche les champs uniquement si le nombre est supérieur à 0 -->
                            @for ($i = 0; $i < $nombreAyantsDroits; $i++)
                                <div class="border bg-gray-100 p-4 rounded mb-2 col-span-3 shadow-lg mt-2">
                                    <h3 class="font-bold mb-2">Ayant Droit {{ $i + 1 }}</h3>
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 ">
                                        <div class="mt-2">
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Nom</label>
                                            <input type="text" wire:model="ayantsDroits.{{ $i }}.nom"
                                                class="border rounded w-full py-1">
                                        </div>
                                        <div class="mt-2">
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Prénom(s)</label>
                                            <input type="text"
                                                wire:model="ayantsDroits.{{ $i }}.prenom"
                                                class="border rounded w-full py-1">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3 ">
                                        <div class="mt-2">
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Genre</label>
                                            <select wire:model="ayantsDroits.{{ $i }}.sexe"
                                                class="border rounded w-full py-1">
                                                <option value="" disabled selected>Sélectionner</option>
                                                <option value="H">Homme</option>
                                                <option value="F">Femme</option>
                                            </select>
                                        </div>
                                        <div class="mt-2">
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Date de
                                                Naissance</label>
                                            <input type="date"
                                                wire:model="ayantsDroits.{{ $i }}.date_naissance"
                                                class="border rounded w-full py-1">
                                        </div>
                                        <div class="mt-2">
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Lien de
                                                Parenté</label>
                                            <input type="text"
                                                wire:model="ayantsDroits.{{ $i }}.lien_parenté"
                                                class="border rounded w-full py-1">
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
        @endif

        <!-- Étape 4 -->
        @if ($currentStep == 4)
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                    <div>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:click="changeStatut('personnel_retraite')"
                                class="form-radio text-indigo-600">
                            <span class="ml-2">Personnel retraité</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:click="changeStatut('personnel_active')"
                                class="form-radio text-indigo-600">
                            <span class="ml-2">Personnel en activité</span>
                        </label>
                    </div>
                </div>

                <!-- Champs pour Personnel Retraité -->
                @if ($statut === 'personnel_retraite')
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1">Grade</label>
                            <input type="text" wire:model="grade" class="border rounded w-full py-1">
                            @error('grade')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1">Départ à la retraite</label>
                            <input type="date" wire:model="departARetraite" class="border rounded w-full py-1">
                            @error('departARetraite')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1">Numéro CARFO</label>
                            <input type="text" wire:model="numeroCARFO" class="border rounded w-full py-1">
                            @error('numeroCARFO')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                <!-- Champs pour Personnel en Activité -->
                @if ($statut === 'personnel_active')
                    <div class="mt-4">
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Grade</label>
                                <input type="text" wire:model="grade" class="border rounded w-full py-1">
                                @error('grade')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Date d'intégration</label>
                                <input type="date" wire:model="dateIntegration"
                                    class="border rounded w-full py-1">
                                @error('dateIntegration')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Date de départ à la
                                    retraite</label>
                                <input type="date" wire:model="dateDepartARetraite"
                                    class="border rounded w-full py-1">
                                @error('dateDepartARetraite')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Direction</label>
                                <input type="text" wire:model="direction" class="border rounded w-full py-1">
                                @error('direction')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Service</label>
                                <input type="text" wire:model="service" class="border rounded w-full py-1">
                                @error('service')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        



        <!-- Boutons de navigation -->
        <div class="flex justify-between mt-5">
            @if ($currentStep > 1)
                <button wire:click="previousStep"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Précédent
                </button>
            @else
                <div></div> <!-- Un div vide pour garder le bouton "Suivant" aligné à droite -->
            @endif

            <!-- Bouton "Suivant" ou "Soumettre", toujours aligné à droite -->
            @if ($currentStep < $totalSteps)
                <button wire:click="nextStep"
                    class="bg-[#4000FF] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Suivant
                </button>
            @else
                <button wire:click="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Soumettre
                </button>
            @endif
        </div>

        <!-- Message de succès -->
        @if (session()->has('message'))
            <div class="mt-5 p-4 bg-green-200 text-green-800 rounded">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
