-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2026 at 02:33 PM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'MOHA ADMIN', 'it@moha.gov.lk', 'mohaadmin', '277d72e3b5ce8935209744026c5addea', '2026-02-28 12:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Anuj kumar', '2023-12-31 21:23:03', '2025-01-07 06:18:43'),
(2, 'Chetan Bhagatt', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(3, 'Anita Desai', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(4, 'HC Verma', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(5, 'R.D. Sharma ', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(9, 'fwdfrwer', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(10, 'Dr. Andy Williams', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(11, 'Kyle Hill', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(12, 'Robert T. Kiyosak', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(13, 'Kelly Barnhill', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(14, 'Herbert Schildt', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(22, 'Test Author Name', '2026-02-28 05:47:44', '2026-02-28 05:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` varchar(25) DEFAULT NULL,
  `BookPrice` decimal(10,2) DEFAULT NULL,
  `bookImage` varchar(250) NOT NULL,
  `isIssued` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `bookQty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `bookImage`, `isIssued`, `RegDate`, `UpdationDate`, `bookQty`) VALUES
(1, 'PHP And MySql programming', 4, 3, '222333', 20.00, '1efecc0ca822e40b7b673c0d79ae943f.jpg', 0, '2024-01-02 01:23:03', '2026-02-28 11:23:09', 10),
(3, 'physics', 6, 4, '1111', 15.00, 'dd8267b57e0e4feee5911cb1e1a03a79.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:11:01', 10),
(5, 'Murach\'s MySQL', 5, 1, '9350237695', 455.00, '5939d64655b4d2ae443830d73abc35b6.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:11:01', 20),
(6, 'WordPress for Beginners 2022: A Visual Step-by-Step Guide to Mastering WordPress', 5, 10, 'B019MO3WCM', 100.00, '144ab706ba1cb9f6c23fd6ae9c0502b3.jpg', 0, '2024-01-02 01:23:03', '2026-02-28 06:12:24', 15),
(7, 'WordPress Mastery Guide:', 5, 11, 'B09NKWH7NP', 53.00, '90083a56014186e88ffca10286172e64.jpg', 0, '2024-01-02 01:23:03', '2026-02-27 22:11:32', 14),
(8, 'Rich Dad Poor Dad: What the Rich Teach Their Kids About Money That the Poor and Middle Class Do Not', 8, 12, 'B07C7M8SX9', 120.00, '52411b2bd2a6b2e0df3eb10943a5b640.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:05:41', 5),
(9, 'The Girl Who Drank the Moon', 8, 13, '1848126476', 200.00, 'f05cd198ac9335245e1fdffa793207a7.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:05:45', 1),
(10, 'C++: The Complete Reference, 4th Edition', 5, 14, '007053246X', 142.00, '36af5de9012bf8c804e499dc3c3b33a5.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:11:01', 2),
(11, 'ASP.NET Core 5 for Beginners', 9, 11, 'GBSJ36344563', 422.00, 'b1b6788016bbfab12cfd2722604badc9.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:11:01', 5),
(12, 'Python Packages', 9, 16, '0367687771', 3034.00, 'ba719639def504c64ebac89cdd0d0a85.jpg', 0, '2025-01-07 06:56:50', '2026-02-27 23:06:52', 25),
(13, 'Python All-in-One for Dummies', 9, 18, '9388991214', 700.00, 'f4ba4705a075527dd6ff5bd83a7d7562.jpg', 0, '2025-01-17 14:23:48', '2025-01-17 14:25:52', 30),
(15, 'Test Book Name සිංහල', 5, 21, '55555', 2323.00, '2f8671832ef5944ea028db8a56612fa7.jpg', NULL, '2026-02-27 23:23:09', '2026-02-27 23:25:03', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(4, 'Romantic', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:11'),
(5, 'Technology', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(6, 'Science', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(7, 'Management', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(8, 'General', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(9, 'Programming', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(14, 'Test Category Name', 1, '2026-02-28 05:48:16', '2026-02-28 05:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `NIC` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Reminder` int(11) DEFAULT NULL,
  `RetrunStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  `remark` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `NIC`, `IssuesDate`, `ReturnDate`, `Reminder`, `RetrunStatus`, `fine`, `remark`) VALUES
(13, 7, '960570960V', '2026-02-01 13:28:06', '2026-02-28 13:30:27', NULL, 1, 60, 'send'),
(14, 7, '960545960V', '2026-02-28 13:28:39', NULL, NULL, NULL, NULL, 'sd'),
(15, 8, '960570961V', '2026-02-28 13:29:41', NULL, NULL, NULL, NULL, 'sdsd');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `NIC` varchar(100) DEFAULT NULL,
  `EmpNo` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `approval` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `NIC`, `EmpNo`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `approval`, `RegDate`, `UpdationDate`) VALUES
(15, '960570960V', '300513', 'Himal Sarathchandra', 'himalhp@gmail.com', '94779209137', '698d51a19d8a121ce581499d7b701668', 1, 1, '2026-02-27 23:17:09', '2026-02-28 12:23:39'),
(19, '960570961V', '521300', 'Chamila Chamila', 'hp@gmail.com', '94779209537', '698d51a19d8a121ce581499d7b701668', 1, 1, '2026-02-28 08:15:08', '2026-02-28 09:47:17'),
(20, '960545960V', '200562', 'test', 'kk@gmail.com', '94779999937', 'bcbe3365e6ac95ea2c0343a2395834dd', 1, 1, '2026-02-28 10:51:40', '2026-02-28 11:49:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblauthors`
--
ALTER TABLE `tblauthors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIC` (`NIC`),
  ADD UNIQUE KEY `EmpNo` (`EmpNo`),
  ADD UNIQUE KEY `EmailId` (`EmailId`,`MobileNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
