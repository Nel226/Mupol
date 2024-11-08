<x-app-layout>
    <x-sidebar/>
    
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

    <x-content-page>
        @section('navigation-content')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" :pageTitle="$pageTitle"/>
        @endsection      

        <div class="flex-1 p-6">
            <x-header>
                {{$pageTitle}}
            </x-header>

            <div class="p-6 mx-auto mt-4 bg-white min-h-screen rounded-b-lg shadow-lg ">

                <div class="container mx-auto p-4">
            
                    <form method="GET" action="{{ route('budget-suivi.index') }}" class="mb-6 flex items-center space-x-4" id="year-form">
                        <label for="year" class="text-base font-medium">Sélectionnez l&apos;année:</label>
                        <select name="year" id="year" class="form-select block w-[15%] border border-gray-300 rounded-md px-2 py-2">
                            @foreach(range(date('Y'), 2000) as $year)
                                <option value="{{ $year }}" {{ request('year', date('Y')) == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                        <x-primary-button type="submit" class="">Valider</x-primary-button>
                    </form>

                    <!-- Indicateur de chargement -->
                    <div id="loading" class="hidden text-center animate-pulse my-4">
                        <span>Chargement...</span>
                    </div>

                    <div class="overflow-x-auto shadow-md ">
                        <table  id="suivi-table" class="min-w-full table-auto bg-white border-collapse border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr >
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 border-b">Libellé</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Prévu</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Trimestre 1</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Trimestre 2</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Trimestre 3</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Trimestre 4</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Total réalisé</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Écart</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Taux de réalisation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $types = ['recette' => 'RECETTES (RESSOURCES)', 'depense' => 'DEPENSES (EMPLOIS)'];
                                    $year = request()->get('year', 2024); // Accède directement à la requête dans la vue Blade

                                @endphp
                                
                                @foreach ($types as $type => $typeLabel)
                                    <tr>
                                        <td colspan="9" class="px-6 py-2 text-left font-bold text-gray-900 border-b bg-gray-200">{{ $typeLabel }}</td>
                                    </tr>
                                    
                                    <!-- Affichage des catégories principales du type actuel (parent_id NULL) -->
                                    @foreach ($categories->where('type', $type)->whereNull('parent_id') as $categorie)
                                        @php
                                            $totauxTrimestre = $categorie->totalParTrimestre($type, $year);
                                            $totalRealise = $categorie->getTotalRealise($type, $year);
                                            $ecart = $categorie->getEcart($type, $year);
                                            $tauxRealisation = $categorie->getTauxRealisation($type, $year);
                                        @endphp
                                        <tr class=" text-xs" >
                                            <td class="px-6 py-2 text-left font-semibold border-b">{{ $categorie->nom }}</td>
                                            <td class="px-6 py-2 text-center border-b">{{ $categorie->montant_prevu }}</td>
                                            <td class="px-6 py-2 text-center border-b">{{ $totauxTrimestre['trimestre_1'] }}</td>
                                            <td class="px-6 py-2 text-center border-b">{{ $totauxTrimestre['trimestre_2'] }}</td>
                                            <td class="px-6 py-2 text-center border-b">{{ $totauxTrimestre['trimestre_3'] }}</td>
                                            <td class="px-6 py-2 text-center border-b">{{ $totauxTrimestre['trimestre_4'] }}</td>
                                            <td class="px-6 py-2 text-center border-b">{{ $totalRealise }}</td>
                                            <td class="px-6 py-2 text-center border-b">{{ $ecart }}</td>
                                            <td class="px-6 py-2 text-center border-b">{{ number_format($tauxRealisation, 2) }}%</td>
                                        </tr>
                            
                                        <!-- Affichage des sous-catégories de la catégorie principale -->
                                        @foreach ($categorie->children as $sousCategorie)
                                            @php
                                                $totauxSousCategorie = $sousCategorie->totalParTrimestre($type, $year);
                                                $totalSousCategorie = $sousCategorie->getTotalRealise($type, $year);
                                                $ecartSousCategorie = $sousCategorie->getEcart($type, $year);
                                                $tauxSousCategorie = $sousCategorie->getTauxRealisation($type, $year);
                                            @endphp
                                            <tr class=" text-xs">
                                                <td class="px-6 py-2 text-left pl-10 border-b text-gray-700">{{ $sousCategorie->nom }}</td>
                                                <td class="px-6 py-2 text-center border-b">{{ $sousCategorie->montant_prevu }}</td>
                                                <td class="px-6 py-2 text-center border-b">{{ $totauxSousCategorie['trimestre_1'] }}</td>
                                                <td class="px-6 py-2 text-center border-b">{{ $totauxSousCategorie['trimestre_2'] }}</td>
                                                <td class="px-6 py-2 text-center border-b">{{ $totauxSousCategorie['trimestre_3'] }}</td>
                                                <td class="px-6 py-2 text-center border-b">{{ $totauxSousCategorie['trimestre_4'] }}</td>
                                                <td class="px-6 py-2 text-center border-b">{{ $totalSousCategorie }}</td>
                                                <td class="px-6 py-2 text-center border-b  ">{{ $ecartSousCategorie }}</td>
                                                <td class="px-6 py-2 text-center border-b">{{ number_format($tauxSousCategorie, 2) }}%</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                            
                            
                        </table>
                    </div>
                    
                    <!-- Placeholder à afficher pendant le chargement -->
                    <div id="placeholder-table" class="overflow-x-auto shadow-md hidden">
                        <table class="min-w-full table-auto bg-white border-collapse border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 border-b">Libellé</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Prévu</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Trimestre 1</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Trimestre 2</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Trimestre 3</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Trimestre 4</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Total réalisé</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Écart</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 border-b">Taux de réalisation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-xs">
                                    <td class="px-6 py-2 text-left border-b"><span class="animate-pulse text-gray-300">Libellé...</span></td>
                                    <td class="px-6 py-2 text-center border-b"><span class="animate-pulse text-gray-300">---</span></td>
                                    <td class="px-6 py-2 text-center border-b"><span class="animate-pulse text-gray-300">---</span></td>
                                    <td class="px-6 py-2 text-center border-b"><span class="animate-pulse text-gray-300">---</span></td>
                                    <td class="px-6 py-2 text-center border-b"><span class="animate-pulse text-gray-300">---</span></td>
                                    <td class="px-6 py-2 text-center border-b"><span class="animate-pulse text-gray-300">---</span></td>
                                    <td class="px-6 py-2 text-center border-b"><span class="animate-pulse text-gray-300">---</span></td>
                                    <td class="px-6 py-2 text-center border-b"><span class="animate-pulse text-gray-300">---</span></td>
                                    <td class="px-6 py-2 text-center border-b"><span class="animate-pulse text-gray-300">---</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <script>
                        // Fonction pour afficher/masquer les éléments pendant le chargement
                        document.getElementById("year-form").addEventListener("submit", function(event) {
                            event.preventDefault();
                            document.getElementById("loading").classList.remove("hidden");
                            document.getElementById("suivi-table").classList.add("hidden");
                            document.getElementById("placeholder-table").classList.remove("hidden");
                    
                            // Soumettre le formulaire après un délai de chargement simulé
                            setTimeout(() => {
                                this.submit();
                            }, 1000); // Simule un délai de 1 seconde avant la soumission
                        });
                    </script>
                    
                </div>             
            </div>
        </div>
    </x-content-page>
    
</x-app-layout>
