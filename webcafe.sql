-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06-Out-2014 às 20:14
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webcafe`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `webcafe_modtelefonia_linhas`
--

CREATE TABLE IF NOT EXISTS `webcafe_modtelefonia_linhas` (
  `idLinha` int(11) NOT NULL AUTO_INCREMENT,
  `numLinha` varchar(25) NOT NULL,
  `plano` varchar(40) NOT NULL,
  `iccid` varchar(50) NOT NULL,
  `idLinhaStatus` int(11) NOT NULL,
  `operadora` int(11) NOT NULL,
  `observacoes` text NOT NULL,
  `dataCadastro` varchar(40) NOT NULL,
  `dataAlteracao` varchar(40) NOT NULL,
  `userAdd` int(11) NOT NULL,
  `userLastChange` int(11) NOT NULL,
  PRIMARY KEY (`idLinha`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Extraindo dados da tabela `webcafe_modtelefonia_linhas`
--

INSERT INTO `webcafe_modtelefonia_linhas` (`idLinha`, `numLinha`, `plano`, `iccid`, `idLinhaStatus`, `operadora`, `observacoes`, `dataCadastro`, `dataAlteracao`, `userAdd`, `userLastChange`) VALUES
(1, '(11) 9.7508-7542', '100 Minutos', '', 0, 0, '', '', '', 0, 0),
(2, '(11) 9.8548-5241', '500 minutos', '', 0, 0, '', '', '', 0, 0),
(3, '111111111111', '100 minutos', '', 0, 0, '', '', '', 0, 0),
(4, '222222222222', '200 minutos', '', 0, 0, '', '', '', 0, 0),
(5, '99999999999', '999999999999', '', 0, 0, '', '', '', 0, 0),
(6, '888888888888', '88888888888', '', 0, 0, '', '', '', 0, 0),
(7, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(8, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(9, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(10, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(11, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(12, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(13, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(14, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(15, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(16, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(17, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(18, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(19, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(20, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(21, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(22, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(23, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(24, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(25, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(26, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(27, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(28, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(29, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(30, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(31, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(32, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(33, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(34, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(35, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(36, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(37, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(38, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(39, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(40, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(41, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(42, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(43, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(44, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(45, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(46, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(47, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0),
(48, '123123123', '123123123123', '', 0, 0, '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `webcafe_usuarios`
--

CREATE TABLE IF NOT EXISTS `webcafe_usuarios` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `webcafe_usuarios`
--

INSERT INTO `webcafe_usuarios` (`idUser`, `user`, `password`, `firstName`, `lastName`) VALUES
(1, 'luis.abeno', 'faea5242a00c52da62a0f00df168c199b7ab748d', 'Luis', 'Abeno');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
