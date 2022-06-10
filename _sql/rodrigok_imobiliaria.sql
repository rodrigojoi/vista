-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 10-Jun-2022 às 15:09
-- Versão do servidor: 5.6.51-log
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rodrigok_imobiliaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `condominio`
--

CREATE TABLE `condominio` (
  `condominioCodigo` int(6) NOT NULL,
  `condominioContratoCodigo` int(6) NOT NULL,
  `condominioValor` decimal(10,2) NOT NULL,
  `condominioDataAluguel` date NOT NULL,
  `condominioDataEfetuado` date DEFAULT NULL,
  `condominioInsercaoData` date NOT NULL,
  `condominioInsercaoUsuarioCodigo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `condominio`
--

INSERT INTO `condominio` (`condominioCodigo`, `condominioContratoCodigo`, `condominioValor`, `condominioDataAluguel`, `condominioDataEfetuado`, `condominioInsercaoData`, `condominioInsercaoUsuarioCodigo`) VALUES
(25, 12, '105.00', '2022-07-01', NULL, '2022-06-10', 1),
(26, 12, '150.00', '2022-08-01', NULL, '2022-06-10', 1),
(27, 12, '150.00', '2022-09-01', NULL, '2022-06-10', 1),
(28, 12, '150.00', '2022-10-01', NULL, '2022-06-10', 1),
(29, 12, '150.00', '2022-11-01', NULL, '2022-06-10', 1),
(30, 12, '150.00', '2022-12-01', NULL, '2022-06-10', 1),
(31, 12, '150.00', '2023-01-01', NULL, '2022-06-10', 1),
(32, 12, '150.00', '2023-02-01', NULL, '2022-06-10', 1),
(33, 12, '150.00', '2023-03-01', NULL, '2022-06-10', 1),
(34, 12, '150.00', '2023-04-01', NULL, '2022-06-10', 1),
(35, 12, '150.00', '2023-05-01', NULL, '2022-06-10', 1),
(36, 12, '150.00', '2023-06-01', NULL, '2022-06-10', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato`
--

CREATE TABLE `contrato` (
  `contratoCodigo` int(6) NOT NULL,
  `contratoImovelCodigo` int(6) NOT NULL,
  `contratoLocatarioCodigo` int(6) NOT NULL,
  `contratoDataInicio` date NOT NULL,
  `contratoDataFim` date NOT NULL,
  `contratoAluguelValor` decimal(10,2) NOT NULL,
  `contratoAluguelValorTotal` decimal(10,2) NOT NULL,
  `contratoCondominioValor` decimal(10,2) DEFAULT '0.00',
  `contratoIptuValor` decimal(10,2) NOT NULL,
  `contratoTaxaAdministracaoValor` decimal(10,2) NOT NULL,
  `contratoInsercaoData` date NOT NULL,
  `contratoInsercaoUsuarioCodigo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contrato`
--

INSERT INTO `contrato` (`contratoCodigo`, `contratoImovelCodigo`, `contratoLocatarioCodigo`, `contratoDataInicio`, `contratoDataFim`, `contratoAluguelValor`, `contratoAluguelValorTotal`, `contratoCondominioValor`, `contratoIptuValor`, `contratoTaxaAdministracaoValor`, `contratoInsercaoData`, `contratoInsercaoUsuarioCodigo`) VALUES
(12, 2, 4, '2022-06-09', '2023-06-09', '1100.00', '1270.00', '150.00', '20.00', '50.00', '2022-06-10', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imovel`
--

CREATE TABLE `imovel` (
  `imovelCodigo` int(6) NOT NULL,
  `imovelEndereco` varchar(255) NOT NULL,
  `imovelLocadorCodigo` int(6) NOT NULL,
  `imovelInsercaoData` date NOT NULL,
  `imovelInsercaoUsuarioCodigo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `imovel`
--

INSERT INTO `imovel` (`imovelCodigo`, `imovelEndereco`, `imovelLocadorCodigo`, `imovelInsercaoData`, `imovelInsercaoUsuarioCodigo`) VALUES
(2, 'Rua BiguaÃ§u, 432 - Itajuba - Barra Velha/SC', 1, '2022-06-09', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locador`
--

CREATE TABLE `locador` (
  `locadorCodigo` int(6) NOT NULL,
  `locadorNome` varchar(255) NOT NULL,
  `locadorEmail` varchar(255) NOT NULL,
  `locadorTelefone` varchar(15) NOT NULL,
  `locadorDiaRepasse` int(2) NOT NULL,
  `locadorInsercaoData` date NOT NULL,
  `locadorInsercaoUsuarioCodigo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `locador`
--

INSERT INTO `locador` (`locadorCodigo`, `locadorNome`, `locadorEmail`, `locadorTelefone`, `locadorDiaRepasse`, `locadorInsercaoData`, `locadorInsercaoUsuarioCodigo`) VALUES
(1, 'Locador 1', 'locador1@imovel.com', '(47) 99988-8899', 10, '2022-06-08', 1),
(3, 'Locador 2', 'locador2@imovel.com', '(47) 99988-8891', 3, '2022-06-09', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locatario`
--

CREATE TABLE `locatario` (
  `locatarioCodigo` int(6) NOT NULL,
  `locatarioNome` varchar(255) NOT NULL,
  `locatarioEmail` varchar(255) NOT NULL,
  `locatarioTelefone` varchar(15) NOT NULL,
  `locatarioInsercaoData` date NOT NULL,
  `locatarioInsercaoUsuarioCodigo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `locatario`
--

INSERT INTO `locatario` (`locatarioCodigo`, `locatarioNome`, `locatarioEmail`, `locatarioTelefone`, `locatarioInsercaoData`, `locatarioInsercaoUsuarioCodigo`) VALUES
(4, 'Rodrigo Koch', 'rodrigojoi@gmail.com', '(47) 98820-5742', '2022-06-09', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidade`
--

CREATE TABLE `mensalidade` (
  `mensalidadeCodigo` int(6) NOT NULL,
  `mensalidadeContratoCodigo` int(6) NOT NULL,
  `mensalidadeAluguelData` date NOT NULL,
  `mensalidadeAluguelTotalValor` decimal(10,2) NOT NULL,
  `mensalidadeCondominioValor` decimal(10,2) NOT NULL,
  `mensalidadeIptuValor` decimal(10,2) NOT NULL,
  `mensalidadeTaxaAdministracaoValor` decimal(10,2) NOT NULL,
  `mensalidadeDataRecebimento` date DEFAULT NULL,
  `mensalidadeInsercaoData` date NOT NULL,
  `mensalidadeInsercaoUsuarioCodigo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensalidade`
--

INSERT INTO `mensalidade` (`mensalidadeCodigo`, `mensalidadeContratoCodigo`, `mensalidadeAluguelData`, `mensalidadeAluguelTotalValor`, `mensalidadeCondominioValor`, `mensalidadeIptuValor`, `mensalidadeTaxaAdministracaoValor`, `mensalidadeDataRecebimento`, `mensalidadeInsercaoData`, `mensalidadeInsercaoUsuarioCodigo`) VALUES
(121, 12, '2022-07-01', '889.00', '105.00', '14.00', '35.00', NULL, '2022-06-10', 1),
(122, 12, '2022-08-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1),
(123, 12, '2022-09-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1),
(124, 12, '2022-10-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1),
(125, 12, '2022-11-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1),
(126, 12, '2022-12-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1),
(127, 12, '2023-01-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1),
(128, 12, '2023-02-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1),
(129, 12, '2023-03-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1),
(130, 12, '2023-04-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1),
(131, 12, '2023-05-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1),
(132, 12, '2023-06-01', '1270.00', '150.00', '20.00', '50.00', NULL, '2022-06-10', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `repasse`
--

CREATE TABLE `repasse` (
  `repasseCodigo` int(6) NOT NULL,
  `repasseContratoCodigo` int(6) NOT NULL,
  `repasseDataAluguel` date DEFAULT NULL,
  `repasseValor` decimal(10,2) NOT NULL,
  `repasseDataEfetuado` date DEFAULT NULL,
  `repasseInsercaoData` date NOT NULL,
  `repasseInsercaoUsuarioCodigo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `repasse`
--

INSERT INTO `repasse` (`repasseCodigo`, `repasseContratoCodigo`, `repasseDataAluguel`, `repasseValor`, `repasseDataEfetuado`, `repasseInsercaoData`, `repasseInsercaoUsuarioCodigo`) VALUES
(97, 12, '2022-07-01', '749.00', NULL, '2022-06-10', 1),
(98, 12, '2022-08-01', '1070.00', NULL, '2022-06-10', 1),
(99, 12, '2022-09-01', '1070.00', NULL, '2022-06-10', 1),
(100, 12, '2022-10-01', '1070.00', NULL, '2022-06-10', 1),
(101, 12, '2022-11-01', '1070.00', NULL, '2022-06-10', 1),
(102, 12, '2022-12-01', '1070.00', NULL, '2022-06-10', 1),
(103, 12, '2023-01-01', '1070.00', NULL, '2022-06-10', 1),
(104, 12, '2023-02-01', '1070.00', NULL, '2022-06-10', 1),
(105, 12, '2023-03-01', '1070.00', NULL, '2022-06-10', 1),
(106, 12, '2023-04-01', '1070.00', NULL, '2022-06-10', 1),
(107, 12, '2023-05-01', '1070.00', NULL, '2022-06-10', 1),
(108, 12, '2023-06-01', '1070.00', NULL, '2022-06-10', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuarioCodigo` int(6) NOT NULL,
  `usuarioNome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usuarioCelular` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `usuarioEmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usuarioSenha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usuarioFoto` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'foto-perfil.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuarioCodigo`, `usuarioNome`, `usuarioCelular`, `usuarioEmail`, `usuarioSenha`, `usuarioFoto`) VALUES
(1, 'rodrigo koch', '47988205742', 'rodrigojoi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '629ffe8d86949.png'),
(4, 'Usuario 2', '4788990099', 'usuario2@mail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'foto-perfil.jpg'),
(5, 'Teste 2', '3232323', 'email@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'foto-perfil.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `condominio`
--
ALTER TABLE `condominio`
  ADD PRIMARY KEY (`condominioCodigo`),
  ADD KEY `condominioContrato` (`condominioContratoCodigo`);

--
-- Índices para tabela `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`contratoCodigo`),
  ADD KEY `contratoImovel` (`contratoImovelCodigo`),
  ADD KEY `contratoLocatario` (`contratoLocatarioCodigo`);

--
-- Índices para tabela `imovel`
--
ALTER TABLE `imovel`
  ADD PRIMARY KEY (`imovelCodigo`),
  ADD KEY `imovelLocador` (`imovelLocadorCodigo`);

--
-- Índices para tabela `locador`
--
ALTER TABLE `locador`
  ADD PRIMARY KEY (`locadorCodigo`),
  ADD KEY `locadorNome` (`locadorNome`);

--
-- Índices para tabela `locatario`
--
ALTER TABLE `locatario`
  ADD PRIMARY KEY (`locatarioCodigo`),
  ADD KEY `locatarioNome` (`locatarioNome`);

--
-- Índices para tabela `mensalidade`
--
ALTER TABLE `mensalidade`
  ADD PRIMARY KEY (`mensalidadeCodigo`),
  ADD KEY `mensalidadeCodigo` (`mensalidadeContratoCodigo`);

--
-- Índices para tabela `repasse`
--
ALTER TABLE `repasse`
  ADD PRIMARY KEY (`repasseCodigo`),
  ADD KEY `repasseContrato` (`repasseContratoCodigo`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuarioCodigo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `condominio`
--
ALTER TABLE `condominio`
  MODIFY `condominioCodigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `contrato`
--
ALTER TABLE `contrato`
  MODIFY `contratoCodigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `imovel`
--
ALTER TABLE `imovel`
  MODIFY `imovelCodigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `locador`
--
ALTER TABLE `locador`
  MODIFY `locadorCodigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `locatario`
--
ALTER TABLE `locatario`
  MODIFY `locatarioCodigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `mensalidade`
--
ALTER TABLE `mensalidade`
  MODIFY `mensalidadeCodigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de tabela `repasse`
--
ALTER TABLE `repasse`
  MODIFY `repasseCodigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuarioCodigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `condominio`
--
ALTER TABLE `condominio`
  ADD CONSTRAINT `condominioContrato` FOREIGN KEY (`condominioContratoCodigo`) REFERENCES `contrato` (`contratoCodigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contratoImovel` FOREIGN KEY (`contratoImovelCodigo`) REFERENCES `imovel` (`imovelCodigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contratoLocatario` FOREIGN KEY (`contratoLocatarioCodigo`) REFERENCES `locatario` (`locatarioCodigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `imovel`
--
ALTER TABLE `imovel`
  ADD CONSTRAINT `imovelLocador` FOREIGN KEY (`imovelLocadorCodigo`) REFERENCES `locador` (`locadorCodigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `mensalidade`
--
ALTER TABLE `mensalidade`
  ADD CONSTRAINT `mensalidadeCodigo` FOREIGN KEY (`mensalidadeContratoCodigo`) REFERENCES `contrato` (`contratoCodigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `repasse`
--
ALTER TABLE `repasse`
  ADD CONSTRAINT `repasseContrato` FOREIGN KEY (`repasseContratoCodigo`) REFERENCES `contrato` (`contratoCodigo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
