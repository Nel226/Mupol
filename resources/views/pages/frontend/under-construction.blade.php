<x-guest-layout>
    <x-preloader/>

    <x-header-guest/>
    
    <!-- Single News -->
    <section class="news-single section">
        <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12 col-12 bg-gray-100 dark:bg-gray-800 pb-3">
                            <div class=" flex flex-col justify-center items-center">
                              <img src="https://www.svgrepo.com/show/426192/cogs-settings.svg" alt="Logo" class="mb-8 h-40">
                              <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-center text-gray-700 dark:text-white mb-4">{{__('Bientôt disponible') }}</h1>
                              <p class="text-center text-gray-500 dark:text-gray-300 text-lg md:text-xl lg:text-2xl mb-8">{{__('Notre site est en construction, certaines pages ne sont pas encores disponibles.') }}</p>
                              <div class="flex space-x-4 ">
                                <a href="{{ route('contacts')}}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded dark:bg-gray-700 dark:hover:bg-gray-600">Nous contacter</a>
                                <a href="{{ route('accueil')}}" class="border-2 border-gray-800 text-black font-bold py-3 px-6 rounded dark:text-white dark:border-white">Accueil</a>
                              </div>
                            </div>

                        </div>
                        
                    </div>
                </div> 
			</div>
		</section>
	<!--/ End Single News -->
    <x-footer/>

</x-guest-layout>
