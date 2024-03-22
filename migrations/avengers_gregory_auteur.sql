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
-- Table structure for table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auteur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `livre_id` int DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_55AB14037D925CB` (`livre_id`),
  CONSTRAINT `FK_55AB14037D925CB` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auteur`
--

LOCK TABLES `auteur` WRITE;
/*!40000 ALTER TABLE `auteur` DISABLE KEYS */;
INSERT INTO `auteur` VALUES (1,1,'Dupont','Jean'),(2,2,'Martinee','Soph'),(3,3,'Dubois','Claire'),(4,4,'Lefevre','Paul'),(5,5,'Girard','Isabelle'),(6,6,'Moreau','Pierre'),(7,7,'Roux','Marie'),(8,8,'Leroi','Antoine'),(9,9,'Fournier','Charlotte'),(10,10,'Gagnon','Luc'),(56,NULL,'NomAuteur1','PrenomAuteur1'),(57,NULL,'NomAuteur2','PrenomAuteur2'),(58,NULL,'NomAuteur3','PrenomAuteur3'),(59,NULL,'NomAuteur4','PrenomAuteur4'),(60,NULL,'NomAuteur5','PrenomAuteur5'),(61,181,'Verne','Jules'),(62,182,'Hugo','Léon'),(63,183,'Verne','Emile'),(64,184,'Zola','Emile'),(65,185,'Hugo','Victor'),(66,NULL,'Hugo','Victor'),(67,NULL,'Hugo','Victor'),(68,197,'Nom de l\'auteur','Prenom de l\'auteur'),(69,198,'Nom de l\'auteur','Prenom de l\'auteur'),(70,199,'Nom de l\'auteur','Prenom de l\'auteur'),(71,200,'Nom de l\'auteur','Prenom de l\'auteur'),(72,201,'Nom de l\'auteur','Prenom de l\'auteur'),(73,202,'Nom de l\'auteur','Prenom de l\'auteur'),(74,203,'Nom de l\'auteur','Prenom de l\'auteur'),(75,204,'Nom de l\'auteur','Prenom de l\'auteur'),(76,205,'Nom de l\'auteur','Prenom de l\'auteur'),(77,206,'Nom de l\'auteur','Prenom de l\'auteur'),(78,207,'Nom de l\'auteur','Prenom de l\'auteur'),(79,208,'Nom de l\'auteur','Prenom de l\'auteur'),(80,209,'Nom de l\'auteur','Prenom de l\'auteur');
/*!40000 ALTER TABLE `auteur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-20 11:38:42
