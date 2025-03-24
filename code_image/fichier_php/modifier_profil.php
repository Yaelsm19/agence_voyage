<?php
session_start();
include('connexion_base.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['user_id'])) {
        header("Location: se_connecter.php");
        exit();
    }

    $email   = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $prenom  = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $nom     = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $numero  = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);

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

        header("Location: profil.php?success=1");
        exit();
    } else {
        echo "Erreur lors de la mise à jour du profil.";
    }
} else {
    header("Location: profil.php");
    exit();
}
?>
