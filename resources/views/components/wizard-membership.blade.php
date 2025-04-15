<div class="mx-auto w-full max-w-screen-lg px-3 sm:px-5 md:px-7 z-10">
    <div class="w-full md:w-5/6 mx-auto mt-0 md:mt-3">
        <div class="mt-4">
            <!-- Stepper pour les petits écrans < 640px -->
            <ul class="flex flex-col justify-center items-center mb-4 md:mb-6 sm:hidden" id="stepper-mobile">
                <!-- Contenu dynamique injecté par JavaScript -->
            </ul>

            <!-- Stepper pour les grands écrans (> 640px) -->
            <div class="flex-stepper justify-between items-center mb-4 md:mb-6 hidden sm:flex" id="stepper-desktop">
                <!-- Contenu dynamique injecté par JavaScript -->
            </div>

            <!-- Affichage dynamique des étapes -->
            <form id="membership-form" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Contenu de l'étape 1 -->
                <div id="step1" class="step">
                    <x-etape-un />
                </div>

                <!-- Contenu de l'étape 2 -->
                <div id="step2" class="step" style="display:none;">
                    <x-etape-deux />
                </div>

                <!-- Contenu de l'étape 3 -->
                <div id="step3" class="step" style="display:none;">
                    <x-etape-trois />
                </div>
                
                <!-- Contenu de l'étape 4 -->
                <div id="step4" class="step" style="display:none;">
                    <x-etape-quatre />
                </div>

                <!-- Contenu de l'étape 5 -->
                <div id="step5" class="step" style="display:none;">
                    <x-formulaire-adhesion :data:$data />
                </div>

                <input type="hidden" name="currentStep" id="currentStep">

                <!-- Boutons de navigation -->
                <div class="flex mt-4">
                    <button id="prevBtn" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" style="display:none;">
                        Précédent
                    </button>
                    <div class="ml-auto flex space-x-2">
                        <button id="nextBtn" type="button" class="bg-primary1 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Suivant
                        </button>
                        <button id="submitBtn" type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" style="display:none;">
                            Soumettre
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const totalSteps = 5;
    let currentStep = 1;
    let allStepData = {};

    // **********************************************  Stepper  ******************************************************************
    // Fonction pour mettre à jour l'affichage du stepper
    function updateStepper() {
        const stepperMobile = document.getElementById('stepper-mobile');
        const stepperDesktop = document.getElementById('stepper-desktop');
        
        // Mettre à jour les étapes pour le mobile
        stepperMobile.innerHTML = '';
        for (let step = 1; step <= totalSteps; step++) {
            const stepItem = document.createElement('li');
            stepItem.classList.add('flex', 'justify-center', 'items-center', 'w-full', 'mb-2', 'sm:mb-4');
            stepItem.innerHTML = `
                <div class="flex flex-col items-center w-full rounded-xl border ${currentStep >= step ? 'border-primary1 bg-primary1' : 'border-gray-300 bg-white'}">
                    <div class="flex items-center justify-center w-full" onclick="setStep(${step})">
                        <span class="text-sm sm:text-xl py-2 mx-2 text-black ${currentStep === step ? 'text-white' : 'text-gray-700'}">${step}.</span>
                        <span class="step-title text-sm ${currentStep === step ? 'text-white' : 'text-gray-600'}">
                            ${step === 1 ? 'Références de l\'adhérent' : step === 2 ? 'Etat civil' : step === 3 ? 'Informations personnelles' : step === 4 ? 'Informations professionnelles' : 'Récapitulatif'}
                        </span>
                    </div>
                </div>
            `;
            stepperMobile.appendChild(stepItem);
        }

        // Mettre à jour le stepper pour les grands écrans
        stepperDesktop.innerHTML = '';
        for (let step = 1; step <= totalSteps; step++) {
            const stepItem = document.createElement('div');
            stepItem.classList.add('flex', 'flex-col', 'items-center', 'flex-1');

            // Générer le contenu du step
            stepItem.innerHTML = `
                <div class="relative flex items-center w-full" onclick="setStep(${step})" style="align-items: center;">
                    <!-- Ligne avant le cercle - invisible pour le premier step -->
                    ${step > 1 ? `<div class="flex-1 h-1 ${currentStep >= step ? 'bg-primary1' : 'bg-gray-300'}" style="height: 3px;"></div>` : '<div class="flex-1 h-1 invisible" style="height: 3px;"></div>'}
                    
                    <!-- Cercle -->
                    <div class="w-8 h-8 flex shadow-lg items-center justify-center rounded-full text-white z-10 transition-all duration-200 ${currentStep >= step ? 'bg-primary1' : 'bg-gray-300'}">
                        ${currentStep > step ? '<i class="fa fa-check"></i>' : `<span>${step}</span>`}
                    </div>

                    <!-- Ligne après le cercle - invisible pour le dernier step -->
                    ${step < totalSteps ? `<div class="flex-1 h-1 ${currentStep > step ? 'bg-primary1' : 'bg-gray-300'}" style="height: 3px;"></div>` : '<div class="flex-1 h-1 invisible" style="height: 3px;"></div>'}
                </div>

                <!-- Texte du step avec une hauteur fixe -->
                <div class="text-xs text-center w-full overflow-hidden" style="height: 40px; margin-top: 8px; display: flex; justify-content: center; align-items: flex-start;">
                    <p class="step-label">
                        ${step === 1 ? 'Références de l\'adhérent' :
                        step === 2 ? 'Etat civil' :
                        step === 3 ? 'Informations personnelles' :
                        step === 4 ? 'Informations professionnelles' : 
                        'Récapitulatif'}
                    </p>
                </div>
            `;

            // Ajouter l'élément au stepper
            stepperDesktop.appendChild(stepItem);
        }

    }

    // Fonction pour changer d'étape
    function setStep(step) {
        currentStep = step;
        updateStepper();
        showStep();
    }

    // Fonction pour afficher l'étape courante
    function showStep() {
        // Masquer toutes les étapes
        for (let i = 1; i <= totalSteps; i++) {
            document.getElementById(`step${i}`).style.display = 'none';
        }
        // Afficher l'étape courante
        document.getElementById(`step${currentStep}`).style.display = 'block';

        // Mettre à jour le bouton "Précédent" et "Suivant"
        document.getElementById('prevBtn').style.display = currentStep > 1 ? 'inline-block' : 'none';
        document.getElementById('nextBtn').style.display = currentStep < totalSteps ? 'inline-block' : 'none';
        document.getElementById('submitBtn').style.display = currentStep === totalSteps ? 'inline-block' : 'none';
    }

    // Fonction pour soumettre le formulaire
    async function handleSubmit(event) {
        event.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true; // Désactiver le bouton
        submitBtn.innerHTML = 'Envoi en cours...'; // Ajouter un indicateur de chargement

        const formData = new FormData(document.getElementById('membership-form'));
        formData.append('currentStep', currentStep);

        try {
            const response = await fetch('{{ route('test.submit') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: formData,
            });

            const data = await response.json();

            if (data.success) {
                window.location.href = data.redirect_url;
                resetForm();
            } else {
                showErrors(data.errors);
                alert('Une erreur s\'est produite.');
            }
        } catch (error) {
            console.error('Erreur lors de la soumission :', error);
            alert('Une erreur réseau est survenue.');
        } finally {
            submitBtn.disabled = false; // Réactiver le bouton
            submitBtn.innerHTML = 'Soumettre'; // Réinitialiser le texte du bouton
        }
    }


    // Initialiser l'affichage du formulaire
    document.getElementById('membership-form').addEventListener('submit', handleSubmit);
    setStep(currentStep);

    // **********************************************  Fin Stepper  ******************************************************************


    // **********************************************  Fonctions  ******************************************************************
    // Collecte des données par étape

    function collectStepData() {
        let data = new FormData(); 
        const stepId = `step${currentStep}`; 
        const stepElement = document.getElementById(stepId);

        // Parcours de tous les champs de l'étape courante (input, select, textarea)
        const inputs = stepElement.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (input.name) { 
                if (input.type === "file") {
                    // Si c'est un fichier, on ajoute le fichier à FormData
                    const files = input.files;
                    for (let i = 0; i < files.length; i++) {
                        data.append(input.name, files[i]);
                    }
                } else {
                    // Sinon, on ajoute la valeur du champ
                    data.append(input.name, input.value);
                }
            }
        });

        // Ajouter l'étape courante aux données
        data.append('currentStep', currentStep);

        // Affichage du log des données collectées dans la console
        console.log("Données collectées pour l'étape", currentStep);
        console.table(data);

        return data;
    }
    function collectAllStepsData() {
        if (currentStep === 4) { // Ne collecte les données que lorsque l'on est à l'étape 4
            let allStepData = {}; // Initialiser un objet vide pour les données

            // Collecte des données des étapes 1, 2, 3 et 4
            for (let step = 1; step <= 4; step++) {
                const stepId = `step${step}`;
                const stepElement = document.getElementById(stepId);

                // Si l'élément de l'étape existe, on collecte les données
                if (stepElement) {
                    const inputs = stepElement.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => {
                        if (input.name) {
                            if (input.type === "file") {
                                // Si c'est un fichier, on stocke le nom du fichier
                                const files = input.files;
                                let fileData = [];
                                for (let i = 0; i < files.length; i++) {
                                    fileData.push(files[i].name); // On ajoute le nom du fichier ici
                                }
                                allStepData[input.name] = fileData;
                            } else {
                                // Sinon, on ajoute la valeur du champ
                                allStepData[input.name] = input.value;
                            }
                        }
                    });
                }
            }

            // Ajouter l'étape courante aux données
            allStepData.currentStep = currentStep;

            // Affichage du log des données collectées dans la console
            console.log("Données collectées pour les étapes 1 à 4 :");
            console.table(allStepData);

            // Envoi des données à la fonction souhaitée
            sendDataToRecapt(allStepData); // Envoi des données au composant à l'étape 5
        }
    }

    // Fonction pour envoyer les données collectées au contrôleur
