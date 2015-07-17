-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2015 at 08:27 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--
CREATE DATABASE IF NOT EXISTS `library` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `library`;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) NOT NULL,
  `middle_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10016 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `first_name`, `middle_name`, `last_name`) VALUES
(10001, 'Steven', 'S', 'Muchnick'),
(10002, 'Thomas', 'H', 'Cormen'),
(10003, 'Charles', 'E', 'Leiserson'),
(10004, 'Ronald', 'L', 'Rivest'),
(10005, 'Clifford', NULL, 'Stein'),
(10006, 'Dexter', 'C', 'Kozen'),
(10007, 'Andrew', 'W', 'Appel'),
(10008, 'Alfred', 'V', 'Aho'),
(10009, 'Monica', 'S', 'Lam'),
(10010, 'Ravi', NULL, 'Sethi'),
(10011, 'Jeffrey', 'D', 'Ullman'),
(10012, 'Torben', 'E', 'Mogensen'),
(10013, 'Balaguruswamy', NULL, 'E'),
(10014, 'Al', NULL, 'Kelly'),
(10015, 'Ira', NULL, 'Pohl');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `publisher` int(5) NOT NULL,
  `edition` int(3) NOT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000003 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `publisher`, `edition`, `year`) VALUES
(10000001, 'Advanced Compiler Design and Implementation', 10004, 1, 2002),
(10000002, 'Compilers - Principles, Techniques and Tools', 10001, 2, 2005);

-- --------------------------------------------------------

--
-- Table structure for table `copy`
--

CREATE TABLE IF NOT EXISTS `copy` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `book_id` int(8) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000000009 ;

--
-- Dumping data for table `copy`
--

INSERT INTO `copy` (`id`, `book_id`, `status`) VALUES
(1000000001, 10000001, 'A'),
(1000000002, 10000001, 'A'),
(1000000004, 10000002, 'A'),
(1000000005, 10000002, 'A'),
(1000000006, 10000002, 'A'),
(1000000007, 10000002, 'A'),
(1000000008, 10000002, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `copy_id` int(10) NOT NULL,
  `user_id` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10008 ;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `name`) VALUES
(10001, 'Pearson Education'),
(10002, 'Tata McGraw Hills'),
(10003, 'Schaum''s'),
(10004, 'Morgan Kauffman'),
(10005, 'Prentice Hall India'),
(10006, 'MIT Press'),
(10007, 'Addison Wesley');

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE IF NOT EXISTS `return` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `issue_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `return_issue_id` (`issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type_id` int(5) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`name`,`email`,`phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10003 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `type_id`, `full_name`, `email`, `phone`, `valid`) VALUES
(10001, 'librarian', '5f4dcc3b5aa765d61d8327deb882cf99', 10001, 'Librarian', 'librarian@csdl.mitkannur.ac.in', '7736116387', 1),
(10002, 'lallu', '5f4dcc3b5aa765d61d8327deb882cf99', 10002, 'Lallu A', 'lalluanthoor@gmail.com', '8281752877', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `lease_days` int(3) NOT NULL,
  `book_limit` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_type_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10005 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `lease_days`, `book_limit`) VALUES
(10001, 'Librarian', 0, 0),
(10002, 'Faculty', 180, 3),
(10003, 'Student', 15, 3),
(10004, 'Guest', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `written`
--

CREATE TABLE IF NOT EXISTS `written` (
  `book_id` int(8) NOT NULL,
  `author_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `written`
--

INSERT INTO `written` (`book_id`, `author_id`) VALUES
(10000001, 10001),
(10000002, 10008),
(10000002, 10009),
(10000002, 10011),
(10000002, 10010);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
