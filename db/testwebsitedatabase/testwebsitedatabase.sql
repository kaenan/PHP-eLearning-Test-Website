-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2023 at 12:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testwebsitedatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` char(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `admin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `DOB`, `create_date`, `admin`) VALUES
(2, 'test1', '$2y$10$AD1eNgNzTc25Vp/SZ2ytXO2NM8pKIlujJWXneGT7Wa/nZL9LQU0VO', 'test1@gmail.com', '2001-05-15', '2023-07-12', b'0'),
(3, 'kaenan1', '$2y$10$stp1kmWiV.8KiCCpQFxfvuDVYpldIic0jjNKGEmfRcOQkLHhAbKP6', 'kaenan1@email.com', '2001-05-10', '2023-07-12', b'1'),
(10, 'kaenan2', '$2y$10$NNMSqjotil36qBOhW0kNjOTLLbTMFX38lipSWDSWZz1thLpq.cmKy', 'email2@email.com', '2001-05-15', '2023-07-12', b'0'),
(11, 'test3', '$2y$10$Ut4M6hgj7xfkXCZ/wUVaYuQOo.aI3GdW1duSlII0WXD8QfE4wD86W', 'test3@email.com', '2011-05-15', '2023-07-12', b'0'),
(12, 'test4', '$2y$10$pFNnRGgOPWJ54sfGFQ7efu8pSUny.q4m2IAOSnCnoUQ0yML/.qX3O', 'email4@gmail.com', '2001-05-15', '2023-07-12', b'0'),
(13, 'test5', '$2y$10$PvQ77p7Wd1uvGjFGsgc79OryOtr56aHl.d6g/LOxZJgRBA/CfZI1O', 'email5@gmail.com', '2001-05-15', '2023-07-12', b'0'),
(14, 'test9', '$2y$10$fNlRTpkZHus8LSundBBnhulztg09y9oArfdoWr/8xEuxOur09SZL6', 'test9@email.com', '2001-05-15', '2023-07-12', b'0'),
(15, 'test10', '$2y$10$f9pcwC4rMc5VxibioOl.leu3vEIJzb2w0DdSGdxEK5L.aeHDflzvm', 'email10@gmail.com', '2001-05-15', '2023-07-12', b'0'),
(16, 'test11', '$2y$10$SWI47V4ibMWSfP6A9J5XnegCfNQiJ/HgK82X2Yu25JJZPeDWfvTRK', 'email11@email.com', '2001-05-15', '2023-07-12', b'0'),
(18, 'test12', '$2y$10$AQbfTJbYh99esmOazHoy9uGKevaqAtYxiFsNqdApvefE2IQDuWmvi', 'email12@gmail.com', '2001-05-15', '2023-07-12', b'0'),
(19, 'test13', '$2y$10$PXEQP8w19qxF5Rhy5qwFk.INAohFHWnTGjFjmStBGVCf08KRPlLC.', 'email13@email.com', '2001-05-15', '2023-07-12', b'0'),
(20, 'test14', '$2y$10$bMsF0fwCsK0aILCAOIZA.Of.mLDMUB7EMw6PQHKwmX3IKFJkeiiaG', 'email14@email.com', '2001-05-15', '2023-07-12', b'0'),
(21, 'luca', '$2y$10$EB/bq2fC/Cvy2J4g670VMO5oXVDOM8hYEbsY8rwUe4Ht0ZYfsI3MK', 'email1@emial.com', '2000-10-26', '2023-07-12', b'0'),
(22, 'cath', '$2y$10$q2AvmtY6laC0DXR5luA6penWAj.JsLC8hs3byRUvPdYIIthAHO.kS', 'email@email.com', '2001-05-15', '2023-07-13', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `challengeId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `answer` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `challengeId`, `questionId`, `answer`) VALUES
(1, 1, 1, 'Elephant'),
(2, 2, 4, 'No'),
(3, 1, 2, 'PHP Hyertext Processor'),
(4, 1, 3, '1993'),
(5, 2, 5, '$username'),
(6, 2, 6, 'echo'),
(15, 2, 15, 'False'),
(16, 2, 17, '&lt;?php ... ?&gt;'),
(17, 7, 18, 'True'),
(18, 7, 19, '$_SERVER'),
(19, 7, 20, '$score++;'),
(20, 8, 21, 'Over 244+ million.'),
(21, 8, 22, 'It was developed by Rasmus Lerdorf to manage his own personal website.');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `imagePath` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `name`, `imagePath`) VALUES
(1, 'PHP Facts', '../challenge images/phpbasics.jpg'),
(2, 'PHP Basics', '../challenge images/phpbasics2.png'),
(7, 'PHP Basics 2.0', '../challenge images/php_code-1200x960.jpg'),
(8, 'More PHP Facts!', '../challenge images/php-programming-code-abstract-technology-background_272306-152.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `completedquestions`
--

CREATE TABLE `completedquestions` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `challengeId` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completedquestions`
--

INSERT INTO `completedquestions` (`id`, `userId`, `challengeId`, `score`) VALUES
(5, 3, 1, 3),
(6, 3, 2, 5),
(7, 3, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `fakeanswers`
--

CREATE TABLE `fakeanswers` (
  `id` int(11) NOT NULL,
  `challengeId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `fakeanswers` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakeanswers`
--

INSERT INTO `fakeanswers` (`id`, `challengeId`, `questionId`, `fakeanswers`) VALUES
(1, 1, 1, 'Lion:Giraffe:Salmon'),
(3, 1, 2, 'Personal Home Page:It does not mean anything: Power Heightened Processing'),
(4, 1, 3, '1995:1990:1992'),
(5, 2, 4, 'Yes:Maybe:Depends on the day'),
(6, 2, 5, '£username:&username:var username'),
(7, 2, 6, 'print:output:system.out'),
(12, 2, 15, 'True'),
(13, 2, 17, '&lt;? ... ?&gt;:&lt;/? ... /?&gt;:&lt;?php ... ?php&gt;'),
(14, 7, 18, 'False'),
(15, 7, 19, '$GLOBALS:$_GET:$_SESSION'),
(16, 7, 20, '$score= +1;:++$score;:add 1 to $score;'),
(17, 8, 21, 'Atleast 5.:Between 200k and 300k.:2.78 million.'),
(18, 8, 22, 'It was developed by NASA to be used in the Apollo missions.:It was developed by Mark Zuckerberg to help with the creation of Facebook.:It was never developed, and you thinking PHP is real is a sign of the Mandela effect.');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `challengeId` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `challengeId`, `question`) VALUES
(1, 1, 'Which animal is on the PHP logo?'),
(2, 1, 'What does PHP stand for?'),
(3, 1, 'When was PHP created?'),
(4, 2, 'Do you have to specify a variables data type?'),
(5, 2, 'Which is the correct way to define a variable called \'username\'?'),
(6, 2, 'Which is the correct way to output a variable?'),
(15, 2, 'When using the POST method, variables are displayed in the URL.'),
(17, 2, 'Which is the correct way to surround PHP code?'),
(18, 7, 'PHP allows you to send emails directly from a script.'),
(19, 7, 'Which superglobal variable holds information about headers, paths, and script locations?'),
(20, 7, 'Which is the correct way to add 1 to the $score variable?'),
(21, 8, 'How many websites are estimated to use PHP?'),
(22, 8, 'Why was PHP originally developed?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completedquestions`
--
ALTER TABLE `completedquestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakeanswers`
--
ALTER TABLE `fakeanswers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `completedquestions`
--
ALTER TABLE `completedquestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fakeanswers`
--
ALTER TABLE `fakeanswers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
