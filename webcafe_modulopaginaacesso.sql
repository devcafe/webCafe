-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Out-2014 às 14:51
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
-- Estrutura da tabela `webcafe_modulopaginaacesso`
--

CREATE TABLE IF NOT EXISTS `webcafe_modulopaginaacesso` (
  `idAcesso` int(11) NOT NULL AUTO_INCREMENT,
  `idModulo` int(11) NOT NULL,
  `idPagina` int(11) NOT NULL,
  `regra` varchar(50) NOT NULL,
  PRIMARY KEY (`idAcesso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Extraindo dados da tabela `webcafe_modulopaginaacesso`
--

INSERT INTO `webcafe_modulopaginaacesso` (`idAcesso`, `idModulo`, `idPagina`, `regra`) VALUES
(1, 1, 1, 'Visualizar'),
(2, 1, 1, 'Apagar'),
(3, 1, 1, 'Editar'),
(4, 1, 1, 'Adicionar'),
(5, 1, 2, 'Visualizar'),
(6, 1, 2, 'Apagar'),
(7, 1, 2, 'Editar'),
(8, 1, 2, 'Adicionar'),
(9, 2, 5, 'Visualizar'),
(10, 1, 3, 'Visualizar'),
(11, 1, 3, 'Apagar'),
(12, 1, 3, 'Editar'),
(13, 1, 3, 'Adicionar'),
(14, 1, 4, 'Visualizar'),
(15, 1, 4, 'Apagar'),
(16, 1, 4, 'Editar'),
(17, 1, 4, 'Adicionar'),
(18, 3, 6, 'Visualizar'),
(19, 3, 6, 'Apagar'),
(20, 3, 6, 'Editar'),
(21, 3, 6, 'Adicionar'),
(22, 2, 5, 'Apagar'),
(23, 2, 5, 'Editar'),
(25, 2, 5, 'Adicionar'),
(26, 1, 1, 'Exportar'),
(27, 1, 1, 'Importar'),
(28, 1, 2, 'Exportar'),
(29, 1, 2, 'Importar'),
(30, 1, 3, 'Exportar'),
(31, 1, 3, 'Importar'),
(32, 1, 4, 'Exportar'),
(33, 1, 4, 'Importar'),
(34, 2, 5, 'Exportar'),
(35, 2, 5, 'Importar'),
(36, 3, 6, 'Exportar');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
