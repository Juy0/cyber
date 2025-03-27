<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: index.php?route=login');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $nom = trim($_POST['nom']);

    if (empty($nom)) {
        $error = 'Le nom du jeu est requis.';
    } else {
        $stmt = $pdo->prepare("UPDATE jeux SET nom = ? WHERE id = ?");
        if ($stmt->execute([$nom, $id])) {
            header('Location: index.php?route=jeux&success=updated');
            exit;
        } else {
            $error = 'Erreur lors de la modification du jeu.';
        }
    }
} elseif (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM jeux WHERE id = ?");
    $stmt->execute([$id]);
    $jeu = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$jeu) {
        echo "Jeu introuvable.";
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/cyber/views/edit_game.php';
?>
