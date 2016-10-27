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
-- Table structure for table `archive_table`
--

DROP TABLE IF EXISTS `archive_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archive_table` (
  `user_id` bigint(20) NOT NULL,
  `blocked_numbers` text,
  `alwaystrue` varchar(45) DEFAULT 'true',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archive_table`
--

LOCK TABLES `archive_table` WRITE;
/*!40000 ALTER TABLE `archive_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `archive_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ipn_invalid`
--

DROP TABLE IF EXISTS `ipn_invalid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ipn_invalid` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) DEFAULT NULL,
  `date` varchar(60) DEFAULT NULL,
  `packed_json` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipn_invalid`
--

LOCK TABLES `ipn_invalid` WRITE;
/*!40000 ALTER TABLE `ipn_invalid` DISABLE KEYS */;
/*!40000 ALTER TABLE `ipn_invalid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ipn_processed`
--

DROP TABLE IF EXISTS `ipn_processed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ipn_processed` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(60) NOT NULL,
  `payment_amount` varchar(255) DEFAULT NULL,
  `packed_json` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipn_processed`
--

LOCK TABLES `ipn_processed` WRITE;
/*!40000 ALTER TABLE `ipn_processed` DISABLE KEYS */;
/*!40000 ALTER TABLE `ipn_processed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ipn_valid`
--

DROP TABLE IF EXISTS `ipn_valid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ipn_valid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(60) NOT NULL,
  `payment_amount` varchar(255) DEFAULT NULL,
  `packed_json` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipn_valid`
--

LOCK TABLES `ipn_valid` WRITE;
/*!40000 ALTER TABLE `ipn_valid` DISABLE KEYS */;
/*!40000 ALTER TABLE `ipn_valid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `link` varchar(500) DEFAULT NULL,
  `name` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logging_receipt`
--

DROP TABLE IF EXISTS `logging_receipt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logging_receipt` (
  `id` varchar(32) NOT NULL,
  `product_id` varchar(45) DEFAULT NULL,
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
/*!40000 ALTER TABLE `logging_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_body`
--

DROP TABLE IF EXISTS `message_body`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_body` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `packed_json` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_body`
--

LOCK TABLES `message_body` WRITE;
/*!40000 ALTER TABLE `message_body` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_body` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_header`
--

DROP TABLE IF EXISTS `message_header`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_header` (
  `id` bigint(20) NOT NULL,
  `packed_json` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_header`
--

LOCK TABLES `message_header` WRITE;
/*!40000 ALTER TABLE `message_header` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_header` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_information`
--

DROP TABLE IF EXISTS `order_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_information` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `shipping_id` bigint(20) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  `buyer_id` bigint(20) DEFAULT NULL,
  `product_order_ids_json` text COMMENT 'the ids for the product orders',
  `order_date` datetime DEFAULT NULL,
  `paid_date` datetime DEFAULT NULL,
  `ipn_paid_date` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `transaction_id` varchar(45) DEFAULT NULL,
  `paypal_completion_pack` text,
  PRIMARY KEY (`id`,`shipping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_information`
--

LOCK TABLES `order_information` WRITE;
/*!40000 ALTER TABLE `order_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_information` ENABLE KEYS */;
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
  `stock_free` int(11) DEFAULT '1',
  `stock_inhold` int(11) DEFAULT '0',
  `stock_sold` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_abbreviated`
--

LOCK TABLES `product_abbreviated` WRITE;
/*!40000 ALTER TABLE `product_abbreviated` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `product_extended` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_order`
--

DROP TABLE IF EXISTS `product_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `order_information_id` bigint(20) DEFAULT NULL,
  `shipping_id` bigint(20) DEFAULT NULL,
  `shipping_date` datetime DEFAULT NULL,
  `tracking_code` varchar(200) DEFAULT NULL,
  `package_carrier` varchar(45) DEFAULT NULL,
  `comments` text,
  `product_id` bigint(20) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'unshipped',
  `quantity` bigint(20) DEFAULT '1',
  `price` varchar(45) DEFAULT '0.0',
  `hide` varchar(6) DEFAULT 'false',
  `canceled` varchar(45) DEFAULT 'false',
  PRIMARY KEY (`id`,`customer_id`,`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_order`
--

LOCK TABLES `product_order` WRITE;
/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_order` ENABLE KEYS */;
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
-- Table structure for table `product_search`
--

