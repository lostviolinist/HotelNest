-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 06:49 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotelName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `emial`, `password`, `hotelName`, `created_at`, `updated_at`) VALUES
(1, 'SWE1704010@xmu.edu.my', 'swe1704010', 'XMUM hotel', NULL, NULL),
(2, 'SWE1704023@xmu.edu.my', 'swe1704023', 'Smart Boutique Hotel', NULL, NULL),
(3, 'SWE1704587@xmu.edu.my', 'swe1704587', 'Sahabat Guesthouse', NULL, NULL),
(4, 'SWE1704211@xmu.edu.my', 'swe1704211', 'Cititel Mid Valley', NULL, NULL),
(5, 'SWE1704022xmu.edu.my', 'swe1704022', 'Hotel Sentral Seaview @Beachfront', NULL, NULL),
(6, 'SWE1704033@xmu.edu.my', 'swe1704033', 'OYO 11339 Istay Hotel', NULL, NULL),
(7, 'SWE1704004@xmu.edu.my', 'swe1704004', 'Wassup Youth Hostel', NULL, NULL),
(8, 'SWE1704205@xmu.edu.my', 'swe1704205', 'Dragonair Hotel', NULL, NULL),
(9, 'SWE1704144@xmu.edu.my', 'swe1704144', 'CityView Kotawarisan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingNum` bigint(20) UNSIGNED NOT NULL,
  `fullName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icNum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkInDate` date NOT NULL,
  `checkOutDate` date NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adult` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `totalPrice` double NOT NULL,
  `roomId` int(11) NOT NULL,
  `hotelId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotelId` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkInTime` time NOT NULL,
  `checkOutTime` time NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `star` int(11) NOT NULL,
  `operationTime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotelId`, `name`, `checkInTime`, `checkOutTime`, `city`, `address`, `star`, `operationTime`, `description`, `created_at`, `updated_at`) VALUES
