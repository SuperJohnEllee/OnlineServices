-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2018 at 01:09 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_services`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `AdminLName` varchar(100) NOT NULL,
  `AdminFName` varchar(100) NOT NULL,
  `AdminEmail` varchar(100) NOT NULL,
  `AdminUser` varchar(100) NOT NULL,
  `AdminPass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminLName`, `AdminFName`, `AdminEmail`, `AdminUser`, `AdminPass`) VALUES
(1, 'Tangeres', 'Bryle', 'bryletan@gmail.com', 'bryle', 'bryle'),
(2, 'Parcon', 'Janine', 'janineteneleventwelve@gmail.com', 'janine', 'janine');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` int(11) NOT NULL,
  `ServiceID` int(11) NOT NULL,
  `UsersID` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `BookDate` varchar(100) NOT NULL,
  `DateBooked` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingID`, `ServiceID`, `UsersID`, `Status`, `BookDate`, `DateBooked`) VALUES
(2, 6, 4, 'Approved', '2018-11-10', '2018-10-29 11:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_usID` int(11) NOT NULL,
  `Address` longtext NOT NULL,
  `ContactNumber` varchar(50) NOT NULL,
  `ContactEmail` varchar(100) NOT NULL,
  `ContactSchedule` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_usID`, `Address`, `ContactNumber`, `ContactEmail`, `ContactSchedule`) VALUES
(1, 'Lopez Jaena St., Brgy San Isidro, Jaro, Iloilo City', '09124556789', 'bf_service_provider@gmail.com', 'Monday to Sunday - Opens 24 hours');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` int(11) NOT NULL,
  `ServiceImage` blob NOT NULL,
  `ServiceName` varchar(100) NOT NULL,
  `ServiceType` varchar(250) NOT NULL,
  `ServiceDescription` longtext NOT NULL,
  `ServicePrice` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ServiceID`, `ServiceImage`, `ServiceName`, `ServiceType`, `ServiceDescription`, `ServicePrice`) VALUES
(2, 0x706c756d622e6a7067, 'Super Fast 24/7', 'Plumbing', 'Interprets blueprints and building specifications to map layout for pipes, drainage systems, and other plumbing materials. Installs pipes and fixtures, such as sinks and toilets, for water, gas, steam, air, or other liquids. Installs supports for pipes, equipment, and fixtures prior to installation.', '500'),
(3, 0x636f6d70757465722e706e67, 'CJ', 'Computer', 'o install, maintain and repair computers and networks. You will be the one to ensure that adequate IT infrastructure is in place and is used to its maximum capabilities.', '450'),
(6, 0x747275636b2e6a7067, 'La Farge', 'Trucking', 'Tunnels, railways, tramway lines, airports, ports, and data centers run 24/7, 365 days a year. You need to keep business running even when renovating existing infrastructure or developing new networks. At LafargeHolcim, we help you build efficient, durable, and aesthetic transport infrastructure for goods, people, and data. We work with you from the design phase forward, on a global scale, to match our innovative materials to your needs, guaranteeing the reliability of the new leader in the building materials industry.', '700'),
(8, 0x656c656374726963616c2e6a7067, 'Cams', 'Electrical', 'Best Electrical Service', '650');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UsersID` int(11) NOT NULL,
  `UserLName` varchar(100) NOT NULL,
  `UserFName` varchar(100) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `UserGender` varchar(50) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `UserPass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersID`, `UserLName`, `UserFName`, `UserEmail`, `UserGender`, `Username`, `UserPass`) VALUES
(1, 'Sitjar', 'FJ', 'sitjarfj21@gmail.com', 'Male', 'fjsitjar', 'francis'),
(2, 'Libunao', 'Nikko', 'nikko_libunao@gmail.com', 'Male', 'nikko', 'nikko'),
(3, 'Tapgus', 'Krystal Kates', 'tapgus_kk@gmail.com', 'Female', 'krystal', 'krystal'),
(4, 'Robado', 'John Ellee', 'bachrobado@gmail.com', 'Male', 'ellee', 'ellee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_usID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UsersID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_usID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
