-- MySQL dump 10.13  Distrib 9.1.0, for Win64 (x86_64)
--
-- Host: localhost    Database: figurine_trinitas_db
-- ------------------------------------------------------
-- Server version	9.1.0

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
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20261006080115','2026-10-06 08:07:15',158);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `figurines`
--

DROP TABLE IF EXISTS `figurines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `figurines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` longtext,
  `image_name` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45D9EB61A76ED395` (`user_id`),
  CONSTRAINT `FK_45D9EB61A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `figurines`
--

LOCK TABLES `figurines` WRITE;
/*!40000 ALTER TABLE `figurines` DISABLE KEYS */;
INSERT INTO `figurines` VALUES (1,'Dark Vador et ses stormtroopers','Figurines Hot Toys à l\'échelle 1/6. Dark Vador surveille deux stormtroopers en pleine discussion. Photo prise en extérieur pour profiter de la lumière naturelle.','https://images.unsplash.com/photo-1608889825103-eb5ed706fc64?auto=format&fit=crop&w=900&q=80','2026-09-22 08:07:18','2026-09-22 08:07:18',3),(2,'Stormtrooper perdu dans le désert','Minifigurine LEGO Stormtrooper laissant ses traces dans le sable. Une mise en scène toute simple mais que j\'adore.','https://images.unsplash.com/photo-1472457897821-70d3819a0e24?auto=format&fit=crop&w=900&q=80','2026-09-23 08:07:18','2026-09-23 08:07:18',3),(3,'Batman - The Dark Knight','Figurine S.H.Figuarts de Batman, version The Dark Knight. Éclairage sombre pour coller à l\'ambiance de Gotham.','https://images.unsplash.com/photo-1531259683007-016a7b628fc3?auto=format&fit=crop&w=900&q=80','2026-09-24 08:07:18','2026-09-24 08:07:18',2),(4,'Baby Groot dans le jardin','Petit Groot en résine, environ 15 cm. Il a trouvé sa place au milieu des plantes du jardin.','https://images.unsplash.com/photo-1559535332-db9971090158?auto=format&fit=crop&w=900&q=80','2026-09-25 08:07:18','2026-09-25 08:07:18',1),(5,'Minion Kevin','Figurine Minion articulée, édition Moi, Moche et Méchant 3. Toujours de bonne humeur sur mon bureau.','https://images.unsplash.com/photo-1593085512500-5d55148d6f0d?auto=format&fit=crop&w=900&q=80','2026-09-26 08:07:18','2026-09-26 08:07:18',1),(6,'Grogu - The Mandalorian','Peluche-figurine de Grogu (Baby Yoda) avec sa petite tunique. Un indispensable pour tout fan de The Mandalorian.','https://images.unsplash.com/photo-1601814933824-fd0b574dd592?auto=format&fit=crop&w=900&q=80','2026-09-27 08:07:18','2026-09-27 08:07:18',2),(7,'Deadpool en garde','Figurine Deadpool Marvel Legends, katana en main. Fond noir pour faire ressortir le rouge du costume.','https://images.unsplash.com/photo-1608889175123-8ee362201f81?auto=format&fit=crop&w=900&q=80','2026-09-28 08:07:18','2026-09-28 08:07:18',3),(8,'Deadpool prend un selfie','Une seconde figurine Deadpool, version chibi avec sa perche à selfie. Impossible de résister à sa tête.','https://images.unsplash.com/photo-1608889335941-32ac5f2041b9?auto=format&fit=crop&w=900&q=80','2026-09-29 08:07:18','2026-09-29 08:07:18',3),(9,'Pikachu géant','Grande figurine Pikachu photographiée lors d\'une convention. Pas la mienne, mais elle méritait une photo !','https://images.unsplash.com/photo-1609372332255-611485350f25?auto=format&fit=crop&w=900&q=80','2026-09-30 08:07:18','2026-09-30 08:07:18',1),(10,'Totoro','Figurine Totoro en vinyle souple, acquise lors d\'un voyage au Japon. Studio Ghibli pour toujours.','https://images.unsplash.com/photo-1611457194403-d3aca4cf9d11?auto=format&fit=crop&w=900&q=80','2026-10-01 08:07:18','2026-10-01 08:07:18',1),(11,'Spider-Man, Iron Man et Captain America','Trio de figurines Marvel en version chibi. Spider-Man est clairement la star de la collection.','https://images.unsplash.com/photo-1608889476561-6242cfdbf622?auto=format&fit=crop&w=900&q=80','2026-10-02 08:07:18','2026-10-02 08:07:18',2),(12,'Stormtrooper à dos de tortue','Mise en scène humoristique : un stormtrooper qui part en patrouille sur une tortue. Photo macro dans le jardin.','https://images.unsplash.com/photo-1608889825205-eebdb9fc5806?auto=format&fit=crop&w=900&q=80','2026-10-03 08:07:18','2026-10-03 08:07:18',2),(13,'Abbey Road version LEGO','Hommage à la célèbre pochette des Beatles avec des minifigurines LEGO, photographié sur un vrai passage piéton.','https://images.unsplash.com/photo-1585366119957-e9730b6d0f60?auto=format&fit=crop&w=900&q=80','2026-10-04 08:07:18','2026-10-04 08:07:18',1),(14,'Grogu en forêt',NULL,'https://images.unsplash.com/photo-1618336753974-aae8e04506aa?auto=format&fit=crop&w=900&q=80','2026-10-05 08:07:18','2026-10-05 08:07:18',3);
/*!40000 ALTER TABLE `figurines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `image_name` varchar(500) NOT NULL,
  `is_verified` tinyint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'amina@figurinevie.be','[]','$2y$13$PzSEegbd8ZLPTE6W8GQfBuDvY4og.iO2LCevRNhpfJuT.0vbe8IH2','Amina','Diallo','https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80',1,'2026-10-06 08:07:16','2026-10-06 08:07:16'),(2,'lucas@figurinevie.be','[]','$2y$13$coKZcLdDSeAIP7ABWySUiuZ1ShTC3xZ36I4MjOINKH5LsPuV1jOwG','Lucas','Martin','https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',1,'2026-10-06 08:07:17','2026-10-06 08:07:17'),(3,'trinitas@figurinevie.be','[]','$2y$13$yvay86wknQmfANyRPidGsO1Gdp3IG1r4QbaAkt0v7Azyx1XUZHXbC','Trinitas','Ntirampeba','https://s.widget-club.com/images/YyiR86zpwIMIfrCZoSs4ulVD9RF3/db7b9bf4a9023df64fe7bf1dbd97f711/5f3d76d5ffb06ebfc51b85ffcb8253d5.jpg',1,'2026-10-06 08:07:18','2026-10-06 08:38:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-06 10:46:47
