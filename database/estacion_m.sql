-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-08-2025 a las 13:53:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estacion_m`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Fundamentos de Programación y Web'),
(2, 'PHP y Bases de Datos'),
(3, 'Framework PHP'),
(4, 'APIs REST y Consumo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `texto` text NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `texto`, `id_cat`) VALUES
(1, '¿Qué diferencia hay entre una variable y una función?', 1),
(2, '¿Qué hace un condicional if y un bucle for en un programa?', 1),
(3, '¿Para qué se usa la etiqueta <form> en HTML?', 1),
(4, '¿Cómo se declara una variable en PHP?', 2),
(5, '¿Qué es una sentencia SQL SELECT y para qué sirve?', 2),
(6, '¿Cómo se envían datos de un formulario HTML a un script PHP?', 2),
(7, '¿Qué representa cada componente del patrón MVC?', 3),
(8, '¿Qué es una migración en Laravel y para qué se usa?', 3),
(9, '¿Qué es una API REST y qué métodos HTTP conoces?', 4),
(10, '¿Qué es JSON y cómo se usa en el intercambio de datos entre sistemas?', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `pregunta_id` int(11) DEFAULT NULL,
  `texto` text NOT NULL,
  `es_correcta` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `pregunta_id`, `texto`, `es_correcta`) VALUES
(1, 1, 'Una variable almacena datos; una función ejecuta instrucciones', 1),
(2, 1, 'Una función almacena datos; una variable los muestra', 0),
(3, 1, 'Ambas sirven para guardar valores', 0),
(4, 1, 'Una variable repite código; una función lo elimina', 0),
(5, 2, 'Ambos repiten instrucciones hasta que se cumpla una condición', 0),
(6, 2, 'El if compara valores, el for ejecuta código varias veces', 1),
(7, 2, 'El if crea funciones, el for guarda datos', 0),
(8, 2, 'Ambos sirven para declarar variables', 0),
(9, 3, 'Para enlazar estilos CSS', 0),
(10, 3, 'Para incrustar imágenes', 0),
(11, 3, 'Para agrupar elementos interactivos en un bloque', 0),
(12, 3, 'Para enviar datos a un servidor', 1),
(13, 4, 'var nombre = \"Juan\";', 0),
(14, 4, '$nombre = \"Juan\";', 1),
(15, 4, 'let nombre = \"Juan\";', 0),
(16, 4, 'nombre := \"Juan\"', 0),
(17, 5, 'Para eliminar datos de una tabla', 0),
(18, 5, 'Para insertar datos en una tabla', 0),
(19, 5, 'Para actualizar una fila', 0),
(20, 5, 'Para consultar o leer datos de una tabla', 1),
(21, 6, 'Mediante GET o POST en el atributo method del <form>', 1),
(22, 6, 'Usando JavaScript y etiquetas <table>', 0),
(23, 6, 'Guardando el formulario en un archivo .php', 0),
(24, 6, 'Con una función llamada sendFormData()', 0),
(25, 7, 'Modelo: cliente, Vista: servidor, Controlador: base de datos', 0),
(26, 7, 'Modelo: HTML, Vista: CSS, Controlador: JavaScript', 0),
(27, 7, 'Modelo: lógica de datos; Vista: interfaz; Controlador: flujo de aplicación', 1),
(28, 7, 'Modelo: base de datos, Vista: URL, Controlador: sesiones', 0),
(29, 8, 'Un archivo que define rutas web', 0),
(30, 8, 'Un proceso para cambiar de servidor', 0),
(31, 8, 'Una clase que permite gestionar cambios en la base de datos', 1),
(32, 8, 'Un script para mover archivos de imagen', 0),
(33, 9, 'Es una base de datos en línea con métodos SELECT y INSERT', 0),
(34, 9, 'Es un tipo de backend con métodos como PUSH y DELETE', 0),
(35, 9, 'Es una interfaz para compartir datos; usa métodos como GET, POST, PUT, DELETE', 1),
(36, 9, 'Es un sistema de login para acceder a redes sociales', 0),
(37, 10, 'Es un lenguaje de backend que reemplaza PHP', 0),
(38, 10, 'Es un formato de texto para estructurar datos en pares clave–valor', 1),
(39, 10, 'Es una librería para diseñar interfaces', 0),
(40, 10, 'Es un sistema operativo para servidores', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `id` int(11) NOT NULL,
  `id_user_reg` int(11) NOT NULL,
  `nivel` text DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `retroalimentacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`id`, `id_user_reg`, `nivel`, `calificacion`, `retroalimentacion`) VALUES
(1, 1, 'Intermedio', 4, 'Nivel obtenido: <strong>Intermedio</strong><br>Nivel intermedio. Necesitas reforzar: <strong>APIs REST y Consumo, Fundamentos de Programación y Web</strong>.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `user` varchar(128) NOT NULL,
  `pass` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `user`, `pass`) VALUES
(1, 'alex', '534b44a19bf18d20b71ecc4eb77c572f');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_preguntas_categoria` (`id_cat`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pregunta_id` (`pregunta_id`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_resultado` (`id_user_reg`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `fk_preguntas_categoria` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`);

--
-- Filtros para la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `resultados_ibfk_1` FOREIGN KEY (`id_user_reg`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
