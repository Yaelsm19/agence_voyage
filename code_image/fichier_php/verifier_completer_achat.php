<?php
if (!defined('ACCES_AUTORISE')) {
    http_response_code(403);
    exit("Accès interdit.");
}

$messages = [];
if (isset($_SESSION["modifications_reservation"])) {
    unset($_SESSION["modifications_reservation"]);
}
if (!isset($_POST["id_reservation"])) {
    $messages[] = "Aucune réservation à compléter.";
} else {
    $id_reservation = $_POST["id_reservation"];

    $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id = :id");
    $stmt->execute(['id' => $id_reservation]);
    $reservation_ancienne = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reservation_ancienne) {
        $messages[] = "Réservation introuvable.";
    } else {
        $modifications = [
            "nb_adultes" => null,
            "nb_enfants" => null,
            "options" => [],
            "changement_guide" => null,
            "changement_transport" => null,
            "prix" => []
        ];

        if ($_POST["date"] !== $reservation_ancienne["date_voyage"]) {
            $messages[] = "La date de départ ne peut pas être modifiée.";
        }

        $ancien_total = $reservation_ancienne["nb_adultes"] + $reservation_ancienne["nb_enfants"];
        $nouveau_adultes = intval($_POST["adulte"]);
        $nouveau_enfants = intval($_POST["enfant"]);
        $nouveau_total = $nouveau_adultes + $nouveau_enfants;

        if ($nouveau_total < $ancien_total) {
            $messages[] = "Le nombre total de personnes ne peut pas diminuer.";
        }

        $stmt_options = $pdo->prepare("
            SELECT s.id_option, s.nb_personnes, o.intitule, o.prix_par_personne
            FROM souscrire s
            JOIN options o ON s.id_option = o.id_option
            WHERE s.id_reservation = :id_reservation
        ");

        $stmt_options->execute(['id_reservation' => $id_reservation]);
        $options_anciennes = $stmt_options->fetchAll(PDO::FETCH_ASSOC);

        $total_options_nouveau = 0;
        $options_nouvelles = [];

        $cles_options_anciennes = array_column($options_anciennes, 'id_option');

        foreach ($options_anciennes as $ancienne) {
            $cle = "nb_participant_" . $ancienne["id_option"];
            $nouveau_nb = isset($_POST[$cle]) ? intval($_POST[$cle]) : 0;

            if ($nouveau_nb < $ancienne["nb_personnes"]) {
                $messages[] = "Le nombre de participants pour l'option " . htmlspecialchars($ancienne["intitule"]) . " ne peut pas diminuer.";
                continue;
            }

            $total_options_nouveau += $nouveau_nb * floatval($ancienne["prix_par_personne"]);

            if ($nouveau_nb > $ancienne["nb_personnes"]) {
                $ajout = $nouveau_nb - $ancienne["nb_personnes"];
                $cout_ajout = $ajout * floatval($ancienne["prix_par_personne"]);
                $modifications["options"][] = [
                    "id_option" => $ancienne["id_option"],
                    "intitule" => $ancienne["intitule"],
                    "ajout_participants" => $ajout,
                    "prix_par_personne" => $ancienne["prix_par_personne"],
                    "prix_total_ajout" => $cout_ajout
                ];
            }

            $options_nouvelles[$ancienne["id_option"]] = $nouveau_nb;
        }
        foreach ($_POST as $cle_post => $valeur_post) {
            if (strpos($cle_post, 'nb_participant_') === 0) {
                $id_option_post = intval(substr($cle_post, strlen('nb_participant_')));
                if (!in_array($id_option_post, $cles_options_anciennes)) {
                    $nouveau_nb = intval($valeur_post);
                    if ($nouveau_nb > 0) {
                        $stmt_opt = $pdo->prepare("SELECT intitule, prix_par_personne FROM options WHERE id_option = :id_option");
                        $stmt_opt->execute(['id_option' => $id_option_post]);
                        $option_data = $stmt_opt->fetch(PDO::FETCH_ASSOC);

                        if ($option_data) {
                            $cout_ajout = $nouveau_nb * floatval($option_data['prix_par_personne']);
                            $modifications["options"][] = [
                                "id_option" => $id_option_post,
                                "intitule" => $option_data['intitule'],
                                "ajout_participants" => $nouveau_nb,
                                "prix_par_personne" => $option_data['prix_par_personne'],
                                "prix_total_ajout" => $cout_ajout
                            ];

                            $total_options_nouveau += $cout_ajout;
                            $options_nouvelles[$id_option_post] = $nouveau_nb;
                        }
                    }
                }
            }
        }

        $stmt_voyage = $pdo->prepare("SELECT prix FROM voyage WHERE id = :id_voyage");
        $stmt_voyage->execute(['id_voyage' => $reservation_ancienne['id_voyage']]);
        $voyage_data = $stmt_voyage->fetch(PDO::FETCH_ASSOC);
        $prix_base_voyage = $voyage_data ? floatval($voyage_data['prix']) : 0;

        $ancien_guide = $reservation_ancienne["guide"];
        $nouveau_guide = $_POST["choix2"];

        $tarifs_guides = [
            "Guide de luxe" => 600,
            "Guide un peu mid" => 30,
            "Guide déboussolant" => -150
        ];

        $prix_ancien_guide = $tarifs_guides[$ancien_guide] ?? 0;
        $prix_nouveau_guide = $tarifs_guides[$nouveau_guide] ?? 0;

        if ($ancien_guide !== $nouveau_guide) {
            $modifications["changement_guide"] = [
                "ancien_guide" => $ancien_guide,
                "nouveau_guide" => $nouveau_guide,
                "prix_ancien" => $prix_ancien_guide,
                "prix_nouveau" => $prix_nouveau_guide,
                "difference_prix" => $prix_nouveau_guide - $prix_ancien_guide
            ];
        }

        $ancien_transport = $reservation_ancienne["moyen_transport"];
        $nouveau_transport = $_POST["choix"];

        $tarifs_transport = [
            "Montre temporelle" => 1000,
            "Le portail temporel" => 100
        ];

        $prix_ancien_transport = $tarifs_transport[$ancien_transport] ?? 0;
        $prix_nouveau_transport = $tarifs_transport[$nouveau_transport] ?? 0;

        if ($ancien_transport !== $nouveau_transport) {
            $modifications["changement_transport"] = [
                "ancien_transport" => $ancien_transport,
                "nouveau_transport" => $nouveau_transport,
                "prix_ancien" => $prix_ancien_transport,
                "prix_nouveau" => $prix_nouveau_transport,
                "difference_prix" => $prix_nouveau_transport - $prix_ancien_transport
            ];
        }

        $prix_total_nouveau = 
            ($prix_base_voyage * $nouveau_total) 
            + $total_options_nouveau 
            + ($prix_nouveau_guide + $prix_nouveau_transport) * $nouveau_total;

        $stmt_achat = $pdo->prepare("SELECT montant FROM achat WHERE id_reservation = :id_reservation");
        $stmt_achat->execute(['id_reservation' => $id_reservation]);
        $achat_data = $stmt_achat->fetch(PDO::FETCH_ASSOC);
        $prix_total_ancien = floatval($achat_data["montant"] ?? 0);


        if ($prix_total_nouveau <= $prix_total_ancien) {
            $messages[] = "Le prix total de la réservation complétée doit être supérieur à celui de la réservation précédente.";
        }

        $modifications["nb_adultes"] = $nouveau_adultes;
        $modifications["nb_enfants"] = $nouveau_enfants;

        $modifications["prix"] = [
            "ancien_total" => $prix_total_ancien,
            "nouveau_total" => $prix_total_nouveau,
            "details" => [
                "prix_base_voyage" => $prix_base_voyage,
                "total_personnes" => $nouveau_total,
                "total_options" => $total_options_nouveau,
                "ancien_guide" => [
                    "nom" => $ancien_guide,
                    "prix" => $prix_ancien_guide
                ],
                "nouveau_guide" => [
                    "nom" => $nouveau_guide,
                    "prix" => $prix_nouveau_guide
                ],
                "ancien_transport" => [
                    "nom" => $ancien_transport,
                    "prix" => $prix_ancien_transport
                ],
                "nouveau_transport" => [
                    "nom" => $nouveau_transport,
                    "prix" => $prix_nouveau_transport
                ],
            ],
            "difference" => $prix_total_nouveau - $prix_total_ancien
        ];

        $_SESSION["modifications_reservation"] = $modifications;
    }
}

if (!empty($messages)) {
    $_SESSION["messages"] = $messages;
    echo "<form id='redirectForm' action='réservation.php' method='POST'>";
    echo "<input type='hidden' name='id_voyage' value='" . htmlspecialchars($_POST["id_voyage"]) . "'>";
    echo "<input type='hidden' name='id_reservation' value='" . htmlspecialchars($id_reservation) . "'>";
    echo "<input type='hidden' name='completer' value='true'>";
    echo "</form>";
    echo "<script>document.getElementById('redirectForm').submit();</script>";
    exit;
} else {
    if (isset($_POST["id_reservation"])) {
            echo "<form id='redirectForm' action='recapitulatif_completer_achat.php' method='POST'>";
            echo "<input type='hidden' name='id_reservation' value='" . htmlspecialchars($id_reservation) . "'>";
            echo "</form>";
            echo "<script>document.getElementById('redirectForm').submit();</script>";
    }
    exit;
}
