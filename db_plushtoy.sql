-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2019 at 04:11 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_plushtoy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `role_id` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` int(20) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avata` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_ad` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `role_id`, `name`, `email`, `phone`, `address`, `password`, `avata`, `status`, `created_at`, `updated_ad`) VALUES
(9, ' 1', 'admin', 'admin@gmail.com', 1247578578, '1600 St. Clair Ave', '25d55ad283aa400af464c76d713c07ad', 'default-avatar.png', 1, '2017-05-05 09:22:24', '2017-05-05 02:22:24'),
(10, ' 2', 'vice', 'vice@gmail.com', 345678123, '1505 Portland Ave', '21232f297a57a5a743894a0e4a801fc3', 'Screenshot (10).png', 1, '2019-11-27 09:10:53', '2019-11-27 02:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` tinyint(4) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `title`, `icon`, `sort_order`, `status`, `created_at`) VALUES
(37, 0, 'Handcrafted', 'Handmade by love', NULL, 1, 1, '0000-00-00 00:00:00'),
(38, 0, 'Manufactured', 'Detailed-oriented', NULL, 2, 1, '0000-00-00 00:00:00'),
(40, 0, 'Second-hand', 'Good as new', NULL, 3, 1, '0000-00-00 00:00:00'),
(41, 0, 'Cruelty-free', 'Sustainable', NULL, 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--
DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(5) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `intro`, `content`, `image_link`, `status`, `created`) VALUES
(22, 'Discount Available', 'Plush toys are friends', '<p>Plush toys here are crafted to the finest.</p>\r\n\r\n<p> The material chosen are completely sustainable</p>', 'Screenshot_6.png', 1, '2019-11-20 18:56:21'),
(23, 'Shipping Inquiry', 'Children love plush toys', '<p>Our products are safe for children. We care about the valuable costs, so we donate 1$ for every purchase.</p>\r\n\r\n<p> You should feel free to donate more!</p>', 'Screenshot_17.png', 1, '2019-11-22 04:13:37'),
(24, 'sdfsfsf', 'sdfdsfsdfmm', '<p>hien</p>', 'Screenshot (8).png', 1, '2019-12-03 18:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `ordere`
--
DROP TABLE IF EXISTS `ordere`;
CREATE TABLE `ordere` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ordere`
--

INSERT INTO `ordere` (`id`, `product_id`, `qty`, `name`, `price`, `image`, `amount`, `transaction_id`, `status`, `created_at`) VALUES
(35, 50, 6, 'John Mckena ', 4000, 'dia-tu-tuoi.jpg', 24000, 44, 0, '2019-11-22 04:05:53'),
(37, 53, 1, 'Izzy Peterson', 750500, 'Screenshot_5.png', 750500, 46, 0, '2019-11-22 15:58:06'),
(38, 54, 3, 'For our daughter', 405000, 'Screenshot_7.png', 1215000, 47, 0, '2019-11-23 03:09:30'),
(39, 59, 5, 'Cute gifts', 554400, 'Screenshot_12.png', 2772000, 48, 0, '2019-11-24 14:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--
DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `sale` tinyint(4) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `hot` tinyint(4) DEFAULT 0,
  `buyed` int(5) DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `thunbar` varchar(255) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--


INSERT INTO `product` (`id`, `name`, `slug`, `price`, `sale`, `category_id`, `content`, `qty`, `hot`, `buyed`, `view`, `thunbar`, `status`, `created_at`, `updated_at`) VALUES
(48, 'Charming Teddy', 'Loving the concept.', 25, 0, 37, '<p><strong>Beautifully made.</strong></p>\r\n', 50, 1, NULL, NULL, 'Screenshot_2.png', '1', '2019-11-16 08:45:52', '2019-11-16 08:45:52'),
(49, 'Naught Teddy', 'Loving the concept.', 20, 10, 37, '<p>Made from China</p>\r\n', 20, 0, NULL, NULL, 'Screenshot_3.png', '1', '2019-11-20 11:45:19', '2019-11-20 11:45:19'),
(50, 'Teddy Bear Pink', 'Sustainability for the future', 39, 0, 37, '<p>Really attractive</p>\r\n', 200, 0, NULL, NULL, 'Screenshot_4.png', '1', '2019-11-20 11:46:33', '2019-11-20 11:46:33'),
(53, 'Kangaroo', 'Cuteness Overload', 79, 5, 37, '<p>Beautifully crafted.</p>\r\n', 69, 1, NULL, NULL, 'Screenshot_5.png', '1', '2019-11-22 04:11:26', '2019-11-22 04:11:26'),
(54, 'Pink Rabbit', 'Cuteness Overload', 45, 10, 38, '<p>Pink Rabbit&nbsp; One of A kind.</p>\r\n', 35, 0, NULL, NULL, 'Screenshot_7.png', '1', '2019-11-22 16:20:10', '2019-11-22 16:20:10'),
(55, 'Twin Sheep', 'Loving the concept', 32, 10, 38, '<p>One of a kind.&nbsp; Truly Amazing&#39;s Our best selling</p>\r\n', 200000, 0, NULL, NULL, 'Screenshot_8.png', '1', '2019-11-22 16:21:59', '2019-11-22 16:21:59'),
(56, 'Midnight Owl', 'Always cute', 32, 5, 38, '<p>So comfy So Pretty&#39;s Our best selling</p>\r\n', 280000, 0, NULL, NULL, 'Screenshot_9.png', '1', '2019-11-22 16:22:59', '2019-11-22 16:22:59'),
(57, 'Purple Rabit', 'Caring for you', 45, 5, 40, '<p>The best friend everyone wants.</p>\r\n\r\n<p>The Gardenia is an evergreen shrub native to regions of Africa, Asia and Australia, but its adaptability to the Japanese Art of Bonsai that&rsquo;s made it one of the most popular trees we sell.</p>', 23, 0, NULL, NULL, 'Screenshot_10.png', '1', '2019-11-22 16:23:58', '2019-11-22 16:23:58'),
(58, 'Pencil', 'Cuteness Overload', 32, 0, 40, '<p>Pencil loves everyone</p>\r\n', 45, 0, NULL, NULL, 'Screenshot_11.png', '1', '2019-11-22 16:25:21', '2019-11-22 16:25:21'),
(59, 'Pikachu', 'Loving the concept', 56, 0, 40, '<p>Take care of you.</p>', 35, 0, NULL, NULL, 'Screenshot_12.png', '1', '2019-11-22 16:26:37', '2019-11-22 16:26:37'),
(60, 'Teddy Bear Fluffy', 'So adorable', 45, 2, 40, '<p>Kindness and positivity</p>\r\n\r\n<p>Beautifully made</p>\r\n\r\n<p> Always make sure you are needed</p>\r\n\r\n<p>Limited Series</p>\r\n', 45, 0, NULL, NULL, 'Screenshot_14.png', '1', '2019-11-22 16:27:51', '2019-11-22 16:27:51'),
(61, 'Teddy Bear Brown', 'So adorable', 65, 30, 41, '<p> Little teddy loves everyone</p>', 18, 0, NULL, NULL, 'Screenshot_15.png', '1', '2019-11-22 16:31:13', '2019-11-22 16:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `permission`, `created_at`) VALUES
(1, 'Subper admin', 'Subper admin', 'all', '2017-03-14 06:43:56'),
(2, 'Admin', 'Admin', '', '2017-03-14 06:56:00'),
(3, 'John', 'ss', 'edit-news', '2019-11-26 16:25:18'),
(4, 'Elizabeth', 'yy', 'delete-order', '2019-11-27 02:00:18'),
(5, 'Elizabeth', 'yy', 'delete-order', '2019-11-27 02:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(5) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `name`, `email`, `address`, `phone`, `amount`, `message`, `active`, `created_at`) VALUES
(43, 'Elizabeth Kimberly', 'ekimberly@gmail.com', 'Vietnam', '00000928817228 ', 4500, NULL, 0, '2019-11-22 02:14:20'),
(44, 'Elizabeth Kimberly', 'ekimberly@gmail.com', 'Vietnam', '0928817228 ', 24000, NULL, 0, '2019-11-22 04:05:52'),
(46, 'Dana Folad', 'dfol@gmail.com', 'The Netherlands', ' 0388342522', 750500, 'Please leave at footstep, thank you!', 1, '2019-11-22 15:58:06'),
(47, 'Emma', 'emma@gmail.com', 'Italy', '0388342522 ', 1215000, NULL, 0, '2019-11-23 03:09:30'),
(48, 'Jim', 'jim@gmail.com', 'Japan', '0388342522 ', 2772000, NULL, 0, '2019-11-24 14:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role_id`, `name`, `email`, `password`, `phone`, `address`, `created_at`) VALUES
(9, NULL, 'Mariana Sorensen', 'msorensen@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0928817228', 'Sweden ', '2019-11-22 04:02:41'),
(10, NULL, 'Elizabeth', 'eliza@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0388342522', 'Denmark', '2019-11-22 16:07:19'),
(11, NULL, 'Joanne Johnson', 'jjohn@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0388342522', 'USA', '2019-11-24 14:07:09'),
(12, NULL, 'Elizabeth', 'eliza@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0388342522', 'Denmark', '2019-11-24 14:07:47'),
(13, NULL, 'Greg', 'greg@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '789', 'USA', '2019-11-25 03:43:20'),
(14, NULL, 'John', 'John@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', '0388342522', 'Vietnam', '2019-11-26 16:23:23'),
(15, NULL, 'Elizabeth', 'eliza@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '333', 'Denmark', '2019-11-27 01:59:37'),
(16, NULL, 'John', 'John@gmail.com', '380a767a3eb890d7f177538fabd023d6', '789', 'Vietnam', '2019-11-30 14:25:52'),
(17, NULL, 'Karl', 'karl@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '3456', 'USA', '2019-12-14 10:04:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `news` ADD FULLTEXT KEY `title` (`title`);

--
-- Indexes for table `ordere`
--
ALTER TABLE `ordere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ordere`
--
ALTER TABLE `ordere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordere`
--
ALTER TABLE `ordere`
  ADD CONSTRAINT `ordere_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordere_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
