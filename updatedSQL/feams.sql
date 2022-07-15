-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 15, 2022 at 12:54 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feams`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Added a new election named \"Test election\".', '2022-06-05 00:45:55', '2022-06-05 00:45:55', NULL),
(2, 1, 'Added an electoral position', '2022-06-05 00:47:03', '2022-06-05 00:47:03', NULL),
(3, 1, 'Edited positions for election Test election', '2022-06-05 00:47:53', '2022-06-05 00:47:53', NULL),
(4, 1, 'Added an discussion thread', '2022-06-05 02:27:01', '2022-06-05 02:27:01', NULL),
(5, 1, 'Deleted a comment on test', '2022-06-05 02:27:43', '2022-06-05 02:27:43', NULL),
(6, 1, 'Added an discussion thread', '2022-06-12 00:57:15', '2022-06-12 00:57:15', NULL),
(7, 1, 'Added a new constitution area', '2022-06-12 01:05:41', '2022-06-12 01:05:41', NULL),
(8, 1, 'Deleted an constitution', '2022-06-12 01:06:07', '2022-06-12 01:06:07', NULL),
(9, 1, 'Added a new constitution area', '2022-06-12 01:06:37', '2022-06-12 01:06:37', NULL),
(10, 1, 'Deleted an constitution', '2022-06-12 01:09:22', '2022-06-12 01:09:22', NULL),
(11, 1, 'Added a new constitution area', '2022-06-12 01:12:20', '2022-06-12 01:12:20', NULL),
(12, 1, 'Deleted an constitution', '2022-06-12 01:35:22', '2022-06-12 01:35:22', NULL),
(13, 1, 'Added a new constitution area', '2022-06-12 01:46:24', '2022-06-12 01:46:24', NULL),
(14, 1, 'Deleted an constitution', '2022-06-12 01:46:58', '2022-06-12 01:46:58', NULL),
(15, 1, 'Added a new constitution area', '2022-06-12 01:56:56', '2022-06-12 01:56:56', NULL),
(16, 1, 'Deleted an constitution', '2022-06-12 02:08:30', '2022-06-12 02:08:30', NULL),
(17, 1, 'Added a new constitution area', '2022-06-12 02:39:05', '2022-06-12 02:39:05', NULL),
(18, 1, 'Deleted an constitution', '2022-06-12 02:39:16', '2022-06-12 02:39:16', NULL),
(19, 1, 'Added a new contribution', '2022-06-12 16:56:04', '2022-06-12 16:56:04', NULL),
(20, 1, 'Added a new announcement', '2022-06-12 19:37:41', '2022-06-12 19:37:41', NULL),
(21, 1, 'Added news', '2022-06-12 19:39:00', '2022-06-12 19:39:00', NULL),
(22, 1, 'Added a new election named \"Election sample\".', '2022-06-12 19:40:22', '2022-06-12 19:40:22', NULL),
(23, 1, 'Added an electoral position', '2022-06-12 19:41:07', '2022-06-12 19:41:07', NULL),
(24, 1, 'Changed status of eudesaugustine to Active', '2022-06-17 01:52:27', '2022-06-17 01:52:27', NULL),
(25, 3, 'Paid 10 for the contribution: Testing contributions x', '2022-06-17 02:01:12', '2022-06-17 02:01:12', NULL),
(26, 1, 'Approved payment for contribution: Testing contributions x of Eudes Augustine Silerio', '2022-06-17 02:04:23', '2022-06-17 02:04:23', NULL),
(27, 1, 'Edited an announcement', '2022-06-17 02:24:20', '2022-06-17 02:24:20', NULL),
(28, 1, 'Edited an announcement', '2022-06-17 02:27:13', '2022-06-17 02:27:13', NULL),
(29, 1, 'Edited an announcement', '2022-06-17 02:28:25', '2022-06-17 02:28:25', NULL),
(30, 1, 'Added a new announcement', '2022-06-17 02:29:43', '2022-06-17 02:29:43', NULL),
(31, 1, 'Added a new announcement', '2022-06-17 02:52:40', '2022-06-17 02:52:40', NULL),
(32, 1, 'Added a new announcement', '2022-06-18 16:32:24', '2022-06-18 16:32:24', NULL),
(33, 1, 'Added a new constitution area', '2022-06-20 02:41:12', '2022-06-20 02:41:12', NULL),
(34, 1, 'Deleted an constitution', '2022-06-20 02:41:25', '2022-06-20 02:41:25', NULL),
(35, 1, 'Added a new contribution', '2022-06-20 21:44:23', '2022-06-20 21:44:23', NULL),
(36, 1, 'Added a new announcement', '2022-06-22 01:27:07', '2022-06-22 01:27:07', NULL),
(37, 3, 'Paid 50 for the contribution: Semestral dues', '2022-06-30 18:03:23', '2022-06-30 18:03:23', NULL),
(38, 1, 'Added a new contribution', '2022-06-30 18:06:45', '2022-06-30 18:06:45', NULL),
(39, 3, 'Paid 10 for the contribution: test', '2022-06-30 18:07:41', '2022-06-30 18:07:41', NULL),
(40, 3, 'Paid 10 for the contribution: test', '2022-06-30 18:12:25', '2022-06-30 18:12:25', NULL),
(41, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(42, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(43, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(44, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(45, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(46, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(47, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(48, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(49, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(50, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(51, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(52, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(53, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(54, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(55, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(56, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(57, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(58, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(59, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(60, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(61, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(62, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(63, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(64, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(65, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(66, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(67, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(68, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(69, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(70, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(71, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(72, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(73, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(74, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(75, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(76, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(77, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(78, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(79, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(80, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(81, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:22', '2022-07-07 01:10:22', NULL),
(82, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:22', '2022-07-07 01:10:22', NULL),
(83, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:22', '2022-07-07 01:10:22', NULL),
(84, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:22', '2022-07-07 01:10:22', NULL),
(85, 1, 'Edited permissions for role System Administrator', '2022-07-07 01:10:22', '2022-07-07 01:10:22', NULL),
(86, 1, 'Added a new Category', '2022-07-08 05:16:28', '2022-07-08 05:16:28', NULL),
(87, 1, 'Added a new Category', '2022-07-08 05:16:44', '2022-07-08 05:16:44', NULL),
(88, 1, 'Added a new election named \"Testing Election\".', '2022-07-09 03:00:58', '2022-07-09 03:00:58', NULL),
(89, 1, 'Edited positions for election Testing Election', '2022-07-09 15:26:13', '2022-07-09 15:26:13', NULL),
(90, 1, 'Edited positions for election Testing Election', '2022-07-09 15:28:03', '2022-07-09 15:28:03', NULL),
(91, 1, 'Added a new election named \"Another Election Testing\".', '2022-07-09 15:43:52', '2022-07-09 15:43:52', NULL),
(92, 1, 'Added a new Category', '2022-07-09 16:52:52', '2022-07-09 16:52:52', NULL),
(93, 1, 'Added a new Category', '2022-07-09 17:01:41', '2022-07-09 17:01:41', NULL),
(94, 1, 'Added a new Category', '2022-07-09 17:23:39', '2022-07-09 17:23:39', NULL),
(95, 1, 'Added a new Category', '2022-07-09 17:56:27', '2022-07-09 17:56:27', NULL),
(96, 1, 'Added a new Category', '2022-07-09 17:57:03', '2022-07-09 17:57:03', NULL),
(97, 1, 'Added a new Category', '2022-07-09 18:23:03', '2022-07-09 18:23:03', NULL),
(98, 1, 'Added a new Category', '2022-07-09 18:26:37', '2022-07-09 18:26:37', NULL),
(99, 1, 'Added a new Category', '2022-07-09 18:29:03', '2022-07-09 18:29:03', NULL),
(100, 1, 'Added a new Category', '2022-07-09 18:42:07', '2022-07-09 18:42:07', NULL),
(101, 1, 'Added a new Category', '2022-07-09 18:47:51', '2022-07-09 18:47:51', NULL),
(102, 1, 'Added a new Category', '2022-07-09 18:56:04', '2022-07-09 18:56:04', NULL),
(103, 1, 'Added a new Category', '2022-07-09 19:33:57', '2022-07-09 19:33:57', NULL),
(104, 1, 'Added news', '2022-07-09 19:41:52', '2022-07-09 19:41:52', NULL),
(105, 1, 'Added a new Category', '2022-07-09 19:58:19', '2022-07-09 19:58:19', NULL),
(106, 1, 'Added a new Category', '2022-07-09 20:09:32', '2022-07-09 20:09:32', NULL),
(107, 1, 'Edited an Item', '2022-07-09 21:39:42', '2022-07-09 21:39:42', NULL),
(108, 1, 'Edited an Item', '2022-07-09 23:23:47', '2022-07-09 23:23:47', NULL),
(109, 1, 'Edited an announcement', '2022-07-10 02:06:37', '2022-07-10 02:06:37', NULL),
(110, 1, 'Edited an announcement', '2022-07-10 02:13:40', '2022-07-10 02:13:40', NULL),
(111, 1, 'Edited an announcement', '2022-07-10 02:15:25', '2022-07-10 02:15:25', NULL),
(112, 1, 'Added a new announcement', '2022-07-10 02:30:32', '2022-07-10 02:30:32', NULL),
(113, 1, 'Changed status of Molted to Active', '2022-07-11 03:00:51', '2022-07-11 03:00:51', NULL),
(114, 1, 'Added a new Announcement', '2022-07-11 15:04:29', '2022-07-11 15:04:29', NULL),
(115, 1, 'Edited an announcement', '2022-07-11 15:26:51', '2022-07-11 15:26:51', NULL),
(116, 1, 'Edited an announcement', '2022-07-11 15:28:41', '2022-07-11 15:28:41', NULL),
(117, 1, 'Edited an announcement', '2022-07-11 15:29:35', '2022-07-11 15:29:35', NULL),
(118, 1, 'Added news', '2022-07-11 15:55:41', '2022-07-11 15:55:41', NULL),
(119, 1, 'Edited an announcement', '2022-07-11 15:59:42', '2022-07-11 15:59:42', NULL),
(120, 1, 'Added a new Announcement', '2022-07-12 05:36:09', '2022-07-12 05:36:09', NULL),
(121, 1, 'Deleted an announcement', '2022-07-12 05:36:34', '2022-07-12 05:36:34', NULL),
(122, 1, 'Edited an announcement', '2022-07-12 14:12:52', '2022-07-12 14:12:52', NULL),
(123, 1, 'Deleted an announcement', '2022-07-12 23:43:38', '2022-07-12 23:43:38', NULL),
(124, 1, 'Added a new Announcement', '2022-07-12 23:54:24', '2022-07-12 23:54:24', NULL),
(125, 1, 'Added a new Announcement', '2022-07-12 23:55:43', '2022-07-12 23:55:43', NULL),
(126, 1, 'Deleted an announcement', '2022-07-12 23:57:22', '2022-07-12 23:57:22', NULL),
(127, 1, 'Deleted an announcement', '2022-07-12 23:57:25', '2022-07-12 23:57:25', NULL),
(128, 1, 'Added a new Announcement', '2022-07-13 00:00:25', '2022-07-13 00:00:25', NULL),
(129, 1, 'Added a new Announcement', '2022-07-13 00:32:36', '2022-07-13 00:32:36', NULL),
(130, 1, 'Added a new Announcement', '2022-07-13 00:35:48', '2022-07-13 00:35:48', NULL),
(131, 1, 'Added a new Announcement', '2022-07-13 00:38:07', '2022-07-13 00:38:07', NULL),
(132, 1, 'Added a new Announcement', '2022-07-13 00:40:33', '2022-07-13 00:40:33', NULL),
(133, 1, 'Deleted an announcement', '2022-07-13 00:41:59', '2022-07-13 00:41:59', NULL),
(134, 1, 'Deleted an announcement', '2022-07-13 00:42:02', '2022-07-13 00:42:02', NULL),
(135, 1, 'Deleted an announcement', '2022-07-13 00:42:05', '2022-07-13 00:42:05', NULL),
(136, 1, 'Deleted an announcement', '2022-07-13 00:42:08', '2022-07-13 00:42:08', NULL),
(137, 1, 'Deleted an announcement', '2022-07-13 00:42:10', '2022-07-13 00:42:10', NULL),
(138, 1, 'Added a new Announcement', '2022-07-13 00:42:45', '2022-07-13 00:42:45', NULL),
(139, 1, 'Added a new Announcement', '2022-07-13 00:43:06', '2022-07-13 00:43:06', NULL),
(140, 1, 'Added a new Announcement', '2022-07-13 00:43:19', '2022-07-13 00:43:19', NULL),
(141, 1, 'Deleted an announcement', '2022-07-13 00:58:58', '2022-07-13 00:58:58', NULL),
(142, 1, 'Deleted an announcement', '2022-07-13 00:59:01', '2022-07-13 00:59:01', NULL),
(143, 1, 'Deleted an announcement', '2022-07-13 00:59:04', '2022-07-13 00:59:04', NULL),
(144, 1, 'Added a new Announcement', '2022-07-13 01:02:21', '2022-07-13 01:02:21', NULL),
(145, 1, 'Added a new Announcement', '2022-07-13 01:05:59', '2022-07-13 01:05:59', NULL),
(146, 1, 'Added a new Announcement', '2022-07-13 01:39:05', '2022-07-13 01:39:05', NULL),
(147, 1, 'Added a new Announcement', '2022-07-13 02:00:38', '2022-07-13 02:00:38', NULL),
(148, 1, 'Deleted an announcement', '2022-07-13 02:02:46', '2022-07-13 02:02:46', NULL),
(149, 1, 'Deleted an announcement', '2022-07-13 02:02:47', '2022-07-13 02:02:47', NULL),
(150, 1, 'Deleted an announcement', '2022-07-13 02:02:51', '2022-07-13 02:02:51', NULL),
(151, 1, 'Deleted an announcement', '2022-07-13 02:02:56', '2022-07-13 02:02:56', NULL),
(152, 1, 'Deleted an announcement', '2022-07-13 02:03:01', '2022-07-13 02:03:01', NULL),
(153, 1, 'Deleted an announcement', '2022-07-13 02:03:05', '2022-07-13 02:03:05', NULL),
(154, 1, 'Deleted an announcement', '2022-07-13 02:03:08', '2022-07-13 02:03:08', NULL),
(155, 1, 'Added a new election named \"Party type Election 1\".', '2022-07-13 04:43:25', '2022-07-13 04:43:25', NULL),
(156, 1, 'Edited positions for election Party type Election 1', '2022-07-13 04:44:15', '2022-07-13 04:44:15', NULL),
(157, 1, 'Added a new candidate', '2022-07-13 04:48:31', '2022-07-13 04:48:31', NULL),
(158, 1, 'Deleted an announcement', '2022-07-13 04:53:09', '2022-07-13 04:53:09', NULL),
(159, 1, 'Edited an payment method', '2022-07-13 15:57:24', '2022-07-13 15:57:24', NULL),
(160, 1, 'Added a new payment method', '2022-07-13 16:27:06', '2022-07-13 16:27:06', NULL),
(161, 1, 'Deleted an payment method', '2022-07-13 16:31:45', '2022-07-13 16:31:45', NULL),
(162, 1, 'Added a new payment method', '2022-07-13 16:36:49', '2022-07-13 16:36:49', NULL),
(163, 1, 'Deleted an payment method', '2022-07-13 16:39:09', '2022-07-13 16:39:09', NULL),
(164, 1, 'Changed status of molted to Active', '2022-07-13 16:44:43', '2022-07-13 16:44:43', NULL),
(165, 1, 'Added a new Announcement', '2022-07-13 17:41:53', '2022-07-13 17:41:53', NULL),
(166, 10, 'Paid 10 for the contribution: Testing contributions x', '2022-07-13 18:01:34', '2022-07-13 18:01:34', NULL),
(167, 10, 'Paid 10 for the contribution: Testing contributions x', '2022-07-13 18:28:56', '2022-07-13 18:28:56', NULL),
(168, 1, 'Added a new election named \"Party type Election\".', '2022-07-13 18:54:01', '2022-07-13 18:54:01', NULL),
(169, 1, 'Added a new election named \"By Employee naman\".', '2022-07-13 18:57:45', '2022-07-13 18:57:45', NULL),
(170, 1, 'Added a new election', '2022-07-13 19:03:45', '2022-07-13 19:03:45', NULL),
(171, 1, 'Uploaded a new file.', '2022-07-13 21:19:08', '2022-07-13 21:19:08', NULL),
(172, 1, 'Uploaded a new file.', '2022-07-13 21:20:07', '2022-07-13 21:20:07', NULL),
(173, 1, 'Added a new Announcement', '2022-07-13 21:23:29', '2022-07-13 21:23:29', NULL),
(174, 1, 'Uploaded a new file.', '2022-07-13 21:31:01', '2022-07-13 21:31:01', NULL),
(175, 1, 'Uploaded a new file.', '2022-07-13 21:54:42', '2022-07-13 21:54:42', NULL),
(176, 1, 'Deleted an news', '2022-07-14 01:33:06', '2022-07-14 01:33:06', NULL),
(177, 1, 'Edited an news', '2022-07-14 01:35:16', '2022-07-14 01:35:16', NULL),
(178, 1, 'Added a new slider', '2022-07-14 01:59:53', '2022-07-14 01:59:53', NULL),
(179, 1, 'Added a new slider', '2022-07-14 02:01:44', '2022-07-14 02:01:44', NULL),
(180, 1, 'Deleted an slider', '2022-07-14 02:02:23', '2022-07-14 02:02:23', NULL),
(181, 1, 'Added a new slider', '2022-07-14 02:02:32', '2022-07-14 02:02:32', NULL),
(182, 1, 'Added a new election named \"Party type election\".', '2022-07-14 03:38:43', '2022-07-14 03:38:43', NULL),
(183, 1, 'Edited positions for election Party type election', '2022-07-14 03:39:45', '2022-07-14 03:39:45', NULL),
(184, 10, 'Paid 50 for the contribution: Semestral dues', '2022-07-14 04:24:16', '2022-07-14 04:24:16', NULL),
(185, 10, 'Sent a feedback', '2022-07-14 04:24:54', '2022-07-14 04:24:54', NULL),
(186, 1, 'Added a new role', '2022-07-14 05:07:51', '2022-07-14 05:07:51', NULL),
(187, 1, 'Edited permissions for role Test Role', '2022-07-14 05:08:20', '2022-07-14 05:08:20', NULL),
(188, 1, 'Added a new Announcement', '2022-07-14 05:10:41', '2022-07-14 05:10:41', NULL),
(189, 1, 'Edited an announcement', '2022-07-14 05:11:38', '2022-07-14 05:11:38', NULL),
(190, 1, 'Added a new Announcement', '2022-07-14 05:12:10', '2022-07-14 05:12:10', NULL),
(191, 1, 'Deleted an announcement', '2022-07-14 05:12:25', '2022-07-14 05:12:25', NULL),
(192, 1, 'Added a new slider', '2022-07-14 05:13:28', '2022-07-14 05:13:28', NULL),
(193, 1, 'Edited an slider', '2022-07-14 05:14:20', '2022-07-14 05:14:20', NULL),
(194, 1, 'Deleted an slider', '2022-07-14 05:14:29', '2022-07-14 05:14:29', NULL),
(195, 1, 'Added news', '2022-07-14 05:15:16', '2022-07-14 05:15:16', NULL),
(196, 1, 'Added news', '2022-07-14 05:15:55', '2022-07-14 05:15:55', NULL),
(197, 1, 'Deleted an news', '2022-07-14 05:16:03', '2022-07-14 05:16:03', NULL),
(198, 1, 'Added a new Announcement', '2022-07-14 05:20:54', '2022-07-14 05:20:54', NULL),
(199, 1, 'Edited an announcement', '2022-07-14 05:21:39', '2022-07-14 05:21:39', NULL),
(200, 1, 'Added a new Announcement', '2022-07-14 05:22:00', '2022-07-14 05:22:00', NULL),
(201, 1, 'Deleted an announcement', '2022-07-14 05:22:15', '2022-07-14 05:22:15', NULL),
(202, 1, 'Added a new slider', '2022-07-14 05:22:53', '2022-07-14 05:22:53', NULL),
(203, 1, 'Edited an slider', '2022-07-14 05:23:48', '2022-07-14 05:23:48', NULL),
(204, 1, 'Deleted an slider', '2022-07-14 05:23:55', '2022-07-14 05:23:55', NULL),
(205, 1, 'Added news', '2022-07-14 05:24:38', '2022-07-14 05:24:38', NULL),
(206, 1, 'Edited an news', '2022-07-14 05:25:16', '2022-07-14 05:25:16', NULL),
(207, 1, 'Deleted an news', '2022-07-14 05:25:22', '2022-07-14 05:25:22', NULL),
(208, 1, 'Added a new election named \"Election by party test\".', '2022-07-14 05:29:40', '2022-07-14 05:29:40', NULL),
(209, 1, 'Added an electoral position', '2022-07-14 05:30:20', '2022-07-14 05:30:20', NULL),
(210, 1, 'Edited an electoral position', '2022-07-14 05:30:44', '2022-07-14 05:30:44', NULL),
(211, 1, 'Deleted an electoral position', '2022-07-14 05:30:51', '2022-07-14 05:30:51', NULL),
(212, 1, 'Edited positions for election Election by party test', '2022-07-14 05:31:35', '2022-07-14 05:31:35', NULL),
(213, 1, 'Voted for the election: Party type Election 1', '2022-07-14 05:34:26', '2022-07-14 05:34:26', NULL),
(214, 1, 'Added a new contribution', '2022-07-14 05:36:49', '2022-07-14 05:36:49', NULL),
(215, 1, 'Deleted a contribution', '2022-07-14 05:37:41', '2022-07-14 05:37:41', NULL),
(216, 1, 'Added a new payment method', '2022-07-14 05:38:47', '2022-07-14 05:38:47', NULL),
(217, 1, 'Approved payment for contribution: Testing contributions of Joshua Concepcion', '2022-07-14 05:40:05', '2022-07-14 05:40:05', NULL),
(218, 1, 'Declined payment for contribution: Semestral dues of Joshua Concepcion', '2022-07-14 05:40:21', '2022-07-14 05:40:21', NULL),
(219, 1, 'Added a new payment', '2022-07-14 05:40:53', '2022-07-14 05:40:53', NULL),
(220, 1, 'Added a new Item', '2022-07-14 05:43:07', '2022-07-14 05:43:07', NULL),
(221, 1, 'Added a new Item', '2022-07-14 05:43:40', '2022-07-14 05:43:40', NULL),
(222, 1, 'Edited an Item', '2022-07-14 05:44:08', '2022-07-14 05:44:08', NULL),
(223, 1, 'Added a new Category', '2022-07-14 05:44:58', '2022-07-14 05:44:58', NULL),
(224, 1, 'Added a new Item', '2022-07-14 05:45:28', '2022-07-14 05:45:28', NULL),
(225, 1, 'Added a new constitution area', '2022-07-14 05:47:27', '2022-07-14 05:47:27', NULL),
(226, 1, 'Edited an constitution', '2022-07-14 05:47:46', '2022-07-14 05:47:46', NULL),
(227, 1, 'Deleted an constitution', '2022-07-14 05:48:01', '2022-07-14 05:48:01', NULL),
(228, 1, 'Added comment on discussion test', '2022-07-14 05:50:24', '2022-07-14 05:50:24', NULL),
(229, 1, 'Added an discussion thread', '2022-07-14 05:51:02', '2022-07-14 05:51:02', NULL),
(230, 13, 'Added an discussion thread', '2022-07-14 05:52:37', '2022-07-14 05:52:37', NULL),
(231, 10, 'Added an discussion thread', '2022-07-14 05:53:26', '2022-07-14 05:53:26', NULL),
(232, 1, 'Added an discussion thread', '2022-07-14 05:55:20', '2022-07-14 05:55:20', NULL),
(233, 1, 'Added comment on discussion Add thread ni admin', '2022-07-14 05:55:40', '2022-07-14 05:55:40', NULL),
(234, 1, 'Deleted a comment on Add thread ni admin', '2022-07-14 05:55:47', '2022-07-14 05:55:47', NULL),
(235, 1, 'Uploaded a new file.', '2022-07-14 05:58:17', '2022-07-14 05:58:17', NULL),
(236, 1, 'Uploaded a new file.', '2022-07-14 05:58:55', '2022-07-14 05:58:55', NULL),
(237, 1, 'Uploaded a new file.', '2022-07-14 05:59:25', '2022-07-14 05:59:25', NULL),
(238, 1, 'Uploaded a new file.', '2022-07-14 05:59:53', '2022-07-14 05:59:53', NULL),
(239, 1, 'Deleted a file.', '2022-07-14 06:01:48', '2022-07-14 06:01:48', NULL),
(240, 13, 'Edited an payment method', '2022-07-14 06:07:41', '2022-07-14 06:07:41', NULL),
(241, 10, 'Voted for the election: Party type Election 1', '2022-07-14 06:08:56', '2022-07-14 06:08:56', NULL),
(242, 10, 'Paid 50 for the contribution: Semestral dues', '2022-07-14 06:09:57', '2022-07-14 06:09:57', NULL),
(243, 1, 'Added a new contribution', '2022-07-14 06:11:11', '2022-07-14 06:11:11', NULL),
(244, 10, 'Paid 75 for the contribution: Testing Contribution', '2022-07-14 06:12:03', '2022-07-14 06:12:03', NULL),
(245, 10, 'Paid 75 for the contribution: Testing Contribution', '2022-07-14 06:15:45', '2022-07-14 06:15:45', NULL),
(246, 10, 'Added an discussion thread', '2022-07-14 06:16:40', '2022-07-14 06:16:40', NULL),
(247, 10, 'Added comment on discussion Add thread ni member', '2022-07-14 06:17:00', '2022-07-14 06:17:00', NULL),
(248, 10, 'Uploaded a new file.', '2022-07-14 06:17:59', '2022-07-14 06:17:59', NULL),
(249, 10, 'Deleted a file.', '2022-07-14 06:18:20', '2022-07-14 06:18:20', NULL),
(250, 1, 'Declined payment for contribution: Testing Contribution of Joshua Concepcion', '2022-07-14 17:35:17', '2022-07-14 17:35:17', NULL),
(251, 10, 'Paid 75 for the contribution: Testing Contribution', '2022-07-14 17:36:37', '2022-07-14 17:36:37', NULL),
(252, 1, 'Declined payment for contribution: Testing Contribution of Joshua Concepcion', '2022-07-14 17:38:02', '2022-07-14 17:38:02', NULL),
(253, 10, 'Paid 75 for the contribution: Testing Contribution', '2022-07-14 18:44:50', '2022-07-14 18:44:50', NULL),
(254, 1, 'Approved payment for contribution: Testing Contribution of Joshua Concepcion', '2022-07-14 18:45:11', '2022-07-14 18:45:11', NULL),
(255, 1, 'Deleted a role', '2022-07-14 19:18:18', '2022-07-14 19:18:18', NULL),
(256, 1, 'Edited permissions for role Treasurer', '2022-07-15 14:51:22', '2022-07-15 14:51:22', NULL),
(257, 1, 'Edited permissions for role Treasurer', '2022-07-15 14:51:22', '2022-07-15 14:51:22', NULL),
(258, 1, 'Uploaded a new file.', '2022-07-15 17:10:10', '2022-07-15 17:10:10', NULL),
(259, 1, 'Deleted a file.', '2022-07-15 17:10:17', '2022-07-15 17:10:17', NULL),
(260, 13, 'Uploaded a new file.', '2022-07-15 17:54:42', '2022-07-15 17:54:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `uploader` int(11) NOT NULL,
  `link` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `election_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo` varchar(60) DEFAULT NULL,
  `platform` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `election_id`, `position_id`, `user_id`, `photo`, `platform`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 8, 1, 10, '1657744588_7352a8cb7cbd0d01f438.jpg', '<p>hgklhgojhghjkgjkgkjg</p>', '2022-07-14 04:36:28', '2022-07-14 04:36:28', NULL),
(4, 9, 1, 10, '1657748037_b3a02f8e7ff3143fcee9.jpg', '<p>Platform test</p>', '2022-07-14 05:33:57', '2022-07-14 05:33:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `image` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `comment_date` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `constitutions`
--

DROP TABLE IF EXISTS `constitutions`;
CREATE TABLE IF NOT EXISTS `constitutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

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

