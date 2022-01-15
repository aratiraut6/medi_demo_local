-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2022 at 09:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_id` int(11) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `quote_no` varchar(10) NOT NULL,
  `upload_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_id`, `file_name`, `quote_no`, `upload_file`) VALUES
(14, 'abc', '11111', 'template.csv'),
(15, 'abcd', '2222', 'template.csv'),
(17, 'abcde', '3333', 'template.csv'),
(18, 'abc', '3344', 'template.csv'),
(19, 'abc', '33444', 'template.csv'),
(23, 'abc', '3123123', 'template.csv'),
(24, 'abc', '111', 'template.csv'),
(25, 'abc', '31231233', 'template.csv'),
(26, 'abc', '312312331', 'template.csv'),
(27, 'abc', '111122', 'template.csv'),
(28, '16thjan', '333', 'template.csv'),
(29, '16thjan', '33311', 'template.csv');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_details_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` varchar(6) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `date_of_joining` date NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`customer_details_id`, `customer_id`, `employee_id`, `employee_name`, `relation`, `date_of_joining`, `date_of_birth`, `gender`, `age`, `email`, `mobile`) VALUES
(4, 28, 'A11212', 'Josef', 'Employee', '2021-01-01', '2021-01-01', 'm', 25, 'srinivas.medibhai@gmail.com', '9021434305'),
(5, 28, 'A11212', 'Dan', 'Father', '2021-01-01', '1962-01-01', 'm', 56, 'demo@gmail.com', '9021434305'),
(6, 28, 'A11212', 'Debora', 'Mother', '2021-01-01', '1965-01-01', 'f', 56, 'demo@gmail.com', '9021434305'),
(7, 29, 'A11212', 'Josef', 'Employee', '2021-01-01', '2021-01-01', 'm', 25, 'srinivas.medibhai@gmail.com', '9021434305'),
(8, 29, 'A11212', 'Dan', 'Father', '2021-01-01', '1962-01-01', 'm', 56, 'demo@gmail.com', '9021434305'),
(9, 29, 'A11212', 'Debora', 'Mother', '2021-01-01', '1965-01-01', 'f', 56, 'demo@gmail.com', '9021434305');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_id`),
  ADD UNIQUE KEY `Quote_no` (`quote_no`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_details_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
