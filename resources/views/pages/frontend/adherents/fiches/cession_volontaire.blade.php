<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cession Volontaire de Salaire</title>
    
    <style>
        @font-face {
            font-family: 'Open Sans';
            
            src: url('{{ public_path('fonts/OpenSans-Bold.ttf') }}') format('truetype');

            font-weight: 400;
        }
        
        @font-face {
            font-family: 'Open Sans';
            src: url('{{ public_path('fonts/OpenSans-Bold.ttf') }}') format('truetype');
            font-weight: 700;
        }
        
        body {
            font-family: 'Open Sans', sans-serif !important;
            margin: 20px;
            line-height: 1.2;
            font-weight: bold;
            font-size: 12px;
            text-align: justify;

        }
        .center-image-container {
            display: flex;
            justify-content: center;
        }
        {{--  p {
            margin-bottom: 10px;
        }  --}}
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table td, table th {
            padding: 8px;
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
            width: 50%; 
        }
        table.noborder td:nth-child(3) {
            width: 25%; 
        }
        table.noborder td {
            border: none;
            vertical-align: top;
            text-align: left; /* Alignement à gauche */
        }
        table.montants th, table.montants td {
            border: 1px solid black;
            text-align: center;
            line-height: 1.1;
        }
        .beneficiaire-info {
            display: -webkit-box;
            flex-direction: column;
            align-items: flex-start; 
        }

        header {
            position: fixed;
            top: -40px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            color: white;
            text-align: center;
            line-height: 35px;
        }
        footer {
            position: fixed; 
            bottom: -40px; 
            right: 20px;
            height: 50px; 
            text-align: right;

            /** Extra personal styles **/
            color: white;
        }
        {{--  #footer {
            position: fixed;
            right: 20px;
            bottom: 0;
            text-align: right;
            width: 100%; 

        }  --}}
        #footer .page:after {
            content: counter(page);
          
        }
        
    </style>
</head>
<body style="font-weight: bold" >
    @php
        use App\Helpers\ImageHelper;
        $logoDataUrl = ImageHelper::imageToDataUrl(public_path('images/logofinal.png'));

    @endphp
   
    <header>

        <div class="center-image-container" style="display: flex; justify-content: center; align-items: center;">
            <img src="{{ $logoDataUrl }}" style="display: block; margin: auto;" class="center-image" width="48px" height="48px" alt="Logo">
        </div>
    </header>
    
    <div class="mx-auto">
        <table style="border-collapse: collapse; width: 100%;">
            
            <tr>
                <td style="padding: 0px 0px 0px 0px; text-align: left; align-items: flex-start; ">
                    <strong style="text-transform: uppercase;">REGION : {{ $demandeAdhesion->region }}</strong>
                    
                </td>
                <td style="padding: 0px 0px 0px 0px; text-align: center; text-transform: uppercase;">
                    <strong>PROVINCE : {{ $demandeAdhesion->province }}</strong>
                </td>
                <td style="padding: 0px 0px 0px 0px; text-align: right; text-transform: uppercase;">
                    <strong>LOCALITE : {{ $demandeAdhesion->localite }}</strong>
                </td>
            </tr>
        </table>
        
        
        <p ><strong>MUTUELLE DE LA POLICE (MU-POL)</strong><br>
        
        
            Ouagadougou, secteur n°6<br>
            Avenue Kadiogo, 01 BP 4546<br>
            Ouagadougou 01, Burkina Faso<br>
            Tel : +226 06 88 17 74 / 51 03 87 35
        </p>

        <table class="noborder" style="border-collapse: collapse; width: 100%; font-family : Arial !important;">
            <tr style="line-height: 1;">
                <td></td>
                <td>
                    <h4 style="margin: 0; padding: 0;">
                        <u>
                            CESSION VOLONTAIRE DE SALAIRE
                        </u>
                    </h4>
                    <p style="margin-top: 2px; padding: 0;"><em>(Article 205 et suivants de l&apos;AUPSRVE)</em></p>
                </td>
                <td></td>
            </tr>
            <tr style="line-height: 1;">
                <td></td>
                <td>
                    <p style="margin: 0; padding: 0;"><strong>CEDANT :</strong> {{$demandeAdhesion->nom}} {{$demandeAdhesion->prenom}}</p>
                </td>
                <td></td>
            </tr>
            <tr style="line-height: 1;">
                <td></td>
                <td style="vertical-align: middle;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr style="line-height: 1;">
                            <td style="padding: 0; vertical-align: top;">
                                <strong>BENEFICIAIRE:</strong>
                            </td>
                            <td style="padding: 0; vertical-align: top;">
                                <strong>MU-POL : IB BANK-BURKINA FASO</strong>
                                <p style="margin: 0; padding: 0;">CODE BANQUE : BF 139</p>
                                <p style="margin: 0; padding: 0;">CODE GUICHET : 01002</p>
                                <p style="margin: 0; padding: 0;">NUMERO COMPTE : 004631300395</p>
                                <p style="margin: 0; padding: 0;">CLE RIB : 74</p>
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
        <div style="  text-align: justify;">

            <p>Devant nous, <strong>..........................................................</strong>, Président(e) du Tribunal de Grande Instance<br>
            Assisté de <strong>..........................................................</strong>, Greffier audit Tribunal<br>
            A comparu Mr/Mme <strong>{{$demandeAdhesion->nom}} {{$demandeAdhesion->prenom}}</strong>, Grade : <strong>{{$demandeAdhesion->grade}}</strong><br>
            Matricule <strong>{{$demandeAdhesion->matricule}}</strong> en service <strong>{{$demandeAdhesion->matricule}}</strong>.</p>
            <p>Qui déclare qu'il/elle est employé(e) par le MATDS<br>
            Qu'il/elle désire céder librement et de manière permanente ou non permanente par les présentes à la MU-POL les sommes indiquées dans le tableau ci-dessous :</p>
        </div>

        @php
            use App\Helpers\DemandeCategorieHelper;
            $cotisations = DemandeCategorieHelper::calculerCotisationMensuelleTotale($demandeAdhesion->nombreAyantsDroits, $demandeAdhesion->statut);
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

    <div class="mx-auto max-w-4xl" style="  text-align: justify;">
        
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
    <footer>
        <div id="footer">
            <p class="page"></p>
        </div>
    </footer>
</body>
</html>
