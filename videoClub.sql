-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2013 at 02:54 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.5



--
-- Database: `videoClub`
--

CREATE DATABASE `videoClub`;

USE `videoClub`;

-- --------------------------------------------------------

--
-- Table structure for table `filmTypes`
--

CREATE TABLE IF NOT EXISTS `filmTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `filmTypes`
--

INSERT INTO `filmTypes` (`id`, `name`) VALUES
(1, 'Comedy'),
(2, 'Terror'),
(3, 'Thriller'),
(4, 'Romatic'),
(5, 'Fiction');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE IF NOT EXISTS `directors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `surname1` varchar(150) NOT NULL,
  `surname2` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`id`, `name`, `surname1`, `surname2`) VALUES
(1, 'Jon', 'Favreau', ''),
(2, 'Stanley', 'Kubric', ''),
(3, 'Woody', 'Allen', ''),
(4, 'Pedro', 'Almodovar', '');

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idFilmType` int(11) NOT NULL,
  `idDirector` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` dec(6,2) NOT NULL,
  `image` varchar(150) NOT NULL,
  `inSale`  BOOLEAN NOT NULL,
  `rented`  BOOLEAN NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idFilmType` (`idFilmType`),
  KEY `idDirector` (`idDirector`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id`, `idFilmType`, `idDirector`, `name`, `price`, `image`, `inSale`, `rented`) VALUES
(1, 4, 1, 'Rudy', 2.23, 'images/filmsImages/film_01429620612.jpg', true, false),
(2, 3, 1, 'Vince Vaughn.', 3.23, 'images/filmsImages/film_01429620614.jpg', false, true),
(3, 1, 3, 'Match Point', 1.23, 'images/filmsImages/film_01453304597.jpg', false, false),
(4, 4, 3, 'Blue Jasmine', 1.23, 'images/filmsImages/film_01453550343.jpg', false, false),
(5, 1, 4, 'Talk to her', 1.23, 'images/filmsImages/film_01455182619.jpg', false, false),
(6, 2, 4, 'All About My Mother', 1.23, 'images/filmsImages/film_01453305204.jpg', true, true);


--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(9) NOT NULL,
  `name` varchar(150) NOT NULL,
  `surname1` varchar(150) NOT NULL,
  `surname2` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `dni`, `name`, `surname1`, `surname2`, `phone`, `address`, `email`) VALUES
(1, "00000000T", 'Name1', 'Surname11', 'Surname21', '933333331', 'Oxford street 1', 'r1@r.com'),
(2, "00000000T", 'Name2', 'Surname12', 'Surname22', '933333332', 'Oxford street 2', 'r2@r.com'),
(3, "00000000T", 'Name3', 'Surname13', 'Surname23', '933333333', 'Oxford street 3', 'r3@r.com'),
(4, "00000000T", 'Name4', 'Surname14', 'Surname24', '933333334', 'Oxford street 4', 'r4@r.com'),
(5, "00000000T", 'Name5', 'Surname15', 'Surname25', '933333335', 'Oxford street 5', 'r5@r.com');

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `surname1` varchar(150) NOT NULL,
  `nick` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `telephone` int(11),
  `mail` varchar(150) NOT NULL,
  `birthDate` varchar(150) NOT NULL,
  `entryDate` varchar(150) NOT NULL,
  `dropOutDate` varchar(150) NOT NULL,
  `active` boolean NOT NULL,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `name`, `surname1`, `nick`, `password`, `address`, `telephone`, `mail`, `birthDate`, `entryDate`, `dropOutDate`, `active`, `image`) VALUES
(1, 'Jhon', 'Peterson', 'user1', '123456', 'Address1', 933333333, 'r1@r.com', '1975-01-01', '2014-01-01', '0000-00-00', true, 'images/usersImages/user1.jpeg'),
(2, 'Jhon1', 'Peterson1', 'user2', '123456', 'Address2', 933333333, 'r2@r.com', '1975-01-01', '2014-01-01', '0000-00-00', true, 'images/usersImages/user2.jpeg'),
(3, 'Jhon2', 'Peterson2', 'user3', '123456', 'Address3', 933333333, 'r3@r.com', '1975-01-01', '2014-01-01', '0000-00-00', true, 'images/usersImages/user3.jpeg');



--
-- Table structure for table `renting`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idFilm` int(11) NOT NULL,
  `dateReview` date NOT NULL,
  `rate` int(2) NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idFilm` (`idFilm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;

--
-- Dumping data for table `renting`
--

INSERT INTO `review` (`id`, `idFilm`, `dateReview`,`rate`, `description`) VALUES
(1, 1, '2014-01-01',5,'desc1'),
(2, 2, '2014-01-02',4,'desc2'),
(3, 1, '2014-01-03',3,'desc3'),
(4, 3, '2014-01-04',2,'desc4');
--
-- Constraints for dumped tables
--

--
-- Constraints for table `films`
--
ALTER TABLE `films`
	ADD CONSTRAINT `FK_idFilmType` FOREIGN KEY (`idFilmType`) REFERENCES `filmTypes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_idDirector` FOREIGN KEY (`idDirector`) REFERENCES `directors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_idFilm` FOREIGN KEY (`idFilm`) REFERENCES `films` (`id`) ON DELETE CASCADE;
