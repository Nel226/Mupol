<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 10pt;
        /* margin: 0;
        padding: 0;
        width: 210mm; /* Largeur A4 */
        /*height: 297mm; Hauteur A4 */
    }

    /* ----------------------------- REFERENCES ADHERENT -------------------------------- */

    .width-70 {
        width: 70%;
    }
    .width-30 {
        width: 30%;
    }
    .width-90 {
        width: 90%;
    }
    .width-95 {
        width: 97%;
    }

    /* ----------------------------- ETAT CIVIL -------------------------------- */
    .etat-civil p {
        margin: 0;
        padding: 0;
        line-height: 20px;
        font-weight: 400;
        
    }
    .etat-civil p {
        margin: 0;
        padding: 0;
        
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    .table th,
    .table td {
        border: 2px solid rgb(36, 36, 36);
        padding: 10px;
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
        margin-top: 4px;
    }

    legend {
        font-size: 1rem;
        padding: 0 10px;
    }

    .footer ul {
        margin-top: 5px;
        list-style-type: circle;
    }

    .header-left p {
        margin: 0;
        
    }
    .custom-scroll::-webkit-scrollbar {
        width: 6px; /* Largeur verticale */
        height: 6px; /* Largeur horizontale */
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background-color: #3490dc; /* Couleur de la barre */
        border-radius: 10px; /* Coins arrondis */
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background-color: #1d72b8; /* Couleur au survol */
    }

    .custom-scroll::-webkit-scrollbar-track {
        background-color: #f1f1f1; /* Couleur de l'arrière-plan */
    }

    .text-small {
        font-size: 8pt; 
    }
    .text-10pt {
        font-size: 10pt;
    }
    .text-9pt {
        font-size: 10pt;
    }
    .text-8pt {
        font-size: 8pt;
    }
    .text-small-footer {
        font-size: 8pt; 
        list-style-type: circle !important;
        margin-left: 15px;
    }
    #custom-list .circle {
        display: inline-block;
        width: 4px; /* Taille du cercle */
        height: 4px;
        background-color: black; /* Couleur du cercle */
        border-radius: 50%; /* Rend l'élément circulaire */
        margin-right: 5px; /* Espace entre le cercle et le texte */
    }



    
</style>

