<?php
// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Affiche la liste des forfaits disponibles
$stmt = $pdo->query("SELECT id, nom, prix FROM Forfait");
$forfaits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form action="buy_forfait.php" method="post">
    <label for="forfait_id">Choisissez un forfait :</label>
    <select id="forfait_id" name="forfait_id" required>
        <?php foreach ($forfaits as $forfait): ?>
            <option value="<?= $forfait['id']; ?>"><?= $forfait['nom']; ?> - <?= $forfait['prix']; ?>€</option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Acheter le forfait">
</form>
