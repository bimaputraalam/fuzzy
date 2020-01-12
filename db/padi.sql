-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2020 at 08:54 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stc`
--

-- --------------------------------------------------------

--
-- Table structure for table `padi`
--

CREATE TABLE IF NOT EXISTS `padi` (
`id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `hasil_panen` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `padi`
--

INSERT INTO `padi` (`id`, `tanggal`, `hasil_panen`) VALUES
(1, '2018-08-31', 134),
(2, '2018-09-30', 176),
(3, '2018-10-30', 200),
(4, '2018-11-30', 186),
(5, '2018-12-30', 155),
(6, '2019-01-30', 187),
(7, '2019-02-28', 142),
(8, '2019-03-30', 122),
(9, '2019-04-30', 112),
(10, '2019-05-30', 156),
(11, '2019-06-30', 192),
(12, '2019-07-30', 166),
(13, '2019-08-30', 143),
(14, '2019-09-30', 166);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `padi`
--
ALTER TABLE `padi`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `padi`
--
ALTER TABLE `padi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
