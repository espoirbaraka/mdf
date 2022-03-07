-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 09:46 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdf`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertAffectation` (IN `id_etape_` INT, IN `id_user_` INT, IN `userEvent` VARCHAR(50), IN `eventAffectation` VARCHAR(50), IN `id_affectation_` INT)  NO SQL
BEGIN
IF(eventAffectation = 'CREATE_AFFECTATION') THEN
INSERT INTO tbl_affectation (code_etape, code_user, statut_affectation, addBy, dateAdd, editBy, dateEdit, deleteBy, deleteDate, statutAffectationEvent) VALUES (id_etape_,id_user_,1,userEvent,Now(),'-', null,'-', null,eventAffectation);
ELSEIF(eventAffectation = 'DEMAND_AFFECTATION') THEN
INSERT INTO tbl_affectation (code_etape, code_user, statut_affectation, addBy, dateAdd, editBy, dateEdit, deleteBy, deleteDate, statutAffectationEvent) VALUES (id_etape_,id_user_,0,userEvent,Now(),'-', null,'-', null,eventAffectation);
ELSEIF(eventAffectation = 'ACCEPT_AFFECTATION') THEN
UPDATE tbl_affectation SET statut_affectation = 1, statutAffectationEvent = eventAffectation  WHERE id_affectation = id_affectation_;
END IF;
END$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_InsertProject` (IN `titre` VARCHAR(100), IN `bailleur` VARCHAR(100), IN `objectif` TEXT, IN `budget` DOUBLE, IN `localisation` VARCHAR(100), IN `userEvent` VARCHAR(50), IN `eventProject` VARCHAR(100), IN `deadline_` DATE, IN `fichier` TEXT)  NO SQL
BEGIN 
  IF (eventProject = 'CREATE_PROJECT')THEN
    
      INSERT INTO `tbl_projet`(`titre`, `bailleur`, `objectif`, `deadline`, `file`, `budget`, `localisation`, `statut_reussite`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutProjet`, `validation`) VALUES (titre, bailleur, objectif, deadline_,fichier, budget, localisation, 0, userEvent,  Now(),'-', null,'-', null,eventProject,0);
        END IF;

    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_InsertRapport` (IN `text_info` TEXT, IN `fichier` TEXT, IN `code_affectation` INT, IN `userEvent` VARCHAR(50))  NO SQL
BEGIN
	INSERT INTO tbl_rapport(textInfo, fichier, code_affectation, addBy, dateAdd) VALUES(text_info,fichier,code_affectation,userEvent,Now());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertRapport_Complet` (IN `textInfoComplet` TEXT, IN `code_rapport` INT, IN `userEvent` VARCHAR(50))  NO SQL
BEGIN
	INSERT INTO tbl_rapport_complet(textInfoComplet, code_rapport , addBy, dateAdd) VALUES(textInfoComplet,code_rapport,userEvent,Now());
