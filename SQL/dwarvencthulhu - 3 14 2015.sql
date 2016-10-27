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
-- Table structure for table `cron_lock`
--

DROP TABLE IF EXISTS `cron_lock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cron_lock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron_lock`
--

LOCK TABLES `cron_lock` WRITE;
/*!40000 ALTER TABLE `cron_lock` DISABLE KEYS */;
/*!40000 ALTER TABLE `cron_lock` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipn_invalid`
--

LOCK TABLES `ipn_invalid` WRITE;
/*!40000 ALTER TABLE `ipn_invalid` DISABLE KEYS */;
INSERT INTO `ipn_invalid` VALUES (3,'192.168.1.1','2015-01-23 03:56:25','[]'),(4,'192.168.1.1','2015-01-25 01:53:38','[]'),(5,'192.168.1.1','2015-01-31 12:13:09','[]'),(6,'192.168.1.1','2015-02-05 10:11:29','[]'),(7,'192.168.1.1','2015-02-06 12:58:50','[]'),(8,'192.168.1.1','2015-02-08 06:33:45','[]'),(9,'192.168.1.1','2015-02-12 09:06:41','[]'),(10,'192.168.1.1','2015-02-14 05:22:31','[]'),(11,'192.168.1.1','2015-02-19 06:18:38','[]'),(12,'71.94.222.110','2015-02-21 06:39:02','[]'),(13,'192.168.1.1','2015-02-28 12:26:58','[]'),(14,'192.168.1.1','2015-02-28 05:31:05','[]');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipn_valid`
--

LOCK TABLES `ipn_valid` WRITE;
/*!40000 ALTER TABLE `ipn_valid` DISABLE KEYS */;
INSERT INTO `ipn_valid` VALUES (1,'1047247533','12.34','{\"residence_country\":\"US\",\"invoice\":\"abc1234\",\"address_city\":\"San Jose\",\"first_name\":\"John\",\"payer_id\":\"TESTBUYERID01\",\"shipping\":\"3.04\",\"mc_fee\":\"0.44\",\"txn_id\":\"1047247533\",\"receiver_email\":\"seller@paypalsandbox.com\",\"quantity\":\"1\",\"custom\":\"xyz123\",\"payment_date\":\"15:11:16 23 Jan 2015 PST\",\"address_country_code\":\"US\",\"address_zip\":\"95131\",\"tax\":\"2.02\",\"item_name\":\"something\",\"address_name\":\"John Smith\",\"last_name\":\"Smith\",\"receiver_id\":\"seller@paypalsandbox.com\",\"item_number\":\"AK-1234\",\"verify_sign\":\"AiPC9BjkCyDFQXbSkoZcgqH3hpacAvqtTK9PeRgJxYvfOVBz0DkCDYha\",\"address_country\":\"United States\",\"payment_status\":\"Completed\",\"address_status\":\"unconfirmed\",\"business\":\"seller@paypalsandbox.com\",\"payer_email\":\"buyer@paypalsandbox.com\",\"notify_version\":\"2.1\",\"txn_type\":\"web_accept\",\"test_ipn\":\"1\",\"payer_status\":\"verified\",\"mc_currency\":\"USD\",\"mc_gross\":\"12.34\",\"address_state\":\"CA\",\"mc_gross1\":\"9.34\",\"payment_type\":\"instant\",\"address_street\":\"123, any street\"}','2015-01-23 03:15:54','173.0.81.1'),(2,'0M6732532N3415521','0.01','{\"mc_gross\":\"0.01\",\"protection_eligibility\":\"Eligible\",\"address_status\":\"confirmed\",\"item_number1\":\"10000\",\"payer_id\":\"R7ZKGLKY5ZFL6\",\"tax\":\"0.00\",\"address_street\":\"25905 spirit ln\",\"payment_date\":\"15:27:09 Jan 23, 2015 PST\",\"payment_status\":\"Completed\",\"charset\":\"windows-1252\",\"address_zip\":\"99338\",\"mc_shipping\":\"0.00\",\"mc_handling\":\"0.00\",\"first_name\":\"David\",\"mc_fee\":\"0.01\",\"address_country_code\":\"US\",\"address_name\":\"SkullCrusher Products\",\"notify_version\":\"3.8\",\"custom\":\"\",\"payer_status\":\"verified\",\"address_country\":\"United States\",\"num_cart_items\":\"1\",\"mc_handling1\":\"0.00\",\"address_city\":\"kennewick\",\"verify_sign\":\"AaeppzVbDR9WSCHZ2c.3.L5d-Bv2AGzvC-w5zXk-pikddLfGsdQR3HBg\",\"payer_email\":\"divad97dragon@aim.com\",\"mc_shipping1\":\"0.00\",\"tax1\":\"0.00\",\"txn_id\":\"0M6732532N3415521\",\"payment_type\":\"instant\",\"payer_business_name\":\"SkullCrusher Products\",\"last_name\":\"Harkins\",\"address_state\":\"WA\",\"item_name1\":\"Canon EOS Rebel XS\",\"receiver_email\":\"dwarvenknowledgellc@gmail.com\",\"payment_fee\":\"0.01\",\"quantity1\":\"1\",\"receiver_id\":\"T848VD62JLL56\",\"txn_type\":\"cart\",\"mc_gross_1\":\"0.01\",\"mc_currency\":\"USD\",\"residence_country\":\"US\",\"transaction_subject\":\"Capture all your special moments with the Canon EOS Rebel XS\\/1000D DSLR camera and cherish the memories over and over again.\",\"payment_gross\":\"0.01\",\"ipn_track_id\":\"5ee475199f03d\"}','2015-01-23 03:27:24','173.0.81.1'),(3,'3E9464065R057415R','0.01','{\"mc_gross\":\"0.01\",\"protection_eligibility\":\"Eligible\",\"address_status\":\"confirmed\",\"item_number1\":\"1\",\"payer_id\":\"R7ZKGLKY5ZFL6\",\"tax\":\"0.00\",\"address_street\":\"1 Main St\",\"payment_date\":\"18:19:46 Mar 03, 2015 PST\",\"payment_status\":\"Completed\",\"charset\":\"windows-1252\",\"address_zip\":\"95131\",\"mc_shipping\":\"0.00\",\"mc_handling\":\"0.00\",\"first_name\":\"David\",\"mc_fee\":\"0.01\",\"address_country_code\":\"US\",\"address_name\":\"9478327\",\"notify_version\":\"3.8\",\"custom\":\"\",\"payer_status\":\"verified\",\"business\":\"dwarvenknowledgellc@gmail.com\",\"address_country\":\"United States\",\"num_cart_items\":\"1\",\"address_city\":\"San Jose\",\"verify_sign\":\"ARHPijWmCCSUguBRmsQZVk1xNcMRA2D-F5CMGHCeJMPzDOBwxJtGszrV\",\"payer_email\":\"divad97dragon@aim.com\",\"txn_id\":\"3E9464065R057415R\",\"payment_type\":\"instant\",\"payer_business_name\":\"SkullCrusher Products\",\"last_name\":\"Harkins\",\"address_state\":\"CA\",\"item_name1\":\"pork\",\"receiver_email\":\"dwarvenknowledgellc@gmail.com\",\"payment_fee\":\"0.01\",\"quantity1\":\"1\",\"receiver_id\":\"T848VD62JLL56\",\"txn_type\":\"cart\",\"mc_gross_1\":\"0.01\",\"mc_currency\":\"USD\",\"residence_country\":\"US\",\"transaction_subject\":\"\",\"payment_gross\":\"0.01\",\"ipn_track_id\":\"fee3217398dca\"}','2015-03-03 06:20:06','173.0.81.1'),(4,'6V428715E5858722B','0.01','{\"mc_gross\":\"0.01\",\"protection_eligibility\":\"Eligible\",\"address_status\":\"confirmed\",\"item_number1\":\"1\",\"payer_id\":\"R7ZKGLKY5ZFL6\",\"tax\":\"0.00\",\"address_street\":\"Not Used\",\"payment_date\":\"22:12:53 Mar 13, 2015 PDT\",\"payment_status\":\"Completed\",\"charset\":\"windows-1252\",\"address_zip\":\"99338\",\"mc_shipping\":\"0.00\",\"mc_handling\":\"0.00\",\"first_name\":\"David\",\"mc_fee\":\"0.01\",\"address_country_code\":\"US\",\"address_name\":\"29\",\"notify_version\":\"3.8\",\"custom\":\"\",\"payer_status\":\"verified\",\"business\":\"dwarvenknowledgellc@gmail.com\",\"address_country\":\"United States\",\"num_cart_items\":\"1\",\"address_city\":\"Kennewick\",\"verify_sign\":\"AeZXq89bJ4rPMD.iZp8TPKB1hnuiAUgMYH3bI86AF9TVjVFx66FYqV-M\",\"payer_email\":\"divad97dragon@aim.com\",\"txn_id\":\"6V428715E5858722B\",\"payment_type\":\"instant\",\"payer_business_name\":\"SkullCrusher Products\",\"last_name\":\"Harkins\",\"address_state\":\"WA\",\"item_name1\":\"pork\",\"receiver_email\":\"dwarvenknowledgellc@gmail.com\",\"payment_fee\":\"0.01\",\"quantity1\":\"1\",\"receiver_id\":\"T848VD62JLL56\",\"txn_type\":\"cart\",\"mc_gross_1\":\"0.01\",\"mc_currency\":\"USD\",\"residence_country\":\"US\",\"transaction_subject\":\"\",\"payment_gross\":\"0.01\",\"ipn_track_id\":\"8d66e97fc60d6\"}','2015-03-13 10:13:14','173.0.81.1'),(5,'6TH85833RE053735K','0.01','{\"mc_gross\":\"0.01\",\"protection_eligibility\":\"Eligible\",\"address_status\":\"confirmed\",\"item_number1\":\"1\",\"payer_id\":\"R7ZKGLKY5ZFL6\",\"tax\":\"0.00\",\"address_street\":\"30\",\"payment_date\":\"22:17:17 Mar 13, 2015 PDT\",\"payment_status\":\"Completed\",\"charset\":\"windows-1252\",\"address_zip\":\"99338\",\"mc_shipping\":\"0.00\",\"mc_handling\":\"0.00\",\"first_name\":\"David\",\"mc_fee\":\"0.01\",\"address_country_code\":\"US\",\"address_name\":\"30\",\"notify_version\":\"3.8\",\"custom\":\"\",\"payer_status\":\"verified\",\"business\":\"dwarvenknowledgellc@gmail.com\",\"address_country\":\"United States\",\"num_cart_items\":\"1\",\"address_city\":\"Kennewick\",\"verify_sign\":\"AZVJl5K7ZIhGX4M.-KhalpPVO927AAfnWmzcjyC7Z51ZNtfPyjInRRLV\",\"payer_email\":\"divad97dragon@aim.com\",\"txn_id\":\"6TH85833RE053735K\",\"payment_type\":\"instant\",\"payer_business_name\":\"SkullCrusher Products\",\"last_name\":\"Harkins\",\"address_state\":\"WA\",\"item_name1\":\"pork\",\"receiver_email\":\"dwarvenknowledgellc@gmail.com\",\"payment_fee\":\"0.01\",\"quantity1\":\"1\",\"receiver_id\":\"T848VD62JLL56\",\"txn_type\":\"cart\",\"mc_gross_1\":\"0.01\",\"mc_currency\":\"USD\",\"residence_country\":\"US\",\"transaction_subject\":\"\",\"payment_gross\":\"0.01\",\"ipn_track_id\":\"8289b35560e11\"}','2015-03-13 10:17:39','173.0.81.1');
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
INSERT INTO `logging_review` VALUES (14,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:04:37 -0800'),(15,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:11:58 -0800'),(16,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:18:45 -0800'),(17,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:22:37 -0800'),(18,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:27:19 -0800'),(19,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:28:11 -0800'),(20,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:31:59 -0800'),(21,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:32:17 -0800'),(22,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:58:37 -0800'),(23,'user','{\"title\":\"Test debug for me\",\"long_description\":\"Debugging is amazing but sucky\",\"rating\":\"5.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 16:59:34 -0800'),(24,'user','{\"title\":\"tttt\",\"long_description\":\"dddddd\",\"rating\":\"0.0\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 17:04:19 -0800'),(25,'user','{\"title\":\"Smoke weed everyday\",\"long_description\":\"Smoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everyday\",\"rating\":\"3.5\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 17:11:50 -0800'),(26,'user','{\"title\":\"Smoke weed everyday\",\"long_description\":\"Smoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everydaySmoke weed everyday\",\"rating\":\"3.5\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 17:15:38 -0800'),(27,'user','{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"long_description\":\"Wool ignites at a higher temperature than cotton and some synthetic fibers. It has a lower rate of flame spread a lower rate of heat release a lower heat of combustion and does not melt or drip4 it forms a char which is insulating and selfextinguishing and it contributes less to toxic gases and smoke than other flooring products when used in carpets. Wool carpets are specified for high safety environments such as trains and aircraft. Wool is usually specified for garments for firefighters soldiers and others in occupations where they are exposed to the likelihood of fire.\",\"rating\":\"3.5\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/28\\/2014 - 11:24:36 PM\"}','Mon, 29 Dec 2014 19:34:52 -0800');
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
INSERT INTO `message_body` VALUES (1,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(2,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(3,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(5,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(7,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(8,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(9,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(11,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(12,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(13,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(14,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(15,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(16,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(17,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(18,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(19,'{\"body\":\"body\",\"from\":\"username\",\"to\":\"becca\",\"send_date\":\"July 15, 2013 6:00pm\"}'),(24,'{\"body\":\"asdadasdfghfgh\",\"from\":\"Becca\",\"to\":\"Becca\",\"send_date\":\"Feb 07, 2015 12:39 am\"}'),(25,'{\"body\":\"sdfsdfsd\",\"from\":\"Becca\",\"to\":\"Becca\",\"send_date\":\"Feb 07, 2015 1:23 am\"}'),(26,'{\"body\":\"sadasdas@#@\",\"from\":\"Becca\",\"to\":\"Becca\",\"send_date\":\"Feb 07, 2015 1:31 am\"}'),(27,'{\"body\":\"Blah blah blah. Ewe r cute\",\"from\":\"Becca\",\"to\":\"Becca\",\"send_date\":\"Feb 07, 2015 11:06 am\"}');
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
INSERT INTO `message_header` VALUES (38,'null'),(39,'[{\"id\":\"27\",\"date\":\"Feb 07, 2015 11:06 am\",\"read\":\"true\",\"title\":\"Trguyttyttt\",\"from\":\"Becca\",\"to\":\"Becca\"},{\"id\":\"26\",\"date\":\"Feb 07, 2015 1:31 am\",\"read\":\"true\",\"title\":\"asd!!@#@\",\"from\":\"Becca\",\"to\":\"Becca\"},{\"id\":\"25\",\"date\":\"Feb 07, 2015 1:23 am\",\"read\":\"true\",\"title\":\"sdfsdf\",\"from\":\"Becca\",\"to\":\"Becca\"},{\"id\":1,\"date\":\"July 15, 2013\",\"read\":\"true\",\"title\":\"SE1\",\"from\":\"support\",\"to\":\"becca\"},{\"id\":2,\"date\":\"July 15, 2013\",\"read\":\"true\",\"title\":\"SE2\",\"from\":\"support\",\"to\":\"becca\"},{\"id\":3,\"date\":\"July 15, 2013\",\"read\":\"true\",\"title\":\"SE3\",\"from\":\"support\",\"to\":\"becca\"},{\"id\":4,\"date\":\"July 15, 2013\",\"read\":\"true\",\"title\":\"SE4\",\"from\":\"support\",\"to\":\"becca\"}]');
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
  `status` varchar(45) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`shipping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_information`
--

LOCK TABLES `order_information` WRITE;
/*!40000 ALTER TABLE `order_information` DISABLE KEYS */;
INSERT INTO `order_information` VALUES (2,31,'0.01',39,'[{\"item_id\":\"144\",\"qty\":\"1\",\"price\":0.01}]','2015-03-14 01:14:30',NULL,'unpaid','192.168.1.1');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_abbreviated`
--

