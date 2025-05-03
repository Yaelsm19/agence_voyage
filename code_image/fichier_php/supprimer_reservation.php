<?php
session_start();

if (isset($_GET['id_reservation']) && !empty($_GET['id_reservation'])) {
    $id_reservation = $_GET['id_reservation'];
    require_once 'connexion_base.php';

    try {
        $stmt_supprimer_souscriptions = $pdo->prepare("DELETE FROM souscrire WHERE id_reservation = :id_reservation");
        $stmt_supprimer_souscriptions->execute(['id_reservation' => $id_reservation]);

        $stmt_supprimer_reservation = $pdo->prepare("DELETE FROM reservation WHERE id = :id_reservation");
        $stmt_supprimer_reservation->execute(['id_reservation' => $id_reservation]);

        echo "Réservation et ses souscriptions supprimées avec succès.";
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
    }
} else {
    echo "ID de réservation manquant.";
}
?>
