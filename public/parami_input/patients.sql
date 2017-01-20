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
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nrc_no` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `patient_type_id` int(11) NOT NULL,
  `gender` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `township_id` int(10) UNSIGNED NOT NULL,
  `zone_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `remark` text COLLATE utf8_unicode_ci NOT NULL,
  `case_scenario` text COLLATE utf8_unicode_ci,
  `having_allergy` tinyint(4) DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`user_id`, `name`, `nrc_no`, `email`, `patient_type_id`, `gender`, `phone_no`, `address`, `township_id`, `zone_id`, `dob`, `remark`, `case_scenario`, `having_allergy`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('U0009', 'U Myint Soe', '', 'U0009@gmail.com', 1, 'male', '095027305', 'No 36, Mya Sabal Street, Mayangone', 23, 3, '1977-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:24:07', '2017-01-17 13:24:07', NULL),
('U00010', 'U Paw Htin', '', 'win.htin@gmail.com', 1, 'male', '09254007463, 0973108766', 'No 14, Aye Thar Yar Street, Yankin', 43, 5, '1972-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:25:37', '2017-01-17 13:25:37', NULL),
('U00011', 'Daw San Shin', '', 'U00011@gmail.com', 1, 'female', '01662292', 'No 40, Mya Sabal Street, Mayangone\r\n', 23, 3, '1979-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:26:31', '2017-01-17 13:27:40', NULL),
('U00012', 'Daw Tin Tin Yee', '', 'U00012@gmail.com', 1, 'female', '01240146, 0973126439', 'No 99, Mandalay Street, Kan Daw Lay, Mingala Taungnyunt', 24, 3, '1982-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:27:28', '2017-01-17 13:27:28', NULL),
('U00013', 'Daw Tin Sein', '', 'U00013@gmail.com', 1, 'female', '0931478340, 09791691216', 'No 2 B, 331, Muditar Housing(2), Insein\r\n', 13, 2, '1967-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:28:29', '2017-01-17 13:28:29', NULL),
('U00014', 'U Sein Nyunt', '', 'U00014@gmail.com', 1, 'male', '0931478340 , 09791691216 , 09448044218', 'No 2 B, 331, Muditar Housing(2), Insein', 13, 2, '1973-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:29:26', '2017-01-17 13:29:26', NULL),
('U00015', 'Daw Khin Hla', '', 'U00015@gmail.com', 1, 'female', '09792226240', 'No 3, Yoe Dayar Street, Front of 9mile Ocean, Greeen Compound\r\n', 23, 3, '1980-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:30:45', '2017-01-17 13:30:45', NULL),
('U00016', 'U Aye Ko', '', 'U00016@gmail.com', 1, 'male', '01521882, 09253050094', 'Parami Road, Front of Sein Gay Har Parami\r\n', 8, 1, '1967-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:31:31', '2017-01-17 13:31:31', NULL),
('U00017', 'Daw Wine', '', 'U00017@gmail.com', 1, 'female', '09250026704, 01222631, 09961276798', 'No 87B, Pyay Road, Dagon\r\n', 5, 1, '1957-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:32:16', '2017-01-17 13:32:16', NULL),
('U00018', 'Daw Kyi Kyi', '', 'U00018@gmail.com', 1, 'female', '095027305', 'Mya Sabal Road, Mayangone', 23, 3, '1961-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:34:28', '2017-01-17 13:34:28', NULL),
('U00019', 'Daw Khin Myo Thant', '', 'U00019@gmail.com', 1, 'female', '0926218870, 01505916', 'No F4, Shwe Sabae Housing, Bayint Naung Road, Kamaryut\r\n', 14, 2, '1987-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:35:21', '2017-01-17 13:37:58', NULL),
('U00020', 'Daw Htay Htay', '', 'U00020@gmail.com', 1, 'female', '01664957, 095119714', 'No 45(Y-1), Tay Nu Yin Road, 7.5 mile, Mayangone\r\n', 23, 3, '1979-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:36:47', '2017-01-17 13:38:09', NULL),
('U00021', 'Daw Emily Than Htay', '', 'U00021@gmail.com', 1, 'female', '01664957, 095119714, 09799576322', 'No 45(Y-1), Tay Nu Yin Road, 7.5 mile, Mayangone\r\n', 23, 3, '1983-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:37:39', '2017-01-17 13:37:39', NULL),
('U00022', 'U Oo Khin Maung', '', 'U00022@gmail.com', 1, 'male', '01664957, 095119714, 09799576322', 'No 45(Y-1), Tay Nu Yin Road, 7.5 mile, Mayangone\r\n', 23, 3, '1971-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:39:12', '2017-01-17 13:39:12', NULL),
('U00023', 'Daw Mini', '', 'U00023@gmail.com', 1, 'female', '09795340358', 'No 37A, Thiri Mingalar Road, Beside AGD Bank\r\n', 14, 2, '1987-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:40:05', '2017-01-17 13:40:05', NULL),
('U00024', 'Daw Mural Htun Kyaw', '', 'U00024@gmail.com', 1, 'female', '09971384775 , 09450046358 , 01661428', '7 mile, Kone Myint Thar Yate Thar Street, 7 Mile Hotel Road\r\n', 23, 3, '1982-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:41:06', '2017-01-17 13:41:06', NULL),
('U00025', 'Daw Than Than', '', 'U00025@gmail.com', 1, 'female', '095019926, 09250903396', 'No 714, Marlar Maying condo,7th floor, Marlar Maying Street, Pyay road\r\n', 14, 2, '1975-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:42:31', '2017-01-17 13:42:31', NULL),
('U00026', 'Daw Than Than Myint', '', 'U00026@gmail.com', 1, 'female', '01222726', 'U Kaung Street, Kye Myin Taing, Front of Orange Market', 20, 2, '1968-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:43:27', '2017-01-17 13:43:27', NULL),
('U00027', 'Daw Tin Mu Aung', '', 'U00027@gmail.com', 1, 'female', '09421035343', 'No 7EF, 7th floor, Kaba aye kamone pwint condo, Kabaraye street\r\n', 23, 3, '1970-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:44:20', '2017-01-17 13:44:20', NULL),
('U00028', 'Daw Khin Khin Aye', '', 'Dubern.yangon@gmail.com', 1, 'female', '095193019, 01666753', 'No 4D, Parami Road, Mayangone\r\n', 23, 3, '1984-01-01', '', '', 0, 'U0001', 'U0001', NULL, '2017-01-17 13:45:45', '2017-01-17 13:45:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD KEY `patients_user_id_foreign` (`user_id`),
  ADD KEY `patients_township_id_foreign` (`township_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_township_id_foreign` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`),
  ADD CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `core_users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
