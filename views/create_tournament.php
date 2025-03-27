<!-- views/create_tournament.php -->
<h1>Créer un Tournoi</h1>
<?php if (!empty($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form action="index.php?route=create_tournament" method="post">
    <label for="nom">Nom du tournoi :</label>
    <input type="text" name="nom" id="nom" required>

    <label for="jeu_id">Jeu :</label>
    <select name="jeu_id" id="jeu_id" required>
        <?php
        $stmt = $pdo->query("SELECT * FROM jeux");
        while ($jeu = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?php echo $jeu['id']; ?>"><?php echo htmlspecialchars($jeu['nom']); ?></option>
        <?php endwhile; ?>
    </select>

    <label for="date">Date :</label>
    <input type="date" name="date" id="date" required>

    <label for="description">Description :</label>
    <textarea name="description" id="description" required></textarea>

    <label for="statut">Statut :</label>
    <select name="statut" id="statut" required>
        <option value="ouvert">Ouvert</option>
        <option value="fermé">Fermé</option>
        <option value="en cours">En cours</option>
        <option value="terminé">Terminé</option>
    </select>

    <button type="submit">Créer le tournoi</button>
</form>




