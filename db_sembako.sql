/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 10.4.21-MariaDB : Database - db_sembako
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_sembako` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_sembako`;

/*Table structure for table `tbl_barang` */

DROP TABLE IF EXISTS `tbl_barang`;

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(35) NOT NULL,
  `harga_barang` decimal(10,2) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `stok` smallint(6) DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `relasi_kategori` (`id_kategori`),
  CONSTRAINT `relasi_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_barang` */

insert  into `tbl_barang`(`id_barang`,`nama_barang`,`harga_barang`,`gambar`,`stok`,`satuan`,`id_kategori`,`created_at`,`updated_at`) values 
(1,'Beras',12000.00,NULL,0,'kg',1,'2021-12-08 13:47:03',NULL),
(2,'Gula Putih',5000.00,NULL,0,'kg',1,'2021-12-08 13:52:01','2022-01-04 13:38:52'),
(11,'Telur',12000.00,'images/mC6HquCb/saurav-mahto-ijWb7URJQyo-unsplash.jpg',0,'kg',1,'2022-01-04 12:56:38','2022-01-04 13:37:28'),
(14,'Shampo',2000.00,'',0,'renteng',2,'2022-01-04 13:43:36','2022-01-04 15:39:54');

/*Table structure for table `tbl_detail_pembelian` */

DROP TABLE IF EXISTS `tbl_detail_pembelian`;

CREATE TABLE `tbl_detail_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_pembelian`,`id_barang`),
  KEY `relasi_detail_beli_barang` (`id_barang`),
  CONSTRAINT `relasi_detail_beli_barang` FOREIGN KEY (`id_barang`) REFERENCES `tbl_barang` (`id_barang`),
  CONSTRAINT `relasi_detail_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `tbl_pembelian` (`id_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_detail_pembelian` */

/*Table structure for table `tbl_detail_penjualan` */

DROP TABLE IF EXISTS `tbl_detail_penjualan`;

CREATE TABLE `tbl_detail_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`,`id_barang`),
  KEY `relasi_detail_barang` (`id_barang`),
  CONSTRAINT `relasi_detail_barang` FOREIGN KEY (`id_barang`) REFERENCES `tbl_barang` (`id_barang`),
  CONSTRAINT `relasi_detail_penjualan` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_penjualan` (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_detail_penjualan` */

/*Table structure for table `tbl_kategori` */

DROP TABLE IF EXISTS `tbl_kategori`;

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_kategori` */

insert  into `tbl_kategori`(`id_kategori`,`nama_kategori`) values 
(1,'Bahan Pokok'),
(2,'Bahan Sekunder'),
(5,'Bahan Tersier');

/*Table structure for table `tbl_pembelian` */

DROP TABLE IF EXISTS `tbl_pembelian`;

CREATE TABLE `tbl_pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `relasi_pembelian_user` (`id_user`),
  CONSTRAINT `relasi_pembelian_user` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_pembelian` */

/*Table structure for table `tbl_penjualan` */

DROP TABLE IF EXISTS `tbl_penjualan`;

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`),
  KEY `relasi_penjualan_user` (`id_user`),
  CONSTRAINT `relasi_penjualan_user` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_penjualan` */

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('Admin','Pegawai') DEFAULT 'Pegawai',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`nama_user`,`username`,`password`,`level`) values 
(1,'M Firhan Madani','madani','12345','Admin'),
(2,'Ghazali','ozaghazali','qwerty','Pegawai'),
(5,'Dummy','dummys','qwerty','Pegawai'),
(7,'Bu Minah','minah','qwerty','Admin'),
(8,'Donny','dony','hahaha','Pegawai');

/* Trigger structure for table `tbl_detail_pembelian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_pembelian_after_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_pembelian_after_insert` AFTER INSERT ON `tbl_detail_pembelian` FOR EACH ROW BEGIN
	UPDATE tbl_barang SET stok = tbl_barang.stok + NEW.jumlah WHERE tbl_barang.id_barang = NEW.id_barang;
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_detail_penjualan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_penjualan_after_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_penjualan_after_insert` AFTER INSERT ON `tbl_detail_penjualan` FOR EACH ROW BEGIN
	UPDATE tbl_barang SET stok = tbl_barang.stok - NEW.jumlah WHERE tbl_barang.id_barang = NEW.id_barang;
END */$$


DELIMITER ;

/*Table structure for table `view_barang` */

DROP TABLE IF EXISTS `view_barang`;

