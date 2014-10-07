-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07-Out-2014 às 16:55
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
  `linhaStatus` varchar(15) NOT NULL,
  `operadora` varchar(15) NOT NULL,
  `observacoes` text NOT NULL,
  `dataCadastro` varchar(40) NOT NULL,
  `dataAlteracao` varchar(40) NOT NULL,
  `userAdd` int(11) NOT NULL,
  `userLastChange` int(11) NOT NULL,
  PRIMARY KEY (`idLinha`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `webcafe_modtelefonia_linhas`
--

INSERT INTO `webcafe_modtelefonia_linhas` (`idLinha`, `numLinha`, `plano`, `iccid`, `linhaStatus`, `operadora`, `observacoes`, `dataCadastro`, `dataAlteracao`, `userAdd`, `userLastChange`) VALUES
(1, '(11) 9.7508-7542', '500 minutos', '123456789', 'Parado', 'TIM', 'Nenhuma observaÃ§Ã£o', '07/10/2014 16:48', '07/10/2014 16:50', 1, 1),
(2, '(11) 3655-0015', 'Plano local', '789456321', 'Parado', 'OI', 'Chip cortado', '07/10/2014 16:49', '', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
