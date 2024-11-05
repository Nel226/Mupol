<x-guest-layout>
    <x-header-guest/>

    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification-content');
                const closeBtn = document.getElementById('close-notification');
                
                notification.classList.remove('hidden');
                
                closeBtn.addEventListener('click', () => {
                    notification.classList.add('hidden');
                });
            });
        </script>
    @endif
    <x-sidebar-guest/>

    <div class="min-h-screen ml-64 bg-gray-50 dark:bg-gray-900 py-3">
        <section class="container mx-auto ">
            <div class=" flex my-2 justify-end">
                <x-primary-button >
                    <a href=" {{route('adherents.nouveau-ayantdroit')}} ">

                        Nouveau ayant droit
                    </a>
                </x-primary-button>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6  mx-auto">
                <div class="mb-6 text-center">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Liste des ayants droits</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                        <thead>
                            <tr class="text-left text-gray-600 dark:text-gray-400 uppercase text-sm leading-normal bg-gray-100 dark:bg-gray-700">
                                {{--  <th class="py-3 px-6">Photo</th>  --}}
                                <th class="py-3 px-6">Nom</th>
                                <th class="py-3 px-6">Prénom</th>

                                <th class="py-3 px-6">Lien de parenté</th>
                                <th class="py-3 px-6">Actions</th>



                               
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-300 text-sm font-light">
                            @foreach ($ayantsDroits as $ayantDroit)
                                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    {{--  <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center">
                                            @if (isset($ayantDroit['photo_path']))
                                                <button class="open-modal-button text-blue-500 hover:text-blue-700" 
                                                        data-url="{{ asset('storage/' . $ayantDroit['photo_path']) }}" type="button">
                                                        <img class="w-10 h-10 rounded-full cursor-pointer" src="{{ asset('storage/' . $ayantDroit['photo_path']) }}" 
                                                            alt="Photo de {{ $ayantDroit['nom'] }}" 
                                                            onclick="openModal('{{ asset('storage/' . $ayantDroit['photo_path']) }}')" />
                                                </button>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </div>
                                    </td>  --}}
                                   
                                    <td class="py-3 px-6">{{ $ayantDroit->nom }}</td>
                                    <td class="py-3 px-6">{{ $ayantDroit->prenom }}</td>

                                    <td class="py-3 px-6">{{ $ayantDroit->relation }}</td>
                                    <th class="py-3 px-2 flex">
                                        <x-primary-button class=" ">
                                            Modifier
                                        </x-primary-button>
                                        <form action="{{ route('adherents.delete-ayantdroit', $ayantDroit->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet ayant droit ?');">
                                            @csrf
                                            @method('DELETE')  <!-- This is correct and will indicate to Laravel that you want to treat this as a DELETE request -->
                                            
                                            <x-primary-button type='submit' class="bg-red-600">
                                                Supprimer
                                            </x-primary-button>
                                        </form>
                                        
                                    </th>

                                    
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('adherents.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 underline">Retour au tableau de bord</a>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
