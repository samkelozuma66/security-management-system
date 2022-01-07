-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2022 at 09:21 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `armentum`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '9ae2be73b58b565bce3e47493a56e26a');

-- --------------------------------------------------------

--
-- Table structure for table `allocqation`
--

CREATE TABLE `allocqation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `site_id` int(11) NOT NULL,
  `current_cp` int(11) NOT NULL DEFAULT 0,
  `shift_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allocqation`
--

INSERT INTO `allocqation` (`id`, `user_id`, `note`, `date`, `site_id`, `current_cp`, `shift_id`) VALUES
(15, 20, 'Manager', '2022-01-06', 1, 0, 1),
(16, 21, 'First Guard', '2022-01-06', 1, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `checkpoint`
--

CREATE TABLE `checkpoint` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `site_id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkpoint`
--

INSERT INTO `checkpoint` (`id`, `code`, `description`, `status`, `site_id`, `image`) VALUES
(8, 'PINEMAIN', 'PINE COTTAGES MAIN CP', '1', 1, 'pinemain.png'),
(9, 'PINECP1', 'PINE COTTAGES CP 1', '1', 1, 'pinecp1.png'),
(10, 'PINECP2', 'PINE COTTAGES CP 2', '1', 1, 'pinecp2.png');

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
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `make` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `note` varchar(500) NOT NULL DEFAULT '',
  `type` enum('car','firearm','other') NOT NULL,
  `model` varchar(200) NOT NULL DEFAULT '',
  `license_no` varchar(200) NOT NULL DEFAULT '',
  `serial_no` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `make`, `description`, `note`, `type`, `model`, `license_no`, `serial_no`) VALUES
(1, 'Toyota', 'Enter text here...', 'Enter text here...', 'car', 'etois', 'ZZKMKA', 'sdsjjsdc'),
(2, 'VW', 'Enter text here...', 'Enter text here...', 'car', 'POLO', 'LLMKASKD', 'PLOSNANN');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_allocation`
--

CREATE TABLE `equipment_allocation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `equip_id` int(11) NOT NULL,
  `note` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment_allocation`
--

INSERT INTO `equipment_allocation` (`id`, `user_id`, `equip_id`, `note`, `date`) VALUES
(1, 20, 1, 'Enter text here...', '2022-01-03'),
(2, 21, 2, 'Enter text here...', '2022-01-03');

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

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `sender`, `reciver`, `title`, `feedbackdata`, `attachment`) VALUES
(19, 'samkelozuma66@gmail.com', 'Admin', 'Testing Feedback', 'Testing manager feedback', ' '),
(20, 'ash@walit.net', 'Admin', 'Testing Guard Feedback', 'Testing Guard Feedback', ' '),
(21, 'ash@walit.net', 'samkelozuma66@gmail.com', 'Testing Guard Feedback', 'Testing Guard Feedback', ' ');

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

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notiuser`, `notireciver`, `notitype`, `time`) VALUES
(18, 'samkelozuma66@gmail.com', 'Admin', 'Create Account', '2022-01-03 16:50:36'),
(19, 'ash@walit.net', 'Admin', 'Create Account', '2022-01-03 17:41:45'),
(20, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 14:41:25'),
(21, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-05 15:24:19'),
(22, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-05 15:25:39'),
(23, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 15:25:52'),
(24, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-05 15:32:03'),
(25, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 15:32:13'),
(26, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-05 15:59:50'),
(27, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 16:22:22'),
(28, 'samkelozuma66@gmail.com', 'Admin', 'Send Feedback', '2022-01-05 16:26:43'),
(29, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-05 16:27:21'),
(30, 'ash@walit.net', 'Admin', 'Send Feedback', '2022-01-05 16:27:42'),
(31, 'ash@walit.net', 'samkelozuma66@gmail.com', 'Send Feedback', '2022-01-05 16:27:42'),
(32, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 16:28:56'),
(33, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 16:40:55'),
(34, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 16:42:14'),
(35, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 16:43:14'),
(36, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 17:13:41'),
(37, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 19:43:00'),
(38, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 19:59:24'),
(39, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:01:37'),
(40, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:10:51'),
(41, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:26:38'),
(42, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:42:18'),
(43, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:44:42'),
(44, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:45:47'),
(45, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:46:42'),
(46, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:47:54'),
(47, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:48:51'),
(48, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:49:48'),
(49, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:50:35'),
(50, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-05 20:51:27'),
(51, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-05 20:55:33'),
(52, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:57:03'),
(53, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:58:12'),
(54, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 20:59:24'),
(55, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 21:01:51'),
(56, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-05 21:03:13'),
(57, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 21:04:28'),
(58, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 21:06:39'),
(59, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 21:07:48'),
(60, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 21:10:41'),
(61, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 21:15:00'),
(62, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-05 21:16:02'),
(63, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 21:18:24'),
(64, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-05 21:36:31'),
(65, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-05 21:47:06'),
(66, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 14:03:31'),
(67, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 14:07:13'),
(68, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-06 14:12:45'),
(69, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 14:14:19'),
(70, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 14:35:31'),
(71, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 14:38:05'),
(72, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-06 15:50:32'),
(73, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 17:22:52'),
(74, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 19:44:00'),
(75, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-06 19:44:44'),
(76, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-06 19:54:43'),
(77, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 20:08:37'),
(78, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 20:09:39'),
(79, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 20:53:28'),
(80, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 20:57:42'),
(81, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 21:14:22'),
(82, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 21:15:01'),
(83, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 21:19:24'),
(84, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 21:30:14'),
(85, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 21:36:02'),
(86, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 21:38:19'),
(87, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 21:38:58'),
(88, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 21:41:16'),
(89, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 21:47:34'),
(90, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-06 21:59:12'),
(91, 'ash@walit.net', 'Admin', 'Logged in', '2022-01-07 10:12:48'),
(92, 'samkelozuma66@gmail.com', 'Admin', 'Logged in', '2022-01-07 17:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `start_time` time NOT NULL DEFAULT current_timestamp(),
  `end_time` time NOT NULL DEFAULT current_timestamp(),
  `shift_type` enum('day','night') NOT NULL DEFAULT 'day'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `site_id`, `start_time`, `end_time`, `shift_type`) VALUES
(2, 1, '07:00:00', '18:00:00', 'day'),
(3, 1, '19:00:00', '06:00:00', 'night');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `site_name` varchar(200) NOT NULL,
  `manager_name` varchar(200) NOT NULL,
  `manager_email` varchar(100) NOT NULL,
  `passoword` varchar(100) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `site_address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `site_name`, `manager_name`, `manager_email`, `passoword`, `avatar`, `status`, `phonenumber`, `site_address`) VALUES
