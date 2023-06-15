-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2022 at 10:14 AM
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
-- Database: `resort management system`
--
CREATE DATABASE IF NOT EXISTS `resort management system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `resort management system`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `food_bill`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `food_bill` (IN `user_id` INT(5))  UPDATE check_out o
SET o.food_amount=(SELECT(r.price*f.quantity)
                   FROM restaurant r,food_order f,booking b,customer c
                   WHERE f.user_id=user_id
                   AND r.item_id=f.item_id
                   AND f.book_id=b.book_id
                   AND f.user_id=c.user_id)$$

DROP PROCEDURE IF EXISTS `room_bill`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `room_bill` (IN `user_id` INT(5))  UPDATE check_out c
SET c.room_tariff=(SELECT((r.price*b.no_of_rooms)-cc.advance_amount)
              FROM room r,booking b,check_in cc
              WHERE c.user_id=user_id 
              AND c.book_id=b.book_id
              AND r.room_type=b.room_type
              AND c.user_id=b.user_id)$$

DROP PROCEDURE IF EXISTS `total_bill`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `total_bill` ()  UPDATE check_out
SET total=room_tariff+food_amount$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking` (
  `user_id` int(5) NOT NULL,
  `book_id` int(5) NOT NULL,
  `room_type` varchar(30) NOT NULL,
  `no_of_rooms` int(2) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `book_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`user_id`, `book_id`, `room_type`, `no_of_rooms`, `check_in_date`, `check_out_date`, `book_date`) VALUES
(1, 1, 'AC', 1, '2022-01-24', '2022-01-25', '0000-00-00');

--
-- Triggers `booking`
--
DROP TRIGGER IF EXISTS `rooms_availablity`;
DELIMITER $$
CREATE TRIGGER `rooms_availablity` AFTER INSERT ON `booking` FOR EACH ROW UPDATE room
SET rooms_available=rooms_available-new.no_of_rooms
WHERE room_type=new.room_type
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `check_in`
--

DROP TABLE IF EXISTS `check_in`;
CREATE TABLE `check_in` (
  `user_id` int(5) NOT NULL,
  `book_id` int(5) NOT NULL,
  `adult_count` int(10) NOT NULL,
  `children_count` int(10) NOT NULL,
  `advance_amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_in`
--

INSERT INTO `check_in` (`user_id`, `book_id`, `adult_count`, `children_count`, `advance_amount`) VALUES
(1, 1, 2, 1, 200);

-- --------------------------------------------------------

--
-- Table structure for table `check_out`
--

DROP TABLE IF EXISTS `check_out`;
CREATE TABLE `check_out` (
  `user_id` int(5) NOT NULL,
  `book_id` int(5) NOT NULL,
  `food_amount` int(5) NOT NULL,
  `room_tariff` int(5) NOT NULL,
  `total` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_out`
--

INSERT INTO `check_out` (`user_id`, `book_id`, `food_amount`, `room_tariff`, `total`) VALUES
(1, 1, 600, 2800, 3400);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `user_id` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `gender` char(1) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `username`, `password`, `gender`, `address`, `email`, `phone`) VALUES
(1, 'samyak', '0123456789', 'm', 'Madhu nivas', 'samyakmakam3@gmail.com', 7022400767);

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

DROP TABLE IF EXISTS `food_order`;
CREATE TABLE `food_order` (
  `user_id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  `book_id` int(5) NOT NULL,
  `item_id` int(5) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `quantity` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`user_id`, `order_id`, `book_id`, `item_id`, `item_name`, `quantity`) VALUES
(1, 0, 1, 1, '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE `restaurant` (
  `item_id` int(5) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`item_id`, `item_name`, `price`) VALUES
(1, 'Pizza', 300);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `room_type` varchar(30) NOT NULL,
  `total_no` int(2) NOT NULL,
  `price` int(5) NOT NULL,
  `rooms_available` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_type`, `total_no`, `price`, `rooms_available`) VALUES
('AC', 25, 3000, 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`user_id`,`book_id`,`room_type`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `room_type` (`room_type`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `check_in`
--
ALTER TABLE `check_in`
  ADD PRIMARY KEY (`user_id`,`book_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `check_out`
--
ALTER TABLE `check_out`
  ADD PRIMARY KEY (`user_id`,`book_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`user_id`,`order_id`,`book_id`),
  ADD KEY `order_id` (`order_id`) USING BTREE,
  ADD KEY `book_id` (`book_id`),
  ADD KEY `fk_item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `book_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `item_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `check_in`
--
ALTER TABLE `check_in`
  ADD CONSTRAINT `fk_book_id1` FOREIGN KEY (`book_id`) REFERENCES `booking` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userid1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `check_out`
--
ALTER TABLE `check_out`
  ADD CONSTRAINT `fk_book_id3` FOREIGN KEY (`book_id`) REFERENCES `booking` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userid2` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
