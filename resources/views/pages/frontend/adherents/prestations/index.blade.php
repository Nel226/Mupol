<x-guest-layout >
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
    <section class="contact-us section min-h-screen">
        <div class="container">
            <div class=" p-3 ">
                <div class="row justify-end">
                    <div class=" flex justify-end">
                        <x-primary-button >
                            <a href=" {{route('adherents.nouvelle-prestation')}} ">
                
                                Nouvelle prestation
                            </a>
                        </x-primary-button>
                    </div>
                </div>
                <div class="row ">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md w-full">
                        <div class="mb-6 text-center">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Liste des prestations</h2>
                            <p class="text-gray-600 dark:text-gray-300 mt-2">Code Carte : <span class="text-indigo-600 font-semibold">{{ $adherent->code_carte }}</span></p>
                        </div>
                
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                                <thead>
                                    <tr class="text-left text-gray-600 dark:text-gray-400 uppercase text-sm leading-normal bg-gray-100 dark:bg-gray-700">
                                        <th class="py-2 px-6">Date</th>
                                        <th class="py-2 px-6">Bénéficiare</th>
                
                                        <th class="py-2 px-6">Acte</th>
                
                                        <th class="py-2 px-6">Montant</th>
                
                
                                        <th class="py-2 px-6">Validité</th>
                                        <th class="py-2 px-6 text-center">Etat paiement</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 dark:text-gray-300 text-sm font-light">
                                    @foreach ($prestations as $prestation)
                                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                            
                                            <td class="py-3 px-6">{{ \Carbon\Carbon::parse($prestation->date)->format('d/m/Y') }}</td>
                                            <td class="py-3 px-6">{{ $prestation->beneficiaire }}</td>
                
                                            <td class="py-3 px-6">{{ $prestation->acte }}</td>
                
                                            <td class="py-3 px-6 text-right">{{ $prestation->montant }}</td>
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
                    </div>
                </div>

            </div>
        </div>
    </section>
   
</x-guest-layout>
