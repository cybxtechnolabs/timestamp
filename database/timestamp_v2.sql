-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2020 at 08:02 AM
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
  `snap_photo` text DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `import_duplicate`
--

CREATE TABLE `import_duplicate` (
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
  `user_id` int(20) NOT NULL,
  `multiple_record_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `skip_mask` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `threshold_temperature` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '100',
  `max_hours_per_day` int(11) NOT NULL DEFAULT 10,
  `skip_unknown` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `multiple_record_time`, `skip_mask`, `threshold_temperature`, `max_hours_per_day`, `skip_unknown`, `created_at`, `updated_at`) VALUES
(4, 33, '1', '1', '100', 10, '0', '2020-09-07 09:25:22', '2020-09-07 09:39:32'),
(5, 31, '1', '1', '111', 11, '0', '2020-09-08 00:00:36', '2020-09-08 00:00:36'),
(6, 35, '1', '1', '100', 11, '1', '2020-09-08 00:03:46', '2020-09-08 00:08:54');

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
(32, 'user1', 'user1@g.com', NULL, '$2y$10$MVNVdVIEYpyup8wiqo5OkuSSwdSJGbm.95hIpJAp2LliVlGObbDdO', 'user', 1, NULL, '2020-09-05 00:05:28', '2020-09-05 00:05:28'),
(33, 'user2', 'user2@g.com', NULL, '$2y$10$p5vzQ0ONUkHS29ldlZN8ReBeFkIBo00wOYXlaEbWCsxHdoVW1iVau', 'user', 1, NULL, '2020-09-05 08:36:34', '2020-09-05 08:37:17'),
(34, 'user3@gmail.com', 'user3@gmail.com', NULL, '$2y$10$iUC/VMhsvYZlX9YwYoNWTefWSXOBWH0zIOnpLg1M/875YFhoiO.Ia', 'user', 1, NULL, '2020-09-07 23:36:32', '2020-09-07 23:37:20'),
(35, 'user4@g.com', 'user4@g.com', NULL, '$2y$10$CeQytVRQO6wJq4GlM.tkf.rRwZ9uTymZbz6cfFusLbLAetTzMsgHa', 'user', 1, NULL, '2020-09-07 23:48:18', '2020-09-07 23:55:04');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `import_duplicate`
--
ALTER TABLE `import_duplicate`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `import`
--
ALTER TABLE `import`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2560;

--
-- AUTO_INCREMENT for table `import_duplicate`
--
ALTER TABLE `import_duplicate`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
