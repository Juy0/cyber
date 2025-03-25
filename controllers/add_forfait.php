<?php
// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $duree = $_POST['duree'];
    $prix = $_POST['prix'];

    $stmt = $pdo->prepare("INSERT INTO Forfait (nom, duree, prix) VALUES (?, ?, ?)");
    if ($stmt->execute([$nom, $duree, $prix])) {
        echo "Forfait ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du forfait.";
    }
}
?>
