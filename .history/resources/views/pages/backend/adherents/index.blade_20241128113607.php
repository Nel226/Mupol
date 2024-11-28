<x-app-layout>
    <x-sidebar/>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
    <x-succes-notification>
        {{ session('success') }}
    </x-succes-notification>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notification = document.getElementById('success-notification-content');
            const closeBtn = document.getElementById('close-notification');
            
            notification.classList.remove('hidden');
            
            {{--  setTimeout(() => {
                notification.classList.add('hidden');
            }, 5000);  --}}
            
            closeBtn.addEventListener('click', () => {
                notification.classList.add('hidden');
            });
        });
    </script>
    @endif

    @role('agentsaisie|controleur')
    <x-content-page>
        <div class="flex-1 p-6">
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
            <x-header>
                {{$pageTitle}}
            </x-header>
            
    
            <!-- Tabs Navigation -->
            <div class="flex mt-4">
                <button id="tab-mutualistes" class="w-1/3 py-2 text-center text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:border-gray-300 active-tab">Mutualistes</button>
                <button id="tab-adherents" class="w-1/3 py-2 text-center text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:border-gray-300 ">Adhérents</button>
                <button id="tab-ayants-droit" class="w-1/3 py-2 text-center text-gray-600 border-b-2 border-transparent focus:outline-none hover:text-gray-800 hover:border-gray-300">Ayants Droit</button>
    
            </div>
            <!-- Tabs Content -->
            <div id="tab-adherents-content" class="hidden mt-2 tab-content">
                <div class="">
                    <div class="flex items-center justify-end py-2 mb-6 space-x-2 text-sm">
                        <div class="flex items-center space-x-2">
                            
                            <a href="{{ route('adherents.create') }}">
                                <x-primary-button class="">
                                    {{ __('Ajouter') }}
                                </x-primary-button>
                            </a>
                           
                        </div>
                        <!-- Custom search input -->
                        <div class="relative mt-1">
                            <input type="text" id="fSearch" name="fSearch" class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <ul class="flex overflow-x-auto border-b border-gray-700" id="myTab" role="tablist">
                            @foreach($sheets as $yearMonth => $data)
                                <li class="flex-none" role="presentation">
                                    <button class="nav-link text-sm border-gray-300 border-2 px-4 py-2 rounded-t-lg {{ $loop->first ? 'bg-primary1 text-white' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }}" id="tab-{{ $yearMonth }}-tab" data-bs-toggle="tab" data-bs-target="#tab-{{ $yearMonth }}" type="button" role="tab" aria-controls="tab-{{ $yearMonth }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $yearMonth }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content " id="myTabContent">
                            @foreach($sheets as $yearMonth => $data)
                                <div class="tab-pane {{ $loop->first ? 'block' : 'hidden' }}" id="tab-{{ $yearMonth }}" role="tabpanel" aria-labelledby="tab-{{ $yearMonth }}-tab">
                                    
                                    <div id="tabulator-{{ $yearMonth }}" class="w-full p-2 overflow-x-auto bg-white rounded-b-lg shadow-lg">
                                        <!-- Tabulator table will be initialized here -->
                                    </div>
                                    <div class="flex justify-end mt-2 space-x-2">
                                        {{--  <x-primary-button class="print-btn" data-year-month="{{ $yearMonth }}">
                                            {{ __('Imprimer') }}
                                        </x-primary-button>  --}}
                                        <x-primary-button class="export-btn" data-year-month="{{ $yearMonth }}">
                                            {{ __('Exporter en XLSX') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
               
                
                
                <form action="{{ route('import-csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-end my-4 space-x-2">
                        <input type="file" name="excel-file" class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-green-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept=".csv, .xlsx" />
                        <x-primary-button type="submit" class="ms-3">
                            {{ __('Importer en XLSX') }}
                        </x-primary-button>
                    </div>
                </form>
    
            </div>
            <!-- Modal de confirmation -->
            <div id="confirmationModal" class="hidden fixed z-10 inset-0 overflow-y-auto bg-black bg-opacity-60" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-center justify-center min-h-screen"> 
                    <div class="bg-white text-sm rounded-md shadow-md p-6 relative w-[90%] sm:w-[460px]">
                        <div class="p-3 text-center">
                            <i  class="fa fa-times-circle   text-red-500 mx-auto" style="font-size:48px;"></i>
                            <div class="mt-5 text-2xl">Etes-vous sûr?</div>
                            <div class="mt-2 text-slate-500">
                                <p id="modalMessage" class="mt-2"></p>
    
                                Cette action est irreversible.
                            </div>
                        </div>
                        <div class="flex space-x-2 items-center mx-auto justify-center px-5 pb-8 text-center">
                            <button id="confirmDeleteBtn" class="bg-red-500 text-white px-4 py-2 rounded">Confirmer</button>
    
                            <div>
                                <button id="cancelDeleteBtn" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 dark:focus:ring-slate-700 dark:focus:ring-opacity-50 border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 mr-1 w-24">
                                    Annuler
                                </button>
                            </div>
                            <div>
                
                            </div>
                        </div>
                        <button id="close-modal-icon" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                        
                    </div>
                </div>
            </div>
    
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const tabulators = {};
                    const baseUrl = @json(route('adherents.edit', ['adherent' => ':id']));
    
                    @foreach($sheets as $yearMonth => $data)
                        tabulators["{{ $yearMonth }}"] = new Tabulator("#tabulator-{{ $yearMonth }}", {
                            data: @json($data),
                            layout: "fitDataStretch",
                            movableColumns: false,
                            placeholder: "Aucune donnée",
                            pagination: "local",
                            paginationSize: 20,
                            paginationSizeSelector: [20, 30, 40, 50],
                            printAsHtml: true,
                            columns: [
                                @foreach($header as $column)
                                    { title: "{{ ucfirst($column) }}", field: "{{ $column }}" },
                                @endforeach
                                {
                                    title: "Actions", 
                                    formatter: function(cell) {
                                        const rowData = cell.getData();
    
                                        const editUrl = baseUrl.replace(':id', rowData.id);
    
                                        return `
                                            <a href="${editUrl}" class='border border-indigo-500 shadow-lg rounded-lg text-bold text-white p-1  bg-indigo-500 btn btn-primary'>Modifier</a>
                                            <button class='border border-red-500 rounded-lg bg-red-800 shadow-lg btn btn-danger text-bold text-white p-1' data-id="${rowData.id}">Supprimer</button>
                                        `;
                                    },
                                    hozAlign: "center",
                                    minWidth: 200,
                                    cellClick: function(e, cell) {
                                        const target = e.target;
                                        const rowData = cell.getData();
    
                                        if (target.classList.contains('btn-danger')) {
                                            showModal(rowData.id); // Appelle la fonction pour afficher la modale de confirmation
                                        }
                                    },
                                    download: false // Exclut cette colonne des exportations
                                }
                            ],
                        });
                    @endforeach
    
                    function showModal(id) {
                        const modal = document.getElementById('confirmationModal');
                        modal.classList.remove('hidden');
    
                        // Mettez à jour le message de la modale
                        document.getElementById('modalMessage').innerText = `Êtes-vous sûr de vouloir supprimer l'adhérent avec l'ID: ${id} ?`;
    
                        // Générer l'URL de suppression
                        const baseUrl = @json(route('adherents.destroy', ['adherent' => ':id']));
                        const deleteUrl = baseUrl.replace(':id', id);
    
                        // Ajout de l'événement de suppression
                        document.getElementById('confirmDeleteBtn').onclick = function() {
                            fetch(deleteUrl, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    console.log('Suppression réussie pour l\'ID:', id);
                                    alert('Mutualiste supprimé avec succès.');
                                    modal.classList.add('hidden');
                                    location.reload(); // Actualiser la page après suppression
                                } else {
                                    return response.json().then(data => {
                                        console.error('Erreur lors de la suppression:', data.message);
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Erreur lors de la requête de suppression:', error);
                            });
                        };
    
                        // Gestion du bouton d'annulation
                        document.getElementById('cancelDeleteBtn').onclick = function() {
                            modal.classList.add('hidden');
                        };
                    }
    
    
                    
                    
    
                    // Script pour gérer le changement d'onglet avec Tailwind CSS
                    const tabs = document.querySelectorAll('.nav-link');
                    tabs.forEach(tab => {
                        tab.addEventListener('click', function() {
                            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));
                            
                            tabs.forEach(link => {
                                link.classList.remove('bg-primary1', 'text-white');
                                link.classList.add('bg-gray-200', 'text-gray-600');
                            });
    
                            const targetPane = document.querySelector(this.getAttribute('data-bs-target'));
                            targetPane.classList.remove('hidden');
    
                            this.classList.remove('bg-gray-200', 'text-gray-600');
                            this.classList.add('bg-primary1', 'text-white');
                        });
                    });
    
                    // Script pour gérer la recherche
                    document.getElementById('fSearch').addEventListener('input', function() {
                        const searchValue = this.value.toLowerCase();
                        Object.values(tabulators).forEach(tabulator => {
                            tabulator.setFilter(function(data) {
                                return Object.values(data).some(value => 
                                    String(value).toLowerCase().includes(searchValue)
                                );
                            });
                        });
                    });
                    document.querySelectorAll('.print-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const yearMonth = this.getAttribute('data-year-month');
                            const tabulator = tabulators[yearMonth];
                            tabulator.printTable();
                        });
                    });
                
                    // exportation
                    document.querySelectorAll('.export-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const yearMonth = this.getAttribute('data-year-month');
                            const tabulator = tabulators[yearMonth];
                            tabulator.download("xlsx", `adherents_${yearMonth}.xlsx`);
                        });
                    });
                });
            </script>
    
            
            <div id="tab-ayants-droit-content" class="hidden mt-2 tab-content">
                <div class="">
                    <div class="flex items-center justify-end py-2 mb-6 space-x-2 text-sm">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('ayantsdroits.create') }}">
                                <x-primary-button class="">
                                    {{ __('Ajouter Ayant Droit') }}
                                </x-primary-button>
                            </a>
                        </div>
                        <!-- Custom search input -->
                        <div class="relative mt-1">
                            <input type="text" id="fSearchAyantDroit" name="fSearchAyantDroit" class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <ul class="flex overflow-x-auto border-b border-gray-900" id="myTabAyantDroit" role="tablist">
                            @foreach($sheetsAyantsDroits as $yearMonth => $data)
                                <li class="flex-none" role="presentation">
                                    <button class="nav-link-ayantdroit text-sm border-gray-300 border-2 px-4 py-2 rounded-t-lg {{ $loop->first ? 'bg-primary1 text-white' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }}" id="tab-{{ $yearMonth }}-ayantdroit-tab" data-bs-toggle="tab" data-bs-target="#tab-{{ $yearMonth }}-ayantdroit" type="button" role="tab" aria-controls="tab-{{ $yearMonth }}-ayantdroit" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $yearMonth }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabAyantDroitContent">
                            @foreach($sheetsAyantsDroits as $yearMonth => $data)
                                <div class="tab-pane-ayantdroit {{ $loop->first ? 'block' : 'hidden' }}" id="tab-{{ $yearMonth }}-ayantdroit" role="tabpanel" aria-labelledby="tab-{{ $yearMonth }}-ayantdroit-tab">
                                    
                                    <div id="tabulator-{{ $yearMonth }}-ayantdroit" class="w-full p-2 overflow-x-auto bg-white rounded-b-lg shadow-lg">
                                        <!-- Tabulator table for Ayants Droit will be initialized here -->
                                    </div>
                                    <div class="flex justify-end mt-2 space-x-2">
                                        <x-primary-button class="export-btn-ayantdroit" data-year-month="{{ $yearMonth }}">
                                            {{ __('Exporter en XLSX') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
    
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const tabulatorsAyantsDroits = {};
                        const baseUrl = @json(route('ayantsdroits.edit', ['ayantsdroit' => ':id'])); // URL de base
                        
                        @foreach($sheetsAyantsDroits as $yearMonth => $data)
                            tabulatorsAyantsDroits["{{ $yearMonth }}"] = new Tabulator("#tabulator-{{ $yearMonth }}-ayantdroit", {
                                data: @json($data),
                                layout: "fitDataStretch",
                                movableColumns: false,
                                placeholder: "Aucune donnée",
                                pagination: "local",
                                paginationSize: 20,
                                paginationSizeSelector: [20, 30, 40, 50],
                                printAsHtml: true,
                                columns: [
                                    { 
                                        title: "N° Ordre", 
                                        field: "numero_ordre", 
                                        formatter: "rownum",  
                                        hozAlign: "center", 
                                        headerSort: false 
                                    },
                                    @foreach($headerAyantDroit as $column)
                                        { title: "{{ ucfirst($column) }}", field: "{{ $column }}" },
                                    @endforeach
                                    {
                                        title: "Actions", 
                                        
                                        formatter: function(cell, formatterParams, onRendered) {
                                                const rowData = cell.getData();
                                                
                                                const editUrl = baseUrl.replace(':id', rowData.id); 
    
                                                return `
                                                    <a href="${editUrl}" class='border border-indigo-500 shadow-lg rounded-lg text-bold text-white p-1  bg-indigo-500 btn btn-primary'>Modifier</a>
                                                    <button class='border border-red-500 rounded-lg bg-red-800 shadow-lg btn btn-danger text-bold text-white p-1' data-id="${rowData.id}">Supprimer</button>
                                                    `;
                                        },
                                        hozAlign: "center",
                                        minWidth: 200,
                                        cellClick: function(e, cell) {
                                            const target = e.target;
                    
                                            if (target.classList.contains('btn-danger')) {
                                                showModal(target.getAttribute('data-id'));
                                            }
                                        },
                                        download: false 
                                    }
                                ],
                            });
                        @endforeach
                    
                        function showModal(id) {
                            const modal = document.getElementById('confirmationModal');
                            modal.classList.remove('hidden');
                        
                            document.getElementById('modalMessage').innerText = `Êtes-vous sûr de vouloir supprimer l'élément avec l'ID: ${id} ?`;
                        
                            const baseUrl = @json(route('ayantsdroits.destroy', ['ayantsdroit' => ':id']));
                            const deleteUrl = baseUrl.replace(':id', id);
                        
                            // suppression
                            document.getElementById('confirmDeleteBtn').onclick = function() {
                                fetch(deleteUrl, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Token CSRF
                                    }
                                })
                                .then(response => {
                                    if (response.ok) {
                                        console.log('Suppression confirmée pour l\'ID:', id);
                                        alert('Mutualiste supprimé avec succès.');
    
                                        modal.classList.add('hidden');
                        
                                        location.reload(); 
                                    } else {
                                        return response.json().then(data => {
                                            console.error('Erreur lors de la suppression:', data.message);
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Erreur lors de la requête de suppression:', error);
                                });
                            };
                        
                            document.getElementById('cancelDeleteBtn').onclick = function() {
                                modal.classList.add('hidden');
                            };
                        }
                        
                        const tabsAyantDroit = document.querySelectorAll('.nav-link-ayantdroit');
                        tabsAyantDroit.forEach(tab => {
                            tab.addEventListener('click', function() {
                                document.querySelectorAll('.tab-pane-ayantdroit').forEach(pane => pane.classList.add('hidden'));
                                
                                tabsAyantDroit.forEach(link => {
                                    link.classList.remove('bg-primary1', 'text-white');
                                    link.classList.add('bg-gray-200', 'text-gray-600');
                                });
                    
                                const targetPane = document.querySelector(this.getAttribute('data-bs-target'));
                                targetPane.classList.remove('hidden');
                    
                                this.classList.remove('bg-gray-200', 'text-gray-600');
                                this.classList.add('bg-primary1', 'text-white');
                            });
                        });
                    
                        // recherche
                        document.getElementById('fSearchAyantDroit').addEventListener('input', function() {
                            const searchValue = this.value.toLowerCase();
                            Object.values(tabulatorsAyantsDroits).forEach(tabulator => {
                                tabulator.setFilter(function(data) {
                                    return Object.values(data).some(value => 
                                        String(value).toLowerCase().includes(searchValue)
                                    );
                                });
                            });
                        });
                    
                        // exportation
                        document.querySelectorAll('.export-btn-ayantdroit').forEach(button => {
                            button.addEventListener('click', function() {
                                const yearMonth = this.getAttribute('data-year-month');
                                const tabulator = tabulatorsAyantsDroits[yearMonth];
                                tabulator.download("xlsx", `ayantsdroits_${yearMonth}.xlsx`);
                            });
                        });
                    });
                </script>
    
                <form action="{{route('ayantdroits.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-end my-4 space-x-2">
                        <input type="file" name="excel-file-ayant-droit"  class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-green-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept=".csv, .xlsx" />
                        <x-primary-button type="submit" class="ms-3">
                            {{ __('Importer Excel') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div id="tab-mutualistes-content" class="mt-2 tab-content">
                <div class="">
                    
                    <div class="overflow-x-auto rounded-lg">
    
                        <table id="table_mutualistes" class="w-full text-sm text-left text-gray-500 border rounded-lg shadow-lg cell-border hover rtl:text-right dark:text-gray-400 display">
                            <thead>
                                <tr class="p-3 font-bold ">
                                    <th class="p-3 uppercase">Nom</th>
                                    <th class="p-3 uppercase">Prénom (s)</th>
                                    <th class="p-3 uppercase">Genre</th>
                                    <th class="p-3 uppercase">Code_carte</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mutualistes as $person)
                                <tr class="font-semibold bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="p-3 font-semibold border">
                                        <a href="{{ route('adherents.show', ['adherent' => $person->id]) }}">
                                            {{$person->nom}}
                                        </a>
                                    </td>
                                    <td class="p-3 font-semibold border">
                                        {{$person->prenom}}
                                    </td>
                                    <td class="p-3 font-semibold border">
                                        {{$person->genre ?? $person->sexe}}
                                    </td>
                                    <td class="p-3 font-semibold border">
                                        {{$person->code_carte ?? $person->code}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <script>
                            $('#table_mutualistes').DataTable( {
                            buttons: [  
                                {
                                    extend: 'excelHtml5',
                                    title: 'Liste Mutualistes'
                                },
                                {
                                    extend: 'print',
                                    title: 'Liste Mutualistes'
                                },
                            ],
                            layout: {
                                topStart: 'buttons'
                                
                            },
     
                            paging: true,
                            ordering: true,
                            info: false,              
                            searching: true,
                            lengthChange: true,
                            lengthMenu: [20, 25, 50, 100],
                            pagingType: 'simple_numbers',
                            language: {
                                processing:     "Traitement en cours...",
                                search:         "Rechercher&nbsp;:",
                                lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
                                info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                                infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                                infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                                infoPostFix:    "",
                                loadingRecords: "Chargement en cours...",
                                zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                                emptyTable:     "Aucune donnée disponible dans le tableau",
                                paginate: {
                                    first:      "Premier",
                                    previous:   "Pr&eacute;c&eacute;dent",
                                    next:       "Suivant",
                                    last:       "Dernier"
                                },
                                aria: {
                                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                                }
                            }
                            
                        } );
                    </script>
                </div>
                
                
               
            </div>
            
        </div>
    </x-content-page>

    @endrole
    <script>
        document.getElementById('tab-adherents').addEventListener('click', function() {
                showTab('adherents');
            });
        
            document.getElementById('tab-ayants-droit').addEventListener('click', function() {
                showTab('ayants-droit');
            });
            document.getElementById('tab-mutualistes').addEventListener('click', function() {
                showTab('mutualistes');
            });
            
            
            function showTab(tabName) {
                var tabs = ['adherents', 'ayants-droit','mutualistes'];
                tabs.forEach(function(tab) {
                    var tabButton = document.getElementById('tab-' + tab);
                    var content = document.getElementById('tab-' + tab + '-content');
                    if (tab === tabName) {
                        tabButton.classList.add('active-tab');
                        content.classList.remove('hidden');
                    } else {
                        tabButton.classList.remove('active-tab');
                        content.classList.add('hidden');
                    }
                });
        
                {{--  setTimeout(function() {
                    if (tabName === 'adherents') {
                        tableAdherents.redraw(true); 
                    } else if (tabName === 'ayants-droit') {
                        tableAyantsDroit.redraw(true); 
                    }
                }, 10);   --}}
            }
        document.addEventListener('DOMContentLoaded', function() {
            var header = @json($header); 
            var headerAyantDroit = @json($headerAyantDroit); 
            
            const input = document.getElementById("fSearch");
            input.addEventListener("keyup", function() {
                tableAdherents.setFilter(matchAny, { value: input.value });
                if (input.value === "") {
                    tableAdherents.clearFilter();
                }
            });

            function matchAny(data, filterParams) {
                var match = false;
                const regex = RegExp(filterParams.value, 'i');
                for (var key in data) {
                    if (regex.test(data[key])) {
                        match = true;
                    }
                }
                return match;
            }
        });
        
        
    </script>
    
    
</x-app-layout>

