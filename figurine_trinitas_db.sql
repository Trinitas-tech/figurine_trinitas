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
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20261006080115','2026-10-06 09:17:39',130);
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
INSERT INTO `figurines` VALUES (1,'Chutes de la Karera','Les chutes de la Karera, dans la province de Rutana, forment un ensemble de six cascades au cœur d\'une forêt luxuriante. Site naturel protégé et l\'une des plus belles excursions du sud du pays.','https://commons.wikimedia.org/wiki/Special:FilePath/Chutes_de_Karera_01.jpg?width=900','2026-09-22 09:17:41','2026-09-22 09:17:41',3),(2,'Plage du lac Tanganyika','Paillotes et sable fin au bord du lac Tanganyika, à quelques minutes de Bujumbura. Le deuxième lac le plus profond du monde est le lieu de détente favori des habitants de la capitale.','https://commons.wikimedia.org/wiki/Special:FilePath/Beach_in_Bujumbura.jpg?width=900','2026-09-23 09:17:41','2026-09-23 09:17:41',1),(3,'Bujumbura vue du lac','La ville de Bujumbura s\'étire entre les rives du lac Tanganyika et les collines. Au loin, les montagnes du Congo ferment l\'horizon.','https://commons.wikimedia.org/wiki/Special:FilePath/Bujumbura_%26_Lake_Tanganyika.JPG?width=900','2026-09-24 09:17:41','2026-09-24 09:17:41',2),(4,'Source du Nil à Rutovu','La source la plus méridionale du Nil se trouve à Rutovu, dans la province de Bururi. Une pyramide y a été érigée en 1938 par l\'explorateur Burkhart Waldecker.','https://commons.wikimedia.org/wiki/Special:FilePath/Source_du_Nill.jpg?width=900','2026-09-25 09:17:41','2026-09-25 09:17:41',3),(5,'Hippopotames de la Rusizi','Le parc national de la Rusizi, aux portes de Bujumbura, abrite hippopotames, crocodiles et de nombreux oiseaux dans le delta de la rivière Rusizi.','https://commons.wikimedia.org/wiki/Special:FilePath/Rusizi_NP_hippopotamus.jpg?width=900','2026-09-26 09:17:41','2026-09-26 09:17:41',2),(6,'Cathédrale de Gitega','Gitega, capitale politique du Burundi depuis 2019, abrite le Musée national et cette cathédrale en briques rouges typiques de la région.','https://commons.wikimedia.org/wiki/Special:FilePath/Gitega_Church.JPG?width=900','2026-09-27 09:17:41','2026-09-27 09:17:41',1),(7,'Théiers de Teza','Les plantations de thé de Teza, sur les hauteurs de la Kibira, offrent un paysage de collines d\'un vert intense. Le thé est l\'une des principales exportations du pays.','https://commons.wikimedia.org/wiki/Special:FilePath/Le_th%C3%A9_du_teza_%C3%A0_kibira.jpg?width=900','2026-09-28 09:17:41','2026-09-28 09:17:41',3),(8,'Collines de Teza-Muramvya','Entre Muramvya et la forêt de la Kibira, les collines cultivées descendent en terrasses vers la vallée. Le Burundi est surnommé le pays des mille collines.','https://commons.wikimedia.org/wiki/Special:FilePath/Teza-Muramvya.jpg?width=900','2026-09-29 09:17:41','2026-09-29 09:17:41',1),(9,'Mausolée du prince Rwagasore','Sur la colline de Vugizo, à Bujumbura, le mausolée du prince Louis Rwagasore, héros de l\'indépendance assassiné en 1961, domine la ville et le lac.','https://commons.wikimedia.org/wiki/Special:FilePath/Prince_Rwagasore_Tomb_-_Flickr_-_Dave_Proffer.jpg?width=900','2026-09-30 09:17:41','2026-09-30 09:17:41',2),(10,'Pierre de Livingstone et Stanley','À Mugere, cette pierre marque l\'endroit où, selon la tradition, les explorateurs Livingstone et Stanley ont passé deux nuits en novembre 1871.','https://commons.wikimedia.org/wiki/Special:FilePath/Livingstone_monument_burundi.jpg?width=900','2026-10-01 09:17:41','2026-10-01 09:17:41',3),(11,'Paysage de Rutana','Collines, champs et nuages au-dessus de la province de Rutana. Un exemple des paysages ruraux qui font la beauté du Burundi.','https://commons.wikimedia.org/wiki/Special:FilePath/Burundi_Rutana.jpg?width=900','2026-10-02 09:17:41','2026-10-02 09:17:41',1),(12,'Timbre Louis Rwagasore 1963','Timbre du Royaume du Burundi émis en 1963 en hommage au prince Louis Rwagasore (1932-1961), Premier ministre et père de l\'indépendance.','https://commons.wikimedia.org/wiki/Special:FilePath/BDI_1963_MiNr0044A_pm_B002.jpg?width=900','2026-10-03 09:17:41','2026-10-03 09:17:41',2),(13,'Cathédrale Regina Mundi','La cathédrale Regina Mundi de Bujumbura, avec son clocher élancé, est le principal édifice religieux de la ville.','https://commons.wikimedia.org/wiki/Special:FilePath/Cath%C3%A9drale_Regina_Mundi_de_Bujumbura%2C_2006.jpg?width=900','2026-10-04 09:17:41','2026-10-04 09:17:41',1),(14,'Melchior Ndadaye','Melchior Ndadaye, premier président démocratiquement élu du Burundi en 1993, assassiné la même année. Il est célébré comme héros de la démocratie.','https://www.burundi-forum.org/wp-content/uploads/2019/10/bdi_burundi_ndadaye_2019.jpeg','2026-10-05 09:17:41','2026-10-05 09:17:41',3);
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
INSERT INTO `users` VALUES (1,'amina@figurinevie.be','[]','$2y$13$LnlABfjsxYLAfFC4wIJ2X.emsoFUBSXBzkxeSR3jAAgegD6bk4Ciu','Amina','Diallo','https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80',1,'2026-10-06 09:17:40','2026-10-06 09:17:40'),(2,'lucas@figurinevie.be','[]','$2y$13$EtasSauAXYBIdJMbEAw84e0JeqAOGWQm42RI2ZDfBUwQznF8eUv9O','Lucas','Martin','https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',1,'2026-10-06 09:17:41','2026-10-06 09:17:41'),(3,'trinitas@figurinevie.be','[]','$2y$13$q3DQ08L50CpjjMxMaWcw1eoIC9jZfyR/vGkdfrLYxIDUkZeXTfRRe','Trinitas','Ntirampeba','https://s.widget-club.com/images/YyiR86zpwIMIfrCZoSs4ulVD9RF3/db7b9bf4a9023df64fe7bf1dbd97f711/5f3d76d5ffb06ebfc51b85ffcb8253d5.jpg',1,'2026-10-06 09:17:41','2026-10-06 09:17:41');
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

-- Dump completed on 2026-10-06 11:17:42
