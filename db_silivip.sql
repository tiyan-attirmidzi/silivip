-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2021 at 08:07 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_silivip`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_childs`
--

CREATE TABLE `tbl_childs` (
  `child_id` int NOT NULL,
  `child_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `child_pob` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `child_dob` date NOT NULL,
  `parent_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_childs`
--

INSERT INTO `tbl_childs` (`child_id`, `child_name`, `child_pob`, `child_dob`, `parent_id`, `user_id`) VALUES
(8, 'Adel Muljabar', 'Unaaha', '2018-02-21', 8, 9),
(9, 'Marlina ', 'Kolaka Utara', '2019-02-19', 9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parents`
--

CREATE TABLE `tbl_parents` (
  `parent_id` int NOT NULL,
  `parent_father_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `parent_mother_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `parent_phone` varchar(13) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_parents`
--

INSERT INTO `tbl_parents` (`parent_id`, `parent_father_name`, `parent_mother_name`, `parent_phone`) VALUES
(8, 'Muhammad Fadel', 'Nur Azizah Tajudin', '081255228833'),
(9, 'Abu Budiona', 'Marlinux', '081255226688');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_therapists`
--

CREATE TABLE `tbl_therapists` (
  `therapist_id` int NOT NULL,
  `therapist_phone` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_therapists`
--

INSERT INTO `tbl_therapists` (`therapist_id`, `therapist_phone`, `user_id`) VALUES
(4, '082211443377', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int NOT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user_fullname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user_password` text COLLATE utf8mb4_general_ci NOT NULL,
  `user_gender` tinyint NOT NULL,
  `user_role` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_email`, `user_fullname`, `user_password`, `user_gender`, `user_role`) VALUES
(1, 'admin', 'admin@silivip.com', 'Admin Silivip', '55c3b5386c486feb662a0785f340938f518d547f', 0, 0),
(9, 'adelmuljabarst', 'adelmuljabar@gmail.com', 'Adel Muljabar', '55c3b5386c486feb662a0785f340938f518d547f', 0, 2),
(10, 'marlinuxubuntu', 'marlinux@gmail.com', 'Marlina ', '55c3b5386c486feb662a0785f340938f518d547f', 1, 2),
(16, 'primeuses', 'primeus@gmail.com', 'Muhammad Primus', '55c3b5386c486feb662a0785f340938f518d547f', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_childs`
--
ALTER TABLE `tbl_childs`
  ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `tbl_parents`
--
ALTER TABLE `tbl_parents`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `tbl_therapists`
--
ALTER TABLE `tbl_therapists`
  ADD PRIMARY KEY (`therapist_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_childs`
--
ALTER TABLE `tbl_childs`
  MODIFY `child_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_parents`
--
ALTER TABLE `tbl_parents`
  MODIFY `parent_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_therapists`
--
ALTER TABLE `tbl_therapists`
  MODIFY `therapist_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
