<form action="add_forfait.php" method="post">
    <label for="nom">Nom du forfait :</label>
    <input type="text" id="nom" name="nom" required>
    
    <label for="duree">Durée (minutes) :</label>
    <input type="number" id="duree" name="duree" required>
    
    <label for="prix">Prix (€) :</label>
    <input type="number" id="prix" name="prix" step="0.01" required>
    
    <input type="submit" value="Ajouter le forfait">
</form>
