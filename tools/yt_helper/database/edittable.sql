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
/*Table structure for table `tbl_campaign` */

DROP TABLE IF EXISTS `tbl_campaign`;

CREATE TABLE `tbl_campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` varchar(100) NOT NULL,
  `proID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


insert  into `tbl_campaign`(`id`,`campaign`,`proID`) values (1,'Rinso Campaigns',2),(2,'Pepsodent Campaigns',4);



DROP TABLE IF EXISTS `tbl_project`;

CREATE TABLE `tbl_project` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `seo` tinyint(1) NOT NULL,
  `sem` tinyint(1) NOT NULL,
  `social` tinyint(1) NOT NULL,
  `kpi` int(100) NOT NULL,
  `project_status` tinyint(1) NOT NULL,
  `channel_id` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


insert  into `tbl_project`(`id`,`name`,`start_date`,`seo`,`sem`,`social`,`kpi`,`project_status`,`channel_id`,`description`,`userID`) values (1,'CASTROL POWER 1','2012-03-03',1,0,0,10000,1,'CastrolAsiaPacific',NULL,9),(2,'RINSO CAMPAIGNS','2012-02-27',0,1,0,10000,1,'0','SEM optimization on Rinso Campaigns',10),(4,'PEPSODENT CAMPAIGNS','2012-04-17',0,1,0,10000,1,'0','SEM optimization on Pepsodent Campaigns',11);


DROP TABLE IF EXISTS `tbl_project_budget`;

CREATE TABLE `tbl_project_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `budget` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_project` (`id_project`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;



insert  into `tbl_project_budget`(`id`,`id_project`,`budget`) values (3,2,'100000'),(4,4,'100000');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
