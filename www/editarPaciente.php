<?php
// *** Start the session
@session_start();



require_once("includes/logout.php");

$currentPage = $_SERVER["PHP_SELF"];

//Fechas
require_once('includes/fechas.php');

//Connection statement
require_once('Connections/qualitat_ado.php');

//Aditional Functions
require_once('includes/functions.inc.php');

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO descripcion (idPaciente, descripcionFecha, descripcionEvolucion, descripcionTratamiento, descripcionEstudios) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['idPaciente'], "int"),
                       GetSQLValueString($_POST['descripcionFecha'], "date"),
                       GetSQLValueString($_POST['descripcionEvolucion'], "text"),
                       GetSQLValueString($_POST['descripcionTratamiento'], "text"),
                       GetSQLValueString($_POST['descripcionEstudios'], "text"));

  $Result1 = $qualitat->Execute($insertSQL) or die($qualitat->ErrorMsg());

  $insertGoTo = "editarPaciente.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  KT_redir($insertGoTo);
}
//  $insertGoTo = "editarPaciente.php?id=" . $_POST['idPaciente'] . "";




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
$maxRows_rsHistorial = 100;
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

//PHP ADODB document - made with PHAkt 2.7.2
?>

<html>
<head>
<title>qualit&auml;t</title>
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
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  //theURL= theURL&"?id=0";
  alert(theURL);
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<body bgcolor="#ffffff">
<?php require("includes/head.php"); ?>
<table width="800"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%" valign="top"><?php include("includes/menu1.php"); ?></td>
    <td width="75%"><form action="" method="post" name="actualizar" id="actualizar">
      <table width="100%"  border="0" cellspacing="3" cellpadding="3">
        <tr>
          <td colspan="3" align="right" class="h2">Datos del Paciente </td>
        </tr>
        <tr>
          <td width="24%" align="right" class="navLink">&nbsp;</td>
          <td width="37%" class="navLink">&nbsp;</td>
          <td width="39%" class="navLink">ID: <?php echo $rsPaciente->Fields('idPaciente'); ?></td>
        </tr>
        <tr>
          <td align="right" class="titlebar"><?php echo $rsPaciente->Fields('pacienteFecha'); ?></td>
          <td class="navLink"><?php echo $rsPaciente->Fields('pacienteNombre'); ?>, <?php echo $rsPaciente->Fields('pacienteApellido'); ?></td>
          <td><strong>Fecha de Nacimiento: </strong><?php echo $rsPaciente->Fields('pacienteNacimiento'); ?> <br>          <strong>Grupo de Edad: </strong> <?php echo $rsGrupoEdad->Fields('edad'); ?></td>
        </tr>
        <tr>
          <td align="right" class="titlebar">Instrucci&oacute;n:</td>
          <td><?php echo $rsPaciente->Fields('idInstruccion'); ?> - <?php echo $rsInstruccion->Fields('instruccDescripcion'); ?></td>
          <td><strong>Ciudad: </strong><?php echo $rsPaciente->Fields('idCiudad'); ?></td>
        </tr>
        <tr>
          <td align="right" class="titlebar">Clase Social: </td>
          <td><?php echo $rsClaseSocial->Fields('claseSocial'); ?></td>
          <td><strong>Residencia: </strong><?php echo $rsResidencia->Fields('residenciaDescripcion'); ?></td>
        </tr>
        <tr>
          <td align="right" class="titlebar">G&eacute;nero: </td>
          <td><p><?php echo $rsGenero->Fields('generoDescripcion'); ?></p>            </td>
          <td><strong>Ciudad/Domicilio: </strong><br>
            <?php echo $rsPaciente->Fields('pacienteResidenciaCiudad'); ?> -            <?php echo $rsPaciente->Fields('pacienteResidencia'); ?></td>
        </tr>
        <tr>
          <td align="right" class="titlebar">Email: </td>
          <td><a href="mailto:<?php echo $rsPaciente->Fields('pacienteEmail'); ?>"><?php echo $rsPaciente->Fields('pacienteEmail'); ?></a></td>
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
        <tr>
          <td align="right" class="titlebar">M&eacute;dico Tratante: </td>
          <td colspan="2"><?php echo $rsPaciente->Fields('pacienteMTratante'); ?></td>
        </tr>
        <tr>
          <td align="right" class="titlebar">M&eacute;dico Enviante: </td>
          <td colspan="2"><?php echo $rsPaciente->Fields('pacienteMEnviante'); ?></td>
        </tr>
        <tr>
          <td align="right" class="titlebar">Seguro/N&uacute;mero:</td>
          <td colspan="2"><?php echo $rsPaciente->Fields('pacienteSeguro'); ?>/<?php echo $rsPaciente->Fields('pacienteNSeguro'); ?></td>
        </tr>
        <tr>
          <td align="right" class="titlebar">Actualizado por &uacute;ltima vez: </td>
          <td colspan="2"><?php echo $rsPaciente->Fields('pacienteActualizado'); ?></td>
        </tr>
        <tr>
          <td align="right"><a href="actualizarPaciente.php?id=<?php echo $rsPaciente->Fields('idPaciente'); ?>"><img src="images/botones/editar.gif" alt="Editar" width="31" height="29" border="0"></a></td>
          <td colspan="2"><a class="btn btn-dark" href="actualizarPaciente.php?id=<?php echo $rsPaciente->Fields('idPaciente'); ?>">Actualizar Datos de Paciente </a></td>
        </tr>
        <tr>
          <td align="right"><a href="#" onClick="MM_openBrWindow('ImpresionPaciente.php?id=<?php echo $rsPaciente->Fields('idPaciente'); ?>','imprimir','status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=680,height=600')"><img src="images/botones/imprimir.gif" alt="Imprimir" width="32" height="28" border="0"></a></td>
          <td colspan="2"><?php $_SESSION['idPaciente'] = $rsPaciente->Fields('idPaciente'); ?>
            <a href="#" class="btn btn-dark" onClick="MM_openBrWindow('ImpresionPaciente.php?id=<?php echo $rsPaciente->Fields('idPaciente'); ?>','imprimir','status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=680,height=600')">Imprimir Historia Cl&iacute;nica</a> </td>
        </tr>
      </table>
    </form>
      <div colspan="2" class="h2">Consultas Previas </div>
      <table width="100%"  border="0" cellpadding="3" cellspacing="3">
        <tr align="right">

        </tr>
        <thead class="thead-dark">
        <tr class="thead-dark">
          <th width="39%" scope="col">Identificador de Consulta</td>
          <th width="61%" scope="col">Evolución: </td>
        </tr>
        </thead>
    <?php
    $id = 0;
    ?>
        <?php
  while (!$rsHistorial->EOF) {
?>
    <tr>
      <td valign="top" class="navLink"><?php $id++;
          echo $id;
          ?>
        <br>
            <strong><a href="actualizarConsulta.php?cons=<?php echo $rsHistorial->Fields('idDescripcion'); ?>&paciente=<?php echo $rsPaciente->Fields('idPaciente'); ?>"><?php echo $rsHistorial->Fields('descripcionFecha'); ?></a></strong></td>
      <td><?php echo $rsHistorial->Fields('descripcionEvolucion'); ?></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td class="titlebar">Tratamiento: </td>
      </tr>
    <tr>
          <td valign="top">&nbsp;</td>
          <td><?php echo $rsHistorial->Fields('descripcionTratamiento'); ?></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top" class="titlebar">Estudios: </td>
      </tr>
    <tr>
      <td valign="top">&nbsp;</td>
        <td valign="top"><?php echo $rsHistorial->Fields('descripcionEstudios'); ?></td>
    </tr>
    <tr>
      <td colspan="2" valign="top"><hr noshade></td>
      </tr>

        <?php
    $rsHistorial->MoveNext();
  }
