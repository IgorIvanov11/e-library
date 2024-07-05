USE `tec4468039_db`;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 09:59 AM
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
-- Database: `e-library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AID` int(11) NOT NULL,
  `ANAME` varchar(150) NOT NULL,
  `APASS` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AID`, `ANAME`, `APASS`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BID` int(11) NOT NULL,
  `BTITLE` varchar(150) NOT NULL,
  `DESCRIPTION` varchar(256) NOT NULL,
  `KEYWORDS` varchar(150) NOT NULL,
  `FILE` varchar(150) NOT NULL,
  `STATUS` varchar(15) NOT NULL,
  `DEVELOPER` varchar(256) NOT NULL,
  `PRODUCER` varchar(256) NOT NULL,
  `YEAR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `MES` text NOT NULL,
  `LOGS` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RID`, `ID`, `MES`, `LOGS`) VALUES
(5, 1, 'Ошибка при смене пароля. Помогите!!', '2024-05-02 16:13:03'),
(6, 1, 'Здравствуйте! Не могу поменять пароль! Помогите!!!', '2024-05-02 21:38:22'),
(7, 5, 'Помогите!', '2024-05-03 13:55:23'),
(8, 10, 'Проблема авторизации!!!', '2024-05-06 14:23:13'),
(9, 5, 'Help me!', '2024-05-14 10:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(150) NOT NULL,
  `PASS` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `MAIL` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STATUS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `NAME`, `PASS`, `MAIL`, `STATUS`) VALUES
(5, 'John', '123', 'john@mail.ru', 'Сотрудник'),
(6, 'Keicy', '123', 'keicy@mail.ru', 'Оператор'),
(7, 'mode', '123', 'mode@mail.ru', 'Модератор'),
(8, 'expert', '123', 'expert@mail.ru', 'Эксперт'),
(9, 'AdminIgor', '123', 'Admin@mail.ru', 'Администратор');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`RID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `BID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
