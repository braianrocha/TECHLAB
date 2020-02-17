-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 186.202.152.175
-- Generation Time: 12-Fev-2020 às 10:39
-- Versão do servidor: 5.6.35-81.0-log
-- PHP Version: 5.6.40-0+deb8u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/* !40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT; */
/* !40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS; */
/* !40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION; */
/* !40101 SET NAMES utf8mb4 */;

--
-- Database: `basemapeamento`
--
CREATE DATABASE IF NOT EXISTS `basemapeamento` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `basemapeamento`;

-- --------------------------------------------------------

-- =========================== T A B E L A   A G E N D A M E N T O =======================================================================================================================================================

--
-- Estrutura da tabela `AGENDAMENTO`
--
CREATE TABLE `AGENDAMENTO` (
  `ID` int(11) NOT NULL COMMENT 'Código Identificador do Agendamento',
  `DATA_SOLIC` datetime NOT NULL,
  `USUARIO_ID` int(11) NOT NULL,
  `DATA_AG` date NOT NULL,
  `PERIODO_ID` int(11) NOT NULL,
  `CURSO_ID` int(11) NOT NULL,
  `INFO_ADC` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SITUACAO_SOLIC_ID` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `LABORATORIO_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

--
-- Indexes for table `AGENDAMENTO`
--
ALTER TABLE `AGENDAMENTO`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_AGENDAMENTO_USUARIO` (`USUARIO_ID`),
  ADD KEY `fk_AGENDAMENTO_SITUACAO_SOLIC` (`SITUACAO_SOLIC_ID`),
  ADD KEY `fk_AGENDAMENTO_PERIODO` (`PERIODO_ID`),
  ADD KEY `fk_AGENDAMENTO_LABORATORIO` (`LABORATORIO_ID`),
  ADD KEY `fk_AGENDAMENTO_CURSO` (`CURSO_ID`);

--
-- AUTO_INCREMENT for table `AGENDAMENTO`
--
ALTER TABLE `AGENDAMENTO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código Identificador do Agendamento', AUTO_INCREMENT=168;

-- =======================================================================================================================================================================================================================


-- =========================== T A B E L A   C U R S O ===================================================================================================================================================================

--
-- Estrutura da tabela `CURSO`
--
CREATE TABLE `CURSO` (
  `ID` int(11) NOT NULL COMMENT 'Código identificador do curso',
  `DESCRICAO` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição do curso',
  `TIPO_CURSO_ID` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `CURSO`
--
ALTER TABLE `CURSO`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_CURSO_TIPO_CURSO` (`TIPO_CURSO_ID`);

--
-- AUTO_INCREMENT for table `CURSO`
--
ALTER TABLE `CURSO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código identificador do curso', AUTO_INCREMENT=21;

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   I N S U M O =================================================================================================================================================================

--
-- Estrutura da tabela `INSUMO`
--

CREATE TABLE `INSUMO` (
  `ID` int(11) NOT NULL COMMENT 'Código indentificador do insumo',
  `DESCRICAO` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição detalhada do Insumo',
  `TIPO_INS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for table `INSUMO`
--
ALTER TABLE `INSUMO`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_INSUMO_TIPO_INS` (`TIPO_INS_ID`);

--
-- AUTO_INCREMENT for table `INSUMO`
--
ALTER TABLE `INSUMO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código indentificador do insumo', AUTO_INCREMENT=24;

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   I N S U M O _ L A B =========================================================================================================================================================

--
-- Estrutura da tabela `INSUMO_LAB`
--

CREATE TABLE `INSUMO_LAB` (
  `LABORATORIO_ID` int(11) NOT NULL,
  `INSUMO_ID` int(11) NOT NULL,
  `QTDINSUMO` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for table `INSUMO_LAB`
--
ALTER TABLE `INSUMO_LAB`
  ADD PRIMARY KEY (`INSUMO_ID`,`LABORATORIO_ID`),
  ADD KEY `fk_LABORATORIO_has_INSUMO_INSUMO` (`INSUMO_ID`),
  ADD KEY `fk_LABORATORIO_has_INSUMO_LABORATORIO` (`LABORATORIO_ID`);

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   L A B O R A T O R I O =======================================================================================================================================================

--
-- Estrutura da tabela `LABORATORIO`
--

CREATE TABLE `LABORATORIO` (
  `ID` int(11) NOT NULL COMMENT 'Código identificador do curso',
  `DESCRICAO` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição do curso',
  `SALA` int(11) NOT NULL COMMENT 'Tipo de Curso:\n\nB - Blended\nP - Presencial\nI - Interativa\n',
  `ANDAR` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Andar onde se localiza o Laboratório',
  `TIPO_LAB_ID` int(11) NOT NULL COMMENT 'Tipo do Laboratório (ver tabela TIPO_LABORATORIO)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for table `LABORATORIO`
--
ALTER TABLE `LABORATORIO`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_LABORATORIO_TIPO_LAB` (`TIPO_LAB_ID`);

--
-- AUTO_INCREMENT for table `LABORATORIO`
--
ALTER TABLE `LABORATORIO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código identificador do curso', AUTO_INCREMENT=43;

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   P A R A M _ G E R A I S =====================================================================================================================================================

--
-- Estrutura da tabela `PARAM_GERAIS`
--

CREATE TABLE `PARAM_GERAIS` (
  `ID` int(11) NOT NULL COMMENT 'Código identificador do Parâmetro',
  `AG_ADIANT_MIN` int(11) NOT NULL,
  `AG_ADIANT_MAX` int(11) NOT NULL,
  `AG_MAX_DIA` int(11) DEFAULT NULL,
  `AG_MAX_SIMULT` int(11) DEFAULT NULL,
  `AG_APROVA` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for table `PARAM_GERAIS`
--
ALTER TABLE `PARAM_GERAIS`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for table `PARAM_GERAIS`
--
ALTER TABLE `PARAM_GERAIS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código identificador do Parâmetro', AUTO_INCREMENT=2;

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   P E R F I L =================================================================================================================================================================

--
-- Estrutura da tabela `PERFIL`
--

CREATE TABLE `PERFIL` (
  `ID` int(11) NOT NULL COMMENT 'Código Identificador do Perfil de Usuário',
  `DESCRICAO` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição do Perfil de Usuário'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for table `PERFIL`
--
ALTER TABLE `PERFIL`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for table `PERFIL`
--
ALTER TABLE `PERFIL`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código Identificador do Perfil de Usuário', AUTO_INCREMENT=5;

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   P E R I O D O ===============================================================================================================================================================

--
-- Estrutura da tabela `PERIODO`
--

CREATE TABLE `PERIODO` (
  `ID` int(11) NOT NULL COMMENT 'Código do Período',
  `DESCRICAO` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição do Período - Manhã (Integral) - Manhã (07:00 - 08:15)- Manhã (08:45 - 11:00)- Noite (Integral)- Noite (19:00 - 20:15)- Noite (20:45 - 22:00)',
  `INICIO` time NOT NULL,
  `FIM` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for table `PERIODO`
--
ALTER TABLE `PERIODO`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for table `PERIODO`
--
ALTER TABLE `PERIODO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código do Período', AUTO_INCREMENT=7;

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   S I T _ S O L I C I T A C A O ===============================================================================================================================================

--
-- Estrutura da tabela `SIT_SOLICITACAO`
--

CREATE TABLE `SIT_SOLICITACAO` (
  `ID` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Código Identificador da Situação da Solicitação:\n\n- P (Pendente)\n- A (Aprovada)\n- R (Recusada)\n- C (Cancelada)\n',
  `DESCRICAO` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição da Situação da Solicitação:- Pendente- Aprovada- Recusada- Cancelada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-
-- Indexes for table `SIT_SOLICITACAO`
--
ALTER TABLE `SIT_SOLICITACAO`
  ADD PRIMARY KEY (`ID`);

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   T I P O _ C U R S O =========================================================================================================================================================

--
-- Estrutura da tabela `TIPO_CURSO`
--

CREATE TABLE `TIPO_CURSO` (
  `TIPO` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tipo de Curso:\n\nB - Blended\nP - Presencial\nI - Interativa\n',
  `DESCRICAO` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição do curso'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for table `TIPO_CURSO`
--
ALTER TABLE `TIPO_CURSO`
  ADD PRIMARY KEY (`TIPO`);

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   T I P O _ I N S U M O =======================================================================================================================================================

--
-- Estrutura da tabela `TIPO_INSUMO`
--

CREATE TABLE `TIPO_INSUMO` (
  `ID` int(11) NOT NULL COMMENT 'Código indentificador do insumo',
  `DESCRICAO` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição detalhada do Insumo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for table `TIPO_INSUMO`
--
ALTER TABLE `TIPO_INSUMO`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for table `TIPO_INSUMO`
--
ALTER TABLE `TIPO_INSUMO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código indentificador do insumo', AUTO_INCREMENT=5;

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   T I P O _ L A B O R A T O R I O =============================================================================================================================================

--
-- Estrutura da tabela `TIPO_LABORATORIO`
--

CREATE TABLE `TIPO_LABORATORIO` (
  `ID` int(11) NOT NULL COMMENT 'Código indentificador do Laboratório\n',
  `DESCRICAO` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição detalhada do Laboratório'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `TIPO_LABORATORIO`
--
ALTER TABLE `TIPO_LABORATORIO`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for table `TIPO_LABORATORIO`
--
ALTER TABLE `TIPO_LABORATORIO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código indentificador do Laboratório\n', AUTO_INCREMENT=6;

-- =======================================================================================================================================================================================================================

-- =========================== T A B E L A   U S U A R I O ===============================================================================================================================================================

--
-- Estrutura da tabela `USUARIO`
--

CREATE TABLE `USUARIO` (
  `ID` int(11) NOT NULL COMMENT 'Código Identificador do Usuário',
  `NOME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome do Usuário',
  `CPF` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Cpf do Usuário',
  `EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'E-mail do Usuário',
  `RESERVA` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Usuário pode fazer agendamento? (Sim ou Não)\n',
  `SENHA` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Senha Criptografada do Usuário',
  `PERIODO_ID` int(11) NOT NULL,
  `PERFIL_ID` int(11) NOT NULL,
  `TOKEN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for table `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_USUARIO_PERIODO` (`PERIODO_ID`),
  ADD KEY `fk_USUARIO_PERFIL` (`PERFIL_ID`);

--
-- AUTO_INCREMENT for table `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código Identificador do Usuário', AUTO_INCREMENT=14;

-- =======================================================================================================================================================================================================================

-- =========================== CONSTRAINTS ===============================================================================================================================================================================
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `AGENDAMENTO`
--
ALTER TABLE `AGENDAMENTO`
  ADD CONSTRAINT `fk_AGENDAMENTO_CURSO` FOREIGN KEY (`CURSO_ID`) REFERENCES `CURSO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AGENDAMENTO_LABORATORIO` FOREIGN KEY (`LABORATORIO_ID`) REFERENCES `LABORATORIO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AGENDAMENTO_PERIODO` FOREIGN KEY (`PERIODO_ID`) REFERENCES `PERIODO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AGENDAMENTO_SITUACAO_SOLIC` FOREIGN KEY (`SITUACAO_SOLIC_ID`) REFERENCES `SIT_SOLICITACAO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AGENDAMENTO_USUARIO` FOREIGN KEY (`USUARIO_ID`) REFERENCES `USUARIO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `CURSO`
--
ALTER TABLE `CURSO`
  ADD CONSTRAINT `fk_CURSO_TIPO_CURSO` FOREIGN KEY (`TIPO_CURSO_ID`) REFERENCES `TIPO_CURSO` (`TIPO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `INSUMO`
--
ALTER TABLE `INSUMO`
  ADD CONSTRAINT `fk_INSUMO_TIPO_INS` FOREIGN KEY (`TIPO_INS_ID`) REFERENCES `TIPO_INSUMO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `INSUMO_LAB`
--
ALTER TABLE `INSUMO_LAB`
  ADD CONSTRAINT `fk_LABORATORIO_has_INSUMO_INSUMO` FOREIGN KEY (`INSUMO_ID`) REFERENCES `INSUMO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LABORATORIO_has_INSUMO_LABORATORIO` FOREIGN KEY (`LABORATORIO_ID`) REFERENCES `LABORATORIO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `LABORATORIO`
--
ALTER TABLE `LABORATORIO`
  ADD CONSTRAINT `fk_LABORATORIO_TIPO_LAB` FOREIGN KEY (`TIPO_LAB_ID`) REFERENCES `TIPO_LABORATORIO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD CONSTRAINT `fk_USUARIO_PERFIL` FOREIGN KEY (`PERFIL_ID`) REFERENCES `PERFIL` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USUARIO_PERIODO` FOREIGN KEY (`PERIODO_ID`) REFERENCES `PERIODO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

-- =======================================================================================================================================================================================================================

/* !40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT; */
/* !40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS; */
/* !40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION; */
