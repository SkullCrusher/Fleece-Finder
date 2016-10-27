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
-- Table structure for table `logging_review`
--

DROP TABLE IF EXISTS `logging_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logging_review` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `json_review` longtext,
  `time` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logging_review`
--

LOCK TABLES `logging_review` WRITE;
/*!40000 ALTER TABLE `logging_review` DISABLE KEYS */;
INSERT INTO `logging_review` VALUES (14,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:04:37 -0800'),(15,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:11:58 -0800'),(16,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:18:45 -0800'),(17,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:22:37 -0800'),(18,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:27:19 -0800'),(19,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:28:11 -0800'),(20,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:31:59 -0800'),(21,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:32:17 -0800'),(22,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:58:37 -0800'),(23,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:59:34 -0800'),(24,'user','{\"title\":\"tttt\",\"long_description\":\"dddddd\",\"rating\":\"0.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 17:04:19 -0800'),(25,'user','{\"title\":\"Smoke weed everyday\",\"long_description\":\"Smoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everyday\",\"rating\":\"3.5\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 17:11:50 -0800'),(26,'user','{\"title\":\"Smoke weed everyday\",\"long_description\":\"Smoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everyday\",\"rating\":\"3.5\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 17:15:38 -0800'),(27,'user','{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"long_description\":\"Wool ignites at a higher temperature than cotton and some synthetic fibers. It has a lower rate of flame spread a lower rate of heat release a lower heat of combustion and does not melt or drip4 it forms a char which is insulating and selfextinguishing and it contributes less to toxic gases and smoke than other flooring products when used in carpets. Wool carpets are specified for high safety environments such as trains and aircraft. Wool is usually specified for garments for firefighters soldiers and others in occupations where they are exposed to the likelihood of fire.\",\"rating\":\"3.5\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 19:34:52 -0800');
/*!40000 ALTER TABLE `logging_review` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_abbreviated`
--

