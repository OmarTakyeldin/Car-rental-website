-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2023 at 05:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carNow`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `car_type` varchar(255) DEFAULT NULL,
  `car_name` varchar(255) DEFAULT NULL,
  `car_color` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `car_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `car_type`, `car_name`, `car_color`, `price`, `car_img`) VALUES
(1, 'Luxurious Car', 'Rolls Royce Phantom', 'Blue', '9800.00', '../VEHICLE_IMG/Rolls_Royce_Phantom_Blue.png'),
(2, 'Luxurious Car', 'Bentley Continental Flying Spur', 'White', '4800.00', '../VEHICLE_IMG/Bentley_Continental_Flying_Spur_White.png'),
(3, 'Luxurious Car', 'Mercedes Benz CLS 350', 'Silver', '1350.00', '../VEHICLE_IMG/Mercedes_Benz_CLS_350_Silver.png'),
(4, 'Luxurious Car', 'Jaguar S Type ', 'Champagne', '1350.00', '../VEHICLE_IMG/Jaguar_S_Type_Champagne.png'),
(5, 'Sports Car', 'Ferrari F430 Scuderia', 'Red', '6000.00', '../VEHICLE_IMG/Ferrari_F430_Scuderia_Red.png'),
(6, 'Sports Car', 'Lamborghini Murcielago LP640', 'Matte Black', '7000.00', '../VEHICLE_IMG/Lamborghini_Murcielago_LP640_Matte_Black.png'),
(7, 'Sports Car', 'Porsche Boxster', 'White', '2800.00', '../VEHICLE_IMG/Porsche_Boxster_White.png'),
(8, 'Sports Car', 'Lexus SC430 ', 'Black', '1600.00', '../VEHICLE_IMG/Lexus_SC430_Black.png'),
(9, 'Classic Car', 'Jaguar MK 2', 'White', '2200.00', '../VEHICLE_IMG/Jaguar_MK_2_White.png'),
(10, 'Classic Car', 'Rolls Royce Silver Spirit Limousine', 'Georgian Silver', '3200.00', '../VEHICLE_IMG/Rolls_Royce_Silver_Spirit_Limousine_Georgian_Silver.png'),
(11, 'Classic Car', 'MG TD', 'Red', '2500.00', '../VEHICLE_IMG/MG_TD_Red.png');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(255) DEFAULT NULL,
  `discount_amount` decimal(3,2) DEFAULT NULL,
  `last_changed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_name`, `discount_amount`, `last_changed`) VALUES
(34851, 'STAFFSPECIAL', '0.50', '2023-04-21 15:34:39'),
(70113, 'CARNOW', '0.01', '2023-04-21 15:34:31'),
(985968, 'HARIRAYA2023', '0.05', '2023-04-21 15:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `phone`, `email`, `last_updated`) VALUES
(83864, 'Donald', 'Trump', '60128829888', 'trum@mail.com', '2023-04-21 15:33:32'),
(535400, 'Gideon', 'Yong', '60123456789', 'gideonyth@gmail.com', '2023-04-21 15:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `total_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `last_changed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `customer_id`, `car_id`, `start_date`, `end_date`, `price`, `payment_status`, `total_paid`, `last_changed`) VALUES
(8242, 535400, 5, '2023-04-21', '2023-04-22', '6000.00', 1, '6000.00', '2023-04-21 15:32:03'),
(78999278, 83864, 10, '2023-04-15', '2023-04-16', '3200.00', 1, '3040.00', '2023-04-21 15:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `full_name`, `email`, `username`, `password`, `date`) VALUES
(16, 561588552, 'Gabriel Yong', 'gabrielyong@gmail.com', 'staff', 'password', '2023-04-21 15:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `support_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`support_id`, `first_name`, `last_name`, `email`, `reservation_id`, `title`, `description`, `last_updated`) VALUES
(4046, 'Bryan', 'Yeo', 'bryanyeo@gmail.com', NULL, 'New Booking', 'I want to book from may 1st for 2 days, any car is viable', '2023-04-21 15:14:24'),
(7877, 'Lebron', 'James', 'lbj@gmail.com', NULL, 'New Booking', 'gimme something luxurious, for the whole 2024 year.', '2023-04-21 15:21:01'),
(523311, 'Low', 'Jun Ee', 'lowjunee@gmail.com', NULL, 'New Booking', 'I want to a porche, for June, thanks.', '2023-04-21 15:19:28'),
(5490011, 'Ja', 'Morant', 'ja@gmail.com', NULL, 'New Booking', 'please give me your most expensive car.', '2023-04-21 15:24:25'),
(5683893, 'John', 'Doe', 'johndoe@example.com', NULL, 'New Booking', 'please let me choose between all your car models, email me your options and we can discuss there, i think we need a big car because i am bringing a family of 6, to go to a camping trip, let me know your terms and conditions as well, i am interested about your service.', '2023-04-21 15:16:56'),
(8688708, 'Donald', 'Trump', 'trump@mail.com', NULL, 'New Booking', 'rolls royce?', '2023-04-21 15:29:47'),
(37927982, 'Stephen', 'Curry', 'curry30@gmail.com', NULL, 'New Booking', 'I need something flashy, a lambo please', '2023-04-21 15:22:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `customerreservation_fk` (`customer_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`support_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `customerreservation_fk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
