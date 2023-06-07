-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Jun-2023 às 17:44
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `outdoors`
--

-- --------------------------------------------------------
create database if not exists outdoors;
use outdoors;
--
-- Estrutura da tabela `commune`
--

CREATE TABLE `commune` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `municipality_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `commune`
--

INSERT INTO `commune` (`id`, `name`, `municipality_id`) VALUES
(1, 'Benfica', 6),
(2, 'Viana ', 4),
(3, 'Calumbo', 4),
(4, 'Dangereux', 6),
(5, 'Paraiso', 8),
(6, 'Kwanzas', 8),
(7, 'Vila Alice', 8),
(8, 'Maculusso', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `customer_type_id` int(11) NOT NULL,
  `commune_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `activity` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `nationality_id`, `customer_type_id`, `commune_id`, `user_id`, `address`, `activity`) VALUES
(3, 'Jose Domingos 1', '95585585', 1, 2, 1, 15, 'Avenida 21 de Janeiro', ''),
(4, 'Helena', '944666640', 1, 2, 1, 19, 'Luanda', ''),
(5, 'jhjh', '944666640', 1, 1, 1, 21, 'jiuiuiui', 'iijkjkk'),
(6, 'José Dominos Cassua Ndonge', '944666640', 1, 1, 1, 22, 'testes', 'teste teste3'),
(7, 'Mohamed Ture', '944666640', 1, 2, 1, 34, 'Viana', ''),
(8, 'dgsg', '944666640', 1, 1, 1, 35, 'sdgdsg', 'sdfsdf'),
(9, 'Walfina', '944666640', 1, 2, 1, 36, 'Rest e Rest Full', ''),
(10, 'Jurelma', '944666640', 1, 1, 1, 37, 'Rua 1', 'wasdasd'),
(11, 'Rivaldo', '944666640', 1, 1, 1, 38, 'dsfgdsfg', 'asdafsdf'),
(12, 'ghyju', '944666640', 1, 1, 1, 45, 'rfygh', 'fgthyju'),
(13, 'Kudiezo', '944666640', 1, 2, 1, 46, 'Luanda 23', ''),
(14, 'kusghds', '944666640', 1, 2, 4, 47, 'Luanda', ''),
(15, 'ezedelho', '944666640', 1, 2, 2, 48, 'Luanda', ''),
(16, 'fdldklf', '944666640', 1, 2, 4, 55, 'Luanda', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `customer_type`
--

CREATE TABLE `customer_type` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `customer_type`
--

INSERT INTO `customer_type` (`id`, `type`) VALUES
(1, 'Empresa'),
(2, 'Particular');

-- --------------------------------------------------------

--
-- Estrutura da tabela `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `commune_id` int(11) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `manager`
--

INSERT INTO `manager` (`id`, `name`, `commune_id`, `phone`, `address`, `user_id`) VALUES
(14, 'Helena Amor', 1, '9554455', 'Luanda', 39),
(15, 'Helena Rest', 1, '9465454', 'sdfsfsdf', 40),
(16, 'Boia', 4, '985555', 'sdsfdsf', 41),
(17, 'Tuxa', 4, '45436546456', 'Luanda', 42),
(18, 'Fina', 4, '12324234', 'Final 7282', 43),
(19, 'Rui', 4, '9484785', 'Dangereux12', 44),
(20, 'Teste', 1, '936373', 'luanda', 49),
(21, 'teste', 1, '97737', 'luan', 53),
(22, 'Teste', 4, '97363', '123', 54);

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipality`
--

CREATE TABLE `municipality` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `province_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `municipality`
--

INSERT INTO `municipality` (`id`, `name`, `province_id`) VALUES
(1, 'Cacuaco', 8),
(2, 'Alto Cauale', 2),
(3, 'Alto Zambeze', 4),
(4, 'Viana', 8),
(5, 'Cazenga', 8),
(6, 'Talatona', 8),
(7, 'Maianga', 8),
(8, 'Xá-Muteba', 7),
(9, 'Pango Aluquém', 13),
(10, 'Quirima', 5),
(11, 'Cuemba', 14),
(12, 'Buco-Zau', 15),
(13, 'Nambuangongo', 13),
(14, 'Samba Caju', 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `nationality`
--

CREATE TABLE `nationality` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `nationality`
--

INSERT INTO `nationality` (`id`, `name`) VALUES
(1, 'Angolana');

-- --------------------------------------------------------

--
-- Estrutura da tabela `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `province`
--

INSERT INTO `province` (`id`, `name`) VALUES
(1, 'Zaire'),
(2, 'Uige'),
(3, 'Namibe'),
(4, 'Moxico'),
(5, 'Malanje'),
(6, 'Lunda Sul'),
(7, 'Lunda Norte'),
(8, 'Luanda'),
(9, 'Huila'),
(10, 'Huambo'),
(11, 'Cunene'),
(12, 'Cuanza Sul'),
(13, 'Bengo'),
(14, 'Bié'),
(15, 'Cabinda'),
(16, 'Cuanza Norte');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `status` enum('0','1') DEFAULT '0',
  `access` enum('admin','normal','manager') DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `status`, `access`) VALUES
