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
            


            <h2>Réinitialisation de votre mot de passe</h2>
        </div>

        <p>Bonjour / Bonsoir,</p>

        <p>Vous avez demandé à réinitialiser votre mot de passe.</p>
        <p>Cliquez sur le bouton ci-dessous pour le réinitialiser :</p>
        <div style="justify-content: center; text-align: center;">

            <a href="{{ url('all-users/password/reset', $token) }}?email={{ $email }}&type={{ $type }}" 
            style="display: inline-block; padding: 10px 20px; color: white; background-color: #4000FF; text-decoration: none; border-radius: 5px; justify-content: center; ">
            Réinitialiser mon mot de passe
            </a>
        </div>
    
        <p>Si vous n'avez pas demandé cette réinitialisation, ignorez cet email.</p>

        <div class="footer">
            <p>Merci,</p>
            <p>L'équipe de la Mutuelle de la Police Nationale</p>
        </div>
    </div>
</body>
</html>
