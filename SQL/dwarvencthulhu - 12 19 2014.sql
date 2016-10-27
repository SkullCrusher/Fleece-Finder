CREATE DATABASE  IF NOT EXISTS `dwarvencthulhu` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dwarvencthulhu`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: dwarvencthulhu
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `logging_receipt`
--

DROP TABLE IF EXISTS `logging_receipt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logging_receipt` (
  `id` bigint(20) NOT NULL,
  `json_receipt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logging_receipt`
--

LOCK TABLES `logging_receipt` WRITE;
/*!40000 ALTER TABLE `logging_receipt` DISABLE KEYS */;
/*!40000 ALTER TABLE `logging_receipt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_abbreviated`
--

DROP TABLE IF EXISTS `product_abbreviated`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_abbreviated` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `json_condensed` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_abbreviated`
--

LOCK TABLES `product_abbreviated` WRITE;
/*!40000 ALTER TABLE `product_abbreviated` DISABLE KEYS */;
INSERT INTO `product_abbreviated` VALUES (114,'{\"title\":\"()()()() title bro ()()()()\",\"owner\":\"user\",\"short_description\":\"()()()() title bro ()()(()()()() title bro ()()()()()()()() title bro ()()()())()\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(115,'{\"title\":\"zzzzzzzzz\",\"owner\":\"user\",\"short_description\":\"zzzzzzzzzzzzzzzzzz\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(116,'{\"title\":\"xzzzzzzzzzzzzzz\",\"owner\":\"user\",\"short_description\":\"xzzzzzzzzzzzzzz\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(117,'{\"title\":\"zxzzzzzzzzzzzzzzz\",\"owner\":\"user\",\"short_description\":\"zxzzzzzzzzzzzzzzz\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(118,'{\"title\":\"aaaaaaaaaaaaaaaaaa\",\"owner\":\"user\",\"short_description\":\"aaaaaaaaaaaa\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(119,'{\"title\":\"aaaaaaaaaaaaaaaaaa\",\"owner\":\"user\",\"short_description\":\"aaaaaaaaaaaaaaaaaa\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(120,'{\"title\":\"aaaaaaaaaaaaaaaaaa\",\"owner\":\"user\",\"short_description\":\"aaaaaaaaaaaaaaaaaa\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(121,'{\"title\":\"aaaaaaaaaaaaaaaaaa\",\"owner\":\"user\",\"short_description\":\"aaaaaaaaaaaaaaaaaa\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(122,'{\"title\":\"explosive hand knit bomb\",\"owner\":\"user\",\"short_description\":\"A BOMB TO BLOW UP PEOPLE\",\"category\":\"Hand knit\",\"price\":1002,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(123,'{\"title\":\"()()()() title bro ()()()()\",\"owner\":\"user\",\"short_description\":\"aaaaaaaaaaaaaaaaaa\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(124,'{\"title\":\"()()()() title bro ()()()()\",\"owner\":\"user\",\"short_description\":\"aaaaaaaaaaaaaaaaaa\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(125,'{\"title\":\"()()()() title bro ()()()()\",\"owner\":\"user\",\"short_description\":\"()()()() title bro ()()(()()()() title bro ()()()()()()()() title bro ()()()())()\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(126,'{\"title\":\"()()()() title bro ()()()()\",\"owner\":\"user\",\"short_description\":\"()()()() title bro ()()(()()()() title bro ()()()()()()()() title bro ()()()())()\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(127,'{\"title\":\"()()()() title bro ()()()()\",\"owner\":\"user\",\"short_description\":\"()()()() title bro ()()(()()()() title bro ()()()()()()()() title bro ()()()())()\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(128,'{\"title\":\"()()()() title bro ()()()()\",\"owner\":\"user\",\"short_description\":\"aaaaaaaaaaaaaaaaaa\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}'),(129,'{\"title\":\"()()()() title bro ()()()()\",\"owner\":\"user\",\"short_description\":\"aaaaaaaaaaaaaaaaaa\",\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"www.scriptencryption.com\\/pic\\/11213123.png\"}');
/*!40000 ALTER TABLE `product_abbreviated` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_extended`
--

DROP TABLE IF EXISTS `product_extended`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_extended` (
  `id` bigint(20) NOT NULL,
  `json_extended` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_extended`
--