async function sendDataToRecapt(allStepData) {
    try {
        const response = await fetch("{{ route('recapt.data') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // CSRF token pour sécurité
                'Content-Type': 'application/json', // Envoyer des données au format JSON
            },
            body: JSON.stringify(allStepData), // Convertir les données en JSON avant l'envoi
        });

        const data = await response.json(); // Attendre la réponse JSON du serveur

        if (data.success) {
            console.log("Données envoyées avec succès !");
            // Vous pouvez rediriger ou traiter la réponse comme nécessaire
        } else {
            console.log("Erreur lors de l'envoi des données :", data.errors);
        }
    } catch (error) {
        console.error("Erreur lors de l'envoi des données au serveur :", error);
    }
}





    // Envoi des données au serveur ----------------------------------------------------
async function sendStepDataToServer() {
    const data = collectStepData(); // Collecte des données de l'étape en cours (y compris les fichiers)

    const response = await fetch('{{ route('test.submit') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // CSRF token pour sécurité
        },
        body: data, // Envoi de FormData directement, pas besoin de JSON.stringify
    });

    const responseData = await response.json(); // Récupération de la réponse JSON du serveur

    if (responseData.success) {
        // Si les données sont validées, passer à l'étape suivante
        goToNextStep();
    } else {
        // Afficher les erreurs de validation
        showErrors(responseData.errors);
    }
}


    // Afficher les erreurs -----------------------------------------------------------
    // Fonction qui convertit une clé d'erreur (format dot) en sélecteur correspondant au nom de l'input
