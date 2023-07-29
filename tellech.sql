-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 29-Jul-2023 às 23:38
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `tellech`
--
CREATE DATABASE IF NOT EXISTS `tellech` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tellech`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `DataDeNascimento` date NOT NULL,
  `CPF` varchar(15) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Senha` varchar(40) NOT NULL,
  `DataCadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao` (
  `IdPublicacao` int(11) NOT NULL,
  `TituloAvaliacao` varchar(20) NOT NULL,
  `Estrela` blob,
  `ConteudoPublicacao` varchar(500) NOT NULL,
  `MidiaAvaliacao` blob,
  `DataPublicacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Comentario` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdPublicacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `NomeCategoria` varchar(20) NOT NULL,
  PRIMARY KEY (`IdCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `DataDeNascimento` date NOT NULL,
  `CPF` varchar(15) NOT NULL,
  `Genero` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Senha` varchar(40) NOT NULL,
  `DataCadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Logradouro` varchar(30) NOT NULL,
  `Numero` varchar(5) NOT NULL,
  `Complemento` varchar(20) DEFAULT NULL,
  `CEP` varchar(9) NOT NULL,
  `Bairro` varchar(20) NOT NULL,
  `Cidade` varchar(20) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Telefone_1` varchar(15) NOT NULL,
  `Telefone_2` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhedopedido`
--

CREATE TABLE IF NOT EXISTS `detalhedopedido` (
  `IdDetalhe` int(11) NOT NULL,
  `PrecoTotal` varchar(20) NOT NULL,
  `QntProduto` int(11) NOT NULL,
  `DataDetalhe` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IdPedido` int(11) NOT NULL,
  `IdProduto` int(11) NOT NULL,
  PRIMARY KEY (`IdDetalhe`),
  KEY `Idx_IdPedidoFK` (`IdPedido`),
  KEY `Idx_IdProdutoFK` (`IdProduto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `DataDeAbertura` date NOT NULL,
  `CNPJ` varchar(18) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Senha` varchar(40) NOT NULL,
  `DataCadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Logradouro` varchar(30) NOT NULL,
  `Numero` varchar(5) NOT NULL,
  `Complemento` varchar(20) DEFAULT NULL,
  `CEP` varchar(9) NOT NULL,
  `Bairro` varchar(20) NOT NULL,
  `Cidade` varchar(20) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Telefone_1` varchar(15) NOT NULL,
  `Telefone_2` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `IdPublicacao` int(11) NOT NULL,
  `ConteudoPublicacao` varchar(500) NOT NULL,
  `DataPublicacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Comentario` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdPublicacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `IdPedido` int(11) NOT NULL,
  `ValorTotal` varchar(20) NOT NULL,
  `FormaDePagamento` varchar(15) NOT NULL,
  `Id` int(11) NOT NULL,
  PRIMARY KEY (`IdPedido`),
  KEY `Idx_IdFK` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem`
--

CREATE TABLE IF NOT EXISTS `postagem` (
  `IdPublicacao` int(11) NOT NULL,
  `TituloPostagem` varchar(20) DEFAULT NULL,
  `ConteudoPublicacao` varchar(500) NOT NULL,
  `MidiaPostagem` blob,
  `DataPublicacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Comentario` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdPublicacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `IdProduto` int(11) NOT NULL,
  `NomeProduto` varchar(20) NOT NULL,
  `Descricao` varchar(100) NOT NULL,
  `QntEstoque` int(11) NOT NULL,
  `Preco` varchar(20) NOT NULL,
  `MidiaProduto` blob NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Id` int(11) NOT NULL,
  PRIMARY KEY (`IdProduto`),
  KEY `Idx_IdCategoriaFK` (`IdCategoria`),
  KEY `Idx_IdEmpresaFK` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `detalhedopedido`
--
ALTER TABLE `detalhedopedido`
  ADD CONSTRAINT `Idx_IdPedidoFK` FOREIGN KEY (`IdPedido`) REFERENCES `pedido` (`IdPedido`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Idx_IdProdutoFK` FOREIGN KEY (`IdProduto`) REFERENCES `produto` (`IdProduto`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `Idx_IdFK` FOREIGN KEY (`Id`) REFERENCES `cliente` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `Idx_IdCategoriaFK` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Idx_IdEmpresaFK` FOREIGN KEY (`Id`) REFERENCES `empresa` (`Id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
