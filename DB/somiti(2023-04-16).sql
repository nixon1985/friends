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

-- Dumping data for table somiti.appuser: ~2 rows (approximately)
/*!40000 ALTER TABLE `appuser` DISABLE KEYS */;
INSERT INTO `appuser` (`user_id`, `user_name`, `user_password`, `user_level`, `login_status`, `is_active`, `token`, `modified_by`, `modified_time`, `created_by`, `created_at`) VALUES
	('1000002', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'ROLE_USER', NULL, 1, 'bc236146c05bc216bea93525266e3911', NULL, NULL, '1001014', '2020-07-17 09:10:49'),
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
  `photo_path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table somiti.member_info: ~26 rows (approximately)
/*!40000 ALTER TABLE `member_info` DISABLE KEYS */;
INSERT INTO `member_info` (`member_id`, `member_no`, `member_name`, `phone_no`, `email`, `present_address`, `permanent_address`, `gender`, `joining_date`, `photo_path`) VALUES
	(27, 1001, 'sdfdffdsf s', '324324234', 'Male', 'DDDDD', 'RRRRRR', NULL, NULL, '0');
/*!40000 ALTER TABLE `member_info` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
