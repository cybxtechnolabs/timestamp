-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2020 at 04:04 PM
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
(1053, 2, 'image', 'Dwight', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:30:55', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1054, 2, 'image', 'Andy', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:30:48', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1055, 2, 'image', 'Jim', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:30:23', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1056, 2, 'image', 'Jim', 'Employee', '97.7', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:30:06', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1057, 2, 'image', 'Dwight', 'Employee', '97.7', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:29:54', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1058, 2, 'image', 'Andy', 'Employee', '97.7', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:29:45', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1059, 2, 'image', 'Jim', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:29:33', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1060, 2, 'image', 'Jim', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:29:18', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1061, 2, 'image', 'Dwight', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:29:06', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1062, 2, 'image', 'Andy', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:28:56', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1063, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:22:10', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1064, 2, 'image', 'Chris Sabina', 'Employee', '98.1', 'No mask', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:22:02', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1065, 2, 'image', 'Chris Sabina', 'Employee', 'None', 'Normal', 'XF-TM-100', 'Face swiping', '2020-09-01', '6:21:56', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1066, 2, 'image', 'Vincent Sabina Jr', 'Employee', '98.1', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:43:33', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1067, 2, 'image', 'Vincent Sabina Jr', 'Employee', '98.1', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:43:16', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1068, 2, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:35:47', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1069, 2, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:35:35', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1070, 2, 'image', 'Vincent Sabina Jr', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:35:07', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1071, 2, 'image', 'Vincent Sabina Jr', 'Employee', '97.7', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:34:54', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1072, 2, 'image', 'Vincent Sabina Jr', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:33:17', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1073, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:26:41', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1074, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:26:15', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1075, 2, 'image', 'Chris Sabina', 'Employee', '98.1', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:26:06', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1076, 2, 'image', 'Vincent Sabina Jr', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:25:36', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1077, 2, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:25:23', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1078, 2, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:25:21', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1079, 2, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:25:14', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1080, 2, 'image', 'Vincent Sabina Jr', 'Employee', '97.9', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:24:19', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1081, 2, 'image', 'Vincent Sabina Jr', 'Employee', '97.5', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:24:04', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1082, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:00:47', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1083, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-28', '7:00:35', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1084, 2, 'image', 'Stranger', 'Stranger', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '16:04:30', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1085, 2, 'image', 'Stranger', 'Stranger', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '16:04:15', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1086, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '15:33:08', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1087, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '15:30:52', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1088, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '15:29:01', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1089, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '15:28:14', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1090, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '15:21:42', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1091, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:59:51', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1092, 2, 'image', 'Chris Sabina', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:59:11', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1093, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:36:52', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1094, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:35:31', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1095, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:31:47', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1096, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:29:58', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1097, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:28:26', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1098, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:25:23', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1099, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '14:24:40', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1100, 2, 'image', 'Chris Sabina', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:59:49', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1101, 2, 'image', 'Chris Sabina', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:59:40', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1102, 2, 'image', 'Chris Sabina', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:39:39', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1103, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:18:46', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1104, 2, 'image', 'Chris Sabina', 'Employee', '97.0', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:18:37', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1105, 2, 'image', 'Chris Sabina', 'Employee', 'None', 'Normal', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:18:29', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1106, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:01:56', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1107, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:00:35', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1108, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:00:26', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1109, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:00:18', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1110, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '8:00:01', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1111, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:59:56', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1112, 2, 'image', 'Chris Sabina', 'Employee', '98.1', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:59:51', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1113, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:59:39', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1114, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:49:40', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1115, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:44:58', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1116, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:44:50', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1117, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:40:12', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1118, 2, 'image', 'Chris Sabina', 'Employee', '97.5', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:38:25', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1119, 2, 'image', 'Chris Sabina', 'Employee', '97.9', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:38:12', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1120, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'Normal body temperature', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:34:38', NULL, NULL, NULL, '2020-09-04', '2020-09-04'),
(1121, 2, 'image', 'Chris Sabina', 'Employee', '97.7', 'No mask', 'XF-TM-100', 'Face swiping', '2020-08-27', '7:31:38', NULL, NULL, NULL, '2020-09-04', '2020-09-04');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `multiple_record_time`, `skip_mask`, `threshold_temperature`, `created_at`, `updated_at`) VALUES
(1, '3', '1', '100', NULL, '2020-09-03 06:23:24');

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
(1, 'dhiraj', 'admin@gmail.com', NULL, '$2y$12$rXjyqrc0LTtNc/hh3tw7r..f3eDNfWz5i0hWxuJYAo1OgiT7nx8ku', 'admin', 1, NULL, NULL, NULL),
(2, 'user1', 'user1@gmail.com', NULL, '$2y$12$hTcanXwWa6piGSRxLxq4PueJw0ysT1dDhazChqyDzfh1el24ZSDlC', 'user', 1, NULL, NULL, NULL),
(3, 'user2', 'user2@gmail.com', NULL, '$2y$12$5NH1VZXTKLT9Jyupr7MGg.vd79BuFAtmB1fKvcjdT8KoYxZNhZaHS', 'user', 1, NULL, NULL, NULL),
(4, 'user3', 'user3@gmail.com', NULL, '$2y$12$bFXL45jIJKabwjgwtuJ6fOS0oRdm2c920cJ/j/d1daW5v8.wFcKCa', 'user', 1, NULL, NULL, NULL),
(5, 'ddsdds', 'd1@t.com', NULL, '$2y$10$fXjyHDGLL5pagMVgxjxoJuF4msaygbGuryun4sxHi9h2XJs//viK2', 'user', 0, NULL, '2020-09-03 07:50:57', '2020-09-03 07:50:57'),
(6, 'sdddsd', 'sdsd@d.com', NULL, '$2y$10$intnQ5K1ORwGSBvDMIiKoexDQyw.CnGBnJceIQBndJ6DOt0D0/o4a', 'user', 0, NULL, '2020-09-03 08:01:37', '2020-09-03 08:01:37'),
(7, 'dsdssd', 'dsdssd@g.com', NULL, '$2y$10$Uj98v4ldyXjDTOUNHUHmqugKDkPNMI0yQ49xoK.Ba3XsFdzWqq03y', 'user', 0, NULL, '2020-09-03 08:02:22', '2020-09-03 08:02:22'),
(8, 'dsdssd', 'dsdssd1@g.com', NULL, '$2y$10$06NT.sdWCur50qapGqisrOUasfCgHRN8yZWPKtj21UejpgdtTu60m', 'user', 0, NULL, '2020-09-03 08:04:39', '2020-09-03 08:04:39'),
(9, 'dsdssd', 'dsdssd2@g.com', NULL, '$2y$10$Va1DOkHEhY8Rw4RLMaAw6e96WjAEXIU7ywCc0xYkUh8WDvqJvhY8y', 'user', 0, NULL, '2020-09-03 08:05:14', '2020-09-03 08:05:14'),
(10, 'dsdssd', 'dsdssd3@g.com', NULL, '$2y$10$oobYC58I24KMl4DbPuEMKOJGjIfuCO5wy3QqBaJZzZKBcwR/i/m0m', 'user', 0, NULL, '2020-09-03 08:07:00', '2020-09-03 08:07:00'),
(11, 'dsdssd', 'dsdssd4@g.com', NULL, '$2y$10$Bpx.i4G8PbdpKMrMMc4jX.IdDuFEgsHcjb5EAgrQNNHHYU0e8kcQ.', 'user', 0, NULL, '2020-09-03 08:07:44', '2020-09-03 08:07:44'),
(12, 'dsdssd', 'dsdssd5@g.com', NULL, '$2y$10$9yUB.fkqhod5kwGwdXpevO2Git8K2Re29oUY.sVv27b84j74QrP4O', 'user', 0, NULL, '2020-09-03 08:08:52', '2020-09-03 08:08:52'),
(13, 'dsdssd', 'dsdssd6@g.com', NULL, '$2y$10$NlLhgJ0F0fb/ylg./kDqB.kFM2jALQo530nPOg/G0UU24nX061NL.', 'user', 0, NULL, '2020-09-03 08:09:19', '2020-09-03 08:09:19'),
(14, 'dsfsdf', 'dsfsdf@g.com', NULL, '$2y$10$2bsb.h8A3QuwUBEmdUZVWuMPZvr0dcCX7HaTS2bDEyToc/M0B8QMa', 'user', 0, NULL, '2020-09-03 08:13:56', '2020-09-03 08:13:56'),
(15, 'dsfsdf', 'dsfsdf1@g.com', NULL, '$2y$10$UPYeMwF83KxYe.hejgMGYub.qXJN4vZSeZNmCM4TQONrEg0.LZhSy', 'user', 0, NULL, '2020-09-03 08:17:47', '2020-09-03 08:17:47'),
(16, 'dsfsdf', 'dsfsdf11@g.com', NULL, '$2y$10$THNy5ohOOmkWLUB4DsgaK.A.CfuX8jhiG53TiX.FPvunJc37pVqJ6', 'user', 0, NULL, '2020-09-03 08:21:34', '2020-09-03 08:21:34'),
(17, 'dsdfds', 'dsdfds@g.com', NULL, '$2y$10$W6r6.UlpGzhj8a1uESCK3.SCx5voJQ08ZeMraDsN6yMfjWLLfRSuq', 'user', 0, NULL, '2020-09-03 08:22:03', '2020-09-03 08:22:03'),
(18, 'asdasd', 'asdasd@g.com', NULL, '$2y$10$OCwW4QRimXR5lG08r1DbB.oOSuKAA9pDYBEynsj/EQvwGZ/JCLSye', 'user', 0, NULL, '2020-09-03 08:27:43', '2020-09-03 08:27:43'),
(19, 'sdfsdf', 'sdfsdf@g.com', NULL, '$2y$10$Tp1oQoNJOGffjItK3xbi7.V3iNc8lap40gWHgWB82P1ozVYXDd8Oa', 'user', 0, NULL, '2020-09-03 08:28:44', '2020-09-03 08:28:44'),
(20, 'dfdfgdfgfg', 'dfdfgdfgfg@g.com', NULL, '$2y$10$dF8MHEWb2mElHMHtwE8ex.q8W0FAXP9wpvzlPBUZEgHOPrS0C3RPW', 'user', 0, NULL, '2020-09-03 08:31:20', '2020-09-03 08:31:20'),
(21, 'asdsdasadsd', 'asdsdasadsd@g.com', NULL, '$2y$10$1wJuwpdvFDI/r0KYINALOOlJSxKA8HUKewBW7ZTe7bHcX4YPbbJfa', 'user', 0, NULL, '2020-09-03 08:37:56', '2020-09-03 08:37:56'),
(22, 'asdds', 'asdds@g.com', NULL, '$2y$10$apYMIjCJigkzi5YP/TOB6esrXYF892OYX4cu2YfgSb65Brwpwpamu', 'user', 0, NULL, '2020-09-03 08:39:18', '2020-09-03 08:39:18'),
(23, 'asdds', 'asdds1@g.com', NULL, '$2y$10$Uy1H2.603sPXL61gzS4lzOWR84wIz.gX1SCrrY6tMC7QmvhjyMAXS', 'user', 0, NULL, '2020-09-03 08:39:56', '2020-09-03 08:39:56'),
(24, 'asdds12@g.com', 'asdds12@g.com', NULL, '$2y$10$8d.N0CmtlCoJeVkbIqrKfeXNDppfmtWL1wg6q7jhvhQdkHvCPtay.', 'user', 0, NULL, '2020-09-03 08:40:46', '2020-09-03 08:40:46'),
(25, 'asdds121@g.com', 'asdds121@g.com', NULL, '$2y$10$BmvU2VBO.vhBXPh9NR7xIud6sTbVl1r6mOSkBLpOzGaZLFNKAWU7K', 'user', 0, NULL, '2020-09-03 08:41:03', '2020-09-03 08:41:03'),
(26, 'newuser', 'newuser1@gmail.com', NULL, '$2y$10$EjlvY6khOC9j0GlBAMG5.e9VfB5wgXVwM8zhzmNzVuHkPxDGhcLSu', 'user', 0, NULL, '2020-09-03 23:49:40', '2020-09-03 23:49:40'),
(27, 'adfsd', 'adfsd@gmail.com', NULL, '$2y$10$4Wb63g6hA.8bhXV4EXDkEuDnS/1Ktic9Sq8lH3bwiIgvLQskMlK.G', 'user', 0, NULL, '2020-09-03 23:52:42', '2020-09-03 23:52:42'),
(28, 'dfdsf', 'dfdsf@g.com', NULL, '$2y$10$3Xu4ORNi/GQyog9r.6t/xOqNw8dMIvZX8a1QOFvPBt2mZ60vy9BcW', 'user', 0, NULL, '2020-09-03 23:54:21', '2020-09-03 23:54:21'),
(29, 'dasdsad', 'dasdsad@f.com', NULL, '$2y$10$KuVoQ.s.9lT5SimLuWqmY.78HbjN3IG/te7WX8Q8vBISwrAkGK1ua', 'user', 0, NULL, '2020-09-03 23:55:18', '2020-09-03 23:55:18'),
(30, 'asdsda', 'asdsda@d.com', NULL, '$2y$10$ct.Dg2jzbEhpHH0i4hJRKOiTJ5sakP9xOy9DW5rpqc1mz4HXfHe9O', 'user', 0, NULL, '2020-09-03 23:56:08', '2020-09-03 23:56:08');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1122;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
