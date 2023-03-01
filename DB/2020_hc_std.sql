-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.3.16-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para hc
DROP DATABASE IF EXISTS `hc`;
CREATE DATABASE IF NOT EXISTS `hc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hc`;

-- Volcando estructura para tabla hc.clasesocial
DROP TABLE IF EXISTS `clasesocial`;
CREATE TABLE IF NOT EXISTS `clasesocial` (
  `idClaseSocial` varchar(5) NOT NULL,
  `claseSocial` varchar(200) NOT NULL,
  PRIMARY KEY (`idClaseSocial`),
  UNIQUE KEY `claseSocial` (`claseSocial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hc.clasesocial: ~6 rows (aproximadamente)
DELETE FROM `clasesocial`;
/*!40000 ALTER TABLE `clasesocial` DISABLE KEYS */;
INSERT INTO `clasesocial` (`idClaseSocial`, `claseSocial`) VALUES
	('1', 'Alta'),
	('4', 'Baja'),
	('5', 'Desocupada'),
	('3', 'Media'),
	('2', 'Media Alta'),
	('0', 'No Determinada');
/*!40000 ALTER TABLE `clasesocial` ENABLE KEYS */;

-- Volcando estructura para tabla hc.descripcion
DROP TABLE IF EXISTS `descripcion`;
CREATE TABLE IF NOT EXISTS `descripcion` (
  `idDescripcion` int(11) NOT NULL AUTO_INCREMENT,
  `idPaciente` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `descripcionFecha` datetime NOT NULL DEFAULT current_timestamp(),
  `descripcionEvolucion` longtext COLLATE latin1_general_ci DEFAULT NULL,
  `descripcionTratamiento` longtext COLLATE latin1_general_ci DEFAULT NULL,
  `descripcionEstudios` longtext COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`idDescripcion`)
) ENGINE=MyISAM AUTO_INCREMENT=3439 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Volcando datos para la tabla hc.descripcion: 0 rows
DELETE FROM `descripcion`;
/*!40000 ALTER TABLE `descripcion` DISABLE KEYS */;
/*!40000 ALTER TABLE `descripcion` ENABLE KEYS */;

-- Volcando estructura para tabla hc.diagnostico
DROP TABLE IF EXISTS `diagnostico`;
CREATE TABLE IF NOT EXISTS `diagnostico` (
  `idDiagnostico` varchar(5) NOT NULL,
  `diagnosticoCategoria` varchar(200) DEFAULT NULL,
  `diagnosticoDescripcion` varchar(245) NOT NULL,
  PRIMARY KEY (`idDiagnostico`),
  KEY `diagnosticoCategoria` (`diagnosticoCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hc.diagnostico: ~228 rows (aproximadamente)
DELETE FROM `diagnostico`;
/*!40000 ALTER TABLE `diagnostico` DISABLE KEYS */;
INSERT INTO `diagnostico` (`idDiagnostico`, `diagnosticoCategoria`, `diagnosticoDescripcion`) VALUES
	('F00', NULL, 'Demencia en la enfermedad de Alzheimer'),
	('F00-F', NULL, 'Trastornos mentales orgánicos, incluidos los sintomáticos '),
	('F01', NULL, 'Demencia vascular'),
	('F01.1', NULL, 'Demencia multi-infartica'),
	('F02', NULL, 'Demencia en otras enfermedades clasificadas'),
	('F02.0', NULL, 'Demencia en la enfermedad de Pick'),
	('F02.1', NULL, 'Demencia en la enfermedad de Creutzfeldt-Jakob'),
	('F02.2', NULL, 'Demencia en la enfermedad de Huntington'),
	('F02.3', NULL, 'Demencia en la enfermedad de Parkinson'),
	('F02.4', NULL, 'Demencia en el VIH'),
	('F03', NULL, 'Demencia sin especificar'),
	('F04', NULL, 'Síndrome amnésico orgánico, no inducido por alcohol y otros psicotrópicos'),
	('F05', NULL, 'Delírium, no inducido por alcohol y otros psicotrópicos'),
	('F06', NULL, 'Otros trastornos mentales debidos a daños neuronales, disfunciones y enfermedades físicas'),
	('F07', NULL, 'Trastornos de personalidad y comportamiento debido a enfermedades neuronales, daños y disfunciones'),
	('F09', NULL, 'Trastornos mentales orgánicos o sintomáticos sin especificar =='),
	('F10', NULL, 'Trastornos mentales y de comportamiento debidos a la consumición de alcohol'),
	('F10-F', NULL, 'Trastornos mentales y de comportamiento debidos al consumo de psicotrópicos '),
	('F11', NULL, 'Trastornos mentales y de comportamiento debidos a la consumición de opioides'),
	('F12', NULL, 'Trastornos mentales y de comportamiento debidos a la consumición de cannabinoides'),
	('F13', NULL, 'Trastornos mentales y de comportamiento debidos a la consumición de sedantes o hipnóticos'),
	('F14', NULL, 'Trastornos mentales y de comportamiento debidos a la consumición de cocaina'),
	('F15', NULL, 'Trastornos mentales y de comportamiento debidos a la consumición de otros estimulantes, incluyendo la cafeína'),
	('F16', NULL, 'Trastornos mentales y de comportamiento debidos a la consumición de alucinógenos'),
	('F17', NULL, 'Trastornos mentales y de comportamiento debidos a la consumición de tabaco'),
	('F18', NULL, 'Trastornos mentales y de comportamiento debidos a la consumición de disolventes volátiles'),
	('F19', NULL, 'Trastornos mentales y de comportamiento debidos a la consumición de múltiples drogas y otros psicotrópicos'),
	('F1x.0', NULL, 'Intoxicación aguda'),
	('F1x.1', NULL, 'Uso perjudicial'),
	('F1x.2', NULL, 'Síndrome de dependencia'),
	('F1x.3', NULL, 'Síndrome de abstinencia'),
	('F1x.4', NULL, 'síndrome de abstinencia con delirium'),
	('F1x.5', NULL, 'Trastorno psicótico'),
	('F1x.6', NULL, 'Trastorno Amnésico'),
	('F1x.7', NULL, 'Trastorno psicótico'),
	('F1x.8', NULL, 'Otro trastorno mental do del comportamiento.'),
	('F1x.9', NULL, 'Trastorno mental o del comportamiento no especificado.'),
	('F20', NULL, 'Esquizofrenia'),
	('F20-2', NULL, 'Esquizofrenia, trastorno esquizotípico y trastornos de ideas delirantes'),
	('F20.0', NULL, 'Esquizofrenia paranoide'),
	('F20.1', NULL, 'Esquizofrenia hebefrénica'),
	('F20.2', NULL, 'Esquizofrenia catatónica'),
	('F20.3', NULL, 'Esquizofrenia no diferenciada'),
	('F20.4', NULL, 'Depresión post-esquizofrénica'),
	('F20.5', NULL, 'Esquizofrenia residual'),
	('F20.6', NULL, 'Esquizofrenia simple'),
	('F20.8', NULL, 'Otras esquizofrenias'),
	('F20.9', NULL, 'Esquizofrenia sin especificar'),
	('F21', NULL, 'Trastorno esquizotípico'),
	('F22', NULL, 'Trastorno de ideas delirantes persistentes'),
	('F22.0', NULL, 'Trastorno de ideas delirantes'),
	('F23', NULL, 'Trastornos psicóticos agudos y transitorios'),
	('F23.0', NULL, 'Trastorno psicótico polimórfico agudo sin síntomas de esquizofrenia'),
	('F23.1', NULL, 'Trastorno psicótico polimórfico agudo con síntomas de esquizofrenia'),
	('F23.2', NULL, 'Trastorno psicótico agudo estilo esquizofrenia'),
	('F23.3', NULL, 'Otros trastornos psicóticos agudos predominantemente delirantes'),
	('F23.8', NULL, 'Otros trastornos psicóticos agudos y transitorios'),
	('F23.9', NULL, 'Trastornos psicóticos agudo y transitorios sin especificar'),
	('F24', NULL, 'Trastorno de ideas delirantes inducidas'),
	('F25', NULL, 'Trastornos esquizoafectivos'),
	('F25.0', NULL, 'Trastorno esquizoafectivo, tipo maníaco'),
	('F25.1', NULL, 'Trastorno esquizoafectivo, tipo depresivo'),
	('F25.2', NULL, 'Trastorno esquizoafectivo, tipo mixto'),
	('F25.8', NULL, 'Otros trastornos esquizoafectivos'),
	('F25.9', NULL, 'Trastorno esquizoafectivo sin especificar'),
	('F28', NULL, 'Otros trastornos psicóticos no orgánicos'),
	('F29', NULL, 'Psicósis no orgánica sin especificar'),
	('F30', NULL, 'Episodio maníaco'),
	('F30-3', NULL, 'Trastornos del humor afectivos'),
	('F30.0', NULL, 'Hipomanía'),
	('F31', NULL, 'Trastorno bipolar afectivo'),
	('F32', NULL, 'Episodio depresivo'),
	('F33', NULL, 'Trastorno depresivo recurrente'),
	('F34', NULL, 'Trastornos afectivos persistentes'),
	('F34.0', NULL, 'Ciclotimia'),
	('F34.1', NULL, 'Distimia'),
	('F38', NULL, 'Otros trastornos afectivos'),
	('F39', NULL, 'Trastorno afectivo sin especificar'),
	('F40', NULL, 'Trastornos de ansiedad fóbicos'),
	('F40-4', NULL, 'Trastornos neuróticos, secundarios a situaciones estresantes y somatomorfos '),
	('F40.0', NULL, 'Agorafobia'),
	('F41', NULL, 'Otros trastornos de ansiedad'),
	('F41.0', NULL, 'Trastorno de pánico anisiedad episódica paroxismal'),
	('F41.1', NULL, 'Trastorno de ansiedad generalizada'),
	('F42', NULL, 'Trastorno obsesivo-compulsivo'),
	('F43', NULL, 'Reacción a stress severo y tastornos de adaptación'),
	('F43.0', NULL, 'Reacción al stress aguda'),
	('F43.1', NULL, 'Trastorno post-traumático del stress'),
	('F43.2', NULL, 'Trastorno de adaptación'),
	('F44', NULL, 'Trastorno de conversión disociativo'),
	('F44.0', NULL, 'Amnesia disociativa'),
	('F44.1', NULL, 'Fuga disociativa'),
	('F45', NULL, 'Trastorno somatomorfo'),
	('F45.0', NULL, 'Trastorno de somatización'),
	('F48', NULL, 'Otras neurosis'),
	('F48.0', NULL, 'Neurastenia'),
	('F50', NULL, 'Trastornos alimentarios'),
	('F50-5', NULL, 'Trastornos del comportamiento asociados a disfunciones fisiológicas y a factores somáticos '),
	('F50.0', NULL, 'Anorexia nerviosa'),
	('F50.2', NULL, 'Bulimia nerviosa'),
	('F50.3', NULL, 'Bulimia nerviosa atípica'),
	('F50.4', NULL, 'Hiperfagia asociada a otros trastornos psicológicos'),
	('F50.5', NULL, 'Vómitos asociados a otros trastornos psicológicos'),
	('F50.8', NULL, 'Otros trastornos de la conducta alimentaria'),
	('F50.9', NULL, 'Trastornos de la conducta alimentaria sin especificación'),
	('F51', NULL, 'Trastornos del sueño no-orgánicos'),
	('F51.0', NULL, 'Insomnio no-orgánico'),
	('F51.1', NULL, 'Hipersomnio no-orgánico'),
	('F51.2', NULL, 'Trastorno del reloj biológico no-orgánico'),
	('F51.3', NULL, 'Sonambulismo'),
	('F51.4', NULL, 'Terror nocturno'),
	('F51.5', NULL, 'Pesadillas'),
	('F52', NULL, 'Disfunción sexual, no causada por trastornos o enfermedades orgánicas'),
	('F52.4', NULL, 'Eyaculación precoz'),
	('F53', NULL, 'Trastornos mentales y de comportamiento asociados con el puerperio no clasificados'),
	('F53.0', NULL, 'Trastornos mentales suaves y de comportamiento asociados con el puerperio no clasificados'),
	('F53.1', NULL, 'Trastornos mentales severos y de comportamiento asociados con el puerperio no clasificados'),
	('F54', NULL, 'Factores psicológicos y de comportamiento aspciados con los desórdenes o enfermedades clasificados'),
	('F55', NULL, 'Abuso de sustancias que no producen dependencia'),
	('F59', NULL, 'Síndromes de comportamiento sin especificar asociados con perturbaciones psicológicas y factores físicos'),
	('F60', NULL, 'Trastorno de personalidad específico'),
	('F60-6', NULL, 'Trastornos de la personalidad y del comportamiento del adulto '),
	('F60.0', NULL, 'Trastorno paranoide de la personalidad'),
	('F60.1', NULL, 'Trastorno esquizoide de la personalidad'),
	('F60.2', NULL, 'Trastorno disocial de la personalidad'),
	('F60.3', NULL, 'Trastorno de inestabilidad emocional de la personalidad'),
	('F60.4', NULL, 'Trastorno histriónico de la personalidad'),
	('F60.5', NULL, 'Trastorno anancástico de la personalidad'),
	('F60.6', NULL, 'Trastorno ansioso o por evitación de la personalidad'),
	('F60.7', NULL, 'Trastorno dependiente de la personalidad'),
	('F60.8', NULL, 'Otros trastornos de personalidad específicos'),
	('F60.9', NULL, 'Trastorno de personalidad, sin especificar'),
	('F61', NULL, 'Trastornos de personalidad mixtos y otros'),
	('F62', NULL, 'Cambios de personalidad duraderos, no atribuibles a enfermedades o daños cerebrales'),
	('F63', NULL, 'Trastornos impulsivos y de hábito'),
	('F63.0', NULL, 'Ludopatía patológica'),
	('F63.1', NULL, 'Piromanía patológica'),
	('F63.2', NULL, 'Cleptomanía patológica'),
	('F63.3', NULL, 'Tricotilomanía'),
	('F64', NULL, 'Trastornos de la identidad de género'),
	('F64.0', NULL, 'Transexualidad'),
	('F64.1', NULL, 'Travestismo'),
	('F64.2', NULL, 'Trastorno de identidad de género de la infancia'),
	('F65', NULL, 'Trastornos de orientación sexual'),
	('F65.0', NULL, 'Fetichismo'),
	('F65.1', NULL, 'Fetichismo travestista'),
	('F65.2', NULL, 'Exhibicionismo'),
	('F65.3', NULL, 'Voyeurismo'),
	('F65.4', NULL, 'Pedofilia'),
	('F65.5', NULL, 'Sadomasoquismo'),
	('F65.6', NULL, 'Múltiples trastornos de preferencia sexual'),
	('F65.8', NULL, 'Otros trastornos de preferencia sexual'),
	('F66', NULL, 'Trastornos psicológicos y de comportamiento asociados con el desarrollo y la orientación sexual'),
	('F66.0', NULL, 'Trastorno de maduración sexual'),
	('F66.1', NULL, 'Orientación sexual ego-distónica'),
	('F66.2', NULL, 'Trastorno relacional sexual'),
	('F66.8', NULL, 'Otros trastornos de la pulsión'),
	('F66.9', NULL, 'Trastornos de la pulsión, sin especificar'),
	('F68', NULL, 'Otros trastornos de la personalidad y el comportamiento en adultos'),
	('F68.0', NULL, 'Elaboración de síntomas físicos por razones psicológicas'),
	('F68.1', NULL, 'Producción intencionada o ficción de síntomas o incapacidades, físicas o psicológicas'),
	('F68.8', NULL, 'Otros trastornos específicos de personalidad o comportamiento en adultos'),
	('F69', NULL, 'Trastornos de la personalidad y el comportamiento en adultos sin especificar'),
	('F70', NULL, 'Retraso mental leve'),
	('F70-7', NULL, 'Retraso mental'),
	('F71', NULL, 'Retraso mental moderado'),
	('F72', NULL, 'Retraso mental severo'),
	('F73', NULL, 'Retraso mental profundo'),
	('F78', NULL, 'Otros retrasos mentales'),
	('F79', NULL, 'Retrasos mentales sin especificar'),
	('F80', NULL, 'Trastornos específicos del lenguaje y del habla'),
	('F80-8', NULL, 'Trastornos del desarrollo psicológico'),
	('F80.0', NULL, 'Trastorno específico de la articulación del habla'),
	('F80.1', NULL, 'Trastorno expresivo del lenguaje'),
	('F80.2', NULL, 'Trastorno receptivo del lenguaje'),
	('F80.3', NULL, 'Afasia adquirida con epilepsia Landau-Kleffner'),
	('F80.8', NULL, 'Otros trastornos del desarrollo del lenguaje y el habla'),
	('F80.9', NULL, 'Trastronos del desarrollo del lenguaje y el habla sin especificar'),
	('F81', NULL, 'Trastornos de desarrollo específicos de habilidades académicas'),
	('F81.0', NULL, 'Trastorno específico de la lectura'),
	('F81.1', NULL, 'Agrafía'),
	('F81.2', NULL, 'Trastornos específicos de habilidades aritméticas'),
	('F81.3', NULL, 'Trastornos mixtos de habilidades escolares'),
	('F81.8', NULL, 'Otros desórdenes del desarrollo de habilidades escolares'),
	('F81.9', NULL, 'Trastorno de desarrollo de habilidades escolares sin especificar'),
	('F82', NULL, 'Trastornos de desarrollo específicos de funciones motoras'),
	('F83', NULL, 'Trastornos de desarrollo específicos mixtos'),
	('F84', NULL, 'Trastorno generalizado del desarrollo'),
	('F84.0', NULL, 'Autismo'),
	('F84.2', NULL, 'Síndrome de Rett'),
	('F84.4', NULL, 'Trastorno asociado a hiperactividad con retraso mental y movimientos estereotipados'),
	('F84.5', NULL, 'Síndrome de Asperger'),
	('F88', NULL, 'Otros trastornos del desarrollo psicológico'),
	('F89', NULL, 'Trastornos del desarrollo psicológico sin especificar'),
	('F90', NULL, 'Trastornos hiperquinéticos'),
	('F90-F', NULL, 'Trastornos del comportamiento y de las emociones de comienzo habitual en la infancia y adolescencia'),
	('F90.0', NULL, 'Trastorno de la actividad y la atención'),
	('F90.1', NULL, 'Trastorno hiperquinético de la conducta'),
	('F91', NULL, 'Trastornos de conducta'),
	('F91.0', NULL, 'Trastorno de conducta confinado al entorno familiar'),
	('F91.1', NULL, 'Trastorno de conducta dessocializado'),
	('F91.2', NULL, 'Trastorno de conducta socializado'),
	('F91.3', NULL, 'Trastorno NEGATIVISTA desafiante'),
	('F92', NULL, 'Trastornos mixtos de conducta y emociones'),
	('F92.0', NULL, 'Trastornos de conducta depresivos'),
	('F93', NULL, 'Trastornos emocionales específicos en el comienzo de la niñez'),
	('F93.0', NULL, 'Trastorno de ansiedad por separación de la niñez'),
	('F93.1', NULL, 'Trastorno de ansiedad fóbica de la niñez'),
	('F93.2', NULL, 'Trastorno de ansiedad social de la niñez'),
	('F93.3', NULL, 'Trastorno de rivalidad fraternal'),
	('F94', NULL, 'Trastornos de funciones soclaies esfpecíficos del comienzo de la niñez y la adolescencia'),
	('F94.0', NULL, 'Mutismo selectivo'),
	('F94.1', NULL, 'Trastorno del vinculo reactivo de la niñez'),
	('F94.2', NULL, 'Trastorno del vinculo deshinibido de la niñez'),
	('F95', NULL, 'Tics'),
	('F95.0', NULL, 'Tic transitorio'),
	('F95.1', NULL, 'Tic crónico motor o vocal'),
	('F95.2', NULL, 'Tic combinado vocal y múltiple motor de la Tourette'),
	('F98', NULL, 'Otros trastornos emocionales y de comportamiento iniciados normalmente en la niñez y en la adolescencia'),
	('F98.0', NULL, 'Enuresis nocturna'),
	('F98.1', NULL, 'Encopresis'),
	('F98.2', NULL, 'Trastorno de la alimentación de la infancia y la niñez'),
	('F98.3', NULL, 'Pica de la infancia y la niñez'),
	('F98.4', NULL, 'Trastornos del movimiento estereotipados'),
	('F98.5', NULL, 'Tartamudez'),
	('F98.6', NULL, 'Desorden lingüitico'),
	('F99', NULL, 'Trastornos mentales sin especificar'),
	('F99.0', NULL, 'Trastorno mental no especificado en otra parte');
/*!40000 ALTER TABLE `diagnostico` ENABLE KEYS */;

-- Volcando estructura para tabla hc.estadocivil
DROP TABLE IF EXISTS `estadocivil`;
CREATE TABLE IF NOT EXISTS `estadocivil` (
  `idEstadoCivil` varchar(5) NOT NULL,
  `estadoCivil` varchar(200) NOT NULL,
  PRIMARY KEY (`idEstadoCivil`),
  UNIQUE KEY `estadoCivil` (`estadoCivil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hc.estadocivil: ~5 rows (aproximadamente)
DELETE FROM `estadocivil`;
/*!40000 ALTER TABLE `estadocivil` DISABLE KEYS */;
INSERT INTO `estadocivil` (`idEstadoCivil`, `estadoCivil`) VALUES
	('c', 'casado'),
	('d', 'divorciado'),
	('s', 'soltero'),
	('u', 'unión libre'),
	('v', 'viudo');
/*!40000 ALTER TABLE `estadocivil` ENABLE KEYS */;

-- Volcando estructura para tabla hc.genero
DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `idGenero` varchar(5) NOT NULL,
  `generoDescripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`idGenero`),
  UNIQUE KEY `generoDescripcion` (`generoDescripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hc.genero: ~3 rows (aproximadamente)
DELETE FROM `genero`;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` (`idGenero`, `generoDescripcion`) VALUES
	('f', 'femenino'),
	('m', 'masculino'),
	('n', 'neutro');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;

-- Volcando estructura para tabla hc.grupoedad
DROP TABLE IF EXISTS `grupoedad`;
CREATE TABLE IF NOT EXISTS `grupoedad` (
  `idEdad` varchar(5) NOT NULL,
  `edad` varchar(15) NOT NULL,
  PRIMARY KEY (`idEdad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hc.grupoedad: ~4 rows (aproximadamente)
DELETE FROM `grupoedad`;
/*!40000 ALTER TABLE `grupoedad` DISABLE KEYS */;
INSERT INTO `grupoedad` (`idEdad`, `edad`) VALUES
	('1', '0-14'),
	('2', '15-23'),
	('3', '24-65'),
	('4', '66-…');
/*!40000 ALTER TABLE `grupoedad` ENABLE KEYS */;

-- Volcando estructura para tabla hc.instruccion
DROP TABLE IF EXISTS `instruccion`;
CREATE TABLE IF NOT EXISTS `instruccion` (
  `idInstruccion` varchar(5) NOT NULL,
  `instruccDescripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`idInstruccion`),
  UNIQUE KEY `instruccDescripcion` (`instruccDescripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hc.instruccion: ~9 rows (aproximadamente)
DELETE FROM `instruccion`;
/*!40000 ALTER TABLE `instruccion` DISABLE KEYS */;
INSERT INTO `instruccion` (`idInstruccion`, `instruccDescripcion`) VALUES
	('a', 'analfabeto'),
	('f', 'bachillerato técnico'),
	('i', 'masterado'),
	('c', 'primaria completa'),
	('b', 'primaria incompleta'),
	('e', 'secundaria completa'),
	('d', 'secundaria incompleta'),
	('h', 'universitaria completa'),
	('g', 'universitaria incompleta');
/*!40000 ALTER TABLE `instruccion` ENABLE KEYS */;

-- Volcando estructura para tabla hc.paciente
DROP TABLE IF EXISTS `paciente`;
CREATE TABLE IF NOT EXISTS `paciente` (
  `idPaciente` int(11) NOT NULL DEFAULT 0,
  `pacienteFecha` date DEFAULT NULL,
  `pacienteNombre` varchar(200) NOT NULL,
  `pacienteApellido` varchar(200) NOT NULL,
  `pacienteNacimiento` date DEFAULT NULL,
  `idEdad` varchar(5) DEFAULT NULL,
  `pacienteEstadoCivil` varchar(5) DEFAULT NULL,
  `idInstruccion` varchar(5) DEFAULT NULL,
  `pacienteOcupacion` varchar(200) DEFAULT NULL,
  `idResidencia` varchar(5) DEFAULT NULL,
  `pacienteResidencia` varchar(245) DEFAULT NULL,
  `idCiudad` varchar(5) DEFAULT NULL,
  `idClaseSocial` varchar(5) DEFAULT NULL,
  `pacienteTelefono` varchar(200) DEFAULT NULL,
  `pacienteEmail` varchar(100) DEFAULT NULL,
  `pacienteObservacion` blob DEFAULT NULL,
  `pacienteAPP` blob DEFAULT NULL,
  `pacienteAPF` blob DEFAULT NULL,
  `pacienteEnfermedadAct` blob DEFAULT NULL,
  `pacienteMC` blob DEFAULT NULL,
  `pacienteDiagnostico` blob DEFAULT NULL,
  `idGenero` varchar(5) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPaciente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hc.paciente: ~0 rows (aproximadamente)
DELETE FROM `paciente`;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;

-- Volcando estructura para tabla hc.residencia
DROP TABLE IF EXISTS `residencia`;
CREATE TABLE IF NOT EXISTS `residencia` (
  `idResidencia` varchar(5) NOT NULL,
  `residenciaDescripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`idResidencia`),
  UNIQUE KEY `residenciaDescripcion` (`residenciaDescripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hc.residencia: ~2 rows (aproximadamente)
DELETE FROM `residencia`;
/*!40000 ALTER TABLE `residencia` DISABLE KEYS */;
INSERT INTO `residencia` (`idResidencia`, `residenciaDescripcion`) VALUES
	('02', 'Rural'),
	('01', 'Urbana');
/*!40000 ALTER TABLE `residencia` ENABLE KEYS */;

-- Volcando estructura para tabla hc.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuarioNombre` varchar(150) NOT NULL,
  `usuarioUser` varchar(15) DEFAULT NULL,
  `usuarioPass` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `usuarioNombre` (`usuarioNombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hc.usuario: ~2 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idUsuario`, `usuarioNombre`, `usuarioUser`, `usuarioPass`) VALUES
	(1, 'Administrador', 'admin', 'nimda'),
	(2, 'Usuario', 'usuario', 'hyper2830');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
