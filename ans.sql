-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2016 年 09 月 13 日 17:46
-- 伺服器版本: 5.6.16-1~exp1
-- PHP 版本： 5.5.38-3+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `game`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ans`
--

CREATE TABLE `ans` (
  `ans_id` varchar(11) NOT NULL,
  `ball_total` int(11) NOT NULL,
  `milk_location` varchar(5) NOT NULL,
  `1` varchar(5) NOT NULL,
  `2` varchar(5) NOT NULL,
  `3` varchar(5) NOT NULL,
  `4` varchar(5) NOT NULL,
  `5` varchar(5) NOT NULL,
  `6` varchar(5) NOT NULL,
  `7` varchar(5) NOT NULL,
  `8` varchar(5) NOT NULL,
  `9` varchar(5) NOT NULL,
  `10` varchar(5) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `ans`
--
ALTER TABLE `ans`
  ADD PRIMARY KEY (`ans_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
