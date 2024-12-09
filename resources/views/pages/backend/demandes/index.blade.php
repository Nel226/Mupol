

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
        <x-header>
            {{$pageTitle}}
        </x-header>
        <div class="md:p-6 p-2 mx-auto  mt-4 bg-white rounded-lg shadow-lg ">
            
            <x-data-table id="table_demandes" :headers="['N', 'Matricule', 'Nom', 'Prénom(s)', 'Catégorie', 'Date', 'Actions']">
                @forelse ($demandes as $index => $demande)
                    <tr onclick="redirectTo('{{ route('demandes.show', ['demande' => $demande->id]) }}')" class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td>{{ $loop->iteration }}</td> 
                        <td>{{ $demande->matricule }}</td>
                        <td>{{ $demande->nom }}</td>
                        <td>{{ $demande->prenom }}</td>
                        <td>{{ $demande->categorie }}</td>
                        <td>{{ $demande->created_at }}</td>
                        <td>
                            @if ($demande->etat === 0)
                                <form action="{{ route('adherents.accept', $demande->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn">Approuver</button>
                                </form>
                            @else
                                <i class="fa fa-check-circle text-green-600"></i>
                            @endif
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </x-data-table>
            <script>
                $('#table_demandes').DataTable({
                    dom: "<'flex items-center justify-between mb-2'lf>Bt<'flex items-center justify-between mt-2'ip>",
                    buttons: ['print', 'excel', 'pdf'],
                    scrollX: true,

                });
                
            </script>
            
            
           
        </div>
    </x-content-page-admin>
    
</x-app-layout>
