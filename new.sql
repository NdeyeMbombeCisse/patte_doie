-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: patte_doie
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.23.10.1

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
-- Table structure for table `membre`
--

DROP TABLE IF EXISTS `membre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membre` (
  `matricule` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `situation_matrimoniale` enum('celibataire','marie(e)','veuf','veuve','divorce(e)') DEFAULT NULL,
  `sexe` enum('feminin','masculin') DEFAULT NULL,
  `id_quartier` int DEFAULT NULL,
  `id_age` int DEFAULT NULL,
  `id_situation_proff` int DEFAULT NULL,
  PRIMARY KEY (`matricule`),
  KEY `id_quartier` (`id_quartier`),
  KEY `id_age` (`id_age`),
  KEY `id_situation_proff` (`id_situation_proff`),
  CONSTRAINT `membre_ibfk_1` FOREIGN KEY (`id_quartier`) REFERENCES `quartier` (`id`),
  CONSTRAINT `membre_ibfk_2` FOREIGN KEY (`id_age`) REFERENCES `tranche_age` (`id`),
  CONSTRAINT `membre_ibfk_3` FOREIGN KEY (`id_situation_proff`) REFERENCES `tranche_age` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membre`
--

LOCK TABLES `membre` WRITE;
/*!40000 ALTER TABLE `membre` DISABLE KEYS */;
/*!40000 ALTER TABLE `membre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quartier`
--

DROP TABLE IF EXISTS `quartier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quartier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `nombre_membre` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quartier`
--

LOCK TABLES `quartier` WRITE;
/*!40000 ALTER TABLE `quartier` DISABLE KEYS */;
/*!40000 ALTER TABLE `quartier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `situation_professionnelle`
--

DROP TABLE IF EXISTS `situation_professionnelle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `situation_professionnelle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `situation_proff` enum('travailleur','chomeur','retraite') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `situation_professionnelle`
--

LOCK TABLES `situation_professionnelle` WRITE;
/*!40000 ALTER TABLE `situation_professionnelle` DISABLE KEYS */;
/*!40000 ALTER TABLE `situation_professionnelle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tranche_age`
--

DROP TABLE IF EXISTS `tranche_age`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tranche_age` (
  `id` int NOT NULL AUTO_INCREMENT,
  `age` enum('0-18','18-30','30-50','50+') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tranche_age`
--

LOCK TABLES `tranche_age` WRITE;
/*!40000 ALTER TABLE `tranche_age` DISABLE KEYS */;
/*!40000 ALTER TABLE `tranche_age` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-03 16:38:46
