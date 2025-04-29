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
        @section('breadcrumbs')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        @endsection
        <x-header>
            {{ $pageTitle }}
        </x-header>

        <div class="md:p-6 p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg">
            @role('agentsaisie|controleur')
                <x-tabs :tabs="['Tous', 'Hôpitaux', 'Cliniques', 'Pharmacies']">
                    <!-- Tous Tab -->
                    <div id="tab-tous" class="tab-pane  sm:p-4 p-1 bg-white rounded-md shadow-md">
                        <div class="flex flex-wrap items-center justify-start py-2 gap-2">
                            <a href="{{ route('partenaires.create') }}">
                                <button class="btn">{{ __('Nouveau partenaire') }}</button>
                            </a>
                        </div>

                        <x-data-table id="table-tous" :headers="['N', 'Nom', 'Type', 'Adresse', 'Téléphone', 'Email', 'Région', 'Province', 'Date affiliation' ]">
                            @foreach ($partenaires as $index => $partenaire)
                                <tr onclick="redirectTo('{{ route('partenaires.show', $partenaire->id) }}')" class=" hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $partenaire->nom }}</td>
                                    <td>{{ $partenaire->type }}</td>
                                    <td>{{ $partenaire->adresse }}</td>
                                    <td>{{ $partenaire->telephone }}</td>
                                    <td>{{ $partenaire->email }}</td>
                                    <td>{{ $partenaire->region }}</td>
                                    <td>{{ $partenaire->province }}</td>
                                    <td>{{ $partenaire->created_at }}</td>
                                </tr>
                            @endforeach
                        </x-data-table>

                        <div class="md:p-6 p-2 mx-auto mt-6 bg-slate-300 border-blue-400 border-2 rounded-lg shadow-lg">
                            <h2 class="text-lg font-semibold mb-4">Envoyer un message</h2>
                            <form action="{{ route('partenaires.envoyerMessage') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                                    <textarea id="message" name="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                <button type="submit" class="btn">
                                    Envoyer message
                                </button>
                            </form>
                        </div>

                    </div>

                    <!-- Hôpitaux Tab -->
                    <div id="tab-hopitaux" class="tab-pane  sm:p-4 p-1">

                        <x-data-table id="table-hopitaux" :headers="['N', 'Nom', 'Adresse', 'Téléphone', 'Email', 'Région', 'Province', 'Date affiliation' ]">
                            @foreach ($hopitaux as $index => $hopital)
                                <tr onclick="redirectTo('{{ route('partenaires.show', $hopital->id) }}')" class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hopital->nom }}</td>
                                    <td>{{ $hopital->adresse }}</td>
                                    <td>{{ $hopital->telephone }}</td>
                                    <td>{{ $hopital->email }}</td>
                                    <td>{{ $hopital->region }}</td>
                                    <td>{{ $hopital->province }}</td>
                                    <td>{{ $hopital->created_at }}</td>
                                </tr>
                            @endforeach
                        </x-data-table>

                    </div>

                    <!-- Cliniques Tab -->
                    <div id="tab-cliniques" class="tab-pane overflow-x-auto sm:p-4 p-1">

                        <x-data-table id="table-cliniques" :headers="['N', 'Nom', 'Adresse', 'Téléphone', 'Email', 'Région', 'Province', 'Date affiliation' ]">
                            @foreach ($cliniques as $index => $clinique)
                                <tr onclick="redirectTo('{{ route('partenaires.show', $clinique->id) }}')" class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $clinique->nom }}</td>
                                    <td>{{ $clinique->adresse }}</td>
                                    <td>{{ $clinique->telephone }}</td>
                                    <td>{{ $clinique->email }}</td>
                                    <td>{{ $clinique->region }}</td>
                                    <td>{{ $clinique->province }}</td>
                                    <td>{{ $clinique->created_at }}</td>
                                </tr>
                            @endforeach
                        </x-data-table>


                    </div>
                    <!-- Pharmacies Tab -->
                    <div id="tab-pharmacies" class="tab-pane overflow-x-auto sm:p-4 p-1">

                        <x-data-table id="table-pharmacies" :headers="['N', 'Nom', 'Adresse', 'Téléphone', 'Email', 'Région', 'Province', 'Date affiliation' ]">
                            @foreach ($pharmacies as $index => $pharmacie)
                                <tr onclick="redirectTo('{{ route('partenaires.show', $pharmacie->id) }}')" class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pharmacie->nom }}</td>
                                    <td>{{ $pharmacie->adresse }}</td>
                                    <td>{{ $pharmacie->telephone }}</td>
                                    <td>{{ $pharmacie->email }}</td>
                                    <td>{{ $pharmacie->region }}</td>
                                    <td>{{ $pharmacie->province }}</td>
                                    <td>{{ $pharmacie->created_at }}</td>
                                </tr>
                            @endforeach
                        </x-data-table>
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
                const tableTous = initializeDataTable('#table-tous');
                const tableHopitaux = initializeDataTable('#table-hopitaux');
                const tableCliniques = initializeDataTable('#table-cliniques');
                const tablePharmaciest = initializeDataTable('#table-pharmacies');

            });
        </script>

    </x-content-page-admin>
</x-app-layout>

