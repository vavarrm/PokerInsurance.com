-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2018-03-21 13:22:40
-- 伺服器版本: 5.7.19
-- PHP 版本： 5.6.31

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `poker`
--
DROP DATABASE IF EXISTS `poker`;
CREATE DATABASE IF NOT EXISTS `poker` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `poker`;

-- --------------------------------------------------------

--
-- 資料表結構 `admin_role`
--

CREATE TABLE `admin_role` (
  `ar_id` int(2) NOT NULL,
  `ar_name` varchar(30) NOT NULL,
  `add_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `admin_role`
--

INSERT INTO `admin_role` (`ar_id`, `ar_name`, `add_datetime`) VALUES
(1, 'system', '2018-02-24 06:55:20');

-- --------------------------------------------------------

--
-- 資料表結構 `admin_role_permissions_link`
--

CREATE TABLE `admin_role_permissions_link` (
  `apl_id` int(10) NOT NULL,
  `ar_id` int(2) DEFAULT NULL COMMENT 'admin_role_id',
  `pe_id` int(5) DEFAULT NULL COMMENT 'permissions_id',
  `add_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `admin_role_permissions_link`
--

INSERT INTO `admin_role_permissions_link` (`apl_id`, `ar_id`, `pe_id`, `add_datetime`) VALUES
(1, 1, 1, '2018-02-25 04:36:31'),
(2, 1, 3, '2018-02-25 04:36:42'),
(3, 1, 2, '2018-03-07 07:30:48'),
(4, 1, 8, '2018-03-07 13:44:14'),
(6, 1, 10, '2018-03-10 06:35:36'),
(7, 1, 11, '2018-03-12 12:39:02'),
(8, 1, 12, '2018-03-12 12:48:47'),
(9, 1, 13, '2018-03-13 09:02:39'),
(11, 1, 15, '2018-03-13 12:33:47'),
(12, 1, 16, '2018-03-13 12:38:56'),
(13, 1, 5, '2018-03-14 14:10:32'),
(14, 1, 17, '2018-03-15 10:05:50'),
(15, 1, 18, '2018-03-15 10:08:53'),
(16, 1, 19, '2018-03-15 14:11:29'),
(17, 1, 20, '2018-03-16 04:43:47'),
(18, 1, 21, '2018-03-16 07:34:34'),
(19, 1, 22, '2018-03-16 08:56:28');

-- --------------------------------------------------------

--
-- 資料表結構 `admin_user`
--

CREATE TABLE `admin_user` (
  `ad_id` int(11) NOT NULL,
  `ad_account` varchar(12) NOT NULL,
  `ad_passwd` char(32) NOT NULL,
  `add_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ad_status` enum('unlock','onlock') NOT NULL DEFAULT 'unlock',
  `ad_ar_id` int(2) DEFAULT NULL COMMENT 'admin_role_id',
  `ad_r_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `admin_user`
--

INSERT INTO `admin_user` (`ad_id`, `ad_account`, `ad_passwd`, `add_datetime`, `ad_status`, `ad_ar_id`, `ad_r_id`) VALUES
(1, 'tryion', '25d55ad283aa400af464c76d713c07ad', '2018-03-20 14:46:15', 'unlock', 1, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `error_log`
--

CREATE TABLE `error_log` (
  `el_id` int(11) NOT NULL,
  `el_message` text NOT NULL,
  `el_system_error` varchar(200) DEFAULT NULL,
  `el_class` varchar(100) NOT NULL,
  `el_function` varchar(200) NOT NULL,
  `el_add_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `error_log`
--

INSERT INTO `error_log` (`el_id`, `el_message`, `el_system_error`, `el_class`, `el_function`, `el_add_datetime`) VALUES
(1, '系统错误/system error', 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near \'? AND odds_group_id =1\' at line 4', 'HdPokerInsurance', 'insert', '2018-03-20 10:49:30'),
(2, '系统错误/system error', 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near \'(\r\n							round,\r\n							outs,\r\n							odds,\r\n							pot,\r\n						', 'HdPokerInsurance', 'insert', '2018-03-20 10:56:41'),
(3, '系统错误/system error', 'Column \'round\' cannot be null', 'HdPokerInsurance', 'insert', '2018-03-20 10:57:36'),
(4, '系统错误/system error', 'Column \'round\' cannot be null', 'HdPokerInsurance', 'insert', '2018-03-20 10:58:31'),
(5, '系统错误/system error', 'Column \'pot\' cannot be null', 'HdPokerInsurance', 'insert', '2018-03-20 10:59:33'),
(6, '系统错误/system error', 'Column \'pot\' cannot be null', 'HdPokerInsurance', 'insert', '2018-03-20 10:59:45'),
(7, '系统错误/system error', 'Column \'pot\' cannot be null', 'HdPokerInsurance', 'insert', '2018-03-20 11:00:24'),
(8, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:13:09'),
(9, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:13:12'),
(10, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:17:13'),
(11, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:19:51'),
(12, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:19:54'),
(13, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:20:33'),
(14, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:20:36'),
(15, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:21:02'),
(16, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:21:04'),
(17, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:21:27'),
(18, '系统错误/system error', NULL, 'HdPokerInsurance', 'chenkUserCode', '2018-03-20 11:21:32'),
(19, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 11:23:26'),
(20, '结果无法储存/can\'t save result', '', 'HdPokerInsurance', 'uploadResult', '2018-03-20 11:31:48'),
(21, '结果无法储存/can\'t save result', '', 'HdPokerInsurance', 'uploadResult', '2018-03-20 11:32:00'),
(22, '系统错误/system error', NULL, 'HdPokerInsurance', 'uploadResult', '2018-03-20 11:32:22'),
(23, '系统错误/system error', NULL, 'HdPokerInsurance', 'uploadResult', '2018-03-20 11:32:45'),
(24, '结果无法储存/can\'t save result', '', 'HdPokerInsurance', 'uploadResult', '2018-03-20 11:32:55'),
(25, '结果无法储存/can\'t save result', '', 'HdPokerInsurance', 'uploadResult', '2018-03-20 11:40:02'),
(26, '结果无法储存/can\'t save result', '', 'HdPokerInsurance', 'uploadResult', '2018-03-20 11:40:05'),
(27, '结果无法储存/can\'t save result', '', 'HdPokerInsurance', 'uploadResult', '2018-03-20 11:40:09'),
(28, '结果无法储存/can\'t save result', '', 'HdPokerInsurance', 'uploadResult', '2018-03-20 11:41:05'),
(29, '尚未登入/please login', NULL, 'Api', 'getUser', '2018-03-20 11:47:41'),
(30, '尚未登入/please login', NULL, 'Api', 'getUser', '2018-03-20 12:59:47'),
(31, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:07:53'),
(32, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:07:56'),
(33, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:08:03'),
(34, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:08:22'),
(35, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:08:25'),
(36, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:08:41'),
(37, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:08:55'),
(38, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:09:06'),
(39, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:09:17'),
(40, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:09:52'),
(41, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:09:59'),
(42, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:10:03'),
(43, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:10:09'),
(44, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:10:36'),
(45, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:10:48'),
(46, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:11:13'),
(47, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:11:49'),
(48, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:11:57'),
(49, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:12:11'),
(50, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:12:21'),
(51, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-20 13:13:18'),
(52, '尚未登入/please login', NULL, 'Api', 'getUser', '2018-03-20 13:29:33'),
(53, 'sess is empty', 'Table \'poker.admin_user\' doesn\'t exist', 'AdminApi', 'login', '2018-03-20 14:18:35'),
(54, 'sess is empty', 'Table \'poker.admin_user\' doesn\'t exist', 'AdminApi', 'login', '2018-03-20 14:20:05'),
(55, 'sess is empty', 'Table \'poker.admin_user\' doesn\'t exist', 'AdminApi', 'login', '2018-03-20 14:20:44'),
(56, 'sess is empty', 'Table \'poker.admin_user\' doesn\'t exist', 'AdminApi', 'login', '2018-03-20 14:20:45'),
(57, 'sess is empty', 'Table \'poker.admin_user\' doesn\'t exist', 'AdminApi', 'login', '2018-03-20 14:21:11'),
(58, 'sess is empty', 'Table \'poker.admin_user\' doesn\'t exist', 'AdminApi', 'login', '2018-03-20 14:21:21'),
(59, 'system error', 'Table \'poker.admin_user\' doesn\'t exist', 'AdminApi', 'login', '2018-03-20 14:22:41'),
(60, 'passwd is error', NULL, 'AdminApi', 'login', '2018-03-20 14:23:35'),
(61, 'passwd is error', NULL, 'AdminApi', 'login', '2018-03-20 14:23:39'),
(62, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:23:49'),
(63, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:24:03'),
(64, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:25:39'),
(65, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:26:22'),
(66, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:26:37'),
(67, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:27:41'),
(68, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:29:42'),
(69, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:29:47'),
(70, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:30:10'),
(71, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:30:23'),
(72, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:33:22'),
(73, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:33:48'),
(74, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:34:39'),
(75, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:35:15'),
(76, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:35:17'),
(77, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:35:26'),
(78, 'sess is empty', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:35:30'),
(79, 'system error', 'Table \'poker.admin_role_permissions_link\' doesn\'t exist', 'AdminApi', 'getUser', '2018-03-20 14:36:21'),
(80, '尚未登入/please login', NULL, 'Api', 'getUser', '2018-03-21 04:25:16'),
(81, '尚未登入/please login', NULL, 'Api', 'getUser', '2018-03-21 04:25:20'),
(82, '尚未登入/please login', NULL, 'Api', 'getUser', '2018-03-21 04:25:26'),
(83, '尚未登入/please login', NULL, 'Api', 'getUser', '2018-03-21 04:25:31'),
(84, 'login is empty', NULL, 'AdminApi', 'getUser', '2018-03-21 04:34:47'),
(85, '系统错误/system error', 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near \'WHERE  odds_group_id =1\' at line 4', 'HdPokerInsurance', 'getOdds', '2018-03-21 04:50:26'),
(86, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-21 05:16:33'),
(87, '系统错误/system error', NULL, 'HdPokerInsurance', 'insert', '2018-03-21 05:16:40');

-- --------------------------------------------------------

--
-- 資料表結構 `permissions`
--

CREATE TABLE `permissions` (
  `pe_id` int(5) NOT NULL,
  `pe_name` varchar(50) NOT NULL,
  `pe_control` varchar(100) NOT NULL,
  `pe_func` varchar(100) NOT NULL,
  `pe_type` enum('menu','action') NOT NULL DEFAULT 'menu',
  `add_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pe_parents_id` int(5) NOT NULL DEFAULT '0',
  `pe_page` varchar(100) DEFAULT NULL,
  `pe_order_id` int(2) NOT NULL DEFAULT '0',
  `pe_icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `texasholdem_insurance_odds`
--

CREATE TABLE `texasholdem_insurance_odds` (
  `odds_id` int(11) NOT NULL,
  `odds_group_id` int(2) UNSIGNED NOT NULL,
  `odds_outs` int(2) NOT NULL,
  `odds_value` double UNSIGNED NOT NULL,
  `add_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `texasholdem_insurance_odds`
--

INSERT INTO `texasholdem_insurance_odds` (`odds_id`, `odds_group_id`, `odds_outs`, `odds_value`, `add_datetime`) VALUES
(61, 1, 1, 36, '2018-03-20 10:07:25'),
(62, 1, 2, 18, '2018-03-20 10:07:25'),
(63, 1, 3, 12, '2018-03-20 10:07:25'),
(64, 1, 4, 8.5, '2018-03-20 10:07:25'),
(65, 1, 5, 6.5, '2018-03-20 10:07:25'),
(66, 1, 6, 6.5, '2018-03-20 10:07:25'),
(67, 1, 7, 4.5, '2018-03-20 10:07:25'),
(68, 1, 8, 3.8, '2018-03-20 10:07:25'),
(69, 1, 9, 3.3, '2018-03-20 10:07:25'),
(70, 1, 10, 2.8, '2018-03-20 10:07:25'),
(71, 1, 11, 2.5, '2018-03-20 10:07:25'),
(72, 1, 12, 2.2, '2018-03-20 10:07:25'),
(73, 1, 13, 2, '2018-03-20 10:07:25'),
(74, 1, 14, 1.8, '2018-03-20 10:07:25'),
(75, 1, 15, 1.5, '2018-03-20 10:07:25'),
(76, 1, 16, 1.4, '2018-03-20 10:07:25'),
(77, 1, 17, 1.3, '2018-03-20 10:07:25'),
(78, 1, 18, 1.2, '2018-03-20 10:07:25'),
(79, 1, 19, 1.1, '2018-03-20 10:07:25'),
(80, 1, 20, 1, '2018-03-20 10:07:25');

-- --------------------------------------------------------

--
-- 資料表結構 `texasholdem_insurance_order`
--

CREATE TABLE `texasholdem_insurance_order` (
  `order_id` int(20) NOT NULL,
  `round` enum('flop','turn') NOT NULL,
  `outs` int(2) UNSIGNED NOT NULL,
  `odds` double UNSIGNED NOT NULL,
  `pot` double UNSIGNED NOT NULL,
  `maximun` double UNSIGNED NOT NULL,
  `maximun_p50` double UNSIGNED NOT NULL,
  `buy_amount` double UNSIGNED NOT NULL,
  `u_id` int(11) NOT NULL,
  `result` enum('pay','nopay') DEFAULT NULL,
  `pay_amount` double UNSIGNED NOT NULL DEFAULT '0',
  `add_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `insured_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `texasholdem_insurance_order`
--

INSERT INTO `texasholdem_insurance_order` (`order_id`, `round`, `outs`, `odds`, `pot`, `maximun`, `maximun_p50`, `buy_amount`, `u_id`, `result`, `pay_amount`, `add_datetime`, `insured_amount`) VALUES
(1, '', 11, 2.5, 22222, 8888.8, 4444.4, 8888.8, 1, NULL, 22222, '2018-03-20 11:00:44', 0),
(2, '', 11, 2.5, 22222, 8888.8, 4444.4, 8888.8, 1, NULL, 22222, '2018-03-20 11:04:01', 0),
(3, '', 11, 2.5, 22222, 8888.8, 4444.4, 8888.8, 1, NULL, 22222, '2018-03-20 11:05:25', 0),
(4, '', 11, 2.5, 22222, 8888.8, 4444.4, 8888.8, 1, NULL, 22222, '2018-03-20 11:05:27', 0),
(5, '', 10, 2.8, 200, 71.4, 35.7, 71.4, 1, NULL, 199.9, '2018-03-20 11:07:32', 0),
(6, '', 10, 2.8, 100, 35.7, 17.8, 25, 1, NULL, 70, '2018-03-20 11:14:12', 0),
(7, '', 12, 2.2, 123, 55.9, 27.9, 55.9, 1, NULL, 122.9, '2018-03-20 11:23:56', 0),
(8, '', 12, 2.2, 200, 90.9, 45.4, 90.9, 1, NULL, 199.9, '2018-03-20 11:34:06', 0),
(9, '', 11, 2.5, 500, 200, 100, 200, 1, NULL, 500, '2018-03-20 11:39:17', 0),
(10, '', 11, 2.5, 500, 200, 100, 200, 1, NULL, 500, '2018-03-20 11:39:26', 0),
(11, '', 11, 2.5, 500, 200, 100, 200, 1, NULL, 500, '2018-03-20 11:39:38', 0),
(12, '', 11, 2.5, 500, 200, 100, 200, 1, NULL, 500, '2018-03-20 11:39:41', 0),
(13, '', 11, 2.5, 500, 200, 100, 200, 1, 'pay', 500, '2018-03-20 11:39:58', 0),
(14, '', 10, 2.8, 200, 71.4, 35.7, 71, 1, 'pay', 198.7, '2018-03-20 11:43:57', 0),
(15, '', 5, 6.5, 150, 23, 11.5, 23, 1, NULL, 149.5, '2018-03-20 13:05:23', 0),
(16, '', 12, 2.2, 1520, 690.9, 345.4, 690.9, 1, NULL, 1519.9, '2018-03-20 13:06:44', 0),
(17, '', 12, 2.2, 123456, 56116.3, 28058.1, 56116.3, 1, NULL, 123455.8, '2018-03-20 13:12:57', 0),
(18, '', 12, 2.2, 123456, 56116.3, 28058.1, 56116.3, 1, NULL, 123455.8, '2018-03-20 13:13:10', 0),
(19, '', 12, 2.2, 123456, 56116.3, 28058.1, 56116.3, 1, NULL, 123455.8, '2018-03-20 13:14:30', 0),
(20, '', 12, 2.2, 123456, 56116.3, 28058.1, 56116.3, 1, NULL, 123455.8, '2018-03-20 13:14:35', 0),
(21, '', 15, 1.5, 20, 13.3, 6.6, 13.3, 1, 'pay', 19.9, '2018-03-20 13:14:56', 0),
(22, '', 1, 36, 20, 0.5, 0.2, 0.5, 1, 'pay', 18, '2018-03-21 05:01:40', 0),
(23, '', 20, 1, 150, 150, 75, 150, 1, 'nopay', 150, '2018-03-21 05:02:26', 0),
(24, '', 12, 2.2, 20, 9, 4.5, 9, 1, 'nopay', 0, '2018-03-21 05:07:22', 0),
(25, '', 15, 1.5, 500, 333.3, 166.6, 333, 1, 'pay', 499.5, '2018-03-21 05:14:45', 0),
(26, '', 15, 1.5, 500, 333.3, 166.6, 333, 1, NULL, 0, '2018-03-21 05:15:28', 0),
(27, '', 15, 1.5, 200, 133.3, 66.6, 133.3, 1, NULL, 0, '2018-03-21 05:17:14', 199.9),
(28, '', 15, 1.5, 200, 133.3, 66.6, 133.3, 1, 'nopay', 0, '2018-03-21 05:17:18', 199.9),
(29, '', 15, 1.5, 200, 133.3, 66.6, 133.3, 1, 'pay', 199.9, '2018-03-21 05:17:47', 199.9),
(30, '', 7, 4.5, 588, 130.6, 65.3, 50, 1, 'nopay', 0, '2018-03-21 05:18:20', 225);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_account` varchar(12) NOT NULL,
  `u_password` varchar(64) NOT NULL,
  `u_name` varchar(60) NOT NULL,
  `add_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_code` char(6) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`u_id`, `u_account`, `u_password`, `u_name`, `add_datetime`, `u_code`) VALUES
(1, 'tryion', '1c63129ae9db9c60c3e8aa94d3e00495', 'tryion', '2018-03-20 06:20:32', '123456');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`ar_id`);

--
-- 資料表索引 `admin_role_permissions_link`
--
ALTER TABLE `admin_role_permissions_link`
  ADD PRIMARY KEY (`apl_id`),
  ADD KEY `fk_pemissions_id` (`pe_id`),
  ADD KEY `fk_admin_role_id` (`ar_id`);

--
-- 資料表索引 `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`ad_id`),
  ADD UNIQUE KEY `ad_account` (`ad_account`),
  ADD UNIQUE KEY `ad_r_id` (`ad_r_id`),
  ADD KEY `fk_pemissions_id_admin_user` (`ad_ar_id`);

--
-- 資料表索引 `error_log`
--
ALTER TABLE `error_log`
  ADD PRIMARY KEY (`el_id`);

--
-- 資料表索引 `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`pe_id`),
  ADD UNIQUE KEY `pe_control` (`pe_control`,`pe_func`);

--
-- 資料表索引 `texasholdem_insurance_odds`
--
ALTER TABLE `texasholdem_insurance_odds`
  ADD PRIMARY KEY (`odds_id`),
  ADD UNIQUE KEY `odds_type` (`odds_group_id`,`odds_outs`);

--
-- 資料表索引 `texasholdem_insurance_order`
--
ALTER TABLE `texasholdem_insurance_order`
  ADD PRIMARY KEY (`order_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_account` (`u_account`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `ar_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表 AUTO_INCREMENT `admin_role_permissions_link`
--
ALTER TABLE `admin_role_permissions_link`
  MODIFY `apl_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用資料表 AUTO_INCREMENT `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表 AUTO_INCREMENT `error_log`
--
ALTER TABLE `error_log`
  MODIFY `el_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- 使用資料表 AUTO_INCREMENT `permissions`
--
ALTER TABLE `permissions`
  MODIFY `pe_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `texasholdem_insurance_odds`
--
ALTER TABLE `texasholdem_insurance_odds`
  MODIFY `odds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- 使用資料表 AUTO_INCREMENT `texasholdem_insurance_order`
--
ALTER TABLE `texasholdem_insurance_order`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `admin_role_permissions_link`
--
ALTER TABLE `admin_role_permissions_link`
  ADD CONSTRAINT `fk_admin_role_id` FOREIGN KEY (`ar_id`) REFERENCES `admin_role` (`ar_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemissions_id` FOREIGN KEY (`pe_id`) REFERENCES `permissions` (`pe_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 資料表的 Constraints `admin_user`
--
ALTER TABLE `admin_user`
  ADD CONSTRAINT `fk_pemissions_id_admin_user` FOREIGN KEY (`ad_ar_id`) REFERENCES `admin_role` (`ar_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`ad_ar_id`) REFERENCES `admin_role` (`ar_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
