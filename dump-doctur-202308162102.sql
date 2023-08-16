-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: doctur
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ami`
--

DROP TABLE IF EXISTS `ami`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ami` (
  `from-user` int NOT NULL,
  `to-user` int NOT NULL,
  `accept-demande` varchar(4) DEFAULT NULL,
  `date-demande` date DEFAULT NULL,
  PRIMARY KEY (`to-user`,`from-user`),
  KEY `from-user FK` (`from-user`),
  CONSTRAINT `from-user FK` FOREIGN KEY (`from-user`) REFERENCES `utilisateurs` (`id`),
  CONSTRAINT `to-user FK` FOREIGN KEY (`to-user`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ami`
--

LOCK TABLES `ami` WRITE;
/*!40000 ALTER TABLE `ami` DISABLE KEYS */;
/*!40000 ALTER TABLE `ami` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dossier` (
  `idDossier` int NOT NULL AUTO_INCREMENT,
  `idUser` int DEFAULT NULL,
  `nomDossier` varchar(30) DEFAULT NULL,
  `sousNomDossier` varchar(30) DEFAULT NULL,
  `descriptionDossier` varchar(100) DEFAULT NULL,
  `nbrFichiers` int DEFAULT '0',
  `ajoutPassword` int DEFAULT '0',
  `passwordDossier` text,
  `fav` int DEFAULT NULL,
  PRIMARY KEY (`idDossier`),
  KEY `dossier_FK` (`idUser`),
  CONSTRAINT `dossier_FK` FOREIGN KEY (`idUser`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dossier`
--

LOCK TABLES `dossier` WRITE;
/*!40000 ALTER TABLE `dossier` DISABLE KEYS */;
INSERT INTO `dossier` VALUES (1,2,'b3','cyber',NULL,0,0,NULL,1),(2,2,'rgpd','b3',NULL,0,0,NULL,1),(3,1,'aaaa','bb',NULL,0,0,NULL,NULL),(4,1,'bbbb','aaa',NULL,0,0,NULL,NULL),(5,2,'hugo','b3',NULL,0,0,NULL,1),(6,2,'test','cyber',NULL,0,0,NULL,NULL),(7,2,'gsgq','sd',NULL,0,0,NULL,NULL),(8,2,'fdshsdh','jgf',NULL,0,0,NULL,NULL);
/*!40000 ALTER TABLE `dossier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fichiers`
--

DROP TABLE IF EXISTS `fichiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fichiers` (
  `idFichier` int NOT NULL AUTO_INCREMENT,
  `idDossier` int DEFAULT NULL,
  `nomFichier` varchar(30) DEFAULT NULL,
  `cheminFichier` text,
  `tailleFichier` text,
  `dateAjout` date DEFAULT NULL,
  PRIMARY KEY (`idFichier`),
  KEY `fichiers_FK` (`idDossier`),
  CONSTRAINT `fichiers_FK` FOREIGN KEY (`idDossier`) REFERENCES `dossier` (`idDossier`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichiers`
--

LOCK TABLES `fichiers` WRITE;
/*!40000 ALTER TABLE `fichiers` DISABLE KEYS */;
INSERT INTO `fichiers` VALUES (13,2,'salut.png','../images/private/utilisateurs/wayz/rgpd/salut.png',NULL,'2023-02-24'),(14,3,'b3.png','../images/private/utilisateurs/Kuma/aaaa/b3.png',NULL,'2023-02-24'),(15,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(16,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(17,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(18,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(19,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(20,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(21,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(22,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(23,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(24,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(25,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(26,2,'b3.png','../images/private/utilisateurs/wayz/rgpd/b3.png',NULL,'2023-02-24'),(27,2,'hhhhhhhhhh.pdf','../images/private/utilisateurs/wayz/rgpd/hhhhhhhhhh.pdf','158956','2023-02-24'),(28,2,'gufu.png','../images/private/utilisateurs/wayz/rgpd/gufu.png','264959','2023-02-25'),(29,5,'regles_rgpd.pdf','../images/private/utilisateurs/wayz/hugo/regles_rgpd.pdf','158956','2023-02-25'),(31,1,'zararfsq.png','../images/private/utilisateurs/wayz/b3/zararfsq.png','8051','2023-08-11');
/*!40000 ALTER TABLE `fichiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rang` int DEFAULT '0',
  `pseudo` varchar(20) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `localisation` varchar(30) DEFAULT NULL,
  `biographie` varchar(100) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'default_avatar.jpg',
  `banniere` varchar(100) DEFAULT NULL,
  `password` text,
  `add-friend` int DEFAULT '1',
  `show-loca` int DEFAULT '1',
  `token` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,0,'Kuma',NULL,NULL,NULL,NULL,'kuma@gmail.com','default_avatar.jpg','default_banner_2.jpg','$argon2id$v=19$m=65536,t=4,p=1$cTllNnJvYXBzLmdsOTBVNQ$JRJqmC17N7cLQvPi3SzZXjovK7nvi7X0O002/nkI8V8',1,1,NULL),(2,0,'wayz',NULL,'Théo',NULL,NULL,'wayzzy59@gmail.com','default_avatar.jpg','default_banner_8.jpg','$argon2id$v=19$m=65536,t=4,p=1$ZEIwRkZOLkdwZ0I2TmpiRQ$Bk7xS/x34HuccNezh2ZzlO5V+kfn0HMOF5Q+3+p7hpo',1,1,'8sy6Q5tznokfFuiVKHqJIcsrq1kbt1mk3AEksb42Gnv0dNlIjH3jbYg0CKoCEJZAa8Trmp6JeokYa4RDWkjjULROPsdh63nktIHM');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'doctur'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-16 21:02:10
