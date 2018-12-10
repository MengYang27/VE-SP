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
CREATE DATABASE IF NOT EXISTS `at2l5loc_velocity` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `at2l5loc_velocity`;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
