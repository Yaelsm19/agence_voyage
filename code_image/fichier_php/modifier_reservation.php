<?php
if (!defined('ACCES_AUTORISE')) {
    http_response_code(403);
    exit("Accès interdit.");
}
try {
    $stmt_verifier_reservation = $pdo->prepare("SELECT id FROM reservation WHERE id_utilisateur = :id_utilisateur AND id = :id_reservation");
    $stmt_verifier_reservation->execute([
        'id_utilisateur' => $_SESSION['user_id'],
        'id_reservation' => $id_reservation,
    ]);
    $reservation_existante = $stmt_verifier_reservation->fetch();

    if ($reservation_existante) {
        $stmt_mettre_a_jour_reservation = $pdo->prepare("
            UPDATE reservation
            SET
                date_reservation = :date_reservation,
                heure_reservation = :heure_reservation,
                date_voyage = :date_voyage,
                nb_adultes = :nb_adultes,
                nb_enfants = :nb_enfants,
                moyen_transport = :moyen_transport,
                guide = :guide
            WHERE id = :id_reservation
        ");
        $stmt_mettre_a_jour_reservation->execute([
            'id_reservation' => $id_reservation,
            'date_reservation' => date("Y-m-d"),
            'heure_reservation' => date("H:i:s"),
            'date_voyage' => $_POST['date'],
            'nb_adultes' => $_POST['adulte'],
            'nb_enfants' => $_POST['enfant'],
            'moyen_transport' => $_POST['choix'],
            'guide' => $_POST['choix2'],
        ]);
        $stmt_obtenir_souscriptions = $pdo->prepare("SELECT id_option, nb_personnes FROM souscrire WHERE id_reservation = :id_reservation");
        $stmt_obtenir_souscriptions->execute(['id_reservation' => $id_reservation]);
        $souscriptions_existantes = $stmt_obtenir_souscriptions->fetchAll(PDO::FETCH_ASSOC);

        foreach ($_POST as $cle => $valeur) {
            if (strpos($cle, 'nb_participant_') === 0) {
                $id_option = substr($cle, strlen('nb_participant_'));

                if ($valeur > 0) {
                    $stmt_verifier_option = $pdo->prepare("SELECT * FROM souscrire WHERE id_reservation = :id_reservation AND id_option = :id_option");
                    $stmt_verifier_option->execute([
                        'id_reservation' => $id_reservation,
                        'id_option' => $id_option
                    ]);
                    $option_existante = $stmt_verifier_option->fetch();

                    if ($option_existante) {
                        $stmt_mettre_a_jour_souscription = $pdo->prepare("
                            UPDATE souscrire
                            SET nb_personnes = :nb_personnes
                            WHERE id_reservation = :id_reservation AND id_option = :id_option
                        ");
                        $stmt_mettre_a_jour_souscription->execute([
                            'nb_personnes' => $valeur,
                            'id_reservation' => $id_reservation,
                            'id_option' => $id_option
                        ]);
                    } else {
                        $stmt_ajouter_souscription = $pdo->prepare("
                            INSERT INTO souscrire (id_reservation, id_option, nb_personnes)
                            VALUES (:id_reservation, :id_option, :nb_personnes)
                        ");
                        $stmt_ajouter_souscription->execute([
                            'id_reservation' => $id_reservation,
                            'id_option' => $id_option,
                            'nb_personnes' => $valeur
                        ]);
                    }
                }
                else {
                    $stmt_supprimer_souscription = $pdo->prepare("
                        DELETE FROM souscrire
                        WHERE id_reservation = :id_reservation AND id_option = :id_option
                    ");
                    $stmt_supprimer_souscription->execute([
                        'id_reservation' => $id_reservation,
                        'id_option' => $id_option
                    ]);
                }
            }
        }

        foreach ($souscriptions_existantes as $souscription) {
            $id_option_existante = $souscription['id_option'];
            if (!isset($_POST["nb_participant_" . $id_option_existante])) {
                $stmt_supprimer_souscription = $pdo->prepare("
                    DELETE FROM souscrire
                    WHERE id_reservation = :id_reservation AND id_option = :id_option
                ");
                $stmt_supprimer_souscription->execute([
                    'id_reservation' => $id_reservation,
                    'id_option' => $id_option_existante
                ]);
            }
        }

    } else {
        echo "Aucune réservation trouvée à modifier.";
    }

} catch (PDOException $e) {
    echo "Erreur de base de données : " . $e->getMessage();
    exit;
}
