<?php
define('ACCES_AUTORISE_SESSION', true);
include('session.php');
require_once 'connexion_base.php';
if ($_SESSION['grade'] !== 'admin') {
    header("Location: accueil.php");
    exit();
}
$users_per_page = 5;
$query = "SELECT COUNT(*) FROM utilisateur";
$stmt = $pdo->prepare($query);
$stmt->execute();
$total_users = $stmt->fetchColumn();
$total_pages = ceil($total_users / $users_per_page);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $users_per_page;
$query = "SELECT user_id, prenom, nom, email, numero, grade FROM utilisateur LIMIT :start, :limit";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':limit', $users_per_page, PDO::PARAM_INT);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_SESSION['success'])) {
    echo "<div style='color: green; padding: 10px; background-color: #d4edda;'>";
    echo $_SESSION['success'];
    echo "</div>";
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo "<div style='color: red; padding: 10px; background-color: #f8d7da;'>";
    echo $_SESSION['error'];
    echo "</div>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pastport</title>
    <script src="../fichier_java/changer_mode.js"></script>
    <script src="../fichier_java/chargement.js"></script>
    <link id="theme-stylesheet" rel="stylesheet" href="../fichier_css/variables_sombre.css">
    <link rel="stylesheet" href="../fichier_css/administrateur.css">
    <link rel="stylesheet" href="../fichier_css/header.css">
    <link rel="icon" href="../Image/image_icône/Passport_logo.png">
</head>
<body>
    <?php include('header.php') ?>
    <div class="container">
        <table>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Grade</th>
                <th>Status</th>
                <th>Action</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                <td><?php echo htmlspecialchars($user['prenom']); ?></td>
                <td><?php echo htmlspecialchars($user['nom']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['numero']); ?></td>
                <td class="grade-cell <?php echo 'grade-' . htmlspecialchars($user['grade']); ?>" data-user-id="<?php echo $user['user_id']; ?>">
                    <?php echo htmlspecialchars($user['grade']); ?>
                </td>

                <td>
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                    <?php
                    $image = '';
                    $altText = '';
                    switch ($user['grade']) {
                        case 'admin':
                            $image = '../Image/image_icône/niveau_admin.png';
                            $altText = 'Admin';
                        break;
                        case 'VIP':
                            $image = '../Image/image_icône/niveau_VIP.png';
                            $altText = 'VIP';
                        break;
                        case 'membre':
                            $image = '../Image/image_icône/niveau_membre.png';
                            $altText = 'Membre';
                        break;
                        case 'bloqué':
                            $image = '../Image/image_icône/niveau_bloqué.png';
                            $altText = 'Bloqué';
                        break;
                    }
                    ?>

                    <button type="button" class="action editer bouton-grade" onclick="changementgrade(event)" data-user-id="<?php echo $user['user_id']; ?>">
                        <img src="<?php echo $image; ?>" alt="<?php echo $altText; ?>" class="grade-img" />
                    </button>

                </td>
                <td>
                    <button type="button" class="action bloquer bouton-blocage" onclick="Blocage(event)" data-user-id="<?php echo $user['user_id']; ?>" data-grade="<?php echo $user['grade']; ?>">
                        <img src="../Image/image_icône/<?php echo ($user['grade'] == 'bloqué') ? 'debloquer' : 'bloquer'; ?>.png" alt="<?php echo ($user['grade'] == 'bloqué') ? 'debloquer' : 'bloquer'; ?>">
                    </button>
                </td>
                
                <td>
                    <button type="button" id = "supprimer" class="action supprimer bouton-supprimer" onclick="SupprimerUtilisateur(event)" data-user-id="<?php echo $user['user_id']; ?>">
                        <img src="../Image/image_icône/supprimer.png" alt="supprimer">
                    </button>
                </td>

            </tr>
            <?php endforeach; ?>
        </table>

        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>
    <p>&copy; 2025 Pastport - Tous droits réservés.</p>
</body>
</html>
