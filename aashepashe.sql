-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2019 at 06:38 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aashepashe`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` enum('Admin','Merchant','User') DEFAULT NULL,
  `browser_name` varchar(50) DEFAULT NULL,
  `browser_version` varchar(50) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `activity_facility`
--

CREATE TABLE `activity_facility` (
  `activity_facility_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `activity_wise_facility`
--

CREATE TABLE `activity_wise_facility` (
  `activity_wise_facility_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `facility_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `type` enum('Admin','Employee') NOT NULL DEFAULT 'Admin',
  `password` varchar(255) DEFAULT NULL,
  `is_logged` enum('Yes','No') NOT NULL DEFAULT 'No',
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `phone`, `code`, `avatar`, `status`, `type`, `password`, `is_logged`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'johndoe@aashepashe.com', '1717940150', '+880', '201906241242195d10c52b71f0f9.jpg', 'Active', 'Admin', '$2y$10$pRvcolNG1Kd5oAk06kh9MOGb8RcjMAC0REkEsPSzm5LtlYoDfYnKu', 'Yes', 'KcHYcNa0Prj4fAZoEYqO5HNm0LnotXSTGULQi8yq3c0HyjE4JxIzg6KxTbTR', '2019-05-13 07:15:13', '2019-06-24 04:42:19'),
(2, 'Syed Walid', 'walid@aashepashe.com', '18757114755', '+86', '201905151051535cdbef493d6786.jpg', 'Active', 'Admin', '$2y$10$5Xm2Ge7IZ5bWZu8etqaV6.KgDeWzHC015ad19zcJQrIn3q6RUBB12', 'No', NULL, '2019-05-15 10:51:52', '2019-06-24 13:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `bed_type`
--

CREATE TABLE `bed_type` (
  `bed_type_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `sub_area_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `root_id` int(11) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branch_wise_user`
--

CREATE TABLE `branch_wise_user` (
  `bwu_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `type_name` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `status`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'Nearby Service', 'Active', 'Service', '2019-03-29 17:57:37', '2019-03-29 10:05:35'),
(2, 'Flight', 'Active', 'Flight', '2019-03-29 18:06:22', '2019-03-29 10:06:52'),
(3, 'Hotel', 'Active', 'Hotel', '2019-03-31 05:42:09', '2019-03-30 21:42:09'),
(4, 'Ticket', 'Active', 'Ticket', '2019-03-31 05:42:20', '2019-05-05 11:32:45'),
(5, 'Shopping', 'Active', 'Shopping', '2019-03-31 05:42:36', '2019-05-14 11:23:18'),
(6, 'Restaurant', 'Active', 'Restaurant', '2019-03-31 05:42:48', '2019-03-30 21:42:48'),
(7, 'Delivery', 'Active', 'Delivery', '2019-03-31 05:43:03', '2019-03-30 21:43:03'),
(8, 'People Around Me', 'Inactive', 'People', '2019-03-31 05:43:17', '2019-06-01 23:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `country_id`, `name`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(1, 18, 'Dhaka', '23.71323', '90.39957', 'Active', '2019-03-29 11:23:50', '2019-05-13 18:00:27'),
(2, 18, 'Barishal', '22.69436', '90.36342', 'Active', '2019-03-29 11:36:50', '2019-05-13 18:00:53'),
(3, 18, 'Chattogram', '20.12345', '90.21234', 'Active', '2019-03-29 11:37:04', '2019-05-13 18:00:53'),
(4, 18, 'Khulna', '20.0909', '90.2321', 'Active', '2019-03-29 11:37:17', '2019-05-14 11:05:23'),
(5, 18, 'Mymensingh', NULL, NULL, 'Active', '2019-03-29 11:37:27', '2019-05-13 18:00:53'),
(6, 18, 'Rajshahi', NULL, NULL, 'Active', '2019-03-29 11:37:37', '2019-05-13 18:00:53'),
(7, 18, 'Rangpur', NULL, NULL, 'Active', '2019-03-29 11:37:48', '2019-05-13 18:00:53'),
(8, 18, 'Sylhet', NULL, NULL, 'Active', '2019-03-29 11:37:58', '2019-05-13 18:00:53'),
(9, 44, 'Beijing', NULL, NULL, 'Active', '2019-05-13 18:11:29', '2019-05-13 10:11:29'),
(10, 44, 'Guangdong', NULL, NULL, 'Active', '2019-05-14 10:26:56', '2019-05-14 02:26:56'),
(11, 44, 'Anhui', NULL, NULL, 'Active', '2019-05-14 18:41:29', '2019-05-14 10:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_name` varchar(50) DEFAULT NULL,
  `code` varchar(15) DEFAULT NULL,
  `currency_symbol` varchar(15) DEFAULT NULL,
  `currency_name` varchar(15) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `name`, `short_name`, `code`, `currency_symbol`, `currency_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AFG', NULL, NULL, NULL, 'Inactive', NULL, '2019-06-24 13:38:52'),
(2, 'Albania', 'AL', NULL, NULL, NULL, 'Inactive', NULL, '2019-05-14 10:18:07'),
(3, 'Algeria', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(4, 'American Samoa', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(5, 'Andorra', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(6, 'Angola', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(7, 'Anguilla', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(8, 'Antarctica', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(9, 'Antigua and Barbuda', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(10, 'Argentina', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(11, 'Armenia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(12, 'Aruba', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(13, 'Australia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(14, 'Austria', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(15, 'Azerbaijan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(16, 'Bahamas', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(17, 'Bahrain', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(18, 'Bangladesh', 'BD', '+880', '৳', 'BDT', 'Active', NULL, '2019-06-01 22:27:56'),
(19, 'Barbados', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(20, 'Belarus', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(21, 'Belgium', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(22, 'Belize', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(23, 'Benin', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(24, 'Bermuda', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(25, 'Bhutan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(26, 'Bolivia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(27, 'Bosnia and Herzegovina', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(28, 'Botswana', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(29, 'Bouvet Island', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(30, 'Brazil', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(31, 'British Indian Ocean Territory', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(32, 'Brunei Darussalam', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(33, 'Bulgaria', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(34, 'Burkina Faso', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(35, 'Burundi', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(36, 'Cambodia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(37, 'Cameroon', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(38, 'Canada', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(39, 'Cape Verde', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(40, 'Cayman Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(41, 'Central African Republic', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(42, 'Chad', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(43, 'Chile', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(44, 'China', 'CN', '+86', '¥', 'RMB', 'Active', NULL, '2019-06-01 22:27:41'),
(45, 'Christmas Island', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(46, 'Cocos (Keeling) Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(47, 'Colombia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(48, 'Comoros', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(49, 'Congo', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(50, 'Cook Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(51, 'Costa Rica', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(52, 'Croatia (Hrvatska)', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(53, 'Cuba', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(54, 'Cyprus', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(55, 'Czech Republic', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(56, 'Denmark', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(57, 'Djibouti', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(58, 'Dominica', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(59, 'Dominican Republic', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(60, 'East Timor', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(61, 'Ecuador', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(62, 'Egypt', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(63, 'El Salvador', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(64, 'Equatorial Guinea', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(65, 'Eritrea', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(66, 'Estonia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(67, 'Ethiopia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(68, 'Falkland Islands (Malvinas)', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(69, 'Faroe Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(70, 'Fiji', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(71, 'Finland', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(72, 'France', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(73, 'France, Metropolitan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(74, 'French Guiana', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(75, 'French Polynesia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(76, 'French Southern Territories', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(77, 'Gabon', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(78, 'Gambia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(79, 'Georgia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(80, 'Germany', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(81, 'Ghana', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(82, 'Gibraltar', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(83, 'Guernsey', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(84, 'Greece', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(85, 'Greenland', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(86, 'Grenada', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(87, 'Guadeloupe', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(88, 'Guam', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(89, 'Guatemala', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(90, 'Guinea', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(91, 'Guinea-Bissau', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(92, 'Guyana', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(93, 'Haiti', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(94, 'Heard and Mc Donald Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(95, 'Honduras', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(96, 'Hong Kong', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(97, 'Hungary', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(98, 'Iceland', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(99, 'India', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(100, 'Isle of Man', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(101, 'Indonesia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(102, 'Iran (Islamic Republic of)', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(103, 'Iraq', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(104, 'Ireland', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(105, 'Israel', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(106, 'Italy', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(107, 'Ivory Coast', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(108, 'Jersey', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(109, 'Jamaica', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(110, 'Japan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(111, 'Jordan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(112, 'Kazakhstan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(113, 'Kenya', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(114, 'Kiribati', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(115, 'Korea, Democratic People\'s Republic of', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(116, 'Korea, Republic of', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(117, 'Kosovo', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(118, 'Kuwait', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(119, 'Kyrgyzstan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(120, 'Lao People\'s Democratic Republic', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(121, 'Latvia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(122, 'Lebanon', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(123, 'Lesotho', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(124, 'Liberia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(125, 'Libyan Arab Jamahiriya', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(126, 'Liechtenstein', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(127, 'Lithuania', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(128, 'Luxembourg', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(129, 'Macau', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(130, 'Macedonia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(131, 'Madagascar', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(132, 'Malawi', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(133, 'Malaysia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(134, 'Maldives', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(135, 'Mali', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(136, 'Malta', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(137, 'Marshall Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(138, 'Martinique', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(139, 'Mauritania', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(140, 'Mauritius', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(141, 'Mayotte', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(142, 'Mexico', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(143, 'Micronesia, Federated States of', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(144, 'Moldova, Republic of', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(145, 'Monaco', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(146, 'Mongolia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(147, 'Montenegro', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(148, 'Montserrat', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(149, 'Morocco', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(150, 'Mozambique', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(151, 'Myanmar', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(152, 'Namibia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(153, 'Nauru', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(154, 'Nepal', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(155, 'Netherlands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(156, 'Netherlands Antilles', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(157, 'New Caledonia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(158, 'New Zealand', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(159, 'Nicaragua', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(160, 'Niger', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(161, 'Nigeria', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(162, 'Niue', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(163, 'Norfolk Island', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(164, 'Northern Mariana Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(165, 'Norway', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(166, 'Oman', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(167, 'Pakistan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(168, 'Palau', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(169, 'Palestine', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(170, 'Panama', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(171, 'Papua New Guinea', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(172, 'Paraguay', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(173, 'Peru', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(174, 'Philippines', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(175, 'Pitcairn', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(176, 'Poland', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(177, 'Portugal', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(178, 'Puerto Rico', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(179, 'Qatar', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(180, 'Reunion', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(181, 'Romania', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(182, 'Russian Federation', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(183, 'Rwanda', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(184, 'Saint Kitts and Nevis', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(185, 'Saint Lucia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(186, 'Saint Vincent and the Grenadines', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(187, 'Samoa', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(188, 'San Marino', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(189, 'Sao Tome and Principe', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(190, 'Saudi Arabia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(191, 'Senegal', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(192, 'Serbia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(193, 'Seychelles', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(194, 'Sierra Leone', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(195, 'Singapore', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(196, 'Slovakia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(197, 'Slovenia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(198, 'Solomon Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(199, 'Somalia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(200, 'South Africa', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(201, 'South Georgia South Sandwich Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(202, 'Spain', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(203, 'Sri Lanka', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(204, 'St. Helena', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(205, 'St. Pierre and Miquelon', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(206, 'Sudan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(207, 'Suriname', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(208, 'Svalbard and Jan Mayen Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(209, 'Swaziland', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(210, 'Sweden', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(211, 'Switzerland', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(212, 'Syrian Arab Republic', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(213, 'Taiwan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(214, 'Tajikistan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(215, 'Tanzania, United Republic of', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(216, 'Thailand', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(217, 'Togo', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(218, 'Tokelau', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(219, 'Tonga', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(220, 'Trinidad and Tobago', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(221, 'Tunisia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(222, 'Turkey', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(223, 'Turkmenistan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(224, 'Turks and Caicos Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(225, 'Tuvalu', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(226, 'Uganda', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(227, 'Ukraine', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(228, 'United Arab Emirates', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(229, 'United Kingdom', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(230, 'United States', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(231, 'United States minor outlying islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(232, 'Uruguay', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(233, 'Uzbekistan', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(234, 'Vanuatu', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(235, 'Vatican City State', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(236, 'Venezuela', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(237, 'Vietnam', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(238, 'Virgin Islands (British)', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(239, 'Virgin Islands (U.S.)', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(240, 'Wallis and Futuna Islands', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(241, 'Western Sahara', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(242, 'Yemen', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(243, 'Zaire', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(244, 'Zambia', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53'),
(245, 'Zimbabwe', NULL, NULL, NULL, NULL, 'Inactive', NULL, '2019-05-13 17:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `question` text,
  `answer` text,
  `status` enum('Active','Inactive','Archived') NOT NULL DEFAULT 'Inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_facility`
--

CREATE TABLE `hotel_facility` (
  `hotel_facility_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_charged` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_image`
--

CREATE TABLE `hotel_image` (
  `hotel_image_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `root_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_info`
--

CREATE TABLE `hotel_info` (
  `hotel_info_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `root_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `star_rating` varchar(50) DEFAULT NULL,
  `total_room` int(11) DEFAULT NULL,
  `opening_date` varchar(50) DEFAULT NULL,
  `renovation_date` varchar(50) DEFAULT NULL,
  `details` text,
  `website` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `certification_image` varchar(255) DEFAULT NULL,
  `hotel_image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_wise_facility`
--

CREATE TABLE `hotel_wise_facility` (
  `hotel_wise_facility_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `merchant_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `country_code` varchar(15) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_logo` varchar(100) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `is_verified` enum('Yes','No') NOT NULL DEFAULT 'No',
  `root_id` int(11) DEFAULT NULL,
  `is_branch_user` enum('Yes','No') DEFAULT 'No',
  `is_logged` enum('Yes','No') NOT NULL DEFAULT 'No',
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `total_room` int(11) DEFAULT NULL,
  `area` varchar(15) DEFAULT NULL,
  `floor` varchar(15) DEFAULT NULL,
  `window` varchar(50) DEFAULT NULL,
  `smoking` varchar(50) DEFAULT NULL,
  `wifi` varchar(50) DEFAULT NULL,
  `wifi_type` varchar(15) DEFAULT NULL,
  `extra_bed` varchar(50) DEFAULT NULL,
  `occupancy` int(11) DEFAULT NULL,
  `bed_type_id` int(11) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `breakfast` varchar(50) DEFAULT NULL,
  `available_from` varchar(15) DEFAULT NULL,
  `available_days` varchar(255) DEFAULT NULL,
  `cancellation_policy` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room_facility`
--

CREATE TABLE `room_facility` (
  `room_facility_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `room_type_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room_wise_facility`
--

CREATE TABLE `room_wise_facility` (
  `room_wise_facility_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `facility_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `session_activity`
--

CREATE TABLE `session_activity` (
  `session_activity_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_login` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `user_type` enum('User','Merchant','Admin') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive','Archived') NOT NULL DEFAULT 'Inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_area`
--

CREATE TABLE `sub_area` (
  `sub_area_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_area`
--

INSERT INTO `sub_area` (`sub_area_id`, `name`, `city_id`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Barguna', 2, '20.121232', '90.123212', 'Active', '2019-05-05 18:04:16', '2019-06-11 10:50:03'),
(2, 'Barisal', 2, NULL, NULL, 'Active', '2019-05-05 18:04:33', '2019-05-05 10:04:33'),
(3, 'Bhola', 2, NULL, NULL, 'Active', '2019-05-05 18:04:49', '2019-05-05 10:04:49'),
(4, 'Jhalokati', 2, NULL, NULL, 'Active', '2019-05-05 18:05:04', '2019-05-05 10:05:04'),
(5, 'Patuakhali', 2, NULL, NULL, 'Active', '2019-05-05 18:05:22', '2019-05-05 10:05:22'),
(6, 'Pirojpur', 2, NULL, NULL, 'Active', '2019-05-05 18:05:36', '2019-05-05 10:05:36'),
(7, 'Bandarban', 3, NULL, NULL, 'Active', '2019-05-05 18:06:00', '2019-05-05 10:06:00'),
(8, 'Brahmanbaria', 3, NULL, NULL, 'Active', '2019-05-05 18:06:13', '2019-05-05 10:06:13'),
(9, 'Chandpur', 3, NULL, NULL, 'Active', '2019-05-05 18:06:30', '2019-05-05 10:06:30'),
(10, 'Chittagong', 3, NULL, NULL, 'Active', '2019-05-05 18:06:45', '2019-05-05 10:06:45'),
(11, 'Comilla', 3, NULL, NULL, 'Active', '2019-05-05 18:07:05', '2019-05-05 10:07:05'),
(12, 'Cox\'s Bazar', 3, NULL, NULL, 'Active', '2019-05-05 18:07:22', '2019-05-05 10:07:22'),
(13, 'Feni', 3, NULL, NULL, 'Active', '2019-05-05 18:07:36', '2019-05-05 10:07:36'),
(14, 'Khagrachhari', 3, NULL, NULL, 'Active', '2019-05-05 18:23:23', '2019-05-05 10:23:23'),
(15, 'Lakshmipur', 3, NULL, NULL, 'Active', '2019-05-05 18:23:38', '2019-05-05 10:23:38'),
(16, 'Noakhali', 3, NULL, NULL, 'Active', '2019-05-05 18:23:53', '2019-05-05 10:23:53'),
(17, 'Rangamati', 3, NULL, NULL, 'Active', '2019-05-05 18:24:10', '2019-05-05 10:24:10'),
(18, 'Dhaka', 1, NULL, NULL, 'Active', '2019-05-05 18:24:25', '2019-05-05 10:24:25'),
(19, 'Faridpur', 1, NULL, NULL, 'Active', '2019-05-05 18:24:38', '2019-05-05 10:24:38'),
(20, 'Gazipur', 1, NULL, NULL, 'Active', '2019-05-05 18:24:55', '2019-05-05 10:24:55'),
(21, 'Gopalganj', 1, NULL, NULL, 'Active', '2019-05-05 18:25:11', '2019-05-05 10:25:11'),
(22, 'Kishoreganj', 1, NULL, NULL, 'Active', '2019-05-05 18:25:24', '2019-05-05 10:25:24'),
(23, 'Madaripur', 1, NULL, NULL, 'Active', '2019-05-05 18:25:36', '2019-05-05 10:25:36'),
(24, 'Manikganj', 1, NULL, NULL, 'Active', '2019-05-05 18:25:50', '2019-05-05 10:25:50'),
(25, 'Munshiganj', 1, NULL, NULL, 'Active', '2019-05-05 18:26:26', '2019-05-05 10:26:26'),
(26, 'Narayanganj', 1, NULL, NULL, 'Active', '2019-05-05 18:26:39', '2019-05-05 10:26:39'),
(27, 'Narsingdi', 1, NULL, NULL, 'Active', '2019-05-05 18:26:53', '2019-05-05 10:26:53'),
(28, 'Rajbari', 1, NULL, NULL, 'Active', '2019-05-05 18:27:06', '2019-05-05 10:27:06'),
(29, 'Shariatpur', 1, NULL, NULL, 'Active', '2019-05-05 18:28:00', '2019-05-05 10:28:00'),
(30, 'Tangail', 1, NULL, NULL, 'Active', '2019-05-05 18:28:19', '2019-05-05 10:28:19'),
(31, 'Bagerhat', 4, NULL, NULL, 'Active', '2019-05-05 18:28:33', '2019-05-05 10:28:33'),
(32, 'Chuadanga', 4, NULL, NULL, 'Active', '2019-05-05 18:28:46', '2019-05-05 10:28:46'),
(33, 'Jessore', 4, NULL, NULL, 'Active', '2019-05-05 18:29:03', '2019-05-05 10:29:03'),
(34, 'Jhenaidah', 4, NULL, NULL, 'Active', '2019-05-05 18:29:16', '2019-05-05 10:29:16'),
(35, 'Khulna', 4, NULL, NULL, 'Active', '2019-05-05 18:29:30', '2019-05-05 10:29:30'),
(36, 'Kushtia', 4, NULL, NULL, 'Active', '2019-05-05 18:29:42', '2019-05-05 10:29:42'),
(37, 'Magura', 4, NULL, NULL, 'Active', '2019-05-05 18:29:57', '2019-05-05 10:29:57'),
(38, 'Meherpur', 4, NULL, NULL, 'Active', '2019-05-05 18:30:10', '2019-05-05 10:30:10'),
(39, 'Narail', 4, NULL, NULL, 'Active', '2019-05-05 18:30:23', '2019-05-05 10:30:23'),
(40, 'Satkhira', 4, NULL, NULL, 'Active', '2019-05-05 18:30:37', '2019-05-05 10:30:37'),
(41, 'Jamalpur', 5, NULL, NULL, 'Active', '2019-05-05 18:30:55', '2019-05-05 10:30:55'),
(42, 'Mymensingh', 5, NULL, NULL, 'Active', '2019-05-05 18:31:15', '2019-05-05 10:31:15'),
(43, 'Netrakona', 5, NULL, NULL, 'Active', '2019-05-05 18:31:30', '2019-05-05 10:31:30'),
(44, 'Sherpur', 5, NULL, NULL, 'Active', '2019-05-05 18:31:44', '2019-05-05 10:31:44'),
(45, 'Bogra', 6, NULL, NULL, 'Active', '2019-05-05 18:32:17', '2019-05-05 10:32:17'),
(46, 'Joypurhat', 6, NULL, NULL, 'Active', '2019-05-05 18:32:32', '2019-05-05 10:32:32'),
(47, 'Naogaon', 6, NULL, NULL, 'Active', '2019-05-05 18:32:46', '2019-05-05 10:32:46'),
(48, 'Natore', 6, NULL, NULL, 'Active', '2019-05-05 18:32:59', '2019-05-05 10:32:59'),
(49, 'Chapainawabganj', 6, NULL, NULL, 'Active', '2019-05-05 18:33:13', '2019-05-05 10:33:13'),
(50, 'Pabna', 6, NULL, NULL, 'Active', '2019-05-05 18:33:26', '2019-05-05 10:33:26'),
(51, 'Rajshahi', 6, NULL, NULL, 'Active', '2019-05-05 18:33:39', '2019-05-05 10:33:39'),
(52, 'Sirajgonj', 6, NULL, NULL, 'Active', '2019-05-05 18:33:56', '2019-05-05 10:33:56'),
(53, 'Dinajpur', 7, NULL, NULL, 'Active', '2019-05-05 18:34:13', '2019-05-05 10:34:13'),
(54, 'Gaibandha', 7, NULL, NULL, 'Active', '2019-05-05 18:34:28', '2019-05-05 10:34:28'),
(55, 'Kurigram', 7, NULL, NULL, 'Active', '2019-05-05 18:34:42', '2019-05-05 10:34:42'),
(56, 'Lalmonirhat', 7, NULL, NULL, 'Active', '2019-05-05 18:36:26', '2019-05-05 10:36:26'),
(57, 'Nilphamari', 7, NULL, NULL, 'Active', '2019-05-05 18:36:38', '2019-05-05 10:36:38'),
(58, 'Panchagarh', 7, NULL, NULL, 'Active', '2019-05-05 18:36:52', '2019-05-05 10:36:52'),
(59, 'Rangpur', 7, NULL, NULL, 'Active', '2019-05-05 18:37:06', '2019-05-05 10:37:06'),
(60, 'Thakurgaon', 7, NULL, NULL, 'Active', '2019-05-05 18:37:21', '2019-05-05 10:37:21'),
(61, 'Habiganj', 8, NULL, NULL, 'Active', '2019-05-05 18:37:33', '2019-05-05 10:37:33'),
(62, 'Sunamganj', 8, NULL, NULL, 'Active', '2019-05-05 18:39:59', '2019-05-05 10:39:59'),
(63, 'Sylhet', 8, NULL, NULL, 'Active', '2019-05-05 18:40:11', '2019-05-05 10:40:11'),
(64, 'Moulvibazar', 8, NULL, NULL, 'Active', '2019-05-05 18:40:39', '2019-05-05 10:40:39'),
(65, 'Guangzhou', 10, NULL, NULL, 'Active', '2019-05-14 10:35:01', '2019-05-14 02:35:01'),
(66, 'Zhuhai', 10, NULL, NULL, 'Active', '2019-05-14 10:40:12', '2019-06-24 13:43:50'),
(67, 'Shenzhen', 10, NULL, NULL, 'Active', '2019-05-19 07:38:15', '2019-05-18 23:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `system_settings_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_name` varchar(15) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `google` varchar(100) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `sales_email` varchar(100) DEFAULT NULL,
  `sales_phone` varchar(50) DEFAULT NULL,
  `support_email` varchar(100) DEFAULT NULL,
  `support_phone` varchar(50) DEFAULT NULL,
  `billing_email` varchar(100) DEFAULT NULL,
  `billing_phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `about_us` text,
  `terms` text,
  `privacy` text,
  `is_phone_verification` enum('Yes','No') NOT NULL DEFAULT 'No',
  `is_email_verification` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`system_settings_id`, `name`, `short_name`, `logo`, `facebook`, `google`, `youtube`, `linkedin`, `twitter`, `sales_email`, `sales_phone`, `support_email`, `support_phone`, `billing_email`, `billing_phone`, `address`, `about_us`, `terms`, `privacy`, `is_phone_verification`, `is_email_verification`, `created_at`, `updated_at`) VALUES
(1, 'Aashepashe', 'AP', NULL, 'http://www.facebook.com/ashepashe', 'https://www.google.com/ashepashe', 'https://www.youtube.com/ashepashe', 'https://www.linkedin.com/ashepashe', 'https://www.twitter.com/ashepashe', 'sales@ashepashe.com', '+8801701234567', 'support@ashepashe.com', '+8801701234567', 'billing@ashepashe.com', '+8801701234567', '1 New Eskaton Road, Adabor Thana, Mohammad Pur, Dhaka, Bangladesh', '<p>About us content goes here updated</p>', '<p>Terms and conditions content goes here updated</p>', '<p>Privacy and policy content goes here updated</p>', 'No', 'No', NULL, '2019-06-24 04:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hotel', '2019-03-29 23:43:53', '2019-03-29 15:47:09'),
(2, 'Flight', '2019-03-29 23:43:53', '2019-03-29 15:47:09'),
(3, 'Restaurant', '2019-03-29 23:43:53', '2019-03-29 15:47:09'),
(4, 'Ticket', '2019-03-29 23:43:53', '2019-03-29 15:47:09'),
(5, 'Shopping', '2019-03-29 23:43:53', '2019-03-29 15:47:09'),
(6, 'Service', '2019-03-29 23:43:53', '2019-03-29 15:47:09'),
(7, 'Delivery', '2019-03-29 23:43:53', '2019-03-29 15:47:09'),
(8, 'People', '2019-03-29 23:43:53', '2019-03-29 15:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `country_code` varchar(15) DEFAULT NULL,
  `gender` enum('Male','Female','Others') DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `is_verified` enum('Yes','No') NOT NULL DEFAULT 'No',
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `verification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` enum('User','Merchant','Admin') DEFAULT NULL,
  `code` varchar(25) DEFAULT NULL,
  `valid_time` datetime DEFAULT NULL,
  `random_code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `activity_facility`
--
ALTER TABLE `activity_facility`
  ADD PRIMARY KEY (`activity_facility_id`);

--
-- Indexes for table `activity_wise_facility`
--
ALTER TABLE `activity_wise_facility`
  ADD PRIMARY KEY (`activity_wise_facility_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bed_type`
--
ALTER TABLE `bed_type`
  ADD PRIMARY KEY (`bed_type_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `branch_wise_user`
--
ALTER TABLE `branch_wise_user`
  ADD PRIMARY KEY (`bwu_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `hotel_facility`
--
ALTER TABLE `hotel_facility`
  ADD PRIMARY KEY (`hotel_facility_id`);

--
-- Indexes for table `hotel_image`
--
ALTER TABLE `hotel_image`
  ADD PRIMARY KEY (`hotel_image_id`);

--
-- Indexes for table `hotel_info`
--
ALTER TABLE `hotel_info`
  ADD PRIMARY KEY (`hotel_info_id`);

--
-- Indexes for table `hotel_wise_facility`
--
ALTER TABLE `hotel_wise_facility`
  ADD PRIMARY KEY (`hotel_wise_facility_id`);

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`merchant_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_facility`
--
ALTER TABLE `room_facility`
  ADD PRIMARY KEY (`room_facility_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `room_wise_facility`
--
ALTER TABLE `room_wise_facility`
  ADD PRIMARY KEY (`room_wise_facility_id`);

--
-- Indexes for table `session_activity`
--
ALTER TABLE `session_activity`
  ADD PRIMARY KEY (`session_activity_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `sub_area`
--
ALTER TABLE `sub_area`
  ADD PRIMARY KEY (`sub_area_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`system_settings_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`verification_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_facility`
--
ALTER TABLE `activity_facility`
  MODIFY `activity_facility_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_wise_facility`
--
ALTER TABLE `activity_wise_facility`
  MODIFY `activity_wise_facility_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bed_type`
--
ALTER TABLE `bed_type`
  MODIFY `bed_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch_wise_user`
--
ALTER TABLE `branch_wise_user`
  MODIFY `bwu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_facility`
--
ALTER TABLE `hotel_facility`
  MODIFY `hotel_facility_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_image`
--
ALTER TABLE `hotel_image`
  MODIFY `hotel_image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_info`
--
ALTER TABLE `hotel_info`
  MODIFY `hotel_info_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_wise_facility`
--
ALTER TABLE `hotel_wise_facility`
  MODIFY `hotel_wise_facility_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchant_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_facility`
--
ALTER TABLE `room_facility`
  MODIFY `room_facility_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `room_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_wise_facility`
--
ALTER TABLE `room_wise_facility`
  MODIFY `room_wise_facility_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session_activity`
--
ALTER TABLE `session_activity`
  MODIFY `session_activity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_area`
--
ALTER TABLE `sub_area`
  MODIFY `sub_area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `system_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `verification_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
