-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2018 at 06:58 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ait`
--

-- --------------------------------------------------------

--
-- Table structure for table `ait`
--

CREATE TABLE `ait` (
  `id` int(10) UNSIGNED NOT NULL,
  `head_id` int(11) NOT NULL,
  `deduction_authority` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_beneficiary` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tin` bigint(12) NOT NULL,
  `amount` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `chalan_no` int(11) DEFAULT NULL,
  `payment_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chalan_date` date DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `office_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` datetime DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ait`
--

INSERT INTO `ait` (`id`, `head_id`, `deduction_authority`, `name_of_beneficiary`, `tin`, `amount`, `chalan_no`, `payment_code`, `chalan_date`, `bank_id`, `branch_id`, `office_id`, `created_by`, `created_at`, `deleted_by`, `deleted_at`, `status`) VALUES
(1, 11, 'square', NULL, 123456123451, '231', NULL, '2', '2017-11-20', NULL, NULL, 5, 24, '2017-11-24 18:32:25', NULL, NULL, 1),
(2, 10, 'square', 'jeeku', 123456123456, '200', 300, '2', '2012-01-20', 1, 1, 4, 24, '2017-11-25 02:29:40', NULL, NULL, 1),
(3, 10, 'dhaka-bank', NULL, 123456789120, '201', NULL, '2', '2017-02-01', NULL, NULL, 4, 24, '2017-11-29 09:09:54', NULL, NULL, 1),
(4, 11, 'brack-bank', NULL, 123456789321, '311', NULL, '2', '2017-10-22', NULL, NULL, 4, 24, '2017-11-29 09:11:27', NULL, NULL, 1),
(5, 10, 'duch-bangla-bank', NULL, 123456123456, '350', NULL, '2', '2017-11-20', NULL, NULL, 4, 24, '2017-11-29 10:10:51', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, ' Janota', 1, '2017-10-02 11:02:14', '2017-10-02'),
(2, 'Sonali Bank', 1, '2017-10-02 11:02:27', '2017-10-02'),
(3, ' Rupali Bank', 1, '2017-10-02 11:02:43', '2017-10-02'),
(4, 'Agronee', 1, '2017-10-02 11:03:00', '2017-10-02'),
(5, 'Bank', 1, '2017-10-02 12:28:19', '2017-10-02'),
(6, 'Bank3', 1, '2017-10-02 12:28:33', '2017-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `bank_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Janota Bank, Gulshan Shakha', 1, 1, '2017-10-22 13:47:27', '2017-10-02 18:20:10'),
(2, 'Sonali Bank, Gulshan', 2, 1, '2017-10-22 13:47:30', '2017-10-02 18:20:32'),
(3, 'Rupali Bank, Uttra', 3, 1, '2017-10-22 13:47:34', '2017-10-02 18:22:06'),
(4, ' Agronee Bank , Uttra', 4, 1, '2017-10-22 13:47:37', '2017-10-02 18:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `head`
--

CREATE TABLE `head` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `head`
--

INSERT INTO `head` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Head 2', 1, '2017-10-02 10:42:49', '2017-10-02 16:42:49'),
(11, 'Head 3', 1, '2017-10-02 10:43:00', '2017-10-02 16:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_02_22_082220_create_hearing_table', 1),
('2017_03_07_214318_create_users_activation_table', 1),
('2017_03_10_235830_create_discrepancy_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_access_permision`
--

CREATE TABLE `module_access_permision` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `read_access` tinyint(11) DEFAULT NULL,
  `write_access` tinyint(11) DEFAULT NULL,
  `edit_access` int(11) NOT NULL,
  `delete_access` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_access_permision`
--

INSERT INTO `module_access_permision` (`id`, `user_id`, `module_id`, `read_access`, `write_access`, `edit_access`, `delete_access`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(27, 29, 1, 1, 1, 1, 1, '2018-01-04 14:25:36', NULL, NULL, NULL),
(28, 29, 2, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(29, 29, 3, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(30, 29, 4, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(31, 29, 5, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(32, 29, 6, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(33, 29, 7, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(34, 29, 8, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(35, 29, 9, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(36, 29, 10, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(37, 29, 11, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(38, 29, 12, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(39, 29, 14, 0, 0, 0, 0, '2018-01-04 14:25:36', NULL, NULL, NULL),
(40, 24, 1, 1, 1, 1, 1, '2018-01-05 09:52:55', NULL, NULL, NULL),
(41, 24, 2, 1, 1, 1, 1, '2018-01-05 09:52:59', NULL, NULL, NULL),
(42, 24, 3, 1, 1, 1, 1, '2018-01-05 09:53:01', NULL, NULL, NULL),
(43, 24, 4, 1, 1, 1, 1, '2018-01-05 09:53:03', NULL, NULL, NULL),
(44, 24, 5, 1, 1, 1, 1, '2018-01-05 09:53:07', NULL, NULL, NULL),
(45, 24, 6, 1, 1, 1, 1, '2018-01-05 09:53:08', NULL, NULL, NULL),
(46, 24, 7, 1, 1, 1, 1, '2018-01-05 09:53:19', NULL, NULL, NULL),
(47, 24, 8, 1, 1, 1, 1, '2018-01-05 09:53:23', NULL, NULL, NULL),
(48, 24, 9, 1, 1, 1, 1, '2018-01-05 09:53:25', NULL, NULL, NULL),
(49, 24, 10, 1, 1, 1, 1, '2018-01-05 09:53:27', NULL, NULL, NULL),
(50, 24, 11, 1, 1, 1, 1, '2018-01-05 09:53:29', NULL, NULL, NULL),
(51, 24, 12, 1, 1, 1, 1, '2018-01-05 09:53:31', NULL, NULL, NULL),
(52, 24, 14, 1, 1, 1, 1, '2018-01-05 09:53:33', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module_register`
--

CREATE TABLE `module_register` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_register`
--

INSERT INTO `module_register` (`id`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'AitApproveController', '2018-01-01 08:56:35', '0000-00-00', 0),
(2, 'AitController', '2018-01-01 08:57:26', '0000-00-00', 0),
(3, 'BankController', '2018-01-01 08:57:26', '0000-00-00', 0),
(4, 'BranchController', '2018-01-01 08:58:01', '0000-00-00', 0),
(5, 'HeadController', '2018-01-01 08:58:01', '0000-00-00', 0),
(6, 'HearingController', '2018-01-01 08:58:34', '0000-00-00', 0),
(7, 'ModuleController', '2018-01-01 08:58:34', '0000-00-00', 0),
(8, 'OfficeController', '2018-01-01 08:58:58', '0000-00-00', 0),
(9, 'PaymentcodeController', '2018-01-01 08:58:58', '0000-00-00', 0),
(10, 'ProfileController', '2018-01-05 09:10:50', NULL, 0),
(11, 'ReportController', '2018-01-05 09:10:54', NULL, 0),
(12, 'UsersController', '2018-01-05 09:10:57', '2018-01-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`id`, `parent_id`, `name`, `order_by`, `status`) VALUES
(1, NULL, 'Commissioner Office', 1, NULL),
(2, 1, 'Range Office 1', 0, NULL),
(3, 1, 'Range Office 2', 0, NULL),
(4, 2, 'Circle Office 1', 0, NULL),
(5, 2, 'Circle Office 2', 0, NULL),
(6, 3, 'Circle Office 3', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_code`
--

CREATE TABLE `payment_code` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_code`
--

INSERT INTO `payment_code` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '231654987', NULL, '2017-11-23 11:07:33', '2017-11-23 11:07:33'),
(2, '65464732134', NULL, '2017-11-22 10:03:51', '0000-00-00 00:00:00'),
(3, ' 123456', NULL, '2017-11-23 11:09:44', '2017-11-23 11:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` tinyint(1) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_activated` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `user_type`, `name`, `password`, `remember_token`, `office_id`, `create_at`, `is_activated`) VALUES
(24, 'smfarhad', 1, 'SM Farhad Hossain', '$2y$10$pxdiQWgw2WuPBZQdbMXYge30VOlcOEwnUFzk5dDcdiL4oWKRtbhSS', 'TxurQJglanAX5Nz99I00nbmwJz7KhRQ3PwACCXJ9maTdzJFTmPUkDXcTPBKS', 1, '2018-01-05 09:53:38', 1),
(27, 'jeeku', 2, 'SM Farhad Hossain  ', '$2y$10$QwtPRij9RcGhjy1GhoUEZe/fpUwxkKJ0.ObIpJmCj9yq8eDMb5TOq', 's7tEcOI3lhi0SJLJrwr2zuAPStL6Zi', 2, '2017-10-29 09:15:42', 1),
(29, 'tanvirr', 2, 'Tanvir Sulrtan', '$2y$10$xG1fKcBUdhJJu2fmcn4E1u1mHV9iQcNUQNatbi5v.LV3I4YemoWAi', '4MO0EdFRipy9SjJebh8AYn6P16MM99', 5, '2017-10-29 09:54:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_activations`
--

CREATE TABLE `user_activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_activations`
--

INSERT INTO `user_activations` (`id`, `id_user`, `token`, `created_at`) VALUES
(18, 24, 'KePV6Ic2xACUNvkM2sQBghlYAq9Qnt', '2017-10-29 08:55:56'),
(21, 27, 's7tEcOI3lhi0SJLJrwr2zuAPStL6Zi', '2017-10-29 09:15:42'),
(23, 29, '4MO0EdFRipy9SjJebh8AYn6P16MM99', '2017-10-29 09:37:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ait`
--
ALTER TABLE `ait`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `head`
--
ALTER TABLE `head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_access_permision`
--
ALTER TABLE `module_access_permision`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_register`
--
ALTER TABLE `module_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_code`
--
ALTER TABLE `payment_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activations_id_user_foreign` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ait`
--
ALTER TABLE `ait`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `head`
--
ALTER TABLE `head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `module_access_permision`
--
ALTER TABLE `module_access_permision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `module_register`
--
ALTER TABLE `module_register`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `payment_code`
--
ALTER TABLE `payment_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user_activations`
--
ALTER TABLE `user_activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD CONSTRAINT `user_activations_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
