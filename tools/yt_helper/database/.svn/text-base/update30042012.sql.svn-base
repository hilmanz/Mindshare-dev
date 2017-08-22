/*
SQLyog Ultimate v8.54 
MySQL - 5.5.9 : Database - mindsharedb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `gm_user` */

DROP TABLE IF EXISTS `gm_user`;

CREATE TABLE `gm_user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `enc_key` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `gm_user` */

insert  into `gm_user`(`userID`,`username`,`password`,`enc_key`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','f91863fd71ac9a130d88e65244ecf688'),(9,'castrol','f3c37f795b84049f45884f742de06f2d','5d19bd0267b8352cb82c7cec0ad68d58'),(10,'rinso','b1f67cd4509b07685b167679cc9e7f72','659f07427710ec361a74cc1c795a88e0'),(11,'pepsodent','c4194dd4157f49524683685d12781d74','f4a1a49db70980767ad5e17311560fdb'),(12,'axeadwords','fa1115a96b26727137884a32362ebf95','cc1c81f484abe062e8e08af8306d2356'),(13,'mindshare','af9550ff1869954f27ca847e1d532604','21516ecd551eceb9f5a22dbd4c0c4648'),(14,'mindsharejkt','af9550ff1869954f27ca847e1d532604','d0d447f84615e762897f118c19f09180');

/*Table structure for table `tbl_campaign` */

DROP TABLE IF EXISTS `tbl_campaign`;

CREATE TABLE `tbl_campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` varchar(100) NOT NULL,
  `proID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_campaign` */

insert  into `tbl_campaign`(`id`,`campaign`,`proID`) values (1,'Rinso Campaigns',2),(2,'Pepsodent Campaigns',4),(3,'Axe Campaigns',5);

/*Table structure for table `tbl_kpi` */

DROP TABLE IF EXISTS `tbl_kpi`;

CREATE TABLE `tbl_kpi` (
  `projectID` int(100) NOT NULL,
  `tipe` varchar(15) NOT NULL,
  `kpi` float NOT NULL,
  `kpi_month` float NOT NULL,
  `kpi_daily` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kpi` */

insert  into `tbl_kpi`(`projectID`,`tipe`,`kpi`,`kpi_month`,`kpi_daily`) values (2,'click',127731,12773.1,425.77),(4,'click',121658,121658,8689.86),(2,'ctr',1,0,0),(4,'ctr',1,0,0),(2,'cpc',0.14,0,0),(4,'cpc',0.08,0,0),(2,'budget',0,0,50),(4,'budget',0,0,800),(5,'budget',64030.1,64030.1,2134.34),(5,'ctr',1,0,0);

/*Table structure for table `tbl_project` */

DROP TABLE IF EXISTS `tbl_project`;

CREATE TABLE `tbl_project` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `seo` tinyint(1) NOT NULL,
  `sem` tinyint(1) NOT NULL,
  `social` tinyint(1) NOT NULL,
  `kpi` int(100) NOT NULL,
  `project_status` tinyint(1) NOT NULL,
  `channel_id` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project` */

insert  into `tbl_project`(`id`,`name`,`start_date`,`end_date`,`seo`,`sem`,`social`,`kpi`,`project_status`,`channel_id`,`description`,`userID`) values (1,'CASTROL POWER 1','2012-03-03','0000-00-00',1,0,0,10000,1,'CastrolAsiaPacific',NULL,9),(2,'RINSO AKSI 1 TUTUP BOTOL','2012-02-27','2012-12-31',0,1,0,10000,1,'0','SEM optimization on Rinso Aksi 1 Tutup Botol',10),(4,'PEPSODENT SENSEHOLIC','2012-04-17','2012-04-30',0,1,0,10000,1,'0','SEM optimization on Pepsodent Senseholic',11),(5,'AXE','2012-04-19','2012-05-18',0,1,0,1000,1,'0','SEM optimization on Axe',12);

/*Table structure for table `tbl_project_budget` */

DROP TABLE IF EXISTS `tbl_project_budget`;

CREATE TABLE `tbl_project_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `budget` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_project` (`id_project`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project_budget` */

insert  into `tbl_project_budget`(`id`,`id_project`,`budget`) values (3,2,18233),(4,4,10586),(5,5,7289.43);

/*Table structure for table `tbl_project_user` */

DROP TABLE IF EXISTS `tbl_project_user`;

CREATE TABLE `tbl_project_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project_user` */

insert  into `tbl_project_user`(`id`,`user_id`,`project_id`) values (1,13,1),(2,13,2),(3,13,4),(4,9,1),(5,10,2),(6,11,4),(7,14,2),(8,14,4),(9,12,5),(10,14,5),(11,13,5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
