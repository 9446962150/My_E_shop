-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 04, 2024 at 04:09 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `Cid` int NOT NULL,
  `id` int NOT NULL,
  `qty` int NOT NULL,
  KEY `fk2` (`Cid`),
  KEY `for` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cid`, `id`, `qty`) VALUES
(14, 35, 1),
(16, 33, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`cat_id`) USING BTREE,
  UNIQUE KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'Laptop'),
(2, 'Smartphone'),
(5, 'TV'),
(6, 'Watch');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `Cid` int NOT NULL AUTO_INCREMENT,
  `Fullname` varchar(30) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `City` varchar(30) NOT NULL,
  `Contact` bigint NOT NULL,
  `Address` varchar(50) NOT NULL,
  PRIMARY KEY (`Username`) USING BTREE,
  UNIQUE KEY `Cid` (`Cid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cid`, `Fullname`, `Username`, `Email`, `Password`, `Country`, `City`, `Contact`, `Address`) VALUES
(14, 'Adithyan Nair', 'abcd', 'adithyan@gmail.com', '7890', 'India', 'Pala', 9687567007, 'poiuytgvbnm'),
(15, 'Adithyan', 'adi', 'adi1@gmail.com', '1234', 'India', 'Pala', 9687567089, 'poiuytgvbnm'),
(16, 'Jacob Joseph', 'Jac', 'Jac1@gmail.com', '3333', 'India', 'Pala', 9687567421, 'qwertyu');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `Username` varchar(25) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `Password` varchar(20) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `Role` enum('Admin','Customer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Username`, `Password`, `Role`) VALUES
('Anu', 'anu', 'Admin'),
('Jac', '3333', 'Customer'),
('abcd', '7890', 'Customer'),
('adi', '1234', 'Customer'),
('amal', '12345', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ord_id` int NOT NULL AUTO_INCREMENT,
  `Cid` int NOT NULL,
  `id` int NOT NULL,
  `qty` int NOT NULL,
  `Amount` int NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `City` varchar(30) NOT NULL,
  `Contact` bigint NOT NULL,
  `Address` varchar(200) NOT NULL,
  `ord_date` date NOT NULL,
  `invoice_no` int DEFAULT NULL,
  `deliver_date` date DEFAULT NULL,
  `ord_status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ord_id`),
  KEY `fk` (`Cid`),
  KEY `f` (`id`),
  KEY `f2` (`invoice_no`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `Cid`, `id`, `qty`, `Amount`, `Name`, `Country`, `City`, `Contact`, `Address`, `ord_date`, `invoice_no`, `deliver_date`, `ord_status`) VALUES
(126, 16, 36, 1, 9000, 'Philip Babu', 'India', 'Palai', 9876543333, 'qwerty', '2023-10-23', 46, '2023-10-25', 'Delivered Successfully'),
(127, 16, 30, 1, 30000, 'Philip Babu', 'India', 'Palai', 9876543333, 'qwerty', '2023-10-23', 46, '2023-10-25', 'Delivered Successfully'),
(130, 16, 33, 1, 26000, 'Philip Babu', 'India', 'Palai', 9876543333, 'qwerty', '2023-10-23', 48, NULL, 'Payment Pending'),
(131, 16, 30, 1, 30000, 'Philip Babu', 'India', 'Palai', 9876543333, 'qwerty', '2023-10-23', 48, NULL, 'Payment Pending'),
(132, 16, 33, 2, 52000, 'Philip Babu', 'India', 'Palai', 9876543333, 'qwerty', '2023-10-24', 49, '2023-10-28', 'Ordered Successfully'),
(133, 16, 30, 3, 90000, 'Philip Babu', 'India', 'Palai', 9876543333, 'qwerty', '2023-10-24', 49, '2023-10-28', 'Ordered Successfully'),
(134, 16, 35, 2, 50000, 'alan', 'India', 'Palai', 9876543333, 'qwerty', '2023-10-25', 50, '2023-10-29', 'Ordered Successfully'),
(135, 15, 30, 1, 30000, 'qwerty', 'India', 'Palai', 9876543333, 'qwerty', '2023-10-25', 51, '2023-10-29', 'Ordered Successfully'),
(136, 15, 33, 2, 52000, 'qwerty', 'India', 'Palai', 9876543333, 'qwerty', '2023-10-25', 51, '2023-10-29', 'Ordered Successfully'),
(137, 16, 35, 1, 25000, 'bds', 'ndfesm', 'jewfb', 0, 'jkfew', '2023-11-02', 52, '2023-11-06', 'Ordered Successfully'),
(138, 16, 33, 1, 26000, 'bds', 'ndfesm', 'jewfb', 0, 'jkfew', '2023-11-02', 52, '2023-11-06', 'Ordered Successfully'),
(139, 16, 30, 1, 30000, 'bds', 'ndfesm', 'jewfb', 0, 'jkfew', '2023-11-02', 52, '2023-11-06', 'Ordered Successfully'),
(140, 16, 30, 1, 30000, 'qwerty', 'India', 'Palai', 0, 'yyy', '2023-11-02', 53, '2023-11-06', 'Ordered Successfully'),
(142, 16, 36, 1, 9000, 'Philip Babu', 'India', 'Palai', 9876543333, 'qwerty', '2023-11-05', 55, '2023-11-09', 'Ordered Successfully');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `invoice_no` int NOT NULL AUTO_INCREMENT,
  `Cid` int NOT NULL,
  `Amount` int NOT NULL,
  `pay_mode` varchar(15) NOT NULL,
  `pay_date` date DEFAULT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Not Paid',
  PRIMARY KEY (`invoice_no`),
  KEY `f4` (`Cid`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`invoice_no`, `Cid`, `Amount`, `pay_mode`, `pay_date`, `status`) VALUES
(46, 16, 39000, 'upi', '2023-10-25', 'Paid'),
(48, 16, 56000, 'upi', NULL, 'Not Paid'),
(49, 16, 142000, 'upi', '2023-10-24', 'Paid'),
(50, 16, 50000, 'upi', '2023-10-25', 'Paid'),
(51, 15, 82000, 'upi', '2023-10-25', 'Paid'),
(52, 16, 81000, 'cod', NULL, 'Not Paid'),
(53, 16, 30000, 'cod', NULL, 'Not Paid'),
(54, 16, 30000, 'upi', '2023-11-05', 'Paid'),
(55, 16, 9000, 'upi', '2023-11-05', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `price` int NOT NULL,
  `description` varchar(50) NOT NULL,
  `cat_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qty` int UNSIGNED NOT NULL,
  `image1` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `image2` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `image3` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk1` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `cat_name`, `qty`, `image1`, `image2`, `image3`) VALUES
(30, 'Dell 3P', 30000, 'laptop by Dell', 'Laptop', 16, 'Dell 3p1.png', 'Dell 3p2.png', 'Dell 3p3.png'),
(33, 'hp laptop', 26000, 'laptop by hp', 'Laptop', 25, 'DELL laptop 1.png', 'DELL laptop 2.png', 'DELL laptop.png'),
(35, 'I Phone 13 Pro', 25000, 'Smartphone by Apple', 'Smartphone', 8, 'Sony LE1.png', 'Sony LE2.png', 'Sony LE3.png'),
(36, 'Apple Smart watch 13', 9000, 'Smartwatch by Apple', 'Watch', 17, 'apple watch 6(2).jpg', 'apple watch 6.jpg', 'apple watch 6.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`Cid`) REFERENCES `customer` (`Cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for` FOREIGN KEY (`id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `f` FOREIGN KEY (`id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `f2` FOREIGN KEY (`invoice_no`) REFERENCES `payment` (`invoice_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk` FOREIGN KEY (`Cid`) REFERENCES `customer` (`Cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `f4` FOREIGN KEY (`Cid`) REFERENCES `customer` (`Cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`cat_name`) REFERENCES `categories` (`cat_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
