-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 07, 2025 at 07:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foods`
--

CREATE TABLE `tbl_foods` (
  `id` int(10) UNSIGNED NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_foods`
--

INSERT INTO `tbl_foods` (`id`, `food_name`, `category_id`, `price`, `description`, `image`, `created_at`) VALUES
(15, 'Burger', NULL, 99.00, 'Delicious crispy burger with fresh veggies and cheese', 'barger.jpg', '2025-03-09 05:52:15'),
(16, 'Chaumin', NULL, 120.00, 'Spicy and tasty noodles with vegetables', 'chaumin.jpg', '2025-03-09 05:52:15'),
(17, 'Idly', NULL, 80.00, 'Soft and fluffy South Indian idli served with chutney', 'idely.jpg', '2025-03-09 05:52:15'),
(18, 'Momos', NULL, 150.00, 'Steamed dumplings filled with spicy stuffing', 'momos.jpg', '2025-03-09 05:52:15'),
(19, 'Biryani', NULL, 200.00, 'Aromatic basmati rice cooked with flavorful spices', 'biryaani.jpg', '2025-03-09 05:52:15'),
(20, 'Manchurian', NULL, 130.00, 'Crispy fried balls in spicy Manchurian sauce', 'manchurian.jpg', '2025-03-09 05:52:15'),
(21, 'Pasta', NULL, 140.00, 'Creamy and cheesy Italian pasta', 'pasta.jpg', '2025-03-09 05:52:15'),
(22, 'Pizza', NULL, 250.00, 'Cheese-loaded Italian pizza with toppings', 'pizza.jpg', '2025-03-09 05:52:15'),
(23, 'Samosa', NULL, 30.00, 'Crispy fried pastry stuffed with spicy potato filling', 'samosa.jpg', '2025-03-09 05:52:15'),
(24, 'Sandwich', NULL, 90.00, 'Grilled sandwich with veggies and sauces', 'sandwich.jpg', '2025-03-09 05:52:15'),
(25, 'Maggi', NULL, 50.00, 'Delicious and spicy instant noodles', 'maggi.jpg', '2025-03-09 06:00:11'),
(29, 'Chocolate Coated Biscuits', NULL, 180.00, 'Delicious biscuits coated with rich chocolate', 'ChocolateCoatedBiscuits.webp', '2025-03-09 06:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `costomer_name` varchar(150) NOT NULL,
  `costomer_contact` varchar(20) NOT NULL,
  `costomer_email` varchar(150) NOT NULL,
  `costomer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `costomer_name`, `costomer_contact`, `costomer_email`, `costomer_address`) VALUES
(1, 'Chaumin', 120, 5, 600, '2025-03-30 07:12:11', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(2, 'Momos', 150, 5, 750, '2025-03-30 07:18:07', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(3, 'Burger', 99, 1, 99, '2025-03-30 07:44:48', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(4, 'Samosa', 30, 3, 90, '2025-04-02 09:04:12', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(5, 'Chaumin', 120, 2, 240, '2025-04-02 09:25:33', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(6, 'Food Item', 0, 1, 0, '2025-04-02 09:26:19', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(7, 'Maggi', 50, 1, 50, '2025-04-05 09:50:20', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(8, 'Chaumin', 120, 1, 120, '2025-04-09 06:39:26', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(9, 'Food Item', 0, 1, 0, '2025-04-09 09:50:18', 'Pending', 'maya', '8269002121', 'maya@gmail.com', 'pune'),
(10, 'Food Item', 0, 1, 0, '2025-04-09 09:59:15', 'Pending', 'maya', '8269002121', 'maya@gmail.com', 'pune'),
(11, 'Food Item', 0, 1, 0, '2025-04-09 10:01:49', 'Pending', 'maya', '8269002121', 'maya@gmail.com', 'pune'),
(12, 'Chaumin', 120, 2, 240, '2025-04-10 06:04:47', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(13, 'Pizza', 250, 3, 750, '2025-04-10 21:45:47', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(14, 'Momos', 150, 2, 300, '2025-04-10 21:46:42', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(15, 'Idly', 80, 2, 160, '2025-04-11 08:57:14', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'Kolkata'),
(16, 'Pizza', 250, 2, 500, '2025-04-13 06:55:30', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'amlai'),
(17, 'Biryani', 200, 3, 600, '2025-04-13 08:02:22', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'amlai'),
(18, 'Samosa', 30, 1, 30, '2025-04-18 09:16:40', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'amlai'),
(19, 'Chaumin', 120, 1, 120, '2025-04-21 07:16:39', 'Pending', 'ronny gupta', '9329265824', 'pradhyumngupta437@gmail.com', 'amlai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_type` enum('customer','admin') DEFAULT 'customer',
  `profile_pic` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `profile_image` varchar(255) DEFAULT 'default.png',
  `two_factor_enabled` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `password`, `phone`, `address`, `created_at`, `user_type`, `profile_pic`, `profile_image`, `two_factor_enabled`) VALUES
(6, 'ronny gupta', 'pradhyumngupta437@gmail.com', '$2y$10$2gppKpL.dhQXxii/d/u6SOxWDlEU23yFO3q.KwnQGZZFgNSKTP6ou', '9329265824', 'amlai', '2025-03-29 06:13:22', 'customer', 'default.jpg', 'default.png', 0),
(7, 'rocky', 'rockygupta43@gamil.com', '$2y$10$zovQugjDeD8roZqAiYxbu.aqjRQ5kmZBLEZHYMQm5gQPN9ZiEUnKO', '08269002121', 'delhi', '2025-03-29 07:49:05', 'customer', 'default.jpg', 'default.png', 0),
(10, 'maya', 'maya@gmail.com', '$2y$10$bRtGy6WIE5ZMKM9vJMkZ8uXc8Y8bIdUGsbizCxmpUArF.2Z6/s5lS', '8269002121', 'pune', '2025-04-09 04:46:55', 'customer', 'default.jpg', 'default.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_foods`
--
ALTER TABLE `tbl_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_foods`
--
ALTER TABLE `tbl_foods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
