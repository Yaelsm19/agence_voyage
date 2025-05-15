<?php
session_start();
include('connexion_base.php');
header('Content-Type: application/json');
sleep(3);


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
            case 'admin':
                $new_grade = 'membre';
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
            echo json_encode(['success' => true, 'grade' => $new_grade]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => "Erreur lors de la mise à jour"]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Utilisateur non trouvé"]);
        exit();
    }
} else {
    echo json_encode(['success' => false, 'message' => "Aucun identifiant fourni"]);
    exit();
}
