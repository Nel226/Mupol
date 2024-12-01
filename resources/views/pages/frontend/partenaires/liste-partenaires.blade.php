<x-guest-layout>
    <x-preloader/>

    <x-header-guest/>

    <div class=" min-h-screen">
        
    
        <!-- Start Contact Us -->
        <section class="contact-us section">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        @php
                            // Tableau pour remplacer les types
                            $typeLabels = [
                                'hopital' => 'Hôpitaux',
                                // Vous pouvez ajouter d'autres types si nécessaire
                                'clinique' => 'Cliniques',
                                'pharmacie' => 'Pharmacies',
                            ];
                        @endphp
                        
                        @foreach ($groupedPartenaires as $type => $partenaires)
                            <div class="col-12 mb-4">
                                <!-- Titre du groupe avec remplacement si nécessaire -->
                                <h3 class="text-center text-base font-bold py-2">{{ $typeLabels[$type] ?? ucfirst($type) }}</h3> <!-- Remplace "hopital" par "Hôpitaux" -->
                                
                                <div class="row">
                                    @foreach ($partenaires as $partenaire)
                                        <div class="col-12 col-md-6 mb-4">
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

                                                <div class="col-12 col-md-9 m-0 mb-md-0">
                                                    <div class="row px-2">
                                                        <h5 class="mb-1 font-bold">{{ $partenaire->nom }}</h5>
                                                    </div>

                                                    <div class="row">

                                                        <!-- Détails -->
                                                        <div class="col-12 col-md-6 px-2 mb-3 mb-md-0">
                                                            
                                                            <p class="mb-0">
                                                                <strong>Téléphone :</strong> {{ $partenaire->telephone }}<br>
                                                                <strong>Email :</strong> {{ $partenaire->email }}<br>
                                                                <strong>Adresse :</strong> {{ $partenaire->adresse }}<br>
                                                                {{-- <strong>Localisation :</strong> {{ $partenaire->geolocalisation }} --}}
                                                            </p>
                                                        </div>
                        
                                                        <!-- Localisation -->
                                                        <div class="col-12 col-md-6 px-2 text-md-end">
                                                            <p class="mb-0">
                                                                <strong>Région :</strong> {{ $partenaire->region }}<br>
                                                                <strong>Province :</strong> {{ $partenaire->province }}<br>
                                                                <strong>Localisation :</strong> 
                                                                <!-- Lien vers la localisation -->
                                                                <a href="{{ $partenaire->geolocalisation }}" target="_blank" class="text-blue-500 hover:underline">
                                                                    Cliquez ici
                                                                </a>
                                                                
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </div>
    
    
    
    
    
	<!--/ End Contact Us -->
      

</x-guest-layout>
