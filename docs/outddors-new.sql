CREATE DATABASE  IF NOT EXISTS `outdoors` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `outdoors`;
-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: outdoors
-- ------------------------------------------------------
-- Server version	5.7.36

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
-- Table structure for table `commune`
--

DROP TABLE IF EXISTS `commune`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commune` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `municipality_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `municipality_id` (`municipality_id`),
  CONSTRAINT `commune_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `municipality` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commune`
--

LOCK TABLES `commune` WRITE;
/*!40000 ALTER TABLE `commune` DISABLE KEYS */;
INSERT INTO `commune` VALUES (1,'Benfica',6),(2,'Viana ',4),(3,'Calumbo',4),(4,'Dangereux',6),(5,'Paraiso',8),(6,'Kwanzas',8),(7,'Vila Alice',8),(8,'Maculusso',8);
/*!40000 ALTER TABLE `commune` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `customer_type_id` int(11) NOT NULL,
  `commune_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `activity` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nationality_id` (`nationality_id`),
  KEY `customer_type_id` (`customer_type_id`),
  KEY `user_id` (`user_id`),
  KEY `commune_id` (`commune_id`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`nationality_id`) REFERENCES `nationality` (`id`),
  CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`customer_type_id`) REFERENCES `customer_type` (`id`),
  CONSTRAINT `customer_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `customer_ibfk_4` FOREIGN KEY (`commune_id`) REFERENCES `commune` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (3,'Jose Domingos 1','95585585',1,2,1,15,'Avenida 21 de Janeiro',''),(4,'Helena','944666640',1,2,1,19,'Luanda',''),(5,'jhjh','944666640',1,1,1,21,'jiuiuiui','iijkjkk'),(6,'José Dominos Cassua Ndonge','944666640',1,1,1,22,'testes','teste teste3'),(7,'Mohamed Ture','944666640',1,2,1,34,'Viana',''),(8,'dgsg','944666640',1,1,1,35,'sdgdsg','sdfsdf'),(9,'Walfina','944666640',1,2,1,36,'Rest e Rest Full',''),(10,'Jurelma','944666640',1,1,1,37,'Rua 1','wasdasd'),(11,'Rivaldo','944666640',1,1,1,38,'dsfgdsfg','asdafsdf'),(12,'ghyju','944666640',1,1,1,45,'rfygh','fgthyju'),(13,'Kudiezo','944666640',1,2,1,46,'Luanda 23',''),(14,'kusghds','944666640',1,2,4,47,'Luanda',''),(15,'ezedelho','944666640',1,2,2,48,'Luanda',''),(16,'fdldklf','944666640',1,2,4,55,'Luanda','');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_type`
--

DROP TABLE IF EXISTS `customer_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_type`
--

LOCK TABLES `customer_type` WRITE;
/*!40000 ALTER TABLE `customer_type` DISABLE KEYS */;
INSERT INTO `customer_type` VALUES (1,'Empresa'),(2,'Particular');
/*!40000 ALTER TABLE `customer_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `commune_id` int(11) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES (14,'Helena Amor',1,'9554455','Luanda',39),(15,'Helena Rest',1,'9465454','sdfsfsdf',40),(16,'Boia',4,'985555','sdsfdsf',41),(17,'Tuxa',4,'45436546456','Luanda',42),(18,'Fina',4,'12324234','Final 7282',43),(19,'Rui',4,'9484785','Dangereux12',44),(20,'Teste',1,'936373','luanda',49),(21,'teste',1,'97737','luan',53),(22,'Teste',4,'97363','123',54),(23,'dasd323',1,'94466623','Luanda',63),(24,'teste004',1,'94462332344','Luanda',65),(25,'Helena Lucas',2,'123','123',66);
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipality`
--

DROP TABLE IF EXISTS `municipality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `municipality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `province_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `province_id` (`province_id`),
  CONSTRAINT `municipality_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipality`
--

LOCK TABLES `municipality` WRITE;
/*!40000 ALTER TABLE `municipality` DISABLE KEYS */;
INSERT INTO `municipality` VALUES (1,'Cacuaco',8),(2,'Alto Cauale',2),(3,'Alto Zambeze',4),(4,'Viana',8),(5,'Cazenga',8),(6,'Talatona',8),(7,'Maianga',8),(8,'Xá-Muteba',7),(9,'Pango Aluquém',13),(10,'Quirima',5),(11,'Cuemba',14),(12,'Buco-Zau',15),(13,'Nambuangongo',13),(14,'Samba Caju',16);
/*!40000 ALTER TABLE `municipality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nationality`
--

DROP TABLE IF EXISTS `nationality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nationality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nationality`
--

LOCK TABLES `nationality` WRITE;
/*!40000 ALTER TABLE `nationality` DISABLE KEYS */;
INSERT INTO `nationality` VALUES (1,'Angolana');
/*!40000 ALTER TABLE `nationality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outdoor`
--

DROP TABLE IF EXISTS `outdoor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `outdoor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipoId` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `status` varchar(45) NOT NULL,
  `communeId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outdoor`
--

LOCK TABLES `outdoor` WRITE;
/*!40000 ALTER TABLE `outdoor` DISABLE KEYS */;
INSERT INTO `outdoor` VALUES (4,3,200,'DisponÃ­vel',2),(5,3,200,'DisponÃ­vel',2),(6,3,200,'DisponÃ­vel',2),(7,1,6000,'DisponÃ­vel',3);
/*!40000 ALTER TABLE `outdoor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outdoor_type`
--

DROP TABLE IF EXISTS `outdoor_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `outdoor_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outdoor_type`
--

LOCK TABLES `outdoor_type` WRITE;
/*!40000 ALTER TABLE `outdoor_type` DISABLE KEYS */;
INSERT INTO `outdoor_type` VALUES (3,'Faixadas'),(5,'Lampoles'),(1,'Paineis Luminosos'),(2,'Paineis Não Luminosos'),(4,'Placas \nIndicativas');
/*!40000 ALTER TABLE `outdoor_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (1,'Zaire'),(2,'Uige'),(3,'Namibe'),(4,'Moxico'),(5,'Malanje'),(6,'Lunda Sul'),(7,'Lunda Norte'),(8,'Luanda'),(9,'Huila'),(10,'Huambo'),(11,'Cunene'),(12,'Cuanza Sul'),(13,'Bengo'),(14,'Bié'),(15,'Cabinda'),(16,'Cuanza Norte');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `status` enum('0','1') DEFAULT '0',
  `access` enum('admin','normal','manager') DEFAULT 'normal',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (15,'josedomingos919','123','josedomingos919@gmail.com','1','normal'),(19,'josedomingos818','123','josedomingos919@gmail.com','1','normal'),(20,'admin','admin','admin@gmail.com','1','admin'),(21,'helena123','123','helena12@gmail.com','1','normal'),(22,'rest919','123','rest919@gmail.com','1','normal'),(34,'mamedi','123','mamedi@gmail.com','1','normal'),(35,'sdgdfgfdg','123','dfgdg@gmail.com','0','normal'),(36,'rest536sys','123','josedomingos919@gmail.com','0','normal'),(37,'ju123','123','josedomingos919@gmail.com','0','normal'),(38,'safsdfs','123','josedomingos919@gmail.com','0','normal'),(39,'admin123','123','josedomingos919@gmail.com','1','manager'),(40,'ters2733','123','josedomingos919@gmail.com','0','manager'),(41,'sdfsdfsd','123','josedomingos919@gmail.com','0','manager'),(42,'user233','user233','j@gmail.com','0','manager'),(43,'fina12','123','fina@gmail.com','0','manager'),(44,'rui123','123','josedomingos919@gmail.com','0','manager'),(45,'123','123','josedomingos919@gmail.com','0','normal'),(46,'kudiezo','123','josedomingos919@gmail.com','0','normal'),(47,'ezedelho','123','jose@gmail.com','0','normal'),(48,'ezede123','123','ez123@gmail.com','0','normal'),(49,'ezed11','123','ez@gmail.com','0','manager'),(53,'123hhs','123','josedomingos919@gmail.com','0','manager'),(54,'user12666','123','jose@gmail.cm','0','manager'),(55,'user40','123','jose@gmail.com','0','normal'),(63,'teste002','teste002','teste002@gmail.com','0','manager'),(65,'teste004','teste004','teste004@gmail.com','0','manager'),(66,'Helena232323','1234','Helena232323@gmail.com','1','manager');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-12 22:19:26
