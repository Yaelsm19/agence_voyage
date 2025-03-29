<?php
require('getapikey.php');
$retour = "http://localhost/projet_voyage_wamp/retour_paiement.php"; 


if (isset($_POST['transaction']) && isset($_POST['montant']) && isset($_POST['vendeur']) && isset($_POST['retour'])) {
    
    
    $transaction = $_POST['transaction'];
    $montant = $_POST['montant'];
    $vendeur = $_POST['vendeur'];
    $retour = $_POST['retour']; 

    $api_key = getAPIKey($vendeur);

    if (preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
        $control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");

        echo "
        <form action='https://www.plateforme-smc.fr/cybank/index.php' method='POST'>
            <input type='hidden' name='transaction' value='$transaction'>
            <input type='hidden' name='montant' value='$montant'>
            <input type='hidden' name='vendeur' value='$vendeur'>
            <input type='hidden' name='retour' value='$retour'>
            <input type='hidden' name='control' value='$control'>
            <div class="form-group">
                <button type="submit">Procéder au paiement</button>
            </div>
        </form>
        ";
    } else {
        echo "Clé API invalide.";
    }
} else {
    echo "Erreur : un ou plusieurs paramètres sont manquants.";
}
?>