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
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $_SESSION["error"] = "Tous les champs sont obligatoires.";
        header("Location: se_connecter.php");
        exit;
    }

    try {
        $query = "SELECT user_id, prenom, nom, mot_de_passe, numero, grade FROM utilisateur WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user['grade'] == 'bloqué') {
                $_SESSION["error"] = "Votre compte est bloqué. Veuillez contacter l'administration.";
                header("Location: se_connecter.php");
                exit;
            }

            if (password_verify($password, $user["mot_de_passe"])) {
                $_SESSION["email"] = $email;
                $_SESSION["user_id"] = $user["user_id"];
                $_SESSION["prenom"] = $user["prenom"];
                $_SESSION["nom"] = $user["nom"];
                $_SESSION["numero"] = $user["numero"];
                $_SESSION["grade"] = $user["grade"];

                header("Location: connexion_réussie.php");
                exit;
            } else {
                $_SESSION["error"] = "Mot de passe incorrect.";
                header("Location: se_connecter.php");
                exit;
            }
        } else {
            $_SESSION["error"] = "Aucun compte trouvé avec cet email.";
            header("Location: se_connecter.php");
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION["error"] = "Erreur : " . $e->getMessage();
        header("Location: se_connecter.php");
        exit;
    }
}
?>
