-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 01, 2021 lúc 10:43 AM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `default`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `limited` int(11) NOT NULL,
  `required` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `shops`
--

INSERT INTO `shops` (`id`, `name`, `time`, `path`, `cost`, `profit`, `limited`, `required`) VALUES
(1, 'Mèo cấp 1', 1, 'images/shop/cat1.png', 85688, 14312, 1, '0'),
(2, 'Mèo cấp 2', 5, 'images/shop/cat2.png', 1000000, 10000, 100, '0'),
(3, 'Chó cấp 1', 5, 'images/shop/dog1.png', 5000000, 50000, 100, '0'),
(4, 'Chó cấp 2', 1, 'images/shop/dog2.png', 1200052, 50025, 2, '0'),
(5, 'Chim cấp 1', 1, 'images/shop/bird1.png', 1602006, 75110, 4, 'Chó cấp 2'),
(6, 'Chim cấp 2', 2, 'images/shop/bird2.png', 2500094, 100193, 3, '0'),
(7, 'Ngựa cấp 1', 3, 'images/shop/horse1.png', 3809049, 130099, 10, 'Chim cấp 2'),
(8, 'Ngựa cấp 2', 9, 'images/shop/horse2.png', 25098005, 1800250, 100, '0'),
(9, 'Rồng cấp 1', 12, 'images/shop/dragon1.png', 51000192, 2498800, 100, '0'),
(10, 'Rồng cấp 2', 15, 'images/shop/dragon2.png', 80502013, 4001032, 100, '0');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
