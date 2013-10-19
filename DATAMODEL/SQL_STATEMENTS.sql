SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `HM_ORMO` ;
CREATE SCHEMA IF NOT EXISTS `HM_ORMO` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci ;
USE `HM_ORMO` ;

-- -----------------------------------------------------
-- Table `HM_ORMO`.`CLUB`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `HM_ORMO`.`CLUB` ;

CREATE TABLE IF NOT EXISTS `HM_ORMO`.`CLUB` (
  `cid` INT NOT NULL AUTO_INCREMENT,
  `cname` VARCHAR(64) NOT NULL,
  `foundation` DATE NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE INDEX `cname_UNIQUE` (`cname` ASC))
ENGINE = InnoDB
COMMENT = 'Basic informations of football clubs';


-- -----------------------------------------------------
-- Table `HM_ORMO`.`PLAYER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `HM_ORMO`.`PLAYER` ;

CREATE TABLE IF NOT EXISTS `HM_ORMO`.`PLAYER` (
  `pid` INT NOT NULL AUTO_INCREMENT,
  `pname` VARCHAR(64) NOT NULL,
  `age` INT NOT NULL,
  `nationality` VARCHAR(64) NOT NULL,
  `club` INT NOT NULL,
  PRIMARY KEY (`pid`),
  INDEX `pname_IDX` (`pname` ASC),
  INDEX `FK_player_club_IDX` (`club` ASC),
  CONSTRAINT `FK_player_club`
    FOREIGN KEY (`club`)
    REFERENCES `HM_ORMO`.`CLUB` (`cid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Basic informations of football players';


-- -----------------------------------------------------
-- Table `HM_ORMO`.`TRANSFER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `HM_ORMO`.`TRANSFER` ;

CREATE TABLE IF NOT EXISTS `HM_ORMO`.`TRANSFER` (
  `tid` INT NOT NULL AUTO_INCREMENT,
  `tdate` DATE NOT NULL,
  `amount` INT NOT NULL,
  `player` INT NOT NULL,
  `fromclub` INT NOT NULL,
  `toclub` INT NOT NULL,
  PRIMARY KEY (`tid`),
  INDEX `date_IDX` (`tdate` ASC),
  INDEX `FK_transfer_player_IDX` (`player` ASC),
  INDEX `FK_transfer_fromclub_idx` (`fromclub` ASC),
  INDEX `FK_transfer_toclub_idx` (`toclub` ASC),
  CONSTRAINT `FK_transfer_player`
    FOREIGN KEY (`player`)
    REFERENCES `HM_ORMO`.`PLAYER` (`pid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_transfer_fromclub`
    FOREIGN KEY (`fromclub`)
    REFERENCES `HM_ORMO`.`CLUB` (`cid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_transfer_toclub`
    FOREIGN KEY (`toclub`)
    REFERENCES `HM_ORMO`.`CLUB` (`cid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Basic informations of football player transfers';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `HM_ORMO`.`CLUB`
-- -----------------------------------------------------
START TRANSACTION;
USE `HM_ORMO`;
INSERT INTO `HM_ORMO`.`CLUB` (`cid`, `cname`, `foundation`) VALUES (1, 'Juventus', '1897-11-01');
INSERT INTO `HM_ORMO`.`CLUB` (`cid`, `cname`, `foundation`) VALUES (2, 'Manchester United', '1878-01-01');
INSERT INTO `HM_ORMO`.`CLUB` (`cid`, `cname`, `foundation`) VALUES (3, 'Bayern München', '1900-02-27');

COMMIT;


