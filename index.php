<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Démarre la session pour gérer les utilisateurs connectés

// Connexion à la base de données
include 'db.php'; // Inclut le fichier de connexion à la base de données

// Traitement de l'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['route']) && $_GET['route'] === 'register') {
    // Récupération des données du formulaire d'inscription
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashage du mot de passe
    $type_utilisateur = $_POST['type_utilisateur'];

    // Vérification si l'email existe déjà dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère l'utilisateur si trouvé

    // Si l'email existe déjà, afficher un message d'erreur
    if ($existingUser) {
        echo "<p>L'email est déjà utilisé. Veuillez en choisir un autre.</p>";
    } else {
        // Insertion dans la base de données si l'email est unique
        $stmt = $pdo->prepare("INSERT INTO Utilisateurs (nom, prenom, email, mdp, type_utilisateur) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$nom, $prenom, $email, $password, $type_utilisateur])) {
            // Redirection vers la page de connexion après une inscription réussie
            header('Location: index.php?route=login');
            exit;
        }
    }
}

// Traitement de la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['route']) && $_GET['route'] === 'login') {
    // Récupération des données du formulaire de connexion
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification des identifiants dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère l'utilisateur si trouvé

    // Vérification si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($password, $user['mdp'])) {
        $_SESSION['user_id'] = $user['id']; // Stocke l'ID de l'utilisateur dans la session
        $_SESSION['user_type'] = $user['type_utilisateur']; // Stocke le type d'utilisateur
        header('Location: index.php'); // Redirection vers la page d'accueil
        exit;
    } else {
        // Affiche un message d'erreur si les identifiants sont invalides
        echo "<p>Identifiants invalides.</p>";
    }
}

