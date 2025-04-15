<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Compte créé</title>
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
    <div class="header">
        <div class="logo-email">
            <img src="{{ $message->embed(public_path() . '/images/logofinal.png') }}" alt="Logo" style="width: 150px" />
        </div>
        

        <h2>Création Compte d'Administration</h2>
    </div>
    <h3>Bonjour {{ $user->name }}</h3>
    <p>Votre compte d'administation a été créé avec succès.</p>
    <p>Email : {{ $user->email }}</p>
    <p>Rôle : {{ $role->name }}</p>

    <p>Vous pouvez maintenant vous connecter à votre compte d'administration en cliquant sur ce lien : https://mupol.bf/login .</p>


    <div class="footer">
        <p>Merci,</p>
        <p>L'équipe de la Mutuelle de la Police Nationale</p>
    </div>
</body>
</html>
