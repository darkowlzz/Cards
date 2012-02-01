-- Adminer 3.3.2 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `card2`;
CREATE TABLE `card2` (
  `cardno` varchar(20) NOT NULL,
  `value` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `card2` (`cardno`, `value`) VALUES
('images/0.png',	0),
('images/1.png',	1),
('images/2.png',	2),
('images/3.png',	3),
('images/4.png',	4),
('images/5.png',	5),
('images/6.png',	6),
('images/7.png',	7),
('images/8.png',	8),
('images/9.png',	9),
('images/10.png',	10),
('images/11.png',	11),
('images/12.png',	12),
('images/13.png',	13),
('images/14.png',	14),
('images/15.png',	15),
('images/16.png',	16),
('images/17.png',	17),
('images/18.png',	18),
('images/19.png',	19),
('images/20.png',	20),
('images/21.png',	21),
('images/22.png',	22),
('images/23.png',	23),
('images/24.png',	24),
('images/25.png',	25),
('images/26.png',	26),
('images/27.png',	27),
('images/28.png',	28),
('images/29.png',	29),
('images/30.png',	30),
('images/31.png',	31),
('images/32.png',	32),
('images/33.png',	33),
('images/34.png',	34),
('images/35.png',	35),
('images/36.png',	36),
('images/37.png',	37),
('images/38.png',	38),
('images/39.png',	39),
('images/40.png',	40),
('images/41.png',	41),
('images/42.png',	42),
('images/43.png',	43),
('images/44.png',	44),
('images/45.png',	45),
('images/46.png',	46),
('images/47.png',	47),
('images/48.png',	48),
('images/49.png',	49),
('images/50.png',	50),
('images/51.png',	51);

DROP TABLE IF EXISTS `computer`;
CREATE TABLE `computer` (
  `cardno` varchar(20) NOT NULL,
  `value` int(2) NOT NULL,
  `sno` int(1) NOT NULL AUTO_INCREMENT,
  `state` int(1) NOT NULL,
  `play` int(1) NOT NULL,
  `misc` int(1) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `computer` (`cardno`, `value`, `sno`, `state`, `play`, `misc`) VALUES
('images/34.png',	34,	1,	1,	3,	1),
('images/42.png',	42,	2,	1,	4,	0),
('images/41.png',	41,	3,	1,	0,	0),
('images/28.png',	28,	4,	1,	1,	0),
('images/43.png',	43,	5,	1,	2,	0);

DROP TABLE IF EXISTS `player`;
CREATE TABLE `player` (
  `cardno` varchar(20) NOT NULL,
  `value` int(2) NOT NULL,
  `sno` int(1) NOT NULL AUTO_INCREMENT,
  `state` int(1) NOT NULL,
  `misc` int(1) NOT NULL,
  KEY `sno` (`sno`),
  CONSTRAINT `player_ibfk_1` FOREIGN KEY (`sno`) REFERENCES `computer` (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `player` (`cardno`, `value`, `sno`, `state`, `misc`) VALUES
('images/36.png',	36,	1,	1,	5),
('images/16.png',	16,	2,	1,	0),
('images/6.png',	6,	3,	1,	0),
('images/10.png',	10,	4,	1,	0),
('images/31.png',	31,	5,	1,	0);

-- 2011-08-23 22:05:29
