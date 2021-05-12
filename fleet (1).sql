-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 11:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleet`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients`
--

CREATE TABLE `tbl_clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_address` varchar(255) DEFAULT NULL,
  `client_phone` varchar(50) DEFAULT NULL,
  `client_email` varchar(200) DEFAULT NULL,
  `contact_person` varchar(200) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `contact_email` varchar(200) DEFAULT NULL,
  `cType` tinyint(1) NOT NULL DEFAULT 2,
  `entry_by` int(11) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_clients`
--

INSERT INTO `tbl_clients` (`client_id`, `client_name`, `client_address`, `client_phone`, `client_email`, `contact_person`, `contact_phone`, `contact_email`, `cType`, `entry_by`, `entry_date`, `update_by`, `update_date`, `status`) VALUES
(1, 'FEDCO', 'P.O.Box KA , Airpot-Accra', NULL, NULL, '', '', NULL, 3, 1, '2019-10-29 13:12:11', 1, '2019-10-29 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_type`
--

CREATE TABLE `tbl_client_type` (
  `client_type_id` int(11) NOT NULL,
  `client_type` varchar(200) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_client_type`
--

INSERT INTO `tbl_client_type` (`client_type_id`, `client_type`, `entry_date`) VALUES
(1, 'Cocoa', '2020-05-07 16:36:06'),
(2, 'Other Business', '2020-05-07 16:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_destination`
--

CREATE TABLE `tbl_destination` (
  `destination_id` int(11) NOT NULL,
  `destination_name` varchar(200) NOT NULL,
  `distance` varchar(20) DEFAULT NULL,
  `fuel_qty` varchar(20) DEFAULT NULL,
  `entry_by` varchar(200) DEFAULT NULL,
  `entry_by_id` int(11) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_destination`
--

INSERT INTO `tbl_destination` (`destination_id`, `destination_name`, `distance`, `fuel_qty`, `entry_by`, `entry_by_id`, `entry_date`) VALUES
(10, 'KUMASI', '275', '200', 'Frempong Manso', 2, '2019-11-06 13:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dispatch`
--

CREATE TABLE `tbl_dispatch` (
  `dispatch_id` int(11) NOT NULL,
  `dispatch_type_id` int(11) NOT NULL,
  `dispatch_type` varchar(200) NOT NULL,
  `dispatch_date` varchar(30) DEFAULT NULL,
  `allocation_date` date DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `dispatch_amt` varchar(50) NOT NULL,
  `client_id` int(11) NOT NULL,
  `client_name` varchar(200) NOT NULL,
  `client_contact` varchar(255) DEFAULT NULL,
  `client_contract` varchar(255) DEFAULT NULL,
  `vehicle_id` int(11) NOT NULL,
  `vehicle_no` varchar(30) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `driver_name` varchar(200) NOT NULL,
  `driver_phone` varchar(50) NOT NULL,
  `driver_emergency` varchar(50) DEFAULT NULL,
  `location_id` int(11) NOT NULL,
  `location_name` varchar(200) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `distance` varchar(50) NOT NULL DEFAULT '0',
  `district_id` int(11) NOT NULL DEFAULT 0,
  `district_name` varchar(200) DEFAULT NULL,
  `port_id` int(11) DEFAULT 0,
  `port_name` varchar(200) DEFAULT NULL,
  `litre_price` varchar(20) NOT NULL,
  `fuel_qty` varchar(20) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `qty` varchar(50) DEFAULT NULL,
  `unit_px` varchar(100) DEFAULT NULL,
  `revenue` varchar(200) DEFAULT NULL,
  `rstatus` tinyint(1) NOT NULL DEFAULT 0,
  `r_entry_by_id` int(11) DEFAULT NULL,
  `r_entry_by` varchar(200) DEFAULT NULL,
  `r_entry_date` datetime DEFAULT NULL,
  `status_details` varchar(150) NOT NULL DEFAULT 'Pending Approval',
  `entry_by_id` int(11) NOT NULL,
  `entry_by` varchar(200) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `a_litre_price` varchar(20) DEFAULT NULL,
  `a_fuel_qty` varchar(20) DEFAULT NULL,
  `a_remark` varchar(255) DEFAULT NULL,
  `approved_by_id` int(11) DEFAULT NULL,
  `approved_by` varchar(200) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `arrival_by_id` int(11) DEFAULT NULL,
  `arrival_by` varchar(200) DEFAULT NULL,
  `arrival_entry_date` datetime DEFAULT NULL,
  `offload_date` date DEFAULT NULL,
  `offload_by_id` int(11) DEFAULT NULL,
  `offload_by` varchar(200) DEFAULT NULL,
  `offload_entry_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dispatch`
--

INSERT INTO `tbl_dispatch` (`dispatch_id`, `dispatch_type_id`, `dispatch_type`, `dispatch_date`, `allocation_date`, `release_date`, `dispatch_amt`, `client_id`, `client_name`, `client_contact`, `client_contract`, `vehicle_id`, `vehicle_no`, `driver_id`, `driver_name`, `driver_phone`, `driver_emergency`, `location_id`, `location_name`, `destination_id`, `destination`, `distance`, `district_id`, `district_name`, `port_id`, `port_name`, `litre_price`, `fuel_qty`, `remark`, `status`, `qty`, `unit_px`, `revenue`, `rstatus`, `r_entry_by_id`, `r_entry_by`, `r_entry_date`, `status_details`, `entry_by_id`, `entry_by`, `entry_date`, `a_litre_price`, `a_fuel_qty`, `a_remark`, `approved_by_id`, `approved_by`, `approved_date`, `arrival_date`, `arrival_by_id`, `arrival_by`, `arrival_entry_date`, `offload_date`, `offload_by_id`, `offload_by`, `offload_entry_date`) VALUES
(38, 2, 'Other Business', '2019-10-04', '2019-10-02', '2019-10-02', '130', 37, 'CALOKING', NULL, ' ( 0302204554 ) ', 71, 'GT 4956-11', 1, 'Fedlog', '0', '0', 9, 'ACCRA', 10, 'KUMASI', '275', 0, NULL, 0, NULL, '5.385', '200', 'OK', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'Pending Approval', 2, 'Frempong Manso', '2019-11-06 14:20:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 1, 'Cocoa', '2019-11-01', '2019-11-01', '2019-11-01', '80', 1, 'FEDCO', NULL, 'Patrick ( 0247221876 ) ', 164, 'GN 8905-17', 1, 'Fedlog', '0', '0', 9, 'ACCRA', 58, 'KADE', '141', 58, 'KADE', 1, 'TEMA', '5.385', '70', 'N/A', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'Pending Approval', 4, '', '2019-11-11 16:02:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drivers`
--

CREATE TABLE `tbl_drivers` (
  `driver_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `entry_by` varchar(100) NOT NULL,
  `entry_by_id` int(11) NOT NULL,
  `entry_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_drivers`
--

INSERT INTO `tbl_drivers` (`driver_id`, `firstname`, `lastname`, `phone`, `entry_by`, `entry_by_id`, `entry_date`) VALUES
(1, 'fadlu', 'haruna', '0573400638', 'Admin', 1, 2021);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fuel_type`
--

CREATE TABLE `tbl_fuel_type` (
  `fuel_type_id` int(11) NOT NULL,
  `fuel_type` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `entry_by_id` int(11) NOT NULL,
  `entry_by` varchar(200) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fuel_type`
--

INSERT INTO `tbl_fuel_type` (`fuel_type_id`, `fuel_type`, `description`, `entry_by_id`, `entry_by`, `entry_date`) VALUES
(1, 'Dispatch Fueling', 'Dispatch Fueling', 1, 'Admin', '2019-11-13 12:09:06'),
(2, 'Transit Fueling', 'Transit Fueling', 1, 'Admin', '2019-11-13 12:09:06'),
(3, 'Top-up Fueling', 'Top-up Fueling', 1, 'Admin', '2019-11-13 12:10:09'),
(4, 'Maintenance Fueling', 'Maintenance Fueling', 1, 'Admin', '2019-11-13 12:10:09'),
(5, 'Official Car Fueling', 'Official Car Fueling', 1, 'Admin', '2019-11-13 12:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issued_items`
--

CREATE TABLE `tbl_issued_items` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `request_name` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `vehicle_no` varchar(100) NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `issued_by` varchar(100) NOT NULL,
  `issued_by_id` int(11) NOT NULL,
  `issued_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_issued_items`
--

INSERT INTO `tbl_issued_items` (`id`, `request_id`, `request_name`, `item_id`, `item_name`, `vehicle_no`, `serial_no`, `issued_by`, `issued_by_id`, `issued_date`) VALUES
(92, 40, 'Replacement', 7, 'Spanner', 'GA-135512 GH', 'GSG-576877443', 'Admin', 1, '2021-05-10 08:47:19'),
(93, 40, '', 0, '', 'GA-135512 GH', 'eeeee', 'Admin', 1, '2021-05-10 08:47:19'),
(94, 40, 'Replacement', 7, 'Spanner', 'GA-135512 GH', 'GSG-576877443', 'Admin', 1, '2021-05-10 08:47:20'),
(95, 40, '', 0, '', 'GA-135512 GH', 'eeeee', 'Admin', 1, '2021-05-10 08:47:20'),
(96, 39, 'Repairs', 8, 'gloves', 'GA-135512 GH', 'GSG-576877443', 'Admin', 1, '2021-05-10 09:12:54'),
(97, 39, 'Repairs', 8, 'gloves', 'GM 6459-14', 'GH-448596-II', 'Admin', 1, '2021-05-10 09:12:54'),
(98, 41, 'Repairs', 8, 'gloves', 'GA-135512 GH', 'GH-448596-II', 'Admin', 1, '2021-05-10 09:16:38'),
(99, 41, 'Repairs', 8, 'gloves', 'GA-135512 GH', 'eeeee', 'Admin', 1, '2021-05-10 09:16:38'),
(100, 41, 'Repairs', 8, 'gloves', 'GA-135512 GH', 'GSG-576877443', 'Admin', 1, '2021-05-10 09:16:38'),
(101, 41, 'Repairs', 8, 'gloves', 'GM 6459-14', 'GSG-576877443', 'Admin', 1, '2021-05-10 09:16:38'),
(102, 45, 'maintenance', 8, 'gloves', 'GA-135512 GH', 'GSG-576877443', 'Admin', 1, '2021-05-10 13:01:02'),
(103, 45, 'maintenance', 8, 'gloves', 'GA-135512 GH', 'GSG-576877446', 'Admin', 1, '2021-05-10 13:01:02'),
(104, 45, 'maintenance', 8, 'gloves', 'GA-135512 GH', '12345', 'Admin', 1, '2021-05-10 13:01:02'),
(105, 73, 'maintenance', 11, 'Rim', 'GM 6460-14', 'GH-448596-II', 'Admin', 1, '2021-05-12 07:44:31'),
(106, 73, 'maintenance', 11, 'Rim', 'GM 6460-14', '12345', 'Admin', 1, '2021-05-12 07:44:31'),
(107, 73, 'maintenance', 11, 'Rim', 'GR 7932-17', '0,0,GSG-576877443', 'Admin', 1, '2021-05-12 07:44:31'),
(108, 73, 'maintenance', 11, 'Rim', 'GR 7932-17', '1,1,GH-448596-II', 'Admin', 1, '2021-05-12 07:44:31'),
(109, 73, 'maintenance', 11, 'Rim', 'GR 7932-17', '2,2,12345', 'Admin', 1, '2021-05-12 07:44:31'),
(110, 77, 'Replacement', 8, 'gloves', 'GR 7932-17', 'eeeee', 'Admin', 1, '2021-05-12 09:22:35'),
(111, 77, 'Replacement', 8, 'gloves', 'GR 7932-17', 'GH-448596-II', 'Admin', 1, '2021-05-12 09:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(200) NOT NULL,
  `entry_by_id` int(11) DEFAULT NULL,
  `entry_by` varchar(200) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`location_id`, `location_name`, `entry_by_id`, `entry_by`, `entry_date`) VALUES
(1, 'TEMA', 1, 'ADMIN', '2019-11-05 15:21:38'),
(2, 'KUMASI', 1, 'ADMIN', '2019-11-05 15:21:38'),
(3, 'TAKORADI', 1, 'ADMIN', '2019-11-05 15:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_make`
--

CREATE TABLE `tbl_make` (
  `make_id` int(11) NOT NULL,
  `make` varchar(200) NOT NULL,
  `entry_by` int(11) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_make`
--

INSERT INTO `tbl_make` (`make_id`, `make`, `entry_by`, `entry_date`) VALUES
(1, 'Hyundai', 1, '2019-10-29 13:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `menu_url` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `menu_pid` int(11) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`menu_id`, `menu_name`, `menu_url`, `icon`, `description`, `menu_pid`, `entry_date`) VALUES
(1, 'Dispatch ', 'Parent', 'industry', 'Diapatch', 0, '2019-09-11 23:27:39'),
(2, 'Fuel', 'Parent', 'tint', 'Fuel', 0, '2019-09-11 23:27:39'),
(3, 'Revenue', 'Parent', 'money', 'Revenue', 0, '2019-09-11 23:27:39'),
(5, 'Report', 'Parent', 'list', 'Report', 0, '2019-09-11 23:27:39'),
(10, 'Add New Dispatch', 'dispatch/add', 'list', 'Add New Dispatch Request', 1, '2019-12-23 00:07:18'),
(11, 'Add New Cocoa Dispatch', 'dispatch/cocoa', 'list', 'Add New Cocoa Dispatch Request ', 1, '2019-12-23 00:07:18'),
(12, 'View Dispatch', 'dispatch', 'list', 'Dispatch Request List ', 1, '2019-12-23 00:09:09'),
(13, 'Add Fuel/Other Product', 'dispatch/fuelproduct', 'list', 'Add Fuel/Other Product Record ', 2, '2019-12-23 00:13:19'),
(14, 'View Fuel /Other Product', 'dispatch/fuel', 'list', 'View Fuel /Other Product Records', 2, '2019-12-23 00:13:19'),
(15, 'Fuel Detail Report ', 'dispatch/fueldetials', 'list', 'View Fuel Detail Report ', 5, '2019-12-23 00:15:23'),
(16, 'Dispatch Detail Report ', 'dispatch/dispatchdetials', 'list', 'View Dispatch Detail Report ', 5, '2019-12-23 00:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_model`
--

CREATE TABLE `tbl_model` (
  `model_id` int(11) NOT NULL,
  `model` varchar(200) NOT NULL,
  `make_id` int(11) NOT NULL,
  `entry_by` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_model`
--

INSERT INTO `tbl_model` (`model_id`, `model`, `make_id`, `entry_by`, `entry_date`) VALUES
(1, 'Entrant', 1, 1, '2019-10-29 13:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ports`
--

CREATE TABLE `tbl_ports` (
  `port_id` int(11) NOT NULL,
  `port_name` varchar(200) NOT NULL,
  `entry_by` int(11) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ports`
--

INSERT INTO `tbl_ports` (`port_id`, `port_name`, `entry_by`, `entry_date`) VALUES
(1, 'TEMA', NULL, '2019-10-31 14:06:40'),
(2, 'KAASE', NULL, '2019-10-31 14:06:40'),
(3, 'TAKORADI', NULL, '2019-10-31 14:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_activities`
--

CREATE TABLE `tbl_request_activities` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `request_status` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `entry_by` varchar(100) NOT NULL,
  `entry_by_id` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request_activities`
--

INSERT INTO `tbl_request_activities` (`id`, `request_id`, `request_status`, `qty`, `remarks`, `entry_by`, `entry_by_id`, `entry_date`) VALUES
(272, 77, 'Pending Approval', 10, NULL, 'Admin', 1, '2021-05-12 11:20:10'),
(273, 77, 'approved', 10, '', 'Admin', 1, '2021-05-12 09:10:30'),
(274, 77, 'Awaiting Receive', 10, '', 'Admin', 1, '2021-05-12 09:10:30'),
(275, 77, 'Received', 10, NULL, '', 0, '2021-05-12 09:11:53'),
(276, 77, 'Received', 10, NULL, '', 0, '2021-05-12 09:12:19'),
(277, 77, 'Received', 10, NULL, '', 0, '2021-05-12 09:12:42'),
(278, 77, 'Received', 10, NULL, '', 0, '2021-05-12 09:14:12'),
(279, 77, 'Received', 10, NULL, '', 0, '2021-05-12 09:14:19'),
(280, 77, 'Received', 10, NULL, '', 0, '2021-05-12 09:14:55'),
(281, 77, 'Received', 10, NULL, '', 0, '2021-05-12 09:15:37'),
(282, 77, 'Received', 10, NULL, '', 0, '2021-05-12 09:15:43'),
(283, 77, 'Received', 10, NULL, '', 0, '2021-05-12 09:21:32'),
(284, 77, 'Pending Issue', 10, '', 'Admin', 1, '2021-05-12 09:21:33'),
(285, 77, 'Issued', 10, NULL, 'Admin', 1, '2021-05-12 09:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_list`
--

CREATE TABLE `tbl_request_list` (
  `id` int(11) NOT NULL,
  `request_type_id` int(11) NOT NULL,
  `request_name` varchar(100) NOT NULL,
  `request_status` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `assigned_qty` int(11) NOT NULL,
  `issued_qty` int(11) NOT NULL,
  `unit_price` float(8,2) NOT NULL,
  `date_needed` date NOT NULL,
  `justification` text NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(100) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `date_approved` datetime NOT NULL,
  `entry_by` varchar(100) NOT NULL,
  `entry_by_id` int(11) NOT NULL,
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request_list`
--

INSERT INTO `tbl_request_list` (`id`, `request_type_id`, `request_name`, `request_status`, `item_id`, `item_name`, `total_qty`, `assigned_qty`, `issued_qty`, `unit_price`, `date_needed`, `justification`, `vendor_id`, `vendor_name`, `supplier_id`, `supplier_name`, `date_approved`, `entry_by`, `entry_by_id`, `entry_date`) VALUES
(77, 9, 'Replacement', 'Issued', 8, 'gloves', 10, 0, 9, 56.00, '2021-05-17', 'dddd', 3, 'imperial facilities', 3, 'imperial facilities', '0000-00-00 00:00:00', 'Admin', 1, '2021-05-12 11:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_list_items`
--

CREATE TABLE `tbl_request_list_items` (
  `id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `request_name` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `vehicle_no` varchar(100) NOT NULL,
  `re_assign_to` varchar(100) NOT NULL,
  `assigned_by` varchar(100) NOT NULL,
  `re_assigned_date` datetime NOT NULL,
  `re_issued_to` varchar(100) DEFAULT NULL,
  `issued_by` varchar(100) NOT NULL,
  `issue_by_id` int(11) NOT NULL,
  `issued_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `remarks` text NOT NULL,
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request_list_items`
--

INSERT INTO `tbl_request_list_items` (`id`, `request_id`, `request_name`, `item_id`, `item_name`, `qty`, `vehicle_id`, `vehicle_no`, `re_assign_to`, `assigned_by`, `re_assigned_date`, `re_issued_to`, `issued_by`, `issue_by_id`, `issued_date`, `status`, `serial_no`, `remarks`, `entry_date`) VALUES
(184, 73, 'maintenance', 11, 'Rim', 2, 5, 'GM 6460-14', '', '', '0000-00-00 00:00:00', '', 'Admin', 1, '0000-00-00', 'Issued', 'a:2:{i:1;s:12:\"GH-448596-II\";i:2;s:5:\"12345\";}', '', '2021-05-11 22:46:55'),
(185, 73, 'maintenance', 11, 'Rim', 3, 170, 'GR 7932-17', '', '', '0000-00-00 00:00:00', '', 'Admin', 1, '0000-00-00', 'Issued', 'a:3:{i:0;s:17:\"0,0,GSG-576877443\";i:1;s:16:\"1,1,GH-448596-II\";i:2;s:9:\"2,2,12345\";}', '', '2021-05-11 22:46:55'),
(186, 73, 'maintenance', 11, 'Rim', 1, 3, 'GM 6458-14', '', '', '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00', 'Issued', NULL, '', '2021-05-11 22:46:55'),
(187, 74, 'Replacement', 12, 'Bumper', 2, 3, 'GM 6458-14', '', '', '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00', 'Issued', NULL, '', '2021-05-12 09:24:52'),
(188, 74, 'Replacement', 12, 'Bumper', 5, 4, 'GM 6459-14', '', '', '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00', 'Issued', NULL, '', '2021-05-12 09:24:52'),
(189, 75, 'maintenance', 12, 'Bumper', 5, 5, 'GM 6460-14', '', '', '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00', 'Issued', NULL, '', '2021-05-12 10:24:11'),
(190, 75, 'maintenance', 12, 'Bumper', 5, 197, 'GM 1026-12', '', '', '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00', 'Issued', NULL, '', '2021-05-12 10:24:11'),
(191, 76, 'Replacement', 13, 'Rim', 2, 4, 'GM 6459-14', '', '', '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00', 'Approved', NULL, '', '2021-05-12 10:56:49'),
(192, 76, 'Replacement', 13, 'Rim', 4, 5, 'GM 6460-14', '', '', '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00', 'Approved', NULL, '', '2021-05-12 10:56:49'),
(193, 77, 'Replacement', 8, 'gloves', 4, 4, 'GM 6459-14', '', '', '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00', 'Issued', NULL, '', '2021-05-12 11:20:10'),
(194, 77, 'Replacement', 8, 'gloves', 2, 170, 'GR 7932-17', '', '', '0000-00-00 00:00:00', '', 'Admin', 1, '0000-00-00', 'Issued', 'a:2:{i:0;s:5:\"eeeee\";i:1;s:12:\"GH-448596-II\";}', '', '2021-05-12 11:20:10'),
(195, 77, 'Replacement', 8, 'gloves', 3, 197, 'GM 1026-12', '', '', '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00', 'Issued', NULL, '', '2021-05-12 11:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_types`
--

CREATE TABLE `tbl_request_types` (
  `id` int(11) NOT NULL,
  `request_name` varchar(100) NOT NULL,
  `entry_by` varchar(100) NOT NULL,
  `entry_by_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `entry_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request_types`
--

INSERT INTO `tbl_request_types` (`id`, `request_name`, `entry_by`, `entry_by_id`, `remarks`, `entry_date`) VALUES
(7, 'Repairs', 'Admin', 1, '', '2021-05-10 08:20:39'),
(8, 'maintenance', 'Admin', 1, '', '2021-05-10 08:20:50'),
(9, 'Replacement', 'Admin', 1, '', '2021-05-10 08:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_revenue`
--

CREATE TABLE `tbl_revenue` (
  `revenue_id` int(11) NOT NULL,
  `dispatch_id` int(11) NOT NULL,
  `delivery_no` varchar(50) NOT NULL,
  `amount_paid` varchar(50) NOT NULL,
  `entry_by_id` int(11) NOT NULL,
  `entry_by` varchar(200) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `fieldoption` varchar(100) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`fieldoption`, `value`) VALUES
('fuel_price', '5.385');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_station`
--

CREATE TABLE `tbl_station` (
  `station_id` int(11) NOT NULL,
  `station_name` varchar(200) NOT NULL,
  `station_location` varchar(200) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `entry_by_id` int(11) DEFAULT NULL,
  `entry_by` varchar(200) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_station`
--

INSERT INTO `tbl_station` (`station_id`, `station_name`, `station_location`, `address`, `phone`, `email`, `entry_by_id`, `entry_by`, `entry_date`) VALUES
(1, 'Achimota (SHELL)', 'Accra', NULL, NULL, NULL, 1, 'Admin', '2019-11-13 12:19:53'),
(2, 'Tema (TOTAL)', 'Tema', NULL, NULL, NULL, 1, 'Admin', '2019-11-13 12:19:53'),
(18, 'Takoradi (PACIFIC)', 'Takoradi', NULL, NULL, NULL, 1, 'Admin', '2019-11-13 12:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_items`
--

CREATE TABLE `tbl_stock_items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `unit_price` float(8,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `stock_issued` int(11) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `entry_by` varchar(100) DEFAULT NULL,
  `entry_by_id` int(11) NOT NULL,
  `entry_date` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stock_items`
--

INSERT INTO `tbl_stock_items` (`id`, `item_name`, `brand`, `description`, `unit_price`, `stock`, `stock_issued`, `inventory`, `entry_by`, `entry_by_id`, `entry_date`, `created_at`) VALUES
(7, 'Spanner', '', '', 4.00, 20, 4, 16, 'Admin', 1, '2021-05-10 10:47:20', '0000-00-00 00:00:00'),
(8, 'gloves', '', '', 56.00, 1, 9, 10, 'Admin', 1, '2021-05-12 11:22:34', '0000-00-00 00:00:00'),
(13, 'Rim', '', 'yhjj', 2.30, 0, NULL, 0, 'Admin', 1, '2021-05-12 10:51:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_no` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `last_ip` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `full_name`, `firstname`, `lastname`, `email`, `mobile_no`, `password`, `is_admin`, `last_ip`, `created_at`, `updated_at`) VALUES
(1, 'Razak Tokosi-Osman', 'Tokosi-Osman Razak', 'Razak', 'Tokosi-Osman', 'razak.osman@fedco.com.gh', '0247221876', '$2y$10$Gp.Y3s1W9kXuBlGDSr4c3edU2wcHJC7JBc6FLHlV/KpfAIf5D0', 1, '', '2017-09-29 10:09:44', '2019-12-23 10:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_menu`
--

CREATE TABLE `tbl_user_menu` (
  `user_menu_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `entry_by_id` int(11) NOT NULL,
  `entry_by` varchar(200) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_menu`
--

INSERT INTO `tbl_user_menu` (`user_menu_id`, `user_id`, `menu_id`, `entry_by_id`, `entry_by`, `entry_date`) VALUES
(11, 1, 10, 0, '', '2019-12-23 10:49:04'),
(12, 1, 16, 0, '', '2019-12-23 10:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_station`
--

CREATE TABLE `tbl_user_station` (
  `user_station_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `entry_by_id` int(11) NOT NULL,
  `entry_by` varchar(200) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_station`
--

INSERT INTO `tbl_user_station` (`user_station_id`, `user_id`, `station_id`, `entry_by_id`, `entry_by`, `entry_date`) VALUES
(3, 1, 1, 0, '', '2019-12-23 10:49:04'),
(5, 1, 6, 0, '', '2019-12-23 10:49:04'),
(7, 2, 4, 0, '', '2019-12-23 10:51:39'),
(9, 7, 4, 0, '', '2019-12-23 10:52:45'),
(10, 3, 1, 0, '', '2019-12-23 15:25:40'),
(11, 3, 2, 0, '', '2019-12-23 15:25:40'),
(12, 3, 3, 0, '', '2019-12-23 15:25:40'),
(13, 3, 4, 0, '', '2019-12-23 15:25:40'),
(14, 3, 5, 0, '', '2019-12-23 15:25:40'),
(15, 3, 6, 0, '', '2019-12-23 15:25:40'),
(17, 3, 8, 0, '', '2019-12-23 15:25:40'),
(18, 10, 3, 0, '', '2019-12-30 09:36:41'),
(19, 10, 4, 0, '', '2019-12-30 09:36:41'),
(20, 10, 6, 0, '', '2019-12-30 09:36:41'),
(21, 11, 5, 0, '', '2019-12-30 09:36:57'),
(22, 10, 3, 0, '', '2019-12-30 09:37:17'),
(23, 10, 4, 0, '', '2019-12-30 09:37:17'),
(24, 10, 6, 0, '', '2019-12-30 09:37:17'),
(25, 9, 2, 0, '', '2019-12-30 09:37:52'),
(26, 11, 5, 0, '', '2019-12-30 09:38:12'),
(27, 7, 1, 0, '', '2019-12-30 13:24:02'),
(28, 7, 2, 0, '', '2019-12-30 13:24:02'),
(29, 7, 3, 0, '', '2019-12-30 13:24:02'),
(30, 7, 4, 0, '', '2019-12-30 13:24:02'),
(31, 7, 5, 0, '', '2019-12-30 13:24:02'),
(32, 7, 6, 0, '', '2019-12-30 13:24:02'),
(33, 7, 7, 0, '', '2019-12-30 13:24:02'),
(34, 7, 8, 0, '', '2019-12-30 13:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle`
--

CREATE TABLE `tbl_vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_no` varchar(50) NOT NULL,
  `make_id` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `model_year` int(5) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `driver_id` int(11) DEFAULT 1,
  `vehicle_type_id` int(11) DEFAULT NULL,
  `vehicle_type` varchar(200) DEFAULT NULL,
  `entry_by_id` int(11) DEFAULT NULL,
  `entry_by` varchar(200) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle`
--

INSERT INTO `tbl_vehicle` (`vehicle_id`, `vehicle_no`, `make_id`, `model_id`, `model_year`, `description`, `driver_id`, `vehicle_type_id`, `vehicle_type`, `entry_by_id`, `entry_by`, `entry_date`) VALUES
(2, 'GM 6457-14', NULL, NULL, NULL, NULL, 1, 2, 'FEDLOG TRUCK', 1, 'Tokosi-Osman Razak', '2019-11-05 12:34:52'),
(3, 'GM 6458-14', NULL, NULL, NULL, NULL, 1, 2, 'FEDLOG TRUCK', 1, 'Tokosi-Osman Razak', '2019-11-05 12:34:52'),
(4, 'GM 6459-14', NULL, NULL, NULL, NULL, 1, 2, 'FEDLOG TRUCK', 1, 'Tokosi-Osman Razak', '2019-11-05 12:34:52'),
(5, 'GM 6460-14', NULL, NULL, NULL, NULL, 1, 2, 'FEDLOG TRUCK', 1, 'Tokosi-Osman Razak', '2019-11-05 12:34:52'),
(170, 'GR 7932-17', NULL, NULL, NULL, NULL, 1, 5, 'PRIVATE VEHICLE', 1, 'Tokosi-Osman Razak', '2019-12-23 03:20:34'),
(197, 'GM 1026-12', NULL, NULL, NULL, NULL, 1, 3, 'OFFICIAL VEHICLE', 7, 'Amatei Tagoe', '2020-06-10 13:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_type`
--

CREATE TABLE `tbl_vehicle_type` (
  `vehicle_type_id` int(11) NOT NULL,
  `vehicle_type` varchar(200) NOT NULL,
  `entry_by` varchar(200) DEFAULT NULL,
  `entry_by_id` int(11) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_vehicle_type`
--

INSERT INTO `tbl_vehicle_type` (`vehicle_type_id`, `vehicle_type`, `entry_by`, `entry_by_id`, `entry_date`) VALUES
(2, 'TRUCK', 'Admin', 1, '2019-12-17 15:25:20'),
(3, 'OFFICIAL VEHICLE', 'Admin', 1, '2019-12-17 15:30:33'),
(5, 'PRIVATE VEHICLE', 'Admin', 1, '2019-12-17 15:32:53'),
(13, 'Another Vehicles', 'Admin', 1, '2021-04-20 00:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendors`
--

CREATE TABLE `tbl_vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `entry_by` varchar(100) NOT NULL,
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vendors`
--

INSERT INTO `tbl_vendors` (`id`, `name`, `phone`, `email`, `entry_by`, `entry_date`) VALUES
(1, 'fadlu haruna', '0573400658', 'fadlu.haruna@gmail.com', 'admin', '2021-04-27 00:48:56'),
(3, 'imperial facilities', '0557795913', 'imperialfacilitiesgh@gmail.com', 'admin', '2021-04-27 00:50:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_client_type`
--
ALTER TABLE `tbl_client_type`
  ADD PRIMARY KEY (`client_type_id`);

--
-- Indexes for table `tbl_destination`
--
ALTER TABLE `tbl_destination`
  ADD PRIMARY KEY (`destination_id`);

--
-- Indexes for table `tbl_dispatch`
--
ALTER TABLE `tbl_dispatch`
  ADD PRIMARY KEY (`dispatch_id`);

--
-- Indexes for table `tbl_drivers`
--
ALTER TABLE `tbl_drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `tbl_issued_items`
--
ALTER TABLE `tbl_issued_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request_activities`
--
ALTER TABLE `tbl_request_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request_list`
--
ALTER TABLE `tbl_request_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request_list_items`
--
ALTER TABLE `tbl_request_list_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request_types`
--
ALTER TABLE `tbl_request_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stock_items`
--
ALTER TABLE `tbl_stock_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `tbl_vehicle_type`
--
ALTER TABLE `tbl_vehicle_type`
  ADD PRIMARY KEY (`vehicle_type_id`);

--
-- Indexes for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_drivers`
--
ALTER TABLE `tbl_drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_issued_items`
--
ALTER TABLE `tbl_issued_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tbl_request_activities`
--
ALTER TABLE `tbl_request_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `tbl_request_list`
--
ALTER TABLE `tbl_request_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tbl_request_list_items`
--
ALTER TABLE `tbl_request_list_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `tbl_request_types`
--
ALTER TABLE `tbl_request_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_stock_items`
--
ALTER TABLE `tbl_stock_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `tbl_vehicle_type`
--
ALTER TABLE `tbl_vehicle_type`
  MODIFY `vehicle_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
