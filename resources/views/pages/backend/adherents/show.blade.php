<x-app-layout>
    <x-sidebar/>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification-content');
                const closeBtn = document.getElementById('close-notification');
                
                notification.classList.remove('hidden');
                
                {{--  setTimeout(() => {
                    notification.classList.add('hidden');
                }, 5000);  --}}
                
                closeBtn.addEventListener('click', () => {
                    notification.classList.add('hidden');
                });
            });
        </script>
    @endif
   
    <div class="p-4 border-2 border-gray-200 rounded-lg sm:ml-64 dark:border-gray-700 mt-14">
        <div class="flex-1 p-6">
            <!-- Header -->
            <x-header>
                {{__('Informations mutualiste')}}
            </x-header>   
            <div class="col-span-2 px-8 mt-6 py-5 space-y-3 border-gray-200 sm:p-0">
                <div class="rounded-md shadow-md ">
                    <div class="bg-[#fffe4a70] text-black p-4">
                        <h2 class="text-lg font-semibold">Informations personnelles</h2>
                    </div>
                    <div class="py-1  mt-6 sm:py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Nom
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $adherent->nom }}
                        </dd>
                        <dt class="text-sm font-medium text-gray-500">
                            Prénom
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $adherent->prenom }}
                        </dd>
                        <dt class="text-sm font-medium text-gray-500">
                            Genre
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $adherent->genre }}
                        </dd>
                        
                        <dt class="text-sm font-medium text-gray-500">
                            Service
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $adherent->service }}
                        </dd>
                        <dt class="text-sm font-medium text-gray-500">
                            Matricule
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $adherent->no_matricule }}
                        </dd>
                        <dt class="text-sm font-medium text-gray-500">
                            Téléphone
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $adherent->telephone }}
                        </dd>

                        <dt class="text-sm font-medium text-gray-500">
                            Code carte
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $adherent->code_carte }}
                        </dd>
                        <dt class="text-sm font-medium text-gray-500">
                            Charge
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $adherent->charge }}
                        </dd>
                        <dt class="text-sm font-medium text-gray-500">
                            Mensualité
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $adherent->mensualite }}
                        </dd>
                        <dt class="text-sm font-medium text-gray-500">
                            Adhésion
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $adherent->adhesion }}
                        </dd>
                    </div>
                </div>

                
                
            </div>
            
            
        </div>
    </div> 
</x-app-layout>

