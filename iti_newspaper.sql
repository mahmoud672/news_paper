-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2019 at 09:04 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iti_newspaper`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `job_type` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `job_type`, `address`, `phone`) VALUES
(1, 'mfiftycent', 'mfiftycent@mfiftycent.com', '111222333', 'admin', 'haram', '01111111111');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `id_manager` int(11) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_employee_department` (`id_manager`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `id_manager`, `creation_date`) VALUES
(1, 'media', 3, '2019-05-24 17:21:33'),
(2, 'crime', 4, '2019-05-24 17:20:46'),
(3, 'sport', 5, '2019-05-24 17:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `job_type` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `hire_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `password`, `job_type`, `address`, `hire_date`, `phone`) VALUES
(1, 'ahmed', 'sdfdfd', 'dddddddddd', 'editor', 'faisel', '2019-05-17 14:44:48', '01010010101'),
(2, 'saly', 'saly@saly.com', '123123123', 'editor', 'haram-street', '2019-05-18 16:45:55', '01111111111'),
(3, 'linda', 'linda@linda.com', '123123123', 'photographer', 'haram-street', '2019-05-18 17:12:41', '01111111111'),
(4, 'gad', 'gad@gad.com', '1112223333', 'editor', 'faisel-haram', '2019-05-31 15:01:58', '1111111111'),
(5, 'abdo', 'abdo@abdo.com', '123123123', 'editor', 'faisel-haram', '2019-05-18 17:33:45', '01111111111'),
(6, 'osama', 'osama@osama.com', '123123123', 'editor', '	\nfaisel-haram', '2019-05-18 22:38:53', '	\n01111111111'),
(7, 'mohamed', 'mohamed@mohamed.com', '123123123', 'editor', '	faisel-haram', '2019-05-24 02:40:31', '1111111111'),
(10, 'yasser', 'yasser@yasser.com', '123123123', 'photographer', 'naser-city', '2019-05-31 16:27:41', '01111111111');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `id_editor` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `writing_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_employee_news` (`id_editor`),
  KEY `fk_category_news` (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `id_editor`, `id_category`, `writing_date`) VALUES
(1, 'eminem show', 'Eminem show is an album for the best rapper all over the world \nwho is called Eminem', 2, 1, '2019-05-26 23:34:29'),
(2, 'mo salah', 'mo Salah is the best player in the world', 2, 3, '2019-05-24 20:01:15'),
(3, 'psycho murder', 'psycho murder kills some people in Maadi street', 2, 2, '2019-05-24 20:01:24'),
(7, 'samy anan', 'sdf fgfg ghtht rgrg yyy tgtt yjyy ddv rgrgr ddvf yththt', 2, 1, '2019-05-27 12:43:12'),
(8, 'abo treka', 'asad dfd ypfkvf ehfehf e-rit gpre rujg rlgr rjgkg dpgp  uggkrgmrg', 2, 3, '2019-05-27 12:43:39'),
(9, 'sadam huson', 'dsds grgpk 4ri4 4jrekf fjefksd djfdk dkfdnf  lkfnsmf sd enfed fe', 2, 1, '2019-05-27 12:45:12'),
(10, 'dfd', 'efedfedg kk ek ejfe jfeejoe eoje eje ejf e ', 2, 2, '2019-05-27 12:45:27'),
(11, 'adss', 'dfdfvgr rfrgrt thtyhyt ttghtg thtgyhytffv fgvf', 2, 1, '2019-05-27 12:57:10'),
(12, 'frfr', 'rfrrdrdfrd rftrg 5gttgt 5rknkrn4r 4j4 4uro4rk4r ', 2, 1, '2019-05-27 12:57:24'),
(13, 'frfrfc', 'efrr rgtrgt thyhyh tht', 2, 3, '2019-05-27 12:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `news_image`
--

CREATE TABLE IF NOT EXISTS `news_image` (
  `id_news` int(11) DEFAULT NULL,
  `id_photographer` int(11) DEFAULT NULL,
  `image_name` text,
  KEY `fk_employee_news` (`id_photographer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_image`
--

INSERT INTO `news_image` (`id_news`, `id_photographer`, `image_name`) VALUES
(13, 3, '1558971025439px-Post_Malone_(28150750483).jpg'),
(3, 3, '155879188202.jpg'),
(10, 3, '155896118744837878_1714738528635425_1063696213322235904_n.jpg'),
(9, 3, '1558961150Khalid-MTV_smiling.jpg'),
(8, 3, '1558961051Khalid-MTV_smiling.jpg'),
(7, 3, '155896106815-ways-to-spice-up-your-boring-vacation-photos-4-819x1024.jpg'),
(1, 3, '15588373801f65d6df95f3a0a.jpg'),
(1, 3, '155883738002.jpg'),
(2, 3, '1558884675julian.jpg'),
(12, 3, '15589710632AC0298000000578-3171107-image-a-21_1437586090324.jpg'),
(11, 3, '15589710845926aa14456b2084dc09df143e287bcc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reader`
--

CREATE TABLE IF NOT EXISTS `reader` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `reader`
--

INSERT INTO `reader` (`id`, `name`, `email`, `password`, `job_type`, `address`, `registration_date`, `phone`) VALUES
(1, 'shady', 'shady@shady.com', 'ss', 'reader', 'kolo', '2019-05-27 20:03:53', '11111111111'),
(2, 'shady', 'shady@shady.com', 'ss', 'reader', 'haram', '2019-05-27 20:04:02', '136348168'),
(3, 'hassan', 'hassan@hassan.com', '111222333', 'reader', 'kolo', '2019-05-31 15:00:10', '11111111111');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
