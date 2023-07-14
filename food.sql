-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Set-2022 às 00:29
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `food`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairros`
--

CREATE TABLE `bairros` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `cidade` varchar(20) NOT NULL DEFAULT 'Sertãozinho',
  `valor_entrega` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bairros`
--

INSERT INTO `bairros` (`id`, `nome`, `slug`, `cidade`, `valor_entrega`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Vila Industrial', 'vila-industrial', 'Sertãozinho', '7000.00', 1, '2022-09-01 14:06:52', '2022-09-01 15:28:52', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `slug`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Pizza Doce', 'pizza-doce', 1, '2022-08-24 15:18:21', '2022-08-30 11:26:29', NULL),
(2, 'Porções', 'porcoes', 1, '2022-08-24 17:12:46', '2022-08-24 23:26:42', NULL),
(3, 'Pizza Salgada', 'pizza-salgada', 1, '2022-08-24 19:49:55', '2022-08-24 19:50:26', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregadores`
--

CREATE TABLE `entregadores` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `cnh` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(240) NOT NULL,
  `imagem` varchar(240) DEFAULT NULL,
  `veiculo` varchar(240) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entregadores`
--

INSERT INTO `entregadores` (`id`, `nome`, `cpf`, `cnh`, `email`, `telefone`, `endereco`, `imagem`, `veiculo`, `placa`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(2, 'José Claudio Reis', '000.964.080-06', '30367559953', 'josereis@email.com', '(16) 77777-7777', 'Rua do João - 178 - São João', '1662048819_06ca811036e913733ed0.jpg', 'Fan 150 - Prata - 2015', 'BRA-0S17', 1, '2022-09-01 12:34:39', '2022-09-01 13:13:40', NULL),
(3, 'Batman', '848.776.720-60', '39328524630', 'batman@email.com', '(16) 22222-2222', 'Batcaverna - 1530 - Gothan', '1662048791_9ad17bb3bb5c1234091b.jpg', 'Batmoto 1250 - Preto - 2022', 'GHT-0539', 1, '2022-09-01 12:50:53', '2022-09-01 13:13:11', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `extras`
--

CREATE TABLE `extras` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `extras`
--

INSERT INTO `extras` (`id`, `nome`, `slug`, `preco`, `descricao`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(3, 'Catupiry', 'catupiry', '10.00', 'Catupiry para extras', 1, '2022-08-24 22:53:03', '2022-08-31 11:03:17', NULL),
(4, 'Azeitonas', 'azeitonas', '5.00', 'Azeitonas para adicionar em pizzas', 1, '2022-08-24 23:24:41', '2022-08-24 23:32:49', NULL),
(5, 'Cebola', 'cebola', '2.00', 'Adicional de cebola', 1, '2022-08-25 11:20:11', '2022-08-30 11:23:33', NULL),
(6, 'Onion Rings', 'onion-rings', '5.00', 'Anel de cebola empanadas ', 1, '2022-08-26 13:55:35', '2022-08-26 13:55:35', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pagamento`
--

CREATE TABLE `formas_pagamento` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formas_pagamento`
--

INSERT INTO `formas_pagamento` (`id`, `nome`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(2, 'Dinheiro', 1, '2022-08-30 16:27:03', '2022-08-30 16:27:09', NULL),
(3, 'Crédito', 1, '2022-08-31 15:47:38', '2022-08-31 22:44:50', NULL),
(4, 'Débito', 1, '2022-08-31 16:35:37', '2022-08-31 17:25:42', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medidas`
--

CREATE TABLE `medidas` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medidas`
--

INSERT INTO `medidas` (`id`, `nome`, `descricao`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Pizza Grande', 'Pizza Grande 12 pedaços', 1, '2022-08-25 09:51:52', '2022-08-29 14:58:15', NULL),
(2, 'Pizza Média', 'Pizza Média 8 pedaços', 1, '2022-08-25 11:48:00', '2022-08-25 11:48:34', NULL),
(3, 'Pizza Pequena', 'pizza pequena 4 pedaços', 1, '2022-08-29 16:20:40', '2022-08-30 11:06:11', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2022-08-16-113640', 'App\\Database\\Migrations\\CriaTabelaUsuarios', 'default', 'App', 1660658438, 1),
(4, '2022-08-24-174127', 'App\\Database\\Migrations\\CriaTabelaCategorias', 'default', 'App', 1661364919, 2),
(5, '2022-08-24-222718', 'App\\Database\\Migrations\\CriaTabelaExtras', 'default', 'App', 1661380360, 3),
(6, '2022-08-25-124649', 'App\\Database\\Migrations\\CriaTabelaMedidas', 'default', 'App', 1661431836, 4),
(7, '2022-08-25-150429', 'App\\Database\\Migrations\\CriaTabelaProdutos', 'default', 'App', 1661440596, 5),
(8, '2022-08-26-144714', 'App\\Database\\Migrations\\CriaTabelaProdutosExtras', 'default', 'App', 1661525476, 6),
(9, '2022-08-29-160402', 'App\\Database\\Migrations\\CriaTabelaProdutosEspecificacoes', 'default', 'App', 1661789285, 7),
(10, '2022-08-30-184833', 'App\\Database\\Migrations\\CriaTabelaFormasPagamento', 'default', 'App', 1661886607, 8),
(11, '2022-09-01-123608', 'App\\Database\\Migrations\\CriaTabelaEntregadores', 'default', 'App', 1662036257, 9),
(12, '2022-09-01-165935', 'App\\Database\\Migrations\\CriaTabelaBairros', 'default', 'App', 1662051800, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(5) UNSIGNED NOT NULL,
  `categoria_id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `ingredientes` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `imagem` varchar(200) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `categoria_id`, `nome`, `slug`, `ingredientes`, `ativo`, `imagem`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(9, 3, 'Pizza Calabresa', 'pizza-calabresa', 'calabresa, cebola', 1, '1661976162_7d24492663299c8ef97c.jpg', '2022-08-30 12:18:56', '2022-08-31 17:02:42', NULL),
(10, 2, 'Batata', 'batata', 'batata frita', 1, '1661879601_ba87c825d0199af36229.jpg', '2022-08-30 12:36:38', '2022-08-30 14:13:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_especificacoes`
--

CREATE TABLE `produtos_especificacoes` (
  `id` int(5) UNSIGNED NOT NULL,
  `produto_id` int(5) UNSIGNED NOT NULL,
  `medida_id` int(5) UNSIGNED NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `customizavel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_extras`
--

CREATE TABLE `produtos_extras` (
  `id` int(5) UNSIGNED NOT NULL,
  `produto_id` int(5) UNSIGNED NOT NULL,
  `extra_id` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos_extras`
--

INSERT INTO `produtos_extras` (`id`, `produto_id`, `extra_id`) VALUES
(13, 9, 4),
(14, 10, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 0,
  `password_hash` varchar(255) NOT NULL,
  `ativacao_hash` varchar(64) DEFAULT NULL,
  `reset_hash` varchar(64) DEFAULT NULL,
  `reset_expira_em` datetime DEFAULT NULL,
  `criado_em` datetime NOT NULL,
  `atualizado_em` datetime NOT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `is_admin`, `ativo`, `password_hash`, `ativacao_hash`, `reset_hash`, `reset_expira_em`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(15, 'Roberto Teste', 'masek99518@xitudy.com', '485.317.100-22', '(44) 44444-4444', 0, 0, '$2y$10$B2CzXrh2.cF2xn.iQArZA.moxWrl6gxTq3zDFAYZcImwi0kjxaUBi', NULL, 'abb0ca6193c76d7be51a2e021792ca320512e24b4cc371ae1187e713d8530b1b', '2022-08-24 11:27:32', '2022-08-22 08:40:55', '2022-09-01 10:24:30', NULL),
(14, 'Ana Lucia Martins', 'rgm.martins.rg@gmail.com', '387.680.990-88', '(66) 66666-6666', 1, 1, '$2y$10$pEdO2eKIJ3D3ZlFbNgxeXOXXcEVhYNyESEs0eXLJrUzbpkRe/l9d.', NULL, '300ec55dee23ff77ae701c3a9369c579f92646ef3a22919d5f053d109cfdc2dc', '2022-08-24 11:36:44', '2022-08-22 08:40:23', '2022-08-24 09:36:44', NULL),
(13, 'Luna', 'luna@email.com', '687.271.230-90', '(11) 11111-1111', 0, 1, '$2y$10$nbh3kyEBohtQ49PuItxvmu8CRsFFw/ILKhTDsI1z848gNeqrimCTK', NULL, NULL, NULL, '2022-08-21 18:34:40', '2022-09-01 10:24:41', NULL),
(12, 'Renê Gustavo Martins', 'rene.skyline@hotmail.com', '422.885.468-08', '(16) 98833-3809', 1, 1, '$2y$10$AnM/czI8k5yYRKyTwd1NHO4hNKN0bWu86rX.aIyez6b/WUILnL2AO', NULL, NULL, NULL, '2022-08-21 18:33:55', '2022-08-24 10:05:53', NULL),
(16, 'Luis Sergio', 'luis@email.com', '579.080.570-12', '(22) 22222-2222', 0, 1, '$2y$10$D/btVuaVyAfH0D0k5Z02XOoqtEe7snIcSnX9Fbij.pXmYMNMA/8Sm', NULL, NULL, NULL, '2022-08-22 08:41:40', '2022-08-22 08:41:40', NULL),
(17, 'Telog', 'equipe.ti@telog.com.br', '132.176.080-97', '(77) 77777-7777', 0, 1, '$2y$10$0w2f1LjuxjiA1iehJ6xNveewy48hMK/DzvbxXCzkljoA6lWOt06Yi', NULL, NULL, NULL, '2022-08-22 08:42:11', '2022-08-22 08:42:11', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `entregadores`
--
ALTER TABLE `entregadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `cnh` (`cnh`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- Índices para tabela `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `produtos_categoria_id_foreign` (`categoria_id`);

--
-- Índices para tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_especificacoes_produto_id_foreign` (`produto_id`),
  ADD KEY `produtos_especificacoes_medida_id_foreign` (`medida_id`);

--
-- Índices para tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_extras_produto_id_foreign` (`produto_id`),
  ADD KEY `produtos_extras_extra_id_foreign` (`extra_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `ativacao_hash` (`ativacao_hash`),
  ADD UNIQUE KEY `reset_hash` (`reset_hash`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `entregadores`
--
ALTER TABLE `entregadores`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Limitadores para a tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  ADD CONSTRAINT `produtos_especificacoes_medida_id_foreign` FOREIGN KEY (`medida_id`) REFERENCES `medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_especificacoes_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  ADD CONSTRAINT `produtos_extras_extra_id_foreign` FOREIGN KEY (`extra_id`) REFERENCES `extras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_extras_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
