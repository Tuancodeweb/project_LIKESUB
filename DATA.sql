-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2017 at 11:37 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minh`
--

-- --------------------------------------------------------

--
-- Table structure for table `autocmt`
--

CREATE TABLE `autocmt` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `autolike`
--

CREATE TABLE `autolike` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ctv`
--

CREATE TABLE `ctv` (
  `id_ctvs` int(11) NOT NULL,
  `user_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bill` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rule` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `num_id` int(11) NOT NULL,
  `payment` int(11) NOT NULL DEFAULT '0',
  `id_agency` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `free`
--

CREATE TABLE `free` (
  `id` int(11) NOT NULL,
  `uid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_ctv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `billing` int(11) NOT NULL COMMENT 'VNĐ',
  `status` tinyint(4) NOT NULL,
  `id_ctv` int(11) NOT NULL,
  `id_use` int(11) NOT NULL,
  `uname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `rule` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `id_ctv` int(11) NOT NULL,
  `time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `content`, `id_ctv`, `time`, `type`) VALUES
(2372, '<b>admin</b> vừa thêm <b>1</b> Package <b>VIP Like</b>', 1, '1505978885', 0),
(2373, '<b>admin</b> vừa thêm <b>1</b> Package <b>VIP CMT</b>', 1, '1505978914', 0),
(2374, '<b>admin</b> vừa thêm <b>1</b> Package <b>VIP Reactions</b>', 1, '1505978920', 0),
(2375, '<b>admin</b> vừa thêm VIP REACTION cho ID <b>3</b>. Thời hạn <b>1</b> tháng, MAX <b>11</b> Reactions / Cron, tổng thanh toán <b>1 VNĐ </b>', 1, '1505978948', 0),
(2376, '<b>admin</b> vừa thêm <b>1</b> Package <b>VIP Share</b>', 1, '1505986554', 0);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_ctv` int(11) NOT NULL,
  `user_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bill` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rule` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `num_id` int(11) NOT NULL DEFAULT '0',
  `payment` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_ctv`, `user_name`, `password`, `name`, `phone`, `email`, `profile`, `bill`, `status`, `code`, `rule`, `num_id`, `payment`) VALUES
(1, 'admin', '78f762dc14e909ac2e1336b797948898', 'duy', '12345678', 'hoangvanduy9x@gmail.com', '4', '999', 1, '57f34bae', 'admin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `noti`
--

CREATE TABLE `noti` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `id_ctv` int(11) NOT NULL,
  `time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `content`) VALUES
(1, 'Khuyến Mại Nạp Tiền và Free Best Auto VIP Card Nhân Dịp Trung Thu 2017. Chi tiết xem tại phần Thanh toán (Nạp tiền)!');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `price` int(11) NOT NULL COMMENT 'VNĐ',
  `id_ctv` int(11) NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `max`, `price`, `id_ctv`, `type`) VALUES
(87, 100, 30000, 1, 'LIKE'),
(88, 111, 40000, 1, 'CMT'),
(89, 11, 35000, 1, 'REACTION'),
(90, 55, 25000, 1, 'SHARE');

-- --------------------------------------------------------

--
-- Table structure for table `token_share0`
--

CREATE TABLE `token_share0` (
  `id` int(11) NOT NULL,
  `page_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vip`
--

CREATE TABLE `vip` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `han` int(11) NOT NULL COMMENT 'tháng',
  `start` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `end` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `likes` int(11) NOT NULL,
  `max_like` int(11) NOT NULL,
  `pay` int(11) NOT NULL COMMENT 'VNĐ',
  `id_ctv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vipcmt`
--

CREATE TABLE `vipcmt` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `han` int(11) NOT NULL COMMENT 'tháng',
  `start` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `end` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cmts` int(11) NOT NULL,
  `max_cmt` int(11) NOT NULL,
  `pay` int(11) NOT NULL COMMENT 'VNĐ',
  `id_ctv` int(11) NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `hash_tag` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'null',
  `gender` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'both'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vipreaction`
--

CREATE TABLE `vipreaction` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `han` int(11) NOT NULL,
  `start` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `end` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `limit_react` int(11) NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pay` int(11) NOT NULL,
  `id_ctv` int(11) NOT NULL,
  `access_token` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vipreaction`
--

INSERT INTO `vipreaction` (`id`, `user_id`, `name`, `han`, `start`, `end`, `limit_react`, `type`, `pay`, `id_ctv`, `access_token`) VALUES
(12, '3', '345435', 1, '1505978948', '1508570948', 11, 'LOVE', 1, 1, '4543');

-- --------------------------------------------------------

--
-- Table structure for table `vipshare`
--

CREATE TABLE `vipshare` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `han` int(11) NOT NULL COMMENT 'Tháng',
  `start` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `end` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shares` int(11) NOT NULL,
  `max_share` int(11) NOT NULL,
  `pay` int(11) NOT NULL COMMENT 'VNĐ',
  `id_ctv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autocmt`
--
ALTER TABLE `autocmt`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `access_token` (`access_token`(333));

--
-- Indexes for table `autolike`
--
ALTER TABLE `autolike`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `access_token` (`access_token`(333)),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ctv`
--
ALTER TABLE `ctv`
  ADD PRIMARY KEY (`id_ctvs`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_agency` (`id_agency`),
  ADD KEY `id_agency_2` (`id_agency`);

--
-- Indexes for table `free`
--
ALTER TABLE `free`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ctv` (`id_ctv`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_ctv`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `noti`
--
ALTER TABLE `noti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ctv` (`id_ctv`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ctv` (`id_ctv`);

--
-- Indexes for table `token_share0`
--
ALTER TABLE `token_share0`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_id` (`page_id`),
  ADD KEY `access_token` (`access_token`(333));

--
-- Indexes for table `vip`
--
ALTER TABLE `vip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `end` (`end`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `likes` (`likes`),
  ADD KEY `max_like` (`max_like`),
  ADD KEY `id_ctv` (`id_ctv`);

--
-- Indexes for table `vipcmt`
--
ALTER TABLE `vipcmt`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `end` (`end`),
  ADD KEY `cmts` (`cmts`,`max_cmt`,`id_ctv`),
  ADD KEY `id_ctv` (`id_ctv`);

--
-- Indexes for table `vipreaction`
--
ALTER TABLE `vipreaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`end`,`limit_react`,`type`,`id_ctv`),
  ADD KEY `id_ctv` (`id_ctv`);

--
-- Indexes for table `vipshare`
--
ALTER TABLE `vipshare`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `end` (`end`),
  ADD KEY `shares` (`shares`),
  ADD KEY `max_share` (`max_share`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autocmt`
--
ALTER TABLE `autocmt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3581;
--
-- AUTO_INCREMENT for table `autolike`
--
ALTER TABLE `autolike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16639;
--
-- AUTO_INCREMENT for table `ctv`
--
ALTER TABLE `ctv`
  MODIFY `id_ctvs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10088;
--
-- AUTO_INCREMENT for table `free`
--
ALTER TABLE `free`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;
--
-- AUTO_INCREMENT for table `gift`
--
ALTER TABLE `gift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2377;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_ctv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=432;
--
-- AUTO_INCREMENT for table `noti`
--
ALTER TABLE `noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `token_share0`
--
ALTER TABLE `token_share0`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6527;
--
-- AUTO_INCREMENT for table `vip`
--
ALTER TABLE `vip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;
--
-- AUTO_INCREMENT for table `vipcmt`
--
ALTER TABLE `vipcmt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vipreaction`
--
ALTER TABLE `vipreaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `vipshare`
--
ALTER TABLE `vipshare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
