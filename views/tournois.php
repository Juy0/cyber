<?php foreach ($tournois as $tournoi): ?>
    <div>
        <h3><?php echo htmlspecialchars($tournoi['nom']); ?></h3>
        <p>Date : <?php echo htmlspecialchars($tournoi['date']); ?></p>
        <p>Description : <?php echo htmlspecialchars($tournoi['description']); ?></p>
        <p>Statut : <?php echo htmlspecialchars($tournoi['statut']); ?></p>


        <?php if ($_SESSION['user_type'] === 'admin'): ?>
            <!-- Bouton Modifier -->
            <a href="index.php?route=edit_tournament&id=<?php echo $tournoi['id']; ?>">Modifier</a>
            <!-- Bouton Supprimer -->
            <form action="index.php?route=delete_tournament" method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $tournoi['id']; ?>">
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tournoi ?');">Supprimer</button>
            </form>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
