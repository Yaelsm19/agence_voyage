<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Pastport</title>
    <link rel="stylesheet" href="..\fichier_css\s_inscrire.css">
    <link rel="icon" href="../image/image_icône/Passport_logo.jpg">
</head>
<body>
    <h1>Inscription</h1>
    <form class="form-container" method="POST" action="traitement_inscription.php">
        <div class="form-groupe">
            <label for="prénom">Prénom :</label>
            <input type="text" name="prénom" id="prénom" placeholder="Votre prénom" required>
        </div>

        <div class="form-groupe">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" placeholder="Votre nom" required>
        </div>

        <div class="form-group">
            <label for="email">Adresse email :</label>
            <input type="email" id="email" name="email" placeholder="Adresse email" required>
        </div>

        <div class="form-groupe">
            <label for="telephone">Téléphone :</label>
            <input type="tel" name="telephone" id="telephone" placeholder="Numéro de téléphone" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe">
        </div>

        <div class="form-group">
            <label for="confirmation_password">Confirmation du mot de passe :</label>
            <input type="password" id="confirmation_password" name="confirmation_password" placeholder="Mot de passe*">
        </div>

        <div class="form-group">
            <button type="submit">S'inscrire</button>
        </div>
        <div class="bouton-retour">
            <a href="accueil.php">
                <button class="retour">
                    <img src="../Image/image_icône/en-arriere.png" alt="modifier">
                </button>
            </a>
            <div class="form-group">
                <h2>Si vous possédez déjà un compte <a href ="se_connecter.php">cliquez ici</a></h2>
            </div>

            <div class="form-group">
                <h3>En vous créant un compte vous accéptez nos  <a href ="condition_general.php">conditions générales d'utilisation</a></h3>
            </div>
        </div>
</form>
    <footer>
        <p>© 2025 Pastport - Tous droits réservés</p>
    </footer>
</body>
</html>
</html>