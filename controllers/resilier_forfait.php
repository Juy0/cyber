<?php
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

if (!isset($_SESSION['user_id'])) {
    error_log("Erreur : utilisateur non connecté.");
    header('Location: index.php?route=login');
    exit;
} else {
    error_log("Utilisateur connecté : user_id = " . $_SESSION['user_id']);
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['achat_id']) && is_numeric($_POST['achat_id'])) {
            $achat_id = (int)$_POST['achat_id'];
            $user_id = $_SESSION['user_id'];

            error_log("Tentative de résiliation du forfait : achat_id = $achat_id, user_id = $user_id");
            error_log("Paramètres reçus : achat_id = " . $achat_id . ", user_id = " . $user_id);

            // Ajout d'un log pour afficher toutes les données de la table achatforfait
            $stmt_all = $pdo->query("SELECT * FROM achatforfait");
            $allForfaits = $stmt_all->fetchAll(PDO::FETCH_ASSOC);
            error_log("Contenu de la table achatforfait : " . json_encode($allForfaits));

            // Vérification de l'existence du forfait
            $stmt = $pdo->prepare("SELECT * FROM achatforfait WHERE id = ? AND utilisateur_id = ?");
            error_log("Exécution de la requête : SELECT * FROM achatforfait WHERE id = $achat_id AND utilisateur_id = $user_id");
            if (!$stmt->execute([$achat_id, $user_id])) {
                error_log("Erreur SQL : " . implode(", ", $stmt->errorInfo()));
                throw new Exception("Erreur SQL lors de la vérification du forfait.");
            }

            $forfait = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("Résultat de la requête : " . json_encode($forfait));

            if (!$forfait) {
                error_log("Aucun forfait trouvé pour l'utilisateur $user_id avec l'ID $achat_id.");
                throw new Exception("Aucun forfait trouvé.");
            }

            error_log("Forfait trouvé : " . json_encode($forfait));

            // Mise à jour du statut du forfait
            $stmt = $pdo->prepare("UPDATE achatforfait SET status = 'expiré' WHERE id = ? AND utilisateur_id = ?");
            if (!$stmt->execute([$achat_id, $user_id])) {
                error_log("Erreur SQL lors de la mise à jour du statut : " . implode(", ", $stmt->errorInfo()));
                throw new Exception("Erreur SQL lors de la mise à jour du statut.");
            }

            if ($stmt->rowCount() > 0) {
                error_log("Mise à jour réussie pour le forfait ID $achat_id.");
                header('Location: index.php?route=profil&success=forfait_resilie');
                exit;
            } else {
                error_log("La mise à jour du statut a échoué pour l'ID $achat_id. Aucun enregistrement n'a été modifié.");
                throw new Exception("La mise à jour du statut a échoué.");
            }
        } else {
            error_log("ID de forfait invalide ou non fourni.");
            throw new Exception("ID de forfait invalide ou non fourni.");
        }
    } else {
        error_log("Requête non POST détectée.");
        throw new Exception("Requête non POST détectée.");
    }
} catch (Exception $e) {
    error_log("Erreur : " . $e->getMessage());
    header('Location: index.php?route=profil&error=forfait_non_resilie');
    exit;
}
?>
