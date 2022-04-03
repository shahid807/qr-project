-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2022 at 10:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qr_product`
--

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `status`) VALUES
(1, '000000', 1),
(2, '330000', 1),
(3, '0080ff', 1),
(4, 'ff00ff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `qr_code`
--

CREATE TABLE `qr_code` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qr_code`
--

INSERT INTO `qr_code` (`id`, `name`, `link`, `color`, `size`, `added_by`, `status`, `added_on`) VALUES
(13, 'A10', 'https://Google.com', '330000', '100x100', 1, 1, '2022-02-26 02:02:03'),
(14, 'B10', 'https://facebook.com', '0080ff', '100x100', 1, 1, '2022-02-26 02:02:27'),
(15, 'UserQrCode', 'https://www.facebook.com/profile.php?id=100001303912616', '000000', '100x100', 10, 1, '2022-02-26 02:02:13'),
(16, 'B20', 'https://www.facebook.com/profile.php?id=100001303912616', '000000', '100x100', 10, 1, '2022-02-27 06:02:28'),
(17, 'C10', 'https://Google.com', '0080ff', '100x100', 10, 1, '2022-02-27 08:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `qr_traffic`
--

CREATE TABLE `qr_traffic` (
  `id` int(11) NOT NULL,
  `qr_code_id` int(11) NOT NULL,
  `device` varchar(50) DEFAULT NULL,
  `os` varchar(255) NOT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `added_on` datetime NOT NULL,
  `added_on_str` date NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qr_traffic`
--

INSERT INTO `qr_traffic` (`id`, `qr_code_id`, `device`, `os`, `browser`, `city`, `state`, `country`, `added_on`, `added_on_str`, `ip_address`) VALUES
(1, 15, 'Mobile', 'iOS', 'safari', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-27 10:14:40', '2022-02-27', '182.183.139.37'),
(2, 13, 'Tablet', 'Android', 'Safari', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-26 10:15:03', '2022-02-26', '182.183.139.37'),
(3, 13, 'PC', 'Windows', 'Chrome', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-27 10:15:10', '2022-02-27', '182.183.139.37'),
(4, 13, 'Tablet', 'Windows', 'Opera', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-27 10:15:11', '2022-02-27', '182.183.139.37'),
(5, 13, 'PC', 'Windows', 'Chrome', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-27 02:14:07', '2022-02-27', '182.183.139.37'),
(6, 13, 'PC', 'Windows', 'Chrome', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-27 02:14:09', '2022-02-27', '182.183.139.37'),
(7, 16, 'PC', 'Windows', 'Chrome', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-27 06:20:40', '2022-02-27', '182.183.139.37'),
(8, 15, 'PC', 'Windows', 'Chrome', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-27 06:29:14', '2022-02-27', '182.183.139.37'),
(9, 16, 'PC', 'Windows', 'Chrome', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-27 06:32:58', '2022-02-27', '182.183.139.37'),
(34, 15, 'PC', 'Windows', 'Chrome', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-27 09:12:44', '2022-02-27', '182.183.139.37'),
(35, 15, 'PC', 'Windows', 'Chrome', 'Quetta', 'Balochistan', 'Pakistan', '2022-02-27 09:12:45', '2022-02-27', '182.183.139.37');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `size`, `status`) VALUES
(1, '100x100', 1),
(2, '200x200', 1),
(3, '300x300', 1),
(4, '250x250', 1),
(5, '500x500', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `total_qr` int(11) NOT NULL,
  `total_qr_hits` int(11) NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `total_qr`, `total_qr_hits`, `user_type`, `status`, `added_on`) VALUES
(1, 'Shahid Hussain', 'hshahid807@gmail.com', '$2y$10$c9wGlrWSIjYOHKlZfVJKbO0g9V1IXT32mN5E2JhCICEKj0VFbqzsi', 0, 0, 'admin', 1, '2022-02-21 00:38:56'),
(4, 'Zahid Hussain', 'zahid@gmail.com', '$2y$10$WCHiHM/NCymaYP0kpjFk2eQAMHJjiFlROR0R5JXxunjrl/VGO4UFS', 10, 0, 'user', 1, '2022-02-21 01:02:17'),
(5, 'Ali', 'ali1@gmail.com', '$2y$10$2RHOacWbfCv0eQH3Vs1huunaw7BfHgyLs2vTC9d.vDuhKVCMLsIzO', 1231, 0, 'user', 1, '2022-02-21 01:02:48'),
(6, 'Abdul Jameel', 'ab@gmail.com', 'admin', 301, 0, 'user', 1, '2022-02-22 09:02:31'),
(7, 'jersey', 'jersey@gmail.com', 'admin', 12, 0, 'user', 1, '2022-02-22 10:02:08'),
(8, 'Dr Javed', 'drjavedkhi@gmail.com', '$2y$10$yps95SGU6pOk9TOCw5efAuMJrjWjNbQoHMFm30RbIaDwMUhlVtK66', 12, 0, 'user', 1, '2022-02-22 10:02:42'),
(9, 'mujahid', 'mu@gamil.com', '$2y$10$bwslpuZDihb2CPJ/6yhV2eNTw2eF7wQDgdaXjsNn0aK5xfO9R5FPG', 12, 0, 'user', 1, '2022-02-22 10:02:35'),
(10, 'Mujahid', 'mujahid@gmail.com', '$2y$10$TMsu./mB0YuP2DflWSxSOuaKCWKe/uWPNB00E4yl51B8Nl5A3Paai', 3, 6, 'user', 1, '2022-02-26 02:02:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qr_code`
--
ALTER TABLE `qr_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qr_traffic`
--
ALTER TABLE `qr_traffic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
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
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `qr_code`
--
ALTER TABLE `qr_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `qr_traffic`
--
ALTER TABLE `qr_traffic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
