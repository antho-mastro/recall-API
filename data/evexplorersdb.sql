-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 10:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evexplorersdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_emissions`
--

CREATE TABLE `car_emissions` (
  `CarEmissionID` bigint(20) UNSIGNED NOT NULL,
  `CarSpecsID` bigint(20) UNSIGNED NOT NULL,
  `CO2Emission` decimal(8,2) NOT NULL,
  `NOxEmission` decimal(8,2) NOT NULL,
  `ParticularEmission` decimal(8,2) NOT NULL,
  `VehicleID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_emissions`
--

INSERT INTO `car_emissions` (`CarEmissionID`, `CarSpecsID`, `CO2Emission`, `NOxEmission`, `ParticularEmission`, `VehicleID`) VALUES
(1, 1, '9.16', '0.82', '0.03', 1),
(2, 2, '5.73', '0.37', '0.04', 2),
(3, 3, '5.68', '0.70', '0.03', 3),
(4, 4, '9.53', '0.28', '0.05', 4),
(5, 5, '6.19', '0.97', '0.02', 5),
(6, 6, '7.99', '0.20', '0.02', 6),
(7, 7, '3.29', '0.57', '0.03', 7),
(8, 8, '5.07', '0.16', '0.01', 8),
(9, 9, '3.44', '0.82', '0.07', 9),
(10, 10, '5.09', '0.41', '0.09', 10);

-- --------------------------------------------------------

--
-- Table structure for table `car_specs`
--

CREATE TABLE `car_specs` (
  `SpecsID` bigint(20) UNSIGNED NOT NULL,
  `ChargingTime` varchar(255) NOT NULL,
  `Range` int(11) NOT NULL,
  `BatteryCapacity` decimal(8,2) NOT NULL,
  `FuelType` varchar(255) NOT NULL,
  `FuelEfficiency` decimal(5,2) NOT NULL,
  `VehicleID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_specs`
--

INSERT INTO `car_specs` (`SpecsID`, `ChargingTime`, `Range`, `BatteryCapacity`, `FuelType`, `FuelEfficiency`, `VehicleID`) VALUES
(1, '10:47:53', 388, '93.89', 'Electric', '6.65', 1),
(2, '17:20:47', 202, '82.69', 'Hybrid', '6.00', 2),
(3, '06:25:41', 470, '90.29', 'Electric', '1.30', 3),
(4, '23:37:43', 102, '55.34', 'Hybrid', '6.53', 4),
(5, '17:13:47', 200, '62.39', 'Electric', '9.76', 5),
(6, '18:16:04', 339, '86.03', 'Other', '4.67', 6),
(7, '07:22:37', 193, '92.48', 'Other', '2.98', 7),
(8, '05:56:17', 433, '44.00', 'Other', '6.40', 8),
(9, '01:07:02', 387, '33.13', 'Electric', '5.06', 9),
(10, '13:25:21', 483, '87.90', 'Hybrid', '8.73', 10);

-- --------------------------------------------------------

--
-- Table structure for table `charge_stations`
--

CREATE TABLE `charge_stations` (
  `StationID` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `OperatorName` varchar(255) NOT NULL,
  `NumberOfPorts` int(11) NOT NULL,
  `CountryID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `charge_stations`
--

