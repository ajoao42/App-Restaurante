-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Jun-2023 às 10:19
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+01:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_app_rhm`
--
CREATE DATABASE IF NOT EXISTS `db_app_rhm` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `db_app_rhm`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--
-- Criação: 26-Maio-2023 às 13:52
--

CREATE TABLE `tb_cliente` (
  `idcliente` int(11) NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contacto` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `restric_alimen` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `preferencias` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`idcliente`, `nome`, `contacto`, `restric_alimen`, `preferencias`) VALUES
(1, 'Ed Sheeran', '945000000', 'Nenhuma', 'Nenhuma '),
(2, 'Celine Dion', '999000000', 'Nenhuma', 'Nenhuma '),
(3, 'Novo Amor', '900000000', 'Nenhuma', 'Nenhuma '),
(4, 'Nicki Minaj', '930000000', 'Nenhuma', 'Nenhuma ');
-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_factura`
--
-- Criação: 04-Jun-2023 às 17:51
--

CREATE TABLE `tb_factura` (
  `idfactura` int(11) NOT NULL,
  `idpagamento` int(11) DEFAULT NULL,
  `idpedido` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valor_devido` float NOT NULL,
  `status_pagamento` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_item_menu`
--
-- Criação: 27-Maio-2023 às 15:38
--

CREATE TABLE `tb_item_menu` (
  `iditem` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `nome_menu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `preco` float NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_item_menu`
--

INSERT INTO `tb_item_menu` (`iditem`, `idproduto`, `nome_menu`, `preco`, `descricao`) VALUES
(1, 3, 'Bitoque', 5000, 'Arroz com feijao preto, bife de vaca, salada ,batata e ovo frito'),
(2, 4, 'Salada fria', 8000, 'Salada fria com ovos, tomates, atum enlado, maionese'),
(3, 1, 'Pizza vegetaria', 3500, 'Pizza vegetaria com os melhores legumes da provincia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mesa`
--
-- Criação: 05-Jun-2023 às 20:14
--

