<x-guest-layout>
    <x-preloader/>
    <x-header-guest/>

    {{-- Breadcrumbs (commenté mais potentiellement utile si vous souhaitez l'ajouter plus tard) --}}
    {{--  
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Demande d&apos;adhésion MU-POL</h2>
                        <ul class="bread-list">
                            <li><a href="index.html">Accueil</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Adhérer</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}
    
    <section class="section bg-gray-100" style="background-image: url('{{ asset('images/background21.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container mx-auto px-0 sm:px-6 lg:px-8" >
            <div class="bg-white rounded-lg overflow-hidden transform transition duration-500" >
                <!-- Image de fond atténuée avec Overlay translucide -->
                <div class="relative h-48 sm:h-64 lg:h-80 bg-cover bg-center rounded-t-lg" style="background-image: url('{{ asset('images/caroussel/caroussel7.jpeg') }}');">
                    <div class="absolute inset-0 bg-gradient-to-r from-white to-transparent opacity-70"></div>
                </div>

                <!-- Contenu Principal -->
                <div class="px-0 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12 text-gray-700 "
				style="background-image: url('{{ asset('images/background9.png') }}'); background-size: cover; background-position: center;">
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-semibold text-center text-gray-800 mb-4 sm:mb-6 lg:mb-8">Formulaire d'adhésion</h3>

                    <!-- Formulaire d'Adhésion -->
                    <div class="relative z-10">
                        <livewire:wizard-membership />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-footer/>
</x-guest-layout>
