<x-guest-layout>
    <x-header-guest/>

    @if (session()->has('message'))
        <div id="success-notification" class="notification bg-green-500 text-white p-4 rounded mb-4 mx-6 mt-4 text-center shadow-lg">
            {{ session('message') }}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification');
                setTimeout(() => {
                    notification.classList.add('hidden'); // Cache le message après 5 secondes
                }, 5000);
            });
        </script>
    @endif

    <x-sidebar-guest/>

    <div class="min-h-screen ml-64 bg-gray-50 dark:bg-gray-900 py-3">
        <section class="container mx-auto ">
            <div class=" flex my-2 justify-end">
                <x-primary-button >
                    <a href=" {{route('adherents.nouvelle-prestation')}} ">

                        Nouvelle prestation
                    </a>
                </x-primary-button>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6  mx-auto">
                <div class="mb-6 text-center">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Liste des prestations</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Code Carte : <span class="text-indigo-600 font-semibold">{{ $adherent->code_carte }}</span></p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                        <thead>
                            <tr class="text-left text-gray-600 dark:text-gray-400 uppercase text-sm leading-normal bg-gray-100 dark:bg-gray-700">
                                <th class="py-3 px-6">ID</th>
                                <th class="py-3 px-6">Date</th>
                                <th class="py-3 px-6">Acte</th>

                                <th class="py-3 px-6">Montant</th>


                                <th class="py-3 px-6">Validité</th>
                                <th class="py-3 px-6 text-center">Etat paiement</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-300 text-sm font-light">
                            @foreach ($prestations as $prestation)
                                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="py-3 px-6">{{ $prestation->idPrestation }}</td>
                                    
                                    <td class="py-3 px-6">{{ $prestation->date }}</td>
                                    <td class="py-3 px-6">{{ $prestation->acte }}</td>

                                    <td class="py-3 px-6">{{ $prestation->montant }}</td>
                                    <td class="py-3 px-6">{{ $prestation->validite }}</td>

                                    <td class="py-3 px-6">
                                        @if ($prestation->etat_paiement === 1)
                                        <span class="p-2 text-green-600 bg-green-200 border border-green-600 rounded-md shadow-sm">
                                            Payé
                                        </span>                                             
                                        @else
                                        <span class="p-2 text-red-600 bg-red-200 border border-red-600 rounded-md shadow-sm">
                                            Non payé
                                            </span>  
                                        @endif
                                    </td>
                                    
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