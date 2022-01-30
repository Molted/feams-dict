-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2021 at 02:34 AM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u623987209_fea`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `uploader` int(11) NOT NULL,
  `link` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo` varchar(60) DEFAULT NULL,
  `platform` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `comment_date` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `constitutions`
--

CREATE TABLE `constitutions` (
  `id` int(11) NOT NULL,
  `area` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `constitutions`
--

INSERT INTO `constitutions` (`id`, `area`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PREAMBLE', '<p>&nbsp; &nbsp; &nbsp; We, the faculty members and employees of the Polytechnic University of the Philippines Taguig Campus, in order to enhance our role in the program and development of our society through pursuit of academic excellence, to have a dynamic commitment to nationalism and to our democratic institutions, and to support the policies and progress vital to the growth and success of the University and the advancement of the socio-economic welfare, do ordain and promulgate this Constitution and By-laws.<br></p>', '2021-10-04 10:46:11', '2021-10-04 10:46:11', NULL),
(2, 'ARTICLE I: NAME AND DOMCILE', '<p><b>Section 1.</b> The Association shall be known as the Polytechnic University of the Philippines Taguig Faculty and Employee Association (PUPTFEA).</p><p><b>Section 2.</b> The principal office of the Association shall be located at the Faculty Room 2nd floor of the Administrative Bldg.</p><div><br></div>', '2021-10-04 10:46:42', '2021-10-04 10:46:42', NULL),
(3, 'ARTICLE II: DECLARATION OF OBJECTIVES', '<p><b>Section 1.</b> The PUPTFEA shall adhere to the following objectives:</p><ol><li>To establish an association that will represent in dealing with the PUP Administration.</li><li>To promote the moral, social and economic well-being of the members.</li><li>To coordinate and cooperate in the implementation of the academic activities.</li><li>To foster the spirit of cooperation and fellowship among members.</li><li>To protect and uphold the individual and collective rights of all members as individual and of the association as a whole.</li></ol>', '2021-10-04 10:47:53', '2021-10-04 10:47:53', NULL),
(4, 'ARTICLE III: MEMBERSHIP AND DUES', '<p><b>Section 1</b>. All faculty members and administrative employees of the Polytechnic University of the Philippines Taguig Campus are automatically members of the PUPTFEA.</p><p><b>Section 2</b>. Membership fee of one hundred fifty pesos (100.00) shall be collected from a new member at the start of every semester of every school year.</p><p><b>Section 3</b>. Membership dues of one hundred fifty pesos (150.00) shall be collected from the members as fund of the association.</p><div><br></div>', '2021-10-04 10:48:21', '2021-10-04 10:48:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE `contributions` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `cost` double NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `vote_start` datetime NOT NULL,
  `vote_end` datetime NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 for with party, 2 for per type of employee',
  `status` enum('Application','Voting','Finished') NOT NULL DEFAULT 'Application',
  `officer_set` tinyint(1) NOT NULL COMMENT 'has the officer set',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `electoral_positions`
--

CREATE TABLE `electoral_positions` (
  `id` int(11) NOT NULL,
  `position_name` varchar(150) NOT NULL,
  `max_candidate` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `file_sharing`
--

CREATE TABLE `file_sharing` (
  `id` int(11) NOT NULL,
  `file_name` varchar(150) NOT NULL,
  `size` int(25) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `uploader` int(11) NOT NULL COMMENT 'user id of the uploader',
  `category` varchar(50) NOT NULL COMMENT 'file category',
  `visibility` enum('for all','admin') NOT NULL COMMENT 'visibility of the file',
  `downloads` int(11) NOT NULL COMMENT 'Number of downloads',
  `uploaded_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `login_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `user_id`, `role_id`, `login_date`) VALUES
(1, 1, 1, '2021-10-14 17:33:15'),
(2, 1, 1, '2021-10-16 20:07:11'),
(3, 1, 1, '2021-10-16 20:12:39'),
(4, 1, 1, '2021-10-16 20:45:05'),
(5, 1, 1, '2021-10-16 21:13:04'),
(6, 1, 1, '2021-10-17 14:45:26'),
(7, 1, 1, '2021-10-17 23:05:23'),
(8, 1, 1, '2021-10-17 23:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `author` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `election_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `contri_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `added_by` int(11) NOT NULL COMMENT 'User that added the transaction',
  `is_approved` tinyint(1) NOT NULL COMMENT 'Is the transaction approved',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_feedbacks`
--

CREATE TABLE `payment_feedbacks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `comment` longtext NOT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `steps` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `steps`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GCash', '<ol><li>Go to GCash app on your cell phone</li><li>Tap on send money</li><li>Tap \"Express Send\"</li><li>Enter mobile number \'09123123123\'</li><li>Add 200php as the amount then tap next</li><li>Tap on send</li><li>Take a screenshot of the receipt</li><li>Return <a href=\"http://feams.csovernightstaguig.online/\" target=\"_blank\">to the site</a> and login your account</li><li>A popup should appear, and upload the receipt.</li><li>Wait for the email from the site administrator when your verification is success.</li></ol>', '2021-09-01 10:26:32', '2021-10-07 18:50:12', NULL),
(2, 'Landbank', '<p><img src=\"https://governmentph.com/wp-content/uploads/2017/10/How-to-transfer-money-using-Landbank-Mobile-App_6.png\" style=\"width: 25%;\"><br></p>', '2021-09-01 10:28:35', '2021-09-01 10:28:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `perm_mod` varchar(10) NOT NULL,
  `desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `perm_mod`, `desc`) VALUES
(1, 'USR', 'View Users'),
(2, 'USR', 'Delete Users'),
(3, 'USR', 'Change User Status'),
(4, 'USR', 'Change User Role'),
(5, 'ROLE', 'Add role'),
(6, 'ROLE', 'Edit role'),
(7, 'ROLE', 'Delete role'),
(8, 'ROLE', 'View roles'),
(9, 'PERM', 'View permissions'),
(10, 'PERM', 'Edit permissions'),
(11, 'ANN', 'View announcements'),
(12, 'ANN', 'Add announcements'),
(13, 'ANN', 'Edit announcements'),
(14, 'ANN', 'Delete announcements'),
(15, 'SLID', 'View sliders'),
(16, 'SLID', 'Add sliders'),
(17, 'SLID', 'Edit sliders'),
(18, 'SLID', 'Delete sliders'),
(19, 'ELEC', 'View elections'),
(20, 'ELEC', 'Add elections'),
(21, 'ELEC', 'Edit elections'),
(22, 'ELEC', 'Delete elections'),
(23, 'POS', 'View positions'),
(24, 'POS', 'Add position'),
(25, 'POS', 'Edit position'),
(26, 'POS', 'Delete position'),
(27, 'CAN', 'View candidate'),
(28, 'CAN', 'Add candidate'),
(29, 'CAN', 'Edit candidate'),
(30, 'CAN', 'Delete candidate'),
(31, 'FILES', 'View files'),
(32, 'FILES', 'Manage files'),
(33, 'FICAT', 'View file categories'),
(34, 'FICAT', 'Manage file categories'),
(35, 'DISC', 'Manage discussions'),
(36, 'COMM', 'Manage comments'),
(37, 'REPO', 'View reports'),
(38, 'USR', 'Edit Users'),
(39, 'CONT', 'Manage contributions'),
(40, 'PAY', 'Manage payments'),
(41, 'NEWS', 'View News'),
(42, 'NEWS', 'Add News'),
(43, 'NEWS', 'Edit News'),
(44, 'NEWS', 'Delete News');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `elec_position_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'System Administrator', '2021-08-30 09:03:32', NULL, NULL),
(2, 'Member', '2021-08-30 09:03:32', NULL, NULL),
(3, 'Treasurer', '2021-09-14 15:02:44', '2021-09-14 15:02:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `perm_mod` varchar(10) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `perm_mod`, `perm_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(58, 1, 'USR', 1, '2021-09-17 09:27:45', '2021-09-17 09:27:45', NULL),
(59, 1, 'USR', 2, '2021-09-17 09:27:47', '2021-09-17 09:27:47', NULL),
(60, 1, 'USR', 3, '2021-09-17 09:27:47', '2021-09-17 09:27:47', NULL),
(61, 1, 'USR', 4, '2021-09-17 09:27:47', '2021-09-17 09:27:47', NULL),
(62, 1, 'ROLE', 5, '2021-09-17 09:27:48', '2021-09-17 09:27:48', NULL),
(63, 1, 'ROLE', 6, '2021-09-17 09:27:48', '2021-09-17 09:27:48', NULL),
(64, 1, 'ROLE', 7, '2021-09-17 09:27:48', '2021-09-17 09:27:48', NULL),
(65, 1, 'ROLE', 8, '2021-09-17 09:27:49', '2021-09-17 09:27:49', NULL),
(66, 1, 'PERM', 9, '2021-09-17 09:27:49', '2021-09-17 09:27:49', NULL),
(67, 1, 'PERM', 10, '2021-09-17 09:27:49', '2021-09-17 09:27:49', NULL),
(68, 1, 'ANN', 11, '2021-09-17 09:27:50', '2021-09-17 09:27:50', NULL),
(69, 1, 'ANN', 12, '2021-09-17 09:27:50', '2021-09-17 09:27:50', NULL),
(70, 1, 'ANN', 13, '2021-09-17 09:27:50', '2021-09-17 09:27:50', NULL),
(71, 1, 'ANN', 14, '2021-09-17 09:27:50', '2021-09-17 09:27:50', NULL),
(72, 1, 'SLID', 15, '2021-09-17 09:27:50', '2021-09-17 09:27:50', NULL),
(73, 1, 'SLID', 16, '2021-09-17 09:27:51', '2021-09-17 09:27:51', NULL),
(74, 1, 'SLID', 17, '2021-09-17 09:27:51', '2021-09-17 09:27:51', NULL),
(75, 1, 'SLID', 18, '2021-09-17 09:27:51', '2021-09-17 09:27:51', NULL),
(76, 1, 'ELEC', 19, '2021-09-17 09:27:51', '2021-09-17 09:27:51', NULL),
(77, 1, 'ELEC', 20, '2021-09-17 09:27:51', '2021-09-17 09:27:51', NULL),
(78, 1, 'ELEC', 21, '2021-09-17 09:27:52', '2021-09-17 09:27:52', NULL),
(79, 1, 'ELEC', 22, '2021-09-17 09:27:52', '2021-09-17 09:27:52', NULL),
(80, 1, 'POS', 23, '2021-09-17 09:27:52', '2021-09-17 09:27:52', NULL),
(81, 1, 'POS', 24, '2021-09-17 09:27:52', '2021-09-17 09:27:52', NULL),
(82, 1, 'POS', 25, '2021-09-17 09:27:53', '2021-09-17 09:27:53', NULL),
(83, 1, 'POS', 26, '2021-09-17 09:27:53', '2021-09-17 09:27:53', NULL),
(84, 1, 'CAN', 27, '2021-09-17 09:27:53', '2021-09-17 09:27:53', NULL),
(85, 1, 'CAN', 28, '2021-09-17 09:27:53', '2021-09-17 09:27:53', NULL),
(86, 1, 'CAN', 29, '2021-09-17 09:27:53', '2021-09-17 09:27:53', NULL),
(87, 1, 'CAN', 30, '2021-09-17 09:27:54', '2021-09-17 09:27:54', NULL),
(88, 1, 'FILES', 31, '2021-09-17 09:27:54', '2021-09-17 09:27:54', NULL),
(89, 1, 'FILES', 32, '2021-09-17 09:27:54', '2021-09-17 09:27:54', NULL),
(90, 1, 'FICAT', 33, '2021-09-17 09:27:54', '2021-09-17 09:27:54', NULL),
(91, 1, 'FICAT', 34, '2021-09-17 09:27:54', '2021-09-17 09:27:54', NULL),
(92, 1, 'DISC', 35, '2021-09-17 09:27:55', '2021-09-17 09:27:55', NULL),
(93, 1, 'COMM', 36, '2021-09-17 09:27:55', '2021-09-17 09:27:55', NULL),
(94, 1, 'REPO', 37, '2021-09-17 09:27:55', '2021-09-17 09:27:55', NULL),
(95, 1, 'USR', 38, '2021-09-17 09:27:55', '2021-09-17 09:27:55', NULL),
(96, 1, 'CONT', 39, '2021-09-17 09:27:55', '2021-09-17 09:27:55', NULL),
(97, 1, 'PAY', 40, '2021-09-17 09:27:56', '2021-09-17 09:27:56', NULL),
(98, 1, 'NEWS', 41, '2021-09-17 09:27:56', '2021-09-17 09:27:56', NULL),
(99, 1, 'NEWS', 42, '2021-09-17 09:27:56', '2021-09-17 09:27:56', NULL),
(100, 1, 'NEWS', 43, '2021-09-17 09:27:56', '2021-09-17 09:27:56', NULL),
(101, 1, 'NEWS', 44, '2021-09-17 09:27:56', '2021-09-17 09:27:56', NULL),
(109, 3, 'REPO', 37, '2021-10-08 17:04:58', '2021-10-08 17:04:58', NULL),
(110, 3, 'CONT', 39, '2021-10-08 17:04:58', '2021-10-08 17:04:58', NULL),
(111, 3, 'PAY', 40, '2021-10-08 17:04:58', '2021-10-08 17:04:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `uploader` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `creator` int(11) NOT NULL,
  `visibility` int(11) NOT NULL COMMENT '0 for all and other numbers will be the role',
  `link` varchar(255) NOT NULL,
  `status` char(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `proof` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `contact_number` decimal(11,0) NOT NULL,
  `email_code` varchar(10) NOT NULL,
  `role` bigint(20) NOT NULL DEFAULT 0,
  `type` enum('1','2','3','') NOT NULL COMMENT '1 for regular, 2 for part time, 3 for admin',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: unpaid\r\n1: active\r\n2: inactive\r\n3: paid\r\n4: pending email verification',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `email`, `gender`, `profile_pic`, `payment_method`, `proof`, `birthdate`, `contact_number`, `email_code`, `role`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '', 'admin', 'admin', '$2y$10$1xnbQsX2OX.Sp10pWrte9.hZ3BMiXrrBU6ZypOk2iDygwBf4UQqBS', 'facultyea@gmail.com', 'Male', 'admin.png', NULL, '', '1999-11-03', '9195252973', '', 1, '1', 1, '2021-08-30 09:03:20', NULL, NULL),
(2, 'Treasurer', '', 'Account', 'treasurer', '$2y$10$WsTfJp/05oCT.RBYBKZVL.9vi15NZqFLZyyRbFOCRJBFqgD.6Ljay', 'ichanpotts@gmail.com', 'Female', '1633626748_d31335bd7ebe86237f66.png', 1, '1633626772_3f6d467334a906eebb79.jpg', '1997-07-02', '9123123123', '', 0, '1', 3, '2021-10-08 01:12:28', '2021-10-08 01:12:52', NULL);


-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `date_casted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `votes2`
--

CREATE TABLE `votes2` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `date_casted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vote_details`
--

CREATE TABLE `vote_details` (
  `id` int(11) NOT NULL,
  `votes_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vote_details2`
--

CREATE TABLE `vote_details2` (
  `id` int(11) NOT NULL,
  `votes_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` enum('1','2','3') DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `candidate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `constitutions`
--
ALTER TABLE `constitutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electoral_positions`
--
ALTER TABLE `electoral_positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_sharing`
--
ALTER TABLE `file_sharing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_feedbacks`
--
ALTER TABLE `payment_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes2`
--
ALTER TABLE `votes2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote_details`
--
ALTER TABLE `vote_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote_details2`
--
ALTER TABLE `vote_details2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `constitutions`
--
ALTER TABLE `constitutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `electoral_positions`
--
ALTER TABLE `electoral_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_sharing`
--
ALTER TABLE `file_sharing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_feedbacks`
--
ALTER TABLE `payment_feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `votes2`
--
ALTER TABLE `votes2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vote_details`
--
ALTER TABLE `vote_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vote_details2`
--
ALTER TABLE `vote_details2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
