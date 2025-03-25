<?php
// Connexion à la base de données
$db = "cybergames";
$dbhost = "localhost";
$dbuser = "root";
$dbpasswd = "";

$pdo = new PDO('mysql:host=' . $dbhost . ';dbname=' . $db, $dbuser, $dbpasswd);
$pdo->exec("SET CHARACTER SET utf8");
?>
