<?php include('session.php') ?>
<?php
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: se_connecter.php");
    exit;
}
?>