<div id="wizardMembership" class="w-full max-h-full ">
    <!-- Step Label -->
    <div class="text-sm mt-2 text-center w-full">
        <span class="step-label font-bold">Références</span> <!-- Label par défaut pour la première étape -->
    </div>
    <!-- Stepper Navigation -->
    
    <div class="w-full flex justify-center mx-auto">
        <ol class="grid grid-cols-5 text-xs text-gray-900 font-medium sm:text-base mb-2">
            <li class="step-item flex w-full relative text-indigo-600 after:content-[''] after:w-full after:h-0.5 after:inline-block after:absolute lg:after:top-5 after:top-3 after:left-1/2">
                <div class="block text-xs w-full whitespace-normal break-words text-center z-10">
                    <span class="step-number w-6 h-6 bg-[#8495CD] border-2 border-transparent rounded-full flex justify-center items-center mx-auto mb-3 text-sm text-white lg:w-10 lg:h-10">1</span>
                    Références
                </div>
            </li>
            <li class="step-item flex w-full relative before:content-[''] before:w-full before:h-0.5 before:bg-gray-200 before:absolute before:right-1/2 lg:before:top-5 before:top-3 after:content-[''] after:w-full after:h-0.5 after:bg-gray-200 after:absolute after:left-1/2 lg:after:top-5 after:top-3">
                <div class="block text-xs w-full whitespace-normal break-words text-center z-10">
                    <span class="step-number w-6 h-6 bg-gray-50 border border-gray-200 text-indigo-600 rounded-full flex justify-center items-center mx-auto mb-3 lg:w-10 lg:h-10">2</span>
                    État civil
                </div>
            </li>
            <li class="step-item flex w-full relative before:content-[''] before:w-full before:h-0.5 before:bg-gray-200 before:absolute before:right-1/2 lg:before:top-5 before:top-3 after:content-[''] after:w-full after:h-0.5 after:bg-gray-200 after:absolute after:left-1/2 lg:after:top-5 after:top-3">
                <div class="block text-xs w-full whitespace-normal break-words text-center z-10">
                    <span class="step-number w-6 h-6 bg-gray-50 border border-gray-200 text-indigo-600 rounded-full flex justify-center items-center mx-auto mb-3 lg:w-10 lg:h-10">3</span>
                    Informations personnelles
                </div>
            </li>
            <li class="step-item flex w-full relative before:content-[''] before:w-full before:h-0.5 before:bg-gray-200 before:absolute before:right-1/2 lg:before:top-5 before:top-3 after:content-[''] after:w-full after:h-0.5 after:bg-gray-200 after:absolute after:left-1/2 lg:after:top-5 after:top-3">
                <div class="block text-xs w-full whitespace-normal break-words text-center z-10">
                    <span class="step-number w-6 h-6 bg-gray-50 border border-gray-200 text-indigo-600 rounded-full flex justify-center items-center mx-auto mb-3 lg:w-10 lg:h-10">4</span>
                    Informations professionnelles
                </div>
            </li>
            <li class="step-item flex w-full relative text-gray-900 before:content-[''] before:w-full before:h-0.5 before:bg-gray-200 before:absolute lg:before:top-5 before:top-3 before:right-1/2">
                <div class="block text-xs w-full whitespace-normal break-words text-center z-10">
                    <span class="step-number w-6 h-6 bg-gray-50 border-2 border-gray-200 rounded-full flex justify-center items-center mx-auto mb-3 text-sm lg:w-10 lg:h-10">5</span>
                    Récapitulatif
                </div>
            </li>
        </ol>
        
        
    </div>
    

   
    <!-- Form Steps -->
    <form id="membershipForm" action="{{ route('recapitulatif-form') }}" method="POST" class="  p-3 space-y-4">
        @csrf

        <!-- Step 1 -->
        <div class="step" id="step-1" >
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="matricule" class="block text-sm font-medium text-gray-700">Matricule</label>
                    <input type="text" name="matricule" id="matricule" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex : 12345678" required>
                    @error('matricule')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            
                <div class="mb-4">
                    <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                    <input type="text" name="nip" id="nip" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex : 1234" required>
                    @error('nip')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            
                <div class="mb-4 col-span-1 md:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="cnib" class="block text-sm font-medium text-gray-700">CNIB</label>
                            <input type="text" name="cnib" id="cnib" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex : 123456789" required>
                            @error('cnib')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
            
                        <div>
                            <label for="delivree" class="block text-sm font-medium text-gray-700">Délivrée</label>
                            <input type="date" name="delivree" id="delivree" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            @error('delivree')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
            
                        <div>
                            <label for="expire" class="block text-sm font-medium text-gray-700">Expire</label>
                            <input type="date" name="expire" id="expire" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            @error('expire')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-span-1 md:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="adresse_permenante" class="block text-sm font-medium text-gray-700">Adresse permenante</label>
                            <input type="text" name="adresse_permenante" id="adresse_permenante" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex : 123456789" required>
                            @error('adresse_permenante')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
            
                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700">Telephone</label>
                            <input type="date" name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            @error('telephone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
            
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="expire" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end mt-4">
                
                <button type="button" class="mt-2 bg-[#8495CD]  text-white px-4 py-2 rounded" onclick="nextStep(1)">Suivant</button>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="step" id="step-2" style="display: none">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom(s)</label>
                    <input type="text" name="nom" id="nom" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                        placeholder="Ex : Dupont" required>
                    @error('nom')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom(s)</label>
                    <input type="text" name="prenom" id="prenom" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                        placeholder="Ex : Jean" required>
                    @error('prenom')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4 col-span-1 md:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="departement" class="block text-sm font-medium text-gray-700 min-h-[40px]">Département</label>
                            <input type="text" name="departement" id="departement" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                placeholder="Ex : Kadiogo" required>
                            @error('departement')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div>
                            <label for="ville" class="block text-sm font-medium text-gray-700 min-h-[40px]">Ville / Village</label>
                            <input type="text" name="ville" id="ville" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                placeholder="Ex : Ouagadougou" required>
                            @error('ville')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div>
                            <label for="pays" class="block text-sm font-medium text-gray-700 min-h-[40px]">Pays (Si vous êtes né(e) hors du Burkina)</label>
                            <input type="text" name="pays" id="pays" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                placeholder="Ex : Côte d'Ivoire">
                            @error('pays')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                </div>
        
                <div class="mb-4 col-span-1 md:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nom_pere" class="block text-sm font-medium text-gray-700">Nom et Prénom(s) du père</label>
                            <input type="text" name="nom_pere" id="nom_pere" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                placeholder="Ex : Dupont" required>
                            @error('nom_pere')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <div>
                            <label for="nom_mere" class="block text-sm font-medium text-gray-700">Nom et Prénom(s) de la mère</label>
                            <input type="text" name="nom_mere" id="nom_mere" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                placeholder="Ex : Martin" required>
                            @error('nom_mere')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-4">
                
                <button type="button" class="mt-2 bg-gray-300 text-gray-700 px-4 py-2 rounded" onclick="prevStep(2)">Précédent</button>
    
                <button type="button" class="mt-2 bg-[#8495CD] text-white px-4 py-2 rounded" onclick="nextStep(2)">Suivant</button>
            </div>
        </div>
        
       
        

        <!-- Step 3 -->
        <div class="step" id="step-3" style="display: none">
            
            <!-- Informations personne à prévenir et photo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="mb-4">
                    <label for="situation_matrimoniale" class="block text-sm font-medium text-gray-700">Situation matrimoniale</label>
                    <div class="flex flex-wrap gap-3 items-center">
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" name="situation_matrimoniale" value="Célibataire" class="form-radio text-indigo-600">
                            <span class="ml-2 text-xs">Célibataire</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" name="situation_matrimoniale" value="Marié(e)" class="form-radio text-indigo-600">
                            <span class="ml-2 text-xs">Marié(e)</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" name="situation_matrimoniale" value="Divorcé(e)" class="form-radio text-indigo-600">
                            <span class="ml-2 text-xs">Divorcé(e)</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" name="situation_matrimoniale" value="Veuf(ve)" class="form-radio text-indigo-600">
                            <span class="ml-2 text-xs">Veuf(ve)</span>
                        </label>
                    </div>
                </div>
               
                <div class="w-full row-span-2">
                    <div class="shrink-0">
                        <img id="preview_img" class="mx-auto object-cover w-36 h-36 rounded-full" src="{{ asset('images/user-90.png') }}" alt="Current profile photo" />
                    </div>
                    <input type="file" id="photo" name="photo" onchange="loadFile(event)" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-2 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-violet-100" />
                </div>
                <div>
                    <label for="nom_prenom_personne_besoin" class="block text-sm font-medium text-gray-700">Personne à prévenir en cas de besoin</label>
                    <input id="nom_prenom_personne_besoin" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Ex : Jean Dupont">
                </div>
            </div>
        
            <!-- Lieu de résidence et téléphone -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="lieu_residence" class="block text-sm font-medium text-gray-700">Lieu de résidence</label>
                    <input id="lieu_residence" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Ex : Ouagadougou">
                </div>
                <div>
                    <label for="telephone_personne_prevenir" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input id="telephone_personne_prevenir" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Ex : +226 70 00 00 00">
                </div>
            </div>
        
            <!-- Nombre ayants-droits -->
            <div class="mb-4">
                <label for="nombreAyantsDroits" class="block text-sm font-medium text-gray-700">Nombre d'ayants-droits</label>
                <select id="nombreAyantsDroits" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
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
        
            <!-- Conteneur pour les ayants-droits -->
            <div id="ayantsDroitsContainer"></div>
            <div class="flex justify-between mt-4">
                
                <button type="button" class="mt-2 bg-gray-300 text-gray-700 px-4 py-2 rounded" onclick="prevStep(3)">Précédent</button>
    
                <button type="button" class="mt-2 bg-[#8495CD] text-white px-4 py-2 rounded" onclick="nextStep(3)">Suivant</button>
            </div>
        </div>
        
        
        <script>
            var loadFile = function(event) {
                var output = document.getElementById('preview_img');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src); // Free up memory
                }
            };
        </script>
        

        <script>
            // Récupère le select et le conteneur des ayants-droits
            const selectAyantsDroits = document.getElementById('nombreAyantsDroits');
            const ayantsDroitsContainer = document.getElementById('ayantsDroitsContainer');

            // Fonction qui génère les divs en fonction du nombre d'ayants-droits sélectionné
            selectAyantsDroits.addEventListener('change', function () {
                // Vide le conteneur des ayants-droits
                ayantsDroitsContainer.innerHTML = '';

                // Récupère le nombre d'ayants-droits sélectionné
                const nombreAyantsDroits = parseInt(this.value);

                // Si aucun nombre n'est sélectionné ou que c'est 0, on ne fait rien
                if (isNaN(nombreAyantsDroits) || nombreAyantsDroits === 0) {
                    return;
                }

                // Pour chaque ayant-droit, crée un formulaire
                for (let i = 1; i <= nombreAyantsDroits; i++) {
                    const ayantDroitDiv = document.createElement('div');
                    ayantDroitDiv.classList.add('border', 'p-4', 'rounded-lg', 'mb-4', 'bg-gray-50', 'mt-4', 'shadow');

                    ayantDroitDiv.innerHTML = `
                        <h3 class="font-bold mb-2">Ayant Droit ${i}</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Nom de l'ayant-droit">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Prénom(s)</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Prénom(s) de l'ayant-droit">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Genre</label>
                                <select class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    <option value="" disabled>Sélectionner</option>
                                    <option value="H">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date de Naissance</label>
                                <input type="date" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Lien de Parenté</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Lien de parenté">
                            </div>
                        </div>
                    `;

                    // Ajoute la div au conteneur
                    ayantsDroitsContainer.appendChild(ayantDroitDiv);
                }
            });
        </script>

        

        <!-- Step 4 -->
        <div class="step" id="step-4" style="display: none;">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                <!-- Statut Section -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Statut</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="inline-flex items-center mt-2">
                                <input type="radio" name="statut" value="personnel_retraite" class="form-radio text-indigo-600">
                                <span class="ml-2 text-xs">Personnel retraité</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center mt-2">
                                <input type="radio" name="statut" value="personnel_active" class="form-radio text-indigo-600">
                                <span class="ml-2 text-xs">Personnel en activité</span>
                            </label>
                        </div>
                    </div>
                </div>
        
                <!-- Fields for Retired Personnel -->
                <div id="personnel_retraite_fields" style="display: none;" class="col-span-1 md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Grade</label>
                            <input type="text" name="grade_retraite" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Départ à la retraite</label>
                            <input type="date" name="depart_retraite" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Numéro CARFO</label>
                            <input type="text" name="numero_carfo" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                    </div>
                </div>
        
                <!-- Fields for Active Personnel -->
                <div id="personnel_active_fields" style="display: none;" class="col-span-1 md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Grade</label>
                            <input type="text" name="grade_active" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date d&apos;intégration</label>
                            <input type="date" name="date_integration" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date de départ à la retraite</label>
                            <input type="date" name="date_depart_retraite_active" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Direction</label>
                            <input type="text" name="direction" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Service</label>
                            <input type="text" name="service" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Navigation buttons -->
            <div class="flex justify-between mt-4">
                <button type="button" class="mt-2 bg-gray-300 text-gray-700 px-4 py-2 rounded" onclick="prevStep(4)">Précédent</button>
                <button type="submit" class="mt-2 bg-[#8495CD] text-white px-4 py-2 rounded" onclick="nextStep(4)">Suivant</button>
                
            </div>
        </div>
        
        <script>
            // JavaScript to toggle field visibility based on selected radio option
            document.querySelectorAll('input[name="statut"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    document.getElementById('personnel_retraite_fields').style.display = 
                        this.value === 'personnel_retraite' ? 'block' : 'none';
                    document.getElementById('personnel_active_fields').style.display = 
                        this.value === 'personnel_active' ? 'block' : 'none';
                });
            });
        </script>
        

        <!-- Step 5 -->
        <div class="step" id="step-5" style="display: none;">
            <h3 class="font-bold text-lg">Récapitulatif</h3>
            
            @if (isset($data) && !empty($data))
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
        
                .table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 10px;
                }
        
                .table th,
                .table td {
                    border: 2px solid gray;
                    padding: 8px;
                }
        
                .document {
                    max-width: 800px;
                    margin: auto;
                    padding: 20px;
                }
        
                fieldset {
                    margin-top: 10px;
                }
        
                legend {
                    font-size: 1rem;
                    padding: 0 10px;
                }
        
                ul {
                    margin-top: 10px;
                }
        
                p {
                    margin: 5px 0;
                }
            </style>
        
            <div class="adhesion-form max-w-4xl mx-auto p-10 bg-white shadow-lg rounded-lg">
                <div class="flex justify-between items-center mx-auto pb-2 w-11/12 mb-2">
                    <!-- Colonne 1 -->
                    <div class="flex flex-col space-y-1 items-center text-center leading-none self-start">
                        <p>MUTUELLE DE LA POLICE NATIONALE</p>
                        <div class="border-t-[2px] border-black  w-1/4"></div> <!-- Trait -->
                        <p>CONSEIL D'ADMINISTRATION</p>
                        <div class="border-t-[2px] border-black  w-1/4"></div> <!-- Trait -->
                        <p>SECRÉTARIAT GÉNÉRAL</p>
                    </div>
        
                    <!-- Colonne 2 (Logo) -->
                    <div class="flex h-full items-center self-start">
                        <img src="{{ asset('images/logofinal.png') }}" alt="Logo" class="h-full w-20 object-contain">
                    </div>
        
                    <!-- Colonne 3 -->
                    <div class="flex flex-col self-start text-center space-y-1 leading-none">
                        <p>BURKINA FASO</p>
                        <p>Unité - Progrès - Justice</p>
                    </div>
                </div>
        
                <!-- Titre principal -->
                <div class="flex flex-col items-center space-y-0">
                    <h2 class="text-center text-3xl font-bold mt-0">FORMULAIRE D'ADHÉSION</h2>
        
                    <!-- Sous-titre avec surlignage -->
                    <h1 class="text-center text-1xl text-white font-bold bg-black px-3 inline-block">
                        À REMPLIR EN CARACTÈRES D'IMPRIMERIE
                    </h1>
                </div>
        
        
                <div>
                    <p><strong>Matricule :</strong> {{ $data['matricule'] }}</p>
                </div>
                
                <!-- Section : Références de l'adhérent -->
                <div class="section border-t border-gray-300 mt-2 pt-3">
                    <div class="flex">
                        <!-- Colonne Références -->
                        <div class="w-3/4">
                            <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">RÉFÉRENCES DE L'ADHÉRENT</h3>
        
                            <div>
                                <p><strong>Matricule :</strong> {{ $data['matricule'] }}</p>
                            </div>
        
                            <!-- NIP et CNIB sur la même ligne -->
                            <div class="flex space-x-0 leading-none">
                                <p class="flex-1"><strong>NIP :</strong> {{ $data['nip'] }}</p>
                                <p class="flex-1"><strong>CNIB :</strong> {{ $data['cnib'] }}</p>
                            </div>
        
                            <div class="flex space-x-4">
                                <!-- Colonne pour DÉLIVRÉE LE et la date -->
                                <div class="flex-1 w-1/2 leading-none">
                                    <div class="flex">
                                        <!-- Première colonne : DÉLIVRÉE LE et (JJ/MM/AAAA) -->
                                        <div class="flex-shrink-0 ">
                                            <p class="mr-1"><strong>DÉLIVRÉE LE :</strong></p>
                                            <p class="text-xs"><small>(JJ/MM/AAAA)</small></p>
                                        </div>
        
                                        <!-- Deuxième colonne : valeur de la date de délivrance -->
                                        <div class="flex-1">
                                            <p>{{ $data['delivree'] }}</p>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="flex  w-1/2 leading-none">
                                    <!-- Première colonne : EXPIRE LE et (JJ/MM/AAAA) -->
                                    <div class="flex-shrink-0 ">
                                        <p class="mr-1"><strong>EXPIRE LE :</strong></p>
                                        <p class="text-xs"><small>(JJ/MM/AAAA)</small></p>
                                    </div>
        
                                    <!-- Deuxième colonne : valeur de la date d'expiration -->
                                    <div class="flex-1">
                                        <p>{{ $data['expire'] }}</p>
                                    </div>
                                </div>
        
                            </div>
        
                        </div>
        
                        <!-- Colonne Signature -->
                        <div class="w-1/4 items-center px-2 justify-center flex flex-col">
                            <h3 class="text-xs underline decoration-solid ">SIGNATURE DE L’ADHÉRENT</h3>
                            <div class="w-full flex-grow border-2 border-black mt-2 flex items-center justify-center">
                            </div>
                        </div>
                    </div>
        
                    <div>
                        <p><strong>Adresse :</strong> {{ $data['adresse_permanente'] }}</p>
                    </div>
        
                    <div class="flex space-x-4">
                        <p class="flex-1"><strong>Téléphone :</strong> {{ $data['telephone'] }}</p>
                        <p class="flex-1"><strong>Email :</strong> {{ $data['email'] }}</p>
                    </div>
                </div>
        
        
                <!-- Section : État civil -->
                <div class="section border-t border-gray-300 mt-1 pt-3">
        
                    <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">ÉTAT CIVIL</h3>
        
                    <div class="flex">
                        <div class="w-3/4">
                            <div class="mt-2">
                                <p><strong>Nom :</strong> {{ $data['nom']}}</p>
                                <p><strong>Prénom(s) :</strong> {{ $data['prenom'] }}</p>
                            </div>
                            <div class="flex items-center space-x-2 mt-1">
                                <!-- Colonne 1 : Lieu de naissance -->
                                <div class="flex-shrink-0">
                                    <p><strong>Lieu de naissance </strong></p>
                                </div>
        
                                <!-- Colonne 2 : Barre verticale -->
                                <div class="border-l-2 border-gray-400 h-16 mx-2"></div>
        
                                <!-- Colonne 3 : Infos supplémentaires -->
                                <div class="flex-1">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <p class="mr-1"><strong>Département</strong></p>
                                            <p class="mr-1"><strong>Ville / Village</strong></p>
                                            <div class="leading-none">
                                                <p class="mr-1"><strong>Pays</strong></p>
                                                <p class="text-xs"><small>(Si vous êtes né(e) hors du pays)</small></p>
                                            </div>
                                        </div>
        
                                        <div class="flex-1">
                                            <p> <strong>:</strong> {{ $data['departement'] }}</p>
                                            <p> <strong>:</strong> {{ $data['ville'] }}</p>
                                            <p> <strong>:</strong> {{ $data['pays'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="w-1/4 flex items-center px-2 justify-center">
                            <div class="w-full h-1/2 flex-grow border-2 border-black mt-2 flex items-center justify-center">
                                <p class="mr-2"><strong class="mr-1">Genre
                                        :</strong>{{ $data['genre'] == 'masculin' ? 'Masculin' : 'Féminin' }}</p>
                            </div>
                        </div>
                    </div>
        
                    <p><strong>Nom du père :</strong> {{ $data['nom_pere'] }}</p>
                    <p><strong>Nom de la mère :</strong> {{ $data['nom_mere'] }}</p>
                </div>
        
        
                <!-- Section : Informations Personnelles -->
                <div class="section border-t border-gray-300 mt-2 pt-3">
                    <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">INFORMATIONS PERSONNELLES</h3>
        
                    <div>
                        <p><strong>Situation matrimoniale :</strong> {{ $data['situation_matrimoniale'] }} </p>
                    </div>
        
                    <fieldset class="border-2 border-gray-400 leading-none rounded-lg">
                        <legend class="font-semibold bg-white pr-2 mx-4 flex items-center">
                            <span class="text-black text-lg">></span>
                            Personnes à prévenir en cas de besoin
                        </legend>
                        <div class="px-1">
                            <p><strong>Nom & Prénom(s) :</strong> {{ $data['nom_prenom_personne_besoin'] }} </p>
        
                            <div class="flex space-x-4"> <!-- Flexbox avec un espace entre les éléments -->
                                <p class="flex-1"><strong>Lieu de résidence :</strong>
                                    {{ $data['lieu_residence'] }}</p>
                                <p class="flex-1"><strong>Téléphone :</strong>
                                    {{ $data['telephone_personne_prevenir'] }}</p>
                            </div>
                        </div>
                    </fieldset>
        
                    @if ($data->nombreAyantsDroits > 0)
                        <div class="pt-4 text-center text-2xl font-bold">
                            <h2 class=" leading-none">LISTE DES AYANTS DROITS</h2>
                        </div>
                        <table class="table leading-none w-full border-collapse border-2 border-gray-400 text-left">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="border border-gray-400">N°</th>
                                    <th class="border border-gray-400">Nom</th>
                                    <th class="border border-gray-400">Prénom(s)</th>
                                    <th class="border border-gray-400">Sexe</th>
                                    <th class="border border-gray-400">Date de naissance</th>
                                    <th class="border border-gray-400">Lien de parenté</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->ayantsDroits as $index => $ayantDroit)
                                    <tr>
                                        <td class="border border-gray-400">{{ $index + 1 }}</td>
                                        <td class="border border-gray-400">{{ $ayantDroit['nom'] }}</td>
                                        <td class="border border-gray-400">{{ $ayantDroit['prenom'] }}</td>
                                        <td class="border border-gray-400">
                                            @if ($ayantDroit['sexe'] === 'H')
                                                Homme
                                            @elseif ($ayantDroit['sexe'] === 'F')
                                                Femme
                                            @else
                                                Non spécifié
                                            @endif
                                        </td>
                                        <td class="border border-gray-400">{{ $ayantDroit['date_naissance'] }}</td>
                                        <td class="border border-gray-400">{{ $ayantDroit['lien_parenté'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
        
                <!-- Section : Formations professionnelles -->
                <div class="section border-t border-gray-300 mt-2 pt-4">
                    <h3 class="text-1xl font-semibold mb-2 bg-gray-500 px-auto px-1">INFORMATIONS PROFESSIONELLES</h3>
                    
                    <!-- Personnel Retraité -->
                    @if ($data->statut === 'personnel_retraite')
                        <div class="border p-2 rounded-lg mb-2 leading-none">
                            <div class="text-center">
                                <p><strong>{{ $data->statut == 'personnel_active' ? 'Personnel en activité' : 'Personnel retraité' }}</strong></p>
                            </div>
                            <div>
                                <div>
                                    <p><strong>Grade :</strong> {{ $data->grade }}</p>
                                </div>
        
                            </div>
                            <div class="flex space-x-4">
                                <div class="flex-1 w-1/2 leading-none">
                                    <div class="flex leading-none">
                                        <div class="flex-shrink-0 leading-none">
                                            <p class="mr-1 leading-none"><strong>Date depart à la retraite :</strong></p>
                                            <p class="text-xs leading-none"><small>(JJ/MM/AAAA)</small></p>
                                        </div>
                                        <div class="flex-1">
                                            <p>{{ $data->departARetraite }}</p>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="flex  w-1/2 leading-none">
                                    <p><strong>N° CARFO :</strong> {{ $data->numeroCARFO }}</p>
                                </div>
        
                            </div>
                        </div>
                    @endif
                    
                    <!-- Personnel en Activité -->
                    @if ($data->statut === 'personnel_active')
                        <div class="border px-2 rounded-lg leading-none">
                            <div class="text-center">
                                <p><strong>{{ $data->statut == 'personnel_active' ? 'Personnel en activité' : 'Personnel retraité' }}</strong></p>
                            </div>
                            <div>
                                <div>
                                    <p><strong>Grade :</strong> {{ $data->grade }}</p>
                                </div>
        
                                <div class="flex space-x-4">
                                    <div class="flex-1 w-1/2 leading-none">
                                        <div class="flex">
                                            <div class="flex-shrink-0 leading-none">
                                                <p class="mr-1 leading-none"><strong>Date d'intégration :</strong></p>
                                                <p class="text-xs leading-none"><small>(JJ/MM/AAAA)</small></p>
                                            </div>
                                            <div class="flex-1">
                                                <p>{{ $data->dateIntegration }}</p>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="flex  w-1/2 leading-none">
                                        <div class="flex-shrink-0 leading-none">
                                            <p class="mr-1 leading-none"><strong>Date de départ à la rétraite :</strong></p>
                                            <p class="text-xs leading-none"><small>(JJ/MM/AAAA)</small></p>
                                        </div>
        
                                        <!-- Deuxième colonne : valeur de la date d'expiration -->
                                        <div class="flex-1">
                                            <p>{{ $data->dateDepartARetraite }}</p>
                                        </div>
                                    </div>
        
                                </div>
        
                                <div class="flex space-x-0">
                                    <p class="flex-1"><strong>Direction :</strong> {{ $data->direction }}</p>
                                    <p class="flex-1"><strong>Service :</strong> {{ $data->service }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    
                    <div class="flex">
                        <!-- Colonne Références -->
                        <div class="w-3/4 flex items-center justify-center">
                            <div class="rounded-lg text-1xl border-2 border-black font-semibold px-1">
        
                                <h3>JOINDRE DES PHOTOS RECENTES DE L’ADHERENT ET DES AYANTS DROITS</h3>
                                <h3 class=" text-1xl font-semibol px-auto px-1">
                                    	joindre une copie de l’extrait de naissance de chaque enfant
                                </h3>
                                <h3>
                                    	joindre une copie de l’extrait de naissance et de la CNIB pour la ou le(s) conjoint(es)
                                </h3>
                            </div>
        
                        </div>
        
                        <!-- Colonne Signature -->
                        <div class="w-[20%] items-center px-2 justify-end flex-col ml-auto">
                            <h3 class="text-xs text-center underline decoration-solid ">VISA DU PRESIDENT DU CONSEIL D’ADMINISTRATION</h3>
                            <div class="w-full h-32 flex-grow border-2 border-black flex items-center justify-center">
                            </div>
                        </div>
                    </div>
                </div>
        
            </div>
        @endif
        
        

            <div class="flex justify-between mt-4">
                <button type="button" class="mt-2 bg-gray-300 text-gray-700 px-4 py-2 rounded" onclick="prevStep(5)">Précédent</button>
                <button type="submit" class="bg-blue-900 mt-2 text-white px-4 py-2 rounded" onclick="submitForm()">Soumettre</button>
            </div>
        </div>

    </form>
</div>

<script>
    var currentStep = 1;

    function updateStepper(step) {
        const stepItems = document.querySelectorAll('.step-item');
        
        // Met à jour l'apparence des étapes
        stepItems.forEach((item, index) => {
            const stepNumber = item.querySelector('.step-number');
            
            if (index < step - 1) {
                // Étape complétée
                item.classList.add('text-indigo-600');
                item.classList.remove('text-gray-900');
                stepNumber.classList.add('bg-indigo-600', 'text-white');
                stepNumber.classList.remove('bg-gray-50', 'border-gray-200', 'text-indigo-600');
                item.classList.add('before:bg-indigo-600', 'after:bg-indigo-600');
            } else if (index === step - 1) {
                // Étape actuelle
                item.classList.add('text-indigo-600');
                stepNumber.classList.add('bg-indigo-600', 'text-white');
                stepNumber.classList.remove('bg-gray-50', 'border-gray-200', 'text-indigo-600');
                item.classList.add('before:bg-indigo-600');
                item.classList.remove('after:bg-indigo-600');
            } else {
                // Étape non complétée
                item.classList.remove('text-indigo-600');
                item.classList.add('text-gray-900');
                stepNumber.classList.add('bg-gray-50', 'border-gray-200', 'text-indigo-600');
                stepNumber.classList.remove('bg-indigo-600', 'text-white');
                item.classList.remove('before:bg-indigo-600', 'after:bg-indigo-600');
            }
        });
    
        // Met à jour le label en fonction de l'étape
        const stepLabel = document.querySelector('.step-label');
        switch (step) {
            case 1:
                stepLabel.textContent = 'Références';
                break;
            case 2:
                stepLabel.textContent = 'Etat civil';
                break;
            case 3:
                stepLabel.textContent = 'Informations personnelles';
                break;
            case 4:
                stepLabel.textContent = 'Formations professionnelles';
                break;
            case 5:
                stepLabel.textContent = 'Récapitulatif';
                break;
            default:
                stepLabel.textContent = 'Étape inconnue';
                break;
        };
        if (step === 5) {
            // Generate the recapitulatif
            const recap = `
                <strong>Matricule:</strong> ${document.getElementById('matricule').value}<br>
                <strong>NIP:</strong> ${document.getElementById('nip').value}<br>
                <strong>CNIB:</strong> ${document.getElementById('cnib').value}<br>
                <strong>Date délivrée:</strong> ${document.getElementById('delivree').value}
            `;
            document.getElementById('recapitulatif').innerHTML = recap;
        }
    

    }
    
    
    
    function nextStep() {
        if (currentStep < 5) {  // Assure qu'on ne dépasse pas l'étape 5
            // Cacher l'étape actuelle
            document.getElementById('step-' + currentStep).style.display = 'none';
            // Afficher l'étape suivante
            document.getElementById('step-' + (currentStep + 1)).style.display = 'block';
            // Incrémenter currentStep
            currentStep++;
            // Mettre à jour le stepper
            updateStepper(currentStep);
        }
    }
    
    function prevStep() {
        if (currentStep > 1) {  // Assure qu'on ne descend pas en dessous de l'étape 1
            // Cacher l'étape actuelle
            document.getElementById('step-' + currentStep).style.display = 'none';
            // Afficher l'étape précédente
            document.getElementById('step-' + (currentStep - 1)).style.display = 'block';
            // Décrémenter currentStep
            currentStep--;
            // Mettre à jour le stepper
            updateStepper(currentStep);
        }
    }

    

    function submitForm() {
        const form = document.getElementById('membershipForm');
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Form submitted successfully');
                window.location.href = '/resume-adhesion/' + data.id;
            }
        });
    }
</script>
