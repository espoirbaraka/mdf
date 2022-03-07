-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 04:30 PM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_insertPartenaire` (IN `id_partenaire_` INT, IN `partenaire` VARCHAR(50), IN `email_partenaire` VARCHAR(50), IN `userEvent` VARCHAR(50), IN `eventPartenaire` VARCHAR(50), IN `adresse` VARCHAR(255))  NO SQL
BEGIN 
    IF (eventPartenaire = 'CREATE_PARTENAIRE')THEN
      INSERT INTO tbl_partenaire ( partenaire, email_partenaire,adresse_partenaire, addBy,  dateAdd,editBy, dateEdit,deleteBy, deleteDate,statutPartenaire) VALUES ( partenaire, email_partenaire,adresse,  userEvent,  CURRENT_DATE(),'-', null,'-', null,eventPartenaire);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_InsertRapport` (IN `text_info` TEXT, IN `fichier` TEXT, IN `code_affectation` INT, IN `id` INT)  NO SQL
BEGIN
DECLARE val1 int;
SET val1 = fun_user(id);
IF (val1 = 0) THEN
	INSERT INTO tbl_rapport(textInfo, fichier, code_affectation, addBy, dateAdd) VALUES(text_info,fichier,code_affectation,id,Now());
    ELSE
    INSERT INTO tbl_rapport(textInfo, fichier, code_affectation, addBy, dateAdd) VALUES(text_info,fichier,val1,id,Now());
    END IF;
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

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fun_user` (`id` INT) RETURNS INT(11) NO SQL
BEGIN
DECLARE val1 int;
SET val1 = (SELECT id_affectation FROM tbl_affectation WHERE code_user = id ORDER BY id_affectation DESC LIMIT 0,1  );
RETURN val1;
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
(2, 6, 26, 1, '26', '2021-12-06 12:14:53', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
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
(13, 3, 27, 0, '27', '2021-12-06 20:36:54', '-', NULL, '-', NULL, 'DEMAND_AFFECTATION'),
(14, 28, 27, 1, '27', '2021-12-07 11:04:43', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(15, 29, 25, 1, '25', '2021-12-07 11:27:53', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(16, 29, 26, 1, '26', '2021-12-07 11:27:53', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(17, 11, 30, 0, '30', '2021-12-07 14:07:13', '-', NULL, '-', NULL, 'DEMAND_AFFECTATION'),
(18, 6, 30, 0, '30', '2021-12-07 14:08:11', '-', NULL, '-', NULL, 'DEMAND_AFFECTATION'),
(19, 11, 30, 0, '30', '2021-12-07 14:09:12', '-', NULL, '-', NULL, 'DEMAND_AFFECTATION'),
(20, 11, 27, 1, '27', '2021-12-07 14:09:44', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(21, 11, 30, 0, '30', '2021-12-07 14:09:50', '-', NULL, '-', NULL, 'DEMAND_AFFECTATION'),
(22, 37, 29, 1, '29', '2021-12-07 14:15:12', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(23, 37, 18, 1, '18', '2021-12-07 14:17:55', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(24, 3, 26, 1, '26', '2021-12-07 14:29:46', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(25, 6, 29, 1, '29', '2021-12-07 15:42:01', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(26, 5, 27, 1, '27', '2021-12-07 15:46:02', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(27, 35, 27, 0, '27', '2021-12-07 15:46:13', '-', NULL, '-', NULL, 'DEMAND_AFFECTATION'),
(28, 38, 18, 1, '18', '2021-12-07 16:43:43', '-', NULL, '-', NULL, 'ACCEPT_AFFECTATION'),
(29, 3, 29, 0, '29', '2021-12-07 17:02:14', '-', NULL, '-', NULL, 'DEMAND_AFFECTATION');

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
(7, 14, 1, '0', 0, '0000-00-00 00:00:00'),
(8, 15, 1, '0', 0, '0000-00-00 00:00:00'),
(9, 16, 1, '0', 0, '0000-00-00 00:00:00'),
(10, 17, 1, '1', 0, '0000-00-00 00:00:00'),
(11, 18, 1, '0', 0, '0000-00-00 00:00:00'),
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
(25, 20, 3, '0', 2147483647, '0000-00-00 00:00:00'),
(26, 16, 2, '0', 2147483647, '0000-00-00 00:00:00'),
(27, 16, 3, '0', 2147483647, '0000-00-00 00:00:00'),
(28, 15, 2, '0', 2147483647, '0000-00-00 00:00:00'),
(29, 14, 2, '0', 2147483647, '0000-00-00 00:00:00'),
(30, 20, 1, '1', 2147483647, '0000-00-00 00:00:00'),
(31, 16, 2, '0', 2147483647, '0000-00-00 00:00:00'),
(32, 16, 3, '0', 2147483647, '0000-00-00 00:00:00'),
(33, 16, 2, '0', 2147483647, '0000-00-00 00:00:00'),
(34, 16, 3, '0', 2147483647, '0000-00-00 00:00:00'),
(35, 16, 3, '1', 2147483647, '0000-00-00 00:00:00'),
(36, 15, 3, '1', 2147483647, '0000-00-00 00:00:00'),
(37, 18, 2, '1', 2147483647, '0000-00-00 00:00:00'),
(38, 14, 3, '1', 2147483647, '0000-00-00 00:00:00');

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
(7, 'Budget', '2021-12-07 07:29:55', 'reseau des neurones convolutifs.pdf', 12),
(8, 'Design pattern', '2021-12-07 10:55:54', 'DESIGN PATERN PROXY.docx', 0),
(9, 'Design pattern', '2021-12-07 10:58:47', 'DESIGN PATERN PROXY.docx', 16),
(10, '2000 Dollars', '2021-12-07 11:10:15', '36EBC57B-7FBB-4EB0-9838-165EBCCC3325L0001.jpeg', 14);

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
(2, 'OMS', 'oms@projet.org', '', '', '1', '2021-12-04 00:00:00', '-', NULL, '1', '2021-12-04 00:00:00', 'DELETE_PARTENAIRE'),
(3, 'CDPE', 'cdpe.gaetan@gmail.org', '', '', '1', '2021-12-04 00:00:00', '-', NULL, '-', NULL, 'CREATE_PARTENAIRE'),
(4, 'Mercy corp', 'shekinahmalekani@icloud.com', '', 'Burundi', '26', '2021-12-07 00:00:00', '-', NULL, '-', NULL, 'CREATE_PARTENAIRE');

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
  `fichier` text DEFAULT NULL,
  `code_affectation` int(11) NOT NULL,
  `addBy` varchar(50) NOT NULL,
  `dateAdd` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rapport`
