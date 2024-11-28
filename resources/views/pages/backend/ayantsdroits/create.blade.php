

<x-app-layout>
    <x-sidebar />
    <x-content-page>
        <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        <x-header>
            {{$pageTitle}}
        </x-header>
        <x-section class="bg-white rounded-md dark:bg-gray-900">
            <div class="max-w-2xl px-4 py-4 mx-auto lg:py-8">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Ajouter un nouvel ayant droit</h2>
                <form action="{{ route('ayantsdroits.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="adherent_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Matricule de l&apos;adhérent</label>
                            <select name="adherent_id" id="adherent_id" style="height:30px" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value=""></option>
                                @foreach ($adherents as $adherent)
                                <option value="{{ $adherent->no_matricule }}">Mle {{ $adherent->no_matricule }} : {{ $adherent->nom }} {{ $adherent->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <script>
                            $(document).ready(function (){
                                $("#adherent_id").select2({
                                    height:'20px',
                                    placeholder: 'Sélectionnez le matricule adhérant',
                                    language: "fr",
                                });
                            })
                            $(document).ready(function() {
                                function toggleFormFields() {
                                    var selectedValue = $("#adherent_id").val();
                                    if (selectedValue) {
                                        $("#nom, #prenom, #date_naissance, #sexe input, #relation , #code")
                                        .prop('disabled', false)
                                        .removeClass('bg-gray-200');
                                    } else {
                                        $("#nom, #prenom, #date_naissance, #sexe input, #relation , #code")
                                        .prop('disabled', true)
                                        .addClass('bg-gray-200');
                                    }
                                }
                                
                                toggleFormFields();
                                $("#adherent_id").change(toggleFormFields);
                            });
                        </script>
                        
                        <div class="w-full">
                            <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-gren-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le nom de l'ayant droit" required >
                        </div>
                        <div class="w-full">
                            <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-primary-500" placeholder="Entrez le prénom de l'ayant droit " required >
                        </div>
                        <div class="w-full">
                            <label for="date_naissance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de Naissance</label>
                            <input type="date" name="date_naissance" id="date_naissance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required >
                        </div>
                        <div class="w-full">
                            <label for="sexe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexe</label>
                            <div id="sexe" class="flex items-center p-2 space-x-4">
                                <label class="inline-flex items-center text-gray-700 dark:text-white">
                                    <input type="radio" name="sexe" value="Masculin" class="text-primary1 form-radio" disabled>
                                    <span class="ml-2 text-sm">Masculin</span>
                                </label>
                                <label class="inline-flex items-center text-gray-700 dark:text-white">
                                    <input type="radio" name="sexe" value="Féminin" class="text-primary1 form-radio" disabled>
                                    <span class="ml-2 text-sm">Féminin</span>
                                </label>
                            </div>
                        </div>
                        <div class="w-full">
                           
                            <label for="relation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relation</label>
                            <select id="relation" name="relation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus-ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">-- Choisir --</option>
                                <option value="Enfant">Enfant</option>
                                <option value="Epoux">Epoux</option>
                                <option value="Epouse">Epouse</option>
                                
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                            <input type="text" name="code" id="code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus-ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Saisissez le code " required disabled>
                        </div>
                        
                        <script>
                            $(document).ready(function() {
                                let adherentPrefix = '';
                        
                                function toggleFormFields() {
                                    var selectedValue = $("#adherent_id").val();
                                    if (selectedValue) {
                                        $("#nom, #prenom, #date_naissance, #sexe input, #relation , #code")
                                            .prop('disabled', false)
                                            .removeClass('bg-gray-200');
                                    } else {
                                        $("#nom, #prenom, #date_naissance, #sexe input, #relation , #code")
                                            .prop('disabled', true)
                                            .addClass('bg-gray-200');
                                    }
                                }
                        
                                toggleFormFields();
                        
                                $("#adherent_id").change(function() {
                                    toggleFormFields();
                                    
                                    var adherentCode = $(this).val();
                                    if (adherentCode) {
                                        adherentPrefix = adherentCode + "/";
                                        
                                        $("#code").val(adherentPrefix);
                                        $("#code").prop('disabled', false);
                                    } else {
                                        $("#code").val("");
                                        $("#code").prop('disabled', true);
                                    }
                                });
                        
                                $("#code").on('input', function() {
                                    var currentValue = $(this).val();
                                    
                                    if (!currentValue.startsWith(adherentPrefix)) {
                                        $(this).val(adherentPrefix);
                                    }
                                });
                            });
                        </script>  
                       
                    </div>
                    <div class="flex items-end justify-end mt-8">
                        <x-primary-button type="submit" class="">
                            Ajouter Ayant Droit
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </x-section>
    </x-content-page>
    
</x-app-layout>
