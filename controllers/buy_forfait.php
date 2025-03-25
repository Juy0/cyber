<?php
// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $forfait_id = (int)$_POST['forfait_id'];
    $user_id = $_SESSION['user_id'];
    $date_achat = date('Y-m-d H:i:s');

    // Insérer l'achat dans la table AchatForfait
    $stmt = $pdo->prepare("INSERT INTO AchatForfait (utilisateur_id, forfait_id, date_achat, status) VALUES (?, ?, ?, 'actif')");
    if ($stmt->execute([$user_id, $forfait_id, $date_achat])) {
        echo "Forfait acheté avec succès.";
    } else {
        echo "Erreur lors de l'achat du forfait.";
    }
}
?>
