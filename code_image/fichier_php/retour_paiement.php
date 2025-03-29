
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url=accueil.php">
    <title>retour paiement</title>
    <link rel="stylesheet" href="retour_paiement.css">
</head>
<body>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pastport";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    if (isset($_GET['transaction'], $_GET['montant'], $_GET['vendeur'], $_GET['status'], $_GET['control'])) {
        
        $transaction_id = $_GET['transaction'];
        $montant = $_GET['montant'];
        $vendeur = $_GET['vendeur'];
        $statut = $_GET['status'];
        $control = $_GET['control'];

        if ($statut == "accepted") {
            $sql = "INSERT INTO paiements (transaction_id, montant, vendeur, statut, control) 
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdsss", $transaction_id, $montant, $vendeur, $statut, $control);
        }
    }
    ?>
    <p>Si la redirection ne se produit pas, <a href="https://www.example.com">cliquez ici</a>.</p>
</body>
</html>
