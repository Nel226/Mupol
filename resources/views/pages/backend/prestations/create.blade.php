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
            <form   action="{{ route('prestations.store') }}" method="POST" enctype="multipart/form-data" id="formPrestation" class=" max-w-2xl mx-auto adherent-form">
                @csrf
                <div class=" ">
                    <!-- Premier formulaire -->
                    <div class=" mb-6 border-4 rounded-md border-primary1 py-2">
                        <div class="md:px-5">
                            <div class="flex flex-col md:flex-row items-center gap-4">
                                <img src="{{ asset('images/medical.png') }}" alt="Image medical" class="h-24 w-24 md:h-40 md:w-40 flex-shrink-0">
                                <div class="text-center md:text-left">
                                    <h2 class="mb-4 text-xl md:text-2xl font-bold">Enregistrement de prestation</h2>
                                    <span class="italic text-sm md:text-base">
                                        Ce formulaire est conçu pour faciliter la saisie des informations concernant les actes médicaux.
                                    </span>
                                </div>
                            </div>
                            
                            <div class="form-content p-4 md:p-6 bg-white rounded-lg shadow-md">
                                <!-- Barre de séparation -->
                                <hr class="w-4/5 h-1 mx-auto mb-6 bg-primary1 border-0 rounded dark:bg-gray-700">
                            
                                <!-- Sélecteur du code -->
                                <label for="adherentCode" class="block mb-2 text-sm font-medium text-gray-900">Sélectionnez le code du mutualiste :</label>
                                <select id="adherentCode" name="adherentCode" class="block w-full p-2 mb-6 border border-gray-300 rounded-lg focus:ring focus:ring-primary1 focus:outline-none">
                                    <option value="">-- Choisir un code --</option>
                                    @foreach ($adherents as $adherent)
                                        <option value="{{ $adherent->code_carte }}">{{ $adherent->code_carte }}</option>
                                    @endforeach
                                    @foreach ($ayantsDroitValides as $ayantDroit)
                                        <option value="{{ $ayantDroit->code }}">{{ $ayantDroit->code }}</option>
                                    @endforeach
                                </select>
                            
                                <div id="adherentInfo" class="hidden mt-4">
                                    <!-- Première ligne : Nom et Prénom -->
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <!-- Nom -->
                                        <div class="w-full md:w-1/2">
                                            <label for="adherentNom" class="block mb-2 text-sm font-medium text-gray-900">Nom :</label>
                                            <input id="adherentNom" name="adherentNom" type="text" 
                                                class="block w-full p-2 mb-4 bg-gray-200 border border-gray-300 rounded-lg focus:outline-none" 
                                                readonly>
                                        </div>
                                        <!-- Prénom -->
                                        <div class="w-full md:w-1/2">
                                            <label for="adherentPrenom" class="block mb-2 text-sm font-medium text-gray-900">Prénom :</label>
                                            <input id="adherentPrenom" name="adherentPrenom" type="text" 
                                                class="block w-full p-2 mb-4 bg-gray-200 border border-gray-300 rounded-lg focus:outline-none" 
                                                readonly>
                                        </div>
                                    </div>
                            
                                    <!-- Deuxième ligne : Sexe et Statut -->
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <!-- Sexe -->
                                        <div class="w-full md:w-1/2">
                                            <label for="adherentSexe" class="block mb-2 text-sm font-medium text-gray-900">Sexe :</label>
                                            <input id="adherentSexe" name="adherentSexe" type="text" 
                                                class="block w-full p-2 mb-4 bg-gray-200 border border-gray-300 rounded-lg focus:outline-none" 
                                                readonly>
                                        </div>
                                        <!-- Statut du bénéficiaire -->
                                        <div class="w-full md:w-1/2">
                                            <label for="beneficiaire" class="block mb-2 text-sm font-medium text-gray-900">Statut du bénéficiaire :</label>
                                            <input id="beneficiaire" name="beneficiaire" type="text" 
                                                class="block w-full p-2 mb-4 bg-gray-200 border border-gray-300 rounded-lg focus:outline-none" 
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Sélection principale -->
                                <div  id="infosACompleter" class=" infosACompleter hidden" >
                                    <fieldset class=" mt-2 ">
                                        {{--  <legend class="px-3 py-1 font-semibold text-white bg-primary1 border-b border-gray-300 rounded-t-lg">
                                            Formulaire prestation #1
                                        </legend>  --}}
                                        {{--  <button class="toggle-form">
                                            Afficher/Masquer
                                        </button>  --}}
                                        {{--  <div  class="p-2 border-2 border-primary1 rounded-md">
                                        </div>  --}}
                                        
                                            <div class="w-11/12 sm:w-4/5 mx-auto flex items-center py-5">
                                                <!-- Ligne gauche -->
                                                <div class="flex-grow border-t border-gray-400 border-2 sm:border-4"></div>
                                                <!-- Texte central -->
                                                <span class="flex-shrink mx-2 sm:mx-4 text-primary1 font-bold text-sm sm:text-base text-center">A compléter</span>
                                                <!-- Ligne droite -->
                                                <div class="flex-grow border-t border-gray-400 border-2 sm:border-4"></div>
                                            </div>
                                        
                                            <div id="acteContainer" class="acteContainer hidden">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                    <!-- Identifiant prestation -->
                                                    <div>
                                                        <label for="idPrestation" class="block mb-2 text-sm font-medium text-gray-900">
                                                            Identifiant prestation :
                                                        </label>
                                                        <input 
                                                            id="idPrestation" 
                                                            name="idPrestation" 
                                                            type="text" 
                                                            class="block w-full p-2 mb-4 border border-gray-300 rounded-lg" 
                                                            placeholder="Entrez l'identifiant de la prestation" 
                                                            required
                                                        >
                                                    </div>
                                                    <!-- Téléphone -->
                                                    <div>
                                                        <label for="contactPrestation" class="block mb-2 text-sm font-medium text-gray-900">
                                                            Téléphone :
                                                        </label>
                                                        <input 
                                                            id="contactPrestation" 
                                                            name="contactPrestation" 
                                                            type="number" 
                                                            class="block w-full p-2 mb-4 border border-gray-300 rounded-lg" 
                                                            placeholder="Entrez un numéro de téléphone pour le paiement" 
                                                            required
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="form-container">
                                                <div class="form-prestation rounded-md  !mt-2 bg-gray-100 shadow-lg  border">
                                                    <div class="w-full p-2 rounded-t-md bg-gray-300 flex items-center justify-between cursor-pointer" id="accordion-header">
                                                        <label for="form" id="label" class="block text-bold text-sm font-medium text-gray-900">Prestation #1</label>
                                                        <span id="toggle-icon" class="text-lg">+</span>
                                                    </div>
                                                    <div class="p-4 " id="accordion-content">

                                                        <label for="acte" class="block mb-2 text-sm font-medium text-gray-900">Sélectionnez une option :</label>
                                                        <select id="acte" name="acte" class="acte-select block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                                            <option value="">-- Choisir --</option>
                                                            <option value="consultation">Consultation</option>
                                                            <option value="hospitalisation">Hospitalisation</option>
                                                            <option value="analyse_biomedicale">Analyse biomédicale</option>
                                                            <option value="radio">Imagerie médicale</option>
                                                            <option value="pharmacie">Pharmacie</option>
                                                            <option value="maternite">Maternité</option>
                                                            <option value="optique">Optique</option>
                                                            <option value="dentaire_auditif">Dentaire et auditif</option>
                                                            <option value="allocation">Allocation</option>
                                                            <option value="autre">Autre</option>
        
                                                        </select>
                                                        <!-- Options spécifiques -->
                                                        <div id="consultationOptions" class="options consultation hidden">
                                                            <h3 class="mb-2 text-xl font-semibold">Consultation</h3>
                                                            <div class="flex flex-col sm:flex-row sm:space-x-6">
                                                                <div class="w-full">
                                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                                                    <input id="date" name="date_consultation" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-full">
                                                                    <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                                                    <input id="centre" name="centre_consultation" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                            </div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900">Type de consultation :</label>
                                                            <select  id="typeConsultation" name="type_consultation" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                                                <option value="">-- Sélectionner le type de consultation --</option>
                                                                <option value="infirmier">Infirmier</option>
                                                                <option value="MG">Médecin généraliste</option>
                                                                <option value="kinetherapeutre">Kinéthérapeutre</option>
                                                                <option value="dentiste">Dentiste</option>
                                                                <option value="specialiste">Spécialiste</option>
                                                            </select>
                                                            <div id="specialiteContainer" class="hidden">
                                                                <label class="block mb-2 text-sm font-medium text-gray-900">Spécialiste :</label>
                                                                <select  name="sous_type_consultation" id="specialiteMedicale" name="specialiteMedicale" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                                                    <option value="">-- Sélectionner la spécialité --</option>
                                                                    <option value="Cardiologie">Cardiologie</option>
                                                                    <option value="Chirurgie Pédiatrique">Chirurgie Pédiatrique</option>
                                                                    <option value="Chirurgie Générale">Chirurgie Générale</option>
                                                                    <option value="Dermatologie">Dermatologie</option>
                                                                    <option value="Diabète et Endocrinologie">Diabète et Endocrinologie</option>
                                                                    <option value="Gastro-entérologie">Gastro-entérologie</option>
                                                                    <option value="Gynécologie">Gynécologie</option>
                                                                    <option value="Urologie">Urologie</option>
                                                                    <option value="médecine interne">Médecine Interne</option>
                                                                    <option value="MPR">Médecine Physique et de Réadaptation (MPR)</option>
                                                                    <option value="Nephrologie">Néphrologie</option>
                                                                    <option value="Neurochirurgie">Neurochirurgie</option>
                                                                    <option value="Neurologie">Neurologie</option>
                                                                    <option value="Ophtalmologie">Ophtalmologie</option>
                                                                    <option value="ORL">ORL</option>
                                                                    <option value="Pédiatrie">Pédiatrie</option>
                                                                    <option value="Pneumologie">Pneumologie</option>
                                                                    <option value="Psychiatrie">Psychiatrie</option>
                                                                    <option value="Rhumatologie">Rhumatologie</option>
                                                                    <option value="Traumatologie">Traumatologie</option>
                                                                </select>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row sm:space-x-6">
                                                                <div class="w-full">
                                                                    <label for="montant"   class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_consultation" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg "  >
                                                                </div>
                                                                
                                                                <div class="w-full">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="hospitalisationOptions" class="hospitalisation options hidden">
                                                            <h3 class="mb-2 text-xl font-semibold">Hospitalisation</h3>
                                                            <div class="flex space-x-6 sm:flex-row">
                                                                <div class="w-full">
                                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                                                    <input id="date" name="date_hospitalisation" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-full">
                                                                    <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                                                    <input id="centre" name="centre_hospitalisation" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                            </div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900">Durée :</label>
                                                            <select name="type_hospitalisation" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                                                <option value="">-- Sélectionner la durée --</option>
                                                                <option value="inf-2-jours">Inférieur à 2 jours</option>
                                                                <option value="2-7-jours">2 à 7 jours</option>
                                                                <option value="7-14-jours">7 à 14 jours</option>
                                                                <option value="15-plus-jours">15 jours et plus</option>
                                                            </select>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant" name="montant_hospitalisation" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple accept=".pdf" class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                        </div>
                            
                                                        <div id="analyseBiomedicaleOptions" class="options analyse_biomedicale hidden">
                                                            
                                                            <h3 class="mb-2 text-xl font-semibold">Analyse biomédicale</h3>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                                                    <input id="date"  name="date_analyse_biomedicale" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                                                    <input id="centre" name="centre_analyse_biomedicale" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_analyse_biomedicale" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="radioOptions" class="options radio hidden">
                                                            <h3 class="mb-2 text-xl font-semibold">Radio</h3>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                                                    <input id="date" name="date_radio" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                                                    <input id="centre" name="centre_radio" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                            </div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900">Type :</label>
                                                            <select name="type_radio" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                                                <option value="">-- Sélectionner le type de radiographie --</option>
                                                                <option value="radio-standard">Radio standard</option>
                                                                <option value="echo">Échographie</option>
                                                                <option value="echo-doppler">Échographie Doppler</option>
                                                                <option value="ecg">ECG</option>
                                                                <option value="endoscopie">Endoscopie</option>
                                                                <option value="irm">IRM</option>
                                                                <option value="scanner">Scanner</option>
                                                            </select>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant" name="montant_radio" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                            
                                                        <div id="pharmacieOptions" class="options pharmacie hidden">
                                                            
                                                            <h3 class="mb-2 text-xl font-semibold">Pharmacie</h3>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                                                    <input id="date"  name="date_pharmacie" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                                                    <input id="centre" name="centre_pharmacie" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_pharmacie" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="materniteOptions" class="options maternite hidden">
                                                            
                                                            <h3 class="mb-2 text-xl font-semibold">Maternité</h3>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                                                    <input id="date"  name="date_maternite" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                                                    <input id="centre" name="centre_maternite" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                            </div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900">Type :</label>
                                                            <select name="type_maternite" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                                                <option value="">-- Sélectionner le type de maternité --</option>
                                                                <option value="naissance-vivante">Naissance vivante</option>
                                                                <option value="deces">Décès</option>
                                                            </select>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_maternite" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                            
                                                        <div id="optiqueOptions" class="options optique hidden">
                                                            
                                                            <h3 class="mb-2 text-xl font-semibold">Optique</h3>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                                                    <input id="date"  name="date_optique" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                                                    <input id="centre" name="centre_optique" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_optique" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="dentaireAuditifOptions" class="options dentaire_auditif hidden">
                                                            
                                                            <h3 class="mb-2 text-xl font-semibold">Dentaire et auditif</h3>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                                                    <input id="date"  name="date_dentaire_auditif" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                                                    <input id="centre" name="centre_dentaire_auditif" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_dentaire_auditif" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                            
                                                        <div id="allocationOptions" class="options allocation hidden">
                                                            <h3 class="mb-2 text-xl font-semibold">Allocation</h3>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                                                    <input id="date"  name="date_allocation" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                                                    <input id="centre" name="centre_allocation" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                            </div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900">Type :</label>
                                                            <select name="type_allocation" id="allocationType" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                                                <option value="">-- Sélectionner le type d&apos;allocation --</option>
                                                                <option value="invalidite">Invalidité</option>
                                                                <option value="deces-adherent">Décès adhérent</option>
                                                                <option value="deces-ayant-droit">Décès ayant droit</option>
                                                                <option value="secours-medical">Secours Médical</option>
                                                            </select>
                                                            
                                                            <div id="secoursMedicalDetail" class="hidden mt-2">
                                                                <label class="block mb-2 text-sm font-medium text-gray-900">Détail :</label>
                                                                <select name="sous_type_allocation" id="secoursMedicalDetailSelect" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                                                    <option value="">-- Sélectionner le sous-type d&apos;allocation --</option>
                                                                    <option value="mld">Drainage lymphatique manuel (MLD)</option>
                                                                    <option value="soin-exceptionnel">Soin exceptionnel</option>
                                                                    <option value="soin-non-couvert">Soin non couvert</option>
                                                                </select>
                                                            </div>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant" name="montant_allocation" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple accept=".pdf" class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div id="autreOptions" class="options autre hidden">
                                                            
                                                            <h3 class="mb-2 text-xl font-semibold">Autre</h3>
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                                                    <input id="date"  name="date_autre" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                                                    <input id="centre" name="centre_autre" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="w-full">
                                                                <label for="type_autre" class="block mb-2 text-sm font-medium text-gray-900">Détails :</label>
                                                                <input id="type_autre" name="type_autre" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                            </div>
                                                        
                                                            
                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_autre" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>
                                                                
                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </fieldset>
                            
                                    
                                </div>
                                <div class=" flex justify-end">
                                    <x-primary-button type="button" id="add-form" class="mt-4">
                                        Ajouter une autre prestation
                                    </x-primary-button>
                                
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex items-end justify-end gap-4 mt-8">
                    
                    <x-primary-button type="submit" class="mt-4 ">
                        Valider
                    </x-primary-button>
                </div>
            </form>
            <script>
                let formIndex = 1; 

                function initializeAccordion(form) {
                    const accordionHeader = form.querySelector('#accordion-header'); 
                    const accordionContent = form.querySelector('#accordion-content');
                    const toggleIcon = form.querySelector('.toggle-icon');
            
                    accordionHeader.addEventListener('click', function() {
                        accordionContent.classList.toggle('hidden');
                        toggleIcon.textContent = accordionContent.classList.contains('hidden') ? '+' : '-';
                    });
                }
            
                document.addEventListener('DOMContentLoaded', function() {
                    const firstForm = document.querySelector('.form-prestation');
                    initializeAccordion(firstForm); 
                });

            
                document.getElementById('add-form').addEventListener('click', function() {
                    const formContainer = document.getElementById('form-container');
                    const newForm = document.querySelector('.form-prestation').cloneNode(true);
                    
                    // Créer un bouton "Supprimer" pour le nouveau formulaire
                    const deleteButton = document.createElement('button');
                    deleteButton.className = 'bg-red-500 text-white p-2 text-xs rounded delete-form-btn';
                    deleteButton.textContent = 'Supprimer';
                    
                    formIndex++;

                    // Réinitialiser les champs du nouveau formulaire
                    newForm.querySelectorAll('input, select').forEach(function(element) {
                        const name = element.getAttribute('name');
                        const id = element.getAttribute('id');
                        const label = newForm.querySelector('label'); 

                        label.textContent = `Prestation #${formIndex}`;
                        if (name) {
                            element.setAttribute('name', `${name}-${formIndex}`);
                        }
                        if (id) {
                            element.setAttribute('id', `${id}-${formIndex}`);
                        }
                    
                        if (element.tagName === 'SELECT') {
                            element.selectedIndex = 0;
                        } else if (element.type === 'text' || element.type === 'number' || element.type === 'file' || element.type === 'date') {
                            element.value = ''; 
                        } else if (element.type === 'checkbox' || element.type === 'radio') {
                            element.checked = false; 
                        }
                    
                        if (element.id === 'contactPrestation-1') {
                            console.log("ID du champ contactPrestation:", element.id);
                        }
                    });
                    
                    initializeAccordion(newForm);

            
                    {{--  newForm.querySelector('.acteContainer').classList.remove('hidden');    --}}
                    formContainer.appendChild(newForm);


                    {{--  let acteSelect = null;   --}}
                    hideAllOptions(newForm); 

                    acteSelect = newForm.querySelector('.acte-select'); 
                    console.log('Acte sélectionné:', acteSelect);

                    if (acteSelect) {
                        acteSelect.addEventListener('change', function() {
                            {{--  if (acteTitle) {
                                acteTitle.textContent = this.value || ''; // Mettre à jour le titre
                            }  --}}
                        });
                    }
                    if (acteSelect) {
                        acteSelect.addEventListener('change', function() {
                            showSelectedOption(acteSelect); 
                        });
                        console.log('Acte selectionné:', acteSelect);
                        if (acteSelect.value) {
                            showSelectedOption(acteSelect); 
                        }
                    }

                    deleteButton.addEventListener('click', function() {
                        formContainer.removeChild(newForm);
                        updateFormIndices(formContainer);

                    });
            
                });

                function showSelectedOption(acteSelect) {
                    const form = acteSelect.closest('.form-prestation'); 
                    
                    hideAllOptions(form); 
            
                    const selectedOption = acteSelect.value;
                    if (selectedOption) {
                        const optionToShow = form.querySelector('.' + selectedOption); 
                        if (optionToShow) {
                            optionToShow.classList.remove('hidden');
                        } else {
                            console.error('Option manquante pour:', selectedOption);
                        }
                    }
                }
            
                function hideAllOptions(form) {
                    form.querySelectorAll('.options').forEach(function(option) {
                        option.classList.add('hidden'); 
                    });
                }
            
                document.querySelectorAll('.acte-select').forEach(function(acteSelect) {
                    acteSelect.selectedIndex = 0;
                    acteSelect.addEventListener('change', function() {
                        showSelectedOption(acteSelect); 
                    });
            
                });
            </script>
            
            
            <script defer>
                document.addEventListener('DOMContentLoaded', () => {
                    const adherentCode = document.getElementById('adherentCode');
                    const acteContainer = document.getElementById('acteContainer');

                    const consultationOptions = document.getElementById('consultationOptions');
                    const hospitalisationOptions = document.getElementById('hospitalisationOptions');
                    const analyseBiomedicaleOptions = document.getElementById('analyseBiomedicaleOptions');
        
                    const radioOptions = document.getElementById('radioOptions');
                    const pharmacieOptions = document.getElementById('pharmacieOptions');
        
                    const materniteOptions = document.getElementById('materniteOptions');
                    const optiqueOptions = document.getElementById('optiqueOptions');
                    const dentaireAuditifOptions = document.getElementById('dentaireAuditifOptions');
        
                    const allocationOptions = document.getElementById('allocationOptions');
                    const secoursMedicalDetail = document.getElementById('secoursMedicalDetail');
                    var adherents = @json($adherents); 
                    var ayantsDroit = @json($ayantsDroit); 
                    
                    const adherentInfo = document.getElementById('adherentInfo');
                    const beneficiaireIndicator = document.getElementById('beneficiaire');
                    const infosACompleter = document.getElementById('infosACompleter');

                    
                    
                    $('#adherentCode').on('change', function() {
                        const selectedCode = $(this).val(); // Récupérer la valeur sélectionnée
                        const selectedAdherent = adherents.find(adherent => adherent.code_carte === selectedCode);
                
                        if (selectedAdherent) {
                            document.getElementById('adherentNom').value = selectedAdherent.nom;
                            document.getElementById('adherentPrenom').value = selectedAdherent.prenom;
                            document.getElementById('adherentSexe').value = selectedAdherent.genre;
                            beneficiaireIndicator.value = 'Adhérant';
                
                            acteContainer.classList.remove('hidden');
                            adherentInfo.classList.remove('hidden');
                            infosACompleter.classList.remove('hidden');

                        } else {
                            const selectedAyantDroit = ayantsDroit.find(ayantDroit => ayantDroit.code === selectedCode);
                
                            if (selectedAyantDroit) {
                                document.getElementById('adherentNom').value = selectedAyantDroit.nom;
                                document.getElementById('adherentPrenom').value = selectedAyantDroit.prenom;
                                document.getElementById('adherentSexe').value = selectedAyantDroit.genre;
                                beneficiaireIndicator.value = 'Ayant Droit';
                
                                acteContainer.classList.remove('hidden');
                                adherentInfo.classList.remove('hidden');
                                infosACompleter.classList.remove('hidden');

                            } else {
                                // Réinitialiser les champs si aucun adhérant ou ayant droit trouvé
                                document.getElementById('adherentNom').value = '';
                                document.getElementById('adherentPrenom').value = '';
                                document.getElementById('adherentSexe').value = '';
                                beneficiaireIndicator.value = 'Non trouvé';
                
                                acteContainer.classList.add('hidden');
                                acte.value = '';
                                hideAllOptions();
                            }
                        }
                    });
                    
                    typeConsultation.addEventListener('change', () => {
                        if (typeConsultation.value === 'specialiste') {
                            specialiteContainer.classList.remove('hidden');
                        } else {
                            specialiteContainer.classList.add('hidden');
                        }
                    });
                    
                    allocationType.addEventListener('change', () => {
                        const selectedValue = allocationType.value;
                        
                        secoursMedicalDetail.classList.add('hidden');
                        
                        if (selectedValue === 'secours-medical') {
                            secoursMedicalDetail.classList.remove('hidden');
                        }
                    });
                    
                    
                    
                });
            </script>
            <script>
                function validateForm(form) {
                    let isValid = true; 
                    const inputs = form.querySelectorAll('input, select, textarea'); 

                    inputs.forEach((input) => {
                        if (input.name && input.name.startsWith('preuve')) {
                            return; 
                        }
                        if (!input.closest('.hidden') && (input.type !== 'checkbox' && input.type !== 'radio')) {
                            if (input.value.trim() === '') {
                                isValid = false; 
                                input.classList.add('border-red-500'); 
                            } else {
                                input.classList.remove('border-red-500'); 
                            }
                        }
                        
                        if (input.type === 'checkbox' || input.type === 'radio') {
                            const groupName = input.name; 
                            const isChecked = form.querySelector(`input[name="${groupName}"]:checked`);
                            if (!isChecked) {
                                isValid = false; 
                                input.classList.add('border-red-500'); 
                            } else {
                                input.classList.remove('border-red-500'); 
                            }
                        }
                    });

                    return isValid; 
                }

                document.getElementById('formPrestation').addEventListener('submit', function(event) {
                    event.preventDefault(); 

                    const form = this; 
                    if (validateForm(form)) {
                        form.submit(); 
                    } else {
                        alert('Veuillez remplir tous les champs requis.'); 
                    }
                });

                $(document).ready(function() {
                    $('#adherentCode').select2({
                        placeholder: '-- Choisir un code --',
                        width: '100%',
                        language: {
                            noResults: function() {
                                return "Aucun résultat trouvé";
                            }
                        }
                    });
                
                    
                });
                                     
            </script>                    
        
        </div>
        
    </x-content-page-admin>
</x-app-layout>

