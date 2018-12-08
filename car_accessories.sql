-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2018 at 12:45 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_accessories`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_tbl`
--

CREATE TABLE `address_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `landmark` varchar(80) NOT NULL,
  `area` varchar(80) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activation_status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(40) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_bankdetails_tbl`
--

CREATE TABLE `admin_bankdetails_tbl` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `bank_name` varchar(60) NOT NULL,
  `account_number` varchar(40) NOT NULL,
  `ifsc_code` varchar(60) NOT NULL,
  `account_type` varchar(30) NOT NULL,
  `branch` varchar(60) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(40) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_ipaddress` varchar(50) NOT NULL,
  `activation_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_bankdetails_tbl`
--

INSERT INTO `admin_bankdetails_tbl` (`id`, `admin_id`, `bank_name`, `account_number`, `ifsc_code`, `account_type`, `branch`, `address`, `city`, `created_date`, `created_by`, `created_ipaddress`, `activation_status`) VALUES
(1, 1, 'ICICI', '180301111111111111', '123123', 'Current', 'Madhapur', 'madhapur', 'Hyderabad', '2017-06-21 23:49:00', 1, '183.83.87.10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_log_history_tbl`
--

CREATE TABLE `admin_log_history_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_in_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `log_date` date NOT NULL,
  `log_ip_address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_log_history_tbl`
--

INSERT INTO `admin_log_history_tbl` (`id`, `user_id`, `log_in_time`, `log_out_time`, `log_date`, `log_ip_address`) VALUES
(1, 1, '2018-04-29 07:29:02', '0000-00-00 00:00:00', '2018-04-29', '::1'),
(2, 1, '2018-05-01 13:03:09', '0000-00-00 00:00:00', '2018-05-01', '::1'),
(3, 1, '2018-06-08 14:06:44', '0000-00-00 00:00:00', '2018-06-08', '::1'),
(4, 1, '2018-06-15 11:46:26', '0000-00-00 00:00:00', '2018-06-15', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `advisory_tbl`
--

CREATE TABLE `advisory_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile` varchar(60) NOT NULL,
  `suggesteddate` datetime NOT NULL,
  `suggestion` text NOT NULL,
  `picture` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(60) NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'login id',
  `created_role` int(11) NOT NULL,
  `activation_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advisory_tbl`
--

INSERT INTO `advisory_tbl` (`id`, `title`, `email`, `mobile`, `suggesteddate`, `suggestion`, `picture`, `created_date`, `created_ipaddress`, `created_by`, `created_role`, `activation_status`) VALUES
(1, 'achari', 'achariphp@gmail.com', '', '2017-04-08 08:22:07', 'designer & developer', 'profilepic_0f82b23a7ac3dafdfd6c52df6e287a8a086adb35.jpg', '2017-04-08 20:22:37', '::1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `artist_tbl`
--

CREATE TABLE `artist_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `city` varchar(60) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `profile_picture` varchar(200) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_role` int(11) NOT NULL DEFAULT '0' COMMENT '0- admin, 1-artist',
  `activation_status` int(11) NOT NULL DEFAULT '1',
  `best_artist_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_tbl`
--

INSERT INTO `artist_tbl` (`id`, `name`, `email`, `mobile`, `city`, `address`, `description`, `profile_picture`, `created_date`, `created_by`, `created_role`, `activation_status`, `best_artist_status`) VALUES
(1, 'venkateswara', 'achary.richlabz@gmail.com', '8688941771', 'Hyderabad', 'this is address', 'Great painter', 'profilepic_d05e49e94bf4263ad6e6b7605712144d876ae64e.jpg', '2017-06-07 23:42:34', 1, 0, 1, 0),
(2, 'ramesh gojarala', 'rameshgojarala@gmail.com', '8999999999', 'hyderabad', '', '', 'profilepic_68d210d65323947f0d52e20df8b8d570ff9b7b85.jpg', '2017-06-08 00:04:20', 1, 0, 1, 1),
(3, 'Abc', 'abc@gmail.com', '7878787878', '', '', 'assdwdx', 'profilepic_681dd0ea85785199adced55473a84bf72bad93cb.jpg', '2017-07-19 16:03:01', 1, 0, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime NOT NULL,
  `flag_status` int(11) DEFAULT '1',
  `priority` int(11) NOT NULL,
  `like_count` int(11) NOT NULL,
  `picture_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='blog table';

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `description`, `tag`, `author`, `created_by`, `created_on`, `modified_by`, `modified_on`, `flag_status`, `priority`, `like_count`, `picture_path`, `userid`) VALUES
(1, 'achariphp', 'achari-php', 'achari', 'vavcoders', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, '', 0),
(2, 'achariphp', 'achari-php', 'achari', 'vavcoders', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, '', 0),
(4, ',mysql', 'mysql-php', 'achari', 'vavcoders', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brand_tbl`
--

CREATE TABLE `brand_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(60) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_role` int(11) NOT NULL COMMENT '1 : Admin',
  `trash` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 : In trash | 0 : Out of trash',
  `activation_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_tbl`
--

INSERT INTO `brand_tbl` (`id`, `title`, `icon`, `created_date`, `created_ipaddress`, `created_by`, `created_role`, `trash`, `activation_status`) VALUES
(1, 'Basjiovi', 'Brand_293e85597be7003e29f5112c03f3a7f03412c710.jpg', '2018-04-29 16:37:47', '::1', 1, 1, 0, 1),
(2, 'Jago Hup', 'Brand_9e1525d5f5cd90d9cc361fcf008053872a60509a.jpg', '2018-04-29 20:29:17', '::1', 1, 1, 0, 1),
(3, 'karnod', 'Brand_67b8a5792c30e42fb9ddb0f1362d0e8047613558.jpg', '2018-04-29 20:29:38', '::1', 1, 1, 0, 1),
(4, 'spumxig', 'Brand_5a36eb0cb99704207494053328f271f8b4951224.jpg', '2018-04-29 20:30:02', '::1', 1, 1, 0, 1),
(5, 'lahasa', 'Brand_20ea0305ea178047bdf50b8e705785b5d1f1248a.jpg', '2018-04-29 20:30:26', '::1', 1, 1, 0, 1),
(6, 'crebari', 'Brand_0f3c3bf5989b40ed59f8f6fadb2afb455b99af5a.jpg', '2018-04-29 20:30:54', '::1', 1, 1, 0, 1),
(7, 'otnate', 'Brand_240b0b46ae6a30b8c990ce6c9b7e2d2cc90c5ae3.jpg', '2018-04-29 20:31:37', '::1', 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `business_type_list`
--

CREATE TABLE `business_type_list` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '1',
  `trash` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_type_list`
--

INSERT INTO `business_type_list` (`id`, `title`, `activation_status`, `trash`) VALUES
(1, 'Whole Seller', 1, 0),
(2, 'Retailer', 1, 0),
(3, 'Manufacturer', 1, 0),
(4, 'Dealers', 1, 0),
(5, 'Reseller', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

CREATE TABLE `cart_tbl` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `cart_qty` int(11) NOT NULL DEFAULT '1',
  `cart_price` double NOT NULL,
  `order_id` int(11) NOT NULL,
  `suborder_id` varchar(40) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_status` int(11) NOT NULL DEFAULT '0',
  `cart_session` varchar(100) NOT NULL,
  `shipping_charges` double NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ip_address` varchar(40) NOT NULL,
  `cancellation_date` datetime NOT NULL,
  `cancellation_reason` text NOT NULL,
  `return_expected_date` date NOT NULL,
  `returned_reason` text NOT NULL,
  `returned_date` datetime NOT NULL,
  `returned_acceptance_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 : Waiting | 1 : Accepted | 2 : Not Accepted '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_tbl`
--

INSERT INTO `cart_tbl` (`id`, `product_id`, `product_price`, `cart_qty`, `cart_price`, `order_id`, `suborder_id`, `user_id`, `cart_status`, `cart_session`, `shipping_charges`, `created_date`, `created_ip_address`, `cancellation_date`, `cancellation_reason`, `return_expected_date`, `returned_reason`, `returned_date`, `returned_acceptance_status`) VALUES
(3, 5, 0, 1, 0, 0, '', 0, 0, 'cd22c0bebbf7443a0847bad51517c032', 0, '2018-05-01 07:49:02', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0),
(4, 3, 0, 3, 0, 0, '', 0, 0, 'cd22c0bebbf7443a0847bad51517c032', 0, '2018-05-01 07:50:58', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0),
(6, 3, 0, 1, 0, 0, '', 0, 0, 'b623645ab802c254e9f767cc6b897006', 0, '2018-06-08 19:25:54', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0),
(7, 5, 0, 1, 0, 0, '', 0, 0, 'b623645ab802c254e9f767cc6b897006', 0, '2018-06-08 19:26:04', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0),
(8, 3, 0, 100, 0, 0, '', 0, 0, 'c2ad90f739c099197b5c84bb2cf84fbd', 0, '2018-06-09 07:59:38', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0),
(9, 5, 0, 10, 0, 0, '', 0, 0, 'c2ad90f739c099197b5c84bb2cf84fbd', 0, '2018-06-09 07:59:42', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0),
(10, 2, 0, 2, 0, 0, '', 0, 0, '4deff54975d0a94bb1aef6cbd200aab7', 0, '2018-06-15 15:19:48', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0),
(11, 2, 0, 4, 0, 0, '', 0, 0, '5742069af358296f8fc4b0d9324f89d3', 0, '2018-06-15 18:18:28', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0),
(12, 3, 0, 1, 0, 0, '', 0, 0, 'b1b82fe92df8630a1fdfc6c97d298f61', 0, '2018-11-22 00:43:07', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0),
(13, 1, 0, 1, 0, 0, '', 0, 0, '120a6b292039c871c126eb7fa831f1be', 0, '2018-11-22 00:43:26', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0),
(14, 2, 0, 1, 0, 0, '', 0, 0, 'bbfca5c7facab20ed795f4b10f71f024', 0, '2018-12-08 17:07:19', '::1', '0000-00-00 00:00:00', '', '0000-00-00', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `color_tbl`
--

CREATE TABLE `color_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `color_code` varchar(30) NOT NULL,
  `color_class` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(40) NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Login User ID',
  `created_role` int(11) NOT NULL DEFAULT '1' COMMENT '1 : Admin',
  `activation_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color_tbl`
--

INSERT INTO `color_tbl` (`id`, `title`, `color_code`, `color_class`, `created_date`, `created_ipaddress`, `created_by`, `created_role`, `activation_status`) VALUES
(1, 'red', '', '', '2018-04-29 19:40:55', '::1', 1, 1, 1),
(2, 'green', '', '', '2018-04-29 19:40:55', '::1', 1, 1, 1),
(3, 'blue', '', '', '2018-04-29 19:40:55', '::1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contactus_tbl`
--

CREATE TABLE `contactus_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `city` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_role` tinyint(4) NOT NULL COMMENT '2- user/viewer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactus_tbl`
--

INSERT INTO `contactus_tbl` (`id`, `name`, `email`, `mobile`, `city`, `message`, `created_date`, `created_role`) VALUES
(1, 'achari', 'achari@gmail.com', '9888888888', 'Hyderabad', 'Hi', '2017-06-21 23:15:31', 2),
(2, 'hi', 'hello@gmail.com', '8888888888', 'Hyd', 'testing\r\n', '2017-06-21 23:21:19', 2),
(3, 'asdasd', 'asd@gmail.com', '9888888888', 'asdasd', 'asdasd', '2017-06-21 23:25:45', 2),
(4, 'asdasd', 'asdasd@gmail.com', '8999999999', 'SDASD', 'ASDASD', '2017-06-21 23:27:31', 2),
(5, 'hi', 'ho@gmail.com', '8999999999', 'hi', 'asdasd', '2017-06-21 23:28:34', 2),
(6, 'leela', 'mleela07@gmail.com', '7878787878', 'hyderabad', 'hhbj', '2017-07-19 14:10:34', 2),
(7, 'ihj', 'vh@gmail.com', '7878787878', 'hyderabadhg', 'jhfhm', '2017-07-19 15:34:42', 2);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_tbl`
--

CREATE TABLE `coupon_tbl` (
  `id` int(11) NOT NULL,
  `CouponCode` varchar(300) NOT NULL,
  `OfferValue` int(11) NOT NULL,
  `flag_status` tinyint(4) NOT NULL DEFAULT '1',
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon_tbl`
--

INSERT INTO `coupon_tbl` (`id`, `CouponCode`, `OfferValue`, `flag_status`, `expire_date`) VALUES
(1, 'COUPON1', 30, 1, '0000-00-00'),
(2, 'COUPON2', 100, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_tbl`
--

CREATE TABLE `dashboard_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `column_name` varchar(100) NOT NULL,
  `total_result` int(11) NOT NULL,
  `active_result` int(11) NOT NULL,
  `inactive_result` int(11) NOT NULL,
  `link` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `class_name` varchar(200) NOT NULL,
  `priority` int(11) NOT NULL,
  `created_ipaddress` varchar(60) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dashboard_tbl`
--

INSERT INTO `dashboard_tbl` (`id`, `title`, `table_name`, `column_name`, `total_result`, `active_result`, `inactive_result`, `link`, `icon`, `class_name`, `priority`, `created_ipaddress`, `created_date`) VALUES
(1, 'menu', 'menu_tbl', 'activation_status', 0, 0, 0, 'Categories/menu', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-danger', 1, '192.168.1.22', '2016-05-09 18:54:58'),
(2, 'sub menu', 'submenu_tbl', 'activation_status', 0, 0, 0, 'Categories/subMenu', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-success', 2, '192.168.1.22', '2016-05-09 18:57:04'),
(3, 'list sub menu', 'listsubmenu_tbl', 'activation_status', 0, 0, 0, 'Categories/listSubMenu', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-radius offer-primary', 3, '192.168.1.22', '2016-05-10 10:17:42'),
(4, 'advisers', 'advisory_tbl', 'activation_status', 0, 0, 0, 'Cms/advisoryboard', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-danger', 7, '192.168.1.22', '2016-05-09 18:54:58'),
(5, 'artists', 'artist_tbl', 'activation_status', 0, 0, 0, 'Other/artist', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-success', 4, '192.168.1.22', '2016-05-09 18:57:04'),
(6, 'show\'s', 'shows_tbl', 'activation_status', 0, 0, 0, 'Other/shows', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-radius offer-primary', 5, '192.168.1.22', '2016-05-10 10:17:42'),
(7, 'FAQ\'s', 'faq_tbl', 'activation_status', 0, 0, 0, 'Cms/faq', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-danger', 6, '192.168.1.22', '2016-05-09 18:54:58'),
(8, 'testimonial\'s', 'testimonials_tbl', 'activation_status', 0, 0, 0, 'Cms/testimonials', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-success', 8, '192.168.1.22', '2016-05-09 18:57:04'),
(9, 'size\'s', 'size_tbl', 'activation_status', 0, 0, 0, 'Settings/size', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-success', 9, '192.168.1.22', '2016-05-09 18:57:04'),
(10, 'slider\'s', 'slider_tbl', 'activation_status', 0, 0, 0, 'Settings/slider', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-success', 10, '192.168.1.22', '2016-05-09 18:57:04'),
(11, 'user\'s', 'users_tbl', 'activation_status', 0, 0, 0, '', 'glyphicon glyphicon glyphicon-eye-open', 'offer offer-success', 11, '192.168.1.22', '2016-05-09 18:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_comment_tbl`
--

CREATE TABLE `enquiry_comment_tbl` (
  `id` int(11) NOT NULL,
  `enq_id` int(11) NOT NULL,
  `enq_comment` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry_comment_tbl`
--

INSERT INTO `enquiry_comment_tbl` (`id`, `enq_id`, `enq_comment`, `created_date`) VALUES
(1, 2, 'I enquired today.', '2017-06-18 18:00:47'),
(2, 2, 'test', '2017-06-21 23:43:23'),
(3, 3, 'Hi this is testing', '2017-06-21 23:46:30'),
(4, 8, 'hggf', '2017-07-19 16:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `faq_tbl`
--

CREATE TABLE `faq_tbl` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'login id',
  `created_role` int(11) NOT NULL COMMENT '1-Admin',
  `activation_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq_tbl`
--

INSERT INTO `faq_tbl` (`id`, `question`, `answer`, `created_date`, `created_by`, `created_role`, `activation_status`) VALUES
(1, 'Tesing', 'THis is sample', '2017-06-21 23:30:37', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `listsubmenu_tbl`
--

CREATE TABLE `listsubmenu_tbl` (
  `id` int(11) NOT NULL,
  `submenu_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `icon` varchar(80) NOT NULL,
  `app_icon` varchar(80) NOT NULL,
  `image` varchar(80) NOT NULL,
  `priority` int(11) NOT NULL,
  `activation_status` tinyint(4) NOT NULL COMMENT '1 : active & 0 : In-active',
  `front_enable` tinyint(4) NOT NULL COMMENT '1 : active & 0 : In-active',
  `front_activation_status` tinyint(4) NOT NULL COMMENT '1 : active & 0 : In-active',
  `created_date` datetime NOT NULL,
  `created_ip_address` varchar(60) NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Login User ID',
  `created_role` int(11) NOT NULL COMMENT '1 : admin',
  `commission_charges` double NOT NULL,
  `fixed_charges` double NOT NULL,
  `insurance` double NOT NULL,
  `shipping_charges` double NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listsubmenu_tbl`
--

INSERT INTO `listsubmenu_tbl` (`id`, `submenu_id`, `title`, `icon`, `app_icon`, `image`, `priority`, `activation_status`, `front_enable`, `front_activation_status`, `created_date`, `created_ip_address`, `created_by`, `created_role`, `commission_charges`, `fixed_charges`, `insurance`, `shipping_charges`, `trash`) VALUES
(1, 1, 'Wheels', '', '', '', 0, 1, 0, 0, '2018-04-29 15:13:42', '::1', 1, 1, 0, 0, 0, 0, 0),
(2, 1, 'Mirrors', '', '', '', 0, 1, 0, 0, '2018-04-29 15:13:55', '::1', 1, 1, 0, 0, 0, 0, 0),
(3, 1, 'Lights', '', '', '', 0, 1, 0, 0, '2018-04-29 15:14:17', '::1', 1, 1, 0, 0, 0, 0, 0),
(4, 1, 'Audio brewing', '', '', '', 0, 1, 0, 0, '2018-04-29 15:14:37', '::1', 1, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_tbl`
--

CREATE TABLE `menu_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `menu_icon` varchar(80) DEFAULT NULL,
  `app_icon` varchar(80) NOT NULL,
  `image` varchar(80) DEFAULT NULL,
  `priority` int(11) NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 : Active  0 : Inactive, 5: Delete',
  `front_enable` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 : Active  0 : Inactive',
  `front_activation_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 : Active  0 : Inactive',
  `created_date` datetime NOT NULL,
  `created_ip_address` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Login user ID',
  `created_role` int(11) NOT NULL COMMENT '1 : Admin etc..',
  `trash` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_tbl`
--

INSERT INTO `menu_tbl` (`id`, `title`, `menu_icon`, `app_icon`, `image`, `priority`, `activation_status`, `front_enable`, `front_activation_status`, `created_date`, `created_ip_address`, `created_by`, `created_role`, `trash`) VALUES
(1, 'Accessories', '', '', '', 0, 1, 0, 0, '2018-04-29 15:11:08', '::1', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `model_tbl`
--

CREATE TABLE `model_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(40) NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Login User ID',
  `created_role` int(11) NOT NULL DEFAULT '1' COMMENT '1 : Admin',
  `activation_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model_tbl`
--

INSERT INTO `model_tbl` (`id`, `title`, `created_date`, `created_ipaddress`, `created_by`, `created_role`, `activation_status`) VALUES
(1, 'Suzuki', '2018-04-29 20:20:50', '::1', 1, 1, 1),
(2, 'Maruthi', '2018-04-29 20:20:50', '::1', 1, 1, 1),
(3, 'Honda ', '2018-04-29 20:20:50', '::1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_tbl`
--

CREATE TABLE `newsletter_tbl` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `activation_status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ip_address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_tbl`
--

CREATE TABLE `notifications_tbl` (
  `id` int(11) NOT NULL,
  `emails` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(60) NOT NULL,
  `created_by` int(11) NOT NULL,
  `activation_status` int(11) NOT NULL DEFAULT '1',
  `subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications_tbl`
--

INSERT INTO `notifications_tbl` (`id`, `emails`, `description`, `image`, `created_date`, `created_ipaddress`, `created_by`, `activation_status`, `subject`) VALUES
(1, 'mleela07@gmail.com', 'arfgfg', '', '2017-07-19 17:23:20', '183.83.43.183', 1, 1, 'wert'),
(2, 'mleela07@gmail.com', 'dfg', '', '2017-07-19 17:24:21', '183.83.43.183', 1, 1, 'lll');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `payment_selection_type` varchar(40) NOT NULL,
  `cart_session` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ip_address` varchar(60) NOT NULL,
  `order_status` int(11) NOT NULL COMMENT '0 : order placed | 1 : Approved | 2 : Dispatched | 3 : cancelled  | 4 : returned',
  `payment_status` tinyint(4) NOT NULL DEFAULT '0',
  `order_payment_type` varchar(30) NOT NULL,
  `order_price` double NOT NULL,
  `shipping_charges` double NOT NULL,
  `order_total_price` double NOT NULL,
  `coupon_code` varchar(30) NOT NULL,
  `coupon_price` double NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `alt_mobile_number` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `landmark` varchar(60) NOT NULL,
  `city` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `country` varchar(80) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `order_created_date` datetime NOT NULL,
  `order_created_by` int(11) NOT NULL,
  `order_created_ipaddress` varchar(50) NOT NULL,
  `order_approved_date` datetime NOT NULL,
  `order_dispatch_date` datetime NOT NULL,
  `order_cancelled_date` datetime NOT NULL,
  `order_return_expected_date` date NOT NULL,
  `order_returned_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`id`, `order_number`, `order_qty`, `payment_selection_type`, `cart_session`, `created_date`, `created_ip_address`, `order_status`, `payment_status`, `order_payment_type`, `order_price`, `shipping_charges`, `order_total_price`, `coupon_code`, `coupon_price`, `user_name`, `email`, `mobile`, `alt_mobile_number`, `address`, `landmark`, `city`, `state`, `country`, `pincode`, `order_created_date`, `order_created_by`, `order_created_ipaddress`, `order_approved_date`, `order_dispatch_date`, `order_cancelled_date`, `order_return_expected_date`, `order_returned_date`) VALUES
(1, 'HAGO00000001', 1, 'Bank transfer / Deposit', '246f3c33426ee208edad070512fcb76b', '2017-06-21 22:58:32', '::1', 1, 1, 'Offline', 50000, 0, 50000, '', 0, 'venkateswara achari', 'achariphp@gmail.com', '+91-98888888888', '', 'this is address', 'madhapur', 'Hyderabad', '', 'India', '500081', '2017-06-21 22:58:32', 1, '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00 00:00:00'),
(2, 'HAGO00000002', 1, 'Online Transaction', '6791075b9de8da508c734213cd33c996', '2017-06-21 22:59:38', '::1', 0, 1, 'Offline', 500000, 0, 500000, '', 0, 'hi', 'hellow@gmail.com', '+91-98999999999', 'hi', 'this is address', 'madhapur', 'hydetabad', '', 'India', '500081', '2017-06-21 22:59:38', 1, '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00 00:00:00'),
(3, 'HAGO00000003', 1, 'Online Transaction', '30e63fa52919b2a1376efe05f66b80f5', '2017-06-21 23:51:41', '183.83.87.10', 1, 1, 'Offline', 50000, 0, 50000, '', 0, 'achari', 'achariphp@gmail.com', '+91-98888888888', '', 'ICICI bank,\r\nMadhapur,', 'madhapur', 'Hyderabad', '', 'India', '500081', '2017-06-21 23:51:41', 1, '183.83.87.10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00 00:00:00'),
(4, 'HAGO00000004', 1, 'Bank transfer / Deposit', '29809f694961e71fa9b6f06d30523777', '2017-07-19 14:49:17', '183.83.43.183', 0, 1, 'Offline', 500000, 0, 500000, '', 0, 'leela', 'mleela@gmail.com', '+91-7878787878', '', 'madhapur,hyderabad,500081', 'madhapur', 'hyderabad', '', 'India', '500081', '2017-07-19 14:49:17', 1, '183.83.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `price_turnover_tbl`
--

CREATE TABLE `price_turnover_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '1',
  `trash` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_turnover_tbl`
--

INSERT INTO `price_turnover_tbl` (`id`, `title`, `activation_status`, `trash`) VALUES
(2, '1 Lakh - 10 Lakhs', 1, 0),
(3, '10 Lakhs - 50  Lakhs ', 1, 0),
(4, '50 Lakhs - 1 Crore', 1, 0),
(5, 'above 1 Crore', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `producttype_tbl`
--

CREATE TABLE `producttype_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(40) NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Login User ID',
  `created_role` int(11) NOT NULL DEFAULT '1' COMMENT '1 : Admin',
  `activation_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producttype_tbl`
--

INSERT INTO `producttype_tbl` (`id`, `title`, `created_date`, `created_ipaddress`, `created_by`, `created_role`, `activation_status`) VALUES
(1, 'type 1', '2018-04-29 18:16:08', '::1', 1, 1, 1),
(2, 'type 2', '2018-04-29 18:16:08', '::1', 1, 1, 1),
(3, 'blue update', '2018-04-29 18:16:08', '::1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_compare_tbl`
--

CREATE TABLE `product_compare_tbl` (
  `compare_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_session` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ip_address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_compare_tbl`
--

INSERT INTO `product_compare_tbl` (`compare_id`, `product_id`, `cart_session`, `created_date`, `created_ip_address`) VALUES
(1, 5, 'b32b9d7ecce21679e8b71dda60329ec7', '2018-04-30 14:23:14', '::1'),
(2, 3, 'b32b9d7ecce21679e8b71dda60329ec7', '2018-04-30 14:41:15', '::1'),
(3, 3, 'b623645ab802c254e9f767cc6b897006', '2018-06-08 19:23:17', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `product_enquiry_tbl`
--

CREATE TABLE `product_enquiry_tbl` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_enquiry_tbl`
--

INSERT INTO `product_enquiry_tbl` (`id`, `product_id`, `name`, `email`, `mobile`, `message`, `created_date`, `created_ipaddress`) VALUES
(3, 9, 'achari php', 'achariphp@gmail.com', '8688941771', 'Achari testing...', '2017-06-21 23:44:27', '183.83.87.10');

-- --------------------------------------------------------

--
-- Table structure for table `product_images_tbl`
--

CREATE TABLE `product_images_tbl` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `activation_status` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_ipaddress` varchar(60) NOT NULL,
  `created_role` int(11) NOT NULL,
  `creation_type` int(11) NOT NULL COMMENT '1 - System 2 -BUlk upload'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images_tbl`
--

INSERT INTO `product_images_tbl` (`id`, `product_id`, `product_image`, `activation_status`, `priority`, `created_date`, `created_by`, `created_ipaddress`, `created_role`, `creation_type`) VALUES
(1, 2, 'product_7836e25a66a1388ebdff47673d856c8695b8530b.jpg', 0, 0, '2018-04-29 23:37:25', 1, '::1', 1, 0),
(2, 2, 'product_fb1ed5366594698f286c77e6656d1aa01b3f40dc.jpg', 0, 0, '2018-04-29 23:37:25', 1, '::1', 1, 0),
(3, 2, 'product_2690e2000bdafdefb06886b49b67f30cc747fd23.jpg', 0, 0, '2018-04-29 23:37:25', 1, '::1', 1, 0),
(4, 2, 'product_6d635cd742fa817d5bf49fe361782ad4dd04f1b0.jpg', 0, 0, '2018-04-29 23:37:25', 1, '::1', 1, 0),
(5, 3, 'product_42d2562ed62f735634bba356f149774072095af8.jpg', 0, 0, '2018-04-30 00:29:43', 1, '::1', 1, 0),
(6, 3, 'product_de34f20442b078a963c361ef9662ccd19d4ca9af.jpg', 0, 0, '2018-04-30 00:29:43', 1, '::1', 1, 0),
(7, 3, 'product_8f1e74907bb81c540d233315d8747ec5d5c5ce03.jpg', 0, 0, '2018-04-30 00:29:43', 1, '::1', 1, 0),
(8, 4, 'product_54f3123843e2e97c5f45f010b165370d8588edd5.jpg', 0, 0, '2018-04-30 00:30:55', 1, '::1', 1, 0),
(9, 4, 'product_ba8ed5722196f9fcc4ecf4b2a61df9273fa75885.jpg', 0, 0, '2018-04-30 00:30:55', 1, '::1', 1, 0),
(10, 4, 'product_c3c32200d073e357a89b1e614e94ef099640b4d0.jpg', 0, 0, '2018-04-30 00:30:55', 1, '::1', 1, 0),
(11, 5, 'product_004aa5b0acc0c1101ce44d46d5aeb17651f4751d.jpg', 0, 0, '2018-04-30 00:32:07', 1, '::1', 1, 0),
(12, 5, 'product_7a726c00f7b903a427d8c72668b86e35d07480c9.jpg', 0, 0, '2018-04-30 00:32:07', 1, '::1', 1, 0),
(13, 5, 'product_450adc04190121a1508a2f1f453474895649b5ce.jpg', 0, 0, '2018-04-30 00:32:07', 1, '::1', 1, 0),
(14, 5, 'product_57eafc6e0addd478f74644b2f38a49ca0fca3e29.jpg', 0, 0, '2018-04-30 00:32:07', 1, '::1', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_promotiontype_tbl`
--

CREATE TABLE `product_promotiontype_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `activation_status` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_promotiontype_tbl`
--

INSERT INTO `product_promotiontype_tbl` (`id`, `title`, `activation_status`, `created_date`) VALUES
(1, 'New', 1, '0000-00-00 00:00:00'),
(2, 'Featured', 1, '2016-04-24 00:00:00'),
(3, 'Clearance', 1, '2016-04-24 00:00:00'),
(4, 'Sale', 1, '2016-04-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews_tbl`
--

CREATE TABLE `product_reviews_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(1) NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'product id',
  `rating` int(11) NOT NULL,
  `product_comment` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `buy_status` int(11) NOT NULL DEFAULT '0' COMMENT '1-for available, 0-for others',
  `activation_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_status`
--

INSERT INTO `product_status` (`id`, `title`, `buy_status`, `activation_status`, `created_date`) VALUES
(1, 'Available', 1, 1, '2016-04-24 00:00:00'),
(2, 'Sold', 0, 1, '2016-04-24 00:00:00'),
(3, 'Not for sale', 0, 1, '2016-04-24 00:00:00'),
(4, 'On-hold', 0, 1, '2016-04-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `id` int(11) NOT NULL,
  `submenu_id` int(11) NOT NULL,
  `list_submenu_id` int(11) NOT NULL,
  `product_code` varchar(40) NOT NULL,
  `product_sku_code` varchar(40) NOT NULL,
  `product_name` varchar(80) NOT NULL,
  `mrp_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `product_original_image` varchar(200) NOT NULL,
  `activation_status` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(60) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_role` int(11) NOT NULL,
  `product_last_updated_date` datetime NOT NULL,
  `product_updated_by` int(11) NOT NULL,
  `search_keywords` text NOT NULL,
  `product_visits` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_type` int(11) NOT NULL DEFAULT '0',
  `model` int(11) NOT NULL DEFAULT '0',
  `color` int(11) NOT NULL DEFAULT '0',
  `shape` int(11) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL DEFAULT '0',
  `promotion_featured` int(11) NOT NULL DEFAULT '0',
  `promotion_latest` int(11) NOT NULL DEFAULT '0',
  `promotion_bestselling` int(11) NOT NULL DEFAULT '0',
  `promotion_newselling` int(11) NOT NULL DEFAULT '0',
  `product_label` varchar(20) NOT NULL,
  `customisation_status` int(11) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0',
  `shipping_days` int(11) NOT NULL DEFAULT '2',
  `shipping_charges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`id`, `submenu_id`, `list_submenu_id`, `product_code`, `product_sku_code`, `product_name`, `mrp_price`, `selling_price`, `product_description`, `product_image`, `product_original_image`, `activation_status`, `created_date`, `created_ipaddress`, `created_by`, `created_role`, `product_last_updated_date`, `product_updated_by`, `search_keywords`, `product_visits`, `brand_id`, `product_type`, `model`, `color`, `shape`, `stock`, `promotion_featured`, `promotion_latest`, `promotion_bestselling`, `promotion_newselling`, `product_label`, `customisation_status`, `rating`, `shipping_days`, `shipping_charges`) VALUES
(1, 1, 1, 'PD1', 'CARP1', 'Product 1', 3000, 2500, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'thumb_product_0ee3f3cd82b932aba5c0732a4af46a636061bd92.jpg', 'product_32134da9083c997b3fe9f12910d8130a216c3f5a.jpg', 1, '2018-04-29 23:31:32', '::1', 1, 1, '0000-00-00 00:00:00', 0, 'Product 1,', 0, 1, 3, 3, 3, 1, 20, 1, 1, 1, 1, '', 1, 0, 2, 0),
(2, 1, 2, 'M123', 'CARP2', 'Mirrors', 2000, 1500, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'thumb_product_dbb39cac902f14f342cee30b19064a937b595882.jpg', 'product_60688403ff815d903ffa7f1d720c3251bce022ed.jpg', 1, '2018-04-29 23:37:25', '::1', 1, 1, '0000-00-00 00:00:00', 0, 'Mirrors,', 0, 1, 3, 3, 3, 1, 300, 1, 1, 1, 1, '', 1, 0, 2, 0),
(3, 1, 2, 'Pdor2', 'CARP3', 'product 3', 200, 200, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'thumb_product_bba37f700fd6d8a30d45612e110bcbbad06f8636.jpg', 'product_45e1ae8f331f799d9d2a6ebe9351ebca950f1c65.jpg', 1, '2018-04-30 00:29:43', '::1', 1, 1, '0000-00-00 00:00:00', 0, 'product 3,', 0, 1, 3, 3, 3, 1, 20, 1, 1, 1, 1, '', 1, 0, 2, 0),
(4, 1, 1, 'Produt 4', 'CARP4', 'product 4', 400, 200, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'thumb_product_e14d43007a723ad963abe25c63299708861cfdf5.jpg', 'product_6bcabd652d7dc3aa42a75392d77e96e5e39f44ac.jpg', 1, '2018-04-30 00:30:55', '::1', 1, 1, '0000-00-00 00:00:00', 0, 'product 4,', 0, 1, 3, 3, 3, 1, 40, 1, 1, 1, 1, '', 1, 0, 2, 0),
(5, 1, 2, 'PD5', 'CARP5', 'product 5', 200, 100, 'this is descit[[[asd', 'thumb_product_7d134a0262c10fb7788a30bb94f8fb66d0c75e4a.jpg', 'product_dea9f682c7d7fdcfbf5e1c2d53edef76445723d4.jpg', 0, '2018-04-30 00:32:07', '::1', 1, 1, '0000-00-00 00:00:00', 0, 'product 5,', 0, 6, 1, 2, 2, 2, 10, 1, 1, 1, 1, '', 1, 0, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `seller_businessdetail_tbl`
--

CREATE TABLE `seller_businessdetail_tbl` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `company_name` varchar(80) NOT NULL,
  `company_email` varchar(80) NOT NULL,
  `state` varchar(60) NOT NULL,
  `city` varchar(60) NOT NULL,
  `pincode` varchar(8) NOT NULL,
  `contact_name` varchar(60) NOT NULL,
  `contact_email` varchar(60) NOT NULL,
  `contact_mobile` varchar(15) NOT NULL,
  `website_status` int(11) NOT NULL,
  `website_url` varchar(200) NOT NULL,
  `onlinemarketplace_status` int(11) NOT NULL,
  `onlinemarketplace_details` varchar(100) NOT NULL,
  `business_type` int(11) NOT NULL,
  `business_turnover` int(11) NOT NULL,
  `selling_categories` varchar(100) NOT NULL,
  `brands` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_ip_address` varchar(60) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ip_address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller_documents_tbl`
--

CREATE TABLE `seller_documents_tbl` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `vat_number` varchar(60) NOT NULL,
  `vat_image` varchar(80) NOT NULL,
  `vat_second_image` varchar(120) NOT NULL,
  `vat_third_image` varchar(120) NOT NULL,
  `pan_number` varchar(30) NOT NULL,
  `pan_image` varchar(40) NOT NULL,
  `bank_name` varchar(60) NOT NULL,
  `bank_account_number` varchar(60) NOT NULL,
  `bank_branch` varchar(60) NOT NULL,
  `ifsc_code` varchar(30) NOT NULL,
  `micr_number` varchar(30) NOT NULL,
  `cancellation_cheque` varchar(80) NOT NULL,
  `pickup_address` text NOT NULL,
  `return_address` text NOT NULL,
  `address_proof` varchar(80) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ip_address` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ip_address` varchar(50) NOT NULL,
  `vat_verification` tinyint(4) NOT NULL DEFAULT '0',
  `pancard_verification` tinyint(4) NOT NULL DEFAULT '0',
  `cancellationcheque_verification` tinyint(4) NOT NULL DEFAULT '0',
  `addressproof_verification` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller_user_tbl`
--

CREATE TABLE `seller_user_tbl` (
  `id` int(11) NOT NULL,
  `seller_profile_code` varchar(20) NOT NULL,
  `display_name` varchar(60) NOT NULL,
  `business_name` varchar(80) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `seller_security_password` varchar(80) NOT NULL,
  `seller_status` int(11) NOT NULL COMMENT '0 : Inactive | 1 : Active | 2 : email Verification | 3: Registration Steps |4 : Admin Approve | 5 : Self Account Blocking | 6 - Trash',
  `seller_steps_stage` int(11) NOT NULL,
  `email_verification_code` varchar(80) NOT NULL,
  `mobile_verification_code` varchar(80) NOT NULL,
  `forgotpassword_verifion_code` varchar(80) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ip_address` varchar(60) NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_login_ipaddress` varchar(60) NOT NULL,
  `business_ref_id` int(11) NOT NULL,
  `document_ref_id` int(11) NOT NULL,
  `tems_acceptance_date` datetime NOT NULL,
  `business_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shape_tbl`
--

CREATE TABLE `shape_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(60) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_role` int(11) NOT NULL COMMENT '1 : Admin',
  `trash` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 : In trash | 0 : Out of trash',
  `activation_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shape_tbl`
--

INSERT INTO `shape_tbl` (`id`, `title`, `icon`, `created_date`, `created_ipaddress`, `created_by`, `created_role`, `trash`, `activation_status`) VALUES
(1, 'Circle', '', '2018-04-29 17:06:38', '::1', 1, 1, 0, 1),
(2, 'Triagle asd', 'shape_09fcc361bb1216aae5e391b2007a1754b94cc985.png', '2018-04-29 17:13:45', '::1', 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shows_tbl`
--

CREATE TABLE `shows_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `artists_list` varchar(100) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `description` text NOT NULL,
  `venue` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `activation_status` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'login id',
  `created_role` int(11) NOT NULL COMMENT '1-admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shows_tbl`
--

INSERT INTO `shows_tbl` (`id`, `title`, `artists_list`, `startdate`, `enddate`, `description`, `venue`, `image`, `activation_status`, `created_date`, `created_by`, `created_role`) VALUES
(1, 'FIRST', '2,1', '2017-06-10 04:13:15', '2017-06-10 04:13:15', 'test', 'test', 'Show_da8e6b68d9c6ec37c1e1172d398e380a676aaff0.png', 1, '2017-06-10 16:13:51', 1, 1),
(2, 'Testing Show', '2,1', '2017-06-10 04:39:38', '2017-06-10 04:39:38', 'THis is testing show', 'THis is testing ', 'Show_04f6582430c7c7c51210eca178646c3fb072e7c3.png', 1, '2017-06-10 16:41:12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `show_artist_details_tbl`
--

CREATE TABLE `show_artist_details_tbl` (
  `id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `title` varchar(60) NOT NULL,
  `size` varchar(30) NOT NULL,
  `medium` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ip_address` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `show_assign_arts`
--

CREATE TABLE `show_assign_arts` (
  `id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `art_amount` double NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `show_status` int(11) NOT NULL DEFAULT '0',
  `art_selling_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Assinging Arts to the show';

--
-- Dumping data for table `show_assign_arts`
--

INSERT INTO `show_assign_arts` (`id`, `show_id`, `artist_id`, `art_id`, `art_amount`, `created_date`, `updated_date`, `show_status`, `art_selling_status`) VALUES
(1, 1, 1, 9, 0, '2017-06-10 18:00:15', '0000-00-00 00:00:00', 0, 0),
(2, 1, 1, 8, 0, '2017-06-10 18:00:15', '0000-00-00 00:00:00', 0, 0),
(3, 1, 1, 7, 0, '2017-06-10 18:00:15', '0000-00-00 00:00:00', 0, 0),
(4, 1, 1, 6, 500000, '2017-06-10 18:00:15', '0000-00-00 00:00:00', 0, 0),
(5, 1, 1, 5, 0, '2017-06-10 18:00:15', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `size_tbl`
--

CREATE TABLE `size_tbl` (
  `id` int(11) NOT NULL,
  `height` varchar(20) NOT NULL,
  `width` varchar(60) NOT NULL,
  `length` varchar(60) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ipaddress` varchar(40) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_role` int(11) NOT NULL,
  `trash` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 : In trash | 0 : Out Of trash',
  `activation_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slider_tbl`
--

CREATE TABLE `slider_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slider_image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `url_link` text NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 : In-Active || 1 : Active',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_role` int(11) NOT NULL,
  `created_ip_address` varchar(80) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider_tbl`
--

INSERT INTO `slider_tbl` (`id`, `title`, `slider_image`, `description`, `url_link`, `activation_status`, `created_date`, `created_by`, `created_role`, `created_ip_address`, `priority`) VALUES
(1, 'Slider 1', 'Slider_3f86125772898a9b0269572a5508a00508f53e95.jpg', 'slider 1', '', 1, '2018-04-29 15:07:07', 1, 1, '::1', 0),
(2, 'slider 2', 'Slider_a4593db9fc82ac1b525c8d371cef27357536efdf.jpg', '', '', 1, '2018-04-29 15:07:21', 1, 1, '::1', 0),
(3, 'slider 3', 'Slider_5eef08f9a792d8d987be13d264c8bc3f706b3b5c.jpg', '', '', 1, '2018-04-29 15:07:33', 1, 1, '::1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `state_tbl`
--

CREATE TABLE `state_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `countryid` varchar(10) NOT NULL,
  `statecode` varchar(25) NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `trash` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state_tbl`
--

INSERT INTO `state_tbl` (`id`, `title`, `countryid`, `statecode`, `activation_status`, `created_date`, `trash`) VALUES
(1, 'Andhra Pradesh', '101', 'AP ', 1, '0000-00-00 00:00:00', 0),
(2, 'Arunachal Pradesh', '101', 'AR', 1, '0000-00-00 00:00:00', 0),
(3, 'Assam', '101', 'AS', 1, '0000-00-00 00:00:00', 0),
(4, 'Bihar', '101', 'BR', 1, '0000-00-00 00:00:00', 0),
(5, 'Chattisgadh', '101', 'CT', 1, '0000-00-00 00:00:00', 0),
(6, 'Goa', '101', ' GA', 1, '0000-00-00 00:00:00', 0),
(7, 'Gujarat', '101', 'GJ', 1, '0000-00-00 00:00:00', 0),
(8, 'Haryana', '101', 'HR', 1, '0000-00-00 00:00:00', 0),
(9, 'Himachal pradesh', '101', 'HP', 1, '0000-00-00 00:00:00', 0),
(10, 'Jammu Kashmir', '101', 'JK', 1, '0000-00-00 00:00:00', 0),
(12, 'Jarkhand', '101', 'JH', 1, '0000-00-00 00:00:00', 0),
(13, 'Karnataka', '101', 'KA', 1, '0000-00-00 00:00:00', 0),
(14, 'Kerala', '101', 'KL', 1, '0000-00-00 00:00:00', 0),
(15, 'Madhya Pradesh', '101', 'MP', 1, '0000-00-00 00:00:00', 0),
(16, 'Maharashtra', '101', 'MH', 1, '0000-00-00 00:00:00', 0),
(17, 'Manipur', '101', 'MN', 1, '0000-00-00 00:00:00', 0),
(18, 'Meghalaya', '101', 'ML', 1, '0000-00-00 00:00:00', 0),
(19, 'Mizoram', '101', 'MZ', 1, '0000-00-00 00:00:00', 0),
(20, 'Nagaland', '101', 'NL', 1, '0000-00-00 00:00:00', 0),
(21, 'Orissa', '101', 'OR', 1, '0000-00-00 00:00:00', 0),
(22, 'Punjab', '101', 'PB', 1, '0000-00-00 00:00:00', 0),
(23, 'Rajasthan', '101', 'RJ', 1, '0000-00-00 00:00:00', 0),
(24, 'Sikkim', '101', 'SK', 1, '0000-00-00 00:00:00', 0),
(25, 'Tamil Nadu', '101', 'TN', 1, '0000-00-00 00:00:00', 0),
(26, 'Uttar Pradesh', '101', 'UP', 1, '0000-00-00 00:00:00', 0),
(27, 'Uttarakhand', '101', 'UT', 1, '0000-00-00 00:00:00', 0),
(28, 'West Bengal', '101', 'WB', 1, '0000-00-00 00:00:00', 0),
(29, 'Andaman And Nicobar islands ', '101', 'AN', 1, '0000-00-00 00:00:00', 0),
(30, 'Dadra nagar haveli ', '101', 'DN', 1, '0000-00-00 00:00:00', 0),
(31, 'Chandigarh', '101', 'CH', 1, '0000-00-00 00:00:00', 0),
(32, 'Daman Dhiu', '101', 'DD', 1, '0000-00-00 00:00:00', 0),
(33, 'Lakshwadweep ', '101', 'LD', 1, '0000-00-00 00:00:00', 0),
(34, 'Pondicherry', '101', 'PY', 1, '0000-00-00 00:00:00', 0),
(35, 'Delhi', '101', 'DL', 1, '0000-00-00 00:00:00', 0),
(36, 'Tripura', '101', 'TR', 1, '0000-00-00 00:00:00', 0),
(38, 'Telangana', '101', 'TG', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `submenu_tbl`
--

CREATE TABLE `submenu_tbl` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `icon` varchar(60) NOT NULL,
  `image` varchar(60) NOT NULL,
  `app_icon` varchar(60) NOT NULL,
  `priority` int(11) NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '1',
  `front_enable` tinyint(11) NOT NULL DEFAULT '0',
  `front_activation_status` tinyint(11) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_ip_address` varchar(60) NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Login Id',
  `created_role` int(11) NOT NULL COMMENT '1 : admin',
  `trash` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu_tbl`
--

INSERT INTO `submenu_tbl` (`id`, `menu_id`, `title`, `icon`, `image`, `app_icon`, `priority`, `activation_status`, `front_enable`, `front_activation_status`, `created_date`, `created_ip_address`, `created_by`, `created_role`, `trash`) VALUES
(1, 1, 'Interirior', '', '', '', 0, 1, 0, 0, '2018-04-29 15:11:42', '::1', 1, 1, 0),
(2, 1, 'Exterior', '', '', '', 0, 1, 0, 0, '2018-04-29 15:12:06', '::1', 1, 1, 0),
(3, 1, 'Parking Sensors', '', '', '', 0, 1, 0, 0, '2018-04-29 15:12:19', '::1', 1, 1, 0),
(4, 1, 'Covers', '', '', '', 0, 1, 0, 0, '2018-04-29 15:12:37', '::1', 1, 1, 0),
(5, 1, 'Lights', '', '', '', 0, 1, 0, 0, '2018-04-29 15:12:49', '::1', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_userlist_tbl`
--

CREATE TABLE `superadmin_userlist_tbl` (
  `id` int(11) NOT NULL,
  `admin_profile_code` varchar(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `display_name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `admin_secure_code` varchar(100) NOT NULL,
  `registration_verification_code` varchar(100) NOT NULL,
  `forgotpassword_verification_code` varchar(100) NOT NULL,
  `profile_status` int(11) NOT NULL COMMENT '0 : In- active | 1 : Active | 2 : Email Verification',
  `registered_date` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `role` int(11) NOT NULL,
  `role_access` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `pincode` varchar(7) NOT NULL,
  `online_status` tinyint(4) NOT NULL COMMENT '1 : Online - 0 : Off Line',
  `trash` tinyint(4) NOT NULL DEFAULT '0',
  `last_password_updateddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superadmin_userlist_tbl`
--

INSERT INTO `superadmin_userlist_tbl` (`id`, `admin_profile_code`, `name`, `display_name`, `email`, `mobile`, `admin_secure_code`, `registration_verification_code`, `forgotpassword_verification_code`, `profile_status`, `registered_date`, `last_login_date`, `role`, `role_access`, `state`, `city`, `area`, `pincode`, `online_status`, `trash`, `last_password_updateddate`) VALUES
(1, 'CAR', 'Admin', 'Admin', 'admin@cars.com', '8688941771', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '', '', 1, '2018-04-25 00:00:00', '2018-04-29 00:00:00', 1, '', 'Telangana', 'Hyderabad', 'Madhapur', '500081', 1, 0, '2018-04-25 18:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials_tbl`
--

CREATE TABLE `testimonials_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `commentdate` datetime NOT NULL,
  `comment` text NOT NULL,
  `picture` varchar(60) NOT NULL,
  `activation_status` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'login id',
  `created_role` tinyint(4) NOT NULL COMMENT '1-Admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials_tbl`
--

INSERT INTO `testimonials_tbl` (`id`, `title`, `username`, `commentdate`, `comment`, `picture`, `activation_status`, `created_date`, `created_by`, `created_role`) VALUES
(2, 'acceris', 'venkatesh', '2018-04-29 03:19:35', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'profilepic_c148825448d51fe2f76f7a06fd435f24812eb865.jpg', 1, '2018-04-29 15:20:28', 1, 1),
(3, 'Nice', 'Krish', '2018-04-29 03:20:33', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'profilepic_285f35fb6b76f3bcffcd8968cec08769e257267d.jpg', 1, '2018-04-29 15:20:56', 1, 1),
(5, 'Krishna', 'krishna', '2018-04-29 03:25:57', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'profilepic_90926d6795f50dc80f568c66deedce7971cd7ef4.jpg', 1, '2018-04-29 15:26:19', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `user_id` int(11) NOT NULL,
  `user_authtoken` varchar(70) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `user_security_code` varchar(70) NOT NULL,
  `verification_code` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `landmark` varchar(80) NOT NULL,
  `area` varchar(60) NOT NULL,
  `city` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `country` varchar(60) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `subscribe_status` tinyint(4) NOT NULL DEFAULT '0',
  `promotion_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `created_ipaddress` varchar(60) NOT NULL,
  `verified_on` datetime NOT NULL,
  `dateofbirth` date NOT NULL,
  `proifile_picutre` varchar(100) NOT NULL,
  `about_profile` varchar(500) NOT NULL,
  `intrests` varchar(200) NOT NULL,
  `portfolio_link` varchar(300) NOT NULL,
  `profile_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 : Blocked | 1 :  Active | 2 : In-active | 3 : Verification  | 4: forgot Req',
  `profile_feedback_note` text NOT NULL,
  `register_app` varchar(10) NOT NULL COMMENT 'web | api',
  `forgot_verification_code` varchar(20) NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_login_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='users info';

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`user_id`, `user_authtoken`, `user_name`, `first_name`, `middle_name`, `last_name`, `email_id`, `mobile_number`, `user_security_code`, `verification_code`, `address`, `landmark`, `area`, `city`, `state`, `country`, `pincode`, `subscribe_status`, `promotion_status`, `created_on`, `created_ipaddress`, `verified_on`, `dateofbirth`, `proifile_picutre`, `about_profile`, `intrests`, `portfolio_link`, `profile_status`, `profile_feedback_note`, `register_app`, `forgot_verification_code`, `last_updated_date`, `last_login_date`) VALUES
(1, 'c29575ee10341527f913351e481e60564ab13cf7', 'Venkatesh', '', '', '', 'achariphp@gmail.com', '8688941771', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '15191', '', '', '', '', '', '', '', 0, 0, '2018-05-03 06:54:57', '', '0000-00-00 00:00:00', '0000-00-00', '', '', '', '', 1, '', 'app', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '78634a71cbf0ef8ea07a25b6b5ba832f5a8c93c7', 'Ar', '', '', '', 'achari@gmail.com', '8688941772', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '274061', '', '', '', '', '', '', '', 0, 0, '2018-06-15 18:24:02', '', '0000-00-00 00:00:00', '0000-00-00', '', '', '', '', 1, '', 'app', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `address_id` int(11) NOT NULL,
  `address_auth_token` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `landmark` varchar(60) NOT NULL,
  `area` varchar(60) NOT NULL,
  `city` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `country` varchar(60) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `flag_status` tinyint(4) NOT NULL DEFAULT '1',
  `trash_status` tinyint(4) NOT NULL DEFAULT '0',
  `trash_created_on` datetime NOT NULL,
  `trash_cancelled_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User : Address List';

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_tbl`
--

CREATE TABLE `wishlist_tbl` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_session` varchar(80) NOT NULL,
  `ip_address` varchar(40) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist_tbl`
--

INSERT INTO `wishlist_tbl` (`id`, `product_id`, `user_id`, `cart_session`, `ip_address`, `created_date`) VALUES
(1, 6, 0, '', '124.123.0.100', '2017-04-05 10:36:09'),
(2, 7, 0, '', '124.123.0.100', '2017-04-05 10:36:13'),
(4, 6, 0, '', '183.83.47.53', '2017-04-05 13:58:45'),
(6, 7, 0, '', '::1', '2017-06-18 14:11:05'),
(10, 4, 0, '', '::1', '2017-06-18 14:11:19'),
(11, 2, 0, '', '::1', '2017-06-18 14:11:22'),
(12, 6, 0, '', '::1', '2017-06-21 23:14:06'),
(16, 17, 0, '', '183.83.43.183', '2017-07-19 17:18:24'),
(19, 15, 0, '', '183.83.43.183', '2017-07-20 14:09:50'),
(20, 1, 1, 'b32b9d7ecce21679e8b71dda60329ec7', '::1', '2018-04-30 14:25:07'),
(21, 4, 1, 'b32b9d7ecce21679e8b71dda60329ec7', '::1', '2018-04-30 14:26:00'),
(22, 5, 1, 'b32b9d7ecce21679e8b71dda60329ec7', '::1', '2018-04-30 21:09:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_tbl`
--
ALTER TABLE `address_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_bankdetails_tbl`
--
ALTER TABLE `admin_bankdetails_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_log_history_tbl`
--
ALTER TABLE `admin_log_history_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advisory_tbl`
--
ALTER TABLE `advisory_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist_tbl`
--
ALTER TABLE `artist_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_tbl`
--
ALTER TABLE `brand_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_type_list`
--
ALTER TABLE `business_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_tbl`
--
ALTER TABLE `color_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus_tbl`
--
ALTER TABLE `contactus_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_tbl`
--
ALTER TABLE `coupon_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboard_tbl`
--
ALTER TABLE `dashboard_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_comment_tbl`
--
ALTER TABLE `enquiry_comment_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_tbl`
--
ALTER TABLE `faq_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listsubmenu_tbl`
--
ALTER TABLE `listsubmenu_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_tbl`
--
ALTER TABLE `menu_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_tbl`
--
ALTER TABLE `model_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_tbl`
--
ALTER TABLE `newsletter_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_tbl`
--
ALTER TABLE `notifications_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_turnover_tbl`
--
ALTER TABLE `price_turnover_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `producttype_tbl`
--
ALTER TABLE `producttype_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_compare_tbl`
--
ALTER TABLE `product_compare_tbl`
  ADD PRIMARY KEY (`compare_id`);

--
-- Indexes for table `product_enquiry_tbl`
--
ALTER TABLE `product_enquiry_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images_tbl`
--
ALTER TABLE `product_images_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_promotiontype_tbl`
--
ALTER TABLE `product_promotiontype_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews_tbl`
--
ALTER TABLE `product_reviews_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_businessdetail_tbl`
--
ALTER TABLE `seller_businessdetail_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_documents_tbl`
--
ALTER TABLE `seller_documents_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_user_tbl`
--
ALTER TABLE `seller_user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shape_tbl`
--
ALTER TABLE `shape_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shows_tbl`
--
ALTER TABLE `shows_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `show_artist_details_tbl`
--
ALTER TABLE `show_artist_details_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `show_assign_arts`
--
ALTER TABLE `show_assign_arts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size_tbl`
--
ALTER TABLE `size_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_tbl`
--
ALTER TABLE `slider_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_tbl`
--
ALTER TABLE `state_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Countryid` (`countryid`);

--
-- Indexes for table `submenu_tbl`
--
ALTER TABLE `submenu_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superadmin_userlist_tbl`
--
ALTER TABLE `superadmin_userlist_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials_tbl`
--
ALTER TABLE `testimonials_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `wishlist_tbl`
--
ALTER TABLE `wishlist_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_tbl`
--
ALTER TABLE `address_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_bankdetails_tbl`
--
ALTER TABLE `admin_bankdetails_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_log_history_tbl`
--
ALTER TABLE `admin_log_history_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `advisory_tbl`
--
ALTER TABLE `advisory_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artist_tbl`
--
ALTER TABLE `artist_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brand_tbl`
--
ALTER TABLE `brand_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `business_type_list`
--
ALTER TABLE `business_type_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `color_tbl`
--
ALTER TABLE `color_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contactus_tbl`
--
ALTER TABLE `contactus_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `coupon_tbl`
--
ALTER TABLE `coupon_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dashboard_tbl`
--
ALTER TABLE `dashboard_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `enquiry_comment_tbl`
--
ALTER TABLE `enquiry_comment_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faq_tbl`
--
ALTER TABLE `faq_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `listsubmenu_tbl`
--
ALTER TABLE `listsubmenu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu_tbl`
--
ALTER TABLE `menu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `model_tbl`
--
ALTER TABLE `model_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newsletter_tbl`
--
ALTER TABLE `newsletter_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications_tbl`
--
ALTER TABLE `notifications_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `price_turnover_tbl`
--
ALTER TABLE `price_turnover_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `producttype_tbl`
--
ALTER TABLE `producttype_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_compare_tbl`
--
ALTER TABLE `product_compare_tbl`
  MODIFY `compare_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_enquiry_tbl`
--
ALTER TABLE `product_enquiry_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_images_tbl`
--
ALTER TABLE `product_images_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_promotiontype_tbl`
--
ALTER TABLE `product_promotiontype_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_reviews_tbl`
--
ALTER TABLE `product_reviews_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seller_businessdetail_tbl`
--
ALTER TABLE `seller_businessdetail_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_documents_tbl`
--
ALTER TABLE `seller_documents_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_user_tbl`
--
ALTER TABLE `seller_user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shape_tbl`
--
ALTER TABLE `shape_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shows_tbl`
--
ALTER TABLE `shows_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `show_artist_details_tbl`
--
ALTER TABLE `show_artist_details_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `show_assign_arts`
--
ALTER TABLE `show_assign_arts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `size_tbl`
--
ALTER TABLE `size_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider_tbl`
--
ALTER TABLE `slider_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `state_tbl`
--
ALTER TABLE `state_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `submenu_tbl`
--
ALTER TABLE `submenu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `superadmin_userlist_tbl`
--
ALTER TABLE `superadmin_userlist_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials_tbl`
--
ALTER TABLE `testimonials_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist_tbl`
--
ALTER TABLE `wishlist_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
