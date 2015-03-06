/*
SQLyog Ultimate v8.55 
MySQL - 5.5.36 : Database - e_chart
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

insert  into `app_admin`(`admin_id`,`admin_name`,`admin_username`,`admin_password`,`admin_status`,`admin_email`,`created_date`,`admin_last_login`,`admin_login_ip`) values (1,'Administrator','admin','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec','1','arivu@creativert.com','2015-01-10 19:35:03','2015-02-28 10:29:02','::1');

/*Table structure for table `app_companies` */

DROP TABLE IF EXISTS `app_companies`;

CREATE TABLE `app_companies` (
  `company_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(150) NOT NULL,
  `company_address` text,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `app_companies` */

insert  into `app_companies`(`company_id`,`company_name`,`company_address`,`status`) values (1,'EstWest Corporate','Test Address','1'),(2,'Company 2','Sample Address','1');

/*Table structure for table `app_departmets` */

DROP TABLE IF EXISTS `app_departmets`;

CREATE TABLE `app_departmets` (
  `dept_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(150) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `app_departmets` */

insert  into `app_departmets`(`dept_id`,`dept_name`,`status`) values (1,'Presidency','1'),(2,'Commercial Department','1'),(3,'Human Resources Department','1'),(4,'Finance Department','1');

/*Table structure for table `app_positions` */

DROP TABLE IF EXISTS `app_positions`;

CREATE TABLE `app_positions` (
  `position_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(150) NOT NULL,
  `position_status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `app_positions` */

insert  into `app_positions`(`position_id`,`position_name`,`position_status`) values (1,'CEO','1'),(2,'Assistant','1'),(3,'Sales Manager','1'),(4,'Human Ressources Manager','1'),(5,'CFO','1'),(6,'Manager SIRH','1'),(7,'Test Position','1');

/*Table structure for table `app_sites` */

DROP TABLE IF EXISTS `app_sites`;

CREATE TABLE `app_sites` (
  `site_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(150) NOT NULL,
  `reception_mail` varchar(100) NOT NULL,
  `reception_phone` varchar(50) NOT NULL,
  `parking_phone` varchar(50) DEFAULT NULL,
  `tel_security` varchar(50) DEFAULT NULL,
  `address` text,
  `restaurant` text,
  `information` text,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `app_sites` */

insert  into `app_sites`(`site_id`,`site_name`,`reception_mail`,`reception_phone`,`parking_phone`,`tel_security`,`address`,`restaurant`,`information`,`status`) values (1,'Headquarters','SamuelJChappell@dayrep.com','859-331-2620','455-331-5487','01 41 13 12 80 ','1 Place de l\'Iris, 92 400 Courbevoie - La Défense','Monday to Thursday: 11.30 - 14.00\r\nFriday: 11.30 - 13.45',' New badges Parking available at the reception ','1'),(2,'Saturn building','PhilipEFelker@jourrapide.com','207-329-1440','154-544-5656','01 41 13 12 80 ','1 Place de l\'Iris, 92 400 Courbevoie - La Défense','Monday to Thursday: 11.30 - 14.00\r\nFriday: 11.30 - 13.45',' New badges Parking available at the reception ','1'),(3,'Test Site','test@test.com','564984989','','','','','','1');

/*Table structure for table `app_user_profile` */

DROP TABLE IF EXISTS `app_user_profile`;

CREATE TABLE `app_user_profile` (
  `prof_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `prof_firstname` varchar(100) NOT NULL,
  `prof_lastname` varchar(100) DEFAULT NULL,
  `prof_position` bigint(20) NOT NULL,
  `prof_department` bigint(20) NOT NULL,
  `prof_personal_staff` bigint(20) DEFAULT NULL,
  `prof_phone` varchar(50) DEFAULT NULL,
  `prof_mobile` varchar(50) NOT NULL,
  `prof_fax` varchar(50) DEFAULT NULL,
  `prof_office` varchar(50) DEFAULT NULL,
  `prof_site` bigint(20) DEFAULT NULL,
  `prof_sheet_position` varchar(255) DEFAULT NULL,
  `prof_site_2` bigint(20) DEFAULT NULL,
  `prof_phone_2` varchar(100) DEFAULT NULL,
  `prof_structure_code` varchar(50) DEFAULT NULL,
  `prof_department_2` bigint(20) DEFAULT NULL,
  `prof_company` bigint(20) DEFAULT NULL,
  `prof_hierarchy` varchar(100) DEFAULT NULL,
  `prof_code_site` bigint(20) DEFAULT NULL,
  `prof_sheet_structrure` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`prof_id`),
  KEY `FK_app_user_profile_company` (`prof_company`),
  KEY `FK_app_user_profile_department_1` (`prof_department`),
  KEY `FK_app_user_profile_department_2` (`prof_department_2`),
  KEY `FK_app_user_profile_position` (`prof_position`),
  KEY `FK_app_user_profile_site_1` (`prof_site`),
  KEY `FK_app_user_profile_site_2` (`prof_site_2`),
  CONSTRAINT `FK_app_user_profile_site_2` FOREIGN KEY (`prof_site_2`) REFERENCES `app_sites` (`site_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_app_user_profile_company` FOREIGN KEY (`prof_company`) REFERENCES `app_companies` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_app_user_profile_department_1` FOREIGN KEY (`prof_department`) REFERENCES `app_departmets` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_app_user_profile_department_2` FOREIGN KEY (`prof_department_2`) REFERENCES `app_departmets` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_app_user_profile_position` FOREIGN KEY (`prof_position`) REFERENCES `app_positions` (`position_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_app_user_profile_site_1` FOREIGN KEY (`prof_site`) REFERENCES `app_sites` (`site_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `app_user_profile` */

insert  into `app_user_profile`(`prof_id`,`user_id`,`prof_firstname`,`prof_lastname`,`prof_position`,`prof_department`,`prof_personal_staff`,`prof_phone`,`prof_mobile`,`prof_fax`,`prof_office`,`prof_site`,`prof_sheet_position`,`prof_site_2`,`prof_phone_2`,`prof_structure_code`,`prof_department_2`,`prof_company`,`prof_hierarchy`,`prof_code_site`,`prof_sheet_structrure`) values (1,1,'Arivu','Ajay',2,1,NULL,'43543543','43543543','435435','43543543',1,'7733-Photo_2.jpg',2,'34543543','345435435',1,1,'43543',1,'8433-Photo_3.jpg'),(2,2,'President','Test',1,1,1,'43543543','43543543','435435','43543543',2,'8973-Photo_3.jpg',2,'','',1,1,'',1,'');

/*Table structure for table `app_users` */

DROP TABLE IF EXISTS `app_users`;

CREATE TABLE `app_users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(256) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_prof_image` varchar(500) NOT NULL,
  `user_status` enum('0','1','2') NOT NULL DEFAULT '1',
  `user_activation_key` varchar(250) DEFAULT NULL,
  `user_last_login` datetime DEFAULT NULL,
  `user_login_ip` varchar(250) DEFAULT NULL,
  `reset_password_string` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `NewIndex1` (`user_activation_key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `app_users` */

insert  into `app_users`(`user_id`,`user_name`,`user_email`,`user_password`,`user_prof_image`,`user_status`,`user_activation_key`,`user_last_login`,`user_login_ip`,`reset_password_string`,`created`,`modified`) values (1,'Secretary','secretary@test.com','354d8f2a3b0c6892f29efcee2c5364b2ecd2fb41b8f6bcdfea12f0135fa5cc26ae7404edda263f2539881aab899a60d965b804de4f66f39b6854a17541825925','9010-Photo_1.jpg','1','v3Ypur5Dq',NULL,'::1',NULL,'2015-02-28 10:36:14','2015-02-28 10:36:14'),(2,'Precident','precident@test.com','c22e41683a6b37a9889ae05202c67cba815de7432b0a891a369dbc9fea2851b69659a9d887cb3c69055ef365b4dea0f1cef41ca525af4601dfe209246a81ab17','8383-Photo_2.jpg','1','PF1upL5fx',NULL,'::1',NULL,'2015-02-28 10:37:43','2015-02-28 10:37:43');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
