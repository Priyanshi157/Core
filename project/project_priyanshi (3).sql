-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 10:14 AM
-- Server version: 8.0.27
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_priyanshi`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressId` int NOT NULL,
  `customerId` int NOT NULL,
  `address` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `postalCode` bigint NOT NULL DEFAULT '0',
  `city` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `state` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `country` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `billing` tinyint NOT NULL DEFAULT '2',
  `shiping` tinyint NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `customerId`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shiping`) VALUES
(166, 203, 'mgroad', 784521, 'dahod', 'guj', 'india', 1, 2),
(167, 203, 'mgroad', 784521, 'dahod', 'guj', 'india', 2, 1),
(168, 204, 'xyz', 784521, 'dahod', 'guj', 'india', 1, 2),
(169, 204, 'abcd', 784521, 'abcd', 'abcd', 'abcd', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` enum('1','2') NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `email`, `password`, `status`, `createdAt`, `updatedAt`) VALUES
(79, 'Priyanshi', 'Jain', 'priyanshi@gmail.com', '3def184ad8f4755ff269862ea77393dd', '1', '2022-03-28 22:03:04', '2022-04-04 23:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int NOT NULL,
  `customerId` int NOT NULL,
  `subTotal` int DEFAULT '0',
  `shipingMethod` varchar(28) DEFAULT NULL,
  `paymentMethod` varchar(28) DEFAULT NULL,
  `shipingCost` float DEFAULT NULL,
  `taxAmount` int NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `addressId` int NOT NULL,
  `cartId` int NOT NULL,
  `firstName` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(128) NOT NULL,
  `postalCode` bigint DEFAULT '0',
  `city` varchar(64) NOT NULL,
  `state` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT '2',
  `shiping` tinyint(1) NOT NULL DEFAULT '2',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `itemId` int NOT NULL,
  `cartId` int NOT NULL,
  `productId` int NOT NULL,
  `quantity` int NOT NULL,
  `itemTotal` float NOT NULL,
  `tax` int NOT NULL DEFAULT '0',
  `taxAmount` int NOT NULL DEFAULT '0',
  `discount` float DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `base` int DEFAULT NULL,
  `thumb` int DEFAULT NULL,
  `small` int DEFAULT NULL,
  `status` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '2',
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `parentId` int DEFAULT NULL,
  `path` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `base`, `thumb`, `small`, `status`, `createdAt`, `updatedAt`, `parentId`, `path`) VALUES
