-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2020 at 04:38 PM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DB-Project`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(10) UNSIGNED NOT NULL,
  `utility_id` varchar(255) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `complaint_status` bit(1) DEFAULT NULL,
  `complaint_desc` text,
  `registeration_date` date DEFAULT NULL,
  `resolution_date` date DEFAULT NULL,
  `escalation_status` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `connection_type` varchar(255) DEFAULT NULL,
  `total_discount` float DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `black_list_status` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`user_id`, `connection_type`, `total_discount`, `balance`, `black_list_status`) VALUES
(29, 'Residential', 0, 0, b'0'),
(31, 'Residential', 0, 0, b'0'),
(32, 'Residential', 0, 0, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `Data_Package`
--

CREATE TABLE `Data_Package` (
  `pkg_id` int(10) UNSIGNED NOT NULL,
  `monthly_limit` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `utility_id` varchar(255) DEFAULT NULL,
  `bill_amount` float DEFAULT NULL,
  `amount_received` float DEFAULT NULL,
  `bill_due` float DEFAULT NULL,
  `bill_status` bit(1) DEFAULT NULL,
  `bill_generation_date` date DEFAULT NULL,
  `date_of_payment` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Invoice_Payments`
--

CREATE TABLE `Invoice_Payments` (
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Payments`
--

CREATE TABLE `Payments` (
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_id` int(10) UNSIGNED NOT NULL,
  `payment_amount` float DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Registers_For`
--

CREATE TABLE `Registers_For` (
  `utility_id` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `connection_type` varchar(255) NOT NULL,
  `units_consumed` float DEFAULT NULL,
  `utility_balance` float DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `days_overdue` int(11) NOT NULL DEFAULT '0',
  `status` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Third_Party`
--

CREATE TABLE `Third_Party` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `pkg_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Time`
--

CREATE TABLE `Time` (
  `curr_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Time`
--

INSERT INTO `Time` (`curr_date`) VALUES
('2020-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `cnic` char(15) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL,
  `approved_bit` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `name`, `cnic`, `contact_number`, `email_id`, `address`, `username`, `password`, `role`, `approved_bit`) VALUES
(4, 'Muhammad Uzair Afzal', '35202-987764-9', '0900-78601', 'uzair9990@gmail.com', 'DHA PHASE-V LUMS, M1', 'uzair9990', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Admin', b'1'),
(5, 'Iftikhar', '2345-983730-9', '090078601', 'ifi@gmail.com', 'LUMS', 'ifi_wow', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Customer', b'1'),
(11, 'Ali Ahmad Barooni', '123-456-7', '0900-78601', 'ali_ahmad@gmail.com', 'Cahuburji park, Lahore', 'ali_ahmad', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Staff', b'1'),
(12, 'Zain Abdullah', '123-456-98', '090083838', 'zain@gmail.com', 'Islamabad, G-1', 'zain', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Customer', b'1'),
(18, 'Aleena Sattar', '35202-9876-9', '031344567', 'aleena@gmail.com', 'LUMS', 'aleena_sattar', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Staff', b'0'),
(19, 'Maria Haroon', '35202-9876-9', '0900-786-01', 'maria@gmail.com', 'LUMS', 'maria_haroon', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Staff', b'1'),
(22, 'Hamza Khalid', '123456789', '0900-786-01', 'hamza@gmail.com', 'LUMS', 'hamza_khalid', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Admin', b'0'),
(23, 'Random User', '123456789', '1234567', 'random_user@gmail.com', 'LUMS', 'random_user', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Customer', b'1'),
(24, 'Shayan Wathra', '35202-9875-9', '0900-78601', 'shayan@gmail.com', 'DHA, Phase-III, Lahore', 'shayan_w', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Customer', b'1'),
(25, 'Waris Shaha', '1234-987-4', '090078601', 'waris@gmail.com', '155-H Block EME', 'waris', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Customer', b'1'),
(26, 'Waris Shaha', '1234-987-4', '090078601', 'waris@gmail.com', '155-H Block EME', 'waris-shah', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Staff', b'1'),
(27, 'Haji Nazeer', '1234-5768-9', '090078601', 'nazeer@gmail.com', 'Shadman', 'nazeer', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Staff', b'0'),
(28, 'Furqan Lodhi', '1234-839574-4', '090078601', 'furkan@gmail.com', 'Karachi', 'furqaan', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Admin', b'1'),
(29, 'Mursal Junaid', '893-39284-3', '090078601', 'mursal@gmail.com', 'Lahore', 'mursal', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Customer', b'1'),
(30, 'Adil Aslam', '3520287602089', '03004022035', 'adilaslamch@hotmail.com', '86-B', 'adilaslam7', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Admin', b'1'),
(31, 'Adil Aslam', '3237658765', '03213456128', 'dummyuser@hotmail.com', '86', 'dummyuser2', '$2y$10$m1ni7eisu0avrcpzjlqOwuWox7.etX4ZAje3IIRZzp7j15p3QAmwi', 'Customer', b'1'),
(32, 'Aliaslam_08', '78292299337', '03028404140', 'aliaslamch@hotmail.com', '76-B soup', 'Aliaslam_08', '$2y$10$m1ni7eisu0avrcpzjlqOwuynz9AgKBrof7s0vUgnZ/ASqejWZCi6u', 'Customer', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `Utilities`
--

CREATE TABLE `Utilities` (
  `utility_id` varchar(255) NOT NULL,
  `connection_type` varchar(255) NOT NULL,
  `utility_name` varchar(255) DEFAULT NULL,
  `fixed_monthly_price` float DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Utilities`
--

INSERT INTO `Utilities` (`utility_id`, `connection_type`, `utility_name`, `fixed_monthly_price`, `unit_price`, `image`) VALUES
('EC', 'Commercial', 'Electricity', 310, 70, 'flash.svg'),
('EI', 'Industrial', 'Electricity', 600, 120, 'flash.svg'),
('ER', 'Residential', 'Electricity', 250, 50, 'flash.svg'),
('GR', 'Residential', 'gas', 200, 30, 'gas.svg'),
('IR', 'Residential', 'Internet', 1000, 30, 'internet.svg'),
('WR', 'Residential', 'Water', 100, 10, 'drop.svg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `utility_id` (`utility_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `Data_Package`
--
ALTER TABLE `Data_Package`
  ADD PRIMARY KEY (`pkg_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `utility_id` (`utility_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Invoice_Payments`
--
ALTER TABLE `Invoice_Payments`
  ADD PRIMARY KEY (`invoice_id`,`payment_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Registers_For`
--
ALTER TABLE `Registers_For`
  ADD PRIMARY KEY (`user_id`,`utility_id`,`connection_type`),
  ADD KEY `utility_id` (`utility_id`);

--
-- Indexes for table `Third_Party`
--
ALTER TABLE `Third_Party`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `pkg_id` (`pkg_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_foreign_key_name` (`username`);

--
-- Indexes for table `Utilities`
--
ALTER TABLE `Utilities`
  ADD PRIMARY KEY (`utility_id`,`connection_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `Data_Package`
--
ALTER TABLE `Data_Package`
  MODIFY `pkg_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `Payments`
--
ALTER TABLE `Payments`
  MODIFY `payment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `Third_Party`
--
ALTER TABLE `Third_Party`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Admin`
--
ALTER TABLE `Admin`
  ADD CONSTRAINT `Admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`utility_id`) REFERENCES `Utilities` (`utility_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `Customer`
--
ALTER TABLE `Customer`
  ADD CONSTRAINT `Customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`utility_id`) REFERENCES `Utilities` (`utility_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `Invoice_Payments`
--
ALTER TABLE `Invoice_Payments`
  ADD CONSTRAINT `Invoice_Payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Invoice_Payments_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `Payments` (`payment_id`) ON DELETE CASCADE;

--
-- Constraints for table `Payments`
--
ALTER TABLE `Payments`
  ADD CONSTRAINT `Payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `Registers_For`
--
ALTER TABLE `Registers_For`
  ADD CONSTRAINT `Registers_For_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Registers_For_ibfk_2` FOREIGN KEY (`utility_id`) REFERENCES `Utilities` (`utility_id`) ON DELETE CASCADE;

--
-- Constraints for table `Third_Party`
--
ALTER TABLE `Third_Party`
  ADD CONSTRAINT `Third_Party_ibfk_1` FOREIGN KEY (`pkg_id`) REFERENCES `Data_Package` (`pkg_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
