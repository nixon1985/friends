-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.5.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table somiti.appuser
CREATE TABLE IF NOT EXISTS `appuser` (
  `user_id` varchar(12) NOT NULL DEFAULT '',
  `user_name` varchar(128) DEFAULT NULL,
  `user_password` varchar(40) DEFAULT NULL,
  `user_level` varchar(10) NOT NULL DEFAULT 'ROLE_USER' COMMENT 'Admin,Developer,General',
  `login_status` tinyint(4) DEFAULT NULL COMMENT '1=login; 0=not login;',
  `is_active` int(1) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Blocked',
  `token` text DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table somiti.appuser: ~3 rows (approximately)
/*!40000 ALTER TABLE `appuser` DISABLE KEYS */;
INSERT INTO `appuser` (`user_id`, `user_name`, `user_password`, `user_level`, `login_status`, `is_active`, `token`, `modified_by`, `modified_time`, `created_by`, `created_at`) VALUES
	('1000002', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'ADMIN', NULL, 1, 'bc236146c05bc216bea93525266e3911', NULL, NULL, '1001014', '2023-04-19 10:26:09'),
	('1010', '1010', 'e10adc3949ba59abbe56e057f20f883e', 'MEMBER', NULL, 1, NULL, NULL, NULL, NULL, '2023-04-19 10:26:34'),
	('2000008', 'nixon', 'e10adc3949ba59abbe56e057f20f883e', 'ROLE_USER', NULL, 1, 'c98c613580968a3a258fb0a721461ad8', NULL, NULL, '3000042', '2023-03-27 22:05:37');
/*!40000 ALTER TABLE `appuser` ENABLE KEYS */;

-- Dumping structure for table somiti.member_info
CREATE TABLE IF NOT EXISTS `member_info` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_no` int(11) NOT NULL DEFAULT 0,
  `member_name` varchar(50) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `present_address` varchar(100) DEFAULT NULL,
  `permanent_address` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `monthly_payable` decimal(10,2) DEFAULT NULL,
  `opening_balance` decimal(10,2) DEFAULT 0.00,
  `photo_path` varchar(100) DEFAULT NULL,
  `member_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table somiti.member_info: ~10 rows (approximately)
/*!40000 ALTER TABLE `member_info` DISABLE KEYS */;
INSERT INTO `member_info` (`member_id`, `member_no`, `member_name`, `phone_no`, `email`, `present_address`, `permanent_address`, `gender`, `joining_date`, `monthly_payable`, `opening_balance`, `photo_path`, `member_type`) VALUES
	(27, 1001, 'sdfdffdsf s', '324324234', 'Male', 'DDDDD', 'RRRRRR', NULL, NULL, NULL, 0.00, '0', NULL),
	(28, 1002, 'dssdfsdf', 'sdfdfsdf', '', 'sdfsdf', 'sdfsdfsdfsdf', 'Male', NULL, NULL, 0.00, 'uploads/1002.png', NULL),
	(29, 1003, 'adasdad', '', '', '', '', 'Male', NULL, NULL, 0.00, '0', NULL),
	(30, 1004, 'sdfsfdsf', '', '', '', '', 'Male', NULL, NULL, 0.00, '0', NULL),
	(31, 1005, 'fdsfsfdsf', '', '', '', '', 'Male', NULL, NULL, 0.00, '0', NULL),
	(32, 1006, 'dsfsdfsf', '', '', '', '', 'Male', NULL, NULL, 0.00, '0', NULL),
	(33, 1007, 'sfsdf', '', '', '', '', 'Male', NULL, NULL, 0.00, '0', NULL),
	(34, 1008, '44444', '', '', '', '', 'Male', NULL, NULL, 0.00, '0', NULL),
	(35, 1009, 'wrwrwer', '', '', '', '', 'Male', NULL, NULL, 0.00, '0', NULL),
	(36, 1010, 'sdfsdf', '234234', 'ffffff@gggg.nnn', 'ddddddd99', 'RRRRRR', 'Male', NULL, 2000.00, 10000.00, 'uploads/1010.png', NULL);
/*!40000 ALTER TABLE `member_info` ENABLE KEYS */;

-- Dumping structure for table somiti.payment_collection
CREATE TABLE IF NOT EXISTS `payment_collection` (
  `collection_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `collection_date` date DEFAULT NULL,
  `payable_amount` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `pay_method` smallint(6) DEFAULT NULL,
  `ref_no` varchar(30) DEFAULT NULL,
  `added_on` timestamp NULL DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`collection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table somiti.payment_collection: ~0 rows (approximately)
/*!40000 ALTER TABLE `payment_collection` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_collection` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
