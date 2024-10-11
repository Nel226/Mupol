<aside id="logo-sidebar" class="fixed left-0 z-40 w-64 h-screen transition-transform -translate-x-full top-20 sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-[#4000FF] dark:bg-gray-800">
       <div class="mt-2 text-white text-lg font-bold side-title">MENU</div>
       <ul class="mt-5 divide-y-2 space-y-4 font-medium">
           <li>
               <a href="{{ route('dashboard') }}" class="@if(Request::is('dashboard')) active @endif flex items-center px-4 py-3 text-white border border-transparent rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300 ease-in-out">
                   <i class="w-5 h-5 transition duration-75 fa fa-pie-chart dark:text-gray-400 group-hover:text-black"></i>
                   <span class="ms-3">Tableau de bord</span>
               </a>
           </li>

           <li>
               <a href="{{ route('adherants.index') }}" class="@if(Request::is('adherants') || Request::is('adherants/*')|| Request::is('ayantsdroits/*')) active @endif flex items-center px-4 py-3 text-white border border-transparent rounded-b-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300 ease-in-out">
                   <i class="w-5 h-5 transition duration-75 fa fa-user dark:text-gray-400 group-hover:text-black"></i>
                   <span class="ms-3">Gestion des adhésions</span>
               </a>
           </li>

           @role('comptable|controleur')
           <li>
               <a href="{{ route('cotisations.index') }}" class="@if(Request::is('cotisations') || Request::is('cotisations/*')) active @endif flex items-center px-4 py-3 text-white border border-transparent rounded-b-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300 ease-in-out">
                   <i class="w-5 h-5 transition duration-75 fa fa-money dark:text-gray-400 group-hover:text-black"></i>
                   <span class="ms-3">Gestion des cotisations</span>
               </a>
           </li>
           @endrole

           <li>
               <a href="#" class="flex items-center px-4 py-3 text-white border border-transparent rounded-b-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300 ease-in-out">
                   <i class="w-5 h-5 fa fa-calendar dark:text-gray-400 group-hover:text-black"></i>
                   <span class="ms-3">Gestion des évènements</span>
               </a>
           </li>

           <li>
               <a href="{{ route('prestations.index') }}" class="@if((Request::is('prestations') || Request::is('prestations/*')) && !Request::is('prestations/suivi')) active @endif flex items-center px-4 py-3 text-white border border-transparent rounded-b-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300 ease-in-out">
                   <i class="w-5 h-5 transition duration-75 fa fa-file dark:text-gray-400 group-hover:text-black"></i>
                   <span class="ms-3">Gestion des prestations</span>
               </a>
           </li>

           @role('administrateur')
           <li>
               <a href="{{ route('parametres.index') }}" class="@if(Request::is('parametres') || Request::is('roles') || Request::is('users') || Request::is('users/*') || Request::is('roles/*') || Request::is('parametres/*')) active @endif flex items-center px-4 py-3 text-white border border-transparent rounded-b-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300 ease-in-out">
                   <i class="w-5 h-5 transition duration-75 fa fa-cog dark:text-gray-400 group-hover:text-black"></i>
                   <span class="ms-3">Paramètres</span>
               </a>
           </li>
           @endrole

           @role('controleur')
            <li x-data="{ open: true }" class="relative">
                  <a href="#" @click.prevent="open = !open" class="flex items-center px-4 py-3 text-white bg-indigo-600 border border-white rounded-b-lg hover:text-black hover:bg-indigo-700 dark:bg-gray-800 group transition-all duration-300 ease-in-out">
                     <i class="w-5 h-5 mr-2 transition duration-75 fa fa-table dark:text-gray-400 group-hover:text-black"></i>
                     <span>Suivi des prestations</span>
            
                     <svg class="w-4 h-4 ml-auto transition-transform transform"
                           :class="open ? 'rotate-180' : ''"
                           xmlns="http://www.w3.org/2000/svg"
                           fill="none"
                           viewBox="0 0 24 24"
                           stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                     </svg>
                  </a>
            
                  <ol x-show="open" x-cloak @click.away="open = false" class="absolute left-0 w-full mx-5 mt-2 text-white list-disc rounded-lg list-item dark:bg-gray-800 dark:border-gray-700">
                     <li><a href="{{ route('suivi-consultation') }}" class="@if(Request::is('consultation/suivi')) active !text-black @endif block px-4 py-2 hover:bg-gray-100 hover:text-black dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg">Consultation</a></li>
                     <li><a href="{{ route('suivi') }}" class="@if(Request::is('prestations/suivi')) active !text-black @endif block px-4 py-2 hover:bg-gray-100 hover:text-black dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg">Hospitalisation</a></li>
                     <li><a href="{{ route('suivi-analyse-biomedicale') }}" class="@if(Request::is('analyse-biomedicale/suivi')) active !text-black @endif block px-4 py-2 hover:bg-gray-100 hover:text-black dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg">Analyse biomédicale</a></li>
                     <li><a href="{{ route('suivi-radio') }}" class="@if(Request::is('radio/suivi')) active !text-black @endif block px-4 py-2 hover:bg-gray-100 hover:text-black dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg">Radio</a></li>
                     <li><a href="{{ route('suivi-pharmacie') }}" class="@if(Request::is('pharmacie/suivi')) active !text-black @endif block px-4 py-2 hover:bg-gray-100 hover:text-black dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg">Pharmacie</a></li>
                     <li><a href="{{ route('suivi-maternite') }}" class="@if(Request::is('maternite/suivi')) active !text-black @endif block px-4 py-2 hover:bg-gray-100 hover:text-black dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg">Maternité</a></li>
                     <li><a href="{{ route('suivi-optique') }}" class="@if(Request::is('optique/suivi')) active !text-black @endif block px-4 py-2 hover:bg-gray-100 hover:text-black dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg">Optique</a></li>
                     <li><a href="{{ route('suivi-dentaire-auditif') }}" class="@if(Request::is('dentaire-auditif/suivi')) active !text-black @endif block px-4 py-2 hover:bg-gray-100 hover:text-black dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg">Dentaire et Auditif</a></li>
                     <li><a href="{{ route('suivi-allocation') }}" class="@if(Request::is('allocation/suivi')) active !text-black @endif block px-4 py-2 hover:bg-gray-100 hover:text-black dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg">Allocation</a></li>
                     {{--  <li><a href="{{ route('suivi-autre') }}" class="@if(Request::is('autre/suivi')) active !text-black @endif block px-4 py-2 hover:bg-gray-100 hover:text-black dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg">Autres actes</a></li>  --}}
                  </ol>
            </li>
        
           @endrole
       </ul>
   </div>
</aside>
