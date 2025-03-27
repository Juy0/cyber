<?php
session_start(); // Assurez-vous de démarrer la session

// Connexion à la base de données
include '../db.php';

// Récupération des tournois avec le nom du jeu
$stmt = $pdo->query('
    SELECT t.*, j.nom AS jeu_nom 
    FROM Tournoi t
    JOIN jeux j ON t.jeu_id = j.id
    ORDER BY t.date DESC
');
$tournois = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inclusion de la vue des tournois
include '../views/tournois.php';
?>
