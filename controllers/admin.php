<?php
session_start(); // Assurez-vous de démarrer la session

// Connexion à la base de données
include '../db.php';

// Vérification des droits d'accès
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: index.php?route=login');
    exit;
}

// Gestion des tournois
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Logique pour ajouter/modifier des tournois
    // Exemple : $nom, $date, $description = $_POST['nom'], $_POST['date'], $_POST['description'];
    // Préparer et exécuter la requête pour insérer ou mettre à jour un tournoi
}

// Inclure la vue d'administration
include '../views/admin.php';
?>
