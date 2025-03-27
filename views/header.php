<?php
ob_start(); // Commence la mise en mémoire tampon
?>
<!-- views/header.php -->

<header>
    <nav>
        <ul>
            <!-- Liens accessibles à tous -->
            <li><a href="index.php?route=home">Accueil</a></li>
            <li><a href="index.php?route=tournois">Tournois</a></li>
            <li><a href="index.php?route=jeux">Jeux</a></li>

            <!-- Liens pour les administrateurs -->
            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                <li><a href="index.php?route=manage_postes">Gestion des postes</a></li>
                <li><a href="index.php?route=add_game">Ajouter un jeu</a></li>
                <li><a href="index.php?route=create_tournament">Créer un tournoi</a></li>
            <?php endif; ?>

            <!-- Liens pour les employés -->
            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'employé'): ?>
                <li><a href="index.php?route=manage_postes">Gestion des postes</a></li>
            <?php endif; ?>

            <!-- Liens pour les utilisateurs connectés non-admin -->
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] !== 'admin'): ?>
                <li><a href="index.php?route=reserve_poste">Réserver un poste</a></li>
                <li><a href="index.php?route=postes_reserves">Mes Réservations</a></li>
                <li><a href="index.php?route=profil">Mon Profil</a></li>
            <?php endif; ?>

            <!-- Liens pour les utilisateurs connectés -->
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] !== 'admin'): ?>
                <li><a href="index.php?route=acheter_forfait">Acheter un Forfait</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="index.php?route=logout">Déconnexion</a></li>
            <?php else: ?>
                <!-- Liens pour les visiteurs -->
                <li><a href="index.php?route=login">Connexion</a></li>
                <li><a href="index.php?route=register">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

