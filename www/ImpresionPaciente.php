<?php
//Connection statement
require_once('Connections/qualitat_ado.php');
session_start();


// begin Recordset
$colname__rsPaciente = '-1';
if (isset($_GET['id'])) {
  $colname__rsPaciente = $_GET['id'];
}
$query_rsPaciente = sprintf("SELECT * FROM paciente WHERE idPaciente = %s", $colname__rsPaciente);
$rsPaciente = $qualitat->SelectLimit($query_rsPaciente) or die($qualitat->ErrorMsg());
$totalRows_rsPaciente = $rsPaciente->RecordCount();
// end Recordset

// begin Recordset
$query_rsClaseSocial = "SELECT * FROM clasesocial WHERE clasesocial.idClaseSocial ='".$rsPaciente->Fields('idClaseSocial')."'";
$rsClaseSocial = $qualitat->SelectLimit($query_rsClaseSocial) or die($qualitat->ErrorMsg());
$totalRows_rsClaseSocial = $rsClaseSocial->RecordCount();
// end Recordset


// begin Recordset
$query_rsGrupoEdad = "SELECT * FROM grupoedad WHERE idEdad='".$rsPaciente->Fields('idEdad')."'";
$rsGrupoEdad = $qualitat->SelectLimit($query_rsGrupoEdad) or die($qualitat->ErrorMsg());
$totalRows_rsGrupoEdad = $rsGrupoEdad->RecordCount();
// end Recordset

// begin Recordset
$query_rsGenero = "SELECT * FROM genero WHERE genero.idGenero='".$rsPaciente->Fields('idGenero')."'";
$rsGenero = $qualitat->SelectLimit($query_rsGenero) or die($qualitat->ErrorMsg());
$totalRows_rsGenero = $rsGenero->RecordCount();
// end Recordset

// begin Recordset
$query_rsInstruccion = "SELECT * FROM instruccion WHERE idInstruccion  ='".$rsPaciente->Fields('idInstruccion')."'";
$rsInstruccion = $qualitat->SelectLimit($query_rsInstruccion) or die($qualitat->ErrorMsg());
$totalRows_rsInstruccion = $rsInstruccion->RecordCount();
// end Recordset

// begin Recordset
$colname__rsEstadoCivil = $rsPaciente->Fields('pacienteEstadoCivil');

$query_rsEstadoCivil = sprintf("SELECT * FROM estadocivil WHERE idEstadoCivil = '%s'", $colname__rsEstadoCivil);
$rsEstadoCivil = $qualitat->SelectLimit($query_rsEstadoCivil) or die($qualitat->ErrorMsg());
$totalRows_rsEstadoCivil = $rsEstadoCivil->RecordCount();
// end Recordset

// begin Recordset
$colname__rsResidencia = $rsPaciente->Fields('idResidencia');

$query_rsResidencia = sprintf("SELECT * FROM residencia WHERE idResidencia = '%s'", $colname__rsResidencia);
$rsResidencia = $qualitat->SelectLimit($query_rsResidencia) or die($qualitat->ErrorMsg());
$totalRows_rsResidencia = $rsResidencia->RecordCount();
// end Recordset

// begin Recordset
$maxRows_rsHistorial = 10;
$pageNum_rsHistorial = 0;
if (isset($_GET['pageNum_rsHistorial'])) {
  $pageNum_rsHistorial = $_GET['pageNum_rsHistorial'];
}
$startRow_rsHistorial = $pageNum_rsHistorial * $maxRows_rsHistorial;
$colname__rsHistorial = '-1';
if (isset($_GET['id'])) {
  $colname__rsHistorial = $_GET['id'];
}
$query_rsHistorial = sprintf("SELECT * FROM descripcion WHERE idPaciente = %s ORDER BY descripcionFecha ASC", $colname__rsHistorial);
$rsHistorial = $qualitat->SelectLimit($query_rsHistorial, $maxRows_rsHistorial, $startRow_rsHistorial) or die($qualitat->ErrorMsg());
if (isset($_GET['totalRows_rsHistorial'])) {
  $totalRows_rsHistorial = $_GET['totalRows_rsHistorial'];
} else {
  $all_rsHistorial = $qualitat->SelectLimit($query_rsHistorial) or die($qualitat->ErrorMsg());
  $totalRows_rsHistorial = $all_rsHistorial->RecordCount();
}
$totalPages_rsHistorial = (int)(($totalRows_rsHistorial-1)/$maxRows_rsHistorial);
// end Recordset

