<div class="w-[90%] md:w-3/4 lg:w-2/3 mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5 text-center">Formulaire d'adhésion</h1>

    <!-- Steper -->
    <div class="flex justify-between items-center mb-6">
        @for ($step = 1; $step <= $totalSteps; $step++)
            <div class="flex flex-col items-center">
                
                <div class="flex w-24">

                    <div class="w-10 h-10 flex items-center justify-center {{ $currentStep >= $step ? 'bg-blue-500' : 'bg-gray-300' }} rounded-full text-white">
                        {{ $step }}
                    </div>

                    @if ($step < $totalSteps)
                        <div class="flex-1 h-10 flex items-center">
                            <div class="h-1 w-full {{ $currentStep >= $step ? 'bg-blue-500' : 'bg-gray-300' }}"></div>
                        </div>
                    @endif
                </div>
                <div class="text-sm mt-2">
                    @if ($step == 1)
                        Références de l'adhérent
                    @elseif ($step == 2)
                        Etat civil
                    @elseif ($step == 3)
                        Informations personnelles
                    @elseif ($step == 4)
                        Formations professionnelles
                    @endif
                </div>
            </div>
            
        @endfor
    </div>

    <!-- Contenu des étapes -->
    <div class="bg-gray-200 shadow-md rounded px-8 pt-6 pb-8 mb-4">
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
        </h2>

        <!-- Étape 1 -->
        @if ($currentStep == 1)
            <div>
                <!-- Grille pour Matricule et NIP -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                    <!-- Matricule -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">Matricule</label>
                        <input wire:model="matricule" id="matricule" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('matricule')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- NIP -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nip">NIP</label>
                        <input wire:model="nip" id="nip" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('nip')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <!-- Grille pour N° CNIB, Délivré le, et Expire le -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">

                    <!-- N° CNIB -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="cnib">N° CNIB</label>
                        <input wire:model="cnib" id="cnib" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('cnib')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Délivré le -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="delivree">Délivré le</label>
                        <input wire:model="delivree" id="delivree" type="date"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('delivree')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Expire le -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="expire">Expire le</label>
                        <input wire:model="expire" id="expire" type="date"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('expire')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <!-- Grille pour Adresse permanente et Téléphone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">

                    <!-- Adresse permanente -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="adresse">Adresse
                            permanente</label>
                        <input wire:model="adresse" id="adresse" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('adresse')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">Téléphone</label>
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
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">Nom(s)</label>
                        <input wire:model="nom" id="nom" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('nom')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Prénom(s) -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="prenom">Prénom(s)</label>
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
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="departement">Département</label>
                        <input wire:model="departement" id="departement" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('departement')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Ville / Village -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="ville">Ville /
                            Village</label>
                        <input wire:model="ville" id="ville" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('ville')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Pays (Si hors Burkina) -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="pays">Pays (Si vous êtes
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
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nom_pere">Nom et Prénom(s) du
                            père</label>
                        <input wire:model="nom_pere" id="nom_pere" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                        @error('nom_pere')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nom et Prénom(s) de la mère -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nom_mere">Nom et Prénom(s) de
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
                <div class="mt-4">
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
                </div>

                <!-- Personne à prévenir en cas de besoin -->
                <div class="mt-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2"
                        for="nom_prenom_personne_besoin">Personne à prévenir en cas de besoin</label>
                    <input wire:model="nom_prenom_personne_besoin" id="nom_prenom_personne_besoin" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                    @error('nom_prenom_personne_besoin')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Lieu de résidence et Téléphone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <!-- Lieu de résidence -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="lieu_residence">Lieu de
                            résidence</label>
                        <input wire:model="lieu_residence" id="lieu_residence" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('lieu_residence')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone_personne_prevenir">Téléphone</label>
                        <input wire:model="telephone_personne_prevenir" id="telephone_personne_prevenir" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('telephone')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            
                <div class="mt-4 overflow-x-auto">
                    <select id="nombreAyantsDroits" onchange="toggleAyantsDroits()" class="border rounded w-full sm:w-1/2 py-1">
                        <option value="" selected>Choisissez un nombre</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                
                    <div id="ayantsDroitsContainer" class="mt-4"></div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        function toggleAyantsDroits() {
                            const select = document.getElementById('nombreAyantsDroits');
                            const container = document.getElementById('ayantsDroitsContainer');
                            const nombre = parseInt(select.value);
                        
                            // Réinitialiser le contenu du conteneur
                            container.innerHTML = '';
                        
                            if (nombre > 0) {
                                // Afficher le conteneur
                                container.style.display = 'block';
                        
                                // Créer les champs pour chaque ayant droit
                                for (let i = 0; i < nombre; i++) {
                                    const div = document.createElement('div');
                                    div.classList.add('border', 'p-4', 'rounded', 'mb-4', 'shadow', 'mt-4');
                        
                                    div.innerHTML = `
                                        <h3 class="font-bold mb-2">Ayant Droit ${i + 1}</h3>
                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                            <div class="mt-2">
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Nom</label>
                                                <input type="text" name="ayantsDroits[${i}][nom]" class="border rounded w-full py-1">
                                            </div>
                                            <div class="mt-2">
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Prénom(s)</label>
                                                <input type="text" name="ayantsDroits[${i}][prenom]" class="border rounded w-full py-1">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                            <div class="mt-2">
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Genre</label>
                                                <select name="ayantsDroits[${i}][sexe]" class="border rounded w-full py-1">
                                                    <option value="" disabled>Sélectionner</option>
                                                    <option value="H">Homme</option>
                                                    <option value="F">Femme</option>
                                                </select>
                                            </div>
                                            <div class="mt-2">
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Date de Naissance</label>
                                                <input type="date" name="ayantsDroits[${i}][date_naissance]" class="border rounded w-full py-1">
                                            </div>
                                            <div class="mt-2">
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Lien de Parenté</label>
                                                <input type="text" name="ayantsDroits[${i}][lien_parenté]" class="border rounded w-full py-1">
                                            </div>
                                        </div>
                                    `;
                        
                                    // Ajouter le div au conteneur
                                    container.appendChild(div);
                                }
                            } else {
                                // Masquer le conteneur si le nombre est 0
                                container.style.display = 'none';
                            }
                        }
                
                        // Attacher la fonction au changement de sélection
                        document.getElementById('nombreAyantsDroits').addEventListener('change', toggleAyantsDroits);
                    });
                </script>
                
               
                    
        
            </div>
        @endif

        <!-- Étape 4 -->
        @if ($currentStep == 4)
            <div>
                <!-- -->
                <label class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                    
                    <div class="">
                    
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model="statut" value="personnel_retraite"
                                class="form-radio text-indigo-600">
                            <span class="ml-2">Personnel retraité</span>
                        </label>
                    </div>
                    <div>

                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model="statut" value="personnel_active"
                                class="form-radio text-indigo-600">
                            <span class="ml-2">Personnel en activité</span>
                        </label>
                    </div>
                        
                        @error('situation_matrimoniale')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Champs pour Personnel Retraité -->
                @if ($statut === 'personnel_retraite')
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1">Grade</label>
                            <input type="text" wire:model="grade" class="border rounded w-full py-1">
                        </div>
                    
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1">Départ à la retraite</label>
                            <input type="date" wire:model="departARetraite" class="border rounded w-full py-1">
                        </div>
                    
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1">Numéro CARFO</label>
                            <input type="text" wire:model="numeroCARFO" class="border rounded w-full py-1">
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
                            </div>
                        
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Date d'intégration</label>
                                <input type="date" wire:model="dateIntegration" class="border rounded w-full py-1">
                            </div>
                        
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Date de départ à la retraite</label>
                                <input type="date" wire:model="dateDepartARetraite" class="border rounded w-full py-1">
                            </div>
                        </div>
                        

                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Direction</label>
                                <input type="text" wire:model="direction" class="border rounded w-full py-1">
                            </div>
                        
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Service</label>
                                <input type="text" wire:model="service" class="border rounded w-full py-1">
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
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
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
