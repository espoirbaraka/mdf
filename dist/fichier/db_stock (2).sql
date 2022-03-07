-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 05 août 2021 à 15:40
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_approvisionnement`
--

CREATE TABLE `t_approvisionnement` (
  `CodeApprovisionnement` int(11) NOT NULL,
  `CodeProduit` int(11) NOT NULL,
  `CodeFournisseur` int(11) NOT NULL,
  `DateApprovisionnement` date NOT NULL,
  `DateFabrication` date NOT NULL,
  `DateExpiration` date NOT NULL,
  `QuantiteApprovisionnement` int(11) NOT NULL,
  `PrixUnitaireAchat` decimal(10,2) NOT NULL,
  `PrixTotalAchat` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_approvisionnement`
--

INSERT INTO `t_approvisionnement` (`CodeApprovisionnement`, `CodeProduit`, `CodeFournisseur`, `DateApprovisionnement`, `DateFabrication`, `DateExpiration`, `QuantiteApprovisionnement`, `PrixUnitaireAchat`, `PrixTotalAchat`) VALUES
(8, 10, 1, '2020-10-23', '2018-12-10', '2019-12-12', 21, '10.00', '210.00'),
(9, 11, 1, '2020-10-23', '2019-12-12', '2023-12-21', 12, '10.00', '120.00'),
(10, 10, 1, '2020-10-23', '2019-11-11', '2022-11-11', 2, '10.00', '20.00'),
(11, 12, 1, '2020-10-23', '2019-11-11', '2023-11-11', 23, '11.00', '253.00'),
(12, 11, 2, '2020-10-24', '2019-12-12', '2020-10-26', 12, '12.00', '144.00'),
(13, 10, 3, '2020-10-24', '2019-12-12', '2020-10-30', 12, '11.00', '132.00'),
(14, 11, 1, '2020-10-24', '2019-12-12', '2020-10-10', 12, '10.00', '120.00'),
(15, 14, 1, '2020-10-24', '2019-10-12', '2021-01-12', 10, '15.00', '150.00'),
(16, 13, 1, '2020-10-24', '2019-11-10', '2021-10-10', 12, '10.00', '120.00'),
(17, 14, 2, '2021-08-04', '2019-12-12', '2021-12-12', 2, '12.00', '24.00');

-- --------------------------------------------------------

--
-- Structure de la table `t_categorieproduit`
--

