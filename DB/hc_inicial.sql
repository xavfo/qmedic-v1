# Dump for Database hc



CREATE DATABASE hc;

USE hc;



# Dumping Table clasesocial

#

CREATE TABLE clasesocial (

	idClaseSocial varchar(5) NOT NULL  , 

	claseSocial varchar(200) NOT NULL   ,

	PRIMARY KEY (idClaseSocial),

	UNIQUE KEY claseSocial (claseSocial)	
) TYPE=MyISAM;



# Dumping Data - 6 rows



INSERT INTO clasesocial VALUES("0","No Determinada");

INSERT INTO clasesocial VALUES("1","Alta");

INSERT INTO clasesocial VALUES("2","Media Alta");

INSERT INTO clasesocial VALUES("3","Media");

INSERT INTO clasesocial VALUES("4","Baja");

INSERT INTO clasesocial VALUES("5","Desocupada");



# Dumping Table descripcion

#

CREATE TABLE descripcion (

	idDescripcion int(11) NOT NULL  auto_increment, 

	idPaciente int(11) NOT NULL  DEFAULT '0' , 

	descripcionFecha date   , 

	descripcionEvolucion blob   , 

	descripcionTratamiento blob    ,

	PRIMARY KEY (idDescripcion),

	KEY idPaciente (idPaciente)	
) TYPE=MyISAM;



# Dumping Data - 0 rows





# Dumping Table diagnostico

#

CREATE TABLE diagnostico (

	idDiagnostico varchar(5) NOT NULL  , 

	diagnosticoCategoria varchar(200)   , 

	diagnosticoDescripcion varchar(245) NOT NULL   ,

	PRIMARY KEY (idDiagnostico),

	KEY diagnosticoCategoria (diagnosticoCategoria)	
) TYPE=MyISAM;



# Dumping Data - 228 rows


#
# Dumping data for table diagnostico
#

