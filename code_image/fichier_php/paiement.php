<?php
session_start();
if(!isset($_POST["autorisation"]) || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(403);
    exit("Accès interdit.");
}
else{
    define('ACCES_AUTORISE', true);
}
require('getapikey.php');
$retour = "http://localhost/agence_voyage/code_image/fichier_php/retour_paiement.php"; 

function generateTransactionId() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = rand(10, 24);
    $transactionId = '';
    for ($i = 0; $i < $length; $i++) {
        $transactionId .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $transactionId;
}
if (isset($_POST['montant']) && isset($_POST['vendeur']) && isset($_POST['id_reservation'])) {
    if(isset($_SESSION['autorisation'])){
        unset($_SESSION['autorisation']);
    }
    if (isset($_SESSION['id_reservation'])) {
        unset($_SESSION['id_reservation']);
    }
    if(isset($_SESSION["completer"])){
        unset($_SESSION["completer"]);
    }
    if(isset($_POST["completer"])){
        $_SESSION["completer"] = true;
    }
    $_SESSION['id_reservation'] = $_POST['id_reservation'];
    $transaction = generateTransactionId();
    $montant = $_POST['montant'];
    $vendeur = $_POST['vendeur'];
    $api_key = getAPIKey($vendeur);
    
    if (preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
        $_SESSION["autorisation"] = true;
        $control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
        echo '
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Redirection automatique vers CY Bank</title>
            <script type="text/javascript">
                window.onload = function() {
                    document.getElementById("paymentForm").submit();
                };
            </script>
        </head>
        <body>
            <h1>Redirection en cours...</h1>
            <form id="paymentForm" action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
                <input type="hidden" name="transaction" value="' . htmlspecialchars($transaction) . '">
                <input type="hidden" name="montant" value="' . htmlspecialchars($montant) . '">
                <input type="hidden" name="vendeur" value="' . htmlspecialchars($vendeur) . '">
                <input type="hidden" name="retour" value="' . htmlspecialchars($retour) . '">
                <input type="hidden" name="control" value="' . htmlspecialchars($control) . '">
            </form>
        </body>
        </html>
        ';
    } else {
        echo "Clé API invalide.";
    }
} else {
    echo "Erreur : un ou plusieurs paramètres sont manquants.";
}
?>
