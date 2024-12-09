-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2024 a las 00:46:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdussi2024`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emergencia`
--

CREATE TABLE `emergencia` (
  `codemergencia` int(255) NOT NULL,
  `tipoemergencia` varchar(50) NOT NULL,
  `sintomas` varchar(255) NOT NULL,
  `diagnosticoemergencia` varchar(255) NOT NULL,
  `protocolo` varchar(255) NOT NULL,
  `cedulamedico` varchar(12) NOT NULL,
  `codespecialidad` int(3) NOT NULL,
  `CedulaPaciente` varchar(12) NOT NULL,
  `fechadeEmergencia` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `codespecialidad` int(3) NOT NULL,
  `nomespecialidad` varchar(50) DEFAULT NULL,
  `color` varchar(10) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`codespecialidad`, `nomespecialidad`, `color`, `fechaRegistro`) VALUES
(38, 'Traumatologia', 'green', '2024-09-29 15:22:47'),
(40, 'Pediatría', 'blue', '2024-09-16 13:30:13'),
(42, 'Ginecología', 'Fuchsia', '2024-09-29 21:02:24'),
(45, 'Medicina Interna', 'orange', '2024-09-29 20:46:09'),
(47, 'Odontologia', 'gray', '2024-09-16 13:46:39'),
(48, 'Psicología', 'purple', '2024-09-19 14:45:15'),
(49, 'Urologia', 'gray', '2024-11-03 12:30:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idEstado` int(3) NOT NULL,
  `nomestado` varchar(30) DEFAULT NULL,
  `CedulaPaciente` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `nomestado`, `CedulaPaciente`) VALUES
