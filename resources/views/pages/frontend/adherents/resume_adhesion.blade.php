<x-guest-layout>
    <x-header-guest/>
    <x-section-guest>
        @if (session()->has('message'))
            <x-succes-notification>
                {{ session('message') }}
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

        
        <div class="flex justify-end my-3">
            <a href="{{ route('download-form-adhesion', ['id' => $demandeAdhesion->id]) }}" >
                <x-primary-button>
                    Télécharger formulaire d&apos;adhesion
                </x-primary-button>
            </a>
        </div>
        
        <div class="adhesion-form max-w-4xl mx-auto p-10 bg-white shadow-lg rounded-lg">
            <div class="flex justify-between items-center mx-auto pb-2 w-11/12 mb-2">
                <!-- Colonne 1 -->
                <div class="flex flex-col space-y-1 items-center text-center leading-none self-start">
                    <p>MUTUELLE DE LA POLICE NATIONALE</p>
                    <div class="border-t-[2px] border-black  w-1/4"></div> <!-- Trait -->
                    <p>CONSEIL D'ADMINISTRATION</p>
                    <div class="border-t-[2px] border-black  w-1/4"></div> <!-- Trait -->
                    <p>SECRÉTARIAT GÉNÉRAL</p>
                </div>

                <!-- Colonne 2 (Logo) -->
                <div class="flex h-full items-center self-start">
                    <img src="{{ asset('images/logofinal.png') }}" alt="Logo" class="h-full w-20 object-contain">
                </div>

                <!-- Colonne 3 -->
                <div class="flex flex-col self-start text-center space-y-1 leading-none">
                    <p>BURKINA FASO</p>
                    <p>Unité - Progrès - Justice</p>
                </div>
            </div>

            <!-- Titre principal -->
            <div class="flex flex-col items-center space-y-0">
                <h2 class="text-center text-3xl font-bold mt-0">FORMULAIRE D'ADHÉSION</h2>

                <!-- Sous-titre avec surlignage -->
                <h1 class="text-center text-1xl text-white font-bold bg-black px-3 inline-block">
                    À REMPLIR EN CARACTÈRES D'IMPRIMERIE
                </h1>
            </div>


            <!-- Section : Références de l'adhérent -->
            <div class="section border-t border-gray-300 mt-6 pt-4">
                <div class="flex">
                    <!-- Colonne Références -->
                    <div class="w-3/4">
                        <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">RÉFÉRENCES DE L'ADHÉRENT</h3>

                        <div class="mt-2">
                            <p><strong>Matricule :</strong> {{ $demandeAdhesion->matricule }}</p>
                        </div>

                        <!-- NIP et CNIB sur la même ligne -->
                        <div class="flex space-x-0 mt-2">
                            <p class="flex-1"><strong>NIP :</strong> {{ $demandeAdhesion->nip }}</p>
                            <p class="flex-1"><strong>CNIB :</strong> {{ $demandeAdhesion->cnib }}</p>
                        </div>

                        <div class="flex space-x-4 mt-2">
                            <!-- Colonne pour DÉLIVRÉE LE et la date -->
                            <div class="flex-1 w-1/2 leading-none">
                                <div class="flex">
                                    <!-- Première colonne : DÉLIVRÉE LE et (JJ/MM/AAAA) -->
                                    <div class="flex-shrink-0 ">
                                        <p class="mr-1"><strong>DÉLIVRÉE LE :</strong></p>
                                        <p class="text-xs"><small>(JJ/MM/AAAA)</small></p>
                                    </div>
                            
                                    <!-- Deuxième colonne : valeur de la date de délivrance -->
                                    <div class="flex-1">
                                        <p>{{ $demandeAdhesion->delivree }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex  w-1/2 leading-none">
                                <!-- Première colonne : EXPIRE LE et (JJ/MM/AAAA) -->
                                <div class="flex-shrink-0 ">
                                    <p class="mr-1"><strong>EXPIRE LE :</strong></p>
                                    <p class="text-xs"><small>(JJ/MM/AAAA)</small></p>
                                </div>
                            
                                <!-- Deuxième colonne : valeur de la date d'expiration -->
                                <div class="flex-1">
                                    <p>{{ $demandeAdhesion->expire }}</p>
                                </div>
                            </div>
                            
                        </div>
        
                    </div>

                    <!-- Colonne Signature -->
                    <div class="w-1/4 items-center px-2 justify-center flex flex-col">
                        <h3 class="text-xs underline decoration-solid ">SIGNATURE DE L’ADHÉRENT</h3>
                        <div class="w-full flex-grow border-2 border-black mt-2 flex items-center justify-center">
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <p><strong>Adresse :</strong> {{ $demandeAdhesion->adresse }}</p>
                </div>

                <div class="flex space-x-4 mt-2">
                    <p class="flex-1"><strong>Téléphone :</strong> {{ $demandeAdhesion->telephone }}</p>
                    <p class="flex-1"><strong>Email :</strong> {{ $demandeAdhesion->email }}</p>
                </div>
            </div>


            <!-- Section : État civil -->
            <div class="section border-t border-gray-300 mt-4 pt-4">

                <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">ÉTAT CIVIL</h3>

                <div class="flex">
                    <div class="w-3/4">
                        <div class="mt-2">
                            <p><strong>Nom :</strong> {{ $demandeAdhesion->nom }}</p>
                            <p><strong>Prénom(s) :</strong> {{ $demandeAdhesion->prenom }}</p>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <!-- Colonne 1 : Lieu de naissance -->
                            <div class="flex-shrink-0 ">
                                <p><strong>Lieu de naissance </strong> {{ $demandeAdhesion->lieu_naissance }}</p>
                            </div>
                        
                            <!-- Colonne 2 : Barre verticale -->
                            <div class="border-l-2 border-gray-400 h-16 mx-2"></div>
                        
                            <!-- Colonne 3 : Infos supplémentaires -->
                            <div class="flex-1">
                                <div class="flex">
                                    <p class="w-32"><strong>Département</strong></p>
                                    <p> <strong class="text-right">:</strong> {{ $demandeAdhesion->departement }}</p>
                                </div>
                                <div class="flex">
                                    <p class="w-32 "><strong>Ville / Village</strong></p>
                                    <p> <strong class="text-right">:</strong> {{ $demandeAdhesion->ville }}</p>
                                </div>
                                <div class="flex">
                                    <p class="w-32"><strong>Pays</strong></p>
                                    <p> <strong class="text-right">:</strong> {{ $demandeAdhesion->pays }}</p>
                                </div>
                                <!-- Nouveau texte sous Pays -->
                                {{-- <p><small>(Si vous êtes né(e) hors du pays)</small></p> --}}
                            </div>
                        </div>
                    </div>
    
                    <div class="w-1/4 flex items-center px-2 justify-center">
                        <div class="w-full h-1/2 flex-grow border-2 border-black mt-2 flex items-center justify-center">
                            <p class="mr-2"><strong class="mr-1">Genre :</strong>{{ $demandeAdhesion->genre == 'masculin' ? 'Masculin' : 'Féminin' }}</p>
                        </div>
                    </div>
                </div>
                
                
                
                <p><strong>Nom du père :</strong> {{ $demandeAdhesion->nom_pere }}</p>
                <p><strong>Nom de la mère :</strong> {{ $demandeAdhesion->nom_mere }}</p>
            </div>

            <!-- Section : Personnes à prévenir -->
            <div class="section border-t border-gray-300 mt-6 pt-4">
                <h3 class="text-lg font-semibold">Personnes à prévenir en cas de besoin</h3>
                <p class="mt-2"><strong>Nom et prénom:</strong> {{ $demandeAdhesion->nom_prenom_personne_besoin }}
                </p>
                <p><strong>Lieu de résidence:</strong> {{ $demandeAdhesion->lieu_residence }}</p>
                <p><strong>Téléphone:</strong> {{ $demandeAdhesion->telephone_personne_prevenir }}</p>
            </div>

            <!-- Section : Ayants droits -->
            <div class="section border-t border-gray-300 mt-6 pt-4">
                <h3 class="text-lg font-semibold">Ayants droits</h3>
                <p class="mt-2"><strong>Nombre d'ayants droits:</strong> {{ $demandeAdhesion->nombreAyantsDroits }}
                </p>
                <!-- Ajouter la liste des ayants droits ici si nécessaire -->
            </div>

            <!-- Section : Informations professionnelles -->
            <div class="section border-t border-gray-300 mt-6 pt-4">
                <h3 class="text-lg font-semibold">Informations professionnelles</h3>
                <p class="mt-2"><strong>Statut:</strong>
                    {{ $demandeAdhesion->statut == 'personnel_active' ? 'Personnel en activité' : 'Personnel retraité' }}
                </p>
                <p><strong>Grade:</strong> {{ $demandeAdhesion->grade }}</p>
                <p><strong>Date d'intégration:</strong> {{ $demandeAdhesion->dateIntegration }}</p>
                <p><strong>Date de départ à la retraite:</strong> {{ $demandeAdhesion->dateDepartARetraite }}</p>
                <p><strong>Direction:</strong> {{ $demandeAdhesion->direction }}</p>
                <p><strong>Service:</strong> {{ $demandeAdhesion->service }}</p>
            </div>

        </div>
        
        <div class="container max-w-4xl my-3  p-10 bg-white shadow-lg rounded-lg mx-auto">
            <div class="flex justify-between my-3">
                <a href="{{ route('download-fiche-cession-volontaire', ['id' => $demandeAdhesion->id]) }}" >
                    <x-primary-button>
                        Télécharger cession volontaire
                    </x-primary-button>
                </a>
                <x-primary-button onclick="printIframe('iframeId')" style="background-color: #4CAF50; color: white; border: none; cursor: pointer;">
                    Imprimer 
                </x-primary-button>
            </div>
            <script>
                function printIframe(iframeId) {
                    var iframe = document.getElementById(iframeId);
                    if (iframe) {
                        var iframeWindow = iframe.contentWindow || iframe; // Access to the iframe's window object
                        iframeWindow.focus(); // Focus the iframe
                        iframeWindow.print(); // Trigger the print dialog for the iframe
                    } else {
                        console.error("L'iframe avec l'ID '" + iframeId + "' est introuvable.");
                    }
                }
        
                // Optionnel : Écouter le chargement complet de l'iframe avant d'activer le bouton d'impression
                document.addEventListener("DOMContentLoaded", function() {
                    var iframe = document.getElementById('iframeId'); // Utilisez ici l'ID correct
                    iframe.onload = function() {
                        console.log("Iframe chargé.");
                    };
                });
            </script>
            <h1 class="text-xl font-bold mb-4">Aperçu fiche de cession volontaire de salaire</h1>

            <div class="relative h-0 pb-[141.42%] shadow-lg">
                <iframe id="iframeId"
                    class="absolute inset-0 w-full h-full border-4 border-gray-500" 
                    src="{{ route('showCessionVolontaire', ['id' => $demandeAdhesion->id]) }}" 
                    allowfullscreen 
                    title="Fiche de cession volontaire de salaire"
                    aria-hidden="false" 
                    tabindex="0">
                </iframe>
            </div>
        
        </div>
    </x-section-guest>
</x-guest-layout>



