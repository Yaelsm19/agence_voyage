<?php
require_once 'connexion_base.php';

$voyages = [];

try {
    if (isset($_POST['rechercher']) && !empty(trim($_POST['rechercher']))) {
        $recherche = trim($_POST['rechercher']);
        $stmt = $pdo->prepare("SELECT * FROM voyage WHERE description LIKE :recherche OR titre LIKE :recherche");
        $stmt->execute(['recherche' => '%' . $recherche . '%']);
    } else {
        $stmt = $pdo->query("SELECT * FROM voyage");
    }

    $voyages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>
<?php if (empty($voyages)): ?>
    <div class="recherche_container">
        <p class="recherche_vide">😕 Aucun voyage ne correspond à votre recherche.</p>
    </div>
<?php else: ?>
    <div class="Voyages">
        <?php foreach ($voyages as $voyage): 
            $imagePath = "../Image/Image_voyage_page_destinations/" . $voyage['image'];
        ?>
            <div>
                <img class="image_destinations" src="<?= $imagePath ?>" alt="image_voyage">
                <div class="zone_texte">
                    <h3 class="période"><?= htmlspecialchars($voyage['titre']) ?></h3>
                    <p class="description">
                        <?= htmlspecialchars($voyage['description']) ?>
                    </p>
                    <div class="prix_bouton">
                        <span class="prix">Dès <?= number_format($voyage['prix'], 0, ',', ' ') ?>€</span>
                        <a href="réservation.php?id=<?= $voyage['id'] ?>" class="en_savoir_plus">En savoir plus</a>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
