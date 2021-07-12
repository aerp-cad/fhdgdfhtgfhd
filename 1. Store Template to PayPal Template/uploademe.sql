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

CREATE TABLE `discountcodes` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `percent` varchar(255) NOT NULL,
  `expiry` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
) ENGINE=InnoDB DEFAULT CHARSET=latin


ALTER TABLE `discountcodes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `discountcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
