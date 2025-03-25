    <h2>Mon Profil</h2>

    <!-- Mise à jour de la Vue Profil (après achat) -->
    <?php if (isset($_GET['message'])): ?>
        <div class="success"><?= htmlspecialchars($_GET['message']) ?></div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <h3>Mes Réservations</h3>

    <?php if (count($reservations) === 0): ?>
        <p>Aucune réservation trouvée.</p>
    <?php else: ?>
        <!-- Table des réservations ici -->
    <?php endif; ?>

    <h3>Mes Forfaits Actifs</h3>

    <!-- Message de success ou d'error pour la resiliation du forfait -->
    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;">Forfait résilié avec succès.</p>
    <?php elseif (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>


    <?php if (count($forfaits_actifs) === 0): ?>
        <p>Aucun forfait actif trouvé.</p>
    <?php else: ?>
        <style>
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>

        <table>
            <thead>
                <tr>
                    <th>Nom du Forfait</th>
                    <th>Durée (minutes)</th>
                    <th>Prix (€)</th>
                    <th>Date d'Achat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($forfaits_actifs as $forfait): ?>
                    <tr>
                        <td><?= htmlspecialchars($forfait['nom']) ?></td>
                        <td><?= htmlspecialchars($forfait['duree']) ?></td>
                        <td><?= htmlspecialchars($forfait['prix']) ?></td>
                        <td><?= htmlspecialchars($forfait['date_achat']) ?></td>
                        <td>
                            <form method="POST" action="index.php?route=resilier_forfait">
                                <input type="hidden" name="achat_id" value="<?= $forfait['id'] ?>">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir résilier ce forfait ?');">Résilier</button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h3>Acheter un Forfait</h3>

    <form method="POST" action="index.php?route=acheter_forfait">
        <label for="forfait_id">Sélectionnez un forfait :</label>
        <select name="forfait_id" id="forfait_id" required>
            <?php foreach ($forfaits_disponibles as $forfait): ?>
                <option value="<?= $forfait['id'] ?>"><?= htmlspecialchars($forfait['nom']) ?> - <?= htmlspecialchars($forfait['duree']) ?> minutes - <?= htmlspecialchars($forfait['prix']) ?> €</option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Acheter</button>
    </form>
