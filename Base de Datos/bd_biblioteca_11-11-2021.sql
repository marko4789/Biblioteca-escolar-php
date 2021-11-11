/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.18-MariaDB : Database - bd_biblioteca
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bd_biblioteca` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `bd_biblioteca`;

/*Table structure for table `alumnos` */

DROP TABLE IF EXISTS `alumnos`;

CREATE TABLE `alumnos` (
  `idAlumno` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidoPaterno` varchar(30) NOT NULL,
  `apellidoMaterno` varchar(30) DEFAULT NULL,
  `matricula` varchar(9) NOT NULL,
  `deudor` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`idAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `alumnos` */

insert  into `alumnos`(`idAlumno`,`nombre`,`apellidoPaterno`,`apellidoMaterno`,`matricula`,`deudor`,`status`) values (1,'Javier','Rosales','Batuecas','1896309-3','Verdadero','Activo'),(2,'Ivanna','Flores','Meza','1896302-5','Verdadero','Activo'),(3,'Miranda','Espericueta','Manzano','1896309-6','Verdadero','Activo'),(4,'Esteban','Quito','Torres','172800-4','Verdadero','Activo'),(5,'Juan Antonio','Ozorio','Tirado','156608-4','Verdadero','Activo'),(6,'Samanta','Salinas','Tostado','1996703-7','Falso','Activo'),(7,'soy tonto','como tierra','me gusta vocaloid','mido 1.50','Falso','Inactivo'),(8,'Oscar ','De la Paz','GonzÃ¡lez','1896312-8','Verdadero','Activo');

/*Table structure for table `autores` */

DROP TABLE IF EXISTS `autores`;

CREATE TABLE `autores` (
  `idAutor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidoPaterno` varchar(30) DEFAULT NULL,
  `apellidoMaterno` varchar(30) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`idAutor`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `autores` */

insert  into `autores`(`idAutor`,`nombre`,`apellidoPaterno`,`apellidoMaterno`,`status`) values (1,'ArmandoEstebanCoppel','Mendez','MartÃ­nez','Activo'),(2,'Dross','','','Activo'),(3,'Topochico','Baygon','Abejita','Inactivo'),(4,'Acetona','Cargador','Salero','Activo'),(5,'Diciembre','JosÃ©','Martillo','Inactivo'),(6,'AntÃ³nimo','','','Activo'),(7,'Javier','Rosales','Torres','Inactivo'),(8,'Samuel','De Luque','Batuecas','Activo'),(9,'BergaGorda','signo de exclamaciÃ³n','Acuario luna menguante','Inactivo'),(10,'Vegetta777','','','Activo'),(11,'WillyRex','','','Activo'),(12,'Werever','Tu','Morro','Inactivo');

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(60) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `categorias` */

insert  into `categorias`(`idCategoria`,`categoria`,`status`) values (1,'Ciencia ficciÃ³n','Activo'),(2,'Romance','Activo'),(3,'Ciencia','Activo'),(4,'Besos negros','Inactivo'),(5,'Suspenso','Activo'),(6,'Terror','Activo');

/*Table structure for table `editoriales` */

DROP TABLE IF EXISTS `editoriales`;

CREATE TABLE `editoriales` (
  `idEditorial` int(11) NOT NULL AUTO_INCREMENT,
  `editorial` varchar(80) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`idEditorial`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `editoriales` */

insert  into `editoriales`(`idEditorial`,`editorial`,`status`) values (1,'Montevideo','Activo'),(2,'Comer fruta','Inactivo'),(3,'Campos de maizales','Activo'),(4,'Asiatic ','Activo'),(5,'Vouleva','Activo');

/*Table structure for table `libros` */

DROP TABLE IF EXISTS `libros`;

CREATE TABLE `libros` (
  `idLibro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `paginas` int(11) NOT NULL,
  `descripcion` varchar(1100) NOT NULL,
  `pais` varchar(20) DEFAULT NULL,
  `fechaPublicacion` date NOT NULL,
  `idioma` varchar(20) DEFAULT NULL,
  `isbn` varchar(13) DEFAULT NULL,
  `existencia` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idEditorial` int(11) NOT NULL,
  `numlibro` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`idLibro`),
  KEY `idCategoria` (`idCategoria`),
  KEY `idEditorial` (`idEditorial`),
  CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`),
  CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`idEditorial`) REFERENCES `editoriales` (`idEditorial`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `libros` */

insert  into `libros`(`idLibro`,`titulo`,`paginas`,`descripcion`,`pais`,`fechaPublicacion`,`idioma`,`isbn`,`existencia`,`idCategoria`,`idEditorial`,`numlibro`,`status`) values (1,'El secreto iluminati',120,'nose me lo inventÃ©','USA','2021-06-20','Espanglish','12533355566',13,1,1,'','Inactivo'),(2,'El amor imposible de Bernardo',100,'tampoco sÃ© jaja','USA','1976-05-05','Espanglish','12533355567',21,2,4,'','Activo'),(3,'Carnes rojas',130,'muy buenas muy deliciosas','Espania','2021-03-10','Espanglish','12533355569',14,3,1,'','Inactivo'),(4,'Viegetta y BabyRex',90,'una aventura maravillosa de amistad y compaÃ±erismo mÃ¡s allÃ¡ de la edad','EspaÃ±a','2019-12-25','EspaÃ±ol Castellano','12533356982',5,1,4,'','Activo'),(5,'Las aventuras de Louie',100,'un libro bien bonito la vdd','MÃ©xico','2021-06-29','Espanglish','125333558953',5,1,3,'','Activo'),(6,'Juan Carlos y su gato',90,'Una historia triste de un hombre de 27 aÃ±os que no sabe hablar con nadie mÃ¡s que no sea su mascota.','USA','2010-07-28','InglÃ©s','12533389230',6,5,4,'','Activo'),(7,'La guÃ­a del ligue',90,'Una guÃ­a super completa qe te alludara a encontrar parega.','MÃ©xico','2012-02-14','EspaÃ±ol Castellano','82543355569',6,2,4,'','Activo');

/*Table structure for table `prestamos` */

DROP TABLE IF EXISTS `prestamos`;

CREATE TABLE `prestamos` (
  `idPrestamo` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idAlumno` int(11) NOT NULL,
  `fechaPrestamo` date NOT NULL,
  `fechaDevolucion` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`idPrestamo`),
  KEY `idLibro` (`idLibro`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idAlumno` (`idAlumno`),
  CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`idLibro`) REFERENCES `libros` (`idLibro`),
  CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  CONSTRAINT `prestamos_ibfk_3` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `prestamos` */

insert  into `prestamos`(`idPrestamo`,`idLibro`,`idUsuario`,`idAlumno`,`fechaPrestamo`,`fechaDevolucion`,`status`) values (1,4,1,5,'2021-06-21',NULL,'Activo'),(2,4,1,2,'2021-06-21',NULL,'Activo'),(3,4,1,6,'2021-06-21',NULL,'Inactivo'),(4,2,1,3,'2021-06-21',NULL,'Activo'),(5,5,1,8,'2021-06-21',NULL,'Inactivo'),(6,3,1,4,'2021-06-22',NULL,'Inactivo'),(15,4,1,4,'2021-06-25',NULL,'Inactivo'),(16,2,1,4,'2021-06-29',NULL,'Activo'),(17,5,1,3,'2021-06-29',NULL,'Activo'),(18,5,1,1,'2021-06-29',NULL,'Inactivo'),(19,5,1,1,'2021-06-29',NULL,'Activo'),(20,4,1,4,'2021-07-01',NULL,'Inactivo'),(21,4,1,1,'2021-07-01',NULL,'Inactivo'),(22,6,1,8,'2021-11-11',NULL,'Activo');

/*Table structure for table `relacion_autoria` */

DROP TABLE IF EXISTS `relacion_autoria`;

CREATE TABLE `relacion_autoria` (
  `idAutoria` int(11) NOT NULL AUTO_INCREMENT,
  `idAutor` int(11) NOT NULL,
  `idLibro` int(11) NOT NULL,
  PRIMARY KEY (`idAutoria`),
  KEY `idAutor` (`idAutor`),
  KEY `idLibro` (`idLibro`),
  CONSTRAINT `relacion_autoria_ibfk_1` FOREIGN KEY (`idAutor`) REFERENCES `autores` (`idAutor`),
  CONSTRAINT `relacion_autoria_ibfk_2` FOREIGN KEY (`idLibro`) REFERENCES `libros` (`idLibro`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*Data for the table `relacion_autoria` */

insert  into `relacion_autoria`(`idAutoria`,`idAutor`,`idLibro`) values (1,8,1),(2,9,1),(4,6,3),(11,10,4),(12,11,4),(13,10,5),(14,2,2),(15,8,2),(16,1,6),(17,2,6),(19,6,7);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidoPaterno` varchar(30) NOT NULL,
  `apellidoMaterno` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idUsuario`,`nombreUsuario`,`nombre`,`apellidoPaterno`,`apellidoMaterno`,`password`,`email`,`status`) values (1,'mony','MÃ³nica Lizbeth','Ruiz','MartÃ­nez','6beca8e02ac6e8ec5cf37c8cfc1eb875','moni_liz2000@hotmail.com','Activo'),(10,'marco','Marco Antonio','Ocampos','Ortega','6beca8e02ac6e8ec5cf37c8cfc1eb875','markos8756@gmail.com','Activo'),(11,'Juanito_Arcoiris','Juan Antonio','Ozorio','Torres','6beca8e02ac6e8ec5cf37c8cfc1eb875','juan_777@hotmail.es','Activo');

/* Procedure structure for procedure `buscarAlumno` */

/*!50003 DROP PROCEDURE IF EXISTS  `buscarAlumno` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarAlumno`(IN `alumno` VARCHAR(50))
SELECT * FROM alumnos WHERE CONCAT(
                    idAlumno,
                    nombre, 
                    apellidoPaterno, 
                    apellidoMaterno,
                    matricula) like concat("%",alumno,"%") AND status = 'Activo' */$$
DELIMITER ;

/* Procedure structure for procedure `buscarAutor` */

/*!50003 DROP PROCEDURE IF EXISTS  `buscarAutor` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarAutor`(IN `autor` VARCHAR(50) CHARSET utf8)
Select * FROM autores WHERE CONCAT(
                    idAutor,
                    nombre, 
                    apellidoPaterno, 
                    apellidoMaterno) like concat("%",autor,"%") AND status = 'Activo' */$$
DELIMITER ;

/* Procedure structure for procedure `buscarCategoria` */

/*!50003 DROP PROCEDURE IF EXISTS  `buscarCategoria` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarCategoria`(IN `cat` VARCHAR(50))
Select * FROM categorias WHERE CONCAT(
                    idCategoria,
                    categoria) like concat("%",cat,"%") AND status = 'Activo' */$$
DELIMITER ;

/* Procedure structure for procedure `buscarEditorial` */

/*!50003 DROP PROCEDURE IF EXISTS  `buscarEditorial` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarEditorial`(IN `edito` VARCHAR(50))
Select * FROM editoriales WHERE CONCAT(
                    idEditorial,
                    editorial) like concat("%",edito,"%") AND status = 'Activo' */$$
DELIMITER ;

/* Procedure structure for procedure `buscarGeneral` */

/*!50003 DROP PROCEDURE IF EXISTS  `buscarGeneral` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarGeneral`(IN `tabla` VARCHAR(20), IN `campo` VARCHAR(20), IN `id` INT(11))
BEGIN
set @tabla = tabla;
set @campo = campo;
set @sql = CONCAT("Select * from ",@tabla," where ",@campo,"=",id," and status='Activo'");
PREPARE stm from @sql;
EXECUTE stm;
DEALLOCATE PREPARE stm;
END */$$
DELIMITER ;

/* Procedure structure for procedure `buscarLibro` */

/*!50003 DROP PROCEDURE IF EXISTS  `buscarLibro` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarLibro`(IN `libro` VARCHAR(50) CHARSET utf8)
SELECT * FROM (((libros 
                            INNER JOIN relacion_autoria ON libros.idLibro = relacion_autoria.idlibro)
                            INNER JOIN autores ON relacion_autoria.idAutor = autores.idAutor)
                            INNER JOIN categorias ON libros.idCategoria = categorias.idCategoria)
                        WHERE CONCAT(libros.isbn, 
                                libros.titulo, 
                                autores.nombre,
                                categorias.categoria, 
                                autores.apellidoPaterno, 
                                autores.apellidoMaterno) 
                        LIKE concat("%",libro,"%") AND libros.status = 'Activo' */$$
DELIMITER ;

/* Procedure structure for procedure `buscarLibroID` */

/*!50003 DROP PROCEDURE IF EXISTS  `buscarLibroID` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarLibroID`(IN `libro` INT(11))
SELECT  libros.idLibro, 
                                libros.isbn, 
                                libros.titulo, 
                                libros.paginas, 
                                libros.descripcion, 
                                libros.pais, 
                                libros.fechaPublicacion, 
                                libros.idioma, 
                                libros.existencia, 
                                categorias.categoria,
                                categorias.idCategoria, 
                                editoriales.editorial, 
                                editoriales.idEditorial FROM ((libros INNER JOIN categorias ON libros.idCategoria = categorias.idCategoria) INNER JOIN editoriales ON libros.idEditorial = editoriales.idEditorial) WHERE libros.idLibro = libro AND libros.status = 'Activo' */$$
DELIMITER ;

/* Procedure structure for procedure `buscarPrestamo` */

/*!50003 DROP PROCEDURE IF EXISTS  `buscarPrestamo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarPrestamo`(IN `prestamo` VARCHAR(20) CHARSET utf8)
SELECT prestamos.`idPrestamo`, libros.`titulo`, alumnos.`nombre`,alumnos.`apellidoPaterno`,alumnos.`apellidoMaterno`,
                    alumnos.`matricula` , prestamos.`fechaPrestamo` FROM prestamos
                    INNER JOIN libros ON libros.`idLibro`=prestamos.`idLibro`
                    INNER JOIN alumnos ON alumnos.`idAlumno`=prestamos.`idAlumno`
			WHERE CONCAT(
                    idPrestamo, libros.`titulo`, alumnos.`nombre`,alumnos.`apellidoPaterno`,alumnos.`apellidoMaterno`,
                    alumnos.`matricula` , prestamos.`fechaPrestamo`) LIKE concat('%',prestamo,'%') AND prestamos.`status` = 'Activo' */$$
DELIMITER ;

/* Procedure structure for procedure `buscarPrestamoID` */

/*!50003 DROP PROCEDURE IF EXISTS  `buscarPrestamoID` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarPrestamoID`(IN `prestamo` INT(11))
SELECT prestamos.`idLibro`, prestamos.`idAlumno`, prestamos.`idPrestamo`, libros.`titulo`, alumnos.`nombre`,alumnos.`apellidoPaterno`,alumnos.`apellidoMaterno`,
                    alumnos.`matricula` , prestamos.`fechaPrestamo` FROM prestamos
                    INNER JOIN libros ON libros.`idLibro`=prestamos.`idLibro`
                    INNER JOIN alumnos ON alumnos.`idAlumno`=prestamos.`idAlumno`
                    WHERE idPrestamo = prestamo AND prestamos.`status` = 'Activo' */$$
DELIMITER ;

/* Procedure structure for procedure `buscarUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `buscarUsuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarUsuario`(IN `usuario` VARCHAR(20) CHARSET utf8)
Select * FROM usuarios WHERE CONCAT(
                    idUsuario,
                    nombreUsuario, 
                    nombre, 
                    apellidoPaterno, 
                    apellidoMaterno) like concat("%",usuario,"%") AND status = 'Activo' */$$
DELIMITER ;

/* Procedure structure for procedure `consultarPrestamo` */

/*!50003 DROP PROCEDURE IF EXISTS  `consultarPrestamo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarPrestamo`()
SELECT prestamos.`idPrestamo`, libros.`titulo`, alumnos.`nombre`,alumnos.`apellidoPaterno`,alumnos.`apellidoMaterno`,
                alumnos.`matricula` , prestamos.`fechaPrestamo` FROM prestamos
                INNER JOIN libros ON libros.`idLibro`=prestamos.`idLibro`
                INNER JOIN alumnos ON alumnos.`idAlumno`=prestamos.`idAlumno`
                WHERE prestamos.`status` = 'Activo'  ORDER BY idPrestamo */$$
DELIMITER ;

/* Procedure structure for procedure `obtenerAutores` */

/*!50003 DROP PROCEDURE IF EXISTS  `obtenerAutores` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerAutores`(IN `id_Libro` INT(11))
SELECT autores.nombre, autores.apellidoPaterno, autores.apellidoMaterno
                    FROM (autores
                    INNER JOIN relacion_autoria ON autores.idAutor = relacion_autoria.idAutor)
                    WHERE relacion_autoria.idLibro = id_Libro */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
