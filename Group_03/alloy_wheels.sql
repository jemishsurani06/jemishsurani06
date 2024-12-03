-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 08:45 PM
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
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `alloy_wheels`
--

CREATE TABLE `alloy_wheels` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `generation` varchar(50) NOT NULL,
  `size` varchar(20) NOT NULL,
  `prize` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alloy_wheels`
--

INSERT INTO `alloy_wheels` (`id`, `name`, `make`, `model`, `generation`, `size`, `prize`, `description`, `quantity`) VALUES
(1, 'Argon', 'V1', 'Series-5', 'Sport', '20 x 9', 3600.00, 'The Argon\'s long sleek sporty spokes elegantly point to an integrated hub, available for most five-lug bolt patterns and offered in a wide offset range due to the utilization of our Cold Vertical Forging technology and our in-house CNC machining center.', 64),
(2, 'Custom', 'V1', 'Series-5', 'Sport', '20 x 10', 360.00, 'The Argon\'s long sleek sporty spokes elegantly point to an integrated hub, available for most five-lug bolt patterns and offered in a wide offset range due to the utilization of our Cold Vertical Forging technology and our in-house CNC machining center.', 50),
(3, 'Zephyr', 'V2', 'Series-6', 'Classic', '18 x 8', 3200.00, 'The Zephyr series offers a refined yet sporty design with precision engineering for maximum performance and durability.', 30),
(4, 'Horizon', 'V3', 'Series-7', 'Luxury', '19 x 9', 4000.00, 'The Horizon series blends luxury with performance, featuring bold lines and a unique design for the discerning driver.', 20),
(5, 'Nebula', 'V4', 'Series-8', 'Off-Road', '22 x 10', 4500.00, 'Designed for rugged terrain, the Nebula series provides superior strength and durability, ideal for off-road adventures.', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alloy_wheels`
--
ALTER TABLE `alloy_wheels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alloy_wheels`
--
ALTER TABLE `alloy_wheels`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
