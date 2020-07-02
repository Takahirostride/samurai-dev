-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 15, 2018 lúc 06:48 AM
-- Phiên bản máy phục vụ: 5.7.23
-- Phiên bản PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `samurai_site`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hire_client_logs`
--

DROP TABLE IF EXISTS `hire_client_logs`;
CREATE TABLE IF NOT EXISTS `hire_client_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `hire_id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL DEFAULT '0',
  `work_set_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `hire_client_log_status` (`status`,`client_id`,`updated_at`) USING BTREE,
  KEY `hireclientlog_updatedat` (`status`,`updated_at`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hire_client_logs`
--

INSERT INTO `hire_client_logs` (`id`, `client_id`, `hire_id`, `policy_id`, `work_set_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 115, 3, 1307, 25, 2, '2018-10-19 15:05:38', '2017-09-12 17:00:00'),
(2, 115, 7, 3, 0, 1, '2018-11-09 09:24:15', '2018-11-09 09:24:15'),
(3, 115, 8, 8, 0, 1, '2017-12-21 17:38:10', '2017-12-21 17:38:10'),
(4, 115, 9, 8, 0, 1, '2018-11-09 09:24:18', '2018-11-09 09:24:18'),
(5, 115, 10, 13, 0, 1, '2017-12-20 01:06:22', '2017-12-20 01:06:22'),
(6, 115, 11, 13, 0, 1, '2018-11-09 09:24:21', '2018-11-09 09:24:21'),
(7, 115, 12, 9, 0, 1, '2017-12-20 01:06:12', '2017-12-20 01:06:12'),
(8, 115, 13, 1306, 0, 1, '2018-11-09 08:35:37', '2018-11-09 08:35:37'),
(9, 115, 14, 14, 0, 1, '2018-11-09 09:24:24', '2018-11-09 09:24:24'),
(10, 115, 18, 14, 0, 1, '2017-12-20 01:06:12', '2017-12-20 01:06:12'),
(11, 115, 21, 16, 0, 1, '2017-12-20 01:06:12', '2017-12-20 01:06:12'),
(12, 115, 23, 17, 68, 2, '2018-11-09 08:35:30', '2018-09-13 17:00:00'),
(13, 115, 24, 8, 0, 1, '2017-12-20 01:06:12', '2017-12-20 01:06:12'),
(14, 115, 25, 8, 0, 1, '2017-12-20 01:06:12', '2017-12-20 01:06:12'),
(15, 115, 26, 16, 70, 2, '2018-12-13 16:04:20', '2018-09-13 17:00:00'),
(16, 115, 27, 7, 0, 1, '2017-12-20 01:06:12', '2017-12-20 01:06:12'),
(17, 115, 30, 11, 0, 1, '2017-12-20 01:06:12', '2017-12-20 01:06:12'),
(18, 115, 32, 2, 86, 2, '2018-11-09 09:23:04', '2018-11-29 17:00:00'),
(19, 115, 34, 518, 0, 1, '2018-09-06 04:52:07', '2018-09-06 04:52:07'),
(20, 115, 35, 1, 0, 1, '2018-09-06 04:52:07', '2018-09-06 04:52:07'),
(21, 115, 36, 4, 0, 1, '2018-04-13 10:00:21', '2018-04-13 10:00:21'),
(22, 115, 37, 447, 0, 1, '2018-11-25 02:16:35', '2018-11-25 02:16:35'),
(23, 115, 38, 280, 64, 2, '2018-11-06 11:27:08', '2018-05-15 17:00:00'),
(24, 115, 39, 279, 0, 1, '2018-11-21 13:03:52', '2018-11-21 13:03:52'),
(25, 115, 41, 53, 0, 1, '2018-12-12 20:22:55', '2018-12-12 20:22:55'),
(26, 268, 42, 1455, 0, 1, '2018-06-26 04:09:41', '2018-06-26 04:09:41'),
(27, 261, 43, 1829, 0, 1, '2018-07-23 05:48:52', '2018-07-23 05:48:52'),
(28, 115, 44, 1829, 0, 1, '2018-11-08 05:37:37', '2018-11-08 05:37:37'),
(29, 265, 45, 1829, 0, 1, '2018-07-23 05:48:52', '2018-07-23 05:48:52'),
(30, 267, 46, 1829, 0, 1, '2018-12-06 18:25:38', '2018-12-06 18:25:38'),
(31, 268, 47, 1829, 0, 1, '2018-07-23 05:48:52', '2018-07-23 05:48:52'),
(32, 270, 48, 1829, 0, 1, '2018-07-23 05:48:52', '2018-07-23 05:48:52'),
(33, 272, 49, 1829, 0, 1, '2018-12-03 05:44:28', '2018-12-03 05:44:28'),
(34, 115, 50, 2420, 85, 2, '2018-11-06 11:18:51', '2018-10-22 17:00:00'),
(35, 270, 51, 1, 0, 1, '2018-08-26 13:32:25', '2018-08-26 13:32:25'),
(36, 115, 52, 2505, 0, 1, '2018-11-06 11:18:09', '2018-11-06 11:18:09'),
(37, 115, 53, 2373, 0, 1, '2018-09-11 05:49:31', '2018-09-11 05:49:31'),
(38, 115, 54, 159, 0, 1, '2018-12-06 18:05:12', '2018-12-06 18:05:12'),
(39, 115, 55, 2700, 87, 2, '2018-12-14 04:28:25', '2018-11-11 17:00:00'),
(40, 265, 56, 141, 0, 1, '2018-12-06 18:27:29', '2018-12-06 18:27:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hire_client_statistics`
--

DROP TABLE IF EXISTS `hire_client_statistics`;
CREATE TABLE IF NOT EXISTS `hire_client_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `finish` int(11) NOT NULL DEFAULT '0',
  `accept` int(11) NOT NULL DEFAULT '0',
  `policy_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hireclientstatistic_clientid` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hire_client_statistics`
--

INSERT INTO `hire_client_statistics` (`id`, `client_id`, `total`, `finish`, `accept`, `policy_count`) VALUES
(1, 115, 31, 2, 6, 25),
(2, 268, 2, 0, 0, 2),
(3, 261, 1, 0, 0, 1),
(4, 265, 2, 0, 0, 2),
(5, 267, 1, 0, 0, 1),
(6, 270, 2, 0, 0, 2),
(7, 272, 1, 0, 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