// Déconnexion
if (isset($_GET['route']) && $_GET['route'] === 'logout') {
    session_destroy(); // Détruit la session pour déconnecter l'utilisateur
    header('Location: index.php'); // Redirection vers la page d'accueil
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberGames Arras</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'views/header.php'; ?> <!-- Inclut la barre de navigation -->

    <main>
        <?php
        // Routeur simple pour déterminer quelle vue afficher
        $route = $_GET['route'] ?? 'home';

        // Contrôleur
        switch ($route) {
            case 'home':
                include 'views/home.php'; // Inclut la vue d'accueil
                break;
            case 'tournois':
                // Récupération des tournois pour les afficher
                $stmt = $pdo->query('SELECT * FROM Tournoi ORDER BY date DESC');
                $tournois = $stmt->fetchAll(PDO::FETCH_ASSOC);
                include 'views/tournois.php'; // Inclut la vue des tournois
                break;
            case 'login':
                include 'controllers/login.php'; // Gère la logique de connexion
                break;
            case 'register':
                include 'controllers/register.php'; // Gère la logique d'inscription
                break;
            case 'admin':
                // Vérifie si l'utilisateur est admin avant d'accéder à la vue admin
                if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
                    header('Location: index.php?route=login'); // Redirection vers la connexion
                    exit;
                }
                include 'views/admin.php'; // Inclut la vue admin
                break;
            case 'reserver':
                // Vérifie si l'utilisateur est connecté avant de réserver
                if (!isset($_SESSION['user_id'])) {
                    header('Location: index.php?route=login'); // Redirection vers la connexion
                    exit;
                }
                include 'controllers/reserver.php'; // Gère la logique de réservation
                break;
            case 'inventory':
                // Vérifie si l'utilisateur a les droits pour voir l'inventaire
                if (!isset($_SESSION['user_id']) || ($_SESSION['user_type'] !== 'employé' && $_SESSION['user_type'] !== 'admin')) {
                    header('Location: index.php?route=login'); // Redirection vers la connexion
                    exit;
                }
                include 'views/inventory.php'; // Inclut la vue d'inventaire
                break;
            
            case 'create_tournament':
                // Vérifie que l'utilisateur est connecté et a les droits d'admin
                if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
                    header('Location: index.php?route=login');
                    exit;
                }
                include 'controllers/create_tournament.php'; // Inclure le contrôleur de création de tournoi
                break;

            case 'delete_tournament':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && $_SESSION['user_type'] === 'admin') {
                    $id = (int)$_POST['id'];
        
                    // Supprimer le tournoi de la base de données
                    $stmt = $pdo->prepare("DELETE FROM Tournoi WHERE id = ?");
                    $stmt->execute([$id]);

                    // Redirection vers la liste des tournois
                    header('Location: index.php?route=tournois');
                    exit;
                }
                break;
            case 'edit_tournament':
                if ($_SESSION['user_type'] === 'admin' && isset($_GET['id'])) {
                    $id = (int)$_GET['id'];
                    
                    // Récupérer le tournoi depuis la base de données
                    $stmt = $pdo->prepare("SELECT * FROM Tournoi WHERE id = ?");
                    $stmt->execute([$id]);
                    $tournoi = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($tournoi) {
                        include 'views/edit_tournament.php'; // Inclure la vue d'édition de tournoi
                    } else {
                        echo "Tournoi introuvable.";
                    }
                } else {
                    header('Location: index.php?route=login');
                    exit;
                }
                break;
            case 'update_tournament':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && $_SESSION['user_type'] === 'admin') {
                    $id = (int)$_POST['id'];
                    $nom = trim($_POST['nom']);
                    $date = trim($_POST['date']);
                    $description = trim($_POST['description']);

                    if (!empty($nom) && !empty($date) && !empty($description) && !empty($statut)) {
                        // Mettre à jour le tournoi dans la base de données
                        $stmt = $pdo->prepare("UPDATE Tournoi SET nom = ?, date = ?, description = ?, statut = ? WHERE id = ?");
                        $stmt->execute([$nom, $date, $description,  $id]);

                        // Redirection vers la liste des tournois
                        header('Location: index.php?route=tournois');
                    exit;
                    } else {
                        echo "Tous les champs sont requis.";
                    }
                }
                break;
            case 'manage_postes':
                // Vérifie que l'utilisateur est admin ou employé
                if (!isset($_SESSION['user_id']) || ($_SESSION['user_type'] !== 'admin' && $_SESSION['user_type'] !== 'employé')) {
                    header('Location: index.php?route=login');
                    exit;
                }
                include 'controllers/manage_postes.php'; // Contrôleur pour gérer les postes
                break;
            case 'reserve_poste':
                include 'controllers/reserve_poste.php';
                break;

            case 'manage_reservations':
                include 'controllers/manage_reservations.php';
                break;
            case 'profil':
                include 'controllers/profil.php';
                break;
            case 'acheter_forfait':
                include 'controllers/acheter_forfait.php';
                break;
            case 'annuler_reservation':
                include 'controllers/annuler_reservation.php';
                break;   
            case 'resilier_forfait':
                include 'controllers/resilier_forfait.php';
                break;
            case 'postes_reserves':
                // Vérifie que l'utilisateur est connecté
                if (!isset($_SESSION['user_id'])) {
                    header('Location: index.php?route=login');
                    exit;
                }
                include 'controllers/postes_reserves.php'; // Contrôleur pour afficher les postes réservés
                break;
            case 'inscrire_tournoi':
                include 'controllers/inscrire_tournoi.php';
                break;
            case 'desinscrire_tournoi':
                include 'controllers/desinscrire_tournoi.php';
                break;
            case 'add_game':
                include 'controllers/add_game.php';
                break;
            case 'jeux':
                include 'controllers/jeux.php';
                break;
            case 'edit_game':
                include 'controllers/edit_game.php';
                break;
            case 'delete_game':
                include 'controllers/delete_game.php';
                break;
            case 'manage_tournaments':
                // Vérifie que l'utilisateur est admin
                if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
                    header('Location: index.php?route=login');
                    exit;
                }
                include 'controllers/manage_tournaments.php';
                break;
        }
        ?>

        <?php if (isset($_GET['success'])): ?>
            <p style="color: green;">Réservation annulée avec succès.</p>
        <?php elseif (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </main>

    <footer>
        <?php include 'views/footer.php'; ?>
    </footer>
</body>
</html>
