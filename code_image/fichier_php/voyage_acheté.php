<?php
if (!defined('ACCES_AUTORISE')) {
    http_response_code(403);
    exit("Accès interdit.");
}
try {
    $stmt = $pdo->prepare("
    SELECT r.id AS id_reservation, v.*, r.nb_adultes, r.nb_enfants, r.date_voyage, a.id_transaction, a.montant, a.vendeur, a.date_achat, a.heure_achat
    FROM reservation r
    INNER JOIN achat a ON r.id = a.id_reservation
    INNER JOIN voyage v ON r.id_voyage = v.id
    WHERE r.id_utilisateur = :user_id
    ");

    $stmt->execute(['user_id' => $user_id]);
    $voyages_achetes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($voyages_achetes)) {
        echo "<div class='recherche_container'><p class='recherche_vide'>Aucun voyage acheté</p></div>";
        exit;
    }
    
    echo "<div class='Voyages'>";
    foreach ($voyages_achetes as $voyage) { 
        $imagePath = "../Image/Image_voyage_page_destinations/" . $voyage['image'];
        $nb_personnes = $voyage['nb_adultes'] + $voyage['nb_enfants'];
        $date_achat = $voyage['date_achat'];
        $heure_achat = $voyage['heure_achat'];
        $montant = number_format($voyage['montant'], 2, ',', ' ');
        $date_depart = new DateTime($voyage['date_voyage']);
        $aujourdhui = new DateTime();
        $diff = $aujourdhui->diff($date_depart)->days;
    
        echo "<div>";
        echo "<img class='image_destinations' src='$imagePath' alt='Image du voyage'>";
        echo "<div class='zone_texte'>";
        echo "<h3 class='période'>" . htmlspecialchars($voyage['titre']) . "</h3>";
        echo "<p class='description'>";
        echo "Nombre de personnes : " . htmlspecialchars($nb_personnes) . "<br>";
        echo "Date Voyage : " . htmlspecialchars($voyage['date_voyage']) . "<br>";
        echo "Date d'achat : " . htmlspecialchars($date_achat) . "<br>";
        echo "Heure d'achat : " . htmlspecialchars($heure_achat). "<br>";;
        echo "Montant_total : " . htmlspecialchars($montant);
        echo "</p>";
        echo "<div class='prix_bouton' style='display: flex; gap: 10px;'>";

        echo "<form action='recapitulatif.php' method='POST'>";
        echo "<input type='hidden' name='autorisation' value='true'>";
        echo "<input type='hidden' name='id_reservation' value='" . htmlspecialchars($voyage['id_reservation']) . "'>";
        echo "<button type='submit' class='en_savoir_plus'>Voir le récapitulatif</button>";
        echo "</form>";
        if ($date_depart > $aujourdhui && $diff >= 10) {
        echo "<form action='réservation.php' method='POST'>";
        echo "<input type='hidden' name='id_voyage' value='" . htmlspecialchars($voyage['id']) . "'>";
        echo "<input type='hidden' name='id_reservation' value='" . htmlspecialchars($voyage['id_reservation']) . "'>";
        echo "<input type='hidden' name='completer' value='true'>";
        echo "<button type='submit' class='en_savoir_plus'>Compléter l'achat</button>";
        echo "</form>";
        }
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
