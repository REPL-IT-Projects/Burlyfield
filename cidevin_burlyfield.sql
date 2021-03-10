-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 19, 2020 at 04:45 PM
-- Server version: 5.7.31-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cidevin_burlyfield`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_commission`
--

CREATE TABLE `delivery_commission` (
  `int_glcode` int(11) NOT NULL,
  `fk_delivery` int(11) NOT NULL,
  `fk_order` int(11) NOT NULL,
  `var_amount` varchar(11) NOT NULL,
  `chr_status` char(11) NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_withdraw`
--

CREATE TABLE `delivery_withdraw` (
  `int_glcode` int(11) NOT NULL,
  `fk_delivery` int(11) NOT NULL,
  `var_amount` varchar(11) NOT NULL,
  `chr_status` char(11) NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_withdraw`
--

INSERT INTO `delivery_withdraw` (`int_glcode`, `fk_delivery`, `var_amount`, `chr_status`, `dt_createddate`) VALUES
(1, 19, '25', 'N', '2020-06-01 20:11:54'),
(2, 19, '50', 'N', '2020-06-03 20:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `mst_admin`
--

CREATE TABLE `mst_admin` (
  `int_glcode` int(11) NOT NULL,
  `var_username` varchar(255) NOT NULL,
  `var_email` varchar(255) NOT NULL,
  `var_password` varchar(255) NOT NULL,
  `cod_status` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_admin`
--

INSERT INTO `mst_admin` (`int_glcode`, `var_username`, `var_email`, `var_password`, `cod_status`) VALUES
(1, 'Admin', 'admin@burlyfield.com', '112086094093091118006010010', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `mst_applied_promocode`
--

CREATE TABLE `mst_applied_promocode` (
  `int_glcode` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_order` int(11) NOT NULL,
  `fk_promocode` varchar(50) NOT NULL,
  `discount_price` varchar(50) NOT NULL,
  `dt_createddate` datetime NOT NULL,
  `flag` char(11) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_applied_promocode`
--

INSERT INTO `mst_applied_promocode` (`int_glcode`, `fk_user`, `fk_order`, `fk_promocode`, `discount_price`, `dt_createddate`, `flag`) VALUES
(2, 9, 12, '1', '50.0', '2020-06-30 16:20:28', 'Y'),
(3, 11, 13, '1', '50.0', '2020-06-30 17:52:57', 'Y'),
(4, 18, 24, '10', '50.0', '2020-07-03 00:15:33', 'Y'),
(5, 2, 1, '12', '50.0', '2020-07-03 12:00:38', 'Y'),
(6, 1, 2, '14', '50.0', '2020-07-03 12:22:14', 'Y'),
(7, 3, 3, '15', '50.0', '2020-07-03 12:35:16', 'Y'),
(8, 4, 4, '18', '50.0', '2020-07-03 12:56:04', 'Y'),
(9, 2, 5, '19', '50.0', '2020-07-03 13:58:42', 'Y'),
(10, 6, 6, '22', '50.0', '2020-07-03 15:16:00', 'Y'),
(11, 4, 51, '5', '69.125', '2020-09-03 15:45:06', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `mst_blog`
--

CREATE TABLE `mst_blog` (
  `int_glcode` int(11) NOT NULL,
  `var_name` varchar(255) NOT NULL,
  `txt_description` text NOT NULL,
  `var_author` varchar(100) NOT NULL,
  `var_image` varchar(255) NOT NULL,
  `chr_delete` char(11) NOT NULL,
  `chr_publish` char(11) NOT NULL,
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_blog`
--

INSERT INTO `mst_blog` (`int_glcode`, `var_name`, `txt_description`, `var_author`, `var_image`, `chr_delete`, `chr_publish`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(1, 'Best things in your daily meals.', 'Praising will give you a completed take a trivial sed example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with man sed who chooses to enjoy.', '', '16000856431.jpg', 'N', 'Y', '2020-09-14 17:42:04', '2020-09-14 18:20:46', '45.126.147.4'),
(2, 'Interesting facts about organic food', 'Praising will give you a completed take a trivial sed example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with man sed who chooses to enjoy.', '', '1600855286blogimg1.png', 'N', 'Y', '2020-09-14 17:46:43', '2020-09-23 15:31:26', '103.37.181.185'),
(3, 'Interesting facts about organic store.', 'All this mistaken idea of denouncing pleasure and praising pain was born and I will give you seds our complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.', 'Ram Charan', '1600855268blogimg.png', 'N', 'Y', '2020-09-14 17:48:31', '2020-09-28 18:15:17', '43.248.38.186'),
(4, 'web testing ', 'testbnm ,ddff dkfdlkfmkss', 'REPL', '1601986466nes.jpg', 'N', 'Y', '2020-10-06 17:44:26', '2020-10-06 17:44:26', '116.72.81.201');

-- --------------------------------------------------------

--
-- Table structure for table `mst_category`
--

CREATE TABLE `mst_category` (
  `int_glcode` int(11) NOT NULL,
  `fk_parent` int(11) NOT NULL,
  `var_title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_icon` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `chr_publish` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `chr_delete` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_category`
--

INSERT INTO `mst_category` (`int_glcode`, `fk_parent`, `var_title`, `var_icon`, `chr_publish`, `chr_delete`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(14, 0, 'Supergrain Flours', '1601901966SupergrainFloursPage.jpg', 'Y', 'N', '2019-09-29 15:37:51', '2020-10-05 18:16:06', '152.57.107.22'),
(15, 0, 'Healthy Herbs', '1601365086(4)HealthyHerbsPage.jpg', 'Y', 'N', '2019-09-29 15:38:17', '2020-09-29 13:08:06', '157.33.153.249'),
(16, 0, 'Refreshing Beverages', '1601382152(5)RefreshingBeveragesPage.jpg', 'Y', 'N', '2019-09-29 15:38:36', '2020-09-29 17:52:32', '49.35.193.253'),
(17, 0, 'Nutritious Ready Meals', '1601382183(3)NutritiousReadyMealsPage.jpg', 'Y', 'N', '2019-09-29 15:38:51', '2020-09-29 17:53:03', '49.35.193.253'),
(18, 0, 'Super Combos', '1601382212(1)SuperCompoPage.jpg', 'Y', 'N', '2020-01-31 15:41:25', '2020-09-29 17:53:32', '49.35.193.253'),
(27, 0, 'Sweets and Snacks', '1589301255wow.png', 'Y', 'Y', '2020-05-12 22:04:15', '2020-05-12 22:04:15', '49.207.128.93'),
(28, 0, 'Other', '1600942867OthersProductPage.jpg', 'Y', 'Y', '2020-09-24 15:51:07', '2020-09-24 15:56:26', '106.193.184.94');

-- --------------------------------------------------------

--
-- Table structure for table `mst_contact_us`
--

CREATE TABLE `mst_contact_us` (
  `int_glcode` int(11) NOT NULL,
  `var_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `var_email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_subject` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `var_phone` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `var_message` text COLLATE latin1_general_ci NOT NULL,
  `dt_createddate` datetime NOT NULL,
  `var_ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_contact_us`
--

INSERT INTO `mst_contact_us` (`int_glcode`, `var_name`, `var_email`, `var_subject`, `var_phone`, `var_message`, `dt_createddate`, `var_ipaddress`) VALUES
(1, 'Grishma', 'grishma.conceptioni@gmail.com', 'Vruits Regarding', '7410258933', 'Testing Vruits', '2019-09-18 12:48:23', '43.243.39.143'),
(2, 'Grishma', 'grishma.conceptioni@gmail.com', 'Order', '7896541230', 'Order related Query', '2019-09-18 12:50:42', '43.243.39.143'),
(3, 'Sujal Soni', 'sujal@conceptioni.com', 'Low Quality Fruits', '8751479523', 'Last day i order fruits from website and got very low quality fruits from you. Now i ant money refund asap. ', '2019-09-19 18:04:55', '43.243.39.143'),
(4, 'Micheal Jackson', 'MJ@gmail.com', 'Low Quality Fruits', '7227880146', 'Last day i order fruits from website and got very low quality fruits from you. Now i ant money refund asap. ', '2019-09-19 18:40:12', '43.243.39.143'),
(5, 'Grishma', 'grishma.conceptioni@gmail.com', 'Orders', '7069747475', 'I have query for order related , please display helping number on your site.', '2019-09-20 11:32:12', '43.243.38.123'),
(6, 'Grishma', 'grishma.conceptioni@gmail.com', 'Vruits', '7069858587', 'Thank for ordering ', '2019-09-20 11:55:22', '43.243.38.123'),
(7, 'Grishma', 'grishma.conceptioni@gmail.com', 'Shopping', '7412058963', 'I have issue when purchasing some products.', '2019-09-26 19:00:38', '43.243.38.100'),
(32, 'pradnya shroff', 'pradnyashroff@gmail.com', 'for test', '9112237805', 'looks good website', '2020-09-20 16:01:38', '116.72.233.122'),
(9, 'Grishma', 'grishma.conceptioni@gmail.com', 'sadasd', '3242342343', 'rdfdfdf', '2019-09-26 19:16:06', '43.243.38.100'),
(10, 'asas', 'grishma.conceptioni@gmail.com', 'sd', '9389324798', 'dhfiusdf', '2019-09-26 19:18:02', '43.243.38.100'),
(11, 'sasd', 'grishma.conceptioni@gmail.com', 'dfsdf', '3747364732', 'ifgifg', '2019-09-26 19:20:16', '43.243.38.100'),
(12, 'dfsdfdf', 'grishma.conceptioni@gmail.com', 'dfn', '3847897856', 'dfsdffds', '2019-09-26 19:21:57', '43.243.38.100'),
(13, 'Grishma', 'grishma.conceptioni@gmail.com', 'Shopping', '7896541023', 'I have query for order', '2019-09-27 11:34:30', '43.243.38.61'),
(14, 'Grishma', 'grishma.conceptioni@gmail.com', 'Shopping', '7410258963', 'Hello', '2019-09-27 11:40:15', '43.243.38.61'),
(15, 'chirag', 'chirag@cidev.com', 'abcd', '8752963741', 'demo', '2020-09-14 16:10:11', '45.126.147.4'),
(22, 'testbyci', 'badal@gmail.com', 'test', '7227880146', 'tesrt', '2020-09-14 16:46:37', '43.243.37.66'),
(31, 'nites', 'nitesh@gmail.com', 'demo', '9632541255', 'test', '2020-09-15 15:47:18', '103.17.81.241'),
(33, 'pradnya shroff', 'pradnyashroff@gmail.com', 'for test', '9112237805', 'looks good website', '2020-09-20 16:01:40', '116.72.233.122'),
(34, 'pradnya shroff', 'pradnyashroff@gmail.com', 'for test', '7418529632', 'looks good website', '2020-09-24 12:28:49', '116.72.95.164'),
(35, 'pradnya shroff', 'pradnyashroff@gmail.com', 'for test', '7418529632', 'looks good website', '2020-09-24 12:28:50', '116.72.95.164'),
(36, 'pradnya shroff', 'pradnyashroff@gmail.com', 'for test', '7418529632', 'looks good website', '2020-09-24 12:28:50', '116.72.95.164'),
(37, 'pradnya shroff', 'pradnyashroff@gmail.com', 'for test', '8055416655', 'looks good website', '2020-09-24 12:37:49', '116.72.95.164'),
(51, 'name', 'email@gmail.com', 'sub', '8527410963', 'msg', '2020-09-24 18:31:39', '103.37.183.24'),
(52, 'name', 'email@gmail.com', 'sub', '8527410963', 'msg', '2020-09-24 18:33:29', '103.37.183.24'),
(53, 'demo', 'demo@gmail.com', 'test', '7410526320', 'msg', '2020-09-24 18:34:11', '103.37.183.24'),
(54, 'chirag', 'chirag@gmail.com', 'abcd', '9638520741', 'test', '2020-09-25 10:14:25', '45.126.146.219'),
(55, 'renuka', 'r@gmail.com', 'test', '9876789098', 'test', '2020-09-28 16:54:12', '157.33.133.184'),
(56, 'renuka', 'r@gmail.com', 'test', '9876789098', 'test', '2020-09-28 16:54:26', '157.33.133.184'),
(57, 'REPL', 'ppshroff@ruchagroup.com', 'testing', '9112237805', 'test purpose', '2020-09-30 11:29:33', '202.149.217.178'),
(58, 'REPL', 'ppshroff@ruchagroup.com', 'testing', '9112237805', 'test purpose', '2020-09-30 11:29:36', '202.149.217.178'),
(59, 'sayali', 'marketing@burlyfield.com', 'test', '1234512345', 'test message', '2020-09-30 15:42:31', '106.193.187.20'),
(60, 'sayali', 'marketing@burlyfield.com', 'test', '1234512345', 'test message', '2020-09-30 15:42:33', '106.193.187.20'),
(61, 'sayali', 'marketing@burlyfield.com', 'test', '1234512345', 'test message', '2020-09-30 15:42:34', '106.193.187.20'),
(62, 'sayali', 'marketing@burlyfield.com', 'test', '1234512345', 'test message', '2020-09-30 15:42:35', '106.193.187.20'),
(63, 'sayali', 'marketing@burlyfield.com', 'test', '1234512345', 'test message', '2020-09-30 15:42:36', '106.193.187.20'),
(64, 'sayali', 'marketing@burlyfield.com', 'test', '1234512345', 'test message', '2020-09-30 15:42:37', '106.193.187.20'),
(65, 'sayali', 'marketing@burlyfield.com', 'test', '8055158177', 'test message', '2020-09-30 15:46:38', '106.193.187.20'),
(66, 'sayali', 'marketing@burlyfield.com', 'test', '8055158177', 'test message', '2020-09-30 15:46:39', '106.193.187.20'),
(67, 'sayali', 'marketing@burlyfield.com', 'test', '8055158177', 'test message', '2020-09-30 15:46:40', '106.193.187.20'),
(68, 'sayali', 'marketing@burlyfield.com', 'test', '8055158177', 'test message', '2020-09-30 15:46:40', '106.193.187.20'),
(69, 'sayali', 'marketing@burlyfield.com', 'test', '8055158177', 'test message', '2020-09-30 15:46:40', '106.193.187.20'),
(70, 'sayali', 'marketing@burlyfield.com', 'test', '8055158177', 'test message', '2020-09-30 15:46:41', '106.193.187.20'),
(71, 'sayali', 'marketing@burlyfield.com', 'test', '8055158177', 'test message', '2020-09-30 15:46:41', '106.193.187.20'),
(72, 'sayali', 'marketing@burlyfield.com', 'test', '8055158177', 'test message', '2020-09-30 15:46:41', '106.193.187.20'),
(73, 'sayali', 'marketing@burlyfield.com', 'test', '8055158177', 'test message', '2020-09-30 15:46:45', '106.193.187.20'),
(74, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:31', '202.149.217.178'),
(75, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:33', '202.149.217.178'),
(76, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:33', '202.149.217.178'),
(77, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:33', '202.149.217.178'),
(78, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:33', '202.149.217.178'),
(79, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:33', '202.149.217.178'),
(80, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:33', '202.149.217.178'),
(81, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:34', '202.149.217.178'),
(82, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:34', '202.149.217.178'),
(83, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:34', '202.149.217.178'),
(84, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:34', '202.149.217.178'),
(85, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:34', '202.149.217.178'),
(86, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:34', '202.149.217.178'),
(87, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:41', '202.149.217.178'),
(88, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:41', '202.149.217.178'),
(89, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:41', '202.149.217.178'),
(90, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:42', '202.149.217.178'),
(91, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:42', '202.149.217.178'),
(92, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:42', '202.149.217.178'),
(93, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:42', '202.149.217.178'),
(94, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:42', '202.149.217.178'),
(95, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:42', '202.149.217.178'),
(96, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:43', '202.149.217.178'),
(97, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:44', '202.149.217.178'),
(98, 'Kaustubh', 'kakhadke@ruchagroup.com', 'hello', '8149181700', 'hello syscort', '2020-09-30 16:14:44', '202.149.217.178'),
(100, 'chirag', 'test@demo.com', 'abcd', '8754129634', 'abc', '2020-10-01 15:03:26', '139.5.22.143'),
(101, 'chirag', 'test@demo.com', 'abcd', '8754129634', 'abcddewfwef', '2020-10-01 15:04:37', '139.5.22.143'),
(102, 'demo', 'demo@final', 'dswd', '8945213078', 'cwvwv', '2020-10-01 15:13:26', '139.5.22.143'),
(103, 'demo', 'demo@final', 'dswd', '8945213078', 'cwvwv', '2020-10-01 15:13:31', '139.5.22.143'),
(104, 'demo', 'demo@final', 'dswd', '8945213078', 'cwvwv', '2020-10-01 15:14:53', '139.5.22.143'),
(105, 'final', 'final@done.com', 'done', '9632014752', 'done', '2020-10-01 15:20:37', '139.5.22.143'),
(106, 'renuka', 'r@mail.com', 'test', '9878976545', 'test', '2020-10-05 10:34:30', '152.57.107.22'),
(107, 'renuka', 'r@gmail.com', 'test', '9876789876', 'test', '2020-10-05 10:35:38', '152.57.107.22'),
(110, 'demo', 'demo@gmail.com', 'demo', '8758999230', 'demo', '2020-10-05 10:49:27', '139.5.22.3'),
(109, 'Test', 'Test@gmail.com', 'Test', '8758999135', 'Test', '2020-10-05 10:47:30', '139.5.22.3'),
(111, 'final', 'final@gmail.com', 'demo', '8754213213', 'msg', '2020-10-05 10:57:59', '139.5.22.3'),
(112, 'demo2', 'demo2@gmail.com', 'demo2', '9865451230', 'abcd', '2020-10-05 11:04:48', '139.5.22.3'),
(113, 'funal', 'final@gmail.com', 'demo', '8526987410', 'Test', '2020-10-05 11:06:14', '139.5.22.3'),
(114, 'abc', 'abc@mail.com', 'test', '9878976543', 'test', '2020-10-05 15:15:30', '152.57.107.22'),
(115, 'Pradnya', 'ppshroff@ruchagroup.com', 'test msg ', '9112237805', 'test', '2020-10-06 16:02:57', '116.72.81.201'),
(116, 'mis', 'mis@ruchagroup.com', 'mail test', '9785225999', 'test ', '2020-10-06 16:33:43', '116.72.81.201'),
(117, 'mis', 'marketing@burlyfield.com', 'huiii', '7412589632', 'shsadkskadas ', '2020-10-06 16:36:41', '116.72.81.201'),
(118, 'test', 'test@gmail.com', 'abcd', '7412685258', 'test', '2020-10-07 10:06:38', '103.17.83.161'),
(119, 'test', 'test@gmail.com', 'SADG', '9714673116', 'hi', '2020-10-07 17:04:05', '43.243.37.89'),
(120, 'Pradnya', 'ppshroff@ruchagroup.com', 'test msg ', '9112237805', 'tetst', '2020-10-08 10:39:22', '116.72.80.33'),
(121, 'Pankaj Kumar', 'pk@gmail.com', 'test mail', '8898998887', 'njanenwn', '2020-10-09 20:52:07', '116.73.83.215'),
(122, 'Chirag', 'chirag@cidev.in', 'demo', '8758999123', 'Test', '2020-10-10 18:14:35', '103.37.181.179'),
(123, 'Demo', 'demo@gmail.com', 'demo', '7452852525', 'Test', '2020-10-10 18:19:29', '103.37.181.179');

-- --------------------------------------------------------

--
-- Table structure for table `mst_delivery_boy`
--

CREATE TABLE `mst_delivery_boy` (
  `int_glcode` int(11) NOT NULL,
  `fk_vendor` int(11) NOT NULL,
  `var_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_mobile_no` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `chr_status` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'U',
  `current_status` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'F',
  `var_profile` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `var_aadharcard` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `var_aadharcard2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `var_pancard` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `var_device_token` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `chr_publish` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `chr_delete` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_delivery_boy`
--

INSERT INTO `mst_delivery_boy` (`int_glcode`, `fk_vendor`, `var_name`, `var_email`, `var_mobile_no`, `var_password`, `chr_status`, `current_status`, `var_profile`, `var_aadharcard`, `var_aadharcard2`, `var_pancard`, `var_device_token`, `chr_publish`, `chr_delete`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(1, 1, 'Test ', 'testbyconceptioni@gmail.com', '7069747475', '021084065071116004004004', 'U', 'F', '1568448586vege.jpg', '1568448586vegetable.png', '1568448586images.jpg', '1568448586images.jpg', 'cNItO-3lGSE:APA91bGlAW1URaOjI-Z4uwnAvAdmI1CbHeqRRcns9wG-5K0zr7ii6AYZ9dIIWQWZMXbsQXmUSFgH2DGkH889ZIJE8Xwn6PMmK5NaKim3_rVFcHqStDq5318hhObQZ2y0KumKlanz2nuM', 'Y', 'N', '2019-09-14 13:39:46', '2019-09-14 13:39:46', '43.243.38.101'),
(3, 3, 'panku', 'pankajpaaal@gmail.com', '7045923870', '099085091093086082121001120122116', 'U', 'F', '', '156994636915699463643411.png', '156994636915699463643412.png', '156994636915699463643413.png', 'ddGC_3WJCgc:APA91bEEhuAMQ8PZBq9VE6nAC_1zZw1Nw_oMXyAgChsZvTq4E_7VP9LFs_UUK0SyndIrtFKFeaYRtSgIcGdsYRo9rdC3l8QlicSN9YeNQgEZ299939BoGoRKLLBMK2Q9KVFWonQ1OjXu', 'Y', 'N', '2019-10-01 21:42:49', '2019-10-01 21:42:49', ''),
(2, 1, 'Shyam', 'shyam@gmail.com', '7221478965', '098090074085088118006010010', 'Y', 'F', '1568448681images.jpg', '1568448681platewithfruitsvector18742134.jpg', '1568448681images.jpg', '1568448681apple.jpg', '', 'Y', 'N', '2019-09-14 13:41:21', '2019-09-14 13:41:21', '43.243.38.101'),
(4, 4, 'pankaj', 'santoshngupta90@gmail.com', '9137089833', '012068095081085092003002', 'U', 'F', '', '157002522915700252203301.png', '', '157002522915700252203303.png', '', 'Y', 'N', '2019-10-02 19:37:09', '2019-10-02 19:37:09', ''),
(5, 2, 'Test', 'test@gmail.com', '7227880146', '021084065071116004004004', 'U', 'F', '', '157008624915700862443131.png', '157008625015700862443132.png', '157008625015700862443133.png', '', 'Y', 'N', '2019-10-03 12:34:10', '2019-10-03 12:34:10', '');

-- --------------------------------------------------------

--
-- Table structure for table `mst_delivery_charges`
--

CREATE TABLE `mst_delivery_charges` (
  `int_glcode` int(11) NOT NULL,
  `var_charges` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `var_above` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `var_below` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_within_time` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `chr_type` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'S',
  `var_label` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_delivery_charges`
--

INSERT INTO `mst_delivery_charges` (`int_glcode`, `var_charges`, `var_above`, `var_below`, `var_within_time`, `chr_type`, `var_label`) VALUES
(1, '60', '0', '1000', 'Within the next  delivery slot', 'F', 'SUPER FAST');

-- --------------------------------------------------------

--
-- Table structure for table `mst_delivery_timeslot`
--

CREATE TABLE `mst_delivery_timeslot` (
  `int_glcode` int(11) NOT NULL,
  `dt_start_time` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dt_end_time` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dt_slot_end_time` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `chr_type` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'S',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_delivery_timeslot`
--

INSERT INTO `mst_delivery_timeslot` (`int_glcode`, `dt_start_time`, `dt_end_time`, `dt_slot_end_time`, `chr_type`, `dt_createddate`, `dt_modifydate`) VALUES
(1, '09:00 am', '10:00 am', '08:00', 'S', '2019-08-31 11:59:19', '2019-08-31 11:59:19'),
(2, '10:00 am', '12:00 pm', '09:00', 'S', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '12:00 pm', '02:00 pm', '12:00', 'S', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '05:00 pm', '07:00 pm', '16:00', 'S', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '07:00 pm', '09:00 pm', '18:30', 'S', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '09:00 pm', '10:00 pm', '20:00', 'S', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '09:00 am', '01:00 pm', '13:00', 'U', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '05:00 pm', '09:00 pm', '21:00', '', '2019-10-02 21:26:10', '2019-10-02 21:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `mst_feedback`
--

CREATE TABLE `mst_feedback` (
  `int_glcode` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `var_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_message` text COLLATE latin1_general_ci NOT NULL,
  `dt_createddate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_feedback`
--

INSERT INTO `mst_feedback` (`int_glcode`, `fk_user`, `var_name`, `var_message`, `dt_createddate`) VALUES
(4, 5, 'Grishma Conception I', 'vruites very is a very nice application', '2019-09-20 11:39:05'),
(2, 3, 'Grishma', 'Testing Feedback vruits.', '2019-09-18 14:40:54'),
(3, 3, 'Grishma Conception I', 'hey', '2019-09-18 16:09:53'),
(5, 5, 'Grishma Conception I', 'Nice application for users.', '2019-09-27 11:42:43'),
(6, 5, 'Grishma Conception I', 'hwjdnw', '2019-09-27 11:43:05'),
(7, 5, 'Grishma Conception I', 'test', '2019-09-27 11:43:27'),
(8, 3, 'Grishma', 'Testing Feedback vruits.', '2019-09-27 11:44:37'),
(9, 5, 'Grishma Conception I', 'he', '2019-09-27 11:48:02'),
(10, 5, 'Grishma Conception I', 'test', '2019-09-27 11:49:08'),
(11, 2, 'Santosh', 'Hello', '2019-09-30 11:58:48'),
(12, 27, 'Kirthika Suryah', 'great', '2020-04-30 12:46:18'),
(13, 27, 'Kirthika Suryah', 'great', '2020-04-30 12:46:20'),
(14, 27, 'Kirthika Suryah', 'ok', '2020-04-30 19:49:20'),
(15, 27, 'Kirthika Suryah', 'good', '2020-05-02 22:17:30'),
(16, 5, 'Grishma Conception I', 'gghhj', '2020-05-04 19:26:32'),
(17, 5, 'Grishma Conception I', 'gghhj', '2020-05-04 19:28:36'),
(18, 5, 'Grishma Conception I', 'test', '2020-05-04 19:29:04'),
(19, 5, 'Grishma Conception I', 'test', '2020-05-04 19:29:27'),
(20, 28, 'Pradeep', 'qwe', '2020-05-04 22:00:03'),
(21, 27, 'Kirthika Suryah', 'hi', '2020-05-04 22:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `mst_home_banners`
--

CREATE TABLE `mst_home_banners` (
  `int_glcode` int(11) NOT NULL,
  `fk_category` int(11) NOT NULL,
  `var_title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `txt_description` text COLLATE latin1_general_ci NOT NULL,
  `var_image` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `offer` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `chr_publish` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `chr_delete` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_home_banners`
--

INSERT INTO `mst_home_banners` (`int_glcode`, `fk_category`, `var_title`, `txt_description`, `var_image`, `offer`, `chr_publish`, `chr_delete`, `dt_createddate`, `var_ipaddress`) VALUES
(10, 0, 'Our Motto!', 'On Time delivery and freshness of product is Our Motto!', '1600851768HomePage(3).jpg', '', 'Y', 'N', '2019-10-03 10:16:20', '103.37.181.185'),
(11, 0, 'Our Goal!', 'Our every customer eats fresh and eats healthy, Stays fresh and stays healthy. Our customer can now give more time to their family and to themselves.', '1600851748HomePage(2).jpg', '', 'Y', 'N', '2019-10-03 10:17:18', '103.37.181.185'),
(12, 0, 'Our Vision!', 'To deliver handpicked, fresh, hygienic and on time fruits and vegetables at customers doorstep.\r\n\r\nTo bring your local market to your home and make that time free for you to utilize for your own self.', '1600851727HomePage(1).jpg', '', 'Y', 'N', '2019-10-03 10:18:34', '103.37.181.185'),
(13, 15, 'FOR ALL TEAS', 'All healthy herbilicious teas are up for grabs at flat 10% discount. Now enjoy the monsoon with your favourite cup of warm tea.\"\"\"\"', '1601093061offerimg.png', '10', 'N', 'N', '2020-09-25 19:08:13', '45.126.145.74'),
(14, 18, 'FOR HERBS COMBO', 'We know your love for our healthy herbs and that is why we have brought this divine herb combo at a special price.\"', '1601093209offerimg1.png', '15', 'N', 'N', '2020-09-25 19:09:09', '45.126.145.74');

-- --------------------------------------------------------

--
-- Table structure for table `mst_logmanager`
--

CREATE TABLE `mst_logmanager` (
  `int_glcode` int(11) NOT NULL,
  `fk_admin` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `fk_vendor` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `chr_mode` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dt_createddate` date NOT NULL,
  `var_ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_logmanager`
--

INSERT INTO `mst_logmanager` (`int_glcode`, `fk_admin`, `fk_vendor`, `chr_mode`, `dt_createddate`, `var_ipaddress`) VALUES
(1, 'Santosh', 'pankaj pal', 'Add', '2019-10-01', '58.84.60.154'),
(2, 'Santosh', 'Santosh Gupta', 'Add', '2019-10-01', '58.84.60.154'),
(3, 'Santosh', 'Santosh Gupta', 'Delete', '2019-10-03', '58.84.60.154'),
(4, 'Santosh', 'pankaj pal', 'Delete', '2019-10-03', '58.84.60.154'),
(5, 'Pankaj', 'Siya', 'Add', '2019-10-18', '43.243.38.37'),
(6, 'Admin', 'Ben\'s Independent Grocer', 'Update', '2020-04-14', '42.106.30.228'),
(7, 'Admin', 'Sam\'s Groceria', 'Update', '2020-04-14', '42.106.30.228'),
(8, 'Admin', 'Modern Store Indian Grocery (New Outlet)', 'Update', '2020-04-14', '42.106.30.228'),
(9, 'Admin', 'Ben\'s Independent Grocer', 'Update', '2020-04-30', '49.207.134.58'),
(10, 'Admin', 'Ben\'s Independent Grocer', 'Update', '2020-04-30', '49.207.134.58'),
(11, 'Admin', 'Ben\'s Independent Grocer', 'Update', '2020-04-30', '49.207.134.58'),
(12, 'Admin', 'Ben\'s Independent Grocer', 'Update', '2020-04-30', '49.207.134.58'),
(13, 'Admin', 'Modern Store Indian Grocery (New Outlet)', 'Update', '2020-04-30', '49.207.134.58'),
(14, 'Admin', 'hsecjfhsjd', 'Add', '2020-04-30', '49.207.134.58'),
(15, 'Admin', 'gsedhjs', 'Add', '2020-04-30', '49.207.134.58'),
(16, 'Admin', 'hsecjfhsjd', 'Delete', '2020-04-30', '49.207.134.58'),
(17, 'Admin', 'gsedhjs', 'Update', '2020-04-30', '49.207.134.58'),
(18, 'Admin', 'Kirthika', 'Add', '2020-05-03', '49.207.131.108'),
(19, 'Admin', 'Kirthika', 'Update', '2020-05-03', '49.207.131.108'),
(20, 'Admin', 'gsedhjs', 'Delete', '2020-05-03', '49.207.131.108'),
(21, 'Admin', 'Pradeep', 'Add', '2020-05-03', '49.207.131.108'),
(22, 'Admin', 'Pradeep', 'Update', '2020-05-03', '49.207.131.108'),
(23, 'Admin', 'Modern Store Indian Grocery (New Outlet)', 'Update', '2020-05-07', '42.111.115.69'),
(24, 'Admin', 'Suryah', 'Add', '2020-05-12', '49.207.128.93'),
(25, 'Admin', 'Suryah', 'Update', '2020-05-14', '49.207.128.93'),
(26, 'Admin', 'Suryah', 'Update', '2020-05-15', '49.207.142.1'),
(27, 'Admin', 'Suryah', 'Update', '2020-05-15', '49.207.142.1'),
(28, 'Admin', 'Testing purpose', 'Add', '2020-05-15', '49.207.142.1');

-- --------------------------------------------------------

--
-- Table structure for table `mst_news`
--

CREATE TABLE `mst_news` (
  `int_glcode` int(11) NOT NULL,
  `var_name` varchar(255) NOT NULL,
  `txt_description` text NOT NULL,
  `var_image` varchar(255) NOT NULL,
  `chr_delete` char(11) NOT NULL,
  `chr_publish` char(11) NOT NULL,
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_news`
--

INSERT INTO `mst_news` (`int_glcode`, `var_name`, `txt_description`, `var_image`, `chr_delete`, `chr_publish`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(1, 'Best things in your daily meals.', 'Praising will give you a completed take a trivial sed example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with man sed who chooses to enjoy.', '16000856431.jpg', 'N', 'N', '2020-09-14 17:42:04', '2020-09-14 18:20:46', '45.126.147.4'),
(2, 'Interesting facts about organic food', 'Praising will give you a completed take a trivial sed example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with man sed who chooses to enjoy.', '1600855286blogimg1.png', 'N', 'N', '2020-09-14 17:46:43', '2020-09-23 15:31:26', '103.37.181.185'),
(3, 'Interesting facts about organic store.', 'All this mistaken idea of denouncing pleasure and praising pain was born and I will give you seds our complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.', '1600855268blogimg.png', 'N', 'Y', '2020-09-14 17:48:31', '2020-09-23 15:31:08', '103.37.181.185'),
(4, 'demo', 'wow Joragar', '16009233290.jpg', 'Y', 'Y', '2020-09-24 10:25:29', '2020-09-24 10:25:51', '103.37.183.24'),
(5, 'launch website', 'launch website', '1601986319nes.jpg', 'N', 'Y', '2020-10-06 17:41:59', '2020-10-06 17:41:59', '116.72.81.201'),
(6, 'TESTING', 'TEST', '1602051336BurlyFieldFoodsWebsite(5).1522.jpg', 'N', 'Y', '2020-10-07 11:45:36', '2020-10-07 11:45:36', '157.33.177.132'),
(7, 'web testion', 'tuywkdkw sdoas,m id djjda s ', '1602134805avatar3.png', 'N', 'Y', '2020-10-08 10:56:45', '2020-10-08 10:56:45', '116.72.80.33');

-- --------------------------------------------------------

--
-- Table structure for table `mst_newsletter`
--

CREATE TABLE `mst_newsletter` (
  `int_glcode` int(11) NOT NULL,
  `var_email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dt_createddate` datetime NOT NULL,
  `chr_delete` char(11) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `var_ipaddress` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_newsletter`
--

INSERT INTO `mst_newsletter` (`int_glcode`, `var_email`, `dt_createddate`, `chr_delete`, `var_ipaddress`) VALUES
(1, 'badal.conceptioni@gmail.com', '2019-07-25 16:25:05', 'Y', '195.201.175.80'),
(2, 'badal.conceptioni@gmail.com', '2019-09-18 18:52:27', 'Y', '195.201.175.80'),
(3, 'badal.conceptioni@gmail.com', '2019-09-18 19:02:34', 'N', '195.201.175.80'),
(4, 'grishma.conceptioni@gmail.com', '2019-09-20 11:34:26', 'N', '195.201.175.80'),
(5, 'grishma.conceptioni@gmail.com', '2019-09-27 11:47:32', 'N', '195.201.175.80'),
(6, 'grishma.conceptioni@gmail.com', '2019-09-27 11:49:51', 'N', '195.201.175.80'),
(7, 'grishma.conceptioni@gmail.com', '2019-09-27 12:31:22', 'N', '195.201.175.80'),
(8, 'grishma.conceptioni@gmail.com', '2019-09-27 17:17:39', 'N', '195.201.175.80'),
(9, 'grishma.conceptioni@gmail.com', '2019-09-27 17:27:51', 'N', '195.201.175.80'),
(10, 'grishma.conceptioni@gmail.com', '2019-09-27 17:39:00', 'N', '195.201.175.80'),
(11, 'grishma.conceptioni@gmail.com', '2019-09-27 17:41:20', 'N', '195.201.175.80'),
(12, 'grishma.conceptioni@gmail.com', '2019-09-27 19:04:46', 'N', '195.201.175.80'),
(13, 'grishma.conceptioni@gmail.com', '2019-10-07 10:29:57', 'N', '195.201.175.80'),
(14, 'grishma.conceptioni@gmail.com', '2019-10-07 10:54:12', 'N', '195.201.175.80'),
(15, 'grishma.conceptioni@gmail.com', '2019-10-07 10:56:12', 'N', '195.201.175.80'),
(16, 'grishma.conceptioni@gmail.com', '2019-10-07 11:02:46', 'N', '195.201.175.80'),
(17, 'grishma.conceptioni@gmail.com', '2019-10-07 12:24:54', 'N', '195.201.175.80'),
(18, 'grishma.conceptioni@gmail.com', '2019-10-07 12:27:19', 'N', '195.201.175.80'),
(19, 'grishma.conceptioni@gmail.com', '2019-10-07 12:28:11', 'N', '195.201.175.80'),
(20, 'grishma.conceptioni@gmail.com', '2019-10-07 12:28:45', 'N', '195.201.175.80'),
(21, 'grishma.conceptioni@gmail.com', '2019-10-07 12:58:27', 'N', '195.201.175.80'),
(22, 'grishma.conceptioni@gmail.com', '2019-10-07 12:58:41', 'N', '195.201.175.80'),
(23, 'grishma.conceptioni@gmail.com', '2019-10-07 12:59:02', 'N', '195.201.175.80'),
(24, 'grishma.conceptioni@gmail.com', '2019-10-09 10:46:43', 'N', '195.201.175.80'),
(25, 'ppshroff@ruchagroup.com', '2020-09-20 15:54:35', 'N', '159.69.73.38'),
(26, 'ppshroff@ruchagroup.com', '2020-09-24 12:29:32', 'N', '159.69.73.38'),
(27, 'renuka.soni@syscort.com', '2020-09-25 14:13:13', 'N', '159.69.73.38'),
(28, 'renuka.soni@syscort.com', '2020-09-26 09:22:33', 'N', '159.69.73.38'),
(29, 'renuka.soni@syscort.com', '2020-09-28 11:40:09', 'N', '159.69.73.38'),
(30, 'renuka.soni@syscort.com', '2020-09-28 16:48:26', 'N', '159.69.73.38'),
(31, 'renuka.soni@syscort.com', '2020-09-28 16:48:57', 'N', '159.69.73.38'),
(32, 'renuka.soni@syscort.com', '2020-09-29 13:02:51', 'N', '159.69.73.38'),
(33, 'marketing@burlydield.com', '2020-09-30 15:43:45', 'N', '159.69.73.38'),
(34, 'ppshroff@ruchagroup.com', '2020-09-30 16:04:52', 'N', '159.69.73.38'),
(35, 'marketing@burlyfield.com', '2020-09-30 16:09:21', 'N', '159.69.73.38'),
(36, 'ppshroff@ruchagroup.com', '2020-10-06 16:04:44', 'N', '159.69.73.38'),
(37, 'mis@ruchagroup.com', '2020-10-06 16:21:02', 'N', '159.69.73.38');

-- --------------------------------------------------------

--
-- Table structure for table `mst_orders`
--

CREATE TABLE `mst_orders` (
  `int_glcode` int(11) NOT NULL,
  `order_id` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_vendor` int(11) NOT NULL,
  `fk_delivery` int(11) NOT NULL,
  `fk_product_arr` text CHARACTER SET utf8 NOT NULL,
  `customize_arr` text COLLATE latin1_general_ci NOT NULL,
  `var_payment_mode` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `chr_status` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_user_address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `dt_timeslot` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `chr_delivery_status` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'S',
  `dt_delivery_date` date NOT NULL,
  `register_contact` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_alternate_mobile` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_address_type` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_delivery_charge` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_wallet_amount` varchar(11) COLLATE latin1_general_ci NOT NULL,
  `var_discount_amount` varchar(11) COLLATE latin1_general_ci NOT NULL,
  `var_total_amount` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_payable_amount` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `convience_fee` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `gst_price` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_cashback` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_promocode` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_transaction_id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `canceled_by` varchar(11) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `shipping_date` date NOT NULL,
  `var_courier` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_tracking` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `chr_delete` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_orders`
--

INSERT INTO `mst_orders` (`int_glcode`, `order_id`, `fk_user`, `fk_vendor`, `fk_delivery`, `fk_product_arr`, `customize_arr`, `var_payment_mode`, `chr_status`, `var_user_address`, `dt_timeslot`, `chr_delivery_status`, `dt_delivery_date`, `register_contact`, `var_alternate_mobile`, `var_address_type`, `var_delivery_charge`, `var_wallet_amount`, `var_discount_amount`, `var_total_amount`, `var_payable_amount`, `convience_fee`, `gst_price`, `var_cashback`, `var_promocode`, `var_transaction_id`, `canceled_by`, `shipping_date`, `var_courier`, `var_tracking`, `chr_delete`, `dt_createddate`, `var_ipaddress`) VALUES
(1, 'ORD000001', 5, 1, 0, '[{\"fk_product\":\"37\",\"var_name\":\"Cluster Beans \\/ \\u0917\\u094d\\u0935\\u093e\\u0930\\u092b\\u0932\\u0940 \\/ \\u0917\\u0935\\u093e\\u0930\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"2\",\"cancel_status\":\"N\"},{\"fk_product\":\"36\",\"var_name\":\"Cauliflower \\/ \\u092b\\u0942\\u0932\\u0917\\u094b\\u092d\\u0940 \\/ \\u092b\\u094d\\u0932\\u0949\\u0935\\u0930\\u094d\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"1\",\"cancel_status\":\"N\"},{\"fk_product\":\"31\",\"var_name\":\"Bitter Gourd \\/ \\u0915\\u0930\\u0947\\u0932\\u093e \\/ \\u0915\\u093e\\u0930\\u0932\\u0947\",\"var_quantity\":\"500 GM\",\"var_price\":\"20\",\"var_unit\":\"1\",\"cancel_status\":\"N\"},{\"fk_product\":\"30\",\"var_name\":\"Beetroot \\/ \\u091a\\u0941\\u0915\\u0902\\u0926\\u0930 \\/ \\u092c\\u0940\\u091f\",\"var_quantity\":\"250 GM\",\"var_price\":\"20\",\"var_unit\":\"1\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '', '7069747475', 'Home', '0.0', '0.0', '1.0', '600.0', '599.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-08 17:21:51', ''),
(2, 'ORD000002', 5, 2, 0, '[{\"fk_product\":\"52\",\"var_name\":\"Jackfruit \\/ \\u0915\\u091f\\u0939\\u0932 \\/ \\u092b\\u0923\\u0938\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"2\",\"cancel_status\":\"N\"},{\"fk_product\":\"54\",\"var_name\":\"Mint Leaves \\/ \\u092a\\u0941\\u0926\\u0940\\u0928\\u093e\",\"var_quantity\":\"1 Bundle\",\"var_price\":\"10\",\"var_unit\":\"2\",\"cancel_status\":\"N\"},{\"fk_product\":\"53\",\"var_name\":\"Lady Finger \\/ \\u092d\\u093f\\u0902\\u0921\\u0940 \\/ \\u092d\\u0947\\u0902\\u0921\\u0940\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"3\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '', '7069747475', 'Home', '0.0', '0.0', '1.0', '600.0', '599.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-07 17:21:51', ''),
(3, 'ORD000003', 83, 5, 0, '[{\"fk_product\":\"84\",\"var_name\":\"Raw Mango \\/ \\u0915\\u0948\\u0930\\u0940\",\"var_quantity\":\"1 KG\",\"var_price\":\"100\",\"var_unit\":\"3\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '', '7069747475', 'Home', '0.0', '0.0', '1.0', '600.0', '599.0', '', '', '0.0', '', '', 'U', '0000-00-00', '', '', 'N', '2020-05-07 17:21:51', ''),
(4, 'ORD000004', 27, 1, 0, '[{\"fk_product\":\"30\",\"var_name\":\"Beetroot \\/ \\u091a\\u0941\\u0915\\u0902\\u0926\\u0930 \\/ \\u092c\\u0940\\u091f\",\"var_quantity\":\"250 GM\",\"var_price\":\"20\",\"var_unit\":\"1\",\"cancel_status\":\"N\"},{\"fk_product\":\"31\",\"var_name\":\"Bitter Gourd \\/ \\u0915\\u0930\\u0947\\u0932\\u093e \\/ \\u0915\\u093e\\u0930\\u0932\\u0947\",\"var_quantity\":\"500 GM\",\"var_price\":\"20\",\"var_unit\":\"1\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', '2c 2nd floor Jamls a, Vadapalani Vadapalani, ,\n278,\nChennai - 600026,\nTamil Nadu, India', '', '', '0000-00-00', '', '9894447000', 'Home', '0.0', '0.0', '1.0', '240.0', '239.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-08 21:36:08', ''),
(5, 'ORD000005', 27, 5, 0, '[{\"fk_product\":\"108\",\"var_name\":\"Clothes\",\"var_quantity\":\"1 pcs\",\"var_price\":\"200\",\"var_unit\":\"1\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', '2c 2nd floor Jamls a, Vadapalani Vadapalani, ,\n278,\nChennai - 600026,\nTamil Nadu, India', '', '', '0000-00-00', '', '9894447000', 'Home', '0.0', '0.0', '1.0', '240.0', '239.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-08 21:36:08', ''),
(6, 'ORD000006', 27, 1, 0, '[{\"fk_product\":\"35\",\"var_name\":\"Carrot \\/ \\u0917\\u093e\\u091c\\u0930\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"1\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '67 Thoas, 67 Thoas, Bangalore City Railway Station Gubbi Thotadappa Rd, Kempegowda, Gandhi Nagar, ,\nKempegowda Bus Station,\nBengaluru - 560023,\nKarnataka, India', '', '', '0000-00-00', '', '9894447000', 'Home', '0.0', '0.0', '0.0', '70.0', '70.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-08 21:50:54', ''),
(7, 'ORD000007', 27, 2, 0, '[{\"fk_product\":\"51\",\"var_name\":\"Groundnut \\/ \\u092e\\u0942\\u0901\\u0917\\u092b\\u0932\\u0940 \\/ \\u0936\\u0947\\u0902\\u0917\\u0926\\u093e\\u0923\\u093e\",\"var_quantity\":\"500 GM\",\"var_price\":\"40\",\"var_unit\":\"1\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '67 Thoas, 67 Thoas, Bangalore City Railway Station Gubbi Thotadappa Rd, Kempegowda, Gandhi Nagar, ,\nKempegowda Bus Station,\nBengaluru - 560023,\nKarnataka, India', '', '', '0000-00-00', '', '9894447000', 'Home', '0.0', '0.0', '0.0', '70.0', '70.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-08 21:50:54', ''),
(8, 'ORD000008', 27, 1, 0, '[{\"fk_product\":\"31\",\"var_name\":\"Bitter Gourd \\/ \\u0915\\u0930\\u0947\\u0932\\u093e \\/ \\u0915\\u093e\\u0930\\u0932\\u0947\",\"var_quantity\":\"500 GM\",\"var_price\":\"20\",\"var_unit\":\"1\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', '67 Thoas, 67 Thoas, Bangalore City Railway Station Gubbi Thotadappa Rd, Kempegowda, Gandhi Nagar, ,\nKempegowda Bus Station,\nBengaluru - 560023,\nKarnataka, India', '', '', '0000-00-00', '', '9894447000', 'Home', '0.0', '0.0', '0.0', '20.0', '20.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-08 22:09:45', ''),
(9, 'ORD000009', 27, 1, 0, '[{\"fk_product\":\"43\",\"var_name\":\"Brinjal \\/ \\u092c\\u0948\\u0902\\u0917\\u0928 \\/ \\u0935\\u093e\\u0902\\u0917\\u0940\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"1\",\"cancel_status\":\"N\"},{\"fk_product\":\"37\",\"var_name\":\"Cluster Beans \\/ \\u0917\\u094d\\u0935\\u093e\\u0930\\u092b\\u0932\\u0940 \\/ \\u0917\\u0935\\u093e\\u0930\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"1\",\"cancel_status\":\"N\"},{\"fk_product\":\"36\",\"var_name\":\"Cauliflower \\/ \\u092b\\u0942\\u0932\\u0917\\u094b\\u092d\\u0940 \\/ \\u092b\\u094d\\u0932\\u0949\\u0935\\u0930\\u094d\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"1\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', '67 Thoas, 67 Thoas, Bangalore City Railway Station Gubbi Thotadappa Rd, Kempegowda, Gandhi Nagar, ,\nKempegowda Bus Station,\nBengaluru - 560023,\nKarnataka, India', '', '', '0000-00-00', '', '9894447000', 'Home', '0.0', '0.0', '0.0', '90.0', '90.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-09 12:53:24', ''),
(10, 'ORD000010', 28, 1, 0, '[{\"fk_product\":\"31\",\"var_name\":\"Bitter Gourd \\/ \\u0915\\u0930\\u0947\\u0932\\u093e \\/ \\u0915\\u093e\\u0930\\u0932\\u0947\",\"var_quantity\":\"500 GM\",\"var_price\":\"20\",\"var_unit\":\"2\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Bottle Gourd \\/ \\u0932\\u094c\\u0915\\u0940 \\/ \\u0926\\u0941\\u0927\\u0940\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"2\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', '60 Prasanth Manor\n, Vadapalani Vadapalani, ,\n278,\nChennai - 600026,\nTamil Nadu, India', '', '', '0000-00-00', '', '9789985950', 'Home', '0.0', '0.0', '0.0', '100.0', '100.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-09 12:55:32', ''),
(11, 'ORD000011', 5, 0, 0, '[{\"fk_product\":\"30\",\"var_name\":\"Beetroot \\/ \\u091a\\u0941\\u0915\\u0902\\u0926\\u0930 \\/ \\u092c\\u0940\\u091f\",\"var_quantity\":\"250 GM\",\"var_price\":\"20\",\"var_unit\":\"2\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '7227880146', 'Home', '0.0', '0.0', '2.0', '40.0', '38.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-09 18:02:19', ''),
(12, 'ORD000012', 5, 1, 0, '[{\"fk_product\":\"31\",\"var_name\":\"Bitter Gourd \\/ \\u0915\\u0930\\u0947\\u0932\\u093e \\/ \\u0915\\u093e\\u0930\\u0932\\u0947\",\"var_quantity\":\"500 GM\",\"var_price\":\"20\",\"var_unit\":\"2\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '7227880146', 'Home', '0.0', '0.0', '0.0', '40.0', '40.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-09 18:02:37', ''),
(13, 'ORD000013', 28, 1, 0, '[{\"fk_product\":\"44\",\"var_name\":\"Fenugreek Leaves \\/  Methi \\/ \\u092e\\u0947\\u0925\\u0940\",\"var_quantity\":\"1 Bundle\",\"var_price\":\"20\",\"var_unit\":\"1\",\"cancel_status\":\"N\"},{\"fk_product\":\"40\",\"var_name\":\"Curry Leaves \\/ \\u0915\\u0922\\u093c\\u0940 \\u092a\\u0924\\u094d\\u0924\\u093e\",\"var_quantity\":\"1 Bundle\",\"var_price\":\"20\",\"var_unit\":\"1\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', '60 Prasanth Manor\n, Vadapalani Vadapalani, ,\n278,\nChennai - 600026,\nTamil Nadu, India', '', '', '0000-00-00', '9789985950', '', 'Home', '0.0', '0.0', '0.0', '40.0', '40.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-12 22:02:31', ''),
(14, 'ORD000014', 5, 1, 0, '[{\"fk_product\":\"32\",\"var_name\":\"Bottle Gourd \\/ \\u0932\\u094c\\u0915\\u0940 \\/ \\u0926\\u0941\\u0927\\u0940\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"2\",\"cancel_status\":\"N\"},{\"fk_product\":\"31\",\"var_name\":\"Bitter Gourd \\/ \\u0915\\u0930\\u0947\\u0932\\u093e \\/ \\u0915\\u093e\\u0930\\u0932\\u0947\",\"var_quantity\":\"500 GM\",\"var_price\":\"20\",\"var_unit\":\"2\",\"cancel_status\":\"N\"},{\"fk_product\":\"30\",\"var_name\":\"Beetroot \\/ \\u091a\\u0941\\u0915\\u0902\\u0926\\u0930 \\/ \\u092c\\u0940\\u091f\",\"var_quantity\":\"250 GM\",\"var_price\":\"20\",\"var_unit\":\"2\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '1234567890', 'Home', '0.0', '0.0', '2.0', '140.0', '138.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-18 18:03:22', ''),
(15, 'ORD000015', 5, 1, 0, '[{\"fk_product\":\"30\",\"var_name\":\"Beetroot \\/ \\u091a\\u0941\\u0915\\u0902\\u0926\\u0930 \\/ \\u092c\\u0940\\u091f\",\"var_quantity\":\"250 GM\",\"var_price\":\"20\",\"var_unit\":\"2\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '1234567890', 'Home', '0.0', '0.0', '2.0', '40.0', '38.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-18 18:03:47', ''),
(16, 'ORD000016', 5, 0, 0, '[{\"fk_product\":\"30\",\"var_name\":\"Beetroot \\/ \\u091a\\u0941\\u0915\\u0902\\u0926\\u0930 \\/ \\u092c\\u0940\\u091f\",\"var_quantity\":\"250 GM\",\"var_price\":\"20\",\"var_unit\":\"3\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '1234567890', 'Home', '0.0', '0.0', '3.0', '60.0', '57.0', '', '', '0.0', '', '', 'U', '0000-00-00', '', '', 'N', '2020-05-18 18:17:24', ''),
(17, 'ORD000017', 5, 0, 0, '[{\"fk_product\":\"30\",\"var_name\":\"Beetroot \\/ \\u091a\\u0941\\u0915\\u0902\\u0926\\u0930 \\/ \\u092c\\u0940\\u091f\",\"var_quantity\":\"250 GM\",\"var_price\":\"20\",\"var_unit\":\"3\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '1234567890', 'Home', '0.0', '0.0', '3.0', '60.0', '57.0', '', '', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-18 18:17:39', ''),
(18, 'ORD000018', 5, 0, 0, '[{\"fk_product\":\"35\",\"var_name\":\"Carrot \\/ \\u0917\\u093e\\u091c\\u0930\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"2\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '1234567890', 'Home', '0.0', '0.0', '0.0', '60.0', '60.0', '', '', '0.0', '', 'pay_EurqHmPRwUcNJH', '', '0000-00-00', '', '', 'N', '2020-05-26 10:47:56', ''),
(19, 'ORD000019', 5, 1, 0, '[{\"fk_product\":\"31\",\"var_name\":\"Bitter Gourd \\/ \\u0915\\u0930\\u0947\\u0932\\u093e \\/ \\u0915\\u093e\\u0930\\u0932\\u0947\",\"var_quantity\":\"500 GM\",\"var_price\":\"20\",\"var_unit\":\"1\",\"cancel_status\":\"N\"},{\"fk_product\":\"30\",\"var_name\":\"Beetroot \\/ \\u091a\\u0941\\u0915\\u0902\\u0926\\u0930 \\/ \\u092c\\u0940\\u091f\",\"var_quantity\":\"250 GM\",\"var_price\":\"20\",\"var_unit\":\"3\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Bottle Gourd \\/ \\u0932\\u094c\\u0915\\u0940 \\/ \\u0926\\u0941\\u0927\\u0940\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"1\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '1234567890', 'Home', '0.0', '0.0', '3.0', '110.0', '124.6', '11.0', '6.6', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-27 11:30:09', ''),
(20, 'ORD000020', 5, 1, 0, '[{\"fk_product\":\"30\",\"var_name\":\"Beetroot \\/ \\u091a\\u0941\\u0915\\u0902\\u0926\\u0930 \\/ \\u092c\\u0940\\u091f\",\"var_quantity\":\"250 GM\",\"var_price\":\"20\",\"var_unit\":\"4\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '1234567890', 'Home', '0.0', '0.0', '10.0', '250.0', '280.0', '25.0', '15.0', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-27 11:30:57', ''),
(21, 'ORD000021', 5, 2, 0, '[{\"fk_product\":\"54\",\"var_name\":\"Mint Leaves \\/ \\u092a\\u0941\\u0926\\u0940\\u0928\\u093e\",\"var_quantity\":\"1 Bundle\",\"var_price\":\"10\",\"var_unit\":\"2\",\"cancel_status\":\"N\"},{\"fk_product\":\"53\",\"var_name\":\"Lady Finger \\/ \\u092d\\u093f\\u0902\\u0921\\u0940 \\/ \\u092d\\u0947\\u0902\\u0921\\u0940\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"3\",\"cancel_status\":\"N\"},{\"fk_product\":\"57\",\"var_name\":\"Potato \\/ \\u0906\\u0932\\u0942 \\/ \\u092c\\u091f\\u093e\\u091f\\u093e\",\"var_quantity\":\"1 KG\",\"var_price\":\"20\",\"var_unit\":\"3\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '1234567890', 'Home', '0.0', '0.0', '10.0', '250.0', '280.0', '25.0', '15.0', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-27 11:30:57', ''),
(22, 'ORD000022', 5, 1, 0, '[{\"fk_product\":\"33\",\"var_name\":\"Cabbage \\/ \\u092a\\u0924\\u094d\\u0924\\u093e \\u0917\\u094b\\u092d\\u0940\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"2\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Bottle Gourd \\/ \\u0932\\u094c\\u0915\\u0940 \\/ \\u0926\\u0941\\u0927\\u0940\",\"var_quantity\":\"500 GM\",\"var_price\":\"30\",\"var_unit\":\"1\",\"cancel_status\":\"N\"},{\"fk_product\":\"31\",\"var_name\":\"Bitter Gourd \\/ \\u0915\\u0930\\u0947\\u0932\\u093e \\/ \\u0915\\u093e\\u0930\\u0932\\u0947\",\"var_quantity\":\"500 GM\",\"var_price\":\"20\",\"var_unit\":\"2\",\"cancel_status\":\"N\"},{\"fk_product\":\"30\",\"var_name\":\"Beetroot \\/ \\u091a\\u0941\\u0915\\u0902\\u0926\\u0930 \\/ \\u092c\\u0940\\u091f\",\"var_quantity\":\"250 GM\",\"var_price\":\"20\",\"var_unit\":\"3\",\"cancel_status\":\"N\"}]', '', 'By Cash', 'S', 'A - 703, Titanium city center,\nAanad nagar road,\nAhmedabad - 380015,\nGujarat, India', '', '', '0000-00-00', '7069747475', '1234567890', 'Home', '0.0', '0.0', '3.0', '190.0', '217.4', '19.0', '11.4', '0.0', '', '', '', '0000-00-00', '', '', 'N', '2020-05-28 18:19:39', ''),
(35, 'ORD000035', 83, 0, 0, '[{\"fk_product\":\"119\",\"var_name\":\"Ready Kadha\",\"var_quantity\":\"25\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"10\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"1\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"3\",\"gst_price\":\"0\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '49.5', '109.5', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-08 15:52:28', ''),
(34, 'ORD000034', 83, 0, 0, '[{\"fk_product\":\"31\",\"var_name\":\"Sabudana Flour\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"4\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"85\",\"var_name\":\"Digestive Tea\",\"var_quantity\":\"25 GM\",\"var_price\":\"35\",\"var_unit\":\"1\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"44\",\"var_name\":\"Instant Milkshake Powder\",\"var_quantity\":\"100 GM\",\"var_price\":\"110\",\"var_unit\":\"1\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"35\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"200 GM\",\"var_price\":\"60\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"35\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"200 GM\",\"var_price\":\"60\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"44\",\"var_name\":\"Instant Milkshake Powder\",\"var_quantity\":\"100 GM\",\"var_price\":\"110\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '145', '205', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-08 15:29:43', ''),
(31, 'ORD000031', 83, 0, 0, '[{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"1\",\"gst_price\":\"18\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '590', '650', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-07 23:52:48', ''),
(33, 'ORD000033', 83, 0, 0, '[{\"fk_product\":\"119\",\"var_name\":\"Ready Kadha\",\"var_quantity\":\"25\",\"var_price\":\"45\",\"var_unit\":\"2\",\"gst_price\":\"10\",\"cancel_status\":\"N\"},{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"1\",\"gst_price\":\"18\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '689', '749', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-08 00:15:39', ''),
(36, 'ORD000036', 83, 0, 0, '[{\"fk_product\":\"35\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"200 GM\",\"var_price\":\"60\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"35\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"200 GM\",\"var_price\":\"60\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"35\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"200 GM\",\"var_price\":\"60\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"35\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"200 GM\",\"var_price\":\"60\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"35\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"200 GM\",\"var_price\":\"60\",\"var_unit\":\"3\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"2\",\"gst_price\":\"18\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '0', '', '', '1180', '1180', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-08 15:59:18', ''),
(37, 'ORD000037', 83, 0, 0, '[{\"fk_product\":\"35\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"200 GM\",\"var_price\":\"60\",\"var_unit\":\"3\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"1\",\"gst_price\":\"18\",\"cancel_status\":\"N\"},{\"fk_product\":\"35\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"200 GM\",\"var_price\":\"60\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '590', '650', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-08 16:03:53', ''),
(38, 'ORD000038', 83, 0, 0, '[{\"fk_product\":\"122\",\"var_name\":\"xyz\",\"var_quantity\":\"10\",\"var_price\":\"100\",\"var_unit\":\"3\",\"gst_price\":\"5\",\"cancel_status\":\"N\"},{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"2\",\"gst_price\":\"18\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '0', '', '', '1495', '1495', '', '', '0', '', '', 'U', '0000-00-00', '', '', 'N', '2020-10-08 16:05:59', ''),
(39, 'ORD000039', 8, 0, 0, '[{\"fk_product\":\"31\",\"var_name\":\"Sabudana Flour\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"4\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"4\",\"gst_price\":\"18\",\"cancel_status\":\"N\"},{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"5\",\"gst_price\":\"18\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', 'A ,titanium city centre,seema hall,Ahmedabad,Gujarat,india-380015', '', 'S', '0000-00-00', '', '7567878784', 'Home', '0', '', '', '3130', '3130', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-08 17:44:13', ''),
(40, 'ORD000040', 83, 0, 0, '[{\"fk_product\":\"31\",\"var_name\":\"Sabudana Flour\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"3\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"122\",\"var_name\":\"xyz\",\"var_quantity\":\"10\",\"var_price\":\"100\",\"var_unit\":\"5\",\"gst_price\":\"5\",\"cancel_status\":\"N\"},{\"fk_product\":\"31\",\"var_name\":\"Sabudana Flour\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"4\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"31\",\"var_name\":\"Sabudana Flour\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"3\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"38\",\"var_name\":\"Bhagar Flour (Varai Pith)\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"38\",\"var_name\":\"Bhagar Flour (Varai Pith)\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"4\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"38\",\"var_name\":\"Bhagar Flour (Varai Pith)\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"5\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"35\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"200 GM\",\"var_price\":\"60\",\"var_unit\":\"3\",\"gst_price\":\"0\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '930', '990', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-08 17:50:11', ''),
(41, 'ORD000041', 70, 0, 0, '[{\"fk_product\":\"30\",\"var_name\":\"Immunity Booster Kadha\",\"var_quantity\":\"250 GM\",\"var_price\":\"40\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"3\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"1\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"123\",\"var_name\":\"Raghi pith\",\"var_quantity\":\"20\",\"var_price\":\"40\",\"var_unit\":\"1\",\"gst_price\":\"10\",\"cancel_status\":\"N\"},{\"fk_product\":\"123\",\"var_name\":\"Raghi pith\",\"var_quantity\":\"20\",\"var_price\":\"40\",\"var_unit\":\"2\",\"gst_price\":\"10\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', ',,,,,-', '', 'S', '0000-00-00', '', '9112237805', '', '60', '', '', '213', '230.4', '', '', '42.6', 'OUT10', '', '', '0000-00-00', '', '', 'N', '2020-10-09 20:47:45', ''),
(42, 'ORD000042', 70, 0, 0, '[{\"fk_product\":\"123\",\"var_name\":\"Raghi pith\",\"var_quantity\":\"20\",\"var_price\":\"40\",\"var_unit\":\"2\",\"gst_price\":\"10\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', ',,,,,-', '', 'S', '0000-00-00', '', '9112237805', '', '60', '', '', '88', '148', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-09 20:54:16', ''),
(43, 'ORD000043', 48, 0, 0, '[{\"fk_product\":\"116\",\"var_name\":\"Instant Dal-Batti Mix\",\"var_quantity\":\"200 GM\",\"var_price\":\"70\",\"var_unit\":\"499\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"3\",\"gst_price\":\"18\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', 'af,sda,asd,ahmedabad,gujarat,India-45411212', '', 'S', '0000-00-00', '', '', 'Home', '0', '', '', '1770', '1670', '', '', '100', 'T20', '', '', '0000-00-00', '', '', 'N', '2020-10-10 18:12:34', ''),
(44, 'ORD000044', 83, 0, 0, '[{\"fk_product\":\"119\",\"var_name\":\"Ready Kadha\",\"var_quantity\":\"25\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"10\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"119\",\"var_name\":\"Ready Kadha\",\"var_quantity\":\"25\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"10\",\"cancel_status\":\"N\"},{\"fk_product\":\"122\",\"var_name\":\"xyz\",\"var_quantity\":\"10\",\"var_price\":\"100\",\"var_unit\":\"1\",\"gst_price\":\"5\",\"cancel_status\":\"N\"},{\"fk_product\":\"122\",\"var_name\":\"xyz\",\"var_quantity\":\"10\",\"var_price\":\"100\",\"var_unit\":\"1\",\"gst_price\":\"5\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"119\",\"var_name\":\"Ready Kadha\",\"var_quantity\":\"25\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"10\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"1\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"122\",\"var_name\":\"xyz\",\"var_quantity\":\"10\",\"var_price\":\"100\",\"var_unit\":\"1\",\"gst_price\":\"5\",\"cancel_status\":\"N\"},{\"fk_product\":\"119\",\"var_name\":\"Ready Kadha\",\"var_quantity\":\"25\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"10\",\"cancel_status\":\"N\"},{\"fk_product\":\"122\",\"var_name\":\"xyz\",\"var_quantity\":\"10\",\"var_price\":\"100\",\"var_unit\":\"1\",\"gst_price\":\"5\",\"cancel_status\":\"N\"},{\"fk_product\":\"122\",\"var_name\":\"xyz\",\"var_quantity\":\"10\",\"var_price\":\"100\",\"var_unit\":\"1\",\"gst_price\":\"5\",\"cancel_status\":\"N\"},{\"fk_product\":\"38\",\"var_name\":\"Bhagar Flour (Varai Pith)\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"122\",\"var_name\":\"xyz\",\"var_quantity\":\"10\",\"var_price\":\"100\",\"var_unit\":\"1\",\"gst_price\":\"5\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"31\",\"var_name\":\"Sabudana Flour\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"38\",\"var_name\":\"Bhagar Flour (Varai Pith)\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"3\",\"gst_price\":\"0\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '355', '415', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-10 18:47:40', ''),
(45, 'ORD000045', 83, 0, 0, '[{\"fk_product\":\"119\",\"var_name\":\"Ready Kadha\",\"var_quantity\":\"25\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"10\",\"cancel_status\":\"N\"},{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"1\",\"gst_price\":\"18\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '639.5', '699.5', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-10 18:50:55', ''),
(46, 'ORD000046', 83, 0, 0, '[{\"fk_product\":\"44\",\"var_name\":\"Instant Milkshake Powder\",\"var_quantity\":\"100 GM\",\"var_price\":\"110\",\"var_unit\":\"3\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"30\",\"var_name\":\"\",\"var_quantity\":\"250 GM\",\"var_price\":\"40\",\"var_unit\":\"1\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"1\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"31\",\"var_name\":\"Sabudana Flour\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"111\",\"var_name\":\"Ragi Flour (Nachani Pith)\",\"var_quantity\":\"500 GM\",\"var_price\":\"50\",\"var_unit\":\"2\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"33\",\"var_name\":\"Amaranth Flour ( Rajgira Pith )\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"1\",\"gst_price\":\"0\",\"cancel_status\":\"N\"},{\"fk_product\":\"117\",\"var_name\":\"Student Kit \\u2013 Tourist Kit\",\"var_quantity\":\"10\",\"var_price\":\"700\",\"var_unit\":\"1\",\"gst_price\":\"0\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '0', '', '', '2092.4576271186', '2092.4576271186', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-12 16:24:04', ''),
(47, 'ORD000047', 83, 0, 0, '[]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '573.72881355932', '633.72881355932', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-12 16:46:28', ''),
(48, 'ORD000048', 83, 0, 0, '[{\"int_glcode\":\"123\",\"image\":\"https:\\/\\/cidev.in\\/burlyfield\\/uploads\\/products\\/1602256049paypal2.png\",\"price\":\"40\",\"dis_price\":\"32.00\",\"title\":\"Raghi pith\",\"gst\":\"10\",\"quantity\":\"1\",\"weigth\":\"20\",\"offer\":\"20\",\"grand_total\":\"32.00\",\"cancel_status\":\"N\"},{\"int_glcode\":\"121\",\"image\":\"https:\\/\\/cidev.in\\/burlyfield\\/uploads\\/products\\/1602047086shopicon.png\",\"price\":\"500\",\"dis_price\":\"450.00\",\"title\":\"abcd\",\"gst\":\"18\",\"quantity\":\"1\",\"weigth\":\"500 GM\",\"offer\":\"10\",\"grand_total\":\"450.00\",\"cancel_status\":\"N\"},{\"int_glcode\":\"119\",\"image\":\"https:\\/\\/cidev.in\\/burlyfield\\/uploads\\/products\\/1600946324DSC524001.jpg\",\"price\":\"45\",\"dis_price\":\"40.50\",\"title\":\"Ready Kadha\",\"gst\":\"10\",\"quantity\":\"1\",\"weigth\":\"25\",\"offer\":\"10\",\"grand_total\":\"40.50\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '501.00154083205', '561.00154083205', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-12 17:03:10', ''),
(49, 'ORD000049', 83, 0, 0, '[{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"1\",\"gst_price\":\"18\",\"cancel_status\":\"N\"},{\"fk_product\":\"119\",\"var_name\":\"Ready Kadha\",\"var_quantity\":\"25\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"10\",\"cancel_status\":\"N\"},{\"fk_product\":\"123\",\"var_name\":\"Raghi pith\",\"var_quantity\":\"20\",\"var_price\":\"40\",\"var_unit\":\"3\",\"gst_price\":\"10\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '573.72881355932', '633.72881355932', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-12 17:20:18', ''),
(50, 'ORD000050', 83, 0, 0, '[{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"1\",\"gst_price\":\"18\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '60', '', '', '423.72881355932', '483.72881355932', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-12 17:45:55', ''),
(51, 'ORD000051', 83, 0, 0, '[{\"fk_product\":\"31\",\"var_name\":\"Sabudana Flour\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"\",\"cancel_status\":\"N\"},{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"20\",\"gst_price\":\"18\",\"cancel_status\":\"N\"}]', '', 'By Online', 'S', '404,sravani crupa,gangotri nagR-2,Surat,Gujarat,India-395004', '', 'S', '0000-00-00', '', '8758999139', 'Home', '0', '', '', '10045', '10045', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-12 18:09:17', ''),
(52, 'ORD000052', 88, 0, 0, '[{\"fk_product\":\"121\",\"var_name\":\"abcd\",\"var_quantity\":\"500 GM\",\"var_price\":\"500\",\"var_unit\":\"2\",\"gst_price\":\"18\",\"cancel_status\":\"N\"},{\"fk_product\":\"119\",\"var_name\":\"Ready Kadha\",\"var_quantity\":\"25\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"10\",\"cancel_status\":\"N\"}]', '', 'By Online', 'B', ',,,,,-', '', 'S', '0000-00-00', '', '8758999138', '', '0', '', '', '1045', '1045', '', '', '0', '', '', '', '2020-10-20', 'Anjali', '00000555', 'N', '2020-10-13 15:31:37', ''),
(53, 'ORD000053', 8, 0, 0, '[{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"3\",\"gst_price\":\"\",\"cancel_status\":\"N\"}]', '', 'By Online', 'P', 'A ,titanium city centre,seema hall,Ahmedabad,Gujarat,india-380015', '', 'S', '0000-00-00', '', '7567878784', 'Home', '60', '', '', '45', '105', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-14 17:17:02', ''),
(54, 'ORD000054', 84, 0, 0, '[{\"fk_product\":\"31\",\"var_name\":\"Sabudana Flour\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"\",\"cancel_status\":\"N\"},{\"fk_product\":\"32\",\"var_name\":\"Instant Fast Farali Paratha\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"1\",\"gst_price\":null,\"cancel_status\":\"N\"},{\"fk_product\":\"85\",\"var_name\":\"Digestive Tea\",\"var_quantity\":\"25 GM\",\"var_price\":\"35\",\"var_unit\":\"1\",\"gst_price\":null,\"cancel_status\":\"N\"}]', '', 'By Online', 'P', ',,,,,-', '', 'S', '0000-00-00', '', '9373163977', '', '60', '', '', '95', '155', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-14 17:17:59', ''),
(55, 'ORD000055', 89, 0, 0, '[{\"fk_product\":\"85\",\"var_name\":\"Digestive Tea\",\"var_quantity\":\"25 GM\",\"var_price\":\"35\",\"var_unit\":\"1\",\"gst_price\":\"\",\"cancel_status\":\"N\"},{\"fk_product\":\"38\",\"var_name\":\"Bhagar Flour (Varai Pith)\",\"var_quantity\":\"200 GM\",\"var_price\":\"45\",\"var_unit\":\"1\",\"gst_price\":\"\",\"cancel_status\":\"N\"},{\"fk_product\":\"33\",\"var_name\":\"Amaranth Flour ( Rajgira Pith )\",\"var_quantity\":\"250 GM\",\"var_price\":\"15\",\"var_unit\":\"1\",\"gst_price\":\"\",\"cancel_status\":\"N\"}]', '', 'By Online', 'T', ',,,,,-', '', 'S', '0000-00-00', '', '8790654370', '', '60', '', '', '95', '155', '', '', '0', '', '', '', '0000-00-00', '', '', 'N', '2020-10-16 18:15:40', '');

-- --------------------------------------------------------

--
-- Table structure for table `mst_order_reject_reason`
--

CREATE TABLE `mst_order_reject_reason` (
  `int_glcode` int(11) NOT NULL,
  `var_title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `chr_publish` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `chr_delete` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_order_reject_reason`
--

INSERT INTO `mst_order_reject_reason` (`int_glcode`, `var_title`, `chr_publish`, `chr_delete`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(1, 'Product not available.', 'Y', 'Y', '2019-07-26 17:21:00', '2019-07-30 17:01:04', '43.243.39.153'),
(2, 'Address not Traceable.', 'Y', 'N', '2019-07-26 17:21:27', '2020-05-01 00:09:50', '49.207.134.58'),
(3, 'Address too far.', 'Y', 'N', '2019-07-26 17:22:20', '2019-07-30 19:06:39', '43.243.39.153'),
(7, 'Others', 'Y', 'Y', '2019-07-31 00:12:47', '2019-07-31 00:12:47', '42.106.255.31'),
(4, 'Delivery boy not available.', 'Y', 'N', '2019-07-26 17:23:44', '2019-07-30 19:06:51', '43.243.39.153'),
(5, 'The vendor holds the title, but is missing the requested issue or volume.', 'Y', 'Y', '2019-07-26 17:24:33', '2019-07-26 17:24:33', '43.243.39.137'),
(6, 'Others', 'Y', 'Y', '2019-07-29 13:30:38', '2019-07-29 13:30:38', '43.243.39.134'),
(8, 'NO Stock', 'Y', 'Y', '2020-05-01 00:11:36', '2020-05-01 00:11:36', '49.207.134.58'),
(9, 'No Stock', 'Y', 'N', '2020-09-24 17:40:10', '2020-09-24 17:40:10', '106.193.184.94');

-- --------------------------------------------------------

--
-- Table structure for table `mst_pincode`
--

CREATE TABLE `mst_pincode` (
  `int_glcode` int(11) NOT NULL,
  `var_pincode` int(11) NOT NULL,
  `int_day` int(11) NOT NULL,
  `flag` char(55) NOT NULL DEFAULT 'E' COMMENT 'E=Enabled,D=disabled',
  `chr_delete` char(11) NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_pincode`
--

INSERT INTO `mst_pincode` (`int_glcode`, `var_pincode`, `int_day`, `flag`, `chr_delete`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(1, 411000, 0, 'E', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(2, 411001, 1, 'E', 'N', '0000-00-00 00:00:00', '2020-06-17 17:46:15', '43.243.37.45'),
(3, 411002, 0, 'E', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(4, 411003, 0, 'E', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(5, 411004, 0, 'D', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(6, 411005, 0, 'E', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(7, 411006, 0, 'D', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(8, 411007, 3, 'D', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(9, 411008, 3, 'E', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(10, 411009, 3, 'D', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(11, 411010, 0, 'E', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(12, 411011, 2, 'D', 'N', '0000-00-00 00:00:00', '2020-06-02 18:24:11', '103.85.9.104'),
(13, 411012, 0, 'E', 'N', '2020-06-02 18:13:16', '2020-09-24 12:45:08', '103.37.183.24');

-- --------------------------------------------------------

--
-- Table structure for table `mst_products`
--

CREATE TABLE `mst_products` (
  `int_glcode` int(11) NOT NULL,
  `fk_category` int(11) NOT NULL,
  `fk_vendor` int(11) NOT NULL,
  `var_title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `var_image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `var_short_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `txt_description` text COLLATE latin1_general_ci NOT NULL,
  `var_offer` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_price` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_stock` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_gst` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `stock_status` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `var_quantity` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `txt_nutrition` text COLLATE latin1_general_ci NOT NULL,
  `var_pincode` text COLLATE latin1_general_ci NOT NULL,
  `chr_publish` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `chr_delete` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_products`
--

INSERT INTO `mst_products` (`int_glcode`, `fk_category`, `fk_vendor`, `var_title`, `var_image`, `var_short_description`, `txt_description`, `var_offer`, `var_price`, `var_stock`, `var_gst`, `stock_status`, `var_quantity`, `txt_nutrition`, `var_pincode`, `chr_publish`, `chr_delete`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(30, 14, 1, '', '1600058831readykadhafront150x150.png', 'Good Food', 'Hello', '5', '', '97', '', 'Y', '', '<p>Bit</p>\r\n', '', 'Y', 'Y', '2020-09-30 16:20:43', '2020-09-16 10:09:07', '202.149.217.178'),
(31, 14, 1, 'Sabudana Flour', '1600060753Sabudanapith300x300.jpg', '', '100% Sabudana and nothing else. This makes it suitable for all fasts and festivities. Since we do not add any preservatives, colours, flavours , this Sabudana flour is the most Satvik and Vrat favourite of elders and youngsters. Make instant healthy parathas, thalipeeth, upma, laddoos, halwa, kheer and much more.', '0', '', '0', '', 'Y', '', '', '', 'Y', 'N', '2020-10-07 11:32:49', '2020-10-10 17:17:19', '103.37.181.179'),
(32, 14, 1, 'Instant Fast Farali Paratha', '1600060922Fastfaraliparath300x300.jpg', '', 'Avoid acidity and weight gain issues associated with the upavas meal.Try our Upavas special Instant Fast Farali Paratha and pamper your taste buds!\r\nServe hot parathas with creamy dahi!\r\n\r\nJust add water,kned,roll and serve hot.', '0', '', '84', '', 'Y', '', '', '', 'Y', 'N', '2020-09-14 10:52:02', '2020-09-16 10:09:07', '43.248.38.76'),
(33, 14, 1, 'Amaranth Flour ( Rajgira Pith )', '1600061038Rajgirapith300x300.jpg', '', 'Rajgira Flour 100% Rajgira(Amaranth) and nothing else. This makes it suitable for fasts and festivities. We are the manufacturers of truly vegetarian and natural products without any preservatives, artificial colours or flavours. So our Rajgira flour is in the purest satvik form and suitable for vrat or fasts. Make instant healthy iron rich parathas, upma, laddoos, halwa and much more.', '0', '', '98', '', 'Y', '', '', '', 'Y', 'N', '2020-09-14 10:53:58', '2020-09-16 10:09:07', '43.248.38.76'),
(34, 14, 1, 'Capsicum / शिमला मिर्च', '1569756114capsicum27102621920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 18:38:44', '2020-09-16 10:09:07', '43.248.38.76'),
(35, 14, 1, 'Instant Fast Farali Paratha', '1600059522Fastfaraliparath300x300.jpg', '', 'Avoid acidity and weight gain issues associated with the upavas meal.Try our Upavas special Instant Fast Farali Paratha and pamper your taste buds!\r\nServe hot parathas with creamy dahi!\r\n\r\nJust add water,kned,roll and serve hot.', '0', '', '11', '', 'Y', '', '', '', 'Y', 'N', '2020-09-14 10:28:42', '2020-10-12 19:33:43', '43.248.37.63'),
(36, 14, 1, 'Cauliflower / फूलगोभी / फ्लॉवर्', '1569756408cauliflower14657321920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 18:36:21', '2020-09-16 10:09:07', '43.248.38.76'),
(37, 14, 1, 'Cluster Beans / ग्वारफली / गवार', '1569756476beans5213961920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 18:33:49', '2020-09-16 10:09:07', '43.248.38.76'),
(38, 16, 1, 'Bhagar Flour (Varai Pith)', '1600059383Bhagarpith300x300.jpg', '', '100% Bhagar(Sama/Varai chawal) flour and nothing else. This makes it suitable for fasts and festivities. No preservatives, no artificial colours, no flavours make our Bhagar flour satvik and best suited for all vrats, fasts and upwas. Make instant healthy and tasty parathas, upma, laddoos, halwa, thalipeeth and much more. All our products are 100% vegetarian and hence you can buy these for vrats without any hesitation.', '0', '', '83', '', 'Y', '', '', '', 'Y', 'N', '2020-09-14 10:26:23', '2020-09-16 10:09:07', '43.248.38.76'),
(39, 14, 1, 'Cucumber / खीरा / काकडी', '1569756839cucumber15229211920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 18:30:44', '2020-09-16 10:09:07', '43.248.38.76'),
(40, 16, 1, 'Moringa (Shevga) Powder', '1600059266Moringapowder300x300.jpg', '', 'Suffering from flu?or cough?throat infection?cold?\r\nAiming for fitness,toning of body?want to look young?\r\nHurry your solution is here!\r\nMoringa is the superfood which you need!', '0', '', '100', '', 'Y', '', '', '', 'Y', 'N', '2020-09-14 10:24:26', '2020-09-16 10:09:07', '43.248.38.76'),
(41, 16, 1, 'Garlic Powder', '1600061219Garlic300x300.jpg', '', 'Garlic has been used in food and medicine over thousands of years due to its flavor enhancing property. It is known for its disease prevention and curing properties as being a reservoir of Antioxidants, Vitamins and minerals. Sprinkle Garlic powder to your dish and make all lick their fingers.', '0', '', '100', '', 'Y', '', '<p><strong>Ingredient:-</strong></p>\r\n\r\n<p>Dehydrated Garlic powder<br />\r\nUsages:-Can be used for making curries, Italian Seasoning for Italian cuisines, Garlic Bread, various Soups and traditional tadka.<br />\r\nMedicinal Properties:-Helpful in maintaining<br />\r\nhealthy blood circulation, Improves the<br />\r\nbody immune system.</p>\r\n', '', 'Y', 'N', '2020-09-14 10:56:59', '2020-09-16 10:09:07', '43.248.38.76'),
(42, 14, 1, 'Drumstick / सहजन / शेंगा', '1569757141Drumstick.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 18:24:38', '2020-09-16 10:09:07', '43.248.38.76'),
(43, 14, 1, 'Brinjal / बैंगन / वांगी', '1569757200eggplant6719101920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 18:22:45', '2020-09-16 10:09:07', '43.248.38.76'),
(44, 16, 1, 'Instant Milkshake Powder', '1600061362Milkshake300x300.jpg', '', 'Anjeer packed with Iron and Zinc aiding in body build up and Ragi with Calcium aiding in bone wear and tear, these are the perfect combination to make your body powerful and strong.\r\nBest for little ones picnic and easy to digest for senior citizens.\r\nMaan kiya bana liya!!', '0', '', '97', '', 'Y', '', '<p><strong>Ingredient:-</strong></p>\r\n\r\n<p>Fig(Anjeer) Powder,Ragi powder,SMP and sugar<br />\r\nUsage:-Used in making delicious Milk-Shake, Laddu, Anjeer halwa, Kheer or can be eaten as a powdered mix.<br />\r\n<strong>Medicinal Properties: &ndash;</strong></p>\r\n\r\n<p>Aids in digestion, relieving constipation issues, helps in weight gain, controlling hypertension, stress and relieves fatigue and drowsiness leaving us feeling fresh.</p>\r\n', '', 'Y', 'N', '2020-09-14 10:59:22', '2020-09-16 10:09:07', '43.248.38.76'),
(45, 14, 1, 'French Beans', '1569757352beans36885851920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 18:02:15', '2020-09-16 10:09:07', '43.248.38.76'),
(46, 14, 1, 'Garlic / लहसुन / लसूण', '1569757413garlic34195441920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 18:01:30', '2020-09-16 10:09:07', '43.248.38.76'),
(47, 14, 1, 'Ginger / अदरक / आले', '1569757510ginger17380981920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 18:00:02', '2020-09-16 10:09:07', '43.248.38.76'),
(48, 14, 1, 'Green Beans / बोडा / घेवडा', '1569757573yardlongbeans10985301920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:58:38', '2020-09-16 10:09:07', '43.248.38.76'),
(49, 14, 1, 'Green Chilli / हरी मिर्च /  हिरवी मिरची', '1569757653pepperoni739081920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:55:53', '2020-09-16 10:09:07', '43.248.38.76'),
(50, 14, 1, 'Green Peas / हरी मटर / वाटाणा', '1569757708textures19383011920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:53:19', '2020-09-16 10:09:07', '43.248.38.76'),
(51, 14, 2, 'Groundnut / मूँगफली / शेंगदाणा', '1569757776peanuts21630431920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:50:00', '2020-09-16 10:09:07', '43.248.38.76'),
(52, 14, 2, 'Jackfruit / कटहल / फणस', '1569757833jackfruit10344181920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:48:29', '2020-09-16 10:09:07', '43.248.38.76'),
(53, 14, 2, 'Lady Finger / भिंडी / भेंडी', '1569757897gombos41737181920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:46:59', '2020-09-16 10:09:07', '43.248.38.76'),
(54, 16, 2, 'Mint Leaves / पुदीना', '1569757972leaf33336391920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:45:39', '2020-09-16 10:09:07', '43.248.38.76'),
(55, 14, 2, 'Onion / प्याज / कांदा', '1569758050onion15656041920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:44:46', '2020-09-16 10:09:07', '43.248.38.76'),
(56, 14, 2, 'Orange Pumpkin / नारंगी कद्दू / लाल भोपळा', '1569758102pumpkins37269191920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:43:07', '2020-09-16 10:09:07', '43.248.38.76'),
(57, 14, 2, 'Potato / आलू / बटाटा', '1569758384potatoes15850751920.jpg', '', '', '10', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:39:54', '2020-09-16 10:09:07', '43.248.38.76'),
(58, 14, 2, 'Pumpkin / भोपळा', '1569758665muscatdeprovence2285011920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:38:06', '2020-09-16 10:09:07', '43.248.38.76'),
(59, 16, 2, 'Radish Leaves / मूली के पत्ते / मुळ्याचा पाला', '1569758842healthy33765141920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:36:14', '2020-09-16 10:09:07', '43.248.38.76'),
(60, 14, 2, 'Red Chilli / लाल मिर्च / लाल मिरची', '1569758964chili4990621920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:34:27', '2020-09-16 10:09:07', '43.248.38.76'),
(61, 16, 2, 'Spinach / पालक', '1569759081spinach5066161920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:30:38', '2020-09-16 10:09:07', '43.248.38.76'),
(62, 14, 2, 'Sweet Potato / शकरकंद / रताळे', '1569759268market40775751920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:29:36', '2020-09-16 10:09:07', '43.248.38.76'),
(63, 14, 2, 'Teasle Gourd / कंटोला / ककोड़ा', '1569759414chayote16375351920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:28:10', '2020-09-16 10:09:07', '43.248.38.76'),
(64, 14, 2, 'Tomato / टमाटर', '1569759544tomato4987211920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:24:50', '2020-09-16 10:09:07', '43.248.38.76'),
(65, 14, 2, 'Turnip / गांठ गोभी / नवलकोल', '1569759679white21473311920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:23:06', '2020-09-16 10:09:07', '43.248.38.76'),
(67, 14, 2, 'White Radish / मूली / मुळा', '15698428291569760637radish15863131920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 17:19:47', '2020-09-16 10:09:07', '43.248.38.76'),
(70, 14, 2, 'Sponge Gourd / नेनुआ', '1569941522SpongeGourd2.png', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 20:24:31', '2020-09-16 10:09:07', '43.248.38.76'),
(72, 14, 2, 'Ridge Gourd / तोरई', '1569941796Ridgegourd.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 20:27:04', '2020-09-16 10:09:07', '43.248.38.76'),
(73, 14, 2, 'Snake Gourd / चिचिंढा / पडवळ', '1569942040snakegourd1.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 20:58:21', '2020-09-16 10:09:07', '43.248.38.76'),
(74, 14, 2, 'Pointed Gourd / परवल / परवर', '1569943806Pointedgourd2.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 21:03:33', '2020-09-16 10:09:07', '43.248.38.76'),
(75, 14, 2, 'Apple Gourd / टिंडा / ढेमसे', '1569943978Applegourd2.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 21:02:58', '2020-09-16 10:09:07', '43.248.38.76'),
(76, 14, 2, 'Ivy Gourd / कुंदरू / तोंडली', '1569944219IvyGourd.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 21:06:59', '2020-09-16 10:09:07', '43.248.38.76'),
(77, 16, 2, 'Colocasia Leaves / अरबी पत्ता / अळू', '1569944612colocassialeaf1.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 21:13:32', '2020-09-16 10:09:07', '43.248.38.76'),
(78, 16, 2, 'Green Amaranth / चौराई / राजगिरा', '1569944720amaranthleaves1.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 21:15:20', '2020-09-16 10:09:07', '43.248.38.76'),
(79, 16, 2, 'Green Sorrel / खट्टी पालक / आंबट चुका', '1569944847Greensorrel.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 21:17:27', '2020-09-16 10:09:07', '43.248.38.76'),
(80, 16, 2, 'Red Amaranth / लाल चौराई / लाल माठ', '1569944945amaranthleaves1.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 21:19:05', '2020-09-16 10:09:07', '43.248.38.76'),
(81, 16, 5, 'Mustard Leaves / सरसों का साग / मोहरीचा पाला', '1569945171freshgreenmustardleaves250x250.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 21:22:51', '2020-09-16 10:09:07', '43.248.38.76'),
(82, 14, 5, 'Yam / सूरन / सुरण', '1569945301Yam2.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 21:25:01', '2020-09-16 10:09:07', '43.248.38.76'),
(83, 16, 5, 'Spring Onion / हरे प्याज / कांद्याची पात', '1569945909leek34784751920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-01 21:35:09', '2020-09-16 10:09:07', '43.248.38.76'),
(84, 15, 5, 'Instant Bambaiya Pav-Bhaji', '1600060154PavBhaji300x300.jpg', '', 'Rehydrating Pav-Bhaji is made with happiness helping you to serve your happiness on a plate.\r\nAll Ingredients are Farm Picked, Cut and processed keeping in mind your tummy health.\r\nNo Gas,No Microwave needed\r\nServes-4', '0', '', '100', '', 'Y', '', '<p>Food Cast<br />\r\nCast-Role<br />\r\nTomatoes-Antioxidants<br />\r\nCarrot-Pretty eyes<br />\r\nBeetroot-Healthy Heart<br />\r\nGreen Peas-Radiant Skin<br />\r\nBell Pepper-Weight Loss<br />\r\nOnion-anti-inflammatory</p>\r\n\r\n<p><strong>Requisites-</strong><br />\r\nEngrossing Match or a Birthday Party,Party Music, Favorite peeps around and Loads of Gossip.</p>\r\n\r\n<p><strong>Directions to be used-</strong><br />\r\n1)Cut a sachet(25gm) and add 100ml water.<br />\r\n2)Cover and keep aside for rehydration for 3mins<br />\r\n3)Enjoy with Hot Buttery Pavs and a engrossing movie.<br />\r\n*For enhancing the taste- add more 100ml of water and cook on gas or in microwave for 3mins.<br />\r\n100gm box=500ml water for serving 4.</p>\r\n', '', 'Y', 'N', '2020-09-14 10:39:14', '2020-09-16 10:09:07', '43.248.38.76'),
(85, 15, 5, 'Digestive Tea', '1600060343DIZOTEA300x300.jpg', '', 'You can’t buy happiness,but can buy Serene.Tea & that’s the same thing.\r\nHand picked ingredients,mixed & processed for a relaxing mind and soul.', '0', '', '98', '', 'Y', '', '<p>Serves-12<br />\r\nJust add hot water.</p>\r\n\r\n<p><strong>Food Cast-</strong><br />\r\nMint-Aromatherapy<br />\r\nGinger-Anti-bloating agent<br />\r\nCardamon-Multivitamin provider<br />\r\nPepper-Healthy Tummy<br />\r\nAjwain-Gas releaser</p>\r\n\r\n<p><strong>Requisites-</strong> Good Book, peaceful mind, satisfied tummy and a cup of Serene.Tea</p>\r\n\r\n<p><strong>irections-</strong><br />\r\nAdd 1 spoon (given in the box) to a tea cup and add 100ml of hot water.<br />\r\nKeep aside for infusion(2mins).Strain and enjoy your healthy tea.<br />\r\n*For &lsquo;Cooler&rsquo; drinks-add chilled water.</p>\r\n', '', 'Y', 'N', '2020-09-14 10:42:23', '2020-09-16 10:09:07', '43.248.38.76'),
(86, 15, 5, 'Herbal Tea', '1600060490HerbalTea300x300.jpg', '', '‘You can’t buy happiness,but can buy Serene.Tea & that’s the same thing.\r\nHand picked ingredients,mixed & processed for a relaxing mind and soul.’', '0', '', '100', '', 'Y', '', '<p><strong>Food Cast</strong><br />\r\nCAST-ROLE<br />\r\nLemongrass-Aromatherapy<br />\r\nGinger- Anti-bloating agent<br />\r\nTulsi-Healthy Heart<br />\r\nCloves-Body wellness<br />\r\nCurry leaves- Beautiful hair<br />\r\nCinnamon-Blood sugar balancer<br />\r\nGreen Tea-Anti-oxidant</p>\r\n\r\n<p><strong>Requisites-</strong> Good Book, peaceful mind, satisfied tummy and a cup of Serene.Tea</p>\r\n\r\n<p><strong>Directions-</strong><br />\r\nAdd 1 spoon (given in the box) to a tea cup and add 100ml of hot water.<br />\r\nKeep aside for infusion(2mins).Strain and enjoy your healthy tea.<br />\r\n*For &lsquo;Cooler&rsquo; drinks-add chilled water.</p>\r\n', '', 'Y', 'N', '2020-09-14 10:44:50', '2020-09-16 10:09:07', '43.248.38.76'),
(87, 15, 5, 'Aamla Ginger Fusion Tea', '1600060613Aamlagingertea300x300.jpg', '', 'Ginger is known from decades in world wide cultures for its relieving digestive problems, stress and pain. Amla is a fruit packed with antioxidant, antiageing, antidiabetic and immune boosting properties.This makes our Amla-Ginger Fusion tea a replicate for ‘Prevention is better than cure’.A box packed with nature’s goodness to keep your mind and soul healthy and fresh.', '0', '', '100', '', 'Y', '', '<p><strong>Ingredients</strong>:</p>\r\n\r\n<p>Dehydrated Aonla Powder, Dehydrated Ginger Powder, Black salt, Rock salt.<br />\r\nUsage: Makes Refreshing, Vitalizing Appetizer<br />\r\nMedicinal properties: Helps in keeping away stomach acidity and nausea.</p>\r\n', '', 'Y', 'N', '2020-09-14 10:46:53', '2020-09-16 10:09:07', '43.248.38.76'),
(88, 15, 5, 'Banana / केला / केळे', '15700008203.jpeg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 19:59:11', '2020-09-16 10:09:07', '43.248.38.76'),
(89, 15, 5, 'Coconut / नारियल / नारळ', '15700009112.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 12:51:51', '2020-09-16 10:09:07', '43.248.38.76'),
(90, 15, 5, 'Litchi / लीची', '15700010113.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 12:53:31', '2020-09-16 10:09:07', '43.248.38.76'),
(91, 15, 5, 'Plum / आलूबुखारा', '1570001273plum16905791920.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 12:57:53', '2020-09-16 10:09:07', '43.248.38.76'),
(92, 15, 5, 'Starfruit / कमरख', '15700014373.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:00:37', '2020-09-16 10:09:07', '43.248.38.76'),
(93, 15, 5, 'Indian gooseberry / आँवला', '15700015681.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:02:48', '2020-09-16 10:09:07', '43.248.38.76'),
(94, 15, 5, 'Wood apple / बेल / बेलफळ', '15700016491.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:04:09', '2020-09-16 10:09:07', '43.248.38.76'),
(95, 15, 5, 'Fig / अँजीर / अंजीर', '15700017741.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:06:14', '2020-09-16 10:09:07', '43.248.38.76'),
(96, 15, 5, 'Grapes / अँगूर', '15700036743.jpeg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:38:44', '2020-09-16 10:09:07', '43.248.38.76'),
(97, 15, 5, 'Black Grapes / काला अंगूर', '15700038591.jpeg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:41:48', '2020-09-16 10:09:07', '43.248.38.76'),
(98, 15, 5, 'Orange / संतरा / संत्रे', '15700041006.jpeg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:45:00', '2020-09-16 10:09:07', '43.248.38.76'),
(99, 15, 5, 'Pear / नाशपाती / नासपती', '15700042861.jpeg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:48:06', '2020-09-16 10:09:07', '43.248.38.76'),
(100, 15, 5, 'Chickoo / चीकू / चिक्कू', '15700044083.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:50:08', '2020-09-16 10:09:07', '43.248.38.76'),
(101, 15, 5, 'Papaya / पपीता / पपई', '15700045111.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:51:51', '2020-09-16 10:09:07', '43.248.38.76'),
(102, 15, 5, 'Watermelon / तरबूज / कलिंगड', '15700046211.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:53:41', '2020-09-16 10:09:07', '43.248.38.76'),
(103, 15, 5, 'Custard-apple / सीताफल / सिताफळ', '15700047292.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:56:08', '2020-09-16 10:09:07', '43.248.38.76'),
(104, 15, 5, 'Pomegranate / अनार / डाळिंब', '15700048691.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 13:57:49', '2020-09-16 10:09:07', '43.248.38.76'),
(105, 15, 5, 'Apple / सेब', '15700050024.jpeg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2019-10-02 14:00:02', '2020-09-16 10:09:07', '43.248.38.76'),
(106, 16, 5, 'Musk Melon', '15700051381.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2020-05-03 21:16:22', '2020-09-16 10:09:07', '43.248.38.76'),
(107, 16, 5, 'Water Chestnut ', '1570005532singharaherbs500x500.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2020-05-03 21:15:50', '2020-09-16 10:09:07', '43.248.38.76'),
(108, 18, 5, 'Clothes', '15804658401570193945Yash.jpg', 'test', 'test', '0', '', '100', '', 'Y', '', '<p>test</p>\r\n', '', 'Y', 'Y', '2020-01-31 15:47:20', '2020-09-16 10:09:07', '43.248.38.76'),
(109, 14, 5, 'test1', '15804659543183981.jpg', 'test1', 'test1', '0', '', '100', '', 'Y', '', '<p>test1</p>\r\n', '', 'Y', 'Y', '2020-05-09 20:05:20', '2020-09-16 10:09:07', '43.248.38.76'),
(110, 16, 8, 'Spring Onion', '1588516697K4.png', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2020-05-03 20:08:18', '2020-09-16 10:09:07', '43.248.38.76'),
(111, 18, 8, 'Ragi Flour (Nachani Pith)', '1600061562Nachnipith300x300.jpg', '', 'Make your bones healthy by making Ragi sheera,kheer,laddu,biscuits at home with out Ragi (Nachni) Pith.\r\nRagi (fingermillet) is known worldwide to be the richest source of calcium.', '0', '', '98', '', 'Y', '', '', '', 'Y', 'N', '2020-09-14 11:02:42', '2020-09-16 10:09:07', '43.248.38.76'),
(112, 16, 9, 'Tomato', '1588520851tomato.jpg', '', '', '0', '', '100', '', 'Y', '', '', '', 'Y', 'Y', '2020-05-03 21:17:31', '2020-09-16 10:09:07', '43.248.38.76'),
(113, 15, 1, 'Instant Bambaiya Pav-Bhaji', '1600059942PavBhaji300x300.jpg', '', 'Rehydrating Pav-Bhaji is made with happiness helping you to serve your happiness on a plate.\r\nAll Ingredients are Farm Picked, Cut and processed keeping in mind your tummy health.\r\nNo Gas,No Microwave needed\r\nServes-4', '15', '', '100', '', 'Y', '', '<p>Food Cast<br />\r\nCast-Role<br />\r\nTomatoes-Antioxidants<br />\r\nCarrot-Pretty eyes<br />\r\nBeetroot-Healthy Heart<br />\r\nGreen Peas-Radiant Skin<br />\r\nBell Pepper-Weight Loss<br />\r\nOnion-anti-inflammatory</p>\r\n\r\n<p><strong>Requisites-</strong><br />\r\nEngrossing Match or a Birthday Party,Party Music, Favorite peeps around and Loads of Gossip.</p>\r\n\r\n<p><strong>Directions to be used-</strong><br />\r\n1)Cut a sachet(25gm) and add 100ml water.<br />\r\n2)Cover and keep aside for rehydration for 3mins<br />\r\n3)Enjoy with Hot Buttery Pavs and a engrossing movie.<br />\r\n*For enhancing the taste- add more 100ml of water and cook on gas or in microwave for 3mins.<br />\r\n100gm box=500ml water for serving 4.</p>\r\n', '', 'Y', 'N', '2020-09-14 10:35:42', '2020-09-16 10:09:07', '43.248.38.76'),
(114, 14, 1, 'test', '15890304331.jpg', 'Short Description', 'description', '0', '', '100', '', 'Y', '', '<p>detail</p>\r\n', '', 'Y', 'Y', '2020-05-09 18:50:33', '2020-09-16 10:09:07', '43.248.38.76'),
(115, 17, 8, 'Instant Pancake Mix', '1600061699pancake300x300.jpg', '', 'Gluten free food is the recent ‘In’ and everyone is running to incorporate it in daily foods.We have found the answer for gluten free food which is delicious and easy to make and loved by all.Gio Instant Pancake mix is the new ‘In’ breakfast product for all. Just add water, mix, cook and serve hot with most loved honey or maple syrup.Yummmmmmm!', '0', '', '100', '', 'Y', '', '<p><strong>Ingredients:</strong></p>\r\n\r\n<p>oats, wheat flour, soya bean, ragi, milk powder, sugar, salt, dry date powder<br />\r\nUsage: for making pancakes<br />\r\nMedicinal properties: natural source of protein and dietary fiber. Helpful in case of maintaining cholesterol levels, weight loss</p>\r\n', '', 'Y', 'N', '2020-09-14 11:04:59', '2020-09-16 10:09:07', '43.248.38.76'),
(116, 17, 1, 'Instant Dal-Batti Mix', '1600059161bati1150x150.jpg', '', 'Now it is easy to make Dal-Batti at home.\r\nJust cut the sachet,add warm water,kned,keep aside,make round balls and fry in oil!\r\nSuper yummy batti are ready!\r\nEnjoy Rajasthan on your dining table!', '0', '', '1', '', 'Y', '', '', '', 'Y', 'N', '2020-09-14 10:22:41', '2020-09-16 10:16:43', '43.248.38.76'),
(117, 18, 1, 'Student Kit – Tourist Kit', '1600058969Studentkit1150x150.png', '', 'We bring to you the purest and healthiest ready meals ever. Going overseas for studies, work or travelling? No need to go over that extra mile to find a particular restaurant serving Indian food. With our easy to carry instant meals and drinks, take India along with you wherever you go.', '10', '', '399', '', 'Y', '', '<p>Our products are made with love from the ingredients from our very own farms and processed keeping in mind your health which is of utmost importance ti us. There are no added colours, flavours or preservatives in the products and hence they are a combo of shear nutrition.</p>\r\n', '', 'Y', 'N', '2020-09-15 18:23:52', '2020-09-16 11:18:16', '43.243.37.72'),
(118, 14, 1, 'demo', '1600940273call.png', '', '', '0', '', '0', '', 'Y', '', '', '', 'Y', 'N', '2020-09-24 15:50:47', '2020-09-24 15:07:53', '103.37.183.24'),
(119, 15, 1, 'Ready Kadha', '1600946324DSC524001.jpg', 'Immunity Booster Ready Kadha', 'Burlyfield\'s Immunity Booster Ready Kadha is prepared with utmost care and safety. Just a small spoonful makes a glassful of Kadha. It\'s rich in Ayurvedic herbs and very helpful in building immunity!\r\n\r\nIngredients: clove, cinamon, ginger, tulsi, black pepper', '10', '', '1', '10', 'Y', '', '', '', 'Y', 'N', '2020-10-08 15:51:44', '2020-09-24 17:56:22', '103.17.82.193'),
(120, 14, 1, 'Test', '1601462988author.png', '', '<script>window.location.href = \"http://wwwgoogle.com\";</script>', '1', '', '1', '', 'Y', '', '<p>add</p>\r\n', '', 'Y', 'Y', '2020-09-30 16:19:48', '2020-09-30 16:19:48', '202.149.217.178'),
(121, 18, 0, 'abcd', '1602047086shopicon.png', 'demo', 'test', '10', '', '3', '18', 'Y', '', '', '', 'Y', 'N', '2020-10-14 17:12:49', '2020-10-12 18:52:12', '103.17.81.8'),
(123, 17, 0, 'Raghi pith', '1602256049paypal2.png', 'test ', 'test testtesttttttt', '20', '', '20', '10', 'Y', '', '', '', 'Y', 'N', '2020-10-09 20:37:29', '2020-10-09 20:37:29', '116.73.83.215'),
(122, 14, 0, 'xyz', '16021413671.jpg', 'xyz test', 'test', '0', '', '0', '5', 'Y', '', '', '', 'Y', 'N', '2020-10-08 12:46:07', '2020-10-10 18:57:10', '103.37.181.179');

-- --------------------------------------------------------

--
-- Table structure for table `mst_product_pincode`
--

CREATE TABLE `mst_product_pincode` (
  `int_glcode` int(11) NOT NULL,
  `fk_pincode` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_product_pincode`
--

INSERT INTO `mst_product_pincode` (`int_glcode`, `fk_pincode`, `fk_product`) VALUES
(2, 2, 118),
(3, 9, 118),
(5, 11, 118),
(6, 1, 119),
(7, 2, 119),
(8, 3, 119),
(11, 9, 119),
(13, 13, 119),
(14, 1, 30),
(15, 3, 30),
(16, 9, 30),
(17, 1, 120),
(18, 1, 121),
(19, 3, 121),
(20, 9, 121),
(21, 11, 121),
(22, 2, 31),
(23, 3, 31),
(24, 3, 31);

-- --------------------------------------------------------

--
-- Table structure for table `mst_promocode`
--

CREATE TABLE `mst_promocode` (
  `int_glcode` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `var_promocode` varchar(50) NOT NULL,
  `no_of_time` varchar(50) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `var_price` varchar(50) NOT NULL,
  `var_percentage` varchar(50) NOT NULL,
  `min_order` int(11) NOT NULL,
  `txt_description` text NOT NULL,
  `chr_publish` char(11) NOT NULL DEFAULT 'Y',
  `chr_delete` char(11) NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_promocode`
--

INSERT INTO `mst_promocode` (`int_glcode`, `fk_user`, `var_promocode`, `no_of_time`, `expiry_date`, `var_price`, `var_percentage`, `min_order`, `txt_description`, `chr_publish`, `chr_delete`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(5, 0, 'AKAK', '1', '31-12-2020', '100', '10', 10, 'Get 12% cashback (upto Rs. 100) on total cart value. Minimum order value is Rs. 500.', 'Y', 'N', '2020-07-01 16:45:48', '2020-10-08 12:35:47', '116.75.26.204'),
(20, 2, 'TZS58I12', '1', '03-09-2020', '50', '100', 200, 'Cashback of Rs. 50 will credited to your Best Bhav wallet. Minimum order value is Rs. 200.', 'Y', 'N', '2020-07-03 13:55:14', '0000-00-00 00:00:00', ''),
(21, 1, 'F5SDS1OT', '1', '03-09-2020', '50', '100', 200, 'Cashback of Rs. 50 will credited to your Best Bhav wallet. Minimum order value is Rs. 200.', 'Y', 'N', '2020-07-03 13:59:22', '0000-00-00 00:00:00', ''),
(23, 5, 'LX5YSN0M', '1', '03-09-2020', '50', '100', 200, 'Cashback of Rs. 50 will credited to your Best Bhav wallet. Minimum order value is Rs. 200.', 'Y', 'N', '2020-07-03 15:17:13', '0000-00-00 00:00:00', ''),
(24, 7, 'JIM9QG3B', '1', '06-09-2020', '50', '100', 200, 'Cashback of Rs. 50 will credited to your Best Bhav wallet. Minimum order value is Rs. 200.', 'Y', 'N', '2020-07-06 00:48:43', '0000-00-00 00:00:00', ''),
(25, 0, 'SUPRSAVER', '1', '31-12-2020', '200', '15', 1000, 'Get 15% cashback (upto Rs. 200) on total cart value. Minimum order value is Rs. 1000.', 'Y', 'N', '2020-07-07 00:01:12', '2020-07-07 01:14:06', '116.75.26.204'),
(26, 0, 'MEGASAVER', '1', '31-12-2020', '250', '17', 1400, 'Get 17% cashback (upto Rs. 250) on total cart value. Minimum order value is Rs. 1400.', 'Y', 'N', '2020-07-07 01:17:50', '2020-07-07 01:17:50', '49.35.65.5'),
(27, 0, 'CHI120', '2', '30-10-2020', '50', '50', 500, 'abcd', 'Y', 'N', '2020-10-07 15:36:12', '2020-10-07 16:24:26', '43.248.38.250'),
(28, 0, 'OUT10', '1', '09-10-2020', '100', '20', 100, 'code', 'Y', 'N', '2020-10-09 20:44:01', '2020-10-09 20:47:08', '116.73.83.215'),
(29, 0, 'T20', '1', '15-10-2020', '100', '20', 300, '20% discount', 'Y', 'N', '2020-10-10 11:47:54', '2020-10-10 11:47:54', '106.193.218.20');

-- --------------------------------------------------------

--
-- Table structure for table `mst_review`
--

CREATE TABLE `mst_review` (
  `int_glcode` int(11) NOT NULL,
  `var_name` varchar(50) NOT NULL,
  `var_email` varchar(100) NOT NULL,
  `var_rate` int(11) NOT NULL,
  `var_message` text NOT NULL,
  `fk_product` int(11) NOT NULL,
  `chr_delete` varchar(1) NOT NULL DEFAULT 'N',
  `chr_publish` varchar(1) NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `var_ipaddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_review`
--

INSERT INTO `mst_review` (`int_glcode`, `var_name`, `var_email`, `var_rate`, `var_message`, `fk_product`, `chr_delete`, `chr_publish`, `dt_createddate`, `var_ipaddress`) VALUES
(4, 'Demo', 'final@gmail.com', 5, 'Know how to pursue pleasure rationally encounter consequences that are extremely painful nor again is there anyone who loves or pursues or desires to obtain pain seds of itself, because it is pain, under because occasionally circumstances occur in which toil great pleasure.', 30, 'N', 'N', '2020-09-25 11:47:16', '45.126.146.219'),
(5, 'pradnya ', 'ppshroff@ruchagroup.com', 5, 'awesome', 41, 'N', 'Y', '2020-10-06 17:05:47', '116.72.81.201'),
(6, 'pradnya ', 'ppshroff@ruchagroup.com', 5, 'awesome', 41, 'N', 'N', '2020-10-06 17:06:38', '116.72.81.201'),
(7, 'sayali', 'ppshroff@ruchagroup.com', 4, 'Know how to pursue pleasure rationally encounter consequences that are extremely painful nor again is there anyone who loves or pursues or desires to obtain pain seds of itself, because it is pain, under because occasionally circumstances occur in which toil great pleasure.', 41, 'N', 'Y', '2020-10-06 17:12:05', '116.72.81.201'),
(8, 'renuka', 'r@gmail.com', 3, 'test', 31, 'N', 'Y', '2020-10-07 11:29:37', '157.33.177.132'),
(9, 'jemil', 'j@mail.com', 4, 'testing', 31, 'N', 'Y', '2020-10-07 11:35:15', '157.33.177.132'),
(10, 'jemil', 'j@mail.com', 4, 'testing', 31, 'N', 'N', '2020-10-07 11:36:11', '157.33.177.132'),
(11, 'Pradnya', 'ppshroff@ruchagroup.com', 5, 'test review', 118, 'N', 'Y', '2020-10-08 11:01:17', '116.72.80.33'),
(12, 'Pradnya', 'ppshroff@ruchagroup.com', 5, 'test review', 118, 'N', 'N', '2020-10-08 11:01:49', '116.72.80.33'),
(13, 'Jemil', 'jl@ads.com', 4, 'jl;jl;', 44, 'N', 'Y', '2020-10-08 11:49:06', '43.243.37.73'),
(14, 'Jemil', 'jl@ads.com', 4, 'jl;jl;', 44, 'N', 'N', '2020-10-08 11:49:56', '43.243.37.73'),
(15, 'Jemil', 'jl@ads.com', 4, 'jl;jl;', 44, 'N', 'N', '2020-10-08 11:50:38', '43.243.37.73'),
(16, 'chirag', 'chirag@gmail.com', 4, 'hello', 32, 'N', 'Y', '2020-10-08 11:52:07', '45.126.145.127'),
(17, 'Rahul', 'rahul@gmail.com', 5, 'hello world', 32, 'N', 'N', '2020-10-08 11:54:14', '45.126.145.127'),
(18, 'final', 'final@gmail.com', 2, 'done', 32, 'N', 'N', '2020-10-08 11:57:29', '45.126.145.127'),
(19, 'nitesh', 'nitesh@gmail.com', 3, 'WOW', 32, 'N', 'N', '2020-10-08 11:58:50', '45.126.145.127'),
(20, 'nitesh', 'nitesh@gmail.com', 3, 'WOW', 32, 'N', 'N', '2020-10-08 11:59:38', '45.126.145.127'),
(21, 'syscort', 'r@mail.com', 2, 'test', 31, 'N', 'N', '2020-10-08 12:31:54', '49.35.108.188'),
(22, 'ssdff', 'sfd@se.com', 3, 'fgd', 121, 'N', 'Y', '2020-10-08 17:41:46', '43.243.37.73'),
(23, 'ssdff', 'sfd@se.com', 3, 'fgd', 121, 'N', 'N', '2020-10-08 17:42:33', '43.243.37.73'),
(24, 'ssdff', 'sfd@se.com', 3, 'fgd', 121, 'N', 'N', '2020-10-08 17:43:37', '43.243.37.73'),
(25, 'Ajinkya', 'Kalantri@syscort.com', 5, 'Ajinkya', 31, 'N', 'Y', '2020-10-08 18:50:53', '123.201.52.139'),
(26, 'Ajinkya', 'Kalantri@syscort.com', 5, 'Ajinkya', 31, 'N', 'N', '2020-10-08 18:51:58', '123.201.52.139'),
(27, 'renutest', 'r@mail.com', 4, 'test', 32, 'N', 'Y', '2020-10-09 15:37:51', '157.47.18.207'),
(28, 'renutest', 'r@mail.com', 4, 'test', 32, 'N', 'N', '2020-10-09 15:38:42', '157.47.18.207'),
(29, 'om', 'test@gmail.com', 5, 'hi', 32, 'N', 'N', '2020-10-10 17:21:01', '43.243.37.74'),
(30, 'om', 'test@gmail.com', 5, 'hi', 32, 'N', 'N', '2020-10-10 17:21:13', '43.243.37.74'),
(31, 'Omprakash Pal', 'omprakash.conceptioni@gmail.com', 5, 'hi', 32, 'N', 'N', '2020-10-10 17:21:36', '43.243.37.74'),
(32, 'Omprakash Pal', 'omprakash.conceptioni@gmail.com', 5, 'hi', 32, 'N', 'N', '2020-10-10 17:22:20', '43.243.37.74'),
(33, 'Omprakash Pal', 'omprakash.conceptioni@gmail.com', 5, 'hi', 32, 'N', 'N', '2020-10-10 17:28:26', '43.243.37.74'),
(34, 'Omprakash Pal', 'omprakash.conceptioni@gmail.com', 5, 'hi', 32, 'N', 'N', '2020-10-10 17:30:32', '43.243.37.74'),
(35, 'Omprakash Pal', 'omprakash.conceptioni@gmail.com', 5, 'hi', 32, 'N', 'N', '2020-10-10 17:30:32', '43.243.37.74'),
(36, 'Omprakash Pal', 'omprakash.conceptioni@gmail.com', 5, 'hi', 32, 'N', 'N', '2020-10-10 17:30:32', '43.243.37.74'),
(37, 'Omprakash Pal', 'omprakash.conceptioni@gmail.com', 5, 'hi', 32, 'N', 'N', '2020-10-10 17:32:41', '43.243.37.74');

-- --------------------------------------------------------

--
-- Table structure for table `mst_settings`
--

CREATE TABLE `mst_settings` (
  `int_glcode` int(11) NOT NULL,
  `var_title` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_value` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_settings`
--

INSERT INTO `mst_settings` (`int_glcode`, `var_title`, `var_value`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(1, 'minimum_amount', '50', '2019-09-25 14:37:54', '2020-10-07 11:41:34', '157.33.177.132');

-- --------------------------------------------------------

--
-- Table structure for table `mst_stors`
--

CREATE TABLE `mst_stors` (
  `int_glcode` int(11) NOT NULL,
  `var_name` varchar(50) NOT NULL,
  `var_address` varchar(100) NOT NULL,
  `var_lat` varchar(50) NOT NULL,
  `var_long` varchar(50) NOT NULL,
  `location` text NOT NULL,
  `chr_delete` varchar(1) NOT NULL DEFAULT 'N',
  `chr_publish` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_stors`
--

INSERT INTO `mst_stors` (`int_glcode`, `var_name`, `var_address`, `var_lat`, `var_long`, `location`, `chr_delete`, `chr_publish`) VALUES
(1, 'Conception I', 'A - 703, Titanium City Center, 100 Feet Anand Nagar Rd, Jodhpur Village, Ahmedabad, Gujarat 380015', '23.012510', '72.513474', 'Ved road, katargam', 'N', 'Y'),
(2, 'Test', 'Home', '21.229900', '72.827020', '', 'N', 'Y'),
(3, 'Pankaj Kumar', 'Abad sutgirini', '144', '36266', '', 'N', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `mst_testimonial`
--

CREATE TABLE `mst_testimonial` (
  `int_glcode` int(11) NOT NULL,
  `var_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `var_position` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `txt_description` text COLLATE latin1_general_ci NOT NULL,
  `var_image` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `chr_delete` char(11) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `chr_publish` char(11) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_testimonial`
--

INSERT INTO `mst_testimonial` (`int_glcode`, `var_name`, `var_position`, `txt_description`, `var_image`, `chr_delete`, `chr_publish`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(1, 'demo', 'developer', 'demo demo', '1599818862avatar5.png', 'N', 'Y', '2020-09-11 12:07:43', '2020-09-11 15:37:42', '43.248.39.196'),
(2, 'Demo1 ', 'Developer', 'Who do not know how to pursue an sed pleasure rationally encounter that are extremely win painful nor again is there anyone who loves or pursues or desires obtain pain itself circumstances.', '1599818849avatar3.png', 'N', 'Y', '2020-09-11 15:20:04', '2020-09-11 15:37:29', '43.248.39.196'),
(3, 'demo2', 'designer', 'Who do not know how to pursue an sed pleasure rationally encounter that are extremely win painful.', '1599818831avatar2.png', 'N', 'Y', '2020-09-11 15:35:02', '2020-09-11 15:37:11', '43.248.39.196'),
(4, 'demo3', 'tester', 'Who do not know how to pursue an sed pleasure rationally encounter that are extremely win painful.', '1599818816avatar.png', 'N', 'Y', '2020-09-11 15:36:56', '2020-09-11 15:36:56', '43.248.39.196'),
(5, 'REPL', 'Manager', 'test desc ', '1600239007author.png', 'N', 'Y', '2020-09-16 12:20:07', '2020-09-16 12:20:51', '202.149.217.178');

-- --------------------------------------------------------

--
-- Table structure for table `mst_users`
--

CREATE TABLE `mst_users` (
  `int_glcode` int(11) NOT NULL,
  `var_name` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `var_username` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `var_email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_mobile_no` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `var_alt_mobile` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `var_default_no` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_password` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `var_image` text COLLATE latin1_general_ci,
  `txt_address` text COLLATE latin1_general_ci,
  `var_otp` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `chr_verify` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `var_login_type` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_wallet` varchar(11) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `var_promo_status` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `var_auth_token` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_device_token` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `chr_publish` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `chr_delete` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `dt_timestamp` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_users`
--

INSERT INTO `mst_users` (`int_glcode`, `var_name`, `var_username`, `var_email`, `var_mobile_no`, `var_alt_mobile`, `var_default_no`, `var_password`, `var_image`, `txt_address`, `var_otp`, `chr_verify`, `var_login_type`, `var_wallet`, `var_promo_status`, `var_auth_token`, `var_device_token`, `chr_publish`, `chr_delete`, `dt_timestamp`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(1, 'Conception I Technology', NULL, 'conceptioni.technology@gmail.com', '7567878784', NULL, '7567878784', '122093094085089118006010010', '', NULL, '3410', 'Y', '', '0', 'N', '', 'cUFGRE1JZsY:APA91bGL8ovdaq1Hgnxh5S7tP54dN3SP0zhCCljd7BjijNA4AK2Oz-zfZjrW9SYMS-3V8ep54PA0Y2Tg7ebP6q4Gmy-Q4syX2R6pgYbDx0cDLNzTBnJQQPrvd4ghtXhABXexu5n4Cr6E', 'Y', 'Y', '', '2019-09-14 12:41:00', '2019-09-14 12:41:00', '43.243.38.101'),
(2, 'Santosh', NULL, 'santoshg1988@yahoo.com', '7977212545', NULL, '7977212545', '012068095081085092003002', '1568447374apple.jpg', NULL, '0602', 'Y', '', '0', 'N', '', 'ddz-brPsDTc:APA91bGWIAWcx_pUR5_CwCoaA1bGSUFR5YryMcT3_KA_ZrFmMcWBfwoQmUQ0hfyE--eJDhjWg6b1kMHwBwSGAWpDofsdN0t-3VMqoEMMVJwdZDBkMuYo4COF32unFhIYtRtdJmesdRik', 'Y', 'Y', '', '2019-09-14 12:47:01', '2019-09-14 13:19:34', '43.243.38.101'),
(13, 'vjvhvv', NULL, 'hvhvu@gmail.com', '7227887014', NULL, '7227887014', '021084065071116004004004', '', NULL, '9545', 'N', '', '0', 'N', '', 'fEyjsKYtVik:APA91bGJZGgBD2Ne7_uEEgffwlkJJ3iQAateyulVYuUQLLs2BDtdfknxJMg3z6Yn1tQCYGlDBZ-Uag4QD3xaSeLIQ_X7_5X9NJZGRaRuQsTLckvrUmq8V8oUQaaGYcddTw4qbovkUTVt', 'Y', 'N', '', '2019-10-01 14:33:18', '2019-10-01 14:33:18', ''),
(5, 'Grishma Conception I', NULL, 'ankitborad95@gmail.com', '7069747475', '1234567890', '', '112003001007001003001015', '', NULL, '1234', 'Y', '', '441.25', 'N', '', '', 'Y', 'N', '', '2019-09-20 10:51:31', '2020-05-25 18:12:30', '43.243.38.123'),
(31, 'test', NULL, 'test123@gmail.com', '8528552369', NULL, '8528552369', '125126114005007005', '', NULL, '', 'N', '', '0', 'N', '', 'cqubsdl7XTs:APA91bH2cCJZfPhADltBCR_NdjPFnv3cyeH-UNhktpYmm5d8t_JnAX-J-RxsYTb7iQHGaDLxRvTvBNAjQyX6vUT1NKkHSe8Z7api6TObar1CnTVmbbBtmeVGGytoyiIt7NF78SQ51dGk', 'Y', 'N', '', '2020-04-30 19:31:55', '2020-04-30 19:31:55', ''),
(6, 'Jemil Rathod', NULL, 'jemil4ne1@gmail.com', '7405171037', NULL, '7405171037', '125126114005007005', '', NULL, '4227', 'Y', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2019-09-21 20:28:16', '2019-09-21 20:28:16', '43.243.38.104'),
(7, 'pankaj pal', NULL, 'pankajpaaal@gmail.com', '9819622916', NULL, '9819622916', '099085091093086082121001120122116', '', NULL, '0303', 'Y', '', '0', 'N', '', 'dPjLMB7Ntpk:APA91bHjpQgIJr-wOzqSco_DRi-FL8AdPNnPgNmyszEjkYSjeci3t3eVGdihdAgmSleIuUpl72xqldS6ItYkoY4EkypY5PboLuoqGBkLPZiBHvVv-8BRdLc-oWqNyFqbyQtnSwcQ0bM8', 'Y', 'N', '', '2019-09-25 10:58:46', '2019-09-25 10:58:46', ''),
(21, 'pankaj pal', NULL, 'pankaj1514@yahoo.com', '7045923870', NULL, '7045923870', '099085091093086082121001120122116', '', NULL, '2751', 'Y', '', '0', 'N', '', 'e2mDpzZ0SyA:APA91bEVNbItOxYLsboEhdAwNmSSznmGEhcU3MqpoB0YkALf3xhStV2qVngMaDLID7PI9Rxtv4LLKnGp3F7vAhCSETKDFE0OvT7v2bCKk2V39me-bp0ajCphg0ZkmmrzECm60FK0ZsK4', 'Y', 'N', '', '2019-10-02 18:40:17', '2019-10-02 18:40:17', ''),
(8, 'komal', NULL, 'conceptioni.technology@gmail.com', '7567878784', NULL, '7567878784', '112086094093091118006010010', '', NULL, '4844', 'Y', '', '0', 'N', '', 'efsWV0VdRIY:APA91bHzuJBmwdy_jSuBE05Y_HLzI0ZdHj6jy0v6V9qXG-I8iC6vVDLTow3hfn5Lmd60hZe0zHg4iDSoWzYYhtVhU_Qb2y9hXWlw10tuVWr_kzSBm38uRygbYEYlK8EmbPjIXmKzYMP7', 'Y', 'N', '', '2019-09-25 17:14:50', '2019-09-25 17:14:50', ''),
(9, 'Kavita Gupta', NULL, 'kavi.gupta56@gmail.com', '9137089833', '9867162620', '', '012068095081085092003002', '', NULL, '5419', 'Y', '', '0', 'N', '', 'd6THj0v7MNY:APA91bEDCSIp0ENshBYMIhxzJssJhivm2CoDY1hXbjfMEnIbUoOhSf2efoUUxtBtnwnEv_3prEoqIesg-DAenvNZ3g5dIUyo6g1QgIsv0SZMWakkfDmxdSCyLTB4l7LACPLoQxXmfmyt', 'Y', 'Y', '', '2019-10-01 10:12:41', '2019-10-01 10:12:41', ''),
(10, 'komal', NULL, 'komal1190@gmail.com', '9016898021', NULL, '9016898021', '112086094093091118006010010', '', NULL, '3060', 'N', '', '0', 'N', '', 'fYtb7DS4p5s:APA91bEKdHoGr28c21_R0RpEnXQkcgE2stuXmj8ZaS9FH1AdFSHvLzhWOUtLXIb2EUH5lTCmnwMbQ7slUC7rQT2Ob2_23Gjtt0pSP9XQ7NL1Oc6RUuy_2GB7UeEqAfGRCFKiZVkWqxq5', 'Y', 'Y', '', '2019-10-01 13:12:00', '2019-10-01 13:12:00', ''),
(11, 'jjj', NULL, 'komal1190@gmail.com', '9016898021', NULL, '9016898021', '112086094093091118006010010', '', NULL, '0280', 'Y', '', '0', 'N', '', '', 'Y', 'Y', '', '2019-10-01 13:14:56', '2019-10-01 13:14:56', ''),
(15, 'cdhs', NULL, 'jdud@gmwil.com', '7227880146', NULL, '7227880146', '021084065071116004004004', '', NULL, '8684', 'Y', '', '0', 'N', '', '', 'Y', 'N', '', '2019-10-01 14:38:02', '2019-10-01 14:38:02', ''),
(12, 'hdf', NULL, 'test@gmail.com', '9016898021', NULL, '9016898021', '112086094093091118006010010', '', NULL, '9691', 'Y', '', '0', 'N', '', 'fYtb7DS4p5s:APA91bEKdHoGr28c21_R0RpEnXQkcgE2stuXmj8ZaS9FH1AdFSHvLzhWOUtLXIb2EUH5lTCmnwMbQ7slUC7rQT2Ob2_23Gjtt0pSP9XQ7NL1Oc6RUuy_2GB7UeEqAfGRCFKiZVkWqxq5', 'Y', 'Y', '', '2019-10-01 13:21:24', '2019-10-01 13:21:24', ''),
(16, 'komal', NULL, 'komal1190@gmail.com', '9016898021', '7405171037', '7405171037', '122093094085089118006010010', '', NULL, '1051', 'Y', '', '279', 'N', '', '', 'Y', 'N', '', '2019-10-01 19:09:45', '2019-10-01 19:09:45', ''),
(18, 'bzjxj', NULL, 'xjxjx@gmail.com', '8866656431', NULL, '8866656431', '021084065071116004004004', '', NULL, '0683', 'Y', '', '0', 'N', '', 'dDFcGyHMF6M:APA91bEjwamHUTG5RptFD1xODgi-UtDInvCBtfQXdUnRs9C4KMd1g6WhU5DhggQOp4Yb4JmL6Xb20X-wcxRarmWtGE-RSTs_lHJsbmjyASh6WyVmgogwFr8oaeb2wucY16q8bLqKcMQU', 'Y', 'N', '', '2019-10-01 21:48:27', '2019-10-01 21:48:27', ''),
(17, 'jemil', NULL, 'jemilrathod@gmail.com', '7405171037', NULL, '7405171037', '112086094093091118006010010', '', NULL, '0206', 'Y', '', '0', 'N', '', 'fL3sb-f48YE:APA91bH19SXEWZKpx14-o7ACxAhUiue63rqSNz3gHTjovGJ2op3M5PpYWJ4fEjvPGsypFA9t5q70taWcMxZsM5eiXMDsMXGvmIiN49OqEU6z_vb1UCWHb6pZl5aiX9zbP7sOcTY_lyQi', 'Y', 'N', '1588144069', '2019-10-01 20:49:27', '2019-10-01 20:49:27', ''),
(49, 'test', NULL, 'p213@gmail.com', '5645654565', NULL, '5645654565', '116104122', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2020-05-27 16:45:30', '2020-05-27 16:45:30', '103.249.233.26'),
(20, 'Testaccount Byci', NULL, 'testbyconceptioni@gmail.com', '7744885511', NULL, '7744885511', '021084065071116004004004', '', NULL, '6159', 'Y', '', '0', 'N', '', NULL, 'Y', 'N', '', '2019-10-02 14:51:09', '2019-10-02 14:51:09', '43.243.38.112'),
(22, 'Kavita Gupta', NULL, 'vruitsindia@gmail.com', '+198671626', NULL, '+198671626', '012068095081085092000014', '', NULL, '4696', 'N', '', '0', 'N', '', 'cDpuG15WKdQ:APA91bEFrPQPKc8D2vupG9PnJlz5TKz9joTIRqDcTfy3N9ps_CV2-oObo1Jx7rf9lR1necX9-xOfBtg607zEN1D52_0CXEuejE_ZaGJ9YOVvAgiwQlugp168IrX8MCQgt4PQrjRmpqz6', 'Y', 'Y', '', '2019-10-02 19:44:37', '2019-10-02 19:44:37', ''),
(23, 'Kavita Gupta', NULL, 'kavi.gupta56@gmail.com', '9867162620', NULL, '9867162620', '012068095081085092000014', '', NULL, '3759', 'Y', '', '0', 'N', '', 'cDpuG15WKdQ:APA91bEFrPQPKc8D2vupG9PnJlz5TKz9joTIRqDcTfy3N9ps_CV2-oObo1Jx7rf9lR1necX9-xOfBtg607zEN1D52_0CXEuejE_ZaGJ9YOVvAgiwQlugp168IrX8MCQgt4PQrjRmpqz6', 'Y', 'Y', '', '2019-10-02 19:48:41', '2019-10-02 19:48:41', ''),
(24, 'Jemil Rathod', NULL, 'jemil4ne1@gmail.com', NULL, NULL, '', NULL, NULL, NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2019-10-09 07:56:10', '2019-10-09 07:56:10', '43.243.39.153'),
(25, 'samkit', 'sam', 'someone22.33@gmail.com', '9806480335', NULL, '9806480335', '127112066083031007004', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2020-04-09 16:08:11', '2020-04-09 16:08:11', '122.168.149.118'),
(26, 'test', NULL, 'test@gmail.com', '8520852085', NULL, '8520852085', '125126114000000000', '', NULL, '0683', 'Y', '', '0', 'N', '', 'dsAJyAdBl9U:APA91bGRvIXdQBtbpMCS6F1s2desP6DU8PVvj7xk65uh70bMxFYizkNNw0RVOr9wtjJErgo0F4nGHcQfaqBU8sg3uGOiuYNQl3h3lw-dTyPKjnMEzR51u_xCYBhPAWhDPoHv64Bt2jiw', 'Y', 'N', '', '2020-04-22 15:54:28', '2020-04-22 15:54:28', ''),
(27, 'Kirthika Suryah', NULL, 'kirthikaecs@gmail.com', '9894447000', '9894447177', '9894447000', '009080066067077117006006', '15889539091588953901132profile1.png', NULL, '7962', 'Y', '', '0', 'N', '', 'dUNdfSorAVM:APA91bGmk7GarRWzxcMVNvp8qBkbXAJpxUb9PsJl0F6zbch35oTPkwgNdU6sl67JrPtF3cE6P1_iqQZMbivpoia0bmWEs3zBafZjC0Syw-6h7X1lxB0nt1yF2GhwOKF2EUm1uR7LyoCL', 'Y', 'N', '', '2020-04-29 12:30:38', '2020-05-08 21:46:08', ''),
(28, 'Pradeep', NULL, 'prad.psg@gmail.com', '9789985950', NULL, '9789985950', '045035082086002006006', '', NULL, '8106', 'Y', '', '0', 'N', '', '', 'Y', 'N', '1589996169', '2020-04-29 12:32:42', '2020-04-29 12:34:37', ''),
(30, 'komal', NULL, 'komalrathod1190@gmail.com', '8000034939', NULL, '8000034939', '125126114005007005', '', NULL, '8080', 'Y', '', '0', 'N', '', 'cANBT4BQouQ:APA91bHw5nPdIX4N7D2-DJbb3zc_45r8Jlmj6OuF_KsKgqpG978ad53wRWXB0ozYeePiokScaHO5VQ8sODRhefSiladFRxOKzjr3JlpfbBia6-wjyMiWl5r82KSq1jOXq-_liftvlwGV', 'Y', 'N', '', '2020-04-29 12:40:32', '2020-04-29 12:40:32', ''),
(29, 'jemil', NULL, 'jemilrathod1@gmail.com', '7405171039', NULL, '7405171039', '125126114005007005', '', NULL, '1099', 'N', '', '0', 'N', '', 'cANBT4BQouQ:APA91bHw5nPdIX4N7D2-DJbb3zc_45r8Jlmj6OuF_KsKgqpG978ad53wRWXB0ozYeePiokScaHO5VQ8sODRhefSiladFRxOKzjr3JlpfbBia6-wjyMiWl5r82KSq1jOXq-_liftvlwGV', 'Y', 'N', '', '2020-04-29 12:33:28', '2020-04-29 12:33:28', ''),
(48, 'test', NULL, 'p213@gmail.com', '5645654565', NULL, '5645654565', '116104122', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2020-05-27 16:43:52', '2020-05-27 16:43:52', '103.249.233.26'),
(47, 'parth', NULL, 'p213@gmail.com', '2312312321', NULL, '2312312321', '112086094093091118006010010', '1590577933images.png', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2020-05-27 16:42:13', '2020-05-27 16:42:13', '103.249.233.26'),
(32, 'test', NULL, 'test12568@gmail.com', '8528552381', NULL, '8528552381', '125126114005007005', '', NULL, '', 'N', '', '0', 'N', '', 'cqubsdl7XTs:APA91bH2cCJZfPhADltBCR_NdjPFnv3cyeH-UNhktpYmm5d8t_JnAX-J-RxsYTb7iQHGaDLxRvTvBNAjQyX6vUT1NKkHSe8Z7api6TObar1CnTVmbbBtmeVGGytoyiIt7NF78SQ51dGk', 'Y', 'Y', '', '2020-04-30 19:32:17', '2020-04-30 19:32:17', ''),
(33, 'test', NULL, 'test123q@gmail.com', '8528552356', NULL, '8528552356', '125126114005007005', '1588265860IMG0278.JPG', NULL, '', 'N', '', '0', 'N', '', 'cqubsdl7XTs:APA91bH2cCJZfPhADltBCR_NdjPFnv3cyeH-UNhktpYmm5d8t_JnAX-J-RxsYTb7iQHGaDLxRvTvBNAjQyX6vUT1NKkHSe8Z7api6TObar1CnTVmbbBtmeVGGytoyiIt7NF78SQ51dGk', 'N', 'N', '', '2020-04-30 19:36:01', '2020-04-30 22:27:40', '49.207.134.58'),
(34, 'abcdef', '', 'hsfhjshfgsh@gmail.com', '9876543211', NULL, '9876543211', '125126114005007005', '1588266585IMG0278.JPG', NULL, '', 'N', '', '0', 'N', '', NULL, 'N', 'N', '', '2020-04-30 22:39:45', '2020-04-30 22:39:45', '49.207.134.58'),
(35, 'jhdfjd', '', 'hsjgs@gmail.com', '9876543323', NULL, '9876543323', '046048057037', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-04-30 22:42:42', '2020-04-30 22:42:42', '49.207.134.58'),
(36, 'hsdjsdmx', 'admin@gramango.com', 'viyhsdukj@gmail.com', '9898989898', NULL, '9898989898', '125126114005007005', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-04-30 22:44:08', '2020-04-30 22:44:08', '49.207.134.58'),
(37, 'test', NULL, 'test3456@gmail.com', '8855220088', NULL, '8855220088', '125125115003001000', '', NULL, '', 'N', '', '0', 'N', '', 'cqubsdl7XTs:APA91bH2cCJZfPhADltBCR_NdjPFnv3cyeH-UNhktpYmm5d8t_JnAX-J-RxsYTb7iQHGaDLxRvTvBNAjQyX6vUT1NKkHSe8Z7api6TObar1CnTVmbbBtmeVGGytoyiIt7NF78SQ51dGk', 'Y', 'N', '', '2020-05-01 18:34:04', '2020-05-01 18:34:04', ''),
(38, 'test', NULL, 'test34566@gmail.com', '8855220089', NULL, '8855220089', '125125115003001000', '', NULL, '', 'N', '', '0', 'N', '', 'cqubsdl7XTs:APA91bH2cCJZfPhADltBCR_NdjPFnv3cyeH-UNhktpYmm5d8t_JnAX-J-RxsYTb7iQHGaDLxRvTvBNAjQyX6vUT1NKkHSe8Z7api6TObar1CnTVmbbBtmeVGGytoyiIt7NF78SQ51dGk', 'Y', 'N', '', '2020-05-01 18:35:15', '2020-05-01 18:35:15', ''),
(39, 'test', NULL, 'test343456@gmail.com', '8855220099', NULL, '8855220099', '125125115003001000', '', NULL, '7482', 'N', '', '0', 'N', '', 'cqubsdl7XTs:APA91bH2cCJZfPhADltBCR_NdjPFnv3cyeH-UNhktpYmm5d8t_JnAX-J-RxsYTb7iQHGaDLxRvTvBNAjQyX6vUT1NKkHSe8Z7api6TObar1CnTVmbbBtmeVGGytoyiIt7NF78SQ51dGk', 'Y', 'N', '', '2020-05-01 18:37:24', '2020-05-01 18:37:24', ''),
(40, 'demo', NULL, 'demo@gmail.com', '7418529630', NULL, '7418529630', '125126114005007005', '', NULL, '8542', 'N', '', '0', 'N', '', 'cqubsdl7XTs:APA91bH2cCJZfPhADltBCR_NdjPFnv3cyeH-UNhktpYmm5d8t_JnAX-J-RxsYTb7iQHGaDLxRvTvBNAjQyX6vUT1NKkHSe8Z7api6TObar1CnTVmbbBtmeVGGytoyiIt7NF78SQ51dGk', 'Y', 'N', '', '2020-05-01 19:03:11', '2020-05-01 19:03:11', ''),
(41, 'Test', NULL, 'devvyvu@gmail.com', '7539628285', NULL, '7539628285', '125126114005007005', '', NULL, '3919', 'N', '', '0', 'N', '', 'cqubsdl7XTs:APA91bH2cCJZfPhADltBCR_NdjPFnv3cyeH-UNhktpYmm5d8t_JnAX-J-RxsYTb7iQHGaDLxRvTvBNAjQyX6vUT1NKkHSe8Z7api6TObar1CnTVmbbBtmeVGGytoyiIt7NF78SQ51dGk', 'Y', 'N', '', '2020-05-01 19:05:47', '2020-05-01 19:05:47', ''),
(42, 'yehd', NULL, 'bdjsh@gmail.com', '9787364645', NULL, '9787364645', '125126114005007005', '', NULL, '9292', 'N', '', '0', 'N', '', 'cqubsdl7XTs:APA91bH2cCJZfPhADltBCR_NdjPFnv3cyeH-UNhktpYmm5d8t_JnAX-J-RxsYTb7iQHGaDLxRvTvBNAjQyX6vUT1NKkHSe8Z7api6TObar1CnTVmbbBtmeVGGytoyiIt7NF78SQ51dGk', 'Y', 'N', '', '2020-05-01 19:07:51', '2020-05-01 19:07:51', ''),
(46, 'Divya', NULL, 'admin@gramango.com', '8767785937', NULL, '8767785937', '112086094093091118006010010', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-05-15 22:18:56', '2020-05-15 22:18:56', '49.207.142.1'),
(43, 'Pradeep', 'Great', 'pradeep.gkp@gmail.com', '9384000938', NULL, '9384000938', '125126114005007005', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-05-03 20:40:44', '2020-05-03 20:40:44', '49.207.131.108'),
(44, 'fhghjg', 'Super', 'hghf@gmail.com', '8765432325', NULL, '8765432325', '125126114005007005', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2020-05-03 20:42:05', '2020-05-09 18:46:20', '42.106.44.38'),
(45, 'Madhumitha', NULL, 'madhu@gramango.com', '7338557333', NULL, '7338557333', '045035082086002006006', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-05-14 20:39:33', '2020-05-15 21:48:05', '49.207.142.1'),
(50, 'test', NULL, 'p213@gmail.com', '5645654565', NULL, '5645654565', '116104122', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2020-05-27 16:46:58', '2020-05-27 16:46:58', '103.249.233.26'),
(51, 'test', NULL, 'p213@gmail.com', '5645654565', NULL, '5645654565', '036041040', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2020-05-27 16:52:09', '2020-05-27 16:52:09', '103.249.233.26'),
(52, 'parth', NULL, 'pasd213@gmail.com', '7845121111', NULL, '7845121111', '036041045', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2020-05-27 17:23:44', '2020-05-27 17:23:44', '157.32.165.14'),
(53, 'test', NULL, 'p213@gmail.com', '5645654565', NULL, '5645654565', '036041040', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2020-05-27 17:26:07', '2020-05-27 17:26:07', '157.32.165.14'),
(54, 'Bava tharani', NULL, 'bavatharanim98@gmail.com', '9500849926', NULL, '9500849926', '116086078088068041035049037043047126112009', '', NULL, '6366', 'N', '', '0', 'N', '', '', 'Y', 'N', '', '2020-06-11 22:00:15', '2020-06-11 22:00:15', ''),
(55, 'Guru', NULL, 'eguru97@gmail.com', '7708960230', NULL, '7708960230', '069090086070092095007008014', '', NULL, '5463', 'N', '', '0', 'N', '', '', 'Y', 'N', '', '2020-06-11 22:26:59', '2020-06-11 22:26:59', ''),
(56, 'Raveena Krishnan', NULL, 'raveenakrishnan1995@gmail.com', '9629139970', NULL, '9629139970', '011005006012007004001000007113', '', NULL, '3197', 'N', '', '0', 'N', '', '', 'Y', 'N', '', '2020-06-14 17:50:49', '2020-06-14 17:50:49', ''),
(57, 'Bhavesh ', NULL, 'Bhavesh@gmail.com', '1010101010', NULL, '1010101010', '125126114005007005', '', NULL, '1234', 'N', '', '0', 'N', '', 'dQjp1tYku0MXhwgByyx9xx:APA91bGAehIitGCsXn6KzGm21zkBBv1hwQtZDvmb2-oPJPHwNm2RxX5j8epZ4f5MtuNOfmkbJcbVKZWP8MUxt73MuutHtBDV4rVq4hVjIBnGMRY-Vprq4VGL4qVa0lr_UuEOf1RJ3blc', 'Y', 'N', '', '2020-08-20 20:30:13', '2020-08-20 20:30:13', ''),
(74, 'milan', NULL, 'milantejani786@gmail.com', '8758991234', NULL, '8758991234', '125126114005007005', '', NULL, '1234', 'N', '', '0', 'N', '', NULL, 'Y', 'Y', '', '2020-10-01 16:57:16', '2020-10-01 16:57:16', '139.5.22.143'),
(73, 'sayali', NULL, 'marketing1@burlyfield.com', '1234512345', NULL, '1234512345', '080080080080117007005011013', '', NULL, '1234', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-09-30 15:53:44', '2020-09-30 15:53:44', '106.193.187.20'),
(72, 'Sayali', NULL, 'marketing@burlyfield.com', '1234123412', NULL, '1234123412', '084066074085073039043038040033006118122122', '', NULL, '', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-09-24 15:37:35', '2020-09-24 15:38:17', '106.193.144.41'),
(71, 'renuka soni', NULL, 'renuka.soni@syscort.com', '8669090580', NULL, '8669090580', '041038034037', '1601987164nes.jpg', NULL, '1234', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-09-24 14:42:00', '2020-10-07 11:33:58', '157.33.177.132'),
(70, 'pradnya shroff', NULL, 'ppshroff@ruchagroup.com', '9112237805', NULL, '9112237805', '116066074085073039043038040033006118122122', '1602255894avatar3.png', NULL, '1234', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-09-20 15:46:00', '2020-10-09 20:34:54', '116.73.83.215'),
(69, 'Badal', NULL, 'badal@gmail.com', '1212121212', NULL, '1212121212', '125126114005007005', '', NULL, '1234', 'N', '', '0', 'N', '', NULL, 'N', 'N', '', '2020-09-16 09:56:18', '2020-09-16 09:56:18', '43.243.37.72'),
(68, 'janki', NULL, 'janki001@mailcatch.com', '8787989898', NULL, '8787989898', '116119119083036050055045042040046008120120120', '', NULL, '1234', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-09-14 17:53:15', '2020-09-14 17:53:15', '43.243.37.66'),
(87, 'chirag', NULL, 'chiragmathukiya30@gmail.com', '8758999139', NULL, '8758999139', '120126127117004', '', NULL, '1234', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-10-13 14:02:53', '2020-10-13 14:02:53', '43.248.36.10'),
(84, 'ajinkya', NULL, 'ajinkya.kalantri@syscort.com', '9373163977', NULL, '9373163977', '032029040126070006', '', NULL, '1234', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '1603093915', '2020-10-08 18:35:29', '2020-10-08 18:35:29', '123.201.52.139'),
(89, 'janki', NULL, 'job123@mailcatch.com', '8790654370', NULL, '8790654370', '011094080002006006021019', '', NULL, '1234', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '', '2020-10-16 18:04:09', '2020-10-16 18:04:09', '43.243.37.78'),
(88, 'Demo', NULL, 'chirag@cidev.in', '8758999138', NULL, '8758999138', '039054038088001002', '', NULL, '1234', 'N', '', '0', 'N', '', NULL, 'Y', 'N', '1603093215', '2020-10-13 14:34:55', '2020-10-13 14:34:55', '43.248.36.10');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user_address`
--

CREATE TABLE `mst_user_address` (
  `int_glcode` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `var_house_no` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `var_app_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `var_landmark` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `var_country` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_state` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_city` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_pincode` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `chr_type` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `default_status` varchar(10) COLLATE latin1_general_ci DEFAULT 'Y',
  `chr_publish` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `chr_delete` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_user_address`
--

INSERT INTO `mst_user_address` (`int_glcode`, `fk_user`, `var_house_no`, `var_app_name`, `var_landmark`, `var_country`, `var_state`, `var_city`, `var_pincode`, `chr_type`, `default_status`, `chr_publish`, `chr_delete`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(1, 5, 'A - 703', 'Titanium city center', 'Aanad nagar road', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2019-09-20 10:51:33', '2019-09-20 10:51:33', '43.243.38.123'),
(2, 6, '', 'a 703', 'as', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2019-09-21 20:28:19', '2019-09-21 20:28:19', '43.243.38.104'),
(3, 4, '123', 'test', 'test', 'india', 'test', 'test', '385098', 'Home', 'Y', 'Y', 'N', '2019-09-24 19:31:09', '2019-09-24 19:31:09', ''),
(4, 7, '423', 'Gazdhar Bandh Rd', 'narendra apt, santacruz-west ', 'India', 'Maharashtra', 'Mumbai', '400054', 'Home', 'Y', 'Y', 'N', '2019-09-25 10:58:46', '2019-10-01 21:57:19', ''),
(6, 8, '123', 'test', 'test', 'test', 'test', 'test', '380051', 'Home', 'N', 'Y', 'Y', '2019-09-26 12:20:11', '2019-09-26 12:20:11', ''),
(7, 8, 'Aaa', 'fjjgk', 'djfj', 'duri', 'dufuf', 'dhfi', '535585', 'Office', 'N', 'Y', 'Y', '2019-09-26 12:26:09', '2019-09-26 12:26:09', ''),
(8, 2, '1', 'nagrik vikas seva mandal', 'jawahar nagar', 'indiq', 'maharashtra', 'mumbi', '400055', 'Home', 'Y', 'Y', 'N', '2019-09-30 20:54:54', '2019-09-30 20:54:54', ''),
(9, 9, '1', 'Nagrik vikas seva mandal', 'nagardas road', 'India', 'maharashtra ', 'mumbai', '400055', 'Home', 'Y', 'Y', 'N', '2019-10-01 10:12:41', '2019-10-01 10:12:41', ''),
(10, 10, 'tttt', 'yyy', 'ggg', 'India', 'bbb', 'hhh', '380015', 'Home', 'Y', 'Y', 'N', '2019-10-01 13:12:00', '2019-10-01 13:12:00', ''),
(11, 11, 'hxhx', 'xgxzgxg', 'xhx', 'India', 'xhx', 'xhxh', '380015', 'Home', 'Y', 'Y', 'N', '2019-10-01 13:14:56', '2019-10-01 13:14:56', ''),
(12, 12, 'vxg', 'xggg', 'chch', 'chxhxIndia', 'hchc', 'xhdhx', '380015', 'Home', 'Y', 'Y', 'N', '2019-10-01 13:21:24', '2019-10-01 13:21:24', ''),
(13, 13, 'ehd', 'f', 'r', 'India', 'yfy', 'r', '926955', 'Home', 'Y', 'Y', 'N', '2019-10-01 14:33:18', '2019-10-01 14:33:18', ''),
(14, 14, 'dgdhjd', 'dghdk', 'dyndur', 'India', 'brhdhd', 'ududu', '458389', 'Home', 'Y', 'Y', 'N', '2019-10-01 14:35:05', '2019-10-01 14:35:05', ''),
(15, 15, 'dhyd', 'dhdhr', 'rhrjdie', 'India', 'bdjd', 'djdndid', '386986', 'Home', 'Y', 'Y', 'N', '2019-10-01 14:38:02', '2019-10-01 14:38:02', ''),
(16, 16, 'gv', 'vvv', 'bb', 'India', 'gujrat', 'bb', '380015', 'Home', 'Y', 'Y', 'N', '2019-10-01 19:09:45', '2019-10-01 19:09:45', ''),
(17, 17, 'A 1090', 'test', 'test', 'India', 'test', 'test', '380015', 'Home', 'Y', 'Y', 'N', '2019-10-01 20:49:27', '2019-10-01 20:49:27', ''),
(18, 18, 'sbshsh', 'sdjdjjd', 'hd', 'dyIndia', 'djd', 'zyhz', '464686', 'Home', 'Y', 'Y', 'N', '2019-10-01 21:48:27', '2019-10-01 21:48:27', ''),
(19, 19, 'djfjf', 'dydud', 'dhddj', 'India', 'xudu', 'duud', '496563', 'Home', 'Y', 'Y', 'N', '2019-10-01 21:50:11', '2019-10-01 21:50:11', ''),
(20, 20, 'oo - 22', 'Shantinath society', 'Vejalpur bus stand', 'India', 'Maharastra', 'Mumbai', '748596', 'Home', 'Y', 'Y', 'N', '2019-10-02 14:51:10', '2019-10-02 14:51:10', '43.243.38.112'),
(21, 21, '423', 'Gazdhar Bandh Rd', 'sb patil marg ', 'India', 'Maharashtra', 'Mumbai', '400054', 'Home', 'Y', 'Y', 'N', '2019-10-02 18:40:17', '2019-10-02 18:40:17', ''),
(22, 2, '1', 'gupta house', 'parsi panchayat, nagardas Road, Andheri East ', 'india', 'maharashtra ', 'mumbai', '400069', 'Other', 'N', 'Y', 'N', '2019-10-02 19:34:29', '2019-10-02 19:34:29', ''),
(23, 22, '1', 'gupta house', 'parsi panchayat road', 'India', 'maharashtra ', 'mumbai', '400069', 'Home', 'Y', 'Y', 'N', '2019-10-02 19:44:37', '2019-10-02 19:44:37', ''),
(24, 23, '1, Gupta house', 'golibar road khar east', 'khar east', 'India', 'maharashtra', 'mumbai ', '400055', 'Home', 'Y', 'Y', 'N', '2019-10-02 19:48:41', '2019-10-03 09:10:34', ''),
(25, 8, 'A ', 'titanium city centre', 'seema hall', 'india', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2019-10-02 21:24:49', '2019-10-02 21:24:49', ''),
(26, 25, '180', 'Dee', 'Er', '', '', '', '', 'Home', 'Y', 'Y', 'N', '2020-04-09 16:08:11', '2020-04-09 16:08:11', '122.168.149.118'),
(27, 26, '123', 'Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2020-04-22 15:54:28', '2020-04-22 15:54:28', ''),
(28, 27, '2c 2nd floor Jamls a', 'Vadapalani Vadapalani, ', '278', 'India', 'Tamil Nadu', 'Chennai', '600026', 'Home', 'N', 'Y', 'N', '2020-04-29 12:30:38', '2020-05-01 00:21:18', ''),
(29, 28, '60 Prasanth Manor\n', 'Vadapalani Vadapalani, ', '278', 'India', 'Tamil Nadu', 'Chennai', '600026', 'Home', 'Y', 'Y', 'N', '2020-04-29 12:32:42', '2020-04-29 12:32:42', ''),
(30, 29, '17 parashat maner ', 'Vadapalani Vadapalani, ', '278', 'India', 'Tamil Nadu', 'Chennai', '600026', 'Home', 'Y', 'Y', 'N', '2020-04-29 12:33:28', '2020-04-29 12:33:28', ''),
(31, 30, 'a 703', 'Sun South Park B/H SoBo Center, B/s, Gala Swing, South Bopal, Bopal, ', 'Gala Swing', 'India', 'Gujarat', 'Ahmedabad', '380058', 'Home', 'Y', 'Y', 'N', '2020-04-29 12:40:32', '2020-04-29 12:40:32', ''),
(32, 5, '123', 'Titanium City Center Titanium City Center, 100 Feet Anand Nagar Rd, Jodhpur Village, ', '100 Feet Anand Nagar Road', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'N', 'Y', 'Y', '2020-04-29 17:21:57', '2020-04-29 17:21:57', ''),
(33, 5, '123', 'Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'N', 'Y', 'Y', '2020-04-29 17:56:22', '2020-04-29 17:56:22', ''),
(34, 5, '123', 'Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Office', 'N', 'Y', 'Y', '2020-04-29 17:57:49', '2020-04-29 17:57:49', ''),
(35, 5, '123', 'Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'N', 'Y', 'Y', '2020-04-29 18:02:59', '2020-04-29 18:02:59', ''),
(36, 5, '123', '123, Test Yantra Software Solutions  Pvt Ltd 50, 2nd Floor, Brigade MLR Center, Vanivilas Rd, Gandhi Bazaar, Basavanagudi, ', '50', 'India', 'Karnataka', 'Bengaluru', '560004', 'Office', 'N', 'Y', 'N', '2020-04-29 20:15:02', '2020-04-29 20:15:02', ''),
(37, 27, 'prashant manor', 'prashant manor, Vadapalani Vadapalani, ', '278', 'India', 'Tamil Nadu', 'Chennai', '600026', 'Home', 'N', 'Y', 'Y', '2020-04-30 12:32:28', '2020-04-30 12:32:28', ''),
(38, 31, '123', 'Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2020-04-30 19:31:55', '2020-04-30 19:31:55', ''),
(39, 32, '123', 'Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2020-04-30 19:32:17', '2020-04-30 19:32:17', ''),
(40, 33, '123', 'Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2020-04-30 19:36:01', '2020-04-30 22:27:40', '49.207.134.58'),
(41, 34, '6455347, uifjb', 'Jamals', 'yigeysfgjshdx', 'India', 'TN', 'Chennai', '600017', 'Home', 'Y', 'Y', 'N', '2020-04-30 22:39:45', '2020-04-30 22:39:45', '49.207.134.58'),
(42, 35, '6458739w', 'bjkdhjvx', 'hsbfhjsx', 'fhabhfb', 'sdhfbhn', 'hfehgdhe', 'sbhsd', 'Home', 'Y', 'Y', 'N', '2020-04-30 22:42:42', '2020-04-30 22:42:42', '49.207.134.58'),
(43, 36, 'ydfvhdjkx', '', '', '', '', '', '', 'Home', 'Y', 'Y', 'N', '2020-04-30 22:44:08', '2020-04-30 22:44:08', '49.207.134.58'),
(44, 37, '123', '123, Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2020-05-01 18:34:04', '2020-05-01 18:34:04', ''),
(45, 38, '123', '123, Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2020-05-01 18:35:15', '2020-05-01 18:35:15', ''),
(46, 39, '123', '123, Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2020-05-01 18:37:24', '2020-05-01 18:37:24', ''),
(47, 40, '123', '123, Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2020-05-01 19:03:11', '2020-05-01 19:03:11', ''),
(48, 41, '123', '123, Titanium City Centre Mall Prahlad Nagar Rd, Satellite, ', 'Aditraj Complex', 'India', 'Gujarat', 'Ahmedabad', '380015', 'Home', 'Y', 'Y', 'N', '2020-05-01 19:05:47', '2020-05-01 19:05:47', ''),
(49, 42, '1234', '1234, Titanium Towers Titanium Towers, Sahakar Nagar Rd, Sahakar Nagar, Azad Nagar, Andheri West, ', 'Titanium Towers', 'India', 'Maharashtra', 'Mumbai', '400058', 'Home', 'Y', 'Y', 'N', '2020-05-01 19:07:51', '2020-05-01 19:07:51', ''),
(50, 43, 'kjhbyu iu lk', '', '', 'lkbuyv u', '', '', '', 'Home', 'Y', 'Y', 'N', '2020-05-03 20:40:44', '2020-05-03 20:40:44', '49.207.131.108'),
(51, 44, 'dfytuj', 'app', '', '', '', '', '', 'Home', 'Y', 'Y', 'N', '2020-05-03 20:42:05', '2020-05-09 18:46:20', '42.106.44.38'),
(52, 27, '67 Thoas', '67 Thoas, Bangalore City Railway Station Gubbi Thotadappa Rd, Kempegowda, Gandhi Nagar, ', 'Kempegowda Bus Station', 'India', 'Karnataka', 'Bengaluru', '560023', 'Home', 'Y', 'Y', 'N', '2020-05-08 21:48:24', '2020-05-08 21:48:24', ''),
(53, 45, '22 Ashok Nagar', 'Prashant Manor', 'Chetty Street', 'India', 'Tamil Nadu', 'Chennai', '600045', 'Other', 'Y', 'Y', 'N', '2020-05-14 20:39:33', '2020-05-15 21:48:05', '49.207.142.1'),
(54, 46, '1234', 'Hosa Road', 'Opp to Private Matric School', 'India', 'Karnataka', 'Bangalore', '560017', 'Home', 'Y', 'Y', 'N', '2020-05-15 22:18:56', '2020-05-15 22:18:56', '49.207.142.1'),
(55, 47, '202', 'ejwk', 'jskd', 'India', 'gujarat', 'ahmedabad', '45411212', 'Home', 'Y', 'Y', 'N', '2020-05-27 16:42:13', '2020-05-27 16:42:13', '103.249.233.26'),
(56, 48, 'af', 'sda', 'asd', 'India', 'gujarat', 'ahmedabad', '45411212', 'Home', 'Y', 'Y', 'N', '2020-05-27 16:43:52', '2020-05-27 16:43:52', '103.249.233.26'),
(57, 49, 'asd', 'asda', 'asds', 'India', 'gujarat', 'ahmedabad', '45411212', 'Home', 'Y', 'Y', 'N', '2020-05-27 16:45:30', '2020-05-27 16:45:30', '103.249.233.26'),
(58, 50, 'sddsf', 'das', 'sfd', 'India', 'gujarat', 'ahmedabad', '45411212', 'Home', 'Y', 'Y', 'N', '2020-05-27 16:46:58', '2020-05-27 16:46:58', '103.249.233.26'),
(59, 51, 'assds', 'sda', 'asd', 'India', 'gujarat', 'ahmedabad', '45411212', 'Home', 'Y', 'Y', 'N', '2020-05-27 16:52:09', '2020-05-27 16:52:09', '103.249.233.26'),
(60, 52, 'sa', 'sd', 'dsf', 'India', 'Gujarat', 'Ahmedabad', '382350', 'Home', 'Y', 'Y', 'N', '2020-05-27 17:23:44', '2020-05-27 17:23:44', '157.32.165.14'),
(61, 53, 'sad', 'asd', 'ada', 'India', 'gujarat', 'ahmedabad', '45411212', 'Home', 'Y', 'Y', 'N', '2020-05-27 17:26:07', '2020-05-27 17:26:07', '157.32.165.14'),
(62, 54, '6/64 Malaisaamy kovi', '6/64MalaisaamykovilstreetmadukaraiCoimbatore', 'water tank', 'India', 'Tamil Nadu', 'Coimbatore', '641105', 'Home', 'Y', 'Y', 'N', '2020-06-11 22:00:15', '2020-06-11 22:00:15', ''),
(63, 55, 'No. 6', 'Siva Nagar', 'Near Thirumoolam Varma Research Centre', 'India', 'Tamilnadu', 'Coimbatore', '641030', 'Home', 'Y', 'Y', 'N', '2020-06-11 22:26:59', '2020-06-11 22:26:59', ''),
(64, 56, 'Indira Nagar, Dharma', 'IndiraNagarDharmapuri', 'railway station', 'India', 'Karnataka', 'Bengaluru', '560068', 'Home', 'Y', 'Y', 'N', '2020-06-14 17:50:49', '2020-06-14 17:50:49', ''),
(65, 57, '', '', '', '', '', '', '', 'Home', 'Y', 'Y', 'N', '2020-08-20 20:30:13', '2020-08-20 20:30:13', ''),
(66, 72, '12', 'abc', '', 'India', 'maharadhtra', 'Pune', '411021', 'Home', 'Y', 'Y', 'N', '2020-09-24 15:37:35', '2020-09-24 15:38:17', '106.193.144.41'),
(67, 67, '404', 'sravani', 'gangotri nagar-2', 'India', 'Gujarat', 'Surat', '395004', 'Home', 'Y', 'Y', 'N', '2020-09-26 16:03:03', '2020-09-26 16:03:03', '45.126.147.180'),
(68, 83, '404', 'sravani crupa', 'gangotri nagR-2', 'India', 'Gujarat', 'Surat', '395004', 'Home', 'Y', 'Y', 'N', '2020-10-07 16:57:41', '2020-10-07 17:13:09', '43.248.38.250');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user_chat`
--

CREATE TABLE `mst_user_chat` (
  `int_glcode` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `send_by` char(11) NOT NULL,
  `txt_msg` text NOT NULL,
  `dt_createddate` datetime NOT NULL,
  `int_seen` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user_chat`
--

INSERT INTO `mst_user_chat` (`int_glcode`, `fk_user`, `send_by`, `txt_msg`, `dt_createddate`, `int_seen`) VALUES
(1, 5, 'U', 'test', '2020-05-06 19:06:14', 1),
(2, 5, 'A', 'gjvjv', '2020-05-06 19:11:10', 1),
(3, 5, 'U', 'ugvjvjvb', '2020-05-06 19:11:16', 1),
(4, 5, 'A', 'cycij gg ic', '2020-05-06 19:11:27', 1),
(5, 5, 'A', 'gdjx', '2020-05-06 19:12:00', 1),
(6, 5, 'U', 'djdbx', '2020-05-06 19:12:03', 1),
(7, 5, 'A', 'dud di', '2020-05-06 19:12:09', 1),
(8, 5, 'U', 'xjdvxjd', '2020-05-06 19:12:13', 1),
(9, 5, 'U', 'chxgjxj gcjg jgcigcgi ig cihchcohckcihckh kh hi chcchcchcuchcchchcy bfj jvjbo', '2020-05-06 19:19:37', 1),
(10, 5, 'A', 'hello \n', '2020-05-07 14:24:58', 1),
(11, 5, 'U', 'hello', '2020-05-07 15:18:30', 1),
(12, 5, 'U', 'hello', '2020-05-07 15:18:30', 1),
(13, 5, 'U', 'hello', '2020-05-07 15:18:50', 1),
(14, 5, 'U', 'hhh', '2020-05-07 15:19:00', 1),
(15, 5, 'A', 'hii\n', '2020-05-07 15:46:10', 1),
(16, 5, 'A', 'hello\n', '2020-05-08 17:28:17', 1),
(17, 5, 'A', 'hiii\n', '2020-05-08 17:29:17', 1),
(18, 5, 'A', 'hello\n', '2020-05-08 17:30:53', 1),
(19, 5, 'U', 'hello', '2020-05-08 17:33:59', 1),
(20, 5, 'A', 'whats up ?\n', '2020-05-08 17:34:32', 1),
(21, 5, 'U', 'how are you', '2020-05-08 17:34:49', 1),
(22, 5, 'A', 'Fine\n', '2020-05-08 17:35:04', 1),
(23, 5, 'U', 'dene', '2020-05-08 17:35:15', 1),
(24, 28, 'U', 'hi', '2020-05-08 18:23:33', 1),
(25, 27, 'U', 'hi', '2020-05-08 21:32:53', 0),
(26, 28, 'U', 'Hi', '2020-05-08 22:06:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_vendors`
--

CREATE TABLE `mst_vendors` (
  `int_glcode` int(11) NOT NULL,
  `var_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_mobile_no` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `var_alt_mobile` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `var_address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `var_latitude` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `var_longitude` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `var_city` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_state` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `verify_status` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `var_otp` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `var_membership_type` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `var_commission_value` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dt_startdate` date NOT NULL,
  `dt_enddate` date NOT NULL,
  `var_device_token` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `chr_publish` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `chr_delete` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `fk_admin` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_auth_token` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dt_timestamp` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_vendors`
--

INSERT INTO `mst_vendors` (`int_glcode`, `var_name`, `var_mobile_no`, `var_alt_mobile`, `var_email`, `var_username`, `var_password`, `var_image`, `var_address`, `var_latitude`, `var_longitude`, `var_city`, `var_state`, `verify_status`, `var_otp`, `var_membership_type`, `var_commission_value`, `dt_startdate`, `dt_enddate`, `var_device_token`, `chr_publish`, `chr_delete`, `dt_createddate`, `dt_modifydate`, `fk_admin`, `var_auth_token`, `dt_timestamp`, `var_ipaddress`) VALUES
(1, 'Modern Store Indian Grocery (New Outlet)', '7567878784', '0322741588', 'komalrathod1190@gmail.com', 'admin@pankaj.com', '112086094093091118006010010', '1568448295images.jpg', '68, Jalan Thamby Abdullah, Brickfields, 50470 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur, Malaysia', '23.0117302', '72.5236', 'Ahmedabad', 'Gujarat', 'Y', '1126', 'Free', '', '2019-09-05', '2020-09-23', '', 'Y', 'N', '2019-09-14 13:34:55', '2020-05-15 22:50:44', 'Pankaj', '', '', '49.207.142.1'),
(2, 'Sam\'s Groceria', '7227880146', '', 'grishma.conceptioni@gmail.com', '', '116070092069095085088112112112112', '1568805143benjamingrull1647493unsplash.jpg', 'NU Sentral, Jalan Tun Sambanthan, Kuala Lumpur Sentral, Federal Territory of Kuala Lumpur, 50470 Malaysia', '23.0117764', '72.5236915', '', '', 'Y', '4885', 'Free', '', '2019-09-03', '2019-10-16', 'fHIUff0IyKw:APA91bEPuEbvi2Q3A3YmQ65I4OeT4NYOJlaDrI1HtmyuXgRSbChpywkZqeIw_y_eSgJBVr39vM5aPc-LMrg1sYYvlzhB-bpAdctCkP7ICQeMk6mOA6Uu7Rv79vnf-Ubm_ee189vLrEpN', 'Y', 'N', '2019-09-18 16:42:24', '2020-04-14 18:35:06', 'Pankaj', 'MnZydWl0czE1NzEzOTQ3MTY=', '1569825293', '42.106.30.228'),
(5, 'Ben\'s Independent Grocer', '7896541230', '1234567890', 'siya@gmail.com', '', '018088075082116004004004', '15713948508bdeffa4385bc6632c904a4a74c8e20bfandomsingers.jpg', ' Publika, Lot 1A, 83-95, Jalan Dutamas 1, Wilayah Persekutuan, Kuala Lumpur 50480, Malaysia', '', '', '', '', 'N', '', 'Free', '', '2019-10-01', '2020-10-08', '', 'Y', 'N', '2019-10-18 16:04:10', '2020-04-30 22:58:39', 'Pankaj', '', '', '49.207.134.58'),
(6, 'hsecjfhsjd', '7685749375', '', 'sdhchsd@gmail.com', '', '125126114005007005', '1588268260AGADAIPPres3.JPG', 'shjfgjkdjlo', '', '', '', '', 'N', '', 'Free', '', '2020-04-01', '2020-04-01', '', 'Y', 'Y', '2020-04-30 23:07:40', '2020-04-30 23:07:40', 'Admin', '', '', '49.207.134.58'),
(7, 'gsedhjs', '7676767676', '', 'fsudhj@gmail.com', '', '121122118009011003', '', 'fghd', '', '', '', '', 'N', '', 'Free', '', '1970-01-05', '1970-01-13', '', 'Y', 'Y', '2020-04-30 23:09:23', '2020-04-30 23:18:10', 'Admin', '', '', '49.207.134.58'),
(8, 'Kirthika', '9894447000', '', 'kirthika@suryah.in', '', '080080080080004004004025006', '1588517639K3.png', '14 Moosa Street T Nagar Chennai', '', '', '', '', 'N', '', 'Free', '', '2020-04-01', '2020-05-02', '', 'Y', 'N', '2020-05-03 20:02:04', '2020-05-03 20:23:59', 'Admin', '', '', '49.207.131.108'),
(9, 'Pradeep', '9789985950', '', 'prad.psg@gmail.com', '', '125126114005007005', '1588518020K2.png', 'Old 14 New 10, 21st Ave, Sarvamangala Colony, Aruna Colony, Kodambakkam, Chennai, Tamil Nadu 600026, India', '13.046198999999997', '80.214088', '', '', 'N', '', 'Free', '', '1970-01-01', '1970-01-02', '', 'Y', 'N', '2020-05-03 20:30:20', '2020-05-03 20:30:47', 'Admin', '', '', '49.207.131.108'),
(10, 'Suryah', '9894447177', '', 'mail@suryah.in', '', '000083081087005007005003', '1589300255kathir.jpeg', 'hyuvylgluiguighiughb', '', '', '', '', 'N', '', 'Free', '', '2020-05-12', '2023-05-09', '', 'Y', 'N', '2020-05-12 21:47:35', '2020-05-15 22:11:46', 'Admin', '', '', '49.207.142.1'),
(11, 'Testing purpose', '9898764362', '', 'admin@gramango.com', '', '125126114005007005', '', 'Bus Stand Main Road, Trichy', '', '', 'Trichy', 'Tamil Nadu', 'N', '', 'Free', '', '2020-05-18', '2020-05-31', '', 'Y', 'N', '2020-05-15 22:12:46', '2020-05-15 22:12:46', 'Admin', '', '', '49.207.142.1');

-- --------------------------------------------------------

--
-- Table structure for table `mst_withdraw_request`
--

CREATE TABLE `mst_withdraw_request` (
  `int_glcode` int(11) NOT NULL,
  `fk_vendor` int(11) NOT NULL,
  `var_amount` varchar(11) NOT NULL,
  `chr_status` char(11) NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_withdraw_request`
--

INSERT INTO `mst_withdraw_request` (`int_glcode`, `fk_vendor`, `var_amount`, `chr_status`, `dt_createddate`) VALUES
(3, 1, '20', 'N', '2020-05-06 12:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `sell_with_us`
--

CREATE TABLE `sell_with_us` (
  `int_glcode` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `var_name` varchar(50) NOT NULL,
  `var_phone` varchar(50) NOT NULL,
  `var_email` varchar(50) NOT NULL,
  `txt_description` text NOT NULL,
  `dt_createddate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sell_with_us`
--

INSERT INTO `sell_with_us` (`int_glcode`, `fk_user`, `var_name`, `var_phone`, `var_email`, `txt_description`, `dt_createddate`) VALUES
(1, 5, 'Grishma Conception I', '7069747475', 'grishma.conceptioni@gmail.com', 'test', '2020-05-06 16:23:14'),
(2, 5, 'Grishma Conception I', '7069747475', 'grishma.conceptioni@gmail.com', 'test', '2020-05-06 16:54:41'),
(3, 27, 'Kirthika S', '9894447000', 'kirthikaecs@gmail.com', 'please contact ', '2020-05-08 21:36:59'),
(4, 27, 'Kirthika Suryah', '9894447000', 'kirthikaecs@gmail.com', 'please call', '2020-05-08 21:46:32'),
(5, 27, 'Kirthika Suryah', '9894447000', 'kirthikaecs@gmail.com', 'dhg', '2020-05-08 21:47:10'),
(6, 28, 'Pradeep', '9789985950', 'prad.psg@gmail.com', 'yes', '2020-05-10 14:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `trn_assign_order`
--

CREATE TABLE `trn_assign_order` (
  `int_glcode` int(11) NOT NULL,
  `fk_vendor` int(11) NOT NULL,
  `fk_delivery` int(11) NOT NULL,
  `fk_order` int(11) NOT NULL,
  `chr_status` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'P',
  `dt_createddate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `trn_assign_order`
--

INSERT INTO `trn_assign_order` (`int_glcode`, `fk_vendor`, `fk_delivery`, `fk_order`, `chr_status`, `dt_createddate`, `var_ipaddress`) VALUES
(5, 2, 1, 1, 'A', '2019-10-18 16:25:47', ''),
(19, 2, 0, 3, 'P', '2020-04-12 00:00:04', '');

-- --------------------------------------------------------

--
-- Table structure for table `trn_cart_details`
--

CREATE TABLE `trn_cart_details` (
  `int_glcode` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `fk_vendor` int(11) NOT NULL,
  `var_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `var_quantity` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_price` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_discount` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `var_unit` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `convience_fee` float NOT NULL,
  `gst_price` float NOT NULL,
  `chr_status` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'A',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `trn_cart_details`
--

INSERT INTO `trn_cart_details` (`int_glcode`, `fk_user`, `fk_product`, `fk_vendor`, `var_name`, `var_quantity`, `var_price`, `var_discount`, `var_unit`, `convience_fee`, `gst_price`, `chr_status`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(6, 26, 81, 5, 'Mustard Leaves / सरसों का साग / मोहरीचा पाला', '1 Bundle', '10', '', '2', 0, 0, 'A', '2020-04-23 18:47:21', '2020-04-23 18:47:22', '157.32.53.225'),
(178, 68, 30, 0, 'Immunity Booster Kadha', '250 GM', '38.00', '', '1', 0, 0, 'A', '2020-09-14 17:54:29', '2020-09-14 17:54:29', '43.243.37.66'),
(181, 68, 33, 0, 'Amaranth Flour ( Rajgira Pith )', '250 GM', '15', '', '1', 0, 0, 'A', '2020-09-14 17:55:35', '2020-09-14 17:55:35', '43.243.37.66'),
(166, 65, 2, 0, 'Tamarind / इमली / चिंच', '1 KG', '120', '', '2', 0, 0, 'A', '2020-09-12 06:55:27', '2020-09-12 06:55:27', '103.37.181.151'),
(164, 65, 2, 0, 'Cabbage / पत्ता गोभी', '500 GM', '30', '', '2', 0, 0, 'A', '2020-09-12 06:55:27', '2020-09-12 06:55:27', '103.37.181.151'),
(165, 65, 2, 0, 'Carrot / गाजर', '500 GM', '30', '', '2', 0, 0, 'A', '2020-09-12 06:55:27', '2020-09-12 06:55:27', '103.37.181.151'),
(179, 68, 33, 0, 'Amaranth Flour ( Rajgira Pith )', '250 GM', '15', '', '1', 0, 0, 'A', '2020-09-14 17:55:18', '2020-09-14 17:55:18', '43.243.37.66'),
(180, 68, 33, 0, 'Amaranth Flour ( Rajgira Pith )', '250 GM', '15', '', '1', 0, 0, 'A', '2020-09-14 17:55:25', '2020-09-14 17:55:25', '43.243.37.66'),
(182, 68, 33, 0, 'Amaranth Flour ( Rajgira Pith )', '250 GM', '15', '', '1', 0, 0, 'A', '2020-09-14 17:55:56', '2020-09-14 17:55:56', '43.243.37.66'),
(183, 68, 85, 0, 'Digestive Tea', '25 GM', '35', '', '1', 0, 0, 'A', '2020-09-14 18:00:42', '2020-09-14 18:00:42', '43.243.37.66'),
(184, 68, 90, 0, 'Litchi / लीची', '2 Dozen', '160', '', '1', 0, 0, 'A', '2020-09-14 18:00:51', '2020-09-14 18:00:51', '43.243.37.66'),
(185, 68, 54, 0, 'Mint Leaves / पुदीना', '1 Bundle', '10', '', '1', 0, 0, 'A', '2020-09-14 18:00:58', '2020-09-14 18:00:58', '43.243.37.66'),
(186, 68, 33, 0, 'Amaranth Flour ( Rajgira Pith )', '250 GM', '15', '', '1', 0, 0, 'A', '2020-09-14 18:01:05', '2020-09-14 18:01:05', '43.243.37.66'),
(187, 68, 32, 0, 'Instant Fast Farali Paratha', '250 GM', '15', '', '1', 0, 0, 'A', '2020-09-14 18:01:15', '2020-09-14 18:01:15', '43.243.37.66'),
(188, 68, 33, 0, 'Amaranth Flour ( Rajgira Pith )', '250 GM', '15', '', '1', 0, 0, 'A', '2020-09-14 18:01:23', '2020-09-14 18:01:23', '43.243.37.66'),
(189, 68, 87, 0, 'Aamla Ginger Fusion Tea', '500 GM', '60', '', '1', 0, 0, 'A', '2020-09-14 18:01:35', '2020-09-14 18:01:35', '43.243.37.66'),
(190, 68, 44, 0, 'Instant Milkshake Powder', '100 GM', '110', '', '1', 0, 0, 'A', '2020-09-14 18:01:47', '2020-09-14 18:01:47', '43.243.37.66'),
(191, 68, 115, 0, 'Instant Pancake Mix', '200 GM', '100', '', '1', 0, 0, 'A', '2020-09-14 18:02:00', '2020-09-14 18:02:00', '43.243.37.66'),
(192, 68, 33, 0, 'Amaranth Flour ( Rajgira Pith )', '250 GM', '15', '', '1', 0, 0, 'A', '2020-09-14 18:02:09', '2020-09-14 18:02:09', '43.243.37.66'),
(193, 68, 85, 0, 'Digestive Tea', '25 GM', '35', '', '1', 0, 0, 'A', '2020-09-14 18:03:05', '2020-09-14 18:03:05', '43.243.37.66'),
(194, 68, 86, 0, 'Herbal Tea', '500 GM', '30', '', '1', 0, 0, 'A', '2020-09-14 18:03:14', '2020-09-14 18:03:14', '43.243.37.66'),
(195, 68, 89, 0, 'Coconut / नारियल / नारळ', '1 Piece', '30', '', '1', 0, 0, 'A', '2020-09-14 18:03:27', '2020-09-14 18:03:27', '43.243.37.66'),
(196, 68, 91, 0, 'Plum / आलूबुखारा', '2 KG', '160', '', '1', 0, 0, 'A', '2020-09-14 18:03:34', '2020-09-14 18:03:34', '43.243.37.66'),
(197, 68, 40, 0, 'Moringa (Shevga) Powder', '50 GM', '60', '', '1', 0, 0, 'A', '2020-09-14 18:04:02', '2020-09-14 18:04:02', '43.243.37.66'),
(198, 68, 41, 0, 'Garlic Powder', '25 GM', '40', '', '1', 0, 0, 'A', '2020-09-14 18:04:08', '2020-09-14 18:04:08', '43.243.37.66'),
(199, 68, 59, 0, 'Radish Leaves / मूली के पत्ते / मुळ्याचा पाला', '1 Bundle', '10', '', '1', 0, 0, 'A', '2020-09-14 18:05:11', '2020-09-14 18:05:11', '43.243.37.66'),
(200, 68, 61, 0, 'Spinach / पालक', '1 Bundle', '20', '', '1', 0, 0, 'A', '2020-09-14 18:08:24', '2020-09-14 18:08:24', '43.243.37.66'),
(201, 68, 77, 0, 'Colocasia Leaves / अरबी पत्ता / अळू', '1 Bundle', '10', '', '1', 0, 0, 'A', '2020-09-14 18:08:31', '2020-09-14 18:08:31', '43.243.37.66'),
(457, 73, 44, 0, 'Instant Milkshake Powder', '100 GM', '110', '', '1', 0, 0, 'A', '2020-10-10 11:49:43', '2020-10-10 11:49:43', '106.193.218.20'),
(258, 81, 84, 0, 'Instant Bambaiya Pav-Bhaji', '500 GM', '50', '', '1', 0, 0, 'A', '2020-10-01 18:26:38', '2020-10-01 18:26:38', '139.5.22.143'),
(455, 73, 44, 0, 'Instant Milkshake Powder', '100 GM', '110', '', '1', 0, 0, 'A', '2020-10-10 11:49:37', '2020-10-10 11:49:37', '106.193.218.20'),
(277, 67, 6, 0, 'Moringa (Shevga) Powder', '50 GM', '60', '', '6', 0, 0, 'A', '2020-10-07 10:27:48', '2020-10-07 10:27:48', '103.17.83.161'),
(278, 67, 1, 0, 'Student Kit – Tourist Kit', '10', '700', '', '1', 0, 0, 'A', '2020-10-07 10:27:48', '2020-10-07 10:27:48', '103.17.83.161'),
(267, 71, 38, 0, 'Bhagar Flour (Varai Pith)', '200 GM', '135', '', '3', 0, 0, 'A', '2020-10-06 16:42:29', '2020-10-06 16:42:29', '116.72.81.201'),
(271, 71, 84, 0, 'Instant Bambaiya Pav-Bhaji', '500 GM', '50', '', '1', 0, 0, 'A', '2020-10-06 17:16:50', '2020-10-06 17:16:50', '116.72.81.201'),
(280, 71, 32, 0, 'Instant Fast Farali Paratha', '250 GM', '15', '', '1', 0, 0, 'A', '2020-10-07 11:39:02', '2020-10-07 11:39:02', '157.33.177.132'),
(456, 73, 44, 0, 'Instant Milkshake Powder', '100 GM', '110', '', '1', 0, 0, 'A', '2020-10-10 11:49:40', '2020-10-10 11:49:40', '106.193.218.20'),
(344, 67, 32, 0, 'Instant Fast Farali Paratha', '250 GM', '15', '', '3', 0, 0, 'A', '2020-10-08 11:59:38', '2020-10-08 11:59:38', '45.126.145.127'),
(345, 67, 121, 0, 'abcd', '500 GM', '500', '', '4', 0, 18, 'A', '2020-10-08 12:00:25', '2020-10-08 12:00:25', '45.126.145.127'),
(346, 67, 35, 0, 'Instant Fast Farali Paratha', '200 GM', '60', '', '6', 0, 0, 'A', '2020-10-08 12:01:05', '2020-10-08 12:01:05', '45.126.145.127'),
(347, 67, 33, 0, 'Amaranth Flour ( Rajgira Pith )', '250 GM', '15', '', '2', 0, 0, 'A', '2020-10-08 12:01:29', '2020-10-08 12:01:29', '45.126.145.127'),
(351, 67, 41, 0, 'Garlic Powder', '25 GM', '40', '', '6', 0, 0, 'A', '2020-10-08 12:10:51', '2020-10-08 12:10:51', '45.126.145.127'),
(350, 67, 32, 0, 'Instant Fast Farali Paratha', '250 GM', '15', '', '3', 0, 0, 'A', '2020-10-08 12:10:28', '2020-10-08 12:10:28', '45.126.145.127'),
(352, 67, 41, 0, 'Garlic Powder', '25 GM', '40', '', '11', 0, 0, 'A', '2020-10-08 12:11:21', '2020-10-08 12:11:21', '45.126.145.127'),
(353, 71, 32, 0, 'Instant Fast Farali Paratha', '250 GM', '15', '', '1', 0, 0, 'A', '2020-10-08 12:33:24', '2020-10-08 12:33:24', '49.35.108.188'),
(354, 71, 122, 0, 'xyz', '10', '100', '', '1', 0, 5, 'A', '2020-10-08 12:47:06', '2020-10-08 12:47:06', '49.35.108.188'),
(355, 67, 41, 0, 'Garlic Powder', '25 GM', '40', '', '2', 0, 0, 'A', '2020-10-08 12:49:26', '2020-10-08 12:49:26', '45.126.145.127'),
(359, 57, 122, 0, 'xyz', '10', '100', '', '3', 0, 5, 'A', '2020-10-08 14:15:27', '2020-10-08 14:15:27', '43.243.37.73'),
(360, 57, 122, 0, 'xyz', '10', '100', '', '3', 0, 5, 'A', '2020-10-08 14:15:38', '2020-10-08 14:15:38', '43.243.37.73'),
(362, 57, 122, 0, 'xyz', '10', '100', '', '3', 0, 5, 'A', '2020-10-08 14:39:45', '2020-10-08 14:39:45', '43.243.37.73'),
(363, 57, 122, 0, 'xyz', '10', '100', '', '3', 0, 5, 'A', '2020-10-08 14:40:02', '2020-10-08 14:40:02', '43.243.37.73'),
(364, 57, 122, 0, 'xyz', '10', '100', '', '3', 0, 5, 'A', '2020-10-08 14:40:09', '2020-10-08 14:40:09', '43.243.37.73'),
(373, 57, 31, 0, 'Sabudana Flour', '200 GM', '45', '', '4', 0, 0, 'A', '2020-10-08 15:01:21', '2020-10-08 15:01:21', '43.243.37.73'),
(512, 83, 31, 0, 'Sabudana Flour', '200 GM', '45', '', '1', 0, 0, 'A', '2020-10-12 06:29:03', '2020-10-12 06:29:03', '43.243.37.74'),
(511, 83, 32, 0, 'Instant Fast Farali Paratha', '250 GM', '15', '', '1', 0, 0, 'A', '2020-10-12 06:29:03', '2020-10-12 06:29:03', '43.243.37.74'),
(475, 70, 116, 0, 'Instant Dal-Batti Mix', '200 GM', '70', '', '1', 0, 0, 'A', '2020-10-11 10:00:21', '2020-10-11 10:00:21', '116.73.69.5'),
(476, 70, 115, 0, 'Instant Pancake Mix', '200 GM', '100', '', '3', 0, 0, 'A', '2020-10-11 10:00:37', '2020-10-11 10:00:37', '116.73.69.5'),
(477, 70, 115, 0, 'Instant Pancake Mix', '200 GM', '100', '', '3', 0, 0, 'A', '2020-10-11 10:00:53', '2020-10-11 10:00:53', '116.73.69.5'),
(459, 73, 44, 0, 'Instant Milkshake Powder', '100 GM', '110', '', '1', 0, 0, 'A', '2020-10-10 11:50:36', '2020-10-10 11:50:36', '106.193.218.20'),
(458, 73, 44, 0, 'Instant Milkshake Powder', '100 GM', '110', '', '1', 0, 0, 'A', '2020-10-10 11:50:10', '2020-10-10 11:50:10', '106.193.218.20'),
(460, 73, 44, 0, 'Instant Milkshake Powder', '100 GM', '110', '', '2', 0, 0, 'A', '2020-10-10 11:51:42', '2020-10-10 11:51:42', '106.193.218.20'),
(461, 73, 44, 0, 'Instant Milkshake Powder', '100 GM', '110', '', '2', 0, 0, 'A', '2020-10-10 11:51:51', '2020-10-10 11:51:51', '106.193.218.20'),
(462, 73, 44, 0, 'Instant Milkshake Powder', '100 GM', '110', '', '3', 0, 0, 'A', '2020-10-10 11:52:02', '2020-10-10 11:52:02', '106.193.218.20'),
(513, 48, 3, 0, 'Avocado', '1 Pc (200 to 300 Grams)', '130', '', '1', 0, 0, 'A', '2020-10-13 11:22:53', '2020-10-13 11:22:53', '43.248.36.10');

-- --------------------------------------------------------

--
-- Table structure for table `trn_order_status`
--

CREATE TABLE `trn_order_status` (
  `int_glcode` int(11) NOT NULL,
  `fk_vendor` int(11) NOT NULL,
  `fk_order` int(11) NOT NULL,
  `chr_status` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'R',
  `txt_reason` text COLLATE latin1_general_ci,
  `dt_createddate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `trn_order_status`
--

INSERT INTO `trn_order_status` (`int_glcode`, `fk_vendor`, `fk_order`, `chr_status`, `txt_reason`, `dt_createddate`) VALUES
(1, 2, 1, 'R', 'Address not Traceable.', '2019-10-18 16:08:17'),
(2, 2, 1, 'A', '', '2019-10-18 16:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `trn_product_images`
--

CREATE TABLE `trn_product_images` (
  `int_glcode` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `var_images` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '1',
  `dt_createddate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `trn_product_images`
--

INSERT INTO `trn_product_images` (`int_glcode`, `fk_product`, `var_images`, `display_order`, `dt_createddate`, `var_ipaddress`) VALUES
(1, 1, '1564825597greenapple.png', 1, '2019-08-03 15:16:37', '43.243.38.106'),
(2, 1, '1564825597fruits.png', 1, '2019-08-03 15:16:37', '43.243.38.106'),
(3, 2, '1564825702tomatoes.png', 1, '2019-08-03 15:18:22', '43.243.38.106'),
(4, 2, '1564825702vegetable.png', 1, '2019-08-03 15:18:22', '43.243.38.106'),
(5, 3, '1564839548kasurimethi.png', 1, '2019-08-03 19:09:08', '43.243.38.106'),
(6, 4, '1565594361ChocolateCoveredStrawberries2.jpg', 1, '2019-08-12 12:49:21', '43.243.38.96'),
(7, 4, '1565594361darkchocolate.jpg', 1, '2019-08-12 12:49:21', '43.243.38.96'),
(8, 4, '1565594361DSC0601.jpg', 1, '2019-08-12 12:49:21', '43.243.38.96'),
(9, 5, '1565764000KAJUCHOCOLATE.jpg', 1, '2019-08-14 11:56:40', '43.243.39.140'),
(10, 5, '1565764000kajustrawberry500x500.jpg', 1, '2019-08-14 11:56:40', '43.243.39.140'),
(11, 5, '1565764000images.jpg', 1, '2019-08-14 11:56:40', '43.243.39.140'),
(12, 6, '1565764383GSFACD10042014main500.jpg', 1, '2019-08-14 12:03:03', '43.243.39.140'),
(13, 6, '1565764383ChocolatePistachioStrawberries10.jpg', 1, '2019-08-14 12:03:03', '43.243.39.140'),
(14, 6, '1565764383ChocolateCoveredStrawberries9.jpg', 1, '2019-08-14 12:03:03', '43.243.39.140'),
(15, 7, '1566456470kiwi2.jpg', 1, '2019-08-22 12:17:50', '43.243.38.106'),
(16, 7, '1566456470kiwi3.jpg', 1, '2019-08-22 12:17:50', '43.243.38.106'),
(17, 8, '1566456659banner5.jpg', 1, '2019-08-22 12:20:59', '43.243.38.106'),
(18, 8, '1566456659banner6.jpg', 1, '2019-08-22 12:20:59', '43.243.38.106'),
(19, 9, '1566456887banner6.jpg', 1, '2019-08-22 12:24:47', '43.243.38.106'),
(20, 9, '1566456887banner5.jpg', 1, '2019-08-22 12:24:47', '43.243.38.106'),
(21, 10, '1566456943banner6.jpg', 1, '2019-08-22 12:25:43', '43.243.38.106'),
(22, 11, '1566457250kiwi2.jpg', 1, '2019-08-22 12:30:50', '43.243.38.106'),
(23, 11, '1566457250kiwi3.jpg', 1, '2019-08-22 12:30:50', '43.243.38.106'),
(24, 12, '1566457790images(1).jpg', 1, '2019-08-22 12:39:50', '43.243.38.106'),
(25, 12, '1566457790images.jpg', 1, '2019-08-22 12:39:50', '43.243.38.106'),
(26, 13, '156645827720191image15.jpg', 1, '2019-08-22 12:47:57', '43.243.38.106'),
(27, 13, '1566458277banner6.jpg', 1, '2019-08-22 12:47:57', '43.243.38.106'),
(28, 14, '1566458485BeautyBenefitsofpistachios.jpg', 1, '2019-08-22 12:51:25', '43.243.38.106'),
(29, 14, '1566458485r5500x500.jpg', 1, '2019-08-22 12:51:25', '43.243.38.106'),
(30, 14, '1566458485rszshutterstock.jpg', 1, '2019-08-22 12:51:26', '43.243.38.106'),
(31, 15, '1566458989FreshOrganic.jpg', 1, '2019-08-22 12:59:49', '43.243.38.106'),
(32, 16, '1566459199walnut.jpg', 1, '2019-08-22 13:03:19', '43.243.38.106'),
(33, 16, '1566459199walnut3.jpg', 1, '2019-08-22 13:03:19', '43.243.38.106'),
(34, 17, '1566459386almond3.jpg', 1, '2019-08-22 13:06:26', '43.243.38.106'),
(35, 17, '1566459386almond2.jpg', 1, '2019-08-22 13:06:26', '43.243.38.106'),
(36, 18, '1566459594cashew3.jpg', 1, '2019-08-22 13:09:54', '43.243.38.106'),
(37, 18, '1566459594cashew.jpg', 1, '2019-08-22 13:09:54', '43.243.38.106'),
(38, 19, '1566459804avocodo2.jpg', 1, '2019-08-22 13:13:24', '43.243.38.106'),
(39, 19, '1566459804avocado3.jpg', 1, '2019-08-22 13:13:24', '43.243.38.106'),
(40, 20, '1566459967okra3.jpg', 1, '2019-08-22 13:16:07', '43.243.38.106'),
(41, 20, '1566459967okra.jpg', 1, '2019-08-22 13:16:07', '43.243.38.106'),
(42, 21, '1566460351rchilli3.jpg', 1, '2019-08-22 13:22:31', '43.243.38.106'),
(43, 21, '1566460351rchili2.jpg', 1, '2019-08-22 13:22:31', '43.243.38.106'),
(44, 22, '1566460486gchilli.jpg', 1, '2019-08-22 13:24:46', '43.243.38.106'),
(45, 22, '1566460486gchilli3.jpg', 1, '2019-08-22 13:24:46', '43.243.38.106'),
(46, 23, '1566461031cender.jpg', 1, '2019-08-22 13:33:51', '43.243.38.106'),
(47, 23, '1566461031cender3.jpg', 1, '2019-08-22 13:33:51', '43.243.38.106'),
(48, 24, '1566461318cgreen2.jpg', 1, '2019-08-22 13:38:38', '43.243.38.106'),
(49, 24, '1566461318cgreen.jpg', 1, '2019-08-22 13:38:38', '43.243.38.106'),
(50, 25, '1566464975coliflower.jpg', 1, '2019-08-22 14:39:35', '43.243.38.106'),
(51, 25, '1566464975coliflower3.jpg', 1, '2019-08-22 14:39:35', '43.243.38.106'),
(52, 26, '1567172871raisins.jpg', 1, '2019-08-30 19:17:51', '43.243.39.150'),
(53, 26, '1567172871munakkaaurkishmishmeantar.jpg', 1, '2019-08-30 19:17:51', '43.243.39.150'),
(54, 26, '1567172871kishmish650x40071511932228.jpg', 1, '2019-08-30 19:17:51', '43.243.39.150'),
(55, 27, '1567173712contentarticleprofileimage88d09a4f84b171cf6ccaee1874d1c3c2badf90ea1260.jpg', 1, '2019-08-30 19:31:52', '43.243.39.150'),
(56, 27, '1567173712108009348strawberries1.jpg', 1, '2019-08-30 19:31:52', '43.243.39.150'),
(57, 27, '1567173712bowlofstrawberriesybimyg.jpeg', 1, '2019-08-30 19:31:53', '43.243.39.150'),
(59, 27, '1568442842apple.jpg', 1, '2019-09-14 12:04:02', '43.243.38.101'),
(61, 28, '1569746036carrots23873941920.jpg', 1, '2019-09-29 14:03:56', '58.84.60.154'),
(62, 28, '1569746036carrots10822511920.jpg', 1, '2019-09-29 14:03:56', '58.84.60.154'),
(63, 29, '1569754812cucumber16815041920.jpg', 1, '2019-09-29 16:30:12', '58.84.60.154'),
(64, 29, '1569754812cucumbers26864191920.jpg', 1, '2019-09-29 16:30:12', '58.84.60.154'),
(68, 30, '1569755252beets13683701920.jpg', 1, '2019-09-29 16:37:32', '58.84.60.154'),
(66, 30, '1569755015beetroot34908091920.jpg', 1, '2019-09-29 16:33:35', '58.84.60.154'),
(67, 30, '1569755015burak20915681920.jpg', 1, '2019-09-29 16:33:35', '58.84.60.154'),
(75, 34, '1569756114capsicum27102621920.jpg', 1, '2019-09-29 16:51:54', '58.84.60.154'),
(76, 34, '1569756114bellpeppers12642091920.jpg', 1, '2019-09-29 16:51:54', '58.84.60.154'),
(77, 35, '1569756207carrots23873941920.jpg', 1, '2019-09-29 16:53:27', '58.84.60.154'),
(78, 35, '1569756207carrots10822511920.jpg', 1, '2019-09-29 16:53:27', '58.84.60.154'),
(79, 36, '1569756408cauliflower14657321920.jpg', 1, '2019-09-29 16:56:49', '58.84.60.154'),
(80, 36, '1569756409cauliflower16446261920.jpg', 1, '2019-09-29 16:56:49', '58.84.60.154'),
(81, 36, '1569756409cauliflower8054141920.jpg', 1, '2019-09-29 16:56:49', '58.84.60.154'),
(82, 37, '1569756476beans5213961920.jpg', 1, '2019-09-29 16:57:56', '58.84.60.154'),
(83, 37, '1569756476beans24615301920.jpg', 1, '2019-09-29 16:57:56', '58.84.60.154'),
(84, 38, '1569756756cilantro12873011920.jpg', 1, '2019-09-29 17:02:36', '58.84.60.154'),
(85, 38, '1569756756cilantro14291361920.jpg', 1, '2019-09-29 17:02:36', '58.84.60.154'),
(86, 39, '1569756839cucumber15229211920.jpg', 1, '2019-09-29 17:03:59', '58.84.60.154'),
(87, 39, '1569756839cucumbers10817001920.jpg', 1, '2019-09-29 17:03:59', '58.84.60.154'),
(88, 40, '1569756980wet35943031920.jpg', 1, '2019-09-29 17:06:20', '58.84.60.154'),
(90, 42, '1569757141Drumstick.jpg', 1, '2019-09-29 17:09:01', '58.84.60.154'),
(91, 42, '1569757141moringa38803931920.jpg', 1, '2019-09-29 17:09:01', '58.84.60.154'),
(92, 42, '1569757141drumstick3902571920.jpg', 1, '2019-09-29 17:09:01', '58.84.60.154'),
(93, 43, '1569757200eggplant6719101920.jpg', 1, '2019-09-29 17:10:00', '58.84.60.154'),
(94, 43, '1569757200eggplant8292011920.jpg', 1, '2019-09-29 17:10:00', '58.84.60.154'),
(250, 119, '1600946324readykadhaback.png', 1, '2020-09-24 16:48:44', '106.193.184.94'),
(251, 120, '1601462988author.png', 1, '2020-09-30 16:19:48', '202.149.217.178'),
(97, 45, '1569757352beans36885841920.jpg', 1, '2019-09-29 17:12:32', '58.84.60.154'),
(98, 45, '1569757352greenbeans27079961920.jpg', 1, '2019-09-29 17:12:32', '58.84.60.154'),
(99, 45, '1569757352bean23751431920.jpg', 1, '2019-09-29 17:12:33', '58.84.60.154'),
(100, 46, '1569757413garlic34195441920.jpg', 1, '2019-09-29 17:13:33', '58.84.60.154'),
(101, 46, '1569757413garlic846911920.jpg', 1, '2019-09-29 17:13:33', '58.84.60.154'),
(102, 47, '1569757510ginger17380981920.jpg', 1, '2019-09-29 17:15:10', '58.84.60.154'),
(103, 47, '1569757510ginger13880021920.jpg', 1, '2019-09-29 17:15:10', '58.84.60.154'),
(104, 48, '1569757592yardlongbeans10985301920.jpg', 1, '2019-09-29 17:16:32', '58.84.60.154'),
(105, 48, '1569757592frenchbeanbasket2142661280.jpg', 1, '2019-09-29 17:16:32', '58.84.60.154'),
(106, 49, '1569757653pepperoni739081920.jpg', 1, '2019-09-29 17:17:34', '58.84.60.154'),
(107, 49, '1569757654green32658051920.jpg', 1, '2019-09-29 17:17:34', '58.84.60.154'),
(108, 50, '1569757708textures19383011920.jpg', 1, '2019-09-29 17:18:28', '58.84.60.154'),
(109, 50, '1569757708vegetable39595931920.jpg', 1, '2019-09-29 17:18:28', '58.84.60.154'),
(110, 51, '1569757776peanuts21630431920.jpg', 1, '2019-09-29 17:19:36', '58.84.60.154'),
(111, 51, '1569757776food30556471920.jpg', 1, '2019-09-29 17:19:36', '58.84.60.154'),
(112, 52, '1569757833jackfruit10344181920.jpg', 1, '2019-09-29 17:20:33', '58.84.60.154'),
(113, 52, '1569757833jackfruit21088691920.jpg', 1, '2019-09-29 17:20:33', '58.84.60.154'),
(114, 53, '1569757897gombos41737181920.jpg', 1, '2019-09-29 17:21:37', '58.84.60.154'),
(115, 53, '1569757897vegetable35800431920.jpg', 1, '2019-09-29 17:21:37', '58.84.60.154'),
(116, 54, '1569757972mint5214011920.jpg', 1, '2019-09-29 17:22:52', '58.84.60.154'),
(117, 54, '1569757972mint34713681920.jpg', 1, '2019-09-29 17:22:52', '58.84.60.154'),
(118, 54, '1569757972leaf33336391920.jpg', 1, '2019-09-29 17:22:52', '58.84.60.154'),
(119, 55, '1569758050onion15656041920.jpg', 1, '2019-09-29 17:24:10', '58.84.60.154'),
(120, 55, '1569758050onion18981951920.jpg', 1, '2019-09-29 17:24:10', '58.84.60.154'),
(121, 56, '1569758102pumpkins37269191920.jpg', 1, '2019-09-29 17:25:02', '58.84.60.154'),
(122, 56, '1569758102pumpkin36362431920.jpg', 1, '2019-09-29 17:25:02', '58.84.60.154'),
(126, 57, '1569758511potatoes15850751920.jpg', 1, '2019-09-29 17:31:51', '58.84.60.154'),
(127, 57, '1569758511potatoes4119751920.jpg', 1, '2019-09-29 17:31:51', '58.84.60.154'),
(128, 58, '1569758665muscatdeprovence2285011920.jpg', 1, '2019-09-29 17:34:26', '58.84.60.154'),
(129, 58, '1569758666pumpkin17039891920.jpg', 1, '2019-09-29 17:34:26', '58.84.60.154'),
(130, 59, '1569758842healthy33765141920.jpg', 1, '2019-09-29 17:37:22', '58.84.60.154'),
(131, 59, '1569758842plant11464181920.jpg', 1, '2019-09-29 17:37:22', '58.84.60.154'),
(132, 60, '1569758965chili4990621920.jpg', 1, '2019-09-29 17:39:25', '58.84.60.154'),
(133, 60, '1569758965eat39110181920.jpg', 1, '2019-09-29 17:39:25', '58.84.60.154'),
(134, 61, '1569759081spinach5066161920.jpg', 1, '2019-09-29 17:41:22', '58.84.60.154'),
(135, 61, '1569759082spinach14273601920.jpg', 1, '2019-09-29 17:41:22', '58.84.60.154'),
(136, 62, '1569759268market40775751920.jpg', 1, '2019-09-29 17:44:28', '58.84.60.154'),
(137, 62, '1569759268sweetpotato20867841920.jpg', 1, '2019-09-29 17:44:29', '58.84.60.154'),
(138, 63, '1569759414chayote16375351920.jpg', 1, '2019-09-29 17:46:54', '58.84.60.154'),
(139, 63, '1569759414wildcucumber36583601920.jpg', 1, '2019-09-29 17:46:54', '58.84.60.154'),
(140, 64, '1569759544tomato4987211920.jpg', 1, '2019-09-29 17:49:05', '58.84.60.154'),
(141, 64, '1569759545tomato35200041920.jpg', 1, '2019-09-29 17:49:05', '58.84.60.154'),
(142, 64, '1569759545tomatoes44801251920.jpg', 1, '2019-09-29 17:49:05', '58.84.60.154'),
(143, 65, '1569759679white21473311920.jpg', 1, '2019-09-29 17:51:20', '58.84.60.154'),
(144, 65, '1569759680turnip11291280.jpg', 1, '2019-09-29 17:51:20', '58.84.60.154'),
(145, 66, '156976050512.jpg', 1, '2019-09-29 18:05:05', '58.84.60.154'),
(146, 66, '1569760505Turnip11.jpg', 1, '2019-09-29 18:05:05', '58.84.60.154'),
(148, 67, '1569760637radish15863131920.jpg', 1, '2019-09-29 18:07:17', '58.84.60.154'),
(149, 67, '1569760637radish22906151920.jpg', 1, '2019-09-29 18:07:18', '58.84.60.154'),
(150, 67, '1569760638whiteradish29342811920.jpg', 1, '2019-09-29 18:07:18', '58.84.60.154'),
(151, 62, '1569931176', 1, '2019-10-01 17:29:36', '58.84.60.154'),
(152, 70, '1569941522SpongeGourd2.png', 1, '2019-10-01 20:22:03', '58.84.60.154'),
(153, 70, '1569941523Spongegourd1.jpg', 1, '2019-10-01 20:22:03', '58.84.60.154'),
(154, 72, '1569941796Ridgegourd.jpg', 1, '2019-10-01 20:26:36', '58.84.60.154'),
(155, 72, '1569941796ridgegourd2.jpg', 1, '2019-10-01 20:26:36', '58.84.60.154'),
(156, 73, '1569942040snakegourd1.jpg', 1, '2019-10-01 20:30:40', '58.84.60.154'),
(157, 73, '1569942040Snakegourd2.jpg', 1, '2019-10-01 20:30:40', '58.84.60.154'),
(158, 74, '1569943806Pointedgourd2.jpg', 1, '2019-10-01 21:00:06', '58.84.60.154'),
(159, 74, '1569943806pointedgourd1.jpg', 1, '2019-10-01 21:00:06', '58.84.60.154'),
(160, 76, '1569944219IvyGourd.jpg', 1, '2019-10-01 21:06:59', '58.84.60.154'),
(161, 76, '1569944219ivygourd2.jpg', 1, '2019-10-01 21:06:59', '58.84.60.154'),
(162, 77, '1569944612colocassialeaf1.jpg', 1, '2019-10-01 21:13:32', '58.84.60.154'),
(163, 77, '1569944612Colocasialeaves2.jpg', 1, '2019-10-01 21:13:32', '58.84.60.154'),
(164, 78, '1569944720amaranthleaves1.jpg', 1, '2019-10-01 21:15:20', '58.84.60.154'),
(165, 78, '1569944720amaranthus2.jpg', 1, '2019-10-01 21:15:20', '58.84.60.154'),
(166, 79, '1569944847Greensorrel.jpg', 1, '2019-10-01 21:17:27', '58.84.60.154'),
(167, 79, '1569944847sorrelleaves1.jpg', 1, '2019-10-01 21:17:27', '58.84.60.154'),
(168, 80, '1569944945amaranthleaves1.jpg', 1, '2019-10-01 21:19:06', '58.84.60.154'),
(169, 80, '1569944946redamaranthleaves2.jpg', 1, '2019-10-01 21:19:06', '58.84.60.154'),
(170, 81, '1569945171freshgreenmustardleaves250x250.jpg', 1, '2019-10-01 21:22:51', '58.84.60.154'),
(171, 81, '1569945171mustardleaves250x2502.jpg', 1, '2019-10-01 21:22:51', '58.84.60.154'),
(172, 82, '1569945301Yam2.jpg', 1, '2019-10-01 21:25:01', '58.84.60.154'),
(173, 82, '1569945301Yam1.jpg', 1, '2019-10-01 21:25:01', '58.84.60.154'),
(174, 83, '1569945909leek34784751920.jpg', 1, '2019-10-01 21:35:09', '58.84.60.154'),
(175, 83, '1569945909freshgreenonionbunches41655481920.jpg', 1, '2019-10-01 21:35:09', '58.84.60.154'),
(176, 83, '1569945909greenonion6999431920.jpg', 1, '2019-10-01 21:35:09', '58.84.60.154'),
(177, 84, '15700000642.jpeg', 1, '2019-10-02 12:37:44', '58.84.60.154'),
(178, 84, '15700000643.jpeg', 1, '2019-10-02 12:37:44', '58.84.60.154'),
(179, 84, '15700000644.jpeg', 1, '2019-10-02 12:37:44', '58.84.60.154'),
(180, 85, '1570000403fruits29531501920.jpg', 1, '2019-10-02 12:43:23', '58.84.60.154'),
(181, 85, '1570000403guava1884401920.jpg', 1, '2019-10-02 12:43:23', '58.84.60.154'),
(182, 85, '1570000403guavas28989101920.jpg', 1, '2019-10-02 12:43:23', '58.84.60.154'),
(183, 86, '15700005623.jpg', 1, '2019-10-02 12:46:03', '58.84.60.154'),
(185, 86, '15700005635.jpg', 1, '2019-10-02 12:46:03', '58.84.60.154'),
(186, 87, '15700006862.jpg', 1, '2019-10-02 12:48:06', '58.84.60.154'),
(187, 87, '15700006861.jpg', 1, '2019-10-02 12:48:06', '58.84.60.154'),
(188, 87, '15700006863.jpg', 1, '2019-10-02 12:48:06', '58.84.60.154'),
(189, 88, '15700008203.jpeg', 1, '2019-10-02 12:50:21', '58.84.60.154'),
(190, 88, '15700008214.jpeg', 1, '2019-10-02 12:50:21', '58.84.60.154'),
(191, 88, '15700008211.jpeg', 1, '2019-10-02 12:50:21', '58.84.60.154'),
(192, 89, '15700009112.jpg', 1, '2019-10-02 12:51:51', '58.84.60.154'),
(193, 89, '15700009111.jpg', 1, '2019-10-02 12:51:51', '58.84.60.154'),
(194, 90, '15700010113.jpg', 1, '2019-10-02 12:53:31', '58.84.60.154'),
(195, 90, '15700010112.jpg', 1, '2019-10-02 12:53:31', '58.84.60.154'),
(196, 90, '15700010114.jpg', 1, '2019-10-02 12:53:31', '58.84.60.154'),
(197, 91, '1570001273plum16905791920.jpg', 1, '2019-10-02 12:57:53', '58.84.60.154'),
(198, 91, '1570001273plum17714091920.jpg', 1, '2019-10-02 12:57:54', '58.84.60.154'),
(199, 91, '1570001274plum16059141920.jpg', 1, '2019-10-02 12:57:54', '58.84.60.154'),
(200, 92, '15700014373.jpg', 1, '2019-10-02 13:00:37', '58.84.60.154'),
(201, 92, '15700014372.jpg', 1, '2019-10-02 13:00:37', '58.84.60.154'),
(202, 92, '15700014371.jpg', 1, '2019-10-02 13:00:37', '58.84.60.154'),
(203, 93, '15700015681.jpg', 1, '2019-10-02 13:02:48', '58.84.60.154'),
(204, 93, '15700015682.jpg', 1, '2019-10-02 13:02:48', '58.84.60.154'),
(205, 94, '15700016491.jpg', 1, '2019-10-02 13:04:09', '58.84.60.154'),
(206, 95, '15700017741.jpg', 1, '2019-10-02 13:06:14', '58.84.60.154'),
(207, 95, '15700017742.jpg', 1, '2019-10-02 13:06:14', '58.84.60.154'),
(208, 95, '15700017743.jpg', 1, '2019-10-02 13:06:14', '58.84.60.154'),
(209, 96, '15700036743.jpeg', 1, '2019-10-02 13:37:54', '58.84.60.154'),
(210, 96, '15700036742.jpeg', 1, '2019-10-02 13:37:54', '58.84.60.154'),
(211, 96, '15700036741.jpeg', 1, '2019-10-02 13:37:54', '58.84.60.154'),
(212, 97, '15700038591.jpeg', 1, '2019-10-02 13:40:59', '58.84.60.154'),
(213, 97, '15700038592.jpeg', 1, '2019-10-02 13:40:59', '58.84.60.154'),
(214, 97, '15700038593.jpeg', 1, '2019-10-02 13:40:59', '58.84.60.154'),
(215, 98, '15700041006.jpeg', 1, '2019-10-02 13:45:00', '58.84.60.154'),
(216, 98, '15700041001.jpeg', 1, '2019-10-02 13:45:01', '58.84.60.154'),
(217, 98, '15700041013.jpeg', 1, '2019-10-02 13:45:01', '58.84.60.154'),
(218, 99, '15700042861.jpeg', 1, '2019-10-02 13:48:06', '58.84.60.154'),
(219, 99, '15700042864.jpeg', 1, '2019-10-02 13:48:06', '58.84.60.154'),
(220, 99, '1570004286', 1, '2019-10-02 13:48:06', '58.84.60.154'),
(221, 100, '15700044082.jpg', 1, '2019-10-02 13:50:08', '58.84.60.154'),
(222, 100, '15700044083.jpg', 1, '2019-10-02 13:50:08', '58.84.60.154'),
(223, 100, '15700044085.jpg', 1, '2019-10-02 13:50:08', '58.84.60.154'),
(224, 101, '15700045111.jpg', 1, '2019-10-02 13:51:51', '58.84.60.154'),
(225, 101, '15700045113.jpg', 1, '2019-10-02 13:51:51', '58.84.60.154'),
(226, 102, '15700046211.jpg', 1, '2019-10-02 13:53:41', '58.84.60.154'),
(227, 102, '15700046213.jpg', 1, '2019-10-02 13:53:41', '58.84.60.154'),
(228, 103, '15700047292.jpg', 1, '2019-10-02 13:55:29', '58.84.60.154'),
(229, 103, '15700047291.jpg', 1, '2019-10-02 13:55:29', '58.84.60.154'),
(230, 103, '15700047293.jpg', 1, '2019-10-02 13:55:29', '58.84.60.154'),
(231, 104, '15700048691.jpg', 1, '2019-10-02 13:57:49', '58.84.60.154'),
(232, 104, '15700048692.jpg', 1, '2019-10-02 13:57:49', '58.84.60.154'),
(233, 104, '15700048694.jpg', 1, '2019-10-02 13:57:49', '58.84.60.154'),
(234, 105, '15700050024.jpeg', 1, '2019-10-02 14:00:02', '58.84.60.154'),
(235, 105, '15700050027.jpeg', 1, '2019-10-02 14:00:02', '58.84.60.154'),
(236, 105, '15700050029.jpeg', 1, '2019-10-02 14:00:02', '58.84.60.154'),
(237, 106, '15700051381.jpg', 1, '2019-10-02 14:02:18', '58.84.60.154'),
(238, 106, '15700051383.jpg', 1, '2019-10-02 14:02:18', '58.84.60.154'),
(239, 107, '1570005532singharaherbs500x500.jpg', 1, '2019-10-02 14:08:53', '58.84.60.154'),
(240, 107, '1570005533waterchestnut500x500.jpg', 1, '2019-10-02 14:08:53', '58.84.60.154'),
(241, 109, '1580465954', 1, '2020-01-31 15:49:14', '43.243.39.135'),
(242, 109, '1588269456IMG6998.JPG', 1, '2020-04-30 23:27:36', '49.207.134.58'),
(243, 111, '1588516709', 1, '2020-05-03 20:08:29', '183.83.154.204'),
(244, 113, '1589008714K1.jxr', 1, '2020-05-09 12:48:34', '49.207.131.108'),
(245, 113, '1589008714K3.jpg', 1, '2020-05-09 12:48:34', '49.207.131.108'),
(246, 114, '15890304331.jpg', 1, '2020-05-09 18:50:33', '42.106.44.38'),
(249, 119, '1600946324readykadhafront.png', 1, '2020-09-24 16:48:44', '106.193.184.94'),
(248, 113, '1600059942', 1, '2020-09-14 10:35:42', '45.126.147.4');

-- --------------------------------------------------------

--
-- Table structure for table `trn_product_price`
--

CREATE TABLE `trn_product_price` (
  `int_glcode` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `var_quantity` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_price` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `var_discount_price` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `dt_createddate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `trn_product_price`
--

INSERT INTO `trn_product_price` (`int_glcode`, `fk_product`, `var_quantity`, `var_price`, `var_discount_price`, `dt_createddate`) VALUES
(1, 30, '250 GM', '40', '38.00', '2020-09-30 16:20:43'),
(2, 30, '500 GM', '80', '76.00', '2020-09-30 16:20:43'),
(3, 31, '200 GM', '45', '45.00', '2020-10-07 11:32:49'),
(224, 119, '25', '45', '40.50', '2020-10-08 15:51:44'),
(222, 0, '5', '10', '10.00', '2020-09-24 13:33:44'),
(223, 118, '6', '100', '100.00', '2020-09-24 15:50:47'),
(9, 32, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(221, 0, '5', '56456', '56,456.00', '2020-09-24 13:31:14'),
(13, 33, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(14, 34, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(15, 34, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(16, 34, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(17, 34, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(18, 35, '200 GM', '60', '60.00', '2020-09-14 10:28:42'),
(230, 123, '20', '40', '32.00', '2020-10-09 20:37:29'),
(22, 36, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(23, 36, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(24, 36, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(25, 36, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(26, 37, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(27, 37, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(28, 37, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(29, 37, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(30, 38, '200 GM', '45', '45.00', '2020-09-14 10:26:23'),
(31, 39, '500 GM', '20', '20', '2019-10-02 20:12:23'),
(32, 39, '1 KG', '40', '40', '2019-10-02 20:12:23'),
(33, 39, '2 KG', '80', '80', '2019-10-02 20:12:23'),
(34, 39, '250 GM', '10', '10', '2019-10-02 20:12:23'),
(35, 40, '50 GM', '60', '60.00', '2020-09-14 10:24:26'),
(36, 41, '25 GM', '40', '40.00', '2020-09-14 10:56:59'),
(37, 42, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(38, 42, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(39, 42, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(40, 42, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(41, 43, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(42, 43, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(43, 43, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(44, 43, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(45, 44, '100 GM', '110', '110.00', '2020-09-14 10:59:22'),
(46, 45, '500 GM', '60', '60', '2019-10-02 20:12:23'),
(47, 45, '1 KG', '120', '120', '2019-10-02 20:12:23'),
(48, 45, '2 KG', '240', '240', '2019-10-02 20:12:23'),
(49, 45, '250 GM', '30', '30', '2019-10-02 20:12:23'),
(50, 46, '500 GM', '80', '80', '2019-10-02 20:12:23'),
(51, 46, '1 KG', '160', '160', '2019-10-02 20:12:23'),
(52, 46, '2 KG', '320', '320', '2019-10-02 20:12:23'),
(53, 46, '250 GM', '40', '40', '2019-10-02 20:12:23'),
(54, 47, '500 GM', '50', '50', '2019-10-02 20:12:23'),
(55, 47, '1 KG', '100', '100', '2019-10-02 20:12:23'),
(56, 47, '2 KG', '200', '200', '2019-10-02 20:12:23'),
(57, 47, '250 GM', '25', '25', '2019-10-02 20:12:23'),
(58, 48, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(59, 48, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(60, 48, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(61, 48, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(62, 49, '500 GM', '40', '40', '2019-10-02 20:12:23'),
(63, 49, '1 KG', '80', '80', '2019-10-02 20:12:23'),
(64, 49, '2 KG', '160', '160', '2019-10-02 20:12:23'),
(65, 49, '250 GM', '20', '20', '2019-10-02 20:12:23'),
(66, 50, '500 GM', '60', '60', '2019-10-02 20:12:23'),
(67, 50, '1 KG', '120', '120', '2019-10-02 20:12:23'),
(68, 50, '2 KG', '240', '240', '2019-10-02 20:12:23'),
(69, 50, '250 GM', '30', '30', '2019-10-02 20:12:23'),
(70, 51, '500 GM', '40', '40', '2019-10-02 20:12:23'),
(71, 51, '1 KG', '80', '80', '2019-10-02 20:12:23'),
(72, 51, '2 KG', '160', '160', '2019-10-02 20:12:23'),
(73, 51, '250 GM', '20', '20', '2019-10-02 20:12:23'),
(74, 52, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(75, 52, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(76, 52, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(77, 52, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(78, 53, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(79, 53, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(80, 53, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(81, 53, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(82, 54, '1 Bundle', '10', '10', '2019-10-02 20:12:23'),
(83, 55, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(84, 55, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(85, 55, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(86, 55, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(87, 56, '500 GM', '20', '20', '2019-10-02 20:12:23'),
(88, 56, '1 KG', '40', '40', '2019-10-02 20:12:23'),
(89, 56, '2 KG', '80', '80', '2019-10-02 20:12:23'),
(90, 56, '250 GM', '10', '10', '2019-10-02 20:12:23'),
(91, 57, '1 KG', '20', '18', '2019-10-02 20:12:23'),
(92, 57, '2 KG', '40', '36', '2019-10-02 20:12:23'),
(93, 57, '500 GM', '10', '9', '2019-10-02 20:12:23'),
(94, 58, '500 GM', '20', '20', '2019-10-02 20:12:23'),
(95, 58, '1 KG', '40', '40', '2019-10-02 20:12:23'),
(96, 58, '2 KG', '80', '80', '2019-10-02 20:12:23'),
(97, 58, '250 GM', '10', '10', '2019-10-02 20:12:23'),
(98, 59, '1 Bundle', '10', '10', '2019-10-02 20:12:23'),
(99, 60, '500 GM', '50', '50', '2019-10-02 20:12:23'),
(100, 60, '1 KG', '100', '100', '2019-10-02 20:12:23'),
(101, 60, '2 KG', '200', '200', '2019-10-02 20:12:23'),
(102, 60, '250 GM', '25', '25', '2019-10-02 20:12:23'),
(103, 61, '1 Bundle', '20', '20', '2019-10-02 20:12:23'),
(104, 62, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(105, 62, '1 KG', '50', '50', '2019-10-02 20:12:23'),
(106, 62, '2 KG', '100', '100', '2019-10-02 20:12:23'),
(107, 62, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(108, 63, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(109, 63, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(110, 63, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(111, 63, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(112, 64, '500 GM', '20', '20', '2019-10-02 20:12:23'),
(113, 64, '1 KG', '40', '40', '2019-10-02 20:12:23'),
(114, 64, '2 KG', '80', '80', '2019-10-02 20:12:23'),
(115, 64, '250 GM', '10', '10', '2019-10-02 20:12:23'),
(116, 65, '500 GM', '20', '20', '2019-10-02 20:12:23'),
(117, 65, '1 KG', '40', '40', '2019-10-02 20:12:23'),
(118, 65, '2 KG', '80', '80', '2019-10-02 20:12:23'),
(119, 65, '250 GM', '10', '10', '2019-10-02 20:12:23'),
(120, 67, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(121, 67, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(122, 67, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(123, 67, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(124, 70, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(125, 70, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(126, 70, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(127, 70, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(128, 72, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(129, 72, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(130, 72, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(131, 72, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(132, 73, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(133, 73, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(134, 73, '2 Kg', '120', '120', '2019-10-02 20:12:23'),
(135, 73, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(136, 74, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(137, 74, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(138, 74, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(139, 74, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(140, 75, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(141, 75, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(142, 75, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(143, 75, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(144, 76, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(145, 76, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(146, 76, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(147, 76, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(148, 77, '1 Bundle', '10', '10', '2019-10-02 20:12:23'),
(149, 78, '1 Bundle', '10', '10', '2019-10-02 20:12:23'),
(150, 79, '1 Bundle', '10', '10', '2019-10-02 20:12:23'),
(151, 80, '1 Bundle', '10', '10', '2019-10-02 20:12:23'),
(152, 81, '1 Bundle', '10', '10', '2019-10-02 20:12:23'),
(153, 82, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(154, 82, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(155, 82, '2 KG', '180', '180', '2019-10-02 20:12:23'),
(156, 82, '250 GM', '15', '15', '2019-10-02 20:12:23'),
(157, 83, '1 Bundle', '10', '10', '2019-10-02 20:12:23'),
(228, 121, '500 GM', '500', '450.00', '2020-10-14 17:12:49'),
(160, 84, '500 GM', '50', '50', '2019-10-02 20:12:23'),
(161, 85, '25 GM', '35', '35.00', '2020-09-14 10:42:23'),
(227, 120, '20', '20', '19.80', '2020-09-30 16:19:48'),
(226, 0, '500 GM', '80', '80', '2020-09-26 10:13:35'),
(166, 86, '500 GM', '30', '30', '2019-10-02 20:12:23'),
(225, 0, '250 GM', '60', '60', '2020-09-26 10:13:35'),
(169, 87, '500 GM', '60', '60', '2019-10-02 20:12:23'),
(170, 88, '2 Dozen', '120', '120', '2019-10-02 20:12:23'),
(171, 89, '1 Piece', '30', '30', '2019-10-02 20:12:23'),
(172, 90, '2 Dozen', '160', '160', '2019-10-02 20:12:23'),
(173, 90, '1 Dozen', '90', '90', '2019-10-02 20:12:23'),
(174, 91, '2 KG', '160', '160', '2019-10-02 20:12:23'),
(175, 91, '1 KG', '80', '80', '2019-10-02 20:12:23'),
(176, 92, '2 KG', '140', '140', '2019-10-02 20:12:23'),
(177, 92, '1 KG', '70', '70', '2019-10-02 20:12:23'),
(178, 93, '2 KG', '200', '200', '2019-10-02 20:12:23'),
(179, 93, '1 KG', '100', '100', '2019-10-02 20:12:23'),
(180, 94, '1 Piece', '40', '40', '2019-10-02 20:12:23'),
(181, 95, '1 KG', '180', '180', '2019-10-02 20:12:23'),
(182, 95, '500 GM', '90', '90', '2019-10-02 20:12:23'),
(183, 96, '1 KG', '90', '90', '2019-10-02 20:12:23'),
(184, 96, '500 GM', '45', '45', '2019-10-02 20:12:23'),
(185, 97, '1 KG', '120', '120', '2019-10-02 20:12:23'),
(186, 97, '500 GM', '60', '60', '2019-10-02 20:12:23'),
(187, 98, '1 KG', '140', '140', '2019-10-02 20:12:23'),
(188, 98, '500 GM', '70', '70', '2019-10-02 20:12:23'),
(189, 99, '1 KG', '100', '100', '2019-10-02 20:12:23'),
(190, 99, '500 GM', '50', '50', '2019-10-02 20:12:23'),
(191, 100, '1 KG', '80', '80', '2019-10-02 20:12:23'),
(192, 100, '500 GM', '40', '40', '2019-10-02 20:12:23'),
(193, 101, '2 KG', '120', '120', '2019-10-02 20:12:23'),
(194, 101, '1 KG', '60', '60', '2019-10-02 20:12:23'),
(195, 102, '2 KG', '140', '140', '2019-10-02 20:12:23'),
(196, 102, '1 KG', '70', '70', '2019-10-02 20:12:23'),
(197, 103, '1 KG', '90', '90', '2019-10-02 20:12:23'),
(198, 103, '500 GM', '80', '80', '2019-10-02 20:12:23'),
(199, 104, '1 KG', '140', '140', '2019-10-02 20:12:23'),
(200, 104, '500 GM', '70', '70', '2019-10-02 20:12:23'),
(201, 105, '1 KG', '160', '160', '2019-10-02 20:12:23'),
(202, 105, '500 GM', '80', '80', '2019-10-02 20:12:23'),
(203, 106, '1 KG', '80', '80.00', '2020-05-03 21:16:22'),
(204, 106, '500 GM', '40', '40.00', '2020-05-03 21:16:22'),
(205, 107, '1 KG', '100', '100.00', '2020-05-03 21:15:50'),
(206, 107, '500 GM', '40', '40.00', '2020-05-03 21:15:50'),
(207, 88, '1 Dozen', '60', '60', '2019-10-02 20:12:23'),
(208, 108, '1 pcs', '200', '200.00', '2020-01-31 15:47:20'),
(209, 109, '1 pcs', '300', '300.00', '2020-05-09 20:05:20'),
(210, 110, '10', '50', '50.00', '2020-05-03 20:08:18'),
(211, 111, '500 GM', '50', '50.00', '2020-09-14 11:02:42'),
(213, 112, '1 Kg', '13', '13.00', '2020-05-03 21:17:31'),
(214, 113, '100 GM', '110', '93.50', '2020-09-14 10:35:42'),
(229, 122, '10', '100', '100.00', '2020-10-08 12:46:07'),
(216, 114, '500 grms', '20', '20.00', '2020-05-09 18:50:33'),
(217, 114, '1 kg', '40', '40.00', '2020-05-09 18:50:33'),
(218, 115, '200 GM', '100', '100.00', '2020-09-14 11:04:59'),
(219, 116, '200 GM', '70', '70.00', '2020-09-14 10:22:41'),
(220, 117, '10', '700', '630.00', '2020-09-15 18:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `trn_product_stock`
--

CREATE TABLE `trn_product_stock` (
  `int_glcode` int(11) NOT NULL,
  `fk_vendor` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `chr_status` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'I',
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `trn_product_stock`
--

INSERT INTO `trn_product_stock` (`int_glcode`, `fk_vendor`, `fk_product`, `chr_status`, `dt_createddate`, `dt_modifydate`) VALUES
(1, 1, 17, 'O', '2019-09-30 13:16:36', '2019-09-30 13:16:36'),
(2, 2, 67, 'I', '2019-10-01 11:04:40', '2019-10-01 11:04:40'),
(3, 2, 31, 'O', '2019-10-03 12:32:34', '2019-10-03 12:32:34'),
(4, 2, 34, 'O', '2019-10-03 12:32:37', '2019-10-03 12:32:37'),
(5, 1, 75, 'O', '2020-04-14 16:07:42', '2020-04-14 16:07:42'),
(6, 1, 43, 'O', '2020-05-09 12:52:21', '2020-05-09 12:52:21'),
(7, 1, 113, 'O', '2020-05-09 12:53:14', '2020-05-09 12:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `trn_user_wallet`
--

CREATE TABLE `trn_user_wallet` (
  `int_glcode` int(11) NOT NULL,
  `fk_order` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `var_amount` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `chr_transaction_type` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'D',
  `var_current_balance` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dt_createddate` datetime NOT NULL,
  `dt_modifydate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `trn_user_wallet`
--

INSERT INTO `trn_user_wallet` (`int_glcode`, `fk_order`, `fk_user`, `var_amount`, `chr_transaction_type`, `var_current_balance`, `dt_createddate`, `dt_modifydate`, `var_ipaddress`) VALUES
(1, 1, 16, '48.5', 'C', '48.5', '2019-10-01 21:37:08', '2019-10-01 21:37:08', ''),
(2, 1, 16, '35', 'C', '83.5', '2019-10-01 21:38:17', '2019-10-01 21:38:17', ''),
(3, 2, 16, '39', 'C', '122.5', '2019-10-01 21:38:48', '2019-10-01 21:38:48', ''),
(4, 1, 16, '29', 'C', '151.5', '2019-10-01 21:39:13', '2019-10-01 21:39:13', ''),
(5, 1, 5, '30', 'C', '360', '2019-10-01 21:47:13', '2019-10-01 21:47:13', ''),
(6, 2, 5, '50', 'D', '310', '2019-10-01 22:06:24', '2019-10-01 22:06:24', ''),
(7, 3, 5, '74.25', 'C', '384.25', '2019-10-02 10:36:05', '2019-10-02 10:36:05', ''),
(47, 0, 5, '0.0', 'D', '', '2020-05-18 18:17:24', '2020-05-18 18:17:24', ''),
(48, 0, 5, '0.0', 'D', '', '2020-05-18 18:17:39', '2020-05-18 18:17:39', ''),
(49, 0, 5, '0.0', 'D', '', '2020-05-26 10:47:56', '2020-05-26 10:47:56', ''),
(50, 16, 5, '57.0', 'C', '441.25', '2020-05-30 11:47:09', '2020-05-30 11:47:09', ''),
(18, 23, 16, '52', 'C', '', '2019-10-02 15:02:50', '2019-10-02 15:02:50', ''),
(19, 23, 16, '167', 'C', '', '2019-10-02 15:02:59', '2019-10-02 15:02:59', ''),
(20, 23, 16, '60', 'C', '', '2019-10-02 15:03:46', '2019-10-02 15:03:46', ''),
(21, 0, 7, '0.0', 'D', '', '2019-10-02 15:29:18', '2019-10-02 15:29:18', ''),
(22, 0, 7, '0.0', 'D', '', '2019-10-02 15:29:31', '2019-10-02 15:29:31', ''),
(23, 0, 7, '0.0', 'D', '', '2019-10-02 15:29:42', '2019-10-02 15:29:42', ''),
(24, 0, 7, '0.0', 'D', '', '2019-10-02 15:31:33', '2019-10-02 15:31:33', ''),
(25, 0, 7, '0.0', 'D', '', '2019-10-02 15:31:46', '2019-10-02 15:31:46', ''),
(26, 0, 7, '0.0', 'D', '', '2019-10-02 15:31:54', '2019-10-02 15:31:54', ''),
(27, 0, 7, '0.0', 'D', '', '2019-10-02 15:45:15', '2019-10-02 15:45:15', ''),
(28, 0, 7, '0.0', 'D', '', '2019-10-02 15:48:25', '2019-10-02 15:48:25', ''),
(29, 0, 7, '0.0', 'D', '', '2019-10-02 15:49:51', '2019-10-02 15:49:51', ''),
(30, 0, 7, '0.0', 'D', '', '2019-10-02 15:50:02', '2019-10-02 15:50:02', ''),
(31, 0, 16, '0.0', 'D', '', '2019-10-02 15:53:31', '2019-10-02 15:53:31', ''),
(32, 0, 16, '0.0', 'D', '', '2019-10-02 15:54:33', '2019-10-02 15:54:33', ''),
(33, 0, 7, '0.0', 'D', '', '2019-10-02 16:02:44', '2019-10-02 16:02:44', ''),
(36, 0, 1, '20', 'D', '', '2019-10-02 18:00:55', '2019-10-02 18:00:55', ''),
(37, 0, 18, '0.0', 'D', '', '2019-10-02 18:01:41', '2019-10-02 18:01:41', ''),
(38, 0, 18, '0.0', 'D', '', '2019-10-02 18:02:07', '2019-10-02 18:02:07', ''),
(39, 0, 1, '20', 'D', '', '2019-10-02 18:02:55', '2019-10-02 18:02:55', ''),
(40, 0, 18, '0.0', 'D', '', '2019-10-02 18:03:00', '2019-10-02 18:03:00', ''),
(41, 0, 18, '0.0', 'D', '', '2019-10-02 18:04:19', '2019-10-02 18:04:19', ''),
(42, 0, 18, '0.0', 'D', '', '2019-10-02 18:06:02', '2019-10-02 18:06:02', ''),
(43, 0, 18, '0.0', 'D', '', '2019-10-02 18:09:01', '2019-10-02 18:09:01', ''),
(45, 0, 28, '0.0', 'D', '', '2020-05-03 21:34:32', '2020-05-03 21:34:32', ''),
(51, 3, 83, '599.0', 'C', '599', '2020-10-07 18:10:27', '2020-10-07 18:10:27', ''),
(52, 38, 83, '1495', 'C', '2094', '2020-10-08 16:21:09', '2020-10-08 16:21:09', '');

-- --------------------------------------------------------

--
-- Table structure for table `trn_vendor_documents`
--

CREATE TABLE `trn_vendor_documents` (
  `int_glcode` int(11) NOT NULL,
  `fk_vendor` int(11) NOT NULL,
  `var_document` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `dt_createddate` datetime NOT NULL,
  `var_ipaddress` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `trn_vendor_documents`
--

INSERT INTO `trn_vendor_documents` (`int_glcode`, `fk_vendor`, `var_document`, `dt_createddate`, `var_ipaddress`) VALUES
(1, 6, '1564409014MembershipProfileforapp(1).pdf', '2019-07-29 19:33:34', '43.243.39.134'),
(2, 6, '1564409014Logo.png', '2019-07-29 19:33:34', '43.243.39.134'),
(23, 7, '1588268890AGADAIPTreatment.JPG', '2020-04-30 23:18:10', '49.207.134.58'),
(4, 5, '1564553671perthdupontlibraryexterior.jpg', '2019-07-31 11:44:31', '43.243.39.151'),
(5, 2, '1564752946AsampleofAadhaarcard.jpg', '2019-08-02 19:05:46', '43.243.38.124'),
(7, 2, '15647535861543989120samplepancard.jpg', '2019-08-02 19:16:26', '43.243.38.124'),
(8, 11, '1564754319AsampleofAadhaarcard.jpg', '2019-08-02 19:28:39', '43.243.38.124'),
(9, 11, '15647543191543989120samplepancard.jpg', '2019-08-02 19:28:39', '43.243.38.124'),
(10, 13, '1564831505AsampleofAadhaarcard.jpg', '2019-08-03 16:55:05', '43.243.38.106'),
(11, 13, '15648315051543989120samplepancard.jpg', '2019-08-03 16:55:05', '43.243.38.106'),
(12, 14, '1564838754educationloanimg1.jpg', '2019-08-03 18:55:54', '43.243.38.106'),
(13, 14, '1564838754home5.jpg.png', '2019-08-03 18:55:54', '43.243.38.106'),
(14, 14, '156483884633579057365daa9a11de8b12.jpg', '2019-08-03 18:57:26', '43.243.38.106'),
(15, 1, '1568376620AsampleofAadhaarcard.jpg', '2019-09-13 17:40:20', '43.243.38.98'),
(16, 1, '15683766201543989120samplepancard.jpg', '2019-09-13 17:40:20', '43.243.38.98'),
(17, 1, '', '2019-09-13 17:40:20', '43.243.38.98'),
(18, 1, '1568448295Onion.jpeg', '2019-09-14 13:34:55', '43.243.38.101'),
(19, 1, '1568448295strawberry.jpg', '2019-09-14 13:34:55', '43.243.38.101'),
(20, 2, '1568805144AsampleofAadhaarcard.jpg', '2019-09-18 16:42:24', '43.243.39.143'),
(21, 2, '15688051441543989120samplepancard.jpg', '2019-09-18 16:42:24', '43.243.39.143'),
(25, 9, '1588518020COVID19PredictionPaper(3).pdf', '2020-05-03 20:30:20', '49.207.131.108'),
(26, 10, '1589469042news3.docx', '2020-05-14 20:40:42', '49.207.128.93'),
(27, 10, '1589560119Screenshot20200416at10.28.22PM.png', '2020-05-15 21:58:39', '49.207.142.1'),
(28, 10, '', '2020-05-15 21:58:39', '49.207.142.1');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_withdraw`
--

CREATE TABLE `vendor_withdraw` (
  `int_glcode` int(11) NOT NULL,
  `fk_vendor` int(11) NOT NULL,
  `fk_order` int(11) NOT NULL,
  `var_amount` varchar(11) NOT NULL,
  `chr_status` char(11) NOT NULL DEFAULT 'N',
  `dt_createddate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_withdraw`
--

INSERT INTO `vendor_withdraw` (`int_glcode`, `fk_vendor`, `fk_order`, `var_amount`, `chr_status`, `dt_createddate`) VALUES
(1, 1, 64, '20.0', 'Y', '2020-05-05 18:29:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_commission`
--
ALTER TABLE `delivery_commission`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `delivery_withdraw`
--
ALTER TABLE `delivery_withdraw`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_admin`
--
ALTER TABLE `mst_admin`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_applied_promocode`
--
ALTER TABLE `mst_applied_promocode`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_blog`
--
ALTER TABLE `mst_blog`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_category`
--
ALTER TABLE `mst_category`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_contact_us`
--
ALTER TABLE `mst_contact_us`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_delivery_boy`
--
ALTER TABLE `mst_delivery_boy`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_delivery_charges`
--
ALTER TABLE `mst_delivery_charges`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_delivery_timeslot`
--
ALTER TABLE `mst_delivery_timeslot`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_feedback`
--
ALTER TABLE `mst_feedback`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_home_banners`
--
ALTER TABLE `mst_home_banners`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_logmanager`
--
ALTER TABLE `mst_logmanager`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_news`
--
ALTER TABLE `mst_news`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_newsletter`
--
ALTER TABLE `mst_newsletter`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_orders`
--
ALTER TABLE `mst_orders`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_order_reject_reason`
--
ALTER TABLE `mst_order_reject_reason`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_pincode`
--
ALTER TABLE `mst_pincode`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_products`
--
ALTER TABLE `mst_products`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_product_pincode`
--
ALTER TABLE `mst_product_pincode`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_promocode`
--
ALTER TABLE `mst_promocode`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_review`
--
ALTER TABLE `mst_review`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_settings`
--
ALTER TABLE `mst_settings`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_stors`
--
ALTER TABLE `mst_stors`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_testimonial`
--
ALTER TABLE `mst_testimonial`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_users`
--
ALTER TABLE `mst_users`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_user_address`
--
ALTER TABLE `mst_user_address`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_user_chat`
--
ALTER TABLE `mst_user_chat`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_vendors`
--
ALTER TABLE `mst_vendors`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `mst_withdraw_request`
--
ALTER TABLE `mst_withdraw_request`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `sell_with_us`
--
ALTER TABLE `sell_with_us`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `trn_assign_order`
--
ALTER TABLE `trn_assign_order`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `trn_cart_details`
--
ALTER TABLE `trn_cart_details`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `trn_order_status`
--
ALTER TABLE `trn_order_status`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `trn_product_images`
--
ALTER TABLE `trn_product_images`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `trn_product_price`
--
ALTER TABLE `trn_product_price`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `trn_product_stock`
--
ALTER TABLE `trn_product_stock`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `trn_user_wallet`
--
ALTER TABLE `trn_user_wallet`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `trn_vendor_documents`
--
ALTER TABLE `trn_vendor_documents`
  ADD PRIMARY KEY (`int_glcode`);

--
-- Indexes for table `vendor_withdraw`
--
ALTER TABLE `vendor_withdraw`
  ADD PRIMARY KEY (`int_glcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_commission`
--
ALTER TABLE `delivery_commission`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_withdraw`
--
ALTER TABLE `delivery_withdraw`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_admin`
--
ALTER TABLE `mst_admin`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_applied_promocode`
--
ALTER TABLE `mst_applied_promocode`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mst_blog`
--
ALTER TABLE `mst_blog`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_category`
--
ALTER TABLE `mst_category`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `mst_contact_us`
--
ALTER TABLE `mst_contact_us`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `mst_delivery_boy`
--
ALTER TABLE `mst_delivery_boy`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_delivery_charges`
--
ALTER TABLE `mst_delivery_charges`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_delivery_timeslot`
--
ALTER TABLE `mst_delivery_timeslot`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mst_feedback`
--
ALTER TABLE `mst_feedback`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mst_home_banners`
--
ALTER TABLE `mst_home_banners`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mst_logmanager`
--
ALTER TABLE `mst_logmanager`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `mst_news`
--
ALTER TABLE `mst_news`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_newsletter`
--
ALTER TABLE `mst_newsletter`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `mst_orders`
--
ALTER TABLE `mst_orders`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `mst_order_reject_reason`
--
ALTER TABLE `mst_order_reject_reason`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mst_pincode`
--
ALTER TABLE `mst_pincode`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mst_products`
--
ALTER TABLE `mst_products`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `mst_product_pincode`
--
ALTER TABLE `mst_product_pincode`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mst_promocode`
--
ALTER TABLE `mst_promocode`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `mst_review`
--
ALTER TABLE `mst_review`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `mst_settings`
--
ALTER TABLE `mst_settings`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_stors`
--
ALTER TABLE `mst_stors`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_testimonial`
--
ALTER TABLE `mst_testimonial`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_users`
--
ALTER TABLE `mst_users`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `mst_user_address`
--
ALTER TABLE `mst_user_address`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `mst_user_chat`
--
ALTER TABLE `mst_user_chat`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `mst_vendors`
--
ALTER TABLE `mst_vendors`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mst_withdraw_request`
--
ALTER TABLE `mst_withdraw_request`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sell_with_us`
--
ALTER TABLE `sell_with_us`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trn_assign_order`
--
ALTER TABLE `trn_assign_order`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `trn_cart_details`
--
ALTER TABLE `trn_cart_details`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=530;

--
-- AUTO_INCREMENT for table `trn_order_status`
--
ALTER TABLE `trn_order_status`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trn_product_images`
--
ALTER TABLE `trn_product_images`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `trn_product_price`
--
ALTER TABLE `trn_product_price`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `trn_product_stock`
--
ALTER TABLE `trn_product_stock`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trn_user_wallet`
--
ALTER TABLE `trn_user_wallet`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `trn_vendor_documents`
--
ALTER TABLE `trn_vendor_documents`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `vendor_withdraw`
--
ALTER TABLE `vendor_withdraw`
  MODIFY `int_glcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
