<h1>Tournois Disponibles</h1>

<?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
    <a href="index.php?route=create_tournament" class="btn btn-create">Créer un nouveau tournoi</a>
<?php endif; ?>

<?php if (empty($tournois)): ?>
    <p>Aucun tournoi disponible pour le moment.</p>
<?php else: ?>
    <style>
        .tournois-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .tournoi-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .tournoi-card h3 {
            margin-bottom: 10px;
            font-size: 1.5em;
            color: #333;
        }

        .tournoi-card p {
            margin: 5px 0;
            color: #555;
        }

        .tournoi-card button, .tournoi-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            font-size: 0.9em;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .tournoi-card button:hover, .tournoi-card a:hover {
            background-color: #0056b3;
        }

        .tournoi-card .delete {
            background-color: #dc3545;
        }

        .tournoi-card .delete:hover {
            background-color: #a71d2a;
        }
    </style>

    <div class="tournois-grid">
        <?php foreach ($tournois as $tournoi): ?>
            <div class="tournoi-card">
                <h3><?= htmlspecialchars($tournoi['nom']); ?></h3>
                <p><strong>Jeu :</strong> <?= isset($tournoi['jeu_nom']) ? htmlspecialchars($tournoi['jeu_nom']) : 'Non spécifié'; ?></p>
                <p><strong>Date :</strong> <?= htmlspecialchars($tournoi['date']); ?></p>
                <p><strong>Description :</strong> <?= htmlspecialchars($tournoi['description']); ?></p>
                <p><strong>Statut :</strong> <?= htmlspecialchars($tournoi['statut']); ?></p>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php
                    // Vérifier si l'utilisateur est inscrit
                    $stmt = $pdo->prepare("SELECT * FROM inscriptions WHERE utilisateur_id = ? AND tournoi_id = ?");
                    $stmt->execute([$_SESSION['user_id'], $tournoi['id']]);
                    $is_registered = $stmt->fetch();
                    ?>

                    <?php if ($is_registered): ?>
                        <!-- Bouton de désinscription -->
                        <form action="index.php?route=desinscrire_tournoi" method="post" style="display:inline;">
                            <input type="hidden" name="tournoi_id" value="<?= $tournoi['id']; ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir vous désinscrire ?');">Se désinscrire</button>
                        </form>
                    <?php else: ?>
                        <!-- Bouton d'inscription -->
                        <form action="index.php?route=inscrire_tournoi" method="post" style="display:inline;">
                            <input type="hidden" name="tournoi_id" value="<?= $tournoi['id']; ?>">
                            <button type="submit">S'inscrire</button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                    <!-- Bouton Modifier -->
                    <a href="index.php?route=edit_tournament&id=<?= $tournoi['id']; ?>" class="btn btn-edit">Modifier</a>
                    <!-- Bouton Supprimer -->
                    <form action="index.php?route=delete_tournament" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $tournoi['id']; ?>">
                        <button type="submit" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tournoi ?');">Supprimer</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
