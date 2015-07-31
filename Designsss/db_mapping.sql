-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2015 at 04:42 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_mapping`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`user_id`, `username`, `password`) VALUES
(1, 'john', 'admin'),
(2, 'jj', 'kk'),
(3, 'dale', 'john');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poly`
--

CREATE TABLE IF NOT EXISTS `tbl_poly` (
  `poly_id` int(255) NOT NULL AUTO_INCREMENT,
  `vertices` varchar(50000) NOT NULL,
  `tree_id` int(255) NOT NULL,
  PRIMARY KEY (`poly_id`),
  KEY `tree_id` (`tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `tbl_poly`
--

INSERT INTO `tbl_poly` (`poly_id`, `vertices`, `tree_id`) VALUES
(53, 'wxd{@ekprVvIiOd@WhBH~@x@tMzB`GsA|IhBpK]~IoQpLmK}D}EFkL}@kLsJcToP_CiPfCqJ`GkNlyAwGUoUmG}@sFdMicA~c@ku@pM_a@v^ja@tJ|KfK`GhAhKCbGvNjRUvWy@lP{ExN_L~IuGzG{JjHcSzGoM?iIqAcJkBoHaF', 1),
(58, 'sqn{@wwtrV`SbHlPsGb\\ki@zFcHn_Agv@cA}[`SiRyD}L{O{CwLyCqRuPmPqUsSzCmPjS', 1),
(59, 'aig{@_xftV~QcPzX`@sAsVxMkSu]lT_Rg`@w_@nTvLrHvMa@cTrVlG~FeCxQ', 1),
(60, 's`|z@qlntVx`@pV`RmT?e_@x`@oFnHxJzeAmSiDuI}t@hRmZgQae@oF~c@oTeBuIv_@}LqIuWyr@nr@q\\wIgUlThDnTiE`O', 1),
(61, '_yxz@mxttVhWsVbAxJjXnFdCzKtKhC?nc@jXxJcAxKup@oFfCaOyMoIeC{O', 1),
(62, 'agxz@}t~tVrn@iC|GuAbJtOeB~MhNxCPfJ{NvI_d@`@iE}[oQ{K', 1),
(63, 'alo{@cxxtVzNcPzNiCro@nr@hXhR`e@cAfC}Zdh@qs@cByh@aRsVeC}i@dz@`]lGhCmGvXvM~MqIdPbAre@}b@re@mYdQoHvf@hi@~MqIvXiVqNmZr@ae@oFgi@iRuKka@cf@uIeLqU', 1),
(64, 'wia{@ecruV`e@iCfi@`]x`@??oTuq@mc@sIiRmqAiCfC|x@', 1),
(65, 'e}mz@kbgwVgi@kDyMqGcTcAnH{Kza@gB?{KyM?eCgC{EcHeKxCkFyJbBsHhWhD~PwJrJhDmGxJhEfJxMq@rJoF', 1),
(66, 'a|qz@ythwVpH}LqHuIpHwIuJwIjWqVsJoTcSlEqIqGyMvI_RmE{`@sGeUcApIxJhDtIbAre@gCvInHvI{NbPzs@a@bA`NiD~\\`RjDdBrHu]xJfC`Nr]dBa@dPgV~McTzZyMgCom@or@{a@jStKhRmk@`l@rJnU`R`N|b@oFtK~M{NjSeU?aRlEml@ucAvLse@vLaOvLal@y_@jD}PyYpIgQuKePll@wg@xdAlEbBcOsbAcPq[eAfC}L`e@dAhWuWhEiRiEeP~c@aOvVvQxCyCa@uW`\\iCjO_Nro@vIfUzKdU~hAq[pUhD~MsJ|La@fQ|P`Ou^gCcSa@', 1),
(68, 'gmb}@uz}uVr^mEt^iRqIc{@|b@mc@om@_hAik@se@uK_]_e@dn@`Avg@tq@j_A', 1),
(69, 'cf~|@uoavVzt@vIzEfJhNhJcA{YrJhRtKiRN|ZrS`@`JjS~L`@tFjDiMyYkOwXzNqGkXsG{O_Nr]hCtK?dCaNg`@cAkO{K_e@vXgVsVsJnFcBtWnRoFxDvIq\\vB', 1),
(71, 'w~|z@wfrrVfMsGnGO|GwBxDvBnPN|GfBr@zDsJ`NyDmEyC|EaAlE_HeByDwBQ_FbAkDgDkDmFr@gDtAgC?', 5),
(73, 'gd~z@ejsrVhNfBrJlExDxC`IzDvCOvChCoHxCmFzDwCuArAyCyDcA{EbA}FhCkFp@yDyCOyCdCqG?_F', 5),
(74, 'aya{@cmsrVsIoJkAwMjEjArEhCx@nJ', 5),
(75, 'e_a{@alsrVrJ}EkAmAeKwFwCFr@rDhEdE', 5),
(76, 'qczz@y~prVnLgCxNlIcB~EgCVeBkAkF{@qDs@eBuA}BmA', 5),
(77, 'ci{z@auqrVbAs@jO`Kd^dEeGnBaEFhD{@eB{@_CF_@nBkN}AqD}AOmAcFsD', 5),
(78, 'ikvz@c{orVdBh@fDi@cBuA', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trees`
--

CREATE TABLE IF NOT EXISTS `tbl_trees` (
  `tree_id` int(255) NOT NULL AUTO_INCREMENT,
  `tree_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_trees`
--

INSERT INTO `tbl_trees` (`tree_id`, `tree_name`, `color`) VALUES
(1, 'coconut', '#4cb549'),
(2, 'mango', '#000fff'),
(3, 'mahogany', '#fff000'),
(4, 'banana', '#808000'),
(5, 'Mangroove', '#ff8000');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_poly`
--
ALTER TABLE `tbl_poly`
  ADD CONSTRAINT `tbl_poly_ibfk_1` FOREIGN KEY (`tree_id`) REFERENCES `tbl_trees` (`tree_id`) ON DELETE CASCADE ON UPDATE CASCADE;
