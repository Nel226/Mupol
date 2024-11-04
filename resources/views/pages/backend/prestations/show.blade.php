<x-app-layout>
    <x-sidebar/>
    <x-content-page>

        <div class="flex-1 p-6">
            <div class="py-5">
                <h1 class="text-xl font-bold text-center text-[#4000FF]">Détails de la prestation</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Vous avez ici toutes les informations de la prestation soumise. Vous pouvez la valider si elle est acceptée ou la rejeter.
                </p>
            </div>
            <!-- Colonne 1: Informations de la prestation -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="flex justify-end">
                    <span class="bg-blue-100 text-[#4000FF]  text-xs font-medium inline-flex items-center  px-2.5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                        <i  class=" fa fa-check me-1.5"></i>
                        {{ ucfirst($prestation->validite) }}
                    </span>
                </div>
                @role('controleur|agentsaisie')
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full border border-collapse border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 border border-gray-300">Date de l’acte</th>
                                <th class="px-4 py-2 border border-gray-300">Nom</th>
                                <th class="px-4 py-2 border border-gray-300">Prénom</th>
                                <th class="px-4 py-2 border border-gray-300">Code</th>
                                <th class="px-4 py-2 border border-gray-300">Bénéficiaire</th>
                                <th class="px-4 py-2 border border-gray-300">Sexe/Age</th>
                                <th class="px-4 py-2 border border-gray-300">Centre de santé</th>
                                <th class="px-4 py-2 border border-gray-300">Acte</th>
                                <th class="px-4 py-2 border border-gray-300">Montant Total</th>
                                <th class="px-4 py-2 border border-gray-300">Montant Modérateur</th>
                                <th class="px-4 py-2 border border-gray-300">Montant Mupol</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ $prestation->date }}</td>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ $prestation->adherantNom }}</td>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ $prestation->adherantPrenom }}</td>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ $prestation->adherantCode }}</td>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ $prestation->beneficiaire }}</td>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ $prestation->adherantSexe }}</td>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ $prestation->centre }}</td>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ $prestation->acte }}</td>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ number_format($prestation->montant, 2, ',', ' ') }}</td>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ $prestation->montant*20/100}}</td>
                                <td class="px-4 py-2 border border-gray-300 whitespace-nowrap">{{ $prestation->montant*80/100 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endrole
                @role('comptable')
                <div class="grid grid-cols-2 gap-5 mt-3 md:grid-cols-2">
                    <div>
                        <x-card title="Informations prestation">
                            <dt class="text-sm font-medium text-gray-500">
                                Date
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $prestation->date }}
                            </dd>
                            <dt class="text-sm font-medium text-gray-500">
                                Acte
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $prestation->acte }}
                            </dd>
                            <dt class="text-sm font-medium text-gray-500">
                                Type
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $prestation->type }}
                            </dd>
                            
                            <dt class="text-sm font-medium text-gray-500">
                                Sous-Type
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $prestation->sous_type ?? 'N/A' }}
                            </dd>
                            
                            <dt class="text-sm font-medium text-gray-500">
                                Centre de santé :
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $prestation->centre }}
                            </dd>  
                           
                        </x-card>
                    </div>
                    <div>
                        <x-card title="Montants" >
                            <dt class="text-sm font-medium text-gray-500">
                                Montant total
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $prestation->montant}}
                            </dd>
                            <dt class="text-sm font-medium text-gray-500">
                                Montant modérateur
                            </dt>
                            <dd class="flex gap-4 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ ($prestation->montant*20)/100}}
                                <div class="flex justify-end">
                                    <span class="bg-blue-100 text-[#4000FF] text-xs font-medium inline-flex items-center  px-2.5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                        20%
                                    </span>
                                </div>
                            </dd>
                            <dt class="text-sm font-medium text-gray-500">
                                Montant mutuelle
                            </dt>
                            <dd class="flex gap-4 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ ($prestation->montant*80)/100}}
                                <div class=" -end">
                                    <span class="bg-blue-100 text-[#4000FF] text-xs font-medium inline-flex items-center  px-2.5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                        80%
                                    </span>
                                </div>
                                <div>
                                    @if ($prestation->etat_paiement === 1)
                                    <span class="p-2 text-green-600 bg-green-200 border border-green-600 rounded-md shadow-sm">
                                        Payé
                                    </span>                                             
                                    @else
                                    <span class="p-2 text-red-600 bg-red-200 border border-red-600 rounded-md shadow-sm">
                                        Non payé
                                        </span>  
                                    @endif
                                </div>
                            </dd>
                        </x-card> 
                    </div>    
                    
                </div>
                @endrole
               
                @role('controleur|agentsaisie')
                <div class="mt-4">
    
                    <span class="mt-4 text-sm font-medium text-gray-500">
                        Preuves
                    </span>
                    <div class="grid-cols-3 py-3 sm:py-5 sm:grid sm:grid-cols-3 ">
                        
                        @foreach ($prestation->preuve as $index => $preuve)
                            <div class="flex flex-wrap gap-2 py-3">
                                <a href="#"
                                
                                onclick="showPDF('{{ URL::asset('storage/'.$preuve) }}'); return false;">
                                    <img src="{{ asset('images/pdf-80.png') }}" alt="PDF" width="150" height="100" class="p-2 border rounded-md">
                                    <p class="mt-2 text-sm font-thin text-center">Preuve {{ $index + 1 }}</p>
                                </a>
                            </div>
                        @endforeach
                
                    </div>  
                    
                    <!-- Main modal -->
                    <div id="pdfModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 flex items-center justify-center hidden w-full h-full bg-black bg-opacity-50">
                        <div class="relative w-full h-full max-w-4xl p-4">
                            <!-- Modal content -->
    
                            <div class="relative flex flex-col h-full bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex justify-end p-2">
                                    <button type="button" onclick="closePDFModal()" class="inline-flex items-center justify-center p-2 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="flex-1 p-2 md:p-4">
                                    <iframe id="pdfIframe" src=""  class="w-full h-full"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        function showPDF(pdfUrl) {
                            var pdfModal = document.getElementById('pdfModal');
                            var pdfIframe = document.getElementById('pdfIframe');
                            
                            pdfIframe.src = pdfUrl;
                            
                            pdfModal.classList.remove('hidden');
                        }
                    
                        function closePDFModal() {
                            var pdfModal = document.getElementById('pdfModal');
                            var pdfIframe = document.getElementById('pdfIframe');
                            pdfModal.classList.add('hidden');
                            pdfIframe.src = '';
                        }
                    </script>
                    
                       
                </div>
                @endrole
    
            </div>
            @role('controleur')
            <div class="flex justify-around mt-6">
                <form action="{{ route('prestations.valider', ['id' => $prestation->id]) }}" method="POST" class="flex items-center p-2 text-green-700 rounded-md shadow-sm ">
                    @csrf
                    <x-primary-button type="submit">
                        <i class="fa fa-check"></i>
                        <span class="ml-2">
                            {{ __('Valider') }}
                        </span>
                    </x-primary-button>
                    
                </form>
                <form action="{{ route('prestations.rejeter', ['id' => $prestation->id]) }}" method="POST" class="flex items-center p-2 text-red-700 rounded-md shadow-sm ">
                    @csrf
                    <x-primary-button type="submit" class=" bg-red-600">
                        <i class="fa fa-times"></i>
                        <span class="ml-2">
                            {{ __('Rejeter') }}
                        </span>
                    </x-primary-button>
                   
                </form>
            </div>
               
            @endrole
            
            @role('comptable')
            <div x-data="{ open: false }">
                <div class="flex justify-around mt-6">
                    <form @submit.prevent="open = true" class="flex items-center p-2 text-green-700 rounded-md shadow-sm">
                        @csrf
                        <x-primary-button type="submit">
                            <i class="fa fa-check"></i>
                            <span class="ml-2">{{ __('Valider le paiement') }}</span>
                        </x-primary-button>
                    </form>
                    @if ($prestation->etat_paiement == 1)
                        <a href="{{ route('prestations.downloadReceipt', ['id' => $prestation->id]) }}" class="flex items-center p-2 text-blue-700 rounded-md shadow-sm">
                            <x-primary-button>
                                <i class="fa fa-download"></i>
                                <span class="ml-2">{{ __('Télécharger reçu') }}</span>
                            </x-primary-button>
                        </a>
                    @endif
                </div>
            
            
                <x-modal-confirm title="Confirmer le paiement" icon="fa fa-money text-green-700">
                    {{__('Êtes-vous sûr de vouloir valider ce paiement ?')}}  
                    <x-slot name="actions">
                        <form action="{{ route('prestations.validerpaiement', ['id' => $prestation->id]) }}" method="POST">
                            @csrf
                            <x-primary-button type="submit" class="bg-green-700">
                                Confirmer
                            </x-primary-button>
                        </form>
                    </x-slot>
                </x-modal-confirm>
            </div>
            
            @endrole
    
        </div>  
    </x-content-page>
  
</x-app-layout>
