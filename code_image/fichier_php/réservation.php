<?php include('session.php') ?>
<?php include('verifier_connexion.php') ?>
<?php
require_once 'connexion_base.php';
if (isset($_POST['id_voyage']) && !empty($_POST['id_voyage'])) {
    $id_voyage = $_POST['id_voyage'];

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

if (isset($_POST['id_reservation']) && !empty($_POST['id_reservation'])) {
    $id_reservation = $_POST['id_reservation'];

    try {
        $stmt_reservation = $pdo->prepare("SELECT * FROM reservation WHERE id = :id_reservation");
        $stmt_reservation->execute(['id_reservation' => $id_reservation]);
        $reservation = $stmt_reservation->fetch(PDO::FETCH_ASSOC);

        if (!$reservation) {
            echo "Réservation non trouvée.";
            exit;
        }

        $date_voyage = $reservation['date_voyage'];
        $nb_adultes = $reservation['nb_adultes'];
        $nb_enfants = $reservation['nb_enfants'];
        $guide = $reservation['guide'];
        $transport = $reservation['moyen_transport'];

        $stmt_souscrire = $pdo->prepare("SELECT s.id_option, o.intitule, SUM(s.nb_personnes) AS nb_personnes
                                        FROM souscrire s
                                        INNER JOIN options o ON s.id_option = o.id_option
                                        WHERE s.id_reservation = :id_reservation
                                        GROUP BY s.id_option, o.intitule");
        $stmt_souscrire->execute(['id_reservation' => $id_reservation]);
        $options_souscrites = $stmt_souscrire->fetchAll(PDO::FETCH_ASSOC);

        $options = [];
        foreach ($options_souscrites as $option) {
            $options[$option['intitule']] = $option['nb_personnes'];
        }

    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - Pastport</title>
    <script src="../fichier_java/changer_mode.js"></script>
    <script src="../fichier_java/compteur_prix.js"></script>
    <link id="theme-stylesheet" rel="stylesheet" href="../fichier_css/variables_sombre.css">
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
        <img id="mainImage" class="main-image" src="../Image/image_voyage_réservation/<?= htmlspecialchars($voyage['image_reservation1']) ?>" alt="Image principale">
            <div class="thumbnail-container">
                <span class="arrow" onclick="prevImage()">&#9664;</span>
                <img class="thumbnail active" src="../Image/image_voyage_réservation/<?= htmlspecialchars($voyage['image_reservation1']) ?>" onclick="changeImage(0)">
                <img class="thumbnail" src="../Image/image_voyage_réservation/<?= htmlspecialchars($voyage['image_reservation2']) ?>" onclick="changeImage(1)">
                <img class="thumbnail" src="../Image/image_voyage_réservation/<?= htmlspecialchars($voyage['image_reservation3']) ?>" onclick="changeImage(2)">
                <span class="arrow" onclick="nextImage()">&#9654;</span>
            </div>
        </div>
        <div class="info-box">
            <h2>A partir de <span class="prix"><?= number_format($voyage['prix'], 0, ',', ' ') ?>€/P</span></h2>
            <p><?= htmlspecialchars($voyage['description']) ?></p>
            <h2>Date de départ</h2>
            <input type="date" id="date" name="date" 
            value="<?php 
            echo isset($date_voyage) && !empty($date_voyage) ? date('Y-m-d', strtotime($date_voyage)) : ''; 
       ?>">




            <h2>Nombre d'adultes responsables et matures :</h2>
            <input type="number" id="adulte" name="adulte" min="0" max="5" value="<?php echo isset($nb_adultes) ? htmlspecialchars($nb_adultes) : 1; ?>">

            <h2>Nombre d'enfants avec monosourcils :</h2>
            <input type="number" id="enfant" name="enfant" min="0" max="5" value="<?php echo isset($nb_enfants) ? htmlspecialchars($nb_enfants) : 0; ?>">



        </div>
    </div>
    <?php
    if (isset($id_reservation)) {
        echo '<input type="hidden" name="id_reservation" value="' . $id_reservation. '">';
    }
    ?>
    <?php include('defilement_image.php') ?>
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
                    <?php
                    if (isset($options[$option['intitule']])) {
                        $nb_personnes_souscrites = $options[$option['intitule']];
                    } else {
                        $nb_personnes_souscrites = 0;
                    }
                    ?>
                    <input 
                        type="number" 
                        id="option_<?= $index ?>_<?= $option['id_option'] ?>" 
                        name="nb_participant_<?= $option['id_option'] ?>" 
                        min="0"
                        max="10" 
                        value="<?= $nb_personnes_souscrites ?>">
                    <p><?= htmlspecialchars($option['intitule']) ?> : +<span class="prix"><?= number_format($option['prix_par_personne'], 0, ',', ' ') ?>€</span></p>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    </div>
        <div class="info-box2">
            <h2>Quel moyen de voyage dans le temps désirez-vous :</h2>
            <div class="transport">
                <label>
                    <input type="radio" name="choix" value="Montre temporelle" <?php echo (isset($transport) && $transport == 'Montre temporelle') ? 'checked' : ''; ?>>
                    <b>Montre temporelle : </b>+<span class="prix">1000<span>€</span>/P</span>
                </label><br>
                <label>
                    <input type="radio" name="choix" value="Le portail temporel" <?php echo (isset($transport) && $transport == 'Le portail temporel') ? 'checked' : ''; ?>>
                    <b>Le portail temporel : </b>+<span class="prix">100<span>€</span>/P</span>
                </label><br>
                <label>
                    <input type="radio" name="choix" value="La cabine temporel" <?php echo (isset($transport) && $transport == 'La cabine temporel') ? 'checked' : ''; ?>>
                    <b>La cabine temporel : </b>+<span class="prix">0<span>€</span>/P</span>
                </label><br>
            </div>
    
            <h2>Désirez-vous un guide temporel ?</h2>
            <div class="guide">
            <label>
                <input type="radio" name="choix2" value="Guide de luxe" <?php echo (isset($guide) && $guide == 'Guide de luxe') ? 'checked' : ''; ?>>
                <b>Guide de luxe : </b>+<span class="prix">600<span>€</span>/P</span>
            </label><br>
            <label>
                <input type="radio" name="choix2" value="Guide un peu mid" <?php echo (isset($guide) && $guide == 'Guide un peu mid') ? 'checked' : ''; ?>>
                <b>Guide un peu mid : </b>+<span class="prix">30<span>€</span>/P</span>
            </label><br>
            <label>
                <input type="radio" name="choix2" value="Pas de guide" <?php echo (isset($guide) && $guide == 'Pas de guide') ? 'checked' : ''; ?>>
                <b>Pas de guide : </b>+<span class="prix">0<span>€</span>/P</span>
            </label><br>
            <label>
                <input type="radio" name="choix2" value="Guide déboussolant" <?php echo (isset($guide) && $guide == 'Guide déboussolant') ? 'checked' : ''; ?>>
                <b>Guide déboussolant : </b><span class="prix">-150<span>€</span>/P</span>
            </label><br>
            </div>
        </div>
    </div> 
    <div class="button-container">
        <?php 
        if(!isset($id_reservation)){
            echo'<button type="submit" name="action" value="panier">⭐Ajouter aux Panier⭐</button>';
        }
        ?>
        <button type="submit" name="action" value="reserver">Réserver</button>
    </div>

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
    .messages-container {
        margin: 20px 0;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    .message {
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        font-size: 16px;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
</style>
<?php include('footer.php') ?> 
</body>
</html>