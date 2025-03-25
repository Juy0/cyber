<!-- views/register.php -->
<h1>Inscription</h1>

<!-- Formulaire d'inscription -->
<form action="index.php?route=register" method="post">
    <input type="text" name="nom" required placeholder="Nom" value="<?php echo htmlspecialchars($nom); ?>">
    <input type="text" name="prenom" required placeholder="Prénom" value="<?php echo htmlspecialchars($prenom); ?>">
    <input type="email" name="email" required placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
    <input type="password" name="password" required placeholder="Mot de passe">
    
    <select name="type_utilisateur" required>
        <option value="">Sélectionner le type d'utilisateur</option>
        <option value="admin">Admin</option>
        <option value="client">Client</option>
        <option value="employé">Employé</option>
    </select>

    <button type="submit">S'inscrire</button>
</form>

<!-- Affichage des erreurs -->
<?php if (!empty($error)): ?> <!-- affiche le message d'erreur est placé après le formulaire. Cela garantit que, si une erreur est détectée, elle apparaît sous le formulaire, ce qui est plus intuitif pour l'utilisateur.-->
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p> <!-- éviter les problèmes de sécurité (comme les injections XSS) en convertissant les caractères spéciaux en entités HTML. -->
<?php endif; ?>
