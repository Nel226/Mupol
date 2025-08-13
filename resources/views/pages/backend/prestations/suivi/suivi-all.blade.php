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

                <div class="flex items-center justify-end py-4 text-sm">
                    <div class="relative mt-1">
                        <input type="text" id="searchMembres" name="searchMembres"
                               class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                               placeholder="Rechercher par nom ou matricule">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Liste des adhérents -->
                <div id="prestationsContainer" class="container p-4 mx-auto">
                    <div id="results-container">
                        @foreach ($paginatedPrestations as $adherentId => $prestations)

                            @php
                                $adherent = App\Models\Adherent::find($adherentId);
                                $totalMontant = $prestations->sum('montant');
                            @endphp


                            <div class="mb-3 border border-gray-300 rounded-lg shadow-md

                                @if($totalMontant >= 1500000) bg-red-100 border-red-500 @else bg-white @endif adherent"
                                data-name="{{ strtolower($adherent->nom . ' ' . $adherent->prenom) }}"
                                data-code="{{ strtolower($adherent->code_carte) }}"
                                x-data="{ open: false }">

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

                        @endforeach
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

                    @if ($paginatedPrestations->isEmpty())
                        <p class="mt-4 text-red-500">Aucune prestation trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </x-content-page-admin>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchMembres');
            const yearSelect = document.getElementById('year');

            // Recherche en temps réel
            searchInput.addEventListener('input', function () {
                const query = this.value.toLowerCase().trim();
                const year = yearSelect.value;

                const url = new URL("{{ route('suivi-all') }}", window.location.origin);
                url.searchParams.set('search', query);
                url.searchParams.set('year', year);

                window.history.pushState({}, '', url);

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newResults = doc.querySelector('#results-container').innerHTML;
                    const newPagination = doc.querySelector('#pagination-links').innerHTML;

                    document.querySelector('#results-container').innerHTML = newResults;
                    document.querySelector('#pagination-links').innerHTML = newPagination;
                });
            });

            // Pagination AJAX
            document.addEventListener('click', function (e) {
                const link = e.target.closest('#pagination-links a');
                if (link) {
                    e.preventDefault();
                    const url = link.getAttribute('href');

                    fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newResults = doc.querySelector('#results-container').innerHTML;
                        const newPagination = doc.querySelector('#pagination-links').innerHTML;

                        document.querySelector('#results-container').innerHTML = newResults;
                        document.querySelector('#pagination-links').innerHTML = newPagination;
                        window.history.pushState({}, '', url);
                    });
                }
            });
        });
    </script>
</x-app-layout>