(88, 'Kitchen', 42, 41, 41, '1', '2022-03-03 12:03:29', '2022-03-09 03:03:48', NULL, '88'),
(90, 'bedroom', 43, 43, 43, '1', '2022-03-05 11:03:36', NULL, NULL, '90'),
(91, 'bed', NULL, NULL, NULL, '2', '2022-03-05 11:03:47', '2022-03-08 12:03:35', 90, '90/91'),
(94, 'living room', NULL, 74, 75, '1', '2022-03-09 08:03:23', NULL, NULL, '94'),
(96, 'Balcony', NULL, NULL, NULL, '2', '2022-03-09 08:03:50', '2022-03-12 01:03:18', 90, '90/96'),
(98, 'canopy', NULL, NULL, NULL, '1', '2022-03-09 09:03:15', '2022-03-09 09:03:31', 91, '90/91/98'),
(99, 'Double', NULL, NULL, NULL, '1', '2022-03-12 01:03:04', NULL, 91, '90/91/99'),
(100, 'Microwave', NULL, NULL, NULL, '1', '2022-03-12 06:03:21', '2022-04-04 11:04:00', 102, '88/102/100'),
(102, 'electronics', 46, 46, 49, '1', '2022-04-03 11:04:16', '2022-04-03 11:04:27', 88, '88/102');

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `mediaId` int NOT NULL,
  `categoryId` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `gallery` tinyint NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category_media`
--

INSERT INTO `category_media` (`mediaId`, `categoryId`, `name`, `gallery`) VALUES
(41, 88, '45_PM20220315121146.jpeg', 2),
(42, 88, '44_AM20220315121152.jpeg', 1),
(43, 90, '33_PM20220315123741.jpeg', 1),
(45, 102, 'download20220403112620.jpg', 1),
(46, 102, 'download20220403113022.jpg', 2),
(47, 88, 'download20220403113433.jpg', 2),
(48, 102, 'flower20220403114337.jpg', 2),
(49, 102, 'lotus20220403114406.jpg', 1),
(68, 100, 'flower20220404122110.jpg', 2),
(74, 94, 'download20220404124554.jpg', 1),
(75, 94, 'white20220404112231.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entityId` int NOT NULL,
  `productId` int NOT NULL,
  `categoryId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`entityId`, `productId`, `categoryId`) VALUES
(23, 37, 88),
(24, 37, 90),
(48, 38, 90),
(58, 39, 94),
(59, 42, 90),
(61, 43, 99),
(62, 31, 94);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(30) NOT NULL,
  `value` varchar(216) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '2',
  `salesmanId` int DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `salesmanId`, `createdAt`, `updatedAt`) VALUES
(203, 'priyanshi', 'jain', 'priyanshi@gmail.com', '7845129874', 1, NULL, '2022-04-05 01:04:44', '2022-04-05 01:04:03'),
(204, 'raj', 'jain', 'raj@gmail.com', '7845129874', 1, NULL, '2022-04-05 01:04:27', '2022-04-05 01:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entityId` int NOT NULL,
  `customerId` int NOT NULL,
  `productId` int NOT NULL,
  `price` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `addressId` int NOT NULL,
  `orderId` int NOT NULL,
  `firstName` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` bigint NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `postalCode` int NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT '2',
  `shiping` tinyint(1) NOT NULL DEFAULT '2',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`addressId`, `orderId`, `firstName`, `lastName`, `email`, `mobile`, `address`, `city`, `state`, `country`, `postalCode`, `billing`, `shiping`, `createdAt`) VALUES
(75, 58, 'priyanshi', 'jain', 'priyanshi@gmail.com', 7845129874, 'mgroad', 'dahod', 'guj', 'india', 784521, 1, 2, '2022-04-05 13:33:12'),
(76, 58, 'priyanshi', 'jain', 'priyanshi@gmail.com', 7845129874, 'mgroad', 'dahod', 'guj', 'india', 784521, 2, 1, '2022-04-05 13:33:12'),
(77, 59, 'raj', 'jain', 'raj@gmail.com', 7845129874, 'xyz', 'dahod', 'guj', 'india', 784521, 1, 2, '2022-04-05 13:36:30'),
(78, 59, 'raj', 'jain', 'raj@gmail.com', 7845129874, 'xyz', 'dahod', 'guj', 'india', 784521, 2, 1, '2022-04-05 13:36:30'),
(79, 60, 'priyanshi', 'jain', 'priyanshi@gmail.com', 7845129874, 'mgroad', 'dahod', 'guj', 'india', 784521, 1, 2, '2022-04-05 13:37:23'),
(80, 60, 'priyanshi', 'jain', 'priyanshi@gmail.com', 7845129874, 'mgroad', 'dahod', 'guj', 'india', 784521, 2, 1, '2022-04-05 13:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_comment`
--

