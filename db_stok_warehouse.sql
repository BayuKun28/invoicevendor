-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2023 at 08:24 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stok_warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_website`
--

DROP TABLE IF EXISTS `detail_website`;
CREATE TABLE IF NOT EXISTS `detail_website` (
  `detail_website_id` int(255) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `site_deskripsi` text,
  `notelp` varchar(255) DEFAULT NULL,
  `nama_kontak` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `alamat_universitas` text,
  `images` varchar(255) DEFAULT NULL,
  `site_favicon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`detail_website_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_website`
--

INSERT INTO `detail_website` (`detail_website_id`, `site_title`, `email`, `site_deskripsi`, `notelp`, `nama_kontak`, `facebook`, `instagram`, `youtube`, `telegram`, `alamat_universitas`, `images`, `site_favicon`) VALUES
(1, 'Vendor', 'rsprovita@gmail.com', 'Website Aplikasi Vendors', '62812345678', 'RS Provita', 'https://www.facebook.com/link_anda/', 'https://www.instagram.com/link_anda/', 'https://www.youtube.com/c/link_anda', 'https://t.me/link_anda', 'Jayapura', 'c753a68140516189a1baba762fd7c67f.jpg', 'cbbe7b63257146a21e7ef85d91704866.png');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kwitansi` varchar(255) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `kwitansi`, `nominal`, `tgl_pembayaran`, `status`, `id_vendor`) VALUES
(1, '12345678', 1200000, '2023-03-03', 'a', 1),
(2, '213', 123, '2023-03-10', '213', 6),
(3, '123', 123, '2023-03-03', '123', 6),
(4, '222222222222222', 222222222222222, '2023-03-05', '2222222222222222', 5),
(8, '1213', 123123, '2023-03-07', 'Rencana Pembayaran', 6),
(9, '213', 12312, '2023-03-07', '213', 6),
(10, '312', 123, '2023-03-07', 'Sudah Dibayar', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_absensi`
--