INSERT INTO `charge_stations` (`StationID`, `Name`, `Location`, `OperatorName`, `NumberOfPorts`, `CountryID`) VALUES
(1, 'Mann-Haag', '45483 Mraz Ford Apt. 735\nSanfordburgh, ME 56001', 'Keeling, Nienow and Hills', 9, 1),
(2, 'Bechtelar-Lueilwitz', '587 O\'Reilly Court\nPiperland, MA 85154-5715', 'McLaughlin-Lesch', 9, 1),
(3, 'Hintz-Marks', '58647 Goldner Parks Apt. 948\nLindgrenland, CO 79322', 'Davis-Wilkinson', 2, 2),
(4, 'Bruen, Deckow and Gusikowski', '46021 Estrella Track Suite 336\nJewellport, NY 88848', 'Bartoletti-Hagenes', 7, 2),
(5, 'Olson-Padberg', '68903 Emory Forks Apt. 547\nSidland, MS 01737-0682', 'Schaefer-Moen', 7, 3),
(6, 'Blanda-Mueller', '7148 Birdie Tunnel\nArchibaldville, TN 44714-6603', 'Corwin Group', 8, 4),
(7, 'Jaskolski-Pollich', '77315 Kirlin Harbor\nWest Prudence, AL 94961-7190', 'Shanahan-Zboncak', 1, 5),
(8, 'Torp-Jacobson', '93457 Ayla Avenue Suite 654\nNew Frieda, DC 36717-4025', 'Langworth, Lueilwitz and Bruen', 6, 6),
(9, 'Ebert Ltd', '513 Streich Springs Apt. 844\nNew Korbin, PA 01097-4392', 'Hegmann-Beier', 3, 9),
(10, 'Kemmer, McGlynn and Kautzer', '1432 Alyson Dam\nLake Talia, ME 45625', 'Murray, Abernathy and Abbott', 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `charging_sessions`
--

CREATE TABLE `charging_sessions` (
  `ChargingSessionID` bigint(20) UNSIGNED NOT NULL,
  `ChargingStartTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ChargingEndTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `EnergyConsumed` decimal(10,2) NOT NULL,
  `VehicleID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `charging_sessions`
--

INSERT INTO `charging_sessions` (`ChargingSessionID`, `ChargingStartTime`, `ChargingEndTime`, `EnergyConsumed`, `VehicleID`) VALUES
(1, '2023-04-10 05:37:49', '2023-04-10 16:13:46', '46.03', 1),
(2, '2023-05-01 13:40:58', '2023-05-01 21:32:41', '18.87', 2),
(3, '2023-04-09 19:25:01', '2023-04-10 11:35:46', '28.37', 3),
(4, '2023-01-23 21:46:28', '2023-01-24 07:31:39', '12.39', 4),
(5, '2023-05-13 11:46:07', '2023-05-14 09:44:17', '19.72', 5),
(6, '2023-05-03 06:44:46', '2023-05-03 15:47:36', '45.77', 6),
(7, '2023-04-29 11:54:14', '2023-04-30 04:10:41', '49.52', 7),
(8, '2023-03-26 15:13:15', '2023-03-27 00:59:47', '9.46', 8),
(9, '2023-08-28 15:21:51', '2023-08-28 17:51:15', '33.70', 9),
(10, '2023-09-26 15:16:01', '2023-09-27 00:26:25', '18.35', 10);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `CountryID` bigint(20) UNSIGNED NOT NULL,
  `City` varchar(255) NOT NULL,
  `PostalCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`CountryID`, `City`, `PostalCode`) VALUES
(1, 'Alvisburgh', '72951-4598'),
(2, 'Bonnieshire', '59338'),
(3, 'Colleenchester', '93343'),
(4, 'Hartmannport', '67550'),
(5, 'New Emilie', '32063'),
(6, 'South Wilber', '10880'),
(7, 'West Amariton', '62764'),
(8, 'East Magnoliaview', '16057'),
(9, 'New Lewbury', '72732'),
(10, 'South Maryse', '42084'),
(11, 'Kacieborough', '78331-5764');

-- --------------------------------------------------------

--
-- Table structure for table `electric_vehicles`
--

CREATE TABLE `electric_vehicles` (
  `VehicleID` bigint(20) UNSIGNED NOT NULL,
  `VIN` varchar(255) NOT NULL,
  `Maker` varchar(255) NOT NULL,
  `Model` varchar(255) NOT NULL,
  `Year` year(4) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `StationID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `electric_vehicles`
--

INSERT INTO `electric_vehicles` (`VehicleID`, `VIN`, `Maker`, `Model`, `Year`, `Price`, `StationID`) VALUES
(1, '8122497599859', 'Lyric Kohler', 'quisquam', 2020, '48684.36', 3),
(2, '0406892735714', 'Jaden Hyatt', 'sequi', 1992, '31203.80', 9),
(3, '8391638404219', 'Kelvin Koepp MD', 'dolores', 1973, '31757.90', 9),
(4, '4347474635410', 'Abbigail Corkery', 'aut', 2007, '16886.72', 1),
(5, '7351519030112', 'Kaitlyn Graham', 'doloribus', 1974, '25449.57', 2),
(6, '6685987328541', 'Dr. Clifton Osinski II', 'et', 1996, '75980.35', 9),
(7, '0896331247746', 'Elroy Ruecker', 'et', 1989, '35775.84', 3),
(8, '3415017544503', 'Lamar Miller', 'vero', 1995, '41586.35', 6),
(9, '2415608228950', 'Maryse Sawayn', 'et', 2020, '78855.61', 2),
(10, '3112678334244', 'Prof. Josue Davis Sr.', 'ut', 1974, '52715.91', 4),
(11, '6451153069378', 'Mr. Casimer Schuppe DVM', 'labore', 2004, '44832.85', 8),
(12, '4247799550125', 'Ansley Crist', 'qui', 2023, '79696.72', 10),
(13, '9862079382422', 'Justen Feeney DDS', 'nihil', 2009, '53242.77', 1),
(14, '6609360762678', 'Kamryn Hirthe', 'ut', 1998, '52118.06', 6),
(15, '6479206978323', 'Dr. Horace Mayer', 'cum', 1999, '77966.48', 7),
(16, '4473969168641', 'Salma Legros', 'ea', 1974, '20236.06', 3),
(17, '7386357220753', 'Vernie Parker', 'velit', 2015, '25216.15', 5),
(18, '2814613837353', 'Prof. Marco Shields Sr.', 'sequi', 2002, '78739.44', 10),
(19, '5442465881995', 'Mr. Sylvan Howe PhD', 'ea', 1975, '31105.65', 7),
(20, '9557453774695', 'Whitney Smitham', 'nostrum', 1998, '50754.08', 7),
(21, '2243543065763', 'Caterina Mertz', 'odit', 1996, '16796.29', 9),
(22, '6289767090576', 'Charlotte Paucek Sr.', 'ullam', 2019, '48736.80', 2),
(23, '7785390768770', 'Florencio Marquardt', 'cumque', 2012, '71982.17', 7),
(24, '7142040347998', 'Felicity Heller', 'unde', 1989, '70987.08', 8),
(25, '2244509275196', 'Otilia Collier', 'aut', 2020, '12358.02', 5),
(26, '6268636895719', 'German Koelpin', 'atque', 1978, '37594.22', 3),
(27, '7818517275063', 'Shaniya Crooks', 'molestiae', 1996, '11680.60', 4),
(28, '4102767295920', 'Mrs. Dena Upton V', 'distinctio', 2020, '44855.94', 7),
(29, '3329789386882', 'Dr. Marion Harber', 'doloribus', 1997, '65020.50', 6),
(30, '7095167911989', 'Mr. Joesph Yost', 'non', 2008, '23698.07', 3),
(31, '6776692859458', 'Kelsi Murray', 'itaque', 2001, '77959.94', 5),
(32, '6233706764523', 'Clemmie Cremin', 'non', 2015, '30331.09', 6),
(33, '6498258168810', 'Colleen Hoppe I', 'pariatur', 1989, '21665.60', 8),
(34, '2961425609101', 'Ms. Pearl Hermiston MD', 'dolores', 2001, '52608.38', 5),
(35, '6611248886369', 'Nicole Kuhlman', 'quo', 1972, '48101.66', 7),
(36, '6378825975044', 'Wilburn Streich', 'sint', 2010, '33132.23', 1),
(37, '9557252845862', 'Mr. Ashton Hermann MD', 'vero', 1977, '20941.66', 2),
(38, '1468782802462', 'Ms. Tressie Windler', 'nostrum', 2005, '38891.04', 5),
(39, '1666599470151', 'Carmela Kling', 'omnis', 2008, '48925.20', 8),
(40, '2094946072113', 'Major Brown', 'qui', 1992, '57560.47', 5),
(41, '2071649749702', 'Woodrow Block', 'voluptas', 2004, '72497.14', 2),
(42, '9687667183997', 'Mrs. Alexandria Stoltenberg DDS', 'ea', 2008, '62360.38', 3),
(43, '5219960562724', 'Prof. Tremayne Dicki I', 'id', 1997, '54399.75', 6),
(44, '2970228791999', 'Dr. Alexzander White', 'consequatur', 1990, '69116.51', 7),
(45, '2526170340732', 'Dr. Arvel Reilly DDS', 'quas', 1980, '18308.97', 3),
(46, '0159031456086', 'Lewis Smitham', 'odio', 1974, '55253.30', 7),
(47, '1579818316935', 'Savannah Wilkinson', 'iste', 2018, '40589.90', 5),
(48, '1934230355847', 'Prof. Pearlie Renner', 'modi', 1979, '76414.91', 9),
(49, '1623194667645', 'Wyatt Kovacek', 'qui', 1989, '44866.93', 1),
(50, '2350982094503', 'Ron Corwin III', 'hic', 1973, '51631.27', 4),
(51, '6766190130111', 'Prof. Hipolito Berge', 'assumenda', 1970, '77132.67', 3),
(52, '7473243517087', 'Lowell Stamm II', 'dolore', 2006, '39335.51', 6),
(53, '8989080320319', 'Mr. Cristina King', 'aut', 2021, '74041.68', 4);

-- --------------------------------------------------------

--
-- Table structure for table `recall_cars`
--

CREATE TABLE `recall_cars` (
  `RecallID` bigint(20) UNSIGNED NOT NULL,
  `RecallNumber` varchar(255) NOT NULL,
  `RecallYear` int(11) NOT NULL,
  `MakeModel` varchar(255) NOT NULL,
  `RecallDate` date NOT NULL,
  `VehicleID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recall_cars`
--

INSERT INTO `recall_cars` (`RecallID`, `RecallNumber`, `RecallYear`, `MakeModel`, `RecallDate`, `VehicleID`) VALUES
(1, '337622', 1984, 'Alden Hirthe', '1987-01-04', 1),
(2, '632225', 2014, 'Lavada Beer', '2002-01-19', 2),
(3, '647795', 1994, 'Maurice Hartmann', '1976-06-11', 3),
(4, '427795', 1985, 'Lesly Kirlin', '1984-05-09', 4),
(5, '283032', 1991, 'Durward Hills', '1970-04-10', 5),
(6, '741130', 1997, 'Alexa Dietrich DVM', '2006-05-18', 6),
(7, '715782', 1973, 'Dr. Rachael Cummerata II', '2008-01-02', 7),
(8, '316057', 1983, 'Velma Hirthe', '2019-07-04', 8),
(9, '211297', 1970, 'Montana McLaughlin', '2014-02-28', 9),
(10, '928383', 1996, 'Joesph Conn', '2008-12-30', 10);

-- --------------------------------------------------------

--
-- Table structure for table `ws_log`
--

CREATE TABLE `ws_log` (
  `log_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `user_action` varchar(255) NOT NULL,
  `logged_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ws_users`
--

CREATE TABLE `ws_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_emissions`
--
ALTER TABLE `car_emissions`
  ADD PRIMARY KEY (`CarEmissionID`),
  ADD KEY `car_emissions_carspecsid_foreign` (`CarSpecsID`),
  ADD KEY `car_emissions_vehicleid_foreign` (`VehicleID`);

--
-- Indexes for table `car_specs`
--
ALTER TABLE `car_specs`
  ADD PRIMARY KEY (`SpecsID`),
  ADD KEY `car_specs_vehicleid_foreign` (`VehicleID`);

--
-- Indexes for table `charge_stations`
--
ALTER TABLE `charge_stations`
  ADD PRIMARY KEY (`StationID`),
  ADD KEY `charge_stations_countryid_foreign` (`CountryID`);

--
-- Indexes for table `charging_sessions`
--
ALTER TABLE `charging_sessions`
  ADD PRIMARY KEY (`ChargingSessionID`),
  ADD KEY `charging_sessions_vehicleid_foreign` (`VehicleID`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`CountryID`);

--
-- Indexes for table `electric_vehicles`
--
ALTER TABLE `electric_vehicles`
  ADD PRIMARY KEY (`VehicleID`),
  ADD UNIQUE KEY `electric_vehicles_vin_unique` (`VIN`),
  ADD KEY `electric_vehicles_stationid_foreign` (`StationID`);

--
-- Indexes for table `recall_cars`
--
ALTER TABLE `recall_cars`
  ADD PRIMARY KEY (`RecallID`),
  ADD KEY `recall_cars_vehicleid_foreign` (`VehicleID`);

--
-- Indexes for table `ws_log`
--
ALTER TABLE `ws_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `ws_users`
--
ALTER TABLE `ws_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_emissions`
--
ALTER TABLE `car_emissions`
  MODIFY `CarEmissionID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `car_specs`
--
ALTER TABLE `car_specs`
  MODIFY `SpecsID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `charge_stations`
--
ALTER TABLE `charge_stations`
  MODIFY `StationID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `charging_sessions`
--
ALTER TABLE `charging_sessions`
  MODIFY `ChargingSessionID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `CountryID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `electric_vehicles`
--
ALTER TABLE `electric_vehicles`
  MODIFY `VehicleID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `recall_cars`
--
ALTER TABLE `recall_cars`
  MODIFY `RecallID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ws_log`
--
ALTER TABLE `ws_log`
  MODIFY `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ws_users`
--
ALTER TABLE `ws_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_emissions`
--
ALTER TABLE `car_emissions`
  ADD CONSTRAINT `car_emissions_carspecsid_foreign` FOREIGN KEY (`CarSpecsID`) REFERENCES `car_specs` (`SpecsID`),
  ADD CONSTRAINT `car_emissions_vehicleid_foreign` FOREIGN KEY (`VehicleID`) REFERENCES `electric_vehicles` (`VehicleID`);

--
-- Constraints for table `car_specs`
--
ALTER TABLE `car_specs`
  ADD CONSTRAINT `car_specs_vehicleid_foreign` FOREIGN KEY (`VehicleID`) REFERENCES `electric_vehicles` (`VehicleID`);

--
-- Constraints for table `charge_stations`
--
ALTER TABLE `charge_stations`
  ADD CONSTRAINT `charge_stations_countryid_foreign` FOREIGN KEY (`CountryID`) REFERENCES `countries` (`CountryID`);

--
-- Constraints for table `charging_sessions`
--
ALTER TABLE `charging_sessions`
  ADD CONSTRAINT `charging_sessions_vehicleid_foreign` FOREIGN KEY (`VehicleID`) REFERENCES `electric_vehicles` (`VehicleID`);

--
-- Constraints for table `electric_vehicles`
--
ALTER TABLE `electric_vehicles`
  ADD CONSTRAINT `electric_vehicles_stationid_foreign` FOREIGN KEY (`StationID`) REFERENCES `charge_stations` (`StationID`);

--
-- Constraints for table `recall_cars`
--
ALTER TABLE `recall_cars`
  ADD CONSTRAINT `recall_cars_vehicleid_foreign` FOREIGN KEY (`VehicleID`) REFERENCES `electric_vehicles` (`VehicleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
