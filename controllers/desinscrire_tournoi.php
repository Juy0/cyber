<?php
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?route=login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tournoi_id'])) {
    $tournoi_id = (int)$_POST['tournoi_id'];
    $utilisateur_id = $_SESSION['user_id'];

    // Supprimer l'inscription
    $stmt = $pdo->prepare("DELETE FROM inscriptions WHERE utilisateur_id = ? AND tournoi_id = ?");
    if ($stmt->execute([$utilisateur_id, $tournoi_id])) {
        header('Location: index.php?route=tournois&success=unregistered');
        exit;
    } else {
        header('Location: index.php?route=tournois&error=unregistration_failed');
        exit;
    }
}
?>
