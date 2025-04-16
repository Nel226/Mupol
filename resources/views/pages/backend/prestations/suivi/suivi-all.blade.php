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
        @endsection
    --}}
        <x-header>
            {{ $pageTitle }}
        </x-header>

        <div class="md:p-6 p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg">
            <div class="">

                <div class="flex items-center justify-between py-4 text-sm">
                    <div class="flex gap-3 ">

                        <form method="GET" action="{{ route('suivi-all') }}" >
                            <label for="year">Sélectionner l&apos;année :</label>
                            <select name="year" id="year" onchange="this.form.submit()" class="py-1 rounded-md">
                                @for ($i = 2020; $i <= 2030; $i++)
                                    <option value="{{ $i }}" {{ $i == $currentYear ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </form>
                    </div>
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
                                    <span class="text-gray-700 w-128">{{ $adherent->nom }} {{ $adherent->prenom }} (Code: {{ $adherent->code_carte }})</span>
                                    <div class=" flex justify-end">
                                        <span class="text-gray-700 mr-4 ">Montant total: {{ number_format($totalMontant, 2) }} F CFA</span>
                                        <span class="float-right mr-4 text-gray-500 accordion-toggle">+</span>
                                    </div>

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

            </div>


        </div>
    </x-content-page-admin>
</x-app-layout>

