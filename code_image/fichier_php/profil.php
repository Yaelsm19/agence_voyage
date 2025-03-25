<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Pastport</title>
    <link rel="stylesheet" href="..\fichier_css\profil.css">
    <link rel="stylesheet" href="..\fichier_css\footer.css">
    <link rel="stylesheet" href="..\fichier_css\header.css">
    <link rel="icon" href="../Image/image_icône/Passport_logo.jpg">

</head>
<body>
<?php include('header.php') ?>
    <video autoplay loop muted id="background-video">
            <source src="../Image/image_background\effet_image.mp4" type="video/mp4">
            Votre navigateur ne supporte pas la vidéo.
        </video>
    <div class="profil-container">
    <div class="se_deconnecter_container">
            <a class="se_deconnecter" href="deconnexion.php">Se déconnecter</a>
    </div>
    <form action="photo_profil.php" method="POST" enctype="multipart/form-data">
        <img id="profile-pic" src="../Image/image_icône/<?php echo !empty($user['profile_pic']) ? $user['profile_pic'] : 'profile.jpg'; ?>" alt="Photo de profil" class="profile-pic">
        <label for="file-input">Changer la photo de profil :</label>
        <input type="file" id="file-input" name="profile_pic" accept="image/*">
        <button type="submit">Mettre à jour la photo de profil</button>
</form>

    <form  action="modifier_profil.php" method="POST">
        <div class="form-group">
            <div class="input-container">
                <p><strong>Email:</strong> <input type="email" name="email" minlength="6" value="<?= htmlspecialchars($_SESSION["email"]) ?>" required></p>
                <button class="crayon">
                    <img src="../Image/image_icône/crayon.png" alt="Modifier">
                </button>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-container">
            <p><strong>Prenom:</strong> <input type="text" name="prenom"  minlength="3"value="<?= htmlspecialchars($_SESSION['prenom']) ?>" required></p>
                <button class="crayon">
                    <img src="../Image/image_icône/crayon.png" alt="Modifier">
                </button>
            </div>
        </div>


        <div class="form-group">
            <div class="input-container">
            <p><strong>Nom:</strong> <input type="text" name="nom" minlength="2" value="<?= htmlspecialchars($_SESSION['nom']) ?>" required></p>
                <button class="crayon">
                    <img src="../Image/image_icône/crayon.png" alt="modifier">
                </button>
            </div>
        </div>

        <div class="form-group">
            <div class="input-container">
            <p><strong>Tel:</strong> <input type="text" name="numero" minlength="10" value="<?= htmlspecialchars($_SESSION['numero']) ?>" required></p>
                <button class="crayon">
                    <img src="../Image/image_icône/crayon.png" alt="modifier">
                </button>
            </div>
        </div>
        


        <div class="grade">
            <?php
            $gradeClass = '';
            switch ($_SESSION['grade']) {
            case 'admin':
                $gradeClass = 'grade-admin';
                break;
            case 'VIP':
                $gradeClass = 'grade-vip';
                break;
            case 'membre':
                $gradeClass = 'grade-membre';
                break;
            }
            ?>
            <p class="<?= $gradeClass ?>"><strong>Grade:</strong> <?= htmlspecialchars($_SESSION['grade']) ?></p>
        </div>

        <?php
        if (isset($_SESSION['error'])) {
            echo "<div style='color: red; margin-bottom: 10px;'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        ?>
        <input type="submit" value="Modifier">
</form>
</div>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>À propos de nous</h3>
                <p>
                    Voyagez dans le temps avec notre agence et explorez les périodes les plus fascinantes de l’histoire humaine !
                </p>
            </div>
    
            <div class="footer-section">
                <h3>Liens utiles</h3>
                <ul class="footer-liens">
                    <li><a href="Mentions_légales.php" target="_blank">Mentions légales</a></li>
                    <li><a href="Politique_confidentialité.php" target="_blank">Politique de confidentialité</a></li>
                    <li><a href="contact.php" target="_blank">Contact</a></li>
                    <li><a href="FAQ.php" target="_blank">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous</h3>
                <div class="réseaux-sociaux">
                    <a href="#" ><img src="../Image/image_icône/facebook_logo.jpg" alt="Facebook"></a>
                    <a href="#" ><img src="../Image/image_icône/twitter_logo.jpg" alt="Twitter"></a>
                    <a href="#" ><img src="../Image/image_icône/logo_instagram.jpg" alt="Instagram"></a>
                </div>
            </div>
        </div>
        <p>&copy; 2025 Pastport - Tous droits réservés.</p>
    </footer>
</body>
</html>