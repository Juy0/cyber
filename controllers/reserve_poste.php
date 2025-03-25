<?php
// controllers/reserver_poste.php
ob_start(); // Commence la mise en mémoire tampon
// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est connecté et est un client
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'client') {
    header('Location: index.php?route=login');
    exit;
}

// Récupération des postes disponibles
$stmt = $pdo->query("SELECT * FROM Postes WHERE statut = 'disponible'");
$postes = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère les lignes restantes d'un ensemble de résultats

// Récupération des postes réservés par l'utilisateur connecté
$stmt = $pdo->prepare("
    SELECT r.id AS reservation_id, p.nom AS poste_nom, r.date, r.heure_debut, r.duree
    FROM Reservation r
    JOIN Postes p ON r.poste_id = p.id
    WHERE r.utilisateur_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$postes_reserves = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traitement de la réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur_id = $_SESSION['user_id'];
    $poste_id = (int)$_POST['poste_id'];
    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $duree = (int)$_POST['duree'];

    // Insertion de la réservation dans la BDD
    $stmt = $pdo->prepare("INSERT INTO Reservation (utilisateur_id, poste_id, date, heure_debut, duree) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$utilisateur_id, $poste_id, $date, $heure_debut, $duree])) {
        // Mettre à jour le statut du poste
        $stmt = $pdo->prepare("UPDATE Postes SET statut = 'en maintenance' WHERE id = ?");
        $stmt->execute([$poste_id]);

        // Redirection après une réservation réussie
        header('Location: index.php?route=manage_reservations&success=1');
        exit;
    } else {
        $error = 'Erreur lors de la réservation.';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "Formulaire soumis"; // Ajoute cette ligne pour vérifier
        // Récupération des données et insertion dans la base de données
    }
    
}

// Inclure la vue de réservation
include 'views/reserve_poste.php';
?>