DROP TABLE IF EXISTS `contributions`;
CREATE TABLE IF NOT EXISTS `contributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `cost` double NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`id`, `name`, `cost`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Testing contributions', 10, 1, '2022-06-12 16:56:04', '2022-06-12 16:56:04', NULL),
(2, 'Semestral dues', 50, 1, '2022-06-20 21:44:23', '2022-06-20 21:44:23', NULL),
(3, 'test', 10, 1, '2022-06-30 18:06:45', '2022-06-30 18:06:45', NULL),
(4, 'Contribution Test', 500, 1, '2022-07-14 05:36:49', '2022-07-14 05:37:41', '2022-07-14 05:37:41'),
(5, 'Testing Contribution', 75, 1, '2022-07-14 06:11:10', '2022-07-14 06:11:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

DROP TABLE IF EXISTS `elections`;
CREATE TABLE IF NOT EXISTS `elections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `vote_start` datetime NOT NULL,
  `vote_end` datetime NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 for with party, 2 for per type of employee',
  `status` enum('Application','Voting','Finished') NOT NULL DEFAULT 'Application',
  `officer_set` tinyint(1) NOT NULL COMMENT 'has the officer set',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `electoral_positions`
--

DROP TABLE IF EXISTS `electoral_positions`;
CREATE TABLE IF NOT EXISTS `electoral_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(150) NOT NULL,
  `max_candidate` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `electoral_positions`
--

INSERT INTO `electoral_positions` (`id`, `position_name`, `max_candidate`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'President', 2, '2022-06-05 00:47:03', '2022-06-05 00:47:03', NULL),
(2, 'Vice president', 1, '2022-06-12 19:41:07', '2022-06-12 19:41:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file_sharing`
--

