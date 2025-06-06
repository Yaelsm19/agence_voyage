<?php 
define('ACCES_AUTORISE_SESSION', true);
include('session.php') 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Pastport</title>
    <script src="../fichier_java/changer_mode.js"></script>
    <link id="theme-stylesheet" rel="stylesheet" href="../fichier_css/variables_sombre.css">
    <link rel="stylesheet" href="..\fichier_css\header.css">
    <link rel="stylesheet" href="..\fichier_css\accueil.css">
    <link rel="icon"  href="../Image/image_icône/Passport_logo.png">
    <link rel="stylesheet" href="..\fichier_css\footer.css">
</head>
<body>
    <?php include('header.php') ?>
    <video autoplay loop muted id="background-video">
        <source src="../Image/image_background\effet_image.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la vidéo. 
    </video>
    <img id="background-image" src="../Image/image_background\background_fifou.png" style="display: none;">
    <div class="bannière">
        <h2>Bienvenue chez Pastport</h2>
        <h3>"Voyager dans le passé, c'est savourer les moments d'hier<br/>tout en découvrant les leçons qu'ils nous offrent pour aujourd'hui."</h3>
    </div>
    <div class="container2">
        <div class="info1">
            <h4>Voyages Sur-Mesure</h4>
            <p>Voyagez dans le passé selon vos envies : assistez à la construction des pyramides ou vivez la Révolution française avec des expériences sur-mesure.</p>
        </div>
        <div class="info2">
            <h4>Nos Garanties</h4>
            <p>Voyagez en toute sécurité grâce à nos technologies avancées de contrôle temporel. Nous garantissons une expérience 100% immersive sans interférer avec le cours de l’histoire</p>
        </div>
        <div class="info3">
            <h4>L'Histoire de l'Agence</h4>
            <p>Pastport, fondée par des passionnés d’histoire et de technologie, vous offre des voyages uniques dans le temps. Des milliers de voyageurs ont déjà exploré les âges.</p>
        </div>
    </div>
    <div class="offre-bannière">
        <h2>Nos offres du moment</h2>
    </div>
    <?php
require_once 'connexion_base.php';

try {
    $stmt = $pdo->query("SELECT * FROM voyage ORDER BY prix ASC LIMIT 5");
    $voyages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<div class="Voyages">
    <?php foreach ($voyages as $voyage): ?>
        <div>
            <img class="image_destinations" src="../Image/Image_voyage_page_destinations/<?= htmlspecialchars($voyage['image']) ?>" alt="image_<?= $voyage['id'] ?>">
            <div class="zone_texte">
                <h3 class="période"><?= htmlspecialchars($voyage['titre']) ?></h3>
                <p class="description">
                    <?= htmlspecialchars($voyage['description']) ?>
                </p>
                <div class="prix_bouton">
                    <p class="prix_container">
                        <span class="ancien-prix"><?= number_format($voyage['prix'] * 1.15, 0, ',', ' ') ?>€</span>
                        <span class="nouveau-prix">Dès <?= number_format($voyage['prix'], 0, ',', ' ') ?>€</span>
                    </p>
                    <form action="réservation.php" method="POST">
                            <input type="hidden" name="id_voyage" value="<?= $voyage['id'] ?>">
                            <button type="submit" class="en_savoir_plus">En savoir plus</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="voyage-box">
        <img src="../Image/Image_voyage_page_destinations/Tout_voyage.jpg" alt="Tous les voyages">
        <h3>Découvrez de nombreux autres voyages</h3>
        <a href="destinations.php" class="Découvrir">Découvrir</a>
    </div>
</div>

    <div class="section-citations">
        <h2 class="titre-citations">Ce que nos clients disent</h2>
        <div class="citations">
            <div class="citation">
                <p class="texte-citation">"Voyager dans le passé avec Pastport a été une expérience incroyable. L’immersion était totale!"</p>
                <p class="auteur">Jean Dupont, Voyageur en Égypte</p>
            </div>
            <div class="citation">
                <p class="texte-citation">"Une aventure inoubliable ! J'ai vécu la Révolution française comme si j’y étais."</p>
                <p class="auteur">Marie Leblanc, Voyageuse en France</p>
            </div>
            <div class="citation">
                <p class="texte-citation">"L’expérience de la Grèce antique m’a permis de découvrir des événements historiques fascinants en personne."</p>
                <p class="auteur">Pierre Martin, Voyageur en Grèce</p>
            </div>
        </div>
    </div>
    <?php include('footer.php') ?>
    
</body>
</html>