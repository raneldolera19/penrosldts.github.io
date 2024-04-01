-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 09:06 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dts`
--
CREATE DATABASE IF NOT EXISTS `dts` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dts`;

-- --------------------------------------------------------

--
-- Table structure for table `dts_docroutes`
--

CREATE TABLE `dts_docroutes` (
  `action_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `previous_route_id` int(11) NOT NULL,
  `route_fromuser_id` int(11) NOT NULL,
  `route_from` varchar(255) NOT NULL,
  `route_fromsection_id` int(11) NOT NULL,
  `route_fromsection` varchar(255) NOT NULL,
  `route_tosection_id` int(11) NOT NULL,
  `route_tosection` varchar(255) NOT NULL,
  `route_touser_id` int(11) NOT NULL,
  `route_purpose` longtext NOT NULL,
  `fwd_remarks` varchar(255) NOT NULL,
  `datetime_forwarded` datetime NOT NULL,
  `datetime_route_accepted` datetime NOT NULL,
  `receivedby_id` int(11) NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `accepting_remarks` longtext NOT NULL,
  `actions_datetime` datetime NOT NULL,
  `actions_taken` longtext NOT NULL,
  `actedby_id` int(11) NOT NULL,
  `acted_by` varchar(255) NOT NULL,
  `doc_copy` int(11) NOT NULL DEFAULT 0,
  `out_released_to` varchar(255) NOT NULL,
  `logbook_page` varchar(150) NOT NULL,
  `route_accomplished` int(11) NOT NULL DEFAULT 0,
  `end_remarks` varchar(255) NOT NULL,
  `def_reason` varchar(255) NOT NULL,
  `def_datetime` datetime NOT NULL,
  `duplicate` int(11) NOT NULL DEFAULT 0,
  `del_reason` varchar(255) NOT NULL,
  `updatedby_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `dts_docroutes`
--

INSERT INTO `dts_docroutes` (`action_id`, `document_id`, `previous_route_id`, `route_fromuser_id`, `route_from`, `route_fromsection_id`, `route_fromsection`, `route_tosection_id`, `route_tosection`, `route_touser_id`, `route_purpose`, `fwd_remarks`, `datetime_forwarded`, `datetime_route_accepted`, `receivedby_id`, `received_by`, `accepting_remarks`, `actions_datetime`, `actions_taken`, `actedby_id`, `acted_by`, `doc_copy`, `out_released_to`, `logbook_page`, `route_accomplished`, `end_remarks`, `def_reason`, `def_datetime`, `duplicate`, `del_reason`, `updatedby_id`, `active`) VALUES
(2674, 1140, 0, 1, 'System Admin', 5, 'ICT Unit', 7, 'Legal Unit', 0, 'Sample', '', '2023-07-24 14:47:15', '2023-07-24 14:48:38', 5, 'Ranel Dolera', 'OKAY', '2023-07-24 14:53:39', 'Release', 5, 'Ranel Dolera', 1, '', '', 1, 'Forwarded to ICT Unit', '', '0000-00-00 00:00:00', 0, '', 0, 1),
(2675, 1140, 2674, 5, 'Ranel Dolera', 7, 'Legal Unit', 5, 'ICT Unit', 1, 'Sample', 'T.O.', '2023-07-24 14:53:39', '2023-07-24 16:10:44', 1, 'System Admin', 'DONE', '0000-00-00 00:00:00', '', 0, '', 0, '', '', 0, '', '', '0000-00-00 00:00:00', 0, '', 0, 1),
(2676, 1141, 0, 7, 'ALPHA ALPHA', 4, 'Accounting', 18, 'Planning', 0, 'sample', '', '2023-07-31 05:32:04', '2023-07-31 05:32:50', 6, 'mik mik', 'okay', '0000-00-00 00:00:00', '', 0, '', 0, '', '', 0, '', '', '0000-00-00 00:00:00', 0, '', 0, 1),
(2677, 1142, 0, 0, 'Ranel Dolera', 1, 'GUEST', 3, 'Receiving Planning', 0, 'sample', '', '2024-03-25 08:18:19', '2024-03-25 08:18:57', 11, 'Ralp Libres', '', '2024-03-25 08:19:28', 'Deferred', 11, 'Ralp Libres', 0, '', '', 4, 'Deferred ', 'sample', '2024-03-25 08:19:28', 0, '', 0, 1),
(2678, 1143, 0, 11, 'Ralp Libres', 3, 'Receiving Planning', 10, 'Budget', 0, 'sample', '', '2024-03-25 08:20:04', '2024-03-25 08:20:40', 12, 'Mary Joy Calapre', 'sample', '0000-00-00 00:00:00', '', 0, '', 0, '', '', 0, '', '', '0000-00-00 00:00:00', 0, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dts_docs`
--

CREATE TABLE `dts_docs` (
  `doc_id` int(11) NOT NULL,
  `doc_tracking` varchar(20) NOT NULL,
  `track_issuedby_userid` int(11) NOT NULL,
  `doc_type_id` int(11) NOT NULL,
  `tempdocs_id` int(11) NOT NULL,
  `docs_description` longtext NOT NULL,
  `origin_fname` varchar(255) NOT NULL,
  `origin_userid` int(11) NOT NULL,
  `origin_school_id` int(11) NOT NULL,
  `origin_school` varchar(255) NOT NULL,
  `origin_section` int(11) NOT NULL,
  `receiving_section` int(11) NOT NULL,
  `actions_needed` varchar(255) NOT NULL,
  `datetime_posted` datetime NOT NULL,
  `datetime_accepted` datetime NOT NULL,
  `acceptedby_userid` int(11) NOT NULL,
  `acct_dvnum` varchar(100) NOT NULL,
  `acct_payee` varchar(150) NOT NULL,
  `acct_particulars` varchar(255) NOT NULL,
  `acct_amount` decimal(11,0) NOT NULL,
  `final_actions_made` longtext NOT NULL,
  `done` int(11) NOT NULL DEFAULT 0,
  `datetime_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedby_id` int(11) NOT NULL,
  `archive_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `deactivate_reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dts_docstype`
--

CREATE TABLE `dts_docstype` (
  `doctype_id` int(11) NOT NULL,
  `doctype_description` varchar(255) NOT NULL,
  `display_sequence` int(11) NOT NULL,
  `public_display` int(11) NOT NULL DEFAULT 1,
  `with_form` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dts_docstype`
--

INSERT INTO `dts_docstype` (`doctype_id`, `doctype_description`, `display_sequence`, `public_display`, `with_form`, `active`) VALUES
(12, 'Disbursement Voucher', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dts_sections`
--

CREATE TABLE `dts_sections` (
  `section_id` int(11) NOT NULL,
  `section_description` varchar(255) NOT NULL,
  `office_id` int(11) NOT NULL DEFAULT 44,
  `initial_receipt` int(11) NOT NULL DEFAULT 0,
  `public_view` int(11) NOT NULL DEFAULT 0,
  `datetime_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hidden` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dts_sections`
--

INSERT INTO `dts_sections` (`section_id`, `section_description`, `office_id`, `initial_receipt`, `public_view`, `datetime_updated`, `hidden`, `active`) VALUES
(1, 'GUEST', 0, 0, 0, '2018-01-11 13:56:31', 1, 1),
(3, 'Receiving Planning', 64, 1, 1, '2024-03-25 06:22:36', 0, 1),
(4, 'Accounting', 64, 1, 0, '2024-03-25 06:22:50', 0, 1),
(5, 'PENRO', 64, 1, 0, '2023-07-31 01:42:03', 0, 1),
(10, 'Budget', 64, 0, 0, '2023-07-31 01:41:50', 0, 1),
(15, 'Cashier', 64, 1, 0, '2023-07-24 14:27:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dts_tempdocs`
--

CREATE TABLE `dts_tempdocs` (
  `tempdoc_id` int(11) NOT NULL,
  `temp_doctype_id` int(11) NOT NULL,
  `tempdoc_description` varchar(255) NOT NULL,
  `school_id` int(11) NOT NULL,
  `school` varchar(255) NOT NULL,
  `fromsection_id` int(11) NOT NULL DEFAULT 0,
  `submitted_by` varchar(255) NOT NULL,
  `submitter_id` int(11) NOT NULL DEFAULT 0,
  `receiving_section_id` int(11) NOT NULL DEFAULT 0,
  `actions_needed` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `datetime_posted` datetime NOT NULL,
  `datetime_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedby_id` int(11) NOT NULL,
  `accepted` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dts_tempdocs`
--

INSERT INTO `dts_tempdocs` (`tempdoc_id`, `temp_doctype_id`, `tempdoc_description`, `school_id`, `school`, `fromsection_id`, `submitted_by`, `submitter_id`, `receiving_section_id`, `actions_needed`, `remarks`, `datetime_posted`, `datetime_updated`, `updatedby_id`, `accepted`, `active`) VALUES
(1, 12, 'sample', 0, 'DENR PENRO SOUTHERN LEYTE', 1, 'Ranel Dolera', 0, 3, 'sample', '', '2024-03-25 08:18:19', '2024-03-25 07:18:57', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `sch_id` int(11) NOT NULL,
  `school_code` varchar(100) NOT NULL,
  `district` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `office_type` varchar(100) NOT NULL DEFAULT 'school',
  `sch_type` varchar(100) NOT NULL,
  `sch_address` varchar(255) NOT NULL,
  `date_establish` date NOT NULL,
  `sch_head_id` int(11) NOT NULL,
  `property_number_prefix` varchar(10) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`sch_id`, `school_code`, `district`, `school_name`, `office_type`, `sch_type`, `sch_address`, `date_establish`, `sch_head_id`, `property_number_prefix`, `active`) VALUES
(64, '092713', '', 'DENR PENRO SOUTHERN LEYTE', 'office', 'office', '', '0000-00-00', 0, 'EA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_users`
--

CREATE TABLE `temp_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `actkey` varchar(255) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `secured_pass` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `designation` varchar(255) NOT NULL DEFAULT 'Employee',
  `dts_admin` int(11) NOT NULL DEFAULT 0,
  `dts_section_id` int(11) NOT NULL DEFAULT 17,
  `dts_image_url` varchar(255) NOT NULL DEFAULT 'assets/dist/img/avatar2.png',
  `staff_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `school_head` varchar(20) NOT NULL,
  `ict_coordinator` varchar(20) NOT NULL,
  `property_custodian` varchar(20) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `system_admin` int(11) NOT NULL DEFAULT 0,
  `approved` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `fullname`, `email`, `contact_number`, `password`, `secured_pass`, `first_name`, `middle_name`, `last_name`, `sex`, `designation`, `dts_admin`, `dts_section_id`, `dts_image_url`, `staff_id`, `station_id`, `school_head`, `ict_coordinator`, `property_custodian`, `user_type`, `system_admin`, `approved`, `active`) VALUES
(1, 'System Admin', 'system.admin@gmail.com', '9058079457', '12345', 0, 'System', 'Officer', 'Admin', 'male', 'Employee', 1, 5, 'assets/dist/img/avatar5.png', 0, 64, 'No', 'No', 'No', 'System Administrator', 1, 1, 1),
(11, 'Ralp Libres', 'planningoffice@gmail.com', 'N/A', '12345', 0, 'Ralp', 'Z.', 'Libres', 'male', 'Receiving', 0, 3, 'assets/dist/img/avatar5.png', 0, 64, 'no', 'no', 'no', '', 0, 1, 1),
(12, 'Mary Joy Calapre', 'budgetsection@gmail.com', 'N/A', '12345', 0, 'Mary Joy', '', 'Calapre', 'female', 'Accounting Clerk', 0, 10, 'assets/dist/img/avatar3.png', 0, 64, 'no', 'no', 'no', '', 0, 1, 1),
(13, 'MA. Magdalena Bandibas', 'budgetsection2@gmail.com', 'N/A', '12345', 0, 'MA. Magdalena', '', 'Bandibas', 'female', 'Budget Officer II', 0, 10, 'assets/dist/img/avatar3.png', 0, 64, 'no', 'no', 'no', '', 0, 1, 1),
(14, 'Leonil Ligad', 'accounting01@gmailcom', 'N/A', '12345', 0, 'Leonil', '', 'Ligad', 'male', 'Accounting Unit Chief', 0, 4, 'assets/dist/img/avatar5.png', 0, 64, 'no', 'no', 'no', '', 0, 1, 1),
(15, 'Jessica Joy Mejares', 'cashier@gmail.com', 'N/A', '12345', 0, 'Jessica Joy', '', 'Mejares', 'female', 'OIC Cashier', 0, 15, 'assets/dist/img/avatar3.png', 0, 64, 'no', 'no', 'no', '', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_management`
--

CREATE TABLE `user_management` (
  `uam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `inv_school_id` int(11) NOT NULL,
  `inv_user` int(1) NOT NULL DEFAULT 0,
  `inv_user_designation` varchar(100) NOT NULL,
  `inv_admin` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_sessions`
--

CREATE TABLE `web_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_sessions`
--

INSERT INTO `web_sessions` (`id`, `ip_address`, `timestamp`, `data`, `active`) VALUES
('vqgo0i7m8bdu3hvj972hlg2nehsiegf1', '::1', 1690202448, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303230323137383b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a227070747069676e656a6e363238716a6f73336e637036336b6437326833746475223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('32fijrf60o1t50d2o3ceb1kf2ulmnajd', '::1', 1690202788, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303230323532333b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a22333266696a726636306f3174353064326f33636562316b6632756c6d6e616a64223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('2trhqbap8tjid3o6pk8olabd6fhjgigm', '::1', 1690203233, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303230323933353b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a22327472687162617038746a6964336f36706b386f6c6162643666686a6769676d223b7573657249447c733a313a2235223b75736572646174617c733a31323a2252616e656c20446f6c657261223b, 0),
('m38gj7qhc4l3s8b6lblr2o62b1r05dr1', '::1', 1690203307, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303230333237373b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a22327472687162617038746a6964336f36706b386f6c6162643666686a6769676d223b7573657249447c733a313a2235223b75736572646174617c733a31323a2252616e656c20446f6c657261223b, 0),
('8vtq7t632jabeqe85mgkthnd2hku54pu', '::1', 1690207865, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303230373835363b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a223876747137743633326a616265716538356d676b74686e6432686b7535347075223b7573657249447c733a313a2235223b75736572646174617c733a31323a2252616e656c20446f6c657261223b, 0),
('7au4f2bdqo3otrucdhmscaj02tsod2bh', '::1', 1690208837, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303230383535303b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a223761753466326264716f336f7472756364686d7363616a303274736f64326268223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('2h2rd2g6llr0vvpjss2jur8fdrqgn5qu', '::1', 1690209178, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303230393137363b, 0),
('bqsj9rahg976co8u1m63ampm6j8a9qsp', '::1', 1690330254, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303333303234373b, 0),
('dbdahf9bt1tp1ll8bc9tcdntodf2914q', '::1', 1690385178, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303338353137313b, 0),
('s6ss0rok9qj55i665onr9errcvsc79pt', '::1', 1690503184, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303530333036363b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a227336737330726f6b39716a3535693636356f6e72396572726376736337397074223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('lnknsrle2n90dkqf8n65gokn6k6427tb', '::1', 1690521896, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303532313839353b, 0),
('639hkobiasqoea68u61tnaddqdatggo3', '::1', 1690528036, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303532383033333b, 0),
('foj5r94pn5dvtkhn54v64a6b9un407jm', '::1', 1690528867, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303532383835393b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a22666f6a35723934706e356476746b686e353476363461366239756e3430376a6d223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('leq0uqg81hl6m07e7og5s9mcuovp052p', '::1', 1690764573, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303736343537323b, 0),
('2kd2lv4fq8v9e0bj6khi5615dtjdqano', '::1', 1690765299, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303736343939393b, 0),
('s8kdqs7khs563dasi3elg4ljb20sjk4q', '::1', 1690765318, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303736353330373b, 0),
('ng79ude5ueq5dv1icljfogrh6ofe2i4u', '::1', 1690766396, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303736363339363b, 0),
('8j0og296qp0lcp29qkfcsp0rcs1mf68f', '::1', 1690767891, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303736373631303b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a22386a306f673239367170306c63703239716b6663737030726373316d66363866223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('6afsnkv0eo9mj23dnanj9mdqo157vip0', '::1', 1690768144, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303736373932323b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a22386a306f673239367170306c63703239716b6663737030726373316d66363866223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('kdapd4kkdtgituqm6o51adch12ahh1qn', '::1', 1690773447, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303737333434373b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a22386a306f673239367170306c63703239716b6663737030726373316d66363866223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('or166825dd2nc6ftspurtbtugubciveb', '::1', 1690774728, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303737343434343b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a226f723136363832356464326e6336667473707572746274756775626369766562223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('mb0vnjccl5q9kmoirnga6hig2ij7mseb', '::1', 1690774786, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303737343736323b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a226f723136363832356464326e6336667473707572746274756775626369766562223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('vtc4snc5kl6vi3eko1pdvj4d0bbhkadh', '::1', 1690781646, 0x5f5f63695f6c6173745f726567656e65726174657c693a313639303738313634333b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a226f723136363832356464326e6336667473707572746274756775626369766562223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('r9ih2fsvim0ojv22sfae3ppv7njvcqnn', '::1', 1711350631, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731313335303633313b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a227239696832667376696d306f6a7632327366616533707076376e6a7663716e6e223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('3ctavlsfre1loha571j26rsoebesfjss', '::1', 1711350933, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731313335303933333b6c6f676765645f696e7c623a313b73657373696f6e5f69647c733a33323a227239696832667376696d306f6a7632327366616533707076376e6a7663716e6e223b7573657249447c733a313a2231223b75736572646174617c733a31323a2253797374656d2041646d696e223b, 0),
('jp0oq0bbgbnuu4pqargrsetjro2s1tkc', '::1', 1711353822, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731313335333832323b, 0),
('iebur106lglhifaknbnkii621m8dk60k', '::1', 1711353825, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731313335333832323b, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0,
  `url_type` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_url` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dts_docroutes`
--
ALTER TABLE `dts_docroutes`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `dts_docs`
--
ALTER TABLE `dts_docs`
  ADD PRIMARY KEY (`doc_id`),
  ADD UNIQUE KEY `doc_tracking` (`doc_tracking`);

--
-- Indexes for table `dts_docstype`
--
ALTER TABLE `dts_docstype`
  ADD PRIMARY KEY (`doctype_id`);

--
-- Indexes for table `dts_sections`
--
ALTER TABLE `dts_sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `dts_tempdocs`
--
ALTER TABLE `dts_tempdocs`
  ADD PRIMARY KEY (`tempdoc_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`sch_id`),
  ADD UNIQUE KEY `school_id` (`school_code`);

--
-- Indexes for table `temp_users`
--
ALTER TABLE `temp_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `TIN` (`email`);

--
-- Indexes for table `user_management`
--
ALTER TABLE `user_management`
  ADD PRIMARY KEY (`uam_id`);

--
-- Indexes for table `web_sessions`
--
ALTER TABLE `web_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`),
  ADD KEY `post_name` (`post_name`(191));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dts_docroutes`
--
ALTER TABLE `dts_docroutes`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2679;

--
-- AUTO_INCREMENT for table `dts_docs`
--
ALTER TABLE `dts_docs`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1144;

--
-- AUTO_INCREMENT for table `dts_docstype`
--
ALTER TABLE `dts_docstype`
  MODIFY `doctype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dts_sections`
--
ALTER TABLE `dts_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `dts_tempdocs`
--
ALTER TABLE `dts_tempdocs`
  MODIFY `tempdoc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `sch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `temp_users`
--
ALTER TABLE `temp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_management`
--
ALTER TABLE `user_management`
  MODIFY `uam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11801;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'server', 'dts', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"db_select[]\":[\"dts\",\"phpmyadmin\",\"test\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@SERVER@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"yaml_structure_or_data\":\"data\",\"\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"csv_columns\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"dts\",\"table\":\"dts_docs\"},{\"db\":\"dts\",\"table\":\"dts_docstype\"},{\"db\":\"dts\",\"table\":\"users\"},{\"db\":\"dts\",\"table\":\"schools\"},{\"db\":\"dts\",\"table\":\"dts_sections\"},{\"db\":\"dts\",\"table\":\"dts_tempdocs\"},{\"db\":\"dts\",\"table\":\"temp_users\"},{\"db\":\"dts\",\"table\":\"user_management\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-03-25 08:03:54', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
