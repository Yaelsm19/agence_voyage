<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['autorisation'])) {
    http_response_code(403);
    exit('Accès interdit.');
}

define('ACCES_AUTORISE', true);
require_once 'connexion_base.php';

function redirect_with_error(string $message, string $email = ''): never
{
    $_SESSION['error'] = $message;
    $_SESSION['last_email'] = $email;
    header('Location: se_connecter.php');
    exit;
}


$lock_duration = 10 * 60;

if (isset($_SESSION['login_lock_time'])) {
    $lock_time = $_SESSION['login_lock_time'];
    if (time() - $lock_time < $lock_duration) {
        $remaining = $lock_duration - (time() - $lock_time);
        redirect_with_error("Trop de tentatives. Veuillez réessayer dans " . ceil($remaining / 60) . " minute(s).");
    } else {
        unset($_SESSION['login_lock_time']);
        $_SESSION['login_attempts'] = 0;
    }
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
    $sql = 'SELECT user_id, prenom, nom, mot_de_passe, numero, grade
            FROM utilisateur
            WHERE email = :email
            LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
        if ($_SESSION['login_attempts'] >= 5) {
            $_SESSION['login_lock_time'] = time();
            redirect_with_error('Trop de tentatives infructueuses. Connexion bloquée pour 10 minutes.', $email);
        }
        redirect_with_error('Aucun compte trouvé avec cet email.', $email);
    }

    if ($user['grade'] === 'bloqué') {
        redirect_with_error("Votre compte est bloqué. Veuillez contacter l'administration.", $email);
    }

    if (!password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
        if ($_SESSION['login_attempts'] >= 5) {
            $_SESSION['login_lock_time'] = time();
            redirect_with_error('Trop de tentatives infructueuses. Connexion bloquée pour 10 minutes.', $email);
        }
        redirect_with_error('Mot de passe incorrect.', $email);
    }

    $_SESSION['login_attempts'] = 0;
    unset($_SESSION['login_lock_time']);

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
    redirect_with_error('Une erreur interne est survenue.');
}
