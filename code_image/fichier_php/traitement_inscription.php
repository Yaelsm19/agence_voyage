<?php
session_start();
require_once 'connexion_base.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = trim($_POST["prénom"]);
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $telephone = trim($_POST["telephone"]);
    $password = $_POST["password"];
    $confirmation_password = $_POST["confirmation_password"];

    if (empty($prenom) || empty($nom) || empty($email) || empty($telephone) || empty($password) || empty($confirmation_password)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "L'adresse email n'est pas valide.";
        exit;
    }

    if ($password !== $confirmation_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    $password_hache = password_hash($password, PASSWORD_DEFAULT);

    try {
        $query = "SELECT user_id FROM utilisateur WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Cette adresse email est déjà utilisée.";
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
            echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
            header("Location: se_connecter.php");
            exit;
        } else {
            echo "Erreur lors de l'inscription.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
