<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: index.php?route=login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    // Supprimer le jeu de la base de données
    $stmt = $pdo->prepare("DELETE FROM jeux WHERE id = ?");
    if ($stmt->execute([$id])) {
        header('Location: index.php?route=jeux&success=deleted');
        exit;
    } else {
        echo "Erreur lors de la suppression du jeu.";
    }
}
?>
