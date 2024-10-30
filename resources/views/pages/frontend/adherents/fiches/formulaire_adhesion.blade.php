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
            /* border: 1px solid black; */
        }

        

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
        .references-container {
            border-top: 1px solid #d1d5db; /* Couleur gris clair */
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
            height: 50px;
            flex-grow: 1;
            border: 1px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
        }





.date-container {
    display: flex;
    gap: 1rem; /* space-x-4 */
}

.date-column {
    flex: 1; /* flex-1 */
}

.date-label {
    display: flex;
    align-items: flex-start;
}

.date-info {
    font-size: 0.75rem; /* text-xs */
    line-height: 1; /* leading-none */
}

.signature-column {
    width: 25%; /* w-1/4 */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0 0.5rem; /* px-2 */
}



.contact-info {
    display: flex;
    gap: 1rem; /* space-x-4 */
}

        
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
        <div class="references-container">
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
        <div class="marital-container">
            <table>
                <tr>
                    <td style="width: 100%; background-color: #6b7280; padding: 2px;">
                        <strong class="section-title">ÉTAT CIVIL</strong>
                    </td>
                </tr>

                <tr>
                    <td style="width: 75%">
                        <table>
                            <tr>
                                <td colspan="2" style="width: 15%;"> <strong>Nom :</strong> </td>
                                <td style="width: 75%;"> {{ $demandeAdhesion->nom }} </td>
                            </tr>

                            <tr>
                                <td colspan="2" style="width: 15%;"> <strong>Prénom(s) :</strong> </td>
                                <td style="width: 75%;"> {{ $demandeAdhesion->prenom }} </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 15%;"> <strong>Date de naissance :</strong> </td>
                                <td style="width: 75%;"> {{ $demandeAdhesion->date_naissance }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"> Lieu de naissance </td>
                                <td style="width: 5%;"> <div class="border-l-2 border-gray-400 h-16 mx-2"></div> </td>
                                <td> 
                                    <table>
                                        <tr>
                                            <td> <strong>Département : </strong></td>
                                            <td> {{ $demandeAdhesion->departement }} </td>
                                        </tr>
                                        <tr>
                                            <td> Ville / Village : </td>
                                            <td> {{ $demandeAdhesion->ville }} </td>
                                        </tr>
                                        <tr>
                                            <td> Pays : </td>
                                            <td> {{ $demandeAdhesion->pays }} </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td style="width: 25%;">
                        <div class="gender-box">
                            <strong class="mr-1">Genre :</strong>{{ $demandeAdhesion->genre == 'masculin' ? 'Masculin' : 'Féminin' }}
                        </div>
                    <td>
                </tr>

                <tr>
                    <td style="width: 20%;"> <strong>Nom du père :</strong> </td>
                    <td style="width: 80%"> {{ $demandeAdhesion->nom_pere }} </td>
                </tr>
                <tr>
                    <td style="width: 20%;"> <strong>Nom de la mère :</strong> </td>
                    <td> {{ $demandeAdhesion->nom_mere }} </td>
                </tr>
            </table>
            
        </div>
        
        <!-- Section: Personnes à prévenir -->
        <div class="section">
            <h3>Personnes à prévenir en cas de besoin</h3>
            <p><strong>Nom et prénom :</strong> Jean Doe</p>
            <p><strong>Lieu de résidence :</strong> Ouagadougou</p>
            <p><strong>Téléphone :</strong> 70 11 11 11</p>
        </div>

        <!-- Section: Ayants droits -->
        <div class="section">
            <h3>Ayants droits</h3>
            <p><strong>Nombre d'ayants droits :</strong> 2</p>
        </div>

        <!-- Section: Informations professionnelles -->
        <div class="section">
            <h3>Informations professionnelles</h3>
            <p><strong>Statut :</strong> Personnel en activité</p>
            <p><strong>Grade :</strong> Capitaine</p>
            <p><strong>Date d'intégration :</strong> 01/01/2010</p>
            <p><strong>Date de départ à la retraite :</strong> 01/01/2030</p>
            <p><strong>Direction :</strong> Police Nationale</p>
            <p><strong>Service :</strong> Sécurité Publique</p>
        </div>
    </div>
</body>
</html>
