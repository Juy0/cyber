<?php
// session_start(); // Assurez-vous de démarrer la session

// Connexion à la base de données
include 'db.php';

// Logique de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification des identifiants
    $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mdp'])) {
        // Création de la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['type_utilisateur'];
        header('Location: index.php'); // Redirection vers la page d'accueil
        exit;
    } else {
        $error = 'Identifiants invalides.';
    }
}

// Inclusion de la vue de connexion || Si c'est une requête GET, affiche la vue
include 'views/login.php';
?>