END$$

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

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_affectation`
--

CREATE TABLE `tbl_affectation` (
  `id_affectation` int(11) NOT NULL,
  `code_etape` int(11) NOT NULL,
  `code_user` int(11) NOT NULL,
  `statut_affectation` int(11) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutAffectationEvent` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_affectation`
--

INSERT INTO `tbl_affectation` (`id_affectation`, `code_etape`, `code_user`, `statut_affectation`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutAffectationEvent`) VALUES
(1, 6, 25, 1, '25', '2021-12-06 12:14:09', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(2, 6, 26, 0, '26', '2021-12-06 12:14:53', '-', NULL, '-', NULL, 'DEMAND_AFFECTATION'),
(3, 12, 26, 1, '26', '2021-12-06 15:08:32', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(4, 9, 27, 1, '27', '2021-12-06 16:55:19', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(5, 9, 29, 1, '29', '2021-12-06 16:56:04', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(6, 7, 26, 1, '26', '2021-12-06 16:57:30', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(7, 9, 18, 1, '18', '2021-12-06 16:57:42', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(8, 7, 18, 1, '18', '2021-12-06 17:33:56', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(9, 11, 18, 1, '18', '2021-12-06 17:34:19', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(10, 8, 27, 1, '27', '2021-12-06 17:36:50', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(11, 7, 26, 1, '26', '2021-12-06 20:30:16', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(12, 6, 27, 0, '27', '2021-12-06 20:34:00', '-', NULL, '-', NULL, 'DEMAND_AFFECTATION'),
(13, 3, 27, 0, '27', '2021-12-06 20:36:54', '-', NULL, '-', NULL, 'DEMAND_AFFECTATION');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agent`
--

CREATE TABLE `tbl_agent` (
  `id_agent` int(11) NOT NULL,
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
  `statutAgent` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_agent`
--

INSERT INTO `tbl_agent` (`id_agent`, `nom_agent`, `postnom_agent`, `prenom_agent`, `sexe_agent`, `adresse_agent`, `email_agent`, `code_fonction`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutAgent`) VALUES
(15, 'Shekinah', 'Malekani', 'Kavira', 'Feminin', '', 'shekinahmaleck@gmail.com', 3, '13', '2021-12-05 00:00:00', '-', NULL, '-', NULL, 'CREATE_AGENT'),
(16, 'Abio', 'Bamongoyo', 'Gaetan', 'Masculin', '', 'g.a.bamongoyo@gmail.com', 2, '13', '2021-12-05 00:00:00', '-', NULL, '-', NULL, 'CREATE_AGENT'),
(19, 'Espoir', 'Baraka', 'Bigega', 'Masculin', '', 'esbarakabigega@gmail.com', 2, '25', '2021-12-05 00:00:00', '-', NULL, '-', NULL, 'CREATE_AGENT'),
(21, 'Siwa', 'Mumbere', 'Carin', 'Masculin', '', 'siwamumberecarin1998@gmail.com', 3, '26', '2021-12-05 00:00:00', '-', NULL, '-', NULL, 'CREATE_AGENT'),
(22, 'Aketi', 'Kompani', 'Gabin', 'Masculin', '', 'gabin@gmail.com', 3, '26', '2021-12-05 00:00:00', '-', NULL, '-', NULL, 'CREATE_AGENT'),
(23, 'Muderhwa', 'Safari', 'Andre', 'Masculin', '', 'safariandre66@gmail.com', 3, '25', '2021-12-06 00:00:00', '-', NULL, '-', NULL, 'CREATE_AGENT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detailprojet`
--

CREATE TABLE `tbl_detailprojet` (
  `id_detail` int(11) NOT NULL,
  `etape` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `code_projet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_etape`
--

CREATE TABLE `tbl_etape` (
  `id_etape` int(11) NOT NULL,
  `code_projet` int(11) NOT NULL,
  `code_phase` int(11) NOT NULL,
  `statut_projet` varchar(100) NOT NULL,
  `addBy` int(11) NOT NULL DEFAULT current_timestamp(),
  `dateAdd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_etape`
--

INSERT INTO `tbl_etape` (`id_etape`, `code_projet`, `code_phase`, `statut_projet`, `addBy`, `dateAdd`) VALUES
(3, 10, 1, '1', 0, '0000-00-00 00:00:00'),
(4, 11, 1, '1', 0, '0000-00-00 00:00:00'),
(5, 12, 1, '1', 0, '0000-00-00 00:00:00'),
(6, 13, 1, '1', 0, '0000-00-00 00:00:00'),
(7, 14, 1, '1', 0, '0000-00-00 00:00:00'),
(8, 15, 1, '1', 0, '0000-00-00 00:00:00'),
(9, 16, 1, '1', 0, '0000-00-00 00:00:00'),
(10, 17, 1, '1', 0, '0000-00-00 00:00:00'),
(11, 18, 1, '1', 0, '0000-00-00 00:00:00'),
(12, 19, 1, '1', 0, '0000-00-00 00:00:00'),
(13, 20, 1, '0', 26, '0000-00-00 00:00:00'),
(17, 20, 2, '0', 2147483647, '0000-00-00 00:00:00'),
(18, 20, 1, '0', 2147483647, '0000-00-00 00:00:00'),
(19, 20, 2, '0', 2147483647, '0000-00-00 00:00:00'),
(20, 20, 1, '0', 2147483647, '0000-00-00 00:00:00'),
(21, 20, 3, '0', 2147483647, '0000-00-00 00:00:00'),
(22, 20, 3, '0', 2147483647, '0000-00-00 00:00:00'),
(23, 20, 2, '0', 2147483647, '0000-00-00 00:00:00'),
(24, 20, 1, '0', 2147483647, '0000-00-00 00:00:00'),
(25, 20, 3, '1', 2147483647, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fichier`
--

CREATE TABLE `tbl_fichier` (
  `id_fichier` int(11) NOT NULL,
  `detail_fichier` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fichier` text NOT NULL,
  `code_projet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_fichier`
--

INSERT INTO `tbl_fichier` (`id_fichier`, `detail_fichier`, `created_on`, `fichier`, `code_projet`) VALUES
(1, 'Contacts', '2021-12-06 19:43:22', 'contacts.vcf', 16),
(2, 'Contact2', '2021-12-06 19:45:17', 'contacts.csv', 16),
(3, 'Tp de Deborah', '2021-12-06 19:49:08', 'DEBORAH TP.docx', 16),
(4, 'Language MYSQL', '2021-12-06 20:07:50', 'administrez-vos-bases-de-donnees-avec-mysql.pdf', 16),
(5, 'Logo de l\'isig', '2021-12-06 20:23:29', '1526095425.jpg', 18),
(6, 'mon cv', '2021-12-07 06:47:27', 'KAVIRA MALEKANI Shekinah.doc', 10),
(7, 'Budget', '2021-12-07 07:29:55', 'reseau des neurones convolutifs.pdf', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fonction`
--

CREATE TABLE `tbl_fonction` (
  `id_fonction` int(11) NOT NULL,
  `designation_fonction` varchar(100) NOT NULL,
  `addBy` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `editBy` int(11) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` int(11) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutFonction` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_fonction`
--

INSERT INTO `tbl_fonction` (`id_fonction`, `designation_fonction`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutFonction`) VALUES
(2, 'BD Manager', 25, '2021-12-04 00:00:00', 21, '2021-12-05 00:00:00', 0, NULL, 'EDIT_FONCTION'),
(3, 'Trainer/consultant', 25, '2021-12-04 00:00:00', 21, '2021-12-05 00:00:00', 0, NULL, 'EDIT_FONCTION');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partenaire`
--

CREATE TABLE `tbl_partenaire` (
  `id_partenaire` int(11) NOT NULL,
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
  `statutPartenaire` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_partenaire`
--

INSERT INTO `tbl_partenaire` (`id_partenaire`, `partenaire`, `email_partenaire`, `telephone_partenaire`, `adresse_partenaire`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutPartenaire`) VALUES
(1, 'UNHCR', 'hcr@un.org', '', '', 'Carin', '2021-12-03 00:00:00', '1', '2021-12-04 00:00:00', '1', '2021-12-04 00:00:00', 'DELETE_PARTENAIRE'),
(2, 'OMS', 'oms@projet.org', '', '', '1', '2021-12-04 00:00:00', '-', NULL, '1', '2021-12-04 00:00:00', 'DELETE_PARTENAIRE'),
(3, 'CDPE', 'cdpe.gaetan@gmail.org', '', '', '1', '2021-12-04 00:00:00', '-', NULL, '-', NULL, 'CREATE_PARTENAIRE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phase`
--

CREATE TABLE `tbl_phase` (
  `id_phase` int(11) NOT NULL,
  `designation_phase` varchar(100) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutPhase` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_phase`
--

INSERT INTO `tbl_phase` (`id_phase`, `designation_phase`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutPhase`) VALUES
(1, 'Proposition', '1', '2021-12-04 00:00:00', '1', '2021-12-04 00:00:00', '-', NULL, 'EDIT_PHASE'),
(2, 'Preparation', '1', '2021-12-04 00:00:00', '-', NULL, '-', NULL, 'CREATE_PHASE'),
(3, 'Execution', '26', '2021-12-07 00:00:00', '-', NULL, '-', NULL, 'CREATE_PHASE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_privilege`
--

CREATE TABLE `tbl_privilege` (
  `id_privilege` int(11) NOT NULL,
  `code_user` int(11) NOT NULL,
  `code_projet` int(11) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` timestamp NULL DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` timestamp NULL DEFAULT NULL,
  `statutPrivilege` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_privilege`
--

INSERT INTO `tbl_privilege` (`id_privilege`, `code_user`, `code_projet`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutPrivilege`) VALUES
(5, 18, 10, '26', '2021-12-06 13:21:21', NULL, NULL, NULL, NULL, '1'),
(6, 18, 11, '26', '2021-12-06 14:41:06', NULL, NULL, NULL, NULL, '1'),
(7, 29, 12, '25', '2021-12-06 14:41:06', NULL, NULL, NULL, NULL, '1'),
(8, 18, 13, '26', '2021-12-06 14:41:06', NULL, NULL, NULL, NULL, '1'),
(9, 27, 14, '26', '2021-12-06 14:41:06', NULL, NULL, NULL, NULL, '1'),
(10, 25, 15, '25', '2021-12-06 14:41:06', NULL, NULL, NULL, NULL, '1'),
(11, 26, 16, '26', '2021-12-06 14:41:06', NULL, NULL, NULL, NULL, '1'),
(12, 29, 17, '26', '2021-12-06 14:41:07', NULL, NULL, NULL, NULL, '1'),
(13, 26, 18, '26', '2021-12-06 14:41:07', NULL, NULL, NULL, NULL, '1'),
(14, 25, 19, '25', '2021-12-06 14:41:07', NULL, NULL, NULL, NULL, '1'),
(15, 26, 20, '26', '2021-12-07 07:22:03', NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projet`
--

CREATE TABLE `tbl_projet` (
  `id_projet` int(11) NOT NULL,
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
  `validation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_projet`
--

INSERT INTO `tbl_projet` (`id_projet`, `titre`, `bailleur`, `objectif`, `deadline`, `file`, `budget`, `localisation`, `statut_reussite`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutProjet`, `validation`) VALUES
(1, 'Enfant de la rue', 'f', '<p>vcvcv<br></p>', '0000-00-00 00:00:00', 'Main.java', 100, 'ffff', '0', '26', '2021-12-05 14:21:01', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(7, 'MSF-MWESO', 'MSF', '<p>HDHHHDHDHDHDHDHDHDHDHDHHDHDHDHDHHDHDHDHD<br></p>', '2021-12-29 00:00:00', 'CV JULIE.docx', 10000, 'Mweso', '0', '26', '2021-12-05 16:14:57', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(8, 'OXFAM-DISTRUBUTION D\'EAU', 'oxfam', 'Ce projet a pour objectif de couvrir le territoire en eau potable<br>', '2021-12-31 00:00:00', 'JULIEN PP.docx', 20000, 'Masisi', '0', '26', '2021-12-05 21:46:48', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(9, 'Paysans', 'CPDE', '<p>La realite</p>', '2021-12-29 00:00:00', 'Appel-à-manifestation-dintérêt-Facscies-Hackthon_.pdf', 1000, 'Mambasa', '0', '25', '2021-12-06 08:58:50', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(10, 'Recensement des enfants vivant dans les rues de la ville de Goma', 'UNICEF', '', '2021-12-25 00:00:00', 'KAVIRA MALEKANI Shekinah.doc', 100, 'RDC/nord-kivu/Goma/commune de Goma', '0', '18', '2021-12-06 09:34:26', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(11, 'Recensement des enfants vivant dans les rues de la ville de Bukavu', 'UN', '', '2021-12-17 00:00:00', 'KAVIRA MALEKANI Shekinah.doc', 20000000, 'RDC/nord-kivu/Bukavu', '0', '18', '2021-12-06 10:10:43', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(12, 'Evacuation immondices', 'WFP', '<p>BON<br></p>', '2021-12-23 00:00:00', '', 455, 'GOMA', '0', '29', '2021-12-06 10:46:46', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(13, 'epst', 'epst-rdc', '<p><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">ce projet a pour but de faire le recensement de tous les enseignants congolais</font></font></p>', '2021-11-12 00:00:00', 'KAVIRA MALEKANI Shekinah.doc', 9000, 'RDC/nord-kivu/Bukavu', '0', '18', '2021-12-06 12:00:46', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(14, 'Hackaton ISIG-MDF 2000', 'MDF/ISIG', 'Automatisation de MDF', '2021-12-09 00:00:00', '5pt2jhqu.csv', 2000, 'Nord-Kivu/Goma/Isig-Goma', '0', '27', '2021-12-06 12:08:21', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(15, 'Enfant orphelin', 'UNICEF', '<p>Prendre en charge</p>', '2021-12-30 00:00:00', 'Appel-à-manifestation-dintérêt-Facscies-Hackthon_.pdf', 10000, '', '0', '25', '2021-12-06 12:43:43', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(16, 'Distribution d\'eau dans la ville de goma', 'MERCY-CORPS', '<p><br></p>', '2021-12-14 00:00:00', '', 10000, 'GOMA', '0', '26', '2021-12-06 12:44:55', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(17, 'HEAL-AFRICA', 'HEAL-AFRICA', '<p><u><b>Sante de la popolation des villes</b></u></p><ol><li>Goma</li><li><u><b>Bukavu<br></b></u><br></li></ol>', '2021-12-16 00:00:00', '', 1000, 'GOMA', '0', '29', '2021-12-06 13:31:12', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(18, 'Hopital General', 'GOUVERNEMENT PROVINCIAL', '<p><b>Objectif</b></p><p><b>1. </b>Sante de la population<b><br></b><br></p>', '2021-12-14 00:00:00', '', 10000, 'Goma', '0', '26', '2021-12-06 13:34:53', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(19, 'Femme viole', 'UN', '<p>Humanite</p>', '2021-12-23 00:00:00', 'Appel-à-manifestation-dintérêt-Facscies-Hackthon_.pdf', 10000, '', '0', '25', '2021-12-06 14:04:06', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1),
(20, 'Kivu developpment', 'ISIG-GOMA', '<p>Voici l\'objectif du projet<br></p>', '2021-12-31 00:00:00', 'CV JULIE(1).docx', 10000, 'Goma', '0', '26', '2021-12-07 09:21:37', '-', NULL, '-', NULL, 'CREATE_PROJECT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rapport`
--

CREATE TABLE `tbl_rapport` (
  `id_rapport` int(11) NOT NULL,
  `textInfo` text NOT NULL,
  `fichier` text NOT NULL,
  `code_affectation` int(11) NOT NULL,
  `addBy` varchar(50) NOT NULL,
  `dateAdd` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rapport_complet`
--

CREATE TABLE `tbl_rapport_complet` (
  `id_Rapport_c` int(11) NOT NULL,
  `textInfoComplet` text NOT NULL,
  `code_rapport` int(11) NOT NULL,
  `addBy` varchar(50) NOT NULL,
  `dateAdd` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_telephone`
--

CREATE TABLE `tbl_telephone` (
  `id_telephone` int(11) NOT NULL,
  `num_telephone` varchar(15) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `code_agent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_telephone`
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
(10, '+2439977553723', '2021-12-05 08:40:42', 26, 19),
(11, '+243 977 655 76', '2021-12-06 12:26:16', 25, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `photo` text NOT NULL,
  `code_agent` int(11) DEFAULT NULL,
  `code_partenaire` int(11) DEFAULT NULL,
  `addBy` varchar(100) NOT NULL,
  `dateAdd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `editBy` varchar(50) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `deleteBy` varchar(50) DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  `statutUser` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `email`, `password`, `photo`, `code_agent`, `code_partenaire`, `addBy`, `dateAdd`, `editBy`, `dateEdit`, `deleteBy`, `deleteDate`, `statutUser`) VALUES
(18, 'shekinah', 'shekinahmaleck@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '03E60E43-0985-4229-9F01-C9B6E1BF9FC8_4_5005_c.jpeg', 15, NULL, '', '2021-12-07 06:44:07', NULL, NULL, NULL, NULL, '1'),
(25, 'Gaetan', 'g.a.bamongoyo@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'IMG_6030.JPG', 16, NULL, '', '2021-12-07 06:43:07', NULL, NULL, NULL, NULL, '1'),
(26, 'Espoir', 'esbarakabigega@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'IMG_20210107_182148819.jpg', 19, NULL, '', '2021-12-07 06:28:22', NULL, NULL, NULL, NULL, '1'),
(27, 'Siwa', 'siwamumberecarin1998@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '735C5CFF-1A82-40E8-AEC6-7CCFDFF13281L0001.jpeg', 21, NULL, '', '2021-12-07 07:36:29', NULL, NULL, NULL, NULL, '1'),
(28, 'cdpe', 'cdpe.gaetan@gmail.org', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', NULL, 3, '', '2021-12-05 09:05:35', NULL, NULL, NULL, NULL, '2'),
(29, 'Andre', 'safariandre66@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'scott1.png', 23, NULL, '', '2021-12-07 07:28:05', NULL, NULL, NULL, NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_affectation`
--
ALTER TABLE `tbl_affectation`
  ADD PRIMARY KEY (`id_affectation`),
  ADD KEY `fk_code_etape` (`code_etape`),
  ADD KEY `fk_code_use_affectation` (`code_user`);

--
-- Indexes for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  ADD PRIMARY KEY (`id_agent`),
  ADD UNIQUE KEY `un_mail` (`email_agent`),
  ADD UNIQUE KEY `un_agent` (`nom_agent`,`postnom_agent`,`prenom_agent`),
  ADD KEY `fk_code_fonction` (`code_fonction`);

--
-- Indexes for table `tbl_detailprojet`
--
ALTER TABLE `tbl_detailprojet`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_code_projet_detail` (`code_projet`);

--
-- Indexes for table `tbl_etape`
--
ALTER TABLE `tbl_etape`
  ADD PRIMARY KEY (`id_etape`),
  ADD KEY `fk_code_projet` (`code_projet`),
  ADD KEY `fk_code_phase` (`code_phase`);

--
-- Indexes for table `tbl_fichier`
--
ALTER TABLE `tbl_fichier`
  ADD PRIMARY KEY (`id_fichier`);

--
-- Indexes for table `tbl_fonction`
--
ALTER TABLE `tbl_fonction`
  ADD PRIMARY KEY (`id_fonction`);

--
-- Indexes for table `tbl_partenaire`
--
ALTER TABLE `tbl_partenaire`
  ADD PRIMARY KEY (`id_partenaire`),
  ADD UNIQUE KEY `un_mail_partenaire` (`email_partenaire`),
  ADD UNIQUE KEY `un_partenaire` (`partenaire`);

--
-- Indexes for table `tbl_phase`
--
ALTER TABLE `tbl_phase`
  ADD PRIMARY KEY (`id_phase`);

--
-- Indexes for table `tbl_privilege`
--
ALTER TABLE `tbl_privilege`
  ADD PRIMARY KEY (`id_privilege`),
  ADD KEY `fk_code_user_privilege` (`code_user`),
  ADD KEY `fk_code_projet_privilege` (`code_projet`);

--
-- Indexes for table `tbl_projet`
--
ALTER TABLE `tbl_projet`
  ADD PRIMARY KEY (`id_projet`);

--
-- Indexes for table `tbl_rapport`
--
ALTER TABLE `tbl_rapport`
  ADD KEY `fk_Rapport_aff` (`code_affectation`);

--
-- Indexes for table `tbl_rapport_complet`
--
ALTER TABLE `tbl_rapport_complet`
  ADD KEY `fk_Rapport_Cpmplet` (`code_rapport`);

--
-- Indexes for table `tbl_telephone`
--
ALTER TABLE `tbl_telephone`
  ADD PRIMARY KEY (`id_telephone`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `un_user` (`email`),
  ADD KEY `fk_code_agent` (`code_agent`),
  ADD KEY `fk_code_partenaire` (`code_partenaire`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_affectation`
--
ALTER TABLE `tbl_affectation`
  MODIFY `id_affectation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_detailprojet`
--
ALTER TABLE `tbl_detailprojet`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_etape`
--
ALTER TABLE `tbl_etape`
  MODIFY `id_etape` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_fichier`
--
ALTER TABLE `tbl_fichier`
  MODIFY `id_fichier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_fonction`
--
ALTER TABLE `tbl_fonction`
  MODIFY `id_fonction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_partenaire`
--
ALTER TABLE `tbl_partenaire`
  MODIFY `id_partenaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_phase`
--
ALTER TABLE `tbl_phase`
  MODIFY `id_phase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_privilege`
--
ALTER TABLE `tbl_privilege`
  MODIFY `id_privilege` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_projet`
--
ALTER TABLE `tbl_projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_telephone`
--
ALTER TABLE `tbl_telephone`
  MODIFY `id_telephone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_affectation`
--
ALTER TABLE `tbl_affectation`
  ADD CONSTRAINT `fk_code_etape` FOREIGN KEY (`code_etape`) REFERENCES `tbl_etape` (`id_etape`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_code_use_affectation` FOREIGN KEY (`code_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  ADD CONSTRAINT `fk_code_fonction` FOREIGN KEY (`code_fonction`) REFERENCES `tbl_fonction` (`id_fonction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_detailprojet`
--
ALTER TABLE `tbl_detailprojet`
  ADD CONSTRAINT `fk_code_projet_detail` FOREIGN KEY (`code_projet`) REFERENCES `tbl_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_etape`
--
ALTER TABLE `tbl_etape`
  ADD CONSTRAINT `fk_code_phase` FOREIGN KEY (`code_phase`) REFERENCES `tbl_phase` (`id_phase`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_code_projet` FOREIGN KEY (`code_projet`) REFERENCES `tbl_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_privilege`
--
ALTER TABLE `tbl_privilege`
  ADD CONSTRAINT `fk_code_projet_privilege` FOREIGN KEY (`code_projet`) REFERENCES `tbl_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_code_user_privilege` FOREIGN KEY (`code_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `fk_code_agent` FOREIGN KEY (`code_agent`) REFERENCES `tbl_agent` (`id_agent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_code_partenaire` FOREIGN KEY (`code_partenaire`) REFERENCES `tbl_partenaire` (`id_partenaire`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
