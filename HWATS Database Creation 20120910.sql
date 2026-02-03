-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2012 at 07:43 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hwats_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `databackup`
--

CREATE TABLE IF NOT EXISTS `databackup` (
  `Id` int(11) NOT NULL,
  `PassCode` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `databackup`
--

INSERT INTO `databackup` (`Id`, `PassCode`) VALUES
(59950, '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd');

-- --------------------------------------------------------

--
-- Table structure for table `hwaresult`
--

CREATE TABLE IF NOT EXISTS `hwaresult` (
  `HWARESULTID` int(12) NOT NULL AUTO_INCREMENT,
  `PARTICIPANTID` int(12) NOT NULL,
  `HEIGHT` varchar(10) DEFAULT NULL,
  `HEIGHTWSHOES` int(1) DEFAULT NULL,
  `WEIGHT` int(3) DEFAULT NULL,
  `WEIGHTWSHOES` int(1) DEFAULT NULL,
  `BMI` int(2) DEFAULT NULL,
  `WAIST` int(3) DEFAULT NULL,
  `A1C` varchar(6) DEFAULT NULL,
  `COMPLETEDBY` varchar(50) DEFAULT NULL,
  `DATE` date NOT NULL,
  `ITERATION` int(2) NOT NULL,
  PRIMARY KEY (`HWARESULTID`),
  KEY `PARTICIPANTID` (`PARTICIPANTID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hwaresult`
--


-- --------------------------------------------------------

--
-- Table structure for table `lsanswer`
--

CREATE TABLE IF NOT EXISTS `lsanswer` (
  `LSANSWERID` int(12) NOT NULL AUTO_INCREMENT,
  `LSANSWERDESC` varchar(250) NOT NULL,
  `LSQUESTIONID` int(12) NOT NULL,
  `INPUTTYPE` varchar(3) NOT NULL,
  PRIMARY KEY (`LSANSWERID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `lsanswer`
--

INSERT INTO `lsanswer` (`LSANSWERID`, `LSANSWERDESC`, `LSQUESTIONID`, `INPUTTYPE`) VALUES
(1, '0-1 times/day', 1, 'RAD'),
(2, '2-3 times/day', 1, 'RAD'),
(3, '4-5 times/day', 1, 'RAD'),
(4, '>6 times/day', 1, 'RAD'),
(5, '0-1 times/day', 2, 'RAD'),
(6, '2-3 times/day', 2, 'RAD'),
(7, '4-5 times/day', 2, 'RAD'),
(8, '>6 times/day', 2, 'RAD'),
(9, '0-1 times/day', 3, 'RAD'),
(10, '2-3 times/day', 3, 'RAD'),
(11, '4-5 times/day', 3, 'RAD'),
(12, '>6 times/day', 3, 'RAD'),
(13, '0-1 times/day', 4, 'RAD'),
(14, '2-3 times/day', 4, 'RAD'),
(15, '4-5 times/day', 4, 'RAD'),
(16, '>6 times/day', 4, 'RAD'),
(17, '0-1 times/day', 5, 'RAD'),
(18, '2-3 times/day', 5, 'RAD'),
(19, '4-5 times/day', 5, 'RAD'),
(20, '>6 times/day', 5, 'RAD'),
(21, '0-1 times/day', 6, 'RAD'),
(22, '2-3 times/day', 6, 'RAD'),
(23, '4-5 times/day', 6, 'RAD'),
(24, '>6 times/day', 6, 'RAD'),
(25, '0-1 times/day', 7, 'RAD'),
(26, '2-3 times/day', 7, 'RAD'),
(27, '4-5 times/day', 7, 'RAD'),
(28, '>6 times/day', 7, 'RAD'),
(29, 'Whole', 8, 'RAD'),
(30, '2%', 8, 'RAD'),
(31, '1%', 8, 'RAD'),
(32, 'Skim/Fat-Free', 8, 'RAD'),
(33, 'Soy/Lactose-free', 8, 'RAD'),
(34, 'I do not drink milk', 8, 'RAD'),
(35, '0-1 days/wk', 9, 'RAD'),
(36, '2-3 days/wk', 9, 'RAD'),
(37, '4-5 days/wk', 9, 'RAD'),
(38, '>6 days/wk', 9, 'RAD'),
(39, '0-1 days/wk', 10, 'RAD'),
(40, '2-3 days/wk', 10, 'RAD'),
(41, '4-5 days/wk', 10, 'RAD'),
(42, '>6 days/wk', 10, 'RAD'),
(43, '0-1 days/wk', 11, 'RAD'),
(44, '2-3 days/wk', 11, 'RAD'),
(45, '4-5 days/wk', 11, 'RAD'),
(46, '>6 days/wk', 11, 'RAD'),
(47, '0-1 days/wk', 12, 'RAD'),
(48, '2-3 days/wk', 12, 'RAD'),
(49, '4-5 days/wk', 12, 'RAD'),
(50, '>6 days/wk', 12, 'RAD'),
(51, '0-1 days/wk', 13, 'RAD'),
(52, '2-3 days/wk', 13, 'RAD'),
(53, '4-5 days/wk', 13, 'RAD'),
(54, '>6 days/wk', 13, 'RAD'),
(55, 'SELECT', 14, 'LIS'),
(56, 'Dummy', 14, 'CHB'),
(57, '<1 hour/day', 15, 'RAD'),
(58, '1-2 hours/day', 15, 'RAD'),
(59, '3-4 hours/day', 15, 'RAD'),
(60, '>5 hours/day', 15, 'RAD'),
(61, '<1 hour/day', 16, 'RAD'),
(62, '1-2 hours/day', 16, 'RAD'),
(63, '3-4 hours/day', 16, 'RAD'),
(64, '>5 hours/day', 16, 'RAD'),
(65, '<1 hour/day', 17, 'RAD'),
(66, '1-2 hours/day', 17, 'RAD'),
(67, '3-4 hours/day', 17, 'RAD'),
(68, '>5 hours/day', 17, 'RAD'),
(69, 'YES', 18, 'RAD'),
(70, 'NO', 18, 'RAD'),
(71, 'SELECT', 19, 'LIS'),
(72, 'YES', 20, 'RAD'),
(73, 'NO', 20, 'RAD'),
(74, 'MAYBE', 20, 'RAD'),
(75, 'TEXTAREA', 21, 'TXA'),
(77, 'YES', 22, 'RAD'),
(78, 'NO', 22, 'RAD'),
(79, 'YES', 23, 'RAD'),
(80, 'NO', 23, 'RAD'),
(81, 'YES', 24, 'RAD'),
(82, 'NO', 24, 'RAD'),
(83, 'YES', 25, 'RAD'),
(84, 'NO', 25, 'RAD'),
(85, 'YES', 26, 'RAD'),
(86, 'NO', 26, 'RAD'),
(87, 'YES', 27, 'RAD'),
(88, 'NO', 27, 'RAD'),
(89, 'YES', 28, 'RAD'),
(90, 'NO', 28, 'RAD'),
(91, 'YES', 29, 'RAD'),
(92, 'NO', 29, 'RAD'),
(93, 'YES', 30, 'RAD'),
(94, 'NO', 30, 'RAD'),
(95, 'YES', 31, 'RAD'),
(96, 'NO', 31, 'RAD'),
(97, 'YES', 32, 'RAD'),
(98, 'NO', 32, 'RAD'),
(99, 'YES', 33, 'RAD'),
(100, 'NO', 33, 'RAD');

-- --------------------------------------------------------

--
-- Table structure for table `lscategory`
--

CREATE TABLE IF NOT EXISTS `lscategory` (
  `LSCATEGORYID` int(12) NOT NULL AUTO_INCREMENT,
  `LSCATEGORYDESC` varchar(250) NOT NULL,
  `SUBTEXT` varchar(250) NOT NULL,
  PRIMARY KEY (`LSCATEGORYID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `lscategory`
--

INSERT INTO `lscategory` (`LSCATEGORYID`, `LSCATEGORYDESC`, `SUBTEXT`) VALUES
(1, 'Food Choices', 'how many times per day do you:'),
(2, 'Beverage Choices', 'how many times per day do you:'),
(3, 'Meal Patterns', 'how many days per week do you:'),
(4, 'Physical Activity', 'how many days per week do you:'),
(5, 'Sedentary time', 'how many hours per day:'),
(6, 'Tobacco Use', ''),
(7, 'Readiness for change', ''),
(8, 'Motivation', 'What plan of action/actions would work best for you and/or your family?');

-- --------------------------------------------------------

--
-- Table structure for table `lsquestion`
--

CREATE TABLE IF NOT EXISTS `lsquestion` (
  `LSQUESTIONID` int(12) NOT NULL AUTO_INCREMENT,
  `LSQUESTIONDESC` varchar(250) NOT NULL,
  `LSCATEGORYID` int(12) NOT NULL,
  PRIMARY KEY (`LSQUESTIONID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `lsquestion`
--

INSERT INTO `lsquestion` (`LSQUESTIONID`, `LSQUESTIONDESC`, `LSCATEGORYID`) VALUES
(1, 'Eat vegetables (excluding French fries)?', 1),
(2, 'Eat fruit (excluding fruit juice)?', 1),
(3, 'Eat fried foods?', 1),
(4, 'Eat sweet and/or salty snacks?', 1),
(5, 'Drink regular soda/sugar beverages?', 2),
(6, 'Drink alchohol?', 2),
(7, 'Drink water?', 2),
(8, 'Type of milk you drink?', 2),
(9, 'Eat breakfast?', 3),
(10, 'Eat meals at a table?', 3),
(11, 'Eat meals away from home?', 3),
(12, 'Skip meals?', 3),
(13, 'Participate in physical activity (walk, ride bike, sports, exercise equipment/facility, etc.) for a combined total of 30 minutes or more?', 4),
(14, 'What type of physical activity?', 4),
(15, 'Watch television?', 5),
(16, 'Use the computer?', 5),
(17, 'Play video games?', 5),
(18, 'Do you smoke or use tobacco products?', 6),
(19, 'Form of tobacco:', 6),
(20, 'Are you ready to try something new for a healthier lifestyle?', 7),
(21, 'What would make you decide to do something about your health and/or weight?', 7),
(22, 'Increase physical activity', 8),
(23, 'Set aside time for excercise', 8),
(24, 'Drink more water', 8),
(25, 'Stop smoking/using tobacco', 8),
(26, 'Reduce time watching television', 8),
(27, 'Reduce computer/video game time', 8),
(28, 'Watch and control portion sizes', 8),
(29, 'Reduce portions of junk foods', 8),
(30, 'Increase fruit and vegetable intake', 8),
(31, 'Eat away from home less often', 8),
(32, 'Drink less soda/sugar beverages', 8),
(33, 'Limit sweets and/or salty foods', 8);

-- --------------------------------------------------------

--
-- Table structure for table `lsresult`
--

CREATE TABLE IF NOT EXISTS `lsresult` (
  `LSRESULTID` int(12) NOT NULL AUTO_INCREMENT,
  `PARTICIPANTID` int(12) NOT NULL,
  `LSQUESTIONID` int(12) NOT NULL,
  `LSCOMMENT` varchar(250) DEFAULT NULL,
  `LSANSWERID` int(12) NOT NULL,
  `LSCATEGORYID` int(12) NOT NULL,
  `ITERATION` int(12) NOT NULL,
  `LSDATE` date NOT NULL,
  PRIMARY KEY (`LSRESULTID`),
  KEY `PARTICIPANTID` (`PARTICIPANTID`),
  KEY `LSQUESTIONID` (`LSQUESTIONID`),
  KEY `LSANSWERID` (`LSANSWERID`),
  KEY `LSCATEGORYID` (`LSCATEGORYID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lsresult`
--


-- --------------------------------------------------------

--
-- Table structure for table `paquestion`
--

CREATE TABLE IF NOT EXISTS `paquestion` (
  `PAQUESTIONID` int(12) NOT NULL AUTO_INCREMENT,
  `PAQUESTIONDESC` varchar(750) NOT NULL,
  PRIMARY KEY (`PAQUESTIONID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `paquestion`
--

INSERT INTO `paquestion` (`PAQUESTIONID`, `PAQUESTIONDESC`) VALUES
(1, 'I understand that I am volunteering to participate in this assesment.'),
(2, 'I understand that today I will:\r\n	      a. Be assessed for my personal risk factors for diabetes and weight management. \r\n	      b. Receive education tailored to the risk identified in my personal assessment.'),
(3, 'I understand that I will become part of a project where I will continue to receive information and communications from the HWA program designed to help me improve my health status. I will be available for communications with the HWA program.'),
(4, 'I understand that all services <u>today</u> will be free of charge and I will receive advance notice as to whether the future services related to this project are free of charge, or if there will be fees/charges.'),
(5, 'I understand the HWA program will make every effort to assist me if I do not have an ability to pay for services that have associated fees.'),
(6, 'I understand that at any time I can stop my participation in the project. I must verbally inform any member of the HWA program.'),
(7, 'I waive and release, and forever discharge WCHD, MCHA, CHWC, and the HWA volunteers and coaches against any and all responsibility or liability in connection with the HWA program.'),
(8, 'I understand follow up with a physician may be recommended based on the results of the HWA assessment. I further understand any follow up medical examinations or further testing for risk factors identified as a result of my participation are my responsibility. This HWA is not meant to be or replace medical care or advice.'),
(9, 'I understand that my private information will not be released to anyone without my advance consent.'),
(10, 'I understand that as part of the HWA program, I may be encouraged to participate in exercise activities. I do hereby further acknowledge that:\r\n	 a. I have either had physical exam and/or have been given a physician''s permission to participate in activity and/or use of exercise equipment.\r\n	 b. Or, I have decided to participate in activity and/or use of exercise equipment without the approval of my physician.\r\nI do hereby assume all responsibility and risks of injury or death from participation in such activity.');

-- --------------------------------------------------------

--
-- Table structure for table `paresult`
--

CREATE TABLE IF NOT EXISTS `paresult` (
  `PARESULTID` int(12) NOT NULL AUTO_INCREMENT,
  `PAQUESTIONID` int(12) NOT NULL,
  `PARTICIPANTID` int(12) NOT NULL,
  `ANSWER` varchar(250) NOT NULL,
  `ACCEPTDATE` date DEFAULT NULL,
  PRIMARY KEY (`PARESULTID`),
  KEY `PAQUESTIONID` (`PAQUESTIONID`),
  KEY `PARTICIPANTID` (`PARTICIPANTID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `paresult`
--


-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `PARTICIPANTID` int(12) NOT NULL AUTO_INCREMENT,
  `FIRSTNAME` varchar(50) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `ADDRESS` varchar(50) NOT NULL,
  `CITY` varchar(50) NOT NULL,
  `ZIPCODE` int(5) NOT NULL,
  `STATEID` varchar(2) NOT NULL,
  `RACEID` int(12) NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `HOME` varchar(14) DEFAULT NULL,
  `WORK` varchar(14) DEFAULT NULL,
  `CELL` varchar(14) DEFAULT NULL,
  `PAFORMPRINTDATE` date DEFAULT NULL,
  `HAVEPHYSICIAN` int(1) NOT NULL DEFAULT '0',
  `DIABETIC` int(1) NOT NULL DEFAULT '0',
  `IFDIABETIC` int(1) DEFAULT NULL,
  `DIABETESEEDUCATION` int(1) NOT NULL DEFAULT '0',
  `DIABETESMED` int(1) NOT NULL DEFAULT '0',
  `THYROIDMED` int(1) NOT NULL DEFAULT '0',
  `ASTHMABREATHINGMED` int(1) NOT NULL DEFAULT '0',
  `MOODMED` int(1) NOT NULL DEFAULT '0',
  `PAINMED` int(1) NOT NULL DEFAULT '0',
  `ITERATION` int(12) NOT NULL DEFAULT '1',
  PRIMARY KEY (`PARTICIPANTID`),
  KEY `STATEID` (`STATEID`),
  KEY `RACEID` (`RACEID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `participant`
--


-- --------------------------------------------------------

--
-- Table structure for table `physicalactivitylookup`
--

CREATE TABLE IF NOT EXISTS `physicalactivitylookup` (
  `PHYSICALID` int(12) NOT NULL AUTO_INCREMENT,
  `PHYSICALDESC` varchar(75) NOT NULL,
  PRIMARY KEY (`PHYSICALID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `physicalactivitylookup`
--

INSERT INTO `physicalactivitylookup` (`PHYSICALID`, `PHYSICALDESC`) VALUES
(1, 'Select'),
(2, 'Walking'),
(3, 'Jogging/Running'),
(4, 'Bicycling'),
(5, 'Sports'),
(6, 'Exercise Equipment'),
(7, 'I am unable to be active due to physical limitations');

-- --------------------------------------------------------

--
-- Table structure for table `racelookup`
--

CREATE TABLE IF NOT EXISTS `racelookup` (
  `RACEID` int(12) NOT NULL AUTO_INCREMENT,
  `RACEDESC` varchar(50) NOT NULL,
  PRIMARY KEY (`RACEID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `racelookup`
--

INSERT INTO `racelookup` (`RACEID`, `RACEDESC`) VALUES
(1, 'Decline to identify'),
(2, 'Asian/Pacific Islander'),
(3, 'Middle Eastern'),
(4, 'Hispanic'),
(5, 'Indian/Native American'),
(6, 'Black/African American'),
(7, 'White/Caucasian'),
(8, 'Select');

-- --------------------------------------------------------

--
-- Table structure for table `statelookup`
--

CREATE TABLE IF NOT EXISTS `statelookup` (
  `STATEID` varchar(2) NOT NULL,
  `STATEDESC` varchar(50) NOT NULL,
  PRIMARY KEY (`STATEID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statelookup`
--

INSERT INTO `statelookup` (`STATEID`, `STATEDESC`) VALUES
('AK', 'Alaska'),
('AL', 'Alabama'),
('AR', 'Arkansas'),
('AZ', 'Arizona'),
('CA', 'California'),
('CO', 'Colorado'),
('CT', 'Connecticut'),
('DE', 'Delaware'),
('FL', 'Florida'),
('GA', 'Georgia'),
('HI', 'Hawaii'),
('IA', 'Iowa'),
('ID', 'Idaho'),
('IL', 'Illinois'),
('IN', 'Indiana'),
('KS', 'Kansas'),
('KY', 'Kentucky'),
('LA', 'Louisiana'),
('MA', 'Massachusetts'),
('MD', 'Maryland'),
('ME', 'Maine'),
('MI', 'Michigan'),
('MN', 'Minnesota'),
('MO', 'Missouri'),
('MS', 'Mississippi'),
('MT', 'Montana'),
('NC', 'North Carolina'),
('ND', 'North Dakota'),
('NE', 'Nebraska'),
('NH', 'New Hampshire'),
('NJ', 'New Jersey'),
('NM', 'New Mexico'),
('NV', 'Nevada'),
('NY', 'New York'),
('OH', 'Ohio'),
('OK', 'Oklahoma'),
('OR', 'Oregon'),
('PA', 'Pennsylvania'),
('RI', 'Rhode Island'),
('SC', 'South Carolina'),
('SD', 'South Dakota'),
('TN', 'Tennessee'),
('TX', 'Texas'),
('UT', 'Utah'),
('VA', 'Virginia'),
('VT', 'Vermont'),
('WA', 'Washington'),
('WI', 'Wisconsin'),
('WV', 'West Virginia'),
('WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `tobaccolookup`
--

CREATE TABLE IF NOT EXISTS `tobaccolookup` (
  `TOBACCOID` int(11) NOT NULL AUTO_INCREMENT,
  `TOBACCODESC` varchar(50) NOT NULL,
  PRIMARY KEY (`TOBACCOID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tobaccolookup`
--

INSERT INTO `tobaccolookup` (`TOBACCOID`, `TOBACCODESC`) VALUES
(5, 'Pipe'),
(2, 'Cigarettes'),
(3, 'Chewing/Smokeless'),
(4, 'Cigars'),
(1, 'Select');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `USERID` int(12) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  PRIMARY KEY (`USERID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USERID`, `USERNAME`, `PASSWORD`) VALUES
(1, 'admin', '274d4eb1c04d611b82ed52536087ab41');

-- --------------------------------------------------------

--
-- Table structure for table `wdbanswer`
--

CREATE TABLE IF NOT EXISTS `wdbanswer` (
  `WDBANSWERID` int(12) NOT NULL AUTO_INCREMENT,
  `WDBANSWERDESC` varchar(250) NOT NULL,
  `INPUTTYPE` varchar(3) NOT NULL,
  PRIMARY KEY (`WDBANSWERID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `wdbanswer`
--

INSERT INTO `wdbanswer` (`WDBANSWERID`, `WDBANSWERDESC`, `INPUTTYPE`) VALUES
(1, 'Not At All', 'RAD'),
(2, 'Slightly', 'RAD'),
(3, 'Moderately', 'RAD'),
(4, 'Very', 'RAD'),
(5, 'Extreme', 'RAD');

-- --------------------------------------------------------

--
-- Table structure for table `wdbquestions`
--

CREATE TABLE IF NOT EXISTS `wdbquestions` (
  `WDBQUESTIONID` int(12) NOT NULL AUTO_INCREMENT,
  `WDBQUESTIONDESC` varchar(250) NOT NULL,
  PRIMARY KEY (`WDBQUESTIONID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `wdbquestions`
--

INSERT INTO `wdbquestions` (`WDBQUESTIONID`, `WDBQUESTIONDESC`) VALUES
(1, 'The exercises needed for me to lose weight would be drudgery.'),
(2, 'I would feel more optimistic if I lose weight.'),
(3, 'I would be less productive.'),
(4, 'I would feel sexier if I lose weight.'),
(5, 'In order to lose weight I would be forced to eat less appetizing foods.'),
(6, 'My self-respect would be greater if I lose weight.'),
(7, 'My dieting could make meal planning more difficult for my family or housemates.'),
(8, 'My family would be proud of me if I lose weight.'),
(9, 'I would not be able to eat some of my favorite foods if I were trying to lose weight.'),
(10, 'I would be less self-conscious if I lose weight.'),
(11, 'Dieting would take the pleasure out of meals.'),
(12, 'Others would have more respect for me if I lose weight.'),
(13, 'I would have to cut down on some of my favorite activities if I try to lose weight.'),
(14, 'I could wear more attractive clothing if I lost weight.'),
(15, 'I would have to avoid some of my favorite places if I were trying to lose weight.'),
(16, 'My health would improve if I lost weight.'),
(17, 'Trying to lose weight could end up being expensive when everything is taken into account.'),
(18, 'I would feel more energetic if I lost weight.'),
(19, 'I would have to cut down on my favorite snacks if I were dieting.'),
(20, 'I would be able to accomplish more if I carried fewer pounds.');

-- --------------------------------------------------------

--
-- Table structure for table `wdbresults`
--

CREATE TABLE IF NOT EXISTS `wdbresults` (
  `WDBRESULTID` int(12) NOT NULL AUTO_INCREMENT,
  `WDBANSWERID` int(12) NOT NULL,
  `WDBQUESTIONID` int(12) NOT NULL,
  `PARTICIPANTID` int(12) NOT NULL,
  PRIMARY KEY (`WDBRESULTID`),
  KEY `WDBANSWERID` (`WDBANSWERID`),
  KEY `WDBQUESTIONID` (`WDBQUESTIONID`),
  KEY `PARTICIPANTID` (`PARTICIPANTID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wdbresults`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `lsresult`
--
ALTER TABLE `lsresult`
  ADD CONSTRAINT `lsresult_ibfk_1` FOREIGN KEY (`PARTICIPANTID`) REFERENCES `participant` (`PARTICIPANTID`),
  ADD CONSTRAINT `lsresult_ibfk_2` FOREIGN KEY (`LSQUESTIONID`) REFERENCES `lsquestion` (`LSQUESTIONID`),
  ADD CONSTRAINT `lsresult_ibfk_3` FOREIGN KEY (`LSANSWERID`) REFERENCES `lsanswer` (`LSANSWERID`),
  ADD CONSTRAINT `lsresult_ibfk_4` FOREIGN KEY (`LSCATEGORYID`) REFERENCES `lscategory` (`LSCATEGORYID`);

--
-- Constraints for table `paresult`
--
ALTER TABLE `paresult`
  ADD CONSTRAINT `paresult_ibfk_1` FOREIGN KEY (`PAQUESTIONID`) REFERENCES `paquestion` (`PAQUESTIONID`),
  ADD CONSTRAINT `paresult_ibfk_2` FOREIGN KEY (`PARTICIPANTID`) REFERENCES `participant` (`PARTICIPANTID`);

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`RACEID`) REFERENCES `racelookup` (`RACEID`),
  ADD CONSTRAINT `participant_ibfk_3` FOREIGN KEY (`STATEID`) REFERENCES `statelookup` (`STATEID`);

--
-- Constraints for table `wdbresults`
--
ALTER TABLE `wdbresults`
  ADD CONSTRAINT `wdbresults_ibfk_1` FOREIGN KEY (`WDBANSWERID`) REFERENCES `wdbanswer` (`WDBANSWERID`),
  ADD CONSTRAINT `wdbresults_ibfk_2` FOREIGN KEY (`PARTICIPANTID`) REFERENCES `participant` (`PARTICIPANTID`),
  ADD CONSTRAINT `wdbresults_ibfk_3` FOREIGN KEY (`WDBQUESTIONID`) REFERENCES `wdbquestions` (`WDBQUESTIONID`);
