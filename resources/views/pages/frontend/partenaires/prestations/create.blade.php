<x-guest-layout >
    <style>
        /* Styles spécifiques pour le conteneur */
        .adherent-table-container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
    
        .adherent-table-container table,
        .adherent-table-container th,
        .adherent-table-container td {
            border: 1px solid #000;
        }
    
        .adherent-table-container th,
        .adherent-table-container td {
            text-align: left;
            padding: 8px;
        }
    
        .adherent-table-container .section-title {
            background-color: #800080;
            font-weight: bold;
            text-align: center;
            padding: 5px;
            color: white;
            border: 1px solid #800080; /* Bordures violettes */
        }
    
        .adherent-table-container .input-field {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
            border: 1px solid #ccc;
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
        class="min-h-screen w-full  transition-all duration-300 ease-out">
    
            @include("components.top-navbar-guest-connected")

            <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                <!-- title -->
                <h1 class="text-xl text-white">{{ $pageTitle }}</h1>
                
            </div>
            <div class="-mt-12 mx-6 mb-6 ">
                <section class=" mx-auto ">
            
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 max-w-4xl mx-auto">
                        <div class="mb-6 text-center">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Recherche d&apos;adhérent</h2>
                            <p class="text-gray-600 dark:text-gray-300 mt-2">Entrez le code carte pour rechercher un adhérent.</p>
                        </div>
        
                        <form method="POST" action="{{ route('partenaire.searchAdherent') }}" class="mb-6">
                            @csrf
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-4 sm:space-y-0">
                                <input type="text" id="code_carte" name="code_carte" placeholder="Code carte" class="px-4 py-2 border rounded-lg w-full" required>
                                <button type="submit" class="btn ">Rechercher</button>
                            </div>
                        </form>
        
                        <!-- Conteneur pour afficher les résultats -->
                        <div id="search-results" class="adherent-table-container mt-6 overflow-x-auto">
                            @if (isset($adherent))
                                <div class="section-title">{{--2.--}} INFORMATION DU MUTUALISTE</div>
                                <table class="adherent-table">
                                    
                                    <tbody>
                                        <tr>
                                            <td>Code ID</td>
                                            <td>{{ $adherent->code_carte }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nom et Prénoms</td>
                                            <td>
                                                <strong>
                                                    {{ $adherent->nom }}  {{ $adherent->prenom }}

                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif (isset($message))
                                <p class="text-red-500">{{ $message }}</p>
                            @endif
                        </div>
                       
                    </div>
                    
                    
                </section>
                
            
            </div>
            
            @include("components.footer-guest-connected")
        </div>
    </div>

    @include("components.scripts")

</x-guest-layout>





