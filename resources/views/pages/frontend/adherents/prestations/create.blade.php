<x-guest-layout>
    <x-header-guest/>

    @if (session()->has('message'))
        <div id="success-notification" class="notification bg-green-500 text-white p-4 rounded mb-4 mx-6 mt-4 text-center shadow-lg">
            {{ session('message') }}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification');
                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 5000);
            });
        </script>
    @endif

    <x-sidebar-guest/>

    <div class="min-h-screen ml-64 bg-gray-50 dark:bg-gray-900 py-3">
        <section class="container mx-auto px-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mx-auto max-w-4xl">
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Ajouter une Prestation</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                        Code Carte : <span class="text-indigo-600 font-semibold">{{ $adherent->code_carte }}</span>
                    </p>
                </div>

                <form action="{{ route('prestations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <!-- Selection bénéficiaire -->
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="beneficiaire" value="moi" class="form-radio text-indigo-600" checked @change="isBeneficiarySelf = true">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Moi</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="beneficiaire" value="ayant_droit" class="form-radio text-indigo-600" @change="isBeneficiarySelf = false">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Ayant Droit</span>
                        </label>
                    </div>

                    <!-- Selection ayant droit -->
                    <div x-show="!isBeneficiarySelf" class="mt-4">
                        <label for="ayantDroit" class="block text-gray-700 dark:text-gray-300">Sélectionnez l&apos;ayant droit :</label>
                        <select name="ayantDroit" id="ayantDroit" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @if ($adherent->nombreAyantsDroits > 0)
                                @foreach($adherent->ayantsDroits as $ayantDroit)
                                    <option value="{{ $ayantDroit['nom'] }}">{{ $ayantDroit['prenom'] }} {{ $ayantDroit['nom'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Informations de prestation -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="idPrestation" class="block text-gray-700 dark:text-gray-300">ID Prestation</label>
                            <input type="text" name="idPrestation" id="idPrestation" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div>
                            <label for="contactPrestation" class="block text-gray-700 dark:text-gray-300">Contact</label>
                            <input type="text" name="contactPrestation" id="contactPrestation" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div>
                            <label for="acte" class="block text-gray-700 dark:text-gray-300">Acte</label>
                            <input type="text" name="acte" id="acte" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div>
                            <label for="date" class="block text-gray-700 dark:text-gray-300">Date de l'acte</label>
                            <input type="date" name="date" id="date" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div>
                            <label for="centre" class="block text-gray-700 dark:text-gray-300">Centre</label>
                            <input type="text" name="centre" id="centre" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div>
                            <label for="montant" class="block text-gray-700 dark:text-gray-300">Montant</label>
                            <input type="number" name="montant" id="montant" step="0.01" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div class="col-span-2">
                            <label for="preuve" class="block text-gray-700 dark:text-gray-300">Preuve de l'acte</label>
                            <input type="file" name="preuve[]" id="preuve" multiple class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mt-6">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md font-semibold shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Ajouter Prestation</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('prestationsForm', () => ({
                isBeneficiarySelf: true,
            }));
        });
    </script>
</x-guest-layout>
