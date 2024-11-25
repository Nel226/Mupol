<x-app-layout>
    <x-sidebar />
    
    <div class="p-4 border-2 border-gray-200 rounded-lg sm:ml-64 dark:border-gray-700 mt-14">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            
            <section class="bg-white dark:bg-gray-900">
                <div class="max-w-2xl px-4 py-4 mx-auto lg:py-8">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier un ayant droit</h2>
                    <form action="{{ route('ayantsdroits.update', $ayantDroit->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                
                                
                                <label for="adherent_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Matricule de l&apos;adhérent</label>
                                <select name="adherent_id" id="adherent_id" style="height:30px" 
                                        class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        required>
                                    <option value="{{ $ayantDroit->adherent->no_matricule }}" selected="selected">{{ $ayantDroit->adherent->no_matricule }} "Ancienne valeur"</option> <!-- Option par défaut -->

                                    @foreach ($adherents as $adherent)
                                        <option value="{{ $adherent->no_matricule }}">
                                            Mle {{ $adherent->no_matricule }} : {{ $adherent->nom }} {{ $adherent->prenom }}
                                        </option>
                                    @endforeach
                                </select>

                                
                                
                            </div>
                            
                            <script>
                                
                                
                                $(document).ready(function () {
                                    $("#adherent_id").select2({
                                        placeholder: 'Sélectionnez le matricule adhérent',
                                        language: "fr"
                                    });
                                
                                    $("#adherent_id").val("{{ $ayantDroit->adherent_id }}").trigger('change');
                                
                                    // Function to toggle form fields based on selection
                                    function toggleFormFields() {
                                        var selectedValue = $("#adherent_id").val();
                                        if (selectedValue) {
                                            $("#nom, #prenom, #date_naissance, #sexe input, #relation, #code")
                                                .prop('disabled', false)
                                                .removeClass('bg-gray-200');
                                        } else {
                                            $("#nom, #prenom, #date_naissance, #sexe input, #relation, #code")
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
                                <input type="text" name="nom" id="nom" value="{{ old('nom', $ayantDroit->nom) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le nom de l'ayant droit" required>
                            </div>
                            <div class="w-full">
                                <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $ayantDroit->prenom) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-primary-500" placeholder="Entrez le prénom de l'ayant droit" required>
                            </div>
                            <div class="w-full">
                                <label for="date_naissance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de Naissance</label>
                                <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $ayantDroit->date_naissance) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            </div>
                            <div class="w-full">
                                <label for="sexe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexe</label>
                                <div id="sexe" class="flex items-center p-2 space-x-4">
                                    <label class="inline-flex items-center text-gray-700 dark:text-white">
                                        <input type="radio" name="sexe" value="M" {{ strtoupper($ayantDroit->sexe[0]) == 'M' ? 'checked' : '' }} class="text-[#4000FF] form-radio">
                                        <span class="ml-2 text-sm">Masculin</span>
                                    </label>
                                    <label class="inline-flex items-center text-gray-700 dark:text-white">
                                        <input type="radio" name="sexe" value="F" {{ strtoupper($ayantDroit->sexe[0]) == 'F' ? 'checked' : '' }} class="text-[#4000FF] form-radio">
                                        <span class="ml-2 text-sm">Féminin</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="w-full">
                                <label for="relation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relation</label>
                                <select id="relation" name="relation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="Enfant" {{ $ayantDroit->relation == 'Enfant' ? 'selected' : '' }}>Enfant</option>
                                    <option value="Epoux" {{ $ayantDroit->relation == 'Epoux' ? 'selected' : '' }}>Epoux</option>
                                    <option value="Epouse" {{ $ayantDroit->relation == 'Epouse' ? 'selected' : '' }}>Epouse</option>
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                                <input type="text" name="code" id="code" value="{{ old('code', $ayantDroit->code) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Saisissez le code" required>
                            </div>
                        </div>
                        <div class="flex items-end justify-end mt-8">
                            <x-primary-button type="submit" class="">
                                Mettre à jour l&apos;ayant droit
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </section>
            
        </div>
    </div>
    
</x-app-layout>
