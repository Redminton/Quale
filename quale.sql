-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/11/2024 às 03:01
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `quale`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoriaveiculo`
--

CREATE TABLE `categoriaveiculo` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoriaveiculo`
--

INSERT INTO `categoriaveiculo` (`id_categoria`, `nome_categoria`) VALUES
(1, 'Sedan');

-- --------------------------------------------------------

--
-- Estrutura para tabela `motorista`
--

CREATE TABLE `motorista` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idade` int(11) NOT NULL,
  `IDveiculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ponto`
--

CREATE TABLE `ponto` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ano_adicao` year(4) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `preco1` decimal(6,2) DEFAULT NULL,
  `preco2` decimal(6,2) DEFAULT NULL,
  `preco3` decimal(6,2) DEFAULT NULL,
  `preco4` decimal(6,2) DEFAULT NULL,
  `preco5` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `nome_usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`nome_usuario`, `senha`, `id`) VALUES
('lucas', 'lucas123', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id_veiculo` int(11) NOT NULL,
  `ano_modelo` varchar(100) NOT NULL,
  `nome_veiculo` varchar(255) NOT NULL,
  `Id_categoria` int(11) DEFAULT NULL,
  `media_veiculo` decimal(5,2) DEFAULT NULL,
  `placa_veiculo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `veiculo`
--

INSERT INTO `veiculo` (`id_veiculo`, `ano_modelo`, `nome_veiculo`, `Id_categoria`, `media_veiculo`, `placa_veiculo`) VALUES
(1, '2024-10-31', 'fefew', 1, 5.00, 'fef'),
(2, '2024-11-06', 'fefew', 1, 5.00, 'fef'),
(3, '2024-11-04', 'fwefwef', 1, 3.00, 'ffew'),
(4, '2024-11-01', 'dwdw', 1, 2.00, 'dwqdq');

-- --------------------------------------------------------

--
-- Estrutura para tabela `viagens`
--

CREATE TABLE `viagens` (
  `id` int(11) NOT NULL,
  `IDmotorista` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `latitude2` decimal(10,8) DEFAULT NULL,
  `longitude2` decimal(10,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoriaveiculo`
--
ALTER TABLE `categoriaveiculo`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `motorista`
--
ALTER TABLE `motorista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_motorista_veiculo` (`IDveiculo`);

--
-- Índices de tabela `ponto`
--
ALTER TABLE `ponto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id_veiculo`),
  ADD KEY `fk_veiculo_categoria` (`Id_categoria`);

--
-- Índices de tabela `viagens`
--
ALTER TABLE `viagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_viagens_motorista` (`IDmotorista`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoriaveiculo`
--
ALTER TABLE `categoriaveiculo`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `motorista`
--
ALTER TABLE `motorista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ponto`
--
ALTER TABLE `ponto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `viagens`
--
ALTER TABLE `viagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `motorista`
--
ALTER TABLE `motorista`
  ADD CONSTRAINT `fk_motorista_veiculo` FOREIGN KEY (`IDveiculo`) REFERENCES `veiculo` (`id_veiculo`) ON DELETE SET NULL;

--
-- Restrições para tabelas `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `fk_veiculo_categoria` FOREIGN KEY (`Id_categoria`) REFERENCES `categoriaveiculo` (`id_categoria`) ON DELETE SET NULL;

--
-- Restrições para tabelas `viagens`
--
ALTER TABLE `viagens`
  ADD CONSTRAINT `fk_viagens_motorista` FOREIGN KEY (`IDmotorista`) REFERENCES `motorista` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
