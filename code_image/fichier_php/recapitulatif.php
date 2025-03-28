<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - Pastport</title>
    <link rel="stylesheet" href="../fichier_css/recapitulatif.css">
    <link rel="stylesheet" href="../fichier_css/header.css">
    <link rel="stylesheet" href="../fichier_css/footer.css">


</head>
<body>
    <?php include('header.php') ?>
    <div class = "form-container">
        <h1>Votre Voyage : </h1>
        <div class="form-groupe">
            <h2>Destination : </h2>
        </div>
        <div class="form-groupe">
            <h2>Date de départ : </h2>
        </div>
        <div class="form-groupe">
            <h2>Nombre de voyageur : </h2>
        </div>
        <div class="form-groupe">
            <h2>Moyen de téléportation : </h2>
        </div>
        <div class="form-groupe">
            <h2>Réserver au nom de : </h2>
        </div>
        <div class="form-groupe">
            <h2>Prix total : </h2>
        </div>

        <br>
        <div class="form-group">
            <button type="submit">Procéder au paiement</button>
        </div>
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
                    <li><a href="Mentions_légales.html" target="_blank">Mentions légales</a></li>
                    <li><a href="Politique_confidentialité.html" target="_blank">Politique de confidentialité</a></li>
                    <li><a href="contact.html" target="_blank">Contact</a></li>
                    <li><a href="FAQ.html" target="_blank">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous</h3>
                <div class="réseaux-sociaux">
                    <a href="#" ><img src="image_icône/facebook_logo.jpg" alt="Facebook"></a>
                    <a href="#" ><img src="image_icône/twitter_logo.jpg" alt="Twitter"></a>
                    <a href="#" ><img src="image_icône/logo_instagram.jpg" alt="Instagram"></a>
                </div>
            </div>
        </div>
        <p>&copy; 2025 Pastport - Tous droits réservés.</p>
    </footer>
</body>
</html>