(0, 'Seleccione', ''),
(1, 'Distrito Capital', ''),
(2, 'Miranda', ''),
(3, 'La Guaira', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `codigo` int(4) NOT NULL,
  `fechacita` date NOT NULL DEFAULT current_timestamp(),
  `tipocita` varchar(100) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `codespecialidad` int(3) DEFAULT NULL,
  `cedulamedico` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CedulaPaciente` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cupos_asignados` int(15) NOT NULL,
  `totalCitas` int(15) NOT NULL,
  `motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`codigo`, `fechacita`, `tipocita`, `status`, `codespecialidad`, `cedulamedico`, `CedulaPaciente`, `cupos_asignados`, `totalCitas`, `motivo`) VALUES
(189, '2024-12-26', 'Primera_vez', 'Asistió', 45, 'V-14521114', 'V21212121', 0, 0, ''),
(190, '2024-12-05', 'Primera_vez', 'Cancelada', 45, 'V-14521114', 'V20279372', 0, 0, 'por motivs personasles'),
(191, '2024-12-16', 'Primera_vez', 'Cancelada', 45, 'V-14521114', 'V65656565', 0, 0, 'fghgjhgj'),
(192, '2024-12-06', 'Primera_vez', 'Pendiente', 45, 'V-14521114', 'V16552441', 0, 0, ''),
(193, '2024-12-05', 'Primera_vez', 'Asistió', 45, 'V-14521114', 'V14545421', 0, 0, ''),
(194, '2024-12-05', 'Primera_vez', 'Pendiente', 45, 'V-14521114', 'V21458787', 0, 0, ''),
(197, '2024-12-05', 'sucesiva_control', 'Pendiente', 45, 'V-14521114', '', 0, 0, ''),
(198, '2024-12-05', 'Primera_vez', 'Pendiente', 45, 'V-14521114', 'V15730195', 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiamedica`
--

CREATE TABLE `historiamedica` (
  `codhistoria` int(255) NOT NULL,
  `tensionalta` varchar(30) DEFAULT NULL,
  `tensionbaja` varchar(30) DEFAULT NULL,
  `temperatura` varchar(20) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `peso` varchar(45) DEFAULT NULL,
  `estatura` varchar(45) DEFAULT NULL,
  `tipodesangre` varchar(20) DEFAULT NULL,
  `alergia` varchar(45) DEFAULT NULL,
  `diabetes` varchar(45) DEFAULT NULL,
  `cirugia` varchar(45) DEFAULT NULL,
  `protesis` varchar(45) DEFAULT NULL,
  `artritis` varchar(45) DEFAULT NULL,
  `varices` varchar(45) DEFAULT NULL,
  `asma` varchar(45) DEFAULT NULL,
  `cancer` varchar(45) DEFAULT NULL,
  `hipertension` varchar(45) DEFAULT NULL,
  `gastroenteritis` varchar(45) DEFAULT NULL,
  `alcohol` varchar(45) DEFAULT NULL,
  `drogas` varchar(45) DEFAULT NULL,
  `diagnostico` varchar(255) DEFAULT NULL,
  `medicamentos` varchar(200) DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `codespecialidad` int(3) DEFAULT NULL,
  `CedulaPaciente` varchar(12) DEFAULT NULL,
  `codigo` int(4) DEFAULT NULL,
  `cedulamedico` varchar(12) DEFAULT NULL,
  `fechaApertura` datetime NOT NULL DEFAULT current_timestamp(),
  `codemergencia` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historiamedica`
--

INSERT INTO `historiamedica` (`codhistoria`, `tensionalta`, `tensionbaja`, `temperatura`, `hora`, `peso`, `estatura`, `tipodesangre`, `alergia`, `diabetes`, `cirugia`, `protesis`, `artritis`, `varices`, `asma`, `cancer`, `hipertension`, `gastroenteritis`, `alcohol`, `drogas`, `diagnostico`, `medicamentos`, `observaciones`, `codespecialidad`, `CedulaPaciente`, `codigo`, `cedulamedico`, `fechaApertura`, `codemergencia`) VALUES
(7, '', '', '', '00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 'V65656565', 0, '', '2024-12-01 16:54:24', 0),
(8, '', '', '', '00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 'V21212121', 0, '', '2024-12-01 17:03:01', 0),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'V16552441', NULL, NULL, '2024-12-01 18:37:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `codhorario` int(11) NOT NULL,
  `dia` varchar(50) NOT NULL,
  `cedulamedico` varchar(12) NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`codhorario`, `dia`, `cedulamedico`, `disponibilidad`) VALUES
(48, 'lunes', 'V-14521114', 0),
(57, 'martes', 'V-14521114', 0),
(58, 'miercoles', 'V-14521114', 0),
(68, 'martes', 'V26665522', 0),
(69, 'miercoles', 'V26665522', 0),
(70, 'martes', 'V26665522', 0),
(71, 'miercoles', 'V26665522', 0),
(78, 'Lunes', 'V-14252126', 0),
(79, 'Martes', 'V-14252126', 0),
(80, 'Jueves', 'V-14252126', 0),
(81, 'Martes', 'V16236525', 0),
(82, 'Miércoles', 'V16236525', 0),
(83, 'Viernes', 'V16236525', 0),
(84, 'Lunes', 'V-66265659', 0),
(85, 'Miércoles', 'V-66265659', 0),
(86, 'Jueves', 'V-66265659', 0),
(87, 'Lunes', 'V-7859654', 0),
(88, 'Martes', 'V-7859654', 0),
(89, 'Miércoles', 'V-7859654', 0),
(90, 'Lunes', 'V15421221', 0),
(91, 'Martes', 'V15421221', 0),
(92, 'Viernes', 'V15421221', 0),
(93, 'lunes', 'V19632326', 0),
(94, 'martes', 'V19632326', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `cedulamedico` varchar(12) NOT NULL,
  `nom1` varchar(45) DEFAULT NULL,
  `nom2` varchar(45) DEFAULT NULL,
  `ape1` varchar(45) DEFAULT NULL,
  `ape2` varchar(45) DEFAULT NULL,
  `telefonomedico` varchar(45) DEFAULT NULL,
  `correomedico` varchar(45) DEFAULT NULL,
  `nomalt` varchar(45) DEFAULT NULL,
  `apealt` varchar(45) DEFAULT NULL,
  `tlfalt` varchar(45) DEFAULT NULL,
  `relacion` varchar(45) NOT NULL,
  `totalCitas` int(45) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `codespecialidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`cedulamedico`, `nom1`, `nom2`, `ape1`, `ape2`, `telefonomedico`, `correomedico`, `nomalt`, `apealt`, `tlfalt`, `relacion`, `totalCitas`, `fechaRegistro`, `codespecialidad`) VALUES
('V-14252126', 'Namileídy    ', '    ', 'Sierra    ', '    ', '04123214575 ', 'namileidysierra@gmail.com    ', '    ', '    ', '    ', '    ', 0, '2024-12-01 20:00:00', 38),
('V-14521114', 'Maria   ', '   ', 'Linarez   ', '   ', '04263521460  ', 'marialinarez@gmail.com   ', '   ', '   ', '   ', '   ', 0, '2024-11-23 23:47:24', 45),
('V-66265659', 'Guismery ', ' ', 'Gutierrez ', ' ', ' ', 'guismerygutierrez@gmail.com ', ' ', ' ', ' ', ' ', 0, '2024-12-01 20:25:25', 45),
('V-7859654', 'Joaquin ', ' ', 'De Abreu ', ' ', '04263521346 ', 'joaquinabreu@gmail.com ', ' ', ' ', ' ', ' ', 0, '2024-12-01 20:23:39', 38),
('V15421221', 'Marta ', ' ', 'Rojas ', ' ', '04161234567 ', 'marta@gmail.com ', ' ', ' ', ' ', ' ', 0, '2024-12-01 20:24:02', 38),
('V16236525', 'Andres ', ' ', 'González ', ' ', '04246325616 ', 'andresg@gmail.com ', ' ', ' ', ' ', ' ', 0, '2024-12-01 20:14:42', 38),
('V19632326', 'ydytughjgh', 'uiyuiyui', 'yuiyui', 'asdfd', '04162365265', 'eret@gmail.com', NULL, NULL, NULL, '', 0, '2024-12-02 23:37:21', 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `idMcpio` int(3) NOT NULL,
  `nommcipio` varchar(30) DEFAULT NULL,
  `idEstado` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`idMcpio`, `nommcipio`, `idEstado`) VALUES
(1, 'Libertador', 1),
(2, 'Acevedo', 2),
(3, 'Andrés Bello', 2),
(4, 'Baruta', 2),
(5, 'Brión', 2),
(6, 'Buroz', 2),
(7, 'Carrizal', 2),
(8, 'Chacao', 2),
(9, 'Cristóbal Rojas', 2),
(10, 'Guaicaipuro', 2),
(11, 'EL Hatillo', 2),
(12, 'Independencia', 2),
(13, 'Los Salias', 2),
(14, 'Páez ', 2),
(15, 'Paz Castillo', 2),
(16, 'Pedro Gual', 2),
(17, 'Plaza', 2),
(18, 'Simón Bolívar', 2),
(19, 'Sucre', 2),
(20, 'Tomás Lander', 2),
(21, 'Urdaneta', 2),
(22, 'Zamora', 2),
(23, 'Vargas', 3),
(24, 'Seleccione', 3),
(110, 'Seleccione', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `CedulaPaciente` varchar(45) NOT NULL,
  `nombre1` varchar(45) DEFAULT NULL,
  `nombre2` varchar(45) DEFAULT NULL,
  `apellido1` varchar(45) DEFAULT NULL,
  `apellido2` varchar(45) DEFAULT NULL,
  `lugarnac` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `edad` int(2) DEFAULT NULL,
  `genero` varchar(45) NOT NULL,
  `telefono1` varchar(45) DEFAULT NULL,
  `telefonoalterno` varchar(45) DEFAULT NULL,
  `correopaciente` varchar(50) NOT NULL,
  `idEstado` int(3) NOT NULL,
  `idMcpio` int(3) NOT NULL,
  `idPquia` int(3) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `nivel` varchar(45) NOT NULL,
  `edocivil` varchar(45) NOT NULL,
  `ocupacion` varchar(45) NOT NULL,
  `condicion` varchar(45) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL,
  `parentesco` varchar(45) NOT NULL,
  `cedulamedico` int(12) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`CedulaPaciente`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `lugarnac`, `fecha`, `edad`, `genero`, `telefono1`, `telefonoalterno`, `correopaciente`, `idEstado`, `idMcpio`, `idPquia`, `direccion`, `nivel`, `edocivil`, `ocupacion`, `condicion`, `nombre`, `apellido`, `telefono2`, `parentesco`, `cedulamedico`, `fechaRegistro`) VALUES
('V14545421', 'juan', NULL, 'gonzalez', NULL, '', '0000-00-00', NULL, '', '04163131313', NULL, 'marianjo@gmail.com', 0, 0, 0, NULL, '', '', '', '', '', '', '0336756', 'primo', 0, '2024-12-01 18:26:15'),
('V15730195', 'juan', NULL, 'perez', NULL, '', '0000-00-00', NULL, '', '04163131313', NULL, 'juanjose@gmail.com', 0, 0, 0, NULL, '', '', '', '', 'angel', 'Rojas', '0000000', 'primo', 0, '2024-12-02 01:58:07'),
('V16552441', '      fgghj', 'trytry', '      ytutyu', 'ytuytutyue', 'trytytry', '1988-07-14', 36, 'femenino', '      04160212126', NULL, 'marianjo@gmail.com', 2, 4, 30, 'Las minas', 'bachiller', 'casado(a)', 'Trabajadora', 'Estudiante', '      luis', '      Robles', '      11112222', '      Hermano', 0, '2024-12-01 22:37:48'),
('V20279372', 'Irene', NULL, 'Robles', NULL, '', '0000-00-00', NULL, '', '04141655929', NULL, 'marianjo@gmail.com', 0, 0, 0, NULL, '', '', '', '', 'pedro', 'robles', '3300000', 'primo', 0, '2024-11-30 23:50:24'),
('V21212121', ' Jose', '', ' Perez', '', '', '1998-06-11', 26, 'masculino', ' 04161655929', '', '', 2, 4, 30, 'Las minas', 'bachiller', 'casado(a)', 'Funcionario publico', 'Estudiante', ' luis', ' perez', ' 0012201', '  primo', 0, '2024-12-01 21:03:01'),
('V21458787', 'rtrtyrty', NULL, 'rtytrydsfg', NULL, '', '0000-00-00', NULL, '', '04162316459', NULL, 'marianjo@gmail.com', 0, 0, 0, NULL, '', '', '', '', '', '', '', '', 0, '2024-12-01 20:25:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `idPquia` int(3) NOT NULL,
  `nompquia` varchar(30) DEFAULT NULL,
  `idMcpio` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parroquias`
--

INSERT INTO `parroquias` (`idPquia`, `nompquia`, `idMcpio`) VALUES
(0, NULL, 0),
(1, '23 de Enero', 1),
(2, 'Altagracia', 1),
(3, 'Antímano', 1),
(4, 'Caricuao', 1),
(5, 'Catedral', 1),
(6, 'Coche', 1),
(7, 'El Junquito', 1),
(8, 'El Paraíso', 1),
(9, 'El Recreo', 1),
(10, 'El Valle', 1),
(11, 'La Candelaria', 1),
(12, 'La Pastora', 1),
(13, 'La Vega', 1),
(14, 'Macarao', 1),
(15, 'San Agustín', 1),
(16, 'San Bernardino', 1),
(17, 'San José', 1),
(18, 'San Juan', 1),
(19, 'San Pedro', 1),
(20, 'Santa Rosalía', 1),
(21, 'Santa Teresa', 1),
(22, 'Sucre', 1),
(23, 'Caucagua', 2),
(24, 'Marizapa', 2),
(25, 'Capaya', 2),
(26, 'El Café', 2),
(27, 'San José de Barlovento', 3),
(28, 'Baruta', 4),
(29, 'El Cafetal', 4),
(30, 'Las Minas ', 4),
(31, 'Curiepe', 5),
(32, 'Higuerote', 5),
(33, 'Tacarigua', 5),
(34, 'Mamporal', 6),
(35, 'Carrizal', 7),
(36, 'Chacao', 8),
(37, 'Charallave', 9),
(38, 'Los Teques', 10),
(39, 'El Hatillo', 11),
(40, 'EL Cartanal', 12),
(41, 'Santa Teresa del Tuy', 12),
(42, 'San Antonio', 13),
(43, 'Rio Chico', 14),
(44, 'Tacarigua de la Laguna', 14),
(45, 'Santa Lucía', 15),
(46, 'Cupira', 16),
(47, 'Machurucuto', 16),
(48, 'Guarenas', 17),
(49, 'San Francisco de Yare', 18),
(50, 'Caucaguita', 19),
(51, 'Filas de Mariche', 19),
(52, 'La Dolorita', 19),
(53, 'Leoncio Martínez', 19),
(54, 'Petare ', 19),
(55, 'Ocumare del Tuy', 20),
(56, 'Cúa', 21),
(57, 'Bolívar', 22),
(58, 'Guatire', 22),
(60, 'Seleccione', 21),
(61, 'Seleccione', 3),
(62, 'Seleccione', 6),
(63, 'Seleccione', 7),
(64, 'Seleccione', 20),
(65, 'Seleccione', 18),
(66, 'Seleccione', 17),
(67, 'Seleccione', 15),
(68, 'Seleccione', 13),
(69, 'Seleccione', 11),
(70, 'Seleccione', 10),
(71, 'Seleccione', 9),
(72, 'Seleccione', 8),
(73, 'Caraballeda', 23),
(74, 'Carayaca', 23),
(75, 'Carlos Soublet', 23),
(76, 'Catia la Mar', 23),
(77, 'La Guaira', 23),
(78, 'Macuto', 23),
(79, 'Maiquetía', 23),
(80, 'Naiguatá', 23),
(81, 'Urimare', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `rol` enum('Administrador','Root','Secretaria') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Root'),
(3, 'Secretaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(3) NOT NULL,
  `cedula` int(12) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `nombre`, `apellido`, `cargo`, `email`, `usuario`, `password`, `estado`, `fechaRegistro`, `rol_id`) VALUES
(45, 20279372, 'Irene', 'Robles', 'secretaria', 'irene@gmail.com', 'admin', '$2y$10$Bu23JMOSitkBd63tNQhyiOHNUg29fOwiEgyTsyGy9CGMZbfb/MU0C', 1, '2024-12-01 01:52:19', 1),
(50, 15730195, 'angel', 'guzman', 'Asistente', 'angel@gmail.com', 'adminuno', '$2y$10$YfUdllTyeISz488zJSFFAecVAP.74Hb1oFPZ3nD5fvJsUcRQCdrhy', 0, '2024-12-01 02:00:14', 2),
(51, 25417415, 'juana', 'robles', 'secretaria', 'juan@gmail.com', 'admintres', '$2y$10$Y6Jdg5XQma5/KoUnwahnDuuxofNetNa4IBM6eKnTrzFJW379.qaya', 1, '2024-12-01 02:01:09', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `emergencia`
--
ALTER TABLE `emergencia`
  ADD PRIMARY KEY (`codemergencia`),
  ADD KEY `cedulamedico` (`cedulamedico`),
  ADD KEY `codespecialidad` (`codespecialidad`),
  ADD KEY `CedulaPaciente` (`CedulaPaciente`),
  ADD KEY `CedulaPaciente_2` (`CedulaPaciente`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`codespecialidad`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstado`),
  ADD KEY `CedulaPaciente` (`CedulaPaciente`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `CedulaPaciente` (`CedulaPaciente`),
  ADD KEY `cedulamedico` (`cedulamedico`),
  ADD KEY `codespecialidad` (`codespecialidad`);

--
-- Indices de la tabla `historiamedica`
--
ALTER TABLE `historiamedica`
  ADD PRIMARY KEY (`codhistoria`),
  ADD KEY `CedulaPaciente` (`CedulaPaciente`),
  ADD KEY `CedulaPaciente_2` (`CedulaPaciente`),
  ADD KEY `codespecialidad` (`codespecialidad`),
  ADD KEY `codigo` (`codigo`),
  ADD KEY `cedulamedico` (`cedulamedico`),
  ADD KEY `codemergencia` (`codemergencia`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`codhorario`),
  ADD KEY `cedulamedico` (`cedulamedico`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`cedulamedico`),
  ADD KEY `codespecialidad` (`codespecialidad`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`idMcpio`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`CedulaPaciente`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idMcpio` (`idMcpio`),
  ADD KEY `idPquia` (`idPquia`),
  ADD KEY `cedulamedico` (`cedulamedico`);

--
-- Indices de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD PRIMARY KEY (`idPquia`),
  ADD KEY `idMcpio` (`idMcpio`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `emergencia`
--
ALTER TABLE `emergencia`
  MODIFY `codemergencia` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `codespecialidad` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstado` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `codigo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de la tabla `historiamedica`
--
ALTER TABLE `historiamedica`
  MODIFY `codhistoria` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `codhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `idMcpio` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`codespecialidad`) REFERENCES `especialidad` (`codespecialidad`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
