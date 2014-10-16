-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Out-2014 às 14:50
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
-- Estrutura da tabela `webcafe_usuarios`
--

CREATE TABLE IF NOT EXISTS `webcafe_usuarios` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `modulos` varchar(255) NOT NULL,
  `paginas` varchar(255) NOT NULL,
  `acessos` varchar(255) NOT NULL,
  `userAdd` int(11) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Extraindo dados da tabela `webcafe_usuarios`
--

INSERT INTO `webcafe_usuarios` (`idUser`, `user`, `password`, `firstName`, `lastName`, `email`, `departamento`, `modulos`, `paginas`, `acessos`, `userAdd`) VALUES
(23, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador', '', 'admin@cafecomunicacao.com.br', '', '99', '99', '99', 0),
(24, 'anndreyfrancys', '6e163bf9661fdc3e4018d2134e103840eec63fd6', 'Anndrey', 'Francys', 'anndreyfrancys@cafecomunicacao.com.br', 'Atendimento', '99', '99', '99', 23),
(25, 'karenneves', '316d155d641593d2d2e19a59f1802c32c9310791', 'Karen', 'Neves', 'karenneves@cafecomunicacao.com.br', 'Telefonia', '1', '1;2;3;4', '1;2;3;4;26;5;8;10;13;14;15;16;17;32;33', 24);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
