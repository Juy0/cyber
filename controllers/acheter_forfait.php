<?php
// controllers/acheter_forfait.php

// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?route=login');
    exit;
}

$user_id = $_SESSION['user_id'];

// Vérifie que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['forfait_id'])) {
    $forfait_id = intval($_POST['forfait_id']);
    
    // Récupération des informations du forfait
    $stmt = $pdo->prepare("SELECT * FROM Forfait WHERE id = ?");
    $stmt->execute([$forfait_id]);
    $forfait = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Vérifie que le forfait existe
    if ($forfait) {
        // Insertion dans la table AchatForfait
        $stmt = $pdo->prepare("INSERT INTO AchatForfait (utilisateur_id, forfait_id, date_achat, status) VALUES (?, ?, NOW(), 'actif')");
        $stmt->execute([$user_id, $forfait_id]);

        // Redirection vers le profil avec un message de succès
        header('Location: index.php?route=profil&message=Forfait acheté avec succès');
        exit;
    } else {
        // Redirection en cas d'erreur
        header('Location: index.php?route=profil&error=Forfait introuvable');
        exit;
    }
} else {
    // Récupération des forfaits disponibles
    $stmt = $pdo->query("SELECT * FROM Forfait");
    $forfaits_disponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Inclure la vue pour acheter un forfait
    include $_SERVER['DOCUMENT_ROOT'] . '/cyber/views/acheter_forfait.php';
    exit;
}
?>
