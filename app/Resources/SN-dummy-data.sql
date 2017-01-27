# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42)
# Base de datos: socialnetworkdb
# Tiempo de Generación: 2017-01-24 11:09:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla sn_user
# ------------------------------------------------------------

LOCK TABLES `sn_user` WRITE;
/*!40000 ALTER TABLE `sn_user` DISABLE KEYS */;

INSERT INTO `sn_user` (`id`, `role`, `email`, `name`, `surname`, `password`, `nick`, `bio`, `active`, `image`)
VALUES
	(1,'ROLE_ADMIN','admin@admin.com','Fran','Aragon','1234','admin',NULL,'1',NULL),
	(2,'ROLE_USER','antonio@lopez.com','Antonio','Lopez','$2y$04$Ft4NPHCrtriPJtQHs38gd.dIOpEuVxJ6IXhDr0Fmw8mazPqzORnqS','antonio_lopez',NULL,NULL,NULL),
	(3,'ROLE_USER','manu@lopez.com','Manuel','Lopez','$2y$04$pMFpoGUDGzYwARUfFfjIJ.Ix9mSHNsqKL30DdxgJiSyxA2xmP94si','manu_lopez',NULL,NULL,NULL),
	(4,'ROLE_USER','fran@aragon.com','Fran','Aragon','$2y$04$2MxPeziXtQ3DdDKTJvJsyuEHuYuhfGkUTl8RpnY76crd8k0pwCByC','fran_aragon','Me gusta ayudar con mis conocimientos a los demás dentro de mi campo, tener buenas amistades en las que confiar, soy amable, educado, con un punto de humor.',NULL,'4_imgprofile_1483641671.jpeg'),
	(5,'ROLE_USER','juan2@lopez.com','Juan','Lopez','$2y$04$BVv.gQua3xdasFNXTm.RHODQZeSDr/kpQFK0JzXihrZmxBLUY7N2e','juan2_lopez',NULL,NULL,NULL),
	(6,'ROLE_USER','raul@sanchez.com','Raul','Sanchez','$2y$04$FNyVOkP6.4KBJuZZSokU5OLPgoUSS.Osoc3sDjF04Pm00FIUKwQIC','raul_sanchez',NULL,NULL,NULL),
	(7,'ROLE_USER','paco@montes.com','Paco','Montes','$2y$04$eHI/fIiP24CR8Oo2I1yStuC3BJNEEePxq/L7.uGqiQkqnulbnwF8K','paco_montes',NULL,NULL,NULL),
	(8,'ROLE_USER','cande@vergi.com','cande','vergi','$2y$04$UZxc8aaFA41y4V26LImkXONWX2/Cb47o/09sgyAdxC2XJW6j650gm','cande_vergi',NULL,NULL,NULL);

/*!40000 ALTER TABLE `sn_user` ENABLE KEYS */;
UNLOCK TABLES;

# Volcado de tabla sn_publication
# ------------------------------------------------------------

LOCK TABLES `sn_publication` WRITE;
/*!40000 ALTER TABLE `sn_publication` DISABLE KEYS */;

