-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 09:50 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book store`
--
CREATE DATABASE IF NOT EXISTS `book store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `book store`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(10) UNSIGNED NOT NULL,
  `city` int(10) NOT NULL,
  `street_name` varchar(20) NOT NULL,
  `postal_code` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `city`, `street_name`, `postal_code`) VALUES
(30, 2, 'deshmoret', 2000),
(16, 2, 'dino kalenja', 1023),
(28, 2, 'kruje', 2000),
(12, 2, 'Ndre Mjeda', 1001),
(8, 2, 'Ndre Mjeda', 1023),
(10, 2, 'Siri kodra', 1000),
(29, 3, 'deshmoret', 2000),
(11, 3, 'durresi st', 2000),
(27, 3, 'Ndre Mjeda', 1023),
(24, 3, 'shullaz ', 1003),
(31, 4, 'deshmoret', 2000),
(13, 4, 'Kruja', 1501),
(26, 4, 'Ndre Mjeda', 1023),
(32, 4, 'ndre mjeda', 1501),
(22, 4, 'rruga shullaz', 1000),
(25, 4, 'shullaz burgy', 9000),
(23, 5, 'dino kalenja', 7010),
(14, 5, 'korca city', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(10) UNSIGNED NOT NULL,
  `author_name` varchar(20) NOT NULL,
  `author_surname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_surname`) VALUES
(8, 'Carls', 'Dikens'),
(2, 'Erdion', 'Hoxha'),
(9, 'Ernest', 'Hemingway'),
(11, 'Franc', 'Kafka'),
(3, 'Ismail', 'Kadare'),
(4, 'JK', 'Rowling'),
(10, 'Mark', 'Twain'),
(5, 'Naim', 'Frasheri'),
(7, 'Viktor', 'Canosinaj'),
(12, 'William', 'Shakespear'),
(6, 'Zhyl', 'Verni');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ISBN` bigint(13) UNSIGNED NOT NULL,
  `book_name` varchar(30) NOT NULL,
  `publishing_house_id` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `publishing_date` smallint(4) NOT NULL,
  `quantity` int(6) UNSIGNED NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `FK_book_category_id` int(11) NOT NULL,
  `book_cover` varchar(300) NOT NULL,
  `book_file` varchar(300) NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ISBN`, `book_name`, `publishing_house_id`, `price`, `publishing_date`, `quantity`, `description`, `FK_book_category_id`, `book_cover`, `book_file`, `author_id`) VALUES
(1223232657654, 'liber i vjeter', 4, 121, 1999, 25, 'pershkrim test', 5, 'parrot_and_olivier_in_america.jpg', 'ebook.pdf', 5),
(3798127389222, 'liber prove', 2, 100, 2000, 10, 'donefir', 2, 'IMG_3531.JPG', 'Hyrje ne Octave.7.pdf', 11),
(4238479832232, 'knfiernigjr', 3, 33, 2000, 2, 'lkerknfre', 3, 'A1Pim60eMZL.jpg', 'Seanca3.pdf', 9),
(4239874983278, 'ermali', 3, 783, 1999, 10, 'foenrfiure', 2, 'Chomsky-T02967.png', '8.pdf', 3),
(4792837498327, 'liber', 2, 100, 2000, 10, 'kncerjbfr', 1, 'lost_decades.large_.jpg', 'mvc.pdf', 9),
(4823874673827, 'jfkjer fkj re', 3, 30, 1999, 20, 'nfckjbe kfrb', 1, 'psychopath-test.jpg', '7.pptx.pdf', 3),
(4823874983288, 'erindi', 3, 38, 1990, 8, 'jncirje f r', 4, 'wall_street.jpg', 'SharedViews.pdf', 11);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`category_id`, `category_name`) VALUES
(1, 'Drame'),
(2, 'Sport'),
(3, 'Novele'),
(4, 'Roman'),
(5, 'Poezi'),
(6, 'Fanta-shkence'),
(7, 'Komedi');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_provider` varchar(20) NOT NULL,
  `card_number` int(16) NOT NULL,
  `card_type` varchar(20) NOT NULL,
  `expiry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chair_user`
--

CREATE TABLE `chair_user` (
  `chair_user_number` int(10) UNSIGNED NOT NULL,
  `chair_number` int(3) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reservation_time` tinyint(2) NOT NULL,
  `termination_time` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chair_user`
--

INSERT INTO `chair_user` (`chair_user_number`, `chair_number`, `user_id`, `reservation_time`, `termination_time`) VALUES
(48, 20, 59, 16, 17),
(49, 20, 59, 17, 18),
(50, 26, 59, 16, 17),
(51, 21, 59, 17, 18);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(10) NOT NULL,
  `city_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(3, 'Durres'),
