-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 07 déc. 2021 à 08:29
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_mdf`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `proc_Decliner_Project`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_Decliner_Project` (IN `id_project_` INT, IN `justifie` TEXT)  NO SQL
BEGIN
UPDATE tbl_projet SET justification = justifie WHERE id_projet = id_project_;
END$$

DROP PROCEDURE IF EXISTS `proc_insertAffectation`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertAffectation` (IN `id_etape_` INT, IN `id_user_` INT, IN `userEvent` VARCHAR(50), IN `eventAffectation` VARCHAR(50), IN `id_affectation_` INT)  NO SQL
BEGIN
IF(eventAffectation = 'CREATE_AFFECTATION') THEN
INSERT INTO tbl_affectation (`code_etape`, `code_user`, `statut_affectation`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutAffectationEvent`) VALUES (id_etape_,id_user_,1,userEvent,Now(),'-', null,'-', null,eventAffectation);
ELSEIF(eventAffectation = 'DEMAND_AFFECTATION') THEN
INSERT INTO tbl_affectation (`code_etape`, `code_user`, `statut_affectation`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutAffectationEvent`) VALUES (id_etape_,id_user_,0,userEvent,Now(),'-', null,'-', null,eventAffectation);
ELSEIF(eventAffectation = 'ACCEPT_AFFECTATION') THEN
UPDATE tbl_affectation SET statut_affectation = 1, statutAffectationEvent = eventAffectation  WHERE id_affectation = id_affectation_;
END IF;
END$$

DROP PROCEDURE IF EXISTS `proc_insertAgent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertAgent` (IN `id_agent_` INT, IN `nom_agent` VARCHAR(50), IN `postnom_agent` VARCHAR(50), IN `prenom_agent` VARCHAR(50), IN `sexe_agent` VARCHAR(50), IN `email_agent` VARCHAR(50), IN `code_fonction` INT, IN `userEvent` VARCHAR(50), IN `eventAgent` VARCHAR(50))  NO SQL
BEGIN 
    IF NOT EXISTS (SELECT id_agent FROM tbl_agent WHERE id_agent = id_agent_)THEN
      INSERT INTO tbl_agent ( nom_agent,postnom_agent,prenom_agent,sexe_agent,email_agent, code_fonction, addBy ,  dateAdd,editBy, dateEdit,deleteBy, deleteDate, statutAgent) VALUES ( nom_agent, postnom_agent, prenom_agent, sexe_agent, email_agent,code_fonction, userEvent,  CURRENT_DATE(),'-', null,'-', null,eventAgent);
    ELSEIF EXISTS (SELECT id_agent FROM tbl_agent WHERE id_agent = id_agent_) AND (eventAgent = 'EDIT_AGENT') THEN
    UPDATE tbl_agent SET nom_agent = nom_agent,postnom_agent = postnom_agent, prenom_agent = prenom_agent, email_agent = email_agent, sexe_agent = sexe_agent, code_fonction = code_fonction, editBy = userEvent,  dateEdit = CURRENT_DATE(), statutAgent = eventAgent WHERE id_agent = id_agent_;
    
    ELSEIF EXISTS (SELECT id_agent FROM tbl_agent WHERE id_agent = id_agent_) AND (eventAgent = 'DELETE_AGENT') THEN
    
    UPDATE tbl_agent SET  deleteBy = userEvent,  deleteDate = CURRENT_DATE(), statutAgent = eventAgent WHERE id_agent = id_agent_;
  
  
    END IF;
    
END$$

DROP PROCEDURE IF EXISTS `proc_insertFonction`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertFonction` (IN `id_fonction_` INT, IN `designation_fonction` VARCHAR(50), IN `userEvent` VARCHAR(50), IN `eventFonction` VARCHAR(50))  NO SQL
BEGIN 
    IF (eventFonction = 'CREATE_FONCTION')THEN
      INSERT INTO tbl_fonction ( designation_fonction, addBy ,  dateAdd,editBy, dateEdit,deleteBy,deleteDate ,statutFonction) VALUES ( designation_fonction, userEvent,  CURRENT_DATE(),'-', null,'-', null,eventFonction);
    ELSEIF(eventFonction = 'EDIT_FONCTION') THEN
    UPDATE tbl_fonction SET designation_fonction = designation_fonction, editBy = userEvent,  dateEdit = CURRENT_DATE(), statutFonction = eventFonction WHERE id_fonction = id_fonction_;
    ELSEIF(eventFonction = 'DELETE_FONCTION') THEN
    
    UPDATE tbl_fonction SET  deleteBy = userEvent,  deleteDate = CURRENT_DATE(), statutFonction = eventFonction WHERE id_fonction = id_fonction_;
  
    END IF;
    
END$$

DROP PROCEDURE IF EXISTS `proc_insertPartenaire`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertPartenaire` (IN `id_partenaire_` INT, IN `partenaire` VARCHAR(50), IN `email_partenaire` VARCHAR(50), IN `userEvent` VARCHAR(50), IN `eventPartenaire` VARCHAR(50))  NO SQL
BEGIN 
    IF (eventPartenaire = 'CREATE_PARTENAIRE')THEN
      INSERT INTO tbl_partenaire ( partenaire, email_partenaire, addBy,  dateAdd,editBy, dateEdit,deleteBy, deleteDate,statutPartenaire) VALUES ( partenaire, email_partenaire,  userEvent,  CURRENT_DATE(),'-', null,'-', null,eventPartenaire);
    ELSEIF(eventPartenaire = 'EDIT_PARTENAIRE') THEN
    UPDATE tbl_partenaire SET partenaire = partenaire,email_partenaire = email_partenaire, editBy = userEvent,  dateEdit = CURRENT_DATE(), statutPartenaire = eventPartenaire WHERE id_partenaire = id_partenaire_;
    ELSEIF(eventPartenaire = 'DELETE_PARTENAIRE') THEN
    
    UPDATE tbl_partenaire SET  deleteBy = userEvent,  deleteDate = CURRENT_DATE(), statutPartenaire = eventPartenaire WHERE id_partenaire = id_partenaire_;
    
    
    END IF;
    
END$$

DROP PROCEDURE IF EXISTS `proc_insertPhase`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertPhase` (IN `id_phase_` INT, IN `designation_phase` VARCHAR(50), IN `userEvent` VARCHAR(50), IN `eventPhase` VARCHAR(50))  NO SQL
BEGIN 

    IF (eventPhase = 'CREATE_PHASE')THEN
      INSERT INTO tbl_phase ( designation_phase, addBy ,  dateAdd,editBy, dateEdit,deleteBy,deleteDate ,statutPhase) 		VALUES ( designation_phase, userEvent,  CURRENT_DATE(),'-', null,'-', null,eventPhase);
    ELSEIF(eventPhase = 'EDIT_PHASE') THEN
    UPDATE tbl_phase SET designation_phase = designation_phase, editBy = userEvent,  dateEdit = CURRENT_DATE(), statutPhase = eventPhase WHERE id_phase = id_phase_;
    ELSEIF(eventPhase = 'DELETE_PHASE') THEN
    
    UPDATE tbl_phase SET  deleteBy = userEvent,  deleteDate = CURRENT_DATE(), statutPhase = eventPhase WHERE id_phase = id_phase_;
  
    END IF;

    
END$$

DROP PROCEDURE IF EXISTS `proc_InsertProject`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_InsertProject` (IN `titre` VARCHAR(100), IN `bailleur` VARCHAR(100), IN `objectif` TEXT, IN `budget` DOUBLE, IN `localisation` VARCHAR(100), IN `userEvent` VARCHAR(50), IN `eventProject` VARCHAR(100), IN `deadline_` DATE, IN `fichier` TEXT)  NO SQL
BEGIN 
  IF (eventProject = 'CREATE_PROJECT')THEN
    
      INSERT INTO `tbl_projet`(`titre`, `bailleur`, `objectif`, `deadline`, `file`, `budget`, `localisation`, `statut_reussite`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutProjet`, `validation`) VALUES (titre, bailleur, objectif, deadline_,fichier, budget, localisation, 0, userEvent,  Now(),'-', null,'-', null,eventProject,0);
        END IF;

    
