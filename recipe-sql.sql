-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2018 at 01:46 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `review` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `name`, `type`, `price`, `country`, `image`, `review`) VALUES
(1, 'Katsu don', 'Main', 18.5, 'Japan', 'Images/Recipe/katsudon.jpg', 'Katsudon is a popular Japanese food, a bowl of rice topped with a deep-fried pork cutlet, egg, vegetables, and condiments.'),
(2, 'Patbingsu', 'Dessert', 10, 'Korea', 'Images/Recipe/patbingsu.jpg', 'Patbingsu is a popular Korean shaved ice dessert with sweet toppings that may include chopped fruit, condensed milk, fruit syrup, and red beans.'),
(3, 'Bruschetta', 'Appetizer', 3.25, 'Italy', 'Images/Recipe/bruschettaa.jpg', 'Bruschetta is an antipasto from Italy consisting of grilled bread rubbed with garlic and topped with olive oil and salt. '),
(4, 'Poutine', 'Appetizer', 4.2, 'Canada', 'Images/Recipe/poutine.jpg', 'Poutine is a dish originating from the Canadian province of Quebec consisting of French fries and cheese curds topped with a brown gravy.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
