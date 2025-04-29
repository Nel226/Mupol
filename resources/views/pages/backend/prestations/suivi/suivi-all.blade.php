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
            <div>
                <div class="flex items-center justify-between py-4 text-sm">
                    <div class="flex gap-3">
                        <form method="GET" action="{{ route('suivi-all') }}">
                            <label for="year">Sélectionner l'année :</label>
                            <select name="year" id="year" onchange="this.form.submit()" class="py-1 rounded-md">
                                @for ($i = 2020; $i <= 2030; $i++)
                                    <option value="{{ $i }}" {{ $i == $currentYear ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Filtre par centre -->
                <div class="flex items-center justify-between py-4 text-sm">
                    <div class="flex gap-3">
                        <label for="centre">Centre de santé :</label>
                        <select id="centre" name="centre" class="py-1 rounded-md">
                            <option value="">Tous</option>
                            @foreach ($centresDisponibles as $c)
                                <option value="{{ $c }}" {{ request('centre') == $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <!-- Spinner -->
                <div id="loading-spinner" class="flex justify-center my-4 hidden">
                    <svg class="w-6 h-6 text-blue-500 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </div>





                <!-- Résultats -->
                <div id="prestationsContainer" class="container p-4 mx-auto">
                    <!-- Zone de recherche -->
                    <div class="flex items-center justify-end py-4 text-sm">
                        <div class="relative mt-1">
                            <input type="text" id="searchMembres" name="searchMembres"
                                class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Rechercher par nom ou matricule">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques du centre -->
                    @if ($centre && $nombreAdherentsCentre !== null && $nombrePrestationsCentre !== null)
                    <div id="centre-stats" class="p-4 mb-4 text-sm text-blue-800 bg-blue-100 border border-blue-300 rounded-lg" role="alert">
                        <div class="flex flex-col md:flex-row justify-between gap-3">
                            <span><strong>Centre sélectionné :</strong> {{ $centre }}</span>
                            <span><strong>Nombre d'adhérents ayant des prestations :</strong> {{ $nombreAdherentsCentre }}</span>
                            <span><strong>Nombre total de prestations :</strong> {{ $nombrePrestationsCentre }}</span>
                        </div>
                    </div>
                    @else
                        <div id="centre-stats"></div>
                    @endif

                    <!-- Affichage des résultats -->
                    <div id="results-container">
                        @foreach ($paginatedPrestations as $adherentId => $prestations)
                
                            @php
                                $adherent = $adherents[$adherentId] ?? null;
                                $totalMontant = $prestations->sum('montant');
                            @endphp
                            
                               
                            <div class="mb-3 border border-gray-300 rounded-lg shadow-md
                            
                                @if($totalMontant >= 1500000) bg-red-100 border-red-500 @else bg-white @endif adherent"
                                data-name="{{ strtolower($adherent->nom . ' ' . $adherent->prenom) }}"
                                data-code="{{ strtolower($adherent->code_carte) }}" x-data="{ open: false }">

                                <h2 class="flex justify-between p-3 text-base font-semibold cursor-pointer
                                    @if($totalMontant >= 1500000) bg-red-100 border-red-500 @else bg-gray-100 @endif"
                                    @click="open = !open">

                                    <span class="text-gray-700 w-128">{{ $adherent->nom }} {{ $adherent->prenom }} (Code: {{ $adherent->code_carte }})</span>

                                    <div class="flex justify-end">
                                        <span class="text-gray-700 mr-4">Montant total: {{ number_format($totalMontant, 2) }} F CFA</span>
                                        <span class="float-right mr-4 text-gray-500" x-text="open ? '-' : '+'"></span>
                                    </div>
                                </h2>

                                <div x-show="open" x-transition class="p-4 overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
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
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($prestation->montant, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        @endforeach

                        <div id="no-results-message">
                            @if ($paginatedPrestations->isEmpty())
                                <p class="mt-4 text-red-500">Aucune prestation trouvée.</p>
                            @endif
                        </div>
                    </div>

                    <div id="pagination-links">
                        {{ $paginatedPrestations->appends(['search' => request('search'), 'year' => request('year')])->links() }}
                    </div>

                    <style>
                        #pagination-links a {
                            color: #007bff;
                            cursor: pointer;
                            text-decoration: none;
                            padding: 5px 10px;
                        }

                        #pagination-links a:hover {
                            background-color: #f1f1f1;
                            border-radius: 4px;
                        }
                    </style>
                </div>
            </div>
        </div>
    </x-content-page-admin>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchMembres');
            const yearSelect = document.getElementById('year');
            const centreSelect = document.getElementById('centre');
            const spinner = document.getElementById('loading-spinner');

            function fetchFilteredData() {
                const query = searchInput.value.toLowerCase().trim();
                const year = yearSelect.value;
                const centre = centreSelect.value;

                const url = new URL("{{ route('suivi-all') }}", window.location.origin);
                url.searchParams.set('search', query);
                url.searchParams.set('year', year);
                url.searchParams.set('centre', centre); // toujours envoyer le centre même vide

                window.history.pushState({}, '', url);

                spinner.classList.remove('hidden');

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    document.querySelector('#results-container').innerHTML = doc.querySelector('#results-container').innerHTML;
                    document.querySelector('#pagination-links').innerHTML = doc.querySelector('#pagination-links').innerHTML;
                    document.querySelector('#no-results-message').innerHTML = doc.querySelector('#no-results-message').innerHTML;
                    const stats = doc.querySelector('#centre-stats');
                    if (stats) {
                        document.querySelector('#centre-stats')?.replaceWith(stats);
                    } else {
                        document.querySelector('#centre-stats')?.replaceWith(document.createElement('div'));
                    }
                })
                .finally(() => {
                    spinner.classList.add('hidden');
                });
            }

            searchInput.addEventListener('input', fetchFilteredData);
            centreSelect.addEventListener('change', fetchFilteredData);

            document.addEventListener('click', function (e) {
                const link = e.target.closest('#pagination-links a');
                if (link) {
                    e.preventDefault();
                    const url = new URL(link.getAttribute('href'));
                    url.searchParams.set('search', searchInput.value.trim());
                    url.searchParams.set('year', yearSelect.value);
                    url.searchParams.set('centre', centreSelect.value);

                    spinner.classList.remove('hidden');

                    fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        document.querySelector('#results-container').innerHTML = doc.querySelector('#results-container').innerHTML;
                        document.querySelector('#pagination-links').innerHTML = doc.querySelector('#pagination-links').innerHTML;
                        document.querySelector('#no-results-message').innerHTML = doc.querySelector('#no-results-message').innerHTML;
                        const stats = doc.querySelector('#centre-stats');
                        if (stats) {
                            document.querySelector('#centre-stats')?.replaceWith(stats);
                        } else {
                            document.querySelector('#centre-stats')?.replaceWith(document.createElement('div'));
                        }
                    })
                    .finally(() => {
                        spinner.classList.add('hidden');
                    });
                }
            });
        });
    </script>

</x-app-layout>