INSERT INTO `sn_publication` (`id`, `user`, `texto`, `document`, `image`, `status`, `created_at`)
VALUES
	(1,4,'mi primer tweet','4_docpublication_1483641736.pdf','4_imgpublication_1483641736.jpeg',NULL,'2017-01-05 19:42:16'),
	(2,2,'Hoy hace buen dia!!!! me voy a la playa en #enero en este atardecer #diadeplaya',NULL,'2_imgpublication_1483723951.jpeg',NULL,'2017-01-06 18:32:31'),
	(3,2,'El agua esta genial!!!',NULL,NULL,NULL,'2017-01-06 18:33:43'),
	(4,3,'Conduciendo por la noche y viendo el mar #noche #luna',NULL,'3_imgpublication_1483724485.jpeg',NULL,'2017-01-06 18:41:25'),
	(5,3,'Música para esta noche tan especial #musica #driving',NULL,NULL,NULL,'2017-01-06 18:41:58'),
	(6,5,'Una de las 10 Mejores Ciudades de Playa en el Mundo, Santa Mónica combina energía urbana y playa #California.',NULL,'5_imgpublication_1483724811.jpeg',NULL,'2017-01-06 18:46:51'),
	(7,5,'#Hollywood es una parte esencial de su experiencia en #LosAngeles',NULL,'5_imgpublication_1483724880.jpeg',NULL,'2017-01-06 18:48:00'),
	(8,6,'Rumbo a #NewYork #travel',NULL,'6_imgpublication_1483725024.jpeg',NULL,'2017-01-06 18:50:24'),
	(9,6,'Con sus luces y carteles publicitarios, #TimesSquare se ha convertido en la imagen más conocida de #NuevaYork',NULL,'6_imgpublication_1483725164.jpeg',NULL,'2017-01-06 18:52:44'),
	(10,6,'El Capitolio de los Estados Unidos es el edificio que alberga las dos cámaras del Congreso de los Estados Unidos',NULL,'6_imgpublication_1483725265.jpeg',NULL,'2017-01-06 18:54:25'),
	(11,6,'Esta noche a ver un musical a Broadway en Nueva York',NULL,'6_imgpublication_1483725653.jpeg',NULL,'2017-01-06 19:00:53'),
	(12,7,'Ya en mi pueblo #Carcabuey precioso #naturaleza en estado puro',NULL,'7_imgpublication_1483725806.jpeg',NULL,'2017-01-06 19:03:26'),
	(13,4,'lorem ipsum',NULL,NULL,NULL,'2017-01-11 16:53:20'),
	(14,4,'WhatsApp ya tiene ocho años entre nosotros',NULL,NULL,NULL,'2017-01-11 16:55:00'),
	(15,4,'Great Apps Timeline es un pequeño proyecto que busca crear una linea de tiempo con los cambios',NULL,NULL,NULL,'2017-01-11 16:55:20'),
	(16,4,'Las capturas muestran solo la versión en iOS, y la razón que han dado para esto es que usualmente la mayoría de esas apps llegaron primero al dispositivo de Apple.',NULL,NULL,NULL,'2017-01-11 16:55:41'),
	(17,4,'Estoy más interesado en encontrar una posición que realmente se ajuste a mis habilidades. Estoy seguro de que su oferta será competitiva en ese sentido',NULL,NULL,NULL,'2017-01-11 16:56:48'),
	(18,4,'Soy flexible en cuanto al sueldo. La posición y el potencial de crecimiento profesional del puesto me interesan mucho más. ¿Cuál es la horquilla salarial que maneja para el puesto en ese sentido?',NULL,NULL,NULL,'2017-01-11 16:57:08'),
	(19,4,'Prefiero no discutir lo que estoy ganando actualmente porque este puesto no se corresponde exactamente con el mío actual y estoy convencido de que el salario será el apropiado.',NULL,NULL,NULL,'2017-01-11 16:57:31'),
	(20,4,'Mi actual empleador no me permite discutir compensaciones monetarias fuera de la compañía y me gustaría respetar esa privacidad.',NULL,NULL,NULL,'2017-01-11 16:57:44'),
	(21,4,'Entiendo que el sueldo no es discutible, pero he visto que cuentan con un programa de bonos asociado a una certificación que...',NULL,NULL,NULL,'2017-01-11 16:58:35'),
	(22,4,'La cifra es bastante más baja que lo que tenía pensado. Me encantaría discutir cuáles serán los parámetros de esa mejora en el futuro. Se que mi puesto depende mucho de (insertar valor aquí). Si soy capaz de subir esa cifra en (dar un margen razonable) ¿sería posible elevar el salario a (dar cifra salarial)?',NULL,NULL,NULL,'2017-01-11 16:59:33');

/*!40000 ALTER TABLE `sn_publication` ENABLE KEYS */;
UNLOCK TABLES;

# Volcado de tabla sn_follow
# ------------------------------------------------------------

LOCK TABLES `sn_follow` WRITE;
/*!40000 ALTER TABLE `sn_follow` DISABLE KEYS */;

INSERT INTO `sn_follow` (`id`, `user`, `followed`)
VALUES
	(4,4,6),
	(6,4,2),
	(7,4,5),
	(8,4,7),
	(9,4,8),
	(10,3,4),
	(11,2,4),
	(12,7,4),
	(13,8,4),
	(14,5,4),
	(17,6,4),
	(18,4,3),
	(22,4,1);

