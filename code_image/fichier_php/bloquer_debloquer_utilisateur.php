<?php
include('connexion_base.php');

if (isset($_GET['id']) && isset($_GET['grade'])) {
    $user_id = intval($_GET['id']);
    $current_grade = $_GET['grade'];

    $new_grade = ($current_grade == 'membre') ? 'bloqué' : 'membre';


    $query = "UPDATE utilisateur SET grade = :grade WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':grade', $new_grade);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['success'] = "L'utilisateur a été " . ($new_grade == 'membre' ? 'débloqué' : 'bloqué') . " avec succès.";
    } else {
        $_SESSION['error'] = "Une erreur s'est produite lors de la mise à jour de l'utilisateur.";
    }

    header("Location: administrateur.php");
    exit();
} else {
    $_SESSION['error'] = "Aucun utilisateur sélectionné.";
    header("Location: administrateur.php");
    exit();
}
?>
