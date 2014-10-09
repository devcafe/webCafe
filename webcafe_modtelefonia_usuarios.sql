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
-- Estrutura da tabela `webcafe_modtelefonia_usuarios`
--

CREATE TABLE IF NOT EXISTS `webcafe_modtelefonia_usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `cep` varchar(40) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `profissao` varchar(50) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `observacoes` text NOT NULL,
  `dataCadastro` varchar(40) NOT NULL,
  `userAdd` int(11) NOT NULL,
  `dataAlteracao` varchar(40) NOT NULL,
  `userLastChange` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `webcafe_modtelefonia_usuarios`
--

INSERT INTO `webcafe_modtelefonia_usuarios` (`idUsuario`, `nome`, `telefone`, `celular`, `cep`, `endereco`, `bairro`, `cidade`, `uf`, `rg`, `profissao`, `cpf`, `observacoes`, `dataCadastro`, `userAdd`, `dataAlteracao`, `userLastChange`) VALUES
(2, '2', '2', '2', '2', '22', '2', '2', '2', '2', '2', '1', '2', '0', 0, '0', 0),
(3, '1', '1', '1', '1', '1', '7', '8', '9', '9', '1', '2', '1', '0', 0, '0', 0),
(4, '1', '1', '1', '1', '1', '6', '4', '5', '0', '1', '2', '1', '0', 0, '0', 0),
(5, '123', '', '', '', '', '', '', '', '', '', '123', '', '08/10/2014 16:40', 1, '', 0),
(6, '123213213', '', '', '', '', '', '', '', '', '', '23213123', '', '08/10/2014 16:40', 1, '', 0),
(7, '213123123', '', '', '', '', '', '', '', '', '', '123123123123123', '', '08/10/2014 16:40', 1, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
