<?php include('session.php') ?>
<?php
include('connexion_base.php');

if (isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    $query = "SELECT grade FROM utilisateur WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        switch ($user['grade']) {
            case 'membre':
                $new_grade = 'VIP';
                break;
            case 'VIP':
                $new_grade = 'admin';
                break;
            default:
                $new_grade = 'membre';
                break;
        }

        $query = "UPDATE utilisateur SET grade = :grade WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':grade', $new_grade);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Le grade de l'utilisateur a été mis à jour avec succès.";
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de la mise à jour du grade.";
        }
    } else {
        $_SESSION['error'] = "Utilisateur non trouvé.";
    }

    header("Location: administrateur.php");
    exit();
} else {
    $_SESSION['error'] = "Aucun utilisateur sélectionné.";
    header("Location: administrateur.php");
    exit();
}
