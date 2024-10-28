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
            margin: 0;
            padding: 0;
        }
        
        .adhesion-form {
            width: 100%;
            max-width: 900px;
            margin: 20px auto;
            padding: 10px;
            background-color: white;
            color: black;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .column {
            flex: 1;
            text-align: center;
        }
        
        .line {
            width: 50px;
            height: 2px;
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
        
        .main-title {
            text-align: center;
            margin-bottom: 20px;
        }
        
        h2 {
            font-size: 20px;
            margin: 0;
        }
        
        h1.highlight {
            font-size: 16px;
            color: white;
            background-color: black;
            display: inline-block;
            padding: 5px 10px;
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
        
    </style>
</head>
<body>
    <div class="adhesion-form">
        <div class="header">
            <!-- Left column -->
            <div class="column">
                <p>MUTUELLE DE LA POLICE NATIONALE</p>
                <div class="line"></div>
                <p>CONSEIL D'ADMINISTRATION</p>
                <div class="line"></div>
                <p>SECRÉTARIAT GÉNÉRAL</p>
            </div>
            
            <!-- Logo -->
            <div class="logo">
                <img src="images/logofinal.png" alt="Logo" class="logo-img">
            </div>
            
            <!-- Right column -->
            <div class="column">
                <p>BURKINA FASO</p>
                <p>Unité - Progrès - Justice</p>
            </div>
        </div>

        <!-- Title -->
        <div class="main-title">
            <h2>FORMULAIRE D'ADHÉSION</h2>
            <h1 class="highlight">À REMPLIR EN CARACTÈRES D'IMPRIMERIE</h1>
        </div>

        <!-- Section: References -->
        <div class="section">
            <h3>RÉFÉRENCES DE L'ADHÉRENT</h3>
            <p><strong>Matricule :</strong> 12345678</p>
            <div class="inline">
                <p><strong>NIP :</strong> 87654321</p>
                <p><strong>CNIB :</strong> 0123456789</p>
            </div>

            <div class="inline">
                <p><strong>DÉLIVRÉE LE :</strong> 01/01/2022</p>
                <p><strong>EXPIRE LE :</strong> 01/01/2032</p>
            </div>
            <p><strong>Adresse :</strong> Ouagadougou, Burkina Faso</p>
            <div class="inline">
                <p><strong>Téléphone :</strong> 70 00 00 00</p>
                <p><strong>Email :</strong> exemple@example.com</p>
            </div>
        </div>

        <!-- Section: État civil -->
        <div class="section">
            <h3>ÉTAT CIVIL</h3>
            <p><strong>Nom :</strong> Ouango</p>
            <p><strong>Prénom(s) :</strong> Cornélie</p>
            <p><strong>Lieu de naissance :</strong> Ouagadougou</p>
            <p><strong>Département :</strong> Kadiogo</p>
            <p><strong>Ville / Village :</strong> Ouagadougou</p>
            <p><strong>Pays :</strong> Burkina Faso</p>
            <p><strong>Genre :</strong> Féminin</p>
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
