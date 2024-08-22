-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2024 at 02:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `auditable_type` varchar(255) NOT NULL,
  `auditable_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` text DEFAULT NULL,
  `new_values` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(1023) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audits`
--

INSERT INTO `audits` (`id`, `user_type`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `tags`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Buku', 6, '{\"stok\":3}', '{\"stok\":2}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:08:06', '2024-07-31 08:08:06'),
(2, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Buku', 7, '{\"stok\":3}', '{\"stok\":2}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:08:06', '2024-07-31 08:08:06'),
(3, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Peminjaman', 3, '{\"petugas_pinjam\":null,\"status\":1}', '{\"petugas_pinjam\":1,\"status\":2}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:08:06', '2024-07-31 08:08:06'),
(4, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Buku', 6, '{\"stok\":2}', '{\"stok\":3}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:08:08', '2024-07-31 08:08:08'),
(5, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Buku', 7, '{\"stok\":2}', '{\"stok\":3}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:08:08', '2024-07-31 08:08:08'),
(6, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Peminjaman', 3, '{\"petugas_kembali\":null,\"status\":2,\"denda\":null,\"tanggal_pengembalian\":null}', '{\"petugas_kembali\":1,\"status\":3,\"denda\":5000,\"tanggal_pengembalian\":\"2024-07-30T17:00:00.000000Z\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:08:08', '2024-07-31 08:08:08'),
(7, 'App\\Models\\User', 4, 'created', 'App\\Models\\Peminjaman', 5, '[]', '{\"kode_pinjam\":667644676,\"peminjam_id\":4,\"status\":0}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:57:21', '2024-07-31 08:57:21'),
(8, 'App\\Models\\User', 4, 'created', 'App\\Models\\DetailPeminjaman', 8, '[]', '{\"peminjaman_id\":5,\"buku_id\":15}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:57:21', '2024-07-31 08:57:21'),
(9, 'App\\Models\\User', 4, 'updated', 'App\\Models\\Peminjaman', 5, '{\"status\":0,\"tanggal_pinjam\":null,\"tanggal_kembali\":null}', '{\"status\":1,\"tanggal_pinjam\":\"2024-07-31\",\"tanggal_kembali\":\"2024-08-09T17:00:00.000000Z\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:57:54', '2024-07-31 08:57:54'),
(10, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Buku', 15, '{\"stok\":2}', '{\"stok\":1}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:58:18', '2024-07-31 08:58:18'),
(11, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Peminjaman', 5, '{\"petugas_pinjam\":null,\"status\":1}', '{\"petugas_pinjam\":1,\"status\":2}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:58:18', '2024-07-31 08:58:18'),
(12, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Buku', 15, '{\"stok\":1}', '{\"stok\":2}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:58:22', '2024-07-31 08:58:22'),
(13, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Peminjaman', 5, '{\"petugas_kembali\":null,\"status\":2,\"denda\":null,\"tanggal_pengembalian\":null}', '{\"petugas_kembali\":1,\"status\":3,\"denda\":0,\"tanggal_pengembalian\":\"2024-07-30T17:00:00.000000Z\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 08:58:22', '2024-07-31 08:58:22'),
(14, 'App\\Models\\User', 1, 'created', 'App\\Models\\Kategori', 7, '[]', '{\"nama\":\"Tes123\",\"slug\":\"tes123\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:20:59', '2024-07-31 12:20:59'),
(15, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Kategori', 7, '{\"nama\":\"Tes123\",\"slug\":\"tes123\"}', '{\"nama\":\"Tes12\",\"slug\":\"tes12\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:21:06', '2024-07-31 12:21:06'),
(16, 'App\\Models\\User', 1, 'deleted', 'App\\Models\\Kategori', 7, '{\"nama\":\"Tes12\",\"slug\":\"tes12\"}', '[]', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:21:11', '2024-07-31 12:21:11'),
(17, 'App\\Models\\User', 1, 'created', 'App\\Models\\Rak', 10, '[]', '{\"rak\":\"1\",\"baris\":\"14\",\"slug\":\"1-14\",\"kategori_id\":\"3\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:21:32', '2024-07-31 12:21:32'),
(18, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Rak', 10, '{\"baris\":\"14\",\"slug\":\"1-14\"}', '{\"baris\":\"140\",\"slug\":\"1-140\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:21:38', '2024-07-31 12:21:38'),
(19, 'App\\Models\\User', 1, 'deleted', 'App\\Models\\Rak', 10, '{\"rak\":\"1\",\"baris\":\"140\",\"slug\":\"1-140\",\"kategori_id\":\"3\"}', '[]', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:21:43', '2024-07-31 12:21:43'),
(20, 'App\\Models\\User', 1, 'created', 'App\\Models\\Penerbit', 3, '[]', '{\"nama\":\"Hasah\",\"slug\":\"hasah\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:21:53', '2024-07-31 12:21:53'),
(21, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Penerbit', 3, '{\"nama\":\"Hasah\",\"slug\":\"hasah\"}', '{\"nama\":\"HASAN M\",\"slug\":\"hasan-m\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:21:59', '2024-07-31 12:21:59'),
(22, 'App\\Models\\User', 1, 'deleted', 'App\\Models\\Penerbit', 3, '{\"nama\":\"HASAN M\",\"slug\":\"hasan-m\"}', '[]', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:22:01', '2024-07-31 12:22:01'),
(23, 'App\\Models\\User', 1, 'created', 'App\\Models\\Buku', 18, '[]', '{\"judul\":\"Dsdasd\",\"slug\":\"dsdasd\",\"sampul\":\"oKQXGJNAYMSzJUmJkCzuwOs2K07oVuTOkONQS3z8.jpg\",\"penulis\":\"Dfd\",\"penerbit_id\":\"1\",\"kategori_id\":\"3\",\"rak_id\":\"1\",\"stok\":\"12\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:22:21', '2024-07-31 12:22:21'),
(24, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Buku', 18, '{\"sampul\":\"oKQXGJNAYMSzJUmJkCzuwOs2K07oVuTOkONQS3z8.jpg\",\"penulis\":\"Dfd\"}', '{\"sampul\":\"eYPf9YKzW5LDw8DLvrFzcIjAzIfkqMi29JAnZYM9.jpg\",\"penulis\":\"Dfd12\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:23:47', '2024-07-31 12:23:47'),
(25, 'App\\Models\\User', 1, 'updated', 'App\\Models\\Buku', 18, '{\"sampul\":\"eYPf9YKzW5LDw8DLvrFzcIjAzIfkqMi29JAnZYM9.jpg\"}', '{\"sampul\":\"Y0TlgoZxsi6mFegnWbFkINfe1Af5BLO9GhqaVFJD.jpg\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:23:59', '2024-07-31 12:23:59'),
(26, 'App\\Models\\User', 1, 'deleted', 'App\\Models\\Buku', 18, '{\"judul\":\"Dsdasd\",\"slug\":\"dsdasd\",\"sampul\":\"Y0TlgoZxsi6mFegnWbFkINfe1Af5BLO9GhqaVFJD.jpg\",\"penulis\":\"Dfd12\",\"penerbit_id\":1,\"kategori_id\":3,\"rak_id\":1,\"stok\":12}', '[]', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:24:05', '2024-07-31 12:24:05'),
(27, 'App\\Models\\User', 1, 'created', 'App\\Models\\User', 5, '[]', '{\"name\":\"Tes\",\"email\":\"tes123@gmail.com\",\"password\":\"$2y$12$eDwut5pQcSLKSWsJhRD2zOeaGgyX7pAoaPZEcGJSWle1iAw6p6Fn6\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:25:13', '2024-07-31 12:25:13'),
(28, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 5, '{\"password\":\"$2y$12$eDwut5pQcSLKSWsJhRD2zOeaGgyX7pAoaPZEcGJSWle1iAw6p6Fn6\"}', '{\"password\":\"$2y$12$\\/1AB3aySaCQVuMLK3D\\/zNOjCkR454HipvE3y.jAPswCyJjppMV24C\"}', 'http://127.0.0.1:8000/livewire/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', NULL, '2024-07-31 12:25:39', '2024-07-31 12:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sampul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `rak_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `slug`, `sampul`, `penulis`, `penerbit_id`, `kategori_id`, `rak_id`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'bintang kecil', 'bintang', 'eqpi1uLwsS25bgfYAkwQpHFvd3hWbxDEQU8dB0vd.png', 'penulis buku 2', 1, 1, 1, 10, '2024-07-06 04:45:23', '2024-07-06 04:53:33'),
(2, 'matahari', 'matahari', '3BvTrhkddkWzikeMmgPDAG9bE7N4JuQNvlpRXL8G.jpg', 'penulis buku 1', 1, 1, 1, 10, '2024-07-06 04:45:23', '2024-07-06 04:53:40'),
(4, 'Terjemahan Alfiyyah Syarah Ibnu Aqil', 'terjemahan-alfiyyah-syarah-ibnu-aqil', 'jOnQ80q9n5rrmZEVPqHMuKLe4qbC44uVHyMAIgXq.jpg', 'Bahauddin Abdullah Ibnu Aqil', 3, 8, 1, 10, '2024-07-06 06:44:21', '2024-07-06 06:44:21'),
(5, 'Safinatun Najah', 'safinatun-najah', 'kMFv3BiV2KbKLwXNDjteKPIP1urOB0uVXM8qAVjS.jpg', 'Syaikh Salim bin Abdullah bin Sa\'ad bin ', 4, 9, 1, 3, '2024-07-06 06:48:18', '2024-07-06 06:48:18'),
(6, 'Ringkasan Fikih Sunnah', 'ringkasan-fikih-sunnah', 'JMomlyIQpuxpzgh5SJvsj1DxExMIzsWMCGo9VlzB.jpg', 'Sayyid Sabiq', 5, 10, 1, 3, '2024-07-06 06:50:01', '2024-07-31 08:08:08'),
(7, 'Tafsir Ayat-Ayat Ahkam', 'tafsir-ayat-ayat-ahkam', 'pH778EGrOJNO4guisSD5damAIe1fqXTpoLrs7VZO.jpg', 'Syekh Muhammad Ali Ash-Shabuni', 6, 11, 1, 3, '2024-07-06 06:51:27', '2024-07-31 08:08:08'),
(8, 'Riyadhus Shalihin', 'riyadhus-shalihin', 'Nh4Oe2XR1Carz9DZBigu6bLLk3jsCH5k5yeyj3t3.jpg', 'Imam An-Nawawi', 7, 12, 1, 5, '2024-07-06 06:55:14', '2024-07-06 06:55:14'),
(9, 'Dasar Pemrograman Web Dinamis Menggunakan PHP', 'dasar-pemrograman-web-dinamis-menggunakan-php', '5qeHNGoViSCGumRZ1S3p1QTaeM2iYXcN9x5cObM4.jpg', 'Abdul Kadir', 8, 13, 1, 3, '2024-07-06 06:59:02', '2024-07-06 06:59:02'),
(10, 'Pemrograman Android ', 'pemrograman-android', 'JKclozCGf884QcqJgYTNeCQ3gAAHMSen2a3wzLj6.jpg', 'Budi Raharjo', 9, 14, 1, 5, '2024-07-06 07:03:19', '2024-07-06 07:03:19'),
(11, '14 Jam Belajar Cepat Internet Of Things (IOT)', '14-jam-belajar-cepat-internet-of-things-iot', 'ynEqstGnbqwSG9EcpmbrJdxpDH2Fsb6SwhjGWOtF.jpg', 'Dr. Setiawardhana, S.T., M.T., Dr. Eng. Hary Oktavianto, Ir. Sigit Wasista, ', 10, 15, 1, 5, '2024-07-06 07:05:38', '2024-07-06 07:05:38'),
(12, 'Aplikasi Internet of Things (IoT) dengan Arduino dan Android', 'aplikasi-internet-of-things-iot-dengan-arduino-dan-android', 'zMBzkK2VuqYjd37XHN8vSIohrDa8Ca6qNtuZUNWD.jpg', 'Sigit Wasista, Setiawardhana,Delima Ayu Saraswati', 11, 16, 1, 5, '2024-07-06 07:07:56', '2024-07-06 07:07:56'),
(13, 'Mudah Menguasai Framework Laravel', 'mudah-menguasai-framework-laravel', 'SFm0Q4Ggosfco7gpOO7nMVb03AUhppMzmlkKftuq.jpg', 'Yudho Yudhanto dan Helmi Adi Prasetyo', 12, 17, 1, 5, '2024-07-06 07:09:26', '2024-07-06 07:09:26'),
(14, 'Tafsir Jalalain', 'tafsir-jalalain', 'kbeVpkvpa9wUx01EEPx9rfGFKrDYpvjsUr9j8jRY.png', 'Imam Jalaluddin al-Mahalli Imam Jalaluddin al-Mahalli ', 13, 18, 2, 3, '2024-07-06 07:13:46', '2024-07-06 07:13:46'),
(15, 'Belajar Otodidak MySQL(Teknik Pembuatan dan Pengelolaan Database)', 'belajar-otodidak-mysqlteknik-pembuatan-dan-pengelolaan-database', 'shP39ZIjyj4ZSrETmBc55QahmPsPmPmOxtghvQLB.jpg', 'Budy Raharjo', 14, 19, 2, 2, '2024-07-06 07:15:43', '2024-07-31 08:58:22'),
(16, 'Tuntunan Praktis Belajar Database Menggunakan MySQL', 'tuntunan-praktis-belajar-database-menggunakan-mysql', 'Infj8LKTqVRWkoKC8tuAKbLE45EvWW9Sl8c89Now.jpg', 'Abdul Kadir', 15, 20, 2, 3, '2024-07-06 07:16:55', '2024-07-06 07:16:55'),
(17, 'Menguasai Angular JS untuk Membuat Website Dinamis', 'menguasai-angular-js-untuk-membuat-website-dinamis', '7IJJTCeqSUsumetJFwGeMW3EdN8YRppn1Rb2lzP1.jpg', 'Lutfi Gani', 16, 21, 2, 5, '2024-07-06 07:18:46', '2024-07-06 07:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1722428686),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1722428686;', 1722428686);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `peminjaman_id`, `buku_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-07-06 04:45:23', '2024-07-06 04:45:23'),
(2, 1, 2, '2024-07-06 04:45:23', '2024-07-06 04:45:23'),
(3, 2, 4, '2024-07-06 04:45:23', '2024-07-06 04:45:23'),
(4, 2, 5, '2024-07-06 04:45:23', '2024-07-06 04:45:23'),
(5, 3, 6, '2024-07-06 04:45:23', '2024-07-06 04:45:23'),
(6, 3, 7, '2024-07-06 04:45:23', '2024-07-06 04:45:23'),
(7, 4, 3, '2024-07-06 04:45:23', '2024-07-06 04:45:23'),
(8, 5, 15, '2024-07-31 08:57:21', '2024-07-31 08:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'None', 'none', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(2, 'Novel', 'novel', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(3, 'Sejarah', 'sejarah', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(4, 'Religi', 'religi', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(5, 'Biografi', 'biografi', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(6, 'Komik', 'komik', '2024-07-29 02:11:06', '2024-07-29 02:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '0001_01_01_000000_create_users_table', 1),
(16, '0001_01_01_000001_create_cache_table', 1),
(17, '0001_01_01_000002_create_jobs_table', 1),
(18, '2024_06_27_143051_create_permission_tables', 1),
(19, '2024_06_27_144017_create_kategori_table', 1),
(20, '2024_06_27_144651_create_rak_table', 1),
(21, '2024_06_27_144756_create_penerbit_table', 1),
(22, '2024_06_27_144830_create_buku_table', 1),
(23, '2024_07_04_093756_create_peminjaman_table', 1),
(24, '2024_07_04_093839_create_detail_peminjaman_table', 1),
(25, '2024_07_08_144842_create_activity_log_table', 1),
(26, '2024_07_08_144843_add_event_column_to_activity_log_table', 1),
(27, '2024_07_08_144844_add_batch_uuid_column_to_activity_log_table', 1),
(28, '2024_07_09_033353_create_audits_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_pinjam` varchar(255) NOT NULL,
  `peminjam_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_pinjam` bigint(20) UNSIGNED DEFAULT NULL,
  `petugas_kembali` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `kode_pinjam`, `peminjam_id`, `petugas_pinjam`, `petugas_kembali`, `status`, `denda`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_pengembalian`, `created_at`, `updated_at`) VALUES
(1, '816398440', 19, 18, 18, 3, 0, '2024-06-16', '2024-06-26', '2024-07-01', '2024-07-06 04:45:23', '2024-07-06 04:45:23'),
(2, '612420154', 19, 7, NULL, 7, NULL, '2024-07-06', '2024-07-16', NULL, '2024-07-06 04:45:23', '2024-07-06 04:45:23'),
(3, '159659914', 4, 1, 1, 3, 5000, '2024-07-16', '2024-07-26', '2024-07-31', '2024-07-06 04:45:23', '2024-07-31 08:08:08'),
(4, '980531372', 5, NULL, NULL, 0, NULL, NULL, NULL, NULL, '2024-07-06 04:45:23', '2024-07-06 04:45:23'),
(5, '667644676', 4, 1, 1, 3, 0, '2024-07-31', '2024-08-10', '2024-07-31', '2024-07-31 08:57:21', '2024-07-31 08:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Gramedia', 'gramedia', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(2, 'Erlangga', 'erlangga', '2024-07-29 02:11:06', '2024-07-29 02:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rak` varchar(255) NOT NULL,
  `baris` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `kategori_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id`, `rak`, `baris`, `slug`, `kategori_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1-1', '1', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(2, '1', '2', '1-2', '1', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(3, '1', '3', '1-3', '1', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(4, '1', '4', '1-4', '1', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(5, '1', '5', '1-5', '1', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(6, '1', '6', '1-6', '1', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(7, '1', '7', '1-7', '1', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(8, '1', '8', '1-8', '1', '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(9, '1', '9', '1-9', '1', '2024-07-29 02:11:06', '2024-07-29 02:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-07-29 02:11:05', '2024-07-29 02:11:05'),
(2, 'petugas', 'web', '2024-07-29 02:11:05', '2024-07-29 02:11:05'),
(3, 'peminjam', 'web', '2024-07-29 02:11:05', '2024-07-29 02:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('YAssocdw6g0BBwgVhRk4BT0YDk30p80GjAhKwUhk', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidE5Pc2dFNFhZVHo4bmVNQVVXYXhhWVJhU3ZQVFRWenUxSHJwRHhVTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTcyMjQyODc2Mjt9fQ==', 1722429550);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` varchar(50) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator123', 'administrator123@gmail.com', NULL, '2024-07-29 02:11:05', '$2y$12$fum1OR38s4hhOTRdjtF2QeGORfbxEgXupUon.XHhrJwgYi9Jq5ucm', NULL, '2024-07-29 02:11:05', '2024-07-29 02:11:05'),
(2, 'Asatidz123', 'asatidz123@gmail.com', NULL, '2024-07-29 02:11:06', '$2y$12$k14ho7r5RhK/sG7NbNL/AuhpAgwONM9Mz7dNMBSjWpUZBw.7DZs/K', NULL, '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(3, 'Mahasantri123', 'mahasantri123@gmail.com', NULL, '2024-07-29 02:11:06', '$2y$12$iZ8XmH33ZrNEKOxiCA7roeo02nSOuwAWAS6JouM7AdHi2Glp2is8S', NULL, '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(4, 'Peminjam123', 'peminjam123@gmail.com', NULL, '2024-07-29 02:11:06', '$2y$12$VwrweqG/FOR2JEJEzbtduulbzunC2zhLZPyRFqTR//ZLg/Ay.55VK', NULL, '2024-07-29 02:11:06', '2024-07-29 02:11:06'),
(5, 'Tes', 'tes123@gmail.com', NULL, NULL, '$2y$12$/1AB3aySaCQVuMLK3D/zNOjCkR454HipvE3y.jAPswCyJjppMV24C', NULL, '2024-07-31 12:25:13', '2024-07-31 12:25:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  ADD KEY `audits_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
