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

-- Listage des données de la table cinema.acteur : ~3 rows (environ)
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 1),
	(2, 2),
	(3, 3);

-- Listage des données de la table cinema.appartient : ~0 rows (environ)

-- Listage des données de la table cinema.casting : ~0 rows (environ)

-- Listage des données de la table cinema.film : ~3 rows (environ)
INSERT INTO `film` (`id_film`, `titre`, `annee`, `duree`, `resume`, `note`, `affiche`) VALUES
	(1, 'Harry Potter and the Philosopher\'s Stone', '2001-01-01', 152, 'Harry Potter, un jeune orphelin maltraité par sa famille adoptive, découvre qu\'il est un sorcier le jour de ses 11 ans. Il rejoint l\'école de sorcellerie Poudlard où il se fait des amis et des ennemis et découvre la vérité sur la mort de ses parents. Avec l\'aide de ses amis, il affronte Voldemort, le sorcier noir responsable de la mort de ses parents.', 5, 'image'),
	(2, 'Harry Potter and the Chamber of Secrets', '2002-01-01', 161, 'De retour pour sa deuxième année à Poudlard, Harry Potter découvre une série d\'attaques mystérieuses pétrifiant les élèves. Avec l\'aide de Ron et Hermione, il découvre l\'existence d\'une chambre secrète renfermant un terrible monstre. Harry doit affronter le danger et sauver ses camarades.', 5, 'image'),
	(3, 'Harry Potter and the Prisoner of Azkaban', '2004-01-01', 142, 'Harry Potter entre en troisième année à Poudlard et apprend que le dangereux prisonnier Sirius Black s\'est échappé d\'Azkaban. Harry découvre que Sirius est lié à la mort de ses parents. Avec l\'aide de ses amis et du professeur Lupin, Harry découvre la vérité sur Sirius et se rapproche de son parrain.', 5, 'image');

-- Listage des données de la table cinema.genre : ~1 rows (environ)
INSERT INTO `genre` (`id_genre`, `libelle`) VALUES
	(1, 'Fantastique ');

-- Listage des données de la table cinema.personne : ~4 rows (environ)
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) VALUES
	(1, 'Radcliffe', 'Daniel', 'H', '1989-07-23'),
	(2, 'Grint', 'Rupert', 'H', '1988-08-24'),
	(3, 'Watson', 'Emma', 'F', '1990-04-24'),
	(4, 'Columbus', 'Chris', 'H', '1958-09-10');

-- Listage des données de la table cinema.realisateur : ~1 rows (environ)
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 4);

-- Listage des données de la table cinema.role : ~3 rows (environ)
INSERT INTO `role` (`id_role`, `nomPersonnage`) VALUES
	(1, 'Harry Potter'),
	(2, 'Ron Weasley'),
	(3, 'Hermione Granger');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
