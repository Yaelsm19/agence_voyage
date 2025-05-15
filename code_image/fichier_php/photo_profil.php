<?php
if(!isset($_POST["autorisation"]) || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(403);
    exit("Accès interdit.");
}
session_start();
$userId = $_SESSION['user_id'];

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
    $file = $_FILES['profile_pic'];

    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    $allowedExtensions = ['png', 'jpeg', 'jpg'];
    if (in_array($fileExtension, $allowedExtensions)) {
        $uploadDir = '../Image/photo_profil_utilisateurs/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        foreach ($allowedExtensions as $extension) {
            $existingFile = $uploadDir . 'profil_' . $userId . '.' . $extension;
            if (file_exists($existingFile)) {
                unlink($existingFile);
            }
        }
        $fileName = 'profil_' . $userId . '.' . $fileExtension;
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $_SESSION['success'] = "Photo de profil mise à jour avec succès.";
        } else {
            $_SESSION['error'] = "Le téléchargement de l'image a échoué.";
        }
    } else {
        $_SESSION['error'] = "Le fichier doit être une image PNG, JPEG ou JPG.";
    }
} else {
    $_SESSION['error'] = "Aucun fichier sélectionné ou erreur lors de l'upload.";
}

header('Location: profil.php');
exit();
