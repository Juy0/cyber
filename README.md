# CyberGames Arras - Gestion des Postes et Réservations

## **Description**

CyberGames Arras est une application web conçue pour moderniser la gestion des postes informatiques et des réservations dans un cybercafé spécialisé en jeux vidéo et e-sport. Ce projet vise à améliorer l'expérience utilisateur, optimiser les ressources du cybercafé et simplifier les tâches administratives pour les employés et les administrateurs.

---

## **Fonctionnalités principales**

### **Pour les clients :**

*   **Réservation de postes :**
    *   Réservez un poste en ligne en sélectionnant une date, une heure et une durée.
    *   Consultez vos réservations actives.
    *   Annulez une réservation si nécessaire.
*   **Gestion des forfaits :**
    *   Achetez des forfaits pour accéder aux postes.
    *   Consultez vos forfaits actifs.
    *   Résiliez un forfait si nécessaire.
*   **Participation aux tournois :**
    *   Consultez la liste des tournois disponibles.
    *   Inscrivez-vous aux tournois ouverts.

### **Pour les employés :**

*   **Gestion des postes :**
    *   Ajoutez, modifiez ou supprimez des postes.
    *   Gérez les caractéristiques des postes (processeur, mémoire, statut, etc.).
    *   Planifiez et suivez les maintenances.
*   **Gestion des réservations :**
    *   Consultez toutes les réservations actives.
    *   Annulez ou modifiez des réservations si nécessaire.

### **Pour les administrateurs :**

*   **Gestion des tournois :**
    *   Créez, modifiez ou supprimez des tournois.
    *   Gérez les inscriptions et les statuts des tournois.
*   **Supervision des employés et des utilisateurs :**
    *   Consultez les actions des employés.
    *   Gérez les comptes utilisateurs.

---

## **Technologies utilisées**

### **Backend :**

*   **PHP** : Gestion de la logique métier et des interactions avec la base de données.
*   **PDO** : Sécurisation des requêtes SQL.

### **Frontend :**

*   **HTML/CSS** : Structure et style des pages.

### **Base de données :**

*   **MySQL** : Stockage des données des utilisateurs, postes, réservations, forfaits et tournois.

### **Environnement de développement :**

*   **XAMPP** : Serveur local pour exécuter l'application.
*   **Docker** : Conteneurisation pour un déploiement simplifié.

---

## **Schéma de la base de données**

La base de données `cybergames` est conçue pour centraliser les données de l’application. Voici un aperçu des tables principales et de leurs relations :

*   **Utilisateurs :** Stocke les informations des utilisateurs (id, nom, prénom, email, mdp, type\_utilisateur).
*   **Postes :** Contient les informations des postes informatiques (id, nom, processeur, memoire, systeme\_exploitation, date\_achat, statut).
*   **Reservation :** Gère les réservations des postes (id, utilisateur\_id, poste\_id, date, heure\_debut, duree).
*   **Forfait :** Contient les forfaits disponibles (id, nom, duree, prix).
*   **AchatForfait :** Gère les forfaits achetés par les utilisateurs (id, utilisateur\_id, forfait\_id, date\_achat, status).
*   **Tournoi :** Stocke les informations des tournois (id, nom, jeu\_id, date, statut, description).
*   **Jeux :** Stocke les informations sur les jeux (id, nom).

**Relations :**

*   `Reservation.utilisateur_id` fait référence à `Utilisateurs.id`
*   `Reservation.poste_id` fait référence à `Postes.id`
*   `AchatForfait.utilisateur_id` fait référence à `Utilisateurs.id`
*   `AchatForfait.forfait_id` fait référence à `Forfait.id`
*   `Tournoi.jeu_id` fait référence à `Jeux.id`

---

## **Installation**

Pour installer et exécuter l'application, suivez les instructions ci-dessous :

### **Prérequis :**

*   **XAMPP** ou tout autre serveur local avec PHP et MySQL.
*   **Docker** (optionnel pour la conteneurisation).

### **Procédure :**

1.  Clonez le repository GitHub :

    ```bash
    git clone https://github.com/Juy0/cyber.git
    ```

2.  **Configuration de la base de données avec XAMPP :**
    *   Démarrez les services Apache et MySQL via le panneau de contrôle XAMPP.
    *   Ouvrez votre navigateur et accédez à `http://localhost/phpmyadmin/`.
    *   Créez une nouvelle base de données nommée `cybergames`.
    *   Importez le fichier `cybergames.sql` (situé à la racine du projet) dans la base de données `cybergames` pour créer les tables et insérer les données initiales.
    *   Modifiez le fichier `db.php` pour correspondre à vos paramètres de connexion MySQL (hôte, nom d'utilisateur, mot de passe).

3.  **Arborescence des fichiers :**

    ```
    cyber/
    ├── controllers/
    │   ├── add_game.php
    │   ├── acheter_forfait.php
    │   ├── annuler_reservation.php
    │   ├── create_tournament.php
    │   ├── delete_game.php
    │   ├── desinscrire_tournoi.php
    │   ├── edit_game.php
    │   ├── edit_postes.php
    │   ├── inscrire_tournoi.php
    │   ├── login.php
    │   ├── manage_postes.php
    │   ├── manage_reservations.php
    │   ├── manage_tournaments.php
    │   ├── postes_reserves.php
    │   ├── profil.php
    │   ├── register.php
    │   ├── resilier_forfait.php
    │   └── reserve_poste.php
    ├── css/
    │   └── style.css
    ├── db.php
    ├── index.php
    ├── views/
    │   ├── add_game.php
    │   ├── acheter_forfait.php
    │   ├── admin.php
    │   ├── create_tournament.php
    │   ├── edit_game.php
    │   ├── edit_postes.php
    │   ├── edit_tournament.php
    │   ├── footer.php
    │   ├── form_postes.php
    │   ├── header.php
    │   ├── home.php
    │   ├── inventory.php
    │   ├── jeux.php
    │   ├── login.php
    │   ├── manage_postes.php
    │   ├── manage_reservations.php
    │   ├── profil.php
    │   ├── register.php
    │   ├── reserve_poste.php
    │   └── tournois.php
    ├── cybergames.sql
    └── README.md
    ```

---