/*!40000 ALTER TABLE `sn_follow` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla sn_like
# ------------------------------------------------------------

LOCK TABLES `sn_like` WRITE;
/*!40000 ALTER TABLE `sn_like` DISABLE KEYS */;

INSERT INTO `sn_like` (`id`, `user`, `publication`)
VALUES
	(2,4,11),
	(3,4,9),
	(4,4,10),
	(5,4,8),
	(6,4,7),
	(7,4,6),
	(8,4,5),
	(9,4,4),
	(10,4,3),
	(11,6,22),
	(12,6,21),
	(13,6,20),
	(14,6,19),
	(15,6,18),
	(16,6,17),
	(17,6,16);

/*!40000 ALTER TABLE `sn_like` ENABLE KEYS */;
UNLOCK TABLES;

# Volcado de tabla sn_notification
# ------------------------------------------------------------

LOCK TABLES `sn_notification` WRITE;
/*!40000 ALTER TABLE `sn_notification` DISABLE KEYS */;

INSERT INTO `sn_notification` (`id`, `user`, `type`, `type_id`, `readed`, `created_at`, `extra`)
VALUES
	(1,4,'follow',6,'0','2017-01-18 13:29:06',NULL),
	(2,4,'like',6,'0','2017-01-18 13:31:03','22'),
	(3,4,'like',6,'0','2017-01-18 13:31:05','21'),
	(4,4,'like',6,'0','2017-01-18 13:31:07','20'),
	(5,4,'like',6,'0','2017-01-18 13:31:11','19'),
	(6,4,'like',6,'0','2017-01-18 13:31:14','18'),
	(7,4,'like',6,'0','2017-01-18 13:31:17','17'),
	(8,4,'like',6,'0','2017-01-18 13:31:19','16'),
	(9,3,'follow',4,'0','2017-01-22 16:52:19',NULL),
	(12,1,'follow',4,'0','2017-01-23 15:32:14',NULL),
	(13,1,'follow',4,'0','2017-01-23 15:45:06',NULL);

/*!40000 ALTER TABLE `sn_notification` ENABLE KEYS */;
UNLOCK TABLES;

# Volcado de tabla sn_private_message
# ------------------------------------------------------------

LOCK TABLES `sn_private_message` WRITE;
/*!40000 ALTER TABLE `sn_private_message` DISABLE KEYS */;

INSERT INTO `sn_private_message` (`id`, `emitter`, `receiver`, `message`, `file`, `image`, `readed`, `created_at`)
VALUES
	(1,4,6,'Hola Raul como estas te mando un Saludo',NULL,NULL,'0','2017-01-22 16:49:39'),
	(2,4,8,'Hola te mando una imagen y un pdf','4_docpmessage_1485100254.pdf','4_imgpmessage_1485100254.jpeg','0','2017-01-22 16:50:54'),
	(3,4,6,'Te mando una imagen muy chula',NULL,'4_imgpmessage_1485100441.jpeg','0','2017-01-22 16:54:01'),
	(4,6,4,'Hola como estas',NULL,'6_imgpmessage_1485109533.jpeg','0','2017-01-22 19:25:33'),
	(5,7,4,'desde carcabuey te escribo',NULL,'7_imgpmessage_1485109588.jpeg','0','2017-01-22 19:26:28'),
	(6,7,4,'estoy muy bien en mi casa',NULL,NULL,'0','2017-01-22 19:26:52'),
	(7,3,4,'hola me encuentro muy bien gracias',NULL,NULL,'0','2017-01-22 19:27:43'),
	(8,3,4,'estoy en la playa de vacaciones mira esto',NULL,'3_imgpmessage_1485109689.jpeg','0','2017-01-22 19:28:09'),
	(9,8,4,'hola fran me ayudas con una web?',NULL,NULL,'0','2017-01-22 19:29:51'),
	(10,4,6,'hola Raul podemos ir a Madrid a ver cosas chulas',NULL,NULL,'0','2017-01-22 19:30:44'),
	(11,4,3,'donde estas?',NULL,NULL,'0','2017-01-22 19:31:08'),
	(12,4,8,'has terminado la web?',NULL,NULL,'0','2017-01-22 19:31:35');

/*!40000 ALTER TABLE `sn_private_message` ENABLE KEYS */;
UNLOCK TABLES;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
