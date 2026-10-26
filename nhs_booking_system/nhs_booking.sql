-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2026 at 09:23 PM
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
-- Database: `nhs_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `details` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `staff_id` int(11) DEFAULT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_email`, `appointment_date`, `appointment_time`, `details`, `status`, `staff_id`, `patient_id`) VALUES
(5, '', '2025-05-21', '13:37:00', 'injury', 'Completed', NULL, 3),
(6, '', '2025-05-21', '13:37:00', 'injury', 'Completed', NULL, 11),
(7, '', '2025-05-22', '08:28:00', 'head', 'Completed', NULL, 15),
(8, '', '2025-05-30', '08:36:00', 'leg', 'Cancelled', NULL, 15),
(9, 'Asim@gmail.com', '2025-05-29', '09:46:00', 'eye test', 'Completed', NULL, 0),
(10, 'Asim@gmail.com', '2025-05-23', '20:18:00', 'injury', 'Completed', NULL, 0),
(11, 'Henry@gmail.com', '2025-05-22', '01:15:00', 'eye infection', 'Completed', NULL, 0),
(12, 'Asim@gmail.com', '2025-05-21', '00:17:00', 'interview', 'Completed', NULL, 0),
(13, 'Henry@gmail.com', '2025-05-22', '11:45:00', 'leg', 'Completed', NULL, 0),
(14, 'HKhan2015@gmail.com', '2025-05-23', '08:23:00', 'Blood Test', 'Completed', NULL, 0),
(15, 'HKhan2015@gmail.com', '2025-05-24', '11:10:00', 'head injury', 'Completed', NULL, 0),
(16, 'Mihsaan21@gmail.com', '2025-11-22', '14:12:00', 'Just a checkup', 'Completed', NULL, 0),
(17, 'Mihsaan21@gmail.com', '2025-11-12', '12:32:00', 'injury', 'Completed', NULL, 0),
(18, 'Mihsaan21@gmail.com', '2026-02-18', '10:53:00', 'eye test', 'Completed', NULL, 0),
(19, 'Kaleemshah7865@gmail.com', '2026-02-27', '15:30:00', 'Stomach pain and constipation', 'Completed', 19, 20),
(20, 'Mihsaan21@gmail.com', '2026-02-28', '17:44:00', 'Blood test', 'pending', NULL, 0),
(21, 'Mihsaan21@gmail.com', '2026-06-18', '13:41:00', 'MRI scan', 'pending', NULL, 0),
(22, 'Mihsaan21@gmail.com', '2026-03-04', '13:46:00', 'checkup', 'pending', NULL, 0),
(23, 'Mihsaan21@gmail.com', '2026-03-20', '09:00:00', 'Eid Namaaz', 'pending', NULL, 0),
(24, 'Mihsaan21@gmail.com', '2026-03-18', '17:08:00', '', 'pending', NULL, 0),
(25, 'Mihsaan21@gmail.com', '0000-00-00', '00:00:00', '', 'pending', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_slots`
--

CREATE TABLE `appointment_slots` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `slot_date` date DEFAULT NULL,
  `slot_time` time DEFAULT NULL,
  `is_booked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `available_slots`
--

CREATE TABLE `available_slots` (
  `id` int(11) NOT NULL,
  `slot_date` date NOT NULL,
  `slot_time` time NOT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` enum('room','desk','equipment') DEFAULT NULL,
  `availability_status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `dob`, `address`, `postcode`, `phone`) VALUES
(1, NULL, NULL, NULL, 'staff', NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, 'staff', NULL, NULL, NULL, NULL),
(3, '', '', '$2y$10$31KaE89KxAd8iwKnSdsrkex6rXkEEdhG5F/RzX6/1r467Sh25YJ3C', '', NULL, NULL, NULL, NULL),
(4, 'Ismaeel876', 'ismaeel@nhs.co.uk', '$2y$10$0T3pA/9.S8m.8cwtolzNwO0/y9sqf3a.5yCdcITunvKILK6bkmZFG', '', NULL, NULL, NULL, NULL),
(5, 'Mohammed', 'Mo@nhs.co.uk', '$2y$10$GkvBPfDJTvNf./7E24ZIKe1jlOEQMwd53LVcAwyzKnQcSrrR9A7xW', '', NULL, NULL, NULL, NULL),
(7, NULL, 'khan@nhs.co.uk', '$2y$10$5Uv4lZfYNQxGAM7Q037rweaJ4bHaSbpViKOHlNI5ejMbTNOY8UyMu', 'staff', NULL, NULL, NULL, NULL),
(9, NULL, 'Ben@nhs.com', '$2y$10$ynCIdm7vcZ8MlQSS9qFv4uMcv5TmgeOuiZV2GgZgaKBhfvwhZIw1O', 'staff', NULL, NULL, NULL, NULL),
(10, NULL, 'Danny@nhs.co.uk', '$2y$10$RBKetuTmPKUw9sttC7Q9suzAhPXydV/Z3OYy6AiGMhVjjCKYSLiZ.', 'staff', NULL, NULL, NULL, NULL),
(11, NULL, 'bob@gmail.com', '$2y$10$PDGU0Zeb4LGF/JT6S5AcBOovjAg53hcNLwaMst5odshZVd1uoMO0W', 'staff', NULL, NULL, NULL, NULL),
(12, NULL, 'ihsaan@nhs.co.uk', '$2y$10$JvU9iVPjMWgK4a7YFTRmA.2Oi8bcUztcrLuqO22huBuaAtkwQltvm', 'staff', NULL, NULL, NULL, NULL),
(13, 'Hasan Khan', 'Hasan@gmail.com', '$2y$10$9ta8oA0e/8vz6ApnAWlvw.EXVinaZ8i3TIrYoyFz2tunLo7/hXu9y', '', NULL, NULL, NULL, NULL),
(14, 'Ismaeel', 'admin@nhs.co.uk', '$2y$10$uXG9mQW6Qj99W8nZGb3rKu2FgDZzH6q7VnIvq/3vRh6nMx9ZV3d9m', 'admin', NULL, NULL, NULL, NULL),
(15, 'Asim', 'Asim1@gmail.com', '$2y$10$QDIkbp7aYz5ayysQwAAqJe/rtMQbB0EqpMq17HZkWNYU4.aTk3kNi', '', NULL, NULL, NULL, NULL),
(16, 'Henry Carter', 'Henry@gmail.com', '$2y$10$xDo.WkaqhPqT50iHYbXK7OzPaUE7AhkukpjrVKgSM//eFez9TUTUm', '', NULL, NULL, NULL, NULL),
(17, 'Hasan Khan', 'HKhan2015@gmail.com', '$2y$10$hcWadwP78WbIR6/IrYJNNu6eo6PmA0piunE0A.VMgTallCE0YBYJy', '', '2003-07-25', '30 Walvy Road', 'BB9 XYZ', NULL),
(18, 'Mohammed Ihsaan', 'Mihsaan21@gmail.com', '$2y$10$7s2pSLT8BTF3BDzxztHmN.X85nAvqiYCFxIUCYKxpaFg8yY1kmZZG', '', '2003-08-20', '60 Charles Street', 'bb9786', NULL),
(19, 'staff', 'staff@nhs.co.uk', '$2y$10$X2dw8mlL1H2dN60NW8pK4O0n8dAAUTN6d68cuC70K3kXCZS//YYRm', 'staff', '2025-11-11', '123 walverden road', 'bb9786', NULL),
(20, 'Kaleem Shah', 'Kaleemshah7865@gmail.com', '', '', '2004-08-12', NULL, NULL, '078456215458');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient` (`patient_id`),
  ADD KEY `fk_staff` (`staff_id`);

--
-- Indexes for table `appointment_slots`
--
ALTER TABLE `appointment_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `available_slots`
--
ALTER TABLE `available_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `resource_id` (`resource_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `appointment_slots`
--
ALTER TABLE `appointment_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `available_slots`
--
ALTER TABLE `available_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_slots`
--
ALTER TABLE `appointment_slots`
  ADD CONSTRAINT `appointment_slots_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`),
  ADD CONSTRAINT `appointment_slots_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
