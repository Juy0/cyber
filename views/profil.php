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
        <style>
            .reservations-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .reservations-table th, .reservations-table td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            .reservations-table th {
                background-color: #f2f2f2;
            }

            .reservations-table tr:hover {
                background-color: #f5f5f5;
            }

            .reservations-table .actions button {
                padding: 8px 12px;
                font-size: 0.9em;
                color: #fff;
                background-color: #007bff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .reservations-table .actions button:hover {
                background-color: #0056b3;
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
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation['poste_nom']) ?></td>
                        <td><?= htmlspecialchars($reservation['date']) ?></td>
                        <td><?= htmlspecialchars($reservation['heure_debut']) ?></td>
                        <td><?= htmlspecialchars($reservation['duree']) ?></td>
                        <td class="actions">
                            <form method="POST" action="index.php?route=annuler_reservation">
                                <input type="hidden" name="reservation_id" value="<?= $reservation['id'] ?>">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">Annuler</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h3>Mes Forfaits Actifs</h3>

    <!-- Message de success ou d'error pour la resiliation du forfait -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'forfait_resilie'): ?>
        <p style="color: green;">Forfait résilié avec succès.</p>
    <?php elseif (isset($_GET['error']) && $_GET['error'] === 'forfait_non_resilie'): ?>
        <p style="color: red;">Erreur : Impossible de résilier le forfait.</p>
    <?php endif; ?>


    <?php if (count($forfaits_actifs) === 0): ?>
        <p>Aucun forfait actif trouvé.</p>
    <?php else: ?>
        <style>
            .forfaits-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .forfaits-table th, .forfaits-table td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            .forfaits-table th {
                background-color: #f2f2f2;
            }

            .forfaits-table tr:hover {
                background-color: #f5f5f5;
            }

            .forfaits-table .actions button {
                padding: 8px 12px;
                font-size: 0.9em;
                color: #fff;
                background-color: #dc3545;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .forfaits-table .actions button:hover {
                background-color: #a71d2a;
            }
        </style>

        <table class="forfaits-table">
            <thead>
                <tr>
                    <th>Nom du Forfait</th>
                    <th>Durée (minutes)</th>
                    <th>Prix (€)</th>
                    <th>Date d'Achat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($forfaits_actifs as $forfait): ?>
                    <tr>
                        <td><?= htmlspecialchars($forfait['nom']) ?></td>
                        <td><?= htmlspecialchars($forfait['duree']) ?></td>
                        <td><?= htmlspecialchars($forfait['prix']) ?></td>
                        <td><?= htmlspecialchars($forfait['date_achat']) ?></td>
                        <td class="actions">
                            <form method="POST" action="index.php?route=resilier_forfait">
                                <input type="hidden" name="achat_id" value="<?= $forfait['achat_id'] ?>">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir résilier ce forfait ?');">Résilier</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h3>Mes Tournois Inscrits</h3>

    <?php if (empty($tournois_inscrits)): ?>
        <p>Vous n'êtes inscrit à aucun tournoi.</p>
    <?php else: ?>
        <style>
            .tournois-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .tournois-table th, .tournois-table td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            .tournois-table th {
                background-color: #f2f2f2;
            }

            .tournois-table tr:hover {
                background-color: #f5f5f5;
            }

            .tournois-table .actions button {
                padding: 8px 12px;
                font-size: 0.9em;
                color: #fff;
                background-color: #dc3545;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .tournois-table .actions button:hover {
                background-color: #a71d2a;
            }
        </style>

        <table class="tournois-table">
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
                <?php foreach ($tournois_inscrits as $tournoi): ?>
                    <tr>
                        <td><?= htmlspecialchars($tournoi['nom']); ?></td>
                        <td><?= htmlspecialchars($tournoi['jeu_nom']); ?></td>
                        <td><?= htmlspecialchars($tournoi['date']); ?></td>
                        <td><?= htmlspecialchars($tournoi['description']); ?></td>
                        <td><?= htmlspecialchars($tournoi['statut']); ?></td>
                        <td class="actions">
                            <form method="POST" action="index.php?route=desinscrire_tournoi">
                                <input type="hidden" name="tournoi_id" value="<?= $tournoi['id']; ?>">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir vous désinscrire de ce tournoi ?');">Se désinscrire</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
