<?php
// controllers/manage_reservations.php

// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est connecté et est un admin ou un employé
if (!isset($_SESSION['user_id']) || ($_SESSION['user_type'] !== 'admin' && $_SESSION['user_type'] !== 'employé')) {
    header('Location: index.php?route=login');
    exit;
}

// Récupération des réservations
$stmt = $pdo->query("SELECT Reservation.*, Utilisateurs.nom AS utilisateur_nom, Postes.nom AS poste_nom FROM Reservation 
                      JOIN Utilisateurs ON Reservation.utilisateur_id = Utilisateurs.id 
                      JOIN Postes ON Reservation.poste_id = Postes.id");
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inclure la vue de gestion des réservations
include 'views/manage_reservations.php';
?>
