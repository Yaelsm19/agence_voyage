<?php
require('getapikey.php');
$retour = "http://localhost/agence_voyage/code_image/fichier_php/retour_paiement.php"; 

// Vérification de la présence des paramètres
if (isset($_POST['transaction']) && isset($_POST['montant']) && isset($_POST['vendeur'])) {
    
    $transaction = $_POST['transaction'];
    $montant = $_POST['montant'];
    $vendeur = $_POST['vendeur'];
    $api_key = getAPIKey($vendeur);
    if (preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
        $control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
        echo '
        <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
            <input type="hidden" name="transaction" value="' . htmlspecialchars($transaction) . '">
            <input type="hidden" name="montant" value="' . htmlspecialchars($montant) . '">
            <input type="hidden" name="vendeur" value="' . htmlspecialchars($vendeur) . '">
            <input type="hidden" name="retour" value="' . htmlspecialchars($retour) . '">
            <input type="hidden" name="control" value="' . htmlspecialchars($control) . '">
            <div class="form-group">
                <button type="submit">Procéder au paiement</button>
            </div>
        </form>
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
