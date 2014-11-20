-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2014 at 08:48 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tinyurl`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('20e0af32092f0722672cf8a0179851c0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:33.0) Gecko/20100101 Firefox/33.0', 1416509530, 'a:1:{s:9:"user_data";s:0:"";}'),
('8dab3311d969b116324e1e929a8fd4fb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1416512820, '');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `link_id` int(9) NOT NULL AUTO_INCREMENT,
  `url_code` varchar(9) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`link_id`),
  UNIQUE KEY `url` (`url`),
  UNIQUE KEY `url_code` (`url_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`link_id`, `url_code`, `url`, `created_on`, `updated_on`) VALUES
(1, '0ujbo6', 'http://www.google.com', '2014-11-19 15:47:02', '2014-11-20 15:47:02'),
(2, 'kffcoi', 'http://www.yahoo.com', '2014-11-20 15:47:18', '2014-11-20 15:47:18'),
(3, '913jj1', 'http://www.facebook.com', '2014-11-20 15:47:25', '2014-11-20 15:47:25'),
(4, 'tweh70', 'http://www.php.net', '2014-11-20 16:21:39', '2014-11-20 16:21:39'),
(5, 'gpc1og', 'http://www.stackoverflow.com', '2014-11-20 16:21:47', '2014-11-20 16:21:47'),
(6, 'kjwdow', 'http://www.ebay.com', '2014-11-20 19:52:25', '2014-11-20 19:52:25'),
(7, '7i37rk', 'http://www.digg.com', '2014-11-20 20:47:31', '2014-11-20 20:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `redirects`
--

CREATE TABLE IF NOT EXISTS `redirects` (
  `link_id` int(9) NOT NULL,
  `redirected_on` date NOT NULL,
  `redirects` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`link_id`,`redirected_on`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redirects`
--

INSERT INTO `redirects` (`link_id`, `redirected_on`, `redirects`, `created_on`, `updated_on`) VALUES
(1, '2014-11-19', 3, '2014-11-19 16:05:27', '2014-11-19 16:05:30'),
(1, '2014-11-20', 2, '2014-11-20 16:06:00', '2014-11-20 16:06:01'),
(2, '2014-11-20', 1, '2014-11-20 19:54:12', '2014-11-20 19:54:12'),
(3, '2014-11-20', 1, '2014-11-20 19:54:05', '2014-11-20 19:54:05'),
(4, '2014-11-20', 1, '2014-11-20 19:54:07', '2014-11-20 19:54:07'),
(5, '2014-11-20', 2, '2014-11-20 16:22:24', '2014-11-20 19:52:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
