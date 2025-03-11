<?php
session_start();
require_once 'connexion_base.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    try {
        $query = "SELECT id, prenom, nom, mot_de_passe, grade FROM utilisateur WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user["mot_de_passe"])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["prenom"] = $user["prenom"];
                $_SESSION["nom"] = $user["nom"];
                $_SESSION["grade"] = $user["grade"];

                echo "Connexion réussie.";
                header("Location: connexion_réussie.php");
                exit;
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Aucun compte trouvé avec cet email.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
