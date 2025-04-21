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
    <script src="../fichier_java/modifier_profil.js"></script>
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
        <img id="profile-pic" src="../Image/photo_profil_utilisateurs/<?php 
        $profilePicBase = 'profil_' . $_SESSION['user_id']; 
        $extensions = ['jpg', 'jpeg', 'png']; 
        $found = false;
        foreach ($extensions as $ext) {
            $profilePic = $profilePicBase . '.' . $ext;
            if (file_exists('../Image/photo_profil_utilisateurs/' . $profilePic)) {
                echo $profilePic;
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo 'profile.jpg';
        }
        ?>" alt="Photo de profil" class="profile-pic">

        <label for="file-input">Déposer une nouvelle photo</label>
        <input type="file" id="file-input" name="profile_pic" accept="image/*">
        <?php if (isset($_SESSION['success'])): ?>
        <p style="color: green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
    
        <input type="submit" value="Changer">
    </form>



    <form  action="modifier_profil.php" method="POST">
        <div class="form-group">
            <div class="input-container">
                <div><strong>Email:</strong> <input type="email" name="email" id="email" minlength="6" value="<?= htmlspecialchars($_SESSION["email"]) ?>" disabled></div>
                <button type="button" onclick="enableEdit('email')" class="crayon">
                    <img src="../Image/image_icône/crayon.png" alt="Modifier">
                </button>
                <span class="edit-controls" id="controls-email">
                    <button type="button" onclick="saveEdit('email')" class="validation">Valider</button>
                    <button type="button" onclick="cancelEdit('email')" class="annulation">Annuler</button>
                </span>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-container">
            <div><strong>Prenom:</strong> <input type="text" name="prenom" id="prenom" minlength="3"value="<?= htmlspecialchars($_SESSION['prenom']) ?>" disabled></div>
                <button type="button" onclick="enableEdit('prenom')" class="crayon">
                    <img src="../Image/image_icône/crayon.png" alt="Modifier">
                </button>
                <span class="edit-controls" id="controls-prenom">
                    <button type="button" onclick="saveEdit('prenom')" class="validation">Valider</button>
                    <button type="button" onclick="cancelEdit('prenom')" class="annulation">Annuler</button>
                </span>
            </div>
        </div>


        <div class="form-group">
            <div class="input-container">
            <div><strong>Nom:</strong> <input type="text" name="nom" id="nom" minlength="2" value="<?= htmlspecialchars($_SESSION['nom']) ?>" disabled></div>
                <button type="button" onclick="enableEdit('nom')" class="crayon">
                    <img src="../Image/image_icône/crayon.png" alt="Modifier">
                </button>
                <span class="edit-controls" id="controls-nom">
                    <button type="button" onclick="saveEdit('nom')" class="validation">Valider</button>
                    <button type="button" onclick="cancelEdit('nom')" class="annulation">Annuler</button>
                </span>
            </div>
        </div>

        <div class="form-group">
            <div class="input-container">
            <div><strong>Tel:</strong> <input type="text" name="numero" id="tel" minlength="10" value="<?= htmlspecialchars($_SESSION['numero']) ?>" disabled></div>
                <button type="button" onclick="enableEdit('tel')" class="crayon">
                    <img src="../Image/image_icône/crayon.png" alt="Modifier">
                </button>
                <span class="edit-controls" id="controls-tel">
                    <button type="button" onclick="saveEdit('tel')" class="validation">Valider</button>
                    <button type="button" onclick="cancelEdit('tel')" class="annulation">Annuler</button>
                </span>
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
        <button type="submit" id="submit-button" style="display: none;" class="soumettre">Soumettre</button>
    </form>
</div>
<div class="offre-bannière">
        <h2>Vos précédents achats</h2>
</div>
<?php include('voyage_acheté.php') ?>

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