INSERT INTO `diagnostico` VALUES ('F00',NULL,'Demencia en la enfermedad de Alzheimer');
INSERT INTO `diagnostico` VALUES ('F00-F09',NULL,'Trastornos mentales org�nicos, incluidos los sintom�ticos ');
INSERT INTO `diagnostico` VALUES ('F01',NULL,'Demencia vascular');
INSERT INTO `diagnostico` VALUES ('F01.1',NULL,'Demencia multi-infartica');
INSERT INTO `diagnostico` VALUES ('F02',NULL,'Demencia en otras enfermedades clasificadas');
INSERT INTO `diagnostico` VALUES ('F02.0',NULL,'Demencia en la enfermedad de Pick');
INSERT INTO `diagnostico` VALUES ('F02.1',NULL,'Demencia en la enfermedad de Creutzfeldt-Jakob');
INSERT INTO `diagnostico` VALUES ('F02.2',NULL,'Demencia en la enfermedad de Huntington');
INSERT INTO `diagnostico` VALUES ('F02.3',NULL,'Demencia en la enfermedad de Parkinson');
INSERT INTO `diagnostico` VALUES ('F02.4',NULL,'Demencia en el VIH');
INSERT INTO `diagnostico` VALUES ('F03',NULL,'Demencia sin especificar');
INSERT INTO `diagnostico` VALUES ('F04',NULL,'S�ndrome amn�sico org�nico, no inducido por alcohol y otros psicotr�picos');
INSERT INTO `diagnostico` VALUES ('F05',NULL,'Del�rium, no inducido por alcohol y otros psicotr�picos');
INSERT INTO `diagnostico` VALUES ('F06',NULL,'Otros trastornos mentales debidos a da�os neuronales, disfunciones y enfermedades f�sicas');
INSERT INTO `diagnostico` VALUES ('F07',NULL,'Trastornos de personalidad y comportamiento debido a enfermedades neuronales, da�os y disfunciones');
INSERT INTO `diagnostico` VALUES ('F09',NULL,'Trastornos mentales org�nicos o sintom�ticos sin especificar ==');
INSERT INTO `diagnostico` VALUES ('F10',NULL,'Trastornos mentales y de comportamiento debidos a la consumici�n de alcohol');
INSERT INTO `diagnostico` VALUES ('F10-F19',NULL,'Trastornos mentales y de comportamiento debidos al consumo de psicotr�picos ');
INSERT INTO `diagnostico` VALUES ('F11',NULL,'Trastornos mentales y de comportamiento debidos a la consumici�n de opioides');
INSERT INTO `diagnostico` VALUES ('F12',NULL,'Trastornos mentales y de comportamiento debidos a la consumici�n de cannabinoides');
INSERT INTO `diagnostico` VALUES ('F13',NULL,'Trastornos mentales y de comportamiento debidos a la consumici�n de sedantes o hipn�ticos');
INSERT INTO `diagnostico` VALUES ('F14',NULL,'Trastornos mentales y de comportamiento debidos a la consumici�n de cocaina');
INSERT INTO `diagnostico` VALUES ('F15',NULL,'Trastornos mentales y de comportamiento debidos a la consumici�n de otros estimulantes, incluyendo la cafe�na');
INSERT INTO `diagnostico` VALUES ('F16',NULL,'Trastornos mentales y de comportamiento debidos a la consumici�n de alucin�genos');
INSERT INTO `diagnostico` VALUES ('F17',NULL,'Trastornos mentales y de comportamiento debidos a la consumici�n de tabaco');
INSERT INTO `diagnostico` VALUES ('F18',NULL,'Trastornos mentales y de comportamiento debidos a la consumici�n de disolventes vol�tiles');
INSERT INTO `diagnostico` VALUES ('F19',NULL,'Trastornos mentales y de comportamiento debidos a la consumici�n de m�ltiples drogas y otros psicotr�picos');
INSERT INTO `diagnostico` VALUES ('F1x.0',NULL,'Intoxicaci�n aguda');
INSERT INTO `diagnostico` VALUES ('F1x.1',NULL,'Uso perjudicial');
INSERT INTO `diagnostico` VALUES ('F1x.2',NULL,'S�ndrome de dependencia');
INSERT INTO `diagnostico` VALUES ('F1x.3',NULL,'S�ndrome de abstinencia');
INSERT INTO `diagnostico` VALUES ('F1x.4',NULL,'s�ndrome de abstinencia con delirium');
INSERT INTO `diagnostico` VALUES ('F1x.5',NULL,'Trastorno psic�tico');
INSERT INTO `diagnostico` VALUES ('F1x.6',NULL,'Trastorno Amn�sico');
INSERT INTO `diagnostico` VALUES ('F1x.7',NULL,'Trastorno psic�tico');
INSERT INTO `diagnostico` VALUES ('F1x.8',NULL,'Otro trastorno mental do del comportamiento.');
INSERT INTO `diagnostico` VALUES ('F1x.9',NULL,'Trastorno mental o del comportamiento no especificado.');
INSERT INTO `diagnostico` VALUES ('F20',NULL,'Esquizofrenia');
INSERT INTO `diagnostico` VALUES ('F20-29',NULL,'Esquizofrenia, trastorno esquizot�pico y trastornos de ideas delirantes');
INSERT INTO `diagnostico` VALUES ('F20.0',NULL,'Esquizofrenia paranoide');
INSERT INTO `diagnostico` VALUES ('F20.1',NULL,'Esquizofrenia hebefr�nica');
INSERT INTO `diagnostico` VALUES ('F20.2',NULL,'Esquizofrenia catat�nica');
INSERT INTO `diagnostico` VALUES ('F20.3',NULL,'Esquizofrenia no diferenciada');
INSERT INTO `diagnostico` VALUES ('F20.4',NULL,'Depresi�n post-esquizofr�nica');
INSERT INTO `diagnostico` VALUES ('F20.5',NULL,'Esquizofrenia residual');
INSERT INTO `diagnostico` VALUES ('F20.6',NULL,'Esquizofrenia simple');
INSERT INTO `diagnostico` VALUES ('F20.8',NULL,'Otras esquizofrenias');
INSERT INTO `diagnostico` VALUES ('F20.9',NULL,'Esquizofrenia sin especificar');
INSERT INTO `diagnostico` VALUES ('F21',NULL,'Trastorno esquizot�pico');
INSERT INTO `diagnostico` VALUES ('F22',NULL,'Trastorno de ideas delirantes persistentes');
INSERT INTO `diagnostico` VALUES ('F22.0',NULL,'Trastorno de ideas delirantes');
INSERT INTO `diagnostico` VALUES ('F23',NULL,'Trastornos psic�ticos agudos y transitorios');
INSERT INTO `diagnostico` VALUES ('F23.0',NULL,'Trastorno psic�tico polim�rfico agudo sin s�ntomas de esquizofrenia');
INSERT INTO `diagnostico` VALUES ('F23.1',NULL,'Trastorno psic�tico polim�rfico agudo con s�ntomas de esquizofrenia');
INSERT INTO `diagnostico` VALUES ('F23.2',NULL,'Trastorno psic�tico agudo estilo esquizofrenia');
INSERT INTO `diagnostico` VALUES ('F23.3',NULL,'Otros trastornos psic�ticos agudos predominantemente delirantes');
INSERT INTO `diagnostico` VALUES ('F23.8',NULL,'Otros trastornos psic�ticos agudos y transitorios');
INSERT INTO `diagnostico` VALUES ('F23.9',NULL,'Trastornos psic�ticos agudo y transitorios sin especificar');
INSERT INTO `diagnostico` VALUES ('F24',NULL,'Trastorno de ideas delirantes inducidas');
INSERT INTO `diagnostico` VALUES ('F25',NULL,'Trastornos esquizoafectivos');
INSERT INTO `diagnostico` VALUES ('F25.0',NULL,'Trastorno esquizoafectivo, tipo man�aco');
INSERT INTO `diagnostico` VALUES ('F25.1',NULL,'Trastorno esquizoafectivo, tipo depresivo');
INSERT INTO `diagnostico` VALUES ('F25.2',NULL,'Trastorno esquizoafectivo, tipo mixto');
INSERT INTO `diagnostico` VALUES ('F25.8',NULL,'Otros trastornos esquizoafectivos');
INSERT INTO `diagnostico` VALUES ('F25.9',NULL,'Trastorno esquizoafectivo sin especificar');
INSERT INTO `diagnostico` VALUES ('F28',NULL,'Otros trastornos psic�ticos no org�nicos');
INSERT INTO `diagnostico` VALUES ('F29',NULL,'Psic�sis no org�nica sin especificar');
INSERT INTO `diagnostico` VALUES ('F30',NULL,'Episodio man�aco');
INSERT INTO `diagnostico` VALUES ('F30-39',NULL,'Trastornos del humor afectivos');
INSERT INTO `diagnostico` VALUES ('F30.0',NULL,'Hipoman�a');
INSERT INTO `diagnostico` VALUES ('F31',NULL,'Trastorno bipolar afectivo');
INSERT INTO `diagnostico` VALUES ('F32',NULL,'Episodio depresivo');
INSERT INTO `diagnostico` VALUES ('F33',NULL,'Trastorno depresivo recurrente');
INSERT INTO `diagnostico` VALUES ('F34',NULL,'Trastornos afectivos persistentes');
INSERT INTO `diagnostico` VALUES ('F34.0',NULL,'Ciclotimia');
INSERT INTO `diagnostico` VALUES ('F34.1',NULL,'Distimia');
INSERT INTO `diagnostico` VALUES ('F38',NULL,'Otros trastornos afectivos');
INSERT INTO `diagnostico` VALUES ('F39',NULL,'Trastorno afectivo sin especificar');
INSERT INTO `diagnostico` VALUES ('F40',NULL,'Trastornos de ansiedad f�bicos');
INSERT INTO `diagnostico` VALUES ('F40-49',NULL,'Trastornos neur�ticos, secundarios a situaciones estresantes y somatomorfos ');
INSERT INTO `diagnostico` VALUES ('F40.0',NULL,'Agorafobia');
INSERT INTO `diagnostico` VALUES ('F41',NULL,'Otros trastornos de ansiedad');
INSERT INTO `diagnostico` VALUES ('F41.0',NULL,'Trastorno de p�nico anisiedad epis�dica paroxismal');
INSERT INTO `diagnostico` VALUES ('F41.1',NULL,'Trastorno de ansiedad generalizada');
INSERT INTO `diagnostico` VALUES ('F42',NULL,'Trastorno obsesivo-compulsivo');
INSERT INTO `diagnostico` VALUES ('F43',NULL,'Reacci�n a stress severo y tastornos de adaptaci�n');
INSERT INTO `diagnostico` VALUES ('F43.0',NULL,'Reacci�n al stress aguda');
INSERT INTO `diagnostico` VALUES ('F43.1',NULL,'Trastorno post-traum�tico del stress');
INSERT INTO `diagnostico` VALUES ('F43.2',NULL,'Trastorno de adaptaci�n');
INSERT INTO `diagnostico` VALUES ('F44',NULL,'Trastorno de conversi�n disociativo');
INSERT INTO `diagnostico` VALUES ('F44.0',NULL,'Amnesia disociativa');
INSERT INTO `diagnostico` VALUES ('F44.1',NULL,'Fuga disociativa');
INSERT INTO `diagnostico` VALUES ('F45',NULL,'Trastorno somatomorfo');
INSERT INTO `diagnostico` VALUES ('F45.0',NULL,'Trastorno de somatizaci�n');
INSERT INTO `diagnostico` VALUES ('F48',NULL,'Otras neurosis');
INSERT INTO `diagnostico` VALUES ('F48.0',NULL,'Neurastenia');
INSERT INTO `diagnostico` VALUES ('F50',NULL,'Trastornos alimentarios');
INSERT INTO `diagnostico` VALUES ('F50-59',NULL,'Trastornos del comportamiento asociados a disfunciones fisiol�gicas y a factores som�ticos ');
INSERT INTO `diagnostico` VALUES ('F50.0',NULL,'Anorexia nerviosa');
INSERT INTO `diagnostico` VALUES ('F50.2',NULL,'Bulimia nerviosa');
INSERT INTO `diagnostico` VALUES ('F50.3',NULL,'Bulimia nerviosa at�pica');
INSERT INTO `diagnostico` VALUES ('F50.4',NULL,'Hiperfagia asociada a otros trastornos psicol�gicos');
INSERT INTO `diagnostico` VALUES ('F50.5',NULL,'V�mitos asociados a otros trastornos psicol�gicos');
INSERT INTO `diagnostico` VALUES ('F50.8',NULL,'Otros trastornos de la conducta alimentaria');
INSERT INTO `diagnostico` VALUES ('F50.9',NULL,'Trastornos de la conducta alimentaria sin especificaci�n');
INSERT INTO `diagnostico` VALUES ('F51',NULL,'Trastornos del sue�o no-org�nicos');
INSERT INTO `diagnostico` VALUES ('F51.0',NULL,'Insomnio no-org�nico');
INSERT INTO `diagnostico` VALUES ('F51.1',NULL,'Hipersomnio no-org�nico');
INSERT INTO `diagnostico` VALUES ('F51.2',NULL,'Trastorno del reloj biol�gico no-org�nico');
INSERT INTO `diagnostico` VALUES ('F51.3',NULL,'Sonambulismo');
INSERT INTO `diagnostico` VALUES ('F51.4',NULL,'Terror nocturno');
INSERT INTO `diagnostico` VALUES ('F51.5',NULL,'Pesadillas');
INSERT INTO `diagnostico` VALUES ('F52',NULL,'Disfunci�n sexual, no causada por trastornos o enfermedades org�nicas');
INSERT INTO `diagnostico` VALUES ('F52.4',NULL,'Eyaculaci�n precoz');
INSERT INTO `diagnostico` VALUES ('F53',NULL,'Trastornos mentales y de comportamiento asociados con el puerperio no clasificados');
INSERT INTO `diagnostico` VALUES ('F53.0',NULL,'Trastornos mentales suaves y de comportamiento asociados con el puerperio no clasificados');
INSERT INTO `diagnostico` VALUES ('F53.1',NULL,'Trastornos mentales severos y de comportamiento asociados con el puerperio no clasificados');
INSERT INTO `diagnostico` VALUES ('F54',NULL,'Factores psicol�gicos y de comportamiento aspciados con los des�rdenes o enfermedades clasificados');
INSERT INTO `diagnostico` VALUES ('F55',NULL,'Abuso de sustancias que no producen dependencia');
INSERT INTO `diagnostico` VALUES ('F59',NULL,'S�ndromes de comportamiento sin especificar asociados con perturbaciones psicol�gicas y factores f�sicos');
INSERT INTO `diagnostico` VALUES ('F60',NULL,'Trastorno de personalidad espec�fico');
INSERT INTO `diagnostico` VALUES ('F60-69',NULL,'Trastornos de la personalidad y del comportamiento del adulto ');
INSERT INTO `diagnostico` VALUES ('F60.0',NULL,'Trastorno paranoide de la personalidad');
INSERT INTO `diagnostico` VALUES ('F60.1',NULL,'Trastorno esquizoide de la personalidad');
INSERT INTO `diagnostico` VALUES ('F60.2',NULL,'Trastorno disocial de la personalidad');
INSERT INTO `diagnostico` VALUES ('F60.3',NULL,'Trastorno de inestabilidad emocional de la personalidad');
INSERT INTO `diagnostico` VALUES ('F60.4',NULL,'Trastorno histri�nico de la personalidad');
INSERT INTO `diagnostico` VALUES ('F60.5',NULL,'Trastorno ananc�stico de la personalidad');
INSERT INTO `diagnostico` VALUES ('F60.6',NULL,'Trastorno ansioso o por evitaci�n de la personalidad');
INSERT INTO `diagnostico` VALUES ('F60.7',NULL,'Trastorno dependiente de la personalidad');
INSERT INTO `diagnostico` VALUES ('F60.8',NULL,'Otros trastornos de personalidad espec�ficos');
INSERT INTO `diagnostico` VALUES ('F60.9',NULL,'Trastorno de personalidad, sin especificar');
INSERT INTO `diagnostico` VALUES ('F61',NULL,'Trastornos de personalidad mixtos y otros');
INSERT INTO `diagnostico` VALUES ('F62',NULL,'Cambios de personalidad duraderos, no atribuibles a enfermedades o da�os cerebrales');
INSERT INTO `diagnostico` VALUES ('F63',NULL,'Trastornos impulsivos y de h�bito');
INSERT INTO `diagnostico` VALUES ('F63.0',NULL,'Ludopat�a patol�gica');
INSERT INTO `diagnostico` VALUES ('F63.1',NULL,'Piroman�a patol�gica');
INSERT INTO `diagnostico` VALUES ('F63.2',NULL,'Cleptoman�a patol�gica');
INSERT INTO `diagnostico` VALUES ('F63.3',NULL,'Tricotiloman�a');
INSERT INTO `diagnostico` VALUES ('F64',NULL,'Trastornos de la identidad de g�nero');
INSERT INTO `diagnostico` VALUES ('F64.0',NULL,'Transexualidad');
INSERT INTO `diagnostico` VALUES ('F64.1',NULL,'Travestismo');
INSERT INTO `diagnostico` VALUES ('F64.2',NULL,'Trastorno de identidad de g�nero de la infancia');
INSERT INTO `diagnostico` VALUES ('F65',NULL,'Trastornos de orientaci�n sexual');
INSERT INTO `diagnostico` VALUES ('F65.0',NULL,'Fetichismo');
INSERT INTO `diagnostico` VALUES ('F65.1',NULL,'Fetichismo travestista');
INSERT INTO `diagnostico` VALUES ('F65.2',NULL,'Exhibicionismo');
INSERT INTO `diagnostico` VALUES ('F65.3',NULL,'Voyeurismo');
INSERT INTO `diagnostico` VALUES ('F65.4',NULL,'Pedofilia');
INSERT INTO `diagnostico` VALUES ('F65.5',NULL,'Sadomasoquismo');
INSERT INTO `diagnostico` VALUES ('F65.6',NULL,'M�ltiples trastornos de preferencia sexual');
INSERT INTO `diagnostico` VALUES ('F65.8',NULL,'Otros trastornos de preferencia sexual');
INSERT INTO `diagnostico` VALUES ('F66',NULL,'Trastornos psicol�gicos y de comportamiento asociados con el desarrollo y la orientaci�n sexual');
INSERT INTO `diagnostico` VALUES ('F66.0',NULL,'Trastorno de maduraci�n sexual');
INSERT INTO `diagnostico` VALUES ('F66.1',NULL,'Orientaci�n sexual ego-dist�nica');
INSERT INTO `diagnostico` VALUES ('F66.2',NULL,'Trastorno relacional sexual');
INSERT INTO `diagnostico` VALUES ('F66.8',NULL,'Otros trastornos de la pulsi�n');
INSERT INTO `diagnostico` VALUES ('F66.9',NULL,'Trastornos de la pulsi�n, sin especificar');
INSERT INTO `diagnostico` VALUES ('F68',NULL,'Otros trastornos de la personalidad y el comportamiento en adultos');
INSERT INTO `diagnostico` VALUES ('F68.0',NULL,'Elaboraci�n de s�ntomas f�sicos por razones psicol�gicas');
INSERT INTO `diagnostico` VALUES ('F68.1',NULL,'Producci�n intencionada o ficci�n de s�ntomas o incapacidades, f�sicas o psicol�gicas');
INSERT INTO `diagnostico` VALUES ('F68.8',NULL,'Otros trastornos espec�ficos de personalidad o comportamiento en adultos');
INSERT INTO `diagnostico` VALUES ('F69',NULL,'Trastornos de la personalidad y el comportamiento en adultos sin especificar');
INSERT INTO `diagnostico` VALUES ('F70',NULL,'Retraso mental leve');
INSERT INTO `diagnostico` VALUES ('F70-79',NULL,'Retraso mental');
INSERT INTO `diagnostico` VALUES ('F71',NULL,'Retraso mental moderado');
INSERT INTO `diagnostico` VALUES ('F72',NULL,'Retraso mental severo');
INSERT INTO `diagnostico` VALUES ('F73',NULL,'Retraso mental profundo');
INSERT INTO `diagnostico` VALUES ('F78',NULL,'Otros retrasos mentales');
INSERT INTO `diagnostico` VALUES ('F79',NULL,'Retrasos mentales sin especificar');
INSERT INTO `diagnostico` VALUES ('F80',NULL,'Trastornos espec�ficos del lenguaje y del habla');
INSERT INTO `diagnostico` VALUES ('F80-89',NULL,'Trastornos del desarrollo psicol�gico');
INSERT INTO `diagnostico` VALUES ('F80.0',NULL,'Trastorno espec�fico de la articulaci�n del habla');
INSERT INTO `diagnostico` VALUES ('F80.1',NULL,'Trastorno expresivo del lenguaje');
INSERT INTO `diagnostico` VALUES ('F80.2',NULL,'Trastorno receptivo del lenguaje');
INSERT INTO `diagnostico` VALUES ('F80.3',NULL,'Afasia adquirida con epilepsia Landau-Kleffner');
INSERT INTO `diagnostico` VALUES ('F80.8',NULL,'Otros trastornos del desarrollo del lenguaje y el habla');
INSERT INTO `diagnostico` VALUES ('F80.9',NULL,'Trastronos del desarrollo del lenguaje y el habla sin especificar');
INSERT INTO `diagnostico` VALUES ('F81',NULL,'Trastornos de desarrollo espec�ficos de habilidades acad�micas');
INSERT INTO `diagnostico` VALUES ('F81.0',NULL,'Trastorno espec�fico de la lectura');
INSERT INTO `diagnostico` VALUES ('F81.1',NULL,'Agraf�a');
INSERT INTO `diagnostico` VALUES ('F81.2',NULL,'Trastornos espec�ficos de habilidades aritm�ticas');
INSERT INTO `diagnostico` VALUES ('F81.3',NULL,'Trastornos mixtos de habilidades escolares');
INSERT INTO `diagnostico` VALUES ('F81.8',NULL,'Otros des�rdenes del desarrollo de habilidades escolares');
INSERT INTO `diagnostico` VALUES ('F81.9',NULL,'Trastorno de desarrollo de habilidades escolares sin especificar');
INSERT INTO `diagnostico` VALUES ('F82',NULL,'Trastornos de desarrollo espec�ficos de funciones motoras');
INSERT INTO `diagnostico` VALUES ('F83',NULL,'Trastornos de desarrollo espec�ficos mixtos');
INSERT INTO `diagnostico` VALUES ('F84',NULL,'Trastorno generalizado del desarrollo');
INSERT INTO `diagnostico` VALUES ('F84.0',NULL,'Autismo');
INSERT INTO `diagnostico` VALUES ('F84.2',NULL,'S�ndrome de Rett');
INSERT INTO `diagnostico` VALUES ('F84.4',NULL,'Trastorno asociado a hiperactividad con retraso mental y movimientos estereotipados');
INSERT INTO `diagnostico` VALUES ('F84.5',NULL,'S�ndrome de Asperger');
INSERT INTO `diagnostico` VALUES ('F88',NULL,'Otros trastornos del desarrollo psicol�gico');
INSERT INTO `diagnostico` VALUES ('F89',NULL,'Trastornos del desarrollo psicol�gico sin especificar');
INSERT INTO `diagnostico` VALUES ('F90',NULL,'Trastornos hiperquin�ticos');
INSERT INTO `diagnostico` VALUES ('F90-F98',NULL,'Trastornos del comportamiento y de las emociones de comienzo habitual en la infancia y adolescencia');
INSERT INTO `diagnostico` VALUES ('F90.0',NULL,'Trastorno de la actividad y la atenci�n');
INSERT INTO `diagnostico` VALUES ('F90.1',NULL,'Trastorno hiperquin�tico de la conducta');
INSERT INTO `diagnostico` VALUES ('F91',NULL,'Trastornos de conducta');
INSERT INTO `diagnostico` VALUES ('F91.0',NULL,'Trastorno de conducta confinado al entorno familiar');
INSERT INTO `diagnostico` VALUES ('F91.1',NULL,'Trastorno de conducta dessocializado');
INSERT INTO `diagnostico` VALUES ('F91.2',NULL,'Trastorno de conducta socializado');
INSERT INTO `diagnostico` VALUES ('F91.3',NULL,'Trastorno NEGATIVISTA desafiante');
INSERT INTO `diagnostico` VALUES ('F92',NULL,'Trastornos mixtos de conducta y emociones');
INSERT INTO `diagnostico` VALUES ('F92.0',NULL,'Trastornos de conducta depresivos');
INSERT INTO `diagnostico` VALUES ('F93',NULL,'Trastornos emocionales espec�ficos en el comienzo de la ni�ez');
INSERT INTO `diagnostico` VALUES ('F93.0',NULL,'Trastorno de ansiedad por separaci�n de la ni�ez');
INSERT INTO `diagnostico` VALUES ('F93.1',NULL,'Trastorno de ansiedad f�bica de la ni�ez');
INSERT INTO `diagnostico` VALUES ('F93.2',NULL,'Trastorno de ansiedad social de la ni�ez');
INSERT INTO `diagnostico` VALUES ('F93.3',NULL,'Trastorno de rivalidad fraternal');
INSERT INTO `diagnostico` VALUES ('F94',NULL,'Trastornos de funciones soclaies esfpec�ficos del comienzo de la ni�ez y la adolescencia');
INSERT INTO `diagnostico` VALUES ('F94.0',NULL,'Mutismo selectivo');
INSERT INTO `diagnostico` VALUES ('F94.1',NULL,'Trastorno del vinculo reactivo de la ni�ez');
INSERT INTO `diagnostico` VALUES ('F94.2',NULL,'Trastorno del vinculo deshinibido de la ni�ez');
INSERT INTO `diagnostico` VALUES ('F95',NULL,'Tics');
INSERT INTO `diagnostico` VALUES ('F95.0',NULL,'Tic transitorio');
INSERT INTO `diagnostico` VALUES ('F95.1',NULL,'Tic cr�nico motor o vocal');
INSERT INTO `diagnostico` VALUES ('F95.2',NULL,'Tic combinado vocal y m�ltiple motor de la Tourette');
INSERT INTO `diagnostico` VALUES ('F98',NULL,'Otros trastornos emocionales y de comportamiento iniciados normalmente en la ni�ez y en la adolescencia');
INSERT INTO `diagnostico` VALUES ('F98.0',NULL,'Enuresis nocturna');
INSERT INTO `diagnostico` VALUES ('F98.1',NULL,'Encopresis');
INSERT INTO `diagnostico` VALUES ('F98.2',NULL,'Trastorno de la alimentaci�n de la infancia y la ni�ez');
INSERT INTO `diagnostico` VALUES ('F98.3',NULL,'Pica de la infancia y la ni�ez');
INSERT INTO `diagnostico` VALUES ('F98.4',NULL,'Trastornos del movimiento estereotipados');
INSERT INTO `diagnostico` VALUES ('F98.5',NULL,'Tartamudez');
INSERT INTO `diagnostico` VALUES ('F98.6',NULL,'Desorden ling�itico');
INSERT INTO `diagnostico` VALUES ('F99',NULL,'Trastornos mentales sin especificar');
INSERT INTO `diagnostico` VALUES ('F99.0',NULL,'Trastorno mental no especificado en otra parte');


