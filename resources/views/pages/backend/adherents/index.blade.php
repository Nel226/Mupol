<x-app-layout>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
    @endif
    <x-top-navbar-admin />

    <div id="sidebar" class="lg:block z-20 hidden bg-blue-800 w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" />
    </div>

    <x-content-page-admin>

        @section('breadcrumbs')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        @endsection
       
        <x-header>
            {{ $pageTitle }}
        </x-header>
         
        <script defer>
            $(document).ready(function () {
                function initializeDataTable(tableId) {
                    const table = $(tableId).DataTable({
                        processing: true,
                        dom: "<'flex flex-wrap items-center justify-between mb-2'lf>Bt<'flex items-center justify-between mt-2'ip>",
                        buttons: ['print', 'excel', 'pdf'],
                        scrollX: true,
                        responsive: true,
                        pageLength: 10,
                        deferRender: true,
                        order: []
                    }).on('init', function () {
                        $('#loader').hide(); // Cache le loader
                        $(tableId).removeClass('hidden'); // Montre la table
                    });
        
                    return table;
                }
        
                // Initialize all tables
                const tableMutualistes = initializeDataTable('#table-mutualistes');
                const tableAdherents = initializeDataTable('#table_adherents');
                const tableAyantsDroit = initializeDataTable('#table_ayantsdroit');
                
                // Date range filtering
                $.fn.dataTable.ext.search.push((settings, data) => {
                    const startDate = $('#start-date').val();
                    const endDate = $('#end-date').val();
                    const date = data[5]; // Colonne contenant la date (index basé sur la table)
        
                    if ((startDate && date < startDate) || (endDate && date > endDate)) {
                        return false;
                    }
                    return true;
                });
        
                $('#start-date, #end-date').on('change', () => {
                    tableMutualistes.draw();
                });
            });
        </script>
        
        

        <div class="md:p-6 p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg">
            @role('agentsaisie|controleur')
                <x-tabs :tabs="['Mutualistes', 'Adhérents', 'Ayants Droit']">
                    <div id="tab-0" class="tab-pane  sm:p-4 p-1 bg-white rounded-md shadow-md">
                        <div class="bg-gray-300 mb-3 text-gray-600 rounded-lg p-4">
                            <div class="flex flex-col md:flex-row items-center gap-4">
                                <div class="flex items-center gap-2 w-full md:w-auto">
                                    <label for="start-date" class="text-sm font-medium">Date de début:</label>
                                    <input type="date" id="start-date" class="border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-indigo-500 w-full md:w-auto">
                                </div>
                                <div class="flex items-center gap-2 w-full md:w-auto">
                                    <label for="end-date" class="text-sm font-medium">Date de fin:</label>
                                    <input type="date" id="end-date" class="border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-indigo-500 w-full md:w-auto">
                                </div>
                            </div>
                        </div>
                        {{-- <div id="loader" class="flex items-center justify-center">
                            <p>Chargement en cours...</p>
                        </div> --}}
                        
                        <x-data-table class="hidden" id="table-mutualistes" :headers="['N', 'Nom', 'Prénom(s)', 'Genre', 'Code carte', 'Date création']">
                            @foreach ($mutualistes as $index => $mutualiste)
                                <tr class=" hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mutualiste->nom }}</td>
                                    <td>{{ $mutualiste->prenom }}</td>
                                    <td>{{ $mutualiste->genre ?? $mutualiste->sexe }}</td>
                                    <td>{{ $mutualiste->code_carte ?? $mutualiste->code }}</td>
                                    <td class="date-col">{{ $mutualiste->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </x-data-table>

                    </div>
        
                    <!-- Adhérents Tab -->
                    <div id="tab-1" class="tab-pane  sm:p-4 p-1">
                        <div class="flex flex-wrap items-center justify-end py-2 gap-2">
                            <a href="{{ route('adherents.create') }}">
                                <button class="btn">{{ __('Ajouter') }}</button>
                            </a>
                        </div>
                        <x-data-table id="table_adherents" :headers="['N', 'Matricule', 'Nom', 'Prénom(s)', 'Catégorie', 'Date']">
                            @foreach ($adherents as $index => $adherent)
                                <tr onclick="redirectTo('{{ route('adherents.show', ['adherent' => $adherent->id]) }}')" class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $adherent->matricule }}</td>
                                    <td>{{ $adherent->nom }}</td>
                                    <td>{{ $adherent->prenom }}</td>
                                    <td>{{ $adherent->categorie }}</td>
                                    <td>{{ $adherent->created_at }}</td>
                                </tr>
                            @endforeach
                        </x-data-table>
                        <form action="{{ route('import-csv') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-wrap items-center justify-end my-4 space-x-2">
                                <!-- Input de fichier -->
                                <div class="w-full sm:w-auto mb-4 sm:mb-0">
                                    <input type="file" name="excel-file-ayant-droit"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-green-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        accept=".csv, .xlsx" />
                                </div>
                        
                                <!-- Bouton de soumission -->
                                <div class="w-full text-center sm:w-auto">
                                    <button type="submit"
                                        class="btn  bg-green-700 ">
                                        {{ __('Importer Excel') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        
        
                    </div>
        
                    <!-- Ayants Droit Tab -->
                    <div id="tab-2" class="tab-pane overflow-x-auto sm:p-4 p-1">
                        <div class="flex flex-wrap items-center justify-end py-2  gap-2">
                            <a href="{{ route('ayantsdroits.create') }}">
                                <button class="btn">{{ __('Ajouter Ayant Droit') }}</button>
                            </a>
                        </div>
                        <x-data-table id="table_ayantsdroit" :headers="['N', 'Nom', 'Prénom(s)', 'Genre', 'Date de naissance', 'Relation', 'Date de création']">
                            @foreach ($ayantsDroit as $index => $ayantDroit)
                                <tr onclick="redirectTo('{{ route('ayantsdroits.show', $ayantDroit->id) }}')" class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ayantDroit->nom }}</td>
                                    <td>{{ $ayantDroit->prenom }}</td>
                                    <td>{{ $ayantDroit->sexe }}</td>
                                    <td>{{ $ayantDroit->date_naissance }}</td>
                                    <td>{{ $ayantDroit->relation }}</td>
                                    <td>{{ $ayantDroit->created_at }}</td>
                                </tr>
                            @endforeach
                        </x-data-table>
                        <form action="{{ route('ayantdroits.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-wrap items-center justify-end my-4 space-x-2">
                                <!-- Input de fichier -->
                                <div class="w-full sm:w-auto mb-4 sm:mb-0">
                                    <input type="file" name="excel-file-ayant-droit"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-green-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        accept=".csv, .xlsx" />
                                </div>
                        
                                <!-- Bouton de soumission -->
                                <div class="w-full text-center sm:w-auto">
                                    <button type="submit"
                                        class="btn  bg-green-700 ">
                                        {{ __('Importer Excel') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </x-tabs>
            @endrole
        </div>
       
    </x-content-page-admin>
</x-app-layout>
