-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema`;

-- Listage de la structure de table cinema. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_acteur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.acteur : ~0 rows (environ)
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 7),
	(5, 8),
	(6, 9);

-- Listage de la structure de table cinema. appartient
CREATE TABLE IF NOT EXISTS `appartient` (
  `id_genre` int NOT NULL,
  `id_film` int NOT NULL,
  KEY `id_genre` (`id_genre`),
  KEY `id_film` (`id_film`),
  CONSTRAINT `FK__genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`),
  CONSTRAINT `FK_appartient_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.appartient : ~0 rows (environ)
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(2, 1),
	(2, 2),
	(2, 3),
	(4, 4),
	(4, 5),
	(2, 4),
	(2, 5),
	(3, 4),
	(3, 5);

-- Listage de la structure de table cinema. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `id_film` int NOT NULL,
  `id_acteur` int NOT NULL,
  `id_role` int NOT NULL,
  KEY `id_film` (`id_film`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `FK__acteur` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `FK__film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK__role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.casting : ~0 rows (environ)
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 1),
	(1, 3, 3),
	(1, 2, 2),
	(2, 1, 1),
	(2, 2, 2),
	(2, 3, 3),
	(3, 1, 1),
	(3, 2, 2),
	(3, 3, 3),
	(4, 4, 4),
	(4, 5, 5),
	(4, 6, 7),
	(5, 4, 4),
	(5, 5, 5),
	(5, 6, 7);

-- Listage de la structure de table cinema. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) NOT NULL DEFAULT '0',
  `annee` date NOT NULL,
  `duree` int NOT NULL DEFAULT '0',
  `resume` text NOT NULL,
  `note` int NOT NULL,
  `affiche` varchar(255) NOT NULL,
  `id_realisateur` int DEFAULT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `FK_film_realisateur` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.film : ~0 rows (environ)
INSERT INTO `film` (`id_film`, `titre`, `annee`, `duree`, `resume`, `note`, `affiche`, `id_realisateur`) VALUES
	(1, 'Harry Potter and the Philosopher\'s Stone', '2001-01-01', 152, 'Harry Potter, un jeune orphelin maltraité par sa famille adoptive, découvre qu\'il est un sorcier le jour de ses 11 ans. Il rejoint l\'école de sorcellerie Poudlard où il se fait des amis et des ennemis et découvre la vérité sur la mort de ses parents. Avec l\'aide de ses amis, il affronte Voldemort, le sorcier noir responsable de la mort de ses parents.', 5, 'image', 1),
	(2, 'Harry Potter and the Chamber of Secrets', '2002-01-01', 161, 'De retour pour sa deuxième année à Poudlard, Harry Potter découvre une série d\'attaques mystérieuses pétrifiant les élèves. Avec l\'aide de Ron et Hermione, il découvre l\'existence d\'une chambre secrète renfermant un terrible monstre. Harry doit affronter le danger et sauver ses camarades.', 5, 'image', 1),
	(3, 'Harry Potter and the Prisoner of Azkaban', '2004-01-01', 142, 'Harry Potter entre en troisième année à Poudlard et apprend que le dangereux prisonnier Sirius Black s\'est échappé d\'Azkaban. Harry découvre que Sirius est lié à la mort de ses parents. Avec l\'aide de ses amis et du professeur Lupin, Harry découvre la vérité sur Sirius et se rapproche de son parrain.', 5, 'image', 1),
	(4, 'Avatar', '2009-12-18', 162, 'Un marine paraplégique est envoyé sur la planète Pandora en mission mais se retrouve déchiré entre suivre ses ordres et protéger le monde qu\'il ressent comme son chez-soi.', 5, 'image', 2),
	(5, 'Avatar: La Voie de l\'eau', '2022-12-16', 192, 'Jake Sully vit désormais avec sa nouvelle famille sur Pandora. Lorsque surgit une ancienne menace, il doit collaborer avec Neytiri et l\'armée Na\'vi pour protéger leur planète.', 5, 'image', 2);

-- Listage de la structure de table cinema. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.genre : ~0 rows (environ)
INSERT INTO `genre` (`id_genre`, `libelle`) VALUES
	(1, 'Fantastique '),
	(2, 'Aventure'),
	(3, 'Action'),
	(4, 'Science-Fiction');

-- Listage de la structure de table cinema. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `sexe` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.personne : ~0 rows (environ)
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) VALUES
	(1, 'Radcliffe', 'Daniel', 'H', '1989-07-23'),
	(2, 'Grint', 'Rupert', 'H', '1988-08-24'),
	(3, 'Watson', 'Emma', 'F', '1990-04-24'),
	(4, 'Columbus', 'Chris', 'H', '1958-09-10'),
	(6, 'Cameron', 'James', 'M', '1954-08-16'),
	(7, 'Worthington', 'Sam', 'M', '1976-08-02'),
	(8, 'Saldana', 'Zoe', 'F', '1978-06-19'),
	(9, 'Weaver', 'Sigourney', 'F', '1949-10-08');

-- Listage de la structure de table cinema. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_realisateur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.realisateur : ~0 rows (environ)
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 4),
	(2, 6);

-- Listage de la structure de table cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nomPersonnage` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.role : ~0 rows (environ)
INSERT INTO `role` (`id_role`, `nomPersonnage`) VALUES
	(1, 'Harry Potter'),
	(2, 'Ron Weasley'),
	(3, 'Hermione Granger'),
	(4, 'Jake Sully'),
	(5, 'Neytiri'),
	(6, 'Dr. Grace Augustine'),
	(7, 'Kiri');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
