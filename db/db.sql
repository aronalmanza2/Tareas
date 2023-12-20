-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.4.28-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para dbtarea
DROP DATABASE IF EXISTS `dbtarea`;
CREATE DATABASE IF NOT EXISTS `dbtarea` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `dbtarea`;

-- Volcando estructura para tabla dbtarea.tarea
DROP TABLE IF EXISTS `tarea`;
CREATE TABLE IF NOT EXISTS `tarea` (
  `idtarea` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`idtarea`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla dbtarea.tarea: ~8 rows (aproximadamente)
DELETE FROM `tarea`;
INSERT INTO `tarea` (`idtarea`, `descripcion`, `estado`, `fecha`) VALUES
	(1, 'jugar', 0, '2023-12-20 17:05:56'),
	(2, 'correr', 0, '2023-12-20 17:06:16'),
	(3, 'saltar', 0, '2023-12-20 17:06:30'),
	(4, 'Nuevo', 0, '0000-00-00 00:00:00'),
	(11, 'asdas', 2, '2023-12-20 06:50:12'),
	(12, 'huhuh', 1, '2023-12-20 06:50:34'),
	(13, 'Hello', 0, '2023-12-20 06:50:40'),
	(14, 'ggf', 1, '2023-12-20 06:53:34');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
