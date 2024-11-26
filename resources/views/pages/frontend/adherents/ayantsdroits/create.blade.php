<x-guest-layout>
    <x-header-guest />

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


    <div class="min-h-screen ml-64 bg-gray-50 dark:bg-gray-900 py-3">
        <section class="container mx-auto px-6">
            <div class="bg-white min-h-screen dark:bg-gray-800 rounded-lg shadow-lg p-8 mx-auto max-w-4xl">
                <div class="mb-6 text-center">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Ajouter un ayant droit</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                        Code Carte : <span class="text-indigo-600 font-semibold">{{ $adherent->code_carte }}</span>
                    </p>
                </div>

                <form action="{{ route('adherents.nouveau-ayantdroit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-2xl mx-auto">
                    @csrf
                   
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                                
                        <div class="w-full">
                            <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-gren-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez le nom de l'ayant droit" required >
                        </div>
                        <div class="w-full">
                            <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-primary-500" placeholder="Entrez le prénom de l'ayant droit " required >
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">

                        <div class="w-full">
                            <label for="date_naissance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de Naissance</label>
                            <input type="date" name="date_naissance" id="date_naissance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required >
                        </div>
                        <div class="w-full">
                            <label for="sexe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexe</label>
                            <div id="sexe" class="flex items-center p-2 space-x-4">
                                <label class="inline-flex items-center text-gray-700 dark:text-white">
                                    <input type="radio" name="sexe" value="Masculin" class="text-[#4000FF] form-radio" >
                                    <span class="ml-2 text-sm">Masculin</span>
                                </label>
                                <label class="inline-flex items-center text-gray-700 dark:text-white">
                                    <input type="radio" name="sexe" value="Féminin" class="text-[#4000FF] form-radio" >
                                    <span class="ml-2 text-sm">Féminin</span>
                                </label>
                            </div>
                        </div>
                        <div class="w-full">
                           
                            <label for="relation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relation</label>
                            <select id="relation" name="relation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus-ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required  >
                                <option value="">-- Choisir --</option>
                                <option value="Enfant">Enfant</option>
                                <option value="Epoux">Epoux</option>
                                <option value="Epouse">Epouse</option>
                                
                            </select>
                        </div>
                        
                        
                       
                       
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md font-semibold shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 ease-in-out">Ajouter ayant droit</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    
</x-guest-layout>
