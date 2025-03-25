CREATE TABLE Poste (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    processeur VARCHAR(100) NOT NULL,
    memoire INT NOT NULL, -- Mémoire en Go
    statut ENUM('disponible', 'en maintenance', 'hors service') NOT NULL
);

CREATE TABLE Utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    type_utilisateur ENUM('client', 'admin', 'employé') NOT NULL
);

CREATE TABLE Tournoi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    status ENUM('ouvert', 'fermé', 'en cours', 'terminé') NOT NULL
);

CREATE TABLE Reservation (
    id INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT NOT NULL,
    poste_id INT NOT NULL,
    date DATE NOT NULL,
    heure_debut TIME NOT NULL,
    duree INT NOT NULL, -- Durée en minutes
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(id),
    FOREIGN KEY (poste_id) REFERENCES Poste(id)
);

CREATE TABLE Maintenance (
    id INT PRIMARY KEY AUTO_INCREMENT,
    poste_id INT NOT NULL,
);
