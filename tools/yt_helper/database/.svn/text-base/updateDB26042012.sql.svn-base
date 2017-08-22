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

insert  into `tbl_kpi`(`projectID`,`tipe`,`kpi`,`kpi_month`,`kpi_daily`) values (2,'click',127731,12773.1,425.77),(4,'click',121658,121658,8689.86),(2,'ctr',1,0,0),(4,'ctr',1,0,0),(2,'cpc',0.14,0,0),(4,'cpc',0.08,0,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project` */

insert  into `tbl_project`(`id`,`name`,`start_date`,`end_date`,`seo`,`sem`,`social`,`kpi`,`project_status`,`channel_id`,`description`,`userID`) values (1,'CASTROL POWER 1','2012-03-03','0000-00-00',1,0,0,10000,1,'CastrolAsiaPacific',NULL,9),(2,'RINSO CAMPAIGNS','2012-02-27','2012-12-31',0,1,0,10000,1,'0','SEM optimization on Rinso Campaigns',10),(4,'PEPSODENT CAMPAIGNS','2012-04-17','2012-04-30',0,1,0,10000,1,'0','SEM optimization on Pepsodent Campaigns',11);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
