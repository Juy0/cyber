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
$stmt = $pdo->prepare("SELECT f.id, f.nom, f.duree, f.prix, a.date_achat, a.id AS achat_id 
                       FROM achatforfait a
                       JOIN forfait f ON a.forfait_id = f.id
                       WHERE a.utilisateur_id = ? AND a.status = 'actif'");
$stmt->execute([$user_id]);
$forfaits_actifs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération des tournois auxquels l'utilisateur est inscrit
$stmt = $pdo->prepare("
    SELECT t.id, t.nom, t.date, t.description, t.statut, j.nom AS jeu_nom
    FROM inscriptions i
    JOIN Tournoi t ON i.tournoi_id = t.id
    JOIN jeux j ON t.jeu_id = j.id
    WHERE i.utilisateur_id = ?
");
$stmt->execute([$user_id]);
$tournois_inscrits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inclure la vue du profil
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/views/profil.php';
?>