DROP TABLE IF EXISTS `file_sharing`;
CREATE TABLE IF NOT EXISTS `file_sharing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(150) NOT NULL,
  `size` int(25) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `uploader` int(11) NOT NULL COMMENT 'user id of the uploader',
  `category` varchar(50) NOT NULL COMMENT 'file category',
  `visibility` enum('for all','admin') NOT NULL COMMENT 'visibility of the file',
  `downloads` int(11) NOT NULL COMMENT 'Number of downloads',
  `uploaded_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `date_purchased` date NOT NULL,
  `cost` varchar(255) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `date_purchased`, `cost`, `category_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Item sample Edit', '2022-07-30', '60', 3, 1, '2022-07-14 05:43:07', '2022-07-14 05:44:08', NULL),
(2, 'Walis tingting', '2022-07-28', '75', 2, 1, '2022-07-09 20:09:32', '2022-07-09 23:23:46', NULL),
(4, 'Item sample 2', '2002-01-01', '25', 3, 1, '2022-07-14 05:43:40', '2022-07-14 05:44:17', '2022-07-14 05:44:17'),
(5, 'Stocks item', '2022-07-16', '120', 4, 1, '2022-07-14 05:45:28', '2022-07-14 05:45:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

DROP TABLE IF EXISTS `item_category`;
CREATE TABLE IF NOT EXISTS `item_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Stocks', '2022-07-14 05:44:58', '2022-07-14 05:44:58', NULL),
(2, 'Appliances', '2022-07-08 05:16:28', '2022-07-08 05:16:28', NULL),
(3, 'Supplies', '2022-07-08 05:16:44', '2022-07-08 05:16:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

DROP TABLE IF EXISTS `logins`;
CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `login_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `user_id`, `role_id`, `login_date`) VALUES
(1, 1, 1, '2022-06-05 00:36:20'),
(2, 1, 1, '2022-06-12 00:31:28'),
(3, 1, 1, '2022-06-12 16:53:45'),
(4, 1, 1, '2022-06-12 19:33:07'),
(5, 1, 1, '2022-06-16 23:31:24'),
(6, 1, 1, '2022-06-17 01:52:00'),
(7, 1, 1, '2022-06-17 01:52:48'),
(8, 3, 2, '2022-06-17 01:53:04'),
(9, 1, 1, '2022-06-17 01:54:53'),
(10, 3, 2, '2022-06-17 02:00:15'),
(11, 1, 1, '2022-06-17 02:01:24'),
(12, 1, 1, '2022-06-17 22:50:35'),
(13, 1, 1, '2022-06-17 22:55:40'),
(14, 1, 1, '2022-06-17 23:17:23'),
(15, 1, 1, '2022-06-18 15:10:16'),
(16, 1, 1, '2022-06-20 02:13:39'),
(17, 1, 1, '2022-06-20 02:40:35'),
(18, 1, 1, '2022-06-20 21:35:40'),
(19, 1, 1, '2022-06-21 12:40:56'),
(20, 1, 1, '2022-06-22 00:59:21'),
(21, 3, 2, '2022-06-22 01:07:05'),
(22, 1, 1, '2022-06-22 01:24:44'),
(23, 3, 2, '2022-06-22 01:28:43'),
(24, 1, 1, '2022-06-22 01:29:36'),
(25, 3, 2, '2022-06-22 01:45:19'),
(26, 1, 1, '2022-06-22 01:46:13'),
(27, 1, 1, '2022-06-23 02:08:52'),
(28, 1, 1, '2022-06-30 00:15:46'),
(29, 1, 1, '2022-06-30 17:21:22'),
(30, 3, 2, '2022-06-30 18:02:50'),
(31, 1, 1, '2022-06-30 18:06:18'),
(32, 3, 2, '2022-06-30 18:07:02'),
(33, 1, 1, '2022-07-01 01:02:29'),
(34, 1, 1, '2022-07-04 23:16:00'),
(35, 1, 1, '2022-07-05 00:21:27'),
(36, 1, 1, '2022-07-06 00:12:37'),
(37, 1, 1, '2022-07-06 11:30:01'),
(38, 1, 1, '2022-07-06 21:11:35'),
(39, 1, 1, '2022-07-07 14:27:58'),
(40, 1, 1, '2022-07-07 22:29:05'),
(41, 1, 1, '2022-07-08 03:45:19'),
(42, 1, 1, '2022-07-08 13:14:41'),
(43, 1, 1, '2022-07-08 19:13:20'),
(44, 1, 1, '2022-07-08 19:50:44'),
(45, 1, 1, '2022-07-08 20:01:36'),
(46, 1, 1, '2022-07-09 14:06:46'),
(47, 1, 1, '2022-07-09 14:23:43'),
(48, 1, 1, '2022-07-10 01:57:31'),
(49, 1, 1, '2022-07-10 02:41:03'),
(50, 1, 1, '2022-07-10 15:00:32'),
(51, 1, 1, '2022-07-10 15:20:06'),
(52, 1, 1, '2022-07-10 16:58:02'),
(53, 1, 1, '2022-07-10 17:03:26'),
(54, 1, 1, '2022-07-10 19:56:36'),
(55, 1, 1, '2022-07-10 21:53:30'),
(56, 1, 1, '2022-07-10 23:12:23'),
(57, 1, 1, '2022-07-10 23:32:54'),
(58, 1, 1, '2022-07-11 02:18:04'),
(59, 1, 1, '2022-07-11 03:00:20'),
(60, 10, 2, '2022-07-11 03:01:08'),
(61, 1, 1, '2022-07-11 13:34:41'),
(62, 1, 1, '2022-07-11 14:47:18'),
(63, 1, 1, '2022-07-11 21:25:07'),
(64, 1, 1, '2022-07-12 00:20:21'),
(65, 10, 2, '2022-07-12 00:36:09'),
(66, 1, 1, '2022-07-12 00:37:39'),
(67, 10, 2, '2022-07-12 03:14:33'),
(68, 10, 2, '2022-07-12 03:14:34'),
(69, 1, 1, '2022-07-12 05:33:43'),
(70, 10, 2, '2022-07-12 13:51:16'),
(71, 1, 1, '2022-07-12 13:59:09'),
(72, 10, 2, '2022-07-12 14:13:39'),
(73, 10, 2, '2022-07-12 15:35:17'),
(74, 1, 1, '2022-07-12 17:52:33'),
(75, 1, 1, '2022-07-12 18:19:04'),
(76, 1, 1, '2022-07-12 23:24:42'),
(77, 3, 2, '2022-07-13 02:50:56'),
(78, 1, 1, '2022-07-13 04:12:39'),
(79, 10, 2, '2022-07-13 04:24:01'),
(80, 1, 1, '2022-07-13 15:28:15'),
(81, 10, 2, '2022-07-13 16:50:38'),
(82, 10, 2, '2022-07-13 18:19:39'),
(83, 1, 1, '2022-07-13 18:52:19'),
(84, 10, 2, '2022-07-13 19:22:19'),
(85, 1, 1, '2022-07-13 21:22:18'),
(86, 10, 2, '2022-07-13 22:52:53'),
(87, 1, 1, '2022-07-13 22:57:30'),
(88, 10, 2, '2022-07-14 02:16:03'),
(89, 1, 1, '2022-07-14 02:16:24'),
(90, 1, 1, '2022-07-14 02:21:40'),
(91, 10, 2, '2022-07-14 04:23:08'),
(92, 1, 1, '2022-07-14 04:25:02'),
(93, 1, 1, '2022-07-14 04:58:10'),
(94, 1, 1, '2022-07-14 05:02:22'),
(95, 1, 1, '2022-07-14 05:03:50'),
(96, 13, 3, '2022-07-14 05:52:01'),
(97, 10, 2, '2022-07-14 05:52:59'),
(98, 1, 1, '2022-07-14 05:53:37'),
(99, 13, 3, '2022-07-14 06:06:50'),
(100, 10, 2, '2022-07-14 06:08:28'),
(101, 1, 1, '2022-07-14 06:10:50'),
(102, 10, 2, '2022-07-14 06:11:23'),
(103, 10, 2, '2022-07-14 15:40:39'),
(104, 1, 1, '2022-07-14 15:41:13'),
(105, 13, 3, '2022-07-14 15:44:15'),
(106, 10, 2, '2022-07-14 15:46:16'),
(107, 1, 1, '2022-07-14 15:54:08'),
(108, 1, 1, '2022-07-14 16:15:40'),
(109, 1, 1, '2022-07-14 16:33:55'),
(110, 13, 3, '2022-07-14 17:22:44'),
(111, 1, 1, '2022-07-14 17:28:30'),
(112, 10, 2, '2022-07-14 17:31:04'),
(113, 1, 1, '2022-07-15 13:05:08'),
(114, 13, 3, '2022-07-15 14:43:52'),
(115, 1, 1, '2022-07-15 16:23:24'),
(116, 10, 2, '2022-07-15 16:35:55'),
(117, 1, 1, '2022-07-15 16:36:45'),
(118, 10, 2, '2022-07-15 17:54:56'),
(119, 1, 1, '2022-07-15 18:36:08');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `author` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

DROP TABLE IF EXISTS `officers`;
CREATE TABLE IF NOT EXISTS `officers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `election_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) NOT NULL,
  `expiration_date` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `expiration_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
('bbda7bb52e0619e88a772c938e763dd2', 'joshuaconcepcion12.jc@gmail.com', '2022-07-11 03:29:15', '2022-07-11 02:59:15', '2022-07-11 02:59:15', NULL),
('23eaceac97dfa443cc4a4eeda943617e', 'jconcepcion12.jc@gmail.com', '2022-07-14 02:34:47', '2022-07-14 02:04:47', '2022-07-14 02:04:47', NULL),
('2dd63e6352e75da3a6c969d42eac16e9', 'jconcepcion12.jc@gmail.com', '2022-07-14 17:06:16', '2022-07-14 16:36:16', '2022-07-14 16:36:16', NULL),
('e215d95e0b8efd5851dc7b7c1c5124d2', 'jconcepcion12.jc@gmail.com', '2022-07-14 17:44:55', '2022-07-14 17:14:55', '2022-07-14 17:14:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `contri_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `added_by` int(11) NOT NULL COMMENT 'User that added the transaction',
  `is_approved` tinyint(1) NOT NULL COMMENT 'Is the transaction approved',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_feedbacks`
--

DROP TABLE IF EXISTS `payment_feedbacks`;
CREATE TABLE IF NOT EXISTS `payment_feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `comment` longtext NOT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `steps` longtext NOT NULL,
  `image` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `steps`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GCash', '<ol><li>Go to GCash app on your cell phone</li><li>Tap on send money</li><li>Tap \"Express Send\"</li><li>Enter mobile number \'09123123123\'</li><li>Add 200php as the amount then tap next</li><li>Tap on send</li><li>Take a screenshot of the receipt</li><li>Return <a href=\"http://feams.csovernightstaguig.online/\" target=\"_blank\">to the site</a> and login your account</li><li>A popup should appear, and upload the receipt.</li><li>Wait for the email from the site administrator when your verification is success.</li></ol>', NULL, '2021-09-01 10:26:32', '2022-07-14 06:07:41', NULL),
(2, 'Landbank', '<p><br></p>', '1657699044_4f024923d16c94802978.png', '2021-09-01 10:28:35', '2022-07-13 15:57:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_mod` varchar(10) NOT NULL,
  `desc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

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
(44, 'NEWS', 'Delete News'),
(45, 'INV', 'View inventory');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `election_id` int(11) NOT NULL,
  `elec_position_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `election_id`, `elec_position_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2022-06-05 00:47:53', '2022-06-05 00:47:53', NULL),
(3, 3, 1, '2022-07-09 15:28:03', '2022-07-09 15:28:03', NULL),
(4, 3, 2, '2022-07-09 15:28:03', '2022-07-09 15:28:03', NULL),
(5, 5, 1, '2022-07-13 04:44:14', '2022-07-13 04:44:14', NULL),
(6, 5, 2, '2022-07-13 04:44:15', '2022-07-13 04:44:15', NULL),
(7, 8, 1, '2022-07-14 03:39:45', '2022-07-14 03:39:45', NULL),
(8, 8, 2, '2022-07-14 03:39:45', '2022-07-14 03:39:45', NULL),
(9, 9, 1, '2022-07-14 05:31:35', '2022-07-14 05:31:35', NULL),
(10, 9, 2, '2022-07-14 05:31:35', '2022-07-14 05:31:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'System Administrator', '2021-08-30 09:03:32', NULL, NULL),
(2, 'Member', '2021-08-30 09:03:32', '2022-02-23 04:41:41', NULL),
(3, 'Treasurer', '2021-09-14 15:02:44', '2021-09-14 15:02:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `perm_mod` varchar(10) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `perm_mod`, `perm_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(112, 1, 'USR', 1, '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(113, 1, 'USR', 2, '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(114, 1, 'USR', 3, '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(115, 1, 'USR', 4, '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(116, 1, 'ROLE', 5, '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(117, 1, 'ROLE', 6, '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(118, 1, 'ROLE', 7, '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(119, 1, 'ROLE', 8, '2022-07-07 01:10:19', '2022-07-07 01:10:19', NULL),
(120, 1, 'PERM', 9, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(121, 1, 'PERM', 10, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(122, 1, 'ANN', 11, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(123, 1, 'ANN', 12, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(124, 1, 'ANN', 13, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(125, 1, 'ANN', 14, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(126, 1, 'SLID', 15, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(127, 1, 'SLID', 16, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(128, 1, 'SLID', 17, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(129, 1, 'SLID', 18, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(130, 1, 'ELEC', 19, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(131, 1, 'ELEC', 20, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(132, 1, 'ELEC', 21, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(133, 1, 'ELEC', 22, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(134, 1, 'POS', 23, '2022-07-07 01:10:20', '2022-07-07 01:10:20', NULL),
(135, 1, 'POS', 24, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(136, 1, 'POS', 25, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(137, 1, 'POS', 26, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(138, 1, 'CAN', 27, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(139, 1, 'CAN', 28, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(140, 1, 'CAN', 29, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(141, 1, 'CAN', 30, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(142, 1, 'FILES', 31, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(143, 1, 'FILES', 32, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(144, 1, 'FICAT', 33, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(145, 1, 'FICAT', 34, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(146, 1, 'DISC', 35, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(147, 1, 'COMM', 36, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(148, 1, 'REPO', 37, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(149, 1, 'USR', 38, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(150, 1, 'CONT', 39, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(151, 1, 'PAY', 40, '2022-07-07 01:10:21', '2022-07-07 01:10:21', NULL),
(152, 1, 'NEWS', 41, '2022-07-07 01:10:22', '2022-07-07 01:10:22', NULL),
(153, 1, 'NEWS', 42, '2022-07-07 01:10:22', '2022-07-07 01:10:22', NULL),
(154, 1, 'NEWS', 43, '2022-07-07 01:10:22', '2022-07-07 01:10:22', NULL),
(155, 1, 'NEWS', 44, '2022-07-07 01:10:22', '2022-07-07 01:10:22', NULL),
(156, 1, 'INV', 45, '2022-07-07 01:10:22', '2022-07-07 01:10:22', NULL),
(157, 4, 'USR', 1, '2022-07-14 05:08:20', '2022-07-14 05:08:20', NULL),
(158, 3, 'CONT', 39, '2022-07-15 14:51:22', '2022-07-15 14:51:22', NULL),
(159, 3, 'PAY', 40, '2022-07-15 14:51:22', '2022-07-15 14:51:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `uploader` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
CREATE TABLE IF NOT EXISTS `threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `creator` int(11) NOT NULL,
  `visibility` int(11) NOT NULL COMMENT '0 for all and other numbers will be the role',
  `link` varchar(255) NOT NULL,
  `status` char(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `proof` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `contact_number` decimal(11,0) NOT NULL,
  `email_code` varchar(10) NOT NULL,
  `role` bigint(20) NOT NULL DEFAULT '0',
  `type` enum('1','2','3','') NOT NULL COMMENT '1 for regular, 2 for part time, 3 for admin',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: unpaid\r\n1: active\r\n2: inactive\r\n3: paid\r\n4: pending email verification',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `email`, `gender`, `profile_pic`, `payment_method`, `proof`, `birthdate`, `contact_number`, `email_code`, `role`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '', 'admin', 'admin', '$2y$10$1xnbQsX2OX.Sp10pWrte9.hZ3BMiXrrBU6ZypOk2iDygwBf4UQqBS', 'puptfeams2022@gmail.com', 'Male', '1657392096_d831490d0cfffe2a6f71.jpg', NULL, '', '1999-11-03', '9195252973', '', 1, '1', 1, '2021-08-30 09:03:20', '2022-07-10 02:41:36', NULL),
(3, 'Eudes Augustine', '', 'Silerio', 'eudesaugustine', '$2y$10$CeNIwqj.vF6YJUWzUXcsiuws4Kg0Hq8nb3ENNEn26s9bdzpbEl07u', 'eudesaugustine@gmail.com', 'Male', '', 1, '1655401915_cdd807e72474df4821e3.png', '2000-08-19', '9056648595', '0V2UK', 3, '1', 1, '2022-06-17 01:50:33', '2022-07-13 16:47:42', NULL),
(10, 'Joshua', '', 'Concepcion', 'Molted', '$2y$10$sZIHMWsvK55C68HBpVmT3Op3Utb1nMCR1DVmCbVcS8Bv0n8BMT3DO', 'joshuaconcepcion12.jc@gmail.com', 'Male', '1657443265_59b8ac1eefbabf30a7e0.jpg', 1, '1657443543_5c536ee4bcc8cae49ab0.png', '2001-01-01', '9951365750', '', 2, '1', 1, '2022-07-10 16:54:25', '2022-07-14 19:18:08', NULL),
(13, 'Testing', '', 'Treasurer', 'molted', '$2y$10$MH9ecJzaYDNov/xyIAT5UuBMCOOtmMADWTNBHRuS7p63XCTH4CaxC', 'jconcepcion12.jc@gmail.com', 'Male', '1657738807_09166c2d5be9836c74f1.jpg', 4, '1657701808_39755e3739f4c74b3368.png', '2001-01-01', '9951365750', '', 3, '1', 1, '2022-07-13 16:38:30', '2022-07-14 17:22:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `election_id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `date_casted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `votes2`
--

DROP TABLE IF EXISTS `votes2`;
CREATE TABLE IF NOT EXISTS `votes2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voter_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `date_casted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes2`
--

INSERT INTO `votes2` (`id`, `voter_id`, `election_id`, `date_casted`) VALUES
(1, 1, 5, '2022-07-14 05:34:26'),
(2, 10, 5, '2022-07-14 06:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `vote_details`
--

DROP TABLE IF EXISTS `vote_details`;
CREATE TABLE IF NOT EXISTS `vote_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `votes_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vote_details2`
--

DROP TABLE IF EXISTS `vote_details2`;
CREATE TABLE IF NOT EXISTS `vote_details2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `votes_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` enum('1','2','3') DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `candidate_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vote_details2`
--

INSERT INTO `vote_details2` (`id`, `votes_id`, `user_id`, `user_type`, `position_id`, `candidate_id`) VALUES
(1, 1, NULL, NULL, 5, 0),
(2, 1, NULL, NULL, 6, 0),
(3, 2, NULL, NULL, 5, 0),
(4, 2, NULL, NULL, 6, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
