<?php
require_once 'connexion_base.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données envoyées via le formulaire
    $date = $_POST['date'];  // Date de départ
    $nb_adultes = $_POST['adulte'];  // Nombre d'adultes
    $nb_enfants = $_POST['enfant'];  // Nombre d'enfants

    // Vérification des champs de base
    // 1. Vérification de la date de départ
    if (empty($date)) {
        echo "La date de départ est obligatoire.";
        exit;
    }

    // 2. Vérification du nombre d'adultes
    if ($nb_adultes < 0 || $nb_adultes > 5) {
        echo "Le nombre d'adultes doit être compris entre 0 et 5.";
        exit;
    }

    // 3. Vérification du nombre d'enfants
    if ($nb_enfants < 0 || $nb_enfants > 5) {
        echo "Le nombre d'enfants doit être compris entre 0 et 5.";
        exit;
    }

    // 4. Vérification que l'utilisateur a bien sélectionné un moyen de transport
    if (!isset($_POST['choix'])) {
        echo "Veuillez sélectionner un moyen de transport.";
        exit;
    }

    // 5. Vérification que l'utilisateur a bien sélectionné un guide
    if (!isset($_POST['choix2'])) {
        echo "Veuillez sélectionner un guide temporel.";
        exit;
    }

    // Vérification de l'ID du voyage (passé dans un champ caché)
    if (isset($_POST['id_voyage']) && !empty($_POST['id_voyage'])) {
        $id_voyage = $_POST['id_voyage'];
    } else {
        echo "Aucun voyage sélectionné.";
        exit;
    }

    try {
        // Récupérer les étapes et options du voyage à partir de l'ID
        $stmt_etapes = $pdo->prepare("SELECT * FROM etape WHERE id_voyage = :id_voyage");
        $stmt_etapes->execute(['id_voyage' => $id_voyage]);
        $etapes = $stmt_etapes->fetchAll(PDO::FETCH_ASSOC);

        // Vérification des options pour chaque étape
        foreach ($etapes as $etape) {
            // Vérifier si la clé 'options' existe et est un tableau
            if (isset($etape['options']) && is_array($etape['options'])) {
                foreach ($etape['options'] as $option) {
                    // Clé pour récupérer le nombre de participants de cette option
                    $option_key = "nb_participant_" . $option['id_option'];

                    if (isset($_POST[$option_key])) {
                        $nb_participants_option = $_POST[$option_key];

                        // Vérifier que le nombre de participants pour cette option ne dépasse pas le nombre total de personnes
                        if ($nb_participants_option > ($nb_adultes + $nb_enfants)) {
                            echo "Le nombre de participants pour l'option {$option['intitule']} dépasse le nombre total de personnes pour ce voyage.";
                            exit;
                        }
                    }
                }
            }
        }

        // Si tout est valide
        echo "Réservation validée avec succès!";
        // À ce stade, tu peux ajouter du code pour enregistrer la réservation dans la base de données ou effectuer d'autres actions.

    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    }
}
?>
