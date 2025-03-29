<?php
$prix_total = 0;
if ($voyage) {
    $prix_total += $voyage['prix'] * ($nb_adultes + $nb_enfants);
}
$stmt_etapes = $pdo->prepare("
    SELECT e.id AS etape_id, e.titre, o.id_option, o.intitule, o.prix_par_personne
    FROM etape e
    LEFT JOIN options o ON e.id = o.id_etape
    WHERE e.id_voyage = :id_voyage
    ORDER BY e.chronologie
");
$stmt_etapes->execute(['id_voyage' => $id_voyage]);
$etapes = $stmt_etapes->fetchAll(PDO::FETCH_ASSOC);
$prix_option = 0;
$nb_options = 0;
$nb_total_participant= 0;
foreach ($etapes as $etape) {
    if (isset($etape['id_option']) && isset($_POST["nb_participant_" . $etape['id_option']])) {
        $nb_participants_option = intval($_POST["nb_participant_" . $etape['id_option']]);
        $prix_par_personne = floatval($etape['prix_par_personne']);
        if($nb_participants_option>0){
            $nb_total_participant+= $nb_participants_option;
            $nb_options +=1;
            $prix_option += $nb_participants_option * $prix_par_personne;
        }

    }
}
echo $nb_options;
$prix_total+= $prix_option;
$prix_transport = 0;
if (isset($_POST['choix'])) {
    switch ($_POST['choix']) {
        case 'option1':
            $prix_transport = 1000;
            $transport = "Montre temporelle";
            break;
        case 'option2':
            $prix_transport = 100;
            $transport = "Le portail temporel";
            break;
        case 'option3':
            $prix_transport = 0;
            $transport = "La cabine temporel";
            break;
    }
    $prix_total += $prix_transport * ($nb_adultes + $nb_enfants);
}
$prix_guide = 0;
if (isset($_POST['choix2'])) {
    switch ($_POST['choix2']) {
        case 'option1':
            $prix_guide = 600;
            $guide = "Guide de luxe";
            break;
        case 'option2':
            $prix_guide = 30;
            $guide = "Guide un peu mid";
            break;
        case 'option3':
            $prix_guide = 0;
            $guide ="Aucun"; 
            break;
        case 'option4':
            $prix_guide = -150;
            $guide = " guide déboussolant";
            break;
    }
    $prix_total += $prix_guide * ($nb_adultes + $nb_enfants);
}
include 'recapitulatif.php';
exit;
?>
