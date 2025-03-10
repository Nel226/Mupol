

<x-app-layout >
    @if (session('success'))
    <x-succes-notification>
        {{ session('success') }}
    </x-succes-notification>
    
    @endif
    <x-top-navbar-admin/>

    <div id="sidebar" class="lg:block z-20 hidden  bg-blue-800  w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" class="" />
    
    </div>
   
    <x-content-page-admin>
        @section('breadcrumbs')
            <x-breadcrumb :breadcrumbItems="$breadcrumbsItems" />
        @endsection
        <x-header>
            {{$pageTitle}}
        </x-header>
        <div class="md:p-6 p-2 mx-auto  mt-4 bg-white rounded-lg shadow-lg ">
            <x-tabs :tabs="['Nouveaux adhérents', 'Anciens adhérents']">
                <div id="tab-new-demandes" class="tab-pane sm:p-4 p-1 bg-white rounded-md shadow-md">
                    <x-data-table id="table_demandes" :headers="['N', 'Matricule', 'Nom', 'Prénom(s)', 'Date']">
                        @forelse ($demandesNouveaux as $index => $demande)
                            <tr onclick="redirectTo('{{ route('demandes.show', ['demande' => $demande->id]) }}')" class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $demande->matricule }}</td>
                                <td>{{ $demande->nom }}</td>
                                <td>{{ $demande->prenom }}</td>
                                <td>{{ $demande->created_at }}</td>
                                
                            </tr>
                        @empty
                        @endforelse
                    </x-data-table>
                </div>
            
                <div id="tab-old-demandes" class="tab-pane sm:p-4 p-1 bg-white rounded-md shadow-md">
                    <x-data-table id="table-old-demandes" :headers="['N', 'Matricule', 'Nom', 'Prénom(s)', 'Date']">
                        @forelse ($demandesAnciens as $index => $demande)
                            <tr onclick="redirectTo('{{ route('demandes.show', ['demande' => $demande->id]) }}')" class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $demande->matricule }}</td>
                                <td>{{ $demande->nom }}</td>
                                <td>{{ $demande->prenom }}</td>
                                <td>{{ $demande->created_at }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </x-data-table>
                </div>
            </x-tabs>
            
            <script>
                // Initialisation des tables DataTable
                const table_demandes = $('#table_demandes').DataTable({
                    dom: "<'flex items-center justify-between mb-2'lf>Bt<'flex items-center justify-between mt-2'ip>",
                    buttons: ['print', 'excel', 'pdf'],
                    scrollX: true,
                });
            
                const table_old_demandes = $('#table-old-demandes').DataTable({
                    dom: "<'flex items-center justify-between mb-2'lf>Bt<'flex items-center justify-between mt-2'ip>",
                    buttons: ['print', 'excel', 'pdf'],
                    scrollX: true,
                });
            
                // Ajuster les colonnes au changement d'onglet
                document.querySelectorAll('.tab-pane').forEach((tabPane) => {
                    const observer = new MutationObserver(() => {
                        if (tabPane.classList.contains('active')) {
                            if (tabPane.id === 'tab-new-demandes') {
                                table_demandes.columns.adjust().draw();
                            } else if (tabPane.id === 'tab-old-demandes') {
                                table_old_demandes.columns.adjust().draw();
                            }
                        }
                    });
            
                    // Observer les changements de classe pour détecter quand un onglet devient actif
                    observer.observe(tabPane, { attributes: true, attributeFilter: ['class'] });
                });
            </script>
            
        </div>
    </x-content-page-admin>
    
</x-app-layout>
