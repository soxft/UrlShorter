-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `shorter`;
CREATE TABLE `shorter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short` varchar(10) NOT NULL COMMENT '短链接',
  `url` longtext NOT NULL COMMENT '原始链接',
  `time` varchar(12) NOT NULL COMMENT '缩短时间',
  `ip` varchar(128) NOT NULL COMMENT '用户IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `short` (`short`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2021-09-13 08:05:40