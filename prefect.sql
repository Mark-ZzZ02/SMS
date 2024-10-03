-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 08:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prefect`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` mediumint(9) NOT NULL,
  `popular` tinyint(4) NOT NULL,
  `image` varchar(150) NOT NULL,
  `case_id` varchar(50) NOT NULL,
  `assigned_staff` varchar(50) NOT NULL,
  `offense_id` varchar(50) NOT NULL,
  `case_status` varchar(50) NOT NULL,
  `date_reported` date NOT NULL,
  `investigation_notes` varchar(50) NOT NULL,
  `last_updated` varchar(50) NOT NULL,
  `next_action` varchar(50) NOT NULL,
  `case_priority` varchar(50) NOT NULL,
  `punishment_id` varchar(50) NOT NULL,
  `reported_by` varchar(50) NOT NULL,
  `date_of_offense` varchar(50) NOT NULL,
  `punishment_type` varchar(50) NOT NULL,
  `punishment_details` varchar(50) NOT NULL,
  `date_assigned` varchar(50) NOT NULL,
  `assigned_by` varchar(50) NOT NULL,
  `completion_status` varchar(50) NOT NULL,
  `completion_date` varchar(50) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `student_id`, `name`, `description`, `status`, `popular`, `image`, `case_id`, `assigned_staff`, `offense_id`, `case_status`, `date_reported`, `investigation_notes`, `last_updated`, `next_action`, `case_priority`, `punishment_id`, `reported_by`, `date_of_offense`, `punishment_type`, `punishment_details`, `date_assigned`, `assigned_by`, `completion_status`, `completion_date`, `date_added`) VALUES
(82, 332423423, 'ROSAS, DILAN R.', 'LALALALA', 0, 0, '', '123312', 'NORLAN', 'BULLY', '', '0000-00-00', 'LALALA', '0000-00-00', '', '', 'PUSHUP', '', '0000-00-00', 'BAHALA NA', 'LALAL', '2024-09-03', '', 'GAVYHVBA', '2024-10-16', '2024-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `ID` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `case_id` mediumint(9) NOT NULL,
  `offense_id` mediumint(9) NOT NULL,
  `case_status` mediumint(9) NOT NULL,
  `date_reported` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `investigation_notes` varchar(50) NOT NULL,
  `last_updated` datetime NOT NULL,
  `next_action` mediumint(9) NOT NULL,
  `assigned_staff` varchar(50) NOT NULL,
  `punishment_id` mediumint(9) NOT NULL,
  `reported_by` varchar(50) NOT NULL,
  `date_of_offense` datetime DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `case_priority` varchar(50) NOT NULL,
  `punishment_type` mediumint(9) NOT NULL,
  `punishment_details` varchar(50) NOT NULL,
  `date_assigned` timestamp NULL DEFAULT NULL,
  `assigned_by` varchar(50) NOT NULL,
  `completion_status` mediumint(9) NOT NULL,
  `completion_date` datetime DEFAULT NULL,
  `status` mediumint(9) NOT NULL,
  `popular` mediumint(9) NOT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`ID`, `student_id`, `name`, `case_id`, `offense_id`, `case_status`, `date_reported`, `investigation_notes`, `last_updated`, `next_action`, `assigned_staff`, `punishment_id`, `reported_by`, `date_of_offense`, `description`, `case_priority`, `punishment_type`, `punishment_details`, `date_assigned`, `assigned_by`, `completion_status`, `completion_date`, `status`, `popular`, `date_added`, `image`) VALUES
(5, 0, '', 0, 0, 0, 'current_timestamp()', '', '2024-10-01 13:37:59', 0, '', 0, '', NULL, 'asdasd', '', 0, '', NULL, '', 0, NULL, 0, 0, NULL, ''),
(6, 0, '', 0, 0, 0, 'current_timestamp()', '', '2024-10-01 17:05:19', 0, 'q', 0, '', NULL, '', '', 0, '', NULL, '', 0, NULL, 0, 0, NULL, ''),
(7, 0, 'ddasd', 0, 0, 0, 'current_timestamp()', '', '2024-10-01 17:13:49', 0, '', 0, '', NULL, '', '', 0, '', NULL, '', 0, NULL, 0, 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_as` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `create_at`, `role_as`) VALUES
(27, 'ygyg', 'ygyg@jajaja', '123', '2024-09-02 11:11:51', 1),
(29, 'admin', 'admin@gmail.com', '123', '2024-09-03 06:29:31', 1),
(35, 'sd', '', '', '2024-10-01 15:04:58', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
