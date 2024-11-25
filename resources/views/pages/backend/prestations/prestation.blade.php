<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header, .footer {
            text-align: center;
        }
        .content {
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .details-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .details-column {
            width: 48%; /* Ajustez la largeur des colonnes si nécessaire */
        }
        .details-label {
            font-weight: bold;
        }
        .details-row {
            margin-bottom: 10px;
        }
        .stamp {
            text-align: right;
            margin-top: 20px;
        }
        .stamp img {
            max-width: 200px; /* Ajustez la taille de l'image selon vos besoins */
            vertical-align: middle;
        }
        .underline {
            border-bottom: 1px solid lightgray;
            padding-bottom: 2px; /* Ajustez selon vos besoins */
        }
        .center-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            text-align: center;
        }
        .flex-container {
            display: flex;
            align-items: center; /* Aligne verticalement les éléments */
            justify-content: space-between;
        }
        
        @media print {
            img {
                max-width: 100%;
                height: auto;
            }
        }
        
    </style>
</head>
<body>
    <div class="center-image-container">
        <img style="text-align: center; align-items: center; margin: auto;" class="center-image" width="128px" height="128px" src="{{ $logoDataUrl }}" alt="Logo">
    </div>
    
    
    <div class="header">
        <h3>Reçu de paiement N°#{{ $prestation->idPrestation }}</h3>
    </div>
    <div class="content">
        <div class="details-container">
            <div class="details-column">
                <div class="details-row">
                    <span class="details-label">Nom :</span>
                    <span>{{ $prestation->adherentNom }}</span>
                </div>
                <div class="details-row">
                    <span class="details-label">Prénom :</span>
                    <span>{{ $prestation->adherentPrenom }}</span>
                </div>
                <div class="details-row">
                    <span class="details-label">Sexe :</span>
                    <span>{{ $prestation->adherentSexe }}</span>
                </div>
                <div style="margin-top: 30px;" class="details-row">
                    <span class="details-label">Acte :</span>
                    <span>{{ $prestation->acte }}</span>
                </div>
                <div class="details-row">
                    <span class="details-label">Type :</span>
                    <span>{{ $prestation->type }}</span>
                </div>
                <div class="details-row">
                    <span class="details-label">Sous-Type :</span>
                    <span>{{ $prestation->sous_type ?? 'N/A' }}</span>
                </div>
            </div>
            <div class="details-column">
                <div class="details-row">
                    <span class="details-label">Centre de santé :</span>
                    <span>{{ $prestation->centre }}</span>
                </div>
            </div>
        </div>

        <h5>Détails du Paiement</h5>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Montant Total</td>
                    <td>{{ $prestation->montant }} F CFA</td>
                </tr>
                <tr>
                    <td>Montant Modérateur (20%)</td>
                    <td>{{$prestation->montant }} F CFA</td>
                </tr>
                <tr>
                    <td>Montant Mutuelle (80%)</td>
                    <td>{{ $prestation->montant}} F CFA</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>Tous solidaires pour notre bien-être!</p>
        <p>Munapol, payé par <strong>{{ Auth::user()->name }}</strong> , le {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        <div class="stamp">
            <img src="{{ asset('images/cachet.png') }}" />
        </div>
    </div>
</body>
</html>
