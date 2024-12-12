<x-app-layout >
    <x-top-navbar-admin/>

    <div id="sidebar" class="lg:block z-20 hidden  bg-blue-800  w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" class="" />
    
    </div>
   
    <x-content-page-admin>
        <!-- Main Content -->
        <div class="mb-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2 xl:grid-cols-4">
            
            <!-- Card 1 -->
            <div class="w-full">
                <div class="bg-white shadow-xl rounded-2xl p-3">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-semibold">{{__('Mutualistes')}}</p>
                            <h5 class="font-bold">{{$mutualistesCount}}</h5>
                        </div>
                        <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-tl from-[#4000FF] to-[#e0d9f6] shadow-lg">
                            <i class="fa fa-users text-white text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="w-full">
                <div class="bg-white shadow-xl rounded-2xl p-3">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-semibold">{{__('Adhérents')}}</p>
                            <h5 class="font-bold">{{$adherentsCount}}</h5>
                        </div>
                        <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-tl from-[#4000FF] to-[#e0d9f6] shadow-lg">
                            <i class="fa fa-user text-white text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="w-full">
                <div class="bg-white shadow-xl rounded-2xl p-3">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-semibold">{{__('Ayants-droit')}}</p>
                            <h5 class="font-bold">{{$ayantsDroitCount}}</h5>
                        </div>
                        <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-tl from-[#4000FF] to-[#e0d9f6] shadow-lg">
                            <i class="fa fa-users text-white text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->

            <div class="w-full  ">
                <div class="bg-white shadow-xl rounded-2xl p-3">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-semibold">{{__('Paiements')}}</p>
                            <h5 class="font-bold">{{$validatedPrestationsCount}}</h5>
                        </div>
                        <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-tl from-[#4000FF] to-[#e0d9f6] shadow-lg">
                            <i class="fa fa-money text-white text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       

        <div class="mt-6 grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Carte 1 : Bienvenue -->
            <div class="bg-white shadow-lg rounded-lg">
                <div class="relative flex items-center justify-center rounded-lg bg-cover bg-center h-full"
                    style="background-image: url('{{ asset('images/background1.jpg') }}');">
                    <div class="absolute inset-0 bg-black opacity-30 rounded-lg"></div>
                    <div class="relative  text-white p-4">
                        <h1 class="text-lg font-bold">
                            {{ __('Bienvenue, ') }}
                        </h1>
                        <div class="text-sm text-gray-200 mt-2">
                            <i class="fa fa-calendar mr-2"></i>
                            <span id="current-date-time">
                                {{ $currentDateTime->format('l, j F Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Carte 2 : Graphique -->
            @role('controleur|comptable')
            <div class="col-span-1 md:col-span-2 bg-white p-6 shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">Sommes dépensées pour prestations</h3>
                <div class="flex justify-center items-center h-64">
                    <canvas id="prestationsPieChart"></canvas>
                </div>
                <script>
                    const ctx = document.getElementById('prestationsPieChart').getContext('2d');
                    const prestationsCostsByAct = @json($prestationsCostsByAct);
        
                    function getLegendPosition() {
                        const screenWidth = window.innerWidth;
                        return screenWidth < 768 ? 'bottom' : 'right';
                    }

                    const chart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: Object.keys(prestationsCostsByAct),
                            datasets: [{
                                data: Object.values(prestationsCostsByAct),
                                backgroundColor: [
                                    'rgb(5,92,157)', 'rgb(104,187,227)', 'rgb(14,134,212)', 'rgb(0,59,115)',
                                    'rgb(65,114,159)', 'rgb(65,114,109)', 'rgb(65,14,109)', 'rgb(6,114,19)',
                                    'rgb(160,114,199)', 'rgb(65,14,199)'
                                ],
                                borderColor: 'rgba(255,255,255,0.5)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: getLegendPosition() // Position initiale
                                }
                            }
                        }
                    });

                    window.addEventListener('resize', () => {
                        chart.options.plugins.legend.position = getLegendPosition(); // Met à jour la position
                        chart.update(); // Re-render le graphique
                    });

                </script>
            </div>
            @endrole
            @role('agentsaisie')
            <div class="col-span-1 md:col-span-2 bg-white p-6 shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">Evolution du nombre de mutualistes</h3>
                <form method="GET" action="{{ route('admin.dashboard') }}">
                    <label for="year">Sélectionner l&apos;année :</label>
                    <select class=" rounded-md" name="year" id="year" onchange="this.form.submit()">
                        @for ($year = 2020; $year <= now()->year; $year++)
                            <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                </form>
                <div class="flex justify-center items-center h-64">
                    <canvas id="mutualistesChart"></canvas>
                </div>
                
                <script>
                    const ctx = document.getElementById('mutualistesChart').getContext('2d');
                    const mutualistesChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                            datasets: [{
                                label: 'Nombre de mutualistes',
                                data: @json(array_values($evolutionMutualistes)),
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            
            </div>
            
            @endrole
            @role('administrateur')
            <div class="col-span-1 md:col-span-2 bg-white p-6 shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">Derniers utilisateurs créés</h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto text-xs">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Nom</th>
                                <th class="px-4 py-2 text-left">Rôle</th>
                                <th class="px-4 py-2 text-left">Créé le</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentUsers as $user)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">
                                        @if ($user->roles->isNotEmpty()) 
                                        <span class="bg-purple-100 px-2 py-1 text-purple-700 font-medium rounded-md">
                                            {{ $user->roles->first()->name }}
                                        </span>
                                        @else
                                            Aucune rôle
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            @endrole
        
        </div>
        
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 lg:grid-cols-2">
            
            @role('agentsaisie')
            <div class="bg-white p-4 md:p-6 shadow-lg rounded-lg">
                <!-- Carte : États des paiements -->
                <h3 class="text-base md:text-lg font-semibold text-gray-900">Nombre de mutualistes</h3>
    
                <div class="flex justify-center items-center  h-64">
                    <canvas id="mutualistesPieChart"></canvas>
                </div>
                
                <script>
                    const adherentsCount = @json($adherentsCount);
                    const ayantsDroitCount = @json($ayantsDroitCount);
                
                    if (adherentsCount !== null && ayantsDroitCount !== null) {
                        const ctx = document.getElementById('mutualistesPieChart').getContext('2d');
                
                        const mutualistesPieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Adhérents', 'Ayants Droits'],
                                datasets: [{
                                    data: [adherentsCount, ayantsDroitCount],
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgb(30,64,175)',
                                    ],
                                    borderColor: [
                                        'rgba(75, 192, 192, 1)',
                                        'rgb(30,64,175)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function (tooltipItem) {
                                                const total = adherentsCount + ayantsDroitCount;
                                                const value = tooltipItem.raw;
                                                const percentage = ((value / total) * 100).toFixed(2);
                                                return `${tooltipItem.label}: ${value} (${percentage}%)`;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                        console.log(mutualistesPieChart);
                    } else {
                        console.error('Les données des mutualistes sont manquantes.');
                    }
                </script>
            </div>
            <!-- Carte : Dernières prestations -->
            <div class="card bg-white  shadow-lg rounded-lg h-full ">
                <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                   <!-- title -->
                   <div>
                      <h4>Dernières prestations</h4>
                   </div>
                   
                </div>

                <div class="relative overflow-x-auto">
                   <!-- table -->
                   <table class="text-left w-full whitespace-nowrap">
                      <thead class="text-gray-700">
                         <tr>
                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">ID</th>
                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Montant</th>
                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Statut</th>
                         </tr>
                      </thead>
                      <tbody>
                        @forelse ( $prestationsEnAttente as $prestation )
                            <tr>
                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">{{ $prestation->idPrestation }}</td>

                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                <span class="bg-blue-100 text-primary1 text-xs md:text-sm font-medium inline-flex items-center px-2.5 py-1 rounded border border-blue-400">
                                    {{ $prestation->montant }}
                                </span>
                            </td>
                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                @if ($prestation->etat_paiement === 1)
                                    <span class="bg-green-100 px-2 py-1 text-green-700 text-sm font-medium rounded-md">Payé</span>

                                @else
                                    <span class="bg-orange-100 px-2 py-1 text-orange-700 text-sm font-medium rounded-md">
                                        <i class="fa fa-hourglass-half text-lg" aria-hidden="true"></i>
                                    </span>

                                <span class="flex items-center justify-center text-orange-600">
                                    <i class="fa fa-hourglass-half text-lg" aria-hidden="true"></i>
                                </span>
                                @endif
                            </td>
                            </tr>
                            
                        @empty
                            <tr>
                                <td colspan="3" class=" border-b border-gray-300 font-medium py-3 px-6 text-center">
                                    Aucune prestation
                                </td>

                            </tr>
                            
                        @endforelse
                         
                         
                        
                      </tbody>
                   </table>
                </div>
            </div>
            @endrole
            @role('controleur|comptable')
            <div class="bg-white p-4 md:p-6 shadow-lg rounded-lg">
                <h3 class="text-base md:text-lg font-semibold text-gray-900">États des paiements</h3>
                <ul class="space-y-3 mt-4">
                    <!-- Non effectués -->
                    <li class="flex items-center p-3 md:p-4 border border-gray-200 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-200">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-blue-100 text-blue-500 text-sm md:text-lg font-bold">
                                {{$pourcentageInvalidatedPrestationsCount}}%
                            </div>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h3 class="text-sm md:text-base font-semibold text-gray-900">Non effectués</h3>
                        </div>
                    </li>
                    <!-- Effectués -->
                    <li class="flex items-center p-3 md:p-4 border border-gray-200 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-200">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-purple-100 text-purple-500 text-sm md:text-lg font-bold">
                                {{$pourcentageValidatedPrestationsCount}}%
                            </div>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h3 class="text-sm md:text-base font-semibold text-gray-900">Effectués</h3>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Carte : Dernières prestations -->
            <div class="card bg-white  shadow-lg rounded-lg h-full ">
                <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                   <!-- title -->
                   <div>
                      <h4>Dernières prestations</h4>
                   </div>
                   
                </div>

                <div class="relative overflow-x-auto">
                   <!-- table -->
                   <table class="text-left w-full whitespace-nowrap">
                      <thead class="text-gray-700">
                         <tr>
                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">ID</th>
                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Montant</th>
                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Statut</th>
                         </tr>
                      </thead>
                      <tbody>
                        @forelse ( $prestationsEnAttente as $prestation )
                            <tr>
                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">{{ $prestation->idPrestation }}</td>

                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                <span class="bg-blue-100 text-primary1 text-xs md:text-sm font-medium inline-flex items-center px-2.5 py-1 rounded border border-blue-400">
                                    {{ $prestation->montant }}
                                </span>
                            </td>
                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                @if ($prestation->etat_paiement === 1)
                                    <span class="bg-green-100 px-2 py-1 text-green-700 text-sm font-medium rounded-md">Payé</span>

                                @else
                                    <span class="bg-orange-100 px-2 py-1 text-orange-700 text-sm font-medium rounded-md">
                                        <i class="fa fa-hourglass-half text-lg" aria-hidden="true"></i>
                                    </span>

                                <span class="flex items-center justify-center text-orange-600">
                                    <i class="fa fa-hourglass-half text-lg" aria-hidden="true"></i>
                                </span>
                                @endif
                            </td>
                            </tr>
                            
                        @empty
                            <tr>
                                <td colspan="3" class=" border-b border-gray-300 font-medium py-3 px-6 text-center">
                                    Aucune prestation
                                </td>

                            </tr>
                            
                        @endforelse
                         
                         
                        
                      </tbody>
                   </table>
                </div>
            </div>
            @endrole

            @role('administrateur')
            <div class=" col-span-2 bg-white p-4 md:p-6 shadow-lg rounded-lg">
                <h3 class="text-base md:text-lg font-semibold text-gray-900">Nombre d&apos;utilisateurs par rôles</h3>
    
                <div class="flex justify-center items-center  h-64">
                    <canvas id="rolesChart"></canvas>
                </div>
                
                <script>
                    var rolesData = @json($roles);  
            
                    var labels = rolesData.map(function(role) {
                        return role.name; 
                    });
            
                    var data = rolesData.map(function(role) {
                        return role.users_count;  
                    });
            
                    var ctx = document.getElementById('rolesChart').getContext('2d');
            
                    var rolesChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,  
                            datasets: [{
                                label: 'Nombre d\'utilisateurs par rôle',
                                data: data,
                                backgroundColor: [
                                    '#1D4ED8', // Bleu légèrement plus clair
                                    '#3B82F6', // Bleu ciel clair
                                    '#4000FF', // Bleu plus pâle
                                    '#93C5FD'  // Bleu pastel
                                ],
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw + ' utilisateurs';
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
            @endrole

            
         
        </div>
    </x-content-page-admin>
    
    
    


    
</x-app-layout>