--

INSERT INTO `tbl_rapport` (`id_rapport`, `textInfo`, `fichier`, `code_affectation`, `addBy`, `dateAdd`) VALUES
(1, '<p class=\"MsoNormal\" align=\"left\" style=\"margin: 0in -51.05pt 8.3pt -48.6pt; text-indent: 0in; line-height: 107%;\"><!--[if mso & !supportInlineShapes & supportFields]><span\r\nstyle=\'mso-element:field-begin;mso-field-lock:yes\'></span><span\r\nstyle=\'mso-spacerun:yes\'> </span>SHAPE <span\r\nstyle=\'mso-spacerun:yes\'> </span>\\* MERGEFORMAT <span style=\'mso-element:field-separator\'></span><![endif]--><!--[if gte vml 1]><v:group\r\n id=\"Group_x0020_1411\" o:spid=\"_x0000_s1032\" style=\'width:551.15pt;height:73.45pt;\r\n mso-position-horizontal-relative:char;mso-position-vertical-relative:line\'\r\n coordsize=\"69997,9326\" o:gfxdata=\"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\r\nQCy2tvEdwoeHQGtHYF', '0245B937-062B-4B65-826A-C4DAEF0B04D1L0001.jpeg', 4, '27', '2021-12-07 13:14:55');
INSERT INTO `tbl_rapport` (`id_rapport`, `textInfo`, `fichier`, `code_affectation`, `addBy`, `dateAdd`) VALUES
(2, '<p class=\"MsoNormal\" align=\"left\" style=\"margin: 0in 0in 7.95pt; text-indent: 0in; line-height: 116%;\"><span lang=\"FR\">Il est demandé\r\ndans un temps limité de répondre au défi de gestion d’acquisitions de MDF-AC\r\nqui est de <b>« Digitaliser et centraliser\r\nla gestion collaborative dans le processus d’acquisition de marché,\r\nd’élaboration de proposition jusqu’à la mise en  œuvre &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; du &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; projet/mission &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; »</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; en &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; présentant &nbsp;&nbsp;&nbsp; des prototypes/applications/plateformes de différentes\r\nfonctionnalités et répondant à ces use-cases : <o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-top:0in;margin-right:-.65pt;margin-bottom:\r\n.15pt;margin-left:3.1pt;line-height:115%\"><b><span lang=\"FR\">Case-1 : </span></b><span lang=\"FR\">Intégration des utilisateurs </span><span lang=\"FR\" style=\"color:red;mso-ansi-language:FR\">(administrateur, manager et user) </span><span lang=\"FR\">dans la plateforme </span><span lang=\"FR\" style=\"color:red;mso-ansi-language:FR\">(conception d’un module de création de\r\ncompte des utilisateurs – le staff MDF-AC)</span><span lang=\"FR\" style=\"color:#00B050;mso-ansi-language:FR\"> </span><span lang=\"FR\">et attribution des privilèges/rôles </span><span lang=\"FR\" style=\"color:red;mso-ansi-language:FR\">(gestion des utilisateurs,\r\ngestion de missions/projets crées, création de missions/projet, gestion des\r\nresponsabilités/ tâches) </span><span lang=\"FR\">; <o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-top:0in;margin-right:0in;margin-bottom:.5pt;\r\nmargin-left:-.25pt\"><b><span lang=\"FR\">Case-2 : </span></b><span lang=\"FR\">Création du canal (équipe) de projet en y mettant\r\ntoutes les informations relatives au projet </span><span lang=\"FR\" style=\"color:red;mso-ansi-language:FR\">(Titre, bailleur de fond, deadline,\r\nobjectifs, budget, localisation, etc.) </span><span lang=\"FR\">; <o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-top:0in;margin-right:-.65pt;margin-bottom:\r\n.15pt;margin-left:3.1pt;line-height:115%\"><b><span lang=\"FR\">Case-3 : </span></b><span lang=\"FR\">Adhésion des utilisateurs au canal </span><span lang=\"FR\" style=\"color:red;mso-ansi-language:FR\">(demande d’adhésion et\r\napprobation de la demande par le manager ou le créateur du canal) </span><span lang=\"FR\">; <o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-top:0in;margin-right:0in;margin-bottom:.5pt;\r\nmargin-left:-.25pt\"><b><span lang=\"FR\">Case-4 : </span></b><span lang=\"FR\">Planification des responsabilités/ tâches </span><span lang=\"FR\" style=\"color:red;mso-ansi-language:FR\">(workflow) </span><span lang=\"FR\">avec des deadlines dans le calendrier partagé ; <o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-top:0in;margin-right:-.65pt;margin-bottom:\r\n.15pt;margin-left:3.1pt;line-height:115%\"><b><span lang=\"FR\">Case-5.a : </span></b><span lang=\"FR\">Rédaction commune du projet </span><span lang=\"FR\" style=\"color:red;mso-ansi-language:FR\">(un fichier doc partagé ou un éditeur\r\nWYSIWYG intégré) </span><span lang=\"FR\">; <o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-top:0in;margin-right:-.65pt;margin-bottom:\r\n.15pt;margin-left:3.1pt;line-height:115%\"><b><span lang=\"FR\">Case-5.b : </span></b><span lang=\"FR\">Rédaction partagé du projet </span><span lang=\"FR\" style=\"color:red;mso-ansi-language:FR\">(attribution des responsabilités/tâches\r\nau niveau de la rédaction de la proposition) </span><span lang=\"FR\">; <o:p></o:p></span></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" style=\"margin-top:0in;margin-right:0in;margin-bottom:277.9pt;\r\nmargin-left:-.25pt\"><b><span lang=\"FR\">Case-6 :</span></b><span lang=\"FR\"> Recherche des informations dans les métadonnées de la plateforme en\r\nrespectant le niveau d’accès.&nbsp;<o:p></o:p></span></p>', '99626E74-667D-4F19-A96B-0251C9209F4EL0001.jpeg', 4, '27', '2021-12-07 13:16:54'),
(3, '<p>jdnsjkcnwjkcfnnfjnsdkcnjsdnciwcjksdncjknsjkcnsknc</p>', 'ATTESTATION NICLETTE RAOUL (1).pdf', 15, '25', '2021-12-07 13:38:31'),
(4, '<h5><span style=\"font-size: 10pt; font-family: Georgia, serif; color: black;\">EGLISE DU\r\nCHRIST AU CONGO<o:p></o:p></span></h5><h5><span style=\"font-size: 10pt; font-family: Georgia, serif; color: black;\">COMMUNAUTE\r\nBAPTISTE AU CENTRE DE L’AFRIQUE<o:p></o:p></span></h5><h4><span style=\"font-size: 10pt; font-family: Georgia, serif;\">POSTE ECCLESIASTIQUE DE\r\nGOMA<o:p></o:p></span></h4><h2 align=\"center\" style=\"text-align:center\"><span style=\"font-size: 10pt; font-family: Georgia, serif; color: black;\">PAROISSE GOMA-VILLE<o:p></o:p></span></h2><h6><span style=\"font-size:16.0pt;mso-bidi-font-size:12.0pt;font-family:&quot;Georgia&quot;,serif;\r\nmso-bidi-font-family:Arial;color:black\">TROUPE THEATRALE<o:p></o:p></span></h6><h6><u><span style=\"font-size: 12pt; font-family: Georgia, serif; color: black;\">B.P. 485 GOMA<o:p></o:p></span></u></h6><p class=\"MsoNormal\" align=\"center\" style=\"text-align:center\"><!--[if gte vml 1]><v:group\r\n id=\"Groupe_x0020_2\" o:spid=\"_x0000_s1026\" style=\'position:absolute;left:0;\r\n text-align:left;margin-left:38pt;margin-top:1.85pt;width:424.3pt;height:48.7pt;\r\n z-index:251659264\' coordorigin=\"1260,3116\" coordsize=\"9720,1371\" o:gfxdata=\"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\r\nCOdwILxU5we95aoF0bRYV+pIuz5PHKDUG4fVjg+fCOBs4ilcwUcGH2Q1JaspGVzBlwNoF9lxf8fP\r\nLwoJPM8kJaZeSOoFplFIGoWkWUiahaRVSFq+p8/F4VuMOhL3veLYG3pYfkyery3sbzjb/wIAAP//\r\nAwBQSwMECgAAAAAAAAAhAArO6auoLgAAqC4AABoAAABjbGlwYm9hcmQvbWVkaWEvaW1hZ2UxLnBu\r\nZ4lQTkcNChoKAAAADUlIRFIAAACnAAAAhQgDAAABfqsodQAAAAFzUkdCAK7OHOkAAAAEZ0FNQQAA\r\nsY8L/GEFAAAC/VBMVEWfn5/s7OwsLCx5eXnGxsZTU1OgoKDt7e0tLS16enrHx8dUVFShoaHu7u4u\r\nLi57e3vIyMhVVVWioqLv7+8vLy98fHzJyckJCQlWVlajo6Pw8PAwMDB9fX3KysoKCgpXV1f7+/uk\r\npKTx8fExMTF+fn7Ly8sLCwtYWFilpaXy8vIyMjJ/f3/MzMwMDAxZWVmmpqbz8/MzMzOAgIDNzc0N\r\nDQ1aWlqnp6f09PQ0NDSBgYHOzs4ODg5bW1uoqKj19fU1NTWCgoLPz88PDw9cXFypqan29vY2NjaD\r\ng4PQ0NAQEBBdXV2qqqr39/c3NzeEhITR0dERERFeXl6rq6v4+Pg4ODiFhYXS0tISEhJfX1+srKz5\r\n+fk5OTmGhobT09MTExNgYGCtra36+vo6OjqHh4fU1NQUFBRhYWGurq77+/s7OzuIiIjV1dUVFRVi\r\nYmKvr6/8/Pw8PDyJiYnW1tYWFhZjY2OwsLD9/f09PT2KiorX19cXFxdkZGSxsbH+/v4+Pj6Li4vY\r\n2NgYGBhlZWWysrL///8/Pz+MjIzZ2dkZGRlmZmazs7NAQECNjY3a2toaGhpnZ2e0tLRBQUGOjo7b\r\n29sbGxtoaGi1tbX09PRCQkKPj4/c3NwcHBxpaWm2trZDQ0OQkJDd3d0dHR1qamq3t7f29vZERESR\r\nkZHe3t4eHh5ra2u4uLhFRUWSkpLf398fHx9sbGy5ubn4+PhGRkaTk5Pg4OAgICBtbW26urr5+flH\r\nR0eUlJTh4eEhISFubm67u7v6+vpISEiVlZXi4uIiIiJvb2+8vLz7+/tJSUmWlpbj4+MjIyNwcHC9\r\nvb38/PxKSkqXl5fk5OQkJCRxcXG+vr5LS0uYmJjl5eUlJSVycnK/v79MTEyZmZnm5uYmJiZzc3PA\r\nwMBNTU2amprn5+cnJyd0dHTBwcFOTk6bm5vo6OgoKCh1dXXCwsJPT0+cnJzp6ekpKSl2dnbDw8NQ\r\nUFCdnZ3q6uoqKip3d3fExMRRUVGenp7r6+srKyt4eHjFxcVSUlJwsav3AAAAznRSTlP/////////\r\n//////////////////////////////////3/////////////////////////////////////////\r\n////////////////////////////////////////////////////////////////////////////\r\n/////////////////////////////////////////v////////////////7////////////////+\r\n/////////v////////7////////+/////////lAuAj8AAAAJcEhZcwAAIdUAACHVAQSctJ0AACpa\r\nSURBVGhDzXsNeAzn26+kCNIETTia8Dpd9bJ42XBqU38WZVQYHzUhOqll1DJqedQyZBlsG2xptlXL\r\nwfpIOJq0CC+2DlletfpXqSJK4iuliY8EldIETcj13s987Ux2o97rOudcZy6yuzPP3HM/9/27f8/9\r\n3M8zDf77P+H4+Z8///wz/sQf8L/Bz+np6TzPUw/a7KQoPp3Hv9Ib/BM+08lKepaFYpkuHPyAo8HP\r\ncPZZOtdjddmrRJt0lsWthbaZPO+wsDxvs6F03BgkgFwQlz7gCs8689/k0xeLbbGcOBLxes55lzOk\r\n08LZn/mN6en+yXxbMsuB2m/jECfqQIFiLPd8dguS5RAFJ3keS2DT03MX7K6aG359yGy+mhOexqfn\r\n8jya+qM5bgSCmz8V9QVNrrF7s8v+9UpZ6bUh74ia/RPLSeVZJiUC8Vy+1Dc4C9+YaHYMRRdx+DsY\r\nAuRik+BLcI94Lh3rgH8pl+SzWK58Ht+FmzfAJhfNjs0v2B2sLt7Cc4MObRSeJUhvgP9yNYgxmptE\r\noUxRMTibzqOI9CGVE6ur3kbpCfJZnp+Rztit6em0zZGeHis8D+T+EAXSPjvA+/0VDC/2AyT0SU93\r\nII51sOMctel8V+FsOlzmaSY33EDrnJVxfH9Jh1M877+dc35yMVjnIl8snk33wQNYelXR2ibH48PT\r\nw8Sn8ekMz7uLUNLxTfCbFvWF5/fhx7e6cT6JzOl/kiWw0bGEdL6aRBxK4TnOBCclzeA02rAUTSNP\r\n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\r\nZ2UxLnBuZ1BLBQYAAAAABgAGAK8BAAAkQQAAAAA=\r\n\">\r\n <v:shapetype id=\"_x0000_t75\" coordsize=\"21600,21600\" o:spt=\"75\"\r\n  o:preferrelative=\"t\" path=\"m@4@5l@4@11@9@11@9@5xe\" filled=\"f\" stroked=\"f\">\r\n  <v:stroke joinstyle=\"miter\"/>\r\n  <v:formulas>\r\n   <v:f eqn=\"if lineDrawn pixelLineWidth 0\"/>\r\n   <v:f eqn=\"sum @0 1 0\"/>\r\n   <v:f eqn=\"sum 0 0 @1\"/>\r\n   <v:f eqn=\"prod @2 1 2\"/>\r\n   <v:f eqn=\"prod @3 21600 pixelWidth\"/>\r\n   <v:f eqn=\"prod @3 21600 pixelHeight\"/>\r\n   <v:f eqn=\"sum @0 0 1\"/>\r\n   <v:f eqn=\"prod @6 1 2\"/>\r\n   <v:f eqn=\"prod @7 21600 pixelWidth\"/>\r\n   <v:f eqn=\"sum @8 21600 0\"/>\r\n   <v:f eqn=\"prod @7 21600 pixelHeight\"/>\r\n   <v:f eqn=\"sum @10 21600 0\"/>\r\n  </v:formulas>\r\n  <v:path o:extrusionok=\"f\" gradientshapeok=\"t\" o:connecttype=\"rect\"/>\r\n  <o:lock v:ext=\"edit\" aspectratio=\"t\"/>\r\n </v:shapetype><v:shape id=\"Picture_x0020_3\" o:spid=\"_x0000_s1027\" type=\"#_x0000_t75\"\r\n  style=\'position:absolute;left:5406;top:3116;width:1254;height:1230;\r\n  visibility:visible;mso-wrap-style:square\' o:gfxdata=\"UEsDBBQABgAIAAAAIQDb4fbL7gAAAIUBAAATAAAAW0NvbnRlbnRfVHlwZXNdLnhtbHyQz07DMAyH\r\n70i8Q+QralM4IITa7kDhCAiNB7ASt43WOlEcyvb2pNu4IODoPz9/n1xv9vOkForiPDdwXVagiI23\r\njocG3rdPxR0oScgWJ8/UwIEENu3lRb09BBKV0ywNjCmFe63FjDSjlD4Q50nv44wpl3HQAc0OB9I3\r\nVXWrjedEnIq03oC27qjHjympx31un0wiTQLq4bS4shrAECZnMGVTvbD9QSnOhDInjzsyuiBXWQP0\r\nr4R18jfgnHvJr4nOknrFmJ5xzhraRtHWf3Kkpfz/yGo5S+H73hkquyhdjr3R8m2lj09svwAAAP//\r\nAwBQSwMEFAAGAAgAAAAhAFr0LFu/AAAAFQEAAAsAAABfcmVscy8ucmVsc2zPwWrDMAwG4Ptg72B0\r\nX5TuUMaI01uh19I+gLGVxCy2jGSy9e1nemrHjpL4P0nD4SetZiPRyNnCruvBUPYcYp4tXC/Htw8w\r\nWl0ObuVMFm6kcBhfX4Yzra62kC6xqGlKVgtLreUTUf1CyWnHhXKbTCzJ1VbKjMX5LzcTvvf9HuXR\r\ngPHJNKdgQU5hB+ZyK23zHztFL6w81c5zQp6m6P9TMfB3PtPWFCczVQtB9N4U2rp2HOA44NMz4y8A\r\nAAD//wMAUEsDBBQABgAIAAAAIQBI3dP9xAAAANoAAAAPAAAAZHJzL2Rvd25yZXYueG1sRI/BasMw\r\nEETvhfyD2EIupZGblhDcKMaEBEIuook/YLG2tltr5Viq7fx9VCj0OMzMG2aTTbYVA/W+cazgZZGA\r\nIC6dabhSUFwOz2sQPiAbbB2Tght5yLazhw2mxo38QcM5VCJC2KeooA6hS6X0ZU0W/cJ1xNH7dL3F\r\nEGVfSdPjGOG2lcskWUmLDceFGjva1VR+n3+sAl0UO3vTWl++9jov93Ravz1dlZo/Tvk7iEBT+A//\r\ntY9GwSv8Xok3QG7vAAAA//8DAFBLAQItABQABgAIAAAAIQDb4fbL7gAAAIUBAAATAAAAAAAAAAAA\r\nAAAAAAAAAABbQ29udGVudF9UeXBlc10ueG1sUEsBAi0AFAAGAAgAAAAhAFr0LFu/AAAAFQEAAAsA\r\nAAAAAAAAAAAAAAAAHwEAAF9yZWxzLy5yZWxzUEsBAi0AFAAGAAgAAAAhAEjd0/3EAAAA2gAAAA8A\r\nAAAAAAAAAAAAAAAABwIAAGRycy9kb3ducmV2LnhtbFBLBQYAAAAAAwADALcAAAD4AgAAAAA=\r\n\">\r\n  <v:imagedata src=\"file:///C:/Users/HELPME~1/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png\"\r\n   o:title=\"\"/>\r\n </v:shape><v:shapetype id=\"_x0000_t202\" coordsize=\"21600,21600\" o:spt=\"202\"\r\n  path=\"m,l,21600r21600,l21600,xe\">\r\n  <v:stroke joinstyle=\"miter\"/>\r\n  <v:path gradientshapeok=\"t\" o:connecttype=\"rect\"/>\r\n </v:shapetype><v:shape id=\"Text_x0020_Box_x0020_4\" o:spid=\"_x0000_s1028\"\r\n  type=\"#_x0000_t202\" style=\'position:absolute;left:7217;top:3116;width:3763;\r\n  height:1371;visibility:visible;mso-wrap-style:square;v-text-anchor:top\'\r\n  o:gfxdata=\"UEsDBBQABgAIAAAAIQDb4fbL7gAAAIUBAAATAAAAW0NvbnRlbnRfVHlwZXNdLnhtbHyQz07DMAyH\r\n70i8Q+QralM4IITa7kDhCAiNB7ASt43WOlEcyvb2pNu4IODoPz9/n1xv9vOkForiPDdwXVagiI23\r\njocG3rdPxR0oScgWJ8/UwIEENu3lRb09BBKV0ywNjCmFe63FjDSjlD4Q50nv44wpl3HQAc0OB9I3\r\nVXWrjedEnIq03oC27qjHjympx31un0wiTQLq4bS4shrAECZnMGVTvbD9QSnOhDInjzsyuiBXWQP0\r\nr4R18jfgnHvJr4nOknrFmJ5xzhraRtHWf3Kkpfz/yGo5S+H73hkquyhdjr3R8m2lj09svwAAAP//\r\nAwBQSwMEFAAGAAgAAAAhAFr0LFu/AAAAFQEAAAsAAABfcmVscy8ucmVsc2zPwWrDMAwG4Ptg72B0\r\nX5TuUMaI01uh19I+gLGVxCy2jGSy9e1nemrHjpL4P0nD4SetZiPRyNnCruvBUPYcYp4tXC/Htw8w\r\nWl0ObuVMFm6kcBhfX4Yzra62kC6xqGlKVgtLreUTUf1CyWnHhXKbTCzJ1VbKjMX5LzcTvvf9HuXR\r\ngPHJNKdgQU5hB+ZyK23zHztFL6w81c5zQp6m6P9TMfB3PtPWFCczVQtB9N4U2rp2HOA44NMz4y8A\r\nAAD//wMAUEsDBBQABgAIAAAAIQDsKHhuwgAAANoAAAAPAAAAZHJzL2Rvd25yZXYueG1sRI9Ba8JA\r\nFITvhf6H5QleSt00lCKpawhS0WusF2+P7DMJZt8m2a1J/PVuQfA4zMw3zCodTSOu1LvasoKPRQSC\r\nuLC65lLB8Xf7vgThPLLGxjIpmMhBun59WWGi7cA5XQ++FAHCLkEFlfdtIqUrKjLoFrYlDt7Z9gZ9\r\nkH0pdY9DgJtGxlH0JQ3WHBYqbGlTUXE5/BkFdviZjKUuit9ON7PbZF1+jjul5rMx+wbhafTP8KO9\r\n1wo+4f9KuAFyfQcAAP//AwBQSwECLQAUAAYACAAAACEA2+H2y+4AAACFAQAAEwAAAAAAAAAAAAAA\r\nAAAAAAAAW0NvbnRlbnRfVHlwZXNdLnhtbFBLAQItABQABgAIAAAAIQBa9CxbvwAAABUBAAALAAAA\r\nAAAAAAAAAAAAAB8BAABfcmVscy8ucmVsc1BLAQItABQABgAIAAAAIQDsKHhuwgAAANoAAAAPAAAA\r\nAAAAAAAAAAAAAAcCAABkcnMvZG93bnJldi54bWxQSwUGAAAAAAMAAwC3AAAA9gIAAAAA\r\n\" strokecolor=\"white\">\r\n  <v:textbox>\r\n   <![if !mso]>\r\n   <table cellpadding=0 cellspacing=0 width=\"100%\">\r\n    <tr>\r\n     <td><![endif]>\r\n     <div>\r\n     <p class=MsoNormal style=\'margin-bottom:0in;margin-bottom:.0001pt;\r\n     line-height:normal\'><span style=\'font-size:8.0pt;mso-bidi-font-size:11.0pt\'>Tél.&nbsp;:\r\n     (+ 243) 994-331-233 (ECODIM)<o:p></o:p></span></p>\r\n     <p class=MsoNormal style=\'margin-bottom:0in;margin-bottom:.0001pt;\r\n     line-height:normal\'><span style=\'font-size:8.0pt;mso-bidi-font-size:11.0pt\'><span\r\n     style=\'mso-spacerun:yes\'>          </span>(+ 243) 992-563-979 (MJC)<o:p></o:p></span></p>\r\n     <p class=MsoNormal style=\'margin-bottom:0in;margin-bottom:.0001pt;\r\n     line-height:normal\'><span style=\'font-size:8.0pt;mso-bidi-font-size:11.0pt\'><o:p>&nbsp;</o:p></span></p>\r\n     <div style=\'mso-element:para-border-div;border:none;border-bottom:solid windowtext 1.0pt;\r\n     mso-border-bottom-alt:solid windowtext .5pt;padding:0in 0in 0in 0in\'>\r\n     <p class=MsoNormal style=\'border:none;mso-border-bottom-alt:solid windowtext .5pt;\r\n     padding:0in;mso-padding-alt:0in 0in 0in 0in\'><span style=\'font-size:8.0pt;\r\n     mso-bidi-font-size:11.0pt;line-height:107%\'>E-mail&nbsp;: </span><a\r\n     href=\"mailto:minenfant.gomaville@gmail.com\"><span style=\'font-size:8.0pt;\r\n     mso-bidi-font-size:11.0pt;line-height:107%\'>minenfant.gomaville@gmail.com</span></a><span\r\n     style=\'font-size:8.0pt;mso-bidi-font-size:11.0pt;line-height:107%\'> <span\r\n     style=\'mso-spacerun:yes\'> </span><o:p></o:p></span></p>\r\n     </div>\r\n     </div>\r\n     <![if !mso]></td>\r\n    </tr>\r\n   </table>\r\n   <![endif]></v:textbox>\r\n </v:shape><v:shape id=\"Text_x0020_Box_x0020_5\" o:spid=\"_x0000_s1029\" type=\"#_x0000_t202\"\r\n  style=\'position:absolute;left:1260;top:3116;width:3606;height:1371;\r\n  visibility:visible;mso-wrap-style:square;v-text-anchor:top\' o:gfxdata=\"UEsDBBQABgAIAAAAIQDb4fbL7gAAAIUBAAATAAAAW0NvbnRlbnRfVHlwZXNdLnhtbHyQz07DMAyH\r\n70i8Q+QralM4IITa7kDhCAiNB7ASt43WOlEcyvb2pNu4IODoPz9/n1xv9vOkForiPDdwXVagiI23\r\njocG3rdPxR0oScgWJ8/UwIEENu3lRb09BBKV0ywNjCmFe63FjDSjlD4Q50nv44wpl3HQAc0OB9I3\r\nVXWrjedEnIq03oC27qjHjympx31un0wiTQLq4bS4shrAECZnMGVTvbD9QSnOhDInjzsyuiBXWQP0\r\nr4R18jfgnHvJr4nOknrFmJ5xzhraRtHWf3Kkpfz/yGo5S+H73hkquyhdjr3R8m2lj09svwAAAP//\r\nAwBQSwMEFAAGAAgAAAAhAFr0LFu/AAAAFQEAAAsAAABfcmVscy8ucmVsc2zPwWrDMAwG4Ptg72B0\r\nX5TuUMaI01uh19I+gLGVxCy2jGSy9e1nemrHjpL4P0nD4SetZiPRyNnCruvBUPYcYp4tXC/Htw8w\r\nWl0ObuVMFm6kcBhfX4Yzra62kC6xqGlKVgtLreUTUf1CyWnHhXKbTCzJ1VbKjMX5LzcTvvf9HuXR\r\ngPHJNKdgQU5hB+ZyK23zHztFL6w81c5zQp6m6P9TMfB3PtPWFCczVQtB9N4U2rp2HOA44NMz4y8A\r\nAAD//wMAUEsDBBQABgAIAAAAIQBztkOCwgAAANoAAAAPAAAAZHJzL2Rvd25yZXYueG1sRI9Pa8JA\r\nFMTvgt9heYVexGyag0jMKiJKe03ai7dH9uUPzb5NsquJ/fTdQsHjMDO/YbLDbDpxp9G1lhW8RTEI\r\n4tLqlmsFX5+X9RaE88gaO8uk4EEODvvlIsNU24lzuhe+FgHCLkUFjfd9KqUrGzLoItsTB6+yo0Ef\r\n5FhLPeIU4KaTSRxvpMGWw0KDPZ0aKr+Lm1Fgp/PDWBriZHX9Me+n45BXyaDU68t83IHwNPtn+L/9\r\noRVs4O9KuAFy/wsAAP//AwBQSwECLQAUAAYACAAAACEA2+H2y+4AAACFAQAAEwAAAAAAAAAAAAAA\r\nAAAAAAAAW0NvbnRlbnRfVHlwZXNdLnhtbFBLAQItABQABgAIAAAAIQBa9CxbvwAAABUBAAALAAAA\r\nAAAAAAAAAAAAAB8BAABfcmVscy8ucmVsc1BLAQItABQABgAIAAAAIQBztkOCwgAAANoAAAAPAAAA\r\nAAAAAAAAAAAAAAcCAABkcnMvZG93bnJldi54bWxQSwUGAAAAAAMAAwC3AAAA9gIAAAAA\r\n\" strokecolor=\"white\">\r\n  <v:textbox>\r\n   <![if !mso]>\r\n   <table cellpadding=0 cellspacing=0 width=\"100%\">\r\n    <tr>\r\n     <td><![endif]>\r\n     <div>\r\n     <div style=\'mso-element:para-border-div;border:none;border-bottom:solid windowtext 1.0pt;\r\n     mso-border-bottom-alt:solid windowtext .5pt;padding:0in 0in 1.0pt 0in\'>\r\n     <p class=MsoNormal style=\'margin-bottom:0in;margin-bottom:.0001pt;\r\n     line-height:normal;border:none;mso-border-bottom-alt:solid windowtext .5pt;\r\n     padding:0in;mso-padding-alt:0in 0in 1.0pt 0in\'><span style=\'font-size:\r\n     8.0pt;mso-bidi-font-size:11.0pt\'>Adresse locale&nbsp;: Commune de Goma<o:p></o:p></span></p>\r\n     <p class=MsoNormal style=\'margin-bottom:0in;margin-bottom:.0001pt;\r\n     line-height:normal;border:none;mso-border-bottom-alt:solid windowtext .5pt;\r\n     padding:0in;mso-padding-alt:0in 0in 1.0pt 0in\'><span style=\'font-size:\r\n     8.0pt;mso-bidi-font-size:11.0pt\'><span\r\n     style=\'mso-spacerun:yes\'>                           </span>Quartier Les\r\n     Volcans<o:p></o:p></span></p>\r\n     <p class=MsoNormal style=\'margin-bottom:0in;margin-bottom:.0001pt;\r\n     line-height:normal;border:none;mso-border-bottom-alt:solid windowtext .5pt;\r\n     padding:0in;mso-padding-alt:0in 0in 1.0pt 0in\'><span style=\'font-size:\r\n     8.0pt;mso-bidi-font-size:11.0pt\'><span\r\n     style=\'mso-spacerun:yes\'>                          </span>10, Avenue<span\r\n     style=\'mso-spacerun:yes\'>  </span>des Bougainvilliers<o:p></o:p></span></p>\r\n     </div>\r\n     </div>\r\n     <![if !mso]></td>\r\n    </tr>\r\n   </table>\r\n   <![endif]></v:textbox>\r\n </v:shape></v:group><![endif]--><!--[if !vml]-->\r\n\r\n</p><table cellpadding=\"0\" cellspacing=\"0\" align=\"left\">\r\n <tbody><tr>\r\n  <td width=\"50\" height=\"1\"></td>\r\n </tr>\r\n <tr>\r\n  <td></td>\r\n  <td><img width=\"571\" height=\"71\" src=\"file:///C:/Users/HELPME~1/AppData/Local/Temp/msohtmlclip1/01/clip_image002.png\" v:shapes=\"Groupe_x0020_2 Picture_x0020_3 Text_x0020_Box_x0020_4 Text_x0020_Box_x0020_5\"></td>\r\n </tr>\r\n</tbody></table><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<!--[endif]--><b><span style=\"font-size:\r\n12.0pt;line-height:107%;font-family:&quot;Georgia&quot;,serif;mso-bidi-font-family:Arial\">&nbsp;</span></b></p><p></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-left:247.8pt;text-align:center;\r\ntext-indent:35.4pt\"><b><span style=\"font-size:12.0pt;line-height:107%;font-family:&quot;Georgia&quot;,serif;\r\nmso-bidi-font-family:Arial\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-no-proof:yes\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-no-proof:yes\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-no-proof:yes\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-no-proof:yes\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-no-proof:yes\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-no-proof:yes\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-no-proof:yes\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-no-proof:yes\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-no-proof:yes\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">&nbsp;</span></b></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<br clear=\"ALL\">\r\n\r\n</p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center;line-height:normal\"><b><span style=\"font-size:18.0pt;mso-bidi-font-size:11.0pt;font-family:&quot;Georgia&quot;,serif\">Thème\r\n:<o:p></o:p></span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0in;margin-bottom:.0001pt;\r\ntext-align:center;line-height:normal\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">&nbsp;</span></b></p><p class=\"MsoListParagraphCxSpFirst\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in;line-height:normal\"><b><span style=\"font-size:14.0pt;mso-bidi-font-size:11.0pt;font-family:&quot;Georgia&quot;,serif;\r\nmso-ansi-language:FR\">«&nbsp;Il a pris le relais »<o:p></o:p></span></b></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:\r\nFR\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:FR\">&nbsp;</span></b></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:FR\">Conception&nbsp;:<o:p></o:p></span></b></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:\r\nFR\">David Musumba<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:\r\nFR\">Gaétan Abio<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:\r\nFR\">Aline Kavuyu<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:\r\nFR\">Abigaël <o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:\r\nFR\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:FR\">&nbsp;</span></b></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:FR\">Censure:<o:p></o:p></span></b></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:\r\nFR\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpMiddle\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:\r\nFR\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpLast\" align=\"center\" style=\"text-align:center;\r\ntext-indent:-.5in\"><b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-ansi-language:FR\">Octobre 2021<o:p></o:p></span></b></p><p class=\"MsoNormal\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">&nbsp;</span></b></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<b><span style=\"font-size:11.0pt;line-height:107%;font-family:&quot;Georgia&quot;,serif;\r\nmso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;mso-bidi-font-family:\r\n&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;mso-ansi-language:FR;\r\nmso-fareast-language:EN-US;mso-bidi-language:AR-SA\"><br clear=\"all\" style=\"mso-special-character:line-break;page-break-before:always\">\r\n</span></b>\r\n\r\n</p><p class=\"MsoNormal\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">&nbsp;</span></b></p><p class=\"MsoNormal\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">Résumé<o:p></o:p></span></b></p><p>\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" style=\"text-align:justify\"><span style=\"font-family:&quot;Georgia&quot;,serif;\r\nmso-bidi-font-weight:bold\">Comme dans une habitude de la soirée de noël, le\r\npère d’une famille a toujours l’habitude de raconter l’histoire de noël à ses\r\nenfants. Tous réunies autour d’un feu, il passe à revu l’histoire de la\r\nnaissance de Christ</span><span style=\"font-family:&quot;Georgia&quot;,serif\"> <o:p></o:p></span></p>', '', 15, '25', '2021-12-07 14:22:52');
INSERT INTO `tbl_rapport` (`id_rapport`, `textInfo`, `fichier`, `code_affectation`, `addBy`, `dateAdd`) VALUES
(5, '<p class=\"MsoNormal\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">Personnages<o:p></o:p></span></b></p><p class=\"MsoNormal\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">Une\r\nfamille&nbsp;:<o:p></o:p></span></b></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;mso-bidi-font-family:\r\nGeorgia;mso-ansi-language:FR;mso-bidi-font-weight:bold\">1.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Georgia&quot;,serif;\r\nmso-ansi-language:FR;mso-bidi-font-weight:bold\">Papa&nbsp;: MICHEL<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;mso-bidi-font-family:\r\nGeorgia;mso-ansi-language:FR;mso-bidi-font-weight:bold\">2.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Georgia&quot;,serif;\r\nmso-ansi-language:FR;mso-bidi-font-weight:bold\">Enfant 1&nbsp;: ELIANE<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;mso-bidi-font-family:\r\nGeorgia;mso-ansi-language:FR;mso-bidi-font-weight:bold\">3.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Georgia&quot;,serif;\r\nmso-ansi-language:FR;mso-bidi-font-weight:bold\">Enfant 2&nbsp;: DAVINA<o:p></o:p></span></p><p class=\"MsoNormal\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">Hommes\r\n(4)&nbsp;:<o:p></o:p></span></b></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;mso-bidi-font-family:\r\nGeorgia;mso-ansi-language:FR;mso-bidi-font-weight:bold\">4.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Georgia&quot;,serif;\r\nmso-ansi-language:FR;mso-bidi-font-weight:bold\">Joseph&nbsp;: AUBIN<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;mso-bidi-font-family:\r\nGeorgia;mso-ansi-language:FR;mso-bidi-font-weight:bold\">5.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Georgia&quot;,serif;\r\nmso-ansi-language:FR;mso-bidi-font-weight:bold\">EMMA<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;mso-bidi-font-family:\r\nGeorgia;mso-ansi-language:FR;mso-bidi-font-weight:bold\">6.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Georgia&quot;,serif;\r\nmso-ansi-language:FR;mso-bidi-font-weight:bold\">SAMUEL<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;mso-bidi-font-family:\r\nGeorgia;mso-ansi-language:FR;mso-bidi-font-weight:bold\">7.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Georgia&quot;,serif;\r\nmso-ansi-language:FR;mso-bidi-font-weight:bold\">THIERY<o:p></o:p></span></p><p class=\"MsoNormal\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">Femmes\r\n(3)&nbsp;: <o:p></o:p></span></b></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;mso-bidi-font-family:\r\nGeorgia;mso-ansi-language:FR;mso-bidi-font-weight:bold\">8.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Georgia&quot;,serif;\r\nmso-ansi-language:FR;mso-bidi-font-weight:bold\">Marie&nbsp;: DULCINEE<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;mso-bidi-font-family:\r\nGeorgia;mso-ansi-language:FR;mso-bidi-font-weight:bold\">9.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Georgia&quot;,serif;\r\nmso-ansi-language:FR;mso-bidi-font-weight:bold\">BLANDINE<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;\r\nmso-bidi-font-family:Georgia;mso-bidi-font-weight:bold\">10.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-size:12.0pt;mso-bidi-font-size:11.0pt;line-height:115%;\r\nfont-family:&quot;Georgia&quot;,serif\">PATRICIA&nbsp;</span><span lang=\"EN-US\" style=\"font-family:&quot;Georgia&quot;,serif;mso-bidi-font-weight:bold\"><o:p></o:p></span></p><p class=\"MsoNormal\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">Mages (3)&nbsp;</span></b><span style=\"font-family:&quot;Georgia&quot;,serif;mso-bidi-font-weight:bold\"><o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;\r\nmso-bidi-font-family:Georgia;mso-bidi-font-weight:bold\">11.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Georgia&quot;,serif;mso-bidi-font-weight:bold\">JULIEN<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;\r\nmso-bidi-font-family:Georgia;mso-bidi-font-weight:bold\">12.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Georgia&quot;,serif;mso-bidi-font-weight:bold\">SHAMMAH<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><b><span lang=\"EN-US\" style=\"font-family:&quot;Georgia&quot;,serif;mso-fareast-font-family:Georgia;\r\nmso-bidi-font-family:Georgia\">13.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp; </span></span></b><!--[endif]--><b><span lang=\"EN-US\" style=\"font-family:&quot;Georgia&quot;,serif\">&nbsp;</span></b></p><p class=\"MsoNormal\"><b><span style=\"font-family:&quot;Georgia&quot;,serif\">Indications&nbsp;:\r\n<o:p></o:p></span></b></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\"><span style=\"font-family:&quot;Georgia&quot;,serif;mso-bidi-font-weight:\r\nbold\">En bleu, le narratif de la scène et les attitudes.<o:p></o:p></span></p>', '', 15, '25', '2021-12-07 14:23:50'),
(6, '<p class=\"MsoNormal\" style=\"margin-top:0in;margin-right:0in;margin-bottom:7.95pt;\r\nmargin-left:-.25pt\"><span lang=\"FR\">L’idée globale\r\nest de concevoir une plateforme collaborative d’entreprise pour permettre une <u>communication centralisée</u> et <u>simplifiée</u> de tous les acteurs de MDFAC\r\nœuvrant dans l’acquisition des marchés, l’élaboration des propositions jusqu’à\r\nla mise en œuvre du projet/mission.&nbsp;&nbsp;<o:p></o:p></span></p>', '', 20, '27', '2021-12-07 15:31:12'),
(7, '', '', 25, '29', '2021-12-07 15:42:56'),
(8, '', 'W_Dev.docx', 25, '29', '2021-12-07 15:43:25'),
(9, '<p>kjwdjkndiqjedksndjnak</p>', '', 15, '25', '2021-12-07 16:20:18'),
(10, '<p><span style=\"font-family: Verdana;\">?</span><span style=\"-webkit-tap-highlight-color: rgba(26, 26, 26, 0.3); -webkit-text-size-adjust: auto; caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-family: UICTFontTextStyleBody; font-size: 17px; background-color: rgb(255, 255, 255);\"><b>Bonjour Shekinah</b>, nous vous remercions d\'avoir participé dans la phase Proposition du projet Hopital General. Vous pouvez passer encore votre demande pour la phase suivante ici&nbsp;</span><span dir=\"ltr\" style=\"caret-color: rgb(0, 0, 0); -webkit-tap-highlight-color: rgba(26, 26, 26, 0.3); -webkit-text-size-adjust: auto; font-family: UICTFontTextStyleBody; font-size: 17px; background-color: rgb(255, 255, 0);\"><font color=\"#000000\">http://192.168.43.222:81/mdf/dist//list_projet.php</font></span><br></p>', '', 8, '18', '2021-12-07 16:48:26'),
(11, '<p>bonjour bonjour jbvjhbfej</p>', '', 8, '18', '2021-12-07 17:05:24'),
(12, '<p><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">jhshgjjkfksjgoirgjsfjkgsfjghjs</font></font></p>', '', 28, '18', '2021-12-07 17:28:22');

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
(29, 'Andre', 'safariandre66@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'IMG-20210413-WA0036.jpg', 23, NULL, '', '2021-12-07 10:20:36', NULL, NULL, NULL, NULL, '1'),
(30, 'Shekinah', 'shekinahmalekani@icloud.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', NULL, 4, '', '2021-12-07 11:25:18', NULL, NULL, NULL, NULL, '2');

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
  ADD PRIMARY KEY (`id_rapport`),
  ADD KEY `fk_Rapport_aff` (`code_affectation`);

--
-- Indexes for table `tbl_rapport_complet`
--
ALTER TABLE `tbl_rapport_complet`
  ADD PRIMARY KEY (`id_Rapport_c`),
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
  MODIFY `id_affectation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_detailprojet`
--
ALTER TABLE `tbl_detailprojet`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_etape`
--
ALTER TABLE `tbl_etape`
  MODIFY `id_etape` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_fichier`
--
ALTER TABLE `tbl_fichier`
  MODIFY `id_fichier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_fonction`
--
ALTER TABLE `tbl_fonction`
  MODIFY `id_fonction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_partenaire`
--
ALTER TABLE `tbl_partenaire`
  MODIFY `id_partenaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `tbl_rapport`
--
ALTER TABLE `tbl_rapport`
  MODIFY `id_rapport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_rapport_complet`
--
ALTER TABLE `tbl_rapport_complet`
  MODIFY `id_Rapport_c` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_telephone`
--
ALTER TABLE `tbl_telephone`
  MODIFY `id_telephone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
