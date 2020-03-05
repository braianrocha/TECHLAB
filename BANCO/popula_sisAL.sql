-- ======================POPULA SISAL===============================================================================
--
-- Extraindo dados da tabela `AGENDAMENTO`
--

INSERT INTO `AGENDAMENTO` (`ID`, `DATA_SOLIC`, `USUARIO_ID`, `DATA_AG`, `PERIODO_ID`, `CURSO_ID`, `INFO_ADC`, `SITUACAO_SOLIC_ID`, `LABORATORIO_ID`) VALUES
(146, '2019-12-17 00:00:00', 10, '2019-12-17', 1, 18, NULL, 'P', 1),
(149, '2019-12-17 00:00:00', 10, '2019-12-15', 5, 18, NULL, 'P', 1),
(150, '2019-12-17 00:00:00', 10, '2019-12-25', 4, 18, '[ Cancelamento - 23/12/2019 Ã s 18:28:47] \n Motivo :Cancelado pelo usuÃ¡rio.', 'C', 1),
(152, '2019-12-17 00:00:00', 10, '2019-12-16', 1, 20, NULL, 'P', 1),
(154, '2019-12-17 00:00:00', 10, '2019-12-19', 6, 18, NULL, 'P', 1),
(155, '2019-12-17 00:00:00', 10, '2020-01-01', 1, 18, 'Instalar CS 1.6[ Cancelamento - 18/12/2019 Ã s 00:58:11] \r  Motivo :NÃ£o podemos instalar o CS !', 'P', 1),
(158, '2019-12-17 00:00:00', 10, '2020-01-05', 1, 18, 'Deixar lab sem rede[ Cancelamento - 23/12/2019 Ã s 18:26:43] \n Motivo :NÃ£o rolou', 'C', 1),
(159, '2019-12-18 00:00:00', 10, '2019-12-22', 1, 18, NULL, 'P', 1),
(163, '2019-12-18 00:00:00', 10, '2019-12-26', 1, 18, '', 'P', 1),
(164, '2019-12-18 00:00:00', 10, '2019-12-26', 4, 18, 'Instalar PAINT 2.0', 'P', 11),
(165, '2019-12-18 00:00:00', 10, '2019-12-27', 2, 18, '[ Cancelamento - 18/12/2019 Ã s 20:28:01] \n Motivo :Estamos de ferias', 'P', 3),
(166, '2019-12-23 00:00:00', 10, '2020-01-10', 6, 18, 'Favor instalar o PAINT 2.0', 'A', 1),
(167, '2020-02-11 00:00:00', 13, '2020-02-17', 1, 18, '', 'P', 41);

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `CURSO`
--

INSERT INTO `CURSO` (`ID`, `DESCRICAO`, `TIPO_CURSO_ID`) VALUES
(18, 'CiÃªncia da computaÃ§Ã£o', 'P'),
(19, 'Sistemas de informaÃ§Ã£o', 'P'),
(20, 'Arquitetura', 'I');

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `INSUMO`
--

INSERT INTO `INSUMO` (`ID`, `DESCRICAO`, `TIPO_INS_ID`) VALUES
(1, 'Computadores', 1),
(2, 'Balsamiq Mockups', 2),
(3, 'Mesa para desenho', 4),
(14, 'DEV C++', 2),
(15, 'NETBEANS', 2),
(16, 'MATHLAB', 2),
(17, 'PAINT', 2),
(18, 'CS 1.6', 2),
(19, 'AutoCAD', 2),
(20, 'Google Earth', 2),
(21, 'Projetor', 3),
(23, 'MicroscÃ³pico ', 3);

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `INSUMO`
--

INSERT INTO `INSUMO` (`ID`, `DESCRICAO`, `TIPO_INS_ID`) VALUES
(1, 'Computadores', 1),
(2, 'Balsamiq Mockups', 2),
(3, 'Mesa para desenho', 4),
(14, 'DEV C++', 2),
(15, 'NETBEANS', 2),
(16, 'MATHLAB', 2),
(17, 'PAINT', 2),
(18, 'CS 1.6', 2),
(19, 'AutoCAD', 2),
(20, 'Google Earth', 2),
(21, 'Projetor', 3),
(23, 'MicroscÃ³pico ', 3);

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `LABORATORIO`
--

