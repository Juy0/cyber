<h2 style="text-align: center; color: #333;">Réserver un poste</h2>

<?php if (isset($_GET['success'])): ?>
    <p style="color: green; text-align: center;">Réservation annulée avec succès.</p>
<?php elseif (isset($_SESSION['error'])): ?>
    <p style="color: red; text-align: center;"><?= htmlspecialchars($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="POST" action="index.php?route=reserve_poste" style="max-width: 600px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <label for="poste_id" style="font-weight: bold;">Choisir un poste :</label>
    <select name="poste_id" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">
        <?php foreach ($postes as $poste): ?>
            <option value="<?= $poste['id'] ?>"><?= htmlspecialchars($poste['nom']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="date" style="font-weight: bold;">Date :</label>
    <input type="date" name="date" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="heure_debut" style="font-weight: bold;">Heure de début :</label>
    <input type="time" name="heure_debut" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="duree" style="font-weight: bold;">Durée (minutes) :</label>
    <input type="number" name="duree" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Réserver</button>
</form>

<h2 style="text-align: center; color: #333;">Mes Postes Réservés</h2>

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
