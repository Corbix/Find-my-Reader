-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 07, 2020 la 12:04 PM
-- Versiune server: 10.1.38-MariaDB
-- Versiune PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `myreader`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `apreciate_books`
--

CREATE TABLE `apreciate_books` (
  `email` varchar(100) NOT NULL,
  `ISBN` varchar(50) NOT NULL,
  `liked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `books`
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
-- Structură tabel pentru tabel `books_users`
--

CREATE TABLE `books_users` (
  `email` varchar(100) NOT NULL,
  `ISBN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `denumire` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `genres`
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
-- Structură tabel pentru tabel `genres_users`
--

CREATE TABLE `genres_users` (
  `email` varchar(100) NOT NULL,
  `denumire` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `genres_users`
--

INSERT INTO `genres_users` (`email`, `denumire`) VALUES
('seby_cotoc98@yahoo.com', 'Children'),
('seby_cotoc98@yahoo.com', 'Drama'),
('seby_cotoc98@yahoo.com', 'Autobiography');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `notifications`
--

CREATE TABLE `notifications` (
  `to_user` varchar(100) NOT NULL,
  `from_user` varchar(100) NOT NULL,
  `state` varchar(20) NOT NULL,
  `time_sent` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
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
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `avatar`, `data_nasterii`, `description`, `google_account`, `last_latitude`, `last_longitude`) VALUES
(1, 'seby_cotoc98@yahoo.com', '6845104EB4AFC0532BA0BF5F0A665154F1BF742FA01D209FBE215AA8321910141785BFA2D562F2D423601F068536AED82D33B75B718207313D48CA20C4BC43E3', 'Sebastian', 'Cotoc', '1_test.jpg', '1998-04-21', '12321312saasdasdasfsdgsga', NULL, NULL, NULL),
(3, 'seby_bike@yahoo.com', '312B6DB61A37A2F1B126FA2C7976B613765EC577AE68577FE43771C12E1CA4549E376E04C91735AC446D664636AE5EE3150E9E076E649FAD18D0302BFBCF5669', 'Alin', 'Joshu', 'basic.jpg', NULL, NULL, NULL, NULL, NULL);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indexuri pentru tabele `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `denumire` (`denumire`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
