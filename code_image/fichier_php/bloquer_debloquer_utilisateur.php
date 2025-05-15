<?php
session_start();
include('connexion_base.php');
header('Content-Type: application/json');
sleep(3);

if (!isset($_POST['user_id']) || !is_numeric($_POST['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'ID invalide']);
    exit();
}

$user_id = intval($_POST['user_id']);

$stmt = $pdo->prepare("SELECT grade FROM utilisateur WHERE user_id = :id");
$stmt->execute([':id' => $user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable']);
    exit();
}

$current_grade = $user['grade'];
$new_grade = ($current_grade === 'bloqué') ? 'membre' : 'bloqué';

$update = $pdo->prepare("UPDATE utilisateur SET grade = :grade WHERE user_id = :id");
$success = $update->execute([':grade' => $new_grade, ':id' => $user_id]);

echo json_encode([
    'success' => $success,
    'grade' => $new_grade
]);
