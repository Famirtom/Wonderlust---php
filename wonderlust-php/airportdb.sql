-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 08:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airportdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `PassengerID` int(11) NOT NULL,
  `FlightID` int(11) NOT NULL,
  `BookingDate` datetime DEFAULT current_timestamp(),
  `BookingStatus` enum('Confirmed','Pending','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `PassengerID`, `FlightID`, `BookingDate`, `BookingStatus`) VALUES
(1, 1, 1, '2024-12-01 15:29:50', 'Confirmed'),
(2, 2, 1, '2024-12-01 15:29:50', 'Confirmed'),
(3, 3, 2, '2024-12-01 15:29:50', 'Pending'),
(4, 4, 2, '2024-12-01 15:29:50', 'Confirmed'),
(5, 5, 3, '2024-12-01 15:29:50', 'Confirmed'),
(6, 6, 3, '2024-12-01 15:29:50', 'Cancelled'),
(7, 7, 4, '2024-12-01 15:29:50', 'Pending'),
(8, 8, 4, '2024-12-01 15:29:50', 'Confirmed'),
(9, 9, 1, '2024-12-01 15:29:50', 'Confirmed'),
(10, 10, 2, '2024-12-01 15:29:50', 'Confirmed'),
(14, 14, 1, '2024-12-08 14:18:36', 'Confirmed'),
(21, 21, 2, '2024-12-08 16:35:42', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `FlightID` int(11) NOT NULL,
  `FlightNumber` varchar(20) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `DepartureDateTime` datetime NOT NULL,
  `FLightStatus` enum('On Time','Delayed','Cancelled') NOT NULL,
  `MaxPassengers` int(11) NOT NULL CHECK (`MaxPassengers` > 0),
  `GateOpenTime` datetime DEFAULT NULL,
  `GateCloseTime` datetime DEFAULT NULL,
  `FlightDuration` int(11) NOT NULL,
  `GateID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`FlightID`, `FlightNumber`, `Destination`, `DepartureDateTime`, `FLightStatus`, `MaxPassengers`, `GateOpenTime`, `GateCloseTime`, `FlightDuration`, `GateID`) VALUES
(1, 'AA101', 'Barcelona', '2024-12-05 08:00:00', 'On Time', 150, '2024-12-05 06:30:00', '2024-12-05 07:30:00', 120, 1),
(2, 'BA202', 'London', '2024-12-05 14:30:00', 'Delayed', 200, '2024-12-05 13:00:00', '2024-12-05 13:00:00', 120, 2),
(3, 'CA303', 'Paris', '2024-12-06 09:00:00', 'On Time', 180, '2024-12-06 07:30:00', '2024-12-06 08:30:00', 120, 3),
(4, 'DL404', 'Tokyo', '2024-12-06 13:00:00', 'Cancelled', 150, NULL, NULL, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `gate`
--

CREATE TABLE `gate` (
  `GateID` int(11) NOT NULL,
  `GateNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gate`
--

INSERT INTO `gate` (`GateID`, `GateNumber`) VALUES
(1, 'A1'),
(2, 'B2'),
(3, 'C3'),
(4, 'D4');

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `PassengerID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `PassportNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`PassengerID`, `Name`, `PassportNumber`) VALUES
(1, 'Tommaso Rea', 'X1234567'),
(2, 'Pietro Saccone', 'X2345678'),
(3, 'Sophia White', 'X3456789'),
(4, 'Bob Martin', 'X4567890'),
(5, 'Alice Johnson', 'X5678901'),
(6, 'Olivia Green', 'X6789012'),
(7, 'Shawn Talli', 'X7890123'),
(8, 'Ivano Trave', 'X8901234'),
(9, 'Robert Valt', 'X9012345'),
(10, 'Mohammed Faisel', 'X0123456'),
(14, 'Diletta Tassari', 'DILE12345'),
(21, 'Gosha Hill', 'GOHL5634');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Role` enum('Check-in','Gate','Security') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `Name`, `Role`) VALUES
(1, 'Sarah Williams', 'Check-in'),
(2, 'Michael Brown', 'Gate'),
(3, 'Emma Clark', 'Security'),
(4, 'James Johnson', 'Check-in'),
(5, 'Olivia White', 'Gate'),
(6, 'David Black', 'Security'),
(7, 'Isla Green', 'Check-in'),
(8, 'Liam Turner', 'Gate'),
(9, 'Ava Harris', 'Security'),
(10, 'Sophia Robinson', 'Gate');

-- --------------------------------------------------------

--
-- Table structure for table `staffrota`
--

CREATE TABLE `staffrota` (
  `ShiftDateTime` datetime NOT NULL,
  `FlightID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `RotaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffrota`
--

INSERT INTO `staffrota` (`ShiftDateTime`, `FlightID`, `StaffID`, `RotaID`) VALUES
('2024-12-05 06:00:00', 1, 1, 1),
('2024-12-05 07:00:00', 1, 9, 2),
('2024-12-05 08:00:00', 1, 2, 3),
('2024-12-05 12:00:00', 2, 10, 4),
('2024-12-05 13:00:00', 2, 4, 5),
('2024-12-05 14:00:00', 2, 3, 6),
('2024-12-06 09:00:00', 3, 5, 7),
('2024-12-06 11:00:00', 3, 6, 8),
('2024-12-06 13:00:00', 4, 7, 9),
('2024-12-06 15:00:00', 4, 8, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `idx_FlightID_Bookings` (`FlightID`),
  ADD KEY `idx_passengerID_Bookings` (`PassengerID`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`FlightID`),
  ADD UNIQUE KEY `FlightNumber` (`FlightNumber`),
  ADD UNIQUE KEY `GateOpenTime` (`GateOpenTime`),
  ADD UNIQUE KEY `GateCloseTime` (`GateCloseTime`),
  ADD KEY `fk_gate` (`GateID`);

--
-- Indexes for table `gate`
--
ALTER TABLE `gate`
  ADD PRIMARY KEY (`GateID`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`PassengerID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `staffrota`
--
ALTER TABLE `staffrota`
  ADD PRIMARY KEY (`RotaID`),
  ADD KEY `idx_StaffID` (`StaffID`),
  ADD KEY `idx_FlightID` (`FlightID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `FlightID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gate`
--
ALTER TABLE `gate`
  MODIFY `GateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `PassengerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staffrota`
--
ALTER TABLE `staffrota`
  MODIFY `RotaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`PassengerID`) REFERENCES `passengers` (`PassengerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`FlightID`) REFERENCES `flight` (`FlightID`) ON DELETE CASCADE;

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `fk_gate` FOREIGN KEY (`GateID`) REFERENCES `gate` (`GateID`);

--
-- Constraints for table `staffrota`
--
ALTER TABLE `staffrota`
  ADD CONSTRAINT `fk_FlightID` FOREIGN KEY (`FlightID`) REFERENCES `flight` (`FlightID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_StaffID` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`) ON DELETE CASCADE,
  ADD CONSTRAINT `staffrota_ibfk_1` FOREIGN KEY (`FlightID`) REFERENCES `flight` (`FlightID`) ON DELETE CASCADE,
  ADD CONSTRAINT `staffrota_ibfk_2` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
