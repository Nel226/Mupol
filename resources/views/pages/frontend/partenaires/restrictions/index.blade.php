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
        class="min-h-screen w-full lg:pl-[15.625rem] transition-all duration-300 ease-out">
    
            @include("components.top-navbar-guest-connected")

            <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                <!-- title -->
                <h1 class="text-xl text-white">{{ $pageTitle }}</h1>
                
            </div>
            <div class="-mt-12 mx-6 mb-6 ">
                <section class="container mx-auto ">
            
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 max-w-4xl mx-auto">
                        <div class="relative overflow-hidden" style="padding-top: 56.25%; /* Aspect ratio 16:9 */">
                            <iframe 
                                src="{{ asset('pdf/Mupol-restrictions.pdf') }}" 
                                class="absolute top-0 left-0 w-full h-full" 
                                frameborder="0">
                            </iframe>
                        </div>
                    </div>
                    
                    
                </section>
                
            
            </div>
            
            @include("components.footer-guest-connected")
        </div>
    </div>

    @include("components.scripts")

</x-guest-layout>


