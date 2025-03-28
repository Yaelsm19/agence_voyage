<?php
session_start();
include('connexion_base.php');

$query = "SELECT user_id, prenom, nom, email, numero, grade FROM utilisateur";
$stmt = $pdo->prepare($query);
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
    <link rel="stylesheet" href="..\fichier_css\administrateur.css">
    <link rel="icon" href="../Image/image_icône/Passport_logo.jpg">
</head>
<body>
    <h1>Gestion des Utilisateurs</h1>
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
                <td class="<?php echo 'grade-' . htmlspecialchars($user['grade']); ?>">
                    <?php echo htmlspecialchars($user['grade']); ?>
                </td>
                
                <td>
                    <form action="modifier_grade.php" method="POST">
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
                        <button type="submit" class="action editer">
                            <img src="<?php echo $image; ?>" alt="<?php echo $altText; ?>" />
                        </button>
                    </form>
                </td>
                <td>
                    <a href="bloquer_debloquer_utilisateur.php?id=<?php echo $user['user_id']; ?>&grade=<?php echo $user['grade']; ?>" class="action bloquer">
                        <img src="..\Image\image_icône\<?php echo ($user['grade'] == 'bloqué') ? 'debloquer' : 'bloquer'; ?>.png" alt="<?php echo ($user['grade'] == 'bloqué') ? 'debloquer' : 'bloquer'; ?>">
                    </a>
                </td>

                <td>
                    <a href="supprimer_utilisateur.php?id=<?php echo $user['user_id']; ?>" class="action supprimer">
                        <img src="..\Image\image_icône\supprimer.png" alt="supprimer">
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <p>&copy; 2025 Pastport - Tous droits réservés.</p>
</body>
</html>
