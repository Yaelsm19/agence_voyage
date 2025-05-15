<?php
session_start();
if(!isset($_POST["autorisation"]) || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(403);
    exit("Accès interdit.");
}
else{
    define('ACCES_AUTORISE', true);
}
require_once 'connexion_base.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = trim($_POST["prenom"]);
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $telephone = trim($_POST["telephone"]);
    $password = $_POST["password"];
    $confirmation_password = $_POST["confirmation-password"];

    if (empty($prenom) || empty($nom) || empty($email) || empty($telephone) || empty($password) || empty($confirmation_password)) {
        $_SESSION["error"] = "Tous les champs sont obligatoires.";
        header("Location: s_inscrire.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "L'adresse email n'est pas valide.";
        header("Location: s_inscrire.php");
        exit;
    }

    if ($password !== $confirmation_password) {
        $_SESSION["error"] = "Les mots de passe ne correspondent pas.";
        header("Location: s_inscrire.php");
        exit;
    }

    $password_hache = password_hash($password, PASSWORD_DEFAULT);

    try {
        $query = "SELECT user_id FROM utilisateur WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION["error"] = "Cette adresse email est déjà utilisée.";
            header("Location: s_inscrire.php");
            exit;
        }

        $query = "INSERT INTO utilisateur (prenom, nom, email, numero, mot_de_passe, grade) 
                  VALUES (:prenom, :nom, :email, :telephone, :password_hache, 'membre')";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
        $stmt->bindParam(":password_hache", $password_hache, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $_SESSION["success"] = "Inscription réussie. Vous pouvez maintenant vous connecter.";
            header("Location: se_connecter.php");
            exit;
        } else {
            $_SESSION["error"] = "Erreur lors de l'inscription.";
            header("Location: s_inscrire.php");
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION["error"] = "Erreur : " . $e->getMessage();
        header("Location: s_inscrire.php");
        exit;
    }
}
?>
