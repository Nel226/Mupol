<aside id="logo-sidebar" class="fixed left-0 z-40 w-64 h-screen transition-transform -translate-x-full top-0 sm:translate-x-0 shadow-lg bg-transparent " aria-label="Sidebar">
    <div class="h-full px-4 py-6 overflow-y-auto bg-transparent dark:bg-gray-900">
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/logofinal.png') }}" class="h-16 w-16 rounded-full border-2 border-white bg-white shadow-lg" alt="Logo" />
            <span class="self-center ml-3 text-base font-bold text-white sm:text-base tracking-wide">
                {{ config('app.name') }}
            </span>
        </a>
 
        <div class="mt-8 text-gray-200 text-sm font-semibold uppercase tracking-wide">Menu</div>
        <ul class="mt-2 space-y-2 text-sm font-medium">
            <li>
                <a href="{{ route('dashboard') }}" class="@if(Request::is('dashboard')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-pie-chart w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="{{ route('demandes.index') }}" class="@if(Request::is('demandes') || Request::is('demandes/*')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa  fa-file-text w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Demandes d&apos;adhésion</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adherants.index') }}" class="@if(Request::is('adherants') || Request::is('adherants/*')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-user w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Gestion des adhésions</span>
                </a>
            </li>
            @role('comptable|controleur')
            <li>
                <a href="{{ route('cotisations.index') }}" class="@if(Request::is('cotisations') || Request::is('cotisations/*')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-money w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Gestion des cotisations</span>
                </a>
            </li>
            @endrole
            <li>
                <a href="#" class="flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-calendar w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Gestion des évènements</span>
                </a>
            </li>
            <li>
                <a href="{{ route('prestations.index') }}" class="@if(Request::is('prestations')) active @endif flex items-center px-3 py-2 text-white rounded-lg hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    <i class="fa fa-file w-5 h-5 dark:text-gray-400 group-hover:text-black"></i>
                    <span class="ml-3">Gestion des prestations</span>
                </a>
            </li>
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
                    <!-- Autres sous-menus -->
                </ol>
            </li>
            @endrole
        </ul>
       
    </div>
 </aside>
 