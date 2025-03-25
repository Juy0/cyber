<!-- views/manage_reservations.php -->
<h2>Gestion des réservations</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom du client</th>
            <th>Poste réservé</th>
            <th>Date</th>
            <th>Heure de début</th>
            <th>Durée</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservations as $reservation): ?>
            <tr>
                <td><?= htmlspecialchars($reservation['id']) ?></td>
                <td><?= htmlspecialchars($reservation['utilisateur_nom']) ?></td>
                <td><?= htmlspecialchars($reservation['poste_nom']) ?></td>
                <td><?= htmlspecialchars($reservation['date']) ?></td>
                <td><?= htmlspecialchars($reservation['heure_debut']) ?></td>
                <td><?= htmlspecialchars($reservation['duree']) ?> minutes</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
