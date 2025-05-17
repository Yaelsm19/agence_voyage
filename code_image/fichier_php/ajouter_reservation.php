<?php
if (!defined('ACCES_AUTORISE')) {
    http_response_code(403);
    exit("Accès interdit.");
}
try {
    $stmt = $pdo->prepare("
        INSERT INTO reservation (id_utilisateur, id_voyage, date_reservation, heure_reservation, date_voyage, nb_adultes, nb_enfants, moyen_transport, guide)
        VALUES (:id_utilisateur, :id_voyage, :date_reservation, :heure_reservation, :date_voyage, :nb_adultes, :nb_enfants, :moyen_transport, :guide)
    ");
    $stmt->execute([
        'id_utilisateur' => $_SESSION['user_id'],
        'id_voyage' => $id_voyage,
        'date_reservation' => date("Y-m-d"),
        'heure_reservation' => date("H:i:s"),
        'date_voyage' => $date_voyage,
        'nb_adultes' => $nb_adultes,
        'nb_enfants' => $nb_enfants,
        'moyen_transport' => $moyen_transport,
        'guide' => $guide
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
