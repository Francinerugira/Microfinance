-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 12:17 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `microfinance`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `date_of_birth` date NOT NULL,
  `national_id` bigint(16) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` varchar(250) NOT NULL,
  `account_number` bigint(20) NOT NULL,
  `profile_photo` varchar(250) NOT NULL,
  `type_of_account` varchar(200) NOT NULL,
  `date_created` date DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'active',
  `branch` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `date_of_birth`, `national_id`, `phone_number`, `address`, `account_number`, `profile_photo`, `type_of_account`, `date_created`, `email`, `gender`, `status`, `branch`) VALUES
(30, 'RUGIRA', 'Francine', '1982-02-02', 1234567898765432, '0780339320', 'Kigali Gasabo', 4669291548, 'user.jpg', 'current', '2022-03-28', 'francinerugira@gmail.com', 'Female', 'broken', 'Remera'),
(31, 'HABIMANA', 'Emmanuel', '1981-08-06', 8765432345678936, '0780339300', 'SOuth Kamonyi', 9024660463, 'user3.jpg', 'saving', '2022-03-28', 'emmanuel@gmail.com', 'Male', 'active', 'Remera'),
(36, 'INEZA', 'Kelia', '1990-10-16', 9874838374738383, '0780339433', 'Kigali Gasabo', 3627157893, 'user3.jpg', 'current', '2022-03-30', 'kelia@gmail.com', 'Female', 'active', 'Remera');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `address` varchar(250) NOT NULL,
  `national_id` bigint(20) NOT NULL,
  `date_of_birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `email`, `password`, `role`, `Name`, `phone_number`, `gender`, `branch`, `address`, `national_id`, `date_of_birth`) VALUES
(1, 'admin@gmail.com', '$2y$10$qa8tmBdX2uwXKgiQ7lgF5.JmVJ90r9CRdUszhmY7tHHD1kNsb7D1G', 'admin', 'Admin', '', '', '', '', 0, NULL),
(2, 'manager@gmail.com', '$2y$10$qa8tmBdX2uwXKgiQ7lgF5.JmVJ90r9CRdUszhmY7tHHD1kNsb7D1G', 'manager', 'Manager', '', '', '', '', 0, NULL),
(3, 'teller@gmail.com', '$2y$10$d9D21JuOtAfx1OuDOXPnz.lYGju7Ua0GydHhy6TqH7.u.dhEHrC9m', 'teller', 'Teller', '', '', '', '', 0, NULL),
(4, 'manager1@gmail.com', 'password', 'manager', 'Manager', '0780339320', 'Male', 'Remera', 'Kigali Gasabo', 1234567890987634, '2022-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` int(11) NOT NULL,
  `cust_id` varchar(250) NOT NULL,
  `action` varchar(250) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `transaction_date` date NOT NULL,
  `description` varchar(250) NOT NULL DEFAULT 'creating account',
  `teller` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `cust_id`, `action`, `amount`, `transaction_date`, `description`, `teller`) VALUES
(10, '30', 'credit', '5000', '2022-03-28', 'creating account', 1),
(11, 'bank', 'debit', '5000', '2022-03-28', 'creating account', 1),
(12, '31', 'credit', '5000', '2022-03-28', 'creating account', 1),
(13, 'bank', 'debit', '5000', '2022-03-28', 'creating account', 1),
(16, '30', 'debit', '1000', '2022-03-28', 'Debited by owner', 3),
(17, 'bank', 'credit', '1000', '2022-03-28', 'Debited by owner', 3),
(18, '30', 'debit', '4000', '2022-03-29', 'ssdsssd', 3),
(19, 'bank', 'credit', '4000', '2022-03-29', 'ssdsssd', 3),
(20, '30', 'credit', '40000', '2022-03-29', 'Saved by owner', 3),
(21, 'bank', 'debit', '40000', '2022-03-29', 'Saved by owner', 3),
(32, '36', 'credit', '7000', '2022-03-30', 'creating account', 1),
(33, 'bank', 'debit', '7000', '2022-03-30', 'creating account', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `national_id` (`national_id`,`phone_number`),
  ADD UNIQUE KEY `account_number` (`account_number`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
