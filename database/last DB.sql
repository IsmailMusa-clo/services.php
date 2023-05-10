-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 06:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `services`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `email`, `avatar`, `timestamp`) VALUES
(4, 'admin', '$2y$10$GhxEc2a7rqnltu0WoFptGu60MQ5bIKWHXcb7bAMsZKXHIcOQ/DHTa', 'admin@gmail.com', 'WhatsApp Image 2023-04-11 at 9.54.42 AM.jpeg', '2023-04-14'),
(18, 'ma@s.c', '$2y$10$PO94YxQw4hAVmyHabL8vheXrp6TzX2uvaoqolu2HEpINZS/KQZ6eO', 'm@s', 'Lighthouse.jpg', '2023-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

CREATE TABLE `catagories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`id`, `name`, `image`, `timestamp`) VALUES
(3, 'صيانة سيارات', '5275.jpg', '2023-04-25'),
(4, 'بناء', '1280865.jpg', '2023-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `email`, `password`) VALUES
(3, 'mmm', 'm@e', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `price` float NOT NULL,
  `status` enum('pending','paid') NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username`, `phone`, `email`, `address`, `emp_id`, `price`, `status`, `timestamp`) VALUES
(3, 'أحمد سالم', '9746132543', 'ahmedsalem@gmail.com', 'gezan', 4, 50, 'pending', '2023-04-25'),
(4, 'guest', '978987654', 'guest@gmail.com', 'gezan', 6, 700, 'paid', '2023-04-25'),
(8, 's', '1', 's@s', 'v', 11, 1, 'pending', '2023-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `rate_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `rate`, `rate_id`) VALUES
(2, 9, 4),
(3, 3, 4),
(4, 8, 4),
(5, 10, 6),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `desc`, `image`, `category_id`, `timestamp`) VALUES
(2, 'كهرباء سيارات', 'يقوم من خلالها بصيانة الكهرباء الخاصة بالسيارات الحديثة ', 'سيارات كبيرة.png', 3, '2023-04-25'),
(3, 'ميكانيكا سيارات', 'نقوم من خلالها بصيانة السيارات ميكانيكا وخصوصا السيارات المنزلية', 'screen-0.webp', 3, '2023-04-25'),
(4, 'تبليط', 'نقوم من خلالها بعمل بلاط سيراميك خاص بالمباني ', '329144255_1665523710529015_7919938475935031447_n.jpg', 4, '2023-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `services_id` bigint(20) NOT NULL,
  `service_price` float NOT NULL,
  `rating` float NOT NULL DEFAULT 0,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone`, `email`, `address`, `avatar`, `services_id`, `service_price`, `rating`, `timestamp`) VALUES
(4, 'ahmed', '$2y$10$ba4oVmI39pH2Ud6mhxQZHO36pXyAl9nJgwOt18F3xLcv84gq3RxZS', '987456321', 'ahmed@gmail.com', 'gezan', '1280865.jpg', 3, 50, 2, '2023-04-25'),
(5, 'عبدلي', '$2y$10$msFPSyeNghb1x1dAw9Mas.pjKmxBKDFapQzyzv4/swWovlpyq6xcu', '789654251', 'abed@gmail.com', 'alruyad', '2023-03-24T101721Z_1777864454_RC2A00AIQFBA_RTRMADP_3_UKRAINE-CRISIS-PUTIN-SECURITY.webp', 2, 800, 2, '2023-04-25'),
(6, 'khaled', '$2y$10$rL6W6l6VpgbCfCcaXon4k.nM1cPdWojwsg8IErtMeQqQEqlHHfvc.', '9874561321', 'khaled@gmail.com', 'gezan', 'تنزيل.jfif', 4, 300, 2, '2023-04-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_rate` (`rate_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `catagories`
--
ALTER TABLE `catagories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `user_rate` FOREIGN KEY (`rate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
