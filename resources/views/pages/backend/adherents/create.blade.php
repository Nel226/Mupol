<x-app-layout>
    <x-sidebar />
    <x-content-page>
        <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        <x-header>
            {{$pageTitle}}
        </x-header>
        <x-content-page>
        
            <x-section class=" rounded-md dark:bg-gray-900">
                <div class="w-3/4 mx-auto">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Ajouter un nouvel adhérant</h2>
                    
                    <form method="POST" action="{{ route('adherents.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-3 sm:grid-cols-3 sm:gap-6">
                            <div class="grid grid-cols-2 gap-6 sm:col-span-3">
                                
                                <div class="w-full row-span-3">
                                    <div class="shrink-0">
                                        <img id='preview_img' class="object-cover w-48 h-48 rounded-full" src="{{ asset('images/user-90.png') }}" alt="Current profile photo" />
                                    </div>
                                    <span class="sr-only">Choisir une image</span>
                                    <input type="file" id="photo" name="photo" onchange="loadFile(event)"  class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-violet-100" />
                                </div>
                                
                                <!-- Script pour prévisualiser limage -->
                                <script>
                                    var loadFile = function(event) {
                                        var input = event.target;
                                        var file = input.files[0];
                                        var type = file.type;
                                        var output = document.getElementById('preview_img');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                        output.onload = function() {
                                            URL.revokeObjectURL(output.src) 
                                        }
                                    };
                                </script>
                                
                                <div class="w-full">
                                    <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                    <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nom de l'adhérent" required>
                                </div>
                                <div class="w-full">
                                    <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                    <input type="text" name="prenom" id="prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Prénom de l'adhérent" required>
                                </div>
                                <div class="w-full">
                                    <div>
                                        <label for="genre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexe</label>
                                        <div class="flex items-center space-x-4">
                                            <input type="radio" id="genre_masculin" name="genre" value="Masculin" class="text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-700">
                                            <label for="genre_masculin" class="text-sm text-gray-900 dark:text-white">Masculin</label>
                                            <input type="radio" id="genre_feminin" name="genre" value="Féminin" class="text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-700">
                                            <label for="genre_feminin" class="text-sm text-gray-900 dark:text-white">Féminin</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-6 sm:col-span-3">
                                <div class="w-full">
                                    <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de téléphone</label>
                                    <input type="number" name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex : 70226288" required>
                                </div>
                                <div class="w-full">
                                    <label for="service" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service</label>
                                    <input type="text" name="service" id="service" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Service de l'adhérent" required>
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="no_matricule" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de Matricule</label>
                                <input type="text" name="no_matricule" id="no_matricule" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Numéro de matricule" required>
                            </div>
                            <div class="w-full">
                                <label for="code_carte" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code du mutualiste</label>
                                <input type="text" name="code_carte" id="code_carte" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Code du mutualiste" required>
                            </div>
                            <div class="w-full">
                                <label for="charge" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Charge</label>
                                <select name="charge" i
                                d="charge" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    @for ($i = 0; $i <= 6; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>                            
                            <div class="grid grid-cols-2 gap-6 sm:col-span-3">
                                <div class="w-full">
                                    <label for="mensualite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mensualité</label>
                                    <input readonly type="number" name="mensualite" id="mensualite" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mensualité de l'adhérent" required>
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
                                    <label for="adhesion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix de l&apos;adhésion</label>
                                    <input type="number" name="adhesion" readonly value="10000" id="adhesion" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                </div>
                                <div class="w-full">
                                    <label for="date_enregistrement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de l&apos;adhésion</label>
                                    <input type="date" name="date_enregistrement"  value="10000" id="date_enregistrement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                </div>
                            </div>
                        </div>
                        <!-- Bouton denvoi -->
                        <button type="submit" class="mt-5 text-white bg-[#4000FF] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Ajouter Adhérent
                        </button>
                    </form>
                </div>
            </x-section>
        </x-content-page>
    </x-content-page>
</x-app-layout>