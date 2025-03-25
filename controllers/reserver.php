<?php
session_start(); // Assurez-vous de démarrer la session

// Connexion à la base de données
include '../db.php';

// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?route=login');
    exit;
}

// Logique pour réserver un poste
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poste_id = $_POST['poste_id'];
    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $duree = $_POST['duree'];

    // Logique d'insertion dans la base de données (ajouter une réservation)
    $stmt = $pdo->prepare("INSERT INTO Reservations (poste_id, user_id, date, heure_debut, duree) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$poste_id, $_SESSION['user_id'], $date, $heure_debut, $duree])) {
        // Redirection ou message de succès
        header('Location: index.php?route=reserver&success=1');
        exit;
    } else {
        $error = 'Erreur lors de la réservation. Veuillez réessayer.';
    }
}

// Récupération des postes disponibles
$stmt = $pdo->query("SELECT * FROM Poste WHERE statut = 'disponible'");
$postes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inclusion de la vue pour réserver
include '../views/reserver.php';
?>