END$$

DROP PROCEDURE IF EXISTS `proc_InsertRapport`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_InsertRapport` (IN `text_info` TEXT, IN `fichier` TEXT, IN `code_affectation` INT, IN `userEvent` VARCHAR(50))  NO SQL
BEGIN
	INSERT INTO tbl_rapport(textInfo, fichier, code_affectation, addBy, dateAdd) VALUES(text_info,fichier,code_affectation,userEvent,Now());
END$$

DROP PROCEDURE IF EXISTS `proc_insertRapport_Complet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertRapport_Complet` (IN `textInfoComplet` TEXT, IN `code_rapport` INT, IN `userEvent` VARCHAR(50))  NO SQL
BEGIN
	INSERT INTO tbl_rapport_complet(textInfoComplet, code_rapport , addBy, dateAdd) VALUES(textInfoComplet,code_rapport,userEvent,Now());
END$$

DROP PROCEDURE IF EXISTS `proc_InsertUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_InsertUser` (IN `id_user` INT, IN `username` VARCHAR(50), IN `password` VARCHAR(50), IN `code_agent` INT, IN `code_partenaire` INT, IN `addBy` VARCHAR(50), IN `userEvent` VARCHAR(50), IN `eventUser` INT)  NO SQL
BEGIN 
    IF (eventUser = 'CREATE_USER')THEN
      INSERT INTO tbl_user ( username, password, code_agent, code_partenaire, addBy ,  dateAdd,editBy, dateEdit,deleteBy, deleteDate,statutUser) VALUES ( username, password, code_agent, code_partenaire, userEvent,  CURRENT_DATE(),'-', null,'-', null,eventUser);
    ELSEIF(eventUser = 'EDIT_USER') THEN
    UPDATE tbl_user SET username = username, password =password, code_agent = code_agent, code_partenaire = code_partenaire, editBy = userEvent,  dateEdit = CURRENT_DATE(), statutUser = eventUser WHERE id_user = id_user;
    ELSEIF(eventUser = 'DELETE_USER') THEN
    
    UPDATE tbl_user SET  deleteBy = userEvent,  deleteDate = CURRENT_DATE(), statutUser = eventUser WHERE id_user = id_user;
    END IF;
    
END$$

DROP PROCEDURE IF EXISTS `proc_Valider_Project`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_Valider_Project` (IN `id_project_` INT, IN `userEvent` VARCHAR(50))  NO SQL
BEGIN
DECLARE val1 int;
SET val1 = fun_code_user(id_project_);
	UPDATE tbl_projet SET validation = 1 WHERE id_projet = id_project_;
    INSERT INTO tbl_etape (code_projet, code_phase,statut_projet, addBy, dateAdd) VALUES (id_project_,1,'En cours', userEvent, Now());
