<?php
// Vérifie que l'utilisateur est un employé ou un admin
if (!isset($_SESSION['user_id']) || ($_SESSION['user_type'] !== 'employé' && $_SESSION['user_type'] !== 'admin')) {
    header('Location: index.php?route=login');
    exit;
}
?>

<h1>Inventaire des machines</h1>
<p>Liste des machines et de leurs caractéristiques.</p>
<!-- Contenu spécifique à l'inventaire ici -->
