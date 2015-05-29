-- CREATE DB

CREATE DATABASE DB_MASSAZE;

-- CREATE USERS TABLE

CREATE TABLE `massaze_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-email` (`email`)
) ENGINE=InnoDB;


