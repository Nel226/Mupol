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
    
    @role('agentsaisie|controleur')
    <x-content-page>
        
        <div class="flex-1 p-6">
            <div class="flex items-center px-4 py-2 text-gray-500 bg-[#fffe4a70] rounded-t-lg shadow-lg">
                <h1 class="flex-1 text-2xl font-bold">Gestion des prestations</h1>
            </div>
            <div class=" flex justify-end py-3">
                <a href="{{ route('prestations.create') }}">
                    <x-primary-button >
                        Nouvelle prestation
                    </x-primary-button>
    
                </a>
            </div>
            <div class="p-6 mx-auto mt-4 bg-white rounded-lg shadow-lg ">
                <div class="flex items-center justify-between py-1 text-sm">
                    <!-- Custom "Show entries" with text -->
                    <div class="flex items-center space-x-2">
                        <span>Afficher</span>
                        <div class="relative">
                            <select id="show-entries" class="block w-full px-4 py-2 pr-8 leading-tight bg-white border border-gray-300 rounded shadow appearance-none hover:border-gray-400 focus:outline-none focus:shadow-outline">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            
                        </div>
                        <span>&eacute;l&eacute;ments</span>
                    </div>
                    
                    <!-- Custom search input -->
                    <div class="relative mt-1">
                        <input type="text" id="table-search" class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto rounded-lg">
                    <table id="table_prestations" class="w-full text-sm text-left text-gray-500 border rounded-lg shadow-lg rtl:text-right dark:text-gray-400 display" style="width:100%">
                        <thead class="text-xs text-gray-700 uppercase rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="rounded-md ">
                                <th>#</th>
                                <th>Identifiant</th>
    
                                <th>Adhérant</th>
                                <th>Contact</th>
    
                                <th>Date</th>
                                <th>Acte</th>
                                
                                <th>Type</th>
                                <th>Sous-type</th>
                                <th>Centre</th>
                                <th>Montant</th>
                                <th>Etat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prestations as $prestation)
                            <tr class="text-right bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 overflow-hidden whitespace-nowrap overflow-ellipsis">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $loop->iteration }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->idPrestation }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->adherantNom }} {{ $prestation->adherantPrenom }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->contactPrestation }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->date }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->acte }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->type }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->sous_type }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->centre }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->montant }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        @if ($prestation->validite === "accepté")
                                        <span class="p-2 text-green-600 bg-green-200 border border-green-600 rounded-md shadow-sm">
                                            {{ $prestation->validite }}
                                        </span> 
                                        @endif
                                        @if ($prestation->validite === "rejeté")
                                        <span class="p-2 text-red-600 bg-red-200 border border-red-600 rounded-md shadow-sm">
                                            {{ $prestation->validite }}
                                        </span>
                                        @endif
                                        @if ($prestation->validite === "en attente")
                                        {{ $prestation->validite }}
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    
                </div>
            </div>
        </div>
    </x-content-page>
   
    
    
    </div>
    @endrole
    

    @role('comptable')
    <x-content-page>
        
        <div class="flex-1 p-6">
            <div class="flex items-center px-4 py-2 text-gray-500 bg-[#fffe4a70] rounded-t-lg shadow-lg">
                <h1 class="flex-1 text-2xl font-bold">Gestion des prestations</h1>
            </div>
            
            <div class="p-6 mx-auto mt-4 bg-white rounded-lg shadow-lg ">
                <div class="flex items-center justify-between py-1 text-sm">
                    <!-- Custom "Show entries" with text -->
                    <div class="flex items-center space-x-2">
                        <span>Afficher</span>
                        <div class="relative">
                            <select id="show-entries" class="block w-full px-4 py-2 pr-8 leading-tight bg-white border border-gray-300 rounded shadow appearance-none hover:border-gray-400 focus:outline-none focus:shadow-outline">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            
                        </div>
                        <span>&eacute;l&eacute;ments</span>
                    </div>
                    
                    <!-- Custom search input -->
                    <div class="relative mt-1">
                        <input type="text" id="table-search" class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto rounded-lg">
                    <table id="table_prestations" class="w-full text-sm text-left text-gray-500 border rounded-lg shadow-lg compact cell-border hover rtl:text-right dark:text-gray-400 display" style="width:100%">
                        <thead class="text-xs !text-right text-gray-700 uppercase rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="rounded-md !text-right ">
                                <th>#</th>
                                <th class="!text-right ">Adhérant</th>
                                <th class="!text-right ">Contact</th>
    
                                <th class="!text-right ">Date</th>
                                <th class="!text-right ">Acte</th>
                                
                                <th class="!text-right ">Type</th>
                                <th class="!text-right ">Sous-type</th>
                                <th class="!text-right ">Centre</th>
                                <th class="!text-right ">Montant</th>
                                <th class="!text-right ">Paiement</th>
    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prestationsValides as $prestation)
                            <tr class="text-right bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 overflow-hidden whitespace-nowrap overflow-ellipsis">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $loop->iteration }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->adherantNom }} {{ $prestation->adherantPrenom }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->contactPrestation }} 
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->date }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->acte }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->type }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->sous_type }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->centre }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        {{ $prestation->montant }}
                                    </a>
                                </td>
                               
                                <td class="px-6 py-4">
                                    <a href="{{ route('prestations.show', ['prestation' => $prestation->id]) }}">
                                        @if ($prestation->etat_paiement === 1)
                                        <span class="flex items-center justify-center p-2 text-green-600 ">
                                            <i class=" fa fa-check " style="font-size:20px;"></i>
                                        </span>                                             
                                        @else
                                        <span class="flex items-center justify-center text-orange-600">
                                            <i class="fa fa-hourglass-half" style="font-size:20px;" aria-hidden="true"></i>
                                        </span> 
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    
                </div>
            </div>
        </div>
    </x-content-page>
   
    @endrole

    <script>
        $('#table_prestations').DataTable( {
            dom: 'Brtip',
            buttons: [
            { 
                extend: 'print', 
                className: 'btn btn-sm text-red-500 btn-primary fa fa-print', 
                text:'' 
            },
            
            ],
            layout: {
                bottomEnd: {
                    paging: {
                        firstLast: false
                    }
                }
            },
            
            paging: true,
            ordering: true,
            info: false,
            scrollX: true,
            searching: true,
            lengthChange: true,
            lengthMenu: [10, 25, 50, 100],
            pagingType: 'simple_numbers',
            language: {
                lengthMenu: "Show _MENU_ entries",
                paginate: {
                    previous: '<span class="mt-2 fas fa-add"></span>',
                    next: `<iconify-icon class="mt-2 " icon="ic:round-keyboard-arrow-right"></iconify-icon>`,
                },
                search: "Recherche:",
            },
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
        $(document).ready(function(){
            var table = $('#table_numero').DataTable();
            //DataTable custom search field
            $('#table-search').keyup( function() {
                table.search( this.value ).draw();
            } );
            $('#show-entries').change(function() {
                var value = $(this).val();
                table.page.len(value).draw();
            });
            
        });
        $('#print-btn').click(function () {
            table.button('.buttons-print').trigger();
        });
        
        $('#excel-btn').click(function () {
            table.button('.buttons-excel').trigger();
        });
        
        $('#pdf-btn').click(function () {
            table.button('.buttons-pdf').trigger();
        });
        
    </script>
    
    
    
</x-app-layout>
