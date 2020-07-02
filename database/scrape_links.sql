-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2018 lúc 11:32 AM
-- Phiên bản máy phục vụ: 10.1.35-MariaDB
-- Phiên bản PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `samurai_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `scrape_links`
--

CREATE TABLE `scrape_links` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `scrape_links`
--

INSERT INTO `scrape_links` (`id`, `name`, `url`) VALUES
(1, 'ミラサポ', 'https://map.mirasapo.jp/'),
(2, 'ミラサポ1', 'https://map.mirasapo.jp/area/342050/lists/'),
(3, 'ミラサポ2', 'https://map.mirasapo.jp/area/342084/lists/'),
(4, 'ミラサポ3', 'https://map.mirasapo.jp/area/343021/lists/'),
(5, 'ミラサポ4', 'https://map.mirasapo.jp/area/172014/lists/'),
(6, 'ミラサポ5', 'https://map.mirasapo.jp/area/172090/lists/'),
(7, 'ミラサポ6', 'https://map.mirasapo.jp/area/172111/lists/');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `scrape_links`
--
ALTER TABLE `scrape_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `scrape_links`
--
ALTER TABLE `scrape_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
