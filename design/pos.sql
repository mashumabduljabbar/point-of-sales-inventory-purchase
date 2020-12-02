-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for pos
CREATE DATABASE IF NOT EXISTS `pos` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pos`;


-- Dumping structure for table pos.tbl_brand
CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `id_brand` int(11) NOT NULL,
  `nama_brand` varchar(50) NOT NULL,
  PRIMARY KEY (`id_brand`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_brand: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_brand` DISABLE KEYS */;
INSERT INTO `tbl_brand` (`id_brand`, `nama_brand`) VALUES
	(1, 'Panasonic');
INSERT INTO `tbl_brand` (`id_brand`, `nama_brand`) VALUES
	(2, 'Sanyo');
/*!40000 ALTER TABLE `tbl_brand` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_customer
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `npwp_customer` varchar(20) NOT NULL,
  `alamat_customer` varchar(255) NOT NULL,
  `no_telp_customer` varchar(20) NOT NULL,
  `email_customer` varchar(50) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;
INSERT INTO `tbl_customer` (`id_customer`, `nama_customer`, `npwp_customer`, `alamat_customer`, `no_telp_customer`, `email_customer`) VALUES
	(1, 'PT DEF', '12345', 'Alamat', '123', 'customer@example.com');
/*!40000 ALTER TABLE `tbl_customer` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_kategori
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_kategori: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
	(1, 'Barang Mentah');
INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
	(2, 'Barang Jadi');
/*!40000 ALTER TABLE `tbl_kategori` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_perusahaan
CREATE TABLE IF NOT EXISTS `tbl_perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `npwp_perusahaan` varchar(20) NOT NULL,
  `alamat_perusahaan` varchar(255) NOT NULL,
  `no_telp_perusahaan` varchar(20) NOT NULL,
  `email_perusahaan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_perusahaan: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_perusahaan` DISABLE KEYS */;
INSERT INTO `tbl_perusahaan` (`id_perusahaan`, `nama_perusahaan`, `npwp_perusahaan`, `alamat_perusahaan`, `no_telp_perusahaan`, `email_perusahaan`) VALUES
	(1, 'PT XYZ', '12345678', 'Alamat', '123', 'info@xyz.com');
/*!40000 ALTER TABLE `tbl_perusahaan` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_po
CREATE TABLE IF NOT EXISTS `tbl_po` (
  `id_po` int(11) NOT NULL,
  `tanggal_po` date NOT NULL,
  `alamat_pengiriman_po` varchar(255) NOT NULL,
  `tax_po` int(11) NOT NULL,
  `status_po` int(11) NOT NULL,
  `id_rfq` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_po`),
  KEY `tbl_po_ibfk_1` (`id_rfq`),
  KEY `tbl_po_ibfk_2` (`id_user`),
  CONSTRAINT `tbl_po_ibfk_1` FOREIGN KEY (`id_rfq`) REFERENCES `tbl_rfq` (`id_rfq`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_po_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_po: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_po` DISABLE KEYS */;
INSERT INTO `tbl_po` (`id_po`, `tanggal_po`, `alamat_pengiriman_po`, `tax_po`, `status_po`, `id_rfq`, `id_user`) VALUES
	(1, '2020-12-02', 'Test', 0, 0, 1, 1);
/*!40000 ALTER TABLE `tbl_po` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_po_detail
CREATE TABLE IF NOT EXISTS `tbl_po_detail` (
  `id_po_detail` int(11) NOT NULL,
  `harga_po_detail` int(11) NOT NULL,
  `qty_po_detail` int(11) NOT NULL,
  `disc_po_detail` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  PRIMARY KEY (`id_po_detail`),
  KEY `tbl_po_detail_ibfk_1` (`id_po`),
  KEY `tbl_po_detail_ibfk_2` (`id_produk`),
  CONSTRAINT `tbl_po_detail_ibfk_1` FOREIGN KEY (`id_po`) REFERENCES `tbl_po` (`id_po`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_po_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_po_detail: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_po_detail` DISABLE KEYS */;
INSERT INTO `tbl_po_detail` (`id_po_detail`, `harga_po_detail`, `qty_po_detail`, `disc_po_detail`, `id_po`, `id_produk`) VALUES
	(1, 11, 25, 0, 1, 2);
INSERT INTO `tbl_po_detail` (`id_po_detail`, `harga_po_detail`, `qty_po_detail`, `disc_po_detail`, `id_po`, `id_produk`) VALUES
	(2, 12, 12, 0, 1, 2);