(15, 'josedomingos919', '123', 'josedomingos919@gmail.com', '1', 'normal'),
(19, 'josedomingos818', '123', 'josedomingos919@gmail.com', '1', 'normal'),
(20, 'admin', 'admin', 'admin@gmail.com', '1', 'admin'),
(21, 'helena123', '123', 'helena12@gmail.com', '1', 'normal'),
(22, 'rest919', '123', 'rest919@gmail.com', '1', 'normal'),
(34, 'mamedi', '123', 'mamedi@gmail.com', '1', 'normal'),
(35, 'sdgdfgfdg', '123', 'dfgdg@gmail.com', '0', 'normal'),
(36, 'rest536sys', '123', 'josedomingos919@gmail.com', '0', 'normal'),
(37, 'ju123', '123', 'josedomingos919@gmail.com', '0', 'normal'),
(38, 'safsdfs', '123', 'josedomingos919@gmail.com', '0', 'normal'),
(39, 'admin123', '123', 'josedomingos919@gmail.com', '1', 'manager'),
(40, 'ters2733', '123', 'josedomingos919@gmail.com', '0', 'manager'),
(41, 'sdfsdfsd', '123', 'josedomingos919@gmail.com', '0', 'manager'),
(42, 'user233', 'user233', 'j@gmail.com', '0', 'manager'),
(43, 'fina12', '123', 'fina@gmail.com', '0', 'manager'),
(44, 'rui123', '123', 'josedomingos919@gmail.com', '0', 'manager'),
(45, '123', '123', 'josedomingos919@gmail.com', '0', 'normal'),
(46, 'kudiezo', '123', 'josedomingos919@gmail.com', '0', 'normal'),
(47, 'ezedelho', '123', 'jose@gmail.com', '0', 'normal'),
(48, 'ezede123', '123', 'ez123@gmail.com', '0', 'normal'),
(49, 'ezed11', '123', 'ez@gmail.com', '0', 'manager'),
(53, '123hhs', '123', 'josedomingos919@gmail.com', '0', 'manager'),
(54, 'user12666', '123', 'jose@gmail.cm', '0', 'manager'),
(55, 'user40', '123', 'jose@gmail.com', '0', 'normal');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipality_id` (`municipality_id`);

--
-- Índices para tabela `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nationality_id` (`nationality_id`),
  ADD KEY `customer_type_id` (`customer_type_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `commune_id` (`commune_id`);

--
-- Índices para tabela `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `municipality`
--
ALTER TABLE `municipality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province_id` (`province_id`);

--
-- Índices para tabela `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `commune`
--
ALTER TABLE `commune`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `municipality`
--
ALTER TABLE `municipality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `nationality`
--
ALTER TABLE `nationality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `commune`
--
ALTER TABLE `commune`
  ADD CONSTRAINT `commune_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `municipality` (`id`);

--
-- Limitadores para a tabela `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`nationality_id`) REFERENCES `nationality` (`id`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`customer_type_id`) REFERENCES `customer_type` (`id`),
  ADD CONSTRAINT `customer_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `customer_ibfk_4` FOREIGN KEY (`commune_id`) REFERENCES `commune` (`id`);

--
-- Limitadores para a tabela `municipality`
--
ALTER TABLE `municipality`
  ADD CONSTRAINT `municipality_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
