<form action="index.php?route=update_tournament" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($tournoi['id']); ?>">
    <input type="text" name="nom" value="<?php echo htmlspecialchars($tournoi['nom']); ?>" required>
    <input type="date" name="date" value="<?php echo htmlspecialchars($tournoi['date']); ?>" required>
    <textarea name="description" required><?php echo htmlspecialchars($tournoi['description']); ?></textarea>

    <!-- Sélection du statut -->
    <label for="statut">Statut :</label>
    <select name="statut" id="statut" required>
        <option value="ouvert" <?php echo $tournoi['statut'] === 'ouvert' ? 'selected' : ''; ?>>Ouvert</option>
        <option value="fermé" <?php echo $tournoi['statut'] === 'fermé' ? 'selected' : ''; ?>>Fermé</option>
        <option value="en cours" <?php echo $tournoi['statut'] === 'en cours' ? 'selected' : ''; ?>>En cours</option>
        <option value="terminé" <?php echo $tournoi['statut'] === 'terminé' ? 'selected' : ''; ?>>Terminé</option>
    </select>

    <button type="submit">Mettre à jour</button>
</form>
