
<div class="mx-auto w-full max-w-screen-lg px-3 sm:px-5 md:px-7 z-10">
    <div id="wizard-top" class="w-full md:w-5/6 mx-auto mt-0 md:mt-3">
        @if ($adherentType === 'nouveau')
            <div>
                <div class="text-center">
                    <h2 class=" mb-2 text-sm sm:text-lg md:text-xl font-semibold">Nouvelle adhésion</h2>
                </div>
                
                <!-- Stepper -->
                <!-- Stepper pour les petits écrans (<= 640px) -->
                <ul class="flex flex-col justify-center items-center mb-4 md:mb-6 sm:hidden">
                    @for ($step = 1; $step <= $totalSteps; $step++)
                    <li class="flex justify-center items-center w-full mb-2 sm:mb-4">
                        <!-- Stepper Rectangle for Small Screens -->
                        <div class="flex flex-col items-center w-full rounded-xl border {{ $currentStep >= $step ? 'border-primary1' : 'border-gray-300' }} {{ $currentStep == $step ? 'bg-primary1' : 'bg-white' }} hover:bg-primary1 hover:border-primary1 transition-all duration-200">
                            <!-- Step Number and Label on the Same Line -->
                            <div class="flex items-center justify-center w-full" wire:click="goToStep({{ $step }})">
                                <!-- Step Number -->
                                <span class=" text-sm sm:text-xl py-2 mx-2 text-black {{ $currentStep == $step ? 'text-white' : 'text-gray-700' }} font-semibold">
                                    {{ $step }}.
                                </span>
                                <!-- Step Label -->
                                <span class="step-title text-sm {{ $currentStep == $step ? 'text-white' : 'text-gray-600' }} font-semibold">
                                    @if ($step == 1) Références de l&apos;adhérent
                                    @elseif ($step == 2) Etat civil
                                    @elseif ($step == 3) Informations personnelles
                                    @elseif ($step == 4) Informations professionnelles
                                    @elseif ($step == 5) Récapitulatif
                                    @endif
                                </span>
                            </div>
                        </div>
                    </li>
                    @endfor
                </ul>

                <!-- Stepper pour les grands écrans (> 640px) -->
                <div class="flex-stepper justify-between items-center mb-4 md:mb-6 hidden sm:flex">
                    @for ($step = 1; $step <= $totalSteps; $step++)
                        <div class="flex justify-center flex-col items-center flex-1 {{ $step == 1 || $step == $totalSteps ? 'w-[calc(100%/4)]' : '' }}">
                            <div class="relative flex items-center w-full" wire:click="goToStep({{ $step }})">
                                <!-- Ligne connectante invisible pour la première étape -->
                                @if ($step == 1)
                                    <div class="flex-1 h-1 invisible" style="height: 3px; margin-left: -0.5rem;"></div>
                                @endif

                                <!-- Connecting Line -->
                                @if ($step > 1 && $step <= $totalSteps)
                                    <div class="flex-1 h-1 {{ $currentStep >= $step ? 'bg-primary1' : 'bg-gray-300' }}"
                                        style="height: 3px; margin-left: -0.5rem;"></div>
                                @endif
                                <!-- Step Circle -->
                                <div class="w-5 h-5 sm:w-6 sm:h-6 md:w-8 md:h-8 flex shadow-lg items-center justify-center {{ $currentStep >= $step ? 'bg-primary1' : 'bg-gray-300' }} rounded-full text-white z-10 transition-all duration-200 hover:bg-primary1 hover:scale-110 cursor-pointer">
                                    @if ($currentStep > $step)
                                        <i class="fa fa-check"></i>
                                    @else
                                        {{ $step }}
                                    @endif
                                </div>
                                <!-- Connecting Line -->
                                @if ($step < $totalSteps)
                                    <div class="flex-1 h-1 {{ $currentStep > $step ? 'bg-primary1' : 'bg-gray-300' }}"
                                        style="height: 3px; margin-left: -0.5rem;"></div>
                                @endif

                                <!-- Ligne connectante invisible pour la dernière étape -->
                                @if ($step == $totalSteps)
                                    <div class="flex-1 h-1 invisible" style="height: 3px; margin-left: -0.5rem;"></div>
                                @endif
                            </div>
                            <!-- Step Label -->
                            <div class="text-xs mt-2 text-center w-full h-4 overflow-hidden">
                                <p class="step-label whitespace-normal break-words">
                                    @if ($step == 1) Références de l&apos;adhérent
                                    @elseif ($step == 2) Etat civil
                                    @elseif ($step == 3) Informations personnelles
                                    @elseif ($step == 4) Informations professionnelles
                                    @elseif ($step == 5) Récapitulatif
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endfor
                </div>

                <!-- Formulaire englobant le contenu des étapes - nouvelle adhésion -->
                <form wire:submit.prevent="submitAdhesion" enctype="multipart/form-data" class="shadow-lg border rounded-lg border-gray-200 px-4 md:px-5 pt-2 md:pt-6 pb-6 md:pb-8 mb-4">
                    <!-- Titre de l'étape active -->
                    <h2 class="text-lg sm:text-xl font-bold mb-2 md:mb-5 rounded-md text-center {{ $currentStep ? 'bg-primary1' : 'bg-gray-300' }} {{ $currentStep ? 'text-white' : 'text-gray-800' }}">
                        @if ($currentStep == 1) 1. Références de l&apos;adhérent
                        @elseif ($currentStep == 2) 2. Etat civil
                        @elseif ($currentStep == 3) 3. Informations personnelles
                        @elseif ($currentStep == 4) 4. Informations professionnelles
                        @elseif ($currentStep == 5) 5. Récapitulatif
                        @endif
                    </h2>
                    {{-- <div class="overflow-hidden screen-stepper:overflow-y-auto max-h-[500px] sm:scrollbar-thin px-1 sm:px-4"> --}}
                        <!-- Étape 1 -->
                        @if ($currentStep == 1)
                            <div>
                                <!-- Grille pour Matricule et NIP -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-3 sm:gap-4">
                
                                    <!-- Matricule -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="matricule">Matricule</label>
                                        <input wire:model="matricule" id="matricule" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                        @error('matricule')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- NIP -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="nip">NIP</label>
                                        <input wire:model="nip" id="nip" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('nip')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                </div>
        
                                <!-- Grille pour N° CNIB, Délivré le, et Expire le -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 mt-3">
                
                                    <!-- N° CNIB -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="cnib">N° CNIB</label>
                                        <input wire:model="cnib" id="cnib" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('cnib')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                
                                    <!-- Délivré le -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="delivree">Délivré le</label>
                                        <input wire:model="delivree" id="delivree" type="date"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4"
                                                wire:change="updateExpire">
                                        @error('delivree')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Expire le -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="expire">Expire le</label>
                                        <input wire:model="expire" id="expire" type="date"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4" readonly>
                                        @error('expire')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Adresse permanente -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="adresse_permanente">Adresse permanente</label>
                                        <input wire:model="adresse_permanente" id="adresse_permanente" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('adresse_permanente')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                    
                                    <!-- Téléphone -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="telephone">Téléphone</label>
                                        <input wire:model="telephone" id="telephone" type="tel" placeholder="Ex: 77112233"
                                            pattern="^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$"
                                            title="Ex. (numéro valide) : +22677020202 ou 77020202"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('telephone')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                
                                    <!-- Email -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="email">Email</label>
                                        <input wire:model="email" id="email" type="email"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('email')
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
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('nom')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Prénom(s) -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="prenom">Prénom(s)</label>
                                        <input wire:model="prenom" id="prenom" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('prenom')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Genre (Radio buttons) -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1">Genre</label>
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
                                <fieldset class=" border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                                    <legend class="block text-gray-700 text-sm font-bold mb-2">Lieu de naissance</legend>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <!-- Département -->
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1" for="departement">Département</label>
                                            <input wire:model="departement" id="departement" type="text"
                                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                            @error('departement')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <!-- Ville / Village -->
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1" for="ville">Ville / Village</label>
                                            <input wire:model="ville" id="ville" type="text"
                                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                            @error('ville')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <!-- Pays (Si hors Burkina) -->
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1" for="pays">Pays </label>
                                            <input wire:model="pays" id="pays" type="text"
                                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                            @error('pays')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>
                
                                <!-- Grille pour Nom et Prénom(s) du père et de la mère -->
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Nom et Prénom(s) du père -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_pere">Nom et Prénom(s) du
                                            père</label>
                                        <input wire:model="nom_pere" id="nom_pere" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('nom_pere')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Nom et Prénom(s) de la mère -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_mere">Nom et Prénom(s) de
                                            la mère</label>
                                        <input wire:model="nom_mere" id="nom_mere" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
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
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-1">Situation matrimoniale</label>
                                        <div class="flex flex-wrap gap-3 items-center mb-4">
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
                                        <fieldset class="border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                                            <legend class="block text-gray-700 text-sm font-bold mb-2">Personne à prévenir en cas de besoin</legend>
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_prenom_personne_besoin">Nom et prénoms (s)</label>
                                                <input wire:model="nom_prenom_personne_besoin" id="nom_prenom_personne_besoin" type="text"
                                                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                @error('nom_prenom_personne_besoin')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2">
                                                <!-- Lieu de résidence -->
                                                <div>
                                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="lieu_residence">Lieu de résidence</label>
                                                    <input wire:model="lieu_residence" id="lieu_residence" type="text"
                                                        class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                    @error('lieu_residence')
                                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                                    @enderror
                                                </div>
        
                                                <!-- Téléphone -->
                                                <div>
                                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="telephone_personne_prevenir">Téléphone</label>
                                                    <input wire:model="telephone_personne_prevenir" id="telephone_personne_prevenir" 
                                                        type="tel" placeholder="Ex: 77112233"
                                                        pattern="^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$"
                                                        title="Ex. (numéro valide) : +22677020202 ou 77020202"
                                                        class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                    @error('telephone_personne_prevenir')
                                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
        
                                    <!-- -------------------------- Photo -------------------------------------->
                                    <div id="photoUpload" class="col-span-1">
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="photo">Photo</label>
                                    
                                        <!-- Input de fichier -->
                                        <input type="file" id="photoInput" class="w-full py-2" accept="image/jpg, image/jpeg" onchange="previewImage(event)">
                                    
                                        <!-- Zone pour afficher la prévisualisation -->
                                        <img id="preview" class="w-20 h-20 mt-2 hidden" />
                                    
                                        <span id="errorMessage" class="text-red-500 text-sm hidden"></span>
                                    </div>
                                    
                                    <script>
                                    function previewImage(event) {
                                        const file = event.target.files[0];
                                        const preview = document.getElementById("preview");
                                        const errorMessage = document.getElementById("errorMessage");
                                    
                                        if (file) {
                                            // Vérifier si le fichier est une image JPG/JPEG
                                            if (!file.type.match('image/jpeg') && !file.type.match('image/jpg')) {
                                                errorMessage.innerText = "Seules les images JPG/JPEG sont acceptées.";
                                                errorMessage.classList.remove("hidden");
                                                preview.classList.add("hidden");
                                                return;
                                            }
                                    
                                            // Afficher la prévisualisation
                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                preview.src = e.target.result;
                                                preview.classList.remove("hidden");
                                                errorMessage.classList.add("hidden");
                                            }
                                            reader.readAsDataURL(file);
                                        }
                                    }
                                    </script>
                                    
                                </div>
        
                                <div class="overflow-x-auto">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="changeNombreAyantsDroits">Nombre d&apos;ayants-droits (Charge)</label>
                                    <select class="border-2 bg-gray-50 rounded w-full py-1" wire:change="changeNombreAyantsDroits($event.target.value)">
                                        <option value="" disabled selected>Choisissez un nombre</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    @error('nombreAyantsDroits') 
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="col-span-3">
                                    @if ($nombreAyantsDroits > 0)
                                        @for ($i = 0; $i < $nombreAyantsDroits; $i++)
                                            <div class="border bg-gray-100 p-4 rounded mb-2 col-span-3 shadow-lg mt-2">
                                                <h3 class="font-bold mb-2">Ayant Droit {{ $i + 1 }}</h3>
        
                                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                                    <div class="mt-2">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">Nom</label>
                                                        <input type="text" wire:model="ayantsDroits.{{ $i }}.nom" class="border rounded w-full py-1" >
                                                        @error('ayantsDroits.' . $i . '.nom')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">Prénom(s)</label>
                                                        <input type="text" wire:model="ayantsDroits.{{ $i }}.prenom" class="border rounded w-full py-1">
                                                        @error('ayantsDroits.' . $i . '.prenom')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
        
                                                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                                    <div class="mt-2">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">Genre</label>
                                                        <select wire:model="ayantsDroits.{{ $i }}.sexe" class="border rounded w-full py-1">
                                                            <option value="" disabled selected>Sélectionner</option>
                                                            <option value="M">Homme</option>
                                                            <option value="F">Femme</option>
                                                        </select>
                                                        @error('ayantsDroits.' . $i . '.sexe')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">Date de Naissance</label>
                                                        <input type="date" wire:model="ayantsDroits.{{ $i }}.date_naissance" class="border rounded w-full py-1">
                                                        @error('ayantsDroits.' . $i . '.date_naissance')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">Lien de Parenté</label>
                                                        
                                                        <select wire:model="ayantsDroits.{{ $i }}.relation" wire:change="changeLienParente($event.target.value, {{ $i }})" class="border-2 rounded w-full py-1">
                                                            <option value="" disabled selected>Sélectionnez un lien</option>
                                                            <option value="conjoint">Conjoint (e)</option>
                                                            <option value="enfant">Enfant</option>
                                                        </select>
                                                        @error('ayantsDroits.' . $i . '.relation')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
        
                                                <!-- Champ pour la photo de la CNIB si le lien de parenté est "conjoint" -->
                                                @if (isset($ayantsDroits[$i]['relation']) && strtolower($ayantsDroits[$i]['relation']) === 'conjoint')
                                                    <div class="mt-4">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">CNIB (en PDF)</label>
                                                        <div class="w-full justify-center border-2 rounded-md p-1 border-gray-700">
                                                            <input type="file" wire:model="ayantsDroits.{{ $i }}.cnib" class="w-full py-2"  accept='.pdf'>
                                                            
                                                            @error('ayantsDroits.' . $i . '.cnib')
                                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
        
                                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4" wire:key="ayantDroit-{{ $i }}">
                                                <!-- Photo ayant droit -->
                                                <div>
                                                    <label class="block text-gray-700 text-sm font-bold mb-1">Photo de l&apos;ayant droit</label>
                                                    <div class="w-full justify-center border-2 rounded-md p-1 border-gray-700">
                                                        <!-- Upload photo -->
                                                        <input type="file" wire:model="ayantsDroits.{{ $i }}.photo" class="w-full py-2" accept="image/jpg, image/jpeg">
                                                        
                                                        <!-- Afficher une prévisualisation de la photo si elle est uploadée -->
                                                        @if (isset($ayantsDroits[$i]['photo']))
                                                            <img src="{{ $ayantsDroits[$i]['photo']->temporaryUrl() }}" class="w-20 h-20">
                                                        @endif
                                                        
                                                        @error('ayantsDroits.' . $i . '.photo')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            
                                                <!-- Photo de extrait acte de naissance -->
                                                <div>
                                                    <label class="block text-gray-700 text-sm font-bold mb-1">Extrait d&apos;acte de naissance (en PDF)</label>
                                                    <div class="w-full justify-center border-2 rounded-md p-1 border-gray-700">
                                                        <input type="file" wire:model="ayantsDroits.{{ $i }}.extrait" class="w-full py-2"  accept='.pdf'>
        
                                                        @error('ayantsDroits.' . $i . '.extrait')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
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
                                            <input name="statut" type="radio" wire:click="changeStatut('personnel_retraite')" class="form-radio text-indigo-600">
                                            <span class="ml-2">Personnel retraité</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex items-center mt-2">
                                            <input name="statut" type="radio" wire:click="changeStatut('personnel_active')" class="form-radio text-indigo-600">
                                            <span class="ml-2">Personnel en activité</span>
                                        </label>
                                    </div>
                                </div>
        
                                <!-- Champs pour Personnel Retraité -->
                                @if ($statut === 'Retraité(e)')
                                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                        {{-- Grade --}}
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Grade</label>
                                            <select wire:model="grade" class="bg-gray-50  border-2 rounded w-full py-1 mb-0 sm:mb-4">
                                                <option value="" disabled selected>Sélectionnez un grade</option>
                                                @foreach($grades as $gradeOption)
                                                    <option value="{{ $gradeOption }}">{{ $gradeOption }}</option>
                                                @endforeach
                                            </select>
                                            @error('grade')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
        
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Départ à la retraite</label>
                                            <input type="date" wire:model="departARetraite" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                            @error('departARetraite')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
        
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Numéro CARFO</label>
                                            <input type="text" wire:model="numeroCARFO" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
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
                                                <select wire:model="grade" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                    <option value="" disabled selected>Sélectionnez un grade</option>
                                                    @foreach($grades as $gradeOption)
                                                        <option value="{{ $gradeOption }}">{{ $gradeOption }}</option>
                                                    @endforeach
                                                </select>
                                                @error('grade')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
        
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Date d&apos;intégration</label>
                                                <input type="date" wire:model="dateIntegration" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                @error('dateIntegration')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
        
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Date de départ à la retraite</label>
                                                <input type="date" wire:model="dateDepartARetraite" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                @error('dateDepartARetraite')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
        
                                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Direction</label>
                                                <input type="text" wire:model="direction" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                @error('direction')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
        
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Service</label>
                                                <input type="text" wire:model="service" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                @error('service')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                        
                        <!-- Étape 5 -->
                        @if ($currentStep == 5)
                            <x-formulaire-adhesion
                                :matricule="$matricule"
                                :nip="$nip"
                                :cnib="$cnib"
                                :delivree="$delivree"
                                :expire="$expire"
                                :adresse-permanente="$adresse_permanente"
                                :telephone="$telephone"
                                :email="$email"
                                :nom="$nom"
                                :prenom="$prenom"
                                :genre="$genre"
                                :departement="$departement"
                                :ville="$ville"
                                :pays="$pays"
                                :nom-pere="$nom_pere"
                                :nom-mere="$nom_mere"
                                :situation-matrimoniale="$situation_matrimoniale"
                                :nom-prenom-personne-besoin="$nom_prenom_personne_besoin"
                                :lieu-residence="$lieu_residence"
                                :telephone-personne-prevenir="$telephone_personne_prevenir"
                                :photo="$photo"
                                :photo-path-adherent="$photo_path_adherent"
                                :photo-path-ayantdroit="$photo_path_ayantdroit"
                                :date-integration="$dateIntegration"
                                :date-depart-a-retraite="$dateDepartARetraite"
                                :direction="$direction"
                                :service="$service"
                                :statut="$statut"
                                :grade="$grade"
                                :depart-a-retraite="$departARetraite"
                                :numero-carfo="$numeroCARFO"
                                :nombre-ayants-droits="$nombreAyantsDroits"
                                :ayants-droits="$ayantsDroits"
                                :signature="$signature"
                                :signature-image="$signatureImage"
                            />

                        @endif
                    </div>
        
            
                    <!-- Boutons de navigation -->
                    <div class="flex justify-between mt-5">
                        @if ($currentStep > 1)
                            <button wire:click="previousStep" onclick="scrollToTop()"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Précédent
                            </button>
                        @else
                            <div></div> <!-- Un div vide pour garder le bouton "Suivant" aligné à droite -->
                        @endif
            
                        <!-- Bouton "Suivant" ou "Soumettre", toujours aligné à droite -->
                        @if ($currentStep < $totalSteps)
                            <button wire:click="nextStep" onclick="scrollToTop()"
                                class="bg-primary1 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Suivant
                            </button>
                        @else
                            <button wire:click="submitAdhesion" onclick="scrollToTop()"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Soumettre
                            </button>
                        @endif
                        <script>
                            function scrollToTop() {
                                document.getElementById('wizard-top').scrollIntoView({ behavior: 'smooth' });
                            }
                        </script>
                    </div>
            
                    <!-- Message de succès -->
                    @if (session()->has('message'))
                        <div class="mt-5 p-4 bg-green-200 text-green-800 rounded">
                            {{ session('message') }}
                        </div>
                    @endif
                </form>
            </div>
        @endif

        
        @if ($adherentType === "ancien")
       

            <form method="POST" action="{{ route('final-old-adhesion') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-2">
                    <!-- Modale pour les erreurs -->
                    @if(session('error'))
                    <div x-data="{ open: true }" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white z-50 rounded-lg shadow-lg p-4 max-w-sm  mx-0.5" >
                            <h2 class="text-xl font-semibold text-red-600">Échec !</h2>
                            <p class="mt-4 text-gray-700 text-sm">{{ session('error') }}</p>
                            <div class="mt-6 text-right">
                                <button @click="open = false" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                    Fermer
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-3 sm:gap-4">
            
                        <!-- Nom(s) -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1" for="nom">Nom</label>
                            <input name="nom" id="nom" type="text" required value=""
                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                            @error('nom')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
            
                        <!-- Prénom(s) -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1" for="prenom">Prénom(s)</label>
                            <input name="prenom" id="prenom" type="text" required value=""
                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                            @error('prenom')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
                        <!-- Matricule -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1" for="matricule">N° Matricule (sans la lettre)</label>
                            <input name="matricule" id="matricule" type="number" required value=""
                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                            @error('matricule')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
            
                        <!-- Téléphone -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1" for="telephone">Téléphone</label>
                            <input name="telephone" id="telephone" type="tel" placeholder="Ex: 77112233"
                                pattern="^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$"
                                title="Ex. (numéro valide) : +22677020202 ou 77020202" required value=""
                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                            @error('telephone')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
            
                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1" for="email">Email</label>
                            <input name="email" id="email" type="email" required value=""
                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="grid grid-cols-1  gap-3 sm:gap-4">
            
                        <!-- Photo -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1" for="photo">Photo d&apos;identité</label>
                            <input name="photo" id="photo" type="file" accept="image/*" required
                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                            <span>Taille max : 1Mo</span>
                            <small class="text-gray-500">
                                Veuillez télécharger une photo d&apos;identité (tête et épaules uniquement).
                            </small>
                            <span id="photo-error" class="text-red-500 text-xs hidden">La photo dépasse 1 Mo.</span>
                            @error('photo')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <script>
                            document.getElementById('photo').addEventListener('change', function(e) {
                                const file = e.target.files[0];
                                if (file && file.size > 1048576) { // 1 Mo = 1048576 octets
                                    document.getElementById('photo-error').classList.remove('hidden');
                                    e.target.value = ''; // Réinitialiser l'input file
                                } else {
                                    document.getElementById('photo-error').classList.add('hidden');
                                }
                            });
                        </script>
                        
                    </div>

                    <!-- Bouton pour vérifier les données -->
                    <div class="flex justify-between items-center py-2">
                        <div class="text-red-500">
                            @if (session()->has('error'))
                                {{ session('error') }}
                            @endif
                        </div>
            
                        <button type="submit" class="bg-primary1 btn">
                            Valider
                        </button>
                    </div>
                </div>
            </form>

            @if ($showConfirmationForm)
            <div>
                <div class="text-center">
                    <h2 class=" mb-2 text-sm sm:text-lg md:text-xl font-semibold">Mise à jour </h2>
                </div>
                <!-- Stepper -->
                <!-- Stepper pour les petits écrans (<= 450px) -->
                <ul class="flex flex-col justify-center items-center mb-4 md:mb-6 sm:hidden">
                    @for ($step = 1; $step <= $totalSteps; $step++)
                    <li class="flex justify-center items-center w-full mb-2 sm:mb-4">
                        <!-- Stepper Rectangle for Small Screens -->
                        <div class="flex flex-col items-center w-full rounded-xl border {{ $currentStep >= $step ? 'border-primary1' : 'border-gray-300' }} {{ $currentStep == $step ? 'bg-primary1' : 'bg-white' }} hover:bg-primary1 hover:border-primary1 transition-all duration-200">
                            <!-- Step Number and Label on the Same Line -->
                            <div class="flex items-center justify-center w-full" wire:click="goToStep({{ $step }})">
                                <!-- Step Number -->
                                <span class=" text-sm sm:text-xl py-2 mx-2 text-black {{ $currentStep == $step ? 'text-white' : 'text-gray-700' }} font-semibold">
                                    {{ $step }}.
                                </span>
                                <!-- Step Label -->
                                <span class="step-title text-sm {{ $currentStep == $step ? 'text-white' : 'text-gray-600' }} font-semibold">
                                    @if ($step == 1) Références de l&apos;adhérent
                                    @elseif ($step == 2) Etat civil
                                    @elseif ($step == 3) Informations personnelles
                                    @elseif ($step == 4) Informations professionnelles
                                    @elseif ($step == 5) Récapitulatif
                                    @endif
                                </span>
                            </div>
                        </div>
                    </li>
                    @endfor
                </ul>

                <!-- Stepper pour les grands écrans (> 450px) -->
                <div class="flex-stepper justify-between items-center mb-4 md:mb-6 hidden sm:flex">
                    @for ($step = 1; $step <= $totalSteps; $step++)
                        <div class="flex justify-center flex-col items-center flex-1 {{ $step == 1 || $step == $totalSteps ? 'w-[calc(100%/4)]' : '' }}">
                            <div class="relative flex items-center w-full" wire:click="goToStep({{ $step }})">
                                <!-- Ligne connectante invisible pour la première étape -->
                                @if ($step == 1)
                                    <div class="flex-1 h-1 invisible" style="height: 3px; margin-left: -0.5rem;"></div>
                                @endif

                                <!-- Connecting Line -->
                                @if ($step > 1 && $step <= $totalSteps)
                                    <div class="flex-1 h-1 {{ $currentStep >= $step ? 'bg-primary1' : 'bg-gray-300' }}"
                                        style="height: 3px; margin-left: -0.5rem;"></div>
                                @endif
                                <!-- Step Circle -->
                                <div class="w-5 h-5 sm:w-6 sm:h-6 md:w-8 md:h-8 flex shadow-lg items-center justify-center {{ $currentStep >= $step ? 'bg-primary1' : 'bg-gray-300' }} rounded-full text-white z-10 transition-all duration-200 hover:bg-primary1 hover:scale-110 cursor-pointer">
                                    @if ($currentStep > $step)
                                        <i class="fa fa-check"></i>
                                    @else
                                        {{ $step }}
                                    @endif
                                </div>
                                <!-- Connecting Line -->
                                @if ($step < $totalSteps)
                                    <div class="flex-1 h-1 {{ $currentStep > $step ? 'bg-primary1' : 'bg-gray-300' }}"
                                        style="height: 3px; margin-left: -0.5rem;"></div>
                                @endif

                                <!-- Ligne connectante invisible pour la dernière étape -->
                                @if ($step == $totalSteps)
                                    <div class="flex-1 h-1 invisible" style="height: 3px; margin-left: -0.5rem;"></div>
                                @endif
                            </div>
                            <!-- Step Label -->
                            <div class="text-xs mt-2 text-center w-full h-4 overflow-hidden">
                                <p class="step-label whitespace-normal break-words">
                                    @if ($step == 1) Références de l&apos;adhérent
                                    @elseif ($step == 2) Etat civil
                                    @elseif ($step == 3) Informations personnelles
                                    @elseif ($step == 4) Informations professionnelles
                                    @elseif ($step == 5) Récapitulatif
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endfor
                </div>

                <!-- Contenu des étapes -->
                <div  class="shadow-lg border rounded-lg border-gray-200 px-4 md:px-5 pt-2 md:pt-6 pb-6 md:pb-8 mb-4">
                    <h2 class="text-lg sm:text-xl font-bold mb-2 md:mb-5 rounded-md text-center {{ $currentStep ? 'bg-primary1' : 'bg-gray-300' }} {{ $currentStep ? 'text-white' : 'text-gray-800' }}">
                        @if ($currentStep == 1) 1. Références de l&apos;adhérent
                        @elseif ($currentStep == 2) 2. Etat civil
                        @elseif ($currentStep == 3) 3. Informations personnelles
                        @elseif ($currentStep == 4) 4. Informations professionnelles
                        @elseif ($currentStep == 5) 5. Récapitulatif
                        @endif
                    </h2>
                    {{-- <div class="overflow-hidden screen-stepper:overflow-y-auto max-h-[500px] sm:scrollbar-thin px-1 sm:px-4"> --}}
                        <!-- Étape 1 -->
                        @if ($currentStep == 1)
                            <div>
                                <!-- Grille pour Matricule et NIP -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-3 sm:gap-4">
                
                                    <!-- Matricule -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="matricule">Matricule</label>
                                        <input wire:model="matricule" id="matricule" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                        @error('matricule')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- NIP -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="nip">NIP</label>
                                        <input wire:model="nip" id="nip" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('nip')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                </div>
        
                                <!-- Grille pour N° CNIB, Délivré le, et Expire le -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 mt-3">
                
                                    <!-- N° CNIB -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="cnib">N° CNIB</label>
                                        <input wire:model="cnib" id="cnib" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('cnib')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                
                                    <!-- Délivré le -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="delivree">Délivré le</label>
                                        <input wire:model="delivree" id="delivree" type="date"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4"
                                                wire:change="updateExpire">
                                        @error('delivree')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Expire le -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="expire">Expire le</label>
                                        <input wire:model="expire" id="expire" type="date"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4" readonly>
                                        @error('expire')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Adresse permanente -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="adresse_permanente">Adresse permanente</label>
                                        <input wire:model="adresse_permanente" id="adresse_permanente" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('adresse_permanente')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                    
                                    <!-- Téléphone -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="telephone">Téléphone</label>
                                        <input wire:model="telephone" id="telephone" type="tel" placeholder="Ex: 77112233"
                                            pattern="^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$"
                                            title="Ex. (numéro valide) : +22677020202 ou 77020202"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('telephone')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Email -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="email">Email</label>
                                        <input wire:model="email" id="email" type="email"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('email')
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
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('nom')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Prénom(s) -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="prenom">Prénom(s)</label>
                                        <input wire:model="prenom" id="prenom" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('prenom')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Genre (Radio buttons) -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1">Genre</label>
                                        <div class="flex items-center mb-4">
                                            <input wire:model="genre" id="masculin" type="radio" value="M" class="mr-2">
                                            <label for="masculin" class="mr-6">Masculin</label>
                
                                            <input wire:model="genre" id="feminin" type="radio" value="F" class="mr-2">
                                            <label for="feminin">Féminin</label>
                                        </div>
                                        @error('genre')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                </div>
                
                                <!-- Lieu de naissance (sous forme de grille) -->
                                <fieldset class=" border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                                    <legend class="block text-gray-700 text-sm font-bold mb-2">Lieu de naissance</legend>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <!-- Département -->
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1" for="departement">Département</label>
                                            <input wire:model="departement" id="departement" type="text"
                                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                            @error('departement')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <!-- Ville / Village -->
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1" for="ville">Ville / Village</label>
                                            <input wire:model="ville" id="ville" type="text"
                                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                            @error('ville')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <!-- Pays (Si hors Burkina) -->
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1" for="pays">Pays </label>
                                            <input wire:model="pays" id="pays" type="text"
                                                class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                            @error('pays')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>
                
                                <!-- Grille pour Nom et Prénom(s) du père et de la mère -->
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Nom et Prénom(s) du père -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_pere">Nom et Prénom(s) du
                                            père</label>
                                        <input wire:model="nom_pere" id="nom_pere" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                        @error('nom_pere')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Nom et Prénom(s) de la mère -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_mere">Nom et Prénom(s) de
                                            la mère</label>
                                        <input wire:model="nom_mere" id="nom_mere" type="text"
                                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
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
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-1">Situation matrimoniale</label>
                                        <div class="flex flex-wrap gap-3 items-center mb-4">
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
                                        <fieldset class="border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                                            <legend class="block text-gray-700 text-sm font-bold mb-2">Personne à prévenir en cas de besoin</legend>
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_prenom_personne_besoin">Nom et prénoms (s)</label>
                                                <input wire:model="nom_prenom_personne_besoin" id="nom_prenom_personne_besoin" type="text"
                                                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                @error('nom_prenom_personne_besoin')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2">
                                                <!-- Lieu de résidence -->
                                                <div>
                                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="lieu_residence">Lieu de résidence</label>
                                                    <input wire:model="lieu_residence" id="lieu_residence" type="text"
                                                        class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                    @error('lieu_residence')
                                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                                    @enderror
                                                </div>
        
                                                <!-- Téléphone -->
                                                <div>
                                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="telephone_personne_prevenir">Téléphone</label>
                                                    <input wire:model="telephone_personne_prevenir" id="telephone_personne_prevenir" 
                                                        type="tel" placeholder="Ex: 77112233"
                                                        pattern="^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$"
                                                        title="Ex. (numéro valide) : +22677020202 ou 77020202"
                                                        class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                    @error('telephone_personne_prevenir')
                                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
        
                                    <div class="col-span-1">
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="photo">Photo</label>
                                        <div class="w-full justify-center border rounded-md p-1 border-gray-500 row-span-3">
                                            @if ($photo)
                                                <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-48 h-48 object-cover mx-auto rounded-full">
                                            @else
                                                <img src="{{ asset('images/user-90.png') }}" alt="Default profile photo" class="w-36 h-36 object-cover mx-auto rounded-full">
                                            @endif
                                        </div>
                                        
                                        <input type="file" wire:model="photo" id="photo" accept="image/jpg, image/jpeg" class="my-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 
                                            file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 
                                            file:text-blue-700 hover:file:bg-violet-100"/>
                                        @error('photo') 
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                </div>
        
                                <div class="overflow-x-auto">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="changeNombreAyantsDroits">Nombre d&apos;ayants-droits (Charge)</label>
                                    <select class="border-2 bg-gray-50 rounded w-full py-1" wire:change="changeNombreAyantsDroits($event.target.value)">
                                        <option value="" disabled selected>Choisissez un nombre</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    @error('nombreAyantsDroits') 
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="col-span-3">
                                    @if ($nombreAyantsDroits > 0)
                                        @for ($i = 0; $i < $nombreAyantsDroits; $i++)
                                            <div class="border bg-gray-100 p-4 rounded mb-2 col-span-3 shadow-lg mt-2">
                                                <h3 class="font-bold mb-2">Ayant Droit {{ $i + 1 }}</h3>
        
                                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                                    <div class="mt-2">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">Nom</label>
                                                        <input type="text" wire:model="ayantsDroits.{{ $i }}.nom" class="border rounded w-full py-1" >
                                                        @error('ayantsDroits.' . $i . '.nom')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">Prénom(s)</label>
                                                        <input type="text" wire:model="ayantsDroits.{{ $i }}.prenom" class="border rounded w-full py-1">
                                                        @error('ayantsDroits.' . $i . '.prenom')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
        
                                                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                                    <div class="mt-2">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">Genre</label>
                                                        <select wire:model="ayantsDroits.{{ $i }}.sexe" class="border rounded w-full py-1">
                                                            <option value="" disabled selected>Sélectionner</option>
                                                            <option value="M">Homme</option>
                                                            <option value="F">Femme</option>
                                                        </select>
                                                        @error('ayantsDroits.' . $i . '.sexe')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">Date de Naissance</label>
                                                        <input type="date" wire:model="ayantsDroits.{{ $i }}.date_naissance" class="border rounded w-full py-1">
                                                        @error('ayantsDroits.' . $i . '.date_naissance')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="block text-gray-700 text-sm font-bold mb-1">Lien de Parenté</label>
                                                        
                                                        <select wire:model="ayantsDroits.{{ $i }}.relation" wire:change="changeLienParente($event.target.value, {{ $i }})" class="border-2 rounded w-full py-1">
                                                            <option value="" disabled selected>Sélectionnez un lien</option>
                                                            <option value="conjoint">Conjoint (e)</option>
                                                            <option value="enfant">Enfant</option>
                                                        </select>
                                                        @error('ayantsDroits.' . $i . '.relation')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
        
                                                <!-- Champ pour la photo de la CNIB si le lien de parenté est "conjoint" -->
                                                @if (isset($ayantsDroits[$i]['relation']) && strtolower($ayantsDroits[$i]['relation']) === 'conjoint')
                                                <div class="mt-4">
                                                    <label class="block text-gray-700 text-sm font-bold mb-1">CNIB (en PDF)</label>
                                                    <div class="w-full justify-center border-2 rounded-md p-1 border-gray-700">
                                                        <input type="file" wire:model="ayantsDroits.{{ $i }}.cnib" class="w-full py-2"  accept='.pdf'>
                                                        
                                                        @error('ayantsDroits.' . $i . '.cnib')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
        
                                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4" wire:key="ayantDroit-{{ $i }}">
                                                <!-- Photo ayant droit -->
                                                <div>
                                                    <label class="block text-gray-700 text-sm font-bold mb-1">Photo de l&apos;ayant droit</label>
                                                    <div class="w-full justify-center border-2 rounded-md p-1 border-gray-700">
                                                        <!-- Upload photo -->
                                                        <input type="file" wire:model="ayantsDroits.{{ $i }}.photo" class="w-full py-2" accept="image/jpg, image/jpeg">
                                                        
                                                        <!-- Afficher une prévisualisation de la photo si elle est uploadée -->
                                                        @if (isset($ayantsDroits[$i]['photo']))
                                                            <img src="{{ $ayantsDroits[$i]['photo']->temporaryUrl() }}" class="w-20 h-20">
                                                        @endif
                                                        
                                                        @error('ayantsDroits.' . $i . '.photo')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            
                                                <!-- Photo de extrait acte de naissance -->
                                                <div>
                                                    <label class="block text-gray-700 text-sm font-bold mb-1">Extrait d&apos;acte de naissance (en PDF)</label>
                                                    <div class="w-full justify-center border-2 rounded-md p-1 border-gray-700">
                                                        <input type="file" wire:model="ayantsDroits.{{ $i }}.extrait" class="w-full py-2"  accept='.pdf'>
        
                                                        @error('ayantsDroits.' . $i . '.extrait')
                                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                                        @enderror
                                                    </div>
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
                                            <input name="statut" type="radio" wire:click="changeStatut('personnel_retraite')" class="form-radio text-indigo-600">
                                            <span class="ml-2">Personnel retraité</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex items-center mt-2">
                                            <input name="statut" type="radio" wire:click="changeStatut('personnel_active')" class="form-radio text-indigo-600">
                                            <span class="ml-2">Personnel en activité</span>
                                        </label>
                                    </div>
                                </div>
        
                                <!-- Champs pour Personnel Retraité -->
                                @if ($statut === 'Retraité(e)')
                                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                        {{-- Grade --}}
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Grade</label>
                                            <select wire:model="grade" class="bg-gray-50  border-2 rounded w-full py-1 mb-0 sm:mb-4">
                                                <option value="" disabled selected>Sélectionnez un grade</option>
                                                @foreach($grades as $gradeOption)
                                                    <option value="{{ $gradeOption }}">{{ $gradeOption }}</option>
                                                @endforeach
                                            </select>
                                            @error('grade')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
        
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Départ à la retraite</label>
                                            <input type="date" wire:model="departARetraite" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                            @error('departARetraite')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
        
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-1">Numéro CARFO</label>
                                            <input type="text" wire:model="numeroCARFO" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
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
                                                <select wire:model="grade" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                    <option value="" disabled selected>Sélectionnez un grade</option>
                                                    @foreach($grades as $gradeOption)
                                                        <option value="{{ $gradeOption }}">{{ $gradeOption }}</option>
                                                    @endforeach
                                                </select>
                                                @error('grade')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
        
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Date d&apos;intégration</label>
                                                <input type="date" wire:model="dateIntegration" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                @error('dateIntegration')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
        
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Date de départ à la retraite</label>
                                                <input type="date" wire:model="dateDepartARetraite" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                @error('dateDepartARetraite')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
        
                                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Direction</label>
                                                <input type="text" wire:model="direction" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                @error('direction')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
        
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-1">Service</label>
                                                <input type="text" wire:model="service" class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                                @error('service')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
        
                        
                        <!-- Étape 5 -->
                        @if ($currentStep == 5)
                            <x-formulaire-adhesion
                                :matricule="$matricule"
                                :nip="$nip"
                                :cnib="$cnib"
                                :delivree="$delivree"
                                :expire="$expire"
                                :adresse-permanente="$adresse_permanente"
                                :telephone="$telephone"
                                :email="$email"
                                :nom="$nom"
                                :prenom="$prenom"
                                :genre="$genre"
                                :departement="$departement"
                                :ville="$ville"
                                :pays="$pays"
                                :nom-pere="$nom_pere"
                                :nom-mere="$nom_mere"
                                :situation-matrimoniale="$situation_matrimoniale"
                                :nom-prenom-personne-besoin="$nom_prenom_personne_besoin"
                                :lieu-residence="$lieu_residence"
                                :telephone-personne-prevenir="$telephone_personne_prevenir"
                                :photo="$photo"
                                :photo-path-adherent="$photo_path_adherent"
                                :photo-path-ayantdroit="$photo_path_ayantdroit"
                                :date-integration="$dateIntegration"
                                :date-depart-a-retraite="$dateDepartARetraite"
                                :direction="$direction"
                                :service="$service"
                                :statut="$statut"
                                :grade="$grade"
                                :depart-a-retraite="$departARetraite"
                                :numero-carfo="$numeroCARFO"
                                :nombre-ayants-droits="$nombreAyantsDroits"
                                :ayants-droits="$ayantsDroits"
                                :signature="$signature"
                                :signature-image="$signatureImage"
                            />
        
                        @endif
                    </div>
        
            
            
                    <!-- Boutons de navigation -->
                    <div class="flex justify-between mt-5">
                        @if ($currentStep > 1)
                            <button wire:click="previousStep" onclick="scrollToTop()"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Précédent
                            </button>
                        @else
                            <div></div> <!-- Un div vide pour garder le bouton "Suivant" aligné à droite -->
                        @endif
            
                        <!-- Bouton "Suivant" ou "Soumettre", toujours aligné à droite -->
                        @if ($currentStep < $totalSteps)
                            <button wire:click="nextStep" onclick="scrollToTop()"
                                class="bg-primary1 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Suivant
                            </button>
                        @else
                            <button wire:click="submit" onclick="scrollToTop()"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Soumettre
                            </button>
                        @endif
                        <script>
                            function scrollToTop() {
                                document.getElementById('wizard-top').scrollIntoView({ behavior: 'smooth' });
                            }
                        </script>
                    </div>
            
                    <!-- Message de succès -->
                    @if (session()->has('message'))
                        <div class="mt-5 p-4 bg-green-200 text-green-800 rounded">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
            @endif
        @endif

    </div>
</div>