function convertErrorKeyToInputName(key) {
    // Si la clé contient un point, on la transforme
    if (key.indexOf('.') !== -1) {
        const parts = key.split('.');
        // Le premier élément reste tel quel, puis on enveloppe chaque partie suivante entre crochets
        return parts.shift() + parts.map(part => `[${part}]`).join('');
    }
    return key;
}

// Fonction pour afficher les erreurs sur le formulaire
    function showErrors(errors) {
        // Supprimer les anciens messages d'erreur
        document.querySelectorAll('.error-message').forEach(message => message.remove());

        // Parcourir chaque champ ayant une erreur
        Object.keys(errors).forEach(field => {
            const errorMessages = errors[field].join(', ');

            // Essayer de récupérer l'input avec le nom tel quel
            let input = document.querySelector(`[name="${field}"]`);

            // Si l'input n'est pas trouvé et que la clé contient un point, essayer la conversion
            if (!input && field.indexOf('.') !== -1) {
                const convertedName = convertErrorKeyToInputName(field);
                input = document.querySelector(`[name="${convertedName}"]`);
            }

            // Si l'input est trouvé, ajouter un élément pour l'erreur
            if (input) {
                const errorDiv = document.createElement('div');
                errorDiv.className = "error-message text-red-500 text-xs mt-2";
                errorDiv.innerText = errorMessages;
                // Vous pouvez ajuster l'endroit où l'erreur est affichée (ici, on l'ajoute dans le parent direct)
                input.parentElement.appendChild(errorDiv);
            }
        });
    }


    // Navigation vers l'étape suivante ----------------------------------------------
    function goToNextStep() {
        currentStep++; 
        updateStepper(); 
        showStep();
    }
    
    // Navigation vers l'étape précédente ----------------------------------------------
    function goToPreviousStep() {
        currentStep--; 
        updateStepper(); 
        showStep(); 
    }

    // Renitialiser le formulaire --------------------------------------------------------
    function resetForm() {
        const form = document.getElementById('membership-form');
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            if (input.type === 'file') {
                input.value = ''; 
            } else if (input.type === 'checkbox' || input.type === 'radio') {
                input.checked = false; 
            } else {
                input.value = ''; 
            }
        });

        // Réinitialiser l'étape courante à 1
        currentStep = 1;
        updateStepper();
        showStep();
    }

    // Fonction de navigation vers l'étape précédente
    document.getElementById('prevBtn').addEventListener('click', function () {
        goToPreviousStep();
    });
    // Événement pour le bouton "Suivant"
    document.getElementById('nextBtn').addEventListener('click', function () {
        collectAllStepsData(); 
        sendStepDataToServer();
    });

    // *********************************************** Fin Fonctions ***************************************************************



</script>