# Dumping Table estadocivil

#

CREATE TABLE estadocivil (

	idEstadoCivil varchar(5) NOT NULL  , 

	estadoCivil varchar(200) NOT NULL   ,

	PRIMARY KEY (idEstadoCivil),

	UNIQUE KEY estadoCivil (estadoCivil)	
) TYPE=MyISAM;



# Dumping Data - 5 rows



INSERT INTO estadocivil VALUES("c","casado");

INSERT INTO estadocivil VALUES("d","divorciado");

INSERT INTO estadocivil VALUES("s","soltero");

INSERT INTO estadocivil VALUES("u","uni�n libre");

INSERT INTO estadocivil VALUES("v","viudo");



# Dumping Table genero

#

CREATE TABLE genero (

	idGenero varchar(5) NOT NULL  , 

	generoDescripcion varchar(200) NOT NULL   ,

	PRIMARY KEY (idGenero),

	UNIQUE KEY generoDescripcion (generoDescripcion)	
) TYPE=MyISAM;



# Dumping Data - 3 rows



INSERT INTO genero VALUES("f","femenino");

INSERT INTO genero VALUES("m","masculino");

INSERT INTO genero VALUES("n","neutro");



# Dumping Table grupoedad

#

CREATE TABLE grupoedad (

	idEdad varchar(5) NOT NULL  , 

	edad varchar(15) NOT NULL   ,

	PRIMARY KEY (idEdad)	
) TYPE=MyISAM;



