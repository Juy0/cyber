<?php
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?route=login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tournoi_id'])) {
    $tournoi_id = (int)$_POST['tournoi_id'];
    $utilisateur_id = $_SESSION['user_id'];

    // Vérifier si l'utilisateur est déjà inscrit
    $stmt = $pdo->prepare("SELECT * FROM inscriptions WHERE utilisateur_id = ? AND tournoi_id = ?");
    $stmt->execute([$utilisateur_id, $tournoi_id]);
    if ($stmt->fetch()) {
        header('Location: index.php?route=tournois&error=already_registered');
        exit;
    }

    // Inscrire l'utilisateur
    $stmt = $pdo->prepare("INSERT INTO inscriptions (utilisateur_id, tournoi_id) VALUES (?, ?)");
    if ($stmt->execute([$utilisateur_id, $tournoi_id])) {
        header('Location: index.php?route=tournois&success=registered');
        exit;
    } else {
        header('Location: index.php?route=tournois&error=registration_failed');
        exit;
    }
}
?>