DROP TABLE IF EXISTS `tbl_absensi`;
CREATE TABLE IF NOT EXISTS `tbl_absensi` (
  `id_absensi` int(255) NOT NULL AUTO_INCREMENT,
  `id_user_absensi` int(255) DEFAULT NULL,
  `ip_adress_absensi_masuk` varchar(255) DEFAULT NULL,
  `ip_adress_absensi_keluar` varchar(255) DEFAULT NULL,
  `tgl_absensi_masuk` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_absensi_keluar` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ket_absensi` varchar(255) DEFAULT NULL,
  `kehadiran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_absensi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_absensi`
--

INSERT INTO `tbl_absensi` (`id_absensi`, `id_user_absensi`, `ip_adress_absensi_masuk`, `ip_adress_absensi_keluar`, `tgl_absensi_masuk`, `tgl_absensi_keluar`, `ket_absensi`, `kehadiran`) VALUES
(1, 1, '::1', '-', '2023-03-01 04:43:30', '0000-00-00 00:00:00', '1', 'Terlambat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_stock`
--

DROP TABLE IF EXISTS `tbl_add_stock`;
CREATE TABLE IF NOT EXISTS `tbl_add_stock` (
  `add_stock_id` int(255) NOT NULL AUTO_INCREMENT,
  `kode_add_stock` varchar(255) DEFAULT NULL,
  `bahan_baku_id` int(255) DEFAULT NULL,
  `jumlah_add_stock` varchar(255) DEFAULT NULL,
  `biaya_dikeluarkan` varchar(255) DEFAULT NULL,
  `check_proses` int(10) DEFAULT '0',
  `add_stock_stock_user_id` int(255) DEFAULT NULL,
  `tgl_buat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`add_stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cicil`
--

DROP TABLE IF EXISTS `tbl_cicil`;
CREATE TABLE IF NOT EXISTS `tbl_cicil` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `kode_transaksi_cicil` varchar(255) DEFAULT NULL,
  `id_konsumen_cicil` int(255) DEFAULT NULL,
  `cicilan` varchar(255) DEFAULT NULL,
  `telah_dibayar` varchar(255) DEFAULT '0',
  `jumlah_telah_dibayar` varchar(255) DEFAULT '0',
  `jumlah_cicilan` varchar(255) DEFAULT NULL,
  `jenis_cicilan` varchar(255) DEFAULT NULL,
  `ket_cicilan` varchar(255) DEFAULT NULL,
  `id_user_cicil` int(255) DEFAULT NULL,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update_bayar` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_home`
--

DROP TABLE IF EXISTS `tbl_home`;
CREATE TABLE IF NOT EXISTS `tbl_home` (
  `home_id` int(11) NOT NULL AUTO_INCREMENT,
  `home_caption_1` varchar(255) DEFAULT NULL,
  `home_caption_2` longtext,
  `home_bg_heading` varchar(50) DEFAULT NULL,
  `home_bg_heading2` varchar(50) DEFAULT NULL,
  `home_bg_heading3` varchar(50) DEFAULT NULL,
  `home_bg_testimonial` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`home_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_home`
--

INSERT INTO `tbl_home` (`home_id`, `home_caption_1`, `home_caption_2`, `home_bg_heading`, `home_bg_heading2`, `home_bg_heading3`, `home_bg_testimonial`) VALUES
(1, 'Japanese Language NAT-TEST', 'The Japanese Language NAT-TEST is an examination that measures the Japanese language ability of students who are not native Japanese speakers.The tests are separated by difficulty (five levels) and general ability is measured in three categories: Grammar/Vocabulary, Listening and Reading Comprehension. The format of the exam and the types of questions are equivalent to those that appear on the Japanese-Language Proficiency Test (JLPT).', 'portfolio-details-1.jpg', 'portfolio-details-2.jpg', 'portfolio-details-3.jpg', 'nat-tes4.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_cicilan`
--

DROP TABLE IF EXISTS `tbl_jenis_cicilan`;
CREATE TABLE IF NOT EXISTS `tbl_jenis_cicilan` (
  `id_jenis_cicilan` int(255) NOT NULL AUTO_INCREMENT,
  `nama_cicilan` varchar(255) DEFAULT NULL,
  `tenor` varchar(255) DEFAULT NULL,
  `jumlah_tenor` int(255) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_cicilan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jenis_cicilan`
--

INSERT INTO `tbl_jenis_cicilan` (`id_jenis_cicilan`, `nama_cicilan`, `tenor`, `jumlah_tenor`) VALUES
(1, '12', 'Mingguan', 123213);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_harga`
--

DROP TABLE IF EXISTS `tbl_jenis_harga`;
CREATE TABLE IF NOT EXISTS `tbl_jenis_harga` (
  `id_jenis_harga` int(255) NOT NULL AUTO_INCREMENT,
  `kode_jharga` varchar(255) DEFAULT NULL,
  `nama_jenis_harga` varchar(255) DEFAULT NULL,
  `kategori_jenis` varchar(255) DEFAULT NULL,
  `jenis_harga` int(255) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_harga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

DROP TABLE IF EXISTS `tbl_kategori`;
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(255) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'qqq');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_konsumen`
--

DROP TABLE IF EXISTS `tbl_konsumen`;
CREATE TABLE IF NOT EXISTS `tbl_konsumen` (
  `id_konsumen` int(255) NOT NULL AUTO_INCREMENT,
  `id_cus` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(255) DEFAULT NULL,
  `user_status` int(255) DEFAULT NULL,
  `hutang` int(255) DEFAULT NULL,
  `tgl_ubah_konsumen` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_konsumen`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_konsumen`
--

INSERT INTO `tbl_konsumen` (`id_konsumen`, `id_cus`, `nama`, `alamat`, `no_hp`, `user_status`, `hutang`, `tgl_ubah_konsumen`) VALUES
(1, 'CST-000000000001', 'Ilyas', 'iee', '6289919072162', 1, 0, '2023-03-01 07:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_list_retur_barang`
--

DROP TABLE IF EXISTS `tbl_list_retur_barang`;
CREATE TABLE IF NOT EXISTS `tbl_list_retur_barang` (
  `retur_id` int(255) NOT NULL AUTO_INCREMENT,
  `retur_kode_surat_jalan` varchar(255) DEFAULT NULL,
  `retur_bahan_baku_id` varchar(255) DEFAULT NULL,
  `retur_jumlah` int(255) DEFAULT NULL,
  `retur_nilai_saham` int(255) DEFAULT NULL,
  `retur_user_id` int(255) DEFAULT NULL,
  `retur_tgl_buat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`retur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_list_surat_jalan`
--

DROP TABLE IF EXISTS `tbl_list_surat_jalan`;
CREATE TABLE IF NOT EXISTS `tbl_list_surat_jalan` (
  `ls_surat_jalan_id` int(255) NOT NULL AUTO_INCREMENT,
  `kode_ls_surat_jalan` varchar(255) DEFAULT NULL,
  `bahan_baku_id` varchar(255) DEFAULT NULL,
  `jumlah_ls_surat_jalan` int(255) DEFAULT NULL,
  `check_proses_ls_surat_jalan` int(10) DEFAULT '0',
  `ls_surat_jalan_user_id` int(255) DEFAULT NULL,
  `tgl_buat_ls_surat_jalan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ls_surat_jalan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_list_transaksi`
--

DROP TABLE IF EXISTS `tbl_list_transaksi`;
CREATE TABLE IF NOT EXISTS `tbl_list_transaksi` (
  `id_transaksi` int(255) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) DEFAULT NULL,
  `id_konsumen_transaksi` int(255) DEFAULT NULL,
  `jumlah_pembelian` varchar(255) DEFAULT NULL,
  `jumlah_dibayar` varchar(255) DEFAULT NULL,
  `jenis_transaksi` varchar(255) DEFAULT NULL,
  `total_belanja` varchar(255) DEFAULT NULL,
  `dapatkan_hutang` varchar(255) DEFAULT NULL,
  `tenorbulan` varchar(255) DEFAULT NULL,
  `tenorcicil` varchar(255) DEFAULT NULL,
  `id_user_transaksi` int(255) DEFAULT NULL,
  `catatan` text,
  `tgl_transaksi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_ubah` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

DROP TABLE IF EXISTS `tbl_log`;
CREATE TABLE IF NOT EXISTS `tbl_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ket` varchar(255) DEFAULT NULL,
  `tgl_log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`id`, `ket`, `tgl_log`) VALUES
(1, '<b>Zikry Terlambat</b> Melakukan <b>Absen Masuk</b> Pada Kamis, 01 Maret 2023 11:43', '2023-03-01 04:43:30'),
(2, '<b>Zikry</b> Melakukan Tambah Konsumen <b>Ilyas</b>', '2023-03-01 07:00:22'),
(3, '<b>Zikry</b> Melakukan Tambah Vendor <b>sssdsadsd</b>', '2023-03-03 03:06:58'),
(4, '<b>Zikry</b> Melakukan Edit Vendors <b>aaaa</b>', '2023-03-03 03:10:09'),
(5, '<b>Zikry</b> Melakukan Edit Vendors <b>aaaa</b>', '2023-03-03 03:13:55'),
(6, '<b>Zikry</b> Melakukan Edit Vendors <b>aaaaaaz</b>', '2023-03-03 03:14:12'),
(7, '<b>Admin</b> Menambah Invoice Sebesar <b>Rp 123,123,123</b> Untuk Vendor 6', '2023-03-03 08:25:24'),
(8, '<b>Admin</b> Mengubah Nominal Sebesar <b>Rp 123 Menjadi Rp 1,111,111,111,111,111,168</b> ', '2023-03-05 02:19:58'),
(9, '<b>Admin</b> Mengubah Nominal Sebesar <b>Rp 1,111,111,111,111,111,168 Menjadi Rp 222,222,222,222,222</b> ', '2023-03-05 02:20:37'),
(10, '<b>Admin</b> Menambah Invoice Sebesar <b>Rp </b> Untuk Vendor ', '2023-03-07 06:32:45'),
(11, '<b>Admin</b> Menambah Invoice Sebesar <b>Rp </b> Untuk Vendor 6', '2023-03-07 06:33:17'),
(12, '<b>Admin</b> Menambah Invoice Sebesar <b>Rp 123,123</b> Untuk Vendor 6', '2023-03-07 06:41:05'),
(13, '<b>Admin</b> Mengubah Nominal Sebesar <b>Rp 123,123 Menjadi Rp 123,123</b> ', '2023-03-07 06:41:24'),
(14, '<b>Admin</b> Menambah Invoice Sebesar <b>Rp 12,312</b> Untuk Vendor 6', '2023-03-07 06:41:36'),
(15, '<b>Admin</b> Menambah Invoice Sebesar <b>Rp 123</b> Untuk Vendor 6', '2023-03-07 06:42:28'),
(16, '<b>Admin</b> Mengubah Nominal Sebesar <b>Rp 123 Menjadi Rp 123</b> ', '2023-03-07 08:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengeluaran`
--

DROP TABLE IF EXISTS `tbl_pengeluaran`;
CREATE TABLE IF NOT EXISTS `tbl_pengeluaran` (
  `id_pengeluaran` int(255) NOT NULL AUTO_INCREMENT,
  `ket_pengeluaran` text,
  `biaya_pengeluaran` int(255) DEFAULT NULL,
  `tgl_pengeluaran` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `imgbukti` varchar(255) DEFAULT NULL,
  `id_user_pengeluaran` int(255) DEFAULT NULL,
  PRIMARY KEY (`id_pengeluaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produksi_selesai`
--

DROP TABLE IF EXISTS `tbl_produksi_selesai`;
CREATE TABLE IF NOT EXISTS `tbl_produksi_selesai` (
  `produksi_selesai_id` int(255) NOT NULL AUTO_INCREMENT,
  `kode_produksi_selesai` varchar(255) DEFAULT NULL,
  `produksi_selesai_jenis` int(255) DEFAULT NULL,
  `produksi_selesai_jumlah` varchar(255) DEFAULT NULL,
  `produksi_selesai_biaya` varchar(255) DEFAULT NULL,
  `produksi_selesai_catatan` text,
  `produksi_selesai_tgl` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `produksi_selesai_user_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`produksi_selesai_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produksi_stock`
--

DROP TABLE IF EXISTS `tbl_produksi_stock`;
CREATE TABLE IF NOT EXISTS `tbl_produksi_stock` (
  `produksi_id` int(255) NOT NULL AUTO_INCREMENT,
  `kode_produksi` varchar(255) DEFAULT NULL,
  `bahan_baku_id` int(255) DEFAULT NULL,
  `jumlah` varchar(255) DEFAULT NULL,
  `biaya_dikeluarkan` varchar(255) DEFAULT NULL,
  `check_proses` int(10) DEFAULT '0',
  `produksi_stock_user_id` int(255) DEFAULT NULL,
  `tgl_buat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`produksi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekap_cash`
--

DROP TABLE IF EXISTS `tbl_rekap_cash`;
CREATE TABLE IF NOT EXISTS `tbl_rekap_cash` (
  `id_cash` int(255) NOT NULL AUTO_INCREMENT,
  `id_cicil_cancel` int(255) DEFAULT NULL,
  `nota_cash` varchar(255) DEFAULT NULL,
  `ket_cash` text,
  `total_cash` varchar(255) DEFAULT NULL,
  `tgl_cash` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rusak`
--

DROP TABLE IF EXISTS `tbl_rusak`;
CREATE TABLE IF NOT EXISTS `tbl_rusak` (
  `produksi_id_rusak` int(255) NOT NULL AUTO_INCREMENT,
  `kode_produksi_rusak` varchar(255) DEFAULT NULL,
  `bahan_baku_id_rusak` int(255) DEFAULT NULL,
  `jumlah_rusak` int(255) DEFAULT NULL,
  `biaya_dikeluarkan_rusak` int(255) DEFAULT NULL,
  `check_proses_rusak` int(10) DEFAULT '0',
  `produksi_stock_user_id_rusak` int(255) DEFAULT NULL,
  `tgl_buat_rusak` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`produksi_id_rusak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

DROP TABLE IF EXISTS `tbl_satuan`;
CREATE TABLE IF NOT EXISTS `tbl_satuan` (
  `id_satuan` int(255) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, '11212');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_selesai_add_stock`
--

DROP TABLE IF EXISTS `tbl_selesai_add_stock`;
CREATE TABLE IF NOT EXISTS `tbl_selesai_add_stock` (
  `produksi_selesai_id` int(255) NOT NULL AUTO_INCREMENT,
  `kode_add_stock_selesai` varchar(255) DEFAULT NULL,
  `add_stock_jumlah` varchar(255) DEFAULT NULL,
  `add_stock_selesai_biaya` varchar(255) DEFAULT NULL,
  `add_stock_catatan` text,
  `add_stock_selesai_tgl` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `suplier` text,
  `add_stock_selesai_user_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`produksi_selesai_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site`
--

DROP TABLE IF EXISTS `tbl_site`;
CREATE TABLE IF NOT EXISTS `tbl_site` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) DEFAULT NULL,
  `site_title` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `site_description` text,
  `site_favicon` varchar(50) DEFAULT NULL,
  `site_logo_header` varchar(50) DEFAULT NULL,
  `site_logo_footer` varchar(50) DEFAULT NULL,
  `site_logo_big` varchar(50) DEFAULT NULL,
  `site_facebook` varchar(150) DEFAULT NULL,
  `site_twitter` varchar(150) DEFAULT NULL,
  `site_instagram` varchar(150) DEFAULT NULL,
  `site_youtube` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_site`
--

INSERT INTO `tbl_site` (`site_id`, `site_name`, `site_title`, `site_description`, `site_favicon`, `site_logo_header`, `site_logo_footer`, `site_logo_big`, `site_facebook`, `site_twitter`, `site_instagram`, `site_youtube`) VALUES
(1, 'Admin Portal', 'Medan Test Center for Japanese Language NAT-TEST', 'Medan Test Center for Japanese Language NAT - TEST', 'nat-tes1.webp', 'Untitled-11.png', 'favicon.png', 'bg211.png', 'https://www.facebook.com/keeki/', 'https://twitter.com/keeki/', 'https://www.instagram.com/keeki/', 'https://www.youtube.com/c/keeki');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

DROP TABLE IF EXISTS `tbl_stock`;
CREATE TABLE IF NOT EXISTS `tbl_stock` (
  `id_stock` int(255) NOT NULL AUTO_INCREMENT,
  `kode_stock` varchar(255) DEFAULT NULL,
  `nama_stock` varchar(255) DEFAULT NULL,
  `kategori_stock` int(255) DEFAULT NULL,
  `kategori_material` varchar(255) DEFAULT NULL,
  `satuan_stock` int(255) DEFAULT NULL,
  `harga_beli` int(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT '0',
  `stock_minimal` int(255) DEFAULT NULL,
  `nilai_saham` varchar(255) DEFAULT '0',
  `tgl_tambah` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_ubah` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id_stock` int(255) DEFAULT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_produksi`
--

DROP TABLE IF EXISTS `tbl_stock_produksi`;
CREATE TABLE IF NOT EXISTS `tbl_stock_produksi` (
  `id_stock` int(255) NOT NULL AUTO_INCREMENT,
  `kode_stock` varchar(255) DEFAULT NULL,
  `nama_stock` varchar(255) DEFAULT NULL,
  `kategori_stock` int(255) DEFAULT NULL,
  `kategori_material` varchar(255) DEFAULT NULL,
  `satuan_stock` int(255) DEFAULT NULL,
  `harga_beli` varchar(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `stock_minimal` int(255) DEFAULT NULL,
  `nilai_saham` varchar(255) DEFAULT NULL,
  `tgl_tambah` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_ubah` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id_stock` int(255) DEFAULT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_jalan`
--

DROP TABLE IF EXISTS `tbl_surat_jalan`;
CREATE TABLE IF NOT EXISTS `tbl_surat_jalan` (
  `surat_jalan_id` int(255) NOT NULL AUTO_INCREMENT,
  `kode_surat_jalan` varchar(255) DEFAULT NULL,
  `jumlah_surat_jalan` varchar(255) DEFAULT NULL,
  `id_user_surat_jalan` int(255) DEFAULT NULL,
  `diserahkan_sj` varchar(255) DEFAULT NULL,
  `penerima_sj` varchar(255) DEFAULT NULL,
  `diketahui_sj` varchar(255) DEFAULT NULL,
  `catatan_surat_jalan` text,
  `tgl_surat_jalan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_ubah_surat_jalan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`surat_jalan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

DROP TABLE IF EXISTS `tbl_transaksi`;
CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `transaksi_id` int(255) NOT NULL AUTO_INCREMENT,
  `kode_transaksi_list` varchar(255) DEFAULT NULL,
  `konsumen_transaksi_id` int(255) DEFAULT NULL,
  `bahan_baku_id` varchar(255) DEFAULT NULL,
  `jumlah_transaksi` varchar(255) DEFAULT NULL,
  `harga_jual_konsumen` varchar(255) DEFAULT NULL,
  `harga_jual_transaksi` varchar(255) DEFAULT NULL,
  `harga_modal_transaksi` varchar(255) DEFAULT NULL,
  `check_proses_transaksi` int(10) DEFAULT '0',
  `transaksi_user_id` int(255) DEFAULT NULL,
  `tgl_buat_transaksi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaksi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(60) DEFAULT NULL,
  `user_password` varchar(40) DEFAULT NULL,
  `user_level` varchar(10) DEFAULT NULL,
  `user_status` varchar(10) DEFAULT '1',
  `user_photo` varchar(40) DEFAULT NULL,
  `vendor` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_level`, `user_status`, `user_photo`, `vendor`) VALUES
(1, 'Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1', '1', '59fd2fc8eb0a635161cd5ee4a22516b6.png', NULL),
(2, 'Hendra Ekspedisi', 'ekspedisi@gmail.com', '928920597d85e012970304984e633a5a', '2', '1', '0455c308a1c9922f734fd2d977b34fe8.webp', 5),
(3, 'Rahmat Warehouse', 'warehouse@gmail.com', '372d30dd2849813ef674855253900679', '2', '1', '8cf49c4c37f819e7cb3a1fbdb82955a2.webp', NULL),
(4, 'tes vendor', 'vendor@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2', '1', 'user_blank.webp', 5),
(5, 'Bayu', 'bayu@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2', '1', 'user_blank.webp', 5),
(6, 'isnan', 'isnan@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2', '1', 'user_blank.webp', NULL),
(7, 'adasdasd', 'asdasdsa@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2', '1', 'user_blank.webp', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `nama`) VALUES
(1, 'tes'),
(2, 'ssss'),
(3, 'ass'),
(5, 'BUDI 1'),
(6, 'BUDI 2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