# Dumping Data - 4 rows



INSERT INTO grupoedad VALUES("1","0-14");

INSERT INTO grupoedad VALUES("2","15-23");

INSERT INTO grupoedad VALUES("3","24-65");

INSERT INTO grupoedad VALUES("4","66-�");



# Dumping Table instruccion

#

CREATE TABLE instruccion (

	idInstruccion varchar(5) NOT NULL  , 

	instruccDescripcion varchar(200) NOT NULL   ,

	PRIMARY KEY (idInstruccion),

	UNIQUE KEY instruccDescripcion (instruccDescripcion)	
) TYPE=MyISAM;



# Dumping Data - 9 rows



INSERT INTO instruccion VALUES("a","analfabeto");

INSERT INTO instruccion VALUES("b","primaria incompleta");

INSERT INTO instruccion VALUES("c","primaria completa");

INSERT INTO instruccion VALUES("d","secundaria incompleta");

INSERT INTO instruccion VALUES("e","secundaria completa");

INSERT INTO instruccion VALUES("f","bachillerato t�cnico");

INSERT INTO instruccion VALUES("g","universitaria incompleta");

INSERT INTO instruccion VALUES("h","universitaria completa");

INSERT INTO instruccion VALUES("i","masterado");



# Dumping Table paciente

#

