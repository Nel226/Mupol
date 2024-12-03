
<x-app-layout >
    <x-top-navbar-admin/>

    <div id="sidebar" class="lg:block z-20 hidden  bg-blue-800  w-64 h-screen fixed rounded-none border-none">
        <x-sidebar id="logo-sidebar" class="" />
    
    </div>
   
    <x-content-page-admin>

        <div class= "flex flex-col items-center justify-center min-h-screen text-sm">

            <div class=" p-0 sm:p-4 w-full border-0 sm:border-2 border-gray-200 rounded-lg dark:border-gray-700">
                <div class="px-0 py-2 sm:px-4 sm:py-8 mx-auto lg:py-16">
                    <div class="flex items-center px-2 sm:px-4 py-2 text-gray-500 bg-[#fffe4a70] rounded-t-lg shadow-lg">
                        <h1 class="flex-1 text-xl sm:text-2xl font-bold">Utilisateurs</h1>
                    </div>
                    <div class=" w-full px-0 sm:px-15 mt-1 sm:mt-4 mx-auto">
                        <div class="flex py-3 justify-between items-center">
                            <h2 class=" text-sm sm:text-xl font-semibold">Liste des utilisateurs</h2>
                            <a href="{{ route('users.create') }}">
                                <x-primary-button class="">
                                    {{ __('Créer un utilisateur') }}
                                </x-primary-button>
                            </a>
                        </div>
                        <div class="relative overflow-x-auto mt-4 shadow-md rounded-lg">
                            <table class="table-auto w-full rounded-md">
                                <thead class="rounded-md">
                                    <tr class="bg-gray-300">
                                        <th class="px-4 py-2">ID</th>
                                        <th class="px-4 py-2">Nom</th>
                                        <th class="px-4 py-2">Email</th>
                                        <th class="px-4 py-2">Mot de passe</th>
                                        <th class="px-4 py-2">Rôles</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $user->id }}</td>
                                        <td class="border px-4 py-2">{{ $user->name }}</td>
                                        <td class="border px-4 py-2">{{ $user->email }}</td>
                                        <td class="border px-4 py-2">
                                            <span class="password-display">*****</span>
                                            <button class="toggle-password ml-2 text-blue-600">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            {{--  <span class="actual-password hidden">{{ $user->password_plain_text ?? 'password123' }}</span> <!-- Remplacez par le mot de passe en clair -->  --}}
                                        </td>
                                        <td class="border px-4 py-2">
                                            @foreach($user->roles as $role)
                                                {{ $role->name }}@if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td class="border px-4 py-2 flex gap-3 items-center text-right">
                                            <x-primary-button class="mt-2 bg-blue-700 flex items-center space-x-2">
                                                <a href="{{ route('users.edit', $user->id) }}" class="flex items-center text-white">
                                                    <i class="fa fa-pencil"></i>
                                                    <span class="ml-2">Modifier</span>
                                                </a>
                                            </x-primary-button>
                                            
                                            <!-- Bouton pour ouvrir le modal -->
                                            <x-primary-button data-modal-id="confirmation-modal-{{ $user->id }}" class="mt-2 bg-red-700">
                                                <i class="fa fa-trash"></i>
                                                Supprimer
                                            </x-primary-button>
                                            
                                            <!-- Modal de confirmation -->
                                            <div id="confirmation-modal-{{ $user->id }}" class="fixed inset-0 flex items-center hidden justify-center bg-black bg-opacity-60">
                                                <div class="bg-white text-sm rounded-md shadow-md p-6 relative w-[90%] sm:w-[460px]">
                                                    <div class="p-3 text-center">
                                                        <i class="fa fa-regular fa-times-circle text-red-500 mx-auto" style="font-size:48px;"></i>
                                                        <div class="mt-5 text-2xl">Etes-vous sûr?</div>
                                                        <div class="mt-2 text-slate-500">
                                                            Voulez-vous vraiment supprimer l&apos;utilisateur 
                                                            <strong>
                                                                "{{ $user->name }}" ? <br />
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
                                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
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
                                // Fonction pour afficher/masquer le mot de passe
                                document.querySelectorAll('.toggle-password').forEach(function (button) {
                                    button.addEventListener('click', function () {
                                        const passwordDisplay = button.previousElementSibling;
                                        const actualPassword = button.nextElementSibling;
        
                                        if (passwordDisplay.classList.contains('hidden')) {
                                            passwordDisplay.classList.remove('hidden');
                                            actualPassword.classList.add('hidden');
                                        } else {
                                            passwordDisplay.classList.add('hidden');
                                            actualPassword.classList.remove('hidden');
                                        }
                                    });
                                });
                            
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
        </div>
    </x-content-page-admin>
    
    
    


    
</x-app-layout>
