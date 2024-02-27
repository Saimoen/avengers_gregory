-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: avengers_gregory
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `livre`
--

DROP TABLE IF EXISTS `livre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int DEFAULT NULL,
  `auteur_id_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AC634F9975F8742E` (`auteur_id_id`),
  CONSTRAINT `FK_AC634F9975F8742E` FOREIGN KEY (`auteur_id_id`) REFERENCES `auteur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livre`
--

LOCK TABLES `livre` WRITE;
/*!40000 ALTER TABLE `livre` DISABLE KEYS */;
INSERT INTO `livre` VALUES (1,'L\'Odyssée d\'une étoile',2019,NULL),(2,'Les Murmures du Passé',2015,NULL),(3,'Entre Ciel et Terre',2020,NULL),(4,'Le Secret des Saisons',2018,NULL),(5,'Voyage vers l\'Inconnu',2022,NULL),(6,'Éclats de Lumière',2017,NULL),(7,'Le Fil du Destin',2016,NULL),(8,'Au-delà des Étoiles',2014,NULL),(9,'Les Rêves Interdits',2023,NULL),(10,'Les Portes du Temps',2021,NULL),(116,'Livre n°0',2015,NULL),(117,'Livre n°1',2020,NULL),(118,'Livre n°2',1984,NULL),(119,'Livre n°3',1999,NULL),(120,'Livre n°4',2017,NULL),(121,'Livre n°5',2020,NULL),(122,'Livre n°6',1981,NULL),(123,'Livre n°7',2007,NULL),(124,'Livre n°8',1986,NULL),(125,'Livre n°9',1991,NULL),(126,'Livre n°10',1980,NULL),(127,'Livre n°11',2000,NULL),(128,'Livre n°12',2015,NULL),(129,'Livre n°13',1988,NULL),(130,'Livre n°14',1988,NULL),(176,'Livre1',2,56),(177,'Livre2',2,57),(178,'Livre3',2,58),(179,'Livre4',2,59),(180,'Livre5',2,60),(181,'Titre du livre',NULL,NULL),(182,'Titre du livre',NULL,NULL),(183,'Titre du livre',NULL,NULL),(184,'Titre du livre',NULL,NULL),(185,'Titre du livre',NULL,NULL);
/*!40000 ALTER TABLE `livre` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-27 18:48:10
