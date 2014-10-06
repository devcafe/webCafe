-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06-Out-2014 às 23:05
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
-- Estrutura da tabela `webcafe_modtelefonia_aparelhos`
--

CREATE TABLE IF NOT EXISTS `webcafe_modtelefonia_aparelhos` (
  `idAparelho` int(11) NOT NULL AUTO_INCREMENT,
  `aparelhoStatus` varchar(20) NOT NULL,
  `marcaAparelho` varchar(50) NOT NULL,
  `modeloAparelho` varchar(50) NOT NULL,
  `imeiAparelho` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `dataEnvioManutencao` varchar(15) NOT NULL,
  `dataCadastro` varchar(15) NOT NULL,
  `dataAlteracao` varchar(15) NOT NULL,
  `checkedAparelho` int(11) NOT NULL,
  `acessorios` text NOT NULL,
  `observacoes` text NOT NULL,
  `userAdd` int(11) NOT NULL,
  `userLastChange` int(11) NOT NULL,
  PRIMARY KEY (`idAparelho`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `webcafe_modtelefonia_aparelhos`
--

INSERT INTO `webcafe_modtelefonia_aparelhos` (`idAparelho`, `aparelhoStatus`, `marcaAparelho`, `modeloAparelho`, `imeiAparelho`, `tipo`, `dataEnvioManutencao`, `dataCadastro`, `dataAlteracao`, `checkedAparelho`, `acessorios`, `observacoes`, `userAdd`, `userLastChange`) VALUES
(1, '6', 'Nenhum', 'Nenhum', 'Nenhum', 'Nenhum', '', '', '', 1, '', '', 0, 0),
(8, '1', 'Motorola', 'DEFY MINI', '351648050352401', 'Smartphone', '', '02/07/2014', '02/07/2014', 0, 'CARREGADOR, USB E FONE', 'Aparelho em Perfeito estado ', 0, 0),
(9, '1', 'Nokia ', 'NOKIA200', 'sem imei', 'Smartphone', '', '02/07/2014', '02/07/2014', 1, 'CARREGADOR, USB E FONE', 'Aparelho em Perfeito estado. \nAparelho propriedade do cliente NÃ­vea.', 0, 0),
(10, '1', 'Samsung ', ' Galaxy Pocket', '357517050406984', 'Smartphone', '', '02/07/2014', '02/07/2014', 0, 'CARREGADOR, USB E FONE', 'Aparelho usado.\n', 0, 0),
(11, '1', 'Samsung ', 'Galaxy Yung', '357059050818462', 'Smartphone', '', '02/07/2014', '02/07/2014', 0, 'Carregador, cabo USB. ', 'NÃ£o enviar Fone nem demais acessÃ³rios. ', 0, 0),
(12, '1', 'LG', 'OPTIMUS L8- LG-P717', '355737055307175', 'Smartphone', '', '02/07/2014', '02/07/2014', 1, 'Cabo USB e  Carregador. ', ' Novo.', 0, 0),
(13, '1', 'LG', 'OPTIMUS L9	LG-P718', '355737055128100', 'Smartphone', '', '02/07/2014', '02/07/2014', 0, 'Cabo USB e  Carregador. ', ' Novo.', 0, 0),
(14, '1', 'LG', 'Optimus L10 LG-P719', '355737055310872', 'Smartphone', '', '02/07/2014', '02/07/2014', 0, 'Cabo USB e  Carregador. ', ' Novo.', 0, 0),
(15, '1', 'MOTOROLA', 'MOTO - G	XT1032', '354988056339227', 'Smartphone', '', '02/07/2014', '02/07/2014', 0, 'Cabo USB e  Carregador. ', ' Novo.', 0, 0),
(16, '1', 'MOTOROLA', 'NEXTEL	i296', '000600579367910', 'Smartphone', '', '02/07/2014', '02/07/2014', 0, 'Cabo USB e  Carregador. ', 'Usado.', 0, 0),
(17, '1', 'MOTOROLA', 'RAZR D1	XT918', '355005058485459', 'Smartphone', '', '02/07/2014', '02/07/2014', 0, 'Cabo USB e  Carregador. ', 'Usado.', 0, 0),
(18, '1', 'MOTOROLA', 'Razr D3	XT920', '353221055633106', 'Smartphone', '', '02/07/2014', '02/07/2014', 0, 'Cabo USB e  Carregador. ', 'Usado.', 0, 0),
(19, '1', 'MOTOROLA', 'XOOM2 3G', '358575040222977', 'Tablet', '', '02/07/2014', '02/07/2014', 0, 'Cabo USB e  Carregador. ', 'Usado.', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
