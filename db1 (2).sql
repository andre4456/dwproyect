-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-12-2024 a las 04:24:27
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ayuda`
--

DROP TABLE IF EXISTS `ayuda`;
CREATE TABLE IF NOT EXISTS `ayuda` (
  `ID_Comentario` int NOT NULL,
  `comentario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `correo_electronico` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`ID_Comentario`),
  KEY `ID_Usuario` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ayuda`
--

INSERT INTO `ayuda` (`ID_Comentario`, `comentario`, `correo_electronico`, `Fecha`, `id_usuario`) VALUES
(0, 'gmuhit', 'mendezalejandra966@gmail.com', '2024-11-14 14:20:38', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
  `ID_carrito` int NOT NULL,
  `ID_product` int DEFAULT NULL,
  `ID_promo` int DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `precio` decimal(6,0) DEFAULT NULL,
  `imagen_URL` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `canti_producto` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ID_carrito`),
  KEY `ID_produc` (`ID_product`) USING BTREE,
  KEY `fk_carrito_usuario` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `ID_produc` int NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `provedoor` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `Existencia` int DEFAULT NULL,
  `imagen_URL` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_produc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_produc`, `Nombre`, `provedoor`, `precio`, `categoria`, `Existencia`, `imagen_URL`) VALUES
(3100, 'Platano Tabasco', 'Frutas del  Sureste.', 20.00, 'Fruta', 50, '\\imagenes/PlatanoTabasco.jpg'),
(3101, 'Platano Macho', 'Hortalizas del Sur', 30.00, 'Fruta', 50, '\\imagenes/PlatanoMacho.jpg'),
(3102, 'Platano Burro', 'Hortalizas del Sur', 20.00, 'Fruta', 50, '\\imagenes/PlatanoBurro.jpg'),
(3103, 'Platano Dominicano', 'Tropicales Veracruz', 40.00, 'Fruta', 50, '\\imagenes/PlatanoDominico.jpg'),
(3104, 'Mango Ataulfo', 'Mangos del Soconusco', 35.00, 'Fruta', 50, '\\imagenes/mangoataulfo.jpg'),
(3105, 'Mango Haden', 'Hortalizas del Sur', 40.00, 'Fruta', 50, '\\imagenes/MangoHaden.jpg'),
(3106, 'Mango Kent', 'Hortalizas del Sur', 40.00, 'Fruta', 50, '\\imagenes/mangokent.jpg'),
(3107, 'Uvas sin semilla', 'Frutos del Desierto S.A.', 60.00, 'Fruta', 50, '\\imagenes/UvaSinSemilla.jpg'),
(3108, 'Brocoli', 'Hortalizas del Bajío', 45.00, 'Vegetales', 50, '\\imagenes/Brocoli.jpg'),
(3109, 'Tomate Bola', 'Agropecuaria Jalisco', 35.00, 'Vegetales', 50, '\\imagenes/TomateBola.jpg'),
(3110, 'Chile Habanero', 'Productos Picantes Veracruz', 40.00, 'Vegetales', 50, '\\imagenes/ChileHabaneros.jpg'),
(3111, 'Zanahorias', 'Productos del Centro', 20.00, 'Vegetales', 50, '\\imagenes/Zanahorias.jpg'),
(3112, 'Ajo Fresco', 'Hortalizas del Bajío', 95.00, 'Vegetales', 50, '\\imagenes/Ajo.jpg'),
(3113, 'Espinacas Frescas', 'Verde Fresco de Puebla', 45.00, 'Vegetales', 50, '\\imagenes/Espinacas.jpg'),
(3114, 'Lechga Romana', 'Verde Campo Guanajuato', 20.00, 'Vegetales', 50, '\\imagenes/LechugaRomana.jpg'),
(3115, 'Calabaza', 'Agro Verduras Sinaloa', 30.00, 'Vegetales', 50, '\\imagenes/Calabaza.jpg'),
(3116, 'Avena', 'Frutas del  Sureste.', 20.00, 'Chiles secos y Especias ', 50, '\\imagenes/avena.jpg'),
(3117, 'Lentejas', 'Granos Selectos Aguascalientes', 40.00, 'Chiles secos y Especias ', 50, '\\imagenes/lentejas.jpg'),
(3118, 'Frijol Negro', 'Legumbres del Norte', 30.00, 'Chiles secos y Especias ', 50, '\\imagenes/frijolesnegros.jpg'),
(3119, 'Garbanzo', 'Agro Leguminosas', 45.00, 'Chiles secos y Especias ', 50, '\\imagenes/garbanzo.jpg'),
(3120, 'Semillas de Chía', 'Productos Naturales Oaxaca', 105.00, 'Chiles secos y Especias ', 50, '\\imagenes/SemillasdeChia.jpg'),
(3121, 'Semillas de Girasol', 'Semillas del Norte', 90.00, 'Chiles secos y Especias ', 50, '\\imagenes/SemillasdeGirasol.jpg'),
(3122, 'Chile Pasilla Seco', 'Chiles y Espias de Puebla', 130.00, 'Chiles secos y Especias ', 50, ' \\imagenes/ChilePasillaSeco.jpg '),
(3123, 'Chile Guajillo Seco', 'Especies del Occidente', 120.00, 'Chiles secos y Especias ', 50, ' \\imagenes/ChileGuajilloSeco.jpg '),
(3124, 'Queso Panela', 'Frutas del  Sureste.', 120.00, 'Lacteos, Carnes y Embutidos', 50, ' \\imagenes/QuesoPanela.jpg '),
(3125, 'Crema Ácida', 'Tropicales Veracruz', 80.00, 'Lacteos, Carnes y Embutidos', 50, ' \\imagenes/Cremaacida.jpg '),
(3126, 'Chorizo Tradicional', 'Mangos del Soconusco', 85.00, 'Lacteos, Carnes y Embutidos', 50, ' \\imagenes/ChorizTradicional.jpg '),
(3127, 'Pechuga de Pollo', 'Hortalizas del Sur', 85.00, 'Lacteos, Carnes y Embutidos', 50, ' \\imagenes/PechugadePollo.jpg '),
(3128, 'Costilla de Cerdo', 'Hortalizas del Sur', 185.00, 'Lacteos, Carnes y Embutidos', 50, ' \\imagenes/CostilladeCerdo.jpg'),
(3129, 'Bistec de Res', 'Hortalizas del Sur', 135.00, 'Lacteos, Carnes y Embutidos', 50, ' \\imagenes/BistecdeRes.jpg'),
(3130, 'Jamon de Pavo', 'Hortalizas del Sur', 150.00, 'Lacteos, Carnes y Embutidos', 50, ' \\imagenes/JamondePavo.jpg '),
(3131, 'Queso Oaxaca', 'Hortalizas del Sur', 145.00, 'Lacteos, Carnes y Embutidos', 50, ' \\imagenes/QuesoOaxaca.jpg '),
(3132, 'Arroz Blanco', 'Arroceros del Sur', 28.00, 'Abarrotes', 50, ' \\imagenes/ArrozBlanco.jpg'),
(3133, 'Harina de Trigo', 'Molinos del Valle', 25.00, 'Abarrotes', 50, '\\imagenes/HarinadeTrigo.jpg'),
(3134, 'Pasta de Coditos', 'Comercializadoras', 14.00, 'Abarrotes', 50, ' \\imagenes/PastadeCoditos.jpg '),
(3135, 'Lata de Atún', 'Comercializadora del Cetro', 14.00, 'Abarrotes', 50, ' \\imagenes/LatadeAtun.jpg '),
(3136, 'Sal de Mesa', 'Salinas de Colima', 10.00, 'Abarrotes', 50, ' \\imagenes/Saldemesa.jpg '),
(3137, 'Azucar Morena', 'Comercializadora del Cetro', 35.00, 'Abarrotes', 50, ' \\imagenes/AzucarMorena.jpg '),
(3138, 'Frijol Pinto', 'Legumbres de Zacatecas', 30.00, 'Abarrotes', 50, ' \\imagenes/frijolesnegros.jpg '),
(3139, 'Aceite La Negra', 'Aceites del Norte', 40.00, 'Abarrotes', 50, ' \\imagenes/AceiteLaNegrita.jpg '),
(3140, 'Ace Jabon Liquido', 'Limpia Hogar S.A.', 120.00, 'Detergente-Limpieza', 50, ' \\imagenes/DetergenteLiquidoparaRopa.jpg'),
(3141, 'Fabuloso Lavanda', 'Limpieza Total S.A.', 60.00, 'Detergente-Limpieza', 50, ' \\imagenes/LimpiadorMultiusos.jpg '),
(3142, 'Salvo Limon', 'Quimicos Limpios Queretaro', 35.00, 'Detergente-Limpieza', 50, ' \\imagenes/Salvo.jpg '),
(3143, 'Esponja para Trastes', 'Productos de Limpieza Puebla', 15.00, 'Detergente-Limpieza', 50, ' \\imagenes/Esponja.jpg '),
(3144, 'Glade Desodorrante para Baño', 'Aromas del Golfo', 20.00, 'Detergente-Limpieza', 50, ' \\imagenes/Desodorante.jpg '),
(3145, 'Clorox Toallitas Desinfectantes', 'Ghigiene Express', 25.00, 'Detergente-Limpieza', 50, ' \\imagenes/Toallas.jpg '),
(3146, 'Clorox Desinfectante', 'Desinfectasntes del Norte', 20.00, 'Detergente-Limpieza', 50, ' \\imagenes/Cloro.jpg '),
(3147, 'Downy Suavisante Lavanda', 'Quimicos del Valle', 33.00, 'Detergente-Limpieza', 50, ' \\imagenes/Suavizante.jpg'),
(3148, 'Croquetas Pedigree Adulto', 'Pedigree', 650.00, 'Accesorios-Mascotas', 50, ' \\imagenes/Croquetas.jpg '),
(3149, 'Flexi Sobres para Gato', 'Purina', 220.00, 'Accesorios-Mascotas', 50, ' \\imagenes/Alimentogato.jpg'),
(3150, 'Dentastix Snacks Dentales', 'Pedigree', 130.00, 'Accesorios-Mascotas', 50, ' \\imagenes/Snacks.jpg '),
(3151, 'Shampoo Canino', 'BayoPet', 90.00, 'Accesorios-Mascotas', 50, ' \\imagenes/Shampoo.jpg '),
(3152, 'Multi.Vitamin para Mascotas', 'Salud Animal', 100.00, 'Accesorios-Mascotas', 50, ' \\imagenes/Vitaminas.jpg '),
(3153, 'Arena para Gatos', 'Special Kitty', 130.00, 'Accesorios-Mascotas', 50, ' \\imagenes/Arena.jpg '),
(3154, 'Pedigree Sobres', 'Pedigree', 260.00, 'Accesorios-Mascotas', 50, ' \\imagenes/Sobresperros.jpg '),
(3155, 'ProPlan Croquetas para Gatos', 'Purina', 450.00, 'Accesorios-Mascotas', 50, ' \\imagenes/Croquetasgatos.jpg  ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

DROP TABLE IF EXISTS `promocion`;
CREATE TABLE IF NOT EXISTS `promocion` (
  `ID_promo` int NOT NULL,
  `descripcion` text,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tipodeprod` varchar(100) DEFAULT NULL,
  `precio_antes` decimal(8,0) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `precio_despu` int DEFAULT NULL,
  `ID_producto` int DEFAULT NULL,
  `imagen_URL` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`ID_promo`),
  KEY `ID_producto` (`ID_producto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`ID_promo`, `descripcion`, `titulo`, `tipodeprod`, `precio_antes`, `descuento`, `precio_despu`, `ID_producto`, `imagen_URL`) VALUES
(31550, '¡Nutrición Premium para tu Gato! Lleva la Comida para Gatos Mntadi LCAT FOOD con un 15% de descuento. Dale a tu felino los nutrientes que necesita para mantenerse saludable y lleno de energía.', 'Mntadi LCAT FOOD', 'Comida para Gatos', 300, 15.00, 255, 101, '\\imagenes/Mntadi.jpg'),
(31560, 'Prepara tus recetas favoritas con la mejor pasta. Aprovecha un 20% de descuento en Lannam, pasta de alta calidad y textura perfecta. Ideal para todas tus comidas italianas.', 'Lannam Pasta', 'Pasta', 20, 20.00, 16, 102, '\\imagenes/pasta.jpg'),
(31570, '¡Todo lo que necesitas para la semana! Compra el paquete inteligente que incluye los esenciales de tu despensa como cereales, granos, pastas, y más, ahora con un 30% de descuento.', 'Despensa Inteligente', 'Despensa Básica', 450, 30.00, 315, 103, '\\imagenes/despensa.jpg'),
(31580, 'Ideal para asados y guisos. Aprovecha un 25% de descuento y lleva esta carne fresca de alta calidad directamente del rancho a tu mesa.', 'Pierna de Cerdo con Hueso Congelada', 'Carne de Cerdo', 216, 25.00, 162, 104, '\\imagenes/pierna.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `correo_electronico` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `num_tarjeta` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_tarjeta` date DEFAULT NULL,
  `cvv` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
