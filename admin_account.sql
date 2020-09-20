-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2020 at 03:40 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL,
  `fname` varchar(225) NOT NULL,
  `lname` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `user_image` varchar(225) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `creation_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `update_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `fname`, `lname`, `email`, `username`, `password`, `user_image`, `isAdmin`, `creation_date`, `update_date`) VALUES
(39, 'Alumona', 'Micah', 'micahalumona@gmail.com', 'alumona1', '$2y$10$pN/z6DELTS2P.2PuK1iFjuJArm8Hlpl4CNK9a6uJ8Y9/Vr/Pkmtme', 'user_image/juno-jo-nwdPxI1h4NQ-unsplash.jpg', 0, '2020-09-20 09:51:32.890932', '2020-09-20 09:51:32.890932'),
(40, 'Alumona', 'Micah', 'micahalumona@gmail.com', 'kindness', '$2y$10$R43nLj4W3FhgM.4ANo/pF.AwPpKwLDbCI0ZH/83jWAtF2LSthcuay', 'user_image/imansyah-muhamad-putera-n4KewLKFOZw-unsplash.jpg', 0, '2020-09-20 09:52:56.430188', '2020-09-20 09:52:56.430188'),
(41, 'Deborah', 'Buky', 'alumonamicah@gmail.com', 'alumona1', '$2y$10$lN/ztpCI1icG9ZyhLdpoweA182fvLonFdqWpqqHeJmwOZNKbKEKNi', 'user_image/juno-jo-nwdPxI1h4NQ-unsplash.jpg', 0, '2020-09-20 10:01:44.153066', '2020-09-20 10:01:44.153066'),
(42, 'Deborah', 'Buky', 'deborah@gmail.com', 'alumona1', '$2y$10$20PoFZ93XoLZYQF2GeZbwOlZPfu7yqa9vOz1KlKyKKa9.nlnJelPO', 'user_image/juno-jo-nwdPxI1h4NQ-unsplash.jpg', 1, '2020-09-20 10:02:07.722520', '2020-09-20 10:02:07.722520'),
(43, 'israel', 'edos', 'constant@gmial.com', 'constant', '$2y$10$vkeNbO5zLY9COZEcL7oATeoQaGRUny3gVnBDNbTxMmnp2BvWvTFk2', 'user_image/juno-jo-nwdPxI1h4NQ-unsplash.jpg', 1, '2020-09-20 10:05:33.171438', '2020-09-20 10:05:33.171438'),
(44, 'Yemisy', 'Yemi', 'micahalumona@gmail.com', 'yemisi12', '$2y$10$PBkOxLe1tPlb8dXILHK7RuglLwiasDgHQTkZ8MFNZvjkWIc1Wnl12', 'user_image/juno-jo-nwdPxI1h4NQ-unsplash.jpg', 1, '2020-09-20 11:25:05.818514', '2020-09-20 11:25:05.818514'),
(45, 'Mark', 'Maluk', 'markey12@gmail.com', 'markey12', '$2y$10$f9CPamSUl5LyoG9e6OpOR.mqZRP1fkXyrmJm5Ri7BHKirPqxmhcDK', 'user_image/IMG_20191101_171057.jpg', 0, '2020-09-20 12:44:50.307686', '2020-09-20 12:44:50.307686'),
(46, 'Agbola', 'John', 'agbolajohn@gmail.com', 'agbola45', '$2y$10$FPlNI3wG0WH3ZTA15ClAy.JY36aBRQHWQoDImJvtGy1QyJsru8h7C', 'user_image/imansyah-muhamad-putera-n4KewLKFOZw-unsplash.jpg', 0, '2020-09-20 13:09:00.899123', '2020-09-20 13:09:00.899123'),
(47, 'Deborah', 'Otu', 'bukitosin@gmail.com', 'deborah2', '$2y$10$DxMpsT7SgMx5Gmx1jFpFVuE7Nm3vRAi4zlOLyYFj0nKROWXHcLhFO', 'user_image/juno-jo-nwdPxI1h4NQ-unsplash.jpg', 0, '2020-09-20 13:16:38.763001', '2020-09-20 13:16:38.763001'),
(48, 'Deborah', 'Otu', 'bukitosin@gmail.com', 'deborah2', '$2y$10$uWfyebZwhXDglHGBT1sG3OHmueyZfJRG.Ze6AWhVBO427LXD0x286', 'user_image/imansyah-muhamad-putera-n4KewLKFOZw-unsplash.jpg', 0, '2020-09-20 13:17:17.184979', '2020-09-20 13:17:17.184979');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
