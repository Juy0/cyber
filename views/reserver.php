<h1>Réserver un poste</h1>
<form action="index.php?route=reserver" method="post">
    <label for="poste_id">Poste:</label>
    <select name="poste_id" id="poste_id">
        <?php foreach ($postes as $poste): ?>
            <option value="<?php echo $poste['id']; ?>">
                <?php echo htmlspecialchars($poste['nom']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="date">Date:</label>
    <input type="date" name="date" required>

    <label for="heure_debut">Heure de début:</label>
    <input type="time" name="heure_debut" required>

    <label for="duree">Durée (en minutes):</label>
    <input type="number" name="duree" required>

    <button type="submit">Réserver</button>
</form>
