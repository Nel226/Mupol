<x-guest-layout>
    <x-preloader/>
    <x-header-guest/>

    <div class="min-h-screen">
        <!-- Start Contact Us -->
        <section class="contact-us section">
            <div class="container">
                <div class="inner">
                    <div>
                        @php
                            $typeLabels = [
                                'hopital'    => 'Hôpitaux',
                                'clinique'   => 'Cliniques',
                                'pharmacie'  => 'Pharmacies',
                                'laboratoire'=> 'Laboratoire d\'analyses médicales',
                                'opticien'   => 'Opticiens',
                                'dentaire'   => 'Cabinet dentaire',
                                'autre'      => 'Autre',
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
                                            placeholder="Entrez un nom." 
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
    
                                    <!-- Filtre par région (généré dynamiquement) -->
                                    <div class="w-full sm:w-auto">
                                        <label for="filterRegion" class="block mb-1 text-sm font-medium">Filtrer par région :</label>
                                        <select id="filterRegion" class="border rounded p-2 w-full text-xs" onchange="onRegionChange()">
                                            <option value="">Toutes les régions</option>
                                            <!-- Options ajoutées dynamiquement -->
                                        </select>
                                    </div>
    
                                    <!-- Filtre par province -->
                                    <div class="w-full sm:w-auto">
                                        <label for="filterProvince" class="block mb-1 text-sm font-medium">Filtrer par province :</label>
                                        <select id="filterProvince" class="border rounded p-2 w-full text-xs" onchange="filterPartners()">
                                            <option value="">Toutes les provinces</option>
                                            <!-- Options ajoutées dynamiquement -->
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
                                                data-province="{{ $partenaire->province }}"
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
                                                            <strong>Adresse :</strong> {{ $partenaire->adresse }}<br>
                                                            <strong>Région :</strong> {{ $partenaire->region }}<br>
                                                            <strong>Province :</strong> {{ $partenaire->province }}<br>
                                                            <strong>Géolocalisation :</strong> <a href="{{ $partenaire->geolocalisation }}" class="underline text-primary1">Cliquez ici</a>
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
        
        // Génère dynamiquement les options du sélecteur des régions
        function populateRegions() {
            const regionSelect = document.getElementById("filterRegion");
            regionSelect.innerHTML = '<option value="">Toutes les régions</option>';
            Object.keys(regions).forEach(region => {
                const option = document.createElement("option");
                option.value = region;
                option.textContent = region;
                regionSelect.appendChild(option);
            });
        }

        // Génère les options du sélecteur des provinces pour **toutes** les régions (triées par ordre alphabétique)
        function populateProvinces() {
            const provinceSelect = document.getElementById("filterProvince");
            let allProvinces = [];
            Object.keys(regions).forEach(region => {
                allProvinces = allProvinces.concat(regions[region].provinces);
            });
            // Supprime les doublons
            allProvinces = [...new Set(allProvinces)];
            // Trie par ordre alphabétique
            allProvinces.sort((a, b) => a.localeCompare(b));
            provinceSelect.innerHTML = '<option value="">Toutes les provinces</option>';
            allProvinces.forEach(province => {
                const option = document.createElement("option");
                option.value = province;
                option.textContent = province;
                provinceSelect.appendChild(option);
            });
        }

        // Met à jour le sélecteur des provinces pour une région donnée (trié par ordre alphabétique)
        function updateProvinces(region) {
            const provinceSelect = document.getElementById("filterProvince");
            let provinces = regions[region] ? regions[region].provinces.slice() : [];
            provinces.sort((a, b) => a.localeCompare(b));
            provinceSelect.innerHTML = '<option value="">Toutes les provinces</option>';
            provinces.forEach(province => {
                const option = document.createElement("option");
                option.value = province;
                option.textContent = province;
                provinceSelect.appendChild(option);
            });
        }

        // Lorsque la région est modifiée : si une région est sélectionnée, afficher ses provinces, sinon afficher toutes les provinces
        function onRegionChange() {
            const selectedRegion = document.getElementById("filterRegion").value;
            if (selectedRegion) {
                updateProvinces(selectedRegion);
            } else {
                populateProvinces();
            }
            filterPartners();
        }

        // Filtre les partenaires en fonction des critères de recherche et de filtre
        function filterPartners() {
            document.getElementById("loading").classList.remove("hidden");

            const searchQuery   = document.getElementById('searchBar').value.toLowerCase();
            const filterType    = document.getElementById('filterType').value;
            const filterRegion  = document.getElementById('filterRegion').value;
            const filterProvince= document.getElementById('filterProvince').value;

            const partners = document.querySelectorAll('.partner-item');
            let visibleCount = 0;

            partners.forEach(partner => {
                const name     = partner.getAttribute('data-name');
                const type     = partner.getAttribute('data-type');
                const region   = partner.getAttribute('data-region');
                const province = partner.getAttribute('data-province');

                const matchesSearch  = name.includes(searchQuery);
                const matchesType    = !filterType || type === filterType;
                const matchesRegion  = !filterRegion || region === filterRegion;
                const matchesProvince= !filterProvince || province === filterProvince;

                if (matchesSearch && matchesType && matchesRegion && matchesProvince) {
                    partner.style.display = 'block';
                    partner.classList.remove('opacity-0');
                    partner.classList.add('opacity-100');
                    visibleCount++;
                } else {
                    partner.style.display = 'none';
                }
            });

            document.getElementById('noResults').style.display = visibleCount > 0 ? 'none' : 'block';

            setTimeout(function() {
                document.getElementById("loading").classList.add("hidden");
            }, 500);
        }

        // Initialisation à la charge du document
        document.addEventListener('DOMContentLoaded', function() {
            populateRegions(); // Remplit le sélecteur des régions
            // Si aucune région n'est sélectionnée, affiche toutes les provinces, sinon celles de la région sélectionnée
            const selectedRegion = document.getElementById('filterRegion').value;
            if (selectedRegion) {
                updateProvinces(selectedRegion);
            } else {
                populateProvinces();
            }
            filterPartners(); // Applique le filtre initial
        });
    </script>
</x-guest-layout>
