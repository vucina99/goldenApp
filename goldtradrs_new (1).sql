-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 02, 2022 at 03:25 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goldtradrs_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `manager` tinyint(1) NOT NULL DEFAULT 0,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `manager`, `group_id`) VALUES
(1, 'admin2000', 'admin@user.com', '94c9ff07f78a9734047d6073b5421543', 0, 1),
(7, 'ajones', 'adam.jones@goldtradefx.com', '5d509b9384192e9e4c164e902b21f70b', 0, NULL),
(8, 'npetrov', 'nikola.petrov@goldtradefx.com', '0f006e4064fa0c4c1ff3d2b44f1a2104', 0, NULL),
(9, 'admin103', 'admin103@goldtradefx.com', '1955fec6968e7b1a944b0f19290e958d', 0, NULL),
(10, 'admin', 'admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commentarchive`
--

CREATE TABLE `commentarchive` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `reqcreate_datetime` datetime(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentarchive`
--

INSERT INTO `commentarchive` (`id`, `username`, `comment`, `reqcreate_datetime`) VALUES
(2, 'test', 'drugi komkomentar\r\n', '2022-04-09 14:25:41.000000'),
(136, 'test', 'treci po redu\r\n', '2022-06-04 15:35:05.000000');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment_subject_id` int(11) NOT NULL,
  `comment_status_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment_subject_id`, `comment_status_id`, `text`, `user_id`) VALUES
(1, 1, 2, 'vuk first', 297),
(2, 1, 1, 'vuk secound text idemo', 297),
(3, 1, 2, 'test', 0),
(4, 2, 2, 'asd', 270);

-- --------------------------------------------------------

--
-- Table structure for table `comment_status`
--

CREATE TABLE `comment_status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_status`
--

INSERT INTO `comment_status` (`id`, `status`) VALUES
(1, 'answered'),
(2, 'voicemail'),
(3, 'hang up'),
(4, 'call back high potential');

-- --------------------------------------------------------

--
-- Table structure for table `comment_subjects`
--

CREATE TABLE `comment_subjects` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_subjects`
--

INSERT INTO `comment_subjects` (`id`, `name`) VALUES
(1, 'First up'),
(2, 'Follow up'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `deleteduser`
--

CREATE TABLE `deleteduser` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `deltime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `depositarchive`
--

CREATE TABLE `depositarchive` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `card_number` varchar(50) NOT NULL,
  `card_holder` varchar(20) NOT NULL,
  `expdate` varchar(15) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `amount` varchar(15) NOT NULL,
  `reqcreate_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `depositarchive`
--

INSERT INTO `depositarchive` (`id`, `username`, `card_number`, `card_holder`, `expdate`, `cvv`, `amount`, `reqcreate_datetime`) VALUES
(37, 'test', '4233 5558 8855 5222 ', 'test user ', '', '', '2222', '2022-04-09 16:59:07'),
(39, 'test', '12312 ', 'tesss ', '', '', '245', '2022-04-18 11:39:53'),
(40, 'test', '287739028819 ', 'test deposit2 ', '', '', '1222', '2022-04-18 12:23:52'),
(41, 'test', '4233 5558 8855 5222 ', 'test deposit ', '', '', '1223', '2022-04-18 12:23:55'),
(42, 'test', '222 ', 'test deposit ', '', '', '222', '2022-04-18 12:23:58'),
(43, 'test', '222 ', 'test deposit ', '', '', '222', '2022-04-18 12:24:01'),
(44, 'test', '4233442233123 ', 'test deposit ', '', '', '12323', '2022-04-20 01:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `feedbackdata` varchar(500) NOT NULL,
  `attachment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Conversion'),
(2, 'Retension');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notiuser` varchar(50) NOT NULL,
  `notireciver` varchar(50) NOT NULL,
  `notitype` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reachout`
--

CREATE TABLE `reachout` (
  `id` int(11) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_phone` varchar(50) NOT NULL,
  `reqcreate_datetime` datetime(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `username`, `email`, `password`) VALUES
(1, 'superAdmin2000', '', '17c4520f6cfd1ab53d8745e84681eb49'),
(2, 'carMarAdmin2000', '', '50eb85fc2355d513cff8e31b8e7e2d08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name_surname` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `create_datetime` datetime DEFAULT NULL,
  `postal_code` varchar(25) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `phone_number` varchar(17) DEFAULT NULL,
  `bank_name` text DEFAULT NULL,
  `acc_number` text DEFAULT NULL,
  `account_balance` varchar(50) DEFAULT '250',
  `brand` varchar(20) DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `grupa` varchar(15) DEFAULT NULL,
  `withdrawtype` int(5) DEFAULT NULL,
  `deposittype` int(5) DEFAULT NULL,
  `notify` varchar(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `token` varchar(25) DEFAULT NULL,
  `CountryPrefix` int(11) DEFAULT NULL,
  `CountryCode` varchar(255) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CampaignID` int(11) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `MarketingInfo` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `login` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `name_surname`, `password`, `create_datetime`, `postal_code`, `country`, `phone_number`, `bank_name`, `acc_number`, `account_balance`, `brand`, `status`, `grupa`, `withdrawtype`, `deposittype`, `notify`, `comment`, `token`, `CountryPrefix`, `CountryCode`, `UserID`, `CampaignID`, `ProductName`, `MarketingInfo`, `admin_id`, `login`) VALUES
(270, 'test', 'test@user.com', 'test user', '17c4520f6cfd1ab53d8745e84681eb49', '2022-04-07 20:54:00', '885557777222', 'Armenia', '44455777', 'testbank123', '6662228888', '258', NULL, 3, 'ajones', 0, 0, '', 'treci po redu\r\n', '', NULL, NULL, NULL, NULL, NULL, NULL, 8, 0),
(286, 'john', 'john.doe@gmail.com', 'doe', NULL, NULL, NULL, NULL, '658334456', NULL, NULL, '250', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 7, 'RU', 103, 1007, 'funprodct', 'funmarketinginfo', NULL, 0),
(287, 'vuk', 'vukzdravkovic@gmail.com', 'zdrav', NULL, NULL, NULL, NULL, '56935235', NULL, NULL, '250', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'SR', 104, 2007, 'test', 'test', 8, 0),
(288, 'john', 'john.doe@gmail.com', 'doe', NULL, NULL, '', '', '658334456', NULL, NULL, '250', NULL, 7, NULL, NULL, NULL, NULL, 'test test', NULL, 7, 'RU', 103, 1007, 'funprodct', 'funmarketinginfo', 8, 0),
(289, 'vuk', 'vukzdravkovic@gmail.com', 'zdrav', NULL, NULL, NULL, NULL, '56935235', NULL, NULL, '250', NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'SR', 104, 2007, 'test', 'test', 8, 0),
(290, 'john', 'john.doe@gmail.com', 'doe', NULL, NULL, NULL, NULL, '658334456', NULL, NULL, '250', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 7, 'RU', 103, 1007, 'funprodct', 'funmarketinginfo', 8, 0),
(291, 'vuk', 'vukzdravkovic@gmail.com', 'zdrav', NULL, NULL, NULL, NULL, '56935235', NULL, NULL, '250', NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'SR', 104, 2007, 'test', 'test', 1, 0),
(292, 'john', 'john.doe@gmail.com', 'doe', NULL, NULL, NULL, NULL, '658334456', NULL, NULL, '250', NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, 7, 'RU', 103, 1007, 'funprodct', 'funmarketinginfo', 1, 0),
(293, 'vuk', 'vukzdravkovic@gmail.com', 'zdrav', NULL, NULL, NULL, NULL, '56935235', NULL, NULL, '250', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'SR', 104, 2007, 'test', 'test', 1, 0),
(294, 'Vuk', 'admintest@gmail.com', 'Vucina', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, '250', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0),
(295, 'Vuk', 'admintest@gmail.com', 'Vucina', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, '250', NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0),
(296, 'Vuk', 'admintest@gmail.com', 'Vucina', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, '250', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0),
(297, 'dzoni', 'dzoni@gmail.com', 'dzoni 123', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, NULL, NULL, NULL, '250', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`id`, `name`) VALUES
(1, 'New'),
(2, 'Not interested'),
(3, 'Call back'),
(4, 'Wrong number'),
(5, 'No neglish'),
(6, 'Not Available (N/A)'),
(7, 'Not in service (NIS)'),
(8, 'High potential');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int(255) NOT NULL,
  `username` varchar(15) NOT NULL,
  `card_holder` varchar(50) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `reqcreate_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`id`, `username`, `card_holder`, `amount`, `reqcreate_datetime`) VALUES
(74, 'test@mail.com', 'Test User', '54365', '2022-04-23 04:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawarchive`
--

CREATE TABLE `withdrawarchive` (
  `id` int(255) NOT NULL,
  `username` varchar(15) NOT NULL,
  `card_holder` varchar(50) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `reqcreate_datetime` datetime NOT NULL,
  `notify` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdrawarchive`
--

INSERT INTO `withdrawarchive` (`id`, `username`, `card_holder`, `amount`, `reqcreate_datetime`, `notify`) VALUES
(63, 'test ', 'test user ', '258', '2022-04-09 17:02:50', 0),
(64, 'test ', 'test user 123 ', '55555', '2022-04-20 01:42:40', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `commentarchive`
--
ALTER TABLE `commentarchive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_status`
--
ALTER TABLE `comment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_subjects`
--
ALTER TABLE `comment_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleteduser`
--
ALTER TABLE `deleteduser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depositarchive`
--
ALTER TABLE `depositarchive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reachout`
--
ALTER TABLE `reachout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawtype` (`withdrawtype`),
  ADD KEY `deposittype` (`deposittype`),
  ADD KEY `username` (`username`),
  ADD KEY `grupa` (`grupa`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `withdrawarchive`
--
ALTER TABLE `withdrawarchive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `notify` (`notify`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `commentarchive`
--
ALTER TABLE `commentarchive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment_status`
--
ALTER TABLE `comment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment_subjects`
--
ALTER TABLE `comment_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deleteduser`
--
ALTER TABLE `deleteduser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `depositarchive`
--
ALTER TABLE `depositarchive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reachout`
--
ALTER TABLE `reachout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
