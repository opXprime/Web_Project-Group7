-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 25, 2025 at 11:52 AM
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
-- Database: `admissions_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `programme_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `programme_id`, `student_name`, `email`, `submission_date`) VALUES
(3, 2, 'nn', 'hh@gmail.com', '2025-03-24 10:17:14'),
(4, 2, 'nn', 'hh@gmail.com', '2025-03-24 10:19:39'),
(5, 2, 'nn', 'hh@gmail.com', '2025-03-24 10:20:40'),
(6, 5, 'nn', 'hh@gmail.com', '2025-03-24 10:20:53'),
(7, 2, 'nn', 'hh@gmail.com', '2025-03-24 10:21:01'),
(8, 9, 'nn', 'hh@gmail.com', '2025-03-24 10:21:21'),
(9, 2, 'nn', 'hh@gmail.com', '2025-03-24 10:22:44'),
(10, 1, 'nn', 'hh@gmail.com', '2025-03-24 10:32:41'),
(11, 3, 'nn', 'hh@gmail.com', '2025-03-24 10:35:27'),
(12, 1, 'chut', 'schut@gmail.com', '2025-03-24 11:10:14'),
(13, 1, 'ram', 'hh@gmail.com', '2025-03-24 21:42:40'),
(14, 2, 'ram', 'hh@gmail.com', '2025-03-25 00:44:56'),
(15, 1, 'okY', 'alice@gmail.com', '2025-03-25 00:50:09'),
(17, 1, 'nIRANJAN', 'niranjangc975@gmail.com', '2025-03-25 10:07:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
