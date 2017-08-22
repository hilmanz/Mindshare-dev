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
/*Table structure for table `tbl_semad_summary` */

DROP TABLE IF EXISTS `tbl_semad_summary`;

CREATE TABLE `tbl_semad_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semID` int(11) NOT NULL,
  `range_date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `clicks` float NOT NULL,
  `impression` float NOT NULL,
  `ctr` float NOT NULL,
  `avg_cpc` float NOT NULL,
  `cost` float NOT NULL,
  `avg_position` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `semID` (`semID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_semad_summary` */

insert  into `tbl_semad_summary`(`id`,`semID`,`range_date`,`description`,`clicks`,`impression`,`ctr`,`avg_cpc`,`cost`,`avg_position`) values (1,2,'2012-04-24','Total - all enabled campaigns',34264,1242280,2.76,0.1,3458.83,3.46),(2,2,'2012-04-24','Total - Search',34923,1309910,2.67,0.11,3753.83,3.4),(3,2,'2012-04-24','Total - Display Network',5941,19844500,0.03,0.43,2531.23,1.96),(4,2,'2012-04-24','Total',40864,21154400,0.19,0.15,6285.06,2.05),(5,4,'2012-04-24','Total - all enabled campaigns',67879,18013300,0.38,0.08,5118.17,1.71),(6,4,'2012-04-24','Total - Search',24319,554121,4.39,0.05,1201.4,2.6),(7,4,'2012-04-24','Total - Display Network',43560,17459200,0.25,0.09,3916.77,1.69),(8,4,'2012-04-24','Total',67879,18013300,0.38,0.08,5118.17,1.71),(9,2,'2012-04-24','Total - all enabled campaigns',773,22239,3.48,0.07,50.6,3.78),(10,2,'2012-04-24','Total - Search',773,22239,3.48,0.07,50.6,3.78),(11,2,'2012-04-24','Total - Display Network',0,0,0,0,0,0),(12,2,'2012-04-24','Total',773,22239,3.48,0.07,50.6,3.78),(13,4,'2012-04-24','Total - all enabled campaigns',15598,2577560,0.61,0.05,757.73,1.88),(14,4,'2012-04-24','Total - Search',7005,126600,5.53,0.03,226.49,2.71),(15,4,'2012-04-24','Total - Display Network',8593,2450960,0.35,0.06,531.24,1.84),(16,4,'2012-04-24','Total',15598,2577560,0.61,0.05,757.73,1.88),(17,2,'2012-04-25','Total - all enabled campaigns',826,24559,3.36,0.06,50.14,3.91),(18,2,'2012-04-25','Total - Search',826,24559,3.36,0.06,50.14,3.91),(19,2,'2012-04-25','Total - Display Network',0,0,0,0,0,0),(20,2,'2012-04-25','Total',826,24559,3.36,0.06,50.14,3.91),(21,4,'2012-04-25','Total - all enabled campaigns',16731,2620100,0.64,0.05,775.79,2),(22,4,'2012-04-25','Total - Search',6960,118331,5.88,0.03,202.13,2.82),(23,4,'2012-04-25','Total - Display Network',9771,2501770,0.39,0.06,573.66,1.96),(24,4,'2012-04-25','Total',16731,2620100,0.64,0.05,775.79,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
