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


    <div class="min-h-screen ml-64 bg-gray-50 dark:bg-gray-900 py-3"
        style="background-image: url('{{ asset('images/background3.jpg') }}'); background-size: cover; background-position: center;">
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
                        <button type="submit" class="btn ">Rechercher</button>
                    </div>
                </form>

                <!-- Conteneur pour afficher les résultats -->
                <div id="search-results" class="adherent-table-container mt-6">
                    @if (isset($adherent))
                        <div class="section-title">{{--2.--}} INFORMATION DU MUTUALISTE</div>
                        <table class="adherent-table">
                            
                            <tbody>
                                <tr>
                                    <td>Code ID</td>
                                    <td><input type="text" readonly class="input-field" value=" {{ $adherent->code_carte }} "></td>
                                </tr>
                                <tr>
                                    <td>Nom et Prénoms</td>
                                    <td><input type="text" readonly class="input-field" value=" {{ $adherent->nom }}  {{ $adherent->prenom }}"></td>
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
</x-guest-layout>
