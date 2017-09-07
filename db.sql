/*
SQLyog Community v12.11 (64 bit)
MySQL - 5.6.16 : Database - proyek_solusi247
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`proyek_solusi247` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `proyek_solusi247`;

/*Table structure for table `divisi` */

DROP TABLE IF EXISTS `divisi`;

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL,
  `deskripsi_divisi` varchar(200) NOT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `divisi` */

insert  into `divisi`(`id_divisi`,`nama_divisi`,`deskripsi_divisi`) values (1,'Development','Build Application, Bug Fixing & Maintenence');
insert  into `divisi`(`id_divisi`,`nama_divisi`,`deskripsi_divisi`) values (6,'Sales','To Sale Product');
insert  into `divisi`(`id_divisi`,`nama_divisi`,`deskripsi_divisi`) values (5,'NOC','Engineer Support');
insert  into `divisi`(`id_divisi`,`nama_divisi`,`deskripsi_divisi`) values (7,'SDM','Mengatur Sumber Daya Manusia');

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `deskripsi_jabatan` varchar(200) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id_jabatan`,`nama_jabatan`,`deskripsi_jabatan`) values (1,'Sistem Analyst','Analyzing Program');
insert  into `jabatan`(`id_jabatan`,`nama_jabatan`,`deskripsi_jabatan`) values (2,'Programmer','Develop Program');
insert  into `jabatan`(`id_jabatan`,`nama_jabatan`,`deskripsi_jabatan`) values (3,'Project Manager','Manage the Project');
insert  into `jabatan`(`id_jabatan`,`nama_jabatan`,`deskripsi_jabatan`) values (4,'Quality Control','Check Program, Create User Manual, Report');
insert  into `jabatan`(`id_jabatan`,`nama_jabatan`,`deskripsi_jabatan`) values (5,'Technical Writer','Membuat Dokumentasi');
insert  into `jabatan`(`id_jabatan`,`nama_jabatan`,`deskripsi_jabatan`) values (6,'HRD','Human Resource');

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `alamat_karyawan` varchar(200) NOT NULL,
  `no_hp_karyawan` varchar(15) NOT NULL,
  `email_karyawan` varchar(50) NOT NULL,
  `id_jabatan` int(10) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `karyawan` */

insert  into `karyawan`(`id_karyawan`,`username`,`password`,`nama_karyawan`,`alamat_karyawan`,`no_hp_karyawan`,`email_karyawan`,`id_jabatan`,`id_divisi`) values (13,'butir_v','202cb962ac59075b964b07152d234b70','Butir Ver Anggriawan a','Banjar Negara Jawa Tengah','089198919','butir_v@gmail.com',3,1);
insert  into `karyawan`(`id_karyawan`,`username`,`password`,`nama_karyawan`,`alamat_karyawan`,`no_hp_karyawan`,`email_karyawan`,`id_jabatan`,`id_divisi`) values (9,'khariri','202cb962ac59075b964b07152d234b70','Khariri','Subang','089987765145','khariri@gmail.com',4,1);
insert  into `karyawan`(`id_karyawan`,`username`,`password`,`nama_karyawan`,`alamat_karyawan`,`no_hp_karyawan`,`email_karyawan`,`id_jabatan`,`id_divisi`) values (6,'septema.ema','202cb962ac59075b964b07152d234b70','Septema Umna Maulida','Turen, Malang','085789876565','septema.ema@gmail.com',2,1);
insert  into `karyawan`(`id_karyawan`,`username`,`password`,`nama_karyawan`,`alamat_karyawan`,`no_hp_karyawan`,`email_karyawan`,`id_jabatan`,`id_divisi`) values (8,'andang.dj','202cb962ac59075b964b07152d234b70','Andang Dwi Jayanto','Tegal','08771656765','andang.dj@gmail.com',4,6);
insert  into `karyawan`(`id_karyawan`,`username`,`password`,`nama_karyawan`,`alamat_karyawan`,`no_hp_karyawan`,`email_karyawan`,`id_jabatan`,`id_divisi`) values (12,'butir.v','202cb962ac59075b964b07152d234b70','Butir Veri A','Banjarnegara','087656765156','butir.v@gmail.com',1,6);
insert  into `karyawan`(`id_karyawan`,`username`,`password`,`nama_karyawan`,`alamat_karyawan`,`no_hp_karyawan`,`email_karyawan`,`id_jabatan`,`id_divisi`) values (11,'gana.muhibudin','202cb962ac59075b964b07152d234b70','Gana Muhibudin Azza','Pemalang','085435432142','gana.muhibudin@gmail.com',3,6);
insert  into `karyawan`(`id_karyawan`,`username`,`password`,`nama_karyawan`,`alamat_karyawan`,`no_hp_karyawan`,`email_karyawan`,`id_jabatan`,`id_divisi`) values (7,'terry','202cb962ac59075b964b07152d234b70','Terry Adjani','Kemulan, Kepanjen, Malang','087678987656','terry.cascana@gmail.com',3,1);
insert  into `karyawan`(`id_karyawan`,`username`,`password`,`nama_karyawan`,`alamat_karyawan`,`no_hp_karyawan`,`email_karyawan`,`id_jabatan`,`id_divisi`) values (15,'hrd','202cb962ac59075b964b07152d234b70','Articha','Bekasi','08771909199','articha.pm@gmail.com',6,7);
insert  into `karyawan`(`id_karyawan`,`username`,`password`,`nama_karyawan`,`alamat_karyawan`,`no_hp_karyawan`,`email_karyawan`,`id_jabatan`,`id_divisi`) values (14,'joni.i','202cb962ac59075b964b07152d234b70','Joni Iskandar','Kebumen','087715286454','jhoey.potter7@gmail.com',2,1);

/*Table structure for table `klien` */

DROP TABLE IF EXISTS `klien`;

CREATE TABLE `klien` (
  `id_klien` int(11) NOT NULL,
  `nama_klien` varchar(50) NOT NULL,
  `deskripsi_klien` varchar(100) NOT NULL,
  `status_klien` varchar(10) NOT NULL,
  PRIMARY KEY (`id_klien`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `klien` */

insert  into `klien`(`id_klien`,`nama_klien`,`deskripsi_klien`,`status_klien`) values (1,'Telkomsel Point','Membuat Aplikasi Berbasis Android dan IOS','1');
insert  into `klien`(`id_klien`,`nama_klien`,`deskripsi_klien`,`status_klien`) values (2,'XL Axiata','Build Apps','1');

/*Table structure for table `nilai` */

DROP TABLE IF EXISTS `nilai`;

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `nilai_pekerjaan` int(11) NOT NULL,
  `nilai_perilaku` int(11) DEFAULT NULL,
  `deskripsi_nilai` varchar(200) NOT NULL,
  `tanggal_penilaian` date NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `nilai` */

insert  into `nilai`(`id_nilai`,`nilai_pekerjaan`,`nilai_perilaku`,`deskripsi_nilai`,`tanggal_penilaian`,`id_proyek`,`id_karyawan`) values (1,75,80,'yg rajin lagi','2016-12-15',2,14);
insert  into `nilai`(`id_nilai`,`nilai_pekerjaan`,`nilai_perilaku`,`deskripsi_nilai`,`tanggal_penilaian`,`id_proyek`,`id_karyawan`) values (2,50,90,'','2016-12-16',3,14);
insert  into `nilai`(`id_nilai`,`nilai_pekerjaan`,`nilai_perilaku`,`deskripsi_nilai`,`tanggal_penilaian`,`id_proyek`,`id_karyawan`) values (3,75,90,'','2016-12-16',2,14);
insert  into `nilai`(`id_nilai`,`nilai_pekerjaan`,`nilai_perilaku`,`deskripsi_nilai`,`tanggal_penilaian`,`id_proyek`,`id_karyawan`) values (4,100,100,'','2016-12-16',2,8);
insert  into `nilai`(`id_nilai`,`nilai_pekerjaan`,`nilai_perilaku`,`deskripsi_nilai`,`tanggal_penilaian`,`id_proyek`,`id_karyawan`) values (5,50,70,'','2016-12-16',3,8);
insert  into `nilai`(`id_nilai`,`nilai_pekerjaan`,`nilai_perilaku`,`deskripsi_nilai`,`tanggal_penilaian`,`id_proyek`,`id_karyawan`) values (6,100,100,'','2016-12-16',3,12);
insert  into `nilai`(`id_nilai`,`nilai_pekerjaan`,`nilai_perilaku`,`deskripsi_nilai`,`tanggal_penilaian`,`id_proyek`,`id_karyawan`) values (7,50,100,'','2016-12-16',3,6);
insert  into `nilai`(`id_nilai`,`nilai_pekerjaan`,`nilai_perilaku`,`deskripsi_nilai`,`tanggal_penilaian`,`id_proyek`,`id_karyawan`) values (8,100,100,'','2016-12-16',6,6);

/*Table structure for table `pekerjaan` */

DROP TABLE IF EXISTS `pekerjaan`;

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_awal_pekerjaan` date NOT NULL,
  `tanggal_akhir_pekerjaan` date NOT NULL,
  `deskripsi_pekerjaan` varchar(200) NOT NULL,
  `bobot_pekerjaan` int(11) NOT NULL,
  `status_pekerjaan` char(3) DEFAULT '0',
  `tahap_pekerjaan` varchar(20) NOT NULL,
  `flag_telat` int(11) NOT NULL,
  `flag_nilai` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `catatan_pekerjaan` varchar(200) DEFAULT NULL,
  `tanggal_update_pekerjaan` date DEFAULT NULL,
  PRIMARY KEY (`id_pekerjaan`),
  KEY `FK_id_proyek` (`id_proyek`),
  CONSTRAINT `FK_id_proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `pekerjaan` */

insert  into `pekerjaan`(`id_pekerjaan`,`tanggal_awal_pekerjaan`,`tanggal_akhir_pekerjaan`,`deskripsi_pekerjaan`,`bobot_pekerjaan`,`status_pekerjaan`,`tahap_pekerjaan`,`flag_telat`,`flag_nilai`,`id_proyek`,`id_karyawan`,`catatan_pekerjaan`,`tanggal_update_pekerjaan`) values (1,'2016-12-13','2016-12-23','Development',3,'100','2',0,1,2,14,NULL,'2016-12-12');
insert  into `pekerjaan`(`id_pekerjaan`,`tanggal_awal_pekerjaan`,`tanggal_akhir_pekerjaan`,`deskripsi_pekerjaan`,`bobot_pekerjaan`,`status_pekerjaan`,`tahap_pekerjaan`,`flag_telat`,`flag_nilai`,`id_proyek`,`id_karyawan`,`catatan_pekerjaan`,`tanggal_update_pekerjaan`) values (2,'2016-12-25','2016-12-30','QC',3,'100','3',0,1,2,8,NULL,'2016-12-14');
insert  into `pekerjaan`(`id_pekerjaan`,`tanggal_awal_pekerjaan`,`tanggal_akhir_pekerjaan`,`deskripsi_pekerjaan`,`bobot_pekerjaan`,`status_pekerjaan`,`tahap_pekerjaan`,`flag_telat`,`flag_nilai`,`id_proyek`,`id_karyawan`,`catatan_pekerjaan`,`tanggal_update_pekerjaan`) values (3,'2016-12-15','2016-12-20','Design Database',3,'100','1',0,1,3,12,NULL,'2016-12-15');
insert  into `pekerjaan`(`id_pekerjaan`,`tanggal_awal_pekerjaan`,`tanggal_akhir_pekerjaan`,`deskripsi_pekerjaan`,`bobot_pekerjaan`,`status_pekerjaan`,`tahap_pekerjaan`,`flag_telat`,`flag_nilai`,`id_proyek`,`id_karyawan`,`catatan_pekerjaan`,`tanggal_update_pekerjaan`) values (4,'2016-12-08','2016-12-09','Design UX',2,'100','2',1,1,2,14,NULL,'2016-12-15');
insert  into `pekerjaan`(`id_pekerjaan`,`tanggal_awal_pekerjaan`,`tanggal_akhir_pekerjaan`,`deskripsi_pekerjaan`,`bobot_pekerjaan`,`status_pekerjaan`,`tahap_pekerjaan`,`flag_telat`,`flag_nilai`,`id_proyek`,`id_karyawan`,`catatan_pekerjaan`,`tanggal_update_pekerjaan`) values (5,'2016-12-16','2016-12-18','Penambahan Task',2,'100','2',0,1,6,6,NULL,'2016-12-15');
insert  into `pekerjaan`(`id_pekerjaan`,`tanggal_awal_pekerjaan`,`tanggal_akhir_pekerjaan`,`deskripsi_pekerjaan`,`bobot_pekerjaan`,`status_pekerjaan`,`tahap_pekerjaan`,`flag_telat`,`flag_nilai`,`id_proyek`,`id_karyawan`,`catatan_pekerjaan`,`tanggal_update_pekerjaan`) values (6,'2016-12-01','2016-12-09','Develop Aplikasi',1,'100','2',1,1,3,6,NULL,'2016-12-15');
insert  into `pekerjaan`(`id_pekerjaan`,`tanggal_awal_pekerjaan`,`tanggal_akhir_pekerjaan`,`deskripsi_pekerjaan`,`bobot_pekerjaan`,`status_pekerjaan`,`tahap_pekerjaan`,`flag_telat`,`flag_nilai`,`id_proyek`,`id_karyawan`,`catatan_pekerjaan`,`tanggal_update_pekerjaan`) values (7,'2016-12-08','2016-12-09','Testing',1,'100','3',1,1,3,8,NULL,'2016-12-16');
insert  into `pekerjaan`(`id_pekerjaan`,`tanggal_awal_pekerjaan`,`tanggal_akhir_pekerjaan`,`deskripsi_pekerjaan`,`bobot_pekerjaan`,`status_pekerjaan`,`tahap_pekerjaan`,`flag_telat`,`flag_nilai`,`id_proyek`,`id_karyawan`,`catatan_pekerjaan`,`tanggal_update_pekerjaan`) values (8,'2016-12-01','2016-12-05','Membuat Design Laporan',2,'100','2',1,1,3,14,NULL,'2016-12-16');
insert  into `pekerjaan`(`id_pekerjaan`,`tanggal_awal_pekerjaan`,`tanggal_akhir_pekerjaan`,`deskripsi_pekerjaan`,`bobot_pekerjaan`,`status_pekerjaan`,`tahap_pekerjaan`,`flag_telat`,`flag_nilai`,`id_proyek`,`id_karyawan`,`catatan_pekerjaan`,`tanggal_update_pekerjaan`) values (9,'2016-12-01','2016-12-10','Design Database',2,'0','2',0,0,4,6,NULL,NULL);

/*Table structure for table `proyek` */

DROP TABLE IF EXISTS `proyek`;

CREATE TABLE `proyek` (
  `id_proyek` int(11) NOT NULL,
  `nama_proyek` varchar(50) NOT NULL,
  `tanggal_awal_proyek` date NOT NULL,
  `tanggal_akhir_proyek` date NOT NULL,
  `deskripsi_proyek` varchar(200) NOT NULL,
  `status_proyek` varchar(10) NOT NULL,
  `id_klien` int(11) NOT NULL,
  `id_pm` int(11) NOT NULL,
  PRIMARY KEY (`id_proyek`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proyek` */

