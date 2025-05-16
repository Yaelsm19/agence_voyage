<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit("Accès interdit.");
}
else{
    define('ACCES_AUTORISE', true);
}
ini_set('display_errors', 0);
error_reporting(0);

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}

header('Content-Type: application/json');
sleep(3);

function sendJsonResponse($success, $message = "", $data = []) {
    $response = ['success' => $success];
    if (!empty($message)) {
        $response['message'] = $message;
    }
    if (!empty($data)) {
        $response = array_merge($response, $data);
    }
    echo json_encode($response);
    exit;
}

ob_start();
require_once 'connexion_base.php';
ob_end_clean();

if (!isset($_SESSION['grade']) || $_SESSION['grade'] !== 'admin') {
    sendJsonResponse(false, "Accès non autorisé.");
}

if (!isset($_POST['user_id'])) {
    sendJsonResponse(false, "ID utilisateur manquant.");
}

$user_id = intval($_POST['user_id']);

try {
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_id) {
        sendJsonResponse(false, "Vous ne pouvez pas supprimer votre propre compte.");
    }

    $pdo->beginTransaction();
    
    $check = $pdo->prepare("SELECT user_id FROM utilisateur WHERE user_id = :user_id");
    $check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $check->execute();
    
    if ($check->rowCount() === 0) {
        $pdo->rollBack();
        sendJsonResponse(false, "Utilisateur introuvable.");
    }
    
    $query = "DELETE FROM utilisateur WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $pdo->commit();
        sendJsonResponse(true, "Utilisateur supprimé avec succès.");
    } else {
        $pdo->rollBack();
        sendJsonResponse(false, "Erreur lors de la suppression.");
    }
} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log("Erreur suppression utilisateur ID $user_id: " . $e->getMessage());
    sendJsonResponse(false, "Une erreur de base de données est survenue.");
} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log("Exception dans supprimer_utilisateur.php: " . $e->getMessage());
    sendJsonResponse(false, "Une erreur inattendue est survenue.");
}
?>