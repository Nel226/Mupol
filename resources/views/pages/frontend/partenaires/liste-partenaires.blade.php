<x-guest-layout>
    <x-preloader/>
    <x-header-guest/>

    <div class="min-h-screen">
        <!-- Start Contact Us -->
        <section class="contact-us section">
            <div class="container">
                <div class="inner">
                    <div class="">
                        @php
                            $typeLabels = [
                                'hopital' => 'Hôpitaux',
                                'clinique' => 'Cliniques',
                                'pharmacie' => 'Pharmacies',
                                'laboratoire' => 'Laboratoire d\'analyses médicales',
                                'opticien' => 'Opticiens',
                                'dentaire' => 'Cabinet dentaire',
                                'autre' => 'Autre',
                            ];
                        @endphp
                        <div class="pt-2">

                            <!-- Barre de recherche et filtres -->
                            <div class="col-12 mb-4">
                                <h4 class="mb-3 font-bold sm:text-base text-sm">Recherche et filtres</h4>
                                <div class="d-flex flex-wrap gap-3">
                                    <!-- Barre de recherche -->
                                    <div class="w-full text-sm sm:w-auto">
                                        <label for="searchBar" class="block mb-1 font-medium">Recherche par nom :</label>
                                        <input 
                                            type="text" 
                                            id="searchBar" 
                                            placeholder="Entrez un nom, une région, etc." 
                                            class="border rounded p-2 w-full text-xs"
                                            onkeyup="filterPartners()"
                                        >
                                    </div>
    
                                    <!-- Filtre par catégorie -->
                                    <div class="w-full sm:w-auto text-sm">
                                        <label for="filterType" class="block mb-1 font-medium">Filtrer par catégorie :</label>
                                        <select id="filterType" class="border rounded p-2 w-full text-xs" onchange="filterPartners()">
                                            <option value="">Toutes les catégories</option>
                                            @foreach ($typeLabels as $key => $label)
                                                <option value="{{ $key }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <!-- Filtre par région -->
                                    <div class="w-full sm:w-auto">
                                        <label for="filterRegion" class="block mb-1 text-sm font-medium">Filtrer par région :</label>
                                        <select id="filterRegion" class="border rounded p-2 w-full text-xs" onchange="filterPartners()">
                                            <option value="">Toutes les régions</option>
                                            <option value="Boucle du Mouhoun">Boucle du Mouhoun</option>
                                            <option value="Cascades">Cascades</option>
                                            <option value="Centre">Centre</option>
                                            <option value="Centre-Est">Centre-Est</option>
                                            <option value="Centre-Nord">Centre-Nord</option>
                                            <option value="Centre-Ouest">Centre-Ouest</option>
                                            <option value="Centre-Sud">Centre-Sud</option>
                                            <option value="Est">Est</option>
                                            <option value="Hauts-Bassins">Hauts-Bassins</option>
                                            <option value="Nord">Nord</option>
                                            <option value="Plateau-Central">Plateau-Central</option>
                                            <option value="Sahel">Sahel</option>
                                            <option value="Sud-Ouest">Sud-Ouest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Indicateur de chargement -->
                            <div id="loading" class="hidden absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                <div class="spinner-border animate-spin inline-block w-12 h-12 border-4 border-t-transparent border-gray-600 rounded-full" role="status">
                                    <span class="visually-hidden">...</span>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <!-- Liste des partenaires -->
                                <div id="partnerList" class="row">
                                    @foreach ($groupedPartenaires as $type => $partenaires)
                                        @foreach ($partenaires as $partenaire)
                                            <div 
                                                class="col-12 col-md-6 mb-4 partner-item opacity-0 transition-opacity duration-500 ease-in-out"
                                                data-type="{{ $type }}"
                                                data-region="{{ $partenaire->region }}"
                                                data-name="{{ strtolower($partenaire->nom) }}"
                                            >
                                                <div class="d-flex flex-wrap align-items-center border rounded shadow-sm p-3">
                                                    <!-- Photo -->
                                                    <div class="col-12 col-md-3 mb-3 px-1 py-3 mb-md-0">
                                                        <img 
                                                            src="{{ $partenaire->photo 
                                                                ? (Str::startsWith($partenaire->photo, 'images/') 
                                                                    ? asset($partenaire->photo) 
                                                                    : asset('storage/' . $partenaire->photo)) 
                                                                : asset('images/default-placeholder.png') }}" 
                                                            alt="{{ $partenaire->nom }}" 
                                                            class="rounded w-full h-auto object-cover"
                                                        >
                                                    </div>
        
                                                    <!-- Informations du partenaire -->
                                                    <div class="col-12 col-md-9">
                                                        <h5 class="mb-1 font-bold">{{ $partenaire->nom }}</h5>
                                                        <p class="mb-0 text-sm">
                                                            <strong>Téléphone :</strong> {{ $partenaire->telephone }}<br>
                                                            <strong>Adresse :</strong> {{ $partenaire->adresse }}<br>
                                                            <strong>Région :</strong> {{ $partenaire->region }}<br>
                                                            <strong>Province :</strong> {{ $partenaire->province }}
                                                            @if($partenaire->geolocalisation !== 'aucun')
                                                                <br>
                                                                <strong>Localisation :</strong>
                                                                <!-- Lien vers la localisation -->
                                                                <a href="{{ $partenaire->geolocalisation }}" target="_blank" class="text-blue-500 hover:underline">
                                                                    Cliquez ici
                                                                </a>
                                                            @endif


                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
        
                                <!-- Message "Aucun résultat trouvé" -->
                                <div id="noResults" class="col-12 text-center mt-4" style="display: none;">
                                    <p class="text-gray-500">Aucun résultat trouvé pour vos critères de recherche.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--/ End Contact Us -->

    <!-- Scripts pour la recherche et les filtres -->
    <script>
        function filterPartners() {
            document.getElementById("loading").classList.remove("hidden");

            const searchQuery = document.getElementById('searchBar').value.toLowerCase();
            const filterType = document.getElementById('filterType').value;
            const filterRegion = document.getElementById('filterRegion').value;

            const partners = document.querySelectorAll('.partner-item');
            let visibleCount = 0;

            if (!searchQuery && !filterType && !filterRegion) {
                partners.forEach(partner => {
                    partner.style.display = 'block';
                    partner.classList.remove('opacity-0');
                    partner.classList.add('opacity-100');
                });
                document.getElementById('noResults').style.display = 'none';
            } else {
                partners.forEach(partner => {
                    const name = partner.getAttribute('data-name');
                    const type = partner.getAttribute('data-type');
                    const region = partner.getAttribute('data-region');

                    const matchesSearch = name.includes(searchQuery);
                    const matchesType = !filterType || type === filterType;
                    const matchesRegion = !filterRegion || region === filterRegion;

                    if (matchesSearch && matchesType && matchesRegion) {
                        partner.style.display = 'block';
                        partner.classList.remove('opacity-0');
                        partner.classList.add('opacity-100');
                        visibleCount++;
                    } else {
                        partner.style.display = 'none';
                    }
                });
                // Affiche ou masque le message "Aucun résultat trouvé"
                const noResults = document.getElementById('noResults');
                noResults.style.display = visibleCount > 0 ? 'none' : 'block';
            }

            setTimeout(function() {
                document.getElementById("loading").classList.add("hidden");
            }, 500);
        }

        document.addEventListener('DOMContentLoaded', filterPartners);
    </script>
</x-guest-layout>
