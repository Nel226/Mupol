<x-app-layout>
    <x-sidebar />

    <div class="p-4 border-2 border-gray-200 rounded-lg sm:ml-64 dark:border-gray-700 mt-14">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <section class="bg-white dark:bg-gray-900">
                <div class="max-w-2xl px-4 py-4 mx-auto lg:py-8">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier un adhérent</h2>
                    <form action="{{ route('adherants.update', $adherant->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                <input type="text" name="nom" id="nom" value="{{ old('nom', $adherant->nom) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le nom de l'adhérent" required>
                            </div>
                            <div class="w-full">
                                <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $adherant->prenom) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-primary-500" placeholder="Entrez le prénom de l'adhérent" required>
                            </div>
                            <div class="w-full">
                                <label for="date_enregistrement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date d&apos;enregistrement</label>
                                <input type="date" name="date_enregistrement" id="date_enregistrement" value="{{ old('date_enregistrement', $adherant->date_enregistrement) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            </div>
                            <div class="w-full">
                                <label for="genre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre</label>
                                <div class="flex items-center p-2 space-x-4">
                                    <label class="inline-flex items-center text-gray-700 dark:text-white">
                                        <input type="radio" name="genre" value="M" {{ strtoupper($adherant->genre[0]) == 'M' ? 'checked' : '' }} class="text-[#4000FF] form-radio">
                                        <span class="ml-2 text-sm">Masculin</span>
                                    </label>
                                    <label class="inline-flex items-center text-gray-700 dark:text-white">
                                        <input type="radio" name="genre" value="F" {{ strtoupper($adherant->genre[0]) == 'F' ? 'checked' : '' }} class="text-[#4000FF] form-radio">
                                        <span class="ml-2 text-sm">Féminin</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="w-full">
                                <label for="service" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service</label>
                                <input type="text" name="service" id="service" value="{{ old('service', $adherant->service) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le service" required>
                            </div>
                            <div class="w-full">
                                <label for="no_matricule" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de Matricule</label>
                                <input type="text" name="no_matricule" id="no_matricule" value="{{ old('no_matricule', $adherant->no_matricule) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le numéro de matricule" required>
                            </div>
                            <div class="w-full">
                                <label for="code_carte" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code de Carte</label>
                                <input type="text" name="code_carte" id="code_carte" value="{{ old('code_carte', $adherant->code_carte) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le code de carte" required>
                            </div>
                            <div class="w-full">
                                <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                                <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $adherant->telephone) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le numéro de téléphone" required>
                            </div>
                            <div class="w-full">
                                <label for="charge" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Charge</label>
                                <select name="charge" id="charge" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="{{ old('charge', $adherant->charge) }}">{{ old('charge', $adherant->charge) }}</option>

                                    @for ($i = 0; $i <= 6; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="mensualite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mensualité</label>
                                <input type="number" name="mensualite" readonly id="mensualite" value="{{ old('mensualite', $adherant->mensualite) }}" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez la mensualité" required>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const chargeSelect = document.getElementById('charge');
                                    const mensualiteInput = document.getElementById('mensualite');
                                    
                                    function calculerMensualite(charge) {
                                        return 5000 + 2000 * charge;
                                    }
                                    
                                    mensualiteInput.value = calculerMensualite(parseInt(chargeSelect.value));
                                    
                                    // Écouter les changements de la sélection de charge
                                    chargeSelect.addEventListener('change', function() {
                                        mensualiteInput.value = calculerMensualite(parseInt(chargeSelect.value));
                                    });
                                });
                            </script>
                            <div class="w-full">
                                <label for="adhesion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adhésion</label>
                                <input type="text" name="adhesion" id="adhesion" readonly value="{{ old('adhesion', $adherant->adhesion) }}" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le statut d'adhésion" required>
                            </div>
                            
                        </div>
                        <div class="flex justify-end mt-4">
                            <x-primary-button type="submit" class="">
                                Mettre à jour l'adhérent
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
