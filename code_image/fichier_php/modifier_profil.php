<?php 
define('ACCES_AUTORISE_SESSION', true);
include('session.php');
?>
<?php
if(!isset($_POST["autorisation"]) || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(403);
    exit("Accès interdit.");
}
include('connexion_base.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = "Vous devez être connecté pour mettre à jour votre profil.";
        header("Location: se_connecter.php");
        exit();
    }

    $email   = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $prenom  = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $nom     = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $numero  = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);

    if (empty($email) || empty($prenom) || empty($nom) || empty($numero)) {
        $_SESSION['error'] = "Tous les champs doivent être remplis.";
        header("Location: profil.php");
        exit();
    }

    $sql = "UPDATE utilisateur SET email = :email, prenom = :prenom, nom = :nom, numero = :numero WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['email'] = $email;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        $_SESSION['numero'] = $numero;

        header("Location: profil.php");
        exit();
    } else {
        $_SESSION['error'] = "Erreur lors de la mise à jour du profil.";
        header("Location: profil.php");
        exit();
    }
} else {
    header("Location: profil.php");
    exit();
}
?>
