-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 19, 2025 at 11:28 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_pivot`
--

DROP TABLE IF EXISTS `cart_pivot`;
CREATE TABLE IF NOT EXISTS `cart_pivot` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `item_count` int NOT NULL,
  `price` int NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

--
-- Dumping data for table `cart_pivot`
--

INSERT INTO `cart_pivot` (`id`, `user_id`, `product_id`, `item_count`, `price`, `create_at`) VALUES
(5, 2, 37, 4, 20000000, '2025-09-17 20:08:25'),
(3, 1, 37, 2, 20000000, '2025-09-17 11:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb3_persian_ci NOT NULL,
  `title_english` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `title_english`) VALUES
(6, 'پرینتر', 'printer'),
(5, 'دیجیتال', 'digital');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment_body` text COLLATE utf8mb3_persian_ci NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `comment_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment_body`, `user_id`, `product_id`, `comment_id`) VALUES
(12, 'قیمت این موبایل چقدره؟', 1, 37, 0),
(13, 'ok', 5, 37, 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE IF NOT EXISTS `password_reset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token_hash` varchar(255) COLLATE utf8mb3_persian_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `user_id`, `token_hash`, `expires_at`) VALUES
(15, 4, 'ec32a1e70a7fb508887ed27d8d0097492d9cccb14d5502ffc6ca864f679f74c5583022762ef5ff07026d8c8acf10bfd64f76d996f37b41133d378999751b3d0a', '2025-09-12 19:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `price` int NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL DEFAULT 'درحال انجام',
  `authority` varchar(100) COLLATE utf8mb3_persian_ci NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb3_persian_ci NOT NULL,
  `description` text COLLATE utf8mb3_persian_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb3_persian_ci NOT NULL,
  `count` int NOT NULL,
  `price` bigint NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `count`, `price`, `category_id`) VALUES
(37, 'galaxy a55 sumsung', 'nice', '../img/kala.png', 5, 20000000, 6),
(38, 'لپتاپ', 'اچ پی و اقتصادی', '../img/kala2.png', 2, 3000000, 5),
(39, 'مینی کیس استوک', 'باپردازنده قوی', '../img/kala3.png', 3, 40000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_likes`
--

DROP TABLE IF EXISTS `product_likes`;
CREATE TABLE IF NOT EXISTS `product_likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8mb3_persian_ci NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

--
-- Dumping data for table `product_likes`
--

INSERT INTO `product_likes` (`id`, `type`, `user_id`, `product_id`, `create_at`) VALUES
(18, 'like', 2, 37, '2025-09-16 23:09:12'),
(17, 'like', 1, 37, '2025-09-16 15:19:03'),
(15, 'like', 1, 39, '2025-09-16 12:03:42'),
(16, 'deslike', 1, 38, '2025-09-16 12:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb3_persian_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb3_persian_ci NOT NULL,
  `last_login` datetime NOT NULL,
  `ip` varchar(200) COLLATE utf8mb3_persian_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb3_persian_ci NOT NULL DEFAULT 'public_user',
  `remember_token` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `profile` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL DEFAULT '../user_profile/logo_user.jpg',
  `biography` varchar(100) COLLATE utf8mb3_persian_ci NOT NULL DEFAULT 'سلام این یک بیوگرافی هست',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ussername` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `last_login`, `ip`, `status`, `remember_token`, `profile`, `biography`) VALUES
(1, 'torki', '$2y$10$VNPrabo4ajWwsTDQnAFdru4qFbeR1yJbhjWvK2zb16idk/JUY/Tju', 'torki@gmail.com', '2025-09-19 13:03:28', '::1', 'public_user', '', '../user_profile/profile_68c9bd90525224.93451960kala.png', 'سلام'),
(2, 'alireza', '$2y$10$JvBhens2brj4LHEitb8VJ.X4oT67NB3GPvz2APbu3zeZ7VwbcDtP.', 'alireza123@gmail.com', '2025-09-17 20:03:31', '::1', 'public_user', '', '	../user_profile/logo_user.jpg	', 'سلام این یک بیوگرافی هست'),
(6, 'a', '$2y$10$HvWvtlJ2jUNv05RnL2YLU.jNJTgwYHYLWMXPzFxKxNsY/EzmZHS2C', 'test@gmail.com', '0000-00-00 00:00:00', 'نامشخص(وارد شده توسط ادمین)', 'public_user', '', '	../user_profile/logo_user.jpg	', 'سلام این یک بیوگرافی هست'),
(5, 'admin', '$2y$10$QOdFyNuBva0Xrve8hcWPKOEjuZnMEV0JqqrA.WOzuH7SKxidLgVL2', 'admin@gmail.com', '2025-09-19 13:05:01', '::1', 'admin', '', '../user_profile/profile_68c941be946374.06549192kala3.png', 'سلام من ادمین سایت هستم');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
CREATE TABLE IF NOT EXISTS `user_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb3_persian_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb3_persian_ci NOT NULL,
  `province` varchar(50) COLLATE utf8mb3_persian_ci NOT NULL,
  `address` text COLLATE utf8mb3_persian_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb3_persian_ci NOT NULL,
  `code_post` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `full_name`, `city`, `province`, `address`, `phone`, `code_post`) VALUES
(7, 1, 'mohamad', 'esfahan', 'esfahan', 'address', '09907393873', '2222222222'),
(6, 1, 'ali', 'tehran', 'tehran', 'address', '09904444444', '1111111111'),
(8, 1, 'hoosein', 'tabriz', 'tabriz', 'user address', '09142222222', '2222222222');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
