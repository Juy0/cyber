<?php
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?route=login');
    exit;
}

// Vérifie si une requête POST a été faite
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['achat_id'])) {
        $achat_id = (int)$_POST['achat_id'];
        // Debugging output
        error_log("Résiliation demandée pour l'achat ID: " . $achat_id);

        // Mettre à jour le statut du forfait à 'expiré'
        $stmt = $pdo->prepare("UPDATE AchatForfait SET status = 'expiré' WHERE id = ? AND utilisateur_id = ?");
        if ($stmt->execute([$achat_id, $_SESSION['user_id']])) {
            error_log("Forfait résilié : ID " . $achat_id);
            header('Location: index.php?route=profil&success=1');
            exit;
        } else {
            error_log("Erreur lors de la mise à jour : " . implode(", ", $stmt->errorInfo()));
            $error = 'Erreur lors de la résiliation du forfait.';
        }

    }
}

?>
