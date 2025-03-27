<h2>Gérer les postes</h2>

<!-- Formulaire pour ajouter ou modifier un poste -->
<form method="POST" action="index.php?route=manage_postes">
    <input type="hidden" name="id" value="<?= isset($poste) ? htmlspecialchars($poste['id']) : ''; ?>">

    <label for="nom">Nom du poste :</label>
    <input type="text" id="nom" name="nom" value="<?= isset($poste) ? htmlspecialchars($poste['nom']) : ''; ?>" required>

    <label for="processeur">Processeur :</label>
    <input type="text" id="processeur" name="processeur" value="<?= isset($poste) ? htmlspecialchars($poste['processeur']) : ''; ?>" required>

    <label for="memoire">Mémoire (Go) :</label>
    <input type="number" id="memoire" name="memoire" value="<?= isset($poste) ? htmlspecialchars($poste['memoire']) : ''; ?>" required>

    <label for="systeme_exploitation">Système d'exploitation :</label>
    <select name="systeme_exploitation" id="systeme_exploitation" required>
        <option value="windows" <?= isset($poste) && $poste['systeme_exploitation'] === 'windows' ? 'selected' : ''; ?>>Windows</option>
        <option value="macos" <?= isset($poste) && $poste['systeme_exploitation'] === 'macos' ? 'selected' : ''; ?>>MacOS</option>
        <option value="linux" <?= isset($poste) && $poste['systeme_exploitation'] === 'linux' ? 'selected' : ''; ?>>Linux</option>
    </select>

    <label for="date_achat">Date d'achat :</label>
    <input type="date" id="date_achat" name="date_achat" value="<?= isset($poste) ? htmlspecialchars($poste['date_achat']) : ''; ?>" required>

    <label for="statut">Statut :</label>
    <select id="statut" name="statut">
        <option value="disponible" <?= isset($poste) && $poste['statut'] === 'disponible' ? 'selected' : ''; ?>>Disponible</option>
        <option value="en maintenance" <?= isset($poste) && $poste['statut'] === 'en maintenance' ? 'selected' : ''; ?>>En maintenance</option>
        <option value="hors service" <?= isset($poste) && $poste['statut'] === 'hors service' ? 'selected' : ''; ?>>Hors service</option>
    </select>

    <button type="submit" name="action" value="<?= isset($poste) ? 'edit' : 'create'; ?>">
        <?= isset($poste) ? 'Modifier' : 'Ajouter'; ?> le poste
    </button>
</form>

<h2>Liste des postes</h2>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .actions a {
        margin-right: 10px;
        color: #007bff;
        text-decoration: none;
    }

    .actions a:hover {
        text-decoration: underline;
    }

    .delete {
        color: red;
    }
</style>

<?php if (!empty($postes)): ?>
    <table>
        <tr>
            <th>Nom</th>
            <th>Processeur</th>
            <th>Mémoire</th>
            <th>Système d'exploitation</th>
            <th>Date d'achat</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($postes as $poste): ?>
            <tr>
                <td><?= htmlspecialchars($poste['nom']); ?></td>
                <td><?= htmlspecialchars($poste['processeur']); ?></td>
                <td><?= htmlspecialchars($poste['memoire']); ?> Go</td>
                <td><?= htmlspecialchars($poste['systeme_exploitation']); ?></td>
                <td><?= htmlspecialchars($poste['date_achat']); ?></td>
                <td><?= htmlspecialchars($poste['statut']); ?></td>
                <td class="actions">
                    <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                        <a href="index.php?route=manage_postes&action=edit&id=<?= $poste['id'] ?>">Modifier</a>
                        <a class="delete" href="index.php?route=manage_postes&action=delete&id=<?= $poste['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?');">Supprimer</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Aucun poste disponible.</p>
<?php endif; ?>
