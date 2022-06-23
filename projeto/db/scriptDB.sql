-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2022 at 06:45 PM
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
(3, 'Arroz', '0.00', 2147483647, '3,8', 'S'),
(4, 'Feijão', '6.00', 7, '364536456354', 'S'),
(5, 'Macarrão ', '10.00', 10, '634534563645', 'S'),
(7, 'Suco', '9.90', 99, '2739648059023', 'S'),
(8, 'Gelatina', '1.90', 10, '3564798986793', 'S'),
(10, 'Gelatina de Uva', '4.67', 10, '8564793893756', 'S'),
(11, 'Brew', '10.00', 30, '7689234567298', 'S'),
(12, 'Edddddd', '0.00', 0, '25345243524', 'S');

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
(3, 3, 2, '2022-06-23 16:42:33'),
(4, 7, 2, '2022-06-23 16:42:33'),
(9, 5, 4, '2022-06-23 16:42:33'),
(10, 5, 5, '2022-06-23 16:42:33'),
(11, 12, 3, '2022-06-23 16:42:33'),
(12, 3, 3, '2022-06-23 16:42:53'),
(13, 12, 5, '2022-06-23 16:43:16');

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
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `ven_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
