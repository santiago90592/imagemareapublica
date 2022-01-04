-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jan-2022 às 20:25
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.23

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
  `nome` varchar(120) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `cidade` varchar(20) NOT NULL DEFAULT 'Mindelo',
  `valor_entrega` int(10) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bairros`
--

INSERT INTO `bairros` (`id`, `nome`, `slug`, `cidade`, `valor_entrega`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Alto Miramar', 'alto-miramar', 'Mindelo', 100, 1, '2021-12-29 11:07:56', '2021-12-29 16:30:49', NULL),
(2, 'Campim', 'campim', 'Mindelo', 100, 1, '2021-12-30 16:36:12', '2021-12-30 17:02:30', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(120) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `slug`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Pizzas salgadas', 'pizzas-salgadas', 1, '2021-11-09 10:56:16', '2022-01-04 17:08:46', NULL),
(2, 'Porções', 'porcoes', 1, '2021-11-10 10:57:43', '2021-11-11 12:00:10', NULL),
(4, 'Pizzas doces', 'pizzas-doces', 1, '2022-01-04 10:06:18', '2022-01-04 17:09:24', NULL),
(5, 'Bebidas sem álcool', 'bebidas-sem-alcool', 1, '2022-01-04 10:12:58', '2022-01-04 10:12:58', NULL),
(6, 'Bebidas alcoólicas', 'bebidas-alcoolicas', 1, '2022-01-04 10:13:29', '2022-01-04 10:13:29', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregadores`
--

CREATE TABLE `entregadores` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(120) NOT NULL,
  `nif` varchar(20) NOT NULL,
  `cartadeconducao` varchar(20) NOT NULL,
  `email` varchar(120) NOT NULL,
  `telefone` varchar(7) NOT NULL,
  `endereco` varchar(240) NOT NULL,
  `imagem` varchar(240) DEFAULT NULL,
  `veiculo` varchar(240) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entregadores`
--

INSERT INTO `entregadores` (`id`, `nome`, `nif`, `cartadeconducao`, `email`, `telefone`, `endereco`, `imagem`, `veiculo`, `placa`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'James Ramos', '124785465', 'B-54781', 'j.ramos@gmail.com', '9254589', 'Espia', '1640775691_13a5523a431ee835d581.jpg', 'KT-preto', 'CMSV-2520', 1, '2021-12-29 08:43:13', '2021-12-29 10:01:31', NULL),
(2, 'Márcia Andrade ', '147852359', 'B-5478', 'marcia@gmail.com', '9565856', 'Espia', '1640778061_cb2e891ebb8479200d52.jpg', 'Starlet vermelho', 'SV-10-HB', 1, '2021-12-29 08:51:15', '2021-12-29 10:41:01', NULL),
(3, 'António', '134275546', 'D-47125', 'toi@gmail.com', '9874512', 'Campim', '1640777910_6aabb03b584611c6f896.jpg', 'Toyota - Taxy', 'SV-58-FE', 1, '2021-12-29 10:08:45', '2021-12-29 10:38:30', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `expediente`
--

CREATE TABLE `expediente` (
  `id` int(5) UNSIGNED NOT NULL,
  `dia` int(5) NOT NULL,
  `dia_descricao` varchar(50) NOT NULL,
  `abertura` time DEFAULT NULL,
  `encerramento` time DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `expediente`
--

INSERT INTO `expediente` (`id`, `dia`, `dia_descricao`, `abertura`, `encerramento`, `situacao`) VALUES
(1, 0, 'Domingo', '18:00:00', '23:00:00', 1),
(2, 1, 'Segunda', '18:00:00', '23:00:00', 1),
(3, 2, 'Terça', '18:00:00', '23:00:00', 1),
(4, 3, 'Quarta', '18:00:00', '23:00:00', 1),
(5, 4, 'Quinta', '18:00:00', '23:00:00', 1),
(6, 5, 'Sexta', '18:00:00', '23:00:00', 1),
(7, 6, 'Sábado', '18:00:00', '23:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `extras`
--

CREATE TABLE `extras` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(120) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `preco` int(10) NOT NULL,
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
(1, 'Queijo', 'queijo', 20, 'Extra de queijo no produto', 1, '2021-11-11 17:20:34', '2021-11-12 10:32:26', NULL),
(2, 'Chouriço', 'chourico', 20, 'Extra no produto', 1, '2021-11-11 18:01:43', '2021-11-12 10:29:16', NULL),
(3, 'Bacon', 'bacon', 30, 'bacon', 1, '2021-11-16 09:40:20', '2021-11-16 09:40:20', NULL),
(4, 'batata', 'batata', 50, '', 1, '2022-01-04 10:40:37', '2022-01-04 10:40:37', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pagamento`
--

