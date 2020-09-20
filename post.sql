-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2020 at 03:39 PM
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
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `author` text NOT NULL,
  `body` text NOT NULL,
  `date_created` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `image` varchar(225) NOT NULL,
  `userId` int(11) NOT NULL,
  `author_image` varchar(225) DEFAULT NULL,
  `date_updated` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `author`, `body`, `date_created`, `image`, `userId`, `author_image`, `date_updated`) VALUES
(276, 'MAKING MONEY', 'Iserel', 'The hotel management system is an Android Mobile based user application developed for process of booking the hotel that leads to increased efficiency and reduce drawbacks that were present in the previous as well as present booking facilities as well as management strategy of various hotel. The system is an Android application developed via the Android Studio which is very flexible and convenient, also has an attractive user interface that promotes portability as users i.e. customers as well as the hotel management can directly deal with hotel facilities with a portable android phone. The system is an ideal software solution for Hospitality Industry that can be used at hotels, motels, inns, resorts, lodges, hostel, military guest house, ranch, suites, apartments, medical centres and bed, breakfast operations. \r\nIn addition to hotel management, this project also helps customers in booking, reservation, ordering foods etc. This project is developed using JAVA, scratch and JavaScript.  \r\n         ', '2020-09-20 10:08:54.153642', 'img_upload/3D GEAOMETRY LOGO.jpg', 43, 'user_image/juno-jo-nwdPxI1h4NQ-unsplash.jpg', '2020-09-20 10:08:54.153642'),
(277, 'MAKING MONEY', 'Iserel', 'Towards the end of this project, the goal is to transform specific requirements identified during each phase of the system into a detailed system architecture which is feasible, robust and bring value to the organization and to the world as a whole. Also, to provide a functional and complete system.', '2020-09-20 11:04:06.957054', 'img_upload/bantersnaps-9o8YdYGTT64-unsplash.jpg', 43, 'user_image/juno-jo-nwdPxI1h4NQ-unsplash.jpg', '2020-09-20 11:04:06.957054'),
(278, 'MAKING MONEY', 'Iserel', 'Towards the end of this project, the goal is to transform specific requirements identified during each phase of the system into a detailed system architecture which is feasible, robust and bring value to the organization and to the world as a whole. Also, to provide a functional and complete system.', '2020-09-20 11:04:29.780827', 'img_upload/bantersnaps-9o8YdYGTT64-unsplash.jpg', 43, 'user_image/juno-jo-nwdPxI1h4NQ-unsplash.jpg', '2020-09-20 11:04:29.780827'),
(279, 'BEST COOK', 'YEMISI', 'GOALS INTENDED TO ACHIEVE\r\n\r\n\r\n\r\n\r\nTowards the end of this project, the goal is to transform specific requirements identified during each phase of the system into a detailed system architecture which is feasible, robust and bring value to the organization and to the world as a whole. Also, to provide a functional and complete system.\r\n                    ', '2020-09-20 11:25:56.946393', 'img_upload/kimberly-farmer-lUaaKCUANVI-unsplash.jpg', 44, 'user_image/juno-jo-nwdPxI1h4NQ-unsplash.jpg', '2020-09-20 11:25:56.946393');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `admin_account` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
