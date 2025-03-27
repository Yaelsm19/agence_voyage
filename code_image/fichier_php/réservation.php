<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_voyage = $_GET['id'];

    require_once 'connexion_base.php'; 

    try {
        $stmt_voyage = $pdo->prepare("SELECT * FROM voyage WHERE id = :id_voyage");
        $stmt_voyage->execute(['id_voyage' => $id_voyage]);
        $voyage = $stmt_voyage->fetch(PDO::FETCH_ASSOC);

        if (!$voyage) {
            echo "Voyage non trouvé.";
            exit;
        }

        $stmt_etapes = $pdo->prepare("SELECT * FROM etape WHERE id_voyage = :id_voyage");
        $stmt_etapes->execute(['id_voyage' => $id_voyage]);
        $etapes = $stmt_etapes->fetchAll(PDO::FETCH_ASSOC);

        foreach ($etapes as $index => $etape) {
            $stmt_options = $pdo->prepare("SELECT * FROM options WHERE id_etape = :id_etape");
            $stmt_options->execute(['id_etape' => $etape['id']]);
            $etapes[$index]['options'] = $stmt_options->fetchAll(PDO::FETCH_ASSOC);
        }

    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    }
} else {
    echo "Aucun voyage sélectionné.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - Pastport</title>
    <link rel="stylesheet" href="../fichier_css/réservation.css">
    <link rel="stylesheet" href="../fichier_css/header.css">
    <link rel="stylesheet" href="../fichier_css/footer.css">


</head>
<body>
    <?php include('header.php') ?>
    <h1>Réservation - <?= htmlspecialchars($voyage['titre']) ?></h1>
    <form action="verification_reservation.php" method="POST">
    <input type="hidden" name="id_voyage" value="<?= $id_voyage ?>">
    <div class="main-content">
        <div class="gallery">
            <img id="mainImage" class="main-image" src="../Image/image_voyage_description/journey_to_versailles_1789.jpg" alt="Image principale">
            <div class="thumbnail-container">
                <span class="arrow" onclick="prevImage()">&#9664;</span>
                <img class="thumbnail active" src="../Image/image_voyage_description/journey_to_versailles_1789.jpg" onclick="changeImage(0)">
                <img class="thumbnail" src="../Image/image_voyage_description/jeu de paume.jpeg" onclick="changeImage(1)">
                <img class="thumbnail" src="../Image/image_voyage_description/ouverture des états généraux.jpeg" onclick="changeImage(2)">
                <span class="arrow" onclick="nextImage()">&#9654;</span>
            </div>
        </div>
        <div class="info-box">
            <h2>A partir de <?= number_format($voyage['prix'], 0, ',', ' ') ?>€/P</h2>
            <p><?= htmlspecialchars($voyage['description']) ?></p>
            <h2>Date de départ</h2>
            <input type="date" id="date" name="date" required>

            <h2>Nombre d'adultes responsables et matures :</h2>
            <input type="number" id="adulte" name="adulte" min="0" max="8" value="1">

            <h2>Nombre d'enfants avec monosourcils :</h2>
            <input type="number" id="enfant" name="enfant" min="0" max="5" value="0">



        </div>
    </div>

    <script src="../fichier_java/defilement_image.js"></script>
    <br>
    <br>
    <div class = "second-content">
    <div class="Etape_container">
    <?php 
    usort($etapes, function ($a, $b) {
    return $a['chronologie'] <=> $b['chronologie'];});
    ?>

    <?php foreach ($etapes as $index => $etape): ?>
        <div class="Etape">
            <h2>Etape <?= $index + 1 ?> : <?= htmlspecialchars($etape['titre']) ?></h2>
            <?php foreach ($etape['options'] as $option): ?>
                <div class="option">
                    <label for="option_<?= $index ?>_<?= $option['id_option'] ?>">
                    <input 
                        type="number" 
                        id="option_<?= $index ?>_<?= $option['id_option'] ?>" 
                        name="nb_participant_<?= $option['id_option'] ?>" 
                        min="0"
                        max="5" 
                        value="0">
                    <p><?= htmlspecialchars($option['intitule']) ?> : +<?= number_format($option['prix_par_personne'], 0, ',', ' ') ?>$</p>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    </div>



        <div class = "info-box">
            <h2>Quel moyen de voyage dans le temps désirez-vous :</h2>
            <div class="transport">
                <label>
                    <input type="radio" name="choix" value="option1">
                    <b>Montre temporelle : </b>+1000$
                </label><br>
                <label>
                    <input type="radio" name="choix" value="option2">
                    <b>Le portail temporel : </b>+100$
                </label><br>
                <label>
                    <input type="radio" name="choix" value="option3">
                    <b>La cabine temporel : </b>+0$
                </label><br>
            </div>
            <h2>Désirez-vous un guide temporel ?</h2>
            <div class="guide">
                <label>
                    <input type="radio" name="choix2" value="option1">
                    <b>Guide de luxe : </b>+600$
                </label><br>
                <label>
                    <input type="radio" name="choix2" value="option2">
                    <b>Guide un peu mid : </b>+30$
                </label><br>
                <label>
                    <input type="radio" name="choix2" value="option3">
                    <b>Pas de guide : </b>+0$
                </label><br>
                <label>
                    <input type="radio" name="choix2" value="option3">
                    <b>Guide déboussolant : </b>-150$
                </label><br>
            </div>
        </div>
    </div>
    <button type="submit">Réserver</button>
    </form>
    <?php
    if (isset($_SESSION["messages"]) && !empty($_SESSION["messages"])) {
    echo '<div class="messages-container">';
    foreach ($_SESSION["messages"] as $message) {
        if (strpos($message, 'Erreur') !== false) {
            echo '<div class="message error">' . htmlspecialchars($message) . '</div>';
        } else {
            echo '<div class="message success">' . htmlspecialchars($message) . '</div>';
        }
    }
    unset($_SESSION["messages"]);
}
?>
<style>
    /* Conteneur pour les messages */
    .messages-container {
        margin: 20px 0;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    /* Style pour chaque message */
    .message {
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        font-size: 16px;
    }

    /* Style pour les messages d'erreur */
    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Style pour les messages de succès */
    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
</style>

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