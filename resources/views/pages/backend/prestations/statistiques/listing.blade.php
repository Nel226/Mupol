<x-app-layout>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
    @endif

    <x-top-navbar-admin />

    <div id="sidebar" class="fixed z-20 hidden w-64 h-screen bg-blue-800 border-none rounded-none lg:block">
        <x-sidebar id="logo-sidebar" />
    </div>

    <x-content-page-admin>
        @section('breadcrumbs')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        @endsection

        <x-header>
            {{ $pageTitle }}
        </x-header>

        <div class="p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg md:p-6">



            <table id="table-prestations" class="min-w-full border text-xs border-collapse border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th></th>
                        <th>N</th>
                        <th>Identifiant</th>
                        <th>Contact</th>
                        <th>Date</th>
                        <th>Acte</th>
                        <th>Benf</th>

                        <th>Montant</th>
                        <th>État</th>
                    </tr>
                </thead>
                <tbody>
                    @role('controleur')
                        @foreach($prestations as $prestation)
                            <tr data-id="{{ $prestation->id }}" data-href="{{ route('prestations.show', $prestation->id) }}" class="cursor-pointer row-clickable hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td><input type="checkbox" class="w-4 h-4 row-checkbox form-checkbox" /></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $prestation->idPrestation }}</td>
                                <td>{{ $prestation->contactPrestation }}</td>
                                <td>{{ $prestation->date }}</td>
                                <td>{{ $prestation->acte }}</td>
                                <td>{{ $prestation->montant }}</td>
                                <td>
                                    @if ($prestation->etat_paiement === 1)
                                        <span class="flex items-center justify-center p-1 text-green-600">
                                            <i class="text-lg fa fa-check"></i>
                                        </span>
                                    @else
                                        <span class="flex items-center justify-center p-1 text-orange-600">
                                            <i class="text-lg fa fa-hourglass-half" aria-hidden="true"></i>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    @endrole
                </tbody>
            </table>



        </div>

        <script>
        $(document).ready(function () {
            $('#table-prestations').DataTable({
                dom: "<'flex flex-wrap items-center justify-between mb-2'lf>Bt<'flex items-center justify-between mt-2'ip>",
                scrollX: true,
                responsive: true,
                scrollCollapse: true,
                stripeClasses: ['bg-gray-50', 'bg-white'], // Classes CSS pour l'alternance
                columnDefs: [{ orderable: false, targets: 0 }],
                order: [[1, 'asc']]
            });

            $('#select-all').on('click', function () {
                const checked = this.checked;
                $('.row-checkbox').each(function () {
                    this.checked = checked;
                    this.dispatchEvent(new Event('change'));
                });
            });
        });
        </script>

        <script>
            $(document).ready(function () {
                function initializeDataTable(tableId) {
                    return $(tableId).DataTable({
                        dom: "<'flex flex-wrap items-center justify-between mb-2'lf>Bt<'flex items-center justify-between mt-2'ip>",
                        buttons: [
                            'print',
                            'excel',
                            'pdf'],
                        scrollX: true,
                        responsive: true
                    });
                }

                initializeDataTable('#table-prestations');


            });
        </script>

    </x-content-page-admin>
</x-app-layout>