LOCK TABLES `product_extended` WRITE;
/*!40000 ALTER TABLE `product_extended` DISABLE KEYS */;
INSERT INTO `product_extended` VALUES (114,'{\"long_description\":\"()()()() title bro ()()()()\",\"terms_of_sale\":\"assdasda3222asd\",\"compressed_rating\":-1,\"quantity\":1}'),(115,'{\"long_description\":\"zzzzzzzzzzzzzzzzzz\",\"terms_of_sale\":\"zzzzzzzzzzzzzzzzzz\",\"compressed_rating\":-1,\"quantity\":1}'),(116,'{\"long_description\":\"xzzzzzzzzzzzzzz\",\"terms_of_sale\":\"xzzzzzzzzzzzzzz\",\"compressed_rating\":-1,\"quantity\":1}'),(117,'{\"long_description\":\"zxzzzzzzzzzzzzzzz\",\"terms_of_sale\":\"zxzzzzzzzzzzzzzzz\",\"compressed_rating\":-1,\"quantity\":1}'),(118,'{\"long_description\":\"aaaaaaaaaaaa\",\"terms_of_sale\":\"aaaaaaaaaaaa\",\"compressed_rating\":-1,\"quantity\":1}'),(119,'{\"long_description\":\"aaaaaaaaaaaaaaaaaaaaaaaa\",\"terms_of_sale\":\"aaaaaaaaaaaaaaaaaa\",\"compressed_rating\":-1,\"quantity\":1}'),(120,'{\"long_description\":\"aaaaaaaaaaaaaaaaaa\",\"terms_of_sale\":\"aaaaaaaaaaaaaaaaaa\",\"compressed_rating\":-1,\"quantity\":1}'),(121,'{\"long_description\":\"aaaaaaaaaaaaaaaaaa\",\"terms_of_sale\":\"aaaaaaaaaaaaaaaaaa\",\"compressed_rating\":-1,\"quantity\":1}'),(122,'{\"long_description\":\"BOMB HAND KNITTED \",\"terms_of_sale\":\"have to suck my dick\",\"compressed_rating\":-1,\"quantity\":1}'),(123,'{\"long_description\":\"aaaaa\",\"terms_of_sale\":\"aaaaaa\",\"compressed_rating\":-1,\"quantity\":1}'),(124,'{\"long_description\":\"aaaaa\",\"terms_of_sale\":\"assdasda3222asd\",\"compressed_rating\":-1,\"quantity\":1}'),(125,'{\"long_description\":\"()()()() title bro ()()()()\",\"terms_of_sale\":\"assdasda3222asd\",\"compressed_rating\":-1,\"quantity\":1}'),(126,'{\"long_description\":\"()()()() title bro ()()()()\",\"terms_of_sale\":\"assdasda3222asd\",\"compressed_rating\":-1,\"quantity\":1}'),(127,'{\"long_description\":\"aaaaa\",\"terms_of_sale\":\"assdasda3222asd\",\"compressed_rating\":-1,\"quantity\":1}'),(128,'{\"long_description\":\"aaaaa\",\"terms_of_sale\":\"aaaaaaaaaaaaaaaaaa\",\"compressed_rating\":-1,\"quantity\":1}'),(129,'{\"long_description\":\"aaaaasassssssssssssssssssssssssssssss\",\"terms_of_sale\":\"assdasda3222asd\",\"compressed_rating\":-1,\"quantity\":1}');
/*!40000 ALTER TABLE `product_extended` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_rating`
--

DROP TABLE IF EXISTS `product_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_rating` (
  `id` bigint(20) NOT NULL,
  `json_rating` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_rating`
--

LOCK TABLES `product_rating` WRITE;
/*!40000 ALTER TABLE `product_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(45) DEFAULT NULL,
  `phonenumber_show` varchar(5) DEFAULT 'false',
  `email` varchar(45) DEFAULT NULL,
  `email_show` varchar(5) DEFAULT 'false',
  `address` varchar(45) DEFAULT NULL,
  `address_show` varchar(5) DEFAULT 'false',
  `website` varchar(45) DEFAULT NULL,
  `website_show` varchar(5) DEFAULT 'true',
  `through_website` varchar(5) DEFAULT 'true',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `server_settings`
--

DROP TABLE IF EXISTS `server_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server_settings` (
  `id` int(11) NOT NULL,
  `json_server_settings` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server_settings`
--

LOCK TABLES `server_settings` WRITE;
/*!40000 ALTER TABLE `server_settings` DISABLE KEYS */;
INSERT INTO `server_settings` VALUES (1,'{\"Categories\":[\"Wool (unfinished)\",\"Wool (finished)\",\"Hand knit\",\"Spinning Equipment\"]}');
/*!40000 ALTER TABLE `server_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attemps',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'administrator','$2y$10$O8HHEbkSfCFSuhvKxzIjgOkUVmOSLkuwcTnctR7avNCfZynZKTS9G','boxhead.two.play@gmail.com',1,'',NULL,NULL,'88ca18100e608235981ba294dd48c485558a8e6b7333570515139ced8fbdcaf4',0,NULL,'2014-12-17 01:22:04','192.168.1.1'),(6,'user','$2y$10$OXm6dfgxp5gfV8Zz6DAgU.BrFOwwE8djfMPCEITMp/ihHg4r6vP.a','hotmail@gmail.com',1,'',NULL,NULL,'226bcaa88136bd18d2f0ece2e8d307b9f3c15638fb95736a14beb80fdd8fa8bc',0,NULL,'2014-12-17 12:06:21','192.168.1.1'),(4,'payments_cut','$2y$10$oi2DxoLbQLs/9NlQJNrVEOlWl78e.NurP.iTRjZy/ynhXhL/htjdu','crapypizza@gmail.com',1,'9f5b0c09c7789a2657d2ce770ed3746109d01fb2',NULL,NULL,NULL,0,NULL,'2014-12-17 13:52:33','192.168.1.1'),(3,'payments_fee','$2y$10$w73x0SZ/fSmZXzZ.cforVePtNhlC8h4Ab1cWDwkqvGcVXkkld59mq','dwarvenknowledgellc@gmail.com',1,'',NULL,NULL,NULL,0,NULL,'2014-12-17 13:49:07','192.168.1.1'),(2,'payments_held','$2y$10$yxhAKSosi1D1GeLiSUFHceISw66qG/5RzSUolDzVl223fFngCo/Ma','boxhead.zombie.war@gmail.com',1,'',NULL,NULL,NULL,0,NULL,'2014-12-17 13:50:58','192.168.1.1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_funds`
--

DROP TABLE IF EXISTS `users_funds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_funds` (
  `id` bigint(20) NOT NULL,
  `funds` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_funds`
--

LOCK TABLES `users_funds` WRITE;
/*!40000 ALTER TABLE `users_funds` DISABLE KEYS */;
INSERT INTO `users_funds` VALUES (1,0),(2,0),(3,1.4),(4,0),(6,998.6);
/*!40000 ALTER TABLE `users_funds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_products`
--

DROP TABLE IF EXISTS `users_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_products` (
  `id` bigint(20) NOT NULL,
  `json_productids` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_products`
--

LOCK TABLES `users_products` WRITE;
/*!40000 ALTER TABLE `users_products` DISABLE KEYS */;
INSERT INTO `users_products` VALUES (6,'{\"product_id\":\"120\",\"post_date\":\"12\\/18\\/2014\",\"0\":{\"product_id\":\"121\",\"post_date\":\"12\\/18\\/2014\"},\"1\":{\"product_id\":\"122\",\"post_date\":\"12\\/18\\/2014\"},\"2\":{\"product_id\":\"123\",\"post_date\":\"12\\/18\\/2014\"},\"3\":{\"product_id\":\"124\",\"post_date\":\"12\\/18\\/2014\"},\"4\":{\"product_id\":\"125\",\"post_date\":\"12\\/19\\/2014\"},\"5\":{\"product_id\":\"126\",\"post_date\":\"12\\/19\\/2014\"},\"6\":{\"product_id\":\"127\",\"post_date\":\"12\\/19\\/2014\"},\"7\":{\"product_id\":\"128\",\"post_date\":\"12\\/19\\/2014\"},\"8\":{\"product_id\":\"129\",\"post_date\":\"12\\/19\\/2014\"}}');
/*!40000 ALTER TABLE `users_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_settings`
--

DROP TABLE IF EXISTS `users_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_settings` (
  `id` bigint(20) NOT NULL,
  `json_settings` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_settings`
--

LOCK TABLES `users_settings` WRITE;
/*!40000 ALTER TABLE `users_settings` DISABLE KEYS */;
INSERT INTO `users_settings` VALUES (1,'{\"Banned_From_Site\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(2,'{\"Banned_From_Site\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(3,'{\"Banned_From_Site\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(4,'{\"Banned_From_Site\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(5,'{\"Banned_From_Site\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(6,'{\"Banned_From_Site\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}');
/*!40000 ALTER TABLE `users_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-19  0:21:29
