-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2017 at 07:17 AM
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
-- Table structure for table `allergies`
--

CREATE TABLE `allergies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `allergies`
--

INSERT INTO `allergies` (`id`, `name`, `type`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Peanuts', 'food', 'Peanuts Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(2, 'Milk', 'food', 'Milk Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(3, 'Eggs', 'food', 'Eggs Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(4, 'Nuts', 'food', 'Nuts Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(5, 'Fish', 'food', 'Fish Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(6, 'Shellfish', 'food', 'Shellfish Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(7, 'Soy', 'food', 'Soy Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(8, 'Wheat', 'food', 'Wheat Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(9, 'Amoxicillin (Anitbiotics)', 'drug', 'Amoxicillin Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(10, 'Ampicillin (Anitbiotics)', 'drug', 'Ampicillin Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(11, 'Penicillin (Anitbiotics)', 'drug', 'Penicillin Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(12, 'Tetracycline (Anitbiotics)', 'drug', 'Tetracycline Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(13, 'NSAIDs', 'drug', 'NSAIDs Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(14, 'Septrin (Sulfa Drugs)', 'drug', 'Septrin Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(15, 'Anti-malarials (Sulfa Drugs)', 'drug', 'Anti-malarials Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(16, 'Cetuximab (Monoclonal antibody therapy)', 'drug', 'Cetuximab Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(17, 'Rituximab (Monoclonal antibody therapy)', 'drug', 'Rituximab Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(18, 'Abacavir (HIV drugs)', 'drug', 'Abacavir Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(19, 'Nevirapine (HIV drugs)', 'drug', 'Nevirapine Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(20, 'Insulin', 'drug', 'Insulin Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(21, 'Carbamazepine (Antiseizure Drugs)', 'drug', 'Carbamazepine Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(22, 'Lamotrigine (Antiseizure Drugs)', 'drug', 'Lamotrigine Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(23, 'Phenytoin (Antiseizure Drugs)', 'drug', 'Phenytoin Allergy', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `car_types`
--

CREATE TABLE `car_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `car_types`
--

