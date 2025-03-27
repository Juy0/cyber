<h2 style="text-align: center; color: #333;">Mes Postes Réservés</h2>

<?php if (isset($_GET['success'])): ?>
    <p style="color: green; text-align: center;">Réservation annulée avec succès.</p>
<?php elseif (isset($_SESSION['error'])): ?>
    <p style="color: red; text-align: center;"><?= htmlspecialchars($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (empty($postes_reserves)): ?>
    <p style="text-align: center; color: #555;">Vous n'avez réservé aucun poste.</p>
<?php else: ?>
    <style>
        .reservations-table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .reservations-table th, .reservations-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .reservations-table th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
        }

        .reservations-table tr:hover {
            background-color: #f5f5f5;
        }

        .reservations-table .actions button {
            padding: 8px 12px;
            font-size: 0.9em;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .reservations-table .actions button:hover {
            background-color: #a71d2a;
        }
    </style>

    <table class="reservations-table">
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
                    <td class="actions">
                        <form method="POST" action="index.php?route=postes_reserves">
                            <input type="hidden" name="reservation_id" value="<?= $reservation['reservation_id'] ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">Annuler</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
