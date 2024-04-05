CREATE DATABASE IF NOT EXISTS `bd_asistencias`;

USE `bd_asistencias`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `asistencia_niños`;

CREATE TABLE `asistencia_niños` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_marcacion` date DEFAULT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `estado` varchar(80) NOT NULL,
  `observacion_entrada` varchar(100) DEFAULT NULL,
  `observacion_salida` varchar(100) DEFAULT NULL,
  `niño_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `niño_id` (`niño_id`),
  CONSTRAINT `asistencia_niños_ibfk_1` FOREIGN KEY (`niño_id`) REFERENCES `niños` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `asistencia_niños` VALUES (28,"2024-04-02","23:35:01","23:35:04","A","","",4),
(29,"2024-04-02","23:35:36",NULL,"A","",NULL,3),
(31,"2024-04-03","14:53:35",NULL,"A","",NULL,3),
(33,"2024-04-04","09:54:50",NULL,"A","",NULL,4),
(34,"2024-04-04","16:35:32",NULL,"A","",NULL,13),


DROP TABLE IF EXISTS `asistencias`;

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_marcacion` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time DEFAULT NULL,
  `estado` varchar(80) NOT NULL,
  `latitud` double(10,8) DEFAULT NULL,
  `longitud` decimal(12,8) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `asistencias` VALUES (19,"2024-04-03","14:52:56","14:53:07","A","-1.51024","-78.00009900",12),
(21,"2024-04-04","16:35:37",NULL,"A","-1.51024","-78.00009900",15),


DROP TABLE IF EXISTS `aula_usuario`;

CREATE TABLE `aula_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aula_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aula_id` (`aula_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `aula_usuario_ibfk_1` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aula_usuario_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `aula_usuario` VALUES (1,1,12),
(5,2,15),
(6,3,17),
(8,6,19),


DROP TABLE IF EXISTS `aulas`;

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `aulas` VALUES (1,"Aula 1","aula de ninos"),
(2,"Aula 2","Aula numero 2"),
(3,"Aula 3","Aula numero tres"),
(4,"Aula 4","Aula 4"),
(5,"Aula 5","Aula 5"),
(6,"Aula 6"," "),


DROP TABLE IF EXISTS `niños`;

CREATE TABLE `niños` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(20) NOT NULL,
  `primer_nombre` varchar(100) NOT NULL,
  `segundo_nombre` varchar(100) NOT NULL,
  `primer_apellido` varchar(100) NOT NULL,
  `segundo_apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `aula_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aula_id` (`aula_id`),
  CONSTRAINT `niños_ibfk_1` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `niños` VALUES (1,1600774411,"Jhonly","Alberto","Mendoza","Perez","2021-11-11","masculino","2024-04-02 11:02:22","2024-04-04 10:31:32",1),
(2,1600748877,"Manuel","Mario","Mercedes","Moran","2004-04-15","masculino","2024-04-02 11:03:38","2024-04-04 10:31:36",1),
(3,1600745574,"Joselyn","Andrea","Benitez","Morales","2022-12-11","femenino","2024-04-02 12:32:57","2024-04-04 10:31:40",1),
(4,1600784477,"Nayeli","Caronlina","Beltran","Mora","2014-07-11","femenino","2024-04-02 12:34:52","2024-04-04 10:31:43",1),
(13,12345678,"Alex","Manuel","Quiroz","Quito","2021-11-11","masculino","2024-04-04 11:32:54","2024-04-04 11:32:54",2),


DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rol` VALUES (1,"admin","admin",1),
(2,"personal","Rol del personal",1),
(3,"guardia","Rol del guardia",1),


DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(10) NOT NULL,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) NOT NULL,
  `numero_celular` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` VALUES (12,1600560872,"Admin","","","","0983932864","admin@admin.com","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92",1,"2024-04-01 17:33:13","2024-04-04 16:34:32",1),
(15,1600560877,"Johan","Joasad","asdasda","sdasd","aasdasd","johancass1@gmail.com","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92",1,"2024-04-04 09:49:26","2024-04-04 09:49:26",2),
(17,1600560880,"Tani","Maricela","Caiza","Quinatoa","098774411","taniacaiza@gmail.com","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92",1,"2024-04-04 14:21:40","2024-04-04 16:54:34",2),
(19,123456789,"Usuario","User","Usera","User",123456789,"user@user.com","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92",1,"2024-04-04 16:56:45","2024-04-04 16:57:40",2),


SET foreign_key_checks = 1;
