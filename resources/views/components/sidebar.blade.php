<aside id="logo-sidebar" class="fixed left-0 z-40 w-64 h-screen transition-transform -translate-x-full top-0 sm:translate-x-0 bg-transparent  ">
    <div class="h-full px-4 py-6 overflow-y-auto bg-transparent dark:bg-gray-900">
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/logofinal.png') }}" class="h-16 w-16 rounded-full border-2 border-white bg-white shadow-lg" alt="Logo" />
            <span class="self-center ml-3 text-base font-bold text-white sm:text-base tracking-wide">
                {{ config('app.name') }}
            </span>
        </a>
 
        <div class="mt-8 text-gray-200 text-sm font-semibold uppercase tracking-wide">Menu</div>
        <ul class="mt-2 space-y-2 text-sm font-medium" x-data="{ openMenu: null }">
            <li>
                <a href="{{ route('dashboard') }}" class="@if(Request::is('dashboard')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 hover:scale-105 ">
                    <i class="fa fa-pie-chart w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Tableau de bord</span>
                </a>
            </li>
            @role('comptable')
            <!-- Recettes Menu -->

            <li x-data="{ open: {{ Request::is('recettes*') ? 'true' : 'false' }} }" class="relative">
                <a href="#" @click.prevent="open = !open" class="flex transition-transform transform items-center justify-between px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 duration-300 hover:scale-105">
                    <div class="flex items-center">
                        <i class="fa fa-share w-3 h-3 dark:text-gray-400 group-hover:text-black transition-transform transform"></i>
                        <span class="ml-3">Recettes</span>
                    </div>
                    <!-- Chevron icon -->
                    <i :class="open ? 'rotate-180' : ''" class="fa fa-chevron-down text-white group-hover:text-black transition-transform duration-200"></i>
                </a>
                <ul x-show="open" x-cloak x-transition class="ml-5 mt-1 shadow-lg border border-gray-50 rounded-lg">
                    <li>
                        <a href="{{ route('recettes.index') }}" class="@if(Request::is('recettes')) active @endif flex items-center px-3 py-2 text-gray-200 rounded-t-lg  hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                            <span class="ml-3">Aperçu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('recettes.categories') }}" class="@if(Request::is('recettes-categories')) active @endif flex items-center px-3 py-2 text-gray-200  hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                            <span class="ml-3">Catégories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('recettes.create') }}" class="@if(Request::is('recettes/create')) active @endif flex items-center px-3 py-2 text-gray-200 rounded-b-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                            <span class="ml-3">Ajouter</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            
            
            <!-- Dépenses Menu -->
            <li  x-data="{ open: {{ Request::is('depenses*') ? 'true' : 'false' }} }"  class="relative">
                <a href="#" @click.prevent="open = !open" class="flex transition-transform transform items-center justify-between px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 duration-300 hover:scale-105">
                   
                    <div class="flex items-center">
                        <i class="fa fa-reply w-3 h-3 dark:text-gray-400 group-hover:text-black transition-transform transform"></i>
                        <span class="ml-3">Dépenses</span>
                    </div>
                    <!-- Chevron icon -->
                    <i :class="open ? 'rotate-180' : ''" class="fa fa-chevron-down text-white group-hover:text-black transition-transform duration-200"></i>
                </a>
                <ul x-show="open" x-cloak  x-transition class="ml-5 mt-1 shadow-lg border border-gray-50 rounded-lg">
                    <li>
                        <a href="{{ route('depenses.index') }}" class="@if(Request::is('depenses')) active @endif flex items-center px-3 py-2 text-gray-200 rounded-t-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                            <span class="ml-3">Aperçu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('depenses.categories') }}" class="@if(Request::is('depenses-categories')) active @endif flex items-center px-3 py-2 text-gray-200  hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                            <span class="ml-3">Catégories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('depenses.create') }}" class="@if(Request::is('depenses/create')) active @endif flex items-center px-3 py-2 text-gray-200 rounded-b-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                            <span class="ml-3">Ajouter</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li>
                <a href="{{ route('caisse.index') }}" class="@if(Request::is('caisse') || Request::is('caisse/*')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 hover:scale-105">
                    <i class="fa  fa-bank w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Caisse</span>
                </a>
            </li>
            
            <li  x-data="{ open: {{ Request::is('estimations*') ? 'true' : 'false' }} }"  class="relative">
                <a href="#" @click.prevent="open = !open" class="flex transition-transform transform items-center justify-between px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 duration-300 hover:scale-105">
                   
                    <div class="flex items-center">
                        <i class="fa fa-calculator w-3 h-3 dark:text-gray-400 group-hover:text-black transition-transform transform"></i>
                        <span class="ml-3">Estimations</span>
                    </div>
                    <!-- Chevron icon -->
                    <i :class="open ? 'rotate-180' : ''" class="fa fa-chevron-down text-white group-hover:text-black transition-transform duration-200"></i>
                </a>
                <ul x-show="open" x-cloak  x-transition class="ml-5 mt-1 shadow-lg border border-gray-50 rounded-lg">
                    <li>
                        <a href="{{ route('estimations.index') }}" class="@if(Request::is('estimations')) active @endif flex items-center px-3 py-2 text-gray-200 rounded-t-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                            <span class="ml-3">Aperçu</span>
                        </a>
                    </li>
                    {{--  <li>
                        <a href="{{ route('estimations.categories') }}" class="@if(Request::is('depenses-categories')) active @endif flex items-center px-3 py-2 text-gray-200  hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                            <span class="ml-3">Catégories</span>
                        </a>
                    </li>  --}}
                    <li>
                        <a href="{{ route('estimations.create') }}" class="@if(Request::is('estimations/create')) active @endif flex items-center px-3 py-2 text-gray-200 rounded-b-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                            <span class="ml-3">Ajouter</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('budget-suivi.index') }}" class="@if(Request::is('budget-suivi') ) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 hover:scale-105">
                    <i class="fa fa-eye w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Suivi</span>
                </a>
            </li>
          
            {{--  <li>
                <a href="{{ route('adherants.index') }}" class="@if(Request::is('adherants') || Request::is('adherants/*')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 hover:scale-105">
                    <i class="fa  fa-book w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Provisions</span>
                </a>
            </li>  --}}
         
            <li>
                <a href="{{ route('adherants.index') }}" class="@if(Request::is('adherants') || Request::is('adherants/*')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-line-chart w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Statistiques</span>
                </a>
            </li>
            @endrole
            @role('agentsaisie|controleur')
            <li>
                <a href="{{ route('demandes.index') }}" class="@if(Request::is('demandes') || Request::is('demandes/*')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa  fa-file-text w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Demandes d&apos;adhésion</span>
                </a>
            </li>
            @endrole

            @role('agentsaisie|controleur')

            <li>
                <a href="{{ route('adherants.index') }}" class="@if(Request::is('adherants') || Request::is('adherants/*')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-user w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Gestion des adhésions</span>
                </a>
            </li>
            @endrole

            @role('controleur')
            <li>
                <a href="{{ route('cotisations.index') }}" class="@if(Request::is('cotisations') || Request::is('cotisations/*')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-money w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Gestion des cotisations</span>
                </a>
            </li>
            @endrole
            
            {{--  <li>
                <a href="#" class="flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-calendar w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Gestion des évènements</span>
                </a>
            </li>  --}}
            <li>
                <a href="{{ route('prestations.index') }}" class="@if(Request::is('prestations')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-file w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Gestion des prestations</span>
                </a>
            </li>

            @role('controleur')
            <li>
                <a href="{{ route('centres-sante.index') }}" class="@if(Request::is('centres-sante') || Request::is('centres-sante/*')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-handshake-o dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Gestion des partenaires</span>
                </a>
            </li>
            @endrole

            @role('administrateur')
            <li>
                <a href="{{ route('parametres.index') }}" class="@if(Request::is('parametres')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-cog w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Paramètres</span>
                </a>
            </li>
            @endrole
            <!-- Suivi des Prestations (Controleur) -->
            @role('controleur')
            <li x-data="{ open: true }" class="relative">
                <a href="#" @click.prevent="open = !open" class="flex items-center px-4 py-3 text-white transition-transform transform rounded-lg hover:bg-indigo-700 group">
                    <i class="w-6 h-6 fa fa-table transition duration-200 group-hover:scale-110"></i>
                    <span class="ml-3">Suivi des prestations</span>
                    <svg class="w-4 h-4 ml-auto transition-transform transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
 
                <ol x-show="open" x-cloak @click.away="open = false" class="ml-6 mt-2 space-y-2 text-sm text-white rounded-lg dark:bg-gray-800">
                    <li><a href="{{ route('suivi-consultation') }}" class="block px-4 py-2 hover:bg-gray-100 hover:text-black dark:hover:bg-gray-700 rounded-lg">Consultation</a></li>
                    <li><a href="{{ route('suivi') }}" class="block px-4 py-2 hover:bg-gray-100 hover:text-black dark:hover:bg-gray-700 rounded-lg">Hospitalisation</a></li>
                    <li><a href="{{ route('suivi-maternite') }}" class="block px-4 py-2 hover:bg-gray-100 hover:text-black dark:hover:bg-gray-700 rounded-lg">Maternité</a></li>
                    <li><a href="{{ route('suivi-pharmacie') }}" class="block px-4 py-2 hover:bg-gray-100 hover:text-black dark:hover:bg-gray-700 rounded-lg">Pharmacie</a></li>
                    <li><a href="{{ route('suivi-optique') }}" class="block px-4 py-2 hover:bg-gray-100 hover:text-black dark:hover:bg-gray-700 rounded-lg">Optique</a></li>
                    <li><a href="{{ route('suivi-allocation') }}" class="block px-4 py-2 hover:bg-gray-100 hover:text-black dark:hover:bg-gray-700 rounded-lg">Allocation</a></li>


                </ol>
            </li>
            @endrole
        </ul>
       
    </div>
 </aside>
 