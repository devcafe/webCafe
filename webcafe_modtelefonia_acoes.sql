-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09-Out-2014 às 17:29
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
-- Estrutura da tabela `webcafe_modtelefonia_acoes`
--

CREATE TABLE IF NOT EXISTS `webcafe_modtelefonia_acoes` (
  `idAcao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cnpj` varchar(50) NOT NULL,
  `razaoSocial` varchar(255) NOT NULL,
  `dataCadastro` varchar(40) NOT NULL,
  `dataAlteracao` varchar(40) NOT NULL,
  `userAdd` int(11) NOT NULL,
  `userLastChange` int(11) NOT NULL,
  PRIMARY KEY (`idAcao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `webcafe_modtelefonia_acoes`
--

INSERT INTO `webcafe_modtelefonia_acoes` (`idAcao`, `nome`, `cnpj`, `razaoSocial`, `dataCadastro`, `dataAlteracao`, `userAdd`, `userLastChange`) VALUES
(3, 'GKS 22', '78945612322', 'GSK 222', '08/10/2014 19:39', '08/10/2014 19:40', 1, 1),
(4, 'GSK 3', '123213123', 'GSk 3', '08/10/2014 19:40', '', 1, 0),
(5, 'MIDEA 1', '549828918', 'MIDEA 1', '08/10/2014 19:40', '', 1, 0),
(6, 'Garoto', '29302138', 'Garoto', '08/10/2014 19:40', '', 1, 0),
(7, 'Cafe', '2323123', 'Cafe', '08/10/2014 19:40', '', 1, 0),
(8, 'asdsadsad', 'asdasdsa', 'dasdsadsad', '08/10/2014 19:43', '', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
