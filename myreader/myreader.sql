-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2020 at 11:11 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `books_users`
--

CREATE TABLE `books_users` (
  `email` varchar(100) NOT NULL,
  `ISBN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'seby_cotoc98@yahoo.com', 'sebaseba', 'Sebastian', 'Cotoc', '1_test.jpg', NULL, NULL, NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;