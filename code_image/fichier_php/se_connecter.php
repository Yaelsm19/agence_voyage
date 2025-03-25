<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Pastport</title>
    <link rel="stylesheet" href="..\fichier_css\se_connecter.css">
    <link rel="icon" href="../image/image_icône/Passport_logo.jpg">
</head>
<body>
    <h1>Se connecter</h1>
    <form class="form-container" method="POST" action="traitement_connexion.php">
        <div class="form-group">
            <label for="email">Adresse email :</label>
            <input type="email" id="email" name="email" placeholder="Adresse email" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe">
        </div>
        <?php
        session_start();
        if (isset($_SESSION["error"])) {
            echo "<div style='color: red; margin-bottom: 10px;'>" . $_SESSION["error"] . "</div>";
            unset($_SESSION["error"]);
        }
        ?>
        <div class="form-group">
            <button type="submit">S'identifier</button>
        </div>
        <div class="bouton-retour">
            <a href="accueil.html">
                <button class="retour">
                    <img src="../Image/image_icône/en-arriere.png" alt="modifier">
                </button>
            </a>
            <div class="form-group">
                <h2>Si vous ne possédez pas encore de profil pour en créer un <a href ="s_inscrire.php">cliquez ici</a></h2>
            </div>
        </div>
</form>
    <footer>
        <p>© 2025 Pastport - Tous droits réservés</p>
    </footer>

</body>
</html>