<div class="">
    <div class="flex items-center justify-end py-2 mb-6 space-x-2 text-sm">
        <div class="flex items-center space-x-2">
            <a href="{{ route('ayantsdroits.create') }}">
                <x-primary-button class="">
                    {{ __('Ajouter Ayant Droit') }}
                </x-primary-button>
            </a>
        </div>
        <!-- Custom search input -->
        <div class="relative mt-1">
            <input type="text" id="fSearchAyantDroit" name="fSearchAyantDroit" class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher">
            <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div>
        <ul class="flex overflow-x-auto border-b border-gray-900" id="myTabAyantDroit" role="tablist">
            @foreach($sheetsAyantsDroits as $yearMonth => $data)
                <li class="flex-none" role="presentation">
                    <button class="nav-link-ayantdroit text-sm border-gray-300 border-2 px-4 py-2 rounded-t-lg {{ $loop->first ? 'bg-[#4000FF] text-white' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }}" id="tab-{{ $yearMonth }}-ayantdroit-tab" data-bs-toggle="tab" data-bs-target="#tab-{{ $yearMonth }}-ayantdroit" type="button" role="tab" aria-controls="tab-{{ $yearMonth }}-ayantdroit" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $yearMonth }}
                    </button>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabAyantDroitContent">
            @foreach($sheetsAyantsDroits as $yearMonth => $data)
                <div class="tab-pane-ayantdroit {{ $loop->first ? 'block' : 'hidden' }}" id="tab-{{ $yearMonth }}-ayantdroit" role="tabpanel" aria-labelledby="tab-{{ $yearMonth }}-ayantdroit-tab">
                    
                    <div id="tabulator-{{ $yearMonth }}-ayantdroit" class="w-full p-2 overflow-x-auto bg-white rounded-b-lg shadow-lg">
                        <!-- Tabulator table for Ayants Droit will be initialized here -->
                    </div>
                    <div class="flex justify-end mt-2 space-x-2">
                        <x-primary-button class="export-btn-ayantdroit" data-year-month="{{ $yearMonth }}">
                            {{ __('Exporter en XLSX') }}
                        </x-primary-button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabulatorsAyantsDroits = {};
        const baseUrl = @json(route('ayantsdroits.edit', ['ayantsdroit' => ':id'])); // URL de base
        
        @foreach($sheetsAyantsDroits as $yearMonth => $data)
            tabulatorsAyantsDroits["{{ $yearMonth }}"] = new Tabulator("#tabulator-{{ $yearMonth }}-ayantdroit", {
                data: @json($data),
                layout: "fitDataStretch",
                movableColumns: false,
                placeholder: "Aucune donnée",
                pagination: "local",
                paginationSize: 20,
                paginationSizeSelector: [20, 30, 40, 50],
                printAsHtml: true,
                columns: [
                    { 
                        title: "N° Ordre", 
                        field: "numero_ordre", 
                        formatter: "rownum",  
                        hozAlign: "center", 
                        headerSort: false 
                    },
                    @foreach($headerAyantDroit as $column)
                        { title: "{{ ucfirst($column) }}", field: "{{ $column }}" },
                    @endforeach
                    {
                        title: "Actions", 
                        
                        formatter: function(cell, formatterParams, onRendered) {
                                const rowData = cell.getData();
                                
                                const editUrl = baseUrl.replace(':id', rowData.id); 

                                return `
                                    <a href="${editUrl}" class='border border-indigo-500 shadow-lg rounded-lg text-bold text-white p-1  bg-indigo-500 btn btn-primary'>Modifier</a>
                                    <button class='border border-red-500 rounded-lg bg-red-800 shadow-lg btn btn-danger text-bold text-white p-1' data-id="${rowData.id}">Supprimer</button>
                                    `;
                        },
                        hozAlign: "center",
                        minWidth: 200,
                        cellClick: function(e, cell) {
                            const target = e.target;
    
                            if (target.classList.contains('btn-danger')) {
                                showModal(target.getAttribute('data-id'));
                            }
                        },
                        download: false 
                    }
                ],
            });
        @endforeach
    
        function showModal(id) {
            const modal = document.getElementById('confirmationModal');
            modal.classList.remove('hidden');
        
            document.getElementById('modalMessage').innerText = `Êtes-vous sûr de vouloir supprimer l'élément avec l'ID: ${id} ?`;
        
            const baseUrl = @json(route('ayantsdroits.destroy', ['ayantsdroit' => ':id']));
            const deleteUrl = baseUrl.replace(':id', id);
        
            // suppression
            document.getElementById('confirmDeleteBtn').onclick = function() {
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Token CSRF
                    }
                })
                .then(response => {
                    if (response.ok) {
                        console.log('Suppression confirmée pour l\'ID:', id);
                        alert('Mutualiste supprimé avec succès.');

                        modal.classList.add('hidden');
        
                        location.reload(); 
                    } else {
                        return response.json().then(data => {
                            console.error('Erreur lors de la suppression:', data.message);
                        });
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la requête de suppression:', error);
                });
            };
        
            document.getElementById('cancelDeleteBtn').onclick = function() {
                modal.classList.add('hidden');
            };
        }
        
        const tabsAyantDroit = document.querySelectorAll('.nav-link-ayantdroit');
        tabsAyantDroit.forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.tab-pane-ayantdroit').forEach(pane => pane.classList.add('hidden'));
                
                tabsAyantDroit.forEach(link => {
                    link.classList.remove('bg-[#4000FF]', 'text-white');
                    link.classList.add('bg-gray-200', 'text-gray-600');
                });
    
                const targetPane = document.querySelector(this.getAttribute('data-bs-target'));
                targetPane.classList.remove('hidden');
    
                this.classList.remove('bg-gray-200', 'text-gray-600');
                this.classList.add('bg-[#4000FF]', 'text-white');
            });
        });
    
        // recherche
        document.getElementById('fSearchAyantDroit').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            Object.values(tabulatorsAyantsDroits).forEach(tabulator => {
                tabulator.setFilter(function(data) {
                    return Object.values(data).some(value => 
                        String(value).toLowerCase().includes(searchValue)
                    );
                });
            });
        });
    
        // exportation
        document.querySelectorAll('.export-btn-ayantdroit').forEach(button => {
            button.addEventListener('click', function() {
                const yearMonth = this.getAttribute('data-year-month');
                const tabulator = tabulatorsAyantsDroits[yearMonth];
                tabulator.download("xlsx", `ayantsdroits_${yearMonth}.xlsx`);
            });
        });
    });
</script>

<form action="{{route('ayantdroits.import')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="flex items-center justify-end my-4 space-x-2">
        <input type="file" name="excel-file-ayant-droit"  class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-green-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept=".csv, .xlsx" />
        <x-primary-button type="submit" class="ms-3">
            {{ __('Importer Excel') }}
        </x-primary-button>
    </div>
</form>