<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue à la MU-POL!</title>
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

            <h2>Bienvenue à la MU-POL!</h2>
        </div>


        <p>Votre compte a été créé avec succès en tant que partenaire de santé.</p>
        <p>Nous sommes ravis de vous compter parmi nos partenaires.</p>

        <p>Voici vos informations de connexion :</p>
        <ul>
            <li><strong>Email :</strong> {{ $email }}</li>
            <li><strong>Mot de passe temporaire :</strong> {{ $password }}</li>
        </ul>
        <p>Vous pouvez maintenant vous connecter à votre compte.</p>

        <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>

        <div class="footer">
            <p>Merci,</p>
            <p>L'équipe de la Mutelle de la Police Nationale</p>
        </div>
    </div>
</body>
</html>
