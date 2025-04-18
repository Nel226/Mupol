<x-app-layout>
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
    @endif

    <x-top-navbar-admin />

    <div id="sidebar" class="hidden lg:block bg-blue-800 w-64 h-screen fixed z-20 border-none rounded-none">
        <x-sidebar id="logo-sidebar" />
    </div>

    <x-content-page-admin>
        @section('breadcrumbs')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        @endsection

        <x-header>
            {{ $pageTitle }}
        </x-header>

        <div class="p-2 md:p-6 mt-4 mx-auto bg-white rounded-lg shadow-lg">
            <x-data-table id="table-prestations" :headers="['N', 'Identifiant', 'Contact', 'Date', 'Acte', 'Montant', 'Etat']">
                @role('comptable')
                    @foreach($prestationValides as $prestation)
                        <tr data-id="{{ $prestation->id }}" data-href="{{ route('prestations.show', $prestation->id) }}" class="row-clickable cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td><input type="checkbox" class="row-checkbox form-checkbox w-4 h-4" /></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $prestation->idPrestation }}</td>
                            <td>{{ $prestation->contactPrestation }}</td>
                            <td>{{ $prestation->date }}</td>
                            <td>{{ $prestation->acte }}</td>
                            <td>{{ $prestation->montant }}</td>
                            <td>
                                @if ($prestation->etat_paiement === 1)
                                    <span class="flex items-center justify-center p-1 text-green-600">
                                        <i class="fa fa-check text-lg"></i>
                                    </span>
                                @else
                                    <span class="flex items-center justify-center p-1 text-orange-600">
                                        <i class="fa fa-hourglass-half text-lg" aria-hidden="true"></i>
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <div class="flex flex-wrap items-center justify-end gap-2 py-2">
                        <div id="validation-bar" class="hidden">
                            <button id="btn-valider-selections" class="btn bg-green-600 hover:bg-green-700 transition">
                                Valider les prestations sélectionnées
                            </button>
                            <form id="form-valider-selections" method="POST" action="{{ route('prestations.validerMultiple') }}">
                                @csrf
                                <div id="selected-ids-input"></div>
                            </form>
                        </div>
                        <a href="{{ route('prestations.create') }}">
                            <button class="btn">{{ __('Nouvelle') }}</button>
                        </a>
                    </div>

                    @foreach($prestations as $prestation)
                        <tr data-id="{{ $prestation->id }}" data-href="{{ route('prestations.show', $prestation->id) }}" class="row-clickable cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td><input type="checkbox" class="row-checkbox form-checkbox w-4 h-4" /></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $prestation->idPrestation }}</td>
                            <td>{{ $prestation->contactPrestation }}</td>
                            <td>{{ $prestation->date }}</td>
                            <td>{{ $prestation->acte }}</td>
                            <td>{{ $prestation->montant }}</td>
                            <td>
                                @php $validite = $prestation->validite; @endphp
                                @if ($validite === 'accepté')
                                    <span class="p-1 text-green-600 bg-green-200 border border-green-600 rounded-md shadow-sm">{{ $validite }}</span>
                                @elseif ($validite === 'rejeté')
                                    <span class="p-1 text-red-600 bg-red-200 border border-red-600 rounded-md shadow-sm">{{ $validite }}</span>
                                @elseif ($validite === 'en attente')
                                    <span class="p-1 text-yellow-600 bg-yellow-200 border border-yellow-600 rounded-md shadow-sm">{{ $validite }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endrole
            </x-data-table>
        </div>

        {{-- Scripts --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const checkboxes = document.querySelectorAll('.row-checkbox');
                const validationBar = document.getElementById('validation-bar');

                // Toggle visibility of validation bar based on checkbox selection
                function updateValidationBarVisibility() {
                    const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                    validationBar.classList.toggle('hidden', !anyChecked);
                }

                checkboxes.forEach(cb => {
                    cb.addEventListener('change', updateValidationBarVisibility);
                });

                const validateBtn = document.getElementById('btn-valider-selections');
                if (validateBtn) {
                    validateBtn.addEventListener('click', () => {
                        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked'))
                            .map(cb => cb.closest('tr').dataset.id);

                        if (selectedIds.length === 0) {
                            alert('Veuillez sélectionner au moins une prestation.');
                            return;
                        }

                        const container = document.getElementById('selected-ids-input');
                        container.innerHTML = '';
                        selectedIds.forEach(id => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'ids[]';
                            input.value = id;
                            container.appendChild(input);
                        });

                        document.getElementById('form-valider-selections').submit();
                    });
                }

                // Redirection sur clic ligne
                document.querySelectorAll('.row-clickable').forEach(row => {
                    row.addEventListener('click', function (e) {
                        const tag = e.target.tagName.toLowerCase();
                        const interactiveTags = ['input', 'button', 'select', 'label', 'textarea', 'svg', 'path', 'a'];

                        if (interactiveTags.includes(tag) || e.target.closest('button') || e.target.closest('select')) return;

                        const url = this.dataset.href;
                        if (url) window.location.href = url;
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                function initializeDataTable(tableId) {
                    return $(tableId).DataTable({
                        dom: "<'flex flex-wrap items-center justify-between mb-2'lf>Bt<'flex items-center justify-between mt-2'ip>",
                        buttons: ['print', 'excel', 'pdf'],
                        scrollX: true,
                        responsive: true,
                        scrollCollapse: true,
                        columnDefs: [{ orderable: false, targets: 0 }],
                        order: [[1, 'asc']],
                    });
                }

                initializeDataTable('#table-prestations');

                $('#select-all').on('click', function () {
                    const checked = this.checked;
                    $('.row-checkbox').each(function () {
                        this.checked = checked;
                        this.dispatchEvent(new Event('change'));
                    });
                });
            });
        </script>
    </x-content-page-admin>
</x-app-layout>
