-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/12/2024 às 15:27
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Despejando dados para a tabela `categoriaveiculo`
--

INSERT INTO `categoriaveiculo` (`id_categoria`, `nome_categoria`)
VALUES (1, 'Sedan'),
  (2, 'Ret'),
  (3, 'Pickup'),
  (4, 'Caminhão'),
  (5, 'micro ônibus'),
  (6, 'ônibus'),
  (7, 'Bi-Trem'),
  (8, 'Moto'),
  (9, 'Esportivo');
-- --------------------------------------------------------
--
-- Estrutura para tabela `motorista`
--

CREATE TABLE `motorista` (
  `id_motorista` int(11) NOT NULL,
  `nome_motorista` varchar(100) NOT NULL,
  `idade_motorista` int(11) NOT NULL,
  `cnh` varchar(20) NOT NULL,
  `id_veiculo` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Despejando dados para a tabela `motorista`
--

INSERT INTO `motorista` (
    `id_motorista`,
    `nome_motorista`,
    `idade_motorista`,
    `cnh`,
    `id_veiculo`
  )
VALUES (6, 'hfdh', 32, '23', 9),
  (9, 'joao', 32, '3131', 8);
-- --------------------------------------------------------
--
-- Estrutura para tabela `ponto`
--

CREATE TABLE `ponto` (
  `id_ponto` int(11) NOT NULL,
  `nome_ponto` varchar(100) NOT NULL,
  `ano_adicao` year(4) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `longitude` decimal(10, 8) DEFAULT NULL,
  `latitude` decimal(10, 8) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `preco1` decimal(6, 2) DEFAULT NULL,
  `preco2` decimal(6, 2) DEFAULT NULL,
  `preco3` decimal(6, 2) DEFAULT NULL,
  `preco4` decimal(6, 2) DEFAULT NULL,
  `preco5` decimal(6, 2) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Despejando dados para a tabela `ponto`
--

INSERT INTO `ponto` (
    `id_ponto`,
    `nome_ponto`,
    `ano_adicao`,
    `cidade`,
    `longitude`,
    `latitude`,
    `endereco`,
    `preco1`,
    `preco2`,
    `preco3`,
    `preco4`,
    `preco5`
  )
VALUES (
    1,
    'Posto 1',
    '2020',
    'São Paulo',
    -46.63330800,
    -23.55052000,
    'Av. Paulista, 123',
    5.29,
    6.39,
    4.89,
    7.19,
    5.99
  );
-- --------------------------------------------------------
--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `nome_usuario` varchar(255) NOT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_usuario` enum('admin', 'user') DEFAULT 'user',
  `id_motorista` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (
    `nome_usuario`,
    `senha_usuario`,
    `id_usuario`,
    `tipo_usuario`,
    `id_motorista`
  )
VALUES ('lucas', 'lucas123', 1, 'user', 9),
  ('admin', 'admin', 3, 'admin', NULL);
-- --------------------------------------------------------
--
-- Estrutura para tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id_veiculo` int(11) NOT NULL,
  `ano_modelo` varchar(100) NOT NULL,
  `nome_veiculo` varchar(255) NOT NULL,
  `Id_categoria` int(11) DEFAULT NULL,
  `media_veiculo` decimal(5, 2) DEFAULT NULL,
  `placa_veiculo` varchar(20) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Despejando dados para a tabela `veiculo`
--

INSERT INTO `veiculo` (
    `id_veiculo`,
    `ano_modelo`,
    `nome_veiculo`,
    `Id_categoria`,
    `media_veiculo`,
    `placa_veiculo`
  )
VALUES (8, '2022-01-01', 'Corolla', 1, 4.00, 'qwdwd'),
  (9, '2022-01-01', 'rfewfre', 1, 4.00, 'qwdwd'),
  (
    10,
    '2022-01-01',
    'Corolla3sdrg',
    1,
    4.00,
    'qwdwd'
  ),
  (
    12,
    '2002-02-02',
    'wefewf',
    1,
    4.00,
    'dwefy4y3y34y'
  );
-- --------------------------------------------------------
--
-- Estrutura para tabela `viagens`
--

CREATE TABLE `viagens` (
  `id_viagem` int(11) NOT NULL,
  `id_motorista` int(11) NOT NULL,
  `origemLat` decimal(10, 8) NOT NULL,
  `origemLng` decimal(11, 8) NOT NULL,
  `destLat` decimal(10, 8) NOT NULL,
  `destLng` decimal(11, 8) NOT NULL,
  `distancia` varchar(50) NOT NULL,
  `duracao` varchar(50) NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `val_combustivel` decimal(10, 2) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Despejando dados para a tabela `viagens`
--

INSERT INTO `viagens` (
    `id_viagem`,
    `id_motorista`,
    `origemLat`,
    `origemLng`,
    `destLat`,
    `destLng`,
    `distancia`,
    `duracao`,
    `data_hora`,
    `val_combustivel`
  )
VALUES (
    3,
    9,
    -23.55050000,
    -46.63330000,
    -22.90680000,
    -43.17290000,
    '429 km',
    '5h 30m',
    '2024-12-04 14:00:01',
    NULL
  ),
  (
    4,
    9,
    -28.27834880,
    -54.24367050,
    -29.17401680,
    -51.18119410,
    '433 km',
    '6 horas 12 minutos',
    '2024-12-04 14:24:50',
    NULL
  );
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
ADD PRIMARY KEY (`id_motorista`),
  ADD KEY `fk_motorista_veiculo` (`id_veiculo`);
--
-- Índices de tabela `ponto`
--
ALTER TABLE `ponto`
ADD PRIMARY KEY (`id_ponto`);
--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_id_motorista` (`id_motorista`);
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
ADD PRIMARY KEY (`id_viagem`),
  ADD KEY `fk_motorista` (`id_motorista`);
--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoriaveiculo`
--
ALTER TABLE `categoriaveiculo`
MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 10;
--
-- AUTO_INCREMENT de tabela `motorista`
--
ALTER TABLE `motorista`
MODIFY `id_motorista` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 10;
--
-- AUTO_INCREMENT de tabela `ponto`
--
ALTER TABLE `ponto`
MODIFY `id_ponto` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 13;
--
-- AUTO_INCREMENT de tabela `viagens`
--
ALTER TABLE `viagens`
MODIFY `id_viagem` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;
--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `motorista`
--
ALTER TABLE `motorista`
ADD CONSTRAINT `fk_motorista_veiculo` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id_veiculo`) ON DELETE
SET NULL;
--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fk_id_motorista` FOREIGN KEY (`id_motorista`) REFERENCES `motorista` (`id_motorista`) ON DELETE
SET NULL;
--
-- Restrições para tabelas `veiculo`
--
ALTER TABLE `veiculo`
ADD CONSTRAINT `fk_veiculo_categoria` FOREIGN KEY (`Id_categoria`) REFERENCES `categoriaveiculo` (`id_categoria`) ON DELETE
SET NULL;
--
-- Restrições para tabelas `viagens`
--
ALTER TABLE `viagens`
ADD CONSTRAINT `fk_motorista` FOREIGN KEY (`id_motorista`) REFERENCES `motorista` (`id_motorista`);
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;