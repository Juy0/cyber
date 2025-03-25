<?php
// controllers/annuler_reservation.php

ob_start(); // Commence la mise en mémoire tampon de sortie

// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?route=login');
    exit;
}

// Traitement de l'annulation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'])) {
    $reservation_id = (int)$_POST['reservation_id'];

    try {
        // Récupérer l'ID du poste associé à la réservation
        $stmt = $pdo->prepare("SELECT poste_id FROM Reservation WHERE id = ?");
        $stmt->execute([$reservation_id]);
        $poste_id = $stmt->fetchColumn();

        // Supprimer la réservation de la base de données
        $stmt = $pdo->prepare("DELETE FROM Reservation WHERE id = ? AND utilisateur_id = ?");
        if ($stmt->execute([$reservation_id, $_SESSION['user_id']])) {
            // Mettre à jour le statut du poste à 'disponible'
            $stmt = $pdo->prepare("UPDATE Postes SET statut = 'disponible' WHERE id = ?");
            if ($stmt->execute([$poste_id])) {
                // Redirection avec un message de succès
                header('Location: index.php?route=reserve_poste&success=1');
                exit;
            } else {
                $error = 'Erreur lors de la mise à jour du statut du poste.';
                error_log("Erreur lors de la mise à jour du statut du poste : " . implode(", ", $stmt->errorInfo()));
            }
        } else {
            $error = 'Erreur lors de l\'annulation de la réservation.';
            error_log("Erreur lors de l'annulation de la réservation : " . implode(", ", $stmt->errorInfo()));
        }
    } catch (PDOException $e) {
        $error = 'Erreur de base de données : ' . $e->getMessage();
        error_log("Erreur de base de données : " . $e->getMessage());
    }

    // Si une erreur s'est produite, la passer à la vue
    if (isset($error)) {
        $_SESSION['error'] = $error;
        header('Location: index.php?route=reserve_poste');
        exit;
    }
}

ob_end_flush(); // Termine la mise en mémoire tampon et envoie le contenu
?>
