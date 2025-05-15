<?php
define('ACCES_AUTORISE_SESSION', true);
include('session.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit("Accès interdit.");
}

if (isset($_POST['id_reservation']) && !empty($_POST['id_reservation'])) {
    $id_reservation = (int)$_POST['id_reservation'];
    require_once 'connexion_base.php';

    try {
        $stmt_supprimer_souscriptions = $pdo->prepare("DELETE FROM souscrire WHERE id_reservation = :id_reservation");
        $stmt_supprimer_souscriptions->execute(['id_reservation' => $id_reservation]);

        $stmt_supprimer_reservation = $pdo->prepare("DELETE FROM reservation WHERE id = :id_reservation");
        $stmt_supprimer_reservation->execute(['id_reservation' => $id_reservation]);

        echo "Réservation et ses souscriptions supprimées avec succès.";
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Erreur de base de données : " . $e->getMessage();
    }
} else {
    http_response_code(400);
    echo "ID de réservation manquant.";
}
?>
