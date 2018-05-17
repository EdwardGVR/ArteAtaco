-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: login_propio
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carrito_usuario_idx` (`id_user`),
  KEY `carrito_user_idx` (`id_user`),
  CONSTRAINT `carrito_user` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cat` varchar(100) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nombre_categoria` (`nombre_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'L&aacutemparas','images/categorias/lamp.png'),(2,'Atrapasue&ntildeos','images/categorias/atrapa.jpg'),(3,'Banquetas','images/categorias/banqueta.png'),(4,'Llamadores','images/categorias/misc.png'),(5,'Bisuteria','images/categorias/bisute.png'),(6,'Nequi','images/categorias/nequi.jpg'),(7,'Instrumentos','images/categorias/instrumentos.jpg'),(8,'Farolitos','images/categorias/farolitos.jpg');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_zona` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `departamentos_zonas_idx` (`id_zona`),
  CONSTRAINT `departamentos_zonas` FOREIGN KEY (`id_zona`) REFERENCES `zonas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,1,'Ahuachap&aacute;n'),(2,1,'Santa Ana'),(3,1,'Sonsonate'),(4,2,'La Libertad'),(5,2,'Chalatenango'),(6,2,'Cuscatl&aacute;n'),(7,2,'San Salvador'),(8,3,'La Paz'),(9,3,'Caba&ntilde;as'),(10,3,'San Vicente'),(11,4,'Usulut&aacute;n'),(12,4,'San Miguel'),(13,4,'Moraz&aacute;n'),(14,4,'La Uni&oacute;n');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `linea1` varchar(150) NOT NULL,
  `linea2` varchar(150) DEFAULT NULL,
  `referencias` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direcciones_usuario_idx` (`id_user`),
  KEY `direcciones_departemento_idx` (`id_departamento`),
  CONSTRAINT `direcciones_departemento` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `direcciones_usuario` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones`
--

