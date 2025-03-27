<?php
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: index.php?route=login');
    exit;
}

$error = '';

// Ajout ou modification d'un tournoi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $jeu_id = (int)$_POST['jeu_id'];
    $date = $_POST['date'];
    $description = trim($_POST['description']);
    $statut = $_POST['statut'];

    if ($_POST['action'] === 'create') {
        // Insertion d'un nouveau tournoi
        $stmt = $pdo->prepare("INSERT INTO Tournoi (nom, jeu_id, date, description, statut) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$nom, $jeu_id, $date, $description, $statut])) {
            header('Location: index.php?route=manage_tournaments');
            exit;
        } else {
            $error = 'Erreur lors de l\'ajout du tournoi.';
        }
    } elseif ($_POST['action'] === 'edit') {
        $id = (int)$_POST['id'];
        // Mise à jour d'un tournoi
        $stmt = $pdo->prepare("UPDATE Tournoi SET nom = ?, jeu_id = ?, date = ?, description = ?, statut = ? WHERE id = ?");
        if ($stmt->execute([$nom, $jeu_id, $date, $description, $statut, $id])) {
            header('Location: index.php?route=manage_tournaments');
            exit;
        } else {
            $error = 'Erreur lors de la modification du tournoi.';
        }
    }
}

// Suppression d'un tournoi
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM Tournoi WHERE id = ?");
    if ($stmt->execute([$_GET['id']])) {
        header('Location: index.php?route=manage_tournaments&success=deleted');
        exit;
    } else {
        $error = 'Erreur lors de la suppression du tournoi.';
    }
}

// Récupération des tournois existants
$stmt = $pdo->query("SELECT t.*, j.nom AS jeu_nom FROM Tournoi t JOIN jeux j ON t.jeu_id = j.id");
$tournois = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inclure la vue de gestion des tournois
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/views/manage_tournaments.php';
?>
