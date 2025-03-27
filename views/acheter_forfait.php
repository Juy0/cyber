<h2>Acheter un Forfait</h2>

<form method="POST" action="index.php?route=acheter_forfait">
    <label for="forfait_id">Sélectionnez un forfait :</label>
    <select name="forfait_id" id="forfait_id" required>
        <?php foreach ($forfaits_disponibles as $forfait): ?>
            <option value="<?= $forfait['id'] ?>"><?= htmlspecialchars($forfait['nom']) ?> - <?= htmlspecialchars($forfait['duree']) ?> minutes - <?= htmlspecialchars($forfait['prix']) ?> €</option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Acheter</button>
</form>
