/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 80030
Source Host           : localhost:3306
Source Database       : slim-laravel-migration

Target Server Type    : MYSQL
Target Server Version : 80030
File Encoding         : 65001

Date: 2023-10-14 02:07:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `car_emissions`
-- ----------------------------
DROP TABLE IF EXISTS `car_emissions`;
CREATE TABLE `car_emissions` (
  `CarEmissionID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `CarSpecsID` bigint unsigned NOT NULL,
  `CO2Emission` decimal(8,2) NOT NULL,
  `NOxEmission` decimal(8,2) NOT NULL,
  `ParticularEmission` decimal(8,2) NOT NULL,
  `VehicleID` bigint unsigned NOT NULL,
  PRIMARY KEY (`CarEmissionID`),
  KEY `car_emissions_carspecsid_foreign` (`CarSpecsID`),
  KEY `car_emissions_vehicleid_foreign` (`VehicleID`),
  CONSTRAINT `car_emissions_carspecsid_foreign` FOREIGN KEY (`CarSpecsID`) REFERENCES `car_specs` (`SpecsID`),
  CONSTRAINT `car_emissions_vehicleid_foreign` FOREIGN KEY (`VehicleID`) REFERENCES `electric_vehicles` (`VehicleID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of car_emissions
-- ----------------------------
INSERT INTO `car_emissions` VALUES ('1', '1', '9.16', '0.82', '0.03', '1');
INSERT INTO `car_emissions` VALUES ('2', '2', '5.73', '0.37', '0.04', '2');
INSERT INTO `car_emissions` VALUES ('3', '3', '5.68', '0.70', '0.03', '3');
INSERT INTO `car_emissions` VALUES ('4', '4', '9.53', '0.28', '0.05', '4');
INSERT INTO `car_emissions` VALUES ('5', '5', '6.19', '0.97', '0.02', '5');
INSERT INTO `car_emissions` VALUES ('6', '6', '7.99', '0.20', '0.02', '6');
INSERT INTO `car_emissions` VALUES ('7', '7', '3.29', '0.57', '0.03', '7');
INSERT INTO `car_emissions` VALUES ('8', '8', '5.07', '0.16', '0.01', '8');
INSERT INTO `car_emissions` VALUES ('9', '9', '3.44', '0.82', '0.07', '9');
INSERT INTO `car_emissions` VALUES ('10', '10', '5.09', '0.41', '0.09', '10');

-- ----------------------------
-- Table structure for `car_specs`
-- ----------------------------
DROP TABLE IF EXISTS `car_specs`;
CREATE TABLE `car_specs` (
  `SpecsID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ChargingTime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Range` int NOT NULL,
  `BatteryCapacity` decimal(8,2) NOT NULL,
  `FuelType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FuelEfficiency` decimal(5,2) NOT NULL,
  `VehicleID` bigint unsigned NOT NULL,
  PRIMARY KEY (`SpecsID`),
  KEY `car_specs_vehicleid_foreign` (`VehicleID`),
  CONSTRAINT `car_specs_vehicleid_foreign` FOREIGN KEY (`VehicleID`) REFERENCES `electric_vehicles` (`VehicleID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of car_specs
-- ----------------------------
INSERT INTO `car_specs` VALUES ('1', '10:47:53', '388', '93.89', 'Electric', '6.65', '1');
INSERT INTO `car_specs` VALUES ('2', '17:20:47', '202', '82.69', 'Hybrid', '6.00', '2');
INSERT INTO `car_specs` VALUES ('3', '06:25:41', '470', '90.29', 'Electric', '1.30', '3');
INSERT INTO `car_specs` VALUES ('4', '23:37:43', '102', '55.34', 'Hybrid', '6.53', '4');
INSERT INTO `car_specs` VALUES ('5', '17:13:47', '200', '62.39', 'Electric', '9.76', '5');
INSERT INTO `car_specs` VALUES ('6', '18:16:04', '339', '86.03', 'Other', '4.67', '6');
INSERT INTO `car_specs` VALUES ('7', '07:22:37', '193', '92.48', 'Other', '2.98', '7');
INSERT INTO `car_specs` VALUES ('8', '05:56:17', '433', '44.00', 'Other', '6.40', '8');
INSERT INTO `car_specs` VALUES ('9', '01:07:02', '387', '33.13', 'Electric', '5.06', '9');
INSERT INTO `car_specs` VALUES ('10', '13:25:21', '483', '87.90', 'Hybrid', '8.73', '10');

-- ----------------------------
-- Table structure for `charge_stations`
-- ----------------------------
DROP TABLE IF EXISTS `charge_stations`;
CREATE TABLE `charge_stations` (
  `StationID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OperatorName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NumberOfPorts` int NOT NULL,
  `CountryID` bigint unsigned NOT NULL,
  PRIMARY KEY (`StationID`),
  KEY `charge_stations_countryid_foreign` (`CountryID`),
  CONSTRAINT `charge_stations_countryid_foreign` FOREIGN KEY (`CountryID`) REFERENCES `countries` (`CountryID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of charge_stations
-- ----------------------------
INSERT INTO `charge_stations` VALUES ('1', 'Mann-Haag', '45483 Mraz Ford Apt. 735\nSanfordburgh, ME 56001', 'Keeling, Nienow and Hills', '9', '1');
INSERT INTO `charge_stations` VALUES ('2', 'Bechtelar-Lueilwitz', '587 O\'Reilly Court\nPiperland, MA 85154-5715', 'McLaughlin-Lesch', '9', '1');
INSERT INTO `charge_stations` VALUES ('3', 'Hintz-Marks', '58647 Goldner Parks Apt. 948\nLindgrenland, CO 79322', 'Davis-Wilkinson', '2', '2');
INSERT INTO `charge_stations` VALUES ('4', 'Bruen, Deckow and Gusikowski', '46021 Estrella Track Suite 336\nJewellport, NY 88848', 'Bartoletti-Hagenes', '7', '2');
INSERT INTO `charge_stations` VALUES ('5', 'Olson-Padberg', '68903 Emory Forks Apt. 547\nSidland, MS 01737-0682', 'Schaefer-Moen', '7', '3');
INSERT INTO `charge_stations` VALUES ('6', 'Blanda-Mueller', '7148 Birdie Tunnel\nArchibaldville, TN 44714-6603', 'Corwin Group', '8', '4');
INSERT INTO `charge_stations` VALUES ('7', 'Jaskolski-Pollich', '77315 Kirlin Harbor\nWest Prudence, AL 94961-7190', 'Shanahan-Zboncak', '1', '5');
INSERT INTO `charge_stations` VALUES ('8', 'Torp-Jacobson', '93457 Ayla Avenue Suite 654\nNew Frieda, DC 36717-4025', 'Langworth, Lueilwitz and Bruen', '6', '6');
INSERT INTO `charge_stations` VALUES ('9', 'Ebert Ltd', '513 Streich Springs Apt. 844\nNew Korbin, PA 01097-4392', 'Hegmann-Beier', '3', '9');
INSERT INTO `charge_stations` VALUES ('10', 'Kemmer, McGlynn and Kautzer', '1432 Alyson Dam\nLake Talia, ME 45625', 'Murray, Abernathy and Abbott', '5', '9');

-- ----------------------------
-- Table structure for `charging_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `charging_sessions`;
CREATE TABLE `charging_sessions` (
  `ChargingSessionID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ChargingStartTime` timestamp NOT NULL,
  `ChargingEndTime` timestamp NOT NULL,
  `EnergyConsumed` decimal(10,2) NOT NULL,
  `VehicleID` bigint unsigned NOT NULL,
  PRIMARY KEY (`ChargingSessionID`),
  KEY `charging_sessions_vehicleid_foreign` (`VehicleID`),
  CONSTRAINT `charging_sessions_vehicleid_foreign` FOREIGN KEY (`VehicleID`) REFERENCES `electric_vehicles` (`VehicleID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of charging_sessions
-- ----------------------------
INSERT INTO `charging_sessions` VALUES ('1', '2023-04-10 01:37:49', '2023-04-10 12:13:46', '46.03', '1');
INSERT INTO `charging_sessions` VALUES ('2', '2023-05-01 09:40:58', '2023-05-01 17:32:41', '18.87', '2');
INSERT INTO `charging_sessions` VALUES ('3', '2023-04-09 15:25:01', '2023-04-10 07:35:46', '28.37', '3');
INSERT INTO `charging_sessions` VALUES ('4', '2023-01-23 16:46:28', '2023-01-24 02:31:39', '12.39', '4');
INSERT INTO `charging_sessions` VALUES ('5', '2023-05-13 07:46:07', '2023-05-14 05:44:17', '19.72', '5');
INSERT INTO `charging_sessions` VALUES ('6', '2023-05-03 02:44:46', '2023-05-03 11:47:36', '45.77', '6');
INSERT INTO `charging_sessions` VALUES ('7', '2023-04-29 07:54:14', '2023-04-30 00:10:41', '49.52', '7');
INSERT INTO `charging_sessions` VALUES ('8', '2023-03-26 11:13:15', '2023-03-26 20:59:47', '9.46', '8');
INSERT INTO `charging_sessions` VALUES ('9', '2023-08-28 11:21:51', '2023-08-28 13:51:15', '33.70', '9');
INSERT INTO `charging_sessions` VALUES ('10', '2023-09-26 11:16:01', '2023-09-26 20:26:25', '18.35', '10');

-- ----------------------------
-- Table structure for `countries`
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `CountryID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `City` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PostalCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`CountryID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'Alvisburgh', '72951-4598');
INSERT INTO `countries` VALUES ('2', 'Bonnieshire', '59338');
INSERT INTO `countries` VALUES ('3', 'Colleenchester', '93343');
INSERT INTO `countries` VALUES ('4', 'Hartmannport', '67550');
INSERT INTO `countries` VALUES ('5', 'New Emilie', '32063');
INSERT INTO `countries` VALUES ('6', 'South Wilber', '10880');
INSERT INTO `countries` VALUES ('7', 'West Amariton', '62764');
INSERT INTO `countries` VALUES ('8', 'East Magnoliaview', '16057');
INSERT INTO `countries` VALUES ('9', 'New Lewbury', '72732');
INSERT INTO `countries` VALUES ('10', 'South Maryse', '42084');
INSERT INTO `countries` VALUES ('11', 'Kacieborough', '78331-5764');

-- ----------------------------
-- Table structure for `electric_vehicles`
-- ----------------------------
DROP TABLE IF EXISTS `electric_vehicles`;
CREATE TABLE `electric_vehicles` (
  `VehicleID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `VIN` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Maker` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Year` year NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `StationID` bigint unsigned NOT NULL,
  PRIMARY KEY (`VehicleID`),
  UNIQUE KEY `electric_vehicles_vin_unique` (`VIN`),
  KEY `electric_vehicles_stationid_foreign` (`StationID`),
  CONSTRAINT `electric_vehicles_stationid_foreign` FOREIGN KEY (`StationID`) REFERENCES `charge_stations` (`StationID`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of electric_vehicles
-- ----------------------------
INSERT INTO `electric_vehicles` VALUES ('1', '8122497599859', 'Lyric Kohler', 'quisquam', '2020', '48684.36', '3');
INSERT INTO `electric_vehicles` VALUES ('2', '0406892735714', 'Jaden Hyatt', 'sequi', '1992', '31203.80', '9');
INSERT INTO `electric_vehicles` VALUES ('3', '8391638404219', 'Kelvin Koepp MD', 'dolores', '1973', '31757.90', '9');
INSERT INTO `electric_vehicles` VALUES ('4', '4347474635410', 'Abbigail Corkery', 'aut', '2007', '16886.72', '1');
INSERT INTO `electric_vehicles` VALUES ('5', '7351519030112', 'Kaitlyn Graham', 'doloribus', '1974', '25449.57', '2');
INSERT INTO `electric_vehicles` VALUES ('6', '6685987328541', 'Dr. Clifton Osinski II', 'et', '1996', '75980.35', '9');
INSERT INTO `electric_vehicles` VALUES ('7', '0896331247746', 'Elroy Ruecker', 'et', '1989', '35775.84', '3');
INSERT INTO `electric_vehicles` VALUES ('8', '3415017544503', 'Lamar Miller', 'vero', '1995', '41586.35', '6');
INSERT INTO `electric_vehicles` VALUES ('9', '2415608228950', 'Maryse Sawayn', 'et', '2020', '78855.61', '2');
INSERT INTO `electric_vehicles` VALUES ('10', '3112678334244', 'Prof. Josue Davis Sr.', 'ut', '1974', '52715.91', '4');
INSERT INTO `electric_vehicles` VALUES ('11', '6451153069378', 'Mr. Casimer Schuppe DVM', 'labore', '2004', '44832.85', '8');
INSERT INTO `electric_vehicles` VALUES ('12', '4247799550125', 'Ansley Crist', 'qui', '2023', '79696.72', '10');
INSERT INTO `electric_vehicles` VALUES ('13', '9862079382422', 'Justen Feeney DDS', 'nihil', '2009', '53242.77', '1');
INSERT INTO `electric_vehicles` VALUES ('14', '6609360762678', 'Kamryn Hirthe', 'ut', '1998', '52118.06', '6');
INSERT INTO `electric_vehicles` VALUES ('15', '6479206978323', 'Dr. Horace Mayer', 'cum', '1999', '77966.48', '7');
INSERT INTO `electric_vehicles` VALUES ('16', '4473969168641', 'Salma Legros', 'ea', '1974', '20236.06', '3');
INSERT INTO `electric_vehicles` VALUES ('17', '7386357220753', 'Vernie Parker', 'velit', '2015', '25216.15', '5');
INSERT INTO `electric_vehicles` VALUES ('18', '2814613837353', 'Prof. Marco Shields Sr.', 'sequi', '2002', '78739.44', '10');
INSERT INTO `electric_vehicles` VALUES ('19', '5442465881995', 'Mr. Sylvan Howe PhD', 'ea', '1975', '31105.65', '7');
INSERT INTO `electric_vehicles` VALUES ('20', '9557453774695', 'Whitney Smitham', 'nostrum', '1998', '50754.08', '7');
INSERT INTO `electric_vehicles` VALUES ('21', '2243543065763', 'Caterina Mertz', 'odit', '1996', '16796.29', '9');
INSERT INTO `electric_vehicles` VALUES ('22', '6289767090576', 'Charlotte Paucek Sr.', 'ullam', '2019', '48736.80', '2');
INSERT INTO `electric_vehicles` VALUES ('23', '7785390768770', 'Florencio Marquardt', 'cumque', '2012', '71982.17', '7');
INSERT INTO `electric_vehicles` VALUES ('24', '7142040347998', 'Felicity Heller', 'unde', '1989', '70987.08', '8');
INSERT INTO `electric_vehicles` VALUES ('25', '2244509275196', 'Otilia Collier', 'aut', '2020', '12358.02', '5');
INSERT INTO `electric_vehicles` VALUES ('26', '6268636895719', 'German Koelpin', 'atque', '1978', '37594.22', '3');
INSERT INTO `electric_vehicles` VALUES ('27', '7818517275063', 'Shaniya Crooks', 'molestiae', '1996', '11680.60', '4');
INSERT INTO `electric_vehicles` VALUES ('28', '4102767295920', 'Mrs. Dena Upton V', 'distinctio', '2020', '44855.94', '7');
INSERT INTO `electric_vehicles` VALUES ('29', '3329789386882', 'Dr. Marion Harber', 'doloribus', '1997', '65020.50', '6');
INSERT INTO `electric_vehicles` VALUES ('30', '7095167911989', 'Mr. Joesph Yost', 'non', '2008', '23698.07', '3');
INSERT INTO `electric_vehicles` VALUES ('31', '6776692859458', 'Kelsi Murray', 'itaque', '2001', '77959.94', '5');
INSERT INTO `electric_vehicles` VALUES ('32', '6233706764523', 'Clemmie Cremin', 'non', '2015', '30331.09', '6');
INSERT INTO `electric_vehicles` VALUES ('33', '6498258168810', 'Colleen Hoppe I', 'pariatur', '1989', '21665.60', '8');
INSERT INTO `electric_vehicles` VALUES ('34', '2961425609101', 'Ms. Pearl Hermiston MD', 'dolores', '2001', '52608.38', '5');
INSERT INTO `electric_vehicles` VALUES ('35', '6611248886369', 'Nicole Kuhlman', 'quo', '1972', '48101.66', '7');
INSERT INTO `electric_vehicles` VALUES ('36', '6378825975044', 'Wilburn Streich', 'sint', '2010', '33132.23', '1');
INSERT INTO `electric_vehicles` VALUES ('37', '9557252845862', 'Mr. Ashton Hermann MD', 'vero', '1977', '20941.66', '2');
INSERT INTO `electric_vehicles` VALUES ('38', '1468782802462', 'Ms. Tressie Windler', 'nostrum', '2005', '38891.04', '5');
INSERT INTO `electric_vehicles` VALUES ('39', '1666599470151', 'Carmela Kling', 'omnis', '2008', '48925.20', '8');
INSERT INTO `electric_vehicles` VALUES ('40', '2094946072113', 'Major Brown', 'qui', '1992', '57560.47', '5');
INSERT INTO `electric_vehicles` VALUES ('41', '2071649749702', 'Woodrow Block', 'voluptas', '2004', '72497.14', '2');
INSERT INTO `electric_vehicles` VALUES ('42', '9687667183997', 'Mrs. Alexandria Stoltenberg DDS', 'ea', '2008', '62360.38', '3');
INSERT INTO `electric_vehicles` VALUES ('43', '5219960562724', 'Prof. Tremayne Dicki I', 'id', '1997', '54399.75', '6');
INSERT INTO `electric_vehicles` VALUES ('44', '2970228791999', 'Dr. Alexzander White', 'consequatur', '1990', '69116.51', '7');
INSERT INTO `electric_vehicles` VALUES ('45', '2526170340732', 'Dr. Arvel Reilly DDS', 'quas', '1980', '18308.97', '3');
INSERT INTO `electric_vehicles` VALUES ('46', '0159031456086', 'Lewis Smitham', 'odio', '1974', '55253.30', '7');
INSERT INTO `electric_vehicles` VALUES ('47', '1579818316935', 'Savannah Wilkinson', 'iste', '2018', '40589.90', '5');
INSERT INTO `electric_vehicles` VALUES ('48', '1934230355847', 'Prof. Pearlie Renner', 'modi', '1979', '76414.91', '9');
INSERT INTO `electric_vehicles` VALUES ('49', '1623194667645', 'Wyatt Kovacek', 'qui', '1989', '44866.93', '1');
INSERT INTO `electric_vehicles` VALUES ('50', '2350982094503', 'Ron Corwin III', 'hic', '1973', '51631.27', '4');
INSERT INTO `electric_vehicles` VALUES ('51', '6766190130111', 'Prof. Hipolito Berge', 'assumenda', '1970', '77132.67', '3');
INSERT INTO `electric_vehicles` VALUES ('52', '7473243517087', 'Lowell Stamm II', 'dolore', '2006', '39335.51', '6');
INSERT INTO `electric_vehicles` VALUES ('53', '8989080320319', 'Mr. Cristina King', 'aut', '2021', '74041.68', '4');

-- ----------------------------
-- Table structure for `recall_cars`
-- ----------------------------
DROP TABLE IF EXISTS `recall_cars`;
CREATE TABLE `recall_cars` (
  `RecallID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `RecallNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RecallYear` int NOT NULL,
  `MakeModel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RecallDate` date NOT NULL,
  `VehicleID` bigint unsigned NOT NULL,
  PRIMARY KEY (`RecallID`),
  KEY `recall_cars_vehicleid_foreign` (`VehicleID`),
  CONSTRAINT `recall_cars_vehicleid_foreign` FOREIGN KEY (`VehicleID`) REFERENCES `electric_vehicles` (`VehicleID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of recall_cars
-- ----------------------------
INSERT INTO `recall_cars` VALUES ('1', '337622', '1984', 'Alden Hirthe', '1987-01-04', '1');
INSERT INTO `recall_cars` VALUES ('2', '632225', '2014', 'Lavada Beer', '2002-01-19', '2');
INSERT INTO `recall_cars` VALUES ('3', '647795', '1994', 'Maurice Hartmann', '1976-06-11', '3');
INSERT INTO `recall_cars` VALUES ('4', '427795', '1985', 'Lesly Kirlin', '1984-05-09', '4');
INSERT INTO `recall_cars` VALUES ('5', '283032', '1991', 'Durward Hills', '1970-04-10', '5');
INSERT INTO `recall_cars` VALUES ('6', '741130', '1997', 'Alexa Dietrich DVM', '2006-05-18', '6');
INSERT INTO `recall_cars` VALUES ('7', '715782', '1973', 'Dr. Rachael Cummerata II', '2008-01-02', '7');
INSERT INTO `recall_cars` VALUES ('8', '316057', '1983', 'Velma Hirthe', '2019-07-04', '8');
INSERT INTO `recall_cars` VALUES ('9', '211297', '1970', 'Montana McLaughlin', '2014-02-28', '9');
INSERT INTO `recall_cars` VALUES ('10', '928383', '1996', 'Joesph Conn', '2008-12-30', '10');
