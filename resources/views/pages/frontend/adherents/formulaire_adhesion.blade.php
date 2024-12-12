<x-guest-layout>
    <x-preloader/>

    <x-header-guest/>

    <section class="section bg-gray-100">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="bg-white  rounded-lg overflow-hidden transform transition duration-500">
                <!-- Image de fond atténuée avec Overlay translucide -->
                <div class="relative h-64 bg-cover bg-center rounded-t-lg sm:block hidden" style="background-image: url('{{ asset('images/caroussel/caroussel7.jpeg') }}');">
                    <div class="absolute inset-0 bg-gradient-to-r from-white to-transparent opacity-70"></div>
                </div>

                <!-- Contenu Principal -->
                <div class="px-0 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12 text-gray-700">
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-semibold text-center text-gray-800 mb-4 sm:mb-6">Formulaire d'adhésion</h3>
                    
                    <!-- Formulaire d'Adhésion -->
                    <div class="relative z-10">
                        <livewire:wizard-membership />
                    </div>

                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
