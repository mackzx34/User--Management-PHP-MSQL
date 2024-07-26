-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 03:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `job_titles`
--

CREATE TABLE `job_titles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_titles`
--

INSERT INTO `job_titles` (`id`, `title`) VALUES
(1, 'Software Engineer'),
(2, 'Data Scientist'),
(3, 'Product Manager'),
(4, 'UI/UX Designer'),
(5, 'DevOps Engineer'),
(6, 'QA Engineer'),
(7, 'System Administrator'),
(8, 'Database Administrator'),
(9, 'Project Manager'),
(10, 'Business Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`id`, `name`) VALUES
(1, 'Dar es Salaam Central'),
(2, 'Dar es Salaam North'),
(3, 'Dar es Salaam South'),
(4, 'Arusha City'),
(5, 'Mwanza City'),
(6, 'Dodoma City'),
(7, 'Mbeya City'),
(8, 'Kigoma Town'),
(9, 'Tanga City'),
(10, 'Zanzibar City');

-- --------------------------------------------------------

--
-- Table structure for table `regional_office`
--

CREATE TABLE `regional_office` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regional_office`
--

INSERT INTO `regional_office` (`id`, `name`) VALUES
(1, 'Arusha'),
(2, 'Dar es Salaam'),
(3, 'Dodoma'),
(4, 'Geita'),
(5, 'Kigoma'),
(6, 'Kilimanjaro'),
(7, 'Mwanza'),
(8, 'Tabora'),
(9, 'Tanga'),
(10, 'Mbeya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `job_title_id` int(11) DEFAULT NULL,
  `regional_office_id` int(11) DEFAULT NULL,
  `market_id` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `mname` text DEFAULT NULL,
  `surname` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `email`, `password`, `mobile`, `roleid`, `isActive`, `created_at`, `updated_at`, `job_title_id`, `regional_office_id`, `market_id`, `userid`, `sex`, `mname`, `surname`) VALUES
(7, 'Admin', 'admin', 'adminmadini@gmail.com', 'd47c41ca1ff2ef6943e8adae02b9006f2ce2d2bf', '0765492472', 1, 0, '2020-03-12 16:23:01', '2020-03-12 16:23:01', NULL, NULL, NULL, 0, NULL, NULL, NULL),
(22, 'Fatuma Jadizo', 'jady', 'fatumasaid78@gmail.com', '$2y$10$OmaWZFoVltOPXMAEBtPOzOKkwfMpXtmvyOJfMwlx7OCNAdUmLC/mu', '0694342049', 0, 0, '2024-07-25 19:32:16', '2024-07-25 19:32:16', 1, 1, 1, 0, NULL, NULL, NULL),
(23, 'Joseph Zacharia Roja', 'joe', 'josephroja99@gmail.com', '$2y$10$KhGBbyfsNG.ku8Adjn3jP.pH4nNv0uQHph3i8vnQT2ub.ntDuodO.', '07474793489', 1, 0, '2024-07-25 19:34:18', '2024-07-25 19:34:18', 2, 3, 6, 0, NULL, NULL, NULL),
(26, 'Dios Fiai Adam', 'bizo', 'dioniz@gmail.com', '$2y$10$/bC1pq1CrPuxAH6sNCxPW.rwTPI1KGb1znS.xErxIMw2MetwECmuG', '07474793489', 3, 0, '2024-07-25 20:04:46', '2024-07-25 20:04:46', 10, 7, 7, 0, NULL, NULL, NULL),
(2021, 'Boniphace Charlse  HD', 'charlse', 'charlseboniphace@gmail.com', '$2y$10$vLXsguqDx5G3tjqz7IQgSuI.ouL2dGR1Nd7G2IR2UB.WfI7wiTwHG', '0667574324', 3, 0, '2024-07-26 09:24:15', '2024-07-26 09:24:15', 7, 3, 6, 0, NULL, NULL, NULL),
(24001, 'Halima Said Juma ', 'halima', 'halima35@gmail.com', '$2y$10$yg2HrpE3hHK9qFRswpN4/ezAQfa.8bppIZhPUGg09xHL6FJVfuYqS', '0694342049', 3, 0, '2024-07-26 09:35:18', '2024-07-26 09:35:18', 5, 7, 5, 0, NULL, NULL, NULL),
(24002, 'Juma John Hassan', 'juma', 'jumajohn@gmail.com', '$2y$10$oNlHyPvajGbqOTfmuWcxm..qHfXNxxabaTI4bHS4u.AfvmiZErZGy', '0756746534', 3, 0, '2024-07-26 09:43:11', '2024-07-26 09:43:11', 5, 7, 4, 0, NULL, NULL, NULL),
(24003, 'Halima Jua Joseph', 'nsanyi', 'charlseboniphace@gmail.com', '$2y$10$eiunb3ZeNifkw/qXLscTIuENKTa.0Y5Ri9erOPlaB1fS2DYtJSTBS', '07474793489', 3, 0, '2024-07-26 11:59:05', '2024-07-26 11:59:05', 5, 6, 1, 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_titles`
--
ALTER TABLE `job_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regional_office`
--
ALTER TABLE `regional_office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_titles`
--
ALTER TABLE `job_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `regional_office`
--
ALTER TABLE `regional_office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'role_id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24004;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
