<?php
//session_start();

// Connexion à la base de données
include 'db.php';

// Initialisation des variables
$nom = $prenom = $email = $password = $type_utilisateur = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $type_utilisateur = $_POST['type_utilisateur'];

    // Validation des données
    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($type_utilisateur)) {
        $error = 'Tous les champs sont requis.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Adresse email invalide.';
    } else {
        // Vérification si l'email existe déjà
        $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            $error = 'L\'adresse email est déjà utilisée.';
        } else {
            // Hachage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertion dans la base de données
            $stmt = $pdo->prepare("INSERT INTO Utilisateurs (nom, prenom, email, mdp, type_utilisateur) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$nom, $prenom, $email, $hashed_password, $type_utilisateur])) {
                // Redirection vers la page de connexion
                header('Location: ../index.php?route=login');
                exit;
            } else {
                $error = 'Erreur lors de l\'inscription. Veuillez réessayer.';
            }
        }
    }
}

// Inclure la vue d'inscription
include 'views/register.php';
?>
