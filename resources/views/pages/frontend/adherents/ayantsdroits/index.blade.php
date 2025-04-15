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
        class="layout-guest min-h-screen w-full lg:pl-[5.625rem] transition-all duration-300 ease-out">
     
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
                           <h4>Mes ayants droit</h4>
                        </div>
                        <div>
                           <!-- button -->
                           <div class="dropdown leading-4">
                            @if ($adherent->ayantsDroits()->count() < 6 )
                           
                                <button
                                class="btn btn-sm gap-x-2 bg-white text-gray-800 border-gray-300 border disabled:opacity-50 disabled:pointer-events-none hover:text-white hover:bg-gray-700 hover:border-gray-700 active:bg-gray-700 active:border-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <a href=" {{route('adherents.nouveau-ayantdroit')}} ">
                                    Nouveau ayant droit
                                </a>
                                </button>
                            @endif
                              
                           </div>
                        </div>
                     </div>
                   <div class="relative overflow-x-auto" data-simplebar="" style="max-height: 380px">
                      <!-- table -->
                      <table class="text-left w-full whitespace-nowrap">
                         <thead class="text-gray-700">
                            <tr>
                               <th scope="col" class="border-b bg-gray-100 px-6 py-3">Identité</th>
                               <th scope="col" class="border-b bg-gray-100 px-6 py-3">Date de naissance</th>
                               <th scope="col" class="border-b bg-gray-100 px-6 py-3">Lien de parenté</th>
                               <th scope="col" class="border-b bg-gray-100 px-6 py-3">Code carte</th>
                               {{-- <th scope="col" class="border-b bg-gray-100 px-6 py-3">Documents</th> --}}
                               <th scope="col" class="border-b bg-gray-100 px-6 py-3"></th>


                            </tr>
                         </thead>
                         <tbody>
                           
                            @forelse ($ayantsDroits as $ayantDroit)
                                <tr>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            {{-- <div>
                                                <a href="#" class="h-10 w-10 inline-block">
                                                    <img src="{{ asset('storage/' . $ayantDroit->photo) }}" alt="Photo" class="rounded-full" />
                                                </a>
                                            </div> --}}
                                            <div class="ml-3 leading-4">
                                                <h5 class="mb-1">
                                                    <a href="#!">{{ $ayantDroit->nom }} {{ $ayantDroit->prenom }}</a>
                                                </h5>
                                                <p class="mb-0 text-gray-500">Genre : {{ $ayantDroit->sexe }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">{{ $ayantDroit->date_naissance }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">{{ $ayantDroit->relation }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">{{ $ayantDroit->code }}</td>
                                    {{-- <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        <div class="flex space-y-2 flex-col">
                                            @if ($ayantDroit->extrait)
                                                <a href="{{ asset('storage/' . $ayantDroit->extrait) }}" target="_blank" class="text-primary1 underline">
                                                    Voir l&apos;extrait
                                                </a>
                                            @else
                                                <span class="text-gray-500">Extrait non disponible</span>
                                            @endif

                                            @if ($ayantDroit->relation == 'Epoux' || $ayantDroit->relation == 'Epouse')
                                                @if ($ayantDroit->cnib)
                                                    <a href="{{ asset('storage/' . $ayantDroit->cnib) }}" target="_blank" class="text-primary1 underline">
                                                        Voir la CNIB
                                                    </a>
                                                @else
                                                    <span class="text-gray-500">CNIB non disponible</span>
                                                @endif
                                            @endif
                                        </div>
                                    </td> --}}
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        <form action="{{ route('adherents.delete-ayantdroit', $ayantDroit->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet ayant droit ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-800 btn">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-gray-500 text-sm">Aucun ayant droit trouvé.</p>
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
