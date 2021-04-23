-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2021 at 06:53 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects2021_shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--
DROP TABLE IF EXISTS `recover_req`;
CREATE TABLE IF NOT EXISTS `recover_req` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `req_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `student_id`, `amount`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `account_track`
--

DROP TABLE IF EXISTS `account_track`;
CREATE TABLE IF NOT EXISTS `account_track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `pay_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_track`
--

INSERT INTO `account_track` (`id`, `student_id`, `amount`, `pay_date`) VALUES
(1, 1, 100, '2021-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'admin', 'admin@nu.com', '05555555', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `add_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `img` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--
INSERT INTO `category` (`id`, `name`, `img`) VALUES
(2, 'Stationery', 'Stationery.png'),
(1, 'Used Books', 'used books.png'),
(3, 'Books', 'books.png'),
(5, 'Printing', 'printing.jpg'),
(4, 'Technical Support', 'fixing.png'),
(6, 'Sunglasses', 'sunglasses.png'),
(7, 'Bags', 'bags.png'),
(8, 'Borrow Services', 'borrow.png');

-- --------------------------------------------------------

--
-- Table structure for table `debt_limit`
--

DROP TABLE IF EXISTS `debt_limit`;
CREATE TABLE IF NOT EXISTS `debt_limit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limit_amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debt_limit`
--

INSERT INTO `debt_limit` (`id`, `limit_amount`) VALUES
(1, 500);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `imgURL` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `item_type` int(11) NOT NULL COMMENT '1- product , 2- service',
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--
INSERT INTO `items` (`id`, `name`, `description`, `imgURL`, `price`, `item_type`, `category_id`) VALUES
(13, '30Sundays NAVIGATOR', 'Whether you are a classic aviator type or the kind of who goes wild, there is a pair of sunglasses out there for you by 30Sundays!', 'sun3.png', 70, 1, 6),
(12, 'Le Specs Last Lolita', 'Le Specs has become renowned globally for it is iconic and innovative sunglasses collections at an affordable price.', 'sun2.png', 80, 1, 6),
(4, 'Pens', 'Package Includes: 6 Non-Bleed Fine Point Pens (0.7mm)', 'pens.jpg', 5, 2, 2),
(5, 'Calculator', 'The Casio FX82AU PLUS II Scientific Calculator is ideal for students of all ages right through to university.', 'cal.jpg', 49, 2, 2),
(6, 'Eraser', 'Rubber Pencil on Paper', 'earasor.jpg', 3, 2, 2),
(7, 'Sharpaner', 'Keep your favourite pencils on point with this universal, custom-designed sharpener by Benefit.', 'sharpaner.jpg', 3, 2, 2),
(8, 'DataBase', 'the complete book', 'db.jpg', 100, 2, 3),
(9, 'Learn English', 'Learn English the right way from the very beginning and never look back!', 'en.jpg', 45, 2, 3),
(10, 'Computer Security', 'This book constitutes the refereed post-conference proceedings of the Interdisciplinary Workshop on Trust, Identity, Privacy, and Security in the Digital Economy', 'cs.jpg', 90, 2, 3),
(11, 'Sunglasses', 'The world-famous Le Specs brand boasts an innovative and stylish range of sunglasses and medical glasses at an affordable price.', 'sun1.png', 90, 1, 6),
(14, 'primary school bag', 'daily bag', 'bag1.jpg', 50, 1, 7),
(15, 'Leather bag', 'daily bag', 'bag2.jpg', 20, 1, 7),
(16, 'girl bag', 'daily bag', 'bag3.jpg', 30, 1, 7),
(17, 'Arts and Arab Liberation Skills', 'Completed pages, usable, used for 3 months, by Dr. Kamal Zafar Ali', 'lec1.jpg', 10, 2, 1),
(18, 'computer security lectures', 'All lectures of computer security course, clean, usable, by teacher nyal khadam', 'lec2.jpeg', 10, 2, 1),
(19, 'Operational Reseach lectures', 'All lectures of operational research course, clean, usable, by teacher Nora', 'lec3.jpeg', 10, 2, 1),
(20, 'Softwares Downloading', 'After you confirm the order, the library support will contact you on your phone number.', 'download.png', 5, 2, 4),
(21, 'laptop Repair', 'After you confirm the order, the library support will contact you on your phone number.', 'laptop.png', 5, 2, 4),
(22, 'printing lecture', 'After you confirm the order, the library support will contact you on your Email. One riyal for every five papers', 'paper.png', 1, 2, 5),
(23, 'Documents Scaning', 'After you confirm the order, the library support will contact you on your phone number or Email. One riyal for every paper', 'scan.jpg', 1, 2, 5),
(24, 'charger Borrow', 'After you confirm the order, the library support will contact you on your phone number or Email. One riyal for every hour', 'charg.png', 1, 2, 8),
(25, 'Laptop Borrow', 'After you confirm the order, the library support will contact you on your phone number or Email. One riyal for every hour', 'laptop2.jpg', 1, 2, 8);






-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `pay_method` int(11) NOT NULL COMMENT '0- cash , 1- account',
  `order_date` date NOT NULL,
  `total_amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `student_id`, `pay_method`, `order_date`, `total_amount`) VALUES
(2, 1, 1, '2021-03-17', 100),
(3, 1, 0, '2021-03-18', 100);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(2, 2, 2, 2, 50),
(3, 2, 2, 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE (`academic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `phone`, `password`, `academic_id`, `active`) VALUES
(1, 'shrooq', 'sh@yahoo.com', '0123456789', 'e10adc3949ba59abbe56e057f20f883e', 4105000, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
