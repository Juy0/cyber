<?php 
// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Initialisation des variables
$nom = $date = $description = ''; // Assurez-vous que 'description' est ici
$error = '';

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = trim($_POST['nom']); // trim -> efface les espaces blanc pour éviter les erreurs
    $date = trim($_POST['date']);
    $description = trim($_POST['description']);
    $statut = trim($_POST['statut']);

    // Validation des données
    if (empty($nom) || empty($date) || empty($description) || empty($statut)) {
        $error = 'Tous les champs sont requis.';
    } else {
        // Insertion dans la base de données
        $stmt = $pdo->prepare("INSERT INTO Tournoi (nom, date, description, statut) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nom, $date, $description, $statut])) {
            header('Location: index.php?route=tournois');
            exit;
        } else {
            $error = 'Erreur lors de la création du tournoi. Veuillez réessayer.';
        }
    }
}

// Inclure la vue de création de tournoi
include 'views/create_tournament.php';
?>
