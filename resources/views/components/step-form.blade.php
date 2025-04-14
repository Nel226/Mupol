
<div  x-data="membershipForm()" class="mx-auto w-full max-w-screen-lg px-3 sm:px-5 md:px-7 z-10">
    <div class="w-full md:w-5/6 mx-auto mt-0 md:mt-3">

        <!-- Nouveau adhérent -->
        <div class="mt-4">
            <!-- Stepper pour les grands écrans (> 640px) -->
            <div class="flex-stepper justify-between items-center mb-4 md:mb-6 hidden sm:flex">
                <template x-for="step in totalSteps" :key="step">
                    <div class="flex justify-center flex-col items-center flex-1" :class="step === 1 || step === totalSteps ? 'w-[calc(100%/4)]' : ''">
                        <div class="relative flex items-center w-full" @click="currentStep = step">
                            <!-- Ligne connectante invisible pour la première étape -->
                            <div x-show="step === 1" class="flex-1 h-1 invisible" style="height: 3px; margin-left: -0.5rem;"></div>

                            <!-- Connecting Line -->
                            <div x-show="step > 1 && step <= totalSteps" class="flex-1 h-1" :class="currentStep >= step ? 'bg-primary1' : 'bg-gray-300'" style="height: 3px; margin-left: -0.5rem;"></div>
                            
                            <!-- Step Circle -->
                            <div class="w-5 h-5 sm:w-6 sm:h-6 md:w-8 md:h-8 flex shadow-lg items-center justify-center rounded-full text-white z-10 transition-all duration-200 hover:bg-primary1 hover:scale-110 cursor-pointer" :class="currentStep >= step ? 'bg-primary1' : 'bg-gray-300'">
                                <template x-if="currentStep > step">
                                    <i class="fa fa-check"></i>
                                </template>
                                <template x-if="currentStep <= step">
                                    <span x-text="step"></span>
                                </template>
                            </div>

                            <!-- Connecting Line -->
                            <div x-show="step < totalSteps" class="flex-1 h-1" :class="currentStep > step ? 'bg-primary1' : 'bg-gray-300'" style="height: 3px; margin-left: -0.5rem;"></div>

                            <!-- Ligne connectante invisible pour la dernière étape -->
                            <div x-show="step === totalSteps" class="flex-1 h-1 invisible" style="height: 3px; margin-left: -0.5rem;"></div>
                        </div>

                        <!-- Step Label -->
                        <div class="text-xs mt-2 text-center w-full overflow-hidden">
                            <p class="step-label whitespace-normal break-words">
                                <span x-show="step == 1">Références de l'adhérent</span>
                                <span x-show="step == 2">Etat civil</span>
                                <span x-show="step == 3">Informations personnelles</span>
                                <span x-show="step == 4">Informations professionnelles</span>
                                <span x-show="step == 5">Récapitulatif</span>
                            </p>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Affichage dynamique des étapes -->
            <form id="membership-form" action="{{ route('membership.submit') }}" method="POST" @submit.prevent="handleSubmit" enctype="multipart/form-data">
                @csrf
                
                <div x-show="currentStep == 1">
                    <div>
                        
                        <!-- Grille pour Matricule et NIP -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-3 sm:gap-4">
                            <!-- Matricule -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1" for="matricule">Matricule</label>
                                <input required name="matricule" id="matricule" type="text" x-model="formData.matricule"
                                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4"
                                    value="{{ old('matricule') }}">
                                <span x-text="errors.matricule" class="text-red-500 text-xs"></span>
                            </div>

                            <!-- NIP -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1" for="nip">NIP</label>
                                <input required name="nip" id="nip" type="text" x-model="formData.nip"
                                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4"
                                    value="{{ old('nip') }}">
                                <span x-text="errors.nip" class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        
                    </div>

                </div>

                <div x-show="currentStep == 2">
                    <div>
                        <!-- Grille pour Nom(s), Prénom(s), et Genre -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        
                            <!-- Nom(s) -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1" for="nom">Nom(s)</label>
                                <input name="nom" id="nom" x-model="formData.nom" type="text"
                                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                @error('nom')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
        
                            <!-- Prénom(s) -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1" for="prenom">Prénom(s)</label>
                                <input name="prenom" id="prenom" type="text" x-model="formData.prenom"
                                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-0 sm:mb-4">
                                @error('prenom')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
        
                        </div>
        
                    </div>
                </div>

                <div x-show="currentStep == 3">
                    <div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2">
                            <!-- Lieu de résidence -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1" for="lieu_residence">Lieu de résidence</label>
                                <input name="lieu_residence" id="lieu_residence" type="text" x-model="formData.lieu_residence"
                                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                @error('lieu_residence')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-1" for="telephone_personne_prevenir">Téléphone</label>
                                <input name="telephone_personne_prevenir" id="telephone_personne_prevenir" x-model="formData.telephone_personne_prevenir"
                                    type="tel" placeholder="Ex: 77112233"
                                    pattern="^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$"
                                    title="Ex. (numéro valide) : +22677020202 ou 77020202"
                                    class="bg-gray-50 appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-0 sm:mb-4">
                                @error('telephone_personne_prevenir')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="currentStep == 4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                        <!-- Label "Statut" -->
                        <label class="block text-gray-700 text-sm font-bold">Statut :</label>
                
                        <!-- Options de statut -->
                        <div class="grid grid-cols-1 sm:flex sm:items-center sm:space-x-4 ">
                            <label class="inline-flex items-center">
                                <input name="statut" type="radio" x-model="formData.statut" value="personnel_retraite" class="form-radio text-indigo-600">
                                <span class="ml-2">Personnel retraité</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input name="statut" type="radio" x-model="formData.statut" value="personnel_active" class="form-radio text-indigo-600">
                                <span class="ml-2">Personnel en activité</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div x-show="currentStep == 5">
                    <h3>Étape 5 : Récapitulatif</h3>
                    {{-- <x-formulaire-adhesion /> --}}
                </div>

                <input type="hidden" name="currentStep" x-model="currentStep">


                <!-- Boutons de navigation -->
                <div class="flex mt-4">
                    <button x-show="currentStep > 1" @click="prevStep; $nextTick(() => document.getElementById('wizard-top').scrollIntoView({ behavior: 'smooth' }))" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Précédent
                    </button>
            
                    <div class="ml-auto flex space-x-2">
                        <button  x-show="currentStep < totalSteps" @click="nextStep" class="bg-primary1 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Suivant
                        </button>
            
                        <button x-show="currentStep === totalSteps" type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Soumettre
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>
</div>

