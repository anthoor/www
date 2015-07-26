-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2015 at 06:27 AM
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
  `first_name` varchar(80) NOT NULL,
  `middle_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10014 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `first_name`, `middle_name`, `last_name`) VALUES
(10001, 'Thomas', 'H', 'Cormen'),
(10002, 'Charles', 'E', 'Leiserson'),
(10003, 'Ronald', 'L', 'Rivest'),
(10004, 'Clifford', '', 'Stein'),
(10005, 'Dexter', 'C', 'Kozen'),
(10006, 'Torben', 'Egidius', 'Mogensen'),
(10007, 'Steven', 'S', 'Muchnick'),
(10008, 'Alfred', 'V', 'Aho'),
(10009, 'Monica', 'S', 'Lam'),
(10010, 'Ravi', '', 'Sethi'),
(10011, 'Jeffrey', 'D', 'Ullman'),
(10012, 'Andrew', 'W', 'Appel'),
(10013, 'Andrew', 'S', 'Tanenbaum');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `publisher` int(5) NOT NULL,
  `edition` int(3) NOT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000006 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `publisher`, `edition`, `year`) VALUES
(10000001, 'Introduction to Algorithms', 10006, 3, 2009),
(10000002, 'The Design and Analysis of Algorithms', 10014, 1, 1990),
(10000003, 'Basics of Compiler Design', 10015, 10, 2010),
(10000004, 'Advanced Compiler Design and Implementation', 10004, 3, 1997),
(10000005, 'Compilers - Principles, Techniques and Tools', 10001, 2, 2007);

-- --------------------------------------------------------

--
-- Table structure for table `copy`
--

CREATE TABLE IF NOT EXISTS `copy` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `book_id` int(8) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `shelf` char(1) NOT NULL,
  `row` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000000016 ;

--
-- Dumping data for table `copy`
--

INSERT INTO `copy` (`id`, `book_id`, `status`, `shelf`, `row`) VALUES
(1000000015, 10000001, 'A', 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `copy_id` int(10) NOT NULL,
  `user_id` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `renewed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000000018 ;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`id`, `copy_id`, `user_id`, `date`, `renewed`) VALUES
(1000000017, 1000000015, 10004, '2015-07-26 03:45:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10016 ;

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
(10007, 'Addison Wesley'),
(10008, 'W. H. Freeman'),
(10009, 'PWS Publishing Company'),
(10010, 'BPB Publications'),
(10011, 'Pearson Prentice Hall'),
(10012, 'Microsoft Press'),
(10013, 'Oxford University Press'),
(10014, 'Springer-Verlag, Inc.'),
(10015, 'University of Copenhagen');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `return`
--

INSERT INTO `return` (`id`, `issue_id`, `date`) VALUES
(14, 1000000017, '2015-07-26 03:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE IF NOT EXISTS `suggestion` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user` int(5) NOT NULL,
  `title` varchar(250) NOT NULL,
  `authors` text NOT NULL,
  `publisher` varchar(250) NOT NULL,
  `edition` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type_id` int(5) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `dpfile` varchar(200) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`name`,`email`,`phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10005 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `type_id`, `full_name`, `email`, `phone`, `dpfile`, `valid`) VALUES
(10001, 'librarian', '5f4dcc3b5aa765d61d8327deb882cf99', 10001, 'CSE Librarian', 'librarian@mitkannur.ac.in', '9876543210', '58a896cac069f91955dfe4b5e4ed84570608e2a9e637f4fae49b8291b0717498397446f01f483145f9ee7f3045bf5b9c9bfd37a598e570f921aebf22944bb630.png', 1),
(10004, 'dummy', '5f4dcc3b5aa765d61d8327deb882cf99', 10002, 'Dummy', 'dummy@mitkannur.ac.in', '9876543210', 'ci.png', 2);

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
(10002, 'Faculty', 60, 3),
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
(10000001, 10002),
(10000001, 10004),
(10000001, 10003),
(10000001, 10001),
(10000002, 10005),
(10000003, 10006),
(10000004, 10007),
(10000005, 10008),
(10000005, 10011),
(10000005, 10009),
(10000005, 10010);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
