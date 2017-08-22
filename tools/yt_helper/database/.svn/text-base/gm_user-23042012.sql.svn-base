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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `gm_user` */

insert  into `gm_user`(`userID`,`username`,`password`,`enc_key`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','f91863fd71ac9a130d88e65244ecf688'),(9,'castrol','f3c37f795b84049f45884f742de06f2d','5d19bd0267b8352cb82c7cec0ad68d58'),(10,'rinso','b1f67cd4509b07685b167679cc9e7f72','659f07427710ec361a74cc1c795a88e0'),(11,'pepsodent','c4194dd4157f49524683685d12781d74','f4a1a49db70980767ad5e17311560fdb'),(12,'axeadwords','fa1115a96b26727137884a32362ebf95','cc1c81f484abe062e8e08af8306d2356');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