<script>
    function membershipForm() {
        return {
            currentStep: 1,
            totalSteps: 5,
            formData: {},
            errors: {},
            
            // async handleSubmit() {
            //     this.formData.currentStep = this.currentStep; 
            //     // Envoyer toutes les données au serveur
            //     const response = await this.sendData('membership/submit', this.formData);
            //     console.log('Current Step:', this.formData);
            //     if (response.success) {
                    
            //     } else {
            //         this.errors = response.errors || {};
            //     }
            // },

            async handleSubmit() {
                // Vérifiez si l'utilisateur est à la dernière étape avant d'envoyer les données
                if (this.currentStep === this.totalSteps) {
                    this.formData.currentStep = this.currentStep; 
                    // Envoyer toutes les données au serveur
                    const response = await this.sendData('membership/submit', this.formData);
                    console.log('Current Step:', this.formData);
                    if (response.success) {
                        // Logic en cas de succès, comme la redirection ou la confirmation
                    } else {
                        this.errors = response.errors || {};
                    }
                }
            },
            
            async nextStep() {
                // Assurez-vous que l'étape actuelle est valide avant de passer à la suivante
                if (this.isValidStep(this.currentStep)) {
                    this.formData.currentStep = this.currentStep; 
                    const response = await this.sendData(`membership/step/${this.currentStep}`, this.formData);
                    if (response.success) {
                        this.currentStep++; // Passer à l'étape suivante
                        this.errors = {}; // Réinitialiser les erreurs
                    } else {
                        this.errors = response.errors || {};
                    }
                } else {
                    // Optionnel : Afficher un message d'erreur si l'étape n'est pas valide
                    //alert('Veuillez compléter tous les champs requis.');
                }
            },


            async prevStep() {
                if (this.currentStep > 1) {
                    this.currentStep--;
                }
            },

            async sendData(url, data) {
                try {
                    const formData = new FormData();
                    
                    // Ajoutez les données sous forme de clé-valeur
                    Object.keys(data).forEach(key => {
                        formData.append(key, data[key]);
                    });

                    const response = await fetch(`/${url}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: formData,  // Utiliser FormData pour envoyer les données
                    });
                    return await response.json();
                } catch (error) {
                    console.error('Erreur lors de l\'envoi des données', error);
                    return { success: false, errors: { global: 'Une erreur s\'est produite. Veuillez réessayer.' } };
                }
            },

            isValidStep(step) {
                // Implémenter ici la logique de validation pour chaque étape
                if (step === 1) {
                    return this.formData.matricule && this.formData.nip;
                } else if (step === 2) {
                    return this.formData.nom && this.formData.prenom;
                }
                // Ajouter d'autres validations pour les autres étapes si nécessaire
                return true;
            }

        };
    }

</script>
