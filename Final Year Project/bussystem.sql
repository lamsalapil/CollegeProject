-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 04:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bussystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `seat_number` int(11) NOT NULL COMMENT 'Seats number choosen from bus',
  `booking_date` datetime NOT NULL,
  `booking_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Not Paid/ 1=Paid',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `seat_number`, `booking_date`, `booking_status`, `payment_method`, `total_price`, `payment_id`, `schedule_id`, `coupon_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2023-04-12 04:26:30', 0, 'COD', 20.00, NULL, 1, NULL, '2023-04-11 22:41:30', '2023-04-11 22:41:30'),
(2, 2, 2, '2023-04-12 04:32:35', 0, 'COD', 20.00, NULL, 1, NULL, '2023-04-11 22:47:35', '2023-04-11 22:47:35'),
(3, 2, 5, '2023-04-12 05:11:15', 0, 'COD', 50.00, NULL, 1, NULL, '2023-04-11 23:26:15', '2023-04-11 23:26:15'),
(4, 6, 1, '2023-04-15 04:22:06', 0, 'COD', 10.00, NULL, 1, NULL, '2023-04-14 22:37:06', '2023-04-14 22:37:06'),
(5, 6, 1, '2023-04-15 04:32:51', 0, 'COD', 10.00, NULL, 1, NULL, '2023-04-14 22:47:51', '2023-04-14 22:47:51'),
(6, 6, 1, '2023-04-15 04:35:41', 0, 'COD', 10.00, NULL, 1, NULL, '2023-04-14 22:50:41', '2023-04-14 22:50:41'),
(7, 6, 1, '2023-04-15 04:52:03', 0, 'COD', 10.00, NULL, 1, NULL, '2023-04-14 23:07:03', '2023-04-14 23:07:03'),
(8, 6, 6, '2023-04-15 05:25:09', 0, 'COD', 60.00, NULL, 2, NULL, '2023-04-14 23:40:09', '2023-04-14 23:40:09'),
(9, 6, 2, '2023-04-15 07:48:13', 0, 'COD', 20.00, NULL, 1, NULL, '2023-04-15 02:03:13', '2023-04-15 02:03:13'),
(10, 6, 1, '2023-04-17 02:37:03', 0, 'COD', 10.00, NULL, 1, NULL, '2023-04-16 20:52:03', '2023-04-16 20:52:03'),
(11, 6, 1, '2023-04-17 02:48:00', 0, 'COD', 10.00, NULL, 1, NULL, '2023-04-16 21:03:00', '2023-04-16 21:03:00'),
(12, 6, 1, '2023-04-17 02:53:41', 0, 'COD', 10.00, NULL, 1, NULL, '2023-04-16 21:08:41', '2023-04-16 21:08:41'),
(13, 6, 1, '2023-04-17 02:55:09', 0, 'COD', 10.00, NULL, 1, NULL, '2023-04-16 21:10:09', '2023-04-16 21:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bus_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bus_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bus_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Not Show/ 1=Show',
  `number_of_seats` int(11) DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_name`, `bus_number`, `bus_status`, `number_of_seats`, `driver_id`, `created_at`, `updated_at`) VALUES
(1, 'Nepal Bus', 'Ga-2-pa-4444', 1, 11, 4, '2023-04-11 19:48:09', '2023-04-16 21:10:09'),
(2, 'Annapurna bus', 'Ga-2-pa-2134', 1, 24, 4, '2023-04-11 20:02:44', '2023-04-14 23:40:09'),
(3, 'Hill Tour and Travels', 'Ga-3-pa-21', 1, 30, 4, '2023-04-11 20:03:48', '2023-04-11 20:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `messages` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_coupon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_limited_quantity` int(10) UNSIGNED DEFAULT 10,
  `price_coupon` int(11) DEFAULT NULL,
  `valid_from` datetime NOT NULL,
  `valid_until` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Not Show/ 1=Show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `name`, `address`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'pokhara', 'Bharitpur', '27.694229121579', '-275.5630302429', '2023-04-11 19:58:57', '2023-04-11 19:58:57'),
