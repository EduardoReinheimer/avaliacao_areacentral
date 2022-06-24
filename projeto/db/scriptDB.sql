-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 06:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avaliacao`
--

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `pro_id` int(11) NOT NULL,
  `pro_desc` varchar(150) NOT NULL,
  `pro_vlrunt` decimal(10,2) NOT NULL,
  `pro_qtdestoque` int(11) NOT NULL,
  `pro_codbarras` varchar(13) NOT NULL,
  `pro_ativo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`pro_id`, `pro_desc`, `pro_vlrunt`, `pro_qtdestoque`, `pro_codbarras`, `pro_ativo`) VALUES
(4, 'Feijão', '6.80', 17, '364536456354', 'S'),
(5, 'Macarrão ', '5.00', 10, '634534563645', 'S'),
(7, 'Suco', '9.90', 99, '2739648059023', 'S'),
(8, 'Gelatina', '1.90', 10, '3564798986793', 'S'),
(10, 'Gelatina de Uva', '0.80', 10, '8564793893756', 'S'),
(11, 'Brew', '10.00', 30, '7689234567298', 'N'),
(13, 'Banana', '0.80', 9, '5236487907890', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `venda`
--

CREATE TABLE `venda` (
  `ven_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `ven_qtd` int(11) NOT NULL,
  `ven_data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venda`
--

INSERT INTO `venda` (`ven_id`, `pro_id`, `ven_qtd`, `ven_data`) VALUES
(1, 4, 6, '2022-06-23 16:42:33'),
(2, 4, 4, '2022-06-23 16:42:33'),
(4, 7, 2, '2022-06-23 16:42:33'),
(9, 5, 4, '2022-06-23 16:42:33'),
(10, 5, 5, '2022-06-23 16:42:33'),
(14, 8, 4, '2022-06-23 17:13:48'),
(15, 10, 3, '2022-06-23 17:16:03'),
(16, 4, 2, '2022-06-23 17:20:10'),
(17, 4, 2, '2022-06-23 17:20:40'),
(18, 4, 2, '2022-06-23 17:21:23'),
(19, 4, 2, '2022-06-23 17:21:47'),
(20, 4, 2, '2022-06-23 17:22:00'),
(21, 4, 2, '2022-06-23 17:23:42'),
(22, 4, 4, '2022-06-23 17:24:09'),
(23, 4, 2, '2022-06-23 17:25:08'),
(24, 5, 2, '2022-06-23 17:25:26'),
(25, 4, 2, '2022-06-23 17:25:41'),
(26, 4, 2, '2022-06-23 17:25:59'),
(27, 5, 2, '2022-06-23 17:26:20'),
(28, 4, 5, '2022-06-23 18:44:28'),
(29, 4, 1, '2022-06-23 18:57:44'),
(30, 4, 2, '2022-06-23 18:57:57'),
(31, 5, 7, '2022-06-24 14:51:47'),
(32, 5, 8, '2022-06-24 14:52:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`ven_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `ven_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
