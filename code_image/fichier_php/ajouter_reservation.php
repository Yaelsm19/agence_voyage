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

    $id_reservation = $pdo->lastInsertId();
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'nb_participant_') === 0 && $value > 0) {
            $id_option = substr($key, strlen('nb_participant_'));
            $stmt_souscrire = $pdo->prepare("
                INSERT INTO souscrire (id_reservation, id_option, nb_personnes)
                VALUES (:id_reservation, :id_option, :nb_personnes)
            ");
            $stmt_souscrire->execute([
                'id_reservation' => $id_reservation,
                'id_option' => $id_option,
                'nb_personnes' => $value
            ]);
        }
    }

} catch (PDOException $e) {
    echo "Erreur de base de données : " . $e->getMessage();
    exit;
}
?>
