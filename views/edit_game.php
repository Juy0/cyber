<h1>Modifier un Jeu</h1>
<?php if (!empty($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form action="index.php?route=edit_game" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($jeu['id']); ?>">
    <label for="nom">Nom du jeu :</label>
    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($jeu['nom']); ?>" required>
    <button type="submit">Modifier</button>
</form>
