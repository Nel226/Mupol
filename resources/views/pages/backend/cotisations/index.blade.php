
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

    @role('comptable|controleur')
    <x-content-page-admin>

        @include('layouts.navigation')
        @section('breadcrumbs')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        @endsection
        
        <x-header>
            {{$pageTitle}}
        </x-header>

        <div class="">

            <!-- Tabs Navigation -->
            <div class="flex flex-wrap mt-2 sm:mt-4 border-b border-gray-200">
                <button id="tab-entrees" class="w-1/2 py-2 text-center text-gray-600 border-b-2 border-transparent focus:outline-none hover:border-gray-300 active-tab">Entrées</button>
                <button id="tab-depenses" class="w-1/2 py-2 text-center text-gray-600 border-b-2 border-transparent focus:outline-none hover:border-gray-300">Dépenses</button>
            </div>

            <div class="p-2 sm:p-6 mx-auto mt-2 sm:mt-4 bg-white rounded-lg shadow-lg ">
    
                    <h1 class="pb-0 sm:pb-3 text-xl font-bold text-center underline ">Suivi des cotisations </h1>
                
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between py-4 w-full text-sm gap-4">
                        <div class="flex gap-3 w-full ">
                            <form action="{{ route('cotisations.index') }}" method="GET" 
                                class="grid gap-4 bg-gray-100 w-full p-4 rounded-md sm:grid-cols-2 lg:grid-cols-3">
                                <!-- Élément 1 : Filtre -->
                                <div class="col-span-full sm:col-span-2 lg:col-span-3">
                                    <label for="year" class="block font-semibold">Filtre</label>
                                </div>

                                <!-- Élément 2 : Date de début -->
                                <div>
                                    <label for="start_date" class="block font-semibold">Date de début :</label>
                                    <input 
                                        type="date" 
                                        name="start_date" 
                                        id="start_date" 
                                        class="w-full py-2 px-3 rounded-md border border-gray-300" 
                                        value="{{ request('start_date') }}">
                                </div>

                                <!-- Élément 3 : Date de fin -->
                                <div>
                                    <label for="end_date" class="block font-semibold">Date de fin :</label>
                                    <input 
                                        type="date" 
                                        name="end_date" 
                                        id="end_date" 
                                        class="w-full py-2 px-3 rounded-md border border-gray-300" 
                                        value="{{ request('end_date') }}">
                                </div>

                                <!-- Élément 4 : Bouton Filtrer -->
                                <div class="flex justify-end col-span-full sm:col-span-2 lg:col-span-1">
                                    <x-primary-button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-md">
                                        Filtrer
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
            
                <!-- Tabs Content -->
                <div id="tab-entrees-content" class="mt-2 tab-content">
                    <div class="max-w-5xl  mx-auto">
                        <canvas id="myBarChart" height="100px" class="overflow-x-auto"></canvas>
                    </div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var ctx = document.getElementById('myBarChart').getContext('2d');
                            var myBarChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: [
                                        'Total Mensualités',
                                        'Total Cotisations',
                                        'Total Adhesions',
                                        'Total Prestations'
                                    ],
                                    datasets: [{
                                        label: 'Montants en FCFA',
                                        data: [
                                            {{ $sumTotalMensualites }},
                                            {{ $sumTotalCotisations }},
                                            {{ $sumTotalAdhesions }},
                                            {{ $sumTotalPrestations }}
                                        ],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 205, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Montant (FCFA)'
                                            }
                                        }
                                    },
                                    plugins: {
                                        legend: {
                                            position: 'right',
                                            labels: {
                                                generateLabels: function(chart) {
                                                    const data = chart.data;
                                        
                                                    return data.labels.map((label, index) => {
                                                        const formattedValue = new Intl.NumberFormat('fr-FR').format(data.datasets[0].data[index]);
                                        
                                                        return {
                                                            text: `${label}: ${formattedValue} FCFA`,
                                                            fillStyle: data.datasets[0].backgroundColor[index],
                                                            hidden: false,
                                                            index: index
                                                        };
                                                    });
                                                }
                                            }
                                        },
                                        
                                        title: {
                                            display: true,
                                            text: 'Comparaison des Montants Financiers'
                                        }
                                    }
                                }
                            });
                        });
                        
                    </script>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between py-2 text-sm gap-4 sm:gap-2">
                        <!-- Custom "Show entries" with text -->
                        <div class="flex items-center space-x-2 sm:space-x-4">
                            <span>Afficher</span>
                            <div class="relative">
                                <select id="show-entries" class="block w-full sm:w-auto px-4 py-2 pr-8 leading-tight bg-white border border-gray-300 rounded shadow appearance-none hover:border-gray-400 focus:outline-none focus:shadow-outline">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <span>&eacute;l&eacute;ments</span>
                        </div>
                    
                        <!-- Custom search input -->
                        <div class="relative w-full sm:w-80">
                            <input type="text" id="table-search" class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    

                    <div class="overflow-x-auto rounded-lg">
                        <table id="table_entrees" class="w-full  cell-border hover text-sm text-left text-gray-500 border rounded-lg shadow-lg rtl:text-right dark:text-gray-400 display" style="width:100%">
                            <thead class="text-xs text-gray-700 uppercase rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="rounded-md" >
                                    <th>#</th>
                                    <th>Adhérent</th>
                                    <th>Date d'adhésion</th>
                                    <th>Prix d'adhésion</th>
                                    <th>Mensualité</th>
                                    <th>Nombre de mois</th>
                                    <th>Total des mensualités</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adherents as $adherent)
                                <tr class="bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 overflow-hidden whitespace-nowrap overflow-ellipsis">
                                        <a href="">
                                            {{ $loop->iteration }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $adherent->nom }}  {{ $adherent->prenom }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $adherent->date_enregistrement }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $adherent->adhesion }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $adherent->mensualite }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $adherent->months_since_joining }} mois
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $adherent->total_mensualites }} 
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $adherent->total_cotisations }} 
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-2 mt-8 bg-gray-100">
                        <!-- Column 1 -->
                        <div class="flex items-center justify-between">
                            <span class="text-left">Total des adhésions :</span>
                            <span class="bg-blue-100 text-primary1 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                {{ number_format($sumTotalAdhesions, 2, ',', ' ') }} FCFA
                            </span>
                        </div>
                    
                        <!-- Column 2 -->
                        <div class="flex items-center justify-between">
                            <span class="text-left">Total des mensualités :</span>
                            <span class="bg-blue-100 text-primary1 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                {{ number_format($sumTotalMensualites, 2, ',', ' ') }} FCFA
                            </span>
                        </div>
                    
                        <!-- Column 3 -->
                        <div class="flex items-center justify-between">
                            <span class="text-left">Caisse :</span>
                            <span class="bg-yellow-100 text-yellow-700 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-yellow-700">
                                {{ number_format($sumTotalCotisations, 2, ',', ' ') }} FCFA
                            </span>
                        </div>
                    </div>
                    
                    
    
                </div>
                
                <div id="tab-depenses-content" class="hidden mt-2 tab-content">
                    <h3 class="font-bold ">Prestations</h3>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <!-- Graphique Cotisations/Prestations -->
                        <div style="height: 400px" class="flex justify-center items-center">
                            <canvas id="prestationsCotisationsChart" class=""></canvas>  
                        </div>
                    
                        <!-- Graphique Pie Chart -->
                        <div style="height: 400px" class="flex justify-center items-center">
                            <canvas id="prestationsPieChart" class=" h-full"></canvas>  
                        </div>
                    </div>

                    <script>
                        const ctx = document.getElementById('prestationsPieChart').getContext('2d');
                        const prestationsCostsByAct = @json($prestationsCostsByAct);
                    
                        new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: Object.keys(prestationsCostsByAct),  // ['consultation', 'hospitalisation', 'radio', 'maternite', 'allocation']
                                datasets: [{
                                    label: 'Répartition des coûts des prestations par acte',
                                    data: Object.values(prestationsCostsByAct),  
                                    backgroundColor: [
                                        'rgb(5,92,157)', 
                                        'rgb(104,187,227)',  
                                        'rgb(14,134,212)',  
                                        'rgb(0,59,115)', 
                                        'rgb(65,114,159)',
                                        'rgb(65,114,109)',
                                        'rgb(65,14,109)',
                                        'rgb(6,114,19)', 
                                        'rgb(160,114,199)',
                                        'rgb(65,14,199)',
                                    ],
                                    borderColor: [
                                        'rgb(5,92,157)', 
                                        'rgb(104,187,227)',  
                                        'rgb(14,134,212)',  
                                        'rgb(0,59,115)', 
                                        'rgb(65,114,159)',
                                        'rgb(65,114,109)',
                                        'rgb(65,14,109)',
                                        'rgb(6,114,19)', 
                                        'rgb(160,114,199)',
                                        'rgb(65,14,199)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'left',  
                                    },
                                    title: {
                                        display: true,
                                        text: 'Répartition du montant des prestations en fonction des actes'
                                    }
                                    {{--  tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2);  // Format des labels dans la tooltip
                                            }
                                        }
                                    }  --}}
                                },
                                
                            }
                        });
                    </script>
                    
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var ctx = document.getElementById('prestationsCotisationsChart').getContext('2d');
                            
                            // Total des cotisations
                            var totalCotisations = {{ $sumTotalCotisations }};
                            // Total des prestations
                            var totalPrestations = {{ $sumTotalPrestations }};
                            
                            var myPieChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: [
                                        'Prestations',
                                        'Reste des Cotisations'
                                    ],
                                    datasets: [{
                                        label: 'Répartition des Prestations',
                                        data: [
                                            totalPrestations,
                                            totalCotisations - totalPrestations // Reste des cotisations
                                        ],
                                        backgroundColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',
                                        
                                        ],
                                        borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',  // Cotisations
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        title: {
                                            display: true,
                                            text: 'Part des Prestations dans les Cotisations'
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                    
                    <div class="grid grid-cols-3 divide-x  border gap-3 p-2 my-8 space-x-4 rounded-md bg-gray-100">
                        
                        @foreach($prestationsCostsByAct as $acte => $cost)
                            <div class="flex-1   flex items-center justify-between">
                                <span class="text-left capitalize">{{ $acte }}:</span>
                                <span class="bg-blue-100 text-primary1 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                    {{ number_format($cost, 2, ',', ' ') }} FCFA
                                </span>
                            </div>
                        @endforeach
                            
                    
                    </div>
                    
                    <div class="flex items-center justify-between py-2 text-sm">
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
                        <table id="table_depenses" class=" cell-border hover w-full text-sm text-left text-gray-500 border rounded-lg shadow-lg rtl:text-right dark:text-gray-400 display" style="width:100%">
                            
                            <thead class="text-xs text-gray-700 uppercase rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="rounded-md" >
                                    <th>Identifiant prestation</th>
    
                                    <th>Adhérent</th>
                                    <th>Montant </th>
    
                                    <th>Numéro paiement</th>
    
                                    <th>Montant modérateur</th>
    
                                    <th>Montant Munapol</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prestations as $prestation)
                                <tr class="bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $prestation->idPrestation }}  
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $prestation->adherentNom }}  {{ $prestation->adherentPrenom }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{  $prestation->montant}}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{  $prestation->contactPrestation}}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $prestation->montant*20/100 }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="">
                                            {{ $prestation->montant*80/100 }}
                                        </a>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   
                    <div class="flex p-2 mt-8 space-x-4 bg-gray-100">
                        <!-- Column 1 -->
                        <div class="flex items-center justify-between flex-1">
                            <span class="text-left">Total des dépenses:</span>
                            <span class="bg-blue-100 text-primary1 text-xs font-medium inline-flex items-center  px-2.5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                {{ number_format($sumTotalPrestations, 2, ',', ' ') }} FCFA
    
                            </span>
                        </div>
                        <div class="flex items-center justify-between flex-1">
                            <span class="text-left">Reste dans la caisse:</span>
                            <span class="bg-blue-100 text-primary1 text-xs font-medium inline-flex items-center  px-2.5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                {{ number_format($sumTotalCotisations-$sumTotalPrestations, 2, ',', ' ') }} FCFA
    
                            </span>
                        </div>
                    
                    </div>
                    
                </div>
    
    
    
    
            </div>
        </div>

        
    </x-content-page-admin>
    @endrole

    <script>
        document.getElementById('tab-entrees').addEventListener('click', function() {
            showTab('entrees');
        });
        
        document.getElementById('tab-depenses').addEventListener('click', function() {
            showTab('depenses');
        });
        
        function showTab(tabName) {
            var tabs = ['entrees', 'depenses'];
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
                if (tabName === 'entrees') {
                    tableAdherents.redraw(true); 
                } else if (tabName === 'depenses') {
                    tableAyantsDroit.redraw(true); 
                }
            }, 10);   --}}
        }
        $('#table_entrees').DataTable( {
            dom: 'Brtip',
            buttons: [
            { 
                extend: 'print', 
                className: 'btn btn-sm text-red-500 btn-primary fa fa-print', 
                text:'' 
            },
            
            
            ],
            
            
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
                search: "Search:",
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
        $('#table_depenses').DataTable( {
            dom: 'Brtip',
            buttons: [
            { 
                extend: 'print', 
                className: 'btn btn-sm text-red-500 btn-primary fa fa-print', 
                text:'' 
            },
            
            
            ],
            
            
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
                search: "Search:",
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
    </script>

</x-app-layout>
