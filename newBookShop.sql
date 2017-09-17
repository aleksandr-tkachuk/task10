-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(255) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `author` (`author_id`, `author_name`) VALUES
(1,	'Gosha'),
(2,	'Бальзак'),
(3,	'Толстой'),
(4,	'Антонов'),
(5,	'RRR');

DROP TABLE IF EXISTS `author_book`;
CREATE TABLE `author_book` (
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  KEY `author_id` (`author_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `author_book` (`author_id`, `book_id`) VALUES
(4,	10),
(3,	0),
(1,	0),
(1,	0),
(1,	13),
(3,	13),
(3,	11),
(4,	11),
(4,	2);

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) NOT NULL,
  `book_description` tinytext,
  `book_price` float(8,2) NOT NULL,
  `book_discount_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `book` (`book_id`, `book_name`, `book_description`, `book_price`, `book_discount_id`) VALUES
(2,	'rott',	'chot in good!',	321.00,	0),
(10,	'монстры',	'2017 год',	120.00,	0),
(11,	'wwwddd',	'qazwsxedc',	123.00,	8),
(13,	'ZZZZZ',	'ssss',	123.00,	9);

DROP TABLE IF EXISTS `book_order`;
CREATE TABLE `book_order` (
  `book_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  KEY `book_id` (`book_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `book_order_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `clients_id` int(11) NOT NULL AUTO_INCREMENT,
  `clients_name` varchar(255) NOT NULL,
  `clients_email` varchar(255) NOT NULL,
  `clients_phone` int(11) NOT NULL,
  `clients_discount_id` int(11) NOT NULL,
  PRIMARY KEY (`clients_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `discount`;
CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_name` varchar(255) NOT NULL,
  `discount_tax` int(11) NOT NULL,
  `discount_type` tinyint(4) NOT NULL,
  PRIMARY KEY (`discount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `discount` (`discount_id`, `discount_name`, `discount_tax`, `discount_type`) VALUES
(8,	'magento1111',	12,	2),
(9,	'sale',	20,	1),
(10,	'уценка',	5,	2),
(11,	'просрочка',	20,	1),
(12,	'qqq',	10,	2);

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(255) NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `genre` (`genre_id`, `genre_name`) VALUES
(16,	'комедия'),
(17,	'приключение'),
(18,	'фантастика'),
(23,	'роман');

DROP TABLE IF EXISTS `genre_book`;
CREATE TABLE `genre_book` (
  `genre_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  KEY `genre_id` (`genre_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `genre_book` (`genre_id`, `book_id`) VALUES
(17,	10),
(18,	10),
(17,	13),
(17,	11),
(18,	11),
(17,	2);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_data` datetime NOT NULL,
  `order_client_id` int(11) NOT NULL,
  `order_cost` float(8,2) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '1',
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2017-09-17 17:43:09
