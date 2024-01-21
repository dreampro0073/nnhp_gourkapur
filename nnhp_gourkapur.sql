-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 21, 2024 at 03:29 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nnhp_gourkapur`
--

-- --------------------------------------------------------

--
-- Table structure for table `double_beds`
--

CREATE TABLE `double_beds` (
  `id` int(11) NOT NULL,
  `e_no` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `double_beds`
--

INSERT INTO `double_beds` (`id`, `e_no`, `status`) VALUES
(1, '1', 1),
(2, '2', 0),
(3, '3', 0),
(4, '4', 1),
(5, '5', 0),
(6, '6', 0),
(7, '7', 0),
(8, '8', 0),
(9, '9', 0),
(10, '10', 0),
(11, '11', 0),
(12, '12', 0),
(13, '13', 0),
(14, '14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1> Pods, 2> Sigle Cabin, 3 > Double Bed',
  `e_ids` varchar(55) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `pnr_uid` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `train_no` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `nos` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `shift` varchar(10) DEFAULT NULL,
  `hours_occ` int(11) NOT NULL DEFAULT '0',
  `paid_amount` varchar(20) DEFAULT NULL,
  `penality` int(11) DEFAULT NULL,
  `pay_type` tinyint(1) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `delete_by` int(11) NOT NULL DEFAULT '0',
  `delete_time` timestamp NULL DEFAULT NULL,
  `checkout_status` tinyint(1) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `user_session_id` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `unique_id`, `type`, `e_ids`, `name`, `pnr_uid`, `mobile_no`, `train_no`, `address`, `nos`, `date`, `check_in`, `check_out`, `shift`, `hours_occ`, `paid_amount`, `penality`, `pay_type`, `remarks`, `status`, `deleted`, `delete_by`, `delete_time`, `checkout_status`, `added_by`, `user_session_id`, `updated_at`, `created_at`) VALUES
(1, 1705844193, 1, '1,3,4', 'Dipanshu', 'UK898989', '7351334717', NULL, NULL, NULL, '2024-01-21', '19:06:00', '19:06:00', 'B', 24, '2397', NULL, 2, 'Demo', 0, 0, 0, NULL, 0, 13, '1705844143', '2024-01-21 13:37:09', '2024-01-21 13:36:33'),
(2, 1705845552, 1, '11,8', 'DIpanshu', '898989', '909090', NULL, NULL, NULL, '2024-01-21', '19:29:12', '01:29:12', 'B', 6, '598', NULL, 2, NULL, 0, 0, 0, NULL, 0, 13, '1705844143', '2024-01-21 13:59:12', '2024-01-21 13:59:12'),
(3, 1705846618, 1, '2,6', 'ghghgh', '8989', '77878', NULL, NULL, NULL, '2024-01-21', '19:46:58', '19:46:58', 'B', 24, '1598', NULL, 1, 'gg', 0, 0, 0, NULL, 0, 13, '1705844143', '2024-01-21 14:16:58', '2024-01-21 14:16:58'),
(5, 1705846840, 2, '1,3', 'dfdfd', '89898', '6767', NULL, NULL, NULL, '2024-01-21', '19:50:40', '07:50:40', 'B', 12, '1198', NULL, 2, 'fgfgfg', 0, 0, 0, NULL, 0, 13, '1705844143', '2024-01-21 14:20:40', '2024-01-21 14:20:40'),
(6, 1705846881, 3, '1,4', 'DIpanshu', '1212', '99090', NULL, NULL, NULL, '2024-01-21', '19:51:21', '01:51:21', 'B', 6, '1198', NULL, 1, 'asas', 0, 0, 0, NULL, 0, 13, '1705844143', '2024-01-21 14:21:21', '2024-01-21 14:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) DEFAULT NULL,
  `penalty_amount` varchar(10) DEFAULT NULL,
  `pay_type` tinyint(2) DEFAULT NULL,
  `shift` varchar(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `current_time` time DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `user_session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pods`
--

CREATE TABLE `pods` (
  `id` int(11) NOT NULL,
  `e_no` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pods`
--

