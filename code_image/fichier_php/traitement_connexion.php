<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['autorisation'])) {
    http_response_code(403);
    exit('Accès interdit.');
}

define('ACCES_AUTORISE', true);
require_once 'connexion_base.php';

function redirect_with_error(string $message, string $email = ''): never {
    $_SESSION['error'] = $message;
    $_SESSION['last_email'] = $email;
    header('Location: se_connecter.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$captcha_user = trim($_POST['captcha'] ?? '');

if (!isset($_SESSION['captcha_answer']) || $captcha_user === '' || intval($captcha_user) !== $_SESSION['captcha_answer']) {
    unset($_SESSION['captcha_answer']);
    redirect_with_error('Réponse au captcha incorrecte.', $email);
}
unset($_SESSION['captcha_answer']);

if ($email === '' || $password === '') {
    redirect_with_error('Tous les champs sont obligatoires.', $email);
}

try {
    $sql = 'SELECT user_id, prenom, nom, mot_de_passe, numero, grade, failed_login_attempts, lock_expires_at
            FROM utilisateur
            WHERE email = :email
            LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        redirect_with_error('Aucun compte trouvé avec cet email.', $email);
    }
    
    if ($user['lock_expires_at'] !== null && strtotime($user['lock_expires_at']) > time()) {
        $remaining = ceil((strtotime($user['lock_expires_at']) - time()) / 60);
        redirect_with_error("Ce compte est temporairement bloqué. Veuillez réessayer dans {$remaining} minute(s).", $email);
    }
    
    if ($user['grade'] === 'bloqué') {
        redirect_with_error("Votre compte est bloqué. Veuillez contacter l'administration.", $email);
    }
    
    if (!password_verify($password, $user['mot_de_passe'])) {
        $attempts = (is_null($user['failed_login_attempts']) ? 0 : intval($user['failed_login_attempts'])) + 1;
        $lockDuration = 10 * 60;
        $lock_expires = null;
        
        if ($attempts >= 5) {
            $lock_expires = date('Y-m-d H:i:s', time() + $lockDuration);
        }
        
        error_log("User ID: " . $user['user_id'] . " - Attempts: " . $attempts . " - Lock: " . ($lock_expires ?? 'NULL'));
        
        $update_sql = "UPDATE utilisateur 
                      SET failed_login_attempts = :attempts,
                          lock_expires_at = :lock_expires 
                      WHERE user_id = :id";
        
        $stmt = $pdo->prepare($update_sql);
        $params = [
            'attempts' => $attempts,
            'lock_expires' => $lock_expires,
            'id' => $user['user_id']
        ];
        
        $update_success = $stmt->execute($params);
        
        if (!$update_success) {
            error_log("Erreur lors de la mise à jour des tentatives: " . implode(", ", $stmt->errorInfo()));
        } else {
            error_log("Mise à jour réussie pour user_id: " . $user['user_id'] . " - Nouvelles tentatives: " . $attempts);
        }
        
        if ($attempts >= 5) {
            redirect_with_error('Trop de tentatives. Ce compte est bloqué pour 10 minutes.', $email);
        }
        
        redirect_with_error('Mot de passe incorrect.', $email);
    }
    
    $stmt = $pdo->prepare(
        'UPDATE utilisateur 
         SET failed_login_attempts = 0,
             lock_expires_at = NULL 
         WHERE user_id = :id'
    );
    $stmt->execute(['id' => $user['user_id']]);
    
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['email'] = $email;
    $_SESSION['prenom'] = $user['prenom'];
    $_SESSION['nom'] = $user['nom'];
    $_SESSION['numero'] = $user['numero'];
    $_SESSION['grade'] = $user['grade'];
    
    header('Location: connexion_réussie.php');
    exit;
    
} catch (PDOException $e) {
    error_log('Erreur PDO connexion : ' . $e->getMessage());
    redirect_with_error('Une erreur interne est survenue.', $email);
}