CREATE TABLE `tb_mesa` (
  `idmesa` int(11) NOT NULL,
  `idreserva` int(11) NOT NULL,
  `mesa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `capacidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_mesa`
--

INSERT INTO `tb_mesa` (`idmesa`, `idreserva`, `mesa`, `capacidade`) VALUES
(1, 1, 'M01', '2 Lugares'),
(2, 2, 'M02', '4 Lugares');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pagamento`
--
-- Criação: 04-Jun-2023 às 16:47
--

CREATE TABLE `tb_pagamento` (
  `idpagamento` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pedido`
--
-- Criação: 31-Maio-2023 às 09:43
--

CREATE TABLE `tb_pedido` (
  `idpedido` int(11) NOT NULL,
  `idreserva` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `total` float NOT NULL,
  `iditem_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_pedido`
--

INSERT INTO `tb_pedido` (`idpedido`, `idreserva`, `idmesa`, `qtd`, `status`, `total`, `iditem_menu`) VALUES
(1, 1, 1, 2, 'Pronto', 10000, 1),
(2, 2, 2, 4, 'Preparando', 32000, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--
-- Criação: 26-Maio-2023 às 16:48
--

CREATE TABLE `tb_produto` (
  `idproduto` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `preco` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_produto`
--

INSERT INTO `tb_produto` (`idproduto`, `nome`, `preco`) VALUES
(1, 'Massa', 5000),
(2, 'Funge ', 5000),
(3, 'Arroz', 5000),
(4, 'Outros', 5000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_reserva`
--
-- Criação: 05-Jun-2023 às 20:11
--

CREATE TABLE `tb_reserva` (
  `idreserva` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `n_lugares` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_reserva`
--

INSERT INTO `tb_reserva` (`idreserva`, `idcliente`, `data`, `hora`, `n_lugares`) VALUES
(1, 1, '2023-06-26', '19:00:00', '2 Lugares'),
(2, 2, '2023-06-27', '19:00:00', '4 Lugares'),
(3, 3, '2023-06-28', '20:00:00', '5 Lugares'),
(4, 4, '2023-06-29', '18:00:00', '3 Lugares');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--
-- Criação: 19-Maio-2023 às 14:32
--

CREATE TABLE `tb_usuario` (
  `iduser` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`iduser`, `nome`, `email`, `telefone`, `username`, `senha`, `status`) VALUES
(1, 'Adm King', 'Adm@teste.com', '920000000', 'Adm King', 'K@2023', 'Adm'),
(2, 'User Queen', 'user@teste.com', '910000000', 'User Queen', 'Q@2023', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indexes for table `tb_factura`
--
ALTER TABLE `tb_factura`
  ADD PRIMARY KEY (`idfactura`),
  ADD KEY `FK_paga_factu` (`idpagamento`),
  ADD KEY `FK_pedid_factu` (`idpedido`);

--
-- Indexes for table `tb_item_menu`
--
ALTER TABLE `tb_item_menu`
  ADD PRIMARY KEY (`iditem`),
  ADD KEY `FK_item_produ` (`idproduto`);

--
-- Indexes for table `tb_mesa`
--
ALTER TABLE `tb_mesa`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_Mesa_Reserv` (`idreserva`);

--
-- Indexes for table `tb_pagamento`
--
ALTER TABLE `tb_pagamento`
  ADD PRIMARY KEY (`idpagamento`);

--
-- Indexes for table `tb_pedido`
--
ALTER TABLE `tb_pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `FK_pedid_reser` (`idreserva`),
  ADD KEY `FK_pedid_item` (`iditem_menu`),
  ADD KEY `FK_pedid_mesa` (`idmesa`);

--
-- Indexes for table `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`idproduto`);

--
-- Indexes for table `tb_reserva`
--
ALTER TABLE `tb_reserva`
  ADD PRIMARY KEY (`idreserva`),
  ADD KEY `FK_Client_Reserv` (`idcliente`);

--
-- Indexes for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `FK_user_status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_factura`
--
ALTER TABLE `tb_factura`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_item_menu`
--
ALTER TABLE `tb_item_menu`
  MODIFY `iditem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_mesa`
--
ALTER TABLE `tb_mesa`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_pagamento`
--
ALTER TABLE `tb_pagamento`
  MODIFY `idpagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pedido`
--
ALTER TABLE `tb_pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_reserva`
--
ALTER TABLE `tb_reserva`
  MODIFY `idreserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_factura`
--
ALTER TABLE `tb_factura`
  ADD CONSTRAINT `FK_paga_factu` FOREIGN KEY (`idpagamento`) REFERENCES `tb_pagamento` (`idpagamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pedid_factu` FOREIGN KEY (`idpedido`) REFERENCES `tb_pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_item_menu`
--
ALTER TABLE `tb_item_menu`
  ADD CONSTRAINT `FK_item_produ` FOREIGN KEY (`idproduto`) REFERENCES `tb_produto` (`idproduto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_mesa`
--
ALTER TABLE `tb_mesa`
  ADD CONSTRAINT `FK_Mesa_Reserv` FOREIGN KEY (`idreserva`) REFERENCES `tb_reserva` (`idreserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_pedido`
--
ALTER TABLE `tb_pedido`
  ADD CONSTRAINT `FK_pedid_item` FOREIGN KEY (`iditem_menu`) REFERENCES `tb_item_menu` (`iditem`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pedid_mesa` FOREIGN KEY (`idmesa`) REFERENCES `tb_mesa` (`idmesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pedid_reser` FOREIGN KEY (`idreserva`) REFERENCES `tb_reserva` (`idreserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_reserva`
--
ALTER TABLE `tb_reserva`
  ADD CONSTRAINT `FK_Client_Reserv` FOREIGN KEY (`idcliente`) REFERENCES `tb_cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