insert  into `proyek`(`id_proyek`,`nama_proyek`,`tanggal_awal_proyek`,`tanggal_akhir_proyek`,`deskripsi_proyek`,`status_proyek`,`id_klien`,`id_pm`) values (1,'Solusi 247','2016-12-01','2016-12-31','Develop Apps Cek Pulsa','1',1,13);
insert  into `proyek`(`id_proyek`,`nama_proyek`,`tanggal_awal_proyek`,`tanggal_akhir_proyek`,`deskripsi_proyek`,`status_proyek`,`id_klien`,`id_pm`) values (2,'Develop XLKU','2016-01-01','2016-12-14','XLKU','1',2,7);
insert  into `proyek`(`id_proyek`,`nama_proyek`,`tanggal_awal_proyek`,`tanggal_akhir_proyek`,`deskripsi_proyek`,`status_proyek`,`id_klien`,`id_pm`) values (3,'Telkomsel Ceria','2016-12-01','2016-12-10','Maintenence','1',1,7);
insert  into `proyek`(`id_proyek`,`nama_proyek`,`tanggal_awal_proyek`,`tanggal_akhir_proyek`,`deskripsi_proyek`,`status_proyek`,`id_klien`,`id_pm`) values (4,'Deletion Lacci','2016-12-01','2016-12-31','test','2',1,7);
insert  into `proyek`(`id_proyek`,`nama_proyek`,`tanggal_awal_proyek`,`tanggal_akhir_proyek`,`deskripsi_proyek`,`status_proyek`,`id_klien`,`id_pm`) values (6,'Pengembahan Aplikasi Telkomsel','2016-12-16','2016-12-31','Mengembangkan Aplikasi Telkomsel','',1,7);

