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
$prix_total+= $prix_option;
$prix_transport = 0;
$transport = $_POST['choix'];
if (isset($transport)) {
    switch ($_POST['choix']) {
        case 'Montre temporelle':
            $prix_transport = 1000;
            break;
        case 'Le portail temporel':
            $prix_transport = 100;
            break;
        case 'La cabine temporel':
            $prix_transport = 0;
            break;
    }
    $prix_total += $prix_transport * ($nb_adultes + $nb_enfants);
}
$prix_guide = 0;
$guide = $_POST['choix2']; 
if (isset($guide)) {
    switch ($_POST['choix2']) {
        case 'Guide de luxe':
            $prix_guide = 600;
            break;
        case 'Guide un peu mid':
            $prix_guide = 30;
            break;
        case 'Pas de guide':
            $prix_guide = 0;
            break;
        case 'Guide déboussolant':
            $prix_guide = -150;
            break;
    }
    $prix_total += $prix_guide * ($nb_adultes + $nb_enfants);
}
?>
