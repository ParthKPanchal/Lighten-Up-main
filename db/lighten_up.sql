-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2025 at 07:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lighten_up`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
('BcjKNX58e4x7bIqIvxG7', 'ajayinfo', 'Ajayinfo@123'),
('F5x7PWflgxUmRa5XeWJT', 'ParthPanchal', '123'),
('eepeo1rZri6Ky2ztZsMW', 'neelam', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `number`, `message`) VALUES
('a4AV8kVnm0zsMoBYhkAK', 'Parth Panchal', 'panchalparth93@yahoo.in', '7303513231', 'Testing message to check its working or not from contact us page'),
('eaLd6Cxvoc5yRx5LpipI', 'Parth Panchal', 'panchalparth93@yahoo.in', '7303513231', 'hii');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(20) NOT NULL,
  `admin_id` varchar(20) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` varchar(10) NOT NULL,
  `color` varchar(10) NOT NULL,
  `size` varchar(10) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `product_material` varchar(50) NOT NULL,
  `product_manufacturer` varchar(50) NOT NULL,
  `available` varchar(3) NOT NULL DEFAULT 'no',
  `rated` varchar(3) NOT NULL DEFAULT 'no',
  `installation` varchar(3) NOT NULL DEFAULT 'no',
  `warranty` varchar(3) NOT NULL DEFAULT 'no',
  `image_01` varchar(50) NOT NULL,
  `image_02` varchar(50) NOT NULL,
  `image_03` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `admin_id`, `product_name`, `product_price`, `color`, `size`, `product_brand`, `product_material`, `product_manufacturer`, `available`, `rated`, `installation`, `warranty`, `image_01`, `image_02`, `image_03`, `date`, `category`) VALUES
