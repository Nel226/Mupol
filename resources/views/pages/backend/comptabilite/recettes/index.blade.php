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
        
            <div class="p-6 mx-auto mt-4 bg-white min-h-screen rounded-b-lg shadow-lg">
                <!-- Tabs Navigation -->
                <div class="flex mt-4 shadow-md border rounded-md">
                    <button id="tab-all" class="w-1/5 py-2 text-center rounded-md text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:scale-105 active-tab">Tous</button>
                    <button id="tab-prets" class="w-1/5 py-2 text-center rounded-md text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:scale-105">Prêts</button>
                    <button id="tab-recettes-propres" class="w-1/5 py-2 text-center rounded-md text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:scale-105">Recettes propres</button>
                    <button id="tab-produits" class="w-1/5 py-2 text-center rounded-md text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:scale-105">Produits</button>
                    <button id="tab-autres" class="w-1/5 py-2 text-center rounded-md text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:scale-105">Autres</button>
                </div>
        
                <!-- Tabs Content -->
                <div id="tab-all-content" class="hidden mt-2 tab-content">
                    <div>
                        <table id="data-table-all" class="display">
                            <thead>
                                <tr>
                                    <th>Montant</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Catégorie</th>
                                    <th>Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recettes['all'] as $recette)
                                    <tr>
                                        <td>{{ number_format($recette->montant, 2) }}</td>
                                        <td>{{ $recette->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($recette->date)->format('d/m/Y') }}</td>
                                        <td>{{ $recette->categorie->nom }}</td>
                                        <td>
                                            <button onclick="showDetails({{ $recette->id }})" class="btn btn-info">Voir Détails</button>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal pour afficher les détails -->
                <!-- Modal pour afficher les détails -->
                <div id="details-modal" class="modal hidden">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <h2>Détails de la Recette</h2>
                        <div id="modal-body">
                            <!-- Les détails de la recette seront insérés ici -->
                        </div>
                    </div>
                </div>

                <script>
                    function showDetails(recetteId) {
                        fetch(`/recettes/${recetteId}`)
                            .then(response => response.json())
                            .then(data => {
                                console.log(data); // Pour vérifier les données
                                const modalBody = document.getElementById('modal-body');
                                modalBody.innerHTML = `
                                    <p>Montant: ${data.montant}</p>
                                    <p>Description: ${data.description}</p>
                                    <p>Date: ${data.date}</p>
                                    <p>Catégorie: ${data.categorie.nom}</p>
                                    <p>Autres informations: ${data.autres_informations || 'N/A'}</p>
                                `;
                                document.getElementById('details-modal').classList.remove('hidden');
                            })
                            .catch(error => console.error('Erreur:', error));
                    }
                    
                    function closeModal() {
                        document.getElementById('details-modal').classList.add('hidden');
                    }
                </script>
                
                
                

        
                <div id="tab-prets-content" class="hidden mt-2 tab-content">
                    <div>
                        <table id="data-table-prets" class="display">
                            <thead>
                                <tr>
                                    <th>Montant</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Catégorie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recettes['prets'] as $recette)
                                    <tr>
                                        <td>{{ number_format($recette->montant, 2) }}</td>
                                        <td>{{ $recette->description }}</td>
                                        <td>{{ $recette->date->format('d/m/Y') }}</td>
                                        <td>{{ $recette->categorie->nom }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        
                <div id="tab-recettes-propres-content" class="hidden mt-2 tab-content">
                    <div>
                        <table id="data-table-recettes-propres" class="display">
                            <thead>
                                <tr>
                                    <th>Montant</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Catégorie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recettes['recettes_propres'] as $recette)
                                    <tr>
                                        <td>{{ number_format($recette->montant, 2) }}</td>
                                        <td>{{ $recette->description }}</td>
                                        <td>{{ $recette->date->format('d/m/Y') }}</td>
                                        <td>{{ $recette->categorie->nom }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        
                <div id="tab-produits-content" class="hidden mt-2 tab-content">
                    <div>
                        <table id="data-table-produits" class="display">
                            <thead>
                                <tr>
                                    <th>Montant</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Catégorie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recettes['produits'] as $recette)
                                    <tr>
                                        <td>{{ number_format($recette->montant, 2) }}</td>
                                        <td>{{ $recette->description }}</td>
                                        <td>{{ $recette->date->format('d/m/Y') }}</td>
                                        <td>{{ $recette->categorie->nom }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        
                <div id="tab-autres-content" class="hidden mt-2 tab-content">
                    <div>
                        <table id="data-table-autres" class="display">
                            <thead>
                                <tr>
                                    <th>Montant</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Catégorie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recettes['autres'] as $recette)
                                    <tr>
                                        <td>{{ number_format($recette->montant, 2) }}</td>
                                        <td>{{ $recette->description }}</td>
                                        <td>{{ $recette->date->format('d/m/Y') }}</td>
                                        <td>{{ $recette->categorie->nom }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </x-content-page>
    <script>
        $(document).ready(function() {
            // Initialiser les DataTables
            var tableAll = $('#data-table-all').DataTable();
            var tablePrets = $('#data-table-prets').DataTable();
            var tableRecettesPropres = $('#data-table-recettes-propres').DataTable();
            var tableProduits = $('#data-table-produits').DataTable();
            var tableAutres = $('#data-table-autres').DataTable();
    
            // Gérer le changement d'onglet pour réinitialiser les DataTables
            function showTab(tabName) {
                var tabs = ['all', 'prets', 'recettes-propres', 'produits', 'autres'];
                tabs.forEach(function(tab) {
                    var tabButton = $('#tab-' + tab);
                    var content = $('#tab-' + tab + '-content');
    
                    if (tab === tabName) {
                        tabButton.addClass('active-tab');
                        content.removeClass('hidden');
    
                        // Réinitialiser la DataTable visible
                        if (tab === 'all') {
                            tableAll.columns.adjust().responsive.recalc();
                        } else if (tab === 'prets') {
                            tablePrets.columns.adjust().responsive.recalc();
                        } else if (tab === 'recettes-propres') {
                            tableRecettesPropres.columns.adjust().responsive.recalc();
                        } else if (tab === 'produits') {
                            tableProduits.columns.adjust().responsive.recalc();
                        } else if (tab === 'autres') {
                            tableAutres.columns.adjust().responsive.recalc();
                        }
                    } else {
                        tabButton.removeClass('active-tab');
                        content.addClass('hidden');
                    }
                });
            }
    
            // Écoutez les clics sur les onglets
            $('#tab-all').click(() => showTab('all'));
            $('#tab-prets').click(() => showTab('prets'));
            $('#tab-recettes-propres').click(() => showTab('recettes-propres'));
            $('#tab-produits').click(() => showTab('produits'));
            $('#tab-autres').click(() => showTab('autres'));
    
            // Initialiser par défaut le premier onglet
            showTab('all');
        });
    </script>
    
</x-app-layout>
