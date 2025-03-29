<?php include('verifier_connexion.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\fichier_css\header.css">
    <link rel="stylesheet" href="..\fichier_css\destinations.css">
    <link rel="icon"  href="../Image/image_icône/Passport_logo.jpg">
    <link rel="stylesheet" href="..\fichier_css\footer.css">
    <title>Panier</title>
</head>
<body>
    <video autoplay loop muted id="background-video">
        <source src="../Image/image_background\effet_image.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la vidéo.
    </video>        
    <?php include('header.php') ?>
    <div class="offre-bannière">
        <h2>Vos réservations favorites</h2>
    </div>
    <?php
    require_once 'connexion_base.php';
    $user_id = $_SESSION['user_id'];
    try {
        $stmt = $pdo->prepare("
            SELECT r.id AS id_reservation, v.*, r.nb_adultes, r.nb_enfants, r.date_voyage
            FROM reservation r
            INNER JOIN voyage v ON r.id_voyage = v.id
            LEFT JOIN achat a ON r.id = a.id_reservation
            WHERE r.id_utilisateur = :user_id AND a.id_reservation IS NULL
        ");
        $stmt->execute(['user_id' => $user_id]);
        $voyages_non_payes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($voyages_non_payes)) {
            echo "<div class='recherche_container'><p class='recherche_vide'>Aucune réservation favorites.</p></div>";
            exit;
        }
    
        echo "<div class='Voyages'>";
        foreach ($voyages_non_payes as $voyage) { 
            $imagePath = "../Image/Image_voyage_page_destinations/" . $voyage['image'];
            $nb_personnes = $voyage['nb_adultes'] + $voyage['nb_enfants'];
            $date_voyage = isset($voyage['date_voyage']) ? $voyage['date_voyage'] : 'Date non disponible'; // Vérification de la date
            $durée_voyage = isset($voyage['duree']) ? $voyage['duree'] : 'Durée inconnue'; // Vérification de la durée
            echo "<div>";
            echo "<img class='image_destinations' src='$imagePath' alt='Image du voyage'>";
            echo "<div class='zone_texte'>";
            echo "<h3 class='période'>" . htmlspecialchars($voyage['titre']) . "</h3>";
            echo "<p class='description'>";
            echo "Nombre de personnes : " . htmlspecialchars($nb_personnes) . "<br>";
            echo "Date de départ : " . htmlspecialchars($date_voyage) . "<br>";
            echo "Durée du voyage : " . htmlspecialchars($durée_voyage) . " jours";
            echo "</p>";
            echo "<div class='prix_bouton'>";
            echo "<a href='recapitulatif.php?id_reservation=" . $voyage['id_reservation'] . "' class='en_savoir_plus'>Voir le récapitulatif</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }    
        echo "</div>";

    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
        exit;
    }
    ?>
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
    
</body>
</html>