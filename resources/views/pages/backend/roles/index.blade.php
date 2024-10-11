<x-app-layout>
    <x-sidebar />
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
    
    <div class="p-4 border-2 border-gray-200 rounded-lg sm:ml-64 dark:border-gray-700 mt-14">
        <div class="px-4 py-8 mx-auto lg:py-16">
            <div class="flex items-center px-4 py-2 text-gray-500 bg-[#fffe4a70] rounded-t-lg shadow-lg">
                <h1 class="flex-1 text-2xl font-bold">Rôles</h1>
            </div>
            <div class="container mt-4 mx-auto ">
                <div class="flex py-3 justify-between items-center">
                    
                    <h2 class="text-xl font-semibold mb-4">Liste des rôles</h2>
                    <a href="{{ route('roles.create') }}">
                        <x-primary-button class="mt-2">
                            {{ __('Créer un rôle') }}
                        </x-primary-button>
                    </a>
                </div>
                <div class="relative overflow-x-auto mt-4 shadow-md sm:rounded-lg">
                    <table class="table-auto w-full rounded-md">
                        <thead class="rounded-md">
                            <tr class="bg-gray-300">
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Nom</th>
                                <th class="px-4 py-2">Guard</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td class="border px-4 py-2">{{ $role->id }}</td>
                                <td class="border px-4 py-2">{{ $role->name }}</td>
                                <td class="border px-4 py-2">{{ $role->guard_name }}</td>
                                <td class="border px-4 py-2 text-right">
                                    <x-primary-button class="mt-2 bg-blue-700">
                                        <a href="{{ route('roles.edit', $role->id) }}" class="">
                                            <i class="fa fa-pencil"></i>
                                            Modifier
                                        </a>
                                    </x-primary-button>
                
                                    <x-primary-button data-modal-id="confirmation-modal-{{ $role->id }}" class="mt-2 bg-red-700">
                                        <i class="fa fa-trash"></i>
                                        Supprimer
                                    </x-primary-button>
                
                                    <!-- Modal de confirmation -->
                                    <div id="confirmation-modal-{{ $role->id }}" class="fixed inset-0 flex items-center hidden justify-center bg-black bg-opacity-60">
                                        <div class="bg-white text-sm rounded-md shadow-md p-6 relative w-[90%] sm:w-[460px]">
                                            <div class="p-3 text-center">
                                                <i class="fa fa-regular fa-times-circle text-red-500 mx-auto" style="font-size:48px;"></i>
                                                <div class="mt-5 text-2xl">Etes-vous sûr?</div>
                                                <div class="mt-2 text-slate-500">
                                                    Voulez-vous vraiment supprimer le rôle 
                                                    <strong>
                                                        "{{ $role->name }}" ? <br />
                                                    </strong>
                                                    Cette action est irréversible.
                                                </div>
                                            </div>
                                            <div class="flex items-center mx-auto justify-center px-5 pb-8 text-center">
                                                <div>
                                                    <button class="close-modal transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 dark:focus:ring-slate-700 dark:focus:ring-opacity-50 border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 mr-1 w-24">
                                                        Annuler
                                                    </button>
                                                </div>
                                                <div>
                                                    <!-- Formulaire de confirmation de suppression -->
                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-600 text-white p-2 rounded">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <button class="close-modal-icon absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Fonction pour ouvrir le modal
                        document.querySelectorAll('[data-modal-id]').forEach(function (button) {
                            button.addEventListener('click', function (event) {
                                event.preventDefault(); // Empêche le comportement par défaut du bouton
                                var modalId = button.getAttribute('data-modal-id');
                                document.getElementById(modalId).classList.remove('hidden');
                            });
                        });
                    
                        // Fonction pour fermer le modal
                        document.querySelectorAll('.close-modal').forEach(function (button) {
                            button.addEventListener('click', function () {
                                button.closest('.fixed').classList.add('hidden');
                            });
                        });
                    
                        document.querySelectorAll('.close-modal-icon').forEach(function (button) {
                            button.addEventListener('click', function () {
                                button.closest('.fixed').classList.add('hidden');
                            });
                        });
                    
                        // Optionnel : Fermer le modal lorsqu'on clique en dehors de la boîte
                        window.addEventListener('click', function (event) {
                            if (event.target.classList.contains('fixed')) {
                                event.target.classList.add('hidden');
                            }
                        });
                    });
                    
                </script>                
                
            </div>
            
        </div>
    </div>
    
</x-app-layout>