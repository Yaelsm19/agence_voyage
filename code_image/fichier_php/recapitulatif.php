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
        <h1>Votre Voyage : <?= htmlspecialchars($voyage['titre']) ?></h1>
    <?php
        date_default_timezone_set('Europe/Paris');
    ?>
    <div class="form-groupe">
        <i><h2>Date de réservation : <span class="type"><?= date('d/m/Y') ?></span></h2></i>
    </div>
    <div class="form-groupe">
        <i><h2>Heure de réservation : <span class="type"><?= date('H:i') ?></span></h2></i>
    </div>


        <div class="form-groupe">
            <i><h2>Date de départ : <span class="type"><?= htmlspecialchars($date) ?></span></h2></i>
        </div>
        <div class="form-groupe">
            <i><h2>Date de fin : 
            <span class="type"><?php 
            $date_fin = new DateTime($date); 
            $date_fin->modify('+' . $voyage['duree'] . ' days');
            echo htmlspecialchars($date_fin->format('Y-m-d'));
            ?></span>
            </h2></i>
        </div>
    <div class="form-groupe">
        <i><h2>Durée du voyage : <span class="type"><?= htmlspecialchars($voyage['duree']) ?> jours</span></h2></i>
    </div>
    <div class="form-groupe">
        <i><h2>Réserver au nom de : <span class="type"><?= htmlspecialchars($_SESSION["prenom"] . " " . $_SESSION["nom"]) ?></span></h2></i>
    </div>
    <div class="form-groupe">
        <i><h2>Nombre d'adultes responsables et matures : <span class="type"><?= htmlspecialchars($nb_adultes) ?></span></h2></i>
    </div>
    <div class="form-groupe">
        <i><h2>Nombre d'enfants avec monosourcils : <span class="type"><?= htmlspecialchars($nb_enfants) ?></span></h2></i>
    </div>
    <div class="form-groupe">
        <i><h2>Nombre de personnes totales : <span class="type"><?= htmlspecialchars($nb_enfants + $nb_adultes) ?></span>
        <span class="prix"><?= htmlspecialchars(($nb_adultes + $nb_enfants) * $voyage['prix']) ?>€</span></h2></i>
    </div>
    <div class="form-groupe">
        <i><h2>Moyen de téléportation : <span class="type"><?= htmlspecialchars($transport) ?></span>
        <span class="prix"><?= htmlspecialchars($prix_transport) * ($nb_adultes + $nb_enfants) ?>€</span></h2></i>
    </div>
    <div class="form-groupe">
        <i><h2>Guide temporelle: <span class="type"><?= htmlspecialchars($guide) ?></span>
        <span class="prix"><?= htmlspecialchars($prix_guide * ($nb_adultes + $nb_enfants)) ?>€</span></h2></i>
    </div>
    <div class="form-groupe">
        <i><h2>Options : <span class="type"><?= htmlspecialchars($nb_options) ?> (<?= htmlspecialchars($nb_total_participant) ?> participants au total)</span>
        <span class="prix"><?= htmlspecialchars($prix_option) ?>€</span></h2></i>
    </div>
    <div class="form-groupe">
        <i><h2>Prix total : <span class="prix"><?= htmlspecialchars($prix_total) ?>€</span></h2></i>
    </div>

    <br>
    <form action="paiement.php" method="POST">
    <input type="hidden" name="montant" value="<?= htmlspecialchars($prix_total) ?>">
    <input type="hidden" name="vendeur" value="TEST">
    <input type="hidden" name="transaction" value="154632ABCZWTC">
        <div class="form-group">
            <button type="submit">Procéder au paiement</button>
        </div>
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
                    <li><a href="Mentions_légales.html" target="_blank">Mentions légales</a></li>
                    <li><a href="Politique_confidentialité.html" target="_blank">Politique de confidentialité</a></li>
                    <li><a href="contact.html" target="_blank">Contact</a></li>
                    <li><a href="FAQ.html" target="_blank">FAQ</a></li>
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