<div id="formulaire-adhesion" x-data="{}" x-init="data = JSON.parse($el.getAttribute('data'))"
    class="overflow-x-auto border-4 bg-gray-500 custom-scroll">

    <div class="  adhesion-form max-w-4xl border mx-auto p-10 bg-white shadow-lg rounded-lg" style="min-width: 640px;">
        <div class="flex justify-between items-center mx-auto pb-2 w-11/12 mb-2">
            <!-- Colonne 1 -->
            <div class="header-left flex flex-col space-y-1 items-center text-center leading-none self-start">
                <p><strong>MUTUELLE DE LA POLICE NATIONALE</strong></p>
                <div class="border-t-2 border-black  w-1/4"></div> <!-- Trait -->
                <p><strong>CONSEIL D'ADMINISTRATION</strong></p>
                <div class="border-t-2 border-black  w-1/4"></div> <!-- Trait -->
                <p><strong>SECRÉTARIAT GÉNÉRAL</strong></p>
            </div>
    
            <!-- Colonne 2 (Logo) -->
            <div class="flex h-full items-center self-start">
                <img src="{{ asset('images/logofinal.png') }}" alt="Logo" class="h-full w-20 object-contain">
            </div>
    
            <!-- Colonne 3 -->
            <div class=" header- right flex flex-col self-start text-center space-y-1 leading-none">
                <p><strong>BURKINA FASO</strong></p>
                <p>Unité - Progrès - Justice</p>
            </div>
        </div>
    
        <!-- Titre principal -->
        <div class="flex flex-col items-center space-y-0 w-11/12 mx-auto">
            <h2 class="text-center text-2xl font-bold mt-0">FORMULAIRE D'ADHÉSION</h2>
    
            <!-- Sous-titre avec surlignage -->
            <h1 class="text-center text-white font-bold bg-black px-3 py-1 inline-block">
                À REMPLIR EN CARACTÈRES D'IMPRIMERIE
            </h1>
        </div>
        
        <!--  : Références adhérent -->
        <div class="  border-t border-gray-300 mt-2 pt-2 w-11/12 mx-auto">
            <div class="flex">
                <!-- Colonne Références -->
                <div class="width-70 text-10pt">
                    <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1 py-1">RÉFÉRENCES DE L'ADHÉRENT</h3>
    
                    <div>
                        <p><strong>MATRICULE :</strong> {{ $matricule }}</p>
                    </div>
    
                    <!-- NIP et CNIB sur la même ligne -->
                    <div class="flex space-x-0 leading-none mb-1">
                        <p class="flex-1"><strong>NIP :</strong> {{ $this->nip }}</p>
                        <p class="flex-1"><strong>CNIB :</strong> {{ $this->cnib }}</p>
                    </div>
    
                    <div class="flex space-x-4">
                        <!-- Colonne pour DÉLIVRÉE LE et la date -->
                        <div class="flex-1 w-1/2">
                            <div class="flex">
                                <!-- Première colonne : DÉLIVRÉE LE et (JJ/MM/AAAA) -->
                                <div class="flex-shrink-0">
                                    <p class="mr-1 leading-none"><strong>DÉLIVRÉE LE :</strong></p>
                                    <p class="text-8pt leading-none"><small>(JJ/MM/AAAA)</small></p>
                                </div>
    
                                <!-- Deuxième colonne : valeur de la date de délivrance -->
                                <div class="flex-1">
                                    <p class="leading-none">{{ $this->delivree }}</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="flex  w-1/2">
                            <!-- Première colonne : EXPIRE LE et (JJ/MM/AAAA) -->
                            <div class="flex-shrink-0">
                                <p class="mr-1 leading-none"><strong>EXPIRE LE :</strong></p>
                                <p class="text-8pt leading-none"><small>(JJ/MM/AAAA)</small></p>
                            </div>
    
                            <div class="flex-1">
                                <p class="leading-none">{{ $this->expire }}</p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Colonne Signature -->
                <div class="width-30 items-center px-2 justify-center flex flex-col">
                    <h3 class="text-8pt underline decoration-solid pt-1 "><strong>SIGNATURE DE L’ADHÉRENT</strong></h3>
                    <div class="w-full flex-grow border-2 border-black mt-1 flex items-center justify-center">
                    </div>
                </div>
            </div>
    
            <div class="text-10pt">
                <p><strong>ADRESSE :</strong> {{ $this->adresse_permanente }}</p>
            </div>
    
            <div class="flex space-x-4 text-10pt">
                <p class="flex-1"><strong>TÉLÉPHONE :</strong> {{ $this->telephone }}</p>
                <p class="flex-1"><strong>EMAIL :</strong> {{ $this->email }}</p>
            </div>
        </div>
    
    
        <!--  : État civil -->
        <div class=" etat-civil border-t border-gray-300 mt-1 pt-3 w-11/12 mx-auto">
    
            <h3 class="text-1xl font-semibold bg-gray-500 py-1 px-auto px-1">ÉTAT CIVIL</h3>
    
            <div class="flex text-10pt">
                <div class="w-3/4">
                    <div class="flex-1 mt-1">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <p class="mr-1"><strong>NOM</strong></p>
                                <p class="mr-1"><strong>PRÉNOM(S)</strong></p>
                            </div>
        
                            <div class="flex-1">
                                <p> <strong>:</strong> {{ $this->nom }}</p>
                                <p> <strong>:</strong> {{ $this->prenom }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 mt-0">
                        <!-- Colonne 1 : Lieu de naissance -->
                        <div class="flex-shrink-0">
                            <p><strong>LIEU DE NAISSANCE </strong></p>
                        </div>
    
                        <!-- Colonne 2 : Barre verticale -->
                        <div class="border-l-2 border-gray-400 h-16 mx-2"></div>
    
                        <!-- Colonne 3 : Infos supplémentaires -->
                        <div class="flex-1">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <p class="mr-1"><strong>DÉPARTEMENT</strong></p>
                                    <p class="mr-1"><strong>VILLE / VILLAGE</strong></p>
                                    <p class="mr-1"><strong>PAYS</strong></p>
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
                        <p class="mr-2"><strong class="mr-1">GENRE
                                :</strong>{{ $this->genre == 'masculin' ? 'Masculin' : 'Féminin' }}</p>
                    </div>
                </div>
            </div>
    
            
            <div class="flex-1 text-10pt">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <p class="mr-1"><strong>NOM DU PÈRE</strong></p>
                        <p class="mr-1"><strong>NOM DE LA MÈRE</strong></p>
                    </div>

                    <div class="flex-1">
                        <p> <strong>:</strong> {{ $this->nom_pere }}</p>
                        <p> <strong>:</strong> {{ $this->nom_mere }}</p>
                    </div>
                </div>
            </div>
        </div>
    
    
        <!--  : Informations Personnelles -->
        <div class=" border-t border-gray-300 mt-2 pt-3 w-11/12 mx-auto">
            <h3 class="text-1xl font-semibold bg-gray-500 px-auto px-1 py-1">INFORMATIONS PERSONNELLES</h3>
    
            <div class="text-10pt mt-1">
                <p><strong>SITUATION MATRIMONIALE :</strong> {{ $this->situation_matrimoniale }} </p>
            </div>
    
            <fieldset class=" text-10pt border-2 border-black leading-none py-1 rounded-lg">
                <legend class="font-semibold text-10pt bg-white pr-2 mx-4 flex items-center">
                    PERSONNE À PRÉVENIR EN CAS DE BESOIN
                </legend>
                <div class="px-1">
                    <p><strong>NOM & PRÉNOM(S) :</strong> {{ $this->nom_prenom_personne_besoin }} </p>
    
                    <div class="flex space-x-4"> <!-- Flexbox avec un espace entre les éléments -->
                        <p class="flex-1"><strong>LIEU DE RÉSIDENCE :</strong>
                            {{ $this->lieu_residence }}</p>
                        <p class="flex-1"><strong>TÉLÉPHONE :</strong>
                            {{ $this->telephone_personne_prevenir }}</p>
                    </div>
                </div>
            </fieldset>
    
            <div class="pt-4 text-center text-xl font-bold">
                <h2 class=" leading-none">LISTE DES AYANTS DROITS</h2>
            </div>
            <table class="table text-9pt leading-none w-full border-collapse border-2 border-black text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-400">N°</th>
                        <th class="border border-gray-400">NOM</th>
                        <th class="border border-gray-400">PRÉNOM(S)</th>
                        <th class="border border-gray-400">SEXE</th>
                        <th class="border border-gray-400">DATE DE NAISSANCE</th>
                        <th class="border border-gray-400">LIEN DE PARENTÉ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($this->nombreAyantsDroits > 0)
                        @foreach ($this->ayantsDroits as $index => $ayantDroit)
                            <tr>
                                <td class="border border-gray-400">{{ $index + 1 }}</td>
                                <td class="border border-gray-400">{{ $ayantDroit['nom'] }}</td>
                                <td class="border border-gray-400">{{ $ayantDroit['prenom'] }}</td>
                                <td class="border border-gray-400">
                                    @if ($ayantDroit['sexe'] === 'M')
                                        Homme
                                    @elseif ($ayantDroit['sexe'] === 'F')
                                        Femme
                                    @else
                                        Non spécifié
                                    @endif
                                </td>
                                <td class="border border-gray-400">{{ $ayantDroit['date_naissance'] }}</td>
                                <td class="border border-gray-400">{{ $ayantDroit['relation'] }}</td>
                            </tr>
                        @endforeach
                    @else
                        @for ($i = 0; $i < 6; $i++)
                            <tr>
                                <td class="border border-gray-400">{{ $i + 1 }}</td>
                                <td class="border border-gray-400">-</td>
                                <td class="border border-gray-400">-</td>
                                <td class="border border-gray-400">-</td>
                                <td class="border border-gray-400">-</td>
                                <td class="border border-gray-400">-</td>
                            </tr>
                        @endfor
                    @endif
                </tbody>
            </table>
            
        </div>
    
        <!--  : Informations professionnelles -->
        <div class=" border-t border-gray-300 mt-2 pt-3 w-11/12 mx-auto">
            <h3 class="text-1xl font-semibold mb-2 bg-gray-500 px-auto px-1 py-1">INFORMATIONS PROFESSIONELLES</h3>
            
            <!-- Personnel Retraité -->
            @if ($this->statut === 'Retraité(e)')
                <div class="border text-10pt p-2 rounded-lg mb-2 leading-none">
                    <div class="text-center">
                        <p><strong>{{ $this->statut == 'Actif(ve)' ? 'Personnel en activité' : 'Personnel retraité' }}</strong></p>
                    </div>
                    <div>
                        <div>
                            <p><strong>DRADE :</strong> {{ $this->grade }}</p>
                        </div>
    
                    </div>
                    <div class="flex space-x-4">
                        <div class="flex-1 w-1/2">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <p class="mr-1 leading-none"><strong>DATE DÉPART À LA RETRAITE :</strong></p>
                                    <p class="text-9pt leading-none"><small>(JJ/MM/AAAA)</small></p>
                                </div>
                                <div class="flex-1">
                                    <p class="leading-none">{{ $this->departARetraite }}</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="flex  w-1/2">
                            <p><strong>N° CARFO :</strong> {{ $this->numeroCARFO }}</p>
                        </div>
    
                    </div>
                </div>
            @endif
            
            <!-- Personnel en Activité -->
            @if ($this->statut === 'Actif(ve)')
                <div class="border text-10pt px-2 rounded-lg leading-none">
                    <div class="text-center">
                        <p><strong>{{ $this->statut == 'Actif(ve)' ? 'Personnel en activité' : 'Personnel retraité' }}</strong></p>
                    </div>
                    <div>
                        <div>
                            <p><strong>GRADE :</strong> {{ $this->grade }}</p>
                        </div>
    
                        <div class="flex space-x-4">
                            <div class="flex-1 w-1/2">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <p class="mr-1 leading-none"><strong>DATE INTÉGRATION  :</strong></p>
                                        <p class="text-8pt leading-none"><small>(JJ/MM/AAAA)</small></p>
                                    </div>
                                    <div class="flex-1">
                                        <p class="leading-none">{{ $this->dateIntegration }}</p>
                                    </div>
                                </div>
                            </div>
    
                            <div class="flex  w-1/2 leading-none">
                                <div class="flex-shrink-0 leading-none">
                                    <p class="mr-1 leading-none"><strong>DATE DÉPART À LA RETRAITE :</strong></p>
                                    <p class="text-xs leading-none"><small>(JJ/MM/AAAA)</small></p>
                                </div>
    
                                <!-- Deuxième colonne : valeur de la date d'expiration -->
                                <div class="flex-1">
                                    <p class=" leading-none">{{ $this->dateDepartARetraite }}</p>
                                </div>
                            </div>
    
                        </div>
    
                        <div class="flex space-x-0">
                            <p class="flex-1"><strong>DIRECTION :</strong> {{ $this->direction }}</p>
                            <p class="flex-1"><strong>SERVICE :</strong> {{ $this->service }}</p>
                        </div>
                    </div>
                </div>
            @endif
            
            
            <div class="flex footer border-t border-gray-300 mt-2 pt-2">
                <!-- Colonne Références -->
                <div class="w-3/4 flex items-center justify-start">
                    <div class=" width-95 rounded-lg border-4 border-black font-semibold py-2 px-2">
    
                        <h3 class="text-8pt">JOINDRE DES PHOTOS RECENTES DE L'ADHÉRENT ET DES AYANTS DROITS</h3>
                        <div id="custom-list">
                            <ul class="text-small-footer">
                                <li>
                                    <span class="circle"></span>
                                    Joindre une copie de l’extrait de naissance de chaque enfant
                                </li>
                                <li>
                                    <span class="circle"></span>
                                    Joindre une copie de l’extrait de naissance et de la CNIB pour la ou le(s) conjoint(es)
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
    
                <!-- Colonne Signature -->
                <div class="w-1/4 items-center pl-3 justify-end flex-col ml-auto">
                    <h3 class="text-xs text-center underline decoration-solid " style="font-size: 10px;">VISA DU PRESIDENT DU CONSEIL D’ADMINISTRATION</h3>
                    <div class="width-full h-24 flex-grow border-2 border-black flex items-center justify-center">
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>

