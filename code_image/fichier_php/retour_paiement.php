<?php include('session.php') ?>
<?php include('verifier_connexion.php') ?>
<?php
date_default_timezone_set('Europe/Paris');
require_once 'connexion_base.php';
if (isset($_GET['status'], $_GET['montant'], $_GET['transaction'], $_GET['vendeur'], $_GET['control'])) {
    $status = $_GET['status'];
    $montant = $_GET['montant'];
    $transaction = $_GET['transaction'];
    $vendeur = $_GET['vendeur'];
    $control = $_GET['control'];

    if (isset($_SESSION['id_reservation'])) {
        $id_reservation = $_SESSION['id_reservation'];
    } else {
        header("Location: accueil.php");
    exit;}
    if ($status !== 'accepted') {
        header("Location: recapitulatif.php?id_reservation=" . urlencode($id_reservation));
        exit;
    }
    try {
        $stmt = $pdo->prepare("
            INSERT INTO achat (id_transaction, id_reservation, montant, vendeur, date_achat, heure_achat)
            VALUES (:id_transaction, :id_reservation, :montant, :vendeur, :date_achat, :heure_achat)
        ");
        $stmt->execute([
            'id_transaction' => $transaction,
            'id_reservation' => $id_reservation,
            'montant' => $montant,
            'vendeur' => $vendeur,
            'date_achat' => date('Y-m-d'),
            'heure_achat' => date('H:i:s')
        ]);
    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement de l'achat : " . $e->getMessage();
        exit;
    }
    header("Location: profil.php");
    exit;

} else {
    header("Location: recapitulatif.php?id_reservation=" . urlencode($id_reservation));
    exit;
}
?>
