-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Nov 27, 2018 at 04:57 PM
-- Server version: 5.6.42
-- PHP Version: 7.2.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE `cars` (
  `car_id` int(6) NOT NULL,
  `plate_number` CHARACTER(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `modell` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `factory_id` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `persons` int(2) NOT NULL,
  `doors_number` int(2) NOT NULL,
  `category` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tags` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `color` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `born_date` date NOT NULL,
  `insurance_name` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `insurance_id` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `insurance_until_date` date NOT NULL,
  `car_status_details` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `available_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `car_images`
--

DROP TABLE IF EXISTS `car_images`;
CREATE TABLE `car_images` (
  `file_id` int(6) NOT NULL,
  `car_id` int(6) NOT NULL,
  `filename` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pathdir` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pathurl` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `car_services`
--

DROP TABLE IF EXISTS `car_services`;
CREATE TABLE `car_services` (
  `service_id` int(6) NOT NULL,
  `car_id` int(6) NOT NULL,
  `service_date` date NOT NULL,
  `runned_km` int(10) NOT NULL,
  `need_to_fix` tinyint(4) NOT NULL,
  `ready_to_work` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rent_orders`
--

DROP TABLE IF EXISTS `rent_orders`;
CREATE TABLE `rent_orders` (
  `rent_id` int(6) NOT NULL,
  `car_id` int(6) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `rent_status` tinyint(4) NOT NULL,
  `starting_km` int(10) NOT NULL,
  `last_km` int(10) NOT NULL,
  `accident_details` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `daily_rent_price` int(10) NOT NULL,
  `fixing_price` int(10) NOT NULL,
  `insurance_price` int(10) NOT NULL,
  `deposit` int(10) NOT NULL,
  `rent_subtotal` int(10) NOT NULL,
  `vat` int(2) NOT NULL,
  `rent_total` int(10) NOT NULL,
  `firstname` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastname` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(6) NOT NULL,
  `email` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `session_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `access_token` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(6) NOT NULL,
  `email` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `firstname` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastname` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `profile_img` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  `enabled_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `car_images`
--
ALTER TABLE `car_images`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `car_services`
--
ALTER TABLE `car_services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `rent_orders`
--
ALTER TABLE `rent_orders`
  ADD PRIMARY KEY (`rent_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD UNIQUE KEY `access_token` (`access_token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_images`
--
ALTER TABLE `car_images`
  MODIFY `file_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_services`
--
ALTER TABLE `car_services`
  MODIFY `service_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rent_orders`
--
ALTER TABLE `rent_orders`
  MODIFY `rent_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
