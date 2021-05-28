-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-05-28 11:18:56
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `group_01`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `account` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `evaluate`
--

CREATE TABLE `evaluate` (
  `product` varchar(30) CHARACTER SET utf8 NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `evaluation` varchar(500) CHARACTER SET utf8 NOT NULL,
  `date` varchar(20) CHARACTER SET utf8 NOT NULL,
  `month` varchar(10) CHARACTER SET utf8 NOT NULL,
  `day` varchar(10) CHARACTER SET utf8 NOT NULL,
  `hours` varchar(5) CHARACTER SET utf8 NOT NULL,
  `minutes` varchar(5) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `account` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`account`, `password`, `email`) VALUES
('member', 'member123456', ''),
('admin', 'admin123456', '');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `money` varchar(50) CHARACTER SET utf8 NOT NULL,
  `about` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `shape` varchar(10) CHARACTER SET utf8 NOT NULL,
  `file_name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `name`, `money`, `about`, `type`, `shape`, `file_name`) VALUES
('product_01', 'K.moriyama', 'NT$4,990', 'KM1141T-1S', '鈦金屬', '方型', 'product_01.jpg'),
('product_02', 'AIR Ultem Classic', 'NT$4,490', 'AU2087W-1S', '樹脂 鈦金屬', '圓框款', 'product_02.jpg'),
('product_03', 'OWNDAYS SNAP', 'NT$3,490', 'SNP1013T-1S', '不鏽鋼', '圓框款', 'product_03.jpg'),
('product_04', 'OWNDAYS SNAP', 'NT$3,490', 'SNP1010N-1S', '不鏽鋼', '波士頓', 'product_04.jpg'),
('product_05', 'AIR For Men', 'NT$3,490', 'AR2032D-0A', '金屬 樹脂', '方型', 'product_05.jpg'),
('product_06', 'John Dillinger', 'NT$3,490', 'JD1033B-0A', '不鏽鋼', '波士頓', 'product_06.jpg'),
('product_07', 'Graph Belle', 'NT$3,490', 'GB1031B-1S', '鈦金屬', '圓框款', 'product_07.jpg'),
('product_08', 'OWNDAYS PC', 'NT$1,000', 'PC2005N-9A', '樹脂', '圓框款', 'product_08.jpg'),
('product_09', 'Memory Metal', 'NT$500', 'MM1010Le-B', '樹脂', '方型', 'product_09.jpg'),
('product_10', '鬼滅の刃', 'NT$5,990', 'KMTY2001Y-1S', '樹脂', '波士頓', 'product_10.jpg'),
('product_11', 'FUWA CELLU', 'NT$1,990', 'FC2015T-9S', '樹脂', '波士頓', 'product_11.jpg'),
('product_12', '+NICHE', 'NT$2,980', 'NC1024B-0S', '不鏽鋼', '圓框款', 'product_12.jpg'),
('product_13', 'AIR Ultem Classic', 'NT$4,490', 'AU2085W-1S', '樹脂 鈦金屬', '方型', 'product_13.jpg'),
('product_14', 'Junni', 'NT$3,490', 'JU1019G-1S', '鈦金屬 不鏽鋼', '方型', 'product_14.jpg'),
('product_15', 'FUWA CELLU', 'NT$2,490', 'FC2023S-0A', '樹脂', '波士頓', 'product_15.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