?>
      </table>
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
          <tr valign="baseline">
            <td colspan="3" align="right" nowrap class="h2">Nueva Consulta </td>
          </tr>
          <tr valign="baseline">
            <td width="21%" align="right" nowrap class="titlebar">Identificador:</td>
            <td width="30%">
      <?php $id++;
          echo $id;
          ?>
      </td>
            <td width="33%">&nbsp;</td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Identificador de Paciente:</td>
            <td><input type="text" name="idPaciente" value="<?php echo $rsPaciente->Fields('idPaciente'); ?>" size="5" readonly="1"></td>
            <td>&nbsp;</td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Fecha de Consulta:</td>
            <td><input name="descripcionFecha" type="text" id="date_a" value="<?php echo $ahora; ?>" size="10">
              <button type="reset" id="trigger_a" class="btn btn-dark">...</button>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "date_a",      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    false,            // will display a time selector
        button         :    "trigger_a",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
    //align          :    "Tl",           // alignment (defaults to "Bl")
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script></td>
            <td>&nbsp;</td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">Evolución:</td>
            <td colspan="2">
              <textarea name="descripcionEvolucion" cols="60" rows="6"></textarea>
            </td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">Tratamiento:</td>
            <td colspan="2">
              <textarea name="descripcionTratamiento" cols="60" rows="6"></textarea>
            </td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">Estudios:</td>
            <td colspan="2">
      <textarea name="descripcionEstudios" cols="60" rows="6" id="descripcionEstudios"></textarea>
      </td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td colspan="2"><input type="submit" value="Guardar Consulta" class="btn btn-dark"></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1">
      </form>
    <p>&nbsp;</p></td></tr>
</table>
<?php require("includes/pie.php"); ?>
</body>
</html>
<?php
$rsGrupoEdad->Close();

$rsClaseSocial->Close();

$rsPaciente->Close();

$rsHistorial->Close();

$rsGenero->Close();

$rsInstruccion->Close();

$rsEstadoCivil->Close();

$rsResidencia->Close();
?>