//PHP ADODB document - made with PHAkt 2.7.2
?>


<html>
<head>
<title><?php echo $rsPaciente->Fields('pacienteNombre'); ?> <?php echo $rsPaciente->Fields('pacienteApellido'); ?> - Certificado de Consultas</title>
<meta http-equiv="Content-Type" content="text/html;">


  <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="calendario/calendar-system.css" title="system" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendario/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendario/lang/calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendario/calendar-setup.js"></script>



<link href="CSS/Level3_1.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
<link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
</head>
<body bgcolor="#ffffff">
    <table width="650" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="31">&nbsp;</td>
        <td width="619"><table width="600" border="0" cellpadding="3" cellspacing="0" id="encabezado">
          <tr>
            <td width="12">&nbsp;</td>
            <td width="672"><img src="images/logo.gif" alt="Dra. Susana Ortiz V." width="145" height="92" longdesc="Dra. Susana Ortiz V."></td>
            <td width="246" align="right"><p class="subtitle">&nbsp;</p>
                <p class="subtitle">Dra. Susana Ortiz V.</p>
              <p class="small">09 9475833<br>
                02 2225393 / 02 2549521 <br>
                <a href="mailto:so.xf@andinanet.net">so.xf@andinanet.net </a> </p></td>
          </tr>
          <tr>
            <td colspan="3">Quito, <?php echo date("d")." de ".date("M")." del ".date("Y") ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><table width="600"  border="0" cellpadding="3" cellspacing="3" id="datos">
          <tr>
            <td colspan="3" align="right" class="h2">Datos del Paciente </td>
          </tr>
          <tr>
            <td colspan="3" align="right" class="navLink">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="left" class="dingbat"><?php echo $rsPaciente->Fields('pacienteNombre'); ?>, <?php echo $rsPaciente->Fields('pacienteApellido'); ?></td>
            <td align="right" class="dingbat">ID Sistema: <?php echo $rsPaciente->Fields('idPaciente'); ?></td>
          </tr>
          <tr>
            <td colspan="3" class="btn btn-dark"><p><strong>Fecha de Ingreso: </strong><?php echo $rsPaciente->Fields('pacienteFecha'); ?></p>
                <p><strong>Fecha de Nacimiento: </strong><?php echo $rsPaciente->Fields('pacienteNacimiento'); ?> <br>
                    <strong>Grupo de Edad: </strong><?php echo $rsGrupoEdad->Fields('edad'); ?></p></td>
          </tr>
          <tr>
            <td width="18%" align="right" class="titlebar">Instrucci&oacute;n:</td>
            <td width="44%"><?php echo $rsPaciente->Fields('idInstruccion'); ?> - <?php echo $rsInstruccion->Fields('instruccDescripcion'); ?></td>
            <td width="38%"><strong>Ciudad: </strong><?php echo $rsPaciente->Fields('idCiudad'); ?></td>
          </tr>
          <tr>
            <td align="right" class="titlebar">Clase Social: </td>
            <td><?php echo $rsPaciente->Fields('idClaseSocial'); ?></td>
            <td><strong>Residencia: </strong><?php echo $rsPaciente->Fields('idResidencia'); ?></td>
          </tr>
          <tr>
            <td align="right" class="titlebar">G&eacute;nero: </td>
            <td><?php echo $rsGenero->Fields('generoDescripcion'); ?></td>
            <td><strong>Domicilio: </strong><?php echo $rsPaciente->Fields('pacienteResidencia'); ?></td>
          </tr>
          <tr>
            <td align="right" class="titlebar">Email: </td>
            <td><?php echo $rsPaciente->Fields('pacienteEmail'); ?></td>
            <td><strong>Tel&eacute;fono: </strong><?php echo $rsPaciente->Fields('pacienteTelefono'); ?></td>
          </tr>
          <tr>
            <td align="right" class="titlebar">Estado Civil: </td>
            <td><?php echo $rsEstadoCivil->Fields('estadoCivil'); ?></td>
            <td><strong>Ocupaci&oacute;n: </strong><?php echo $rsPaciente->Fields('pacienteOcupacion'); ?></td>
          </tr>
          <tr>
            <td align="right" class="titlebar">Observaciones:</td>
            <td colspan="2"><?php echo $rsPaciente->Fields('pacienteObservacion'); ?></td>
          </tr>
          <tr>
            <td align="right" class="titlebar">MC:</td>
            <td colspan="2"><?php echo $rsPaciente->Fields('pacienteMC'); ?></td>
          </tr>
          <tr>
            <td align="right" class="titlebar">APP:</td>
            <td colspan="2"><?php echo $rsPaciente->Fields('pacienteAPP'); ?></td>
          </tr>
          <tr>
            <td align="right" class="titlebar">APF:</td>
            <td colspan="2"><?php echo $rsPaciente->Fields('pacienteAPF'); ?></td>
          </tr>
          <tr>
            <td align="right" class="titlebar">Enfermedad Actual : </td>
            <td colspan="2"><?php echo $rsPaciente->Fields('pacienteEnfermedadAct'); ?></td>
          </tr>
          <tr>
            <td align="right" class="titlebar">Diagn&oacute;stico:</td>
            <td colspan="2"><?php echo $rsPaciente->Fields('pacienteDiagnostico'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><table width="600"  border="0" cellpadding="3" cellspacing="3" id="consultas">
          <tr align="right">
            <td colspan="2" class="h2">Consultas</td>
          </tr>
          <?php
		$id = 0;
		?>
		
		<?php 
		
		// si no existen registros
		if ($rsHistorial->EOF){
			echo "
			<tr class='navLink'>
            <td width='39%' valign='top'>
			No existen registros de consultas para este paciente
			</td>
			</tr>
			";
		}
		
		
		
		
		
		?>
        
          <?php
  while (!$rsHistorial->EOF) {
?>
          <tr class="navLink">
            <td width="39%" valign="top" class="titlebar">Identificador de Consulta:
              <?php $id++;
					echo $id; 
					?>            </td>
            <td width="61%" valign="top" class="titlebar">Fecha de consulta: <?php echo $rsHistorial->Fields('descripcionFecha'); ?></td>
          </tr>
          <tr>
            <td colspan="2" valign="top" class="navLink">Evoluci&oacute;n: </td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><?php echo $rsHistorial->Fields('descripcionEvolucion'); ?></td>
          </tr>
          <tr>
            <td colspan="2" valign="top" class="navLink">Tratamiento: </td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><?php echo $rsHistorial->Fields('descripcionTratamiento'); ?></td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><hr noshade></td>
          </tr>
          <?php
    $rsHistorial->MoveNext();
  }
?>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><table width="600" border="0" cellpadding="3" cellspacing="0" id="firma">
          <tr>
            <td height="90">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="4">&nbsp;</td>
            <td width="573"><p class="legal">Dra. Susana Ortiz V.<br>
              M&eacute;dica Psiquiatra<br>
            C&oacute;digo M&eacute;dico 2071</p></td>
            <td width="5">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="sidebarFooter"><p align="center">Cuero  y Caicedo 817 y Avenida Am&eacute;rica&nbsp; -  Tel&eacute;fonos 2549 521 -&nbsp; 2225 393 <br>
              09 9475833<br>
              so.xf@andinanet.net</p></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><a href="#"><img src="images/botones/imprimir.gif" alt="Imprimir" width="32" height="28" border="0" onClick="MM_callJS('this.print();')"></a></td>
        <td>&nbsp;</td>
      </tr>
    </table>
<p>&nbsp;</p>
<p align="center">&nbsp;</p>
</body>
</html>
<?php
$rsGrupoEdad->Close();

$rsClaseSocial->Close();

$rsPaciente->Close();

$rsHistorial->Close();

?>
