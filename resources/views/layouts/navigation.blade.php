<nav x-data="{ open: false, dropdownOpen: false }" class="    z-50 w-full  border-gray-400 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    
    <div class=" mx-auto py-1 ">
        <div class="flex justify-between">
            
            <div class="hidden lg:flex">
                <!-- Include Breadcrumbs Component -->
                @yield('breadcrumbs')

            </div>

            <div class="flex items-center justify-between">
                {{-- <div >
                    @yield('navigation-content')
                </div> --}}
                <div class="hidden lg:flex sm:items-center sm:ms-6" @click.away="dropdownOpen = false">
                    <button @click="dropdownOpen = !dropdownOpen" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-gray-200 border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                        <div>
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            {{ Auth::user()->name }}
                        </div>
                        <div class="ms-1">
                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                    <div x-show="dropdownOpen" x-transition class="absolute right-0 w-48 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Profil</a>
                        <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                            @csrf
                            <button type="submit">Déconnexion</button>
                        </form>
                    </div>
                </div>
            </div>

          
        </div>
    </div>

    
</nav>