INSERT INTO `car_types` (`id`, `name`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ambulance', '', 'U0001', 'U0001', NULL, '2017-01-17 11:24:28', '2017-01-17 11:24:28', NULL),
(2, 'Taxi', '', 'U0001', 'U0001', NULL, '2017-01-17 11:24:33', '2017-01-17 11:24:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `car_type_setup`
--

CREATE TABLE `car_type_setup` (
  `id` int(10) UNSIGNED NOT NULL,
  `car_type_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `patient_type_id` int(11) DEFAULT NULL,
  `zone_id` int(11) NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `car_type_setup`
--

INSERT INTO `car_type_setup` (`id`, `car_type_id`, `price`, `patient_type_id`, `zone_id`, `remark`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '10000.00', 1, 1, '', 'U0001', 'U0001', NULL, '2017-01-17 11:24:46', '2017-01-17 11:24:46', NULL),
(2, 1, '10000.00', 1, 2, '', 'U0001', 'U0001', NULL, '2017-01-17 11:24:52', '2017-01-17 11:24:52', NULL),
(3, 1, '10000.00', 1, 3, '', 'U0001', 'U0001', NULL, '2017-01-17 11:24:59', '2017-01-17 11:24:59', NULL),
(4, 1, '10000.00', 1, 4, '', 'U0001', 'U0001', NULL, '2017-01-17 11:25:07', '2017-01-17 11:25:07', NULL),
(5, 1, '10000.00', 1, 5, '', 'U0001', 'U0001', NULL, '2017-01-17 11:25:15', '2017-01-17 11:25:15', NULL),
(6, 2, '5000.00', 1, 1, '', 'U0001', 'U0001', NULL, '2017-01-17 11:25:24', '2017-01-17 11:25:24', NULL),
(7, 2, '5000.00', 1, 2, '', 'U0001', 'U0001', NULL, '2017-01-17 11:25:31', '2017-01-17 11:25:31', NULL),
(8, 2, '5000.00', 1, 3, '', 'U0001', 'U0001', NULL, '2017-01-17 11:25:37', '2017-01-17 11:25:37', NULL),
(9, 2, '5000.00', 1, 4, '', 'U0001', 'U0001', NULL, '2017-01-17 11:25:43', '2017-01-17 11:25:43', NULL),
(10, 2, '5000.00', 1, 5, '', 'U0001', 'U0001', NULL, '2017-01-17 11:25:49', '2017-01-17 11:25:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Yangon', 'Yangon City', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_configs`
--

CREATE TABLE `core_configs` (
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_configs`
--

INSERT INTO `core_configs` (`code`, `type`, `value`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('LOG_MAX_FILES', 'SETTING', '60', 'Maximum Log File Count', NULL, NULL, NULL, NULL, NULL, NULL),
('SETTING_COMPANY_NAME', 'SETTING', 'AcePlus Backend', 'Company Name', NULL, NULL, NULL, NULL, NULL, NULL),
('SETTING_LOGO', 'SETTING', '/images/logo.png', 'Company Logo', NULL, NULL, NULL, NULL, NULL, NULL),
('SETTING_SITE_ACTIVATION_KEY', 'SETTING', '1234567', 'Site Activation Key', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_permissions`
--

CREATE TABLE `core_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_permissions`
--

INSERT INTO `core_permissions` (`id`, `module`, `name`, `description`, `position`, `url`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Role', 'Listing', 'Role Listing', NULL, 'role', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Role', 'New', 'Role New', NULL, 'role/create', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Role', 'Store', 'Role Store', NULL, 'role/store', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Role', 'Edit', 'Role Edit', NULL, 'role/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Role', 'Update', 'Role Update', NULL, 'role/update', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Role', 'Destroy', 'Role Destroy', NULL, 'role/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Role', 'Permission View', 'Role Permission View', NULL, 'rolePermission', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Role', 'Permission Assign', 'Role Permission Assign', NULL, 'rolePermissionAssign', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'User', 'Listing', 'User Listing', NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'User', 'New', 'User New', NULL, 'user/create', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'User', 'Store', 'User Store', NULL, 'user/store', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'User', 'Edit', 'User Edit', NULL, 'user/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'User', 'Update', 'User Update', NULL, 'user/update', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'User', 'Destroy', 'User Destroy', NULL, 'user/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'User', 'Auth', 'Getting Auth User', NULL, 'userAuth', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'User', 'Profile', 'User Profile', NULL, 'user/profile', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Permission', 'Listing', 'Permission Listing', NULL, 'permission', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Permission', 'New', 'Permission New', NULL, 'permission/create', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Permission', 'Store', 'Permission Store', NULL, 'permission/store', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Permission', 'Edit', 'Permission Edit', NULL, 'permission/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Permission', 'Update', 'Permission Update', NULL, 'permission/update', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Permission', 'Destroy', 'Permission Destroy', NULL, 'permission/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Config', 'View', 'Editing', NULL, 'config', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'City', 'Listing', 'City Listing', NULL, 'city', NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'City', 'New', 'City New', NULL, 'city/create', NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'City', 'Store', 'City Store', NULL, 'city/store', NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'City', 'Edit', 'City Edit', NULL, 'city/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'City', 'Update', 'City Update', NULL, 'city/update', NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'City', 'Destroy', 'City Destroy', NULL, 'city/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Township', 'Listing', 'Township Listing', NULL, 'township', NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Township', 'New', 'Township New', NULL, 'township/create', NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'Township', 'Store', 'Township Store', NULL, 'township/store', NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'Township', 'Edit', 'Township Edit', NULL, 'township/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Township', 'Update', 'Township Update', NULL, 'township/update', NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Township', 'Destroy', 'Township Destroy', NULL, 'township/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Cartype', 'Listing', 'Cartype Listing', NULL, 'cartype', NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Cartype', 'New', 'Cartype New', NULL, 'cartype/create', NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'Cartype', 'Store', 'Cartype Store', NULL, 'cartype/store', NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Cartype', 'Edit', 'Cartype Edit', NULL, 'cartype/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'Cartype', 'Update', 'Cartype Update', NULL, 'cartype/update', NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'Cartype', 'Destroy', 'Cartype Destroy', NULL, 'cartype/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'Zone', 'Listing', 'Zone Listing', NULL, 'zone', NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'Zone', 'New', 'Zone New', NULL, 'zone/create', NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'Zone', 'Store', 'Zone Store', NULL, 'zone/store', NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'Zone', 'Edit', 'Zone Edit', NULL, 'zone/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'Zone', 'Update', 'Zone Update', NULL, 'zone/update', NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'Zone', 'Destroy', 'Zone Destroy', NULL, 'zone/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'Cartypesetup', 'Listing', 'Cartypesetup Listing', NULL, 'cartypesetup', NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'Cartypesetup', 'New', 'Cartypesetup New', NULL, 'cartypesetup/create', NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'Cartypesetup', 'Store', 'Cartypesetup Store', NULL, 'cartypesetup/store', NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'Cartypesetup', 'Edit', 'Cartypesetup Edit', NULL, 'cartypesetup/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'Cartypesetup', 'Update', 'Cartypesetup Update', NULL, 'cartypesetup/update', NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'Cartypesetup', 'Destroy', 'Cartypesetup Destroy', NULL, 'cartypesetup/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(80, 'Product Category', 'Listing', 'Product Category Listing', NULL, 'productcategory', NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'Product Category', 'New', 'Product Category New', NULL, 'productcategory/create', NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'Product Category', 'Store', 'Product Category Store', NULL, 'productcategory/store', NULL, NULL, NULL, NULL, NULL, NULL),
(83, 'Product Category', 'Edit', 'Product Category Edit', NULL, 'productcategory/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(84, 'Product Category', 'Update', 'Product Category Update', NULL, 'productcategory/update', NULL, NULL, NULL, NULL, NULL, NULL),
(85, 'Product Category', 'Destroy', 'Product Category Destroy', NULL, 'productcategory/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(90, 'Product', 'Listing', 'Product Listing', NULL, 'product', NULL, NULL, NULL, NULL, NULL, NULL),
(91, 'Product', 'New', 'Product New', NULL, 'product/create', NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'Product', 'Store', 'Product Store', NULL, 'product/store', NULL, NULL, NULL, NULL, NULL, NULL),
(93, 'Product', 'Edit', 'Product Edit', NULL, 'product/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(94, 'Product', 'Update', 'Product Update', NULL, 'product/update', NULL, NULL, NULL, NULL, NULL, NULL),
(95, 'Product', 'Destroy', 'Product Destroy', NULL, 'product/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'Package', 'Listing', 'Package Listing', NULL, 'package', NULL, NULL, NULL, NULL, NULL, NULL),
(101, 'Package', 'New', 'Package New', NULL, 'package/create', NULL, NULL, NULL, NULL, NULL, NULL),
(102, 'Package', 'Store', 'Package Store', NULL, 'package/store', NULL, NULL, NULL, NULL, NULL, NULL),
(103, 'Package', 'Edit', 'Package Edit', NULL, 'package/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(104, 'Package', 'Update', 'Package Update', NULL, 'package/update', NULL, NULL, NULL, NULL, NULL, NULL),
(105, 'Package', 'Destroy', 'Package Destroy', NULL, 'package/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(110, 'Investigation', 'Listing', 'Investigation Listing', NULL, 'investigation', NULL, NULL, NULL, NULL, NULL, NULL),
(111, 'Investigation', 'New', 'Investigation New', NULL, 'investigation/create', NULL, NULL, NULL, NULL, NULL, NULL),
(112, 'Investigation', 'Store', 'Investigation Store', NULL, 'investigation/store', NULL, NULL, NULL, NULL, NULL, NULL),
(113, 'Investigation', 'Edit', 'Investigation Edit', NULL, 'investigation/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(114, 'Investigation', 'Update', 'Investigation Update', NULL, 'investigation/update', NULL, NULL, NULL, NULL, NULL, NULL),
(115, 'Investigation', 'Destroy', 'Investigation Destroy', NULL, 'investigation/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(120, 'Physical Examination', 'Listing', 'Physical Examination Listing', NULL, 'physicalexam', NULL, NULL, NULL, NULL, NULL, NULL),
(121, 'Physical Examination', 'New', 'Physical Examination New', NULL, 'physicalexam/create', NULL, NULL, NULL, NULL, NULL, NULL),
(122, 'Physical Examination', 'Store', 'Physical Examination Store', NULL, 'physicalexam/store', NULL, NULL, NULL, NULL, NULL, NULL),
(123, 'Physical Examination', 'Edit', 'Physical Examination Edit', NULL, 'physicalexam/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(124, 'Physical Examination', 'Update', 'Physical Examination Update', NULL, 'physicalexam/update', NULL, NULL, NULL, NULL, NULL, NULL),
(125, 'Physical Examination', 'Destroy', 'Physical Examination Destroy', NULL, 'physicalexam/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(130, 'Service', 'Listing', 'Service Listing', NULL, 'service', NULL, NULL, NULL, NULL, NULL, NULL),
(131, 'Service', 'New', 'Service New', NULL, 'service/create', NULL, NULL, NULL, NULL, NULL, NULL),
(132, 'Service', 'Store', 'Service Store', NULL, 'service/store', NULL, NULL, NULL, NULL, NULL, NULL),
(133, 'Service', 'Edit', 'Service Edit', NULL, 'service/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(134, 'Service', 'Update', 'Service Update', NULL, 'service/update', NULL, NULL, NULL, NULL, NULL, NULL),
(135, 'Service', 'Destroy', 'Service Destroy', NULL, 'service/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(140, 'Enquiry', 'Listing', 'Enquiry Listing', NULL, 'enquiry', NULL, NULL, NULL, NULL, NULL, NULL),
(141, 'Enquiry', 'New', 'Enquiry New', NULL, 'enquiry/create', NULL, NULL, NULL, NULL, NULL, NULL),
(142, 'Enquiry', 'Store', 'Enquiry Store', NULL, 'enquiry/store', NULL, NULL, NULL, NULL, NULL, NULL),
(143, 'Enquiry', 'Edit', 'Enquiry Edit', NULL, 'enquiry/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(144, 'Enquiry', 'Update', 'Enquiry Update', NULL, 'enquiry/update', NULL, NULL, NULL, NULL, NULL, NULL),
(145, 'Enquiry', 'Destroy', 'Enquiry Destroy', NULL, 'enquiry/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(146, 'Enquiry', 'Confirm', 'Enquiry Confirm', NULL, 'enquiry/confirm', NULL, NULL, NULL, NULL, NULL, NULL),
(147, 'Enquiry', 'Cancel', 'Enquiry Cancel', NULL, 'enquiry/cancel', NULL, NULL, NULL, NULL, NULL, NULL),
(148, 'Enquiry', 'Search By Filter', 'Enquiry Search', NULL, 'enquiry/search/{enquiry_status?}/{enquiry_case_type?}/{from_date?}/{to_date?}', NULL, NULL, NULL, NULL, NULL, NULL),
(150, 'Allergy', 'Listing', 'Allergy Listing', NULL, 'allergy', NULL, NULL, NULL, NULL, NULL, NULL),
(151, 'Allergy', 'New', 'Allergy New', NULL, 'allergy/create', NULL, NULL, NULL, NULL, NULL, NULL),
(152, 'Allergy', 'Store', 'Allergy Store', NULL, 'allergy/store', NULL, NULL, NULL, NULL, NULL, NULL),
(153, 'Allergy', 'Edit', 'Allergy Edit', NULL, 'allergy/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(154, 'Allergy', 'Update', 'Allergy Update', NULL, 'allergy/update', NULL, NULL, NULL, NULL, NULL, NULL),
(155, 'Allergy', 'Destroy', 'Allergy Destroy', NULL, 'allergy/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(160, 'Patient', 'Listing', 'Patient Listing', NULL, 'patient', NULL, NULL, NULL, NULL, NULL, NULL),
(161, 'Patient', 'New', 'Patient New', NULL, 'patient/create', NULL, NULL, NULL, NULL, NULL, NULL),
(162, 'Patient', 'Store', 'Patient Store', NULL, 'patient/store', NULL, NULL, NULL, NULL, NULL, NULL),
(163, 'Patient', 'Edit', 'Patient Edit', NULL, 'patient/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(164, 'Patient', 'Update', 'Patient Update', NULL, 'patient/update', NULL, NULL, NULL, NULL, NULL, NULL),
(165, 'Patient', 'Destroy', 'Patient Destroy', NULL, 'patient/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(166, 'Patient', 'Check Zone', 'Patient Check Zone', NULL, 'patient/checkzone', NULL, NULL, NULL, NULL, NULL, NULL),
(167, 'Patient', 'Detail', 'Patient Detail', NULL, 'patient/detail', NULL, NULL, NULL, NULL, NULL, NULL),
(170, 'Patient', 'Profile', 'Patient Profile', NULL, 'patient/profile', NULL, NULL, NULL, NULL, NULL, NULL),
(171, 'Patient', 'Case Summary', 'Patient Case Summary', NULL, 'patient/case', NULL, NULL, NULL, NULL, NULL, NULL),
(172, 'Patient', 'Export', 'Patient Export', NULL, 'patient/export', NULL, NULL, NULL, NULL, NULL, NULL),
(173, 'Patient', 'Schedule History', 'Patient Schedule History', NULL, 'patient/schedule', NULL, NULL, NULL, NULL, NULL, NULL),
(174, 'Patient', 'Service History', 'Patient Service History', NULL, 'patient/service', NULL, NULL, NULL, NULL, NULL, NULL),
(175, 'Patient', 'Package History', 'Patient Package History', NULL, 'patient/package', NULL, NULL, NULL, NULL, NULL, NULL),
(176, 'Patient Booking Request', 'Booking Request', 'Patient Booking Request', NULL, 'patient/bookingrequest', NULL, NULL, NULL, NULL, NULL, NULL),
(177, 'Patient Booking Request', 'Booking Request Store', 'Patient Booking Request Store', NULL, 'patient/bookingrequest/store', NULL, NULL, NULL, NULL, NULL, NULL),
(178, 'Patient Invoice', 'Invoice', 'Patient Invoice', NULL, 'patient/invoice', NULL, NULL, NULL, NULL, NULL, NULL),
(179, 'Patient Invoice Detail', 'Invoice Detail', 'Patient Invoice Detail', NULL, 'patient/invoicedetail', NULL, NULL, NULL, NULL, NULL, NULL),
(180, 'Patient Invoice Export', 'Invoice Export', 'Patient Invoice Export', NULL, 'patient/invoice_export', NULL, NULL, NULL, NULL, NULL, NULL),
(181, 'Patient Present Medication', 'Present Medication', 'Patient Present Medication', NULL, 'patient/medication', NULL, NULL, NULL, NULL, NULL, NULL),
(200, 'Schedule', 'Listing', 'Schedule Listing', NULL, 'schedule', NULL, NULL, NULL, NULL, NULL, NULL),
(201, 'Schedule', 'New', 'Schedule New', NULL, 'schedule/create', NULL, NULL, NULL, NULL, NULL, NULL),
(202, 'Schedule', 'Store', 'Schedule Store', NULL, 'schedule/store', NULL, NULL, NULL, NULL, NULL, NULL),
(203, 'Schedule', 'Edit', 'Schedule Edit', NULL, 'schedule/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(204, 'Schedule', 'Update', 'Schedule Update', NULL, 'schedule/update', NULL, NULL, NULL, NULL, NULL, NULL),
(205, 'Schedule', 'Destroy', 'Schedule Destroy', NULL, 'schedule/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(206, 'Schedule', 'Search', 'Schedule Search', NULL, 'schedule/search/{schedule_status?}/{from_date?}/{to_date?}', NULL, NULL, NULL, NULL, NULL, NULL),
(207, 'Schedule', 'Cancel', 'Schedule Cancel', NULL, 'schedule/cancel', NULL, NULL, NULL, NULL, NULL, NULL),
(210, 'Package Sale', 'Listing', 'Package Sale Listing', NULL, 'packagesale', NULL, NULL, NULL, NULL, NULL, NULL),
(211, 'Package Sale', 'New', 'Package Sale New', NULL, 'packagesale/create', NULL, NULL, NULL, NULL, NULL, NULL),
(212, 'Package Sale', 'Store', 'Package Sale Store', NULL, 'packagesale/store', NULL, NULL, NULL, NULL, NULL, NULL),
(213, 'Package Sale', 'Invoice', 'Package Sale Edit', NULL, 'packagesale/invoice', NULL, NULL, NULL, NULL, NULL, NULL),
(214, 'Package Sale', 'Export', 'Package Sale Update', NULL, 'packagesale/export', NULL, NULL, NULL, NULL, NULL, NULL),
(215, 'Package Sale', 'Schedule', 'Package Sale Destroy', NULL, 'packagesale/schedule', NULL, NULL, NULL, NULL, NULL, NULL),
(220, 'Family History', 'Listing', 'Family History Listing', NULL, 'familyhistory', NULL, NULL, NULL, NULL, NULL, NULL),
(221, 'Family History', 'New', 'Family History New', NULL, 'familyhistory/create', NULL, NULL, NULL, NULL, NULL, NULL),
(222, 'Family History', 'Store', 'Family History History Store', NULL, 'familyhistory/store', NULL, NULL, NULL, NULL, NULL, NULL),
(223, 'Family History', 'Edit', 'Family History Edit', NULL, 'familyhistory/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(224, 'Family History', 'Update', 'Family History Update', NULL, 'familyhistory/update', NULL, NULL, NULL, NULL, NULL, NULL),
(225, 'Family History', 'Destroy', 'Family History Destroy', NULL, 'familyhistory/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(230, 'Family Member', 'Listing', 'Family Member Listing', NULL, 'familymember', NULL, NULL, NULL, NULL, NULL, NULL),
(231, 'Family Member', 'New', 'Family Member New', NULL, 'familymember/create', NULL, NULL, NULL, NULL, NULL, NULL),
(232, 'Family Member', 'Store', 'Family Member History Store', NULL, 'familymember/store', NULL, NULL, NULL, NULL, NULL, NULL),
(233, 'Family Member', 'Edit', 'Family Member Edit', NULL, 'familymember/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(234, 'Family Member', 'Update', 'Family Member Update', NULL, 'familymember/update', NULL, NULL, NULL, NULL, NULL, NULL),
(235, 'Family Member', 'Destroy', 'Family Member Destroy', NULL, 'familymember/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(240, 'Patient Family History', 'Listing', 'Patient Family History Listing', NULL, 'patientfamilyhistory', NULL, NULL, NULL, NULL, NULL, NULL),
(241, 'Patient Family History', 'New', 'Patient Family History New', NULL, 'patientfamilyhistory/create', NULL, NULL, NULL, NULL, NULL, NULL),
(242, 'Patient Family History', 'Store', 'Patient Family History History Store', NULL, 'patientfamilyhistory/store', NULL, NULL, NULL, NULL, NULL, NULL),
(243, 'Patient Family History', 'Edit', 'Patient Family History Edit', NULL, 'patientfamilyhistory/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(244, 'Patient Family History', 'Update', 'Patient Family History Update', NULL, 'patientfamilyhistory/update', NULL, NULL, NULL, NULL, NULL, NULL),
(245, 'Patient Family History', 'Destroy', 'Patient Family History Destroy', NULL, 'patientfamilyhistory/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(250, 'Medical History', 'Listing', 'Medical History Listing', NULL, 'medicalhistory', NULL, NULL, NULL, NULL, NULL, NULL),
(251, 'Medical History', 'New', 'Medical History New', NULL, 'medicalhistory/create', NULL, NULL, NULL, NULL, NULL, NULL),
(252, 'Medical History', 'Store', 'Medical History History Store', NULL, 'medicalhistory/store', NULL, NULL, NULL, NULL, NULL, NULL),
(253, 'Medical History', 'Edit', 'Medical History Edit', NULL, 'medicalhistory/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(254, 'Medical History', 'Update', 'Medical History Update', NULL, 'medicalhistory/update', NULL, NULL, NULL, NULL, NULL, NULL),
(255, 'Medical History', 'Destroy', 'Medical History Destroy', NULL, 'medicalhistory/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(260, 'Patient Medical History', 'Listing', 'Patient Medical History Listing', NULL, 'patientmedicalhistory', NULL, NULL, NULL, NULL, NULL, NULL),
(261, 'Patient Medical History', 'New', 'Patient Medical History New', NULL, 'patientmedicalhistory/create', NULL, NULL, NULL, NULL, NULL, NULL),
(262, 'Patient Medical History', 'Store', 'Patient Medical History History Store', NULL, 'patientmedicalhistory/store', NULL, NULL, NULL, NULL, NULL, NULL),
(263, 'Patient Medical History', 'Edit', 'Patient Medical History Edit', NULL, 'patientmedicalhistory/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(264, 'Patient Medical History', 'Update', 'Patient Medical History Update', NULL, 'patientmedicalhistory/update', NULL, NULL, NULL, NULL, NULL, NULL),
(265, 'Patient Medical History', 'Destroy', 'Patient Medical History Destroy', NULL, 'patientmedicalhistory/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(270, 'Patient Surgery History', 'Listing', 'Patient Surgery History Listing', NULL, 'patientsurgeryhistory', NULL, NULL, NULL, NULL, NULL, NULL),
(271, 'Patient Surgery History', 'New', 'Patient Surgery History New', NULL, 'patientsurgeryhistory/create', NULL, NULL, NULL, NULL, NULL, NULL),
(272, 'Patient Surgery History', 'Store', 'Patient Surgery History Store', NULL, 'patientsurgeryhistory/store', NULL, NULL, NULL, NULL, NULL, NULL),
(273, 'Patient Surgery History', 'Edit', 'Patient Surgery History Edit', NULL, 'patientsurgeryhistory/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(274, 'Patient Surgery History', 'Update', 'Patient Surgery History Update', NULL, 'patientsurgeryhistory/update', NULL, NULL, NULL, NULL, NULL, NULL),
(275, 'Patient Surgery History', 'Destroy', 'Patient Surgery History Destroy', NULL, 'patientsurgeryhistory/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(280, 'Provisional diagnosis', 'Listing', 'Provisional diagnosis Listing', NULL, 'provisionaldiagnosis', NULL, NULL, NULL, NULL, NULL, NULL),
(281, 'Provisional diagnosis', 'New', 'Provisional diagnosis New', NULL, 'provisionaldiagnosis/create', NULL, NULL, NULL, NULL, NULL, NULL),
(282, 'Provisional diagnosis', 'Store', 'Provisional diagnosis Store', NULL, 'provisionaldiagnosis/store', NULL, NULL, NULL, NULL, NULL, NULL),
(283, 'Provisional diagnosis', 'Edit', 'Provisional diagnosis Edit', NULL, 'provisionaldiagnosis/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(284, 'Provisional diagnosis', 'Update', 'Provisional diagnosis Update', NULL, 'provisionaldiagnosis/update', NULL, NULL, NULL, NULL, NULL, NULL),
(285, 'Provisional diagnosis', 'Destroy', 'Provisional diagnosis Destroy', NULL, 'provisionaldiagnosis/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(290, 'Route', 'Listing', 'Route Listing', NULL, 'route', NULL, NULL, NULL, NULL, NULL, NULL),
(291, 'Route', 'New', 'Route New', NULL, 'route/create', NULL, NULL, NULL, NULL, NULL, NULL),
(292, 'Route', 'Store', 'Route Store', NULL, 'route/store', NULL, NULL, NULL, NULL, NULL, NULL),
(293, 'Route', 'Edit', 'Route Edit', NULL, 'route/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(294, 'Route', 'Update', 'Route Update', NULL, 'route/update', NULL, NULL, NULL, NULL, NULL, NULL),
(295, 'Route', 'Destroy', 'Route Destroy', NULL, 'route/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(300, 'Log', 'Activities', 'Activities', NULL, 'activities', NULL, NULL, NULL, NULL, NULL, NULL),
(306, 'Import', 'New', 'CSV Import New', NULL, 'import', NULL, NULL, NULL, NULL, NULL, NULL),
(307, 'Import', 'Store', 'CSV Import Store', NULL, 'import/store', NULL, NULL, NULL, NULL, NULL, NULL),
(311, 'Price History', 'Single Price History', 'Single Price History List Page', NULL, 'pricehistory/{type?}/{id?}', NULL, NULL, NULL, NULL, NULL, NULL),
(312, 'Price History', 'Multiple Price History', 'Multiple Price History List Page', NULL, 'multiplepricehistory/{type?}/{id?}', NULL, NULL, NULL, NULL, NULL, NULL),
(321, 'Api List', 'Sync Down Api Detail', 'Sync Down Api Detail', NULL, 'apilist/syncdownapi', NULL, NULL, NULL, NULL, NULL, NULL),
(322, 'Api List', 'Invoice Api Detail', 'Invoice Api Detail', NULL, 'apilist/invoiceapi', NULL, NULL, NULL, NULL, NULL, NULL),
(323, 'Api List', 'Enquiry Api Detail', 'Enquiry Api Detail', NULL, 'apilist/enquiryapi', NULL, NULL, NULL, NULL, NULL, NULL),
(324, 'Api List', 'Schedule Api Detail', 'Schedule Api Detail', NULL, 'apilist/scheduleapi', NULL, NULL, NULL, NULL, NULL, NULL),
(325, 'Api List', 'Patientpackage Api Detail', 'Patientpackage Api Detail', NULL, 'apilist/patientpackageapi', NULL, NULL, NULL, NULL, NULL, NULL),
(326, 'Api List', 'Waytracking Api Detail', 'Waytracking Api Detail', NULL, 'apilist/waytrackingapi', NULL, NULL, NULL, NULL, NULL, NULL),
(327, 'Api List', 'Patient Api Detail', 'Patient Api Detail', NULL, 'apilist/patientapi', NULL, NULL, NULL, NULL, NULL, NULL),
(330, 'Tablet Issues', 'Tablet Issues', 'Tablet Issues', NULL, 'tabletissues/{type?}', NULL, NULL, NULL, NULL, NULL, NULL),
(340, 'Investigation Imaging', 'List', 'Investigation Imaging List', NULL, 'investigationimaging', NULL, NULL, NULL, NULL, NULL, NULL),
(341, 'Investigation Imaging', 'New', 'Investigation Imaging Entry', NULL, 'investigationimaging/create', NULL, NULL, NULL, NULL, NULL, NULL),
(342, 'Investigation Imaging', 'Store', 'Investigation Imaging Store', NULL, 'investigationimaging/store', NULL, NULL, NULL, NULL, NULL, NULL),
(343, 'Investigation Imaging', 'Edit', 'Investigation Imaging Edit', NULL, 'investigationimaging/edit', NULL, NULL, NULL, NULL, NULL, NULL),
(344, 'Investigation Imaging', 'Update', 'Investigation Imaging Update', NULL, 'investigationimaging/update', NULL, NULL, NULL, NULL, NULL, NULL),
(345, 'Investigation Imaging', 'Destroy', 'Investigation Imaging Destroy', NULL, 'investigationimaging/destroy', NULL, NULL, NULL, NULL, NULL, NULL),
(1001, 'Report', 'Car Usage Report', 'Car Usage Report Listing', NULL, 'carusagereport', NULL, NULL, NULL, NULL, NULL, NULL),
(1002, 'Report', 'Car Usage Report Search', 'Car Usage Report Search', NULL, 'carusagereport/search/{from_date?}/{to_date?}', NULL, NULL, NULL, NULL, NULL, NULL),
(1003, 'Report', 'Car Usage Report Export Excel', 'Car Usage Report Export Excel', NULL, 'carusagereport/exportexcel/{from_date?}/{to_date?}', NULL, NULL, NULL, NULL, NULL, NULL),
(1004, 'Report', 'Visit Report', 'Visit Report Listing', NULL, 'visitreport', NULL, NULL, NULL, NULL, NULL, NULL),
(1005, 'Report', 'Visit Report Search', 'Visit Report Search', NULL, 'visitreport/search/{type?}/{from_date?}/{to_date?}', NULL, NULL, NULL, NULL, NULL, NULL),
(1006, 'Report', 'Visit Report Export Excel', 'Visit Report Export Excel', NULL, 'visitreport/exportexcel/{type?}/{from_date?}/{to_date?}', NULL, NULL, NULL, NULL, NULL, NULL),
(1007, 'Report', 'Schedule Status Report', 'Schedule Status Report Listing', NULL, 'schedulestatusreport', NULL, NULL, NULL, NULL, NULL, NULL),
(1008, 'Report', 'Schedule Status Report Search', 'Schedule Status Report Search', NULL, 'schedulestatusreport/search/{from_date?}/{to_date?}', NULL, NULL, NULL, NULL, NULL, NULL),
(1009, 'Report', 'Sale Summary Report', 'Sale Summary Report Listing', NULL, 'salesummaryreport', NULL, NULL, NULL, NULL, NULL, NULL),
(1010, 'Report', 'Sale Summary Report Search', 'Sale Summary Report Search', NULL, 'salesummaryreport/search/{from_date?}/{to_date?}', NULL, NULL, NULL, NULL, NULL, NULL),
(1011, 'Report', 'Sale Summary Report Export Excel', 'Sale Summary Report Export Excel', NULL, 'salesummaryreport/exportexcel/{from_date?}/{to_date?}', NULL, NULL, NULL, NULL, NULL, NULL),
(1012, 'Report', 'Sale Summary Report Invoice Detail', 'Sale Summary Report Invoice Detail', NULL, 'salesummaryreport/invoicedetail/{id}', NULL, NULL, NULL, NULL, NULL, NULL),
(1013, 'Report', 'Sale Summary Report Invoice Export', 'Sale Summary Report Invoice Export', NULL, 'salesummaryreport/invoice_export/{id}', NULL, NULL, NULL, NULL, NULL, NULL),
(1014, 'Patient', 'Log Patient Case Summary', 'Log Patient Case Summary Listing', NULL, 'patient/log', NULL, NULL, NULL, NULL, NULL, NULL),
(1015, 'Patient', 'Log Patient Case Summary', 'Log Patient Case Summary Listing', NULL, 'patient/log', NULL, NULL, NULL, NULL, NULL, NULL),
(1016, 'Patient', 'Search Log Patient Case Summary', 'Search Log Patient Case Summary Listing', NULL, 'patient/log/search', NULL, NULL, NULL, NULL, NULL, NULL),
(1017, 'Report', 'Income Summary Report', 'Income Summary Report Listing', NULL, 'incomesummaryreport', NULL, NULL, NULL, NULL, NULL, NULL),
(1018, 'Report', 'Income Summary Report Search', 'Income Summary Report Search', NULL, 'incomesummaryreport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', NULL, NULL, NULL, NULL, NULL, NULL),
(1019, 'Report', 'Income Summary Report Export Excel', 'Income Summary Report Export Excel', NULL, 'incomesummaryreport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', NULL, NULL, NULL, NULL, NULL, NULL),
(1020, 'Report', 'Income Summary Report Graph', 'Income Summary Report Graph', NULL, 'incomesummaryreportbygraph', NULL, NULL, NULL, NULL, NULL, NULL),
(1021, 'Report', 'Income Summary Report Graph Search', 'Income Summary Report Graph Search', NULL, 'incomesummaryreportbygraph/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', NULL, NULL, NULL, NULL, NULL, NULL),
(1022, 'Report', 'Car Usage Report Graph', 'Car Usage Report Graph', NULL, 'carusagereportbygraph', NULL, NULL, NULL, NULL, NULL, NULL),
(1023, 'Report', 'Car Usage Report Graph Search', 'Car Usage Report Graph Search', NULL, 'carusagereportbygraph/search/{from_date?}/{to_date?}', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_permission_role`
--

CREATE TABLE `core_permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `position` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_permission_role`
--

INSERT INTO `core_permission_role` (`id`, `role_id`, `permission_id`, `position`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 8, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 11, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 12, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 13, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, 14, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 15, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, 16, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, 17, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, 20, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, 21, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, 22, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 1, 23, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, 24, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, 25, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 1, 26, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, 30, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 1, 31, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 1, 32, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, 33, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 1, 34, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 1, 35, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 1, 40, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 1, 41, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 1, 42, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 1, 43, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 1, 44, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 1, 45, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 1, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 1, 51, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 1, 52, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 1, 53, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 1, 54, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 1, 55, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 1, 60, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 1, 61, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 1, 62, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 1, 63, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 1, 64, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 1, 65, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 1, 70, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 1, 71, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 1, 72, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 1, 73, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 1, 74, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 1, 75, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 1, 80, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 1, 81, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 1, 82, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 1, 83, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 1, 84, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 1, 85, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 1, 90, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 1, 91, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 1, 92, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 1, 93, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 1, 94, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 1, 95, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 1, 100, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 1, 101, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 1, 102, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 1, 103, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 1, 104, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 1, 105, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 1, 110, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 1, 111, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 1, 112, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 1, 113, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 1, 114, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 1, 115, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 1, 120, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 1, 121, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 1, 122, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 1, 123, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 1, 124, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 1, 125, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 1, 130, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 1, 131, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 1, 132, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 1, 133, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 1, 134, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 1, 135, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 1, 140, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 1, 141, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 1, 142, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 1, 143, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 1, 144, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 1, 145, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 1, 146, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 1, 147, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 1, 148, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 1, 150, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 1, 151, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 1, 152, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 1, 153, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 1, 154, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 1, 155, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 1, 160, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 1, 161, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 1, 162, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 1, 163, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 1, 164, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 1, 165, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 1, 166, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 1, 167, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 1, 200, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 1, 201, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 1, 202, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 1, 203, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 1, 204, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 1, 205, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 1, 206, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 1, 207, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 1, 210, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 1, 211, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 1, 212, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 1, 213, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 1, 214, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 1, 215, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 1, 220, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 1, 221, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 1, 222, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 1, 223, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 1, 224, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 1, 225, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 1, 230, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 1, 231, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 1, 232, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 1, 233, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 1, 234, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 1, 235, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 1, 240, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 1, 241, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 1, 242, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 1, 243, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 1, 244, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 1, 245, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 1, 250, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 1, 251, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 1, 252, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 1, 253, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 1, 254, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 1, 255, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 1, 260, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 1, 261, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 1, 262, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 1, 263, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 1, 264, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(156, 1, 265, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 1, 270, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 1, 271, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 1, 272, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 1, 273, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 1, 274, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(162, 1, 275, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(163, 1, 280, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 1, 281, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(165, 1, 282, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 1, 283, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 1, 284, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 1, 285, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(169, 1, 290, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 1, 291, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(171, 1, 292, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(172, 1, 293, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(173, 1, 294, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 1, 295, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(175, 5, 16, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(176, 5, 170, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(177, 5, 171, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(178, 5, 172, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(179, 5, 173, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(180, 5, 174, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(181, 5, 175, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(182, 5, 176, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(183, 5, 177, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(184, 5, 178, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 5, 179, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(186, 5, 180, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(187, 5, 181, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(188, 1, 1001, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(189, 1, 1002, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(190, 1, 1003, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(191, 1, 1004, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(192, 1, 1005, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(193, 1, 1006, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(194, 1, 1007, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(195, 1, 1008, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(196, 1, 1009, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(197, 1, 1010, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(198, 1, 1011, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(199, 1, 1012, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(200, 1, 1013, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(201, 1, 1014, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(202, 1, 1015, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(203, 1, 1016, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(204, 1, 1017, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(205, 1, 1018, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(206, 1, 1019, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(207, 1, 1020, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(208, 1, 1021, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(209, 1, 1022, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(210, 1, 1023, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(211, 2, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(212, 2, 11, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(213, 2, 12, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(214, 2, 13, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(215, 2, 14, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(216, 2, 15, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(217, 2, 16, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(218, 2, 17, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(219, 2, 30, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(220, 2, 31, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(221, 2, 32, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(222, 2, 33, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(223, 2, 34, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(224, 2, 35, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(225, 2, 40, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(226, 2, 41, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 2, 42, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(228, 2, 43, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(229, 2, 44, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(230, 2, 45, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(231, 2, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(232, 2, 51, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(233, 2, 52, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(234, 2, 53, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(235, 2, 54, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(236, 2, 55, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(237, 2, 60, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(238, 2, 61, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(239, 2, 62, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(240, 2, 63, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(241, 2, 64, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(242, 2, 65, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(243, 2, 70, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(244, 2, 71, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(245, 2, 72, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(246, 2, 73, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(247, 2, 74, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(248, 2, 75, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(249, 2, 80, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 2, 81, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(251, 2, 82, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(252, 2, 83, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(253, 2, 84, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(254, 2, 85, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(255, 2, 90, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(256, 2, 91, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(257, 2, 92, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(258, 2, 93, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(259, 2, 94, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(260, 2, 95, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(261, 2, 100, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(262, 2, 101, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(263, 2, 102, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(264, 2, 103, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(265, 2, 104, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(266, 2, 105, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(267, 2, 110, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(268, 2, 111, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(269, 2, 112, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(270, 2, 113, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(271, 2, 114, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(272, 2, 115, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(273, 2, 120, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(274, 2, 121, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(275, 2, 122, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(276, 2, 123, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(277, 2, 124, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(278, 2, 125, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(279, 2, 130, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(280, 2, 131, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(281, 2, 132, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(282, 2, 133, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(283, 2, 134, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(284, 2, 135, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(285, 2, 140, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(286, 2, 141, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(287, 2, 142, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(288, 2, 143, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(289, 2, 144, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(290, 2, 145, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(291, 2, 146, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(292, 2, 147, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(293, 2, 148, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(294, 2, 150, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(295, 2, 151, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(296, 2, 152, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(297, 2, 153, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(298, 2, 154, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(299, 2, 155, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(300, 2, 160, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(301, 2, 161, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(302, 2, 162, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(303, 2, 163, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(304, 2, 164, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(305, 2, 165, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(306, 2, 166, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(307, 2, 167, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(308, 2, 200, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(309, 2, 201, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(310, 2, 202, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(311, 2, 203, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(312, 2, 204, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(313, 2, 205, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(314, 2, 206, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(315, 2, 207, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(316, 2, 210, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(317, 2, 211, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(318, 2, 212, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(319, 2, 213, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(320, 2, 214, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(321, 2, 215, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(322, 2, 220, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(323, 2, 221, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(324, 2, 222, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(325, 2, 223, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(326, 2, 224, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(327, 2, 225, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(328, 2, 230, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(329, 2, 231, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(330, 2, 232, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(331, 2, 233, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(332, 2, 234, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(333, 2, 235, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(334, 2, 240, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(335, 2, 241, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(336, 2, 242, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(337, 2, 243, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(338, 2, 244, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(339, 2, 245, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(340, 2, 250, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(341, 2, 251, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(342, 2, 252, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(343, 2, 253, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(344, 2, 254, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(345, 2, 255, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(346, 2, 260, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(347, 2, 261, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(348, 2, 262, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(349, 2, 263, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(350, 2, 264, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(351, 2, 265, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(352, 2, 270, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(353, 2, 271, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(354, 2, 272, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(355, 2, 273, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(356, 2, 274, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(357, 2, 275, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(358, 2, 280, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(359, 2, 281, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(360, 2, 282, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(361, 2, 283, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(362, 2, 284, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(363, 2, 285, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(364, 2, 290, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(365, 2, 291, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(366, 2, 292, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(367, 2, 293, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(368, 2, 294, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(369, 2, 295, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(370, 2, 1001, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(371, 2, 1002, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(372, 2, 1003, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(373, 2, 1004, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(374, 2, 1005, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(375, 2, 1006, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(376, 2, 1007, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(377, 2, 1008, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(378, 2, 1009, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(379, 2, 1010, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(380, 2, 1011, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(381, 2, 1012, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(382, 2, 1013, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(383, 2, 1014, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(384, 2, 1015, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(385, 2, 1016, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(386, 2, 1017, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(387, 2, 1018, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(388, 2, 1019, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(389, 2, 1020, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(390, 2, 1021, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(391, 1, 300, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(392, 1, 306, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(393, 1, 307, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(394, 2, 306, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(395, 2, 307, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(396, 1, 311, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(397, 1, 312, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(398, 1, 321, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(399, 1, 322, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(400, 1, 323, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(401, 1, 324, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(402, 1, 325, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(403, 1, 326, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(404, 1, 327, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(405, 1, 330, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(406, 1, 340, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(407, 1, 341, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(408, 1, 342, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(409, 1, 343, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(410, 1, 344, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(411, 1, 345, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_roles`
--

CREATE TABLE `core_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_roles`
--

INSERT INTO `core_roles` (`id`, `name`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SUPER-ADMIN', 'This is super admin role', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'ADMIN', 'This is manager role', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'MANAGER', 'This is cashier role', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'PATIENT', 'This is patient role', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'MO', 'This is MO role', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'CONSULTANT', 'This is consultant role', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'NURSE', 'This is nurse role', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_settings`
--

CREATE TABLE `core_settings` (
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_settings`
--

INSERT INTO `core_settings` (`code`, `type`, `value`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('FOREIGNER', 'PATIENT_TYPE', '2', 'Foreign Patient', NULL, NULL, NULL, NULL, NULL, NULL),
('LOCAL', 'PATIENT_TYPE', '1', 'Local Patient', NULL, NULL, NULL, NULL, NULL, NULL),
('TAX_RATE', 'TAX_RATE', '7', 'Tax Rate', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_syncs_tables`
--

CREATE TABLE `core_syncs_tables` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_syncs_tables`
--

INSERT INTO `core_syncs_tables` (`id`, `table_name`, `version`, `active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'core_configs', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'core_permissions', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'core_permission_role', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'core_roles', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'core_users', 818, 1, NULL, 'U0001', NULL, NULL, '2017-01-17 13:45:45', NULL),
(6, 'core_settings', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'cities', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'townships', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'car_types', 3, 1, NULL, 'U0001', NULL, NULL, '2017-01-05 11:41:52', NULL),
(10, 'zones', 2, 1, NULL, 'U0001', NULL, NULL, '2017-01-05 11:41:18', NULL),
(11, 'zone_detail', 2, 1, NULL, 'U0001', NULL, NULL, '2017-01-05 11:41:18', NULL),
(12, 'car_type_setup', 3, 1, NULL, 'U0001', NULL, NULL, '2017-01-05 11:42:17', NULL),
(13, 'product_categories', 2, 1, NULL, 'U0001', NULL, NULL, '2017-01-05 11:42:42', NULL),
(14, 'products', 117, 1, NULL, 'U0001', NULL, NULL, '2017-01-16 13:17:30', NULL),
(15, 'packages', 2, 1, NULL, 'U0001', NULL, NULL, '2017-01-09 11:06:03', NULL),
(16, 'package_detail', 2, 1, NULL, 'U0001', NULL, NULL, '2017-01-09 11:06:03', NULL),
(17, 'investigations_imaging', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'investigation_labs', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'physical_exams', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'services', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'allergies', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'family_histories', 175, 1, NULL, 'U0001', NULL, NULL, '2017-01-16 13:17:31', NULL),
(23, 'medical_history', 223, 1, NULL, 'U0001', NULL, NULL, '2017-01-16 13:17:31', NULL),
(24, 'patients', 816, 1, NULL, 'U0001', NULL, NULL, '2017-01-17 13:45:45', NULL),
(25, 'patient_allergy', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'patient_family_history', 44, 1, NULL, NULL, NULL, NULL, '2017-01-16 13:17:30', NULL),
(27, 'patient_medical_history', 61, 1, NULL, NULL, NULL, NULL, '2017-01-16 13:17:30', NULL),
(28, 'patient_package', 2, 1, NULL, NULL, NULL, NULL, '2017-01-09 11:58:05', NULL),
(29, 'patient_package_detail', 2, 1, NULL, NULL, NULL, NULL, '2017-01-09 11:58:05', NULL),
(30, 'patient_surgery_history', 44, 1, NULL, NULL, NULL, NULL, '2017-01-16 13:17:30', NULL),
(31, 'provisional_diagnosis', 4, 1, NULL, 'U0001', NULL, NULL, '2017-01-05 11:44:28', NULL),
(32, 'patient_family_member', 235, 1, NULL, NULL, NULL, NULL, '2017-01-11 10:51:41', NULL),
(33, 'route', 59, 1, NULL, 'U0001', NULL, NULL, '2017-01-16 13:17:31', NULL),
(34, 'schedule_treatment_histories', 31, 1, NULL, NULL, NULL, NULL, '2017-01-16 13:17:30', NULL),
(35, 'enquiries', 1103, 1, NULL, NULL, NULL, NULL, '2017-01-17 10:08:48', NULL),
(36, 'enquiry_detail', 1103, 1, NULL, NULL, NULL, NULL, '2017-01-17 10:08:48', NULL),
(37, 'schedules', 289, 1, NULL, NULL, NULL, NULL, '2017-01-17 10:08:48', NULL),
(38, 'schedule_detail', 289, 1, NULL, NULL, NULL, NULL, '2017-01-17 10:08:48', NULL),
(39, 'patient_physiotherapy_neuro_general', 65, 1, NULL, NULL, NULL, NULL, '2017-01-16 13:17:30', NULL),
(40, 'patient_physiotherapy_neuro_limb', 65, 1, NULL, NULL, NULL, NULL, '2017-01-16 13:17:30', NULL),
(41, 'patient_physiotherapy_neuro_functional_performance1', 65, 1, NULL, NULL, NULL, NULL, '2017-01-16 13:17:30', NULL),
(42, 'patient_physiotherapy_neuro_functional_performance2', 65, 1, NULL, NULL, NULL, NULL, '2017-01-16 13:17:30', NULL),
(43, 'patient_physiotherapy_neuro_functional_performance3', 65, 1, NULL, NULL, NULL, NULL, '2017-01-16 13:17:30', NULL),
(44, 'patient_physiothreapy_musculo_1_and_2', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'patient_physiotherapy_musculo_3_sitting', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'patient_physiotherapy_musculo_3_standing', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'patient_physiotherapy_musculo_4_1and2', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'patient_physiotherapy_musculo_4_3', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'patient_physiotherapy_musculo_4_4and5', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nrc_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_new_patient` tinyint(1) NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_type_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `phone_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `township_id` int(10) UNSIGNED NOT NULL,
  `zone_id` int(11) NOT NULL,
  `case_type` int(11) NOT NULL,
  `car_type` int(11) NOT NULL,
  `car_type_id` int(10) UNSIGNED NOT NULL,
  `enquiry1` tinyint(1) NOT NULL,
  `enquiry2` tinyint(1) NOT NULL,
  `enquiry3` tinyint(1) NOT NULL,
  `enquiry4` tinyint(1) NOT NULL,
  `having_allergy` tinyint(4) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_detail`
--

CREATE TABLE `enquiry_detail` (
  `enquiry_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `allergy_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_histories`
--

CREATE TABLE `family_histories` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_of_present_illness`
--

CREATE TABLE `history_of_present_illness` (
  `id` int(10) UNSIGNED NOT NULL,
  `hopi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investigations`
--

CREATE TABLE `investigations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `investigations`
--

INSERT INTO `investigations` (`id`, `name`, `group_name`, `price`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CP (Auto-33 para)', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(2, 'CP (Manual)', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(3, 'Reticulocyte Count (Auto)', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(4, 'ABO/RhGrouping & Matching', 'Haematology2', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(5, 'Coomb"s Test', 'Haematology2', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(6, 'Prothrombin Time (PT/INR)', 'Coagulation_Profile', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(7, 'Activated Partial Thromboplastin Time(APTT)', 'Coagulation_Profile', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(8, 'Hb%', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(9, 'ESR', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(10, 'PCV', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(11, 'Platelet', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(12, 'G6PD(Screening)', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(13, 'ABO Grouping', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(14, 'Rh', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(15, 'Hb Electrophoresis', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(16, 'Hb F(Singer"s Test)', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(17, 'CD4 Count', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(18, 'HbA1C', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(19, 'G6PD(Q)', 'Haematology1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(20, 'Clod/Warm Agglutination', 'Haematology2', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(21, 'Fibrinogen', 'Coagulation_Profile', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(22, 'Favtor VIII', 'Coagulation_Profile', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(23, 'Factor IX', 'Coagulation_Profile', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(24, 'D-Dimer', 'Coagulation_Profile', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(25, 'Von Willebrand Factor', 'Coagulation_Profile', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(26, 'FDP', 'Coagulation_Profile', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(27, 'Ferritin', 'Iron_Study', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(28, 'Serum iron', 'Iron_Study', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(29, 'TIBC', 'Iron_Study', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(30, 'Lipid Profile(F/R)', 'Biochemistry', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(31, 'Total Cholesterol', 'Biochemistry', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(32, 'Triglyceride', 'Biochemistry', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(33, 'HDL', 'Biochemistry', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(34, 'LDL', 'Biochemistry', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(35, 'Bilirubin (Total/Direct)', 'Liver_Function_Tests', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(36, 'ALT/SGPT', 'Liver_Function_Tests', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(37, 'Alkaline Phosphatase', 'Liver_Function_Tests', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(38, 'Gamma_GT', 'Liver_Function_Tests', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(39, 'AST [Aspartate Transaminase]', 'Cardiac_Enzymes', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(40, 'LDH [Lactate Dehydrogenase]', 'Cardiac_Enzymes', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(41, 'CK-MB', 'Cardiac_Enzymes', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(42, 'Urea', 'Urea_and_Electrolytes', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(43, 'Sodium', 'Urea_and_Electrolytes', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(44, 'Potassium', 'Urea_and_Electrolytes', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(45, 'Chloride', 'Urea_and_Electrolytes', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(46, 'Bicarbonate', 'Urea_and_Electrolytes', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(47, 'Creatinine', 'Urea_and_Electrolytes', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(48, 'Uric Acid', 'Urea_and_Electrolytes', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(49, 'Total Protein', 'Total_and_Differential_Protein', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(50, 'Albumin', 'Total_and_Differential_Protein', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(51, 'Globulin', 'Total_and_Differential_Protein', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(52, 'Amylase', 'Other1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(53, 'LDH', 'Other1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(54, 'Calcium', 'Other1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(55, 'CK', 'Other1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(56, 'Phosphorus', 'Other1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(57, 'CPR(Qualitative)', 'Other1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(58, 'CRP(Quantitative)', 'Other1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(59, 'Glucose[F,R,@hrPP]', 'Diabetes_Tests', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(60, 'Oral Glucose Toierance Test [OGTT]', 'Diabetes_Tests', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(61, 'HbA1C', 'Diabetes_Tests', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(62, 'AFP', 'Tumour_Makers', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(63, 'CA125', 'Tumour_Makers', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(64, 'CA153', 'Tumour_Makers', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(65, 'CA199', 'Tumour_Makers', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(66, 'CEA', 'Tumour_Makers', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(67, 'CEA', 'Tumour_Makers', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(68, 'PSA(Total)', 'Tumour_Makers', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(69, 'PSA(Free)', 'Tumour_Makers', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(70, 'T3/FreeT3', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(71, 'T4/FreeT4', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(72, 'Beta-HCG', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(73, 'Cortisol1', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(74, 'FSH', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(75, 'LH', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(76, 'Progesterone', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(77, 'Prolactin', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(78, 'Testosterone', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(79, 'Beta-HCG(Quantitative)', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(80, 'Estradiol E2', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(81, 'Cortisol2', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(82, 'Parathyroid Hormone', 'Hormones', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(83, 'Troponin I', 'Cardiac_Makers1', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(84, 'Troponin T', 'Cardiac_Makers2', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(85, 'NT-ProBNP', 'Cardiac_Makers3', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(86, 'Troponin I, CK-MB,BNP[Alere Triage]', 'Cardiac_Makers4', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(87, 'MP [ICT] (Malaria Parasites)', 'Others2', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(88, 'MP Film (Bld for Malaria Parasites)', 'Others2', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(89, 'HbA1c & CRP(Q) [NycoCard]', 'Others2', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(90, 'MF Film (MicroFilaria)', 'Others2', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(91, 'HBsAg (Qualitative)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(92, 'HBsAg (Quantitative)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(93, 'Anti-HBs (Qualitative)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(94, 'Anti-HBs (Quantitative)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(95, 'HBeAg', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(96, 'HBeAb', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(97, 'Anti-HBc (IgG/IgM/Total)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(98, 'HBV Panel', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(99, 'HIV 1&2 Ab Screening', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(100, 'HIV 1&2 Ab ELISA', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(101, 'HIV 1&2 Confirmation', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(102, 'P24 HIV Ag', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(103, 'HCVAb', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(104, 'HAV Ab (IgG/IgM)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(105, 'VDRL [Syphilis]', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(106, 'TPHA', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(107, 'Widal Test', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(108, 'MF IgG/IgM (ICT) [Microfilaris]', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(109, 'Chikungunya Ab(IgM)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(110, 'Salmonella IgG/IgM', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(111, 'Rubella IgG/IgM', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(112, 'Leptospiral Ab (IgG/IgM)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(113, 'H.pylori (IgG/IgM)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(114, 'Dengue NS1Ag+IgM/IgG', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(115, 'Dengue Ab IgG/IgM', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(116, 'ICT TB (IgG/IgM)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(117, 'Tsutsugamushi IgG/IgM(Scrub Typhus)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(118, 'RA', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(119, 'ASO (Qualitative/Quantitative)', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(120, 'ANF/ANA/Anti ds DNA', 'Infactions_Diseases_and_Others', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(121, 'Ab for Aspergillus fumigatus', 'Fungal_Serology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(122, 'Ab for Aspergillus flavus', 'Fungal_Serology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(123, 'Ab for Aspergillus niger', 'Fungal_Serology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(124, 'Ab for Histoplasma capsulatum', 'Fungal_Serology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(125, 'Ab for Candida albicans', 'Fungal_Serology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(126, 'Ab for Blastomyces dermatitidis', 'Fungal_Serology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(127, 'Ab for Coccidioides immitis', 'Fungal_Serology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(128, 'Cryptococcus neoformans Ag (Serum) (CSF)', 'Fungal_Serology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(129, 'Blood', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(130, 'Urine', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(131, 'Aspirated Fluid', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(132, 'Body Fluid', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(133, 'Sputum', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(134, 'Stool', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(135, 'Pus', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(136, 'Throat Swab', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(137, 'Wound Swab', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(138, 'Ear Swab', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(139, 'High Vaginal Swab(HVS)', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(140, 'Fungal Direct Microscopy & Culture', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(141, 'AfB Culture', 'Microbiology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(142, 'Urine Routine Examination [RE]', 'Urine', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(143, 'Urine for ketone bodies', 'Urine', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(144, 'Urine for Albumin', 'Urine', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(145, 'Urine for Suger', 'Urine', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(146, 'Urine Pregnancy Test(HCG/UCG)', 'Urine', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(147, 'Urine Bence Jones Protein', 'Urine', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(148, 'Stool Routine Examinnation [RE]', 'Stool', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(149, 'Stool for Reducing Substance', 'Stool', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(150, 'Stool for AFB', 'Stool', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(151, 'Stool for occult blood', 'Stool', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(152, 'H.pylori (Stool)', 'Stool', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(153, 'Hanging-drop Preparation', 'Stool', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(154, 'Stool for Rota virus', 'Stool', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(155, 'Stool for Cholera Ag', 'Stool', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(156, 'Fluid Routine Examination[RE](CSF/Pleural/Ascitic)', 'Others3', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(157, 'Sputum for AFB (Concentrated Method)', 'Others3', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(158, 'Semen Analysis', 'Others3', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(159, 'Tuberculin Test', 'Others3', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(160, 'Chlamydia Ag Test (Endocervical/Urethral Swab)', 'Others3', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(161, 'Urine Electrolytes', 'Chemical_Pathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(162, 'Urine Sodium', 'Chemical_Pathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(163, 'Urine Chloride', 'Chemical_Pathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(164, 'Urine Creatinine', 'Chemical_Pathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(165, 'Urine Protein Creatinine Ratio', 'Chemical_Pathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(166, '24 hours urine protein', 'Chemical_Pathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(167, '24 hours urine calcium', 'Chemical_Pathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(168, '24 hours urine uric acid', 'Chemical_Pathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(169, 'Urine for Microalbumin', 'Chemical_Pathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(170, 'Biopsy', 'Histopathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(171, 'Cytology', 'Histopathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(172, 'PapSmear', 'Histopathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(173, 'FNAC', 'Histopathology', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(174, 'G6PD', 'Neonatal_Screening_Tests', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(175, 'TSH', 'Neonatal_Screening_Tests', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(176, 'Phenylketonuria [PKU]', 'Neonatal_Screening_Tests', '1000.00', '', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investigations_imaging`
--

CREATE TABLE `investigations_imaging` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_charges` decimal(10,2) DEFAULT NULL,
  `urgent_fees` decimal(10,2) DEFAULT NULL,
  `refer_fees` decimal(10,2) DEFAULT NULL,
  `reading_fees` decimal(10,2) DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `investigations_imaging`
--

INSERT INTO `investigations_imaging` (`id`, `service_id`, `group_name`, `service_name`, `service_charges`, `urgent_fees`, `refer_fees`, `reading_fees`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'CT', 'CT 4 Phase Abdomen(Liver)', '150000.00', '0.00', '7500.00', '18000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(2, 0, 'CT', 'CT 4 Phase Abdomen(Liver)&Pelvis', '200000.00', '0.00', '7500.00', '24000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(3, 0, 'CT', 'CT Abdomen', '110000.00', '0.00', '7500.00', '13200.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(4, 0, 'CT', 'CT Abdomen & Pelvis', '180000.00', '0.00', '7500.00', '21600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(5, 0, 'CT', 'CT Abdominal Aorta', '180000.00', '0.00', '15000.00', '21600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(6, 0, 'CT', 'CT Aorta (Abdomen & Thoracic)', '250000.00', '0.00', '15000.00', '30000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(7, 0, 'CT', 'CT Calcium Score', '100000.00', '0.00', '7500.00', '12000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(8, 0, 'CT', 'CT CD', '1000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(9, 0, 'CT', 'CT Cervical Spine', '110000.00', '0.00', '7500.00', '13200.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(10, 0, 'CT', 'CT Chest', '110000.00', '0.00', '7500.00', '13200.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(11, 0, 'CT', 'CT Circle of Willis Vessels', '170000.00', '0.00', '15000.00', '20400.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(12, 0, 'CT', 'CT Coronary Angiogram &Calcium Score', '300000.00', '0.00', '15000.00', '36000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(13, 0, 'CT', 'CT Head', '95000.00', '0.00', '7500.00', '11400.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(14, 0, 'CT', 'CT Head & Neck', '180000.00', '0.00', '7500.00', '21600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(15, 0, 'CT', 'CT Hepatic Artery', '180000.00', '0.00', '15000.00', '21600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(16, 0, 'CT', 'CT HRCT', '110000.00', '0.00', '7500.00', '13200.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(17, 0, 'CT', 'CT Joints', '95000.00', '0.00', '7500.00', '11400.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(18, 0, 'CT', 'CT KUB', '110000.00', '0.00', '7500.00', '13200.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(19, 0, 'CT', 'CT Lower Limbs', '200000.00', '0.00', '15000.00', '24000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(20, 0, 'CT', 'CT Lumbar Spine', '110000.00', '0.00', '7500.00', '13200.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(21, 0, 'CT', 'CT Neck', '95000.00', '0.00', '7500.00', '11400.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(22, 0, 'CT', 'CT Neck(Carotid)', '170000.00', '0.00', '15000.00', '20400.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(23, 0, 'CT', 'CT Orbits', '95000.00', '0.00', '7500.00', '11400.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(24, 0, 'CT', 'CT Paranasal Sinus', '95000.00', '0.00', '7500.00', '11400.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(25, 0, 'CT', 'CT Pelvis', '110000.00', '0.00', '7500.00', '13200.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(26, 0, 'CT', 'CT Pulmonary Arteries', '180000.00', '0.00', '15000.00', '21600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(27, 0, 'CT', 'CT Renal Arteries', '180000.00', '0.00', '15000.00', '21600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(28, 0, 'CT', 'CT Superior Mesenteric Artery', '180000.00', '0.00', '15000.00', '216000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(29, 0, 'CT', 'CT Temporal Bone', '95000.00', '0.00', '7500.00', '11400.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(30, 0, 'CT', 'CT Thoracic Arota', '180000.00', '0.00', '15000.00', '21600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(31, 0, 'CT', 'CT Thoracic Lumber Spine', '180000.00', '0.00', '7500.00', '21600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(32, 0, 'CT', 'CT Thoracic Spine', '110000.00', '0.00', '7500.00', '13200.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(33, 0, 'CT', 'CT Upper Limbs', '200000.00', '0.00', '15000.00', '24000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(34, 0, 'CT', 'CT Urogram', '200000.00', '0.00', '7500.00', '24000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(35, 0, 'CT', 'CT Venogram of Intracranial Sinuses', '170000.00', '0.00', '15000.00', '20400.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(36, 0, 'CT', 'CT Virtual Colonogram', '250000.00', '0.00', '7500.00', '30000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(37, 0, 'CT', 'CT Whole Body', '400000.00', '0.00', '7500.00', '48000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(38, 0, 'CT Emergency Report', 'CT 4 Phase Abdomen(Liver&Pelvis) Urgent', '237700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(39, 0, 'CT Emergency Report', 'CT 4 Phase Abdomen(Liver&Pelvis)IES+SMJ', '535400.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(40, 0, 'CT Emergency Report', 'CT 4 Phase Abdomen(Liver)IES+SMJ', '397700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(41, 0, 'CT Emergency Report', 'CT Abdomen & Pelvis(IES+SMJ)Foreigner', '445400.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(42, 0, 'CT Emergency Report', 'CT Abdomen&Pelvis(Urgent)', '217700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(43, 0, 'CT Emergency Report', 'CT Abdomen(IES+SMJ)', '267700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(44, 0, 'CT Emergency Report', 'CT Abdomen(Urgent)', '147700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(45, 0, 'CT Emergency Report', 'CT Abdomial Aorta(IES+SMJ)', '427200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(46, 0, 'CT Emergency Report', 'CT Abdominal Aorta(Urgent)', '237200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(47, 0, 'CT Emergency Report', 'CT Aorta Abdominal & Thoracic(Urgent)', '307200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(48, 0, 'CT Emergency Report', 'CT Aorta/Abdominal & Thoracic(IES+SMJ)', '567200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(49, 0, 'CT Emergency Report', 'CT Brain(IES+SMJ)', '220800.00', '0.00', '7500.00', '15600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(50, 0, 'CT Emergency Report', 'CT Brain(Urgent)', '115800.00', '0.00', '7500.00', '15600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(51, 0, 'CT Emergency Report', 'CT Cervical Spine(IES+SMJ)', '267700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(52, 0, 'CT Emergency Report', 'CT Cervical Spine(Urgent)', '147700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(53, 0, 'CT Emergency Report', 'CT Cervico Thoracic Spine(IES+SMJ)Foreigner', '407700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(54, 0, 'CT Emergency Report', 'CT Chest(IES+SMJ)', '267700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(55, 0, 'CT Emergency Report', 'CT Chest(Urgent)', '147700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(56, 0, 'CT Emergency Report', 'CT Circle Of Willis Vessels(IES+SMJ)', '407200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(57, 0, 'CT Emergency Report', 'CT Circle of Willis Vessels(Urgent)', '227200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(58, 0, 'CT Emergency Report', 'CT Colonogram(IES+SMJ)Foreigner', '497700.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(59, 0, 'CT Emergency Report', 'CT Coronary angiogram&Calcium Score(Urgent)', '357200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(60, 0, 'CT Emergency Report', 'CT Head & Neck(IES+SMJ)', '428500.00', '0.00', '7500.00', '48100.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(61, 0, 'CT Emergency Report', 'CT Head & Neck(Urgent)', '238500.00', '0.00', '7500.00', '48100.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(62, 0, 'CT Emergency Report', 'CT Head(IES+SMJ)', '220800.00', '0.00', '7500.00', '15600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(63, 0, 'CT Emergency Report', 'CT Head(Urgent)', '115800.00', '0.00', '7500.00', '15600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(64, 0, 'CT Emergency Report', 'CT Heart/Coronary Angiogram(IES+SMJ)', '667200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(65, 0, 'CT Emergency Report', 'CT Hepatic Artery(IES+SMJ)', '427200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(66, 0, 'CT Emergency Report', 'CT Hepatic Artery(Urgent)', '237200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(67, 0, 'CT Emergency Report', 'CT HRCT Chest(IES+SMJ)Foreigner', '267700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(68, 0, 'CT Emergency Report', 'CT IAM(IES+SMJ)Foreigner', '237700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(69, 0, 'CT Emergency Report', 'CT Joint(IES+SMJ)', '297700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(70, 0, 'CT Emergency Report', 'CT Joint(Urgent)', '132700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(71, 0, 'CT Emergency Report', 'CT KUB(Urgent)', '147700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(72, 0, 'CT Emergency Report', 'CT Lower Abdomen(IES+SMJ)', '267700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(73, 0, 'CT Emergency Report', 'CT Lower Limbs(IES+SMJ)', '467200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(74, 0, 'CT Emergency Report', 'CT Lower Limbs(Urgent)', '257200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(75, 0, 'CT Emergency Report', 'CT Lumbar Spine(IES+SMJ)', '267700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(76, 0, 'CT Emergency Report', 'CT Lumbar Spine(Urgent)', '147700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(77, 0, 'CT Emergency Report', 'CT Mandible(IES+SMJ)Foreigner', '237700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(78, 0, 'CT Emergency Report', 'CT Myelogram(IES+SMJ)Foreigner', '447700.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(79, 0, 'CT Emergency Report', 'CT Neck(IES+SMJ)Foreigner', '237700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(80, 0, 'CT Emergency Report', 'CT Neck(Urgent)', '132700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(81, 0, 'CT Emergency Report', 'CT Neck/Carotid(IES+SMJ)Foreigner', '407200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(82, 0, 'CT Emergency Report', 'CT Neck/Carotid(Urgent)', '227200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(83, 0, 'CT Emergency Report', 'CT Orbits(IES+SMJ)Foreigner', '237700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(84, 0, 'CT Emergency Report', 'CT Paranasal Sinus(Urgent)', '132700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(85, 0, 'CT Emergency Report', 'CT PNS(IES+SMJ)Foreigner', '237700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(86, 0, 'CT Emergency Report', 'CT Pulmonary Arteries(IES+SMJ)Foreigner', '427200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(87, 0, 'CT Emergency Report', 'CT Pulmonary Arteries(Urgent)', '237200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(88, 0, 'CT Emergency Report', 'CT Renal Arteries(IES+SMJ)Foreigner', '427200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(89, 0, 'CT Emergency Report', 'CT Renal Arteries(Urgent)', '237200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(90, 0, 'CT Emergency Report', 'CT Superior Mesenteric Artery(IES+SMJ)Foreigner', '427200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(91, 0, 'CT Emergency Report', 'CT Superior Mesenteric Artery(Urgent)', '237200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(92, 0, 'CT Emergency Report', 'CT Temporal Bones(IES+SMJ)Foreigner', '237700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(93, 0, 'CT Emergency Report', 'CT Thoracic Aorta(IES+SMJ)Foreigner', '427200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(94, 0, 'CT Emergency Report', 'CT Thoracic Aorta(Urgent)', '237200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(95, 0, 'CT Emergency Report', 'CT Thoracic Lumbar Spine(Urgent)', '217700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(96, 0, 'CT Emergency Report', 'CT Thoracic Spine(IES+SMJ)Foreigner', '267700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(97, 0, 'CT Emergency Report', 'CT Thoracic Spine(Urgent)', '147700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(98, 0, 'CT Emergency Report', 'CT Thotaco Lumber Spine(IES+SMJ)Foreigner', '407700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(99, 0, 'CT Emergency Report', 'CT Upper Limbs(IES+SMJ)', '467200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(100, 0, 'CT Emergency Report', 'CT Upper Limbs(Urgent)', '257200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(101, 0, 'CT Emergency Report', 'CT Upper&Lower Abdomen(IES+SMJ)Foreigner', '445400.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(102, 0, 'CT Emergency Report', 'CT Urgent Report', '20800.00', '0.00', '0.00', '15600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(103, 0, 'CT Emergency Report', 'CT Urgent Report (Walk In)', '26000.00', '0.00', '0.00', '15600.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(104, 0, 'CT Emergency Report', 'CT Urgent Report Fee', '57200.00', '0.00', '0.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(105, 0, 'CT Emergency Report', 'CT Urgent Report Fee(Walk In)', '62400.00', '0.00', '0.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(106, 0, 'CT Emergency Report', 'CT Urgent Report Fees', '37700.00', '0.00', '0.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(107, 0, 'CT Emergency Report', 'CT Urgent Report Fees(Walk In)', '42900.00', '0.00', '0.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(108, 0, 'CT Emergency Report', 'CT Urogram KUB(IES+SMJ)Foreigner', '267700.00', '0.00', '7500.00', '32500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(109, 0, 'CT Emergency Report', 'CT Venogram Of Intracranial Sinuses(IES+SMJ)Foreigner', '407200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(110, 0, 'CT Emergency Report', 'CT Venogram Of Intracranial Sinuses(Urgent)', '227200.00', '0.00', '15000.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(111, 0, 'CT Extra Film', 'CT Extra Film ( IES + SMJ )', '10000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(112, 0, 'CT Extra Film', 'CT Extra Film 1', '3000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(113, 0, 'CT Extra Film', 'CT Extra Film 2', '6000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(114, 0, 'CT Extra Film', 'CT Extra Film 3', '9000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(115, 0, 'CT Extra Film', 'CT Extra Film 4', '12000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(116, 0, 'CT Extra Film', 'CT Extra Film 5', '15000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(117, 0, 'CT-Contrast', 'CT Contrast', '60000.00', '0.00', '3000.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(118, 0, 'CT-Contrast', 'CT Contrast(IES+SMJ)', '124000.00', '0.00', '3000.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(119, 0, 'CT-Contrast', 'CT Extra Contrast 10 Ml', '6000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(120, 0, 'CT-Contrast', 'CT Extra Contrast 20 Ml', '12000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(121, 0, 'CT-Contrast', 'CT Extra Contrast 5 Ml', '3000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(122, 0, 'Echo', 'Echo(cardiac)', '25500.00', '0.00', '2100.00', '5000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(123, 0, 'Hearing', 'ENT Cabinet', '15000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(124, 0, 'Hearing', 'H', '0.00', '0.00', '1200.00', '10000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(125, 0, 'Hearing', 'H H', '600.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(126, 0, 'Hearing', 'H h H', '30000.00', '0.00', '700.00', '7500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(127, 0, 'Hearing', 'HE', '250.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(128, 0, 'Hearing', 'HEA', '500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(129, 0, 'Hearing', 'HEAa', '12000.00', '0.00', '0.00', '6000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(130, 0, 'Hearing', 'HH', '1000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(131, 0, 'Hearing', 'HHH', '5000.00', '0.00', '0.00', '5000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(132, 0, 'Hearing', 'HHHH', '35000.00', '0.00', '700.00', '7500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(133, 0, 'Hearing', 'Suction(ENT)', '1500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(134, 0, 'MRI', 'Femoral Run Off MRA(Lower limb) with Contrast', '287500.00', '0.00', '17500.00', '25000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(135, 0, 'MRI', 'MR Cholangiogram with contrast (Urgent)', '265000.00', '0.00', '14000.00', '40000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(136, 0, 'MRI', 'MR-Cholangiogram(Without Contrast)', '230000.00', '0.00', '14000.00', '20000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(137, 0, 'MRI', 'MRA Abdomen & pelvis  with contrast (Urgent)', '327500.00', '0.00', '17500.00', '50000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(138, 0, 'MRI', 'MRA Abdomen & Pelvis with Contrast', '287500.00', '0.00', '17500.00', '25000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(139, 0, 'MRI', 'MRA Brain (Without Contrast)', '218500.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(140, 0, 'MRI', 'MRA Brain without contrast (Urgent)', '252500.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(141, 0, 'MRI', 'MRA Chest without Contrast', '287500.00', '0.00', '17500.00', '25000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(142, 0, 'MRI', 'MRA Chest without contrast (Urgent)', '327500.00', '0.00', '17500.00', '50000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(143, 0, 'MRI', 'MRA Femoral Run Off with contrast (Urgent)', '327500.00', '0.00', '17500.00', '50000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(144, 0, 'MRI', 'MRA Neck with contrast (Urgent)', '252500.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(145, 0, 'MRI', 'MRA Neck(With Contrast)', '218500.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(146, 0, 'MRI', 'MRI Abd & Pelvis', '260000.00', '0.00', '17500.00', '25000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(147, 0, 'MRI', 'MRI Abd & Pelvis (Urgent)', '300000.00', '0.00', '17500.00', '50000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(148, 0, 'MRI', 'MRI Abdomen', '160000.00', '0.00', '11200.00', '16000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(149, 0, 'MRI', 'MRI Abdomen (Urgent)', '191000.00', '0.00', '11200.00', '32000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(150, 0, 'MRI', 'MRI Ankle', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(151, 0, 'MRI', 'MRI Ankle (Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(152, 0, 'MRI', 'MRI Arm', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(153, 0, 'MRI', 'MRI Arm (Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(154, 0, 'MRI', 'MRI Brain', '160000.00', '0.00', '11200.00', '16000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(155, 0, 'MRI', 'MRI Brain (Urgent)', '191000.00', '0.00', '11200.00', '32000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(156, 0, 'MRI', 'MRI Breast', '160000.00', '0.00', '11200.00', '16000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(157, 0, 'MRI', 'MRI Breast (Urgent)', '191000.00', '0.00', '11200.00', '32000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(158, 0, 'MRI', 'MRI CD', '1000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(159, 0, 'MRI', 'MRI Cervical Spine', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(160, 0, 'MRI', 'MRI Cervical Spine (Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(161, 0, 'MRI', 'MRI Cervico Thoracic Spine', '260000.00', '0.00', '17500.00', '25000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(162, 0, 'MRI', 'MRI Cervico Thoracic Spine (Urgent)', '300000.00', '0.00', '17500.00', '50000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(163, 0, 'MRI', 'MRI Chest(Thorax)', '160000.00', '0.00', '11200.00', '16000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(164, 0, 'MRI', 'MRI Chest(Thorax) (Urgent)', '191000.00', '0.00', '11200.00', '32000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(165, 0, 'MRI', 'MRI Coccyx', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(166, 0, 'MRI', 'MRI Coccyx(Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(167, 0, 'MRI', 'MRI Elbow', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(168, 0, 'MRI', 'MRI Elbow (Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(169, 0, 'MRI', 'MRI Extremity(Shoulder, Neck) (Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(170, 0, 'MRI', 'MRI Extremity(Shoulder,Neck)', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(171, 0, 'MRI', 'MRI Femur', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(172, 0, 'MRI', 'MRI Femur( Urgent )', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(173, 0, 'MRI', 'MRI Foot', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(174, 0, 'MRI', 'MRI Foot(Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(175, 0, 'MRI', 'MRI Hand', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(176, 0, 'MRI', 'MRI Hand(Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(177, 0, 'MRI', 'MRI Heart', '160000.00', '0.00', '11200.00', '16000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(178, 0, 'MRI', 'MRI Heart (Urgent)', '191000.00', '0.00', '11200.00', '32000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(179, 0, 'MRI', 'MRI Hip', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(180, 0, 'MRI', 'MRI Hip (Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(181, 0, 'MRI', 'MRI Humerus', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(182, 0, 'MRI', 'MRI Humerus(Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(183, 0, 'MRI', 'MRI Knee', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(184, 0, 'MRI', 'MRI Knee (Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(185, 0, 'MRI', 'MRI Leg', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(186, 0, 'MRI', 'MRI Leg (Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(187, 0, 'MRI', 'MRI Limb', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(188, 0, 'MRI', 'MRI Limb (Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(189, 0, 'MRI', 'MRI Liver', '160000.00', '0.00', '11200.00', '16000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(190, 0, 'MRI', 'MRI Liver (Urgent)', '191000.00', '0.00', '11200.00', '32000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(191, 0, 'MRI', 'MRI Lumbar Spine', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(192, 0, 'MRI', 'MRI Lumbar Spine (Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(193, 0, 'MRI', 'MRI MRCP', '88500.00', '0.00', '6300.00', '9000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(194, 0, 'MRI', 'MRI MRCP (Urgent)', '112500.00', '0.00', '6300.00', '18000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(195, 0, 'MRI', 'MRI Neck', '160000.00', '0.00', '11200.00', '16000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(196, 0, 'MRI', 'MRI Neck (Urgent)', '191000.00', '0.00', '11200.00', '32000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(197, 0, 'MRI', 'MRI Pelvis(Bone)', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(198, 0, 'MRI', 'MRI Pelvis(Bone-Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(199, 0, 'MRI', 'MRI Pelvis(Soft Urgent)', '191000.00', '0.00', '11200.00', '32000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(200, 0, 'MRI', 'MRI Pelvis(Soft)', '160000.00', '0.00', '11200.00', '16000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(201, 0, 'MRI', 'MRI Reading-A', '16000.00', '0.00', '0.00', '16000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(202, 0, 'MRI', 'MRI Reading-B', '19000.00', '0.00', '0.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(203, 0, 'MRI', 'MRI Shoulder', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(204, 0, 'MRI', 'MRI Shoulder(Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(205, 0, 'MRI', 'MRI Thoracic & Lumbar Spine', '260000.00', '0.00', '17500.00', '25000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(206, 0, 'MRI', 'MRI Thoracic & Lumbar Spine (Urgent)', '300000.00', '0.00', '17500.00', '50000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(207, 0, 'MRI', 'MRI Thoracic Spine', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(208, 0, 'MRI', 'MRI Thoracic Spine(Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(209, 0, 'MRI', 'MRI Whole Spine Survey', '320000.00', '0.00', '36400.00', '52000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(210, 0, 'MRI', 'MRI Whole Spine Survey(Urgent)', '387000.00', '0.00', '36400.00', '104000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(211, 0, 'MRI', 'MRI Wrist', '190000.00', '0.00', '13300.00', '19000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(212, 0, 'MRI', 'MRI Wrist(Urgent)', '224000.00', '0.00', '13300.00', '38000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(213, 0, 'MRI', 'MRI+MRA Brain', '287500.00', '0.00', '17500.00', '25000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(214, 0, 'MRI Emergency Report', 'MRI ER Report For Abd&Pelvis', '356200.00', '0.00', '17500.00', '91000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(215, 0, 'MRI Emergency Report', 'MRI ER Report For Abdomen', '210700.00', '0.00', '11200.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(216, 0, 'MRI Emergency Report', 'MRI ER Report For Ankle', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(217, 0, 'MRI Emergency Report', 'MRI ER Report For Arm', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(218, 0, 'MRI Emergency Report', 'MRI ER Report For Brain', '191200.00', '0.00', '11200.00', '26000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(219, 0, 'MRI Emergency Report', 'MRI ER Report For Breast', '210700.00', '0.00', '11200.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(220, 0, 'MRI Emergency Report', 'MRI ER Report For Cervical Spine', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(221, 0, 'MRI Emergency Report', 'MRI ER Report For Cervico Thoracic  Spine', '356200.00', '0.00', '17500.00', '91000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(222, 0, 'MRI Emergency Report', 'MRI ER Report For Chest', '210700.00', '0.00', '11200.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(223, 0, 'MRI Emergency Report', 'MRI ER Report For Coccyx', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(224, 0, 'MRI Emergency Report', 'MRI ER Report For Elbow', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(225, 0, 'MRI Emergency Report', 'MRI ER Report For Extremity(Shoulder,Neck)', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(226, 0, 'MRI Emergency Report', 'MRI ER Report For Femur', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(227, 0, 'MRI Emergency Report', 'MRI ER Report For Foot', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(228, 0, 'MRI Emergency Report', 'MRI ER Report For Hand', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(229, 0, 'MRI Emergency Report', 'MRI ER Report For Heart', '210700.00', '0.00', '11200.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(230, 0, 'MRI Emergency Report', 'MRI ER Report For Hip/Both Hip', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(231, 0, 'MRI Emergency Report', 'MRI ER Report For Humerus', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(232, 0, 'MRI Emergency Report', 'MRI ER Report For Knee Joint', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(233, 0, 'MRI Emergency Report', 'MRI ER Report For Leg', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(234, 0, 'MRI Emergency Report', 'MRI ER Report For Limb', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(235, 0, 'MRI Emergency Report', 'MRI ER Report For Liver', '210700.00', '0.00', '11200.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(236, 0, 'MRI Emergency Report', 'MRI ER Report For Lumbar Spine', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(237, 0, 'MRI Emergency Report', 'MRI ER Report For MRCP', '139200.00', '0.00', '6300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(238, 0, 'MRI Emergency Report', 'MRI ER Report For Neck', '210700.00', '0.00', '11200.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(239, 0, 'MRI Emergency Report', 'MRI ER Report For Pelvis(Bone)', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(240, 0, 'MRI Emergency Report', 'MRI ER Report For Pelvis(Soft)', '210700.00', '0.00', '11200.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(241, 0, 'MRI Emergency Report', 'MRI ER Report For Shoulder', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(242, 0, 'MRI Emergency Report', 'MRI ER Report For Thoracic &Lumbar Spine', '356200.00', '0.00', '17500.00', '91000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(243, 0, 'MRI Emergency Report', 'MRI ER Report For Thoracic Spine', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(244, 0, 'MRI Emergency Report', 'MRI ER Report For Wrist', '240700.00', '0.00', '13300.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(245, 0, 'MRI Emergency Report', 'MRI ER Report Only  Reading Fee', '50700.00', '0.00', '0.00', '45500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(246, 0, 'MRI Emergency Report', 'MRI ER Report Only Reading  Fee', '96200.00', '0.00', '0.00', '91000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(247, 0, 'MRI Emergency Report', 'MRI ER Report Only Reading Fee', '31200.00', '0.00', '0.00', '26000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(248, 0, 'MRI Extra Film', 'MRI Extra Flim-1', '3500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(249, 0, 'MRI Extra Film', 'MRI Extra Flim-2', '7000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(250, 0, 'MRI Extra Film', 'MRI Extra Flim-3', '10500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(251, 0, 'MRI Extra Film', 'MRI Extra Flim-4', '14000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(252, 0, 'MRI Extra Film', 'MRI Extra Flim-5', '17500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(253, 0, 'MRI-Contrast', 'MRI Contrast', '20000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(254, 0, 'MRI-Megaray', 'Megaray/1-ml', '4500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(255, 0, 'MRI-Megaray', 'Megaray/10-ml', '45000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(256, 0, 'MRI-Megaray', 'Megaray/2-ml', '9000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(257, 0, 'MRI-Megaray', 'Megaray/20-ml', '90000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(258, 0, 'MRI-Megaray', 'Megaray/3-ml', '13500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(259, 0, 'MRI-Megaray', 'Megaray/5-ml', '22500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(260, 0, 'Polysonogram', 'Delet', '2500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(261, 0, 'Polysonogram', 'Polysonogram (Complete)', '97000.00', '0.00', '5000.00', '15000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(262, 0, 'Polysonogram', 'Polysonogram(Screening)', '65000.00', '0.00', '5000.00', '25000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(263, 0, 'ULTRA SONOGRAM', '3D Fetal Ultrasound', '30000.00', '0.00', '2500.00', '10000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(264, 0, 'ULTRA SONOGRAM', '3D Fetal Ultrasound/Foreinger', '35000.00', '0.00', '2500.00', '15000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(265, 0, 'ULTRA SONOGRAM', '4D Fetal Ultrasound', '30000.00', '0.00', '2500.00', '10000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(266, 0, 'ULTRA SONOGRAM', '4D Fetal Ultrasound/Foreinger', '35000.00', '0.00', '2500.00', '15000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(267, 0, 'ULTRA SONOGRAM', 'Doppler(Arterial Both Lower Limbs)', '40000.00', '0.00', '2500.00', '20000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(268, 0, 'ULTRA SONOGRAM', 'Doppler(Arterial Both Lower Limbs)/Foreigner', '45000.00', '0.00', '2500.00', '25000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(269, 0, 'ULTRA SONOGRAM', 'Doppler(Carotid/Renal/Liver)', '29000.00', '0.00', '2500.00', '12000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(270, 0, 'ULTRA SONOGRAM', 'Doppler(Carotid/Renal/Liver)/Foreigner', '34000.00', '0.00', '2500.00', '17000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(271, 0, 'ULTRA SONOGRAM', 'Doppler(Vascular Color)', '29000.00', '0.00', '2500.00', '12000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(272, 0, 'ULTRA SONOGRAM', 'Doppler(Vascular Color)/Foreinger', '34000.00', '0.00', '2500.00', '17000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(273, 0, 'ULTRA SONOGRAM', 'MCUG', '50000.00', '0.00', '5000.00', '5000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(274, 0, 'ULTRA SONOGRAM', 'Pelvis US + Vaginal Probe', '17500.00', '0.00', '1500.00', '5000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(275, 0, 'ULTRA SONOGRAM', 'TVS', '20000.00', '0.00', '1500.00', '10000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(276, 0, 'ULTRA SONOGRAM', 'TVS/Foreigner', '27500.00', '0.00', '1500.00', '15000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(277, 0, 'ULTRA SONOGRAM', 'Ultrasound ( Portable )', '30000.00', '0.00', '1000.00', '15000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(278, 0, 'ULTRA SONOGRAM', 'Ultrasound (Reading)/Foreigner', '11000.00', '0.00', '0.00', '11000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(279, 0, 'ULTRA SONOGRAM', 'Ultrasound Abd (Siemens)/Foreigner', '21000.00', '0.00', '800.00', '11000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(280, 0, 'ULTRA SONOGRAM', 'Ultrasound Abd( Siemens)', '16000.00', '0.00', '800.00', '6000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(281, 0, 'ULTRA SONOGRAM', 'Ultrasound Abdomen', '13000.00', '0.00', '800.00', '6000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(282, 0, 'ULTRA SONOGRAM', 'Ultrasound Abdomen(IES)', '13000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(283, 0, 'ULTRA SONOGRAM', 'Ultrasound Abdomen/Foreigner', '18000.00', '0.00', '800.00', '11000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(284, 0, 'ULTRA SONOGRAM', 'Ultrasound Breast', '17500.00', '0.00', '800.00', '5000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(285, 0, 'ULTRA SONOGRAM', 'Ultrasound Breast/Foreigner', '22500.00', '0.00', '800.00', '10000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(286, 0, 'ULTRA SONOGRAM', 'Ultrasound Fetal Survey', '20000.00', '0.00', '800.00', '10000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(287, 0, 'ULTRA SONOGRAM', 'Ultrasound Fetal Survey/Foreigner', '25000.00', '0.00', '800.00', '15000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(288, 0, 'ULTRA SONOGRAM', 'Ultrasount ( Reading )', '6000.00', '0.00', '0.00', '6000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(289, 0, 'X-RAY', 'Abdomen (2 views)/Foreigner', '35000.00', '0.00', '2700.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(290, 0, 'X-RAY', 'Abdomen( 2 Views )', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(291, 0, 'X-RAY', 'Ankle (1view)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(292, 0, 'X-RAY', 'Ankle (2views)/Foreigner', '35000.00', '0.00', '2700.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(293, 0, 'X-RAY', 'Ankle Joint (1 View Adult )', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(294, 0, 'X-RAY', 'Ankle Joint (1view Adult)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(295, 0, 'X-RAY', 'Ankle Joint (Adult 2views )/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(296, 0, 'X-RAY', 'Ankle Joint (From 10to16 yrs 2views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(297, 0, 'X-RAY', 'Ankle Joint (Under 10yrs 2views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL);
INSERT INTO `investigations_imaging` (`id`, `service_id`, `group_name`, `service_name`, `service_charges`, `urgent_fees`, `refer_fees`, `reading_fees`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(298, 0, 'X-RAY', 'Ankle joint(Adult, 2views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(299, 0, 'X-RAY', 'Ankle joint(From 10to16yrs, 2views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(300, 0, 'X-RAY', 'Ankle joint(Under 10yrs, 2views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(301, 0, 'X-RAY', 'Ankle(1-View)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(302, 0, 'X-RAY', 'Ankle(2-Views)', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(303, 0, 'X-RAY', 'Arm & Foream', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(304, 0, 'X-RAY', 'Arm & Foream/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(305, 0, 'X-RAY', 'Barium Enema', '60000.00', '0.00', '5200.00', '5200.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(306, 0, 'X-RAY', 'Barium Meal', '46000.00', '0.00', '4000.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(307, 0, 'X-RAY', 'Barium Meal follow through', '52000.00', '0.00', '4500.00', '4500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(308, 0, 'X-RAY', 'Barium Swallow', '40500.00', '0.00', '3500.00', '3500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(309, 0, 'X-RAY', 'Both Ankle (Adult,AP&Lat)/Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(310, 0, 'X-RAY', 'Both Ankle(Adult,AP&Lat)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(311, 0, 'X-RAY', 'Both Hands ( From 10to16 yrs ,2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(312, 0, 'X-RAY', 'Both Hands (Adult,1view)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(313, 0, 'X-RAY', 'Both Hands (Adult,2views)/Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(314, 0, 'X-RAY', 'Both Hands (Under 10 yrs,1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(315, 0, 'X-RAY', 'Both Hands (Under 10 yrs,2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(316, 0, 'X-RAY', 'Both Hands(Adult, 1view)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(317, 0, 'X-RAY', 'Both Hands(Adult, 2views)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(318, 0, 'X-RAY', 'Both Hands(From 10to16 yrs,1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(319, 0, 'X-RAY', 'Both Hands(From 10to16yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(320, 0, 'X-RAY', 'Both Hands(From 10to16yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(321, 0, 'X-RAY', 'Both Hands(Under 10yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(322, 0, 'X-RAY', 'Both Hands(Under 10yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(323, 0, 'X-RAY', 'Both Heel (Adult ,1 view)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(324, 0, 'X-RAY', 'Both Heel (Adult ,2 view+Axial)/Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(325, 0, 'X-RAY', 'Both Heel (From 10to16 yrs ,1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(326, 0, 'X-RAY', 'Both Heel (From 10to16 yrs,2 views+Axial)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(327, 0, 'X-RAY', 'Both Heel (Under 10 yrs,1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(328, 0, 'X-RAY', 'Both Heel (Under 10 yrs,2 views+Axial)/Foreigner', '30000.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(329, 0, 'X-RAY', 'Both Heel(Adult, 1view)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(330, 0, 'X-RAY', 'Both Heel(Adult, 2views+Axial)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(331, 0, 'X-RAY', 'Both Heel(From 10to16yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(332, 0, 'X-RAY', 'Both Heel(From 10to16yrs, 2views+Axial)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(333, 0, 'X-RAY', 'Both Heel(Under 10yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(334, 0, 'X-RAY', 'Both Heel(Under 10yrs, 2views+Axial)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(335, 0, 'X-RAY', 'Both Hip Joint(Adult , 1 view)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(336, 0, 'X-RAY', 'Both Hip Joint(Adult , 2 views)/Foreigner', '35000.00', '0.00', '2700.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(337, 0, 'X-RAY', 'Both Hip Joint(From 10to16 yrs, 1 view)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(338, 0, 'X-RAY', 'Both Hip Joint(From 10to16yrs, 2 view)/Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(339, 0, 'X-RAY', 'Both Hip Joint(Under 10 yrs , 2 views)/Foreigner', '30500.00', '0.00', '1350.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(340, 0, 'X-RAY', 'Both Hip Joint(Under 10yrs, 1 view)/Foreigner', '17500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(341, 0, 'X-RAY', 'Both Hip Joints(Adult, 1view)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(342, 0, 'X-RAY', 'Both Hip Joints(Adult, 2views)', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(343, 0, 'X-RAY', 'Both Hip Joints(From 10to16yrs, 1view)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(344, 0, 'X-RAY', 'Both Hip Joints(From 10to16yrs, 2views)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(345, 0, 'X-RAY', 'Both Hip Joints(Under 10yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(346, 0, 'X-RAY', 'Both Hip Joints(Under 10yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(347, 0, 'X-RAY', 'Both Knee(Adult ,1 View)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(348, 0, 'X-RAY', 'Both Knee(Adult ,1 view)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(349, 0, 'X-RAY', 'Both Knee(Adult ,2 view)/Foreigner', '35000.00', '0.00', '2700.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(350, 0, 'X-RAY', 'Both Knee(Adult 2View)', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(351, 0, 'X-RAY', 'Both Knee(AP & PA)/Foreigner', '35000.00', '0.00', '2700.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(352, 0, 'X-RAY', 'Both Knee(AP&PA)', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(353, 0, 'X-RAY', 'Both Knee(Frm 10to16 yrs,AP/Lat)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(354, 0, 'X-RAY', 'Both Knee(From 10to16 yrs,AP & Lat)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(355, 0, 'X-RAY', 'Both Knee(From 10to16yrs, AP&Lat)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(356, 0, 'X-RAY', 'Both Knee(From 10to16yrs, AP/Lat)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(357, 0, 'X-RAY', 'Both Knee(Lat+Standing)', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(358, 0, 'X-RAY', 'Both Knee(Lat+Standing)/Foreigner', '35000.00', '0.00', '2700.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(359, 0, 'X-RAY', 'Both Knee(Under 10 yrs,AP & Lat)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(360, 0, 'X-RAY', 'Both Knee(Under 10yrs, AP&Lat)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(361, 0, 'X-RAY', 'Both Knee(Under 10yrs, AP/Lat)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(362, 0, 'X-RAY', 'Both Knee(Under 10yrs,AP/Lat)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(363, 0, 'X-RAY', 'CD ( X-Ray )', '500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(364, 0, 'X-RAY', 'Cervical Spine(Adult ,1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(365, 0, 'X-RAY', 'Cervical Spine(Adult ,2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(366, 0, 'X-RAY', 'Cervical Spine(Adult, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(367, 0, 'X-RAY', 'Cervical Spine(Adult, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(368, 0, 'X-RAY', 'Cervical Spine(From 10to16 yrs,1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(369, 0, 'X-RAY', 'Cervical Spine(From 10to16 yrs,2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(370, 0, 'X-RAY', 'Cervical Spine(From 10to16yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(371, 0, 'X-RAY', 'Cervical Spine(From 10to16yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(372, 0, 'X-RAY', 'Cervical Spine(Under 10 yrs,1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(373, 0, 'X-RAY', 'Cervical Spine(Under 10 yrs,2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(374, 0, 'X-RAY', 'Cervical Spine(Under 10yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(375, 0, 'X-RAY', 'Cervical Spine(Under 10yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(376, 0, 'X-RAY', 'Chest X-Ray(PA) Medical Check-Up', '10000.00', '0.00', '0.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(377, 0, 'X-RAY', 'Chest(Adult , 1 view)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(378, 0, 'X-RAY', 'Chest(Adult , 2 views)/Foreigner', '35000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(379, 0, 'X-RAY', 'Chest(Adult, 1view)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(380, 0, 'X-RAY', 'Chest(Adult, 2views)', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(381, 0, 'X-RAY', 'Chest(From 10to16 yrs,1 view)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(382, 0, 'X-RAY', 'Chest(From 10to16 yrs,2 views)/Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(383, 0, 'X-RAY', 'Chest(From 10to16yrs, 1view)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(384, 0, 'X-RAY', 'Chest(From 10to16yrs, 2views)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(385, 0, 'X-RAY', 'Chest(Under 10 yrs, 1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(386, 0, 'X-RAY', 'Chest(Under 10yrs, 1 view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(387, 0, 'X-RAY', 'Chest(Under 10yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(388, 0, 'X-RAY', 'Chest(Under 10yrs,2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(389, 0, 'X-RAY', 'Elbow(Adult , 2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(390, 0, 'X-RAY', 'Elbow(Adult, 2views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(391, 0, 'X-RAY', 'Elbow(From 10to16 yrs, 2 views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(392, 0, 'X-RAY', 'Elbow(From 10to16yrs, 2views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(393, 0, 'X-RAY', 'Elbow(Under 10 yrs, 2 views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(394, 0, 'X-RAY', 'Elbow(Under 10yrs, 2views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(395, 0, 'X-RAY', 'Femur(1-View)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(396, 0, 'X-RAY', 'Femur(1-view)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(397, 0, 'X-RAY', 'Femur(2-view)/Foreigner', '35000.00', '0.00', '2700.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(398, 0, 'X-RAY', 'Femur(2-Views)', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(399, 0, 'X-RAY', 'Film (14" x 17")', '1200.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(400, 0, 'X-RAY', 'Film-', '5000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(401, 0, 'X-RAY', 'Film-A', '10000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(402, 0, 'X-RAY', 'Film-B', '11500.00', '0.00', '0.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(403, 0, 'X-RAY', 'Film-C', '15500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(404, 0, 'X-RAY', 'Film-D', '23500.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(405, 0, 'X-RAY', 'Film-E', '26000.00', '0.00', '0.00', '0.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(406, 0, 'X-RAY', 'Foot(Adult ,2 views)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(407, 0, 'X-RAY', 'Foot(Adult, 2views)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(408, 0, 'X-RAY', 'Foot(From 10to16 yrs,2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(409, 0, 'X-RAY', 'Foot(From 10to16yrs, 2views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(410, 0, 'X-RAY', 'Foot(Under 10 yrs,2 views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(411, 0, 'X-RAY', 'Foot(Under 10yrs, 2views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(412, 0, 'X-RAY', 'Forearm(Adult ,2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(413, 0, 'X-RAY', 'Forearm(Adult, 2views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(414, 0, 'X-RAY', 'Forearm(From 10to16 yrs ,2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(415, 0, 'X-RAY', 'Forearm(From 10to16yrs, 2views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(416, 0, 'X-RAY', 'Forearm(Under 10 yrs ,2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(417, 0, 'X-RAY', 'Forearm(Under 10yrs, 2views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(418, 0, 'X-RAY', 'Hand (Adult ,2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(419, 0, 'X-RAY', 'Hand (From 10to16 yrs,2 views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(420, 0, 'X-RAY', 'Hand (Under 10 yrs,2 views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(421, 0, 'X-RAY', 'Hand(Adult, 2 views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(422, 0, 'X-RAY', 'Hand(From 10to16yrs, 2 views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(423, 0, 'X-RAY', 'Hand(Under 10yrs, 2 views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(424, 0, 'X-RAY', 'Heel(Adult, 2 views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(425, 0, 'X-RAY', 'Heel(Adult,2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(426, 0, 'X-RAY', 'Heel(From 10to16 yrs,2 views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(427, 0, 'X-RAY', 'Heel(From 10to16yrs, 2 views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(428, 0, 'X-RAY', 'Heel(Under 10 yrs,2 views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(429, 0, 'X-RAY', 'Heel(Under 10yrs, 2 views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(430, 0, 'X-RAY', 'Hip Joint (Adult , 2 view)/Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(431, 0, 'X-RAY', 'Hip Joint (Adult,1 view)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(432, 0, 'X-RAY', 'Hip Joint (From 10to16 yrs , 2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(433, 0, 'X-RAY', 'Hip Joint (From 10to16 yrs,1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(434, 0, 'X-RAY', 'Hip Joint (Under 10yrs,1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(435, 0, 'X-RAY', 'Hip Joint (Under 10yrs,2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(436, 0, 'X-RAY', 'Hip Joint(Adult, 1view)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(437, 0, 'X-RAY', 'Hip Joint(Adult, 2views)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(438, 0, 'X-RAY', 'Hip Joint(From 10to16yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(439, 0, 'X-RAY', 'Hip Joint(From 10to16yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(440, 0, 'X-RAY', 'Hip Joint(Under 10yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(441, 0, 'X-RAY', 'Hip Joint(Under 10yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(442, 0, 'X-RAY', 'Humerus (Adult ,2 views)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(443, 0, 'X-RAY', 'Humerus (From 10to16 yrs ,2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(444, 0, 'X-RAY', 'Humerus (Under 10 yrs,2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(445, 0, 'X-RAY', 'Humerus(Adult, 2 views)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(446, 0, 'X-RAY', 'Humerus(From 10to16yrs, 2 views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(447, 0, 'X-RAY', 'Humerus(Under 10yrs, 2 views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(448, 0, 'X-RAY', 'IVU/IVP(Without contrast fees)', '57500.00', '0.00', '5000.00', '5000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(449, 0, 'X-RAY', 'Knee Joint (From 10to16 yrs,2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(450, 0, 'X-RAY', 'Knee Joint (Under 10 yrs,2 views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(451, 0, 'X-RAY', 'Knee Joint(Adult ,2 views)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(452, 0, 'X-RAY', 'Knee Joint(Adult, 2views)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(453, 0, 'X-RAY', 'Knee Joint(From 10to16yrs, 2views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(454, 0, 'X-RAY', 'Knee Joint(Under 10yrs, 2views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(455, 0, 'X-RAY', 'KUB (Adult,Abdoman)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(456, 0, 'X-RAY', 'KUB (From 10to16 yrs,Abdoman)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(457, 0, 'X-RAY', 'KUB (Under 10 yrs,Abdoman)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(458, 0, 'X-RAY', 'KUB(Adult, Abdomen)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(459, 0, 'X-RAY', 'KUB(From 10to16yrs, Abdomen)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(460, 0, 'X-RAY', 'KUB(Under 10yrs, Abdomen)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(461, 0, 'X-RAY', 'Leg (2 views)/Foreigner', '35000.00', '0.00', '2700.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(462, 0, 'X-RAY', 'Leg (Adult ,2 views)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(463, 0, 'X-RAY', 'Leg (From 10to16yrs,2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(464, 0, 'X-RAY', 'Leg (Under 10 yrs , 2 views)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(465, 0, 'X-RAY', 'Leg(2-Views)', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(466, 0, 'X-RAY', 'Leg(Adult, 2 views)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(467, 0, 'X-RAY', 'Leg(From 10to16yrs, 2 views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(468, 0, 'X-RAY', 'Leg(Under 10yrs, 2 views)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(469, 0, 'X-RAY', 'Lumbar Spine', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(470, 0, 'X-RAY', 'Lumbar/Lumbo-sacral spine(Adult, 2views)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(471, 0, 'X-RAY', 'Lumbar/Lumbo-sacral spine(From 10to16yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(472, 0, 'X-RAY', 'Lumbar/Lumbo-sacral spine(Under 10yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(473, 0, 'X-RAY', 'Lumber Spine/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(474, 0, 'X-RAY', 'Lumber/Lumbo-sacral Spine(Adult,2 views)/Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(475, 0, 'X-RAY', 'Lumber/Lumbo-sacral Spine(From 10to16 yrs,2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(476, 0, 'X-RAY', 'Lumber/Lumbo-sacral Spine(Under 10 yrs,2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(477, 0, 'X-RAY', 'Neck 2 views (Above 3 yrs)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(478, 0, 'X-RAY', 'Neck 2 views (Under 3 yrs)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(479, 0, 'X-RAY', 'Neck-2 Views( Under 3 Years)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(480, 0, 'X-RAY', 'Neck-2 Views(Above  3 Years)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(481, 0, 'X-RAY', 'Pelvis(Adult, 1view)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(482, 0, 'X-RAY', 'Pelvis(Adult, 2 views)/Foreigner', '35000.00', '0.00', '2700.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(483, 0, 'X-RAY', 'Pelvis(Adult,1 view)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(484, 0, 'X-RAY', 'Pelvis(Aldut,2-view)', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(485, 0, 'X-RAY', 'Pelvis(From 10to16 yrs, 1 view)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(486, 0, 'X-RAY', 'Pelvis(From 10to16yrs, 1view)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(487, 0, 'X-RAY', 'Pelvis(Under 10 yrs, 1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(488, 0, 'X-RAY', 'Pelvis(Under 10yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(489, 0, 'X-RAY', 'Plain Abd (Adult,1 view)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(490, 0, 'X-RAY', 'Plain Abd(Adult, 1view)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(491, 0, 'X-RAY', 'Plain Abd(From 10to16 yrs,1 view)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(492, 0, 'X-RAY', 'Plain Abd(From 10to16yrs, 1view)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(493, 0, 'X-RAY', 'Plain Abd(Under 10 yrs,1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(494, 0, 'X-RAY', 'Plain Abd(Under 10yrs, 1 view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(495, 0, 'X-RAY', 'Portable Fees ( X-Ray )', '6000.00', '0.00', '0.00', '6000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(496, 0, 'X-RAY', 'Portable Fees ( X-Ray )/Night', '8000.00', '0.00', '0.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(497, 0, 'X-RAY', 'Reading( X-Ray ) 1-View', '2000.00', '0.00', '0.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(498, 0, 'X-RAY', 'Reading( X-Ray ) 2-View', '4000.00', '0.00', '0.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(499, 0, 'X-RAY', 'Reading(X-Ray)1 View/Foreigner', '4000.00', '0.00', '0.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(500, 0, 'X-RAY', 'Reading(X-Ray)2-Views/Foreigner', '8000.00', '0.00', '0.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(501, 0, 'X-RAY', 'Sacro-iliac joint(Adult, AP)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(502, 0, 'X-RAY', 'Sacro-iliac joint(Adult,AP)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(503, 0, 'X-RAY', 'Sacro-iliac joint(From 10to16 yrs,AP)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(504, 0, 'X-RAY', 'Sacro-iliac joint(From 10to16yrs, AP)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(505, 0, 'X-RAY', 'Sacro-iliac joint(Under 10 yrs,AP)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(506, 0, 'X-RAY', 'Sacro-iliac joint(Under 10yrs, AP)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(507, 0, 'X-RAY', 'Sacrum & Coccyx(Adult, 1view)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(508, 0, 'X-RAY', 'Sacrum & Coccyx(Adult, 2views)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(509, 0, 'X-RAY', 'Sacrum & Coccyx(Adult,1view)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(511, 0, 'X-RAY', 'Sacrum & Coccyx(From 10to16yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(512, 0, 'X-RAY', 'Sacrum & Coccyx(From 10to16yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(513, 0, 'X-RAY', 'Sacrum & Coccyx(From 10to16yrs,1view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(514, 0, 'X-RAY', 'Sacrum & Coccyx(From 10to16yrs,2views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(515, 0, 'X-RAY', 'Sacrum & Coccyx(Under 10yrs, 1view)', '13000.00', '0.00', '1100.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(516, 0, 'X-RAY', 'Sacrum & Coccyx(Under 10yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(517, 0, 'X-RAY', 'Sacrum & Coccyx(Under 10yrs,2views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(518, 0, 'X-RAY', 'Sacrum & Coccyx(Under10yrs,1view)/Foreigner', '15000.00', '0.00', '1100.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(519, 0, 'X-RAY', 'Shoulder Joint (Adult 1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(520, 0, 'X-RAY', 'Shoulder Joint (Adult 2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(521, 0, 'X-RAY', 'Shoulder Joint (From 10to16 yrs 2 views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(522, 0, 'X-RAY', 'Shoulder Joint (From 10to16yrs 1view)/Foreigner', '15000.00', '0.00', '1100.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(523, 0, 'X-RAY', 'Shoulder Joint (Under 10yrs 1 view)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(524, 0, 'X-RAY', 'Shoulder Joint (Under 10yrs 2views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(525, 0, 'X-RAY', 'Shoulder Joint(Adult, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(526, 0, 'X-RAY', 'Shoulder Joint(Adult, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(527, 0, 'X-RAY', 'Shoulder Joint(From 10to16yrs, 1view)', '13000.00', '0.00', '1100.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(528, 0, 'X-RAY', 'Shoulder Joint(From 10to16yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(529, 0, 'X-RAY', 'Shoulder Joint(Under 10yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(530, 0, 'X-RAY', 'Shoulder Joint(Under 10yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(531, 0, 'X-RAY', 'Sinuses (Adult, 2Views)/Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(532, 0, 'X-RAY', 'Sinuses (Adult,1View)/Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(533, 0, 'X-RAY', 'Sinuses (From 10to16 yrs, 1View)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(534, 0, 'X-RAY', 'Sinuses (From 10to16 yrs, 2Views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(535, 0, 'X-RAY', 'Sinuses (Under 10yrs, 1View)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(536, 0, 'X-RAY', 'Sinuses (Under 10yrs, 2Views)/Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(537, 0, 'X-RAY', 'Sinuses(Adult, 1view)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(538, 0, 'X-RAY', 'Sinuses(Adult, 2views)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(539, 0, 'X-RAY', 'Sinuses(From 10to16yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(540, 0, 'X-RAY', 'Sinuses(From 10to16yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(541, 0, 'X-RAY', 'Sinuses(Under 10yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(542, 0, 'X-RAY', 'Sinuses(Under 10yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(543, 0, 'X-RAY', 'Skull (Adult, 1view)/ Foreigner', '20000.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(544, 0, 'X-RAY', 'Skull (Adult, 2views)/ Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(545, 0, 'X-RAY', 'Skull (From 10to16 yrs, 1view)/ Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(546, 0, 'X-RAY', 'Skull (From 10to16 yrs, 2views)/ Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(547, 0, 'X-RAY', 'Skull (Under 10 yrs, 1view)/ Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(548, 0, 'X-RAY', 'Skull (Under 10 yrs, 2views)/ Foreigner', '30500.00', '0.00', '2300.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(549, 0, 'X-RAY', 'Skull(Adult, 1view)', '18000.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(550, 0, 'X-RAY', 'Skull(Adult, 2views)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(551, 0, 'X-RAY', 'Skull(From 10to16yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(552, 0, 'X-RAY', 'Skull(From 10to16yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(553, 0, 'X-RAY', 'Skull(Under 10yrs, 1view)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(554, 0, 'X-RAY', 'Skull(Under 10yrs, 2views)', '26500.00', '0.00', '2300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(555, 0, 'X-RAY', 'Thigh (Adult 2views)/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(556, 0, 'X-RAY', 'Thigh (From 10to16 yrs 2views)/Foreigner', '20000.00', '0.00', '1300.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(557, 0, 'X-RAY', 'Thigh (Under 10yrs 2views)/Foreigner', '17500.00', '0.00', '1550.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(558, 0, 'X-RAY', 'Thigh(Adult, 2views)', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(559, 0, 'X-RAY', 'Thigh(From 10to16yrs, 2views)', '18000.00', '0.00', '1300.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(560, 0, 'X-RAY', 'Thigh(Under 10yrs, 2views)', '15500.00', '0.00', '1550.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(561, 0, 'X-RAY', 'Thoracic Spine (Adult 2views)/Foreigner', '35000.00', '0.00', '2700.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(562, 0, 'X-RAY', 'Thoracic Spine (From10to16 yrs 2views)/Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(563, 0, 'X-RAY', 'Thoracic Spine (Under 10 2views)/Foreigner', '33000.00', '0.00', '2500.00', '8000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(564, 0, 'X-RAY', 'Thoracic Spine(Adult, 2views)', '31000.00', '0.00', '2700.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(565, 0, 'X-RAY', 'Thoracic Spine(From 10to16yrs, 2views)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(566, 0, 'X-RAY', 'Thoracic Spine(Under 10yrs, 2views)', '29000.00', '0.00', '2500.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(567, 0, 'X-RAY', 'Tibia', '20500.00', '0.00', '1750.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(568, 0, 'X-RAY', 'Tibia/Foreigner', '22500.00', '0.00', '1750.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(569, 0, 'X-RAY', 'Wrist Joint (Adult 2views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(570, 0, 'X-RAY', 'Wrist Joint (From 10to16 yrs 2views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(571, 0, 'X-RAY', 'Wrist Joint (Under 10yrs 2views)/Foreigner', '17500.00', '0.00', '1350.00', '4000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(572, 0, 'X-RAY', 'Wrist Joint(Adult, 2views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(573, 0, 'X-RAY', 'Wrist Joint(From 10to16yrs, 2views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(574, 0, 'X-RAY', 'Wrist Joint(Under 10yrs, 2views)', '15500.00', '0.00', '1350.00', '2000.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(575, 0, 'X-Ray Urgent Report', 'X-Ray Urgent Report Fee', '11700.00', '0.00', '0.00', '6500.00', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investigation_labs`
--

CREATE TABLE `investigation_labs` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `routine_request` double NOT NULL,
  `urgent_request` double NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `routine_price` double NOT NULL,
  `urgent_price` double NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `investigation_labs`
--

INSERT INTO `investigation_labs` (`id`, `service_name`, `routine_request`, `urgent_request`, `description`, `routine_price`, `urgent_price`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CP (Auto-33 para)', 9800, 11000, 'Violet', 14700, 16500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(2, 'Hb%', 1800, 2400, 'Violet', 2700, 3600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(3, 'HbA1C', 13800, 14400, 'Violet', 20700, 21600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(4, 'Prothrombin Time', 5200, 5800, 'Blue', 7800, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(5, 'Lipid Profile', 11500, 12100, 'Green', 17250, 18150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(6, 'Liver Function Tests (LFT)', 11500, 12100, 'Violet', 17250, 18150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(7, 'ALT / SGPT', 4600, 5200, 'Violet', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(8, 'AST / SGOT', 4600, 5200, 'Violet', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(9, 'Urea & Electrolytes (U & E)', 15000, 15600, 'Red', 15600, 23400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(10, 'Creatinine (Serum)', 5200, 5800, 'Red', 7800, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(11, 'Uric Acid', 4600, 5200, 'Red', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(12, 'CRP (Quantitative)', 10500, 11100, 'Red', 15750, 16650, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(13, 'TSH', 13800, 15000, 'Red', 20700, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(14, 'Dengue (Ns 1 Ag)', 13800, 14400, 'Red', 20700, 21600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(15, 'Blood C&S', 22500, 22500, 'Red', 33750, 33750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(16, 'Swab C & S', 17500, 17500, 'Plain', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(17, 'URINE C & S', 17500, 17500, 'Red', 17500, 17500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(18, 'URINE RE', 2300, 3500, 'Red', 3450, 5250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(19, 'Cardio-3', 32500, 32500, '', 48750, 48750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(20, 'Alpha-1-antitrypsin', 123000, 123000, '', 184500, 184500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(21, 'HBV Viral Load', 103500, 103500, '', 155250, 155250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(22, 'PCR - EB Virus', 138000, 138000, '', 207000, 207000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(23, 'Blood For Reserve', 30000, 30000, '', 45000, 45000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(24, '24hr Urine acid', 5800, 5800, '', 8700, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(25, '24hr Urine Calcium', 5800, 5800, '', 8700, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(26, 'Acid Phosphatase', 20000, 20000, '', 30000, 30000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(27, 'After 1 hr, Blood Glucose', 0, 0, 'Green/Red', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(28, 'After 1 hr, Urine Sugar', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(29, 'After 2 hrs, Blood Glucose', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(30, 'After 2 hrs, Urine Sugar', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(31, 'Albumin', 3500, 4100, 'Green/ Red', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(32, 'Alkaline Phosphatase', 5800, 6400, 'Green /Red', 8700, 9600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(33, 'ALT / SGPT', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(34, 'Amylase (Serum)', 8700, 9300, 'Green /Red', 13050, 13950, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(35, 'Amylase (Urine)', 8700, 9300, '', 13050, 13950, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(36, 'ANA', 8100, 8700, '', 12150, 13050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(37, 'ANA ( Quantity )', 20000, 20000, 'Red', 30000, 30000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(38, 'ANF', 8100, 8700, '', 12150, 13050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(39, 'Anti -ds-DNA', 8100, 8700, '', 12150, 13050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(40, 'Anti HBc Total', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(41, 'AST / SGOT', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(42, 'B', 5800, 5800, '', 8700, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(43, 'Beta 2 microglobulin', 59000, 59000, '', 88500, 88500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(44, 'Bicarbonate', 4600, 5200, 'Green Red', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(45, 'Bilirubin (Direct)', 4600, 5200, 'Green Red', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(46, 'Bilirubin (Total)', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(47, 'Bld Mercury', 35000, 35000, '', 52500, 52500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(48, 'Bleeding Time', 1800, 2400, '', 2700, 3600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(49, 'Blood Alchol', 12700, 12700, '', 19050, 19050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(50, 'Blood Alchol & Urine Drug', 24200, 24200, '', 36300, 36300, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(51, 'Blood Ethanol', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(52, 'Blood film for microfilaria parasites', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(53, 'Blood for Free T3 , Free T4', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(54, 'Blood for FSH and LH', 17300, 17300, '', 25950, 25950, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(55, 'Blood Methanol', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(56, 'Blood Urea Nitrogen ( BUN )', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(57, 'BNP(NT-Pro BNP)', 46000, 46000, '', 69000, 69000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(58, 'CA 125 II (mini VIDAS , ELFA)', 20700, 20700, '', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(59, 'Calcium (Serum)', 6400, 7000, '', 9600, 10500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(60, 'Calcium (Urine)', 6400, 7000, '', 9600, 10500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(61, 'Cancelled', 37400, 39200, '', 56100, 58800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(62, 'Chloride', 4600, 5200, 'Green/ Red', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(63, 'Chloride (Urine)', 4600, 5200, 'Violet', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(64, 'Cholesterol', 4100, 4700, 'Green Red Dark', 6150, 7050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(65, 'CK', 9200, 9800, 'Green Red', 13800, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(66, 'CK-MB (Quantitative)(Cardiac Enzymes)', 11000, 11600, 'Green Red', 16500, 17400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(67, 'Clotting Time', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(68, 'Coomb\'\'s Test (Indirect)', 5800, 5800, 'Violet', 8700, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(69, 'Creatinine (Clearance) 24-hrs Urine', 8100, 8700, '', 12150, 13050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(70, 'Creatinine (Serum)', 5200, 5800, '', 7800, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(71, 'Creatinine (Urine)', 5200, 5800, 'Violet', 7800, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(72, 'CRP (Qualitative)', 4600, 5200, 'Green Red', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(73, 'CRP (Quantitative)', 10500, 11100, '', 15750, 16650, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(74, 'D-Dimer (Quantitative)', 23000, 23600, 'Blue', 34500, 35400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(75, 'Electrolytes', 11500, 12100, '', 17250, 18150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(76, 'Fasting Blood Glucose', 3500, 4100, '', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(77, 'Fasting Urine Sugar', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(78, 'FDP', 23000, 23000, 'Blue', 34500, 34500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(79, 'Gamma - GT (GGT)', 7500, 8100, '', 11250, 12150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(80, 'Globulin', 5800, 6400, 'Green Red', 8700, 9600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(81, 'Haemoglobin', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(82, 'HCG + Beta Assay', 23000, 23000, 'Red', 34500, 34500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(83, 'HDL', 3500, 4100, 'Green Red', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(84, 'HIV Ab (ELISA/Serodia)', 16100, 16100, '', 24150, 24150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(85, 'INR', 5200, 5800, '', 7800, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(86, 'K Potassium (Urine)', 4600, 5200, 'Green Red', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(87, 'LDH (Cardiac Enzymes)', 7000, 7600, 'Green Red', 10500, 11400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(88, 'LDL', 5200, 5800, 'Green Red', 7800, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(89, 'Lipase', 15000, 15000, '', 22500, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(90, 'Lipid Profile', 11500, 12100, '', 17250, 18150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(91, 'Liver Function Tests (LFT)', 11500, 12100, '', 17250, 18150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(92, 'Magnesium', 7000, 7600, '', 10500, 11400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(93, 'Na Sodium (Urine)', 4600, 5200, 'Green Red', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(94, 'OGTT (3 Specimen)', 11500, 12700, '', 17250, 19050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(95, 'OGTT (5 Specimen)', 17500, 18100, '', 26250, 27150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(96, 'Osmolarity', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(97, 'Phosphate', 6400, 7000, '', 9600, 10500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(98, 'Plasma Osmolarity', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(99, 'Plasma Protein Electrphoresis', 10000, 10000, '', 15000, 15000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(100, 'Post Prandial Blood Glucose', 3500, 4100, '', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(101, 'Potassium', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(102, 'Prostatic Acid Phosphatase', 7500, 8100, '', 11250, 12150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(103, 'Random Blood Glucose', 3500, 4100, '', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(104, 'Serum Ferritin', 17500, 17500, 'Red', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(105, 'Serum iron', 8100, 8100, 'Red', 12150, 12150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(106, 'Sodium', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(107, 'Sputum for AFB (First sample)', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(108, 'Sputum for AFB (Second sample)', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(109, 'Sputum for AFB (Third sample)', 0, 0, '', 0, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(110, 'T & DP Test', 5800, 6400, '', 8700, 9600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(111, 'Total Protein', 4600, 5200, 'Green Red', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(112, 'Triglycerides', 4100, 4700, 'Red /Green', 6150, 7050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(113, 'Troponin-I (Qualitative)', 7000, 7600, '', 10500, 11400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(114, 'Troponin-I (Quantitative)', 20700, 21300, '', 31050, 31950, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(115, 'Troponin-T (Qualitative)', 20700, 20700, '', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(116, 'Troponin-T (Quantitative)', 32200, 32200, '', 48300, 48300, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(117, 'Urea', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(118, 'Urea & Electrolytes (U & E)', 15000, 15600, '', 22500, 23400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(119, 'Uric Acid', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(120, 'Urinary protein creatinine ratio(spot test)', 8100, 8700, '', 12150, 13050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(121, 'Urine Alchol', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(122, 'Urine Chloride', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(123, 'Urine Corproporphyrin', 30000, 30000, '', 45000, 45000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(124, 'Urine Drug', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(125, 'Urine For Microalbumin', 7000, 8200, '', 10500, 12300, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(126, 'Urine Mercury', 41500, 41500, '', 62250, 62250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(127, 'Urine Narcotic', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(128, 'Urine Osmolarity', 2300, 2300, '', 3450, 3450, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(129, 'Urine Phenol', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(130, 'Urine Porphyria', 7000, 7000, '', 10500, 10500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(131, 'Urine Potassium', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(132, 'Urine Protein & Creatinine', 8100, 8700, '', 12150, 13050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(133, 'Urine Protein (24 hrs)', 5800, 5800, '', 8700, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(134, 'Urine Protein / Albumin & Creatinine Ratio', 8100, 8700, '', 12150, 13050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(135, 'Urine Sodium', 4600, 5200, '38250', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(136, '(kit)', 7000, 7600, '', 10500, 11400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(137, 'ABO Grouping', 2000, 2600, '', 3000, 3900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(138, 'Absolute Eosinophil Count', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(139, 'Anti-D level', 25500, 25500, '', 38250, 38250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(140, 'Antithrombin III', 57500, 57500, '', 86250, 86250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(141, 'APTT', 4600, 5200, 'Blue', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(142, 'Blood For Factor IX', 10500, 10500, '', 15750, 15750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(143, 'Blood For Factor VIII', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(144, 'Blood Group Matching (G & M)', 5800, 6400, '', 8700, 9600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(145, 'Blood Lead Level', 32000, 32000, '', 48000, 48000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(146, 'Bone Marrow (Film reading)', 23000, 23000, '', 34500, 34500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(147, 'CD4 Count', 25500, 25500, 'Violet', 38250, 38250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(148, 'Cold and warm agglutination', 9200, 9200, 'Violet', 13800, 13800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(149, 'Coomb\'\'s Test (Direct)', 5800, 7000, 'Violet', 8700, 10500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(150, 'CP (Manual)', 2900, 4100, 'Violet', 4350, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(151, 'CP-AUTO-33 para', 9800, 11000, 'Violet', 14700, 16500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(152, 'ESR', 1800, 2400, 'Violet', 2700, 3600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(153, 'Factor IX', 13800, 13800, 'Blue', 20700, 20700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(154, 'Factor VIII', 13800, 13800, 'Blue', 20700, 20700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(155, 'FDP/D Dimer', 23000, 23000, '', 34500, 34500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(156, 'Fibrinogen Test', 8700, 8700, 'Blue', 13050, 13050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(157, 'Folate (Serum)', 35000, 35000, '', 52500, 52500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(158, 'G6PD(Qualitative)', 7000, 7600, 'Violet', 10500, 11400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(159, 'G6PD(Quantitative)', 10500, 11100, 'Violet', 15750, 16650, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(160, 'H inclusion', 4100, 4100, '', 6150, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(161, 'Hb Electrophoresis', 7500, 7500, 'Violet', 11250, 11250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(162, 'Hb%', 1800, 2400, 'Violet', 2700, 3600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(163, 'HbA1C', 13800, 14400, 'Violet', 20700, 21600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(164, 'HbF(Singer\'\'s Test)', 4100, 4100, 'Violet', 6150, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(165, 'LE Cells (manual)', 7000, 7600, '', 10500, 11400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(166, 'PCV (Hct)', 1800, 3000, 'Violet', 2700, 4500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(167, 'Platelet Count (Manual)', 2300, 2900, 'Violet', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(168, 'Platelets Count (auto)', 7000, 8200, 'Violet', 10500, 12300, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(169, 'PNH Screening', 5800, 5800, '', 8700, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(170, 'Protein C', 82800, 82800, '', 124200, 124200, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(171, 'Protein S', 82800, 82800, '', 124200, 124200, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(172, 'Prothrombin Time', 5200, 5800, '', 7800, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(173, 'Retic Count (manual)', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(174, 'Reticulocyte count (auto)', 7000, 8200, '', 10500, 12300, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(175, 'Rh', 2000, 2600, '', 3000, 3900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(176, 'SMA(Spinal Muscular Asthrophy Gene Mutation Analysis/exon 7,8)', 75000, 75000, '', 112500, 112500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(177, 'T & DC', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(178, 'TIBC', 7000, 7000, '', 10500, 10500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(179, 'Vitamin B12', 25000, 25000, '', 37500, 37500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(180, 'Vitamin-D(25-OH)', 35000, 35000, '', 52500, 52500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(181, 'Von Willebrand factor', 20700, 20700, 'Blue', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(182, 'Von Willebrand factor(BKK)', 100000, 100000, '', 150000, 150000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(183, 'BIOPSY (ER/PR)', 38000, 38000, '', 57000, 57000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(184, 'BIOPSY (ER/PR/B2)', 60000, 60000, '', 90000, 90000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(185, 'BIOPSY - 1 <3cm', 10000, 10000, '', 15000, 15000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(186, 'BIOPSY - 2 (3cm -6cm)', 15000, 15000, '', 22500, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(187, 'BIOPSY - 3 (6cm)', 20000, 20000, '', 30000, 30000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(188, 'BIOPSY - 4 (6cm-8cm)', 35000, 35000, '', 52500, 52500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(189, 'BIOPSY - 5 >8cm', 50000, 50000, '', 75000, 75000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(190, 'BIOPSY(EMA/CKIT/Vimentim/Desmine)', 38000, 38000, '', 57000, 57000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(191, 'BIOPSY(HPR)', 25300, 25300, '', 37950, 37950, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(192, 'CYTOLOGY', 6000, 6000, '', 9000, 9000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(193, 'FNAC', 7000, 7000, '', 10500, 10500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(194, 'LIQUID BASED CYTOLOGY', 16000, 16000, '', 24000, 24000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(195, 'LIQUID BASED PAP SMEAR', 16000, 16000, '', 24000, 24000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(196, 'PAP SMEAR', 6000, 6000, '', 9000, 9000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(197, 'Beta HCG', 23000, 23000, '', 34500, 34500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(198, 'Cortisol', 17500, 17500, 'Red', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(199, 'Estradiol (E2)', 17500, 17500, '', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(200, 'Free T3', 13800, 15000, '', 20700, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(201, 'Free T4', 13800, 15000, '', 20700, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(202, 'FSH', 17500, 17500, 'Red', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(203, 'LH', 17500, 17500, 'Red', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(204, 'Parathyroid Hormone', 50600, 50600, 'Red', 75900, 75900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(205, 'Progesterone', 17500, 17500, 'Red', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(206, 'Prolactin', 17500, 17500, 'Red', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(207, 'T3', 13800, 15000, '', 20700, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(208, 'T4(Total Thyroxine)', 13800, 15000, '', 20700, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(209, 'Testosterone', 20700, 20700, 'Red', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(210, 'TSH', 13800, 15000, '', 20700, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(211, 'Urine Cortisol', 20700, 20700, '', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(212, 'Urine Cortisol-24 Hrs', 20700, 20700, '', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(213, 'ANCA', 29000, 29000, '', 43500, 43500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(214, 'Anti - HBc (IgM)', 17500, 17500, 'Red', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(215, 'Anti CCP (Anti-Cyclic Citrullinated Peptide)', 29000, 29000, '', 43500, 43500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(216, 'ASO (Qualitative)', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(217, 'ASO (Quantitative)', 10500, 11100, '', 15750, 16650, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(218, 'Complement 3 (C3)', 21000, 21000, '', 31500, 31500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(219, 'Completment 4 (C 4)', 20700, 20700, '', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(220, 'Dengue (Ns 1 Ag)', 13800, 14400, '', 20700, 21600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(221, 'EB Virus Ig A', 58000, 58000, '', 87000, 87000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(222, 'EB Virus Ig G', 58000, 58000, '', 87000, 87000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(223, 'EB Virus Ig M', 58000, 58000, '', 87000, 87000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(224, 'ENA Test', 40500, 40500, '', 60750, 60750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(225, 'H.Pylori ( Serum )', 9800, 10400, '', 14700, 15600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(226, 'H.Pylori (Stool)', 9800, 10400, '', 14700, 15600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(227, 'HAV IgM (Quanti)', 20000, 20000, '', 30000, 30000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(228, 'HAV IgM/IgG', 15000, 15600, 'Red', 22500, 23400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(229, 'HAV(Quanti)', 20000, 30000, '', 30000, 30000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(230, 'HBeAb', 9200, 9800, 'Red', 13800, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(231, 'HBeAg', 9200, 9800, 'Red', 13800, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(232, 'HBeAg (Q)', 17500, 17500, 'Violet', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(233, 'HBs Antigen(Confirmation)', 9800, 9800, '', 14700, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(234, 'HBsAb (Qualitative)', 7500, 8100, '', 11250, 12150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(235, 'HBsAb (Quantitative)', 17500, 18100, '', 26250, 27150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(236, 'HBsAg (Qualitative)', 6000, 6600, 'Red', 9000, 9900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(237, 'HBsAg (Quantitative)', 15000, 15600, 'Red', 22500, 23400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(238, 'HBV Panel', 20700, 20700, 'Red', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(239, 'HCV Ab (Qualitative)', 8000, 8600, '', 12000, 12900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(240, 'HCV Ab (Quantitative)', 17900, 17900, '', 26850, 26850, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(241, 'HCV Antibody(Comfimation)', 12000, 12000, '', 18000, 18000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(242, 'HIV 1/2 Ab screening', 8500, 9100, '', 12750, 13650, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(243, 'HIV 1/2 Ab/Ag screening', 9200, 9800, '', 13800, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(244, 'HIV 1/2 ELISA', 16100, 16100, '', 24150, 24150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(245, 'HIV confirmation', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(246, 'HSV IgG', 24200, 24200, '', 36300, 36300, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(247, 'HSV IgM', 27600, 27600, '', 41400, 41400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(248, 'ICT - Dengue (IgG / lgM)', 9800, 10400, '', 14700, 15600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(249, 'ICT-TB(Rapid Immunoassay For TB)', 11500, 12100, '', 17250, 18150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(250, 'IgA Level', 30000, 30000, '', 45000, 45000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(251, 'IgE', 40000, 40000, '', 60000, 60000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(252, 'IgG Level', 35000, 35000, '', 52500, 52500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(253, 'IgG-Sub Class', 119000, 119000, '', 178500, 178500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(254, 'IgM Level', 35000, 35000, '', 52500, 52500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(255, 'Immuno Globulin', 65000, 65000, '', 97500, 97500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(256, 'Infactious Mononuclcosis', 18000, 18000, '', 27000, 27000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(257, 'JE IgG', 50000, 50000, '', 75000, 75000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(258, 'JE IgM', 55000, 55000, '', 82500, 82500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(259, 'Measles IgM', 5800, 5800, '', 8700, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(260, 'Mycoplasma Ig G', 30000, 30000, '', 45000, 45000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(261, 'Mycoplasma Ig M', 30000, 30000, '', 45000, 45000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(262, 'Mycoplasma Ig M (Titre)', 49000, 49000, '', 73500, 73500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(263, 'P-24 HIV Antigen confirmation', 28800, 28800, 'Red', 43200, 43200, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(264, 'Phospholipid Ab', 9800, 9800, '', 14700, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(265, 'RA', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(266, 'Salmonella IgG/IgM Test', 5800, 6400, 'Red', 8700, 9600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(267, 'Toxocara Antibody', 52000, 52000, '', 78000, 78000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(268, 'Toxoplasma Ig G(Titre)', 50000, 50000, '', 75000, 75000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(269, 'Toxoplasma Ig M(Titre)', 52000, 52000, '', 78000, 78000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(270, 'TPHA', 7000, 7600, 'Red', 10500, 11400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(271, 'UCG', 1800, 2400, '', 2700, 3600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(272, 'VDRL', 5000, 5600, 'Red', 7500, 8400, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(273, 'Viral Load for EB Virus', 142600, 142600, '', 213900, 213900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(274, 'Widal Test', 5800, 6400, 'Red', 8700, 9600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(275, 'ABG / EPOC', 60000, 60000, '', 90000, 90000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(276, 'ABG/EPOC (Without Dr\'\'s Fee)', 50000, 50000, '', 75000, 75000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(277, 'BNP ( IES )', 5000, 5000, '', 7500, 7500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(278, 'CK-MB(IES)', 9500, 9500, '', 14250, 14250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(279, 'Triage(Troponin I , CK-MB, BNP)', 32500, 32500, '', 48750, 48750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(280, 'Troponin I(IES)', 18000, 18000, '', 27000, 27000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(281, 'Lab Material', 500, 500, '', 750, 750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(282, 'Lab Material-500', 500, 500, '', 750, 750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(283, 'Bottle', 200, 200, '', 300, 300, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(284, 'Bottle ( 10 Pcs )', 2000, 2000, '', 3000, 3000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(285, 'Bottle ( 3 Pcs )', 600, 600, '', 900, 900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(286, 'Bottle ( 5 Pcs )', 1000, 1000, '', 1500, 1500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(287, 'Bottle ( Pap Smear )', 2000, 2000, '', 3000, 3000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(288, 'Bottle (liquid Based Cytology)', 10000, 10000, '', 15000, 15000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(289, 'Bottle Blood C&S', 2000, 2000, '', 3000, 3000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(290, 'Bottle Blood Tubes', 300, 300, '', 450, 450, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(291, 'Bottle Bood C&S ( 10 Pcs )', 20000, 20000, '', 30000, 30000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(292, 'Bottle Bood C&S ( 5 Pcs )', 10000, 10000, '', 15000, 15000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(293, 'Bottle C&S', 500, 500, '', 750, 750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(294, 'Bottle Swab Stick', 1000, 1000, '', 1500, 1500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(295, 'Ab for Echinococcosis', 9200, 9800, '', 13800, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(296, 'AFB Culture', 15000, 15000, '', 22500, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(297, 'Amoeba Ag detection in stool (Amoebogen Test)', 9200, 9200, '', 13800, 13800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(298, 'BACT/ALERT BLOOD C&S', 22500, 22500, '', 33750, 33750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(299, 'BENCE JONES PROTEIN', 3500, 4100, '', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(300, 'Blood C&S', 22500, 22500, '', 33750, 33750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(301, 'Bone Marrow-AFB Stain', 3500, 4100, '', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(302, 'CELL COUNT (CSF)', 3500, 4100, '', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(303, 'Ceruloplasimer', 28000, 28000, '', 42000, 42000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(304, 'Chikungunya IgM', 9800, 10400, '', 14700, 15600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(305, 'Chlamydia', 7500, 8100, '', 11250, 12150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(306, 'Copper in Blood', 31000, 31000, '', 46500, 46500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(307, 'CSF C&S / Fluid C&S', 17500, 17500, '', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(308, 'CSF FUNGAL (Stain & Microscopy)', 5800, 6400, 'Red', 8700, 9600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(309, 'CSF India Ink Stain', 3500, 3500, '', 5250, 5250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(310, 'CSF-AFB STAIN', 3500, 4100, '', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(311, 'CSF-GRAM STAIN', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(312, 'CSF-RE', 7500, 8100, '', 11250, 12150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(313, 'CSF-SUGAR', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(314, 'Cyto Megalo Virus IgG', 36000, 36000, '', 54000, 54000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(315, 'Cyto Megalo Virus Igm', 36000, 36000, '', 54000, 54000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(316, 'EIA test for E. histolytica', 9200, 9200, '', 13800, 13800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(317, 'Eye swab for Giemsa Stain', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(318, 'FAT STAIN (URINE)', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(319, 'FLUID AFB (ZN STAIN)', 4000, 4600, '', 6000, 6900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(320, 'FLUID Gram STAIN', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(321, 'FLUID RE', 5800, 6400, '', 8700, 9600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(322, 'FUNGAL CULTURE', 8100, 0, '', 12150, 0, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(323, 'Gonococci', 4000, 4600, '', 6000, 6900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(324, 'Hand Swab', 17500, 17500, '', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(325, 'ICT-MF', 11500, 12100, '', 17250, 18150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(326, 'ICT-MP (Pf / Pv)', 8100, 8700, 'Violet', 12150, 13050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(327, 'JEV IgM (Serum)', 9800, 9800, '', 14700, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(328, 'JEV(CSF)(Arbovirus)', 9800, 9800, '', 14700, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(329, 'Leptospiral Antibody', 8700, 9300, '', 13050, 13950, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(330, 'MF-Stain Microscopy', 2300, 2900, 'Violet', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(331, 'Mono Spot Test', 12000, 12000, '', 18000, 18000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(332, 'MP-Stain Microscopy', 2300, 2900, 'Violet', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(333, 'Mumps IgG', 25000, 25000, '', 37500, 37500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(334, 'Mumps IgG(Titra)', 40000, 40000, '', 60000, 60000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(335, 'Mumps IgM', 32000, 32000, '', 48000, 48000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(336, 'Mumps IgM(Titra)', 40000, 40000, '', 60000, 60000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(337, 'Myco C & S (Yeast Only)', 17500, 17500, '', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(338, 'Myco-Direct Microscopy', 4100, 4700, '', 6150, 7050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(339, 'Nasal Swab', 17500, 17500, '', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(340, 'OCCULT BLOOD (STOOL)', 9200, 9800, '', 13800, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(341, 'PCR TB(Qualitative)', 112700, 112700, '', 169050, 169050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(342, 'Pleural Fluid C&S', 17500, 17500, '', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(343, 'Pleural Fluid RE', 5800, 6400, '', 8700, 9600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(344, 'PUS C & S', 17500, 17500, 'Red', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(345, 'Rubella IgG / IgM', 9800, 10400, 'Red', 14700, 15600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(346, 'SEMEN ANALYSIS', 8100, 8700, '', 12150, 13050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(347, 'Serology', 8100, 8100, '', 12150, 12150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(348, 'Sperm Count', 4600, 5200, '', 6900, 7800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(349, 'Sputum AFB', 4000, 4600, '', 6000, 6900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(350, 'Sputum AFB 3 Days', 10500, 10500, '', 15750, 15750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(351, 'Sputum AFB,C & S', 15000, 15000, '', 22500, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(352, 'Sputum C & S', 17500, 17500, '', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(353, 'Sputum for P.carinii', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(354, 'Stool (Hanging-drop Preparation)', 3500, 4100, '', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(355, 'Stool AFB', 3500, 4100, '', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(356, 'Stool AFB C&S', 15000, 15000, '', 22500, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(357, 'Stool C & S', 17500, 17500, '', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(358, 'Stool for Reducing Substance', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(359, 'Stool for Rota Virus', 9800, 10400, '', 14700, 15600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(360, 'Stool for vibria cholerae', 9800, 10400, '', 14700, 15600, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(361, 'Stool RE', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(362, 'Stool(conc:method)', 4000, 4000, '', 6000, 6000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(363, 'Swab C & S', 17500, 17500, '', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(364, 'Swab GRAM STAIN', 4000, 4600, '', 6000, 6900, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(365, 'Toxoplasma IgG / IgM', 9200, 9800, '', 13800, 14700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(366, 'Trichomonas (Vaginal / Urethral)', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(367, 'Tuberculin Test', 6500, 6500, '', 9750, 9750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(368, 'Urinary Protein (24 hr)', 5800, 5800, '', 8700, 8700, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(369, 'URINE AFB', 4000, 4300, '', 6000, 6450, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(370, 'Urine AFB C&S', 15000, 15000, '', 22500, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(371, 'URINE ALBUMIN', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(372, 'URINE C & S', 17500, 17500, '', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(373, 'Urine Deposit For GC', 3500, 4100, '', 5250, 6150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(374, 'Urine Ketone Bodies', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(375, 'URINE PROTEIN (STRIP)', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(376, 'URINE RE', 2300, 3500, '', 3450, 5250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(377, 'URINE SPECIFIC GRAVITY', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL);
INSERT INTO `investigation_labs` (`id`, `service_name`, `routine_request`, `urgent_request`, `description`, `routine_price`, `urgent_price`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(378, 'URINE SUGAR (BENEDICT Sol)', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(379, 'Urine Sugar(Strip)', 2300, 2900, '', 3450, 4350, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(380, 'URINE VMA', 9200, 9200, '', 13800, 13800, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(381, 'Urinery LAM', 15000, 15000, '', 22500, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(382, 'Water Bacteriology', 7000, 7000, '', 10500, 10500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(383, 'G6PD(Neonatal)', 12000, 12000, '', 18000, 18000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(384, 'PKU(Neonatal)', 12000, 12000, '', 18000, 18000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(385, 'TSH(Neonatal)', 12000, 12000, '', 18000, 18000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(386, 'No Used', 34500, 34500, '', 51750, 51750, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(387, '17-OH Progestrone Level', 35000, 35000, '', 52500, 52500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(388, 'Anticardiolipin Antibody(IgG)', 40000, 40000, '', 60000, 60000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(389, 'Anticardiolipin Antibody(IgM)', 40000, 40000, '', 60000, 60000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(390, 'Bacteriological Exam Of Air(Settle-Plate)', 15000, 15000, '', 22500, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(391, 'CMV PCR', 85000, 85000, '', 127500, 127500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(392, 'DHT Dihydrotestosterone', 182000, 182000, '', 273000, 273000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(393, 'ELISA Test For Hydatid Cyst(Echinococcus Ab)', 15000, 15000, '', 22500, 22500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(394, 'Glucose Challerge Test(GCT)', 7000, 7000, '', 10500, 10500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(395, 'IGF1(Insulin Like Growth Hormone Factor)', 55000, 55000, '', 82500, 82500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(396, 'Immunoglobin Series(IgA,IgG,IgM)', 60000, 60000, '', 90000, 90000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(397, 'Karyotyping', 210000, 210000, '', 315000, 315000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(398, 'Lipase(Serum)', 12000, 12000, '', 18000, 18000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(399, 'Myoglobin(Serum)', 50000, 50000, '', 75000, 75000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(400, 'Myoglobin(Urine)', 165000, 165000, '', 247500, 247500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(401, 'PCP C&S / Sputum for PCP', 3000, 3000, '', 4500, 4500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(402, 'Thyroglobulin Level', 35000, 35000, '', 52500, 52500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(403, 'Tsutsugamushi IgG/IgM(Scrub Typhus)', 12000, 12000, '', 18000, 18000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(404, 'Urinary Phenylketonuria', 23000, 23000, '', 34500, 34500, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(405, 'Vector Identification', 6000, 6000, '', 9000, 9000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(406, 'Worm Identification', 6000, 6000, '', 9000, 9000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(407, 'Ab for Aspergillus flavus', 11500, 11500, 'Red', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(408, 'Ab for Aspergillus fumigates', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(409, 'Ab for Aspergillus niger', 11500, 11500, '', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(410, 'Ab for Blastomyces dermatitidis (48 hrs)', 11500, 11500, 'Red', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(411, 'Ab for Candida albicans', 11500, 11500, 'Red', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(412, 'Ab for Coccidioides immitis', 11500, 11500, 'Red', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(413, 'Ab for Histoplasma capsulatum', 11500, 11500, 'Red', 17250, 17250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(414, 'Anti Smooth Muscle Abtibody', 38000, 38000, '', 57000, 57000, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(415, 'Cryptococcus neoformans (Ag) (CSF)(Serum)', 17500, 17500, 'Red', 26250, 26250, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(416, 'AFP', 19500, 20100, 'Green/Red', 29250, 30150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(417, 'CA 125', 20700, 21300, '', 31050, 31950, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(418, 'CA 15.3', 20700, 20700, '', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(419, 'CA 19.9', 20700, 20700, '', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(420, 'CEA', 19500, 20100, '', 29250, 30150, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(421, 'Free PSA', 25300, 25300, 'Red', 37950, 37950, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(422, 'PSA(Quantitative)', 20700, 20700, '', 31050, 31050, 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zone_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `total_car_amount` decimal(10,2) NOT NULL,
  `total_medication_amount` decimal(10,2) NOT NULL,
  `total_investigation_amount` decimal(10,2) NOT NULL,
  `total_service_amount` decimal(10,2) NOT NULL,
  `total_other_service_amount` decimal(10,2) NOT NULL,
  `total_consultant_fee` decimal(10,2) NOT NULL,
  `total_consultant_discount_amount` decimal(10,2) NOT NULL,
  `total_nett_amt_wo_disc` decimal(10,2) NOT NULL,
  `total_disc_amt` decimal(10,2) NOT NULL,
  `total_disc_percent` decimal(10,2) NOT NULL,
  `total_nett_amt_w_disc` decimal(10,2) NOT NULL,
  `tax_rate` decimal(10,2) NOT NULL,
  `total_tax_amt` decimal(10,2) NOT NULL,
  `total_payable_amt` decimal(10,2) NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `accepted_by` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_start_time` datetime NOT NULL,
  `schedule_end_time` datetime NOT NULL,
  `patient_package_id` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_price` decimal(10,2) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `invoice_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_amount` decimal(10,2) NOT NULL,
  `service_type_id` int(11) NOT NULL,
  `service_price` decimal(10,2) NOT NULL,
  `consultant_id` int(11) NOT NULL,
  `consultant_fee` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `consultant_discount_percentage` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `consultant_discount_amount` decimal(10,2) NOT NULL,
  `car_type` int(11) NOT NULL,
  `car_type_setup_id` int(11) NOT NULL,
  `car_type_price` decimal(10,2) NOT NULL,
  `other_service` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `other_service_price` decimal(10,2) NOT NULL,
  `other_service_remark` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_patient_case_summary`
--

CREATE TABLE `log_patient_case_summary` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `case_summary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log_patient_case_summary`
--

INSERT INTO `log_patient_case_summary` (`id`, `patient_id`, `case_summary`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('U0001', 'U0009', '', 'U0001', NULL, NULL, '2017-01-17 13:24:07', NULL, NULL),
('U0002', 'U00010', '', 'U0001', NULL, NULL, '2017-01-17 13:25:37', NULL, NULL),
('U0003', 'U00011', '', 'U0001', NULL, NULL, '2017-01-17 13:26:31', NULL, NULL),
('U0004', 'U00012', '', 'U0001', NULL, NULL, '2017-01-17 13:27:28', NULL, NULL),
('U0005', 'U00011', '', NULL, 'U0001', NULL, NULL, '2017-01-17 13:27:40', NULL),
('U0006', 'U00013', '', 'U0001', NULL, NULL, '2017-01-17 13:28:29', NULL, NULL),
('U0007', 'U00014', '', 'U0001', NULL, NULL, '2017-01-17 13:29:26', NULL, NULL),
('U0008', 'U00015', '', 'U0001', NULL, NULL, '2017-01-17 13:30:45', NULL, NULL),
('U0009', 'U00016', '', 'U0001', NULL, NULL, '2017-01-17 13:31:31', NULL, NULL),
('U00010', 'U00017', '', 'U0001', NULL, NULL, '2017-01-17 13:32:16', NULL, NULL),
('U00011', 'U00018', '', 'U0001', NULL, NULL, '2017-01-17 13:34:28', NULL, NULL),
('U00012', 'U00019', '', 'U0001', NULL, NULL, '2017-01-17 13:35:21', NULL, NULL),
('U00013', 'U00020', '', 'U0001', NULL, NULL, '2017-01-17 13:36:47', NULL, NULL),
('U00014', 'U00021', '', 'U0001', NULL, NULL, '2017-01-17 13:37:39', NULL, NULL),
('U00015', 'U00019', '', NULL, 'U0001', NULL, NULL, '2017-01-17 13:37:58', NULL),
('U00016', 'U00020', '', NULL, 'U0001', NULL, NULL, '2017-01-17 13:38:09', NULL),
('U00017', 'U00022', '', 'U0001', NULL, NULL, '2017-01-17 13:39:12', NULL, NULL),
('U00018', 'U00023', '', 'U0001', NULL, NULL, '2017-01-17 13:40:05', NULL, NULL),
('U00019', 'U00024', '', 'U0001', NULL, NULL, '2017-01-17 13:41:06', NULL, NULL),
('U00020', 'U00025', '', 'U0001', NULL, NULL, '2017-01-17 13:42:31', NULL, NULL),
('U00021', 'U00026', '', 'U0001', NULL, NULL, '2017-01-17 13:43:27', NULL, NULL),
('U00022', 'U00027', '', 'U0001', NULL, NULL, '2017-01-17 13:44:20', NULL, NULL),
('U00023', 'U00028', '', 'U0001', NULL, NULL, '2017-01-17 13:45:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_tablet_issue`
--

CREATE TABLE `log_tablet_issue` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tablet_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exception` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
('2014_10_12_000000_create_core_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_04_26_002347_create_sessions_table', 1),
('2016_07_15_112121_add_setup_tables', 1),
('2016_07_20_152104_add_car_type_table', 1),
('2016_07_21_144400_add_product_categories_table', 1),
('2016_07_21_172331_add_car_type_setup_table', 1),
('2016_07_22_101158_create_products_table', 1),
('2016_07_22_144239_create_services_table', 1),
('2016_07_22_153244_create_packages_table', 1),
('2016_07_22_155830_create_package_detail_table', 1),
('2016_07_22_155950_add_allergy_table', 1),
('2016_07_22_173211_add_enquiry_table', 1),
('2016_07_25_170725_create_investigations_table', 1),
('2016_07_26_094232_create_physical_exams_table', 1),
('2016_08_01_134843_create_patient_package_tables', 1),
('2016_08_02_161600_add_patient_table', 1),
('2016_08_09_150500_add_schedule_tables', 1),
('2016_08_10_172755_create_invoices_table', 1),
('2016_08_29_134151_create_patient_surgery_history_table', 1),
('2016_08_29_171820_create_schedule_treatment_histories_table', 1),
('2016_08_29_173835_create_patient_family_tables', 1),
('2016_08_30_144226_create_patient_medical_tables', 1),
('2016_09_12_154145_create_provisional_diagnosis_tables', 1),
('2016_09_14_150024_add_create_terminals_table', 1),
('2016_09_16_100909_create_log_patient_case_summary_table', 1),
('2016_09_26_163658_create_patient_physiotherapy_tables', 1),
('2016_09_27_111555_create_route_table', 1),
('2016_09_27_115152_create_schedule_physiotherapy_tables', 1),
('2016_09_27_133030_create_schedule_patient_tables', 1),
('2016_09_27_134443_create_schedule_physical_exams_tables', 1),
('2016_10_04_150300_create_nutrition_table', 1),
('2016_10_11_145126_create_way_tracking_table', 1),
('2016_12_05_150516_create_setup_price_history_table', 1),
('2016_12_13_112418_create_log_tablet_issue_table', 1),
('2016_12_19_102009_create_investigation_labs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nutrition`
--

CREATE TABLE `nutrition` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enquiry_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about_acceptable_weight` tinyint(1) NOT NULL,
  `uti` tinyint(1) NOT NULL,
  `htn_stroke_chf_cvd` tinyint(1) NOT NULL,
  `belowaceptable_weight` tinyint(1) NOT NULL,
  `poor_intake` tinyint(1) NOT NULL,
  `wieght_loss` tinyint(1) NOT NULL,
  `difficulty_swallowing` tinyint(1) NOT NULL,
  `no_poordentition` tinyint(1) NOT NULL,
  `clear_full_liquid` tinyint(1) NOT NULL,
  `skin_breakthrough` tinyint(1) NOT NULL,
  `recent_fracture_trauma` tinyint(1) NOT NULL,
  `recent_surgery` tinyint(1) NOT NULL,
  `edema` tinyint(1) NOT NULL,
  `diabetes` tinyint(1) NOT NULL,
  `rental_dieases_dialysis` tinyint(1) NOT NULL,
  `drug_nutinteraction` tinyint(1) NOT NULL,
  `dx_hol_nutrition` tinyint(1) NOT NULL,
  `dx_ho_cancer` tinyint(1) NOT NULL,
  `dx_hodehydration` tinyint(1) NOT NULL,
  `dx_ho_dementia` tinyint(1) NOT NULL,
  `dx_ho_mentaldx` tinyint(1) NOT NULL,
  `other` text COLLATE utf8_unicode_ci NOT NULL,
  `male_nutrition_field1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `male_nutrition_field2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `male_nutrition_field3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `male_nutrition_age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `male_nutrition_field8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `male_nutrition_field5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `male_nutrition_field6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `male_nutrition_field7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `female_nutrition_field1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `female_nutrition_field2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `female_nutrition_field3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `female_nutrition_age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `female_nutrition_field8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `female_nutrition_field5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `female_nutrition_field6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `female_nutrition_field7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `protient_field1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `protient_field2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `protient_field3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fluid_field1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fluid_field2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fluid_field3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fluid_field4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fluid_field5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `evaluation` text COLLATE utf8_unicode_ci NOT NULL,
  `plan_of_action_or_recommendation_for_care_plan` text COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `package_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `schedule_no` int(11) DEFAULT NULL,
  `expiry_date` int(11) DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_detail`
--

CREATE TABLE `package_detail` (
  `package_id` int(11) NOT NULL,
  `qty` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_id` int(11) NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `patient_allergy`
--

CREATE TABLE `patient_allergy` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allergy_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_family_history`
--

CREATE TABLE `patient_family_history` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `family_history_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `family_member_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_family_member`
--

CREATE TABLE `patient_family_member` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient_family_member`
--

INSERT INTO `patient_family_member` (`id`, `name`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('U0001', 'Father', 'Father', 'U0001', 'U0001', NULL, '2016-11-09 11:29:45', '2016-11-09 11:29:45', NULL),
('U0002', 'Mother', 'Mother', 'U0001', 'U0001', NULL, '2016-11-09 11:29:45', '2016-11-09 11:29:45', NULL),
('U0003', 'Brother', 'Brother', 'U0001', 'U0001', NULL, '2016-11-09 11:29:45', '2016-11-09 11:29:45', NULL),
('U0004', 'Sister', 'Sister', 'U0001', 'U0001', NULL, '2016-11-09 11:29:45', '2016-11-09 11:29:45', NULL),
('U0005', 'Grandfather', 'Grandfather', 'U0001', 'U0001', NULL, '2016-11-09 11:29:45', '2016-11-09 11:29:45', NULL),
('U0006', 'Grandmother', 'Grandmother', 'U0001', 'U0001', NULL, '2016-11-09 11:29:45', '2016-11-09 11:29:45', NULL),
('U0007', 'Uncle', 'Uncle', 'U0001', 'U0001', NULL, '2016-11-09 11:29:45', '2016-11-09 11:29:45', NULL),
('U0008', 'Aunty', 'Aunty', 'U0001', 'U0001', NULL, '2016-11-09 11:29:45', '2016-11-09 11:29:45', NULL),
('U0009', 'Cousin', 'Cousin', 'U0001', 'U0001', NULL, '2016-11-09 11:29:45', '2016-11-09 11:29:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_medical_history`
--

CREATE TABLE `patient_medical_history` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `medical_history_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_package`
--

CREATE TABLE `patient_package` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_price` decimal(10,2) DEFAULT NULL,
  `package_usage_count` int(11) NOT NULL,
  `package_used_count` int(11) NOT NULL,
  `sold_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_package_detail`
--

CREATE TABLE `patient_package_detail` (
  `patient_package_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiotherapy_musculo_3_sitting`
--

CREATE TABLE `patient_physiotherapy_musculo_3_sitting` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `joint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flexion_normal` tinyint(1) NOT NULL,
  `flexion_minimum` tinyint(1) NOT NULL,
  `flexion_moderate` tinyint(1) NOT NULL,
  `flexion_maximum` tinyint(1) NOT NULL,
  `extension_normal` tinyint(1) NOT NULL,
  `extension_minimum` tinyint(1) NOT NULL,
  `extension_moderate` tinyint(1) NOT NULL,
  `extension_maximum` tinyint(1) NOT NULL,
  `abduction_normal` tinyint(1) NOT NULL,
  `abduction_minimum` tinyint(1) NOT NULL,
  `abduction_moderate` tinyint(1) NOT NULL,
  `abduction_maximum` tinyint(1) NOT NULL,
  `adduction_normal` tinyint(1) NOT NULL,
  `adduction_minimum` tinyint(1) NOT NULL,
  `adduction_moderate` tinyint(1) NOT NULL,
  `adduction_maximum` tinyint(1) NOT NULL,
  `medical_rotation_normal` tinyint(1) NOT NULL,
  `medical_rotation_minimum` tinyint(1) NOT NULL,
  `medical_rotation_moderate` tinyint(1) NOT NULL,
  `medical_rotation_maximum` tinyint(1) NOT NULL,
  `lateral_rotation_normal` tinyint(1) NOT NULL,
  `lateral_rotation_minimum` tinyint(1) NOT NULL,
  `lateral_rotation_moderate` tinyint(1) NOT NULL,
  `lateral_rotation_maximum` tinyint(1) NOT NULL,
  `side_flexion_normal` tinyint(1) NOT NULL,
  `side_flexion_minimum` tinyint(1) NOT NULL,
  `side_flexion_moderate` tinyint(1) NOT NULL,
  `side_flexion_maximum` tinyint(1) NOT NULL,
  `rotation_to_right_normal` tinyint(1) NOT NULL,
  `rotation_to_right_minimum` tinyint(1) NOT NULL,
  `rotation_to_right_moderate` tinyint(1) NOT NULL,
  `rotation_to_right_maximum` tinyint(1) NOT NULL,
  `rotation_to_left_normal` tinyint(1) NOT NULL,
  `rotation_to_left_minimum` tinyint(1) NOT NULL,
  `rotation_to_left_moderate` tinyint(1) NOT NULL,
  `rotation_to_left_maximum` tinyint(1) NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiotherapy_musculo_3_standing`
--

CREATE TABLE `patient_physiotherapy_musculo_3_standing` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `joint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flexion_normal` tinyint(1) NOT NULL,
  `flexion_minimum` tinyint(1) NOT NULL,
  `flexion_moderate` tinyint(1) NOT NULL,
  `flexion_maximum` tinyint(1) NOT NULL,
  `extension_normal` tinyint(1) NOT NULL,
  `extension_minimum` tinyint(1) NOT NULL,
  `extension_moderate` tinyint(1) NOT NULL,
  `extension_maximum` tinyint(1) NOT NULL,
  `abduction_normal` tinyint(1) NOT NULL,
  `abduction_minimum` tinyint(1) NOT NULL,
  `abduction_moderate` tinyint(1) NOT NULL,
  `abduction_maximum` tinyint(1) NOT NULL,
  `adduction_normal` tinyint(1) NOT NULL,
  `adduction_minimum` tinyint(1) NOT NULL,
  `adduction_moderate` tinyint(1) NOT NULL,
  `adduction_maximum` tinyint(1) NOT NULL,
  `medical_rotation_normal` tinyint(1) NOT NULL,
  `medical_rotation_minimum` tinyint(1) NOT NULL,
  `medical_rotation_moderate` tinyint(1) NOT NULL,
  `medical_rotation_maximum` tinyint(1) NOT NULL,
  `lateral_rotation_normal` tinyint(1) NOT NULL,
  `lateral_rotation_minimum` tinyint(1) NOT NULL,
  `lateral_rotation_moderate` tinyint(1) NOT NULL,
  `lateral_rotation_maximum` tinyint(1) NOT NULL,
  `side_flexion_normal` tinyint(1) NOT NULL,
  `side_flexion_minimum` tinyint(1) NOT NULL,
  `side_flexion_moderate` tinyint(1) NOT NULL,
  `side_flexion_maximum` tinyint(1) NOT NULL,
  `rotation_to_right_normal` tinyint(1) NOT NULL,
  `rotation_to_right_minimum` tinyint(1) NOT NULL,
  `rotation_to_right_moderate` tinyint(1) NOT NULL,
  `rotation_to_right_maximum` tinyint(1) NOT NULL,
  `rotation_to_left_normal` tinyint(1) NOT NULL,
  `rotation_to_left_minimum` tinyint(1) NOT NULL,
  `rotation_to_left_moderate` tinyint(1) NOT NULL,
  `rotation_to_left_maximum` tinyint(1) NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiotherapy_musculo_4_1and2`
--

CREATE TABLE `patient_physiotherapy_musculo_4_1and2` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slr_plus` tinyint(1) NOT NULL,
  `slr_minus` tinyint(1) NOT NULL,
  `ehl_plus` tinyint(1) NOT NULL,
  `ehl_minus` tinyint(1) NOT NULL,
  `femoral_nerve_plus` tinyint(1) NOT NULL,
  `femoral_nerve_minus` tinyint(1) NOT NULL,
  `empty_can_test_plus` tinyint(1) NOT NULL,
  `empty_can_test_minus` tinyint(1) NOT NULL,
  `neer_test_plus` tinyint(1) NOT NULL,
  `neer_test_minus` tinyint(1) NOT NULL,
  `hawkin_test_plus` tinyint(1) NOT NULL,
  `hawkin_test_minus` tinyint(1) NOT NULL,
  `gerber_life_off_test_plus` tinyint(1) NOT NULL,
  `gerber_life_off_test_minus` tinyint(1) NOT NULL,
  `drop_arm_test_plus` tinyint(1) NOT NULL,
  `drop_arm_test_minus` tinyint(1) NOT NULL,
  `crank_test_plus` tinyint(1) NOT NULL,
  `crank_test_minus` tinyint(1) NOT NULL,
  `apprehension_test_plus` tinyint(1) NOT NULL,
  `apprehension_test_minus` tinyint(1) NOT NULL,
  `yergason_test_plus` tinyint(1) NOT NULL,
  `yergason_test_minus` tinyint(1) NOT NULL,
  `anterior_drawer_test_plus` tinyint(1) NOT NULL,
  `anterior_drawer_test_minus` tinyint(1) NOT NULL,
  `posterior_drawer_test_plus` tinyint(1) NOT NULL,
  `posterior_drawer_test_minus` tinyint(1) NOT NULL,
  `varus_stress_test_plus` tinyint(1) NOT NULL,
  `varus_stress_test_minus` tinyint(1) NOT NULL,
  `valgus_stress_test_plus` tinyint(1) NOT NULL,
  `valgus_stress_test_minus` tinyint(1) NOT NULL,
  `mc_murray_test_plus` tinyint(1) NOT NULL,
  `mc_murray_test_minus` tinyint(1) NOT NULL,
  `flexion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abduction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adduction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiotherapy_musculo_4_3`
--

CREATE TABLE `patient_physiotherapy_musculo_4_3` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ms_acting_on_joint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flexors_0` tinyint(1) NOT NULL,
  `flexors_1` tinyint(1) NOT NULL,
  `flexors_2` tinyint(1) NOT NULL,
  `flexors_3` tinyint(1) NOT NULL,
  `flexors_4` tinyint(1) NOT NULL,
  `flexors_5` tinyint(1) NOT NULL,
  `extensors_0` tinyint(1) NOT NULL,
  `extensors_1` tinyint(1) NOT NULL,
  `extensors_2` tinyint(1) NOT NULL,
  `extensors_3` tinyint(1) NOT NULL,
  `extensors_4` tinyint(1) NOT NULL,
  `extensors_5` tinyint(1) NOT NULL,
  `abductors_0` tinyint(1) NOT NULL,
  `abductors_1` tinyint(1) NOT NULL,
  `abductors_2` tinyint(1) NOT NULL,
  `abductors_3` tinyint(1) NOT NULL,
  `abductors_4` tinyint(1) NOT NULL,
  `abductors_5` tinyint(1) NOT NULL,
  `adductors_0` tinyint(1) NOT NULL,
  `adductors_1` tinyint(1) NOT NULL,
  `adductors_2` tinyint(1) NOT NULL,
  `adductors_3` tinyint(1) NOT NULL,
  `adductors_4` tinyint(1) NOT NULL,
  `adductors_5` tinyint(1) NOT NULL,
  `medial_rotators_0` tinyint(1) NOT NULL,
  `medial_rotators_1` tinyint(1) NOT NULL,
  `medial_rotators_2` tinyint(1) NOT NULL,
  `medial_rotators_3` tinyint(1) NOT NULL,
  `medial_rotators_4` tinyint(1) NOT NULL,
  `medial_rotators_5` tinyint(1) NOT NULL,
  `lateral_rotators_0` tinyint(1) NOT NULL,
  `lateral_rotators_1` tinyint(1) NOT NULL,
  `lateral_rotators_2` tinyint(1) NOT NULL,
  `lateral_rotators_3` tinyint(1) NOT NULL,
  `lateral_rotators_4` tinyint(1) NOT NULL,
  `lateral_rotators_5` tinyint(1) NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiotherapy_musculo_4_4and5`
--

CREATE TABLE `patient_physiotherapy_musculo_4_4and5` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `muscle_tone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_investigation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `skin_conditions` tinyint(1) NOT NULL,
  `heart_disease` tinyint(1) NOT NULL,
  `diabetes` tinyint(1) NOT NULL,
  `osteoporosis` tinyint(1) NOT NULL,
  `joint_replacements` tinyint(1) NOT NULL,
  `pregnancy` tinyint(1) NOT NULL,
  `pacemaker` tinyint(1) NOT NULL,
  `stroke` tinyint(1) NOT NULL,
  `rapid_weight_loss` tinyint(1) NOT NULL,
  `bowelbladder_problems` tinyint(1) NOT NULL,
  `malignancy` tinyint(1) NOT NULL,
  `arthritis` tinyint(1) NOT NULL,
  `numbness` tinyint(1) NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiotherapy_neuro_functional_performance1`
--

CREATE TABLE `patient_physiotherapy_neuro_functional_performance1` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rolling_i` tinyint(1) NOT NULL,
  `rolling_s` tinyint(1) NOT NULL,
  `rolling_min` tinyint(1) NOT NULL,
  `rolling_mod` tinyint(1) NOT NULL,
  `rolling_max` tinyint(1) NOT NULL,
  `rolling_u` tinyint(1) NOT NULL,
  `rolling_nt` tinyint(1) NOT NULL,
  `supine_lying_sitting_i` tinyint(1) NOT NULL,
  `supine_lying_sitting_s` tinyint(1) NOT NULL,
  `supine_lying_sitting_min` tinyint(1) NOT NULL,
  `supine_lying_sitting_mod` tinyint(1) NOT NULL,
  `supine_lying_sitting_max` tinyint(1) NOT NULL,
  `supine_lying_sitting_u` tinyint(1) NOT NULL,
  `supine_lying_sitting_nt` tinyint(1) NOT NULL,
  `transfer_bed_chair_i` tinyint(1) NOT NULL,
  `transfer_bed_chair_s` tinyint(1) NOT NULL,
  `transfer_bed_chair_min` tinyint(1) NOT NULL,
  `transfer_bed_chair_mod` tinyint(1) NOT NULL,
  `transfer_bed_chair_max` tinyint(1) NOT NULL,
  `transfer_bed_chair_u` tinyint(1) NOT NULL,
  `transfer_bed_chair_nt` tinyint(1) NOT NULL,
  `sit_stand_i` tinyint(1) NOT NULL,
  `sit_stand_s` tinyint(1) NOT NULL,
  `sit_stand_min` tinyint(1) NOT NULL,
  `sit_stand_mod` tinyint(1) NOT NULL,
  `sit_stand_max` tinyint(1) NOT NULL,
  `sit_stand_u` tinyint(1) NOT NULL,
  `sit_stand_nt` tinyint(1) NOT NULL,
  `ambulation_i` tinyint(1) NOT NULL,
  `ambulation_s` tinyint(1) NOT NULL,
  `ambulation_min` tinyint(1) NOT NULL,
  `ambulation_mod` tinyint(1) NOT NULL,
  `ambulation_max` tinyint(1) NOT NULL,
  `ambulation_u` tinyint(1) NOT NULL,
  `ambulation_nt` tinyint(1) NOT NULL,
  `rolling_comment` text COLLATE utf8_unicode_ci,
  `spine_lying_sitting_comment` text COLLATE utf8_unicode_ci,
  `transfer_bed_chair_comment` text COLLATE utf8_unicode_ci,
  `sit_stand_comment` text COLLATE utf8_unicode_ci,
  `ambulation_comment` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiotherapy_neuro_functional_performance2`
--

CREATE TABLE `patient_physiotherapy_neuro_functional_performance2` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `walking_aid` tinyint(1) NOT NULL,
  `ws` tinyint(1) NOT NULL,
  `qs` tinyint(1) NOT NULL,
  `wf` tinyint(1) NOT NULL,
  `handroid` tinyint(1) NOT NULL,
  `reciprocal_yes` tinyint(1) NOT NULL,
  `reciprocal_no` tinyint(1) NOT NULL,
  `rail_nil` tinyint(1) NOT NULL,
  `rail_1` tinyint(1) NOT NULL,
  `rail_2` tinyint(1) NOT NULL,
  `writing_i` tinyint(1) NOT NULL,
  `writing_s` tinyint(1) NOT NULL,
  `writing_min` tinyint(1) NOT NULL,
  `writing_mod` tinyint(1) NOT NULL,
  `writing_max` tinyint(1) NOT NULL,
  `writing_u` tinyint(1) NOT NULL,
  `writing_nt` tinyint(1) NOT NULL,
  `writing_comment` text COLLATE utf8_unicode_ci,
  `holding_i` tinyint(1) NOT NULL,
  `holding_s` tinyint(1) NOT NULL,
  `holding_min` tinyint(1) NOT NULL,
  `holding_mod` tinyint(1) NOT NULL,
  `holding_max` tinyint(1) NOT NULL,
  `holding_u` tinyint(1) NOT NULL,
  `holding_nt` tinyint(1) NOT NULL,
  `holding_comment` text COLLATE utf8_unicode_ci,
  `picking_up_i` tinyint(1) NOT NULL,
  `picing_up_s` tinyint(1) NOT NULL,
  `picking_up_min` tinyint(1) NOT NULL,
  `picking_up_mod` tinyint(1) NOT NULL,
  `picking_up_max` tinyint(1) NOT NULL,
  `picking_up_u` tinyint(1) NOT NULL,
  `picking_up_nt` tinyint(1) NOT NULL,
  `picking_up_comment` text COLLATE utf8_unicode_ci,
  `reaching_i` tinyint(1) NOT NULL,
  `reaching_s` tinyint(1) NOT NULL,
  `reaching_min` tinyint(1) NOT NULL,
  `reaching_mod` tinyint(1) NOT NULL,
  `reaching_max` tinyint(1) NOT NULL,
  `reaching_u` tinyint(1) NOT NULL,
  `reaching_nt` tinyint(1) NOT NULL,
  `reaching_comment` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiotherapy_neuro_functional_performance3`
--

CREATE TABLE `patient_physiotherapy_neuro_functional_performance3` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `static_sitting_good` tinyint(1) NOT NULL,
  `static_sitting_fair` tinyint(1) NOT NULL,
  `static_sitting_poor` tinyint(1) NOT NULL,
  `static_sitting_nt` tinyint(1) NOT NULL,
  `static_sitting_comment` text COLLATE utf8_unicode_ci,
  `dynamic_sitting_good` tinyint(1) NOT NULL,
  `dynamic_sitting_fair` tinyint(1) NOT NULL,
  `dynamic_sitting_poor` tinyint(1) NOT NULL,
  `dynamic_sitting_nt` tinyint(1) NOT NULL,
  `dynamic_sitting_comment` text COLLATE utf8_unicode_ci,
  `static_standing_good` tinyint(1) NOT NULL,
  `static_standing_fair` tinyint(1) NOT NULL,
  `static_standing_poor` tinyint(1) NOT NULL,
  `static_standing_nt` tinyint(1) NOT NULL,
  `static_standing_comment` text COLLATE utf8_unicode_ci,
  `dynamic_standing_good` tinyint(1) NOT NULL,
  `dynamic_standing_fair` tinyint(1) NOT NULL,
  `dynamic_standing_poor` tinyint(1) NOT NULL,
  `dynamic_standing_nt` tinyint(1) NOT NULL,
  `dynamic_standing_comment` text COLLATE utf8_unicode_ci,
  `activity_tolerance_good` tinyint(1) NOT NULL,
  `activity_tolerance_fair` tinyint(1) NOT NULL,
  `activity_tolerance_poor` tinyint(1) NOT NULL,
  `activity_tolerance_nt` tinyint(1) NOT NULL,
  `activity_tolerance_comment` text COLLATE utf8_unicode_ci,
  `short_term_goal` text COLLATE utf8_unicode_ci NOT NULL,
  `long_term_goal` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiotherapy_neuro_general`
--

CREATE TABLE `patient_physiotherapy_neuro_general` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diagnosis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relevant` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `history` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pre_mobid_status_community` tinyint(1) NOT NULL,
  `pre_mobid_status_home_bound` tinyint(1) NOT NULL,
  `pre_mobid_status_wheel_chair_bound` tinyint(1) NOT NULL,
  `pre_mobid_status_bed_bound` tinyint(1) NOT NULL,
  `smoking_history_start` text COLLATE utf8_unicode_ci NOT NULL,
  `smoking_history_stop` text COLLATE utf8_unicode_ci NOT NULL,
  `mental_status` text COLLATE utf8_unicode_ci NOT NULL,
  `vision` text COLLATE utf8_unicode_ci NOT NULL,
  `hearing` text COLLATE utf8_unicode_ci NOT NULL,
  `speech_swallowing` text COLLATE utf8_unicode_ci NOT NULL,
  `orientation_time` tinyint(1) NOT NULL,
  `orientation_place` tinyint(1) NOT NULL,
  `orientation_person` tinyint(1) NOT NULL,
  `obey_ommands` text COLLATE utf8_unicode_ci NOT NULL,
  `follow_gestures` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiotherapy_neuro_limb`
--

CREATE TABLE `patient_physiotherapy_neuro_limb` (
  `patients_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shoulder_flexor_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shoulder_flexor_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shoulder_extensor_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shoulder_extensor_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shoulder_abductor_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shoulder_abductor_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elbow_flexor_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elbow_flexor_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elbow_extensor_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elbow_extensor_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gripping_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gripping_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hip_flexor_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hip_flexor_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hip_extensor_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hip_extensor_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hip_abductor_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hip_abductor_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `knee_flexion_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `knee_flexion_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `knee_extension_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `knee_extension_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ankle_dorsiflexion_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ankle_dorsiflexion_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ankle_plantarflexion_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ankle_plantarflexion_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sensation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `joint_position_sense` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_physiothreapy_musculo_1_and_2`
--

CREATE TABLE `patient_physiothreapy_musculo_1_and_2` (
  `patients_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diagnosis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `referred_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `previous_medical_history` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chief_complaint_onset` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chief_complaint_duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chief_complaint_site_and_spread_of_pain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chief_complaint_constant` tinyint(1) NOT NULL,
  `chief_complaint_sharp` tinyint(1) NOT NULL,
  `chief_complaint_thorbbing` tinyint(1) NOT NULL,
  `chief_complaint_others` text COLLATE utf8_unicode_ci NOT NULL,
  `chief_complaint_intermittent` tinyint(1) NOT NULL,
  `chief_complaint_dull_ache` tinyint(1) NOT NULL,
  `chief_complaint_night_pain` tinyint(1) NOT NULL,
  `chief_complaint_pain_grade` int(11) NOT NULL,
  `chief_complaint_aggravating_factors` text COLLATE utf8_unicode_ci NOT NULL,
  `chief_complaint_alternating_factors` text COLLATE utf8_unicode_ci NOT NULL,
  `chief_complaint_pin_and_needles` tinyint(1) NOT NULL,
  `chief_complaint_tingling` tinyint(1) NOT NULL,
  `chief_complaint_numbness` tinyint(1) NOT NULL,
  `chief_complaint_locking` tinyint(1) NOT NULL,
  `chief_complaint_popping` tinyint(1) NOT NULL,
  `chief_complaint_giving_way` tinyint(1) NOT NULL,
  `cheif_comlaint_sensation_others` text COLLATE utf8_unicode_ci NOT NULL,
  `observation_posture` text COLLATE utf8_unicode_ci NOT NULL,
  `observation_deformity` text COLLATE utf8_unicode_ci NOT NULL,
  `observation_gait` text COLLATE utf8_unicode_ci NOT NULL,
  `observation_swelling` tinyint(1) NOT NULL,
  `observation_heat` tinyint(1) NOT NULL,
  `observation_tendemess` tinyint(1) NOT NULL,
  `observation_loss_of_function` tinyint(1) NOT NULL,
  `observation_muscule_spasm` tinyint(1) NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_surgery_history`
--

CREATE TABLE `patient_surgery_history` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `physical_exams`
--

CREATE TABLE `physical_exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provisional_diagnosis`
--

CREATE TABLE `provisional_diagnosis` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enquiry_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_package_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `township_id` int(10) UNSIGNED NOT NULL,
  `zone_id` int(11) NOT NULL,
  `car_type` int(11) NOT NULL,
  `car_type_id` int(10) UNSIGNED NOT NULL,
  `car_type_setup_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `leader_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_detail`
--

CREATE TABLE `schedule_detail` (
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_investigations`
--

CREATE TABLE `schedule_investigations` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `investigation_id` int(11) NOT NULL,
  `investigation_lab_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `investigation_imaging_xray_id` int(11) NOT NULL,
  `investigation_imaging_usg_id` int(11) NOT NULL,
  `investigation_imaging_ct_id` int(11) NOT NULL,
  `investigation_imaging_mri_id` int(11) NOT NULL,
  `investigation_imaging_other_id` int(11) NOT NULL,
  `investigation_imaging_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `investigation_ecg_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `investigation_other_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `investigation_labs_price` double NOT NULL,
  `investigation_labs_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_patient_chief_complaint`
--

CREATE TABLE `schedule_patient_chief_complaint` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chief_complaint_comment` text COLLATE utf8_unicode_ci,
  `duration_days` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration_months` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hopi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_patient_vitals`
--

CREATE TABLE `schedule_patient_vitals` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blood_pressure_sbp` double NOT NULL,
  `blood_pressure_dbp` double NOT NULL,
  `blood_pressure_map` double NOT NULL,
  `spo2` double NOT NULL,
  `pulse_rate` double NOT NULL,
  `body_temperature_farenheit` double NOT NULL,
  `body_temperature_celsius` double(8,2) NOT NULL,
  `weight_pound` double NOT NULL,
  `weight_kg` double NOT NULL,
  `height_feet` double NOT NULL,
  `height_inches` double NOT NULL,
  `height_cm` double NOT NULL,
  `blood_sugar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `spo2_comment` text COLLATE utf8_unicode_ci,
  `pulse_rate_comment` text COLLATE utf8_unicode_ci,
  `blood_sugar_comment` text COLLATE utf8_unicode_ci,
  `bmi` double NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_patient_vitals_remark`
--

CREATE TABLE `schedule_patient_vitals_remark` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_physical_exams_abdomen_extre_neuro`
--

CREATE TABLE `schedule_physical_exams_abdomen_extre_neuro` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abdomen_normal` tinyint(1) NOT NULL,
  `abdomen_abnormal` tinyint(1) NOT NULL,
  `abdomen_tenderness` tinyint(1) NOT NULL,
  `abdomen_distension` tinyint(1) NOT NULL,
  `abdomen_mass` tinyint(1) NOT NULL,
  `abdomen_hernia` tinyint(1) NOT NULL,
  `abdomen_bowel_sound` tinyint(1) NOT NULL,
  `abdomen_remark` text COLLATE utf8_unicode_ci,
  `extre_normal` tinyint(1) NOT NULL,
  `extre_abnormal` tinyint(1) NOT NULL,
  `extre_edema` tinyint(1) NOT NULL,
  `extre_varicose` tinyint(1) NOT NULL,
  `extre_ulcer` tinyint(1) NOT NULL,
  `extre_gangrene` tinyint(1) NOT NULL,
  `extre_calf_tenderness` tinyint(1) NOT NULL,
  `extre_ampulation` tinyint(1) NOT NULL,
  `extre_remark` text COLLATE utf8_unicode_ci,
  `neuro_normal` tinyint(1) NOT NULL,
  `neuro_abnormal` tinyint(1) NOT NULL,
  `neuro_motor_weakness` tinyint(1) NOT NULL,
  `neuro_sensory_loss` tinyint(1) NOT NULL,
  `neuro_abnormal_movement` tinyint(1) NOT NULL,
  `neuro_remark` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_physical_exams_general_pupils_head`
--

CREATE TABLE `schedule_physical_exams_general_pupils_head` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alert` tinyint(1) NOT NULL,
  `unconscious` tinyint(1) NOT NULL,
  `semiconscious` tinyint(1) NOT NULL,
  `drowsy` tinyint(1) NOT NULL,
  `general_remark` text COLLATE utf8_unicode_ci,
  `pupils_normal` tinyint(1) NOT NULL,
  `pupils_abnormal` tinyint(1) NOT NULL,
  `pupils_left_pinpoint_pupil` tinyint(1) NOT NULL,
  `pupils_left_reactive` tinyint(1) NOT NULL,
  `pupils_left_not_reactive` tinyint(1) NOT NULL,
  `pupils_right_pinpoint_pupil` tinyint(1) NOT NULL,
  `pupils_right_reactive` tinyint(1) NOT NULL,
  `pupils_right_not_reactive` tinyint(1) NOT NULL,
  `pupils_remark` text COLLATE utf8_unicode_ci,
  `head_normal` tinyint(1) NOT NULL,
  `head_abnormal` tinyint(1) NOT NULL,
  `head_JVD` tinyint(1) NOT NULL,
  `head_Goiter` tinyint(1) NOT NULL,
  `head_Lympha` tinyint(1) NOT NULL,
  `head_remark` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_physical_exams_heart_lungs`
--

CREATE TABLE `schedule_physical_exams_heart_lungs` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `heart_normal` tinyint(1) NOT NULL,
  `heart_abnormal` tinyint(1) NOT NULL,
  `heart_rate_normal` tinyint(1) NOT NULL,
  `heart_rate_brady` tinyint(1) NOT NULL,
  `heart_rate_tachy` tinyint(1) NOT NULL,
  `heart_rhythm_regular` tinyint(1) NOT NULL,
  `heart_rhythm_irregular` tinyint(1) NOT NULL,
  `heart_sound_s1` tinyint(1) NOT NULL,
  `heart_sound_s2` tinyint(1) NOT NULL,
  `heart_sound_systolic` tinyint(1) NOT NULL,
  `heart_sound_diastolic` tinyint(1) NOT NULL,
  `heart_remark` text COLLATE utf8_unicode_ci,
  `lungs_normal` tinyint(1) NOT NULL,
  `lungs_abnormal` tinyint(1) NOT NULL,
  `lungs_left_chest` tinyint(1) NOT NULL,
  `lungs_left_dullness` tinyint(1) NOT NULL,
  `lungs_left_reduced` tinyint(1) NOT NULL,
  `lungs_left_absent` tinyint(1) NOT NULL,
  `lungs_left_crepitations` tinyint(1) NOT NULL,
  `lungs_left_wheezing` tinyint(1) NOT NULL,
  `lungs_right_chest` tinyint(1) NOT NULL,
  `lungs_right_dullness` tinyint(1) NOT NULL,
  `lungs_right_reduced` tinyint(1) NOT NULL,
  `lungs_right_absent` tinyint(1) NOT NULL,
  `lungs_right_crepitations` tinyint(1) NOT NULL,
  `lungs_right_wheezing` tinyint(1) NOT NULL,
  `lungs_remark` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_physiotherapy_musculo`
--

CREATE TABLE `schedule_physiotherapy_musculo` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedules_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ultrasound` tinyint(1) NOT NULL,
  `hot_manager` tinyint(1) NOT NULL,
  `traction` tinyint(1) NOT NULL,
  `electrical_stimulation` tinyint(1) NOT NULL,
  `infra_red` tinyint(1) NOT NULL,
  `laser` tinyint(1) NOT NULL,
  `exercise_therapy` text COLLATE utf8_unicode_ci NOT NULL,
  `health_education` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `others` text COLLATE utf8_unicode_ci NOT NULL,
  `signature_of_physiotherapist` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diagnosis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `progress_note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_physiotherapy_neuro`
--

CREATE TABLE `schedule_physiotherapy_neuro` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedules_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diagnosis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resting_bp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resting_hr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resting_spo2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passive_rom_exercise` tinyint(1) NOT NULL,
  `visual_exercise` tinyint(1) NOT NULL,
  `oral_motor_exercise` tinyint(1) NOT NULL,
  `active_assisted_rom_exercise` tinyint(1) NOT NULL,
  `bridging_inner_range` tinyint(1) NOT NULL,
  `transfer_bed` tinyint(1) NOT NULL,
  `sitting_balance` tinyint(1) NOT NULL,
  `sit_to_stand` tinyint(1) NOT NULL,
  `standing_balance` tinyint(1) NOT NULL,
  `stepping` tinyint(1) NOT NULL,
  `single_leg_balance` tinyint(1) NOT NULL,
  `march_on_spot` tinyint(1) NOT NULL,
  `ambulation_parallel_bar` tinyint(1) NOT NULL,
  `ambulation_walk` tinyint(1) NOT NULL,
  `ambulation_outdoor` tinyint(1) NOT NULL,
  `ambulation_tandem_walk` tinyint(1) NOT NULL,
  `stair` tinyint(1) NOT NULL,
  `arm_pedal` tinyint(1) NOT NULL,
  `treadmill` tinyint(1) NOT NULL,
  `hand_exercise` tinyint(1) NOT NULL,
  `writing_assisted_exercise` tinyint(1) NOT NULL,
  `signature_of_physiotherapist` tinyint(1) NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_provisional_diagnosis`
--

CREATE TABLE `schedule_provisional_diagnosis` (
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provisional_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_trackings`
--

CREATE TABLE `schedule_trackings` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preparation_start_time` time NOT NULL,
  `preparation_end_time` time NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enquiry_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arrived_to_patient_time` time NOT NULL,
  `leave_from_patient_time` time NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_treatment_histories`
--

CREATE TABLE `schedule_treatment_histories` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_product` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_dosage` int(11) NOT NULL,
  `frequency` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `days` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `schedule_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sold_dosage` int(11) NOT NULL,
  `unsold_dosage` int(11) NOT NULL,
  `time` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'MO', '100000.00', 'MO Service', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(2, 'Physiotherapy Musculo', '100000.00', 'Physiotherapy Musculo Service', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(3, 'Physiotherapy Neuro', '100000.00', 'Physiotherapy Neuro Service', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(4, 'Nutrition', '100000.00', 'Nutrition Service', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL),
(5, 'Blood Drawing', '100000.00', 'Blood Drawing Service', 'U0001', 'U0001', NULL, '2017-01-06 11:30:35', '2017-01-06 11:30:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setup_price_tracking`
--

CREATE TABLE `setup_price_tracking` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_id_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `new_price` decimal(10,2) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setup_price_tracking`
--

INSERT INTO `setup_price_tracking` (`id`, `table_name`, `table_id`, `table_id_type`, `action`, `old_price`, `new_price`, `type`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'services', '1', 'integer', 'create', '0.00', '100000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'services', '2', 'integer', 'create', '0.00', '100000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'services', '3', 'integer', 'create', '0.00', '100000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'services', '4', 'integer', 'create', '0.00', '100000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'investigations_imaging', '1', 'integer', 'create', '0.00', '150000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'investigations_imaging', '2', 'integer', 'create', '0.00', '200000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'investigations_imaging', '3', 'integer', 'create', '0.00', '110000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'investigations_imaging', '4', 'integer', 'create', '0.00', '180000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'investigations_imaging', '5', 'integer', 'create', '0.00', '180000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'investigations_imaging', '6', 'integer', 'create', '0.00', '250000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'investigations_imaging', '7', 'integer', 'create', '0.00', '100000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'investigations_imaging', '8', 'integer', 'create', '0.00', '1000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'investigations_imaging', '9', 'integer', 'create', '0.00', '110000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'investigations_imaging', '10', 'integer', 'create', '0.00', '110000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'investigations_imaging', '11', 'integer', 'create', '0.00', '170000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'investigations_imaging', '12', 'integer', 'create', '0.00', '300000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'investigations_imaging', '13', 'integer', 'create', '0.00', '95000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'investigations_imaging', '14', 'integer', 'create', '0.00', '180000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'investigations_imaging', '15', 'integer', 'create', '0.00', '180000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'investigations_imaging', '16', 'integer', 'create', '0.00', '110000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'investigations_imaging', '17', 'integer', 'create', '0.00', '95000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'investigations_imaging', '18', 'integer', 'create', '0.00', '110000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'investigations_imaging', '19', 'integer', 'create', '0.00', '200000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'investigations_imaging', '20', 'integer', 'create', '0.00', '110000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'investigations_imaging', '21', 'integer', 'create', '0.00', '95000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'investigations_imaging', '22', 'integer', 'create', '0.00', '170000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'investigations_imaging', '23', 'integer', 'create', '0.00', '95000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'investigations_imaging', '24', 'integer', 'create', '0.00', '95000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'investigations_imaging', '25', 'integer', 'create', '0.00', '110000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'investigations_imaging', '26', 'integer', 'create', '0.00', '180000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'investigations_imaging', '27', 'integer', 'create', '0.00', '180000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'investigations_imaging', '28', 'integer', 'create', '0.00', '180000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'investigations_imaging', '29', 'integer', 'create', '0.00', '95000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'investigations_imaging', '30', 'integer', 'create', '0.00', '180000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'investigations_imaging', '31', 'integer', 'create', '0.00', '180000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'investigations_imaging', '32', 'integer', 'create', '0.00', '110000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'investigations_imaging', '33', 'integer', 'create', '0.00', '200000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'investigations_imaging', '34', 'integer', 'create', '0.00', '200000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'investigations_imaging', '35', 'integer', 'create', '0.00', '170000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'investigations_imaging', '36', 'integer', 'create', '0.00', '250000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'investigations_imaging', '37', 'integer', 'create', '0.00', '400000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'investigations_imaging', '38', 'integer', 'create', '0.00', '237700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'investigations_imaging', '39', 'integer', 'create', '0.00', '535400.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'investigations_imaging', '40', 'integer', 'create', '0.00', '397700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'investigations_imaging', '41', 'integer', 'create', '0.00', '445400.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'investigations_imaging', '42', 'integer', 'create', '0.00', '217700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'investigations_imaging', '43', 'integer', 'create', '0.00', '267700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'investigations_imaging', '44', 'integer', 'create', '0.00', '147700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'investigations_imaging', '45', 'integer', 'create', '0.00', '427200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'investigations_imaging', '46', 'integer', 'create', '0.00', '237200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'investigations_imaging', '47', 'integer', 'create', '0.00', '307200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'investigations_imaging', '48', 'integer', 'create', '0.00', '567200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'investigations_imaging', '49', 'integer', 'create', '0.00', '220800.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'investigations_imaging', '50', 'integer', 'create', '0.00', '115800.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'investigations_imaging', '51', 'integer', 'create', '0.00', '267700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'investigations_imaging', '52', 'integer', 'create', '0.00', '147700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'investigations_imaging', '53', 'integer', 'create', '0.00', '407700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'investigations_imaging', '54', 'integer', 'create', '0.00', '267700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'investigations_imaging', '55', 'integer', 'create', '0.00', '147700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'investigations_imaging', '56', 'integer', 'create', '0.00', '407200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'investigations_imaging', '57', 'integer', 'create', '0.00', '227200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'investigations_imaging', '58', 'integer', 'create', '0.00', '497700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'investigations_imaging', '59', 'integer', 'create', '0.00', '357200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'investigations_imaging', '60', 'integer', 'create', '0.00', '428500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'investigations_imaging', '61', 'integer', 'create', '0.00', '238500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'investigations_imaging', '62', 'integer', 'create', '0.00', '220800.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'investigations_imaging', '63', 'integer', 'create', '0.00', '115800.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'investigations_imaging', '64', 'integer', 'create', '0.00', '667200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'investigations_imaging', '65', 'integer', 'create', '0.00', '427200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'investigations_imaging', '66', 'integer', 'create', '0.00', '237200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'investigations_imaging', '67', 'integer', 'create', '0.00', '267700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'investigations_imaging', '68', 'integer', 'create', '0.00', '237700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'investigations_imaging', '69', 'integer', 'create', '0.00', '297700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'investigations_imaging', '70', 'integer', 'create', '0.00', '132700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'investigations_imaging', '71', 'integer', 'create', '0.00', '147700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'investigations_imaging', '72', 'integer', 'create', '0.00', '267700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 'investigations_imaging', '73', 'integer', 'create', '0.00', '467200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 'investigations_imaging', '74', 'integer', 'create', '0.00', '257200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 'investigations_imaging', '75', 'integer', 'create', '0.00', '267700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 'investigations_imaging', '76', 'integer', 'create', '0.00', '147700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'investigations_imaging', '77', 'integer', 'create', '0.00', '237700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'investigations_imaging', '78', 'integer', 'create', '0.00', '447700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 'investigations_imaging', '79', 'integer', 'create', '0.00', '237700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 'investigations_imaging', '80', 'integer', 'create', '0.00', '132700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 'investigations_imaging', '81', 'integer', 'create', '0.00', '407200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'investigations_imaging', '82', 'integer', 'create', '0.00', '227200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'investigations_imaging', '83', 'integer', 'create', '0.00', '237700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 'investigations_imaging', '84', 'integer', 'create', '0.00', '132700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'investigations_imaging', '85', 'integer', 'create', '0.00', '237700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 'investigations_imaging', '86', 'integer', 'create', '0.00', '427200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 'investigations_imaging', '87', 'integer', 'create', '0.00', '237200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'investigations_imaging', '88', 'integer', 'create', '0.00', '427200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 'investigations_imaging', '89', 'integer', 'create', '0.00', '237200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 'investigations_imaging', '90', 'integer', 'create', '0.00', '427200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 'investigations_imaging', '91', 'integer', 'create', '0.00', '237200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 'investigations_imaging', '92', 'integer', 'create', '0.00', '237700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'investigations_imaging', '93', 'integer', 'create', '0.00', '427200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 'investigations_imaging', '94', 'integer', 'create', '0.00', '237200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 'investigations_imaging', '95', 'integer', 'create', '0.00', '217700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'investigations_imaging', '96', 'integer', 'create', '0.00', '267700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 'investigations_imaging', '97', 'integer', 'create', '0.00', '147700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 'investigations_imaging', '98', 'integer', 'create', '0.00', '407700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 'investigations_imaging', '99', 'integer', 'create', '0.00', '467200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 'investigations_imaging', '100', 'integer', 'create', '0.00', '257200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 'investigations_imaging', '101', 'integer', 'create', '0.00', '445400.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 'investigations_imaging', '102', 'integer', 'create', '0.00', '20800.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 'investigations_imaging', '103', 'integer', 'create', '0.00', '26000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 'investigations_imaging', '104', 'integer', 'create', '0.00', '57200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 'investigations_imaging', '105', 'integer', 'create', '0.00', '62400.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 'investigations_imaging', '106', 'integer', 'create', '0.00', '37700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 'investigations_imaging', '107', 'integer', 'create', '0.00', '42900.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 'investigations_imaging', '108', 'integer', 'create', '0.00', '267700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 'investigations_imaging', '109', 'integer', 'create', '0.00', '407200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 'investigations_imaging', '110', 'integer', 'create', '0.00', '227200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 'investigations_imaging', '111', 'integer', 'create', '0.00', '10000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 'investigations_imaging', '112', 'integer', 'create', '0.00', '3000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 'investigations_imaging', '113', 'integer', 'create', '0.00', '6000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 'investigations_imaging', '114', 'integer', 'create', '0.00', '9000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 'investigations_imaging', '115', 'integer', 'create', '0.00', '12000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 'investigations_imaging', '116', 'integer', 'create', '0.00', '15000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 'investigations_imaging', '117', 'integer', 'create', '0.00', '60000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 'investigations_imaging', '118', 'integer', 'create', '0.00', '124000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 'investigations_imaging', '119', 'integer', 'create', '0.00', '6000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 'investigations_imaging', '120', 'integer', 'create', '0.00', '12000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 'investigations_imaging', '121', 'integer', 'create', '0.00', '3000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 'investigations_imaging', '122', 'integer', 'create', '0.00', '25500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 'investigations_imaging', '123', 'integer', 'create', '0.00', '15000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 'investigations_imaging', '124', 'integer', 'create', '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 'investigations_imaging', '125', 'integer', 'create', '0.00', '600.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 'investigations_imaging', '126', 'integer', 'create', '0.00', '30000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 'investigations_imaging', '127', 'integer', 'create', '0.00', '250.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 'investigations_imaging', '128', 'integer', 'create', '0.00', '500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 'investigations_imaging', '129', 'integer', 'create', '0.00', '12000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 'investigations_imaging', '130', 'integer', 'create', '0.00', '1000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 'investigations_imaging', '131', 'integer', 'create', '0.00', '5000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 'investigations_imaging', '132', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 'investigations_imaging', '133', 'integer', 'create', '0.00', '1500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 'investigations_imaging', '134', 'integer', 'create', '0.00', '287500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 'investigations_imaging', '135', 'integer', 'create', '0.00', '265000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 'investigations_imaging', '136', 'integer', 'create', '0.00', '230000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 'investigations_imaging', '137', 'integer', 'create', '0.00', '327500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 'investigations_imaging', '138', 'integer', 'create', '0.00', '287500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 'investigations_imaging', '139', 'integer', 'create', '0.00', '218500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 'investigations_imaging', '140', 'integer', 'create', '0.00', '252500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 'investigations_imaging', '141', 'integer', 'create', '0.00', '287500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 'investigations_imaging', '142', 'integer', 'create', '0.00', '327500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 'investigations_imaging', '143', 'integer', 'create', '0.00', '327500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 'investigations_imaging', '144', 'integer', 'create', '0.00', '252500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 'investigations_imaging', '145', 'integer', 'create', '0.00', '218500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 'investigations_imaging', '146', 'integer', 'create', '0.00', '260000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 'investigations_imaging', '147', 'integer', 'create', '0.00', '300000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 'investigations_imaging', '148', 'integer', 'create', '0.00', '160000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 'investigations_imaging', '149', 'integer', 'create', '0.00', '191000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 'investigations_imaging', '150', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 'investigations_imaging', '151', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(156, 'investigations_imaging', '152', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 'investigations_imaging', '153', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 'investigations_imaging', '154', 'integer', 'create', '0.00', '160000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 'investigations_imaging', '155', 'integer', 'create', '0.00', '191000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 'investigations_imaging', '156', 'integer', 'create', '0.00', '160000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 'investigations_imaging', '157', 'integer', 'create', '0.00', '191000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(162, 'investigations_imaging', '158', 'integer', 'create', '0.00', '1000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(163, 'investigations_imaging', '159', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 'investigations_imaging', '160', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(165, 'investigations_imaging', '161', 'integer', 'create', '0.00', '260000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 'investigations_imaging', '162', 'integer', 'create', '0.00', '300000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 'investigations_imaging', '163', 'integer', 'create', '0.00', '160000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 'investigations_imaging', '164', 'integer', 'create', '0.00', '191000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(169, 'investigations_imaging', '165', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 'investigations_imaging', '166', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, 'investigations_imaging', '167', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, 'investigations_imaging', '168', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, 'investigations_imaging', '169', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 'investigations_imaging', '170', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, 'investigations_imaging', '171', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(176, 'investigations_imaging', '172', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(177, 'investigations_imaging', '173', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(178, 'investigations_imaging', '174', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(179, 'investigations_imaging', '175', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(180, 'investigations_imaging', '176', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(181, 'investigations_imaging', '177', 'integer', 'create', '0.00', '160000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, 'investigations_imaging', '178', 'integer', 'create', '0.00', '191000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(183, 'investigations_imaging', '179', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(184, 'investigations_imaging', '180', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 'investigations_imaging', '181', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(186, 'investigations_imaging', '182', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(187, 'investigations_imaging', '183', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(188, 'investigations_imaging', '184', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(189, 'investigations_imaging', '185', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(190, 'investigations_imaging', '186', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(191, 'investigations_imaging', '187', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(192, 'investigations_imaging', '188', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(193, 'investigations_imaging', '189', 'integer', 'create', '0.00', '160000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(194, 'investigations_imaging', '190', 'integer', 'create', '0.00', '191000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(195, 'investigations_imaging', '191', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(196, 'investigations_imaging', '192', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(197, 'investigations_imaging', '193', 'integer', 'create', '0.00', '88500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(198, 'investigations_imaging', '194', 'integer', 'create', '0.00', '112500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(199, 'investigations_imaging', '195', 'integer', 'create', '0.00', '160000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(200, 'investigations_imaging', '196', 'integer', 'create', '0.00', '191000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(201, 'investigations_imaging', '197', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(202, 'investigations_imaging', '198', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(203, 'investigations_imaging', '199', 'integer', 'create', '0.00', '191000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(204, 'investigations_imaging', '200', 'integer', 'create', '0.00', '160000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(205, 'investigations_imaging', '201', 'integer', 'create', '0.00', '16000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(206, 'investigations_imaging', '202', 'integer', 'create', '0.00', '19000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(207, 'investigations_imaging', '203', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(208, 'investigations_imaging', '204', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(209, 'investigations_imaging', '205', 'integer', 'create', '0.00', '260000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(210, 'investigations_imaging', '206', 'integer', 'create', '0.00', '300000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(211, 'investigations_imaging', '207', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(212, 'investigations_imaging', '208', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(213, 'investigations_imaging', '209', 'integer', 'create', '0.00', '320000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(214, 'investigations_imaging', '210', 'integer', 'create', '0.00', '387000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(215, 'investigations_imaging', '211', 'integer', 'create', '0.00', '190000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(216, 'investigations_imaging', '212', 'integer', 'create', '0.00', '224000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(217, 'investigations_imaging', '213', 'integer', 'create', '0.00', '287500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(218, 'investigations_imaging', '214', 'integer', 'create', '0.00', '356200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(219, 'investigations_imaging', '215', 'integer', 'create', '0.00', '210700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220, 'investigations_imaging', '216', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(221, 'investigations_imaging', '217', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(222, 'investigations_imaging', '218', 'integer', 'create', '0.00', '191200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(223, 'investigations_imaging', '219', 'integer', 'create', '0.00', '210700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(224, 'investigations_imaging', '220', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(225, 'investigations_imaging', '221', 'integer', 'create', '0.00', '356200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(226, 'investigations_imaging', '222', 'integer', 'create', '0.00', '210700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 'investigations_imaging', '223', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(228, 'investigations_imaging', '224', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(229, 'investigations_imaging', '225', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(230, 'investigations_imaging', '226', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231, 'investigations_imaging', '227', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(232, 'investigations_imaging', '228', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(233, 'investigations_imaging', '229', 'integer', 'create', '0.00', '210700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(234, 'investigations_imaging', '230', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(235, 'investigations_imaging', '231', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(236, 'investigations_imaging', '232', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(237, 'investigations_imaging', '233', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(238, 'investigations_imaging', '234', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(239, 'investigations_imaging', '235', 'integer', 'create', '0.00', '210700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(240, 'investigations_imaging', '236', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(241, 'investigations_imaging', '237', 'integer', 'create', '0.00', '139200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(242, 'investigations_imaging', '238', 'integer', 'create', '0.00', '210700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(243, 'investigations_imaging', '239', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(244, 'investigations_imaging', '240', 'integer', 'create', '0.00', '210700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(245, 'investigations_imaging', '241', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(246, 'investigations_imaging', '242', 'integer', 'create', '0.00', '356200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(247, 'investigations_imaging', '243', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(248, 'investigations_imaging', '244', 'integer', 'create', '0.00', '240700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(249, 'investigations_imaging', '245', 'integer', 'create', '0.00', '50700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 'investigations_imaging', '246', 'integer', 'create', '0.00', '96200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(251, 'investigations_imaging', '247', 'integer', 'create', '0.00', '31200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(252, 'investigations_imaging', '248', 'integer', 'create', '0.00', '3500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(253, 'investigations_imaging', '249', 'integer', 'create', '0.00', '7000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(254, 'investigations_imaging', '250', 'integer', 'create', '0.00', '10500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(255, 'investigations_imaging', '251', 'integer', 'create', '0.00', '14000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(256, 'investigations_imaging', '252', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(257, 'investigations_imaging', '253', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(258, 'investigations_imaging', '254', 'integer', 'create', '0.00', '4500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(259, 'investigations_imaging', '255', 'integer', 'create', '0.00', '45000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(260, 'investigations_imaging', '256', 'integer', 'create', '0.00', '9000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(261, 'investigations_imaging', '257', 'integer', 'create', '0.00', '90000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(262, 'investigations_imaging', '258', 'integer', 'create', '0.00', '13500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(263, 'investigations_imaging', '259', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(264, 'investigations_imaging', '260', 'integer', 'create', '0.00', '2500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(265, 'investigations_imaging', '261', 'integer', 'create', '0.00', '97000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(266, 'investigations_imaging', '262', 'integer', 'create', '0.00', '65000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(267, 'investigations_imaging', '263', 'integer', 'create', '0.00', '30000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(268, 'investigations_imaging', '264', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(269, 'investigations_imaging', '265', 'integer', 'create', '0.00', '30000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(270, 'investigations_imaging', '266', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(271, 'investigations_imaging', '267', 'integer', 'create', '0.00', '40000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(272, 'investigations_imaging', '268', 'integer', 'create', '0.00', '45000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(273, 'investigations_imaging', '269', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(274, 'investigations_imaging', '270', 'integer', 'create', '0.00', '34000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(275, 'investigations_imaging', '271', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(276, 'investigations_imaging', '272', 'integer', 'create', '0.00', '34000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(277, 'investigations_imaging', '273', 'integer', 'create', '0.00', '50000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(278, 'investigations_imaging', '274', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(279, 'investigations_imaging', '275', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(280, 'investigations_imaging', '276', 'integer', 'create', '0.00', '27500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(281, 'investigations_imaging', '277', 'integer', 'create', '0.00', '30000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(282, 'investigations_imaging', '278', 'integer', 'create', '0.00', '11000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(283, 'investigations_imaging', '279', 'integer', 'create', '0.00', '21000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(284, 'investigations_imaging', '280', 'integer', 'create', '0.00', '16000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(285, 'investigations_imaging', '281', 'integer', 'create', '0.00', '13000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(286, 'investigations_imaging', '282', 'integer', 'create', '0.00', '13000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(287, 'investigations_imaging', '283', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(288, 'investigations_imaging', '284', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(289, 'investigations_imaging', '285', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(290, 'investigations_imaging', '286', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(291, 'investigations_imaging', '287', 'integer', 'create', '0.00', '25000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(292, 'investigations_imaging', '288', 'integer', 'create', '0.00', '6000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(293, 'investigations_imaging', '289', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(294, 'investigations_imaging', '290', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(295, 'investigations_imaging', '291', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(296, 'investigations_imaging', '292', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(297, 'investigations_imaging', '293', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(298, 'investigations_imaging', '294', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(299, 'investigations_imaging', '295', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(300, 'investigations_imaging', '296', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(301, 'investigations_imaging', '297', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(302, 'investigations_imaging', '298', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(303, 'investigations_imaging', '299', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(304, 'investigations_imaging', '300', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(305, 'investigations_imaging', '301', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(306, 'investigations_imaging', '302', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(307, 'investigations_imaging', '303', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(308, 'investigations_imaging', '304', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(309, 'investigations_imaging', '305', 'integer', 'create', '0.00', '60000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(310, 'investigations_imaging', '306', 'integer', 'create', '0.00', '46000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(311, 'investigations_imaging', '307', 'integer', 'create', '0.00', '52000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(312, 'investigations_imaging', '308', 'integer', 'create', '0.00', '40500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(313, 'investigations_imaging', '309', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(314, 'investigations_imaging', '310', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(315, 'investigations_imaging', '311', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(316, 'investigations_imaging', '312', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(317, 'investigations_imaging', '313', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(318, 'investigations_imaging', '314', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(319, 'investigations_imaging', '315', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(320, 'investigations_imaging', '316', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(321, 'investigations_imaging', '317', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(322, 'investigations_imaging', '318', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(323, 'investigations_imaging', '319', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(324, 'investigations_imaging', '320', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(325, 'investigations_imaging', '321', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(326, 'investigations_imaging', '322', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(327, 'investigations_imaging', '323', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(328, 'investigations_imaging', '324', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(329, 'investigations_imaging', '325', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(330, 'investigations_imaging', '326', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(331, 'investigations_imaging', '327', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(332, 'investigations_imaging', '328', 'integer', 'create', '0.00', '30000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(333, 'investigations_imaging', '329', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(334, 'investigations_imaging', '330', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(335, 'investigations_imaging', '331', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(336, 'investigations_imaging', '332', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(337, 'investigations_imaging', '333', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(338, 'investigations_imaging', '334', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(339, 'investigations_imaging', '335', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(340, 'investigations_imaging', '336', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(341, 'investigations_imaging', '337', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(342, 'investigations_imaging', '338', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(343, 'investigations_imaging', '339', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(344, 'investigations_imaging', '340', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(345, 'investigations_imaging', '341', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(346, 'investigations_imaging', '342', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(347, 'investigations_imaging', '343', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(348, 'investigations_imaging', '344', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(349, 'investigations_imaging', '345', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(350, 'investigations_imaging', '346', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(351, 'investigations_imaging', '347', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(352, 'investigations_imaging', '348', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(353, 'investigations_imaging', '349', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(354, 'investigations_imaging', '350', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(355, 'investigations_imaging', '351', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(356, 'investigations_imaging', '352', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(357, 'investigations_imaging', '353', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(358, 'investigations_imaging', '354', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(359, 'investigations_imaging', '355', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(360, 'investigations_imaging', '356', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(361, 'investigations_imaging', '357', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(362, 'investigations_imaging', '358', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(363, 'investigations_imaging', '359', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(364, 'investigations_imaging', '360', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(365, 'investigations_imaging', '361', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(366, 'investigations_imaging', '362', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(367, 'investigations_imaging', '363', 'integer', 'create', '0.00', '500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(368, 'investigations_imaging', '364', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(369, 'investigations_imaging', '365', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(370, 'investigations_imaging', '366', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(371, 'investigations_imaging', '367', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(372, 'investigations_imaging', '368', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(373, 'investigations_imaging', '369', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(374, 'investigations_imaging', '370', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(375, 'investigations_imaging', '371', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(376, 'investigations_imaging', '372', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(377, 'investigations_imaging', '373', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(378, 'investigations_imaging', '374', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(379, 'investigations_imaging', '375', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(380, 'investigations_imaging', '376', 'integer', 'create', '0.00', '10000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(381, 'investigations_imaging', '377', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(382, 'investigations_imaging', '378', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(383, 'investigations_imaging', '379', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(384, 'investigations_imaging', '380', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(385, 'investigations_imaging', '381', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(386, 'investigations_imaging', '382', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(387, 'investigations_imaging', '383', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(388, 'investigations_imaging', '384', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(389, 'investigations_imaging', '385', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(390, 'investigations_imaging', '386', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(391, 'investigations_imaging', '387', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(392, 'investigations_imaging', '388', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(393, 'investigations_imaging', '389', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(394, 'investigations_imaging', '390', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(395, 'investigations_imaging', '391', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(396, 'investigations_imaging', '392', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(397, 'investigations_imaging', '393', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(398, 'investigations_imaging', '394', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(399, 'investigations_imaging', '395', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(400, 'investigations_imaging', '396', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(401, 'investigations_imaging', '397', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(402, 'investigations_imaging', '398', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(403, 'investigations_imaging', '399', 'integer', 'create', '0.00', '1200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(404, 'investigations_imaging', '400', 'integer', 'create', '0.00', '5000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(405, 'investigations_imaging', '401', 'integer', 'create', '0.00', '10000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(406, 'investigations_imaging', '402', 'integer', 'create', '0.00', '11500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(407, 'investigations_imaging', '403', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(408, 'investigations_imaging', '404', 'integer', 'create', '0.00', '23500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(409, 'investigations_imaging', '405', 'integer', 'create', '0.00', '26000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(410, 'investigations_imaging', '406', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(411, 'investigations_imaging', '407', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(412, 'investigations_imaging', '408', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `setup_price_tracking` (`id`, `table_name`, `table_id`, `table_id_type`, `action`, `old_price`, `new_price`, `type`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(413, 'investigations_imaging', '409', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(414, 'investigations_imaging', '410', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(415, 'investigations_imaging', '411', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(416, 'investigations_imaging', '412', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(417, 'investigations_imaging', '413', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(418, 'investigations_imaging', '414', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(419, 'investigations_imaging', '415', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(420, 'investigations_imaging', '416', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(421, 'investigations_imaging', '417', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(422, 'investigations_imaging', '418', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(423, 'investigations_imaging', '419', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(424, 'investigations_imaging', '420', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(425, 'investigations_imaging', '421', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(426, 'investigations_imaging', '422', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(427, 'investigations_imaging', '423', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(428, 'investigations_imaging', '424', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(429, 'investigations_imaging', '425', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(430, 'investigations_imaging', '426', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(431, 'investigations_imaging', '427', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(432, 'investigations_imaging', '428', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(433, 'investigations_imaging', '429', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(434, 'investigations_imaging', '430', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(435, 'investigations_imaging', '431', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(436, 'investigations_imaging', '432', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(437, 'investigations_imaging', '433', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(438, 'investigations_imaging', '434', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(439, 'investigations_imaging', '435', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(440, 'investigations_imaging', '436', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(441, 'investigations_imaging', '437', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(442, 'investigations_imaging', '438', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(443, 'investigations_imaging', '439', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(444, 'investigations_imaging', '440', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(445, 'investigations_imaging', '441', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(446, 'investigations_imaging', '442', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(447, 'investigations_imaging', '443', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(448, 'investigations_imaging', '444', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(449, 'investigations_imaging', '445', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(450, 'investigations_imaging', '446', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(451, 'investigations_imaging', '447', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(452, 'investigations_imaging', '448', 'integer', 'create', '0.00', '57500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(453, 'investigations_imaging', '449', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(454, 'investigations_imaging', '450', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(455, 'investigations_imaging', '451', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(456, 'investigations_imaging', '452', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(457, 'investigations_imaging', '453', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(458, 'investigations_imaging', '454', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(459, 'investigations_imaging', '455', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(460, 'investigations_imaging', '456', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(461, 'investigations_imaging', '457', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(462, 'investigations_imaging', '458', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(463, 'investigations_imaging', '459', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(464, 'investigations_imaging', '460', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(465, 'investigations_imaging', '461', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(466, 'investigations_imaging', '462', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(467, 'investigations_imaging', '463', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(468, 'investigations_imaging', '464', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(469, 'investigations_imaging', '465', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(470, 'investigations_imaging', '466', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(471, 'investigations_imaging', '467', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(472, 'investigations_imaging', '468', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(473, 'investigations_imaging', '469', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(474, 'investigations_imaging', '470', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(475, 'investigations_imaging', '471', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(476, 'investigations_imaging', '472', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(477, 'investigations_imaging', '473', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(478, 'investigations_imaging', '474', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(479, 'investigations_imaging', '475', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(480, 'investigations_imaging', '476', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(481, 'investigations_imaging', '477', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(482, 'investigations_imaging', '478', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(483, 'investigations_imaging', '479', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(484, 'investigations_imaging', '480', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(485, 'investigations_imaging', '481', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(486, 'investigations_imaging', '482', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(487, 'investigations_imaging', '483', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(488, 'investigations_imaging', '484', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(489, 'investigations_imaging', '485', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(490, 'investigations_imaging', '486', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(491, 'investigations_imaging', '487', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(492, 'investigations_imaging', '488', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(493, 'investigations_imaging', '489', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(494, 'investigations_imaging', '490', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(495, 'investigations_imaging', '491', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(496, 'investigations_imaging', '492', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(497, 'investigations_imaging', '493', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(498, 'investigations_imaging', '494', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(499, 'investigations_imaging', '495', 'integer', 'create', '0.00', '6000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(500, 'investigations_imaging', '496', 'integer', 'create', '0.00', '8000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(501, 'investigations_imaging', '497', 'integer', 'create', '0.00', '2000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(502, 'investigations_imaging', '498', 'integer', 'create', '0.00', '4000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(503, 'investigations_imaging', '499', 'integer', 'create', '0.00', '4000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(504, 'investigations_imaging', '500', 'integer', 'create', '0.00', '8000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(505, 'investigations_imaging', '501', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(506, 'investigations_imaging', '502', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(507, 'investigations_imaging', '503', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(508, 'investigations_imaging', '504', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(509, 'investigations_imaging', '505', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(510, 'investigations_imaging', '506', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(511, 'investigations_imaging', '507', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(512, 'investigations_imaging', '508', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(513, 'investigations_imaging', '509', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(514, 'investigations_imaging', '511', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(515, 'investigations_imaging', '512', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(516, 'investigations_imaging', '513', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(517, 'investigations_imaging', '514', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(518, 'investigations_imaging', '515', 'integer', 'create', '0.00', '13000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(519, 'investigations_imaging', '516', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(520, 'investigations_imaging', '517', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(521, 'investigations_imaging', '518', 'integer', 'create', '0.00', '15000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(522, 'investigations_imaging', '519', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(523, 'investigations_imaging', '520', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(524, 'investigations_imaging', '521', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(525, 'investigations_imaging', '522', 'integer', 'create', '0.00', '15000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(526, 'investigations_imaging', '523', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(527, 'investigations_imaging', '524', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(528, 'investigations_imaging', '525', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(529, 'investigations_imaging', '526', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(530, 'investigations_imaging', '527', 'integer', 'create', '0.00', '13000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(531, 'investigations_imaging', '528', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(532, 'investigations_imaging', '529', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(533, 'investigations_imaging', '530', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(534, 'investigations_imaging', '531', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(535, 'investigations_imaging', '532', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(536, 'investigations_imaging', '533', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(537, 'investigations_imaging', '534', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(538, 'investigations_imaging', '535', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(539, 'investigations_imaging', '536', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(540, 'investigations_imaging', '537', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(541, 'investigations_imaging', '538', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(542, 'investigations_imaging', '539', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(543, 'investigations_imaging', '540', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(544, 'investigations_imaging', '541', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(545, 'investigations_imaging', '542', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(546, 'investigations_imaging', '543', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(547, 'investigations_imaging', '544', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(548, 'investigations_imaging', '545', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(549, 'investigations_imaging', '546', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(550, 'investigations_imaging', '547', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(551, 'investigations_imaging', '548', 'integer', 'create', '0.00', '30500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(552, 'investigations_imaging', '549', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(553, 'investigations_imaging', '550', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(554, 'investigations_imaging', '551', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(555, 'investigations_imaging', '552', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(556, 'investigations_imaging', '553', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(557, 'investigations_imaging', '554', 'integer', 'create', '0.00', '26500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(558, 'investigations_imaging', '555', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(559, 'investigations_imaging', '556', 'integer', 'create', '0.00', '20000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(560, 'investigations_imaging', '557', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(561, 'investigations_imaging', '558', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(562, 'investigations_imaging', '559', 'integer', 'create', '0.00', '18000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(563, 'investigations_imaging', '560', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(564, 'investigations_imaging', '561', 'integer', 'create', '0.00', '35000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(565, 'investigations_imaging', '562', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(566, 'investigations_imaging', '563', 'integer', 'create', '0.00', '33000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(567, 'investigations_imaging', '564', 'integer', 'create', '0.00', '31000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(568, 'investigations_imaging', '565', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(569, 'investigations_imaging', '566', 'integer', 'create', '0.00', '29000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(570, 'investigations_imaging', '567', 'integer', 'create', '0.00', '20500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(571, 'investigations_imaging', '568', 'integer', 'create', '0.00', '22500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(572, 'investigations_imaging', '569', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(573, 'investigations_imaging', '570', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(574, 'investigations_imaging', '571', 'integer', 'create', '0.00', '17500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(575, 'investigations_imaging', '572', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(576, 'investigations_imaging', '573', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(577, 'investigations_imaging', '574', 'integer', 'create', '0.00', '15500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(578, 'investigations_imaging', '575', 'integer', 'create', '0.00', '11700.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(579, 'investigation_labs', '1', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(580, 'investigation_labs', '1', 'integer', 'create', '0.00', '16500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(581, 'investigation_labs', '2', 'integer', 'create', '0.00', '2700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(582, 'investigation_labs', '2', 'integer', 'create', '0.00', '3600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(583, 'investigation_labs', '3', 'integer', 'create', '0.00', '7800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(584, 'investigation_labs', '3', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(585, 'investigation_labs', '4', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(586, 'investigation_labs', '4', 'integer', 'create', '0.00', '18150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(587, 'investigation_labs', '5', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(588, 'investigation_labs', '5', 'integer', 'create', '0.00', '18150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(589, 'investigation_labs', '6', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(590, 'investigation_labs', '6', 'integer', 'create', '0.00', '18150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(591, 'investigation_labs', '7', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(592, 'investigation_labs', '7', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(593, 'investigation_labs', '8', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(594, 'investigation_labs', '8', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(595, 'investigation_labs', '9', 'integer', 'create', '0.00', '15600.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(596, 'investigation_labs', '9', 'integer', 'create', '0.00', '23400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(597, 'investigation_labs', '10', 'integer', 'create', '0.00', '7800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(598, 'investigation_labs', '10', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(599, 'investigation_labs', '11', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(600, 'investigation_labs', '11', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(601, 'investigation_labs', '12', 'integer', 'create', '0.00', '15750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(602, 'investigation_labs', '12', 'integer', 'create', '0.00', '16650.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(603, 'investigation_labs', '13', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(604, 'investigation_labs', '13', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(605, 'investigation_labs', '14', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(606, 'investigation_labs', '14', 'integer', 'create', '0.00', '21600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(607, 'investigation_labs', '15', 'integer', 'create', '0.00', '33750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(608, 'investigation_labs', '15', 'integer', 'create', '0.00', '33750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(609, 'investigation_labs', '16', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(610, 'investigation_labs', '16', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(611, 'investigation_labs', '17', 'integer', 'create', '0.00', '17500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(612, 'investigation_labs', '17', 'integer', 'create', '0.00', '17500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(613, 'investigation_labs', '18', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(614, 'investigation_labs', '18', 'integer', 'create', '0.00', '5250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(615, 'investigation_labs', '19', 'integer', 'create', '0.00', '48750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(616, 'investigation_labs', '19', 'integer', 'create', '0.00', '48750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(617, 'investigation_labs', '20', 'integer', 'create', '0.00', '184500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(618, 'investigation_labs', '20', 'integer', 'create', '0.00', '184500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(619, 'investigation_labs', '21', 'integer', 'create', '0.00', '155250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(620, 'investigation_labs', '21', 'integer', 'create', '0.00', '155250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(621, 'investigation_labs', '22', 'integer', 'create', '0.00', '207000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(622, 'investigation_labs', '22', 'integer', 'create', '0.00', '207000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(623, 'investigation_labs', '23', 'integer', 'create', '0.00', '45000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(624, 'investigation_labs', '23', 'integer', 'create', '0.00', '45000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(625, 'investigation_labs', '24', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(626, 'investigation_labs', '24', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(627, 'investigation_labs', '25', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(628, 'investigation_labs', '25', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(629, 'investigation_labs', '26', 'integer', 'create', '0.00', '30000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(630, 'investigation_labs', '26', 'integer', 'create', '0.00', '30000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(631, 'investigation_labs', '27', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(632, 'investigation_labs', '27', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(633, 'investigation_labs', '28', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(634, 'investigation_labs', '28', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(635, 'investigation_labs', '29', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(636, 'investigation_labs', '29', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(637, 'investigation_labs', '30', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(638, 'investigation_labs', '30', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(639, 'investigation_labs', '31', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(640, 'investigation_labs', '31', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(641, 'investigation_labs', '32', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(642, 'investigation_labs', '32', 'integer', 'create', '0.00', '9600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(643, 'investigation_labs', '33', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(644, 'investigation_labs', '33', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(645, 'investigation_labs', '34', 'integer', 'create', '0.00', '13050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(646, 'investigation_labs', '34', 'integer', 'create', '0.00', '13950.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(647, 'investigation_labs', '35', 'integer', 'create', '0.00', '13050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(648, 'investigation_labs', '35', 'integer', 'create', '0.00', '13950.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(649, 'investigation_labs', '36', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(650, 'investigation_labs', '36', 'integer', 'create', '0.00', '13050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(651, 'investigation_labs', '37', 'integer', 'create', '0.00', '30000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(652, 'investigation_labs', '37', 'integer', 'create', '0.00', '30000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(653, 'investigation_labs', '38', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(654, 'investigation_labs', '38', 'integer', 'create', '0.00', '13050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(655, 'investigation_labs', '39', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(656, 'investigation_labs', '39', 'integer', 'create', '0.00', '13050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(657, 'investigation_labs', '40', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(658, 'investigation_labs', '40', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(659, 'investigation_labs', '41', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(660, 'investigation_labs', '41', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(661, 'investigation_labs', '42', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(662, 'investigation_labs', '42', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(663, 'investigation_labs', '43', 'integer', 'create', '0.00', '88500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(664, 'investigation_labs', '43', 'integer', 'create', '0.00', '88500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(665, 'investigation_labs', '44', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(666, 'investigation_labs', '44', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(667, 'investigation_labs', '45', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(668, 'investigation_labs', '45', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(669, 'investigation_labs', '46', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(670, 'investigation_labs', '46', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(671, 'investigation_labs', '47', 'integer', 'create', '0.00', '52500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(672, 'investigation_labs', '47', 'integer', 'create', '0.00', '52500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(673, 'investigation_labs', '48', 'integer', 'create', '0.00', '2700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(674, 'investigation_labs', '48', 'integer', 'create', '0.00', '3600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(675, 'investigation_labs', '49', 'integer', 'create', '0.00', '19050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(676, 'investigation_labs', '49', 'integer', 'create', '0.00', '19050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(677, 'investigation_labs', '50', 'integer', 'create', '0.00', '36300.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(678, 'investigation_labs', '50', 'integer', 'create', '0.00', '36300.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(679, 'investigation_labs', '51', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(680, 'investigation_labs', '51', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(681, 'investigation_labs', '52', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(682, 'investigation_labs', '52', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(683, 'investigation_labs', '53', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(684, 'investigation_labs', '53', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(685, 'investigation_labs', '54', 'integer', 'create', '0.00', '25950.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(686, 'investigation_labs', '54', 'integer', 'create', '0.00', '25950.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(687, 'investigation_labs', '55', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(688, 'investigation_labs', '55', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(689, 'investigation_labs', '56', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(690, 'investigation_labs', '56', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(691, 'investigation_labs', '57', 'integer', 'create', '0.00', '69000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(692, 'investigation_labs', '57', 'integer', 'create', '0.00', '69000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(693, 'investigation_labs', '58', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(694, 'investigation_labs', '58', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(695, 'investigation_labs', '59', 'integer', 'create', '0.00', '9600.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(696, 'investigation_labs', '59', 'integer', 'create', '0.00', '10500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(697, 'investigation_labs', '60', 'integer', 'create', '0.00', '9600.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(698, 'investigation_labs', '60', 'integer', 'create', '0.00', '10500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(699, 'investigation_labs', '61', 'integer', 'create', '0.00', '56100.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(700, 'investigation_labs', '61', 'integer', 'create', '0.00', '58800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(701, 'investigation_labs', '62', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(702, 'investigation_labs', '62', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(703, 'investigation_labs', '63', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(704, 'investigation_labs', '63', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(705, 'investigation_labs', '64', 'integer', 'create', '0.00', '6150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(706, 'investigation_labs', '64', 'integer', 'create', '0.00', '7050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(707, 'investigation_labs', '65', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(708, 'investigation_labs', '65', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(709, 'investigation_labs', '66', 'integer', 'create', '0.00', '16500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(710, 'investigation_labs', '66', 'integer', 'create', '0.00', '17400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(711, 'investigation_labs', '67', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(712, 'investigation_labs', '67', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(713, 'investigation_labs', '68', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(714, 'investigation_labs', '68', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(715, 'investigation_labs', '69', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(716, 'investigation_labs', '69', 'integer', 'create', '0.00', '13050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(717, 'investigation_labs', '70', 'integer', 'create', '0.00', '7800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(718, 'investigation_labs', '70', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(719, 'investigation_labs', '71', 'integer', 'create', '0.00', '7800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(720, 'investigation_labs', '71', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(721, 'investigation_labs', '72', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(722, 'investigation_labs', '72', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(723, 'investigation_labs', '73', 'integer', 'create', '0.00', '15750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(724, 'investigation_labs', '73', 'integer', 'create', '0.00', '16650.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(725, 'investigation_labs', '74', 'integer', 'create', '0.00', '34500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(726, 'investigation_labs', '74', 'integer', 'create', '0.00', '35400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(727, 'investigation_labs', '75', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(728, 'investigation_labs', '75', 'integer', 'create', '0.00', '18150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(729, 'investigation_labs', '76', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(730, 'investigation_labs', '76', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(731, 'investigation_labs', '77', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(732, 'investigation_labs', '77', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(733, 'investigation_labs', '78', 'integer', 'create', '0.00', '34500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(734, 'investigation_labs', '78', 'integer', 'create', '0.00', '34500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(735, 'investigation_labs', '79', 'integer', 'create', '0.00', '11250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(736, 'investigation_labs', '79', 'integer', 'create', '0.00', '12150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(737, 'investigation_labs', '80', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(738, 'investigation_labs', '80', 'integer', 'create', '0.00', '9600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(739, 'investigation_labs', '81', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(740, 'investigation_labs', '81', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(741, 'investigation_labs', '82', 'integer', 'create', '0.00', '34500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(742, 'investigation_labs', '82', 'integer', 'create', '0.00', '34500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(743, 'investigation_labs', '83', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(744, 'investigation_labs', '83', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(745, 'investigation_labs', '84', 'integer', 'create', '0.00', '24150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(746, 'investigation_labs', '84', 'integer', 'create', '0.00', '24150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(747, 'investigation_labs', '85', 'integer', 'create', '0.00', '7800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(748, 'investigation_labs', '85', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(749, 'investigation_labs', '86', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(750, 'investigation_labs', '86', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(751, 'investigation_labs', '87', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(752, 'investigation_labs', '87', 'integer', 'create', '0.00', '11400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(753, 'investigation_labs', '88', 'integer', 'create', '0.00', '7800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(754, 'investigation_labs', '88', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(755, 'investigation_labs', '89', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(756, 'investigation_labs', '89', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(757, 'investigation_labs', '90', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(758, 'investigation_labs', '90', 'integer', 'create', '0.00', '18150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(759, 'investigation_labs', '91', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(760, 'investigation_labs', '91', 'integer', 'create', '0.00', '18150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(761, 'investigation_labs', '92', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(762, 'investigation_labs', '92', 'integer', 'create', '0.00', '11400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(763, 'investigation_labs', '93', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(764, 'investigation_labs', '93', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(765, 'investigation_labs', '94', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(766, 'investigation_labs', '94', 'integer', 'create', '0.00', '19050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(767, 'investigation_labs', '95', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(768, 'investigation_labs', '95', 'integer', 'create', '0.00', '27150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(769, 'investigation_labs', '96', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(770, 'investigation_labs', '96', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(771, 'investigation_labs', '97', 'integer', 'create', '0.00', '9600.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(772, 'investigation_labs', '97', 'integer', 'create', '0.00', '10500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(773, 'investigation_labs', '98', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(774, 'investigation_labs', '98', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(775, 'investigation_labs', '99', 'integer', 'create', '0.00', '15000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(776, 'investigation_labs', '99', 'integer', 'create', '0.00', '15000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(777, 'investigation_labs', '100', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(778, 'investigation_labs', '100', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(779, 'investigation_labs', '101', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(780, 'investigation_labs', '101', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(781, 'investigation_labs', '102', 'integer', 'create', '0.00', '11250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(782, 'investigation_labs', '102', 'integer', 'create', '0.00', '12150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(783, 'investigation_labs', '103', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(784, 'investigation_labs', '103', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(785, 'investigation_labs', '104', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(786, 'investigation_labs', '104', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(787, 'investigation_labs', '105', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(788, 'investigation_labs', '105', 'integer', 'create', '0.00', '12150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(789, 'investigation_labs', '106', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(790, 'investigation_labs', '106', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(791, 'investigation_labs', '107', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(792, 'investigation_labs', '107', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(793, 'investigation_labs', '108', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(794, 'investigation_labs', '108', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(795, 'investigation_labs', '109', 'integer', 'create', '0.00', '0.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(796, 'investigation_labs', '109', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(797, 'investigation_labs', '110', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(798, 'investigation_labs', '110', 'integer', 'create', '0.00', '9600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(799, 'investigation_labs', '111', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(800, 'investigation_labs', '111', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(801, 'investigation_labs', '112', 'integer', 'create', '0.00', '6150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(802, 'investigation_labs', '112', 'integer', 'create', '0.00', '7050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(803, 'investigation_labs', '113', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(804, 'investigation_labs', '113', 'integer', 'create', '0.00', '11400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(805, 'investigation_labs', '114', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(806, 'investigation_labs', '114', 'integer', 'create', '0.00', '31950.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(807, 'investigation_labs', '115', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(808, 'investigation_labs', '115', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(809, 'investigation_labs', '116', 'integer', 'create', '0.00', '48300.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(810, 'investigation_labs', '116', 'integer', 'create', '0.00', '48300.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(811, 'investigation_labs', '117', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(812, 'investigation_labs', '117', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(813, 'investigation_labs', '118', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(814, 'investigation_labs', '118', 'integer', 'create', '0.00', '23400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(815, 'investigation_labs', '119', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(816, 'investigation_labs', '119', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(817, 'investigation_labs', '120', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(818, 'investigation_labs', '120', 'integer', 'create', '0.00', '13050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(819, 'investigation_labs', '121', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(820, 'investigation_labs', '121', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(821, 'investigation_labs', '122', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(822, 'investigation_labs', '122', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(823, 'investigation_labs', '123', 'integer', 'create', '0.00', '45000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(824, 'investigation_labs', '123', 'integer', 'create', '0.00', '45000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(825, 'investigation_labs', '124', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `setup_price_tracking` (`id`, `table_name`, `table_id`, `table_id_type`, `action`, `old_price`, `new_price`, `type`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(826, 'investigation_labs', '124', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(827, 'investigation_labs', '125', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(828, 'investigation_labs', '125', 'integer', 'create', '0.00', '12300.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(829, 'investigation_labs', '126', 'integer', 'create', '0.00', '62250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(830, 'investigation_labs', '126', 'integer', 'create', '0.00', '62250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(831, 'investigation_labs', '127', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(832, 'investigation_labs', '127', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(833, 'investigation_labs', '128', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(834, 'investigation_labs', '128', 'integer', 'create', '0.00', '3450.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(835, 'investigation_labs', '129', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(836, 'investigation_labs', '129', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(837, 'investigation_labs', '130', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(838, 'investigation_labs', '130', 'integer', 'create', '0.00', '10500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(839, 'investigation_labs', '131', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(840, 'investigation_labs', '131', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(841, 'investigation_labs', '132', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(842, 'investigation_labs', '132', 'integer', 'create', '0.00', '13050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(843, 'investigation_labs', '133', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(844, 'investigation_labs', '133', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(845, 'investigation_labs', '134', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(846, 'investigation_labs', '134', 'integer', 'create', '0.00', '13050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(847, 'investigation_labs', '135', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(848, 'investigation_labs', '135', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(849, 'investigation_labs', '136', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(850, 'investigation_labs', '136', 'integer', 'create', '0.00', '11400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(851, 'investigation_labs', '137', 'integer', 'create', '0.00', '3000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(852, 'investigation_labs', '137', 'integer', 'create', '0.00', '3900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(853, 'investigation_labs', '138', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(854, 'investigation_labs', '138', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(855, 'investigation_labs', '139', 'integer', 'create', '0.00', '38250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(856, 'investigation_labs', '139', 'integer', 'create', '0.00', '38250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(857, 'investigation_labs', '140', 'integer', 'create', '0.00', '86250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(858, 'investigation_labs', '140', 'integer', 'create', '0.00', '86250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(859, 'investigation_labs', '141', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(860, 'investigation_labs', '141', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(861, 'investigation_labs', '142', 'integer', 'create', '0.00', '15750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(862, 'investigation_labs', '142', 'integer', 'create', '0.00', '15750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(863, 'investigation_labs', '143', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(864, 'investigation_labs', '143', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(865, 'investigation_labs', '144', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(866, 'investigation_labs', '144', 'integer', 'create', '0.00', '9600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(867, 'investigation_labs', '145', 'integer', 'create', '0.00', '48000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(868, 'investigation_labs', '145', 'integer', 'create', '0.00', '48000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(869, 'investigation_labs', '146', 'integer', 'create', '0.00', '34500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(870, 'investigation_labs', '146', 'integer', 'create', '0.00', '34500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(871, 'investigation_labs', '147', 'integer', 'create', '0.00', '38250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(872, 'investigation_labs', '147', 'integer', 'create', '0.00', '38250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(873, 'investigation_labs', '148', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(874, 'investigation_labs', '148', 'integer', 'create', '0.00', '13800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(875, 'investigation_labs', '149', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(876, 'investigation_labs', '149', 'integer', 'create', '0.00', '10500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(877, 'investigation_labs', '150', 'integer', 'create', '0.00', '4350.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(878, 'investigation_labs', '150', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(879, 'investigation_labs', '151', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(880, 'investigation_labs', '151', 'integer', 'create', '0.00', '16500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(881, 'investigation_labs', '152', 'integer', 'create', '0.00', '2700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(882, 'investigation_labs', '152', 'integer', 'create', '0.00', '3600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(883, 'investigation_labs', '153', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(884, 'investigation_labs', '153', 'integer', 'create', '0.00', '20700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(885, 'investigation_labs', '154', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(886, 'investigation_labs', '154', 'integer', 'create', '0.00', '20700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(887, 'investigation_labs', '155', 'integer', 'create', '0.00', '34500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(888, 'investigation_labs', '155', 'integer', 'create', '0.00', '34500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(889, 'investigation_labs', '156', 'integer', 'create', '0.00', '13050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(890, 'investigation_labs', '156', 'integer', 'create', '0.00', '13050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(891, 'investigation_labs', '157', 'integer', 'create', '0.00', '52500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(892, 'investigation_labs', '157', 'integer', 'create', '0.00', '52500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(893, 'investigation_labs', '158', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(894, 'investigation_labs', '158', 'integer', 'create', '0.00', '11400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(895, 'investigation_labs', '159', 'integer', 'create', '0.00', '15750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(896, 'investigation_labs', '159', 'integer', 'create', '0.00', '16650.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(897, 'investigation_labs', '160', 'integer', 'create', '0.00', '6150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(898, 'investigation_labs', '160', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(899, 'investigation_labs', '161', 'integer', 'create', '0.00', '11250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(900, 'investigation_labs', '161', 'integer', 'create', '0.00', '11250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(901, 'investigation_labs', '162', 'integer', 'create', '0.00', '2700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(902, 'investigation_labs', '162', 'integer', 'create', '0.00', '3600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(903, 'investigation_labs', '163', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(904, 'investigation_labs', '163', 'integer', 'create', '0.00', '21600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(905, 'investigation_labs', '164', 'integer', 'create', '0.00', '6150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(906, 'investigation_labs', '164', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(907, 'investigation_labs', '165', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(908, 'investigation_labs', '165', 'integer', 'create', '0.00', '11400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(909, 'investigation_labs', '166', 'integer', 'create', '0.00', '2700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(910, 'investigation_labs', '166', 'integer', 'create', '0.00', '4500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(911, 'investigation_labs', '167', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(912, 'investigation_labs', '167', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(913, 'investigation_labs', '168', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(914, 'investigation_labs', '168', 'integer', 'create', '0.00', '12300.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(915, 'investigation_labs', '169', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(916, 'investigation_labs', '169', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(917, 'investigation_labs', '170', 'integer', 'create', '0.00', '124200.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(918, 'investigation_labs', '170', 'integer', 'create', '0.00', '124200.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(919, 'investigation_labs', '171', 'integer', 'create', '0.00', '124200.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(920, 'investigation_labs', '171', 'integer', 'create', '0.00', '124200.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(921, 'investigation_labs', '172', 'integer', 'create', '0.00', '7800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(922, 'investigation_labs', '172', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(923, 'investigation_labs', '173', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(924, 'investigation_labs', '173', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(925, 'investigation_labs', '174', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(926, 'investigation_labs', '174', 'integer', 'create', '0.00', '12300.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(927, 'investigation_labs', '175', 'integer', 'create', '0.00', '3000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(928, 'investigation_labs', '175', 'integer', 'create', '0.00', '3900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(929, 'investigation_labs', '176', 'integer', 'create', '0.00', '112500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(930, 'investigation_labs', '176', 'integer', 'create', '0.00', '112500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(931, 'investigation_labs', '177', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(932, 'investigation_labs', '177', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(933, 'investigation_labs', '178', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(934, 'investigation_labs', '178', 'integer', 'create', '0.00', '10500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(935, 'investigation_labs', '179', 'integer', 'create', '0.00', '37500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(936, 'investigation_labs', '179', 'integer', 'create', '0.00', '37500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(937, 'investigation_labs', '180', 'integer', 'create', '0.00', '52500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(938, 'investigation_labs', '180', 'integer', 'create', '0.00', '52500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(939, 'investigation_labs', '181', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(940, 'investigation_labs', '181', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(941, 'investigation_labs', '182', 'integer', 'create', '0.00', '150000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(942, 'investigation_labs', '182', 'integer', 'create', '0.00', '150000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(943, 'investigation_labs', '183', 'integer', 'create', '0.00', '57000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(944, 'investigation_labs', '183', 'integer', 'create', '0.00', '57000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(945, 'investigation_labs', '184', 'integer', 'create', '0.00', '90000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(946, 'investigation_labs', '184', 'integer', 'create', '0.00', '90000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(947, 'investigation_labs', '185', 'integer', 'create', '0.00', '15000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(948, 'investigation_labs', '185', 'integer', 'create', '0.00', '15000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(949, 'investigation_labs', '186', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(950, 'investigation_labs', '186', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(951, 'investigation_labs', '187', 'integer', 'create', '0.00', '30000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(952, 'investigation_labs', '187', 'integer', 'create', '0.00', '30000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(953, 'investigation_labs', '188', 'integer', 'create', '0.00', '52500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(954, 'investigation_labs', '188', 'integer', 'create', '0.00', '52500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(955, 'investigation_labs', '189', 'integer', 'create', '0.00', '75000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(956, 'investigation_labs', '189', 'integer', 'create', '0.00', '75000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(957, 'investigation_labs', '190', 'integer', 'create', '0.00', '57000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(958, 'investigation_labs', '190', 'integer', 'create', '0.00', '57000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(959, 'investigation_labs', '191', 'integer', 'create', '0.00', '37950.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(960, 'investigation_labs', '191', 'integer', 'create', '0.00', '37950.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(961, 'investigation_labs', '192', 'integer', 'create', '0.00', '9000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(962, 'investigation_labs', '192', 'integer', 'create', '0.00', '9000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(963, 'investigation_labs', '193', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(964, 'investigation_labs', '193', 'integer', 'create', '0.00', '10500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(965, 'investigation_labs', '194', 'integer', 'create', '0.00', '24000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(966, 'investigation_labs', '194', 'integer', 'create', '0.00', '24000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(967, 'investigation_labs', '195', 'integer', 'create', '0.00', '24000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(968, 'investigation_labs', '195', 'integer', 'create', '0.00', '24000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(969, 'investigation_labs', '196', 'integer', 'create', '0.00', '9000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(970, 'investigation_labs', '196', 'integer', 'create', '0.00', '9000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(971, 'investigation_labs', '197', 'integer', 'create', '0.00', '34500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(972, 'investigation_labs', '197', 'integer', 'create', '0.00', '34500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(973, 'investigation_labs', '198', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(974, 'investigation_labs', '198', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(975, 'investigation_labs', '199', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(976, 'investigation_labs', '199', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(977, 'investigation_labs', '200', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(978, 'investigation_labs', '200', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(979, 'investigation_labs', '201', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(980, 'investigation_labs', '201', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(981, 'investigation_labs', '202', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(982, 'investigation_labs', '202', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(983, 'investigation_labs', '203', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(984, 'investigation_labs', '203', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(985, 'investigation_labs', '204', 'integer', 'create', '0.00', '75900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(986, 'investigation_labs', '204', 'integer', 'create', '0.00', '75900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(987, 'investigation_labs', '205', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(988, 'investigation_labs', '205', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(989, 'investigation_labs', '206', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(990, 'investigation_labs', '206', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(991, 'investigation_labs', '207', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(992, 'investigation_labs', '207', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(993, 'investigation_labs', '208', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(994, 'investigation_labs', '208', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(995, 'investigation_labs', '209', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(996, 'investigation_labs', '209', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(997, 'investigation_labs', '210', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(998, 'investigation_labs', '210', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(999, 'investigation_labs', '211', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1000, 'investigation_labs', '211', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1001, 'investigation_labs', '212', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1002, 'investigation_labs', '212', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1003, 'investigation_labs', '213', 'integer', 'create', '0.00', '43500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1004, 'investigation_labs', '213', 'integer', 'create', '0.00', '43500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1005, 'investigation_labs', '214', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1006, 'investigation_labs', '214', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1007, 'investigation_labs', '215', 'integer', 'create', '0.00', '43500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1008, 'investigation_labs', '215', 'integer', 'create', '0.00', '43500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1009, 'investigation_labs', '216', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1010, 'investigation_labs', '216', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1011, 'investigation_labs', '217', 'integer', 'create', '0.00', '15750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1012, 'investigation_labs', '217', 'integer', 'create', '0.00', '16650.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1013, 'investigation_labs', '218', 'integer', 'create', '0.00', '31500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1014, 'investigation_labs', '218', 'integer', 'create', '0.00', '31500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1015, 'investigation_labs', '219', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1016, 'investigation_labs', '219', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1017, 'investigation_labs', '220', 'integer', 'create', '0.00', '20700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1018, 'investigation_labs', '220', 'integer', 'create', '0.00', '21600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1019, 'investigation_labs', '221', 'integer', 'create', '0.00', '87000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1020, 'investigation_labs', '221', 'integer', 'create', '0.00', '87000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1021, 'investigation_labs', '222', 'integer', 'create', '0.00', '87000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1022, 'investigation_labs', '222', 'integer', 'create', '0.00', '87000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1023, 'investigation_labs', '223', 'integer', 'create', '0.00', '87000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1024, 'investigation_labs', '223', 'integer', 'create', '0.00', '87000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1025, 'investigation_labs', '224', 'integer', 'create', '0.00', '60750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1026, 'investigation_labs', '224', 'integer', 'create', '0.00', '60750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1027, 'investigation_labs', '225', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1028, 'investigation_labs', '225', 'integer', 'create', '0.00', '15600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1029, 'investigation_labs', '226', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1030, 'investigation_labs', '226', 'integer', 'create', '0.00', '15600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1031, 'investigation_labs', '227', 'integer', 'create', '0.00', '30000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1032, 'investigation_labs', '227', 'integer', 'create', '0.00', '30000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1033, 'investigation_labs', '228', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1034, 'investigation_labs', '228', 'integer', 'create', '0.00', '23400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1035, 'investigation_labs', '229', 'integer', 'create', '0.00', '30000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1036, 'investigation_labs', '229', 'integer', 'create', '0.00', '30000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1037, 'investigation_labs', '230', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1038, 'investigation_labs', '230', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1039, 'investigation_labs', '231', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1040, 'investigation_labs', '231', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1041, 'investigation_labs', '232', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1042, 'investigation_labs', '232', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1043, 'investigation_labs', '233', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1044, 'investigation_labs', '233', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1045, 'investigation_labs', '234', 'integer', 'create', '0.00', '11250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1046, 'investigation_labs', '234', 'integer', 'create', '0.00', '12150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1047, 'investigation_labs', '235', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1048, 'investigation_labs', '235', 'integer', 'create', '0.00', '27150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1049, 'investigation_labs', '236', 'integer', 'create', '0.00', '9000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1050, 'investigation_labs', '236', 'integer', 'create', '0.00', '9900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1051, 'investigation_labs', '237', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1052, 'investigation_labs', '237', 'integer', 'create', '0.00', '23400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1053, 'investigation_labs', '238', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1054, 'investigation_labs', '238', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1055, 'investigation_labs', '239', 'integer', 'create', '0.00', '12000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1056, 'investigation_labs', '239', 'integer', 'create', '0.00', '12900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1057, 'investigation_labs', '240', 'integer', 'create', '0.00', '26850.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1058, 'investigation_labs', '240', 'integer', 'create', '0.00', '26850.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1059, 'investigation_labs', '241', 'integer', 'create', '0.00', '18000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1060, 'investigation_labs', '241', 'integer', 'create', '0.00', '18000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1061, 'investigation_labs', '242', 'integer', 'create', '0.00', '12750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1062, 'investigation_labs', '242', 'integer', 'create', '0.00', '13650.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1063, 'investigation_labs', '243', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1064, 'investigation_labs', '243', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1065, 'investigation_labs', '244', 'integer', 'create', '0.00', '24150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1066, 'investigation_labs', '244', 'integer', 'create', '0.00', '24150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1067, 'investigation_labs', '245', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1068, 'investigation_labs', '245', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1069, 'investigation_labs', '246', 'integer', 'create', '0.00', '36300.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1070, 'investigation_labs', '246', 'integer', 'create', '0.00', '36300.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1071, 'investigation_labs', '247', 'integer', 'create', '0.00', '41400.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1072, 'investigation_labs', '247', 'integer', 'create', '0.00', '41400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1073, 'investigation_labs', '248', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1074, 'investigation_labs', '248', 'integer', 'create', '0.00', '15600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1075, 'investigation_labs', '249', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1076, 'investigation_labs', '249', 'integer', 'create', '0.00', '18150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1077, 'investigation_labs', '250', 'integer', 'create', '0.00', '45000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1078, 'investigation_labs', '250', 'integer', 'create', '0.00', '45000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1079, 'investigation_labs', '251', 'integer', 'create', '0.00', '60000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1080, 'investigation_labs', '251', 'integer', 'create', '0.00', '60000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1081, 'investigation_labs', '252', 'integer', 'create', '0.00', '52500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1082, 'investigation_labs', '252', 'integer', 'create', '0.00', '52500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1083, 'investigation_labs', '253', 'integer', 'create', '0.00', '178500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1084, 'investigation_labs', '253', 'integer', 'create', '0.00', '178500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1085, 'investigation_labs', '254', 'integer', 'create', '0.00', '52500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1086, 'investigation_labs', '254', 'integer', 'create', '0.00', '52500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1087, 'investigation_labs', '255', 'integer', 'create', '0.00', '97500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1088, 'investigation_labs', '255', 'integer', 'create', '0.00', '97500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1089, 'investigation_labs', '256', 'integer', 'create', '0.00', '27000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1090, 'investigation_labs', '256', 'integer', 'create', '0.00', '27000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1091, 'investigation_labs', '257', 'integer', 'create', '0.00', '75000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1092, 'investigation_labs', '257', 'integer', 'create', '0.00', '75000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1093, 'investigation_labs', '258', 'integer', 'create', '0.00', '82500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1094, 'investigation_labs', '258', 'integer', 'create', '0.00', '82500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1095, 'investigation_labs', '259', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1096, 'investigation_labs', '259', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1097, 'investigation_labs', '260', 'integer', 'create', '0.00', '45000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1098, 'investigation_labs', '260', 'integer', 'create', '0.00', '45000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1099, 'investigation_labs', '261', 'integer', 'create', '0.00', '45000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1100, 'investigation_labs', '261', 'integer', 'create', '0.00', '45000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1101, 'investigation_labs', '262', 'integer', 'create', '0.00', '73500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1102, 'investigation_labs', '262', 'integer', 'create', '0.00', '73500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1103, 'investigation_labs', '263', 'integer', 'create', '0.00', '43200.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1104, 'investigation_labs', '263', 'integer', 'create', '0.00', '43200.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1105, 'investigation_labs', '264', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1106, 'investigation_labs', '264', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1107, 'investigation_labs', '265', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1108, 'investigation_labs', '265', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1109, 'investigation_labs', '266', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1110, 'investigation_labs', '266', 'integer', 'create', '0.00', '9600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1111, 'investigation_labs', '267', 'integer', 'create', '0.00', '78000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1112, 'investigation_labs', '267', 'integer', 'create', '0.00', '78000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1113, 'investigation_labs', '268', 'integer', 'create', '0.00', '75000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1114, 'investigation_labs', '268', 'integer', 'create', '0.00', '75000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1115, 'investigation_labs', '269', 'integer', 'create', '0.00', '78000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1116, 'investigation_labs', '269', 'integer', 'create', '0.00', '78000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1117, 'investigation_labs', '270', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1118, 'investigation_labs', '270', 'integer', 'create', '0.00', '11400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1119, 'investigation_labs', '271', 'integer', 'create', '0.00', '2700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1120, 'investigation_labs', '271', 'integer', 'create', '0.00', '3600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1121, 'investigation_labs', '272', 'integer', 'create', '0.00', '7500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1122, 'investigation_labs', '272', 'integer', 'create', '0.00', '8400.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1123, 'investigation_labs', '273', 'integer', 'create', '0.00', '213900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1124, 'investigation_labs', '273', 'integer', 'create', '0.00', '213900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1125, 'investigation_labs', '274', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1126, 'investigation_labs', '274', 'integer', 'create', '0.00', '9600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1127, 'investigation_labs', '275', 'integer', 'create', '0.00', '90000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1128, 'investigation_labs', '275', 'integer', 'create', '0.00', '90000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1129, 'investigation_labs', '276', 'integer', 'create', '0.00', '75000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1130, 'investigation_labs', '276', 'integer', 'create', '0.00', '75000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1131, 'investigation_labs', '277', 'integer', 'create', '0.00', '7500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1132, 'investigation_labs', '277', 'integer', 'create', '0.00', '7500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1133, 'investigation_labs', '278', 'integer', 'create', '0.00', '14250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1134, 'investigation_labs', '278', 'integer', 'create', '0.00', '14250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1135, 'investigation_labs', '279', 'integer', 'create', '0.00', '48750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1136, 'investigation_labs', '279', 'integer', 'create', '0.00', '48750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1137, 'investigation_labs', '280', 'integer', 'create', '0.00', '27000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1138, 'investigation_labs', '280', 'integer', 'create', '0.00', '27000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1139, 'investigation_labs', '281', 'integer', 'create', '0.00', '750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1140, 'investigation_labs', '281', 'integer', 'create', '0.00', '750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1141, 'investigation_labs', '282', 'integer', 'create', '0.00', '750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1142, 'investigation_labs', '282', 'integer', 'create', '0.00', '750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1143, 'investigation_labs', '283', 'integer', 'create', '0.00', '300.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1144, 'investigation_labs', '283', 'integer', 'create', '0.00', '300.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1145, 'investigation_labs', '284', 'integer', 'create', '0.00', '3000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1146, 'investigation_labs', '284', 'integer', 'create', '0.00', '3000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1147, 'investigation_labs', '285', 'integer', 'create', '0.00', '900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1148, 'investigation_labs', '285', 'integer', 'create', '0.00', '900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1149, 'investigation_labs', '286', 'integer', 'create', '0.00', '1500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1150, 'investigation_labs', '286', 'integer', 'create', '0.00', '1500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1151, 'investigation_labs', '287', 'integer', 'create', '0.00', '3000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1152, 'investigation_labs', '287', 'integer', 'create', '0.00', '3000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1153, 'investigation_labs', '288', 'integer', 'create', '0.00', '15000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1154, 'investigation_labs', '288', 'integer', 'create', '0.00', '15000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1155, 'investigation_labs', '289', 'integer', 'create', '0.00', '3000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1156, 'investigation_labs', '289', 'integer', 'create', '0.00', '3000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1157, 'investigation_labs', '290', 'integer', 'create', '0.00', '450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1158, 'investigation_labs', '290', 'integer', 'create', '0.00', '450.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1159, 'investigation_labs', '291', 'integer', 'create', '0.00', '30000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1160, 'investigation_labs', '291', 'integer', 'create', '0.00', '30000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1161, 'investigation_labs', '292', 'integer', 'create', '0.00', '15000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1162, 'investigation_labs', '292', 'integer', 'create', '0.00', '15000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1163, 'investigation_labs', '293', 'integer', 'create', '0.00', '750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1164, 'investigation_labs', '293', 'integer', 'create', '0.00', '750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1165, 'investigation_labs', '294', 'integer', 'create', '0.00', '1500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1166, 'investigation_labs', '294', 'integer', 'create', '0.00', '1500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1167, 'investigation_labs', '295', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1168, 'investigation_labs', '295', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1169, 'investigation_labs', '296', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1170, 'investigation_labs', '296', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1171, 'investigation_labs', '297', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1172, 'investigation_labs', '297', 'integer', 'create', '0.00', '13800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1173, 'investigation_labs', '298', 'integer', 'create', '0.00', '33750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1174, 'investigation_labs', '298', 'integer', 'create', '0.00', '33750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1175, 'investigation_labs', '299', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1176, 'investigation_labs', '299', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1177, 'investigation_labs', '300', 'integer', 'create', '0.00', '33750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1178, 'investigation_labs', '300', 'integer', 'create', '0.00', '33750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1179, 'investigation_labs', '301', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1180, 'investigation_labs', '301', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1181, 'investigation_labs', '302', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1182, 'investigation_labs', '302', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1183, 'investigation_labs', '303', 'integer', 'create', '0.00', '42000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1184, 'investigation_labs', '303', 'integer', 'create', '0.00', '42000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1185, 'investigation_labs', '304', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1186, 'investigation_labs', '304', 'integer', 'create', '0.00', '15600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1187, 'investigation_labs', '305', 'integer', 'create', '0.00', '11250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1188, 'investigation_labs', '305', 'integer', 'create', '0.00', '12150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1189, 'investigation_labs', '306', 'integer', 'create', '0.00', '46500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1190, 'investigation_labs', '306', 'integer', 'create', '0.00', '46500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1191, 'investigation_labs', '307', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1192, 'investigation_labs', '307', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1193, 'investigation_labs', '308', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1194, 'investigation_labs', '308', 'integer', 'create', '0.00', '9600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1195, 'investigation_labs', '309', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1196, 'investigation_labs', '309', 'integer', 'create', '0.00', '5250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1197, 'investigation_labs', '310', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1198, 'investigation_labs', '310', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1199, 'investigation_labs', '311', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1200, 'investigation_labs', '311', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1201, 'investigation_labs', '312', 'integer', 'create', '0.00', '11250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1202, 'investigation_labs', '312', 'integer', 'create', '0.00', '12150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1203, 'investigation_labs', '313', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1204, 'investigation_labs', '313', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1205, 'investigation_labs', '314', 'integer', 'create', '0.00', '54000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1206, 'investigation_labs', '314', 'integer', 'create', '0.00', '54000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1207, 'investigation_labs', '315', 'integer', 'create', '0.00', '54000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1208, 'investigation_labs', '315', 'integer', 'create', '0.00', '54000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1209, 'investigation_labs', '316', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1210, 'investigation_labs', '316', 'integer', 'create', '0.00', '13800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1211, 'investigation_labs', '317', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1212, 'investigation_labs', '317', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1213, 'investigation_labs', '318', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1214, 'investigation_labs', '318', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1215, 'investigation_labs', '319', 'integer', 'create', '0.00', '6000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1216, 'investigation_labs', '319', 'integer', 'create', '0.00', '6900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1217, 'investigation_labs', '320', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1218, 'investigation_labs', '320', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1219, 'investigation_labs', '321', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1220, 'investigation_labs', '321', 'integer', 'create', '0.00', '9600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1221, 'investigation_labs', '322', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1222, 'investigation_labs', '322', 'integer', 'create', '0.00', '0.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1223, 'investigation_labs', '323', 'integer', 'create', '0.00', '6000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1224, 'investigation_labs', '323', 'integer', 'create', '0.00', '6900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1225, 'investigation_labs', '324', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1226, 'investigation_labs', '324', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1227, 'investigation_labs', '325', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1228, 'investigation_labs', '325', 'integer', 'create', '0.00', '18150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1229, 'investigation_labs', '326', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1230, 'investigation_labs', '326', 'integer', 'create', '0.00', '13050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1231, 'investigation_labs', '327', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1232, 'investigation_labs', '327', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1233, 'investigation_labs', '328', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `setup_price_tracking` (`id`, `table_name`, `table_id`, `table_id_type`, `action`, `old_price`, `new_price`, `type`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1234, 'investigation_labs', '328', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1235, 'investigation_labs', '329', 'integer', 'create', '0.00', '13050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1236, 'investigation_labs', '329', 'integer', 'create', '0.00', '13950.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1237, 'investigation_labs', '330', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1238, 'investigation_labs', '330', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1239, 'investigation_labs', '331', 'integer', 'create', '0.00', '18000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1240, 'investigation_labs', '331', 'integer', 'create', '0.00', '18000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1241, 'investigation_labs', '332', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1242, 'investigation_labs', '332', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1243, 'investigation_labs', '333', 'integer', 'create', '0.00', '37500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1244, 'investigation_labs', '333', 'integer', 'create', '0.00', '37500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1245, 'investigation_labs', '334', 'integer', 'create', '0.00', '60000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1246, 'investigation_labs', '334', 'integer', 'create', '0.00', '60000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1247, 'investigation_labs', '335', 'integer', 'create', '0.00', '48000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1248, 'investigation_labs', '335', 'integer', 'create', '0.00', '48000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1249, 'investigation_labs', '336', 'integer', 'create', '0.00', '60000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1250, 'investigation_labs', '336', 'integer', 'create', '0.00', '60000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1251, 'investigation_labs', '337', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1252, 'investigation_labs', '337', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1253, 'investigation_labs', '338', 'integer', 'create', '0.00', '6150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1254, 'investigation_labs', '338', 'integer', 'create', '0.00', '7050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1255, 'investigation_labs', '339', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1256, 'investigation_labs', '339', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1257, 'investigation_labs', '340', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1258, 'investigation_labs', '340', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1259, 'investigation_labs', '341', 'integer', 'create', '0.00', '169050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1260, 'investigation_labs', '341', 'integer', 'create', '0.00', '169050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1261, 'investigation_labs', '342', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1262, 'investigation_labs', '342', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1263, 'investigation_labs', '343', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1264, 'investigation_labs', '343', 'integer', 'create', '0.00', '9600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1265, 'investigation_labs', '344', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1266, 'investigation_labs', '344', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1267, 'investigation_labs', '345', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1268, 'investigation_labs', '345', 'integer', 'create', '0.00', '15600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1269, 'investigation_labs', '346', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1270, 'investigation_labs', '346', 'integer', 'create', '0.00', '13050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1271, 'investigation_labs', '347', 'integer', 'create', '0.00', '12150.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1272, 'investigation_labs', '347', 'integer', 'create', '0.00', '12150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1273, 'investigation_labs', '348', 'integer', 'create', '0.00', '6900.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1274, 'investigation_labs', '348', 'integer', 'create', '0.00', '7800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1275, 'investigation_labs', '349', 'integer', 'create', '0.00', '6000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1276, 'investigation_labs', '349', 'integer', 'create', '0.00', '6900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1277, 'investigation_labs', '350', 'integer', 'create', '0.00', '15750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1278, 'investigation_labs', '350', 'integer', 'create', '0.00', '15750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1279, 'investigation_labs', '351', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1280, 'investigation_labs', '351', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1281, 'investigation_labs', '352', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1282, 'investigation_labs', '352', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1283, 'investigation_labs', '353', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1284, 'investigation_labs', '353', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1285, 'investigation_labs', '354', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1286, 'investigation_labs', '354', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1287, 'investigation_labs', '355', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1288, 'investigation_labs', '355', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1289, 'investigation_labs', '356', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1290, 'investigation_labs', '356', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1291, 'investigation_labs', '357', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1292, 'investigation_labs', '357', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1293, 'investigation_labs', '358', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1294, 'investigation_labs', '358', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1295, 'investigation_labs', '359', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1296, 'investigation_labs', '359', 'integer', 'create', '0.00', '15600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1297, 'investigation_labs', '360', 'integer', 'create', '0.00', '14700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1298, 'investigation_labs', '360', 'integer', 'create', '0.00', '15600.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1299, 'investigation_labs', '361', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1300, 'investigation_labs', '361', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1301, 'investigation_labs', '362', 'integer', 'create', '0.00', '6000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1302, 'investigation_labs', '362', 'integer', 'create', '0.00', '6000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1303, 'investigation_labs', '363', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1304, 'investigation_labs', '363', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1305, 'investigation_labs', '364', 'integer', 'create', '0.00', '6000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1306, 'investigation_labs', '364', 'integer', 'create', '0.00', '6900.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1307, 'investigation_labs', '365', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1308, 'investigation_labs', '365', 'integer', 'create', '0.00', '14700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1309, 'investigation_labs', '366', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1310, 'investigation_labs', '366', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1311, 'investigation_labs', '367', 'integer', 'create', '0.00', '9750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1312, 'investigation_labs', '367', 'integer', 'create', '0.00', '9750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1313, 'investigation_labs', '368', 'integer', 'create', '0.00', '8700.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1314, 'investigation_labs', '368', 'integer', 'create', '0.00', '8700.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1315, 'investigation_labs', '369', 'integer', 'create', '0.00', '6000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1316, 'investigation_labs', '369', 'integer', 'create', '0.00', '6450.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1317, 'investigation_labs', '370', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1318, 'investigation_labs', '370', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1319, 'investigation_labs', '371', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1320, 'investigation_labs', '371', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1321, 'investigation_labs', '372', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1322, 'investigation_labs', '372', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1323, 'investigation_labs', '373', 'integer', 'create', '0.00', '5250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1324, 'investigation_labs', '373', 'integer', 'create', '0.00', '6150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1325, 'investigation_labs', '374', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1326, 'investigation_labs', '374', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1327, 'investigation_labs', '375', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1328, 'investigation_labs', '375', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1329, 'investigation_labs', '376', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1330, 'investigation_labs', '376', 'integer', 'create', '0.00', '5250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1331, 'investigation_labs', '377', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1332, 'investigation_labs', '377', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1333, 'investigation_labs', '378', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1334, 'investigation_labs', '378', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1335, 'investigation_labs', '379', 'integer', 'create', '0.00', '3450.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1336, 'investigation_labs', '379', 'integer', 'create', '0.00', '4350.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1337, 'investigation_labs', '380', 'integer', 'create', '0.00', '13800.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1338, 'investigation_labs', '380', 'integer', 'create', '0.00', '13800.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1339, 'investigation_labs', '381', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1340, 'investigation_labs', '381', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1341, 'investigation_labs', '382', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1342, 'investigation_labs', '382', 'integer', 'create', '0.00', '10500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1343, 'investigation_labs', '383', 'integer', 'create', '0.00', '18000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1344, 'investigation_labs', '383', 'integer', 'create', '0.00', '18000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1345, 'investigation_labs', '384', 'integer', 'create', '0.00', '18000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1346, 'investigation_labs', '384', 'integer', 'create', '0.00', '18000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1347, 'investigation_labs', '385', 'integer', 'create', '0.00', '18000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1348, 'investigation_labs', '385', 'integer', 'create', '0.00', '18000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1349, 'investigation_labs', '386', 'integer', 'create', '0.00', '51750.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1350, 'investigation_labs', '386', 'integer', 'create', '0.00', '51750.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1351, 'investigation_labs', '387', 'integer', 'create', '0.00', '52500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1352, 'investigation_labs', '387', 'integer', 'create', '0.00', '52500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1353, 'investigation_labs', '388', 'integer', 'create', '0.00', '60000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1354, 'investigation_labs', '388', 'integer', 'create', '0.00', '60000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1355, 'investigation_labs', '389', 'integer', 'create', '0.00', '60000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1356, 'investigation_labs', '389', 'integer', 'create', '0.00', '60000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1357, 'investigation_labs', '390', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1358, 'investigation_labs', '390', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1359, 'investigation_labs', '391', 'integer', 'create', '0.00', '127500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1360, 'investigation_labs', '391', 'integer', 'create', '0.00', '127500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1361, 'investigation_labs', '392', 'integer', 'create', '0.00', '273000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1362, 'investigation_labs', '392', 'integer', 'create', '0.00', '273000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1363, 'investigation_labs', '393', 'integer', 'create', '0.00', '22500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1364, 'investigation_labs', '393', 'integer', 'create', '0.00', '22500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1365, 'investigation_labs', '394', 'integer', 'create', '0.00', '10500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1366, 'investigation_labs', '394', 'integer', 'create', '0.00', '10500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1367, 'investigation_labs', '395', 'integer', 'create', '0.00', '82500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1368, 'investigation_labs', '395', 'integer', 'create', '0.00', '82500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1369, 'investigation_labs', '396', 'integer', 'create', '0.00', '90000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1370, 'investigation_labs', '396', 'integer', 'create', '0.00', '90000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1371, 'investigation_labs', '397', 'integer', 'create', '0.00', '315000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1372, 'investigation_labs', '397', 'integer', 'create', '0.00', '315000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1373, 'investigation_labs', '398', 'integer', 'create', '0.00', '18000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1374, 'investigation_labs', '398', 'integer', 'create', '0.00', '18000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1375, 'investigation_labs', '399', 'integer', 'create', '0.00', '75000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1376, 'investigation_labs', '399', 'integer', 'create', '0.00', '75000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1377, 'investigation_labs', '400', 'integer', 'create', '0.00', '247500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1378, 'investigation_labs', '400', 'integer', 'create', '0.00', '247500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1379, 'investigation_labs', '401', 'integer', 'create', '0.00', '4500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1380, 'investigation_labs', '401', 'integer', 'create', '0.00', '4500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1381, 'investigation_labs', '402', 'integer', 'create', '0.00', '52500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1382, 'investigation_labs', '402', 'integer', 'create', '0.00', '52500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1383, 'investigation_labs', '403', 'integer', 'create', '0.00', '18000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1384, 'investigation_labs', '403', 'integer', 'create', '0.00', '18000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1385, 'investigation_labs', '404', 'integer', 'create', '0.00', '34500.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1386, 'investigation_labs', '404', 'integer', 'create', '0.00', '34500.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1387, 'investigation_labs', '405', 'integer', 'create', '0.00', '9000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1388, 'investigation_labs', '405', 'integer', 'create', '0.00', '9000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1389, 'investigation_labs', '406', 'integer', 'create', '0.00', '9000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1390, 'investigation_labs', '406', 'integer', 'create', '0.00', '9000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1391, 'investigation_labs', '407', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1392, 'investigation_labs', '407', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1393, 'investigation_labs', '408', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1394, 'investigation_labs', '408', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1395, 'investigation_labs', '409', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1396, 'investigation_labs', '409', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1397, 'investigation_labs', '410', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1398, 'investigation_labs', '410', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1399, 'investigation_labs', '411', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1400, 'investigation_labs', '411', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1401, 'investigation_labs', '412', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1402, 'investigation_labs', '412', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1403, 'investigation_labs', '413', 'integer', 'create', '0.00', '17250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1404, 'investigation_labs', '413', 'integer', 'create', '0.00', '17250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1405, 'investigation_labs', '414', 'integer', 'create', '0.00', '57000.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1406, 'investigation_labs', '414', 'integer', 'create', '0.00', '57000.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1407, 'investigation_labs', '415', 'integer', 'create', '0.00', '26250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1408, 'investigation_labs', '415', 'integer', 'create', '0.00', '26250.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1409, 'investigation_labs', '416', 'integer', 'create', '0.00', '29250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1410, 'investigation_labs', '416', 'integer', 'create', '0.00', '30150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1411, 'investigation_labs', '417', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1412, 'investigation_labs', '417', 'integer', 'create', '0.00', '31950.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1413, 'investigation_labs', '418', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1414, 'investigation_labs', '418', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1415, 'investigation_labs', '419', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1416, 'investigation_labs', '419', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1417, 'investigation_labs', '420', 'integer', 'create', '0.00', '29250.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1418, 'investigation_labs', '420', 'integer', 'create', '0.00', '30150.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1419, 'investigation_labs', '421', 'integer', 'create', '0.00', '37950.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1420, 'investigation_labs', '421', 'integer', 'create', '0.00', '37950.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1421, 'investigation_labs', '422', 'integer', 'create', '0.00', '31050.00', 'routine', NULL, NULL, NULL, NULL, NULL, NULL),
(1422, 'investigation_labs', '422', 'integer', 'create', '0.00', '31050.00', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL),
(1423, 'car_type_setup', '1', 'integer', 'create', '0.00', '10000.00', NULL, 'U0001', NULL, NULL, '2017-01-17 11:24:46', NULL, NULL),
(1424, 'car_type_setup', '2', 'integer', 'create', '0.00', '10000.00', NULL, 'U0001', NULL, NULL, '2017-01-17 11:24:52', NULL, NULL),
(1425, 'car_type_setup', '3', 'integer', 'create', '0.00', '10000.00', NULL, 'U0001', NULL, NULL, '2017-01-17 11:24:59', NULL, NULL),
(1426, 'car_type_setup', '4', 'integer', 'create', '0.00', '10000.00', NULL, 'U0001', NULL, NULL, '2017-01-17 11:25:07', NULL, NULL),
(1427, 'car_type_setup', '5', 'integer', 'create', '0.00', '10000.00', NULL, 'U0001', NULL, NULL, '2017-01-17 11:25:15', NULL, NULL),
(1428, 'car_type_setup', '6', 'integer', 'create', '0.00', '5000.00', NULL, 'U0001', NULL, NULL, '2017-01-17 11:25:24', NULL, NULL),
(1429, 'car_type_setup', '7', 'integer', 'create', '0.00', '5000.00', NULL, 'U0001', NULL, NULL, '2017-01-17 11:25:31', NULL, NULL),
(1430, 'car_type_setup', '8', 'integer', 'create', '0.00', '5000.00', NULL, 'U0001', NULL, NULL, '2017-01-17 11:25:37', NULL, NULL),
(1431, 'car_type_setup', '9', 'integer', 'create', '0.00', '5000.00', NULL, 'U0001', NULL, NULL, '2017-01-17 11:25:43', NULL, NULL),
(1432, 'car_type_setup', '10', 'integer', 'create', '0.00', '5000.00', NULL, 'U0001', NULL, NULL, '2017-01-17 11:25:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terminals`
--

CREATE TABLE `terminals` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tablet_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`id`, `tablet_id`, `remark`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('U000', 'backend', 'This is for the backend central server only !', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `townships`
--

CREATE TABLE `townships` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `townships`
--

INSERT INTO `townships` (`id`, `name`, `city_id`, `remark`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ahlon', 1, 'Ahlon Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(2, 'Bahan', 1, 'Bahan Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(3, 'Cocokyun', 1, 'Cocokyun Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(4, 'Dagon Seikkan', 1, 'Dagon Seikkan Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(5, 'Dagon', 1, 'Dagon Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(6, 'Dawbon', 1, 'Dawbon Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(7, 'East Dagon', 1, 'East Dagon Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(8, 'Hlaing', 1, 'Hlaing Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(9, 'Hlaingthaya', 1, 'Hlaingthaya Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(10, 'Hlegu', 1, 'Hlegu Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(11, 'Hmawbi', 1, 'Hmawbi Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(12, 'Htantabin', 1, 'Htantabin Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(13, 'Insein', 1, 'Insein Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(14, 'Kamayut', 1, 'Kamayut Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(15, 'Kawhmu', 1, 'Kawhmu Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(16, 'Kayan', 1, 'Kayan Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(17, 'Kungyangon', 1, 'Kungyangon Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(18, 'Kyauktada', 1, 'Kyauktada Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(19, 'Kyauktan', 1, 'Kyauktan Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(20, 'Kyimyindaing', 1, 'Kyimyindaing Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(21, 'Lanmadaw', 1, 'Lanmadaw Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(22, 'Latha', 1, 'Latha Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(23, 'Mayangon', 1, 'Mayangon Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(24, 'Mingala Taungnyunt', 1, 'Mingala Taungnyunt Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(25, 'Mingaladon', 1, 'Mingaladon Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(26, 'North Dagon', 1, 'North Dagon Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(27, 'North Okkalapa', 1, 'North Okkalapa Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(28, 'Pabedan', 1, 'Pabedan Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(29, 'Pazundaung', 1, 'Pazundaung Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(30, 'Sanchaung', 1, 'Sanchaung Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(31, 'Seikkan', 1, 'Seikkan Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(32, 'Seikkyi Kanaungto', 1, 'Seikkyi Kanaungto Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(33, 'Shwepyitha', 1, 'Shwepyitha Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(34, 'South Dagon', 1, 'South Dagon Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(35, 'South Okkalapa', 1, 'South Okkalapa Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(36, 'Taikkyi', 1, 'Taikkyi Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(37, 'Tamwe', 1, 'Tamwe Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(38, 'Thaketa', 1, 'Thaketa Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(39, 'Thanlyin', 1, 'Thanlyin Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(40, 'Thingangyun', 1, 'Thingangyun Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(41, 'Thongwa', 1, 'Thongwa Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(42, 'Twante', 1, 'Twante Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL),
(43, 'Yankin', 1, 'Yankin Township', 'U0001', 'U0001', NULL, '2016-10-19 17:45:52', '2016-10-19 17:45:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `way_tracking`
--

CREATE TABLE `way_tracking` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departure_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arrival_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `name`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Zone 1', '', 'U0001', 'U0001', NULL, '2017-01-17 11:22:43', '2017-01-17 11:22:43', NULL),
(2, 'Zone 2', '', 'U0001', 'U0001', NULL, '2017-01-17 11:22:58', '2017-01-17 11:22:58', NULL),
(3, 'Zone 3', '', 'U0001', 'U0001', NULL, '2017-01-17 11:23:37', '2017-01-17 11:23:37', NULL),
(4, 'Zone 4', '', 'U0001', 'U0001', NULL, '2017-01-17 11:23:52', '2017-01-17 11:24:00', NULL),
(5, 'Zone 5', '', 'U0001', 'U0001', NULL, '2017-01-17 11:24:12', '2017-01-17 11:24:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zone_detail`
--

CREATE TABLE `zone_detail` (
  `zone_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zone_detail`
--

INSERT INTO `zone_detail` (`zone_id`, `township_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(3, 21),
(3, 22),
(3, 23),
(3, 24),
(3, 25),
(3, 26),
(3, 27),
(3, 28),
(3, 29),
(3, 30),
(4, 31),
(4, 32),
(4, 33),
(4, 34),
(4, 35),
(4, 36),
(4, 37),
(4, 38),
(4, 39),
(4, 40),
(5, 41),
(5, 42),
(5, 43);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergies`
--
ALTER TABLE `allergies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_types`
--
ALTER TABLE `car_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_type_setup`
--
ALTER TABLE `car_type_setup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_type_setup_car_type_id_foreign` (`car_type_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_configs`
--
ALTER TABLE `core_configs`
  ADD PRIMARY KEY (`code`,`type`);

--
-- Indexes for table `core_permissions`
--
ALTER TABLE `core_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_permission_role`
--
ALTER TABLE `core_permission_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `core_permission_role_role_id_permission_id_unique` (`role_id`,`permission_id`),
  ADD KEY `core_permission_role_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `core_roles`
--
ALTER TABLE `core_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_settings`
--
ALTER TABLE `core_settings`
  ADD PRIMARY KEY (`code`,`type`);

--
-- Indexes for table `core_syncs_tables`
--
ALTER TABLE `core_syncs_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_users`
--
ALTER TABLE `core_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `core_users_email_unique` (`email`),
  ADD KEY `core_users_role_id_foreign` (`role_id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enquiries_township_id_foreign` (`township_id`);

--
-- Indexes for table `enquiry_detail`
--
ALTER TABLE `enquiry_detail`
  ADD KEY `enquiry_detail_enquiry_id_foreign` (`enquiry_id`);

--
-- Indexes for table `family_histories`
--
ALTER TABLE `family_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_of_present_illness`
--
ALTER TABLE `history_of_present_illness`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investigations`
--
ALTER TABLE `investigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investigations_imaging`
--
ALTER TABLE `investigations_imaging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investigation_labs`
--
ALTER TABLE `investigation_labs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_tablet_issue`
--
ALTER TABLE `log_tablet_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD KEY `patients_user_id_foreign` (`user_id`),
  ADD KEY `patients_township_id_foreign` (`township_id`);

--
-- Indexes for table `physical_exams`
--
ALTER TABLE `physical_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_township_id_foreign` (`township_id`);

--
-- Indexes for table `schedule_patient_chief_complaint`
--
ALTER TABLE `schedule_patient_chief_complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_patient_vitals`
--
ALTER TABLE `schedule_patient_vitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_patient_vitals_remark`
--
ALTER TABLE `schedule_patient_vitals_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_physical_exams_abdomen_extre_neuro`
--
ALTER TABLE `schedule_physical_exams_abdomen_extre_neuro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_physical_exams_general_pupils_head`
--
ALTER TABLE `schedule_physical_exams_general_pupils_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_physical_exams_heart_lungs`
--
ALTER TABLE `schedule_physical_exams_heart_lungs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_physiotherapy_musculo`
--
ALTER TABLE `schedule_physiotherapy_musculo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_physiotherapy_neuro`
--
ALTER TABLE `schedule_physiotherapy_neuro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_trackings`
--
ALTER TABLE `schedule_trackings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `setup_price_tracking`
--
ALTER TABLE `setup_price_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `townships`
--
ALTER TABLE `townships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `way_tracking`
--
ALTER TABLE `way_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergies`
--
ALTER TABLE `allergies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `car_types`
--
ALTER TABLE `car_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `car_type_setup`
--
ALTER TABLE `car_type_setup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `core_permissions`
--
ALTER TABLE `core_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1024;
--
-- AUTO_INCREMENT for table `core_permission_role`
--
ALTER TABLE `core_permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=412;
--
-- AUTO_INCREMENT for table `core_roles`
--
ALTER TABLE `core_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `core_syncs_tables`
--
ALTER TABLE `core_syncs_tables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `history_of_present_illness`
--
ALTER TABLE `history_of_present_illness`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `investigations`
--
ALTER TABLE `investigations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT for table `investigations_imaging`
--
ALTER TABLE `investigations_imaging`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=576;
--
-- AUTO_INCREMENT for table `investigation_labs`
--
ALTER TABLE `investigation_labs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;
--
-- AUTO_INCREMENT for table `log_tablet_issue`
--
ALTER TABLE `log_tablet_issue`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `physical_exams`
--
ALTER TABLE `physical_exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `setup_price_tracking`
--
ALTER TABLE `setup_price_tracking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1433;
--
-- AUTO_INCREMENT for table `townships`
--
ALTER TABLE `townships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_type_setup`
--
ALTER TABLE `car_type_setup`
  ADD CONSTRAINT `car_type_setup_car_type_id_foreign` FOREIGN KEY (`car_type_id`) REFERENCES `car_types` (`id`);

--
-- Constraints for table `core_permission_role`
--
ALTER TABLE `core_permission_role`
  ADD CONSTRAINT `core_permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `core_permissions` (`id`),
  ADD CONSTRAINT `core_permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `core_roles` (`id`);

--
-- Constraints for table `core_users`
--
ALTER TABLE `core_users`
  ADD CONSTRAINT `core_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `core_roles` (`id`);

--
-- Constraints for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD CONSTRAINT `enquiries_township_id_foreign` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`);

--
-- Constraints for table `enquiry_detail`
--
ALTER TABLE `enquiry_detail`
  ADD CONSTRAINT `enquiry_detail_enquiry_id_foreign` FOREIGN KEY (`enquiry_id`) REFERENCES `enquiries` (`id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_township_id_foreign` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`),
  ADD CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `core_users` (`id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_township_id_foreign` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
