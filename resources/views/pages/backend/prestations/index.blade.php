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
            <x-data-table id="table-prestations" :headers="['N', 'Identifiant', 'Contact', 'Date', 'Acte', 'Montant', 'Etat paiement']">
                @role('comptable')
                    @foreach($prestationValides as $prestation)
                        <tr onclick="redirectTo('{{ route('prestations.show', ['prestation' => $prestation->id]) }}')" class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $prestation->idPrestation }}</td>
                            <td>{{ $prestation->contactPrestation }}</td>
                            <td>{{ $prestation->date }}</td>
                            <td>{{ $prestation->acte }}</td>
                            <td>{{ $prestation->montant }}</td>
                            <td>
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
                @else
                    <!-- Button for creating new prestation, before the table -->
                    <div class="flex flex-wrap items-center justify-end py-2 gap-2">
                        <a href="{{ route('prestations.create') }}">
                            <button class="btn">{{ __('Nouvelle') }}</button>
                        </a>
                    </div>

                    @foreach($prestations as $prestation)
                        <tr onclick="redirectTo('{{ route('prestations.show', ['prestation' => $prestation->id]) }}')" class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $prestation->idPrestation }}</td>
                            <td>{{ $prestation->contactPrestation }}</td>
                            <td>{{ $prestation->date }}</td>
                            <td>{{ $prestation->acte }}</td>
                            <td>{{ $prestation->montant }}</td>
                            <td>
                                @if ($prestation->validite === "accepté")
                                    <span class="p-2 text-green-600 bg-green-200 border border-green-600 rounded-md shadow-sm">
                                        {{ $prestation->validite }}
                                    </span>
                                @elseif ($prestation->validite === "rejeté")
                                    <span class="p-2 text-red-600 bg-red-200 border border-red-600 rounded-md shadow-sm">
                                        {{ $prestation->validite }}
                                    </span>
                                @elseif ($prestation->validite === "en attente")
                                    <span class="p-2 text-yellow-600 bg-yellow-200 border border-yellow-600 rounded-md shadow-sm">
                                        {{ $prestation->validite }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endrole
            </x-data-table>



        </div>

        <script >
            $(document).ready(function () {
                function initializeDataTable(tableId) {
                    return $(tableId).DataTable({
                        dom: "<'flex flex-wrap items-center justify-between mb-2'lf>Bt<'flex items-center justify-between mt-2'ip>",
                        buttons: ['print', 'excel', 'pdf'],
                        scrollX: true,
                        responsive: true
                    });
                }
                const tableMutualistes = initializeDataTable('#table-prestations');

            });
        </script>

    </x-content-page-admin>
</x-app-layout>

