-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 23/09/2019 às 19:31
-- Versão do servidor: 5.7.27-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ms_sca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `PERFIL`
--

CREATE TABLE `PERFIL` (
  `ID` int(11) NOT NULL,
  `PERFIL` varchar(100) NOT NULL,
  `DESCRICAO` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `PERFIL`
--

INSERT INTO `PERFIL` (`ID`, `PERFIL`, `DESCRICAO`) VALUES
(1, 'OPERADOR', 'Operador do Sistema'),
(2, 'FINANCEIRO', 'Operador do Setor Financeiro'),
(3, 'GERENTE', 'Gerente do Sistema'),
(4, 'ADMINISTRADOR', 'Administrador de Informática'),
(10, 'USUÁRIO', 'Usuário do Sistema');

-- --------------------------------------------------------

--
-- Estrutura para tabela `PERFIL_SISTEMA`
--

CREATE TABLE `PERFIL_SISTEMA` (
  `PERFIL_ID` int(11) NOT NULL,
  `SISTEMA_ID` int(11) NOT NULL,
  `ATIVO` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `PERFIL_SISTEMA`
--

INSERT INTO `PERFIL_SISTEMA` (`PERFIL_ID`, `SISTEMA_ID`, `ATIVO`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(10, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `SISTEMA`
--

CREATE TABLE `SISTEMA` (
  `ID` int(11) NOT NULL,
  `SISTEMA` varchar(200) DEFAULT NULL,
  `ATIVO` tinyint(1) NOT NULL DEFAULT '1',
  `DESCRICAO` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `SISTEMA`
--

INSERT INTO `SISTEMA` (`ID`, `SISTEMA`, `ATIVO`, `DESCRICAO`) VALUES
(1, 'NETCAR', 1, 'Sistema de Gerenciamento de Lava Jato'),
(2, 'SISGEDOC', 1, 'Sistema de Gerenciamento de Documentos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `USUARIO`
--

CREATE TABLE `USUARIO` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(245) DEFAULT NULL,
  `IDENTIDADE` varchar(11) NOT NULL,
  `CPF` varchar(11) DEFAULT NULL,
  `ENDERECO` varchar(45) DEFAULT NULL,
  `SENHA` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `USUARIO`
--

INSERT INTO `USUARIO` (`ID`, `NOME`, `IDENTIDADE`, `CPF`, `ENDERECO`, `SENHA`) VALUES
(1, 'Jose pereira', '123456', NULL, NULL, '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(18, 'Manoel Souza', '123', NULL, NULL, '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(19, 'Joaquim', '1234', NULL, NULL, '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(20, 'Lorena Rocco', '12345', NULL, NULL, '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(24, NULL, '1234567', NULL, NULL, '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(25, 'Florencio', '1234567', NULL, NULL, '51eac6b471a284d3341d8c0c63d0f1a286262a18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `USUARIO_PERFIL`
--

CREATE TABLE `USUARIO_PERFIL` (
  `USUARIO_ID` int(11) NOT NULL,
  `PERFIL_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `USUARIO_PERFIL`
--

INSERT INTO `USUARIO_PERFIL` (`USUARIO_ID`, `PERFIL_ID`) VALUES
(19, 1),
(20, 2),
(25, 2),
(1, 3),
(1, 4),
(18, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `USUARIO_SISTEMA`
--

CREATE TABLE `USUARIO_SISTEMA` (
  `USUARIO_ID` int(11) NOT NULL,
  `SISTEMA_ID` int(11) NOT NULL,
  `ATIVO` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `USUARIO_SISTEMA`
--

INSERT INTO `USUARIO_SISTEMA` (`USUARIO_ID`, `SISTEMA_ID`, `ATIVO`) VALUES
(1, 1, 1),
(18, 1, 1),
(19, 1, 1),
(20, 1, 1),
(25, 1, 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `PERFIL`
--
ALTER TABLE `PERFIL`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `PERFIL_SISTEMA`
--
ALTER TABLE `PERFIL_SISTEMA`
  ADD PRIMARY KEY (`PERFIL_ID`,`SISTEMA_ID`),
  ADD KEY `fk_PERFIL_has_SISTEMA_SISTEMA1_idx` (`SISTEMA_ID`),
  ADD KEY `fk_PERFIL_has_SISTEMA_PERFIL1_idx` (`PERFIL_ID`);

--
-- Índices de tabela `SISTEMA`
--
ALTER TABLE `SISTEMA`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `USUARIO_PERFIL`
--
ALTER TABLE `USUARIO_PERFIL`
  ADD PRIMARY KEY (`USUARIO_ID`,`PERFIL_ID`),
  ADD KEY `fk_USUARIO_has_PERFIL_PERFIL1_idx` (`PERFIL_ID`),
  ADD KEY `fk_USUARIO_has_PERFIL_USUARIO1_idx` (`USUARIO_ID`);

--
-- Índices de tabela `USUARIO_SISTEMA`
--
ALTER TABLE `USUARIO_SISTEMA`
  ADD PRIMARY KEY (`USUARIO_ID`,`SISTEMA_ID`),
  ADD KEY `fk_USUARIO_has_SISTEMA_SISTEMA1_idx` (`SISTEMA_ID`),
  ADD KEY `fk_USUARIO_has_SISTEMA_USUARIO_idx` (`USUARIO_ID`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `PERFIL`
--
ALTER TABLE `PERFIL`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `SISTEMA`
--
ALTER TABLE `SISTEMA`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `PERFIL_SISTEMA`
--
ALTER TABLE `PERFIL_SISTEMA`
  ADD CONSTRAINT `fk_PERFIL_has_SISTEMA_PERFIL1` FOREIGN KEY (`PERFIL_ID`) REFERENCES `PERFIL` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PERFIL_has_SISTEMA_SISTEMA1` FOREIGN KEY (`SISTEMA_ID`) REFERENCES `SISTEMA` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `USUARIO_PERFIL`
--
ALTER TABLE `USUARIO_PERFIL`
  ADD CONSTRAINT `fk_USUARIO_has_PERFIL_PERFIL1` FOREIGN KEY (`PERFIL_ID`) REFERENCES `PERFIL` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USUARIO_has_PERFIL_USUARIO1` FOREIGN KEY (`USUARIO_ID`) REFERENCES `USUARIO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `USUARIO_SISTEMA`
--
ALTER TABLE `USUARIO_SISTEMA`
  ADD CONSTRAINT `fk_USUARIO_has_SISTEMA_SISTEMA1` FOREIGN KEY (`SISTEMA_ID`) REFERENCES `SISTEMA` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USUARIO_has_SISTEMA_USUARIO` FOREIGN KEY (`USUARIO_ID`) REFERENCES `USUARIO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
