<?php
session_start();

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    header('Location: accueil.php');
    exit;
}
define('ACCES_AUTORISE', true);
require_once 'captcha.php';
[$question, $answer] = buildSmartCaptcha();
$_SESSION['captcha_answer'] = $answer;

$email_value = $_SESSION['last_email'] ?? '';
unset($_SESSION['last_email']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Connexion - Pastport</title>
    <script src="../fichier_java/changer_mode.js"></script>
    <script src="../fichier_java/verif_champs.js"></script>
    <script src="../fichier_java/afficherMDP.js"></script>
    <script src="../fichier_java/compteur_caractere.js"></script>
    <link id="theme-stylesheet" rel="stylesheet" href="../fichier_css/variables_sombre.css" />
    <link rel="stylesheet" href="../fichier_css/se_connecter.css" />
    <link rel="icon" href="../image/image_icône/Passport_logo.png" />
</head>
<body>
    <h1>Se connecter</h1>
    <form class="form-container" method="POST" action="traitement_connexion.php" novalidate>
        <input type="hidden" name="autorisation" value="true" />

        <div class="form-group">
            <label for="email">Adresse email :</label>
            <input
                type="email"
                id="email"
                name="email"
                minlength="6"
                maxlength="30"
                placeholder="Adresse email"
                value="<?= htmlspecialchars($email_value) ?>"
                required
            />
            <p id="email-compteur" class="compteur-caractere"></p>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <div class="input-wrapper">
                <input
                    type="password"
                    id="password"
                    name="password"
                    minlength="8"
                    maxlength="50"
                    placeholder="Mot de passe"
                    required
                />
                <button type="button" onclick="afficherMDP('password')" class="oeil">
                    <img src="../Image/image_icône/oeil.png" alt="afficher" />
                </button>
            </div>
            <p id="password-compteur" class="compteur-caractere"></p>
        </div>

        <div class="form-group">
            <label for="captcha"><?= htmlspecialchars($question) ?></label>
            <input type="text" id="captcha" name="captcha" required />
        </div>

        <?php if (isset($_SESSION['error'])) : ?>
            <div style="color: red; margin-bottom: 10px;">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="form-group">
            <button type="submit">S'identifier</button>
        </div>

        <div class="bouton-retour">
            <a href="accueil.php">
                <div class="retour">
                    <img src="../Image/image_icône/en-arriere.png" alt="retour" />
                </div>
            </a>
            <div class="form-group">
                <h2>Si vous ne possédez pas encore de profil, <a href="s_inscrire.php">cliquez ici</a></h2>
            </div>
        </div>
    </form>

    <footer>
        <p>© 2025 Pastport - Tous droits réservés</p>
    </footer>
</body>
</html>
