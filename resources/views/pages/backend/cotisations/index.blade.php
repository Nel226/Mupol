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
        <x-header>
            {{ $pageTitle }}
        </x-header>

        <div class="md:p-6 p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg">
            @role('comptable|controleur') 
              
            
            <div class="bg-gray-300 mb-3 text-gray-600 rounded-lg p-4">
                <form action="{{ route('cotisations.index') }}" method="GET" class="">
                    <div class="flex flex-col md:flex-row items-center gap-4">
                     
                        <div class="flex items-center gap-2 w-full md:w-auto">
                            <label for="start_date" class="text-sm font-medium">Date de début:</label>
                            <input type="date" name="start_date" id="start_date" class="border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-indigo-500 w-full md:w-auto" value="{{ request('start_date') }}">
                        </div>
                        <div class="flex items-center gap-2 w-full md:w-auto">
                            <label for="end_date" class="text-sm font-medium">Date de fin:</label>
                            <input type="date" name="end_date" id="end_date" class="border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-indigo-500 w-full md:w-auto" value="{{ request('end_date') }}">
                        </div>
                        <div class="flex items-center gap-2 w-full md:w-auto">
                            <button type="submit" class="btn bg-blue-500">
                                Filtrer
                            </button>
                        </div>
                       
                    </div>
                    
                </form>
            </div>
            
                <x-tabs :tabs="['Entrées', 'Dépenses']">
                    <!-- Entrees Tab -->
                    <div id="tab-entrees" class="tab-pane sm:p-4 p-1 bg-white rounded-md shadow-md">

                        <!-- Tabs Content -->
                        <div id="tab-entrees-content" class="">
                            <div class="grid grid-cols-1 gap-4 w-full">
                                <div class="flex justify-center items-center mx-auto">
                                    <!-- On ajoute un wrapper pour garantir un comportement responsive -->
                                    <div class="relative w-full" style="max-width: 100%; height: 400px;"> <!-- Défini une hauteur par défaut -->
                                        <canvas id="myBarChart" class="w-full h-full"></canvas>
                                    </div>
                                </div>
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
                                            maintainAspectRatio: false,
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
                                                    position: 'bottom', 
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
                            
                            
                            <x-data-table id="table-entrees" :headers="['#', 'Adhérent', 'Date d\'adhésion', 'Prix d\'adhésion', 'Mensualité', 'Nombre de mois', 'Total des mensualités', 'Total']">
                                @foreach($adherents as $adherent)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                        <td class="px-6 py-4">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $adherent->nom }} {{ $adherent->prenom }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $adherent->date_enregistrement }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $adherent->adhesion }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $adherent->mensualite }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $adherent->months_since_joining }} mois
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $adherent->total_mensualites }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $adherent->total_cotisations }}
                                        </td>
                                    </tr>
                                @endforeach
                            </x-data-table>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <x-info-card 
                                    label="Total des adhésions" 
                                    value="{{ number_format($sumTotalAdhesions, 2, ',', ' ') }} FCFA" 
                                    bgColor="blue" 
                                    textColor="primary1" 
                                    borderColor="blue" 
                                />
                                <x-info-card 
                                    label="Total des mensualités" 
                                    value="{{ number_format($sumTotalMensualites, 2, ',', ' ') }} FCFA" 
                                    bgColor="blue" 
                                    textColor="primary1" 
                                    borderColor="blue" 
                                />
                                <x-info-card 
                                    label="Caisse" 
                                    value="{{ number_format($sumTotalCotisations, 2, ',', ' ') }} FCFA" 
                                    bgColor="yellow" 
                                    textColor="yellow-700" 
                                    borderColor="yellow" 
                                />
                            </div>
                            
            
                        </div>
                        
                    </div>

                   
        
                    <!-- Dépenses Tab -->
                    <div id="tab-depenses" class="tab-pane  sm:p-4 p-1">
                        <div id="tab-depenses-content" class=" ">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                                <!-- Graphique Cotisations/Prestations -->
                                <div class="flex justify-center items-center">
                                    <canvas id="prestationsCotisationsChart" class="w-full h-auto"></canvas>  
                                </div>
                            
                                <!-- Graphique Pie Chart -->
                                <div class="flex justify-center items-center">
                                    <canvas id="prestationsPieChart" class="w-full h-auto"></canvas>  
                                </div>
                            </div>
                            
                            <script>
                                const ctx = document.getElementById('prestationsPieChart').getContext('2d');
                                const prestationsCostsByAct = @json($prestationsCostsByAct);
                                new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: Object.keys(prestationsCostsByAct),
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
                                        maintainAspectRatio: false,

                                        plugins: {
                                            legend: {
                                                position: 'bottom', // Position initiale
                                            },
                                            title: {
                                                display: true,
                                                text: 'Répartition du montant des prestations en fonction des actes'
                                            }
                                        }
                                    }
                                });
                            </script>
                            
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    var ctx = document.getElementById('prestationsCotisationsChart').getContext('2d');
                                    
                                    var totalCotisations = {{ $sumTotalCotisations }};
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
                                                    totalCotisations - totalPrestations
                                                ],
                                                backgroundColor: [
                                                    'rgb(255, 99, 132)',
                                                    'rgb(54, 162, 235)',
                                                ],
                                                borderColor: [
                                                    'rgb(255, 99, 132)',
                                                    'rgb(54, 162, 235)',
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,

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
                            
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 overflow-x-auto divide-x border gap-3 p-2 my-8  rounded-md bg-gray-100">
                                @foreach($prestationsCostsByAct as $acte => $cost)
                                    <x-info-card 
                                        label="{{ $acte }}" 
                                        value="{{ number_format($cost, 2, ',', ' ') }} FCFA" 
                                        bgColor="blue" 
                                        textColor="primary1" 
                                        borderColor="blue" 
                                    />
                                @endforeach
                            </div>
                            
                            
                            <x-data-table id="table-depenses" :headers="['Identifiant prestation', 'Adhérent', 'Montant', 'Numéro paiement', 'Montant modérateur', 'Montant Munapol']">
                                @foreach($prestations as $prestation)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                        <td class="px-6 py-4">
                                            <a href="">
                                                {{ $prestation->idPrestation }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="">
                                                {{ $prestation->adherentNom }} {{ $prestation->adherentPrenom }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="">
                                                {{ $prestation->montant }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="">
                                                {{ $prestation->contactPrestation }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="">
                                                {{ $prestation->montant * 20 / 100 }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="">
                                                {{ $prestation->montant * 80 / 100 }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-data-table>
                            
                           
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                                <x-info-card 
                                    label="Total des dépenses" 
                                    value="{{ number_format($sumTotalPrestations, 2, ',', ' ') }} FCFA" 
                                    bgColor="blue" 
                                    textColor="primary1" 
                                    borderColor="blue" 
                                />
                                <x-info-card 
                                    label="Reste dans la caisse" 
                                    value="{{ number_format($sumTotalCotisations-$sumTotalPrestations, 2, ',', ' ') }} FCFA" 
                                    bgColor="blue" 
                                    textColor="primary1" 
                                    borderColor="blue" 
                                />
                            
                            </div>
                         
                            
                        </div>
                     
                    </div>
        
                    <script>
                        $(document).ready(function () {
                            function initializeDataTable(tableId) {
                                return $(tableId).DataTable({
                                    dom: "<'flex flex-wrap items-center justify-between mb-2'lf>Bt<'flex items-center justify-between mt-2'ip>",
                                    buttons: ['print', 'excel', 'pdf'],
                                    scrollX: true,
                                    responsive: true
                                });
                            }
                    
                            // Initialize all tables
                            const tableEntrees = initializeDataTable('#table-entrees');
                            const tableDepenses = initializeDataTable('#table-depenses');
                    
                           
                        });
                    </script>
                </x-tabs>
            @endrole
        </div>
        
    </x-content-page-admin>
</x-app-layout>


