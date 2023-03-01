-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-09-2012 a las 07:41:20
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasesocial`
--

CREATE TABLE IF NOT EXISTS `clasesocial` (
  `idClaseSocial` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `claseSocial` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idClaseSocial`),
  UNIQUE KEY `claseSocial` (`claseSocial`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos`
--

CREATE TABLE IF NOT EXISTS `codigos` (
  `idCodigos` int(11) NOT NULL AUTO_INCREMENT,
  `codigoGrupo` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `codigoIdentificador` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `codigoDescripcion` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `codigoValor1` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `codigoValor2` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `codigoValor3` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  PRIMARY KEY (`idCodigos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcion`
--

CREATE TABLE IF NOT EXISTS `descripcion` (
  `idDescripcion` int(11) NOT NULL AUTO_INCREMENT,
  `idPaciente` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `descripcionFecha` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `descripcionEvolucion` longtext COLLATE latin1_general_ci,
  `descripcionTratamiento` longtext COLLATE latin1_general_ci,
  `descripcionEstudios` longtext COLLATE latin1_general_ci,
  PRIMARY KEY (`idDescripcion`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3439 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE IF NOT EXISTS `diagnostico` (
  `idDiagnostico` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `diagnosticoCategoria` int(11) DEFAULT NULL,
  `diagnosticoDescripcion` varchar(245) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idDiagnostico`),
  KEY `diagnosticoCategoria` (`diagnosticoCategoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticocat`
--

CREATE TABLE IF NOT EXISTS `diagnosticocat` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categTitulo` varchar(250) DEFAULT NULL,
  `categCodigos` varchar(50) DEFAULT NULL,
  `categCapitulo` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocivil`
--

CREATE TABLE IF NOT EXISTS `estadocivil` (
  `idEstadoCivil` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `estadoCivil` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idEstadoCivil`),
  UNIQUE KEY `estadoCivil` (`estadoCivil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE IF NOT EXISTS `genero` (
  `idGenero` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `generoDescripcion` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idGenero`),
  UNIQUE KEY `generoDescripcion` (`generoDescripcion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoedad`
--

CREATE TABLE IF NOT EXISTS `grupoedad` (
  `idEdad` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `edad` varchar(15) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idEdad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Grupos de Edad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instruccion`
--

CREATE TABLE IF NOT EXISTS `instruccion` (
  `idInstruccion` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `instruccDescripcion` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idInstruccion`),
  UNIQUE KEY `instruccDescripcion` (`instruccDescripcion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Nivel de Instrucci�n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE IF NOT EXISTS `nivel` (
  `idNivel` int(11) NOT NULL AUTO_INCREMENT,
  `nivelNombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idNivel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='nivel de usuario' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `idPaciente` int(11) NOT NULL AUTO_INCREMENT,
  `pacienteFecha` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pacienteNombre` varchar(25) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pacienteApellido` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pacienteNacimiento` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `idEdad` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pacienteEstadoCivil` char(2) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `idInstruccion` char(2) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pacienteOcupacion` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `idResidencia` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pacienteResidencia` longtext COLLATE latin1_general_ci,
  `idCiudad` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `idClaseSocial` int(11) NOT NULL DEFAULT '0',
  `pacienteTelefono` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `pacienteEmail` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `pacienteObservacion` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `pacienteAPP` longtext COLLATE latin1_general_ci,
  `pacienteAPF` longtext COLLATE latin1_general_ci,
  `pacienteEnfermedadAct` longtext COLLATE latin1_general_ci,
  `pacienteMC` longtext COLLATE latin1_general_ci,
  `pacienteDiagnostico` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `idGenero` char(2) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `idUsuario` int(11) DEFAULT '1',
  `pacienteResidenciaCiudad` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `pacienteEdad` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pacienteEstado` int(5) DEFAULT '1',
  `pacienteActualizado` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `pacienteMTratante` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `pacienteMEnviante` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `pacienteSeguro` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `pacienteNSeguro` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `pacienteCedula` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`idPaciente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1165 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `pedidoFecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pedidoTipo` int(11) DEFAULT NULL,
  `idPaciente` int(11) NOT NULL,
  `pedidoMed` text,
  `pedidoInd` text,
  `pedidoCampo1` text,
  `pedidoCampo2` text,
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residencia`
--

CREATE TABLE IF NOT EXISTS `residencia` (
  `idResidencia` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `residenciaDescripcion` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idResidencia`),
  UNIQUE KEY `residenciaDescripcion` (`residenciaDescripcion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Residencia Urbana o Rural';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuarioNombre` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `usuarioApellido` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `usuarioUser` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `usuarioPass` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `usuarioDireccion` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `usuarioCiudad` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `usuarioDireccion2` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `usuarioTelefono` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `usuarioTelefono2` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `usuarioCelular` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `usuarioID` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `usuarioCorreo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `usuarioCorreo2` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `usuarioTitulo` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `usuarioNota` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `usuarioImagen` longblob COMMENT 'Logo o imagen médico',
  PRIMARY KEY (`idUsuario`),
  KEY `usuarioNombre` (`usuarioNombre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarionivel`
--

CREATE TABLE IF NOT EXISTS `usuarionivel` (
  `idUN` int(11) NOT NULL AUTO_INCREMENT,
  `idNivel` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idUN`,`idNivel`,`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
