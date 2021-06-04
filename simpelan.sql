-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 04, 2021 at 07:19 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `simpelan`
--

-- --------------------------------------------------------

--
-- Table structure for table `curah_hujan`
--

CREATE TABLE `curah_hujan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `curah_hujan`
--

INSERT INTO `curah_hujan` (`id`, `tahun`, `bulan`, `nilai`, `created_at`, `updated_at`) VALUES
(1, '2017', 'januari', '244', NULL, NULL),
(2, '2017', 'februari', '224.8', NULL, NULL),
(3, '2017', 'maret', '121.1', NULL, NULL),
(4, '2017', 'April', '83.7', NULL, NULL),
(5, '2017', 'mei', '150.9', NULL, NULL),
(6, '2017', 'juni', '173.2', NULL, NULL),
(7, '2017', 'juli', '118.4', NULL, NULL),
(8, '2017', 'agustus', '48.2', NULL, NULL),
(9, '2017', 'september', '9.3', NULL, NULL),
(10, '2017', 'oktober', '113.2', NULL, NULL),
(11, '2017', 'november', '192.5', NULL, NULL),
(12, '2017', 'desember', '276.6', NULL, NULL),
(13, '2018', 'januari', '474.3', NULL, NULL),
(14, '2018', 'februari', '276', NULL, NULL),
(15, '2018', 'maret', '161.9', NULL, NULL),
(16, '2018', 'april', '28.9', NULL, NULL),
(17, '2018', 'mei', '5.9', NULL, NULL),
(18, '2018', 'juni', '33.1', NULL, NULL),
(19, '2018', 'juli', '68.5', NULL, NULL),
(20, '2018', 'agustus', '69.4', NULL, NULL),
(21, '2018', 'september', '9', NULL, NULL),
(22, '2018', 'oktober', '0.7', NULL, NULL),
(23, '2018', 'november', '239.2', NULL, NULL),
(24, '2018', 'desember', '97.6', NULL, NULL),
(25, '2019', 'januari', '236.4', NULL, NULL),
(26, '2019', 'februari', '81.9', NULL, NULL),
(27, '2019', 'maret', '210.8', NULL, NULL),
(28, '2019', 'april', '239.5', NULL, NULL),
(29, '2019', 'mei', '26.1', NULL, NULL),
(30, '2019', 'juni', '15.5', NULL, NULL),
(31, '2019', 'juli', '0', NULL, NULL),
(32, '2019', 'agustus', '6.8', NULL, NULL),
(33, '2019', 'september', '29.7', NULL, NULL),
(34, '2019', 'oktober', '0', NULL, NULL),
(35, '2019', 'november', '2.8', NULL, NULL),
(36, '2019', 'desember', '11.8', NULL, NULL),
(37, '2020', 'januari', '136.3', NULL, NULL),
(38, '2020', 'februari', '257', NULL, NULL),
(39, '2020', 'maret', '217.1', NULL, NULL),
(40, '2020', 'april', '40.7', NULL, NULL),
(41, '2020', 'mei', '232.4', NULL, NULL),
(42, '2020', 'juni', '77.9', NULL, NULL),
(43, '2020', 'juli', '81.7', NULL, NULL),
(44, '2020', 'agustus', '48', NULL, NULL),
(45, '2020', 'september', '93.9', NULL, NULL),
(46, '2020', 'oktober', '242', NULL, NULL),
(47, '2020', 'november', '28.6', NULL, NULL),
(48, '2020', 'desember', '148.9', NULL, NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'bangorejo', NULL, NULL),
(2, 'pesanggaran', NULL, NULL),
(3, 'siliragung', NULL, NULL),
(4, 'muncar', NULL, NULL),
(5, 'purwoharjo', NULL, NULL),
(6, 'tegaldlimo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(41, '2014_05_11_052824_create_roles_table', 1),
(42, '2014_10_12_000000_create_users_table', 1),
(43, '2014_10_12_100000_create_password_resets_table', 1),
(44, '2019_08_19_000000_create_failed_jobs_table', 1),
(45, '2021_04_18_153306_create_periode_table', 1),
(46, '2021_04_28_141620_create_kecamatan_table', 1),
(47, '2021_04_28_141626_create_permintaan_table', 1),
(48, '2021_05_08_053046_create_produksi_table', 1),
(49, '2021_05_08_055454_create_curah_hujan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `periode`, `tahun`, `created_at`, `updated_at`) VALUES
(1, '1', '2017', NULL, NULL),
(2, '2', '2017', NULL, NULL),
(3, '3', '2017', NULL, NULL),
(4, '4', '2017', NULL, NULL),
(5, '1', '2018', NULL, NULL),
(6, '2', '2018', NULL, NULL),
(7, '3', '2018', NULL, NULL),
(8, '4', '2018', NULL, NULL),
(9, '1', '2019', NULL, NULL),
(10, '2', '2019', NULL, NULL),
(11, '3', '2019', NULL, NULL),
(12, '4', '2019', NULL, NULL),
(13, '1', '2020', NULL, NULL),
(14, '2', '2020', NULL, NULL),
(15, '3', '2020', NULL, NULL),
(16, '4', '2020', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permintaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_id` bigint(20) UNSIGNED NOT NULL,
  `kecamatan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id`, `permintaan`, `periode_id`, `kecamatan_id`, `created_at`, `updated_at`) VALUES
