-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: mysql12-farm60.kinghost.net
-- Tempo de geração: 30/07/2016 às 15:54
-- Versão do servidor: 5.5.46-log
-- Versão do PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `sitesesistemas02`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acesso`
--

CREATE TABLE IF NOT EXISTS `acesso` (
  `codacesso` int(11) NOT NULL,
  `codpessoa` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT '0',
  `data` date NOT NULL,
  `enderecoip` varchar(15) NOT NULL,
  `codempresa` int(11) NOT NULL DEFAULT '0',
  `dtsaida` datetime NOT NULL,
  `hora` time DEFAULT NULL,
  `ultimaacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atributo`
--

CREATE TABLE IF NOT EXISTS `atributo` (
  `codatributo` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT 'varchar',
  `tamanho` int(11) NOT NULL DEFAULT '11',
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL DEFAULT '1',
  `lista` text NOT NULL,
  `mascara` varchar(30) NOT NULL,
  `ordem` int(11) NOT NULL,
  `min` varchar(10) NOT NULL,
  `max` varchar(10) NOT NULL,
  `filtro` set('s','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `atributo`
--

INSERT INTO `atributo` (`codatributo`, `nome`, `tipo`, `tamanho`, `dtcadastro`, `codfuncionario`, `lista`, `mascara`, `ordem`, `min`, `max`, `filtro`) VALUES
(1, 'Nome', 'varchar', 50, '2016-07-25 13:12:59', 1, '', '', 1, '', '', 'n'),
(2, 'Patrimônio', 'int', 6, '2016-07-25 13:12:59', 1, '', 'inteiro', 2, '', '', 'n'),
(3, 'Serial / TAG', 'varchar', 50, '2016-07-25 13:12:59', 1, '', '', 3, '', '', 'n'),
(5, 'Utilizador', 'varchar', 50, '2016-07-25 13:12:59', 1, '', '', 4, '', '', 'n'),
(6, 'Fabricante', 'select', 50, '2016-07-25 13:12:59', 1, 'Dell, Microsoft, Lenovo, Apple, Samsung, Cisco, Mikrotik, Ubiquit, LG, ', '', 5, '', '', 'n'),
(7, 'Modelo', 'varchar', 50, '2016-07-25 13:12:59', 1, '', '', 6, '', '', 'n'),
(8, 'Tamanho Tela', 'varchar', 11, '2016-07-25 13:12:59', 1, '', '', 15, '', '', 'n'),
(9, 'Processador', 'select', 50, '2016-07-25 13:12:59', 1, 'i7, i5, i3, QuadCore, Core2Duo, DualCore, Celeron, Xeon', '', 7, '', '', 'n'),
(10, 'HD', 'select', 11, '2016-07-25 13:12:59', 1, '2TB, 1TB, 750GB, 500GB, 480SSD, 320GB, 250GB, 240SSD, 120SSD, 80GB', '', 9, '', '', 'n'),
(11, 'Memória RAM', 'select', 11, '2016-07-25 13:12:59', 1, '1GB, 2GB, 4GB, 8GB, 16GB, 32GB, 64GB, 128GB, 256GB, 512GB', '', 8, '', '', 'n'),
(13, 'Office', 'select', 50, '2016-07-25 13:12:59', 1, '2016, 2013, 2010, 2007, 2003', '', 12, '', '', 'n'),
(15, 'Data Compra', 'date', 11, '2016-07-25 13:12:59', 1, '', 'data', 16, '', '', 'n'),
(16, 'Tempo de Uso', 'varchar', 50, '2016-07-25 13:12:59', 1, '', '', 98, '', '', 'n'),
(17, 'Status Garantia', 'date', 11, '2016-07-25 13:12:59', 1, '', '', 97, '', '', 'n'),
(21, 'Endereço IP', 'varchar', 15, '2016-07-25 13:12:59', 1, '', 'enderecoip', 17, '', '', 'n'),
(22, 'MAC Adress', 'varchar', 30, '2016-07-25 13:12:59', 1, '', '', 18, '', '', 'n'),
(23, 'Licenças', 'file', 11, '2016-07-25 13:12:59', 1, '', '', 77, '', '', 'n'),
(24, 'Documentos', 'varchar', 11, '2016-07-25 13:12:59', 1, '', '', 20, '', '', 'n'),
(25, 'Outros', 'text', 11, '2016-07-25 13:12:59', 1, '', 'texto', 99, '', '', 'n'),
(28, 'Operadora', 'select', 11, '2016-07-26 15:09:40', 1, 'TIM, VIVO, Claro, OI, GVT', '', 21, '', '', 'n'),
(29, 'Nota Fiscal', 'file', 11, '2016-07-26 18:02:57', 1, '', '', 88, '', '', 'n'),
(30, 'AutoCad', 'select', 11, '2016-07-29 17:52:08', 1, '2017, 2016, 2015, 2014, 2013, 2012, 2011, 2010, 2009, 2008, 2007, 2006, Não Utiliza', '', 14, '', '', 'n'),
(31, 'MS Project', 'select', 50, '2016-07-30 02:07:56', 1, '2016, 2013, 2010, 2007, Não Utiliza', '', 13, '', '', 'n'),
(32, 'S.O', 'select', 11, '2016-07-30 16:32:42', 3, 'Windows 10, Windows 8.1, Windows 8, Windows 7, Windows XP, Linux, Windows Server 2003, Windows Server 2008 R2, Windows Server 2008, Windows Server 2012, Windows Server 2012 R2, Windows Server 2016', '', 11, '', '', 'n'),
(34, 'VGA', 'select', 50, '2016-07-30 16:54:07', 3, 'Onboard, 2GB, 1GB, 512, N/A', '', 10, '', '', 'n'),
(35, 'Informações Técnicas', 'text', 400, '2016-07-30 17:02:46', 3, '', '', 98, '', '', 'n');

-- --------------------------------------------------------

--
-- Estrutura para tabela `atributocategoria`
--

CREATE TABLE IF NOT EXISTS `atributocategoria` (
  `codac` int(11) NOT NULL,
  `codcategoria` int(11) NOT NULL,
  `codatributo` int(11) NOT NULL,
  `codfuncionario` int(11) NOT NULL DEFAULT '1',
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obrigatorio` set('s','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB AUTO_INCREMENT=349 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `atributocategoria`
--

INSERT INTO `atributocategoria` (`codac`, `codcategoria`, `codatributo`, `codfuncionario`, `dtcadastro`, `obrigatorio`) VALUES
(1, 9, 19, 1, '2016-07-26 12:53:15', 'n'),
(3, 2, 2, 1, '2016-07-26 13:07:56', 'n'),
(4, 3, 2, 1, '2016-07-26 13:07:56', 'n'),
(5, 4, 2, 1, '2016-07-26 13:07:56', 'n'),
(6, 5, 2, 1, '2016-07-26 13:07:56', 'n'),
(7, 6, 2, 1, '2016-07-26 13:07:56', 'n'),
(8, 7, 2, 1, '2016-07-26 13:07:56', 'n'),
(9, 8, 2, 1, '2016-07-26 13:07:57', 'n'),
(10, 9, 2, 1, '2016-07-26 13:07:57', 'n'),
(11, 10, 2, 1, '2016-07-26 13:07:57', 'n'),
(12, 11, 2, 1, '2016-07-26 13:07:57', 'n'),
(13, 12, 2, 1, '2016-07-26 13:07:57', 'n'),
(14, 13, 2, 1, '2016-07-26 13:07:57', 'n'),
(15, 14, 2, 1, '2016-07-26 13:07:57', 'n'),
(16, 15, 2, 1, '2016-07-26 13:07:57', 'n'),
(17, 16, 2, 1, '2016-07-26 13:07:57', 'n'),
(18, 17, 2, 1, '2016-07-26 13:07:57', 'n'),
(19, 18, 2, 1, '2016-07-26 13:07:57', 'n'),
(20, 19, 2, 1, '2016-07-26 13:07:57', 'n'),
(21, 20, 2, 1, '2016-07-26 13:07:57', 'n'),
(22, 1, 3, 1, '2016-07-26 13:08:17', 'n'),
(23, 2, 3, 1, '2016-07-26 13:08:17', 'n'),
(24, 3, 3, 1, '2016-07-26 13:08:17', 'n'),
(25, 4, 3, 1, '2016-07-26 13:08:17', 'n'),
(26, 5, 3, 1, '2016-07-26 13:08:17', 'n'),
(27, 6, 3, 1, '2016-07-26 13:08:17', 'n'),
(28, 7, 3, 1, '2016-07-26 13:08:17', 'n'),
(29, 8, 3, 1, '2016-07-26 13:08:17', 'n'),
(30, 9, 3, 1, '2016-07-26 13:08:17', 'n'),
(31, 10, 3, 1, '2016-07-26 13:08:17', 'n'),
(32, 11, 3, 1, '2016-07-26 13:08:17', 'n'),
(33, 12, 3, 1, '2016-07-26 13:08:17', 'n'),
(34, 13, 3, 1, '2016-07-26 13:08:17', 'n'),
(35, 14, 3, 1, '2016-07-26 13:08:17', 'n'),
(36, 15, 3, 1, '2016-07-26 13:08:17', 'n'),
(37, 16, 3, 1, '2016-07-26 13:08:17', 'n'),
(38, 17, 3, 1, '2016-07-26 13:08:17', 'n'),
(39, 18, 3, 1, '2016-07-26 13:08:17', 'n'),
(40, 19, 3, 1, '2016-07-26 13:08:17', 'n'),
(41, 20, 3, 1, '2016-07-26 13:08:17', 'n'),
(42, 1, 18, 1, '2016-07-26 13:12:05', 'n'),
(43, 2, 18, 1, '2016-07-26 13:12:05', 'n'),
(44, 3, 18, 1, '2016-07-26 13:12:05', 'n'),
(45, 4, 18, 1, '2016-07-26 13:12:05', 'n'),
(46, 5, 18, 1, '2016-07-26 13:12:05', 'n'),
(47, 6, 18, 1, '2016-07-26 13:12:05', 'n'),
(48, 7, 18, 1, '2016-07-26 13:12:05', 'n'),
(49, 8, 18, 1, '2016-07-26 13:12:05', 'n'),
(50, 9, 18, 1, '2016-07-26 13:12:05', 'n'),
(51, 10, 18, 1, '2016-07-26 13:12:05', 'n'),
(52, 11, 18, 1, '2016-07-26 13:12:05', 'n'),
(53, 12, 18, 1, '2016-07-26 13:12:05', 'n'),
(54, 13, 18, 1, '2016-07-26 13:12:05', 'n'),
(55, 14, 18, 1, '2016-07-26 13:12:05', 'n'),
(56, 15, 18, 1, '2016-07-26 13:12:05', 'n'),
(57, 16, 18, 1, '2016-07-26 13:12:05', 'n'),
(58, 17, 18, 1, '2016-07-26 13:12:05', 'n'),
(59, 18, 18, 1, '2016-07-26 13:12:05', 'n'),
(60, 19, 18, 1, '2016-07-26 13:12:05', 'n'),
(61, 20, 18, 1, '2016-07-26 13:12:05', 'n'),
(62, 1, 19, 1, '2016-07-26 13:12:26', 'n'),
(63, 2, 19, 1, '2016-07-26 13:12:26', 'n'),
(64, 3, 19, 1, '2016-07-26 13:12:26', 'n'),
(65, 4, 19, 1, '2016-07-26 13:12:26', 'n'),
(66, 5, 19, 1, '2016-07-26 13:12:26', 'n'),
(67, 6, 19, 1, '2016-07-26 13:12:26', 'n'),
(68, 7, 19, 1, '2016-07-26 13:12:26', 'n'),
(69, 8, 19, 1, '2016-07-26 13:12:26', 'n'),
(70, 10, 19, 1, '2016-07-26 13:12:26', 'n'),
(71, 11, 19, 1, '2016-07-26 13:12:26', 'n'),
(72, 12, 19, 1, '2016-07-26 13:12:26', 'n'),
(73, 13, 19, 1, '2016-07-26 13:12:26', 'n'),
(74, 14, 19, 1, '2016-07-26 13:12:26', 'n'),
(75, 15, 19, 1, '2016-07-26 13:12:26', 'n'),
(76, 16, 19, 1, '2016-07-26 13:12:26', 'n'),
(77, 17, 19, 1, '2016-07-26 13:12:26', 'n'),
(78, 18, 19, 1, '2016-07-26 13:12:26', 'n'),
(79, 19, 19, 1, '2016-07-26 13:12:26', 'n'),
(80, 20, 19, 1, '2016-07-26 13:12:26', 'n'),
(81, 1, 20, 1, '2016-07-26 13:16:55', 'n'),
(82, 2, 20, 1, '2016-07-26 13:16:55', 'n'),
(83, 3, 20, 1, '2016-07-26 13:16:55', 'n'),
(84, 4, 20, 1, '2016-07-26 13:16:55', 'n'),
(85, 5, 20, 1, '2016-07-26 13:16:55', 'n'),
(86, 6, 20, 1, '2016-07-26 13:16:55', 'n'),
(87, 7, 20, 1, '2016-07-26 13:16:55', 'n'),
(88, 8, 20, 1, '2016-07-26 13:16:55', 'n'),
(89, 9, 20, 1, '2016-07-26 13:16:55', 'n'),
(90, 10, 20, 1, '2016-07-26 13:16:55', 'n'),
(91, 11, 20, 1, '2016-07-26 13:16:55', 'n'),
(92, 12, 20, 1, '2016-07-26 13:16:55', 'n'),
(93, 13, 20, 1, '2016-07-26 13:16:55', 'n'),
(94, 14, 20, 1, '2016-07-26 13:16:55', 'n'),
(95, 15, 20, 1, '2016-07-26 13:16:55', 'n'),
(96, 16, 20, 1, '2016-07-26 13:16:55', 'n'),
(97, 17, 20, 1, '2016-07-26 13:16:55', 'n'),
(98, 18, 20, 1, '2016-07-26 13:16:55', 'n'),
(99, 19, 20, 1, '2016-07-26 13:16:55', 'n'),
(100, 20, 20, 1, '2016-07-26 13:16:55', 'n'),
(101, 1, 25, 1, '2016-07-26 13:18:14', 'n'),
(102, 2, 25, 1, '2016-07-26 13:18:14', 'n'),
(103, 3, 25, 1, '2016-07-26 13:18:14', 'n'),
(104, 4, 25, 1, '2016-07-26 13:18:14', 'n'),
(105, 5, 25, 1, '2016-07-26 13:18:14', 'n'),
(106, 6, 25, 1, '2016-07-26 13:18:14', 'n'),
(107, 7, 25, 1, '2016-07-26 13:18:14', 'n'),
(108, 8, 25, 1, '2016-07-26 13:18:14', 'n'),
(109, 9, 25, 1, '2016-07-26 13:18:14', 'n'),
(110, 10, 25, 1, '2016-07-26 13:18:14', 'n'),
(111, 11, 25, 1, '2016-07-26 13:18:14', 'n'),
(112, 12, 25, 1, '2016-07-26 13:18:14', 'n'),
(113, 13, 25, 1, '2016-07-26 13:18:14', 'n'),
(114, 14, 25, 1, '2016-07-26 13:18:14', 'n'),
(115, 15, 25, 1, '2016-07-26 13:18:14', 'n'),
(116, 16, 25, 1, '2016-07-26 13:18:14', 'n'),
(117, 17, 25, 1, '2016-07-26 13:18:14', 'n'),
(118, 18, 25, 1, '2016-07-26 13:18:14', 'n'),
(119, 19, 25, 1, '2016-07-26 13:18:14', 'n'),
(120, 20, 25, 1, '2016-07-26 13:18:14', 'n'),
(121, 1, 15, 1, '2016-07-26 13:19:12', 'n'),
(122, 2, 15, 1, '2016-07-26 13:19:12', 'n'),
(123, 3, 15, 1, '2016-07-26 13:19:12', 'n'),
(124, 4, 15, 1, '2016-07-26 13:19:12', 'n'),
(125, 5, 15, 1, '2016-07-26 13:19:12', 'n'),
(126, 6, 15, 1, '2016-07-26 13:19:12', 'n'),
(127, 7, 15, 1, '2016-07-26 13:19:12', 'n'),
(128, 8, 15, 1, '2016-07-26 13:19:12', 'n'),
(129, 9, 15, 1, '2016-07-26 13:19:12', 's'),
(130, 10, 15, 1, '2016-07-26 13:19:12', 's'),
(131, 11, 15, 1, '2016-07-26 13:19:12', 'n'),
(132, 12, 15, 1, '2016-07-26 13:19:12', 'n'),
(133, 13, 15, 1, '2016-07-26 13:19:12', 'n'),
(134, 14, 15, 1, '2016-07-26 13:19:12', 'n'),
(135, 15, 15, 1, '2016-07-26 13:19:12', 'n'),
(137, 17, 15, 1, '2016-07-26 13:19:12', 'n'),
(138, 18, 15, 1, '2016-07-26 13:19:12', 'n'),
(139, 19, 15, 1, '2016-07-26 13:19:12', 'n'),
(140, 20, 15, 1, '2016-07-26 13:19:12', 'n'),
(141, 1, 7, 1, '2016-07-26 15:07:27', 'n'),
(142, 2, 7, 1, '2016-07-26 15:07:27', 'n'),
(143, 3, 7, 1, '2016-07-26 15:07:27', 'n'),
(144, 4, 7, 1, '2016-07-26 15:07:27', 'n'),
(145, 5, 7, 1, '2016-07-26 15:07:27', 'n'),
(146, 6, 7, 1, '2016-07-26 15:07:27', 'n'),
(147, 7, 7, 1, '2016-07-26 15:07:27', 'n'),
(148, 8, 7, 1, '2016-07-26 15:07:27', 'n'),
(149, 9, 7, 1, '2016-07-26 15:07:27', 'n'),
(150, 10, 7, 1, '2016-07-26 15:07:27', 'n'),
(151, 11, 7, 1, '2016-07-26 15:07:27', 'n'),
(152, 12, 7, 1, '2016-07-26 15:07:27', 'n'),
(153, 13, 7, 1, '2016-07-26 15:07:27', 'n'),
(154, 14, 7, 1, '2016-07-26 15:07:27', 'n'),
(155, 15, 7, 1, '2016-07-26 15:07:27', 'n'),
(156, 16, 7, 1, '2016-07-26 15:07:27', 'n'),
(157, 17, 7, 1, '2016-07-26 15:07:27', 'n'),
(158, 18, 7, 1, '2016-07-26 15:07:27', 'n'),
(159, 19, 7, 1, '2016-07-26 15:07:27', 'n'),
(160, 20, 7, 1, '2016-07-26 15:07:27', 'n'),
(161, 1, 16, 1, '2016-07-26 15:08:03', 'n'),
(162, 2, 16, 1, '2016-07-26 15:08:03', 'n'),
(163, 3, 16, 1, '2016-07-26 15:08:03', 'n'),
(164, 4, 16, 1, '2016-07-26 15:08:03', 'n'),
(165, 5, 16, 1, '2016-07-26 15:08:03', 'n'),
(166, 6, 16, 1, '2016-07-26 15:08:03', 'n'),
(167, 7, 16, 1, '2016-07-26 15:08:03', 'n'),
(168, 8, 16, 1, '2016-07-26 15:08:03', 'n'),
(169, 9, 16, 1, '2016-07-26 15:08:03', 'n'),
(170, 10, 16, 1, '2016-07-26 15:08:03', 'n'),
(171, 11, 16, 1, '2016-07-26 15:08:03', 'n'),
(172, 12, 16, 1, '2016-07-26 15:08:03', 'n'),
(173, 13, 16, 1, '2016-07-26 15:08:03', 'n'),
(174, 14, 16, 1, '2016-07-26 15:08:03', 'n'),
(175, 15, 16, 1, '2016-07-26 15:08:03', 'n'),
(176, 16, 16, 1, '2016-07-26 15:08:03', 'n'),
(177, 17, 16, 1, '2016-07-26 15:08:03', 'n'),
(178, 18, 16, 1, '2016-07-26 15:08:03', 'n'),
(179, 19, 16, 1, '2016-07-26 15:08:03', 'n'),
(180, 20, 16, 1, '2016-07-26 15:08:03', 'n'),
(181, 10, 28, 1, '2016-07-26 15:11:06', 'n'),
(182, 1, 29, 1, '2016-07-26 18:03:19', 'n'),
(183, 2, 29, 1, '2016-07-26 18:03:19', 'n'),
(184, 3, 29, 1, '2016-07-26 18:03:19', 'n'),
(185, 4, 29, 1, '2016-07-26 18:03:19', 'n'),
(186, 5, 29, 1, '2016-07-26 18:03:19', 'n'),
(187, 6, 29, 1, '2016-07-26 18:03:19', 'n'),
(188, 7, 29, 1, '2016-07-26 18:03:19', 'n'),
(189, 8, 29, 1, '2016-07-26 18:03:19', 'n'),
(190, 9, 29, 1, '2016-07-26 18:03:19', 'n'),
(191, 10, 29, 1, '2016-07-26 18:03:19', 'n'),
(192, 11, 29, 1, '2016-07-26 18:03:19', 'n'),
(193, 12, 29, 1, '2016-07-26 18:03:19', 'n'),
(194, 13, 29, 1, '2016-07-26 18:03:19', 'n'),
(195, 14, 29, 1, '2016-07-26 18:03:19', 'n'),
(196, 15, 29, 1, '2016-07-26 18:03:19', 'n'),
(197, 16, 29, 1, '2016-07-26 18:03:19', 'n'),
(198, 17, 29, 1, '2016-07-26 18:03:19', 'n'),
(199, 18, 29, 1, '2016-07-26 18:03:19', 'n'),
(200, 19, 29, 1, '2016-07-26 18:03:19', 'n'),
(201, 20, 29, 1, '2016-07-26 18:03:19', 'n'),
(202, 1, 10, 1, '2016-07-28 12:46:32', 's'),
(203, 1, 11, 1, '2016-07-28 12:47:08', 's'),
(205, 2, 24, 1, '2016-07-29 03:34:54', 'n'),
(206, 3, 24, 1, '2016-07-29 03:34:54', 'n'),
(207, 4, 24, 1, '2016-07-29 03:34:54', 'n'),
(208, 5, 24, 1, '2016-07-29 03:34:54', 'n'),
(209, 6, 24, 1, '2016-07-29 03:34:54', 'n'),
(210, 7, 24, 1, '2016-07-29 03:34:54', 'n'),
(211, 8, 24, 1, '2016-07-29 03:34:54', 'n'),
(212, 9, 24, 1, '2016-07-29 03:34:55', 'n'),
(213, 10, 24, 1, '2016-07-29 03:34:55', 'n'),
(214, 11, 24, 1, '2016-07-29 03:34:55', 'n'),
(215, 12, 24, 1, '2016-07-29 03:34:55', 'n'),
(216, 13, 24, 1, '2016-07-29 03:34:55', 'n'),
(217, 14, 24, 1, '2016-07-29 03:34:55', 'n'),
(218, 15, 24, 1, '2016-07-29 03:34:55', 'n'),
(219, 16, 24, 1, '2016-07-29 03:34:55', 'n'),
(220, 17, 24, 1, '2016-07-29 03:34:55', 'n'),
(221, 18, 24, 1, '2016-07-29 03:34:55', 'n'),
(222, 19, 24, 1, '2016-07-29 03:34:55', 'n'),
(223, 20, 24, 1, '2016-07-29 03:34:55', 'n'),
(224, 1, 6, 1, '2016-07-29 03:41:31', 'n'),
(225, 2, 6, 1, '2016-07-29 03:41:31', 'n'),
(226, 3, 6, 1, '2016-07-29 03:41:31', 'n'),
(227, 4, 6, 1, '2016-07-29 03:41:31', 'n'),
(228, 5, 6, 1, '2016-07-29 03:41:31', 'n'),
(229, 6, 6, 1, '2016-07-29 03:41:31', 'n'),
(230, 7, 6, 1, '2016-07-29 03:41:31', 'n'),
(231, 8, 6, 1, '2016-07-29 03:41:31', 'n'),
(232, 9, 6, 1, '2016-07-29 03:41:31', 'n'),
(233, 10, 6, 1, '2016-07-29 03:41:31', 'n'),
(234, 11, 6, 1, '2016-07-29 03:41:31', 'n'),
(235, 12, 6, 1, '2016-07-29 03:41:31', 'n'),
(236, 13, 6, 1, '2016-07-29 03:41:31', 'n'),
(237, 14, 6, 1, '2016-07-29 03:41:31', 'n'),
(238, 15, 6, 1, '2016-07-29 03:41:31', 'n'),
(239, 16, 6, 1, '2016-07-29 03:41:31', 'n'),
(240, 17, 6, 1, '2016-07-29 03:41:31', 'n'),
(241, 18, 6, 1, '2016-07-29 03:41:31', 'n'),
(242, 19, 6, 1, '2016-07-29 03:41:31', 'n'),
(243, 20, 6, 1, '2016-07-29 03:41:31', 'n'),
(244, 2, 10, 1, '2016-07-29 03:41:55', 's'),
(245, 2, 23, 1, '2016-07-29 03:42:08', 'n'),
(246, 2, 11, 1, '2016-07-29 03:42:18', 'n'),
(247, 2, 22, 1, '2016-07-29 03:42:25', 'n'),
(248, 2, 1, 1, '2016-07-29 03:42:38', 's'),
(249, 2, 13, 1, '2016-07-29 03:42:49', 's'),
(251, 2, 9, 1, '2016-07-29 03:52:54', 's'),
(252, 1, 5, 1, '2016-07-29 03:58:32', 'n'),
(253, 4, 4, 1, '2016-07-29 03:58:32', 'n'),
(254, 3, 5, 1, '2016-07-29 03:58:32', 'n'),
(255, 4, 5, 1, '2016-07-29 03:58:32', 'n'),
(256, 5, 5, 1, '2016-07-29 03:58:32', 'n'),
(257, 6, 5, 1, '2016-07-29 03:58:32', 'n'),
(258, 7, 5, 1, '2016-07-29 03:58:32', 'n'),
(259, 8, 5, 1, '2016-07-29 03:58:32', 'n'),
(260, 9, 5, 1, '2016-07-29 03:58:32', 'n'),
(261, 10, 5, 1, '2016-07-29 03:58:32', 'n'),
(262, 11, 5, 1, '2016-07-29 03:58:32', 'n'),
(263, 12, 5, 1, '2016-07-29 03:58:32', 'n'),
(264, 13, 5, 1, '2016-07-29 03:58:32', 'n'),
(265, 14, 5, 1, '2016-07-29 03:58:32', 'n'),
(266, 15, 5, 1, '2016-07-29 03:58:32', 'n'),
(267, 16, 5, 1, '2016-07-29 03:58:32', 'n'),
(268, 17, 5, 1, '2016-07-29 03:58:32', 'n'),
(269, 18, 5, 1, '2016-07-29 03:58:32', 'n'),
(270, 19, 5, 1, '2016-07-29 03:58:32', 'n'),
(271, 20, 5, 1, '2016-07-29 03:58:32', 'n'),
(272, 2, 4, 1, '2016-07-29 04:01:17', 'n'),
(273, 1, 4, 1, '2016-07-29 04:01:25', 'n'),
(274, 1, 1, 1, '2016-07-30 01:49:14', 'n'),
(275, 3, 1, 1, '2016-07-30 01:49:14', 'n'),
(276, 4, 1, 1, '2016-07-30 01:49:14', 'n'),
(277, 5, 1, 1, '2016-07-30 01:49:14', 'n'),
(278, 6, 1, 1, '2016-07-30 01:49:14', 'n'),
(279, 7, 1, 1, '2016-07-30 01:49:14', 'n'),
(280, 8, 1, 1, '2016-07-30 01:49:14', 'n'),
(281, 9, 1, 1, '2016-07-30 01:49:14', 'n'),
(282, 10, 1, 1, '2016-07-30 01:49:14', 'n'),
(283, 11, 1, 1, '2016-07-30 01:49:14', 'n'),
(284, 12, 1, 1, '2016-07-30 01:49:14', 'n'),
(285, 13, 1, 1, '2016-07-30 01:49:14', 'n'),
(286, 14, 1, 1, '2016-07-30 01:49:14', 'n'),
(287, 15, 1, 1, '2016-07-30 01:49:14', 'n'),
(288, 16, 1, 1, '2016-07-30 01:49:14', 'n'),
(289, 17, 1, 1, '2016-07-30 01:49:14', 'n'),
(290, 18, 1, 1, '2016-07-30 01:49:14', 'n'),
(291, 19, 1, 1, '2016-07-30 01:49:14', 'n'),
(292, 20, 1, 1, '2016-07-30 01:49:14', 'n'),
(293, 21, 1, 1, '2016-07-30 01:49:14', 'n'),
(294, 21, 5, 1, '2016-07-30 01:52:17', 'n'),
(295, 1, 14, 1, '2016-07-30 02:02:15', 'n'),
(296, 2, 14, 1, '2016-07-30 02:02:15', 'n'),
(297, 3, 14, 1, '2016-07-30 02:02:15', 'n'),
(298, 4, 14, 1, '2016-07-30 02:02:15', 'n'),
(299, 5, 14, 1, '2016-07-30 02:02:15', 'n'),
(300, 6, 14, 1, '2016-07-30 02:02:15', 'n'),
(301, 7, 14, 1, '2016-07-30 02:02:15', 'n'),
(302, 8, 14, 1, '2016-07-30 02:02:15', 'n'),
(303, 9, 14, 1, '2016-07-30 02:02:15', 'n'),
(304, 10, 14, 1, '2016-07-30 02:02:15', 'n'),
(305, 11, 14, 1, '2016-07-30 02:02:15', 'n'),
(306, 12, 14, 1, '2016-07-30 02:02:15', 'n'),
(307, 13, 14, 1, '2016-07-30 02:02:15', 'n'),
(308, 14, 14, 1, '2016-07-30 02:02:15', 'n'),
(309, 15, 14, 1, '2016-07-30 02:02:15', 'n'),
(310, 16, 14, 1, '2016-07-30 02:02:15', 'n'),
(311, 17, 14, 1, '2016-07-30 02:02:15', 'n'),
(312, 18, 14, 1, '2016-07-30 02:02:15', 'n'),
(313, 19, 14, 1, '2016-07-30 02:02:15', 'n'),
(314, 20, 14, 1, '2016-07-30 02:02:15', 'n'),
(315, 21, 14, 1, '2016-07-30 02:02:15', 'n'),
(316, 2, 5, 3, '2016-07-30 04:04:34', 'n'),
(317, 21, 15, 1, '2016-07-30 13:36:11', 'n'),
(318, 21, 21, 1, '2016-07-30 13:36:16', 'n'),
(319, 21, 6, 1, '2016-07-30 13:36:26', 'n'),
(320, 1, 32, 3, '2016-07-30 16:33:36', 's'),
(321, 2, 32, 3, '2016-07-30 16:33:45', 's'),
(322, 2, 30, 3, '2016-07-30 16:34:03', 'n'),
(323, 1, 30, 3, '2016-07-30 16:34:11', 'n'),
(324, 1, 31, 3, '2016-07-30 16:34:23', 'n'),
(325, 2, 31, 3, '2016-07-30 16:34:34', 'n'),
(326, 1, 35, 3, '2016-07-30 17:05:53', 'n'),
(327, 2, 35, 3, '2016-07-30 17:05:53', 'n'),
(328, 3, 35, 3, '2016-07-30 17:05:53', 'n'),
(329, 4, 35, 3, '2016-07-30 17:05:53', 'n'),
(330, 5, 35, 3, '2016-07-30 17:05:53', 'n'),
(331, 6, 35, 3, '2016-07-30 17:05:53', 'n'),
(332, 7, 35, 3, '2016-07-30 17:05:53', 'n'),
(333, 8, 35, 3, '2016-07-30 17:05:53', 'n'),
(334, 9, 35, 3, '2016-07-30 17:05:53', 'n'),
(335, 10, 35, 3, '2016-07-30 17:05:53', 'n'),
(336, 11, 35, 3, '2016-07-30 17:05:53', 'n'),
(337, 12, 35, 3, '2016-07-30 17:05:53', 'n'),
(338, 13, 35, 3, '2016-07-30 17:05:53', 'n'),
(339, 14, 35, 3, '2016-07-30 17:05:53', 'n'),
(340, 15, 35, 3, '2016-07-30 17:05:53', 'n'),
(341, 16, 35, 3, '2016-07-30 17:05:53', 'n'),
(342, 17, 35, 3, '2016-07-30 17:05:53', 'n'),
(343, 18, 35, 3, '2016-07-30 17:05:53', 'n'),
(344, 19, 35, 3, '2016-07-30 17:05:53', 'n'),
(345, 20, 35, 3, '2016-07-30 17:05:53', 'n'),
(346, 21, 35, 3, '2016-07-30 17:05:53', 'n'),
(347, 1, 2, 3, '2016-07-30 17:11:23', 'n'),
(348, 21, 2, 3, '2016-07-30 17:11:23', 'n');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoriaproduto`
--

CREATE TABLE IF NOT EXISTS `categoriaproduto` (
  `codcategoria` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `categoriaproduto`
--

INSERT INTO `categoriaproduto` (`codcategoria`, `nome`, `dtcadastro`, `codfuncionario`) VALUES
(1, 'Desktop', '2016-07-25 13:26:36', 1),
(2, 'Notebook', '2016-07-25 13:26:36', 1),
(3, 'Servidor', '2016-07-25 13:26:36', 1),
(4, 'Monitor', '2016-07-25 13:26:36', 1),
(5, 'Thinclient', '2016-07-25 13:26:36', 1),
(6, 'Teclado', '2016-07-25 13:26:36', 1),
(7, 'Mouse', '2016-07-25 13:26:36', 1),
(8, 'GPS', '2016-07-25 13:26:36', 1),
(9, 'Celular', '2016-07-25 13:26:36', 1),
(10, 'CHIP', '2016-07-25 13:26:36', 1),
(11, 'Roteador', '2016-07-25 13:26:36', 1),
(12, 'Switch', '2016-07-25 13:26:36', 1),
(13, 'iPad', '2016-07-25 13:26:36', 1),
(14, 'Tablet', '2016-07-25 13:26:36', 1),
(15, 'Modem 3G/4G', '2016-07-25 13:26:36', 1),
(16, 'Coletor', '2016-07-25 13:26:36', 1),
(17, 'Rack', '2016-07-25 13:26:36', 1),
(18, 'Microfone', '2016-07-25 13:26:36', 1),
(19, 'DataShow', '2016-07-25 13:26:36', 1),
(20, 'Diversos', '2016-07-25 13:26:36', 1),
(21, 'Impressora', '2016-07-29 17:09:44', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidade`
--

CREATE TABLE IF NOT EXISTS `cidade` (
  `codcidade` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codestado` int(11) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `cidade`
--

INSERT INTO `cidade` (`codcidade`, `nome`, `codestado`, `dtcadastro`, `codfuncionario`) VALUES
(1, 'Bela Vista', 1, '2016-07-25 12:22:08', 0),
(2, 'Goiânia', 1, '2016-07-25 12:22:08', 0),
(3, 'Quirinópolis', 1, '2016-07-25 12:22:08', 0),
(4, 'Palminópilos', 1, '2016-07-25 12:22:08', 0),
(5, 'Orizona', 1, '2016-07-25 12:22:08', 0),
(6, 'Maravilha', 2, '2016-07-25 12:22:08', 0),
(7, 'Iraí', 3, '2016-07-25 12:22:08', 0),
(8, 'Santa Vitória', 3, '2016-07-25 12:22:08', 0),
(9, 'Gov. Valadares', 3, '2016-07-25 12:22:08', 0),
(10, 'Belo Horizonte', 3, '2016-07-25 12:22:08', 0),
(11, 'Curvelo', 3, '2016-07-25 12:22:08', 0),
(12, 'Teófilo Otoni', 3, '2016-07-25 12:22:08', 0),
(13, 'Nova Ramada', 4, '2016-07-25 12:22:08', 0),
(14, 'São Paulo', 5, '2016-07-25 12:22:08', 0),
(15, 'Rio de Janeiro', 6, '2016-07-25 12:22:08', 0),
(16, 'Itapejara', 7, '2016-07-25 12:22:21', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `coddepartamento` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `coddiretoria` int(11) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `departamento`
--

INSERT INTO `departamento` (`coddepartamento`, `nome`, `coddiretoria`, `dtcadastro`, `codfuncionario`) VALUES
(1, 'Tecnologia da Informação', 1, '2016-07-25 13:42:06', 0),
(2, 'Administrativo', 1, '2016-07-25 13:42:06', 0),
(3, 'Almoxarifado Central', 3, '2016-07-25 13:42:06', 0),
(4, 'Almoxarifado UHT', 3, '2016-07-25 13:42:06', 0),
(5, 'Ambulatório', 1, '2016-07-25 13:42:06', 0),
(6, 'Auditoria', 4, '2016-07-25 13:42:06', 0),
(7, 'Caldeira', 5, '2016-07-25 13:42:06', 0),
(8, 'Central de Cadastro', 1, '2016-07-25 13:42:06', 0),
(9, 'Comercial', 2, '2016-07-25 13:42:06', 0),
(10, 'Compras', 3, '2016-07-25 13:42:06', 0),
(11, 'Contabilidade', 1, '2016-07-25 13:42:48', 0),
(12, 'Diretoria', 0, '2016-07-25 13:42:48', 0),
(13, 'Engenharia e Projetos', 5, '2016-07-25 13:48:38', 0),
(14, 'Expedição Seca', 3, '2016-07-25 13:48:38', 0),
(15, 'Expedição Refrigerados', 3, '2016-07-25 13:48:38', 0),
(16, 'Fábrica LPO1', 3, '2016-07-25 13:48:38', 0),
(17, 'Fábrica LPO2', 3, '2016-07-25 13:48:38', 0),
(18, 'Fábrica Planta5', 3, '2016-07-25 13:48:38', 0),
(19, 'Fábrica Queijo', 3, '2016-07-25 13:48:38', 0),
(20, 'Fábrica UHT', 3, '2016-07-25 13:48:38', 0),
(21, 'Fábrica UHT Formulados', 3, '2016-07-25 13:48:38', 0),
(22, 'Faturamento', 3, '2016-07-25 13:48:38', 0),
(23, 'Financeiro', 1, '2016-07-25 13:48:38', 0),
(24, 'Garantia da Qualidade', 3, '2016-07-25 13:48:38', 0),
(25, 'Gestão de Pessoas', 1, '2016-07-25 13:48:38', 0),
(26, 'Jurídico', 1, '2016-07-25 13:48:38', 0),
(27, 'Laboratório UHT', 3, '2016-07-25 13:48:38', 0),
(28, 'Logística', 3, '2016-07-25 13:48:38', 0),
(29, 'Manutenção Central', 5, '2016-07-25 13:48:38', 0),
(30, 'Manutenção UHT', 5, '2016-07-25 13:48:38', 0),
(31, 'Marketing', 2, '2016-07-25 13:48:38', 0),
(32, 'Meio Ambiente', 5, '2016-07-25 13:48:38', 0),
(33, 'PCM', 5, '2016-07-25 13:48:38', 0),
(34, 'Plataforma', 3, '2016-07-25 13:48:38', 0),
(35, 'Política Leiteira', 6, '2016-07-25 13:48:38', 0),
(36, 'Portaria', 3, '2016-07-25 13:48:38', 0),
(37, 'Postos', 6, '2016-07-25 13:48:38', 0),
(38, 'Pró Campo', 6, '2016-07-25 13:48:38', 0),
(39, 'Processos', 1, '2016-07-25 13:48:38', 0),
(40, 'SAC', 2, '2016-07-25 13:48:38', 0),
(41, 'SESMT', 1, '2016-07-25 13:48:38', 0),
(42, 'SIF', 2, '2016-07-25 13:48:38', 0),
(43, 'Sup. Compra de Leite', 6, '2016-07-25 13:49:02', 0),
(44, 'Sup. Merchandising', 2, '2016-07-25 13:49:02', 0),
(45, 'Transporte', 6, '2016-07-25 13:49:11', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `diretoria`
--

CREATE TABLE IF NOT EXISTS `diretoria` (
  `coddiretoria` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `diretoria`
--

INSERT INTO `diretoria` (`coddiretoria`, `nome`, `dtcadastro`, `codfuncionario`) VALUES
(1, 'Diretoria Administrativa', '0000-00-00 00:00:00', 1),
(2, 'Diretoria Comercial', '0000-00-00 00:00:00', 1),
(3, 'Diretoria Operacional', '0000-00-00 00:00:00', 1),
(4, 'Diretoria de Relações Institucionais', '0000-00-00 00:00:00', 1),
(5, 'Diretoria Industrial', '0000-00-00 00:00:00', 1),
(6, 'Diretoria de Expansão', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `codempresa` int(11) NOT NULL,
  `razao` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logo` varchar(50) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `tipologradouro` varchar(20) NOT NULL,
  `logradouro` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `empresa`
--

INSERT INTO `empresa` (`codempresa`, `razao`, `telefone`, `dtcadastro`, `logo`, `cep`, `tipologradouro`, `logradouro`, `bairro`, `cidade`, `estado`, `numero`, `email`) VALUES
(1, 'Inventário Web', '(62)35518-000', '2016-07-25 14:09:28', '2016-07-291469847267.fw', '75240000', 'Rua', '01', 'Centro', 'Bela Vista de Goiás', 'GO', '10', 'dan.rezende@outlook.com'),
(2, 'Inventário Web', '', '2016-07-30 02:56:42', '', '', '', '', '', '', 'GO', '', 'dan.rezende@piracanjuba.com.br');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `codestado` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sigla` varchar(5) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `estado`
--

INSERT INTO `estado` (`codestado`, `nome`, `sigla`, `dtcadastro`, `codfuncionario`) VALUES
(1, 'Goiás', 'GO', '2016-07-25 12:13:43', 1),
(2, 'Santa Catarina', 'SC', '2016-07-25 12:13:43', 1),
(3, 'Minas Gerais', 'MG', '2016-07-25 12:14:08', 1),
(4, 'Rio Grande do Sul', 'RS', '2016-07-25 12:14:08', 1),
(5, 'São Paulo', 'SP', '2016-07-25 12:14:32', 1),
(6, 'Rio de Janeiro', 'RJ', '2016-07-25 12:14:32', 1),
(7, 'Paraná', 'PR', '2016-07-25 12:14:47', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `local`
--

CREATE TABLE IF NOT EXISTS `local` (
  `codlocal` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `local`
--

INSERT INTO `local` (`codlocal`, `nome`, `dtcadastro`, `codfuncionario`) VALUES
(1, 'Escritório', '2016-07-27 20:27:14', 1),
(2, 'Fábrica', '2016-07-27 20:28:56', 1),
(3, 'Pró Campo', '2016-07-27 20:29:02', 1),
(4, 'Matriz', '2016-07-27 20:29:13', 1),
(5, 'Posto', '2016-07-27 20:29:20', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `localcidade`
--

CREATE TABLE IF NOT EXISTS `localcidade` (
  `codlc` int(11) NOT NULL,
  `codlocal` int(11) NOT NULL,
  `codcidade` int(11) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `localcidade`
--

INSERT INTO `localcidade` (`codlc`, `codlocal`, `codcidade`, `dtcadastro`, `codfuncionario`) VALUES
(1, 0, 0, '2016-07-27 20:52:01', 1),
(2, 0, 0, '2016-07-27 20:52:21', 1),
(4, 1, 2, '2016-07-27 20:55:39', 1),
(5, 2, 1, '2016-07-27 20:55:55', 1),
(6, 3, 1, '2016-07-27 20:56:00', 1),
(7, 4, 1, '2016-07-27 20:56:04', 1),
(8, 5, 3, '2016-07-27 20:56:13', 1),
(9, 5, 4, '2016-07-27 20:56:30', 1),
(10, 5, 5, '2016-07-27 20:56:38', 1),
(11, 5, 7, '2016-07-27 20:56:42', 1),
(12, 5, 8, '2016-07-27 20:56:48', 1),
(13, 5, 11, '2016-07-27 20:56:58', 1),
(14, 5, 12, '2016-07-27 20:57:04', 1),
(15, 5, 13, '2016-07-27 20:57:10', 1),
(16, 5, 16, '2016-07-27 20:57:16', 1),
(17, 1, 15, '2016-07-27 20:57:34', 1),
(18, 1, 14, '2016-07-27 20:57:41', 1),
(19, 1, 10, '2016-07-27 20:57:56', 1),
(20, 2, 9, '2016-07-27 20:58:12', 1),
(21, 3, 9, '2016-07-27 20:58:16', 1),
(22, 2, 6, '2016-07-27 20:58:28', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `codlog` int(11) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL DEFAULT '1',
  `observacao` text CHARACTER SET utf8 NOT NULL,
  `codproduto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `log`
--

INSERT INTO `log` (`codlog`, `dtcadastro`, `codfuncionario`, `observacao`, `codproduto`) VALUES
(6, '2016-07-28 19:06:54', 1, ' - Atributo: Modelo - Valor Antes: samsung... - Valor Novo: samsung....<br>', 3),
(7, '2016-07-28 19:09:47', 1, ' - Atributo: Outros - Valor Antes:  - Valor Novo: teste<br>', 4),
(8, '2016-07-29 03:55:25', 1, 'Atributo salvo: Fabricante - tamanho: 50 - tipo: select - mascara:  - lista: Dell, Microsoft, Lenovo, Apple, Samsung, Cisco, Mikrotik, Ubiquit, LG, ', 0),
(9, '2016-07-29 03:57:44', 1, ' - Atributo: CODESTADO - Valor Antes:  - Valor Novo: 1<br> - Atributo: CODCIDADE - Valor Antes:  - Valor Novo: 1<br> - Atributo: CODLOCAL - Valor Antes:  - Valor Novo: 2<br> - Atributo: CODDEPARTAMENTO - Valor Antes:  - Valor Novo: 1<br> - Atributo: CODCATEGORIA - Valor Antes:  - Valor Novo: 2<br>', 5),
(10, '2016-07-29 04:02:13', 1, ' - Atributo: Serial - Valor Antes:  - Valor Novo: XXX<br> - Atributo: Data Compra - Valor Antes:  - Valor Novo: 2016-07-05<br>', 5),
(11, '2016-07-29 14:14:54', 1, 'Atributo salvo: Outros - tamanho: 11 - tipo: varchar - mascara: texto - lista: ', 0),
(12, '2016-07-29 14:18:09', 1, 'Atributo salvo: Outros - tamanho: 11 - tipo: text - mascara: texto - lista: ', 0),
(13, '2016-07-29 14:38:01', 1, ' - Atributo: Outros - Valor Antes:  - Valor Novo: <p>Teste</p><br>', 5),
(14, '2016-07-29 15:55:30', 1, ' - Atributo: Serial - Valor Antes: XXX - Valor Novo: ABCDE<br>', 5),
(15, '2016-07-29 16:08:00', 1, ' - Atributo: cidade - Valor Antes: Itapejara - Valor Novo: Iraí<br> - Atributo: Outros - Valor Antes: 535 - Valor Novo: <p>535</p><br>', 3),
(16, '2016-07-29 17:09:44', 1, 'Categoria produto salvo: Impressora', 0),
(17, '2016-07-29 17:11:18', 1, 'Categoria produto salvo: ssssssss', 0),
(18, '2016-07-29 17:52:08', 1, 'Atributo salvo: AUTO CAD - tamanho:  - tipo:  - mascara:  - lista: ', 0),
(19, '2016-07-29 19:04:18', 1, 'Nivel salvo: ', 0),
(20, '2016-07-30 01:46:04', 1, ' - Atributo: Estado - Valor Antes: Paraná - Valor Novo: Goiás<br> - Atributo: Cidade - Valor Antes: Iraí - Valor Novo: Bela Vista<br> - Atributo: Local - Valor Antes:  - Valor Novo: Fábrica<br> - Atributo: Departamento - Valor Antes: Almoxarifado Central - Valor Novo: Administrativo<br> - Atributo: Utilizador - Valor Antes:  - Valor Novo: Usuário X<br> - Atributo: Fabricante - Valor Antes:  - Valor Novo: Apple<br> - Atributo: Modelo - Valor Antes: samsung.... - Valor Novo: iPhone 6S<br>', 3),
(21, '2016-07-30 01:46:35', 1, ' - Atributo: Outros - Valor Antes: <p>535</p> - Valor Novo: aa<br>', 3),
(22, '2016-07-30 01:48:14', 1, 'Atributo salvo: Patrimônio - tamanho: 6 - tipo: int - mascara: inteiro - lista: ', 0),
(23, '2016-07-30 02:03:50', 1, 'Atributo salvo: Office - tamanho: 50 - tipo: select - mascara:  - lista: 2016, 2013, 2010, 2007, 2003', 0),
(24, '2016-07-30 02:06:22', 1, 'Atributo salvo: Processador - tamanho: 50 - tipo: select - mascara:  - lista: i7, i5, i3, QuadCore, Core2Duo, DualCore, Celeron, Xeon', 0),
(25, '2016-07-30 02:07:22', 1, 'Atributo salvo: AutoCad - tamanho: 11 - tipo: select - mascara:  - lista: 2017, 2016, 2015, 2014, 2013, 2012, 2011, 2010, 2009, 2008, 2007, 2006', 0),
(26, '2016-07-30 02:07:56', 1, 'Atributo salvo: MS Project - tamanho: 50 - tipo: select - mascara:  - lista: 2016, 2013, 2010, 2007', 0),
(27, '2016-07-30 02:08:55', 1, 'Atributo salvo: HD - tamanho: 11 - tipo: select - mascara:  - lista: 2TB, 1TB, 750GB, 500GB, 480SSD, 320GB, 250GB, 240SSD, 120SSD, 80GB', 0),
(28, '2016-07-30 02:09:44', 1, 'Atributo salvo: Nota Fiscal - tamanho: 11 - tipo: file - mascara:  - lista: ', 0),
(29, '2016-07-30 02:09:54', 1, 'Atributo salvo: Licenças - tamanho: 11 - tipo: file - mascara:  - lista: ', 0),
(30, '2016-07-30 03:51:23', 3, ' - Atributo: Patrimônio - Valor Antes: 35 - Valor Novo: 00236599999<br>', 3),
(31, '2016-07-30 03:51:57', 3, ' - Atributo: Serial - Valor Antes: 12345678 - Valor Novo: 252525<br>', 3),
(32, '2016-07-30 03:52:29', 3, ' - Atributo: Data Compra - Valor Antes: 2016-07-26 - Valor Novo: 2016-04-06<br>', 3),
(33, '2016-07-30 03:53:57', 3, ' - Atributo: Serial - Valor Antes:  - Valor Novo: XXAAXX<br> - Atributo: HD - Valor Antes: 480GB - Valor Novo: 240SSD<br>', 4),
(34, '2016-07-30 03:54:07', 3, ' - Atributo: Outros - Valor Antes: teste - Valor Novo: Teste para deixar comentário no Ativo.<br>', 4),
(35, '2016-07-30 03:57:53', 3, 'Atributo salvo: Serial / TAG - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(36, '2016-07-30 16:32:42', 3, 'Atributo salvo: S.O - tamanho: 11 - tipo: select - mascara:  - lista: Windows 10, Windows 8.1, Windows 8, Windows 7, Windows XP, Linux, Windows Server 2003, Windows Server 2008 R2, Windows Server 2008, Windows Server 2012, Windows Server 2012 R2, Windows Server 2016', 0),
(37, '2016-07-30 16:37:21', 3, ' - Atributo: Serial / TAG - Valor Antes: ABCDE - Valor Novo: D11DCD2<br> - Atributo: HD - Valor Antes: 240GB - Valor Novo: 240SSD<br> - Atributo: Nota Fiscal - Valor Antes:  - Valor Novo: 2016-07-301469896641.png<br>', 5),
(38, '2016-07-30 16:39:22', 3, 'Atributo salvo: Serial / TAG - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(39, '2016-07-30 16:39:40', 3, 'Atributo salvo: Utilizador - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(40, '2016-07-30 16:40:27', 3, 'Atributo salvo: S.O - tamanho: 11 - tipo: select - mascara:  - lista: Windows 10, Windows 8.1, Windows 8, Windows 7, Windows XP, Linux, Windows Server 2003, Windows Server 2008 R2, Windows Server 2008, Windows Server 2012, Windows Server 2012 R2, Windows Server 2016', 0),
(41, '2016-07-30 16:40:40', 3, 'Atributo salvo: Outros - tamanho: 11 - tipo: text - mascara: texto - lista: ', 0),
(42, '2016-07-30 16:40:50', 3, 'Atributo salvo: Office - tamanho: 50 - tipo: select - mascara:  - lista: 2016, 2013, 2010, 2007, 2003', 0),
(43, '2016-07-30 16:41:09', 3, 'Atributo salvo: Nota Fiscal - tamanho: 11 - tipo: file - mascara:  - lista: ', 0),
(44, '2016-07-30 16:41:20', 3, 'Atributo salvo: Licenças - tamanho: 11 - tipo: file - mascara:  - lista: ', 0),
(45, '2016-07-30 16:43:35', 3, 'Atributo salvo: Processador - tamanho: 50 - tipo: select - mascara:  - lista: i7, i5, i3, QuadCore, Core2Duo, DualCore, Celeron, Xeon', 0),
(46, '2016-07-30 16:43:43', 3, 'Atributo salvo: HD - tamanho: 11 - tipo: select - mascara:  - lista: 2TB, 1TB, 750GB, 500GB, 480SSD, 320GB, 250GB, 240SSD, 120SSD, 80GB', 0),
(47, '2016-07-30 16:43:52', 3, 'Atributo salvo: Memória RAM - tamanho: 11 - tipo: select - mascara:  - lista: 1GB, 2GB, 4GB, 8GB, 16GB, 32GB, 64GB, 128GB, 256GB, 512GB', 0),
(48, '2016-07-30 16:44:26', 3, 'Atributo salvo: Tempo de Uso - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(49, '2016-07-30 16:44:33', 3, 'Atributo salvo: Status Garantia - tamanho: 11 - tipo: date - mascara:  - lista: ', 0),
(50, '2016-07-30 16:45:06', 1, 'Atributo salvo: Marca - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(51, '2016-07-30 16:45:07', 3, 'Atributo salvo: Nome - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(52, '2016-07-30 16:45:17', 3, 'Atributo salvo: Serial / TAG - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(53, '2016-07-30 16:45:24', 3, 'Atributo salvo: Patrimônio - tamanho: 6 - tipo: int - mascara: inteiro - lista: ', 0),
(54, '2016-07-30 16:46:02', 3, 'Atributo salvo: Utilizador - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(55, '2016-07-30 16:46:21', 3, 'Atributo salvo: Utilizador - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(56, '2016-07-30 16:46:31', 3, 'Atributo salvo: S.O - tamanho: 11 - tipo: select - mascara:  - lista: Windows 10, Windows 8.1, Windows 8, Windows 7, Windows XP, Linux, Windows Server 2003, Windows Server 2008 R2, Windows Server 2008, Windows Server 2012, Windows Server 2012 R2, Windows Server 2016', 0),
(57, '2016-07-30 16:46:42', 3, 'Atributo salvo: Office - tamanho: 50 - tipo: select - mascara:  - lista: 2016, 2013, 2010, 2007, 2003', 0),
(58, '2016-07-30 16:49:24', 3, 'Atributo salvo: Fabricante - tamanho: 50 - tipo: select - mascara:  - lista: Dell, Microsoft, Lenovo, Apple, Samsung, Cisco, Mikrotik, Ubiquit, LG, ', 0),
(59, '2016-07-30 16:50:24', 3, 'Atributo salvo: Patrimônio - tamanho: 6 - tipo: int - mascara: inteiro - lista: ', 0),
(60, '2016-07-30 16:50:32', 3, 'Atributo salvo: Serial / TAG - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(61, '2016-07-30 16:50:55', 3, 'Atributo salvo: S.O - tamanho: 11 - tipo: select - mascara:  - lista: Windows 10, Windows 8.1, Windows 8, Windows 7, Windows XP, Linux, Windows Server 2003, Windows Server 2008 R2, Windows Server 2008, Windows Server 2012, Windows Server 2012 R2, Windows Server 2016', 0),
(62, '2016-07-30 16:51:04', 3, 'Atributo salvo: Office - tamanho: 50 - tipo: select - mascara:  - lista: 2016, 2013, 2010, 2007, 2003', 0),
(63, '2016-07-30 16:51:19', 3, 'Atributo salvo: Modelo - tamanho: 50 - tipo: varchar - mascara:  - lista: ', 0),
(64, '2016-07-30 16:52:09', 3, 'Atributo salvo: S.O - tamanho: 11 - tipo: select - mascara:  - lista: Windows 10, Windows 8.1, Windows 8, Windows 7, Windows XP, Linux, Windows Server 2003, Windows Server 2008 R2, Windows Server 2008, Windows Server 2012, Windows Server 2012 R2, Windows Server 2016', 0),
(65, '2016-07-30 16:52:18', 3, 'Atributo salvo: Office - tamanho: 50 - tipo: select - mascara:  - lista: 2016, 2013, 2010, 2007, 2003', 0),
(66, '2016-07-30 16:52:36', 3, 'Atributo salvo: Processador - tamanho: 50 - tipo: select - mascara:  - lista: i7, i5, i3, QuadCore, Core2Duo, DualCore, Celeron, Xeon', 0),
(67, '2016-07-30 16:52:51', 3, 'Atributo salvo: Memória RAM - tamanho: 11 - tipo: select - mascara:  - lista: 1GB, 2GB, 4GB, 8GB, 16GB, 32GB, 64GB, 128GB, 256GB, 512GB', 0),
(68, '2016-07-30 16:53:04', 3, 'Atributo salvo: HD - tamanho: 11 - tipo: select - mascara:  - lista: 2TB, 1TB, 750GB, 500GB, 480SSD, 320GB, 250GB, 240SSD, 120SSD, 80GB', 0),
(69, '2016-07-30 16:54:07', 3, 'Atributo salvo: VGA - tamanho: 50 - tipo: select - mascara:  - lista: Onboard, 2GB, 1GB, 512, N/A', 0),
(70, '2016-07-30 16:54:18', 3, 'Atributo salvo: VGA - tamanho: 50 - tipo: select - mascara:  - lista: Onboard, 2GB, 1GB, 512, N/A', 0),
(71, '2016-07-30 16:54:55', 3, 'Atributo salvo: S.O - tamanho: 11 - tipo: select - mascara:  - lista: Windows 10, Windows 8.1, Windows 8, Windows 7, Windows XP, Linux, Windows Server 2003, Windows Server 2008 R2, Windows Server 2008, Windows Server 2012, Windows Server 2012 R2, Windows Server 2016', 0),
(72, '2016-07-30 16:55:03', 3, 'Atributo salvo: Office - tamanho: 50 - tipo: select - mascara:  - lista: 2016, 2013, 2010, 2007, 2003', 0),
(73, '2016-07-30 16:55:28', 3, 'Atributo salvo: AutoCad - tamanho: 11 - tipo: select - mascara:  - lista: 2017, 2016, 2015, 2014, 2013, 2012, 2011, 2010, 2009, 2008, 2007, 2006', 0),
(74, '2016-07-30 16:55:41', 3, 'Atributo salvo: MS Project - tamanho: 50 - tipo: select - mascara:  - lista: 2016, 2013, 2010, 2007', 0),
(75, '2016-07-30 17:00:20', 3, 'Atributo salvo: Tamanho Tela - tamanho: 11 - tipo: varchar - mascara:  - lista: ', 0),
(76, '2016-07-30 17:00:34', 3, 'Atributo salvo: Data Compra - tamanho: 11 - tipo: date - mascara: data - lista: ', 0),
(77, '2016-07-30 17:00:46', 3, 'Atributo salvo: Endereço IP - tamanho: 15 - tipo: varchar - mascara: enderecoip - lista: ', 0),
(78, '2016-07-30 17:00:53', 3, 'Atributo salvo: MAC Adress - tamanho: 30 - tipo: varchar - mascara:  - lista: ', 0),
(79, '2016-07-30 17:01:14', 3, 'Atributo salvo: Documentos - tamanho: 11 - tipo: varchar - mascara:  - lista: ', 0),
(80, '2016-07-30 17:01:20', 3, 'Atributo salvo: Operadora - tamanho: 11 - tipo: select - mascara:  - lista: TIM, VIVO, Claro, OI, GVT', 0),
(81, '2016-07-30 17:02:46', 3, 'Atributo salvo: Informações Técnicas - tamanho: 400 - tipo: text - mascara:  - lista: ', 0),
(82, '2016-07-30 17:10:57', 3, ' - Atributo: Serial / TAG - Valor Antes: XXAAXX - Valor Novo: DX6Y8S1<br> - Atributo: Outros - Valor Antes: Teste para deixar comentário no Ativo. - Valor Novo: <p>Teste para deixar coment&aacute;rio no Ativo.</p><br>', 4),
(83, '2016-07-30 17:12:08', 3, ' - Atributo: Data Compra - Valor Antes: 2012-03-15 - Valor Novo: 20/12/<br>', 4),
(84, '2016-07-30 17:14:18', 3, ' - Atributo: Modelo - Valor Antes: Vostro 260. - Valor Novo: Vostro 260<br> - Atributo: Data Compra - Valor Antes: 20/12/ - Valor Novo: 15/03/2012<br> - Atributo: Outros - Valor Antes: <p>Teste para deixar coment&aacute;rio no Ativo.</p> - Valor Novo: <p>Em Novembro de 2015, foi trocado o HD de 500GB, por um SSD de 240GB.</p><br> - Atributo: S.O - Valor Antes:  - Valor Novo: Windows 10<br> - Atributo: Informações Técnicas - Valor Antes: Última formação em 10/10/2015 - Valor Novo: Última formação em 10/10/2015.<br>', 4),
(85, '2016-07-30 17:15:44', 3, 'Atributo salvo: MS Project - tamanho: 50 - tipo: select - mascara:  - lista: 2016, 2013, 2010, 2007, Não Utiliza', 0),
(86, '2016-07-30 17:15:52', 3, 'Atributo salvo: AutoCad - tamanho: 11 - tipo: select - mascara:  - lista: 2017, 2016, 2015, 2014, 2013, 2012, 2011, 2010, 2009, 2008, 2007, 2006, Não Utiliza', 0),
(87, '2016-07-30 17:16:47', 3, ' - Atributo: AutoCad - Valor Antes:  - Valor Novo: Não Utiliza<br> - Atributo: MS Project - Valor Antes:  - Valor Novo: Não Utiliza<br>', 4),
(88, '2016-07-30 17:28:36', 1, ' - Atributo: Data Compra - Valor Antes: 2016-07-05 - Valor Novo: 20/16/<br>', 5),
(89, '2016-07-30 17:33:55', 1, ' - Atributo: Codestado - Valor Antes:  - Valor Novo: 1<br> - Atributo: Codcidade - Valor Antes:  - Valor Novo: 5<br> - Atributo: Codlocal - Valor Antes:  - Valor Novo: 5<br> - Atributo: Coddepartamento - Valor Antes:  - Valor Novo: 5<br> - Atributo: Codcategoria - Valor Antes:  - Valor Novo: 20<br>', 7),
(90, '2016-07-30 17:43:33', 1, ' - Atributo: Data Compra - Valor Antes: 20/16/ - Valor Novo: 30/07/2016<br>', 5),
(91, '2016-07-30 17:47:34', 1, ' - Atributo: Data Compra - Valor Antes: 30/07/2016 - Valor Novo: 2016-07-30<br>', 5),
(92, '2016-07-30 17:49:17', 1, ' - Atributo: Data Compra - Valor Antes: 15/03/2012 - Valor Novo: 2015-12-31<br>', 4),
(93, '2016-07-30 17:49:43', 3, ' - Atributo: Data Compra - Valor Antes: 2016-07-30 - Valor Novo: -16-20<br>', 5),
(94, '2016-07-30 17:50:06', 3, ' - Atributo: Data Compra - Valor Antes: -16-20 - Valor Novo: 2016-07-05<br>', 5),
(95, '2016-07-30 17:51:13', 3, ' - Atributo: Data Compra - Valor Antes: 2015-12-31 - Valor Novo: 2012-03-15<br>', 4),
(96, '2016-07-30 17:56:59', 1, 'Produto salvo: Categoria: Microfone - Local: Posto - Estado: Goiás - Cidade:  - Departamento: Caldeira', 8),
(97, '2016-07-30 17:57:10', 3, 'Produto salvo: Categoria: Notebook - Local: Fábrica - Estado: Goiás - Cidade:  - Departamento: Tecnologia da Informação', 9),
(98, '2016-07-30 18:22:57', 1, ' - Atributo: Statusproduto - Valor Antes: Ativo - Valor Novo: Descartado<br>', 9),
(99, '2016-07-30 18:26:14', 1, ' - Atributo: Status - Valor Antes: Descartado - Valor Novo: Ativo<br>', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `codmodulo` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `icone` varchar(30) NOT NULL,
  `codfuncionario` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `modulo`
--

INSERT INTO `modulo` (`codmodulo`, `nome`, `titulo`, `icone`, `codfuncionario`) VALUES
(8, 'Painel Master', 'Painel controle principal', 'fa-dashboard', 1),
(9, 'Cadastro', 'Formulário de cadastramento em geral', 'fa-edit', 1),
(11, 'Relatório', 'Relatórios gerais para o sistema', 'fa-file-o', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel`
--

CREATE TABLE IF NOT EXISTS `nivel` (
  `codnivel` int(11) NOT NULL,
  `dtcadastro` datetime NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codempresa` int(11) NOT NULL DEFAULT '0',
  `codfuncionario` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `nivel`
--

INSERT INTO `nivel` (`codnivel`, `dtcadastro`, `nome`, `codempresa`, `codfuncionario`) VALUES
(1, '2015-03-08 00:00:00', 'Administrador', 1, 1),
(3, '2016-07-29 23:11:56', 'Visualizador', 0, 1),
(4, '2016-07-29 23:38:09', 'Analista', 0, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivelpagina`
--

CREATE TABLE IF NOT EXISTS `nivelpagina` (
  `codnivel` int(11) NOT NULL,
  `codpagina` int(11) NOT NULL,
  `inserir` int(11) NOT NULL DEFAULT '0',
  `atualizar` int(11) NOT NULL DEFAULT '0',
  `excluir` int(11) NOT NULL DEFAULT '0',
  `procurar` int(11) NOT NULL DEFAULT '0',
  `mostrar` int(11) NOT NULL DEFAULT '0',
  `gerapdf` int(11) NOT NULL DEFAULT '0',
  `geraexcel` int(11) NOT NULL DEFAULT '0',
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `nivelpagina`
--

INSERT INTO `nivelpagina` (`codnivel`, `codpagina`, `inserir`, `atualizar`, `excluir`, `procurar`, `mostrar`, `gerapdf`, `geraexcel`, `dtcadastro`) VALUES
(1, 4, 1, 1, 1, 1, 1, 1, 1, '2016-07-26 18:56:08'),
(1, 12, 1, 1, 1, 1, 1, 1, 1, '2016-07-26 18:56:08'),
(1, 93, 1, 1, 1, 1, 1, 1, 1, '2016-07-26 18:56:08'),
(1, 94, 1, 1, 1, 1, 1, 1, 1, '2016-07-26 18:56:08'),
(1, 95, 1, 1, 1, 1, 1, 1, 1, '2016-07-26 18:56:08'),
(1, 96, 1, 1, 1, 1, 1, 1, 1, '2016-07-26 18:56:08'),
(1, 97, 1, 1, 1, 1, 1, 1, 1, '2016-07-26 18:56:08'),
(1, 98, 1, 1, 1, 1, 1, 1, 1, '2016-07-26 18:56:08'),
(2, 4, 1, 1, 1, 1, 1, 1, 1, '2016-07-29 19:02:57'),
(2, 12, 1, 1, 1, 1, 1, 1, 1, '2016-07-29 19:02:57'),
(2, 93, 1, 1, 1, 1, 1, 1, 1, '2016-07-29 19:02:57'),
(2, 94, 1, 1, 1, 1, 1, 1, 1, '2016-07-29 19:02:57'),
(2, 95, 1, 1, 1, 1, 1, 1, 1, '2016-07-29 19:02:57'),
(2, 96, 1, 1, 1, 1, 1, 1, 1, '2016-07-29 19:02:57'),
(2, 97, 1, 1, 1, 1, 1, 1, 1, '2016-07-29 19:02:57'),
(2, 98, 1, 1, 1, 1, 1, 1, 1, '2016-07-29 19:02:57'),
(3, 4, 0, 0, 0, 1, 0, 1, 1, '2016-07-30 15:54:00'),
(3, 93, 0, 0, 0, 1, 1, 1, 1, '2016-07-30 15:54:00'),
(3, 94, 0, 0, 0, 1, 0, 1, 1, '2016-07-30 15:54:00'),
(3, 95, 0, 0, 0, 1, 0, 1, 1, '2016-07-30 15:54:00'),
(3, 96, 0, 0, 0, 1, 1, 1, 1, '2016-07-30 15:54:00'),
(3, 97, 0, 0, 0, 1, 0, 1, 1, '2016-07-30 15:54:00'),
(4, 4, 1, 1, 0, 1, 1, 1, 1, '2016-07-30 14:42:21'),
(4, 93, 1, 1, 0, 1, 1, 1, 1, '2016-07-30 14:42:21'),
(4, 94, 1, 1, 0, 1, 1, 1, 1, '2016-07-30 14:42:21'),
(4, 95, 1, 1, 0, 1, 1, 1, 1, '2016-07-30 14:42:21'),
(4, 96, 1, 0, 1, 1, 1, 1, 1, '2016-07-30 14:42:21'),
(4, 97, 1, 1, 0, 1, 1, 1, 1, '2016-07-30 14:42:21'),
(6, 4, 1, 1, 1, 1, 1, 0, 0, '0000-00-00 00:00:00'),
(6, 12, 1, 1, 1, 1, 1, 0, 0, '0000-00-00 00:00:00'),
(12, 4, 0, 0, 0, 1, 1, 1, 1, '0000-00-00 00:00:00'),
(12, 12, 0, 0, 0, 1, 1, 1, 1, '0000-00-00 00:00:00'),
(13, 4, 0, 0, 0, 1, 1, 1, 1, '0000-00-00 00:00:00'),
(13, 12, 0, 0, 0, 1, 1, 1, 1, '0000-00-00 00:00:00'),
(15, 4, 1, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00'),
(15, 12, 1, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagina`
--

CREATE TABLE IF NOT EXISTS `pagina` (
  `codpagina` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `link` varchar(250) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `codmodulo` int(11) NOT NULL DEFAULT '0',
  `icone` varchar(30) NOT NULL,
  `abreaolado` set('s','n') NOT NULL DEFAULT 'n',
  `codpai` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `pagina`
--

INSERT INTO `pagina` (`codpagina`, `nome`, `link`, `titulo`, `codmodulo`, `icone`, `abreaolado`, `codpai`) VALUES
(4, 'Usuários', 'Pessoa.php', 'Cadastro de pessoas', 9, 'fa-user', 'n', 0),
(12, 'Configuração', 'Nivel.php', 'Controle de acesso por nível', 8, 'fa-wrench', 'n', 0),
(93, 'Ativos', 'Produto.php', 'Cadastro de Ativos', 9, 'fa-desktop', 'n', 0),
(94, 'Filiais', 'Localidade.php', 'Cadastro de Filiais', 9, ' fa-location-arrow', 'n', 0),
(95, 'Atributos', 'Atributo.php', 'Atributo para categoria', 9, 'fa-cogs', 'n', 0),
(96, 'Histórico', 'Log.php', 'Log de alterações - Histórico', 11, ' fa-history', 'n', 0),
(97, 'Departamentos', 'Escritorio.php', 'Cadastro Diretoria e Departamento', 9, ' fa-briefcase', 'n', 0),
(98, 'Nossa Empresa', 'NossaEmpresa.php', 'Nossa Empresa', 8, 'fa-building-o', 'n', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `codpessoa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codnivel` int(11) NOT NULL,
  `coddepartamento` int(11) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL DEFAULT '1',
  `email` varchar(150) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `codempresa` int(11) NOT NULL,
  `imagem` varchar(50) NOT NULL,
  `status` set('a','i') NOT NULL DEFAULT 'a',
  `cpf` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `pessoa`
--

INSERT INTO `pessoa` (`codpessoa`, `nome`, `codnivel`, `coddepartamento`, `dtcadastro`, `codfuncionario`, `email`, `login`, `senha`, `codempresa`, `imagem`, `status`, `cpf`) VALUES
(1, 'Thyago H, Pacher', 1, 1, '2016-07-25 14:16:27', 1, 'thyago.pacher@gmail.com', 'thyagopacher', 'YnJhc2ls', 1, '2016-07-301469886060.jpg', 'a', ''),
(3, 'Dan El Pierre Rezende', 1, 0, '2016-07-26 23:13:59', 1, 'dan.rezende@outlook.com', '', 'MTIzNDU2', 1, '2016-07-301469886672.png', 'a', ''),
(4, 'visualiza', 3, 0, '2016-07-30 15:27:39', 3, 'nao@nao.com', 'visualiza', 'dmlzdWFsaXph', 1, '', 'a', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `codproduto` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL,
  `codstatus` int(11) NOT NULL DEFAULT '1',
  `codcategoria` int(11) NOT NULL,
  `codestado` int(11) NOT NULL,
  `codcidade` int(11) NOT NULL,
  `coddepartamento` int(11) NOT NULL,
  `codlocal` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `produto`
--

INSERT INTO `produto` (`codproduto`, `nome`, `dtcadastro`, `codfuncionario`, `codstatus`, `codcategoria`, `codestado`, `codcidade`, `coddepartamento`, `codlocal`) VALUES
(4, '', '2016-07-28 12:41:13', 1, 1, 1, 1, 1, 1, 2),
(5, '', '2016-07-29 03:57:44', 1, 1, 2, 1, 1, 1, 2),
(6, '', '2016-07-30 17:33:00', 1, 1, 20, 1, 5, 5, 5),
(8, '', '2016-07-30 17:56:59', 1, 1, 18, 1, 5, 7, 5),
(9, '', '2016-07-30 17:57:09', 3, 1, 2, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `programa`
--

CREATE TABLE IF NOT EXISTS `programa` (
  `codprograma` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `programa`
--

INSERT INTO `programa` (`codprograma`, `nome`, `dtcadastro`, `codfuncionario`) VALUES
(1, 'Windows XP', '2016-07-25 12:09:04', 1),
(2, 'Windows 7', '2016-07-25 12:09:04', 1),
(3, 'Windows 8', '2016-07-25 12:11:03', 1),
(4, 'Windows 8.1', '2016-07-25 12:11:03', 1),
(5, 'Windows 10', '2016-07-25 12:11:15', 1),
(6, 'Office 2003', '2016-07-25 12:28:00', 1),
(7, 'Office 2007', '2016-07-25 12:28:00', 1),
(8, 'Office 2010', '2016-07-25 12:28:00', 1),
(9, 'Office 2013', '2016-07-25 12:28:00', 1),
(10, 'Office 2016', '2016-07-25 12:28:00', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `statusproduto`
--

CREATE TABLE IF NOT EXISTS `statusproduto` (
  `codstatus` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL DEFAULT '1',
  `cor` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `statusproduto`
--

INSERT INTO `statusproduto` (`codstatus`, `nome`, `dtcadastro`, `codfuncionario`, `cor`) VALUES
(1, 'Ativo', '2016-07-25 11:59:14', 1, '#a6ffa6'),
(2, 'Descartado', '2016-07-25 11:59:14', 1, '#ffaaaa'),
(3, 'Em Reparo', '2016-07-28 12:23:06', 1, '#ffff6c');

-- --------------------------------------------------------

--
-- Estrutura para tabela `valorproduto`
--

CREATE TABLE IF NOT EXISTS `valorproduto` (
  `codvalor` int(11) NOT NULL,
  `codproduto` int(11) NOT NULL,
  `codatributo` int(11) NOT NULL,
  `valor` text NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `valorproduto`
--

INSERT INTO `valorproduto` (`codvalor`, `codproduto`, `codatributo`, `valor`, `dtcadastro`, `codfuncionario`) VALUES
(1, 3, 2, '00236599999', '2016-07-26 17:36:02', 1),
(2, 3, 3, '252525', '2016-07-26 17:36:02', 1),
(3, 3, 7, 'iPhone 6S', '2016-07-26 17:36:02', 1),
(4, 3, 15, '2016-04-06', '2016-07-26 17:36:02', 1),
(5, 3, 16, '35345', '2016-07-26 17:36:02', 1),
(6, 3, 18, '', '2016-07-26 17:36:02', 1),
(7, 3, 19, '', '2016-07-26 17:36:02', 1),
(8, 3, 20, '15', '2016-07-26 17:36:02', 1),
(9, 3, 25, 'aa', '2016-07-26 17:36:02', 1),
(10, 3, 29, '2016-07-261469557199.png', '2016-07-26 18:04:03', 1),
(11, 4, 2, '001968', '2016-07-28 12:41:13', 1),
(12, 4, 3, 'DX6Y8S1', '2016-07-28 12:41:13', 1),
(13, 4, 7, 'Vostro 260', '2016-07-28 12:41:13', 1),
(14, 4, 15, '2012-03-15', '2016-07-28 12:41:13', 1),
(15, 4, 16, '', '2016-07-28 12:41:13', 1),
(16, 4, 20, '', '2016-07-28 12:41:13', 1),
(17, 4, 25, '<p>Em Novembro de 2015, foi trocado o HD de 500GB, por um SSD de 240GB.</p>', '2016-07-28 12:41:13', 1),
(18, 4, 29, '', '2016-07-28 12:41:13', 1),
(19, 4, 10, '240SSD', '2016-07-28 15:28:40', 1),
(20, 4, 11, '4GB', '2016-07-28 15:28:40', 1),
(21, 5, 1, '01ADM256', '2016-07-29 03:57:44', 1),
(22, 5, 2, '004142', '2016-07-29 03:57:44', 1),
(23, 5, 3, 'D11DCD2', '2016-07-29 03:57:44', 1),
(24, 5, 6, 'Dell', '2016-07-29 03:57:44', 1),
(25, 5, 7, 'Vostro 5480', '2016-07-29 03:57:44', 1),
(26, 5, 9, 'i5', '2016-07-29 03:57:44', 1),
(27, 5, 10, '240SSD', '2016-07-29 03:57:44', 1),
(28, 5, 11, '4GB', '2016-07-29 03:57:44', 1),
(29, 5, 13, '2016', '2016-07-29 03:57:44', 1),
(30, 5, 15, '2016-07-05', '2016-07-29 03:57:44', 1),
(31, 5, 16, '', '2016-07-29 03:57:44', 1),
(32, 5, 20, '', '2016-07-29 03:57:44', 1),
(33, 5, 22, '', '2016-07-29 03:57:44', 1),
(34, 5, 23, '', '2016-07-29 03:57:44', 1),
(35, 5, 24, '', '2016-07-29 03:57:44', 1),
(36, 5, 25, '<p>Teste</p>', '2016-07-29 03:57:44', 1),
(37, 5, 29, '2016-07-301469896641.png', '2016-07-29 03:57:44', 1),
(38, 5, 5, 'Fernando', '2016-07-29 03:59:13', 1),
(39, 5, 4, 'D11DCD2', '2016-07-29 04:02:13', 1),
(40, 3, 5, 'Usuário X', '2016-07-29 16:08:00', 1),
(41, 3, 6, 'Apple', '2016-07-29 16:08:00', 1),
(42, 3, 24, '', '2016-07-29 16:08:00', 1),
(43, 3, 1, 'CEL123', '2016-07-30 03:50:59', 3),
(44, 3, 14, '', '2016-07-30 03:50:59', 3),
(45, 4, 1, '01ADM03', '2016-07-30 03:53:57', 3),
(46, 4, 4, 'D8YHX1', '2016-07-30 03:53:57', 3),
(47, 4, 5, 'Dan Rezende', '2016-07-30 03:53:57', 3),
(48, 4, 6, 'Dell', '2016-07-30 03:53:57', 3),
(49, 4, 14, '', '2016-07-30 03:53:57', 3),
(50, 4, 24, '', '2016-07-30 03:53:57', 3),
(51, 5, 30, '', '2016-07-30 16:37:21', 3),
(52, 5, 31, '', '2016-07-30 16:37:21', 3),
(53, 5, 32, 'Windows 10', '2016-07-30 16:37:21', 3),
(54, 4, 30, 'Não Utiliza', '2016-07-30 17:10:57', 3),
(55, 4, 31, 'Não Utiliza', '2016-07-30 17:10:57', 3),
(56, 4, 32, 'Windows 10', '2016-07-30 17:10:57', 3),
(57, 4, 35, 'Última formação em 10/10/2015.', '2016-07-30 17:10:57', 3),
(58, 5, 35, '', '2016-07-30 17:28:36', 1),
(59, 6, 1, '', '2016-07-30 17:33:00', 1),
(60, 6, 2, '', '2016-07-30 17:33:00', 1),
(61, 6, 3, '', '2016-07-30 17:33:00', 1),
(62, 6, 5, '', '2016-07-30 17:33:00', 1),
(63, 6, 6, '', '2016-07-30 17:33:00', 1),
(64, 6, 7, '', '2016-07-30 17:33:00', 1),
(65, 6, 15, '', '2016-07-30 17:33:00', 1),
(66, 6, 16, '', '2016-07-30 17:33:00', 1),
(67, 6, 24, '', '2016-07-30 17:33:00', 1),
(68, 6, 25, '', '2016-07-30 17:33:00', 1),
(69, 6, 29, '', '2016-07-30 17:33:00', 1),
(70, 6, 35, '', '2016-07-30 17:33:00', 1),
(71, 7, 1, '', '2016-07-30 17:33:55', 1),
(72, 7, 2, '', '2016-07-30 17:33:55', 1),
(73, 7, 3, '', '2016-07-30 17:33:55', 1),
(74, 7, 5, '', '2016-07-30 17:33:55', 1),
(75, 7, 6, '', '2016-07-30 17:33:55', 1),
(76, 7, 7, '', '2016-07-30 17:33:55', 1),
(77, 7, 15, '', '2016-07-30 17:33:55', 1),
(78, 7, 16, '', '2016-07-30 17:33:55', 1),
(79, 7, 24, '', '2016-07-30 17:33:55', 1),
(80, 7, 25, '', '2016-07-30 17:33:55', 1),
(81, 7, 29, '', '2016-07-30 17:33:55', 1),
(82, 7, 35, '', '2016-07-30 17:33:55', 1),
(83, 8, 1, '', '2016-07-30 17:56:59', 1),
(84, 8, 2, '', '2016-07-30 17:56:59', 1),
(85, 8, 3, '', '2016-07-30 17:56:59', 1),
(86, 8, 5, '', '2016-07-30 17:56:59', 1),
(87, 8, 6, '', '2016-07-30 17:56:59', 1),
(88, 8, 7, '', '2016-07-30 17:56:59', 1),
(89, 8, 15, '1969-12-31', '2016-07-30 17:56:59', 1),
(90, 8, 16, '', '2016-07-30 17:56:59', 1),
(91, 8, 24, '', '2016-07-30 17:56:59', 1),
(92, 8, 25, '', '2016-07-30 17:56:59', 1),
(93, 8, 29, '', '2016-07-30 17:56:59', 1),
(94, 8, 35, '', '2016-07-30 17:56:59', 1),
(95, 9, 1, '01ADM257', '2016-07-30 17:57:09', 3),
(96, 9, 2, '004141', '2016-07-30 17:57:09', 3),
(97, 9, 3, 'D10DCD2', '2016-07-30 17:57:09', 3),
(98, 9, 5, 'Leonardo Barbosa', '2016-07-30 17:57:09', 3),
(99, 9, 6, 'Dell', '2016-07-30 17:57:09', 3),
(100, 9, 7, 'Vostro 5480', '2016-07-30 17:57:09', 3),
(101, 9, 9, 'i5', '2016-07-30 17:57:09', 3),
(102, 9, 10, '240SSD', '2016-07-30 17:57:09', 3),
(103, 9, 11, '4GB', '2016-07-30 17:57:09', 3),
(104, 9, 13, '2016', '2016-07-30 17:57:10', 3),
(105, 9, 15, '2016-07-05', '2016-07-30 17:57:10', 3),
(106, 9, 16, '', '2016-07-30 17:57:10', 3),
(107, 9, 22, '', '2016-07-30 17:57:10', 3),
(108, 9, 23, '', '2016-07-30 17:57:10', 3),
(109, 9, 24, '', '2016-07-30 17:57:10', 3),
(110, 9, 25, '', '2016-07-30 17:57:10', 3),
(111, 9, 29, '', '2016-07-30 17:57:10', 3),
(112, 9, 30, '', '2016-07-30 17:57:10', 3),
(113, 9, 31, '', '2016-07-30 17:57:10', 3),
(114, 9, 32, 'Windows 10', '2016-07-30 17:57:10', 3),
(115, 9, 35, 'Foi feita a troca do HD que veio com notebook de 500GB, por um HD SSD de 240GB.', '2016-07-30 17:57:10', 3);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `acesso`
--
ALTER TABLE `acesso`
  ADD PRIMARY KEY (`codacesso`), ADD KEY `codpessoa_2` (`codpessoa`), ADD KEY `codempresa` (`codempresa`), ADD KEY `quantidade` (`quantidade`);

--
-- Índices de tabela `atributo`
--
ALTER TABLE `atributo`
  ADD PRIMARY KEY (`codatributo`);

--
-- Índices de tabela `atributocategoria`
--
ALTER TABLE `atributocategoria`
  ADD PRIMARY KEY (`codac`);

--
-- Índices de tabela `categoriaproduto`
--
ALTER TABLE `categoriaproduto`
  ADD PRIMARY KEY (`codcategoria`);

--
-- Índices de tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`codcidade`), ADD KEY `codestado` (`codestado`);

--
-- Índices de tabela `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`coddepartamento`);

--
-- Índices de tabela `diretoria`
--
ALTER TABLE `diretoria`
  ADD PRIMARY KEY (`coddiretoria`), ADD KEY `nome` (`nome`);

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`codempresa`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`codestado`);

--
-- Índices de tabela `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`codlocal`);

--
-- Índices de tabela `localcidade`
--
ALTER TABLE `localcidade`
  ADD PRIMARY KEY (`codlc`);

--
-- Índices de tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`codlog`), ADD KEY `codpessoa` (`codfuncionario`), ADD KEY `data` (`dtcadastro`);

--
-- Índices de tabela `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`codmodulo`), ADD KEY `nome` (`nome`);

--
-- Índices de tabela `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`codnivel`), ADD KEY `codempresa` (`codempresa`), ADD KEY `codfuncionario` (`codfuncionario`), ADD KEY `dtcadastro` (`dtcadastro`), ADD KEY `nome` (`nome`);

--
-- Índices de tabela `nivelpagina`
--
ALTER TABLE `nivelpagina`
  ADD UNIQUE KEY `codnivel` (`codnivel`,`codpagina`), ADD KEY `codpagina` (`codpagina`), ADD KEY `inserir` (`inserir`), ADD KEY `atualizar` (`atualizar`), ADD KEY `excluir` (`excluir`), ADD KEY `procurar` (`procurar`), ADD KEY `mostrar` (`mostrar`);

--
-- Índices de tabela `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`codpagina`), ADD KEY `nome` (`nome`), ADD KEY `codmodulo` (`codmodulo`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`codpessoa`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codproduto`);

--
-- Índices de tabela `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`codprograma`);

--
-- Índices de tabela `statusproduto`
--
ALTER TABLE `statusproduto`
  ADD PRIMARY KEY (`codstatus`);

--
-- Índices de tabela `valorproduto`
--
ALTER TABLE `valorproduto`
  ADD PRIMARY KEY (`codvalor`), ADD KEY `idx_1` (`codatributo`,`codproduto`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `acesso`
--
ALTER TABLE `acesso`
  MODIFY `codacesso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `atributo`
--
ALTER TABLE `atributo`
  MODIFY `codatributo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de tabela `atributocategoria`
--
ALTER TABLE `atributocategoria`
  MODIFY `codac` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=349;
--
-- AUTO_INCREMENT de tabela `categoriaproduto`
--
ALTER TABLE `categoriaproduto`
  MODIFY `codcategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `codcidade` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de tabela `departamento`
--
ALTER TABLE `departamento`
  MODIFY `coddepartamento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de tabela `diretoria`
--
ALTER TABLE `diretoria`
  MODIFY `coddiretoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `codempresa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `codestado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `local`
--
ALTER TABLE `local`
  MODIFY `codlocal` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `localcidade`
--
ALTER TABLE `localcidade`
  MODIFY `codlc` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `codlog` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT de tabela `modulo`
--
ALTER TABLE `modulo`
  MODIFY `codmodulo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `nivel`
--
ALTER TABLE `nivel`
  MODIFY `codnivel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `pagina`
--
ALTER TABLE `pagina`
  MODIFY `codpagina` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `codpessoa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `codproduto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `programa`
--
ALTER TABLE `programa`
  MODIFY `codprograma` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `statusproduto`
--
ALTER TABLE `statusproduto`
  MODIFY `codstatus` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `valorproduto`
--
ALTER TABLE `valorproduto`
  MODIFY `codvalor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=116;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `cidade`
--
ALTER TABLE `cidade`
ADD CONSTRAINT `estado` FOREIGN KEY (`codestado`) REFERENCES `estado` (`codestado`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
