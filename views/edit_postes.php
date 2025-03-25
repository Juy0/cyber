<form method="post" action="index.php?route=manage_postes">
    <input type="hidden" name="action" value="edit">   <!-- "hidden" = champ invisible mais envoie quand meme les données || "action" = sert d'identifiant -->
    <input type="hidden" name="id" value="<?= $poste['id'] ?>">

    <label for="nom">Nom du poste:</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($poste['nom']) ?>" required><br>

    <label for="processeur">Processeur:</label>
    <input type="text" id="processeur" name="processeur" value="<?= htmlspecialchars($poste['processeur']) ?>" required><br>

    <label for="memoire">Mémoire (Go):</label>
    <input type="number" id="memoire" name="memoire" value="<?= htmlspecialchars($poste['memoire']) ?>" required><br>

    <label for="systeme_exploitation">Système d'exploitation:</label>
    <input type="text" id="systeme_exploitation" name="systeme_exploitation" value="<?= htmlspecialchars($poste['systeme_exploitation']) ?>" required><br>

    <label for="date_achat">Date d'achat:</label>
    <input type="date" id="date_achat" name="date_achat" value="<?= htmlspecialchars($poste['date_achat']) ?>" required><br>

    <label for="statut">Statut:</label>
    <select id="statut" name="statut" required>
        <option value="disponible" <?= $poste['statut'] === 'disponible' ? 'selected' : '' ?>>Disponible</option>
        <option value="en maintenance" <?= $poste['statut'] === 'en maintenance' ? 'selected' : '' ?>>En maintenance</option>
        <option value="hors service" <?= $poste['statut'] === 'hors service' ? 'selected' : '' ?>>Hors service</option>
    </select><br>

    <button type="submit">Modifier le poste</button>
</form>
