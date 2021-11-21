-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2021 a las 03:38:02
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE `consultorios` (
  `consultorio_id` int(11) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`consultorio_id`, `numero`) VALUES
(1, 101),
(2, 102),
(3, 103),
(4, 104),
(5, 105),
(6, 201),
(7, 202),
(8, 203),
(9, 301),
(10, 302);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `especialidad_id` int(11) NOT NULL,
  `nom_especialidad` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`especialidad_id`, `nom_especialidad`) VALUES
(1, 'Medicina General'),
(2, 'Pediatría'),
(3, 'Ginecología'),
(4, 'Psicología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios`
--

CREATE TABLE `estudios` (
  `estudio_id` int(11) NOT NULL,
  `nom_estudio` varchar(20) NOT NULL,
  `desc_estudio` varchar(100) DEFAULT NULL,
  `precio` int(7) NOT NULL,
  `horario` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudios`
--

INSERT INTO `estudios` (`estudio_id`, `nom_estudio`, `desc_estudio`, `precio`, `horario`) VALUES
(1, 'Analisis de Sangre', 'Analisis de Sangre completo', 2500, 'm'),
(2, 'Radiografia', 'Radiografía torácica', 5000, 't'),
(3, 'Ecografia', 'Ecografía abdominal', 1500, 'm'),
(4, 'sadasd', 'asdadsasd', 5, 'm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `dni` int(11) NOT NULL,
  `nom_medico` varchar(100) NOT NULL,
  `ape_medico` varchar(50) NOT NULL,
  `especialidad` varchar(20) NOT NULL,
  `consultorio` int(2) DEFAULT NULL,
  `horario` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`dni`, `nom_medico`, `ape_medico`, `especialidad`, `consultorio`, `horario`) VALUES
(654321, 'Ricardo', 'Andres', '1', 102, 'm'),
(8000000, 'Luis', 'Alfonso', '2', 105, 'm'),
(19053506, 'Nicolas', 'Schleicher', '3', 101, 't'),
(32674434, 'Bruno', 'Zicari', '1', 301, 't'),
(55555555, 'Jose', 'Sejo', '2', 202, 't'),
(90000000, 'roberto', 'Jose', '4', 103, 't');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `turno_id` int(11) NOT NULL,
  `dni_paciente` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `consultorio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`turno_id`, `dni_paciente`, `servicio`, `fecha`, `hora`, `consultorio`) VALUES
(1, 21389494, 90000000, '2021-11-16', '08:30:00', 103),
(2, 21389494, 654321, '2021-11-23', '08:30:00', 102),
(8, 32674434, 1, '2021-11-16', '09:30:00', 0),
(15, 21389494, 8000000, '2021-11-12', '08:30:00', 105),
(17, 32674434, 32674434, '2021-11-18', '11:57:00', 301),
(20, 32674434, 2, '2021-11-17', '14:00:00', 0),
(22, 32674434, 19053506, '2021-11-18', '13:00:00', 101),
(29, 32674434, 2, '2021-11-22', '15:15:00', 0),
(31, 654321, 32674434, '2021-11-18', '14:30:00', 301),
(32, 32674434, 1, '2021-11-24', '09:00:00', 0),
(34, 19053506, 8000000, '2021-11-19', '10:00:00', 105),
(36, 32674434, 8000000, '2021-11-26', '10:30:00', 105),
(37, 32674434, 4, '2021-11-23', '10:00:00', 0),
(38, 21389494, 32674434, '2021-11-22', '13:30:00', 301),
(39, 32674434, 19053506, '2021-11-24', '16:00:00', 101);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` int(8) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `contrasenia` varchar(200) NOT NULL,
  `tipo` int(1) NOT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `apellido`, `contrasenia`, `tipo`, `mail`) VALUES
(123456, 'Admin', 'Super', '$2y$10$0u8cd6Qpu0CqM/LVm4k/dOMqB8pcg/0RiEZys5EDeULCuMbpQc.1C', 0, 'admin@gmial.com'),
(654321, 'Ricardo', 'Andres', '$2y$10$5y/23Jxwr2d0g/PRwCxpBuioQ/LHerJ/qYYQUacrCA34XuHirtZNu', 2, 'cardiologo'),
(1111111, 'wqeqwe', 'fdfsdfsd', '$2y$10$pfvjmPqQCB3o7k68gpOLY.zfQcOP9lbSN4eggiOX767mGid.oE8WC', 2, 'sdfsdfsdf'),
(6666666, 'erwerwer', 'werwerwer', '$2y$10$FDV1bWaSZFwv6/upNmIzme0J9X.ULrDafBgVl8JYrkgmhQ7fYjnAu', 1, 'ewerwer'),
(8000000, 'Luis', 'Alfonso', '$2y$10$LBhL5YokuWGs6aTfVdOTvengf4FP5gld8KHF9LVrzgkQLjpyoS.1a', 2, 'psicologo'),
(19053506, 'Nicolas', 'Schleicher', '$2y$10$o.Ksx95VsLvnSvAHjPD6YuxNxqL6emxr0Ru13AybMDFDfQNl0C/FC', 2, 'nicosc41@gmail.com'),
(21389494, 'Ricardo', 'Jueres', '$2y$10$bPPngBjffs5KG58tB4dfXuWqkT8vUNLDBaqG4pKQOv76aS.4PNexu', 1, 'ricarjua@gmail.com'),
(32674434, 'Bruno', 'Zicari', '$2y$10$PPd.uC3dtGu3t7RyAudm6OGkTGIw8wIBYrygMzVGp9lc5FI6i1msC', 1, 'nomeacuerdo@gmail'),
(34930400, 'Alberto', 'Pepep', '$2y$10$GbwgHXvyrtINOogQ.OhLkuZXXRjBcDFn4TtZunPDrIcKh4pZvC1Dq', 2, 'asdasdasd'),
(34934444, 'Orlando', 'Parez', '$2y$10$QU16blR.eqtW4rRzL8he1OYoaqNFDqTINkcVlC5r9U3Dtsn.PV9CK', 1, 'nose@mail.com'),
(55555555, 'Jose', 'Sejo', '$2y$10$8teWWKI.DAD0DAJ5Eq0x4uEM60DMV.qBSklS2rXgzS9f1WzWfnT3m', 2, 'correo-electronico@mail'),
(90000000, 'roberto', 'Jose', '$2y$10$qxUsn/XpVtHDwAOkBcXuwew4DnFG3Vkc.Gc1RDfJOsU205q3Nr40e', 2, 'neorologo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`consultorio_id`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`especialidad_id`);

--
-- Indices de la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`estudio_id`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`turno_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `consultorio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `especialidad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `estudio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `turno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
