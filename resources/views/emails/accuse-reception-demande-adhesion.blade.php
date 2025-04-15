<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de votre demande d&apos;adhésion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background-color: #ffffff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container justify-normal">

        <div class="header">
            <div class="logo-email">
                <img src="{{ $message->embed(public_path() . '/images/logofinal.png') }}" alt="Logo" style="width: 150px" />
            </div>
            


            <h2>Accusé de réception de votre demande d'adhésion</h2>
        </div>

        <p>Bonjour / Bonsoir,</p>

        <p>Nous vous remercions d'avoir soumis votre demande d'adhésion.</p>

        <p>Nous vous informerons dès que votre demande sera traitée.</p>
        <p>Télécharger votre fiche de cession volontaire de salaire en pièce jointe en ci-dessous.</p>
        <p>Voici vos informations de connexion :</p>
        <p><strong>Email :</strong> {{ $demandeAdhesion->email }}</p>
        <p><strong>Mot de passe :</strong> {{ $generatedPassword }}</p>
        <p>Vous pouvez maintenant vous connecter à votre compte en cliquant sur ce lien : https://mupol.bf/login/user .</p>

        <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>

        <div class="footer">
            <p>Merci,</p>
            <p>L'équipe de la Mutuelle de la Police Nationale</p>
        </div>
    </div>
</body>
</html>
