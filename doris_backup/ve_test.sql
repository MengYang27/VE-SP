-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2018 at 10:18 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `at2l5loc_velocity`
--
CREATE DATABASE IF NOT EXISTS `ve_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `ve_test`;

-- --------------------------------------------------------

--
-- Table structure for table `adminmaster`
--

CREATE TABLE `adminmaster` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adminmaster`
--

INSERT INTO `adminmaster` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Soumya Sarkar', 'sujaysahapersonal@gmail.com ', 'sujay123', 'CEefb0KjiftQpUydtyA5JUxWeBUQOmGEjstPiOKcqBFdtmtlkvV052onRTI3', '2018-09-30 07:34:06', '2018-09-30 07:34:06'),
(2, 'ethan', 'ethandzx@gmail.com', 'velocity@2018', NULL, '2018-11-12 06:00:00', NULL),
(3, 'Velocity', 'velocity@velocityenglish.com.au', 'velocity@2018', NULL, '2018-11-13 08:09:08', NULL),
(4, 'Admin', 'admin@velocityenglish.com.au', 'velocity@2018', NULL, '2018-11-13 16:19:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` mediumint(9) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `velocity_city`
--

CREATE TABLE `velocity_city` (
  `city_id` mediumint(9) NOT NULL,
  `country_id` mediumint(9) NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_city`
--

INSERT INTO `velocity_city` (`city_id`, `country_id`, `city`, `status`) VALUES
(1, 1, 'Sydney', 'Y'),
(2, 1, 'Melbourne', 'Y'),
(3, 2, 'Beijing', 'Y'),
(4, 2, 'Shanghai', 'Y'),
(5, 3, 'Others', 'Y'),
(6, 1, 'Canberra', 'Y'),
(7, 1, 'Brisbane', 'Y'),
(8, 1, 'Adelaide', 'Y'),
(9, 1, 'Perth', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_class_master`
--

CREATE TABLE `velocity_class_master` (
  `class_id` smallint(6) NOT NULL,
  `class_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_details` mediumtext COLLATE utf8_unicode_ci,
  `week_day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` mediumint(9) NOT NULL DEFAULT '0',
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_class_master`
--

INSERT INTO `velocity_class_master` (`class_id`, `class_title`, `class_details`, `week_day`, `class_time`, `end_time`, `created_on`, `created_by`, `status`) VALUES
(2, 'Class A', NULL, 'Tuesday, Wednesday', '21:00', '22:00', '2018-11-13 06:24:09', 0, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_country`
--

CREATE TABLE `velocity_country` (
  `country_id` mediumint(9) NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_country`
--

INSERT INTO `velocity_country` (`country_id`, `country`, `country_code`, `status`) VALUES
(1, 'Australia', 'AUS', 'Y'),
(2, 'China', 'CHA', 'Y'),
(3, 'Others', 'OA', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_course_category`
--

CREATE TABLE `velocity_course_category` (
  `category_id` smallint(6) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_course_category`
--

INSERT INTO `velocity_course_category` (`category_id`, `category`, `category_code`, `status`) VALUES
(1, 'Development', 'DEV01', 'Y'),
(2, 'Corporate', 'COP331', 'Y'),
(3, 'Animation', 'ANM002', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_course_master`
--

CREATE TABLE `velocity_course_master` (
  `course_id` mediumint(9) NOT NULL,
  `category_id` mediumint(9) NOT NULL,
  `course_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course_details` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `course_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` mediumint(9) DEFAULT NULL,
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `velocity_department`
--

CREATE TABLE `velocity_department` (
  `department_id` smallint(6) NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department_details` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_department`
--

INSERT INTO `velocity_department` (`department_id`, `department`, `department_details`, `status`) VALUES
(2, 'corporate', 'asdfd', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_email_master`
--

CREATE TABLE `velocity_email_master` (
  `template_id` mediumint(9) NOT NULL,
  `email_purpose` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_body` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `velocity_material_category`
--

CREATE TABLE `velocity_material_category` (
  `material_cat_id` mediumint(9) NOT NULL,
  `material_cat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `material_cat_det` mediumtext COLLATE utf8_unicode_ci,
  `material_cat_status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_material_category`
--

INSERT INTO `velocity_material_category` (`material_cat_id`, `material_cat_name`, `material_cat_det`, `material_cat_status`) VALUES
(1, 'Word Bank', 'Word Bank', 'Y'),
(2, 'Official Materials', 'Official Materials', 'Y'),
(3, 'VE Technics', 'VE Technics', 'Y'),
(4, 'Test Experience', 'Test Experience', 'Y'),
(5, 'PTE Templates', 'PTE Templates', 'Y'),
(6, 'Presentation Materials', 'Presentation Materials', 'Y'),
(7, 'New Materials', 'New Materials', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_material_master`
--

CREATE TABLE `velocity_material_master` (
  `material_det_id` mediumint(9) NOT NULL,
  `material_cat_id` mediumint(9) DEFAULT NULL,
  `material_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details_type` enum('image','video','doc') COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_id` mediumint(9) DEFAULT NULL,
  `associated_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` mediumint(9) NOT NULL DEFAULT '0',
  `visibility_level` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_material_master`
--

INSERT INTO `velocity_material_master` (`material_det_id`, `material_cat_id`, `material_name`, `file_name`, `file_type`, `details_type`, `course_id`, `associated_file`, `created_on`, `created_by`, `visibility_level`) VALUES
(4, 2, 'testsample', 'testsample', 'pdf', NULL, NULL, 'Sim.pdf', '2018-11-13 07:20:29', 0, 'when_course_approved'),
(7, 7, 'test', 'test', 'pdf', NULL, NULL, 'FIB LISTENING（仅大澳）.pdf', '2018-11-15 04:07:43', 0, 'everyone_can_see');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_menu`
--

CREATE TABLE `velocity_menu` (
  `menu_id` mediumint(9) NOT NULL,
  `menu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_details` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `velocity_menu_roles`
--

CREATE TABLE `velocity_menu_roles` (
  `menu_role_id` mediumint(9) NOT NULL,
  `menu_id` mediumint(9) NOT NULL,
  `role_id` mediumint(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `velocity_migrations`
--

CREATE TABLE `velocity_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `velocity_order_master`
--

CREATE TABLE `velocity_order_master` (
  `order_id` mediumint(9) NOT NULL,
  `student_id` mediumint(9) NOT NULL,
  `package_id` mediumint(9) NOT NULL,
  `class_id` smallint(6) DEFAULT NULL,
  `student_goal` mediumtext COLLATE utf8_unicode_ci,
  `payment_methods` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `know_about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordered_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_upto` datetime DEFAULT NULL,
  `payment_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Y','N','NA') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NA',
  `payment_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_order_master`
--

INSERT INTO `velocity_order_master` (`order_id`, `student_id`, `package_id`, `class_id`, `student_goal`, `payment_methods`, `know_about`, `ordered_on`, `valid_upto`, `payment_amount`, `status`, `payment_status`) VALUES
(2, 17, 4, 2, '79', 'australian_online_transfer', 'from_email', '2018-11-13 07:04:22', '2019-02-13 08:00:48', '700', 'Y', 'paid'),
(3, 18, 4, 2, '65', 'cash', 'from_social_media', '2018-11-13 07:05:42', '2019-02-13 08:01:02', '100', 'Y', 'pending'),
(4, 19, 5, 2, 'test', 'australian_online_transfer', 'agency', '2018-11-15 12:25:57', '2019-02-13 12:25:57', NULL, 'NA', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_packages`
--

CREATE TABLE `velocity_packages` (
  `package_id` mediumint(9) NOT NULL,
  `package_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_details` mediumtext COLLATE utf8_unicode_ci,
  `package_price` float(10,2) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` smallint(6) NOT NULL DEFAULT '0',
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_packages`
--

INSERT INTO `velocity_packages` (`package_id`, `package_name`, `package_details`, `package_price`, `created_on`, `created_by`, `status`) VALUES
(5, 'PTE VIP 12 Hours', 'PTE VIP $499/12 Hours', 499.00, '2018-11-13 06:14:14', 0, 'Y'),
(4, 'PTE 网课 42 Hours', 'PTE Web Class 42 Hours', 700.00, '2018-11-13 06:08:56', 0, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_permission_master`
--

CREATE TABLE `velocity_permission_master` (
  `permission_id` mediumint(9) NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_details` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_permission_master`
--

INSERT INTO `velocity_permission_master` (`permission_id`, `permission`, `permission_slug`, `permission_details`, `status`) VALUES
(1, 'Settings', 'settings', '', 'Y'),
(2, 'Role Management', 'role-management', '', 'Y'),
(3, 'User Management', 'user-management', '', 'Y'),
(4, 'Material Management', 'material-management', '', 'Y'),
(5, 'Class Management', 'class-management', '', 'Y'),
(6, 'Package Management', 'package-management', '', 'Y'),
(7, 'Order Management', 'order-management', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_role_master`
--

CREATE TABLE `velocity_role_master` (
  `role_id` smallint(6) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Y','N','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_role_master`
--

INSERT INTO `velocity_role_master` (`role_id`, `role`, `role_slug`, `status`) VALUES
(1, 'Admin', 'admin', 'Y'),
(2, 'Employee', 'employee', 'Y'),
(3, 'Student', 'student', 'Y'),
(7, 'Examer', 'Examer', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_role_permission`
--

CREATE TABLE `velocity_role_permission` (
  `perm_role_id` mediumint(9) NOT NULL,
  `role_id` mediumint(9) NOT NULL,
  `permission_id` mediumint(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_role_permission`
--

INSERT INTO `velocity_role_permission` (`perm_role_id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 4),
(9, 2, 5),
(10, 2, 6),
(11, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `velocity_settings`
--

CREATE TABLE `velocity_settings` (
  `settings_id` smallint(6) NOT NULL,
  `settings_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `settings_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_settings`
--

INSERT INTO `velocity_settings` (`settings_id`, `settings_name`, `settings_value`) VALUES
(9, 'company_name', 'Velocity'),
(10, 'company_website', 'velocityenglish.com.au'),
(11, 'phone_number', '123456789'),
(12, 'company_address', 'Velocity English'),
(13, 'email_address', 'admin@velocityenglish.com.au'),
(14, 'frmSubmit', '1'),
(15, 'company_logo', '');

-- --------------------------------------------------------

--
-- Table structure for table `velocity_student_master`
--

CREATE TABLE `velocity_student_master` (
  `student_id` mediumint(9) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` mediumint(9) NOT NULL,
  `city` mediumint(9) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `velocity_user_master`
--

CREATE TABLE `velocity_user_master` (
  `user_id` mediumint(9) NOT NULL,
  `role_id` mediumint(9) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` mediumint(9) NOT NULL,
  `city_id` mediumint(9) NOT NULL,
  `department_id` mediumint(9) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `temperature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velocity_user_master`
--

INSERT INTO `velocity_user_master` (`user_id`, `role_id`, `first_name`, `last_name`, `email`, `phone`, `country_id`, `city_id`, `department_id`, `password`, `created_by`, `created_on`, `updated_by`, `updated_on`, `status`, `temperature`) VALUES
(16, 3, 'Ethan', 'XIE', 'ethandzx@gmail.com', '0430940409', 1, 1, NULL, 'dzeleven', NULL, '2018-11-13 05:55:58', NULL, NULL, 'Y', NULL),
(17, 3, 'Lan', 'Chang', 'changlanchuan@gmail.com', '0414336325', 1, 1, NULL, 'haveatest', NULL, '2018-11-13 06:09:48', NULL, NULL, 'Y', 'cold'),
(18, 3, 'Lanc', 'cc', 'joshue@qq.com', '0444444444', 1, 2, NULL, 'havetest', NULL, '2018-11-13 06:52:21', NULL, NULL, 'Y', 'hot'),
(19, 3, 'Velocity', 'student', 'soumyadipta.sarkar@gmail.com', '9432989673', 1, 1, NULL, '123456', NULL, '2018-11-15 03:03:37', NULL, NULL, 'Y', NULL),
(20, 3, 'MENG', 'YANG', '104425085@QQ.COM', '0466830685', 1, 1, NULL, 'Dy827%@#', NULL, '2018-11-15 03:22:14', NULL, NULL, 'Y', NULL),
(22, 3, 'abc', 'def', 'joshue@sina.cn', '00000000', 1, 1, NULL, 'haveanothertest', NULL, '2018-11-30 07:58:37', NULL, NULL, 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `velocity_visibility`
--

CREATE TABLE `velocity_visibility` (
  `visiblity_id` smallint(6) NOT NULL,
  `visibility` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_tag` smallint(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminmaster`
--
ALTER TABLE `adminmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `velocity_city`
--
ALTER TABLE `velocity_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `velocity_class_master`
--
ALTER TABLE `velocity_class_master`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `velocity_country`
--
ALTER TABLE `velocity_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `velocity_course_category`
--
ALTER TABLE `velocity_course_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `velocity_course_master`
--
ALTER TABLE `velocity_course_master`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `velocity_department`
--
ALTER TABLE `velocity_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `velocity_email_master`
--
ALTER TABLE `velocity_email_master`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `velocity_material_category`
--
ALTER TABLE `velocity_material_category`
  ADD PRIMARY KEY (`material_cat_id`);

--
-- Indexes for table `velocity_material_master`
--
ALTER TABLE `velocity_material_master`
  ADD PRIMARY KEY (`material_det_id`);

--
-- Indexes for table `velocity_menu`
--
ALTER TABLE `velocity_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `velocity_menu_roles`
--
ALTER TABLE `velocity_menu_roles`
  ADD PRIMARY KEY (`menu_role_id`);

--
-- Indexes for table `velocity_migrations`
--
ALTER TABLE `velocity_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `velocity_order_master`
--
ALTER TABLE `velocity_order_master`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `velocity_packages`
--
ALTER TABLE `velocity_packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `velocity_permission_master`
--
ALTER TABLE `velocity_permission_master`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `velocity_role_master`
--
ALTER TABLE `velocity_role_master`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `velocity_role_permission`
--
ALTER TABLE `velocity_role_permission`
  ADD PRIMARY KEY (`perm_role_id`);

--
-- Indexes for table `velocity_settings`
--
ALTER TABLE `velocity_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `velocity_student_master`
--
ALTER TABLE `velocity_student_master`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `velocity_user_master`
--
ALTER TABLE `velocity_user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `velocity_visibility`
--
ALTER TABLE `velocity_visibility`
  ADD PRIMARY KEY (`visiblity_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminmaster`
--
ALTER TABLE `adminmaster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `velocity_city`
--
ALTER TABLE `velocity_city`
  MODIFY `city_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `velocity_class_master`
--
ALTER TABLE `velocity_class_master`
  MODIFY `class_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `velocity_country`
--
ALTER TABLE `velocity_country`
  MODIFY `country_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `velocity_course_category`
--
ALTER TABLE `velocity_course_category`
  MODIFY `category_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `velocity_course_master`
--
ALTER TABLE `velocity_course_master`
  MODIFY `course_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `velocity_department`
--
ALTER TABLE `velocity_department`
  MODIFY `department_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `velocity_email_master`
--
ALTER TABLE `velocity_email_master`
  MODIFY `template_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `velocity_material_category`
--
ALTER TABLE `velocity_material_category`
  MODIFY `material_cat_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `velocity_material_master`
--
ALTER TABLE `velocity_material_master`
  MODIFY `material_det_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `velocity_menu`
--
ALTER TABLE `velocity_menu`
  MODIFY `menu_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `velocity_menu_roles`
--
ALTER TABLE `velocity_menu_roles`
  MODIFY `menu_role_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `velocity_migrations`
--
ALTER TABLE `velocity_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `velocity_order_master`
--
ALTER TABLE `velocity_order_master`
  MODIFY `order_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `velocity_packages`
--
ALTER TABLE `velocity_packages`
  MODIFY `package_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `velocity_permission_master`
--
ALTER TABLE `velocity_permission_master`
  MODIFY `permission_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `velocity_role_master`
--
ALTER TABLE `velocity_role_master`
  MODIFY `role_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `velocity_role_permission`
--
ALTER TABLE `velocity_role_permission`
  MODIFY `perm_role_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `velocity_settings`
--
ALTER TABLE `velocity_settings`
  MODIFY `settings_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `velocity_student_master`
--
ALTER TABLE `velocity_student_master`
  MODIFY `student_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `velocity_user_master`
--
ALTER TABLE `velocity_user_master`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `velocity_visibility`
--
ALTER TABLE `velocity_visibility`
  MODIFY `visiblity_id` smallint(6) NOT NULL AUTO_INCREMENT;
COMMIT;


--
-- Table structure for table `category_master`
--
CREATE TABLE `category_master` (
  `CID` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`CID`),
  UNIQUE KEY `CID_UNIQUE` (`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `category_slave`
--

CREATE TABLE `category_slave` (
  `CSID` int(11) NOT NULL AUTO_INCREMENT,
  `CID` int(11) DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`CSID`),
  UNIQUE KEY `CSID_UNIQUE` (`CSID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='category slave table';



--
-- Table structure for table `fiblanswer`
--


CREATE TABLE `fiblanswer` (
  `FIBLAID` int(11) NOT NULL AUTO_INCREMENT,
  `FIBLID` int(11) DEFAULT NULL,
  `answers` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `fiblComment` varchar(5000) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`FIBLAID`),
  UNIQUE KEY `FIBLAID_UNIQUE` (`FIBLAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `fiblinfo`
--


CREATE TABLE `fiblinfo` (
  `FIBLID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`FIBLID`),
  UNIQUE KEY `idfibl_UNIQUE` (`FIBLID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `fiblquestion`
--


CREATE TABLE `fiblquestion` (
  `FIBLQID` int(11) NOT NULL AUTO_INCREMENT,
  `FIBLID` int(11) DEFAULT NULL,
  `content` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `audioPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`FIBLQID`),
  UNIQUE KEY `FIBLQID_UNIQUE` (`FIBLQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `mcsclanswer`
--

CREATE TABLE `mcsclanswer` (
  `MCSCLAID` int(11) NOT NULL AUTO_INCREMENT,
  `MCSCLID` int(250) DEFAULT NULL,
  `transcript` text,
  `explanation` varchar(2048) DEFAULT NULL,
  `mcsclComment` varchar(5000) DEFAULT NULL,
  `reserve1` varchar(250) DEFAULT NULL,
  `reserve2` varchar(250) DEFAULT NULL,
  `reserve3` varchar(250) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCSCLAID`),
  UNIQUE KEY `MCSCLAID_UNIQUE` (`MCSCLAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `mcsclinfo`
--

CREATE TABLE `mcsclinfo` (
  `MCSCLID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCSCLID`),
  UNIQUE KEY `RSID_UNIQUE` (`MCSCLID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `mcsclquestion`
--

CREATE TABLE `mcsclquestion` (
  `MCSCLQID` int(11) NOT NULL AUTO_INCREMENT,
  `MCSCLID` int(250) DEFAULT NULL,
  `content` text,
  `audioPath` varchar(1024) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCSCLQID`),
  UNIQUE KEY `MCSCLQID_UNIQUE` (`MCSCLQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `question_main`
--

CREATE TABLE `question_main` (
  `QID` int(11) NOT NULL AUTO_INCREMENT,
  `questionType` varchar(45) DEFAULT NULL,
  `questionName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`QID`),
  UNIQUE KEY `QID_UNIQUE` (`QID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `question_set`
--

CREATE TABLE `question_set` (
  `QSID` int(11) NOT NULL AUTO_INCREMENT,
  `QID` int(11) DEFAULT NULL,
  `readTime` int(11) DEFAULT NULL,
  `waitTime` int(11) DEFAULT NULL,
  `responseTime` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`QSID`),
  UNIQUE KEY `QSID_UNIQUE` (`QSID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `raanswer`
--

CREATE TABLE `raanswer` (
  `RAAID` int(11) NOT NULL AUTO_INCREMENT,
  `RAID` int(11) DEFAULT NULL,
  `audioPath` varchar(1024) DEFAULT NULL,
  `raComment` varchar(5000) DEFAULT NULL,
  `reserved2` varchar(45) DEFAULT NULL,
  `reserved3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RAAID`),
  UNIQUE KEY `RAAID_UNIQUE` (`RAAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='read aloud answer';


--
-- Table structure for table `rainfo`
--

CREATE TABLE `rainfo` (
  `RAID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RAID`),
  UNIQUE KEY `RAID_UNIQUE` (`RAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='read aloud info';


--
-- Table structure for table `raquestion`
--

CREATE TABLE `raquestion` (
  `RAQID` int(11) NOT NULL AUTO_INCREMENT,
  `RAID` int(11) DEFAULT NULL,
  `content` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RAQID`),
  UNIQUE KEY `RAQID_UNIQUE` (`RAQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `rsanswer`
--

CREATE TABLE `rsanswer` (
  `RSAID` int(11) NOT NULL AUTO_INCREMENT,
  `RSID` int(11) DEFAULT NULL,
  `transcript` varchar(5000) DEFAULT NULL,
  `wordCount` int(11) DEFAULT NULL,
  `rsComment` varchar(5000) DEFAULT NULL,
  `reserve1` varchar(45) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RSAID`),
  UNIQUE KEY `RSAID_UNIQUE` (`RSAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `rsinfo`
--

CREATE TABLE `rsinfo` (
  `RSID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RSID`),
  UNIQUE KEY `RSID_UNIQUE` (`RSID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `rsquestion`
--

CREATE TABLE `rsquestion` (
  `RSQID` int(11) NOT NULL AUTO_INCREMENT,
  `RSID` int(11) DEFAULT NULL,
  `audioPath` varchar(1024) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RSQID`),
  UNIQUE KEY `RSQID_UNIQUE` (`RSQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `diinfo`
--

CREATE TABLE `diinfo` (
  `DIID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`DIID`),
  UNIQUE KEY `DIID_UNIQUE` (`DIID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='DESCRIB IMAGE';



--
-- Table structure for table `diAnswer`
--

CREATE TABLE `dianswer` (
  `DIAID` int(11) NOT NULL AUTO_INCREMENT,
  `DIID` int(11) DEFAULT NULL,
  `answersAudio` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `answersTranscript` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `diComment` varchar(5000) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`DIAID`),
  UNIQUE KEY `DIAID_UNIQUE` (`DIAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `diquestion`
--

CREATE TABLE `diquestion` (
  `DIQID` int(11) NOT NULL AUTO_INCREMENT,
  `DIID` int(11) DEFAULT NULL,
  `picPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`DIQID`),
  UNIQUE KEY `DIQID_UNIQUE` (`DIQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `rlinfo`
--

CREATE TABLE `rlinfo` (
  `RLID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RLID`),
  UNIQUE KEY `RLID_UNIQUE` (`RLID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='RETELL LECTURE';


--
-- Table structure for table `rlanswer`
--

CREATE TABLE `rlanswer` (
  `RLAID` int(11) NOT NULL AUTO_INCREMENT,
  `RLID` int(11) DEFAULT NULL,
  `answersAudio` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `answersTranscript` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `rlComment` varchar(5000) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RLAID`),
  UNIQUE KEY `RLAID_UNIQUE` (`RLAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `rlquestion`
--


CREATE TABLE `rlquestion` (
  `RLQID` int(11) NOT NULL AUTO_INCREMENT,
  `RLID` int(11) DEFAULT NULL,
  `audioPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `picPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RLQID`),
  UNIQUE KEY `RLQID_UNIQUE` (`RLQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `asqinfo`
--


CREATE TABLE `asqinfo` (
  `ASQID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`ASQID`),
  UNIQUE KEY `ASQID_UNIQUE` (`ASQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ANSWER SHORT QUESTION';


--
-- Table structure for table `asqanswer`
--

CREATE TABLE `asqanswer` (
  `ASQAID` int(11) NOT NULL AUTO_INCREMENT,
  `ASQID` int(11) DEFAULT NULL,
  `answersAudio` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `answersTranscript` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `asqComment` varchar(5000) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`ASQAID`),
  UNIQUE KEY `ASQAID_UNIQUE` (`ASQAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `asqquestion`
--


CREATE TABLE `asqquestion` (
  `ASQQID` int(11) NOT NULL AUTO_INCREMENT,
  `ASQID` int(11) DEFAULT NULL,
  `audioPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`ASQQID`),
  UNIQUE KEY `ASQQID_UNIQUE` (`ASQQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `mcscrinfo`
--

CREATE TABLE `mcscrinfo` (
  `MCSCRID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCSCRID`),
  UNIQUE KEY `MCSCRID_UNIQUE` (`MCSCRID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='MULTIPLE CHOICE SINGLE ANSWER';


--
-- Table structure for table `mcscranswer`
--

CREATE TABLE `mcscranswer` (
  `MCSCRAID` int(11) NOT NULL AUTO_INCREMENT,
  `MCSCRID` int(11) DEFAULT NULL,
  `mcscrTranscript` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `mcscrComment` varchar(5000) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCSCRAID`),
  UNIQUE KEY `MCSCRAID_UNIQUE` (`MCSCRAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `mcscrquestion`
--

CREATE TABLE `mcscrquestion` (
  `MCSCRQID` int(11) NOT NULL AUTO_INCREMENT,
  `MCSCRID` int(11) DEFAULT NULL,
  `choices` varchar(3500) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCSCRQID`),
  UNIQUE KEY `MCSCRQID_UNIQUE` (`MCSCRQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `mcmcrinfo`
--

CREATE TABLE `mcmcrinfo` (
  `MCMCRID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCMCRID`),
  UNIQUE KEY `MCMCRID_UNIQUE` (`MCMCRID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='multiple choice multiple answer';


--
-- Table structure for table `mcmcranswer`
--

CREATE TABLE `mcmcranswer` (
  `MCMCRAID` int(11) NOT NULL AUTO_INCREMENT,
  `MCMCRID` int(11) DEFAULT NULL,
  `mcsmrTranscript` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `mcsmrComment` varchar(5000) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCMCRAID`),
  UNIQUE KEY `MCMCRAID_UNIQUE` (`MCMCRAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `mcmcrquestion`
--


CREATE TABLE `mcmcrquestion` (
  `MCMCRQID` int(11) NOT NULL AUTO_INCREMENT,
  `MCMCRID` int(11) DEFAULT NULL,
  `choices` varchar(3500) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCMCRQID`),
  UNIQUE KEY `MCMCRQID_UNIQUE` (`MCMCRQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `fibrinfo`
--


CREATE TABLE `fibrinfo` (
  `FIBRID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`FIBRID`),
  UNIQUE KEY `FIBRID_UNIQUE` (`FIBRID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='fill in blank reading';


--
-- Table structure for table `fibranswer`
--

CREATE TABLE `fibranswer` (
  `FIBRAID` int(11) NOT NULL AUTO_INCREMENT,
  `FIBRID` int(11) DEFAULT NULL,
  `fibrAnswers` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `fibrComment` varchar(5000) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`FIBRAID`),
  UNIQUE KEY `FIBRAID_UNIQUE` (`FIBRAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `fibrquestion`
--


CREATE TABLE `fibrquestion` (
  `FIBRQID` int(11) NOT NULL AUTO_INCREMENT,
  `FIBRID` int(11) DEFAULT NULL,
  `choices` varchar(3500) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`FIBRQID`),
  UNIQUE KEY `FIBRQID_UNIQUE` (`FIBRQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `fibrwinfo`
--


CREATE TABLE `fibrwinfo` (
  `FIBRWID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`FIBRWID`),
  UNIQUE KEY `FIBRWID_UNIQUE` (`FIBRWID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='fill in blank rw';


--
-- Table structure for table `fibrwanswer`
--

CREATE TABLE `fibrwanswer` (
  `FIBRWAID` int(11) NOT NULL AUTO_INCREMENT,
  `FIBRWID` int(11) DEFAULT NULL,
  `fibrwAnswers` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `fibrwComment` varchar(5000) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`FIBRWAID`),
  UNIQUE KEY `FIBRWAID_UNIQUE` (`FIBRWAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `fibrwquestion`
--


CREATE TABLE `fibrwquestion` (
  `FIBRWQID` int(11) NOT NULL AUTO_INCREMENT,
  `FIBRWID` int(11) DEFAULT NULL,
  `choices` varchar(3500) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`FIBRWQID`),
  UNIQUE KEY `FIBRWQID_UNIQUE` (`FIBRWQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `rpinfo`
--


CREATE TABLE `rpinfo` (
  `RPID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RPID`),
  UNIQUE KEY `RPID_UNIQUE` (`RPID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='reorder paragraph';


--
-- Table structure for table `rpanswer`
--

CREATE TABLE `rpanswer` (
  `RPAID` int(11) NOT NULL AUTO_INCREMENT,
  `RPID` int(11) DEFAULT NULL,
  `rpAnswers` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `rpComment` varchar(5000) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RPAID`),
  UNIQUE KEY `RPAID_UNIQUE` (`RPAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `rpquestion`
--


CREATE TABLE `rpquestion` (
  `RPQID` int(11) NOT NULL AUTO_INCREMENT,
  `RPID` int(11) DEFAULT NULL,
  `paragraphs` varchar(3500) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`RPQID`),
  UNIQUE KEY `RPQID_UNIQUE` (`RPQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `weinfo`
--

CREATE TABLE `weinfo` (
  `WEID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`WEID`),
  UNIQUE KEY `WEID_UNIQUE` (`WEID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='write essay';


--
-- Table structure for table `weanswer`
--

CREATE TABLE `weanswer` (
  `WEAID` int(11) NOT NULL AUTO_INCREMENT,
  `WEID` int(11) DEFAULT NULL,
  `weAnswers` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `weComment` varchar(5000) DEFAULT NULL,
  `reserve2` varchar(45) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`WEAID`),
  UNIQUE KEY `WEAID_UNIQUE` (`WEAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `wequestion`
--


CREATE TABLE `wequestion` (
  `WEQID` int(11) NOT NULL AUTO_INCREMENT,
  `WEID` int(11) DEFAULT NULL,
  `wQustion` varchar(3500) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`WEQID`),
  UNIQUE KEY `WEQID_UNIQUE` (`WEQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `swtinfo`
--


CREATE TABLE `swtinfo` (
  `SWTID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`SWTID`),
  UNIQUE KEY `SWTID_UNIQUE` (`SWTID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='summarize written text';


--
-- Table structure for table `swtanswer`
--

CREATE TABLE `swtanswer` (
  `SWTAID` int(11) NOT NULL AUTO_INCREMENT,
  `SWTID` int(11) DEFAULT NULL,
  `swtAnswers` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `swtComment` varchar(5000) DEFAULT NULL,
  `wordCount` int(11) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`SWTAID`),
  UNIQUE KEY `SWTAID_UNIQUE` (`SWTAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `swtquestion`
--


CREATE TABLE `swtquestion` (
  `SWTQID` int(11) NOT NULL AUTO_INCREMENT,
  `SWTID` int(11) DEFAULT NULL,
  `swtQustion` varchar(3500) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`SWTQID`),
  UNIQUE KEY `SWTQID_UNIQUE` (`SWTQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `mcmclinfo`
--


CREATE TABLE `mcmclinfo` (
  `MCMCLID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCMCLID`),
  UNIQUE KEY `MCMCLID_UNIQUE` (`MCMCLID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='multiple choice multiple answer listening';


--
-- Table structure for table `mcmclanswer`
--

CREATE TABLE `mcmclanswer` (
  `MCMCLAID` int(11) NOT NULL AUTO_INCREMENT,
  `MCMCLID` int(11) DEFAULT NULL,
  `mcmclAnswers` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `mcmclComment` varchar(5000) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCMCLAID`),
  UNIQUE KEY `MCMCLAID_UNIQUE` (`MCMCLAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `mcmclquestion`
--


CREATE TABLE `mcmclquestion` (
  `MCMCLQID` int(11) NOT NULL AUTO_INCREMENT,
  `MCMCLID` int(11) DEFAULT NULL,
  `mcmclTranscript` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `choices` varchar(3500) CHARACTER SET utf8 DEFAULT NULL,
  `audioPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`MCMCLQID`),
  UNIQUE KEY `MCMCLQID_UNIQUE` (`MCMCLQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `sstinfo`
--


CREATE TABLE `sstinfo` (
  `SSTID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`SSTID`),
  UNIQUE KEY `SSTID_UNIQUE` (`SSTID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='summarize spoken text';


--
-- Table structure for table `sstanswer`
--

CREATE TABLE `sstanswer` (
  `SSTAID` int(11) NOT NULL AUTO_INCREMENT,
  `SSTID` int(11) DEFAULT NULL,
  `sstAnswers` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `sstComment` varchar(5000) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`SSTAID`),
  UNIQUE KEY `SSTAID_UNIQUE` (`SSTAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `sstquestion`
--


CREATE TABLE `sstquestion` (
  `SSTQID` int(11) NOT NULL AUTO_INCREMENT,
  `SSTID` int(11) DEFAULT NULL,
  `picPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `audioPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`SSTQID`),
  UNIQUE KEY `SSTQID_UNIQUE` (`SSTQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `hcsinfo`
--


CREATE TABLE `hcsinfo` (
  `HCSID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`HCSID`),
  UNIQUE KEY `HCSID_UNIQUE` (`HCSID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='higlight corrent summary';


--
-- Table structure for table `hcsanswer`
--

CREATE TABLE `hcsanswer` (
  `HCSAID` int(11) NOT NULL AUTO_INCREMENT,
  `HCSID` int(11) DEFAULT NULL,
  `hcsAnswers` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `hcsComment` varchar(5000) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`HCSAID`),
  UNIQUE KEY `HCSAID_UNIQUE` (`HCSAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `hcsquestion`
--


CREATE TABLE `hcsquestion` (
  `HCSQID` int(11) NOT NULL AUTO_INCREMENT,
  `HCSID` int(11) DEFAULT NULL,
  `choices` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `audioPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`HCSQID`),
  UNIQUE KEY `HCSQID_UNIQUE` (`HCSQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `smwinfo`
--


CREATE TABLE `smwinfo` (
  `SMWID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`SMWID`),
  UNIQUE KEY `SMWID_UNIQUE` (`SMWID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='select missing words';


--
-- Table structure for table `swmanswer`
--

CREATE TABLE `smwanswer` (
  `SMWAID` int(11) NOT NULL AUTO_INCREMENT,
  `SMWID` int(11) DEFAULT NULL,
  `smwAnswers` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `smwComment` varchar(5000) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`SMWAID`),
  UNIQUE KEY `SMWAID_UNIQUE` (`SMWAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `swmquestion`
--


CREATE TABLE `swmquestion` (
  `SMWQID` int(11) NOT NULL AUTO_INCREMENT,
  `SMWID` int(11) DEFAULT NULL,
  `choices` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `audioPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`SMWQID`),
  UNIQUE KEY `SMWQID_UNIQUE` (`SMWQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `hiwinfo`
--


CREATE TABLE `hiwinfo` (
  `HIWID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`HIWID`),
  UNIQUE KEY `HIWID_UNIQUE` (`HIWID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='higlight incorrect word';


--
-- Table structure for table `hiwanswer`
--

CREATE TABLE `hiwanswer` (
  `HIWAID` int(11) NOT NULL AUTO_INCREMENT,
  `HIWID` int(11) DEFAULT NULL,
  `hiwAnswers` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `hiwComment` varchar(5000) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`HIWAID`),
  UNIQUE KEY `HIWAID_UNIQUE` (`HIWAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `hiwquestion`
--


CREATE TABLE `hiwquestion` (
  `HIWQID` int(11) NOT NULL AUTO_INCREMENT,
  `HIWID` int(11) DEFAULT NULL,
  `transcript` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `audioPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`HIWQID`),
  UNIQUE KEY `HIWQID_UNIQUE` (`HIWQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `wfdinfo`
--


CREATE TABLE `wfdinfo` (
  `WFDID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`WFDID`),
  UNIQUE KEY `WFDID_UNIQUE` (`WFDID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='write from dictation';

--
-- Table structure for table `wfdanswer`
--

CREATE TABLE `wfdanswer` (
  `WFDAID` int(11) NOT NULL AUTO_INCREMENT,
  `WFDID` int(11) DEFAULT NULL,
  `wfdAnswers` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `hiwComment` varchar(5000) DEFAULT NULL,
  `reserve3` varchar(45) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`WFDAID`),
  UNIQUE KEY `WFDAID_UNIQUE` (`WFDAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `wfdquestion`
--


CREATE TABLE `wfdquestion` (
  `WFDQID` int(11) NOT NULL AUTO_INCREMENT,
  `WFDID` int(11) DEFAULT NULL,
  `audioPath` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT 0,
  PRIMARY KEY (`WFDQID`),
  UNIQUE KEY `WFDQID_UNIQUE` (`WFDQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
