-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 02:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examenmarzopbv`
--
CREATE DATABASE IF NOT EXISTS `examenmarzopbv` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `examenmarzopbv`;

-- --------------------------------------------------------

--
-- Table structure for table `ejemplares`
--

CREATE TABLE `ejemplares` (
  `cod` int(4) NOT NULL,
  `isbn` int(4) NOT NULL,
  `prestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ejemplares`
--

INSERT INTO `ejemplares` (`cod`, `isbn`, `prestado`) VALUES
(14, 1234, 1),
(15, 2345, 1),
(20, 1234, 0),
(22, 1234, 0),
(76, 2345, 0);

-- --------------------------------------------------------

--
-- Table structure for table `libros`
--

CREATE TABLE `libros` (
  `isbn` int(4) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `resumen` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `libros`
--

INSERT INTO `libros` (`isbn`, `titulo`, `categoria`, `resumen`) VALUES
(1234, 'Don Quijote de la Mancha', 'novela', 'Un tio ve molinos y se cree que son gigantes'),
(2345, 'novela 2', 'novela', 'resumen novela 2'),
(4321, 'The C programming language', 'programacion', 'Libro de funcionamiento original de C, por Dennis Ritchie'),
(5432, 'The Python Book', 'programacion', 'Python desde cero, por Rob Mastrodomenico');

-- --------------------------------------------------------

--
-- Table structure for table `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(4) NOT NULL,
  `dni_socio` varchar(9) NOT NULL,
  `cod_ejemplar` int(4) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_max_devolucion` date NOT NULL,
  `fecha_devolucion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prestamos`
--

INSERT INTO `prestamos` (`id`, `dni_socio`, `cod_ejemplar`, `fecha_prestamo`, `fecha_max_devolucion`, `fecha_devolucion`) VALUES
(1, '00000000T', 22, '2024-03-07', '2024-03-14', NULL),
(2, '49215264W', 15, '2024-03-07', '2024-03-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `socios`
--

CREATE TABLE `socios` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `socios`
--

INSERT INTO `socios` (`dni`, `nombre`, `direccion`, `email`) VALUES
('00000000T', 'Test', 'Test', 'test@example.com'),
('49215264W', 'Test', 'Test', 'pablobello0997@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ejemplares`
--
ALTER TABLE `ejemplares`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `FK_isbn` (`isbn`);

--
-- Indexes for table `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_dni_socio` (`dni_socio`),
  ADD KEY `FK_cod_ejemplar` (`cod_ejemplar`);

--
-- Indexes for table `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ejemplares`
--
ALTER TABLE `ejemplares`
  ADD CONSTRAINT `FK_isbn` FOREIGN KEY (`isbn`) REFERENCES `libros` (`isbn`);

--
-- Constraints for table `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `FK_cod_ejemplar` FOREIGN KEY (`cod_ejemplar`) REFERENCES `ejemplares` (`cod`),
  ADD CONSTRAINT `FK_dni_socio` FOREIGN KEY (`dni_socio`) REFERENCES `socios` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
