<?php
// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

$error = '';

// Vérifie que l'utilisateur est connecté et est un employé ou un admin
if (!isset($_SESSION['user_id']) || ($_SESSION['user_type'] !== 'employé' && $_SESSION['user_type'] !== 'admin')) {
    header('Location: index.php?route=login');
    exit;
}

// Ajout ou modification d'un poste
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $processeur = trim($_POST['processeur']);
    $memoire = (int)$_POST['memoire'];
    $systeme_exploitation = $_POST['systeme_exploitation'];
    $date_achat = $_POST['date_achat'];
    $statut = $_POST['statut'];

    // Vérifie si c'est un ajout ou une modification
    if ($_POST['action'] === 'create') {
        // Insertion du nouveau poste
        $stmt = $pdo->prepare("INSERT INTO Postes (nom, processeur, memoire, systeme_exploitation, date_achat, statut) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$nom, $processeur, $memoire, $systeme_exploitation, $date_achat, $statut])) {
            header('Location: index.php?route=manage_postes');
            exit;
        } else {
            $error = 'Erreur lors de l\'ajout du poste.';
        }
    } elseif ($_POST['action'] === 'edit') {
        $id = (int)$_POST['id'];
        // Mise à jour du poste
        $stmt = $pdo->prepare("UPDATE Postes SET nom = ?, processeur = ?, memoire = ?, systeme_exploitation = ?, date_achat = ?, statut = ? WHERE id = ?");
        if ($stmt->execute([$nom, $processeur, $memoire, $systeme_exploitation, $date_achat, $statut, $id])) {
            header('Location: index.php?route=manage_postes');
            exit;
        } else {
            $error = 'Erreur lors de la modification du poste.';
        }
    }
}

// Modification d'un poste - Récupération des données du poste à modifier
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Récupération des informations du poste
    $stmt = $pdo->prepare("SELECT * FROM Postes WHERE id = ?");
    $stmt->execute([$id]);
    $poste = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$poste) {
        $error = 'Poste non trouvé.';
    } else {
        // Inclure la vue pour éditer le poste
        include 'views/edit_postes.php';
        exit;  // On sort pour afficher la page d'édition et ne pas continuer l'exécution
    }
}

// Suppression d'un poste
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM Postes WHERE id = ?");
    if ($stmt->execute([$_GET['id']])) {
        header('Location: index.php?route=manage_postes&success=deleted');
        exit;
    } else {
        $error = 'Erreur lors de la suppression du poste.';
    }
}

// Récupération des postes existants
$stmt = $pdo->query("SELECT * FROM Postes");
$postes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inclure la vue de gestion des postes
include 'views/manage_postes.php';
?>
