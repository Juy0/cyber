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

// Inclure la vue pour afficher les postes réservés
?>

<h2>Mes Postes Réservés</h2>

<?php if (empty($postes_reserves)): ?>
    <p>Vous n'avez réservé aucun poste.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nom du Poste</th>
                <th>Date</th>
                <th>Heure de Début</th>
                <th>Durée (minutes)</th>
                <th>Utilisateur</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- filepath: /Applications/XAMPP/xamppfiles/htdocs/cyber/views/header.php -->
<?php if (isset($_SESSION['user_id'])): ?>
    <li><a href="index.php?route=postes_reserves">Mes Postes Réservés</a></li>
<?php endif; ?>