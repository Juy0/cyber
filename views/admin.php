<?php
// Vérifie que l'utilisateur est un admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: index.php?route=login');
    exit;
}
?>

<h1>Administration</h1>
<p>Bienvenue dans la section d'administration.</p>
<!-- Contenu spécifique à l'administration ici -->

<h2>Gestion des tournois</h2>
<a href="index.php?route=create_tournament">Créer un nouveau tournoi</a>



<h2>Inventaire des machines</h2>
<!-- Ajouter/modifier les machines ici -->

<h2>Planification des maintenances</h2>
<!-- Planification des maintenances -->
