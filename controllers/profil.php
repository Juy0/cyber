<?php
// controllers/profil.php

// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?route=login');
    exit;
}

$user_id = $_SESSION['user_id'];

// Récupération des réservations de l'utilisateur
$stmt = $pdo->prepare("SELECT R.*, P.nom AS poste_nom FROM Reservation R JOIN Postes P ON R.poste_id = P.id WHERE R.utilisateur_id = ?");
$stmt->execute([$user_id]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération des forfaits actifs de l'utilisateur
$stmt = $pdo->prepare("SELECT f.id, f.nom, f.duree, f.prix, a.date_achat 
                       FROM achatforfait a
                       JOIN forfait f ON a.forfait_id = f.id
                       WHERE a.utilisateur_id = ? AND a.status = 'actif'");
$stmt->execute([$user_id]);
$forfaits_actifs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Débogage
// var_dump($forfaits_actifs); // Vérifie les résultats

// Récupération des forfaits disponibles
$stmt = $pdo->query("SELECT * FROM forfait");
$forfaits_disponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inclure la vue du profil
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/views/profil.php';
?>
