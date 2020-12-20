-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_inventorykita
CREATE DATABASE IF NOT EXISTS `db_inventorykita` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_inventorykita`;

-- Dumping structure for table db_inventorykita.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(50) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `stock_awal` int(11) DEFAULT NULL,
  `stock_akhir` int(11) DEFAULT '0',
  `harga_satuan_terakhir` float DEFAULT '0',
  `jml_stock_idr` float DEFAULT '0',
  `tgl_trans_terakhir` date DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `FK_barang_kategori_barang` (`id_kategori`),
  CONSTRAINT `FK_barang_kategori_barang` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_inventorykita.distribusi
CREATE TABLE IF NOT EXISTS `distribusi` (
  `id_distribusi` int(11) NOT NULL AUTO_INCREMENT,
  `id_kantor` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `total_distribusi_qty` int(11) DEFAULT NULL,
  `sisa_distribusi_qty` int(11) DEFAULT NULL,
  `tgl_distribusi` date DEFAULT NULL,
  `verifikasi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_distribusi`),
  KEY `FK_distribusi_kantor` (`id_kantor`),
  KEY `FK_distribusi_users` (`id_user`),
  CONSTRAINT `FK_distribusi_kantor` FOREIGN KEY (`id_kantor`) REFERENCES `kantor` (`id_kantor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_distribusi_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_inventorykita.kantor
CREATE TABLE IF NOT EXISTS `kantor` (
  `id_kantor` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kantor` varchar(3) DEFAULT NULL,
  `nama_kantor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kantor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_inventorykita.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_kategori` varchar(50) DEFAULT NULL,
  `kode_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_inventorykita.my_stock
CREATE TABLE IF NOT EXISTS `my_stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `sisa_stock` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_stock`),
  KEY `FK_my_stock_barang` (`id_barang`),
  KEY `FK_my_stock_users` (`id_user`),
  CONSTRAINT `FK_my_stock_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_my_stock_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_inventorykita.nota
CREATE TABLE IF NOT EXISTS `nota` (
  `no_nota` varchar(50) NOT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `verifikasi` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_inventorykita.pembelian
CREATE TABLE IF NOT EXISTS `pembelian` (
  `kode_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `id_vendor` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `no_nota` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status_verifikasi` int(11) DEFAULT '0',
  PRIMARY KEY (`kode_pembelian`),
  KEY `FK_pembelian_vendor` (`id_vendor`),
  KEY `FK_pembelian_nota` (`no_nota`),
  KEY `FK_pembelian_barang` (`id_barang`),
  CONSTRAINT `FK_pembelian_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pembelian_nota` FOREIGN KEY (`no_nota`) REFERENCES `nota` (`no_nota`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pembelian_vendor` FOREIGN KEY (`id_vendor`) REFERENCES `vendor` (`id_vendor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_inventorykita.permintaan_barang
CREATE TABLE IF NOT EXISTS `permintaan_barang` (
  `id_permintaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `stock_permintaan` int(11) DEFAULT NULL,
  `stock_sekarang` int(11) DEFAULT NULL,
  `tgl_permintaan` date DEFAULT NULL,
  `divisi_peminta` varchar(50) DEFAULT NULL,
  `status_permintaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_permintaan`),
  KEY `FK__barang` (`id_barang`),
  CONSTRAINT `FK__barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_inventorykita.riwayat_barang
CREATE TABLE IF NOT EXISTS `riwayat_barang` (
  `id_riwayat` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `kode_riwayat` int(11) DEFAULT NULL,
  `tgl_riwayat` date DEFAULT NULL,
  `keterangan` text,
  `harga_satuan` int(11) DEFAULT NULL,
  `stock_sekarang` int(11) DEFAULT NULL,
  `stock_masuk` int(11) DEFAULT NULL,
  `stock_keluar` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_riwayat`),
  KEY `FK_riwayat_barang_barang` (`id_barang`),
  CONSTRAINT `FK_riwayat_barang_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_inventorykita.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text,
  `kode_kantor` varchar(3) DEFAULT NULL,
  `level_user` varchar(20) DEFAULT NULL,
  `is_login` int(11) DEFAULT '0',
  `status_aktif` int(11) DEFAULT NULL,
  `divisi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_inventorykita.vendor
CREATE TABLE IF NOT EXISTS `vendor` (
  `id_vendor` int(11) NOT NULL AUTO_INCREMENT,
  `nama_vendor` varchar(50) DEFAULT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  `alamat` text,
  `bidang_usaha` varchar(50) NOT NULL DEFAULT '0',
  `no_npwp` varchar(50) DEFAULT NULL,
  `no_pic` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_vendor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