/*!50001 DROP VIEW IF EXISTS `view_barang` */;
/*!50001 DROP TABLE IF EXISTS `view_barang` */;

/*!50001 CREATE TABLE  `view_barang`(
 `id_barang` int(11) ,
 `nama_barang` varchar(35) ,
 `harga_barang` decimal(10,2) ,
 `gambar` varchar(255) ,
 `stok` smallint(6) ,
 `satuan` varchar(10) ,
 `id_kategori` int(11) ,
 `nama_kategori` varchar(35) 
)*/;

/*Table structure for table `view_detail_pembelian` */

DROP TABLE IF EXISTS `view_detail_pembelian`;

/*!50001 DROP VIEW IF EXISTS `view_detail_pembelian` */;
/*!50001 DROP TABLE IF EXISTS `view_detail_pembelian` */;

/*!50001 CREATE TABLE  `view_detail_pembelian`(
 `id_pembelian` int(11) ,
 `nama_user` varchar(50) ,
 `nama_barang` varchar(35) ,
 `jumlah` int(3) ,
 `total` decimal(10,2) ,
 `tanggal` datetime ,
 `id_barang` int(11) 
)*/;

/*Table structure for table `view_detail_penjualan` */

DROP TABLE IF EXISTS `view_detail_penjualan`;

/*!50001 DROP VIEW IF EXISTS `view_detail_penjualan` */;
/*!50001 DROP TABLE IF EXISTS `view_detail_penjualan` */;

/*!50001 CREATE TABLE  `view_detail_penjualan`(
 `id_penjualan` int(11) ,
 `nama_user` varchar(50) ,
 `nama_barang` varchar(35) ,
 `jumlah` int(3) ,
 `total` decimal(10,2) ,
 `tanggal` datetime ,
 `id_barang` int(11) 
)*/;

/*View structure for view view_barang */

/*!50001 DROP TABLE IF EXISTS `view_barang` */;
/*!50001 DROP VIEW IF EXISTS `view_barang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_barang` AS select `a`.`id_barang` AS `id_barang`,`a`.`nama_barang` AS `nama_barang`,`a`.`harga_barang` AS `harga_barang`,`a`.`gambar` AS `gambar`,`a`.`stok` AS `stok`,`a`.`satuan` AS `satuan`,`a`.`id_kategori` AS `id_kategori`,`b`.`nama_kategori` AS `nama_kategori` from (`tbl_barang` `a` join `tbl_kategori` `b` on(`b`.`id_kategori` = `a`.`id_kategori`)) */;

/*View structure for view view_detail_pembelian */

/*!50001 DROP TABLE IF EXISTS `view_detail_pembelian` */;
/*!50001 DROP VIEW IF EXISTS `view_detail_pembelian` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detail_pembelian` AS select `a`.`id_pembelian` AS `id_pembelian`,`d`.`nama_user` AS `nama_user`,`b`.`nama_barang` AS `nama_barang`,`a`.`jumlah` AS `jumlah`,`a`.`total` AS `total`,`c`.`tanggal` AS `tanggal`,`b`.`id_barang` AS `id_barang` from (((`tbl_detail_pembelian` `a` left join `tbl_barang` `b` on(`b`.`id_barang` = `a`.`id_barang`)) left join `tbl_pembelian` `c` on(`c`.`id_pembelian` = `a`.`id_pembelian`)) left join `tbl_user` `d` on(`d`.`id_user` = `c`.`id_user`)) order by `c`.`tanggal` desc */;

/*View structure for view view_detail_penjualan */

/*!50001 DROP TABLE IF EXISTS `view_detail_penjualan` */;
/*!50001 DROP VIEW IF EXISTS `view_detail_penjualan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detail_penjualan` AS select `a`.`id_penjualan` AS `id_penjualan`,`d`.`nama_user` AS `nama_user`,`b`.`nama_barang` AS `nama_barang`,`a`.`jumlah` AS `jumlah`,`a`.`total` AS `total`,`c`.`tanggal` AS `tanggal`,`b`.`id_barang` AS `id_barang` from (((`tbl_detail_penjualan` `a` left join `tbl_barang` `b` on(`b`.`id_barang` = `a`.`id_barang`)) left join `tbl_penjualan` `c` on(`c`.`id_penjualan` = `a`.`id_penjualan`)) left join `tbl_user` `d` on(`d`.`id_user` = `c`.`id_user`)) order by `c`.`tanggal` desc */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
