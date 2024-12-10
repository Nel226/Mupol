
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
        <x-header>
            {{ $pageTitle }}
        </x-header>
        
        <div class="md:p-6 p-2 mx-auto mt-4 bg-white rounded-lg shadow-lg">
           
            @role('administrateur')
            <div class="flex flex-wrap items-center justify-start py-2 gap-2">
                <a href="{{ route('users.create') }}">
                    <button class="btn">{{ __('Créer un utilisateur') }}</button>
                </a>
            </div>

            <x-data-table id="table-users" :headers="['N', 'Nom', 'Email', 'Mot de passe', 'Rôle', 'Actions' ]">
                @foreach ($users as $index => $user)
                    <tr  class=" hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="password-display">*****</span>
                            <button class="toggle-password ml-2 text-blue-600">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                        <td>
                            @foreach($user->roles as $role)
                                {{ $role->name }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            <button class="mt-2 ">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn flex items-center text-white">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </button>
                            
                            <!-- Bouton pour ouvrir le modal -->
                            <button data-modal-id="confirmation-modal-{{ $user->id }}" class="btn mt-2 bg-red-700">
                                <i class="fa fa-trash"></i>
                                
                            </button>
                            
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
            </x-data-table>
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
        
                const tableUsers = initializeDataTable('#table-users');
              

            });
        </script>
        
    </x-content-page-admin>
</x-app-layout>
