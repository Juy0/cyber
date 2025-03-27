<?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
    <a href="index.php?route=create_tournament" class="btn btn-create">Créer un nouveau tournoi</a>
<?php endif; ?>

<?php foreach ($tournois as $tournoi): ?>
    <div>
        <h3><?php echo htmlspecialchars($tournoi['nom']); ?></h3>
        <p>Date : <?php echo htmlspecialchars($tournoi['date']); ?></p>
        <p>Description : <?php echo htmlspecialchars($tournoi['description']); ?></p>
        <p>Statut : <?php echo htmlspecialchars($tournoi['statut']); ?></p>

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
                    <input type="hidden" name="tournoi_id" value="<?php echo $tournoi['id']; ?>">
                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir vous désinscrire ?');">Se désinscrire</button>
                </form>
            <?php else: ?>
                <!-- Bouton d'inscription -->
                <form action="index.php?route=inscrire_tournoi" method="post" style="display:inline;">
                    <input type="hidden" name="tournoi_id" value="<?php echo $tournoi['id']; ?>">
                    <button type="submit">S'inscrire</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
            <!-- Bouton Modifier -->
            <a href="index.php?route=edit_tournament&id=<?php echo $tournoi['id']; ?>" class="btn btn-edit">Modifier</a>
            <!-- Bouton Supprimer -->
            <form action="index.php?route=delete_tournament" method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $tournoi['id']; ?>">
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tournoi ?');">Supprimer</button>
            </form>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