LOCK TABLES `product_abbreviated` WRITE;
/*!40000 ALTER TABLE `product_abbreviated` DISABLE KEYS */;
INSERT INTO `product_abbreviated` VALUES (137,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"LB\",\"shipping_cost\":5.1,\"shipping_cost_multiple\":false,\"category\":\"Hand knit\",\"price\":1.99,\"picture\":\"14220714370083__article_image\"}'),(138,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"LB\",\"shipping_cost\":5.1,\"shipping_cost_multiple\":false,\"category\":\"Hand knit\",\"price\":1.99,\"picture\":\"14220714370083__article_image\"}'),(139,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"LB\",\"shipping_cost\":5.1,\"shipping_cost_multiple\":false,\"category\":\"Hand knit\",\"price\":1.99,\"picture\":\"14220714370083__article_image\"}'),(140,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"LB\",\"shipping_cost\":5.1,\"shipping_cost_multiple\":false,\"category\":\"Hand knit\",\"price\":8.99,\"picture\":\"14220714370083__article_image\"}'),(141,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"LB\",\"shipping_cost\":5.1,\"shipping_cost_multiple\":false,\"category\":\"Hand knit\",\"price\":1.99,\"picture\":\"14220714370083__article_image\"}'),(142,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"LB\",\"shipping_cost\":5.1,\"shipping_cost_multiple\":false,\"category\":\"Hand knit\",\"price\":1.99,\"picture\":\"14220714370083__article_image\"}'),(143,'{\"title\":\"Blue wool fleece with real wool with some blue and maybe a fleece and it is free\",\"owner\":\"user\",\"short_description\":\"It is wool that has not been cleaned or anything so it will be 100 percent real wool\",\"amount\":\"50\",\"unit\":\"LB\",\"shipping_cost\":5.1,\"shipping_cost_multiple\":false,\"category\":\"Hand knit\",\"price\":1.99,\"picture\":\"14220714370083__article_image\"}'),(144,'{\"title\":\"test for search\",\"owner\":\"Becca\",\"short_description\":\"test for search\",\"amount\":\"10\",\"unit\":\"LB\",\"shipping_cost\":0,\"shipping_cost_multiple\":false,\"category\":\"Hand knit\",\"price\":0.01,\"picture\":\"1424992946d2\"}'),(145,'{\"title\":\"test for search2\",\"owner\":\"Becca\",\"short_description\":\"test for search2\",\"amount\":\"1\",\"unit\":\"LB\",\"shipping_cost\":1,\"shipping_cost_multiple\":false,\"category\":\"Wool (unfinished)\",\"price\":1,\"picture\":\"14249930516394c5466ed48fade70e24ce6b9\"}');
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
INSERT INTO `product_extended` VALUES (137,'{\"long_description\":\"THE GRAIN IS PRODUCED IN HELL\",\"terms_of_sale\":\"YOU MUST COME TO HELL TO BUY ITYOU MUST COME TO HELL TO BUY ITYOU MUST COME TO HELL TO BUY ITYOU MUST COME TO HELL TO BUY IT\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"1419583857ToGlass_Logo11\",\"picture3\":\"1419583859anyin2\",\"picture4\":\"1419583863Alive\",\"picture5\":\"1419583868\",\"picture6\":\"1419583902r_m7bze2aPge1qeuu10\"}'),(138,'{\"long_description\":\"fsdgdfgdfgdfgdfgdfg\",\"terms_of_sale\":\"gdfgdfgdfgdfgdfgdfgdfg\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"none\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}'),(139,'{\"long_description\":\"saasdasdasdsad\",\"terms_of_sale\":\"saasdasdasdsadsaasdasdasdsadsaasdasdasdsadsaasdasdasdsad\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"none\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}'),(140,'{\"long_description\":\"fdasdasdasdas\",\"terms_of_sale\":\"asdasdasd\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"none\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}'),(141,'{\"long_description\":\"asdasdasdasdasdasdasdasdasdasdasdasd\",\"terms_of_sale\":\"asdasdasdasdasdasdasdasdasdasdasdasd\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"none\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}'),(142,'{\"long_description\":\"asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasd\",\"terms_of_sale\":\"asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasd\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":100,\"shipping_cost_multiple\":false,\"picture2\":\"1419625634\",\"picture3\":\"1419625646\",\"picture4\":\"1419625644\",\"picture5\":\"1419625641\",\"picture6\":\"1419625638\"}'),(143,'{\"long_description\":\"sadasdasdasd\",\"terms_of_sale\":\"sadasdasdasd\",\"compressed_rating\":-1,\"quantity\":100,\"shipping_cost\":5.1,\"shipping_cost_multiple\":false,\"picture2\":\"none\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}'),(144,'{\"long_description\":\"test for searchtest for search\",\"terms_of_sale\":\"test for searchtest for searchtest for search\",\"compressed_rating\":-1,\"quantity\":1,\"shipping_cost\":1.42,\"shipping_cost_multiple\":false,\"picture2\":\"1424992953ange\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}'),(145,'{\"long_description\":\"test for search2test for search2\",\"terms_of_sale\":\"test for search2test for search2\",\"compressed_rating\":-1,\"quantity\":1,\"shipping_cost\":1,\"shipping_cost_multiple\":false,\"picture2\":\"1424993062d566d976a5d17b36729cfef7876\",\"picture3\":\"none\",\"picture4\":\"none\",\"picture5\":\"none\",\"picture6\":\"none\"}');
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
  `comments` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`customer_id`,`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
INSERT INTO `product_rating` VALUES (142,'{\"title\":\"Neat but it was tree bark\",\"long_description\":\"I found a large bag of tree bark in my mailbox this morning thanks I guess\",\"rating\":\"3.5\",\"username\":\"user\",\"verified_owner\":true,\"post_date\":\"12\\/29\\/2014 - 09:02:07 PM\"}');
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
INSERT INTO `product_search` VALUES (144,'test for search','test for search','Wool (unfinished)'),(145,'test for search2','test for search2','Wool (unfinished)');
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
INSERT INTO `server_settings` VALUES (1,'{\"Categories\":[\"Wool (unfinished)\",\"Wool (finished)\",\"Hand knit\",\"Spinning Equipment\", \"Wool (colored)\"]}');
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_information`
--

LOCK TABLES `shipping_information` WRITE;
/*!40000 ALTER TABLE `shipping_information` DISABLE KEYS */;
INSERT INTO `shipping_information` VALUES (1,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:44',NULL),(2,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:52',NULL),(3,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:52',NULL),(4,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:52',NULL),(5,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:53',NULL),(6,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:53',NULL),(7,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:53',NULL),(8,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:53',NULL),(9,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:54',NULL),(10,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:55',NULL),(11,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:56',NULL),(12,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:58',NULL),(13,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:58',NULL),(14,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 16:55:59',NULL),(15,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 17:01:39',NULL),(16,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 17:01:41',NULL),(17,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 17:06:42',NULL),(18,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 17:07:49',NULL),(19,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 17:28:44',NULL),(20,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 17:28:46',NULL),(21,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 18:33:16',NULL),(22,56,'address','city',NULL,'state','poscode','us',0,'2015-03-03 18:33:28',NULL),(23,37,'fghfghfghfgh','kennewick','456456','Arkansas','9999','asdsad',0,'2015-03-03 18:51:14','fdhfgh'),(24,37,'fghfghfghfgh','newyork','456456','Arizona','9999','asdsad',0,'2015-03-03 18:55:42','fghfghftt'),(25,37,'fghfghfghfgh','newyork','456456','Arizona','9999','asdsad',0,'2015-03-03 18:58:34','fghfghfgh'),(26,37,'fghfghfghfgh','newyork','456456','Arizona','9999','asdsad',0,'2015-03-03 18:58:57','fghfghfgh'),(27,37,'fghfghfghfgh','0','','None-Selected','0','0',0,'2015-03-03 19:00:01',''),(28,37,'asdasd','dasdasd','3333333333','Iowa','11111','asdasd',0,'2015-03-03 20:12:27','asdasdad'),(29,39,'fghfghfghfgh','ssadasd','456456','Alabama','9999','US',0,'2015-03-13 22:11:53','sdfsdfsdfsdf'),(30,39,'fghfghfghfgh','ssssss','456456','Arkansas','9999','123123',0,'2015-03-13 22:16:55','123123123123'),(31,39,'jhhjk','hjkhjk','456456','Arkansas','9999','hjkhjk',0,'2015-03-14 00:59:01','hjkhjkhj');
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
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'administrator','$2y$10$O8HHEbkSfCFSuhvKxzIjgOkUVmOSLkuwcTnctR7avNCfZynZKTS9G','boxhead.two.play@gmail.com',1,'','eacb8249ab6cc2ea5ea6893c293f13dca71f22e2',1425176028,'88ca18100e608235981ba294dd48c485558a8e6b7333570515139ced8fbdcaf4',0,NULL,'2014-12-17 01:22:04','192.168.1.1'),(6,'user','$2y$10$OXm6dfgxp5gfV8Zz6DAgU.BrFOwwE8djfMPCEITMp/ihHg4r6vP.a','hotmail@gmail.com',1,'',NULL,NULL,NULL,0,NULL,'2014-12-17 12:06:21','192.168.1.1'),(4,'payments_cut','$2y$10$oi2DxoLbQLs/9NlQJNrVEOlWl78e.NurP.iTRjZy/ynhXhL/htjdu','payments_cut@fleecefinderl.com',1,'9f5b0c09c7789a2657d2ce770ed3746109d01fb2',NULL,NULL,NULL,0,NULL,'2014-12-17 13:52:33','192.168.1.1'),(3,'payments_fee','$2y$10$w73x0SZ/fSmZXzZ.cforVePtNhlC8h4Ab1cWDwkqvGcVXkkld59mq','dwarvenknowledgellc@gmail.com',1,'',NULL,NULL,NULL,0,NULL,'2014-12-17 13:49:07','192.168.1.1'),(2,'payments_held','$2y$10$yxhAKSosi1D1GeLiSUFHceISw66qG/5RzSUolDzVl223fFngCo/Ma','boxhead.zombie.war@gmail.com',1,'',NULL,NULL,NULL,0,NULL,'2014-12-17 13:50:58','192.168.1.1'),(40,'promicheal','$2y$10$qQTiPNLUwZ4OXvThUUKw9OEurV31qocUXblcErxuUCnZVOEP0usp.','promicheal@outlook.com',1,'2d80f94dfe705542bf60759068f03fe98adb1b14',NULL,NULL,NULL,0,NULL,'2015-02-16 13:56:33','192.168.1.1'),(39,'Becca','$2y$10$7WGJS0weOtcw./XgSNS1cenrBIxOQBQqNWO1zLMt4hOAij8B7kGZe','sheep.r.cute@gmail.com',1,'2a4200331c4ceb5a495c493961e287af15c409ca','2efd66dd55e0ce33a555303097e8d773b4f91ebf',1425175654,'5c328a73ab5f1fbc868196c2bf270d95cea6fc13440d445e125317a22067de1f',0,NULL,'2015-01-27 17:15:26','192.168.1.1'),(38,'support','$2y$10$ukIZYr6sqgHs.mN02eJkDu.iTc.ywxcawLXc7q4Qj4ZaehYR5.HX6','sheep.r.cute2@gmail.com',1,'32d276b85501bbaee5234cd3f1dc9d11e883baf4',NULL,NULL,NULL,0,NULL,'2015-01-27 15:41:16','192.168.1.1'),(37,'username','$2y$10$Qlbtlx.w2IBA5g3HLCIU9uO/ofyKWvL6N5fvqGYzCM7SxfUfvoxU.','crapypizza@gmail.com',1,'4983b8d4f7e06076f8d8ebfe3e7a5e025432340a','570771886a7e2a658790bc56180053d65c4219af',1425001351,NULL,0,NULL,'2015-01-09 16:28:50','192.168.1.1');
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
INSERT INTO `users_farm_rating` VALUES (6,'1532','asdasd');
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
INSERT INTO `users_farminformation` VALUES (6,'[{\"profile_picture\":\"\\/\\/images\\/\\/upload_images\\/\\/user\\/\\/142172377328634f513f5c1110359599d9ecf.png\",\"profile_name\":\"Neatcooltestfsrm\",\"profile_short_description\":\"OurfarmisafarmwhomakesOurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsOOurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsurfarmisafarmwhomakesfarmingfarmsOurfarmisafarmwhomakesfarmingfarmsfarmingfarmsOurfarmisafar4\",\"short_biography\":\"sss\",\"terms_of_sale\":\"dff\",\"phone_number\":\"000-000-0000\",\"email\":\"3333email@domain.com\",\"website\":\"www.domain.com\",\"mobile_phone\":\"0101010101\",\"extra\":\"Callbetween9pmanddssd\"}]'),(38,'[{\"profile_picture\":\"\\/\\/images\\/\\/upload_images\\/\\/Becca\\/\\/14224021340083__article_image.jpg\",\"profile_name\":\"Beccas amazing farm\",\"profile_short_description\":\"Iamabeecca\",\"short_biography\":\"Iamthebecca\",\"terms_of_sale\":\"Yougivememoney\",\"phone_number\":false,\"email\":false,\"website\":false,\"mobile_phone\":false,\"extra\":\"no.\"}]'),(40,'[{\"profile_picture\":\"\\/\\/images\\/\\/upload_images\\/\\/promicheal\\/\\/1424124300r_mhirg7q4OQ1qjuvfeo5_1280.jpg\",\"profile_name\":\"Michaels amazing farm\",\"profile_short_description\":\"sdf\",\"short_biography\":\"sdf\",\"terms_of_sale\":\"sdf\",\"phone_number\":false,\"email\":false,\"website\":false,\"mobile_phone\":false,\"extra\":\"sdfsd\"}]');
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
INSERT INTO `users_funds` VALUES (1,0),(2,0),(3,54.6),(4,0),(6,945.8),(33,0),(34,0),(35,0),(36,0),(38,0),(39,9.6),(40,0);
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
INSERT INTO `users_products` VALUES (6,'{\"product_id\":\"120\",\"post_date\":\"12\\/18\\/2014\",\"0\":{\"product_id\":\"121\",\"post_date\":\"12\\/18\\/2014\"},\"1\":{\"product_id\":\"122\",\"post_date\":\"12\\/18\\/2014\"},\"2\":{\"product_id\":\"123\",\"post_date\":\"12\\/18\\/2014\"},\"3\":{\"product_id\":\"124\",\"post_date\":\"12\\/18\\/2014\"},\"4\":{\"product_id\":\"125\",\"post_date\":\"12\\/19\\/2014\"},\"5\":{\"product_id\":\"126\",\"post_date\":\"12\\/19\\/2014\"},\"6\":{\"product_id\":\"127\",\"post_date\":\"12\\/19\\/2014\"},\"7\":{\"product_id\":\"128\",\"post_date\":\"12\\/19\\/2014\"},\"8\":{\"product_id\":\"129\",\"post_date\":\"12\\/19\\/2014\"},\"9\":{\"product_id\":\"130\",\"post_date\":\"12\\/19\\/2014\"},\"10\":{\"product_id\":\"131\",\"post_date\":\"12\\/19\\/2014\"},\"11\":{\"product_id\":\"132\",\"post_date\":\"12\\/23\\/2014\"},\"12\":{\"product_id\":\"133\",\"post_date\":\"12\\/25\\/2014\"},\"13\":{\"product_id\":\"134\",\"post_date\":\"12\\/25\\/2014\"},\"14\":{\"product_id\":\"135\",\"post_date\":\"12\\/25\\/2014\"},\"15\":{\"product_id\":\"136\",\"post_date\":\"12\\/26\\/2014\"},\"16\":{\"product_id\":\"137\",\"post_date\":\"12\\/26\\/2014\"},\"17\":{\"product_id\":\"138\",\"post_date\":\"12\\/26\\/2014\"},\"18\":{\"product_id\":\"139\",\"post_date\":\"12\\/26\\/2014\"},\"19\":{\"product_id\":\"140\",\"post_date\":\"12\\/26\\/2014\"},\"20\":{\"product_id\":\"141\",\"post_date\":\"12\\/26\\/2014\"},\"21\":{\"product_id\":\"142\",\"post_date\":\"12\\/26\\/2014\"},\"22\":{\"product_id\":\"143\",\"post_date\":\"01\\/23\\/2015\"}}');
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
INSERT INTO `users_settings` VALUES (1,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(2,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(3,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(4,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(5,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(6,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(33,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(34,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(35,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(36,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(38,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(39,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}'),(40,'{\"Banned_From_Site\":\"false\",\"Banned_From_Rating\":\"false\",\"Banned_From_Messaging\":\"false\",\"Banned_From_Posting\":\"false\",\"Post_Fee\":\"0.0\",\"User_Allow_Messages\":\"true\"}');
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

-- Dump completed on 2015-03-14  1:15:48
