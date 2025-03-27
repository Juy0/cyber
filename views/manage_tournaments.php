<h2>Gérer les Tournois</h2>

<!-- Formulaire pour ajouter ou modifier un tournoi -->
<form method="POST" action="index.php?route=manage_tournaments">
    <input type="hidden" name="id" value="<?= isset($tournoi) ? htmlspecialchars($tournoi['id']) : ''; ?>">

    <label for="nom">Nom du tournoi :</label>
    <input type="text" id="nom" name="nom" value="<?= isset($tournoi) ? htmlspecialchars($tournoi['nom']) : ''; ?>" required>

    <label for="jeu_id">Jeu :</label>
    <select name="jeu_id" id="jeu_id" required>
        <?php
        $stmt = $pdo->query("SELECT * FROM jeux");
        while ($jeu = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?= $jeu['id']; ?>" <?= isset($tournoi) && $tournoi['jeu_id'] == $jeu['id'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($jeu['nom']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="date">Date :</label>
    <input type="date" id="date" name="date" value="<?= isset($tournoi) ? htmlspecialchars($tournoi['date']) : ''; ?>" required>

    <label for="description">Description :</label>
    <textarea id="description" name="description" required><?= isset($tournoi) ? htmlspecialchars($tournoi['description']) : ''; ?></textarea>

    <label for="statut">Statut :</label>
    <select id="statut" name="statut" required>
        <option value="ouvert" <?= isset($tournoi) && $tournoi['statut'] === 'ouvert' ? 'selected' : ''; ?>>Ouvert</option>
        <option value="fermé" <?= isset($tournoi) && $tournoi['statut'] === 'fermé' ? 'selected' : ''; ?>>Fermé</option>
        <option value="en cours" <?= isset($tournoi) && $tournoi['statut'] === 'en cours' ? 'selected' : ''; ?>>En cours</option>
        <option value="terminé" <?= isset($tournoi) && $tournoi['statut'] === 'terminé' ? 'selected' : ''; ?>>Terminé</option>
    </select>

    <button type="submit" name="action" value="<?= isset($tournoi) ? 'edit' : 'create'; ?>">
        <?= isset($tournoi) ? 'Modifier' : 'Ajouter'; ?> le tournoi
    </button>
</form>

<h2>Liste des Tournois</h2>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Jeu</th>
            <th>Date</th>
            <th>Description</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tournois as $tournoi): ?>
            <tr>
                <td><?= htmlspecialchars($tournoi['nom']); ?></td>
                <td><?= htmlspecialchars($tournoi['jeu_nom']); ?></td>
                <td><?= htmlspecialchars($tournoi['date']); ?></td>
                <td><?= htmlspecialchars($tournoi['description']); ?></td>
                <td><?= htmlspecialchars($tournoi['statut']); ?></td>
                <td>
                    <a href="index.php?route=manage_tournaments&action=edit&id=<?= $tournoi['id']; ?>">Modifier</a>
                    <a href="index.php?route=manage_tournaments&action=delete&id=<?= $tournoi['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tournoi ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
