<x-guest-layout>
    <x-header-guest />

    @if (session()->has('message'))
        <div id="success-notification" class="notification bg-green-500 text-white p-4 rounded mb-4 mx-6 mt-4 text-center shadow-lg">
            {{ session('message') }}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('success-notification');
                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 5000);
            });
        </script>
    @endif

    <x-sidebar-guest />

    <div class="min-h-screen ml-64 bg-gray-50 dark:bg-gray-900 py-3">
        <section class="container mx-auto px-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mx-auto max-w-4xl">
                <div class="mb-6 text-center">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Recherche d&apos;adhérent</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Entrez le code carte pour rechercher un adhérent.</p>
                </div>

                <form method="POST" action="{{ route('partenaire.searchAdherent') }}" class="mb-6">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <input type="text" id="code_carte" name="code_carte" placeholder="Code carte" class="px-4 py-2 border rounded-lg w-full" required>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Rechercher</button>
                    </div>
                </form>

                <!-- Conteneur pour afficher les résultats -->
                <div id="search-results" class="mt-6">
                    @if (isset($adherent))
                        <p class="text-green-500">Nom de l'adhérent : {{ $adherent->nom }}</p>
                    @elseif (isset($message))
                        <p class="text-red-500">{{ $message }}</p>
                    @endif
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
