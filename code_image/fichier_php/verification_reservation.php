<?php
if(!isset($_POST["autorisation"]) || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(403);
    exit("Accès interdit.");
}
else{
    define('ACCES_AUTORISE', true);
}
require_once 'connexion_base.php';
$messages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $nb_adultes = $_POST['adulte'];
    $nb_enfants = $_POST['enfant'];
    if (empty($date)) {
        $messages[] = "La date de départ est obligatoire.";
    } else if (strtotime($date) <= time()) {
        $messages[] = "La date de départ doit être strictement supérieure à aujourd'hui.";
    }
    if ($nb_adultes < 0 || $nb_adultes > 5) {
        $messages[] = "Le nombre d'adultes doit être compris entre 0 et 5.";
    }

    if ($nb_enfants < 0 || $nb_enfants > 5) {
        $messages[] = "Le nombre d'enfants doit être compris entre 0 et 5.";
    }

    if (!isset($_POST['choix'])) {
        $messages[] = "Veuillez sélectionner un moyen de transport.";
    }

    if (!isset($_POST['choix2'])) {
        $messages[] = "Veuillez sélectionner un guide temporel.";
    }

    if (isset($_POST['id_voyage']) && !empty($_POST['id_voyage'])) {
        $id_voyage = $_POST['id_voyage'];
        $stmt_voyage = $pdo->prepare("SELECT * FROM voyage WHERE id = :id_voyage");
        $stmt_voyage->execute(['id_voyage' => $id_voyage]);
        $voyage = $stmt_voyage->fetch(PDO::FETCH_ASSOC);
    } else {
        $messages[] = "Aucun voyage sélectionné.";
    }
    if (!empty($messages)) {
        $_SESSION["messages"] = $messages;
        if (isset($_POST["id_reservation"])) {
            echo "<form id='redirectForm' action='réservation.php' method='POST'>";
            echo "<input type='hidden' name='id_voyage' value='" . htmlspecialchars($id_voyage) . "'>";
            echo "<input type='hidden' name='id_reservation' value='" . htmlspecialchars($id_reservation) . "'>";
            echo "</form>";
            echo "<script>document.getElementById('redirectForm').submit();</script>";

        }
        else{
            echo "<form id='redirectForm' action='réservation.php' method='POST'>";
            echo "<input type='hidden' name='id_voyage' value='" . htmlspecialchars($id_voyage) . "'>";
            echo "</form>";
            echo "<script>document.getElementById('redirectForm').submit();</script>";

        }
        exit;
    }

    try {
        $stmt_etapes = $pdo->prepare("
            SELECT e.id AS etape_id, e.titre, o.id_option, o.intitule, o.prix_par_personne
            FROM etape e
            LEFT JOIN options o ON e.id = o.id_etape
            WHERE e.id_voyage = :id_voyage
            ORDER BY e.chronologie
        ");
        $stmt_etapes->execute(['id_voyage' => $id_voyage]);
        $etapes = $stmt_etapes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($etapes as $etape) {
            if (isset($etape['id_option']) && isset($_POST["nb_participant_" . $etape['id_option']])) {
                $option_key = "nb_participant_" . $etape['id_option'];
                if (isset($_POST[$option_key])) {
                    $nb_participants_option = $_POST[$option_key];
                    if ($nb_participants_option > ($nb_adultes + $nb_enfants)) {
                        $messages[] = "Le nombre de participants pour l'option {$etape['intitule']} dépasse le nombre total de personnes pour ce voyage.";
                    }
                }
            }
        }
    } catch (PDOException $e) {
        $messages[] = "Erreur de base de données : " . $e->getMessage();
    }
    if (empty($messages)) {
        if (isset($_POST["id_reservation"])) {
            $id_reservation = $_POST["id_reservation"];
            include 'modifier_reservation.php';
        } else {
            include 'ajouter_reservation.php';
        }
        if ($_POST['action'] === 'panier') {
            header("Location: panier.php");
        }
        else if ($_POST['action'] === 'reserver'){
            echo "<form id='redirectForm' action='recapitulatif.php' method='POST'>";
            echo "<input type='hidden' name='id_reservation' value='" . htmlspecialchars($id_reservation) . "'>";
            echo "</form>";
            echo "<script>document.getElementById('redirectForm').submit();</script>";
        }

        exit;
    } else {
        $_SESSION["messages"] = $messages;
        if (isset($_POST["id_reservation"])) {
            echo "<form id='redirectForm' action='réservation.php' method='POST'>";
            echo "<input type='hidden' name='id_voyage' value='" . htmlspecialchars($id_voyage) . "'>";
            echo "<input type='hidden' name='id_reservation' value='" . htmlspecialchars($id_reservation) . "'>";
            echo "</form>";
            echo "<script>document.getElementById('redirectForm').submit();</script>";

        }
        else{
            echo "<form id='redirectForm' action='réservation.php' method='POST'>";
            echo "<input type='hidden' name='id_voyage' value='" . htmlspecialchars($id_voyage) . "'>";
            echo "</form>";
            echo "<script>document.getElementById('redirectForm').submit();</script>";
        }
        exit;
    }
}
?>