CREATE TABLE paciente (

	idPaciente int(11) NOT NULL  DEFAULT '0' , 

	pacienteFecha date   , 

	pacienteNombre varchar(200) NOT NULL  , 

	pacienteApellido varchar(200) NOT NULL  , 

	pacienteNacimiento date   , 

	idEdad varchar(5)   , 

	pacienteEstadoCivil varchar(5)   , 

	idInstruccion varchar(5)   , 

	pacienteOcupacion varchar(200)   , 

	idResidencia varchar(5)   , 

	pacienteResidencia varchar(245)   , 

	idCiudad varchar(5)   , 

	idClaseSocial varchar(5)   , 

	pacienteTelefono varchar(200)   , 

	pacienteEmail varchar(100)   , 

	pacienteObservacion blob   , 

	pacienteAPP blob   , 

	pacienteAPF blob   , 

	pacienteEnfermedadAct blob   , 

	pacienteMC blob   , 

	pacienteDiagnostico blob   , 

	idGenero varchar(5)   , 

	idUsuario int(11)    ,

	PRIMARY KEY (idPaciente)	
) TYPE=MyISAM;



# Dumping Data - 0 rows



# Dumping Table residencia

#

CREATE TABLE residencia (

	idResidencia varchar(5) NOT NULL  , 

	residenciaDescripcion varchar(200) NOT NULL   ,

	PRIMARY KEY (idResidencia),

	UNIQUE KEY residenciaDescripcion (residenciaDescripcion)	
) TYPE=MyISAM;



# Dumping Data - 2 rows



INSERT INTO residencia VALUES("01","Urbana");

INSERT INTO residencia VALUES("02","Rural");



# Dumping Table usuario

#

CREATE TABLE usuario (

	idUsuario int(10) unsigned NOT NULL  auto_increment, 

	usuarioNombre varchar(150) NOT NULL  , 

	usuarioUser varchar(15)   , 

	usuarioPass varchar(20)    ,

	PRIMARY KEY (idUsuario),

	KEY usuarioNombre (usuarioNombre)	
) TYPE=MyISAM;



# Dumping Data - 2 rows



INSERT INTO usuario VALUES(1,"Administrador","admin","nimda");

INSERT INTO usuario VALUES(2,"Usuario","usuario","hyper2830");



