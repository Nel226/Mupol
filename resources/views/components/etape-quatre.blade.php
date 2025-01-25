<div>
    <!-- Statut -->
    <div>
        <label class="block text-gray-700 text-sm font-bold mb-1">Statut :</label>
        <div>
            <label class="inline-flex items-center">
                <input name="statut" type="radio" value="personnel_retraite" class="form-radio text-indigo-600" onchange="changeStatut('personnel_retraite')">
                <span class="ml-2">Personnel retraité</span>
            </label>
            <label class="inline-flex items-center">
                <input name="statut" type="radio" value="personnel_active" class="form-radio text-indigo-600" onchange="changeStatut('personnel_active')">
                <span class="ml-2">Personnel en activité</span>
            </label>
        </div>
    </div>

    <!-- Champs communs -->
    <div id="common_fields" class="mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" style="display: none;">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-1">Grade</label>
            <select id="grade" name="grade" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                <option value="" disabled selected>Sélectionnez un grade</option>
            </select>
        </div>
    </div>

    <!-- Champs pour Personnel Retraité -->
    <div id="personnel_retraite_fields" class="mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" style="display: none;">
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
    <div id="personnel_active_fields" class="mt-3" style="display: none;">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1">Date d'intégration</label>
                <input type="date" id="dateIntegration" name="dateIntegration" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1">Date de départ à la retraite</label>
                <input type="date" id="dateDepartARetraite" name="dateDepartARetraite" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            </div>
        </div>

        <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1">Direction</label>
                <input type="text" id="direction" name="direction" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1">Service</label>
                <input type="text" id="service" name="service" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            </div>
        </div>
    </div>
</div>

<script>
    const grades = [
        'Commissaire de Police', 'Commissaire Principale de Police', 'Commissaire Divisionnaire de Police',
        'Contrôleur Général de Police', 'Inspecteur Général de Police', 'Sous-Lieutenant de Police',
        'Lieutenant de Police', 'Capitaine de Police', 'Commandant de Police', 'Commandant Major de Police',
        'Sergent de Police', 'Sergent-Chef de Police', 'Adjudant de Police', 'Adjudant-Chef de Police',
        'Adjudant-Chef Major de Police'
    ];

    function resetFields() {
        const gradeSelector = document.getElementById('grade');
        gradeSelector.innerHTML = '<option value="" disabled selected>Sélectionnez un grade</option>';
        document.getElementById('departARetraite').value = '';
        document.getElementById('numeroCARFO').value = '';
        document.getElementById('dateIntegration').value = '';
        document.getElementById('dateDepartARetraite').value = '';
        document.getElementById('direction').value = '';
        document.getElementById('service').value = '';
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

        document.getElementById('common_fields').style.display = 'grid';
        document.getElementById('personnel_retraite_fields').style.display = statut === 'personnel_retraite' ? 'grid' : 'none';
        document.getElementById('personnel_active_fields').style.display = statut === 'personnel_active' ? 'grid' : 'none';
    }
</script>
