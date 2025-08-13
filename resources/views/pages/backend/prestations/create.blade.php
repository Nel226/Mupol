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
                                            <div class="flex gap-2">
                                                <input id="beneficiaire" name="beneficiaire" type="text"
                                                    class="block w-full p-2 mb-4 bg-gray-200 border border-gray-300 rounded-lg focus:outline-none"
                                                    readonly>
                                                <select id="beneficiaireSelect" name="beneficiaire"
                                                    class="hidden block w-full p-2 mb-4 border border-gray-300 rounded-lg focus:outline-none">
                                                    <option value="Adhérent">Adhérent</option>
                                                    <option value="Ayant Droit">Ayant Droit</option>
                                                </select>
                                                <button type="button" id="editBeneficiaire"
                                                    class="px-3 py-2 mb-4 text-xs bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 flex-shrink-0">
                                                    Modifier
                                                </button>

                                                <button type="button" id="cancelBeneficiaire"
                                                    class="hidden px-3 py-2 mb-4 text-xs bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 flex-shrink-0">
                                                    ✗ Annuler
                                                </button>
                                            </div>
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
                                                    <div class="w-full p-2 rounded-t-md bg-gray-300 flex items-center justify-between cursor-pointer" >
                                                        <button id="accordion-header" >
                                                            <span id="toggle-icon" class="text-xs" >▼ Masquer</span>
                                                        </button>
                                                        <label for="form" id="label" class="block text-bold text-sm font-medium text-gray-900">Prestation #1</label>
                                                        <div class=" flex justify-end items-center">

                                                            <div class="text-right mt-4">
                                                                <button type="button" class="bg-red-600 text-white text-xs px-3 py-1 rounded delete-form-btn">
                                                                    Supprimer
                                                                </button>
                                                            </div>

                                                        </div>
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
                                                                    <select  name="centre_consultation" class="centre-select block w-full p-2 mb-4 border border-gray-300 rounded-lg ">
                                                                        @foreach($partenaires as $partenaire)
                                                                            <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                                                        @endforeach
                                                                    </select>
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
                                                                    <input id="preuve" name="preuve[]" type="file" accept="image/*" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
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
                                                                    <select  name="centre_hospitalisation" class="centre-select block w-full p-2 mb-4 border border-gray-300 rounded-lg ">
                                                                        @foreach($partenaires as $partenaire)
                                                                            <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                                                        @endforeach
                                                                    </select>
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
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve(s) :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple accept="image/*" class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
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
                                                                    <select  name="centre_analyse_biomedicale" class="centre-select block w-full p-2 mb-4 border border-gray-300 rounded-lg ">
                                                                        @foreach($partenaires as $partenaire)
                                                                            <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_analyse_biomedicale" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>

                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve(s) :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" accept="image/*" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
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
                                                                    <select  name="centre_radio" class="centre-select block w-full p-2 mb-4 border border-gray-300 rounded-lg ">
                                                                        @foreach($partenaires as $partenaire)
                                                                            <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                                                        @endforeach
                                                                    </select>
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
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve(s) :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" accept="image/*" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
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
                                                                    <select  name="centre_pharmacie" class="centre-select block w-full p-2 mb-4 border border-gray-300 rounded-lg ">
                                                                        @foreach($partenaires as $partenaire)
                                                                            <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_pharmacie" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>

                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve(s) :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" accept="image/*" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
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
                                                                    <select  name="centre_maternite" class="centre-select block w-full p-2 mb-4 border border-gray-300 rounded-lg ">
                                                                        @foreach($partenaires as $partenaire)
                                                                            <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                                                        @endforeach
                                                                    </select>
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
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve(s) :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" accept="image/*" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
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
                                                                    <select name="centre_optique" class="centre-select block w-full p-2 mb-4 border border-gray-300 rounded-lg ">
                                                                        @foreach($partenaires as $partenaire)
                                                                            <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_optique" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>

                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve(s) :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" accept="image/*" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
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
                                                                    <select  name="centre_dentaire_auditif" class="centre-select block w-full p-2 mb-4 border border-gray-300 rounded-lg ">
                                                                        @foreach($partenaires as $partenaire)
                                                                            <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_dentaire_auditif" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>

                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve(s) :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" accept="image/*" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
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
                                                                    <select  name="centre_allocation" class="centre-select block w-full p-2 mb-4 border border-gray-300 rounded-lg ">
                                                                        @foreach($partenaires as $partenaire)
                                                                            <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                                                        @endforeach
                                                                    </select>
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
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve(s) :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" multiple accept="image/*" class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
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
                                                                    <select  name="centre_autre" class="centre-select block w-full p-2 mb-4 border border-gray-300 rounded-lg ">
                                                                        @foreach($partenaires as $partenaire)
                                                                            <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="w-full">
                                                                <label for="type_autre" class="block mb-2 text-sm font-medium text-gray-900">Détails :</label>
                                                                <input id="type_Autre" name="type_autre" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                            </div>


                                                            <div class="flex space-x-6">
                                                                <div class="w-1/2">
                                                                    <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                                                    <input id="montant"  name="montant_autre" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                                                </div>

                                                                <div class="w-1/2">
                                                                    <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve(s) :</label>
                                                                    <input id="preuve" name="preuve[]" type="file" accept="image/*" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </fieldset>


                                </div>
                                <div class=" flex justify-start">
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
                // Script corrigé pour les formulaires de prestation
                let formIndex = 1;

                function initializeAccordion(form) {
                    const accordionHeader = form.querySelector('[id^="accordion-header"]');
                    const accordionContent = form.querySelector('[id^="accordion-content"]');
                    const toggleIcon = form.querySelector('[id^="toggle-icon"]');

                    if (accordionHeader && accordionContent && toggleIcon) {
                        accordionHeader.addEventListener('click', function (e) {
                            e.preventDefault();
                            accordionContent.classList.toggle('hidden');
                            toggleIcon.textContent = accordionContent.classList.contains('hidden') ? '▶ Afficher' : '▼ Masquer';
                        });
                    }
                }

                function addDeleteButton(form) {
                    let deleteBtn = form.querySelector('.delete-form-btn');

                    if (deleteBtn) {
                        deleteBtn.addEventListener('click', function () {
                            const formContainer = document.getElementById('form-container');
                            if (formContainer.children.length > 1) {
                                form.remove();
                                updateFormIndices(formContainer);
                                // Pas besoin de réinitialiser Select2 après suppression
                            } else {
                                alert("Vous devez avoir au moins une prestation.");
                            }
                        });
                    }
                }

                function updateFormIndices(container) {
                    const forms = container.querySelectorAll('.form-prestation');
                    forms.forEach((form, index) => {
                        const label = form.querySelector('#label, [id^="label"]');
                        if (label) {
                            label.textContent = `Prestation #${index + 1}`;
                        }
                    });
                    formIndex = forms.length;
                }

                function showSelectedOption(acteSelect) {
                    const form = acteSelect.closest('.form-prestation');
                    hideAllOptions(form);

                    const selectedOption = acteSelect.value;
                    if (selectedOption) {
                        const optionToShow = form.querySelector('.' + selectedOption);
                        if (optionToShow) {
                            optionToShow.classList.remove('hidden');
                        }
                    }
                }

                function hideAllOptions(form) {
                    form.querySelectorAll('.options').forEach(function (option) {
                        option.classList.add('hidden');
                    });
                }

                function makeElementsUnique(form, formNumber) {
                    // Rendre tous les IDs uniques
                    form.querySelectorAll('[id]').forEach(function(element) {
                        if (element.id && formNumber > 1) {
                            const currentId = element.id;
                            // Éviter de dupliquer les suffixes
                            if (!currentId.includes(`-${formNumber}`)) {
                                element.id = `${currentId}-${formNumber}`;
                            }
                        }
                    });

                    // Rendre les noms uniques pour les éléments de formulaire
                    form.querySelectorAll('[name]').forEach(function(element) {
                        if (element.name && formNumber > 1) {
                            const currentName = element.name;
                            // Éviter de dupliquer les suffixes dans les noms
                            if (!currentName.includes(`-${formNumber}`) && !currentName.includes('[]')) {
                                element.name = currentName.includes('[]') ? currentName : `${currentName}-${formNumber}`;
                            }
                        }
                    });
                }




                function initializeSelect2ForForm(form) {
                    const centreSelects = form.querySelectorAll('.centre-select');

                    centreSelects.forEach(function(select) {
                        // Détruire complètement Select2 s'il existe
                        if ($(select).hasClass("select2-hidden-accessible")) {
                            $(select).select2('destroy');
                        }

                        // Supprimer tous les éléments Select2 résiduels
                        $(select).next('.select2-container').remove();

                        // Rendre le select visible et utilisable
                        $(select).show().prop('disabled', false);

                        // Réinitialiser les classes
                        $(select).removeClass('select2-hidden-accessible');

                        // Initialiser Select2
                        $(select).select2({
                            placeholder: "Sélectionner un centre de santé",
                            allowClear: true,
                            width: '100%',
                            tags: true
                        });
                    });
                }

                function initializeFormEventListeners(form, index) {
                    // Event listener pour typeConsultation
                    const typeConsultation = form.querySelector(`[id*="typeConsultation"]`);
                    const specialiteContainer = form.querySelector(`[id*="specialiteContainer"]`);

                    if (typeConsultation && specialiteContainer) {
                        typeConsultation.addEventListener('change', () => {
                            if (typeConsultation.value === 'specialiste') {
                                specialiteContainer.classList.remove('hidden');
                            } else {
                                specialiteContainer.classList.add('hidden');
                            }
                        });
                    }

                    // Event listener pour allocationType
                    const allocationType = form.querySelector(`[id*="allocationType"]`);
                    const secoursMedicalDetail = form.querySelector(`[id*="secoursMedicalDetail"]`);

                    if (allocationType && secoursMedicalDetail) {
                        allocationType.addEventListener('change', () => {
                            const selectedValue = allocationType.value;
                            secoursMedicalDetail.classList.add('hidden');

                            if (selectedValue === 'secours-medical') {
                                secoursMedicalDetail.classList.remove('hidden');
                            }
                        });
                    }

                    // Event listener pour le select d'acte
                    const acteSelect = form.querySelector('.acte-select');
                    if (acteSelect) {
                        acteSelect.addEventListener('change', function () {
                            showSelectedOption(acteSelect);
                        });
                    }
                }

                function resetFormFields(form) {
                    // Réinitialiser tous les champs du formulaire
                    form.querySelectorAll('input, select').forEach(function (element) {
                        if (element.tagName === 'SELECT') {
                            element.selectedIndex = 0;
                        } else if (['text', 'number', 'file', 'date'].includes(element.type)) {
                            element.value = '';
                        } else if (['checkbox', 'radio'].includes(element.type)) {
                            element.checked = false;
                        }
                    });
                }

                document.addEventListener('DOMContentLoaded', function () {
                    const firstForm = document.querySelector('.form-prestation');
                    if (firstForm) {
                        initializeAccordion(firstForm);
                        addDeleteButton(firstForm);
                        initializeFormEventListeners(firstForm, 1);
                        initializeSelect2ForForm(firstForm);
                    }

                    // Ajouter le event listener pour le bouton "Ajouter une autre prestation"
                    document.getElementById('add-form').addEventListener('click', function () {
                        const formContainer = document.getElementById('form-container');
                        const originalForm = document.querySelector('.form-prestation');
                        const newForm = originalForm.cloneNode(true);

                        formIndex++;

                        // Rendre les éléments uniques AVANT de réinitialiser
                        makeElementsUnique(newForm, formIndex);

                        // Réinitialiser les champs
                        resetFormFields(newForm);

                        // Mettre à jour le label
                        const label = newForm.querySelector('[id^="label"]');
                        if (label) {
                            label.textContent = `Prestation #${formIndex}`;
                        }

                        // Masquer toutes les options
                        hideAllOptions(newForm);

                        // Initialiser les fonctionnalités pour le nouveau formulaire
                        initializeAccordion(newForm);
                        addDeleteButton(newForm);

                        // Ajouter le nouveau formulaire au conteneur
                        formContainer.appendChild(newForm);

                        // Initialiser les event listeners APRÈS avoir ajouté au DOM
                        initializeFormEventListeners(newForm, formIndex);

                        // Initialiser Select2 APRÈS avoir ajouté au DOM
                        setTimeout(() => {
                            // Nettoyer les éléments Select2 clonés avant d'initialiser
                            newForm.querySelectorAll('.select2-container').forEach(el => el.remove());
                            initializeSelect2ForForm(newForm);
                        }, 100);

                        updateFormIndices(formContainer);
                    });

                    // Initialiser les événements sur les selects existants
                    document.querySelectorAll('.acte-select').forEach(function (acteSelect) {
                        acteSelect.selectedIndex = 0;
                        acteSelect.addEventListener('change', function () {
                            showSelectedOption(acteSelect);
                        });
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
                    const autreOptions = document.getElementById('autreOptions');

                    const secoursMedicalDetail = document.getElementById('secoursMedicalDetail');
                    var adherents = @json($adherents);
                    var ayantsDroit = @json($ayantsDroit);

                    const adherentInfo = document.getElementById('adherentInfo');
                    const beneficiaireIndicator = document.getElementById('beneficiaire');
                    const infosACompleter = document.getElementById('infosACompleter');


                    const beneficiaireInput = document.getElementById('beneficiaire');
                    const beneficiaireSelect = document.getElementById('beneficiaireSelect');
                    const editBeneficiaireBtn = document.getElementById('editBeneficiaire');
                    const cancelBeneficiaireBtn = document.getElementById('cancelBeneficiaire');
                    let originalBeneficiaireValue = '';

                    // Gérer le clic sur "Modifier"
                    editBeneficiaireBtn.addEventListener('click', function() {
                        originalBeneficiaireValue = beneficiaireInput.value;
                        beneficiaireSelect.value = beneficiaireInput.value;

                        beneficiaireInput.classList.add('hidden');
                        beneficiaireSelect.classList.remove('hidden');
                        editBeneficiaireBtn.classList.add('hidden');
                        cancelBeneficiaireBtn.classList.remove('hidden');
                    });

                    // Validation automatique lors du changement de sélection
                    beneficiaireSelect.addEventListener('change', function() {
                        beneficiaireInput.value = beneficiaireSelect.value;

                        beneficiaireInput.classList.remove('hidden');
                        beneficiaireSelect.classList.add('hidden');
                        editBeneficiaireBtn.classList.remove('hidden');
                        cancelBeneficiaireBtn.classList.add('hidden');
                    });

                    // Gérer le clic sur "Annuler"
                    cancelBeneficiaireBtn.addEventListener('click', function() {
                        beneficiaireInput.value = originalBeneficiaireValue;

                        beneficiaireInput.classList.remove('hidden');
                        beneficiaireSelect.classList.add('hidden');
                        editBeneficiaireBtn.classList.remove('hidden');
                        cancelBeneficiaireBtn.classList.add('hidden');
                    });



                    $('#adherentCode').on('change', function() {
                        const selectedCode = $(this).val(); // Récupérer la valeur sélectionnée
                        const selectedAdherent = adherents.find(adherent => adherent.code_carte === selectedCode);

                        if (selectedAdherent) {
                            document.getElementById('adherentNom').value = selectedAdherent.nom;
                            document.getElementById('adherentPrenom').value = selectedAdherent.prenom;
                            document.getElementById('adherentSexe').value = selectedAdherent.genre;
                            beneficiaireIndicator.value = 'Adhérent';

                            acteContainer.classList.remove('hidden');
                            adherentInfo.classList.remove('hidden');
                            infosACompleter.classList.remove('hidden');

                        } else {
                            const selectedAyantDroit = ayantsDroit.find(ayantDroit => ayantDroit.code === selectedCode);

                            if (selectedAyantDroit) {
                                document.getElementById('adherentNom').value = selectedAyantDroit.nom;
                                document.getElementById('adherentPrenom').value = selectedAyantDroit.prenom;
                                document.getElementById('adherentSexe').value = selectedAyantDroit.sexe;
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
