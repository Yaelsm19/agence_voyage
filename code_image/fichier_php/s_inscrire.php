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
    <form class="form-container" method="POST" action="traitement_inscription.php" novalidate>
        <div class="form-group">
            <label for="prénom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" minlength="3" maxlength="20" placeholder="Votre prénom" required>
            <p id="prenom-compteur" class="compteur-caractere"></p>
        </div>

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" minlength="2" maxlength="30"placeholder="Votre nom" required>
            <p id="nom-compteur" class="compteur-caractere"></p>
        </div>

        <div class="form-group">
            <label for="email">Adresse email :</label>
            <input type="email" id="email" name="email" minlength="6" maxlength="30"placeholder="Adresse email" required>
            <p id="email-compteur" class="compteur-caractere"></p>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="tel" name="telephone" id="telephone" minlength="10" maxlength="10" placeholder="Numéro de téléphone" required>
            <p id="telephone-compteur" class="compteur-caractere"></p>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <div class="input-wrapper">
                <input type="password" id="password" name="password" minlength="8" maxlength="50" placeholder="Mot de passe">
                    <button type="button" onclick="afficherMDP('password')" class="oeil">
                        <img src="../Image/image_icône/oeil.png" alt="afficher">
                    </button>
                </div>
            </div>
            <p id="password-compteur" class="compteur-caractere"></p>
        </div>

        <div class="form-group">
            <label for="confirmation_password">Confirmation du mot de passe :</label>
            <div class="input-wrapper">
                <input type="password" id="confirmation-password" name="confirmation-password" minlength="8" maxlength="50"placeholder="Mot de passe">
                    <button type="button" onclick="afficherMDP('confirmation-password')" class="oeil">
                        <img src="../Image/image_icône/oeil.png" alt="afficher">
                    </button>
                </div>
            </div>
            <p id="confirmation-password-compteur" class="compteur-caractere"></p>
        </div>

        <?php
        session_start();
        if (isset($_SESSION["error"])) {
            echo "<div style='color: red; margin-bottom: 10px;'>" . $_SESSION["error"] . "</div>";
            unset($_SESSION["error"]);
        }
        ?>

        <div class="form-group">
            <button type="submit">S'inscrire</button>
        </div>

        <div class="bouton-retour">
            <a href="accueil.php">
                <div class="retour">
                    <img src="../Image/image_icône/en-arriere.png" alt="modifier">
                </div>
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
    <script src="../fichier_java/afficherMDP.js"></script>
    <script src="../fichier_java/verif_champs.js"></script>
    <script src="../fichier_java/compteur_caractere.js"></script>

</body>
</html>