LOCK TABLES `product_abbreviated` WRITE;
/*!40000 ALTER TABLE `product_abbreviated` DISABLE KEYS */;
INSERT INTO `product_abbreviated` VALUES (137,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"\",\"category\":\"Wool (unfinished)\",\"price\":1.99,\"picture\":\"1419583853me_to_hell_02\"}'),(138,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"\",\"category\":\"Wool (unfinished)\",\"price\":1.99,\"picture\":\"1419588159_Alive\"}'),(139,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"\",\"category\":\"Wool (unfinished)\",\"price\":1.99,\"picture\":\"none\"}'),(140,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"LB\",\"category\":\"Wool (unfinished)\",\"price\":1.99,\"picture\":\"none\"}'),(141,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"LN\",\"category\":\"Wool (unfinished)\",\"price\":1.99,\"picture\":\"none\"}'),(142,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"Square foot\",\"category\":\"Wool (unfinished)\",\"price\":1.99,\"picture\":\"1419625631\"}');
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
INSERT INTO `product_extended` VALUES (137,'{\"long_description\":\"THE GRAIN IS PRODUCED IN HELL\",\"terms_of_sale\":\"YOU MUST COME TO HELL TO BUY ITYOU MUST COME TO HELL TO BUY ITYOU MUST COME TO HELL TO BUY ITYOU MUST COME TO HELL TO BUY IT\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"1419583857ToGlass_Logo11\",\"picture3\":\"1419583859anyin2\",\"picture4\":\"1419583863Alive\",\"picture5\":\"1419583868\",\"picture6\":\"1419583902r_m7bze2aPge1qeuu10\"}'),(138,'{\"long_description\":\"fsdgdfgdfgdfgdfgdfg\",\"terms_of_sale\":\"gdfgdfgdfgdfgdfgdfgdfg\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"none\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}'),(139,'{\"long_description\":\"saasdasdasdsad\",\"terms_of_sale\":\"saasdasdasdsadsaasdasdasdsadsaasdasdasdsadsaasdasdasdsad\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"none\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}'),(140,'{\"long_description\":\"fdasdasdasdas\",\"terms_of_sale\":\"asdasdasd\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"none\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}'),(141,'{\"long_description\":\"asdasdasdasdasdasdasdasdasdasdasdasd\",\"terms_of_sale\":\"asdasdasdasdasdasdasdasdasdasdasdasd\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"none\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}'),(142,'{\"long_description\":\"asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasd\",\"terms_of_sale\":\"asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasd\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"1419625634\",\"picture3\":\"1419625646\",\"picture4\":\"1419625644\",\"picture5\":\"1419625641\",\"picture6\":\"1419625638\"}');
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
INSERT INTO `product_rating` VALUES (142,'{\"title\":\"Neat but it was tree bark\",\"long_description\":\"I found a large bag of tree bark in my mailbox this morning thanks I guess\",\"rating\":\"3.5\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/29\\/2014 - 09:02:07 PM\"}');
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
-- Table structure for table `server_termsandconditions`
--

DROP TABLE IF EXISTS `server_termsandconditions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server_termsandconditions` (
  `id` int(11) NOT NULL,
  `termsandconditions` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server_termsandconditions`
--

LOCK TABLES `server_termsandconditions` WRITE;
/*!40000 ALTER TABLE `server_termsandconditions` DISABLE KEYS */;
INSERT INTO `server_termsandconditions` VALUES (1,'Monkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are coolMonkeys are cool');
/*!40000 ALTER TABLE `server_termsandconditions` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'administrator','$2y$10$O8HHEbkSfCFSuhvKxzIjgOkUVmOSLkuwcTnctR7avNCfZynZKTS9G','boxhead.two.play@gmail.com',1,'',NULL,NULL,'88ca18100e608235981ba294dd48c485558a8e6b7333570515139ced8fbdcaf4',0,NULL,'2014-12-17 01:22:04','192.168.1.1'),(6,'user','$2y$10$OXm6dfgxp5gfV8Zz6DAgU.BrFOwwE8djfMPCEITMp/ihHg4r6vP.a','hotmail@gmail.com',1,'',NULL,NULL,'d48155c2f8564cd3374ea5f80e7a5c314028621f1b70bae4dbc510c7d0e83fe2',0,NULL,'2014-12-17 12:06:21','192.168.1.1'),(4,'payments_cut','$2y$10$oi2DxoLbQLs/9NlQJNrVEOlWl78e.NurP.iTRjZy/ynhXhL/htjdu','payments_cut@fleecefinderl.com',1,'9f5b0c09c7789a2657d2ce770ed3746109d01fb2',NULL,NULL,NULL,0,NULL,'2014-12-17 13:52:33','192.168.1.1'),(3,'payments_fee','$2y$10$w73x0SZ/fSmZXzZ.cforVePtNhlC8h4Ab1cWDwkqvGcVXkkld59mq','dwarvenknowledgellc@gmail.com',1,'',NULL,NULL,NULL,0,NULL,'2014-12-17 13:49:07','192.168.1.1'),(2,'payments_held','$2y$10$yxhAKSosi1D1GeLiSUFHceISw66qG/5RzSUolDzVl223fFngCo/Ma','boxhead.zombie.war@gmail.com',1,'',NULL,NULL,NULL,0,NULL,'2014-12-17 13:50:58','192.168.1.1'),(37,'Username','$2y$10$Qlbtlx.w2IBA5g3HLCIU9uO/ofyKWvL6N5fvqGYzCM7SxfUfvoxU.','crapypizza@gmail.com',0,'4983b8d4f7e06076f8d8ebfe3e7a5e025432340a',NULL,NULL,NULL,0,NULL,'2015-01-09 16:28:50','192.168.1.1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_farminformation`
--

DROP TABLE IF EXISTS `users_farminformation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_farminformation` (
  `id` bigint(20) NOT NULL,
  `json_farminformation` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_farminformation`
--

LOCK TABLES `users_farminformation` WRITE;
/*!40000 ALTER TABLE `users_farminformation` DISABLE KEYS */;
INSERT INTO `users_farminformation` VALUES (6,'[{\"profile_picture\":\"\\/\\/images\\/\\/upload_images\\/\\/user\\/\\/142172377328634f513f5c1110359599d9ecf.png\",\"profile_name\":\"Neatcooltestfsrm\",\"profile_short_description\":\"OurfarmisafarmwhomakesOurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsOOurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsfarmingfarmsOurfarmisafar4\",\"short_biography\":\"sss\",\"terms_of_sale\":\"dff\",\"phone_number\":\"000-000-0000\",\"email\":\"3333email@domain.com\",\"website\":\"www.domain.com\",\"mobile_phone\":\"0101010101\",\"extra\":\"Callbetween9pmanddssd\"}]');
/*!40000 ALTER TABLE `users_farminformation` ENABLE KEYS */;
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
INSERT INTO `users_funds` VALUES (1,0),(2,0),(3,54),(4,0),(6,946),(33,0),(34,0),(35,0),(36,0);
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
INSERT INTO `users_products` VALUES (6,'{\"product_id\":\"120\",\"post_date\":\"12\\/18\\/2014\",\"0\":{\"product_id\":\"121\",\"post_date\":\"12\\/18\\/2014\"},\"1\":{\"product_id\":\"122\",\"post_date\":\"12\\/18\\/2014\"},\"2\":{\"product_id\":\"123\",\"post_date\":\"12\\/18\\/2014\"},\"3\":{\"product_id\":\"124\",\"post_date\":\"12\\/18\\/2014\"},\"4\":{\"product_id\":\"125\",\"post_date\":\"12\\/19\\/2014\"},\"5\":{\"product_id\":\"126\",\"post_date\":\"12\\/19\\/2014\"},\"6\":{\"product_id\":\"127\",\"post_date\":\"12\\/19\\/2014\"},\"7\":{\"product_id\":\"128\",\"post_date\":\"12\\/19\\/2014\"},\"8\":{\"product_id\":\"129\",\"post_date\":\"12\\/19\\/2014\"},\"9\":{\"product_id\":\"130\",\"post_date\":\"12\\/19\\/2014\"},\"10\":{\"product_id\":\"131\",\"post_date\":\"12\\/19\\/2014\"},\"11\":{\"product_id\":\"132\",\"post_date\":\"12\\/23\\/2014\"},\"12\":{\"product_id\":\"133\",\"post_date\":\"12\\/25\\/2014\"},\"13\":{\"product_id\":\"134\",\"post_date\":\"12\\/25\\/2014\"},\"14\":{\"product_id\":\"135\",\"post_date\":\"12\\/25\\/2014\"},\"15\":{\"product_id\":\"136\",\"post_date\":\"12\\/26\\/2014\"},\"16\":{\"product_id\":\"137\",\"post_date\":\"12\\/26\\/2014\"},\"17\":{\"product_id\":\"138\",\"post_date\":\"12\\/26\\/2014\"},\"18\":{\"product_id\":\"139\",\"post_date\":\"12\\/26\\/2014\"},\"19\":{\"product_id\":\"140\",\"post_date\":\"12\\/26\\/2014\"},\"20\":{\"product_id\":\"141\",\"post_date\":\"12\\/26\\/2014\"},\"21\":{\"product_id\":\"142\",\"post_date\":\"12\\/26\\/2014\"}}');
/*!40000 ALTER TABLE `users_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_profile`
--

DROP TABLE IF EXISTS `users_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_profile` (
  `id` bigint(20) NOT NULL,
  `profile_json` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_profile`
--

LOCK TABLES `users_profile` WRITE;
/*!40000 ALTER TABLE `users_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_profile` ENABLE KEYS */;
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
INSERT INTO `users_settings` VALUES (1,'{\"Banned_From_Site\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(2,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"true\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(3,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"true\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(4,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"true\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(5,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(6,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(33,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(34,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(35,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}'),(36,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.2\",\"User_Allow_Messages\":\"true\"}');
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

-- Dump completed on 2015-01-19 20:26:56