INSERT INTO tbl_privilege ( code_user, code_projet, addBy, dateAdd, editBy, dateEdit, deleteBy, deleteDate) VALUES(val1,id_project_,userEvent,Now(),'-', null,'-', null);
END$$

--
-- Fonctions
--
DROP FUNCTION IF EXISTS `fun_code_user`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `fun_code_user` (`id` INT) RETURNS INT(11) NO SQL
BEGIN
DECLARE val1 int;
SET val1 = (SELECT code_user FROM tbl_projet WHERE id_projet = id);
RETURN val1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_affectation`
--

DROP TABLE IF EXISTS `tbl_affectation`;
CREATE TABLE IF NOT EXISTS `tbl_affectation` (
  `id_affectation` int(11) NOT NULL AUTO_INCREMENT,
  `code_etape` int(11) NOT NULL,
  `code_user` int(11) NOT NULL,
  `statut_affectation` int(11) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutAffectationEvent` varchar(50) NOT NULL,
  PRIMARY KEY (`id_affectation`),
  KEY `fk_code_etape` (`code_etape`),
  KEY `fk_code_use_affectation` (`code_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_agent`
--

DROP TABLE IF EXISTS `tbl_agent`;
CREATE TABLE IF NOT EXISTS `tbl_agent` (
  `id_agent` int(11) NOT NULL AUTO_INCREMENT,
  `nom_agent` varchar(100) NOT NULL,
  `postnom_agent` varchar(100) NOT NULL,
  `prenom_agent` varchar(100) NOT NULL,
  `sexe_agent` varchar(100) NOT NULL,
  `adresse_agent` text NOT NULL,
  `email_agent` varchar(100) NOT NULL,
  `code_fonction` int(11) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutAgent` varchar(50) NOT NULL,
  PRIMARY KEY (`id_agent`),
  UNIQUE KEY `un_mail` (`email_agent`),
  UNIQUE KEY `un_agent` (`nom_agent`,`postnom_agent`,`prenom_agent`),
  KEY `fk_code_fonction` (`code_fonction`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_agent`
--

INSERT INTO `tbl_agent` (`id_agent`, `nom_agent`, `postnom_agent`, `prenom_agent`, `sexe_agent`, `adresse_agent`, `email_agent`, `code_fonction`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutAgent`) VALUES
(2, 'Aketi', 'Kompani', 'Gabin', 'Masculin', '', 'gabin@gmail.com', 2, '1', '2021-12-04 00:00:00', '1', '2021-12-04 00:00:00', '13', '2021-12-05 00:00:00', 'DELETE_AGENT'),
(15, 'Shekinah', 'Malekani', 'Kavira', 'Feminin', '', 'shekinahmaleck@gmail.com', 3, '13', '2021-12-05 00:00:00', '-', NULL, '-', NULL, 'CREATE_AGENT'),
(16, 'Abio', 'Bamongoyo', 'Gaetan', 'Masculin', '', 'g.a.bamongoyo@gmail.com', 2, '13', '2021-12-05 00:00:00', '-', NULL, '-', NULL, 'CREATE_AGENT'),
(19, 'Espoir', 'Baraka', 'Bigega', 'Masculin', '', 'esbarakabigega@gmail.com', 2, '25', '2021-12-05 00:00:00', '-', NULL, '-', NULL, 'CREATE_AGENT'),
(21, 'Siwa', 'Mumbere', 'Carin', 'Masculin', '', 'siwamumberecarin1998@gmail.com', 3, '26', '2021-12-05 00:00:00', '-', NULL, '-', NULL, 'CREATE_AGENT');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_detailprojet`
--

DROP TABLE IF EXISTS `tbl_detailprojet`;
CREATE TABLE IF NOT EXISTS `tbl_detailprojet` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `etape` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `code_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `fk_code_projet_detail` (`code_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_etape`
--

DROP TABLE IF EXISTS `tbl_etape`;
CREATE TABLE IF NOT EXISTS `tbl_etape` (
  `id_etape` int(11) NOT NULL AUTO_INCREMENT,
  `code_projet` int(11) NOT NULL,
  `code_phase` int(11) NOT NULL,
  `statut_projet` varchar(100) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` datetime NOT NULL,
  PRIMARY KEY (`id_etape`),
  KEY `fk_code_projet` (`code_projet`),
  KEY `fk_code_phase` (`code_phase`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_etape`
--

INSERT INTO `tbl_etape` (`id_etape`, `code_projet`, `code_phase`, `statut_projet`, `addBy`, `dateAdd`) VALUES
(5, 1, 1, '1', '26', '2021-12-05 15:27:29');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_fonction`
--

DROP TABLE IF EXISTS `tbl_fonction`;
CREATE TABLE IF NOT EXISTS `tbl_fonction` (
  `id_fonction` int(11) NOT NULL AUTO_INCREMENT,
  `designation_fonction` varchar(100) NOT NULL,
  `addBy` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `editBy` int(11) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` int(11) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutFonction` varchar(50) NOT NULL,
  PRIMARY KEY (`id_fonction`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_fonction`
--

INSERT INTO `tbl_fonction` (`id_fonction`, `designation_fonction`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutFonction`) VALUES
(2, 'BD Manager', 25, '2021-12-04 00:00:00', 21, '2021-12-05 00:00:00', 0, NULL, 'EDIT_FONCTION'),
(3, 'Trainer/consultant', 25, '2021-12-04 00:00:00', 21, '2021-12-05 00:00:00', 0, NULL, 'EDIT_FONCTION');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_partenaire`
--

DROP TABLE IF EXISTS `tbl_partenaire`;
CREATE TABLE IF NOT EXISTS `tbl_partenaire` (
  `id_partenaire` int(11) NOT NULL AUTO_INCREMENT,
  `partenaire` varchar(100) NOT NULL,
  `email_partenaire` varchar(100) NOT NULL,
  `telephone_partenaire` varchar(15) NOT NULL,
  `adresse_partenaire` varchar(255) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutPartenaire` varchar(50) NOT NULL,
  PRIMARY KEY (`id_partenaire`),
  UNIQUE KEY `un_mail_partenaire` (`email_partenaire`),
  UNIQUE KEY `un_partenaire` (`partenaire`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_partenaire`
--

INSERT INTO `tbl_partenaire` (`id_partenaire`, `partenaire`, `email_partenaire`, `telephone_partenaire`, `adresse_partenaire`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutPartenaire`) VALUES
(1, 'UNHCR', 'hcr@un.org', '', '', 'Carin', '2021-12-03 00:00:00', '1', '2021-12-04 00:00:00', '1', '2021-12-04 00:00:00', 'DELETE_PARTENAIRE'),
(2, 'OMS', 'oms@projet.org', '', '', '1', '2021-12-04 00:00:00', '-', NULL, '1', '2021-12-04 00:00:00', 'DELETE_PARTENAIRE'),
(3, 'CDPE', 'cdpe.gaetan@gmail.org', '', '', '1', '2021-12-04 00:00:00', '-', NULL, '-', NULL, 'CREATE_PARTENAIRE');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_phase`
--

DROP TABLE IF EXISTS `tbl_phase`;
CREATE TABLE IF NOT EXISTS `tbl_phase` (
  `id_phase` int(11) NOT NULL AUTO_INCREMENT,
  `designation_phase` varchar(100) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutPhase` varchar(50) NOT NULL,
  PRIMARY KEY (`id_phase`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_phase`
--

INSERT INTO `tbl_phase` (`id_phase`, `designation_phase`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutPhase`) VALUES
(1, 'Proposition', '1', '2021-12-04 00:00:00', '1', '2021-12-04 00:00:00', '-', NULL, 'EDIT_PHASE'),
(2, 'Preparation', '1', '2021-12-04 00:00:00', '-', NULL, '-', NULL, 'CREATE_PHASE');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_privilege`
--

DROP TABLE IF EXISTS `tbl_privilege`;
CREATE TABLE IF NOT EXISTS `tbl_privilege` (
  `id_privilege` int(11) NOT NULL AUTO_INCREMENT,
  `code_user` int(11) NOT NULL,
  `code_projet` int(11) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id_privilege`),
  KEY `fk_code_user_privilege` (`code_user`),
  KEY `fk_code_projet_privilege` (`code_projet`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_privilege`
--

INSERT INTO `tbl_privilege` (`id_privilege`, `code_user`, `code_projet`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`) VALUES
(2, 26, 1, '26', '2021-12-05 15:27:29', '-', NULL, '-', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_projet`
--

DROP TABLE IF EXISTS `tbl_projet`;
CREATE TABLE IF NOT EXISTS `tbl_projet` (
  `id_projet` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `bailleur` varchar(100) NOT NULL,
  `objectif` text NOT NULL,
  `deadline` datetime NOT NULL,
  `file` text NOT NULL,
  `budget` double NOT NULL,
  `localisation` varchar(100) NOT NULL,
  `statut_reussite` varchar(100) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutProjet` varchar(50) NOT NULL,
  `validation` int(11) NOT NULL,
  `code_user` int(11) NOT NULL,
  `justification` text,
  PRIMARY KEY (`id_projet`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_projet`
--

INSERT INTO `tbl_projet` (`id_projet`, `titre`, `bailleur`, `objectif`, `deadline`, `file`, `budget`, `localisation`, `statut_reussite`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutProjet`, `validation`, `code_user`, `justification`) VALUES
(1, 'Enfant de la rue', 'f', '<p>vcvcv<br></p>', '0000-00-00 00:00:00', 'Main.java', 100, 'ffff', '0', '26', '2021-12-05 14:21:01', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1, 26, NULL),
(3, 'JJJ', 'FDD', '<p>33<br></p>', '2021-12-15 00:00:00', 'cnss.sql', 3, '3', '0', '26', '2021-12-05 15:37:42', '-', NULL, '-', NULL, 'CREATE_PROJECT', 0, 0, NULL),
(4, 'HH', 'HH', '<p>HHH<br></p>', '2021-12-17 00:00:00', 'Euge_TFC&.pdf', 5, 'HH', '0', '26', '2021-12-05 15:44:37', '-', NULL, '-', NULL, 'CREATE_PROJECT', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_rapport`
--

DROP TABLE IF EXISTS `tbl_rapport`;
CREATE TABLE IF NOT EXISTS `tbl_rapport` (
  `id_rapport` int(11) NOT NULL,
  `textInfo` text NOT NULL,
  `fichier` text NOT NULL,
  `code_affectation` int(11) NOT NULL,
  `addBy` varchar(50) NOT NULL,
  `dateAdd` datetime NOT NULL,
  KEY `fk_Rapport_aff` (`code_affectation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_rapport_complet`
--

DROP TABLE IF EXISTS `tbl_rapport_complet`;
CREATE TABLE IF NOT EXISTS `tbl_rapport_complet` (
  `id_Rapport_c` int(11) NOT NULL,
  `textInfoComplet` text NOT NULL,
  `code_rapport` int(11) NOT NULL,
  `addBy` varchar(50) NOT NULL,
  `dateAdd` datetime NOT NULL,
  KEY `fk_Rapport_Cpmplet` (`code_rapport`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_telephone`
--

DROP TABLE IF EXISTS `tbl_telephone`;
CREATE TABLE IF NOT EXISTS `tbl_telephone` (
  `id_telephone` int(11) NOT NULL AUTO_INCREMENT,
  `num_telephone` varchar(15) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `code_agent` int(11) NOT NULL,
  PRIMARY KEY (`id_telephone`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_telephone`
--

INSERT INTO `tbl_telephone` (`id_telephone`, `num_telephone`, `created_on`, `created_by`, `code_agent`) VALUES
(1, '+243 977 553 72', '2021-12-04 11:50:07', 1, 1),
(2, '0817675404', '2021-12-04 12:52:28', 1, 1),
(3, '+243991900843', '2021-12-04 13:03:43', 1, 1),
(4, '+2439977553723', '2021-12-04 13:03:50', 1, 1),
(5, '+24399775537231', '2021-12-04 13:04:07', 1, 1),
(6, '+243 988 678 34', '2021-12-04 13:09:56', 1, 3),
(7, '+24399775537231', '2021-12-04 13:10:42', 1, 3),
(8, '+243 977 655 76', '2021-12-04 13:22:15', 1, 6),
(9, '+2439977553723', '2021-12-04 21:08:11', 13, 9),
(10, '+2439977553723', '2021-12-05 08:40:42', 26, 19);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `photo` text NOT NULL,
  `code_agent` int(11) DEFAULT NULL,
  `code_partenaire` int(11) DEFAULT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutUser` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `un_user` (`email`),
  KEY `fk_code_agent` (`code_agent`),
  KEY `fk_code_partenaire` (`code_partenaire`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `email`, `password`, `photo`, `code_agent`, `code_partenaire`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutUser`) VALUES
(18, 'shekinah', 'shekinahmaleck@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 15, NULL, '', '2021-12-05 06:57:40', NULL, NULL, NULL, NULL, '1'),
(25, 'Gaetan', 'g.a.bamongoyo@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 16, NULL, '', '2021-12-05 07:36:59', NULL, NULL, NULL, NULL, '1'),
(26, 'Espoir', 'esbarakabigega@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 19, NULL, '', '2021-12-05 08:39:22', NULL, NULL, NULL, NULL, '1'),
(27, 'Siwa', 'siwamumberecarin1998@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 21, NULL, '', '2021-12-05 08:43:12', NULL, NULL, NULL, NULL, '1'),
(28, 'cdpe', 'cdpe.gaetan@gmail.org', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', NULL, 3, '', '2021-12-05 09:05:35', NULL, NULL, NULL, NULL, '2');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tbl_affectation`
--
ALTER TABLE `tbl_affectation`
  ADD CONSTRAINT `fk_code_etape` FOREIGN KEY (`code_etape`) REFERENCES `tbl_etape` (`id_etape`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_code_use_affectation` FOREIGN KEY (`code_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  ADD CONSTRAINT `fk_code_fonction` FOREIGN KEY (`code_fonction`) REFERENCES `tbl_fonction` (`id_fonction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tbl_detailprojet`
--
ALTER TABLE `tbl_detailprojet`
  ADD CONSTRAINT `fk_code_projet_detail` FOREIGN KEY (`code_projet`) REFERENCES `tbl_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tbl_etape`
--
ALTER TABLE `tbl_etape`
  ADD CONSTRAINT `fk_code_phase` FOREIGN KEY (`code_phase`) REFERENCES `tbl_phase` (`id_phase`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_code_projet` FOREIGN KEY (`code_projet`) REFERENCES `tbl_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tbl_privilege`
--
ALTER TABLE `tbl_privilege`
  ADD CONSTRAINT `fk_code_projet_privilege` FOREIGN KEY (`code_projet`) REFERENCES `tbl_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_code_user_privilege` FOREIGN KEY (`code_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `fk_code_agent` FOREIGN KEY (`code_agent`) REFERENCES `tbl_agent` (`id_agent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_code_partenaire` FOREIGN KEY (`code_partenaire`) REFERENCES `tbl_partenaire` (`id_partenaire`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
