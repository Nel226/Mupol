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
                <!-- Tabs -->
                <div class="mb-4">
                    <ul class="flex border-b overflow-x-auto">
                        <li class="mr-1">
                            <a href="#all" class="inline-block py-2 px-4 text-blue-600 hover:text-whit text-sm rounded-t-md focus:outline-none tab-link">
                                Tous
                            </a>
                        </li>
                        @foreach($categoriesPrincipales as $categorie)
                            <li class="mr-1">
                                <a href="#category-{{ $categorie->uuid }}" class="inline-block truncate py-2 px-4 text-blue-600 hover:text-whit text-sm rounded-t-md focus:outline-none tab-link" title="{{ $categorie->nom }}">
                                    {{ $categorie->nom }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tous tab content -->
                <div id="all" class="tab-content hidden">
                    <table id="estimations-table-all" class="w-full text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400 display">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th>Description</th>
                                <th>Montant</th>
                                <th>Catégorie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estimations as $estimation)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $estimation->description }}</td>
                                    <td class="px-6 py-4">{{ $estimation->montant }}</td>
                                    <td class="px-6 py-4">{{ $estimation->categorie->nom }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Categories tab content -->
                    @foreach($categoriesPrincipales as $categorie)
                    <div id="category-{{ $categorie->uuid }}" class="tab-content hidden">
                        <table id="estimations-table-{{ $categorie->uuid }}" class=" w-full text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400 display">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th>Description</th>
                                    <th>Montant</th>
                                    <th>Catégorie</th>
                                    <th>Période</th>
                                    <th>Année</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($estimations as $estimation)
                                    @if($estimation->categorie->uuid == $categorie->uuid)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $estimation->description }}</td>
                                        <td class="px-6 py-4">{{ $estimation->montant }}</td>
                                        <td class="px-6 py-4">{{ $estimation->categorie->nom }}</td>
                                        <td class="px-6 py-4">{{ $estimation->periode }}</td>
                                        <td class="px-6 py-4">{{ $estimation->annee }}</td>

                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>    
    </x-content-page>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            // DataTable for "Tous"
            $('#estimations-table-all').DataTable({
                buttons: [
                    { 
                        extend: 'print', 
                        className: 'btn btn-sm text-red-500 btn-primary fa fa-print', 
                        text:'' 
                    },
                    
                  
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        filename: 'MUPOL_estimations_{{ $categorie->nom }}',
                        title: 'MUPOL estimations {{ $categorie->nom }}', 

                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',
                        filename: 'MUPOL_estimations_{{ $categorie->nom }}',
                        title: function() {
                            var date = new Date();
                            var formattedDate = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear(); // Format DD/MM/YYYY
                            return 'MUPOL estimations {{ $categorie->nom }} - ' + formattedDate;
                        },                            
                        customize: function (doc) {
                            // Personnalisation du titre
                            doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        }
                    }
                ],
         
                paging: true,
                ordering: true,
                info: true,
                searching: true,
                lengthChange: true,
                lengthMenu: [10, 25, 50, 100],
                pagingType: 'simple_numbers',
                

                "language": {
                    "search": "Rechercher:",
                    "lengthMenu": "Afficher _MENU_ entrées par page",
                    "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    "infoEmpty": "Aucune entrée disponible",
                    "zeroRecords": "Aucun résultat trouvé",
                    "paginate": {
                        "previous": "Précédent",
                        "next": "Suivant"
                    }
                },
                "dom": '<"top"lBf>t<"bottom"p><"clear">',
                "initComplete": function() {
                    // Arrondir les coins de la barre de recherche
                    $('.dataTables_filter input').css('border-radius', '10px');
                    // Remplacer le label par un placeholder
                    $('.dataTables_filter label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).remove();                        
                    $('.dataTables_filter input').attr('placeholder', 'Rechercher...'); 
                    $('.dataTables_filter').css({
                        'position': 'relative',
                        
                    });                        
                    $('.dataTables_filter input').css({
                        'padding-left': '30px',  // Espace pour l'icône
                    }).before('<i class="fa fa-search absolute text-gray-300" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%);"></i>');

                    $('.dataTables_length select').css({
                        'padding': '6px 12px',
                        'font-family': 'Arial, sans-serif',
                        'font-size': '14px',                 // Change la taille de la police
                        
                    });
                    $('.dataTables_length').css({
                        'font-family': 'Arial, sans-serif',  // Change la police
                        'font-size': '14px',
                        'line-height': '1rem',
                        'color' : 'gray'
                    });
                    $('.dataTables_wrapper .top').css({
                        'display': 'flex',
                        'justify-content': 'space-between',
                        'align-items': 'center',
                        'margin-top': '20px',   // Marge supérieure
                        'margin-bottom': '20px'  // Marge inférieure
                    });
                    $('.dataTables_paginate .paginate_button').css({
                        'margin': '8px 20px',
                        'color' : 'gray',
                        'font-size': '14px',
                        'line-height': '1rem',
                    });
                },
            });

            @foreach($categoriesPrincipales as $categorie)
                $('#estimations-table-{{ $categorie->uuid }}').DataTable({
                   
                     
                        buttons: [
                        { 
                            extend: 'print', 
                            className: 'btn btn-sm text-red-500 btn-primary fa fa-print', 
                            text:'' 
                        },
                        
                      
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                            filename: 'MUPOL_estimations_{{ $categorie->nom }}',
                            title: 'MUPOL estimations {{ $categorie->nom }}', 

                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            titleAttr: 'PDF',
                            filename: 'MUPOL_estimations_{{ $categorie->nom }}',
                            title: function() {
                                var date = new Date();
                                var formattedDate = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear(); // Format DD/MM/YYYY
                                return 'MUPOL estimations {{ $categorie->nom }} - ' + formattedDate;
                            },                            
                            customize: function (doc) {
                                // Personnalisation du titre
                                doc.content[1].table.widths = 
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            }
                        }
                        ],
             
                        paging: true,
                        ordering: true,
                        info: true,
                        searching: true,
                        lengthChange: true,
                        lengthMenu: [10, 25, 50, 100],
                        pagingType: 'simple_numbers',
                        

                        "language": {
                            "search": "Rechercher:",
                            "lengthMenu": "Afficher _MENU_ entrées par page",
                            "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                            "infoEmpty": "Aucune entrée disponible",
                            "zeroRecords": "Aucun résultat trouvé",
                            "paginate": {
                                "previous": "Précédent",
                                "next": "Suivant"
                            }
                        },
                        "dom": '<"top"lBf>t<"bottom"p><"clear">',
                        "initComplete": function() {
                            // Arrondir les coins de la barre de recherche
                            $('.dataTables_filter input').css('border-radius', '10px');
                            // Remplacer le label par un placeholder
                            $('.dataTables_filter label').contents().filter(function() {
                                return this.nodeType === 3;
                            }).remove();                        
                            $('.dataTables_filter input').attr('placeholder', 'Rechercher...'); 
                            $('.dataTables_filter').css({
                                'position': 'relative',
                                
                            });                        
                            $('.dataTables_filter input').css({
                                'padding-left': '30px',  // Espace pour l'icône
                            }).before('<i class="fa fa-search absolute text-gray-300" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%);"></i>');

                            $('.dataTables_length select').css({
                                'padding': '6px 12px',
                                'font-family': 'Arial, sans-serif',
                                'font-size': '14px',                 // Change la taille de la police
                                
                            });
                            $('.dataTables_length').css({
                                'font-family': 'Arial, sans-serif',  // Change la police
                                'font-size': '14px',
                                'line-height': '1rem',
                                'color' : 'gray'
                            });
                            $('.dataTables_wrapper .top').css({
                                'display': 'flex',
                                'justify-content': 'space-between',
                                'align-items': 'center',
                                'margin-top': '20px',   // Marge supérieure
                                'margin-bottom': '20px'  // Marge inférieure
                            });
                            $('.dataTables_paginate .paginate_button').css({
                                'margin': '8px 20px',
                                'color' : 'gray',
                                'font-size': '14px',
                                'line-height': '1rem',
                            });
                        },
                });
            @endforeach

            // Afficher l'onglet actif et changer la couleur de fond de l'onglet sélectionné
            $("a.tab-link").on("click", function (e) {
                e.preventDefault();

                // Retirer la couleur de fond de tous les onglets
                $("a.tab-link").removeClass("bg-[#4845D8] text-white").addClass("text-blue-600");

                // Ajouter la couleur de fond et changer la couleur du texte de l'onglet actif
                $(this).removeClass("text-blue-600").addClass("bg-[#4845D8] text-white");

                // Masquer tous les contenus d'onglets et afficher celui sélectionné
                $(".tab-content").addClass("hidden");
                var targetTab = $(this).attr("href");
                $(targetTab).removeClass("hidden");
            });

            $("a.tab-link:first").addClass("bg-[#4845D8] text-white");
            $(".tab-content:first").removeClass("hidden");
        });
    </script>
</x-app-layout>