(1, 'Pine Cottages', 'Asheer Jaggessar', 'ash@walit.net', 'a34dfbef5668442567f72da5dfe506a0', 'dc_spotify.0.jpg', '1', '0680089701', '5 Horald Pl');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  `user_type` enum('guard','manager','admin') NOT NULL DEFAULT 'guard'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `mobile`, `designation`, `image`, `status`, `user_type`) VALUES
(20, 'Samkelo Enough Zuma', 'samkelozuma66@gmail.com', 'a34dfbef5668442567f72da5dfe506a0', 'Male', '0680089701', 'Guard', 'dc_spotify.0.jpg', 1, 'manager'),
(21, 'Asheer Jaggessar ', 'ash@walit.net', 'a34dfbef5668442567f72da5dfe506a0', 'Male', '0680089701', 'Guard', 'me.jpg', 1, 'guard');

-- --------------------------------------------------------

--
-- Table structure for table `user_checkpoint`
--

CREATE TABLE `user_checkpoint` (
  `id` int(11) NOT NULL,
  `allocqation_id` int(11) NOT NULL,
  `data` varchar(1000) NOT NULL COMMENT 'Format :\r\n[{cp_code:code,\r\n  data:[valuse * 12 ]}]\r\nExample :\r\n[{"cp_code":"medi1","data":["no", "yes", "no"]},{"cp_code":"medi2","data":["yes", "yes", "no"]}]',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_checkpoint`
--

INSERT INTO `user_checkpoint` (`id`, `allocqation_id`, `data`, `date`) VALUES
(9, 16, '[{\"cp_code\":\"PINEMAIN\",\"lastcheck\":3,\"data\":[\"yes\",\"yes\",\"yes\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\"]},{\"cp_code\":\"PINECP1\",\"lastcheck\":4,\"data\":[\"yes\",\"yes\",\"yes\",\"yes\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\"]},{\"cp_code\":\"PINECP2\",\"lastcheck\":3,\"data\":[\"yes\",\"yes\",\"yes\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\",\"no\"]}]', '2022-01-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allocqation`
--
ALTER TABLE `allocqation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkpoint`
--
ALTER TABLE `checkpoint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleteduser`
--
ALTER TABLE `deleteduser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_allocation`
--
ALTER TABLE `equipment_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_checkpoint`
--
ALTER TABLE `user_checkpoint`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allocqation`
--
ALTER TABLE `allocqation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `checkpoint`
--
ALTER TABLE `checkpoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deleteduser`
--
ALTER TABLE `deleteduser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equipment_allocation`
--
ALTER TABLE `equipment_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_checkpoint`
--
ALTER TABLE `user_checkpoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
