<h1>Ajouter un Jeu</h1>
<?php if (isset($_GET['success'])): ?>
    <p style="color: green;">Jeu ajouté avec succès.</p>
<?php elseif (!empty($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form action="index.php?route=add_game" method="post">
    <label for="nom">Nom du jeu :</label>
    <input type="text" id="nom" name="nom" required>
    <button type="submit">Ajouter</button>
</form>
