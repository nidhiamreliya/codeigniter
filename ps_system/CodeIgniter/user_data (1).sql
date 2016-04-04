-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2016 at 06:36 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ps_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `privilege` int(1) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address_line1` varchar(100) NOT NULL,
  `address_line2` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` char(6) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `profile_pic` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`user_id`, `privilege`, `first_name`, `last_name`, `user_name`, `email_id`, `password`, `address_line1`, `address_line2`, `city`, `zip_code`, `state`, `country`, `profile_pic`) VALUES
(1, 2, 'Admin', 'admin', 'admin1', 'admin@gmail.com', 'd97b4583f619f9ab521aafd2d6f98e87', '-', NULL, 'rajkot', '360002', 'gujrat', 'india', NULL),
(2, 2, 'admin', 'admin', 'admin', 'admin', 'd97b4583f619f9ab521aafd2d6f98e87', '-', NULL, 'rajkot', '134111', 'gujarat', 'india', 'process.png'),
(23, 1, 'mohit', 'patel', 'mohit113', 'nidhi147@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', 'bhaktinagar circle', 'race cource', 'rajkot', '360008', 'gujrat', 'India', 'images_(2).jpg'),
(26, 1, 'mehul', 'patel', 'mehul', 'mehul@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', 'address1', 'addres2', 'rajkot', '380008', 'gujarat', 'India', 'video1.png'),
(29, 1, 'darshan', 'joshi', 'darshan', 'darshan@gmail.com', '0d0fd7c6e093f7b804fa0150b875b868', 'sadguru socity', 'dr.yagnik road', 'rajkot', '360005', 'gujarat', 'India', 'images_(1)1.jpg'),
(39, 1, 'nidhi', 'amreliya', 'nidhi147', 'nidhi147@hotmail.com', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'address1', 'addres2', 'rajkot', '360002', 'gujarat', 'India', 'images.jpg'),
(40, 1, 'poorva', 'rupala', 'poorva', 'poorva@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', 'line1 address', 'line2 address', 'rajkot', '360013', 'gujrat', 'India', 'images2.jpg'),
(41, 1, 'vrunda', 'bhalani', 'vrunda', 'vrunda789@gmail.com', '072b030ba126b2f4b2374f342be9ed44', 'street no 2', 'bhanvad', 'jamnagar', '380008', 'gujrat', 'India', 'default_profile.jpg'),
(42, 1, 'archna', 'patel', 'archna', 'archna@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', 'address1', 'addres2', 'rajkot', '789878', 'gujarat', 'India', 'default_profile.jpg'),
(43, 1, 'nisha', 'rajyaguru', 'nisha', 'nishu@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', 'race cource', 'hospital chock', 'rajkot', '360003', 'gujrat', 'India', 'how-you-eat.png'),
(44, 1, 'nirali', 'rayani', 'nirali', 'nirali123@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', '12,streat no3', 'tramba', 'rajkot', '360013', 'gujarat', 'India', 'post.png'),
(45, 1, 'nishtha', 'mehta', 'nishtha', 'nishtha@hotmail.com', 'c81e728d9d4c2f636f067f89cc14862c', 'park road', 'amreli', 'rajkot', '360013', 'gujrat', 'India', 'default_profile.jpg'),
(46, 1, 'raj', 'padalya', 'raj123', 'raj@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', 'gondal chowk', 'gondal', 'rajkot', '380008', 'gujarat', 'India', 'default_profile.jpg'),
(47, 1, 'rahul', 'pattni', 'rahul', 'rahul@gmail.com', '9bf31c7ff062936a96d3c8bd1f8f2ff3', 'add1', 'add2', 'rajkot', '360001', 'gujarat', 'India', 'default_profile.jpg'),
(48, 1, 'parth', 'sojitra', 'parth', 'parth@hotmail.com', 'd3d9446802a44259755d38e6d163e820', '150 ft,ring road', 'om  nagar', 'rajkot', '360005', 'gujarat', 'India', 'default_profile.jpg'),
(49, 1, 'namrata', 'dobariya', 'namrata', 'namrata@gmail.com', '8f14e45fceea167a5a36dedd4bea2543', 'gondal chok', 'gondal', 'rajkot', '360003', 'gujrat', 'india', 'images3.jpg'),
(50, 1, 'nehal', 'lunagariya', 'nehal', 'nehal@gmail.com', 'd3d9446802a44259755d38e6d163e820', 'ranchod nagar', '', 'rajkot', '360007', 'gujrat', 'india', 'default_profile.jpg'),
(51, 1, 'ankita', 'kachadiya', 'ankita', 'ankita@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', 'ranchodnagar 3', '', 'rajkot', '360004', 'gujrat', 'india', 'default_profile.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
