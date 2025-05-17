<?php
define('ACCES_AUTORISE_SESSION', true);
include('session.php');
if(!isset($_POST["autorisation"]) || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(403);
    exit("Accès interdit.");
}
$modifications = $_SESSION['modifications_reservation'] ?? null;
if (!$modifications) {
    echo "<p>Aucune modification à afficher.</p>";
    exit;
}
if(isset($_POST["id_reservation"])){
    $id_reservation = $_POST["id_reservation"];
}
$messages = $_SESSION['messages'] ?? [];

$prix_total_ancien = $modifications['prix']['ancien_total'] ?? 0;
$prix_total_nouveau = $modifications['prix']['nouveau_total'] ?? 0;

$details = $modifications['prix']['details'] ?? [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Récapitulatif des modifications</title>
    <script src="../fichier_java/changer_mode.js"></script>
    <link id="theme-stylesheet" rel="stylesheet" href="../fichier_css/variables_sombre.css">
    <link rel="stylesheet" href="../fichier_css/recapitulatif_completer_achat.css" />
</head>
<body>
    <main class="container">
        <h1>Récapitulatif des modifications</h1>

        <?php if (!empty($messages)): ?>
            <div id="messages">
                <?php foreach ($messages as $message): ?>
                    <p class="erreur"><?= htmlspecialchars($message) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($modifications['options'])): ?>
            <section>
                <h2>Ajouts d’options</h2>
                <ul>
                    <?php foreach ($modifications['options'] as $ajout): ?>
                        <li>
                            <?= intval($ajout['ajout_participants']) ?> participant(s) ajouté(s) à l'option <strong><?= htmlspecialchars($ajout['intitule']) ?></strong> — 
                            Prix par personne : <span class="prix"><?= number_format(floatval($ajout['prix_par_personne']), 2, ',', ' ') ?> €</span> — 
                            Prix total ajout : <span class="prix"><?= number_format(floatval($ajout['prix_total_ajout']), 2, ',', ' ') ?> €</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if ($details['ancien_guide']['nom'] !== $details['nouveau_guide']['nom']): ?>
            <section>
                <h2>Changement de guide</h2>
                <p>
                    Ancien guide : <strong><?= htmlspecialchars($details['ancien_guide']['nom']) ?></strong> 
                    (Prix : <span class="prix-ancien"><?= number_format(floatval($details['ancien_guide']['prix']), 2, ',', ' ') ?> €</span>)<br />
                    Nouveau guide : <strong><?= htmlspecialchars($details['nouveau_guide']['nom']) ?></strong> 
                    (Prix : <span class="prix"><?= number_format(floatval($details['nouveau_guide']['prix']), 2, ',', ' ') ?> €</span>)<br />
                    Différence de prix : <span class="prix"><?= number_format(floatval($details['nouveau_guide']['prix'] - $details['ancien_guide']['prix']), 2, ',', ' ') ?> €</span>
                </p>
            </section>
        <?php endif; ?>

        <?php if ($details['ancien_transport']['nom'] !==$details['nouveau_transport']['nom']): ?>
            <section>
                <h2>Changement de transport</h2>
                <p>
                    Ancien transport : <strong><?= htmlspecialchars($details['ancien_transport']['nom']) ?></strong> 
                    (Prix : <span class="prix-ancien"><?= number_format(floatval($details['ancien_transport']['prix']), 2, ',', ' ') ?> €</span>)<br />
                    Nouveau transport : <strong><?= htmlspecialchars($details['nouveau_transport']['nom']) ?></strong> 
                    (Prix : <span class="prix"><?= number_format(floatval($details['nouveau_transport']['prix']), 2, ',', ' ') ?> €</span>)<br />
                    Différence de prix : <span class="prix"><?= number_format(floatval($details['nouveau_transport']['prix'] - $details['ancien_transport']['prix']), 2, ',', ' ') ?> €</span>
                </p>
            </section>
        <?php endif; ?>

        <section>
            <h2>Prix total</h2>
            <p>
                Prix total ancien : <span class="prix-ancien"><?= number_format(floatval($prix_total_ancien), 2, ',', ' ') ?> €</span><br />
                Prix total nouveau : <span class="prix"><?= number_format(floatval($prix_total_nouveau), 2, ',', ' ') ?> €</span><br />
                Différence : <span class="prix"><?= number_format(floatval($prix_total_nouveau - $prix_total_ancien), 2, ',', ' ') ?> €</span>
            </p>
        </section>
        <?php
        echo "<form action='paiement.php' method='POST'>
        <input type='hidden' name='montant' value='" . htmlspecialchars($prix_total_nouveau - $prix_total_ancien) . "'>
        <input type='hidden' name='vendeur' value='MEF-1_J'>
        <input type='hidden' name='autorisation' value='autorisation'>
        <input type='hidden' name='completer' value='true'>
        <input type='hidden' name='id_reservation' value='" . htmlspecialchars($id_reservation) . "'>
            <div class='form-group'>
        <button type='submit'>Procéder au paiement</button>
        </div>
        </form>";
?>

        </form>
    </main>
</body>
</html>
