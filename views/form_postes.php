<form method="POST" action="index.php?route=manage_postes">
    <input type="hidden" name="id" value="<?= isset($poste['id']) ? htmlspecialchars($poste['id']) : ''; ?>">

    <label for="nom">Nom du poste :</label>
    <input type="text" id="nom" name="nom" value="<?= isset($poste['nom']) ? htmlspecialchars($poste['nom']) : ''; ?>" required>

    <!-- Autres champs -->

    <button type="submit" name="action" value="<?= isset($poste) ? 'edit' : 'create'; ?>">
        <?= isset($poste) ? 'Modifier' : 'Ajouter'; ?>
    </button>
</form>
