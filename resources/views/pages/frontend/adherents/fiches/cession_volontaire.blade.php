<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cession Volontaire de Salaire</title>
    <style>
        body {
            font-family: "Calibri", Arial, sans-serif;
            margin: 20px;
            line-height: 1.2;
            font-size: 14px;
        }
        .center-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            text-align: center;
        }
        h4 {
            margin: 20px 0;
            text-decoration: underline;
        }
        p {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table td, table th {
            padding: 10px;
            text-align: left;
        }
        table th {
            border: 1px solid black;
        }
        .signature {
            display: flex;
            display: -webkit-box;
            margin-top: 50px;
            margin-bottom: 80px;
            
        }
        .signature p {
            text-decoration: underline;
        }
        .page-break {
            page-break-after: always;
        }
        .center {
            text-align: center;
        }
        .p-center {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        table.noborder {
            width: 100%;
        }
        table.noborder tr td {
            border: none;
        }
        table.noborder td:nth-child(1) {
            width: 25%; 
        }
        table.noborder td:nth-child(2) {
            width: 70%; 
        }
        table.noborder td:nth-child(3) {
            width: 5%; 
        }
        table.noborder td {
            border: none;
            padding: 5px;
            vertical-align: top;
            text-align: left; /* Alignement à gauche */
        }
        table.montants th, table.montants td {
            border: 1px solid black;
            text-align: center;
            line-height: 1.2 !important;
        }
        .beneficiaire-info {
            display: -webkit-box;
            flex-direction: column;
            align-items: flex-start; 
        }

        #footer {
            position: fixed;
            right: 20px;
            bottom: 0;
            text-align: right;
            width: 100%; 

        }
        #footer .page:after {
            content: counter(page);
        }
        
    </style>
