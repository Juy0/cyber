<h2>Réserver un poste</h2>

<?php if (isset($_GET['success'])): ?>
    <p style="color: green;">Réservation annulée avec succès.</p>
<?php elseif (isset($_SESSION['error'])): ?>
    <p style="color: red;"><?= htmlspecialchars($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']); // Supprimer l'erreur de la session après l'affichage ?>
<?php endif; ?>

<form method="POST" action="index.php?route=reserve_poste">
    <label for="poste_id">Choisir un poste :</label>
    <select name="poste_id" required>
        <?php foreach ($postes as $poste): ?>
            <option value="<?= $poste['id'] ?>"><?= htmlspecialchars($poste['nom']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="date">Date :</label>
    <input type="date" name="date" required>

    <label for="heure_debut">Heure de début :</label>
    <input type="time" name="heure_debut" required>

    <label for="duree">Durée (minutes) :</label>
    <input type="number" name="duree" required>

    <button type="submit">Réserver</button>
</form>

<h2>Mes Postes Réservés</h2>

<?php if (empty($postes_reserves)): ?>
    <p>Vous n'avez réservé aucun poste.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nom du Poste</th>
                <th>Date</th>
                <th>Heure de Début</th>
                <th>Durée (minutes)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($postes_reserves as $reservation): ?>
                <tr>
                    <td><?= htmlspecialchars($reservation['poste_nom']) ?></td>
                    <td><?= htmlspecialchars($reservation['date']) ?></td>
                    <td><?= htmlspecialchars($reservation['heure_debut']) ?></td>
                    <td><?= htmlspecialchars($reservation['duree']) ?></td>
                    <td>
                        <form method="POST" action="index.php?route=annuler_reservation">
                            <input type="hidden" name="reservation_id" value="<?= $reservation['reservation_id'] ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">Annuler</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
