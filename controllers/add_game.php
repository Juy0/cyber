<?php
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: index.php?route=login');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    if (empty($nom)) {
        $error = 'Le nom du jeu est requis.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO jeux (nom) VALUES (?)");
        if ($stmt->execute([$nom])) {
            header('Location: index.php?route=add_game&success=1');
            exit;
        } else {
            $error = 'Erreur lors de l\'ajout du jeu.';
        }
    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/cyber/views/add_game.php';
?>
