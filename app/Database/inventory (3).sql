-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2025 at 02:28 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `atk`
--

CREATE TABLE `atk` (
  `id_atk` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_tipe_barang` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `merek_atk` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `qty_atk` int DEFAULT NULL,
  `status_atk` enum('1','0') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `atk`
--

INSERT INTO `atk` (`id_atk`, `id_tipe_barang`, `merek_atk`, `qty_atk`, `status_atk`, `created_at`, `updated_at`) VALUES
('002143fb-d0e5-4507-aac8-da5d8acb1833', 'adc25fc1-2e6f-4bf6-8c0c-29fe80eda9a9', 'SIDU', 194, '1', '2024-10-10 08:55:09', '2025-08-02 21:13:19'),
('0a326d2a-1c8b-49a2-bc05-fcd141be7e37', '2bdbe221-4de3-4df8-a18d-cf0a4f90f103', '-', 10, '1', '2024-11-01 17:46:20', '2024-11-01 17:46:20'),
('2cd0f32e-76ce-4efa-8959-8d3dd9a0bd00', '1c48c782-7573-4a16-9d57-3ca14d2da148', 'Standar', 35, '1', '2024-11-01 17:42:57', '2024-11-01 18:10:46'),
('51f793a1-ffa2-4357-9a8e-b789929943fa', 'b8eca239-7aab-4799-8e09-77a94209a353', '-', 2, '1', '2024-11-01 17:47:50', '2024-11-01 17:47:50'),
('60522f02-2bbd-4467-9889-238670a2fde9', '65757304-5ede-41b7-b995-aad2032b3ba8', 'Faber Castell', 5, '1', '2024-11-01 17:45:00', '2024-11-01 17:45:00'),
('622381fb-c1e2-4210-b3c3-3a5d04887278', 'cb007d6b-854d-418e-a5af-fe54a4260394', '-', 20, '1', '2024-11-01 17:45:59', '2024-11-01 17:45:59'),
('62339b2e-08d6-400a-9a00-282f08bbf438', '1dba0446-6590-4f43-bc41-7b58a52a4b4e', 'ABC', 11, '1', '2024-11-01 17:43:09', '2024-11-01 18:10:46'),
('6a86ae82-e88a-488e-b24c-51f5ce398aca', '89bef369-23f0-4261-b0ab-34c29ff18797', 'Joyco', 5, '1', '2024-11-01 17:49:30', '2024-11-01 17:49:30'),
('70c37607-561e-4429-a0ee-29cd384ed274', '0bfd54da-3d08-4a79-9d73-c6ff3a46d7a6', 'SIDU', 1, '1', '2024-11-02 08:56:15', '2024-11-02 08:56:15'),
('715dfb2f-11ed-4e7d-a860-300a9074387b', 'b4091dc2-838b-456e-98e3-f13c2f9aede4', 'SIDU', 7, '1', '2024-10-10 08:56:01', '2024-11-04 21:18:11'),
('716ca917-0d30-45ba-8706-08d41f5dd474', '9af56fc0-48f3-44d1-a992-e93a4a2838ea', 'Sinoman', 10, '1', '2024-11-01 17:43:46', '2024-11-01 17:43:46'),
('9b3ce403-ff1c-40c9-a6cc-ac084743c34f', '3a8b773c-8f49-42d4-b4c0-130442b8b009', 'ABC', 1, '1', '2024-11-01 17:17:23', '2024-11-01 17:17:23'),
('9c297635-604b-414d-91f8-8321f5febba9', '743b6c63-a5b1-40f1-9d04-1c960d24a052', 'Faber Castell', 5, '1', '2024-11-01 17:45:41', '2024-11-01 17:45:41'),
('b24bda30-b4d3-4d8e-84c7-971d384e1137', '0bfd54da-3d08-4a79-9d73-c6ff3a46d7a6', 'KIKY', 5, '1', '2024-11-02 08:56:35', '2024-11-02 09:14:42'),
('b3760777-99ce-4539-b0ed-e3d2f8df0112', '2f5c4798-cf16-4b1f-8704-72fed324ad06', 'SMANSA', 50, '1', '2024-11-01 17:45:23', '2024-11-01 17:45:23'),
('b3e602cd-c50d-442e-a6bc-c4d1b35d129b', '1468354b-03ff-498f-b8f1-62c4f8bcaa8d', 'Great Well', 10, '1', '2024-11-01 17:48:34', '2024-11-01 17:48:34'),
('de5b3181-b8a1-450e-8bcd-02f7f628edd7', '55952521-e6cc-43a1-9771-59be80ce6091', 'Sinoman', 5, '1', '2024-11-01 17:44:29', '2024-11-01 17:44:29'),
('dec97369-2f1d-4772-a743-3e3569883b1b', '927f0949-8262-4ded-9b16-06e69ac6d8ba', 'Joyco', 5, '1', '2024-11-01 17:49:14', '2024-11-01 17:49:14'),
('e96f0df4-73e7-4e6c-a100-d05dbe26ac85', '541de5df-926e-49e9-82e7-7fd1ea24a8b6', 'Sinoman', 6, '1', '2024-11-01 17:44:05', '2024-11-04 21:15:08'),
('fcbee8fa-66a3-496d-a0bf-50d9abb4787f', '9e53561e-23bc-44f1-af42-e298eda67418', '-', 10, '1', '2024-11-01 17:46:35', '2024-11-01 17:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '0',
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `status_barang` enum('0','1') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `jenis_barang` enum('0','1') COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `status_barang`, `jenis_barang`, `created_at`, `updated_at`) VALUES
('ATK-20241010-850', 'Kertas F4', '1', '0', '2024-10-10 08:51:28', '2024-10-12 08:38:26'),
('ATK-20241101-156', 'Isi Stapler', '1', '0', '2024-11-01 17:39:01', '2024-11-01 17:39:01'),
('ATK-20241101-373', 'Spidol', '1', '0', '2024-11-01 17:22:36', '2024-11-01 17:22:36'),
('ATK-20241101-431', 'Penghapus', '1', '0', '2024-11-01 17:21:05', '2024-11-01 17:21:05'),
('ATK-20241101-432', 'Baterai', '1', '0', '2024-11-01 16:21:25', '2024-11-01 16:21:25'),
('ATK-20241101-665', 'Sticky Note', '1', '0', '2024-11-01 17:23:50', '2024-11-01 17:23:50'),
('ATK-20241101-753', 'Stapler', '1', '0', '2024-11-01 17:26:35', '2024-11-01 17:26:35'),
('ATK-20241101-874', 'Pulpen', '1', '0', '2024-11-01 16:21:16', '2024-11-01 17:57:11'),
('ATK-20241101-930', 'Pensil', '1', '0', '2024-11-01 17:19:09', '2024-11-01 17:19:09'),
('ATK-20241102-511', 'Ordner', '1', '0', '2024-11-02 08:45:11', '2024-11-02 08:45:11'),
('INV-20241010-847', 'Meja', '1', '1', '2024-10-10 14:56:46', '2024-10-10 14:56:46'),
('INV-20241025-586', 'Komputer', '1', '1', '2024-10-25 23:45:56', '2024-10-25 23:45:56'),
('INV-20241101-922', 'Map', '1', '0', '2024-11-01 17:40:01', '2024-11-01 17:40:08'),
('INV-20241101-965', 'Kursi', '1', '1', '2024-11-01 16:22:43', '2024-11-01 16:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengadaan`
--

CREATE TABLE `detail_pengadaan` (
  `id_detail_pengadaan` int NOT NULL,
  `id_pengadaan` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_tipe_barang` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `qty` int NOT NULL DEFAULT '0',
  `spek` text COLLATE utf8mb4_unicode_520_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `catatan_detail_pengadaan` text COLLATE utf8mb4_unicode_520_ci,
  `status_detail_pengadaan` enum('0','1','2') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `detail_pengadaan`
--

INSERT INTO `detail_pengadaan` (`id_detail_pengadaan`, `id_pengadaan`, `id_tipe_barang`, `qty`, `spek`, `created_at`, `updated_at`, `catatan_detail_pengadaan`, `status_detail_pengadaan`) VALUES
(2, 'b6aa0fea-8a16-4e6c-9fdc-fd8cf0fb0f42', '74b84e4f-7997-4266-b223-ded814a25c3c', 1, 'Meja Kayu ', '2024-10-12 08:41:20', '2024-10-12 09:34:03', 'Okey', '1'),
(3, 'b6aa0fea-8a16-4e6c-9fdc-fd8cf0fb0f42', '95b2a99d-1ffb-4f50-8028-17a7665ae953', 3, '', '2024-10-12 08:41:20', '2024-10-12 09:33:57', 'Belum buutuh', '2'),
(4, 'b6aa0fea-8a16-4e6c-9fdc-fd8cf0fb0f42', 'fecee1f2-5d04-43a3-940f-89ee14c49fd1', 1, '', '2024-10-12 08:41:20', '2024-10-12 09:33:58', 'Belum Butuh', '2'),
(5, '4029af34-74ea-48f9-ad78-d5b89d7e1c15', '74b84e4f-7997-4266-b223-ded814a25c3c', 1, 'bh', '2024-10-17 11:51:18', '2024-11-03 19:42:00', NULL, '1'),
(6, '0707d700-c2ac-4c29-b551-04ef621f39a1', '95b2a99d-1ffb-4f50-8028-17a7665ae953', 1, 'Set', '2024-11-01 19:50:12', '2024-11-03 20:11:35', '', '1'),
(7, '6eb51afa-5517-44a8-8803-f30e9f8149be', '74b84e4f-7997-4266-b223-ded814a25c3c', 1, 'Butuh ge', '2024-11-03 14:47:35', '2024-11-03 19:14:07', '', '1'),
(8, '31fcab17-b712-4ed9-81c7-c37dca235b13', '74b84e4f-7997-4266-b223-ded814a25c3c', 1, '', '2024-11-03 19:20:01', '2024-11-03 19:39:25', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int NOT NULL,
  `id_transaksi` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `id_atk` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `qty` int NOT NULL DEFAULT '0',
  `status_detail_transaksi` enum('0','1','2') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '0',
  `catatan_detail_transaksi` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_atk`, `qty`, `status_detail_transaksi`, `catatan_detail_transaksi`, `created_at`, `updated_at`) VALUES
(6, '2057bb01-6596-4044-a540-c8913641451f', '715dfb2f-11ed-4e7d-a860-300a9074387b', 10, '1', 'Okey', '2024-10-12 08:39:07', '2024-10-12 09:15:30'),
(7, '2057bb01-6596-4044-a540-c8913641451f', '002143fb-d0e5-4507-aac8-da5d8acb1833', 0, '2', 'Sudah banyak', '2024-10-12 08:39:07', '2024-10-12 09:30:24'),
(8, 'ec49bcd3-4b28-4fe5-83ed-43543380072a', '002143fb-d0e5-4507-aac8-da5d8acb1833', 2, '1', 'ok', '2024-10-12 09:21:56', '2024-10-12 09:22:17'),
(9, 'b6bfba13-6b1e-4b69-91d0-b7c5201a94ac', '002143fb-d0e5-4507-aac8-da5d8acb1833', 1, '1', '', '2024-10-12 09:22:43', '2024-10-12 09:23:08'),
(10, 'b6bfba13-6b1e-4b69-91d0-b7c5201a94ac', '715dfb2f-11ed-4e7d-a860-300a9074387b', 1, '2', 'Belum ada', '2024-10-12 09:22:43', '2024-10-12 09:23:08'),
(11, '6be0bc8b-f8ca-498f-bf0e-8a79ae8aeeee', '715dfb2f-11ed-4e7d-a860-300a9074387b', 2, '1', '', '2024-10-12 09:23:39', '2024-11-04 21:18:11'),
(12, 'bc1adaea-1516-4a0c-8344-e05a2d98036d', '002143fb-d0e5-4507-aac8-da5d8acb1833', 2, '1', '', '2024-10-12 11:31:43', '2024-10-12 11:51:20'),
(13, 'bc1adaea-1516-4a0c-8344-e05a2d98036d', '715dfb2f-11ed-4e7d-a860-300a9074387b', 1, '1', '', '2024-10-12 11:50:19', '2024-10-12 11:51:20'),
(14, '3d091dd0-d4ec-4177-b007-045ab0d5a8a0', '002143fb-d0e5-4507-aac8-da5d8acb1833', 1, '1', 'Ok', '2024-11-01 17:54:09', '2024-11-01 17:55:01'),
(15, '3d091dd0-d4ec-4177-b007-045ab0d5a8a0', '2cd0f32e-76ce-4efa-8959-8d3dd9a0bd00', 5, '1', 'Cuman ada 1 Stok e', '2024-11-01 17:54:09', '2024-11-01 17:55:01'),
(16, '7d50c144-20ac-4755-a868-49cf8508061f', '2cd0f32e-76ce-4efa-8959-8d3dd9a0bd00', 5, '1', '5 aja yaa', '2024-11-01 17:57:42', '2024-11-01 17:58:10'),
(17, 'd263fa20-65cb-476c-9dbc-ed5a54e7afce', '2cd0f32e-76ce-4efa-8959-8d3dd9a0bd00', 30, '1', '30 sisan', '2024-11-01 18:00:03', '2024-11-01 18:01:45'),
(18, 'd263fa20-65cb-476c-9dbc-ed5a54e7afce', '62339b2e-08d6-400a-9a00-282f08bbf438', 10, '1', 'Okee', '2024-11-01 18:00:03', '2024-11-01 18:01:45'),
(19, '6259b43c-1705-4d71-9b72-fbb3eb49637e', 'b24bda30-b4d3-4d8e-84c7-971d384e1137', 5, '1', '', '2024-11-02 09:05:04', '2024-11-02 09:14:36'),
(20, '6259b43c-1705-4d71-9b72-fbb3eb49637e', '002143fb-d0e5-4507-aac8-da5d8acb1833', 1, '2', 'Stok Masih Banyak', '2024-11-02 09:05:04', '2024-11-02 09:06:12'),
(21, 'c6bbedc2-14af-4a75-9848-be39f077d941', 'e96f0df4-73e7-4e6c-a100-d05dbe26ac85', 1, '1', '', '2024-11-04 20:44:59', '2024-11-04 21:06:37'),
(22, '6e25506b-64ca-4e5e-872b-7207de8e72fc', '0a326d2a-1c8b-49a2-bc05-fcd141be7e37', 1, '0', '', '2024-11-04 21:20:18', '2024-11-04 21:20:18'),
(23, 'ed4d17c5-df3f-408a-a1f3-9dee5684ae56', '002143fb-d0e5-4507-aac8-da5d8acb1833', 1, '0', '', '2024-11-04 21:20:39', '2024-11-04 21:20:39'),
(24, '5a59d7d4-e201-4f8c-809f-ff5bfecf012c', '002143fb-d0e5-4507-aac8-da5d8acb1833', 1, '0', '', '2024-11-04 21:22:59', '2024-11-04 21:22:59'),
(25, '43375657-e723-4d13-9a90-f4a44a525efe', '002143fb-d0e5-4507-aac8-da5d8acb1833', 1, '1', '', '2024-11-11 20:04:43', '2024-11-11 20:04:53'),
(26, 'cd13a34a-d383-41d6-a6d2-521a33724969', '002143fb-d0e5-4507-aac8-da5d8acb1833', 1, '1', '', '2024-11-13 10:37:15', '2024-11-13 10:38:14'),
(27, '0722fd45-1348-478c-98f4-df785a40e35a', '002143fb-d0e5-4507-aac8-da5d8acb1833', 1, '1', '', '2024-11-15 14:08:08', '2025-08-02 21:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id_inventaris` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_tipe_barang` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_ruangan` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '0',
  `nama_inventaris` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `qty_inventaris` int NOT NULL DEFAULT '0',
  `spek_inventaris` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `qr_code` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status_inventaris` enum('0','1','2','3') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `harga_inventaris` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `perolehan_inventaris` date NOT NULL,
  `sumber_inventaris` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id_inventaris`, `id_tipe_barang`, `id_ruangan`, `nama_inventaris`, `qty_inventaris`, `spek_inventaris`, `qr_code`, `status_inventaris`, `harga_inventaris`, `perolehan_inventaris`, `sumber_inventaris`, `created_at`, `updated_at`) VALUES
('BRG-20241103-10060', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 9', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-10060.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:44', '2024-11-03 13:17:44'),
('BRG-20241103-10614', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 18', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-10614.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:36', '2024-11-03 13:17:36'),
('BRG-20241103-10757', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 5', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-10757.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:33', '2024-11-03 13:17:33'),
('BRG-20241103-10868', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 34', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-10868.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:40', '2024-11-03 13:17:40'),
('BRG-20241103-11087', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 3', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-11087.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:42', '2024-11-03 13:17:42'),
('BRG-20241103-11578', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 31', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-11578.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:40', '2024-11-03 13:17:40'),
('BRG-20241103-11704', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 16', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-11704.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:45', '2024-11-03 13:17:45'),
('BRG-20241103-12627', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 29', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-12627.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:49', '2024-11-03 13:17:49'),
('BRG-20241103-13288', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 12', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-13288.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:25', '2024-11-03 13:17:25'),
('BRG-20241103-13664', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 10', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-13664.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:44', '2024-11-03 13:17:44'),
('BRG-20241103-14324', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 28', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-14324.png', '2', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:20', '2024-11-05 19:11:03'),
('BRG-20241103-14747', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 27', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-14747.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:48', '2024-11-03 13:17:48'),
('BRG-20241103-14998', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 1', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-14998.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:41', '2024-11-03 13:17:41'),
('BRG-20241103-16216', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 37', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-16216.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:22', '2024-11-03 13:17:22'),
('BRG-20241103-16344', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 7', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-16344.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:14', '2024-11-03 13:17:14'),
('BRG-20241103-17994', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 36', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-17994.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:50', '2024-11-03 13:17:50'),
('BRG-20241103-18774', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 31', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-18774.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:49', '2024-11-03 13:17:49'),
('BRG-20241103-19768', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 29', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-19768.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:30', '2024-11-03 13:17:30'),
('BRG-20241103-19862', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 4', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-19862.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:42', '2024-11-03 13:17:42'),
('BRG-20241103-20248', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 16', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-20248.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:26', '2024-11-03 13:17:26'),
('BRG-20241103-20715', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 25', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-20715.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:19', '2024-11-03 13:17:19'),
('BRG-20241103-21827', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 27', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-21827.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:29', '2024-11-03 13:17:29'),
('BRG-20241103-21940', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 16', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-21940.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:17', '2024-11-03 13:17:17'),
('BRG-20241103-23119', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 36', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-23119.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:32', '2024-11-03 13:17:32'),
('BRG-20241103-23496', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 21', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-23496.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:47', '2024-11-03 13:17:47'),
('BRG-20241103-25116', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 5', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-25116.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:14', '2024-11-03 13:17:14'),
('BRG-20241103-26210', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 28', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-26210.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:29', '2024-11-03 13:17:29'),
('BRG-20241103-2636', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 22', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-2636.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:37', '2024-11-03 13:17:37'),
('BRG-20241103-26506', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 23', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-26506.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:28', '2024-11-03 13:17:28'),
('BRG-20241103-26971', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 18', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-26971.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:27', '2024-11-03 13:17:27'),
('BRG-20241103-27842', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 24', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-27842.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:38', '2024-11-03 13:17:38'),
('BRG-20241103-29851', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 10', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-29851.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:15', '2024-11-03 13:17:15'),
('BRG-20241103-31539', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 22', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-31539.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:47', '2024-11-03 13:17:47'),
('BRG-20241103-32296', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 12', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-32296.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:35', '2024-11-03 13:17:35'),
('BRG-20241103-34009', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 17', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-34009.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:36', '2024-11-03 13:17:36'),
('BRG-20241103-34690', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 23', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-34690.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:47', '2024-11-03 13:17:47'),
('BRG-20241103-34790', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 9', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-34790.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:15', '2024-11-03 13:17:15'),
('BRG-20241103-34823', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 1', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-34823.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:22', '2024-11-03 13:17:22'),
('BRG-20241103-35707', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 11', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-35707.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:25', '2024-11-03 13:17:25'),
('BRG-20241103-35974', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 6', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-35974.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:14', '2024-11-03 13:17:14'),
('BRG-20241103-36645', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 27', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-36645.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:20', '2024-11-03 13:17:20'),
('BRG-20241103-3723', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 22', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-3723.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:28', '2024-11-03 13:17:28'),
('BRG-20241103-38206', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 25', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-38206.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:29', '2024-11-03 13:17:29'),
('BRG-20241103-38435', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 33', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-38435.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:40', '2024-11-03 13:17:40'),
('BRG-20241103-38938', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 8', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-38938.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:43', '2024-11-03 13:17:43'),
('BRG-20241103-39155', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 17', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-39155.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:46', '2024-11-03 13:17:46'),
('BRG-20241103-39167', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 24', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-39167.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:47', '2024-11-03 13:17:47'),
('BRG-20241103-39346', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 2', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-39346.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:42', '2024-11-03 13:17:42'),
('BRG-20241103-39505', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 37', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-39505.png', '1', '4500000', '2010-09-12', 'Bantuan', '2024-11-03 13:17:32', '2024-11-03 13:17:32'),
('BRG-20241103-39875', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 19', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-39875.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:37', '2024-11-03 13:17:37'),
('BRG-20241103-40766', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 21', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-40766.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:28', '2024-11-03 13:17:28'),
('BRG-20241103-40855', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 26', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-40855.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:19', '2024-11-03 13:17:19'),
('BRG-20241103-41024', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 33', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-41024.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:31', '2024-11-03 13:17:31'),
('BRG-20241103-41356', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 3', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-41356.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:23', '2024-11-03 13:17:23'),
('BRG-20241103-418', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 33', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-418.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:50', '2024-11-03 13:17:50'),
('BRG-20241103-42104', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 8', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-42104.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:24', '2024-11-03 13:17:24'),
('BRG-20241103-42392', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 23', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-42392.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:38', '2024-11-03 13:17:38'),
('BRG-20241103-42869', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 2', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-42869.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:32', '2024-11-03 13:17:32'),
('BRG-20241103-43826', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 29', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-43826.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:39', '2024-11-03 13:17:39'),
('BRG-20241103-43908', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 3', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-43908.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:33', '2024-11-03 13:17:33'),
('BRG-20241103-44599', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 12', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-44599.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:16', '2024-11-03 13:17:16'),
('BRG-20241103-45322', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 5', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-45322.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:24', '2024-11-03 13:17:24'),
('BRG-20241103-45801', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 15', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-45801.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:26', '2024-11-03 13:17:26'),
('BRG-20241103-4600', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 15', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-4600.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:36', '2024-11-03 13:17:36'),
('BRG-20241103-46322', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 3', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-46322.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:13', '2024-11-03 13:17:13'),
('BRG-20241103-46356', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 1', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-46356.png', '1', '7000000', '2020-09-10', 'Bantua', '2024-11-03 13:17:13', '2024-11-03 13:17:13'),
('BRG-20241103-47086', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 36', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-47086.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:22', '2024-11-03 13:17:22'),
('BRG-20241103-47397', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 16', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-47397.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:36', '2024-11-03 13:17:36'),
('BRG-20241103-4744', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 6', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-4744.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:24', '2024-11-03 13:17:24'),
('BRG-20241103-48066', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 20', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-48066.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:27', '2024-11-03 13:17:27'),
('BRG-20241103-50224', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 15', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-50224.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:16', '2024-11-03 13:17:16'),
('BRG-20241103-50265', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 34', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-50265.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:50', '2024-11-03 13:17:50'),
('BRG-20241103-51211', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 4', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-51211.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:33', '2024-11-03 13:17:33'),
('BRG-20241103-51741', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 37', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-51741.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:41', '2024-11-03 13:17:41'),
('BRG-20241103-51929', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 26', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-51929.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:29', '2024-11-03 13:17:29'),
('BRG-20241103-53538', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 6', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-53538.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:43', '2024-11-03 13:17:43'),
('BRG-20241103-54631', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 18', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-54631.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:46', '2024-11-03 13:17:46'),
('BRG-20241103-5539', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 17', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-5539.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:27', '2024-11-03 13:17:27'),
('BRG-20241103-55492', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 11', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-55492.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:44', '2024-11-03 13:17:44'),
('BRG-20241103-55576', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 13', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-55576.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:35', '2024-11-03 13:17:35'),
('BRG-20241103-55635', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 29', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-55635.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:20', '2024-11-03 13:17:20'),
('BRG-20241103-56906', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 14', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-56906.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:26', '2024-11-03 13:17:26'),
('BRG-20241103-57104', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 12', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-57104.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:44', '2024-11-03 13:17:44'),
('BRG-20241103-57554', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 14', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-57554.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:45', '2024-11-03 13:17:45'),
('BRG-20241103-57980', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 11', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-57980.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:15', '2024-11-03 13:17:15'),
('BRG-20241103-58429', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 32', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-58429.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:49', '2024-11-03 13:17:49'),
('BRG-20241103-58472', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 35', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-58472.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:31', '2024-11-03 13:17:31'),
('BRG-20241103-58789', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 33', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-58789.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:21', '2024-11-03 13:17:21'),
('BRG-20241103-58938', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 19', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-58938.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:46', '2024-11-03 13:17:46'),
('BRG-20241103-59454', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 28', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-59454.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:48', '2024-11-03 13:17:48'),
('BRG-20241103-6018', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 32', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-6018.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:30', '2024-11-03 13:17:30'),
('BRG-20241103-60967', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 31', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-60967.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:21', '2024-11-03 13:17:21'),
('BRG-20241103-612', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 6', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-612.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:33', '2024-11-03 13:17:33'),
('BRG-20241103-6132', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 30', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-6132.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:20', '2024-11-03 13:17:20'),
('BRG-20241103-61321', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 36', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-61321.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:41', '2024-11-03 13:17:41'),
('BRG-20241103-62527', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 2', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-62527.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:23', '2024-11-03 13:17:23'),
('BRG-20241103-63388', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 26', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-63388.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:38', '2024-11-03 13:17:38'),
('BRG-20241103-63410', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 21', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-63410.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:37', '2024-11-03 13:17:37'),
('BRG-20241103-63560', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 31', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-63560.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:30', '2024-11-03 13:17:30'),
('BRG-20241103-6396', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 9', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-6396.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:25', '2024-11-03 13:17:25'),
('BRG-20241103-64724', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 15', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-64724.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:45', '2024-11-03 13:17:45'),
('BRG-20241103-65671', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 1', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-65671.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:32', '2024-11-03 13:17:32'),
('BRG-20241103-66025', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 5', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-66025.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:43', '2024-11-03 13:17:43'),
('BRG-20241103-66727', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 19', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-66727.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:17', '2024-11-03 13:17:17'),
('BRG-20241103-66946', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 20', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-66946.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:37', '2024-11-03 13:17:37'),
('BRG-20241103-66965', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 37', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-66965.png', '1', '6000001', '2016-12-02', 'Bantuan', '2024-11-03 13:17:51', '2024-11-03 13:17:51'),
('BRG-20241103-68055', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 30', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-68055.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:39', '2024-11-03 13:17:39'),
('BRG-20241103-68567', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 20', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-68567.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:18', '2024-11-03 13:17:18'),
('BRG-20241103-69575', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 13', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-69575.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:26', '2024-11-03 13:17:26'),
('BRG-20241103-70253', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 7', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-70253.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:24', '2024-11-03 13:17:24'),
('BRG-20241103-70552', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 18', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-70552.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:17', '2024-11-03 13:17:17'),
('BRG-20241103-70667', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 24', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-70667.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:28', '2024-11-03 13:17:28'),
('BRG-20241103-71027', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 13', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-71027.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:16', '2024-11-03 13:17:16'),
('BRG-20241103-71485', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 27', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-71485.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:39', '2024-11-03 13:17:39'),
('BRG-20241103-73446', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 30', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-73446.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:30', '2024-11-03 13:17:30'),
('BRG-20241103-73558', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 23', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-73558.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:18', '2024-11-03 13:17:18'),
('BRG-20241103-74665', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 25', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-74665.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:38', '2024-11-03 13:17:38'),
('BRG-20241103-75068', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 34', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-75068.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:31', '2024-11-03 13:17:31'),
('BRG-20241103-75421', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 8', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-75421.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:34', '2024-11-03 13:17:34'),
('BRG-20241103-76269', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 24', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-76269.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:19', '2024-11-03 13:17:19'),
('BRG-20241103-77053', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 4', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-77053.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:13', '2024-11-03 13:17:13'),
('BRG-20241103-77263', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 13', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-77263.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:45', '2024-11-03 13:17:45'),
('BRG-20241103-77346', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 26', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-77346.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:48', '2024-11-03 13:17:48'),
('BRG-20241103-78153', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 25', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-78153.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:48', '2024-11-03 13:17:48'),
('BRG-20241103-79390', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 32', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-79390.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:21', '2024-11-03 13:17:21'),
('BRG-20241103-79587', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 14', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-79587.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:35', '2024-11-03 13:17:35'),
('BRG-20241103-85955', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 20', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-85955.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:46', '2024-11-03 13:17:46'),
('BRG-20241103-8624', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 32', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-8624.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:40', '2024-11-03 13:17:40'),
('BRG-20241103-86359', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 7', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-86359.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:34', '2024-11-03 13:17:34'),
('BRG-20241103-87592', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 10', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-87592.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:25', '2024-11-03 13:17:25'),
('BRG-20241103-87838', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 17', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-87838.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:17', '2024-11-03 13:17:17'),
('BRG-20241103-88161', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 35', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-88161.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:41', '2024-11-03 13:17:41'),
('BRG-20241103-89013', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 2', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-89013.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:13', '2024-11-03 13:17:13'),
('BRG-20241103-89208', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 28', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-89208.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:39', '2024-11-03 13:17:39'),
('BRG-20241103-90881', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 19', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-90881.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:27', '2024-11-03 13:17:27'),
('BRG-20241103-91363', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 35', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-91363.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:50', '2024-11-03 13:17:50'),
('BRG-20241103-91704', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 8', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-91704.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:15', '2024-11-03 13:17:15'),
('BRG-20241103-92375', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'e7301de4-fe7e-4f57-8708-6cddd9b69784', 'Komuter LAB A 4', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-92375.png', '1', '4500000', '2010-09-11', 'Bantuan', '2024-11-03 13:17:23', '2024-11-03 13:17:23'),
('BRG-20241103-92796', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 9', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-92796.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:34', '2024-11-03 13:17:34'),
('BRG-20241103-93646', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 14', 1, 'Intel Core I3-7130U, 4gb RAM, 1000gb HHD', 'BRG-20241103-93646.png', '1', '7000000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:16', '2024-11-03 13:17:16'),
('BRG-20241103-94073', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 34', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-94073.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:21', '2024-11-03 13:17:21'),
('BRG-20241103-9653', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 7', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-9653.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:43', '2024-11-03 13:17:43'),
('BRG-20241103-96768', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 21', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-96768.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:18', '2024-11-03 13:17:18'),
('BRG-20241103-97589', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 22', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-97589.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:18', '2024-11-03 13:17:18'),
('BRG-20241103-98489', 'c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'Komuter LAB C 35', 1, 'AMD A4, 4gb RAM, 500gb HHD', 'BRG-20241103-98489.png', '1', '6500000', '2020-09-10', 'Bantuan', '2024-11-03 13:17:22', '2024-11-03 13:17:22'),
('BRG-20241103-99189', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 10', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-99189.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:34', '2024-11-03 13:17:34'),
('BRG-20241103-99340', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'Komuter LAB Bahasa 30', 1, 'Intel Core Core  I3 3217u, 4gb RAM, 500gb HHD + 128 SSD', 'BRG-20241103-99340.png', '1', '6000000', '2016-12-01', 'Bantuan', '2024-11-03 13:17:49', '2024-11-03 13:17:49'),
('BRG-20241103-99346', 'e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'Komuter LAB B 11', 1, 'Intel Core Celeron, 2gb RAM, 500gb HHD', 'BRG-20241103-99346.png', '1', '4500000', '2012-10-12', 'Bantuan', '2024-11-03 13:17:35', '2024-11-03 13:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int NOT NULL,
  `penerima_notifikasi` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pengirim_notifikasi` varchar(255) NOT NULL,
  `isi_notifikasi` text NOT NULL,
  `status_notifikasi` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `penerima_notifikasi`, `pengirim_notifikasi`, `isi_notifikasi`, `status_notifikasi`, `created_at`, `updated_at`) VALUES
(1, '6dcfcc29-758f-450b-9a5a-5381608db711', 'admin (Admin)', 'Permintaan transaksi ATK keluar telah ditambahkan', '1', '2024-11-11 20:04:43', NULL),
(2, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'admin (Admin)', 'Permintaan transaksi ATK keluar telah ditambahkan', '1', '2024-11-11 20:04:43', NULL),
(3, 'fe826a1a-91ff-43a6-9442-330565e33bfc', 'admin (Admin)', 'Permintaan transaksi ATK keluar telah ditambahkan', '1', '2024-11-11 20:04:43', NULL),
(4, '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', 'admin (Admin)', 'Proses permintaan ATK telah diproses', '1', '2024-11-11 20:04:53', NULL),
(5, '4a53e50a-0be7-448a-9bbf-fdfe8fed4525', 'admin (Admin)', 'Transaksi masuk baru telah ditambahkan', '1', '2024-11-13 10:37:15', NULL),
(6, '1c00c4ae-d288-4d42-a509-dff168ac2175', 'Selamet Riyanto (KA. TU)', 'Transaksi masuk telah disetujui', '1', '2024-11-13 10:38:14', NULL),
(7, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'Selamet Riyanto (KA. TU)', 'Permintaan transaksi masuk telah disetujui', '1', '2024-11-13 10:38:14', NULL),
(8, '4a53e50a-0be7-448a-9bbf-fdfe8fed4525', 'sutopik (Petugas BOS)', 'Status  trasaksi masuk telah diubah menjadi Proses\n                                            Pengadaan', '1', '2024-11-13 10:40:50', NULL),
(9, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'sutopik (Petugas BOS)', 'Status trasaksi masuk telah diubah menjadi Proses\n                                            Pengadaan', '1', '2024-11-13 10:40:50', NULL),
(10, '4a53e50a-0be7-448a-9bbf-fdfe8fed4525', 'admin (Admin)', 'Transaksi masuk baru telah ditambahkan', '1', '2024-11-15 14:08:08', NULL),
(11, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'Selamet Riyanto (KA. TU)', 'Permintaan transaksi masuk telah disetujui', '1', '2025-08-02 21:12:02', NULL),
(12, '1c00c4ae-d288-4d42-a509-dff168ac2175', 'Selamet Riyanto (KA. TU)', 'Transaksi masuk telah disetujui', '1', '2025-08-02 21:12:02', NULL),
(13, '4a53e50a-0be7-448a-9bbf-fdfe8fed4525', 'sutopik (Petugas BOS)', 'Status  trasaksi masuk telah diubah menjadi Proses\n                                            Pengadaan', '1', '2025-08-02 21:12:40', NULL),
(14, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'sutopik (Petugas BOS)', 'Status trasaksi masuk telah diubah menjadi Proses\n                                            Pengadaan', '1', '2025-08-02 21:12:40', NULL),
(15, '1c00c4ae-d288-4d42-a509-dff168ac2175', 'admin (Admin)', 'Status trasaksi masuk telah diubah menjadi Selesai\n                                        ', '1', '2025-08-02 21:13:19', NULL),
(16, '4a53e50a-0be7-448a-9bbf-fdfe8fed4525', 'admin (Admin)', 'Status trasaksi masuk telah diubah menjadi Selesai\n                                        ', '1', '2025-08-02 21:13:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_pengadaan` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_user` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `ket_pengadaan` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status_pengadaan` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `tgl_disetujui` date DEFAULT NULL,
  `tgl_permintaan` date DEFAULT NULL,
  `tgl_pengadaan` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`id_pengadaan`, `id_user`, `ket_pengadaan`, `status_pengadaan`, `tgl_disetujui`, `tgl_permintaan`, `tgl_pengadaan`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
('0707d700-c2ac-4c29-b551-04ef621f39a1', '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'Untuk Mengganti Meja Kelas', '4', '2024-11-03', '2024-11-01', '2024-11-03', '2024-11-03', '2024-11-01 19:50:12', '2024-11-03 20:22:26'),
('31fcab17-b712-4ed9-81c7-c37dca235b13', '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'asd', '4', NULL, '2024-11-03', '2024-11-03', '2024-11-03', '2024-11-03 19:20:01', '2024-11-03 20:08:02'),
('4029af34-74ea-48f9-ad78-d5b89d7e1c15', '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'hh', '4', '2024-11-03', '2024-10-17', '2024-11-03', '2024-11-03', '2024-10-17 11:51:18', '2024-11-03 19:42:00'),
('6eb51afa-5517-44a8-8803-f30e9f8149be', '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'Butuh', '4', '2024-11-03', '2024-11-03', '2024-11-03', '2024-11-03', '2024-11-03 14:47:35', '2024-11-03 19:14:07'),
('b6aa0fea-8a16-4e6c-9fdc-fd8cf0fb0f42', '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'Peremajaan Meja', '4', '2024-10-12', '2024-10-12', '2024-10-12', '2024-10-12', '2024-10-12 08:41:20', '2024-10-12 09:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `pengecekan`
--

CREATE TABLE `pengecekan` (
  `id_pengecekan` int NOT NULL,
  `id_user` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `id_inventaris` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `foto_pengecekan` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `ket_pengecekan` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status_pengecekan` enum('0','1','2','3') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `pengecekan`
--

INSERT INTO `pengecekan` (`id_pengecekan`, `id_user`, `id_inventaris`, `foto_pengecekan`, `ket_pengecekan`, `status_pengecekan`, `created_at`, `updated_at`) VALUES
(5, '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', 'BRG-20241101-71321', '1730459551_febada82da679c41aeec.png', 'Lemot Barange', '1', '2024-11-01 18:12:31', '2024-11-01 19:40:59'),
(6, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241101-71321', '', 'Okeeee Sudah Clear', '1', '2024-11-01 18:13:25', '2024-11-01 18:13:25'),
(7, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241101-71321', '1730464106_413f76c4e7fe1466f4a3.jpg', 'Rsusak', '1', '2024-11-01 19:28:26', '2024-11-01 19:40:59'),
(8, '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', 'BRG-20241101-65588', '1730464207_90a55e707550e3e75f7d.png', 'Rusak bro', '1', '2024-11-01 19:30:07', '2024-11-01 19:41:36'),
(9, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241101-65588', '', 'Proses Pebaikan Komponen', '1', '2024-11-01 19:30:41', '2024-11-01 19:41:36'),
(10, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241101-71321', '', 'Sudah Oke', '1', '2024-11-01 19:40:59', '2024-11-01 19:40:59'),
(11, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241101-65588', '', 'Okeee', '1', '2024-11-01 19:41:36', '2024-11-01 19:41:36'),
(12, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241101-71321', '1730514263_ab3a2d59dc799d344ebd.jpg', 'TIdak bisa nyala', '1', '2024-11-02 09:24:23', '2024-11-02 09:25:34'),
(13, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241101-71321', '1730514334_d6e3f519c5be7549aed1.jpg', 'asdasd', '1', '2024-11-02 09:25:34', '2024-11-02 09:25:34'),
(14, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241103-14324', '1730614928_8eff8ca46eb353ce3017.jpg', 'Rusak Barange', '2', '2024-11-03 13:22:08', '2024-11-03 13:22:08'),
(15, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241103-14324', '', 'sad', '2', '2024-11-03 13:27:46', '2024-11-03 13:27:46'),
(16, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241103-14324', '', 'asd', '1', '2024-11-03 13:42:47', '2024-11-03 13:42:47'),
(17, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241103-14324', '', 'asd', '2', '2024-11-03 13:56:35', '2024-11-03 13:56:35'),
(18, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241103-14324', '', 'asd', '1', '2024-11-03 13:57:34', '2024-11-03 13:57:34'),
(19, '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', 'BRG-20241103-14324', '', 'sadasd', '2', '2024-11-03 13:59:30', '2024-11-03 13:59:30'),
(20, '6f416504-27d9-42fc-8b96-dd23aba4e31b', 'BRG-20241103-14324', '1730808663_64bb19200836d53a4373.png', 'asd', '2', '2024-11-05 19:11:03', '2024-11-05 19:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `nama_ruangan` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `status_ruangan` enum('0','1') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `status_ruangan`, `created_at`, `updated_at`) VALUES
('90b22530-2073-45a7-abcf-aa1cf196f45a', 'Tata Usaha', '1', '2024-10-10 14:57:55', '2024-10-10 14:57:55'),
('be973a26-a9f0-40b3-a627-ffd42a8fd1f5', 'LAB. Komp. B', '1', '2024-10-25 23:46:04', '2024-10-25 23:46:04'),
('c5a435c6-6fcb-4c70-acc2-05680d7c91ed', 'LAB. Bahasa', '1', '2024-10-25 23:46:07', '2024-10-25 23:46:07'),
('e7301de4-fe7e-4f57-8708-6cddd9b69784', 'LAB. Komp. A', '1', '2024-10-25 23:46:00', '2024-10-25 23:46:00'),
('fbd482f1-4ce0-4816-9488-152fa5ea6cfd', 'Kepala Sekolah', '1', '2024-11-01 16:32:52', '2025-02-11 20:36:21'),
('fcd35c83-7a72-46d3-976e-3bdc89864b4d', 'LAB. Komp. C', '1', '2024-10-25 23:45:56', '2024-10-25 23:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int NOT NULL,
  `nama_satuan` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `status_satuan` enum('0','1') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `status_satuan`, `created_at`, `updated_at`) VALUES
(3, 'RIM', '1', '2024-09-11 13:20:55', '2024-09-11 13:20:55'),
(4, 'PCS', '1', '2024-09-12 10:45:06', '2024-09-12 10:45:06'),
(5, 'BIJI', '1', '2024-09-12 10:45:12', '2024-10-27 12:08:11'),
(6, 'PAKET', '1', '2024-09-12 10:45:17', '2024-09-12 10:45:17'),
(7, 'LUSIN', '1', '2024-09-12 10:45:28', '2024-09-12 10:45:28'),
(8, 'PACK', '1', '2024-09-12 10:45:34', '2024-09-12 10:45:34'),
(10, 'SET', '1', '2024-09-15 21:02:56', '2024-09-15 21:02:56'),
(11, 'BUAH', '1', '2024-09-15 21:04:22', '2024-09-15 21:04:22'),
(15, 'BOX', '1', '2024-11-01 17:16:38', '2024-11-01 17:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_barang`
--

CREATE TABLE `tipe_barang` (
  `id_tipe_barang` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_barang` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_satuan` int NOT NULL,
  `nama_tipe_barang` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status_tipe_barang` enum('0','1') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tipe_barang`
--

INSERT INTO `tipe_barang` (`id_tipe_barang`, `id_barang`, `id_satuan`, `nama_tipe_barang`, `status_tipe_barang`, `created_at`, `updated_at`) VALUES
('0bfd54da-3d08-4a79-9d73-c6ff3a46d7a6', 'ATK-20241102-511', 4, 'Folio', '1', '2024-11-02 08:45:54', '2024-11-02 08:45:54'),
('1468354b-03ff-498f-b8f1-62c4f8bcaa8d', 'ATK-20241101-156', 15, 'Sedang', '1', '2024-11-01 17:39:15', '2024-11-01 17:39:15'),
('1c48c782-7573-4a16-9d57-3ca14d2da148', 'ATK-20241101-874', 4, '0.5', '1', '2024-11-01 17:18:12', '2024-11-01 17:18:12'),
('1dba0446-6590-4f43-bc41-7b58a52a4b4e', 'ATK-20241101-432', 4, 'AA', '1', '2024-11-01 17:17:46', '2024-11-01 17:17:46'),
('2bdbe221-4de3-4df8-a18d-cf0a4f90f103', 'ATK-20241101-665', 6, 'Kecil', '1', '2024-11-01 17:24:18', '2024-11-01 17:25:30'),
('2f5c4798-cf16-4b1f-8704-72fed324ad06', 'INV-20241101-922', 4, 'Sekolah', '1', '2024-11-01 17:40:28', '2024-11-01 17:40:28'),
('32fa3f04-9f56-43f3-8e06-8514cc613f6d', 'ATK-20241101-665', 6, 'Sedang', '1', '2024-11-01 17:25:13', '2024-11-01 17:25:13'),
('3a8b773c-8f49-42d4-b4c0-130442b8b009', 'ATK-20241101-432', 4, 'AAA', '1', '2024-11-01 16:23:38', '2024-11-01 16:23:38'),
('541de5df-926e-49e9-82e7-7fd1ea24a8b6', 'ATK-20241101-373', 4, 'White Board', '1', '2024-11-01 17:23:04', '2024-11-01 17:23:04'),
('55952521-e6cc-43a1-9771-59be80ce6091', 'ATK-20241101-373', 4, 'Permanent', '1', '2024-11-01 17:22:55', '2024-11-01 17:23:11'),
('65757304-5ede-41b7-b995-aad2032b3ba8', 'ATK-20241101-431', 4, 'Kecil', '1', '2024-11-01 17:22:10', '2024-11-01 17:22:10'),
('743b6c63-a5b1-40f1-9d04-1c960d24a052', 'ATK-20241101-930', 4, '2B', '1', '2024-11-01 17:19:21', '2024-11-01 17:19:21'),
('74b84e4f-7997-4266-b223-ded814a25c3c', 'INV-20241010-847', 11, 'Meja Kayu', '1', '2024-10-10 14:57:20', '2024-10-10 14:57:33'),
('89bef369-23f0-4261-b0ab-34c29ff18797', 'ATK-20241101-156', 15, 'Kecil', '1', '2024-11-01 17:39:25', '2024-11-01 17:39:25'),
('927f0949-8262-4ded-9b16-06e69ac6d8ba', 'ATK-20241101-156', 15, 'Besar', '1', '2024-11-01 17:39:35', '2024-11-01 17:39:35'),
('95b2a99d-1ffb-4f50-8028-17a7665ae953', 'INV-20241010-847', 5, 'Meja Stainlis', '1', '2024-10-12 08:40:30', '2024-10-12 08:40:30'),
('9af56fc0-48f3-44d1-a992-e93a4a2838ea', 'ATK-20241101-874', 4, '1', '1', '2024-11-01 17:18:05', '2024-11-01 17:18:05'),
('9e53561e-23bc-44f1-af42-e298eda67418', 'ATK-20241101-753', 11, 'Sedang', '1', '2024-11-01 17:27:08', '2024-11-01 17:27:08'),
('adc25fc1-2e6f-4bf6-8c0c-29fe80eda9a9', 'ATK-20241010-850', 3, '80s', '1', '2024-10-10 08:53:40', '2024-10-10 08:53:40'),
('b4091dc2-838b-456e-98e3-f13c2f9aede4', 'ATK-20241010-850', 3, '70s', '1', '2024-10-10 08:53:47', '2024-10-12 08:38:34'),
('b8eca239-7aab-4799-8e09-77a94209a353', 'ATK-20241101-753', 11, 'Besar', '1', '2024-11-01 17:27:01', '2024-11-01 17:27:01'),
('c7ab5ab5-df68-4793-b098-2e6721fb64e4', 'INV-20241025-586', 10, 'All In One(AIO)', '1', '2024-10-25 23:45:56', '2024-10-25 23:45:56'),
('cb007d6b-854d-418e-a5af-fe54a4260394', 'INV-20241101-922', 4, 'Warna', '1', '2024-11-01 17:40:40', '2024-11-01 17:40:40'),
('e2b0fb81-71b1-4b77-ac87-0cf3329e6330', 'ATK-20241101-665', 6, 'Besar', '1', '2024-11-01 17:25:40', '2024-11-01 17:25:40'),
('e37e585f-057c-4a1e-a3e7-b2e1575e2a91', 'INV-20241025-586', 10, 'Personal Computer (PC)', '1', '2024-10-25 23:46:00', '2024-10-25 23:46:00'),
('fecee1f2-5d04-43a3-940f-89ee14c49fd1', 'INV-20241010-847', 10, 'Meja Tamu', '1', '2024-10-12 08:40:49', '2024-10-12 08:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_user` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `tipe_transaksi` enum('0','1') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `ket_transaksi` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status_transaksi` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `tanggal_transaksi` date NOT NULL,
  `tgl_disetujui` date DEFAULT NULL,
  `tgl_pengadaan` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `tipe_transaksi`, `ket_transaksi`, `status_transaksi`, `tanggal_transaksi`, `tgl_disetujui`, `tgl_pengadaan`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
('0722fd45-1348-478c-98f4-df785a40e35a', '6f416504-27d9-42fc-8b96-dd23aba4e31b', '0', 'Kebutuhan TU', '4', '2024-11-15', '2025-08-02', '2025-08-02', '2025-08-02', '2024-11-15 14:08:08', '2025-08-02 21:13:19'),
('2057bb01-6596-4044-a540-c8913641451f', '6f416504-27d9-42fc-8b96-dd23aba4e31b', '0', 'Keperluan POPDA', '4', '2024-10-12', '2024-10-12', '2024-10-12', '2024-10-12', '2024-10-12 08:39:07', '2024-10-12 09:30:26'),
('3d091dd0-d4ec-4177-b007-045ab0d5a8a0', '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', '1', 'Untuk  Keperluan Waka', '4', '2024-11-01', '2024-10-12', '2024-10-12', '2024-10-12', '2024-11-01 17:54:09', '2024-11-01 17:55:01'),
('43375657-e723-4d13-9a90-f4a44a525efe', '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', '1', 'asd', '4', '2024-11-11', NULL, NULL, '2024-11-11', '2024-11-11 20:04:43', '2024-11-11 20:04:53'),
('5a59d7d4-e201-4f8c-809f-ff5bfecf012c', '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', '1', 'asd', '1', '2024-11-04', NULL, NULL, NULL, '2024-11-04 21:22:59', '2024-11-04 21:22:59'),
('6259b43c-1705-4d71-9b72-fbb3eb49637e', '6f416504-27d9-42fc-8b96-dd23aba4e31b', '0', 'Untuk Keperluan Arsip Dokumen', '4', '2024-11-02', '2024-10-12', '2024-10-12', '2024-10-12', '2024-11-02 09:05:04', '2024-11-02 09:14:42'),
('6be0bc8b-f8ca-498f-bf0e-8a79ae8aeeee', 'fe826a1a-91ff-43a6-9442-330565e33bfc', '1', 'Keperluan TPG', '4', '2024-10-12', NULL, NULL, '2024-11-04', '2024-10-12 09:23:39', '2024-11-04 21:18:11'),
('6e25506b-64ca-4e5e-872b-7207de8e72fc', '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', '1', 'asdasd', '1', '2024-11-04', NULL, NULL, NULL, '2024-11-04 21:20:18', '2024-11-04 21:20:18'),
('7d50c144-20ac-4755-a868-49cf8508061f', '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', '1', 'Untuk Ruang Kepala Sekolah', '4', '2024-11-01', '2024-10-12', '2024-10-12', '2024-10-12', '2024-11-01 17:57:42', '2024-11-01 17:58:10'),
('b6bfba13-6b1e-4b69-91d0-b7c5201a94ac', '1c00c4ae-d288-4d42-a509-dff168ac2175', '1', 'Keperluan Pernyusunan Laporan', '4', '2024-10-12', '2024-10-12', '2024-10-12', '2024-10-12', '2024-10-12 09:22:43', '2024-10-12 09:23:08'),
('bc1adaea-1516-4a0c-8344-e05a2d98036d', '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', '1', 'Untuk keperluan kepegawaian1', '4', '2024-10-12', '2024-10-12', '2024-10-12', '2024-10-12', '2024-10-12 11:31:43', '2024-10-12 11:51:20'),
('c6bbedc2-14af-4a75-9848-be39f077d941', '6f416504-27d9-42fc-8b96-dd23aba4e31b', '0', 'sad', '4', '2024-11-04', '2024-11-04', '2024-11-04', '2024-11-04', '2024-11-04 20:44:59', '2024-11-04 21:15:08'),
('cd13a34a-d383-41d6-a6d2-521a33724969', '6f416504-27d9-42fc-8b96-dd23aba4e31b', '0', 'Untuk TU', '3', '2024-11-13', '2024-11-13', '2024-11-13', NULL, '2024-11-13 10:37:15', '2024-11-13 10:40:50'),
('d263fa20-65cb-476c-9dbc-ed5a54e7afce', '6f416504-27d9-42fc-8b96-dd23aba4e31b', '0', 'Sudah Limit', '4', '2024-11-01', '2024-10-12', '2024-10-12', '2024-10-12', '2024-11-01 18:00:03', '2024-11-01 18:10:46'),
('ec49bcd3-4b28-4fe5-83ed-43543380072a', '7d23ecd0-36d4-4dcd-8765-2a64c98cc836', '1', 'Keperluan POPDA', '4', '2024-10-12', '2024-10-12', '2024-10-12', '2024-10-12', '2024-10-12 09:21:56', '2024-10-12 09:22:17'),
('ed4d17c5-df3f-408a-a1f3-9dee5684ae56', '4a53e50a-0be7-448a-9bbf-fdfe8fed4525', '1', 'asdasd', '1', '2024-11-04', NULL, NULL, NULL, '2024-11-04 21:20:39', '2024-11-04 21:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` char(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `nama_user` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status_user` enum('0','1') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `nama_user`, `status_user`, `last_login`, `created_at`, `updated_at`) VALUES
('1c00c4ae-d288-4d42-a509-dff168ac2175', 'petugas_bos', '$2y$10$kBtCDOWJi1GiebsFcVvVjO6N.QQEysYr3V6BT3hD7QJud59d6.opm', 'Petugas BOS', 'sutopik', '0', '2025-08-02 21:12:21', '2024-09-20 08:11:58', '2025-08-02 21:12:21'),
('4a53e50a-0be7-448a-9bbf-fdfe8fed4525', 'kepala_tu', '$2y$10$9M9SrTtlgy9QIgKoQhsJKu7XyCB7tHhvZl4Iq8woTi1BOPhatixL.', 'KA. TU', 'Selamet Riyanto', '0', '2025-08-02 21:11:46', '2024-09-20 08:12:28', '2025-08-02 21:11:46'),
('6dcfcc29-758f-450b-9a5a-5381608db711', 'adi', '$2y$10$tVOZaCmzwhOcecIXBihhbeG073XDVbDIiIdQhIrPVE7czc7SuFVSu', 'Admin', 'Alam', '0', NULL, '2024-11-02 09:32:04', '2024-11-02 09:32:04'),
('6f416504-27d9-42fc-8b96-dd23aba4e31b', 'admin', '$2y$10$5GLstJFPZub35SzPHEkyqOrqBO7oEmNRGUgL9XHacq9I3aGhEjwza', 'Admin', 'admin', '0', '2025-08-02 21:13:02', '2024-09-11 13:00:08', '2025-08-02 21:13:02'),
('7d23ecd0-36d4-4dcd-8765-2a64c98cc836', 'dinda', '$2y$10$oMI1LhIoUAvKfWbvHaa6C.ZMo4sB8IUkqVWBy5BYG4gYFIr8sar.O', 'Pegawai', 'dinda', '0', '2025-08-02 21:14:03', '2024-09-21 19:30:47', '2025-08-02 21:14:03'),
('b6a33a1d-19fe-45d7-9d4c-0d71b736ce19', 'kepsek', '$2y$10$GSgMy.mEwcUyEEXWqYJpXue3vUjzOFhdIz0jBp6iktSjfM2SYV6Ty', 'Kepala Sekolah', 'Abdur Rozak', '0', '2025-08-02 21:13:37', '2024-09-20 08:12:45', '2025-08-02 21:13:37'),
('fe826a1a-91ff-43a6-9442-330565e33bfc', 'alam', '$2y$10$R5IL7yO49yMpzYFdZqu6W.caTzRWboCUTGPfFlAQ7ObQc0asiK1jW', 'Admin', 'alam', '0', '2024-11-04 21:18:21', '2024-09-12 00:56:39', '2024-11-04 21:18:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atk`
--
ALTER TABLE `atk`
  ADD PRIMARY KEY (`id_atk`) USING BTREE,
  ADD KEY `FK_atk_atk` (`id_tipe_barang`) USING BTREE;

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`) USING BTREE;

--
-- Indexes for table `detail_pengadaan`
--
ALTER TABLE `detail_pengadaan`
  ADD PRIMARY KEY (`id_detail_pengadaan`),
  ADD KEY `FK__pengadaan` (`id_pengadaan`),
  ADD KEY `FK_detail_pengadaan_tipe_barang` (`id_tipe_barang`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`) USING BTREE,
  ADD KEY `FK_detail_transaksi_atk` (`id_atk`),
  ADD KEY `FK_detail_transaksi_transaksi` (`id_transaksi`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_inventaris`) USING BTREE,
  ADD KEY `FK_inventaris_tipe_barang` (`id_tipe_barang`),
  ADD KEY `inventaris_ibfk_1` (`id_ruangan`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `penerima_notifikasi` (`penerima_notifikasi`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`),
  ADD KEY `FK_pengadaan_users` (`id_user`);

--
-- Indexes for table `pengecekan`
--
ALTER TABLE `pengecekan`
  ADD PRIMARY KEY (`id_pengecekan`),
  ADD KEY `FK_pengecekan_users` (`id_user`),
  ADD KEY `pengecekan_ibfk_1` (`id_inventaris`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`) USING BTREE;

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`) USING BTREE;

--
-- Indexes for table `tipe_barang`
--
ALTER TABLE `tipe_barang`
  ADD PRIMARY KEY (`id_tipe_barang`),
  ADD KEY `FK_tipe_barang_barang` (`id_barang`),
  ADD KEY `FK_tipe_barang_satuan` (`id_satuan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`) USING BTREE,
  ADD KEY `FK_transaksi_users` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pengadaan`
--
ALTER TABLE `detail_pengadaan`
  MODIFY `id_detail_pengadaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengecekan`
--
ALTER TABLE `pengecekan`
  MODIFY `id_pengecekan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atk`
--
ALTER TABLE `atk`
  ADD CONSTRAINT `FK_atk_tipe_barang` FOREIGN KEY (`id_tipe_barang`) REFERENCES `tipe_barang` (`id_tipe_barang`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_pengadaan`
--
ALTER TABLE `detail_pengadaan`
  ADD CONSTRAINT `FK__pengadaan` FOREIGN KEY (`id_pengadaan`) REFERENCES `pengadaan` (`id_pengadaan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_detail_pengadaan_tipe_barang` FOREIGN KEY (`id_tipe_barang`) REFERENCES `tipe_barang` (`id_tipe_barang`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `FK_detail_transaksi_atk` FOREIGN KEY (`id_atk`) REFERENCES `atk` (`id_atk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_detail_transaksi_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON UPDATE CASCADE;

--
-- Constraints for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `FK_inventaris_tipe_barang` FOREIGN KEY (`id_tipe_barang`) REFERENCES `tipe_barang` (`id_tipe_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inventaris_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON UPDATE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`penerima_notifikasi`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD CONSTRAINT `FK_pengadaan_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `pengecekan`
--
ALTER TABLE `pengecekan`
  ADD CONSTRAINT `FK_pengecekan_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pengecekan_ibfk_1` FOREIGN KEY (`id_inventaris`) REFERENCES `inventaris` (`id_inventaris`) ON UPDATE CASCADE;

--
-- Constraints for table `tipe_barang`
--
ALTER TABLE `tipe_barang`
  ADD CONSTRAINT `FK_tipe_barang_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tipe_barang_satuan` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_transaksi_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
