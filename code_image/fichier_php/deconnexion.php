<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion Réussie</title>
    <link id="theme-stylesheet" rel="stylesheet" href="../fichier_css/variables_sombre.css">
    <link rel="stylesheet" href="../fichier_css/connexion_réussie.css">
    <meta http-equiv="refresh" content="2;url=accueil.php">
</head>
<body>
    <div class="message-connexion">
        <h2>Déconnexion réussie !</h2>
        <p>Vous allez être redirigé vers votre page d'accueil.</p>
    </div>
</body>
</html>