(2, 'kathmandu bus park', 'kathmandu', '27.700065616250', '-274.6636962890', '2023-04-11 19:59:34', '2023-04-11 19:59:34'),
(3, 'Baglung bus park', 'pokhara', '28.177591436697', '84.001464843750', '2023-04-11 20:00:15', '2023-04-11 20:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bus_id` bigint(20) UNSIGNED NOT NULL,
  `user_feedback` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_buses`
--

CREATE TABLE `image_buses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bus_id` bigint(20) UNSIGNED NOT NULL,
  `image_bus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_buses`
--

INSERT INTO `image_buses` (`id`, `bus_id`, `image_bus`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin/upload/img-bus/16812631891.png', '2023-04-11 19:48:09', '2023-04-11 19:48:09'),
(2, 2, 'admin/upload/img-bus/16812640641.jpg', '2023-04-11 20:02:44', '2023-04-11 20:02:44'),
(3, 3, 'admin/upload/img-bus/16812641281.jpg', '2023-04-11 20:03:48', '2023-04-11 20:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_08_01_070452_create_roles_table', 1),
(5, '2022_08_01_103413_create_users_table', 1),
(6, '2022_08_03_111627_create_buses_table', 1),
(7, '2022_08_08_061050_create_image_buses_table', 1),
(8, '2022_08_09_115729_create_start_destination_table', 1),
(9, '2022_08_09_120037_create_destination_table', 1),
(10, '2022_08_12_105912_create_schdules_table', 1),
(11, '2022_08_12_110351_add_column_to_schdules_table', 1),
(12, '2022_08_16_083128_change_estimatedtime_data_type', 1),
(13, '2022_08_17_072035_change_estimatedtime_data2_type', 1),
(14, '2022_08_17_080959_create_coupons_table', 1),
(15, '2022_08_25_070213_add_column_to_schdules_table', 1),
(16, '2022_08_26_073209_change_datetype_columns_pricecoupon', 1),
(17, '2022_08_30_060136_create_bookings_table', 1),
(18, '2022_09_05_065254_add_column_to_schdules_table', 1),
(19, '2022_09_12_012101_drop_column_schdules_table', 1),
(20, '2022_09_12_013007_drop_title_column_booking_table', 1),
(21, '2022_09_13_102909_edit_column_bookings_table', 1),
(22, '2022_09_15_122915_add_columns_to_bookings_table', 1),
(23, '2022_09_18_073215_create_ratings_table', 1),
(24, '2022_09_19_014447_create_feedbacks_table', 1),
(25, '2022_09_19_081203_create_jobs_table', 1),
(26, '2022_09_22_110915_create_contracts_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bus_id` bigint(20) UNSIGNED NOT NULL,
  `stars_rating` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-04-11 19:40:12', '2023-04-11 19:40:12'),
(2, 'user', '2023-04-11 19:40:12', '2023-04-11 19:40:12'),
(3, 'driver', '2023-04-11 19:40:12', '2023-04-11 19:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `schdules`
--

CREATE TABLE `schdules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bus_id` bigint(20) UNSIGNED NOT NULL,
  `start_at` datetime NOT NULL,
  `start_destination_id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `estimated_arrival_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance` double(8,2) NOT NULL,
  `price_schedules` int(11) DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `empty_seats_amount` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schdules`
--

INSERT INTO `schdules` (`id`, `bus_id`, `start_at`, `start_destination_id`, `destination_id`, `estimated_arrival_time`, `distance`, `price_schedules`, `notes`, `created_at`, `updated_at`, `empty_seats_amount`) VALUES
(1, 1, '2023-04-13 06:00:00', 1, 2, '0', 0.00, 10, 'travel safe', '2023-04-11 20:00:55', '2023-04-11 20:00:55', 0),
(2, 2, '2023-04-13 12:00:00', 1, 2, '0', 0.00, 10, 'd', '2023-04-11 23:09:53', '2023-04-11 23:09:53', 0),
(3, 2, '2023-04-14 07:00:00', 1, 2, '0', 0.00, 10, 'travel safe', '2023-04-11 23:36:30', '2023-04-11 23:36:30', 0),
(4, 1, '2023-04-15 06:00:00', 1, 2, '0', 0.00, 10, 'travel safe', '2023-04-11 23:37:11', '2023-04-11 23:37:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `start_destination`
--

CREATE TABLE `start_destination` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `start_destination`
--

INSERT INTO `start_destination` (`id`, `name`, `address`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'pokhara', 'pokhara', '28.206277368961', '443.98910522460', '2023-04-11 19:56:05', '2023-04-11 19:56:05'),
(2, 'kathmandu bus park', 'kathmandu', '27.713561291523', '445.32119750976', '2023-04-11 19:57:09', '2023-04-11 19:57:09');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'M=Male, F=Female, O=Other',
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `address`, `gender`, `phone_number`, `date_of_birth`, `role_id`, `avatar`, `is_banned`, `created_at`, `updated_at`) VALUES
(1, 'apil', 'apil@gmail.com', NULL, '$2y$10$0CmXEuw2HkTyQZBm9tF5qOUJpagqbQUA2R7nIkzxDvY9t.5a8qGU6', NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, '2023-04-11 19:41:32', '2023-04-11 19:41:32'),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$10$0CmXEuw2HkTyQZBm9tF5qOUJpagqbQUA2R7nIkzxDvY9t.5a8qGU6', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, '2023-04-12 01:28:00', '2023-04-12 01:28:00'),
(4, 'bijay', 'bijay@gmail.com', NULL, '$2y$10$Y1HPSXuGbnIg1kGyX21qjOgLLNlNfg4Xs4BjrdnMZwCYcHgCqzTfy', NULL, 'pokhara 3', 'M', '9814124254', '2017-04-19', 3, '1681263110.jpg', 0, '2023-04-11 19:46:51', '2023-04-11 19:46:51'),
(5, 'ishwor', 'ishwor@gmail.com', NULL, '$2y$10$anT4Vb/hG2t7SndTrfZjtedkIupaf1h2ZFiwL7RCFEn2llqk9e7I6', NULL, 'pokhara', 'M', '9814157567', '1994-04-14', 3, '1681264477.jpg', 0, '2023-04-11 20:09:37', '2023-04-11 20:10:16'),
(6, 'user', 'user1@gmail.com', NULL, '$2y$10$4RkPyqyncIxRTdDijUrjY.vAWodIChNC1OHX5G9.iMVHuxXOzFLjm', NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, '2023-04-14 22:36:44', '2023-04-14 22:36:44'),
(7, 'apil', 'apil1@gmail.com', NULL, '$2y$10$BObedceBxohq8cyOtw9PeesygU3n3zTKS4NldryJp4lKEYCqIcAIC', NULL, 'pokhara', 'M', '9804116597', '2000-02-02', 3, '1681563534.jpg', 0, '2023-04-15 07:13:54', '2023-04-15 07:13:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_schedule_id_foreign` (`schedule_id`),
  ADD KEY `bookings_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buses_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedbacks_user_id_foreign` (`user_id`),
  ADD KEY `feedbacks_bus_id_foreign` (`bus_id`);

--
-- Indexes for table `image_buses`
--
ALTER TABLE `image_buses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_buses_bus_id_foreign` (`bus_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_bus_id_foreign` (`bus_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `schdules`
--
ALTER TABLE `schdules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schdules_bus_id_foreign` (`bus_id`),
  ADD KEY `schdules_start_destination_id_foreign` (`start_destination_id`),
  ADD KEY `schdules_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `start_destination`
--
ALTER TABLE `start_destination`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_buses`
--
ALTER TABLE `image_buses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schdules`
--
ALTER TABLE `schdules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `start_destination`
--
ALTER TABLE `start_destination`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schdules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `buses`
--
ALTER TABLE `buses`
  ADD CONSTRAINT `buses_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `image_buses`
--
ALTER TABLE `image_buses`
  ADD CONSTRAINT `image_buses_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schdules`
--
ALTER TABLE `schdules`
  ADD CONSTRAINT `schdules_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schdules_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schdules_start_destination_id_foreign` FOREIGN KEY (`start_destination_id`) REFERENCES `start_destination` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
