-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2020 at 09:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myreader`
--

-- --------------------------------------------------------

--
-- Table structure for table `apreciate_books`
--

CREATE TABLE `apreciate_books` (
  `email` varchar(100) NOT NULL,
  `ISBN` varchar(50) NOT NULL,
  `liked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `ISBN` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `an` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `ISBN`, `title`, `author`, `id_genre`, `an`) VALUES
(1, '9739223621', 'Baltagul', 'Mihail Sadoveanu', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `books_users`
--

CREATE TABLE `books_users` (
  `email` varchar(100) NOT NULL,
  `ISBN` varchar(50) NOT NULL,
  `time_add` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_users`
--

INSERT INTO `books_users` (`email`, `ISBN`, `time_add`) VALUES
('seby_cotoc98@yahoo.com', '9739223621', '2020-05-07 22:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `denumire` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `denumire`) VALUES
(1, 'Action and adventure'),
(2, 'Alternate history'),
(3, 'Anthology'),
(27, 'Art'),
(28, 'Autobiography'),
(29, 'Biography'),
(30, 'Book review'),
(4, 'Chick lit'),
(5, 'Children\'s'),
(6, 'Comic book'),
(7, 'Coming-of-age'),
(31, 'Cookbook'),
(8, 'Crime'),
(32, 'Diary'),
(33, 'Dictionary'),
(9, 'Drama'),
(34, 'Encyclopedia'),
(10, 'Fairytale'),
(11, 'Fantasy'),
(12, 'Graphic novel'),
(35, 'Guide'),
(36, 'Health'),
(13, 'Historical fiction'),
(37, 'History'),
(14, 'Horror'),
(38, 'Journal'),
(39, 'Math'),
(40, 'Memoir'),
(15, 'Mystery'),
(16, 'Paranormal romance'),
(17, 'Picture book'),
(18, 'Poetry'),
(19, 'Political thriller'),
(41, 'Prayer'),
(42, 'Religion, spirituality, and new age'),
(44, 'Review'),
(20, 'Romance'),
(21, 'Satire'),
(45, 'Science'),
(22, 'Science fiction'),
(46, 'Self help'),
(23, 'Short story'),
(24, 'Suspense'),
(43, 'Textbook'),
(25, 'Thriller'),
(47, 'Travel'),
(48, 'True crime'),
(26, 'Young adult');

-- --------------------------------------------------------

--
-- Table structure for table `genres_users`
--

CREATE TABLE `genres_users` (
  `email` varchar(100) NOT NULL,
  `denumire` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres_users`
--

INSERT INTO `genres_users` (`email`, `denumire`) VALUES
('seby_cotoc98@yahoo.com', 'Children'),
('seby_cotoc98@yahoo.com', 'Drama'),
('seby_cotoc98@yahoo.com', 'Autobiography');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `to_user` varchar(100) NOT NULL,
  `from_user` varchar(100) NOT NULL,
  `state` varchar(20) NOT NULL,
  `time_sent` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`to_user`, `from_user`, `state`, `time_sent`) VALUES
('seby_cotoc98@yahoo.com', 'galanandy400@yahoo.ro', 'confirmed', '2020-05-07 22:13:20'),
('galanandy400@yahoo.ro', 'seby_cotoc98@yahoo.com', 'pending', '2020-05-07 22:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `avatar` varchar(200) NOT NULL DEFAULT 'basic.jpg',
  `data_nasterii` date DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `google_account` varchar(100) DEFAULT NULL,
  `last_latitude` double DEFAULT NULL,
  `last_longitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `avatar`, `data_nasterii`, `description`, `google_account`, `last_latitude`, `last_longitude`) VALUES
(3, 'seby_bike@yahoo.com', '312B6DB61A37A2F1B126FA2C7976B613765EC577AE68577FE43771C12E1CA4549E376E04C91735AC446D664636AE5EE3150E9E076E649FAD18D0302BFBCF5669', 'Alin', 'Joshu', 'basic.jpg', NULL, NULL, NULL, NULL, NULL),
(4, 'galanandy400@yahoo.ro', '92FC29510DFACE38FB0963D1CE2C6187C4B3B945E1CC9897CCD87697B19742D21582912581318B58B3DFBC44694FC8166C5FC79D85D85F72AFB4E7ED81218C21', 'Georgescu', 'Andrew', 'basic.jpg', NULL, NULL, NULL, NULL, NULL),
(5, 'seby_cotoc98@yahoo.com', '92FC29510DFACE38FB0963D1CE2C6187C4B3B945E1CC9897CCD87697B19742D21582912581318B58B3DFBC44694FC8166C5FC79D85D85F72AFB4E7ED81218C21', 'Sebastian', 'Cotoc', 'basic.jpg', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `denumire` (`denumire`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
