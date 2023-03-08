-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 08 mars 2023 à 12:41
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cesi-php-sql`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `idCours` int NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `idType` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idCours`, `libelle`, `description`, `image`, `idType`) VALUES
(3, 'L\'algo en PHP', 'Pellentesque sodales vitae enim ut elementum. Quisque sit amet felis eu nunc pellentesque consectetur eget ac ex. Sed ut mi consectetur, maximus leo vel, tempus ipsum. ', 'l\'algo-en-php_html.jpg', 3),
(4, 'Les animations en Javasc', 'Aenean id nunc consequat, mollis ligula vitae, ullamcorper lacus. Aliquam vulputate sagittis ante, ut dignissim tortor tristique at. Duis molestie ornare ex, eu commodo elit pharetra sed. ', 'js.jpg', 4);

-- --------------------------------------------------------

--
-- Structure de la table `ressources`
--

CREATE TABLE `ressources` (
  `idRessource` int NOT NULL,
  `titre` varchar(100) NOT NULL,
  `lien` varchar(200) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idType` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ressources`
--

INSERT INTO `ressources` (`idRessource`, `titre`, `lien`, `description`, `date`, `idType`) VALUES
(1, 'Apprendre le devellopement web', 'https://developer.mozilla.org/fr/docs/Learn', 'Duis posuere risus felis, sit amet condimentum lorem scelerisque non.', '2023-03-08 09:52:24', 5),
(2, 'Cours sur symfony', 'https://grafikart.fr/formations/symfony-4-pratique', 'Quisque non lacus sit amet ex varius consectetur quis quis lectus.', '2023-03-08 09:52:24', 3),
(3, 'Fullstack en js', 'https://openclassrooms.com/fr/courses/6390246-passez-au-full-stack-avec-node-js-express-et-mongodb', 'Vestibulum luctus sed mauris at efficitur. Sed magna arcu,', '2023-03-08 09:55:09', 4),
(4, 'l\'élément template en html', 'https://developer.mozilla.org/en-US/docs/Web/HTML/Element/template', 'Vestibulum luctus sed mauris at  arcu, feugiat vel orci vel, sodales semper justo', '2023-03-08 09:55:09', 5);

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `idType` int NOT NULL,
  `libelle` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`idType`, `libelle`) VALUES
(3, 'PHP'),
(4, 'Javascipt'),
(5, 'test'),
(12, 'Python');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`idCours`),
  ADD KEY `FK_TYPE_COURS` (`idType`);

--
-- Index pour la table `ressources`
--
ALTER TABLE `ressources`
  ADD PRIMARY KEY (`idRessource`),
  ADD KEY `FK_TYPE_RESSOURCES` (`idType`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`idType`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `idCours` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `ressources`
--
ALTER TABLE `ressources`
  MODIFY `idRessource` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `idType` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_TYPE_COURS` FOREIGN KEY (`idType`) REFERENCES `types` (`idType`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `ressources`
--
ALTER TABLE `ressources`
  ADD CONSTRAINT `FK_TYPE_RESSOURCES` FOREIGN KEY (`idType`) REFERENCES `types` (`idType`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
