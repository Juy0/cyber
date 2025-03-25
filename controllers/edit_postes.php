<?php
// Modification d'un poste - Récupération des données du poste à modifier
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Récupération des informations du poste
    $stmt = $pdo->prepare("SELECT * FROM Postes WHERE id = ?");
    $stmt->execute([$id]);
    $poste = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$poste) {
        $error = 'Poste non trouvé.';
    }

    // Inclure la vue pour éditer le poste
    include 'views/edit_postes.php';
    exit;  // On sort pour afficher la page d'édition et ne pas continuer l'exécution
}

?>