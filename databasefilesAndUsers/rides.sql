-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 22, 2026 at 09:34 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rides_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rides`
--
ALTER TABLE `rides`
  ADD CONSTRAINT `rides_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
