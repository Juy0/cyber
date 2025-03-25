<?php
session_start(); // Assurez-vous de démarrer la session

// Connexion à la base de données
include '../db.php';

// Récupération des tournois
$stmt = $pdo->query('SELECT * FROM Tournoi ORDER BY date DESC');
$tournois = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inclusion de la vue des tournois
include '../views/tournois.php';
?>
