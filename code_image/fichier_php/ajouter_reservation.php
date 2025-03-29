<?php
try {
    $stmt = $pdo->prepare("
        INSERT INTO reservation (id_utilisateur, id_voyage, date_reservation, heure_reservation, date_voyage, nb_adultes, nb_enfants, moyen_transport, guide)
        VALUES (:id_utilisateur, :id_voyage, :date_reservation, :heure_reservation, :date_voyage, :nb_adultes, :nb_enfants, :moyen_transport, :guide)
    ");
    $stmt->execute([
        'id_utilisateur' => $_SESSION['user_id'],
        'id_voyage' => $_POST['id_voyage'],
        'date_reservation' => date("Y-m-d"),
        'heure_reservation' => date("H:i:s"),
        'date_voyage' => $_POST['date'],
        'nb_adultes' => $_POST['adulte'],
        'nb_enfants' => $_POST['enfant'],
        'moyen_transport' => $_POST['choix'],
        'guide' => $_POST['choix2']
    ]);
} catch (PDOException $e) {
    echo "Erreur de base de données : " . $e->getMessage();
    exit;
}
?>
