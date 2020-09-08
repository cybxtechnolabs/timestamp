
CREATE DATABASE IF NOT EXISTS `timestamp_v2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `timestamp_v2`;


CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `import` (
  `id` int(20) PRIMARY KEY  AUTO_INCREMENT,
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


CREATE TABLE `import_duplicate` (
  `id` int(20) PRIMARY KEY  AUTO_INCREMENT,
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


CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED PRIMARY KEY  AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `multiple_record_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `skip_mask` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `threshold_temperature` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '100',
  `max_hours_per_day` int(11) NOT NULL DEFAULT 10,
  `skip_unknown` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED PRIMARY KEY  AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci UNIQUE KEY,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `is_active` int(10) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED PRIMARY KEY  AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_02_101926_create_settings_table', 2);


INSERT INTO `settings` (`id`, `user_id`, `multiple_record_time`, `skip_mask`, `threshold_temperature`, `max_hours_per_day`, `skip_unknown`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '1', '111', 11, '0', '2020-09-08 00:00:36', '2020-09-08 00:00:36');


INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@g.com', 'admin@g.com', NULL, '$2y$10$MVNVdVIEYpyup8wiqo5OkuSSwdSJGbm.95hIpJAp2LliVlGObbDdO', 'admin', 1, NULL, '2020-09-05 00:05:28', '2020-09-05 00:05:28');



CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);


