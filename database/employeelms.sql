-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 05:24 PM
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
-- Database: `employeelms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `date`, `gender`, `phone`, `profile`) VALUES
(1, 'Aayushma Kc', 'admin', 'admin123@gmail.com', '12345', '2024-10-29', 'Female', '9876554321', '0c2112a9f463c42b003fb4a31fe13eeb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `dname` varchar(100) NOT NULL,
  `shortform` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `cdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dname`, `shortform`, `code`, `cdate`) VALUES
(1, 'Information Technlogy', 'IT', 'IT010', '2024-10-30'),
(2, 'Human Resource', 'HR', 'HR160', '2024-10-30'),
(3, 'Operations', 'OP', 'OP204', '2024-10-30'),
(4, 'Volunteer', 'VL', 'VL100', '2024-10-30'),
(5, 'Marketing', 'MK', 'MK304', '2024-10-30'),
(6, 'Finance', 'FL', 'FL123', '2024-10-30'),
(7, 'Sales', 'SS', 'SS240', '2024-10-30'),
(9, 'Research', 'RS', 'RS501', '2024-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `employeeid` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `contact` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `regdate` varchar(500) NOT NULL,
  `profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `fname`, `lname`, `employeeid`, `email`, `department`, `gender`, `dob`, `contact`, `country`, `address`, `password`, `status`, `regdate`, `profile`) VALUES
(1, 'Sudha', 'Karki', 'AA1210', 'sudha@gmail.com', 'Finance', 'Female', '2002-07-13', '9860335583', 'Nepal', 'Aarubari', '12345', '1', '2024-10-29', '0c2112a9f463c42b003fb4a31fe13eeb.jpg'),
(3, 'Swochhanda ', 'Karanjeet', 'AA1211', 'swochhanda@gmail.com', 'Information Technlogy', 'male', '2024-10-30', '9863422162', 'Nepal', 'Shankharapur', '12345', '1', '2024-10-30', 'Bakasta+KC+WD.png'),
(4, 'Sanam', 'Shrestha', 'AA1212', 'sanamshrestha@gmail.com', 'Human Resource', 'Male', '2003-01-10', '98765987', 'Nepal', 'Gokarana', '12345', '1', '2024-10-31', 'WATERMARK.png');

-- --------------------------------------------------------

--
-- Table structure for table `leavedetail`
--

CREATE TABLE `leavedetail` (
  `id` int(11) NOT NULL,
  `ltype` varchar(100) NOT NULL,
  `sdate` varchar(100) NOT NULL,
  `edate` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `regdate` varchar(100) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `remarkdate` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `isread` varchar(100) NOT NULL,
  `emp_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leavedetail`
--

INSERT INTO `leavedetail` (`id`, `ltype`, `sdate`, `edate`, `description`, `regdate`, `remark`, `remarkdate`, `status`, `isread`, `emp_email`) VALUES
(1, 'Personal Time Off', '2024-12-01', '2024-12-07', 'I am going for a trip.', '2024-11-01', 'Sorry We have less employee to work you can apply for next session.', '2024-11-01', '2', '0', 'swochhanda@gmail.com'),
(2, 'Self-Quarantine Leave', '2024-12-03', '2024-12-06', 'I have a cold.', '2024-11-01', 'You can leave', '2024-11-01', '1', '0', 'sudha@gmail.com'),
(3, 'Personal Time Off', '2024-11-04', '2024-11-12', 'My wedding is coming.', '2024-11-01', 'Congratulation on you wedding.', '2024-11-01', '1', '0', 'sanamshrestha@gmail.com'),
(4, 'Casual Leave', '2024-11-18', '2024-11-22', 'just for fun', '2024-11-04', 'You can take a leave and donot com back.', '2024-11-04', '1', '0', 'swochhanda@gmail.com'),
(5, 'Casual Leave', '2024-12-01', '2024-12-07', 'I am going on a trip', '2024-11-13', 'just work', '2024-11-13', '2', '0', 'swochhanda@gmail.com'),
(6, '', '', '', '', '2024-11-17', '', '', '0', '0', 'swochhanda@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `leavetype`
--

CREATE TABLE `leavetype` (
  `id` int(11) NOT NULL,
  `ltype` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `cdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leavetype`
--

INSERT INTO `leavetype` (`id`, `ltype`, `description`, `cdate`) VALUES
(1, 'Casual Leave', 'Provided for urgent or unforeseen matters to the employees.', '2024-10-30'),
(3, 'Restricted Holiday', 'Holiday that is optional', '2024-10-30'),
(4, 'Personal Time Off', 'To manage some private matters', '2024-10-30'),
(5, 'Self-Quarantine Leave', 'Related to COVID-19 issues', '2024-10-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leavedetail`
--
ALTER TABLE `leavedetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leavetype`
--
ALTER TABLE `leavetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leavedetail`
--
ALTER TABLE `leavedetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leavetype`
--
ALTER TABLE `leavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
