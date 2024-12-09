-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/12/2024 às 23:50
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
VALUES (9, 'Joao Bandeira', 32, '1234 5678 9012 3456', 9),
  (
    10,
    'Marcio Araújo',
    24,
    '9876 5432 1098 7654',
    12
  ),
  (
    11,
    'Carlos Jobim',
    34,
    '1122 3344 5566 7788',
    10
  ),
  (13, 'Luciano Amaral', 20, '8765432109876543', 8),
  (14, 'Rihan Foza', 28, '4433221188996677', 13),
  (15, 'Leonardo Bratz', 49, '5566778899001122', 14);
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
    'Posto Osasco',
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
  ),
  (
    2,
    'Posto Vasco',
    '2021',
    'Rio de Janeiro',
    -43.20958700,
    -22.90353900,
    'Rua do Ouvidor, 45',
    4.99,
    5.69,
    5.49,
    6.19,
    5.39
  ),
  (
    3,
    'Posto Nego Di',
    '2019',
    'Porto Alegre',
    -51.22969500,
    -30.03465700,
    'Av. Borges de Medeiros, 300',
    6.19,
    5.99,
    6.39,
    7.49,
    6.59
  ),
  (
    4,
    'Posto Ressacada',
    '2022',
    'São José',
    -48.60114000,
    -26.90542000,
    'Av. dos Eucaliptos, 567',
    5.59,
    6.09,
    5.79,
    6.39,
    5.99
  ),
  (
    5,
    'Posto Uri',
    '2023',
    'Santo Ângelo',
    -54.27165300,
    -28.28370700,
    'Rua Coronel Sezefredo, 1100',
    5.49,
    5.99,
    6.29,
    6.79,
    5.69
  ),
  (
    6,
    'Posto 344',
    '2023',
    'Santo Ângelo',
    -54.28023400,
    -28.29174500,
    'Rua 7 de Setembro, 235',
    5.39,
    5.79,
    6.09,
    6.49,
    5.89
  ),
  (
    7,
    'Posto Floripa',
    '2024',
    'Santo Ângelo',
    -54.26500200,
    -28.27500300,
    'Rua dos Três Passos, 56',
    5.49,
    6.19,
    5.99,
    6.29,
    5.59
  ),
  (
    8,
    'Posto Caxias',
    '2021',
    'Caxias do Sul',
    -51.17926000,
    -29.16793000,
    'Av. Júlio de Castilhos, 432',
    5.89,
    6.29,
    5.69,
    6.19,
    5.79
  ),
  (
    9,
    'Posto gramado',
    '2022',
    'Gramado',
    -50.86813000,
    -29.37515300,
    'Rua Borges de Medeiros, 1020',
    6.29,
    6.09,
    6.49,
    7.09,
    6.79
  ),
  (
    10,
    'Posto Pelotas',
    '2023',
    'Pelotas',
    -52.34352700,
    -31.77599600,
    'Av. Duque de Caxias, 789',
    5.59,
    5.79,
    6.09,
    6.49,
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
VALUES ('lucas', 'lucas', 1, 'user', 13),
  ('admin', 'admin', 3, 'admin', NULL),
  ('marcio', '0000', 4, 'user', 10),
  ('juninho', '1234', 10, 'user', 15),
  ('bruno', 'bruno', 12, 'user', 14);
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
VALUES (
    8,
    '2022-01-01',
    'Corolla 2005',
    1,
    8.00,
    'ABC-1234'
  ),
  (
    9,
    '2022-01-01',
    'GOL 2008',
    2,
    12.00,
    'XYZ-5678'
  ),
  (
    10,
    '2022-01-01',
    'Uno com Escada',
    2,
    16.00,
    'WLM-9876'
  ),
  (
    12,
    '2002-02-02',
    'Hilux 2015',
    3,
    7.00,
    'JKL-4321'
  ),
  (
    13,
    '2012-12-05',
    'Onibûs Mercedez',
    6,
    9.00,
    'TUV-1023'
  ),
  (
    14,
    '2024-12-05',
    'Scania 2010',
    4,
    5.00,
    'MNO-7654'
  ),
  (
    15,
    '2024-12-02',
    'Honda Biz 2010',
    8,
    50.00,
    'PQR-8765'
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
  `val_combustivel` float DEFAULT NULL
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
    567.352
  ),
  (
    7,
    9,
    -28.27834880,
    -54.24367050,
    -29.68950570,
    -53.79233010,
    '220 km',
    '3 horas 6 minutos',
    '2024-12-04 14:59:37',
    290.95
  ),
  (
    8,
    9,
    -23.55578130,
    -46.63953710,
    -8.05782880,
    -34.88291390,
    '2.665 km',
    '1 dia 13 horas',
    '2024-12-04 15:30:03',
    3.52446
  ),
  (
    10,
    9,
    -28.26672260,
    -54.22483460,
    -27.66865500,
    -54.11148520,
    '105 km',
    '1 hora 21 minutos',
    '2024-12-05 01:10:13',
    138.863
  ),
  (
    11,
    9,
    -23.55578130,
    -46.63953710,
    -8.05782880,
    -34.88291390,
    '2.665 km',
    '1 dia 13 horas',
    '2024-12-05 10:47:17',
    4.25734
  ),
  (
    12,
    9,
    -28.27834880,
    -54.24367050,
    -31.77002240,
    -52.33133530,
    '512 km',
    '7 horas 17 minutos',
    '2024-12-05 10:50:49',
    920.32
  ),
  (
    13,
    9,
    -28.27897750,
    -54.25806520,
    -8.05782880,
    -34.88291390,
    '3.863 km',
    '2 dias 5 horas',
    '2024-12-05 11:02:28',
    6.17114
  ),
  (
    14,
    9,
    -28.27896720,
    -54.25806610,
    -27.87092830,
    -54.48330280,
    '56,3 km',
    '48 minutos',
    '2024-12-05 22:45:41',
    100.66
  ),
  (
    15,
    9,
    -28.27896720,
    -54.25806610,
    -28.73124510,
    -54.90249880,
    '119 km',
    '1 hora 42 minutos',
    '2024-12-05 22:51:49',
    157.378
  ),
  (
    16,
    9,
    -28.27896720,
    -54.25806610,
    -8.05782880,
    -34.88291390,
    '3.863 km',
    '2 dias 5 horas',
    '2024-12-05 22:54:43',
    5.10882
  ),
  (
    17,
    9,
    -28.27896720,
    -54.25806610,
    -7.19971480,
    -59.89162460,
    '3.930 km',
    '2 dias 5 horas',
    '2024-12-05 22:57:32',
    5.19742
  ),
  (
    18,
    9,
    -28.26672010,
    -54.22484240,
    -27.87092830,
    -54.48330280,
    '60,6 km',
    '53 minutos',
    '2024-12-06 22:25:25',
    95.85
  ),
  (
    19,
    9,
    -28.27186730,
    -54.22646970,
    -31.77002240,
    -52.33133530,
    '510 km',
    '7 horas 13 minutos',
    '2024-12-06 22:29:08',
    674.475
  ),
  (
    20,
    9,
    -28.27186730,
    -54.22646970,
    -5.78416020,
    -35.19999560,
    '4.145 km',
    '2 dias 8 horas',
    '2024-12-06 22:46:37',
    6.62164
  ),
  (
    21,
    9,
    -28.28006730,
    -54.24838900,
    -29.17401680,
    -51.18119410,
    '433 km',
    '6 horas 12 minutos',
    '2024-12-09 15:06:05',
    572.643
  ),
  (
    22,
    13,
    -28.26670740,
    -54.22488320,
    -29.68190250,
    -49.97566030,
    '574 km',
    '7 horas 27 minutos',
    '2024-12-09 22:45:33',
    73.3572
  ),
  (
    23,
    13,
    -28.26670740,
    -54.22488300,
    -29.68190250,
    -49.97566030,
    '574 km',
    '7 horas 27 minutos',
    '2024-12-09 22:49:29',
    458.483
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
  ADD UNIQUE KEY `unique_id_veiculo` (`id_veiculo`),
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
  ADD UNIQUE KEY `unique_id_motorista` (`id_motorista`);
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
  AUTO_INCREMENT = 16;
--
-- AUTO_INCREMENT de tabela `ponto`
--
ALTER TABLE `ponto`
MODIFY `id_ponto` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 13;
--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 16;
--
-- AUTO_INCREMENT de tabela `viagens`
--
ALTER TABLE `viagens`
MODIFY `id_viagem` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 24;
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