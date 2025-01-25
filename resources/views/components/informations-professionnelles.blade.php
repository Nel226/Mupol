<div x-data="statutHandler()">
    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
        <!-- Label "Statut" -->
        <label class="block text-gray-700 text-sm font-bold">Statut :</label>

        <!-- Options de statut -->
        <div class="grid grid-cols-1 sm:flex sm:items-center sm:space-x-4 ">
            <label class="inline-flex items-center">
                <input name="statut" type="radio" x-model="statut" value="personnel_retraite" class="form-radio text-indigo-600" @change="resetFields()">
                <span class="ml-2">Personnel retraité</span>
            </label>
            <label class="inline-flex items-center">
                <input name="statut" type="radio" x-model="statut" value="personnel_active" class="form-radio text-indigo-600" @change="resetFields()">
                <span class="ml-2">Personnel en activité</span>
            </label>
        </div>
    </div>

    <!-- Champs pour Personnel Retraité -->
    <template x-if="statut === 'personnel_retraite'">
        <div class=" mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1">Grade</label>
                <select x-model="grade" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                    <option value="" disabled selected>Sélectionnez un grade</option>
                    <template x-for="gradeOption in grades" :key="gradeOption">
                        <option x-text="gradeOption"></option>
                    </template>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1">Départ à la retraite</label>
                <input type="date" x-model="departARetraite" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1">Numéro CARFO</label>
                <input type="text" x-model="numeroCARFO" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            </div>
        </div>
    </template>

    <!-- Champs pour Personnel en Activité -->
    <template x-if="statut === 'personnel_active'">
        <div class="mt-3">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Grade</label>
                    <select x-model="grade" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Sélectionnez un grade</option>
                        <template x-for="gradeOption in grades" :key="gradeOption">
                            <option x-text="gradeOption"></option>
                        </template>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Date d'intégration</label>
                    <input type="date" x-model="dateIntegration" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Date de départ à la retraite</label>
                    <input type="date" x-model="dateDepartARetraite" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Direction</label>
                    <input type="text" x-model="direction" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Service</label>
                    <input type="text" x-model="service" class="bg-gray-50 border-2 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                </div>
            </div>
        </div>
    </template>
</div>


<script>
    function statutHandler() {
        return {
            statut: '', // Statut sélectionné
            grades: [
                'Commissaire de Police',
                'Commissaire Principale de Police',
                'Commissaire Divisionnaire de Police',
                'Contrôleur Général de Police',
                'Inspecteur Général de Police',
                'Sous-Lieutenant de Police',
                'Lieutenant de Police',
                'Capitaine de Police',
                'Commandant de Police',
                'Commandant Major de Police',
                'Sergent de Police',
                'Sergent-Chef de Police',
                'Adjudant de Police',
                'Adjudant-Chef de Police',
                'Adjudant-Chef Major de Police'
            ],
            grade: '',
            departARetraite: '',
            numeroCARFO: '',
            dateIntegration: '',
            dateDepartARetraite: '',
            direction: '',
            service: '',

            resetFields() {
                // Réinitialiser les champs selon le statut sélectionné
                this.grade = '';
                this.departARetraite = '';
                this.numeroCARFO = '';
                this.dateIntegration = '';
                this.dateDepartARetraite = '';
                this.direction = '';
                this.service = '';
            }
        };
    }
</script>
