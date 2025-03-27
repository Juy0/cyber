<h1>Jeux Disponibles</h1>

<?php if (empty($jeux)): ?>
    <p>Aucun jeu disponible pour le moment.</p>
<?php else: ?>
    <ul>
        <?php foreach ($jeux as $jeu): ?>
            <li>
                <?php echo htmlspecialchars($jeu['nom']); ?>
                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                    <!-- Bouton Modifier -->
                    <a href="index.php?route=edit_game&id=<?php echo $jeu['id']; ?>">Modifier</a>
                    <!-- Bouton Supprimer -->
                    <form action="index.php?route=delete_game" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $jeu['id']; ?>">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce jeu ?');">Supprimer</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
