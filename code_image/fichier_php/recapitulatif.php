<?php include('verifier_connexion.php') ?>
<?php
require_once 'connexion_base.php';
if (isset($_GET['id_reservation']) && !empty($_GET['id_reservation'])) {
    $id_reservation = $_GET['id_reservation'];
    
    try {
        $stmt_reservation = $pdo->prepare("
            SELECT r.*, v.titre, v.prix, v.duree
            FROM reservation r
            INNER JOIN voyage v ON r.id_voyage = v.id
            WHERE r.id = :id_reservation
        ");
        $stmt_reservation->execute(['id_reservation' => $id_reservation]);
        $reservation = $stmt_reservation->fetch(PDO::FETCH_ASSOC);

        if (!$reservation) {
            echo "Réservation non trouvée.";
            exit;
        }
        $stmt_souscrire = $pdo->prepare("
            SELECT s.*, o.intitule, o.prix_par_personne
            FROM souscrire s
            INNER JOIN options o ON s.id_option = o.id_option
            WHERE s.id_reservation = :id_reservation
        ");
        $stmt_souscrire->execute(['id_reservation' => $id_reservation]);
        $options_souscrites = $stmt_souscrire->fetchAll(PDO::FETCH_ASSOC);

        $prix_total = $reservation['prix'] * ($reservation['nb_adultes'] + $reservation['nb_enfants']);
        $prix_transport = 0;
        $prix_guide = 0;
        $prix_option = 0;
        $nb_total_participant = 0;

        foreach ($options_souscrites as $option) {
            $prix_option += $option['prix_par_personne'] * $option['nb_personnes'];
            $nb_total_participant += $option['nb_personnes'];
        }        
        $prix_transport = $reservation['moyen_transport'] == "Montre temporelle" ? 1000 : ($reservation['moyen_transport'] == "Le portail temporel" ? 100 : 0);
        $prix_guide = $reservation['guide'] == "Guide de luxe" ? 600 : ($reservation['guide'] == "Guide un peu mid" ? 30 : ($reservation['guide'] == "Guide déboussolant" ? -150 : 0));
        $prix_total += $prix_transport * ($reservation['nb_adultes'] + $reservation['nb_enfants']);
        $prix_total += $prix_guide * ($reservation['nb_adultes'] + $reservation['nb_enfants']);
        $prix_total += $prix_option;
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
        exit;
    }
} else {
    echo "ID de réservation manquant.";
    exit;
}
?>

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
    <div class="form-container">
        <h1>Votre Voyage : <?= htmlspecialchars($reservation['titre']) ?></h1>
        <div class="form-groupe">
            <i><h2>Date de réservation : <span class="type"><?= date('d/m/Y') ?></span></h2></i>
        </div>
        <div class="form-groupe">
            <i><h2>Heure de réservation : <span class="type"><?= date('H:i') ?></span></h2></i>
        </div>
        <div class="form-groupe">
            <i><h2>Date de départ : <span class="type"><?= htmlspecialchars($reservation['date_voyage']) ?></span></h2></i>
        </div>
        <div class="form-groupe">
            <i><h2>Date de fin : <span class="type"><?php 
            $date_fin = new DateTime($reservation['date_voyage']); 
            $date_fin->modify('+' . $reservation['duree'] . ' days');
            echo htmlspecialchars($date_fin->format('Y-m-d'));
            ?></span></h2></i>
        </div>
        <div class="form-groupe">
            <i><h2>Durée du voyage : <span class="type"><?= htmlspecialchars($reservation['duree']) ?> jours</span></h2></i>
        </div>
        <div class="form-groupe">
            <i><h2>Réserver au nom de : <span class="type"><?= htmlspecialchars($_SESSION["prenom"] . " " . $_SESSION["nom"]) ?></span></h2></i>
        </div>
        <div class="form-groupe">
            <i><h2>Nombre d'adultes responsables et matures : <span class="type"><?= htmlspecialchars($reservation['nb_adultes']) ?></span>
            <span class="prix"><?= htmlspecialchars($reservation['nb_adultes'] * $reservation['prix']) ?>€</span></h2></i>
        </div>
        <div class="form-groupe">
            <i><h2>Nombre d'enfants avec monosourcils : <span class="type"><?= htmlspecialchars($reservation['nb_enfants']) ?></span>
            <span class="prix"><?= htmlspecialchars($reservation['nb_enfants'] * $reservation['prix']) ?>€</span></h2></i>
        </div>
        <div class="form-groupe">
            <i><h2>Nombre total de personnes : <span class="type"><?= htmlspecialchars($reservation['nb_adultes'] + $reservation['nb_enfants']) ?></span>
            <span class="prix"><?= htmlspecialchars(($reservation['nb_adultes'] + $reservation['nb_enfants']) * $reservation['prix']) ?>€</span></h2></i>
        </div>
        <div class="form-groupe">
            <i><h2>Moyen de téléportation : <span class="type"><?= htmlspecialchars($reservation['moyen_transport']) ?></span>
            <span class="prix">
                <?php
                    $prix_transport = 0;
                    if ($reservation['moyen_transport'] == "Montre temporelle") {
                    $prix_transport = 1000;
                    } elseif ($reservation['moyen_transport'] == "Le portail temporel") {
                    $prix_transport = 100;
                    }
                    echo intval($prix_transport * ($reservation['nb_adultes'] + $reservation['nb_enfants']), 2) . "€";
                ?>
            </span></h2></i>
        </div>
        <div class="form-groupe">
        <i><h2>Guide temporelle: <span class="type"><?= htmlspecialchars($reservation['guide']) ?></span>
            <span class="prix">
                <?php
                $prix_guide = 0;
                if ($reservation['guide'] == "Guide de luxe") {
                    $prix_guide = 600;
                } elseif ($reservation['guide'] == "Guide un peu mid") {
                    $prix_guide = 30;
                } elseif ($reservation['guide'] == "Guide déboussolant") {
                    $prix_guide = -150;
                }
                echo intval($prix_guide * ($reservation['nb_adultes'] + $reservation['nb_enfants']), 2) . "€";
            ?>
            </span></h2></i>
        </div>


        <h2>Options souscrites :</h2>
        <ul>
            <?php foreach ($options_souscrites as $option): ?>
                <li>
                    <span class="type"><?= htmlspecialchars($option['intitule']) ?>: <?= htmlspecialchars($option['nb_personnes']) ?> personnes</span>
                    <span class="prix"><?= number_format($option['prix_par_personne'] * $option['nb_personnes'], 2) ?>€</span>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="form-groupe">
            <i><h2>Prix total : <span class="prix"><?= number_format($prix_total, 2) ?>€</span></h2></i>
        </div>

        <?php
        if (isset($_GET['id_reservation']) && !empty($_GET['id_reservation'])) {
            $id_reservation = $_GET['id_reservation'];

        try {
            $stmt_reservation = $pdo->prepare("SELECT r.*, v.titre, v.prix, v.duree FROM reservation r
                                            INNER JOIN voyage v ON r.id_voyage = v.id
                                            WHERE r.id = :id_reservation");
            $stmt_reservation->execute(['id_reservation' => $id_reservation]);
            $reservation = $stmt_reservation->fetch(PDO::FETCH_ASSOC);
            if (!$reservation) {
                echo "Réservation non trouvée.";
                exit;
            }
            $stmt_achat = $pdo->prepare("SELECT * FROM achat WHERE id_reservation = :id_reservation");
            $stmt_achat->execute(['id_reservation' => $id_reservation]);
            $achat = $stmt_achat->fetch(PDO::FETCH_ASSOC);

            if ($achat) {
                echo "<div class='form-group'>";
                echo "<a href='profil.php' class='en_savoir_plus'>Retour vers votre profil</a>";
                echo "</div>";
            } else {
                echo "<form action='paiement.php' method='POST'>";
                echo "<input type='hidden' name='montant' value='" . htmlspecialchars($reservation['prix']) . "'>";
                echo "<input type='hidden' name='vendeur' value='MEF-1_J'>";
                echo "<input type='hidden' name='id_reservation' value='" . htmlspecialchars($id_reservation) . "'>";
                echo "<div class='form-group'>";
                echo "<button type='submit'>Procéder au paiement</button>";
                echo "</div>";
                echo "</form>";
            }
        } catch (PDOException $e) {
            echo "Erreur de base de données : " . $e->getMessage();
            exit;
        }
    } else {
        echo "ID de réservation manquant.";
        exit;
    }
    ?>

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
