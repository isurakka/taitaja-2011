
/* ---------------------------------------------------------------- */
/* WARNING: THIS SCRIPT WILL REMOVE ALL AUSTRALIA DATA YOU MAY HAVE */
/* ---------------------------------------------------------------- */

/*Remove the existing database to be sure */
DROP DATABASE IF EXISTS australia;

/* Create the database */
CREATE DATABASE IF NOT EXISTS `australia` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `australia`;

/* Drop tables to be sure */
DROP TABLE IF EXISTS `admin`;
DROP TABLE IF EXISTS `newsitem`;
DROP TABLE IF EXISTS `category`;
DROP TABLE IF EXISTS `request`;

/* Create all tables and insert default data */
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`username`, `password`) VALUES
('webmaster', 'INSERT_PASSWORD_HASH_HERE');

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

INSERT INTO `category` (`categoryID`, `name`) VALUES
(1, 'Exhibitions'),
(2, 'Festivals'),
(3, 'Performing Arts'),
(4, 'Sports');

CREATE TABLE IF NOT EXISTS `newsitem` (
  `newsitemID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `text` longtext NOT NULL,
  `categoryID` int(11) NOT NULL,
  `picture` varchar(100) NOT NULL,
  PRIMARY KEY (`newsitemID`),
  FOREIGN KEY (categoryID) REFERENCES category(categoryID)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

INSERT INTO `newsitem` (`newsitemID`, `title`, `text`, `categoryID`, `picture`) VALUES
(15, 'Manufacturing technology', 'National Manufacturing Week brings together four major engineering and manufacturing events at the Sydney Convention and Exhibition Centre, from 28–31 May 2002.', 1, 'science&technology.jpg'),
(16, 'Maritime technology', 'Pacific 2002, the International Maritime and Naval Exposition for the Asia Pacific, will attract visitors from around the world to the Sydney Convention and Exhibition Centre from 29 January to 1 February 2002.', 1, 'exhibi.jpg'),
(17, 'Motor Show ', 'Start your engines and head for Australia''s largest automotive exhibition. Passenger and commercial vehicles, four-wheel drives and motorcycles are on show at the Sydney International Motor Show, October 2002. ', 1, 'gold_coast.jpg'),
(22, 'Adelaide Festival 2002', 'Continuing a 40-year tradition, the festival - held every two years - brings together many of the world''s most exciting visual and performing artists. Writers, exhibitions and free outdoor concerts all add to a heady mix. 1-10 March 2002.', 3, 'adelaidefestival.jpg'),
(23, 'Australian Dance Week', 'Australian Dance Week offers an opportunity to experience wide-ranging and culturally diverse dance performances throughout Australia. Dance Week is part of a global celebration of dance. 11-19 May 2002', 3, 'whats_on_performing_arts.jpg'),
(26, 'Mixing business and pleasure', 'Take some time out before or after attending an international exhibition to discover just how much Australia has to offer, whatever your tastes and interests.', 1, 'brisbane.jpg'),
(27, 'Online calendar', 'Every year Australia hosts a diverse range of international expos and trade shows. Our online calendar lists exhibitions by subject, so its easy to browse through upcoming events in your industry.', 1, 'melbourne.jpg'),
(28, 'Australia Day, Sydney', 'The largest single public event in the country takes place in Sydney on Australia''s national day. Tall ship and ferry boat races, military flyover and free outdoor concerts bring Sydney Harbour to life, while fireworks dominate the night sky over Darling Harbour. 26 January 2002. ', 2, 'australia_day.jpg');

CREATE TABLE IF NOT EXISTS `request` (
  `counterID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `request` longtext NOT NULL,
  PRIMARY KEY (`counterID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;