(5, 'Korce'),
(4, 'Kruje'),
(2, 'Tirane');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) UNSIGNED NOT NULL,
  `User_Id` int(10) UNSIGNED NOT NULL,
  `card_provider` varchar(20) DEFAULT NULL,
  `Total` decimal(10,0) NOT NULL,
  `Tax` decimal(10,0) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `User_Id`, `card_provider`, `Total`, `Tax`, `date`) VALUES
(5, 65, NULL, '33', '7', '2022-05-14'),
(6, 65, NULL, '30', '6', '2022-05-14'),
(7, 65, NULL, '138', '28', '2022-05-14'),
(8, 59, NULL, '1105', '221', '2022-05-28'),
(9, 68, NULL, '783', '157', '2022-05-29'),
(10, 65, NULL, '121', '24', '2022-05-29'),
(11, 65, NULL, '121', '24', '2022-05-29'),
(12, 68, NULL, '100', '20', '2022-05-29'),
(13, 65, NULL, '100', '20', '2022-05-29'),
(14, 65, NULL, '38', '8', '2022-05-29'),
(15, 59, NULL, '100', '20', '2022-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(10) UNSIGNED NOT NULL,
  `address_Id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `birthday` date DEFAULT NULL,
  `role` enum('user','admin','worker') NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `address_Id`, `name`, `surname`, `email`, `password`, `birthday`, `role`, `IsDeleted`) VALUES
(59, 8, 'Erdion', 'Hoxha', 'erdion_hoxha@yahoo.com', '$2y$10$rzxFpFbMNTBukg8pu3HNI.3wIoF..q.8eumRvE11HK8t6mMAmVmyq', '2000-07-30', 'admin', 0),
(60, 32, 'ermal', 'cerhozi', 'ermal@gmail.com', '$2y$10$RFBvCeXLqb/Ck5WiGreBnOdPrnTdMf6oGhwtfS3duCYBSOGYxwa36', '2000-10-10', 'worker', 0),
(65, 31, 'Ilir', 'Hoxha', 'erdion.hoxha@fshnstudent.info', '$2y$10$7e9.2W1sGFj8vAYQ.ruRDOXAvuUXKQe1vjcsTf3sK.sjRVd8tYLQe', '2001-10-08', 'user', 0),
(66, 13, 'ermal', 'cerhozi', 'arlinda.profi@fshn.edu.al', '$2y$10$zxjwwMnlrbng7FxLw.hkOuikbSPygp3Iinph4Kriu6Mj8Hlq2A1Mu', '2000-10-10', 'worker', 0),
(68, 8, 'Bujar', 'Hoxha', 'bujarhoxha@yahoo.com', '$2y$10$Y/luIh/m7QjtMVlGhOaLouCl.3sfKYuYGCan5JWeK1fHTIHsFCaZ2', '2000-10-10', 'user', 0),
(69, 8, 'prove', 'prove', 'prove@gmail.com', '$2y$10$M3whUsvXrNZRZ/BL6oQB/e0yGKiuBeuBB0Cmfjc2PZVshzCuVpGXi', '2001-10-10', 'user', 0),
(70, 8, 'test', 'test', 'arlinda1.profi@fshn.edu.al', '$2y$10$ow6AAJMnwctZppEMe2Ae3ed215UwSoHL1tU0RpZ2zwp0j/sKCX4GG', '2000-10-10', 'user', 0),
(72, 25, 'Ermali', 'Cerhoz', 'ermal.cerhozi3@gmial.com', '$2y$10$XCdCVjjIysBPUg8HLrevw.bdU14ZabdYgPfomqAJcmHWshh6rjZ42', '1999-10-10', 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `publishing_house`
--

CREATE TABLE `publishing_house` (
  `publishing_house_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publishing_house`
--

INSERT INTO `publishing_house` (`publishing_house_id`, `name`) VALUES
(1, 'Albas'),
(2, 'Omsca'),
(3, 'Tona'),
(4, 'Arberia'),
(5, 'M&B'),
(6, 'Sara'),
(7, 'Rubin'),
(8, 'Uegen'),
(9, 'Omsca'),
(10, 'Tona'),
(11, 'Arberia'),
(12, 'M&B'),
(13, 'Sara'),
(14, 'Rubin'),
(15, 'Uegen');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_book`
--

CREATE TABLE `shopping_cart_book` (
  `ShopingCartBookId` int(10) NOT NULL,
  `ISBN_shoppingCart` bigint(13) UNSIGNED NOT NULL,
  `User_id` int(10) UNSIGNED NOT NULL,
  `Payment_id` int(10) UNSIGNED DEFAULT NULL,
  `actual_price` decimal(10,0) NOT NULL,
  `IsBought` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_cart_book`
--

INSERT INTO `shopping_cart_book` (`ShopingCartBookId`, `ISBN_shoppingCart`, `User_id`, `Payment_id`, `actual_price`, `IsBought`) VALUES
(16, 4238479832232, 65, 5, '33', 1),
(25, 1223232657654, 59, 8, '121', 1),
(26, 4238479832232, 59, 8, '33', 1),
(27, 4239874983278, 59, 8, '783', 1),
(28, 4792837498327, 59, 8, '100', 1),
(29, 4823874673827, 59, 8, '30', 1),
(30, 4823874983288, 59, 8, '38', 1),
(34, 1223232657654, 65, 11, '121', 1),
(37, 3798127389222, 65, 13, '100', 1),
(38, 4823874983288, 65, 14, '38', 1),
(39, 3798127389222, 59, 15, '100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(10) UNSIGNED NOT NULL,
  `subscription_name` varchar(30) NOT NULL,
  `type` enum('monthly','quarter_annual','semi_annual','annual') NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `amount_of_sale` tinyint(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscription_id`, `subscription_name`, `type`, `price`, `amount_of_sale`) VALUES
(1, 'giga-semi-annual', 'quarter_annual', 1000, 30),
(2, 'giga-month', 'monthly', 100, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_subscription`
--

CREATE TABLE `user_subscription` (
  `person_id` int(10) UNSIGNED NOT NULL,
  `subscription_id` int(10) UNSIGNED NOT NULL,
  `purchase_price` int(10) UNSIGNED NOT NULL,
  `amount_of_sale_at_purchase` tinyint(2) UNSIGNED NOT NULL,
  `subscription_start_date` date NOT NULL,
  `subscription_finish_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_subscription`
--

INSERT INTO `user_subscription` (`person_id`, `subscription_id`, `purchase_price`, `amount_of_sale_at_purchase`, `subscription_start_date`, `subscription_finish_date`) VALUES
(59, 1, 1000, 30, '2022-05-30', '2022-08-30'),
(65, 1, 1000, 30, '2022-05-14', '2022-08-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `city` (`city`,`street_name`,`postal_code`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`),
  ADD UNIQUE KEY `author_name` (`author_name`,`author_surname`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `publishing_house_FK` (`publishing_house_id`),
  ADD KEY `category_id_FK` (`FK_book_category_id`),
  ADD KEY `author_id_FK` (`author_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_number`);

--
-- Indexes for table `chair_user`
--
ALTER TABLE `chair_user`
  ADD PRIMARY KEY (`chair_user_number`),
  ADD KEY `person_id_FK` (`user_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD UNIQUE KEY `city_name` (`city_name`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `FK_card_provider` (`card_provider`),
  ADD KEY `User_id_FK_Pament` (`User_Id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `publishing_house`
--
ALTER TABLE `publishing_house`
  ADD PRIMARY KEY (`publishing_house_id`);

--
-- Indexes for table `shopping_cart_book`
--
ALTER TABLE `shopping_cart_book`
  ADD PRIMARY KEY (`ShopingCartBookId`),
  ADD KEY `USer_id_FK` (`User_id`),
  ADD KEY `ISBN_FK` (`ISBN_shoppingCart`),
  ADD KEY `Payment_ID_FK` (`Payment_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `user_subscription`
--
ALTER TABLE `user_subscription`
  ADD PRIMARY KEY (`subscription_id`,`person_id`) USING BTREE,
  ADD KEY `person_id` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chair_user`
--
ALTER TABLE `chair_user`
  MODIFY `chair_user_number` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `publishing_house`
--
ALTER TABLE `publishing_house`
  MODIFY `publishing_house_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shopping_cart_book`
--
ALTER TABLE `shopping_cart_book`
  MODIFY `ShopingCartBookId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `city_FK` FOREIGN KEY (`city`) REFERENCES `city` (`city_id`);

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `author_id_FK` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `category_id_FK` FOREIGN KEY (`FK_book_category_id`) REFERENCES `book_category` (`category_id`),
  ADD CONSTRAINT `publishing_house_FK` FOREIGN KEY (`publishing_house_id`) REFERENCES `publishing_house` (`publishing_house_id`) ON UPDATE CASCADE;

--
-- Constraints for table `chair_user`
--
ALTER TABLE `chair_user`
  ADD CONSTRAINT `person_id_FK` FOREIGN KEY (`user_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `User_id_FK_Pament` FOREIGN KEY (`User_Id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `shopping_cart_book`
--
ALTER TABLE `shopping_cart_book`
  ADD CONSTRAINT `ISBN_FK` FOREIGN KEY (`ISBN_shoppingCart`) REFERENCES `book` (`ISBN`),
  ADD CONSTRAINT `Payment_ID_FK` FOREIGN KEY (`Payment_id`) REFERENCES `payment` (`payment_id`),
  ADD CONSTRAINT `USer_id_FK` FOREIGN KEY (`User_id`) REFERENCES `person` (`person_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
