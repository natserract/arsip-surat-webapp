-- MySQL dump 10.16  Distrib 10.1.30-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: mailchips_db
-- ------------------------------------------------------
-- Server version	10.1.30-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_disposition`
--

DROP TABLE IF EXISTS `tb_disposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_disposition` (
  `id_disposition` int(3) NOT NULL AUTO_INCREMENT,
  `disposition_at` date NOT NULL COMMENT 'tgl_disposisi',
  `reply_at` varchar(35) NOT NULL COMMENT 'tujuan_disposisi',
  `description` text NOT NULL,
  `notification` int(3) NOT NULL COMMENT '1(Penting), 2(Segera), 3(Rahasia)',
  `status` int(3) NOT NULL COMMENT 'status_disposisi',
  `id_mail_in` int(3) NOT NULL,
  `id_user` int(3) NOT NULL COMMENT '	1(Administrator), 2(Receptionist), 3(Head of Agency)',
  PRIMARY KEY (`id_disposition`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_disposition`
--

LOCK TABLES `tb_disposition` WRITE;
/*!40000 ALTER TABLE `tb_disposition` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_disposition` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `on_update_status` AFTER INSERT ON `tb_disposition` FOR EACH ROW UPDATE tb_mail_in SET tb_mail_in.status = 1 WHERE id_mail_in = new.id_mail_in */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tb_mail_in`
--

DROP TABLE IF EXISTS `tb_mail_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_mail_in` (
  `id_mail_in` int(3) NOT NULL AUTO_INCREMENT,
  `incoming_at` date NOT NULL,
  `mail_code` varchar(30) NOT NULL COMMENT 'no_surat',
  `mail_date` date NOT NULL COMMENT 'tgl_surat_dibuat',
  `mail_from` varchar(25) NOT NULL,
  `mail_to` varchar(25) NOT NULL COMMENT 'tujuan',
  `mail_subject` varchar(25) NOT NULL COMMENT 'judul_surat',
  `mail_description` text NOT NULL,
  `file_upload` varchar(50) NOT NULL,
  `status` int(3) NOT NULL COMMENT 'status_disposisi',
  `id_mail_type` int(3) NOT NULL COMMENT '1(Invitation), 2(Official)',
  `id_user` int(3) NOT NULL COMMENT '1(Administrator), 2(Receptionist), 3(Head of Agency)',
  PRIMARY KEY (`id_mail_in`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mail_in`
--

LOCK TABLES `tb_mail_in` WRITE;
/*!40000 ALTER TABLE `tb_mail_in` DISABLE KEYS */;
INSERT INTO `tb_mail_in` VALUES (19,'2018-02-23','9123/12312/21312','2018-02-08','Garuda Indonesia','Google','Subject','Deal deal description','5a8f97139e815.jpg',0,2,1),(20,'2018-02-23','0131/123/123213','2018-02-15','User test','Google','Subject','Description','5a8f9a2e26408.jpg',0,2,1),(21,'2018-02-23','9123/1231231/22','2018-02-21','Garuda Indonesia','Google','Subject','Description','5a8f9d7d3773a.jpg',0,1,1);
/*!40000 ALTER TABLE `tb_mail_in` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `on_delete_mail` AFTER DELETE ON `tb_mail_in` FOR EACH ROW DELETE FROM tb_disposition  WHERE id_mail_in = old.id_mail_in */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tb_mail_out`
--

DROP TABLE IF EXISTS `tb_mail_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_mail_out` (
  `id_mail_out` int(3) NOT NULL AUTO_INCREMENT,
  `mail_code` varchar(30) NOT NULL,
  `mail_date` date NOT NULL,
  `mail_to` varchar(25) NOT NULL,
  `mail_subject` varchar(25) NOT NULL,
  `mail_description` text NOT NULL,
  `file_upload` varchar(50) NOT NULL,
  `id_mail_type` int(3) NOT NULL COMMENT '1(Invitation), 2(Official)',
  `id_user` int(3) NOT NULL COMMENT '1(Administrator), 2(Receptionist), 3(Head of Agency)',
  PRIMARY KEY (`id_mail_out`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mail_out`
