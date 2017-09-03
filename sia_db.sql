/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.21-MariaDB : Database - sia_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sia_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sia_db`;

/*Table structure for table `award` */

DROP TABLE IF EXISTS `award`;

CREATE TABLE `award` (
  `award_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(4) DEFAULT NULL,
  `information` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`award_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `award_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `award` */

/*Table structure for table `f_edu` */

DROP TABLE IF EXISTS `f_edu`;

CREATE TABLE `f_edu` (
  `f_edu_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_year` varchar(4) DEFAULT NULL,
  `graduate_year` varchar(4) DEFAULT NULL,
  `level` varchar(4) DEFAULT NULL,
  `school` varchar(45) DEFAULT NULL,
  `major` varchar(45) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`f_edu_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `f_edu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `f_edu` */

/*Table structure for table `nf_edu` */

DROP TABLE IF EXISTS `nf_edu`;

CREATE TABLE `nf_edu` (
  `nf_edu_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_year` varchar(4) DEFAULT NULL,
  `graduate_year` varchar(4) DEFAULT NULL,
  `school` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`nf_edu_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `nf_edu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nf_edu` */

/*Table structure for table `org_exp` */

DROP TABLE IF EXISTS `org_exp`;

CREATE TABLE `org_exp` (
  `org_exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(4) DEFAULT NULL,
  `information` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`org_exp_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `org_exp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `org_exp` */

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) DEFAULT NULL,
  `information` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `role` */

/*Table structure for table `skill` */

DROP TABLE IF EXISTS `skill`;

CREATE TABLE `skill` (
  `skill_id` int(11) NOT NULL AUTO_INCREMENT,
  `information` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`skill_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `skill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `skill` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) NOT NULL,
  `first_email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_token` varchar(50) DEFAULT NULL,
  `auth_key` varchar(50) DEFAULT NULL,
  `verification_status` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`user_id`,`full_name`,`first_email`,`password`,`password_hash`,`password_token`,`auth_key`,`verification_status`,`created_at`,`updated_at`) values (15,'Muhammad Zulfi Ashari','zulfi.ashari@gmail.com','muhammadZULFIashari94','$2y$13$7eJGQzPvJ4DKA8qGXCEeKOUFi4MlC44QDvAWYiLCH7a6ywprePHTO','1a144f6ddd1b7a7e32747ec88c366199d61bff85','7ffd0c3287a36d5f4d3c03c45269ae61942f63ac',1,NULL,'2017-09-03 12:04:19');

/*Table structure for table `user_data` */

DROP TABLE IF EXISTS `user_data`;

CREATE TABLE `user_data` (
  `user_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(15) NOT NULL,
  `hp_no` int(15) NOT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `born_date` date DEFAULT NULL,
  `second_email` varchar(50) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `pln_entry_year` int(4) NOT NULL,
  `employee_status` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `current_position` varchar(50) NOT NULL,
  `goal_position` varchar(50) DEFAULT NULL,
  `cv_path` varchar(255) DEFAULT NULL,
  `pp_path` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_data_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_data` */

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `user_role` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_role`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_role` */

/*Table structure for table `work_exp` */

DROP TABLE IF EXISTS `work_exp`;

CREATE TABLE `work_exp` (
  `work_exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_year` varchar(4) DEFAULT NULL,
  `finish_year` varchar(4) DEFAULT NULL,
  `company` varchar(45) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`work_exp_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `work_exp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `work_exp` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
