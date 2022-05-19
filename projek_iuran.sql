-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 07:00 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_iuran`
--

-- --------------------------------------------------------

--
-- Table structure for table `iurans`
--

CREATE TABLE `iurans` (
  `id` char(36) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` varchar(50) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '0',
  `jenis_iuran` text DEFAULT NULL,
  `anggota_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iurans`
--

INSERT INTO `iurans` (`id`, `tanggal`, `nominal`, `status`, `jenis_iuran`, `anggota_id`, `user_id`, `created_at`, `updated_at`) VALUES
('48cbafc0-6f72-49e8-8623-7b84fb39c317', '2021-08-25', '100000', '0', 'tes', 'a012a59b-e72a-4da3-a96e-e1405bcbcbf8', 'f403101a-4b26-48d5-b285-2c4e94cceb5b', '2021-08-24 20:56:18', '2021-08-24 20:59:22');

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
(3, '2020_10_27_040253_create_permission_tables', 1),
(4, '2020_10_27_071632_add_status_to_users_table', 1),
(5, '2020_11_09_062147_add_field_api_token_to_users_table', 1),
(6, '2020_11_19_022544_create_channels_table', 1),
(7, '2020_11_19_022833_create_merchandisers_table', 1),
(8, '2020_11_19_041337_create_outlets_table', 1),
(9, '2020_11_19_042406_create_city_table', 1),
(10, '2020_11_19_042822_create_visits_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', '784bb5dd-6eec-4a7e-8194-29c5cd92b355'),
(1, 'App\\User', 'f403101a-4b26-48d5-b285-2c4e94cceb5b'),
(5, 'App\\User', '1dff1125-20f4-4652-be4a-c9a6428a046b'),
(6, 'App\\User', '87fa9c31-e98d-4e31-8488-a2817aeec74d'),
(6, 'App\\User', '974f9de4-6c86-4225-b12a-8ffb305a68e6'),
(6, 'App\\User', 'a012a59b-e72a-4da3-a96e-e1405bcbcbf8');

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
-- Table structure for table `pemasukans`
--

