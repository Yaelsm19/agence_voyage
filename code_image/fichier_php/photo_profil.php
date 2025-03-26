<?php
session_start();

$userId = $_SESSION['user_id'];

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
    $file = $_FILES['profile_pic'];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (in_array($file['type'], $allowedTypes)) {
        $uploadDir = '../Image/photo_profil_utilisateurs/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $existingFile = $uploadDir . 'profil_' . $userId . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        if (file_exists($existingFile)) {
            unlink($existingFile);
        }
        $fileName = 'profil_' . $userId . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $filePath = $uploadDir . $fileName;
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $_SESSION['success'] = "Photo de profil mise à jour avec succès.";
        } else {
            $_SESSION['error'] = "Le téléchargement de l'image a échoué.";
        }
    } else {
        $_SESSION['error'] = "Le fichier doit être une image JPEG, PNG ou JPG.";
    }
} else {
    $_SESSION['error'] = "Aucun fichier sélectionné ou erreur lors de l'upload.";
}

header('Location: profil.php');
exit();
