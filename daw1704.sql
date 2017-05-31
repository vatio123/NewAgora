-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2017 at 08:48 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daw1704`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `idanswer` int(4) NOT NULL,
  `nickname` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idquestion` int(4) DEFAULT NULL,
  `input` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`idanswer`, `nickname`, `idquestion`, `input`, `date`) VALUES
(3, 'Xmen', 3, 'String is final because of same reason it is immutable. Couple of reasons which I think make sense i', '2017-05-23'),
(5, 'tester', 19, 'Yes bro, this definetively works!', '2017-05-15'),
(7, 'tester', 31, 'im registered user using untopic', '2017-05-22'),
(8, 'tester', 2, 'omg pepe u mad', '2017-05-22'),
(9, 'tester', 2, 'this pepe never change', '2017-05-22'),
(10, 'tester', 4, 'snoopy pls stahp', '2017-05-22'),
(11, 'tester', 5, 'char rulez bro', '2017-05-22'),
(12, 'tester', 19, 'nope it doesn\'t', '2017-05-22'),
(14, 'TheRock', 3, 'lobezno pls come', '2017-05-22'),
(16, 'check', 58, 'dsfg', NULL),
(17, 'check', 39, 'dfg', NULL),
(18, 'check', 58, 'dsfg', NULL),
(20, 'Lola', 58, 'dgfsdfgsdfg', '2017-05-31'),
(21, 'Lola', 38, 'AnswerTest', '2017-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `idquestion` int(4) NOT NULL,
  `nickname` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `topicname` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `input` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`idquestion`, `nickname`, `topicname`, `input`, `date`) VALUES
