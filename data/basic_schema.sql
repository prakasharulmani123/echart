/*
SQLyog Ultimate v8.55 
MySQL - 5.5.36 : Database - price_calc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `app_admin` */

DROP TABLE IF EXISTS `app_admin`;

CREATE TABLE `app_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_status` enum('0','1') NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `admin_login_ip` varchar(255) NOT NULL,
  UNIQUE KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `app_admin` */

insert  into `app_admin`(`admin_id`,`admin_name`,`admin_username`,`admin_password`,`admin_status`,`admin_email`,`created_date`,`admin_last_login`,`admin_login_ip`) values (1,'Administrator','admin','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec','1','arivu@creativert.com','2015-01-10 19:35:03','2015-02-25 09:42:06','::1');

/*Table structure for table `app_users` */

DROP TABLE IF EXISTS `app_users`;

CREATE TABLE `app_users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(256) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_prof_image` varchar(500) NOT NULL,
  `user_status` enum('0','1','2') NOT NULL DEFAULT '0',
  `user_activation_key` varchar(250) DEFAULT NULL,
  `user_last_login` datetime DEFAULT NULL,
  `user_login_ip` varchar(250) DEFAULT NULL,
  `reset_password_string` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `NewIndex1` (`user_activation_key`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `app_users` */

insert  into `app_users`(`user_id`,`user_name`,`user_email`,`user_password`,`user_prof_image`,`user_status`,`user_activation_key`,`user_last_login`,`user_login_ip`,`reset_password_string`,`created`,`modified`) values (8,'aaaa','aaaa@gmail.com','3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79','','1','nwBiCBv8n','2015-01-14 05:02:20','122.174.109.49',NULL,NULL,NULL),(9,'Prakash','pamds9@gmail.com','c9efd9d1ad468c0d9e0e2422f2bd37133129eb15dc122197d3bce6ea9bc7507dd2bbc055deecaac99d6f9e8ac5ffed9af5aacd7ee88286e119f8364bc10b2760','','2',NULL,'2015-01-17 20:17:41','122.174.154.218',NULL,'2015-01-17 08:17:21','2015-01-17 08:17:21'),(10,'marudhupandiyan14','marudhupandiyan14@gmail.com','01a6bbf049717baedfc3b1c338699f406c2501864ada4f2008b1cf39cf0631dd89e5c015a5c2c53d78acccca59b093c6eb145933d0ed2fcc6feae24ea49cc4c0','','2','LpGY6lOiX',NULL,'122.174.74.39',NULL,'2015-01-19 06:55:51','2015-01-19 06:55:51'),(11,'ptrckstnly','ptrckstnly@gmail.com','3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79','1422950868_11_9.jpg','2','S0uLeZaan','2015-02-05 18:45:38','::1','','2015-01-19 08:17:48','2015-01-21 11:57:39'),(12,'udhyakumar','udhyakumarm@gmail.com','daef4953b9783365cad6615223720506cc46c5167cd16ab500fa597aa08ff964eb24fb19687f34d7665f778fcb6c5358fc0a5b81e1662cf90f73a2671c53f991','','1','PsRxSDv2C','2015-01-21 11:45:57','61.3.110.73',NULL,'2015-01-20 10:28:53','2015-01-20 10:28:53'),(13,'Marudhu','marudhukarthick_1985@yahoo.co.in','95ca56f4ea26bd5ec0209359b44746ca5f8f7256c23584730c19d64008c3ec30546e9a96a24484c2279fec38c9f7eec620167fe5a8bbb7a023ab32147c229126','','1',NULL,'2015-01-21 17:18:16','122.174.120.242',NULL,'2015-01-21 11:40:33','2015-01-21 11:40:33'),(14,'Rajendran','ceo@arkinfotec.com','e26c78fe5b9cf7a025cdaf9717bb2486fd9104796a462d20ad784d565be037c71556acb353bba6794696e751acaafa5f2e5fee722849591e6a36366d3f4e1d25','','1','MHbLZBG6m','2015-01-21 11:46:51','122.174.121.0',NULL,'2015-01-21 11:46:16','2015-01-21 11:46:16'),(15,'e2h','e2h@gmail.com','68e4264f2e7f6298d94fe4d11e5bb63f61c464fe1581a09fe443fa85f26fd9053e9ec1c3700cb246464a079da67482a71e19a6b37522147dc3421e6be65e5af4','','0','aHPEZCRxk',NULL,'122.174.120.242',NULL,'2015-01-21 01:44:03','2015-01-21 01:44:03'),(16,'marudhubangalore','marudhubangalore@gmail.com','ba94db91ba9096ce1f98a1ceddbaa0b5bfa400002c1e4f90a281b5557a550a342c41f0cd1a240e0e2df9723edce1bd148851c76f324853643286e53b12744496','','1','8PBHGMDWS','2015-01-21 18:45:09','122.174.120.242',NULL,'2015-01-21 01:44:45','2015-01-21 01:44:45'),(17,'sivaji','marudhu.murugesan@arkinfotec.com','dd737930f7e5fa9ac7056e3d43048e772adfb58a46e5c48f3795b57cbf54515b0592d1692b99eb1c8984aa1d36f62dc2e0e9ec951cff38d46b1ba0d4ba045768','','1','wZZNOn8u6','2015-01-21 17:13:08','122.174.120.242',NULL,'2015-01-21 04:54:35','2015-01-21 04:54:35'),(43,'testinomor','testinomor@gmail.com','455df601ba52e06011427dc1cc70812f18671edb29591b8aa854a3591db5403d4f52a2c15fcfcbd1aa928cd9cc295ecc14b90ddf78e46435a796d558d97b9e80','','0','TRH6mXbEO',NULL,'122.174.120.242',NULL,'2015-01-21 06:42:34','2015-01-21 06:42:34'),(44,'Arivu Ajay','arivcsdfazhagan.pandi@arkinfotec.com','d404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db','','1','ne4LWaDN1','2015-01-26 17:16:57','::1',NULL,'2015-01-26 09:32:31','2015-01-26 09:32:31');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