CREATE TABLE `order_comment` (
  `commentId` int NOT NULL,
  `orderId` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `note` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customerNotified` tinyint(1) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_comment`
--

INSERT INTO `order_comment` (`commentId`, `orderId`, `status`, `note`, `customerNotified`, `createdAt`) VALUES
(3, 58, 1, 'Hello there', 1, '2022-04-05 13:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_data`
--

CREATE TABLE `order_data` (
  `orderId` int NOT NULL,
  `customerId` int NOT NULL,
  `firstName` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` bigint NOT NULL,
  `grandTotal` float NOT NULL,
  `taxAmount` int NOT NULL,
  `shipingId` int NOT NULL,
  `shipingCost` float NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `paymentId` int NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '2',
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_data`
--

INSERT INTO `order_data` (`orderId`, `customerId`, `firstName`, `lastName`, `email`, `mobile`, `grandTotal`, `taxAmount`, `shipingId`, `shipingCost`, `discount`, `paymentId`, `state`, `status`, `createdAt`) VALUES
(58, 203, 'priyanshi', 'jain', 'priyanshi@gmail.com', 7845129874, 47600, 2500, 1, 100, 5000, 1, 2, 1, '2022-04-05 13:33:46'),
(59, 204, 'raj', 'jain', 'raj@gmail.com', 7845129874, 375, 15, 2, 70, 10, 2, 2, 2, '2022-04-05 13:36:51'),
(60, 203, 'priyanshi', 'jain', 'priyanshi@gmail.com', 7845129874, 375, 15, 2, 70, 10, 2, 2, 2, '2022-04-05 13:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `itemId` int NOT NULL,
  `orderId` int NOT NULL,
  `productId` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT '0',
  `quantity` int NOT NULL,
  `tax` int NOT NULL DEFAULT '0',
  `taxAmount` int NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`itemId`, `orderId`, `productId`, `name`, `sku`, `price`, `discount`, `quantity`, `tax`, `taxAmount`, `createdAt`) VALUES
(50, 58, 38, 'Laptop', NULL, 50000, 5000, 1, 5, 2500, '2022-04-05 13:33:46'),
(51, 59, 31, 'Charger', NULL, 300, 10, 1, 5, 15, '2022-04-05 13:36:52'),
(52, 60, 31, 'Charger', NULL, 300, 10, 1, 5, 15, '2022-04-05 13:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `pageId` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `status` tinyint NOT NULL DEFAULT '2',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageId`, `name`, `code`, `content`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'Page1', 'Page1', 'Page1', 1, '2022-01-03 05:03:00', '2022-03-30 11:03:21'),
(2, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(3, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(4, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(13, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(14, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(15, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(16, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(18, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-03-12 15:03:02'),
(19, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(20, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(21, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(22, 'Page1', 'page1', 'page1', 1, '2022-01-03 05:03:00', '2022-09-03 06:03:00'),
(23, 'Page23', 'page23', 'page23', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Page24', 'page24', 'page24', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Page25', 'page25', 'page25', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Page26', 'page26', 'page26', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Page27', 'page27', 'page27', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Page28', 'page286', 'page28', 1, '0000-00-00 00:00:00', '2022-03-12 15:03:34'),
(30, 'Page30', 'page30', 'page30', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Page31', 'page31', 'page31', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Page32', 'page32', 'page32', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Page33', 'page33', 'page33', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Page34', 'page34', 'page34', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Page35', 'page35', 'page35', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Page36', 'page36', 'page36', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Page37', 'page37', 'page37', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Page38', 'page38', 'page38', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Page39', 'page39', 'page39', 1, '0000-00-00 00:00:00', '2022-03-14 14:03:38'),
(40, 'Page40', 'page40', 'page40', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Page41', 'page41', 'page41', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Page42', 'page42', 'page42', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Page43', 'page43', 'page43', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Page44', 'page44', 'page44', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Page45', 'page45', 'page45', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Page46', 'page46', 'page46', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Page47', 'page47', 'page47', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Page48', 'page48', 'page48', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Page49', 'page49', 'page49', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Page50', 'page50', 'page50', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Page51', 'page51', 'page51', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Page52', 'page52', 'page52', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Page53', 'page53', 'page53', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Page54', 'page54', 'page54', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Page55', 'page55', 'page55', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Page56', 'page56', 'page56', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Page57', 'page57', 'page57', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Page58', 'page58', 'page58', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Page59', 'page59', 'page59', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Page60', 'page60', 'page60', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Page61', 'page61', 'page61', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Page62', 'page62', 'page62', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Page63', 'page63', 'page63', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Page64', 'page64', 'page64', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Page65', 'page65', 'page65', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Page66', 'page66', 'page66', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Page67', 'page67', 'page67', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Page68', 'page68', 'page68', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Page70', 'page70', 'page70', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Page71', 'page71', 'page71', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Page72', 'page72', 'page72', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Page73', 'page73', 'page73', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Page74', 'page74', 'page74', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'Page75', 'page75', 'page75', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'Page76', 'page76', 'page76', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'Page77', 'page77', 'page77', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Page78', 'page78', 'page78', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Page79', 'page79', 'page79', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Page80', 'page80', 'page80', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Page81', 'page81', 'page81', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Page82', 'page82', 'page82', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Page83', 'page83', 'page83', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Page84', 'page84', 'page84', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Page85', 'page85', 'page85', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Page86', 'page86', 'page86', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Page87', 'page87', 'page87', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Page88', 'page88', 'page88', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Page89', 'page89', 'page89', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Page90', 'page90', 'page90', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Page91', 'page91', 'page91', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Page92', 'page92', 'page92', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Page93', 'page93', 'page93', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Page94', 'page94', 'page94', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Page95', 'page95', 'page95', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Page96', 'page96', 'page96', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Page97', 'page97', 'page97', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Page98', 'page98', 'page98', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'Page99', 'page99', 'page99', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Page176', 'page176', 'page176', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Page177', 'page177', 'page177', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Page178', 'page178', 'page178', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Page179', 'page179', 'page179', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Page180', 'page180', 'page180', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Page181', 'page181', 'page181', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Page182', 'page182', 'page182', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Page183', 'page183', 'page183', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Page184', 'page184', 'page184', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'Page185', 'page185', 'page185', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `methodId` int NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`methodId`, `name`) VALUES
(1, 'Debit/Credit'),
(2, 'UPI'),
(3, 'QR'),
(4, 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `base` int DEFAULT NULL,
  `thumb` int DEFAULT NULL,
  `small` int DEFAULT NULL,
  `price` float NOT NULL,
  `msp` int NOT NULL,
  `costPrice` int NOT NULL,
  `quantity` int NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `status` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '2',
  `createdAt` date NOT NULL,
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `sku`, `name`, `base`, `thumb`, `small`, `price`, `msp`, `costPrice`, `quantity`, `tax`, `discount`, `status`, `createdAt`, `updatedAt`) VALUES
(31, NULL, 'Charger', 20, 53, 20, 300, 250, 200, 200, '5', 10, '1', '2022-02-27', '2022-03-23'),
(37, NULL, 'Kitkat', 29, 29, 29, 10, 8, 6, 100, '5', 1, '1', '2022-03-09', '2022-03-23'),
(38, NULL, 'Laptop', NULL, NULL, NULL, 50000, 45000, 42000, 200, '5', 5000, '1', '2022-03-09', '2022-03-23'),
(39, NULL, 'Munch', NULL, NULL, 32, 10, 8, 6, 1000, '5', 0, '1', '2022-03-12', '2022-03-16'),
(42, NULL, 'Mouse', NULL, NULL, NULL, 15000, 12000, 10000, 10, '10', 1000, '1', '2022-03-23', '2022-03-23'),
(43, 'rhjdsnm', 'Perks', 48, 48, NULL, 100, 90, 80, 100, '2', 10, '2', '2022-04-04', '2022-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `mediaId` int NOT NULL,
  `productId` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `gallery` tinyint(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`mediaId`, `productId`, `name`, `gallery`) VALUES
(15, 6, '33_PM20220226114248.jpeg', 1),
(18, 7, '33_PM20220227060913.jpeg', 1),
(19, 7, '33_PM20220227060921.jpeg', 2),
(20, 31, '45_PM20220227061125.jpeg', 1),
(22, 34, '33_PM20220302110457.jpeg', 1),
(24, 33, '45_PM20220304022647.jpeg', 2),
(27, 35, '45_PM20220308115130.jpeg', 1),
(28, 8, '45_PM20220308115156.jpeg', 1),
(29, 37, '45_PM20220309124132.jpeg', 2),
(32, 39, '45_PM20220314104344.jpeg', 1),
(48, 43, 'blue20220404104944.jpg', 2),
(49, 43, 'flower20220404105022.jpg', 2),
(50, 43, 'purple20220404105335.jpg', 2),
(51, 43, 'white20220404105421.jpg', 2),
(52, 44, 'red20220404111755.jpg', 2),
(53, 31, 'lotus20220405120629.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesmanId` int NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `mobile` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `discount` float(5,2) NOT NULL DEFAULT '1.00',
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `discount`, `status`, `createdAt`, `updatedAt`) VALUES
(18, 'Priyanshi', 'jain', 'priyanshi@gmail.com', '7845124578', 10.00, 1, '2022-04-05 00:04:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shiping_method`
--

CREATE TABLE `shiping_method` (
  `methodId` int NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `charge` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shiping_method`
--

INSERT INTO `shiping_method` (`methodId`, `name`, `charge`) VALUES
(1, 'Same Day', 100),
(2, 'Express', 70),
(3, 'Normal', 50);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorId` int NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`) VALUES
(13, 'Priyanshi', 'lunawat', 'priyanshi@gmail.com', '7845124578', 2, '2022-03-01 12:03:36', '2022-03-04 12:03:55'),
(14, 'Prayas', 'Jain', 'prayas@gmail.com', '7845124578', 1, '2022-03-02 11:03:54', '2022-03-02 12:03:27'),
(17, 'raj', 'jain', 'raj@gmail.com', '7845124578', 1, '2022-03-12 06:03:44', '2022-03-12 06:03:50'),
(22, 'Priyanshi', 'Jain', 'priyanshi@gmail.com', '7845124578', 1, '2022-03-15 11:03:11', '2022-03-15 11:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `addressId` int NOT NULL,
  `vendorId` int NOT NULL,
  `address` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `postalCode` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `city` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `state` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `country` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`addressId`, `vendorId`, `address`, `postalCode`, `city`, `state`, `country`) VALUES
(3, 13, 'aambawadi', '784512', 'dahod', 'Gujrat', 'india'),
(4, 14, 'govindnagar', '784512', 'dahod', 'gujrat', 'india'),
(7, 17, 'abcd', '784512', 'xyz', 'xyz', 'india'),
(12, 22, 'aambawadi', '784512', 'dahod', 'Gujrat', 'india');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `customerid2` (`customerId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `cartid2` (`cartId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `cartid3` (`cartId`),
  ADD KEY `productid2` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `base_category` (`base`),
  ADD KEY `thumb_category` (`thumb`),
  ADD KEY `small_category` (`small`),
  ADD KEY `parentId` (`parentId`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `categoryId1` (`categoryId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `salesmanId1` (`salesmanId`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `customerId1` (`customerId`),
  ADD KEY `productId1` (`productId`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_comment`
--
ALTER TABLE `order_comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_data`
--
ALTER TABLE `order_data`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `base` (`base`),
  ADD KEY `thumb` (`thumb`),
  ADD KEY `small` (`small`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesmanId`);

--
-- Indexes for table `shiping_method`
--
ALTER TABLE `shiping_method`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorId`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `vendorId` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `addressId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `itemId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `mediaId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entityId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `addressId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `order_comment`
--
ALTER TABLE `order_comment`
  MODIFY `commentId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_data`
--
ALTER TABLE `order_data`
  MODIFY `orderId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `methodId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `mediaId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesmanId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shiping_method`
--
ALTER TABLE `shiping_method`
  MODIFY `methodId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `addressId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `customerid2` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cartid2` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cartid3` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productid2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `base_category` FOREIGN KEY (`base`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `parentId` FOREIGN KEY (`parentId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `small_category` FOREIGN KEY (`small`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `thumb_category` FOREIGN KEY (`thumb`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `categoryId` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `categoryId1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productId` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `salesmanId1` FOREIGN KEY (`salesmanId`) REFERENCES `salesman` (`salesmanId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD CONSTRAINT `customerId1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productId1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_data` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_comment`
--
ALTER TABLE `order_comment`
  ADD CONSTRAINT `order_comment_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_data` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_data`
--
ALTER TABLE `order_data`
  ADD CONSTRAINT `order_data_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_data` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `base` FOREIGN KEY (`base`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `small` FOREIGN KEY (`small`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `thumb` FOREIGN KEY (`thumb`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendorId` FOREIGN KEY (`vendorId`) REFERENCES `vendor` (`vendorId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
