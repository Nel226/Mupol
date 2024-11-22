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
            <div class=" flex justify-end">
                <a href="{{  route('partenaires.create') }}">
                    <x-primary-button>
                        Nouveau partenaire
                    </x-primary-button>
                </a>
            </div>

            <div class="p-6 mx-auto mt-4 bg-white min-h-screen rounded-b-lg shadow-lg">
                <!-- Tabs -->
                <div class="mb-4">
                    <ul class="flex border-b">
                        <li class="mr-1">
                            <a href="#all" class="inline-block py-2 px-3 text-blue-600 hover:text-whit text-sm rounded-t-md focus:outline-none tab-link">
                                Tous
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#hopitaux" class="inline-block py-2 px-3 text-blue-600 hover:text-whit text-sm rounded-t-md focus:outline-none tab-link">
                                Hôpitaux
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#cliniques" class="inline-block py-2 px-3 text-blue-600 hover:text-whit text-sm rounded-t-md focus:outline-none tab-link">
                                Cliniques
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#pharmacies" class="inline-block py-2 px-3 text-blue-600 hover:text-whit text-sm rounded-t-md focus:outline-none tab-link">
                                Pharmacies
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tous tab content -->
                <div id="all" class="tab-content hidden">
                    <table id="partenaires-table-all" class="w-full text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400 display">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Région</th>
                                <th>Province</th>
                                <th>Date d&apos;affiliation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partenaires as $partenaire)
                                <tr class="cursor-pointer" onclick="window.location='{{ route('partenaires.show', $partenaire->id) }}'">
                                    <td>{{ $partenaire->nom }}</td>
                                    <td>{{ $partenaire->type }}</td>
                                    <td>{{ $partenaire->adresse }}</td>
                                    <td>{{ $partenaire->telephone }}</td>
                                    <td>{{ $partenaire->email }}</td>
                                    <td>{{ $partenaire->region }}</td>
                                    <td>{{ $partenaire->province }}</td>
                                    <td>{{ $partenaire->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Hôpitaux tab content -->
                <div id="hopitaux" class="tab-content hidden">
                    <table id="hopitaux-table" class="w-full text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400 display">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th>Nom</th>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Région</th>
                                <th>Province</th>
                                <th>Date d&apos;affiliation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hopitaux as $hopital)
                                <tr class="cursor-pointer" onclick="window.location='{{ route('partenaires.show', $hopital->id) }}'">
                                    <td>{{ $hopital->nom }}</td>
                                    <td>{{ $hopital->adresse }}</td>
                                    <td>{{ $hopital->telephone }}</td>
                                    <td>{{ $hopital->email }}</td>
                                    <td>{{ $hopital->region }}</td>
                                    <td>{{ $hopital->province }}</td>
                                    <td>{{ $hopital->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Cliniques tab content -->
                <div id="cliniques" class="tab-content hidden">
                    <table id="cliniques-table" class="w-full text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400 display">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th>Nom</th>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Région</th>
                                <th>Province</th>
                                <th>Date d&apos;affiliation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cliniques as $clinique)
                                <tr class="cursor-pointer" onclick="window.location='{{ route('partenaires.show', $clinique->id) }}'">
                                    <td>{{ $clinique->nom }}</td>
                                    <td>{{ $clinique->adresse }}</td>
                                    <td>{{ $clinique->telephone }}</td>
                                    <td>{{ $clinique->email }}</td>
                                    <td>{{ $clinique->region }}</td>
                                    <td>{{ $clinique->province }}</td>
                                    <td>{{ $clinique->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pharmacies tab content -->
                <div id="pharmacies" class="tab-content hidden">
                    <table id="pharmacies-table" class="w-full text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400 display">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th>Nom</th>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Région</th>
                                <th>Province</th>
                                <th>Date d&apos;affiliation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pharmacies as $pharmacie)
                                <tr class="cursor-pointer" onclick="window.location='{{ route('partenaires.show', $pharmacie->id) }}'">
                                    <td>{{ $pharmacie->nom }}</td>
                                    <td>{{ $pharmacie->adresse }}</td>
                                    <td>{{ $pharmacie->telephone }}</td>
                                    <td>{{ $pharmacie->email }}</td>
                                    <td>{{ $pharmacie->region }}</td>
                                    <td>{{ $pharmacie->province }}</td>
                                    <td>{{ $pharmacie->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
            $('#partenaires-table-all, #hopitaux-table, #cliniques-table, #pharmacies-table').DataTable({
                buttons: [
                    { 
                        extend: 'print', 
                        className: 'btn btn-sm text-red-500 btn-primary fa fa-print', 
                        text:'' 
                    },
                                       
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
                    $('.dataTables_filter input').css('border-radius', '10px');
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

          

            $("a.tab-link").on("click", function (e) {
                e.preventDefault();

                $("a.tab-link").removeClass("bg-[#4845D8] text-white").addClass("text-blue-600");

                $(this).removeClass("text-blue-600").addClass("bg-[#4845D8] text-white");

                $(".tab-content").addClass("hidden");
                var targetTab = $(this).attr("href");
                $(targetTab).removeClass("hidden");
            });

            $("a.tab-link:first").addClass("bg-[#4845D8] text-white");
            $(".tab-content:first").removeClass("hidden");
        });
    </script> 
</x-app-layout>
