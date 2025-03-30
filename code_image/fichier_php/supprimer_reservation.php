<?php
session_start();

if (isset($_GET['id_reservation']) && !empty($_GET['id_reservation'])) {
    $id_reservation = $_GET['id_reservation'];
    require_once 'connexion_base.php';

    try {
        $stmt = $pdo->prepare("DELETE FROM reservation WHERE id = :id_reservation");
        $stmt->execute(['id_reservation' => $id_reservation]);
        echo "Réservation supprimée avec succès";
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
    }
} else {
    echo "ID de réservation manquant.";
}
?>