(2, 'Pepe', 'Education', 'Write a method which will remove any given character from a String?', '2017-02-06'),
(3, 'Xmen', 'Flu', 'Why String is final in Java?', '2017-04-25'),
(4, 'Snoopy', 'C#', 'How to Split String in Java?', '2017-04-27'),
(5, 'TheRock', 'Economy', 'Why Char array is preferred over String for storing password?', '2017-02-13'),
(19, 'tester', 'C#', 'it works', '2017-05-06'),
(29, 'anonymous', 'Java', 'how can i learn java easy mode easy pace? thx', '2017-05-06'),
(30, 'tester', 'Java', 'Where can i find good springboot tutorialsÂ¿', '2017-05-07'),
(31, 'anonymous', 'untopic', 'test question to unregistered users', '2017-05-22'),
(32, 'anonymous', 'untopic', 'amazing reload', '2017-05-22'),
(35, 'anonymous', 'untopic', 'timeout working', '2017-05-22'),
(36, 'anonymous', 'untopic', 'finally works', '2017-05-22'),
(38, 'tester', 'Flu', 'test question', '2017-05-31'),
(39, 'anonymous', 'untopic', 'anonymous test', '2017-05-31'),
(58, 'lelmaximo', 'Education', 'dsfg', NULL),
(62, 'anonymous', 'untopic', 'What do you think about the IES Proven?', '2017-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `reporta`
--

CREATE TABLE `reporta` (
  `idreporta` int(4) NOT NULL,
  `nickname` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idanswer` int(4) DEFAULT NULL,
  `reporttext` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `reporta`
--

INSERT INTO `reporta` (`idreporta`, `nickname`, `idanswer`, `reporttext`, `date`) VALUES
(7, 'succesfullreal', 18, 'dfgh', NULL),
(53, 'Lola', 20, 'alert', '2017-05-31'),
(54, 'Lola', 9, 'alert', '2017-05-31'),
(55, 'Lola', 8, 'alert', '2017-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `reportq`
--

CREATE TABLE `reportq` (
  `idreportq` int(4) NOT NULL,
  `nickname` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idquestion` int(4) DEFAULT NULL,
  `reporttext` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `reportq`
--

INSERT INTO `reportq` (`idreportq`, `nickname`, `idquestion`, `reporttext`, `date`) VALUES
(38, 'dfgh', 58, 'dfgh', NULL),
(42, 'Lola', 62, 'alert', '2017-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topicname` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `maintopic` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topicname`, `maintopic`) VALUES
('C#', 'programming'),
('Economy', 'socialpolitics'),
('Education', 'socialpolitics'),
('Flu', 'programming'),
('Java', 'programming'),
('untopic', 'untopic');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nickname` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `userscore` int(4) DEFAULT NULL,
  `firstname` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lastname` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `postalcode` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nickname`, `userscore`, `firstname`, `lastname`, `email`, `password`, `postalcode`) VALUES
('admin', 86, 'admin', 'admin', 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 12345),
('anonymous', 0, 'anonymous', 'anonymous', 'not@real.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0),
('check', 10, 'check', 'check', 'nor@osa@mail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 8038),
('lelmaximo', 10, 'lelmaximo', 'lelmaximo', 'lel@maximo.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 8038),
('Lola', 2, 'Lola', 'Loli', 'loli@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 45623),
('Pepe', 3, 'Pepe', 'Väth', 'pepe@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 45623),
('Snoopy', 50, 'Snoopy', 'Loli', 'snoopy@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 45623),
('succesfullreal', 0, 'succesrealName', 'succesrealLastname', 'succesreal@mail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 8004),
('tester', 0, 'tester', 'tester', 'n@mail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 12345),
('TheRock', 20, 'TheRock', 'Pierdra', 'marcos@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 78945),
('Xmen', 5, 'Xmen', 'Pescador', 'rocki@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 45632);

-- --------------------------------------------------------

--
-- Table structure for table `valorationa`
--

CREATE TABLE `valorationa` (
  `idvalorationa` int(4) NOT NULL,
  `nickname` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idanswer` int(4) NOT NULL,
  `valoration` int(4) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `valorationa`
--

INSERT INTO `valorationa` (`idvalorationa`, `nickname`, `idanswer`, `valoration`, `date`) VALUES
(10, 'tester', 8, 4, '2017-05-29'),
(11, 'admin', 9, 4, '2017-05-31'),
(12, 'admin', 3, 3, '2017-05-31'),
(13, 'admin', 11, 1, '2017-05-31'),
(14, 'admin', 8, 5, '2017-05-31'),
(15, 'admin', 17, 5, '2017-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `valorationq`
--

CREATE TABLE `valorationq` (
  `idvalorationq` int(4) NOT NULL,
  `nickname` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idquestion` int(4) DEFAULT NULL,
  `valoration` int(4) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `valorationq`
--

INSERT INTO `valorationq` (`idvalorationq`, `nickname`, `idquestion`, `valoration`, `date`) VALUES
(6, 'lelmaximo', 2, 2, '2017-05-11'),
(7, 'tester', 3, 1, '2017-05-11'),
(12, 'tester', 2, 0, '2017-05-28'),
(17, 'tester', 36, 3, '2017-05-28'),
(18, 'Lola', 36, 4, '2017-05-31'),
(19, 'admin', 62, 5, '2017-05-31'),
(20, 'admin', 58, 5, '2017-05-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`idanswer`),
  ADD UNIQUE KEY `idanswer` (`idanswer`),
  ADD KEY `nickname` (`nickname`),
  ADD KEY `idquestion` (`idquestion`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idquestion`),
  ADD UNIQUE KEY `idquestion` (`idquestion`),
  ADD KEY `nickname` (`nickname`),
  ADD KEY `topicname` (`topicname`);

--
-- Indexes for table `reporta`
--
ALTER TABLE `reporta`
  ADD PRIMARY KEY (`idreporta`),
  ADD UNIQUE KEY `idreporta` (`idreporta`),
  ADD KEY `idanswer` (`idanswer`),
  ADD KEY `nickname` (`nickname`);

--
-- Indexes for table `reportq`
--
ALTER TABLE `reportq`
  ADD PRIMARY KEY (`idreportq`),
  ADD UNIQUE KEY `idreportq` (`idreportq`),
  ADD KEY `idquestion` (`idquestion`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topicname`),
  ADD UNIQUE KEY `topicname` (`topicname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nickname`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- Indexes for table `valorationa`
--
ALTER TABLE `valorationa`
  ADD PRIMARY KEY (`idvalorationa`),
  ADD UNIQUE KEY `idvalorationa` (`idvalorationa`),
  ADD KEY `idanswer` (`idanswer`),
  ADD KEY `nickname` (`nickname`);

--
-- Indexes for table `valorationq`
--
ALTER TABLE `valorationq`
  ADD PRIMARY KEY (`idvalorationq`),
  ADD UNIQUE KEY `idvalorationq` (`idvalorationq`),
  ADD KEY `idquestion` (`idquestion`),
  ADD KEY `nickname` (`nickname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `idanswer` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `idquestion` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `reporta`
--
ALTER TABLE `reporta`
  MODIFY `idreporta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `reportq`
--
ALTER TABLE `reportq`
  MODIFY `idreportq` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `valorationa`
--
ALTER TABLE `valorationa`
  MODIFY `idvalorationa` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `valorationq`
--
ALTER TABLE `valorationq`
  MODIFY `idvalorationq` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`nickname`) REFERENCES `users` (`nickname`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`idquestion`) REFERENCES `questions` (`idquestion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`nickname`) REFERENCES `users` (`nickname`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`topicname`) REFERENCES `topics` (`topicname`);

--
-- Constraints for table `reporta`
--
ALTER TABLE `reporta`
  ADD CONSTRAINT `reporta_ibfk_1` FOREIGN KEY (`idanswer`) REFERENCES `answers` (`idanswer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reporta_ibfk_2` FOREIGN KEY (`nickname`) REFERENCES `users` (`nickname`);

--
-- Constraints for table `reportq`
--
ALTER TABLE `reportq`
  ADD CONSTRAINT `reportq_ibfk_1` FOREIGN KEY (`idquestion`) REFERENCES `questions` (`idquestion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `valorationa`
--
ALTER TABLE `valorationa`
  ADD CONSTRAINT `valorationa_ibfk_1` FOREIGN KEY (`idanswer`) REFERENCES `answers` (`idanswer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valorationa_ibfk_2` FOREIGN KEY (`nickname`) REFERENCES `users` (`nickname`);

--
-- Constraints for table `valorationq`
--
ALTER TABLE `valorationq`
  ADD CONSTRAINT `valorationq_ibfk_1` FOREIGN KEY (`idquestion`) REFERENCES `questions` (`idquestion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valorationq_ibfk_2` FOREIGN KEY (`nickname`) REFERENCES `users` (`nickname`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
