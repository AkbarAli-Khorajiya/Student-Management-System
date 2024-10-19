-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 02:02 PM
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
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `status` tinyint(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'First Year', 1, '2024-02-24 14:30:34', '2024-02-24 14:30:34'),
(2, 'Second Year', 1, '2024-02-24 14:30:34', '2024-02-24 14:30:34'),
(3, 'Third Year', 1, '2024-02-24 14:30:34', '2024-02-24 14:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'BCOM', 0, '2024-02-23 05:49:00', '2024-02-23 05:49:00'),
(3, 'BCA', 1, '2024-02-23 05:49:09', '2024-02-23 05:49:09'),
(6, 'BSC', 1, '2024-02-24 18:06:13', '2024-02-24 18:06:13'),
(8, 'ITI', 1, '2024-02-28 09:44:40', '2024-02-28 09:44:40'),
(13, 'BA', 1, '2024-03-04 04:37:15', '2024-03-04 04:37:15'),
(14, 'BBA', 0, '2024-07-25 12:11:12', '2024-07-25 12:11:12'),
(15, 'BA', 0, '2024-10-19 11:49:33', '2024-10-19 11:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `village` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pincode` int(6) NOT NULL,
  `course_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `mname`, `lname`, `email`, `mobile`, `village`, `city`, `state`, `country`, `pincode`, `course_id`, `class_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Mohammad', 'Abid', 'Suthar', 'mohd@gmail.com', '7623290830', 'Shekhpur', 'Mahesana', 'Gujarat', 'India', 323282, 3, 2, 1, '2024-02-24 19:41:24', '2024-02-24 19:41:24'),
(5, 'AkbarAli', 'Mustak Ali', 'Khorajiya', 'akbarali123@gmail.com', '9768897567', 'Badargadh', 'Palanpur', 'Gujarat', 'India', 546125, 3, 2, 1, '2024-02-24 19:50:00', '2024-02-24 19:50:00'),
(7, 'Akbar Ali', 'MustakAli', 'Khorajiya', 'abbas@gmail.com', '9574737398', 'Badargadh', 'Palanpur', 'Gujarat', 'India', 385410, 3, 3, 0, '2024-02-25 05:39:23', '2024-02-25 05:39:23'),
(8, 'Rais', 'Habib', '', 'rais@gmail.com', '9768897567', 'Ddf', 'Df', 'Df', 'India', 787878, 3, 1, 1, '2024-02-25 13:32:39', '2024-02-25 13:32:39'),
(10, 'talib', 'Habib', 'Khorajiya', 'rais@gmail.com', '9768897567', 'Badargadh', 'Palanpur', 'Gujarat', 'India', 385410, 2, 1, 1, '2024-02-26 08:50:44', '2024-02-26 08:50:44'),
(11, 'Yusuf', 'Yunus', 'Varaliya', 'akbmus2004@gmail.com', '9898989898', 'Sherpura', 'Vadgham', 'Gujarat', 'India', 546125, 8, 3, 1, '2024-02-26 08:59:45', '2024-02-26 08:59:45'),
(13, 'Mustak', 'Abid', 'Manasiya', 'akb@gmail.com', '9768897567', 'Sherpura', 'Palanpur', 'Gujarat', 'India', 385410, 6, 2, 1, '2024-02-26 10:07:54', '2024-02-26 10:07:54'),
(14, 'Akbar Ali', 'Yunus', 'Varaliya', 'akbarali123@gmail.com', '9898989898', 'Sherpura', 'Vadgham', 'Gujarat', 'India', 323232, 8, 1, 1, '2024-02-26 10:21:17', '2024-02-26 10:21:17'),
(15, 'Akbar Ali', 'Yunus', 'Varaliya', 'akbadadadasd@gmail.com', '3232323223', 'Badargadh', 'Palanpur', 'Gujarat', 'India', 767667, 6, 2, 0, '2024-02-29 15:20:56', '2024-02-29 15:20:56'),
(16, 'Sssas', 'Asas', 'Asasa', 'asa@gmail.com', '2121121212', 'SASAS', 'Sasasas', 'Sasasas', 'Sasasas', 0, 3, 1, 1, '2024-03-01 14:33:37', '2024-03-01 14:33:37'),
(17, 'Akbar Ali', 'Asas', 'Aaa', 'akbarali123@gmail.com', '9767676767', 'SASAS', 'Sasasas', 'Sasasas', 'Sasasas', 767667, 3, 3, 1, '2024-07-25 12:12:39', '2024-07-25 12:12:39'),
(18, 'Akbar Ali', 'Mustak Ali', 'Varaliya', 'akbarali123@gmail.com', '5656565656', 'Keshimpa', 'Mehsana', 'Gujarat', 'Sasasas', 323232, 8, 1, 1, '2024-07-25 12:42:29', '2024-07-25 12:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `village` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fname`, `mname`, `lname`, `email`, `mobile`, `village`, `city`, `state`, `country`, `pincode`, `course_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Mohammad', 'AkbarAli', 'Khorajiya', 'mhd@gmail.com', '7623090030', 'Sedrana', 'Sidhpur', 'Gujarat', 'India', 323282, 3, 0, '2024-02-27 16:31:30', '2024-02-27 16:31:30'),
(3, 'AbbasAli', 'MustakAli', 'Khorajiya', 'sb@gmail.com', '7623090030', 'Badargadh', 'Palanpur', 'Gujarat', 'India', 385410, 3, 0, '2024-02-27 16:32:47', '2024-02-27 16:32:47'),
(4, 'Rais', 'Habib', 'Manasiya', 'rais@gmail.com', '9768897567', 'Badargadh', 'Vadgham', 'Gujarat', 'India', 385410, 8, 1, '2024-02-27 17:06:18', '2024-02-27 17:06:18'),
(6, 'Rais', 'AkbarAli', 'Khorajiya', 'akb@gmail.com', '9898989898', 'Sherpura', 'Palanpur', 'Gujarat', 'India', 767667, 2, 1, '2024-02-28 13:58:23', '2024-02-28 13:58:23'),
(8, 'Akbar Ali', 'Mustak Ali', 'Varaliya', 'rais@gmail.com', '9574737390', 'Sherpura', 'Vadgham', 'Gujarat', 'India', 767667, 6, 0, '2024-02-29 18:01:43', '2024-02-29 18:01:43'),
(9, 'Mohammad', 'Hasan', 'Dhukka', 'mm@gmail.com', '9898989898', 'Sherpura', 'Palanpur', 'Gujarat', 'India', 767667, 6, 1, '2024-02-29 18:06:48', '2024-02-29 18:06:48'),
(10, 'Akbar Ali', 'Habib', 'Vvc', 'akb@gmail.com', '9767676767', 'Keshimpa', 'Mehsana', 'Gujarat', 'India', 323232, 2, 0, '2024-02-29 18:45:39', '2024-02-29 18:45:39'),
(11, 'Shabbir', 'Ismail', 'Kharodiya', 'akb@gmail.com', '9574737390', 'Badargadh', 'Palanpur', 'Gujarat', 'India', 767667, 6, 1, '2024-02-29 18:46:55', '2024-02-29 18:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'AkbarAli', 'admin@gmail.com', '$2y$10$A34ue.vX.ei1PlpTLZaI5.tqnARJsb/tGWwZU9KESBLmXzdhvbwya', 1, '2024-10-19 11:38:10', '2024-10-19 11:38:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
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
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
