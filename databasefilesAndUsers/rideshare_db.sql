-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 22, 2026 at 09:36 AM
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
-- Database: `rideshare_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ride_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `seats_booked` int(11) NOT NULL DEFAULT 1,
  `status` enum('Confirmed','Cancelled','Completed') NOT NULL DEFAULT 'Confirmed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `ride_id`, `user_id`, `seats_booked`, `status`, `created_at`, `updated_at`) VALUES
(25, 14, 4, 1, 'Completed', '2026-03-21 22:17:02', '2026-03-21 22:19:52'),
(26, 13, 4, 1, 'Completed', '2026-03-21 22:17:04', '2026-03-21 22:40:24'),
(27, 14, 2, 1, 'Completed', '2026-03-21 22:18:36', '2026-03-21 22:19:52'),
(28, 13, 2, 1, 'Completed', '2026-03-21 22:18:37', '2026-03-21 22:40:24'),
(29, 15, 4, 1, 'Cancelled', '2026-03-21 23:15:22', '2026-03-21 23:15:34'),
(30, 15, 4, 1, 'Cancelled', '2026-03-21 23:23:07', '2026-03-21 23:23:35'),
(31, 15, 4, 1, 'Cancelled', '2026-03-21 23:24:28', '2026-03-21 23:32:05'),
(32, 15, 4, 1, 'Cancelled', '2026-03-21 23:30:51', '2026-03-21 23:31:16'),
(33, 15, 4, 1, 'Cancelled', '2026-03-21 23:32:18', '2026-03-21 23:34:05'),
(34, 15, 4, 1, 'Cancelled', '2026-03-21 23:32:20', '2026-03-21 23:34:34'),
(35, 15, 4, 1, 'Cancelled', '2026-03-21 23:32:22', '2026-03-21 23:33:46'),
(36, 15, 4, 1, 'Cancelled', '2026-03-21 23:35:26', '2026-03-21 23:35:46'),
(37, 15, 5, 1, 'Cancelled', '2026-03-21 23:37:49', '2026-03-21 23:40:55'),
(38, 15, 5, 1, 'Cancelled', '2026-03-21 23:38:27', '2026-03-21 23:40:24'),
(39, 18, 2, 1, 'Confirmed', '2026-03-21 23:44:41', '2026-03-21 23:44:41'),
(40, 18, 4, 1, 'Cancelled', '2026-03-22 01:56:43', '2026-03-22 02:07:28'),
(41, 15, 4, 1, 'Cancelled', '2026-03-22 01:56:48', '2026-03-22 02:07:17'),
(42, 18, 4, 1, 'Cancelled', '2026-03-22 02:08:57', '2026-03-22 02:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_23_124502_add_phone_to_users_table', 2),
(5, '2026_02_23_133321_create_rides_table', 3),
(6, '2026_02_24_132121_create_bookings_table', 4),
(7, '2026_03_18_112357_create_ratings_table', 5);

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
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ride_id` bigint(20) UNSIGNED NOT NULL,
  `given_by` bigint(20) UNSIGNED NOT NULL,
  `given_to` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `ride_id`, `given_by`, `given_to`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(2, 14, 2, 3, 4, NULL, '2026-03-21 22:29:36', '2026-03-21 22:29:36'),
(3, 13, 2, 3, 5, 'Good', '2026-03-21 22:42:11', '2026-03-21 22:42:11'),
(4, 13, 4, 3, 5, 'marvelas', '2026-03-21 22:44:20', '2026-03-21 22:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE `rides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pickup_address` varchar(255) NOT NULL,
  `pickup_lat` double NOT NULL,
  `pickup_lng` double NOT NULL,
  `drop_address` varchar(255) NOT NULL,
  `drop_lat` double NOT NULL,
  `drop_lng` double NOT NULL,
  `distance_kg` double DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `total_seats` int(11) NOT NULL,
  `available_seats` int(11) NOT NULL,
  `vehicle_number` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `status` enum('Upcoming','Ongoing','Completed','Cancelled') NOT NULL DEFAULT 'Upcoming',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`id`, `user_id`, `pickup_address`, `pickup_lat`, `pickup_lng`, `drop_address`, `drop_lat`, `drop_lng`, `distance_kg`, `date`, `time`, `price`, `total_seats`, `available_seats`, `vehicle_number`, `license_number`, `status`, `created_at`, `updated_at`) VALUES
