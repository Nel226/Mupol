<div class="grid grid-cols-1 gap-4">
    <!-- Statut -->
    <div class="col-span-full">
        <label class="block text-gray-700 text-sm font-bold mb-1">Statut :</label>
        <div class="flex gap-6">
            <label class="inline-flex items-center">
                <input name="statut" type="radio" value="Retraité(e)" class="form-radio text-indigo-600" onchange="changeStatut('Retraité(e)')">
                <span class="ml-2">Personnel retraité</span>
            </label>
            <label class="inline-flex items-center">
                <input name="statut" type="radio" value="Actif(ve)" class="form-radio text-indigo-600" onchange="changeStatut('Actif(ve)')">
                <span class="ml-2">Personnel en activité</span>
            </label>
        </div>
    </div>

    <!-- Champs communs -->
    <div id="common_fields" class="hidden grid grid-cols-1 sm:grid-cols-2 gap-4 col-span-full">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1">Grade</label>
            <select id="grade" name="grade" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                <option value="" disabled selected>Sélectionnez un grade</option>
            </select>
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1">Direction</label>
            <input type="text" id="direction" name="direction" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>
    </div>

    <!-- Champs pour Personnel Retraité -->
    <div id="personnel_retraite_fields" class="hidden grid grid-cols-1 sm:grid-cols-2 gap-4 col-span-full">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1">Départ à la retraite</label>
            <input type="date" id="departARetraite" name="departARetraite" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1">Numéro CARFO</label>
            <input type="text" id="numeroCARFO" name="numeroCARFO" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>
    </div>

    <!-- Champs pour Personnel en Activité -->
    <div id="personnel_active_fields" class="hidden grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 col-span-full">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1">Date d&apos;intégration</label>
            <input type="date" id="dateIntegration" name="dateIntegration" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1">Date de départ à la retraite</label>
            <input type="date" id="dateDepartARetraite" name="dateDepartARetraite" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1">Service</label>
            <input type="text" id="service" name="service" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>
    </div>

    <!-- Autres Champs -->
    <div class="col-span-full">

        <fieldset class="border-2 border-gray-300 shadow-sm p-2 mt-1 mb-3 rounded-md ">
            <legend class="block text-gray-700 text-sm font-bold mb-2">Divisions administratives</legend>
            <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 col-span-full">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Région</label>
                    <select id="region" name="region" class="mt-1 bg-gray-100 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="" disabled selected>Choisissez votre région</option>
                        <!-- Options à ajouter ici -->
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Province</label>
                    <select id="province" name="province" class="mt-1 bg-gray-100 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required disabled>
                        <option value="" disabled selected>Choisissez d&apos;abord votre région</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Localité</label>
                    <input required type="text" id="localite" name="localite" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                </div>
                <script>
            
            
                    document.addEventListener("DOMContentLoaded", function() {
                        const regionSelect = document.getElementById("region");
                        const provinceSelect = document.getElementById("province");
                    
                        for (const region in regions) {
                            const option = document.createElement("option");
                            option.value = region;
                            option.textContent = region;
                            regionSelect.appendChild(option);
                        }
                    
                        regionSelect.addEventListener("change", function() {
                            const selectedRegion = regionSelect.value;
                    
                            provinceSelect.innerHTML = "";
                            provinceSelect.disabled = false;
                    
                            const defaultOption = document.createElement("option");
                            defaultOption.value = "";
                            defaultOption.disabled = true;
                            defaultOption.selected = true;
                            defaultOption.textContent = "Choisissez votre province";
                            provinceSelect.appendChild(defaultOption);
                    
                            regions[selectedRegion].provinces.forEach(province => {
                                const option = document.createElement("option");
                                option.value = province;
                                option.textContent = province;
                                provinceSelect.appendChild(option);
                            });
                        });
                    });
                    
                </script>
            </div>
        </fieldset>
    </div>


</div>

<script>
    const grades = [
        'Commissaire de Police', 'Commissaire Principal de Police', 'Commissaire Divisionnaire de Police',
        'Contrôleur Général de Police', 'Inspecteur Général de Police', 'Sous-Lieutenant de Police',
        'Lieutenant de Police', 'Capitaine de Police', 'Commandant de Police', 'Commandant Major de Police',
        'Sergent de Police', 'Sergent-Chef de Police', 'Adjudant de Police', 'Adjudant-Chef de Police',
        'Adjudant-Chef Major de Police'
    ];

    function resetFields() {
        document.getElementById('grade').innerHTML = '<option value="" disabled selected>Sélectionnez un grade</option>';
        ['departARetraite', 'numeroCARFO', 'dateIntegration', 'dateDepartARetraite', 'direction', 'service']
            .forEach(id => document.getElementById(id).value = '');
    }

    function fillGradeSelector() {
        const selector = document.getElementById('grade');
        grades.forEach(grade => {
            const option = document.createElement('option');
            option.value = grade;
            option.textContent = grade;
            selector.appendChild(option);
        });
    }

    function changeStatut(statut) {
        resetFields();
        fillGradeSelector();

        document.getElementById('common_fields').classList.remove('hidden');
        document.getElementById('personnel_retraite_fields').classList.toggle('hidden', statut !== 'Retraité(e)');
        document.getElementById('personnel_active_fields').classList.toggle('hidden', statut !== 'Actif(ve)');
    }
</script>
