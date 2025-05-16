<?php
session_start();
if (isset($_SESSION['autorisation'])) {
    define('ACCES_AUTORISE', true);
    unset($_SESSION['autorisation']);
}
else{
    http_response_code(403);
    exit("Accès interdit.");
}


date_default_timezone_set('Europe/Paris');

require_once 'connexion_base.php';
require_once 'getapikey.php';

function redirectTo(string $url): void {
    header("Location: $url");
    exit;
}

$required_params = ['status', 'montant', 'transaction', 'vendeur', 'control'];
foreach ($required_params as $param) {
    if (!isset($_GET[$param]) || trim($_GET[$param]) === '') {
        redirectTo('accueil.php');
    }
}

$status = $_GET['status'];
$montant = $_GET['montant'];
$transaction = $_GET['transaction'];
$vendeur = $_GET['vendeur'];
$control = $_GET['control'];

if (empty($_SESSION['id_reservation'])) {
    redirectTo('accueil.php');
}
$id_reservation = $_SESSION['id_reservation'];

$api_key = getAPIKey($vendeur);

if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
    http_response_code(403);
    exit('Clé API invalide.');
}

if ($status !== 'accepted') {
    redirectTo("panier.php");
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO achat (id_transaction, id_reservation, montant, vendeur, date_achat, heure_achat)
        VALUES (:id_transaction, :id_reservation, :montant, :vendeur, :date_achat, :heure_achat)
    ");

    $stmt->execute([
        ':id_transaction' => $transaction,
        ':id_reservation' => $id_reservation,
        ':montant' => $montant,
        ':vendeur' => $vendeur,
        ':date_achat' => date('Y-m-d'),
        ':heure_achat' => date('H:i:s')
    ]);

    unset($_SESSION['id_reservation']);

    redirectTo('profil.php');

} catch (PDOException $e) {
    http_response_code(500);
    exit("Erreur lors de l'enregistrement de l'achat : " . htmlspecialchars($e->getMessage()));
}
