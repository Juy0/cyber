<?php
// Démarre la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est connecté et est un admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: index.php?route=login');
    exit;
}

// Initialisation des variables
$nom = $date = $description = '';
$error = '';

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = trim($_POST['nom']);
    $jeu_id = (int)$_POST['jeu_id'];
    $date = trim($_POST['date']);
    $description = trim($_POST['description']);
    $statut = trim($_POST['statut']);

    // Validation des données
    if (empty($nom) || empty($jeu_id) || empty($date) || empty($description) || empty($statut)) {
        $error = 'Tous les champs sont requis.';
    } else {
        // Insertion dans la base de données
        $stmt = $pdo->prepare("INSERT INTO Tournoi (nom, jeu_id, date, description, statut) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$nom, $jeu_id, $date, $description, $statut])) {
            header('Location: index.php?route=tournois&success=1');
            exit;
        } else {
            $error = 'Erreur lors de la création du tournoi. Veuillez réessayer.';
        }
    }
}

// Inclure la vue de création de tournoi
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/views/create_tournament.php';
?>