CREATE TABLE `pemasukans` (
  `id` char(36) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` varchar(50) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '0',
  `jenis_pemasukan` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasukans`
--

INSERT INTO `pemasukans` (`id`, `tanggal`, `nominal`, `status`, `jenis_pemasukan`, `keterangan`, `user_id`, `created_at`, `updated_at`) VALUES
('6c8f5968-b4b7-41a6-b079-a4e2f34a775b', '2021-03-16', '2000000', '1', 'Cash', 'Tes aja', 'f403101a-4b26-48d5-b285-2c4e94cceb5b', '2021-03-16 06:08:56', '2021-03-16 06:08:56'),
('7926c8ab-a22f-4dda-afcc-851cd6783c88', '2021-03-18', '3000000', '1', 'Cash', 'coba aja', 'f403101a-4b26-48d5-b285-2c4e94cceb5b', '2021-03-17 16:07:34', '2021-03-17 16:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluarans`
--

CREATE TABLE `pengeluarans` (
  `id` char(36) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` varchar(50) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '0',
  `catatan` text DEFAULT NULL,
  `bukti` varchar(50) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluarans`
--

INSERT INTO `pengeluarans` (`id`, `tanggal`, `nominal`, `status`, `catatan`, `bukti`, `user_id`, `created_at`, `updated_at`) VALUES
('ee0fb63d-93e5-482a-a83e-3222e7ada268', '2021-03-21', '2000000', '1', 'coba saja', 'pYGENFdmgK.jpg', 'f403101a-4b26-48d5-b285-2c4e94cceb5b', '2021-03-20 19:09:09', '2021-03-20 19:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `display_name`, `module`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', 'lihat level', 'Level', NULL, NULL),
(2, 'role-create', 'web', 'tambah level', 'Level', NULL, NULL),
(3, 'role-edit', 'web', 'edit level', 'Level', NULL, NULL),
(4, 'role-delete', 'web', 'hapus level', 'Level', NULL, NULL),
(5, 'user-list', 'web', 'lihat pengguna', 'Pengguna', NULL, NULL),
(6, 'user-create', 'web', 'tambah pengguna', 'Pengguna', NULL, NULL),
(7, 'user-edit', 'web', 'edit pengguna', 'Pengguna', NULL, NULL),
(8, 'user-delete', 'web', 'hapus pengguna', 'Pengguna', NULL, NULL),
(9, 'permission-list', 'web', 'lihat akses', 'Akses', NULL, NULL),
(10, 'permission-create', 'web', 'tambah akses', 'Akses', NULL, NULL),
(11, 'permission-edit', 'web', 'edit akses', 'Akses', NULL, NULL),
(12, 'permission-delete', 'web', 'hapus akses', 'Akses', NULL, NULL),
(17, 'pemasukan-list', 'web', 'lihat pemasukan', 'Master', NULL, NULL),
(18, 'pemasukan-create', 'web', 'tambah pemasukan', 'Master', NULL, NULL),
(19, 'pemasukan-edit', 'web', 'edit pemasukan', 'Master', NULL, NULL),
(20, 'pemasukan-delete', 'web', 'hapus pemasukan', 'Master', NULL, NULL),
(21, 'pengeluaran-list', 'web', 'lihat pengeluaran', 'Master', NULL, NULL),
(22, 'pengeluaran-create', 'web', 'tambah pengeluaran', 'Master', NULL, NULL),
(23, 'pengeluaran-edit', 'web', 'edit pengeluaran', 'Master', NULL, NULL),
(24, 'pengeluaran-delete', 'web', 'hapus pengeluaran', 'Master', NULL, NULL),
(25, 'iuran-list', 'web', 'lihat iuran', 'Master', NULL, NULL),
(26, 'iuran-create', 'web', 'tambah iuran', 'Master', NULL, NULL),
(27, 'iuran-edit', 'web', 'edit iuran', 'Master', NULL, NULL),
(28, 'iuran-delete', 'web', 'hapus iuran', 'Master', NULL, NULL),
(29, 'grafik', 'web', 'Grafik', 'Master', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2020-11-18 20:46:50', '2020-11-18 20:46:50'),
(5, 'kades', 'web', '2021-03-09 23:37:58', '2021-03-09 23:37:58'),
(6, 'anggota', 'web', '2021-03-09 23:38:45', '2021-03-09 23:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 5),
(7, 6),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(17, 1),
(17, 5),
(17, 6),
(18, 1),
(19, 1),
(19, 5),
(20, 1),
(21, 1),
(21, 5),
(21, 6),
(22, 1),
(23, 1),
(23, 5),
(24, 1),
(25, 1),
(25, 5),
(25, 6),
(26, 1),
(27, 1),
(27, 5),
(28, 1),
(29, 1),
(29, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `alamat`, `foto`, `jenis_kelamin`, `api_token`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
('1dff1125-20f4-4652-be4a-c9a6428a046b', 'Kepala Desa', 'kades@mail.com', '$2y$10$RctO4286FTQFZR8kWTIOYebzYEqJKzILCn.pBURdp84GYCqTPQ2cC', 'Jl. Raya Kalimalang', 'Zxe6Ekades@mail.com.jpg', 'L', 'FF0EIx452S17UrrMMk15PAHgnrYCdlMy8Ecf5AjEexxS1H4I0hEb9r34EVJk', 1, 'EQXLLYD0KMfXYdMInXricc6odMsIJeiQQsret8LMUdQV2lgMlLiRcB5AnOfl', '2021-03-08 01:02:03', '2021-05-05 17:31:57'),
('87fa9c31-e98d-4e31-8488-a2817aeec74d', 'Tetrerte', 'pelanggan@gmail.com', '$2y$10$AQCzWbyDrvZuJqEkQrmYIOZqdc28xH85E6Ue2u4F6bS4bgaEg8Hg6', 'Tertetertetetretet', 'avatar.png', 'L', 'zGci4HKFLv4AiVHgiEjddhe0OGI3H7tGfVOnPcXsrb9ldXlpmVdk6ZRzkx3P', 1, 'oYWIX4zcYgFIvtTinwAxHW9g8rrvCakJJRZWkBhhuBb09Mge45zx1s0b5YmM', '2021-05-01 08:56:37', '2021-05-05 17:38:36'),
('974f9de4-6c86-4225-b12a-8ffb305a68e6', 'Putunew2', 'putu@mail.com', '$2y$10$jrA/UiiQuLfxZkOtiYtSzunAOh.vILS7431OoYHPdzSADuQ54ZpCe', 'Renon Bali', 'avatar.png', 'L', 'ZAGlTInZew3R3f9j28bEXvFO80n3Rbmf225jKrdxTnY17TSsdPqSoGl2y3pI', 1, 'EXKWu5CdzJBHLYPWfiTfxDtkzcW0zAItSm6U1lC1LuDBTi6wOPFHQ0sklwtR', '2021-03-29 04:05:03', '2021-05-01 09:04:28'),
('a012a59b-e72a-4da3-a96e-e1405bcbcbf8', 'Made', 'kadekb@gmail.com', '$2y$10$NrLFPbszEr0zOrmxuD7aEO2vrRm6UFA2e06hQ6JvObrAYa5duhHjG', 'Rtytrt Ghghgh', 'avatar.png', 'L', 'BuCAe2r2LAj5pItqkU8Maw81ulZHFFOiTGJ3En9ZZ9APsA5XZkRBnlfUVnH5', 1, 'WkxbziSnY9C0Ek4SE4ee0o3r7dW6z1YQ3pnPxKU2ZctIun5YmzX4KjOfPbTg', '2021-05-01 09:05:57', '2021-05-01 09:06:29'),
('f403101a-4b26-48d5-b285-2c4e94cceb5b', 'Admin', 'admin@mail.com', '$2y$10$f7r8GtRr9qTyPfn8w.ium.3V/RASJvluqiQRwJT934uIZR/TGqnbK', 'Indonesia Bali', 'dxuppadmin@mail.com.jpg', 'L', 'nyRDVt44P7ZJw7477GFjUvYXn4cmclFv', 1, 'sYClMHfqb9ePFQhXnr9YYxvG8FtyDfRl1XwWJBb3T94vCnkxH0RoowxdeNEc', '2020-11-18 20:46:50', '2021-05-05 17:30:20');

-- --------------------------------------------------------

--
-- Stand-in structure for view `viuran`
-- (See below for the actual view)
--
CREATE TABLE `viuran` (
`month_id` int(2)
,`month_name` varchar(9)
,`total_iuran` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vpemasukan`
-- (See below for the actual view)
--
CREATE TABLE `vpemasukan` (
`month_id` int(2)
,`month_name` varchar(9)
,`total_pemasukan` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vpengeluaran`
-- (See below for the actual view)
--
CREATE TABLE `vpengeluaran` (
`month_id` int(2)
,`month_name` varchar(9)
,`total_pengeluaran` double
);

-- --------------------------------------------------------

--
-- Structure for view `viuran`
--
DROP TABLE IF EXISTS `viuran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viuran`  AS SELECT `months`.`id` AS `month_id`, monthname(concat(concat(year(curdate()),'-'),`months`.`id`,'-01')) AS `month_name`, sum(case when `iurans`.`nominal` is null then 0 else `iurans`.`nominal` end) AS `total_iuran` FROM ((select 1 AS `id` union select 2 AS `2` union select 3 AS `3` union select 4 AS `4` union select 5 AS `5` union select 6 AS `6` union select 7 AS `7` union select 8 AS `8` union select 9 AS `9` union select 10 AS `10` union select 11 AS `11` union select 12 AS `12`) `months` left join `iurans` on(month(`iurans`.`tanggal`) = `months`.`id` and year(`iurans`.`tanggal`) = year(curdate()))) GROUP BY `months`.`id`, monthname(concat(concat(year(curdate()),'-'),`months`.`id`,'-01')) ORDER BY `months`.`id` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `vpemasukan`
--
DROP TABLE IF EXISTS `vpemasukan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vpemasukan`  AS SELECT `months`.`id` AS `month_id`, monthname(concat(concat(year(curdate()),'-'),`months`.`id`,'-01')) AS `month_name`, sum(case when `pemasukans`.`nominal` is null then 0 else `pemasukans`.`nominal` end) AS `total_pemasukan` FROM ((select 1 AS `id` union select 2 AS `2` union select 3 AS `3` union select 4 AS `4` union select 5 AS `5` union select 6 AS `6` union select 7 AS `7` union select 8 AS `8` union select 9 AS `9` union select 10 AS `10` union select 11 AS `11` union select 12 AS `12`) `months` left join `pemasukans` on(month(`pemasukans`.`tanggal`) = `months`.`id` and year(`pemasukans`.`tanggal`) = year(curdate()))) GROUP BY `months`.`id`, monthname(concat(concat(year(curdate()),'-'),`months`.`id`,'-01')) ORDER BY `months`.`id` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `vpengeluaran`
--
DROP TABLE IF EXISTS `vpengeluaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vpengeluaran`  AS SELECT `months`.`id` AS `month_id`, monthname(concat(concat(year(curdate()),'-'),`months`.`id`,'-01')) AS `month_name`, sum(case when `pengeluarans`.`nominal` is null then 0 else `pengeluarans`.`nominal` end) AS `total_pengeluaran` FROM ((select 1 AS `id` union select 2 AS `2` union select 3 AS `3` union select 4 AS `4` union select 5 AS `5` union select 6 AS `6` union select 7 AS `7` union select 8 AS `8` union select 9 AS `9` union select 10 AS `10` union select 11 AS `11` union select 12 AS `12`) `months` left join `pengeluarans` on(month(`pengeluarans`.`tanggal`) = `months`.`id` and year(`pengeluarans`.`tanggal`) = year(curdate()))) GROUP BY `months`.`id`, monthname(concat(concat(year(curdate()),'-'),`months`.`id`,'-01')) ORDER BY `months`.`id` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iurans`
--
ALTER TABLE `iurans`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
