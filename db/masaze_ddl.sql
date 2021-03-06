-- CREATE DB

CREATE DATABASE DB_MASAZE;
USE DB_MASAZE;

-- CREATE USERS TABLE

CREATE TABLE `masaze_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-email` (`email`)
) ENGINE=InnoDB;

-- CREATE APPOINTMENTS TABLE

CREATE TABLE `masaze_appointments` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB;
