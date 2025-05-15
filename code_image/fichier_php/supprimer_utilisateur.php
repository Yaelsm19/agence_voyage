<?php
define('ACCES_AUTORISE_SESSION', true);
include('session.php')
 ?>
<?php
include('connexion_base.php');

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $query = "DELETE FROM utilisateur WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {

        $_SESSION['success'] = "L'utilisateur a été supprimé avec succès.";
        header("Location: administrateur.php");
        exit();
    } else {
        $_SESSION['error'] = "Une erreur s'est produite lors de la suppression de l'utilisateur.";
        header("Location: administrateur.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Aucun utilisateur sélectionné à supprimer.";
    header("Location: administrateur.php");
    exit();
}
?>
