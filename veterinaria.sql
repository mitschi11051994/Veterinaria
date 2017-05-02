--
-- Base de datos: `veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dueno`
--

CREATE TABLE `dueno` (
  `id` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `primer_apellido` varchar(30) NOT NULL,
  `segundo_apellido` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dueno`
--

INSERT INTO `dueno` (`id`, `nombre`, `primer_apellido`, `segundo_apellido`, `telefono`, `direccion`) VALUES
('203440876', 'Juan', 'Herrera', 'Montero', '84002366', 'Valle Azul San Ramon'),
('207250721', 'Michelle', 'Ramirez', 'Flores', '84002366', 'Bajo Rodríguez'),
('207650987', 'Lilliam ', 'Flores', 'Barrientos', '86352098', 'Bajo Rodriguez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

CREATE TABLE `enfermedad` (
  `cod_enfermedad` varchar(40) NOT NULL,
  `descripcion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `enfermedad`
--

INSERT INTO `enfermedad` (`cod_enfermedad`, `descripcion`) VALUES
('ENF_01', 'Rabia'),
('ENF_02', 'Fiebre Apsuosa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `cod_especie` varchar(40) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`cod_especie`, `descripcion`) VALUES
('ESP_01', 'Perros'),
('ESP_02', 'Gato'),
('ESP_03', 'Aves'),
('ESP_04', 'Peces');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `cod_mascota` varchar(40) NOT NULL,
  `id` varchar(40) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `cod_raza` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`cod_mascota`, `id`, `nombre`, `fecha_nacimiento`, `cod_raza`) VALUES
('MASC_001', '203440876', 'BOBY', '2017-04-20', 'RAZ_01'),
('MASC_002', '203440876', 'SISI', '2017-01-05', 'RAZ_02'),
('MASC_003', '203440876', 'MIMI', '2017-04-03', 'RAZ_03'),
('MASC_004', '203440876', 'REX', '2017-04-02', 'RAZ_04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `cod_raza` varchar(40) NOT NULL,
  `descripcion` varchar(40) NOT NULL,
  `cod_especie` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`cod_raza`, `descripcion`, `cod_especie`) VALUES
('RAZ_01', 'Buldoggg', 'ESP_01'),
('RAZ_02', 'Chihuahua', 'ESP_01'),
('RAZ_03', 'American Stanford', 'ESP_01'),
('RAZ_04', 'Angora', 'ESP_02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `phone`, `created`, `modified`, `status`) VALUES
(9, 'Michelle Ramirez', 'michelleramrezflores@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'Female', '84002366', '2017-04-24 01:16:12', '2017-04-24 01:16:12', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacuna`
--

CREATE TABLE `vacuna` (
  `cod_vacuna` varchar(40) NOT NULL,
  `descripcion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vacuna`
--

INSERT INTO `vacuna` (`cod_vacuna`, `descripcion`) VALUES
('VAC_01', 'Vacunacion en anillo'),
('VAC_02', 'Vacuna AntiRabica');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dueno`
--
ALTER TABLE `dueno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`cod_enfermedad`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`cod_especie`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`cod_mascota`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`cod_raza`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacuna`
--
ALTER TABLE `vacuna`
  ADD PRIMARY KEY (`cod_vacuna`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