INSERT INTO `pods` (`id`, `e_no`, `status`) VALUES
(1, '1', 1),
(2, '2', 1),
(3, '3', 1),
(4, '4', 1),
(5, '5', 0),
(6, '6', 1),
(7, '7', 0),
(8, '8', 1),
(9, '9', 0),
(10, '10', 0),
(11, '11', 1),
(12, '12', 0),
(13, '13', 0),
(14, '14', 0),
(15, '15', 0),
(16, '16', 0),
(17, '17', 0),
(18, '18', 0),
(19, '19', 0),
(20, '20', 0),
(21, '21', 0),
(22, '22', 0),
(23, '23', 0),
(24, '24', 0),
(25, '25', 0),
(26, '26', 0),
(27, '27', 0),
(28, '28', 0),
(29, '29', 0),
(30, '30', 0),
(31, '31', 0),
(32, '32', 0),
(33, '33', 0),
(34, '34', 0),
(35, '35', 0),
(36, '36', 0),
(37, '37', 0),
(38, '38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `single_cabins`
--

CREATE TABLE `single_cabins` (
  `id` int(11) NOT NULL,
  `e_no` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `single_cabins`
--

INSERT INTO `single_cabins` (`id`, `e_no`, `status`) VALUES
(1, '1', 1),
(2, '2', 0),
(3, '3', 1),
(4, '4', 0),
(5, '5', 0),
(6, '6', 0),
(7, '7', 0),
(8, '8', 0),
(9, '9', 0),
(10, '10', 0),
(11, '11', 0),
(12, '12', 0),
(13, '13', 0),
(14, '14', 0),
(15, '15', 0),
(16, '16', 0),
(17, '17', 0),
(18, '18', 0),
(19, '19', 0),
(20, '20', 0),
(21, '21', 0),
(22, '22', 0),
(23, '23', 0),
(24, '24', 0),
(25, '25', 0),
(26, '26', 0),
(27, '27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `enc_id` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `address` text,
  `password` varchar(200) NOT NULL,
  `password_check` text NOT NULL,
  `profile_pic` varchar(500) DEFAULT NULL,
  `priv` int(11) DEFAULT NULL,
  `active` int(2) DEFAULT NULL,
  `remember_token` text,
  `api_token` varchar(300) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `enc_id`, `session_id`, `name`, `email`, `mobile`, `address`, `password`, `password_check`, `profile_pic`, `priv`, `active`, `remember_token`, `api_token`, `last_login`, `updated_at`, `created_at`) VALUES
(1, '0011', NULL, 'Admin', 'admin', '343434343', 'ss', '$2y$10$m6OJfIAp11mqieShJG1X9uu.LuyNLR4o./TKk5iHse3eCXYnGMfoi', 'dipanshu@135', '', 1, 0, '2Gbv4XV87fw6eFJMWKGF5FDLxpgZf1xFUDDC6CJoraR79plUNozbA24NKnCs', '$2y$10$AqNLf6dmiAbUrs71HfIV0.7Qk/rCZsi6mRbtUJuwELDLsBYFItlYW', '2019-09-24 13:30:29', '2024-01-20 07:22:51', NULL),
(13, '0011', '1705844143', 'Admin', 'dipanshu', '343434343', 'ss', '$2y$10$m6OJfIAp11mqieShJG1X9uu.LuyNLR4o./TKk5iHse3eCXYnGMfoi', 'dipanshu@135', '', 2, 0, '0se3brJeLUkhHWi3r8TBU85Wyjr4jDOxjqrl0FDj7jTsCRVyv00i8Mphcycf', '$2y$10$AqNLf6dmiAbUrs71HfIV0.7Qk/rCZsi6mRbtUJuwELDLsBYFItlYW', '2019-09-24 13:30:29', '2024-01-21 13:35:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `session_id`, `created_at`) VALUES
(1, 13, '1705844143', '2024-01-21 13:35:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `double_beds`
--
ALTER TABLE `double_beds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalties`
--
ALTER TABLE `penalties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pods`
--
ALTER TABLE `pods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `single_cabins`
--
ALTER TABLE `single_cabins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users` ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `double_beds`
--
ALTER TABLE `double_beds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pods`
--
ALTER TABLE `pods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `single_cabins`
--
ALTER TABLE `single_cabins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
