Anatom-Easy
===========

PHP (symphony 2.0) web application providing an easy way for children (7-12) to learn about anatomy and be followed/oriented by their teachers. 

insert into sql base

 
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `anatomeasy`
--

--
-- Contenu de la table `Level`
--

INSERT INTO `Level` (`id`) VALUES
('CE1'),
('CE2'),
('CM1'),
('CM2');

--
-- Contenu de la table `Subjects`
--

INSERT INTO `Subjects` (`id`) VALUES
('La digestion'),
('La respiration'),
('Le système immunitaire');

--
-- Contenu de la table `Type`
--

INSERT INTO `Type` (`id`) VALUES
('Puzzle');

--
-- Contenu de la table `Exercice`
--

INSERT INTO `Exercice` (`id`, `type_id`, `level_id`, `subjects_id`) VALUES
(1, 'Puzzle', 'CE1', 'La digestion'),
(2, 'Puzzle', 'CE2', 'La digestion'),
(3, 'Puzzle', 'CM1', 'La digestion'),
(4, 'Puzzle', 'CM2', 'La digestion'),
(5, 'Puzzle', 'CE1', 'La respiration'),
(6, 'Puzzle', 'CE2', 'La respiration'),
(7, 'Puzzle', 'CM1', 'La respiration'),
(8, 'Puzzle', 'CM2', 'La respiration'),
(9, 'Puzzle', 'CE1', 'Le système immunitaire'),
(10, 'Puzzle', 'CE2', 'Le système immunitaire'),
(11, 'Puzzle', 'CM1', 'Le système immunitaire'),
(12, 'Puzzle', 'CM2', 'Le système immunitaire');

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`id`, `group_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES

(1, NULL, 'prof', 'prof', 'prof@ecole.fr', 'prof@ecole.fr', 1, '374td0mwlekggkcswg0sccgg48ksg0s', 'prof{374td0mwlekggkcswg0sccgg48ksg0s}', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:12:"ROLE_TEACHER";}', 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
