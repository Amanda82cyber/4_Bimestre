-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 10/12/2019 às 00h13min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `ad`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `CPF` char(11) DEFAULT NULL,
  `id_roupa` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `comentario` varchar(100) NOT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `CPF` (`CPF`),
  KEY `id_roupa` (`id_roupa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `CPF`, `id_roupa`, `data`, `hora`, `comentario`) VALUES
(17, NULL, 4, '2017-04-19', '20:32:47', 'Adorei!!! Vou me cadastrar para comprar!!'),
(18, NULL, 2, '2017-04-19', '20:52:51', 'Q verde lindo!!!'),
(19, '44809499847', 2, '2017-04-19', '20:57:40', 'Adorei!!! Comprei e chegou antes do prazo!!'),
(35, '44809499847', 2, '2001-10-19', '07:26:14', 'Queroooooooooooooooooo!!'),
(36, '44809499847', 2, '2001-10-19', '07:26:42', 'Ameiii!'),
(37, '22233446789', 2, '2009-12-19', '07:34:27', 'NÃ£o vejo a hora de chegar!!'),
(38, '22233446789', 2, '2009-12-19', '07:36:01', 'Meus olhos brilharam ao ver essa roupa!!'),
(39, '12345678901', 2, '2009-12-19', '07:40:10', 'Vem pra mimmmm!'),
(40, '12345678901', 2, '2009-12-19', '07:42:32', 'Roupa MARA!'),
(41, '12345678901', 4, '2009-12-19', '07:43:56', 'QUERO!'),
(42, NULL, 4, '2009-12-19', '16:01:15', 'quero uma.'),
(43, '36735126840', 2, '2009-12-19', '16:05:01', 'eu quero'),
(44, NULL, 2, '2010-12-19', '02:25:38', 'Amooo!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comprar`
--

CREATE TABLE IF NOT EXISTS `comprar` (
  `CPF` char(11) NOT NULL,
  `id_roupa` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_compra`),
  KEY `CPF` (`CPF`),
  KEY `id_roupa` (`id_roupa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Extraindo dados da tabela `comprar`
--

INSERT INTO `comprar` (`CPF`, `id_roupa`, `quantidade`, `id_compra`) VALUES
('44809499847', 2, 3, 6),
('44809499847', 2, 1, 49),
('44809499847', 2, 2, 50),
('44809499847', 4, 3, 51),
('36735126840', 54, 3, 52),
('22233446789', 2, 2, 53),
('22233446789', 53, 4, 54);

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja`
--

CREATE TABLE IF NOT EXISTS `loja` (
  `CNPJ` char(14) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `estado` char(2) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `rua` varchar(200) NOT NULL,
  `senha` int(11) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`CNPJ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja`
--

INSERT INTO `loja` (`CNPJ`, `nome`, `estado`, `cidade`, `rua`, `senha`, `pais`, `email`) VALUES
('12334444', 'CriaÃ§Ãµes Claudia', 'SP', 'Araraquara', 'Av. SÃ£o Pedro', 7777, 'BR', 'claudinha@gmail.com'),
('12345', 'Dafiti', 'SP', 'Boa EsperanÃ§a do Sul', 'Dom Pedro 1', 12345, 'Brasil', 'dafiti@gmail.com'),
('666666666', 'Xuxa', 'PA', 'BelÃ©m', 'FafÃ¡', 99999, 'BR', 'soparabaixinhos@gmail.com'),
('88888', 'Montreal Magazine', 'SP', 'Bauru', 'Os Bandeirantes', 777, 'Brasil', 'montrealM@gmail.com'),
('999999', 'Textil Abril', 'SP', 'Araraquara', 'Avenida Luiz AntÃ´nio CorrÃªa da Silva, 147', 123, 'Brasil', 'textabril@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roupa`
--

CREATE TABLE IF NOT EXISTS `roupa` (
  `id_roupa` int(11) NOT NULL AUTO_INCREMENT,
  `material` varchar(100) NOT NULL,
  `tamanho` varchar(50) NOT NULL,
  `ano_lancamento` date NOT NULL,
  `quantidade` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `cor` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `preco` float NOT NULL,
  `genero` char(1) NOT NULL,
  `CNPJ` char(14) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_roupa`),
  KEY `CNPJ` (`CNPJ`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Extraindo dados da tabela `roupa`
--

INSERT INTO `roupa` (`id_roupa`, `material`, `tamanho`, `ano_lancamento`, `quantidade`, `marca`, `cor`, `tipo`, `preco`, `genero`, `CNPJ`, `foto`) VALUES
(2, 'Poliester', 'G', '2017-01-22', 19, 'Lua Nova', '#00c100', 'Camisa', 41, 'F', '12345', 'ce2e5d8813c330724b5dbc2cbbc39305.jpg'),
(4, 'Seda', 'M', '2017-12-13', 17, 'Maria FilÃ³', '#8080ff', 'Saia', 50, 'F', '12345', '9e5cbe5f2f98c85100d8785184cf55fb.jpg'),
(52, 'Palha', '42', '2019-11-18', 23, 'HavaÃ­', '#d0c717', 'Saia', 24.9, 'F', '12334444', '49ad88504d59981b45c052b88fa8f243.jpg'),
(53, 'AlgodÃ£o', '38', '2019-12-25', 26, 'Tjama', '#ffffff', 'Conjunto de Pijama', 20, 'F', '666666666', 'e314eb60109a7ec84a5aaed8de7965ee.jpg'),
(54, 'Seda', '40', '2019-12-28', 32, 'La Donzelle', '#add6d6', 'Vestido', 60, 'F', '12345', '83736d651dc3b88b2a10307a0ff68487.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `CPF` char(11) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `rua` varchar(200) NOT NULL,
  `estado` char(2) NOT NULL,
  `data_nascimento` date NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL,
  `cartao_credito` int(11) NOT NULL,
  `senha` int(11) NOT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`CPF`, `cidade`, `rua`, `estado`, `data_nascimento`, `nome`, `email`, `pais`, `sexo`, `cartao_credito`, `senha`) VALUES
('10293845679', 'Araraquara', 'asdasda', 'SP', '1999-11-30', 'teste', 'ads@asd', 'Brasil', 'M', 41234123, 12345),
('12345678901', 'Barretos', 'Pedro JosÃ©', 'SP', '2019-09-07', 'Agatha Maria', 'agatinha@gmail.com', 'Brasil', 'F', 8888888, 123),
('22233446789', 'Araraquara', 'Dos bobos', 'CE', '2019-10-18', 'Moana Santana', 'moana@gmail.com', 'BR', 'F', 2147483647, 8888),
('36735126840', 'Araraquara', 'Adelaide', 'SP', '1989-08-14', 'Jadson Augusto da SIlva', 'jadson1ma@gmail.com', 'BR', 'F', 2147483647, 12345),
('44809499847', 'Aararquara', 'R Isidoro Bitio Neto', 'SP', '2001-11-04', 'DeoclÃ©cia', 'deinhah@gmail.com', 'Brasil', 'F', 2147483647, 123456),
('46892475342', 'Belo Horizonte', 'BelÃ­ssima ConceiÃ§Ã£o', 'AC', '2019-01-22', 'Lurdinha Cruz', 'lurdinhaCruz@gmail.com', 'Brasil', 'F', 999999999, 567);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_roupa`) REFERENCES `roupa` (`id_roupa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_5` FOREIGN KEY (`CPF`) REFERENCES `usuario` (`CPF`) ON UPDATE SET NULL;

--
-- Restrições para a tabela `comprar`
--
ALTER TABLE `comprar`
  ADD CONSTRAINT `comprar_ibfk_3` FOREIGN KEY (`CPF`) REFERENCES `usuario` (`CPF`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comprar_ibfk_4` FOREIGN KEY (`id_roupa`) REFERENCES `roupa` (`id_roupa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `roupa`
--
ALTER TABLE `roupa`
  ADD CONSTRAINT `roupa_ibfk_2` FOREIGN KEY (`CNPJ`) REFERENCES `loja` (`CNPJ`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
