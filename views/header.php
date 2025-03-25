<?php
ob_start(); // Commence la mise en mémoire tampon

?>
<!-- views/header.php -->

<header>

<nav>
    <ul>
        <li><a href="index.php?route=home">Accueil</a></li>
        <li><a href="index.php?route=tournois">Tournois</a></li>
        
        <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'employé')): ?> <!-- dis que seul les comptes admin et employé peuvent accéder a ces liens -->
            <li><a href="index.php?route=manage_postes">Gestion des postes</a></li>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['user_id'])): ?> <!-- Comptes Clients -->
            <li><a href="index.php?route=reserve_poste">Réserver un poste</a></li> <!-- Ajout de l'option de réservation -->
            <li><a href="index.php?route=postes_reserves">Mes Postes Réservés</a></li>
            <li><a href="index.php?route=logout">Déconnexion</a></li>
            <li><a href="index.php?route=profil">Mon Profil</a></li>
            <li><a href="daft/daftpunk.html">Human</a></li>
        <?php else: ?>
            <li><a href="index.php?route=login">Connexion</a></li>
            <li><a href="index.php?route=register">Inscription</a></li>
            
        <?php endif; ?>
    </ul>
</nav>
</header>

