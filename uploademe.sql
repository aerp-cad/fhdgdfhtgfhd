-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2020 at 12:47 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'Jekeltor', '$2y$10$vm.ao2iyvs5RjoaZaeMtoug0cJPC8KElch14HYMyeAvPb3sxB78DG'),
(3, 'test', '$2y$10$p0pW.yzKDfpw412MpDjvgOAG8ghqJYz15JXF8A7bu4iYtlAxFst8K');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `discord` varchar(255) NOT NULL,
  `message` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `email`, `discord`, `message`) VALUES
(5, 'jake@jakehamblin.com', 'asdasd', 'asdasd'),
(6, 'jake@jakehamblin.com', 'asdasd', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `discountcodes`
--

CREATE TABLE `discountcodes` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `percent` varchar(255) NOT NULL,
  `expiry` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discountcodes`
--

INSERT INTO `discountcodes` (`id`, `code`, `percent`, `expiry`) VALUES
(4, 'Jake', '60', '10/16/2020');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `clientid` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `webhooked` varchar(4) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `name`, `clientid`, `price`, `date`, `token`, `filename`, `txn_id`, `webhooked`) VALUES
(9, 'Test Product', '336143571692552195', '15', '9/30/2020', '9f47947a', 'testproduct', '01X826092K667684F', 'no'),
(10, 'Another Product', '336143571692552195', '15', '10/24/2020', 'e9176b4a', 'anotherproduct', '1GE04007CK5701221', 'no'),
(11, 'Another Product', '336143571692552195', '15', '10/24/2020', 'dabad043', 'anotherproduct', '4HK08581K5743121Y', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `order1` int(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `review` varchar(500) NOT NULL,
  `rating` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `order1`, `name`, `logo`, `review`, `rating`) VALUES
(1, 2, 'Jake Hamblin', 'https://jakehamblin.com/images/logos.png', 'This is just a test about the test of the reviews. A lot of tests, aye?', '5');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `order1` int(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `images` varchar(1000) NOT NULL,
  `features` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `order1`, `name`, `price`, `images`, `features`) VALUES
(1, 1, 'Test Product', '15', 'https://i.imgur.com/XcQvaRJh.jpg; https://i.imgur.com/ObbQZm3.jpg; https://forums.txdps-rp.com/styles/xenfocus/aperture/backgrounds/txdpsstorebackground.png', 'Testing1; Testing2; Testing3; Testing4; Testing5; Testing6; Testing7; Testing8'),
(3, 1, 'Another Product', '15', 'https://i.imgur.com/XcQvaRJh.jpg; https://i.imgur.com/ObbQZm3.jpg; https://forums.txdps-rp.com/styles/xenfocus/aperture/backgrounds/txdpsstorebackground.png', 'Testing1; Testing2; Testing3; Testing4; Testing5; Testing6; Testing7; Testing8');

-- --------------------------------------------------------

--
-- Table structure for table `siteinfo`
--

CREATE TABLE `siteinfo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `backgroundimage` varchar(255) NOT NULL,
  `sitekey` varchar(255) NOT NULL,
  `secretkey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siteinfo`
--

INSERT INTO `siteinfo` (`id`, `name`, `domain`, `logo`, `color`, `description`, `twitter`, `backgroundimage`, `sitekey`, `secretkey`) VALUES
(1, 'Jake Hamblin', 'https://products.jakehamblin.com/storetemplate', 'https://jakehamblin.com/images/logo.png', '3fa3eb', 'Software programmer and website developer', 'jekeltor', 'https://cdn.discordapp.com/attachments/703843714547712000/746197532664791140/unknown.png', '6LdRnMEZAAAAAPfyVX1gspivcvL-Z7clZdvhEeBv', '6LdRnMEZAAAAACQoIA2Mot5FS6wWcM47gKtPbV9n');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `order1` int(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `about` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `order1`, `name`, `logo`, `rank`, `about`) VALUES
(1, 1, 'Jake Hamblin', 'https://jakehamblin.com/images/logos.png', 'Website Developer', 'This is just a test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discountcodes`
--
ALTER TABLE `discountcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siteinfo`
--
ALTER TABLE `siteinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `discountcodes`
--
ALTER TABLE `discountcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siteinfo`
--
ALTER TABLE `siteinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
