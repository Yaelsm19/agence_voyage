<?php include('verifier_connexion.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../fichier_java/changer_mode.js"></script>
    <link id="theme-stylesheet" rel="stylesheet" href="../fichier_css/variables_sombre.css">
    <link rel="stylesheet" href="..\fichier_css\header.css">
    <link rel="stylesheet" href="..\fichier_css\destinations.css">
    <link rel="stylesheet" href="..\fichier_css\favori.css">
    <link rel="icon"  href="../Image/image_icône/Passport_logo.png">
    <link rel="stylesheet" href="..\fichier_css\footer.css">
    <script src="../fichier_java/suppression_reservation.js" defer></script>
    <title>Favori</title>
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
            echo "<div class='recherche_container'><p class='recherche_vide'>Aucune réservation favorite.</p></div>";
            exit;
        }

        echo "<div class='Voyages'>";
        foreach ($voyages_non_payes as $voyage): 
            $imagePath = "../Image/Image_voyage_page_destinations/" . $voyage['image'];
            $nb_personnes = $voyage['nb_adultes'] + $voyage['nb_enfants'];
            $date_voyage = isset($voyage['date_voyage']) ? $voyage['date_voyage'] : 'Date non disponible';
            $durée_voyage = isset($voyage['duree']) ? $voyage['duree'] : 'Durée inconnue';

            echo "<div id='voyage_{$voyage['id_reservation']}'>";
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
            echo "<a href='#' class='delete-button' onclick='deleteReservation({$voyage['id_reservation']})'>
                    <img src='../Image/image_icône/supprimer2.png' alt='Supprimer' class='delete-icon' />
                  </a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        endforeach;
        echo "</div>";

    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
        exit;
    }
    ?>
    <?php include('footer.php') ?>

</body>
</html>
