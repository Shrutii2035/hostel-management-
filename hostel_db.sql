-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2025 at 02:47 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `parent_name` varchar(100) DEFAULT NULL,
  `parent_contact` varchar(15) DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  `booking_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  KEY `room_id` (`room_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `name`, `dob`, `age`, `contact`, `email`, `parent_name`, `parent_contact`, `room_id`, `booking_date`) VALUES
(1, 'shruti', '2025-10-06', 25, '8929874763', 'shruti@01', 'shailesh', '9865434567', 1, '2025-10-06 06:34:45'),
(2, 'nazia', '2004-10-22', 21, '8934567898', 'nazia@01', 'harsh ', '7839744643', 12, '2025-10-06 06:47:42'),
(3, 'nazia', '2004-10-22', 21, '8934567898', 'nazia@01', 'harsh ', '7839744643', 12, '2025-10-06 06:50:53'),
(4, 'aashi', '2025-10-07', 20, '8754345678', 'aashi@01', 'urvashi', '8873354634', 18, '2025-10-06 08:11:34'),
(5, 'Syi Pawar', '2011-10-25', 15, '7783632547', 'syi@01', 'Manisha pawar', '8263256238', 15, '2025-10-06 08:47:22'),
(6, 'shruti', '2005-03-05', 21, '8929874763', 'shruti@01', 'shailesh', '8765434567', 16, '2025-10-06 14:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `form_info`
--

DROP TABLE IF EXISTS `form_info`;
CREATE TABLE IF NOT EXISTS `form_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `age` int NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `fnumber` varchar(10) NOT NULL,
  `room` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `form_info`
--

INSERT INTO `form_info` (`id`, `name`, `dob`, `age`, `number`, `email`, `fname`, `fnumber`, `room`, `quantity`) VALUES
(1, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'double', 7),
(3, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'double', 7),
(4, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'double', 7),
(5, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'single', 16),
(6, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'triple', 11),
(7, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'single', 2),
(8, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'single', 2),
(9, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'single', 2),
(10, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'single', 2),
(11, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'single', 2),
(12, 'shruti pawar', '2005-03-20', 20, '8929874763', 'shruti@01', 'shailesh', '8929874763', 'single', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int NOT NULL AUTO_INCREMENT,
  `room_number` int NOT NULL,
  `capacity` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`room_id`),
  UNIQUE KEY `room_no` (`room_number`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `capacity`) VALUES
(1, 101, 1),
(2, 102, 1),
(3, 103, 1),
(4, 104, 1),
(5, 105, 1),
(6, 106, 1),
(7, 107, 1),
(8, 108, 1),
(9, 109, 1),
(10, 110, 1),
(11, 111, 2),
(12, 112, 2),
(13, 113, 2),
(14, 114, 2),
(15, 115, 2),
(16, 116, 3),
(17, 117, 3),
(18, 118, 3),
(19, 119, 3),
(20, 120, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