-- -----------------------------------------------------
-- Data for table `HM_ORMO`.`PLAYER`
-- -----------------------------------------------------
START TRANSACTION;
USE `HM_ORMO`;
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (1, 'Gianluigi Buffon', 35, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (2, 'Marco Storari', 36, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (3, 'Rubinho', 31, 'Brazília', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (4, 'Marco Motta', 27, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (5, 'Stephan Lichtsteiner', 29, 'Svájc', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (6, 'Federico Peluso', 29, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (7, 'Martin Caceres', 26, 'Uruguay', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (8, 'Paolo De Ceglie', 27, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (9, 'Andrea Barzagli', 32, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (10, 'Leonardo Bonucci', 26, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (11, 'Angelo Ogbonna', 25, 'Nigéria', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (12, 'Giorgio Chiellini', 29, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (13, 'Simone Pepe', 30, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (14, 'Mauricio Isla', 25, 'Chilei Köztársaság', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (15, 'Kwadwo Asamoah', 24, 'Ghána', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (16, 'Ouasim Bouy', 20, 'Hollandia', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (17, 'Simone Padoin', 29, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (18, 'Andrea Pirlo', 34, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (19, 'Arturo Vidal', 26, 'Chilei Köztársaság', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (20, 'Paul Pogba', 20, 'Franciaország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (21, 'Claudio Marchisio', 27, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (22, 'Fabio Quagliarella', 30, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (23, 'Fernando Llorente', 28, 'Spanyolország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (24, 'Sebastian Giovinco', 26, 'Olaszország', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (25, 'Carlos Tevez', 29, 'Argentína', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (26, 'Mirko Vucinic', 30, 'Montenegró', 1);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (27, 'Manuel Neuer', 27, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (28, 'Dante', 30, 'Brazília', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (29, 'Daniel van Buyten', 35, 'Belgium', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (30, 'Thiago Alcántara', 22, 'Spanyolország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (31, 'Franck Ribéry', 30, 'Franciaország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (32, 'Javi Martínez', 25, 'Spanyolország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (33, 'Mario Mandžukić', 27, 'Horvátország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (34, 'Arjen Robben', 29, 'Hollandia', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (35, 'Rafinha', 28, 'Brazília', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (36, 'Claudio Pizarro', 35, 'Peru', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (37, 'Jan Kirchhoff', 23, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (38, 'Jérôme Boateng', 28, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (39, 'Mario Götze', 21, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (40, 'Patrick Weihrauch', 19, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (41, 'Philipp Lahm', 30, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (42, 'Tom Starke', 24, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (43, 'Mitchell Weiser', 19, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (44, 'Thomas Müller', 24, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (45, 'Diego Contento', 23, 'Olaszország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (46, 'David Alaba', 21, 'Ausztria', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (47, 'Holger Badstuber', 24, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (48, 'Bastian Schweinsteiger', 29, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (49, 'Lukas Raeder', 20, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (50, 'Pierre-Emile Højbjerg', 18, 'Dánia', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (51, 'Toni Kroos', 23, 'Németország', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (52, 'Xherdan Shaqiri', 22, 'Svájc', 3);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (53, 'David De Gea', 23, 'Spanyolország', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (54, 'Rafael', 23, 'Brazília', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (55, 'Patrice Evra', 32, 'Franciaország', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (56, 'Phil Jones', 21, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (57, 'Rio Ferdinand', 35, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (58, 'Jonny Evans', 25, 'Észak-Írország', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (59, 'Anderson', 25, 'Brazília', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (60, 'Wayne Rooney', 28, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (61, 'Ryan Giggs', 40, 'Wales', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (62, 'Chris Smalling', 24, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (63, 'Anders Lindegaard', 29, 'Dánia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (64, 'Javier Hernández', 25, 'Mexikó', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (65, 'Nemanja Vidić', 32, 'Szerbia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (66, 'Michael Carrick', 32, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (67, 'Nani', 27, 'Portugália', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (68, 'Ashley Young', 28, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (69, 'Danny Welbeck', 23, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (70, 'Robin van Persie', 30, 'Hollandia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (71, 'Fábio', 23, 'Brazília', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (72, 'Tom Cleverley', 24, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (73, 'Darren Fletcher', 29, 'Skócia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (74, 'Luis Antonio Valencia', 28, 'Ekvádor', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (75, 'Shinji Kagawa', 24, 'Japán', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (76, 'Federico Macheda', 22, 'Olaszország', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (77, 'Alexander Büttner', 24, 'Hollandia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (78, 'Wilfried Zaha', 21, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (79, 'Guillermo Varela', 20, 'Uruguay', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (80, 'Marouane Fellaini', 26, 'Belgium', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (81, 'Larnell Cole', 20, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (82, 'Jesse Lingard', 21, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (83, 'Michael Keane', 20, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (84, 'Tom Thorpe', 20, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (85, 'Ben Amos', 23, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (86, 'Tyler Blackett', 19, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (87, 'Adnan Januzaj', 18, 'Belgium', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (88, 'Will Keane', 20, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (89, 'Sam Johnstone', 20, 'Anglia', 2);
INSERT INTO `HM_ORMO`.`PLAYER` (`pid`, `pname`, `age`, `nationality`, `club`) VALUES (90, 'Jonathan Sutherland', 19, 'Anglia', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `HM_ORMO`.`TRANSFER`
-- -----------------------------------------------------
START TRANSACTION;
USE `HM_ORMO`;
INSERT INTO `HM_ORMO`.`TRANSFER` (`tid`, `tdate`, `amount`, `player`, `fromclub`, `toclub`) VALUES (1, '2012-07-25', 15000000, 25, 3, 1);
INSERT INTO `HM_ORMO`.`TRANSFER` (`tid`, `tdate`, `amount`, `player`, `fromclub`, `toclub`) VALUES (2, '2011-08-15', 12000000, 25, 2, 3);
INSERT INTO `HM_ORMO`.`TRANSFER` (`tid`, `tdate`, `amount`, `player`, `fromclub`, `toclub`) VALUES (3, '2007-02-17', 6000000, 39, 1, 2);
INSERT INTO `HM_ORMO`.`TRANSFER` (`tid`, `tdate`, `amount`, `player`, `fromclub`, `toclub`) VALUES (4, '2009-08-30', 900000, 58, 3, 2);
INSERT INTO `HM_ORMO`.`TRANSFER` (`tid`, `tdate`, `amount`, `player`, `fromclub`, `toclub`) VALUES (5, '2010-01-23', 14000000, 78, 1, 2);

COMMIT;