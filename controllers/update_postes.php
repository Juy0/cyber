<?php
// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $processeur = $_POST['processeur'];
    $memoire = $_POST['memoire'];
    $systeme_exploitation = $_POST['systeme_exploitation'];
    $date_achat = $_POST['date_achat'];
    $statut = $_POST['statut'];

    // Mise à jour dans la base de données
    $stmt = $pdo->prepare("UPDATE Postes SET nom = ?, processeur = ?, memoire = ?, systeme_exploitation = ?, date_achat = ?, statut = ? WHERE id = ?");
    if ($stmt->execute([$nom, $processeur, $memoire, $systeme_exploitation, $date_achat, $statut, $id])) {
        header('Location: index.php?route=manage_postes');
        exit;
    } else {
        echo 'Erreur lors de la mise à jour.';
    }
}
?>