/*!40000 ALTER TABLE `tbl_po_detail` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_produk
CREATE TABLE IF NOT EXISTS `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `size_produk` varchar(50) NOT NULL,
  `cost_produk` int(11) NOT NULL,
  `price_produk` int(11) NOT NULL,
  `alert_quantity` int(11) NOT NULL,
  `image_produk` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `tbl_produk_ibfk_1` (`id_kategori`),
  KEY `tbl_produk_ibfk_2` (`id_unit`),
  KEY `tbl_produk_ibfk_3` (`id_brand`),
  CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_produk_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_produk_ibfk_3` FOREIGN KEY (`id_brand`) REFERENCES `tbl_brand` (`id_brand`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_produk: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_produk` DISABLE KEYS */;
INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `size_produk`, `cost_produk`, `price_produk`, `alert_quantity`, `image_produk`, `id_kategori`, `id_unit`, `id_brand`) VALUES
	(1, 'TV', '41 inch', 1000000, 5000000, 10, '1606247953a462f8c334e328ba8f572ca0a51c4861.jpg', 1, 1, 1);
INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `size_produk`, `cost_produk`, `price_produk`, `alert_quantity`, `image_produk`, `id_kategori`, `id_unit`, `id_brand`) VALUES
	(2, 'Radio', 'Size', 1000, 25000, 2, '', 2, 1, 2);
INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `size_produk`, `cost_produk`, `price_produk`, `alert_quantity`, `image_produk`, `id_kategori`, `id_unit`, `id_brand`) VALUES
	(3, 'PS3', 'Size', 1000, 25000, 2, '.jpg', 2, 1, 2);
/*!40000 ALTER TABLE `tbl_produk` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_rfq
CREATE TABLE IF NOT EXISTS `tbl_rfq` (
  `id_rfq` int(11) NOT NULL,
  `tanggal_rfq` date NOT NULL,
  `alamat_pengiriman_rfq` varchar(255) NOT NULL,
  `tax_rfq` int(11) NOT NULL,
  `jenis_rfq` int(11) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rfq`),
  KEY `tbl_rfq_ibfk_1` (`id_supplier`),
  KEY `tbl_rfq_ibfk_2` (`id_user`),
  KEY `tbl_rfq_ibfk_3` (`id_perusahaan`),
  KEY `tbl_rfq_ibfk_4` (`id_customer`),
  CONSTRAINT `tbl_rfq_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `tbl_supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_rfq_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_rfq_ibfk_3` FOREIGN KEY (`id_perusahaan`) REFERENCES `tbl_perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_rfq_ibfk_4` FOREIGN KEY (`id_customer`) REFERENCES `tbl_customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_rfq: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_rfq` DISABLE KEYS */;
INSERT INTO `tbl_rfq` (`id_rfq`, `tanggal_rfq`, `alamat_pengiriman_rfq`, `tax_rfq`, `jenis_rfq`, `id_supplier`, `id_user`, `id_perusahaan`, `id_customer`) VALUES
	(1, '2020-12-02', 'Test', 0, 1, 1, 1, 1, NULL);
/*!40000 ALTER TABLE `tbl_rfq` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_rfq_detail
CREATE TABLE IF NOT EXISTS `tbl_rfq_detail` (
  `id_rfq_detail` int(11) NOT NULL,
  `harga_rfq_detail` int(11) NOT NULL,
  `qty_rfq_detail` int(11) NOT NULL,
  `disc_rfq_detail` int(11) NOT NULL,
  `id_rfq` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  PRIMARY KEY (`id_rfq_detail`),
  KEY `tbl_rfq_detail_ibfk_1` (`id_rfq`),
  KEY `tbl_rfq_detail_ibfk_2` (`id_produk`),
  CONSTRAINT `tbl_rfq_detail_ibfk_1` FOREIGN KEY (`id_rfq`) REFERENCES `tbl_rfq` (`id_rfq`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_rfq_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_rfq_detail: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_rfq_detail` DISABLE KEYS */;
INSERT INTO `tbl_rfq_detail` (`id_rfq_detail`, `harga_rfq_detail`, `qty_rfq_detail`, `disc_rfq_detail`, `id_rfq`, `id_produk`) VALUES
	(1, 11, 25, 0, 1, 2);
INSERT INTO `tbl_rfq_detail` (`id_rfq_detail`, `harga_rfq_detail`, `qty_rfq_detail`, `disc_rfq_detail`, `id_rfq`, `id_produk`) VALUES
	(2, 12, 12, 0, 1, 2);