DROP TABLE IF EXISTS `product_search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_search` (
  `id` bigint(20) NOT NULL,
  `title` text,
  `description` text,
  `categorie` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_search`
--

LOCK TABLES `product_search` WRITE;
/*!40000 ALTER TABLE `product_search` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_search` ENABLE KEYS */;
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
INSERT INTO `server_settings` VALUES (1,'{\"Categories\":[\"Finished Projects\",\"Processed Fibers\",\"Processed Alpaca\",\"Raw Alpaca\",\"Processed Angora Goat\", \"Raw Angora Goat\", \"Processed Sheep\", \"Raw Sheep\"]}');
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
INSERT INTO `server_termsandconditions` VALUES (1,'Terms of Use');
/*!40000 ALTER TABLE `server_termsandconditions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_information`
--

DROP TABLE IF EXISTS `shipping_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_information` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `address` text,
  `city` text,
  `phone_number` varchar(45) DEFAULT NULL,
  `state` text,
  `postal_code` text,
  `country` text,
  `tied_to_order` tinyint(1) DEFAULT '0',
  `creation_date` datetime DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_information`
--

LOCK TABLES `shipping_information` WRITE;
/*!40000 ALTER TABLE `shipping_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipping_information` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (47,'BANDIT','$2y$10$goEPwAqM6bUwcwvhggHkU.t5VYb61RzGvDoNjbRTRX3lyHSALSUg6','promichael@outlook.com',1,NULL,NULL,NULL,NULL,0,NULL,'2015-05-21 15:48:47','96.246.213.53'),(2,'payments_held','$2y$10$EmvMwn.Ksp5fpo24KQ6H4.EqqAo/D8ziqU9b05NVMR6dWV0oVKq8a','dwarvenknowledgellc@gmail.com',1,'',NULL,NULL,NULL,0,NULL,'2015-05-21 15:37:44','192.168.1.1'),(38,'support','$2y$10$YRI5kKztGSMkZXyYhonnpOACewdVCx87wxepdhtYwj.xOL9HVIeXm','sheep.r.cute@gmail.com',1,'030ee46ca4c9e41bd57f8872464a85d0b1635636',NULL,NULL,NULL,0,NULL,'2015-05-21 15:39:44','192.168.1.1'),(1,'Administrator','$2y$10$mcMI2ZqPpHW950nzn2qcO.xdRrshwdVpNuXmRCCTD59r4eIOR9w7u','boxhead.two.play@gmail.com',1,NULL,NULL,NULL,NULL,2,1432248023,'2015-05-21 15:28:50','192.168.1.1'),(4,'payments_cut','$2y$10$YBdGSCj/6VZv70XqT3Obd.oOaNUnsV/iAW.x0P0v/klH0Ot1gYvmW','fleecefinder@gmail.com',1,NULL,NULL,NULL,NULL,0,NULL,'2015-05-21 15:33:24','192.168.1.1'),(3,'payments_fee','$2y$10$PubCEYACVe8v/pscH4Wgnub392aPA962MYgYa/4o0vPyJkcwfIE42','dwarvenknowledgellc2@gmail.com',1,NULL,NULL,NULL,NULL,0,NULL,'2015-05-21 15:35:14','192.168.1.1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_farm_rating`
--

DROP TABLE IF EXISTS `users_farm_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_farm_rating` (
  `id` bigint(20) NOT NULL,
  `totalsales` varchar(100) DEFAULT NULL COMMENT 'json packed with star rating plus sales',
  `json_ratings` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_farm_rating`
--

LOCK TABLES `users_farm_rating` WRITE;
/*!40000 ALTER TABLE `users_farm_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_farm_rating` ENABLE KEYS */;
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
INSERT INTO `users_funds` VALUES (42,0),(43,0),(44,0),(45,0),(46,0),(47,0);
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
INSERT INTO `users_settings` VALUES (42,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(43,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(44,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(45,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(46,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(47,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}');
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

-- Dump completed on 2015-05-21 15:51:03