</head>
<body>
    @php
        use App\Helpers\ImageHelper;
        $logoDataUrl = ImageHelper::imageToDataUrl(public_path('images/logofinal.png'));

    @endphp

    <div class="center-image-container">
        <img src="{{ $logoDataUrl }}" style="text-align: center; align-items: center; margin: auto;" class="center-image" width="48px" height="48px"  alt="Logo">
    </div>
    <div class="mx-auto">
        <table style="border-collapse: collapse; width: 100%;">
            <tr>
                <td style="padding: 0px 0px 0px 0px; text-align: left; text-transform: uppercase;">
                    <strong>REGION : {{ $demandeAdhesion->region }}</strong>
                </td>
                <td style="padding: 0px 0px 0px 0px; text-align: center; text-transform: uppercase;">
                    <strong>PROVINCE : {{ $demandeAdhesion->province }}</strong>
                </td>
                <td style="padding: 0px 0px 0px 0px; text-align: right; text-transform: uppercase;">
                    <strong>LOCALITE : {{ $demandeAdhesion->localite }}</strong>
                </td>
            </tr>
        </table>
        
        
        <p style="margin-top: 5px;"><strong>MUTUELLE DE LA POLICE (MU-POL)</strong><br>
        
        
        Ouagadougou, secteur n°6<br>
        Avenue Kadiogo, 01 BP 4546<br>
        Ouagadougou 01, Burkina Faso<br>
        Tel : +226 06 88 17 74 / 51 03 87 35</p>

        <table class="noborder">
            <tr>
                <td></td>
                <td>
                    <h4>CESSION VOLONTAIRE DE SALAIRE</h4>
                    <p><em>(Article 205 et suivants de l&apos;AUPSRVE)</em></p>
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <p><strong>CEDANT :</strong> {{$demandeAdhesion->nom}} {{$demandeAdhesion->prenom}}</p>
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="vertical-align: middle;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding-right: 5px;">
                                <strong>BENEFICIAIRE:</strong>
                            </td>
                            <td>
                                <span>MU-POL : IB BANK-BURKINA FASO</span>
                                <p style="margin: 0;">CODE BANQUE : BF 139</p>
                                <p style="margin: 0;">CODE GUICHET : 01002</p>
                                <p style="margin: 0;">NUMERO COMPTE : 004631300395</p>
                                <p style="margin: 0;">CLE RIB : 74</p>
                            </td>
                        </tr>
                    </table>
                </td>
                
                <td></td>
            </tr>
        </table>
        
        
        @php
            use App\Helpers\DateHelper;

            $dateActuelle = now()->format('Y-m-d'); 
            $dateEnLettres = DateHelper::convertirDateEnLettres($dateActuelle);
        @endphp

        <p>{{ $dateEnLettres }},</p>
        <p>Devant nous, <strong>..........................................................</strong>, Président(e) du Tribunal de Grande Instance<br>
        Assisté de <strong>..........................................................</strong>, Greffier audit Tribunal<br>
        A comparu Mr/Mme <strong>{{$demandeAdhesion->nom}} {{$demandeAdhesion->prenom}}</strong>, Grade : <strong>{{$demandeAdhesion->grade}}</strong><br>
        Matricule <strong>{{$demandeAdhesion->matricule}}</strong> en service <strong>{{$demandeAdhesion->matricule}}</strong>.</p>

        <p>Qui déclare qu'il/elle est employé(e) par le MATDS<br>
        Qu'il/elle désire céder librement et de manière permanente ou non permanente par les présentes à la MU-POL les sommes indiquées dans le tableau ci-dessous :</p>
        @php
            use App\Helpers\DemandeCategorieHelper;
            $cotisations = DemandeCategorieHelper::calculerCotisationMensuelleTotale($demandeAdhesion->nombreAyantsDroits);
        @endphp
        <table class="montants">
            <tr>
                <th rowspan="3">CATEGORIE {{$demandeAdhesion->categorie}} 
                    <p>({{$demandeAdhesion->nombreAyantsDroits}} ayant droit)</p>
                </th>
                <th>A prélever une seule fois le premier mois</th>
                <th colspan="2">A prélever mensuellement pour compter du 2ème mois</th>
                <th>Compte à créditer</th>
            </tr>
            <tr>
                <td>Frais d&apos;adhésion</td>
                <td>Cotisation mensuelle adhérent</td>
                <td>Cotisation mensuelle des ayants droits</td>
                <td rowspan="3">MU-POL : IB BANK-BURKINA FASO<br>CODE BANQUE : BF 139<br>CODE GUICHET : 01002<br>NUMERO COMPTE : 004631300395<br>CLE RIB : 74</td>
            </tr>
            <tr>
                <td>{{ number_format($cotisations['fraisAdhesion'], 0, ',', ' ') }} FCFA</td>
                <td>{{ number_format($cotisations['cotisationAdherent'], 0, ',', ' ') }} FCFA</td>
                <td>{{ number_format($cotisations['cotisationAyantsDroits'], 0, ',', ' ') }} FCFA</td>
            </tr>
            <tr>
                <td class="center"><strong>SOUS TOTAUX</strong></td>
                <td class="center"><strong>10 000 FCFA</strong></td>
                <td colspan="2" class="center"><strong>{{ number_format($cotisations['cotisationTotale'], 0, ',', ' ') }} FCFA</strong></td>

            </tr>
        </table>
    </div>
    <div id="footer">
        <p class="page"></p>
    </div>
    <div class="page-break"></div>

    <div class="mx-auto max-w-4xl">
        <div class="center-image-container">
            <img src="{{ $logoDataUrl }}" style="text-align: center; align-items: center; margin: auto; margin-top:5px; " class="center-image" width="48px" height="48px"  alt="Logo">
        </div>
        <p>Qu’en conséquence, il/elle déclare autoriser dès à présent au payeur général du trésor à lui retenir le montant de la mensualité mentionnée dans le tableau sur son salaire ou revenu,</p>
        <p>Nous avons donné acte à Mr/Mme <strong>{{$demandeAdhesion->nom}} {{$demandeAdhesion->prenom}}</strong><br>
        De ses déclarations, lesquelles seront notifiées à son employeur.</p>
        <p>Le cédant déclare décharger de toutes responsabilités quant aux paiements effectués dans ses conditions le payeur général du trésor. Cet engagement pourrait être révoqué par une demande écrite de sa part.</p>
        <p>De ce qui dessus, nous avons, les jours, mois susdit, dressé le présent procès-verbal que le/la comparant(e) a signé avec nous après lecture.</p>

        <div class="signature" style="width: 100%;">
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: left"> <p>Le cédant</p></td>
                    <td style="text-align: center"><p>Le Président du tribunal</p></td>
                    <td style="text-align: right"><p>Le Greffier</p></td>
                </tr>
                <tr>

                    <td style="text-align: left;">
                        <img  width="96px"  src="{{$demandeAdhesion->signature}}" alt="signatureCedant">
                       
                    </td>
                    <td style="text-align: center;">
                    </td>
                    <td style="text-align: right;">
                    </td>
                </tr>
            </table>
        </div>
        

        <p>Et nous MU-POL Ouagadougou, secteur n°6<br>
        Avenue Kadiogo, 01 BP 4546<br>
        Ouagadougou 01, Burkina Faso<br>
        Tel : +226 06 88 17 74 / 51 03 87 35</p>

        <p>Déclarons accepter la cession consentie par Mr/Mme <strong>{{$demandeAdhesion->nom}} {{$demandeAdhesion->prenom}}.</strong></p>
        <p style="text-decoration: underline;">Signature MU-POL</p>
        <p style="position: fixed; bottom: 50px; width: 100%; text-align: left;">
            Fait à Ouagadougou le, <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}.</strong>
        </p>
    </div>
    <div id="footer">
        <p class="page"></p>
    </div>
</body>
</html>