INSERT INTO `LABORATORIO` (`ID`, `DESCRICAO`, `SALA`, `ANDAR`, `TIPO_LAB_ID`) VALUES
(1, 'LaboratÃ³rio de fÃ­sica', 1, '2', 5),
(2, 'LaboratÃ³rio de redes', 12, 'S3', 4),
(3, 'LaboratÃ³rio de desenho', 2, '2', 3),
(11, 'LaboratÃ³rio de arquitetura', 3, '2', 2),
(41, 'LaboratÃ³rio de informÃ¡tica', 3, '2', 4),
(42, 'Braian Teste', 16, '2', 4);

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `PARAM_GERAIS`
--

INSERT INTO `PARAM_GERAIS` (`ID`, `AG_ADIANT_MIN`, `AG_ADIANT_MAX`, `AG_MAX_DIA`, `AG_MAX_SIMULT`, `AG_APROVA`) VALUES
(1, 2, 30, 2, 30, 'S');

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `PERFIL`
--

INSERT INTO `PERFIL` (`ID`, `DESCRICAO`) VALUES
(1, 'Administrador'),
(2, 'Professor'),
(3, 'Administrador'),
(4, 'Professor');

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `PERIODO`
--

INSERT INTO `PERIODO` (`ID`, `DESCRICAO`, `INICIO`, `FIM`) VALUES
(1, 'Matutino (Integral)', '07:00:00', '11:00:00'),
(2, 'Matutino (07:00 - 08:15)', '07:00:00', '08:15:00'),
(3, 'Matutino (08:45 - 11:00)', '08:45:00', '11:00:00'),
(4, 'Noturno (Integral)', '19:00:00', '22:00:00'),
(5, 'Noturno (19:00 - 20:15)', '19:00:00', '20:15:00'),
(6, 'Noturno (20:45 - 22:00)', '20:45:00', '22:00:00');

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `SIT_SOLICITACAO`
--

INSERT INTO `SIT_SOLICITACAO` (`ID`, `DESCRICAO`) VALUES
('A', 'Aprovada'),
('C', 'Cancelada'),
('P', 'Pendente'),
('R', 'Recusada');

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `TIPO_CURSO`
--

INSERT INTO `TIPO_CURSO` (`TIPO`, `DESCRICAO`) VALUES
('B', 'Blended'),
('I', 'Interativa'),
('P', 'Presencial');

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `TIPO_INSUMO`
--

INSERT INTO `TIPO_INSUMO` (`ID`, `DESCRICAO`) VALUES
(1, 'Computador'),
(2, 'Software'),
(3, 'Equipamento'),
(4, 'Mesa Desenho');

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `TIPO_LABORATORIO`
--

INSERT INTO `TIPO_LABORATORIO` (`ID`, `DESCRICAO`) VALUES
(2, 'Arquitetura'),
(3, 'Engenharia'),
(4, 'InformÃ¡tica'),
(5, ' FÃ­sica');

-- --------------------------------------------------------
--
-- Extraindo dados da tabela `USUARIO`
--

INSERT INTO `USUARIO` (`ID`, `NOME`, `CPF`, `EMAIL`, `RESERVA`, `SENHA`, `PERIODO_ID`, `PERFIL_ID`, `TOKEN`) VALUES
(2, 'Admin', '12345678900', 'admin@admin.com', '1', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, NULL),
(5, 'taina', '12345678900', 'taina@taina.com', '1', 'e10adc3949ba59abbe56e057f20f883e', 1, 2, ''),
(10, 'usuario', '12345678900', 'usuario@usuario.com', '1', 'e10adc3949ba59abbe56e057f20f883e', 1, 2, NULL),
(11, 'ViSantana', '98765432100', 'stavivisant@gmail.com', '1', '8ea80d97ed0a55c9511a2bf6d24eb382', 1, 1, ''),
(13, 'Professor', '98765432100', 'techlab@pitagorasraja.net.br', '1', 'e10adc3949ba59abbe56e057f20f883e', 1, 2, NULL);
