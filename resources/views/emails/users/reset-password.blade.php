<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation de votre mot de passe</title>
</head>
<body>
    <h2>Réinitialisation de votre mot de passe</h2>
    <p>Bonjour,</p>
    <p>Vous avez demandé à réinitialiser votre mot de passe. Cliquez sur le lien ci-dessous pour procéder :</p>
    <a href="{{ route('admin.password.reset', $token) }}?email={{ $email }}">Réinitialiser mon mot de passe</a>
    <p>Si vous n'êtes pas à l'origine de cette demande, ignorez cet email.</p>
</body>
</html>
