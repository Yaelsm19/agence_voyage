<?php
define('ACCES_AUTORISE_SESSION', true);
include('session.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacte - Pastport</title>
    <script src="../fichier_java/changer_mode.js"></script>
    <link id="theme-stylesheet" rel="stylesheet" href="../fichier_css/variables_sombre.css">
    <link rel="stylesheet" href="..\fichier_css\contact.css">
    <link rel="icon" href="../Image/image_icône/Passport_logo.jpg">
</head>
<body>
    <h1>Contactez-nous</h1>
    <div class="form-container">
        <form action="#" method="POST">
            <div class="form-groupe">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" placeholder="Votre nom" required>
            </div>

            <div class="form-groupe">
                <label for="prénom">Prénom :</label>
                <input type="text" name="prénom" id="prénom" placeholder="Votre prénom" required>
            </div>

            <div class="form-groupe">
                <label for="telephone">Téléphone :</label>
                <input type="tel" name="telephone" id="telephone" placeholder="Votre téléphone" required>
            </div>

            <div class="form-groupe">
                <label for="mail">E-mail :</label>
                <input type="email" name="mail" id="mail" placeholder="Votre e-mail" required>
            </div>

            <div class="form-groupe">
                <label for="motif">Motif de la demande :</label>
                <input type="text" name="motif" id="motif" placeholder="Raison de votre demande" required>
            </div>

            <div class="form-groupe">
                <label for="demande">Votre demande :</label>
                <textarea name="demande" id="demande" placeholder="Expliquez votre demande" required></textarea>
            </div>

            <div class="form-groupe">
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </div>
    <footer>
        <p>© 2025 Pastport - Tous droits réservés</p>
    </footer>
</body>
</html>
