<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'inscription</title>
</head>
<body>
    <h1>Bonjour {{ $nom }} {{ $prenom }},</h1>

    <p>Votre inscription chez Touba Soft IT a bien été enregistrée.</p>
    <p>Votre entreprise : {{ $nom_entreprise }}</p>
    <p>Votre compte sera activé dans un délai d'une heure.</p>

    <p>Cordialement,</p>
    <p>L'équipe de Touba Soft IT</p>
</body>
</html>