(1, '5403', 9, 1, NULL, NULL),
(2, '90651', 3, 1, NULL, NULL),
(3, '4572', 1, 2, NULL, NULL),
(4, '6013', 7, 2, NULL, NULL),
(5, '855', 5, 2, NULL, NULL),
(6, '1350', 1, 1, NULL, NULL),
(7, '62956', 2, 1, NULL, NULL),
(8, '61930', 4, 1, NULL, NULL),
(9, '43833', 5, 1, NULL, NULL),
(10, '78021', 6, 1, NULL, NULL),
(11, '73151', 7, 1, NULL, NULL),
(12, '47829', 8, 1, NULL, NULL),
(13, '63069', 2, 2, NULL, NULL),
(14, '91966', 3, 2, NULL, NULL),
(15, '2076', 13, 1, NULL, NULL),
(16, '7136', 10, 1, NULL, NULL),
(17, '24274', 11, 1, NULL, NULL),
(18, '41307', 12, 1, NULL, NULL),
(19, '5308', 14, 1, NULL, NULL),
(20, '15810', 15, 1, NULL, NULL),
(21, '23157', 16, 1, NULL, NULL),
(22, '364', 1, 4, NULL, NULL),
(23, '1749', 2, 4, NULL, NULL),
(24, '49804', 1, 5, NULL, NULL),
(25, '2956', 1, 3, NULL, NULL),
(26, '76326', 2, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `luas_panen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_id` bigint(20) UNSIGNED NOT NULL,
  `kecamatan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id`, `luas_panen`, `produksi`, `harga`, `periode_id`, `kecamatan_id`, `created_at`, `updated_at`) VALUES
(1, '583', '4167', '13000', 9, 1, NULL, NULL),
(2, '684', '89700', '10000', 3, 1, NULL, NULL),
(3, '206', '3621', '10000', 1, 2, NULL, NULL),
(4, '205', '4587', '15000', 7, 2, NULL, NULL),
(5, '205', '764', '4000', 5, 2, NULL, NULL),
(6, '684', '399', '10000', 1, 1, NULL, NULL),
(7, '684', '62005', '10000', 2, 1, NULL, NULL),
(8, '683', '62500', '7000', 4, 1, NULL, NULL),
(9, '683', '44450', '6500', 5, 1, NULL, NULL),
(10, '683', '76120', '20000', 6, 1, NULL, NULL),
(11, '683', '72010', '12000', 7, 1, NULL, NULL),
(12, '600', '50000', '2000', 8, 1, NULL, NULL),
(13, '206', '62783', '23000', 2, 2, NULL, NULL),
(14, '206', '90825', '12000', 3, 2, NULL, NULL),
(15, '583', '4167', '4000', 13, 1, NULL, NULL),
(16, '583', '5900', '13000', 10, 1, NULL, NULL),
(17, '583', '23038', '13000', 11, 1, NULL, NULL),
(18, '583', '40071', '13000', 12, 1, NULL, NULL),
(19, '583', '4167', '12000', 14, 1, NULL, NULL),
(20, '583', '14669', '12000', 15, 1, NULL, NULL),
(21, '1025', '25153', '5000', 16, 1, NULL, NULL),
(22, '17', '79', '10000', 1, 4, NULL, NULL),
(23, '17', '85', '23000', 2, 4, NULL, NULL),
(24, '448', '51610', '7000', 1, 5, NULL, NULL),
(25, '129', '1245', '18000', 1, 3, NULL, NULL),
(26, '448', '74662', '17500', 2, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'mantri', NULL, NULL),
(2, 'holtikultura', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_depan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_belakang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `nama_depan`, `nama_belakang`, `email_verified_at`, `password`, `avatar`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mantri@email.com', 'mantri', 'tani', NULL, '$2y$10$7AOv1WinlKbhgBnh305vk.l.EupSIO4eZMe.sgZdqOZe0011lSG2a', 'https://ui-avatars.com/api/?name=MantriTani', 1, NULL, NULL, NULL),
(2, 'holtikultura@email.com', 'seksi', 'holtikultura', NULL, '$2y$10$2Ioj46qwcLie9x/v8Glbxuz5LGI64/pYgvOhpscuuzvmve151vaRy', 'https://ui-avatars.com/api/?name=holtikultura', 2, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `curah_hujan`
--
ALTER TABLE `curah_hujan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
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
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaan_periode_id_foreign` (`periode_id`),
  ADD KEY `permintaan_kecamatan_id_foreign` (`kecamatan_id`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produksi_periode_id_foreign` (`periode_id`),
  ADD KEY `produksi_kecamatan_id_foreign` (`kecamatan_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `curah_hujan`
--
ALTER TABLE `curah_hujan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD CONSTRAINT `permintaan_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permintaan_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `produksi_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produksi_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
