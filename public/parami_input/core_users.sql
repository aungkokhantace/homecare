-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2017 at 07:16 AM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homecare_db_production`
--

-- --------------------------------------------------------

--
-- Table structure for table `core_users`
--

CREATE TABLE `core_users` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fees` decimal(10,2) DEFAULT NULL,
  `display_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `mobile_image` text COLLATE utf8_unicode_ci,
  `role_id` int(10) UNSIGNED NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_users`
--

INSERT INTO `core_users` (`id`, `name`, `password`, `phone`, `email`, `fees`, `display_image`, `mobile_image`, `role_id`, `address`, `active`, `last_activity`, `remember_token`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('U0001', 'super-admin', 'YWNlcGx1c0AxMjM=', '09123456789', 'waiyanaung@aceplussolutions.com', '0.00', '', NULL, 1, 'Building 5, Room 10, MICT Park, Hlaing Township, Yangon, Myanmar', 1, '2017-01-17 13:19:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('U00010', 'U Paw Htin', 'MTIzQHBhcmFtaQ==', '09254007463, 0973108766', 'win.htin@gmail.com', NULL, '', NULL, 5, 'No 14, Aye Thar Yar Street, Yankin', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:25:37', '2017-01-17 13:25:37', NULL),
('U00011', 'Daw San Shin', 'MTIzQHBhcmFtaQ==', '01662292', 'U00011@gmail.com', NULL, '', NULL, 5, 'No 40, Mya Sabal Street, Mayangone\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:26:31', '2017-01-17 13:26:31', NULL),
('U00012', 'Daw Tin Tin Yee', 'MTIzQHBhcmFtaQ==', '01240146, 0973126439', 'U00012@gmail.com', NULL, '', NULL, 5, 'No 99, Mandalay Street, Kan Daw Lay, Mingala Taungnyunt', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:27:28', '2017-01-17 13:27:28', NULL),
('U00013', 'Daw Tin Sein', 'MTIzQHBhcmFtaQ==', '0931478340, 09791691216', 'U00013@gmail.com', NULL, '', NULL, 5, 'No 2 B, 331, Muditar Housing(2), Insein\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:28:29', '2017-01-17 13:28:29', NULL),
('U00014', 'U Sein Nyunt', 'MTIzQHBhcmFtaQ==', '0931478340 , 09791691216 , 09448044218', 'U00014@gmail.com', NULL, '', NULL, 5, 'No 2 B, 331, Muditar Housing(2), Insein', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:29:26', '2017-01-17 13:29:26', NULL),
('U00015', 'Daw Khin Hla', 'MTIzQHBhcmFtaQ==', '09792226240', 'U00015@gmail.com', NULL, '', NULL, 5, 'No 3, Yoe Dayar Street, Front of 9mile Ocean, Greeen Compound\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:30:45', '2017-01-17 13:30:45', NULL),
('U00016', 'U Aye Ko', 'MTIzQHBhcmFtaQ==', '01521882, 09253050094', 'U00016@gmail.com', NULL, '', NULL, 5, 'Parami Road, Front of Sein Gay Har Parami\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:31:31', '2017-01-17 13:31:31', NULL),
('U00017', 'Daw Wine', 'MTIzQHBhcmFtaQ==', '09250026704, 01222631, 09961276798', 'U00017@gmail.com', NULL, '', NULL, 5, 'No 87B, Pyay Road, Dagon\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:32:16', '2017-01-17 13:32:16', NULL),
('U00018', 'Daw Kyi Kyi', 'MTIzQHBhcmFtaQ==', '095027305', 'U00018@gmail.com', NULL, '', NULL, 5, 'Mya Sabal Road, Mayangone', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:34:28', '2017-01-17 13:34:28', NULL),
('U00019', 'Daw Khin Myo Thant', 'MTIzQHBhcmFtaQ==', '0926218870, 01505916', 'U00019@gmail.com', NULL, '', NULL, 5, 'No F4, Shwe Sabae Housing, Bayint Naung Road, Kamaryut\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:35:21', '2017-01-17 13:35:21', NULL),
('U0002', 'test', 'YWNlcGx1c0AxMjM=', '09123456789', 'test@aceplussolutions.com', '0.00', '', NULL, 2, 'Building 5, Room 10, MICT Park, Hlaing Township, Yangon, Myanmar', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('U00020', 'Daw Htay Htay', 'MTIzQHBhcmFtaQ==', '01664957, 095119714', 'U00020@gmail.com', NULL, '', NULL, 5, 'No 45(Y-1), Tay Nu Yin Road, 7.5 mile, Mayangone\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:36:47', '2017-01-17 13:36:47', NULL),
('U00021', 'Daw Emily Than Htay', 'MTIzQHBhcmFtaQ==', '01664957, 095119714, 09799576322', 'U00021@gmail.com', NULL, '', NULL, 5, 'No 45(Y-1), Tay Nu Yin Road, 7.5 mile, Mayangone\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:37:39', '2017-01-17 13:37:39', NULL),
('U00022', 'U Oo Khin Maung', 'VSBPbyBLaGluIE1hdW5n', '01664957, 095119714, 09799576322', 'U00022@gmail.com', NULL, '', NULL, 5, 'No 45(Y-1), Tay Nu Yin Road, 7.5 mile, Mayangone\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:39:12', '2017-01-17 13:39:12', NULL),
('U00023', 'Daw Mini', 'MTIzQHBhcmFtaQ==', '09795340358', 'U00023@gmail.com', NULL, '', NULL, 5, 'No 37A, Thiri Mingalar Road, Beside AGD Bank\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:40:05', '2017-01-17 13:40:05', NULL),
('U00024', 'Daw Mural Htun Kyaw', 'MTIzQHBhcmFtaQ==', '09971384775 , 09450046358 , 01661428', 'U00024@gmail.com', NULL, '', NULL, 5, '7 mile, Kone Myint Thar Yate Thar Street, 7 Mile Hotel Road\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:41:06', '2017-01-17 13:41:06', NULL),
('U00025', 'Daw Than Than', 'MTIzQHBhcmFtaQ==', '095019926, 09250903396', 'U00025@gmail.com', NULL, '', NULL, 5, 'No 714, Marlar Maying condo,7th floor, Marlar Maying Street, Pyay road\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:42:31', '2017-01-17 13:42:31', NULL),
('U00026', 'Daw Than Than Myint', 'MTIzQHBhcmFtaQ==', '01222726', 'U00026@gmail.com', NULL, '', NULL, 5, 'U Kaung Street, Kye Myin Taing, Front of Orange Market', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:43:27', '2017-01-17 13:43:27', NULL),
('U00027', 'Daw Tin Mu Aung', 'MTIzQHBhcmFtaQ==', '09421035343', 'U00027@gmail.com', NULL, '', NULL, 5, 'No 7EF, 7th floor, Kaba aye kamone pwint condo, Kabaraye street\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:44:20', '2017-01-17 13:44:20', NULL),
('U00028', 'Daw Khin Khin Aye', 'MTIzQHBhcmFtaQ==', '095193019, 01666753', 'Dubern.yangon@gmail.com', NULL, '', NULL, 5, 'No 4D, Parami Road, Mayangone\r\n', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:45:45', '2017-01-17 13:45:45', NULL),
('U0003', 'MO 1', 'MTIzQHBhcmFtaQ==', '09111111111', 'mo1@gmail.com', '0.00', '', NULL, 6, 'Yangon', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 11:48:13', '2017-01-17 11:48:13', NULL),
('U0004', 'MO 2', 'MTIzQHBhcmFtaQ==', '092222222', 'mo2@gmail.com', '0.00', '', NULL, 6, 'Yangon', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 11:48:46', '2017-01-17 11:48:46', NULL),
('U0005', 'MO 3', 'MTIzQHBhcmFtaQ==', '0933333333', 'mo3@gmail.com', '0.00', '', NULL, 6, 'Yangon', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 11:49:20', '2017-01-17 11:49:20', NULL),
('U0006', 'Nurse 1', 'MTIzQHBhcmFtaQ==', '0944444444', 'nurse1@gmail.com', '0.00', '', NULL, 8, 'Yangon', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 11:49:57', '2017-01-17 11:49:57', NULL),
('U0007', 'Nurse 2', 'MTIzQHBhcmFtaQ==', '0955555555555', 'nurse2@gmail.com', '0.00', '', NULL, 8, 'Yangon', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 11:50:29', '2017-01-17 11:50:29', NULL),
('U0008', 'Nurse 3', 'MTIzQHBhcmFtaQ==', '0966666666', 'nurse3@gmail.com', '0.00', '', NULL, 8, 'Yangon', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 11:51:20', '2017-01-17 11:51:20', NULL),
('U0009', 'U Myint Soe', 'MTIzQHBhcmFtaQ==', '095027305', 'U0009@gmail.com', NULL, '', NULL, 5, 'No 36, Mya Sabal Street, Mayangone', 1, NULL, NULL, 'U0001', 'U0001', NULL, '2017-01-17 13:24:07', '2017-01-17 13:24:07', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `core_users`
--
ALTER TABLE `core_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `core_users_email_unique` (`email`),
  ADD KEY `core_users_role_id_foreign` (`role_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `core_users`
--
ALTER TABLE `core_users`
  ADD CONSTRAINT `core_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `core_roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