(11, 2, 'Bhavnagar', 0, 0, 'gandhinagar', 0, 0, 0, '2026-03-19', '08:01:00', 500.00, 5, 5, 'GJ04FC6877', 'SS51P5251', 'Completed', '2026-03-18 09:01:44', '2026-03-18 09:01:48'),
(12, 3, 'Bhavnagar', 0, 0, 'gandhinagar', 0, 0, 0, '2026-03-20', '20:06:00', 1500.00, 5, 5, 'GJ04FC6874', 'SS51P5251', 'Completed', '2026-03-18 09:04:42', '2026-03-21 22:13:25'),
(13, 3, 'Bhavnagar', 0, 0, 'Rajkot', 0, 0, 0, '2026-03-23', '09:18:00', 550.00, 4, 2, 'GJ04FC6877', 'SS51P5251', 'Completed', '2026-03-21 22:15:28', '2026-03-21 22:40:24'),
(14, 3, 'ahmedabad', 0, 0, 'Surat', 0, 0, 0, '2026-03-24', '09:18:00', 450.00, 3, 2, 'GJ04FC6877', 'SS51P5251', 'Completed', '2026-03-21 22:16:00', '2026-03-21 22:19:52'),
(15, 2, 'Bhavnagar', 0, 0, 'gandhinagar', 0, 0, 0, '2026-03-23', '10:16:00', 54.00, 5, 5, 'GJ04FC6877', 'SS51P5252', 'Upcoming', '2026-03-21 23:15:01', '2026-03-22 02:07:17'),
(16, 4, 'Bhavnagar', 0, 0, 'Rajkot', 0, 0, 0, '2026-04-02', '10:36:00', 450.00, 5, 5, 'GJ04FC6877', 'SS51P5252', 'Completed', '2026-03-21 23:33:01', '2026-03-21 23:34:16'),
(17, 5, 'Surat', 0, 0, 'Bhavnagar', 0, 0, 0, '2026-03-23', '10:42:00', 1200.00, 5, 5, 'GJ04FC6877', 'SS51P5250', 'Cancelled', '2026-03-21 23:39:00', '2026-03-21 23:40:10'),
(18, 5, 'ahmedabad', 0, 0, 'Rajkot', 0, 0, 0, '2026-04-01', '10:43:00', 1200.00, 5, 4, 'GJ04FC6877', 'ssp5251Sd', 'Upcoming', '2026-03-21 23:43:58', '2026-03-22 02:11:27'),
(19, 3, 'Bhavnagar', 0, 0, 'Ahemdabad', 0, 0, 0, '2026-03-24', '13:17:00', 553.00, 6, 6, 'GJ04FC6877', 'SS51P5251', 'Completed', '2026-03-22 02:13:36', '2026-03-22 02:23:08'),
(20, 3, 'ahmedabad', 0, 0, 'gandhinagar', 0, 0, 0, '2026-03-24', '13:28:00', 4500.00, 5, 5, 'GJ04FC6874', 'ssp5251Sd', 'Cancelled', '2026-03-22 02:24:50', '2026-03-22 02:25:14');

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
('JAo9BsYVSvnv6S39mbu0yRbhaDsCvncw2XSqnB6g', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWFhybEluNDVETjY2ZzBiT01FSUdSNnNHekxTa3Y4OVltMGRzWGlQRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlLzMiO3M6NToicm91dGUiO3M6MTI6InByb2ZpbGUuc2hvdyI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yaWRlcy9jcmVhdGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1774166614);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`) VALUES
(1, 'Sumit Patel', 'sumitpatel5251@gmail.com', NULL, '$2y$12$brjZLrlcQzRG.AyEgC/uKOOhHU0fpqWZPqelq3ci0NzXn5LP9xYkK', NULL, '2026-02-23 07:25:18', '2026-02-23 07:25:18', '07874984396'),
(2, 'pavan', 'pavan@gmail.com', NULL, '$2y$12$JmY1PsjPvkGiOkAewBv96O6ch/8CVe2YZqV5U.ilA8pBpMbF5ejlG', NULL, '2026-02-23 07:41:42', '2026-02-23 07:41:42', '07874984396'),
(3, 'manav', 'manav@gmail.com', NULL, '$2y$12$5jcQHLsiKYmGPiw7HasDYuLqNenkR8ophZBqiELGIOzriXKPhXYsm', NULL, '2026-02-23 07:42:59', '2026-02-23 07:42:59', '994966662'),
(4, 'Mayur', 'mayur@gmail.com', NULL, '$2y$12$mR4e9DNh.XXhn4JTy0u7y.OMykMt2zMcQiPV4iMVzwBvcDG8C6zr6', NULL, '2026-02-23 07:43:59', '2026-02-23 07:43:59', '787949956'),
(5, 'jupin patel', 'jupin@gmail.com', NULL, '$2y$12$uXXuGpms8l7v41KYPIULo.y7T/q6pDywzFyAVSkatEJ2AZFByMUSa', NULL, '2026-03-21 23:37:23', '2026-03-21 23:37:23', '9537431675'),
(6, 'Sumit Patel', 'sumit@gmail.com', NULL, '$2y$12$wH.AmuiSb0pPLTvkR4/T2.oNzouBhGNg3bod7EJTXZUDeKWSTgCWC', NULL, '2026-03-22 02:25:59', '2026-03-22 02:25:59', '+917874984396');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_ride_id_foreign` (`ride_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_ride_id_foreign` (`ride_id`),
  ADD KEY `ratings_given_by_foreign` (`given_by`),
  ADD KEY `ratings_given_to_foreign` (`given_to`);

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rides_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ride_id_foreign` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_given_by_foreign` FOREIGN KEY (`given_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_given_to_foreign` FOREIGN KEY (`given_to`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ride_id_foreign` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rides`
--
ALTER TABLE `rides`
  ADD CONSTRAINT `rides_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
