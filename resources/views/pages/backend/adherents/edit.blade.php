

<x-app-layout >
    @if (session('success'))
    <x-succes-notification>
        {{ session('success') }}
    </x-succes-notification>
    
    @endif
    <x-top-navbar-admin/>

    <div id="sidebar" class="lg:block z-20 hidden  bg-blue-800  w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" class="" />
    
    </div>
   
    <x-content-page-admin>
        @section('breadcrumbs')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        @endsection
        <x-header>
            {{$pageTitle}}
        </x-header>
        <div class="md:p-6 p-2 mx-auto  mt-4 bg-white rounded-lg shadow-lg ">
           
            <div class="w-5/6 mx-auto">
                <h2 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Modifier les informations du mutualiste</h2>
                
                <form method="POST" action="{{ route('adherents.update', $adherent->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                    
                    <dl class="grid gap-3 sm:grid-cols-2 grid-cols-1">

                        <!-- Nom -->
                        <div class="flex items-center space-x-2">
                            <dt class="text-sm font-medium text-gray-900 dark:text-white">Nom :</dt>
                            <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                {{ old('nom', $adherent->nom) }}
                            </dd>
                        </div>
                        <!-- Code carte -->
                        <div class="flex items-center space-x-2">
                            <dt class="text-sm font-medium text-gray-900 dark:text-white">Code carte :</dt>
                            <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                {{ old('code_carte', $adherent->code_carte) }}
                            </dd>
                        </div>
                        

                        
                        <!-- Prénom(s) -->
                        <div class="flex items-center space-x-2">
                            <dt class="text-sm font-medium text-gray-900 dark:text-white">Prénom(s) :</dt>
                            <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                {{ old('prenom', $adherent->prenom) }}
                            </dd>
                        </div>
                        <!-- Téléphone -->
                        <div class="flex items-center space-x-2">
                            <dt class="text-sm font-medium text-gray-900 dark:text-white">Téléphone :</dt>
                            <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                {{ old('telephone', $adherent->telephone) }}
                            </dd>
                        </div>
                        

                        
                        <!-- Matricule -->
                        <div class="flex items-center space-x-2">
                            <dt class="text-sm font-medium text-gray-900 dark:text-white">Matricule :</dt>
                            <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                {{ old('matricule', $adherent->matricule) }}
                            </dd>
                        </div>
                        <!-- Email -->
                        <div class="flex items-center space-x-2">
                            <dt class="text-sm font-medium text-gray-900 dark:text-white">Email :</dt>
                            <dd class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                {{ old('email', $adherent->email) }}
                            </dd>
                        </div>                
                    </dl>
                    
                    <div>
                        
                        <fieldset class=" border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                            <legend class="block text-gray-700 text-base font-bold mb-2">
                                <h6 class="my-3 underline text-blue-900 font-semibold">
                                    <i class="fa fa-pencil-square-o"></i>
                                    Formulaire de modification
                                </h6>
                            </legend>
                            <div class="grid gap-3 sm:grid-cols-2 grid-cols-1 sm:gap-6">
                                <!-- Nom -->
                                <div class="w-full ">
                                    <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                    <input type="text"  name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nom" value="{{ old('nom', $adherent->nom) }}" required>
                                    @error('nom')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Prenom -->
                                <div class="w-full ">
                                    <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom (s)</label>
                                    <input type="text"  name="prenom" id="prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Prénom" value="{{ old('prenom', $adherent->prenom) }}" required>
                                    @error('prenom')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid gap-3 sm:grid-cols-3 grid-cols-1 sm:gap-6 mt-2">

                                <!-- Genre -->
                                <div class="w-full">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre</label>
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <input type="radio" id="genre_masculin" name="genre" value="M" {{ old('genre', $adherent->genre) == 'M' || 'Masculin' ? 'checked' : '' }} required>
                                            <label for="genre_masculin" class="text-sm text-gray-900 dark:text-white">M</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="genre_feminin" name="genre" value="F" {{ old('genre', $adherent->genre) == 'F' || 'Féminin' ? 'checked' : '' }} required>
                                            <label for="genre_feminin" class="text-sm text-gray-900 dark:text-white">F</label>
                                        </div>
                                    </div>
                                    @error('genre')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div> 

                                <!-- Nombre ayants droits -->
                                <div class="w-full">
                                    <label for="nombreAyantsDroits" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de charges</label>
                                    <select name="nombreAyantsDroits" id="nombreAyantsDroits" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                        @for ($i = $adherent->nombreAyantsDroits; $i <= 6; $i++)
                                            <option value="{{ $i }}" {{ old('nombreAyantsDroits', $adherent->charge) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('nombreAyantsDroits')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Telephone -->
    
                                <div class="w-full ">
                                    <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                                    <input type="text"  name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Téléphone" value="{{ old('telephone', $adherent->telephone) }}" required>
                                    @error('telephone')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid gap-3 sm:grid-cols-3 grid-cols-1 sm:gap-6 mt-2">

                                <!-- Service-->
                                <div class="w-full">
                                    <label for="service" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service</label>
                                    <input type="text" name="service" id="service" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('service', $adherent->service) }}" required>
                                    @error('service')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Mensualite-->
                                <div class="w-full">
                                    <label for="mensualite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mensualité</label>
                                    <input type="text" name="mensualite" id="mensualite" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('mensualite', $adherent->mensualite) }}" required>
                                    @error('mensualite')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                        
                                <!-- Date enregistrement -->
                                <div class="w-full">
                                    <label for="date_enregistrement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date d&apos;adhésion</label>
                                    <input type="date" name="date_enregistrement" id="date_enregistrement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('date_enregistrement', $adherent->date_enregistrement) }}" required>
                                    @error('date_enregistrement')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid gap-3  grid-cols-1 sm:gap-6 mt-2">
 
                                <!-- Tableau pour les ayants droits -->
                                    
                                <div class="w-full  mt-1"  id="ayantsDroitsTableContainer" style="display: none; width:100%">
                                    <label for="ayant droits" class="block  text-sm font-medium text-gray-900 dark:text-white">Liste Ayants droit</label>
                                    <div class="overflow-x-auto">
                                        <table class="w-full table-auto min-w-full border bg-white border-gray-300 overflow-x-auto text-sm">
                                            <thead class="bg-gray-100 dark:bg-gray-700">
                                                <tr>
                                                    <th class="border px-1 py-1 text-left text-sm">N°</th>
                                                    <th class="border px-1 py-1 text-left text-sm">Nom</th>
                                                    <th class="border px-1 py-1 text-left text-sm">Prénom</th>
                                                    <th class="border px-1 py-1 text-left text-sm">Sexe</th>
                                                    <th class="border px-1 py-1 text-left text-sm">Date de naissance</th>
                                                    <th class="border px-1 py-1 text-left text-sm">Relation</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ayantsDroitsTableBody" class="!text-xs"></tbody>
                                        </table>

                                    </div>
                                </div>
                                
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const nombreAyantsDroitsSelect = document.getElementById("nombreAyantsDroits");
                                        const ayantsDroits = @json($ayantsDroit); // Transmet les ayants droits depuis PHP
                                        const tableContainer = document.getElementById("ayantsDroitsTableContainer");
                                        const tableBody = document.getElementById("ayantsDroitsTableBody");
                                
                                        // Fonction pour ajouter une rangée
                                        const addRow = (index, data = {}) => {
                                            const row = document.createElement("tr");
                                            row.innerHTML = `
                                                <td class="border px-1 py-1">
                                                    <input type="text" readonly value="${index + 1}" name="ayantsDroits[${index}][position]" class="w-8 border rounded-md text-xs" required>
                                                </td>
                                                <td class="border px-1 py-1">
                                                    <input type="text" name="ayantsDroits[${index}][nom]" class="w-full p-2 border rounded-md text-xs" value="${data.nom || ''}" required>
                                                </td>
                                                <td class="border px-1 py-1">
                                                    <input type="text" name="ayantsDroits[${index}][prenom]" class="w-full p-2 border rounded-md text-xs" value="${data.prenom || ''}" required>
                                                </td>
                                                <td class="border px-1 py-1">
                                                    <select name="ayantsDroits[${index}][sexe]" class="w-full p-2 border rounded-md text-xs" required>
                                                        <option value="" disabled ${!data.sexe ? 'selected' : ''}>-- Sexe --</option>
                                                        <option value="M" ${data.sexe === 'M' ? 'selected' : ''}>M</option>
                                                        <option value="F" ${data.sexe === 'F' ? 'selected' : ''}>F</option>
                                                    </select>
                                                </td>
                                                <td class="border px-1 py-1">
                                                    <input type="date" name="ayantsDroits[${index}][date_naissance]" class="w-full p-2 border rounded-md text-xs" value="${data.date_naissance || ''}" required>
                                                </td>
                                                <td class="border px-2 py-1">
                                                    <select name="ayantsDroits[${index}][relation]" class="w-full p-2 border rounded-md text-xs" required>
                                                        <option value="" disabled ${!data.relation ? 'selected' : ''}>-- Relation --</option>
                                                        <option value="Enfant" ${data.relation === 'Enfant' ? 'selected' : ''}>Enfant</option>
                                                        <option value="Conjoint(e)" ${data.relation === 'Conjoint(e)' ? 'selected' : ''}>Conjoint(e)</option>
                                                    </select>
                                                </td>
                                            `;
                                            tableBody.appendChild(row);
                                        };
                                
                                        // Populate existing data on page load
                                        if (ayantsDroits.length > 0) {
                                            nombreAyantsDroitsSelect.value = ayantsDroits.length;
                                            ayantsDroits.forEach((ayantDroit, index) => addRow(index, ayantDroit));
                                            tableContainer.style.display = "block";
                                        } else {
                                            nombreAyantsDroitsSelect.dispatchEvent(new Event("change"));
                                        }
                                
                                        // Événement change pour le select nombreAyantsDroits
                                        nombreAyantsDroitsSelect.addEventListener("change", function () {
                                            const nombre = parseInt(this.value);
                                            const mensualite = document.getElementById("mensualite")
                                            mensualite.value = 5000 + 2000* nombre;
                                            tableBody.innerHTML = ""; // Clear previous rows
                                            if (nombre > 0) {
                                                tableContainer.style.display = "block";
                                                for (let i = 0; i < nombre; i++) {
                                                    addRow(i, ayantsDroits[i] || {});
                                                }
                                            } else {
                                                tableContainer.style.display = "none";
                                            }
                                        });
                                    });
                                </script>
                                
                            </div>

                        </fieldset>
                    
                       
                    </div>
                   
                    <div class="flex justify-end">
                        <x-primary-button type="submit" class="mt-5 ">
                            Modifier
                        </x-primary-button>
            
                    </div>
                </form>
            </div>
            
        </div>
    </x-content-page-admin>
    
</x-app-layout>