CREATE TABLE `formas_pagamento` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(120) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formas_pagamento`
--

INSERT INTO `formas_pagamento` (`id`, `nome`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Dinheiro', 1, '2021-12-08 16:05:05', '2021-12-08 16:05:05', NULL),
(2, 'Cartão vinti4', 1, '2021-12-13 16:29:13', '2021-12-14 15:45:00', NULL),
(3, 'Cartão visa', 1, '2021-12-14 17:12:36', '2021-12-16 11:05:08', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medidas`
--

CREATE TABLE `medidas` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(120) NOT NULL,
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
(1, 'Pizza grande 12 fatias', 'pizza grande 12 fatias', 1, '2021-11-12 10:37:47', '2021-11-15 15:47:51', NULL),
(2, 'Pizza média 8 fatias', 'Pizza média 8 fatias', 1, '2021-11-15 15:56:41', '2021-11-15 16:18:14', NULL),
(3, 'Pizza gigante 20 fatias', 'pizza gigante', 1, '2021-11-30 16:45:47', '2021-11-30 16:45:47', NULL),
(4, '20 cl', '', 1, '2022-01-04 10:22:08', '2022-01-04 10:22:08', NULL),
(5, '25 cl', '', 1, '2022-01-04 10:22:47', '2022-01-04 10:22:47', NULL),
(6, 'Pequena', '', 1, '2022-01-04 10:31:06', '2022-01-04 10:31:06', NULL),
(7, 'Grande', '', 1, '2022-01-04 10:31:27', '2022-01-04 10:31:27', NULL),
(8, '33 cl', '', 1, '2022-01-04 15:16:17', '2022-01-04 15:16:17', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(5, '2021-09-23-104547', 'App\\Database\\Migrations\\CriaTabelaUtilizadores', 'default', 'App', 1633516005, 1),
(11, '2021-11-08-183942', 'App\\Database\\Migrations\\CriaTabelaCategorias', 'default', 'App', 1636631740, 2),
(14, '2021-11-11-130731', 'App\\Database\\Migrations\\CriaTabelaExtras', 'default', 'App', 1636654811, 3),
(15, '2021-11-12-113359', 'App\\Database\\Migrations\\CriaTabelaMedidas', 'default', 'App', 1636717045, 4),
(16, '2021-11-15-173931', 'App\\Database\\Migrations\\CriaTabelaProdutos', 'default', 'App', 1636999617, 5),
(17, '2021-11-22-175715', 'App\\Database\\Migrations\\CriaTabelaProdutosExtras', 'default', 'App', 1637604263, 6),
(18, '2021-11-30-172553', 'App\\Database\\Migrations\\CriaTabelaProdutosEspecificacoes', 'default', 'App', 1638293822, 7),
(19, '2021-12-08-160220', 'App\\Database\\Migrations\\CriaTabelaFormasPagamento', 'default', 'App', 1638979912, 8),
(21, '2021-12-16-162803', 'App\\Database\\Migrations\\CriaTabelaEntregadores', 'default', 'App', 1640770957, 9),
(22, '2021-12-29-115925', 'App\\Database\\Migrations\\CriaTabelaBairros', 'default', 'App', 1640779579, 10),
(24, '2021-12-30-180540', 'App\\Database\\Migrations\\CriaTabelaExpediente', 'default', 'App', 1640889804, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(5) UNSIGNED NOT NULL,
  `categoria_id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(120) NOT NULL,
  `slug` varchar(120) NOT NULL,
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
(1, 1, 'Pízza Margherita', 'pizza-margherita', 'Pizza Margherita', 1, '1637602606_0b955cc0c1e2a25af6c2.jpg', '2021-11-15 17:10:24', '2022-01-04 15:38:06', NULL),
(2, 2, 'Porção de batata com bacon', 'porcao-de-batata-com-bacon', 'Porção de batata com bacon', 1, '1641296303_d14a31d980775b39deaa.jpg', '2021-11-18 16:37:24', '2022-01-04 10:38:23', NULL),
(4, 1, 'Pizza Mussarela', 'pizza-mussarela', 'queijo, tomate, azeitona, molho de tomate', 1, '1641293708_9a8366fe036152fc3695.jpg', '2022-01-04 09:54:52', '2022-01-04 09:55:09', NULL),
(5, 1, 'Pizza Portuguesa', 'pizza-portuguesa', 'cebola, queijo, molho de tomate, azeitonas, orégano e ovos', 1, '1641293934_1dbdebe240c5c16c6bbe.png', '2022-01-04 09:58:43', '2022-01-04 09:59:14', NULL),
(6, 1, 'Pizza Napolitana', 'pizza-napolitana', 'queijo, tomate, azeitonas, molho de tomate', 1, '1641294187_286793ea2478a00f2bbb.webp', '2022-01-04 10:02:55', '2022-01-04 10:03:07', NULL),
(7, 4, 'Pizza Brigadeiro', 'pizza-brigadeiro', 'nutela, morango, leite condensado', 1, '1641294442_5e8e0bfab638af33a08f.png', '2022-01-04 10:07:13', '2022-01-04 10:07:22', NULL),
(8, 6, 'Super bock', 'super-bock', 'cerveja importada', 1, '1641295181_2f4f890927a84bddc380.jpg', '2022-01-04 10:18:51', '2022-01-04 10:19:41', NULL),
(9, 6, 'Heineken', 'heineken', 'cerveja importada', 1, '1641295230_048489593d81d03f90f3.jpg', '2022-01-04 10:20:22', '2022-01-04 10:20:30', NULL),
(10, 6, 'Sagres', 'sagres', 'cerveja importada', 1, '1641295269_d8bb607736f299c3feca.jpg', '2022-01-04 10:20:54', '2022-01-04 10:21:10', NULL),
(11, 2, 'Batata frita', 'batata-frita', 'batata     ', 1, '1641295718_303cb3d2669d93553449.jpg', '2022-01-04 10:28:28', '2022-01-04 10:28:38', NULL),
(12, 5, 'Sumol laranja', 'sumol-laranja', 'laranja         ', 1, '1641312535_beade2f052b6b01575d8.jpg', '2022-01-04 15:08:45', '2022-01-04 15:08:55', NULL),
(13, 5, 'Sumol maracuja', 'sumol-maracuja', 'maracujá           ', 1, '1641312844_fc977509de76300ff72a.jpg', '2022-01-04 15:09:35', '2022-01-04 15:14:04', NULL),
(14, 5, 'Compal manga', 'compal-manga', 'manga                ', 1, '1641312639_5766444772029ff38f0b.jpg', '2022-01-04 15:10:28', '2022-01-04 15:10:39', NULL),
(15, 5, 'Compal laranja', 'compal-laranja', 'laranja                   ', 1, '1641312809_03411a2611f587842421.jpg', '2022-01-04 15:11:07', '2022-01-04 15:13:29', NULL),
(16, 5, 'Compal tropical', 'compal-tropical', 'sala de frutas', 1, '1641312921_1b210074c7b549b77138.jpg', '2022-01-04 15:15:13', '2022-01-04 15:15:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_especificacoes`
--

CREATE TABLE `produtos_especificacoes` (
  `id` int(5) UNSIGNED NOT NULL,
  `produto_id` int(5) UNSIGNED NOT NULL,
  `medida_id` int(5) UNSIGNED NOT NULL,
  `preco` int(10) NOT NULL,
  `customizavel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos_especificacoes`
--

INSERT INTO `produtos_especificacoes` (`id`, `produto_id`, `medida_id`, `preco`, `customizavel`) VALUES
(2, 1, 3, 1400, 1),
(4, 1, 1, 1000, 0),
(5, 4, 2, 700, 1),
(6, 4, 1, 1100, 1),
(7, 5, 2, 900, 1),
(8, 5, 1, 1300, 1),
(9, 6, 2, 900, 1),
(10, 6, 1, 1300, 1),
(11, 7, 2, 1000, 1),
(12, 7, 1, 1500, 1),
(13, 8, 4, 110, 0),
(14, 8, 5, 150, 0),
(15, 9, 5, 170, 0),
(16, 10, 4, 110, 0),
(17, 11, 6, 100, 0),
(18, 11, 7, 180, 0),
(19, 2, 6, 150, 1),
(20, 2, 7, 200, 1),
(21, 12, 8, 120, 0),
(22, 13, 8, 120, 0),
(23, 14, 8, 120, 0),
(24, 15, 8, 120, 0),
(25, 16, 8, 120, 0);

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
(1, 1, 1),
(2, 2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nif` varchar(20) DEFAULT NULL,
  `telefone` varchar(10) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 0,
  `password_hash` varchar(255) NOT NULL,
  `ativacao_hash` varchar(64) DEFAULT NULL,
  `reset_hash` varchar(64) DEFAULT NULL,
  `reset_expira_em` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `nome`, `email`, `nif`, `telefone`, `is_admin`, `ativo`, `password_hash`, `ativacao_hash`, `reset_hash`, `reset_expira_em`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Paulo Santiago', 'paulosantiago9@gmail.com', '130116939', '9774578', 1, 1, '$2y$10$85ALNXLZRCtbY07bIjEVTutjob4LZJz7jg0vWIrsg5ojimAY0l9UC', NULL, 'a826cc4774dae713e1cb3e7ad38096cd02f5aa10104786ea1c6b6b3ca3bc05ad', '2022-01-03 12:07:59', '2021-10-06 11:04:04', '2022-01-03 10:07:59', NULL),
(2, 'Deolinda Ramos', 'deolinda@gmail.com', '116397630', '9944891', 0, 1, '$2y$10$0L6I1XyjrtFDXPLJ1e8I4.AiYJxePxwVGFe8ulXlrIycFZY1j9GKO', NULL, NULL, NULL, '2021-10-06 11:04:04', '2021-11-15 17:56:10', NULL),
(3, 'Nicole Santiago', 'nicole@gmail.com', '124524589', '2313677', 0, 1, '$2y$10$QqMjjzEFqQxWdwmnVJoOOu4JQXCnOODBWkdWjDfve/3KhQthLrSzq', NULL, NULL, NULL, '2021-10-13 06:43:08', '2021-10-25 12:02:33', NULL),
(4, 'Mateus Leite', 'mateus@gmail.com', '124587965', '9204810', 0, 1, '$2y$10$q7.pUnaj9dx6t8uxpb8U..DFvzeWFKrS1oNj4JVDcBemI.pwVqMTy', NULL, NULL, NULL, '2021-10-14 06:59:36', '2021-10-25 12:26:31', NULL),
(6, 'Paulete Santiago', 'sr7351754@gmail.com', '153426759', '2313093', 1, 1, '$2y$10$kVC7uMHfIAy/DE3tC/fAceOK68qhPnzuu5IR1AEcS38tJntNokD92', NULL, 'c20a4c892253d1026516af9ef79b74ace5d1fe1e929a2ff0fc0db53e981e309f', '2021-12-27 17:02:21', '2021-11-06 15:26:18', '2021-12-27 15:02:21', NULL),
(7, 'Cynthia Évora', 'cynthia@gmail.com', '145784256', '9939636', 0, 1, '$2y$10$SJ5nv3Dbfxko2v3J8PS/8uvwCVFqaHtodmfvpdaG5Zw.ePB0mt82y', NULL, NULL, NULL, '2021-11-15 17:43:39', '2021-11-15 17:52:19', NULL);

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
  ADD UNIQUE KEY `nif` (`nif`),
  ADD UNIQUE KEY `cartadeconducao` (`cartadeconducao`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- Índices para tabela `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nif` (`nif`),
  ADD UNIQUE KEY `ativacao_hash` (`ativacao_hash`),
  ADD UNIQUE KEY `reset_hash` (`reset_hash`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `entregadores`
--
ALTER TABLE `entregadores`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `expediente`
--
ALTER TABLE `expediente`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
