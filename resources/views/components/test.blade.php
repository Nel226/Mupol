<div id="membership-form" class="mx-auto w-full max-w-screen-lg px-3 sm:px-5 md:px-7 z-10">
    <div class="w-full md:w-5/6 mx-auto mt-0 md:mt-3">
        <form id="form-membership" enctype="multipart/form-data">
            <div class="mt-4">
                <div id="step-1" class="step" style="display: block;">
                    <div>
                        <label for="matricule">Matricule</label>
                        <input type="text" id="matricule" name="matricule" class="form-input" />
                        <span id="error-matricule" class="error-message"></span>
                    </div>
                </div>

                

                <div id="step-2" class="step" style="display: none;">
                    <div>

                        <div id="photoUpload" class="col-span-1">
                            <label class="block text-gray-700 text-sm font-bold mb-1" for="photo">Photo</label>
                            <div class="w-full justify-center border rounded-md p-1 border-gray-500 row-span-3">
                                <img id="photoPreview" src="{{ asset('images/user-90.png') }}" alt="Profile photo preview" class="w-48 h-48 object-cover mx-auto rounded-full">
                            </div>
                        
                            <!-- Input photo -->
                            <input type="file" id="photo" name="photo" accept="image/jpg, image/jpeg, image/png" 
                                class="my-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-violet-100"/>
                    
                            <!-- Error message -->
                        </div>
                    
                        <div class="space-y-4">
                            <div class="overflow-x-auto">
                                <label class="block text-gray-700 text-sm font-bold mb-1" for="changeNombreAyantsDroits">Nombre d&apos;ayants-droits (Charge)</label>
                                <select id="nombreAyantsDroits" name="nombreAyantsDroits" class="border-2 bg-gray-50 rounded w-full py-1">
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
                </div>

                <div id="step-3" class="step" style="display: none;">
                    <h3>Récapitulatif</h3>
                </div>

                <div class="form-navigation">
                    <button type="button" id="prev-button" class="nav-button" style="display: none;">Précédent</button>
                    <button type="button" id="next-button" class="nav-button">Suivant</button>
                    <button type="submit" id="submit-button" class="nav-button" style="display: none;">Soumettre</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    let currentStep = 1;
    const totalSteps = 3;

    const form = document.getElementById("form-membership");
    const prevButton = document.getElementById("prev-button");
    const nextButton = document.getElementById("next-button");
    const submitButton = document.getElementById("submit-button");

    const steps = document.querySelectorAll(".step");

    const showStep = (step) => {
        steps.forEach((element, index) => {
            element.style.display = index + 1 === step ? "block" : "none";
        });
        prevButton.style.display = step > 1 ? "inline-block" : "none";
        nextButton.style.display = step < totalSteps ? "inline-block" : "none";
        submitButton.style.display = step === totalSteps ? "inline-block" : "none";
    };

    const collectStepData = () => {
    let stepData = {};
        switch (currentStep) {
            case 1: 
                stepData.matricule = document.getElementById("matricule").value;
                break;

            case 2:
                stepData.nombreAyantsDroits = document.getElementById("nombreAyantsDroits").value;

                const ayantsDroits = [];
                const ayantsDroitsInputs = document.querySelectorAll('[name^="ayantsDroits"]');
                
                ayantsDroitsInputs.forEach(input => {
                    const [_, index, field] = input.name.match(/\[(\d+)\]\[(\w+)\]/); // Extraction de l'index et du champ
                    if (!ayantsDroits[index]) ayantsDroits[index] = {};
                    
                    // Collecte la valeur des champs
                    ayantsDroits[index][field] = input.value;

                    // Si c'est un fichier (photo, CNIB, extrait), on les ajoute
                    if (input.type === 'file' && input.files.length > 0) {
                        ayantsDroits[index][field] = input.files[0];  // Envoie le premier fichier sélectionné
                    }
                });

                stepData.ayantsDroits = ayantsDroits;
                break;
            default:
                break;
        }
        return stepData;
    };

const submitFormStep = async (stepData) => {
    try {
        const formData = new FormData();

        // Ajoute les données de l'étape au FormData
        for (const [key, value] of Object.entries(stepData)) {
            if (Array.isArray(value)) {
                value.forEach((item, index) => {
                    for (const [subKey, subValue] of Object.entries(item)) {
                        formData.append(`ayantsDroits[${index}][${subKey}]`, subValue);
                    }
                });
            } else {
                formData.append(key, value);
            }
        }


        // Ajoute l'étape actuelle au FormData
        formData.append("currentStep", currentStep);  // Ajoute l'étape à envoyer

        const response = await fetch('/test/submit', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData // Utilisation de FormData pour envoyer les fichiers
        });

        const data = await response.json();

        if (data.success) {
            console.log('Données envoyées avec succès');
            return true;  // Validation réussie
        } else {
            if (data.errors) {
                displayErrors(data.errors);  // Affichage des erreurs envoyées par le serveur
            }
            return false;  // Validation échouée
        }
        
    } catch (error) {
        console.error('Erreur de connexion:', error);
        return false;  // Erreur de connexion
    }
};

    // Fonction pour afficher les erreurs dans le formulaire
    const displayErrors = (errors) => {
        for (const [field, errorMessages] of Object.entries(errors)) {
            const errorElement = document.getElementById(`error-${field}`);
            if (errorElement) {
                errorElement.innerHTML = errorMessages.join(', ');
                errorElement.style.display = 'block';
            }
        }
    };


    nextButton.addEventListener("click", async () => {
        const stepData = collectStepData();  // Collecte les données du formulaire actuel
        console.log('Données de l\'étape:', stepData); 

        // Envoi des données au serveur avant de passer à l'étape suivante
        const isValid = await submitFormStep(stepData);
        console.log('Validation:', isValid);

        if (isValid && currentStep < totalSteps) {
            currentStep++;
            console.log('Passage à l\'étape suivante:', currentStep);
            showStep(currentStep);
        } else {
            // Les erreurs sont maintenant retournées par la fonction `submitFormStep`
            if (isValid === false) {
                console.log('Validation échouée ou erreur.');
            }
        }
    });





    // Bouton Précédent
    prevButton.addEventListener("click", () => {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    // Affiche l'étape initiale
    showStep(currentStep);
});


</script>
<style>
    .form-input {
        display: block;
        width: 100%;
        margin-bottom: 8px;
        padding: 8px;
    }
    .nav-button {
        margin: 8px;
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }
    .error-message {
        color: red;
        font-size: 12px;
    }
    .preview-image {
        max-width: 100px;
        margin-top: 8px;
    }
</style>
