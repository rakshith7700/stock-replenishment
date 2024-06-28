-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 12:11 PM
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
-- Database: `stock_replinishment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_mail` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `create_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_mail`, `admin_pass`, `status`, `create_date_time`) VALUES
(1, 'rakshith@gmail.com', 'rakshith123', '1', '2024-05-14 06:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `all_plants`
--

CREATE TABLE `all_plants` (
  `plant_id` int(11) NOT NULL,
  `plant_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `roles` varchar(255) NOT NULL,
  `colours` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`colours`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_plants`
--

INSERT INTO `all_plants` (`plant_id`, `plant_name`, `status`, `roles`, `colours`) VALUES
(1, 'Reliance groups', '1', '', '{\"loaded\":\"#3BFC2E66\",\"empty\":\"#EF2B2B8C\"}'),
(2, 'tata', '1', '', '{\"loaded\":\"#3BFC2E66\",\"empty\":\"#EF2B2B8C\",\"Hold\":\"#EB0A0A\"}');

-- --------------------------------------------------------

--
-- Table structure for table `lines_table`
--

CREATE TABLE `lines_table` (
  `line_id` int(11) NOT NULL,
  `line_name` varchar(255) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lines_table`
--

INSERT INTO `lines_table` (`line_id`, `line_name`, `plant_id`, `status`) VALUES
(1, 'relainace', 1, '1'),
(2, 'ram krishna', 1, '1'),
(5, 'tata line', 2, '1'),
(8, 'akhil', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `machine_id` int(11) NOT NULL,
  `machine_name` varchar(255) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `line_id` int(11) NOT NULL DEFAULT 0,
  `plant_id` int(11) NOT NULL,
  `fill_status` varchar(255) NOT NULL DEFAULT 'null',
  `fiill_color` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `create_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`machine_id`, `machine_name`, `part_number`, `part_name`, `line_id`, `plant_id`, `fill_status`, `fiill_color`, `status`, `create_date_time`) VALUES
(1, 'rakshith', 'ferer', 'rrr', 2, 1, 'null', '', '0', '2024-06-14 11:05:02'),
(2, 'efve', '', '', 2, 1, 'empty', '#EF2B2B8C', '1', '2024-06-26 06:44:02'),
(3, 'feefvv', 'PO12nu', 'HSGYBSH', 1, 1, 'null', '', '0', '2024-06-27 05:36:27'),
(4, 'fevfe', '', '', 1, 1, 'null', '', '0', '2024-06-14 11:05:02'),
(5, '123123', '', '', 5, 2, 'loaded', '#3BFC2E66', '1', '2024-06-27 16:18:16'),
(6, 'ifdnsc', '', '', 5, 2, 'empty', '#EF2B2B8C', '1', '2024-06-27 16:18:20'),
(7, 'pamu', 'wqdw', 'dwewew', 5, 2, 'loaded', '#3BFC2E66', '1', '2024-06-24 10:15:15'),
(8, '3fr4rf', '', '', 5, 2, 'empty', '#EF2B2B8C', '1', '2024-06-27 16:18:27'),
(9, 'ferfrtg4trg', '', '', 1, 1, 'empty', '#EF2B2B8C', '1', '2024-06-28 09:47:48'),
(10, '3rf4rg4g45ggvt4y', '', '', 1, 1, 'empty', '#EF2B2B8C', '1', '2024-06-28 09:47:46'),
(11, 'dcwdferc', '', '', 1, 1, 'loaded', '#3BFC2E66', '1', '2024-06-28 09:47:44'),
(12, 'eefvrvrtv', '', '', 5, 2, 'empty', '#EF2B2B8C', '1', '2024-06-27 16:18:30'),
(13, '1234234', '', '', 5, 2, 'loaded', '#3BFC2E66', '1', '2024-06-27 16:18:32'),
(14, '4brhjfbhj4trgbj4tb', '', '', 1, 1, 'loaded', '#3BFC2E66', '0', '2024-06-25 09:54:27'),
(15, 'hf4rg4gt', '', '', 1, 1, 'empty', '#EF2B2B8C', '0', '2024-06-25 09:49:38'),
(16, 'evrvrtbt4vvvvvvvvv', '', '', 1, 1, 'empty', '#EF2B2B8C', '0', '2024-06-25 09:50:34'),
(17, 'mnbv', '', '', 1, 1, 'empty', '#EF2B2B8C', '0', '2024-06-25 09:52:50'),
(18, 'fghjkhgjv', '', '', 1, 1, 'empty', '#EF2B2B8C', '0', '2024-06-25 09:54:25'),
(19, 'iuiuiojpjmklmk', '', '', 1, 1, 'loaded', '#3BFC2E66', '0', '2024-06-25 09:55:24'),
(20, 'bjnikj', '', '', 5, 1, 'loaded', '#3BFC2E66', '1', '2024-06-27 11:37:47'),
(21, 'bnnbhjhh', '', '', 5, 1, 'loaded', '#3BFC2E66', '1', '2024-06-27 11:37:47'),
(22, 'fhgfhfhh', '', '', 0, 1, 'loaded', '#3BFC2E66', '1', '2024-06-27 11:38:40'),
(23, '12345ydfg', '', '', 0, 1, 'loaded', '#3BFC2E66', '1', '2024-06-27 11:38:36'),
(24, 'grthrth', '', '', 0, 1, 'loaded', '#3BFC2E66', '1', '2024-06-27 11:38:38'),
(25, 'casdca', '', '', 0, 1, 'loaded', '#3BFC2E66', '1', '2024-06-27 11:38:52'),
(26, 'rakshith', '', '', 8, 1, 'empty', '#EF2B2B8C', '1', '2024-06-27 16:19:57'),
(27, 'asdfghjkl', '', '', 1, 1, 'null', '', '0', '2024-06-25 09:54:20'),
(28, 'nnn', '', '', 1, 1, 'loaded', '#3BFC2E66', '1', '2024-06-27 10:30:06'),
(29, 'asss', '', '', 5, 2, 'null', '', '1', '2024-06-27 16:18:37'),
(30, '345', '', '', 5, 2, 'null', '', '1', '2024-06-27 16:18:41'),
(31, 'amma', '', '', 1, 1, 'loaded', '#3BFC2E66', '1', '2024-06-28 09:47:50'),
(32, 'rahul', '', '', 1, 1, 'empty', '#EF2B2B8C', '1', '2024-06-28 09:47:55'),
(33, 'pallu', '', '', 5, 2, 'null', '', '1', '2024-06-26 10:43:18'),
(34, 'qwerty', '', '', 5, 2, 'null', '', '1', '2024-06-26 10:43:18'),
(35, 'zumma', '', '', 5, 2, 'null', '', '1', '2024-06-27 16:18:47'),
(36, 'kabir', '', '', 5, 2, 'null', '', '1', '2024-06-26 10:43:18'),
(37, 'ammananna', '', '', 2, 1, 'null', '', '1', '2024-06-26 11:14:55'),
(38, 'vulcan techs', '', '', 1, 1, 'empty', '#EF2B2B8C', '1', '2024-06-28 09:47:53'),
(39, 'dsfghfgh', '', '', 1, 1, 'null', '', '1', '2024-06-27 12:12:05'),
(40, 'ramana', '', '', 0, 1, 'null', '', '1', '2024-06-27 16:12:57'),
(41, 'bokka', '', '', 5, 2, 'null', '', '1', '2024-06-27 16:21:06'),
(42, 'ronaldo', '', '', 8, 1, 'null', '', '1', '2024-06-28 09:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `r_id` int(11) NOT NULL,
  `role_name` varchar(256) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `checkbox` set('dash-board','part-assignment','lines','machines','access') NOT NULL,
  `dash_board` enum('read-only','read-write') NOT NULL DEFAULT 'read-only',
  `part_assignment` enum('read-only','read-write') NOT NULL DEFAULT 'read-only',
  `line` enum('read-only','read-write') NOT NULL DEFAULT 'read-only',
  `machines` enum('read-only','read-write') NOT NULL DEFAULT 'read-only',
  `access` enum('read-only','read-write') NOT NULL DEFAULT 'read-only',
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`r_id`, `role_name`, `plant_id`, `checkbox`, `dash_board`, `part_assignment`, `line`, `machines`, `access`, `status`) VALUES
(1, 'line manager', 1, 'dash-board,part-assignment,lines,machines', 'read-only', 'read-only', 'read-only', 'read-only', 'read-only', '1'),
(2, 'mixing manager', 2, 'dash-board,part-assignment,lines', 'read-only', 'read-only', 'read-only', 'read-write', 'read-write', '1'),
(8, 'line manager', 2, 'dash-board,lines', 'read-only', 'read-only', 'read-only', 'read-only', 'read-only', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `usermail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mob_num` varchar(255) NOT NULL DEFAULT 'null',
  `plant_id` int(11) NOT NULL,
  `r_id` int(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `otp` varchar(255) NOT NULL,
  `create_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `usermail`, `password`, `mob_num`, `plant_id`, `r_id`, `status`, `otp`, `create_date_time`) VALUES
(1, 'rakshith', 'sairakshith77@gmail.com', '1234', '9515154877', 1, 1, 'active', '570492', '2024-06-13 07:19:51'),
(2, 'ramesh', 'ramu@gmail.com', '123', 'null', 1, 7, 'active', '', '2024-06-27 11:50:36'),
(4, 'cxdc', 'arshad@gmail.com', 'ddd', 'null', 1, 5, 'active', '', '2024-06-27 12:02:59'),
(5, 'dur898', 'affu@gmail.com', '122', 'null', 1, 7, 'active', '', '2024-06-27 12:07:57'),
(6, 'GAN123', 'ramu@gmail.com', '222', 'null', 1, 1, 'active', '', '2024-06-27 13:56:58'),
(7, 'akh110', 'akhil12@gmail.com', '111', 'null', 2, 2, 'active', '', '2024-06-28 05:43:12'),
(8, 'moh990', 'arshad@gmail.com', '11q', 'null', 2, 1, 'inactive', '', '2024-06-28 07:28:11'),
(9, 'moh990', 'arshad@gmail.com', 'aac', 'null', 2, 8, 'active', '', '2024-06-28 07:28:30'),
(10, 'dur898', 'durga@gmail.com', 'qaa', 'null', 2, 8, 'inactive', '', '2024-06-28 07:57:53'),
(11, 'moh990', 'arshad@gmail.com', 'sss', 'null', 2, 2, 'inactive', '', '2024-06-28 07:57:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `all_plants`
--
ALTER TABLE `all_plants`
  ADD PRIMARY KEY (`plant_id`);

--
-- Indexes for table `lines_table`
--
ALTER TABLE `lines_table`
  ADD PRIMARY KEY (`line_id`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`machine_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `all_plants`
--
ALTER TABLE `all_plants`
  MODIFY `plant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lines_table`
--
ALTER TABLE `lines_table`
  MODIFY `line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `machine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
