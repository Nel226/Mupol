

<x-app-layout >
    @if (session('success'))
    <x-succes-notification>
        {{ session('success') }}
    </x-succes-notification>
    
    @endif
    <x-top-navbar-admin/>

    <div id="sidebar" class="lg:block z-20 hidden  bg-blue-800  w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" class="" />
    
    </div>
   
    <x-content-page-admin>
        <div class="flex-1 lg:p-6 ">
            <x-header>
                {{$pageTitle}}
            </x-header>
            <div class="md:p-6 p-2 mx-auto  mt-4 bg-white rounded-lg shadow-lg ">
                
                <div class="flex flex-wrap items-center justify-between gap-2 py-1 text-sm">
                    <!-- Custom "Show entries" with text -->
                    <div class="flex items-center space-x-2">
                        <span>Afficher</span>
                        <div class="relative">
                            <select id="show-entries" class="block w-full px-3 py-2 pr-8 leading-tight bg-white border border-gray-300 rounded shadow appearance-none hover:border-gray-400 focus:outline-none focus:shadow-outline text-sm md:text-base">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span>&eacute;l&eacute;ments</span>
                    </div>
                
                    <!-- Custom search input -->
                    <div class="relative mt-2 w-full sm:w-auto">
                        <input 
                            type="text" 
                            id="table-search" 
                            class="block w-full sm:w-80 px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                            placeholder="Rechercher">
                        <div class="absolute inset-y-0 left-0 flex items-center ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- DataTable buttons -->
                {{--  <div class="flex space-x-2">
                    <button id="print-btn" class="px-4 py-2 text-white bg-blue-500 rounded btn">Imprimer</button>
                    <button id="excel-btn"  class="px-4 py-2 text-white bg-green-500 rounded btn">Exporter Excel</button>
                    <button id="pdf-btn" class="px-4 py-2 text-white bg-red-500 rounded btn">Exporter PDF</button>
                </div>  --}}
                <div class=" overflow-x-auto">

                    <table id="table_demandes" class="w-full text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400 display" data-plugin-options='{"searchPlaceholder": "Recherche"}' style="width:100%">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th>N</th>
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Prénom (s)</th> 
                                <th>Catégorie</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($demandes as $index => $demande)
                                
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4"> {{$index + 1}}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('demandes.show', ['demande' => $demande->id])}}">
                                        {{$demande->matricule}}

                                    </a>

                                </td>

                                <td class="px-6 py-4">+{{$demande->nom}}</td>
                                <td class="px-6 py-4">{{$demande->prenom }}</td>
                                <td class="px-6 py-4">{{$demande->categorie}}</td>
                                <td class="px-6 py-4">{{$demande->created_at}}</td>
    
                                <td class="flex px-6 py-4 space-x-2 font-bold">
                                    
                                    @if ($demande->is_adherent === 0)
                                        
                                    <form action="{{ route('adherents.accept', ['id' => $demande->id])}}" method="post">
                                        @csrf
                                        <x-primary-button type="submit" class="!text-[#4644D4] bg-zinc-200 p-2 rounded-md shadow-sm" >
                                            Accepter
                                        </x-primary-button>
                                    </form>
                                    @endif    
                                
                                </td>
                            </tr>    
                            @empty
                                <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td colspan="7" class="px-6 py-4 text-center"> Aucune demande</td>
                                </tr>   
                            @endforelse
                           
                            
                        </tbody>
                    </table>
                </div>
            
               
                <script>
                    $('#table_demandes').DataTable( {
                        dom: 'Brtip',
                        buttons: [
                        { 
                            extend: 'print', 
                            className: 'btn btn-sm text-red-500 btn-primary fa fa-print', 
                            text:'' 
                        },
                        
                      
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            titleAttr: 'PDF'
                        }
                        ],
                        
                       
                        responsive: true,

                        paging: true,
                        ordering: true,
                        info: false,
                        scrollX: true,
                        searching: true,
                        lengthChange: true,
                        lengthMenu: [10, 25, 50, 100],
                        pagingType: 'simple_numbers',
                        columnDefs: [
                            {
                                targets: 0, // Indique que la première colonne (index 0) sera affectée
                                visible: false, // Cache la première colonne
                                searchable: false // Désactive la recherche sur cette colonne
                            }
                        ],            
                       
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
                        var table = $('#table_demandes').DataTable();
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
               
            </div>
                           
        </div>
    </x-content-page-admin>
    
</x-app-layout>
