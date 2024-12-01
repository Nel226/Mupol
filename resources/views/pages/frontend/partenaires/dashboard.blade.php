<x-guest-layout class="main-container">
    <style>
        .main-container {
            display: flex;
            flex-direction: column; /* Changer pour colonne pour que tout soit centré */
            justify-content: center; /* Centrer verticalement */
            align-items: center; /* Centrer horizontalement */
            min-height: 100vh; /* Assurer que la page prend toute la hauteur */
        }
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
            background-color: #800080;
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

    <x-preloader />
    <x-header-guest />
    @if (session('success'))
        <x-succes-notification>
            {{ session('success') }}
        </x-succes-notification>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification-content');
                const closeBtn = document.getElementById('close-notification');
                notification.classList.remove('hidden');
                closeBtn.addEventListener('click', () => {
                    notification.classList.add('hidden');
                });
            });
        </script>
    @endif

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-3">
        <section class="container mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mx-auto max-w-4xl">
                <div class="mb-6 text-center">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Profil du Partenaire</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Informations détaillées du partenaire de santé.</p>
                </div>

                <!-- Conteneur des informations du partenaire -->
                <div class="profile-container flex-col md:flex-row gap-2"> <!-- Utilisation de flex-col pour mobile et flex-row pour les grands écrans -->
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
                                    <td>
                                        <!-- Affichage de la carte via iframe -->
                                        <iframe 
                                            src="https://www.google.com/maps?q={{ $partenaire->geolocalisation }}&hl=fr&z=14&output=embed" 
                                            width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
