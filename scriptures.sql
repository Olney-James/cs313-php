-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: 127.10.185.130:3306
-- Generation Time: Feb 08, 2016 at 08:40 PM
-- Server version: 5.5.45
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `scriptures`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `name`) VALUES
(1, 'John'),
(2, 'Doctrine and Covenants'),
(3, 'Mosiah');

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE IF NOT EXISTS `Books` (
  `book_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Books`
--

INSERT INTO `Books` (`book_id`, `name`) VALUES
(1, 'John'),
(2, 'Doctrine and Covenants'),
(3, 'Mosiah');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `link_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` tinyint(3) unsigned NOT NULL,
  `scripture_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `topic_id` (`topic_id`),
  KEY `scripture_id` (`scripture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Scriptures`
--

CREATE TABLE IF NOT EXISTS `Scriptures` (
  `scripture_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` tinyint(3) unsigned NOT NULL,
  `chapter` tinyint(3) unsigned NOT NULL,
  `verse` tinyint(3) unsigned NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`scripture_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Scriptures`
--

INSERT INTO `Scriptures` (`scripture_id`, `book_id`, `chapter`, `verse`, `content`) VALUES
(1, 1, 1, 5, 'And the light shineth in darkness; and the darkness comprehendeth it not.'),
(2, 2, 88, 49, 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when ye shall comprehend even God, being quickened in him and by him.'),
(3, 2, 93, 28, 'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.'),
(4, 3, 16, 9, 'He is the light and life of the world; yea, a light that is endless, that can never be darkened; yea, and also a light which is endless, that there can be no more death.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`),
  ADD CONSTRAINT `link_ibfk_2` FOREIGN KEY (`scripture_id`) REFERENCES `scriptures` (`scripture_id`);

--
-- Constraints for table `Scriptures`
--
ALTER TABLE `Scriptures`
  ADD CONSTRAINT `Scriptures_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `Books` (`book_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
