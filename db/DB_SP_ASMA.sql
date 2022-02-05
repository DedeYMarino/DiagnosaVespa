/*
SQLyog Ultimate v9.63 
MySQL - 5.5.27 : Database - certaintyfactor
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`certaintyfactor` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `certaintyfactor`;

/*Table structure for table `gejala` */

DROP TABLE IF EXISTS `gejala`;

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id_gejala`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `gejala` */

insert  into `gejala`(`id_gejala`,`kode`,`nama`) values (1,'G01','Sesak napas tiba-tiba\r'),(2,'G02','Intensitas sesak yang berat\r'),(3,'G03','Ada bunyi napas (mengi)\r'),(4,'G04','Batuk\r'),(5,'G05','Dada terasa berat\r'),(6,'G06','Gelisah\r'),(7,'G07','Sesak napas kambuh-kambuhan\r'),(8,'G08','Intensitas sesak yang ringan sampai sedang\r'),(9,'G09','Kadang ada bunyi napas (mengi) kadang tidak\r'),(10,'G10','Kadang ada batuk\r'),(11,'G11','Sesak napas disertai gejala alergi\r'),(12,'G12','Gatal pada kulit\r'),(13,'G13','Bersin-bersin\r'),(14,'G14','Pilek\r'),(15,'G15','Hidung tersumbat\r'),(16,'G16','Sesak napas terkadang berat\r'),(17,'G17','Ada gejala infeksi\r'),(18,'G18','Sesak berat pada saat istirahat, sulit bicara, dan pucat sampai biru\r'),(19,'G19','Napas berbunyi nyaring\r'),(20,'G20','Ada pernapasan dengan otot dada yang tertarik\r'),(21,'G21','Ada pernapasan cuping hidung\r'),(22,'G22','Kecepatan napas meningkat\r'),(23,'G23','Sesak sedang saat bicara, bicara hanya sepenggal kalimat\r'),(24,'G24','Kadang ada pernapasan dengan otot dada yang tertarik\r'),(25,'G25','Sesak ringan pada saat berjalan dan bicara berupa kalimat\r'),(26,'G26','Alergi ditempat kerja\r'),(27,'G27','Bersin-bersin di tempat kerja \r'),(28,'G28','Hidung berlendir\r'),(29,'G29','Kondisi memburuk setelah mengkonsumsi Aspirin\r'),(30,'G30','Otot-otot disekitar saluran pernapasan berkontraksi\r'),(31,'G31','Kondisi memburuk selama dan setelah olahraga\r'),(32,'G32','Pernapasan cepat dan dangkal\r');

/*Table structure for table `pengetahuan` */

DROP TABLE IF EXISTS `pengetahuan`;

CREATE TABLE `pengetahuan` (
  `id_pengetahuan` int(11) NOT NULL AUTO_INCREMENT,
  `id_penyakit` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `mb` float NOT NULL,
  `md` float NOT NULL,
  PRIMARY KEY (`id_pengetahuan`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `pengetahuan` */

insert  into `pengetahuan`(`id_pengetahuan`,`id_penyakit`,`id_gejala`,`mb`,`md`) values (1,1,1,0.9,0.1),(2,1,2,0.9,0.1),(3,1,3,0.6,0.2),(4,1,4,0.6,0.2),(5,1,5,0.8,0.1),(6,1,6,0.6,0.4),(7,2,7,0.9,0.1),(8,2,8,0.9,0.1),(9,2,9,0.8,0.1),(10,2,10,0.6,0.1),(11,3,6,0.6,0.2),(12,3,10,0.6,0.1),(13,3,7,0.7,0.1),(14,4,11,0.8,0.1),(15,4,12,0.6,0.2),(16,4,13,0.6,0.2),(17,4,14,0.6,0.2),(18,4,15,0.6,0.2),(19,5,4,0.6,0.1),(20,5,16,0.7,0.2),(21,5,17,0.7,0.1),(22,6,18,0.9,0.1),(23,6,19,0.8,0.1),(24,6,20,0.7,0.1),(25,6,21,0.7,0.2),(26,6,22,0.6,0.1),(27,7,22,0.6,0.2),(28,7,23,0.8,0.2),(29,7,3,0.6,0.2),(30,7,24,0.7,0.2),(31,8,22,0.6,0.2),(32,8,25,0.7,0.1),(33,8,3,0.6,0.2),(34,9,26,0.9,0.1),(35,9,27,0.9,0.2),(36,9,28,0.6,0.2),(37,9,15,0.6,0.2),(38,10,3,0.6,0.2),(39,10,29,0.9,0.1),(40,10,30,0.8,0.2),(41,11,3,0.6,0.1),(42,11,31,0.8,0.1),(43,11,32,0.7,0.1);

/*Table structure for table `penyakit` */

DROP TABLE IF EXISTS `penyakit`;

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id_penyakit`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `penyakit` */

