<?php
require_once 'connexion_base.php';
$messages = [];
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $nb_adultes = $_POST['adulte'];
    $nb_enfants = $_POST['enfant'];

    if (empty($date)) {
        $messages[] = "La date de départ est obligatoire.";
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
        header("Location: réservation.php?id=" . urlencode($id_voyage));
        exit;
    }

    try {
        $stmt_etapes = $pdo->prepare("SELECT * FROM etape WHERE id_voyage = :id_voyage");
        $stmt_etapes->execute(['id_voyage' => $id_voyage]);
        $etapes = $stmt_etapes->fetchAll(PDO::FETCH_ASSOC);

        foreach ($etapes as $etape) {
            if (isset($etape['options']) && is_array($etape['options'])) {
                foreach ($etape['options'] as $option) {
                    $option_key = "nb_participant_" . $option['id_option'];

                    if (isset($_POST[$option_key])) {
                        $nb_participants_option = $_POST[$option_key];
                        if ($nb_participants_option > ($nb_adultes + $nb_enfants)) {
                            $messages[] = "Le nombre de participants pour l'option {$option['intitule']} dépasse le nombre total de personnes pour ce voyage.";
                        }
                    }
                }
            }
        }

        $prix_total = 0;
        $prix_total = $prix_total + ($nb_adultes + $nb_enfants) * $voyage["prix"];

    } catch (PDOException $e) {
        $messages[] = "Erreur de base de données : " . $e->getMessage();
    }

    $_SESSION["messages"] = $messages;
    header("Location: réservation.php?id=" . urlencode($id_voyage));
    exit;
}
?>