CREATE TABLE `t_categorieproduit` (
  `CodeCategorie` int(11) NOT NULL,
  `DesignationCategorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_categorieproduit`
--

INSERT INTO `t_categorieproduit` (`CodeCategorie`, `DesignationCategorie`) VALUES
(1, 'ine'),
(2, 'ose'),
(3, 'ole');

-- --------------------------------------------------------

--
-- Structure de la table `t_client`
--

CREATE TABLE `t_client` (
  `CodeClient` int(11) NOT NULL,
  `NomClient` varchar(50) NOT NULL,
  `AdresseClient` text NOT NULL,
  `TelephoneClient` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_client`
--

INSERT INTO `t_client` (`CodeClient`, `NomClient`, `AdresseClient`, `TelephoneClient`) VALUES
(1, 'ESB', 'goma', '0977665544');

-- --------------------------------------------------------

--
-- Structure de la table `t_commande`
--

CREATE TABLE `t_commande` (
  `CodeCommande` int(11) NOT NULL,
  `CodeProduit` int(11) NOT NULL,
  `CodeService` int(11) NOT NULL,
  `QuantiteCommande` int(11) NOT NULL,
  `DateCommande` date NOT NULL,
  `MotifCommande` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_commande`
--

INSERT INTO `t_commande` (`CodeCommande`, `CodeProduit`, `CodeService`, `QuantiteCommande`, `DateCommande`, `MotifCommande`) VALUES
(8, 10, 1, 30, '2020-10-23', 'pas de stock'),
(9, 11, 1, 12, '2020-10-24', 'Manque de stock'),
(10, 13, 1, 10, '2020-10-24', 'DIminution'),
(11, 14, 1, 14, '2020-10-24', 'stock insuffisant'),
(12, 14, 1, 12, '2021-08-04', '');

-- --------------------------------------------------------

--
-- Structure de la table `t_compte`
--

CREATE TABLE `t_compte` (
  `CodeCompte` int(11) NOT NULL,
  `MailCompte` varchar(50) NOT NULL,
  `PasswordCompte` varchar(30) NOT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_compte`
--

INSERT INTO `t_compte` (`CodeCompte`, `MailCompte`, `PasswordCompte`, `Username`) VALUES
(1, 'key@gmail.com', 'admin', 'Michael'),
(2, 'espoir@gmail.com', 'admin', 'Esb');

-- --------------------------------------------------------

--
-- Structure de la table `t_fournisseur`
--

CREATE TABLE `t_fournisseur` (
  `CodeFournisseur` int(11) NOT NULL,
  `NomFournisseur` varchar(50) NOT NULL,
  `AdresseFournisseur` text NOT NULL,
  `TelephoneFournisseur` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_fournisseur`
--

INSERT INTO `t_fournisseur` (`CodeFournisseur`, `NomFournisseur`, `AdresseFournisseur`, `TelephoneFournisseur`) VALUES
(1, 'PHARMAKINA', 'KIN', '0977553723'),
(2, 'PHARMACIE DE L\'ESPOIR', 'GOMA', '0977665544'),
(3, 'HOPITAL GENERAL DE GOMA', 'GOMA/RDC', '09776655844');

-- --------------------------------------------------------

--
-- Structure de la table `t_produit`
--

CREATE TABLE `t_produit` (
  `CodeProduit` int(11) NOT NULL,
  `DesignationProduit` varchar(255) NOT NULL,
  `DetailProduit` text NOT NULL,
  `PhotoProduit` text NOT NULL,
  `PVProduit` decimal(10,2) NOT NULL,
  `CodeCategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_produit`
--

INSERT INTO `t_produit` (`CodeProduit`, `DesignationProduit`, `DetailProduit`, `PhotoProduit`, `PVProduit`, `CodeCategorie`) VALUES
(10, 'ASPIRINE', 'Medicament qu\'on a deja interdit', 'photomedicament/ASPIRINE.jpg', '15.00', 1),
(11, 'METAZOLE', 'Medicament qui soigne le', 'photomedicament/METAZOLE.jpg', '13.00', 3),
(12, 'MEBENDAZOLE', 'Soigne les blessure', 'photomedicament/téléchargement.jpg', '17.00', 3),
(13, 'PARACETAMOLE', 'maux de tete', 'photomedicament/paracet.jpg', '20.00', 3),
(14, '72 HEURES', 'Evite les grossesses non desiree', 'photomedicament/72H.jpg', '30.00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_service`
--

CREATE TABLE `t_service` (
  `CodeService` int(11) NOT NULL,
  `DesignationService` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_service`
--

INSERT INTO `t_service` (`CodeService`, `DesignationService`) VALUES
(1, 'Reception'),
(2, 'Pediatrie'),
(3, 'Maternite'),
(4, 'Churirgie');

-- --------------------------------------------------------

--
-- Structure de la table `t_vente`
--

CREATE TABLE `t_vente` (
  `CodeVente` int(11) NOT NULL,
  `CodeProduit` int(11) NOT NULL,
  `CodeClient` int(11) NOT NULL,
  `DateVente` date NOT NULL,
  `Quantitevendue` int(11) NOT NULL,
  `PrixUnitaire` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_approvisionnement`
--
ALTER TABLE `t_approvisionnement`
  ADD PRIMARY KEY (`CodeApprovisionnement`),
  ADD KEY `fk_approvisionnement_produit` (`CodeProduit`),
  ADD KEY `fk_approvisionnement_fournisseur` (`CodeFournisseur`);

--
-- Index pour la table `t_categorieproduit`
--
ALTER TABLE `t_categorieproduit`
  ADD PRIMARY KEY (`CodeCategorie`);

--
-- Index pour la table `t_client`
--
ALTER TABLE `t_client`
  ADD PRIMARY KEY (`CodeClient`);

--
-- Index pour la table `t_commande`
--
ALTER TABLE `t_commande`
  ADD PRIMARY KEY (`CodeCommande`),
  ADD KEY `fk_service_commande` (`CodeService`),
  ADD KEY `fk_commande_produit` (`CodeProduit`);

--
-- Index pour la table `t_compte`
--
ALTER TABLE `t_compte`
  ADD PRIMARY KEY (`CodeCompte`);

--
-- Index pour la table `t_fournisseur`
--
ALTER TABLE `t_fournisseur`
  ADD PRIMARY KEY (`CodeFournisseur`);

--
-- Index pour la table `t_produit`
--
ALTER TABLE `t_produit`
  ADD PRIMARY KEY (`CodeProduit`),
  ADD KEY `fk_produit_categorie` (`CodeCategorie`);

--
-- Index pour la table `t_service`
--
ALTER TABLE `t_service`
  ADD PRIMARY KEY (`CodeService`);

--
-- Index pour la table `t_vente`
--
ALTER TABLE `t_vente`
  ADD PRIMARY KEY (`CodeVente`),
  ADD KEY `fk_vente_produit` (`CodeProduit`),
  ADD KEY `fk_vente_client` (`CodeClient`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_approvisionnement`
--
ALTER TABLE `t_approvisionnement`
  MODIFY `CodeApprovisionnement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `t_categorieproduit`
--
ALTER TABLE `t_categorieproduit`
  MODIFY `CodeCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_client`
--
ALTER TABLE `t_client`
  MODIFY `CodeClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_commande`
--
ALTER TABLE `t_commande`
  MODIFY `CodeCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `t_compte`
--
ALTER TABLE `t_compte`
  MODIFY `CodeCompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_fournisseur`
--
ALTER TABLE `t_fournisseur`
  MODIFY `CodeFournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_produit`
--
ALTER TABLE `t_produit`
  MODIFY `CodeProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `t_service`
--
ALTER TABLE `t_service`
  MODIFY `CodeService` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_vente`
--
ALTER TABLE `t_vente`
  MODIFY `CodeVente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_approvisionnement`
--
ALTER TABLE `t_approvisionnement`
  ADD CONSTRAINT `fk_approvisionnement_fournisseur` FOREIGN KEY (`CodeFournisseur`) REFERENCES `t_fournisseur` (`CodeFournisseur`),
  ADD CONSTRAINT `fk_approvisionnement_produit` FOREIGN KEY (`CodeProduit`) REFERENCES `t_produit` (`CodeProduit`);

--
-- Contraintes pour la table `t_commande`
--
ALTER TABLE `t_commande`
  ADD CONSTRAINT `fk_commande_produit` FOREIGN KEY (`CodeProduit`) REFERENCES `t_produit` (`CodeProduit`),
  ADD CONSTRAINT `fk_service_commande` FOREIGN KEY (`CodeService`) REFERENCES `t_service` (`CodeService`);

--
-- Contraintes pour la table `t_produit`
--
ALTER TABLE `t_produit`
  ADD CONSTRAINT `fk_produit_categorie` FOREIGN KEY (`CodeCategorie`) REFERENCES `t_categorieproduit` (`CodeCategorie`);

--
-- Contraintes pour la table `t_vente`
--
ALTER TABLE `t_vente`
  ADD CONSTRAINT `fk_vente_client` FOREIGN KEY (`CodeClient`) REFERENCES `t_client` (`CodeClient`),
  ADD CONSTRAINT `fk_vente_produit` FOREIGN KEY (`CodeProduit`) REFERENCES `t_produit` (`CodeProduit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
