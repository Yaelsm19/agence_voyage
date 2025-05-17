<?php
$user_id = $_SESSION["user_id"];
$modifs = $_SESSION["modifications_reservation"];
var_dump($modifs["changement_guide"]);
var_dump($modifs["changement_transport"]);

if (!isset($_SESSION['id_reservation'])) {
    die("ID de réservation manquant.");
}
$reservation_id = intval($_SESSION['id_reservation']);

$nb_adultes = intval($modifs["nb_adultes"]);
$nb_enfants = intval($modifs["nb_enfants"]);

$guide = $modifs["prix"]["details"]["nouveau_guide"]["nom"];

$moyen_transport = $modifs["prix"]["details"]["nouveau_transport"]["nom"];
$vendeur = "MEF-1_J";
$date_achat = date("Y-m-d");
$heure_achat = date("H:i:s");

$montant_total = floatval($modifs["prix"]["nouveau_total"]);

$pdo->beginTransaction();

try {
    $sql_reservation = "UPDATE reservation
                        SET nb_adultes = :nb_adultes,
                            nb_enfants = :nb_enfants,
                            guide = :guide,
                            moyen_transport = :moyen_transport
                        WHERE id = :reservation_id AND id_utilisateur = :user_id";

    $stmt = $pdo->prepare($sql_reservation);
    $stmt->execute([
        ":nb_adultes" => $nb_adultes,
        ":nb_enfants" => $nb_enfants,
        ":guide" => $guide,
        ":moyen_transport" => $moyen_transport,
        ":reservation_id" => $reservation_id,
        ":user_id" => $user_id
    ]);
    foreach ($modifs["options"] as $option_modif) {
        $id_option = intval($option_modif["id_option"]);
        $ajout_participants = intval($option_modif["ajout_participants"]);
        if ($ajout_participants <= 0) {
            continue;
        }

        $stmt_check = $pdo->prepare("SELECT nb_personnes FROM souscrire WHERE id_reservation = :id_reservation AND id_option = :id_option");
        $stmt_check->execute([
            ":id_reservation" => $reservation_id,
            ":id_option" => $id_option
        ]);
        $exist = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($exist) {
            $nouveau_nb = $exist["nb_personnes"] + $ajout_participants;
            $stmt_update = $pdo->prepare("UPDATE souscrire SET nb_personnes = :nb_personnes WHERE id_reservation = :id_reservation AND id_option = :id_option");
            $stmt_update->execute([
                ":nb_personnes" => $nouveau_nb,
                ":id_reservation" => $reservation_id,
                ":id_option" => $id_option
            ]);
        } else {
            $stmt_insert = $pdo->prepare("INSERT INTO souscrire (id_reservation, id_option, nb_personnes) VALUES (:id_reservation, :id_option, :nb_personnes)");
            $stmt_insert->execute([
                ":id_reservation" => $reservation_id,
                ":id_option" => $id_option,
                ":nb_personnes" => $ajout_participants
            ]);
        }
    }
    $stmt_update_achat = $pdo->prepare("UPDATE achat SET montant = :montant, vendeur = :vendeur, date_achat = :date_achat, heure_achat = :heure_achat WHERE id_reservation = :id_reservation");
    $stmt_update_achat->execute([
        ":montant" => $montant_total,
        ":vendeur" => $vendeur,
        ":date_achat" => $date_achat,
        ":heure_achat" => $heure_achat,
        ":id_reservation" => $reservation_id
    ]);

    $pdo->commit();
    echo "Mise à jour effectuée avec succès.";

} catch (Exception $e) {
    $pdo->rollBack();
    echo "Erreur lors de la mise à jour : " . $e->getMessage();
}
