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
        {{-- @section('breadcrumbs')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        @endsection --}}
   
        <x-header>
            {{ $pageTitle }}
        </x-header>

        <div class="md:p-6 p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg">
        
            <div class="">
                <div id="tab-recapitulatif-content" class="mt-2 tab-content">
                    <h1 class="pb-3 text-xl font-bold text-center underline ">Suivi des dentaires et auditifs pour {{ $currentYear }}</h1>
                   
                    <div class="flex items-center justify-between py-4 text-sm">
                        <div class="flex gap-3 ">

                            <form method="GET" action="{{ route('suivi-dentaire-auditif') }}"  onsubmit="showSpinner()">
                                <label for="year">Sélectionner l&apos;année :</label>
                                <select name="year" id="year" onchange="this.form.submit()" class="py-1 rounded-md">
                                    @for ($i = 2020; $i <= 2030; $i++)
                                        <option value="{{ $i }}" {{ $i == $currentYear ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </form>
                            <div id="spinner" class="hidden spinner"></div>
                        </div>

                        <style>
                            /* Styles pour le spinner */
                            .spinner {
                               
                                transform: translate(-50%, -50%);
                                border: 4px solid rgba(0, 0, 0, 0.1);
                                border-radius: 50%;
                                border-top: 4px solid #4000FF;
                                width: 40px;
                                height: 40px;
                                animation: spin 1s linear infinite;
                                z-index: 1000;
                            }
                    
                            @keyframes spin {
                                0% { transform: rotate(0deg); }
                                100% { transform: rotate(360deg); }
                            }
                    
                            
                        </style>

                        
                    </div>
                    <!-- Graphiques -->
                    <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2">
                        
                        <!-- Graphique Nombre de bénéficiaires -->
                        <div>
                            <span>Coût total des dentaires et auditifs (E)</span>
                            <canvas id="beneficiairesChart"></canvas>
                        </div>

                        <!-- Graphique Nombre de dentaires et auditifs -->
                        <div>
                            <span>Nombre de dentaires et auditifs (B)</span>
                            <canvas id="dentairesAuditifsChart"></canvas>
                        </div>

                        {{--  <!-- Graphique Coût total des dentaires et auditifs -->
                        <div>
                            <h3>Coût total des dentaires et auditifs (E)</h3>
                            <canvas id="prestationsCostChart"></canvas>
                        </div>  --}}
                    </div>
                    <script>
                        const months = @json($months);
                        const beneficiairesData = @json(array_values($data['Nombre de bénéficiaires (A)']));
                        const dentairesAuditifsData = @json(array_values($data['Nombre de dentaires et auditifs (B)']));
                        const prestationsCostData = @json(array_values($data['Coût total des dentaires et auditifs (E)']));
                        const avgDentairesAuditifsCostData = @json(array_values($data['Coût moyen mensuel d’une dentaire et auditif (F)']));

                        const ctx1 = document.getElementById('beneficiairesChart').getContext('2d');
                        const gradient1 = ctx1.createLinearGradient(0, 0, 0, 400);
                        gradient1.addColorStop(0, 'rgba(64, 0, 255, 1)');
                        gradient1.addColorStop(1, 'rgba(224, 192, 255, 0.2)');

                        const ctx2 = document.getElementById('dentairesAuditifsChart').getContext('2d');
                        const gradient2 = ctx2.createLinearGradient(0, 0, 0, 400);
                        gradient2.addColorStop(0, 'rgb(48, 0, 192)');
                        gradient2.addColorStop(1, 'rgb(240, 224, 255)');

                       
                        new Chart(ctx1, {
                            type: 'line',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'Nombre de dentaires et auditifs',
                                    data: avgDentairesAuditifsCostData.slice(0, 12), 
                                    backgroundColor: gradient1,
                                    borderWidth: 3,
                                    fill: true,
                                    tension: 0.4, 
                                    pointBackgroundColor: 'rgba(64, 0, 255, 1)',
                                    pointBorderColor: 'rgba(240, 224, 255, 1)',
                                    pointRadius: 2,
                                    pointHoverRadius: 7
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            color: '#4b5563' 
                                        }
                                    },
                                    x: {
                                        ticks: {
                                            color: '#4b5563'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        labels: {
                                            color: '#4b5563'
                                        }
                                    }
                                }
                            }
                        });

                        // Graphique Nombre de dentaires et auditifs
                        new Chart(ctx2, {
                            type: 'bar',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'Nombre de dentaires et auditifs',
                                    data: dentairesAuditifsData.slice(0, 12), 
                                    backgroundColor: gradient2,
                                    borderColor: 'rgb(16, 0, 64)',
                                    borderWidth: 2,
                                    borderRadius: 0, 
                                    barPercentage: 0.7, 
                                    hoverBackgroundColor: 'rgba(255, 99, 132, 0.8)'
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            color: '#4b5563'
                                        }
                                    },
                                    x: {
                                        ticks: {
                                            color: '#4b5563'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        labels: {
                                            color: '#4b5563'
                                        }
                                    }
                                }
                            }
                        });

                        {{--  // Graphique Coût total des prestations
                        const ctx3 = document.getElementById('prestationsCostChart').getContext('2d');
                        new Chart(ctx3, {
                            type: 'line',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'Coût total des dentaires et auditifs',
                                    data: prestationsCostData.slice(0, 12),  // Exclure les totaux et moyennes
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderWidth: 2,
                                    fill: true,
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });  --}}
                    </script>
                    <div>
                        <div class="flex items-end justify-end p-4 space-y-2">
                            <x-primary-button id="print-table" class="">
                                {{ __('Imprimer') }}
                            </x-primary-button>
                            
                            <x-primary-button id="export-suivi" class="ms-3">
                                {{ __('Exporter en XLSX') }}
                            </x-primary-button>
                        </div>
                    </div>
                    <div id="prestations-table" class=" !text-right"></div>
                </div>
                <div id="tab-prestations-adherents-content" class="hidden mt-2 tab-content">
                    <h1 class="pb-3 text-xl font-bold text-center underline">Liste des prestations par adhérents</h1>
                    
                    <div class="flex items-center justify-end py-4 text-sm">
                        <div class="relative mt-1">
                            <input type="text" id="searchMembres" name="searchMembres" 
                                   class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                   placeholder="Rechercher par nom ou matricule">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const searchInput = document.getElementById('searchMembres');
                            const prestationsContainer = document.getElementById('prestationsContainer');
                        
                            searchInput.addEventListener('input', function() {
                                const query = searchInput.value.toLowerCase();
                                
                                const adhérents = prestationsContainer.querySelectorAll('.mb-4');
                                
                                adhérents.forEach(adherent => {
                                    const name = adherent.querySelector('h2 span').textContent.toLowerCase();
                                    
                                    if (name.includes(query)) {
                                        adherent.style.display = '';
                                    } else {
                                        adherent.style.display = 'none';
                                    }
                                });
                            });
                        });
                        </script>
                        
                    <!-- Liste des adhérents -->
                    <div id="prestationsContainer" class="container p-4 mx-auto">
                        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

                        @foreach ($prestationsGroupedByAdherent as $adherentId => $prestations)
                            @php
                                $adherent = App\Models\Adherent::find($adherentId);
                                $totalMontant = $prestations->sum('montant');
                            @endphp

                            <div class="mb-3 border border-gray-300 rounded-lg shadow-md
                                @if($totalMontant >= 1500000) bg-red-100 border-red-500 @else bg-white @endif">
                                <h2 class="flex justify-between p-3 text-base font-semibold @if($totalMontant >= 1500000) bg-red-100 border-red-500 @else bg-gray-100  @endif cursor-pointer toggle-accordion" x-data="{ open: false }" @click="open = !open">
                                    <span class="text-gray-700">{{ $adherent->nom }} {{ $adherent->prenom }} (Code: {{ $adherent->code_carte }})</span>
                                    <span class="text-gray-700 ">Montant total: {{ number_format($totalMontant, 2) }} F CFA</span>
                                    <span class="float-right mr-4 text-gray-500 accordion-toggle">+</span>
                                </h2>
                                <div x-show="open" class="p-4 overflow-x-auto accordion-content">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID </th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nom</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Prenom</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Acte</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Date</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Centre</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Montant</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm bg-white divide-y divide-gray-200">
                                            @foreach ($prestations as $prestation)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $prestation->idPrestation }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $prestation->adherentNom }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $prestation->adherentPrenom }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $prestation->acte }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $prestation->date }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $prestation->centre }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $prestation->montant }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach

                
                    <!-- Paginate the merged collection -->
                
                        @if ($prestationsAll->isEmpty())
                        <p class="mt-4 text-red-500">Aucune prestation trouvée.</p>
                        @endif
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const toggles = document.querySelectorAll('.toggle-accordion');
                            
                            toggles.forEach(toggle => {
                                toggle.addEventListener('click', function () {
                                    const content = this.nextElementSibling;
                                    const icon = this.querySelector('.accordion-toggle');
                                    
                                    if (content.classList.contains('show')) {
                                        content.classList.remove('show');
                                        icon.textContent = '+';
                                    } else {
                                        content.classList.add('show');
                                        icon.textContent = '-';
                                    }
                                });
                            });
                        });
                    </script>
                    <script>
                        function toggleAccordion(id) {
                            const element = document.getElementById(id);
                            element.classList.toggle('hidden');
                        }
                
                        document.getElementById('searchMembres').addEventListener('keyup', function() {
                            const query = this.value.toLowerCase();
                            const adherents = document.querySelectorAll('.adherent');
                
                            adherents.forEach(function(adherent) {
                                const name = adherent.getAttribute('data-name').toLowerCase();
                                const code = adherent.getAttribute('data-code').toLowerCase();
                
                                if (name.includes(query) || code.includes(query)) {
                                    adherent.style.display = '';
                                } else {
                                    adherent.style.display = 'none';
                                }
                            });
                        });
                    </script>
                </div>
                
                <script>
                    document.getElementById('tab-recapitulatif').addEventListener('click', function() {
                        showTab('recapitulatif');
                    });
                
                    document.getElementById('tab-prestations-adherents').addEventListener('click', function() {
                        showTab('prestations-adherents');
                    });
                    
                    function showTab(tabName) {
                        var tabs = ['recapitulatif', 'prestations-adherents'];
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
                
                        setTimeout(function() {
                            if (tabName === 'recapitulatif') {
                                tableSuivi.redraw(true); 
                            } 
                        }, 10); 
                    }
                </script>
                
        
                <script>
                    function showSpinner() {
                        document.getElementById('spinner').classList.remove('hidden');
                    }
                    document.getElementById('print-table').addEventListener('click', function () {
                        const logo = new Image();
                        logo.src = logoUrl;

                        logo.onload = function () {
                            tableSuivi.print(false, true); // false = all rows, true = use HTML
                        };
                    });
                
                    const logoUrl = "{{ url('images/logo.png') }}";
                    const currentYear = @json($currentYear);
                    
            
                    const tableData = @json($tabulatorData);
            
                    const tableSuivi = new Tabulator("#prestations-table", {
                        data: tableData,
                        layout: "fitDataStretch",
                        printAsHtml : true , // activer l'impression du tableau HTML 
                        printStyled : true , 
                       
                        printHeader: `
                            <div style="text-align:center; margin-bottom:20px;">
                                <img src="${logoUrl}" alt="Logo MU-POL" style="display:inline-block; height:60px; margin-bottom:5px;">
                                <h5 style="margin:0; font-size:16px; color:#111827;">Mutuelle de la Police Nationale (MU-POL)</h5>

                                <h2 style="margin:0; font-size:20px; color:#111827; font-weight:bold;">Tableau de suivi des soins Dentaires et Auditifs</h2>
                                <p style="margin:5px 0; font-size:16px;">Année ${currentYear}</p>
                                <hr style="border:1px solid #4B5563; margin-top:10px;">
                            </div>

                        `,
                        printFooter: `
                            <div style="text-align:center; margin-top:30px;">
                                <hr style="border:1px solid #4B5563;">
                                <p style="font-size:14px;">Mutuelle de la Police Nationale | Généré le ${new Date().toLocaleDateString()}</p>
                            </div>
                         `,
                        columns: [
                            {title: "Catégorie", field: "Category", width: 250},
                            {title: "Janvier", field: "Janvier"},
                            {title: "Février", field: "Février"},
                            {title: "Mars", field: "Mars"},
                            {title: "Avril", field: "Avril"},
                            {title: "Mai", field: "Mai"},
                            {title: "Juin", field: "Juin"},
                            {title: "Juillet", field: "Juillet"},
                            {title: "Août", field: "Août"},
                            {title: "Septembre", field: "Septembre"},
                            {title: "Octobre", field: "Octobre"},
                            {title: "Novembre", field: "Novembre"},
                            {title: "Décembre", field: "Décembre"},
                            {title: "Total", field: "Total"},
                            {title: "Moyenne", field: "Moyenne"},
                            // {title: "Référence", field: "Référence"}
                        ],
                    });
                    document.getElementById('export-suivi').addEventListener('click', function() {
                        tableSuivi.download("xlsx", `Suivi_dentaire&auditif_${currentYear}.xlsx`, {});
                    });    
                </script>
                <style>
                    @media print {
                        thead, tfoot {
                            display: none !important;
                        }
                    }
                </style>


            </div>
        
        </div>
    </x-content-page-admin>
</x-app-layout>