--

LOCK TABLES `tb_mail_out` WRITE;
/*!40000 ALTER TABLE `tb_mail_out` DISABLE KEYS */;
INSERT INTO `tb_mail_out` VALUES (8,'8204','2018-02-23','Goole','Alfin','backup','5a8f98bf7694c.pdf',1,1);
/*!40000 ALTER TABLE `tb_mail_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_mail_type`
--

DROP TABLE IF EXISTS `tb_mail_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_mail_type` (
  `id_mail_type` int(3) NOT NULL AUTO_INCREMENT,
  `type` int(3) NOT NULL COMMENT '1(Invitation), 2(Official)',
  PRIMARY KEY (`id_mail_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mail_type`
--

LOCK TABLES `tb_mail_type` WRITE;
/*!40000 ALTER TABLE `tb_mail_type` DISABLE KEYS */;
INSERT INTO `tb_mail_type` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `tb_mail_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user` (
  `id_user` int(3) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(25) NOT NULL COMMENT 'unique',
  `user_password` varchar(255) NOT NULL COMMENT 'md5',
  `fullname` varchar(30) NOT NULL,
  `nip` varchar(35) NOT NULL,
  `level` int(3) NOT NULL COMMENT '1(Administrator), 2(Receptionist), 3(Head of Agency)',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `user_username` (`user_username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','Alfin Surya','0912038120312',1),(7,'resepsionis','13016b898b3877960653191b72b2f03c','Receptionist','0091239123123',2),(8,'disposisi','13bb8b589473803f26a02e338f949b8c','Disposition','001923123123',3);
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_disposition`
--

DROP TABLE IF EXISTS `view_disposition`;
/*!50001 DROP VIEW IF EXISTS `view_disposition`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_disposition` (
  `id_mail_in` tinyint NOT NULL,
  `incoming_at` tinyint NOT NULL,
  `mail_code` tinyint NOT NULL,
  `mail_date` tinyint NOT NULL,
  `mail_from` tinyint NOT NULL,
  `mail_to` tinyint NOT NULL,
  `mail_subject` tinyint NOT NULL,
  `mail_description` tinyint NOT NULL,
  `id_mail_type` tinyint NOT NULL,
  `id_disposition` tinyint NOT NULL,
  `disposition_at` tinyint NOT NULL,
  `reply_at` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `notification` tinyint NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `view_disposition`
--

/*!50001 DROP TABLE IF EXISTS `view_disposition`*/;
/*!50001 DROP VIEW IF EXISTS `view_disposition`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_disposition` AS select `tb_mail_in`.`id_mail_in` AS `id_mail_in`,`tb_mail_in`.`incoming_at` AS `incoming_at`,`tb_mail_in`.`mail_code` AS `mail_code`,`tb_mail_in`.`mail_date` AS `mail_date`,`tb_mail_in`.`mail_from` AS `mail_from`,`tb_mail_in`.`mail_to` AS `mail_to`,`tb_mail_in`.`mail_subject` AS `mail_subject`,`tb_mail_in`.`mail_description` AS `mail_description`,`tb_mail_in`.`id_mail_type` AS `id_mail_type`,`tb_disposition`.`id_disposition` AS `id_disposition`,`tb_disposition`.`disposition_at` AS `disposition_at`,`tb_disposition`.`reply_at` AS `reply_at`,`tb_disposition`.`description` AS `description`,`tb_disposition`.`notification` AS `notification`,`tb_disposition`.`status` AS `status` from (`tb_mail_in` join `tb_disposition` on((`tb_mail_in`.`id_mail_in` = `tb_disposition`.`id_mail_in`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-23 12:56:57
