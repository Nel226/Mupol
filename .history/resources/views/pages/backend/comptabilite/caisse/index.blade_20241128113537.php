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

            <div class="p-6 mx-auto mt-4 bg-white min-h-screen rounded-b-lg shadow-lg ">
                <!-- Tabs -->
                <div class="mb-4">
                    <ul class="flex border-b">
                        <li class="mr-1">
                            <a href="#recettes" class="inline-block py-2 px-3 text-blue-600 hover:text-whit text-sm rounded-t-md focus:outline-none tab-link">
                                Recettes
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#depenses" class="inline-block py-2 px-3 text-blue-600 hover:text-whit text-sm rounded-t-md focus:outline-none tab-link">
                                Dépenses
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tous tab content -->
                <div id="recettes" class="tab-content hidden">
                    <div class="max-w-7xl mx-auto py-6">
                        <form method="GET" action="{{ route('caisse.index') }}" class="mb-6 flex items-center space-x-4">
                            <label for="year" class="text-base font-medium">Sélectionnez l&apos;année:</label>
                            <select name="year" onchange="this.form.submit()" class="form-select block w-[15%] border border-gray-300 rounded-md px-2 py-2">
                                @for ($i = 2020; $i <= now()->year; $i++) 
                                    <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </form>
                        
    
            
                        <div class="bg-white p-6 shadow rounded">
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

                <div id="depenses" class="tab-content hidden">
                    
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
                <script>
                    $(document).ready(function() {
                        $("a.tab-link").on("click", function (e) {
                            e.preventDefault();
            
                            // Retirer la couleur de fond de tous les onglets
                            $("a.tab-link").removeClass("bg-primary1 text-white").addClass("text-blue-600");
            
                            // Ajouter la couleur de fond et changer la couleur du texte de l'onglet actif
                            $(this).removeClass("text-blue-600").addClass("bg-primary1 text-white");
            
                            // Masquer tous les contenus d'onglets et afficher celui sélectionné
                            $(".tab-content").addClass("hidden");
                            var targetTab = $(this).attr("href");
                            $(targetTab).removeClass("hidden");
                        });
            
                        $("a.tab-link:first").addClass("bg-primary1 text-white");
                        $(".tab-content:first").removeClass("hidden");
                    });
                </script>
            </div>
        </div>
    </x-content-page>
    
</x-app-layout>
