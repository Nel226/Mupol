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

        <div class="flex-1 p-6">
            <div class="flex items-center px-4 py-2 text-gray-500 bg-[#fffe4a70] rounded-t-lg shadow-lg">
                <h1 class="flex-1 text-2xl font-bold">{{$pageTitle}}</h1>
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
                <!-- DataTable buttons -->
                {{--  <div class="flex space-x-2">
                    <button id="print-btn" class="px-4 py-2 text-white bg-blue-500 rounded btn">Imprimer</button>
                    <button id="excel-btn"  class="px-4 py-2 text-white bg-green-500 rounded btn">Exporter Excel</button>
                    <button id="pdf-btn" class="px-4 py-2 text-white bg-red-500 rounded btn">Exporter PDF</button>
                </div>  --}}
                <table id="table_demandes" class="w-full text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400 display" style="width:100%">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th>ordre</th>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prénom (s)</th> 
                            <th>Catégorie</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($demandes->isEmpty())
                            <p>Aucun numéro trouvé.</p>
                        @else
                            @foreach ($demandes as $index => $demande)
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
    
                                <td class="flex px-6 py-4 space-x-2">
                                    <a href="{{ route('demandes.edit', ['demande' => $demande->id])}}" class="!text-blue-400 bg-zinc-200 p-2 rounded-md shadow-sm" >
                                        <i class=" fa fa-pencil"></i>
                                    </a>
                                    <button id="delete-button-{{ $demande->id }}" class="delete-button  !text-red-700 bg-zinc-200 p-2 rounded-md shadow-sm" >
                                        <i class=" fa fa-trash-alt"></i>
                                    </button>
                                
                                </td>
                            </tr>    
                            @endforeach
                        @endif
                    </tbody>
                </table>
            
               
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
                            extend: 'excel', 
                            className: 'btn btn-sm btn-success fa fa-file-excel', 
                            text:'' 
                        },
                        { 
                            extend: 'pdf', 
                            className: 'btn btn-sm btn-danger fa fa-file-pdf', 
                            text:'' 
                        }
                        ],
                       
                       
                    
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
                            paginate: {
                                previous: '<span class="fas fa-add"></span>',
                                next: `<iconify-icon icon="ic:round-keyboard-arrow-right"></iconify-icon>`,
                            },
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
                        var table = $('#table_demande').DataTable();
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
    </x-content-page>
   
    
  
 
   
    
    
</x-app-layout>
