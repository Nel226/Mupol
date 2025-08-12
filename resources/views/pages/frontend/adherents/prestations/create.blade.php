<x-guest-layout>
    <x-preloader/>


    @if (session('success'))
    <x-succes-notification>
        {{ session('success') }}
    </x-succes-notification>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notification = document.getElementById('success-notification-content');
            const closeBtn = document.getElementById('close-notification');

            notification.classList.remove('hidden');

            closeBtn.addEventListener('click', () => {
                notification.classList.add('hidden');
            });
        });
    </script>
    @endif
    <div id="app-layout" class="overflow-x-hidden flex">
        @include("components.navbar-guest-connected")
        <!-- app layout content -->
        <div
            id="app-layout-content"
            class="layout-guest min-h-screen w-full lg:pl-[5.625rem] transition-all duration-300 ease-out">

            @include("components.top-navbar-guest-connected")

            <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                <!-- title -->
                <h1 class="text-xl text-white">{{ $pageTitle }}</h1>

            </div>
            <div class="-mt-12 mx-6 mb-6 ">
                <div class="bg-gray-50 min-h-screen dark:bg-gray-800 rounded-lg shadow-lg p-2  mx-auto max-w-4xl">
                    <div class="mb-4 text-center">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Ajouter une demande</h2>

                    </div>

                    <form action="{{ route('adherents.nouvelle-prestation.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-2xl mx-auto p-4 bg-white shadow-md rounded-md">
                        @csrf
                        <input type="hidden" name="adherentCode" value="{{ $adherent->code_carte }}">
                        <input type="hidden" name="adherentNom" value="{{ $adherent->nom }}">
                        <input type="hidden" name="adherentPrenom" value="{{ $adherent->prenom }}">
                        <input type="hidden" name="adherentSexe" value="{{ $adherent->genre }}">
                        <input type="hidden" name="beneficiaireInput" value="adherent">
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const beneficiaireSelect = document.getElementById('beneficiaire');
                                const beneficiaireInput = document.getElementById('beneficiaireInput');

                                beneficiaireSelect.addEventListener('change', function() {
                                    beneficiaireInput.value = this.value;
                                });
                            });
                        </script>

                        <!-- Selection bénéficiaire -->
                        <div class="flex items-center justify-center space-x-8">
                            <label class="inline-flex items-center">
                                <input type="radio" name="beneficiaire" value="moi" class="form-radio text-indigo-600" onclick="toggleBeneficiary(true)" checked>
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Moi</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="beneficiaire" value="ayant_droit" class="form-radio text-indigo-600" onclick="toggleBeneficiary(false)">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Ayant Droit</span>
                            </label>
                        </div>

                        <!-- Selection ayant droit -->
                        <div id="ayantDroitContainer" class="mt-4 hidden">
                            <label for="ayantDroit" class="block text-gray-700 dark:text-gray-300 font-semibold">Sélectionnez l&apos;ayant droit :</label>
                            <select name="ayantDroit" id="ayantDroit" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @if ($adherent->nombreAyantsDroits > 0)
                                    @foreach($adherent->ayantsDroits as $ayantDroit)
                                        <option value="{{ $ayantDroit['nom'] }}">{{ $ayantDroit['prenom'] }} {{ $ayantDroit['nom'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Informations de prestation -->
                        <div class="space-y-4">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <div>
                                    <label for="contactPrestation" class="block text-gray-700 dark:text-gray-300 font-semibold">Contact</label>
                                    <input type="number" name="contactPrestation" id="contactPrestation" placeholder="Numéro mobile money" class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                                </div>
                                <div>

                                    <label for="acte" class="block text-gray-700 dark:text-gray-300 font-semibold">Acte</label>

                                    <select id="acte" name="acte" class="acte-select block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
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
                                </div>
                            </div>

                            <!-- Options spécifiques -->
                            <div id="consultationOptions" class="options hidden">
                                <h3 class="mb-2 text-xl font-semibold">Consultation</h3>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class=" ">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                        <input id="date" name="date_consultation" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                    </div>

                                    <div class=" ">
                                        <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                        <input id="centre" name="centre_consultation" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                    </div>
                                </div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Type de consultation :</label>
                                <select id="typeConsultation" name="type_consultation" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
                                    <option value="">-- Sélectionner le type de consultation --</option>
                                    <option value="infirmier">Infirmier</option>
                                    <option value="MG">Médecin généraliste</option>
                                    <option value="kinetherapeutre">Kinéthérapeutre</option>
                                    <option value="dentiste">Dentiste</option>
                                    <option value="specialiste">Spécialiste</option>
                                </select>
                                <div id="specialiteContainer" class="hidden">
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Spécialiste :</label>
                                    <select name="sous_type_consultation" id="specialiteMedicale" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg">
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
                                        <option value="MPR">Médecine Physique et de Réhabilitation (MPR)</option>
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
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                        <input id="montant" name="montant_consultation" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg" >
                                    </div>

                                    <div class="">
                                        <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                        <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" >
                                    </div>
                                </div>
                            </div>

                            <div id="hospitalisationOptions" class="hospitalisation options hidden">
                                <h3 class="mb-2 text-xl font-semibold">Hospitalisation</h3>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="date_hospitalisation" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                        <input id="date_hospitalisation" name="date_hospitalisation" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg" >
                                    </div>

                                    <div class="">
                                        <label for="centre_hospitalisation" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                        <input id="centre_hospitalisation" name="centre_hospitalisation" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg" >
                                    </div>
                                </div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Durée :</label>
                                <select name="type_hospitalisation" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg" >
                                    <option value="">-- Sélectionner la durée --</option>
                                    <option value="inf-2-jours">Inférieur à 2 jours</option>
                                    <option value="2-7-jours">2 à 7 jours</option>
                                    <option value="7-14-jours">7 à 14 jours</option>
                                    <option value="15-plus-jours">15 jours et plus</option>
                                </select>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="montant_hospitalisation" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                        <input id="montant_hospitalisation" name="montant_hospitalisation" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg" >
                                    </div>

                                    <div class="">
                                        <label for="preuve_hospitalisation" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                        <input id="preuve_hospitalisation" name="preuve[]" type="file" multiple accept=".pdf" class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" >
                                    </div>
                                </div>
                            </div>
                            <div id="analyseBiomedicaleOptions" class="options analyse_biomedicale hidden">

                                <h3 class="mb-2 text-xl font-semibold">Analyse biomédicale</h3>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                        <input id="date"  name="date_analyse_biomedicale" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                        <input id="centre" name="centre_analyse_biomedicale" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                </div>

                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                        <input id="montant"  name="montant_analyse_biomedicale" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg "  >
                                    </div>

                                    <div class="">
                                        <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve (Format PDF):</label>
                                        <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" >
                                    </div>

                                </div>
                            </div>

                            <div id="radioOptions" class="options radio hidden">
                                <h3 class="mb-2 text-xl font-semibold">Radio</h3>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                        <input id="date" name="date_radio" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg "  >
                                    </div>

                                    <div class="">
                                        <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                        <input id="centre" name="centre_radio" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                </div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Type :</label>
                                <select name="type_radio" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg" >
                                    <option value="">-- Sélectionner le type de radiographie --</option>
                                    <option value="radio-standard">Radio standard</option>
                                    <option value="echo">Échographie</option>
                                    <option value="echo-doppler">Échographie Doppler</option>
                                    <option value="ecg">ECG</option>
                                    <option value="endoscopie">Endoscopie</option>
                                    <option value="irm">IRM</option>
                                    <option value="scanner">Scanner</option>
                                </select>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                        <input id="montant" name="montant_radio" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                        <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" >
                                    </div>

                                </div>
                            </div>

                            <div id="pharmacieOptions" class="options pharmacie hidden">

                                <h3 class="mb-2 text-xl font-semibold">Pharmacie</h3>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                        <input id="date"  name="date_pharmacie" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg "  >
                                    </div>

                                    <div class="">
                                        <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                        <input id="centre" name="centre_pharmacie" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg "  >
                                    </div>

                                </div>

                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                        <input id="montant"  name="montant_pharmacie" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                        <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" >
                                    </div>

                                </div>
                            </div>

                            <div id="materniteOptions" class="options maternite hidden">

                                <h3 class="mb-2 text-xl font-semibold">Maternité</h3>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                        <input id="date"  name="date_maternite" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                        <input id="centre" name="centre_maternite" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg "  >
                                    </div>

                                </div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Type :</label>
                                <select name="type_maternite" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg" >
                                    <option value="">-- Sélectionner le type de maternité --</option>
                                    <option value="naissance-vivante">Naissance vivante</option>
                                    <option value="deces">Décès</option>
                                </select>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                        <input id="montant"  name="montant_maternite" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg "  >
                                    </div>

                                    <div class="">
                                        <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                        <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" >
                                    </div>

                                </div>
                            </div>

                            <div id="optiqueOptions" class="options optique hidden">

                                <h3 class="mb-2 text-xl font-semibold">Optique</h3>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                        <input id="date"  name="date_optique" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                        <input id="centre" name="centre_optique" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                </div>

                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                        <input id="montant"  name="montant_optique" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                        <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                    </div>

                                </div>
                            </div>

                            <div id="dentaireAuditifOptions" class="options dentaire_auditif hidden">

                                <h3 class="mb-2 text-xl font-semibold">Dentaire et auditif</h3>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                        <input id="date"  name="date_dentaire_auditif" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                        <input id="centre" name="centre_dentaire_auditif" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                </div>

                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                        <input id="montant"  name="montant_dentaire_auditif" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                        <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                    </div>

                                </div>
                            </div>

                            <div id="allocationOptions" class="options allocation hidden">
                                <h3 class="mb-2 text-xl font-semibold">Allocation</h3>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                        <input id="date"  name="date_allocation" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
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
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                        <input id="montant" name="montant_allocation" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                        <input id="preuve" name="preuve[]" type="file" multiple accept=".pdf" class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                    </div>

                                </div>
                            </div>
                            <div id="autreOptions" class="options autre hidden">

                                <h3 class="mb-2 text-xl font-semibold">Autre</h3>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date :</label>
                                        <input id="date"  name="date_autre" type="date" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="centre" class="block mb-2 text-sm font-medium text-gray-900">Centre de santé :</label>
                                        <input id="centre" name="centre_autre" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                </div>
                                <div class="w-full">
                                    <label for="type_autre" class="block mb-2 text-sm font-medium text-gray-900">Détails :</label>
                                    <input id="type_autre" name="type_autre" type="text" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                </div>


                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div class="">
                                        <label for="montant" class="block mb-2 text-sm font-medium text-gray-900">Montant :</label>
                                        <input id="montant"  name="montant_autre" type="number" class="block w-full p-2 mb-4 border border-gray-300 rounded-lg " >
                                    </div>

                                    <div class="">
                                        <label for="preuve" class="block mb-2 text-sm font-medium text-gray-900">Preuve :</label>
                                        <input id="preuve" name="preuve[]" type="file" multiple class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                    </div>

                                </div>
                            </div>

                            <script>
                                const acteSelect = document.getElementById('acte');
                                const consultationOptions = document.getElementById('consultationOptions');
                                const hospitalisationOptions = document.getElementById('hospitalisationOptions');
                                const specialiteContainer = document.getElementById('specialiteContainer');
                                const analyseBiomedicaleOptions = document.getElementById('analyseBiomedicaleOptions');

                                const radioOptions = document.getElementById('radioOptions');
                                const pharmacieOptions = document.getElementById('pharmacieOptions');

                                const materniteOptions = document.getElementById('materniteOptions');
                                const optiqueOptions = document.getElementById('optiqueOptions');
                                const dentaireAuditifOptions = document.getElementById('dentaireAuditifOptions');

                                const allocationOptions = document.getElementById('allocationOptions');
                                const autreOptions = document.getElementById('autreOptions');

                                const secoursMedicalDetail = document.getElementById('secoursMedicalDetail');

                                acteSelect.addEventListener('change', function() {
                                    // Hide all option sections initially
                                    consultationOptions.classList.add('hidden');
                                    hospitalisationOptions.classList.add('hidden');
                                    specialiteContainer.classList.add('hidden');
                                    analyseBiomedicaleOptions.classList.add('hidden');
                                    radioOptions.classList.add('hidden');
                                    pharmacieOptions.classList.add('hidden');
                                    materniteOptions.classList.add('hidden');
                                    optiqueOptions.classList.add('hidden');
                                    dentaireAuditifOptions.classList.add('hidden');
                                    allocationOptions.classList.add('hidden');
                                    secoursMedicalDetail.classList.add('hidden');
                                    autreOptions.classList.add('hidden');

                                    // Show specific options based on selection
                                    switch (this.value) {
                                        case 'consultation':
                                            consultationOptions.classList.remove('hidden');
                                            break;
                                        case 'hospitalisation':
                                            hospitalisationOptions.classList.remove('hidden');
                                            break;
                                        case 'specialite':
                                            specialiteContainer.classList.remove('hidden');
                                            break;
                                        case 'analyse_biomedicale':
                                            analyseBiomedicaleOptions.classList.remove('hidden');
                                            break;
                                        case 'radio':
                                            radioOptions.classList.remove('hidden');
                                            break;
                                        case 'pharmacie':
                                            pharmacieOptions.classList.remove('hidden');
                                            break;
                                        case 'maternite':
                                            materniteOptions.classList.remove('hidden');
                                            break;
                                        case 'optique':
                                            optiqueOptions.classList.remove('hidden');
                                            break;
                                        case 'dentaire_auditif':
                                            dentaireAuditifOptions.classList.remove('hidden');
                                            break;
                                        case 'allocation':
                                            allocationOptions.classList.remove('hidden');
                                            break;
                                        case 'autre':
                                            autreOptions.classList.remove('hidden');
                                            break;
                                        case 'secoursMedical':
                                            secoursMedicalDetail.classList.remove('hidden');
                                            break;
                                        default:
                                            break;
                                    }
                                });

                                // Show or hide specialty options based on type of consultation selection
                                const typeConsultation = document.getElementById('typeConsultation');
                                typeConsultation.addEventListener('change', function() {
                                    if (this.value === 'specialiste') {
                                        specialiteContainer.classList.remove('hidden');
                                    } else {
                                        specialiteContainer.classList.add('hidden');
                                    }
                                });
                            </script>
                            <script>
                                function toggleBeneficiary(isSelf) {
                                    const ayantDroitContainer = document.getElementById('ayantDroitContainer');
                                    if (isSelf) {
                                        ayantDroitContainer.classList.add('hidden');
                                    } else {
                                        ayantDroitContainer.classList.remove('hidden');
                                    }
                                }
                            </script>

                        </div>

                        <!-- Bouton -->
                        <div class="text-center">
                            <button type="submit"
                                class="btn bg-indigo-600  hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                                Ajouter prestation
                            </button>
                        </div>
                    </form>

                </div>
                @include("components.footer-guest-connected")

            </div>

        </div>

    </div>

</x-guest-layout>


