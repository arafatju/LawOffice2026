-- phpMyAdmin SQL Dump
-- version 5.2.1deb1ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2024 at 03:16 PM
-- Server version: 8.0.37-0ubuntu0.23.10.2
-- PHP Version: 8.2.10-2ubuntu2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OTMS22`
--

-- --------------------------------------------------------

--
-- Table structure for table `codetable`
--

CREATE TABLE `codetable` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `codetable`
--

INSERT INTO `codetable` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(4, 'জেলা জজ', '1111', 'designation', NULL, NULL),
(5, 'অতিরিক্ত জেলা জজ', '1111', 'designation', NULL, NULL),
(6, 'যুগ্ম জেলা ও দায়রা জজ', '1111', 'designation', NULL, NULL),
(7, 'সহকারী জজ', '1111', 'designation', NULL, NULL),
(8, 'সিনিয়র সহকারী জজ', '1111', 'designation', NULL, NULL),
(9, 'সচিব', '1111', 'designation', NULL, NULL),
(10, 'যুগ্ম সচিব', '1111', 'designation', NULL, NULL),
(11, 'উপ সচিব', '1111', 'designation', NULL, NULL),
(12, 'সহকারী সচিব', '1111', 'designation', NULL, NULL),
(13, 'সিনিয়র সহকারী সচিব', '1111', 'designation', NULL, NULL),
(14, 'জেলা জজ আদালত', '999', 'economy', NULL, NULL),
(15, 'সিনিয়র জেলা ও দায়রা জজ', '1111', 'designation', NULL, NULL),
(16, 'যুগ্ম জেলা জজ', '1111', 'designation', NULL, NULL),
(17, 'জেলা লিগ্যাল এইড অফিসার', '1111', 'designation', NULL, NULL),
(18, 'জুডিসিয়াল ম্যাজিস্ট্রেট', '1111', 'designation', NULL, NULL),
(19, 'সিনিয়র জুডিসিয়াল ম্যাজিস্ট্রেট', '1111', 'designation', NULL, NULL),
(20, 'অতিরিক্ত চীফ জুডিসিয়াল ম্যাজিস্ট্রেট', '1111', 'designation', NULL, NULL),
(21, 'ম্যাজিস্ট্রেট', '1111', 'designation', NULL, NULL),
(22, 'বিচারক (জেলা জজ)', '1111', 'designation', NULL, NULL),
(23, 'সদস্য (জেলা জজ)', '1111', 'designation', NULL, NULL),
(24, 'চেয়ারম্যান (জেলা জজ)', '1111', 'designation', NULL, NULL),
(25, 'সিনিয়র জেলা ও দায়রা জজ', '1111', 'designation', NULL, NULL),
(26, 'অতিরিক্ত জেলা ও দায়রা জজ', '1111', 'designation', NULL, NULL),
(27, 'যুগ্ম মহানগর দায়রা জজ', '1111', 'designation', NULL, NULL),
(28, 'মহানগর দায়রা জজ', '1111', 'designation', NULL, NULL),
(29, 'অতিরিক্ত মহানগর দায়রা জজ', '1111', 'designation', NULL, NULL),
(30, 'চীফ মেট্রোপলিটন ম্যাজিস্ট্রেট', '1111', 'designation', NULL, NULL),
(31, 'অতিঃ চীফ মেট্রোপলিটন ম্যাজিস্ট্রেট', '1111', 'designation', NULL, NULL),
(32, 'মেট্রোপলিটন ম্যাজিস্ট্রেট', '1111', 'designation', NULL, NULL),
(33, 'স্পেশাল ম্যাজিস্ট্রেট', '1111', 'designation', NULL, NULL),
(34, 'সদস্য (সিনিয়র জেলা জজ)', '1111', 'designation', NULL, NULL),
(35, 'বিভাগীয় স্পেশাল জজ (জেলা জজ)', '1111', 'designation', NULL, NULL),
(36, 'জেলা ও দায়রা জজ আদালত', '999', 'economy', NULL, NULL),
(37, 'অতিরিক্ত জেলা ও দায়রা জজ আদালত', '999', 'economy', NULL, NULL),
(38, 'যুগ্ম  জেলা ও দায়রা জজ আদালত', '999', 'economy', NULL, NULL),
(39, 'ল্যান্ড সার্ভে ট্রাইব্যুনাল', '999', 'economy', NULL, NULL),
(40, 'অর্থঋণ আদালত', '999', 'economy', NULL, NULL),
(41, 'সিনিয়র সহকারী জজ আদালত', '999', 'economy', NULL, NULL),
(42, 'সহকারী জজ আদালত', '999', 'economy', NULL, NULL),
(43, 'জেলা লিগ্যাল এইড', '999', 'economy', NULL, NULL),
(44, 'চীফ জুডিসিয়াল ম্যাজিস্ট্রেট আদালত', '999', 'economy', NULL, NULL),
(45, 'অতিরিক্ত চীফ জুডিসিয়াল ম্যাজিস্ট্রেট আদালত', '999', 'economy', NULL, NULL),
(46, 'বিদ্যুৎ কোর্ট', '999', 'economy', NULL, NULL),
(47, 'সিনিয়র জুডিসিয়াল ম্যাজিস্ট্রেট আদালত', '999', 'economy', NULL, NULL),
(48, 'বন আদালত ও দ্রুত বিচার আদালত', '999', 'economy', NULL, NULL),
(49, 'জুডিসিয়াল ম্যাজিস্ট্রেট আদালত', '999', 'economy', NULL, NULL),
(50, 'আইন ও বিচার বিভাগ', '999', 'economy', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codetable`
--
ALTER TABLE `codetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codetable`
--
ALTER TABLE `codetable`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