(1, 'XMUM hotel', '15:00:00', '12:00:00', 'Sepang', 'Jalan sunsuria, bandar sunsuria', 5, '8.00 am to 9.00pm', 'Best hostel among uni!', NULL, NULL),
(2, 'Smart Boutique Hotel', '14:00:00', '12:00:00', 'Kuala Lumpur', ' 451 Seksyen 41, Jalan Tuanku Abdul Rahman,, Chow Kit, 50100 Kuala Lumpur, Malaysia', 3, '24 hours', 'Chow Kit is a great choice for travellers interested in convenient public transport, city walks and shopping.', NULL, NULL),
(3, 'Sahabat Guesthouse', '15:00:00', '12:00:00', 'Kuala Lumpur', 'No. 39 & 41, Jalan Sahabat Off Tengkat Tong Shin, Bukit Bintang, 50200 Kuala Lumpur, Malaysia', 0, '9 am to 6 pm', 'Sahabat Guesthouse comes with a common area where guests can socialise. It is fitted with a large sofa and a flat-screen TV with satellite channels. A shared refrigerator is available and outdoor seating is available.', NULL, NULL),
(4, 'Cititel Mid Valley', '14:00:00', '12:00:00', 'Kuala Lumpur', 'Mid Valley City, Lingkaran Syed Putra, 59200 Kuala Lumpur, Malaysia', 3, '24-hour', 'Just steps from Mid Valley Megamall which houses a spa and pool, Cititel Mid Valley is a 5-minute walk from Mid Valley Komuter Train Station. Guests can enjoy meals from the in-house restaurant or have a drink at the bar. Free WiFi is available throughout', NULL, NULL),
(5, 'Hotel Sentral Seaview @Beachfront', '15:00:00', '12:00:00', 'George Town', '55, Jalan Cm Hashim, Tanjung Tokong, 11200 George Town, Malaysia', 3, '24-hour', 'Hotel Sentral Seaview, Penang is a 10-minute drive from Georgetown City and 19 km from Penang Airport. We speak your language!', NULL, NULL),
(6, 'OYO 11339 Istay Hotel', '14:00:00', '12:00:00', 'George Town', '94 & 96, Rangoon Road, Georgetown, 10400 George Town, Malaysia', 2, '24-hour', 'OYO 11339 Istay Hotel is set in George Town, 2.1 km from Penang Times Square and 2.6 km from Wonderfood Museum. The property is situated 1.9 km from Prangin Mall, 2.9 km from Pinang Peranakan Mansion and 3.1 km from Penang Jetty. Free WiFi and a 24-hour f', NULL, NULL),
(7, 'Wassup Youth Hostel', '14:30:00', '12:00:00', 'George Town', '495E, Jalan Penang, Georgetown, Penang, 10000 George Town, Malaysia', 0, '10.00am - 9.00pm', 'Strategically located in the heart of UNESCO World Heritage Site of George Town, Wassup Youth Hostel offers accommodations in Penang. It features an outdoor swimming pool and guests can enjoy a drink at the bar. Free WiFi is available throughout the prope', NULL, NULL),
(50, 'Dragonair Hotel', '15:00:00', '12:00:00', 'Sepang', 'Lot Pt 13, Jalan KLIA 2/2, 64000 KLIA, Selangor Darul Ehsan, 64000 Sepang, Malaysia', 5, '8.00 a.m. - 10.00 p.m.', 'We are the best hotel in Sepang!', NULL, NULL),
(52, 'CityView Kotawarisan', '16:00:00', '11:00:00', 'Sepang', '7G Jalan Warisan Sentra 1,Kip Sentral Kota Warisan, 43900 Sepang, Malaysia', 2, '8am to 5pm', 'Just beside Nasi lemak Royal~ Centre are also within 9 mi (15 km).', '2019-11-11 23:11:46', '2019-11-11 23:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_facilities`
--

CREATE TABLE `hotel_facilities` (
  `hotelId` bigint(20) NOT NULL,
  `breakfast` tinyint(1) NOT NULL,
  `24hrReception` tinyint(1) NOT NULL,
  `smoking` tinyint(1) NOT NULL,
  `freeWifi` tinyint(1) NOT NULL,
  `gymRoom` tinyint(1) NOT NULL,
  `freeParking` tinyint(1) NOT NULL,
  `petAllow` tinyint(1) NOT NULL,
  `swimmingPool` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_facilities`
--

INSERT INTO `hotel_facilities` (`hotelId`, `breakfast`, `24hrReception`, `smoking`, `freeWifi`, `gymRoom`, `freeParking`, `petAllow`, `swimmingPool`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 1, 1, 1, 0, 1, NULL, NULL),
(2, 1, 1, 0, 1, 0, 1, 0, 1, NULL, NULL),
(3, 1, 0, 0, 1, 1, 1, 0, 0, NULL, NULL),
(4, 1, 1, 0, 1, 0, 1, 0, 0, NULL, NULL),
(5, 1, 1, 1, 0, 1, 0, 1, 0, NULL, NULL),
(6, 1, 1, 0, 1, 1, 1, 0, 1, NULL, NULL),
(7, 1, 0, 0, 1, 0, 1, 0, 0, NULL, NULL),
(50, 1, 1, 0, 1, 1, 1, 1, 1, NULL, NULL),
(52, 0, 0, 1, 1, 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_pictures`
--

CREATE TABLE `hotel_pictures` (
  `hotelId` int(11) NOT NULL,
  `num` bigint(20) UNSIGNED NOT NULL,
  `picturePath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(20, '2014_10_12_100000_create_password_resets_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2019_10_28_082609_create_users_table', 1),
(23, '2019_10_29_071700_create_hotels_table', 1),
(24, '2019_10_29_073252_create_rooms_table', 1),
(25, '2019_10_29_083308_create_room_infos_table', 1),
(27, '2019_10_30_071700_create_hotels_table', 2),
(28, '2019_11_12_170136_create_admins_table', 3),
(29, '2019_11_12_170234_create_bookings_table', 4),
(30, '2019_11_12_170311_create_hotel_facilities_table', 5),
(31, '2019_11_12_170330_create_room_facilities_table', 6),
(32, '2019_11_12_171819_create_room_pictures_table', 7),
(33, '2019_11_12_171832_create_hotel_pictures_table', 8),
(34, '2019_11_15_054615_create_user_pictures_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomId` bigint(20) UNSIGNED NOT NULL,
  `hotelId` int(11) NOT NULL,
  `roomNum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomId`, `hotelId`, `roomNum`, `available`, `created_at`, `updated_at`) VALUES
(1, 1, 'A101', 1, NULL, NULL),
(1, 2, '1-01', 1, NULL, NULL),
(1, 3, '101', 1, NULL, NULL),
(1, 4, '101', 1, NULL, NULL),
(1, 5, '101', 1, NULL, NULL),
(1, 6, '1-1', 1, NULL, NULL),
(1, 7, '101', 1, NULL, NULL),
(1, 50, 'A-1', 1, NULL, NULL),
(1, 52, '1', 1, NULL, NULL),
(2, 1, 'A102', 1, NULL, NULL),
(2, 2, '1-02', 1, NULL, NULL),
(2, 3, '102', 1, NULL, NULL),
(2, 4, '102', 1, NULL, NULL),
(2, 5, '102', 1, NULL, NULL),
(2, 6, '1-2', 1, NULL, NULL),
(2, 7, '102', 1, NULL, NULL),
(2, 50, 'A-2', 1, NULL, NULL),
(2, 52, '2', 1, NULL, NULL),
(3, 1, 'A103', 1, NULL, NULL),
(3, 2, '1-03', 1, NULL, NULL),
(3, 3, '103', 1, NULL, NULL),
(3, 4, '103', 1, NULL, NULL),
(3, 5, '103', 1, NULL, NULL),
(3, 6, '1-3', 1, NULL, NULL),
(3, 7, '103', 1, NULL, NULL),
(3, 50, 'A-3', 1, NULL, NULL),
(3, 52, '3', 1, NULL, NULL),
(4, 1, 'A104', 1, NULL, NULL),
(4, 2, '1-03A', 1, NULL, NULL),
(4, 3, '104', 1, NULL, NULL),
(4, 4, '104', 1, NULL, NULL),
(4, 5, '104', 1, NULL, NULL),
(4, 6, '1-4', 1, NULL, NULL),
(4, 7, '104', 1, NULL, NULL),
(4, 50, 'A-4', 1, NULL, NULL),
(4, 52, '4', 1, NULL, NULL),
(5, 1, 'A105', 1, NULL, NULL),
(5, 2, '1-05', 1, NULL, NULL),
(5, 3, '105', 1, NULL, NULL),
(5, 4, '105', 1, NULL, NULL),
(5, 5, '105', 1, NULL, NULL),
(5, 6, '1-5', 1, NULL, NULL),
(5, 7, '105', 1, NULL, NULL),
(5, 50, 'B-1', 1, NULL, NULL),
(5, 52, '5', 1, NULL, NULL),
(6, 1, 'B101', 1, NULL, NULL),
(6, 2, '1-06', 1, NULL, NULL),
(6, 3, '106', 1, NULL, NULL),
(6, 4, '106', 1, NULL, NULL),
(6, 5, '106', 1, NULL, NULL),
(6, 6, '2-1', 1, NULL, NULL),
(6, 50, 'B-2', 1, NULL, NULL),
(7, 1, 'B102', 1, NULL, NULL),
(7, 2, '1-07', 1, NULL, NULL),
(7, 3, '201', 1, NULL, NULL),
(7, 4, '201', 1, NULL, NULL),
(7, 5, '201', 1, NULL, NULL),
(7, 6, '2-2', 1, NULL, NULL),
(7, 50, 'B-3', 1, NULL, NULL),
(8, 1, 'B103', 1, NULL, NULL),
(8, 2, '1-08', 1, NULL, NULL),
(8, 3, '202', 1, NULL, NULL),
(8, 4, '202', 1, NULL, NULL),
(8, 5, '202', 1, NULL, NULL),
(8, 6, '2-3', 1, NULL, NULL),
(8, 50, 'B-4', 1, NULL, NULL),
(9, 1, 'B104', 1, NULL, NULL),
(9, 2, '1-09', 1, NULL, NULL),
(9, 3, '203', 1, NULL, NULL),
(9, 4, '203', 1, NULL, NULL),
(9, 5, '203', 1, NULL, NULL),
(9, 6, '2-4', 1, NULL, NULL),
(9, 50, 'C-1', 1, NULL, NULL),
(10, 1, 'B105', 1, NULL, NULL),
(10, 2, '1-10', 1, NULL, NULL),
(10, 3, '204', 1, NULL, NULL),
(10, 4, '204', 1, NULL, NULL),
(10, 5, '204', 1, NULL, NULL),
(10, 6, '2-5', 1, NULL, NULL),
(10, 50, 'C-2', 1, NULL, NULL),
(11, 2, '1-11', 1, NULL, NULL),
(11, 3, '205', 1, NULL, NULL),
(11, 4, '205', 1, NULL, NULL),
(11, 5, '205', 1, NULL, NULL),
(11, 50, 'C-3', 1, NULL, NULL),
(12, 2, '1-12', 1, NULL, NULL),
(12, 3, '206', 1, NULL, NULL),
(12, 4, '206', 1, NULL, NULL),
(12, 5, '206', 1, NULL, NULL),
(12, 50, 'C-4', 1, NULL, NULL),
(13, 2, '2-01', 1, NULL, NULL),
(13, 3, '301', 1, NULL, NULL),
(13, 4, '301', 1, NULL, NULL),
(13, 5, '301', 1, NULL, NULL),
(13, 50, 'D-1', 1, NULL, NULL),
(14, 2, '2-02', 1, NULL, NULL),
(14, 3, '302', 1, NULL, NULL),
(14, 4, '302', 1, NULL, NULL),
(14, 5, '302', 1, NULL, NULL),
(14, 50, 'D-2', 1, NULL, NULL),
(15, 2, '2-03', 1, NULL, NULL),
(15, 3, '303', 1, NULL, NULL),
(15, 4, '303', 1, NULL, NULL),
(15, 5, '303', 1, NULL, NULL),
(15, 50, 'D-3', 1, NULL, NULL),
(16, 2, '2-03A', 1, NULL, NULL),
(16, 3, '304', 1, NULL, NULL),
(16, 50, 'D-4', 1, NULL, NULL),
(17, 2, '2-05', 1, NULL, NULL),
(17, 3, '305', 1, NULL, NULL),
(17, 50, 'E-1', 1, NULL, NULL),
(18, 2, '2-06', 1, NULL, NULL),
(18, 3, '306', 1, NULL, NULL),
(18, 50, 'E-2', 1, NULL, NULL),
(19, 2, '2-07', 1, NULL, NULL),
(19, 50, 'E-3', 1, NULL, NULL),
(20, 2, '3-01', 1, NULL, NULL),
(20, 50, 'E-4', 1, NULL, NULL),
(21, 2, '3-02', 1, NULL, NULL),
(22, 2, '3-03', 1, NULL, NULL),
(23, 2, '3-03A', 1, NULL, NULL),
(24, 2, '3-05', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `hotelId` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `airConditioning` tinyint(1) NOT NULL,
  `bathtub` tinyint(1) NOT NULL,
  `TV` tinyint(1) NOT NULL,
  `refrigerator` tinyint(1) NOT NULL,
  `freeToiletries` tinyint(1) NOT NULL,
  `toilet` tinyint(1) NOT NULL,
  `fan` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`hotelId`, `roomId`, `airConditioning`, `bathtub`, `TV`, `refrigerator`, `freeToiletries`, `toilet`, `fan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 1, 1, 1, 1, 0, NULL, NULL),
(1, 2, 1, 0, 1, 1, 1, 1, 0, NULL, NULL),
(1, 3, 1, 0, 1, 1, 1, 1, 0, NULL, NULL),
(1, 4, 1, 0, 1, 1, 1, 1, 0, NULL, NULL),
(1, 5, 1, 0, 1, 1, 1, 1, 0, NULL, NULL),
(1, 6, 1, 0, 1, 1, 1, 1, 0, NULL, NULL),
(1, 7, 1, 0, 1, 1, 1, 1, 0, NULL, NULL),
(1, 8, 1, 0, 1, 1, 1, 1, 0, NULL, NULL),
(1, 9, 1, 0, 1, 1, 1, 1, 0, NULL, NULL),
(1, 10, 1, 0, 1, 1, 1, 1, 0, NULL, NULL),
(2, 1, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 2, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 3, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 4, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 5, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 6, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 7, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 8, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 9, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 10, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 11, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 12, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 13, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 14, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 15, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 16, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 17, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 18, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 19, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 20, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 21, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 22, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 23, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(2, 24, 1, 1, 1, 1, 1, 1, 0, NULL, NULL),
(3, 1, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 2, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 3, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 4, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 5, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 6, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 7, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 8, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 9, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 10, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 11, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 12, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 13, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 14, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 15, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 16, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 17, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(3, 18, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 1, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 2, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 3, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 4, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 5, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 6, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 7, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 8, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 9, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 10, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 11, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 12, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 13, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 14, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(4, 15, 1, 0, 0, 1, 1, 1, 1, NULL, NULL),
(5, 1, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 2, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 3, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 4, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 5, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 6, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 7, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 8, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 9, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 10, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 11, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 12, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 13, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 14, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(5, 15, 1, 0, 1, 0, 1, 1, 1, NULL, NULL),
(6, 1, 0, 1, 1, 0, 0, 1, 1, NULL, NULL),
(6, 2, 0, 1, 1, 0, 0, 1, 1, NULL, NULL),
(6, 3, 0, 1, 1, 0, 0, 1, 1, NULL, NULL),
(6, 4, 0, 1, 1, 0, 0, 1, 1, NULL, NULL),
(6, 5, 0, 1, 1, 0, 0, 1, 1, NULL, NULL),
(6, 6, 0, 1, 1, 0, 0, 1, 1, NULL, NULL),
(6, 7, 0, 1, 1, 0, 0, 1, 1, NULL, NULL),
(6, 8, 0, 1, 1, 0, 0, 1, 1, NULL, NULL),
(6, 9, 0, 1, 1, 0, 0, 1, 1, NULL, NULL),
(6, 10, 0, 1, 1, 0, 0, 1, 1, NULL, NULL),
(7, 1, 0, 0, 1, 0, 0, 1, 1, NULL, NULL),
(7, 2, 0, 0, 1, 0, 0, 1, 1, NULL, NULL),
(7, 3, 0, 0, 1, 0, 0, 1, 1, NULL, NULL),
(7, 4, 0, 0, 1, 0, 0, 1, 1, NULL, NULL),
(7, 5, 0, 0, 1, 0, 0, 1, 1, NULL, NULL),
(50, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 2, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 3, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 4, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 5, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 6, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 7, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 8, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 9, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 10, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 11, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 12, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 13, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 14, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 15, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 16, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 17, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 18, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 19, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(50, 20, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(52, 1, 0, 0, 1, 0, 0, 1, 1, NULL, NULL),
(52, 2, 0, 0, 1, 0, 0, 1, 1, NULL, NULL),
(52, 3, 0, 0, 1, 0, 0, 1, 1, NULL, NULL),
(52, 4, 0, 0, 1, 0, 0, 1, 1, NULL, NULL),
(52, 5, 0, 0, 1, 0, 0, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_infos`
--

CREATE TABLE `room_infos` (
  `hotelId` bigint(20) NOT NULL,
  `roomId` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `pax` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addBed` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_infos`
--

INSERT INTO `room_infos` (`hotelId`, `roomId`, `type`, `price`, `pax`, `description`, `addBed`, `created_at`, `updated_at`) VALUES
(1, 1, 'Deluxe Twin Room', 300, 2, 'This double room features a electric kettle, air conditioning and satellite TV.', 1, NULL, NULL),
(2, 1, 'Standard Single Room', 48, 1, 'This single room has air conditioning.', 0, NULL, NULL),
(3, 1, 'Standard Double Room', 50, 2, 'It is good', 0, NULL, NULL),
(4, 1, 'Superior Double Room', 261, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 1, 'Superior Twin Room with Partial Sea View', 218, 2, 'Air-conditioned room with a TV and tea/coffee making facilities. Private bathroom has a shower and free toiletries', 1, NULL, NULL),
(6, 1, 'Standard Double Room', 50, 2, 'Nice', 1, NULL, NULL),
(7, 1, '4-Bed En-suite Female Dormitory Room', 33, 4, 'This air-conditioned female dormitory room offers a personal locker, individual power sockets and a reading light. The en suite bathroom includes shower facilities and free bathroom amenities.', 0, NULL, NULL),
(50, 1, 'Double Room', 250, 2, 'Larger double room with air conditioning features a queen bed, flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 0, NULL, NULL),
(52, 1, 'Standard Double Room', 75, 2, 'Fitted with a double bed, this 15 sqm features a flat-screen TV and an electric kettle. The en suite bathroom includes a shower and free toiletries.', 0, NULL, NULL),
(1, 2, 'Deluxe Twin Room', 300, 2, 'This double room features a electric kettle, air conditioning and satellite TV.', 1, NULL, NULL),
(2, 2, 'Standard Single Room', 48, 1, 'This single room has air conditioning.', 0, NULL, NULL),
(3, 2, 'Standard Double Room', 50, 2, 'It is good', 0, NULL, NULL),
(4, 2, 'Superior Double Room', 261, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 2, 'Superior Twin Room with Partial Sea View', 218, 2, 'Air-conditioned room with a TV and tea/coffee making facilities. Private bathroom has a shower and free toiletries', 1, NULL, NULL),
(6, 2, 'Standard Double Room', 50, 2, 'nice', 1, NULL, NULL),
(7, 2, '4-Bed En-suite Female Dormitory Room', 33, 4, 'This air-conditioned female dormitory room offers a personal locker, individual power sockets and a reading light. The en suite bathroom includes shower facilities and free bathroom amenities.', 0, NULL, NULL),
(50, 2, 'Double Room', 250, 2, 'Larger double room with air conditioning features a queen bed, flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 0, NULL, NULL),
(52, 2, 'Standard Double Room', 75, 2, 'Fitted with a double bed, this 15 sqm features a flat-screen TV and an electric kettle. The en suite bathroom includes a shower and free toiletries.', 0, NULL, NULL),
(1, 3, 'Deluxe Twin Room', 300, 2, 'This double room features a electric kettle, air conditioning and satellite TV.', 1, NULL, NULL),
(2, 3, 'Standard Single Room', 48, 1, 'This single room has air conditioning.', 0, NULL, NULL),
(3, 3, 'Standard Double Room', 50, 2, 'It is good', 0, NULL, NULL),
(4, 3, 'Superior Double Room', 261, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 3, 'Superior Twin Room with Partial Sea View', 218, 2, 'Air-conditioned room with a TV and tea/coffee making facilities. Private bathroom has a shower and free toiletries', 1, NULL, NULL),
(6, 3, 'Standard Double Room', 50, 2, 'nice', 1, NULL, NULL),
(7, 3, '4-Bed En-suite Mix Dormitory Room', 33, 4, 'This air-conditioned female dormitory room offers a personal locker, individual power sockets and a reading light. The en suite bathroom includes shower facilities and free bathroom amenities.', 0, NULL, NULL),
(50, 3, 'Double Room', 250, 2, 'Larger double room with air conditioning features a queen bed, flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 0, NULL, NULL),
(52, 3, 'Standard Double Room', 75, 2, 'Fitted with a double bed, this 15 sqm features a flat-screen TV and an electric kettle. The en suite bathroom includes a shower and free toiletries.', 0, NULL, NULL),
(1, 4, 'Deluxe Twin Room', 300, 2, 'This double room features a electric kettle, air conditioning and satellite TV.', 1, NULL, NULL),
(2, 4, 'Standard Single Room', 48, 1, 'This single room has air conditioning.', 0, NULL, NULL),
(3, 4, 'Standard Double Room', 50, 2, 'It is good', 0, NULL, NULL),
(4, 4, 'Superior Double Room', 261, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 4, 'Superior Twin Room with Partial Sea View', 218, 2, 'Air-conditioned room with a TV and tea/coffee making facilities. Private bathroom has a shower and free toiletries', 1, NULL, NULL),
(6, 4, 'Standard Double Room', 50, 2, 'nice', 1, NULL, NULL),
(7, 4, '4-Bed En-suite Mix Dormitory Room', 33, 4, 'This air-conditioned female dormitory room offers a personal locker, individual power sockets and a reading light. The en suite bathroom includes shower facilities and free bathroom amenities.', 0, NULL, NULL),
(50, 4, 'Double Room', 250, 2, 'Larger double room with air conditioning features a queen bed, flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 0, NULL, NULL),
(52, 4, 'Basic Triple Room', 113, 3, 'This air-conditioned triple room can accommodate up to 3 persons. A flat-screen TV and an electric kettle are included. The en suite bathroom is fitted with shower facilities.', 0, NULL, NULL),
(1, 5, 'Standard Double Room', 250, 2, 'Good room', 0, NULL, NULL),
(2, 5, 'Standard Single Room', 48, 1, 'This single room has air conditioning.', 0, NULL, NULL),
(3, 5, 'Superior Double Room', 60, 2, 'It is good', 0, NULL, NULL),
(4, 5, 'Superior Double Room', 261, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 5, 'Superior Twin Room with Partial Sea View', 218, 2, 'Air-conditioned room with a TV and tea/coffee making facilities. Private bathroom has a shower and free toiletries', 1, NULL, NULL),
(6, 5, 'Standard Double Room', 50, 2, 'nice', 1, NULL, NULL),
(7, 5, 'Single room', 72, 1, 'This air-conditioned female dormitory room offers a personal locker, individual power sockets and a reading light. The en suite bathroom includes shower facilities and free bathroom amenities.', 0, NULL, NULL),
(50, 5, 'Double Room', 250, 2, 'Larger double room with air conditioning features a queen bed, flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 0, NULL, NULL),
(52, 5, 'Basic Triple Room', 113, 3, 'This air-conditioned triple room can accommodate up to 3 persons. A flat-screen TV and an electric kettle are included. The en suite bathroom is fitted with shower facilities.', 0, NULL, NULL),
(1, 6, 'Standard Double Room', 250, 2, 'Good room', 0, NULL, NULL),
(2, 6, 'Standard Single Room', 48, 1, 'This single room has air conditioning.', 0, NULL, NULL),
(3, 6, 'Superior Double Room', 60, 2, 'It is good', 0, NULL, NULL),
(4, 6, 'Superior Twin Room', 284, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 6, 'Deluxe King or Twin Room with Partial Sea View', 273, 2, 'Room features a private balcony with views of the ocean.', 1, NULL, NULL),
(6, 6, 'Deluxe Double Room', 60, 2, 'Better', 1, NULL, NULL),
(50, 6, 'Twin Room', 297, 2, 'Twin room with air conditioning features a flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 0, NULL, NULL),
(1, 7, 'Standard Double Room', 250, 2, 'Good room', 0, NULL, NULL),
(2, 7, 'Standard Twin Room', 72, 2, 'This twin room features air conditioning.', 0, NULL, NULL),
(3, 7, 'Superior Double Room', 60, 2, 'It is good', 0, NULL, NULL),
(4, 7, 'Superior Twin Room', 284, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 7, 'Deluxe King or Twin Room with Partial Sea View', 273, 2, 'Room features a private balcony with views of the ocean.', 1, NULL, NULL),
(6, 7, 'Deluxe Double Room', 60, 2, 'Better', 1, NULL, NULL),
(50, 7, 'Twin Room', 297, 2, 'Twin room with air conditioning features a flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 0, NULL, NULL),
(1, 8, 'Standard Single Room', 150, 1, 'Good room for single', 0, NULL, NULL),
(2, 8, 'Standard Twin Room', 72, 2, 'This twin room features air conditioning.', 0, NULL, NULL),
(3, 8, 'Superior Double Room', 60, 2, 'It is good', 0, NULL, NULL),
(4, 8, 'Superior Twin Room', 284, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 8, 'Deluxe King or Twin Room with Partial Sea View', 273, 2, 'Room features a private balcony with views of the ocean.', 1, NULL, NULL),
(6, 8, 'Deluxe Double Room', 60, 2, 'Better', 1, NULL, NULL),
(50, 8, 'Twin Room', 297, 2, 'Twin room with air conditioning features a flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 0, NULL, NULL),
(1, 9, 'Standard Single Room', 150, 1, 'Good room for single', 0, NULL, NULL),
(2, 9, 'Standard Twin Room', 72, 2, 'This twin room features air conditioning.', 0, NULL, NULL),
(3, 9, 'Superior Double Room', 60, 2, 'It is good', 0, NULL, NULL),
(4, 9, 'Superior Twin Room', 284, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 9, 'Deluxe King or Twin Room with Partial Sea View', 273, 2, 'Room features a private balcony with views of the ocean.', 1, NULL, NULL),
(6, 9, 'Deluxe Double Room', 60, 2, 'Better', 1, NULL, NULL),
(50, 9, 'Twin Room', 297, 2, 'Twin room with air conditioning features a flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 0, NULL, NULL),
(1, 10, 'Standard Single Room', 150, 1, 'Good room for single', 0, NULL, NULL),
(2, 10, 'Standard Twin Room', 72, 2, 'This twin room features air conditioning.', 0, NULL, NULL),
(3, 10, 'Family Room', 100, 3, 'It is go6d', 0, NULL, NULL),
(4, 10, 'Superior Twin Room', 284, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 10, 'Deluxe King or Twin Room with Partial Sea View', 273, 2, 'Room features a private balcony with views of the ocean.', 1, NULL, NULL),
(6, 10, 'Deluxe Double Room', 60, 2, 'Better', 1, NULL, NULL),
(50, 10, 'Twin Room', 297, 2, 'Twin room with air conditioning features a flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 0, NULL, NULL),
(2, 11, 'Standard Twin Room', 72, 2, 'This twin room features air conditioning.', 0, NULL, NULL),
(3, 11, 'Family Room', 100, 3, 'It is good', 0, NULL, NULL),
(4, 11, 'Deluxe Double', 369, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 11, 'Deluxe Triple Suite with Sea View', 464, 3, 'This suite has a balcony, sofa and air conditioning.', 1, NULL, NULL),
(50, 11, 'Garden Twin', 330, 2, 'This twin room features air conditioning and satellite TV.', 0, NULL, NULL),
(2, 12, 'Standard Twin Room', 72, 2, 'This twin room features air conditioning.', 0, NULL, NULL),
(3, 12, 'Family Room', 100, 3, 'It is good', 0, NULL, NULL),
(4, 12, 'Deluxe Double', 369, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 12, 'Deluxe Triple Suite with Sea View', 464, 3, 'This suite has a balcony, sofa and air conditioning.', 1, NULL, NULL),
(50, 12, 'Garden Twin', 330, 2, 'This twin room features air conditioning and satellite TV.', 0, NULL, NULL),
(2, 13, 'Standard Quadruple Room', 119, 4, 'This quadruple room features air conditioning.', 0, NULL, NULL),
(3, 13, 'Family Room', 100, 3, 'It is good', 0, NULL, NULL),
(4, 13, 'Deluxe Double', 369, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 13, 'Deluxe Triple Suite with Sea View', 464, 3, 'This suite has a balcony, sofa and air conditioning.', 1, NULL, NULL),
(50, 13, 'Garden Twin', 330, 2, 'This twin room features air conditioning and satellite TV.', 0, NULL, NULL),
(2, 14, 'Standard Quadruple Room', 119, 4, 'This quadruple room features air conditioning.', 0, NULL, NULL),
(3, 14, 'Family Room', 100, 3, 'It is good', 0, NULL, NULL),
(4, 14, 'Deluxe Double', 369, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 14, 'Deluxe Triple Suite with Sea View', 464, 3, 'This suite has a balcony, sofa and air conditioning.', 1, NULL, NULL),
(50, 14, 'Garden Twin', 330, 2, 'This twin room features air conditioning and satellite TV.', 0, NULL, NULL),
(2, 15, 'Standard Quadruple Room', 119, 4, 'This quadruple room features air conditioning.', 0, NULL, NULL),
(3, 15, 'Superior Twin Room', 70, 2, 'It is good', 0, NULL, NULL),
(4, 15, 'Deluxe Double', 369, 2, 'This air-conditioned double room also has a fan option. It is fitted with a cable TV, minibar and a desk. The en suite bathroom includes shower facilities, a hairdryer and free toiletries.', 0, NULL, NULL),
(5, 15, 'Deluxe Triple Suite with Sea View', 464, 3, 'This suite has a balcony, sofa and air conditioning.', 1, NULL, NULL),
(50, 15, 'Garden Twin', 330, 2, 'This twin room features air conditioning and satellite TV.', 0, NULL, NULL),
(2, 16, 'Standard Quadruple Room', 119, 4, 'This quadruple room features air conditioning.', 0, NULL, NULL),
(3, 16, 'Superior Twin Room', 70, 2, 'It is good', 0, NULL, NULL),
(50, 16, 'Quadruple Room', 500, 4, '2 X Larger double room with air conditioning features a queen bed, flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 1, NULL, NULL),
(2, 17, 'Standard Quadruple Room', 119, 4, 'This quadruple room features air conditioning.', 0, NULL, NULL),
(3, 17, 'Superior Twin Room', 70, 2, 'It is good', 0, NULL, NULL),
(50, 17, 'Quadruple Room', 500, 4, '2 X Larger double room with air conditioning features a queen bed, flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 1, NULL, NULL),
(2, 18, 'Standard Quadruple Room', 119, 4, 'This quadruple room features air conditioning.', 0, NULL, NULL),
(3, 18, 'Superior Twin Room', 70, 2, 'It is good', 0, NULL, NULL),
(50, 18, 'Quadruple Room', 500, 4, '2 X Larger double room with air conditioning features a queen bed, flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 1, NULL, NULL),
(2, 19, 'Deluxe Family Room', 119, 4, 'This family room has air conditioning and seating area.', 0, NULL, NULL),
(50, 19, 'Quadruple Room', 500, 4, '2 X Larger double room with air conditioning features a queen bed, flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 1, NULL, NULL),
(2, 20, 'Deluxe Family Room', 119, 4, 'This family room has air conditioning and seating area.', 0, NULL, NULL),
(50, 20, 'Quadruple Room', 500, 4, '2 X Larger double room with air conditioning features a queen bed, flat-screen satellite TV, laptop safe and desk. Private bathroom includes a shower, hairdryer and free toiletries.', 1, NULL, NULL),
(2, 21, 'Standard Quadruple Room', 119, 4, 'This family room has air conditioning and seating area.', 0, NULL, NULL),
(2, 22, 'Deluxe Family Room', 119, 4, 'This family room has air conditioning and seating area.', 0, NULL, NULL),
(2, 23, 'Deluxe Family Room', 119, 4, 'This family room has air conditioning and seating area.', 0, NULL, NULL),
(2, 24, 'Deluxe Family Room', 119, 4, 'This quadruple room features air conditioning.', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_pictures`
--

CREATE TABLE `room_pictures` (
  `hotelId` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `num` bigint(20) UNSIGNED NOT NULL,
  `picturePath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `phone`, `created_at`, `updated_at`) VALUES
(4, 'Carol', 'Lim', 'SWE1704205@xmu.edu.my', '$2y$10$uhBlLzuUmFu28YHZtv9xuOD8pjVYwCXkPcraAHA/n4zVhX.feVaKu', '123456798', '2019-11-11 09:23:42', '2019-11-11 09:23:42'),
(5, 'Joyce', 'Lee', 'SWE1704587@xmu.edu.my', '$2y$10$Wq5PBMc1ocHm4Mhb4PV3muih8nZG6pymNGHBMJ2X5vun9GCq.q1e.', '789456123', '2019-11-11 09:24:26', '2019-11-11 09:24:26'),
(6, 'Roufan', 'Liau', 'SWE1704211@xmu.edu.my', '$2y$10$yfD4b40M5EKKbr/AM65deuwYmNr6xYQTByQH1ar4s45apaAHsamSa', '456123789', '2019-11-11 09:26:05', '2019-11-11 09:26:05'),
(7, 'Shuyi', 'Loh', 'SWE1704010@xmu.edu.my', '$2y$10$tTYr0OLcREq7OG6mFnSuIuf.WRtUy70BtujZdgpcxjDMuc89FWhSm', '0124893823', '2019-11-11 09:26:50', '2019-11-11 09:26:50'),
(8, 'Jun Xi', 'Heng', 'SWE1704023@xmu.edu.my', '$2y$10$favL6uOkUVZ4o2jeGEXH8eQdRFpYo2mJwlrcizD8jwqJU4TYNOtma', '0149563604', '2019-11-11 09:28:18', '2019-11-11 09:28:18'),
(9, 'Kai Xin', 'Chong', 'CHS1704008@xmu.edu.my', '$2y$10$gUAsBDd1SgO4iO67OCoo8O30rmZ2W4Rm/jDxUe3Q4bDoWgbjj3gUe', '0193548911', '2019-11-11 09:36:18', '2019-11-11 09:36:18'),
(10, 'Tiffany', 'Loh', 'qwerty@hotmail.com', '$2y$10$WRVIjJp/H3CRZqgKaNpcMuUxaMoUbro7OmGJtRVlbA/u523AYH4pu', '1236547895', '2019-11-12 10:53:38', '2019-11-12 10:53:38'),
(11, 'Derek', 'Loh', 'derek@hotmail.com', '$2y$10$Xo54VjHe7eRjkv0HxBM/R.waQCpD.WyX8Wsq6WTIiz3MyfM4s187O', '12345678956', '2019-11-12 10:55:18', '2019-11-12 10:55:18'),
(12, 'Qwerty', 'Milo', '123456@hotmail.com', '$2y$10$q4hbViUb19dZObkntLT3y.BgOt/LCmftrTfnwDTEBKsuXxJfJnyOa', '123456789987', '2019-11-12 11:06:45', '2019-11-12 11:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_pictures`
--

CREATE TABLE `user_pictures` (
  `id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_emial_unique` (`emial`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingNum`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotelId`);

--
-- Indexes for table `hotel_facilities`
--
ALTER TABLE `hotel_facilities`
  ADD PRIMARY KEY (`hotelId`);

--
-- Indexes for table `hotel_pictures`
--
ALTER TABLE `hotel_pictures`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomId`,`hotelId`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`hotelId`,`roomId`);

--
-- Indexes for table `room_infos`
--
ALTER TABLE `room_infos`
  ADD PRIMARY KEY (`roomId`,`hotelId`);

--
-- Indexes for table `room_pictures`
--
ALTER TABLE `room_pictures`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingNum` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotelId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `hotel_pictures`
--
ALTER TABLE `hotel_pictures`
  MODIFY `num` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `room_infos`
--
ALTER TABLE `room_infos`
  MODIFY `roomId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `room_pictures`
--
ALTER TABLE `room_pictures`
  MODIFY `num` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
