-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 08:26 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hds`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `other_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `department_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `first_name`, `surname`, `other_name`, `gender`, `phone_number`, `department_id`, `role_id`) VALUES
(15, 'Umar', 'Aliyu', 'Mahdi', '', '080000000', 2, 1),
(20, 'Ahmad', 'Muhammad', 'Umar', 'Male', '08030303030', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`) VALUES
(1, 'ICT'),
(2, 'Help Desk'),
(3, 'MIS');

-- --------------------------------------------------------

--
-- Table structure for table `login_credentials`
--

CREATE TABLE `login_credentials` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `account_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_credentials`
--

INSERT INTO `login_credentials` (`id`, `username`, `password`, `account_type`) VALUES
(2, 'user', 'user', 'user'),
(7, 'some_user', 'user', 'user'),
(10, 'some_user3', 'user', 'user'),
(15, 'admin', 'admin', 'admin'),
(16, 'baffa', 'baffa', 'user'),
(20, 'ahmad', 'ahmad', 'support');

-- --------------------------------------------------------

--
-- Table structure for table `problem_categories`
--

CREATE TABLE `problem_categories` (
  `id` int(11) NOT NULL,
  `category_description` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `problem_categories`
--

INSERT INTO `problem_categories` (`id`, `category_description`) VALUES
(1, 'Duplicate Problem'),
(2, 'Hardware Problem'),
(3, 'Software Problem'),
(4, 'User Problem'),
(5, 'Unknown');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `ticket_title` varchar(100) NOT NULL,
  `ticket_description` varchar(1000) NOT NULL,
  `ticket_type` int(11) NOT NULL,
  `ticket_priority` int(11) NOT NULL,
  `ticket_status` int(11) NOT NULL,
  `problem_category` int(11) NOT NULL,
  `logged_by_id` int(11) DEFAULT NULL,
  `complainant_id` int(11) NOT NULL,
  `assignee_id` int(11) DEFAULT NULL,
  `date_logged` datetime NOT NULL,
  `date_assigned` datetime DEFAULT NULL,
  `date_resolved` datetime DEFAULT NULL,
  `date_closed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `code`, `ticket_title`, `ticket_description`, `ticket_type`, `ticket_priority`, `ticket_status`, `problem_category`, `logged_by_id`, `complainant_id`, `assignee_id`, `date_logged`, `date_assigned`, `date_resolved`, `date_closed`) VALUES
(8, 'TKT461UMR', 'mouse problem', 'mouse has stoped working since yesterday', 1, 1, 2, 2, NULL, 2, 20, '2021-12-28 13:39:16', NULL, NULL, NULL),
(9, 'TKT443VKH', 'testing', 'hope everything is good', 1, 3, 2, 3, NULL, 2, 20, '2022-01-01 03:17:39', NULL, NULL, NULL),
(25, 'TKT465CGZ', 'i have problem login into school portal', 'i cant remenber my password', 1, 2, 2, 3, NULL, 2, 20, '2022-01-17 06:34:07', NULL, NULL, NULL),
(26, 'TKT333DXF', 'problem', 'problrm', 1, 1, 2, 1, NULL, 2, 20, '2022-01-17 07:08:55', NULL, NULL, NULL),
(27, 'TKT976LRD', 'problem login into school portal', 'i tried the password i can remember but i still cant login into my portal', 1, 2, 2, 3, NULL, 2, 20, '2022-01-17 07:23:03', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_actions`
--

CREATE TABLE `ticket_actions` (
  `id` int(11) NOT NULL,
  `tIcket_id` int(11) NOT NULL,
  `input_date` datetime NOT NULL,
  `responded_by` int(11) DEFAULT NULL,
  `action_details` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_actions`
--

INSERT INTO `ticket_actions` (`id`, `tIcket_id`, `input_date`, `responded_by`, `action_details`) VALUES
(1, 9, '2022-01-10 09:52:07', 3, 'dasdd hope everything is good hope everything is good hope everything is good'),
(2, 9, '2022-01-10 09:59:07', 0, 'user response'),
(3, 9, '2022-01-10 14:31:50', 0, 'another response'),
(4, 9, '2022-01-10 14:33:47', 0, 'third response'),
(5, 9, '2022-01-10 16:44:49', 0, 'fourth response'),
(21, 7, '2022-01-10 20:51:55', 0, 'jhkbjhb'),
(22, 9, '2022-01-14 11:25:57', 0, 'jkgjh'),
(23, 25, '2022-01-17 06:38:13', 20, 'whats the last password you could remeber'),
(24, 25, '2022-01-17 06:39:10', 0, 'its my admission number'),
(25, 25, '2022-01-17 06:40:05', 20, 'okay... i reset the password to your admission number'),
(26, 25, '2022-01-17 06:56:31', 20, 'sdgfgxd'),
(27, 26, '2022-01-17 07:14:01', 20, 'erterfewrfd'),
(28, 26, '2022-01-17 07:14:12', 0, 'rvfvefcefc'),
(29, 26, '2022-01-17 07:14:29', 20, ' dsfc sdc s a'),
(30, 27, '2022-01-17 07:25:58', 20, 'whats the last password you could remember'),
(31, 27, '2022-01-17 07:26:52', 0, 'it my admission number'),
(32, 27, '2022-01-17 07:27:38', 20, 'okay, i reset the password to your admission number ');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_priorities`
--

CREATE TABLE `ticket_priorities` (
  `id` int(11) NOT NULL,
  `priority_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_priorities`
--

INSERT INTO `ticket_priorities` (`id`, `priority_description`) VALUES
(1, 'Low'),
(2, 'Inconvenient '),
(3, 'Critical');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_status`
--

CREATE TABLE `ticket_status` (
  `id` int(11) NOT NULL,
  `status_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_status`
--

INSERT INTO `ticket_status` (`id`, `status_description`) VALUES
(1, 'Authorised'),
(2, 'Complete'),
(3, 'In Progress'),
(4, 'Awaiting Closure'),
(5, 'Rejected'),
(6, 'Awaiting Authorisation');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_type`
--

CREATE TABLE `ticket_type` (
  `id` int(11) NOT NULL,
  `type_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_type`
--

INSERT INTO `ticket_type` (`id`, `type_description`) VALUES
(1, 'Support Request'),
(2, 'Inquiry ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `other_name` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `surname`, `other_name`, `gender`, `address`, `phone_number`, `email_address`, `image`) VALUES
(2, 'Mustapha', 'Usman', 'Umar', 'Male', 'Arkilla area, sokoto', '08030405', 'test@user.com', '61d46bb1576449.03849602.jpg'),
(7, 'Mustapha', 'zaidu', 'other', 'Male', 'weegdassdgfdc', '34343', 'zaid.jnr@gmail.com', '61d46bb1576449.03849602.jpg'),
(10, 'asasa', 'adsf', 'adgdvc', 'Male', 'awefsdzvc', '2345', 'zaid.jnr@gmail.com', '61d4731dd82e41.78810386.jpg'),
(16, 'usaman', 'faruku', 'Umar', 'Male', 'sdafass', '08030405', 'zaid.jnr@gmail.com', '61e3f7db452065.99286523.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_credentials`
--
ALTER TABLE `login_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem_categories`
--
ALTER TABLE `problem_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_actions`
--
ALTER TABLE `ticket_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_status`
--
ALTER TABLE `ticket_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_credentials`
--
ALTER TABLE `login_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `problem_categories`
--
ALTER TABLE `problem_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ticket_actions`
--
ALTER TABLE `ticket_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_status`
--
ALTER TABLE `ticket_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `administrators_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login_credentials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login_credentials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
