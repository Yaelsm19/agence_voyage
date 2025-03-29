<?php
require('getapikey.php');
$retour = "http://localhost/agence_voyage/code_image/fichier_php/accueil.php"; 

// Vérification de la présence des paramètres
if (isset($_POST['transaction']) && isset($_POST['montant']) && isset($_POST['vendeur'])) {
    
    $transaction = $_POST['transaction'];
    $montant = $_POST['montant'];
    $vendeur = $_POST['vendeur'];
    $api_key = getAPIKey($vendeur);
    
    if (preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
        $control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");

        echo '
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Redirection automatique vers CY Bank</title>
            <script type="text/javascript">
                window.onload = function() {
                    // Soumettre le formulaire automatiquement après le chargement de la page
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
        // Message d'erreur si la clé API est invalide
        echo "Clé API invalide.";
    }
} else {
    // Message d'erreur si des paramètres sont manquants
    echo "Erreur : un ou plusieurs paramètres sont manquants.";
}
?>
