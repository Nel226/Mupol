<style>
    body {
        font-family: Arial, sans-serif;
        /* margin: 0;
        padding: 0;
        width: 210mm; /* Largeur A4 */
        /*height: 297mm; Hauteur A4 */
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .table th,
    .table td {
        border: 2px solid gray;
        padding: 8px;
    }

    .document {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        /* Pour centrer le contenu */
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    fieldset {
        margin-top: 10px;
    }

    legend {
        font-size: 1rem;
        padding: 0 10px;
    }

    ul {
        margin-top: 10px;
    }

    p {
        margin: 5px 0;
    }

    @media print {
        body {
            width: 210mm; /* Largeur A4 */
            height: 297mm; /* Hauteur A4 */
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact; /* Pour une impression fidèle aux couleurs */
        }

        .adhesion-form {
            margin: 0;
            padding: 0;
            box-shadow: none; /* Supprimer l'ombre lors de l'impression */
        }
    }
</style>

<div class="adhesion-form document w-a4 max-w-5xl mx-auto p-10 bg-white shadow-lg rounded-lg">
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
    <div class="flex flex-col items-center space-y-0 w-11/12 mx-auto">
        <h2 class="text-center text-3xl font-bold mt-0">FORMULAIRE D'ADHÉSION</h2>

        <!-- Sous-titre avec surlignage -->
        <h1 class="text-center text-1xl text-white font-bold bg-black px-3 inline-block">
            À REMPLIR EN CARACTÈRES D'IMPRIMERIE
        </h1>
    </div>
    
    <!-- Section : Références adhérent -->
    <div class="section border-t border-gray-300 mt-2 pt-3 w-11/12 mx-auto">
        <div class="flex">
            <!-- Colonne Références -->
            <div class="w-3/4">
                <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">RÉFÉRENCES DE L'ADHÉRENT</h3>

                <div>
                    <p><strong>Matricule :</strong> {{ $this->matricule }}</p>
                </div>

                <!-- NIP et CNIB sur la même ligne -->
                <div class="flex space-x-0 leading-none">
                    <p class="flex-1"><strong>NIP :</strong> {{ $this->nip }}</p>
                    <p class="flex-1"><strong>CNIB :</strong> {{ $this->cnib }}</p>
                </div>

                <div class="flex space-x-4">
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
                                <p>{{ $this->delivree }}</p>
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
                            <p>{{ $this->expire }}</p>
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

        <div>
            <p><strong>Adresse :</strong> {{ $this->adresse_permanente }}</p>
        </div>

        <div class="flex space-x-4">
            <p class="flex-1"><strong>Téléphone :</strong> {{ $this->telephone }}</p>
            <p class="flex-1"><strong>Email :</strong> {{ $this->email }}</p>
        </div>
    </div>


    <!-- Section : État civil -->
    <div class="section border-t border-gray-300 mt-1 pt-3 w-11/12 mx-auto">

        <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">ÉTAT CIVIL</h3>

        <div class="flex">
            <div class="w-3/4">
                <div class="mt-2">
                    <p><strong>Nom :</strong> {{ $this->nom }}</p>
                    <p><strong>Prénom(s) :</strong> {{ $this->prenom }}</p>
                </div>
                <div class="flex items-center space-x-2 mt-1">
                    <!-- Colonne 1 : Lieu de naissance -->
                    <div class="flex-shrink-0">
                        <p><strong>Lieu de naissance </strong></p>
                    </div>

                    <!-- Colonne 2 : Barre verticale -->
                    <div class="border-l-2 border-gray-400 h-16 mx-2"></div>

                    <!-- Colonne 3 : Infos supplémentaires -->
                    <div class="flex-1">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <p class="mr-1"><strong>Département</strong></p>
                                <p class="mr-1"><strong>Ville / Village</strong></p>
                                <div class="leading-none">
                                    <p class="mr-1"><strong>Pays</strong></p>
                                    {{-- <p class="text-xs"><small>(Si vous êtes né(e) hors du pays)</small></p> --}}
                                </div>
                            </div>

                            <div class="flex-1">
                                <p> <strong>:</strong> {{ $this->departement }}</p>
                                <p> <strong>:</strong> {{ $this->ville }}</p>
                                <p> <strong>:</strong> {{ $this->pays }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-1/4 flex items-center px-2 justify-center">
                <div class="w-full h-1/2 flex-grow border-2 border-black mt-2 flex items-center justify-center">
                    <p class="mr-2"><strong class="mr-1">Genre
                            :</strong>{{ $this->genre == 'masculin' ? 'Masculin' : 'Féminin' }}</p>
                </div>
            </div>
        </div>

        <p><strong>Nom du père :</strong> {{ $this->nom_pere }}</p>
        <p><strong>Nom de la mère :</strong> {{ $this->nom_mere }}</p>
    </div>


    <!-- Section : Informations Personnelles -->
    <div class="section border-t border-gray-300 mt-2 pt-3 w-11/12 mx-auto">
        <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1">INFORMATIONS PERSONNELLES</h3>

        <div>
            <p><strong>Situation matrimoniale :</strong> {{ $this->situation_matrimoniale }} </p>
        </div>

        <fieldset class="border-2 border-gray-400 leading-none rounded-lg">
            <legend class="font-semibold bg-white pr-2 mx-4 flex items-center">
                <span class="text-black text-lg">></span>
                Personnes à prévenir en cas de besoin
            </legend>
            <div class="px-1">
                <p><strong>Nom & Prénom(s) :</strong> {{ $this->nom_prenom_personne_besoin }} </p>

                <div class="flex space-x-4"> <!-- Flexbox avec un espace entre les éléments -->
                    <p class="flex-1"><strong>Lieu de résidence :</strong>
                        {{ $this->lieu_residence }}</p>
                    <p class="flex-1"><strong>Téléphone :</strong>
                        {{ $this->telephone_personne_prevenir }}</p>
                </div>
            </div>
        </fieldset>

        @if ($this->nombreAyantsDroits > 0)
            <div class="pt-4 text-center text-2xl font-bold">
                <h2 class=" leading-none">LISTE DES AYANTS DROITS</h2>
            </div>
            <table class="table leading-none w-full border-collapse border-2 border-gray-400 text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-400">N°</th>
                        <th class="border border-gray-400">Nom</th>
                        <th class="border border-gray-400">Prénom(s)</th>
                        <th class="border border-gray-400">Sexe</th>
                        <th class="border border-gray-400">Date de naissance</th>
                        <th class="border border-gray-400">Lien de parenté</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->ayantsDroits as $index => $ayantDroit)
                        <tr>
                            <td class="border border-gray-400">{{ $index + 1 }}</td>
                            <td class="border border-gray-400">{{ $ayantDroit['nom'] }}</td>
                            <td class="border border-gray-400">{{ $ayantDroit['prenom'] }}</td>
                            <td class="border border-gray-400">
                                @if ($ayantDroit['sexe'] === 'H')
                                    Homme
                                @elseif ($ayantDroit['sexe'] === 'F')
                                    Femme
                                @else
                                    Non spécifié
                                @endif
                            </td>
                            <td class="border border-gray-400">{{ $ayantDroit['date_naissance'] }}</td>
                            <td class="border border-gray-400">{{ $ayantDroit['lien_parente'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Section : Formations professionnelles -->
    <div class="section border-t border-gray-300 mt-2 pt-4 w-11/12 mx-auto">
        <h3 class="text-1xl font-semibold mb-2 bg-gray-500 px-auto px-1">INFORMATIONS PROFESSIONELLES</h3>
        
        <!-- Personnel Retraité -->
        @if ($this->statut === 'personnel_retraite')
            <div class="border p-2 rounded-lg mb-2 leading-none">
                <div class="text-center">
                    <p><strong>{{ $this->statut == 'personnel_active' ? 'Personnel en activité' : 'Personnel retraité' }}</strong></p>
                </div>
                <div>
                    <div>
                        <p><strong>Grade :</strong> {{ $this->grade }}</p>
                    </div>

                </div>
                <div class="flex space-x-4">
                    <div class="flex-1 w-1/2 leading-none">
                        <div class="flex leading-none">
                            <div class="flex-shrink-0 leading-none">
                                <p class="mr-1 leading-none"><strong>Date depart à la retraite :</strong></p>
                                <p class="text-xs leading-none"><small>(JJ/MM/AAAA)</small></p>
                            </div>
                            <div class="flex-1">
                                <p>{{ $this->departARetraite }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex  w-1/2 leading-none">
                        <p><strong>N° CARFO :</strong> {{ $this->numeroCARFO }}</p>
                    </div>

                </div>
            </div>
        @endif
        
        <!-- Personnel en Activité -->
        @if ($this->statut === 'personnel_active')
            <div class="border px-2 rounded-lg leading-none">
                <div class="text-center">
                    <p><strong>{{ $this->statut == 'personnel_active' ? 'Personnel en activité' : 'Personnel retraité' }}</strong></p>
                </div>
                <div>
                    <div>
                        <p><strong>Grade :</strong> {{ $this->grade }}</p>
                    </div>

                    <div class="flex space-x-4">
                        <div class="flex-1 w-1/2 leading-none">
                            <div class="flex">
                                <div class="flex-shrink-0 leading-none">
                                    <p class="mr-1 leading-none"><strong>Date d'intégration :</strong></p>
                                    <p class="text-xs leading-none"><small>(JJ/MM/AAAA)</small></p>
                                </div>
                                <div class="flex-1">
                                    <p>{{ $this->dateIntegration }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex  w-1/2 leading-none">
                            <div class="flex-shrink-0 leading-none">
                                <p class="mr-1 leading-none"><strong>Date de départ à la rétraite :</strong></p>
                                <p class="text-xs leading-none"><small>(JJ/MM/AAAA)</small></p>
                            </div>

                            <!-- Deuxième colonne : valeur de la date d'expiration -->
                            <div class="flex-1">
                                <p>{{ $this->dateDepartARetraite }}</p>
                            </div>
                        </div>

                    </div>

                    <div class="flex space-x-0">
                        <p class="flex-1"><strong>Direction :</strong> {{ $this->direction }}</p>
                        <p class="flex-1"><strong>Service :</strong> {{ $this->service }}</p>
                    </div>
                </div>
            </div>
        @endif
        
        
        <div class="flex">
            <!-- Colonne Références -->
            <div class="w-3/4 flex items-center justify-center">
                <div class="rounded-lg text-1xl border-2 border-black font-semibold px-1">

                    <h3>JOINDRE DES PHOTOS RECENTES DE L’ADHERENT ET DES AYANTS DROITS</h3>
                    <h3 class=" text-1xl font-semibol px-auto px-1">
                        	joindre une copie de l’extrait de naissance de chaque enfant
                    </h3>
                    <h3>
                        	joindre une copie de l’extrait de naissance et de la CNIB pour la ou le(s) conjoint(es)
                    </h3>
                </div>

            </div>

            <!-- Colonne Signature -->
            <div class="w-[20%] items-center px-2 justify-end flex-col ml-auto">
                <h3 class="text-xs text-center underline decoration-solid ">VISA DU PRESIDENT DU CONSEIL D’ADMINISTRATION</h3>
                <div class="w-full h-32 flex-grow border-2 border-black flex items-center justify-center">
                </div>
            </div>
        </div>
    </div>

</div>

