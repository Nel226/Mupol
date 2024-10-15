<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cession Volontaire de Salaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.5;
            font-size: 14px;
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
            margin-top: 50px;
            justify-content: space-between;
            margin-bottom: 80px;
        }
        .signature p {
            text-align: center;
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
        /* Suppression des bordures inutiles et uniformisation de la taille des colonnes */
        table.noborder {
            width: 100%;
        }
        table.noborder tr td {
            border: none;
        }
        table.noborder td:nth-child(1) {
            width: 25%; /* Colonne gauche à 25% */
        }
        table.noborder td:nth-child(2) {
            width: 50%; /* Colonne centrale à 50% */
        }
        table.noborder td:nth-child(3) {
            width: 25%; /* Colonne droite à 25% */
        }
        table.noborder td {
            border: none;
            padding: 5px;
            vertical-align: top;
            text-align: left; /* Alignement à gauche */
        }
        /* Style pour le tableau avec le contenu des montants */
        table.montants th, table.montants td {
            border: 1px solid black;
            text-align: center;
        }
        .beneficiaire-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start; 
        }
        
    </style>
</head>
<body>
    <div class="mx-auto">
        <p><strong>REGION :</strong> .............................. <strong>PROVINCE :</strong> ......................................... <strong>LOCALITE :</strong> ....................................</p>
        <p><strong>MUTUELLE DE LA POLICE (MU-POL)</strong><br>
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
                    <p><strong>CEDANT :</strong> ............................................................</p>
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="vertical-align: middle;">
                    <div style=" display : flex; ;">
                        <div>
                            <strong>BENEFICIAIRE :</strong> 
                        </div>
                        <div style="margin-left: 5px">
                            <span>MU-POL : IB BANK-BURKINA FASO</span>
                            <p style="margin: 0;">CODE BANQUE : BF 139</p>
                            <p style="margin: 0;">CODE GUICHET : 01002</p>
                            <p style="margin: 0;">NUMERO COMPTE : 004631300395</p>
                            <p style="margin: 0;">CLE RIB : 74</p>
                        </div>
                    </div>
                </td>
                <td></td>
            </tr>
        </table>
        
        

        <p>L&apos;an deux mille vingt quatre :</p>
        <p>Devant nous, <strong>..........................................................</strong>, Président(e) du Tribunal de Grande Instance<br>
        Assisté de <strong>..........................................................</strong>, Greffier audit Tribunal<br>
        A comparu Mr/Mme <strong>..........................................................</strong>, Grade : <strong>......................</strong><br>
        Matricule <strong>..........................................................</strong> en service <strong>..................................................</strong></p>

        <p>Qui déclare qu'il/elle est employé(e) par le MATDS<br>
        Qu'il/elle désire céder librement et de manière permanente ou non permanente par les présentes à la MU-POL les sommes indiquées dans le tableau ci-dessous :</p>

        <table class="montants">
            <tr>
                <th rowspan="3">CATEGORIE {{$demandeAdhesion->categorie}}</th>
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
                <td>10 000</td>
                <td>5 000</td>
                <td>8 000</td>
            </tr>
            <tr>
                <td class="center"><strong>SOUS TOTAUX</strong></td>
                <td class="center"><strong>10 000</strong></td>
                <td colspan="2" class="center"><strong>13 000</strong></td>
            </tr>
        </table>
    </div>

    <div class="page-break"></div>

    <div class="mx-auto max-w-4xl">
        <p>Qu’en conséquence, il/elle déclare autoriser dès à présent au payeur général du trésor à lui retenir le montant de la mensualité mentionnée dans le tableau sur son salaire ou revenu,</p>
        <p>Nous avons donné acte à Mr/Mme <strong>..........................................................</strong><br>
        De ses déclarations, lesquelles seront notifiées à son employeur.</p>
        <p>Le cédant déclare décharger de toutes responsabilités quant aux paiements effectués dans ses conditions le payeur général du trésor. Cet engagement pourrait être révoqué par une demande écrite de sa part.</p>
        <p>De ce qui dessus, nous avons, les jours, mois susdit, dressé le présent procès-verbal que le/la comparant(e) a signé avec nous après lecture.</p>

        <div class="signature">
            <p >Le cédant </p>
            <p>Le Président du tribunal </p>
            <p>Le Greffier </p>
        </div>

        <p>Et nous MU-POL Ouagadougou, secteur n°6<br>
        Avenue Kadiogo, 01 BP 4546<br>
        Ouagadougou 01, Burkina Faso<br>
        Tel : +226 06 88 17 74 / 51 03 87 35</p>

        <p>Déclarons accepter la cession consentie par Mr/Mme <strong>..........................................................</strong></p>
        <p style="text-decoration: underline;">Signature MU-POL</p>
        <p style="margin-top: 20%;">Fait à Ouagadougou le ..........................................................</p>
    </div>
</body>
</html>
