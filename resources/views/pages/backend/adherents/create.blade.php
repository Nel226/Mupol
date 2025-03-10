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
                    <h2 class="mb-4 text-sm md:text-lg lg:text-xl font-bold text-gray-900 dark:text-white">Enregistrer un nouvel adhérent</h2>
                    
                    <form method="POST" action="{{ route('adherents.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-2 gap-6 sm:col-span-1">
                            
                            <div class="w-full row-span-3">
                                <div class="shrink-0">
                                    <img id='preview_img' class="object-cover w-48 h-48 rounded-full" src="{{ asset('images/user-90.png') }}" alt="Current profile photo" />
                                </div>
                                <span class="sr-only">Choisir une image</span>
                                <input type="file" id="photo" name="photo" required onchange="loadFile(event)"  class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-violet-100" />
                            </div>
                            
                            <!-- Script pour prévisualiser limage -->
                            <script>
                                var loadFile = function(event) {
                                    var input = event.target;
                                    var file = input.files[0];
                                    var type = file.type;
                                    var output = document.getElementById('preview_img');
                                    output.src = URL.createObjectURL(event.target.files[0]);
                                    output.onload = function() {
                                        URL.revokeObjectURL(output.src) 
                                    }
                                };
                            </script>
                            
                            <div class="w-full">
                                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nom de l'adhérent" required>
                            </div>
                            <div class="w-full">
                                <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                <input type="text" name="prenom" id="prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Prénom de l'adhérent" required>
                            </div>
                            <div class="w-full">
                                <label for="matricule" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N° Matricule</label>
                                <input type="number" name="matricule" id="matricule" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Numéro de matricule" required>
                            </div>
                           
                        </div>
                       
                        <fieldset class=" border-2 border-slate-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-slate-200">
                            <legend class="block text-gray-700 text-sm font-bold mb-2">Divisions administratives</legend>
                            
                            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 grid-cols-1 sm:gap-6">
        
                
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
                                <!-- Localité -->
                                <div class="w-full">
                                    <label for="localite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Localité</label>
                                    <input type="text" name="localite" id="localite" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    @error('localite')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class=" border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                            <legend class="block text-gray-700 text-sm font-bold mb-2">1. Références</legend>
                            <div class="grid gap-3 sm:grid-cols-2 grid-cols-1 sm:gap-6">
                                <!-- NIP -->
                                <div class="w-full">
                                    <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                                    <input type="text" name="nip" id="nip" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required>
                                    @error('nip')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <!-- CNIB -->
                                <div class="w-full">
                                    <label for="cnib" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CNIB</label>
                                    <input type="text" name="cnib" id="cnib" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    @error('cnib')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <!-- Délivrée -->
                                <div class="w-full">
                                    <label for="delivree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Délivrée le</label>
                                    <input type="date" name="delivree" id="delivree" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required>
                                    @error('delivree')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <!-- Expire -->
                                <div class="w-full">
                                    <label for="expire" class="block mb-2 text-sm bg-gray-50 font-medium text-gray-900 dark:text-white">Expire le</label>
                                    <input type="date" name="expire" id="expire" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required>
                                    @error('expire')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const delivreeInput = document.getElementById('delivree');
                                        const expireInput = document.getElementById('expire');
                                
                                        // Fonction pour ajouter 10 ans à la date de délivrance
                                        function updateExpireDate() {
                                            const delivreeDate = new Date(delivreeInput.value);
                                            if (delivreeDate.getFullYear() !== 1970) { // Assure que la date est valide
                                                delivreeDate.setFullYear(delivreeDate.getFullYear() + 10); // Ajouter 10 ans
                                                delivreeDate.setDate(delivreeDate.getDate() - 1); // Soustraire 1 jour

                                                // Formater la nouvelle date au format YYYY-MM-DD
                                                const expireDate = delivreeDate.toISOString().split('T')[0];
                                                expireInput.value = expireDate;
                                            }
                                        }
                                
                                        // Ajouter un événement pour mettre à jour la date d'expiration lorsqu'une date est sélectionnée
                                        delivreeInput.addEventListener('change', updateExpireDate);
                                
                                        // Initialiser la date d'expiration au chargement de la page si une date de délivrance est déjà sélectionnée
                                        if (delivreeInput.value) {
                                            updateExpireDate();
                                        }
                                    });
                                </script>
                                <!-- Adresse -->
    
                                <div class="w-full ">
                                    <label for="adresse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                                    <input type="text"  name="adresse" id="adresse" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Adresse" required>
                                    @error('adresse')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="w-full ">
                                    <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                                    <input type="number"  name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Numéro" required>
                                    @error('telephone')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full ">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="email"  name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Adresse email" required>
                                    @error('email')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class=" border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                            <legend class="block text-gray-700 text-sm font-bold mb-2">2. Etat civil</legend>
                            <div class="grid gap-3 sm:grid-cols-2 grid-cols-1 sm:gap-6">
                                <!-- Genre -->
                                <div class="w-full">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre</label>
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <input type="radio" id="genre_masculin" name="genre" value="M"  required>
                                            <label for="genre_masculin" class="text-sm text-gray-900 dark:text-white">Masculin</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="genre_feminin" name="genre" value="F" required>
                                            <label for="genre_feminin" class="text-sm text-gray-900 dark:text-white">Féminin</label>
                                        </div>
                                    </div>
                                    @error('genre')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div> 
                                <div class="w-full col-span-2" >
                                    <fieldset class=" border-2 border-slate-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-slate-200">
                                        <legend class="block text-gray-700 text-sm font-bold mb-2">Lieu de naissance</legend>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <!-- Département -->
                                            <div class="w-full">
                                                <label for="departement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Département</label>
                                                <input type="text" name="departement" id="departement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required>
                                                @error('departement')
                                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                    
                                            <!-- Ville -->
                                            <div class="w-full">
                                                <label for="ville" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ville</label>
                                                <input type="text" name="ville" id="ville" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                                @error('ville')
                                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                    
                                            <!-- Pays -->
                                            <div class="w-full">
                                                <label for="pays" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pays</label>
                                                <input type="text" name="pays" id="pays" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required>
                                                @error('pays')
                                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </fieldset>
                                </div> 

                                <!-- Nom du père -->
                                <div class="w-full">
                                    <label for="nom_pere" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom et prénom du père</label>
                                    <input type="text" name="nom_pere" id="nom_pere" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required>
                                    @error('nom_pere')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <!-- Nom de la mère -->
                                <div class="w-full">
                                    <label for="nom_mere" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom et prénom de la mère</label>
                                    <input type="text" name="nom_mere" id="nom_mere" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    @error('nom_mere')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                            </div>
                        </fieldset>
                        <fieldset class="border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                            <legend class="block text-gray-700 text-sm font-bold mb-2">3. Informations personnelles</legend>
                            <div class="grid gap-3 sm:grid-cols-2 grid-cols-1 sm:gap-6">
                                <!-- Situation matrimoniale -->
                                <div class="w-full">
                                    <label for="situation_matrimoniale" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Situation matrimoniale</label>
                                    <select name="situation_matrimoniale" id="situation_matrimoniale" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                        <option value="Célibataire" >Célibataire</option>
                                        <option value="Marié(e)" >Marié(e)</option>
                                        <option value="Divorcé(e)" >Divorcé(e)</option>
                                    
                                        <option value="Veuf(ve)">Veuf(ve)</option>
                                    </select>
                                    @error('situation_matrimoniale')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <!-- Nombre ayants droits -->
                                <div class="w-full">
                                    <label for="nombreAyantsDroits" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre d’ayants droits</label>
                                    <select name="nombreAyantsDroits" id="nombreAyantsDroits" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                        @for ($i = 0; $i <= 6; $i++)
                                            <option value="{{ $i }}" >{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('nombreAyantsDroits')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <fieldset class="col-span-2 border-2 border-slate-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-slate-200">
                                    <legend class="block text-gray-700 text-sm font-bold mb-2">Personne à prévenir</legend>
                                    <div class="grid gap-3 sm:grid-cols-2 grid-cols-1 sm:gap-6">
                                        <!-- Nom et prénom de la personne à prévenir -->
                                        <div class="w-full col-span-2">
                                            <label for="nom_prenom_personne_besoin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom et prénom de la personne à prévenir</label>
                                            <input type="text" name="nom_prenom_personne_besoin" id="nom_prenom_personne_besoin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required>
                                            @error('nom_prenom_personne_besoin')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                
                                        <!-- Lieu de résidence -->
                                        <div class="w-full">
                                            <label for="lieu_residence" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lieu de résidence</label>
                                            <input type="text" name="lieu_residence" id="lieu_residence" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required>
                                            @error('lieu_residence')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                
                                        <!-- Téléphone personne à prévenir -->
                                        <div class="w-full">
                                            <label for="telephone_personne_prevenir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone de la personne à prévenir</label>
                                            <input type="number" name="telephone_personne_prevenir" id="telephone_personne_prevenir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required>
                                            @error('telephone_personne_prevenir')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </fieldset>
 

                                <!-- Tableau pour les ayants droits -->
                                
                                <div class="w-full col-span-2 mt-1"  id="ayantsDroitsTableContainer" style="display: none; width:100%">
                                    <label for="ayant droits" class="block  text-sm font-medium text-gray-900 dark:text-white">Liste Ayants droit</label>
                                    <table class="w-full table-auto min-w-full border bg-white border-gray-300 overflow-x-auto text-sm">
                                        <thead class="bg-gray-100 dark:bg-gray-700">
                                            <tr>
                                                <th class="border px-1 py-1 text-left text-sm">N°</th>
                                                <th class="border px-1 py-1 text-left text-sm">Nom</th>
                                                <th class="border px-1 py-1 text-left text-sm">Prénom</th>
                                                <th class="border px-1 py-1 text-left text-sm">Genre</th>
                                                <th class="border px-1 py-1 text-left text-sm">Date de naissance</th>
                                                <th class="border px-1 py-1 text-left text-sm">Relation</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ayantsDroitsTableBody" class="!text-xs"></tbody>
                                    </table>
                                </div>
                                
                                <script>

                                    document.addEventListener("DOMContentLoaded", function () {
                                        const nombreAyantsDroitsSelect = document.getElementById("nombreAyantsDroits");
                                        const tableContainer = document.getElementById("ayantsDroitsTableContainer");
                                        const tableBody = document.getElementById("ayantsDroitsTableBody");
                                
                                        nombreAyantsDroitsSelect.addEventListener("change", function () {
                                            const nombre = parseInt(this.value);
                                            tableBody.innerHTML = ""; // Clear previous rows
                                
                                            if (nombre > 0) {
                                                tableContainer.style.display = "block";
                                                tableContainer.style.width = "100%";

                                                for (let i = 0; i < nombre; i++) {
                                                    const row = document.createElement("tr");
                                
                                                    row.innerHTML = `
                                                        <td class="border px-1 py-1 ">
                                                            <input type="text" readonly value="${i+1}" name="ayantsDroits[${i}][position]" class="w-8 border rounded-md text-xs" required>
                                                        </td>
                                                        <td class="border px-1 py-1 ">
                                                            <input type="text" name="ayantsDroits[${i}][nom]" class="w-full p-2 border rounded-md text-xs" required>
                                                        </td>
                                                        <td class="border px-1 py-1">
                                                            <input type="text" name="ayantsDroits[${i}][prenom]" class="w-full p-2 border rounded-md text-xs" required>
                                                        </td>
                                                        <td class="border px-1 py-1">
                                                            <select name="ayantsDroits[${i}][sexe]" class="w-full p-2 border rounded-md text-xs" required>
                                                                <option value="" disabled selected>-- Genre --</option>
                                                                <option value="M">M</option>
                                                                <option value="F">F</option>
                                                            </select>
                                                        </td>
                                                        <td class="border px-1 py-1">
                                                            <input type="date" name="ayantsDroits[${i}][date_naissance]" class="w-full p-2 border rounded-md text-xs" required>
                                                        </td>
                                                        <td class="border px-2 py-1">
                                                            <select name="ayantsDroits[${i}][relation]" class="w-full p-2 border rounded-md text-xs" required>
                                                                <option value="" disabled selected>-- Relation --</option>
                                                                <option value="Enfant">Enfant</option>
                                                                <option value="Conjoint(e)">Conjoint(e)</option>
                                                            </select>
                                                        </td>
                                                    `;
                                
                                                    tableBody.appendChild(row);
                                                }
                                            } else {
                                                tableContainer.style.display = "none";
                                            }
                                        });
                                
                                        // Trigger change event on page load to populate existing data
                                        nombreAyantsDroitsSelect.dispatchEvent(new Event("change"));
                                    });
                                </script>
                                

                                
                            </div>


                        </fieldset>
                        <fieldset class="border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                            <legend class="block text-gray-700 text-sm font-bold mb-2">4. Informations professionnelles</legend>
                            
                            <!-- Statut -->
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statut</label>
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <input type="radio" id="personnel_retraite" name="statut" value="Retraité(e)" required onclick="handleStatutChange('retraite')">
                                        <label for="personnel_retraite" class="text-sm text-gray-900 dark:text-white">Retraité</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="personnel_active" name="statut" value="Actif(ve)" required onclick="handleStatutChange('actif')">
                                        <label for="personnel_active" class="text-sm text-gray-900 dark:text-white">En activité</label>
                                    </div>
                                </div>
                                @error('statut')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid gap-3 sm:grid-cols-2 grid-cols-1 sm:gap-6">
                                <!-- Champs pour retraité -->
                                <div id="retraiteFields" class="hidden ">
                                    <div class="w-full">
                                        <label for="numeroCARFO" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro CARFO</label>
                                        <input type="text" name="numeroCARFO" id="numeroCARFO" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                   
                                </div>
                            
                                <!-- Champs pour actif -->
                                <div id="actifFields" class="hidden ">
                                    <div class="w-full">
                                        <label for="dateIntegration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date d&apos;intégration</label>
                                        <input type="date" name="dateIntegration" id="dateIntegration" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                </div>
    
                                <!-- dateDepartARetraite-->
                                <div class="w-full">
                                    <label for="dateDepartARetraite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de départ retraite</label>
                                    <input type="date" name="dateDepartARetraite" id="dateDepartARetraite" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    @error('dateDepartARetraite')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid gap-3 sm:grid-cols-2 md:grid-cols-3 grid-cols-1 sm:gap-6">

                                <!-- Grade -->
                                <div class="w-full">
                                    <label for="grade" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grade</label>
                                    <select name="grade" id="grade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                        <option value="" disabled selected>-- Sélectionnez un grade --</option>
                                    </select>
                                    @error('grade')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
    
                                <script>
                            
                            
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const regionSelect = document.getElementById("region");
                                        const provinceSelect = document.getElementById("province");
                                        const gradeSelect = document.getElementById("grade");
    
                                        for (const region in regions) {
                                            const option = document.createElement("option");
                                            option.value = region;
                                            option.textContent = region;
                                            regionSelect.appendChild(option);
                                        }
                                        grades.forEach(grade => {
                                            const option = document.createElement("option");
                                            option.value = grade;
                                            option.textContent = grade;
                                            gradeSelect.appendChild(option);
                                        });
                                        
                                    
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
                                <!-- Service-->
                                <div class="w-full">
                                    <label for="service" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service</label>
                                    <input type="text" name="service" id="service" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    @error('service')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Direction-->
                                <div class="w-full">
                                    <label for="direction" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direction</label>
                                    <input type="text" name="direction" id="direction" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    @error('direction')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </fieldset>
                        
                        <script>
                            // Fonction pour afficher/masquer les champs selon le statut
                            function handleStatutChange(statut) {
                                const retraiteFields = document.getElementById('retraiteFields');
                                const actifFields = document.getElementById('actifFields');
                        
                                if (statut === 'retraite') {
                                    retraiteFields.classList.remove('hidden');
                                    actifFields.classList.add('hidden');
                                } else if (statut === 'actif') {
                                    actifFields.classList.remove('hidden');
                                    retraiteFields.classList.add('hidden');
                                }
                            }
                        </script>
                        

                        <div class="grid gap-3 sm:grid-cols-2 grid-cols-1 sm:gap-6">
    
    
                            <!-- Date enregistrement -->
                            <div class="w-full">
                                <label for="date_enregistrement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date d&apos;adhésion</label>
                                <input type="date" name="date_enregistrement" id="date_enregistrement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                @error('date_enregistrement')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="w-full">
                                <label for="mensualite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mensualité</label>
                                <input readonly type="number" name="mensualite" id="mensualite" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mensualité de l'adhérent" required>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const chargeSelect = document.getElementById('nombreAyantsDroits');
                                    const mensualiteInput = document.getElementById('mensualite');
                                    
                                    function calculerMensualite(charge) {
                                        return 5000 + 2000 * charge;
                                    }
                                    
                                    mensualiteInput.value = calculerMensualite(parseInt(chargeSelect.value));
                                    
                                    // Écouter les changements de la sélection de charge
                                    chargeSelect.addEventListener('change', function() {
                                        mensualiteInput.value = calculerMensualite(parseInt(chargeSelect.value));
                                    });
                                });
                            </script>
                            
                        </div>
		                    
                        <!-- Bouton denvoi -->
                        <div class=" flex justify-end mt-3">

                            <button type="submit" class="btn bg-primary1 text-sm">
                                Création Adhérent
                            </button>
                        </div>
                    </form>
                   
                </div>
            @endrole
        </div>
    </x-content-page-admin>
</x-app-layout>




