<x-guest-layout >
    <style>
        
        .profile-container {
            display: flex;
            align-items: flex-start; /* Aligne les éléments en haut */
            gap: 2rem;
            justify-content: center; /* Centrer les éléments */
        }
        .adherent-table-container {
            width: 100%;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .section-title {
            background-color: #f9c513;
            font-weight: bold;
            text-align: center;
            padding: 0.5rem;
            color: white;
            border-radius: 8px;
        }
        .adherent-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .adherent-table td {
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }
        .adherent-table td:first-child {
            font-weight: bold;
        }
        /* Style pour la photo de profil */
        .profile-image {
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>

    <x-preloader/>

    @if (session()->has('message'))
        <div id="success-notification" class="notification bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification');
                
                setTimeout(() => {
                    notification.classList.add('hidden'); // Cache le message après 5 secondes
                }, 5000);
            });
        </script>
    @endif
    
    
    <div id="app-layout" class="layout-guest overflow-x-hidden flex">
        @include("components.navbar-guest-connected")
        <!-- app layout content -->
        <div 
        id="app-layout-content" 
        class="min-h-screen w-full transition-all duration-300 ease-out">
    
            @include("components.top-navbar-guest-connected")

            <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                <!-- title -->
                <h1 class="text-xl text-white">{{ $pageTitle }}</h1>
                
                
            </div>
            <div class="-mt-12 mx-6 mb-6 ">
            <section class="container mx-auto">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mx-auto max-w-4xl">
                    <div class="mb-6 text-center">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Profil du Partenaire</h2>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Informations détaillées du partenaire de santé.</p>
                    </div>
    
                    <!-- Conteneur des informations du partenaire -->
                    <div class="profile-container flex-col  md:flex-row gap-2"> <!-- Utilisation de flex-col pour mobile et flex-row pour les grands écrans -->
                        <!-- Section Photo -->
                        <div class="flex-shrink-0 w-full md:w-auto ">
                            
    
                            <img 
                                src="{{ $partenaire->photo 
                                    ? (Str::startsWith($partenaire->photo, 'images/') 
                                        ? asset($partenaire->photo) 
                                        : asset('storage/' . $partenaire->photo)) 
                                    : asset('images/default-placeholder.png') }}" 
                                alt="Photo de {{ $partenaire->nom }}" 
                                class="profile-image mx-auto"
                            >
                        </div>
    
                        <!-- Section Informations -->
                        <div class="adherent-table-container flex-1">
                            <div class="section-title">INFORMATIONS DU PARTENAIRE</div>
                            <div class="overflow-x-auto">
                                <table class="adherent-table">
                                    <tbody>
                                        <tr>
                                            <td>Nom</td>
                                            <td>{{ $partenaire->nom }}</td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td>{{ $partenaire->type }}</td>
                                        </tr>
                                        <tr>
                                            <td>Adresse</td>
                                            <td>{{ $partenaire->adresse }}</td>
                                        </tr>
                                        <tr>
                                            <td>Région</td>
                                            <td>{{ $partenaire->region }}</td>
                                        </tr>
                                        <tr>
                                            <td>Province</td>
                                            <td>{{ $partenaire->province }}</td>
                                        </tr>
                                        <tr>
                                            <td>Téléphone</td>
                                            <td>{{ $partenaire->telephone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $partenaire->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Géolocalisation</td>
                                            <td class=" flex-wrap underline text-primary1">{{ $partenaire->geolocalisation }}</td>
    
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
                
            
            </div>
            
            @include("components.footer-guest-connected")
        </div>
    </div>

    @include("components.scripts")

</x-guest-layout>


