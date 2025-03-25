<!-- views/login.php -->
<h1>Connexion</h1>
<?php if (isset($error)): ?>
    <p><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form action="index.php?route=login" method="post">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Mot de passe">
    <button type="submit">Se connecter</button>
</form>
