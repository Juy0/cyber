<?php
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/db.php';

// Récupération des jeux disponibles
try {
    $stmt = $pdo->query("SELECT * FROM jeux");
    $jeux = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Inclure la vue des jeux
include $_SERVER['DOCUMENT_ROOT'] . '/cyber/views/jeux.php';
?>
