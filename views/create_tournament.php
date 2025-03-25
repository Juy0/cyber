<!-- views/create_tournament.php -->
<h1>Créer un Tournoi</h1>
<?php if ($error): ?>
    <p><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form action="index.php?route=create_tournament" method="post">
    <input type="text" name="nom" placeholder="Nom du tournoi" required>
    <input type="date" name="date" placeholder="Date du tournoi" required>
    <textarea name="description" placeholder="Description du tournoi" required></textarea>
    
    <!-- Sélection du statut -->
    <label for="statut">Statut :</label>
    <select name="statut" id="statut" required>
        <option value="ouvert">Ouvert</option>
        <option value="fermé">Fermé</option>
        <option value="en cours">En cours</option>
        <option value="terminé">Terminé</option>
    </select>

    <button type="submit">Créer le tournoi</button>
</form>