/*!40000 ALTER TABLE `tbl_rfq_detail` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_supplier
CREATE TABLE IF NOT EXISTS `tbl_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `npwp_supplier` varchar(20) NOT NULL,
  `alamat_supplier` varchar(255) NOT NULL,
  `no_telp_supplier` varchar(20) NOT NULL,
  `email_supplier` varchar(50) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_supplier: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_supplier` DISABLE KEYS */;
INSERT INTO `tbl_supplier` (`id_supplier`, `nama_supplier`, `npwp_supplier`, `alamat_supplier`, `no_telp_supplier`, `email_supplier`) VALUES
	(1, 'PT ABCs', '1234567', 'Alamat', '1245', 'supplier@example.com');
/*!40000 ALTER TABLE `tbl_supplier` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_unit
CREATE TABLE IF NOT EXISTS `tbl_unit` (
  `id_unit` int(11) NOT NULL,
  `nama_unit` varchar(50) NOT NULL,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_unit: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_unit` DISABLE KEYS */;
INSERT INTO `tbl_unit` (`id_unit`, `nama_unit`) VALUES
	(1, 'Unit');
/*!40000 ALTER TABLE `tbl_unit` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_user
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `jabatan_user` varchar(50) NOT NULL,
  `alamat_user` varchar(255) NOT NULL,
  `no_telp_user` varchar(20) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_user: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `jabatan_user`, `alamat_user`, `no_telp_user`, `email_user`) VALUES
	(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Pekanbaru', '123', 'admin@admin.com');
INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `jabatan_user`, `alamat_user`, `no_telp_user`, `email_user`) VALUES
	(2, 'Budi Doremi', 'budidoremi', '21232f297a57a5a743894a0e4a801fc3', 'Jabatan', 'Alamat', '124', 'budi@example.com');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_warehouse
CREATE TABLE IF NOT EXISTS `tbl_warehouse` (
  `id_warehouse` int(11) NOT NULL,
  `tanggal_warehouse` date NOT NULL,
  `upload_warehouse` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_warehouse`),
  KEY `tbl_warehouse_ibfk_2` (`id_user`),
  CONSTRAINT `tbl_warehouse_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_warehouse: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_warehouse` DISABLE KEYS */;
INSERT INTO `tbl_warehouse` (`id_warehouse`, `tanggal_warehouse`, `upload_warehouse`, `id_user`) VALUES
	(1, '2020-12-02', '1606882300dacfad0ca86ac0ec30befe55e3430fde.png', 2);
INSERT INTO `tbl_warehouse` (`id_warehouse`, `tanggal_warehouse`, `upload_warehouse`, `id_user`) VALUES
	(2, '2020-12-02', '', 1);
INSERT INTO `tbl_warehouse` (`id_warehouse`, `tanggal_warehouse`, `upload_warehouse`, `id_user`) VALUES
	(3, '2020-12-02', '', 1);
/*!40000 ALTER TABLE `tbl_warehouse` ENABLE KEYS */;


-- Dumping structure for table pos.tbl_warehouse_detail
CREATE TABLE IF NOT EXISTS `tbl_warehouse_detail` (
  `id_warehouse_detail` int(11) NOT NULL,
  `qty_warehouse_detail` int(11) NOT NULL DEFAULT 0,
  `id_po_detail` int(11) NOT NULL,
  `id_warehouse` int(11) NOT NULL,
  PRIMARY KEY (`id_warehouse_detail`),
  KEY `tbl_warehouse_detail_ibfk_1` (`id_warehouse`),
  KEY `tbl_warehouse_detail_ibfk_2` (`id_po_detail`),
  CONSTRAINT `tbl_warehouse_detail_ibfk_1` FOREIGN KEY (`id_warehouse`) REFERENCES `tbl_warehouse` (`id_warehouse`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_warehouse_detail_ibfk_2` FOREIGN KEY (`id_po_detail`) REFERENCES `tbl_po_detail` (`id_po_detail`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pos.tbl_warehouse_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_warehouse_detail` DISABLE KEYS */;
INSERT INTO `tbl_warehouse_detail` (`id_warehouse_detail`, `qty_warehouse_detail`, `id_po_detail`, `id_warehouse`) VALUES
	(1, 25, 1, 3);
INSERT INTO `tbl_warehouse_detail` (`id_warehouse_detail`, `qty_warehouse_detail`, `id_po_detail`, `id_warehouse`) VALUES
	(2, 12, 2, 3);
/*!40000 ALTER TABLE `tbl_warehouse_detail` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
