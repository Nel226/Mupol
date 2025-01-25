
<div>
    <!-- Situation matrimoniale -->
    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-2">
            <label class="block text-gray-700 text-sm font-bold mb-1">Situation matrimoniale</label>
            <div class="flex flex-wrap gap-3 items-center mb-4">
                <label class="inline-flex items-center mt-2">
                    <input type="radio" name="situation_matrimoniale" value="Célibataire" class="form-radio text-indigo-600">
                    <span class="ml-2">Célibataire</span>
                </label>
                <label class="inline-flex items-center mt-2">
                    <input type="radio" name="situation_matrimoniale" value="Marié(e)" class="form-radio text-indigo-600">
                    <span class="ml-2">Marié(e)</span>
                </label>
                <label class="inline-flex items-center mt-2">
                    <input type="radio" name="situation_matrimoniale" value="Divorcé(e)" class="form-radio text-indigo-600">
                    <span class="ml-2">Divorcé(e)</span>
                </label>
                <label class="inline-flex items-center mt-2">
                    <input type="radio" name="situation_matrimoniale" value="Veuf(ve)" class="form-radio text-indigo-600">
                    <span class="ml-2">Veuf(ve)</span>
                </label>
            </div>
            <span id="situation_matrimoniale_error" class="text-red-500 text-xs"></span>
            
            <!-- Personne à prévenir en cas de besoin -->
            <fieldset class="border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md bg-gray-100">
                <legend class="block text-gray-700 text-sm font-bold mb-2">Personne à prévenir en cas de besoin</legend>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1" for="nom_prenom_personne_besoin">Nom et prénoms (s)</label>
                    <input name="nom_prenom_personne_besoin" id="nom_prenom_personne_besoin" type="text"
                        class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                    <span id="nom_prenom_personne_besoin_error" class="text-red-500 text-xs"></span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2">
                    <!-- Lieu de résidence -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="lieu_residence">Lieu de résidence</label>
                        <input name="lieu_residence" id="lieu_residence" type="text"
                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                        <span id="lieu_residence_error" class="text-red-500 text-xs"></span>
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="telephone_personne_prevenir">Téléphone</label>
                        <input name="telephone_personne_prevenir" id="telephone_personne_prevenir" 
                            type="tel" placeholder="Ex: 77112233"
                            pattern="^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$"
                            title="Ex. (numéro valide) : +22677020202 ou 77020202"
                            class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                        <span id="telephone_personne_prevenir_error" class="text-red-500 text-xs"></span>
                    </div>
                </div>
            </fieldset>
        </div>

        <div id="photoUpload" class="col-span-1">
            <label class="block text-gray-700 text-sm font-bold mb-1" for="photo">Photo</label>
            <div class="w-full justify-center border rounded-md p-1 border-gray-500 row-span-3">
                <img id="photoPreview" src="{{ asset('images/user-90.png') }}" alt="Profile photo preview" class="w-48 h-48 object-cover mx-auto rounded-full">
            </div>
        
            <!-- Input photo -->
            <input type="file" id="photo" name="photo" accept="image/jpg, image/jpeg, image/png" 
                class="my-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-violet-100"/>
            
            <!-- Error message -->
            {{-- <span id="photoError" class="text-red-500 text-sm" style="display: none;">Veuillez télécharger une photo valide.</span> --}}
        </div>
        
        <script>
            document.getElementById('photo').addEventListener('change', function(event) {
                const photoPreview = document.getElementById('photoPreview');
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = () => {
                        photoPreview.src = reader.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Function to handle situation matrimoniale radio button change
            document.querySelectorAll('input[name="situation_matrimoniale"]').forEach(input => {
                input.addEventListener('change', function() {
                    const selectedValue = document.querySelector('input[name="situation_matrimoniale"]:checked')?.value;
                    console.log('Situation matrimoniale selected:', selectedValue);
                });
            });

            // Function to show/hide step 3 based on condition
            function showStep3() {
                document.getElementById('step3').style.display = 'block';
            }
        </script>
    </div>

    <div class="space-y-4">
        <div class="overflow-x-auto">
            <label class="block text-gray-700 text-sm font-bold mb-1" for="changeNombreAyantsDroits">Nombre d&apos;ayants-droits (Charge)</label>
            <select id="nombreAyantsDroits" name="nombreAyantsDroits class="border-2 bg-gray-50 rounded w-full py-1">
                <option value="" disabled>Choisissez un nombre</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
            <span id="nombreAyantsDroitsError" class="text-red-500 text-sm" style="display:none;">Sélectionnez un nombre valide.</span>
        </div>
    
        <div id="ayantsDroitsContainer"></div>
    
        <script>
            document.getElementById('nombreAyantsDroits').addEventListener('change', function() {
                const nombreAyantsDroits = parseInt(this.value);
                const container = document.getElementById('ayantsDroitsContainer');
                container.innerHTML = ''; // Réinitialiser le contenu existant
    
                if (isNaN(nombreAyantsDroits) || nombreAyantsDroits < 1 || nombreAyantsDroits > 7) {
                    document.getElementById('nombreAyantsDroitsError').style.display = 'block';
                    return;
                } else {
                    document.getElementById('nombreAyantsDroitsError').style.display = 'none';
                }
    
                for (let i = 0; i < nombreAyantsDroits; i++) {
                    const div = document.createElement('div');
                    div.classList.add('border', 'bg-gray-100', 'p-4', 'rounded', 'mb-2', 'col-span-3', 'shadow-lg', 'mt-2');
    
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
                                    <option value="" disabled selected>Sélectionner</option>
                                    <option value="M">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label class="block text-gray-700 text-sm font-bold mb-1">Date de Naissance</label>
                                <input type="date" name="ayantsDroits[${i}][date_naissance]" class="border rounded w-full py-1">
                            </div>
                            <div class="mt-2">
                                <label class="block text-gray-700 text-sm font-bold mb-1">Lien de Parenté</label>
                                <select name="ayantsDroits[${i}][relation]" class="border-2 rounded w-full py-1" onchange="handleRelationChange(${i})">
                                    <option value="" disabled>Sélectionnez un lien</option>
                                    <option value="conjoint">Conjoint (e)</option>
                                    <option value="enfant">Enfant</option>
                                </select>
                            </div>
                        </div>
                        <div id="cnib-field-${i}" class="mt-4" style="display:none;">
                            <label class="block text-gray-700 text-sm font-bold mb-1">CNIB (en PDF)</label>
                            <input type="file" name="ayantsDroits[${i}][cnib]" class="w-full py-2" accept=".pdf">
                        </div>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Photo de l&apos;ayant droit</label>
                                <input type="file" name="ayantsDroits[${i}][photo]" class="w-full py-2" accept="image/jpg, image/jpeg">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1">Extrait d&apos;acte de naissance (en PDF)</label>
                                <input type="file" name="ayantsDroits[${i}][extrait]" class="w-full py-2" accept=".pdf">
                            </div>
                        </div>
                    `;
                    container.appendChild(div);
                }
            });
    
            function handleRelationChange(index) {
                const relationSelect = document.querySelectorAll('select[name^="ayantsDroits[' + index + '][relation]"]')[0];
                const cnibField = document.getElementById('cnib-field-' + index);
    
                if (relationSelect.value === 'conjoint') {
                    cnibField.style.display = 'block'; // Affiche la div CNIB
                } else {
                    cnibField.style.display = 'none'; // Masque la div CNIB
                }
            }
        </script>
    </div>
    
</div>
