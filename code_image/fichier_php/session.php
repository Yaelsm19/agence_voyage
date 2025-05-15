<?php
if (!defined('ACCES_AUTORISE_SESSION')) {
    http_response_code(403);
    exit('Accès interdit.');
}
define('ACCES_AUTORISE', true);
require_once 'connexion_base.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$page_actuelle = basename($_SERVER['PHP_SELF']);
$page_connecte = ["administrateur.php", "paiement.php", "panier.php", "profil.php", "recapitulatif.php", "réservation.php", "retour_paiement.php"];
if (!isset($_SESSION["user_id"]) and in_array($page_actuelle, $page_connecte)) {
    $_SESSION["error"] = "Vous n'êtes pas connecté, page non autorisé";
    header("Location: se_connecter.php");
    exit;
}
else if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
    try {
        $query = "SELECT * FROM utilisateur WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION["email"] = $user["email"];
            $_SESSION["prenom"] = $user["prenom"];
            $_SESSION["nom"] = $user["nom"];
            $_SESSION["numero"] = $user["numero"];
            $_SESSION["grade"] = $user["grade"];
            if ($_SESSION['grade'] === 'bloqué') {
                $_SESSION["error"] = "Votre compte est bloqué. Veuillez contacter l'administration.";
                header("Location: se_connecter.php");
                exit;
            }
        } 
        else {
            $_SESSION["error"] = "Utilisateur introuvable.";
            header("Location: se_connecter.php");
            exit;
        }
    } 
    catch (PDOException $e) {
        $_SESSION["error"] = "Erreur : " . $e->getMessage();
        header("Location: se_connecter.php");
        exit;
    }
}
?>
