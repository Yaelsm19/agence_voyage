<?php
$prix_total = 0;

// Ajouter le prix de base du voyage (prix par personne * nombre total de personnes)
if ($voyage) {
    $prix_total += $voyage['prix'] * ($nb_adultes + $nb_enfants);
}

// Récupérer les étapes et options associées
$stmt_etapes = $pdo->prepare("
    SELECT e.id AS etape_id, e.titre, o.id_option, o.intitule, o.prix_par_personne
    FROM etape e
    LEFT JOIN options o ON e.id = o.id_etape
    WHERE e.id_voyage = :id_voyage
    ORDER BY e.chronologie
");
$stmt_etapes->execute(['id_voyage' => $id_voyage]);
$etapes = $stmt_etapes->fetchAll(PDO::FETCH_ASSOC);

// Ajouter le prix des options pour chaque étape
foreach ($etapes as $etape) {
    // Vérifier si cette étape a des options (id_option est défini)
    if (isset($etape['id_option']) && isset($_POST["nb_participant_" . $etape['id_option']])) {
        $nb_participants_option = $_POST["nb_participant_" . $etape['id_option']];
        // Calculer le coût de cette option en fonction du nombre de participants
        $prix_total += $nb_participants_option * $etape['prix_par_personne'];
    }
}

// Ajouter le prix du transport choisi
$prix_transport = 0;
if (isset($_POST['choix'])) {
    switch ($_POST['choix']) {
        case 'option1': // Montre temporelle
            $prix_transport = 1000;
            break;
        case 'option2': // Portail temporel
            $prix_transport = 100;
            break;
        case 'option3': // Cabine temporelle
            $prix_transport = 0;
            break;
    }
    $prix_total += $prix_transport * ($nb_adultes + $nb_enfants);
}

// Ajouter le prix du guide choisi
$prix_guide = 0;
if (isset($_POST['choix2'])) {
    switch ($_POST['choix2']) {
        case 'option1': // Guide de luxe
            $prix_guide = 600;
            break;
        case 'option2': // Guide un peu mid
            $prix_guide = 30;
            break;
        case 'option3': // Pas de guide
            $prix_guide = 0;
            break;
        case 'option4': // Guide déboussolant
            $prix_guide = -150;
            break;
    }
    $prix_total += $prix_guide * ($nb_adultes + $nb_enfants);
}

echo "Le prix total de votre réservation est : " . number_format($prix_total, 0, ',', ' ') . "€";

// Inclure la page récapitulative
include 'recapitulatif.php';
exit;
?>
