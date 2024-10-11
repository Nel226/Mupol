<header>
    <nav class="bg-gray-100 border-b border-gray-200 px-6 py-2.5 dark:bg-gray-800">
      <div class="flex justify-between items-center max-w-screen-xl mx-auto">
        <!-- Logo and Title -->
        <a href="/" class="flex items-center">
          <img src="{{ asset('images/logofinal.png') }}" class="h-16" alt="Logo MUPOL">
          <span class="ml-3 text-lg font-semibold dark:text-white">Mutelle de la Police Nationale</span>
        </a>
  
        <!-- Mobile Menu Button -->
        <button id="menu-toggle" class="lg:hidden p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
  
        <!-- Links -->
        <div id="menu" class="hidden lg:flex space-x-6">
          <a href="#" class="text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">Adhésions</a>
          <a href="#" class="text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">Support</a>
          <a href="#" class="text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">Contact</a>
        </div>
      </div>
  
      <!-- Mobile Menu -->
      <div id="mobile-menu" class="hidden flex-col space-y-4 mt-2 lg:hidden">
        <a href="#" class="block text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">Adhésions</a>
        <a href="#" class="block text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">Support</a>
        <a href="#" class="block text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">Contact</a>
      </div>
    </nav>
  </header>
  
  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
  