/*Table structure for table `sub_pekerjaan` */

DROP TABLE IF EXISTS `sub_pekerjaan`;

CREATE TABLE `sub_pekerjaan` (
  `id_sub_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sub_pekerjaan` varchar(50) NOT NULL,
  `deskripsi_sub_pekerjaan` varchar(200) DEFAULT NULL,
  `status_sub_pekerjaan` char(1) NOT NULL DEFAULT '0',
  `id_pekerjaan` int(11) NOT NULL,
  KEY `id_sub_pekerjaan` (`id_sub_pekerjaan`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `sub_pekerjaan` */

insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (1,'Membuat Dashboard','Copy dari dashboard m2','1',1);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (2,'QC Dashboard','Test 1 Alur','1',2);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (3,'Copy Database Existing','as','1',3);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (4,'Membuat Design UX Home','','1',4);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (5,'Indexing Database','','1',3);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (7,'Menu A & B','Penambahan Menu A & B','1',5);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (8,'Test Beban Database','','1',3);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (9,'Design Dashboard Home','','1',6);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (10,'Design UX','','1',6);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (11,'Test 1 Alur','','1',7);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (12,'Cetak PDF & Excel','','1',8);
insert  into `sub_pekerjaan`(`id_sub_pekerjaan`,`nama_sub_pekerjaan`,`deskripsi_sub_pekerjaan`,`status_sub_pekerjaan`,`id_pekerjaan`) values (13,'Indexing','','0',9);

/* Function  structure for function  `f_jum_task` */

/*!50003 DROP FUNCTION IF EXISTS `f_jum_task` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_jum_task`(idProyek int(11), tipe int(11), idKaryawan int(11)) RETURNS varchar(100) CHARSET latin1
BEGIN
    DECLARE f_jum int(11);
	if tipe = '1' then
		if idKaryawan <> '' then 
			SELECT count(deskripsi_pekerjaan) INTO f_jum FROM pekerjaan 
			WHERE id_proyek = idProyek and status_pekerjaan >= 100 and id_karyawan = idKaryawan;
			RETURN f_jum;
		else
			SELECT COUNT(deskripsi_pekerjaan) INTO f_jum FROM pekerjaan 
			WHERE id_proyek = idProyek AND status_pekerjaan >= 100;
			RETURN f_jum;
		END IF;
	elseif tipe = '3' then
		IF idKaryawan <> '' THEN 
			SELECT COUNT(deskripsi_pekerjaan) INTO f_jum FROM pekerjaan 
			WHERE id_proyek = idProyek AND status_pekerjaan < 100 and id_karyawan = idKaryawan;
			RETURN f_jum;
		else 
			SELECT COUNT(deskripsi_pekerjaan) INTO f_jum FROM pekerjaan 
			WHERE id_proyek = idProyek AND status_pekerjaan < 100;
			RETURN f_jum;
		end if;
	else 
		IF idKaryawan <> '' THEN 
			SELECT COUNT(deskripsi_pekerjaan) INTO f_jum FROM pekerjaan 
			WHERE id_proyek = idProyek AND id_karyawan = idKaryawan;
			RETURN f_jum;
		else
			SELECT COUNT(deskripsi_pekerjaan) INTO f_jum FROM pekerjaan 
			WHERE id_proyek = idProyek;
			RETURN f_jum;
		end if;
	end if;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
