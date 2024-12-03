
<x-guest-layout>
    <x-preloader/>

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
    <div id="app-layout" class="overflow-x-hidden flex">
        @include("components.navbar-guest-connected")
        <!-- app layout content -->
        <div 
        id="app-layout-content" 
        class="layout-guest min-h-screen w-full lg:pl-[15.625rem] transition-all duration-300 ease-out">
     
            @include("components.top-navbar-guest-connected")

           <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
              <!-- title -->
              <h1 class="text-xl text-white">{{ $pageTitle }}</h1>
              
           </div>
           <div class="-mt-12  mb-6 ">
            <div class="mx-6 my-6 grid grid-cols-1 lg:grid-cols-1 grid-rows-1 grid-flow-row-dense gap-6">
                
                <!-- card -->
                <div class="card h-full shadow">
                    <div class="border-b border-gray-300 px-1 md:px-5 py-4 flex items-center w-full justify-between">
                        <!-- title -->
                        <div>
                           <h4>Mes prestations</h4>
                        </div>
                        <div>
                           <!-- button -->
                           <div class="dropdown leading-4">
                               <button
                               class="btn btn-sm gap-x-2 bg-white text-gray-800 border-gray-300 border disabled:opacity-50 disabled:pointer-events-none hover:text-white hover:bg-gray-700 hover:border-gray-700 active:bg-gray-700 active:border-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300"
                               type="button"
                               data-bs-toggle="dropdown"
                               aria-expanded="false">
                                   <a href=" {{route('adherents.nouvelle-prestation')}} ">
                   
                                       Nouvelle prestation
                                   </a>
                               
                               </button>
                              
                           </div>
                        </div>
                     </div>
                   <div class="relative overflow-x-auto" data-simplebar="" style="max-height: 380px">
                      <!-- table -->
                      <table class="text-left w-full whitespace-nowrap">
                         <thead class="text-gray-700">
                            <tr>
                                
                               <th scope="col" class="border-b bg-gray-100 px-6 py-3">Date</th>
                               <th scope="col" class="border-b bg-gray-100 px-6 py-3">Bénéficiare</th>
                               <th scope="col" class="border-b bg-gray-100 px-6 py-3">Acte</th>
                               <th scope="col" class="border-b bg-gray-100 px-6 py-3">Montant</th>
                               <th scope="col" class="border-b bg-gray-100 px-6 py-3">Etat paiement</th>

                            </tr>
                         </thead>
                         <tbody>
                           
                            @forelse ($prestations as $prestation)
                                <tr>
                                       
                                   
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">{{ \Carbon\Carbon::parse($prestation->date)->format('d/m/Y') }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">{{ $prestation->beneficiaire }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">{{ $prestation->acte }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">{{ $prestation->montant }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        @if ($prestation->etat_paiement === 1)
                                        <span class="bg-green-100 px-2 py-1 text-green-700 text-sm font-medium rounded-md">
                                            Payé
                                        </span>
                                          
                                        @else
                                        <span class="bg-red-100 px-2 py-1 text-red-700 text-sm font-medium rounded-md">

                                            En cours
                                        </span>
                                
                                        @endif  
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-gray-500 text-sm">Aucune demande.</p>
                                    </td>
                                </tr>
                            @endforelse
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
                 
           </div>
           
           @include("components.footer-guest-connected")
        </div>
    </div>
   
</x-guest-layout>
