-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 24 sep. 2024 à 18:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cybergames`
--

-- --------------------------------------------------------

--
-- Structure de la table `achatforfait`
--

CREATE TABLE `achatforfait` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `forfait_id` int(11) NOT NULL,
  `date_achat` datetime NOT NULL,
  `date_expiration` date DEFAULT NULL,
  `status` enum('actif','expiré') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `achatforfait`
--

INSERT INTO `achatforfait` (`id`, `utilisateur_id`, `forfait_id`, `date_achat`, `date_expiration`, `status`) VALUES
(7, 11, 1, '2024-09-23 20:52:10', NULL, 'actif'),
(8, 1, 1, '2024-09-23 20:53:46', NULL, 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `forfait`
--

CREATE TABLE `forfait` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `duree` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `forfait`
--

INSERT INTO `forfait` (`id`, `nom`, `duree`, `prix`) VALUES
(1, 'Forfait 1 heure', 60, 10.00),
(2, 'Forfait 3 heures', 180, 25.00),
(3, 'Forfait journée', 480, 50.00);

-- --------------------------------------------------------

--
-- Structure de la table `jeuxinstalles`
--

CREATE TABLE `jeuxinstalles` (
  `id` int(11) NOT NULL,
  `poste_id` int(11) NOT NULL,
  `nom_jeu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `poste_id` int(11) NOT NULL,
  `date_maintenance` date NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

CREATE TABLE `postes` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `processeur` varchar(100) NOT NULL,
  `memoire` int(11) NOT NULL,
  `systeme_exploitation` varchar(100) NOT NULL,
  `date_achat` date NOT NULL,
  `statut` enum('disponible','en maintenance','hors service') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `postes`
--

INSERT INTO `postes` (`id`, `nom`, `processeur`, `memoire`, `systeme_exploitation`, `date_achat`, `statut`) VALUES
(1, 'poste 1', 'i5', 1600, 'windob', '2024-09-21', 'disponible'),
(2, 'poste 2', 'i7', 4, 'macos', '2024-09-22', 'en maintenance'),
(3, 'Poste 3', 'i5', 16, 'windows', '2024-09-10', 'en maintenance');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `poste_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure_debut` time NOT NULL,
  `duree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `utilisateur_id`, `poste_id`, `date`, `heure_debut`, `duree`) VALUES
(4, 1, 3, '2024-09-25', '23:54:00', 60),
(5, 1, 2, '2024-09-26', '23:55:00', 36);

-- --------------------------------------------------------

--
-- Structure de la table `tournoi`
--

CREATE TABLE `tournoi` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `statut` enum('ouvert','fermé','en cours','terminé') NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tournoi`
--

INSERT INTO `tournoi` (`id`, `nom`, `date`, `statut`, `description`) VALUES
(8, 'cs:go', '2024-09-23', 'ouvert', 'babage'),
(9, 'valo', '2024-09-24', 'ouvert', 'fzefzeffze');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `type_utilisateur` enum('client','admin','employé') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mdp`, `type_utilisateur`) VALUES
(1, 'Michel', 'Junior', 'juniormichel@proton.me', '$2y$10$1CUvrU9CIKSSyTBfv8j4ge6M7axDAMME9JYKJaP4qj2LpjFRBxdpa', 'client'),
(10, 'Michel', 'Junior', 'juniormichel701@gmail.com', '$2y$10$ZkxHGRnhNpyAUKmuvsUeW.X3bZruwI4bCXWU7heQdP2JVzxc0qzV2', 'admin'),
(11, 'Michel', 'Junior', 'juniormichel701@proton.me', '$2y$10$pOLQpBtrcgJirZPDj1Ubxe9YDdOx96.8JcCeuY/8CTPH7ZToVoHyW', 'employé');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achatforfait`
--
ALTER TABLE `achatforfait`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `forfait_id` (`forfait_id`);

--
-- Index pour la table `forfait`
--
ALTER TABLE `forfait`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jeuxinstalles`
--
ALTER TABLE `jeuxinstalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poste_id` (`poste_id`);

--
-- Index pour la table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poste_id` (`poste_id`);

--
-- Index pour la table `postes`
--
ALTER TABLE `postes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `poste_id` (`poste_id`);

--
-- Index pour la table `tournoi`
--
ALTER TABLE `tournoi`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achatforfait`
--
ALTER TABLE `achatforfait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `forfait`
--
ALTER TABLE `forfait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `jeuxinstalles`
--
ALTER TABLE `jeuxinstalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `postes`
--
ALTER TABLE `postes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `tournoi`
--
ALTER TABLE `tournoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achatforfait`
--
ALTER TABLE `achatforfait`
  ADD CONSTRAINT `achatforfait_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `achatforfait_ibfk_2` FOREIGN KEY (`forfait_id`) REFERENCES `forfait` (`id`);

--
-- Contraintes pour la table `jeuxinstalles`
--
ALTER TABLE `jeuxinstalles`
  ADD CONSTRAINT `jeuxinstalles_ibfk_1` FOREIGN KEY (`poste_id`) REFERENCES `postes` (`id`);

--
-- Contraintes pour la table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`poste_id`) REFERENCES `postes` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`poste_id`) REFERENCES `postes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
