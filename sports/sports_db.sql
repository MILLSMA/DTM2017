-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2020 at 12:47 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sports_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE IF NOT EXISTS `coaches` (
  `coach_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_aid` char(1) NOT NULL,
  `fa_date` date NOT NULL,
  PRIMARY KEY (`coach_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='stores information about the coaches' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`coach_id`, `first_name`, `last_name`, `email`, `first_aid`, `fa_date`) VALUES
(1, 'Michael', 'Devon', 'michael.devon@onslow.school.nz', 'Y', '2018-11-10'),
(2, 'Johnathan', 'Nelson', 'johnny_d372@gmail.com', 'N', '1900-01-01'),
(3, 'Hinemona', 'Grimes', 'hine.griumes@onslow.school.nz', 'Y', '2019-01-28'),
(4, 'Aaron', 'Smithies', 'aaron.smithies@student.onslow.school.nz', 'N', '2017-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `player_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `street_num` varchar(20) NOT NULL,
  `street_name` varchar(50) NOT NULL,
  `suburb` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Stores the information about the players' AUTO_INCREMENT=19 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `first_name`, `last_name`, `street_num`, `street_name`, `suburb`, `city`) VALUES
(14, 'Richard', 'Jones', '28', 'West Road', 'Karori', 'Wellington'),
(2, 'James', 'Barry', '47B', 'Harris Street', 'Tawa', 'Wellington'),
(3, 'Sonya', 'Noe', '754', 'Cameron Road', 'Brooklyn', 'Wellington'),
(4, 'Alice', 'Milkop', '14', 'Mururoa Road', 'Tawa', 'Wellington'),
(5, 'Toni', 'Sanders', '97F', 'Ford Road', 'Newton', 'Wellington'),
(6, 'Abdul', 'Baksh', '33', 'Vickers Street', 'Thorndon', 'Wellington'),
(7, 'James', 'Hyslop', '94B', 'Clyde Street', 'Newlands', 'Wellington'),
(15, 'John', 'Smith', '20', 'Sphere Road', 'Churton Park', 'Wellington'),
(12, 'Bob', 'Jones', '37', 'Hill Road', 'Churton Park', 'Wellington'),
(13, 'David', 'Parker', '45', 'Basil Cresent', 'Tawa', 'Wellington');

-- --------------------------------------------------------

--
-- Table structure for table `players_teams`
--

CREATE TABLE IF NOT EXISTS `players_teams` (
  `player_id` smallint(5) unsigned NOT NULL,
  `team_id` tinyint(3) unsigned NOT NULL,
  `fees` char(1) NOT NULL,
  KEY `player_id` (`player_id`,`team_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='stores information about players and the teams';

--
-- Dumping data for table `players_teams`
--

INSERT INTO `players_teams` (`player_id`, `team_id`, `fees`) VALUES
(12, 1, 'N'),
(2, 2, 'N'),
(3, 3, 'Y'),
(4, 3, 'Y'),
(5, 3, 'N'),
(6, 1, 'Y'),
(7, 2, 'N'),
(7, 4, 'N'),
(13, 2, 'Y'),
(14, 1, 'Y'),
(15, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `team_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `team_name` varchar(50) NOT NULL,
  `uniform` varchar(255) NOT NULL,
  `division` varchar(30) NOT NULL,
  `mascot` varchar(20) NOT NULL,
  `coach_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`team_id`),
  KEY `coach_id` (`coach_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='stores the information about the sports teams' AUTO_INCREMENT=14 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `uniform`, `division`, `mascot`, `coach_id`) VALUES
(1, 'Onslow First XV', 'Blue with red stripe', 'First Division', 'Pingu', 2),
(2, 'Onslow Second XV', 'Light Blue', 'Third Division', 'Leo the Lion', 3),
(3, 'Onslow Girls First XV', 'Dark blue with red sleves', 'Women''s Prems', 'Hawk', 1),
(4, 'Onslow First XI Cricket', 'White with red strip', 'First Division', 'Tui', 3),
(5, 'Swimming', 'Black', 'Second Division', 'Flippers', 2),
(9, 'Onslow Tennis', 'White and green', 'First Division', 'Snapper', 2),
(11, 'Onslow Rowing', 'Black and red', 'First Divisin', 'Bear', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
