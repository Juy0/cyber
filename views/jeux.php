<h1>Jeux Disponibles</h1>

<?php if (empty($jeux)): ?>
    <p>Aucun jeu disponible pour le moment.</p>
<?php else: ?>
    <style>
        .jeux-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .jeu-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .jeu-card h3 {
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .jeu-card button, .jeu-card a {
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

        .jeu-card button:hover, .jeu-card a:hover {
            background-color: #0056b3;
        }

        .jeu-card .delete {
            background-color: #dc3545;
        }

        .jeu-card .delete:hover {
            background-color: #a71d2a;
        }
    </style>

    <div class="jeux-grid">
        <?php foreach ($jeux as $jeu): ?>
            <div class="jeu-card">
                <h3><?= htmlspecialchars($jeu['nom']); ?></h3>
                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                    <a href="index.php?route=edit_game&id=<?= $jeu['id']; ?>">Modifier</a>
                    <form action="index.php?route=delete_game" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $jeu['id']; ?>">
                        <button type="submit" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce jeu ?');">Supprimer</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
