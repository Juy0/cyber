<?php
// Connexion à la base de données
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?route=login');
    exit;
}

// Récupération des postes réservés
$stmt = $pdo->prepare("
    SELECT r.id AS reservation_id, p.nom AS poste_nom, r.date, r.heure_debut, r.duree, u.nom AS utilisateur_nom
    FROM Reservation r
    JOIN Postes p ON r.poste_id = p.id
    JOIN Utilisateurs u ON r.utilisateur_id = u.id
    WHERE r.utilisateur_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$postes_reserves = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            $stmt->execute([$poste_id]);

            // Redirection avec un message de succès
            header('Location: index.php?route=postes_reserves&success=1');
            exit;
        } else {
            $error = 'Erreur lors de l\'annulation de la réservation.';
        }
    } catch (PDOException $e) {
        $error = 'Erreur de base de données : ' . $e->getMessage();
    }

    // Si une erreur s'est produite, la passer à la vue
    if (isset($error)) {
        $_SESSION['error'] = $error;
        header('Location: index.php?route=postes_reserves');
        exit;
    }
}

// Inclure la vue pour afficher les postes réservés
?>

<h2 style="text-align: center; color: #333;">Mes Postes Réservés</h2>

<?php if (empty($postes_reserves)): ?>
    <p style="text-align: center; color: #555;">Vous n'avez réservé aucun poste.</p>
<?php else: ?>
    <style>
        .reservations-table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .reservations-table th, .reservations-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .reservations-table th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
        }

        .reservations-table tr:hover {
            background-color: #f5f5f5;
        }

        .reservations-table .actions button {
            padding: 8px 12px;
            font-size: 0.9em;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .reservations-table .actions button:hover {
            background-color: #a71d2a;
        }
    </style>

    <table class="reservations-table">
        <thead>
            <tr>
                <th>Nom du Poste</th>
                <th>Date</th>
                <th>Heure de Début</th>
                <th>Durée (minutes)</th>
                <th>Utilisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($postes_reserves as $reservation): ?>
                <tr>
                    <td><?= htmlspecialchars($reservation['poste_nom']) ?></td>
                    <td><?= htmlspecialchars($reservation['date']) ?></td>
                    <td><?= htmlspecialchars($reservation['heure_debut']) ?></td>
                    <td><?= htmlspecialchars($reservation['duree']) ?></td>
                    <td><?= htmlspecialchars($reservation['utilisateur_nom']) ?></td>
                    <td class="actions">
                        <form method="post" action="index.php?route=postes_reserves">
                            <input type="hidden" name="reservation_id" value="<?= $reservation['reservation_id'] ?>">
                            <button type="submit">Annuler</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- filepath: /Applications/XAMPP/xamppfiles/htdocs/cyber/views/header.php -->
