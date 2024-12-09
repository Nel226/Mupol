
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
            @role('comptable')
                <x-tabs :tabs="['Recettes', 'Dépenses']">
                   
        
                    <!-- Recettes Tab -->
                    <div id="tab-recettes" class="tab-pane  sm:p-4 p-1">
                        
                        <div class="max-w-7xl mx-auto py-6">
                            <form method="GET" action="{{ route('caisse.index') }}" class="mb-6 flex items-center space-x-4">
                                <label for="year" class="text-base font-medium">Sélectionnez l&apos;année:</label>
                                <select name="year" onchange="this.form.submit()" class="form-select block w-[15%] border border-gray-300 rounded-md px-2 py-2">
                                    @for ($i = 2020; $i <= now()->year; $i++) 
                                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </form>
                            
        
                
                            <div class="bg-white p-6 overflow-x-auto ">
                                <canvas id="recetteChart"></canvas>
                            </div>
                            <script>
                                var ctx = document.getElementById('recetteChart').getContext('2d');
                                var recetteChart = new Chart(ctx, {
                                    type: 'bar', 
                                    data: {
                                        labels: @json($categories->pluck('nom')), 
                                        datasets: [{
                                            label: 'Montant des recettes (en XOF)',
                                            data: @json(array_values($data)),
                                            backgroundColor: 'rgba(54, 162, 235, 0.2)', 
                                            borderColor: 'rgba(54, 162, 235, 1)', 
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y: {
                                                beginAtZero: true // L'axe Y commence à 0
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
        
                    </div>
        
                    <!-- Depenses Tab -->
                    <div id="tab-depenses" class="tab-pane overflow-x-auto sm:p-4 p-1">
                        <span class="text-sm my-3">
                            Caisse nationale
                        </span>
                        @if(isset($adherentsCountPerRegion['Centre']))
                            <div class="flex items-center p-4 bg-gray-200 border shadow-lg mb-6">
                                <div class="w-10 h-10 p-3 mr-4 text-primary1 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fa fa-bank"></i>
                                </div>
                                <div>
                                    <p class="mb-2 text-base font-medium text-gray-600">
                                        Centre
                                    </p>
                                    <p class="text-xs font-semibold text-gray-700">
                                        {{ $adherentsCountPerRegion['Centre'] }} adhérents
                                    </p>
                                </div>
                            </div>
                        @endif
        
                        <span class="text-sm my-3">
                            Caisse régionales
                        </span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-3 border-gray-300 divide-y divide-gray-300 lg:divide-y-0 lg:divide-x">
                            @foreach($adherentsCountPerRegion as $region => $count)
                                @if($region !== 'Centre') <!-- S'assurer que la région Centre n'est pas incluse ici -->
                                    <div class="flex items-center p-4 bg-white border shadow-lg">
                                        <div class="w-10 h-10 p-3 mr-4 text-primary1 bg-purple-100 rounded-full flex items-center justify-center">
                                            <i class="fa fa-bank"></i>
                                        </div>
                                        <div>
                                            <p class="mb-2 text-base font-medium text-gray-600">
                                                {{ $region }}
                                            </p>
                                            <p class="text-xs font-semibold text-gray-700">
                                                {{ $count }} adhérents
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div> 
                        
                    </div>
                   
                </x-tabs>
            @endrole
        </div>
        
        <script defer>
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
                const tableRecettes = initializeDataTable('#table-recettes');
                const tableDepenses = initializeDataTable('#table-depenses');
               

            });
        </script>
        
    </x-content-page-admin>
</x-app-layout>