insert  into `penyakit`(`id_penyakit`,`kode`,`nama`) values (1,'P01','Penyakit Asma Akut'),(2,'P02','Penyakit Asma Kronis'),(3,'P03','Penyakit Asma Periodik'),(4,'P04','Penyakit Asma Ekstrinsik'),(5,'P05','Penyakit Asma Intrinsik'),(6,'P06','Penyakit Asma Berat'),(7,'P07','Penyakit Asma Sedang'),(8,'P08','Penyakit Asma Ringan'),(9,'P09','Penyakit Asma Pekerjaan'),(10,'P10','Penyakit Asma Sensitif Aspirin'),(11,'P11','Penyakit Asma Olahraga');

/*Table structure for table `solusi` */

DROP TABLE IF EXISTS `solusi`;

CREATE TABLE `solusi` (
  `kode` varchar(3) NOT NULL,
  `kd_sol` varchar(3) NOT NULL,
  `solusi` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`kode`,`kd_sol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `solusi` */

insert  into `solusi`(`kode`,`kd_sol`,`solusi`) values ('P01','S01','Dapat menggunakan obat-obatan penyakit asma inhaler, nebulizer, atau suntikan.'),('P02','S02','Hindari penyebab serangan penyakit asma, minum obat-obatan penyakit asma saat terasa sesak , olah raga, dan jangan terlalu lelah.'),('P03','S03','Hindari penyebab serangan penyakit asma, minum obat-obatan penyakit asma jika kambuh, olahraga, hindari stress, dan jangan terlalu lelah.					\r\n					\r\n					\r\n'),('P04','S04','Hindari penyakit alergi misal debu, tepung sari, makanan tertentu yang alergi, terkadang sembuh sendiri tanpa obat, desentisisasi (memberikan alergen penyebab sedikit demi sedikit sampai tidak alergi).					\r\n					\r\n					\r\n					\r\n'),('P05','S05','Obati penyebab infeksi misal dengan antibiotik, dan minum obat-obatan penyakit asma.					\r\n					\r\n'),('P06','S06','Dapat diberikan Nebulizer, Oksigen, dan suntikan obat-obatan penyakit asma.					\r\n					\r\n'),('P07','S07','Dapat diberikan Nebulizer, Oksigen, dan suntikan obat-obatan oral.					\r\n					\r\n'),('P08','S08','Dapat diberikan Nebulizer, Oksigen, dan suntikan obat-obatan oral.					\r\n					\r\n'),('P09','S09','Ubah kondisi kerja, dapat pindah kerja ke bagian lain yang tidak menyebabkan alergi asma.					\r\n					\r\n'),('P10','S10','Dapat diberikan obat Singulair dan obat antagonis reseptor yang dapat mencegah leukotrin agar tidak dapat bekerja secara normal.					\r\n					\r\n					\r\n'),('P11','S11','Pilih dan batasi beberapa jenis olahraga serta konsultasikan dengan profesional kesehatan atau dokter.					\r\n					\r\n');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nama`,`username`,`password`) values (1,'Administrator','admin','21232f297a57a5a743894a0e4a801fc3');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