LOCK TABLES `direcciones` WRITE;
/*!40000 ALTER TABLE `direcciones` DISABLE KEYS */;
INSERT INTO `direcciones` VALUES (29,2,1,'Direccion test 5','El Salvador','Direccion de prueba',NULL,NULL);
/*!40000 ALTER TABLE `direcciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones_persistence`
--

DROP TABLE IF EXISTS `direcciones_persistence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direcciones_persistence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `linea1` varchar(150) NOT NULL,
  `linea2` varchar(150) DEFAULT NULL,
  `referencias` varchar(250) DEFAULT NULL,
  `activa` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones_persistence`
--

LOCK TABLES `direcciones_persistence` WRITE;
/*!40000 ALTER TABLE `direcciones_persistence` DISABLE KEYS */;
INSERT INTO `direcciones_persistence` VALUES (1,2,1,'Direccion 1','El Salvador','Direccion de prueba',NULL,NULL,0),(2,2,1,'Direccion 2','El Salvador','Direccion de prueba','Probar la edicion en ambas tablas','No hay datos',0),(3,2,1,'Direccion 3','El Salvador','Direccion de prueba',NULL,NULL,0),(4,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(5,2,1,'Direccion 5','El Salvador','Direccion de prueba',NULL,NULL,0),(6,2,1,'Direccion 5','El Salvador','Direccion de prueba',NULL,NULL,0),(7,2,1,'Direccion 5','El Salvador','Direccion de prueba',NULL,NULL,0),(8,2,1,'Direccion 5','El Salvador','Direccion de prueba',NULL,NULL,0),(9,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(10,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(11,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(12,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(13,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(14,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(15,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(16,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(17,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(18,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(19,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(20,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(21,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(22,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(23,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(24,2,1,'Direccion 4','El Salvador','Direccion de prueba',NULL,NULL,0),(25,2,1,'Direccion 5 editada','El Salvador','Direccion de prueba','No hay datos','No hay datos',0),(26,2,1,'Direccion test 1','El Salvador','Direccion de prueba',NULL,NULL,0),(27,2,1,'Direccion test 2','El Salvador','Direccion de prueba\\',NULL,NULL,0),(28,2,1,'Direccion test 3','El Salvador','Direccion de prueba',NULL,NULL,0),(29,2,1,'Direccion test 5','El Salvador','Direccion de prueba',NULL,NULL,1);
/*!40000 ALTER TABLE `direcciones_persistence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imgs_prods`
--

DROP TABLE IF EXISTS `imgs_prods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imgs_prods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod` int(11) NOT NULL,
  `ruta` varchar(150) NOT NULL,
  `principal` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `prodImgs_prod_idx` (`id_prod`),
  CONSTRAINT `prodImgs_prod` FOREIGN KEY (`id_prod`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imgs_prods`
--

LOCK TABLES `imgs_prods` WRITE;
/*!40000 ALTER TABLE `imgs_prods` DISABLE KEYS */;
INSERT INTO `imgs_prods` VALUES (1,1,'images/productos/lamparas/lampara1_img1.jpg',0),(3,1,'images/productos/lamparas/lampara1_img2.jpg',1),(7,2,'images/productos/lamparas/lampara2_img1.jpg',1),(8,3,'images/productos/lamparas/lampara3_img1.jpg',0);
/*!40000 ALTER TABLE `imgs_prods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodos_pago`
--

DROP TABLE IF EXISTS `metodos_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodos_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodos_pago`
--

LOCK TABLES `metodos_pago` WRITE;
/*!40000 ALTER TABLE `metodos_pago` DISABLE KEYS */;
INSERT INTO `metodos_pago` VALUES (1,'Transferencia bancaria','fa fa-university'),(2,'M&eacute;todo 2','fa fa-money'),(3,'M&eacute;todo 3','fa fa-money');
/*!40000 ALTER TABLE `metodos_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pedidos_user_idx` (`id_user`),
  KEY `pedidos_producto_idx` (`id_producto`),
  KEY `pedidos_pago_idx` (`id_pago`),
  KEY `pedidos_direccionPersist_idx` (`id_direccion`),
  CONSTRAINT `pedidos_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones_persistence` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pedidos_pago` FOREIGN KEY (`id_pago`) REFERENCES `metodos_pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pedidos_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pedidos_user` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,21199,2,1,1,1,1,0,'2018-01-19 20:34:33'),(2,221810,2,2,1,2,1,0,'2018-01-19 20:34:53'),(3,2251111,2,25,1,3,1,0,'2018-01-19 21:20:08'),(4,2261012,2,26,1,1,1,0,'2018-01-19 21:27:41'),(5,2271013,2,27,1,2,1,0,'2018-01-19 21:50:36'),(6,2291114,2,29,1,1,1,0,'2018-01-19 21:51:38');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` text,
  `stock` int(11) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `disponible` tinyint(4) NOT NULL DEFAULT '1',
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `productos_categorias_idx` (`id_categoria`),
  CONSTRAINT `productos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,1,'L&aacutempara de b&uacuteho',15,'L&aacutempara de b&uacuteho hecha en PVC calado',3,'images/productos/lamparas/pvc/buho.jpg',1,'2018-05-12 23:58:35'),(2,1,'L&aacute;mpara 2',15,'LÃ¡mpara de otra cosa para probar                                    ',2,'images/productos/lamparas/pvc/lamp1.jpg',1,'2018-05-12 23:58:35'),(3,1,'L&aacute;mpara 3',15,'LÃ¡mpara de bÃºho hecha en PVC calado                                    ',1,'images/productos/lamparas/pvc/lamp2.jpg',1,'2018-05-12 23:58:35'),(4,1,'L&aacute;mpara 4',15,'LÃ¡mpara de bÃºho hecha en PVC calado                                    ',2,'images/productos/lamparas/pvc/lamp3.jpg',1,'2018-05-12 23:58:35'),(6,3,'Producto nuevo',5,'Descripcion del nuevo producto',NULL,NULL,1,'2018-05-13 00:09:39');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temporal`
--

DROP TABLE IF EXISTS `temporal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temporal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `id_pago` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tmp_usuario_idx` (`id_user`),
  KEY `tmp_pago_idx` (`id_pago`),
  KEY `tmp_direccion_idx` (`id_direccion`),
  CONSTRAINT `tmp_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tmp_pago` FOREIGN KEY (`id_pago`) REFERENCES `metodos_pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tmp_usuario` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temporal`
--

LOCK TABLES `temporal` WRITE;
/*!40000 ALTER TABLE `temporal` DISABLE KEYS */;
/*!40000 ALTER TABLE `temporal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'fuljencio','Fuljencio Imbecil','Apellidos Prueba','fuljencio@gmail.com','12345',NULL,NULL),(2,'edward','Edward Ernesto','Guevara','edwardgvr@gmail.com','asdfg','images/user/profile/user_img_2.jpg',NULL),(3,'prueba4','Usuario de prueba','Prueba','prueba@mail.com','asdfg',NULL,'555555'),(4,'usuario','usuario nombre','prueba apellido','nombre@apellidos.com','usuario',NULL,NULL),(5,'test5','registro','prueba','registro@prueba.com','asdfg',NULL,'55555555'),(6,'test6','usuario','numero6','test6@mail.com','asdfg','images/user/profile/user_img_6.jpg',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zonas`
--

DROP TABLE IF EXISTS `zonas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zonas`
--

LOCK TABLES `zonas` WRITE;
/*!40000 ALTER TABLE `zonas` DISABLE KEYS */;
INSERT INTO `zonas` VALUES (1,'occidental'),(2,'central'),(3,'paracentral'),(4,'oriental');
/*!40000 ALTER TABLE `zonas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-17 12:47:01
