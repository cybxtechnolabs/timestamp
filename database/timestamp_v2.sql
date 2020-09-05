-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2020 at 04:16 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timestamp_v2`
--
CREATE DATABASE IF NOT EXISTS `timestamp_v2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `timestamp_v2`;

-- --------------------------------------------------------

--
-- Table structure for table `biometrics`
--

CREATE TABLE `biometrics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temperature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_direction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ic_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biometrics` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bulk`
--

CREATE TABLE `bulk` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `employee` varchar(200) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bulk`
--

INSERT INTO `bulk` (`id`, `name`, `employee`, `updated_at`, `created_at`) VALUES
(46, 'test', 'sdsd', '2020-09-03', '2020-09-03'),
(47, 'user', 'sdd', '2020-09-03', '2020-09-03'),
(48, '222', 'sdsd', '2020-09-03', '2020-09-03'),
(49, 'dsfdf', 'sdsd', '2020-09-03', '2020-09-03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `import`
--

CREATE TABLE `import` (
  `id` int(20) NOT NULL,
  `imported_by` int(10) NOT NULL,
  `snap_photo` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `staff` varchar(200) DEFAULT NULL,
  `body_temperature` varchar(200) DEFAULT NULL,
  `pass_status` varchar(200) DEFAULT NULL,
  `device_name` varchar(200) DEFAULT NULL,
  `access_direction` varchar(200) DEFAULT NULL,
  `creation_date` varchar(200) DEFAULT NULL,
  `creation_time` varchar(200) DEFAULT NULL,
  `id_card` varchar(200) DEFAULT NULL,
  `ic_card` varchar(200) DEFAULT NULL,
  `personner_id` varchar(200) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `import`
--

INSERT INTO `import` (`id`, `imported_by`, `snap_photo`, `name`, `staff`, `body_temperature`, `pass_status`, `device_name`, `access_direction`, `creation_date`, `creation_time`, `id_card`, `ic_card`, `personner_id`, `updated_at`, `created_at`) VALUES
(1123, 31, 'image', 'Dwight', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:30:55', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1124, 31, 'image', 'Andy', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:30:48', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1125, 31, 'image', 'Jim', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:30:23', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1126, 31, 'image', 'Jim', 'Employee', '97.7', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:30:06', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1127, 31, 'image', 'Dwight', 'Employee', '97.7', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:29:54', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1128, 31, 'image', 'Andy', 'Employee', '97.7', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:29:45', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1129, 31, 'image', 'Jim', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:29:33', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1130, 31, 'image', 'Jim', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:29:18', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1131, 31, 'image', 'Dwight', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:29:06', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1132, 31, 'image', 'Andy', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:28:56', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1133, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:22:10', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1134, 31, 'image', 'Chris Sabina', 'Employee', '98.1', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:22:02', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1135, 31, 'image', 'Chris Sabina', 'Employee', 'None', 'Normal', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:21:56', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1136, 31, 'image', 'Vincent Sabina Jr', 'Employee', '98.1', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:43:33', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1137, 31, 'image', 'Vincent Sabina Jr', 'Employee', '98.1', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:43:16', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1138, 31, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:35:47', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1139, 31, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:35:35', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1140, 31, 'image', 'Vincent Sabina Jr', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:35:07', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1141, 31, 'image', 'Vincent Sabina Jr', 'Employee', '97.7', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:34:54', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1142, 31, 'image', 'Vincent Sabina Jr', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:33:17', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1143, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:26:41', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1144, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:26:15', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1145, 31, 'image', 'Chris Sabina', 'Employee', '98.1', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:26:06', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1146, 31, 'image', 'Vincent Sabina Jr', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:25:36', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1147, 31, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:25:23', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1148, 31, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:25:21', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1149, 31, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:25:14', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1150, 31, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:24:19', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1151, 31, 'image', 'Vincent Sabina Jr', 'Employee', '97.5', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:24:04', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1152, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:00:47', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1153, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:00:35', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1154, 31, 'image', 'Stranger', 'Stranger', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '16:04:30', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1155, 31, 'image', 'Stranger', 'Stranger', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '16:04:15', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1156, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '15:33:08', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1157, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '15:30:52', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1158, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '15:29:01', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1159, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '15:28:14', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1160, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '15:21:42', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1161, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:59:51', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1162, 31, 'image', 'Chris Sabina', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:59:11', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1163, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:36:52', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1164, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:35:31', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1165, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:31:47', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1166, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:29:58', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1167, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:28:26', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1168, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:25:23', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1169, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:24:40', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1170, 31, 'image', 'Chris Sabina', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:59:49', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1171, 31, 'image', 'Chris Sabina', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:59:40', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1172, 31, 'image', 'Chris Sabina', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:39:39', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1173, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:18:46', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1174, 31, 'image', 'Chris Sabina', 'Employee', '97.0', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:18:37', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1175, 31, 'image', 'Chris Sabina', 'Employee', 'None', 'Normal', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:18:29', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1176, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:01:56', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1177, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:00:35', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1178, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:00:26', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1179, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:00:18', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1180, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:00:01', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1181, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:59:56', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1182, 31, 'image', 'Chris Sabina', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:59:51', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1183, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:59:39', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1184, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:49:40', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1185, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:44:58', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1186, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:44:50', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1187, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:40:12', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1188, 31, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:38:25', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1189, 31, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:38:12', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1190, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:34:38', NULL, NULL, NULL, '2020-09-05', '2020-09-05'),
(1191, 31, 'image', 'Chris Sabina', 'Employee', '97.7', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:31:38', NULL, NULL, NULL, '2020-09-05', '2020-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_02_101926_create_settings_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `multiple_record_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skip_mask` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `threshold_temperature` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_hours_per_day` int(11) NOT NULL DEFAULT 10,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `multiple_record_time`, `skip_mask`, `threshold_temperature`, `max_hours_per_day`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '100', 10, NULL, '2020-09-05 03:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `is_active` int(10) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(31, 'admin@g.com', 'admin@g.com', NULL, '$2y$10$MVNVdVIEYpyup8wiqo5OkuSSwdSJGbm.95hIpJAp2LliVlGObbDdO', 'admin', 1, NULL, '2020-09-05 00:05:28', '2020-09-05 00:05:28'),
(32, 'user1@g.com', 'user1@g.com', NULL, '$2y$10$MVNVdVIEYpyup8wiqo5OkuSSwdSJGbm.95hIpJAp2LliVlGObbDdO', 'user', 1, NULL, '2020-09-05 00:05:28', '2020-09-05 00:05:28'),
(33, 'user2', 'user2@g.com', NULL, '$2y$10$p5vzQ0ONUkHS29ldlZN8ReBeFkIBo00wOYXlaEbWCsxHdoVW1iVau', 'user', 1, NULL, '2020-09-05 08:36:34', '2020-09-05 08:37:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biometrics`
--
ALTER TABLE `biometrics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulk`
--
ALTER TABLE `bulk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import`
--
ALTER TABLE `import`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`creation_date`,`creation_time`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `biometrics`
--
ALTER TABLE `biometrics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bulk`
--
ALTER TABLE `bulk`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `import`
--
ALTER TABLE `import`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1192;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
