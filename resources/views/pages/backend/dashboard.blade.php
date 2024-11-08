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

        {{--  <div class="flex items-center px-4 py-2 text-gray-500 bg-[#fffe4a70] rounded-t-lg shadow-lg">
            <h1 class="flex-1 text-2xl font-bold">{{$pageTitle}}</h1>
        </div>  --}}
        
        <div class="flex-1 p-6">

            <!-- Main Content -->
            <div class="grid grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-4">
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

            <div class="mt-6 grid grid-cols-3 lg:grid-cols-3 gap-6">
                <div class=" col-span-1 row-span-1 bg-white shadow-lg rounded-lg">
                    <div class="relative flex items-center justify-center rounded-lg bg-cover bg-center h-full" style="background-image: url('{{ asset('images/background1.jpg') }}');">
                        <div class="absolute inset-0 bg-black opacity-30 rounded-lg"></div>
                        
                        <div class="relative z-10 text-white  p-6">
                            
                            <div class="flex items-center space-x-2 w-full text-lg">
                                {{--  <img src="{{ asset('images/welcome-48.png') }}" alt="Icône calendrier" class="w-12 h-12">  --}}
                                <div class=" flex-none">
                                    <div>
                                        <h1 class="font-bold">
                                            {{ __('Bienvenue, ') }}
                                        </h1>
                                        <!-- <span class="font-semibold">
                                            {{ Auth::user()->name }}
                                        </span> -->

                                    </div>
                                </div>
                            </div>
                            <div class="flex text-gray-200 items-center  mt-4">
                                <i class="fa fa-calendar mr-2"></i>
                                <span id="current-date-time" class="text-base font-medium">
                                    {{ $currentDateTime->format('l, j F Y') }}
                                </span>
                            </div>
                            
                            
                        </div>
                    </div>
                    
                </div>
                <div class=" col-span-2 row-span-3 bg-white p-6 shadow-lg rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900">Sommes dépensées  pour prestations</h3>
                    <div style="height: 400px" class="flex justify-center items-center">
                        <canvas id="prestationsPieChart" class=" "></canvas>  
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
                                plugins: {
                                    legend: {
                                        position: 'left',  
                                    },
                                   
                                },
                                
                            }
                        });
                    </script>
                </div>
                
                <div class="col-span-1 row-span-2 bg-white p-6 shadow-lg rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900">États des paiements</h3>

                    <ul class="space-y-4 mt-4">
                        <!-- Paiements non effectués -->
                        <li class="flex items-center p-4 border border-gray-200 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-200">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100 text-blue-500 text-lg font-bold">
                                    {{$pourcentageInvalidatedPrestationsCount}}%
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-gray-900">Non effectués</h3>
                            </div>
                        </li>
                
                        <!-- Paiements effectués -->
                        <li class="flex items-center p-4 border border-gray-200 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-200">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-purple-100 text-purple-500 text-lg font-bold">
                                    {{$pourcentageValidatedPrestationsCount}}%
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-gray-900">Effectués</h3>
                            </div>
                        </li>
                    </ul>
                </div>
                
                
                
            </div>
            <div class="mt-6 grid grid-cols-2 lg:grid-cols-2 gap-6">
                <!-- Chart 1: Line Chart -->
                <div class="bg-white p-6 shadow-lg rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900">Sommes dépensées par mois</h3>
                    <canvas id="lineChart"></canvas>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white p-6 shadow-lg rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900">Dernières prestations</h3>

                    <div class="relative overflow-x-auto mt-4 shadow-md sm:rounded-lg">
                        <table class="table-auto w-full rounded-md">
                            <thead class="rounded-md">
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2">ID</th>
                                    
                                    <th class="px-4 py-2">Montant</th>
                                    <th class="px-4 py-2">Paiement</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestationsEnAttente as $prestation)
                                <tr>
                                    <td class="border px-4 py-2">{{ $prestation->idPrestation }}</td>
                                    <td class="border text-right px-4 py-2">
                                        <span class="bg-blue-100 text-[#4000FF]  text-xs font-medium inline-flex items-center  px-2.5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                            {{ $prestation->montant }}
                                        </span>
                                        
                                    </td>
                                    <td class="border px-4 py-2">
                                        @if ($prestation->etat_paiement === 1)
                                        <span class="flex items-center justify-center p-2 text-green-600 ">
                                            <i class=" fa fa-check " style="font-size:20px;"></i>
                                        </span>                                             
                                        @else
                                        <span class="flex items-center justify-center text-orange-600">
                                            <i class="fa fa-hourglass-half" style="font-size:20px;" aria-hidden="true"></i>
                                        </span> 
                                        @endif

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                
            </div>
                           
        </div>
       
    </x-content-page>
    
    
    <!-- Chart.js Scripts -->
    
    <script>
        var ctxLine = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                datasets: [{
                    label: 'Paiements Mensuels',
                    data: @json($monthlyPayments),
                    borderColor: 'rgba(99, 102, 241, 1)',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(99, 102, 241, 1)',
                    pointBorderColor: '#ffffff',
                    pointHoverRadius: 6,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color: '#6B7280',
                            font: {
                                family: 'Inter, sans-serif',
                                size: 12,
                                weight: '500',
                            },
                            maxRotation: 0, // Empêche l'inclinaison des labels
                            minRotation: 0 // Garde les labels droits
                        }
                    },
                    y: {
                        grid: {
                            borderDash: [5, 5],
                            color: 'rgba(229, 231, 235, 0.5)',
                        },
                        ticks: {
                            color: '#6B7280',
                            font: {
                                family: 'Inter, sans-serif',
                                size: 12,
                                weight: '500',
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#4B5563',
                            font: {
                                family: 'Inter, sans-serif',
                                size: 14,
                                weight: '600',
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#4F46E5',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        titleFont: {
                            family: 'Inter, sans-serif',
                            size: 14,
                            weight: '600',
                        },
                        bodyFont: {
                            family: 'Inter, sans-serif',
                            size: 12,
                            weight: '400',
                        },
                        padding: 12,
                        cornerRadius: 8
                    }
                }
            }
        });
    </script>
</x-app-layout>


