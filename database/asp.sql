-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th12 15, 2018 lúc 04:09 PM
-- Phiên bản máy phục vụ: 5.6.41
-- Phiên bản PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `newsamur_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_client_logs`
--

CREATE TABLE `asp_client_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `asp_user_id` int(11) NOT NULL DEFAULT '0',
  `favorite` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `asp_client_logs`
--

INSERT INTO `asp_client_logs` (`id`, `user_id`, `asp_user_id`, `favorite`, `created_at`) VALUES
(1, 342, 4, 1, '2018-12-11 18:45:12'),
(2, 348, 4, 1, '2018-12-11 18:45:15'),
(3, 267, 1, 1, '2018-12-13 01:03:23'),
(4, 341, 1, 1, '2018-12-13 04:21:12'),
(5, 272, 1, 1, '2018-12-13 04:21:28'),
(6, 115, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_client_policy`
--

CREATE TABLE `asp_client_policy` (
  `id` int(11) NOT NULL,
  `asp_client_log_id` int(11) NOT NULL DEFAULT '0',
  `policy_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1:sendmail;2:print',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_company`
--

CREATE TABLE `asp_company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `province_id` int(11) NOT NULL,
  `other_province` varchar(255) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `other_city` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `establish_at` date DEFAULT NULL,
  `capital` int(11) NOT NULL,
  `staff_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `asp_user_id` int(11) NOT NULL,
  `is_register` tinyint(1) NOT NULL DEFAULT '0',
  `sended_at` datetime DEFAULT NULL,
  `favorite` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `asp_company`
--

INSERT INTO `asp_company` (`id`, `name`, `email`, `province_id`, `other_province`, `city_id`, `other_city`, `street_address`, `apartment`, `establish_at`, `capital`, `staff_number`, `user_id`, `asp_user_id`, `is_register`, `sended_at`, `favorite`, `created_at`, `updated_at`) VALUES
(1, '株式会社サムライ', 'ps14030022@gmail.com', 1, NULL, 2, NULL, '南平台町３−１３', '', '2009-01-22', 3000000, 6, 115, 1, 1, '2018-12-11 18:34:37', 0, '2018-12-13 05:45:19', '2018-12-13 05:45:19'),
(2, '株式会社サムライ', 'ps1403002@gmail.com', 13, NULL, 295, NULL, '南平台町３−１３', '', '2009-01-22', 300, 6, 115, 2, 1, '2018-12-11 18:37:29', 0, '2018-12-11 09:37:29', '2018-12-11 11:37:29'),
(3, '株式会社サムライ', 'ps1403002@gmail.com', 13, NULL, 295, NULL, '南平台町３−１３', '', '2009-01-22', 300, 6, 115, 4, 1, '2018-12-11 18:41:23', 1, '2018-12-11 09:45:48', '2018-12-11 11:45:48'),
(4, '株式会社スペースキー', 'y.anezaki@spacekey.co.jp', 13, NULL, 304, NULL, '道玄坂2‐10‐7　新大宗ビル2号館4階', '', '2007-01-01', 800, 90, 261, 4, 0, NULL, 0, '2018-12-11 11:40:31', '2018-12-11 11:40:31'),
(5, 'company demo', '', 2, NULL, 49, NULL, 'afafaff', '', '2016-11-01', 300000000, 1000, 0, 4, 0, NULL, 1, '2018-12-11 09:45:49', '2018-12-11 11:45:49'),
(6, '株式会社テスト', 'info@grand2.com', 13, NULL, 304, NULL, '南平台町3-13', '新堀ビル3F', NULL, 3000000, 5, 0, 4, 0, NULL, 0, '2018-12-11 11:42:33', '2018-12-11 11:42:33'),
(14, '株式会社グランドツー', 'hashimoto@j-prout.co.jp', 13, NULL, 304, NULL, '0033', '新堀ビル3F', '0000-00-00', 3000000, 10, 289, 1, 1, '2018-12-13 11:49:02', 1, '2018-12-13 04:23:09', '2018-12-13 04:23:09'),
(15, 'ケントクリエーション株式会社', 'info@guesthouse-japan.net', 1, NULL, 2, NULL, '中央区南１条西２０丁目１−６', '', '0000-00-00', 10000000, 20, 357, 1, 0, NULL, 0, '2018-12-13 04:23:39', '2018-12-13 04:23:39'),
(16, 'オサダ農機　株式会社', 'chieko@j-prout.co.jp', 1, NULL, 40, NULL, '字扇山877番地3', '', '2001-01-01', 38000000, 22, 358, 1, 0, NULL, 1, '2018-12-13 05:01:42', '2018-12-13 05:01:42'),
(17, '池田食品株式会社', 'marnyhashimoto@icloud.com', 1, NULL, 2, NULL, '白石区中央1条3丁目32', '', '2001-01-01', 40000000, 40, 359, 1, 0, NULL, 1, '2018-12-13 05:02:31', '2018-12-13 05:02:31'),
(19, '株式会社グランドツー', 'info@grand2.com', 13, NULL, 304, NULL, '南平台町3-13', '新堀ビル3F', NULL, 3000000, 10, 270, 1, 0, NULL, 0, '2018-12-13 04:10:32', '2018-12-13 04:10:32'),
(20, '株式会社テスト', 'info@grand2.com', 13, NULL, 304, NULL, '南平台町3-13', '新堀ビル3F', NULL, 3000000, 5, 270, 2, 0, NULL, 0, '2018-12-13 04:14:56', '2018-12-13 04:14:56'),
(21, '株式会社テスト-test', 'info-test01@grand2.com', 13, NULL, 304, NULL, '南平台町3-13', '新堀ビル3F', NULL, 3000000, 5, 355, 2, 0, NULL, 0, '2018-12-13 04:16:17', '2018-12-13 04:16:17'),
(22, 'company demo', 'asp-test-company@samurai-match.site', 2, NULL, 49, NULL, 'afafaff', '', '0000-00-00', 300000000, 1000, 356, 2, 0, NULL, 0, '2018-12-13 04:18:35', '2018-12-13 04:18:35'),
(23, 'tetetgdgdgdg', 'afjadgdgdgfalf@localhos.pc', 10, NULL, 194, NULL, 'dgdgdgdgd', '', '2018-11-01', 30000, 50, 360, 2, 0, NULL, 0, '2018-12-14 01:50:48', '2018-12-14 01:50:48'),
(24, '株式会sfsfs社テスト', 'info4242@grand2.com', 13, '東京都', 304, '渋谷区', '南平台町3-13', '新堀ビル3F', '2001-01-01', 3000000, 5, 361, 2, 0, NULL, 0, '2018-12-14 01:51:42', '2018-12-14 01:51:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_company_trades`
--

CREATE TABLE `asp_company_trades` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `trade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `asp_company_trades`
--

INSERT INTO `asp_company_trades` (`id`, `company_id`, `trade_id`) VALUES
(1, 1, 17),
(2, 1, 21),
(3, 1, 23),
(4, 1, 25),
(5, 1, 24),
(6, 1, 33),
(7, 1, 34),
(8, 1, 35),
(9, 2, 17),
(10, 2, 21),
(11, 2, 23),
(12, 2, 25),
(13, 2, 24),
(14, 2, 33),
(15, 2, 34),
(16, 2, 35),
(17, 3, 17),
(18, 3, 21),
(19, 3, 23),
(20, 3, 25),
(21, 3, 24),
(22, 3, 33),
(23, 3, 34),
(24, 3, 35),
(25, 4, 19),
(26, 4, 18),
(27, 5, 11),
(28, 5, 19),
(29, 6, 15),
(86, 14, 15),
(87, 16, 15),
(88, 17, 15),
(90, 19, 15),
(91, 20, 15),
(92, 21, 15),
(93, 17, 11),
(94, 17, 20),
(95, 17, 19),
(96, 17, 18),
(97, 17, 17),
(98, 17, 16),
(99, 17, 14),
(100, 17, 13),
(101, 17, 12),
(102, 17, 21),
(103, 17, 36),
(104, 17, 22),
(105, 17, 23),
(106, 17, 32),
(108, 17, 31),
(110, 17, 29),
(111, 17, 28),
(112, 17, 27),
(113, 17, 25),
(114, 17, 24),
(115, 17, 33),
(116, 17, 34),
(117, 17, 35),
(118, 22, 11),
(119, 14, 18),
(120, 14, 16),
(121, 15, 19),
(122, 15, 17),
(123, 15, 15),
(124, 15, 13),
(125, 15, 21),
(126, 16, 23),
(127, 16, 30),
(128, 16, 26),
(129, 16, 28),
(130, 23, 11),
(131, 23, 19),
(132, 24, 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_groups`
--

CREATE TABLE `asp_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `mod_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-Normal;1-default-cannot delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `asp_groups`
--

INSERT INTO `asp_groups` (`id`, `title`, `mod_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'デフォルトグループ', 2, 1, '2018-12-11 11:35:21', '2018-12-11 11:35:21'),
(2, 'デフォルトグループ', 3, 1, '2018-12-11 11:36:01', '2018-12-11 11:36:01'),
(3, 'group 01', 2, 0, '2018-12-11 11:37:44', '2018-12-11 11:37:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_hire_logs`
--

CREATE TABLE `asp_hire_logs` (
  `id` int(11) NOT NULL,
  `asp_user_id` int(11) NOT NULL,
  `hire_id` int(11) NOT NULL,
  `is_printed` tinyint(4) NOT NULL DEFAULT '0',
  `is_send` tinyint(1) NOT NULL DEFAULT '0',
  `favorite` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `asp_hire_logs`
--

INSERT INTO `asp_hire_logs` (`id`, `asp_user_id`, `hire_id`, `is_printed`, `is_send`, `favorite`, `created_at`, `updated_at`) VALUES
(1, 4, 53, 1, 0, 0, '2018-12-11 18:43:51', '2018-12-11 18:43:51'),
(2, 4, 54, 1, 0, 0, '2018-12-11 18:43:51', '2018-12-11 18:43:51'),
(3, 4, 55, 1, 0, 1, '2018-12-11 18:43:51', '2018-12-11 18:45:33'),
(4, 4, 52, 0, 0, 1, '2018-12-11 18:45:34', '2018-12-11 18:45:34'),
(5, 1, 37, 1, 0, 0, '2018-12-12 13:15:01', '2018-12-12 13:15:01'),
(6, 1, 38, 1, 1, 0, '2018-12-12 13:15:01', '2018-12-13 16:36:55'),
(7, 1, 39, 1, 0, 0, '2018-12-12 13:15:01', '2018-12-12 13:15:01'),
(8, 1, 41, 1, 0, 1, '2018-12-12 13:15:01', '2018-12-13 04:20:55'),
(9, 1, 44, 1, 0, 0, '2018-12-12 13:15:01', '2018-12-12 13:15:01'),
(10, 1, 50, 1, 0, 0, '2018-12-12 13:15:01', '2018-12-12 13:15:01'),
(11, 1, 52, 1, 0, 1, '2018-12-12 13:15:01', '2018-12-13 04:14:50'),
(12, 1, 53, 1, 0, 1, '2018-12-12 13:15:01', '2018-12-13 04:15:14'),
(13, 1, 54, 1, 0, 0, '2018-12-12 13:15:01', '2018-12-12 13:15:01'),
(14, 1, 55, 1, 0, 1, '2018-12-12 13:15:01', '2018-12-13 04:05:04'),
(15, 1, 48, 1, 0, 0, '2018-12-13 13:18:36', '2018-12-13 13:18:36'),
(16, 1, 51, 1, 0, 0, '2018-12-13 13:18:36', '2018-12-13 13:18:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_hire_messages`
--

CREATE TABLE `asp_hire_messages` (
  `id` int(11) NOT NULL,
  `asp_client_log_id` int(11) NOT NULL,
  `hire_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_invations`
--

CREATE TABLE `asp_invations` (
  `id` int(11) NOT NULL,
  `asp_user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `asp_invations`
--

INSERT INTO `asp_invations` (`id`, `asp_user_id`, `title`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin invite', 'Hi!', '2018-12-11 18:34:20', '2018-12-11 18:34:20'),
(2, 2, 'mode invite', 'HI!', '2018-12-11 18:37:19', '2018-12-11 18:37:19'),
(3, 4, 'member 01 invite', 'Hi!', '2018-12-11 18:41:14', '2018-12-11 18:41:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_password_resets`
--

CREATE TABLE `asp_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_policy_logs`
--

CREATE TABLE `asp_policy_logs` (
  `id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  `asp_user_id` int(11) NOT NULL,
  `favorite` tinyint(1) NOT NULL DEFAULT '0',
  `is_send` tinyint(1) NOT NULL DEFAULT '0',
  `is_print` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `asp_policy_logs`
--

INSERT INTO `asp_policy_logs` (`id`, `policy_id`, `asp_user_id`, `favorite`, `is_send`, `is_print`, `created_at`) VALUES
(1, 2701, 4, 1, 0, 0, '2018-12-11 18:44:47'),
(2, 2677, 4, 1, 0, 0, '2018-12-11 18:44:48'),
(3, 2220, 4, 1, 0, 0, '2018-12-12 12:59:26'),
(4, 2197, 4, 1, 0, 0, '2018-12-12 12:59:28'),
(5, 1829, 4, 1, 0, 0, '2018-12-12 12:59:42'),
(6, 2700, 2, 1, 0, 0, '2018-12-12 13:26:35'),
(7, 159, 1, 0, 0, 0, '2018-12-13 00:05:19'),
(8, 2701, 1, 0, 0, 0, '2018-12-13 00:12:49'),
(9, 17, 1, 1, 0, 0, '2018-12-13 00:10:46'),
(10, 1829, 1, 1, 0, 0, '2018-12-13 04:22:11'),
(11, 2505, 1, 1, 0, 0, '2018-12-13 00:50:13'),
(12, 2697, 1, 1, 0, 0, '2018-12-13 00:59:14'),
(13, 2694, 1, 1, 0, 0, '2018-12-13 00:59:16'),
(14, 2677, 1, 1, 0, 0, '2018-12-13 00:59:26'),
(15, 53, 1, 1, 0, 0, '2018-12-13 01:00:17'),
(16, 2373, 1, 1, 0, 0, '2018-12-13 03:04:43'),
(17, 280, 1, 1, 0, 0, '2018-12-13 03:47:17'),
(18, 2420, 1, 1, 0, 0, '2018-12-13 04:15:12'),
(19, 2672, 1, 1, 0, 0, '2018-12-13 04:21:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_signatures`
--

CREATE TABLE `asp_signatures` (
  `id` int(11) NOT NULL,
  `asp_user_id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `company` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `asp_signatures`
--

INSERT INTO `asp_signatures` (`id`, `asp_user_id`, `avatar`, `company`, `position`, `name`, `address_1`, `address_2`, `tel`, `fax`, `email`, `created_at`, `updated_at`) VALUES
(1, 4, '', 'member 01', 'fsfsfffvc', 'afaf', 'sfsf', 'sfsfsfvc', '092578123465', '02431321', 'member01@localhos.pc', '2018-12-11 11:43:32', '2018-12-11 11:43:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_users`
--

CREATE TABLE `asp_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `inviter_id` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `asp_users`
--

INSERT INTO `asp_users` (`id`, `first_name`, `last_name`, `avatar`, `email`, `account`, `password`, `role`, `inviter_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'asp', NULL, 'admin_asp@samurai.website', 'asp_admin', 'cb31c8805bb50c6053a100f628221ff2', 'admin', 0, 'YaLwDA6A69e0qbpeYWDmTMkuNkA4hjaRjSOwVUec8Bas3GHYMvYNiw64AdDY', '2018-12-10 17:00:00', '2018-12-10 17:00:00'),
(2, 'mod', '01', '', 'mod_01@localhost.pc', 'moderator_01', '25d55ad283aa400af464c76d713c07ad', 'mod', 1, '4fKa7GGbAz9Oz3mTj9rGuS1zkPBL9rmGVWTHuG5zxnjOrZt61qTGvskiJYqV', '2018-12-11 11:35:21', '2018-12-11 11:35:21'),
(3, 'mod', '02', '', '', 'moderator_02', '25d55ad283aa400af464c76d713c07ad', 'mod', 1, NULL, '2018-12-11 11:36:01', '2018-12-11 11:36:01'),
(4, 'mod01', 'member01', '', '', 'member_01', '25d55ad283aa400af464c76d713c07ad', 'member', 2, 'lpNg4HtnYRkZxiX4ABycEJQurjs2kJbPs23qeIJX31U9wkxu04if1fZ3OaHh', '2018-12-11 11:38:10', '2018-12-11 11:38:10'),
(5, 'mod01', 'manager01', '', '', 'manager_01', '25d55ad283aa400af464c76d713c07ad', 'member', 2, NULL, '2018-12-11 11:38:42', '2018-12-11 11:38:42'),
(6, 'mod01', 'member 2', '', '', 'member_02', '25d55ad283aa400af464c76d713c07ad', 'member', 2, NULL, '2018-12-11 11:39:23', '2018-12-12 04:06:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `asp_user_groups`
--

CREATE TABLE `asp_user_groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0' COMMENT '0-member;1-manager'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `asp_user_groups`
--

INSERT INTO `asp_user_groups` (`id`, `user_id`, `group_id`, `role`) VALUES
(1, 4, 1, 0),
(2, 5, 3, 1),
(3, 6, 3, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `asp_client_logs`
--
ALTER TABLE `asp_client_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asp_client_aspuser` (`asp_user_id`),
  ADD KEY `asp_client_log_userid` (`user_id`,`asp_user_id`) USING BTREE;

--
-- Chỉ mục cho bảng `asp_client_policy`
--
ALTER TABLE `asp_client_policy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aspclientpolicy_logs` (`asp_client_log_id`,`policy_id`,`type`,`created_at`) USING BTREE;

--
-- Chỉ mục cho bảng `asp_company`
--
ALTER TABLE `asp_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asp_company_province_id` (`province_id`),
  ADD KEY `asp_company_cityid` (`city_id`),
  ADD KEY `asp_company_aspuserid` (`asp_user_id`,`user_id`,`is_register`,`sended_at`) USING BTREE;

--
-- Chỉ mục cho bảng `asp_company_trades`
--
ALTER TABLE `asp_company_trades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asp_trades_companyid` (`company_id`),
  ADD KEY `asp_trades_tradeid` (`trade_id`);

--
-- Chỉ mục cho bảng `asp_groups`
--
ALTER TABLE `asp_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aspgroup_manageid` (`mod_id`,`type`);

--
-- Chỉ mục cho bảng `asp_hire_logs`
--
ALTER TABLE `asp_hire_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asphirelogs_aspuserid` (`asp_user_id`,`is_printed`) USING BTREE,
  ADD KEY `asphirelogs_hireid` (`hire_id`,`favorite`);

--
-- Chỉ mục cho bảng `asp_hire_messages`
--
ALTER TABLE `asp_hire_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asp_hire_message_client` (`asp_client_log_id`,`hire_id`);

--
-- Chỉ mục cho bảng `asp_invations`
--
ALTER TABLE `asp_invations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `asp_password_resets`
--
ALTER TABLE `asp_password_resets`
  ADD KEY `asp_password_reset_email` (`email`);

--
-- Chỉ mục cho bảng `asp_policy_logs`
--
ALTER TABLE `asp_policy_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asp_policy_policyid` (`policy_id`),
  ADD KEY `asp_policy_aspuser` (`asp_user_id`);

--
-- Chỉ mục cho bảng `asp_signatures`
--
ALTER TABLE `asp_signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aspsignature_userid` (`asp_user_id`);

--
-- Chỉ mục cho bảng `asp_users`
--
ALTER TABLE `asp_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asp_user_account_unique` (`account`),
  ADD KEY `asp_user_inviter_id` (`inviter_id`) USING BTREE,
  ADD KEY `asp_user_email` (`email`) USING BTREE;
ALTER TABLE `asp_users` ADD FULLTEXT KEY `asp_users_search_name` (`first_name`,`last_name`);

--
-- Chỉ mục cho bảng `asp_user_groups`
--
ALTER TABLE `asp_user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asp_user_group_userid` (`user_id`),
  ADD KEY `asp_user_group_groupid` (`group_id`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `asp_client_logs`
--
ALTER TABLE `asp_client_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `asp_client_policy`
--
ALTER TABLE `asp_client_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `asp_company`
--
ALTER TABLE `asp_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `asp_company_trades`
--
ALTER TABLE `asp_company_trades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT cho bảng `asp_groups`
--
ALTER TABLE `asp_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `asp_hire_logs`
--
ALTER TABLE `asp_hire_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `asp_hire_messages`
--
ALTER TABLE `asp_hire_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `asp_invations`
--
ALTER TABLE `asp_invations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `asp_policy_logs`
--
ALTER TABLE `asp_policy_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `asp_signatures`
--
ALTER TABLE `asp_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `asp_users`
--
ALTER TABLE `asp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `asp_user_groups`
--
ALTER TABLE `asp_user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
