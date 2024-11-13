<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formulaire d&apos;Adhésion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            /* margin: 20px; */
            line-height: 1.2;
        }
        .vertical-align {
            vertical-align: top;
        }
        
        .adhesion-form {
            width: 100%;
            background-color: white;
            color: black;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* border: 1px solid black; */
        }
        tr, td {
            /* padding: 0; */
            /* border: 1px solid black; */
        }

        /* .eta_civil{
            width: 10%;
        } */

        .main-title {
            text-align: center;
            /* margin-bottom: 20px; */
        }

        .title-form {
            
        }

        h4.highlight {
            font-size: 14px;
            color: white;
            background-color: black;
            display: inline-block;
            padding: 2px 10px;
        }

        /* --------------------------- Infos personnelles ------------------- */
        .personal-information {
            margin-top: 4px;
        }
        
        .column {
            flex: 1;
            text-align: center;
        }
        
        .line {
            width: 50px;
            height: 1px;
            background-color: black;
            margin: 5px auto;
        }
        
        .logo {
            text-align: center;
            flex: 0 0 100px;
        }
        
        .logo-img {
            width: 80px;
        }
        
        
        
        h2 {
            font-size: 20px;
            margin: 0;
        }
        
        
        
        .section {
            margin-top: 20px;
            border-top: 1px solid black;
            padding-top: 10px;
        }
        
        .inline {
            display: flex;
            justify-content: space-between;
        }
        
        p {
            margin: 5px 0;
        }
        
        h3 {
            font-size: 16px;
            margin: 10px 0;
        }

        /* ------------------------------------------------------------------------------------------ */
        .references-container .marital-container .personal-information {
            border-top: 1px solid black; /* Couleur gris clair */
            margin-top: 0.5rem; /* mt-2 */
            padding-top: 0.75rem; /* pt-3 */
            width: 100%; /* w-11/12 */
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 1rem; /* text-1xl */
            font-weight: 600; /* font-semibold */
            
        }

        .references-table tr {
            padding-bottom: 20px;
            padding-top: 20px;
        }

        .signature-title {
            font-size: 0.75rem; /* text-xs */
            text-decoration: underline; /* underline */
        }

        .signature-box {
            /* width: 100%; */
            height: 95px;
            flex-grow: 1;
            border: 1px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* -------------------------------- ETAT VIVIL -------------------------------- */
        .gender-box {
            width: 80%;
            margin: auto; 
            height: 50px;
            border: 1px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .genre-infoperson {
            vertical-align: middle;
            justify-content: center;
            align-items: center;
        }

        /* ---------------------------- INFORMATIONS PERSONNELLES -------------------------------- */
        .personal-information .section-title {

        }
        .title-beneficiary {
            text-align: center;
        }

        .title-header-ad {
            border: 1px solid black;
        }
        .tableau-ayantsDroits {
            border-collapse: collapse; 
            width: 100%; /* Ajuste la largeur du tableau si nécessaire */
            border-spacing: 0;
        }

        .tableau-ayantsDroits th,
        .tableau-ayantsDroits td {
            border: 1px solid black; /* Définit la bordure autour des cellules */
            padding: 4px; /* Ajoute de l'espace à l'intérieur des cellules */
        }

        .tableau-ayantsDroits th {
            background-color: #d3d1d1; /* Couleur d'arrière-plan des en-têtes pour mieux les distinguer */
        }


        /* --------------------------- Footer ------------------------ */
        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
        }

        .text-photo {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box; /* Pour éviter les débordements */
        }

        .text-photo-content {
            border: 2px solid black;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            text-align: center;
            width: 100%; /* S'assure que l'élément prend toute la largeur disponible */
        }

        .text-photo h3 {
            margin: 5px 0;
            font-size: 12px;
        }

        .instructions {
            font-weight: 500;
            margin: 5px 0;
        }

        .signature-conseil-admin {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-left: auto;
            padding: 0 10px;
            box-sizing: border-box; /* Pour inclure padding/bordures */
        }

        .signature-conseil-admin-title {
            font-size: 12px;
            text-align: center;
            text-decoration: underline;
        }

        .signature-conseil-admin-box {
            width: 100%;
            height: 8rem;
            border: 2px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer-table

        
    </style>
</head>
<body>
    <div class="adhesion-form">
        <div class="header">
            <table>
                <tr>
                    <td style="padding: 0px; text-align: left; text-transform: uppercase; vertical-align: top; width: 33%; white-space: nowrap;">
                        <div style="display: inline-block; text-align: center;">
                            <p>MUTUELLE DE LA POLICE NATIONALE</p>
                            <div class="line"></div>
                            <p>CONSEIL D'ADMINISTRATION</p>
                            <div class="line"></div>
                            <p>SECRÉTARIAT GÉNÉRAL</p>
                        <div>
                    </td>

                    <td style="text-align: center; width: 34%;">
                        <img src="images/logofinal.png" alt="Logo" class="logo-img">
                    </td>

                    <td style="padding: 0px; text-align: right; vertical-align: top; width: 33%; white-space: nowrap;">
                        <div style="display: inline-block; text-align: center;">
                            <p>BURKINA FASO</p>
                            <p>Unité - Progrès - Justice</p>
                        <div>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Title -->
        <div class="main-title">
            <h1 class="title-form">FORMULAIRE D'ADHÉSION</h1>
            <h4 class="highlight">À REMPLIR EN CARACTÈRES D'IMPRIMERIE</h4>
        </div>

        <!--  : Références adhérent -->
        <div class="references-container section">
            <table class="references-table">
                <tr>
                    <td style="width: 75%; background-color: #6b7280; padding: 2px;">
                        <strong class="section-title">RÉFÉRENCES DE L'ADHÉRENT</strong>
                    </td>

                    <td style="width: 25%;">
                        <strong class="signature-title">SIGNATURE DE L’ADHÉRENT</strong>
                    </td>
                </tr>
                <tr style="padding: 4px 0px;">
                    <td style="width: 75%;">
                        <div>
                            <p><strong>Matricule :</strong> {{ $demandeAdhesion->matricule }}</p>
                        </div>
    
                        <!-- NIP et CNIB sur la même ligne -->
                        <table>
                            <tr>
                                <td  colspan="2" style="width: 80%">
                                    <strong>NIP :</strong> {{ $demandeAdhesion->nip }}
                                </td>
                                <td  colspan="2" style="width: 20%">
                                    <strong>CNIB :</strong> {{ $demandeAdhesion->cnib }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 18%">
                                    <strong style="display: block;">DÉLIVRÉE LE :</strong>
                                    <small style="display: block;">(JJ/MM/AAAA)</small>
                                </td>
                                <td class="vertical-align" style="width: 32%">
                                    {{ $demandeAdhesion->delivree }}
                                </td>

                                <td style="width: 15%">
                                    <strong style="display: block;">EXPIRE LE :</strong>
                                    <small style="display: block;">(JJ/MM/AAAA)</small>
                                </td>
                                <td class="vertical-align" style="width: 35%">
                                    {{ $demandeAdhesion->expire }}
                                </td>
                            </tr>
                        </table>
                    </td>

                    <!-- Colonne Signature -->
                    <td style="width: 25%; vertical-align: top;">
                        <div class="signature-box"></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p><strong>Adresse permanente :</strong> {{ $demandeAdhesion->adresse_permanente }}</p>
                    </td>
                </tr>
                
                <tr>
                    <td style="width: 50%">
                        <table>
                            <tr>
                                <td style="width: 50%">
                                    <p><strong>Téléphone :</strong> {{ $demandeAdhesion->telephone }}</p>
                                </td>
                                <td>
                                    <p><strong>Email :</strong> {{ $demandeAdhesion->email }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td >
                        
                    </td>
                </tr>
            </table>
        </div>

        <!-- Section: État civil -->
        <div class="marital-container section">
            <table>
                <tr style="padding: 0px;">
                    <td style="width: 100%; background-color: #6b7280; padding-top: 0px">
                        <strong class="section-title">ÉTAT CIVIL</strong>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="width: 75%;">
                        <table>
                            <tr>
                                <td class="eta_civil" style="width: 15%;"> <strong>Nom(s)</strong> </td>
                                <td colspan="2" style="width: 75%;"> <strong>:</strong> {{ $demandeAdhesion->nom }} </td>
                            </tr>

                            <tr>
                                <td style="width: 15%;"> <strong>Prénom(s)</strong> </td>
                                <td colspan="2" style="width: 75%;"> <strong>:</strong> {{ $demandeAdhesion->prenom }} </td>
                            </tr>
                        </table>
                            
                        <table>
                            <tr>
                                <td style="width: 12%;"> <strong>Lieu de naissance</strong> </td>

                                <td style="width: 1%; border-left: 1.2px solid gray; padding: 4px 0;"></td>
                                
                                

                                <td style="width: 86%;"> 
                                    <table>
                                        <tr>
                                            <td style="width: 17%;"> <strong>Département</strong></td>
                                            <td> <strong>:</strong> {{ $demandeAdhesion->departement }} </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 17%;"> <strong>Ville / Village</strong></td>
                                            <td> <strong>:</strong> {{ $demandeAdhesion->ville }} </td>
                                        </tr >
                                        <tr>
                                            <td style="width: 17%;"> <strong>Pays</strong></td>
                                            <td> <strong>:</strong> {{ $demandeAdhesion->pays }} </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 25%; justify-content: center; align-items: center;">
                        <div class="gender-box">
                            <strong class="genre-infoperson">Genre :</strong>{{ $demandeAdhesion->genre == 'masculin' ? 'Masculin' : 'Féminin' }}
                        </div>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="width: 25%;"> <strong>Nom et prénom(s) du père</strong> </td>
                    <td style="width: 75%;"> <strong>:</strong> {{ $demandeAdhesion->nom_pere }} </td>
                </tr>

                <tr>
                    <td style="width: 25%;"> <strong>Nom et prénom(s) de la mère</strong> </td>
                    <td style="width: 75%;"> <strong>:</strong> {{ $demandeAdhesion->nom_mere }} </td>
                </tr>
            </table>
        </div>
        
        <!-- Section: Informations personnelles -->
        <div class="personal-information section">
            <table>
                <tr style="padding: 0px;">
                    <td style="width: 100%; background-color: #6b7280; padding-top: 0px">
                        <strong class="section-title">INFORMATIONS PERSONNELLES</strong>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 20%;"> <strong>Situation matrimoniale :</strong></td>
                    <td style="width: 80%;"> {{ $demandeAdhesion->situation_matrimoniale }} </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 32%;"> <strong>Personne à prévenir en cas de besoin :</strong></td>
                    <td style="width: 68%;"> {{ $demandeAdhesion->nom_prenom_personne_besoin }} </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 17%;"><strong>Lieu de résidence :</td>
                    <td style="width: 53%;"> {{ $demandeAdhesion->lieu_residence }} </td>
                    <td style="width: 5%;"><strong>Tel :</strong></td>
                    <td style="width: 25%;"> {{ $demandeAdhesion->telephone_personne_prevenir }} </td>
                </tr>
            </table>
            <div class="title-beneficiary">
                <h3>Liste des ayants droits</h3>
            </div>
            <table class="tableau-ayantsDroits">
                <thead>
                    <tr>
                        <th class="title-header-ad">N°</th>
                        <th class="title-header-ad">Nom</th>
                        <th class="title-header-ad">Prénom(s)</th>
                        <th class="title-header-ad">Genre</th>
                        <th class="title-header-ad">Date de naissance</th>
                        <th class="title-header-ad">Lien de parenté</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($demandeAdhesion->nombreAyantsDroits > 0)
                        @foreach ($ayantsDroits as $index => $ayantDroit)
                            <tr>
                                <td> {{ $index + 1 }} </td>
                                <td> {{ $ayantDroit['nom'] }} </td>
                                <td> {{ $ayantDroit['prenom'] }} </td>
                                <td>
                                    @if ($ayantDroit['sexe'] === 'H')
                                        Homme
                                    @elseif ($ayantDroit['sexe'] === 'F')
                                        Femme
                                    @else
                                        Non spécifié
                                    @endif
                                </td>
                                <td> {{ $ayantDroit['date_naissance'] }} </td>
                                <td> {{ $ayantDroit['lien_parente'] }} </td>
                            </tr>
                        @endforeach
            
                        {{-- Ajoute des lignes vides si nécessaire --}}
                        @for ($i = count($ayantsDroits); $i < 6; $i++)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endfor
                    @else
                        {{-- Si aucun ayant droit, affiche 6 lignes vides --}}
                        @for ($i = 0; $i < 6; $i++)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endfor
                    @endif
                </tbody>
            </table>
            
        </div>

        <div class="informations-pro section">
            <table>
                <tr style="padding: 0px;">
                    <td style="width: 100%; background-color: #6b7280; padding-top: 0px">
                        <strong class="section-title">INFORMATIONS PROFESSIONNELLES</strong>
                    </td>
                </tr>
            </table>

            <!-- Personnel retraite -->
            @if ($demandeAdhesion->statut === 'personnel_retraite')
                <table>
                    <tr>
                        <td> <strong>Statut : </strong></td>
                        <td> Personnel retraité </td>
                        <td> <strong>Grade : </strong></td>
                        <td> {{ $demandeAdhesion->grade }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td> <strong>Date de départ à la retraite : </strong></td>
                        <td> {{ $demandeAdhesion->departARetraite }} </td>
                        <td>N° : </td>
                        <td> {{ $demandeAdhesion->numeroCARFO }} </td>
                    </tr>
                </table>
            @endif

            
            <!-- Personnel en activite -->
            @if ($demandeAdhesion->statut === 'personnel_active')
                <table>
                    <tr>
                        <td style="width: 7%"> <strong>Statut : </strong></td>
                        <td style="width: 43%"> Personnel en activité </td>
                        <td style="width: 7%"> <strong>Grade : </strong></td>
                        <td style="width: 43%"> {{ $demandeAdhesion->grade }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td style="width: 17%"> <strong>Date d'intégration : </strong></td>
                        <td style="width: 33%"> {{ \Carbon\Carbon::parse($demandeAdhesion->dateIntegration)->format('d/m/Y') }} </td>
                        <td style="width: 23%"> <strong>Date de départ à la retraite : </strong> </td>
                        <td style="width: 27%"> {{ \Carbon\Carbon::parse($demandeAdhesion->dateDepartARetraite)->format('d/m/Y') }} </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td style="width: 8%"><strong>Direction</strong></td>
                        <td style="width: 92%"> <strong>:</strong> {{$demandeAdhesion->direction}} </td>
                    </tr>
                    <tr>
                        <td style="width: 8%"><strong>Service</strong></td>
                        <td style="width: 92%"> <strong>:</strong> {{$demandeAdhesion->service}} </td>
                    </tr>
                </table>
            @endif
        </div>

        <table class="footer-table">
            <tr>
                <td style="width: 60%;">
                    <div class="text-photo">
                        <div class="text-photo-content">
                            <h3>JOINDRE DES PHOTOS RÉCENTES DE L'ADHÉRENT ET DES AYANTS DROITS</h3>
                            <ul style="list-style-type:disc;" class="instructions">
                                <li>Joindre une copie de l’extrait de naissance de chaque enfant</li>
                                <li>Joindre une copie de l’extrait de naissance et de la CNIB pour la ou le(s) conjoint(es)</li>

                            </ul>  
                            {{-- <h3 class="instructions">
                                 joindre une copie de l’extrait de naissance de chaque enfant
                            </h3>
                            <h3>
                                 joindre une copie de l’extrait de naissance et de la CNIB pour la ou le(s) conjoint(es)
                            </h3> --}}
                        </div>
                    </div>
                </td>
                
                <td style="width: 15%;"></td>

                <td style="width: 25%;">
                    <!-- Colonne Signature -->
                    <div class="signature-conseil-admin">
                        <h3 class="signature-conseil-admin-title">VISA DU PRESIDENT DU CONSEIL D’ADMINISTRATION</h3>
                        <div class="signature-conseil-admin-box">
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        

        

        <!-- Section: Informations professionnelles -->
        
    </div>
</body>
</html>