('xkzK0LDsQxAisf5wHYIg', 'F5x7PWflgxUmRa5XeWJT', 'Crompton Silent Pro Blossom Smart Ceiling Fan', '16,999.00', 'Blue', '48', 'Crompton', 'Premium ABS Plastic', 'Crompton Greaves Consumer Electricals Limited', 'on', 'on', 'on', 'on', 'cBx1e2zDbChN6EwJU3tB.png', '5F0OhWj3KPvbu9Q4WmRK.png', 'B8j63slpSFs2p3Flfchx.png', '2025-08-26', 'Fan'),
('V4ucuuLJzMLAlT05NPHe', 'F5x7PWflgxUmRa5XeWJT', 'Crompton Silent Pro Blossom Smart Ceiling Fan', '16,999.00', 'White', '56', 'Crompton', 'Premium ABS Plastic', 'Crompton Greaves Consumer Electricals Limited', 'on', 'on', 'on', 'on', '63nKYXanZ2j6zAMvvkqb.png', 'gjqjZ36e5knkARcmf0uv.png', 'txRVERZYRBpfKadjD0be.png', '2025-08-26', 'Fan'),
('mrM5EAGdDPTTSaUFnZcT', 'F5x7PWflgxUmRa5XeWJT', 'Crompton Silent Pro Blossom Smart Ceiling Fan', '16,999.00', 'Brown', '56', 'Crompton', 'Premium ABS Plastic', 'Crompton Greaves Consumer Electricals Limited', 'on', 'on', 'on', 'on', 'DEBK1jmRrL4VoGK08HPQ.png', 'q5fAEhyCNU81x0KpiI1W.png', 'bbyp6BAHQZd3oboGhMgb.png', '2025-08-26', 'Fan'),
('wp8DWWoPV9Kv3Jhhp8ft', 'F5x7PWflgxUmRa5XeWJT', 'Crompton Premion Aura 2 Designer 1 Star', '6,529.00', 'White', '48', 'Crompton', 'Premium Aluminium', 'Crompton Greaves Consumer Electricals Limited', 'on', 'on', 'on', 'on', '486L142qxU10Q9iiChRK.png', 'egNsEbszkopkjX3I33Df.png', 'JanlooqrU4q0iOC5WrsC.png', '2025-08-26', 'Fan'),
('xYZE7sIN13DXbm65lWPE', 'F5x7PWflgxUmRa5XeWJT', 'Crompton High Speed HS | Star Rated Ceiling Fan', '3,519.00', 'White', '48', 'Crompton', 'Premium Aluminium', 'Crompton Greaves Consumer Electricals Limited', 'off', 'on', 'on', 'on', '7fO8tMLsGKk5KLxwSnxb.png', 'w1JsRVvGHEcOFGM2lpy3.png', '9Zi4xFoAbRWWsK2ueCmc.png', '2025-08-26', 'Fan'),
('8RXCou3oxSi1wchq54up', 'F5x7PWflgxUmRa5XeWJT', 'Crompton High Speed HS | Star Rated Ceiling Fan', '3,519.00', 'Brown', '48', 'Crompton', 'Premium Aluminium', 'Crompton Greaves Consumer Electricals Limited', 'on', 'on', 'on', 'on', 'OYFaxggnOcbkpr9Ob2oU.png', 'VpGG7kkUBgJ35HjVFWzD.png', 'hvZ4prbCH4QwgIqULmff.png', '2025-08-26', 'Fan'),
('vKG5nheC4XYNS6jp0YiH', 'F5x7PWflgxUmRa5XeWJT', 'TRIO PANEL 15W ROUND C+W', '1,400.00', 'White', '48', 'TRIO', 'Premium ABS Plastic', 'Crompton Greaves Consumer Electricals Limited', 'on', 'on', 'off', 'on', 'cFG032do0J5e3e6v8tCW.png', 'aEF6jMGhk8IEUSQko8LG.png', 'EB3EIy1MtRk8bQ2omMLI.png', '2025-08-26', 'Light'),
('jKxmaMfsIVUSaEOVlw1x', 'F5x7PWflgxUmRa5XeWJT', '9W Star Deepglaze Round Led Downlighter', '500.00', 'White', '48', 'Star Deepglaze', 'Premium ABS Plastic', 'Crompton Greaves Consumer Electricals Ltd', 'on', 'on', 'off', 'off', 'T6bazSgoBJWRW1mzsKqf.png', 'suUSCyFtmUyU87anSbFN.png', 'c0ltFqYxQtmTduc7YFSG.png', '2025-08-26', 'Light'),
('fTU4eZb0OcjouvEFu1BJ', 'F5x7PWflgxUmRa5XeWJT', '50W Star Miranda Round Led COB', '6,599.00', 'White', '48', 'Star Miranda', 'Premium ABS Plastic', 'Crompton Greaves Consumer Electricals Ltd', 'on', 'on', 'off', 'on', 'pUKJiUrmDdejbSCSgbE6.png', 'Q55kZ8wjqpjiRnZMuzBX.png', 'SodymdqbYVXiD9CwBMmu.png', '2025-08-26', 'Light');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `product_id`, `sender`, `receiver`, `date`) VALUES
('Cr3ePW3QjUi9Qvn1cLFr', 'xkzK0LDsQxAisf5wHYIg', 'ZOJnGSQRclpXt0AHmlHH', 'F5x7PWflgxUmRa5XeWJT', '2025-08-26'),
('yJ7uUrzLvoHjainDSu9s', 'jKxmaMfsIVUSaEOVlw1x', 'ZOJnGSQRclpXt0AHmlHH', 'F5x7PWflgxUmRa5XeWJT', '2025-08-29'),
('cLTRTCr81TERghTV11pZ', 'fTU4eZb0OcjouvEFu1BJ', 'ZOJnGSQRclpXt0AHmlHH', 'F5x7PWflgxUmRa5XeWJT', '2025-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved`
--

INSERT INTO `saved` (`id`, `product_id`, `user_id`) VALUES
('mnugyqZIsIr8FYtyiGAe', 'xkzK0LDsQxAisf5wHYIg', 'ZOJnGSQRclpXt0AHmlHH'),
('qQPVLpiEyXBbWIwDPIwS', 'V4ucuuLJzMLAlT05NPHe', 'ZOJnGSQRclpXt0AHmlHH'),
('TRkwttHigbxeqBc7a6Pq', 'jKxmaMfsIVUSaEOVlw1x', 'ZOJnGSQRclpXt0AHmlHH');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `email`, `password`) VALUES
('ZOJnGSQRclpXt0AHmlHH', 'Arjun Panchal', '9821290938', 'parth.ajayinfo@gmail.com', '2cfe534aa66900e81f6f20b02826b6132d2df8de'),
('DQqgrUxxjcbREUBiojTd', 'Parth Panchal', '7303513231', 'panchalparth93@yahoo.in', '280dbe18646284d100c1e6b54a3f191966ba5e6d');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
